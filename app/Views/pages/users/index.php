<?= $this->extend('layouts/app'); ?>

<?= $this->section('title') ?>
| Users
<?= $this->endSection() ?>

<?= $this->section('content-header') ?>
Users
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Users</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-shield mr-2"></i>User List</h3>
                <div class="card-tools">
                    <a href="<?= base_url('users/create') ?>" class="btn btn-primary btn-flat btn-sm">
                        <i class="fas fa-plus"></i> Add User
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="usersTable" class="table table-bordered table-hover table-sm text-sm" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width:30px;">
                                <input type="checkbox" id="select-all">
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th style="width: 50px;">Verified</th>
                            <th style="width: 50px;">Attempts</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be loaded by AJAX -->
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
        let userstable = $('#usersTable').DataTable({
            ajax: {
                url: "<?= site_url('users/ajaxUsersData') ?>",
                dataSrc: ""
            },
            columns: [{
                    data: "id",
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                    render: function(data, type, row) {
                        return `<input type="checkbox" class="role-checkbox" value="${data}">`;
                    }
                },
                {
                    data: "Fullname"
                },
                {
                    data: "email"
                },
                {
                    data: "role_name",
                    render: function(data, type, row) {
                        return `<p class="badge badge-secondary mb-0">${data}</p>`;
                    }
                },
                {
                    data: "status",
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                    render: function(data, type, row) {
                        return `<p class="badge badge-primary mb-0">${data}</p>`;
                    }
                },
                {
                    data: "verified",
                    className: "text-center",
                    render: function(data, type, row) {
                        if (data == 1) {
                            return `<p class="badge badge-success mb-0">Yes</p>`;
                        } else {
                            return `<p class="badge badge-danger mb-0">No</p>`;
                        }
                    }
                },
                {
                    data: "login_attempts",
                    className: "text-center",
                    render: function(data, type, row) {
                        if (data == 5) {
                            return `<p class="badge badge-danger mb-0">Locked</p>`;
                        } else {
                            return data;
                        }
                    }
                },
                {
                    data: "id",
                    orderable: false,
                    searchable: false,
                    className: "text-center text-sm",
                    render: function(data, type, row) {
                        return `
                        <a href="<?= base_url('roles/edit/') ?>${data}" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?= base_url('users/permissions/') ?>${data}" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Permissions">
                            <i class="fas fa-shield-alt"></i>
                        </a>
                        <button class="btn btn-success btn-sm verify-user" data-id="${data}" data-verified="${row.verified}" data-bs-toggle="tooltip" data-bs-placement="top" title="Verify/Unverify">
                            <i class="fas fa-check-circle"></i>
                        </button>
                        <button class="btn btn-danger btn-sm attempts-user" data-id="${data}" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh Attempts">
                            <i class="fas fa-sync"></i>
                        </button>
                        <button class="btn btn-dark btn-sm delete-role" data-id="${data}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    `;
                    }
                }
            ],
            columnDefs: [{
                targets: [0, 3],
                orderable: false
            }],
            order: [],
            processing: true,
            responsive: true,
            language: {
                processing: `
                <div class="overlay">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div>
            `
            }
        });

        // ✅ Select/Deselect All
        $('#select-all').on('click', function() {
            let checked = this.checked;
            $('.role-checkbox').each(function() {
                this.checked = checked;
            });
        });

        // ✅ Delete button (demo)
        $(document).on('click', '.delete-role', function() {
            let roleId = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "This role will be deleted!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // 🔥 Ajax delete request here
                    Swal.fire("Deleted!", "Role has been deleted.", "success");
                }
            });
        });

        // ✅ Verify/Unverify button
        $(document).on('click', '.verify-user', function() {
            let userId = $(this).data('id');
            let isVerified = $(this).data('verified'); // current verified state (1 or 0)

            let actionText = (isVerified == 1) ? "unverify" : "verify";
            let confirmText = (isVerified == 1) ? "Yes, unverify!" : "Yes, verify!";

            Swal.fire({
                title: "Are you sure?",
                text: `Do you want to ${actionText} this user?`,
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#6c757d",
                confirmButtonText: confirmText
            }).then((result) => {
                if (result.isConfirmed) {
                    let csrfName = '<?= csrf_token() ?>';
                    let csrfHash = '<?= csrf_hash() ?>';
                    $.ajax({
                        url: "<?= site_url('users/toggleVerify') ?>/" + userId,
                        type: "POST",
                        data: {
                            [csrfName]: csrfHash,
                            id: userId
                        },
                        success: function(response) {
                            let newActionText = (actionText == "verify") ? "verified" : "unverified";
                            Swal.fire("Success!", "User has been " + newActionText + ".", "success");
                            userstable.ajax.reload(null, false);
                        },
                        error: function() {
                            Swal.fire("Error!", "Something went wrong.", "error");
                        }
                    });
                }
            });
        });

        /// Refresh Attempts button
        $(document).on('click', '.attempts-user', function() {
            let userId = $(this).data('id');

            Swal.fire({
                title: "Are you sure?",
                text: "This user's attempts will be reset!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Yes, reset attempts!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let csrfName = '<?= csrf_token() ?>';
                    let csrfHash = '<?= csrf_hash() ?>';
                    $.ajax({
                        url: `<?= base_url('users/resetAttempts') ?>/${userId}`,
                        method: 'POST',
                        data: {
                            [csrfName]: csrfHash,
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire("Success", response.message, "success")
                                userstable.ajax.reload(null, false);
                            } else {
                                Swal.fire("Error", response.message, "error");
                            }
                        },
                        error: function(xhr) {
                            Swal.fire("Error", "Something went wrong", "error");
                        }
                    });
                }
            });
        });

    });
</script>
<?= $this->endSection() ?>