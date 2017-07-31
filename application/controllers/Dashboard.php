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
			else if ($data['role'] == 'RO1')
			{
				$this->WelcomePageAdmin();
			}
			else if ($data['role'] == 'RO4')
			{
				$this->WelcomePageCentral();
			}
			else if ($data['role'] == 'RO5')
			{
				$this->WelcomePageLogic();
			}
			else if ($data['role'] == 'RO6')
			{
				$this->WelcomePageInputPS();
			}
			else if ($data['role'] == 'RO3')
			{
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

	public function WelcomePageAdmin() {
		if($this->session->userdata('role') == 'RO1'){
			redirect('Admin');
		}
		else redirect('Dashboard');
	}

	public function WelcomePageInputPS() {
		if($this->session->userdata('role') == 'RO6') {
			redirect('InputPS');
		}
		else redirect('Dashboard');
	}
	public function WelcomePageHDTA() {
		if($this->session->userdata('role') == 'RO3'){
			redirect('HDTA');
		}
		else redirect('Dashboard');
	}

	public function WelcomePageCentral() {
		if($this->session->userdata('role') == 'RO4'){
			redirect('Central');
		}
		else redirect('Dashboard');
	}

	public function WelcomePageLogic() {
		if($this->session->userdata('role') == 'RO5'){
			redirect('Logic');
		}
		else redirect('Dashboard');
	}

	
}