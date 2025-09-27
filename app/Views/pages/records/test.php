<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Records Center
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Records</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">

        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-database"></i> Records Center</h3>
            </div>
            <div class="card-body">

                <div id="accordion">
                    <!-- Records -->
                    <div class="card card-light">
                        <div class="card-header" data-toggle="collapse" data-parent="#accordion" href="#collapseRecords">
                            <h4 class="card-title"><i class="fas fa-folder-open mr-2"></i> Records</h4>
                        </div>
                        <div id="collapseRecords" class="panel-collapse collapse show">
                            <div class="card-body">
                                <a href="<?= base_url('records') ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-list"></i> List</a>
                                <a href="<?= base_url('records/create') ?>" class="btn btn-sm btn-outline-success"><i class="fas fa-plus-circle"></i> Create</a>
                            </div>
                        </div>
                    </div>

                    <!-- Approval -->
                    <div class="card card-light">
                        <div class="card-header" data-toggle="collapse" href="#collapseApproval">
                            <h4 class="card-title"><i class="fas fa-clipboard-check mr-2"></i> Approval</h4>
                        </div>
                        <div id="collapseApproval" class="panel-collapse collapse">
                            <div class="card-body">
                                <a href="<?= base_url('records/approval') ?>" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-tasks"></i> Pending
                                    <span class="badge badge-warning"><?= $pendingApprovalCount ?? 0 ?></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Archival -->
                    <div class="card card-light">
                        <div class="card-header" data-toggle="collapse" href="#collapseArchival">
                            <h4 class="card-title"><i class="fas fa-archive mr-2"></i> Archival</h4>
                        </div>
                        <div id="collapseArchival" class="panel-collapse collapse">
                            <div class="card-body">
                                <a href="<?= base_url('records/archival') ?>" class="btn btn-sm btn-outline-secondary"><i class="fas fa-box-open"></i> For Archival</a>
                                <a href="<?= base_url('records/archival/archived') ?>" class="btn btn-sm btn-outline-dark"><i class="fas fa-archive"></i> Archived</a>
                            </div>
                        </div>
                    </div>

                    <!-- Requests -->
                    <div class="card card-light">
                        <div class="card-header" data-toggle="collapse" href="#collapseRequests">
                            <h4 class="card-title"><i class="fas fa-envelope-open-text mr-2"></i> Requests</h4>
                        </div>
                        <div id="collapseRequests" class="panel-collapse collapse">
                            <div class="card-body">
                                <a href="<?= base_url('records/requests') ?>" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-paper-plane"></i> Requests
                                    <span class="badge badge-info"><?= $pendingRequests ?? 0 ?></span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

    </div>
</section>
<?= $this->endSection() ?>