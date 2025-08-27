<?= $this->extend('layouts/guest') ?>

<?= $this->section('content') ?>
<p class="login-box-msg">Register a new membership</p>

<form action="<?= base_url('register') ?>" method="post">
    <div class="input-group mb-3">
        <input type="text" name="name" class="form-control" placeholder="Full name" required>
        <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
        </div>
    </div>
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
        <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
        </div>
    </div>
    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
        </div>
    </div>
    <div class="input-group mb-3">
        <input type="password" name="password_confirm" class="form-control" placeholder="Retype password" required>
        <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" required>
                <label for="agreeTerms">I agree to the <a href="#">terms</a></label>
            </div>
        </div>
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
    </div>
</form>

<p class="mt-3 mb-0">
    <a href="<?= base_url('login') ?>" class="text-center">I already have a membership</a>
</p>
<?= $this->endSection() ?>
