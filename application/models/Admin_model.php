<?php

class Admin_model extends CI_Model
{

    public $table = "admin";
    public $account_table = "account";

    public function get_all()
    {
        $this->db->select('*, admin.account_nip as account_nip, COUNT(*) as jmlh_serti');
        $this->db->from($this->table);
        $this->db->join('sertifikat', 'admin.account_nip = sertifikat.account_nip', 'left');        
        $this->db->group_by('admin.account_nip');
        $this->db->order_by('admin.account_nip', 'asc');

        $query = $this->db->get();        
        // var_dump($query->result());die();
        return $query->result();
    }

    public function get_one($where)
    {
        return $this->db->get_where($this->table, $where)->row();
    }
    
    public function get_num_rows()
    {
        $query = $this->db->get($this->table);

        return $query->num_rows();
    }

    public function get_condition($query,$search)
    {
        $query = $this->db->where($query, $search)->get("admin");

        return $query->result();
    }

    public function get_all_where($where, $limit = 0)
    {
        $this->db->select('*');
        if($limit == 0) {
            $query = $this->db->get_where($this->table, $where);
        } else {
            $query = $this->db->get_where($this->table, $where, $limit);
        }
        return $query->result();
    }

    public function get_all_order($coloumn, $type_order){
        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->order_by($coloumn, $type_order);

        $query = $this->db->get();        
        
        return $query->result();
    }

    public function get_all_with_join()
    {
        $this->db->select('*, admin.nama as nama_admin, jurusan.nama as nama_jurusan, bagian.nama as nama_bagian, unit.nama as nama_unit');
        $this->db->from($this->table);
        $this->db->join('jurusan', 'admin.jurusan_id = jurusan.id', 'left');
        $this->db->join('bagian', 'admin.bagian_id = bagian.id', 'left');
        $this->db->join('unit', 'admin.unit_id = unit.id', 'left');

        $query = $this->db->get();

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

    public function update_one($id)
    {
         //check empty string for nullable
         foreach( $this->input->post() as $key => $value) {
            if($value === ""){
                $value = null;
            }
            $_POST[$key] = $value;            
        }
        // Update account first
        $this->load->model('account_model');        
        $update = $this->account_model->update_one($id);        

        if($update){
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');

            $data_admin = array(                
                "nama" => $nama,                
                "email" => $email               
            );
        }else{
            return false;
        }

        $this->db->trans_start();
        $this->db->where('account_nip', $this->input->post('nip'));
        $this->db->update($this->table, $data_admin);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }

    public function delete_one($id)
    {
        $this->db->trans_start();
        $this->db->where('nip', $id);
        $this->db->delete($this->account_table);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }
}
