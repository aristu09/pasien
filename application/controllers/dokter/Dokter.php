<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Dokter extends CI_controller
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
	 if($this->session->userdata('Dokter') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('m_dokter');
	}

    //dokter
    public function index($value='')
    {
     $view = array('judul'     =>'Data Dokter',
                   'data'      =>$this->m_dokter->view(),);
      $this->load->view('dokter/dokter/form',$view);
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
    
     //mengambil id dokter urut terakhir
     private function id_dokter_urut($value='')
     {
      $this->m_dokter->id_urut();
      $query  = $this->db->get();
      $data   = $query->row_array();
      $id     = $data['id_dokter'];
      $urut   = substr($id, 1, 2);
      $tambah = (int) $urut + 1;
      
      if (strlen($tambah) == 1){
        $format = "D".$tambah;
      }else{
        $format = $tambah;
      }
      return $format;

      }

  //API add dokter
  public function api_add($value='')
  {
    $rules = array(
      array(
        'field' => 'nama',
        'label' => 'Nama Dokter',
        'rules' => 'required',
        'errors' => array(
            'required' => 'Nama Dokter tidak boleh kosong',
        ),
      ),
      array(
        'field' => 'no_hp',
        'label' => 'No HP',
        'rules' => 'required|numeric|is_unique[tb_dokter.no_hp]',
        'errors' => array(
            'required' => 'No HP tidak boleh kosong',
            'numeric' => 'No HP harus berupa angka',
            'is_unique' => 'No HP sudah terdaftar',
        ),
      ),
      array(
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'required|valid_email|is_unique[tb_dokter.email]',
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
        'id_dokter'       =>$this->id_dokter_urut(),
        'nama'            =>$this->input->post('nama'),
        'no_hp'           =>$this->input->post('no_hp'),
        'email'           =>$this->input->post('email'),
        'password'        =>md5($this->input->post('password')),
        'level'           =>'Dokter'
      ];
      if ($this->m_dokter->add($SQLinsert)) {
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

      //API edit dokter
      public function api_edit($id='', $SQLupdate='')
      {
        $rules = array(
          array(
            'field' => 'nama',
            'label' => 'Nama Dokter',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Nama Dokter tidak boleh kosong',
            ),
          ),
          array(
            'field' => 'no_hp',
            'label' => 'No HP',
            'rules' => 'required|numeric',
            'errors' => array(
                'required' => 'No HP tidak boleh kosong',
                'numeric' => 'No HP harus berupa angka',
            ),
          ),
          array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email',
            'errors' => array(
                'required' => 'Email tidak boleh kosong',
                'valid_email' => 'Email tidak valid',
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
          $SQLupdate = [
            'nama'            => $this->input->post('nama'),
            'no_hp'           => $this->input->post('no_hp'),
            'email'           => $this->input->post('email')
          ];
          if ($this->m_dokter->update($id, $SQLupdate)) {
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
          $SQLupdate = [
            'password'        => md5($this->input->post('password'))
          ];
          if ($this->m_dokter->update($id, $SQLupdate)) {
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
      
      //API hapus dokter
      public function api_hapus($id='')
      {
        if(empty($id)){
          $response = [
            'status' => false,
            'message' => 'Data kosong'
          ];
        }else{
          if ($this->m_dokter->delete($id)) {
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
	
}