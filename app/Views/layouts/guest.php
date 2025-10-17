<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ARMS - Guest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?= asset('assets/images/dswd_logo.png') ?>" type="image/png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/fontawesome-free/css/all.min.css') ?>">

    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
</head>
<body class="hold-transition login-page">
            <?= $this->renderSection('content') ?>
</div>

<!-- REQUIRED SCRIPTS -->
<script src="<?= base_url('assets/template/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/template/dist/js/adminlte.min.js') ?>"></script>
<script src="<?= base_url('assets/template/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>

<?= $this->renderSection('scripts') ?>

</body>
</html>
