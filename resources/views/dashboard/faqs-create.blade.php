<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <title>Nuova FAQ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="header-title mb-0">Nuova FAQ</h4>
                                    <a href="{{ route('dashboard.faqs.index') }}" class="btn btn-sm btn-light">
                                        <i class="mdi mdi-arrow-left"></i> Torna alle FAQ
                                    </a>
                                </div>

                                <form action="{{ route('dashboard.faqs.store') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="domanda" class="form-label fw-semibold">Domanda</label>
                                        <input type="text"
                                               name="domanda"
                                               id="domanda"
                                               class="form-control"
                                               value="{{ old('domanda') }}"
                                               required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="risposta_html" class="form-label fw-semibold">Risposta (IT)</label>
                                        <textarea name="risposta_html"
                                                  id="risposta_html"
                                                  rows="8"
                                                  class="form-control">{{ old('risposta_html') }}</textarea>
                                    </div>

                                    <hr>
                                    <p class="text-muted small mb-3"><i class="mdi mdi-translate me-1"></i> Traduzioni (opzionali)</p>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">🇬🇧 Domanda EN</label>
                                            <input type="text" name="domanda_en" class="form-control" value="{{ old('domanda_en') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">🇪🇸 Domanda ES</label>
                                            <input type="text" name="domanda_es" class="form-control" value="{{ old('domanda_es') }}">
                                        </div>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">🇬🇧 Risposta EN</label>
                                            <textarea name="risposta_html_en" rows="5" class="form-control">{{ old('risposta_html_en') }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">🇪🇸 Risposta ES</label>
                                            <textarea name="risposta_html_es" rows="5" class="form-control">{{ old('risposta_html_es') }}</textarea>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="mb-3" style="max-width:160px;">
                                        <label for="ordine" class="form-label fw-semibold">Ordine</label>
                                        <input type="number"
                                               name="ordine"
                                               id="ordine"
                                               class="form-control"
                                               min="0"
                                               value="{{ old('ordine', 0) }}">
                                        <small class="text-muted">Numero più basso = prima posizione</small>
                                    </div>

                                    <div class="text-end">
                                        <a href="{{ route('dashboard.faqs.index') }}" class="btn btn-light me-2">Annulla</a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-content-save"></i> Salva
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="/dashboard-backend/js/vendor.min.js"></script>
<script src="/dashboard-backend/js/app.min.js"></script>

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#risposta_html'), {
            toolbar: [
                'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'link', '|',
                'bulletedList', 'numberedList', '|',
                'removeFormat'
            ]
        })
        .catch(error => { console.error(error); });
</script>
</body>
</html>
