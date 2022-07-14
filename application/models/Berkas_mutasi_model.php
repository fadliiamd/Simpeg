<?php

class Berkas_mutasi_model extends CI_Model
{

    public $table = "berkasmutasi";

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

    public function get_all_with_join()
    {
        $this->db->select(
            'berkasmutasi.id, berkasmutasi.sk_cpns, berkasmutasi.sk_pns, berkasmutasi.pangkat_akhir, berkasmutasi.karpeg, berkasmutasi.dp3_akhir, berkasmutasi.ijazah, berkasmutasi.riwayat_hidup, berkasmutasi.status_persetujuan, 
            mutasi.pegawai_nip, mutasi.alasan, mutasi_id AS id_mutasi'
        );
        $this->db->from($this->table);
        $this->db->join('mutasi', 'berkasmutasi.mutasi_id = mutasi.id','LEFT');

        $query = $this->db->get();

        return $query->result();
    }

    public function get_all_with_join_pegawai()
    {
        $this->db->select(
            'berkasmutasi.id, berkasmutasi.sk_cpns, berkasmutasi.sk_pns, berkasmutasi.pangkat_akhir, berkasmutasi.karpeg, berkasmutasi.dp3_akhir, berkasmutasi.ijazah, berkasmutasi.riwayat_hidup, berkasmutasi.status_persetujuan, 
            mutasi.pegawai_nip, mutasi.alasan, mutasi_id AS id_mutasi'
        );
        $this->db->from($this->table);
        $this->db->join('mutasi', 'berkasmutasi.mutasi_id = mutasi.id','LEFT');

        $query = $this->db->where('mutasi.pegawai_nip',$this->session->userdata("nip"));
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

        $sk_cpns = $this->do_upload("pdf", "sk_cpns");
        $sk_pns = $this->do_upload("pdf", "sk_pns");
        $pangkat_akhir = $this->do_upload("pdf", "pangkat_akhir");
        $karpeg = $this->do_upload("pdf", "karpeg");
        $dp3_akhir = $this->do_upload("pdf", "dp3_akhir");
        $ijazah = $this->do_upload("pdf", "ijazah");
        $riwayat_hidup = $this->do_upload("pdf", "riwayat_hidup");
        $mutasi_id = $this->input->post('mutasi_id');


        $data_berkas_mutasi = array(
            "id" => "",
            "sk_cpns" => $sk_cpns,
            "sk_pns" => $sk_pns,
            "pangkat_akhir" => $pangkat_akhir,
            "karpeg" => $karpeg,
            "dp3_akhir" => $dp3_akhir,
            "ijazah" => $ijazah,
            "riwayat_hidup" => $riwayat_hidup,
            "status_persetujuan" => "pending",
            "mutasi_id" => $mutasi_id
        );
    
        $this->db->insert($this->table, $data_berkas_mutasi);
    
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
 
        $sk_cpns = $this->do_upload("pdf", "sk_cpns");
        $sk_pns = $this->do_upload("pdf", "sk_pns");
        $pangkat_akhir = $this->do_upload("pdf", "pangkat_akhir");
        $karpeg = $this->do_upload("pdf", "karpeg");
        $dp3_akhir = $this->do_upload("pdf", "dp3_akhir");
        $ijazah = $this->do_upload("pdf", "ijazah");
        $riwayat_hidup = $this->do_upload("pdf", "riwayat_hidup");

        $data_berkas_mutasi = array();

        if(!is_null($sk_cpns)){
            $data_berkas_mutasi += array(
                'sk_cpns' => $sk_cpns
            );
        }
        if(!is_null($sk_pns)){
            $data_berkas_mutasi += array(
                'sk_pns' => $sk_pns
            );
        }
        if(!is_null($pangkat_akhir)){
            $data_berkas_mutasi += array(
                'pangkat_akhir' => $pangkat_akhir
            );
        }
        if(!is_null($karpeg)){
            $data_berkas_mutasi += array(
                'karpeg' => $karpeg
            );
        }
        if(!is_null($dp3_akhir)){
            $data_berkas_mutasi += array(
                'dp3_akhir' => $dp3_akhir
            );
        }
        if(!is_null($ijazah)){
            $data_berkas_mutasi += array(
                'ijazah' => $ijazah
            );
        }
        if(!is_null($riwayat_hidup)){
            $data_berkas_mutasi += array(
                'riwayat_hidup' => $riwayat_hidup
            );
        }

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_berkas_mutasi);
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

    public function status_berkas_mutasi($id)
    {        
        if ($this->input->post('status') == "tolak") {
            $data_berkas_mutasi = array(
                "status_persetujuan" => $this->input->post('status')
            ); 

            $this->db->trans_start();
            $this->db->where('id', $id);
            $this->db->update($this->table, $data_berkas_mutasi);
            $this->db->trans_complete();

            return "tolak";
        }else{
            $data_berkas_mutasi = array(
                "status_persetujuan" => $this->input->post('status')
            ); 

            $this->db->trans_start();
            $this->db->where('id', $id);
            $this->db->update($this->table, $data_berkas_mutasi);
            $this->db->trans_complete();

            return "setujui";
        }
        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }
}