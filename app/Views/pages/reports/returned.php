<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Returned Records Report
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Reports</li>
<li class="breadcrumb-item active">Returned Records</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-undo-alt mr-2"></i>Returned Records</h3>
            </div>
            <div class="card-body">
                <p>List of all returned records.</p>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Record Title</th>
                            <th>Returned By</th>
                            <th>Date Returned</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Audit Findings Q1</td>
                            <td>Juan Dela Cruz</td>
                            <td>2025-09-09</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
