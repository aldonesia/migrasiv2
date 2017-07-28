<?php

if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Dashboard extends CI_Controller {	
	public function __construct() {
        parent::__construct();
       	$this->load->model('m_user');
    }
	public function index() {
		redirect('Dashboard/WelcomePageHDTA');
	}
	/*
	public function WelcomePageAdmin() {
		$this->load->model('m_user');
		$data['title']				= 'TMM';
		$data['page_header']		= 'Telkom Migration Monitoring';
		$data['username_logged']	= $this->session->userdata('username');
		$data['role']				= $this->session->userdata('role');
		$data['nama']				= $this->session->userdata('nama');
		if($data['role'] == 'RO2') $this->load->view('admin/welcome',$data);
		else redirect('dashboard');
	}
	*/
	public function WelcomePageHDTA() {
		$data['title']				= 'TMM';
		$data['page_header']		= 'Telkom Migration Monitoring';
		$this->load->view('HDTA/welcome',$data);
	}
	/*
	public function WelcomePageHDM() {
		$this->load->model('m_user');
		$data['title']				= 'TMM';
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
		if($data['role'] == 'RO5')$this->load->view('HDM/welcome',$data);
		else redirect('dashboard');
	}

	public function WelcomePageTeknisi() {
		$this->load->model('m_user');
		$data['title']				= 'TMM';
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
		if($data['role'] == 'RO6') $this->load->view('teknisi/welcome',$data);
		else redirect('dashboard');
	}

	public function WelcomePageSuperUser() {
		$this->load->model('m_user');
		$data['title']				= 'TMM';
		$data['page_header']		= 'Telkom Migration Monitoring';
		$data['username_logged']	= $this->session->userdata('username');
		$data['role']				= $this->session->userdata('role');
		$data['nama']				= $this->session->userdata('nama');
		if($data['role'] == 'RO1') $this->load->view('superuser/welcome',$data);
		else redirect('dashboard');
	}*/
}