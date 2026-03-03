<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <title>FAQ</title>
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

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="header-title mb-0">FAQ</h4>
                                    <a href="{{ route('dashboard.faqs.create') }}" class="btn btn-sm btn-primary">
                                        <i class="mdi mdi-plus"></i> Nuova FAQ
                                    </a>
                                </div>

                                <p class="text-muted small mb-3">L'ordine determina la sequenza di visualizzazione nella pagina commissioni.</p>

                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th style="width:60px">Ordine</th>
                                            <th>Domanda</th>
                                            <th style="width:140px">Azioni</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($faqs as $faq)
                                            <tr>
                                                <td class="text-muted">{{ $faq->ordine }}</td>
                                                <td>{{ $faq->domanda }}</td>
                                                <td>
                                                    <a href="{{ route('dashboard.faqs.edit', $faq->id) }}"
                                                       class="btn btn-sm btn-light me-1">
                                                        <i class="mdi mdi-pencil"></i> Modifica
                                                    </a>
                                                    <form action="{{ route('dashboard.faqs.destroy', $faq->id) }}"
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('Eliminare questa FAQ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-4">Nessuna FAQ presente.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
