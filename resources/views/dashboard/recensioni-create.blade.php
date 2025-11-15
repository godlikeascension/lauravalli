<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <title>Aggiungi Recensione</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin panel" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="/img/favicon.png">

    <!-- App css -->
    <link href="/dashboard-backend/css/config/creative/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="/dashboard-backend/css/config/creative/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- icons -->
    <link href="/dashboard-backend/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="loading" data-layout-mode="horizontal"
      data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": {"color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": false}'>

<div id="wrapper">
    @include('inc.auth.navbar')

    <div class="content-page">
        <div class="content">

            <div class="container-fluid">

                <div class="row mt-4">
                    <div class="col-12">

                        {{-- Errori validazione --}}
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $errore)
                                        <li>{{ $errore }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="header-title mb-0">Aggiungi recensione</h4>
                                    <a href="{{ route('dashboard.recensioni') }}" class="btn btn-sm btn-light">
                                        <i class="mdi mdi-arrow-left"></i> Torna alle recensioni
                                    </a>
                                </div>

                                <form action="{{ route('dashboard.recensioni.store') }}"
                                      method="POST"
                                      enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="immagine" class="form-label">Immagine dell'opera (opzionale)</label>
                                        <input type="file"
                                               name="immagine"
                                               id="immagine"
                                               class="form-control"
                                               accept="image/*">
                                        <small class="form-text text-muted">
                                            Formati supportati: jpg, png, webp. Max 2MB.
                                        </small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="testo" class="form-label">Testo della recensione</label>
                                        <textarea name="testo"
                                                  id="testo"
                                                  rows="4"
                                                  class="form-control"
                                                  required>{{ old('testo') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome di chi lascia la recensione</label>
                                        <input type="text"
                                               name="nome"
                                               id="nome"
                                               class="form-control"
                                               value="{{ old('nome') }}"
                                               required>
                                    </div>

                                    <div class="text-end">
                                        <a href="{{ route('dashboard.recensioni') }}" class="btn btn-light me-2">
                                            Annulla
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-content-save"></i> Salva recensione
                                        </button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div> <!-- end card -->

                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- container-fluid -->

        </div> <!-- content -->
    </div> <!-- content-page -->
</div> <!-- END wrapper -->

<!-- Vendor js -->
<script src="/dashboard-backend/js/vendor.min.js"></script>
<!-- App js -->
<script src="/dashboard-backend/js/app.min.js"></script>

<script>
    (function () {
        // se vuoi evidenziare voce di menu, fallo qui
        document.querySelectorAll('.nav-item').forEach(function (el) {
            el.classList.remove('active');
        });
    })();
</script>

</body>
</html>
