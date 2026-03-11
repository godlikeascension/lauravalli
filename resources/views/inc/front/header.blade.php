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
                        <li class="nav-item dropdown simple-dropdown">
                            <a href="#" class="nav-link d-flex align-items-center">
                                <img src="{{ $flagSrc[$currentLocale] }}" class="lang-flag" alt="{{ $codeMap[$currentLocale] }}">
                                <span class="ms-3">{{ $labelMap[$currentLocale] }}</span>
                                <i class="feather icon-feather-chevron-down ms-2"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach(array_merge(['it'], $activeLocales) as $loc)
                                    @if($loc === $currentLocale) @continue @endif
                                    @php $url = $localeUrls[$loc] ?? localeUrl('home', $loc); @endphp
                                    <li>
                                        <a href="{{ $url }}">
                                            <img src="{{ $flagSrc[$loc] }}" class="lang-flag" alt="{{ $codeMap[$loc] }}"><span class="ms-3">{{ $labelMap[$loc] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
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
.lang-flag { width: 18px; height: auto; vertical-align: middle; border-radius: 2px; }
.lang-chevron-icon { font-size: 12px; margin-left: 2px; vertical-align: middle; opacity: .6; }
</style>
