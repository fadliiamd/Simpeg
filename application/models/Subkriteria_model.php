<?php

class Subkriteria_model extends CI_Model
{

    public $table = "subkriteria";

    public function get_all()
    {
        $this->db->select('*, 
        kriteria.nama as nama_kriteria, 
        subkriteria.nama as sub_nama, 
        subkriteria.id as sub_id,
        subkriteria.nilai_prioritas as nilai_prioritas');
        $this->db->from('subkriteria');
        $this->db->join('kriteria', 'kriteria.id = subkriteria.kriteria_id');

        $query = $this->db->get();       

        return $query->result();
    }
    
    public function get_all_where_parent($id)
    {
        $this->db->select(' 
        subkriteria.nama as nama, 
        subkriteria.id as id');
        $this->db->from('subkriteria');
        $this->db->join('kriteria', 'kriteria.id = subkriteria.kriteria_id');
        $this->db->where('kriteria.id', $id);

        $query = $this->db->get();       

        return $query->result();
    }

    public function insert_one()
    {
        $nama = $this->input->post('nama');
        $kriteria_id = $this->input->post('kriteria_id');
        $nilai = $this->input->post('nilai');

        $data = array(
            "nama" => $nama,
            "kriteria_id" => $kriteria_id,
            "nilai" => $nilai
        );

        $this->db->insert($this->table, $data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update_one($id)
    {
        $this->db->trans_start();
        $nama = $this->input->post('nama');
        $kriteria_id = $this->input->post('kriteria_id');
        $nilai = $this->input->post('nilai');

        $data = array(
            "nama" => $nama,
            "kriteria_id" => $kriteria_id,
            "nilai" => $nilai
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
