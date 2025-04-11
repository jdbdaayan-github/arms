<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <form action="<?= base_url('records/store') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="modal-header bg-info">
          <h5 class="modal-title text-white"><i class="fas fa-upload"></i> Upload New Record</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span>&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <!-- Upload Field at the top -->
          <div class="form-group">
            <label>Upload PDF File</label>
            <div class="custom-file">
              <input type="file" name="file" class="custom-file-input" id="fileUpload" accept="application/pdf" required onchange="previewFile(event)">
              <label class="custom-file-label" for="fileUpload">Choose PDF file...</label>
            </div>
          </div>

          <div class="row mt-4">
            <!-- Left Side: Record Info -->
            <div class="col-md-6 border-right">
              <h6 class="mb-3 font-weight-bold text-info">Record Information</h6>

              <div class="form-group">
                <label>Record Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter record title..." required>
              </div>

              <div class="form-group">
                <label>Record Category & Division</label>
                <select name="category" class="form-control" required>
                  <option disabled selected>Select category...</option>
                  <optgroup label="Legal">
                    <option value="Legal - Contracts">Contracts</option>
                    <option value="Legal - Resolutions">Resolutions</option>
                  </optgroup>
                  <optgroup label="Finance">
                    <option value="Finance - Budget Reports">Budget Reports</option>
                    <option value="Finance - Audits">Audits</option>
                  </optgroup>
                  <optgroup label="Admin">
                    <option value="Admin - Memos">Memos</option>
                    <option value="Admin - Announcements">Announcements</option>
                  </optgroup>
                </select>
              </div>

              <div class="form-group clearfix">
                <div class="icheck-primary d-inline">
                  <input type="checkbox" id="confidential" name="confidential" value="1">
                  <label for="confidential">Mark as Confidential</label>
                </div>
              </div>

              <!-- Dynamic Index Fields (Based on Category) -->
              <div class="form-group mt-4" id="indexFieldsWrapper">
                <label class="text-info">Record Indexes</label>
                <div id="indexFields">
                  <p class="text-muted">Select a category to load index fields...</p>
                </div>
              </div>
            </div>

            <!-- Right Side: Preview -->
            <div class="col-md-6">
              <h6 class="mb-3 font-weight-bold text-info">Record Preview</h6>
              <div class="card card-outline card-info">
                <div class="card-body p-2" style="height: 450px; min-height: 300px;">
                  <iframe id="filePreview" width="100%" height="100%" style="display:none; border:none; min-height: 350px;"></iframe>
                  <p id="noPreview" class="text-muted text-center my-5">No file selected yet.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-success"><i class="fas fa-upload"></i> Submit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- File Preview Script -->
<script>
function previewFile(event) {
  const input = event.target;
  const file = input.files[0];
  const preview = document.getElementById('filePreview');
  const noPreview = document.getElementById('noPreview');
  const fileLabel = document.querySelector('.custom-file-label');

  if (file) {
    fileLabel.textContent = file.name;
    if (file.type === "application/pdf") {
      preview.src = URL.createObjectURL(file);
      preview.style.display = "block";
      noPreview.style.display = "none";
    } else {
      preview.style.display = "none";
      noPreview.style.display = "block";
    }
  }
}

// Define indexing fields based on category selection
const categoryIndexes = {
  "Legal - Contracts": [
    { name: "contract_number", label: "Contract Number", type: "text" },
    { name: "contract_date", label: "Contract Date", type: "date" }
  ],
  "Legal - Resolutions": [
    { name: "resolution_number", label: "Resolution Number", type: "text" },
    { name: "approved_by", label: "Approved By", type: "text" }
  ],
  "Finance - Budget Reports": [
    { name: "fiscal_year", label: "Fiscal Year", type: "number" },
    { name: "prepared_by", label: "Prepared By", type: "text" }
  ],
  "Finance - Audits": [
    { name: "audit_period", label: "Audit Period", type: "text" },
    { name: "auditor_name", label: "Auditor Name", type: "text" }
  ],
  "Admin - Memos": [
    { name: "memo_date", label: "Memo Date", type: "date" },
    { name: "subject", label: "Subject", type: "text" }
  ],
  "Admin - Announcements": [
    { name: "announcement_date", label: "Announcement Date", type: "date" },
    { name: "announcement_type", label: "Type", type: "text" }
  ]
};

document.querySelector('select[name="category"]').addEventListener('change', function () {
  const selected = this.value;
  const indexFields = document.getElementById('indexFields');
  indexFields.innerHTML = '';

  if (categoryIndexes[selected]) {
    categoryIndexes[selected].forEach(field => {
      const input = document.createElement('input');
      input.name = `indexes[${field.name}]`;
      input.type = field.type;
      input.className = 'form-control mb-2';
      input.placeholder = field.label;
      input.required = true;

      const label = document.createElement('label');
      label.textContent = field.label;

      const wrapper = document.createElement('div');
      wrapper.className = 'form-group';
      wrapper.appendChild(label);
      wrapper.appendChild(input);

      indexFields.appendChild(wrapper);
    });
  } else {
    indexFields.innerHTML = '<p class="text-muted">No indexing fields for this category.</p>';
  }
});
</script>
