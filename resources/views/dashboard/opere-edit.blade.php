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

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

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

                        {{-- ── Main form card ── --}}
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

                                    {{-- Immagine principale --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Immagine principale</label>
                                        @if($opera->immagine)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $opera->immagine) }}"
                                                     alt="Immagine opera"
                                                     id="main-img-preview"
                                                     style="height:160px; width:160px; object-fit:cover; border-radius:8px; border:1px solid #dee2e6;">
                                            </div>
                                        @else
                                            <div class="mb-2">
                                                <img src="" alt="" id="main-img-preview"
                                                     style="height:160px; width:160px; object-fit:cover; border-radius:8px; border:1px solid #dee2e6; display:none;">
                                                <span class="text-muted" id="main-img-placeholder">Nessuna immagine</span>
                                            </div>
                                        @endif
                                        <input type="file" name="immagine" id="immagine" class="form-control" accept="image/*" style="max-width:320px;">
                                        <small class="form-text text-muted">Lascia vuoto se non vuoi cambiare l'immagine.</small>
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

                                    <div class="mb-3">
                                        <label for="collezione_id" class="form-label">Collezione</label>
                                        <select name="collezione_id" id="collezione_id" class="form-select">
                                            <option value="">— Nessuna collezione —</option>
                                            @foreach($collezioni as $collezione)
                                                <option value="{{ $collezione->id }}"
                                                    {{ old('collezione_id', $opera->collezione_id) == $collezione->id ? 'selected' : '' }}>
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

                        {{-- ── Gallery card ── --}}
                        <div class="card mt-4">
                            <div class="card-body">
                                <h5 class="header-title mb-1">
                                    <i class="mdi mdi-image-multiple me-1"></i>
                                    Galleria immagini aggiuntive
                                    (<span id="gallery-count">{{ $opera->immagini->count() }}</span> / 8)
                                </h5>
                                <p class="text-muted small mb-3">
                                    Queste immagini saranno usate nella pagina dettaglio dell'opera.
                                </p>

                                <div class="row g-3" id="gallery-grid">
                                    @foreach($opera->immagini as $img)
                                    <div class="gallery-card col-6 col-md-4 col-lg-3" data-id="{{ $img->id }}">
                                        <div class="position-relative rounded overflow-hidden" style="aspect-ratio:1; border:1px solid #dee2e6;">
                                            <img src="{{ asset('storage/' . $img->path) }}"
                                                 class="w-100 h-100"
                                                 style="object-fit:cover;">
                                            <button type="button"
                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 p-0 gallery-delete-btn"
                                                    style="width:26px; height:26px; line-height:1;"
                                                    data-id="{{ $img->id }}">
                                                <i class="mdi mdi-close"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <div id="gallery-upload-section" class="mt-3 {{ $opera->immagini->count() >= 8 ? 'd-none' : '' }}">
                                    <div class="d-flex align-items-start gap-3 flex-wrap">
                                        <input type="file" id="gallery-input" accept="image/*" class="form-control" style="max-width:320px;">
                                        <button type="button" id="gallery-upload-btn" class="btn btn-secondary">
                                            <span id="gallery-spinner" class="spinner-border spinner-border-sm me-1 d-none" role="status"></span>
                                            <i id="gallery-icon" class="mdi mdi-upload me-1"></i> Carica
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

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
        .catch(error => { console.error(error); });

    // ── Main image live preview ───────────────────────────────────────────────
    document.getElementById('immagine').addEventListener('change', function () {
        var file = this.files[0];
        if (!file) return;
        var preview = document.getElementById('main-img-preview');
        var placeholder = document.getElementById('main-img-placeholder');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
        if (placeholder) placeholder.style.display = 'none';
    });

    // ── Gallery helpers ───────────────────────────────────────────────────────
    var MAX_GALLERY = 8;
    var csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function updateGallery() {
        var count = document.querySelectorAll('.gallery-card').length;
        document.getElementById('gallery-count').textContent = count;
        var uploadSection = document.getElementById('gallery-upload-section');
        if (count >= MAX_GALLERY) {
            uploadSection.classList.add('d-none');
        } else {
            uploadSection.classList.remove('d-none');
        }
    }

    // Delete extra image
    document.getElementById('gallery-grid').addEventListener('click', function (e) {
        var btn = e.target.closest('.gallery-delete-btn');
        if (!btn) return;
        if (!confirm('Eliminare questa immagine?')) return;

        var card = btn.closest('.gallery-card');
        var id   = btn.dataset.id;

        btn.disabled = true;

        fetch('{{ route("dashboard.opere.immagini.delete", [$opera->id, "__ID__"]) }}'.replace('__ID__', id), {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            if (res.ok) {
                card.remove();
                updateGallery();
            } else {
                btn.disabled = false;
                alert('Errore durante l\'eliminazione.');
            }
        })
        .catch(function () {
            btn.disabled = false;
            alert('Errore durante l\'eliminazione.');
        });
    });

    // Upload extra image
    document.getElementById('gallery-upload-btn').addEventListener('click', function () {
        var file = document.getElementById('gallery-input').files[0];
        if (!file) { alert('Seleziona un file.'); return; }

        var btn     = this;
        var spinner = document.getElementById('gallery-spinner');
        var icon    = document.getElementById('gallery-icon');

        btn.disabled = true;
        spinner.classList.remove('d-none');
        icon.classList.add('d-none');

        var data = new FormData();
        data.append('immagine', file);
        data.append('_token', csrf);

        fetch('{{ route("dashboard.opere.immagini.add", $opera->id) }}', {
            method: 'POST',
            body: data
        })
        .then(function (r) { return r.json(); })
        .then(function (res) {
            if (res.url) {
                var grid = document.getElementById('gallery-grid');
                var card = document.createElement('div');
                card.className = 'gallery-card col-6 col-md-4 col-lg-3';
                card.dataset.id = res.id;
                card.innerHTML =
                    '<div class="position-relative rounded overflow-hidden" style="aspect-ratio:1; border:1px solid #dee2e6;">' +
                        '<img src="' + res.url + '" class="w-100 h-100" style="object-fit:cover;">' +
                        '<button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 p-0 gallery-delete-btn" style="width:26px; height:26px; line-height:1;" data-id="' + res.id + '">' +
                            '<i class="mdi mdi-close"></i>' +
                        '</button>' +
                    '</div>';
                grid.appendChild(card);
                document.getElementById('gallery-input').value = '';
                updateGallery();
            } else {
                alert(res.error || 'Errore durante l\'upload.');
            }
        })
        .catch(function () { alert('Errore durante l\'upload.'); })
        .finally(function () {
            btn.disabled = false;
            spinner.classList.add('d-none');
            icon.classList.remove('d-none');
        });
    });
</script>

</body>
</html>
