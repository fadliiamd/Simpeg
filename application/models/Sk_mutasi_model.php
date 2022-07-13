<?php

class Sk_mutasi_model extends CI_Model
{

    public $table = "skmutasi";

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
            'skmutasi.id, skmutasi.jenis_mutasi, skmutasi.tgl_mutasi, skmutasi.file_mutasi,
            usulanmutasi.id AS id_usulan,usulanmutasi.tgl_usulan,usulanmutasi.status_persetujuan,usulanmutasi.tgl_persetujuan,
            berkasmutasi.id As id_berkas, berkasmutasi.sk_cpns, berkasmutasi.sk_pns, berkasmutasi.pangkat_akhir, berkasmutasi.karpeg, berkasmutasi.dp3_akhir, berkasmutasi.ijazah, berkasmutasi.riwayat_hidup, 
            mutasi.pegawai_nip, mutasi.alasan, mutasi.id AS id_mutasi'
        );
        $this->db->from($this->table);
        $this->db->join('usulanmutasi', 'usulanmutasi.id = skmutasi.usulanmutasi_id');
        $this->db->join('berkasmutasi', 'berkasmutasi.id = usulanmutasi.berkasmutasi_id');
        $this->db->join('mutasi', 'mutasi.id = usulanmutasi.mutasi_id');

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
        $jenis_mutasi = $this->input->post('jenis_mutasi');
        $tgl_mutasi = $this->input->post('tgl_mutasi');
        $usulanmutasi_id = $this->input->post('usulanmutasi_id');

        $data_sk_mutasi = array(
            "id" => "",
            "jenis_mutasi" => $jenis_mutasi,
            "tgl_mutasi" => $tgl_mutasi,
            // "file_mutasi" => $file_mutasi,
            "usulanmutasi_id" => $usulanmutasi_id,
        );
    
        $this->db->insert($this->table, $data_sk_mutasi);
    
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
        $jenis_mutasi = $this->input->post('jenis_mutasi');
        $file_mutasi = $this->do_upload("jpg|png|pdf", "file_mutasi");
        $usulanmutasi_id = $this->input->post('usulanmutasi_id');

        $data_sk_mutasi = array(
            "jenis_mutasi" => $jenis_mutasi,
            "tgl_mutasi" => $date,
            "file_mutasi" => $file_mutasi,
            "usulanmutasi_id" => $usulanmutasi_id,
        );

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_sk_mutasi);
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
            $data_sk_mutasi = array(
                "status_persetujuan" => $this->input->post('status')
            ); 
        }else{
            $data_sk_mutasi = array(
                "status_persetujuan" => $this->input->post('status'),
                "tgl_persetujuan" => $date
            ); 
        }

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_sk_mutasi);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
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

        $surat_mutasi = $this->do_upload("pdf", "file_mutasi");

        $data_mutasi_mutasi = array(
            "file_mutasi" => $surat_mutasi,
        );

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_mutasi_mutasi);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }
}