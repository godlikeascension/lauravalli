<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';

    protected $fillable = ['domanda', 'domanda_en', 'domanda_es', 'risposta_html', 'risposta_html_en', 'risposta_html_es', 'ordine', 'tipo'];

    public function getDomandaLocaleAttribute(): string
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && !empty($this->domanda_en)) return $this->domanda_en;
        if ($locale === 'es' && !empty($this->domanda_es)) return $this->domanda_es;
        return $this->domanda;
    }

    public function getRispostaLocaleAttribute(): string
    {
        $locale = app()->getLocale();
        if ($locale === 'en' && !empty($this->risposta_html_en)) return $this->risposta_html_en;
        if ($locale === 'es' && !empty($this->risposta_html_es)) return $this->risposta_html_es;
        return $this->risposta_html;
    }

    protected $casts = ['ordine' => 'integer'];
}
