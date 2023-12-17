<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Verifikasi extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
     $this->load->helper('url');
      // needed ???
      $this->load->database();
      $this->load->library('session');
	  $this->load->library('form_validation');
      
	 // error_reporting(0);
	 if($this->session->userdata('admin') != TRUE){
     redirect(base_url(''));
     exit;
	};
	 $this->load->model('m_periksa');

	}

	public function index()
	{
	 $view = array(
        'judul'            	=>'Halaman Verifikasi QRcode',
	 );

	 $this->load->view('admin/verifikasi',$view);
	}

	//membaca qrcode dari webcam dan mengubah status periksa
	public function scan($qr='') {
		if(empty($qr)){
		  $response = [
			'status' => false,
			'message' => 'Tidak ada data yang dipilih'
		  ];
		}else{
		  $SQLupdate=array(
			'status'                    =>'ANTRI'
		  );
		  $cek=$this->m_periksa->verifikasi($uuid=$qr,$SQLupdate);
		  if($cek){
			$response = [
			  'status' => true,
			  'message' => 'Berhasil'
			];
			//mengirim email ke pelanggan dengan phpmailer
			//dibawahini untuk script phpmailer
		  }else{
			$response = [
			  'status' => false,
			  'message' => 'Gagal'
			];
		  }
		}
		echo json_encode($response);
	  }


	
}