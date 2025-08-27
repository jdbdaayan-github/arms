<?= $this->extend('layouts/guest') ?>

<?= $this->section('content') ?>
<div class="terms-content">
    <h2 class="mb-3 text-center">Terms and Conditions</h2>

    <p>Welcome to ARMS. By using our service, you agree to the following terms and conditions. Please read carefully.</p>

    <h4>1. Acceptance of Terms</h4>
    <p>By accessing or using ARMS, you agree to comply with these terms and conditions. If you do not agree, please do not use the service.</p>

    <h4>2. User Accounts</h4>
    <p>You are responsible for maintaining the confidentiality of your account credentials and for all activities under your account.</p>

    <h4>3. Use of Services</h4>
    <p>You agree to use the services only for lawful purposes and not to engage in any activity that may harm, disrupt, or interfere with the system or other users.</p>

    <h4>4. Privacy</h4>
    <p>Your data is managed according to our privacy policy. By using the service, you consent to the collection and use of your data as described in the privacy policy.</p>

    <h4>5. Limitation of Liability</h4>
    <p>ARMS shall not be liable for any direct, indirect, incidental, or consequential damages arising from your use of the service.</p>

    <h4>6. Changes to Terms</h4>
    <p>We may update these terms at any time. Continued use of the service constitutes acceptance of the updated terms.</p>

    <p class="mt-4 text-center">
        <a href="<?= base_url('register') ?>" class="btn btn-primary btn-sm">Accept and Register</a>
    </p>
</div>
<?= $this->endSection() ?>
