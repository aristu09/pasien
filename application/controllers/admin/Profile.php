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
	 // error_reporting(0);
	 if($this->session->userdata('admin') != TRUE){
    redirect(base_url(''));
     exit;
	};
   $this->load->model('m_admin'); 
}


  public function index($id='')
  {

  $data=$this->m_admin->view_id_admin($id)->row_array();
  $x = array(
    'aksi'            =>'lihat',
    'judul'           =>'Data Akun Profile',
    'id_admin'       =>$data['id_admin'],
    'nama'            =>$data['nama'],
    'no_hp'           =>$data['no_hp'],
    'email'           =>$data['email'],
    'password'        =>$data['password'],
  );
    $this->load->view('admin/user/profile',$x);
  }

  //API edit admin
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
      $SQLupdate = [
        'nama'            => $this->input->post('nama'),
        'no_hp'           => $this->input->post('no_hp'),
        'email'           => $this->input->post('email')
      ];
      if ($this->m_admin->update($id, $SQLupdate)) {
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
      if ($this->m_admin->update($id, $SQLupdate)) {
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