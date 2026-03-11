<?php

use App\Models\TraduzionePagina;

if (!function_exists('trad')) {
    /**
     * Get a translated string for the current locale.
     * Falls back to Italian, then to $fallback.
     */
    function trad(string $pagina, string $chiave, string $fallback = ''): string
    {
        static $loaded = [];
        static $cache  = [];

        $locale = app()->getLocale(); // 'it', 'en', 'es'

        // Load entire page's translations in one query on first access
        if (!isset($loaded["{$locale}.{$pagina}"])) {
            $rows = TraduzionePagina::where('pagina', $pagina)->get();
            foreach ($rows as $row) {
                $value = ($locale !== 'it' && !empty($row->{$locale}))
                    ? $row->{$locale}
                    : ($row->it ?? '');
                $cache["{$locale}.{$pagina}.{$row->chiave}"] = $value;
            }
            $loaded["{$locale}.{$pagina}"] = true;
        }

        return $cache["{$locale}.{$pagina}.{$chiave}"] ?? $fallback;
    }
}

if (!function_exists('localeUrl')) {
    /**
     * Get the URL for a named "page" in a given locale.
     * Pages: home, opere, commissioni, gift_card, artist_statement, commissioni_grazie
     */
    function localeUrl(string $page, string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();

        $map = [
            'home'               => ['it' => '/',                        'en' => '/en',                         'es' => '/es'],
            'opere'              => ['it' => '/opere',                   'en' => '/en/works',                   'es' => '/es/obras'],
            'commissioni'        => ['it' => '/commissioni',             'en' => '/en/commissions',             'es' => '/es/comisiones'],
            'gift_card'          => ['it' => '/gift-card',               'en' => '/en/gift-card',               'es' => '/es/gift-card'],
            'artist_statement'   => ['it' => '/artist-statement',        'en' => '/en/about',                   'es' => '/es/sobre-mi'],
            'commissioni_grazie' => ['it' => '/commissioni/grazie',      'en' => '/en/commissions/thank-you',   'es' => '/es/comisiones/gracias'],
        ];

        return $map[$page][$locale] ?? ($map[$page]['it'] ?? '/');
    }
}

if (!function_exists('operaUrl')) {
    /**
     * Get the URL for an artwork in the current locale.
     */
    function operaUrl(\App\Models\Opera $opera, string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();

        if ($locale === 'en') {
            $slug = !empty($opera->slug_en) ? $opera->slug_en : $opera->slug;
            return '/en/artwork/' . $slug;
        }
        if ($locale === 'es') {
            $slug = !empty($opera->slug_es) ? $opera->slug_es : $opera->slug;
            return '/es/obra/' . $slug;
        }
        return '/opera/' . $opera->slug;
    }
}

if (!function_exists('currentPageLocaleUrls')) {
    /**
     * Returns an array [locale => url] for all enabled locales for the current page.
     * Requires $opera to be passed for artwork detail pages.
     */
    function currentPageLocaleUrls(?\App\Models\Opera $opera = null): array
    {
        $path   = request()->path(); // e.g. 'en/works', 'commissioni', etc.
        $active = activeLocales();

        // Try to detect current page from path
        $pageMap = [
            ['it' => '',                      'en' => 'en',                         'es' => 'es',                      'key' => 'home'],
            ['it' => 'opere',                 'en' => 'en/works',                   'es' => 'es/obras',                'key' => 'opere'],
            ['it' => 'commissioni',           'en' => 'en/commissions',             'es' => 'es/comisiones',           'key' => 'commissioni'],
            ['it' => 'gift-card',             'en' => 'en/gift-card',               'es' => 'es/gift-card',            'key' => 'gift_card'],
            ['it' => 'artist-statement',      'en' => 'en/about',                   'es' => 'es/sobre-mi',             'key' => 'artist_statement'],
            ['it' => 'commissioni/grazie',    'en' => 'en/commissions/thank-you',   'es' => 'es/comisiones/gracias',   'key' => 'commissioni_grazie'],
        ];

        foreach ($pageMap as $entry) {
            foreach (['it', 'en', 'es'] as $l) {
                if ($path === $entry[$l]) {
                    $urls = [];
                    foreach (array_merge(['it'], $active) as $loc) {
                        $urls[$loc] = '/' . ltrim($entry[$loc], '/');
                        if ($urls[$loc] === '//') $urls[$loc] = '/';
                    }
                    return $urls;
                }
            }
        }

        // Artwork detail page
        if ($opera) {
            $urls = ['it' => operaUrl($opera, 'it')];
            foreach ($active as $loc) {
                $urls[$loc] = operaUrl($opera, $loc);
            }
            return $urls;
        }

        // Fallback: homepage of each locale
        $urls = ['it' => '/'];
        foreach ($active as $loc) {
            $urls[$loc] = localeUrl('home', $loc);
        }
        return $urls;
    }
}

if (!function_exists('activeLocales')) {
    /**
     * Returns array of active non-IT locale codes, e.g. ['en'] or ['en','es'].
     * Result is cached per request.
     */
    function activeLocales(): array
    {
        static $cached = null;
        if ($cached !== null) return $cached;

        $cached = [];
        foreach (['en', 'es'] as $loc) {
            if (\App\Models\Impostazione::get("lingua_{$loc}_attiva") === '1') {
                $cached[] = $loc;
            }
        }
        return $cached;
    }
}
