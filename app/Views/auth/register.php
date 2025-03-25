<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>

<div class="register-box">
    <div class="register-logo">
        <a href="#"><b>Admin</b>LTE</a>
    </div>
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new account</p>

            <!-- Display general error messages -->
            <?php if (session()->has('error')) : ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session('error') as $err) : ?>
                            <li><?= esc($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('register') ?>" method="post">
                <?= csrf_field() ?> <!-- CSRF Protection -->

                <div class="input-group mb-3">
                    <input type="text" name="firstName" class="form-control" placeholder="First Name" value="<?= set_value('firstName') ?>" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?php if (session('error.firstName')) : ?>
                    <div class="text-danger"><?= session('error.firstName') ?></div>
                <?php endif; ?>

                <div class="input-group mb-3">
                    <input type="text" name="middleName" class="form-control" placeholder="Middle Name (Optional)" value="<?= set_value('middleName') ?>">
                </div>

                <div class="input-group mb-3">
                    <input type="text" name="lastName" class="form-control" placeholder="Last Name" value="<?= set_value('lastName') ?>" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?php if (session('error.lastName')) : ?>
                    <div class="text-danger"><?= session('error.lastName') ?></div>
                <?php endif; ?>

                <div class="input-group mb-3">
                    <input type="text" name="extensionName" class="form-control" placeholder="Extension Name (e.g., Jr, Sr)" value="<?= set_value('extensionName') ?>">
                </div>

                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" value="<?= set_value('username') ?>" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?php if (session('error.username')) : ?>
                    <div class="text-danger"><?= session('error.username') ?></div>
                <?php endif; ?>

                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?= set_value('email') ?>" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <?php if (session('error.email')) : ?>
                    <div class="text-danger"><?= session('error.email') ?></div>
                <?php endif; ?>

                <div class="input-group mb-1">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <?php if (session('error.password')) : ?>
                    <div class="text-danger"><?= session('error.password') ?></div>
                <?php endif; ?>

                <!-- Show/Hide Password -->
                <div class="text-right mb-3">
                    <small id="togglePassword" style="cursor: pointer; color: blue;">Show Password</small>
                </div>

                <div class="input-group mb-1">
                    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <?php if (session('error.confirmPassword')) : ?>
                    <div class="text-danger"><?= session('error.confirmPassword') ?></div>
                <?php endif; ?>

                <!-- Show/Hide Confirm Password -->
                <div class="text-right mb-3">
                    <small id="toggleConfirmPassword" style="cursor: pointer; color: blue;">Show Password</small>
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="terms" required>
                            <label for="terms">
                                I agree to the <a href="#">terms</a>
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="<?= base_url('login') ?>">Already have an account? Sign in</a>
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

    document.getElementById("toggleConfirmPassword").addEventListener("click", function() {
        let confirmPasswordField = document.getElementById("confirmPassword");
        if (confirmPasswordField.type === "password") {
            confirmPasswordField.type = "text";
            this.textContent = "Hide Password";
        } else {
            confirmPasswordField.type = "password";
            this.textContent = "Show Password";
        }
    });
</script>

<?= $this->endSection() ?>
