<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Borrow Request
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item">Records</li>
<li class="breadcrumb-item active">Borrow Request</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-book-reader mr-2"></i>Request to Borrow Record</h3>
            </div>

            <div class="card-body">
                <!-- Record Details (Text Only) -->
                <div class="mb-3">
                    <p><strong>Record Title:</strong> <?= esc($record->title) ?></p>
                    <p><strong>Archived By:</strong> Maria Santos</p>
                    <p><strong>Date Archived:</strong> Sep 12, 2025</p>
                </div>

                <!-- Input Fields -->
                <form action="<?= base_url('records/submitRequest')?>/<?= $record->id ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label>Expected Return Date <small class="text-muted">(Optional)</small></label>
                        <input type="date" class="form-control" name="due_date">
                    </div>
                    <div class="form-group">
                        <label>Reason / Remarks</label>
                        <textarea class="form-control" rows="4" name="remarks" placeholder="Enter reason for borrowing..."></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="form-group mt-3 d-flex justify-content-end">
                        <a href="#" class="btn btn-secondary mr-2"><i class="fas fa-times mr-1"></i> Cancel</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1"></i> Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
