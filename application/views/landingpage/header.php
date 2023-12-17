<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $nama_judul ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="keywords" content="<?= $nama_judul ?>, <?= $meta_keywords ?>, <?= $meta_description ?>, kassandra, kassandra hd production, KASSANDRA, KASSANDRA HD PRODUCTION">
    <meta name="description" content="<?= $nama_judul ?>, <?= $meta_keywords ?>, <?= $meta_description ?>">
 	<meta name="author" content="KASSANDRA, KASSANDRA HD PRODUCTION">
    <meta content='index,follow' name='robots'/>
    
    <link rel="manifest" href="<?= base_url('static/manifest.json') ?>">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('themes') ?>/favicon.ico" type="image/x-icon">
    <link href="<?= base_url('themes') ?>favicon.ico" rel="icon">

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

    <!--Stylesheet -->
    <link href="<?= base_url('themes/landingpage') ?>/css/style.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

   <!-- sweetalert -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <!-- Spinner Start -->
    <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border position-relative text-primary" style="width: 6rem; height: 6rem;" role="status"></div>
        <i class="fa fa-wifi fa-2x text-primary position-absolute top-50 start-50 translate-middle"></i>
    </div> -->
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <!-- <div class="container-fluid bg-light px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="small text-secondary" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="small text-secondary" href="#">Career</a></li>
                    <li class="breadcrumb-item"><a class="small text-secondary" href="#">Terms</a></li>
                    <li class="breadcrumb-item"><a class="small text-secondary" href="#">Privacy</a></li>
                </ol>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <small>Follow us:</small>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn-square text-primary border-end rounded-0" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn-square text-primary border-end rounded-0" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn-square text-primary border-end rounded-0" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn-square text-primary pe-0" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="#" class="navbar-brand ms-3 d-lg-none">MENU</a>
        <button type="button" class="navbar-toggler me-3" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav me-auto p-3 p-lg-0">
                <a href="register" class="nav-item nav-link <?php if($this->uri->segment(1)=="register"){echo "active";}?>">Home</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Login Aplikasi</a>
                    <div class="dropdown-menu border-0 rounded-0 rounded-bottom m-0">
                        <a href="login" target="" class="dropdown-item">Login</a>
                    </div>
                </div>
            </div>
            <!-- <a href="register" target="" class="btn btn-sm btn-light rounded-pill py-2 px-4">Daftar sekarang ?</a> -->
        </div>
    </nav>
    <!-- Navbar End -->