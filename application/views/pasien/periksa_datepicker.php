<?php $this->load->view('template/header'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<?php 
if($aksi == "riwayat"):
?>

<?= $this->session->flashdata('pesan') ?>

<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
    <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tgl Periksa</th>
                <th>Status</th>
                <th>Detail Data</th>
                <th>Barcode</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data->result_array() as $antrian): ?>
            <tr>
                <td><?= $no ?></td>
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
    <?php foreach($data->result_array() as $antrian): ?>
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
                            <td><?= tgl_indo($antrian['mens_terakhir']) ?></td>
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
                                    <input type="text" name="mens_terakhir" id="tgl_mens" class="form-control" value="<?= date('d/m/Y') ?>" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Pilih Tanggal Periksa</th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="tgl_periksa" name="tgl_periksa" required="" value="<?= date('d/m/Y') ?>" placeholder="klik untuk memilih tanggal">
                                    </div>

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
    
    $(document).ready(function(){
    var holidays = []; // Buat array kosong untuk menampung tanggal-tanggal hari libur
    $.ajax({
        url: 'https://api-harilibur.vercel.app/api',
        dataType: 'json',
        success: function(data) {
            // Jika API mengembalikan data yang benar, tambahkan tanggal-tanggal libur ke dalam array holidays
            for (var i = 0; i < data.length; i++) {
                holidays.push(data[i].date);
            }
            $('#tgl_mens').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
                language: 'id',
                beforeShowDay: function(date) {
                    var day = date.getDay();
                    var formattedDate = $.datepicker.formatDate('dd/mm/yyyy', date);
                    if (day === 0 || holidays.includes(formattedDate)) { // Menandai tanggal-tanggal hari libur
                        return {
                            classes: 'btn-danger',
                        };
                    }
                    return;
                },
                datesDisabled: holidays // Menonaktifkan tanggal-tanggal hari libur
            });
        },
        error: function() {
            // Jika API mengalami masalah, tampilkan pesan kesalahan
            alert('Gagal mengambil data libur nasional dari API');
            $('#tgl_mens').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
                language: 'id',
                beforeShowDay: function(date) {
                    var day = date.getDay();
                    var formattedDate = $.datepicker.formatDate('dd/mm/yyyy', date);
                    if (day === 0 || formattedDate === '01/01/2023' || formattedDate === '25/12/2023') { // Menandai tanggal-tanggal hari libur
                        return {
                            classes: 'btn-danger',
                        };
                    }
                    return;
                },
            });
        }
    });
});

    $(document).ready(function(){
        var holidays = []; // Buat array kosong untuk menampung tanggal-tanggal hari libur
        $.ajax({
            url: 'https://api-harilibur.vercel.app/api',
            dataType: 'json',
            success: function(data) {
                // Jika API mengembalikan data yang benar, tambahkan tanggal-tanggal libur ke dalam array holidays
                for (var i = 0; i < data.length; i++) {
                    holidays.push(data[i].date);
                }
                $('#tgl_periksa').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                    language: 'id',
                    beforeShowDay: function(date) {
                        var day = date.getDay();
                        var formattedDate = $.datepicker.formatDate('dd/mm/yyyy', date);
                        if (day === 0 || holidays.includes(formattedDate)) { // Menandai tanggal-tanggal hari libur
                            return {
                                classes: 'btn-danger',
                            };
                        }
                        return;
                    },
                    //hanya mengaktifkan tanggal 1 bulan dari hari ini
                    startDate: '+1d',
                    endDate: '+5d',
                    datesDisabled: holidays // Menonaktifkan tanggal-tanggal hari libur
                });
            },
            error: function() {
                // Jika API mengalami masalah, tampilkan pesan kesalahan
                alert('Gagal mengambil data libur nasional dari API');
                $('#tgl_periksa').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true,
                    language: 'id',
                    beforeShowDay: function(date) {
                        var day = date.getDay();
                        var formattedDate = $.datepicker.formatDate('dd/mm/yyyy', date);
                        if (day === 0 || formattedDate === '01/01/2023' || formattedDate === '25/12/2023') { // Menandai tanggal-tanggal hari libur
                            return {
                                classes: 'btn-danger',
                            };
                        }
                        return;
                    },
                });
            }
        });
    });


         //add data
    $(document).ready(function() {
        $('#add').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('pasien/periksa/api_add') ?>",
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