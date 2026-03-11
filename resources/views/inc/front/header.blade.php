@php
    $activeLocales   = activeLocales();
    $currentLocale   = app()->getLocale();
    $hasTranslations = count($activeLocales) > 0;
    $localeUrls      = currentPageLocaleUrls($currentOpera ?? null);

    $flagSrc  = ['it' => '/images/italia.png', 'en' => '/images/uk.png', 'es' => '/images/spagna.webp'];
    $codeMap  = ['it' => 'IT', 'en' => 'EN', 'es' => 'ES'];
    $labelMap = ['it' => 'Italiano', 'en' => 'English', 'es' => 'Español'];
@endphp
<header>
    <!-- start navigation -->
    <nav class="navbar navbar-expand-lg header-light bg-white header-reverse glass-effect">
        <div class="container-fluid">
            <div class="col-auto col-lg-2 me-lg-0 me-auto">
                <a class="navbar-brand" href="{{ localeUrl('home') }}">
                    <img src="/images/logolau.png" data-at2x="/images/logolau.png" style="height: 100px !important;" alt="" class="default-logo">
                    <img src="/images/logolau.png" data-at2x="/images/logolau.png" style="height: 100px !important;" alt="" class="alt-logo">
                    <img src="/images/logolau.png" data-at2x="/images/logolau.png" style="height: 100px !important;" alt="" class="mobile-logo">
                </a>
            </div>
            <div class="col-auto ms-auto md-ms-0 menu-order position-static">
                <button class="navbar-toggler float-start" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                    <span class="navbar-toggler-line"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav alt-font">
                        <li class="nav-item"><a href="{{ localeUrl('home') }}" class="nav-link">{{ trad('navbar','home','Home') }}</a></li>
                        <li class="nav-item"><a href="{{ localeUrl('opere') }}" class="nav-link">{{ trad('navbar','opere','Opere') }}</a></li>
                        <li class="nav-item"><a href="{{ localeUrl('commissioni') }}" class="nav-link">{{ trad('navbar','commissioni','Commissioni') }}</a></li>
                        <li class="nav-item"><a href="{{ localeUrl('gift_card') }}" class="nav-link">{{ trad('navbar','gift_card',"Regala un'opera") }}</a></li>
                        <li class="nav-item"><a href="{{ localeUrl('artist_statement') }}" class="nav-link">{{ trad('navbar','chi_sono','Chi Sono') }}</a></li>

                        @if($hasTranslations)
                        <li class="nav-item ms-lg-3 lang-switcher-wrap">
                            <div class="dropdown lang-dropdown">
                                <button class="lang-dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ $flagSrc[$currentLocale] }}" width="16" height="12" alt="{{ $codeMap[$currentLocale] }}" class="lang-flag">
                                    <span class="lang-code">{{ $codeMap[$currentLocale] }}</span>
                                    <svg class="lang-chevron" xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                                </button>
                                <ul class="dropdown-menu lang-dropdown-menu">
                                    @foreach(array_merge(['it'], $activeLocales) as $loc)
                                        @php $url = $localeUrls[$loc] ?? localeUrl('home', $loc); @endphp
                                        <li>
                                            <a href="{{ $url }}" class="lang-dropdown-item{{ $loc === $currentLocale ? ' active' : '' }}">
                                                <img src="{{ $flagSrc[$loc] }}" width="16" height="12" alt="{{ $codeMap[$loc] }}" class="lang-flag">
                                                <span>{{ $labelMap[$loc] }}</span>
                                                @if($loc === $currentLocale)
                                                    <svg class="ms-auto" xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- end navigation -->
</header>
<style>
/* ── Language dropdown ─────────────────────────────────────── */
.lang-switcher-wrap { display: flex; align-items: center; }

.lang-dropdown-toggle {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: transparent;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 5px;
    padding: 4px 9px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: #555;
    cursor: pointer;
    white-space: nowrap;
    transition: border-color .15s, color .15s;
    font-family: var(--primary-font, sans-serif);
    line-height: 1;
}
.lang-dropdown-toggle:hover,
.lang-dropdown-toggle:focus {
    border-color: #1d1d1d;
    color: #1d1d1d;
    outline: none;
}

.lang-flag { border-radius: 2px; display: block; flex-shrink: 0; }
.lang-code { line-height: 1; }

.lang-chevron {
    opacity: .5;
    transition: transform .18s;
    flex-shrink: 0;
}
.lang-dropdown-toggle[aria-expanded="true"] .lang-chevron {
    transform: rotate(180deg);
    opacity: .8;
}

.lang-dropdown-menu {
    min-width: 140px;
    border: 1px solid rgba(0,0,0,.09);
    border-radius: 7px;
    box-shadow: 0 8px 28px rgba(0,0,0,.09);
    padding: 4px 0;
    background: #fff;
    margin-top: 6px !important;
}

.lang-dropdown-item {
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 7px 14px;
    font-size: 12px;
    font-weight: 500;
    letter-spacing: .02em;
    color: #444;
    text-decoration: none;
    transition: background .12s;
    white-space: nowrap;
    font-family: var(--primary-font, sans-serif);
}
.lang-dropdown-item:hover { background: #f7f7f7; color: #1d1d1d; }
.lang-dropdown-item.active { color: #1d1d1d; font-weight: 700; }

@media (max-width: 991px) {
    .lang-switcher-wrap { margin-top: 8px; }
    .lang-dropdown-toggle { font-size: 12px; padding: 6px 11px; }
}
</style>
