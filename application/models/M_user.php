<?php
class M_user extends CI_Model {


        public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }

        function get_user_data($values) {
                $this->db->where('username_user',$values);
                $res = $this->db->get('user');
                if ($res->num_rows() > 0) {
                        return $res->result();
                }
        }

    //     function get_all_mitra() {
    //             $sql = $this->db->get('mitra');
    //             return $sql->result();
    //     }

    //     function get_all_role() {
    //             $sql = $this->db->get('role_user');
    //             return $sql->result();
    //     }

        function get_all_status() {
                $res = $this->db->get('status');
                return $res->result();
        }

        function get_all_fase() {
                $res = $this->db->get('fase');
                return $res->result();
        }

        function get_all_teknisi($values) {
                $this->db->where('id_mitra',$values);
                $this->db->where('id_role_user','RO6');
                $res = $this->db->get('user');
                if ($res->num_rows() > 0)  return $res->result();
                else return FALSE;
        }

    //     function get_all_user() {
    //             $sql = $this->db->get('user');
    //             return $sql->result();
    //     }                

    //     function insert_new_user($values) {
    //             $sql    = $this->db->insert_string('user',$values);
    //             $query  = $this->db->query($sql);

    //             if ($query === TRUE) {
    //                     return TRUE;
    //             }
    //             else {
    //                     $last_query = $this->db->last_query();
    //                     return $last_query;
    //             }
    //     }


    //     function check_role_name($values) {
    //             $this->db->where('id_role_user',$values);
    //             $res = $this->db->get('role_user');
    //             return $res->result();
    //     }

    //     function check_role($values) {
    //             $this->db->where('username_user',$values);
    //             $res = $this->db->get('user');
    //             if ($res->num_rows() > 0) {
    //                     return $res->result();
    //             }
    //     }

        function check_mitra($values) {
                $this->db->where('id_mitra',$values);
                $res = $this->db->get('mitra');
                return $res->result();
        }

    //     function check_if_username_exists($username) {

    //             $this->db->where('username_user',$username);
    //             $result = $this->db->get('user');
    //             if ($result->num_rows() > 0) {
    //                     return FALSE;
    //             }
    //             else {
    //                     return TRUE;
    //             }

    //     }

    //     //js below

    //     var $table = 'user';
    //     var $column_order = array('id_user','id_mitra','id_role_user','username_user','password_user','nama_user', 'no_telepon_user',null); //set column field database for datatable orderable
    //     var $column_search = array('id_user','username_user','nama_user','no_telepon_user'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    //     var $order = array('id_user' => 'desc'); // default order 

    //     private function _get_datatables_query()
    // {
         
    //     $this->db->from($this->table);
    //     // $this->db->select('*');
    //     // $this->db->from('user u'); 
    //     // $this->db->join('mitra m', 'm.id_mitra=u.id_mitra', 'left');
    //     // $this->db->join('role_user r', 'r.id_role_user=u.id_role_user', 'left');
    //     //$this->db->order_by('u.nama_user','asc');         
    //     //$this->db->get(); 
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
 
    // public function get_by_id_user($id_user)
    // {
    //     $this->db->from($this->table);
    //     $this->db->where('id_user',$id_user);
    //     $query = $this->db->get();
 
    //     return $query->row();
    // }
 
    // public function save($data)
    // {
    //     $this->db->insert($this->table, $data);
    //     return $this->db->insert_id();
    // }
 
    // public function update($where, $data)
    // {
    //     $this->db->update($this->table, $data, $where);
    //     return $this->db->affected_rows();
    // }
 
    // public function delete_by_id_user($id_user)
    // {
    //     $this->db->where('id_user', $id_user);
    //     $this->db->delete($this->table);
    // }

}