<?php
$errors = session()->getFlashdata('errors') ?? [];
?>

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

        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-folder-plus mr-2"></i>Create Record</h3>
            </div>

            <form action="<?= base_url('records/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="row">
                        <!-- LEFT SIDE -->
                        <div class="col-md-6">

                            <!-- File Upload -->
                            <div class="form-group">
                                <label for="record_file">Upload PDF <span class="text-danger">*</span></label>
                                <div class="custom-file">
                                    <input type="file"
                                        class="custom-file-input <?= isset($errors['record_file']) ? 'is-invalid' : '' ?>"
                                        id="record_file"
                                        name="record_file"
                                        accept="application/pdf">
                                    <label class="custom-file-label" for="record_file">Choose PDF file</label>
                                    <?php if (isset($errors['record_file'])): ?>
                                        <div class="invalid-feedback"><?= $errors['record_file'] ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Filename + Copy -->
                                <div id="fileNameWrapper" class="mt-2" style="display:none;">
                                    <input type="text" id="fileNameText" class="form-control form-control-sm bg-light" readonly>
                                    <button type="button" class="btn btn-sm btn-outline-secondary mt-1" id="copyFileName">
                                        <i class="fas fa-copy"></i> Copy File Name
                                    </button>
                                </div>
                            </div>

                            <!-- Title -->
                            <div class="form-group">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>"
                                    id="title"
                                    name="title"
                                    placeholder="Enter title"
                                    value="<?= set_value('title') ?>">
                                <?php if (isset($errors['title'])): ?>
                                    <div class="invalid-feedback"><?= $errors['title'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Confidentiality -->
                            <div class="form-group">
                                <label for="confidentiality">Confidentiality </label>
                                <select class="form-control select2bs4 <?= isset($errors['confidentiality']) ? 'is-invalid' : '' ?>"
                                    id="confidentiality"
                                    name="confidentiality">
                                    <option value="0" <?= set_value('confidentiality') == "0" ? 'selected' : '' ?>>Public</option>
                                    <option value="1" <?= set_value('confidentiality') == "1" ? 'selected' : '' ?>>Confidential</option>
                                </select>
                                <?php if (isset($errors['confidentiality'])): ?>
                                    <div class="invalid-feedback"><?= $errors['confidentiality'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Series -->
                            <div class="form-group">
                                <label for="series">Series Title <span class="text-danger">*</span></label>
                                <select class="form-control select2bs4 <?= isset($errors['series']) ? 'is-invalid' : '' ?>"
                                    id="series"
                                    name="series">
                                    <option value="">-- Select --</option>
                                    <?php foreach ($series as $ser): ?>
                                        <option value="<?= $ser->id ?>" <?= set_value('series') == $ser->id ? 'selected' : '' ?>>
                                            <?= esc($ser->name) ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                                <?php if (isset($errors['series'])): ?>
                                    <div class="invalid-feedback"><?= $errors['series'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Document Date -->
                            <div class="form-group">
                                <label for="record_date">Document Date</label>
                                <input type="date" class="form-control <?= isset($errors['record_date']) ? 'is-invalid' : '' ?>"
                                    id="record_date"
                                    name="record_date"
                                    value="<?= set_value('record_date') ?>">
                                <?php if (isset($errors['record_date'])): ?>
                                    <div class="invalid-feedback"><?= $errors['record_date'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Dynamic Indexes -->
                            <div class="card card-sm">
                                <div class="card-header py-2">Record Index</div>
                                <div class="card-body p-2">
                                    <div id="dynamic_indexes"></div>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT SIDE (PDF Preview) -->
                        <div class="col-md-6">
                            <div class="card card-outline card-secondary h-100">
                                <div class="card-header py-2">
                                    <h3 class="card-title text-sm"><i class="fas fa-file-pdf mr-2"></i> PDF Preview</h3>
                                </div>
                                <div class="card-body p-1 d-flex justify-content-center align-items-center"
                                    style="height: 500px; background:#f8f9fa;">
                                    <span id="pdfPlaceholder" class="text-muted">No file selected</span>
                                    <embed id="pdfPreview" src="" type="application/pdf" width="100%" height="100%" style="display:none;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FOOTER -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-flat float-right">
                        <i class="fas fa-save mr-1"></i> Save Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    // Init Select2
    $('#series').select2({
        theme: 'bootstrap4',
        width: '100%'
    });

    function loadIndexes(seriesId) {
        let indexInputs = $('#dynamic_indexes');
        let oldIndexes = <?= json_encode(old('indexes') ?? []) ?>;

        if (!seriesId) {
            indexInputs.html('<p class="text-muted mb-0">Select a series to load indexes...</p>');
            return;
        }

        $.ajax({
            url: `/records/getIndexes/${seriesId}`,
            method: 'GET',
            dataType: 'json',
            success: function(indexes) {
                if (!indexes || indexes.length === 0) {
                    indexInputs.html('<p class="text-muted mb-0">No indexes found for this series.</p>');
                    return;
                }

                let html = '';
                indexes.forEach(idx => {
                    let value = oldIndexes[idx.id] ?? '';
                    let isRequired = Boolean(Number(idx.required));
                    let requiredAttr = isRequired ? 'required' : '';
                    let requiredStar = isRequired ? '<span class="text-danger">*</span>' : '';
                    let placeholderText = idx.placeholder ? `placeholder="${idx.placeholder}"` : '';

                    html += `
                        <div class="form-group mb-2">
                            <label class="text-sm mb-0">${idx.name} ${requiredStar}</label>
                            <input type="${idx.type}" 
                                name="indexes[${idx.id}]" 
                                class="form-control form-control-sm" 
                                value="${value}" 
                                ${placeholderText} 
                                ${requiredAttr}>
                        </div>
                    `;
                });

                indexInputs.html(html);
            },
            error: function(xhr) {
                console.error("Error loading indexes", xhr);
                indexInputs.html('<p class="text-danger mb-0">Failed to load indexes. Please try again.</p>');
            }
        });
    }

    // Trigger when series changes
    $('#series').on('select2:select select2:clear change', function() {
        loadIndexes($(this).val());
    });

    // Initial load if series is preselected
    let preselectedSeries = $('#series').val();
    if (!preselectedSeries) {
        $('#dynamic_indexes').html('<p class="text-muted text-center mb-0">Select a series to load indexes...</p>');
    } else {
        loadIndexes(preselectedSeries);
    }
});
</script>


<script>
    $(function() {
        const form = $('form');
        const btnSave = form.find('button[type="submit"]');

        form.on('submit', function() {
            btnSave.prop('disabled', true);
            btnSave.html(
                `<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>
             Saving...`
            );
        });
    });
</script>

<script>
    $(function() {
        // File input change
        $('#record_file').on('change', function() {
            let file = this.files[0];
            let preview = $('#pdfPreview');
            let placeholder = $('#pdfPlaceholder');
            let fileNameWrapper = $('#fileNameWrapper');
            let fileNameText = $('#fileNameText');

            if (file) {
                $(this).next('.custom-file-label').html(file.name);

                // remove .pdf for display
                let displayName = file.name.replace(/\.pdf$/i, "");

                fileNameText.val(displayName);
                fileNameWrapper.show();

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
                    fileNameWrapper.hide();
                }
            } else {
                preview.hide().attr('src', '');
                placeholder.show();
                fileNameWrapper.hide();
            }
        });

        // Copy file name
        $('#copyFileName').on('click', function() {
            let fileNameText = document.getElementById('fileNameText');
            fileNameText.select();
            fileNameText.setSelectionRange(0, 99999);
            document.execCommand("copy");

            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Filename copied!',
                showConfirmButton: false,
                timer: 1500
            });
        });
    });
</script>
<?= $this->endSection() ?>