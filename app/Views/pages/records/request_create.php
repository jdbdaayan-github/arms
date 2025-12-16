<?= $this->extend('layouts/app'); ?>

<?= $this->section('title') ?>
| Records
<?= $this->endSection() ?>

<?= $this->section('content-header') ?>
Record Request
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item">Records</li>
<li class="breadcrumb-item active">Request</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-file-alt mr-2"></i>Request Record
                </h3>
            </div>

            <div class="card-body">
                <form action="<?= base_url('records/submitRequest/') ?>" method="post">
                    <?= csrf_field() ?>

                    <!-- Free Text Area -->
                    <div class="form-group">
                        <label>Request Description<span class="text-danger"> *</span></label>
                        <textarea
                            class="form-control <?= session('errors.free_text') ? 'is-invalid' : '' ?>"
                            name="free_text"
                            rows="4"
                            placeholder="Enter any details or description related to your request..." required><?= set_value('free_text') ?></textarea>

                        <?php if (session('errors.free_text')): ?>
                            <div class="invalid-feedback">
                                <?= session('errors.free_text') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <!-- Request Type Dropdown -->
                    <div class="form-group">
                        <label>Request Type<span class="text-danger"> *</span></label>
                        <select
                            class="form-control <?= session('errors.request_type') ? 'is-invalid' : '' ?>"
                            name="request_type" required>
                            <option value="" disabled <?= set_value('request_type') ? '' : 'selected' ?>>
                                Select request type
                            </option>

                            <?php foreach ($req_type as $type): ?>
                                <option value="<?= esc($type->id) ?>"
                                    <?= set_value('request_type') == $type->id ? 'selected' : '' ?>>
                                    <?= esc($type->name) ?>
                                </option>
                            <?php endforeach ?>
                        </select>

                        <?php if (session('errors.request_type')): ?>
                            <div class="invalid-feedback">
                                <?= session('errors.request_type') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <!-- Optional Due Date -->
                    <div class="form-group">
                        <label>
                            Expected Return Date
                            <small class="text-muted">(Optional)</small>
                        </label>
                        <input
                            type="date"
                            class="form-control <?= session('errors.due_date') ? 'is-invalid' : '' ?>"
                            name="due_date"
                            value="<?= set_value('due_date') ?>">

                        <?php if (session('errors.due_date')): ?>
                            <div class="invalid-feedback">
                                <?= session('errors.due_date') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <!-- Remarks -->
                    <div class="form-group">
                        <label>Reason / Remarks</label>
                        <textarea
                            class="form-control <?= session('errors.remarks') ? 'is-invalid' : '' ?>"
                            rows="4"
                            name="remarks"
                            placeholder="Enter reason for request..."><?= set_value('remarks') ?></textarea>

                        <?php if (session('errors.remarks')): ?>
                            <div class="invalid-feedback">
                                <?= session('errors.remarks') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <!-- Buttons -->
                    <div class="form-group mt-3 d-flex justify-content-end">
                        <a href="<?= base_url('records') ?>" class="btn btn-secondary mr-2 btn-flat">
                            <i class="fas fa-times mr-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary btn-flat">
                            <i class="fas fa-paper-plane mr-1"></i> Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>