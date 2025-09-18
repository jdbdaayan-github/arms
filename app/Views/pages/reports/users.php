<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
User Reports
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Reports</li>
<li class="breadcrumb-item active">User Reports</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-users mr-2"></i>User Borrowing Report</h3>
            </div>
            <div class="card-body">
                <p>Summary of records borrowed by each user.</p>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Total Borrowed</th>
                            <th>Total Returned</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Carlos Dizon</td>
                            <td>5</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>Juan Dela Cruz</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
