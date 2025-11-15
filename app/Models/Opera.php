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
        'slug',
        'prezzo',
        'venduto',
        'larghezza_cm',
        'altezza_cm',
        'descrizione_html',
        'commissione',
    ];

    protected $casts = [
        'venduto'     => 'boolean',
        'commissione' => 'boolean',
        'prezzo'      => 'decimal:2',
        'larghezza_cm'=> 'decimal:2',
        'altezza_cm'  => 'decimal:2',
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

    // Accessor comodo per mostrare dimensioni formattate "L x H cm"
    public function getDimensioniAttribute(): ?string
    {
        if ($this->larghezza_cm && $this->altezza_cm) {
            return rtrim(rtrim($this->larghezza_cm, '0'), '.') . ' x ' .
                rtrim(rtrim($this->altezza_cm, '0'), '.') . ' cm';
        }

        return null;
    }
}
