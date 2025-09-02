<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
My Profile
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Profile</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card card-outline card-secondary">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-user mr-2"></i>Profile</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Avatar -->
                <div class="col-md-3 text-center">
                    <img src="<?= base_url('assets/img/default-avatar.png') ?>" alt="Avatar" class="img-fluid img-thumbnail mb-3">
                </div>

                <!-- User Info -->
                <div class="col-md-9">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <th style="width:150px;">Full Name:</th>
                            <td>Juan Dela Cruz</td>
                        </tr>
                        <tr>
                            <th>Username:</th>
                            <td>juan.delacruz</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>juan.delacruz@example.com</td>
                        </tr>
                        <tr>
                            <th>Role:</th>
                            <td>Administrator</td>
                        </tr>
                        <tr>
                            <th>Joined:</th>
                            <td>January 1, 2023</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>