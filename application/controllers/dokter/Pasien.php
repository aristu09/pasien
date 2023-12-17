<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Pasien extends CI_controller
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
   $this->load->model('m_pasien');
	}

    //pasien
    public function index($value='')
    {
        $data['judul'] = 'Data Pasien';
        $data['data'] = $this->m_pasien->view()->result_array();

        // Mendekripsi data sebelum ditampilkan di view
        $vigenere = new Vigenere();
        $vigenere->setKey('kassandra'); // Ganti 'kassandra' dengan kunci enkripsi yang Anda gunakan

        foreach ($data['data'] as &$row) {
            $row['nama'] = $vigenere->decrypt($row['nama']);
            $row['no_hp'] = $vigenere->decrypt($row['no_hp']);
            $row['alamat'] = $vigenere->decrypt($row['alamat']);
            $row['nama_suami'] = $vigenere->decrypt($row['nama_suami']);
            $row['email'] = $vigenere->decrypt($row['email']);
            $row['tgl_lahir'] = $vigenere->decrypt($row['tgl_lahir']);
            // ...

            // Jika ada kolom lain yang perlu dideskripsi, tambahkan langkah dekripsi di sini
        }

        $this->load->view('dokter/pasien/form', $data);
    }

      
      //API hapus data dari database dan folder
      // public function api_hapus($id='')
      // {
      //   if (empty($id)) {
      //     $response = [
      //       'status' => false,
      //       'message' => 'Tidak ada data'
      //     ];
      //   } else {
      //     $data = $this->m_pasien->view_id($id)->row_array();
      //     if ($this->m_pasien->delete($id)) {
      //       unlink('./themes/bukti_ktp/'.$data['bukti_ktp']);
      //       $response = [
      //         'status' => true,
      //         'message' => 'Berhasil menghapus data'
      //       ];
      //     } else {
      //       $response = [
      //         'status' => false,
      //         'message' => 'Gagal menghapus data'
      //       ];
      //     }
      //   }
      //   $this->output
      //     ->set_content_type('application/json')
      //     ->set_output(json_encode($response));
      // }

	
}