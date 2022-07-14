<?php

class Rekap_nilai_model extends CI_Model
{
    public $table = "rekap_nilai";

    public function get_all()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_akk_terakhir($nip)
    {                
        $this->db->where($nip);
        $this->db->order_by('tgl_usulan', 'desc');
        $query = $this->db->get($this->table);

        if($query->num_rows() > 0){
            return $query->row()->hasil_akk;
        }else{
            return null;
        }
        
    }

    public function get_num_rows_by($nip)
    {
        $query = $this->db->get_where($this->table, $nip);
        return $query->num_rows();
    }
    
    public function get_num_rows()
    {
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function get_all_where($where)
    {
        $query = $this->db->get_where($this->table, $where);
        return $query->result();
    }

    public function get_one($where)
    {
        $query = $this->db->get_where($this->table, $where);
        return $query->row();
    }

    public function insert_one($data)
    {
        $this->db->insert($this->table, $data);
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