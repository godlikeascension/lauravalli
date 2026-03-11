<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <title>Aggiungi Collezione</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin panel" name="description" />
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
                                    <h4 class="header-title mb-0">Aggiungi collezione</h4>
                                    <a href="{{ route('dashboard.collezioni.index') }}" class="btn btn-sm btn-light">
                                        <i class="mdi mdi-arrow-left"></i> Torna alle collezioni
                                    </a>
                                </div>

                                <form action="{{ route('dashboard.collezioni.store') }}"
                                      method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome della collezione (IT) <span class="text-danger">*</span></label>
                                        <input type="text"
                                               name="nome"
                                               id="nome"
                                               class="form-control"
                                               value="{{ old('nome') }}"
                                               required>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">🇬🇧 Nome EN</label>
                                            <input type="text" name="nome_en" class="form-control" value="{{ old('nome_en') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">🇪🇸 Nome ES</label>
                                            <input type="text" name="nome_es" class="form-control" value="{{ old('nome_es') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="descrizione" class="form-label">Descrizione (IT, opzionale)</label>
                                        <textarea name="descrizione"
                                                  id="descrizione"
                                                  rows="4"
                                                  class="form-control">{{ old('descrizione') }}</textarea>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">🇬🇧 Descrizione EN</label>
                                            <textarea name="descrizione_en" rows="4" class="form-control">{{ old('descrizione_en') }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">🇪🇸 Descrizione ES</label>
                                            <textarea name="descrizione_es" rows="4" class="form-control">{{ old('descrizione_es') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3 form-check form-switch">
                                        <input type="checkbox"
                                               name="is_featured"
                                               id="is_featured"
                                               value="1"
                                               class="form-check-input"
                                            {{ old('is_featured') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Collezione <strong>featured</strong>
                                            <small class="text-muted">(mostrata in homepage)</small>
                                        </label>
                                    </div>

                                    <div class="text-end">
                                        <a href="{{ route('dashboard.collezioni.index') }}" class="btn btn-light me-2">
                                            Annulla
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-content-save"></i> Salva collezione
                                        </button>
                                    </div>
                                </form>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->

                    </div>
                </div>

            </div> <!-- container-fluid -->
        </div> <!-- content -->
    </div> <!-- content-page -->
</div> <!-- END wrapper -->

<script src="/dashboard-backend/js/vendor.min.js"></script>
<script src="/dashboard-backend/js/app.min.js"></script>

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#descrizione'), {
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
