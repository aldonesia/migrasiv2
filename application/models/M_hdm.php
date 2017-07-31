<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_hdm extends CI_Model {
 
    var $table = 'transaksi';
    var $column_order = array('TGL_DATA_MASUK','FASE_TRANSAKSI','KETERANGAN_TAMBAHAN','TGL_INPUT_TEKNISI','ID_TEKNISI','ND','NAMA_PELANGGAN','STATUS','ODP','SN','TGL_LAYANAN_UP','UPDATE_LAYANAN','ESKALASI_KENDALA','STATUS_DP','TGL_input','TGL_PS','STATUS_PS',null); //set column field database for datatable orderable
    var $column_search = array('ND'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('ID_TRANSAKSI' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query($id_mitra)
    {
        $this->db->where('MITRA', $id_mitra);
        $this->db->where_in('FASE_TRANSAKSI', array('FA01','FA02','FA03','FA04','FA05','FA06'));
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables($mitra)
    {
        $this->_get_datatables_query($mitra);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($mitra)
    {
        $this->_get_datatables_query($mitra);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function delete_by_nd($nd)
    {
        $this->db->where('ND', $nd);
        $this->db->delete($this->table);
    }
 
    public function get_by_id_transaksi($id_transaksi)
    {
        $this->db->select('ND');
        $this->db->from($this->table);
        $this->db->where('ID_TRANSAKSI',$id_transaksi);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function get_by_ND($ND)
    {
        $this->db->select(array('ND','NAMA','CAREA','RK','DP'));
        $this->db->from('temporary');
        $this->db->where('ND',$ND);
        $query = $this->db->get();
 
        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
 
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        if($this->db->affected_rows() >0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function get_all_fase() {
        $sql = $this->db->get('fase');
        return $sql->result();
    }

    public function get_all_fase_HDM() {
        $this->db->select(array('id_fase','nama_fase'));
        $this->db->from('fase');
        $this->db->where_in('id_fase', array('FA02','FA03','FA04','FA05','FA06'));
        $sql = $this->db->get();
        return $sql->result();
    }

    public function get_nama_teknisi() {
        $sql = $this->db->get('user');
        return $sql->result();
    }

    public function get_nama_mitra() {
        $sql = $this->db->get('mitra');
        return $sql->result();
    }

    public function get_all_status() {
        $sql = $this->db->get('status');
        return $sql->result();
    }

    public function get_all_status_hdm() {
        $this->db->select(array('id_status','nama_status'));
        $this->db->from('status');
        $this->db->where_in('id_status', array('ST06','ST08','ST09','ST10','ST13','ST02'));
        $sql = $this->db->get();
        return $sql->result();
    }

    public function get_all_teknisi($mitra) {
        $this->db->select(array('id_user','nama_user'));
        $this->db->from('user');
        $this->db->where('id_mitra', $mitra);
        $this->db->where('id_role_user', 'RO8');
        $sql = $this->db->get();
        return $sql->result();
    }

    //trackwo
    private function _get_datatables_query_tw($id_mitra)
    {
        $this->db->where('MITRA', $id_mitra);
        $this->db->where_in('FASE_TRANSAKSI', array('FA06','FA07','FA08'));
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables_tw($mitra)
    {
        $this->_get_datatables_query_tw($mitra);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered_tw($mitra)
    {
        $this->_get_datatables_query_tw($mitra);
        $query = $this->db->get();
        return $query->num_rows();
    }

    //teknisi

    var $tablet = 'user';
    var $column_ordert = array('id_user','id_mitra','id_role_user','username_user','password_user','nama_user', 'no_telepon_user',null); //set column field database for datatable orderable
    var $column_searcht = array('id_user','username_user','nama_user','no_telepon_user'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $ordert = array('id_user' => 'desc'); // default order 

    private function _get_datatables_query_teknisi($mitra)
    {
        $this->db->where('id_mitra', $mitra);
        $this->db->where('id_role_user', 'RO8');
        $this->db->from($this->tablet);
       
        $i = 0;
     
        foreach ($this->column_searcht as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_searcht) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_ordert[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->ordert))
        {
            $ordert = $this->ordert;
            $this->db->order_by(key($ordert), $ordert[key($ordert)]);
        }
    }
 
    function get_datatables_teknisi($mitra)
    {
        $this->_get_datatables_query_teknisi($mitra);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered_teknisi($mitra)
    {
        $this->_get_datatables_query_teknisi($mitra);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all_teknisi()
    {
        $this->db->from($this->tablet);
        return $this->db->count_all_results();
    }
 
    public function get_by_id_user_teknisi($id_user)
    {
        $this->db->from($this->tablet);
        $this->db->where('id_user',$id_user);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save_teknisi($data)
    {
        $this->db->insert($this->tablet, $data);
        return $this->db->insert_id();
    }
 
    public function update_teknisi($where, $data)
    {
        $this->db->update($this->tablet, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id_user_teknisi($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete($this->tablet);
    }

}