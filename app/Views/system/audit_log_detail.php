<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Audit Log Details
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item"><a href="<?= site_url('audit') ?>">Audit Logs</a></li>
<li class="breadcrumb-item active">Details</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
  <div class="container-fluid">
    <div class="card card-outline card-secondary">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-eye mr-2"></i>Audit Log #<?= esc($log->id) ?></h3>
      </div>

      <div class="card-body">
        <table class="table table-sm table-borderless">
          <tr>
            <th style="width:120px;">Action:</th>
            <td><span class="badge badge-info"><?= esc($log->action) ?></span></td>
          </tr>
          <tr>
            <th>Table:</th>
            <td><?= esc($log->module) ?></td>
          </tr>
          <tr>
            <th>Record ID:</th>
            <td><?= esc($log->record_id) ?></td>
          </tr>
          <tr>
            <th>User:</th>
            <td><?= esc($log->username ?? '-') ?></td>
          </tr>
          <tr>
            <th>IP Address:</th>
            <td><?= esc($log->ip_address ?? '-') ?></td>
          </tr>
          <tr>
            <th>User Agent:</th>
            <td><small><?= esc($log->user_agent ?? '-') ?></small></td>
          </tr>
          <tr>
            <th>Timestamp:</th>
            <td><?= esc($log->timestamp) ?></td>
          </tr>
        </table>

        <div class="row mt-3">
          <div class="col-md-6">
            <h6>Old Data</h6>
            <pre class="p-2 bg-light border rounded small"><?= $log->old_data ? json_encode($log->old_data, JSON_PRETTY_PRINT) : '-' ?></pre>
          </div>
          <div class="col-md-6">
            <h6>New Data</h6>
            <pre class="p-2 bg-light border rounded small"><?= $log->new_data ? json_encode($log->new_data, JSON_PRETTY_PRINT) : '-' ?></pre>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>
