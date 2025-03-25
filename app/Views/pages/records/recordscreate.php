<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<!-- Content Header (Breadcrumbs) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-1 mt-2">
            <div class="col-sm-6">
                <h2 class="h4">Add Record</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right small">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Add Record</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Left Side: Form -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h3 class="card-title small">Upload Document</h3>
                    </div>
                    <div class="card-body">
                        <form id="recordForm">
                            <!-- Hidden File Input -->
                            <input type="file" id="fileInput" accept="application/pdf" style="display: none;">

                            <div class="form-group">
                                <label class="small">Open File</label>
                                <button type="button" class="btn btn-secondary btn-sm btn-block" id="chooseFileBtn">
                                    <i class="fas fa-upload"></i> Choose File
                                </button>
                            </div>

                            <div class="form-group">
                                <label for="doc_name" class="small">Document Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" id="doc_name" placeholder="Selected file name will appear here" readonly>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <input type="checkbox" id="editNameCheckbox">
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted">Check the box to edit the name</small>
                            </div>

                            <div class="form-group">
                                <label for="doc_type" class="small">Document Type</label>
                                <select class="form-control form-control-sm" id="doc_type">
                                    <option value="">Select Document Type</option>
                                    <option value="AO">Administrative Order</option>
                                    <option value="C">Certificate</option>
                                    <option value="MA">Memorandum Advisories</option>
                                    <option value="MC">Memorandum Circular</option>
                                    <option value="SO">Special Order</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="doc_date" class="small">Document Date</label>
                                <input type="date" class="form-control form-control-sm" id="doc_date">
                            </div>

                            <!-- Dynamic Index Fields -->
                            <div id="indexesSection" style="display: none;">
                                <hr>
                                <h5 class="h6">Indexes</h5>
                                <div class="form-group">
                                    <label for="admin_issuance" class="small">Admin Issuance</label>
                                    <input type="text" class="form-control form-control-sm" id="admin_issuance">
                                </div>
                                <div class="form-group">
                                    <label for="ordinance_no" class="small">Ordinance No</label>
                                    <input type="text" class="form-control form-control-sm" id="ordinance_no">
                                </div>
                                <div class="form-group">
                                    <label for="series_no" class="small">Series No</label>
                                    <input type="text" class="form-control form-control-sm" id="series_no">
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="small">Subject</label>
                                    <input type="text" class="form-control form-control-sm" id="subject">
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary btn-sm" id="previewBtn" style="display: none;">
                                <i class="fas fa-eye"></i> Preview
                            </button>

                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-save"></i> Save Record
                            </button>

                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Side: PDF Preview -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h3 class="card-title small">Preview</h3>
                    </div>
                    <div class="card-body text-center">
                        <iframe id="pdfPreview" src="" width="100%" height="100%" style="border: 1px solid #ddd; min-height: 400px;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('chooseFileBtn').addEventListener('click', function() {
    document.getElementById('fileInput').click();
});

document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = event.target.files[0];

    if (file) {
        // Validate file type (only PDFs allowed)
        if (file.type !== "application/pdf") {
            alert("Only PDF files are allowed!");
            document.getElementById('fileInput').value = "";
            return;
        }

        // Remove .pdf extension from filename
        let fileName = file.name.replace(/\.pdf$/i, "");
        document.getElementById('doc_name').value = fileName;
        document.getElementById('previewBtn').style.display = "inline-block";
    }
});

// Toggle document name editing
document.getElementById('editNameCheckbox').addEventListener('change', function() {
    document.getElementById('doc_name').readOnly = !this.checked;
});

document.getElementById('previewBtn').addEventListener('click', function() {
    const file = document.getElementById('fileInput').files[0];
    if (file) {
        const fileURL = URL.createObjectURL(file);
        document.getElementById('pdfPreview').src = fileURL;
    }
});

document.getElementById('doc_type').addEventListener('change', function() {
    const indexesSection = document.getElementById('indexesSection');
    if (this.value === "AO" || this.value === "MC" || this.value === "SO") {
        indexesSection.style.display = "block";
    } else {
        indexesSection.style.display = "none";
    }
});
</script>

<?= $this->endSection() ?>
