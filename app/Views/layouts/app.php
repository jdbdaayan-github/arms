<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ARMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome (AdminLTE icons) -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/fontawesome-free/css/all.min.css') ?>">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">

    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">

    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">

    <!-- Daterangepicker -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/daterangepicker/daterangepicker.css') ?>">

    <!-- Summernote -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/summernote/summernote-bs4.min.css') ?>">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">

    <!-- Dual Lits Box -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') ?>">

    <style>
        /* Make Select2 small same as form-control-sm */
        .select2-container--bootstrap4 .select2-selection--single {
            height: calc(1.8125rem + 2px) !important;
            font-size: .875rem !important;
            padding: .25rem .5rem;
        }

        .select2-container--bootstrap4 .select2-selection__rendered {
            line-height: 1.5 !important;
        }

        .custom-file-input,
        .custom-file-label {
            padding: .25rem .5rem;
            /* same as form-control-sm */
            height: calc(1.8125rem + 2px);
            /* height ng small inputs */
            font-size: .875rem;
        }

        .content-wrapper {
            min-height: auto;
        }
        section.content
        {
            padding-bottom: 15px !important;
        }
        
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed nav-compact">
    <div class="wrapper">

        <!-- Navbar -->
        <?= view('layouts/partials/navbar') ?>

        <!-- Sidebar -->
        <?= view('layouts/partials/sidebar') ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-sm-6">
                            <h5 class="m-0">
                                <?= $this->renderSection('content-header') ?>
                            </h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                                <?= $this->renderSection('content-breadcrumbs') ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->renderSection('content') ?>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong class="text-info">&copy; 2025 AS-RAMD.</strong> All rights reserved.
        </footer>

    </div>

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/template/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- overlayScrollbars -->
    <script src="<?= base_url('assets/template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>

    <!-- DataTables -->
    <script src="<?= base_url('assets/template/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('assets/template/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?= base_url('assets/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('assets/template/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('assets/template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('assets/template/plugins/jszip/jszip.min.js') ?>"></script>
    <script src="<?= base_url('assets/template/plugins/pdfmake/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('assets/template/plugins/pdfmake/vfs_fonts.js') ?>"></script>
    <script src="<?= base_url('assets/template/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('assets/template/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
    <script src="<?= base_url('assets/template/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>

    <!-- Select2 -->
    <script src="<?= base_url('assets/template/plugins/select2/js/select2.full.min.js') ?>"></script>

    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url('assets/template/plugins/moment/moment.min.js') ?>"></script>
    <script src="<?= base_url('assets/template/plugins/daterangepicker/daterangepicker.js') ?>"></script>
    <script src="<?= base_url('assets/template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>

    <!-- Summernote -->
    <script src="<?= base_url('assets/template/plugins/summernote/summernote-bs4.min.js') ?>"></script>

    <!-- AdminLTE -->
    <script src="<?= base_url('assets/template/dist/js/adminlte.js') ?>"></script>

    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets/template/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>

    <!-- Moment.js (required for daterangepicker) -->
    <script src="<?= base_url('assets/template/plugins/moment/moment.min.js') ?>"></script>

    <!-- Daterangepicker JS -->
    <script src="<?= base_url('assets/template/plugins/daterangepicker/daterangepicker.js') ?>"></script>

    <!-- Dual List Box -->
    <script src="<?= base_url('assets/template/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') ?>"></script>

    <!-- Custom Scripts -->
    <?= $this->renderSection('scripts') ?>

</body>

</html>