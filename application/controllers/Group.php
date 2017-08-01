<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Group extends CI_Controller {   
    public function __construct() {
        parent::__construct();
        $this->load->model('m_group');
        $this->load->model('m_user');
        $this->load->model('m_log');
    }

    public function index() {
        $is_logged_in = $this->session->userdata('is_logged_in');
        if($is_logged_in) {
            $data['page_header'] = 'Tracking WO . . .';
            $mitra = $this->session->userdata('mitra');

            $query2 = $this->m_group->get_all_fase();
            $data['select_fase'] = array();
            foreach ($query2 as $object) {
                $data['select_fase'][$object->id_fase]=$object->nama_fase;
            }

            $query3 = $this->m_group->get_all_status();
            $data['select_status'] = array();
            foreach ($query3 as $object) {
                $data['select_status'][$object->id_status]=$object->nama_status;
            }
            $this->load->view('layout/header',$data);
            $this->load->view('HDTA/Group/trackwohdta',$data);
            $this->load->view('layout/footer');
        }
        else {
            redirect('Access');
        }
    }

    public function ajax_list()
    {
        $fase = $this->m_group->get_all_fase();
        $nama_teknisi = $this->m_group->get_nama_teknisi();
        $status = $this->m_group->get_all_status();
        $list = $this->m_group->get_datatables();
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
            // foreach($status as $object) {
            //     if($object->id_status == $wo->STATUS) $row[] = $object->nama_status; 
            // }
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
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Detail" onclick="detail('."'".$wo->ND."'".')"><i class="glyphicon glyphicon-ok"></i> Detail ND</a>';
            
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->m_group->count_all(),
                        "recordsFiltered" => $this->m_group->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($id_transaksi)
    {
        $data = $this->m_hdm->get_by_id_transaksi($id_transaksi);
        echo json_encode($data);
    }

    public function ajax_detail($ND)
    {
        $data = $this->m_group->get_info_by_ND($ND);
        echo json_encode($data);
    }
 
    public function ajax_add_teknisi()
    {
        //$this->_validate();
        $nd = $this->input->post('ND');
        $data = array(
                'ID_TEKNISI' => $this->input->post('idteknisi'),
                'TGL_INPUT_TEKNISI' => date('Y-m-d'),
                'FASE_TRANSAKSI' => 'FA02',
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
                'id_status_log' => $id_status,
                'keterangan_log' => $data['KETERANGAN_TAMBAHAN'],
                'action_log' => 'ASSIGN TEKNISI',
                'updated_by_log'=> $this->session->userdata('user')
            );
        $this->m_hdm->update(array('ND'=> $this->input->post('ND')), $data);
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
                'id_status_log' => $id_status,
                'keterangan_log' => $data['KETERANGAN_TAMBAHAN'],
                'action_log' => 'TAMBAH SN DAN ODP',
                'updated_by_log'=> $this->session->userdata('user')
            );
        $this->m_hdm->update(array('ND'=> $this->input->post('ND')), $data);
        $this->m_log->insertlog($log);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_change_fase()
    {
        $nd = $this->input->post('ND');
        $data = array(
                'FASE_TRANSAKSI' => $this->input->post('Fase'),
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
                'id_fase_log' => $data['FASE_TRANSAKSI'],
                'id_status_log' => $id_status,
                'keterangan_log' => $data['KETERANGAN_TAMBAHAN'],
                'action_log' => 'CHANGE FASE',
                'updated_by_log'=> $this->session->userdata('user')
            );
        $this->m_hdm->update(array('ND'=> $this->input->post('ND')), $data);
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
        $this->m_hdm->update(array('ND'=> $this->input->post('ND')), $data);
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
        $this->m_hdm->update(array('ND'=> $this->input->post('ND')), $data);
        $this->m_log->insertlog($log);
        echo json_encode(array("status" => TRUE));  
    }

    public function ajax_cancel_order($nd)
    {
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
                'keterangan_log' => 'cancel order by mitra',
                'action_log' => 'CANCEL ORDER',
                'updated_by_log'=> $this->session->userdata('user')
            );
        $this->m_hdm->delete_by_nd($nd);
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
        $mitra = $this->session->userdata('mitra');
        $query_mitra = $this->m_user->get_all_mitra();
        foreach($query_mitra as $object) {
            if($object->id_mitra == $mitra) $namamitra = $object->nama_mitra; 
        }
        $data['nama_mitra'] = $namamitra;
        $this->load->view('layout/header');
        $this->load->view('HDM/manageteknisi', $data);
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
        $this->_validate_teknisi();
        $data = array(
                'id_user' => $this->input->post('id_user'),
                'id_mitra' => $this->session->userdata('mitra'),
                'id_role_user' => 'RO8',
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
                'id_mitra' => $this->session->userdata('mitra'),
                'id_role_user' => 'RO8',
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
            $data['error_string'][] = 'Id Teknisi is required';
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
