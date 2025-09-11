<?php
$uri = service('uri');
$segments = $uri->getSegments();
$segment1 = $segments[0] ?? '';
$segment2 = $segments[1] ?? '';

// Helper functions
function isActive($segment1Expected, $segment2Expected = null)
{
    $uri = service('uri');
    $segments = $uri->getSegments();
    $segment1 = $segments[0] ?? '';
    $segment2 = $segments[1] ?? '';

    if ($segment2Expected !== null) {
        return ($segment1 === $segment1Expected && $segment2 === $segment2Expected) ? 'active' : '';
    }

    return ($segment1 === $segment1Expected) ? 'active' : '';
}

function isMenuOpen($segment1Expected)
{
    $uri = service('uri');
    $segments = $uri->getSegments();
    $segment1 = $segments[0] ?? '';
    return ($segment1 === $segment1Expected) ? 'menu-open' : '';
}
?>

<aside class="main-sidebar sidebar-dark-info elevation-1 sidebar-no-expand">
    <a href="<?= base_url('dashboard') ?>" class="brand-link">
        <img src="<?= base_url('assets/template/dist/img/AdminLTELogo.png') ?>"
            alt="ARMS Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">ARMS</span>
    </a>

    <div class="sidebar">
        <!-- Sidebar Search -->
        <div class="form-inline mt-2 mb-2">
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
        <nav class="mt-0">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- MAIN NAVIGATION -->
                <li class="nav-header">MAIN NAVIGATION</li>

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link <?= isActive('dashboard') ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Records -->
                <li class="nav-item has-treeview <?= isMenuOpen('records') ?>">
                    <a href="#" class="nav-link <?= isActive('records') ?>">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                            Records
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('records') ?>" class="nav-link <?= isActive('records', '') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <!-- records.create permission -->
                    <?php if( hasRole('Superadmin') || hasPermission('records.create')): ?>
                        <li class="nav-item">
                            <a href="<?= base_url('records/create') ?>" class="nav-link <?= isActive('records', 'create') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                        <?php endif ?>
                    </ul>
                </li>



                <!-- ADMINISTRATION -->
                <li class="nav-header">ADMINISTRATION</li>
                <!-- Users -->
                <li class="nav-item has-treeview <?= isMenuOpen('users') ?>">
                    <a href="#" class="nav-link <?= isActive('users') ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('users') ?>" class="nav-link <?= isActive('users', '') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('users/create') ?>" class="nav-link <?= isActive('users', 'create') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Roles -->
                <li class="nav-item has-treeview <?= isMenuOpen('roles') ?>">
                    <a href="#" class="nav-link <?= isActive('roles') ?>">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>
                            Roles
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('roles') ?>" class="nav-link <?= isActive('roles', '') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('roles/create') ?>" class="nav-link <?= isActive('roles', 'create') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Permissions -->
                <li class="nav-item has-treeview <?= isMenuOpen('permissions') ?>">
                    <a href="#" class="nav-link <?= isActive('permissions') ?>">
                        <i class="nav-icon fas fa-key"></i>
                        <p>
                            Permissions
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('permissions') ?>" class="nav-link <?= isActive('permissions', '') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('permissions/create') ?>" class="nav-link <?= isActive('permissions', 'create') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- LIBRARIES -->
                <li class="nav-header">LIBRARIES</li>

                <!-- Classifications -->
                <li class="nav-item has-treeview <?= isMenuOpen('classifications') ?>">
                    <a href="#" class="nav-link <?= isActive('classifications') ?>">
                        <i class="fas fa-folder-open nav-icon"></i>
                        <p>
                            Classifications
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('classifications') ?>" class="nav-link <?= isActive('classifications', '') ?>">
                                <i class="far fa-circle  nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('classifications/create') ?>" class="nav-link <?= isActive('classifications', 'create') ?>">
                                <i class="far fa-circle  nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Series Title -->
                <li class="nav-item has-treeview <?= isMenuOpen('series') ?>">
                    <a href="#" class="nav-link <?= isActive('series') ?>">
                        <i class="fas fa-book nav-icon"></i>
                        <p>
                            Series Title
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('series') ?>" class="nav-link <?= isActive('series', '') ?>">
                                <i class="far fa-circle  nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('series/create') ?>" class="nav-link <?= isActive('series', 'create') ?>">
                                <i class="far fa-circle  nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Indexes -->
                <li class="nav-item has-treeview <?= isMenuOpen('indexes') ?>">
                    <a href="#" class="nav-link <?= isActive('indexes') ?>">
                        <i class="fas fa-list nav-icon"></i>
                        <p>
                            Indexes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('indexes') ?>" class="nav-link <?= isActive('indexes', '') ?>">
                                <i class="far fa-circle  nav-icon"></i>
                                <p>List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('indexes/create') ?>" class="nav-link <?= isActive('indexes', 'create') ?>">
                                <i class="far fa-circle  nav-icon"></i>
                                <p>Create</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- LOGS -->
                <li class="nav-header">LOGS</li>

                <!-- Logs -->
                <li class="nav-item has-treeview <?= isMenuOpen('logs') ?>">
                    <a href="#" class="nav-link <?= isActive('logs') ?>">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            Logs
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('logs/audit') ?>" class="nav-link <?= isActive('logs', 'audit') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Audit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('logs/access') ?>" class="nav-link <?= isActive('logs', 'access') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Access</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Settings -->
                <li class="nav-item has-treeview <?= isMenuOpen('settings') ?>">
                    <a href="#" class="nav-link <?= isActive('settings') ?>">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('settings/profile') ?>" class="nav-link <?= isActive('settings', 'profile') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('settings/preferences') ?>" class="nav-link <?= isActive('settings', 'preferences') ?>">
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