<?= $this->extend("layouts/guest"); ?>

<?= $this->section('content'); ?>
<div class="login-box" style="width: 100%;">
    <div class="login-logo">
        <a href="<?= base_url(); ?>">ARMS</a>
        <p class="logo-name mb-4">Archival Records Management System</p>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg mb-3">Sign in to start your session</p>

            <!-- Display errors -->
            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('errors'); ?>
                </div>
            <?php endif; ?>

            <!-- Display success message -->
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>

            <!-- Login form -->
            <form action="<?= base_url('login/authenticate'); ?>" method="post">
            <?= csrf_field(); ?>

            <div class="input-group mb-3">
                <input type="text" name="username" class="form-control" value="<?= set_value('username')?>" placeholder="Username" required autofocus>
                <div class="input-group-append">
                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                <div class="input-group-append">
                    <div class="input-group-text"><i class="fas fa-lock"></i></div>
                </div>
            </div>
            
            <!-- Show/Hide Password -->
            <small style="float: right;">
                <a href="#" id="toggle-password" class="font-weight-bold text-info">Show Password</a>
            </small>

            <!-- CAPTCHA -->
            <div class="form-group mt-3 mb-1 text-center">
                <img src="<?= $captcha_image; ?>" alt="CAPTCHA Image" class="img-fluid mt-3">
                <input type="text" name="captcha" class="form-control mt-2" placeholder="Enter CAPTCHA" required>
            </div>

            <!-- Remember Me checkbox -->
            <div class="row mb-3 mt-3">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember Me</label>
                    </div>
                </div>
            </div>
            
            <!-- Sign In button -->
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-info btn-block">Sign In</button>
                </div>
            </div>
        </form>

            <p class="mb-1 text-center mt-3">
                <a href="<?= base_url('forgot-password'); ?>">I forgot my password</a>
            </p>
            <p class="mb-0 text-center">
                <a href="<?= base_url('register'); ?>" class="text-center">Don't have an account? Register</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- Show/Hide Password Script -->
<script>
document.getElementById("toggle-password").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent form submission
    let passwordField = document.getElementById("password");
    let toggleText = this;

    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleText.textContent = "Hide Password";
    } else {
        passwordField.type = "password";
        toggleText.textContent = "Show Password";
    }
});
</script>

<?= $this->endSection(); ?>
