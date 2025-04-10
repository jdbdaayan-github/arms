<?= $this->extend("layouts/main"); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm" style="border-top: 3px solid #ddd;">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title"><i class="fas fa-user-shield"></i> List of Roles</h3>
                            <a href="<?= base_url('roles/create') ?>" class="btn btn-primary btn-md ml-auto" data-toggle="tooltip" title="Add new role">
                                <i class="fas fa-plus-circle"></i> Add Role
                            </a>
                        </div>
                        <div class="card-body">
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show">
                                    <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success'); ?>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                            <?php endif; ?>

                            <table class="table table-bordered table-hover" id="rolesTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
$(function () {
    // Enable tooltips for buttons and elements
    $('[data-toggle="tooltip"]').tooltip();

    // Initialize the DataTable
    $('#rolesTable').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        ordering: false,
        pageLength: 10,
        ajax: {
            url: '<?= base_url('roles/getRolesData') ?>',
            type: 'GET',
            dataSrc: 'data'
        },
        columns: [
            { data: 'role_name' },
            { data: 'description' },
            { data: 'actions', orderable: false, searchable: false }
        ],
        columnDefs: [
            { targets: [2], className: 'text-center' }
        ],
        buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
    }).buttons().container().appendTo('#rolesTable_wrapper .col-md-6:eq(0)');

    // Handle delete
    $(document).on('click', '.delete-btn', function (e) {
        e.preventDefault();
        var roleId = $(this).data('id');
        var roleName = $(this).data('role_name');
        $('#deleteRoleName').text(roleName);
        $('#confirmDeleteRoleBtn').attr('href', '<?= base_url('roles/delete/') ?>' + roleId);
        $('#deleteRoleModal').modal('show');
    });
});
</script>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteRoleModal" tabindex="-1" role="dialog" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRoleModalLabel">Confirm Role Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this role?</p>
                <p id="deleteRoleName" class="font-weight-bold"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="" id="confirmDeleteRoleBtn" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
