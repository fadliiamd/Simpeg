<?php

class Nilai_model extends CI_Model
{

    public $table = "nilai";

    public function get_all()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }    

    public function do_upload($file_type, $post_name)
    {
         // File
            $config['upload_path']          = './uploads';
            $config['allowed_types']        = $file_type;
            $config['max_size']             = 2048;
            $this->load->library('upload');
    
            $this->upload->initialize($config);

            $data = null;

            if (($this->upload->do_upload($post_name)))
            {
                $data = $this->upload->data();
                $data = $data['file_name'];
            }

            return $data;
    }

    public function insert_one()
    {    
        //buat dulu data rekap nilai
        $this->load->model('rekap_nilai_model');
        $tgl = date('Y-m-d');
        $id_rekap_nilai = $this->rekap_nilai_model->insert_one_get_id([
            'account_nip' => $_SESSION['nip'],
            "tgl_usulan" => $tgl,
            "status" => "pending",    
            "hasil_akk" => 0
        ]);        
        $data = array();                       
        foreach ($_FILES as $key => $value){
            $file = $this->do_upload('pdf', $key);                        
            $data += array(                           
                "file" => $file,
                "unsur_kegiatan_id" => explode("-", $key)[1],
                "rekap_nilai_id" => $id_rekap_nilai             
            );
            $this->db->insert($this->table, $data);
        }

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update_one($id)
    {
        $this->db->trans_start();
        $data = array(
            "kode" => $this->input->post("kode"),            
            "unsur_id" => $this->input->post('unsur_id'),
            "kegiatan" => $this->input->post("kegiatan"),
            "angka_kredit" => $this->input->post("angka_kredit"),
            "satuan" => $this->input->post("satuan")
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
