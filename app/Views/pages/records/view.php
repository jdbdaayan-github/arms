<?= $this->extend("layouts/main"); ?>

<?= $this->section("content"); ?>
<div class="content-wrapper">
    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Record Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('records') ?>">Records</a></li>
                        <li class="breadcrumb-item active">View Record</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Single Card: Document Information & Tabs -->
    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm" style="border-top: 3px solid #17a2b8;">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-file-alt"></i> Document Information</h3>
                </div>
                <div class="card-body">
                    <!-- Document Details -->
                    <dl class="row mb-0">
                        <dt class="col-sm-3">Title</dt>
                        <dd class="col-sm-9 font-weight-bold">Disaster Preparedness Plan</dd>

                        <dt class="col-sm-3">Category</dt>
                        <dd class="col-sm-9">Disaster Management</dd>

                        <dt class="col-sm-3">Confidentiality</dt>
                        <dd class="col-sm-9">
                            <span class="badge badge-danger">Confidential</span>
                        </dd>

                        <dt class="col-sm-3">Date Uploaded</dt>
                        <dd class="col-sm-9">April 11, 2025</dd>

                        <dt class="col-sm-3">Uploaded By</dt>
                        <dd class="col-sm-9">Kim Borres</dd>

                        <dt class="col-sm-3">Filename</dt>
                        <dd class="col-sm-9">disaster_preparedness_plan.pdf</dd>

                        <dt class="col-sm-3">Reference No.</dt>
                        <dd class="col-sm-9">DP-2025-001</dd>

                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9">
                            <span class="badge badge-success">Active</span>
                        </dd>

                        <dt class="col-sm-3">Document File</dt>
                        <dd class="col-sm-9">
                            <a href="<?= base_url('uploads/documents/disaster_plan.pdf') ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i> View Document
                            </a>
                        </dd>
                    </dl>

                    <!-- Actions Section (e.g., Edit, Delete, etc.) -->
                    <div class="actions mt-3">
                        <button class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                        <button class="btn btn-sm btn-secondary">
                            <i class="fas fa-print"></i> Print
                        </button>
                        
                        <!-- Favorite Button with Star Icon -->
                        <button class="btn btn-sm btn-warning" id="favorite-btn">
                            <i class="fas fa-star" id="favorite-icon"></i> Favorite
                        </button>
                    </div>

                    <!-- Division (Separation between Document Details and Tabs) -->
                    <div class="divider my-4" style="border-top: 2px solid #ccc;"></div>

                    <!-- Tabs: History, Version, Notes, Index, Attachment -->
                    <ul class="nav nav-tabs mt-3" id="record-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="history-tab" data-toggle="pill" href="#history" role="tab">History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="versions-tab" data-toggle="pill" href="#versions" role="tab">Versions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="notes-tab" data-toggle="pill" href="#notes" role="tab">Notes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="index-tab" data-toggle="pill" href="#index" role="tab">Index</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="attachment-tab" data-toggle="pill" href="#attachment" role="tab">Attachment</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3" id="record-tabContent">
                        <!-- History Tab -->
                        <div class="tab-pane fade show active" id="history" role="tabpanel">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">[2025-04-11] <strong>Kim Borres</strong> uploaded the document.</li>
                                <li class="list-group-item">[2025-04-12] <strong>Maria Lopez</strong> viewed the document.</li>
                                <li class="list-group-item">[2025-04-13] <strong>Mark Reyes</strong> updated metadata.</li>
                            </ul>
                        </div>

                        <!-- Versions Tab -->
                        <div class="tab-pane fade" id="versions" role="tabpanel">
                            <table class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Version</th>
                                        <th>Date</th>
                                        <th>Updated By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>v1.0</td>
                                        <td>2025-04-11</td>
                                        <td>Kim Borres</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i> View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>v1.1</td>
                                        <td>2025-04-13</td>
                                        <td>Mark Reyes</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i> View</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Notes Tab -->
                        <div class="tab-pane fade" id="notes" role="tabpanel">
                            <p>No notes available.</p>
                        </div>

                        <!-- Index Tab -->
                        <div class="tab-pane fade" id="index" role="tabpanel">
                            <table class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Index Name</th>
                                        <th>Index Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Title</td>
                                        <td>VARCHAR</td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td>VARCHAR</td>
                                    </tr>
                                    <tr>
                                        <td>Date Uploaded</td>
                                        <td>DATE</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Attachment Tab -->
                        <div class="tab-pane fade" id="attachment" role="tabpanel">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="<?= base_url('uploads/documents/disaster_plan.pdf') ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-download"></i> Download Attachment
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="<?= base_url('uploads/images/disaster_plan_preview.jpg') ?>" target="_blank" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-image"></i> View Image Preview
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal for Delete Action -->
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
                Are you sure you want to delete this record? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
