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
        /* Scoped styles for CKEditor-generated content — ensures headings and
           paragraphs match the site theme even after utility classes are stripped */
        .artist-statement-content h1,
        .artist-statement-content h2,
        .artist-statement-content h3,
        .artist-statement-content h4,
        .artist-statement-content h5,
        .artist-statement-content h6 {
            font-family: var(--alt-font);
            color: var(--dark-gray);
            font-weight: 600;
            letter-spacing: -1px;
            line-height: 1.2;
            margin-bottom: 1rem;
        }
        .artist-statement-content p {
            font-family: var(--primary-font);
            color: var(--medium-gray);
            line-height: 30px;
            margin-bottom: 25px;
        }
        .artist-statement-content img {
            width: 100%;
            height: auto;
            display: block;
        }
    </style>
</head>
<body data-mobile-nav-trigger-alignment="right" data-mobile-nav-style="modern" data-mobile-nav-bg-color="#1d1d1d">
@include('inc.front.header')

<!-- start section -->
<section style="padding-top: 160px; padding-bottom: 130px;">
    <div class="container">
        <div class="row justify-content-center artist-statement-content">
            {!! $contenuto !!}
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
