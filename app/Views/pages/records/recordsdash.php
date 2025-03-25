<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<!-- Content Header (Breadcrumbs) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Document Records</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Documents</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">
        <p>Welcome, <?= esc($username ?? 'Guest') ?>!</p>

        <!-- Row for Statistics -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>200</h3>
                        <p>Total Documents</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>120</h3>
                        <p>Approved Documents</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>50</h3>
                        <p>Pending Review</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>30</h3>
                        <p>Rejected Documents</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Documents Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent Documents</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Date Uploaded</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>1</td><td>Annual Report</td><td>Finance</td><td><span class="badge badge-success">Approved</span></td><td>2025-03-20</td></tr>
                        <tr><td>2</td><td>Project Proposal</td><td>Development</td><td><span class="badge badge-warning">Pending</span></td><td>2025-03-22</td></tr>
                        <tr><td>3</td><td>HR Guidelines</td><td>HR</td><td><span class="badge badge-danger">Rejected</span></td><td>2025-03-21</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
