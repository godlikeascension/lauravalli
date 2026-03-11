<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TraduzionePagina extends Model
{
    protected $table    = 'traduzioni_pagine';
    protected $fillable = ['pagina', 'chiave', 'it', 'en', 'es'];

    /**
     * Upsert a single translation row.
     */
    public static function set(string $pagina, string $chiave, ?string $it, ?string $en, ?string $es): void
    {
        static::updateOrCreate(
            ['pagina' => $pagina, 'chiave' => $chiave],
            ['it' => $it, 'en' => $en, 'es' => $es]
        );
    }

    /**
     * Bulk-upsert all keys for a page.
     * $data format: [ 'chiave' => ['it' => '...', 'en' => '...', 'es' => '...'], ... ]
     */
    public static function setPage(string $pagina, array $data): void
    {
        foreach ($data as $chiave => $values) {
            static::updateOrCreate(
                ['pagina' => $pagina, 'chiave' => $chiave],
                ['it' => $values['it'] ?? null, 'en' => $values['en'] ?? null, 'es' => $values['es'] ?? null]
            );
        }
    }
}
