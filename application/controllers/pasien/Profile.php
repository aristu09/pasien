<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Profile extends CI_controller
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
   $this->load->model('m_pasien'); 
}


  public function index($id='')
  {

  $data=$this->m_pasien->view_id_pasien($id)->row_array();
  // Mendekripsi data menggunakan Vigenere
  $vigenere = new Vigenere();
  $vigenere->setKey('kassandra'); // Ganti 'kassandra' dengan kunci enkripsi yang Anda inginkan
  $data['nama'] = $vigenere->decrypt($data['nama']);
  $data['no_hp'] = $vigenere->decrypt($data['no_hp']);
  $data['alamat'] = $vigenere->decrypt($data['alamat']);
  $data['nama_suami'] = $vigenere->decrypt($data['nama_suami']);
  $data['email'] = $vigenere->decrypt($data['email']);
  $data['password'] = $vigenere->decrypt($data['password']);
  $data['tgl_lahir'] = $vigenere->decrypt($data['tgl_lahir']);
  
  $x = array(
    'aksi'            =>'lihat',
    'judul'           =>'Data Akun Profile',
    'id_pasien'       =>$data['id_pasien'],
    'nama'            =>$data['nama'],
    'no_hp'           =>$data['no_hp'],
    'alamat'          =>$data['alamat'],
    'tgl_lahir'       =>$data['tgl_lahir'],
    'nama_suami'      =>$data['nama_suami'],
    'email'           =>$data['email'],
    'password'        =>$data['password'],
  );
    $this->load->view('pasien/profile',$x);
  }

  //API edit pasien
  public function api_edit($id='', $SQLupdate='')
  {
    $rules = array(
      array(
        'field' => 'nama',
        'label' => 'nama',
        'rules' => 'required'
      ),
      array(
        'field' => 'email',
        'label' => 'email',
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
        $nama        = $this->input->post('nama');
        $no_hp       = $this->input->post('no_hp');
        $alamat      = $this->input->post('alamat');
        $nama_suami  = $this->input->post('nama_suami');
        $email       = $this->input->post('email');
        $tgl_lahir    = $this->input->post('tgl_lahir');
        $tgl_lahir    = date('d F Y', strtotime($tgl_lahir));

        // Mengenkripsi data menggunakan Vigenere
        $vigenere = new Vigenere();
        $vigenere->setKey('kassandra'); // Ganti 'kassandra' dengan kunci enkripsi yang Anda inginkan
        $encryptedNama = $vigenere->encrypt($nama);
        $encryptedNoHp = $vigenere->encrypt($no_hp);
        $encryptedAlamat = $vigenere->encrypt($alamat);
        $encryptedNamaSuami = $vigenere->encrypt($nama_suami);
        $encryptedEmail = $vigenere->encrypt($email);
        $encryptedTglLahir = $vigenere->encrypt($tgl_lahir);

      $SQLupdate = [
        'nama'            => $encryptedNama,
        'no_hp'           => $encryptedNoHp,
        'alamat'          => $encryptedAlamat,
        'tgl_lahir'       => $encryptedTglLahir,
        'nama_suami'      => $encryptedNamaSuami,
        'email'           => $encryptedEmail
      ];
      if ($this->m_pasien->update($id, $SQLupdate)) {
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

  //API edit password
  public function api_password($id='', $SQLupdate='')
  {
    $rules = array(
      array(
        'field' => 'password',
        'label' => 'password',
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
        $password        = $this->input->post('password');

        $vigenere = new Vigenere();
        $vigenere->setKey('kassandra'); // Ganti 'kassandra' dengan kunci enkripsi yang Anda inginkan
        $encryptedPassword = $vigenere->encrypt($password);
      
      $SQLupdate = [
        'password'        => $encryptedPassword
      ];
      if ($this->m_pasien->update($id, $SQLupdate)) {
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