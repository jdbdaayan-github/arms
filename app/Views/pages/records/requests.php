<?= $this->extend('layouts/app'); ?>

<?= $this->section('content-header') ?>
Records
<?= $this->endSection() ?>

<?= $this->section('content-breadcrumbs') ?>
<li class="breadcrumb-item active">Record Transactions</li>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-outline card-secondary">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title"><i class="fas fa-exchange-alt mr-2"></i>Record Transactions</h3>
            </div>

            <div class="card-body">
                <!-- Search + Per Page -->
                <form method="get" class="mb-2 d-flex justify-content-between">
                    <select name="per_page" class="form-control form-control-sm mr-2" style="width:55px;">
                        <?php foreach ([5, 10, 25, 50] as $num): ?>
                            <option value="<?= $num ?>"><?= $num ?></option>
                        <?php endforeach; ?>
                    </select>

                    <div class="input-group input-group-sm" style="max-width: 300px;">
                        <input type="text" class="form-control" placeholder="Search Title...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm mb-1">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Record Title</th>
                                <th>Requested By</th>
                                <th>Request Date</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($requests)): ?>
                            <?php foreach($requests as $request): ?>
                            <tr>
                                <td class="text-center">1</td>
                                <td><?= esc($request->title) ?></td>
                                <td><?= esc($request->fullname) ?></td>
                                <td><?= esc(date("F j, Y, g:i a",strtotime($request->created_at))) ?></td>
                                <td><?= esc($request->status) ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('request/view/').$request->id ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="View"><i class="fas fa-eye"></i></a>
                                    <button class="btn btn-primary btn-sm return-btn" data-toggle="tooltip" data-placement="top" title="Approve">
                                        <i class="fas fa-thumbs-up"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm return-btn" data-toggle="tooltip" data-placement="top" title="Disapprove">
                                        <i class="fas fa-thumbs-down"></i>
                                    </button>
                                    <button class="btn btn-success btn-sm return-btn" data-toggle="tooltip" data-placement="top" title="Done">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm return-btn" data-toggle="tooltip" data-placement="top" title="Cancel">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No requests found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>


                <!-- Pagination Info -->
                <div class="d-flex justify-content-between align-items-center text-sm mt-2">
                    <div>Showing 1 to 5 of 5 results</div>
                    <div>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#">»</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(function () {
        // Attach SweetAlert only to action buttons (Approve, Done, Deny, Cancel)
        $('.return-btn').on('click', function (e) {
            e.preventDefault();

            let action = $(this).attr('title'); // "Approve", "Done", "Deny", "Cancel"

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to " + action + " this record?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, ' + action + ' it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        action + 'd!',
                        'The record has been ' + action.toLowerCase() + 'd.',
                        'success'
                    )
                    
                    // 👉 TODO: Add AJAX or form submission here if you want
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>
