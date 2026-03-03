<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperaImmagine extends Model
{
    protected $table = 'opera_immagini';

    protected $fillable = ['opera_id', 'path'];

    protected $casts = ['opera_id' => 'integer'];

    public function opera()
    {
        return $this->belongsTo(Opera::class);
    }
}
