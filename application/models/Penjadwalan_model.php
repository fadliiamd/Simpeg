<?php

class Penjadwalan_model extends CI_Model
{

    public $table = "penjadwalan";

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

    public function get_num_rows()
    {
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function get_all()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_condition($query,$search)
    {
        $query = $this->db->where($query, $search)->get("mutasi");

        return $query->result();
    }

    // public function get_all_with_join_pegawai()
    // {
    //     $this->db->select(
    //         '*'
    //     );
    //     $this->db->from($this->table);
    //     $this->db->join('pegawai', 'pegawai.account_nip = mutasi.pegawai_nip');

    //     $query = $this->db->where("status_kerja", "aktif");
    //     $query = $this->db->get();

    //     return $query->result();
    // }


    public function insert_one()
    {
        
        //check empty string for nullable
        foreach( $this->input->post() as $key => $value) {
            if($value === ""){
                $value = null;
            }
            $_POST[$key] = $value;            
        }
        
        $tgl_diskusi = $this->input->post('tgl_diskusi');
        $waktu = $this->input->post('waktu');
        $hal = $this->input->post('hal');
        $tempat = $this->input->post('tempat');
        $nip = $this->input->post('nip');
        
        $data_penjadwalan = array(
            "id" => "",
            "tgl_diskusi" => $tgl_diskusi,
            "waktu" => $waktu,
            "hal" => $hal,
            "tempat" => $tempat,
            "status" => "belum terlaksana",
            "nip" => $nip
        );
    
        $this->db->insert($this->table, $data_penjadwalan);
    
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

        $tgl_diskusi = $this->input->post('tgl_diskusi');
        $waktu = $this->input->post('waktu');
        $hal = $this->input->post('hal');
        $tempat = $this->input->post('tempat');
        
        $data_penjadwalan = array(
            "tgl_diskusi" => $tgl_diskusi,
            "waktu" => $waktu,
            "hal" => $hal,
            "tempat" => $tempat,
            "status" => "belum terlaksana",
        );

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_penjadwalan);
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

    public function status_penjadwalan($id)
    {        
        $data_penjadwalan = array(
            "status" => "terlaksana",
        ); 

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data_penjadwalan);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }
}