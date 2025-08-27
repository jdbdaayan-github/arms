<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Records</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Records</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Advanced Search Card -->
    <div class="card card-outline card-primary mb-3">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-search"></i> Advanced Search</h3>
        </div>
        <div class="card-body">
            <form id="searchForm" class="row g-2">
                <div class="col-md-2">
                    <input type="text" class="form-control form-control-sm" id="searchID" placeholder="ID">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-sm" id="searchTitle" placeholder="Title">
                </div>
                <div class="col-md-3">
                    <select class="form-control form-control-sm select2" id="searchOffice">
                        <option value="">Select Office</option>
                        <option>Main Office</option>
                        <option>Finance Dept</option>
                        <option>HR Office</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control form-control-sm" id="searchDate" placeholder="Select Date Range">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary btn-sm w-100" id="btnSearch">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Records Table -->
    <div class="card card-outline card-secondary">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-table"></i> Records List</h3>
            <div class="card-tools">
                <a href="<?= base_url('records/create') ?>" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Add New Record
                </a>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-striped table-bordered table-sm text-sm mb-0" id="recordsTable">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Office</th>
                        <th>Date Created</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Records will appear here -->
                </tbody>
            </table>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function () {
    // Initialize Select2
    $('.select2').select2({width:'100%'});

    // Initialize Date Range Picker
    $('#searchDate').daterangepicker({
        autoUpdateInput: false,
        locale: { cancelLabel: 'Clear', format: 'YYYY-MM-DD' }
    });

    $('#searchDate').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
    });
    $('#searchDate').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    // Sample records data
    const records = [
        {id:1, title:'Project Archive', office:'Main Office', date_created:'2025-08-25'},
        {id:2, title:'Financial Report', office:'Finance Dept', date_created:'2025-08-24'},
        {id:3, title:'Employee Records', office:'HR Office', date_created:'2025-08-23'},
    ];

    function renderTable(filteredRecords) {
        const tbody = $('#recordsTable tbody');
        tbody.empty();
        if(filteredRecords.length === 0){
            tbody.append('<tr><td colspan="5" class="text-center text-muted">No records found</td></tr>');
            return;
        }
        filteredRecords.forEach(r => {
            tbody.append(`
                <tr>
                    <td>${r.id}</td>
                    <td>${r.title}</td>
                    <td>${r.office}</td>
                    <td>${r.date_created}</td>
                    <td>
                        <button class="btn btn-info btn-sm"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `);
        });
    }

    // Initial render
    renderTable(records);

    // Search functionality
    $('#btnSearch').click(function () {
        const id = $('#searchID').val().toLowerCase();
        const title = $('#searchTitle').val().toLowerCase();
        const office = $('#searchOffice').val();
        const dateRange = $('#searchDate').val();
        let startDate='', endDate='';
        if(dateRange){
            [startDate,endDate] = dateRange.split(' - ');
        }

        const filtered = records.filter(r => {
            let dateCheck = true;
            if(startDate && endDate){
                dateCheck = r.date_created >= startDate && r.date_created <= endDate;
            }
            return (id === '' || r.id.toString().includes(id)) &&
                   (title === '' || r.title.toLowerCase().includes(title)) &&
                   (office === '' || r.office === office) &&
                   dateCheck;
        });

        renderTable(filtered);
    });

    // SweetAlert for delete
    $(document).on('click', '.btn-delete', function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "This record will be deleted permanently!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        });
    });

});
</script>
<?= $this->endSection() ?>
