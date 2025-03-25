<!-- Sidebar -->
<?php 
$uri = service('request')->getUri();
$segment1 = $uri->getSegment(1, '');
$segment2 = $uri->getSegment(2, '');
?>

<!-- Sidebar -->
<aside class="main-sidebar sidebar-light border-end border-dark">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center bg-info">
        <span class="brand-text font-weight-light">AdminLTE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar border-right">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                <!-- MAIN NAVIGATION -->
                <li class="nav-header text-dark">MAIN NAVIGATION</li>
                <li class="nav-item">
                    <a href="<?= base_url('dashboard'); ?>" class="nav-link text-dark <?= $segment1 == 'dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Records Management -->
                <li class="nav-item has-treeview <?= $segment1 == 'records' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link text-dark <?= $segment1 == 'records' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Records Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                            <a href="<?= base_url('records'); ?>" class="nav-link text-dark <?= $segment2 == '' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Records</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('records/create'); ?>" class="nav-link text-dark <?= $segment2 == 'create' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Record</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('records/advancedsearch'); ?>" class="nav-link text-dark <?= $segment2 == 'advancedsearch' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Advanced Search</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- ADMINISTRATION -->
                <li class="nav-header text-dark">ADMINISTRATION</li>
                <!-- Users -->
                <li class="nav-item has-treeview <?= $segment1 == 'users' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link text-dark <?= $segment1 == 'users' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('users/create'); ?>" class="nav-link text-dark <?= $segment2 == 'create' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('users'); ?>" class="nav-link text-dark <?= $segment1 == 'users' && $segment2 == '' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Users</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Groups -->
                <li class="nav-item has-treeview <?= $segment1 == 'groups' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link text-dark <?= $segment1 == 'groups' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Groups
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('groups/create'); ?>" class="nav-link text-dark <?= $segment2 == 'create' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Group</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('groups'); ?>" class="nav-link text-dark <?= $segment1 == 'groups' && $segment2 == '' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Groups</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Permissions -->
                <li class="nav-item has-treeview <?= $segment1 == 'permissions' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link text-dark <?= $segment1 == 'permissions' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-key"></i>
                        <p>
                            Permissions
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('permissions/create'); ?>" class="nav-link text-dark <?= $segment2 == 'create' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Permission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('permissions'); ?>" class="nav-link text-dark <?= $segment1 == 'permissions' && $segment2 == '' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Permissions</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Directorates -->
                <li class="nav-item has-treeview <?= $segment1 == 'directorates' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link text-dark <?= $segment1 == 'directorates' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Directorates
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('directorates/create'); ?>" class="nav-link text-dark <?= $segment2 == 'create' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Directorate</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('directorates'); ?>" class="nav-link text-dark <?= $segment1 == 'directorates' && $segment2 == '' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Directorates</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Offices -->
                <li class="nav-item has-treeview <?= $segment1 == 'offices' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link text-dark <?= $segment1 == 'offices' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Offices
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('offices/create'); ?>" class="nav-link text-dark <?= $segment2 == 'create' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Office</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('offices'); ?>" class="nav-link text-dark <?= $segment1 == 'offices' && $segment2 == '' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Offices</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- USER MANAGAMENT -->
                <li class="nav-item">
                    <a href="<?= base_url('settings'); ?>" class="nav-link text-dark">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Settings</p>
                    </a>
                </li>

                <!-- REPORTS -->
                <li class="nav-header text-dark">REPORTS</li>
                <li class="nav-item">
                    <a href="<?= base_url('sales-report'); ?>" class="nav-link text-dark">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>Sales Report</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('user-logs'); ?>" class="nav-link text-dark">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Activity Logs</p>
                    </a>
                </li>

                <!-- ACCOUNT -->
                <li class="nav-header text-dark">ACCOUNT</li>
                <li class="nav-item">
                    <a href="<?= base_url('profile'); ?>" class="nav-link text-dark">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('logout'); ?>" class="nav-link text-dark">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
