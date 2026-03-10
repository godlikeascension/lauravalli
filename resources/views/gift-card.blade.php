<!doctype html>
<html class="no-js" lang="it">

<head>
    <title>Gift Card | Laura Valli Art</title>
    <meta name="description" content="Regala un'opera d'arte unica. Gift card Laura Valli — il regalo perfetto è quello che si sceglie col cuore.">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Luca Dei Rossi">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
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
        /* ── Perché sceglierla — dark photo section ── */
        .benefits-section {
            position: relative;
            overflow: hidden;
        }
        .benefits-section .bg-photo {
            position: absolute;
            inset: 0;
            background-image: url('/images/lauatf.jpg');
            background-size: cover;
            background-position: center top;
            z-index: 0;
        }
        .benefits-section .bg-overlay {
            position: absolute;
            inset: 0;
            background: rgba(18, 14, 10, 0.72);
            z-index: 1;
        }
        .benefits-section .container {
            position: relative;
            z-index: 2;
        }
        .benefit-card {
            padding: 32px 28px;
            border-radius: 10px;
            background: #fff;
            height: 100%;
            transition: transform .3s ease, box-shadow .3s ease;
        }
        .benefit-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 36px rgba(0,0,0,.18);
        }
        .benefit-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #f5f0ea;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
        }
        .benefit-icon i {
            font-size: 20px;
            color: #8a7560;
        }

        /* ── Value selector buttons ── */
        .valore-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 10px;
        }
        @media (min-width: 992px) {
            .valore-options { flex-wrap: nowrap; }
        }
        .valore-btn {
            flex: 1 1 auto;
            padding: 10px 14px;
            border: 1.5px solid #c8c8c8;
            border-radius: 6px;
            background: transparent;
            color: #1d1d1d;
            font-size: 14px;
            cursor: pointer;
            transition: all .2s;
            font-family: inherit;
            white-space: nowrap;
        }
        .valore-btn:hover, .valore-btn.selected {
            border-color: #1d1d1d;
            background: #1d1d1d;
            color: white;
        }
        .valore-btn.selected {
            font-weight: 600;
        }

        /* ── Loading spinner on submit ── */
        .btn-loading { opacity: .75; pointer-events: none; }
    </style>
</head>

<body data-mobile-nav-trigger-alignment="right" data-mobile-nav-style="modern" data-mobile-nav-bg-color="#1d1d1d">
@include('inc.front.header')

{{-- ══════════════════════════════════════════════════════════
     HERO
══════════════════════════════════════════════════════════ --}}
<section class="p-0 full-screen ipad-top-space-margin position-relative overflow-hidden md-h-auto">
    <div class="container-fluid p-0 h-100 position-relative">
        <div class="row h-100 g-0">
            <div class="col-xl-5 col-lg-6 d-flex justify-content-center flex-column ps-10 xxl-ps-5 xl-ps-2 md-ps-0 position-relative order-2 order-lg-1">
                <div class="border-start border-color-extra-medium-gray ps-60px ms-100px lg-ps-30px lg-ms-70px position-relative z-index-9 sm-ps-30px sm-pe-30px sm-ms-0 border-0" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay":0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <div class="mb-10px">
                        <span class="w-25px h-1px d-inline-block bg-base-color me-5px align-middle"></span>
                        <span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">Gift Card</span>
                    </div>
                    <h1 style="font-size: 3rem !important;" class="text-dark-gray fw-600 alt-font ls-minus-2px">Perché il regalo perfetto è quello che si sceglie col cuore.</h1>
                    <p class="fw-500 text-dark-gray fst-italic mb-25px fs-18">"Sorprendi chi ami con un dono che sceglierà da sé."</p>
                    <p class="w-85 mb-35px lg-w-100 sm-w-100">
                        Con una gift card puoi donare a chi ami l'esperienza di avere un'opera d'arte creata su misura, oppure permettergli di scegliere tra le opere già disponibili nella mia galleria o sul sito web.<br><br>
                        Un regalo unico, che parla all'anima, un'esperienza da vivere, un ricordo da custodire.
                    </p>
                    <a href="#acquista" class="btn btn-large btn-dark-gray">
                        Scopri come funziona <i class="feather icon-feather-arrow-down ms-10px"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6 position-relative md-h-500px order-1 order-lg-2 md-mb-50px">
                <div class="position-absolute left-0px top-0px w-100 h-100" style="background-image:url('/images/giftcard.png'); background-size:contain; background-repeat:no-repeat; background-position:center center;"></div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     COME FUNZIONA
══════════════════════════════════════════════════════════ --}}
<section class="p-0 overflow-hidden">
    <div class="container-fluid p-0">
        <div class="row g-0 align-items-stretch">
            <div class="col-xxl-7 col-lg-7 py-8 px-6 lg-py-6 lg-px-4 md-p-50px sm-p-30px text-center text-lg-start" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay":0, "staggervalue": 300, "easing": "easeOutQuad" }' style="padding: 80px 8%;">
                <span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">Come funziona</span>
                <h3 class="alt-font fw-700 text-dark-gray ls-minus-1px">Tre semplici passi per regalare un'opera d'arte</h3>

                <div class="row row-cols-1 mt-40">
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
                                <span class="d-block fw-600 text-dark-gray mb-5px fs-18">Scegli l'importo</span>
                                <p class="w-90 lg-w-100">Seleziona il valore della gift card tra le opzioni disponibili, oppure richiedi un importo personalizzato. Non c'è limite al dono.</p>
                            </div>
                        </div>
                    </div>
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
                                <span class="d-block fw-600 text-dark-gray mb-5px fs-18">Ricevi la card digitale</span>
                                <p class="w-90 lg-w-100">Dopo l'acquisto riceverai un elegante PDF via email, pronto da stampare o inoltrare direttamente al destinatario.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 process-step-style-05 position-relative hover-box xs-mb-30px">
                        <div class="process-step-item d-flex">
                            <div class="process-step-icon-wrap position-relative">
                                <div class="process-step-icon d-flex justify-content-center align-items-center mx-auto rounded-circle h-60px w-60px fs-16 bg-solitude-blue fw-600 position-relative">
                                    <span class="number position-relative z-index-1 text-dark-gray">03</span>
                                    <div class="box-overlay bg-base-color rounded-circle"></div>
                                </div>
                            </div>
                            <div class="process-content ps-30px last-paragraph-no-margin">
                                <span class="d-block fw-600 text-dark-gray mb-5px fs-18">Chi la riceve sceglie l'opera</span>
                                <p class="w-90 lg-w-100">Il destinatario potrà contattarmi per trasformare il buono in un dipinto personalizzato — se il prezzo finale sarà superiore, potrà semplicemente saldare la differenza — oppure acquistare un'opera già disponibile in galleria o sul sito.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 position-relative md-h-500px sm-h-350px">
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background-image:url('/images/giftcardsection2.jpg'); background-size:cover; background-position:center;"></div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     PERCHÉ SCEGLIERLA
══════════════════════════════════════════════════════════ --}}
<section class="big-section benefits-section">
    <div class="bg-photo"></div>
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="row mb-60px text-center" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay":0, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <div class="col-12">
                <span class="w-25px h-1px d-inline-block bg-base-color me-5px align-middle"></span>
                <span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">Perché sceglierla</span>
                <h3 class="alt-font fw-600 text-white ls-minus-1px mt-10px mb-0">Un regalo che va oltre l'oggetto</h3>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 g-4" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay":0, "staggervalue": 150, "easing": "easeOutQuad" }'>
            <div class="col">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="feather icon-feather-heart"></i>
                    </div>
                    <h5 class="alt-font fw-600 text-dark-gray mb-10px">Un dono irripetibile</h5>
                    <p class="text-medium-gray mb-0">Ogni opera è creata esclusivamente per chi la riceve. Non esiste in nessun altro posto al mondo.</p>
                </div>
            </div>
            <div class="col">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="feather icon-feather-clock"></i>
                    </div>
                    <h5 class="alt-font fw-600 text-dark-gray mb-10px">Nessuna scadenza</h5>
                    <p class="text-medium-gray mb-0">La gift card è valida per sempre. Il destinatario potrà riscattarla quando lo desidera, senza fretta.</p>
                </div>
            </div>
            <div class="col">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="feather icon-feather-star"></i>
                    </div>
                    <h5 class="alt-font fw-600 text-dark-gray mb-10px">Esperienza unica</h5>
                    <p class="text-medium-gray mb-0">Non un semplice regalo, ma un percorso creativo condiviso. Un'emozione che dura nel tempo.</p>
                </div>
            </div>
            <div class="col">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="feather icon-feather-gift"></i>
                    </div>
                    <h5 class="alt-font fw-600 text-dark-gray mb-10px">Perfetta per ogni occasione</h5>
                    <p class="text-medium-gray mb-0">Compleanni, anniversari, matrimoni, nuove nascite — ogni momento speciale merita un ricordo eterno.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     FAQ
══════════════════════════════════════════════════════════ --}}
<section class="big-section">
    <div class="container">
        <div class="row align-items-center" data-anime='{ "translateY": [0, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <div class="col-lg-7">
                <div class="mb-10px">
                    <span class="w-25px h-1px d-inline-block bg-base-color me-5px align-middle"></span>
                    <span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">Domande frequenti</span>
                </div>
                <h3 class="alt-font fw-600 text-dark-gray ls-minus-1px mb-40px">Se hai altre domande, non esitare a contattarmi</h3>

                <div class="accordion accordion-style-02" id="faq-accordion-gc" data-active-icon="icon-feather-minus" data-inactive-icon="icon-feather-plus">
                    @forelse($faqs as $faq)
                        @if($loop->first)
                        <div class="accordion-item active-accordion">
                        @else
                        <div class="accordion-item">
                        @endif
                            <div class="accordion-header border-bottom border-color-transparent-dark-very-light">
                                <a href="#" data-bs-toggle="collapse"
                                   data-bs-target="#faq-gc-{{ $faq->id }}"
                                   @if($loop->first) aria-expanded="true" @else aria-expanded="false" @endif
                                   data-bs-parent="#faq-accordion-gc">
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
                            <div id="faq-gc-{{ $faq->id }}" class="accordion-collapse collapse show" data-bs-parent="#faq-accordion-gc">
                            @else
                            <div id="faq-gc-{{ $faq->id }}" class="accordion-collapse collapse" data-bs-parent="#faq-accordion-gc">
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
            <div class="col-lg-4 offset-lg-1 md-mt-50px text-end">
                <img src="/images/opera5.jpg" class="border-radius-6px w-100" alt="">
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     ACQUISTA ORA
══════════════════════════════════════════════════════════ --}}
<section class="big-section bg-spring-wood" id="acquista">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-60px" data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay":0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <span class="w-25px h-1px d-inline-block bg-base-color me-5px align-middle"></span>
                <span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">Acquista ora</span>
                <h3 class="alt-font fw-600 text-dark-gray ls-minus-1px mt-10px mb-10px">La tua gift card, in pochi passi</h3>
                <p class="text-medium-gray fs-18 fst-italic">Un gesto semplice, un ricordo eterno.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div>

                    @if(session('gift_card_success'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            {{ session('gift_card_success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form id="gift-card-form" action="{{ route('gift-card.send') }}" method="POST">
                        @csrf

                        <div class="row justify-content-center">

                            {{-- VALORE --}}
                            <div class="col-12 mb-20px">
                                <label class="form-label alt-font fs-14 text-dark-gray">Scegli il valore della gift card</label>
                                <div class="valore-options" id="valoreOptions">
                                    <button type="button" class="valore-btn" data-value="200€ (valore minimo)">200€</button>
                                    <button type="button" class="valore-btn" data-value="500€">500€</button>
                                    <button type="button" class="valore-btn" data-value="1.000€">1.000€</button>
                                    <button type="button" class="valore-btn" data-value="1.500€">1.500€</button>
                                    <button type="button" class="valore-btn" data-value="2.000€">2.000€</button>
                                    <button type="button" class="valore-btn" data-value="Altro importo">Altro importo</button>
                                </div>
                                <input type="hidden" name="valore" id="valoreInput" value="{{ old('valore') }}" required>
                                @error('valore')
                                    <small class="text-danger d-block mt-5px">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- NOME --}}
                            <div class="col-md-6 sm-mb-20px">
                                <label class="form-label alt-font fs-14 text-dark-gray">Il tuo nome</label>
                                <input class="mb-20px border-color-transparent-dark-very-light form-control bg-transparent required @error('nome') is-invalid @enderror"
                                       type="text" name="nome"
                                       value="{{ old('nome') }}" required />
                                @error('nome')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- EMAIL --}}
                            <div class="col-md-6 sm-mb-20px">
                                <label class="form-label alt-font fs-14 text-dark-gray">Il tuo indirizzo email</label>
                                <input class="mb-20px border-color-transparent-dark-very-light form-control bg-transparent required @error('email') is-invalid @enderror"
                                       type="email" name="email"
                                       value="{{ old('email') }}" required />
                                @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- MESSAGGIO --}}
                            <div class="col-12">
                                <div class="mb-20px">
                                    <label class="form-label alt-font fs-14 text-dark-gray">Vuoi aggiungere qualcosa? (opzionale)</label>
                                    <textarea class="border-color-transparent-dark-very-light form-control bg-transparent @error('messaggio') is-invalid @enderror"
                                              name="messaggio" rows="4">{{ old('messaggio') }}</textarea>
                                    @error('messaggio')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                            </div>

                            <div class="col-12 text-center">
                                <button id="gift-card-submit" class="btn btn-large btn-dark-gray btn-box-shadow" type="submit">
                                    Invia la richiesta <i class="feather icon-feather-arrow-right ms-10px"></i>
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@include('inc.front.footer')

<!-- JavaScript -->
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/vendors.min.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
<script>
    // Value selector buttons
    var valoreInput = document.getElementById('valoreInput');
    document.querySelectorAll('.valore-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.valore-btn').forEach(function(b) { b.classList.remove('selected'); });
            btn.classList.add('selected');
            valoreInput.value = btn.getAttribute('data-value');
        });
    });

    // Pre-select if old value present
    var oldValore = valoreInput.value;
    if (oldValore) {
        document.querySelectorAll('.valore-btn').forEach(function(btn) {
            if (btn.getAttribute('data-value') === oldValore) btn.classList.add('selected');
        });
    }

    // Loading animation on submit
    document.getElementById('gift-card-form').addEventListener('submit', function(e) {
        var btn = document.getElementById('gift-card-submit');
        if (!valoreInput.value) {
            e.preventDefault();
            alert('Seleziona un valore per la gift card.');
            return;
        }
        btn.disabled = true;
        btn.classList.add('btn-loading');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-10px" role="status" aria-hidden="true"></span>Invio in corso...';
    });
</script>
</body>
</html>
