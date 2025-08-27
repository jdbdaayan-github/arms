<?php
$uri = service('uri');
$segments = $uri->getSegments();
$segment1 = $segments[0] ?? '';
$segment2 = $segments[1] ?? '';
?>

<aside class="main-sidebar sidebar-dark-primary elevation-1">
    <a href="<?= base_url('dashboard') ?>" class="brand-link">
        <img src="<?= base_url('assets/template/dist/img/AdminLTELogo.png') ?>" 
             alt="ARMS Logo" 
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">ARMS</span>
    </a>

    <div class="sidebar">
        <!-- Sidebar Search -->
        <div class="form-inline mt-2 mb-3">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- MAIN NAVIGATION -->
                <li class="nav-header">MAIN NAVIGATION</li>

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link <?= $segment1 === 'dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Records with sub-menu -->
                <li class="nav-item has-treeview <?= $segment1 === 'records' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= $segment1 === 'records' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Records
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('records') ?>" class="nav-link <?= $segment2 === '' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('records/create') ?>" class="nav-link <?= $segment2 === 'create' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Users with sub-menu -->
                <li class="nav-item has-treeview <?= $segment1 === 'users' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= $segment1 === 'users' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('users') ?>" class="nav-link <?= $segment2 === '' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('users/create') ?>" class="nav-link <?= $segment2 === 'create' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- ADMINISTRATION -->
                <li class="nav-header">ADMINISTRATION</li>

                <!-- Roles -->
                <li class="nav-item has-treeview <?= $segment1 === 'roles' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= $segment1 === 'roles' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>
                            Roles
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('roles') ?>" class="nav-link <?= $segment2 === '' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('roles/create') ?>" class="nav-link <?= $segment2 === 'create' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Permissions -->
                <li class="nav-item has-treeview <?= $segment1 === 'permissions' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= $segment1 === 'permissions' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-key"></i>
                        <p>
                            Permissions
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('permissions') ?>" class="nav-link <?= $segment2 === '' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('permissions/create') ?>" class="nav-link <?= $segment2 === 'create' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Classifications -->
                <li class="nav-item has-treeview <?= $segment1 === 'classifications' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= $segment1 === 'classifications' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                            Classifications
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('classifications') ?>" class="nav-link <?= $segment2 === '' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('classifications/create') ?>" class="nav-link <?= $segment2 === 'create' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Document Types -->
                <li class="nav-item has-treeview <?= $segment1 === 'document-types' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= $segment1 === 'document-types' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Document Types
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('document-types') ?>" class="nav-link <?= $segment2 === '' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('document-types/create') ?>" class="nav-link <?= $segment2 === 'create' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Logs -->
                <li class="nav-item has-treeview <?= $segment1 === 'logs' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= $segment1 === 'logs' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            Logs
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('logs/audit') ?>" class="nav-link <?= $segment2 === 'audit' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Audit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('logs/access') ?>" class="nav-link <?= $segment2 === 'access' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Access</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Settings -->
                <li class="nav-item has-treeview <?= $segment1 === 'settings' ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= $segment1 === 'settings' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('settings/profile') ?>" class="nav-link <?= $segment2 === 'profile' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('settings/preferences') ?>" class="nav-link <?= $segment2 === 'preferences' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Preferences</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>
