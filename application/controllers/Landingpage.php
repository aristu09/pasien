<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Landingpage extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        // needed ???
        $this->load->database();
        
        $this->load->model('M_feedback');
 
    }

    public function index()
	{
	 $view = array('judul'  =>'KASSANDRA WIFI',
	               'data'      =>$this->M_feedback->view(),);
     $this->load->view('landingpage/landingpage',$view);
    }

    public function about()
    {
     $view = array('judul'  =>'About');
     $this->load->view('landingpage/about',$view);
    }

    public function contact()
    {
     $view = array('judul'  =>'Contact');
     $this->load->view('landingpage/contact',$view);
    }
    
    public function feature()
    {
     $view = array('judul'  =>'Feature');
     $this->load->view('landingpage/feature',$view);
    }

    public function project()
    {
     $view = array('judul'  =>'Project');
     $this->load->view('landingpage/project',$view);
    }

    public function service()
    {
     $view = array('judul'  =>'Service');
     $this->load->view('landingpage/service',$view);
    }

    public function speedtest()
    {
     $view = array('judul'  =>'Speedtest');
     $this->load->view('landingpage/speedtest',$view);
    }

    public function team()
    {
     $view = array('judul'  =>'Team');
     $this->load->view('landingpage/team',$view);
    }

    public function testimonial()
    {
     $view = array('judul'  =>'Testimonial');
     $this->load->view('landingpage/testimonial',$view);
    }

    public function lapor()
    {
     $view = array('judul'  =>'lapor');
     $this->load->view('landingpage/lapor',$view);
    }
    
    //feedback
    public function feedback($value='')
    {
     $view = array('judul'     =>'Data Tagihan Lain',
                   'data'      =>$this->m_feedback->view(),);
        $this->load->view('landingpage/feedback',$view);
    }
    
}
