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
		if($data['role'] == 'RO7'){
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
}