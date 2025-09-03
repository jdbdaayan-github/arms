<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Permissions
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
    <li class="breadcrumb-item"><a href="<?= base_url('permissions') ?>">Permissions</a></li>
    <li class="breadcrumb-item active">Edit</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
<div class="container-fluid">

    <div class="card card-outline card-secondary">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-key mr-2"></i>Edit Permission</h3>
        </div>

        <form action="<?= base_url('permissions/store') ?>" method="POST">
            <div class="card-body">

                <div class="form-group">
                    <label for="permission_name">Permission Name</label>
                    <input type="text" class="form-control" id="permission_name" name="permission_name" placeholder="Enter permission name" value="<?= esc($permission->permission_name) ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter permission description" required><?= esc($permission->description) ?></textarea>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save mr-1"></i>Update
                </button>
            </div>
        </form>

    </div>
</div>
</section>
<?= $this->endSection() ?>
