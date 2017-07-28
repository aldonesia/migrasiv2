<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_log exteNDs CI_Model
{
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function getfase()
    {
    	$this->db->select(array('ND','FASE_TRANSAKSI'));
        $this->db->from('transaksi');
        $sql = $this->db->get();
        return $sql->result();
    }

    function getstatus()
    {
    	$this->db->select(array('ND','STATUS'));
        $this->db->from('transaksi');
        $sql = $this->db->get();
        return $sql->result();
    }

    function getketerangan()
    {
    	$this->db->select(array('ND','KETERANGAN_TAMBAHAN'));
        $this->db->from('transaksi');
        $sql = $this->db->get();
        return $sql->result();
    }

    function insertlog($log)
    {
    	$this->db->insert('log', $log);
        if($this->db->affected_rows() >0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}