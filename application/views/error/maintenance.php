<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $nama_judul ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="keywords"
        content="<?= $nama_judul ?>, <?= $meta_keywords ?>, <?= $meta_description ?>, kassandra, kassandra hd production, KASSANDRA, KASSANDRA HD PRODUCTION">
    <meta name="description"
        content="<?= $nama_judul ?>, <?= $meta_keywords ?>, <?= $meta_description ?>,">
    <meta name="author" content="KASSANDRA, KASSANDRA HD PRODUCTION">
    <meta content='index,follow' name='robots' />

    <!-- Favicon -->
    <link href="<?= base_url('themes/landingpage') ?>/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('themes/landingpage') ?>/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= base_url('themes/landingpage') ?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url('themes/landingpage') ?>/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('themes/landingpage') ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- themes Stylesheet -->
    <link href="<?= base_url('themes/landingpage') ?>/css/style.css" rel="stylesheet">
</head>

<body background="<?= base_url('themes/landingpage') ?>/img/img/white.jpg" style="background-size: cover; background-repeat: repeat; background-position: center center;">
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border position-relative text-primary" style="width: 6rem; height: 6rem;" role="status">
        </div>
        <i class="fa fa-wifi fa-2x text-primary position-absolute top-50 start-50 translate-middle"></i>
    </div>
    <!-- Spinner End -->
    <br><br><br>
    <!-- 404 Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container text-center">
            <div class="row justify-content-center">
            <img src="<?= base_url('themes/landingpage') ?>/img/maintenance.gif" style="width: 420pt; height: 100%; object-fit: cover;">
                <div class="col-lg-6">
                    <i class="bi bi-exclamation-triangle display-1 text-primary"></i>                   
                    <h3 class="mb-4">Halaman ini masih dalam pengembangan <br>
                        information by Kassandra Production
                    </h3>
                        <!-- mundur 1 kali ke halaman sebelumnya -->
                    <a href="javascript:history.back()" class="btn btn-primary">Go Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 404 End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('themes/landingpage') ?>/lib/wow/wow.min.js"></script>
    <script src="<?= base_url('themes/landingpage') ?>/lib/easing/easing.min.js"></script>
    <script src="<?= base_url('themes/landingpage') ?>/lib/waypoints/waypoints.min.js"></script>
    <script src="<?= base_url('themes/landingpage') ?>/lib/counterup/counterup.min.js"></script>
    <script src="<?= base_url('themes/landingpage') ?>/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?= base_url('themes/landingpage') ?>/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Javascript -->
    <script src="<?= base_url('themes/landingpage') ?>/js/main.js"></script>
    <script type="text/javascript">
        // info tahun
        var tahun = new Date().getFullYear();
        document.getElementById("tahun").innerHTML = tahun;
    </script>
</body>

</html>