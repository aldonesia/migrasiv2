<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class InputPS extends CI_Controller {	
	public function __construct() {
        parent::__construct();
        $this->load->model('m_inputps');
        $this->load->model('m_user');
        $this->load->model('m_log');
    }

	public function index() {
		$is_logged_in = $this->session->userdata('is_logged_in');
		if($is_logged_in) {
			$mitra = $this->session->userdata('mitra');

			$query_kendala = $this->m_inputps->get_status_kendala();
            $data['select_status'] = array();
            foreach ($query_kendala as $object) {
                $data['select_status'][$object->id_status]=$object->nama_status;
            }
            $query_ps = $this->m_inputps->get_status_ps();
            $data['select_status_ps'] = array();
            foreach($query_ps as $object ) {
                $data['select_status_ps'][$object->id_status]=$object->nama_status;   
            }
			$this->load->view('layout/header',$data);
			$this->load->view('HDTA/InputPS/checkwoInputPS',$data);
			$this->load->view('layout/footer');
		}
		else {
			redirect('Access');
		}
	}

	public function ajax_list()
    {
        $status = $this->m_inputps->get_all_status();
        $user = $this->m_inputps->get_nama_teknisi();
        $list = $this->m_inputps->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $wo) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $wo->TGL_DATA_MASUK;
            $row[] = $wo->ND;
            $row[] = $wo->SC;
            if ($wo->HD_INPUTER != NULL)
            {
                foreach($user as $object) {
                    if($object->id_user == $wo->HD_INPUTER) $row[] = $object->nama_user; 
                }
            }
            else{
                $row[] = $wo->HD_INPUTER;
            }
            $row[] = $wo->TGL_INPUT;
            if ($wo->HD_PS != NULL)
            {
                foreach($user as $object) {
                    if($object->id_user == $wo->HD_PS) $row[] = $object->nama_user; 
                }
            }
            else{
                $row[] = $wo->HD_PS;
            }
            if ($wo->STATUS_PS != NULL)
            {
                foreach($status as $object) {
                    if($object->id_status == $wo->STATUS_PS) $row[] = $object->nama_status; 
                }
            }
            else{
                $row[] = $wo->STATUS_PS;
            }
            $row[] = $wo->TGL_PS;
            if ($wo->ESKALASI_KENDALA != NULL)
            {
                foreach($status as $object) {
                    if($object->id_status == $wo->ESKALASI_KENDALA) $row[] = $object->nama_status; 
                }
            }
            else{
                $row[] = $wo->ESKALASI_KENDALA;
            }
            $row[] = $wo->KETERANGAN_TAMBAHAN;
            //add html for action 
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="EditSC" onclick="edit_sc('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit SC</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="EditPS" onclick="edit_ps('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit PS</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="ChangeKendala" onclick="ChangeKendala('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-question-sign"></i> Tambah Kendala</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="AddKeterangan" onclick="add_keterangan('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-pencil"></i> Tambah Keterangan</a>
                  <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Detail" onclick="detail('."'".$wo->ND."'".')"><i class="glyphicon glyphicon-ok"></i> Detail Pelanggan</a>';
            	/*$row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="AddSNODP" onclick="add_sn_odp('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-pencil"></i> Tambah SN ODP</a>
                <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="ChangeFase" onclick="ChangeFase('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-question-sign"></i> Rubah Fase</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="ChangeKendala" onclick="ChangeKendala('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-question-sign"></i> Tambah Kendala</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="AddKeterangan" onclick="add_keterangan('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-pencil"></i> Tambah Keterangan</a>
                  <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Detail" onclick="detail('."'".$wo->ND."'".')"><i class="glyphicon glyphicon-ok"></i> Detail Pelanggan</a>';*/
            
        
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->m_inputps->count_all(),
                        "recordsFiltered" => $this->m_inputps->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id_transaksi)
    {
        $data = $this->m_inputps->get_by_id_transaksi($id_transaksi);
        echo json_encode($data);
    }

    public function ajax_detail($ND)
    {
        $data = $this->m_inputps->get_by_ND($ND);
        echo json_encode($data);
    }
    public function ajax_edit_sc()
    {
        //$this->_validate();
        $nd = $this->input->post('ND');
        $data = array(
                'SC' => $this->input->post('sc'),
                'HD_INPUTER' => $this->session->userdata('user'),
                'TGL_INPUT' => date('Y-m-d'),
                'KETERANGAN_TAMBAHAN' => $this->input->post('keterangan')
            );
        $status = $this->m_log->getstatus();
        if(!is_null($status)) {
            foreach($status as $object_status) {
                if($nd == $object_status->ND) $id_status = $object_status->STATUS;
            }    
        }
        else $id_status = 'ST07';
        
        $fase = $this->m_log->getfase();
        foreach($fase as $object_fase) {
            if($nd == $object_fase->ND) $id_fase = $object_fase->FASE_TRANSAKSI;
        }
        // $keterangan = $this->m_log->getketerangan();
        // foreach($keterangan as $object_keterangan) {
        //  if($nd == $object_keterangan->ND) $keterangan = $object_keterangan->KETERANGAN_TAMBAHAN;
        // }
        
        $log = array(
                'id_log' => NULL,
                'tanggal_log' => date('Y-m-d'),
                'ND_log' => $nd,
                'id_fase_log' => $id_fase,
                'id_status_log' => $id_status,
                'keterangan_log' => $data['KETERANGAN_TAMBAHAN'],
                'action_log' => 'ADD/EDIT SC',
                'updated_by_log'=> $this->session->userdata('user')
            );
        $this->m_inputps->update(array('ND'=> $this->input->post('ND')), $data);
        $this->m_log->insertlog($log);  
        echo json_encode(array("status" => TRUE));  
        
    }
    public function ajax_edit_ps()
    {
        //$this->_validate();
        $nd = $this->input->post('ND');
        $data = array(
                'HD_PS' => $this->session->userdata('user'),
                'STATUS_PS' => $this->input->post('ps'),
                'TGL_PS' => date('Y-m-d'),
                'KETERANGAN_TAMBAHAN' => $this->input->post('keterangan')
            );
        $status = $this->m_log->getstatus();
        if(!is_null($status)) {
            foreach($status as $object_status) {
                if($nd == $object_status->ND) $id_status = $object_status->STATUS;
            }    
        }
        else $id_status = 'ST07';
        
        $fase = $this->m_log->getfase();
        foreach($fase as $object_fase) {
            if($nd == $object_fase->ND) $id_fase = $object_fase->FASE_TRANSAKSI;
        }
        // $keterangan = $this->m_log->getketerangan();
        // foreach($keterangan as $object_keterangan) {
        //  if($nd == $object_keterangan->ND) $keterangan = $object_keterangan->KETERANGAN_TAMBAHAN;
        // }
        
        $log = array(
                'id_log' => NULL,
                'tanggal_log' => date('Y-m-d'),
                'ND_log' => $nd,
                'id_fase_log' => $id_fase,
                'id_status_log' => $id_status,
                'keterangan_log' => $data['KETERANGAN_TAMBAHAN'],
                'action_log' => 'ADD/EDIT SC',
                'updated_by_log'=> $this->session->userdata('user')
            );
        $this->m_inputps->update(array('ND'=> $this->input->post('ND')), $data);
        $this->m_log->insertlog($log);  
        echo json_encode(array("status" => TRUE));  
        
    }
    

    public function ajax_change_kendala()
    {
        $nd = $this->input->post('ND');
        $data = array(
                'ESKALASI_KENDALA' => $this->input->post('Kendala'),
                'KETERANGAN_TAMBAHAN' => $this->input->post('Keterangan')
            );
        $status = $this->m_log->getstatus();
        foreach($status as $object_status) {
            if($nd == $object_status->ND) $id_status = $object_status->STATUS;
        }
        $fase = $this->m_log->getfase();
        foreach($fase as $object_fase) {
            if($nd == $object_fase->ND) $id_fase = $object_fase->FASE_TRANSAKSI;
        }
        // $keterangan = $this->m_log->getketerangan();
        // foreach($keterangan as $object_keterangan) {
        //  if($nd == $object_keterangan->ND) $keterangan = $object_keterangan->KETERANGAN_TAMBAHAN;
        // }
        
        $log = array(
                'id_log' => NULL,
                'tanggal_log' => date('Y-m-d'),
                'ND_log' => $nd,
                'id_fase_log' => $id_fase,
                'id_status_log' => $data['ESKALASI_KENDALA'],
                'keterangan_log' => $data['KETERANGAN_TAMBAHAN'],
                'action_log' => 'CHANGE STATUS',
                'updated_by_log'=> $this->session->userdata('user')
            );
        $this->m_logic->update(array('ND'=> $this->input->post('ND')), $data);
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
        		'updated_by_log'=> $this->session->userdata('user')
        	);
        $this->m_logic->update(array('ND'=> $this->input->post('ND')), $data);
        $this->m_log->insertlog($log);
        echo json_encode(array("status" => TRUE));	
    }

    public function trackwo()
    {
            $this->load->view('layout/header');
            $this->load->view('HDM/trackwohdm');
            $this->load->view('layout/footer');
    }

    public function ajax_list_trackwo()
    {
        $mitra = $this->session->userdata('mitra');
        $fase = $this->m_hdm->get_all_fase();
        $nama_teknisi = $this->m_hdm->get_nama_teknisi();
        $status = $this->m_hdm->get_all_status();
        $list = $this->m_hdm->get_datatables_tw($mitra);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $wo) {
            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $wo->TGL_DATA_MASUK;

            $row[] = $wo->ND;

            foreach($fase as $object) {
                if($object->id_fase == $wo->FASE_TRANSAKSI) $row[] = $object->nama_fase; 
            }

            if ($wo->STATUS != NULL)
            {
                foreach($status as $object) {
                    if($object->id_status == $wo->STATUS) $row[] = $object->nama_status; 
                }
            }
            else{
                $row[] = $wo->STATUS;
            }

            $row[] = $wo->TGL_LAYANAN_UP;

            if ($wo->UPDATE_LAYANAN != NULL)
            {
                foreach($status as $object) {
                    if($object->id_status == $wo->UPDATE_LAYANAN) $row[] = $object->nama_status; 
                }
            }
            else{
                $row[] = $wo->UPDATE_LAYANAN;
            }

            if ($wo->ESKALASI_KENDALA != NULL)
            {
                foreach($status as $object) {
                    if($object->id_status == $wo->ESKALASI_KENDALA) $row[] = $object->nama_status; 
                }
            }
            else{
                $row[] = $wo->ESKALASI_KENDALA;
            }
            $row[] = $wo->STATUS_DP;
            $row[] = $wo->KETERANGAN_TAMBAHAN;
            $row[] = $wo->TGL_INPUT;
            $row[] = $wo->TGL_PS;
            $row[] = $wo->STATUS_PS;
     
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->m_hdm->count_all(),
                        "recordsFiltered" => $this->m_hdm->count_filtered_tw($mitra),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function manageteknisi()
    {
        $this->load->view('layout/header');
        $this->load->view('HDM/manageteknisi');
        $this->load->view('layout/footer');
    }

    public function ajax_list_teknisi()
    {
        $mitra = $this->session->userdata('mitra');
        $query_mitra = $this->m_user->get_all_mitra();
        $query_role = $this->m_user->get_all_role();
        $list = $this->m_hdm->get_datatables_teknisi($mitra);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $no++;
            $row = array();
            $row[] = $user->id_user;
            foreach($query_mitra as $object) {
                if($object->id_mitra == $user->id_mitra) $row[] = $object->nama_mitra; 
            }
            foreach($query_role as $object) {
                if($object->id_role_user == $user->id_role_user) $row[] = $object->nama_role_user; 
            }
            $row[] = $user->username_user;
            $row[] = $user->nama_user;
            $row[] = $user->no_telepon_user;
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_user('."'".$user->id_user."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user('."'".$user->id_user."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->m_hdm->count_all_teknisi(),
                        "recordsFiltered" => $this->m_hdm->count_filtered_teknisi($mitra),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit_teknisi($id_user)
    {
        $data = $this->m_hdm->get_by_id_user_teknisi($id_user);
        //$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
 
    public function ajax_add_teknisi2()
    {
        $this->_validate();
        $data = array(
                'id_user' => $this->input->post('id_user'),
                'id_mitra' => $this->input->post('id_mitra'),
                'id_role_user' => $this->input->post('id_role_user'),
                'username_user' => $this->input->post('username_user'),
                'password_user' => md5($this->input->post('password_user')),
                'nama_user' => $this->input->post('nama_user'),
                'no_telepon_user' => $this->input->post('no_telepon_user'),
            );
        $insert = $this->m_hdm->save_teknisi($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update_teknisi()
    {
        $this->_validate_teknisi();
        $data = array(
                'id_user' => $this->input->post('id_user'),
                'id_mitra' => $this->input->post('id_mitra'),
                'id_role_user' => $this->input->post('id_role_user'),
                'username_user' => $this->input->post('username_user'),
                'password_user' => md5($this->input->post('password_user')),
                'nama_user' => $this->input->post('nama_user'),
                'no_telepon_user' => $this->input->post('no_telepon_user'),
            );
        $this->m_hdm->update_teknisi(array('id_user' => $this->input->post('id_user')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete_teknisi($id_user)
    {
        $this->m_hdm->delete_by_id_user_teknisi($id_user);
        echo json_encode(array("status" => TRUE));
    }
 
 
    private function _validate_teknisi()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('id_user') == '')
        {
            $data['inputerror'][] = 'id_user';
            $data['error_string'][] = 'Id User is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('id_mitra') == '')
        {
            $data['inputerror'][] = 'id_mitra';
            $data['error_string'][] = 'Id Mitra is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('id_role_user') == '')
        {
            $data['inputerror'][] = 'id_role_user';
            $data['error_string'][] = 'Role is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('username_user') == '')
        {
            $data['inputerror'][] = 'username_user';
            $data['error_string'][] = 'Username is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('password_user') == '')
        {
            $data['inputerror'][] = 'password_user';
            $data['error_string'][] = 'Password is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('nama_user') == '')
        {
            $data['inputerror'][] = 'nama_user';
            $data['error_string'][] = 'Nama is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('no_telepon_user') == '')
        {
            $data['inputerror'][] = 'no_telepon_user';
            $data['error_string'][] = 'No telepeon is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
