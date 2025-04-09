<nav class="main-header navbar navbar-expand navbar-info fixed-top">
    <!-- Left Navbar -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link " data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars text-white"></i> <!-- Burger icon -->
            </a>
        </li>
    </ul>

    <!-- Right Navbar (Username dropdown) -->
    <ul class="navbar-nav ml-auto">
        <!-- User Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <span class="text-white"><?= session()->get('user_name')?></span> <!-- Display username -->
            </a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <i class="fas fa-cogs"></i> Settings
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
