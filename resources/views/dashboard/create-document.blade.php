<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Carica Nuovo Documento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/img/favicon.png">
    <link href="/dashboard-backend/libs/ladda/ladda.min.css" rel="stylesheet" type="text/css" />
    <link href="/dashboard-backend/libs/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css" />
    <link href="/dashboard-backend/libs/jquery-toast-plugin/jquery.toast.min.css" rel="stylesheet" type="text/css" />

    <!-- third party css -->
    <link href="/dashboard-backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/dashboard-backend/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- App css -->
    <link href="/dashboard-backend/css/config/creative/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="/dashboard-backend/css/config/creative/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- icons -->
    <link href="/dashboard-backend/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="loading" data-layout-mode="horizontal" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": {"color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
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
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-4">Carica Nuovo Documento</h4>

                                <!-- Visualizza messaggi di successo -->
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <!-- Visualizza errori di validazione -->
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Form per caricare un nuovo documento -->
                                <form action="{{ route('dashboard.document.store') }}" method="POST" enctype="multipart/form-data" id="createDocumentForm">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Titolo</label>
                                        <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Descrizione</label>
                                        <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="file" class="form-label">Documento (PDF)</label>
                                        <input type="file" name="file" id="file" class="form-control" accept="application/pdf" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="visibility" class="form-label">Visibilità</label>
                                        <select name="visibility" id="visibility" class="form-control" required>
                                            <option value="">Seleziona visibilità</option>
                                            <option value="tutti" {{ old('visibility') == 'tutti' ? 'selected' : '' }}>Tutti</option>
                                            <option value="comitato" {{ old('visibility') == 'comitato' ? 'selected' : '' }}>Comitato</option>
                                        </select>
                                    </div>

                                    <!-- Bottone di submit Ladda -->
                                    <button type="submit" id="createDocumentBtn" class="btn btn-primary ladda-button" data-style="zoom-in">
                                        <span class="ladda-label"><i class="mdi mdi-content-save" style="margin-right: 10px;"></i> Carica Documento</span>
                                    </button>
                                </form>
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
<!-- third party js -->
<script src="/dashboard-backend/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/dashboard-backend/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/dashboard-backend/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/dashboard-backend/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<!-- App js -->
<script src="/dashboard-backend/js/app.min.js"></script>
<!-- Inizializza Ladda -->
<script src="/dashboard-backend/libs/ladda/spin.min.js"></script>
<script src="/dashboard-backend/libs/ladda/ladda.min.js"></script>

<script>
    // Inizializza Ladda sul bottone di submit del form
    var laddaDocumentBtn = Ladda.create(document.querySelector('#createDocumentBtn'));
    $('#createDocumentForm').on('submit', function(){
        laddaDocumentBtn.start();
    });
</script>
</body>
</html>
