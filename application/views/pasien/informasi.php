<?php $this->load->view('template/header'); ?>

<?= $this->session->flashdata('pesan') ?>
<?php $no=1; foreach($data->result_array() as $informasi): ?>
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><b><?= $informasi['title'] ?></b></h3>
                </div>
            </div>
            <div class="box-body">
                <?= $informasi['informasi'] ?>
            </div>
                <?php if ($informasi['file_informasi'] == null): ?>
                <?php else: ?>
                    <img src="<?= base_url('./themes/file_informasi/') . $informasi['file_informasi'] ?>" alt="" width="50%" height="50%" style="object-fit: cover; object-position: center; border-radius: 10px;">
                <?php endif; ?>           
        </div>
    </div>
<?php $no++; endforeach; ?>

<?php $this->load->view('template/footer'); ?>