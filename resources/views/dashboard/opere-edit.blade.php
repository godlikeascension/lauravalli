<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <title>Modifica Opera</title>
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
                                    <h4 class="header-title mb-0">Modifica opera #{{ $opera->id }}</h4>
                                    <a href="{{ route('dashboard.opere.index') }}" class="btn btn-sm btn-light">
                                        <i class="mdi mdi-arrow-left"></i> Torna alle opere
                                    </a>
                                </div>

                                <form action="{{ route('dashboard.opere.update', $opera->id) }}"
                                      method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label class="form-label d-block">Immagine attuale</label>
                                        @if($opera->immagine)
                                            <img src="{{ asset('storage/' . $opera->immagine) }}"
                                                 alt="Immagine opera"
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
                                        <label for="titolo" class="form-label">Titolo dell'opera</label>
                                        <input type="text"
                                               name="titolo"
                                               id="titolo"
                                               class="form-control"
                                               value="{{ old('titolo', $opera->titolo) }}"
                                               required>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="prezzo" class="form-label">Prezzo (€)</label>
                                            <input type="number"
                                                   step="0.01"
                                                   min="0"
                                                   name="prezzo"
                                                   id="prezzo"
                                                   class="form-control"
                                                   value="{{ old('prezzo', $opera->prezzo) }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="larghezza_cm" class="form-label">Larghezza (cm)</label>
                                            <input type="number"
                                                   step="0.1"
                                                   min="0"
                                                   name="larghezza_cm"
                                                   id="larghezza_cm"
                                                   class="form-control"
                                                   value="{{ old('larghezza_cm', $opera->larghezza_cm) }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="altezza_cm" class="form-label">Altezza (cm)</label>
                                            <input type="number"
                                                   step="0.1"
                                                   min="0"
                                                   name="altezza_cm"
                                                   id="altezza_cm"
                                                   class="form-control"
                                                   value="{{ old('altezza_cm', $opera->altezza_cm) }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 form-check form-switch">
                                        <input type="checkbox"
                                               name="venduto"
                                               id="venduto"
                                               value="1"
                                               class="form-check-input"
                                            {{ old('venduto', $opera->venduto) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="venduto">Opera venduta (mostra SOLD)</label>
                                    </div>

                                    <div class="mb-3 form-check form-switch">
                                        <input type="checkbox"
                                               name="commissione"
                                               id="commissione"
                                               value="1"
                                               class="form-check-input"
                                            {{ old('commissione', $opera->commissione) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="commissione">Opera su commissione</label>
                                    </div>

                                    <div class="mb-3">
                                        <label for="descrizione_html" class="form-label">
                                            Descrizione lunga (HTML)
                                        </label>
                                        <textarea name="descrizione_html"
                                                  id="descrizione_html"
                                                  rows="6"
                                                  class="form-control">{{ old('descrizione_html', $opera->descrizione_html) }}</textarea>
                                    </div>

                                    <div class="text-end">
                                        <a href="{{ route('dashboard.opere.index') }}" class="btn btn-light me-2">
                                            Annulla
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-content-save"></i> Salva modifiche
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
        .create(document.querySelector('#descrizione_html'), {
            toolbar: [
                'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'link', '|',
                'bulletedList', 'numberedList', '|',
                'removeFormat'
            ]
        })
        .catch(error => {
            console.error(error);
        });
</script>


</body>
</html>
