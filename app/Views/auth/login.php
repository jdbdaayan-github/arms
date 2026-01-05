<?= $this->extend('layouts/guest'); ?>

<?= $this->section('title') ?>
| Login
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="login-box">
  <div class="login-logo d-flex flex-column align-items-center justify-content-center mb-4">
    <div class="d-flex align-items-center">
      <a href="<?= base_url() ?>"><b>ARMS</b></a>
    </div>
    <small style="font-size: 0.8rem; color: #666;">Electronic Records Management System</small>
  </div>
  <!-- /.login-logo -->

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg mb-3">Sign in to start your session</p>

      <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>

      <?php $errors = session()->getFlashdata('errors') ?? []; ?>

      <form action="<?= base_url('auth/authenticate') ?>" method="post" autocomplete="off">
        <?= csrf_field() ?>
        <div class="input-group mb-3">
          <input type="text"
            name="user"
            class="form-control <?= isset($errors['user']) ? 'is-invalid' : '' ?> rounded-0"
            placeholder="Email or Username"
            autofocus
            value="<?= set_value('user') ?>">

          <div class="input-group-append">
            <div class="input-group-text rounded-0">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <?php if (isset($errors['user'])): ?>
            <div class="invalid-feedback">
              <?= $errors['user'] ?>
            </div>
          <?php endif; ?>
        </div>


        <div class="input-group mb-1">
          <input type="password" name="password" id="password" class="form-control rounded-0 <?= isset($errors['password']) ? 'is-invalid' : '' ?>" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text rounded-0">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <?php if (isset($errors['password'])): ?>
          <div class="invalid-feedback">
            <?= $errors['password'] ?>
          </div>
        <?php endif; ?>
        </div>
        

        <div class="mb-3 text-right">
          <span id="togglePassword" class="text-info" style="cursor: pointer; user-select: none;">Show Password</span>
        </div>

        <!-- CAPTCHA -->
        <div class="form-group text-center">
          <img src="<?= $captcha_image ?>" alt="CAPTCHA Image" class="mb-2 img-fluid" style="border: 1px solid #ccc; padding: 4px;">
          <input type="text" name="captcha" class="form-control rounded-0" placeholder="Enter CAPTCHA" required>
        </div>


        <div class="mb-3">
          <div class="icheck-info">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember Me</label>
          </div>
        </div>

        <div>
          <button type="submit" class="btn btn-block btn-info btn-flat">Sign In</button>
        </div>

      </form>

      <p class="mb-1 mt-3 text-center">
        <a href="<?= base_url('auth/forgot') ?>">I forgot my password</a>
      </p>
      <p class="mb-3 text-center">
        Don't have an account?<a href="<?= base_url('auth/register') ?>" class="text-center"> Register here.</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

<script>
  // Show/hide password toggle with "Show" / "Hide" text
  document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      this.textContent = 'Hide Password';
    } else {
      passwordInput.type = 'password';
      this.textContent = 'Show Password';
    }
  });
</script>
<?= $this->endSection(); ?>