<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <title>Artist Statement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="/img/favicon.png">
    <link href="/dashboard-backend/css/config/creative/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="/dashboard-backend/css/config/creative/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="/dashboard-backend/css/icons.min.css" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

                        {{-- ── Editor card ── --}}
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="header-title mb-0">Artist Statement</h4>
                                    <a href="/artist-statement" target="_blank" class="btn btn-sm btn-light">
                                        <i class="mdi mdi-open-in-new"></i> Vedi pagina pubblica
                                    </a>
                                </div>

                                <form action="{{ route('dashboard.artist-statement.update') }}" method="POST">
                                    @csrf

                                    <ul class="nav nav-tabs mb-3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#tab-it" role="tab">🇮🇹 Italiano</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab-en" role="tab">🇬🇧 English</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab-es" role="tab">🇪🇸 Español</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="tab-it" role="tabpanel">
                                            <div class="mb-3">
                                                <textarea name="contenuto"
                                                          id="artist-statement-editor"
                                                          rows="30"
                                                          class="form-control">{!! old('contenuto', $contenuto) !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab-en" role="tabpanel">
                                            <div class="mb-3">
                                                <textarea name="contenuto_en"
                                                          id="artist-statement-editor-en"
                                                          rows="30"
                                                          class="form-control">{!! old('contenuto_en', $contenuto_en) !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab-es" role="tabpanel">
                                            <div class="mb-3">
                                                <textarea name="contenuto_es"
                                                          id="artist-statement-editor-es"
                                                          rows="30"
                                                          class="form-control">{!! old('contenuto_es', $contenuto_es) !!}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-content-save"></i> Salva
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- ── Upload immagine ── --}}
                        <div class="card mt-4">
                            <div class="card-body">
                                <h5 class="header-title mb-3">
                                    <i class="mdi mdi-image-plus me-1"></i> Carica un'immagine
                                </h5>
                                <p class="text-muted small mb-3">
                                    Carica un'immagine, copia l'URL e incollala nell'editor sopra con il pulsante
                                    <strong>Inserisci immagine</strong>.
                                </p>

                                <div class="d-flex align-items-start gap-3 flex-wrap">
                                    <input type="file" id="img-upload-input" accept="image/*" class="form-control" style="max-width:320px;">
                                    <button type="button" id="img-upload-btn" class="btn btn-secondary">
                                        <span id="img-upload-spinner" class="spinner-border spinner-border-sm me-1 d-none" role="status"></span>
                                        <i id="img-upload-icon" class="mdi mdi-upload me-1"></i> Carica
                                    </button>
                                </div>

                                <div id="img-upload-result" class="mt-3 d-none">
                                    <label class="form-label fw-semibold">URL immagine caricata:</label>
                                    <div class="input-group">
                                        <input type="text" id="img-upload-url" class="form-control font-monospace" readonly>
                                        <button class="btn btn-outline-secondary" type="button" id="img-copy-btn">
                                            <i class="mdi mdi-content-copy"></i> Copia
                                        </button>
                                        <button class="btn btn-primary" type="button" id="img-insert-btn">
                                            <i class="mdi mdi-image-plus"></i> Inserisci nell'editor
                                        </button>
                                    </div>
                                    <div class="mt-2">
                                        <img id="img-upload-preview" src="" alt="" style="max-height:160px; border-radius:6px; border:1px solid #dee2e6;">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Toast container --}}
<div class="position-fixed bottom-0 start-50 translate-middle-x p-3" style="z-index:9999" id="toast-container"></div>

<script src="/dashboard-backend/js/vendor.min.js"></script>
<script src="/dashboard-backend/js/app.min.js"></script>

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    function showToast(message, type) {
        var container = document.getElementById('toast-container');
        var id  = 'toast-' + Date.now();
        var bg  = type === 'success' ? 'bg-success' : 'bg-danger';
        container.insertAdjacentHTML('beforeend',
            '<div id="' + id + '" class="toast align-items-center text-white ' + bg + ' border-0" role="alert">' +
                '<div class="d-flex">' +
                    '<div class="toast-body">' + message + '</div>' +
                    '<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>' +
                '</div>' +
            '</div>'
        );
        var el = document.getElementById(id);
        var toast = new bootstrap.Toast(el, { delay: 3500 });
        toast.show();
        el.addEventListener('hidden.bs.toast', function () { el.remove(); });
    }
</script>
<script>
    // ── Custom upload adapter per CKEditor ──────────────────────────────────
    function UploadAdapter(loader) {
        this.loader = loader;
    }
    UploadAdapter.prototype.upload = function () {
        var loader = this.loader;
        return loader.file.then(function (file) {
            return new Promise(function (resolve, reject) {
                var data = new FormData();
                data.append('upload', file);
                data.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                fetch('{{ route("dashboard.upload-image") }}', { method: 'POST', body: data })
                    .then(function (r) { return r.json(); })
                    .then(function (res) {
                        if (res.url) { resolve({ default: res.url }); }
                        else { reject(res.error ? res.error.message : 'Errore upload'); }
                    })
                    .catch(reject);
            });
        });
    };
    UploadAdapter.prototype.abort = function () {};

    function UploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = function (loader) {
            return new UploadAdapter(loader);
        };
    }

    // ── CKEditor init ────────────────────────────────────────────────────────
    var editorInstance = null;
    var editorInstanceEn = null;
    var editorInstanceEs = null;

    var ckeditorConfig = {
        extraPlugins: [UploadAdapterPlugin],
        toolbar: [
            'heading', '|',
            'bold', 'italic', 'underline', 'link', '|',
            'insertImage', '|',
            'bulletedList', 'numberedList', '|',
            'blockQuote', '|',
            'undo', 'redo', '|',
            'removeFormat'
        ],
        image: {
            toolbar: ['imageTextAlternative', '|', 'imageStyle:inline', 'imageStyle:block', 'imageStyle:side']
        },
        htmlSupport: {
            allow: [{ name: /.*/, attributes: true, classes: true, styles: true }]
        }
    };

    ClassicEditor
        .create(document.querySelector('#artist-statement-editor'), ckeditorConfig)
        .then(function (editor) { editorInstance = editor; })
        .catch(function (err) { console.error(err); });

    ClassicEditor
        .create(document.querySelector('#artist-statement-editor-en'), ckeditorConfig)
        .then(function (editor) { editorInstanceEn = editor; })
        .catch(function (err) { console.error(err); });

    ClassicEditor
        .create(document.querySelector('#artist-statement-editor-es'), ckeditorConfig)
        .then(function (editor) { editorInstanceEs = editor; })
        .catch(function (err) { console.error(err); });

    // ── Standalone image uploader ────────────────────────────────────────────
    document.getElementById('img-upload-btn').addEventListener('click', function () {
        var file = document.getElementById('img-upload-input').files[0];
        if (!file) { showToast('Seleziona prima un file.', 'error'); return; }

        var btn     = document.getElementById('img-upload-btn');
        var spinner = document.getElementById('img-upload-spinner');
        var icon    = document.getElementById('img-upload-icon');

        btn.disabled = true;
        spinner.classList.remove('d-none');
        icon.classList.add('d-none');

        var data = new FormData();
        data.append('upload', file);
        data.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

        fetch('{{ route("dashboard.upload-image") }}', { method: 'POST', body: data })
            .then(function (r) { return r.json(); })
            .then(function (res) {
                if (res.url) {
                    var urlInput = document.getElementById('img-upload-url');
                    urlInput.value = res.url;
                    document.getElementById('img-upload-preview').src = res.url;
                    document.getElementById('img-upload-result').classList.remove('d-none');
                } else {
                    showToast('Errore durante l\'upload.', 'error');
                }
            })
            .catch(function () { showToast('Errore durante l\'upload.', 'error'); })
            .finally(function () {
                btn.disabled = false;
                spinner.classList.add('d-none');
                icon.classList.remove('d-none');
            });
    });

    document.getElementById('img-copy-btn').addEventListener('click', function () {
        var urlInput = document.getElementById('img-upload-url');
        navigator.clipboard.writeText(urlInput.value).then(function () {
            var btn = document.getElementById('img-copy-btn');
            btn.textContent = 'Copiato!';
            setTimeout(function () { btn.innerHTML = '<i class="mdi mdi-content-copy"></i> Copia'; }, 2000);
        });
    });

    document.getElementById('img-insert-btn').addEventListener('click', function () {
        var url = document.getElementById('img-upload-url').value;
        if (!url) return;
        var activeTab = document.querySelector('.nav-tabs .nav-link.active');
        var activeEditor = editorInstance;
        if (activeTab && activeTab.getAttribute('href') === '#tab-en') activeEditor = editorInstanceEn;
        if (activeTab && activeTab.getAttribute('href') === '#tab-es') activeEditor = editorInstanceEs;
        if (!activeEditor) return;
        activeEditor.execute('insertImage', { source: url });
        var btn = this;
        btn.innerHTML = '<i class="mdi mdi-check"></i> Inserita!';
        setTimeout(function () { btn.innerHTML = '<i class="mdi mdi-image-plus"></i> Inserisci nell\'editor'; }, 2000);
    });
</script>

</body>
</html>
