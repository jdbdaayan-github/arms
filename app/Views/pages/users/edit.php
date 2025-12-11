<?= $this->extend('layouts/app'); ?>

<?= $this->section('title') ?>
| Users
<?= $this->endSection() ?>

<?= $this->section('content-header') ?>
Users
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item"><a href="<?= base_url('users') ?>">Users</a></li>
<li class="breadcrumb-item active">Edit</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">

        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus mr-2"></i>Edit User</h3>
            </div>

            <?php $errors = session()->getFlashdata('errors') ?? []; ?>

            <form action="<?= base_url('users/update/') ?><?=  $user->id ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="card-body">
                    <div class="row">
                        <!-- Personal Info -->
                        <div class="col-md-6 border-right">
                            <h5 class="mb-3">Personal Information</h5>

                            <div class="form-group">
                                <label for="firstname">First Name <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control <?= isset($errors['firstname']) ? 'is-invalid' : '' ?>"
                                       id="firstname"
                                       name="firstname"
                                       value="<?= $user->firstname ?>"
                                       placeholder="Enter first name">
                                <?php if (isset($errors['firstname'])): ?>
                                    <div class="invalid-feedback"><?= $errors['firstname'] ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="middlename">Middle Name</label>
                                <input type="text"
                                       class="form-control <?= isset($errors['middlename']) ? 'is-invalid' : '' ?>"
                                       id="middlename"
                                       name="middlename"
                                       value="<?= $user->middlename ?>"
                                       placeholder="Enter middle name">
                                <?php if (isset($errors['middlename'])): ?>
                                    <div class="invalid-feedback"><?= $errors['middlename'] ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="lastname">Last Name <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control <?= isset($errors['lastname']) ? 'is-invalid' : '' ?>"
                                       id="lastname"
                                       name="lastname"
                                       value="<?= $user->lastname ?>"
                                       placeholder="Enter last name">
                                <?php if (isset($errors['lastname'])): ?>
                                    <div class="invalid-feedback"><?= $errors['lastname'] ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="extension">Extension</label>
                                <input type="text"
                                       class="form-control <?= isset($errors['extension']) ? 'is-invalid' : '' ?>"
                                       id="extension"
                                       name="extension"
                                       value="<?= $user->extension ?>"
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
                                       value="<?= $user->email ?>"
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
                                <label for="password">Username <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>"
                                       id="username"
                                       name="username"
                                       placeholder="Enter username"
                                       value="<?= $user->username ?>">
                                <?php if (isset($errors['username'])): ?>
                                    <div class="invalid-feedback"><?= $errors['username'] ?></div>
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
                                    <?php foreach( $roles as $role): ?>
                                    <option value="<?= $role->id ?>" <?= ($user->role_id == $role->id)? 'selected': '' ?>><?= $role->role_name ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?php if (isset($errors['role'])): ?>
                                    <div class="invalid-feedback"><?= $errors['role'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="<?=  base_url('users/edit/') ?><?= $user->id  ?> ?>" class="btn btn-secondary btn-flat">
                        <i class="fas fa-save mr-1"></i> Reset
                                </a>
                    <button type="submit" class="btn btn-success btn-flat">
                        <i class="fas fa-edit mr-1"></i> Update User
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
