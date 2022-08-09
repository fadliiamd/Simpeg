<?php

class Sertifikat_model extends CI_Model
{

    public $table = "sertifikat";

    public function get_all()
    {
        $this->db->join("jenis_sertifikat", "sertifikat.id_jenis_sertifikat = jenis_sertifikat.id_jenis_sertifikat", "left");
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_all_where($where)
    {
        $this->db->join("jenis_sertifikat", "sertifikat.id_jenis_sertifikat = jenis_sertifikat.id_jenis_sertifikat", "left");
        $query = $this->db->get_where($this->table, $where);
        return $query->result();
    }

    public function do_upload($file_type, $post_name, $file_name="")
    {
         // File
            $config['upload_path']          = './uploads';
            $config['allowed_types']        = $file_type;
            $config['max_size']             = 2048;
            if($file_name!=="" and !is_null($file_name)){            
                $config['file_name'] = $file_name;                
            }
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
        $account_nip = $this->input->post('account_nip');
        $id_jenis_sertifikat = $this->input->post('id_jenis_sertifikat');

        //get nama kegiatan
        $tema = $this->input->post("nama_serti");
        $name_ext = explode(".", $_FILES["file_sertifikat"]['name']);
        $ext = end($name_ext);
        $serti_name = time().'-'.$tema.'-file.'. $ext;        
        $nama = $this->do_upload("pdf|jpg|png", "file_sertifikat", $serti_name);

        $no_serti = $this->input->post("no_serti");
        $penyelenggara = $this->input->post("penyelenggara");
        $data_pendukung = $this->do_upload("pdf|jpg|png", "data_pendukung");

        $data = array(
            "account_nip" => $account_nip,
            "nama_serti" => $nama,
            "id_jenis_sertifikat" => $id_jenis_sertifikat,
            "tipe" => "lainnya",
            "no_serti" => $no_serti,
            "penyelenggara" => $penyelenggara,
            "data_pendukung" => $data_pendukung,
        );

        if($this->session->userdata('role') == 'admin') {
            $data += array(
                "is_verify" => 1
            );
        } else {
            $data += array(
                "is_verify" => 0
            );
        }

        $this->db->insert($this->table, $data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function create_one($data) {
        $this->db->insert($this->table, $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    public function update_one($id)
    {
        $this->db->trans_start();
        $account_nip = $this->input->post('account_nip');        
        $id_jenis_sertifikat = $this->input->post('id_jenis_sertifikat');

        $no_serti = $this->input->post("no_serti");
        $penyelenggara = $this->input->post("penyelenggara");
        $is_verify = $this->input->post("is_verify");

        if(!(empty($_FILES['file_sertifikat']['name']))){
            $tema = $this->input->post("nama_serti");
            $name_ext = explode(".", $_FILES["file_sertifikat"]['name']);
            $ext = end($name_ext);
            $serti_name = time().'-'.$tema.'-file.'. $ext;        
            $nama = $this->do_upload("pdf|jpg|png", "file_sertifikat", $serti_name);      

            $data = array(
                "account_nip" => $account_nip,
                "nama_serti" => $nama,
                "id_jenis_sertifikat" => $id_jenis_sertifikat,
                "no_serti" => $no_serti,
                "penyelenggara" => $penyelenggara,
                "is_verify" => $is_verify
            );

            if(!(empty($_FILES['data_pendukung']['name']))) {
                $data_pendukung = $this->do_upload("pdf|jpg|png", "data_pendukung");
                $data += array(
                    "data_pendukung" => $data_pendukung
                );
            }
        }else{
            $data = array(
                "account_nip" => $account_nip,
                "id_jenis_sertifikat" => $id_jenis_sertifikat,
                "no_serti" => $no_serti,
                "penyelenggara" => $penyelenggara,
                "is_verify" => $is_verify
            );

            if(!(empty($_FILES['data_pendukung']['name']))) {
                $data_pendukung = $this->do_upload("pdf|jpg|png", "data_pendukung");
                $data += array(
                    "data_pendukung" => $data_pendukung
                );
            }
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

    public function verify_serti($id) {
        $data = [
            "is_verify" => 1
        ];

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }
}