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
        .trad-it { background: #f8f9fa; border-radius: 4px; padding: 8px 12px; font-size: 14px; color: #555; margin-bottom: 8px; white-space: pre-wrap; }
        textarea.form-control { font-size: 14px; resize: vertical; }
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

                                <p class="text-muted mb-4">Per ogni riga, il testo italiano è mostrato come riferimento (non modificabile qui). Compila EN e/o ES per tradurlo.</p>

                                @if($righe->isEmpty())
                                    <div class="alert alert-warning">Nessuna chiave trovata per questa pagina. Assicurati di aver eseguito le migrazioni.</div>
                                @else
                                <form action="{{ route('dashboard.traduzioni.update', $pagina) }}" method="POST">
                                    @csrf

                                    @foreach($righe as $riga)
                                        <div class="trad-row">
                                            <div class="trad-chiave">{{ $riga->chiave }}</div>
                                            <div class="trad-it">{{ $riga->it }}</div>
                                            <div class="row g-2">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold text-primary" style="font-size:13px;">🇬🇧 EN</label>
                                                    <textarea name="traduzioni[{{ $riga->chiave }}][it]" class="d-none">{{ $riga->it }}</textarea>
                                                    <textarea name="traduzioni[{{ $riga->chiave }}][en]"
                                                              rows="2"
                                                              class="form-control"
                                                              placeholder="English translation…">{{ $riga->en }}</textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold" style="font-size:13px; color:#c0392b;">🇪🇸 ES</label>
                                                    <textarea name="traduzioni[{{ $riga->chiave }}][es]"
                                                              rows="2"
                                                              class="form-control"
                                                              placeholder="Traducción al español…">{{ $riga->es }}</textarea>
                                                </div>
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
</body>
</html>
