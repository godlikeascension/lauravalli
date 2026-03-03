<!doctype html>
<html class="no-js" lang="it">

<head>
    <title>Collezioni | Laura Valli Art</title>
    <meta name="description" content="Esplora le collezioni di Laura Valli. Dipinti ad olio unici che danno voce all'animo umano.">

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
        /* ── Collection tab pills ── */
        .collezione-tabs {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }
        .collezione-tab-btn {
            display: inline-block;
            padding: 10px 28px;
            border: 1.5px solid #c8c8c8;
            border-radius: 50px;
            background: transparent;
            color: #1d1d1d;
            font-size: 14px;
            letter-spacing: .04em;
            cursor: pointer;
            transition: background .25s, color .25s, border-color .25s, box-shadow .25s;
            white-space: nowrap;
        }
        .collezione-tab-btn:hover {
            border-color: #1d1d1d;
            box-shadow: 0 4px 14px rgba(0,0,0,.10);
        }
        .collezione-tab-btn.active {
            background: #1d1d1d;
            color: #ffffff;
            border-color: #1d1d1d;
        }

        /* ── Opera card hover lift ── */
        .opera-card {
            transition: transform .3s ease, box-shadow .3s ease;
        }
        .opera-card:hover {
            transform: translateY(-6px);
            box-shadow: rgba(0,0,0,.22) 0 16px 40px 0, rgba(0,0,0,.06) 0 0 0 1px !important;
        }
        .opera-card img {
            display: block;
            width: 100%;
            border-radius: 4px;
        }

        /* ── Panel fade-in ── */
        .collezione-panel {
            animation: panelIn .35s ease;
        }
        @keyframes panelIn {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Empty state ── */
        .empty-collection {
            padding: 60px 20px;
            text-align: center;
            color: #9a9a9a;
            font-size: 16px;
        }

        /* ── Mobile ── */
        @media (max-width: 767px) {
            /* Riduci padding della sezione */
            section#collezioni { padding-top: 50px !important; padding-bottom: 50px !important; }
            /* Titolo sezione meno spazio sotto */
            .collezioni-heading { margin-bottom: 24px !important; }
            /* Tab pills più compatti */
            .collezione-tabs { gap: 7px; margin-bottom: 28px !important; }
            .collezione-tab-btn { padding: 8px 16px; font-size: 13px; }
            /* Meno spazio sotto ogni card */
            .opera-col { margin-bottom: 20px !important; }
            /* Info card più compatta */
            .opera-card-info { padding: 12px !important; }
        }
    </style>
</head>

<body data-mobile-nav-trigger-alignment="right" data-mobile-nav-style="modern" data-mobile-nav-bg-color="#1d1d1d">
@include('inc.front.header')


{{-- ── COLLECTIONS SECTION ── --}}
<section class="big-section ipad-top-space-margin" id="collezioni">
    <div class="container">

        {{-- Section label + heading --}}
        <div class="row">
            <div class="col-12 text-center mb-50px collezioni-heading"
                 data-anime='{ "el": "childs", "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay":0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <div class="mb-10px">
                    <span class="w-25px h-1px d-inline-block bg-base-color me-5px align-middle"></span>
                    <span class="text-gradient-base-color fs-15 alt-font fw-700 ls-05px text-uppercase d-inline-block align-middle">Le Opere</span>
                </div>
                <h2 class="alt-font fw-600 text-dark-gray ls-minus-2px mb-0">Esplora le Collezioni</h2>
            </div>
        </div>

        @if($collezioni->isEmpty())
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-muted pb-70">Le collezioni verranno presto aggiornate.</p>
                </div>
            </div>
        @else

            {{-- ── TAB PILLS ── --}}
            <div class="row">
                <div class="col-12 text-center mb-50px collezione-tabs-wrap">
                    <ul class="collezione-tabs" id="collezioneTabs" role="tablist">
                        @foreach($collezioni as $i => $col)
                            <li>
                                <button class="collezione-tab-btn alt-font {{ $i === 0 ? 'active' : '' }}"
                                        data-target="panel-{{ $col->id }}"
                                        type="button"
                                        role="tab"
                                        aria-selected="{{ $i === 0 ? 'true' : 'false' }}">
                                    {{ $col->nome }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- ── OPERA PANELS ── --}}
            @foreach($collezioni as $i => $col)
                <div id="panel-{{ $col->id }}"
                     class="collezione-panel {{ $i !== 0 ? 'd-none' : '' }}"
                     role="tabpanel">

                    {{-- Collection description --}}
                    @if($col->descrizione)
                        <div class="row mb-40px">
                            <div class="col-12">
                                <div class="text-muted">
                                    {!! $col->descrizione !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Opera grid: pick 3 or 4 columns whichever leaves fewer empty slots in the last row --}}
                    @php
                        $n    = $col->opere->count();
                        $rem3 = $n % 3 === 0 ? 0 : (3 - $n % 3);
                        $rem4 = $n % 4 === 0 ? 0 : (4 - $n % 4);
                        $xlCol = $rem4 <= $rem3 ? 'col-xl-3' : 'col-xl-4';
                    @endphp
                    <div class="row g-3 g-md-4 justify-content-center">
                        @forelse($col->opere as $opera)
                            <div class="col-12 col-md-6 col-lg-4 {{ $xlCol }} opera-col">
                                <div class="opera-card h-100"
                                     style="box-shadow: rgba(0,0,0,.12) 0 6px 24px 0, rgba(0,0,0,.05) 0 0 0 1px; border-radius: 6px; overflow: hidden; background:#fff;">
                                    {{-- Image --}}
                                    <div style="position:relative; overflow:hidden;">
                                        <img src="{{ $opera->immagine ? asset('storage/' . $opera->immagine) : '/images/placeholder.jpg' }}"
                                             alt="{{ $opera->titolo }}"
                                             loading="lazy"
                                             style="aspect-ratio:4/5; object-fit:cover; width:100%; display:block;" />

                                        {{-- Zoom overlay on hover (desktop) --}}
                                        @if($opera->immagine)
                                            <div class="opera-zoom-overlay d-none d-md-flex"
                                                 style="position:absolute; inset:0; background:rgba(0,0,0,0); display:flex; align-items:center; justify-content:center; transition:background .3s;"
                                                 onmouseenter="this.style.background='rgba(0,0,0,0.35)'; this.querySelector('button').style.opacity='1';"
                                                 onmouseleave="this.style.background='rgba(0,0,0,0)'; this.querySelector('button').style.opacity='0';">
                                                <button type="button"
                                                        class="btn btn-medium btn-white btn-rounded"
                                                        style="opacity:0; transition:opacity .3s;"
                                                        data-image="{{ asset('storage/' . $opera->immagine) }}"
                                                        onclick="openOperaLightbox(this)">
                                                    <i class="feather icon-feather-search me-5px"></i>
                                                    <span>Ingrandisci</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Info --}}
                                    <div class="p-20px opera-card-info text-center">
                                        <p class="text-dark-gray alt-font fs-16 mb-5px fw-600">
                                            {{ $opera->titolo }}
                                        </p>

                                        @if($opera->dimensioni)
                                            <p class="alt-font fs-12 text-muted mb-5px">
                                                {{ $opera->dimensioni }}
                                            </p>
                                        @endif

                                        @if($opera->venduto)
                                            <p class="mb-0 text-gradient-base-color alt-font fw-700 fs-14">
                                                SOLD
                                            </p>
                                        @elseif(!is_null($opera->prezzo))
                                            <p class="mb-0 text-dark-gray alt-font fw-500 fs-14">
                                                {{ number_format($opera->prezzo, 2, ',', '.') }} €
                                            </p>
                                        @else
                                            <p class="mb-0 text-muted fs-13">Su richiesta</p>
                                        @endif

                                        {{-- Buttons wrapper --}}
                                        <div style="margin-top: 20px;">
                                            @if($opera->immagine)
                                                <div class="d-md-none d-grid mb-15px">
                                                    <button type="button"
                                                            class="btn btn-very-small btn-dark-gray btn-rounded d-flex justify-content-center align-items-center"
                                                            data-image="{{ asset('storage/' . $opera->immagine) }}"
                                                            onclick="openOperaLightbox(this)">
                                                        <i class="feather icon-feather-search me-5px"></i>
                                                        <span>Ingrandisci</span>
                                                    </button>
                                                </div>
                                            @endif
                                            <div class="d-grid d-md-block">
                                                <a href="{{ route('opera.show', $opera->slug) }}"
                                                   class="btn btn-very-small btn-transparent-light-gray border-1 btn-rounded d-flex justify-content-center align-items-center">
                                                    <i class="feather icon-feather-arrow-right me-5px"></i>
                                                    <span>Scopri l'opera</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="empty-collection">
                                    <i class="feather icon-feather-image" style="font-size:48px; opacity:.3; display:block; margin-bottom:16px;"></i>
                                    Nessuna opera in questa collezione per ora.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach

        @endif
    </div>
</section>
{{-- ── END COLLECTIONS SECTION ── --}}

@include('inc.front.footer')

<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/vendors.min.js"></script>
<script type="text/javascript" src="/js/main.js"></script>

{{-- Smooth scroll for the hero button --}}
<script>
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            var target = document.querySelector(this.getAttribute('href'));
            if (target) { target.scrollIntoView({ behavior: 'smooth' }); }
        });
    });
</script>

{{-- ── Collection tab switching ── --}}
<script>
    (function () {
        var tabs = document.querySelectorAll('.collezione-tab-btn');
        var panels = document.querySelectorAll('.collezione-panel');

        tabs.forEach(function (btn) {
            btn.addEventListener('click', function () {
                // Deactivate all buttons
                tabs.forEach(function (b) {
                    b.classList.remove('active');
                    b.setAttribute('aria-selected', 'false');
                });
                // Hide all panels
                panels.forEach(function (p) { p.classList.add('d-none'); });

                // Activate clicked button
                btn.classList.add('active');
                btn.setAttribute('aria-selected', 'true');

                // Show target panel
                var targetId = btn.getAttribute('data-target');
                var panel = document.getElementById(targetId);
                if (panel) {
                    panel.classList.remove('d-none');
                    // Re-trigger animation by cloning
                    panel.style.animation = 'none';
                    panel.offsetHeight; // reflow
                    panel.style.animation = '';
                }
            });
        });
    })();
</script>

{{-- ── Lightbox ── --}}
<div id="opera-lightbox"
     class="d-none justify-content-center align-items-center"
     style="position:fixed; inset:0; background-color:rgba(0,0,0,0.85); z-index:9999;">
    <div class="position-relative text-center">
        <button type="button"
                onclick="closeOperaLightbox()"
                style="position:absolute; top:-18px; right:-18px; width:32px; height:32px;
                       border-radius:50%; border:none; background-color:#ffffff; color:#111;
                       display:flex; align-items:center; justify-content:center;
                       padding:0; cursor:pointer; box-shadow:0 4px 12px rgba(0,0,0,.25);">
            <i class="feather icon-feather-x" style="font-size:16px; line-height:1;"></i>
        </button>
        <img id="opera-lightbox-image"
             src="" alt=""
             style="max-width:90vw; max-height:80vh; border-radius:6px;
                    box-shadow:rgba(0,0,0,.4) 0 20px 50px;">
    </div>
</div>
<script>
    function openOperaLightbox(button) {
        var lightbox = document.getElementById('opera-lightbox');
        document.getElementById('opera-lightbox-image').src = button.getAttribute('data-image');
        lightbox.classList.remove('d-none');
        lightbox.classList.add('d-flex');
        document.body.classList.add('overflow-hidden');
    }
    function closeOperaLightbox() {
        var lightbox = document.getElementById('opera-lightbox');
        document.getElementById('opera-lightbox-image').src = '';
        lightbox.classList.remove('d-flex');
        lightbox.classList.add('d-none');
        document.body.classList.remove('overflow-hidden');
    }
    // Close on backdrop click
    document.getElementById('opera-lightbox').addEventListener('click', function (e) {
        if (e.target === this) { closeOperaLightbox(); }
    });
    // Close on Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') { closeOperaLightbox(); }
    });
</script>

</body>
</html>
