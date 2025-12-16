<?php
    $user_id = session()->get('user_id');
    // Example: static notification count for now
    $notifCount = 3; // You can later fetch this dynamically from DB
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

    <!-- Right navbar links (User dropdown + Notifications) -->
    <ul class="navbar-nav ml-auto mr-1">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <?php if($notifCount > 0): ?>
                    <span class="badge badge-warning navbar-badge"><?= $notifCount ?></span>
                <?php endif; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header"><?= $notifCount ?> Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 1 new message
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 2 new followers
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>

        <!-- User Dropdown Menu -->
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle d-flex pr-0 align-items-center" data-toggle="dropdown">
                <span class="d-none d-md-inline font-weight-bold"><?= session()->get('user_name') ?? 'Guest' ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User header -->
                <li class="user-header bg-light">
                    <img src="<?= base_url('assets/template/dist/img/user2-160x160.jpg') ?>" 
                         class="img-circle elevation-2" 
                         alt="User Image">
                    <p>
                        <?= session()->get('user_name') ?? 'Guest' ?>
                        <small><?= session()->get('role') ?? 'Guest' ?></small>
                    </p>
                </li>
                <hr class="m-0 mx-2">
                <!-- Footer with buttons -->
                <li class="user-footer">
                    <a href="<?= base_url('users/profile') ?>/<?= $user_id ?>" class="btn btn-info btn-flat">Profile</a>
                    <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger btn-flat float-right">Sign out</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
