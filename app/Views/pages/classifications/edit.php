<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Classifications
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item"><a href="<?= base_url('classifications') ?>">Classifications</a></li>
<li class="breadcrumb-item active">Edit</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">

    <div class="container-fluid">

        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-edit mr-2"></i>Edit Classification</h3>
            </div>

            <?php $errors = session()->getFlashdata('errors') ?? []; ?>

            <form action="<?= base_url('classifications/update') ?>/<?= $classification->id ?>" method="POST">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="permission_name">Classification Code</label>
                        <input
                            type="text"
                            class="form-control <?= isset($errors['code']) ? 'is-invalid' : '' ?>"
                            id="code"
                            name="code"
                            value="<?= $classification->code ?>"
                            placeholder="Enter classification code">
                        <?php if (isset($errors['code'])): ?>
                            <div class="invalid-feedback">
                                <?= $errors['code'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="name">Classification Name</label>
                        <input
                            type="text"
                            class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                            id="name"
                            name="name"
                            value="<?= $classification->name ?>"
                            placeholder="Enter classification name">
                        <?php if (isset($errors['name'])): ?>
                            <div class="invalid-feedback">
                                <?= $errors['name'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-flat">
                        <i class="fas fa-edit mr-1"></i>Update
                    </button>
                </div>
            </form>

        </div>
    </div>
</section>
<?= $this->endSection() ?>