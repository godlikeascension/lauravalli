<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';

    protected $fillable = ['domanda', 'risposta_html', 'ordine', 'tipo'];

    protected $casts = ['ordine' => 'integer'];
}
