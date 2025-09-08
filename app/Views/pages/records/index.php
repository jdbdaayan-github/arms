<?= $this->extend('layouts/app'); ?>

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
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-folder-open mr-2"></i>Records List</h3>
                <div class="card-tools">
                    <a href="<?= base_url('records/create') ?>" class="btn btn-primary btn-flat btn-sm" style="font-size:12px;">
                        <i class="fas fa-plus"></i> Add Record
                    </a>
                </div>
            </div>

            <div class="card-body">
                <!-- Search + Per Page -->
                <form method="get" class="mb-2 d-flex justify-content-between">
                    <select name="per_page" class="form-control form-control-sm mr-2" style="width:55px;" onchange="this.form.submit()">
                        <?php foreach ([5,10,25,50] as $num): ?>
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
                                <th style="width:30px;">#</th>
                                <th>Title</th>
                                <th style="width:120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($records)): ?>
                                <?php foreach ($records as $record): ?>
                                    <tr>
                                        <td class="text-center"><input type="checkbox"></td>
                                        <td><?= esc($record->title) ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('records/show/' . $record->id) ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url('records/edit/' . $record->id) ?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
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
