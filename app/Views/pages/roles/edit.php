<?php 
    $errors = session()->getFlashdata('errors') ?? []; 
?>

<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Roles
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item"><a href="<?= base_url('roles') ?>">Roles</a></li>
<li class="breadcrumb-item active">Edit</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-edit mr-2"></i>Edit Role</h3>
                <div class="card-tools">
                </div>
            </div>
            <form action="<?= base_url('roles/update') ?>/<?= esc($role->id) ?>" method="POST">
                <?= csrf_field() ?>
                <div class="card-body">

                    <div class="form-group">
                        <label for="role_name">Role Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?= isset($errors['role_name']) ? 'is-invalid' : '' ?>" id="role_name" name="role_name" placeholder="Enter role name" value="<?= esc($role->role_name) ?>" required>
                        <?php if (isset($errors['role_name'])): ?>
                            <div class="invalid-feedback">
                                <?= $errors['role_name'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>" id="description" name="description" rows="4" placeholder="Enter role description" required><?= esc($role->description) ?></textarea>
                        <?php if (isset($errors['description'])): ?>
                            <div class="invalid-feedback">
                                <?= $errors['description'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-flat">
                        <i class="fas fa-save mr-1"></i>Save
                    </button>
                </div>
            </form>

        </div>
    </div>
</section>
<?= $this->endSection() ?>