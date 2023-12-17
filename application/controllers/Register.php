<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Register extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        // needed ???
        $this->load->database();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('Vigenere');
        // error_reporting(0);

        $this->load->model('m_pengaturan');
        $this->load->model('m_informasi');
        $this->load->model('m_pasien');
    }

    //peserta
    public function index($value='')
    {
     $data = $this->m_pengaturan->view()->row_array();
     $info = $this->m_informasi->view()->row_array();
     $view = array('judul'              =>$data['nama_judul'],
                    'nama_judul'        =>$data['nama_judul'],
                    'meta_keywords'     =>$data['meta_keywords'],
                    'meta_description'  =>$data['meta_description'],
                    'jdwl_praktek'      =>$data['jdwl_praktek'],
                    'jam_praktek'       =>$data['jam_praktek'],
                    'akses_pendaftaran' =>$data['akses_pendaftaran'],
                    'logo'              =>$data['logo'],
                    'title'             =>$info['title'],
                    'informasi'         =>$info['informasi'],
                    'file_informasi'    =>$info['file_informasi'],
                   
                );

      $this->load->view('landingpage/register',$view);
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

     public function add()
     {
      $data = $this->m_pengaturan->view()->row_array();
      $view = array('judul'              =>$data['nama_judul'],
                     'nama_judul'        =>$data['nama_judul'],
                     'meta_keywords'     =>$data['meta_keywords'],
                     'meta_description'  =>$data['meta_description'],
                     'jdwl_praktek'      =>$data['jdwl_praktek'],
                     'jam_praktek'       =>$data['jam_praktek'],
                    
                 );
             
         if (isset($_POST['kirim'])) {
             $this->load->library('form_validation');
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
                $pesan='<script>
                    swal({
                        title: "'.form_error('nama').form_error('no_hp').form_error('alamat').form_error('email').'",
                        text: "",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                        });
                </script>';
                $this->session->set_flashdata('pesan',$pesan);
                redirect(base_url('register'));
            }
          else

            $nama         = $this->input->post('nama');
            $no_hp        = $this->input->post('no_hp');
            $alamat       = $this->input->post('alamat');
            $nama_suami   = $this->input->post('nama_suami');
            $email        = $this->input->post('email');
            $tgl_lahir    = $this->input->post('tgl_lahir');
            $tgl_lahir    = date('d F Y', strtotime($tgl_lahir));

            // Mengenkripsi data menggunakan Vigenere
            $vigenere = new Vigenere();
            $vigenere->setKey('kassandra'); // Ganti 'ponorogo' dengan kunci enkripsi yang Anda inginkan
            $encryptedNama = $vigenere->encrypt($nama);
            $encryptedNoHp = $vigenere->encrypt($no_hp);
            $encryptedAlamat = $vigenere->encrypt($alamat);
            $encryptedNamaSuami = $vigenere->encrypt($nama_suami);
            $encryptedEmail = $vigenere->encrypt($email);
            $encryptedTglLahir = $vigenere->encrypt($tgl_lahir);
 
             $SQLinsert=array(
              'id_pasien'           =>$this->id_pasien_urut(),
              'nama'                =>$encryptedNama,
              'no_hp'               =>$encryptedNoHp,
              'alamat'              =>$encryptedAlamat,
              'tgl_lahir'           =>$encryptedTglLahir,
              'nama_suami'          =>$encryptedNamaSuami,
              'email'               =>$encryptedEmail,
              'password'            =>md5($this->input->post('password')),
                 );
 
         $cek=$this->m_pasien->add($SQLinsert);
         if ($cek) {
 
             //Membuat Notifikasi Menggunakan Sweetalert
             $this->session->set_flashdata('pesan', '<script>
                 swal({
                     title: "Berhasil",
                     text: "Selamat Anda berhasil mendaftar, untuk melakukan reservasi silahkan login terlebih dahulu dengan email dan password yang telah anda daftarkan",
                     type: "success",
                     showConfirmButton: true,
                     confirmButtonText: "OKEE"
                 });
             </script>');
             //mengirim email ke pelanggan dengan phpmailer
             require_once(APPPATH.'libraries/phpmailer/Exception.php');
             require_once(APPPATH.'libraries/phpmailer/PHPMailer.php');
             require_once(APPPATH.'libraries/phpmailer/SMTP.php');
 
             $mail = new PHPMailer();
             // $mail->isSMTP();
             // $mail->Host = 'smtp.gmail.com';
             // $mail->SMTPAuth = true;
             // $mail->Username = 'kassandramikrotik@gmail.com'; // Email gmail anda
             // $mail->Password = 'abzdjiivohwzwieo'; // Password gmail anda
             // $mail->SMTPSecure = 'tls';
             // $mail->Port = 587;
             $mail->setFrom('wifi@kassandra.my.id' , $view['nama_judul']); // Email dan nama aplikasi yang akan mengirimkan email
             $mail->addAddress($this->input->post('email')); // Email tujuan
             $mail->Subject = 'Selamat '.$this->input->post('nama').' Anda berhasil mendaftar';
             $mail->isHTML(true);
             $content = '</p><table><thead><tr><td style=font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-width:1px;border-style:dashed;border-color:rgb(37,63,89);background:lavender;color:rgb(0,0,0);font-size:16px;padding-left:1em;padding-right:1em>'.
                         '<br>Anda telah berhasil mendaftar di Web Aplikasi ' .$view['nama_judul'].
                         '<br>Gunakan Web Aplikasi ' .$view['nama_judul'].' untuk melakukan reservasi pada layanan kami dengan mudah dan cepat' .
                             '<br><br>Berikut kami sampaikan mengenai informasi data akun anda : ' .
                             '<br>Nama : '.$this->input->post('nama') .
                             '<br>Alamat : '.$this->input->post('alamat') .
                             '<br>No HP : '.$this->input->post('no_hp') .
                             '<br>Tgl Lahir : '.$this->input->post('tgl_lahir') .
                             '<br>Nama Suami : '.$this->input->post('nama_suami') .
                              '<br>Email : '.$this->input->post('email') .
                             '<br>Password : '.$this->input->post('password') .
                             '<br><br><p align=center colspan=2 style=font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif>
             <a href="https://wifi.kassandra.my.id" style=color:rgb(255,255,255);background-color:#589bf2;border-width:initial;border-style:none;border-radius:15px;padding:10px 20px target=_blank >' .
                             '<b>Login Aplikasi ' .$view['nama_judul'].'</b></a></p>' .
                             '<br></td></tr></thead></table>
                                 <table><thead>
                                 <tr><td></td></tr>
                 <tr>
                                 <td style=padding-left:1em;padding-right:1em>
                                 <a>
                 <img src=https://wifi.kassandra.my.id/themes/kassandra-wifi/img/img/iklan1.jpg width=35%>
                 </a>
 
                 <a>
                 <img src=https://wifi.kassandra.my.id/themes/kassandra-wifi/img/img/kassandra.jpg width=60%>
                 </a>
 
                 <br>
 
                 <a>
                 <img src=https://wifi.kassandra.my.id/themes/kassandra-wifi/img/img/iklan3.jpg width=35%>
                 </a>
 
                 <a>
                 <img src=https://wifi.kassandra.my.id/themes/kassandra-wifi/img/img/payment.png width=60%>
                 </a>
 
                 </td>
                 </tr>
                 </thead></table>
                                 <p style=font-size:16px>
                 <i>Pesan ini dikirim otomatis oleh system web aplikasi '.$view['nama_judul'].'
                 <br><img src="https://wifi.kassandra.my.id/themes/kassandra-wifi/img/img/wifi.png">
                 <br><b>~ wifi@kassandra.my.id ~</b></p>' ;
                                 
                 $mail->Body = $content;
                 if ($mail->send())
                 ;
             redirect('login');
         }else{
             //Membuat Notifikasi Menggunakan Sweetalert
             $this->session->set_flashdata('pesan', '<script>
                 swal({
                     title: "Gagal",
                     text: "Data Gagal Disimpan, silakan hubungi admin",
                     type: "error",
                     timer: 2000,
                     showConfirmButton: true,,
                     confirmButtonText: "OKEE"
                 });
             </script>');
             redirect('register');
         }
     }
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
    
}
