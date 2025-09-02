<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Preferences
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Preferences</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card card-outline card-secondary">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-cogs mr-2"></i>Preferences</h3>
        </div>
        <form action="<?= base_url('preferences/save') ?>" method="post">
            <div class="card-body">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="theme">Theme</label>
                    <select name="theme" id="theme" class="form-control">
                        <option value="light">Light</option>
                        <option value="dark">Dark</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="language">Language</label>
                    <select name="language" id="language" class="form-control">
                        <option value="en">English</option>
                        <option value="ph">Filipino</option>
                        <option value="es">Spanish</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="notifications">Notifications</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="notifications" id="notifications" value="1" checked>
                        <label class="form-check-label" for="notifications">Enable email notifications</label>
                    </div>
                </div>

            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Preferences</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
