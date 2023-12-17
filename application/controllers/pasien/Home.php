<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Home extends CI_controller
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
   $this->load->model('m_periksa');
   $this->load->model('m_informasi');
   $this->load->model('m_count');
   $this->load->model('m_pengaturan');
    
}

	public function index($id='')
  {
   $data=$this->m_periksa->view_id_periksa($id)->row_array();
   $data2 = $this->m_pengaturan->view()->row_array();

   $view['judul'] = 'Halaman pasien';
   $view['count_periksa'] = $this->m_count->count_periksa($tgl=date('Y-m-d'));
   $view['lama_antrian'] = $this->db->get_where('tb_periksa', ['tgl_periksa' => $tgl=date('Y-m-d'), 'waktu_keluar !=' => null, 'status' => 'S']);
   $view['pasien'] = $this->m_periksa->namaAntrian($tgl=date('Y-m-d'))->result_array();
   $view['tgl_periksa'] = $this->m_periksa->view_id_periksa($id)->row_array()['tgl_periksa'];
   $view['id_pasien'] = $this->m_periksa->view_id_periksa($id)->row_array()['id_pasien'];
   $view['status'] = $data['status'];
   $view['uuid'] = $data['uuid'];

   
      $view['antrian_p'] = $this->m_periksa->viewAntrianPasien($tgl=date('Y-m-d'))->result_array();
      $vigenere = new Vigenere();
      $vigenere->setKey('kassandra'); // Ganti 'kassandra' dengan kunci enkripsi yang Anda gunakan
      foreach ($view['antrian_p'] as $key => $value) {
          $view['antrian_p'][$key]['nama'] = $vigenere->decrypt($value['nama']);
          $view['antrian_p'][$key]['nama_suami'] = $vigenere->decrypt($value['nama_suami']);
          $view['antrian_p'][$key]['keluhan'] = $vigenere->decrypt($value['keluhan']);
          $view['antrian_p'][$key]['catatan'] = $vigenere->decrypt($value['catatan']);
          $view['antrian_p'][$key]['mens_terakhir'] = $vigenere->decrypt($value['mens_terakhir']);
      }
      
      $view['akses'] = $data2['akses_pendaftaran'];
      $view['jdwl_praktek'] = $data2['jdwl_praktek'];
      $view['jam_praktek'] = $data2['jam_praktek'];
      $view['jdwl_pendaftaran'] = $data2['jdwl_pendaftaran'];


	 $this->load->view('pasien/home',$view);
	}

	
}