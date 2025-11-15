<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Gestione Popup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin panel per gestire il popup dell'evento" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="/img/favicon.png">
    <!-- Ladda -->
    <link href="/dashboard-backend/libs/ladda/ladda.min.css" rel="stylesheet" type="text/css" />
    <link href="/dashboard-backend/libs/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css" />
    <link href="/dashboard-backend/libs/jquery-toast-plugin/jquery.toast.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="/dashboard-backend/css/config/creative/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="/dashboard-backend/css/config/creative/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="/dashboard-backend/css/icons.min.css" rel="stylesheet" type="text/css" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="loading" data-layout-mode="horizontal"
      data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed",
      "sidebar": {"color": "light", "size": "default", "showuser": false},
      "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": false}'>

<div id="wrapper">
    @include('inc.auth.navbar')

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-4">Gestione Popup</h4>

                                @if(session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Form -->
                                <form action="{{ route('dashboard.popup.update') }}" method="POST" enctype="multipart/form-data" id="popupForm">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Titolo Evento</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                               required value="{{ old('title', $flyer->title) }}">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="visible_from" class="form-label">Visibile da</label>
                                            <input type="datetime-local" name="visible_from" id="visible_from" class="form-control"
                                                   required value="{{ old('visible_from', optional($flyer->visible_from)->format('Y-m-d\TH:i')) }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="visible_to" class="form-label">Visibile fino a</label>
                                            <input type="datetime-local" name="visible_to" id="visible_to" class="form-control"
                                                   required value="{{ old('visible_to', optional($flyer->visible_to)->format('Y-m-d\TH:i')) }}">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="pdf" class="form-label">PDF Volantino</label>
                                        <input type="file" name="pdf" id="pdf" class="form-control" accept="application/pdf">
                                        <small class="text-muted">Lascia vuoto per mantenere il volantino attuale.</small>
                                        @if($flyer->pdf_path)
                                            <p class="mt-2">Attuale:
                                                <a href="{{ asset('storage/'.$flyer->pdf_path) }}" target="_blank">
                                                    {{ basename($flyer->pdf_path) }}
                                                </a>
                                            </p>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Immagine</label>
                                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                        @if($flyer->image_path)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/'.$flyer->image_path) }}" alt="Anteprima" style="max-height:150px;">
                                            </div>
                                        @endif
                                    </div>

                                    <button type="submit" id="popupBtn"
                                            class="btn btn-primary ladda-button" data-style="zoom-in">
                                        <span class="ladda-label">
                                            <i class="mdi mdi-content-save me-1"></i> Salva Modifiche
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </div> <!-- end card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Vendor js -->
<script src="/dashboard-backend/js/vendor.min.js"></script>
<script src="/dashboard-backend/js/app.min.js"></script>

<!-- Ladda -->
<script src="/dashboard-backend/libs/ladda/spin.min.js"></script>
<script src="/dashboard-backend/libs/ladda/ladda.min.js"></script>
<script src="/dashboard-backend/libs/jquery-toast-plugin/jquery.toast.min.js"></script>

<script>
    // Init Ladda
    var laddaPopupBtn = Ladda.create(document.querySelector('#popupBtn'));
    document.getElementById('popupForm').addEventListener('submit', function() {
        laddaPopupBtn.start();
    });
</script>
</body>
</html>
