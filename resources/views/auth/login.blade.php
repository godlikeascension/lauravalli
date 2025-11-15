<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="GAT"/>
    <meta name="description" content="GAT">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title>Accesso | GAT</title>
    <!-- Stylesheets & Fonts -->
    <link href="/auth/css/plugins.css" rel="stylesheet">
    <link href="/auth/css/style.css" rel="stylesheet">
</head>

<body>
<!-- Body Inner -->
<div class="body-inner">
    <!-- Section -->
    <section class="pt-5 pb-5" data-bg-image="/assets/img/atf1.jpg">
        <div class="container-fluid d-flex flex-column">
            <div class="row align-items-center min-vh-100">
                <div class="col-md-6 col-lg-4 mx-auto">
                    <div class="card">
                        <div class="card-body py-3 px-sm-5">
                            <div class="mb-5 text-center">
                                <img style="max-height: 50px;" src="/assets/img/logo-dark.png" alt="">
                                <h6 class="h3 mt-4 mb-1">Accedi</h6>
                                <p class="text-muted mb-0">Inserisci email e password per accedere</p>
                            </div><span class="clearfix"></span>
                            <form class="form-validate" method="post" action="{{ route('login') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
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
                                <div class="mt-4"><button type="submit" class="btn btn-primary btn-block btn-primary">Accedi</button></div>
                            </form>
{{--                            <div class="mt-4 text-center"><small>Non hai un account?</small> <a href="/registrazione" class="small fw-bold">Crealo</a>--}}
{{--                            </div>--}}

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
