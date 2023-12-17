<?php $this->load->view('landingpage/header') ?>

<style>
        #preview_bukti {
        display: none;
    }
    </style>
    <!-- Page Header Start -->
    <div class="container-fluid py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background: linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, .5)), url(<?= base_url('themes/foto_logo/'). $logo ?>) no-repeat center center; background-size: cover;">
        <div class="container text-center py-5">
            <h1 class="display-4 text-white animated slideInDown mb-3"><?= $nama_judul ?></h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page"><?= $meta_keywords ?></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Modal iklan -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="text-align:center">
                    <b><?= $title ?></b>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="<?= base_url('./themes/file_informasi/') . $file_informasi ?>" class="img-fluid" alt="(Tidak ada gambar informasi terbaru)" style="width: 100%; object-fit: cover; object-position: center; border-radius: 10px;">
                    </div>
                    <div class="col-md-6">
                        <p><?= $informasi ?></p>
                    </div>
                </div>
            </div>
            <div class="text-left"> <br>
                <a href="<?= base_url('login') ?>" class="btn btn-primary">Login Aplikasi</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Daftar akun baru (klik disini)</button>
            </div>
        </div>
    </div>
</div>
</div>
<script>
//auto show modal
$(window).on('load', function() {
    $('#exampleModal').modal('show');
});
</script>

    <?= $this->session->flashdata('pesan'); ?>
    <!-- Register Start -->
    <div class="container-xxl">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="section-title bg-white text-center text-primary px-3"><?= $meta_keywords ?></h6>
                <p> *Silahkan isi form pendaftaran dengan benar dan lengkap</p>
            </div>
            <div class="row g-0 justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.5s">
                    <form action="<?= site_url('register/add') ?>" method="post" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="name@example.com" autocomplete="off" required>
                                    <label for="nama">Nama Lengkap</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="No HP / WA" value="62" autocomplete="off" required>
                                    <label for="no_hp">Nomor HP / WA</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Jln, Rt/Rw, Desa, Kecamatan, Kabupaten" required>
                                    <label for="alamat">Alamat</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-floating">
                                    <input type="date" class="form-control" id="tanggal-lahir" name="tgl_lahir" placeholder="Tanggal Lahir" required value="<?= date('Y-m-d') ?>">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="umur" placeholder="Umur" readonly required>
                                    <label for="umur">Umur</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="nama_suami" placeholder="Nama Suami" autocomplete="off" required>
                                    <label for="nama_suami">Nama Suami</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" required>
                                    <label for="password">Password</label>
                                    <input type="checkbox" onclick="viewPassword()"> Lihat Password
                                </div>
                            </div>
                            
                            <div class="col-12 text-center">
                                <input type="submit" name="kirim" value="Daftar sekarang" class="btn btn-primary rounded-pill py-3 px-5">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Register End -->
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

        //lihat password
        function viewPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
         
        //add data
    //     $(document).ready(function () {
    //     $('#add').submit(function (e) {
    //         e.preventDefault();
    //         $.ajax({
    //             url: "<?= site_url('register/api_add') ?>",
    //             type: "POST",
    //             data: new FormData(this),
    //             processData: false,
    //             contentType: false,
    //             cache: false,
    //             async: false,
    //             success: function (data) {
    //                 $('#modalTambahpasien');
    //                 $('#add')[0].reset();
    //                 swal({
    //                     title: "Berhasil",
    //                     text: "Terima kasih, kamu sudah terdaftar",
    //                     type: "success",
    //                     showConfirmButton: true,
    //                     confirmButtonText: "OKEE",
    //                 }).then(function () {
    //                     location.reload();
    //                 });
    //             }
    //         });
    //     });
    // });
    </script>
<?php $this->load->view('landingpage/footer') ?>