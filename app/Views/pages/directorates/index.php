<?= $this->extend("layouts/main"); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Directorates List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Directorates</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm" style="border-top: 3px solid #ddd;">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title"><i class="fas fa-sitemap"></i> List of Directorates</h3>
                            <a href="<?= base_url('directorates/create') ?>" class="btn btn-primary btn-md ml-auto" data-toggle="tooltip" title="Add a new directorate">
                                <i class="fas fa-plus"></i> Add New
                            </a>
                        </div>
                        <div class="card-body">
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show">
                                    <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success'); ?>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                            <?php endif; ?>

                            <table class="table table-bordered table-striped" id="directoratesTable">
                                <thead>
                                    <tr>
                                        <th>Directorate Code</th>
                                        <th>Directorate Name</th>
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

    $('#directoratesTable').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        ordering: true,
        pageLength: 10,
        ajax: {
            url: '<?= base_url('directorates/getDirectoratesData') ?>',
            type: 'GET',
            dataSrc: 'data'
        },
        columns: [
            { data: 'code' },
            { data: 'name' },
            { data: 'actions', orderable: false, searchable: false }
        ],
        columnDefs: [
            { targets: [2], className: 'text-center' }
        ],
        buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
    }).buttons().container().appendTo('#directoratesTable_wrapper .col-md-6:eq(0)');

    // Delete button click handler
    $(document).on('click', '.delete-btn', function (e) {
        e.preventDefault();
        var dirId = $(this).data('directorate-id');
        var dirName = $(this).data('directorate-name');

        $('#deleteDirectorateName').text(dirName);
        $('#confirmDeleteBtn').attr('href', '<?= base_url('directorates/delete/') ?>' + dirId);

        $('#deleteModal').modal('show');
    });
});
</script>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this directorate?</p>
                <p id="deleteDirectorateName"></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="" id="confirmDeleteBtn" class="btn btn-info">Delete</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
