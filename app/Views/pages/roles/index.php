<?= $this->extend('layouts/app'); ?>

<?= $this->section('title') ?>
| Manage Roles
<?= $this->endSection() ?>

<?= $this->section('content-header') ?>
Roles
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Roles</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-shield mr-2"></i>Roles List</h3>
                <div class="card-tools">
                    <a href="<?= base_url('roles/create') ?>" class="btn btn-primary btn-flat btn-sm">
                        <i class="fas fa-plus"></i> Add Role
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="rolesTable" class="table table-bordered table-hover table-sm text-sm" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width:30px;">
                                <input type="checkbox" id="select-all">
                            </th>
                            <th>Role Name</th>
                            <th>Description</th>
                            <th style="width:120px;">Actions</th>
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
        let roletable = $('#rolesTable').DataTable({
            ajax: {
                url: "<?= site_url('roles/ajaxRolesData') ?>",
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
                    data: "role_name"
                },
                {
                    data: "description"
                },
                {
                    data: "id",
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                    render: function(data, type, row) {
                        return `
                            <a href="<?= base_url('roles/edit/') ?>${data}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= base_url('roles/permissions/') ?>${data}" class="btn btn-info btn-sm">
                                <i class="fas fa-shield-alt"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-role" data-id="${data}">
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
            },
        });

        // ✅ Select/Deselect All
        $('#select-all').on('click', function() {
            let checked = this.checked;
            $('.role-checkbox').each(function() {
                this.checked = checked;
            });
        });

        // ✅ Delete button demo
        $(document).on('click', '.delete-role', function() {
            let roleId = $(this).data('id');
            alert("Delete role with ID: " + roleId);
        });
    });
</script>

<?php if(session()->has('success')): ?>
    <script>
        Swal.fire({
            title: "Success!",
            text: "<?= session('success') ?>",
            icon: "success",
            confirmButtonText: "OK"
        });
    </script>
<?php endif; ?>

<?php if(session()->has('error')): ?>
    <script>
        Swal.fire({
            title: "Error!",
            text: "<?= session('error') ?>",
            icon: "error",
            confirmButtonText: "OK"
        });
    </script>
<?php endif; ?>
<?= $this->endSection() ?>