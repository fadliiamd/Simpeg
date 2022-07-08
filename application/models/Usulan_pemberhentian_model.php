<?php

class Usulan_pemberhentian_model extends CI_Model
{

    public $table = "usulanpensiun";

    public function get_all()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_all_with_join()
    {
        $this->db->select(
            'usulanpensiun.id,usulanpensiun.tgl_pensiun,usulanpensiun.tgl_usulan,usulanpensiun.status_persetujuan,usulanpensiun.tgl_persetujuan,
            berkaspensiun.id AS id_berkas, berkaspensiun.sk_cpns, berkaspensiun.sk_pns, berkaspensiun.kgb, berkaspensiun.kp, berkaspensiun.dp3_akhir, berkaspensiun.pangkat_akhir, berkaspensiun.kartu_keluarga, berkaspensiun.pas_foto, 
            pemberhentian.pegawai_nip, pemberhentian.alasan, pemberhentian.id AS id_pemberhentian'
        );
        $this->db->from($this->table);
        $this->db->join('berkaspensiun', 'berkaspensiun.id = usulanpensiun.berkaspensiun_id');
        $this->db->join('pemberhentian', 'pemberhentian.id = usulanpemberhentian.pemberhentian_id');

        $query = $this->db->get();

        return $query->result();
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

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $tgl_pensiun = $this->input->post('tgl_pensiun');
        $pemberhentian_id = $this->input->post('pemberhentian_id');
        list($berkas,$pemberhentian) = explode(" - ",$pemberhentian_id);

        $data_usulan_pensiun = array(
            "id" => "",
            "tgl_pensiun" => $tgl_pensiun,
            "tgl_usulan" => $date,
            "status_persetujuan" => "pending",
            "berkaspensiun_id" => $berkas,
            "pemberhentian_id" => $pemberhentian
        );
    
        $this->db->insert($this->table, $data_usulan_pensiun);
    
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
 
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $tgl_pensiun = $this->input->post('tgl_pensiun');
        $berkas_id = $this->input->post('berkaspensiun_id');
        $pemberhentian_id = $this->input->post('pemberhentian_id');

        $data_usulan_pensiun = array(
            "id" => "",
            "tgl_pensiun" => $tgl_pensiun,
            "tgl_usulan" => $date,
            "status_persetujuan" => "pending",
            "berkaspensiun_id" => $berkas_id,
            "pemberhentian_id" => $pemberhentian_id
        );

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_usulan_pensiun);
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

    public function status_usulan_pensiun($id)
    {        

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        if ($this->input->post('status') == "tolak") {
            $data_usulan_pensiun = array(
                "status_persetujuan" => $this->input->post('status')
            ); 
        }else{
            $data_usulan_pensiun = array(
                "status_persetujuan" => $this->input->post('status'),
                "tgl_persetujuan" => $date
            ); 
        }

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_usulan_pensiun);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }
}