<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $judul ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php  $nama_judul = $this->db->get('tb_pengaturan')->row_array(); ?>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="keywords" content="<?= $nama_judul['nama_judul'] ?>, <?= $nama_judul['meta_keywords'] ?>, <?= $nama_judul['meta_description'] ?>, kassandra my id, kassandra wifi, kassandra, kassandra hd production, KASSANDRA, KASSANDRA HD PRODUCTION">
  <meta name="description" content="<?= $nama_judul['nama_judul'] ?>, <?= $nama_judul['meta_keywords'] ?>, <?= $nama_judul['meta_description'] ?>">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
 <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <!-- <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/bootstrap-daterangepicker/daterangepicker.css"> -->
  <!-- bootstrap wysihtml5 - text editor -->
 <script src="<?= base_url('themes/admin') ?>/bower_components/jquery/jquery-1.11.2.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif] -->
  <!-- maps -->
  <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap" type="text/javascript"></script>
  <!-- ajax jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

   <!-- sweetalert -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= base_url('themes') ?>/favicon.ico" type="image/x-icon">
 
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
        #preview_logo{
	    display:none;
		}
    </style>
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">
<?php
//error_reporting(0);
if($this->session->userdata('level') =="Administrator"){
 $id  = $this->session->userdata('id_admin');
 $data= $this->db->get_where('tb_admin',array('id_admin'=>$id))->row_array();
}elseif($this->session->userdata('level') == "Dokter"){
 $id  = $this->session->userdata('id_dokter');
 $data= $this->db->get_where('tb_dokter',array('id_dokter'=>$id))->row_array();
}elseif($this->session->userdata('level') == "Pasien"){
  $id  = $this->session->userdata('id_pasien');
  $data= $this->db->get_where('tb_pasien',array('id_pasien'=>$id))->row_array();
  // Mendekripsi data menggunakan Vigenere
  $vigenere = new Vigenere();
  $vigenere->setKey('kassandra'); // Ganti 'kassandra' dengan kunci enkripsi yang Anda inginkan
  $data['nama'] = $vigenere->decrypt($data['nama']);
 }
?>


  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
          <?php  $nama_judul = $this->db->get('tb_pengaturan')->row_array(); ?>
          <b><?= $nama_judul['nama_judul'] ?></b>
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span><span id="tgl"></span> | <span id="jam"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php if($this->session->userdata('level') == "Administrator"){ ?>
              <img src="<?= base_url('themes/admin') ?>/dist/admin.png" class="user-image" width="20%" alt="User Image">
              <?php }elseif($this->session->userdata('level') == "Dokter"){ ?>
                    <img src="<?= base_url('themes/admin') ?>/dist/dokter.png" class="user-image" width="20%" alt="User Image">
                  <?php }elseif($this->session->userdata('level') == "Pasien"){ ?>
                    <img src="<?= base_url('themes/admin') ?>/dist/user.png" class="user-image" width="20%" alt="User Image">                  
              <?php } ?> 
              <span class="hidden-xs"><?= $data['nama'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php if($this->session->userdata('level') == "Administrator"){ ?>
                  <img src="<?= base_url('themes/admin') ?>/dist/admin.png" class="img-circle" width="20%" alt="User Image"> <br>
                  <?php }elseif($this->session->userdata('level') == "Dokter"){ ?>
                      <img src="<?= base_url('themes/admin') ?>/dist/dokter.png" class="img-circle" width="20%" alt="User Image"> <br>
                    <?php }elseif($this->session->userdata('level') == "Pasien"){ ?>
                      <img src="<?= base_url('themes/admin') ?>/dist/user.png" class="img-circle" width="20%" alt="User Image"> <br>                  
                <?php } ?> 
                <p>
                  <?= $data['nama'] ?> <br>
                  <span class="label label-warning">
                  <small>
                        <?php if($this->session->userdata('level') == "Administrator"){ ?>
                        <span>Administrator</span>
                          <?php }elseif($this->session->userdata('level') == "Dokter"){ ?>
                          <span>Dokter</span> 
                          <?php }elseif($this->session->userdata('level') == "Pasien"){ ?>
                            <span>Pasien</span>                 
                        <?php } ?> 
                  </small>
                  </span>
                </p>
              </li>
              
              <?php if($this->session->userdata('level') == "Administrator"){ ?>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?= base_url('admin/user_admin') ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                <a href="javascript:void(0)" onclick="keluar()" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
              <?php }elseif($this->session->userdata('level') == "Dokter"){ ?>
                <li class="user-footer">
                <div class="pull-left">
                  <a href="<?= base_url('dokter/profile') ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                <a href="javascript:void(0)" onclick="keluar()" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
              <?php }elseif($this->session->userdata('level') == "Pasien"){ ?>
                <li class="user-footer">
                <div class="pull-left">
                  <a href="<?= base_url('pasien/profile') ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                <a href="javascript:void(0)" onclick="keluar()" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
              <?php } ?>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
   <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <br /><br />
        </div>
          <?php if($this->session->userdata('level') == "Administrator"){ ?>
            <img src="<?= base_url('themes/admin') ?>/dist/admin.png" class="img-circle" width="20%" alt="User Image">
            <?php }elseif($this->session->userdata('level') == "Dokter"){ ?>
              <img src="<?= base_url('themes/admin') ?>/dist/dokter.png" class="img-circle" width="20%" alt="User Image">
              <?php }elseif($this->session->userdata('level') == "Pasien"){ ?> 
                <img src="<?= base_url('themes/admin') ?>/dist/user.png" class="img-circle" width="20%" alt="User Image">                 
          <?php } ?> 
        <span class="pull-left info"><?= ucfirst($data['nama']) ?> <br><br>
        <small class="label label-warning">
                <?php if($this->session->userdata('level') == "Administrator"){ ?>
                <span>Administrator</span>
                  <?php }elseif($this->session->userdata('level') == "Dokter"){ ?>
                  <span>Dokter</span>     
                  <?php }elseif($this->session->userdata('level') == "Pasien"){ ?>
                    <span>Pasien</span>             
              <?php } ?> 
        </small>
        </span>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
       

<?php if($this->session->userdata('level') == "Administrator"){ ?>
  <li class="">
          <a href="<?= base_url('admin/home') ?>">
            <i class="fa fa-dashboard"></i> <span>Dasboard</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Home</small>
            </span>
          </a>
        </li>
        <li><a href="<?= base_url('admin/verifikasi') ?>"><i class="fa fa-qrcode"></i> <span>Scan QR Code</span></a></li>
        <li class="header">OLAH DATA</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-stethoscope"></i> <span>Data Periksa</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu active">
          <li><a href="<?= base_url('admin/periksa/antrian') ?>" class="active"><i class="fa fa-clock-o"></i>Antrian Periksa</a></li>
          <li><a href="<?= base_url('admin/periksa/verifikasi') ?>"><i class="fa fa-search"></i>Perlu Verifikasi</a></li>
          <li><a href="<?= base_url('admin/periksa/sudah') ?>"><i class="fa fa-check-square-o"></i>Sudah Diperiksa</a></li>
          <li><a href="<?= base_url('admin/periksa/batal') ?>"><i class="fa fa-ban"></i>Batal Diperiksa</a></li>
          </ul>
        </li>
      <li><a href="<?= base_url('admin/pengaturan/jadwal_praktek'); ?>"><i class="fa fa-calendar"></i> <span>Jadwal Praktek</span></a></li>
      <li><a href="<?= base_url('admin/pasien'); ?>"><i class="fa fa-users"></i> <span>Data Pasien</span></a></li>
      <li><a href="<?= base_url('admin/dokter'); ?>"><i class="fa fa-user-md"></i> <span>Data dokter</span></a></li>
      <li><a href="<?= base_url('admin/user_admin') ?>" class="active"><i class="fa  fa-buysellads"></i> <span>Data Admin</span></a></li>
 
      <li class="header">OTHER</li>
      <li><a href="<?= base_url('admin/informasi'); ?>"><i class="fa fa-bullhorn"></i> <span>Layanan Informasi</span></a></li>
      <li><a href="<?= base_url('admin/profile'); ?>"><i class="fa fa-user"></i> <span>Akun Profile</span></a></li>
      <li><a href="<?= base_url('admin/pengaturan'); ?>"><i class="fa fa-gear"></i> <span>Pengaturan</span></a></li>
      

<?php }elseif($this->session->userdata('level') == "Dokter"){ ?>

  <li class="">
          <a href="<?= base_url('dokter/home') ?>">
            <i class="fa fa-dashboard"></i> <span>Dasboard</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Home</small>
            </span>
          </a>
        </li>
        <li class="header">OLAH DATA</li>
 <li class="treeview"> 
      <li class="treeview">
          <a href="#">
            <i class="fa fa-stethoscope"></i> <span>Data Periksa</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu active">
          <li><a href="<?= base_url('dokter/periksa/antrian') ?>" class="active"><i class="fa fa-clock-o"></i> <span>Antrian Periksa </span></a></li>
          <li><a href="<?= base_url('dokter/periksa/sudah') ?>"><i class="fa fa-check-square-o"></i> <span>Sudah Diperiksa </span></a></li>
          <li><a href="<?= base_url('dokter/periksa/batal') ?>"><i class="fa fa-ban"></i> <span>Batal Diperiksa </span></a></li>
          </ul>
      </li>
      <li><a href="<?= base_url('dokter/pasien'); ?>"><i class="fa fa-users"></i> <span>Data Pasien</span></a></li>
      
  </li> 
  <li class="header">OTHER</li>
      <li><a href="<?= base_url('dokter/informasi'); ?>"><i class="fa fa-bullhorn"></i> <span>Layanan Informasi </span></a></li>
      <li><a href="<?= base_url('dokter/profile'); ?>"><i class="fa fa-user"></i> <span>Data Profile </span></a></li>
   </li> 

   <?php }elseif($this->session->userdata('level') == "Pasien"){ ?>

<li class="">
        <a href="<?= base_url('pasien/home') ?>">
          <i class="fa fa-dashboard"></i> <span>Dasboard</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green">Home</small>
          </span>
        </a>
      </li>
      <li class="header">OLAH DATA</li>
<li class="treeview"> 
    <li><a href="<?= base_url('pasien/periksa/buat_jadwal'); ?>"><i class="fa fa-calendar"></i> <span>Buat Jadwal</span></a></li>
    <li><a href="<?= base_url('pasien/periksa/riwayat'); ?>"><i class="fa fa-stethoscope"></i> <span>Data Riwayat</span></a></li>
    <li><a href="<?= base_url('pasien/profile'); ?>"><i class="fa fa-user"></i> <span>Data Profile </span></a>
    
</li> 
<li class="header">OTHER</li>
    <li><a href="<?= base_url('pasien/informasi'); ?>"><i class="fa fa-bullhorn"></i> <span>Layanan Informasi </span></a></li>
 </li> 
  
<?php } ?>
  <!-- logout -->
  <li> <a href="javascript:void(0)" onclick="keluar()"><i class="fa fa-sign-out"></i> <span>Sign out</span></a></li>
  <li class="header">END MAIN NAVIGATION</li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard |
        <small><?= $judul ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
        <li  class="active"><?= $judul ?></li>
      </ol>
    </section> 

    <!-- Main content -->
    <section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
			<div class="box box-success">
				<div class="box-header with-border">
              
