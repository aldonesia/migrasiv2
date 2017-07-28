<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_wo extends CI_Model {
 
    var $table = 'transaksi';
    var $column_order = array('TGL_DATA_MASUK','FASE_TRANSAKSI','KETERANGAN_TAMBAHAN','TGL_INPUT_TEKNISI','ID_TEKNISI','ND','NAMA_PELANGGAN','STO','ODP','SN',null); //set column field database for datatable orderable
    var $column_search = array('FASE','ND'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('ID_TRANSAKSI' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query($id_mitra)
    {
        $this->db->where('MITRA', $id_mitra);
        $this->db->where_in('FASE_TRANSAKSI', array('FA02','FA03','FA04','FA05','FA06'));
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
 
    public function get_by_id_transaksi($id_transaksi)
    {
        $this->db->select('ND');
        $this->db->from($this->table);
        $this->db->where('ID_TRANSAKSI',$id_transaksi);
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

    public function get_nama_teknisi() {
        $sql = $this->db->get('user');
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
}