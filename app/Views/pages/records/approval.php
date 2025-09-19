<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Records
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Approval</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-secondary">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title"><i class="fas fa-check-circle mr-2"></i>Pending Records Approval</h3>
            </div>

            <div class="card-body">
                <!-- Search + Per Page -->
                <form method="get" class="mb-2 d-flex justify-content-between">
                    <select name="per_page" class="form-control form-control-sm mr-2" style="width:55px;" onchange="this.form.submit()">
                        <?php foreach ([5, 10, 25, 50] as $num): ?>
                            <option value="<?= $num ?>" <?= ($perPage == $num) ? 'selected' : '' ?>><?= $num ?></option>
                        <?php endforeach; ?>
                    </select>

                    <div class="input-group input-group-sm" style="max-width: 300px;">
                        <input type="text" name="search" value="<?= esc($search ?? '') ?>" class="form-control" placeholder="Search Title...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm mb-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <input type="checkbox" id="check-all">
                                </th>
                                <th>Title</th>
                                <th style="width:20%;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($records)): ?>
                                <?php foreach ($records as $record): ?>
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" class="record-checkbox" value="<?= $record->id ?>">
                                        </td>
                                        <td><?= esc($record->title) ?></td>
                                        <td class="text-center">
                                            <?php if(hasPermission('records.view')): ?>
                                                <a href="<?= base_url('records/show/' . $record->id) ?>" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            <?php endif ?>
                                            <?php if(hasRole('Records Officer') || hasPermission('records.approve')): ?>
                                                <button class="btn btn-success btn-sm approve-btn" data-id="<?= $record->id ?>">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm reject-btn" data-id="<?= $record->id ?>">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center">No pending records for approval</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Bulk Buttons at Bottom Center -->
                <div class="d-flex my-2">
                    <button id="bulk-approve-btn" class="btn btn-success btn-flat btn-sm mr-2" style="display:none;">
                        Bulk Approve
                    </button>
                    <button id="bulk-reject-btn" class="btn btn-danger btn-flat btn-sm" style="display:none;">
                        Bulk Reject
                    </button>
                </div>

                <!-- Pagination Info -->
                <div class="d-flex justify-content-between align-items-center text-sm">
                    <div>
                        <?php
                        $currentPage = $pager->getCurrentPage();
                        $perPage     = $pager->getPerPage();
                        $total       = $pager->getTotal();

                        $start = ($total > 0) ? (($currentPage - 1) * $perPage) + 1 : 0;
                        $end   = ($start + count($records) - 1);
                        ?>
                        Showing <?= $start ?> to <?= $end ?> of <?= $total ?> results
                    </div>

                    <div>
                        <?= $pager->links('default', 'default_full') ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Individual Approve / Reject
    document.querySelectorAll('.approve-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            Swal.fire({
                title: 'Approve Record?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Approve',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if(result.isConfirmed){
                    window.location.href = `<?= base_url('records/approve/') ?>${id}`;
                }
            });
        });
    });

    document.querySelectorAll('.reject-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            Swal.fire({
                title: 'Reject Record?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Reject',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if(result.isConfirmed){
                    window.location.href = `<?= base_url('records/reject/') ?>${id}`;
                }
            });
        });
    });

    // Check / Uncheck all & Bulk Buttons
    const checkAll = document.getElementById('check-all');
    const checkboxes = document.querySelectorAll('.record-checkbox');
    const bulkApproveBtn = document.getElementById('bulk-approve-btn');
    const bulkRejectBtn = document.getElementById('bulk-reject-btn');

    function toggleBulkButtons() {
        const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
        bulkApproveBtn.style.display = anyChecked ? 'inline-block' : 'none';
        bulkRejectBtn.style.display = anyChecked ? 'inline-block' : 'none';
    }

    checkAll.addEventListener('change', () => {
        checkboxes.forEach(cb => cb.checked = checkAll.checked);
        toggleBulkButtons();
    });

    checkboxes.forEach(cb => cb.addEventListener('change', toggleBulkButtons));

    // Bulk Approve
    bulkApproveBtn.addEventListener('click', () => {
        const selectedIds = Array.from(checkboxes)
                                .filter(cb => cb.checked)
                                .map(cb => cb.value);
        if(selectedIds.length === 0) return;

        Swal.fire({
            title: 'Bulk Approve?',
            text: `Selected IDs: ${selectedIds.join(', ')}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Approve',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = `<?= base_url('records/bulkApprove') ?>?ids=${selectedIds.join(',')}`;
            }
        });
    });

    // Bulk Reject
    bulkRejectBtn.addEventListener('click', () => {
        const selectedIds = Array.from(checkboxes)
                                .filter(cb => cb.checked)
                                .map(cb => cb.value);
        if(selectedIds.length === 0) return;

        Swal.fire({
            title: 'Bulk Reject?',
            text: `Selected IDs: ${selectedIds.join(', ')}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Reject',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = `<?= base_url('records/bulkReject') ?>?ids=${selectedIds.join(',')}`;
            }
        });
    });
</script>
<?= $this->endSection() ?>
