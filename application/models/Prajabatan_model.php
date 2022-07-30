<?php

class Prajabatan_model extends CI_Model
{
    public $table = "prajabatan";

    public function get_all()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_one_join_limit($where, $limit)
    {
        $this->db->select('*');        
        $this->db->join('surat', 'surat.id = prajabatan.surat_id');        
        $this->db->limit($limit);

        $query = $this->db->get_where('prajabatan', $where);
        return $query->result();
    }

    public function get_all_where($where)
    {
        $this->db->select('*');        
        $this->db->join('sertifikat', $this->table.'.sertifikat_id = sertifikat.id');        
        $query = $this->db->get_where($this->table, $where);
        return $query->result();
    }

    public function get_all_join_sertifikat()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('sertifikat', $this->table.'.sertifikat_id = sertifikat.id');
        $query = $this->db->get();
        return $query->result();
    }

        public function get_tema($where)
    {
        $this->db->select('prajabatan.id as prajabatan_id, surat.tema');        
        $this->db->join('surat', 'surat.id = prajabatan.surat_id');

        $query = $this->db->get_where('prajabatan', $where);
        return $query->row()->tema;
    }


    public function get_one($where)
    {
        $query = $this->db->get_where($this->table, $where);
        return $query->row();
    }

    public function get_one_join($where)
    {
        $this->db->select('*');
        $this->db->from('prajabatan');
        $this->db->join('sertifikat', 'prajabatan.sertifikat_id = sertifikat.id');
        $this->db->where($where);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_num_rows()
    {
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }
    
    public function get_num_rows_by($nip)
    {
        $query = $this->db->get_where($this->table, $nip);
        return $query->num_rows();
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