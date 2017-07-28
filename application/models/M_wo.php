<?php
class M_wo extends CI_Model {


        public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }

<<<<<<< HEAD
        function trackingwo($values,$mitra) {
                if($values == 'RO4') $this->db->where_in('id_fase_transaksi',array('FA01','FA02','FA05','FA08','FA10','FA11','FA15'));
                elseif($values == 'RO5') {
                        $this->db->where_in('id_fase_transaksi',array('FA03','FA04','FA06','FA07','FA09','FA12'));
                        $this->db->where('id_mitra_transaksi',$mitra);
                } 
                $query = $this->db->get('transaksi');
                return $query->result();
        }
        /*function trackingwoteknisi($values) {
                $this->db->where('id_user_transaksi',$values);
                $this->db->where_in('id_fase_transaksi',array('FA03','FA04','FA06','FA07','FA09','FA12'));
                $query = $this->db->get('transaksi');
                return $query->result();
        }*/
        function insert_new_wo($values) {
                $sql    = $this->db->insert_string('transaksi',$values);
                $query  = $this->db->query($sql);

                if ($query === TRUE) {
                        return TRUE;
                }
                else {
                        $last_query = $this->db->last_query();
                        return $last_query;
                }
        }

        function insert_log($values) {
                $sql    = $this->db->insert_string('log',$values);
                $query  = $this->db->query($sql);

                if ($query === TRUE) {
                        return TRUE;
                }
                else {
                        $last_query = $this->db->last_query();
                        return $last_query;
                }
        }
=======
    //     function trackingwo($values,$mitra) {
    //             if($values == 'RO4') $this->db->where_in('id_fase_transaksi',array('FA01','FA02','FA05','FA08','FA10','FA11','FA15'));
    //             elseif($values == 'RO5') {
    //                     $this->db->where_in('id_fase_transaksi',array('FA03','FA04','FA06','FA07','FA09','FA12'));
    //                     $this->db->where('id_mitra_transaksi',$mitra);
    //             } 
    //             $query = $this->db->get('transaksi');
    //             return $query->result();
    //     }
    //     function trackingwoteknisi($values) {
    //             $this->db->where('id_user_transaksi',$values);
    //             $this->db->where_in('id_fase_transaksi',array('FA03','FA04','FA06','FA07','FA09','FA12'));
    //             $query = $this->db->get('transaksi');
    //             return $query->result();
    //     }
    //     function insert_new_wo($values) {
    //             $sql    = $this->db->insert_string('transaksi',$values);
    //             $query  = $this->db->query($sql);

    //             if ($query === TRUE) {
    //                     return TRUE;
    //             }
    //             else {
    //                     $last_query = $this->db->last_query();
    //                     return $last_query;
    //             }
    //     }

    //     function insert_log($values) {
    //             $sql    = $this->db->insert_string('log',$values);
    //             $query  = $this->db->query($sql);

    //             if ($query === TRUE) {
    //                     return TRUE;
    //             }
    //             else {
    //                     $last_query = $this->db->last_query();
    //                     return $last_query;
    //             }
    //     }
>>>>>>> d45bc01dc30bcb1ba0224e3efe76e1792a145637

        function checkwo($values) {
                $this->db->where('id_mitra_transaksi',$values);
                $res = $this->db->get('transaksi');
                return $res->result();
        }

<<<<<<< HEAD
        function check_nd($values) {

                $this->db->where('ND_transaksi',$values);
                $result = $this->db->get('transaksi');
                if ($result->num_rows() > 0) {
                        return FALSE;
                }
                else {
                        return TRUE;
                }

        }
=======
    //     function check_nd($values) {

    //             $this->db->where('ND_transaksi',$values);
    //             $result = $this->db->get('transaksi');
    //             if ($result->num_rows() > 0) {
    //                     return FALSE;
    //             }
    //             else {
    //                     return TRUE;
    //             }

    //     }
>>>>>>> d45bc01dc30bcb1ba0224e3efe76e1792a145637
        function assign_teknisi($data) {
                extract($data);
                $this->db->where('id_transaksi',$id);
                $this->db->update('transaksi',array('id_user_transaksi' => $tek));
                return true;
        }

<<<<<<< HEAD
        function update_wo($data) {
                extract($data);
                $this->db->where('id_transaksi',$id);
                if($keterangan) $this->db->update('transaksi',array('id_fase_transaksi' => $fase, 'id_status_transaksi' => $status,'keterangan_transaksi' => $keterangan, 'tanggal_transaksi' => $tanggal));
                else $this->db->update('transaksi',array('id_fase_transaksi' => $fase, 'id_status_transaksi' => $status,'tanggal_transaksi' => $tanggal));
                return true;
        }
        function update_keterangan($data) {
                extract($data);
                $this->db->where('id_transaksi',$id);
                if($keterangan) $this->db->update('transaksi',array('keterangan_transaksi' => $keterangan, 'tanggal_transaksi' => $tanggal));
                else $this->db->update('transaksi',array('id_fase_transaksi' => $fase, 'id_status_transaksi' => $status,'tanggal_transaksi' => $tanggal));
                return true;
        }

        function check_if_nd_exists($values) {

                $this->db->where('ND',$values);
                $result = $this->db->get('temporary');
                if ($result->num_rows() > 0) {
                        return FALSE;
                }
                else {
                        return TRUE;
                }

        }
        function get_rk() {
                $this->db->distinct();
                $this->db->select('RK');
                $res = $this->db->get('temporary');
                return $res->result();
        }

        function get_STO() {
                $this->db->distinct();
                $this->db->select('CAREA');
                $res = $this->db->get('temporary');
                return $res->result();
        }

        function check() {
                $res = $this->db->get('temporary');
                return $res->result();
        }

        function get_info_nd_by_rk($values) {
                $this->db->where('`ND` NOT IN (SELECT `ND` FROM `transaksi`)');
                $this->db->where('RK',$values);
                $res = $this->db->get('temporary');
                return $res->result();
        }
        function get_rk_by_sto($values) {
                $this->db->distinct();
                $this->db->select('RK');
                $this->db->where('CAREA',$values);
                $res = $this->db->get('temporary');
                return $res->result();
        }
        function get_dp_by_rk($values) {
                $this->db->distinct();
                $this->db->select('DP');
                $this->db->where('RK',$values);
                $res = $this->db->get('temporary');
                return $res->result();
        }
        function get_nd_by_dp($values) {
                $this->db->select('ND');
                $this->db->where('DP',$values);
                $res = $this->db->get('temporary');
                return $res->result();
        }
        function get_info_nd_by_dp($values) {
                $this->db->where('`ND` NOT IN (SELECT `ND` FROM `transaksi`)');
                $this->db->where('DP',$values);
                $res = $this->db->get('temporary');
                return $res->result();
        }
        function get_log_wo($values) {
                $this->db->where('ND_log',$values);
                $res = $this->db->get('log');
                return $res->result();
        }

        function addWO_js($values){
                foreach($values as $object) {
                        $field = array(
                                
                                'ID_TRANSAKSI' => NULL,
                                'TGL_DATA_MASUK' => date("Y-m-d"),
                                'FASE_TRANSAKSI'=> 'FA01',      
                                'MITRA'=>$this->input->post('mitra'),
                                'NAMA_PELANGGAN'=>$object->NAMA,
                                'ND'=>$object->ND,
                                'USER_INTERNET'=>$object->ND_REFERENCE,
                                'STO'=>$object->CAREA,
                                'HD_GRUP'=>'103',
                                'STATUS_DP'=>$object->UIM_SERVICE_STATUS,
                                'LAYANAN'=>$object->TIPE_SERVICES
                        );
                        $this->db->insert('transaksi', $field);        
                }
                
                if($this->db->affected_rows() > 0){
                        return true;
                }else{
                        return false;
                }
        }

        var $table = 'temporary';
        var $column_order = array('NCLI','ND','CAREA','RK','DP','UIM_SERVICE_STATUS',null); //set column field database for datatable orderable
        var $column_search = array('NCLI','ND','CAREA','RK','DP'); //set column field database for datatable searchable just firstname , lastname , address are searchable
        var $order = array('ND' => 'desc'); // default order 

        private function _get_datatables_query()
        {
            $this->db->where('`ND` NOT IN (SELECT `ND` FROM `transaksi`)');
            $this->db->from($this->table);
        
        //$this->db->get('temporary');
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
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
 
    public function get_by_nd($ND)
    {
        $this->db->from($this->table);
        $this->db->where('ND',$ND);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    public function get_info_nd($values) {
        $this->db->where('ND',$values);
        $res = $this->db->get('temporary');
        return $res->result();
    }
    public function insert_wo($values,$values_mitra){
        foreach($values as $object) {
            $field = array(
                'ID_TRANSAKSI' => NULL,
                'TGL_DATA_MASUK' => date("Y-m-d"),
                'FASE_TRANSAKSI'=> 'FA01',      
                'MITRA'=>$values_mitra,
                'NAMA_PELANGGAN'=>$object->NAMA,
                'ND'=>$object->ND,
                'USER_INTERNET'=>$object->ND_REFERENCE,
                'STO'=>$object->CAREA,
                'HD_GRUP'=>'103',
                'STATUS_DP'=>$object->UIM_SERVICE_STATUS,
                'LAYANAN'=>$object->TIPE_SERVICES
            );
        $this->db->insert('transaksi', $field);        
        }
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
=======
    //     function update_wo($data) {
    //             extract($data);
    //             $this->db->where('id_transaksi',$id_transaksi);
    //             if($keterangan_transaksi) $this->db->update('transaksi',array('id_fase_transaksi' => $fase_transaksi, 'id_status_transaksi' => $status_transaksi,'keterangan_transaksi' => $keterangan_transaksi, 'tanggal_transaksi' => $tanggal_transaksi));
    //             else $this->db->update('transaksi',array('id_fase_transaksi' => $fase_transaksi, 'id_status_transaksi' => $status_transaksi,'tanggal_transaksi' => $tanggal_transaksi));
    //             return true;
    //     }
    //     function update_keterangan($data) {
    //             extract($data);
    //             $this->db->where('id_transaksi',$id_transaksi);
    //             if($keterangan_transaksi) $this->db->update('transaksi',array('keterangan_transaksi' => $keterangan_transaksi, 'tanggal_transaksi' => $tanggal_transaksi));
    //             else $this->db->update('transaksi',array('id_fase_transaksi' => $fase_transaksi, 'id_status_transaksi' => $status_transaksi,'tanggal_transaksi' => $tanggal_transaksi));
    //             return true;
    //     }

    //     function check_if_nd_exists($values) {

    //             $this->db->where('ND',$values);
    //             $result = $this->db->get('temporary');
    //             if ($result->num_rows() > 0) {
    //                     return FALSE;
    //             }
    //             else {
    //                     return TRUE;
    //             }

    //     }
    //     function get_rk() {
    //             $this->db->distinct();
    //             $this->db->select('RK');
    //             $this->db->order_by("RK", "asc");
    //             $res = $this->db->get('temporary');
    //             return $res->result();
    //     }

    //     function get_STO() {
    //             $this->db->distinct();
    //             $this->db->select('CAREA');
    //             $res = $this->db->get('temporary');
    //             return $res->result();
    //     }

    //     function check() {
    //             $res = $this->db->get('temporary');
    //             return $res->result();
    //     }

    //     function get_nd_by_rk($values) {
    //             $this->db->select();
    //             $this->db->where('RK',$values);
    //             $res = $this->db->get('temporary');
    //             return $res->result();
    //     }
    //     function get_rk_by_sto($values) {
    //             $this->db->distinct();
    //             $this->db->select('RK');
    //             $this->db->where('CAREA',$values);
    //             $res = $this->db->get('temporary');
    //             return $res->result();
    //     }
    //     function get_dp_by_rk($values) {
    //             $this->db->distinct();
    //             $this->db->select('DP');
    //             $this->db->where('RK',$values);
    //             $res = $this->db->get('temporary');
    //             return $res->result();
    //     }
    //     function get_nd_by_dp($values) {
    //             $this->db->select('ND');
    //             $this->db->where('DP',$values);
    //             $res = $this->db->get('temporary');
    //             return $res->result();
    //     }
    //     function get_info_nd_by_dp($values) {
    //             $this->db->where('DP',$values);
    //             $res = $this->db->get('temporary');
    //             return $res->result();
    //     }
    //     function get_log_wo($values) {
    //             $this->db->where('ND_log',$values);
    //             $res = $this->db->get('log');
    //             return $res->result();
    //     }

    //     function addWO_js($values){
    //             foreach($values as $object) {
    //                     $field = array(
    //                             'id_transaksi' => NULL,
    //                             'tanggal_transaksi'=>date("Y-m-d"),
    //                             'ND_transaksi'=>$object->ND,
    //                             'STO_transaksi'=>$object->CAREA,
    //                             'RK_transaksi'=>$object->RK,
    //                             'DP_transaksi'=>$object->DP,
    //                             'status_comply_transaksi'=>$object->UIM_SERVICE_STATUS,
    //                             'id_fase_transaksi'=>'FA01',
    //                             'id_status_transaksi'=>'ST25',
    //                             'id_mitra_transaksi'=>$this->input->post('mitra'),
    //                             'id_user_transaksi'=> NULL,
    //                             'keterangan_transaksi'=>'tidak ada keterangan'
    //                     );
    //                     $this->db->insert('transaksi', $field);        
    //             }
                
    //             if($this->db->affected_rows() > 0){
    //                     return true;
    //             }else{
    //                     return false;
    //             }
    //     }
    //     function deletetemporary($values) {
    //         $this->db->where('ND', $values);
    //         $this->db->delete('temporary');
    //     }
    //     // js di bawah
    //     var $table = 'temporary';
    //     var $column_order = array('NCLI','ND','CAREA','RK','DP','UIM_SERVICE_STATUS',null); //set column field database for datatable orderable
    //     var $column_search = array('NCLI','ND','CAREA','RK','DP'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    //     var $order = array('ND' => 'desc'); // default order 

    //     private function _get_datatables_query()
    // {
    //     $this->db->from($this->table);
        
    //     //$this->db->get('temporary');
    //     $i = 0;
     
    //     foreach ($this->column_search as $item) // loop column 
    //     {
    //         if($_POST['search']['value']) // if datatable send POST for search
    //         {
                 
    //             if($i===0) // first loop
    //             {
    //                 $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
    //                 $this->db->like($item, $_POST['search']['value']);
    //             }
    //             else
    //             {
    //                 $this->db->or_like($item, $_POST['search']['value']);
    //             }
 
    //             if(count($this->column_search) - 1 == $i) //last loop
    //                 $this->db->group_end(); //close bracket
    //         }
    //         $i++;
    //     }
         
    //     if(isset($_POST['order'])) // here order processing
    //     {
    //         $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    //     } 
    //     else if(isset($this->order))
    //     {
    //         $order = $this->order;
    //         $this->db->order_by(key($order), $order[key($order)]);
    //     }
    // }
 
    // function get_datatables()
    // {
    //     $this->_get_datatables_query();
    //     if($_POST['length'] != -1)
    //     $this->db->limit($_POST['length'], $_POST['start']);
    //     $query = $this->db->get();
    //     return $query->result();
    // }
 
    // function count_filtered()
    // {
    //     $this->_get_datatables_query();
    //     $query = $this->db->get();
    //     return $query->num_rows();
    // }
 
    // public function count_all()
    // {
    //     $this->db->from($this->table);
    //     return $this->db->count_all_results();
    // }
 
    // public function get_by_nd($ND)
    // {
    //     $this->db->from($this->table);
    //     $this->db->where('ND',$ND);
    //     $query = $this->db->get();
 
    //     return $query->row();
    // }
 
    // public function save($data)
    // {
    //     $this->db->insert($this->table, $data);
    //     return $this->db->insert_id();
    // }
    // public function get_info_nd($values) {
    //     $this->db->where('ND',$values);
    //     $res = $this->db->get('temporary');
    //     return $res->result();
    // }
    // public function insert_wo($values,$values_mitra){
    //     foreach($values as $object) {
    //         $field = array(
    //             'id_transaksi' => NULL,
    //             'tanggal_transaksi'=>date("Y-m-d"),
    //             'ND_transaksi'=>$object->ND,
    //             'STO_transaksi'=>$object->CAREA,
    //             'RK_transaksi'=>$object->RK,
    //             'DP_transaksi'=>$object->DP,
    //             'status_comply_transaksi'=>$object->UIM_SERVICE_STATUS,
    //             'id_fase_transaksi'=>'FA01',
    //             'id_status_transaksi'=>'ST25',
    //             'id_mitra_transaksi'=>$values_mitra,
    //             'id_user_transaksi'=> NULL,
    //             'keterangan_transaksi'=>'tidak ada keterangan'
    //         );
    //     $this->db->insert('transaksi', $field);        
    //     }
    //     if($this->db->affected_rows() > 0){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }
>>>>>>> d45bc01dc30bcb1ba0224e3efe76e1792a145637
}