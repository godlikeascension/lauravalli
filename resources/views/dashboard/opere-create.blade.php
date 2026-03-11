<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <title>Aggiungi Opera</title>
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
                                    <h4 class="header-title mb-0">Aggiungi opera</h4>
                                    <a href="{{ route('dashboard.opere.index') }}" class="btn btn-sm btn-light">
                                        <i class="mdi mdi-arrow-left"></i> Torna alle opere
                                    </a>
                                </div>

                                <form action="{{ route('dashboard.opere.store') }}"
                                      method="POST"
                                      enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="immagine" class="form-label">Immagine dell'opera</label>
                                        <input type="file"
                                               name="immagine"
                                               id="immagine"
                                               class="form-control"
                                               accept="image/*">
                                        <small class="form-text text-muted">
                                            Formati supportati: jpg, png, webp. Max 4MB.
                                        </small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="titolo" class="form-label">Titolo dell'opera (IT)</label>
                                        <input type="text"
                                               name="titolo"
                                               id="titolo"
                                               class="form-control"
                                               value="{{ old('titolo') }}"
                                               required>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">🇬🇧 Titolo EN</label>
                                            <input type="text" name="titolo_en" class="form-control" value="{{ old('titolo_en') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">🇪🇸 Titolo ES</label>
                                            <input type="text" name="titolo_es" class="form-control" value="{{ old('titolo_es') }}">
                                        </div>
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
                                                   value="{{ old('prezzo') }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="larghezza_cm" class="form-label">Larghezza (cm)</label>
                                            <input type="number"
                                                   step="0.1"
                                                   min="0"
                                                   name="larghezza_cm"
                                                   id="larghezza_cm"
                                                   class="form-control"
                                                   value="{{ old('larghezza_cm') }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="altezza_cm" class="form-label">Altezza (cm)</label>
                                            <input type="number"
                                                   step="0.1"
                                                   min="0"
                                                   name="altezza_cm"
                                                   id="altezza_cm"
                                                   class="form-control"
                                                   value="{{ old('altezza_cm') }}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8 mb-3">
                                            <label for="opera_type" class="form-label">Come è fatta l'opera</label>
                                            <select name="opera_type" id="opera_type" class="form-select">
                                                <option value="">— Seleziona —</option>
                                                @foreach(['Olio su tela', 'Olio su legno', 'Olio su carta 300g'] as $tipo)
                                                    <option value="{{ $tipo }}"
                                                        {{ old('opera_type') === $tipo ? 'selected' : '' }}>
                                                        {{ $tipo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="year" class="form-label">Anno opera</label>
                                            <input type="number"
                                                   min="1800"
                                                   max="2100"
                                                   name="year"
                                                   id="year"
                                                   class="form-control"
                                                   placeholder="es. 2024"
                                                   value="{{ old('year') }}">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="collezione_id" class="form-label">Collezione</label>
                                        <select name="collezione_id" id="collezione_id" class="form-select">
                                            <option value="">— Nessuna collezione —</option>
                                            @foreach($collezioni as $collezione)
                                                <option value="{{ $collezione->id }}"
                                                    {{ old('collezione_id') == $collezione->id ? 'selected' : '' }}>
                                                    {{ $collezione->nome }}
                                                    @if($collezione->is_default) (default) @endif
                                                    @if($collezione->is_featured) (featured) @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 form-check form-switch">
                                        <input type="checkbox"
                                               name="venduto"
                                               id="venduto"
                                               value="1"
                                               class="form-check-input"
                                            {{ old('venduto') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="venduto">Opera venduta (mostra SOLD)</label>
                                    </div>

                                    <div class="mb-3 form-check form-switch">
                                        <input type="checkbox"
                                               name="commissione"
                                               id="commissione"
                                               value="1"
                                               class="form-check-input"
                                            {{ old('commissione') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="commissione">Opera su commissione</label>
                                    </div>

                                    <div class="mb-1"><label class="form-label">Descrizione</label></div>
                                    <ul class="nav nav-tabs mb-3" role="tablist">
                                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#desc-tab-it" role="tab">🇮🇹 Italiano</a></li>
                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#desc-tab-en" role="tab">🇬🇧 English</a></li>
                                        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#desc-tab-es" role="tab">🇪🇸 Español</a></li>
                                    </ul>
                                    <div class="tab-content mb-3">
                                        <div class="tab-pane fade show active" id="desc-tab-it" role="tabpanel">
                                            <textarea name="descrizione_html" id="descrizione_html" rows="6" class="form-control">{{ old('descrizione_html') }}</textarea>
                                        </div>
                                        <div class="tab-pane fade" id="desc-tab-en" role="tabpanel">
                                            <textarea name="descrizione_html_en" id="descrizione_html_en" rows="6" class="form-control">{{ old('descrizione_html_en') }}</textarea>
                                        </div>
                                        <div class="tab-pane fade" id="desc-tab-es" role="tabpanel">
                                            <textarea name="descrizione_html_es" id="descrizione_html_es" rows="6" class="form-control">{{ old('descrizione_html_es') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <a href="{{ route('dashboard.opere.index') }}" class="btn btn-light me-2">
                                            Annulla
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-content-save"></i> Salva opera
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
    var ckToolbar = ['undo', 'redo', '|', 'bold', 'italic', 'underline', 'link', '|', 'bulletedList', 'numberedList', '|', 'removeFormat'];
    ['#descrizione_html', '#descrizione_html_en', '#descrizione_html_es'].forEach(function (sel) {
        ClassicEditor.create(document.querySelector(sel), { toolbar: ckToolbar }).catch(function (e) { console.error(e); });
    });
</script>


</body>
</html>
