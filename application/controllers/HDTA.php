<?php

if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class HDTA extends CI_Controller {	
	public function __construct() {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->model('m_wo');
    }
	public function index() {
		redirect('Dashboard');
	}

    public function AddWObyDP_js() {
        $data['title'] = 'TMM';
        $data['page_header'] = 'Add WO by DP';
        $data['query_STO'] = $this->m_wo->get_sto();
        $data['select_mitra'] = Array();
        $query_mitra = $this->m_user->get_all_mitra();
        foreach($query_mitra as $object_mitra) {
            $data['select_mitra'][$object_mitra->id_mitra] = $object_mitra->nama_mitra;
        }
        $this->load->view('layout/header',$data);
        $this->load->view('HDTA/addwobydpjs',$data);
        $this->load->view('layout/footer',$data);
    }

    public function AddWObyRK_js() {
        $data['title'] = 'TMM';
        $data['page_header'] = 'Add WO by RK';
        $data['query_STO'] = $this->m_wo->get_sto();
        $data['select_mitra'] = Array();
        $query_mitra = $this->m_user->get_all_mitra();
        foreach($query_mitra as $object_mitra) {
            $data['select_mitra'][$object_mitra->id_mitra] = $object_mitra->nama_mitra;
        }
        $this->load->view('layout/header',$data);
        $this->load->view('HDTA/addwobyrkjs',$data);
        $this->load->view('layout/footer',$data);
    }

    public function getRK_js() {
        $values = $this->input->post('sto_post');
        $query = $this->m_wo->get_rk_by_sto($values);
        if($query)
        {
            $select_rk = '';
            $select_rk .= '<option value="">Select RK</option>';
            foreach ($query as $object) {
                $select_rk .='<option value="'.$object->RK.'">'.$object->RK.'</option>';
            }
            echo json_encode($select_rk);
        }
    }

    public function getDP_js() {
        $values = $this->input->post('rk_post');
        $query = $this->m_wo->get_dp_by_rk($values);
        if($query)
        {
            $select_dp = '';
            $select_dp .= '<option value="">Select DP</option>';
            foreach ($query as $object) {
                $select_dp .='<option value="'.$object->DP.'">'.$object->DP.'</option>';
            }
            echo json_encode($select_dp);
        }
    }

    public function addWORK_js(){
        if($this->input->post('dp')) $query_ND = $this->m_wo->get_info_nd_by_dp($this->input->post('dp'));
        else $query_ND = $this->m_wo->get_info_nd_by_rk($this->input->post('rk'));
        $result = $this->m_wo->addWO_js($query_ND);
        /*foreach($query_ND as $object) {
            $log = array(
                'id_log'            => NULL,
                'tanggal_log'       => date("Y-m-d"),
                'ND_log'            => $object->ND,
                'id_fase_log'       => 'FA01',
                'id_status_log'     => 'ST25',
                'keterangan_log'    => 'Work Order baru',
                'action_log'        => 'INSERT',
                'updated_by_log'    => $this->session->user
            );
            $insert_new_log = $this->m_wo->insert_log($log);
        }*/
        $msg['success'] = false;
        $msg['type'] = 'add';
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

	public function ManageWo() {
        $data['query_mitra'] = $this->m_user->get_all_mitra();
        $data['select_mitra'] = Array();
        if($data['query_mitra']) {
            foreach($data['query_mitra'] as $m) {
            $data['select_mitra'][$m->id_mitra] = $m->nama_mitra;
            }
        }

        $this->load->view('layout/header');
        $this->load->view('HDTA/managewo', $data);
        $this->load->view('layout/footer');
    }

    public function ajax_list()
    {
        $list = $this->m_wo->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $no++;
            $row = array();
            $row[] = '<input type="checkbox" class="data-check" value="'.$user->ND.'">';
            $row[] = $user->ND;
            $row[] = $user->CAREA;
            $row[] = $user->RK;
            $row[] = $user->DP;
            $row[] = $user->UIM_SERVICE_STATUS;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->m_wo->count_all(),
                        "recordsFiltered" => $this->m_wo->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_add_wos()
    {   
        $list = $this->input->post('id');
        $mitra = $this->input->post('mitra');
        $coba = explode("=", $mitra);
        if($list) {
            foreach($list as $object) {
                    $query = $this->m_wo->get_info_nd($object);
                    $result = $this->m_wo->insert_wo($query,$coba[2]);
            }
            $msg['success'] = false;
            $msg['type'] = 'add';
            if($result) {
                $msg['success'] = true;
            }
            echo json_encode($msg);
        }
        else {
            $msg = $this->input->post('id');
            echo json_encode($msg);
        }
    }
}
