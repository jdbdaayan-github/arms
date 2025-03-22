<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<!-- Content Header (Breadcrumbs) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="h4">Advanced Search</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right small">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Advanced Search</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Search Filters -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title small">Search Filters</h3>
            </div>
            <div class="card-body">
                <form id="searchForm">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="search_doc_name" class="small">Document Name</label>
                                <input type="text" class="form-control form-control-sm" id="search_doc_name" placeholder="Enter document name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="search_doc_type" class="small">Document Type</label>
                                <select class="form-control form-control-sm" id="search_doc_type">
                                    <option value="">All Types</option>
                                    <option value="AO">Administrative Order</option>
                                    <option value="C">Certificate</option>
                                    <option value="MA">Memorandum Advisories</option>
                                    <option value="MC">Memorandum Circular</option>
                                    <option value="SO">Special Order</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="search_doc_date" class="small">Document Date (From - To)</label>
                                <div class="input-group">
                                    <input type="date" class="form-control form-control-sm" id="search_date_from">
                                    <input type="date" class="form-control form-control-sm" id="search_date_to">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="search_keyword" class="small">Keyword</label>
                                <input type="text" class="form-control form-control-sm" id="search_keyword" placeholder="Enter keyword">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" id="searchBtn">
                        <i class="fas fa-search"></i> Search
                    </button>
                </form>
            </div>
        </div>

        <!-- Search Results -->
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title small">Search Results</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm" id="searchResultsTable">
                    <thead>
                        <tr>
                            <th>Document Name</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="searchResultsBody">
                        <tr>
                            <td colspan="4" class="text-center">No results found</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('searchBtn').addEventListener('click', function() {
    const docName = document.getElementById('search_doc_name').value.trim();
    const docType = document.getElementById('search_doc_type').value;
    const dateFrom = document.getElementById('search_date_from').value;
    const dateTo = document.getElementById('search_date_to').value;
    const keyword = document.getElementById('search_keyword').value.trim();

    // Make an AJAX call to fetch search results
    fetch("<?= base_url('searchRecords'); ?>", {
        method: "POST",
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            doc_name: docName,
            doc_type: docType,
            date_from: dateFrom,
            date_to: dateTo,
            keyword: keyword
        })
    })
    .then(response => response.json())
    .then(data => {
        const tbody = document.getElementById('searchResultsBody');
        tbody.innerHTML = "";
        if (data.length > 0) {
            data.forEach(record => {
                tbody.innerHTML += `
                    <tr>
                        <td>${record.doc_name}</td>
                        <td>${record.doc_type}</td>
                        <td>${record.doc_date}</td>
                        <td>
                            <a href="<?= base_url('viewRecord/'); ?>${record.id}" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                `;
            });
        } else {
            tbody.innerHTML = '<tr><td colspan="4" class="text-center">No results found</td></tr>';
        }
    })
    .catch(error => console.error("Error fetching search results:", error));
});
</script>

<?= $this->endSection() ?>