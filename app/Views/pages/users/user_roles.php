<?= $this->extend("layouts/main"); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('users') ?>">Users</a></li>
                        <li class="breadcrumb-item active">User Roles</li>
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
                            <h3 class="card-title"><i class="fas fa-user-tag"></i> User Roles</h3>
                            <button class="btn btn-info btn-md ml-auto" data-toggle="modal" data-target="#addRoleModal">
                                <i class="fas fa-plus"></i> Add Role
                            </button>
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
                                        <th>Role Name</th>
                                        <th>Actions</th>
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

<!-- Add Role Modal -->
<div class="modal fade" id="addRoleModal" tabindex="-1" role="dialog" aria-labelledby="addRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRoleModalLabel">Add Role to User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addRoleForm" method="POST" action="<?= base_url('users/addRole/'.$user['id']) ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="role">Select Role</label>
                        <select name="role" id="role" class="form-control">
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= $role['id']; ?>"><?= esc($role['role_name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">Add Role</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $('#rolesTable').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        ordering: true,
        pageLength: 10,
        ajax: {
            url: '<?= base_url('users/getRolesData/'.$user['id']) ?>', // Ensure this matches the URL for your controller method
            type: 'GET',
            dataSrc: 'data'  // Ensure this matches the structure of the returned JSON data
        },
        columns: [
            { data: 'role' },
            { data: 'actions', orderable: false, searchable: false }
        ],
        columnDefs: [
            { targets: [1], className: 'text-center' }  // Center the Actions column (index 1)
        ],
        buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
    }).buttons().container().appendTo('#rolesTable_wrapper .col-md-6:eq(0)');

    // Handle the delete button click
    $(document).on('click', '.delete-btn', function (e) {
        e.preventDefault();
        var roleId = $(this).data('role-id');
        var roleName = $(this).data('role-name');
        var userId = $(this).data('user-id');

        // Set the name of the role to be deleted in the modal
        $('#deleteRoleName').text(roleName);

        // Set the URL of the delete button
        $('#confirmDeleteRoleBtn').attr('href', '<?= base_url('users/deleteRole/') ?>' + userId +'/'+ roleId);

        // Show the modal
        $('#deleteModal').modal('show');
    });
});
</script>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Role Remove</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove this role from the user?</p>
                <p id="deleteRoleName"></p> <!-- Display role name for confirmation -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="" id="confirmDeleteRoleBtn" class="btn btn-info">Remove</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
