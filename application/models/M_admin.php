<?php
class M_admin extends CI_Model 
{
        var $table = 'transaksi';
	    var $column_order = array('TGL_DATA_MASUK','FASE_TRANSAKSI','KETERANGAN_TAMBAHAN','TGL_INPUT_TEKNISI','ID_TEKNISI','ND','NAMA_PELANGGAN','STATUS','ODP','SN','TGL_LAYANAN_UP','UPDATE_LAYANAN','ESKALASI_KENDALA','STATUS_DP','TGL_input','TGL_PS','STATUS_PS',null); //set column field database for datatable orderable
	    var $column_search = array('ND'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	    var $order = array('ID_TRANSAKSI' => 'asc'); // default order 
	 
	    public function __construct()
        {
                parent::__construct();
        }

        public function count_all()
	    {
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    }

        //full
	    private function _get_datatables_query_full()
	    {
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
	 
	    function get_datatables_full()
	    {
	        $this->_get_datatables_query_full();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_full()
	    {
	        $this->_get_datatables_query_full();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    // trouble
	    private function _get_datatables_query_trouble()
	    {
	    	$this->db->where('FASE_TRANSAKSI !=', 'FA08');
            $this->db->where('ESKALASI_KENDALA !=', NULL);	
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
	 
	    function get_datatables_trouble()
	    {
	        $this->_get_datatables_query_trouble();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_trouble()
	    {
	        $this->_get_datatables_query_trouble();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    //completed
	    private function _get_datatables_query_completed()
	    {
	    	$this->db->where('FASE_TRANSAKSI', 'FA08');
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
	 
	    function get_datatables_completed()
	    {
	        $this->_get_datatables_query_completed();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_completed()
	    {
	        $this->_get_datatables_query_completed();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    //processing
	    private function _get_datatables_query_processing()
	    {
	    	$this->db->where('FASE_TRANSAKSI !=', 'FA08');
            $this->db->where('ESKALASI_KENDALA', NULL);
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
	 
	    function get_datatables_processing()
	    {
	        $this->_get_datatables_query_processing();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_processing()
	    {
	        $this->_get_datatables_query_processing();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	    //leftover
	    //------------
	    var $table2 = 'temporary';
		var $column_order2 = array('ND','NAMA','CAREA','RK','DP','ND','UIM_SERVICE_STATUS',null); //set column field database for datatable orderable
		var $column_search2 = array('ND'); //set column field database for datatable searchable just firstname , lastname , address are searchable
		var $order2 = array('ND' => 'asc'); // default order 
	    //------------
	    private function _get_datatables_query_leftover()
	    {
	    	
	        $this->db->from($this->table2);
	 
	        $i = 0;
	     
	        foreach ($this->column_search2 as $item) // loop column 
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
	 
	                if(count($this->column_search2) - 1 == $i) //last loop
	                    $this->db->group_end(); //close bracket
	            }
	            $i++;
	        }
	         
	        if(isset($_POST['order'])) // here order processing
	        {
	            $this->db->order_by($this->column_order2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order2))
	        {
	            $order2 = $this->order2;
	            $this->db->order_by(key($order2), $order2[key($order2)]);
	        }
	    }
	 
	    function get_datatables_leftover()
	    {
	        $this->_get_datatables_query_leftover();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_leftover()
	    {
	        $this->_get_datatables_query_leftover();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }


	    public function count_all_leftover()
	    {
	        $this->db->from($this->table2);
	        return $this->db->count_all_results();
	    }

	    //-------------------------------------------------------//
        function get_wo_sisa($values) {
                $query = $this->db->get('temporary');
                if($values == 'count') return $query->num_rows();
                else return $query->result();
        }

        function get_wo_processing($values) {
                $this->db->where('FASE_TRANSAKSI !=', 'FA08');
                $this->db->where('ESKALASI_KENDALA', NULL);
                $query = $this->db->get('transaksi');
                if($values == 'count') return $query->num_rows();
                else return $query->result();
        }

        function get_wo_complete($values) {
                $this->db->where('FASE_TRANSAKSI', 'FA08');
                $query = $this->db->get('transaksi');
                if($values == 'count') return $query->num_rows();
                else return $query->result();
        }

        function get_wo_terkendala($values) {
        		$this->db->where('FASE_TRANSAKSI !=', 'FA08');
                $this->db->where('ESKALASI_KENDALA !=', NULL);
                $query = $this->db->get('transaksi');
                if($values == 'count') return $query->num_rows();
                else return $query->result();
        }

        function get_wo($values) {
                $query = $this->db->get('transaksi');
                if($values == 'count') return $query->num_rows();
                else return $query->result();
        }

        public function get_fase_transaksi($id_fase, $values) 
        {
        	$this->db->from('transaksi');
        	$this->db->where('FASE_TRANSAKSI',$id_fase);
        	$query = $this->db->get();
        	if($values == 'count') return $query->num_rows();
                else return $query->result();
    	}

    	private function _get_datatables_query_id_fase($id_fase)
	    {
	    	$this->db->where('FASE_TRANSAKSI', $id_fase);
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
	 
	    function get_datatables_id_fase($id_fase)
	    {
	        $this->_get_datatables_query_id_fase($id_fase);
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_id_fase($id_fase)
	    {
	        $this->_get_datatables_query_trouble($id_fase);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
}