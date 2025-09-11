<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Audit Logs
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Audit Logs</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
  <div class="container-fluid">
    <div class="card card-outline card-secondary">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-history mr-2"></i>Audit Logs</h3>
      </div>
      <div class="card-body table-responsive">
        <table id="auditLogsTable" class="table table-bordered table-hover table-sm text-sm" style="width: 100%;">
          <thead>
            <tr>
              <th style="width:30px;">#</th>
              <th>Action</th>
              <th>Table</th>
              <th>Record ID</th>
              <th>User</th>
              <th>Timestamp</th>
              <th style="width: 150px;">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Loaded via AJAX -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {

    let auditTable = $('#auditLogsTable').DataTable({
        ajax: {
            url: "<?= site_url('audit/ajaxLogs') ?>",
            dataSrc: ""
        },
        columns: [
            { data: "id", className: "text-center" },
            { data: "action", className: "text-center" },
            { data: "module" },
            { data: "record_id", className: "text-center" },
            { 
                data: "username",
                className: "text-center",
                render: function(data) { return data ? data : ''; }
            },
            { data: "timestamp", className: "text-center" },
            {
                data: "id",
                orderable: false,
                searchable: false,
                className: "text-center",
                render: function(data) {
                    return `
                        <a href="<?= site_url('audit/view/') ?>${data}" 
                           class="btn btn-sm btn-info" title="View Details">
                           <i class="fas fa-eye"></i>
                        </a>
                    `;
                }
            }
        ],
        order: [[0, "desc"]],
        processing: true,
        responsive: true
    });

});
</script>
<?= $this->endSection() ?>
