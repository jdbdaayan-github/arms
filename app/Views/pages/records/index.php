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
                <?php if (hasRole('Superadmin') || hasPermission('records.create') || hasRole('Contributor')): ?>
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
                                <th style="width:30px;">#</th>
                                <th>Title</th>
                                <th style="width:20%;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($records)): ?>
                                <?php foreach ($records as $record): ?>
                                    <tr>
                                        <td class="text-center"><input type="checkbox"></td>
                                        <td class="align-items-center"><?= esc($record->title) ?></td>
                                        <td class="text-center">

                                            <?php
                                            $view_enabled = hasRole('Superadmin')
                                                || (hasPermission('records.view') && $record->status_id == 4)
                                                || hasRecordPermission($record->id, 'view');
                                            ?>
                                            <a href="<?= $record->status_id != 1 && !hasRole('Superadmin') ? '#' : base_url('records/show/' . $record->id) ?>"
                                                class="btn btn-info btn-sm <?= $record->status_id != 1 && !hasRole('Superadmin') ? 'disabled' : '' ?>"
                                                <?= $view_enabled ? 'aria-disabled="true" tabindex="-1"' : '' ?>>
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <?php $enabled = hasRole('Superadmin') || (hasPermission('records.edit') && $record->status_id == 1) || hasRecordPermission($record->id, 'edit'); ?>
                                            <a href="<?= $enabled ? base_url('records/edit/' . $record->id) : '#' ?>"
                                                class="btn btn-warning btn-sm <?= $enabled ? '' : 'disabled' ?>"
                                                <?= $enabled ? '' : 'aria-disabled="true" tabindex="-1"' ?>>
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <?php if (hasRole('Superadmin') || hasPermission('records.workflow')): ?>
                                                <a href="<?= base_url('records/workflow/' . $record->id) ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-map-marked-alt"></i>
                                                </a>
                                            <?php endif ?>

                                            <?php if (hasRole('Superadmin')): ?>
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Soft Delete">
                                                    <i class="fas fa-archive"></i>
                                                </button>
                                            <?php endif ?>
                                            <?php if (hasRole('Superadmin')): ?>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            <?php endif ?>
                                            <?php if (hasRole('Superadmin')): ?>
                                                <button type="button" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Force Delete">
                                                    <i class="fas fa-skull-crossbones"></i>
                                                </button>
                                            <?php endif ?>
                                            <?php if (hasRole('Superadmin') || hasRole('Contributor')): ?>
                                                <a href="<?= base_url('records/request/' . $record->id) ?>"
                                                    class="btn btn-secondary btn-sm">
                                                    <i class="fas fa-book-reader"></i>
                                                </a>
                                            <?php endif ?>
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

<?php if (session()->get('req_success')):?>
    <script>
        Swal.fire({
            title: 'Success!',
            text : '<?= session()->get('req_success') ?>',
            icon: 'success',
            showCloseButton: true
        })
    </script>
<?php endif ?>

<?= $this->endSection() ?>