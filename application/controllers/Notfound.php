<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notfound extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        // needed ???
        $this->load->database();
        $this->load->library('session');

        $this->load->model('m_pengaturan');
    }

    public function index()
    {   
        $data = $this->m_pengaturan->view()->row_array();
        $view = array('judul'              =>'404 Not Found',
                       'nama_judul'        =>$data['nama_judul'],
                       'meta_keywords'     =>$data['meta_keywords'],
                       'meta_description'  =>$data['meta_description'],
                       'jdwl_praktek'      =>$data['jdwl_praktek'],
                       'jam_praktek'       =>$data['jam_praktek'],
                       'akses_pendaftaran' =>$data['akses_pendaftaran'],
                       'logo'              =>$data['logo'],
                      
                   );
   
         $this->load->view('error/error',$view);
       
    }

    public function dalam_pengembangan()
    {   
        $data = $this->m_pengaturan->view()->row_array();
        $view = array('judul'              =>'Dalam Pengembangan',
                        'nama_judul'        =>$data['nama_judul'],
                        'meta_keywords'     =>$data['meta_keywords'],
                        'meta_description'  =>$data['meta_description'],
                        'jdwl_praktek'      =>$data['jdwl_praktek'],
                        'jam_praktek'       =>$data['jam_praktek'],
                        'akses_pendaftaran' =>$data['akses_pendaftaran'],
                        'logo'              =>$data['logo'],
                      
                   );

            $this->load->view('error/maintenance',$view);
    }

}
