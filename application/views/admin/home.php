<?php $this->load->view('template/header'); ?>

<?php
  $kode_tahun = date('Y');
 ?>

<div class="container"><?= $this->session->flashdata('pesan'); ?></div>

<div id="target-div">
<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h3><?= $count_periksa ?></h3>
            <p>Jumlah antrian hari ini</p>
        </div>
        <div class="icon">
            <i class="fa fa-exchange"></i>
        </div>
        <a href="#" class="small-box-footer">Informasi antrian <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-md-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-primary">
        <div class="inner">
        <?php if ($pasien == null): ?>
            <h4>Sedang mempersiapkan antrian..</h4>
        <?php else: ?>
        <?php foreach($pasien as $psn): ?>
            <h3><?= $psn['nama']; ?></h3>
            <p>Pasien sedang diperiksa</p>
        <?php endforeach; ?>
        <?php endif; ?>
        </div>
        <div class="icon">
            <i class="fa fa-stethoscope"></i>
        </div>
        <a href="#" class="small-box-footer">Informasi antrian <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-md-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $dokter;?></h3>

              <p>Data Dokter</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-md"></i>
            </div>
            <a href="<?= base_url('admin/dokter');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-md-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $admin;?></h3>

              <p>Data Admin</p>
            </div>
            <div class="icon">
             <i class="fa fa-user"></i>
            </div>
            <a href="<?= base_url('admin/user_admin');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

<div class="col-xs-12">
        <div class="box box-default">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-calendar"></i>
                        <b style="font-size: 12pt">                            
                                Daftar Antrian Pasien Hari Ini
                        </b>                   
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered  table-striped">
                            <thead>
                                <tr>
                                    <th class="col-md-1">No Antrian</th>
                                    <th class="col-lg-2">Nama Pasien</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach($antrian_p as $antrian): ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $antrian['nama'] ?></td>
                                    <td>
                                        <?php $stt = $antrian['status']  ?>
                                            <?php if($stt == 'PV'){ ?>
                                            <span class="label label-warning">Menunggu Verifikasi</span>
                                                <?php }elseif($stt == 'BTL'){ ?>
                                                <span class="label label-danger">Batal Periksa</span>
                                                    <?php }elseif($stt == 'ANTRI'){ ?>
                                                    <span class="label label-info">Dalam Antrian</span>
                                                        <?php }elseif($stt == 'DIPERIKSA'){ ?>
                                                        <span class="label label-primary">Sedang Diperiksa</span>
                                                            <?php }elseif($stt == 'S'){ ?>
                                                            <span class="label label-success">Sudah Periksa</span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php $no++; endforeach; ?>
                            </tbody>
                                <tr>
                                <th></th>
                                <th class="text-right">
                                    Rata-rata lama antrian :
                                </th>
                                <th>
                                <?php 
                                    $total = 0;
                                    $data = $lama_antrian;
                                    if ($data->num_rows() == 0): ?>
                                    0 menit

                                    <!-- menghitung menghitung selisih waktu_proses awal dan waktu_proses akhir -->
                                    <?php else:
                                    {          
                                        $waktu_awal = $data->row()->waktu_keluar;
                                        $waktu_akhir = $data->last_row()->waktu_keluar;
                                        $selisih = strtotime($waktu_akhir) - strtotime($waktu_awal);
                                        $rata_rata = $selisih / $data->num_rows();
                                        //mengkonversi h:i:s ke menit
                                        $total = $rata_rata;
                                        $menit = $total / 60;
                                        echo round($menit, 2);
                                        }
                                    ?> menit
                                <?php endif; ?>                                    
                                </th>
                                </tr>
                        </table>
                    </div>  
                </div>
            </div>
        </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
		$(document).ready(function() {
			setInterval(function() {
				$("#target-div").load(location.href + " #target-div>*", "");
			}, 1000);
		});
	</script>

<?php $this->load->view('template/footer'); ?>