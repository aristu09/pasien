<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Periksa extends CI_controller
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
   $this->load->model('m_periksa');
   $this->load->model('m_pasien');
	}

    //antrian
    public function antrian($tgl='')
    {
      if (isset($_POST['cari'])) {
        //cek data apabila berhasi Di kirim maka postdata akan melakukan cek .... dan sebaliknya
        $tgl = $this->input->post('tgl');
        $data['judul'] = 'Data Antrian Perlu Verifikasi';
        $data['aksi']  = 'antrian';
        $data['data']  = $this->m_periksa->viewAntrian($tgl)->result_array();
         // Mendekripsi data sebelum ditampilkan di view
       $vigenere = new Vigenere();
       $vigenere->setKey('kassandra'); // Ganti 'kassandra' dengan kunci enkripsi yang Anda gunakan
       foreach ($data['data'] as $key => $value) {
        $data['data'][$key]['nama'] = $vigenere->decrypt($value['nama']);
        $data['data'][$key]['nama_suami'] = $vigenere->decrypt($value['nama_suami']);
        $data['data'][$key]['keluhan'] = $vigenere->decrypt($value['keluhan']);
        $data['data'][$key]['catatan'] = $vigenere->decrypt($value['catatan']);
        $data['data'][$key]['mens_terakhir'] = $vigenere->decrypt($value['mens_terakhir']);
       }

        $data['tgl']   = $tgl;
        $data['depan'] = FALSE;
        
        $this->load->view('dokter/periksa/form',$data);
      }else{
      $view = array('judul'     =>'Buka Data Antrian',
                    'aksi'      =>'antrian',
                    'depan'    =>TRUE,
                    );
      $this->load->view('dokter/periksa/form',$view);
      }
    }


    //antrian
    public function sudah($value='')
    {
      $data['judul'] = 'Sudah Diperiksa';
      $data['aksi']  = 'sudah';
      $data['data']  = $this->m_periksa->viewSudah()->result_array();
       // Mendekripsi data sebelum ditampilkan di view
       $vigenere = new Vigenere();
       $vigenere->setKey('kassandra'); // Ganti 'kassandra' dengan kunci enkripsi yang Anda gunakan
       foreach ($data['data'] as $key => $value) {
        $data['data'][$key]['nama'] = $vigenere->decrypt($value['nama']);
        $data['data'][$key]['nama_suami'] = $vigenere->decrypt($value['nama_suami']);
        $data['data'][$key]['keluhan'] = $vigenere->decrypt($value['keluhan']);
        $data['data'][$key]['catatan'] = $vigenere->decrypt($value['catatan']);
        $data['data'][$key]['mens_terakhir'] = $vigenere->decrypt($value['mens_terakhir']);
       }

      $this->load->view('dokter/periksa/form',$data);
    }

    //antrian
    public function batal($value='')
    {
      $data['judul'] = 'Batal Diperiksa';
      $data['aksi']  = 'batal';
      $data['data']  = $this->m_periksa->viewBatal()->result_array();
       // Mendekripsi data sebelum ditampilkan di view
       $vigenere = new Vigenere();
       $vigenere->setKey('kassandra'); // Ganti 'kassandra' dengan kunci enkripsi yang Anda gunakan
       foreach ($data['data'] as $key => $value) {
           $data['data'][$key]['nama'] = $vigenere->decrypt($value['nama']);
           $data['data'][$key]['nama_suami'] = $vigenere->decrypt($value['nama_suami']);
           $data['data'][$key]['keluhan'] = $vigenere->decrypt($value['keluhan']);
           $data['data'][$key]['catatan'] = $vigenere->decrypt($value['catatan']);
           $data['data'][$key]['mens_terakhir'] = $vigenere->decrypt($value['mens_terakhir']);
       }

      $this->load->view('dokter/periksa/form',$data);
    }


    private function waktu($value='')
    {
      //gmt +7
      date_default_timezone_set('Asia/Jakarta');
      $waktu = date('H:i:s');
      return $waktu;
    }

    //API edit pasien
    public function sudah_periksa($id='', $SQLupdate='')
    {
      $rules = array(
        array(
          'field' => 'catatan',
          'label' => 'catatan',
          'rules' => 'required'
        )
      );
      $this->form_validation->set_rules($rules);
      if ($this->form_validation->run() == FALSE) {
        $response = [
          'status' => false,
          'message' => 'Tidak ada data'
        ];
      } else {

        $catatan = $this->input->post('catatan');
        //mengenkrpsi data dengan vigenere
        $vigenere = new Vigenere();
        $vigenere->setKey('kassandra'); // Ganti 'kassandra' dengan kunci enkripsi yang Anda inginkan
        $encryptedCatatan = $vigenere->encrypt($catatan);

        $SQLupdate = [
          'catatan'                   =>$encryptedCatatan,
          'status'                    =>'S',
          'waktu_keluar'              =>$this->waktu()
        ];
        if ($this->m_periksa->update($id, $SQLupdate)) {
          $response = [
            'status' => true,
            'message' => 'Berhasil mengubah data'
          ];
        } else {
          $response = [
            'status' => false,
            'message' => 'Gagal mengubah data'
          ];
        }
      }
      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
    }
	
}