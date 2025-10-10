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
    <link rel="shortcut icon" href="images/favicon.png">
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
</head>
<body data-mobile-nav-trigger-alignment="right" data-mobile-nav-style="modern" data-mobile-nav-bg-color="#1d1d1d">
@include('inc.front.header')
<!-- ATF -->
<section class="p-0 full-screen ipad-top-space-margin position-relative overflow-hidden md-h-auto">
    <div class="container-fluid p-0 h-100 position-relative">
        <div class="row h-100 g-0">
            <div class="col-xl-5 col-lg-6 d-flex justify-content-center flex-column ps-10 xxl-ps-5 xl-ps-2 md-ps-0 position-relative order-2 order-lg-1">
                <div class="border-start border-color-extra-medium-gray ps-60px ms-100px lg-ps-30px lg-ms-70px position-relative z-index-9 sm-ps-30px sm-pe-30px sm-ms-0 border-0" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay":0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h1 style="font-size: 3.5rem !important;" class="text-dark-gray fw-600 alt-font outside-box-right-10 xl-outside-box-right-15 md-me-0">Opere su commissione. <br>Dai vita alle tue emozioni.</h1>
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
                            <div class="position-absolute left-0px top-0px w-100 h-100 cover-background background-position-center-top" style="background-image:url('/images/innocenza-sospesa.jpg');"></div>
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
                <span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">Opera su commissione</span>
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
                                <span class="d-block fw-600 text-dark-gray mb-5px fs-18">Condivisione e ascolto</span>
                                <p class="w-90 lg-w-100">
                                    Il primo passo è entrare in connessione: mi racconterai ciò che vorresti esprimere, i colori che
                                    ti rappresentano, le emozioni da cui partire e le dimensioni del quadro.
                                    Nessuna pressione e senza alcun impegno: se hai le idee chiare, meraviglioso; se invece non
                                    sai da dove iniziare, ti guiderò con cura attraverso domande e ispirazioni.
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
                                <span class="d-block fw-600 text-dark-gray mb-5px fs-18">Consultazione e accordo</span>
                                <p class="w-90 lg-w-100">
                                    Prima di iniziare la commissione, riceverai un bozzetto digitale basato sulla tua ispirazione.
                                    Potrai darmi il tuo feedback e solo dopo la tua approvazione definitiva passeremo alla fase di
                                    pittura.
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
                                <p class="w-90 lg-w-100">Dopo l’approvazione del bozzetto, inizierò a dipingere ad olio.
                                    Durante la realizzazione ti invierò aggiornamenti visivi, così potrai seguire la nascita della tua
                                    opera passo dopo passo.
                                    A questo punto non saranno possibili modifiche sostanziali (solo piccoli dettagli). Eventuali
                                    richieste di cambi radicali a opera terminata comporteranno un costo aggiuntivo del +50% sul
                                    prezzo.</p>
                            </div>
                        </div>
                    </div>
                    <!-- end process step item -->
                </div>
            </div>
            <div class="col-lg-5 position-relative md-mb-30px sm-mb-15">
                <img src="/images/oltre-vuoto.jpg" class="position-relative z-index-9 top-40px" alt="">
            </div>
        </div>
    </div>
</section>
<section class="big-section bg-spring-wood">
    <div class="container">
        <div class="row">
            <div class="col-12 md-mb-50px">
                <h3 class="alt-font fw-700 ls-minus-1px text-dark-gray mb-20px">Pronto a iniziare?</h3>
                <p class="mb-30px">Compila il formulario di seguito, sarà un piacere accompagnarti in questo
                    processo!</p>
            </div>
            <div class="col-12">
                <div class="contact-form-style-05">
                    <!-- start contact form -->
                    <form action="email-templates/contact-form.php" method="post">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="mb-20px select">
                                    <select class="form-control border-color-transparent-dark-very-light bg-transparent" name="select">
                                        <option value="">Cosa ti piacerebbe che questa opera trasmettesse?</option>
                                        <option value="Haircut">Forza e rinascita</option>
                                        <option value="Hair styling">Tenerezza e dolcezza</option>
                                        <option value="Shaving">Mistero e introspezione</option>
                                        <option value="Beard sculpting">Non lo so ancora</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-20px select">
                                    <select class="form-control border-color-transparent-dark-very-light bg-transparent" name="select">
                                        <option value="">Cosa desideri che questa opera raffiguri?</option>
                                        <option value="Haircut">Un tema astratto</option>
                                        <option value="Hair styling">Un ritratto di una persona</option>
                                        <option value="Shaving">Un ritratto di animale</option>
                                        <option value="Shaving">Un paesaggio</option>
                                        <option value="Beard sculpting">Non lo so ancora</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-20px select">
                                    <select class="form-control border-color-transparent-dark-very-light bg-transparent" name="select">
                                        <option value="">Ci sono colori, che vorresti predominassero?</option>
                                        <option value="Haircut">Tonalità calde e avvolgenti</option>
                                        <option value="Hair styling">Colori freddi e profondi</option>
                                        <option value="Shaving">Entrambi</option>
                                        <option value="Beard sculpting">Non lo so ancora</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-20px select">
                                    <select class="form-control border-color-transparent-dark-very-light bg-transparent" name="select">
                                        <option value="">A chi è destinata quest’opera?</option>
                                        <option value="Haircut">Forza e rinascita</option>
                                        <option value="Hair styling">Tenerezza e dolcezza</option>
                                        <option value="Shaving">Mistero e introspezione</option>
                                        <option value="Beard sculpting">Non lo so ancora</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-20px select">
                                    <select class="form-control border-color-transparent-dark-very-light bg-transparent" name="select">
                                        <option value="">A chi è destinata quest’opera?</option>
                                        <option value="Haircut">A me stessa/o</option>
                                        <option value="Hair styling">A una persona cara (è un regalo)</option>
                                        <option value="Shaving">A uno studio o luogo di lavoro</option>
                                        <option value="Beard sculpting">Non lo so ancora</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-20px select">
                                    <select class="form-control border-color-transparent-dark-very-light bg-transparent" name="select">
                                        <option value="">Cosa ti ha spinto a richiedere un’opera su misura?</option>
                                        <option value="Haircut">Sentivo il bisogno di qualcosa che mi rappresentasse</option>
                                        <option value="Hair styling">Desidero un’opera con un significato profondo</option>
                                        <option value="Shaving">Voglio fare un regalo unico</option>
                                        <option value="Shaving">Mi ha ispirato il tuo lavoro</option>
                                        <option value="Beard sculpting">Non lo so, è stato un impulso</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 sm-mb-20px">
                                <input class="mb-20px border-color-transparent-dark-very-light form-control bg-transparent required" type="text" name="nome" placeholder="Inserisci il tuo nome*" />
                            </div>
                            <div class="col-md-3 sm-mb-20px">
                                <input class="mb-20px border-color-transparent-dark-very-light form-control bg-transparent required" type="text" name="tel" placeholder="Inserisci il tuo telefono*" />
                            </div>
                            <div class="col-md-3 sm-mb-20px">
                                <input class="mb-20px border-color-transparent-dark-very-light form-control bg-transparent required" type="email" name="email" placeholder="Inserisci la tua email*" />
                            </div>
                            <div class="col-md-3">
                                <input class="bg-transparent" type="hidden" name="redirect" value="">
                                <button class="btn btn-large btn-round-edge btn-box-shadow btn-switch-text btn-dark-gray left-icon submit w-100" type="submit">
                                        <span>
                                            <span><i class="feather icon-feather-calendar"></i></span>
                                            <span class="btn-double-text" data-text="Crea la tua arte">Crea la tua arte</span>
                                        </span>
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
                <div class="bg-linen p-9 md-p-6 xs-p-9 border-radius-6px overflow-hidden position-relative">

                    <div class="mb-10px">
                        <span class="w-25px h-1px d-inline-block bg-base-color me-5px align-middle"></span>
                        <span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">Domande frequenti</span>
                    </div>
                    <h3 class="alt-font fw-600 text-dark-gray ls-minus-1px">Se hai altre domande, non esitare a contattarmi</h3>

                    <div class="accordion accordion-style-02" id="accordion-style-02" data-active-icon="icon-feather-minus" data-inactive-icon="icon-feather-plus">

                        <!-- start accordion item -->
                        <div class="accordion-item active-accordion">
                            <div class="accordion-header border-bottom border-color-transparent-dark-very-light">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-02-01" aria-expanded="true" data-bs-parent="#accordion-style-02">
                                    <div class="accordion-title mb-0 position-relative text-dark-gray pe-30px">
                                        <i class="feather icon-feather-minus fs-20"></i>
                                        <span class="fw-500">Quanto tempo serve per una commissione?</span>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-style-02-01" class="accordion-collapse collapse show" data-bs-parent="#accordion-style-02">
                                <div class="accordion-body last-paragraph-no-margin border-bottom border-color-transparent-dark-very-light">
                                    <p class="w-90 sm-w-95 xs-w-100">
                                        Ogni opera richiede cura, tempo e presenza. La tempistica media varia da 3 a 6 settimane, in base alla complessità e alla lista d’attesa.
                                        Sarai sempre aggiornata/o su ogni fase del processo.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end accordion item -->

                        <!-- start accordion item -->
                        <div class="accordion-item">
                            <div class="accordion-header border-bottom border-color-transparent-dark-very-light">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-02-02" aria-expanded="false" data-bs-parent="#accordion-style-02">
                                    <div class="accordion-title mb-0 position-relative text-dark-gray pe-30px">
                                        <i class="feather icon-feather-plus fs-20"></i>
                                        <span class="fw-500">Posso richiedere modifiche?</span>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-style-02-02" class="accordion-collapse collapse" data-bs-parent="#accordion-style-02">
                                <div class="accordion-body last-paragraph-no-margin border-bottom border-color-transparent-dark-very-light">
                                    <p class="w-90 sm-w-95 xs-w-100">
                                        Sì. Al momento del bozzetto digitale terrò conto di tutti i tuoi input prima di iniziare l’opera originale ad olio.
                                        Durante la realizzazione ti invierò aggiornamenti e foto, così potrai seguire passo dopo passo la nascita del dipinto.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end accordion item -->

                        <!-- start accordion item -->
                        <div class="accordion-item">
                            <div class="accordion-header border-bottom border-color-transparent-dark-very-light">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-02-03" aria-expanded="false" data-bs-parent="#accordion-style-02">
                                    <div class="accordion-title mb-0 position-relative text-dark-gray pe-30px">
                                        <i class="feather icon-feather-plus fs-20"></i>
                                        <span class="fw-500">Quali misure sono disponibili?</span>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-style-02-03" class="accordion-collapse collapse" data-bs-parent="#accordion-style-02">
                                <div class="accordion-body last-paragraph-no-margin border-bottom border-color-transparent-dark-very-light">
                                    <p class="w-90 sm-w-95 xs-w-100">
                                        La dimensione minima è <strong>30 × 40 cm</strong>.<br>
                                        Al momento la più grande è <strong>240 × 120 cm</strong>.<br>
                                        Per formati personalizzati possiamo confrontarci e trovare la soluzione più adatta a te.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- end accordion item -->

                        <!-- start accordion item -->
                        <div class="accordion-item">
                            <div class="accordion-header border-bottom border-color-transparent-dark-very-light">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-02-04" aria-expanded="false" data-bs-parent="#accordion-style-02">
                                    <div class="accordion-title mb-0 position-relative text-dark-gray pe-30px">
                                        <i class="feather icon-feather-plus fs-20"></i>
                                        <span class="fw-500">Come viene spedita l’opera?</span>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-style-02-04" class="accordion-collapse collapse" data-bs-parent="#accordion-style-02">
                                <div class="accordion-body last-paragraph-no-margin border-bottom border-color-transparent-dark-very-light">
                                    <p class="w-90 sm-w-95 xs-w-100">
                                        Ogni dipinto è accuratamente protetto e spedito in tutto il mondo. Puoi scegliere tra:
                                    </p>
                                    <ul class="w-90 sm-w-95 xs-w-100 mb-0">
                                        <li>Spedizione del quadro montato (stirato sul telaio)</li>
                                        <li>Spedizione solo della tela arrotolata in un tubo in PVC</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- end accordion item -->

                        <!-- start accordion item -->
                        <div class="accordion-item">
                            <div class="accordion-header border-bottom border-color-transparent-dark-very-light">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-02-05" aria-expanded="false" data-bs-parent="#accordion-style-02">
                                    <div class="accordion-title mb-0 position-relative text-dark-gray pe-30px">
                                        <i class="feather icon-feather-plus fs-20"></i>
                                        <span class="fw-500">Prezzi indicativi</span>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-style-02-05" class="accordion-collapse collapse" data-bs-parent="#accordion-style-02">
                                <div class="accordion-body last-paragraph-no-margin border-bottom border-color-transparent-dark-very-light">
                                    <div class="w-90 sm-w-95 xs-w-100">
                                        <p class="mb-10px"><strong>Olio su tela</strong></p>
                                        <ul>
                                            <li>30 × 40 cm → 220 €</li>
                                            <li>60 × 80 cm → 450 €</li>
                                            <li>60 × 120 cm → 520 €</li>
                                            <li>120 × 120 cm → 850 €</li>
                                            <li>240 × 120 cm → 1.850 €</li>
                                        </ul>
                                        <p class="mb-10px"><strong>Olio su carta 300 g</strong></p>
                                        <ul>
                                            <li>30 × 40 cm → 150 €</li>
                                            <li>65 × 50 cm → 300 €</li>
                                        </ul>
                                        <p class="mb-0">
                                            <em>Spese di spedizione escluse.</em><br>
                                            Se desideri un formato diverso, scrivimi: creeremo insieme la soluzione perfetta.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end accordion item -->

                        <!-- start accordion item -->
                        <div class="accordion-item">
                            <div class="accordion-header border-bottom border-color-transparent">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-02-06" aria-expanded="false" data-bs-parent="#accordion-style-02">
                                    <div class="accordion-title mb-0 position-relative text-dark-gray pe-30px">
                                        <i class="feather icon-feather-plus fs-20"></i>
                                        <span class="fw-500">Modalità di pagamento</span>
                                    </div>
                                </a>
                            </div>
                            <div id="accordion-style-02-06" class="accordion-collapse collapse" data-bs-parent="#accordion-style-02">
                                <div class="accordion-body last-paragraph-no-margin border-bottom border-color-transparent">
                                    <div class="w-90 sm-w-95 xs-w-100">
                                        <p class="mb-10px">Il pagamento è diviso in 3 fasi:</p>
                                        <ul>
                                            <li><strong>30%</strong> all’ordine – per riservare la tua commissione (non rimborsabile)</li>
                                            <li><strong>30%</strong> all’inizio del lavoro – prima della fase di bozzetto</li>
                                            <li><strong>40% + spedizione</strong> – entro 7 giorni dalla consegna del dipinto</li>
                                        </ul>
                                        <p class="mb-0">
                                            Prima di iniziare riceverai via email un preventivo dettagliato da firmare e approvare.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end accordion item -->

                    </div>
                </div>
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
</body>
</html>
