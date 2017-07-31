<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Admin extends CI_Controller 
{	
	public function __construct() 
	{
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->model('m_hdm');
        $this->load->model('m_log');
        $this->load->model('m_user');
    }

	public function index() 
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if($is_logged_in) {
			$temp = 'count';
			$data['username_logged'] = $this->session->userdata('username');

			$data['wos'] = $this->m_admin->get_wo_sisa($temp);
			$data['woc'] = $this->m_admin->get_wo_complete($temp);
			$data['wop'] = $this->m_admin->get_wo_processing($temp);
			$data['wot'] = $this->m_admin->get_wo_terkendala($temp);
			$data['wo'] = $this->m_admin->get_wo($temp);
			$this->load->view('layout/header');
			$this->load->view('Admin/report',$data);
			$this->load->view('layout/footer');
		}
		else {
			redirect('Access');
		}
	}

	public function DetailedReport()
	{
		$temp = $this->uri->segment(3);
		$data['temp'] = $temp;

		if($temp == 'full') {
			$this->load->view('layout/header');
			$this->load->view('Admin/detailedreport',$data);
			$this->load->view('layout/footer');
		}
		else if($temp == 'trouble') {
			$this->load->view('layout/header');
			$this->load->view('Admin/detailedreport',$data);
			$this->load->view('layout/footer');
		}
		else if($temp == 'complete') {
			$this->load->view('layout/header');
			$this->load->view('Admin/detailedreport',$data);
			$this->load->view('layout/footer');
		}
		else if($temp == 'processing') {
			$this->load->view('layout/header');
			$this->load->view('Admin/detailedreport',$data);
			$this->load->view('layout/footer');
		}
		else if($temp == 'leftover') {
			$this->load->view('layout/header');
			$this->load->view('Admin/detailedreport',$data);
			$this->load->view('layout/footer');
		}
	}

	public function ajax_list_full()
	{
        $fase = $this->m_hdm->get_all_fase();
        $nama_teknisi = $this->m_hdm->get_nama_teknisi();
        $status = $this->m_hdm->get_all_status();
        $list = $this->m_admin->get_datatables_full();
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
                        "recordsTotal" => $this->m_admin->count_all(),
                        "recordsFiltered" => $this->m_admin->count_filtered_full(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
	}

	public function ajax_list_trouble()
	{
		$fase = $this->m_hdm->get_all_fase();
        $nama_teknisi = $this->m_hdm->get_nama_teknisi();
        $status = $this->m_hdm->get_all_status();
        $list = $this->m_admin->get_datatables_trouble();
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
                        "recordsTotal" => $this->m_admin->count_all(),
                        "recordsFiltered" => $this->m_admin->count_filtered_trouble(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);	
	}

	public function ajax_list_complete()
	{
		$fase = $this->m_hdm->get_all_fase();
        $nama_teknisi = $this->m_hdm->get_nama_teknisi();
        $status = $this->m_hdm->get_all_status();
        $list = $this->m_admin->get_datatables_completed();
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
                        "recordsTotal" => $this->m_admin->count_all(),
                        "recordsFiltered" => $this->m_admin->count_filtered_completed(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);	
	}

	public function ajax_list_processing()
	{
		$fase = $this->m_hdm->get_all_fase();
        $nama_teknisi = $this->m_hdm->get_nama_teknisi();
        $status = $this->m_hdm->get_all_status();
        $list = $this->m_admin->get_datatables_processing();
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
                        "recordsTotal" => $this->m_admin->count_all(),
                        "recordsFiltered" => $this->m_admin->count_filtered_processing(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);		
	}

	public function ajax_list_leftover()
	{
		$fase = $this->m_hdm->get_all_fase();
        $nama_teknisi = $this->m_hdm->get_nama_teknisi();
        $status = $this->m_hdm->get_all_status();
        $list = $this->m_admin->get_datatables_leftover();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $wo) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $wo->ND;
            $row[] = $wo->NAMA;
            $row[] = $wo->CAREA;
            $row[] = $wo->RK;
            $row[] = $wo->DP;
            $row[] = $wo->UIM_SERVICE_STATUS;  
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->m_admin->count_all_leftover(),
                        "recordsFiltered" => $this->m_admin->count_filtered_leftover(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);	
	}

	public function ajax_list_fase()
    {
        $fase = $this->m_hdm->get_all_fase();
        $temp = 'count';
        $data = array();
        $no = $_POST['start'];
        foreach ($fase as $wo) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $wo->nama_fase;            
            $row[] = $this->m_admin->get_fase_transaksi($wo->id_fase, $temp);
            $url1 = array('Admin','DetailedReport',$wo->id_fase);
     		$row[] = '<a class="btn btn-sm btn-primary" href="Admin/DetailFase/'."$wo->id_fase".'" title="Detail"><iclass="glyphicon glyphicon-ok"></i> Details</a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => '8',
                        "recordsFiltered" => '8',
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function DetailFase()
    {
    	$temp = $this->uri->segment(3);
    	$data['temp'] = $temp;
    	$this->load->view('layout/header');
		$this->load->view('Admin/detailedfase',$data);
		$this->load->view('layout/footer');
    }

    public function ajax_list_id_fase($temp)
    {
    	$fase = $this->m_hdm->get_all_fase();
        $nama_teknisi = $this->m_hdm->get_nama_teknisi();
        $status = $this->m_hdm->get_all_status();
        $list = $this->m_admin->get_datatables_id_fase($temp);
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
                        "recordsTotal" => $this->m_admin->count_all(),
                        "recordsFiltered" => $this->m_admin->count_filtered_processing($temp),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);	
    }

    //manageuser
        public function ManageUser() {
        $data['query_mitra'] = $this->m_user->get_all_mitra();
        $data['select_mitra'] = Array();
        if($data['query_mitra']) {
            foreach($data['query_mitra'] as $m) {
            $data['select_mitra'][$m->id_mitra] = $m->nama_mitra;
            }
        }
        
        $data['query_role'] = $this->m_user->get_all_role();
        $data['select_role'] = Array();
        if($data['query_role']) {
            foreach($data['query_role'] as $r) {
            $data['select_role'][$r->id_role_user] = $r->nama_role_user;
            }
        }

        $this->load->helper('url');
        $this->load->view('layout/header');
        $this->load->view('Admin/manageuser',$data);
        $this->load->view('layout/footer');
    }

    public function ajax_list_user()
    {
        $query_mitra = $this->m_user->get_all_mitra();
        $query_role = $this->m_user->get_all_role();
        $list = $this->m_admin->get_datatables_user();
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
                        "recordsTotal" => $this->m_admin->count_all_user(),
                        "recordsFiltered" => $this->m_admin->count_filtered_user(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit_user($id_user)
    {
        $data = $this->m_admin->get_by_id_user($id_user);
        //$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
 
    public function ajax_add_user()
    {
        $this->_validate_user();
        $data = array(
                'id_user' => $this->input->post('id_user'),
                'id_mitra' => $this->input->post('id_mitra'),
                'id_role_user' => $this->input->post('id_role_user'),
                'username_user' => $this->input->post('username_user'),
                'password_user' => md5($this->input->post('password_user')),
                'nama_user' => $this->input->post('nama_user'),
                'no_telepon_user' => $this->input->post('no_telepon_user'),
            );
        $insert = $this->m_admin->save_user($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update_user()
    {
        $this->_validate_user();
        $data = array(
                'id_user' => $this->input->post('id_user'),
                'id_mitra' => $this->input->post('id_mitra'),
                'id_role_user' => $this->input->post('id_role_user'),
                'username_user' => $this->input->post('username_user'),
                'password_user' => md5($this->input->post('password_user')),
                'nama_user' => $this->input->post('nama_user'),
                'no_telepon_user' => $this->input->post('no_telepon_user'),
            );
        $this->m_admin->update_user(array('id_user' => $this->input->post('id_user')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete_user($id_user)
    {
        $this->m_admin->delete_by_id_user($id_user);
        echo json_encode(array("status" => TRUE));
    }
 
 
    private function _validate_user()
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
            $data['error_string'][] = 'No telepon is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
