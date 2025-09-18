<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Summary Report
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Reports</li>
<li class="breadcrumb-item active">Summary</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">

        <!-- Filters and Download -->
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <div class="d-flex gap-2 align-items-center mb-2 mb-md-0">
                <label class="mb-0 fw-semibold">Filter by:</label>
                <select class="form-control form-control-sm">
                    <option value="today">Today</option>
                    <option value="yesterday">Yesterday</option>
                    <option value="this_week">This Week</option>
                    <option value="this_month" selected>This Month</option>
                    <option value="all_time">All Time</option>
                </select>
            </div>
            <div>
                <a href="#" class="btn btn-success btn-sm">
                    <i class="fas fa-download me-1"></i> Download Summary
                </a>
            </div>
        </div>

        <!-- Summary Card (Professional Style) -->
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center">
                <h3 class="card-title text-dark"><i class="fas fa-file-alt me-2"></i>Records Summary - This Month</h3>
                <small class="text-muted">As of <?= date('F d, Y') ?></small>
            </div>
            <div class="card-body">

                <!-- Summary Metrics (Plain Cards) -->
                <div class="row text-center mb-4">
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card border shadow-sm p-2">
                            <h3>90</h3>
                            <p class="mb-0">Archived</p>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card border shadow-sm p-2">
                            <h3>35</h3>
                            <p class="mb-0">Returned</p>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card border shadow-sm p-2">
                            <h3>25</h3>
                            <p class="mb-0">Borrowed</p>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card border shadow-sm p-2">
                            <h3>15</h3>
                            <p class="mb-0">Digitized</p>
                        </div>
                    </div>
                    <div class="col-md-2 col-6 mb-3">
                        <div class="card border shadow-sm p-2">
                            <h3>8</h3>
                            <p class="mb-0">Pending</p>
                        </div>
                    </div>
                </div>

                <!-- Detailed Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Status</th>
                                <th>This Month</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Archived</td>
                                <td>90</td>
                            </tr>
                            <tr>
                                <td>Returned</td>
                                <td>35</td>
                            </tr>
                            <tr>
                                <td>Borrowed</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td>Digitized</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>Pending</td>
                                <td>8</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</section>
<?= $this->endSection() ?>
