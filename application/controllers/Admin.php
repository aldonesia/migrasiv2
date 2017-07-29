<?php if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class Admin extends CI_Controller 
{	
	public function __construct() 
	{
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->model('m_hdm');
        $this->load->model('m_log');
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
}
