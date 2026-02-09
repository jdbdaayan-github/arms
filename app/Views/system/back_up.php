<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
System Backup
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
<li class="breadcrumb-item active">Backup</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-database mr-2"></i> System Backup
            </h3>
        </div>

        <div class="card-body">

            <!-- Info Paragraph -->
            <p class="text-muted">
                This module allows administrators to manually create a backup of the system database
                or uploaded files to ensure data safety and recovery in case of system failure.
            </p>

            <!-- Warning Alert -->
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle mr-1"></i>
                Only authorized users are allowed to perform backup operations.
            </div>

            <!-- Backup Form -->
            <form action="<?= base_url('backup/download') ?>" method="get">
                <div class="form-row">

                    <!-- Backup Type -->
                    <div class="form-group col-md-6">
                        <label for="backup_type">Backup Type</label>
                        <select name="type" id="backup_type" class="form-control">
                            <option value="database">Database Only</option>
                            <option value="files">Files Only</option>
                            <option value="full">Full System Backup</option>
                        </select>
                    </div>

                    <!-- Database Format -->
                    <div class="form-group col-md-6">
                        <label for="backup_format">Database Format</label>
                        <select name="format" id="backup_format" class="form-control">
                            <option value="sql">SQL</option>
                            <option value="csv">CSV</option>
                        </select>
                        <small class="text-muted">Applies only if Database or Full backup is selected.</small>
                    </div>

                </div>

                <!-- Backup Description -->
                <div class="form-group">
                    <label for="description">Backup Description (Optional)</label>
                    <textarea name="description" id="description" class="form-control" rows="2"
                        placeholder="Enter notes or description..."></textarea>
                </div>

                <!-- Download Button -->
                <div class="text-right">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-download mr-1"></i> Download Backup
                    </button>
                </div>
            </form>

        </div>

        <div class="card-footer text-muted">
            Last backup: <strong>Not Available</strong>
        </div>
    </div>
</div>

<!-- JS to disable Database Format when Files Only is selected -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('backup_type');
    const formatSelect = document.getElementById('backup_format');

    function toggleFormat() {
        formatSelect.disabled = typeSelect.value === 'files';
    }

    typeSelect.addEventListener('change', toggleFormat);
    toggleFormat(); // Initial state
});
</script>

<?= $this->endSection() ?>
