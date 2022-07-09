<?php

class Perangkingan_model extends CI_Model
{

    public $table = "perangkingan";

    public function get_all()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_all_order($coloumn, $type_order){
      $this->db->select('*');
      $this->db->from($this->table);        
      $this->db->order_by($coloumn, $type_order);

      $query = $this->db->get();        
      
      return $query->result();
  }

    public function insert_one($data)
    {
        $query = $this->db->insert($this->table, $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    public function update_one($id, $data)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }
}
