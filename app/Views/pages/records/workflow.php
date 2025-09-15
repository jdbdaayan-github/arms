<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Records
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item"><a href="<?= base_url('records') ?>">Records</a></li>
<li class="breadcrumb-item active">Workflow</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">

        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-project-diagram mr-2"></i> Records Workflow</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

                        <!-- Workflow Timeline -->
                        <div class="timeline">

                            <!-- Step 1 -->
                            <div class="time-label">
                                <span class="bg-primary">Start</span>
                            </div>
                            <div>
                                <i class="fas fa-file-alt bg-primary"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">Document Created</h3>
                                    <div class="timeline-body">
                                        The record is created and stored in the system.
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div>
                                <i class="fas fa-user-check bg-info"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">Review & Verification</h3>
                                    <div class="timeline-body">
                                        Assigned personnel reviews the record for completeness and accuracy.
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3 -->
                            <div>
                                <i class="fas fa-check-circle bg-success"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">Approval</h3>
                                    <div class="timeline-body">
                                        Authorized official approves the document.
                                    </div>
                                </div>
                            </div>

                            <!-- Step 4 -->
                            <div>
                                <i class="fas fa-archive bg-warning"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">Archiving</h3>
                                    <div class="timeline-body">
                                        Document is archived and stored permanently for reference.
                                    </div>
                                </div>
                            </div>

                            <!-- Step 5 -->
                            <div>
                                <i class="fas fa-search bg-secondary"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">Tracking & Retrieval</h3>
                                    <div class="timeline-body">
                                        Archived records can be searched and retrieved when needed.
                                    </div>
                                </div>
                            </div>

                            <!-- End -->
                            <div>
                                <i class="fas fa-flag-checkered bg-dark"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header">End of Workflow</h3>
                                </div>
                            </div>

                        </div> <!-- end timeline -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
