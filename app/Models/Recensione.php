<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recensione extends Model
{
    protected $table = 'recensioni';

    protected $fillable = [
        'immagine',
        'testo',
        'testo_en',
        'testo_es',
        'nome',
        'nome_en',
        'nome_es',
    ];
}
