<?php

class Unsur_model extends CI_Model
{

    public $table = "unsur";

    public function get_all()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_where($where)
    {
        $query = $this->db->get_where($this->table, $where);

        return $query->result();
    }

    public function get_all_with_group_by($coloumn)
    {
        $this->db->select('*');
        $this->db->from('unsur');        
        $this->db->group_by($coloumn); 
        $query = $this->db->get();

        return $query->result();
    }

    public function insert_one()
    {    
        $data = array(
            "unsur" => $this->input->post('unsur'),
            "sub_unsur" => $this->input->post('sub_unsur')
        );

        $this->db->insert($this->table, $data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update_one($id)
    {
        $this->db->trans_start();
        $data = array(
            "unsur" => $this->input->post('unsur'),
            "sub_unsur" => $this->input->post('sub_unsur')
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
