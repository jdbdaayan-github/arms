<?= $this->extend("layouts/main"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Record History</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Track History</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info shadow-sm">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-history"></i> Activity Log</h3>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <!-- Start timeline -->
                        <div class="time-label">
                            <span class="bg-info">April 11, 2025</span>
                        </div>

                        <div>
                            <i class="fas fa-upload bg-success"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 10:45 AM</span>
                                <h3 class="timeline-header"><strong>Kim Borres</strong> uploaded record "Annual Budget 2025"</h3>
                                <div class="timeline-body">
                                    File uploaded with confidential flag enabled. Category: Finance.
                                </div>
                            </div>
                        </div>

                        <div>
                            <i class="fas fa-eye bg-primary"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 11:15 AM</span>
                                <h3 class="timeline-header"><strong>Ana Reyes</strong> viewed record "Annual Budget 2025"</h3>
                            </div>
                        </div>

                        <div>
                            <i class="fas fa-edit bg-warning"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 1:20 PM</span>
                                <h3 class="timeline-header"><strong>Kim Borres</strong> updated record title to "Annual Budget FY 2025"</h3>
                                <div class="timeline-body">
                                    Minor correction in title.
                                </div>
                            </div>
                        </div>

                        <div>
                            <i class="fas fa-trash bg-danger"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="far fa-clock"></i> 3:00 PM</span>
                                <h3 class="timeline-header"><strong>Admin</strong> deleted record "Old Budget Draft"</h3>
                                <div class="timeline-body">
                                    Record marked obsolete and removed from archive.
                                </div>
                            </div>
                        </div>

                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                        <!-- End timeline -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>
