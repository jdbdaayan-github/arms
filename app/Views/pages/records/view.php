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
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-folder-open mr-2"></i>Record Details</h3>
            </div>

            <div class="card-body">
                <!-- Record Info -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Title: </strong><?= esc($record->title)?></p>
                        <p><strong>Confidential: </strong><?= esc($record->confidential==0?'No':'Yes')?></p>
                        <p><strong>Date: </strong><?= esc($record->record_date='0000-00-00 00:00:00' || $record->record_date=null?"":date('F d, Y', strtotime($record->record_date)))?></p>
                        <p><strong>Title: </strong><?= esc($record->series)?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Created By:</strong> <?= esc($record->user_name)?></p>
                        <p><strong>Status: </strong><?= esc($record->status)?></p>
                        <p><strong>File Name: </strong><?= esc($record->filename .' v['.$record->version.']')?></p>
                        <p><strong>Creation Date: </strong><?= esc(date('F j, Y', strtotime($record->created_at)))?></p>
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
                                            <th>Date</th>
                                            <th>User</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2025-09-01</td>
                                            <td>John Doe</td>
                                            <td>Created Record</td>
                                        </tr>
                                        <tr>
                                            <td>2025-09-05</td>
                                            <td>Jane Smith</td>
                                            <td>Updated Title</td>
                                        </tr>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($versions as $version): ?>
                                        <tr>
                                            <td>Version <?= esc($version->version)?></td>
                                            <td><?= esc($version->filename)?></td>
                                            <td><?= esc($version->user_name)?></td>
                                            <td><?= esc(date('F j, Y', strtotime($version->created_at)))?></td>
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
                                        <?php foreach($indexes as $index): ?>
                                        <tr>
                                            <td><?= esc($index->index_name)?></td>
                                            <td><?= esc($index->value)?></td>
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
