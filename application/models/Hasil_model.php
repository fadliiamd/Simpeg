<?php

class Hasil_model extends CI_Model
{

    public $table = "hasilperangkingan";

    public function get_all()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function insert_one($data)
    {
        $query = $this->db->insert($this->table, $data);
        return ($this->db->affected_rows() != 1) ? false : true;
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
