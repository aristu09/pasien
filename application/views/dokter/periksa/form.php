<?php $this->load->view('template/header'); ?>

<?php 
if($aksi == "antrian"):
?>
<?php if($depan == TRUE): ?>
    <?= $this->session->flashdata('pesan') ?>
    <table class="table table-striped">
        <form action="" method="POST">
            <tr>
                <th class="col-md-2">Pilih Tanggal</th>
                <td>
                    <input type="date" name="tgl" class="form-control" value="<?= date("Y-m-d") ?>">
                </td>
            <tr>
                <th></th>
                <td>
                    <input type="submit" name="cari" value="Buka Antrian" class="btn btn-success">
                </td>
            </tr>
        </form>
    </table>

    <?php elseif($depan == FALSE): ?>
        
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
                <th>Aksi</th>
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
                                <span class="label label-info">Dalam Antrian</span>
                                    <?php }elseif($stt == 'DIPERIKSA'){ ?>
                                    <span class="label label-primary">Sedang Diperiksa</span>
                                        <?php }elseif($stt == 'S'){ ?>
                                        <span class="label label-success">Sudah Periksa</span>
                    <?php } ?>
                </td>
                <td>
                <a href="" class="btn btn-default" data-toggle="modal" data-target="#detail<?= $antrian['id_antrian'] ?>" title="Detail Data"><i class="fa fa-eye"></i></a>
                </td>
                <td>
                    <?php $stt = $antrian['status']  ?>
                        <?php if($stt == 'ANTRI'){ ?>
                        <span class=""> </span>
                            <?php }elseif($stt == 'DIPERIKSA'){ ?>
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $antrian['id_antrian'] ?>" title="Update Data"><i class="fa fa-check-square-o"></i></a>
                    <?php } ?>
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
                            <td class="col-md-3">No Rekam Medis</nama>
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
                            <td>Mens Terakhir</td>
                            <td><?= $antrian['mens_terakhir'] ?></td>
                        </tr>
                        <tr>
                            <td>Keluhan</td>
                            <td><?= $antrian['keluhan'] ?></td>
                        </tr>
                        <tr>
                            <td>Tgl Periksa</td>
                            <td><?= tgl_indo($antrian['tgl_periksa']) ?></td>
                        </tr>
                        <tr>
                            <td>Catatan Dokter</td>
                            <td><?= $antrian['catatan'] ?></td>
                        </tr>

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

    <!-- Modal update antrian-->
    <?php foreach($data as $antrian): ?>
        <div class="modal fade" id="edit<?= $antrian['id_antrian'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Konfirmasi <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form id="edit" method="post">
                            <tr>
                                <th>Nama</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="hidden" name="id_antrian" value="<?= $antrian['id_antrian'] ?>">
                                    <input type="text" name="" class="form-control" required="" value="<?= $antrian['nama'] ?>" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>Catatan</th>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="catatan" class="form-control" required="" rows="5" autocomplete="off"
                                        placeholder="Tulis catatan untuk pasien"></textarea>
                                </td>
                            </tr>
                
                            <tr>
                                <td>
                                    <button href="" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Submit" class="btn btn-success">
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <!-- End Modal -->


    <script>
        //edit periksa
        $(document).on('submit', '#edit', function(e) {
            e.preventDefault();
            var form_data = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('dokter/periksa/sudah_periksa/') ?>" + form_data.get('id_antrian'),
                dataType: "json",
                data: form_data,
                processData: false,
                contentType: false,
                //memanggil swall ketika berhasil
                success: function(data) {
                    $('#edit' + form_data.get('id_antrian'));
                    swal({
                        title: "Berhasil",
                        text: "Data Berhasil Disimpan",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE",
                    }).then(function() {
                        location.reload();
                    });
                },
                //memanggil swall ketika gagal
                error: function(data) {
                    swal({
                        title: "Gagal",
                        text: "Data Gagal Disimpan",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE",
                    }).then(function() {
                        location.reload();
                    });
                }
            });
        });

    </script>

    <?php endif; ?>
    
    <?php 
    elseif($aksi == "sudah"):
    ?>
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
                                <span class="label label-info">Dalam Antrian</span>
                                    <?php }elseif($stt == 'S'){ ?>
                                    <span class="label label-success">Sudah Periksa</span>
                    <?php } ?>
                </td>
                <td>
                <a href="" class="btn btn-default" data-toggle="modal" data-target="#detail<?= $antrian['id_antrian'] ?>" title="Detail Data"><i class="fa fa-eye"></i></a>
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
                            <td class="col-md-3">No Rekam Medis</nama>
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
                            <td>Mens Terakhir</td>
                            <td><?= $antrian['mens_terakhir'] ?></td>
                        </tr>
                        <tr>
                            <td>Keluhan</td>
                            <td><?= $antrian['keluhan'] ?></td>
                        </tr>
                        <tr>
                            <td>Tgl Periksa</td>
                            <td><?= tgl_indo($antrian['tgl_periksa']) ?></td>
                        </tr>
                        <tr>
                            <td>Catatan Dokter</td>
                            <td><?= $antrian['catatan'] ?></td>
                        </tr>


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
    elseif($aksi == "batal"):
    ?>
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
                                <span class="label label-info">Dalam Antrian</span>
                                    <?php }elseif($stt == 'S'){ ?>
                                    <span class="label label-success">Sudah Periksa</span>
                    <?php } ?>
                </td>
                <td>
                <a href="" class="btn btn-default" data-toggle="modal" data-target="#detail<?= $antrian['id_antrian'] ?>" title="Detail Data"><i class="fa fa-eye"></i></a>
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
                            <td class="col-md-3">No Rekam Medis</nama>
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
                            <td>Mens Terakhir</td>
                            <td><?= $antrian['mens_terakhir'] ?></td>
                        </tr>
                        <tr>
                            <td>Keluhan</td>
                            <td><?= $antrian['keluhan'] ?></td>
                        </tr>
                        <tr>
                            <td>Tgl Periksa</td>
                            <td><?= tgl_indo($antrian['tgl_periksa']) ?></td>
                        </tr>
                        <tr>
                            <td>Catatan Dokter</td>
                            <td><?= $antrian['catatan'] ?></td>
                        </tr>

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
    endif;
    ?>

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