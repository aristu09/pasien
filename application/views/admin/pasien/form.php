<?php $this->load->view('template/header'); ?>

<a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPasien"><i class="fa fa-plus"></i>
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
                <th>No HP</th>
                <th>Alamat</th>
                <th>Tgl Lahir</th>
                <th>Nama Suami</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data as $pasien): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $pasien['id_pasien'] ?></td>
                <td><?= $pasien['nama'] ?></td>
                <td><?= $pasien['no_hp'] ?></td>
                <td><?= $pasien['alamat'] ?></td>
                <td><?= $pasien['tgl_lahir'] ?></td>
                <td><?= $pasien['nama_suami'] ?></td>
                <td><?= $pasien['email'] ?></td>

                <td>
                    <a href="" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $pasien['id_pasien'] ?>"><i class="fa fa-edit"></i></a> &nbsp;
                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#ganti_password<?= $pasien['id_pasien'] ?>"><i class="fa fa-key"></i></a>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

    <!-- Modal tambah data peserta-->
    <div class="modal fade" id="modalTambahPasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                    <input type="number" name="no_hp" class="form-control" placeholder="no hp" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="alamat" class="form-control" placeholder="alamat" autocomplete="off"
                                        required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Tgl Lahir</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="tgl_lahir" id="tanggal-lahir" class="form-control" value="<?= date('Y-m-d') ?>"
                                        required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Usia</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" id="umur" class="form-control" placeholder="umur" autocomplete="off"
                                        required="" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Suami</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_suami" class="form-control" placeholder="nama suami" autocomplete="off"
                                        required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="email" name="email" class="form-control" placeholder="email" autocomplete="off"
                                        required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Password</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="password" name="password" class="form-control" placeholder="password" autocomplete="off"
                                        required="">
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

    <!-- Modal edit data pasien-->
    <?php foreach($data as $pasien): ?>
    <div class="modal fade" id="edit<?= $pasien['id_pasien'] ?>" tabindex="-1" role="dialog"
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
                                <th>ID pasien</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="id_pasien" value="<?= $pasien['id_pasien'] ?>"
                                        class="form-control" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama" value="<?= $pasien['nama'] ?>" class="form-control"
                                        required="" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="no_hp" value="<?= $pasien['no_hp'] ?>" class="form-control"
                                        required="" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="alamat" value="<?= $pasien['alamat'] ?>" class="form-control"
                                        required="" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th>Tgl Lahir</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="tgl_lahir" value="<?= $pasien['tgl_lahir'] ?>"
                                        class="form-control" required="" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Suami</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_suami" value="<?= $pasien['nama_suami'] ?>"
                                        class="form-control" required="" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="email" name="email" value="<?= $pasien['email'] ?>" class="form-control"
                                        required="" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th>Password</th>
                            </tr>
                            <tr>
                                <td>
                                <a href="" class="btn btn-info" data-toggle="modal" data-target="#ganti_password<?= $pasien['id_pasien'] ?>"><i class="fa fa-key"></i> Ganti Password</a>
                                </td>
                            </tr>                         
                            
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success"> &nbsp;&nbsp;
                                    <a href="javascript:void(0)" onclick="hapuspasien('<?= $pasien['id_pasien'] ?>')"
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
    <?php foreach($data as $pasien): ?>
    <div class="modal fade" id="ganti_password<?= $pasien['id_pasien'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <input type="hidden" name="id_pasien" value="<?= $pasien['id_pasien'] ?>"class="form-control" readonly>
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
                url: "<?= site_url('admin/pasien/api_add') ?>",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function (data) {
                    $('#modalTambahPasien');
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
                }
            });
        });
    });

        //edit data
        $(document).on('submit', '#edit', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/pasien/api_edit/') ?>" + form_data.get('id_pasien'),
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

        //ganti password
        $(document).on('submit', '#gantipassword', function(e) {
            e.preventDefault();
            var form_data = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/pasien/api_password/') ?>" + form_data.get('id_pasien'),
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

        //ajax hapus pasien
        function hapuspasien(id_pasien) {
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
                    url: "<?php echo site_url('admin/pasien/api_hapus/') ?>" + id_pasien,
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