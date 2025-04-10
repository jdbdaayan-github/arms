<?= $this->extend("layouts/main"); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role Permissions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('roles') ?>">Roles</a></li>
                        <li class="breadcrumb-item active">Role Permissions</li>
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
                            <h3 class="card-title"><i class="fas fa-user-shield"></i> Permissions for Role: <?= esc($role['role_name']) ?></h3>
                            <button class="btn btn-info btn-md ml-auto" data-toggle="modal" data-target="#addPermissionModal" data-toggle="tooltip" title="Add Permission">
                                <i class="fas fa-plus-circle"></i> Add Permission
                            </button>
                        </div>
                        <div class="card-body">
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show">
                                    <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success'); ?>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                            <?php endif; ?>
                            <table class="table table-bordered table-hover" id="permissionsTable">
                                <thead>
                                    <tr>
                                        <th>Permission Name</th>
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

<!-- Add Permission Modal -->
<div class="modal fade" id="addPermissionModal" tabindex="-1" role="dialog" aria-labelledby="addPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPermissionModalLabel">Add Permission to Role: <?= esc($role['role_name']) ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?= base_url('roles/savePermission/' . $role['id']) ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="permission_id">Select Permission</label>
                        <select class="form-control" id="permission_id" name="permission_id">
                            <?php foreach ($permissions as $permission): ?>
                                <option value="<?= $permission['id'] ?>"><?= esc($permission['permission_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Permission</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Permission Modal -->
<div class="modal fade" id="deletePermissionModal" tabindex="-1" role="dialog" aria-labelledby="deletePermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePermissionModalLabel">Confirm Permission Removal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove this permission from the role?</p>
                <p id="deletePermissionName"></p> <!-- Display permission name for confirmation -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="" id="confirmDeletePermissionBtn" class="btn btn-danger">Remove</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    $(function () {
        // Enable tooltips for buttons and elements
        $('[data-toggle="tooltip"]').tooltip();

        // Initialize the DataTable for role's permissions
        var permissionsTable = $('#permissionsTable').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            ordering: false,
            pageLength: 10,
            ajax: {
                url: '<?= base_url('roles/getRolePermissions/' . $role['id']) ?>',
                type: 'GET',
                dataSrc: 'data'
            },
            columns: [
                { data: 'permission_name' },
                { data: 'description' },
                { data: 'actions', orderable: false, searchable: false }
            ],
            columnDefs: [
                { targets: [2], className: 'text-center' }
            ],
            buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        });

        permissionsTable.buttons().container().appendTo('#permissionsTable_wrapper .col-md-6:eq(0)');

        // Handle delete permission button click
        $(document).on('click', '.delete-permission-btn', function () {
            const permissionId = $(this).data('id');
            const permissionName = $(this).data('name');
            const roleId = '<?= $role['id'] ?>';

            // Set the name of the permission to be deleted in the modal
            $('#deletePermissionName').text(permissionName);

            // Set the URL for the confirmation button
            $('#confirmDeletePermissionBtn').attr('href', '<?= base_url('roles/removePermission/') ?>' + roleId + '/' + permissionId);

            // Show the modal
            $('#deletePermissionModal').modal('show');
        });
    });
</script>
<?= $this->endSection(); ?>
