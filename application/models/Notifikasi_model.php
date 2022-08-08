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

    public function get_condition($query, $search)
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
        if ($limit != 0) {
            $this->db->limit($limit);
        }
        $this->db->join('notifikasi', $this->main_table . '.id = ' . $this->second_table . '.notifikasi_id');

        return $this->db->get()->result();
    }

    public function get_all_order($coloumn, $type_order)
    {
        $this->db->select('*');
        $this->db->from($this->main_table);
        $this->db->order_by($coloumn, $type_order);

        $query = $this->db->get();

        return $query->result();
    }

    public function get_pesan($where)
    {
        $this->db->select("*");
        $query = $this->db->get_where($this->main_table, $where);

        return $query->row();
    }

    public function create_notification($data)
    {
        $this->db->insert($this->main_table, $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    public function pair_notification($data)
    {
        $this->db->insert($this->second_table, $data);
        //notify to number phone        
        $this->load->model(['pegawai_model']);

        $no_tujuan = $this->pegawai_model->get_one(["account_nip" => $data["account_nip"]]);
        $no_tujuan = $no_tujuan->no_hp;

        $pesan = (array) $this->get_pesan(["id" => $data["notifikasi_id"]]);
        unset($pesan["id"]);
        $pesan["redirect_to"] = base_url($pesan["redirect_to"])."\n";
        $pesan = implode("\n\n", $pesan);
        
        $res = $this->curl_get('localhost:3000/api', ["tujuan" => $no_tujuan, "pesan" => $pesan]);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function curl_get($url, array $get = NULL, array $options = array())
    {
        $defaults = array(
            CURLOPT_URL => $url . (strpos($url, '?') === FALSE ? '?' : '') . http_build_query($get),
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 4
        );

        $ch = curl_init();
        curl_setopt_array($ch, ($options + $defaults));
        if (!$result = curl_exec($ch)) {
            trigger_error(curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

    public function change_status($account_nip, $notifikasi_id, $data)
    {
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
