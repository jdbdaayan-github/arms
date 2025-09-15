<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Users
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item"><a href="<?= base_url('users') ?>">Users</a></li>
<li class="breadcrumb-item active">Create</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">

        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus mr-2"></i>Create User</h3>
            </div>

            <?php $errors = session()->getFlashdata('errors') ?? []; ?>

            <form action="<?= base_url('users/store') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="row">
                        <!-- Personal Info -->
                        <div class="col-md-6 border-right">
                            <h5 class="mb-3">Personal Information</h5>

                            <div class="form-group">
                                <label for="first_name">First Name <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control <?= isset($errors['first_name']) ? 'is-invalid' : '' ?>"
                                       id="first_name"
                                       name="first_name"
                                       value="<?= set_value('first_name') ?>"
                                       placeholder="Enter first name">
                                <?php if (isset($errors['first_name'])): ?>
                                    <div class="invalid-feedback"><?= $errors['first_name'] ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="middle_name">Middle Name</label>
                                <input type="text"
                                       class="form-control <?= isset($errors['middle_name']) ? 'is-invalid' : '' ?>"
                                       id="middle_name"
                                       name="middle_name"
                                       value="<?= set_value('middle_name') ?>"
                                       placeholder="Enter middle name">
                                <?php if (isset($errors['middle_name'])): ?>
                                    <div class="invalid-feedback"><?= $errors['middle_name'] ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control <?= isset($errors['last_name']) ? 'is-invalid' : '' ?>"
                                       id="last_name"
                                       name="last_name"
                                       value="<?= set_value('last_name') ?>"
                                       placeholder="Enter last name">
                                <?php if (isset($errors['last_name'])): ?>
                                    <div class="invalid-feedback"><?= $errors['last_name'] ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="extension">Extension</label>
                                <input type="text"
                                       class="form-control <?= isset($errors['extension']) ? 'is-invalid' : '' ?>"
                                       id="extension"
                                       name="extension"
                                       value="<?= set_value('extension') ?>"
                                       placeholder="e.g. Jr, Sr, II">
                                <?php if (isset($errors['extension'])): ?>
                                    <div class="invalid-feedback"><?= $errors['extension'] ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mt-3">
                                <label for="email">Email Address <span class="text-danger">*</span></label>
                                <input type="email"
                                       class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                                       id="email"
                                       name="email"
                                       value="<?= set_value('email') ?>"
                                       placeholder="Enter email">
                                <?php if (isset($errors['email'])): ?>
                                    <div class="invalid-feedback"><?= $errors['email'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Account Info -->
                        <div class="col-md-6">
                            <h5 class="mb-3">Account Information</h5>

                            <!-- Profile Picture -->
                            <div class="form-group text-center">
                                <label>Profile Picture</label>
                                <div class="mb-2">
                                    <img id="preview" src="<?= base_url('assets/images/default.png') ?>"
                                         class="img-thumbnail rounded-circle"
                                         style="width: 120px; height: 120px; object-fit: cover;">
                                </div>
                                <input type="file"
                                       class="form-control-file <?= isset($errors['profile_pic']) ? 'is-invalid' : '' ?>"
                                       id="profile_pic"
                                       name="profile_pic"
                                       accept="image/*"
                                       onchange="previewImage(event)">
                                <?php if (isset($errors['profile_pic'])): ?>
                                    <div class="invalid-feedback d-block"><?= $errors['profile_pic'] ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password"
                                       class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                                       id="password"
                                       name="password"
                                       placeholder="Enter password">
                                <?php if (isset($errors['password'])): ?>
                                    <div class="invalid-feedback"><?= $errors['password'] ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="role">Role <span class="text-danger">*</span></label>
                                <select class="form-control <?= isset($errors['role']) ? 'is-invalid' : '' ?>"
                                        id="role"
                                        name="role">
                                    <option value="">-- Select Role --</option>
                                    <option value="admin" <?= set_select('role', 'admin') ?>>Administrator</option>
                                    <option value="staff" <?= set_select('role', 'staff') ?>>Staff</option>
                                    <option value="user" <?= set_select('role', 'user') ?>>User</option>
                                </select>
                                <?php if (isset($errors['role'])): ?>
                                    <div class="invalid-feedback"><?= $errors['role'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-flat">
                        <i class="fas fa-save mr-1"></i> Save User
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- JS for image preview -->
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('preview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<?= $this->endSection() ?>
