<!doctype html>
<html class="no-js" lang="it">

<head>
    <title>Laura Valli Art | Oil Paintings & Jewllery</title>
    <meta name="description" content="Meet the artist. Dipingere per dare voce all'animo umano. Scopri e acquista pezzi d'arte esclusivi">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Luca Dei Rossi">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <!-- favicon icon -->
    <link rel="shortcut icon" href="/images/favicon.png">
    <!-- google fonts preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- style sheets and font icons  -->
    <link rel="stylesheet" href="/css/vendors.min.css" />
    <link rel="stylesheet" href="/css/icon.min.css" />
    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="stylesheet" href="/css/responsive.css"/>
    <link rel="stylesheet" href="/css/branding-agency.css" />
    <link rel="stylesheet" href="/css/custom.css" />
    <meta property="og:image" content="/images/innocenza-sospesa.jpg">
    <meta property="og:image:width" content="967">
    <meta property="og:image:height" content="1000">
    <style>
        .select:after {
            top: 70% !important;
        }

        /* ── Recensioni carousel ── */
        .recensione-slide-row {
            min-height: 440px;
        }
        .recensione-img-col {
            min-height: 440px;
            position: relative;
        }
        @media (max-width: 575px) {
            .recensione-slide-row { min-height: unset; }
            .recensione-img-col  { min-height: 280px; }
        }
        .recensione-overlay {
            position: absolute; inset: 0;
            background: rgba(0,0,0,0);
            transition: background .3s;
            display: flex; align-items: center; justify-content: center;
        }
        .recensione-overlay:hover {
            background: rgba(0,0,0,0.38);
        }
        .recensione-zoom-btn {
            opacity: 0;
            transition: opacity .3s;
            pointer-events: none;
        }
        .recensione-overlay:hover .recensione-zoom-btn {
            opacity: 1;
        }
        /* always show on touch devices */
        @media (hover: none) {
            .recensione-zoom-btn { opacity: 1; pointer-events: auto; }
        }
        .recensione-text-body {
            max-height: 220px;
            overflow-y: auto;
            padding-right: 4px;
        }
        .recensione-text-body::-webkit-scrollbar { width: 4px; }
        .recensione-text-body::-webkit-scrollbar-track { background: #f0f0f0; }
        .recensione-text-body::-webkit-scrollbar-thumb { background: #ccc; border-radius: 2px; }

        /* ── Lightbox ── */
        #rec-lightbox {
            display: none; position: fixed; inset: 0; z-index: 99999;
            background: rgba(0,0,0,0.88);
            align-items: center; justify-content: center;
            cursor: zoom-out;
        }
        #rec-lightbox.open { display: flex; }
        #rec-lightbox img {
            max-width: 90vw; max-height: 90vh;
            object-fit: contain;
            box-shadow: 0 8px 48px rgba(0,0,0,0.6);
            cursor: default;
        }
        #rec-lightbox-close {
            position: absolute; top: 20px; right: 24px;
            background: white; border: none; border-radius: 50%;
            width: 40px; height: 40px; font-size: 22px; line-height: 1;
            cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }
    </style>

</head>
<body data-mobile-nav-trigger-alignment="right" data-mobile-nav-style="modern" data-mobile-nav-bg-color="#1d1d1d">
@include('inc.front.header')
<!-- ATF -->
<section class="p-0 full-screen ipad-top-space-margin position-relative overflow-hidden md-h-auto">
    <div class="container-fluid p-0 h-100 position-relative">
        <div class="row h-100 g-0">
            <div class="col-xl-5 col-lg-6 d-flex justify-content-center flex-column ps-10 xxl-ps-5 xl-ps-2 md-ps-0 position-relative order-2 order-lg-1">
                <div class="border-start border-color-extra-medium-gray ps-60px ms-100px lg-ps-30px lg-ms-70px position-relative z-index-9 sm-ps-30px sm-pe-30px sm-ms-0 border-0" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay":0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h1 style="font-size: 3.5rem !important;" class="text-dark-gray fw-600 alt-font outside-box-right-10 xl-outside-box-right-15 md-me-0">Opere su <br>commissione. <br></h1>
                    <p class="w-75 mb-35px lg-w-90 sm-w-100">
                        Ogni opera su commissione è una storia da raccontare.
                        La <strong>tua</strong> storia.
                        Che tu abbia già in mente un’idea precisa o che tu parta solo da
                        un’emozione, sarò felice di accompagnarti passo dopo passo nella creazione
                        di un dipinto unico e personalizzato.<br><br>

                        <strong>Questa pagina è uno spazio dedicato a te.</strong>
                    </p>
{{--                    <a href="#contatti" class="btn btn-extra-large border-1 btn-transparent-light-gray btn-medium left-icon btn-switch-text">--}}
{{--                            <span>--}}
{{--                                <span><i class="fa-regular fa-envelope"></i></span>--}}
{{--                                <span class="btn-double-text" data-text="Invia un messaggio">Invia un messaggio</span>--}}
{{--                            </span>--}}
{{--                    </a>--}}
                </div>
            </div>
            <div class="col-xl-7 col-lg-6 position-relative swiper-number-pagination-progress md-h-500px order-1 order-lg-2 md-mb-50px">
                <div class="swiper h-100 banner-slider" data-slider-options='{ "slidesPerView": 1, "loop": true, "pagination": { "el": ".swiper-number-line-pagination", "clickable": true }, "autoplay": { "delay": 8000, "stopOnLastSlide": true, "disableOnInteraction": false },"keyboard": { "enabled": true, "onlyInViewport": true }, "effect": "fade" }' data-swiper-number-pagination-progress="true">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="position-absolute left-0px top-0px w-100 h-100 cover-background background-position-center-top" style="background-image:url('/images/trittico-full.jpg');"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end banner -->
<section class="big-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xxl-7 col-lg-7 md-mb-15 sm-mb-20 text-center text-lg-start">
                <span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">Come funziona il lavoro su commissione</span>
                <h3 class="alt-font fw-700 text-dark-gray ls-minus-1px">Diamo vita a un'opera che nasce dal tuo sentire più autentico </h3>

                <div class="row row-cols-1 mt-40">
                    <!-- start process step item -->
                    <div class="col-12 process-step-style-05 position-relative hover-box">
                        <div class="process-step-item d-flex">
                            <div class="process-step-icon-wrap position-relative">
                                <div class="process-step-icon d-flex justify-content-center align-items-center mx-auto rounded-circle h-60px w-60px fs-16 bg-solitude-blue fw-600 position-relative">
                                    <span class="number position-relative z-index-1 text-dark-gray">01</span>
                                    <div class="box-overlay bg-base-color rounded-circle"></div>
                                </div>
                                <span class="progress-step-separator bg-dark-gray opacity-1"></span>
                            </div>
                            <div class="process-content ps-30px last-paragraph-no-margin mb-30px">
                                <span class="d-block fw-600 text-dark-gray mb-5px fs-18">Consulenza gratuita</span>
                                <p class="w-90 lg-w-100">
                                    Il primo passo è entrare in connessione: inizieremo con una chiacchierata conoscitiva, dove mi racconterai ciò che vorresti esprimere, i colori che ti rappresentano, le emozioni da cui partire e le dimensioni del quadro.
                                    Andremo dunque a  definire il budget e ti guiderò con cura nella tua proposta personalizzata.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- end process step item -->
                    <!-- start process step item -->
                    <div class="col-12 process-step-style-05 position-relative hover-box">
                        <div class="process-step-item d-flex">
                            <div class="process-step-icon-wrap position-relative">
                                <div class="process-step-icon d-flex justify-content-center align-items-center mx-auto rounded-circle h-60px w-60px fs-16 bg-solitude-blue fw-600 position-relative">
                                    <span class="number position-relative z-index-1 text-dark-gray">02</span>
                                    <div class="box-overlay bg-base-color rounded-circle"></div>
                                </div>
                                <span class="progress-step-separator bg-dark-gray opacity-1"></span>
                            </div>
                            <div class="process-content ps-30px last-paragraph-no-margin mb-30px">
                                <span class="d-block fw-600 text-dark-gray mb-5px fs-18">Scelta di ogni dettaglio</span>
                                <p class="w-90 lg-w-100">
                                    Prima di iniziare la commissione, riceverai un bozzetto digitale basato sulla tua ispirazione.
                                    Potrai darmi il tuo feedback e solo dopo la tua approvazione definitiva passeremo alla fase di pittura.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- end process step item -->
                    <!-- start process step item -->
                    <div class="col-12 process-step-style-05 position-relative hover-box xs-mb-30px">
                        <div class="process-step-item d-flex">
                            <div class="process-step-icon-wrap position-relative">
                                <div class="process-step-icon d-flex justify-content-center align-items-center mx-auto rounded-circle h-60px w-60px fs-16 bg-solitude-blue fw-600 position-relative">
                                    <span class="number position-relative z-index-1 text-dark-gray">03</span>
                                    <div class="box-overlay bg-base-color rounded-circle"></div>
                                </div>
                            </div>
                            <div class="process-content ps-30px last-paragraph-no-margin">
                                <span class="d-block fw-600 text-dark-gray mb-5px fs-18">Realizzazione dell’opera</span>
                                <p class="w-90 lg-w-100">
                                    Dopo l’approvazione del bozzetto, inizio la lavorazione del tuo quadro ad olio.
                                    Durante la realizzazione ti invierò aggiornamenti visivi, così potrai seguire la nascita della tua opera passo dopo passo.
                                    A questo punto non saranno possibili modifiche.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- end process step item -->
                </div>
            </div>
            <div class="col-lg-5 position-relative md-mb-30px sm-mb-15">
                <img src="/images/mockup2.jpg" class="position-relative z-index-9 top-40px" alt="">
            </div>
        </div>
    </div>
</section>
<section class="position-relative bg-linen overflow-hidden background-position-center-top sm-background-image-none text-dark-gray">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">Come funziona il lavoro su commissione</span>
                <h3 class="alt-font fw-700 text-dark-gray ls-minus-1px">Diamo vita a un'opera che nasce dal tuo sentire più autentico </h3>
            </div>
        </div>
        <div class="row justify-content-center align-items-center"
             data-anime='{ "el": "childs", "opacity": [0, 1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <div class="col-12 position-relative testimonials-style-12">

                @if(isset($recensioni) && $recensioni->count())
                    <div class="swiper"
                         data-slider-options='{ "slidesPerView": 1, "spaceBetween": 30, "loop": true, "autoplay": { "delay": 10000, "disableOnInteraction": false }, "keyboard": { "enabled": true, "onlyInViewport": true }, "navigation": { "nextEl": ".swiper-button-next-nav", "prevEl": ".swiper-button-previous-nav" } }'>
                        <div class="swiper-wrapper pt-20px pb-20px">

                            @foreach($recensioni as $recensione)
                                <div class="swiper-slide">
                                    <div class="row g-0 border-radius-6px overflow-hidden recensione-slide-row">

                                        {{-- Immagine --}}
                                        <div class="col-sm-5 recensione-img-col">
                                            @php $imgUrl = $recensione->immagine ? asset('storage/' . $recensione->immagine) : 'https://placehold.co/400x440'; @endphp
                                            <div class="h-100 w-100 cover-background" style="background-image: url('{{ $imgUrl }}'); min-height: inherit;"></div>
                                            <div class="recensione-overlay"
                                                 onclick="openRecLightbox('{{ $imgUrl }}')">
                                                <button type="button" class="btn btn-medium btn-white btn-rounded recensione-zoom-btn">
                                                    Ingrandisci <i class="feather icon-feather-search ms-5px"></i>
                                                </button>
                                            </div>
                                        </div>

                                        {{-- Testo --}}
                                        <div class="col-sm-7 bg-white p-9 sm-p-7 box-shadow-extra-large d-flex flex-column justify-content-center">
                                            <div>
                                                <i class="feather icon-feather-message-circle fs-40 mb-15px d-block" style="color: var(--base-color);"></i>
                                                <div class="recensione-text-body mb-20px">
                                                    <p class="mb-0">{{ $recensione->testo }}</p>
                                                </div>
                                                <div class="fs-18 fw-600 text-dark-gray">{{ $recensione->nome }}</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <!-- start slider navigation -->
                    <div class="swiper-button-next-nav border-radius-100px swiper-button-next bg-white box-shadow-small">
                        <i class="feather icon-feather-chevron-right icon-extra-medium"></i>
                    </div>
                    <div class="swiper-button-previous-nav border-radius-100px swiper-button-prev bg-white box-shadow-small">
                        <i class="feather icon-feather-chevron-left icon-extra-medium"></i>
                    </div>
                    <!-- end slider navigation -->
                @else
                    {{-- Se non ci sono recensioni, puoi lasciare vuoto o mettere un messaggio --}}
                    <p class="text-center text-muted mt-3 mb-0">
                        Al momento non ci sono ancora recensioni visibili.
                    </p>
                @endif

            </div>
        </div>
    </div>
</section>
<section class="big-section bg-spring-wood">
    <div class="container">
        <div class="row">
            <div class="col-12 md-mb-50px">
                <h3 class="alt-font fw-700 ls-minus-1px text-dark-gray mb-20px">Pronto a iniziare?</h3>
                <p class="mb-30px">Compila il formulario di seguito, sarà un piacere accompagnarti in questo processo!</p>
            </div>

            <div class="col-12">
                <div class="contact-form-style-05">

                    {{-- messaggi di successo --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- start contact form -->
                    <form id="commissioni-form"
                          action="{{ route('commissioni.send') }}"
                          method="post">
                        @csrf

                        <div class="row justify-content-center">

                            {{-- TRASMETTERE --}}
                            <div class="col-md-6">
                                <div class="mb-20px select">
                                    <label class="form-label alt-font fs-14 text-dark-gray">
                                        Cosa ti piacerebbe che questa opera trasmettesse?
                                    </label>
                                    <select class="form-control border-color-transparent-dark-very-light bg-transparent @error('trasmettere') is-invalid @enderror"
                                            name="trasmettere"
                                            required>
                                        <option value="">Seleziona un'opzione</option>
                                        <option value="Forza e rinascita" {{ old('trasmettere') == 'Forza e rinascita' ? 'selected' : '' }}>Forza e rinascita</option>
                                        <option value="Tenerezza e dolcezza" {{ old('trasmettere') == 'Tenerezza e dolcezza' ? 'selected' : '' }}>Tenerezza e dolcezza</option>
                                        <option value="Mistero e introspezione" {{ old('trasmettere') == 'Mistero e introspezione' ? 'selected' : '' }}>Mistero e introspezione</option>
                                        <option value="Non lo so ancora" {{ old('trasmettere') == 'Non lo so ancora' ? 'selected' : '' }}>Non lo so ancora</option>
                                    </select>

                                    @error('trasmettere')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- RAFFIGURARE --}}
                            <div class="col-md-6">
                                <div class="mb-20px select">
                                    <label class="form-label alt-font fs-14 text-dark-gray">
                                        Cosa desideri che questa opera raffiguri?
                                    </label>
                                    <select class="form-control border-color-transparent-dark-very-light bg-transparent @error('raffigurare') is-invalid @enderror"
                                            name="raffigurare"
                                            required>
                                        <option value="">Seleziona un'opzione</option>
                                        <option value="Tema astratto" {{ old('raffigurare') == 'Tema astratto' ? 'selected' : '' }}>Un tema astratto</option>
                                        <option value="Ritratto persona" {{ old('raffigurare') == 'Ritratto persona' ? 'selected' : '' }}>Un ritratto di una persona</option>
                                        <option value="Ritratto animale" {{ old('raffigurare') == 'Ritratto animale' ? 'selected' : '' }}>Un ritratto di animale</option>
                                        <option value="Paesaggio" {{ old('raffigurare') == 'Paesaggio' ? 'selected' : '' }}>Un paesaggio</option>
                                        <option value="Non lo so ancora" {{ old('raffigurare') == 'Non lo so ancora' ? 'selected' : '' }}>Non lo so ancora</option>
                                    </select>

                                    @error('raffigurare')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- COLORI --}}
                            <div class="col-md-6">
                                <div class="mb-20px select">
                                    <label class="form-label alt-font fs-14 text-dark-gray">
                                        Ci sono colori che vorresti predominassero?
                                    </label>
                                    <select class="form-control border-color-transparent-dark-very-light bg-transparent @error('colori') is-invalid @enderror"
                                            name="colori"
                                            required>
                                        <option value="">Seleziona un'opzione</option>
                                        <option value="Tonalità calde e avvolgenti" {{ old('colori') == 'Tonalità calde e avvolgenti' ? 'selected' : '' }}>Tonalità calde e avvolgenti</option>
                                        <option value="Colori freddi e profondi" {{ old('colori') == 'Colori freddi e profondi' ? 'selected' : '' }}>Colori freddi e profondi</option>
                                        <option value="Entrambi" {{ old('colori') == 'Entrambi' ? 'selected' : '' }}>Entrambi</option>
                                        <option value="Non lo so ancora" {{ old('colori') == 'Non lo so ancora' ? 'selected' : '' }}>Non lo so ancora</option>
                                    </select>

                                    @error('colori')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- DESTINAZIONE --}}
                            <div class="col-md-6">
                                <div class="mb-20px select">
                                    <label class="form-label alt-font fs-14 text-dark-gray">
                                        A chi è destinata quest’opera?
                                    </label>
                                    <select class="form-control border-color-transparent-dark-very-light bg-transparent @error('destinazione') is-invalid @enderror"
                                            name="destinazione"
                                            required>
                                        <option value="">Seleziona un'opzione</option>
                                        <option value="A me stessa/o" {{ old('destinazione') == 'A me stessa/o' ? 'selected' : '' }}>A me stessa/o</option>
                                        <option value="A una persona cara" {{ old('destinazione') == 'A una persona cara' ? 'selected' : '' }}>A una persona cara</option>
                                        <option value="Studio o luogo di lavoro" {{ old('destinazione') == 'Studio o luogo di lavoro' ? 'selected' : '' }}>Studio/lavoro</option>
                                        <option value="Non lo so ancora" {{ old('destinazione') == 'Non lo so ancora' ? 'selected' : '' }}>Non lo so ancora</option>
                                    </select>

                                    @error('destinazione')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- MOTIVO --}}
                            <div class="col-md-6">
                                <div class="mb-20px select">
                                    <label class="form-label alt-font fs-14 text-dark-gray">
                                        Cosa ti ha spinto a richiedere un’opera su misura?
                                    </label>
                                    <select class="form-control border-color-transparent-dark-very-light bg-transparent @error('motivo') is-invalid @enderror"
                                            name="motivo"
                                            required>
                                        <option value="">Seleziona un'opzione</option>
                                        <option value="Qualcosa che mi rappresenti" {{ old('motivo') == 'Qualcosa che mi rappresenti' ? 'selected' : '' }}>Qualcosa che mi rappresenti</option>
                                        <option value="Significato profondo" {{ old('motivo') == 'Significato profondo' ? 'selected' : '' }}>Significato profondo</option>
                                        <option value="Regalo unico" {{ old('motivo') == 'Regalo unico' ? 'selected' : '' }}>Regalo unico</option>
                                        <option value="Ispirato dal tuo lavoro" {{ old('motivo') == 'Ispirato dal tuo lavoro' ? 'selected' : '' }}>Ispirato dal tuo lavoro</option>
                                        <option value="Impulso" {{ old('motivo') == 'Impulso' ? 'selected' : '' }}>Impulso</option>
                                    </select>

                                    @error('motivo')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6"></div>

                            {{-- MESSAGGIO LIBERO --}}
                            <div class="col-12">
                                <div class="mb-20px">
                                    <label class="form-label alt-font fs-14 text-dark-gray">
                                        Vuoi aggiungere qualcosa? (opzionale)
                                    </label>
                                    <textarea class="border-color-transparent-dark-very-light form-control bg-transparent @error('messaggio') is-invalid @enderror"
                                              name="messaggio"
                                              rows="4"
                                              placeholder="Raccontami la tua idea, un ricordo, un'emozione… ogni dettaglio mi aiuta a creare qualcosa di davvero tuo.">{{ old('messaggio') }}</textarea>
                                    @error('messaggio')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- NOME --}}
                            <div class="col-md-3 sm-mb-20px">
                                <label class="form-label alt-font fs-14 text-dark-gray">Nome</label>
                                <input class="mb-20px border-color-transparent-dark-very-light form-control bg-transparent required @error('nome') is-invalid @enderror"
                                       type="text"
                                       name="nome"
                                       name="nome"
                                       value="{{ old('nome') }}"
                                       required />
                                @error('nome')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- TELEFONO --}}
                            <div class="col-md-3 sm-mb-20px">
                                <label class="form-label alt-font fs-14 text-dark-gray">Telefono</label>
                                <input class="mb-20px border-color-transparent-dark-very-light form-control bg-transparent required @error('telefono') is-invalid @enderror"
                                       type="text"
                                       name="telefono"
                                       value="{{ old('telefono') }}"
                                       required />
                                @error('telefono')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- EMAIL --}}
                            <div class="col-md-3 sm-mb-20px">
                                <label class="form-label alt-font fs-14 text-dark-gray">Email</label>
                                <input class="mb-20px border-color-transparent-dark-very-light form-control bg-transparent required @error('email') is-invalid @enderror"
                                       type="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required />
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- SUBMIT --}}
                            <div class="col-md-3 mt-40px">
                                <button class="btn btn-large btn-box-shadow btn-dark-gray w-100" type="submit">
                                    Crea la tua arte <i class="feather icon-feather-arrow-right ms-10px"></i>
                                </button>
                            </div>

                        </div>
                    </form>
                    <!-- end contact form -->
                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="container">
        <div class="row align-items-center mt-8 sm-mt-40px" data-anime='{ "translateY": [0, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <div class="col-12">
                <div class="mb-10px">
                    <span class="w-25px h-1px d-inline-block bg-base-color me-5px align-middle"></span>
                    <span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">Domande frequenti</span>
                </div>
                <h3 class="alt-font fw-600 text-dark-gray ls-minus-1px">Se hai altre domande, non esitare a contattarmi</h3>

                <div class="accordion accordion-style-02" id="accordion-style-02" data-active-icon="icon-feather-minus" data-inactive-icon="icon-feather-plus">

                    @forelse($faqs as $faq)
                        @if($loop->first)
                        <div class="accordion-item active-accordion">
                        @else
                        <div class="accordion-item">
                        @endif
                            <div class="accordion-header border-bottom border-color-transparent-dark-very-light">
                                <a href="#" data-bs-toggle="collapse"
                                   data-bs-target="#faq-{{ $faq->id }}"
                                   @if($loop->first) aria-expanded="true" @else aria-expanded="false" @endif
                                   data-bs-parent="#accordion-style-02">
                                    <div class="accordion-title mb-0 position-relative text-dark-gray pe-30px">
                                        @if($loop->first)
                                        <i class="feather icon-feather-minus fs-20"></i>
                                        @else
                                        <i class="feather icon-feather-plus fs-20"></i>
                                        @endif
                                        <span class="fw-500">{{ $faq->domanda }}</span>
                                    </div>
                                </a>
                            </div>
                            @if($loop->first)
                            <div id="faq-{{ $faq->id }}" class="accordion-collapse collapse show" data-bs-parent="#accordion-style-02">
                            @else
                            <div id="faq-{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#accordion-style-02">
                            @endif
                                <div class="accordion-body last-paragraph-no-margin border-bottom border-color-transparent-dark-very-light">
                                    <div class="w-90 sm-w-95 xs-w-100">
                                        {!! $faq->risposta_html !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Nessuna domanda frequente al momento.</p>
                    @endforelse

                </div>
            </div>
            <div class="col-12">
                <img src="/images/falborsmock.jpg" alt="">
            </div>
        </div>
    </div>
</section>

@include('inc.front.footer')
<!-- javascript libraries -->
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/vendors.min.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
<script>
    // Add smooth scrolling behavior
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
</script>


<!-- Lightbox recensioni -->
<div id="rec-lightbox" onclick="closeRecLightbox()">
    <button id="rec-lightbox-close" onclick="closeRecLightbox()">&#215;</button>
    <img id="rec-lightbox-img" src="" alt="Opera" onclick="event.stopPropagation()">
</div>
<script>
    function openRecLightbox(url) {
        document.getElementById('rec-lightbox-img').src = url;
        document.getElementById('rec-lightbox').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeRecLightbox() {
        document.getElementById('rec-lightbox').classList.remove('open');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeRecLightbox();
    });
</script>
</body>
</html>
