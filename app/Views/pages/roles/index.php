<?= $this->extend('layouts/app'); ?>

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
                <a href="<?= base_url('roles/create') ?>" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Add Role
                </a>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table id="rolesTable" class="table table-bordered table-hover table-sm text-sm">
                <thead>
                    <tr>
                        <th>Role Name</th>
                        <th>Description</th>
                        <th style="width:120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Superadmin</td>
                        <td>Full access to the system. Manages users, roles, permissions.</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Admin</td>
                        <td>Manages system settings, users, and general administrative tasks.</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Archivist</td>
                        <td>Preserves and organizes historical records and documents.</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Contributor</td>
                        <td>Uploads and contributes records to the system.</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Viewer</td>
                        <td>Can view records but cannot edit or delete them.</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Auditor</td>
                        <td>Accesses records for auditing purposes, read-only.</td>
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
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    $('#rolesTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true
    });
});
</script>
<?= $this->endSection() ?>
