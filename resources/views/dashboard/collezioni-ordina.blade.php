<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <title>Ordina Collezioni</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="/img/favicon.png">
    <link href="/dashboard-backend/css/config/creative/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="/dashboard-backend/css/config/creative/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/dashboard-backend/css/icons.min.css" rel="stylesheet" type="text/css" />
    <style>
        #sortable-list { list-style: none; padding: 0; margin: 0; }
        .sortable-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            background: #fff;
            border: 1px solid #e3e6f0;
            border-radius: 6px;
            margin-bottom: 8px;
            cursor: grab;
            transition: box-shadow .15s, background .15s;
            user-select: none;
        }
        .sortable-item:active { cursor: grabbing; }
        .sortable-item.sortable-ghost { background: #f0f4ff; box-shadow: 0 0 0 2px #4e73df44; }
        .sortable-item .drag-handle { color: #adb5bd; font-size: 20px; flex-shrink: 0; }
        .sortable-item .item-name { font-weight: 500; flex: 1; }
        .sortable-item .item-count { color: #6c757d; font-size: 13px; white-space: nowrap; }
        #save-btn { min-width: 140px; }
        #save-feedback { display: none; }
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
                    <div class="col-12 col-md-8 col-lg-6">

                        <div class="card">
                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="header-title mb-0">Ordina le collezioni</h4>
                                    <a href="{{ route('dashboard.collezioni.index') }}" class="btn btn-sm btn-light">
                                        <i class="mdi mdi-arrow-left"></i> Torna
                                    </a>
                                </div>

                                <p class="text-muted small mb-3">Trascina le collezioni per cambiarne l'ordine, poi clicca <strong>Salva ordine</strong>.</p>

                                <ul id="sortable-list">
                                    @foreach($collezioni as $col)
                                        <li class="sortable-item" data-id="{{ $col->id }}">
                                            <i class="mdi mdi-drag-vertical drag-handle"></i>
                                            <span class="item-name">{{ $col->nome }}</span>
                                            <span class="item-count">{{ $col->opere()->count() }} opere</span>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="mt-4 d-flex align-items-center gap-3">
                                    <button id="save-btn" class="btn btn-primary">
                                        <i class="mdi mdi-content-save"></i> Salva ordine
                                    </button>
                                    <span id="save-feedback" class="text-success">
                                        <i class="mdi mdi-check-circle"></i> Ordine salvato!
                                    </span>
                                </div>

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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
    var sortable = Sortable.create(document.getElementById('sortable-list'), {
        animation: 150,
        ghostClass: 'sortable-ghost',
        handle: '.drag-handle',
        dataIdAttr: 'data-id'
    });

    document.getElementById('save-btn').addEventListener('click', function () {
        var orderedIds = sortable.toArray().map(function (id) {
            return parseInt(id);
        });

        var btn = this;
        btn.disabled = true;

        fetch('{{ route('dashboard.collezioni.salva-ordine') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ ordine: orderedIds })
        })
        .then(function (res) { return res.json(); })
        .then(function (data) {
            btn.disabled = false;
            if (data.success) {
                var fb = document.getElementById('save-feedback');
                fb.style.display = 'inline';
                setTimeout(function () { fb.style.display = 'none'; }, 2500);
            }
        })
        .catch(function () { btn.disabled = false; });
    });
</script>

</body>
</html>
