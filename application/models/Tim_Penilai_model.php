<?php

class Tim_Penilai_model extends MY_Model {
    public $_table = 'tim_penilai'; 
    
    public function join_table($table, $relation, $where = null) {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join($table, $relation);
        if ($where != null) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result();
    }
}