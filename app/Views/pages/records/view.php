<?= $this->extend('layouts/app'); ?>

<?= $this->section('title') ?>
| Records
<?= $this->endSection() ?>

<?= $this->section('content-header') ?>
Records
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item"><a href="<?= base_url('records') ?>">Records</a></li>
<li class="breadcrumb-item active">Details</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-secondary shadow-sm">
            <!-- HEADER -->
            <div class="card-header d-flex justify-content-between align-items-center py-2">
                <h3 class="card-title mb-0"><i class="fas fa-folder-open mr-2"></i> Record Details</h3>

                <div class="btn-group btn-group-sm ml-auto" role="group">
                    <!-- Removed Print and Download -->
                    <a href="<?= base_url('records/bookmark/' . $record->id) ?>" class="btn btn-warning btn-flat" title="Bookmark">
                        <i class="fas fa-bookmark"></i> Bookmark
                    </a>

                    <?php if (hasRole('Superadmin') || hasRole('Administrator') || hasPermission('records.archive')): ?>
                        <a href="<?= base_url('records/archive/' . $record->id) ?>" class="btn btn-info btn-flat" title="Archive">
                            <i class="fas fa-file-archive"></i> Archive
                        </a>
                    <?php endif ?>

                    <?php if (hasRole('Superadmin') || hasRole('Administrator') || hasPermission('records.archive')): ?>
                        <a href="<?= base_url('records/archive/' . $record->id) ?>" class="btn btn-secondary btn-flat" title="Archive">
                            <i class="fas fa-download"></i> Download
                        </a>
                    <?php endif ?>

                    <?php if (hasRole('Superadmin')): ?>
                        <button data-id="<?= $record->id ?>" class="btn btn-danger btn-flat btn-delete-record" title="Delete">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    <?php endif ?>

                    <?php if (hasRole('Superadmin')): ?>
                        <button data-id="<?= $record->id ?>" class="btn btn-dark btn-flat btn-purge-record" title="Purge">
                            <i class="fas fa-times"></i> Purge
                        </button>
                    <?php endif ?>
                </div>
            </div>

            <!-- BODY -->
            <div class="card-body">
                <div class="row">
                    <!-- LEFT SIDE: Record Info + Tabs -->
                    <div class="col-lg-7">
                        <!-- Record Info -->
                        <div class="card mb-3 border">
                            <div class="card-body py-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><strong>Title:</strong> <?= esc($record->title) ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Created By:</strong> <?= esc($record->user_name) ?></p>
                                        <p><strong>Confidential:</strong> <?= $record->confidential == 0 ? 'No' : 'Yes' ?></p>
                                        <p><strong>Date:</strong> <?= ($record->record_date == '0000-00-00' || $record->record_date == null) ? '--' : date('F j, Y', strtotime($record->record_date)) ?></p>
                                        <p><strong>Series Title:</strong> <?= esc($record->series) ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Status:</strong> <?= esc($record->status) ?></p>
                                        <p><strong>File Name:</strong> <?= esc($record->filename . ' v[' . $record->version . ']') ?></p>
                                        <p><strong>Creation Date:</strong> <?= date('F j, Y', strtotime($record->created_at)) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabs -->
                        <div class="card card-outline card-primary">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#history" data-toggle="tab">History</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#versions" data-toggle="tab">Versions</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#indexes" data-toggle="tab">Indexes</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#notes" data-toggle="tab">Notes</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#permissions" data-toggle="tab">Permissions</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">

                                    <!-- History Tab -->
                                    <div class="tab-pane active" id="history">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Record History</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($histories as $his): ?>
                                                    <tr>
                                                        <td>
                                                            [ <?= date('Y-m-d h:i A', strtotime($his->created_at)) ?> ]
                                                            <span class="text-primary mx-1"><?= esc($his->user) ?></span>
                                                            <?= esc($his->action) ?>
                                                            <span class="text-success ml-1"><?= esc($his->description) ?></span>.
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Versions Tab -->
                                    <div class="tab-pane" id="versions">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Version</th>
                                                    <th>File Name</th>
                                                    <th>Uploaded By</th>
                                                    <th>Date</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($versions as $version): ?>
                                                    <tr>
                                                        <td>v<?= esc($version->version) ?></td>
                                                        <td><?= esc($version->filename) ?></td>
                                                        <td><?= esc($version->user_name) ?></td>
                                                        <td><?= date('F j, Y', strtotime($version->created_at)) ?></td>
                                                        <td class="text-center">
                                                            <a href="<?= base_url('records/view_version/' . $version->record_id) ?>" target="_blank" class="btn btn-sm btn-info" title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <!-- Download hidden -->
                                                            <button class="btn btn-sm btn-danger btn-delete-version" data-id="<?= $version->record_id ?>" title="Delete">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Indexes Tab -->
                                    <div class="tab-pane" id="indexes">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Index Name</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($indexes as $index): ?>
                                                    <tr>
                                                        <td><?= esc($index->index_name) ?></td>
                                                        <td><?= esc($index->value) ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Notes Tab -->
                                    <div class="tab-pane" id="notes">
                                        <ul class="list-group">
                                            <li class="list-group-item">Initial record creation.</li>
                                            <li class="list-group-item">Updated title on 2025-09-05.</li>
                                        </ul>
                                    </div>

                                    <!-- Permissions Tab -->
                                    <div class="tab-pane" id="permissions">
                                        <div class="table-responsive mt-3">
                                            <table class="table table-hover table-striped table-bordered">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>User Name</th>
                                                        <th class="text-center">Can View</th>
                                                        <th class="text-center">Can Edit</th>
                                                        <th class="text-center">Can Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>John Doe</td>
                                                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                                        <td class="text-center"><i class="fas fa-check text-warning"></i></td>
                                                        <td class="text-center"><i class="fas fa-check text-danger"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jane Smith</td>
                                                        <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                                        <td class="text-center"><i class="fas fa-times text-secondary"></i></td>
                                                        <td class="text-center"><i class="fas fa-times text-secondary"></i></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT SIDE: Preview -->
                    <div class="col-lg-5">
                        <div class="card card-outline <?= ($record->confidential == 0 ? 'card-primary' : 'card-danger') ?> h-100 shadow-sm">
                            <div class="card-header py-2">
                                <h3 class="card-title mb-0"><i class="fas fa-file-alt mr-2"></i> Preview</h3>
                            </div>
                            <div class="card-body p-0 text-center" style="height: 500px; overflow: hidden;">
                                <?php if ($record->confidential == 1 && session()->get('role') == 'Standard User' && $record->status_id == 2): ?>
                                    <!-- CONFIDENTIAL: NO PREVIEW -->
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <div class="text-center text-muted">
                                            <i class="fas fa-lock fa-3x mb-3"></i>
                                            <p class="mb-0"><strong>Confidential File</strong></p>
                                            <small>Preview is disabled for confidential records.</small>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <!-- ALLOWED PREVIEW -->
                                    <?php
                                    $filePath = base_url('records/preview/' . $record->randomfilename);
                                    $extension = strtolower(pathinfo($record->randomfilename, PATHINFO_EXTENSION));
                                    ?>

                                    <?php if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                        <img src="<?= $filePath ?>" alt="Preview" class="img-fluid" style="max-height: 100%;">
                                    <?php elseif ($extension === 'pdf'): ?>
                                        <iframe src="<?= $filePath ?>#toolbar=0" width="100%" height="500" style="border: none;"></iframe>
                                    <?php else: ?>
                                        <p class="mt-5 text-muted">No preview available for this file type.</p>
                                    <?php endif; ?>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                </div> <!-- end row -->
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>