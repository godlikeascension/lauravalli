<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Tutti i Documenti</title>
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
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <!-- Il pulsante "Aggiungi Documento" è visibile solo agli admin -->
                                        @if(auth()->check() && auth()->user()->ruolo == 'admin')
                                            <a href="/dashboard/documento/crea" data-style="zoom-in" class="btn btn-sm ladda-button btn-blue waves-effect waves-light float-end">
                                                <i class="mdi mdi-plus-circle" style="margin-right: 10px;"></i> Aggiungi Documento
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="documents-table">
                                        <thead>
                                        <tr>
                                            <!-- Colonna per lo stato "Letto" -->
                                            <th>Letto</th>
                                            <th>Titolo</th>
                                            <th>Descrizione</th>
                                            <!-- La colonna "Visibilità" verrà aggiunta solo se l'utente è admin -->
                                            @if(auth()->check() && auth()->user()->ruolo == 'admin')
                                                <th>Visibilità</th>
                                            @endif
                                            <th>Creato il</th>
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

<!-- Modal di conferma per cancellazione documento (visibile solo per admin) -->
<div id="confirmDeleteDocModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteDocModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteDocModalLabel">Conferma Cancellazione Documento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Sei sicuro di voler cancellare questo documento? L'azione è irreversibile.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <!-- Bottone Ladda per confermare la cancellazione -->
                <button type="button" id="confirmDeleteDocBtn" class="btn btn-danger ladda-button" data-style="zoom-in">
                    <span class="ladda-label">Cancella</span>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Fine Modal per cancellazione documento -->

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

    // Definiamo l'array delle colonne in modo dinamico in base al ruolo dell'utente
    var columns = [
        {
            // Colonna che mostra se l'utente ha scaricato (letto) il documento
            "data": "has_downloaded",
            "title": "Letto",
            "className": 'center',
            "render": function(data, type, row, meta) {
                return data ? '<span class="badge bg-success">Letto</span>' : '<span class="badge bg-secondary">Non letto</span>';
            }
        },
        { "data": "title", "title": "Titolo", "className": 'center' },
        // Colonna per la descrizione
        { "data": "description", "title": "Descrizione", "className": 'center' }
    ];

    // Se l'utente è admin, aggiungiamo la colonna "Visibilità"
    @if(auth()->check() && auth()->user()->ruolo == 'admin')
    columns.push({
        "data": "visibility",
        "title": "Visibilità",
        "className": 'center',
        "render": function(data, type, row, meta) {
            if(data === 'tutti') {
                return 'Tutti';
            } else if(data === 'comitato') {
                return 'Comitato';
            } else {
                return data;
            }
        }
    });
    @endif

    // Aggiungiamo la colonna "Creato il"
    columns.push({
        "data": "created_at",
        "title": "Creato il",
        "render": function(data, type, row, meta) {
            return moment(data).format('DD/MM/YYYY');
        },
        "className": 'center'
    });

    // Infine, la colonna "Azioni"
    columns.push({
        "data": null,
        "title": "Azioni",
        "render": function(data, type, row, meta) {
            // Bottone per scaricare il documento
            let downloadUrl = '/storage/' + row.file_path;
            let downloadBtn = '<button type="button" class="btn btn-blue btn-sm download-doc" data-document-id="' + row.id + '" data-download-url="' + downloadUrl + '" title="Scarica Documento">' +
                '<i class="mdi mdi-download"></i> Scarica' +
                '</button>';
            // Se l'utente è admin, aggiungiamo anche il bottone per cancellare il documento
            @if(auth()->check() && auth()->user()->ruolo == 'admin')
            let deleteBtn = ' <button type="button" class="btn btn-danger btn-sm delete-doc-btn ladda-button" data-document-id="' + row.id + '" data-style="zoom-in" title="Cancella Documento">' +
                '<i class="mdi mdi-delete"></i> Cancella' +
                '</button>';
            @else
            let deleteBtn = '';
            @endif
                return downloadBtn + deleteBtn;
        },
        "className": 'center'
    });

    // Inizializza DataTable con le colonne definite
    let table = $('#documents-table').DataTable({
        responsive: true,
        "ajax": {
            'url': '/api/dashboard/documents', // Endpoint API per ottenere i documenti
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
            "emptyTable": "Non ci sono documenti da mostrare",
            "loadingRecords": "Caricamento in corso...",
            "lengthMenu": "Mostra _MENU_ righe"
        },
        columns: columns,
        // Ordina per la colonna "Creato il": l'indice varia a seconda se l'utente è admin o meno
        order: [[ @if(auth()->check() && auth()->user()->ruolo == 'admin') 4 @else 3 @endif, "desc" ]],
        pageLength: 10,
        lengthMenu: [[5, 10, 20, 50, 100], [5, 10, 20, 50, 100]],
        autoWidth: false,
    });

    // Variabile globale per tenere traccia dell'ID del documento da cancellare
    let deleteDocumentId = null;

    // Gestione del click sul bottone "Cancella Documento"
    $(document).on('click', '.delete-doc-btn', function(e) {
        e.preventDefault();
        deleteDocumentId = $(this).data('document-id');
        $('#confirmDeleteDocModal').modal('show');
    });

    // Gestione del click sul bottone "Cancella" nel modal di conferma cancellazione
    $('#confirmDeleteDocBtn').click(function() {
        var laddaDeleteBtn = Ladda.create(this);
        laddaDeleteBtn.start();
        $.ajax({
            url: '/api/dashboard/document/delete', // Definisci l'endpoint per la cancellazione nel backend
            type: 'POST',
            data: { document_id: deleteDocumentId },
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr("content")
            },
            success: function(response) {
                $.toast({
                    heading: 'Successo',
                    text: 'Documento cancellato con successo.',
                    position: 'top-right',
                    loaderBg: '#f96868',
                    icon: 'success',
                    hideAfter: 3000,
                    stack: 6
                });
                $('#confirmDeleteDocModal').modal('hide');
                laddaDeleteBtn.stop();
                table.ajax.reload(null, false);
            },
            error: function(xhr, status, error) {
                $.toast({
                    heading: 'Errore',
                    text: 'Si è verificato un errore nella cancellazione del documento.',
                    position: 'top-right',
                    loaderBg: '#f2a654',
                    icon: 'error',
                    hideAfter: 3000,
                    stack: 6
                });
                laddaDeleteBtn.stop();
            }
        });
    });

    // Gestione del click sul bottone "Scarica Documento"
    $(document).on('click', '.download-doc', function(e) {
        e.preventDefault();
        let button = $(this);
        var laddaBtn = Ladda.create(this);
        let originalContent = button.html();
        laddaBtn.start();
        let documentId = button.data('document-id');
        let downloadUrl = button.data('download-url');
        $.ajax({
            url: '/api/dashboard/document/download',
            type: 'POST',
            data: { document_id: documentId },
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr("content")
            },
            success: function(response) {
                var a = document.createElement('a');
                a.href = downloadUrl;
                a.download = '';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                laddaBtn.stop();
                table.ajax.reload(null, false);
            },
            error: function(xhr, status, error) {
                $.toast({
                    heading: 'Errore',
                    text: 'Si è verificato un errore durante la registrazione del download.',
                    position: 'top-right',
                    loaderBg: '#f2a654',
                    icon: 'error',
                    hideAfter: 3000,
                    stack: 6
                });
                laddaBtn.stop();
            }
        });
    });

    $(function() {
        $('.nav-item').removeClass('active');
    });
</script>
</body>
</html>
