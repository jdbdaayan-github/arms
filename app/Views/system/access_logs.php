<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Access Logs
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
  <div class="container-fluid">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">User Access Logs</h3>
        <div class="card-tools">
          <a href="#" class="btn btn-sm btn-light">Refresh</a>
        </div>
      </div>
      <div class="card-body p-0 table-responsive">
        <table class="table table-hover table-striped table-bordered mb-0">
          <thead class="thead-light">
            <tr>
              <th>ID</th>
              <th>User</th>
              <th>IP Address</th>
              <th>Device / Browser</th>
              <th>Login Time</th>
              <th>Logout Time</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>John Doe</td>
              <td>192.168.1.100</td>
              <td>Chrome - Windows 10</td>
              <td>2025-08-27 08:55:00</td>
              <td>2025-08-27 12:15:00</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Jane Smith</td>
              <td>192.168.1.101</td>
              <td>Firefox - Windows 11</td>
              <td>2025-08-27 09:10:00</td>
              <td>2025-08-27 11:45:00</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Admin</td>
              <td>192.168.1.50</td>
              <td>Edge - Windows 10</td>
              <td>2025-08-26 16:00:00</td>
              <td>2025-08-26 17:30:00</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="card-footer small text-muted">Static view of user access logs.</div>
    </div>

  </div>
</section>
<?= $this->endSection(); ?>
