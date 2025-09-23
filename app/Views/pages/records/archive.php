<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Records
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Archive</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-archive mr-2"></i>Records Archive</h3>
            </div>

            <div class="card-body">
                <!-- Tabs -->
                <ul class="nav nav-tabs mb-3" id="archiveTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="archived-tab" data-toggle="tab" href="#archived" role="tab">
                            Archived
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="for-archive-tab" data-toggle="tab" href="#for-archive" role="tab">
                            For Archival
                            <span class="right badge badge-warning"><?= $pendingForArchivalCount ?></span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="archiveTabsContent">
                    <!-- Archived Tab -->
                    <div class="tab-pane fade show active" id="archived" role="tabpanel" aria-labelledby="archived-tab">
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
                                        <th class="text-center"><input type="checkbox" id="check-all-archived"></th>
                                        <th>Title</th>
                                        <th class="text-center" style="width:20%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($recordsArchived)): ?>
                                        <?php foreach ($recordsArchived as $record): ?>
                                            <tr>
                                                <td class="text-center"><input type="checkbox" class="archived-checkbox" value="<?= $record->id ?>"></td>
                                                <td><?= esc($record->title) ?></td>
                                                <td class="text-center">
                                                    <?php if(hasPermission('records.view')): ?>
                                                        <a href="<?= base_url('records/show/' . $record->id) ?>" class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    <?php endif ?>
                                                    <?php if(hasPermission('records.restore')): ?>
                                                        <button class="btn btn-success btn-sm restore-btn" data-id="<?= $record->id ?>">
                                                            <i class="fas fa-undo"></i>
                                                        </button>
                                                    <?php endif ?>
                                                    <?php if(hasPermission('records.delete')): ?>
                                                        <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $record->id ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="3" class="text-center">No archived records found</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Bulk Buttons -->
                        <div class="d-flex my-2">
                            <button id="bulk-restore-btn" class="btn btn-success btn-flat btn-sm mr-2" style="display:none;">Bulk Restore</button>
                            <button id="bulk-delete-btn" class="btn btn-danger btn-flat btn-sm" style="display:none;">Bulk Delete</button>
                        </div>

                        <!-- Pagination Info -->
                        <div class="d-flex justify-content-between align-items-center text-sm">
                            <div>
                                <?php
                                $currentPage = $pagerArchived->getCurrentPage('archived');
                                $perPage     = $pagerArchived->getPerPage('archived');
                                $total       = $pagerArchived->getTotal('archived');

                                $start = ($total > 0) ? (($currentPage - 1) * $perPage) + 1 : 0;
                                $end   = ($start + count($recordsArchived) - 1);
                                ?>
                                Showing <?= $start ?> to <?= $end ?> of <?= $total ?> results
                            </div>
                            <div><?= $pagerArchived->links('archived', 'default_full') ?></div>
                        </div>
                    </div>

                    <!-- For Archival Tab -->
                    <div class="tab-pane fade" id="for-archive" role="tabpanel" aria-labelledby="for-archive-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm mb-1">
                                <thead>
                                    <tr>
                                        <th class="text-center"><input type="checkbox" id="check-all-for-archive"></th>
                                        <th>Title</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($recordsForArchival)): ?>
                                        <?php foreach ($recordsForArchival as $record): ?>
                                            <tr>
                                                <td class="text-center"><input type="checkbox" class="for-archive-checkbox" value="<?= $record->id ?>"></td>
                                                <td><?= esc($record->title) ?></td>
                                                <td class="text-center">
                                                    <?php if(hasPermission('records.view')): ?>
                                                        <a href="<?= base_url('records/show/' . $record->id) ?>" class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    <?php endif ?>
                                                    <?php if(hasPermission('records.archive')): ?>
                                                        <button class="btn btn-warning btn-sm archive-btn" data-id="<?= $record->id ?>">
                                                            <i class="fas fa-archive"></i>
                                                        </button>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="3" class="text-center">No records ready for archival</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Bulk Buttons -->
                        <div class="d-flex my-2">
                            <button id="bulk-archive-btn" class="btn btn-warning btn-flat btn-sm" style="display:none;">Bulk Archive</button>
                        </div>

                        <!-- Pagination Info -->
                        <div class="d-flex justify-content-between align-items-center text-sm">
                            <div>
                                <?php
                                $currentPage = $pagerForArchival->getCurrentPage('for_archival');
                                $perPage     = $pagerForArchival->getPerPage('for_archival');
                                $total       = $pagerForArchival->getTotal('for_archival');

                                $start = ($total > 0) ? (($currentPage - 1) * $perPage) + 1 : 0;
                                $end   = ($start + count($recordsForArchival) - 1);
                                ?>
                                Showing <?= $start ?> to <?= $end ?> of <?= $total ?> results
                            </div>
                            <div><?= $pagerForArchival->links('for_archival', 'default_full') ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // ✅ Handle checkbox toggles
    function toggleBulkButtons(checkboxes, buttons) {
        const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
        buttons.forEach(btn => btn.style.display = anyChecked ? 'inline-block' : 'none');
    }

    // Archived Tab
    const checkAllArchived = document.getElementById('check-all-archived');
    const archivedCheckboxes = document.querySelectorAll('.archived-checkbox');
    const bulkRestoreBtn = document.getElementById('bulk-restore-btn');
    const bulkDeleteBtn = document.getElementById('bulk-delete-btn');

    if (checkAllArchived) {
        checkAllArchived.addEventListener('change', () => {
            archivedCheckboxes.forEach(cb => cb.checked = checkAllArchived.checked);
            toggleBulkButtons(archivedCheckboxes, [bulkRestoreBtn, bulkDeleteBtn]);
        });
    }
    archivedCheckboxes.forEach(cb => cb.addEventListener('change', () => toggleBulkButtons(archivedCheckboxes, [bulkRestoreBtn, bulkDeleteBtn])));

    // For Archival Tab
    const checkAllForArchive = document.getElementById('check-all-for-archive');
    const forArchiveCheckboxes = document.querySelectorAll('.for-archive-checkbox');
    const bulkArchiveBtn = document.getElementById('bulk-archive-btn');

    if (checkAllForArchive) {
        checkAllForArchive.addEventListener('change', () => {
            forArchiveCheckboxes.forEach(cb => cb.checked = checkAllForArchive.checked);
            toggleBulkButtons(forArchiveCheckboxes, [bulkArchiveBtn]);
        });
    }
    forArchiveCheckboxes.forEach(cb => cb.addEventListener('change', () => toggleBulkButtons(forArchiveCheckboxes, [bulkArchiveBtn])));

    // ✅ Individual Swal Actions
    document.querySelectorAll('.archive-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            Swal.fire({
                title: 'Archive Record?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Archive'
            }).then((result) => {
                if(result.isConfirmed){
                    window.location.href = `<?= base_url('records/archive/') ?>${id}`;
                }
            });
        });
    });

    document.querySelectorAll('.restore-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            Swal.fire({
                title: 'Restore Record?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Restore'
            }).then((result) => {
                if(result.isConfirmed){
                    window.location.href = `<?= base_url('records/restore/') ?>${id}`;
                }
            });
        });
    });

    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            Swal.fire({
                title: 'Delete Permanently?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete',
                confirmButtonColor: '#d33'
            }).then((result) => {
                if(result.isConfirmed){
                    window.location.href = `<?= base_url('records/delete/') ?>${id}`;
                }
            });
        });
    });

    // ✅ Bulk Swal Actions
    bulkArchiveBtn.addEventListener('click', () => {
        const selectedIds = Array.from(forArchiveCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
        if(selectedIds.length === 0) return;

        Swal.fire({
            title: 'Bulk Archive?',
            text: `Selected IDs: ${selectedIds.join(', ')}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Archive'
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = `<?= base_url('records/bulkArchive') ?>?ids=${selectedIds.join(',')}`;
            }
        });
    });

    bulkRestoreBtn.addEventListener('click', () => {
        const selectedIds = Array.from(archivedCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
        if(selectedIds.length === 0) return;

        Swal.fire({
            title: 'Bulk Restore?',
            text: `Selected IDs: ${selectedIds.join(', ')}`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Restore'
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = `<?= base_url('records/bulkRestore') ?>?ids=${selectedIds.join(',')}`;
            }
        });
    });

    bulkDeleteBtn.addEventListener('click', () => {
        const selectedIds = Array.from(archivedCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
        if(selectedIds.length === 0) return;

        Swal.fire({
            title: 'Bulk Delete?',
            text: `This will permanently delete: ${selectedIds.join(', ')}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = `<?= base_url('records/bulkDelete') ?>?ids=${selectedIds.join(',')}`;
            }
        });
    });
</script>
<?= $this->endSection() ?>
