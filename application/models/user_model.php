<?php 

    class user_model extends CI_Model{
        
        public function getData($table){
            $result = $this->db->get($table)->result_array();
            return $result;
        }

        public function insertData($table,$data){
            $this->db->insert($table,$data);
        }

        public function getUsers($table,$where){
            return $this->db->get_where($table,$where)->row_array();
        }

        public function getAll($table){
            return $this->db->get($table)->result_array();
        }
    }


?>