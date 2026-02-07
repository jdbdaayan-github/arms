<?= $this->extend('layouts/guest'); ?>

<?= $this->section('title')?>
  Reset Password
<?= $this->endSection()?>

<?= $this->section('content') ?>
<div class="login-box">
  <div class="login-logo d-flex flex-column align-items-center justify-content-center mb-4">
    <a href="<?= base_url() ?>"><b>ARMS</b></a>
    <small style="font-size: 0.8rem; color: #666;">Archival Records Management System</small>
  </div>

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg mb-3">Enter your new password</p>

      <form action="<?= base_url('reset_password/update') ?>" method="post" autocomplete="off">
        <?= csrf_field() ?>

        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control rounded-0" placeholder="New Password" required>
          <div class="input-group-append">
            <div class="input-group-text rounded-0">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-1">
          <input type="password" name="password" id="password" class="form-control rounded-0" placeholder="Confirm Password" required>
          <div class="input-group-append">
            <div class="input-group-text rounded-0">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="mb-3 text-right">
          <span id="togglePassword" class="text-info" style="cursor: pointer; user-select: none;">Show Password</span>
        </div>

        <div>
          <button type="submit" class="btn btn-block btn-info btn-flat">Reset Password</button>
        </div>
      </form>

      <p class="mb-1 mt-3 text-center">
        Remember your password? <a href="<?= base_url('login') ?>">Sign in</a>
      </p>
    </div>
  </div>
</div>

<script>
  const togglePassword = document.getElementById('togglePassword');
  if(togglePassword){
    togglePassword.addEventListener('click', function () {
      const passwordInput = document.getElementById('password');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        this.textContent = 'Hide Password';
      } else {
        passwordInput.type = 'password';
        this.textContent = 'Show Password';
      }
    });
  }
</script>
<?= $this->endSection(); ?>
