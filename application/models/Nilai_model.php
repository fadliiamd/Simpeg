<?php

class Nilai_model extends CI_Model
{

    public $table = "nilai";

    public function get_all()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }    
    
    public function get_where($array)
    {
        $query = $this->db->get_where($this->table, $array);

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

    public function inserts_one()
    {    
        //buat dulu data rekap nilai
        $this->load->model('rekap_nilai_model');
        $tgl = date('Y-m-d H:i:s');
        $id_rekap_nilai = $this->rekap_nilai_model->insert_one_get_id([
            'account_nip' => $_SESSION['nip'],
            "tgl_usulan" => $tgl,
            "status" => "pending",    
            "hasil_akk" => 0
        ]);                                 
        $jmlh = 0;          
        foreach ($_FILES as $key => $value){
            $data = array();    
            $nilai = doubleval($this->input->post('nilai-'.explode("-", $key)[1]));
            $jmlh += $nilai;                        
            $file = $this->do_upload('pdf', $key);                                    
            $data += array(                           
                "file" => $file,
                "unsur_kegiatan_id" => explode("-", $key)[1],
                "rekap_nilai_id" => $id_rekap_nilai  ,
                "nilai" => $nilai
            );                         
            $this->db->insert($this->table, $data);
        }

        $this->rekap_nilai_model->update_one($id_rekap_nilai, ['hasil_akk' => $jmlh]);

        return ($this->db->affected_rows() > 0) ? false : true;
    }

    public function update_one($id, $rekap_nilai_id=null)
    {
        $this->db->trans_start();
        $data = array(
            "alasan" => $this->input->post("alasan"),
            "saran" => $this->input->post("saran"),
            "status" => $this->input->post("validasi"),
            "tanggal_validasi" => date("Y-m-d H:i:s")
        );
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        $this->check_nilai_rekap_status($rekap_nilai_id);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }

    public function check_ditolak($nilai_arr){
        foreach($nilai_arr as $nilai){
            if($nilai->status === 'ditolak'){
                return true;
            }
        }
        return false;
    }
    
    public function check_pending($nilai_arr){
        foreach($nilai_arr as $nilai){
            if($nilai->status === 'pending'){
                return true;
            }
        }
        return false;
    }

    public function check_nilai_rekap_status($rekap_nilai_id){
        $this->load->model('rekap_nilai_model');
        $nilai = $this->get_where(['rekap_nilai_id' => $rekap_nilai_id]);
        
        if($this->check_ditolak($nilai)){
            //update status rekap nilai ditolak
            $this->rekap_nilai_model->update_one($rekap_nilai_id, [
                'status' => 'ditolak',
                'tgl_validasi' => date("Y-m-d H:i:s")
            ]);
        }else if(!$this->check_pending($nilai)){
            //update status rekap nilai setuju
            $this->rekap_nilai_model->update_one($rekap_nilai_id, [
                'status' => 'disetujui',
                'tgl_validasi' => date("Y-m-d H:i:s")
            ]);
        }
       
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
