<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
CREATE PERMISSION
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
    <li class="breadcrumb-item"><a href="<?= base_url('permissions') ?>">Permissions</a></li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-key mr-2"></i>Create Permission</h3>
            <div class="card-tools">
                <a href="<?= base_url('permissions') ?>" class="btn btn-tool btn-sm" title="Back to Permissions">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </div>

        <form action="<?= base_url('permissions/store') ?>" method="POST">
            <div class="card-body">

                <div class="form-group">
                    <label for="permission_name">Permission Name</label>
                    <input type="text" class="form-control" id="permission_name" name="permission_name" placeholder="Enter permission name" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter permission description" required></textarea>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-info">
                    <i class="fas fa-save mr-1"></i>Save
                </button>
                <a href="<?= base_url('permissions') ?>" class="btn btn-secondary">
                    <i class="fas fa-times mr-1"></i>Cancel
                </a>
            </div>
        </form>

    </div>
</div>
<?= $this->endSection() ?>
