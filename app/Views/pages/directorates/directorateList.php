<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<!-- Content Header (Breadcrumbs) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-1 mt-2">
            <div class="col-sm-6">
                <h2 class="h4">List of Directorates</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right small">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Directorates</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title small">Directorate List</h3>
                        <a href="<?= base_url('directorates/create'); ?>" class="btn btn-primary btn-sm float-right">
                            <i class="fas fa-plus"></i> Add New Directorate
                        </a>
                    </div>
                    <div class="card-body">

                        <!-- ✅ Success Message Alert -->
                        <?php if (session()->getFlashdata('success')) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('success'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <table class="table table-bordered table-sm" id="directoratelist">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Directorate Code</th>
                                    <th>Directorate Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($directorates)) : ?>
                                    <?php foreach ($directorates as $index => $directorate) : ?>
                                        <tr>
                                            <td class="text-center"><?= $index + 1 ?></td>
                                            <td><?= esc($directorate['directorateCode']) ?></td>
                                            <td><?= esc($directorate['directorateName']) ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('directorates/edit/' . $directorate['directorateID']) ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <button onclick="deleteDirectorate(<?= $directorate['directorateID'] ?>)" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="4" class="text-center">No directorates found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function deleteDirectorate(id) {
    if (confirm('Are you sure you want to delete this directorate?')) {
        window.location.href = "<?= base_url('directorates/delete/') ?>" + id;
    }
}

// ✅ Auto-hide success alert after 3 seconds
</script>


<?= $this->endSection() ?>
