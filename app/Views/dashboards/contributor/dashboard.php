<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Dashboard</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">

        <!-- Stats Row -->
        <div class="row">
            <!-- Total Records Submitted -->
            <div class="col-lg-4 col-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= esc(number_format($totalRecords)) ?></h3>
                        <p>Total Records</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-upload"></i>
                    </div>
                </div>
            </div>

            <!-- Approved Records -->
            <div class="col-lg-4 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= esc(number_format($totalApoproved)) ?></h3>
                        <p>Approved Records</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check"></i>
                    </div>
                </div>
            </div>

            <!-- Pending Records -->
            <div class="col-lg-4 col-12">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= esc(number_format($totalPending)) ?></h3>
                        <p>Pending Records</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Submissions Table -->
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-clock mr-2"></i>Recent Uploads</h3>
                <div class="card-tools">
                    <a href="<?= base_url('records') ?>" class="btn btn-sm btn-success">View All Records</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Record Title</th>
                                <th>Status</th>
                                <th>Date Uploaded</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($records as $record): ?>
                            <tr>
                                <td><?= esc($record->title) ?></td>
                                <td><span class="badge badge-success"><?= esc($record->status) ?></span></td>
                                <td><?= esc(date('F j, Y', strtotime($record->created_at))) ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mt-3">
            <div class="col-md">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-plus-circle mr-2"></i>Quick Actions</h3>
                    </div>
                    <div class="card-body">
                        <a href="<?= base_url('records/create') ?>" class="btn btn-primary btn-block mb-2">
                            <i class="fas fa-file-upload mr-2"></i>Upload New Record
                        </a>
                        <a href="<?= base_url('records/search') ?>" class="btn btn-secondary btn-block">
                            <i class="fas fa-search mr-2"></i>Search Records
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<?= $this->endSection() ?>
