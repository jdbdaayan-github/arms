<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
CREATE ROLE
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
    <li class="breadcrumb-item"><a href="<?= base_url('roles') ?>">Roles</a></li>
    <li class="breadcrumb-item active">Create</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">

        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-shield mr-2"></i>Create Role</h3>
                <div class="card-tools">
                    <a href="<?= base_url('roles') ?>" class="btn btn-tool btn-sm" title="Back to Roles">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>

            <form action="<?= base_url('roles/store') ?>" method="POST">
                <div class="card-body">

                    <div class="form-group">
                        <label for="role_name">Role Name</label>
                        <input type="text" class="form-control" id="role_name" name="role_name" placeholder="Enter role name" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter role description" required></textarea>
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