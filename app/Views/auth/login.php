<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>ARMS</b></a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <!-- Error/Success Flash Messages -->
            <?php if (session()->has('error')) : ?>
                <div class="alert alert-danger"><?= session('error') ?></div>
            <?php endif; ?>
            <?php if (session()->has('success')) : ?>
                <div class="alert alert-success"><?= session('success') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('login') ?>" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-1">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <!-- Show/Hide Password Text -->
                <div class="text-right mb-3">
                    <small id="togglePassword" style="cursor: pointer; color: blue;">Show Password</small>
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>

            <p class="mb-1">
                <a href="#">Forgot password?</a>
            </p>
            <p class="mb-0">
                <a href="<?= base_url('register') ?>" class="text-center">Register a new membership</a>
            </p>
        </div>
    </div>
</div>

<script>
    document.getElementById("togglePassword").addEventListener("click", function() {
        let passwordField = document.getElementById("password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            this.textContent = "Hide Password";
        } else {
            passwordField.type = "password";
            this.textContent = "Show Password";
        }
    });
</script>

<?= $this->endSection() ?>
