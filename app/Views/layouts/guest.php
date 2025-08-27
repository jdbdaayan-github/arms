<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ARMS - Guest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/fontawesome-free/css/all.min.css') ?>">

    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">

    <!-- AdminLTE -->
    <link rel="stylesheet" href="<?= base_url('assets/template/dist/css/adminlte.min.css') ?>">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets/template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">

    <style>
        body {
            background: #f4f6f9;
        }
        .login-box, .register-box {
            width: 400px;
        }
        @media (max-width: 576px) {
            .login-box, .register-box {
                width: 100%;
                padding: 0 15px;
            }
        }
    </style>
</head>
<body class="hold-transition login-page">

<div class="login-box">
    <!-- Brand Logo -->
    <div class="login-logo">
        <a href="#"><b>ARMS</b></a>
    </div>

    <!-- Content Wrapper -->
    <div class="card">
        <div class="card-body">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
</div>

<!-- REQUIRED SCRIPTS -->
<script src="<?= base_url('assets/template/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/template/dist/js/adminlte.min.js') ?>"></script>
<script src="<?= base_url('assets/template/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>

<?= $this->renderSection('scripts') ?>

</body>
</html>
