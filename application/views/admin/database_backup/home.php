<div class="container">
    <h2>Database Backups</h2>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>
    <div style="text-align: center;">
        <a href="<?= site_url(ADMIN_DIR . 'database_backup/backup') ?>" class="btn btn-danger">Download Backup</a>
    </div>
</div>