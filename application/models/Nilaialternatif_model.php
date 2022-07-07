<?php

class Nilaialternatif_model extends CI_Model
{

    public $table = "nilaialternatif";

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
            $from = explode('-',$key)[0];

            if($key != $from.'-jmlh'){        
                var_dump($key);
                $data = array(
                    "account_nip" => $from,
                    "subkriteria_id" => $this->input->post($key)                
                );                                            
                $this->db->insert($this->table, $data);
            }else{             
                $this->db->trans_start();
                $this->db->where('account_nip', $from);
                $data_pegawai = [
                    "nilai_rank" => $value,
                ];
                $this->db->update('pegawai', $data_pegawai);
                $this->db->trans_complete();
            }
        }        
        return ($this->db->affected_rows() > 0) ? false : true;
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
