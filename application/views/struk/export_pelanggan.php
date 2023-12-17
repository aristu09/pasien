<?php
    //Mulai Sesion
    session_start();
    if (isset($_SESSION["ses_username"])==""){
		header("location: landingpage.php", true, 301);
    
    }else{
      $data_id = $_SESSION["ses_id"];
      $data_nama = $_SESSION["ses_nama"];
      $data_user = $_SESSION["ses_username"];
      $data_level = $_SESSION["ses_level"];
    }

	include "inc/koneksi.php";
	include "inc/rupiah.php";

	$sql = $koneksi->query("SELECT count(id_paket) as paket from tb_paket");
	while ($data= $sql->fetch_assoc()) {
	
		$paket=$data['paket'];
	}

	$sql = $koneksi->query("SELECT count(id_pelanggan) as huni from tb_pelanggan");
	while ($data= $sql->fetch_assoc()) {
	
		$huni=$data['huni'];
	}

	$sql = $koneksi->query("SELECT count(id_tagihan) as tagih_b from tb_tagihan where status='BL'");
	while ($data= $sql->fetch_assoc()) {
	
		$tagih=$data['tagih_b'];
	}

	$sql = $koneksi->query("SELECT count(id_tagihan) as tagih_l from tb_tagihan where status='LS'");
	while ($data= $sql->fetch_assoc()) {
	
		$lunas=$data['tagih_l'];
	}

	$sql = $koneksi->query("SELECT count(id_tagihan_lain) as tagihL_b from tb_tagihan_lain where status='BL'");
	while ($data= $sql->fetch_assoc()) {
	
		$tagihL=$data['tagihL_b'];
	}

	$sql = $koneksi->query("SELECT count(id_tagihan_lain) as tagihL_l from tb_tagihan_lain where status='LS'");
	while ($data= $sql->fetch_assoc()) {
	
		$lunasL=$data['tagihL_l'];
	}

	$sql = $koneksi->query("SELECT count(id_pengeluaran) as tagihP_b from tb_pengeluaran where keterangan='Belum Saya Bayar'");
	while ($data= $sql->fetch_assoc()) {
	
		$tagihP=$data['tagihP_b'];
	}

	$sql = $koneksi->query("SELECT count(id_pengeluaran) as tagihP_l from tb_pengeluaran where keterangan='LUNAS'");
	while ($data= $sql->fetch_assoc()) {
	
		$lunasPL=$data['tagihP_l'];
	}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="wifi kassandra my id, kassandra my id, kassandra, kassandra hd production, KASSANDRA, KASSANDRA HD PRODUCTION">
    <meta name="description" content="Layanan hotspot wifi unlimited 24 jam non stop tanpa lemot kecuali saat wifi down">
 	<meta name="author" content="KASSANDRA, KASSANDRA HD PRODUCTION">
    <meta content='index,follow' name='robots'/>
	<title>KASSANDRA WIFI</title>
	<link rel="shortcut icon" href="dist/img/favicon.ico" type="image/x-icon">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="plugins/select2/select2.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>

<body class="hold-transition skin-purple sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="index.php" class="logo">
				<span class="logo-lg">
					<marquee>
						<b>KASSANDRA WIFI</b>
					</marquee>
				</span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

					<div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
           <img src="dist/img/komp.png" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $data_nama; ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="dist/img/komp.png" class="img-circle" alt="User Image">

              <p>
                <?php echo $data_nama; ?><br>
                <span class="label label-warning">
                <?php echo $data_level; ?>
                </span>
                
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="?page=MyApp/data_pengguna" data-toggle="modal" class="btn btn-default btn-flat" id="admin_profile"><i class="fa fa-user"></i> Perbarui</a>
              </div>
              <div class="pull-right">
                <a href="logout.php" class="btn btn-default btn-flat" onclick="return confirm('Anda yakin keluar dari aplikasi ? Setelah keluar, Anda harus masuk lagi untuk mengakses fitur-fitur dalam aplikasi KassandraWiFi')"><i class="fa fa-sign-out"></i> Keluar</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    
			</nav>
		</header>

		<!-- =============================================== -->

		<!-- Left side column. contains the sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="dist/img/komp.png" class="" alt="User Image">
					</div>
					<div class="pull-left info">
						<p>
							<?php echo $data_nama; ?>
						</p>
						<span class="label label-warning">
							<?php echo $data_level; ?>
						</span><br>
						
					</div>
				</div>
				<!-- /.search form -->
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">
					<HR/>

					<!-- Level  -->
					<?php
          if ($data_level=="Administrator"){
        ?>

        <li class="header">HOME</li>

					<li class="treeview">
						<a href="?page=admin">
							<i class="fa fa-home"></i>
							<span>Dashboard</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<li class="header">OLAH DATA</li>

					<li class="treeview">
						<a href="?page=data-paket">
							<i class="fa fa-send"></i>
							<span>Data Paket</span>
							<span class="pull-right-container">
							<span class="label pull-right bg-blue"><?= $paket; ?></span>
							</span>
						</a>
					</li>


					<li class="treeview">
						<a href="?page=data-pelanggan">
							<i class="fa fa-users"></i>
							<span>Data Pelanggan</span>
							<span class="pull-right-container">
							<span class="label pull-right bg-yellow"><?= $huni; ?></span>
							</span>
						</a>
					</li>

					<li class="header">TAGIHAN & PEMBAYARAN</li>

					<li class="treeview">
						<a href="?page=buat-tagihan">
							<i class="fa fa-edit"></i>
							<span>Buat Tagihan</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="?page=buka-tagihan">
							<i class="fa fa-table"></i>
							<span>Data Tagihan</span>
							<span class="pull-right-container">
							<span class="label pull-right bg-red"><?= $tagih; ?></span>
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="?page=lunas-tagihan">
							<i class="fa fa-money"></i>
							<span>Pembayaran Lunas</span>
							<span class="pull-right-container">
							<span class="label pull-right bg-green"><?= $lunas; ?></span>
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="?page=data-tagihan-lain">
							<i class="fa fa-calculator"></i>
							<span>Tagihan lainnya</span>
							<span class="pull-right-container">
							<span class="label pull-right bg-green"><?= $lunasL; ?></span>
							<span class="label pull-right bg-red"><?= $tagihL; ?></span>
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="?page=data-pengeluaran">
							<i class="fa fa-dollar"></i>
							<span>Pengeluaran</span>
							<span class="pull-right-container">
							<span class="label pull-right bg-blue"><?= $lunasPL; ?></span>
							<span class="label pull-right bg-red"><?= $tagihP; ?></span>
							</span>
						</a>
					</li>

					<li class="header">OTHER</li>

					<li class="treeview">
						<a href="?page=data-feedback">
							<i class="fa fa-caret-square-o-up"></i>
							<span>Feedback Pelanggan</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="?page=data-promo">
							<i class="fa fa-whatsapp"></i>
							<span>Pendaftar Promo</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="?page=data-informasi">
							<i class="fa fa-bullhorn"></i>
							<span>Layanan Informasi</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="?page=monitor-jaringan">
							<i class="fa fa-rss"></i>
							<span>Monitor Server Jaringan</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="?page=kirim-email">
							<i class="fa fa-envelope"></i>
							<span>Kirim Email</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="?page=MyApp/data_pengguna">
							<i class="fa fa-user"></i>
							<span>Admin Sistem</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="?page=backup-data">
							<i class="fa fa-database"></i>
							<span>Backup Data</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>

					<?php
					} 
					?>

					<li>
						<a href="logout.php" onclick="return confirm('Anda yakin keluar dari aplikasi ? Setelah keluar, Anda harus masuk lagi untuk mengakses fitur-fitur dalam aplikasi KassandraWiFi')">
							<i class="fa fa-sign-out"></i>
							<span>Logout</span>
							<span class="pull-right-container"></span>
						</a>
					</li>


			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<!-- Main content -->
			<section class="content">
				<?php 
      if(isset($_GET['page'])){
          $hal = $_GET['page'];
  
          switch ($hal) {
              //Klik Halaman Home Pengguna
              case 'admin':
                  include "home/admin.php";
                  break;
        
              //Pengguna
              case 'MyApp/data_pengguna':
                  include "admin/pengguna/data_pengguna.php";
                  break;
              case 'MyApp/add_pengguna':
                  include "admin/pengguna/add_pengguna.php";
                  break;
              case 'MyApp/edit_pengguna':
                  include "admin/pengguna/edit_pengguna.php";
                  break;
              case 'MyApp/del_pengguna':
                  include "admin/pengguna/del_pengguna.php";
				  break;

			//paket_data
              case 'data-paket':
                  include "admin/paket/data_paket.php";
                  break;
              case 'add-paket':
                  include "admin/paket/add_paket.php";
                  break;
              case 'edit-paket':
                  include "admin/paket/edit_paket.php";
                  break;
              case 'del-paket':
                  include "admin/paket/del_paket.php";
				  break;

			//data_pelanggan
              case 'data-pelanggan':
                  include "admin/pelanggan/data_pelanggan.php";
                  break;
              case 'add-pelanggan':
                  include "admin/pelanggan/add_pelanggan.php";
                  break;
              case 'edit-pelanggan':
                  include "admin/pelanggan/edit_pelanggan.php";
                  break;
              case 'del-pelanggan':
                  include "admin/pelanggan/del_pelanggan.php";
				  break;

			//data_tagihan
            case 'data-tagihan':
                  include "admin/tagihan/data_tagihan.php";
                  break;
            case 'buat-tagihan':
                include "admin/tagihan/buat_tagihan.php";
				break;
			case 'buat-tagihan-khusus':
                include "admin/tagihan/add_tagihan_khusus.php";
				break;
			case 'buka-tagihan':
                include "admin/tagihan/buka_tagihan.php";
				break;
			case 'bayar-tagihan':
                include "admin/tagihan/bayar_tagihan.php";
				break;
			case 'lunas-tagihan':
                include "admin/tagihan/lunas_tagihan.php";
                break;
            case 'del-tagihan':
                include "admin/tagihan/del_tagihan.php";
                break;
            case 'edit-tagihanBL':
                include "admin/tagihan/edit_tagihanBL.php";
                break;
			case 'edit-tagihanL':
				include "admin/tagihan/edit_tagihanL.php";
				break;


      		//data_pengeluaran
              case 'data-pengeluaran':
                  include "admin/pengeluaran/data_pengeluaran.php";
                  break;
              case 'add-pengeluaran':
                  include "admin/pengeluaran/add_pengeluaran.php";
                  break;
              case 'edit-pengeluaran':
                  include "admin/pengeluaran/edit_pengeluaran.php";
                  break;
              case 'del-pengeluaran':
                  include "admin/pengeluaran/del_pengeluaran.php";
				  break;

			//data_tagihan_lain
              case 'data-tagihan-lain':
                  include "admin/tagihan-lain/data_tagihan-lain.php";
                  break;
              case 'buat-tagihan-lain':
                  include "admin/tagihan-lain/add_tagihan_lain.php";
				  break;
			  case 'buka-tagihan':
                  include "admin/tagihan/buka_tagihan.php";
				  break;
			  case 'bayar-tagihan':
                  include "admin/tagihan/bayar_tagihan.php";
				  break;
			  case 'lunas-tagihan':
                  include "admin/tagihan/lunas_tagihan.php";
                  break;
              case 'del-tagihan-lain':
                  include "admin/tagihan-lain/del_tagihan-lain.php";
                  break;
              case 'edit-tagihan-lain':
                  include "admin/tagihan-lain/edit_tagihan-lain.php";
                  break;

				  //data_informasi
              case 'data-informasi':
                  include "admin/informasi/data_informasi.php";
                  break;
              case 'add-informasi':
                  include "admin/informasi/add_informasi.php";
                  break;
              case 'edit-informasi':
                  include "admin/informasi/edit_informasi.php";
                  break;
              case 'del-informasi':
                  include "admin/informasi/del_informasi.php";
				  break;
			  case 'upload-file':
                  include "admin/informasi/uploadfile.php";
				  break;

				//data_promo
              case 'data-promo':
                  include "admin/promo/data_promo.php";
                  break;
			case 'status-promo':
                  include "admin/promo/status_promo.php";
                  break;
              case 'add-promo':
                  include "admin/promo/add_promo.php";
                  break;
              case 'edit-promo':
                  include "admin/promo/edit_promo.php";
                  break;
              case 'del-promo':
                  include "admin/promo/del_promo.php";
				  break;

				//data_feedback
              case 'data-feedback':
                  include "admin/feedback/data_feedback.php";
                  break;
              case 'add-feedback':
                  include "admin/feedback/add_feedback.php";
                  break;
              case 'edit-feedback':
                  include "admin/feedback/edit_feedback.php";
                  break;
              case 'del-feedback':
                  include "admin/feedback/del_feedback.php";
				break;

		 //monitor_jaringan
		 	case 'monitor-jaringan':
				 include "admin/monitor-jaringan/monitor_jaringan.php";
			  	 break;
			case 'kirim-email':
				 include "admin/kirim-email/kirim_email.php";
			   	break;
			case 'kirim-email-umum':
				include "admin/kirim-email/kirim_email_umum.php";
			    break;
			case 'kirim-email-semua':
				include "admin/kirim-email/kirim_email_semua.php";
			    break;
			case 'del-file-email':
				include "admin/kirim-email/del_file_email.php";
			    break;

			//backup_data
			case 'backup-data':
				include "admin/backup-data/backup_data.php";
				break;
			case 'restore-data':
				include "admin/backup-data/restore_data.php";
				break;

              //default
              default:
				  include "home/not_found.php";
                  break;    
          }
      }else{
        // Auto Halaman Home Pengguna
          if($data_level=="Administrator"){
              include "home/admin.php";
              }
            }
    		?>



			</section>
			<!-- /.content -->
		</div>

		<!-- /.content-wrapper -->

		<?php
		include "inc/footer.php";
		?>
		<div class="control-sidebar-bg"></div>

		<!-- ./wrapper -->

		<!-- jQuery 2.2.3 -->
		<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
		<!-- Bootstrap 3.3.6 -->
		<script src="bootstrap/js/bootstrap.min.js"></script>

		<script src="plugins/select2/select2.full.min.js"></script>
		<!-- DataTables -->
		<script src="plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

		<!-- AdminLTE App -->
		<script src="dist/js/app.min.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="dist/js/demo.js"></script>
		<!-- page script -->


		<script>
			$(function() {
				$("#example1").DataTable();
				$('#example2').DataTable({
					"paging": true,
					"lengthChange": false,
					"searching": false,
					"ordering": true,
					"info": true,
					"autoWidth": false
				});
			});
		</script>

		<script>
			$(function() {
				//Initialize Select2 Elements
				$(".select2").select2();
			});
		</script>
</body>

</html>