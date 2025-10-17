<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Dashboard</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">

        <!-- Stats Row -->
        <div class="row">
            <!-- Total Records Submitted -->
            <div class="col-lg-4 col-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>45</h3>
                        <p>Total Records</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-upload"></i>
                    </div>
                    <a href="#" class="small-box-footer">View Records <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Approved Records -->
            <div class="col-lg-4 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>30</h3>
                        <p>Approved Records</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <a href="#" class="small-box-footer">View Approved <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Pending Records -->
            <div class="col-lg-4 col-12">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>10</h3>
                        <p>Pending Records</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <a href="#" class="small-box-footer">View Pending <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Recent Submissions Table -->
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-clock mr-2"></i>Recent Uploads</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-sm btn-success">View All</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Record Title</th>
                                <th>Status</th>
                                <th>Date Submitted</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Budget Report 2025</td>
                                <td><span class="badge badge-success">Approved</span></td>
                                <td>Sep 14, 2025</td>
                            </tr>
                            <tr>
                                <td>Meeting Notes Sept</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                                <td>Sep 15, 2025</td>
                            </tr>
                            <tr>
                                <td>Procurement Plan Q4</td>
                                <td><span class="badge badge-danger">Rejected</span></td>
                                <td>Sep 12, 2025</td>
                            </tr>
                            <tr>
                                <td>Annual Inventory List</td>
                                <td><span class="badge badge-success">Approved</span></td>
                                <td>Sep 10, 2025</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-plus-circle mr-2"></i>Quick Actions</h3>
                    </div>
                    <div class="card-body">
                        <a href="#" class="btn btn-primary btn-block mb-2">
                            <i class="fas fa-file-upload mr-2"></i>Upload New Record
                        </a>
                        <a href="#" class="btn btn-secondary btn-block">
                            <i class="fas fa-search mr-2"></i>Search Records
                        </a>
                    </div>
                </div>
            </div>

            <!-- Notifications -->
            <div class="col-md-6">
                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-bell mr-2"></i>Notifications</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-sm">
                                <i class="fas fa-check text-success mr-2"></i>
                                Your record <b>"Budget Report 2025"</b> has been approved.
                            </li>
                            <li class="list-group-item text-sm">
                                <i class="fas fa-hourglass-half text-warning mr-2"></i>
                                Your record <b>"Meeting Notes Sept"</b> is pending review.
                            </li>
                            <li class="list-group-item text-sm">
                                <i class="fas fa-times text-danger mr-2"></i>
                                Your record <b>"Procurement Plan Q4"</b> was rejected.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<?= $this->endSection() ?>
