<?= $this->extend("layouts/main"); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Offices List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Offices</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Offices List Table -->
                <div class="col-12">
                    <div class="card shadow-sm" style="border-top: 3px solid #ddd;">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title"><i class="fas fa-building"></i> List of Offices</h3>
                            <a href="<?= base_url('offices/create') ?>" class="btn btn-primary btn-md ml-auto" data-toggle="tooltip" title="Add a new office">
                                <i class="fas fa-plus-circle"></i> Add New Office
                            </a>
                        </div>
                        <div class="card-body">
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show">
                                    <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success'); ?>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                            <?php endif; ?>

                            <table class="table table-bordered table-hover" id="officesTable">
                                <thead>
                                    <tr>
                                        <th>Office Code</th>
                                        <th>Office Name</th>
                                        <th>Directorate</th> <!-- New Column -->
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

    $('#officesTable').DataTable({
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        ordering: true,
        pageLength: 10,
        ajax: {
            url: '<?= base_url('offices/getOfficesData') ?>', // Ensure this matches the URL for your controller method
            type: 'GET',
            dataSrc: 'data'  // Ensure this matches the structure of the returned JSON data
        },
        columns: [
            { data: 'code' },
            { data: 'name' },
            { data: 'directorate_code' },  // New Column Data
            { data: 'actions', orderable: false, searchable: false }
        ],
        columnDefs: [
            { targets: [3], className: 'text-center' }  // Center the Actions column (index 3)
        ],
        buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
    }).buttons().container().appendTo('#officesTable_wrapper .col-md-6:eq(0)');

    // Handle the delete button click
    $(document).on('click', '.delete-btn', function (e) {
        e.preventDefault();
        var officeId = $(this).data('id');
        var officeName = $(this).data('office_name');

        // Set the name of the office to be deleted in the modal
        $('#deleteOfficeName').text(officeName);

        // Set the URL of the delete button
        $('#confirmDeleteBtn').attr('href', '<?= base_url('offices/delete/') ?>' + officeId);

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
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this office?</p>
                <p id="deleteOfficeName"></p> <!-- Display office name for confirmation -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="" id="confirmDeleteBtn" class="btn btn-info">Delete</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
