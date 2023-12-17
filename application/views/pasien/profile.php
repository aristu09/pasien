<?php $this->load->view('template/header'); ?>

<?php 
if($aksi == "lihat"):
?>
<?= $this->session->flashdata('pesan') ?>

<table class="table table-striped">
    <form action="" method="POST" enctype="multipart/form-data">
        <tr>
            <th class="col-md-2">No Rekam Medis</th>
            <td>
                : <?= $id_pasien ?>
            </td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>
                : <?= $nama ?>
            </td>
        </tr>
        <tr>
            <th>No HP</th>
            <td>
                : <?= $no_hp ?>
            </td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>
                : <?= $alamat ?>
            </td>
        </tr>
        <tr>
            <th>Tgl lahir</th>
            <td>
                : <?= $tgl_lahir ?>
            </td>
        </tr>
        <tr>
            <th>Nama suami</th>
            <td>
                : <?= $nama_suami ?>
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <td>
                : <?= $email ?>
            </td>
        </tr>
        <tr>
            <th>Password</th>
            <td>
                : <a href="" class="btn btn-info" data-toggle="modal" data-target="#ganti_password"><i
                        class="fa fa-key"></i> Ganti Password</a>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <a href="../pasien/home" class="btn btn-primary">Kembali</a> &nbsp;&nbsp;
                <a href="" class="btn btn-warning" data-toggle="modal" data-target="#editAkun"><i
                        class="fa fa-edit"></i> Perbarui Data</a>
            </td>
        </tr>

    </form>
</table>

<!-- Modal edit data akun -->
<div class="modal fade" id="editAkun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                    <input type="hidden" name="id_pasien" value="<?= $id_pasien ?>"class="form-control" readonly>
                            <tr>
                                <th>Nama</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama" value="<?= $nama ?>" class="form-control" autocomplete="off" required>
                                </td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="no_hp" value="<?= $no_hp ?>" class="form-control" autocomplete="off" required>
                                </td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="alamat" value="<?= $alamat ?>" class="form-control" autocomplete="off" required>
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="tgl_lahir" id="tanggal-lahir" value="<?= $tgl_lahir ?>" class="form-control" autocomplete="off" required>
                                </td>
                            </tr>
        
                            <tr>
                                <th>Nama Suami</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_suami" value="<?= $nama_suami ?>" class="form-control" autocomplete="off" required>
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="email" name="email" value="<?= $email ?>" class="form-control" autocomplete="off" required>
                                </td>
                            </tr>
                            <tr>
                            <th>Ganti Password</th>
                            </tr>
                            <tr>
                                <td>
                                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#ganti_password"><i
                                            class="fa fa-key"></i> Ganti Password</a>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
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
        //mengambil data umur dari hasil inputan tgl lahir
        const tanggalLahirInput = document.getElementById("tanggal-lahir");
        const umurInput = document.getElementById("umur");

        tanggalLahirInput.addEventListener("change", function() {
        const tanggalLahir = new Date(this.value);
        const sekarang = new Date();
        const selisihTahun = sekarang.getFullYear() - tanggalLahir.getFullYear();
        
        umurInput.value = selisihTahun;
        });
    </script>

<!-- Modal ganti password  -->
<div class="modal fade" id="ganti_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                    <input type="hidden" name="id_pasien" value="<?= $id_pasien ?>"class="form-control" readonly>
                        <tr>
                            <th>Masukkan Password Baru</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="password" id="password" name="password" class="form-control" autocomplete="off" required>
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
<!-- End Modal -->

<?php endif; ?>

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
    //edit akun
    $(document).on('submit', '#edit', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('pasien/profile/api_edit/') ?>" + form_data.get('id_pasien'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#edit' + form_data.get('id_pasien'));
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

    //edit akun
    $(document).on('submit', '#gantipassword', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('pasien/profile/api_password/') ?>" + form_data.get('id_pasien'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#gantipassword' + form_data.get('id_pasien'));
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
