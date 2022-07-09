<?php

class Surat_model extends CI_Model
{

    public $table = "surat";

    public function get_all()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_all_where($where)
    {
        $query = $this->db->get_where($this->table, $where);
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
        $no = $this->input->post('no_surat');
        $jenis_tujuan = $this->input->post('jenis_tujuan');
        if ($jenis_tujuan == 'divisi') {
            $data_additional = array(
                "tujuan" => $this->input->post('divisi'),
                "detail_tujuan" => implode(',', $this->input->post('tujuan'))
            );
        } else if ($jenis_tujuan == 'perorangan') {
            $data_additional = array(
                "tujuan" => $this->input->post('jenis_pegawai'),
                "detail_tujuan" => implode(',', $this->input->post('pegawai'))
            );
        }

        $jenis = $this->input->post('jenis');

        $file_name = $this->do_upload("pdf", "file_surat");

        if(is_null($file_name))
        {
            echo  $this->input->post('file_surat');
            die();
        }

        $admin_nip = $this->session->userdata('nip');

        date_default_timezone_set('Asia/Jakarta');
        $date =  date("Y/m/d h:i:s");
        $tgl_upload =  $date;

        $data = array(
            "no" => $no,
            "jenis_tujuan" => $jenis_tujuan,
            "tgl_upload" => $tgl_upload,
            "jenis" => $jenis,
            "admin_nip" => $admin_nip,
            "file_name" => $file_name
        );
        $data = array_merge($data, $data_additional);

        $this->db->insert($this->table, $data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update_one($id)
    {
        $this->db->trans_start();

        $no = $this->input->post('no_surat');
        $tujuan = $this->input->post('tujuan');
        $jenis = $this->input->post('jenis');

        $admin_nip = $this->session->userdata('nip');        

        if(!(empty($_FILES['file_surat']['name']))){
            $file_name = $this->do_upload("pdf", "file_surat");   
            date_default_timezone_set('Asia/Jakarta');
            $date =  date("Y/m/d h:i:s");
            $tgl_upload =  $date;

            $data = array(
                "no" => $no,
                "tujuan" => $tujuan,
                "tgl_upload" => $tgl_upload,
                "jenis" => $jenis,
                "admin_nip" => $admin_nip,
                "file_name" => $file_name
            );
        }else{
            $data = array(
                "no" => $no,
                "tujuan" => $tujuan,              
                "jenis" => $jenis,
                "admin_nip" => $admin_nip              
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
