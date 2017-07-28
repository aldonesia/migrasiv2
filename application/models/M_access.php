<?php

class M_access extends CI_Model {

        public function __construct() {
                parent::__construct();
                // Your own constructor code
        }

        function validate($value1,$value2) {
                $this->db->where('username_user',$value1);
                $this->db->where('password_user',$value2);
                $query = $this->db->get('user');
                if($query->num_rows() == 1) {
                        return TRUE;
                }
                else {
                        return FALSE;
                }
        }
}