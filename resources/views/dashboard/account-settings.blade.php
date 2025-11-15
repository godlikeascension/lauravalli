<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Impostazioni Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/img/favicon.png" />
    <link href="/dashboard-backend/libs/ladda/ladda.min.css" rel="stylesheet" type="text/css" />
    <link href="/dashboard-backend/libs/ladda/ladda-themeless.min.css" rel="stylesheet" type="text/css" />
    <link href="/dashboard-backend/libs/jquery-toast-plugin/jquery.toast.min.css" rel="stylesheet" type="text/css" />

    <!-- third party css -->
    <link href="/dashboard-backend/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/dashboard-backend/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="/dashboard-backend/css/config/creative/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="/dashboard-backend/css/config/creative/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="/dashboard-backend/css/icons.min.css" rel="stylesheet" type="text/css" />
    <style>
        /* You can add custom styles here if needed */
    </style>
</head>
<body data-layout-mode="horizontal" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": {"color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
<!-- Begin page -->
<div id="wrapper">
    @include('inc.auth.navbar')
    <div class="content-page">
        <div class="content">
            <!-- Start Content -->
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mb-4">Impostazioni Account</h4>

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

                                <form action="{{ route('dashboard.account.update') }}" method="POST" id="accountSettingsForm">
                                    @csrf
                                    <!-- Current Password -->
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Password Corrente</label>
                                        <div class="input-group">
                                            <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Inserisci la password corrente" required>
                                            <span class="input-group-text toggle-password" data-target="#current_password" style="cursor:pointer;"><i class="mdi mdi-eye-off"></i></span>
                                        </div>
                                    </div>
                                    <!-- New Password -->
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">Nuova Password</label>
                                        <div class="input-group">
                                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Inserisci la nuova password" required>
                                            <span class="input-group-text toggle-password" data-target="#new_password" style="cursor:pointer;"><i class="mdi mdi-eye-off"></i></span>
                                        </div>
                                    </div>
                                    <!-- Confirm New Password -->
                                    <div class="mb-3">
                                        <label for="new_password_confirmation" class="form-label">Conferma Nuova Password</label>
                                        <div class="input-group">
                                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="Conferma la nuova password" required>
                                            <span class="input-group-text toggle-password" data-target="#new_password_confirmation" style="cursor:pointer;"><i class="mdi mdi-eye-off"></i></span>
                                        </div>
                                    </div>
                                    <button type="submit" id="updatePasswordBtn" class="btn btn-primary ladda-button" data-style="zoom-in">
                                        <span class="ladda-label"><i class="mdi mdi-content-save" style="margin-right: 10px;"></i> Aggiorna Password</span>
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
<!-- Ladda -->
<script src="/dashboard-backend/libs/ladda/spin.min.js"></script>
<script src="/dashboard-backend/libs/ladda/ladda.min.js"></script>
<script>
    // Initialize Ladda on the update password button
    var laddaUpdateBtn = Ladda.create(document.querySelector('#updatePasswordBtn'));
    document.getElementById('accountSettingsForm').addEventListener('submit', function(){
        laddaUpdateBtn.start();
    });

    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            var targetInput = document.querySelector(this.getAttribute('data-target'));
            if (targetInput.getAttribute('type') === 'password') {
                targetInput.setAttribute('type', 'text');
                this.innerHTML = '<i class="mdi mdi-eye"></i>';
            } else {
                targetInput.setAttribute('type', 'password');
                this.innerHTML = '<i class="mdi mdi-eye-off"></i>';
            }
        });
    });
</script>
</body>
</html>
