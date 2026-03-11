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
    ];

    protected $casts = [
        'venduto'       => 'boolean',
        'commissione'   => 'boolean',
        'prezzo'        => 'decimal:2',
        'larghezza_cm'  => 'decimal:2',
        'altezza_cm'    => 'decimal:2',
        'year'          => 'integer',
        'collezione_id' => 'integer',
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

    // Dimensioni formattate "L x H cm"
    public function getDimensioniAttribute(): ?string
    {
        if ($this->larghezza_cm && $this->altezza_cm) {
            return rtrim(rtrim($this->larghezza_cm, '0'), '.') . ' x ' .
                rtrim(rtrim($this->altezza_cm, '0'), '.') . ' cm';
        }

        return null;
    }

    // Meta line: "Olio su tela 300gr - 30 x 40 cm - Anno 2025"
    public function getMetaAttribute(): ?string
    {
        $parts = array_filter([
            $this->opera_type ?: null,
            $this->getDimensioniAttribute(),
            $this->year ? 'Anno ' . $this->year : null,
        ]);

        return $parts ? implode(' · ', $parts) : null;
    }
}
