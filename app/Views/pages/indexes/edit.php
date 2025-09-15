<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Record Indexes
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item"><a href="<?= base_url('indexes') ?>">Record Indexes</a></li>
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

            <form action="<?= base_url('indexes/update') ?>/<?= $index->id ?>" method="POST">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Index Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                            id="name"
                            name="name"
                            value="<?= esc($index->name) ?>"
                            placeholder="Enter index name"
                            required>
                        <?php if (isset($errors['name'])): ?>
                            <div class="invalid-feedback">
                                <?= $errors['name'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="type">Index Type <span class="text-danger">*</span></label>
                        <select
                            class="form-control <?= isset($errors['type']) ? 'is-invalid' : '' ?>"
                            id="type"
                            name="type"
                            required>
                            <option value="">-- Select Type --</option>
                            <option value="text" <?= esc($index->type) === 'text' ? 'selected' : '' ?>>Text</option>
                            <option value="number" <?= esc($index->type) === 'number' ? 'selected' : '' ?>>Number</option>
                            <option value="number" <?= esc($index->type) === 'email' ? 'selected' : '' ?>>Email</option>
                            <option value="date" <?= esc($index->type) === 'date' ? 'selected' : '' ?>>Date</option>
                        </select>
                        <?php if (isset($errors['type'])): ?>
                            <div class="invalid-feedback">
                                <?= $errors['type'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="name">Index Length <span class="text-danger">*</span></label>
                        <input
                            type="number"
                            class="form-control <?= isset($errors['length']) ? 'is-invalid' : '' ?>"
                            id="length"
                            name="length"
                            value="<?= esc($index->length) ?>"
                            placeholder="Enter index length"
                            required>
                        <?php if (isset($errors['length'])): ?>
                            <div class="invalid-feedback">
                                <?= $errors['length'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="name">Placeholder<span class="text-danger"></span></label>
                        <input
                            type="text"
                            class="form-control <?= isset($errors['placeholder']) ? 'is-invalid' : '' ?>"
                            id="placeholder"
                            name="placeholder"
                            value="<?= esc($index->placeholder) ?>"
                            placeholder="Enter index placeholder">
                        <?php if (isset($errors['placeholder'])): ?>
                            <div class="invalid-feedback">
                                <?= $errors['placeholder'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="required">Required <span class="text-danger">*</span></label>
                        <select
                            class="form-control <?= isset($errors['type']) ? 'is-invalid' : '' ?>"
                            id="type"
                            name="required"
                            required>
                            <option value="1" <?= esc($index->required) === '1' ? 'selected' : '' ?>>Yes</option>
                            <option value="0" <?= esc($index->required) === '0' ? 'selected' : '' ?>>No</option>
                        </select>
                        <?php if (isset($errors['required'])): ?>
                            <div class="invalid-feedback">
                                <?= $errors['required'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-flat">
                        <i class="fas fa-edit mr-1"></i>Update
                    </button>
                </div>
            </form>

        </div>
    </div>
</section>
<?= $this->endSection() ?>