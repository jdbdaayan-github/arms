<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARMS</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/main.css'); ?>">
    <!-- Link to AdminLTE CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css'); ?>">
       <!-- DataTables (from AdminLTE) -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
    <!-- Fontawesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

    <!-- Auth view -->
    <div class="wrapper">

        <!-- Navbar -->
        <?= view('layouts/partials/navbar'); ?>

        <!-- Sidebar -->
        <?= view('layouts/partials/sidebar'); ?>

        <!-- Rendering main Section -->
        <div class="content" style="padding-top: 40px;">
            <?= $this->renderSection('content'); ?>
        </div>

        <!-- Footer -->
        <?= view('layouts/partials/footer'); ?>

    </div>

    <!-- Guest view -->
    <div class="guest">
        <?= $this->renderSection('content'); ?>
    </div>


    <!-- jQuery (necessary for AdminLTE and Bootstrap) -->
    <script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>

    <!-- Bootstrap JS (needed for dropdowns) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE JS -->
    <script src="<?= base_url('assets/adminlte/dist/js/adminlte.min.js'); ?>"></script>

    <!-- DataTables & Plugins (from AdminLTE) -->
    <script src="<?= base_url('assets/adminlte/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/plugins/jszip/jszip.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/plugins/pdfmake/pdfmake.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/plugins/pdfmake/vfs_fonts.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>"></script>

    <!-- Script rendering section -->
    <?= $this->renderSection('scripts');?>
</body>
</html>