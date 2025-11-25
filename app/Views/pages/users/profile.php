<?= $this->extend('layouts/app'); ?>

<?= $this->section('title') ?>
| Profile
<?= $this->endSection() ?>

<?= $this->section('content-header') ?>
My Profile
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">My Profile</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">

        <!-- Profile Info Card -->
        <div class="card card-outline card-primary">
            <div class="card-body">
                <div class="row align-items-stretch">

                    <!-- Left: Profile Picture -->
                    <div class="col-lg-4 col-md-5 col-sm-12 mb-3 mb-md-0 d-flex flex-column align-items-center justify-content-center bg-info text-white"
                         style="padding: 20px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                        <img src="<?= base_url('assets/template/dist/img/user2-160x160.jpg') ?>" 
                             alt="Profile Picture" 
                             class="img-fluid img-thumbnail mb-3"
                             style="max-width: 150px; max-height: 150px; border-radius: 50%;">
                        <h4 class="mb-1 text-center"><?= esc(implode(' ', array_filter([$user->firstname, $user->middlename, $user->lastname, $user->extension]))) ?></h4>
                        <p class="text-light mb-0 text-center"><i class="fas fa-user-shield mr-1"></i><?= esc(session()->get('role')) ?></p>
                    </div>

                    <!-- Right: Editable Info -->
                    <div class="col-lg-8 col-md-7 col-sm-12">
                        <form action="<?= base_url('users/profile/update/') ?><?= $user->id  ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="mb-3 p-3 bg-light border rounded">
                                <h5 class="mb-1">Profile Information</h5>
                                <p class="text-muted mb-0">You can update your personal information below.</p>
                            </div>

                            <div class="flex-grow-1 p-3 border rounded">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-sm mb-0">
                                        <tbody>
                                            <tr>
                                                <th style="width:150px;"><i class="fas fa-user mr-1"></i> First Name</th>
                                                <td><input type="text" name="firstname" class="form-control form-control-sm" value="<?= esc($user->firstname) ?>" required></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fas fa-user-alt mr-1"></i> Middle Initial</th>
                                                <td><input type="text" name="middlename" class="form-control form-control-sm" value="<?= esc($user->middlename ?? '') ?>"></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fas fa-user mr-1"></i> Last Name</th>
                                                <td><input type="text" name="lastname" class="form-control form-control-sm" value="<?= esc($user->lastname) ?>" required></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fas fa-sort-alpha-down mr-1"></i> Extension</th>
                                                <td><input type="text" name="extension" class="form-control form-control-sm" value="<?= esc($user->extension ?? '') ?>"></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fas fa-envelope mr-1"></i> Email</th>
                                                <td><input type="email" name="email" class="form-control form-control-sm" value="<?= esc($user->email) ?>" required></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fas fa-calendar-alt mr-1"></i> Date Joined</th>
                                                <td><input type="text" class="form-control form-control-sm" value="<?= esc(date('F j, Y', strtotime($user->created_at))) ?>" disabled></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-save mr-1"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Change Password Card (same style as above) -->
        <div class="card card-outline card-secondary mt-4">
            <div class="card-body">
                <div class="row align-items-stretch">

                    <!-- Right: Table Form -->
                    <div class="col-sm-12">
                        <form action="<?= base_url('users/profile/change-password/') ?><?= $user->id  ?>" method="post" autocomplete="off">
                            <?= csrf_field() ?>

                            <div class="mb-3 p-3 bg-light border rounded">
                                <h5 class="mb-1">Update Your Password</h5>
                                <p class="text-muted mb-0">Enter your current password and set a new one.</p>
                            </div>

                            <div class="flex-grow-1 p-3 border rounded">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-sm mb-0">
                                        <tbody>
                                            <tr>
                                                <th style="width:150px;"><i class="fas fa-lock mr-1"></i> Old Password</th>
                                                <td><input type="password" name="old_password" class="form-control form-control-sm" required></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fas fa-unlock-alt mr-1"></i> New Password</th>
                                                <td><input type="password" name="new_password" class="form-control form-control-sm" required></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fas fa-check-circle mr-1"></i> Confirm Password</th>
                                                <td><input type="password" name="confirm_password" class="form-control form-control-sm" required></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-save mr-1"></i> Update Password
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
<?= $this->endSection() ?>
<?=  $this->section('scripts') ?>
<?php if (session()->get('success')): ?>
<script>
    Swal.fire({
        title: 'Success!',
        text: '<?=  session()->get('success') ?>',
        icon: 'success',
    });
</script>
<?php endif ?>

<?php if (session()->get('error')): ?>
<script>
    Swal.fire({
        title: 'Error',
        text: '<?= session()->get('error') ?>',
        icon: 'error',
    });
</script>
<?php endif ?>
<?=  $this->endSection() ?>
