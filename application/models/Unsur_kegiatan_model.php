<?php

class Unsur_kegiatan_model extends CI_Model
{

    public $table = "unsur_kegiatan";

    public function get_all()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function insert_one()
    {    
        $data = array(
            "kode" => $this->input->post("kode"),            
            "unsur_id" => $this->input->post('unsur_id'),
            "kegiatan" => $this->input->post("kegiatan"),
            "angka_kredit" => $this->input->post("angka_kredit"),
            "satuan" => $this->input->post("satuan")
        );

        $this->db->insert($this->table, $data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update_one($id)
    {
        $this->db->trans_start();
        $data = array(
            "kode" => $this->input->post("kode"),            
            "unsur_id" => $this->input->post('unsur_id'),
            "kegiatan" => $this->input->post("kegiatan"),
            "angka_kredit" => $this->input->post("angka_kredit"),
            "satuan" => $this->input->post("satuan")
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
