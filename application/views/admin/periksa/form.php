<?php $this->load->view('template/header'); ?>

<?php 
if($aksi == "verifikasi"):
?>
<a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahAntrian"><i class="fa fa-plus"></i>
    Tambah</a>
<br /><br /><br />
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
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data as $antrian): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $antrian['id_pasien'] ?></td>
                <td><?= $antrian['nama'] ?></td>
                <td><?= tgl_indo($antrian['tgl_periksa']) ?>
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
                <a href="https://api.whatsapp.com/send?phone=<?= $antrian['no_hp'] ?>/&text=Assalamualaikum%20Sdr/i%20<?= $antrian['nama'] ?>.%0AKami%20dari%20Klinik%20Dr.%20Bambang%20SpOG%20mengingatkan,%20bahwa%20anda%20telah%20mendaftar%20untuk%20periksa%20pada%20tanggal%20<?= tgl_indo($antrian['tgl_periksa']) ?>%20waktu%20pagi.%0AMohon%20untuk%20selalu%20memantau%20nomor%20antrian%20anda%20di%20Web%20Aplikasi%20kami%20https://klinikdrbambang.com%0ASehingga%20waktu%20kedatangan%20anda%20bisa%20menyesuaikan%20dengan%20nomor%20antrian%20anda.%0ATerima%20Kasih%0A%0A~%20Klinik%20Dr.%20Bambang%20SpOG%20~" class="btn btn-success" title="Kirim Pesan" target="_blank"><i class="fa fa-whatsapp"></i></a>
                </td>
                <td>
                    <a href="javascript:void(0)" onclick="dalam_antrian('<?= $antrian['id_antrian'] ?>')" class="btn btn-info btn-sm" title="Dalam Antrian"><i class="fa fa-check-square-o"></i></a> &nbsp;&nbsp;
                    <a href="javascript:void(0)" onclick="batal_periksa('<?= $antrian['id_antrian'] ?>')" class="btn btn-danger btn-sm" title="Batal Periksa"><i class="fa fa-ban"></i></a>
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
                            <td>Mens Terakhir</td>
                            <td><?= $antrian['mens_terakhir'] ?></td>
                        </tr>
                    
                        <tr>
                            <td>Tgl Periksa</td>
                            <td><?= tgl_indo($antrian['tgl_periksa']) ?>
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

    <!-- Modal tambah data antrian-->
    <div class="modal fade" id="modalTambahAntrian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Tambah <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form id="add" method="post">
                            <tr>
                                <th>Nama</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="id_pasien" class="form-control" required="">
                                        <option value="">--Pilih Pasien--</option>
                                        <?php foreach($pasien as $pkt): ?>
                                        <option value="<?= $pkt['id_pasien'] ?>"><?= ucfirst($pkt['nama']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Mens Terakhir</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="mens_terakhir" class="form-control" required="">
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
                                <th>Tgl Periksa</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="tgl_periksa" class="form-control" required="">
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
    <!-- End Modal -->

    <script>
         //add data
    $(document).ready(function() {
        $('#add').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('admin/periksa/api_add') ?>",
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
                        text: "Data berhasil ditambahkan",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE",
                    }).then(function() {
                        location.reload();
                    });
                }
            });
        });
    });

    //ajax dalam_antrian
    function dalam_antrian(id_antrian) {
        swal({
            title: "Konfirmasi Periksa",
            text: "Pasien Dalam Antrian?",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#3CB371",
            confirmButtonText: "Ya, Dalam Antrian!",
            cancelButtonColor: "#DD6B55",
            cancelButtonText: "Tidak, Batalkan!",
            closeOnConfirm: false,
            closeOnCancel: true // Set this to true to close the dialog when the cancel button is clicked
        }).then(function(result) {
            if (result.value) { // Only delete the data if the user clicked on the confirm button
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('admin/periksa/dalam_antrian/') ?>" + id_antrian,
                    dataType: "json",
                }).done(function() {
                    swal({
                        title: "Berhasil",
                        text: "Pasien Dalam Antrian",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                }).fail(function() {
                    swal({
                        title: "Gagal",
                        text: "",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                });
            } else { // If the user clicked on the cancel button, show a message indicating that the deletion was cancelled
                swal("Batal Proses", "", "error");
            }
        });
    }

    //ajax batal_periksa
    function batal_periksa(id_antrian) {
        swal({
            title: "Konfirmasi Periksa",
            text: "Pasien Batal Diperiksa?",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#3CB371",
            confirmButtonText: "Ya, Batal Periksa!",
            cancelButtonColor: "#DD6B55",
            cancelButtonText: "Tidak, Batalkan!",
            closeOnConfirm: false,
            closeOnCancel: true // Set this to true to close the dialog when the cancel button is clicked
        }).then(function(result) {
            if (result.value) { // Only delete the data if the user clicked on the confirm button
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('admin/periksa/batal_periksa/') ?>" + id_antrian,
                    dataType: "json",
                }).done(function() {
                    swal({
                        title: "Berhasil",
                        text: "Pasien Batal Diperiksa",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                }).fail(function() {
                    swal({
                        title: "Gagal",
                        text: "",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                });
            } else { // If the user clicked on the cancel button, show a message indicating that the deletion was cancelled
                swal("Batal Proses", "", "error");
            }
        });
    }
    </script>

    <?php 
    elseif($aksi == "antrian"):
    ?>
    <?php if($depan == TRUE): 
          
    ?>
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
                <td><?= tgl_indo($antrian['tgl_periksa']) ?>
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
                        <a href="javascript:void(0)" onclick="diperiksa('<?= $antrian['id_antrian'] ?>')" class="btn btn-warning" title="Akan Diperiksa"><i class="fa fa-check-square-o"></i></a> &nbsp;&nbsp;
                            <?php }elseif($stt == 'DIPERIKSA'){ ?>
                                <a href="javascript:void(0)" onclick="sudahperiksa('<?= $antrian['id_antrian'] ?>')" class="btn btn-primary" title="Akan Diperiksa"><i class="fa fa-check-square-o"></i></a>
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
                            <td>Mens Terakhir</td>
                            <td><?= $antrian['mens_terakhir'] ?></td>
                        </tr>
                    
                        <tr>
                            <td>Tgl Periksa</td>
                            <td><?= tgl_indo($antrian['tgl_periksa']) ?>
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
        //ajax diperiksa
        function diperiksa(id_antrian) {
            swal({
                title: "Konfirmasi Periksa",
                text: "Pasien Akan Diperiksa?",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#3CB371",
                confirmButtonText: "Ya, Periksa!",
                cancelButtonColor: "#DD6B55",
                cancelButtonText: "Tidak, Batalkan!",
                closeOnConfirm: false,
                closeOnCancel: true // Set this to true to close the dialog when the cancel button is clicked
            }).then(function(result) {
                if (result.value) { // Only delete the data if the user clicked on the confirm button
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('admin/periksa/diperiksa/') ?>" + id_antrian,
                        dataType: "json",
                    }).done(function() {
                        swal({
                            title: "Berhasil",
                            text: "Pasien Akan Diperiksa",
                            type: "success",
                            showConfirmButton: true,
                            confirmButtonText: "OKEE"
                        }).then(function() {
                            location.reload();
                        });
                    }).fail(function() {
                        swal({
                            title: "Gagal",
                            text: "",
                            type: "error",
                            showConfirmButton: true,
                            confirmButtonText: "OKEE"
                        }).then(function() {
                            location.reload();
                        });
                    });
                } else { // If the user clicked on the cancel button, show a message indicating that the deletion was cancelled
                    swal("Batal Proses", "", "error");
                }
            });
        }

        //ajax sudahperiksa
        function sudahperiksa(id_antrian) {
            swal({
                title: "Konfirmasi Periksa",
                text: "Pasien Selesai Diperiksa?",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#3CB371",
                confirmButtonText: "Ya, Periksa!",
                cancelButtonColor: "#DD6B55",
                cancelButtonText: "Tidak, Batalkan!",
                closeOnConfirm: false,
                closeOnCancel: true // Set this to true to close the dialog when the cancel button is clicked
            }).then(function(result) {
                if (result.value) { // Only delete the data if the user clicked on the confirm button
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('admin/periksa/sudah_periksa/') ?>" + id_antrian,
                        dataType: "json",
                    }).done(function() {
                        swal({
                            title: "Berhasil",
                            text: "Pasien Sudah Diperiksa",
                            type: "success",
                            showConfirmButton: true,
                            confirmButtonText: "OKEE"
                        }).then(function() {
                            location.reload();
                        });
                    }).fail(function() {
                        swal({
                            title: "Gagal",
                            text: "",
                            type: "error",
                            showConfirmButton: true,
                            confirmButtonText: "OKEE"
                        }).then(function() {
                            location.reload();
                        });
                    });
                } else { // If the user clicked on the cancel button, show a message indicating that the deletion was cancelled
                    swal("Batal Proses", "", "error");
                }
            });
        }

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
                <th>Kirim Pesan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data as $antrian): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $antrian['id_pasien'] ?></td>
                <td><?= $antrian['nama'] ?></td>
                <td><?= tgl_indo($antrian['tgl_periksa']) ?>
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
                <td>
                <a href="https://api.whatsapp.com/send?phone=<?= $antrian['no_hp'] ?>/&text=Assalamualaikum%20Sdr/i%20<?= $antrian['nama'] ?>.%0ATerima%20kasih%20telah%20melakukan%20pemeriksaan%20di%20klinik%20Dr.%20Bambang%20SpOG%20.%0AMohon%20bantuannya%20untuk%20memberikan%20rating%20pelayanan%20kami%20di%20https://goo.gl/maps/PrfTMuVWgqoS4faz8%0ASehingga%20kami%20dapat%20memberikan%20pelayanan%20yang%20lebih%20baik%20lagi.%0ATerima%20kasih" class="btn btn-success" title="Kirim Pesan" target="_blank"><i class="fa fa-whatsapp"></i></a>
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
                            <td>Mens Terakhir</td>
                            <td><?= $antrian['mens_terakhir'] ?></td>
                        </tr>
                    
                        <tr>
                            <td>Tgl Periksa</td>
                            <td><?= tgl_indo($antrian['tgl_periksa']) ?>
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
                <td><?= tgl_indo($antrian['tgl_periksa']) ?>
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
                            <td>Mens Terakhir</td>
                            <td><?= $antrian['mens_terakhir'] ?></td>
                        </tr>
                    
                        <tr>
                            <td>Tgl Periksa</td>
                            <td><?= tgl_indo($antrian['tgl_periksa']) ?>
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