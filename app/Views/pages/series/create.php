<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Record Series
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item"><a href="<?= base_url('indexes') ?>">Record Series</a></li>
<li class="breadcrumb-item active">Create</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">

    <div class="container-fluid">

        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus mr-2"></i>Create Record Series</h3>
            </div>

            <?php $errors = session()->getFlashdata('errors') ?? []; ?>

            <form action="<?= base_url('series/store') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Series Code <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                            id="name"
                            name="name"
                            value="<?= set_value('name') ?>"
                            placeholder="Enter index name"
                            required>
                        <?php if (isset($errors['name'])): ?>
                            <div class="invalid-feedback">
                                <?= $errors['name'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="name">Series Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                            id="name"
                            name="name"
                            value="<?= set_value('name') ?>"
                            placeholder="Enter index name"
                            required>
                        <?php if (isset($errors['name'])): ?>
                            <div class="invalid-feedback">
                                <?= $errors['name'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="type">Classification <span class="text-danger">*</span></label>
                        <select
                            class="form-control <?= isset($errors['classification_id']) ? 'is-invalid' : '' ?>"
                            id="type"
                            name="type"
                            required>
                            <option value="">-- Select Type --</option>
                            <?php foreach($classifications as $class):?>
                                <option value="<?= $class->id ?>" <?= set_value('classification_id') === 'text' ? 'selected' : '' ?>><?= $class->name ?></option>
                            <?php endforeach ?>
                        </select>
                        <?php if (isset($errors['classification_id'])): ?>
                            <div class="invalid-feedback">
                                <?= $errors['classification_id'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-flat">
                        <i class="fas fa-save mr-1"></i>Save
                    </button>
                </div>
            </form>

        </div>
    </div>
</section>
<?= $this->endSection() ?>