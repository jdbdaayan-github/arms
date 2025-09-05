<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Add Record
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item"><a href="<?= base_url('records') ?>">Records</a></li>
<li class="breadcrumb-item active">Add Record</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">

        <!-- Create Record Form -->
        <div class="card card-outline card-primary mb-0">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus mr-2"></i>NEW RECORD</h3>
            </div>

            <form action="<?= base_url('records/store') ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">

                        <!-- Left Side Form -->
                        <div class="col-md-6">

                            <!-- File Upload -->
                            <div class="form-group">
                                <label for="document_file" class="text-sm font-weight-medium">
                                    UPLOAD PDF <span class="text-danger">*</span>
                                </label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="document_file" name="document_file" accept="application/pdf" required>
                                    <label class="custom-file-label" for="document_file">Choose PDF file</label>
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="form-group">
                                <label for="title" class="text-sm font-weight-medium">
                                    TITLE <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" id="title" name="title" placeholder="Enter document title" required>
                            </div>

                            <!-- Confidentiality -->
                            <div class="form-group">
                                <label for="confidentiality" class="text-sm font-weight-medium">
                                    CONFIDENTIALITY <span class="text-danger">*</span>
                                </label>
                                <select class="form-control form-control-sm select2bs4" id="confidentiality" name="confidentiality" required>
                                    <option value="">-- Select --</option>
                                    <option value="Public">PUBLIC</option>
                                    <option value="Restricted">Restricted</option>
                                    <option value="Confidential">Confidential</option>
                                </select>
                            </div>

                            <!-- Document Type / Category -->
                            <div class="form-group">
                                <label for="series" class="text-sm font-weight-medium">
                                    SERIES TITLE<span class="text-danger">*</span>
                                </label>
                                <select class="form-control form-control-sm select2bs4" id="series" name="series" required>
                                    <option class="text-sm" value="">-- Select --</option>
                                    <?php foreach ($series as $ser): ?>
                                        <option class="text-sm" value="<?= $ser->id ?>"><?= esc($ser->name) ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <!-- Document Date -->
                            <div class="form-group mb-4">
                                <label for="document_date" class="text-sm font-weight-medium">
                                    DOCUMENT DATE <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control form-control-sm" id="document_date" name="document_date" required>
                            </div>

                            <div class="card card-sm">
                                <div class="card-header text-sm p-2">Record Index</div>
                                <div class="card-body p-2">
                                    <div id="dynamic_indexes"></div>
                                </div>
                            </div>

                        </div>

                        <!-- Right Side PDF Preview -->
                        <div class="col-md-6">
                            <div class="card card-outline card-secondary height-full">
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
                    <button type="submit" class="btn btn-primary btn-sm float-right btn-flat">
                        <i class="fas fa-save"></i> Save Record
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function () {
    // Init Select2
    $('#category').select2({
        placeholder: "-- Select Category --",
        allowClear: true
    });

    // Detect change (Select2 safe)
    $('#series').on('select2:select select2:clear change', function (e) {
        let seriesId = $(this).val();
        let indexInputs = $('#dynamic_indexes');

        if (!seriesId) {
            indexInputs.html('');
            return;
        }

        // AJAX call to controller
        $.ajax({
            url: `/records/getIndexes/${seriesId}`,
            method: 'GET',
            dataType: 'json',
            success: function (indexes) {
                let html = '';
                indexes.forEach(idx => {
                    html += `
                        <div class="form-group mb-2">
                            <label class="text-sm mb-0">${idx.name}</label>
                            <input type="${idx.type}" 
                                   name="indexes[${idx.id}]" 
                                   class="form-control form-control-sm" 
                                   placeholder="${idx.placeholder ?? ''}">
                        </div>
                    `;
                });
                indexInputs.html(html);
            },
            error: function (xhr) {
                console.error("Error loading indexes", xhr);
            }
        });
    });
});
</script>
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