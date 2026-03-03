<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Impostazione extends Model
{
    protected $table    = 'impostazioni';
    protected $fillable = ['chiave', 'valore'];

    public static function get(string $chiave, string $default = ''): string
    {
        $row = DB::table('impostazioni')->where('chiave', $chiave)->first();
        return $row ? ($row->valore ?? $default) : $default;
    }

    public static function set(string $chiave, ?string $valore): void
    {
        DB::table('impostazioni')->updateOrInsert(
            ['chiave' => $chiave],
            ['valore' => $valore, 'updated_at' => now(), 'created_at' => now()]
        );
    }
}
