<?php $this->load->view('template/header'); ?>

<?php
 if($this->session->userdata('level') == "Pasien" ){

 ?>
<?= $this->session->flashdata('pesan'); ?>

<div id="target-div">
<?php if ($status == 'PV' && $tgl_periksa >= date('Y-m-d')): ?>
                    <div class="col-lg-12 col-xs-12">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner text-center">
                            <!-- <img src="<?php echo base_url('pasien/verifikasi/QRcode/'.$uuid) ?>" style="width: 150px"> -->
                            <p>Tunjukkan QR Code ini ke resepsionis untuk verifikasi saat kamu datang ke klinik</p>
                            <a href="<?php echo base_url('pasien/verifikasi/QRcode/'.$uuid) ?>" class="btn btn-default" title="Buka QRcode" target="_blank"><i class="fa fa-qrcode"></i> Buka QRcode</a>
                            </div>
                        </div>
                    </div>
    <?php else: ?>
<?php endif; ?>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange">
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

    <?php if ($tgl_periksa == null || $tgl_periksa < date('Y-m-d')): ?>
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box box-primary">
                <div class="box-header with-border">

                    <a href="<?= base_url('pasien/periksa/buat_jadwal') ?>" class="btn btn-warning"><i class="fa fa-plus"></i>
                        Daftar Periksa Sekarang !</a>

                    <div class="box-body">
                        <div class="alert alert-info">
                            <h4><i class="icon fa fa-warning"></i> Perhatian !</h4>
                            Kamu belum membuat antrian baru, silahkan klik tombol Daftar Periksa untuk membuat antrian
                            baru
                        </div>
                    </div>
                    
            <table id="example" class="table ">
                <thead>
                    <tr>
                        <th class="col-md-2">Jadwal Pendaftaran</th>
                        <th class="col-md-2">Hari Praktek</th>
                        <th class="col-md-2">Jam Buka</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $jdwl_pendaftaran ?></td>
                        <td><?= $jdwl_praktek ?></td>
                        <td><?= $jam_praktek ?> WIB</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <?php elseif ($tgl_periksa > date('Y-m-d')): ?>
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-calendar"></i>
                    <b style="font-size: 12pt">
                        Tgl Periksa Kamu : <?= tgl_indo($tgl_periksa) ?>
                        <a href="<?= base_url('pasien/periksa/riwayat') ?>" class="btn btn-primary"><i class="fa fa-history"></i>
                            Data Periksa Kamu</a>
                    </b> <br>
                    <p>Tunjukkan QR Code ini ke resepsionis untuk verifikasi saat kamu datang ke klinik</p>
                    <a href="<?php echo base_url('pasien/verifikasi/QRcode/'.$uuid) ?>" class="btn btn-default" title="Buka QRcode" target="_blank"><i class="fa fa-qrcode"></i> Buka QRcode</a>
                    <?php else: ?>
                    <div class="col-lg-4 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <?php if ($pasien == null): ?>
                                <h4>Sedang mempersiapkan antrian..</h4>
                                <?php else: ?>
                                <?php foreach($pasien as $psn): ?>
                                    <?php if ($this->session->userdata['id_pasien'] == $psn['id_pasien']): ?>
                                        <h3><?= $psn['nama']; ?></h3>
                                    <?php else: ?>
                                        <h3><?= $psn['id_pasien']; ?></h3>
                                    <?php endif; ?>
                                <p>Pasien sedang diperiksa</p>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="icon">
                                <i class="fa fa-stethoscope"></i>
                            </div>
                            <a href="#" class="small-box-footer">Informasi antrian <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                

                    <div class="col-xs-12">
                        <div class="box box-default">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <i class="fa fa-calendar"></i>
                                    <b style="font-size: 12pt">
                                        Tgl Periksa Kamu : <?= tgl_indo($tgl_periksa) ?>
                                    </b>
                                    <div class="table">
                                        <table id="example" class="table table-bordered  table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="col-md-1">No Antrian</th>
                                                    <th class="col-md-2">Kode Antrian</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no=1; foreach($antrian_p as $antrian): ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <?php if ($this->session->userdata['id_pasien'] == $antrian['id_pasien']): ?>
                                                        <td><?= $antrian['nama'] ?></td>
                                                    <?php else: ?>
                                                        <td><?= $antrian['id_pasien'] ?></td>
                                                    <?php endif; ?>
                                                    <td>
                                                        <?php $stt = $antrian['status']  ?>
                                                        <?php if($stt == 'PV'){ ?>
                                                        <span class="label label-warning">Menunggu Verifikasi</span>
                                                        <?php }elseif($stt == 'BTL'){ ?>
                                                        <span class="label label-danger">Batal Periksa</span>
                                                        <?php }elseif($stt == 'ANTRI'){ ?>
                                                        <span class="label label-info">Menunggu Antrian</span>
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
                                            <tr>
                                <th></th>
                                <th class="text-right">
                                    Kamu harus datang ke klinik :
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
                                        round($menit, 2);
                                        //membulatkan waktu rata-rata keatas sehingga pasien tidak datang terlalu cepat
                                        echo ceil($menit) + 5;


                                    }
                                    ?> menit sebelum waktu antrian kamu
                                <?php endif; ?>
                                </th>
                                </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                                    </div>
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
                                    </script>
                                    <script>
                                    $(document).ready(function() {
                                        setInterval(function() {
                                            $("#target-div").load(location.href + " #target-div>*", "");
                                        }, 1000);
                                    });
                                    </script>
                                    <?php $this->load->view('template/footer'); ?>
                                    <?php $this->load->view('template/akses'); ?>
                                    <?php } ?>

                                    <?php 

//membuat shortname
function shortname($name){
	$short = explode(" ", $name);
	$shortname = $short[0];
	return $shortname;
}
 
//menampilkan nama hari dan bulan dalam bahasa indonesia
function tgl_indo($tanggal){
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $hari = array (
        1 =>    'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );
    $num = date('N', strtotime($tanggal));
    $tgl = date('j', strtotime($tanggal));
    $bulan = $bulan[date('n', strtotime($tanggal))];
    $tahun = date('Y', strtotime($tanggal));
    return $hari[$num].', '.$tgl.' '.$bulan.' '.$tahun;
}

?>