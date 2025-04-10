<?php
$request = service('request');
$segment = $request->getUri()->getSegment(1) ?? '';
$path = $request->getUri()->getPath(); // Full path like 'records/upload'
?>

<!-- Sidebar -->
<aside class="main-sidebar sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="<?= base_url('dashboard') ?>" class="brand-link bg-info text-center p-2">
        <span class="brand-text font-weight-light">ARMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar border-right">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- MAIN NAVIGATION -->
                <li class="nav-header">MAIN NAVIGATION</li>

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link <?= ($segment == 'dashboard') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Records Management -->
                <li class="nav-item has-treeview <?= ($segment == 'records') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?= ($segment == 'records') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>Records Management <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('records/search') ?>" class="nav-link <?= ($path == 'records/search') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Advanced Search</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('records/upload') ?>" class="nav-link <?= ($path == 'records/upload') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Upload Records</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- ADMINISTRATION -->
                <li class="nav-header">ADMINISTRATION</li>

                <!-- Users Management -->
                <li class="nav-item has-treeview <?= in_array($segment, ['users', 'roles', 'permissions']) ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?= in_array($segment, ['users', 'roles', 'permissions']) ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users Management <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('users') ?>" class="nav-link <?= ($segment == 'users') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('roles') ?>" class="nav-link <?= ($segment == 'roles') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('permissions') ?>" class="nav-link <?= ($segment == 'permissions') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Directorates -->
                <li class="nav-item">
                    <a href="<?= base_url('directorates') ?>" class="nav-link <?= ($segment == 'directorates') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>Manage Directorates</p>
                    </a>
                </li>

                <!-- Offices -->
                <li class="nav-item">
                    <a href="<?= base_url('offices') ?>" class="nav-link <?= ($segment == 'offices') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Manage Offices</p>
                    </a>
                </li>

                <!-- Libraries -->
                <li class="nav-item has-treeview <?= (in_array($segment, ['libraries', 'records']) || strpos($path, 'libraries/records/') === 0) ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?= ($segment == 'libraries') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Manage Libraries <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Records Submenu -->
                        <li class="nav-item has-treeview <?= (in_array($segment, ['categories', 'types', 'indexes']) || strpos($path, 'libraries/records/') === 0) ? 'menu-open' : ''; ?>">
                            <a href="#" class="nav-link <?= (in_array($segment, ['categories', 'types', 'indexes'])) ? 'active' : ''; ?>">
                                <i class="nav-icon far fa-circle"></i> <!-- Circle icon for main menu -->
                                <p>Records <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('libraries/records/categories') ?>" class="nav-link <?= ($path == 'libraries/records/categories') ? 'active' : ''; ?>">
                                        <i class="nav-icon fas fa-folder"></i> <!-- Uniform folder icon for categories -->
                                        <p>Categories</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('libraries/records/types') ?>" class="nav-link <?= ($path == 'libraries/records/types') ? 'active' : ''; ?>">
                                        <i class="nav-icon fas fa-folder"></i> <!-- Uniform folder icon for types -->
                                        <p>Types</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('libraries/records/indexes') ?>" class="nav-link <?= ($path == 'libraries/records/indexes') ? 'active' : ''; ?>">
                                        <i class="nav-icon fas fa-folder"></i> <!-- Uniform folder icon for indexes -->
                                        <p>Indexes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Users Submenu -->
                        <li class="nav-item">
                            <a href="<?= base_url('libraries/user_status') ?>" class="nav-link <?= ($path == 'libraries/user_status') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Status</p>
                            </a>
                        </li>
                        <!-- Other Libraries Submenus -->
                        <li class="nav-item">
                            <a href="<?= base_url('libraries/record_status') ?>" class="nav-link <?= ($path == 'libraries/record_status') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Records Status</p>
                            </a>
                        </li>
                        <!-- Record Classifications -->
                        <li class="nav-item">
                            <a href="<?= base_url('libraries/record_classifications') ?>" class="nav-link <?= ($path == 'libraries/record_classifications') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Record Classifications</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Activity Logs -->
                <li class="nav-item">
                    <a href="<?= base_url('logs') ?>" class="nav-link <?= ($segment == 'logs') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Activity Logs</p>
                    </a>
                </li>

                <!-- SETTINGS & LOGOUT -->
                <li class="nav-header">SETTINGS</li>

                <!-- System Settings -->
                <li class="nav-item">
                    <a href="<?= base_url('settings') ?>" class="nav-link <?= ($segment == 'settings') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>System Settings</p>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="<?= base_url('logout') ?>" class="nav-link text-danger">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
