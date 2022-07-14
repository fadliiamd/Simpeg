<?php

class Sertifikat_model extends CI_Model
{

    public $table = "sertifikat";

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

            if (($this->upload->do_upload($post_name)))
            {
                $data = $this->upload->data();
                $data = $data['file_name'];
            }

            return $data;
    }

    public function insert_one()
    {
        $account_nip = $this->input->post('account_nip');
        $nama = $this->do_upload("pdf|jpg|png", "nama_serti");

        $data = array(
            "account_nip" => $account_nip,
            "nama_serti" => $nama
        );

        $this->db->insert($this->table, $data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function create_one($data) {
        $this->db->insert($this->table, $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();        ;
    }

    public function update_one($id)
    {
        $this->db->trans_start();
        $account_nip = $this->input->post('account_nip');        

        if(!(empty($_FILES['nama_serti']['name']))){
            $nama = $this->do_upload("pdf|jpg|png", "nama_serti");              
            $data = array(
                "account_nip" => $account_nip,
                "nama_serti" => $nama
            );
        }else{
            $data = array(
                "account_nip" => $account_nip
            );
        }      

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