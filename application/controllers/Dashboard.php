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
			redirect('HDM');
		}
		else redirect('Dashboard');
	}

}