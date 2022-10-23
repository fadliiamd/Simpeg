<?php

class Berkas_pemberhentian_model extends CI_Model
{

    public $table = "berkaspensiun";

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
            'berkaspensiun.id, berkaspensiun.sk_cpns, berkaspensiun.sk_pns, berkaspensiun.sk_kgb, berkaspensiun.sk_kp, berkaspensiun.dp3_akhir, berkaspensiun.pangkat_akhir, berkaspensiun.kartu_keluarga, berkaspensiun.pas_foto, berkaspensiun.status_persetujuan, berkaspensiun.alasan_tolak,
            pemberhentian.pegawai_nip, pemberhentian.jenis_berhenti, pemberhentian.alasan,pemberhentian.status_pengajuan, pemberhentian.tgl_pengajuan ,pemberhentian.id AS id_pemberhentian,
            pegawai.account_nip, pegawai.nama'
        );
        $this->db->from($this->table);
        $this->db->join('pemberhentian', 'berkaspensiun.pemberhentian_id = pemberhentian.id','LEFT');
        $this->db->join('pegawai', 'pegawai.account_nip = pemberhentian.pegawai_nip', "LEFT");

        $query = $this->db->where('pemberhentian.jenis_berhenti !=', "Pengunduran diri");
        $query = $this->db->get();

        return $query->result();
    }

    public function get_all_with_join_pegawai()
    {
        $this->db->select(
            'berkaspensiun.id, berkaspensiun.sk_cpns, berkaspensiun.sk_pns, berkaspensiun.sk_kgb, berkaspensiun.sk_kp, berkaspensiun.dp3_akhir, berkaspensiun.pangkat_akhir, berkaspensiun.kartu_keluarga, berkaspensiun.pas_foto, berkaspensiun.status_persetujuan, berkaspensiun.alasan_tolak,
            pemberhentian.pegawai_nip, pemberhentian.jenis_berhenti, pemberhentian.alasan,pemberhentian.status_pengajuan,pemberhentian.tgl_pengajuan ,pemberhentian.id AS id_pemberhentian,
            pegawai.account_nip, pegawai.nama'
        );

        $this->db->from($this->table);
        $this->db->join('pemberhentian', 'berkaspensiun.pemberhentian_id = pemberhentian.id','LEFT');
        $this->db->join('pegawai', 'pegawai.account_nip = pemberhentian.pegawai_nip', "LEFT");

        $query = $this->db->where('pemberhentian.jenis_berhenti !=', "Pengunduran diri");
        $query = $this->db->where('pemberhentian.pegawai_nip',$this->session->userdata("nip"));
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
        $sk_kgb = $this->do_upload("pdf", "sk_kgb");
        $sk_kp = $this->do_upload("pdf", "sk_kp");
        $dp3_akhir = $this->do_upload("pdf", "dp3_akhir");
        $pangkat_akhir = $this->do_upload("pdf", "pangkat_akhir");
        $kartu_keluarga = $this->do_upload("pdf", "kartu_keluarga");
        $pas_foto = $this->do_upload("jpeg|jpg|png", "pas_foto");
        $pemberhentian_id = $this->input->post('pemberhentian_id');


        $data_berkas_pemberhentian = array(
            "id" => "",
            "sk_cpns" => $sk_cpns,
            "sk_pns" => $sk_pns,
            "sk_kgb" => $sk_kgb,
            "sk_kp" => $sk_kp,
            "dp3_akhir" => $dp3_akhir,
            "pangkat_akhir" => $pangkat_akhir,
            "kartu_keluarga" => $kartu_keluarga,
            "pas_foto" => $pas_foto,
            "pemberhentian_id" => $pemberhentian_id,
            "status_persetujuan" => "pending"
        );
    
        $this->db->insert($this->table, $data_berkas_pemberhentian);
    
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
        $sk_kgb = $this->do_upload("pdf", "sk_kgb");
        $sk_kp = $this->do_upload("pdf", "sk_kp");
        $dp3_akhir = $this->do_upload("pdf", "dp3_akhir");
        $pangkat_akhir = $this->do_upload("pdf", "pangkat_akhir");
        $kartu_keluarga = $this->do_upload("pdf", "kartu_keluarga");
        $pas_foto = $this->do_upload("jpg|png", "pas_foto");
        $pemberhentian_id = $this->input->post('pemberhentian_id');


        $data_berkas_pemberhentian = array(
            "pemberhentian_id" => $pemberhentian_id
        );

        if(!is_null($sk_cpns)){
            $data_berkas_pemberhentian += array(
                'sk_cpns' => $sk_cpns
            );
        }
        if(!is_null($sk_pns)){
            $data_berkas_pemberhentian += array(
                'sk_pns' => $sk_pns
            );
        }
        if(!is_null($sk_kgb)){
            $data_berkas_pemberhentian += array(
                'sk_kgb' => $sk_kgb
            );
        }
        if(!is_null($sk_kp)){
            $data_berkas_pemberhentian += array(
                'sk_kp' => $sk_kp
            );
        }
        if(!is_null($dp3_akhir)){
            $data_berkas_pemberhentian += array(
                'dp3_akhir' => $dp3_akhir
            );
        }
        if(!is_null($pangkat_akhir)){
            $data_berkas_pemberhentian += array(
                'pangkat_akhir' => $pangkat_akhir
            );
        }
        if(!is_null($kartu_keluarga)){
            $data_berkas_pemberhentian += array(
                'kartu_keluarga' => $kartu_keluarga
            );
        }
        if(!is_null($pas_foto)){
            $data_berkas_pemberhentian += array(
                'pas_foto' => $pas_foto
            );
        }

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_berkas_pemberhentian);
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

    public function status_berkas_pemberhentian($id)
    {        
        if ($this->input->post('status') == "tolak") {
            $data_usulan_pensiun = array(
                "status_persetujuan" => $this->input->post('status'),
                "alasan_tolak" => $this->input->post('alasan')
            ); 

            $this->db->trans_start();
            $this->db->where('id', $id);
            $this->db->update($this->table, $data_usulan_pensiun);
            $this->db->trans_complete();

            return "tolak";
        }else{
            $data_usulan_pensiun = array(
                "status_persetujuan" => $this->input->post('status')
            );

            $this->db->trans_start();
            $this->db->where('id', $id);
            $this->db->update($this->table, $data_usulan_pensiun);
            $this->db->trans_complete();

            return "setujui";
        }

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }
}