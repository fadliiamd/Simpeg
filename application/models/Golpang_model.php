<?php

class Golpang_model extends CI_Model
{

    public $table = "pangkatgolongan";

    public function get_all()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function insert_one()
    {
        $golongan = $this->input->post('golongan');
        $pangkat = $this->input->post('pangkat');

        $data = array(
            "golongan" => $golongan,
            "pangkat" => $pangkat
        );

        $this->db->insert($this->table, $data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update_one($id)
    {        
        $golongan = $this->input->post('golongan');
        $pangkat = $this->input->post('pangkat');

        $data = array(
            "golongan" => $golongan,
            "pangkat" => $pangkat
        );
        
        $this->db->trans_start();
        $this->db->where('golongan', $id);
        $sql = $this->db->update($this->table, $data);        
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }

    public function delete_one($id)
    {
        $this->db->trans_start();
        $this->db->where('golongan', $id);
        $this->db->delete($this->table);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }
}
