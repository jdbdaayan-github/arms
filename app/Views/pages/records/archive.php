<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Records
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Archive</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-archive mr-2"></i>Records Archive</h3>
            </div>

            <div class="card-body">
                <!-- Tabs -->
                <ul class="nav nav-tabs mb-3" id="archiveTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="archived-tab" data-toggle="tab" href="#archived" role="tab" aria-controls="archived" aria-selected="false">
                            Archived
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="for-archive-tab" data-toggle="tab" href="#for-archive" role="tab" aria-controls="for-archive" aria-selected="true">
                            For Archival
                            <span class="right badge badge-warning"><?= $pendingForArchivalCount ?></span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content" id="archiveTabsContent">
                    <!-- For Archival Tab -->
                    <div class="tab-pane fade show active" id="for-archive" role="tabpanel" aria-labelledby="for-archive-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm mb-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <input type="checkbox" id="check-all-for-archive">
                                        </th>
                                        <th>Title</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($records)): ?>
                                        <?php foreach ($records as $record): ?>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="checkbox" class="record-checkbox-for-archive" value="<?= $record->id ?>">
                                                </td>
                                                <td><?= esc($record->title) ?></td>
                                                <td class="text-center">
                                                    <?php if(hasPermission('records.view')): ?>
                                                        <a href="<?= base_url('records/show/' . $record->id) ?>" class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    <?php endif ?>
                                                    <?php if(hasPermission('records.archive')): ?>
                                                        <a href="<?= base_url('records/archive/' . $record->id) ?>" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-archive"></i>
                                                        </a>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center">No records ready for archival</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Archived Tab -->
                    <div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm mb-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Archived At</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($recordsforarchival)): ?>
                                        <?php foreach ($recordsforarchival as $index => $record): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= esc($record->title) ?></td>
                                                <td><?= date('F d, Y H:i', strtotime($record->archived_at)) ?></td>
                                                <td class="text-center">
                                                    <?php if(hasPermission('records.view')): ?>
                                                        <a href="<?= base_url('records/show/' . $record->id) ?>" class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    <?php endif ?>
                                                    <?php if(hasPermission('records.restore')): ?>
                                                        <a href="<?= base_url('records/restore/' . $record->id) ?>" class="btn btn-success btn-sm">
                                                            <i class="fas fa-undo"></i> Restore
                                                        </a>
                                                    <?php endif ?>
                                                    <?php if(hasPermission('records.delete')): ?>
                                                        <a href="<?= base_url('records/delete/' . $record->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to permanently delete this record?');">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </a>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No archived records found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Toggle checkboxes for For Archival tab
    const checkAllForArchive = document.getElementById('check-all-for-archive');
    const checkboxesForArchive = document.querySelectorAll('.record-checkbox-for-archive');

    checkAllForArchive.addEventListener('change', () => {
        checkboxesForArchive.forEach(cb => cb.checked = checkAllForArchive.checked);
    });
</script>
<?= $this->endSection() ?>
