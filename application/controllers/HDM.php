<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class WorkOrder extends CI_Controller {	
	public function __construct() {
        parent::__construct();
        $this->load->model('m_wo');
        // Your own constructor code
    }

	public function index() {
		$is_logged_in = $this->session->userdata('is_logged_in');
		if($is_logged_in) {
			redirect('Dashboard');
		}
		else {
			redirect('Access');
		}
	}

	public function CheckWoHDM(){
		$updatedata['flag'] = FALSE;
		$this->load->model('m_user');
		$data['title'] = 'TMM';
		$data['page_header'] = 'Checking WO . . .';
		$data['mitra'] = $this->session->userdata('mitra');
		$data['username_logged'] = $this->session->userdata('username');
		$query 	= $this->m_wo->checkwo($data['mitra']);
		if($query) {
			$data['flag'] = TRUE;
			$data['query'] = $query;
		}
		else $data['flag'] = FALSE;
		$query_fase		= $this->m_user->get_all_fase();
		$query_status	= $this->m_user->get_all_status();
		$query_teknisi	= $this->m_user->get_all_teknisi($data['mitra']);
		$data['query_fase'] = $query_fase;
		$data['query_teknisi'] = $query_teknisi;
		$data['query_status'] = $query_status;
		$data['select'] = Array();
		if($data['query_teknisi']) {
			foreach($query_teknisi as $r) {
    		$data['select'][$r->id_user] = $r->nama_user;
			}
		}
		$this->load->view('Design/header',$data);
		$this->load->view('HDM/checkwoHDM',$data);
		$this->load->view('Design/footer',$data);

		$updatedata = array(
			'id' => $this->input->post('idt'),
			'tek' => $this->input->post('teknisi'),
			'flag' => $this->input->post('flag')
		);
		$temp = $this->m_wo->assign_teknisi($updatedata);
		if($updatedata['flag']) {
			redirect('HDM/CheckwoHDM','refresh');
		}
	}
}