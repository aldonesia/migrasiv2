<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Superuser extends CI_Controller 
{	
	public function __construct() 
	{
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->model('m_hdm');
        $this->load->model('m_log');
        $this->load->model('m_user');
    }

	public function index() 
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if($is_logged_in) {
			$data['username_logged'] = $this->session->userdata('username');
			$this->load->view('layout/header');
			$this->load->view('Admin/report',$data);
			$this->load->view('layout/footer');
		}
		else {
			redirect('Access');
		}
	}
}