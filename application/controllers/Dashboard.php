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
		if($this->session->userdata('role') == 'RO7'){
			redirect('HDM');
		}
		else redirect('Dashboard');
	}

	public function WelcomePageHDTA() {
		if($this->session->userdata('role') == 'RO3' || $this->session->userdata('role') == 'RO4' || $this->session->userdata('role') == 'RO5' || $this->session->userdata('role') == 'RO6'){
			redirect('HDTA');
		}
		else redirect('Dashboard');
	}
}