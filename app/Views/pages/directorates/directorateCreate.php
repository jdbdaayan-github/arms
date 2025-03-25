<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<!-- Content Header (Breadcrumbs) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-1 mt-2">
            <div class="col-sm-6">
                <h2 class="h4">Create Directorate</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right small">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item active">Create Directorate</li>
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
                        <h3 class="card-title small">Directorate Information</h3>
                    </div>
                    <div class="card-body">
                        <form id="directorateForm" action="<?= base_url('directorates/create') ?>" method="post">
                            <?= csrf_field(); ?> <!-- CSRF token added here -->

                            <div class="form-group">
                                <label for="directorateCode" class="small">Directorate Code</label>
                                <input type="text" class="form-control form-control-sm" name="directorateCode" id="directorateCode" placeholder="Enter Directorate Code" value="<?= set_value('directorateCode'); ?>">
                            </div>

                            <div class="form-group">
                                <label for="directorateName" class="small">Directorate Name</label>
                                <input type="text" class="form-control form-control-sm" name="directorateName" id="directorateName" placeholder="Enter Directorate Name" value="<?= set_value('directorateName'); ?>">
                            </div>

                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-save"></i> Save Directorate
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
