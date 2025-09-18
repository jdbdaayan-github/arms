<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Dashboard (Archivist)
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Archivist Dashboard</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">

        <!-- Stats -->
        <div class="row">
            <div class="col-lg-2 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>340</h3>
                        <p>Archived Records</p>
                    </div>
                    <div class="icon"><i class="fas fa-archive"></i></div>
                    <a href="#" class="small-box-footer">View All <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>12</h3>
                        <p>Restored</p>
                    </div>
                    <div class="icon"><i class="fas fa-history"></i></div>
                    <a href="#" class="small-box-footer">View Restored <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>18</h3>
                        <p>Pending Appraisal</p>
                    </div>
                    <div class="icon"><i class="fas fa-hourglass-half"></i></div>
                    <a href="#" class="small-box-footer">View Pending <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>65</h3>
                        <p>Digitized</p>
                    </div>
                    <div class="icon"><i class="fas fa-digital-tachograph"></i></div>
                    <a href="#" class="small-box-footer">View Digitized <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>7</h3>
                        <p>Borrowed</p>
                    </div>
                    <div class="icon"><i class="fas fa-book"></i></div>
                    <a href="#" class="small-box-footer">View Borrowed <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>20</h3>
                        <p>Returned</p>
                    </div>
                    <div class="icon"><i class="fas fa-undo"></i></div>
                    <a href="#" class="small-box-footer">View Returned <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Latest Archived -->
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-archive mr-2"></i>Latest Archived Records</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Record Title</th>
                            <th>Archived By</th>
                            <th>Date Archived</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Project Alpha Files</td>
                            <td>Maria Santos</td>
                            <td>Sep 12, 2025</td>
                        </tr>
                        <tr>
                            <td>Finance 2024 Reports</td>
                            <td>Juan Dela Cruz</td>
                            <td>Sep 10, 2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Latest Restored -->
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-history mr-2"></i>Latest Restored Records</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Record Title</th>
                            <th>Restored By</th>
                            <th>Date Restored</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>HR Attendance 2023</td>
                            <td>Ana Cruz</td>
                            <td>Sep 15, 2025</td>
                        </tr>
                        <tr>
                            <td>Legal Case File 112</td>
                            <td>Maria Santos</td>
                            <td>Sep 13, 2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Latest Borrowed -->
        <div class="card card-outline card-danger">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-book mr-2"></i>Latest Borrowed Records</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Record Title</th>
                            <th>Borrowed By</th>
                            <th>Date Borrowed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Infrastructure Plan 2025</td>
                            <td>Carlos Dizon</td>
                            <td>Sep 11, 2025</td>
                        </tr>
                        <tr>
                            <td>Audit Findings Q1</td>
                            <td>Juan Dela Cruz</td>
                            <td>Sep 09, 2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Timeline / Activities -->
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-stream mr-2"></i>Recent Archivist Activities</h3>
            </div>
            <div class="card-body">
                <div class="timeline timeline-inverse">
                    <div class="time-label">
                        <span class="bg-info">Sep 15, 2025</span>
                    </div>
                    <div>
                        <i class="fas fa-archive bg-info"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header no-border">Maria Santos archived <b>Budget Proposal 2025</b></h3>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-history bg-success"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header no-border">Ana Cruz restored <b>Legal Case File 112</b></h3>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-book bg-danger"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header no-border">Carlos Dizon borrowed <b>Infrastructure Plan 2025</b></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<?= $this->endSection() ?>
