<?php

class Sk_pemberhentian_model extends CI_Model
{

    public $table = "skpensiun";

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
            'skmutasi.id, skmutasi.tgl_mutasi, skmutasi.file_mutasi,
            usulanpensiun.id AS id_usulan,usulanpensiun.tgl_pensiun,usulanpensiun.tgl_usulan,usulanpensiun.status_persetujuan,usulanpensiun.tgl_persetujuan,
            berkaspensiun.id AS id_berkas, berkaspensiun.sk_cpns, berkaspensiun.sk_pns, berkaspensiun.kgb, berkaspensiun.kp, berkaspensiun.dp3_akhir, berkaspensiun.pangkat_akhir, berkaspensiun.kartu_keluarga, berkaspensiun.pas_foto, 
            pemberhentian.pegawai_nip, pemberhentian.alasan, pemberhentian.id AS id_pemberhentian'
        );
        $this->db->from($this->table);
        $this->db->join('usulanpenisun', 'usulanpensiun.id = skmutasi.usulanpensiun_id');
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
        $file_pensiun = $this->do_upload("pdf", "file_pensiun");
        $usulanpensiun_id = $this->input->post('usulanpensiun_id');

        $data_sk_pensiun = array(
            "id" => "",
            "tgl_pensiun" => $date,
            "file_pensiun" => $file_pensiun,
            "usulanpensiun_id" => $usulanpensiun_id,
        );

        $this->db->insert($this->table, $data_sk_pensiun);

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
        $file_pensiun = $this->do_upload("pdf", "file_pensiun");
        $usulanpensiun_id = $this->input->post('usulanpensiun_id');

        $data_sk_pensiun = array(
            "tgl_pensiun" => $date,
            "file_pensiun" => $file_pensiun,
            "usulanpensiun_id" => $usulanpensiun_id,
        );

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_sk_pensiun);
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
}