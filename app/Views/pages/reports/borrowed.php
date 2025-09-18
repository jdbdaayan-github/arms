<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Borrowed Records Report
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Reports</li>
<li class="breadcrumb-item active">Borrowed Records</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-book-reader mr-2"></i>Borrowed Records</h3>
            </div>
            <div class="card-body">
                <p>List of all borrowed records.</p>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Record Title</th>
                            <th>Borrowed By</th>
                            <th>Date Borrowed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Infrastructure Plan 2025</td>
                            <td>Carlos Dizon</td>
                            <td>2025-09-11</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
