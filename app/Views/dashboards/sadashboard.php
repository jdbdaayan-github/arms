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
        
        <!-- Top Stats -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3><?= $totalUsers ?? 0 ?></h3>
                        <p>Total Users</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="<?= base_url('users') ?>" class="small-box-footer">Manage Users <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $totalRecords ?? 0 ?></h3>
                        <p>Total Records</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <a href="<?= base_url('records') ?>" class="small-box-footer">View Records <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= $totalRoles ?? 0 ?></h3>
                        <p>User Roles</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <a href="<?= base_url('roles') ?>" class="small-box-footer">Manage Roles <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= $totalOffices ?? 0 ?></h3>
                        <p>Offices/Departments</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <a href="<?= base_url('offices') ?>" class="small-box-footer">Manage Offices <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Charts + Recent Activity -->
        <div class="row">
            <!-- Chart Section -->
            <div class="col-md-8">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-chart-bar mr-2"></i>Records Overview</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="recordsChart" style="min-height:250px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="col-md-4">
                <div class="card card-outline card-secondary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-history mr-2"></i>Recent Activity</h3>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <?php if (!empty($recentActivities)): ?>
                                <?php foreach ($recentActivities as $activity): ?>
                                    <li class="list-group-item text-sm">
                                        <i class="fas fa-circle text-secondary' ?> mr-2"></i>
                                        <?= esc($activity->description) ?>
                                        <span class="float-right text-muted text-xs" id="time"><?= esc($activity->time_ago) ?></span>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="list-group-item text-center text-muted">No recent activity</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Management Table -->
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-users-cog mr-2"></i>Latest Users</h3>
                        <div class="card-tools">
                            <a href="<?= base_url('users') ?>" class="btn btn-sm btn-primary">View All</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($latestUsers)): ?>
                                        <?php foreach ($latestUsers as $user): ?>
                                            <tr>
                                                <td><?= esc($user->name) ?></td>
                                                <td><?= esc($user->email) ?></td>
                                                <td><?= esc($user->role_name) ?></td>
                                                <td><?= date('M d, Y', strtotime($user->created_at)) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">No users found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('recordsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($chartLabels ?? ['Jan','Feb','Mar','Apr']) ?>,
            datasets: [{
                label: 'Records',
                data: <?= json_encode($chartData ?? [5,10,7,12]) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });
</script>
<?= $this->endSection() ?>
