<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Collezione extends Model
{
    protected $table = 'collezioni';

    protected $fillable = [
        'nome',
        'slug',
        'descrizione',
        'is_featured',
        'ordine',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    // Generazione automatica dello slug dal nome
    protected static function booted(): void
    {
        static::creating(function (Collezione $collezione) {
            if (empty($collezione->slug)) {
                $collezione->slug = static::generaSlugUnico($collezione->nome);
            }
        });

        static::updating(function (Collezione $collezione) {
            if ($collezione->isDirty('nome')) {
                $collezione->slug = static::generaSlugUnico($collezione->nome, $collezione->id);
            }
        });
    }

    protected static function generaSlugUnico(string $nome, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($nome);
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

    // Imposta questa collezione come "featured" e rimuove il flag dalle altre
    public static function setFeatured(int $id): void
    {
        DB::table('collezioni')->update(['is_featured' => false]);
        DB::table('collezioni')->where('id', $id)->update(['is_featured' => true]);
    }

    public function opere()
    {
        return $this->hasMany(Opera::class);
    }
}
