<?php
$request = service('request');

$uri = $request->getUri();
$segments = $uri->getSegments();

$segment1 = isset($segments[0]) ? $segments[0] : ''; 
$segment2 = isset($segments[1]) ? $segments[1] : ''; 
$segment3 = isset($segments[2]) ? $segments[2] : ''; 
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
                    <a href="<?= base_url('dashboard') ?>" class="nav-link <?= ($segment1 == 'dashboard') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Records Management -->
                <li class="nav-item has-treeview <?= ($segment1 == 'records') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?= ($segment1 == 'records') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>Records Management <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('records/search') ?>" class="nav-link <?= ($segment1 == 'records' && $segment2 == 'search') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Advanced Search</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('records/upload') ?>" class="nav-link <?= ($segment1 == 'records' && $segment2 == 'upload') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Upload Records</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- ADMINISTRATION -->
                <li class="nav-header">ADMINISTRATION</li>

                <!-- Users Management -->
                <li class="nav-item has-treeview <?= in_array($segment1, ['users', 'roles', 'permissions']) ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?= in_array($segment1, ['users', 'roles', 'permissions']) ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users Management <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('users') ?>" class="nav-link <?= ($segment1 == 'users') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('roles') ?>" class="nav-link <?= ($segment1 == 'roles') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('permissions') ?>" class="nav-link <?= ($segment1 == 'permissions') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Directorates -->
                <li class="nav-item">
                    <a href="<?= base_url('directorates') ?>" class="nav-link <?= ($segment1 == 'directorates') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>Manage Directorates</p>
                    </a>
                </li>

                <!-- Offices -->
                <li class="nav-item">
                    <a href="<?= base_url('offices') ?>" class="nav-link <?= ($segment1 == 'offices') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Manage Offices</p>
                    </a>
                </li>

                <!-- Libraries -->
                <!-- Libraries -->
        <li class="nav-item has-treeview <?= ($segment1 == 'libraries') ? 'menu-open' : ''; ?>">
            <a href="#" class="nav-link <?= ($segment1 == 'libraries') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Manage Libraries
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>

            <!-- Records submenu -->
            <ul class="nav nav-treeview">
                <li class="nav-item has-treeview <?= ($segment2 == 'records') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?= ($segment2 == 'records') ? 'active' : ''; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Records
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('libraries/records/classifications') ?>" class="nav-link <?= ($segment3 == 'classifications') ? 'active' : ''; ?>">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Classifications</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('libraries/records/categories') ?>" class="nav-link <?= ($segment3 == 'categories') ? 'active' : ''; ?>">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('libraries/records/indexes') ?>" class="nav-link <?= ($segment3 == 'indexes') ? 'active' : ''; ?>">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Indexes</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>


                <!-- Activity Logs -->
                <li class="nav-item">
                    <a href="<?= base_url('logs') ?>" class="nav-link <?= ($segment1 == 'logs') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Activity Logs</p>
                    </a>
                </li>

                <!-- SETTINGS & LOGOUT -->
                <li class="nav-header">SETTINGS</li>

                <!-- System Settings -->
                <li class="nav-item">
                    <a href="<?= base_url('settings') ?>" class="nav-link <?= ($segment1 == 'settings') ? 'active' : ''; ?>">
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
