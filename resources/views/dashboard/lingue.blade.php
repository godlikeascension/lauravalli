<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <title>Gestione Lingue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="/img/favicon.png">
    <link href="/dashboard-backend/css/config/creative/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="/dashboard-backend/css/config/creative/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
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
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Gestione Lingue</h4>
                                <p class="text-muted mb-4">Attiva o disattiva le lingue disponibili sul sito. Il selettore di lingua apparirà in navbar solo quando almeno una lingua è attiva.</p>

                                <form action="{{ route('dashboard.lingue.update') }}" method="POST">
                                    @csrf

                                    <div class="mb-3 form-check form-switch">
                                        <input type="checkbox"
                                               name="lingua_en"
                                               id="lingua_en"
                                               class="form-check-input"
                                               {{ $lingua_en === '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="lingua_en">
                                            🇬🇧 Inglese (EN) — attiva il percorso <code>/en/...</code>
                                        </label>
                                    </div>

                                    <div class="mb-4 form-check form-switch">
                                        <input type="checkbox"
                                               name="lingua_es"
                                               id="lingua_es"
                                               class="form-check-input"
                                               {{ $lingua_es === '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="lingua_es">
                                            🇪🇸 Spagnolo (ES) — attiva il percorso <code>/es/...</code>
                                        </label>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="mdi mdi-content-save"></i> Salva impostazioni
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-body">
                                <h5 class="header-title mb-3">Traduzioni pagine</h5>
                                <p class="text-muted mb-3">Clicca su una pagina per modificare i testi tradotti in inglese e spagnolo.</p>
                                <div class="list-group">
                                    @foreach(['navbar' => 'Navbar', 'home' => 'Homepage', 'opere' => 'Opere (collezioni)', 'commissioni' => 'Commissioni', 'commissioni_grazie' => 'Commissioni — pagina grazie', 'gift_card' => 'Gift Card'] as $slug => $nome)
                                        <a href="{{ route('dashboard.traduzioni.edit', $slug) }}"
                                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            {{ $nome }}
                                            <i class="mdi mdi-chevron-right"></i>
                                        </a>
                                    @endforeach
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
</body>
</html>
