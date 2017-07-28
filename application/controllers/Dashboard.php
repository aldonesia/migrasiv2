<?php

if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Dashboard extends CI_Controller {	
	public function __construct() {
        parent::__construct();
    }

	public function index() {
		$is_logged_in = $this->session->userdata('is_logged_in');
		if($is_logged_in) {
			$data['role']		= $this->session->userdata('role');
			if($data['role'] == 'RO7') {
				$this->WelcomePageHDM();
			}
			else {
			 	$this->WelcomePageHDTA();
			}
		}
		else {
			redirect('Access');
		}
	}


	public function WelcomePageHDM() {
		$this->load->model('m_user');
		$data['page_header']		= 'Telkom Migration Monitoring';
		$data['username_logged']	= $this->session->userdata('username');
		$data['role']				= $this->session->userdata('role');
		$data['nama']				= $this->session->userdata('nama');
		$query	= $this->m_user->check_mitra($this->session->userdata('mitra'));
		foreach ($query as $object) {
			if($object->id_mitra == $this->session->userdata('mitra')) {
				$temp 	= $object->nama_mitra;
			}
		}
		$data['namamitra'] = $temp;
		if($data['role'] == 'RO7'){
			// $this->load->view('Design/header');
			// $this->load->view('HDM/sidebar',$data)
			// $this->load->view('HDM/checkwo',$data);
			// $this->load->view('Design/footer');
			redirect('HDM/CheckWoHDM');
		}
		else redirect('Dashboard');
	}

	public function WelcomePageHDTA() {
		if($data['role'] == 'RO3' || $data['role'] == 'RO4' || $data['role'] == 'RO5' || $data['role'] == 'RO6'){
			redirect('HDTA');
		}
		else redirect('Dashboard');
	}
	// public function WelcomePageTeknisi() {
	// 	$this->load->model('m_user');
	// 	$data['title']				= 'TMM';
	// 	$data['page_header']		= 'Telkom Migration Monitoring';
	// 	$data['username_logged']	= $this->session->userdata('username');
	// 	$data['role']				= $this->session->userdata('role');
	// 	$data['nama']				= $this->session->userdata('nama');
	// 	$query	= $this->m_user->check_mitra($this->session->userdata('mitra'));
	// 	foreach ($query as $object) {
	// 		if($object->id_mitra == $this->session->userdata('mitra')) {
	// 			$temp 	= $object->nama_mitra;
	// 		}
	// 	}
	// 	$data['namamitra'] = $temp;
	// 	if($data['role'] == 'RO6'){
	// 		 $this->load->view('design/teknisi/header',$data);
	// 		 $this->load->view('teknisi/welcome',$data);
	// 		 $this->load->view('design/teknisi/footer',$data);
	// 	}
	// 	else redirect('dashboard');
	// }

	// public function WelcomePageSuperUser() {
	// 	$this->load->model('m_user');
	// 	$data['title']				= 'TMM';
	// 	$data['page_header']		= 'Telkom Migration Monitoring';
	// 	$data['username_logged']	= $this->session->userdata('username');
	// 	$data['role']				= $this->session->userdata('role');
	// 	$data['nama']				= $this->session->userdata('nama');
	// 	if($data['role'] == 'RO1') {
	// 		$this->load->view('design/admin/header',$data);
	// 		$this->load->view('superuser/welcome',$data);
	// 		$this->load->view('design/admin/footer',$data);
	// 	}
	// 	else redirect('dashboard');
	// }
}