<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Record Details
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item"><a href="<?= base_url('records') ?>">Records</a></li>
<li class="breadcrumb-item active">Details</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Stationary Details Card -->
    <div class="card card-outline card-primary mb-3">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-file-alt mr-2"></i>Record Summary</h3>
            <div class="card-tools">
                <a href="<?= base_url('records') ?>" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-borderless table-sm">
                <tr><th style="width:180px;">Record ID:</th><td>#2025-0001</td></tr>
                <tr><th>Title:</th><td>Annual Financial Report 2025</td></tr>
                <tr><th>Office:</th><td>Finance Department</td></tr>
                <tr><th>Category:</th><td>Reports</td></tr>
                <tr><th>Status:</th><td><span class="badge badge-success">Active</span></td></tr>
                <tr><th>Created By:</th><td>Juan Dela Cruz</td></tr>
                <tr><th>Created On:</th><td>August 28, 2025 09:12 AM</td></tr>
                <tr><th>Last Updated:</th><td>August 28, 2025 10:05 AM</td></tr>
                <tr><th>Description:</th><td>This record contains the annual financial report for the year 2025.</td></tr>
            </table>
        </div>
    </div>

    <!-- AdminLTE Styled Tabs -->
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="recordTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="history-tab" data-toggle="pill" href="#history" role="tab">
                        <i class="fas fa-history mr-1"></i> History
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="versions-tab" data-toggle="pill" href="#versions" role="tab">
                        <i class="fas fa-copy mr-1"></i> Versions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="notes-tab" data-toggle="pill" href="#notes" role="tab">
                        <i class="fas fa-sticky-note mr-1"></i> Notes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="index-tab" data-toggle="pill" href="#index" role="tab">
                        <i class="fas fa-bookmark mr-1"></i> Index
                    </a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content">
                <!-- History Tab -->
                <div class="tab-pane fade show active" id="history" role="tabpanel">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr><th>#</th><th>Action</th><th>User</th><th>Date & Time</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>1</td><td>Created record</td><td>Juan Dela Cruz</td><td>2025-08-28 09:12 AM</td></tr>
                            <tr><td>2</td><td>Edited record</td><td>Maria Santos</td><td>2025-08-28 10:05 AM</td></tr>
                        </tbody>
                    </table>
                </div>

                <!-- Versions Tab -->
                <div class="tab-pane fade" id="versions">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr><th>Version</th><th>Date</th><th>Modified By</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>v1.0</td><td>2025-08-28</td><td>Juan Dela Cruz</td></tr>
                            <tr><td>v1.1</td><td>2025-08-28</td><td>Maria Santos</td></tr>
                        </tbody>
                    </table>
                </div>

                <!-- Notes Tab -->
                <div class="tab-pane fade" id="notes">
                    <ul>
                        <li>Reviewed by Records Officer on 2025-08-28.</li>
                        <li>Pending approval from Director.</li>
                    </ul>
                </div>

                <!-- Index Tab -->
                <div class="tab-pane fade" id="index">
                    <p><strong>Index:</strong> FIN-2025-001, Reports, Annual Financial</p>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(function () {
    // AdminLTE pill tabs
    $('#recordTab a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
});
</script>
<?= $this->endSection() ?>
