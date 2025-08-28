<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Users
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
    <li class="breadcrumb-item active">Users</li>
</ol>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">

        <!-- Users Table Card -->
        <div class="card card-outline card-secondary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-users mr-2"></i>Users List</h3>
                <div class="card-tools">
                    <a href="<?= base_url('users/create') ?>" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i> Add User
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-striped table-bordered table-sm text-sm mb-0">

                    <!-- Filters Row (Above Headers) -->
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center">
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Name">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-filter"></i></span>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" placeholder="Email">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-filter"></i></span>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="input-group input-group-sm">
                                    <select class="form-control">
                                        <option value="">All Roles</option>
                                        <option>Admin</option>
                                        <option>Staff</option>
                                        <option>Record Officer</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-filter"></i></span>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="input-group input-group-sm">
                                    <select class="form-control">
                                        <option value="">All Status</option>
                                        <option>Active</option>
                                        <option>Inactive</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-filter"></i></span>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <button class="btn btn-primary btn-sm btn-block">
                                    <i class="fas fa-search mr-1"></i> Filter
                                </button>
                            </th>
                        </tr>

                        <!-- Headers Row -->
                        <tr>
                            <th class="text-center">Select</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <!-- Data Rows -->
                    <tbody>
                        <tr>
                            <td class="text-center"><input type="checkbox"></td>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Admin</td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>
                                <button class="btn btn-info btn-sm"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"><input type="checkbox"></td>
                            <td>Jane Smith</td>
                            <td>jane@example.com</td>
                            <td>Staff</td>
                            <td><span class="badge badge-success">Active</span></td>
                            <td>
                                <button class="btn btn-info btn-sm"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"><input type="checkbox"></td>
                            <td>Mark Johnson</td>
                            <td>mark@example.com</td>
                            <td>Record Officer</td>
                            <td><span class="badge badge-danger">Inactive</span></td>
                            <td>
                                <button class="btn btn-info btn-sm"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</section>
<?= $this->endSection() ?>
