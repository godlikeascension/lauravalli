<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Tutti gli Eventi</title>
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

    <style>
        /* Ensure fixed table layout so column widths are enforced */
        #events-table {
            table-layout: fixed;
        }
        /* Force description cells to have a max width of 300px with ellipsis */
        .description-cell {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
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
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <!-- Il pulsante "Aggiungi Evento" è visibile solo agli admin -->
                                        @if(auth()->check() && auth()->user()->ruolo == 'admin')
                                            <a href="/dashboard/evento/crea" data-style="zoom-in" class="btn btn-sm ladda-button btn-blue waves-effect waves-light float-end">
                                                <i class="mdi mdi-plus-circle" style="margin-right: 10px;"></i> Aggiungi Evento
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="events-table">
                                        <thead>
                                        <tr>
                                            <th>Titolo</th>
                                            <th style="max-width: 300px;">Descrizione</th>
                                            <th>Tipo</th>
                                            <th>Data Evento</th>
                                            <th class="hidden-sm">Azioni</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <!-- I dati verranno caricati dinamicamente via DataTables -->
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Conferma cancellazione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler cancellare questo evento?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" id="confirmDeleteBtn" class="btn btn-danger ladda-button" data-style="zoom-in">Cancella</button>
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
<script src="/dashboard-backend/libs/ladda/spin.min.js"></script>
<script src="/dashboard-backend/libs/ladda/ladda.min.js"></script>
<script src="/dashboard-backend/libs/jquery-toast-plugin/jquery.toast.min.js"></script>
<!-- Plugin per DataTables con moment.js -->
<script src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/datetime-moment.js"></script>

<script>
    // Inizializza il plugin datetime-moment per interpretare le date in formato DD/MM/YYYY
    $.fn.dataTable.moment('DD/MM/YYYY');

    // Definizione delle colonne per la tabella degli eventi
    let columns = [
        { "data": "title", "title": "Titolo", "className": 'center' },
        { "data": "description", "title": "Descrizione", "className": 'description-cell center' },
        { "data": "type", "title": "Tipo", "className": 'center' },
        {
            "data": "date",
            "title": "Data Evento",
            "render": function(data, type, row, meta) {
                return moment(data).format('DD/MM/YYYY');
            },
            "className": 'center'
        },
        {
            "data": null,
            "title": "Azioni",
            "render": function(data, type, row, meta) {
                let editBtn = '<a href="/dashboard/evento/edit?id=' + row.id + '" class="btn btn-blue btn-sm" title="Modifica Evento">' +
                    '<i class="mdi mdi-pencil"></i> Modifica</a>';
                let deleteBtn = ' <button class="btn btn-danger btn-sm delete-event" data-id="' + row.id + '" title="Cancella Evento">' +
                    '<i class="mdi mdi-delete"></i> Cancella</button>';
                return editBtn + deleteBtn;
            },
            "className": 'center'
        }
    ];

    let table = $('#events-table').DataTable({
        responsive: true,
        "ajax": {
            'url': '/api/dashboard/events', // Endpoint API per ottenere gli eventi
            'type': 'GET',
            'beforeSend': function (request) {
                request.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));
            },
            "dataSrc": function (json) {
                return json;
            }
        },
        "language": {
            "paginate": {
                "previous": "Precedente",
                "next": "Prossima",
                "first": "Prima",
                "last": "Ultima"
            },
            "search": "Cerca",
            "info": "Pagina _PAGE_ di _PAGES_",
            "infoEmpty": "Nessun dato disponibile",
            "emptyTable": "Non ci sono eventi da mostrare",
            "loadingRecords": "Caricamento in corso...",
            "lengthMenu": "Mostra _MENU_ righe"
        },
        columns: columns,
        order: [[3, "desc"]],
        pageLength: 10,
        lengthMenu: [[5, 10, 20, 50, 100], [5, 10, 20, 50, 100]],
        autoWidth: false,
    });

    // Variable to store the button element for deletion
    var currentDeleteBtn = null;
    var eventIdToDelete = null;

    // Delete button click handler: open modal, store event id and button element
    $('#events-table').on('click', '.delete-event', function() {
        eventIdToDelete = $(this).data('id');
        currentDeleteBtn = $(this);
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    });

    // Confirm deletion: start Ladda animation on the confirm button
    $('#confirmDeleteBtn').on('click', function() {
        var laddaBtn = Ladda.create(this);
        laddaBtn.start();

        if (eventIdToDelete) {
            $.ajax({
                url: '/api/dashboard/evento/' + eventIdToDelete,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr("content") },
                success: function(response) {
                    if (response.success) {
                        $.toast({ heading: 'Successo', text: 'Evento cancellato con successo.', position: 'top-right', loaderBg:'#5ba035', icon: 'success', hideAfter: 3000, stack: 6 });
                        table.ajax.reload();
                    } else {
                        $.toast({ heading: 'Errore', text: 'Si è verificato un errore durante la cancellazione.', position: 'top-right', loaderBg:'#ff6849', icon: 'error', hideAfter: 3000, stack: 6 });
                    }
                },
                error: function(xhr) {
                    $.toast({ heading: 'Errore', text: 'Si è verificato un errore durante la cancellazione.', position: 'top-right', loaderBg:'#ff6849', icon: 'error', hideAfter: 3000, stack: 6 });
                },
                complete: function() {
                    // Stop Ladda animation and hide the modal
                    laddaBtn.stop();
                    var deleteModalEl = document.getElementById('deleteModal');
                    var deleteModal = bootstrap.Modal.getInstance(deleteModalEl);
                    deleteModal.hide();
                }
            });
        }
    });

    $(function() {
        $('.nav-item').removeClass('active');
    });
</script>
</body>
</html>
