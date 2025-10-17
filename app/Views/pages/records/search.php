<?= $this->extend('layouts/app'); ?>

<?= $this->section('title') ?>
| Records
<?= $this->endSection() ?>

<?= $this->section('content-header') ?>
Advanced Search
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item"><a href="<?= base_url('records') ?>">Records</a></li>
<li class="breadcrumb-item active">Advanced Search</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">

        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-search mr-2"></i>Advanced Search Filters</h3>
            </div>

            <form method="GET" action="<?= base_url('records/search') ?>">
                <div class="card-body">
                    <div class="row">
                        <!-- LEFT SIDE -->
                        <div class="col-md-6">

                            <!-- Keyword -->
                            <div class="form-group">
                                <label for="keyword">Keyword</label>
                                <input type="text" class="form-control" id="keyword" name="keyword"
                                    placeholder="Search by title, index, or content..."
                                    value="<?= esc($filters['keyword'] ?? '') ?>">
                            </div>

                            <!-- Series -->
                            <div class="form-group">
                                <label for="series">Series</label>
                                <select class="form-control select2bs4" id="series" name="series">
                                    <option value="">-- Any Series --</option>
                                    <?php foreach ($series as $ser): ?>
                                        <option value="<?= $ser->id ?>"
                                            <?= ($filters['series'] ?? '') == $ser->id ? 'selected' : '' ?>>
                                            <?= esc($ser->name) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Confidentiality -->
                            <div class="form-group">
                                <label for="confidentiality">Confidentiality</label>
                                <select class="form-control select2bs4" id="confidentiality" name="confidentiality">
                                    <option value="">-- Any --</option>
                                    <option value="0" <?= ($filters['confidentiality'] ?? '') === '0' ? 'selected' : '' ?>>Public</option>
                                    <option value="1" <?= ($filters['confidentiality'] ?? '') === '1' ? 'selected' : '' ?>>Confidential</option>
                                </select>
                            </div>

                            <!-- Record Date Range -->
                            <div class="form-group">
                                <label>Date Range</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="date_from"
                                        value="<?= esc($filters['date_from'] ?? '') ?>">
                                    <input type="date" class="form-control" name="date_to"
                                        value="<?= esc($filters['date_to'] ?? '') ?>">
                                </div>
                            </div>

                            <!-- ⚡ Dynamic Index Filters -->
                            <div class="card card-sm mt-3">
                                <div class="card-header py-2">Index Filters</div>
                                <div class="card-body p-2" id="dynamic_indexes">
                                    <?php if (isset($indexes) && !empty($indexes)): ?>
                                        <?php foreach ($indexes as $idx): ?>
                                            <div class="form-group mb-2">
                                                <label class="text-sm mb-0"><?= esc($idx->name) ?></label>
                                                <input type="text"
                                                    name="indexes[<?= $idx->id ?>]"
                                                    class="form-control form-control-sm"
                                                    placeholder="<?= esc($idx->placeholder ?? '') ?>"
                                                    value="<?= esc($filters['indexes'][$idx->id] ?? '') ?>">
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="text-muted mb-0">Select a series to load index filters...</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT SIDE -->
                        <div class="col-md-6">
                            <div class="card card-outline card-secondary h-100">
                                <div class="card-header py-2">
                                    <h3 class="card-title text-sm"><i class="fas fa-table mr-2"></i> Search Results</h3>
                                </div>
                                <div class="card-body p-2" style="min-height: 500px; overflow:auto;">
                                    <?php if (isset($records)): ?>
                                        <?php if (empty($records)): ?>
                                            <div class="text-center text-muted my-5">
                                                <i class="fas fa-info-circle fa-2x mb-2"></i>
                                                <p>No records found.</p>
                                            </div>
                                        <?php else: ?>
                                            <table class="table table-sm table-bordered table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Series</th>
                                                        <th>Date</th>
                                                        <th>Confidentiality</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($records as $r): ?>
                                                        <tr>
                                                            <td><?= esc($r->title) ?></td>
                                                            <td><?= esc($r->series_name ?? '') ?></td>
                                                            <td><?= esc($r->record_date) ?></td>
                                                            <td><?= $r->confidential ? 'Confidential' : 'Public' ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="text-center text-muted my-5">
                                            <i class="fas fa-search fa-2x mb-2"></i>
                                            <p>Use filters and click <b>Search</b> to view results.</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FOOTER -->
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-info btn-flat">
                        <i class="fas fa-search mr-1"></i> Search
                    </button>
                    <a href="<?= base_url('records/search') ?>" class="btn btn-outline-secondary btn-flat ml-1">
                        <i class="fas fa-undo mr-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script>
$(function() {
    $('#series, #confidentiality').select2({
        theme: 'bootstrap4',
        width: '100%'
    });

    // Load dynamic indexes like in create form
    $('#series').on('change', function() {
        let seriesId = $(this).val();
        let indexInputs = $('#dynamic_indexes');

        if (!seriesId) {
            indexInputs.html('<p class="text-muted mb-0">Select a series to load index filters...</p>');
            return;
        }

        $.ajax({
            url: `/records/getIndexes/${seriesId}`,
            method: 'GET',
            dataType: 'json',
            success: function(indexes) {
                if (!indexes || indexes.length === 0) {
                    indexInputs.html('<p class="text-muted mb-0">No index filters for this series.</p>');
                    return;
                }

                let html = '';
                indexes.forEach(idx => {
                    html += `
                        <div class="form-group mb-2">
                            <label class="text-sm mb-0">${idx.name}</label>
                            <input type="text"
                                name="indexes[${idx.id}]"
                                class="form-control form-control-sm"
                                placeholder="${idx.placeholder ?? ''}">
                        </div>
                    `;
                });
                indexInputs.html(html);
            },
            error: function() {
                indexInputs.html('<p class="text-danger mb-0">Failed to load index filters.</p>');
            }
        });
    });
});
</script>
<?= $this->endSection() ?>
