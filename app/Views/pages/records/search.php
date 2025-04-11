<?= $this->extend("layouts/main"); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Advanced Search</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Advanced Search</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Form -->
    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm" style="border-top: 3px solid #17a2b8;">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-search"></i> Filter Criteria</h3>
                </div>
                <div class="card-body">
                    <form id="advancedSearchForm">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="title">Record Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title...">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="">-- Select --</option>
                                    <option value="Finance">Finance</option>
                                    <option value="HR">HR</option>
                                    <option value="Legal">Legal</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="confidential">Confidentiality</label>
                                <select class="form-control" id="confidential" name="confidential">
                                    <option value="">-- Select --</option>
                                    <option value="0">Public</option>
                                    <option value="1">Confidential</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="from_date">From Date</label>
                                <input type="date" class="form-control" id="from_date" name="from_date">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="to_date">To Date</label>
                                <input type="date" class="form-control" id="to_date" name="to_date">
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-info"><i class="fas fa-search"></i> Search</button>
                            <button type="reset" class="btn btn-secondary"><i class="fas fa-undo"></i> Reset</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Search Results -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-table"></i> Search Results</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="resultsTable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Date Uploaded</th>
                                <th>Confidential</th>
                                <th>Uploaded By</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
$(function () {
    const table = $('#resultsTable').DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?= base_url('records/search') ?>",
            type: "POST",
            data: function(d) {
                d.title = $('#title').val();
                d.category = $('#category').val();
                d.confidential = $('#confidential').val();
                d.from_date = $('#from_date').val();
                d.to_date = $('#to_date').val();
            }
        },
        columns: [
            { data: 'title' },
            { data: 'category' },
            { data: 'date_uploaded' },
            { data: 'is_confidential', render: function(data) {
                return data == 1 ? '<span class="badge badge-danger">Yes</span>' : '<span class="badge badge-success">No</span>';
            }},
            { data: 'uploaded_by' },
            { data: 'actions', orderable: false, searchable: false, className: 'text-center' }
        ]
    });

    $('#advancedSearchForm').on('submit', function(e) {
        e.preventDefault();
        table.ajax.reload();
    });
});
</script>
<?= $this->endSection(); ?>
