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
	 if($this->session->userdata('Dokter') != TRUE){
     redirect(base_url(''));
     exit;
	};
	 $this->load->model('M_dokter');
	 $this->load->model('m_periksa');
	 $this->load->model('m_count');
	}

	public function index($id='')
	{
		$data=$this->m_periksa->viewAntrian($id)->row_array();
		$data['data'] = $this->m_periksa->viewAntrianPasien($tgl=date('Y-m-d'))->result_array();

        // Mendekripsi data sebelum ditampilkan di view
        $vigenere = new Vigenere();
        $vigenere->setKey('kassandra'); // Ganti 'kassandra' dengan kunci enkripsi yang Anda gunakan

        foreach ($data['data'] as &$row) {
            $row['nama'] = $vigenere->decrypt($row['nama']);
            $row['no_hp'] = $vigenere->decrypt($row['no_hp']);
            $row['alamat'] = $vigenere->decrypt($row['alamat']);
            $row['nama_suami'] = $vigenere->decrypt($row['nama_suami']);
            $row['email'] = $vigenere->decrypt($row['email']);
            // ...

            // Jika ada kolom lain yang perlu dideskripsi, tambahkan langkah dekripsi di sini
        }

	 $view = array(
        'judul'            	=>'Halaman Administrator',
        'admin'          	=> $this->db->get_where('tb_admin')->num_rows(),
        'dokter'          	=> $this->db->get('tb_dokter')->num_rows(),
		'count_periksa'    	=> $this->m_count->count_periksa($tgl=date('Y-m-d')),
        'pasien'           	=> $this->m_periksa->namaAntrian($tgl=date('Y-m-d'))->result_array(),
        'antrian_p'        	=> $data['data'],
		'lama_antrian'     	=> $this->db->get_where('tb_periksa', ['tgl_periksa' => date('Y-m-d'), 'waktu_keluar !=' => null, 'status' => 'S']),

     );
	 $this->load->view('admin/home',$view);
	}

	
}