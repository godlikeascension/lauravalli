<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <title>Modifica Recensione</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin panel" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="/img/favicon.png">

    <link href="/dashboard-backend/css/config/creative/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="/dashboard-backend/css/config/creative/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                                    <h4 class="header-title mb-0">Modifica recensione #{{ $recensione->id }}</h4>
                                    <a href="{{ route('dashboard.recensioni') }}" class="btn btn-sm btn-light">
                                        <i class="mdi mdi-arrow-left"></i> Torna alle recensioni
                                    </a>
                                </div>

                                <form action="{{ route('dashboard.recensioni.update', $recensione->id) }}"
                                      method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label class="form-label d-block">Immagine attuale</label>
                                        @if($recensione->immagine)
                                            <img src="{{ asset('storage/' . $recensione->immagine) }}"
                                                 alt="Immagine recensione"
                                                 style="height: 80px; width: 80px; object-fit: cover; border-radius: 4px;">
                                        @else
                                            <span class="text-muted">Nessuna immagine</span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="immagine" class="form-label">Sostituisci immagine (opzionale)</label>
                                        <input type="file"
                                               name="immagine"
                                               id="immagine"
                                               class="form-control"
                                               accept="image/*">
                                        <small class="form-text text-muted">
                                            Lascia vuoto se non vuoi cambiare l'immagine.
                                        </small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="testo" class="form-label">Testo della recensione</label>
                                        <textarea name="testo"
                                                  id="testo"
                                                  rows="4"
                                                  class="form-control"
                                                  required>{{ old('testo', $recensione->testo) }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome di chi lascia la recensione</label>
                                        <input type="text"
                                               name="nome"
                                               id="nome"
                                               class="form-control"
                                               value="{{ old('nome', $recensione->nome) }}"
                                               required>
                                    </div>

                                    <div class="text-end">
                                        <a href="{{ route('dashboard.recensioni') }}" class="btn btn-light me-2">
                                            Annulla
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-content-save"></i> Salva modifiche
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

<script src="/dashboard-backend/js/vendor.min.js"></script>
<script src="/dashboard-backend/js/app.min.js"></script>

<script>
    (function () {
        document.querySelectorAll('.nav-item').forEach(function (el) {
            el.classList.remove('active');
        });
    })();
</script>

</body>
</html>
