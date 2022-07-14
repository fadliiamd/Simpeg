<?php

class Notifikasi_model extends CI_Model
{

    public $main_table = "notifikasi";
    public $second_table = "account_notifikasi";

    public function get_all()
    {
        $this->db->select('*');
        $this->db->from($this->main_table);
        $query = $this->db->get();  

        return $query->result();
    }

    public function get_one_second($where)
    {
        return $this->db->get_where($this->second_table, $where)->row();
    }

    public function get_condition($query,$search)
    {
        $query = $this->db->where($query, $search)->get($this->main_table);

        return $query->result();
    }

    /*
    
    */
    public function get_all_where($where, $limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->second_table);
        $this->db->where($where);
        if($limit != 0) {
          $this->db->limit($limit);
        }
        $this->db->join('notifikasi', $this->main_table.'.id = '.$this->second_table.'.notifikasi_id');

        return $this->db->get()->result();
    }

    public function get_all_order($coloumn, $type_order) {
        $this->db->select('*');
        $this->db->from($this->main_table);
        $this->db->order_by($coloumn, $type_order);

        $query = $this->db->get();
        
        return $query->result();
    }

    public function create_notification($data) {
        $this->db->insert($this->main_table, $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    public function pair_notification($data) {
        $this->db->insert($this->second_table, $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function change_status($account_nip, $notifikasi_id, $data) {
        $this->db->trans_start();
        $this->db->where([
            "account_nip" => $account_nip,
            "notifikasi_id" => $notifikasi_id
        ]);
        $this->db->update($this->second_table, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }
        return true;
    }

}
