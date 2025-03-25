<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Auth Page') ?></title>

    <!-- FontAwesome - Load First -->
    <link rel="stylesheet" href="<?= base_url('vendor/adminlte/plugins/fontawesome-free/css/all.min.css'); ?>" crossorigin="anonymous" >

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css?v=' . time()); ?>">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="<?= base_url('vendor/adminlte/dist/css/adminlte.min.css'); ?>">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('vendor/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f4f6f9;
        }
        .login-box {
            width: 360px;
            margin: 7% auto;
        }
    </style>
</head>
<body class="hold-transition login-page">

    <?= $this->renderSection('content') ?>  <!-- This will render page content -->

    <!-- jQuery -->
    <script src="<?= base_url('vendor/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
    <!-- Bootstrap JS -->
    <script src="<?= base_url('vendor/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- AdminLTE JS -->
    <script src="<?= base_url('vendor/adminlte/dist/js/adminlte.min.js'); ?>"></script>

</body>
</html>
