<?php

class Usulan_mutasi_model extends CI_Model
{

    public $table = "usulanmutasi";

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
            'usulanmutasi.id,usulanmutasi.tgl_usulan,usulanmutasi.status_persetujuan,usulanmutasi.tgl_persetujuan,usulanmutasi.surat_usulan,
            berkasmutasi.id As id_berkas, berkasmutasi.sk_cpns, berkasmutasi.sk_pns, berkasmutasi.pangkat_akhir, berkasmutasi.karpeg, berkasmutasi.dp3_akhir, berkasmutasi.ijazah, berkasmutasi.riwayat_hidup, 
            pegawai.nama AS pegawai_nama,
            mutasi.pegawai_nip, mutasi.alasan, mutasi.id AS id_mutasi'
        );
        $this->db->from($this->table);
        $this->db->join('berkasmutasi', 'berkasmutasi.id = usulanmutasi.berkasmutasi_id','LEFT');
        $this->db->join('mutasi', 'mutasi.id = usulanmutasi.mutasi_id','LEFT');
        $this->db->join('pegawai', 'pegawai.account_nip = mutasi.pegawai_nip','LEFT');

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
        $berkas_id = $this->input->post('id');
        $mutasi_id = $this->input->post('id_mutasi');

        $data_usulan_mutasi = array(
            "id" => "",
            "tgl_usulan" => $date,
            "status_persetujuan" => "pending",
            "berkasmutasi_id" => $berkas_id,
            "mutasi_id" => $mutasi_id
        );
    
        $this->db->insert($this->table, $data_usulan_mutasi);
    
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

        $tgl_usulan = $this->input->post('tgl_usulan');

        $data_usulan_mutasi = array(
            "tgl_usulan" => $tgl_usulan,
        );

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_usulan_mutasi);
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

    public function status_usulan_mutasi($id)
    {        

        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d H:i:s");
        if ($this->input->post('status') == "tolak") {
            $data_usulan_mutasi = array(
                "status_persetujuan" => $this->input->post('status')
            ); 

            $this->db->trans_start();
            $this->db->where('id', $id);
            $this->db->update($this->table, $data_usulan_mutasi);
            $this->db->trans_complete();

            return "tolak";
        }else{
            $data_usulan_mutasi = array(
                "status_persetujuan" => $this->input->post('status'),
                "tgl_persetujuan" => $date
            );

            $this->db->trans_start();
            $this->db->where('id', $id);
            $this->db->update($this->table, $data_usulan_mutasi);
            $this->db->trans_complete();

// ----------------------------------------- //

            $data_status_pegawai = array(
                "status_kerja" => 'mutasi',
            );

            $this->db->trans_start();
            $this->db->where('account_nip', $this->input->post('pegawai_nip'));
            $this->db->update('pegawai', $data_status_pegawai);
            $this->db->trans_complete();

            return "setujui";
        }

        if ($this->db->trans_status() === FALSE) {
            return false;
        }
    }

    public function upload_surat($id)
    {        
         //check empty string for nullable
        foreach( $this->input->post() as $key => $value) {
            if($value === ""){
                $value = null;
            }
            $_POST[$key] = $value;            
        }

        $surat_usulan = $this->do_upload("pdf", "surat_usulan");

        $data_usulan_pensiun = array(
            "surat_usulan" => $surat_usulan,
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
}