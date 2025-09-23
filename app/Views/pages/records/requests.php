<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Records
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Record Transactions</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-secondary">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title"><i class="fas fa-exchange-alt mr-2"></i>Record Transactions</h3>
            </div>

            <div class="card-body">
                <!-- Search + Per Page -->
                <form method="get" class="mb-2 d-flex justify-content-between">
                    <select name="per_page" class="form-control form-control-sm mr-2" style="width:55px;">
                        <?php foreach ([5, 10, 25, 50] as $num): ?>
                            <option value="<?= $num ?>"><?= $num ?></option>
                        <?php endforeach; ?>
                    </select>

                    <div class="input-group input-group-sm" style="max-width: 300px;">
                        <input type="text" class="form-control" placeholder="Search Title...">
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
                                <th class="text-center">#</th>
                                <th>Record Title</th>
                                <th>Requested By</th>
                                <th>Request Date</th>
                                <th>Borrowed Date</th>
                                <th>Returned Date</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Infrastructure Plan 2025</td>
                                <td>Carlos Dizon</td>
                                <td>Sep 09, 2025</td>
                                <td>Sep 11, 2025</td>
                                <td>-</td>
                                <td><span class="badge badge-danger">Borrowed</span></td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-sm return-btn">
                                        <i class="fas fa-undo"></i> Return
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>Audit Findings Q1</td>
                                <td>Juan Dela Cruz</td>
                                <td>Sep 07, 2025</td>
                                <td>Sep 09, 2025</td>
                                <td>Sep 12, 2025</td>
                                <td><span class="badge badge-success">Returned</span></td>
                                <td class="text-center">
                                    <span class="text-muted">-</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>HR Attendance 2023</td>
                                <td>Ana Cruz</td>
                                <td>Sep 08, 2025</td>
                                <td>Sep 10, 2025</td>
                                <td>-</td>
                                <td><span class="badge badge-danger">Borrowed</span></td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-sm return-btn">
                                        <i class="fas fa-undo"></i> Return
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>Legal Case File 112</td>
                                <td>Maria Santos</td>
                                <td>Sep 06, 2025</td>
                                <td>Sep 08, 2025</td>
                                <td>Sep 11, 2025</td>
                                <td><span class="badge badge-success">Returned</span></td>
                                <td class="text-center">
                                    <span class="text-muted">-</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">5</td>
                                <td>Budget Proposal 2025</td>
                                <td>Pedro Santos</td>
                                <td>Sep 12, 2025</td>
                                <td>-</td>
                                <td>-</td>
                                <td><span class="badge badge-warning">Requested</span></td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-sm approve-request-btn">
                                        <i class="fas fa-check"></i> Approve Request
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <!-- Pagination Info -->
                <div class="d-flex justify-content-between align-items-center text-sm mt-2">
                    <div>Showing 1 to 5 of 5 results</div>
                    <div>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#">»</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>