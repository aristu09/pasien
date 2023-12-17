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
	 if($this->session->userdata('admin') != TRUE){
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

        $this->load->view('admin/pasien/form', $data);
    }


    private function acak_id($panjang)
    {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter{$pos};
        }
        return $string;
    }
    
     //mengambil id pasien urut terakhir
     private function id_pasien_urut($value='')
     {
      $this->m_pasien->id_urut();
      $query  = $this->db->get();
      $data   = $query->row_array();
      $id     = $data['id_pasien'];
      $urut   = substr($id, 1, 3);
      $tambah = (int) $urut + 1;
      $karakter = $this->acak_id(2);
      
      if (strlen($tambah) == 1){
      $newID = "P"."00".$tambah.$karakter;
         }else if (strlen($tambah) == 2){
         $newID = "P"."0".$tambah.$karakter;
            }else (strlen($tambah) == 3){
            $newID = "P".$tambah.$karakter
              };
       return $newID;
     }

  //API add pasien
  public function api_add($value='')
  {
    $rules = array(
      array(
        'field' => 'nama',
        'label' => 'Nama Pasien',
        'rules' => 'required',
        'errors' => array(
            'required' => 'Nama Pasien tidak boleh kosong',
        ),
      ),
      array(
        'field' => 'no_hp',
        'label' => 'No HP',
        'rules' => 'required|numeric|is_unique[tb_pasien.no_hp]',
        'errors' => array(
            'required' => 'No HP tidak boleh kosong',
            'numeric' => 'No HP harus berupa angka',
            'is_unique' => 'No HP sudah terdaftar',
        ),
      ),
      array(
        'field' => 'alamat',
        'label' => 'Alamat',
        'rules' => 'required',
        'errors' => array(
            'required' => 'Alamat tidak boleh kosong',
        ),
      ),
      array(
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'required|valid_email|is_unique[tb_pasien.email]',
        'errors' => array(
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Email tidak valid',
            'is_unique' => 'Email sudah terdaftar',
        ),
      ),
    );
    $this->form_validation->set_rules($rules);
    if ($this->form_validation->run() == FALSE) {
      $response = [
        'status' => false,
        'message' => 'Tidak ada data'
      ];
    } else {
      $SQLinsert = [
        'id_pasien'           =>$this->id_pasien_urut(),
        'nama'                =>$this->input->post('nama'),
        'no_hp'               =>$this->input->post('no_hp'),
        'alamat'              =>$this->input->post('alamat'),
        'tgl_lahir'           =>$this->input->post('tgl_lahir'),
        'nama_suami'          =>$this->input->post('nama_suami'),
        'email'               =>$this->input->post('email'),
        'password'            =>md5($this->input->post('password')),
      ];
      if ($this->m_pasien->add($SQLinsert)) {
        $response = [
          'status' => true,
          'message' => 'Berhasil menambahkan data'
        ];
      } else {
        $response = [
          'status' => false,
          'message' => 'Gagal menambahkan data'
        ];
      }
  }
  
  $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
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
            'field' => 'no_hp',
            'label' => 'no_hp',
            'rules' => 'required'
          ),
          array(
            'field' => 'alamat',
            'label' => 'alamat',
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
            $nama    = $this->input->post('nama');
            $no_hp   = $this->input->post('no_hp');
            $alamat  = $this->input->post('alamat');
            $nama_suami  = $this->input->post('nama_suami');
            $email   = $this->input->post('email');
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
            'nama'                => $encryptedNama,
            'no_hp'               => $encryptedNoHp,
            'alamat'              => $encryptedAlamat,
            'tgl_lahir'           => $encryptedTglLahir,
            'nama_suami'          => $encryptedNamaSuami,
            'email'               => $encryptedEmail,
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

      public function api_hapus($id='')
      {
        if(empty($id)){
          $response = [
            'status' => false,
            'message' => 'Data kosong'
          ];
        }else{
          if ($this->m_pasien->delete($id)) {
            $response = [
              'status' => true,
              'message' => 'Berhasil menghapus data'
            ];
          } else {
            $response = [
              'status' => false,
              'message' => 'Gagal menghapus data'
            ];
          }
        }
        $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($response));
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