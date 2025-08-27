<?= $this->extend('layouts/guest') ?>

<?= $this->section('content') ?>
<p class="login-box-msg">Forgot your password? You can reset it here.</p>

<form action="<?= base_url('forgot-password') ?>" method="post">
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
        <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
        </div>
    </div>
</form>

<p class="mt-3 mb-1">
    <a href="<?= base_url('login') ?>">Back to Login</a>
</p>
<p class="mb-0">
    <a href="<?= base_url('register') ?>" class="text-center">Register a new membership</a>
</p>
<?= $this->endSection() ?>
