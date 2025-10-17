<?= $this->extend('layouts/app'); ?>

<?= $this->section('title') ?>
| Record Series
<?= $this->endSection() ?>

<?= $this->section('content-header') ?>
Manage Indexes - <?= esc($series->name) ?>
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
    <li class="breadcrumb-item"><a href="<?= base_url('series') ?>">Record Series</a></li>
    <li class="breadcrumb-item active">Indexes</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
<div class="container-fluid">

    <div class="card card-outline card-secondary">
        <div class="card-header">
            <h3 class="card-title">Indexes for <b><?= esc($series->name) ?></b></h3>
            <div class="card-tools">
                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#addIndexModal">
                    <i class="fas fa-plus"></i> Add Index
                </button>
            </div>
        </div>

        <div class="card-body table-responsive p-2">
            <table class="table table-bordered table-hover table-sm text-sm" id="seriesinexTable">
                <thead>
                    <tr>
                        <th style="width:50px;">#</th>
                        <th>Name</th>
                        <th style="width:100px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

</div>
</section>

<!-- Add Index Modal -->
<div class="modal fade" id="addIndexModal">
    <div class="modal-dialog">
        <form action="<?= base_url('series/addIndex') ?>/<?= $series->id ?>" method="post" class="modal-content">
            <?= csrf_field() ?>
            <input type="hidden" name="series_id" value="<?= $series->id ?>">
            <div class="modal-header">
                <h5 class="modal-title">Add Index</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Type</label>
                    <select class="form-control" name="record_index_id">
                        <?php foreach($availableIndexes as $ind): ?>
                        <option value="<?= $ind->id ?>"><?= $ind->name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info">Save</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).on('click', '.delete-index', function() {
    let index_id = $(this).data('id');

    Swal.fire({
        title: "Delete Index?",
        text: "This cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            let csrfName = '<?= csrf_token() ?>';
            let csrfHash = '<?= csrf_hash() ?>';
            $.ajax({
                url: "<?= base_url('series/deleteIndex') ?>/" + <?= $series->id ?>,
                type: "post",
                data: { 
                    [csrfName]: csrfHash,
                    index_id: index_id,
                },
                success: function(res) {
                    if (res.status === "success") {
                        Swal.fire("Deleted!", "Index has been deleted.", "success")
                            .then(() => location.reload());
                    } else {
                        Swal.fire("Error!", "Something went wrong.", "error");
                    }
                },
                error: function() {
                    Swal.fire("Error!", "Server error.", "error");
                }
            });
        }
    });
});
</script>

<script>
    $(document).ready(function() {
        let seriesinexTable = $('#seriesinexTable').DataTable({
            ajax : {
                url: "<?= base_url('series/indexesData') ?>/<?= $series->id ?>",
                dataSrc: ""
            },
            columns : [
                {
                data: "index_id",
                orderable: false,
                searchable: false,
                className: "text-center",
                render: function(data, type, row) {
                    return `<input type="checkbox" class="permission-checkbox" value="${data}">`;
                }},
                {
                data : "index_name"},
                {
                data: "index_id",
                orderable: false,
                className: "text-center",
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-danger btn-sm delete-index" data-id="${data}">
                            <i class="fas fa-trash"></i>
                        </button>
                    `;
                }
            
            }],
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
        })
    })
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

<?= $this->endSection() ?>
