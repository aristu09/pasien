<?php $this->load->view('template/header'); ?>

<?php 
if($aksi == "riwayat"):
?>

<?= $this->session->flashdata('pesan') ?>

<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
    <thead>
            <tr>
                <th>No</th>
                <th>No Rekam Medis</th>
                <th>Nama</th>
                <th>Tgl Periksa</th>
                <th>Status</th>
                <th>Detail Data</th>
                <th>Barcode</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data as $antrian): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $antrian['id_pasien'] ?></td>
                <td><?= $antrian['nama'] ?></td>
                <td><?= tgl_indo($antrian['tgl_periksa']) ?></td>
                <td>
                    <?php $stt = $antrian['status']  ?>
					    <?php if($stt == 'PV'){ ?>
					    <span class="label label-warning">Perlu Verifikasi</span>
							<?php }elseif($stt == 'BTL'){ ?>
							<span class="label label-danger">Batal Periksa</span>
                                <?php }elseif($stt == 'ANTRI'){ ?>
                                <span class="label label-info">Menunggu Antrian</span>
                                    <?php }elseif($stt == 'S'){ ?>
                                    <span class="label label-success">Sudah Periksa</span>
                    <?php } ?>
                </td>
                <td>
                <a href="" class="btn btn-default" data-toggle="modal" data-target="#detail<?= $antrian['id_antrian'] ?>" title="Detail Data"><i class="fa fa-eye"> Detail</i></a>
                </td>
                <td>
                    <?php if ($antrian['status'] == 'PV'): ?>
                        <img src="<?php echo base_url('pasien/verifikasi/QRcode/'.$antrian['uuid']) ?>" style="width: 100px;">
                        <a href="<?php echo base_url('pasien/verifikasi/QRcode/'.$antrian['uuid']) ?>" class="btn btn-default" title="Download QRcode" download name_file="<?= $antrian['nama'] ?>"><i class="fa fa-download"> Download</i></a>
                        <?php else: ?>
                           
                    <?php endif; ?>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

    <!-- tabel modal -->
    <?php foreach($data as $antrian): ?>
    <!-- membuat menu detail data dengan modal -->
    <div class="modal fade" id="detail<?= $antrian['id_antrian'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Detail <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td class="col-md-3">No Rekam Medis</td>
                            <td><?= $antrian['id_pasien'] ?></td>
                        </tr>
                        <tr>
                            <td class="col-md-3">Nama</nama>
                            <td><?= $antrian['nama'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama Suami</td>
                            <td><?= $antrian['nama_suami'] ?></td>
                        </tr>
                        <tr>
                            <td>Keluhan</td>
                            <td>
                                <textarea name="" class="form-control" readonly="" rows="5"><?= $antrian['keluhan'] ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Mens Terakhir</td>
                            <td><?= $antrian['mens_terakhir'] ?></td>
                        </tr>
                        <tr>
                            <td>Tgl Periksa</td>
                            <td><?= tgl_indo($antrian['tgl_periksa']) ?></td>
                        </tr>
                        <?php if ($antrian['catatan'] == ''): ?>

                        <?php else: ?>
                        <tr>
                            <td>Catatan dari dokter</td>
                            <td>
                                <textarea name="" class="form-control" readonly="" rows="5"><?= $antrian['catatan'] ?></textarea>
                            </td>
                        </tr>
                        <?php endif; ?>

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal detail -->
    <?php endforeach; ?>

    <?php 
    elseif($aksi == "buat_jadwal"):
    ?>

    <?php if($akses == 'Buka'): ?>
    <!--tambah data antrian-->
                    <table class="table table-bordered table-striped">
                        <form id="add" method="post">
                            <tr>
                                <th>No Rekam Medis</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="" class="form-control" value="<?= $id_pasien ?>" readonly="">
                                </td>
                            </tr>
                            <tr>
                                <th>Keluhan</th>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="keluhan" class="form-control" required="" rows="5" autocomplete="off"
                                        placeholder="Keluhan"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th>Mens Terakhir</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="mens_terakhir" class="form-control" value="<?= date('Y-m-d') ?>" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Pilih Tanggal Periksa</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="tgl_periksa" id="tanggal" class="form-control" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" max="<?= date('Y-m-d', strtotime('+6 day')) ?>" value="<?= date('Y-m-d') ?>" required="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="<?= site_url('pasien/home') ?>" class="btn btn-primary"> Batal</a> &nbsp; &nbsp;
                                    <input type="submit" name="kirim" value="Submit" class="btn btn-success">
                                </td>
                            </tr>
                        </form>
                    </table>
    <!-- End -->

    <script>
        
         //add data
    $(document).ready(function() {
        $('#add').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('pasien/periksa/api_add_periksa') ?>",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    $('#modalTambahAntrian');
                    $('#add')[0].reset();
                    swal({
                        title: "Berhasil",
                        text: "Berhasil membuat jadwal periksa",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE",
                    }).then(function() {
                        window.location.href = "<?= site_url('pasien/home') ?>";
                    });
                }
            });
        });
    });
    </script>
    <?php elseif($akses == 'Tutup'): ?>
        <div class="alert alert-info">
        <strong>Maaf, anda tidak bisa membuat jadwal periksa baru karena pendafataran sudah ditutup</strong>
    </div>
    <?php endif; ?>
    <?php endif; ?>
        

    <?php $this->load->view('template/footer'); ?>

    <?php 

function hitung_usia($tanggal_lahir){
    list($year,$month,$day) = explode("-",$tanggal_lahir);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($month_diff < 0) {
        $year_diff--;
    } elseif (($month_diff==0) && ($day_diff < 0)) {
        $year_diff--;
    }
    return $year_diff;
}
 
//format hanya menampilkan tanggal bulan dan tahun
function tgl_indo($tanggal){
  $tgl = substr($tanggal, 8, 2);
    $bln = array (
        1 =>   'Januari',
        2 =>   'Februari',
        3 =>   'Maret',
        4 =>   'April',
        5 =>   'Mei',
        6 =>   'Juni',
        7 =>   'Juli',
        8 =>   'Agustus',
        9 =>   'September',
        10 =>   'Oktober',
        11 =>   'November',
        12 =>   'Desember'
    );
    $bulan = $bln[(int)substr($tanggal, 5, 2)];
    $tahun = substr($tanggal, 0, 4);
    return $tgl.' '.$bulan.' '.$tahun;
}

?>