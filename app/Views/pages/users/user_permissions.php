<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Role Permissions
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item"><a href="<?= base_url('roles') ?>">Roles</a></li>
<li class="breadcrumb-item active">Role Permissions</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-shield mr-2"></i>
                    Assign Permissions for: <?= esc($user->firstname) ?>
                </h3>
            </div>

            <form action="<?= base_url('users/savePermissions/'.$user->id) ?>" method="POST">
                <?= csrf_field() ?>
                <div class="card-body">
                    <select multiple="multiple" size="10" name="permissions[]" id="permissions-duallistbox" style="display:none">
                        <?php foreach($user_permissions as $perm): ?>
                            <option value="<?= $perm->id ?>" <?= isset($perm->assigned) && $perm->assigned ? 'selected' : '' ?>>
                                <?= esc($perm->permission_name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-save mr-1"></i> Save Permissions
                    </button>
                    <a href="<?= base_url('roles') ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    var dualListbox = $('#permissions-duallistbox').bootstrapDualListbox({
        nonSelectedListLabel: 'Available Permissions',
        selectedListLabel: 'Assigned Permissions',
        preserveSelectionOnMove: 'moved',
        moveOnSelect: true,
        infoText: 'Showing {0} permissions',
        infoTextEmpty: 'No permissions available'
    });

    $('#permissions-duallistbox').closest('.bootstrap-duallistbox-container').show()

    // Force proper selection syncing
    $('.move').on('click', function() {
        // Refresh the dual listbox so it syncs selected items
        dualListbox.bootstrapDualListbox('refresh', true);
    });

    // Show SweetAlert if session has success
    <?php if(session()->getFlashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '<?= session()->getFlashdata('success') ?>',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>
});
</script>
<?= $this->endSection() ?>
