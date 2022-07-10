<?php

class Pemberhentian_model extends CI_Model
{

    public $table = "pemberhentian";

    public function do_upload($file_type, $post_name)
    {
         // File
            $config['upload_path']          = './uploads';
            $config['allowed_types']        = $file_type;
            $config['max_size']             = 2048;
            $this->load->library('upload');
    
            $this->upload->initialize($config);

            if (($this->upload->do_upload($post_name)))
            {
                $data = $this->upload->data();
                $data = $data['file_name'];
            }

            return $data;
    }

    public function get_all()
    {
        $query = $this->db->get($this->table);

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
        
        $mpp = $this->input->post('mpp');
        $tunjangan = ($mpp == "Ya") ?  "Tidak" : "Ya";
        
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $jenis_berhenti = $this->input->post('jenis_berhenti');
        $alasan = $this->input->post('alasan');
        $pegawai_nip = $this->input->post('pegawai_nip');
        $surat_pengunduran_diri = $this->do_upload("pdf", "surat_pengunduran_diri");


        $data_pemberhentian = array(
            "id" => "",
            "jenis_berhenti" => $jenis_berhenti,
            "alasan" => $alasan,
            "tgl_pengajuan" => $date,
            "status_pengajuan" => "pending",
            "mpp" => $mpp,
            "tunjangan" => $tunjangan,
            "pegawai_nip" => $pegawai_nip,
            "surat_pengunduran_diri" => $surat_pengunduran_diri,
        );
    
        $this->db->insert($this->table, $data_pemberhentian);
    
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
        
        $mpp = $this->input->post('mpp');
        $tunjangan = ($mpp == "Ya") ?  "Tidak" : "Ya";

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        $jenis_berhenti = $this->input->post('jenis_berhenti');
        $alasan = $this->input->post('alasan');
        $mpp = $this->input->post('mpp');
        $tunjangan = $this->input->post('tunjangan');
        $pegawai_nip = $this->input->post('pegawai_nip');
        $surat_pengajuan = $this->do_upload("pdf", "surat_pengajuan");


        $data_pemberhentian = array(
            "jenis_berhenti" => $jenis_berhenti,
            "alasan" => $alasan,
            "tgl_pengajuan" => $date,
            "status_pengajuan" => "pending",
            "mpp" => $mpp,
            "tunjangan" => $tunjangan,
            "pegawai_nip" => $pegawai_nip,
            "surat_pengunduran_diri" => $surat_pengajuan,
        );

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_pemberhentian);
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

    public function status_pemberhentian($id)
    {        
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");

        if ($this->input->post('status') == "tolak") {
            $data_pemberhentian = array(
                "status_pengajuan" => $this->input->post('status')
            ); 
        }else{
            $data_pemberhentian = array(
                "status_pengajuan" => $this->input->post('status'),
                "tgl_persetujuan" => $date
            ); 
        }


        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_pemberhentian);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }
}