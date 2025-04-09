<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ARMS | <?= $this->renderSection('title')?></title>
    
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css'); ?>">
    
    <!-- FontAwesome (Updated Version) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    
    <link rel="stylesheet" href="<?= base_url('assets/css/guest.css?v=' . time()) ?>">
</head>

<body class="hold-transition login-page">
    <div class="auth-container">
        <?= $this->renderSection('content'); ?>
    </div>

    <script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- AdminLTE JS -->
    <script src="<?= base_url('assets/adminlte/dist/js/adminlte.min.js'); ?>"></script>

    <?= $this->renderSection('scripts')?>
</body>
</html>
