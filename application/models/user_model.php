<?php 

    class user_model extends CI_Model{
        
        public function getData($table){
            $result = $this->db->get($table)->result_array();
            return $result;
        }

        public function getId($table,$user){
            $this->db->where('username', $user);
            $this->db->or_where('email', $user);
            return $this->db->get($table)->row_array();
        }

        public function insertData($table,$data){
            $this->db->insert($table,$data);
        }

        public function update($table,$where,$set){
            $this->db->set($set);
            $this->db->where($where);
            $this->db->update($table);
        }

        public function getJurnal($table,$where){
            return $this->db->get_where($table,$where)->result_array();
        }
        public function getUsers($table,$where){
            return $this->db->get_where($table,$where)->row_array();
        }

        public function Cari(){
        $keyword = $this->input->post('keyword', true);
        $this->db->like('title', $keyword);
        $this->db->or_like('tahun', $keyword);
        return $this->db->get('jurnal')->result_array();
        }

        public function getAll($table){
            return $this->db->get($table)->result_array();
        }
    }


?>