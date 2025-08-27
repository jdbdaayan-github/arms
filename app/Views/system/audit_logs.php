<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Audit Logs
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
  <div class="container-fluid">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">System Audit Logs</h3>
      </div>

      <div class="card-body">
        <!-- Filters Row -->
        <div class="row mb-3">
          <!-- Date Range -->
          <div class="col-md-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
              </div>
              <input type="text" id="dateRange" class="form-control" placeholder="Date Range" />
            </div>
          </div>

          <!-- Action Filter -->
          <div class="col-md-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-tasks"></i></span>
              </div>
              <select id="actionFilter" class="form-control">
                <option value="">All Actions</option>
                <option value="View">View</option>
                <option value="Create">Create</option>
                <option value="Update">Update</option>
                <option value="Delete">Delete</option>
              </select>
            </div>
          </div>

          <!-- Object Type Filter -->
          <div class="col-md-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-database"></i></span>
              </div>
              <select id="objectTypeFilter" class="form-control">
                <option value="">All Object Types</option>
                <option value="User">User</option>
                <option value="Record">Record</option>
                <option value="Settings">Settings</option>
              </select>
            </div>
          </div>

          <!-- Search -->
          <div class="col-md-3">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input type="text" id="searchInput" class="form-control" placeholder="Search..." />
            </div>
          </div>
        </div>

        <!-- DataTable -->
        <table id="auditLogsTable" class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>Time</th>
              <th>Login</th>
              <th>Role</th>
              <th>IP</th>
              <th>Object Type</th>
              <th>Action</th>
              <th>Object Name</th>
              <th>URL</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>02/27/2021 12:12:59 PM</td>
              <td>demo@controlio.net</td>
              <td>Owner</td>
              <td>213.87.130.148</td>
              <td>Dashboard</td>
              <td>View</td>
              <td>-</td>
              <td>/dashboard?demoMode</td>
            </tr>
            <tr>
              <td>02/27/2021 12:11:30 PM</td>
              <td>demo@controlio.net</td>
              <td>Owner</td>
              <td>213.87.130.148</td>
              <td>Dashboard</td>
              <td>View</td>
              <td>-</td>
              <td>/dashboard?demoMode</td>
            </tr>
            <tr>
              <td>02/27/2021 11:36:20 AM</td>
              <td>demo@controlio.net</td>
              <td>Owner</td>
              <td>176.194.140.242</td>
              <td>System</td>
              <td>View</td>
              <td>-</td>
              <td>/system/audit</td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>

  </div>
</section>
<?= $this->endSection(); ?>

<?= $this->section('scripts') ?>
<!-- Daterangepicker dependencies -->
<script src="<?= base_url('plugins/moment/moment.min.js') ?>"></script>
<script src="<?= base_url('plugins/daterangepicker/daterangepicker.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('plugins/daterangepicker/daterangepicker.css') ?>">

<script>
  $(document).ready(function () {
      // Initialize DataTable
      var table = $('#auditLogsTable').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true
      });

      // Action filter
      $('#actionFilter').on('change', function () {
          table.column(5).search(this.value).draw();
      });

      // Object type filter
      $('#objectTypeFilter').on('change', function () {
          table.column(4).search(this.value).draw();
      });

      // Text search
      $('#searchInput').on('keyup', function () {
          table.search(this.value).draw();
      });

      // Date range picker
      $('#dateRange').daterangepicker({
          opens: 'right',
          autoUpdateInput: false,
          locale: {
              cancelLabel: 'Clear',
              format: 'MM/DD/YYYY'
          }
      });

      // Apply filter on date range select
      $('#dateRange').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

          $.fn.dataTable.ext.search.push(
              function(settings, data, dataIndex) {
                  var min = picker.startDate;
                  var max = picker.endDate;
                  var date = moment(data[0], 'MM/DD/YYYY hh:mm:ss A'); // Time column
                  return (min == null && max == null) || (date.isSameOrAfter(min) && date.isSameOrBefore(max));
              }
          );
          table.draw();
      });

      // Clear filter on cancel
      $('#dateRange').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
          $.fn.dataTable.ext.search.pop();
          table.draw();
      });
  });
</script>
<?= $this->endSection(); ?>
