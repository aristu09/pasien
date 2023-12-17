<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Informasi extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
     $this->load->helper('url');
      // needed ???
      $this->load->database();
      $this->load->library('session');
      $this->load->library('form_validation');
      $this->load->library('Vigenere');
      
	 // error_reporting(0);
	 if($this->session->userdata('Pasien') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('m_informasi');
	}

    //informasi
    public function index($value='')
    {
     $view = array('judul'     =>'Informasi',
                   'data'      =>$this->m_informasi->view(),);
      $this->load->view('pasien/informasi',$view);
    }

	
}