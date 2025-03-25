<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARMS | Admin</title>

        <!-- FontAwesome - Load First -->
    <link rel="stylesheet" href="<?= base_url('vendor/adminlte/plugins/fontawesome-free/css/all.min.css'); ?>" crossorigin="anonymous" as="font">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css?v=' . time()); ?>">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="<?= base_url('vendor/adminlte/dist/css/adminlte.min.css'); ?>">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('vendor/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">

</head>
<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <?= $this->include('layouts/partials/navbar'); ?>

        <?= $this->include('layouts/partials/sidebar'); ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content pb-4" style="padding-top:54px;">
                <div class="container-fluid">
                    <?= $this->renderSection('content') ?> <!-- Dynamic Content Here -->
                </div>
            </div>
        </div>

        <?= $this->include('layouts/partials/footer') ?>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url('vendor/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>

    <!-- Bootstrap JS -->
    <script src="<?= base_url('vendor/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- AdminLTE JS -->
    <script src="<?= base_url('vendor/adminlte/dist/js/adminlte.min.js'); ?>"></script>

    <!-- DataTables Script -->
    <script src="<?= base_url('vendor/adminlte/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('vendor/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/scripts.js') ?>"></script>
    <script>
    
</script>

</body>
</html>
