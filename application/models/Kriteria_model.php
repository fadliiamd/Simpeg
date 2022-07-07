<?php

class Kriteria_model extends CI_Model
{

    public $table = "kriteria";

    public function get_all()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function insert_one()
    {
        $nama = $this->input->post('nama');

        $data = array(
            "nama" => $nama
        );

        $this->db->insert($this->table, $data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update_one($id)
    {
        $this->db->trans_start();
        $nama = $this->input->post('nama');

        $data = array(
            "nama" => $nama
        );
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }

    public function update_prior($id)
    {
        $this->db->trans_start();
        $nilai_prior = $this->input->post($id.'-2');

        $data = array(
            "nilai_prioritas" => $nilai_prior,
        );
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }

    public function delete_one($id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }
}
