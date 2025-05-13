<?php //$this->load->view('templates/header'); 
?>

<div class="container">
    <h2>Database Backups</h2>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Filename</th>
                <th>Size</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($backups as $backup): ?>
                <tr>
                    <td><?= $backup['name'] ?></td>
                    <td><?= round($backup['size'] / 1024, 2) ?> KB</td>
                    <td><?= $backup['date'] ?></td>
                    <td>
                        <a href="<?= site_url('databasebackup/download/' . $backup['name']) ?>" class="btn btn-sm btn-success">Download</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php //$this->load->view('templates/footer'); 
?>