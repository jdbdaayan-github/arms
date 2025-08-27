<?= $this->extend('layouts/guest'); ?>

<?= $this->section('title') ?>
Register
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="login-box">
  <div class="login-logo d-flex flex-column align-items-center justify-content-center mb-4">
    <a href="<?= base_url() ?>"><b>ARMS</b></a>
    <small style="font-size: 0.8rem; color: #666;">Electronic Records Management System</small>
  </div>

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg mb-3">Create your account</p>

      <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
      <?php endif; ?>

      <form action="<?= base_url('register/store') ?>" method="post" autocomplete="off">
        <?= csrf_field() ?>

        <!-- First Name -->
        <div class="input-group mb-3">
          <input type="text" name="firstname" class="form-control rounded-0" placeholder="First Name" value="<?= set_value('firstname') ?>" required>
          <div class="input-group-append">
            <div class="input-group-text rounded-0">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <!-- Middle Name -->
        <div class="input-group mb-3">
          <input type="text" name="middlename" class="form-control rounded-0" placeholder="Middle Name" value="<?= set_value('middlename') ?>">
          <div class="input-group-append">
            <div class="input-group-text rounded-0">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <!-- Last Name -->
        <div class="input-group mb-3">
          <input type="text" name="lastname" class="form-control rounded-0" placeholder="Last Name" value="<?= set_value('lastname') ?>" required>
          <div class="input-group-append">
            <div class="input-group-text rounded-0">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <!-- Extension -->
        <div class="input-group mb-3">
          <input type="text" name="extension" class="form-control rounded-0" placeholder="Extension (Jr., Sr., etc.)" value="<?= set_value('extension') ?>">
          <div class="input-group-append">
            <div class="input-group-text rounded-0">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <!-- Email -->
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control rounded-0" placeholder="Email" value="<?= set_value('email') ?>" required>
          <div class="input-group-append">
            <div class="input-group-text rounded-0">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <!-- Username -->
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control rounded-0" placeholder="Username" value="<?= set_value('username') ?>" required>
          <div class="input-group-append">
            <div class="input-group-text rounded-0">
              <span class="fas fa-user-circle"></span>
            </div>
          </div>
        </div>

        <!-- Password -->
        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control rounded-0" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text rounded-0">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <!-- Confirm Password -->
        <div class="input-group mb-1">
          <input type="password" name="password_confirm" id="password_confirm" class="form-control rounded-0" placeholder="Confirm Password" required>
          <div class="input-group-append">
            <div class="input-group-text rounded-0">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="mb-3 text-right">
          <span id="togglePassword" class="text-info" style="cursor: pointer; user-select: none;">Show Passwords</span>
        </div>

        <!-- CAPTCHA -->
        <div class="form-group text-center mb-3">
          <img src="<?= $captcha_image ?>" alt="CAPTCHA Image" class="mb-2 img-fluid" style="border: 1px solid #ccc; padding: 4px;">
          <input type="text" name="captcha" class="form-control rounded-0" placeholder="Enter CAPTCHA" required>
        </div>

        <!-- Submit -->
        <div>
          <button type="submit" class="btn btn-block btn-info btn-flat">Register</button>
        </div>
      </form>

      <p class="mb-1 mt-3 text-center">
        Already have an account? <a href="<?= base_url('auth/login') ?>">Sign in</a>
      </p>
    </div>
  </div>
</div>

<script>
  const togglePassword = document.getElementById('togglePassword');
  if(togglePassword){
    togglePassword.addEventListener('click', function () {
      const pwd = document.getElementById('password');
      const confirmPwd = document.getElementById('password_confirm');
      if (pwd.type === 'password') {
        pwd.type = 'text';
        confirmPwd.type = 'text';
        this.textContent = 'Hide Passwords';
      } else {
        pwd.type = 'password';
        confirmPwd.type = 'password';
        this.textContent = 'Show Passwords';
      }
    });
  }
</script>
<?= $this->endSection(); ?>
