<?php

class Kenaikan_jabatan_model extends CI_Model
{

    public $table = "pengajuan_kenaikan_jabatan";

    public function get_all()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_where($where)
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
        $data = null;
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
        if($this->session->userdata('role') == 'admin'){
            $account_nip = $this->input->post('account_nip');
        }else{
            $account_nip = $this->session->userdata('nip');
        }    

        $jabatan_tujuan = $this->input->post('jabatan');

        $bukti_1 = $this->do_upload("pdf", "bukti_1");
        $bukti_2 = $this->do_upload("pdf", "bukti_2");              
        $bukti_3 = $this->do_upload("pdf", "bukti_3");              
        $bukti_4 = $this->do_upload("pdf", "bukti_4");              

        $data = array(
            "account_nip" => $account_nip,
            "jabatan_tujuan" => $jabatan_tujuan,
            "bukti_1" => $bukti_1,
            "bukti_2" => $bukti_2,                 
            "bukti_3" => $bukti_3,
            "bukti_4" => $bukti_4,
        );

        $this->db->insert($this->table, $data);

        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update_status($id)
    {
        $this->db->trans_start();
        $status = $this->input->post('status');

        $data = array(
            "status" => $status
        );
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }

    public function update_one($id)
    {
        $this->db->trans_start();
        $data = array();
        
        foreach($_FILES as $key => $value){
            $file = $this->do_upload("pdf", $key);
            if(!is_null($file)){
                $data += array(
                    $key => $file
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
}
