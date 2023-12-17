<?php $this->load->view('template/header'); ?>

<a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahAdmin"><i class="fa fa-plus"></i>
    Tambah Admin</a>
<br /><br /><br />
<?= $this->session->flashdata('pesan') ?>
<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Hak Akses</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data->result_array() as $admin): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $admin['nama'] ?></td>
                <td><?= $admin['no_hp'] ?></td>
                <td><?= $admin['email'] ?></td>
                <td><?= ucfirst($admin['level']) ?></td>
                <td>
                    <a href="" class="btn btn-warning" data-toggle="modal"
                        data-target="#edit<?= $admin['id_admin'] ?>"><i class="fa fa-edit"></i> </a>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

    <!-- Modal tambah Admin-->
    <div class="modal fade" id="modalTambahAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <form action="<?= base_url('admin/user_admin/tambah') ?>" method="post">
                            <table class="table table-striped">
                                <tr>
                                    <th>Nama</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="nama" class="form-control" required="" autocomplete="off"> </td>
                                </tr>
                                <tr>
                                    <th>No HP</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="no_hp" class="form-control" required="" autocomplete="off"></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="email" class="form-control" required="" autocomplete="off"></td>
                                </tr>
                                <tr>
                                    <th>Password</th>
                                </tr>
                                <tr>
                                    <td><input type="password" name="password" class="form-control" required=""></td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <input type="submit" name="kirim" value="Entri Data" class="btn btn-primary">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal edit admin-->
    <?php foreach($data->result_array() as $admin): ?>
    <div class="modal fade" id="edit<?= $admin['id_admin'] ?>" tabindex="-1" role="dialog"
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
                            <table class="table table-striped">
                                <input type="hidden" name="id_admin" value="<?= $admin['id_admin'] ?>">
                                <tr>
                                    <th>Nama</th>
                                    <td><input type="text" name="nama" class="form-control"
                                            value="<?= $admin['nama'] ?>" required="" autocomplete="off"></td>
                                </tr>
                                <tr>
                                    <th>No HP</th>
                                    <td><input type="text" name="no_hp" class="form-control"
                                            value="<?= $admin['no_hp'] ?>" required="" autocomplete="off"></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><input type="text" name="email" class="form-control"
                                            value="<?= $admin['email'] ?>" required="" autocomplete="off"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Kembali</button> &nbsp;&nbsp;
                                        <input type="submit" name="kirim" value="Entri Data" class="btn btn-primary"> &nbsp;&nbsp;
                                        <a href="javascript:void(0)" onclick="hapusadmin('<?= $admin['id_admin'] ?>')"
                                        class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <!-- End Modal -->
    <script>
        //add user_admin
        $(document).ready(function () {
        $('#add').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('admin/user_admin/api_add') ?>",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function (data) {
                    $('#modalTambahAdmin');
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

        //edit user_admin
        $(document).on('submit', '#edit', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/user_admin/api_edit/') ?>" + form_data.get('id_admin'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#edit' + form_data.get('id_admin'));
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

        //ajax hapus pengguna
        function hapusadmin(id_admin) {
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
                    url: "<?php echo site_url('admin/user_admin/api_hapus/') ?>" + id_admin,
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