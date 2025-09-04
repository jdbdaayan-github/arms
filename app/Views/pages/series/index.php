<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Record Series
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
    <li class="breadcrumb-item active">Record Series</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
<div class="container-fluid">

    <div class="card card-outline card-secondary mb-0">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-th-list mr-2"></i>Record Series List</h3>
            <div class="card-tools">
                <a href="<?= base_url('classifications/create') ?>" class="btn btn-info btn-flat btn-sm">
                    <i class="fas fa-plus"></i> Add Record Series
                </a>
            </div>
        </div>
        <div class="card-body table-responsive p-2">
            <table id="seriesTable" class="table table-bordered table-hover table-sm text-sm" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="width:30px;">
                            <input type="checkbox" id="select-all">
                        </th>
                        <th>Record Series Code</th>
                        <th>Record Series Name</th>
                        <th>Classification</th>
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
    let permissionTable = $("#seriesTable").DataTable({
        ajax: {
            url: "<?= base_url('series/ajaxRecordSeriesData') ?>",
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
            { data: "code" },
            { data: "name" },
            { data: "classification" },
            {
                data: "id",
                orderable: false,
                className: "text-center",
                render: function(data, type, row) {
                    return `
                        <a href="<?= base_url('classifications/edit/') ?>${data}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?= base_url('classifications/index/') ?>${data}" class="btn btn-info btn-sm">
                            <i class="fas fa-list"></i>
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
