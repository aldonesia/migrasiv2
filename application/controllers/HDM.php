<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class HDM extends CI_Controller {	
	public function __construct() {
        parent::__construct();
        $this->load->model('m_wo');
        $this->load->model('m_user');
        $this->load->model('m_log');
    }

	public function index() {
		$is_logged_in = $this->session->userdata('is_logged_in');
		if($is_logged_in) {
			$data['page_header'] = 'Checking WO . . .';
			$mitra = $this->session->userdata('mitra');
			$query = $this->m_wo->get_all_teknisi($mitra);
			$data['select_teknisi'] = array();
			foreach ($query as $object) {
				$data['select_teknisi'][$object->id_user]=$object->nama_user;
			}
			$this->load->view('Design/header',$data);
			$this->load->view('HDM/checkwoHDM',$data);
			$this->load->view('Design/footer');
		}
		else {
			redirect('Access');
		}
	}

	public function ajax_list()
    {
    	$mitra = $this->session->userdata('mitra');
    	$fase = $this->m_wo->get_all_fase();
    	$nama_teknisi = $this->m_wo->get_nama_teknisi();
        $list = $this->m_wo->get_datatables($mitra);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $wo) {
            $no++;
            $row = array();
            $row[] = $wo->TGL_DATA_MASUK;
            foreach($fase as $object) {
                if($object->id_fase == $wo->FASE_TRANSAKSI) $row[] = $object->nama_fase; 
            }
            $row[] = $wo->KETERANGAN_TAMBAHAN;
            $row[] = $wo->TGL_INPUT_TEKNISI;
            if ($wo->ID_TEKNISI != NULL)
            {
	            foreach($nama_teknisi as $object) {
	                if($object->id_user == $wo->ID_TEKNISI) $row[] = $object->nama_user;
	            }
	        }
	        else{
	        	$row[] = $wo->ID_TEKNISI;
	        }
            $row[] = $wo->ND;
            $row[] = $wo->NAMA_PELANGGAN;
            $row[] = $wo->STO;
            $row[] = $wo->ODP;
            $row[] = $wo->SN;
 
            //add html for action
            if($wo->ID_TEKNISI != NULL)
            {
            	$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="AddSNODP" onclick="add_sn_odp('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-pencil"></i> Tambah SN ODP</a>
                  <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="AddKeterangan" onclick="add_keterangan('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-pencil"></i> Tambah Keterangan</a>';
            }
            else
            {
            	$row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="AddTeknisi" onclick="add_teknisi('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-pencil"></i> Tambah Teknisi</a>
                  <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="AddSNODP" onclick="add_sn_odp('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-pencil"></i> Tambah SN ODP</a>
                  <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="AddKeterangan" onclick="add_keterangan('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-pencil"></i> Tambah Keterangan</a>';
            }
            
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->m_wo->count_all(),
                        "recordsFiltered" => $this->m_wo->count_filtered($mitra),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id_transaksi)
    {
        $data = $this->m_wo->get_by_id_transaksi($id_transaksi);
        echo json_encode($data);
    }
 
    public function ajax_add_teknisi()
    {
        //$this->_validate();
        $nd = $this->input->post('ND');
        $data = array(
                'ID_TEKNISI' => $this->input->post('idteknisi'),
                'TGL_INPUT_TEKNISI' => date('Y-m-d'),
                'FASE_TRANSAKSI' => 'FA03',
                'KETERANGAN_TAMBAHAN' => 'Belum Disurvey'
            );
        $status = $this->m_log->getstatus();
        foreach($status as $object_status) {
        	if($nd == $object_status->ND) $id_status = $object_status->STATUS;
        }
        $fase = $this->m_log->getfase();
        foreach($fase as $object_fase) {
        	if($nd == $object_fase->ND) $id_fase = $object_fase->FASE_TRANSAKSI;
        }
        $keterangan = $this->m_log->getketerangan();
        foreach($keterangan as $object_keterangan) {
        	if($nd == $object_keterangan->ND) $keterangan = $object_keterangan->KETERANGAN_TAMBAHAN;
        }
        
        $log = array(
        		'id_log' => NULL,
        		'tanggal_log' => date('Y-m-d'),
        		'ND_log' => $nd,
        		'id_fase_log' => $id_fase,
        		'id_status_log' => $id_status,
        		'keterangan_log' => $keterangan,
        		'action_log' => 'ASSIGN TEKNISI',
        		'updated_by_log'=> $mitra = $this->session->userdata('nama')
        	);
        $this->m_wo->update(array('ND'=> $this->input->post('ND')), $data);
        $this->m_log->insertlog($log);	
        echo json_encode(array("status" => TRUE));	
        
    }

    public function ajax_add_sn_odp()
    {
        //$this->_validate();
        $nd = $this->input->post('ND');
        $data = array(
                'SN' => $this->input->post('SN'),
                'ODP' => $this->input->post('ODP'),
            );
        
        $status = $this->m_log->getstatus();
        foreach($status as $object_status) {
        	if($nd == $object_status->ND) $id_status = $object_status->STATUS;
        }
        $fase = $this->m_log->getfase();
        foreach($fase as $object_fase) {
        	if($nd == $object_fase->ND) $id_fase = $object_fase->FASE_TRANSAKSI;
        }
        $keterangan = $this->m_log->getketerangan();
        foreach($keterangan as $object_keterangan) {
        	if($nd == $object_keterangan->ND) $keterangan = $object_keterangan->KETERANGAN_TAMBAHAN;
        }
        
        $log = array(
        		'id_log' => NULL,
        		'tanggal_log' => date('Y-m-d'),
        		'ND_log' => $nd,
        		'id_fase_log' => $id_fase,
        		'id_status_log' => $id_status,
        		'keterangan_log' => $keterangan,
        		'action_log' => 'TAMBAH SN DAN ODP',
        		'updated_by_log'=> $mitra = $this->session->userdata('nama')
        	);
        $this->m_wo->update(array('ND'=> $this->input->post('ND')), $data);
        $this->m_log->insertlog($log);
        echo json_encode(array("status" => TRUE));
    }
 
 	public function ajax_add_keterangan()
    {
        $nd = $this->input->post('ND');
        $data = array(
                'KETERANGAN_TAMBAHAN' => $this->input->post('Keterangan'),
        );
        $status = $this->m_log->getstatus();
        foreach($status as $object_status) {
        	if($nd == $object_status->ND) $id_status = $object_status->STATUS;
        }
        $fase = $this->m_log->getfase();
        foreach($fase as $object_fase) {
        	if($nd == $object_fase->ND) $id_fase = $object_fase->FASE_TRANSAKSI;
        }
        
        $log = array(
        		'id_log' => NULL,
        		'tanggal_log' => date('Y-m-d'),
        		'ND_log' => $nd,
        		'id_fase_log' => $id_fase,
        		'id_status_log' => $id_status,
        		'keterangan_log' => $data['KETERANGAN_TAMBAHAN'],
        		'action_log' => 'TAMBAH SN DAN ODP',
        		'updated_by_log'=> $mitra = $this->session->userdata('nama')
        	);
        $this->m_wo->update(array('ND'=> $this->input->post('ND')), $data);
        $this->m_log->insertlog($log);
        echo json_encode(array("status" => TRUE));	
        
    }
}
