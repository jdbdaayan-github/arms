<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
My Profile
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">My Profile</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">

        <!-- Single Profile Card -->
        <div class="card card-outline card-primary">
            <div class="card-body d-flex">

                <!-- Left: Styled Profile Picture Section -->
                <div class="col-md-4 d-flex flex-column align-items-center justify-content-center bg-info"
                     style="color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                    <img src="<?= base_url('assets/template/dist/img/user2-160x160.jpg') ?>" 
                         alt="Profile Picture" 
                         class="img-fluid img-thumbnail mb-3"
                         style="max-width: 150px; max-height: 150px; border-radius: 50%;">
                    <h4 class="mb-1"><?= esc(implode(' ', array_filter([$user->firstname, $user->middlename, $user->lastname, $user->extension]))) ?></h4>
                    <p class="text-light mb-0"><i class="fas fa-user-shield mr-1"></i><?= esc(session()->get('role')) ?></p>
                </div>

                <!-- Right: Info divided horizontally -->
                <div class="col-md-8 d-flex flex-column ml-3">
                    
                    <!-- Top: Optional additional info or stats -->
                    <div class="mb-3 p-3 bg-light border rounded">
                        <h5 class="mb-1">Profile Overview</h5>
                        <p class="text-muted mb-0">User account details and personal information.</p>
                    </div>

                    <!-- Bottom: Profile Details Table -->
                    <div class="flex-grow-1 p-3 border rounded">
                        <table class="table table-bordered table-striped table-sm mb-0">
                            <tbody>
                                <tr>
                                    <th style="width: 150px;"><i class="fas fa-user mr-1"></i> First Name</th>
                                    <td><?= esc($user->firstname)?></td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-user-alt mr-1"></i> Middle Name</th>
                                    <td><?= esc($user->middlename??'-')?></td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-user mr-1"></i> Last Name</th>
                                    <td><?= esc($user->lastname)?></td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-sort-alpha-down mr-1"></i> Extension</th>
                                    <td><?= esc($user->extension??'-')?></td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-envelope mr-1"></i> Email</th>
                                    <td><?= esc($user->email)?></td>
                                </tr>
                                <tr>
                                    <th><i class="fas fa-calendar-alt mr-1"></i> Date Joined</th>
                                    <td><?= esc(date('F j, Y', strtotime($user->created_at))) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
<?= $this->endSection() ?>
