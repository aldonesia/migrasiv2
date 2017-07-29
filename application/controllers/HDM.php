<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class HDM extends CI_Controller {	
	public function __construct() {
        parent::__construct();
        $this->load->model('m_hdm');
        $this->load->model('m_user');
        $this->load->model('m_log');
    }

	public function index() {
		$is_logged_in = $this->session->userdata('is_logged_in');
		if($is_logged_in) {
			$data['page_header'] = 'Checking WO . . .';
			$mitra = $this->session->userdata('mitra');

			$query = $this->m_hdm->get_all_teknisi($mitra);
			$data['select_teknisi'] = array();
			foreach ($query as $object) {
				$data['select_teknisi'][$object->id_user]=$object->nama_user;
			}

            $query2 = $this->m_hdm->get_all_fase_HDM();
            $data['select_fase'] = array();
            foreach ($query2 as $object) {
                $data['select_fase'][$object->id_fase]=$object->nama_fase;
            }

            $query3 = $this->m_hdm->get_all_status_HDM();
            $data['select_status'] = array();
            foreach ($query3 as $object) {
                $data['select_status'][$object->id_status]=$object->nama_status;
            }
			$this->load->view('layout/header',$data);
			$this->load->view('HDM/checkwoHDM',$data);
			$this->load->view('layout/footer');
		}
		else {
			redirect('Access');
		}
	}

	public function ajax_list()
    {
    	$mitra = $this->session->userdata('mitra');
    	$fase = $this->m_hdm->get_all_fase();
    	$nama_teknisi = $this->m_hdm->get_nama_teknisi();
        $status = $this->m_hdm->get_all_status();
        $list = $this->m_hdm->get_datatables($mitra);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $wo) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $wo->TGL_DATA_MASUK;
            $row[] = $wo->ND;
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
            foreach($fase as $object) {
                if($object->id_fase == $wo->FASE_TRANSAKSI) $row[] = $object->nama_fase; 
            }
            // foreach($status as $object) {
            //     if($object->id_status == $wo->STATUS) $row[] = $object->nama_status; 
            // }
            if ($wo->STATUS != NULL)
            {
                foreach($status as $object) {
                    if($object->id_status == $wo->STATUS) $row[] = $object->nama_status; 
                }
            }
            else{
                $row[] = $wo->STATUS;
            }
            if ($wo->ESKALASI_KENDALA != NULL)
            {
                foreach($status as $object) {
                    if($object->id_status == $wo->STATUS) $row[] = $object->nama_status; 
                }
            }
            else{
                $row[] = $wo->ESKALASI_KENDALA;
            }
            $row[] = $wo->KETERANGAN_TAMBAHAN;
            $row[] = $wo->ODP;
            $row[] = $wo->SN;
 
            //add html for action 
            if($wo->ID_TEKNISI != NULL)
            {
            	$row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="AddSNODP" onclick="add_sn_odp('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-pencil"></i> Tambah SN ODP</a>
                <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="ChangeFase" onclick="ChangeFase('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-question-sign"></i> Rubah Fase</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="ChangeKendala" onclick="ChangeKendala('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-question-sign"></i> Tambah Kendala</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="AddKeterangan" onclick="add_keterangan('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-pencil"></i> Tambah Keterangan</a>
                  <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Detail" onclick="detail('."'".$wo->ND."'".')"><i class="glyphicon glyphicon-ok"></i> Detail Pelanggan</a>';
            }
            else
            {
            	$row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="AddTeknisi" onclick="add_teknisi('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-plus"></i> Tambah Teknisi</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="AddSNODP" onclick="add_sn_odp('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-pencil"></i> Tambah SN ODP</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="ChangeFase" onclick="ChangeFase('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-question-sign"></i> Rubah Fase</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="ChangeKendala" onclick="ChangeKendala('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-question-sign"></i> Tambah Kendala</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="AddKeterangan" onclick="add_keterangan('."'".$wo->ID_TRANSAKSI."'".')"><i class="glyphicon glyphicon-pencil"></i> Tambah Keterangan</a>
                  <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Detail" onclick="detail('."'".$wo->ND."'".')"><i class="glyphicon glyphicon-ok"></i> Detail Pelanggan</a>';
            }
            
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->m_hdm->count_all(),
                        "recordsFiltered" => $this->m_hdm->count_filtered($mitra),
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
        $data = $this->m_hdm->get_by_ND($ND);
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
        // 	if($nd == $object_keterangan->ND) $keterangan = $object_keterangan->KETERANGAN_TAMBAHAN;
        // }
        
        $log = array(
        		'id_log' => NULL,
        		'tanggal_log' => date('Y-m-d'),
        		'ND_log' => $nd,
        		'id_fase_log' => $id_fase,
        		'id_status_log' => $id_status,
        		'keterangan_log' => $data['KETERANGAN_TAMBAHAN'],
        		'action_log' => 'ASSIGN TEKNISI',
        		'updated_by_log'=> $mitra = $this->session->userdata('nama')
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
        // 	if($nd == $object_keterangan->ND) $keterangan = $object_keterangan->KETERANGAN_TAMBAHAN;
        // }
        
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
                'updated_by_log'=> $mitra = $this->session->userdata('nama')
            );
        $this->m_hdm->update(array('ND'=> $this->input->post('ND')), $data);
        $this->m_log->insertlog($log);  
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_change_kendala()
    {
        $nd = $this->input->post('ND');
        $data = array(
                'ESKALASI_KENDALA' => $this->input->post('Status'),
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
                'updated_by_log'=> $mitra = $this->session->userdata('nama')
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
        		'updated_by_log'=> $this->session->userdata('nama')
        	);
        $this->m_hdm->update(array('ND'=> $this->input->post('ND')), $data);
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
}
