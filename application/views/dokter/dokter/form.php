<?php $this->load->view('template/header'); ?>

<a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahDokter"><i class="fa fa-plus"></i>
    Tambah</a>
<br /><br /><br />
<?= $this->session->flashdata('pesan') ?>
<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data->result_array() as $dokter): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $dokter['nama'] ?></td>
                <td><?= $dokter['no_hp'] ?></td>
                <td><?= $dokter['email'] ?></td>
                <td>
                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $dokter['id_dokter'] ?>"><i class="fa fa-edit"></i> Edit</a>
                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#ganti_password<?= $dokter['id_dokter'] ?>"><i class="fa fa-key"></i> Ganti Password</a>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

    <!-- Modal tambah data Dokter-->
    <div class="modal fade" id="modalTambahDokter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                    <input type="text" name="nama" class="form-control" placeholder="nama" autocomplete="off"
                                        required="">
                                </td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="no_hp" class="form-control" placeholder="nomor HP" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="email" name="email" class="form-control" placeholder="email" required="" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th>Password</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="password" name="password" class="form-control" placeholder="password" required="" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
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

    <!-- Modal edit data dokter-->
    <?php foreach($data->result_array() as $dokter): ?>
    <div class="modal fade" id="edit<?= $dokter['id_dokter'] ?>" tabindex="-1" role="dialog"
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
                            <tr>
                                <th>ID dokter</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="id_dokter" value="<?= $dokter['id_dokter'] ?>"
                                        class="form-control" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama" value="<?= $dokter['nama'] ?>" class="form-control" autocomplete="off"
                                        required="">
                                </td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="no_hp" value="<?= $dokter['no_hp'] ?>" class="form-control" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="email" value="<?= $dokter['email'] ?>" autocomplete="off"
                                        class="form-control" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Password</th>
                            </tr>
                            <tr>
                                <td>
                                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#ganti_password<?= $dokter['id_dokter'] ?>"><i
                                            class="fa fa-key"></i> Ganti Password</a>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success"> &nbsp;&nbsp;
                                    <a href="javascript:void(0)" onclick="hapusdokter('<?= $dokter['id_dokter'] ?>')"
                                        class="btn btn-danger">Hapus</a>
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

<!-- Modal ganti password  -->
<?php foreach($data->result_array() as $dokter): ?>
<div class="modal fade" id="ganti_password<?= $dokter['id_dokter'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-purple">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ganti Password</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered table-striped">
                    <form id="gantipassword" method="post">
                    <input type="hidden" name="id_dokter" value="<?= $dokter['id_dokter'] ?>"class="form-control" readonly>
                        <tr>
                            <th>Masukkan Password Baru</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" id="password" name="password" class="form-control" required=""> 
								<input type="checkbox" onclick="viewPassword()"> Lihat Password
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                &nbsp;&nbsp;
                                <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                            </th>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<!-- End Modal -->


<script type="text/javascript">
//view password
function viewPassword() {
	var x = document.getElementById("password");
	if (x.type === "password") {
		x.type = "text";
	} else {
		x.type = "password";
	}
}
</script>

    <script>
        //add data
        $(document).ready(function () {
        $('#add').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('admin/dokter/api_add') ?>",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function (data) {
                    $('#modalTambahDokter');
                    $('#add')[0].reset();
                    swal({
                        title: "Berhasil",
                        text: "Data berhasil ditambahkan",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE",
                    }).then(function () {
                        location.reload();
                    });
                },
            });
        });
    });

        //edit file
        $(document).on('submit', '#edit', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/dokter/api_edit/') ?>" + form_data.get('id_dokter'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#edit' + form_data.get('id_dokter'));
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

        //ganti password
    $(document).on('submit', '#gantipassword', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/dokter/api_password/') ?>" + form_data.get('id_dokter'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#gantipassword' + form_data.get('id_dokter'));
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

        //ajax hapus dokter
        function hapusdokter(id_dokter) {
        swal({
            title: "Apakah Anda Yakin?",
            text: "Data Akan Dihapus",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak, Batalkan!",
            closeOnConfirm: false,
            closeOnCancel: true // Set this to true to close the dialog when the cancel button is clicked
        }).then(function(result) {
            if (result.value) { // Only delete the data if the user clicked on the confirm button
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('admin/dokter/api_hapus/') ?>" + id_dokter,
                    dataType: "json",
                }).done(function() {
                    swal({
                        title: "Berhasil",
                        text: "Data Berhasil Dihapus",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                }).fail(function() {
                    swal({
                        title: "Gagal",
                        text: "Data Gagal Dihapus",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                });
            } else { // If the user clicked on the cancel button, show a message indicating that the deletion was cancelled
                swal("Batal hapus", "Data Tidak Jadi Dihapus", "error");
            }
        });
    }
    </script>

    <?php $this->load->view('template/footer'); ?>

<?php 

function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
}
?>