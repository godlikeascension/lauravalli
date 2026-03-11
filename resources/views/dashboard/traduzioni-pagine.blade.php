<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <title>Traduzioni — {{ ucfirst($pagina) }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="/img/favicon.png">
    <link href="/dashboard-backend/css/config/creative/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="/dashboard-backend/css/config/creative/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="/dashboard-backend/css/icons.min.css" rel="stylesheet" type="text/css" />
    <style>
        .trad-row { border-bottom: 1px solid #eee; padding: 16px 0; }
        .trad-row:last-child { border-bottom: none; }
        .trad-chiave { font-family: monospace; font-size: 13px; color: #888; margin-bottom: 6px; }
        /* Inline rich-text mini-editor */
        .rie-wrap { border: 1px solid #ced4da; border-radius: 4px; overflow: hidden; }
        .rie-toolbar { display: flex; gap: 2px; padding: 4px 6px; background: #f8f9fa; border-bottom: 1px solid #dee2e6; }
        .rie-toolbar button { background: none; border: 1px solid transparent; border-radius: 3px; padding: 1px 7px; font-size: 13px; cursor: pointer; line-height: 1.6; color: #333; }
        .rie-toolbar button:hover { background: #e9ecef; border-color: #ced4da; }
        .rie-toolbar button.rie-active { background: #d0e7ff; border-color: #86b7fe; }
        .rie-content { min-height: 38px; padding: 6px 10px; font-size: 14px; outline: none; line-height: 1.5; white-space: pre-wrap; word-break: break-word; }
        .rie-content:focus { background: #fff; }
    </style>
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
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="header-title mb-0">Traduzioni: <span class="text-primary">{{ ucfirst(str_replace('_', ' ', $pagina)) }}</span></h4>
                                    <a href="{{ route('dashboard.lingue') }}" class="btn btn-sm btn-light">
                                        <i class="mdi mdi-arrow-left"></i> Torna alle lingue
                                    </a>
                                </div>

                                <p class="text-muted mb-4">Per ogni riga puoi modificare il testo in tutte e tre le lingue.</p>

                                @if($righe->isEmpty())
                                    <div class="alert alert-warning">Nessuna chiave trovata per questa pagina. Assicurati di aver eseguito le migrazioni.</div>
                                @else
                                <form action="{{ route('dashboard.traduzioni.update', $pagina) }}" method="POST">
                                    @csrf

                                    @foreach($righe as $riga)
                                        <div class="trad-row">
                                            <div class="trad-chiave">{{ $riga->chiave }}</div>
                                            <div class="row g-2">
                                                @foreach(['it' => ['🇮🇹 IT','#1a7f3c'], 'en' => ['🇬🇧 EN','#0d6efd'], 'es' => ['🇪🇸 ES','#c0392b']] as $loc => [$label, $color])
                                                <div class="col-md-4">
                                                    <label class="form-label fw-semibold" style="font-size:13px; color:{{ $color }};">{{ $label }}</label>
                                                    <input type="hidden"
                                                           name="traduzioni[{{ $riga->chiave }}][{{ $loc }}]"
                                                           class="rie-hidden"
                                                           value="{{ $riga->{$loc} }}">
                                                    <div class="rie-wrap">
                                                        <div class="rie-toolbar">
                                                            <button type="button" data-cmd="bold"><b>B</b></button>
                                                            <button type="button" data-cmd="italic"><i>I</i></button>
                                                            <button type="button" data-cmd="underline"><u>U</u></button>
                                                            <button type="button" data-cmd="removeFormat" title="Rimuovi formattazione">✕</button>
                                                        </div>
                                                        <div class="rie-content"
                                                             contenteditable="true">{!! $riga->{$loc} !!}</div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="text-end mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-content-save"></i> Salva traduzioni
                                        </button>
                                    </div>
                                </form>
                                @endif

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
<script>
(function () {
    // Sync contenteditable → hidden input on every input event
    // Strip block-level wrappers (<p>, <div>) so content stays inline
    function syncHidden(content) {
        var wrap = content.closest('.rie-wrap').parentElement;
        var hidden = wrap.querySelector('.rie-hidden');
        var tmp = document.createElement('div');
        tmp.innerHTML = content.innerHTML;
        tmp.querySelectorAll('p, div').forEach(function (el) {
            var frag = document.createDocumentFragment();
            while (el.firstChild) frag.appendChild(el.firstChild);
            frag.appendChild(document.createElement('br'));
            el.replaceWith(frag);
        });
        // Remove trailing <br> elements
        while (tmp.lastChild && tmp.lastChild.nodeName === 'BR') {
            tmp.removeChild(tmp.lastChild);
        }
        hidden.value = tmp.innerHTML;
    }

    // On load: unwrap any <p>/<div> in existing content so stored HTML is normalised
    function unwrapBlocks(content) {
        var tmp = document.createElement('div');
        tmp.innerHTML = content.innerHTML;
        tmp.querySelectorAll('p, div').forEach(function (el) {
            var frag = document.createDocumentFragment();
            while (el.firstChild) frag.appendChild(el.firstChild);
            frag.appendChild(document.createElement('br'));
            el.replaceWith(frag);
        });
        while (tmp.lastChild && tmp.lastChild.nodeName === 'BR') {
            tmp.removeChild(tmp.lastChild);
        }
        content.innerHTML = tmp.innerHTML;
        syncHidden(content);
    }

    document.querySelectorAll('.rie-content').forEach(function (content) {
        unwrapBlocks(content);
        // Prevent Enter from inserting <div> / <p> — insert <br> instead
        content.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.execCommand('insertLineBreak');
            }
        });
        content.addEventListener('input', function () { syncHidden(content); });
    });

    document.querySelectorAll('.rie-toolbar button').forEach(function (btn) {
        btn.addEventListener('mousedown', function (e) {
            e.preventDefault(); // keep focus in the editor
            document.execCommand(btn.dataset.cmd, false, null);
            // highlight active state
            var content = btn.closest('.rie-wrap').querySelector('.rie-content');
            syncHidden(content);
        });
    });

    // Sync all before form submit (belt & suspenders)
    var form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function () {
            document.querySelectorAll('.rie-content').forEach(function (content) {
                syncHidden(content);
            });
        });
    }
})();
</script>
</body>
</html>
