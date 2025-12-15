<?= $this->extend('layouts/app'); ?>

<?= $this->section('title') ?>
| View Record Request
<?= $this->endSection() ?>

<?= $this->section('content-header') ?>
View Record Request
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item"><a href="<?= base_url('records') ?>">Records</a></li>
<li class="breadcrumb-item"><a href="<?= base_url('records/requests') ?>">Requests</a></li>
<li class="breadcrumb-item active">View</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Record Request Details</h3>
            </div>

            <div class="card-body">

                <!-- Record Info -->
                <h6 class="text-muted mb-2">Record Information</h6>
                <table class="table table-sm table-borderless">
                    <tr>
                        <th width="200">Record Title</th>
                        <td><?= esc($request->title) ?></td>
                    </tr>
                    <tr>
                        <th>Archived By</th>
                        <td><?= esc($request->archived_by) ?></td>
                    </tr>
                    <tr>
                        <th>Date Archived</th>
                        <td><?= esc($request->archived_at) ?></td>
                    </tr>
                </table>

                <hr>

                <!-- Request Info -->
                <h6 class="text-muted mb-2">Request Information</h6>
                <table class="table table-sm table-borderless">
                    <tr>
                        <th width="200">Request Type</th>
                        <td><?= esc($request->request_type) ?></td>
                    </tr>
                    <tr>
                        <th>Requested By</th>
                        <td><?= esc($request->user_name) ?></td>
                    </tr>
                    <tr>
                        <th>Date Requested</th>
                        <td><?= esc($request->created_at) ?></td>
                    </tr>
                    <tr>
                        <th>Expected Return Date</th>
                        <td><?= esc($request->due_date ?? '—') ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge badge-secondary">
                                <?= esc(ucfirst($request->status)) ?>
                            </span>
                        </td>
                    </tr>
                </table>

                <hr>

                <!-- Remarks -->
                <h6 class="text-muted mb-2">Remarks</h6>
                <p class="mb-0 text-muted">
                    <?= esc($request->remarks ?: 'No remarks provided.') ?>
                </p>

            </div>

            <div class="card-footer text-right">
                <a href="<?= base_url('records/requests') ?>" class="btn btn-sm btn-secondary">
                    Back
                </a>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
