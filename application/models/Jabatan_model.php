<?php

class Jabatan_model extends CI_Model
{

    public $table = "jabatan";

    public function get_all()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_one($where)
    {
        return $this->db->get_where($this->table, $where)->row();
    }

    public function insert_one()
    {        
        $data = array(
            "nama_jabatan" => $this->input->post('nama'),
            "jenis_jabatan" => $this->input->post('jenis')
        );

        $this->db->insert($this->table, $data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update_one($id)
    {
        $this->db->trans_start();        
        $data = array(
            "nama_jabatan" => $this->input->post('nama'),
            "jenis_jabatan" => $this->input->post('jenis')
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
