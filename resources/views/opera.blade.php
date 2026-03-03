<!doctype html>
<html class="no-js" lang="it">
<head>
    <title>{{ $opera->titolo }} | Laura Valli Art</title>
    <meta name="description" content="{{ $opera->titolo }}{{ $opera->collezione ? ' · ' . $opera->collezione->nome : '' }} | Dipinti ad olio di Laura Valli">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Luca Dei Rossi">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    @if($opera->immagine)
        <meta property="og:image" content="{{ asset('storage/' . $opera->immagine) }}">
    @endif
    <link rel="shortcut icon" href="/images/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="/css/vendors.min.css" />
    <link rel="stylesheet" href="/css/icon.min.css" />
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="stylesheet" href="/css/responsive.css"/>
    <link rel="stylesheet" href="/css/branding-agency.css" />
    <link rel="stylesheet" href="/css/custom.css" />
    <style>
        /* ── Main carousel ── */
        .opera-main-swiper {
            border-radius: 8px;
            overflow: hidden;
            background: #f5f5f5;
        }
        .opera-main-swiper .swiper-slide img {
            width: 100%;
            display: block;
            cursor: zoom-in;
            transition: transform .45s ease;
        }
        .opera-main-swiper .swiper-slide img:hover {
            transform: scale(1.015);
        }
        .opera-main-swiper .swiper-button-prev,
        .opera-main-swiper .swiper-button-next {
            color: #fff;
            background: rgba(0,0,0,.32);
            width: 44px;
            height: 44px;
            border-radius: 50%;
            transition: background .2s;
        }
        .opera-main-swiper .swiper-button-prev:hover,
        .opera-main-swiper .swiper-button-next:hover {
            background: rgba(0,0,0,.6);
        }
        .opera-main-swiper .swiper-button-prev::after,
        .opera-main-swiper .swiper-button-next::after {
            font-size: 15px;
            font-weight: 700;
        }
        .opera-main-swiper .swiper-pagination-bullet-active {
            background: #1d1d1d;
        }

        /* ── Thumbnail strip ── */
        .opera-thumbs-swiper {
            margin-top: 10px;
        }
        .opera-thumbs-swiper .swiper-slide {
            opacity: .45;
            cursor: pointer;
            border-radius: 4px;
            overflow: hidden;
            transition: opacity .2s;
        }
        .opera-thumbs-swiper .swiper-slide img {
            aspect-ratio: 1/1;
            object-fit: cover;
            width: 100%;
            display: block;
        }
        .opera-thumbs-swiper .swiper-slide-thumb-active {
            opacity: 1;
            outline: 2px solid #1d1d1d;
            outline-offset: 2px;
        }

        /* ── Single image ── */
        .opera-single-img {
            border-radius: 8px;
            overflow: hidden;
            background: #f5f5f5;
        }
        .opera-single-img img {
            width: 100%;
            display: block;
            cursor: zoom-in;
        }

        /* ── Info panel ── */
        .opera-info-sticky {
            position: sticky;
            top: 110px;
        }
        @media (max-width: 991px) {
            .opera-info-sticky { position: static; }
        }

        /* ── Description (CKEditor HTML) ── */
        .opera-description p {
            font-family: var(--primary-font);
            color: var(--medium-gray);
            line-height: 1.85;
            margin-bottom: .9rem;
        }
        .opera-description h1, .opera-description h2,
        .opera-description h3, .opera-description h4 {
            font-family: var(--alt-font);
            color: var(--dark-gray);
            font-weight: 600;
            margin-bottom: .6rem;
        }

        /* ── Divider ── */
        .info-divider {
            border: none;
            border-top: 1px solid #ebebeb;
            margin: 22px 0;
        }

        /* ── Lightbox ── */
        #opera-lightbox {
            position: fixed;
            inset: 0;
            background: rgba(10,10,10,.93);
            z-index: 10000;
            display: none;
            align-items: center;
            justify-content: center;
        }
        #opera-lightbox.open {
            display: flex;
        }
        #lightbox-swiper-wrap {
            width: min(92vw, 1100px);
            max-height: 88vh;
            position: relative;
        }
        #lightbox-swiper-wrap .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #lightbox-swiper-wrap .swiper-slide img {
            max-width: 100%;
            max-height: 82vh;
            object-fit: contain;
            border-radius: 4px;
            display: block;
        }
        #lightbox-swiper-wrap .swiper-button-prev,
        #lightbox-swiper-wrap .swiper-button-next {
            color: #fff;
        }
        #lightbox-swiper-wrap .swiper-button-prev::after,
        #lightbox-swiper-wrap .swiper-button-next::after {
            font-size: 22px;
        }
        .lb-close {
            position: fixed;
            top: 18px;
            right: 22px;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            border: none;
            background: rgba(255,255,255,.12);
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .2s;
            z-index: 10;
        }
        .lb-close:hover { background: rgba(255,255,255,.25); }
        .lb-counter {
            position: fixed;
            bottom: 18px;
            left: 50%;
            transform: translateX(-50%);
            color: rgba(255,255,255,.6);
            font-size: 13px;
            letter-spacing: .06em;
            pointer-events: none;
        }

        /* ── Breadcrumb ── */
        .opera-breadcrumb a {
            color: inherit;
            text-decoration: none;
        }
        .opera-breadcrumb a:hover { text-decoration: underline; }
        .opera-breadcrumb .sep { margin: 0 7px; opacity: .4; }

        /* ── Price ── */
        .opera-price-tag {
            font-family: var(--alt-font);
            font-size: 1.9rem;
            font-weight: 600;
            color: var(--dark-gray);
            letter-spacing: -1px;
        }
        .opera-sold-tag {
            font-family: var(--alt-font);
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: .04em;
            color: #b5341a;
        }
    </style>
</head>

<body data-mobile-nav-trigger-alignment="right" data-mobile-nav-style="modern" data-mobile-nav-bg-color="#1d1d1d">
@include('inc.front.header')

@php
    $allImages = collect();
    if ($opera->immagine) $allImages->push($opera->immagine);
    foreach ($opera->immagini as $img) $allImages->push($img->path);
    $imgCount   = $allImages->count();
    $hasMultiple = $imgCount > 1;
@endphp

<section class="ipad-top-space-margin" style="padding-top: 70px; padding-bottom: 110px;">
    <div class="container">

        {{-- Breadcrumb --}}
        <nav class="opera-breadcrumb alt-font fs-13 text-muted mb-45px" aria-label="breadcrumb">
            <a href="/">Home</a>
            <span class="sep">·</span>
            <a href="/opere">Opere</a>
            @if($opera->collezione)
                <span class="sep">·</span>
                <span>{{ $opera->collezione->nome }}</span>
            @endif
            <span class="sep">·</span>
            <span class="text-dark-gray">{{ $opera->titolo }}</span>
        </nav>

        <div class="row gx-5 gy-5 align-items-start">

            {{-- ── LEFT: image(s) ── --}}
            <div class="col-lg-7">

                @if($hasMultiple)
                    {{-- Main carousel --}}
                    <div class="swiper opera-main-swiper" id="operaMainSwiper">
                        <div class="swiper-wrapper">
                            @foreach($allImages as $imgPath)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $imgPath) }}"
                                         alt="{{ $opera->titolo }}"
                                         loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                                         data-lb-index="{{ $loop->index }}"
                                         onclick="openLightbox({{ $loop->index }})" />
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-pagination"></div>
                    </div>

                    {{-- Thumbnail strip --}}
                    <div class="swiper opera-thumbs-swiper" id="operaThumbSwiper">
                        <div class="swiper-wrapper">
                            @foreach($allImages as $imgPath)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $imgPath) }}"
                                         alt="miniatura {{ $loop->iteration }}"
                                         loading="lazy" />
                                </div>
                            @endforeach
                        </div>
                    </div>

                @else
                    {{-- Single image --}}
                    <div class="opera-single-img">
                        <img src="{{ $imgCount ? asset('storage/' . $allImages->first()) : '/images/placeholder.jpg' }}"
                             alt="{{ $opera->titolo }}"
                             style="width:100%;"
                             onclick="openLightbox(0)" />
                    </div>
                @endif

                @if($imgCount)
                    <p class="text-muted fs-12 text-center mt-12px" style="letter-spacing:.03em;">
                        Clicca {{ $hasMultiple ? "un'immagine" : "sull'immagine" }} per ingrandirla
                    </p>
                @endif
            </div>

            {{-- ── RIGHT: info panel ── --}}
            <div class="col-lg-5">
                <div class="opera-info-sticky">

                    {{-- Collection label --}}
                    @if($opera->collezione)
                        <div class="mb-18px">
                            <span class="w-25px h-1px d-inline-block bg-base-color me-5px align-middle"></span>
                            <span class="text-gradient-base-color fs-13 alt-font fw-700 ls-05px text-uppercase align-middle">
                                {{ $opera->collezione->nome }}
                            </span>
                        </div>
                    @endif

                    {{-- Title --}}
                    <h1 class="alt-font fw-600 text-dark-gray ls-minus-2px mb-10px"
                        style="font-size: clamp(1.7rem, 3.5vw, 2.5rem); line-height: 1.15;">
                        {{ $opera->titolo }}
                    </h1>

                    {{-- Dimensions + commission --}}
                    <div class="d-flex flex-wrap gap-3 mb-0">
                        @if($opera->dimensioni)
                            <span class="text-muted alt-font fs-14">{{ $opera->dimensioni }}</span>
                        @endif
                        @if($opera->commissione)
                            <span class="text-muted alt-font fs-13">&middot; Opera su commissione</span>
                        @endif
                    </div>

                    <hr class="info-divider">

                    {{-- Price --}}
                    <div class="mb-25px">
                        @if($opera->venduto)
                            <p class="opera-sold-tag mb-4px">SOLD</p>
                            <p class="text-muted fs-13 mb-0">Quest'opera non è più disponibile</p>
                        @elseif(!is_null($opera->prezzo))
                            <p class="opera-price-tag mb-4px">{{ number_format($opera->prezzo, 2, ',', '.') }} €</p>
                            <p class="text-muted fs-13 mb-0">IVA inclusa · spedizione su richiesta</p>
                        @else
                            <p class="alt-font fs-18 text-dark-gray fw-500 mb-4px">Prezzo su richiesta</p>
                            <p class="text-muted fs-13 mb-0">Contattami per informazioni</p>
                        @endif
                    </div>

                    {{-- Description --}}
                    @if($opera->descrizione_html)
                        <hr class="info-divider">
                        <div class="opera-description mb-10px">
                            {!! $opera->descrizione_html !!}
                        </div>
                    @endif

                    <hr class="info-divider">

                    {{-- CTA --}}
                    @if(!$opera->venduto)
                        <a href="/#contatti"
                           class="btn btn-large btn-dark-gray btn-switch-text btn-box-shadow fw-400 w-100 mb-12px">
                            <span>
                                <span class="btn-double-text" data-text="Invia una richiesta">Invia una richiesta</span>
                                <span><i class="fa-regular fa-envelope"></i></span>
                            </span>
                        </a>
                    @endif
                    <a href="/opere"
                       class="btn btn-medium btn-transparent-light-gray border-1 fw-400 w-100">
                        ← Torna alle opere
                    </a>

                </div>
            </div>

        </div>
    </div>
</section>

@include('inc.front.footer')

{{-- ── Lightbox ── --}}
<div id="opera-lightbox" role="dialog" aria-modal="true" aria-label="Visualizzatore immagini">
    <button class="lb-close" onclick="closeLightbox()" aria-label="Chiudi">
        <i class="feather icon-feather-x"></i>
    </button>
    <div id="lightbox-swiper-wrap" class="swiper">
        <div class="swiper-wrapper">
            @foreach($allImages as $imgPath)
                <div class="swiper-slide">
                    <img src="{{ asset('storage/' . $imgPath) }}"
                         alt="{{ $opera->titolo }}"
                         loading="lazy" />
                </div>
            @endforeach
        </div>
        @if($hasMultiple)
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        @endif
    </div>
    @if($hasMultiple)
        <div class="lb-counter" id="lb-counter"></div>
    @endif
</div>

<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/vendors.min.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
<script>
(function () {
    var imgCount    = {{ $imgCount }};
    var hasMultiple = {{ $hasMultiple ? 'true' : 'false' }};

    /* ── Thumbnail swiper ── */
    var thumbSwiper = null;
    if (hasMultiple) {
        thumbSwiper = new Swiper('#operaThumbSwiper', {
            slidesPerView: 5,
            spaceBetween: 8,
            watchSlidesProgress: true,
            freeMode: true,
            breakpoints: {
                0:   { slidesPerView: 4, spaceBetween: 6 },
                576: { slidesPerView: 5, spaceBetween: 8 },
            }
        });
    }

    /* ── Main carousel ── */
    var mainSwiper = null;
    if (hasMultiple) {
        mainSwiper = new Swiper('#operaMainSwiper', {
            keyboard: { enabled: true, onlyInViewport: false },
            navigation: {
                nextEl: '#operaMainSwiper .swiper-button-next',
                prevEl: '#operaMainSwiper .swiper-button-prev',
            },
            pagination: {
                el: '#operaMainSwiper .swiper-pagination',
                clickable: true,
            },
            thumbs: { swiper: thumbSwiper },
        });
    }

    /* ── Lightbox swiper ── */
    var lbSwiper = new Swiper('#lightbox-swiper-wrap', {
        keyboard: { enabled: true },
        navigation: hasMultiple ? {
            nextEl: '#lightbox-swiper-wrap .swiper-button-next',
            prevEl: '#lightbox-swiper-wrap .swiper-button-prev',
        } : false,
        on: {
            slideChange: function () { updateCounter(this.activeIndex); }
        }
    });

    function updateCounter(index) {
        var el = document.getElementById('lb-counter');
        if (el) el.textContent = (index + 1) + ' / ' + imgCount;
    }

    /* ── Open lightbox ── */
    window.openLightbox = function (index) {
        document.getElementById('opera-lightbox').classList.add('open');
        document.body.style.overflow = 'hidden';
        lbSwiper.slideTo(index, 0, false);
        updateCounter(index);
    };

    /* ── Close lightbox ── */
    window.closeLightbox = function () {
        document.getElementById('opera-lightbox').classList.remove('open');
        document.body.style.overflow = '';
    };

    /* Backdrop click → close */
    document.getElementById('opera-lightbox').addEventListener('click', function (e) {
        if (e.target === this) closeLightbox();
    });

    /* Escape key → close */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeLightbox();
    });
})();
</script>
</body>
</html>
