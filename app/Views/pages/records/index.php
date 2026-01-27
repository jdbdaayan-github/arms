<style>
    /* === Expand Button Styling === */
    .toggle-row {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s ease-in-out;
    }

    .toggle-row i {
        transition: transform 0.2s ease;
    }

    .toggle-row:hover {
        background-color: #e2e6ea;
        border-color: #adb5bd;
    }

    /* === Expanded Row === */
    .expandable-row {
        transition: all 0.25s ease-in-out;
    }

    .expandable-row td {
        border-top: none !important;
    }

    .expandable-row .row>div {
        font-size: 0.9rem;
        color: #333;
    }

    .expandable-row .btn {
        font-size: 12px;
    }

    .bg-light {
        background-color: #f8f9fa !important;
    }

    /* Optional slide effect */
    .slide-toggle {
        display: none;
    }
</style>

<?= $this->extend('layouts/app'); ?>

<?= $this->section('title') ?>
| Records
<?= $this->endSection() ?>

<?= $this->section('content-header') ?>
Records
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Records</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-secondary">
            <div class="card-header d-flex align-items-center justify-content-between py-1">
                <h3 class="card-title"><i class="fas fa-folder-open mr-2"></i>Records List</h3>
                <!-- records.create permission -->
                <?php if (hasRole('Superadmin') || hasPermission('records.create') || hasRole('Standard User')): ?>
                    <div class="card-tools  ml-auto mr-0">
                        <a href="<?= base_url('records/create') ?>" class="btn btn-primary btn-flat btn-sm" style="font-size:12px;">
                            <i class="fas fa-plus"></i> Add Record
                        </a>
                    </div>
                <?php endif ?>
            </div>

            <div class="card-body">
                <!-- Search + Per Page -->
                <form method="get" class="mb-2 d-flex justify-content-between">
                    <div class="d-flex"><select name="per_page" class="form-control form-control-sm mr-2" style="width:55px;" onchange="this.form.submit()">
                            <?php foreach ([5, 10, 25, 50] as $num): ?>
                                <option value="<?= $num ?>" <?= ($perPage == $num) ? 'selected' : '' ?>><?= $num ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select name="status_id" class="form-control form-control-sm mr-2" onchange="this.form.submit()">
                            <option value="">All</option>
                            <?php foreach ($statuses as $status): ?>
                                <option value="<?= $status->id ?>" <?= ($status->id == $status_id) ? 'selected' : '' ?>><?= $status->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


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
                                <th style="width: 40px;" class="text-center"></th>
                                <th>Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($records)): ?>
                                <?php foreach ($records as $record): ?>
                                    <tr>
                                        <!-- + Button (for mobile expand) -->
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-sm btn-outline-secondary toggle-row" data-id="<?= $record->id ?>" style="border:0;">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </td>

                                        <td class="align-middle"><a href="<?= base_url('records/show/' . $record->id) ?>"><?= esc($record->title) ?></a><a href="javascript:void(0)" class="text-<?= ($record->is_bookmarked)?'warning':'secondary'  ?> ?> float-right align-middle d-flex"><i class="fas fa-star star-id" data-id="<?= $record->id ?>" data-mark = '<?=  $record->is_bookmarked ?>'></i></a></td>
                                        <?php
                                        $view_enabled = hasRole('Superadmin')
                                            || (hasPermission('records.view') && $record->status_id == 4)
                                            || hasRecordPermission($record->id, 'view');

                                        $edit_enabled = hasRole('Superadmin')
                                            || hasRole('Administrator')
                                            || (hasPermission('records.edit') && $record->status_id == 1)
                                            || hasRecordPermission($record->id, 'edit');
                                        ?>
                                    </tr>

                                    <!-- EXPANDABLE ROW (MOBILE ACTIONS) -->
                                    <tr class="expandable-row d-none" id="expand-<?= $record->id ?>">

                                        <td colspan="3" class="bg-light p-2">
                                            <div class="row d-flex justify-content-around gap-1">
                                                <div><b>Created By:</b> <?= $record->user_name ?></div>
                                                <div><b>Created at:</b> <?= date('F d, Y', strtotime($record->created_at)) ?></div>
                                                <div><b>Status:</b> <?= $record->status ?></div>
                                                <div><b>Access:</b> <?= ($record->confidential == 0) ? 'Public' : 'Confidential' ?></div>
                                            </div>
                                            <hr class="m-2">
                                            <div class="d-flex flex-wrap justify-content-center">

                                                <?php if ($edit_enabled): ?>
                                                    <a class="btn btn-info btn-sm mr-1 mb-1" href="<?= base_url('records/edit/' . $record->id) ?>">
                                                        <i class="fas fa-edit mr-1"></i> Edit
                                                    </a>
                                                <?php endif ?>

                                                <?php if (hasRole('Superadmin') || hasPermission('records.workflow')): ?>
                                                    <a class="btn btn-primary btn-sm mr-1 mb-1" href="<?= base_url('records/workflow/' . $record->id) ?>">
                                                        <i class="fas fa-map-marked-alt mr-1"></i> Track
                                                    </a>
                                                <?php endif ?>

                                                <?php if (hasRole('Superadmin') || hasRole('Administrator')): ?>
                                                    <button class="btn btn-warning btn-sm mr-1 mb-1">
                                                        <i class="fas fa-archive mr-1"></i> Soft Delete
                                                    </button>
                                                    <button class="btn btn-danger btn-sm mr-1 mb-1">
                                                        <i class="fas fa-trash mr-1"></i> Delete
                                                    </button>
                                                <?php endif ?>

                                                <?php if (hasRole('Superadmin') || hasRole('Administrator') || hasRole('Contributor')): ?>
                                                    <a class="btn btn-secondary btn-sm mr-1 mb-1" href="<?= base_url('records/request/' . $record->id) ?>">
                                                        <i class="fas fa-book-reader mr-1"></i> Make Request
                                                    </a>
                                                <?php endif ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center">No records found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Info -->
                <?php
                $currentPage = $pager->getCurrentPage();
                $perPage     = $pager->getPerPage();
                $total       = $pager->getTotal();

                $totalPages = ceil($total / $perPage);
                ?>

                <!-- Pagination Info + Controls -->
                <div class="d-flex justify-content-between align-items-center text-sm">
                    <!-- Left: Showing info -->
                    <div>
                        <?php
                        if ($total > 0) {
                            $start = (($currentPage - 1) * $perPage) + 1;
                            $end   = min($start + $perPage - 1, $total);
                        } else {
                            $start = 0;
                            $end   = 0;
                        }

                        // Build query string except 'page'
                        $query = $_GET;
                        unset($query['page']);
                        $queryString = http_build_query($query);
                        $queryString = $queryString ? "&" . $queryString : "";
                        ?>
                        Showing <?= $start ?> to <?= $end ?> of <?= $total ?> results
                    </div>

                    <!-- Right: Pagination -->
                    <nav>
                        <ul class="pagination pagination-sm m-0">
                            <!-- Prev button -->
                            <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $currentPage - 1 ?><?= $queryString ?>">«</a>
                            </li>

                            <!-- Page numbers -->
                            <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                                <li class="page-item <?= ($page == $currentPage) ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $page ?><?= $queryString ?>"><?= $page ?></a>
                                </li>
                            <?php endfor; ?>

                            <!-- Next button -->
                            <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $currentPage + 1 ?><?= $queryString ?>">»</a>
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
<?php if (session()->get('success')): ?>
    <script>
        Swal.fire({
            title: 'Success!',
            text: 'Record has been created successfully.',
            icon: 'success',
            showCancelButton: false,
            showDenyButton: true,
            showConfirmButton: true,
            confirmButtonText: 'View Details',
            denyButtonText: 'Upload New',
            cancelButtonText: 'Close',
            showCloseButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('records/show/') ?>" + "<?= session()->get('success') ?>";
            } else if (result.isDenied) {
                window.location.href = "<?= base_url('records/create') ?>";
            }
        });
    </script>
<?php endif; ?>
<?php if (session()->get('up_success')): ?>
    <script>
        Swal.fire({
            title: 'Success!',
            text: 'Record has been updated successfully.',
            icon: 'success',
            showCancelButton: false,
            showDenyButton: true,
            showConfirmButton: true,
            confirmButtonText: 'View Details',
            denyButtonText: 'Upload New',
            cancelButtonText: 'Close',
            showCloseButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('records/show/') ?>" + "<?= session()->get('up_success') ?>";
            } else if (result.isDenied) {
                window.location.href = "<?= base_url('records/create') ?>";
            }
        });
    </script>
<?php endif; ?>

<?php if (session()->get('req_success')): ?>
    <script>
        Swal.fire({
            title: 'Success!',
            text: '<?= session()->get('req_success') ?>',
            icon: 'success',
            showCloseButton: true,
            showConfirmButton: true,
        })
    </script>
<?php endif ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-row').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const row = document.getElementById(`expand-${id}`);
                const icon = this.querySelector('i');

                if (row.classList.contains('d-none')) {
                    row.classList.remove('d-none');
                    icon.classList.replace('fa-plus', 'fa-minus');
                } else {
                    row.classList.add('d-none');
                    icon.classList.replace('fa-minus', 'fa-plus');
                }
            });
        });
    });
</script>
<script>
    document.querySelectorAll('.star-id').forEach(star => {
        star.addEventListener('click', function(e) {
            e.preventDefault();
            const id = e.target.dataset.id;
            const mark = e.target.dataset.mark;;
            Swal.fire({
                title: 'Bookmark',
                text: mark == true ? 'Remove bookmark on this record?': 'Add bookmark on this record?',
                icon: 'question',
                showCloseButton: true,
                showDenyButton: true,
                confirmButtonText: mark == true ? 'Remove Bookmark': 'Add Bookmark',
                denyButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    let csrfName = '<?= csrf_token() ?>';
                    let csrfHash = '<?= csrf_hash() ?>';

                    fetch('<?= base_url('records/bookmark') ?>/' + id, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfHash
                            },
                            body: JSON.stringify({
                                [csrfName]: csrfHash,
                                id: id
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            Swal.fire('Success', mark == true ? 'Removed bookmark on this record': 'Added bookmark on this record', 'success')
                            .then(() => {
                            location.reload();
                        });
                        })
                        .catch(err => {
                            Swal.fire('Error', 'Something went wrong!', 'error');
                        });
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>