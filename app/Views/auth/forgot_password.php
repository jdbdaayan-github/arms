<?= $this->extend('layouts/guest'); ?>

<?= $this->section('title')?>
 | Forgot Password
<?= $this->endSection()?>

<?= $this->section('content') ?>
<div class="login-box">
  <div class="login-logo d-flex flex-column align-items-center justify-content-center mb-4">
    <a href="<?= base_url() ?>"><b>ARMS</b></a>
    <small style="font-size: 0.8rem; color: #666;">Electronic Records Management System</small>
  </div>

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg mb-3">Enter your email to reset password</p>

      <form action="<?= base_url('auth/reset') ?>" method="post">
        <?= csrf_field() ?>

        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control rounded-0" placeholder="Email" value="<?= set_value('email') ?>" required>
          <div class="input-group-append">
            <div class="input-group-text rounded-0">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div>
          <button type="submit" class="btn btn-block btn-info btn-flat">Send Reset Link</button>
        </div>
      </form>

      <p class="mb-1 mt-3 text-center">
        Remember your password? <a href="<?= base_url('auth/login') ?>">Sign in</a>
      </p>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>
