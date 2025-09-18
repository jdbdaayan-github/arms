<?= $this->extend('layouts/app'); ?>

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
        <div class="card card-outline card-secondary">
            <div class="card-header d-flex justify-content-between align-items-center py-2">
                <h3 class="card-title"><i class="fas fa-folder-open mr-2"></i>Record Details</h3>

                <!-- Record-level action buttons -->
                <div class="ml-auto">
                    <!-- Print -->
                    <a href="<?= base_url('records/print/' . $record->id) ?>"
                        target="_blank" class="btn btn-primary btn-sm btn-flat">
                        <i class="fas fa-print"></i> Print
                    </a>
                    <?php if (hasRole('Superadmin') || hasRole('Archivist') || hasPermission('records.download')): ?>
                        <!-- Download -->
                        <a href="<?= base_url('records/download/' . $record->id) ?>"
                            class="btn btn-success btn-sm btn-flat">
                            <i class="fas fa-download"></i> Download
                        </a>
                    <?php endif ?>
                    <!-- Bookmark -->
                    <a href="<?= base_url('records/bookmark/' . $record->id) ?>"
                        class="btn btn-warning btn-sm btn-flat">
                        <i class="fas fa-bookmark"></i> Bookmark
                    </a>
                    <?php if (hasRole('Superadmin') || hasRole('Archivist') || hasPermission('records.archive')): ?>
                        <!-- Archive -->
                        <a href="<?= base_url('records/archive/' . $record->id) ?>"
                            class="btn btn-info btn-sm btn-flat">
                            <i class="fas fa-file-archive"></i> Archive
                        </a>
                    <?php endif ?>
                    <?php if(hasRole('Superadmin')): ?>
                    <!-- Delete -->
                    <button data-id="<?= $record->id ?>"
                        class="btn btn-danger btn-sm btn-flat btn-delete-record">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                        <?php endif ?>
                    <!-- Purge -->
                    <button data-id="<?= $record->id ?>"
                        class="btn btn-dark btn-sm btn-flat btn-purge-record">
                        <i class="fas fa-times"></i> Purge
                    </button>
                </div>
            </div>

            <div class="card-body">
                <!-- Record Info -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Title: </strong><?= esc($record->title) ?></p>
                        <p><strong>Confidential: </strong><?= esc($record->confidential == 0 ? 'No' : 'Yes') ?></p>
                        <p><strong>Date: </strong><?= esc($record->record_date == '0000-00-00 00:00:00' || $record->record_date == null ? "" : date('F j, Y', strtotime($record->record_date))) ?></p>
                        <p><strong>Series Title: </strong><?= esc($record->series) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Created By:</strong> <?= esc($record->user_name) ?></p>
                        <p><strong>Status: </strong><?= esc($record->status) ?></p>
                        <p><strong>File Name: </strong><?= esc($record->filename . ' v[' . $record->version . ']') ?></p>
                        <p><strong>Creation Date: </strong><?= esc(date('F j, Y', strtotime($record->created_at))) ?></p>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#history" data-toggle="tab">History</a></li>
                            <li class="nav-item"><a class="nav-link" href="#versions" data-toggle="tab">Versions</a></li>
                            <li class="nav-item"><a class="nav-link" href="#indexes" data-toggle="tab">Indexes</a></li>
                            <li class="nav-item"><a class="nav-link" href="#notes" data-toggle="tab">Notes</a></li>
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
                                                <td class="d-flex ">[ <b class="mx-1"><?= date('Y-m-d H:i', strtotime($his->created_at)) ?></b> ] <p class="m-0 text-primary mx-1"><?= esc($his->user) ?></p> <?= esc($his->action) ?> <p class="text-success m-0 ml-1"> <?= esc($his->description) ?></p>.</td>
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
                                                <td>Version <?= esc($version->version) ?></td>
                                                <td><?= esc($version->filename) ?></td>
                                                <td><?= esc($version->user_name) ?></td>
                                                <td><?= esc(date('F j, Y', strtotime($version->created_at))) ?></td>
                                                <td class="text-center">
                                                    <!-- View -->
                                                    <a href="<?= base_url('records/view_version/' . $version->record_id) ?>"
                                                        target="_blank"
                                                        class="btn btn-sm btn-info" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <!-- Download -->
                                                    <a href="<?= base_url('records/download_version/' . $version->record_id) ?>"
                                                        class="btn btn-sm btn-success" title="Download">
                                                        <i class="fas fa-download"></i>
                                                    </a>

                                                    <!-- Delete -->
                                                    <button class="btn btn-sm btn-danger btn-delete-version"
                                                        data-id="<?= $version->record_id ?>"
                                                        title="Delete">
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
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>