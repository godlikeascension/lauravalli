<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Tutti i Contatti</title>
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
                                <!-- Pulsante per aggiungere un nuovo utente -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <a href="/dashboard/utente/crea" id="create-lead" data-style="zoom-in" class="btn btn-sm ladda-button btn-blue waves-effect waves-light float-end">
                                            <i class="mdi mdi-plus-circle" style="margin-right: 10px;"></i> Aggiungi Utente
                                        </a>
                                    </div>
                                </div>

                                <!-- Tabella utenti -->
                                <div class="table-responsive">
                                    <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="users-table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Ruolo</th>
                                            <th>Registrato il</th>
                                            <th class="hidden-sm">Azioni</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Fine tabella -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Content -->
        </div>
    </div>
</div>
<!-- END wrapper -->

<!-- Modal di conferma per cambio password -->
<div id="confirmChangePasswordModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmChangePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmChangePasswordModalLabel">Conferma Cambio Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Sei sicuro di voler cambiare la password e reinviare l'email per questo utente?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <!-- Ladda button per confermare l'azione -->
                <button type="button" id="confirmChangePasswordBtn" class="btn btn-warning ladda-button" data-style="zoom-in">
                    <span class="ladda-label">Conferma</span>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Fine Modal per cambio password -->

<!-- Modal di conferma per cancellazione utente -->
<div id="confirmDeleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Conferma Cancellazione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Sei sicuro di voler cancellare questo utente? L'azione è irreversibile.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <!-- Bottone Ladda per confermare la cancellazione -->
                <button type="button" id="confirmDeleteBtn" class="btn btn-danger ladda-button" data-style="zoom-in">
                    <span class="ladda-label">Cancella</span>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Fine Modal per cancellazione -->

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

<script>
    // Inizializza la tabella DataTables
    let table = $('#users-table').DataTable({
        responsive: true,
        "ajax": {
            'url': '/api/dashboard/users', // Endpoint API per ottenere gli utenti
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
            "emptyTable": "Non ci sono utenti da mostrare",
            "loadingRecords": "Caricamento in corso...",
            "lengthMenu": "Mostra _MENU_ righe"
        },
        columns: [
            { "data": "id", "title": "ID", "className": 'center' },
            { "data": "name", "title": "Nome", "className": 'center' },
            { "data": "email", "title": "Email", "className": 'center' },
            {
                "data": "ruolo",
                "title": "Ruolo",
                "className": 'center',
                "render": function(data, type, row, meta) {
                    switch(data) {
                        case 'admin':
                            return 'Amministratore';
                        case 'comitato':
                            return 'Membro del Comitato';
                        case 'socio':
                            return 'Socio Semplice';
                        default:
                            return data;
                    }
                }
            },
            {
                "data": "created_at",
                "title": "Registrato il",
                "render": function(data, type, row, meta) {
                    return moment(data).format('DD/MM/YYYY');
                },
                "className": 'center'
            },
            {
                "data": null,
                "title": "Azioni",
                "render": function (data, type, row, meta) {
                    // Bottone per modificare i dati utente
                    var editBtn = '<a href="/dashboard/user/edit?id=' + row.id + '" class="btn btn-blue btn-sm" title="Modifica Utente"><i class="mdi mdi-pencil"></i></a>';
                    // Bottone Ladda per il cambio password che mostra il modal di conferma
                    var changePswBtn = '<button type="button" class="btn btn-warning btn-sm change-password-btn ladda-button" data-id="' + row.id + '" data-style="zoom-in" title="Cambia Password e Reinvia Email"><i class="mdi mdi-lock-reset"></i></button>';
                    // Bottone Ladda per cancellare l'utente che mostra il modal di conferma
                    var deleteBtn = '<button type="button" class="btn btn-danger btn-sm delete-user-btn ladda-button" data-id="' + row.id + '" data-style="zoom-in" title="Cancella Utente"><i class="mdi mdi-delete"></i></button>';
                    return editBtn + ' ' + changePswBtn + ' ' + deleteBtn;
                },
                "className": 'center'
            }
        ],
        order: [[0, "desc"]],
        pageLength: 10,
        lengthMenu: [[5, 10, 20, 50, 100], [5, 10, 20, 50, 100]],
        autoWidth: false,
    });

    // Variabile globale per tenere traccia dell'utente da modificare per cambio psw
    let selectedUserIdForPsw = null;
    // Variabile globale per tenere traccia dell'utente da cancellare
    let deleteUserId = null;

    // Gestione del click sul bottone "Cambia Password"
    $(document).on('click', '.change-password-btn', function(e) {
        e.preventDefault();
        selectedUserIdForPsw = $(this).data('id');
        // Mostra il modal di conferma per il cambio password
        $('#confirmChangePasswordModal').modal('show');
    });

    // Gestione del click sul bottone "Conferma" del modal di cambio password
    $('#confirmChangePasswordBtn').click(function() {
        var laddaPswBtn = Ladda.create(this);
        laddaPswBtn.start();
        $.ajax({
            url: '/api/dashboard/user/change-password',
            type: 'POST',
            data: { id: selectedUserIdForPsw },
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr("content")
            },
            success: function(response) {
                $.toast({
                    heading: 'Successo',
                    text: 'La password è stata cambiata e inviata via email.',
                    position: 'top-right',
                    loaderBg: '#f96868',
                    icon: 'success',
                    hideAfter: 3000,
                    stack: 6
                });
                $('#confirmChangePasswordModal').modal('hide');
                laddaPswBtn.stop();
            },
            error: function(xhr, status, error) {
                $.toast({
                    heading: 'Errore',
                    text: 'Si è verificato un errore nel cambio password.',
                    position: 'top-right',
                    loaderBg: '#f2a654',
                    icon: 'error',
                    hideAfter: 3000,
                    stack: 6
                });
                laddaPswBtn.stop();
            }
        });
    });

    // Gestione del click sul bottone "Cancella Utente"
    $(document).on('click', '.delete-user-btn', function(e) {
        e.preventDefault();
        deleteUserId = $(this).data('id');
        $('#confirmDeleteModal').modal('show');
    });

    // Gestione del click sul bottone "Cancella" del modal di cancellazione
    $('#confirmDeleteBtn').click(function() {
        var laddaDeleteBtn = Ladda.create(this);
        laddaDeleteBtn.start();
        $.ajax({
            url: '/api/dashboard/user/delete',
            type: 'POST',
            data: { id: deleteUserId },
            headers: {
                'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr("content")
            },
            success: function(response) {
                $.toast({
                    heading: 'Successo',
                    text: 'Utente cancellato con successo.',
                    position: 'top-right',
                    loaderBg: '#f96868',
                    icon: 'success',
                    hideAfter: 3000,
                    stack: 6
                });
                $('#confirmDeleteModal').modal('hide');
                laddaDeleteBtn.stop();
                table.ajax.reload();
            },
            error: function(xhr, status, error) {
                $.toast({
                    heading: 'Errore',
                    text: 'Si è verificato un errore nella cancellazione dell\'utente.',
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

    $(function() {
        $('.nav-item').removeClass('active');
    });
</script>
</body>
</html>
