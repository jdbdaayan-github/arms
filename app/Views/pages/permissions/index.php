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
<section class="content">
<div class="container-fluid">

    <div class="card card-outline card-secondary mb-0">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-key mr-2"></i>Permissions List</h3>
            <div class="card-tools">
                <a href="<?= base_url('permissions/create') ?>" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Add Permission
                </a>
            </div>
        </div>
        <div class="card-body table-responsive p-2">
            <table id="permissionsTable" class="table table-bordered table-hover table-sm text-sm" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="width:30px;">
                            <input type="checkbox" id="select-all">
                        </th>
                        <th>PERMISSION NAME</th>
                        <th>DESCRIPTION</th>
                        <th style="width:120px;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be loaded via AJAX -->
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
    let permissionTable = $("#permissionsTable").DataTable({
        ajax: {
            url: "<?= base_url('permissions/ajaxPermissionsData') ?>",
            dataSrc: ""
        },
        columns: [
            {
                data: "id",
                orderable: false,
                searchable: false,
                className: "text-center",
                render: function(data, type, row) {
                    return `<input type="checkbox" class="permission-checkbox" value="${data}">`;
                }
            },
            { data: "permission_name" },
            { data: "description" },
            {
                data: "id",
                orderable: false,
                className: "text-center",
                render: function(data, type, row) {
                    return `
                        <a href="<?= base_url('permissions/edit/') ?>${data}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-danger btn-sm delete-permission" data-id="${data}">
                            <i class="fas fa-trash"></i>
                        </button>
                    `;
                }
            }
        ],
        order: [], // remove default sorting
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

    $('#select-all').on('click', function() {
        let checked = this.checked;
        $('.permission-checkbox').each(function() {
            this.checked = checked;
        });
    });

    $(document).on('click', '.delete-permission', function() {
        let permissionId = $(this).data('id');
        alert("Delete permission with ID: " + permissionId);
    });
});
</script>
<?= $this->endSection() ?>
