<?= $this->extend("layouts/main"); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                            <h3 class="card-title"><i class="fas fa-users"></i> List of Users</h3>
                            <a href="<?= base_url('users/create') ?>" class="btn btn-primary btn-md ml-auto" data-toggle="tooltip" title="Add a new user">
                                <i class="fas fa-user-plus"></i> Add New
                            </a>
                        </div>
                        <div class="card-body">
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show">
                                    <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success'); ?>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                            <?php endif; ?>

                            <table class="table table-bordered table-hover" id="usersTable">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Office</th>
                                        <th>Status</th>
                                        <th>Verified</th>
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
    $('[data-toggle="tooltip"]').tooltip();

    // Initialize DataTable
    $('#usersTable').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        ordering: true,
        pageLength: 10,
        ajax: {
            url: '<?= base_url('users/getUsersData') ?>',
            type: 'GET',
            dataSrc: 'data'
        },
        columns: [
            { data: 'full_name' },
            { data: 'email' },
            { data: 'username' },
            { data: 'role' },
            { data: 'office' },
            { data: 'status' },
            { data: 'verified' },
            { data: 'actions', orderable: false, searchable: false }
        ],
        columnDefs: [
            { targets: [7], className: 'text-center' }
        ],
        buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
    }).buttons().container().appendTo('#usersTable_wrapper .col-md-6:eq(0)');

    // Handle the delete button click
    $(document).on('click', '.delete-btn', function (e) {
        e.preventDefault();
        var userId = $(this).data('user-id');
        var userName = $(this).data('user-name');

        // Set the name of the user to be deleted in the modal
        $('#deleteUserName').text(userName);
        $('#confirmDeleteBtn').attr('href', '<?= base_url('users/delete/') ?>' + userId);

        // Show the modal
        $('#deleteModal').modal('show');
    });

    // Handle Reset Password button click
    $(document).on('click', '.reset-password-btn', function (e) {
        e.preventDefault();
        var userId = $(this).data('user-id');
        var userName = $(this).data('user-name');

        // Set the name of the user to be reset in the modal
        $('#resetUserName').text(userName);
        $('#resetMessage').text('Are you sure you want to reset the password for ' + userName + '?');
        $('#confirmResetBtn').attr('href', '<?= base_url('users/reset-password/') ?>' + userId);

        // Show the modal
        $('#resetPasswordModal').modal('show');
    });

    // Handle Verify User button click
    $(document).on('click', '.verify-btn', function (e) {
        e.preventDefault();
        var userId = $(this).data('user-id');
        var userName = $(this).data('user-name');
        var action = $(this).data('verify-status');
        var actionText = action === 'verify' ? 'Verify' : 'Unverify';
        var message = action === 'verify' ? 'Are you sure you want to verify this user?' : 'Are you sure you want to unverify this user?';

        // Set modal content
        $('#verifyMessage').text(message);
        $('#verifyUserName').text(userName);
        $('#confirmVerifyBtn').attr('href', '<?= base_url('users/verify/') ?>' + userId + '/' + action);

        // Show the modal
        $('#verifyModal').modal('show');
    });
});
</script>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user?</p>
                <p id="deleteUserName"></p> <!-- Display user name for confirmation -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="" id="confirmDeleteBtn" class="btn btn-info">Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPasswordModalLabel">Reset User Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="resetMessage">Are you sure you want to reset the password for this user?</p>
                <p id="resetUserName"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="" id="confirmResetBtn" class="btn btn-danger">Reset Password</a>
            </div>
        </div>
    </div>
</div>

<!-- Verify User Modal -->
<div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="verifyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verifyModalLabel">Confirm User Verification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="verifyMessage">Are you sure you want to verify this user?</p>
                <p id="verifyUserName"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="" id="confirmVerifyBtn" class="btn btn-success">Verify</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
