<?= $this->extend("layouts/main"); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Your Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- Search Bar -->
            <div class="row">
                <div class="col-12">
                    <form action="#" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for records..." name="search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Upload Button -->
            <div class="row mt-3">
                <div class="col-12">
                    <a href="<?= site_url('records/upload') ?>" class="btn btn-success">
                        <i class="fas fa-upload"></i> Upload New Record
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Uploaded Records Card -->
                <div class="col-lg-3 col-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3> <!-- Example static number for uploaded records -->
                            <p>Your Uploaded Records</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-upload"></i>
                        </div>
                        <a href="#" class="small-box-footer">View Your Records <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Pending Records Card -->
                <div class="col-lg-3 col-12">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>20</h3> <!-- Example static number for pending records -->
                            <p>Pending Records</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <a href="#" class="small-box-footer">View Pending Records <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Approved Records Card -->
                <div class="col-lg-3 col-12">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>50</h3> <!-- Example static number for approved records -->
                            <p>Approved Records</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <a href="#" class="small-box-footer">View Approved Records <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Archived Records Card -->
                <div class="col-lg-3 col-12">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>30</h3> <!-- Example static number for archived records -->
                            <p>Archived Records</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-archive"></i>
                        </div>
                        <a href="#" class="small-box-footer">View Archived Records <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Recent Activity Card -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-history"></i> Recent Activities</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">Uploaded Document: "Annual Report" <span class="float-right">5 minutes ago</span></li>
                                <li class="list-group-item">Edited Document: "Project Proposal" <span class="float-right">1 hour ago</span></li>
                                <li class="list-group-item">Uploaded Document: "Financial Summary" <span class="float-right">3 hours ago</span></li>
                                <li class="list-group-item">Archived Document: "Old Reports" <span class="float-right">Yesterday</span></li>
                                <li class="list-group-item">Approved Document: "Annual Budget" <span class="float-right">Yesterday</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
<?= $this->endSection(); ?>
