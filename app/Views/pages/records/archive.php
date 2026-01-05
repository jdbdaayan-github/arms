<?= $this->extend('layouts/app'); ?>

<?= $this->section('title') ?>
| Archived Records
<?= $this->endSection() ?>

<?= $this->section('content-header') ?>
Archived Records
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Archive</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-archive mr-2"></i>Archived Records
                </h3>
            </div>

            <div class="card-body">

                <!-- Search + Per Page -->
                <form method="get" class="mb-2 d-flex justify-content-between">
                    <select name="per_page" class="form-control form-control-sm mr-2" style="width:70px;" onchange="this.form.submit()">
                        <?php foreach ([5, 10, 25, 50] as $num): ?>
                            <option value="<?= $num ?>" <?= ($perPage == $num) ? 'selected' : '' ?>>
                                <?= $num ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <div class="input-group input-group-sm" style="max-width:300px;">
                        <input type="text" name="search" value="<?= esc($search ?? '') ?>"
                               class="form-control" placeholder="Search title...">
                        <div class="input-group-append">
                            <button class="btn btn-secondary">
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
                                <th class="text-center" style="width:40px;">
                                    <input type="checkbox" id="check-all">
                                </th>
                                <th>Title</th>
                                <th class="text-center" style="width:20%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recordsArchived)): ?>
                                <?php foreach ($recordsArchived as $record): ?>
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" class="record-checkbox" value="<?= $record->id ?>">
                                        </td>
                                        <td><?= esc($record->title) ?></td>
                                        <td class="text-center">

                                            <?php if (hasPermission('records.view')): ?>
                                                <a href="<?= base_url('records/show/'.$record->id) ?>"
                                                   class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            <?php endif ?>

                                            <?php if (hasPermission('records.restore')): ?>
                                                <button class="btn btn-success btn-sm restore-btn"
                                                        data-id="<?= $record->id ?>">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                            <?php endif ?>

                                            <?php if (hasPermission('records.delete')): ?>
                                                <button class="btn btn-danger btn-sm delete-btn"
                                                        data-id="<?= $record->id ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            <?php endif ?>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center">
                                        No archived records found
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Bulk Buttons -->
                <div class="d-flex my-2">
                    <button id="bulk-restore-btn" class="btn btn-success btn-sm mr-2" style="display:none;">
                        Bulk Restore
                    </button>
                    <button id="bulk-delete-btn" class="btn btn-danger btn-sm" style="display:none;">
                        Bulk Delete
                    </button>
                </div>

                <!-- Pagination -->
                <?php
                $currentPage = $pagerArchived->getCurrentPage('archived');
                $perPage     = $pagerArchived->getPerPage('archived');
                $total       = $pagerArchived->getTotal('archived');
                $totalPages  = ceil($total / $perPage);

                $start = $total ? (($currentPage - 1) * $perPage) + 1 : 0;
                $end   = min($start + $perPage - 1, $total);
                ?>

                <div class="d-flex justify-content-between align-items-center text-sm">
                    <div>
                        Showing <?= $start ?> to <?= $end ?> of <?= $total ?> results
                    </div>

                    <nav>
                        <ul class="pagination pagination-sm m-0">
                            <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $currentPage - 1 ?>">«</a>
                            </li>

                            <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                                <li class="page-item <?= ($page == $currentPage) ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $page ?>">
                                        <?= $page ?>
                                    </a>
                                </li>
                            <?php endfor; ?>

                            <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $currentPage + 1 ?>">»</a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
const checkAll = document.getElementById('check-all');
const checkboxes = document.querySelectorAll('.record-checkbox');
const bulkRestoreBtn = document.getElementById('bulk-restore-btn');
const bulkDeleteBtn = document.getElementById('bulk-delete-btn');

function toggleBulk() {
    const anyChecked = [...checkboxes].some(cb => cb.checked);
    bulkRestoreBtn.style.display = anyChecked ? 'inline-block' : 'none';
    bulkDeleteBtn.style.display = anyChecked ? 'inline-block' : 'none';
}

checkAll?.addEventListener('change', () => {
    checkboxes.forEach(cb => cb.checked = checkAll.checked);
    toggleBulk();
});

checkboxes.forEach(cb => cb.addEventListener('change', toggleBulk));

// Individual actions
document.querySelectorAll('.restore-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        Swal.fire({
            title: 'Restore record?',
            icon: 'question',
            showCancelButton: true
        }).then(r => {
            if (r.isConfirmed)
                location.href = `<?= base_url('records/restore/') ?>${btn.dataset.id}`;
        });
    });
});

document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        Swal.fire({
            title: 'Delete permanently?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33'
        }).then(r => {
            if (r.isConfirmed)
                location.href = `<?= base_url('records/delete/') ?>${btn.dataset.id}`;
        });
    });
});

// Bulk restore
bulkRestoreBtn.addEventListener('click', () => {
    const ids = [...checkboxes].filter(cb => cb.checked).map(cb => cb.value);
    Swal.fire({
        title: 'Bulk Restore?',
        icon: 'question',
        showCancelButton: true
    }).then(r => {
        if (r.isConfirmed)
            location.href = `<?= base_url('records/bulkRestore') ?>?ids=${ids.join(',')}`;
    });
});

// Bulk delete
bulkDeleteBtn.addEventListener('click', () => {
    const ids = [...checkboxes].filter(cb => cb.checked).map(cb => cb.value);
    Swal.fire({
        title: 'Bulk Delete?',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33'
    }).then(r => {
        if (r.isConfirmed)
            location.href = `<?= base_url('records/bulkDelete') ?>?ids=${ids.join(',')}`;
    });
});
</script>

<?php if (session()->has('success')): ?>
<script>
Swal.fire({
    title: 'Success!',
    text: '<?= session('success') ?>',
    icon: 'success'
});
</script>
<?php endif; ?>
<?= $this->endSection() ?>
