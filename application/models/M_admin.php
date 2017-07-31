<?php
class M_admin extends CI_Model 
{
        var $table = 'transaksi';
	    var $column_order = array('TGL_DATA_MASUK','FASE_TRANSAKSI','MITRA','ID_TEKNISI','TGL_INPUT_TEKNISI','NAMA_PELANGGAN','ND','USER_INTERNET','ODP','STO','PASSWORD_VOICE','SN','HD_GRUP','KEDETECT_LAPANGAN','MAINCORE','STATUS','ONU_ID','UPDATE_LAYANAN','TGL_LAYANAN UP','HD_LOGIC','ESKALASI_KENDALA','STATUS_DP','KETERANGAN_TAMBAHAN','LAYANAN','SC','HD_INPUTER','TGL_INPUT','HD_PS','STATUS_PS','TGL_PS',null); //set column field database for datatable orderable
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
		var $column_order2 = array('ND','ND_REFERENCE','IPTV','TIPE_SERVICES','NAMA','CAREA','RK','DP','ALPRO','UIM_SERVICE_STATUS',null); //set column field database for datatable orderable
		var $column_search2 = array('ND'); //set column field database for datatable searchable just firstname , lastname , address are searchable
		var $order2 = array('ND' => 'asc'); // default order 
	    //------------
	    private function _get_datatables_query_leftover()
	    {
	    	$query1 = $this->db->query("select ND from transaksi");
	    	$query1_result = $query1->result();
	    	$nd_transaksi= array();
  			foreach($query1_result as $row)
  			{
     			$nd_transaksi[] = $row->ND;
   			}


	    	$this->db->where_not_in('ND', $nd_transaksi);
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
        	$query1 = $this->db->query("select ND from transaksi");
	    	$query1_result = $query1->result();
	    	$nd_transaksi= array();
  			foreach($query1_result as $row)
  			{
     			$nd_transaksi[] = $row->ND;
   			}

	    	$this->db->where_not_in('ND', $nd_transaksi);
	        $this->db->from('temporary');
            $query = $this->db->get();
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


	    //manage user

	    var $table_user = 'user';
        var $column_order_user = array('id_user','id_mitra','id_role_user','username_user','password_user','nama_user', 'no_telepon_user',null); //set column field database for datatable orderable
        var $column_search_user = array('id_user','username_user','nama_user','no_telepon_user'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        var $order_user = array('id_user' => 'desc'); // default order 

        private function _get_datatables_query_user()
	    {
	         
	        $this->db->from($this->table_user);
	        
	        $i = 0;
	     
	        foreach ($this->column_search_user as $item) // loop column 
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
	 
	                if(count($this->column_search_user) - 1 == $i) //last loop
	                    $this->db->group_end(); //close bracket
	            }
	            $i++;
	        }
	         
	        if(isset($_POST['order'])) // here order processing
	        {
	            $this->db->order_by($this->column_order_user[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
	        } 
	        else if(isset($this->order_user))
	        {
	            $order_user = $this->order_user;
	            $this->db->order_by(key($order_user), $order_user[key($order_user)]);
	        }
	    }
	 
	    function get_datatables_user()
	    {
	        $this->_get_datatables_query_user();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }
	 
	    function count_filtered_user()
	    {
	        $this->_get_datatables_query_user();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    public function count_all_user()
	    {
	        $this->db->from($this->table_user);
	        return $this->db->count_all_results();
	    }
	 
	    public function get_by_id_user($id_user)
	    {
	        $this->db->from($this->table_user);
	        $this->db->where('id_user',$id_user);
	        $query = $this->db->get();
	 
	        return $query->row();
	    }
	 
	    public function save_user($data)
	    {
	        $this->db->insert($this->table_user, $data);
	        return $this->db->insert_id();
	    }
	 
	    public function update_user($where, $data)
	    {
	        $this->db->update($this->table_user, $data, $where);
	        return $this->db->affected_rows();
	    }
	 
	    public function delete_by_id_user($id_user)
	    {
	        $this->db->where('id_user', $id_user);
	        $this->db->delete($this->table_user);
	    }
}