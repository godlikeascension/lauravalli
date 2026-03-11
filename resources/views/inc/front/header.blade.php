@php
    $activeLocales   = activeLocales();
    $currentLocale   = app()->getLocale();
    $hasTranslations = count($activeLocales) > 0;
    $localeUrls      = currentPageLocaleUrls($currentOpera ?? null);

    $flagMap  = ['it' => '🇮🇹', 'en' => '🇬🇧', 'es' => '🇪🇸'];
    $labelMap = ['it' => 'IT',  'en' => 'EN',  'es' => 'ES'];
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
                        <li class="nav-item ms-lg-3 d-flex align-items-center lang-switcher-wrap" style="gap:5px;">
                            @foreach(array_merge(['it'], $activeLocales) as $loc)
                                @php $url = $localeUrls[$loc] ?? localeUrl('home', $loc); @endphp
                                <a href="{{ $url }}"
                                   class="lang-pill{{ $loc === $currentLocale ? ' active' : '' }}"
                                   title="{{ strtoupper($loc) }}">
                                    {{ $flagMap[$loc] }} {{ $labelMap[$loc] }}
                                </a>
                            @endforeach
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
.lang-pill {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 20px;
    border: 1.5px solid #d0d0d0;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: .04em;
    color: #444;
    text-decoration: none;
    transition: border-color .2s, color .2s, background .2s;
    white-space: nowrap;
    line-height: 1.4;
}
.lang-pill:hover {
    border-color: #1d1d1d;
    color: #1d1d1d;
}
.lang-pill.active {
    background: #1d1d1d;
    border-color: #1d1d1d;
    color: #fff !important;
}
@media (max-width: 991px) {
    .lang-pill { font-size: 13px; padding: 6px 12px; }
    .lang-switcher-wrap { margin-top: 10px !important; padding-left: 4px; }
}
</style>
