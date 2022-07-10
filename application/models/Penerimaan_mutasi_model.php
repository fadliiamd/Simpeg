<?php

class Penerimaan_mutasi_model extends CI_Model
{

    public $table = "penerimaanmutasi";

    public function get_all()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_bagian_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('pegawai');
        $this->db->where('bagian_id',$id);
        return  $this->db->get()->num_rows();
    }    

    public function insert_one()
    {
        
        //check empty string for nullable
        foreach( $this->input->post() as $key => $value) {
            if($value === ""){
                $value = null;
            }
            $_POST[$key] = $value;            
        }
        
        $instansi_asal = $this->input->post('instansi_asal');
        $daerah_asal = $this->input->post('daerah_asal');
        $alasan = $this->input->post('alasan');
        $direktur_nip = $this->input->post('direktur_nip');
        $bagian_id = $this->input->post('bagian_id');


        $data_mutasi = array(
            "id" => "",
            "instansi_asal" => $instansi_asal,
            "daerah_asal" => $daerah_asal,
            "alasan" => $alasan,
            "status_persetujuan" => "pending",
            "bagian_id" => $bagian_id
        );
    
        $this->db->insert($this->table, $data_mutasi);

        return ($this->db->affected_rows() != 1) ? false : true;
    
    }

    public function update_one($id)
    {        
         //check empty string for nullable
         foreach( $this->input->post() as $key => $value) {
            if($value === ""){
                $value = null;
            }
            $_POST[$key] = $value;            
        }

        $instansi_asal = $this->input->post('instansi_asal');
        $daerah_asal = $this->input->post('daerah_asal');
        $alasan = $this->input->post('alasan');
        $direktur_nip = $this->input->post('direktur_nip');
        $bagian_id = $this->input->post('bagian_id');


        $data_mutasi = array(
            "instansi_asal" => $instansi_asal,
            "daerah_asal" => $daerah_asal,
            "alasan" => $alasan,
            "bagian_id" => $bagian_id
        );

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_mutasi);
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

    public function status_penerimaan_mutasi($id)
    {        
        if ($this->input->post('status') == "tolak") {
            $data_mutasi = array(
                "status_persetujuan" => $this->input->post('status'),
            );
        }else{
            $data_mutasi = array(
                "status_persetujuan" => $this->input->post('status'),
                "direktur_nip" => $this->session->userdata("nip"),
            ); 

            // $data_pegawai = array(
            //     "bagian_id" => $bagian_id
            // );
    
            // $bagian_id = $this->input->post('bagian_id');

            // $this->db->trans_start();
            // $this->db->where('account_nip', $account_nip);
            // $this->db->update('pegawai', $data_pegawai);
            // $this->db->trans_complete();
    
            // if ($this->db->trans_status() === FALSE) {
            //     return false;
            // }
        };

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_mutasi);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }
}