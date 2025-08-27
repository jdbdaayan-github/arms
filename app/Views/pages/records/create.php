<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Add Record</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('records') ?>">Records</a></li>
                        <li class="breadcrumb-item active">Add Record</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Record Form -->
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-plus mr-2"></i> NEW RECORD</h3>
        </div>
        <form action="<?= base_url('records/store') ?>" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">

                    <!-- Left Side Form -->
                    <div class="col-md-6">

                        <!-- File Upload -->
                        <div class="form-group">
                            <label for="document_file" class="text-sm text-dark" style="font-weight: 500;">UPLOAD PDF <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="document_file" name="document_file" accept="application/pdf" required>
                                <label class="custom-file-label" for="document_file">Choose PDF file</label>
                            </div>
                            <small class="text-muted">Only PDF files are allowed. Large files may take time to preview.</small>
                        </div>

                        <!-- Confidentiality -->
                        <div class="form-group">
                            <label for="confidentiality" class="text-sm" style="font-weight: 500;">CONFIDENTIALITY <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm select2bs4 " id="confidentiality" name="confidentiality" required>
                                <option value="">-- Select --</option>
                                <option class="TEXT-SM" value="Public">PUBLIC</option>
                                <option value="Restricted">Restricted</option>
                                <option value="Confidential">Confidential</option>
                            </select>
                        </div>

                        <!-- Title -->
                        <div class="form-group">
                            <label for="title" class="text-sm" style="font-weight: 500;">TITLE <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="title" name="title" placeholder="Enter document title" required>
                        </div>

                        <!-- Document Type / Category -->
                        <div class="form-group">
                            <label for="category" class="text-sm" style="font-weight: 500;">DOCUMENT TYPE <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm select2bs4" id="category" name="category" required>
                                <option value="">-- Select --</option>
                                <option value="Project">Project</option>
                                <option value="Report">Report</option>
                                <option value="Employee">Employee</option>
                                <option value="Memo">Memo</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <!-- Document Date -->
                        <div class="form-group">
                            <label for="document_date" class="text-sm" style="font-weight: 500;">DOCUMENT DATE <span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-sm" id="document_date" name="document_date" required>
                        </div>

                    </div>

                    <!-- Right Side PDF Preview -->
                    <div class="col-md-6">
                        <div class="card card-outline card-secondary">
                            <div class="card-header py-2">
                                <h3 class="card-title text-sm"><i class="fas fa-file-pdf mr-2"></i> PDF Preview</h3>
                            </div>
                            <div class="card-body p-1 d-flex justify-content-center align-items-center" style="height: 500px; background-color: #f8f9fa; position: relative;">
                                <span id="pdfPlaceholder" class="text-muted text-center">No file selected</span>
                                <embed id="pdfPreview" src="" type="application/pdf" width="100%" height="100%" style="display: none;"></embed>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Card Footer -->
            <div class="card-footer">
                <a href="<?= base_url('records') ?>" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
                <button type="submit" class="btn btn-primary btn-sm float-right">
                    <i class="fas fa-save"></i> Save Record
                </button>
            </div>
        </form>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(function() {
        // Initialize Select2
        $('.select2bs4').select2({
            theme: 'bootstrap4',
            width: '100%'
        });

        // Auto-preview PDF on file selection
        $('#document_file').on('change', function() {
            let file = this.files[0];
            let preview = $('#pdfPreview');
            let placeholder = $('#pdfPlaceholder');

            if (file) {
                $(this).next('.custom-file-label').html(file.name);

                if (file.type === "application/pdf") {
                    let fileURL = URL.createObjectURL(file);
                    preview.attr('src', fileURL).show();
                    placeholder.hide();
                } else {
                    Swal.fire("Invalid File", "Only PDF files are allowed.", "error");
                    $(this).val("");
                    $(this).next('.custom-file-label').html("Choose PDF file");
                    preview.hide().attr('src', '');
                    placeholder.show();
                }
            } else {
                preview.hide().attr('src', '');
                placeholder.show();
            }
        });
    });
</script>
<?= $this->endSection() ?>