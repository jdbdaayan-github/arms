<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
PERMISSIONS
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
    <li class="breadcrumb-item active">Permissions</li>
</ol>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <div class="card card-outline card-secondary">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-key mr-2"></i>Permissions List</h3>
            <div class="card-tools">
                <a href="<?= base_url('permissions/create') ?>" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Add Permission
                </a>
            </div>
        </div>
        <div class="card-body table-responsive p-2">
            <table id="permissionsTable" class="table table-bordered table-hover table-sm text-sm">
                <thead>
                    <tr>
                        <th>PERMISSION NAME</th>
                        <th>DESCRIPTION</th>
                        <th style="width:120px;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Manage Users</td>
                        <td>Can create, edit, and delete users</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Manage Roles</td>
                        <td>Can create, edit, and delete roles</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>View Records</td>
                        <td>Can view records but cannot edit or delete them</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Edit Records</td>
                        <td>Can edit records in the system</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Audit Records</td>
                        <td>Access records for auditing purposes, read-only</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    $("#permissionsTable").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false, // static table
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true
    });
});
</script>
<?= $this->endSection() ?>
