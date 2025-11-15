<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Modifica Evento</title>
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

    <style>
        /* Contenitore fisso per le anteprime: 300px di altezza, centrato con Flexbox */
        .preview-container {
            position: relative;
            height: 300px;
            width: 100%;
            border: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }
        /* Delete button positioned on preview */
        .delete-photo-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }
    </style>
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
                                <h4 class="header-title mb-4">Modifica Evento</h4>

                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
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

                                <!-- Form per modificare l'evento -->
                                <form action="{{ route('dashboard.event.update') }}" method="POST" enctype="multipart/form-data" id="editEventForm">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $event->id }}">

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Titolo</label>
                                        <input type="text" name="title" id="title" class="form-control" required value="{{ old('title', $event->title) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Descrizione</label>
                                        <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description', $event->description) }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="type" class="form-label">Tipo</label>
                                        <input type="text" name="type" id="type" class="form-control" required value="{{ old('type', $event->type) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="date" class="form-label">Data Evento</label>
                                        <input type="date" name="date" id="date" class="form-control" required value="{{ old('date', $event->date) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="cover_photo" class="form-label">Foto di Copertina</label>
                                        @if($event->cover_photo)
                                            <div class="preview-container">
                                                <img src="{{ asset('storage/' . $event->cover_photo) }}" alt="Cover Photo" style="max-height:300px; width:auto;">
                                            </div>
                                        @endif
                                        <input type="file" name="cover_photo" id="cover_photo" class="form-control" accept="image/*">
                                        <small class="text-muted">Lascia vuoto per mantenere la foto attuale.</small>
                                    </div>

                                    <h5 class="mt-4">Foto Evento (fino a 6)</h5>
                                    <p class="text-muted">Carica fino a 6 immagini separatamente. Se esiste già una foto associata, verrà mostrata l'anteprima con un pulsante per cancellarla.</p>
                                    <div class="row">
                                        @for($i = 1; $i <= 6; $i++)
                                            <div class="col-md-4 mb-3">
                                                <label for="event_photo_{{ $i }}" class="form-label">Foto Evento {{ $i }}</label>
                                                @php
                                                    $photo = $event->photos->get($i - 1);
                                                @endphp
                                                @if($photo)
                                                    <div class="preview-container">
                                                        <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Foto Evento {{ $i }}" style="max-height:300px; width:auto;">
                                                        <!-- Delete button for photo with modal trigger -->
                                                        <button type="button" class="btn btn-danger btn-sm delete-photo ladda-button delete-photo-btn" data-photo-id="{{ $photo->id }}" data-bs-toggle="modal" data-bs-target="#deletePhotoModal">
                                                            <span class="ladda-label"><i class="mdi mdi-delete"></i> Cancella</span>
                                                        </button>
                                                    </div>
                                                @endif
                                                <input type="file" name="event_photo_{{ $i }}" id="event_photo_{{ $i }}" class="form-control" accept="image/*">
                                            </div>
                                        @endfor
                                    </div>

                                    <!-- Bottone di submit Ladda -->
                                    <button type="submit" id="editEventBtn" class="btn btn-primary ladda-button" data-style="zoom-in">
                                        <span class="ladda-label"><i class="mdi mdi-content-save" style="margin-right: 10px;"></i> Salva Modifiche</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Photo Confirmation Modal -->
<div class="modal fade" id="deletePhotoModal" tabindex="-1" aria-labelledby="deletePhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePhotoModalLabel">Conferma cancellazione foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler cancellare questa foto?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" id="confirmDeletePhotoBtn" class="btn btn-danger ladda-button" data-style="zoom-in">
                    <span class="ladda-label"><i class="mdi mdi-delete"></i> Cancella</span>
                </button>
            </div>
        </div>
    </div>
</div>

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
<script src="/dashboard-backend/libs/jquery-toast-plugin/jquery.toast.min.js"></script>


<script>
    // Inizializza Ladda sul bottone di submit del form
    var laddaEditBtn = Ladda.create(document.querySelector('#editEventBtn'));
    document.getElementById('editEventForm').addEventListener('submit', function(){
        laddaEditBtn.start();
    });

    // Variable to store the photo id to delete
    var photoIdToDelete = null;
    var currentDeletePhotoBtn = null;

    // When a delete-photo button is clicked, store the photo id and button element (Ladda will be re-initialized in modal)
    $('.delete-photo').on('click', function() {
        photoIdToDelete = $(this).data('photo-id');
        currentDeletePhotoBtn = $(this); // Optional, if you want to manipulate the original button later
    });

    // When the confirm button in the modal is clicked, start its Ladda animation and send AJAX DELETE
    $('#confirmDeletePhotoBtn').on('click', function() {
        var laddaModalBtn = Ladda.create(this);
        laddaModalBtn.start();

        if (photoIdToDelete) {
            $.ajax({
                url: '/api/dashboard/event/photo/' + photoIdToDelete,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr("content") },
                success: function(response) {
                    if (response.success) {
                        $.toast({ heading: 'Successo', text: 'Foto cancellata con successo.', position: 'top-right', loaderBg:'#5ba035', icon: 'success', hideAfter: 3000, stack: 6 });
                        // Remove the photo preview container from the DOM
                        $('.delete-photo[data-photo-id="'+photoIdToDelete+'"]').closest('.preview-container').remove();
                    } else {
                        $.toast({ heading: 'Errore', text: 'Si è verificato un errore durante la cancellazione.', position: 'top-right', loaderBg:'#ff6849', icon: 'error', hideAfter: 3000, stack: 6 });
                    }
                },
                error: function(xhr) {
                    $.toast({ heading: 'Errore', text: 'Si è verificato un errore durante la cancellazione.', position: 'top-right', loaderBg:'#ff6849', icon: 'error', hideAfter: 3000, stack: 6 });
                },
                complete: function() {
                    laddaModalBtn.stop();
                    // Hide the modal (Bootstrap 5 method)
                    var modalEl = document.getElementById('deletePhotoModal');
                    var modalInstance = bootstrap.Modal.getInstance(modalEl);
                    modalInstance.hide();
                }
            });
        }
    });
</script>
</body>
</html>
