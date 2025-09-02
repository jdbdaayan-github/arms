<?php
    $user_id = session()->get('user_id');
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links (Burger icon) -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Right navbar links (User dropdown) -->
    <ul class="navbar-nav ml-auto">
        <!-- User Dropdown Menu -->
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle d-flex pr-0 align-items-center" data-toggle="dropdown">
                <span class="d-none d-md-inline font-weight-bold"><?= session()->get('user_name') ?? 'Guest' ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User header -->
                <li class="user-header bg-info">
                    <img src="<?= base_url('assets/template/dist/img/user2-160x160.jpg') ?>" 
                         class="img-circle elevation-2" 
                         alt="User Image">
                    <p>
                        <?= session()->get('user_name') ?? 'Guest' ?>
                        <small><?= session()->get('role') ?? 'Guest' ?></small>
                    </p>
                </li>
                <!-- Footer with buttons -->
                <li class="user-footer">
                    <a href="<?= base_url('users/profile') ?>/<?= $user_id ?>" class="btn btn-default btn-flat">Profile</a>
                    <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger btn-flat float-right">Logout</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
