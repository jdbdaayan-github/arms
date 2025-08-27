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
            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown">
                <img src="<?= base_url('assets/template/dist/img/user2-160x160.jpg') ?>" 
                     class="user-image img-circle elevation-2 mr-2" 
                     alt="User Image" 
                     style="height:35px; width:35px; object-fit:cover;">
                <span class="d-none d-md-inline"><?= session()->get('username') ?? 'Guest' ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User header -->
                <li class="user-header bg-primary">
                    <img src="<?= base_url('assets/template/dist/img/user2-160x160.jpg') ?>" 
                         class="img-circle elevation-2" 
                         alt="User Image">
                    <p>
                        <?= session()->get('username') ?? 'Guest' ?>
                        <small>Administrator</small>
                    </p>
                </li>
                <!-- Optional body with quick links -->
                <li class="user-body">
                    <div class="row text-center">
                        <div class="col-6 border-right">
                            <a href="<?= base_url('profile') ?>">Profile</a>
                        </div>
                        <div class="col-6">
                            <a href="<?= base_url('settings/preferences') ?>">Settings</a>
                        </div>
                    </div>
                </li>
                <!-- Footer with buttons -->
                <li class="user-footer">
                    <a href="<?= base_url('profile') ?>" class="btn btn-default btn-flat">Profile</a>
                    <a href="<?= base_url('logout') ?>" class="btn btn-danger btn-flat float-right">Logout</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
