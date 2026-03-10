<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <title>Tutte le Collezioni</title>
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

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="header-title mb-0">Tutte le collezioni</h4>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('dashboard.collezioni.ordina') }}"
                                           class="btn btn-sm btn-secondary waves-effect waves-light">
                                            <i class="mdi mdi-drag-vertical" style="margin-right: 6px;"></i>
                                            Ordina
                                        </a>
                                        <a href="{{ route('dashboard.collezioni.create') }}"
                                           class="btn btn-sm btn-blue waves-effect waves-light">
                                            <i class="mdi mdi-plus-circle" style="margin-right: 6px;"></i>
                                            Aggiungi collezione
                                        </a>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover m-0 table-centered nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th>Ordine</th>
                                            <th>Nome</th>
                                            <th>Opere</th>
                                            <th>Featured</th>
                                            <th>Azioni</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($collezioni as $collezione)
                                            <tr>
                                                <td class="text-muted text-center">{{ $collezione->ordine }}</td>
                                                <td>{{ $collezione->nome }}</td>
                                                <td class="text-center">{{ $collezione->opere()->count() }}</td>
                                                <td>
                                                    @if($collezione->is_featured)
                                                        <span class="badge bg-primary">Featured</span>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('dashboard.collezioni.edit', $collezione->id) }}"
                                                       class="btn btn-xs btn-primary">
                                                        <i class="mdi mdi-pencil"></i> Modifica
                                                    </a>

                                                    <form action="{{ route('dashboard.collezioni.destroy', $collezione->id) }}"
                                                          method="POST"
                                                          style="display: inline-block;"
                                                          onsubmit="return confirm('Sei sicuro di voler eliminare questa collezione?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-xs btn-danger">
                                                            <i class="mdi mdi-delete"></i> Elimina
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">
                                                    Nessuna collezione presente.
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>

                            </div> <!-- end card-body -->
                        </div> <!-- end card -->

                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- container-fluid -->
        </div> <!-- content -->
    </div> <!-- content-page -->
</div> <!-- END wrapper -->

<script src="/dashboard-backend/js/vendor.min.js"></script>
<script src="/dashboard-backend/js/app.min.js"></script>

</body>
</html>
