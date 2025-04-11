<?= $this->extend("layouts/main"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>System Audit Logs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Audit Logs</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Audit Log Content -->
    <section class="content">
        <div class="container-fluid">
        <div class="card shadow-sm" style="border-top: 3px solid #ddd;">
                <div class="card-header ">
                    <h3 class="card-title"><i class="fas fa-clipboard-check"></i> Detailed Audit Trail</h3>
                </div>
                <div class="card-body">
                    <!-- Table format preferred for auditors -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="auditLogsTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Date & Time</th>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th>Module</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Static sample logs -->
                                <tr>
                                    <td>2025-04-11 08:30:22</td>
                                    <td>Kim Borres</td>
                                    <td>CREATE</td>
                                    <td>Records</td>
                                    <td>Added new record: <strong>“Disaster Preparedness Plan”</strong> under Disaster Management.</td>
                                </tr>
                                <tr>
                                    <td>2025-04-11 10:10:47</td>
                                    <td>Maria Lopez</td>
                                    <td>UPDATE</td>
                                    <td>User Profile</td>
                                    <td>Changed email from <code>maria_old@mail.com</code> to <code>maria_new@mail.com</code>.</td>
                                </tr>
                                <tr>
                                    <td>2025-04-11 13:44:10</td>
                                    <td>Mark Reyes</td>
                                    <td>DELETE</td>
                                    <td>Archives</td>
                                    <td>Deleted record: <strong>“Old Barangay Records 1998”</strong>.</td>
                                </tr>
                                <tr>
                                    <td>2025-04-11 15:03:50</td>
                                    <td>Kim Borres</td>
                                    <td>ACCESS</td>
                                    <td>Confidential</td>
                                    <td>Viewed record: <strong>“Executive Budget Plan 2025”</strong>.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>

<?= $this->section("scripts"); ?>
<script>
    $(function () {
        $('#auditLogsTable').DataTable({
            ordering: true,
            responsive: true,
            pageLength: 10,
            autoWidth: false,
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });
    });
</script>
<?= $this->endSection(); ?>
