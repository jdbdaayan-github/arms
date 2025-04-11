<?= $this->extend("layouts/main"); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="mb-2 mb-md-0">Dashboard</h1>
                </div>
                <div>
                    <ol class="breadcrumb float-sm-right mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>

            <!-- Search + Upload Row -->
            <div class="row mt-3">
                <div class="col-md-8 col-sm-12 mb-2 mb-md-0">
                    <form action="#" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for records..." name="search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 col-sm-12 text-md-right text-sm-left">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadModal">
                        <i class="fas fa-upload"></i> Upload New Record
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Stats Cards -->
            <div class="row mt-3">
                <?php
                $cards = [
                    ['count' => 150, 'title' => 'Your Uploaded Records', 'icon' => 'fa-file-upload', 'color' => 'info', 'link' => '#', 'text' => 'View Your Records'],
                    ['count' => 20, 'title' => 'Pending Records', 'icon' => 'fa-clock', 'color' => 'warning', 'link' => '#', 'text' => 'View Pending Records'],
                    ['count' => 50, 'title' => 'Approved Records', 'icon' => 'fa-check-circle', 'color' => 'success', 'link' => '#', 'text' => 'View Approved Records'],
                    ['count' => 30, 'title' => 'Archived Records', 'icon' => 'fa-archive', 'color' => 'secondary', 'link' => '#', 'text' => 'View Archived Records'],
                ];
                foreach ($cards as $card): ?>
                    <div class="col-lg-3 col-12 mb-3">
                        <div class="small-box bg-<?= $card['color']; ?>">
                            <div class="inner">
                                <h3><?= $card['count']; ?></h3>
                                <p><?= $card['title']; ?></p>
                            </div>
                            <div class="icon">
                                <i class="fas <?= $card['icon']; ?>"></i>
                            </div>
                            <a href="<?= $card['link']; ?>" class="small-box-footer">
                                <?= $card['text']; ?> <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Recent Activities -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-secondary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-history"></i> Recent Activities</h3>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Uploaded Document: <strong>"Annual Report"</strong> <span class="float-right text-muted">5 minutes ago</span></li>
                                <li class="list-group-item">Edited Document: <strong>"Project Proposal"</strong> <span class="float-right text-muted">1 hour ago</span></li>
                                <li class="list-group-item">Uploaded Document: <strong>"Financial Summary"</strong> <span class="float-right text-muted">3 hours ago</span></li>
                                <li class="list-group-item">Archived Document: <strong>"Old Reports"</strong> <span class="float-right text-muted">Yesterday</span></li>
                                <li class="list-group-item">Approved Document: <strong>"Annual Budget"</strong> <span class="float-right text-muted">Yesterday</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Upload Modal -->
<?= view('pages/records/upload_modal') ?>
<?= $this->endSection(); ?>
