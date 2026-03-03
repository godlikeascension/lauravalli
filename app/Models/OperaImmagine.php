<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperaImmagine extends Model
{
    protected $table = 'opera_immagini';

    protected $fillable = ['opera_id', 'path'];

    public function opera()
    {
        return $this->belongsTo(Opera::class);
    }
}
