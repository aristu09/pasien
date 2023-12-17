<?php $this->load->view('template/header'); ?>

<?= $this->session->flashdata('pesan') ?>
<div class="table-responsive">
    <table id="example" class="table table-bordered  table-striped">
    <?php foreach($data->result_array() as $pengaturan): ?>
        <thead>
        <tbody>
            <tr>
                <th class="col-md-2">Jadwal Praktek</th>
                <td><?= $pengaturan['jdwl_praktek'] ?></td>
            </tr>
            <tr>
                <th>Jam Praktek</th>
                <td><?= $pengaturan['jam_praktek'] ?></td>
            </tr>
            <tr>
                <th>Aksi</th>
                <td>
                    <a href="" class="btn btn-warning" data-toggle="modal"
                        data-target="#edit<?= $pengaturan['id_pengaturan'] ?>"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                     <?php $stt = $pengaturan['akses_pendaftaran']  ?>
                        <?php if($stt == 'Buka'){ ?>
                        <span class="label label-success">Buka</span>
                            <?php }elseif($stt == 'Tutup'){ ?>
                            <span class="label label-danger">Tutup</span>
                    <?php } ?>
                    <a href="" class="btn btn-xs btn-warning" data-toggle="modal"
                        data-target="#editstatus<?= $pengaturan['id_pengaturan'] ?>"><i class="fa fa-edit"></i></a>
            </tr>
        </thead>
        
            
           
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal edit judul-->
    <?php foreach($data->result_array() as $pengaturan): ?>
    <div class="modal fade" id="edit<?= $pengaturan['id_pengaturan'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form id="edit" method="post">
                            <input type="hidden" name="id_pengaturan" value="<?= $pengaturan['id_pengaturan'] ?>" class="form-control" readonly>
                            <tr>
                                <th>Jadwal Praktek</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="jdwl_praktek"
                                        value="<?= $pengaturan['jdwl_praktek'] ?>" class="form-control" required autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th class="">Jam Praktek</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="time" name="jam_praktek"
                                        value="<?= $pengaturan['jam_praktek'] ?>" class="form-control">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <button href="" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success"> &nbsp;&nbsp;
                                </td>
                            </tr>

                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <!-- End Modal edit judul-->

    <!-- Modal edit status-->
    <?php foreach($data->result_array() as $pengaturan): ?>
    <div class="modal fade" id="editstatus<?= $pengaturan['id_pengaturan'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form id="editstatus" method="post">
                        <input type="hidden" name="id_pengaturan" value="<?= $pengaturan['id_pengaturan'] ?>" class="form-control" readonly>
                            <tr>
                                <th class="">Status</th>
                            </tr>
                            <tr>
                                <td>
                                <input type="radio" name="akses_pendaftaran" value="Buka" <?php if($pengaturan['akses_pendaftaran'] == 'Buka'){ echo 'checked'; } ?>> Buka
                                <input type="radio" name="akses_pendaftaran" value="Tutup" <?php if($pengaturan['akses_pendaftaran'] == 'Tutup'){ echo 'checked'; } ?>> Tutup
                                </td>
    
                            <tr>
                                <td>
                                    <button href="" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success"> &nbsp;&nbsp;
                                </td>
                            </tr>

                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <script>

     //edit pengaturan
     $(document).on('submit', '#edit', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/pengaturan/api_edit_jadwal/') ?>" + form_data.get('id_pengaturan'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#edit' + form_data.get('id_pengaturan'));
                swal({
                    title: "Berhasil",
                    text: "Data Berhasil Diubah",
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
                    text: "Data Gagal Diubah",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE",
                }).then(function() {
                    location.reload();
                });
            }
        });
    });

    //edit status
    $(document).on('submit', '#editstatus', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/pengaturan/api_editstatus/') ?>" + form_data.get('id_pengaturan'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#editstatus' + form_data.get('id_pengaturan'));
                swal({
                    title: "Berhasil",
                    text: "Data Berhasil Diubah",
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
                    text: "Data Gagal Diubah",
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

    <?php $this->load->view('template/footer'); ?>

    <?php 

function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
}
 
//format tanggal indonesia
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
  $pecahkan = explode('-', $tanggal);
  
  // variabel pecahkan 0 = tanggal
  // variabel pecahkan 1 = bulan
  // variabel pecahkan 2 = tahun
  
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

?>