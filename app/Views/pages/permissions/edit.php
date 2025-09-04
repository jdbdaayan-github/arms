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

            <?php $errors = session()->getFlashdata('errors') ?? []; ?>

            <form action="<?= base_url('permissions/update/' . $permission->id) ?>" method="POST">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="permission_name">Permission Name</label>
                        <input
                            type="text"
                            class="form-control <?= isset($errors['permission_name']) ? 'is-invalid' : '' ?>"
                            id="permission_name"
                            name="permission_name"
                            value="<?= set_value('permission_name', esc($permission->permission_name)) ?>"
                            placeholder="Enter permission name">
                        <?php if (isset($errors['permission_name'])): ?>
                            <div class="invalid-feedback">
                                <?= $errors['permission_name'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea
                            class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>"
                            id="description"
                            name="description"
                            rows="4"
                            placeholder="Enter permission description"><?= set_value('description', esc($permission->description)) ?></textarea>
                        <?php if (isset($errors['description'])): ?>
                            <div class="invalid-feedback">
                                <?= $errors['description'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save mr-1"></i>Update
                    </button>
                    <a href="<?= base_url('permissions') ?>" class="btn btn-secondary">
                        <i class="fas fa-times mr-1"></i>Cancel
                    </a>
                </div>
            </form>

        </div>
    </div>
</section>
<?= $this->endSection() ?>