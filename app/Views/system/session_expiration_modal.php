<!-- Session Expired Modal -->
<div class="modal fade" id="sessionExpiredModal" tabindex="-1" role="dialog" aria-labelledby="sessionExpiredModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog" role="document">
    <div class="modal-content border border-info shadow-lg">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="sessionExpiredModalLabel">
          <i class="fas fa-exclamation-triangle mr-2"></i> Session Expired
        </h5>
      </div>
      <div class="modal-body text-dark">
        For your security, your session has expired due to inactivity.<br>
        Please log in again to continue.
      </div>
      <div class="modal-footer justify-content-end">
        <a href="<?= base_url('/') ?>" class="btn btn-info">
          <i class="fas fa-sign-in-alt"></i> Go to Login
        </a>
      </div>
    </div>
  </div>
</div>
