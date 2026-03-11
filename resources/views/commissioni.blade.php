<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}">

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
        .rec-card {
            position: relative;
            height: 520px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
        }
        .rec-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .rec-card-gradient {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.80) 0%, rgba(0,0,0,0.15) 55%, transparent 100%);
        }
        .rec-card-body {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 32px;
        }
        .rec-card-text {
            color: white;
            font-style: italic;
            line-height: 1.65;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .rec-card-nome {
            color: rgba(255,255,255,0.75);
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .rec-zoom {
            position: absolute;
            top: 16px;
            right: 16px;
            z-index: 2;
        }

        /* ── Review modal ── */
        #rec-lightbox {
            display: none; position: fixed; inset: 0; z-index: 99999;
            background: rgba(0,0,0,0.82);
            align-items: center; justify-content: center;
            padding: 20px; cursor: zoom-out;
        }
        #rec-lightbox.open { display: flex; }
        #rec-lightbox-inner {
            display: flex; background: white; border-radius: 10px;
            overflow: hidden; cursor: default;
            width: 100%; max-width: 860px; max-height: 88vh;
        }
        #rec-lightbox-img {
            width: 42%; flex-shrink: 0; object-fit: cover; display: block;
        }
        #rec-lightbox-body {
            flex: 1; padding: 48px; overflow-y: auto;
            display: flex; flex-direction: column; justify-content: center;
        }
        #rec-lightbox-text {
            font-style: italic; line-height: 1.8;
            color: var(--medium-gray); margin-bottom: 24px; font-size: 16px;
        }
        #rec-lightbox-nome {
            font-weight: 600; font-size: 16px; color: var(--dark-gray);
        }
        #rec-lightbox-close {
            position: absolute; top: 16px; right: 20px;
            background: white; border: none; border-radius: 50%;
            width: 38px; height: 38px; font-size: 20px; line-height: 1;
            cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }
        @media (max-width: 600px) {
            #rec-lightbox { align-items: flex-start; overflow-y: auto; padding: 16px; }
            #rec-lightbox-inner { flex-direction: column; max-height: none; overflow: visible; }
            #rec-lightbox-img { width: 100%; height: auto; object-fit: contain; flex-shrink: 0; }
            #rec-lightbox-body { padding: 28px 24px; }
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
                    <h1 style="font-size: 3.5rem !important;" class="text-dark-gray fw-600 alt-font outside-box-right-10 xl-outside-box-right-15 md-me-0">{!! trad('commissioni', 'hero_titolo', 'Opere su <br>commissione. <br>') !!}</h1>
                    <p class="w-75 mb-35px lg-w-90 sm-w-100">
                        {!! trad('commissioni', 'hero_intro', 'Ogni opera su commissione è una storia da raccontare. La <strong>tua</strong> storia. Che tu abbia già in mente un\'idea precisa o che tu parta solo da un\'emozione, sarò felice di accompagnarti passo dopo passo nella creazione di un dipinto unico e personalizzato.<br><br><strong>Questa pagina è uno spazio dedicato a te.</strong>') !!}
                    </p>
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
                <span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">{{ trad('commissioni', 'come_funziona_label', 'Come funziona il lavoro su commissione') }}</span>
                <h3 class="alt-font fw-700 text-dark-gray ls-minus-1px">{{ trad('commissioni', 'come_funziona_titolo', "Diamo vita a un'opera che nasce dal tuo sentire più autentico") }}</h3>

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
                                <span class="d-block fw-600 text-dark-gray mb-5px fs-18">{{ trad('commissioni', 'step1_titolo', 'Consulenza gratuita') }}</span>
                                <p class="w-90 lg-w-100">
                                    {!! trad('commissioni', 'step1_testo', 'Il primo passo è entrare in connessione: inizieremo con una chiacchierata conoscitiva, dove mi racconterai ciò che vorresti esprimere, i colori che ti rappresentano, le emozioni da cui partire e le dimensioni del quadro. Andremo dunque a definire il budget e ti guiderò con cura nella tua proposta personalizzata.') !!}
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
                                <span class="d-block fw-600 text-dark-gray mb-5px fs-18">{{ trad('commissioni', 'step2_titolo', 'Scelta di ogni dettaglio') }}</span>
                                <p class="w-90 lg-w-100">
                                    {!! trad('commissioni', 'step2_testo', 'Prima di iniziare la commissione, riceverai un bozzetto digitale basato sulla tua ispirazione. Potrai darmi il tuo feedback e solo dopo la tua approvazione definitiva passeremo alla fase di pittura.') !!}
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
                                <span class="d-block fw-600 text-dark-gray mb-5px fs-18">{{ trad('commissioni', 'step3_titolo', "Realizzazione dell'opera") }}</span>
                                <p class="w-90 lg-w-100">
                                    {!! trad('commissioni', 'step3_testo', "Dopo l'approvazione del bozzetto, inizio la lavorazione del tuo quadro ad olio. Durante la realizzazione ti invierò aggiornamenti visivi, così potrai seguire la nascita della tua opera passo dopo passo. A questo punto non saranno possibili modifiche.") !!}
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
<section class="big-section bg-linen">
    <div class="container">
        <div class="row mb-50px">
            <div class="col-12 text-center">
                <span class="w-25px h-1px d-inline-block bg-base-color me-5px align-middle"></span>
                <span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">{{ trad('commissioni', 'recensioni_label', 'Recensioni') }}</span>
                <h3 class="alt-font fw-600 text-dark-gray ls-minus-1px mt-10px mb-0">{{ trad('commissioni', 'recensioni_titolo', 'Cosa dicono di me') }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 position-relative">

                @if(isset($recensioni) && $recensioni->count())
                    <div class="swiper"
                         data-slider-options='{ "slidesPerView": 1, "spaceBetween": 24, "loop": true, "autoplay": { "delay": 8000, "disableOnInteraction": false }, "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "768": { "slidesPerView": 2 }, "1200": { "slidesPerView": 3 } }, "navigation": { "nextEl": ".rec-next", "prevEl": ".rec-prev" } }'>
                        <div class="swiper-wrapper py-10px">
                            @foreach($recensioni as $recensione)
                                @php
                                    $locale  = app()->getLocale();
                                    $imgUrl  = $recensione->immagine ? asset('storage/' . $recensione->immagine) : null;
                                    $testo   = ($locale !== 'it' && $recensione->{"testo_{$locale}"}) ? $recensione->{"testo_{$locale}"} : $recensione->testo;
                                    $nome    = ($locale !== 'it' && $recensione->{"nome_{$locale}"})  ? $recensione->{"nome_{$locale}"}  : $recensione->nome;
                                @endphp
                                <div class="swiper-slide">
                                    <div class="rec-card"
                                         data-img="{{ $imgUrl }}"
                                         data-text="{{ $testo }}"
                                         data-nome="{{ $nome }}">
                                        @if($imgUrl)
                                            <img src="{{ $imgUrl }}" alt="{{ $nome }}" class="rec-card-img">
                                        @else
                                            <div style="background:#d8d3cc; width:100%; height:100%;"></div>
                                        @endif
                                        <div class="rec-card-gradient"></div>
                                        <div class="rec-card-body">
                                            <p class="rec-card-text">"{{ $testo }}"</p>
                                            <div class="rec-card-nome">— {{ $nome }}</div>
                                        </div>
                                        <button type="button" class="btn btn-medium btn-white btn-rounded rec-zoom">
                                            {{ __('ui.ingrandisci') }} <i class="feather icon-feather-search ms-5px"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="rec-prev border-radius-100px swiper-button-prev bg-white box-shadow-small">
                        <i class="feather icon-feather-chevron-left icon-extra-medium"></i>
                    </div>
                    <div class="rec-next border-radius-100px swiper-button-next bg-white box-shadow-small">
                        <i class="feather icon-feather-chevron-right icon-extra-medium"></i>
                    </div>
                @else
                    <p class="text-center text-muted">{{ trad('commissioni', 'recensioni_vuote', 'Al momento non ci sono ancora recensioni visibili.') }}</p>
                @endif

            </div>
        </div>
    </div>
</section>
<section class="big-section bg-spring-wood">
    <div class="container">
        <div class="row">
            <div class="col-12 md-mb-50px">
                <h3 class="alt-font fw-700 ls-minus-1px text-dark-gray mb-20px">{{ trad('commissioni', 'form_titolo', 'Pronto a iniziare?') }}</h3>
                <p class="mb-30px">{{ trad('commissioni', 'form_sottotitolo', 'Compila il formulario di seguito, sarà un piacere accompagnarti in questo processo!') }}</p>
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
                        <input type="hidden" name="_locale" value="{{ app()->getLocale() }}">

                        <div class="row justify-content-center">

                            {{-- TRASMETTERE --}}
                            <div class="col-md-6">
                                <div class="mb-20px select">
                                    <label class="form-label alt-font fs-14 text-dark-gray">
                                        {{ trad('commissioni', 'label_trasmettere', 'Cosa ti piacerebbe che questa opera trasmettesse?') }}
                                    </label>
                                    <select class="form-control border-color-transparent-dark-very-light bg-transparent @error('trasmettere') is-invalid @enderror"
                                            name="trasmettere"
                                            required>
                                        <option value="">{{ __('ui.seleziona_opzione') }}</option>
                                        <option value="Forza e rinascita" {{ old('trasmettere') == 'Forza e rinascita' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_forza', 'Forza e rinascita') }}</option>
                                        <option value="Tenerezza e dolcezza" {{ old('trasmettere') == 'Tenerezza e dolcezza' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_tenerezza', 'Tenerezza e dolcezza') }}</option>
                                        <option value="Mistero e introspezione" {{ old('trasmettere') == 'Mistero e introspezione' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_mistero', 'Mistero e introspezione') }}</option>
                                        <option value="Non lo so ancora" {{ old('trasmettere') == 'Non lo so ancora' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_non_so', 'Non lo so ancora') }}</option>
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
                                        {{ trad('commissioni', 'label_raffigurare', 'Cosa desideri che questa opera raffiguri?') }}
                                    </label>
                                    <select class="form-control border-color-transparent-dark-very-light bg-transparent @error('raffigurare') is-invalid @enderror"
                                            name="raffigurare"
                                            required>
                                        <option value="">{{ __('ui.seleziona_opzione') }}</option>
                                        <option value="Tema astratto" {{ old('raffigurare') == 'Tema astratto' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_astratto', 'Un tema astratto') }}</option>
                                        <option value="Ritratto persona" {{ old('raffigurare') == 'Ritratto persona' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_ritratto_persona', 'Un ritratto di una persona') }}</option>
                                        <option value="Ritratto animale" {{ old('raffigurare') == 'Ritratto animale' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_ritratto_animale', 'Un ritratto di animale') }}</option>
                                        <option value="Paesaggio" {{ old('raffigurare') == 'Paesaggio' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_paesaggio', 'Un paesaggio') }}</option>
                                        <option value="Non lo so ancora" {{ old('raffigurare') == 'Non lo so ancora' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_non_so', 'Non lo so ancora') }}</option>
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
                                        {{ trad('commissioni', 'label_colori', 'Ci sono colori che vorresti predominassero?') }}
                                    </label>
                                    <select class="form-control border-color-transparent-dark-very-light bg-transparent @error('colori') is-invalid @enderror"
                                            name="colori"
                                            required>
                                        <option value="">{{ __('ui.seleziona_opzione') }}</option>
                                        <option value="Tonalità calde e avvolgenti" {{ old('colori') == 'Tonalità calde e avvolgenti' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_caldi', 'Tonalità calde e avvolgenti') }}</option>
                                        <option value="Colori freddi e profondi" {{ old('colori') == 'Colori freddi e profondi' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_freddi', 'Colori freddi e profondi') }}</option>
                                        <option value="Entrambi" {{ old('colori') == 'Entrambi' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_entrambi', 'Entrambi') }}</option>
                                        <option value="Non lo so ancora" {{ old('colori') == 'Non lo so ancora' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_non_so', 'Non lo so ancora') }}</option>
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
                                        {{ trad('commissioni', 'label_destinazione', 'A chi è destinata quest\'opera?') }}
                                    </label>
                                    <select class="form-control border-color-transparent-dark-very-light bg-transparent @error('destinazione') is-invalid @enderror"
                                            name="destinazione"
                                            required>
                                        <option value="">{{ __('ui.seleziona_opzione') }}</option>
                                        <option value="A me stessa/o" {{ old('destinazione') == 'A me stessa/o' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_me_stesso', 'A me stessa/o') }}</option>
                                        <option value="A una persona cara" {{ old('destinazione') == 'A una persona cara' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_persona_cara', 'A una persona cara') }}</option>
                                        <option value="Studio o luogo di lavoro" {{ old('destinazione') == 'Studio o luogo di lavoro' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_studio', 'Studio/lavoro') }}</option>
                                        <option value="Non lo so ancora" {{ old('destinazione') == 'Non lo so ancora' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_non_so', 'Non lo so ancora') }}</option>
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
                                        {{ trad('commissioni', 'label_motivo', 'Cosa ti ha spinto a richiedere un\'opera su misura?') }}
                                    </label>
                                    <select class="form-control border-color-transparent-dark-very-light bg-transparent @error('motivo') is-invalid @enderror"
                                            name="motivo"
                                            required>
                                        <option value="">{{ __('ui.seleziona_opzione') }}</option>
                                        <option value="Qualcosa che mi rappresenti" {{ old('motivo') == 'Qualcosa che mi rappresenti' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_mi_rappresenti', 'Qualcosa che mi rappresenti') }}</option>
                                        <option value="Significato profondo" {{ old('motivo') == 'Significato profondo' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_significato', 'Significato profondo') }}</option>
                                        <option value="Regalo unico" {{ old('motivo') == 'Regalo unico' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_regalo', 'Regalo unico') }}</option>
                                        <option value="Ispirato dal tuo lavoro" {{ old('motivo') == 'Ispirato dal tuo lavoro' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_ispirato', 'Ispirato dal tuo lavoro') }}</option>
                                        <option value="Impulso" {{ old('motivo') == 'Impulso' ? 'selected' : '' }}>{{ trad('commissioni', 'opt_impulso', 'Impulso') }}</option>
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
                                        {{ trad('commissioni', 'label_messaggio', 'Vuoi aggiungere qualcosa? (opzionale)') }}
                                    </label>
                                    <textarea class="border-color-transparent-dark-very-light form-control bg-transparent @error('messaggio') is-invalid @enderror"
                                              name="messaggio"
                                              rows="4"
                                              placeholder="{{ trad('commissioni', 'placeholder_messaggio', 'Raccontami la tua idea, un ricordo, un\'emozione… ogni dettaglio mi aiuta a creare qualcosa di davvero tuo.') }}">{{ old('messaggio') }}</textarea>
                                    @error('messaggio')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- NOME --}}
                            <div class="col-md-3 sm-mb-20px">
                                <label class="form-label alt-font fs-14 text-dark-gray">{{ __('ui.form_nome_label') }}</label>
                                <input class="mb-20px border-color-transparent-dark-very-light form-control bg-transparent required @error('nome') is-invalid @enderror"
                                       type="text"
                                       name="nome"
                                       placeholder="{{ __('ui.form_nome_placeholder') }}"
                                       value="{{ old('nome') }}"
                                       required />
                                @error('nome')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- TELEFONO --}}
                            <div class="col-md-3 sm-mb-20px">
                                <label class="form-label alt-font fs-14 text-dark-gray">{{ __('ui.form_telefono_label') }}</label>
                                <input class="mb-20px border-color-transparent-dark-very-light form-control bg-transparent required @error('telefono') is-invalid @enderror"
                                       type="text"
                                       name="telefono"
                                       placeholder="{{ __('ui.form_telefono_placeholder') }}"
                                       value="{{ old('telefono') }}"
                                       required />
                                @error('telefono')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- EMAIL --}}
                            <div class="col-md-3 sm-mb-20px">
                                <label class="form-label alt-font fs-14 text-dark-gray">{{ __('ui.form_email_label') }}</label>
                                <input class="mb-20px border-color-transparent-dark-very-light form-control bg-transparent required @error('email') is-invalid @enderror"
                                       type="email"
                                       name="email"
                                       placeholder="{{ __('ui.form_email_placeholder') }}"
                                       value="{{ old('email') }}"
                                       required />
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- SUBMIT --}}
                            <div class="col-md-3 mt-40px">
                                <button class="btn btn-large btn-box-shadow btn-dark-gray w-100" type="submit">
                                    {{ __('ui.invia_richiesta') }} <i class="feather icon-feather-arrow-right ms-10px"></i>
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
                    <span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">{{ trad('commissioni', 'faq_label', 'Domande frequenti') }}</span>
                </div>
                <h3 class="alt-font fw-600 text-dark-gray ls-minus-1px">{{ trad('commissioni', 'faq_titolo', 'Se hai altre domande, non esitare a contattarmi') }}</h3>

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
                                        <span class="fw-500">{{ $faq->domanda_locale }}</span>
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
                                        {!! $faq->risposta_locale !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">{{ trad('commissioni', 'faq_vuote', 'Nessuna domanda frequente al momento.') }}</p>
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


<!-- Review modal -->
<div id="rec-lightbox" onclick="closeRecLightbox()">
    <button id="rec-lightbox-close" onclick="closeRecLightbox()">&#215;</button>
    <div id="rec-lightbox-inner" onclick="event.stopPropagation()">
        <img id="rec-lightbox-img" src="" alt="">
        <div id="rec-lightbox-body">
            <p id="rec-lightbox-text"></p>
            <div id="rec-lightbox-nome"></div>
        </div>
    </div>
</div>
<script>
    function openRecModal(imgUrl, text, nome) {
        var img = document.getElementById('rec-lightbox-img');
        img.src = imgUrl || '';
        img.style.display = imgUrl ? 'block' : 'none';
        document.getElementById('rec-lightbox-text').textContent = '\u201C' + text + '\u201D';
        document.getElementById('rec-lightbox-nome').textContent = '\u2014 ' + nome;
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
    document.querySelectorAll('.rec-card').forEach(function(card) {
        card.addEventListener('click', function() {
            openRecModal(this.dataset.img, this.dataset.text, this.dataset.nome);
        });
    });
</script>
</body>
</html>
