<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Dashboard</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>120</h3>
                    <p>Total Records</p>
                </div>
                <div class="icon"><i class="fas fa-archive"></i></div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>80</h3>
                    <p>Public Records</p>
                </div>
                <div class="icon"><i class="fas fa-globe"></i></div>
                <a href="#" class="small-box-footer">
                    View <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>25</h3>
                    <p>Restricted</p>
                </div>
                <div class="icon"><i class="fas fa-lock"></i></div>
                <a href="#" class="small-box-footer">
                    View <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>15</h3>
                    <p>Confidential</p>
                </div>
                <div class="icon"><i class="fas fa-user-secret"></i></div>
                <a href="#" class="small-box-footer">
                    View <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Charts and Recent Records -->
    <div class="row">
        <!-- Chart -->
        <div class="col-md-7">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-chart-pie mr-2"></i> Records by Category</h3>
                </div>
                <div class="card-body">
                    <canvas id="recordsChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Records -->
        <div class="col-md-5">
            <div class="card card-outline card-secondary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-clock mr-2"></i> Recent Records</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-file-alt text-primary mr-2"></i> Project Plan</span>
                            <small class="text-muted">Aug 20, 2025</small>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-file-alt text-primary mr-2"></i> Financial Report</span>
                            <small class="text-muted">Aug 19, 2025</small>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-file-alt text-primary mr-2"></i> Employee Memo</span>
                            <small class="text-muted">Aug 18, 2025</small>
                        </li>
                        <li class="list-group-item text-muted text-center">3 more records...</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('recordsChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Project", "Report", "Employee", "Memo", "Other"],
            datasets: [{
                data: [40, 30, 20, 15, 15],
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6c757d'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
<?= $this->endSection() ?>
