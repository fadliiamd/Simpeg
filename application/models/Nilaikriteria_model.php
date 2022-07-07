<?php

class Nilaikriteria_model extends CI_Model
{

    public $table = "nilaikriteria";

    public function get_all()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function inserts()
    {   
        // Selalu override data     
        $this->db->empty_table($this->table);

        foreach($_POST as $key => $value)
        {
            if($key != "jenis" && $key != "kriteria_id"){
                $from = explode('-',$key)[0];
                $to = explode('-',$key)[1];
                
                $data = array(
                    "dari_kriteria" => $from,
                    "ke_kriteria" => $to,
                    "nilai" => $value
                );
    
                $this->db->insert($this->table, $data);
    
            }            
        }        

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
