<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="alternate" hreflang="en" href="https://egadicharterandtour.com"/>
    <link rel="alternate" hreflang="it" href="https://egadicharterandtour.com"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="Egadi Charter and Tour"/>
    <meta name="description" content="Egadi Charter and Tour">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title>Registrazione | Egadi Charter and Tour</title>
    <!-- Stylesheets & Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather">
    <link href="/auth/css/plugins.css" rel="stylesheet">
    <link href="/auth/css/style.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<!-- Body Inner -->
<div class="body-inner">
    <!-- Section -->
    <section class="pt-0 pb-0" data-bg-image="/img/cala-rossa-dark.jpg">
        <div class="container-fluid d-flex flex-column">
            <div class="row align-items-center min-vh-100">
                <div class="col-md-8 col-lg-4 mx-auto">
                    <div class="card">
                        <div class="card-body py-3 px-sm-5">
                            <div class="mb-3 text-center">
                                <img style="max-height: 40px;" src="/img/logo_blue.png" alt="">
                                <h6 class="h3 mb-1 mt-4">Registrati</h6>
                                <p class="text-muted mb-0">Scegli email e password per creare un account</p>
                            </div><span class="clearfix"></span>
                            <form class="form-validate" method="post" action="{{ route('register') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="form-group">
                                    <label for="email">Nome</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="name" placeholder="Inserisci il nome" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" name="email" placeholder="Inserisci l'email" required="">
                                        <span class="input-group-text"><i class="icon-user"></i></span>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="password">Password</label>
                                    <div class="input-group show-hide-password">
                                        <input class="form-control" name="password" placeholder="Inserisci la password" type="password" required="">
                                        <span class="input-group-text"><i class="icon-eye-off" aria-hidden="true" style="cursor: pointer;"></i></span>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="password">Ripeti password</label>
                                    <div class="input-group show-hide-password">
                                        <input class="form-control" name="password_confirmation" placeholder="Inserisci nuovamente la password" type="password" required="">
                                        <span class="input-group-text"><i class="icon-eye-off" aria-hidden="true" style="cursor: pointer;"></i></span>
                                    </div>
                                </div>
                                <div class="mt-4"><button type="submit" class="btn btn-primary btn-block">Crea Account</button></div>
                            </form>
                            <div class="mt-4 text-center"><small>Hai un account?</small> <a href="/login" class="small fw-bold">Accedi</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end: Section -->
</div>
<!-- end: Body Inner -->
<!-- Scroll top -->
<a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
<!--Plugins-->
<script src="/auth/js/jquery.js"></script>
<script src="/auth/js/plugins.js"></script>
<!--Template functions-->
<script src="/auth/js/functions.js"></script>
</body>

</html>
