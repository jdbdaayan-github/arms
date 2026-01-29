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
        </table>
      </div>
    </div>
  </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let csrfName = '<?= csrf_token() ?>';
    let csrfHash = '<?= csrf_hash() ?>';
</script>
<script>
  $(document).ready(function() {
    $('#auditLogsTable').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      ajax: {
        url: "<?= base_url('audit/ajaxLogs') ?>",
        type: "POST",
        data: function (d) {
        d[csrfName] = csrfHash;
    },
    dataSrc: function (json) {
        // 🔥 update CSRF token after every request
        csrfHash = json.csrfHash;
        return json.data;
    }
      },
      columns: [{
          data: "id",
          className: "text-center"
        },
        {
          data: "action",
          className: "text-center",
          render: function(data) {
            let color = 'secondary';
            switch (data.toUpperCase()) {
              case 'CREATE':
                color = 'success';
                break;
              case 'UPDATE':
                color = 'primary';
                break;
              case 'DELETE':
                color = 'danger';
                break;
              case 'LOGIN':
                color = 'info';
                break;
              case 'LOGOUT':
                color = 'warning';
                break;
            }
            return `<span class="badge badge-${color}">${data}</span>`;
          }
        },
        {
          data: "module"
        },
        {
          data: "record_id",
          className: "text-center"
        },
        {
          data: "username",
          className: "text-center"
        },
        {
          data: "timestamp",
          className: "text-center"
        },
        {
          data: "id",
          orderable: false,
          searchable: false,
          className: "text-center",
          render: function(data) {
            return `<a href="<?= site_url('logs/audit/view/') ?>${data}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>`;
          }
        }
      ],
      order: [
        [0, "desc"]
      ],
      language: {
        processing: `
            <div class="overlay">
                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
            </div>
        `
      }
    });
  });
</script>
<?= $this->endSection() ?>