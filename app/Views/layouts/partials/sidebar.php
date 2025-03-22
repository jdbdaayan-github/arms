<!-- Sidebar -->
<aside class="main-sidebar sidebar-light border-end border-dark">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">AdminLTE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar border-right">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                <!-- MAIN NAVIGATION -->
                <li class="nav-header text-dark">MAIN NAVIGATION</li>
                <li class="nav-item">
                    <a href="<?= base_url('dashboard'); ?>" 
                       class="nav-link text-dark <?= service('request')->getUri()->getSegment(1) == 'dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Records Management -->
                <li class="nav-item has-treeview <?= service('request')->getUri()->getSegment(1) == 'records' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link text-dark <?= service('request')->getUri()->getSegment(1) == 'records' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Records Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('records/create'); ?>" 
                               class="nav-link text-dark <?= service('request')->getUri()->getSegment(2) == 'create' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Record</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('records/search'); ?>" 
                               class="nav-link text-dark <?= service('request')->getUri()->getSegment(2) == 'search' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Advanced Search</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- ADMINISTRATION -->
                <li class="nav-header text-dark">ADMINISTRATION</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link text-dark">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            User Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('users'); ?>" class="nav-link text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('roles'); ?>" class="nav-link text-dark">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles & Permissions</p>
                            </a>
                        </li>
                    </ul>
                </li>

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
