<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Opera extends Model
{
    protected $table = 'opere';

    protected $fillable = [
        'immagine',
        'titolo',
        'titolo_en',
        'titolo_es',
        'slug',
        'slug_en',
        'slug_es',
        'prezzo',
        'venduto',
        'larghezza_cm',
        'altezza_cm',
        'opera_type',
        'year',
        'descrizione_html',
        'descrizione_html_en',
        'descrizione_html_es',
        'commissione',
        'collezione_id',
        'cta_personalizzata',
        'cta_tipo',
        'cta_label',
        'cta_label_en',
        'cta_label_es',
        'cta_whatsapp',
        'cta_url',
    ];

    protected $casts = [
        'venduto'            => 'boolean',
        'commissione'        => 'boolean',
        'prezzo'             => 'decimal:2',
        'larghezza_cm'       => 'decimal:2',
        'altezza_cm'         => 'decimal:2',
        'year'               => 'integer',
        'collezione_id'      => 'integer',
        'cta_personalizzata' => 'boolean',
    ];

    // Generazione automatica dello slug dal titolo
    protected static function booted()
    {
        static::creating(function (Opera $opera) {
            if (empty($opera->slug)) {
                $opera->slug = static::generaSlugUnico($opera->titolo);
            }
        });

        static::updating(function (Opera $opera) {
            // opzionale: rigenerare lo slug se cambia il titolo
            if ($opera->isDirty('titolo')) {
                $opera->slug = static::generaSlugUnico($opera->titolo, $opera->id);
            }
        });
    }

    protected static function generaSlugUnico(string $titolo, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($titolo);
        $slug = $baseSlug;
        $i = 1;

        while (static::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }

    public function collezione()
    {
        return $this->belongsTo(Collezione::class);
    }

    public function immagini()
    {
        return $this->hasMany(OperaImmagine::class);
    }

    // Titolo localizzato per la lingua corrente
    public function getTitoloLocaleAttribute(): string
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && !empty($this->titolo_en)) return $this->titolo_en;
        if ($locale === 'es' && !empty($this->titolo_es)) return $this->titolo_es;
        return $this->titolo;
    }

    // Descrizione localizzata per la lingua corrente
    public function getDescrizioneLocaleAttribute(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && !empty($this->descrizione_html_en)) return $this->descrizione_html_en;
        if ($locale === 'es' && !empty($this->descrizione_html_es)) return $this->descrizione_html_es;
        return $this->descrizione_html;
    }

    // Slug localizzato per la lingua corrente
    public function getSlugLocaleAttribute(): string
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && !empty($this->slug_en)) return $this->slug_en;
        if ($locale === 'es' && !empty($this->slug_es)) return $this->slug_es;
        return $this->slug;
    }

    // Etichetta localizzata del bottone personalizzato
    public function getCtaLabelLocaleAttribute(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && !empty($this->cta_label_en)) return $this->cta_label_en;
        if ($locale === 'es' && !empty($this->cta_label_es)) return $this->cta_label_es;
        return $this->cta_label;
    }

    // Destinazione del bottone personalizzato (null se non configurato o non valido)
    public function getCtaHrefAttribute(): ?string
    {
        if ($this->cta_tipo === 'whatsapp') {
            $numero = preg_replace('/\D/', '', (string) $this->cta_whatsapp);
            // wa.me vuole il prefisso internazionale senza "+" né "00"
            if (str_starts_with($numero, '00')) {
                $numero = substr($numero, 2);
            }
            if ($numero === '') return null;

            // Messaggio precompilato: spagnolo solo col sito in ES, inglese per IT ed EN
            $lingua = app()->getLocale() === 'es' ? 'es' : 'en';
            $titolo = $lingua === 'es'
                ? ($this->titolo_es ?: $this->titolo)
                : ($this->titolo_en ?: $this->titolo);

            $messaggio = __('ui.whatsapp_interesse', ['opera' => $titolo], $lingua);

            return 'https://wa.me/' . $numero . '?text=' . rawurlencode($messaggio);
        }

        if ($this->cta_tipo === 'link') {
            $url = trim((string) $this->cta_url);
            // Solo https: blocca schemi come javascript: o data:
            return preg_match('#^https://#i', $url) ? $url : null;
        }

        return null;
    }

    // true solo se il bottone personalizzato è attivo e completamente configurato
    public function getHasCtaPersonalizzataAttribute(): bool
    {
        return $this->cta_personalizzata
            && !empty($this->cta_label_locale)
            && !empty($this->cta_href);
    }

    // Dimensioni formattate "L x H cm"
    public function getDimensioniAttribute(): ?string
    {
        if ($this->larghezza_cm && $this->altezza_cm) {
            return rtrim(rtrim($this->larghezza_cm, '0'), '.') . ' x ' .
                rtrim(rtrim($this->altezza_cm, '0'), '.') . ' cm';
        }

        return null;
    }

    // Meta line: "Olio su tela · 30 x 40 cm · Anno 2025" (localized)
    public function getMetaAttribute(): ?string
    {
        $locale = app()->getLocale();

        // opera_type values are stored in Italian (closed set from the dashboard
        // dropdown); translate at render time only.
        $tecnicaMap = [
            'Olio su tela'       => ['en' => 'Oil on canvas',     'es' => 'Óleo sobre lienzo'],
            'Olio su legno'      => ['en' => 'Oil on wood',       'es' => 'Óleo sobre madera'],
            'Olio su carta 300g' => ['en' => 'Oil on paper 300gsm','es' => 'Óleo sobre papel 300g'],
        ];
        $annoLabel = ['en' => 'Year', 'es' => 'Año'][$locale] ?? 'Anno';

        $tipo = $this->opera_type ?: null;
        if ($tipo && $locale !== 'it' && isset($tecnicaMap[$tipo][$locale])) {
            $tipo = $tecnicaMap[$tipo][$locale];
        }

        $parts = array_filter([
            $tipo,
            $this->getDimensioniAttribute(),
            $this->year ? $annoLabel . ' ' . $this->year : null,
        ]);

        return $parts ? implode(' · ', $parts) : null;
    }
}
