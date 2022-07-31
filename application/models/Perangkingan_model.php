<?php

class Perangkingan_model extends CI_Model
{

    public $table = "perangkingan";

    public function get_all()
    {
        if ($this->session->userdata('nama_jabatan') === "Kepala Jurusan") {           
            $query = $this->db->get_where($this->table, [
                "created_by" => $this->session->userdata("nip")
            ]);
        } else {
            $query = $this->db->get($this->table);
        }
        return $query->result();
    }

    public function get_all_order($coloumn, $type_order)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by($coloumn, $type_order);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_one($where, $order_by = NULL)
    {
        if ($order_by != NULL) {
            $this->db->order_by($order_by['column'], $order_by['order']);
        }
        return $this->db->get_where($this->table, $where)->row();
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
