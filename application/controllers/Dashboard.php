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
			// elseif ($data['role'] == 'RO1') {
			// 	$this->WelcomePageSuperUser();
			// }
			// elseif ($data['role'] == 'RO4') {
			// 	$this->WelcomePageHDTA();
			// }
			// elseif ($data['role'] == 'RO5') {
			// 	$this->WelcomePageHDM();
			// }
			// elseif ($data['role'] == 'RO6') {
			// 	$this->WelcomePageTeknisi();
			// }
		}
		else {
			redirect('Access');
		}
	}

	// public function WelcomePageAdmin() {
	// 	$this->load->model('m_user');
	// 	$data['title']				= 'TMM';
	// 	$data['page_header']		= 'Telkom Migration Monitoring';
	// 	$data['username_logged']	= $this->session->userdata('username');
	// 	$data['role']				= $this->session->userdata('role');
	// 	$data['nama']				= $this->session->userdata('nama');
	// 	if($data['role'] == 'RO2'){
	// 		$this->load->view('design/admin/header',$data);
	// 		$this->load->view('admin/welcome',$data);
	// 		$this->load->view('design/admin/footer',$data);
	// 	}
	// 	else redirect('dashboard');
	// }

	// public function WelcomePageHDTA() {
	// 	$this->load->model('m_user');
	// 	$data['title']				= 'TMM';
	// 	$data['page_header']		= 'Telkom Migration Monitoring';
	// 	$data['username_logged']	= $this->session->userdata('username');
	// 	$data['role']				= $this->session->userdata('role');
	// 	$data['nama']				= $this->session->userdata('nama');
	// 	if($data['role'] == 'RO4'){
	// 		$this->load->view('design/hdta/header',$data);
	// 		$this->load->view('HDTA/welcome',$data);
	// 		$this->load->view('design/hdta/header',$data);
	// 	}
	// 	else redirect('dashboard');
	// }

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