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
                    <?php if ($request && $request->title): ?>
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
                    <?php endif ?>

                    <?php if ($request && $request->description): ?>
                        <tr>
                            <th>Description</th>
                            <td><?= esc($request->description) ?></td>
                        </tr>
                    <?php endif ?>
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
                            <?php
                            $badge = match ($request->status) {
                                'approved'  => 'badge-success',
                                'denied'    => 'badge-danger',
                                'completed' => 'badge-primary',
                                default     => 'badge-secondary',
                            };
                            ?>
                            <span class="badge <?= $badge ?>">
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

            <!-- ACTION BUTTONS -->
            <div class="card-footer d-flex justify-content-between">

                <a href="<?= base_url('records/requests') ?>" class="btn btn-sm btn-secondary">
                    Back
                </a>

                <div class="btn-group">

                    <?php if ($request->status === 'Pending'): ?>

                        <form action="<?= base_url('records/requests/approve/' . $request->requestID) ?>"
                            method="post"
                            class="form-approve d-inline">
                            <?= csrf_field() ?>
                            <button type="button" class="btn btn-sm btn-success btn-approve">
                                <i class="fas fa-check"></i> Approve
                            </button>
                        </form>

                        <form action="<?= base_url('records/requests/deny/' . $request->requestID) ?>"
                            method="post"
                            class="form-deny d-inline ml-2">
                            <?= csrf_field() ?>
                            <button type="button" class="btn btn-sm btn-danger btn-deny">
                                <i class="fas fa-times"></i> Deny
                            </button>
                        </form>

                    <?php elseif ($request->status === 'Approved'): ?>

                        <form action="<?= base_url('records/requests/complete/' . $request->requestID) ?>" method="post">
                            <?= csrf_field() ?>
                            <button type="button" class="btn btn-sm btn-primary btn-complete">
                                <i class="fas fa-flag-checkered"></i> Mark as Completed
                            </button>
                        </form>

                    <?php endif ?>

                </div>
            </div>

        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // APPROVE
    document.querySelectorAll('.btn-approve').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('form');

            Swal.fire({
                title: 'Approve request?',
                text: 'This request will be approved.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, approve',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // DENY
    document.querySelectorAll('.btn-deny').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('form');

            Swal.fire({
                title: 'Deny request?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, deny',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    document.querySelectorAll('.btn-complete').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('form');

            Swal.fire({
                title: 'Mark request as completed?',
                text: 'This request will be mark as completed.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Mark as Completed',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

});
</script>

<?= $this->endSection() ?>