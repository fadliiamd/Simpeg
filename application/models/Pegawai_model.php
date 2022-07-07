<?php

class Pegawai_model extends CI_Model
{

    public $table = "pegawai";
    public $account_table = "account";

    public function get_all()
    {
        $this->db->select('*, pegawai.account_nip as account_nip, COUNT(*) as jmlh_serti');
        $this->db->from($this->table);
        $this->db->join('sertifikat', 'pegawai.account_nip = sertifikat.account_nip', 'left');        
        $this->db->group_by('pegawai.account_nip');
        $this->db->order_by('pegawai.account_nip', 'asc');

        $query = $this->db->get();        
        // var_dump($query->result());die();
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
        $this->db->select('*, pegawai.nama as nama_pegawai, jurusan.nama as nama_jurusan, bagian.nama as nama_bagian, unit.nama as nama_unit');
        $this->db->from($this->table);
        $this->db->join('jurusan', 'pegawai.jurusan_id = jurusan.id', 'left');
        $this->db->join('bagian', 'pegawai.bagian_id = bagian.id', 'left');
        $this->db->join('unit', 'pegawai.unit_id = unit.id', 'left');

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

    public function insert_one()
    {
        //check empty string for nullable
        foreach( $this->input->post() as $key => $value) {
            if($value === ""){
                $value = null;
            }
            $_POST[$key] = $value;            
        }
        // Create account first
        $this->load->model('account_model');        
        $add = $this->account_model->register("pegawai");        

        if($add){
            $nip = $this->input->post('nip');
            $nama = $this->input->post('nama');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $agama = $this->input->post('agama');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $alamat = $this->input->post('alamat');
            $email = $this->input->post('email');
            $golongan_id = $this->input->post('golongan_id');
            $jenis_pegawai = $this->input->post('jenis_pegawai');
            $status_pegawai = $this->input->post('status_pegawai');
            $gaji = $this->input->post('gaji');
            $jabatan = $this->input->post('jabatan');
            $tgl_masuk = $this->input->post('tgl_masuk');
            $pendidikan = $this->input->post('pendidikan');

            $jurusan_id = $this->input->post('jurusan_id');
            $bagian_id = $this->input->post('bagian_id');
            $unit_id = $this->input->post('unit_id');     
            
            $foto = $this->do_upload("jpg|png", "foto");
            $ijazah = $this->do_upload("pdf", "ijazah");
            $karpeg = $this->do_upload("pdf|jpg|png", "karpeg");                    

            $data_pegawai = array(
                "nama" => $nama,
                "account_nip" => $nip,
                "jenis_kelamin" => $jenis_kelamin,
                "agama" => $agama,
                "tempat_lahir" => $tempat_lahir,
                "tgl_lahir" => $tgl_lahir,
                "alamat" => $alamat,
                "email" => $email,
                "golongan_id" => $golongan_id,
                "jenis_pegawai" => $jenis_pegawai,
                "status" => $status_pegawai,
                "gaji" => $gaji,
                "jabatan" => $jabatan,
                "tgl_masuk" => $tgl_masuk,
                "pendidikan" => $pendidikan,
                "jurusan_id" => $jurusan_id,
                "bagian_id" => $bagian_id,
                "unit_id" => $unit_id,
                "foto" => $foto,
                "ijazah" => $ijazah,
                "karpeg" => $karpeg
            );
    
            $this->db->insert($this->table, $data_pegawai);
    
            return ($this->db->affected_rows() != 1) ? false : true;
        }else{
            return false;
        }
    
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
            $nip = $this->input->post('nip');
            $nama = $this->input->post('nama');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $agama = $this->input->post('agama');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $alamat = $this->input->post('alamat');
            $email = $this->input->post('email');
            $golongan_id = $this->input->post('golongan_id');
            $jenis_pegawai = $this->input->post('jenis_pegawai');
            $status_pegawai = $this->input->post('status_pegawai');
            $gaji = $this->input->post('gaji');
            $jabatan = $this->input->post('jabatan');
            $tgl_masuk = $this->input->post('tgl_masuk');
            $pendidikan = $this->input->post('pendidikan');

            $jurusan_id = $this->input->post('jurusan_id');
            $bagian_id = $this->input->post('bagian_id');
            $unit_id = $this->input->post('unit_id');     
            
            $foto = $this->do_upload("jpg|png", "foto");
            $ijazah = $this->do_upload("pdf", "ijazah");
            $karpeg = $this->do_upload("pdf|jpg|png", "karpeg");                    

            $data_pegawai = array(
                "nama" => $nama,
                "jenis_kelamin" => $jenis_kelamin,
                "agama" => $agama,
                "tempat_lahir" => $tempat_lahir,
                "tgl_lahir" => $tgl_lahir,
                "alamat" => $alamat,
                "email" => $email,
                "golongan_id" => $golongan_id,
                "jenis_pegawai" => $jenis_pegawai,
                "status" => $status_pegawai,
                "gaji" => $gaji,
                "jabatan" => $jabatan,
                "tgl_masuk" => $tgl_masuk,
                "pendidikan" => $pendidikan,
                "jurusan_id" => $jurusan_id,
                "bagian_id" => $bagian_id,
                "unit_id" => $unit_id,
                "foto" => $foto,
                "ijazah" => $ijazah,
                "karpeg" => $karpeg
            );
        }else{
            return false;
        }

        $this->db->trans_start();
        $this->db->where('account_nip', $nip);
        $this->db->update($this->table, $data_pegawai);
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
