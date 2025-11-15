<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Crea Evento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/img/favicon.png">
    <!-- CSS di Ladda -->
    <link href="/dashboard-backend/libs/ladda/ladda.min.css" rel="stylesheet" type="text/css" />
    <link href="/dashboard-backend/libs/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css" />
    <link href="/dashboard-backend/libs/jquery-toast-plugin/jquery.toast.min.css" rel="stylesheet" type="text/css" />
    <!-- third party css -->
    <link href="/dashboard-backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/dashboard-backend/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="/dashboard-backend/css/config/creative/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="/dashboard-backend/css/config/creative/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/dashboard-backend/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="loading" data-layout-mode="horizontal" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": {"color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
<!-- Begin page -->
<div id="wrapper">
    @include('inc.auth.navbar')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-4">Crea Evento</h4>

                                <!-- Messaggi di successo -->
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <!-- Errori di validazione -->
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Form per creare l'evento -->
                                <form action="{{ route('dashboard.event.store') }}" method="POST" enctype="multipart/form-data" id="createEventForm">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Titolo</label>
                                        <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Descrizione</label>
                                        <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="type" class="form-label">Tipo</label>
                                        <input type="text" name="type" id="type" class="form-control" required value="{{ old('type') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="date" class="form-label">Data Evento</label>
                                        <input type="date" name="date" id="date" class="form-control" required value="{{ old('date') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="cover_photo" class="form-label">Foto di Copertina</label>
                                        <input type="file" name="cover_photo" id="cover_photo" class="form-control" accept="image/*">
                                        <small class="text-muted">La foto di copertina è obbligatoria.</small>
                                    </div>

                                    <h5 class="mt-4">Foto Evento Aggiuntive (fino a 6)</h5>
                                    <p class="text-muted">Carica le foto aggiuntive usando gli appositi campi.</p>

                                    <!-- Si usano 6 input file, tutti con lo stesso nome "new_event_photos[]" -->
                                    <div class="mb-3">
                                        <label for="new_event_photos_1" class="form-label">Foto Evento 1</label>
                                        <input type="file" name="new_event_photos[]" id="new_event_photos_1" class="form-control" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_event_photos_2" class="form-label">Foto Evento 2</label>
                                        <input type="file" name="new_event_photos[]" id="new_event_photos_2" class="form-control" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_event_photos_3" class="form-label">Foto Evento 3</label>
                                        <input type="file" name="new_event_photos[]" id="new_event_photos_3" class="form-control" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_event_photos_4" class="form-label">Foto Evento 4</label>
                                        <input type="file" name="new_event_photos[]" id="new_event_photos_4" class="form-control" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_event_photos_5" class="form-label">Foto Evento 5</label>
                                        <input type="file" name="new_event_photos[]" id="new_event_photos_5" class="form-control" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_event_photos_6" class="form-label">Foto Evento 6</label>
                                        <input type="file" name="new_event_photos[]" id="new_event_photos_6" class="form-control" accept="image/*">
                                    </div>

                                    <!-- Bottone di submit con Ladda -->
                                    <button type="submit" id="createEventBtn" class="btn btn-primary ladda-button" data-style="zoom-in">
                                            <span class="ladda-label">
                                                <i class="mdi mdi-content-save" style="margin-right: 10px;"></i> Salva Evento
                                            </span>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<!-- Ladda -->
<script src="/dashboard-backend/libs/ladda/spin.min.js"></script>
<script src="/dashboard-backend/libs/ladda/ladda.min.js"></script>

<script>
    // Inizializza Ladda sul bottone di submit del form
    var laddaCreateBtn = Ladda.create(document.querySelector('#createEventBtn'));
    document.getElementById('createEventForm').addEventListener('submit', function(){
        laddaCreateBtn.start();
    });
</script>
</body>
</html>
