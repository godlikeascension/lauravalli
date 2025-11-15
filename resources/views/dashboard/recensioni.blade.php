<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8" />
    <title>Tutte le Recensioni</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin panel" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/img/favicon.png">

    <!-- App css -->
    <link href="/dashboard-backend/css/config/creative/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="/dashboard-backend/css/config/creative/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- icons -->
    <link href="/dashboard-backend/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="loading" data-layout-mode="horizontal" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": {"color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": false}'>

<!-- Begin page -->
<div id="wrapper">
    @include('inc.auth.navbar')

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">

                <div class="row mt-4">
                    <div class="col-12">

                        {{-- Messaggi di successo/errore --}}
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
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <a href="{{ route('dashboard.recensioni.create') }}"
                                           class="btn btn-sm btn-blue waves-effect waves-light float-end">
                                            <i class="mdi mdi-plus-circle" style="margin-right: 10px;"></i>
                                            Aggiungi recensione
                                        </a>
                                        <h4 class="header-title">Tutte le recensioni</h4>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover m-0 table-centered nowrap w-100">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Immagine</th>
                                            <th>Testo recensione</th>
                                            <th>Nome</th>
                                            <th>Azioni</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($recensioni as $recensione)
                                            <tr>
                                                <td>{{ $recensione->id }}</td>

                                                <td>
                                                    @if($recensione->immagine)
                                                        <img src="{{ asset('storage/' . $recensione->immagine) }}"
                                                             alt="Immagine recensione"
                                                             style="height: 50px; width: 50px; object-fit: cover; border-radius: 4px;">
                                                    @else
                                                        <span class="text-muted">Nessuna</span>
                                                    @endif
                                                </td>

                                                <td style="max-width: 350px;">
                                                    {{ \Illuminate\Support\Str::limit($recensione->testo, 120) }}
                                                </td>

                                                <td>{{ $recensione->nome }}</td>

                                                <td>
                                                    <a href="{{ route('dashboard.recensioni.edit', $recensione->id) }}"
                                                       class="btn btn-xs btn-primary">
                                                        <i class="mdi mdi-pencil"></i> Modifica
                                                    </a>

                                                    <form action="{{ route('dashboard.recensioni.destroy', $recensione->id) }}"
                                                          method="POST"
                                                          style="display: inline-block;"
                                                          onsubmit="return confirm('Sei sicuro di voler eliminare questa recensione?');">
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
                                                    Nessuna recensione presente.
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

<!-- Vendor js -->
<script src="/dashboard-backend/js/vendor.min.js"></script>
<!-- App js -->
<script src="/dashboard-backend/js/app.min.js"></script>

<script>
    (function () {
        // Se hai una voce di menu per le recensioni, qui puoi gestire l'active
        document.querySelectorAll('.nav-item').forEach(function (el) {
            el.classList.remove('active');
        });
        // Esempio (se hai una voce con id nav-recensioni):
        // document.getElementById('nav-recensioni')?.classList.add('active');
    })();
</script>

</body>
</html>
