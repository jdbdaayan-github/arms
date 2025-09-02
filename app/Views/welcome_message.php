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

    <!-- Stat Boxes -->
    <div class="row">
      <!-- Total Records -->
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>120</h3>
            <p>Total Records</p>
          </div>
          <div class="icon">
            <i class="fas fa-folder-open"></i>
          </div>
          <a href="<?= base_url('records') ?>" class="small-box-footer">View Records <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- Active Records -->
      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>45</h3>
            <p>Active Records</p>
          </div>
          <div class="icon">
            <i class="fas fa-check-circle"></i>
          </div>
          <a href="<?= base_url('records') ?>" class="small-box-footer">View Active <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- Pending Review -->
      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>15</h3>
            <p>Records Pending Review</p>
          </div>
          <div class="icon">
            <i class="fas fa-clock"></i>
          </div>
          <a href="<?= base_url('records/advanced-search?status=pending') ?>" class="small-box-footer">Review Records <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- Due for Disposition -->
      <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>10</h3>
            <p>Records Due for Disposition</p>
          </div>
          <div class="icon">
            <i class="fas fa-trash-alt"></i>
          </div>
          <a href="<?= base_url('records/disposition') ?>" class="small-box-footer">Manage Disposition <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <!-- Recent Records Table -->
    <div class="card mt-3">
      <div class="card-header">
        <h3 class="card-title">Recent Records</h3>
        <div class="card-tools">
          <a href="<?= base_url('records') ?>" class="btn btn-sm btn-light">View All Records</a>
        </div>
      </div>
      <div class="card-body p-0 table-responsive">
        <table class="table table-hover table-striped table-bordered mb-0">
          <thead class="thead-light">
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Status</th>
              <th>Retention Date</th>
              <th class="text-center" style="width: 120px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>101</td>
              <td>HR Employee Records</td>
              <td><span class="badge badge-success">Active</span></td>
              <td>2028-12-31</td>
              <td class="text-center">
                <a href="<?= base_url('records/view/101') ?>" class="btn btn-sm btn-info" title="View"><i class="fas fa-eye"></i></a>
                <a href="<?= base_url('records/edit/101') ?>" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
              </td>
            </tr>
            <tr>
              <td>102</td>
              <td>Financial Reports 2024</td>
              <td><span class="badge badge-warning">Pending Review</span></td>
              <td>2030-06-30</td>
              <td class="text-center">
                <a href="<?= base_url('records/view/102') ?>" class="btn btn-sm btn-info" title="View"><i class="fas fa-eye"></i></a>
                <a href="<?= base_url('records/edit/102') ?>" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
              </td>
            </tr>
            <tr>
              <td>103</td>
              <td>Training Manuals</td>
              <td><span class="badge badge-secondary">Archived</span></td>
              <td>2025-09-15</td>
              <td class="text-center">
                <a href="<?= base_url('records/view/103') ?>" class="btn btn-sm btn-info" title="View"><i class="fas fa-eye"></i></a>
                <a href="<?= base_url('records/edit/103') ?>" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="card-footer small text-muted">
        Showing latest records in the system.
      </div>
    </div>

    <!-- Classification Pie Chart -->
    <div class="card mt-3">
      <div class="card-header">
        <h3 class="card-title">Records by Classification</h3>
      </div>
      <div class="card-body">
        <canvas id="classificationChart" style="height:300px;"></canvas>
      </div>
    </div>

  </div>
</section>

<!-- Chart.js Script -->
<script src="<?= base_url('assets/template/plugins/chart.js/Chart.min.js') ?>"></script>
<script>
  var ctx = document.getElementById('classificationChart').getContext('2d');
  var classificationChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Administrative', 'Financial', 'Legal', 'Personnel', 'Social Services'],
      datasets: [{
        data: [25, 30, 15, 20, 10], // Example values, replace with PHP dynamic data
        backgroundColor: ['#007bff', '#28a745', '#ffc107', '#17a2b8', '#dc3545']
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  });
</script>
<?= $this->endSection(); ?>
