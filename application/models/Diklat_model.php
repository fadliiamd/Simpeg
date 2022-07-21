<?php

class Diklat_model extends CI_Model
{
    public $table = "diklat";

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

    public function get_all_join_sertifikat()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('sertifikat', $this->table.'.sertifikat_id = sertifikat.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_one($where)
    {
        $query = $this->db->get_where($this->table, $where);
        return $query->row();
    }

    public function get_one_join($where)
    {
        $this->db->select('*');
        $this->db->from('diklat');
        $this->db->join('sertifikat', 'diklat.sertifikat_id = sertifikat.id');
        $this->db->where($where);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_one_join_limit($where, $limit)
    {
        $this->db->select('*');        
        $this->db->join('surat', 'surat.id = diklat.surat_id');        
        $this->db->limit($limit);

        $query = $this->db->get_where('diklat', $where);
        return $query->result();
    }

    public function get_num_rows()
    {
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }
    
    public function get_num_rows_by($nip)
    {
        $query = $this->db->get_where($this->table, $nip);
        return $query->num_rows();
    }

    public function insert_one($data)
    {
        $this->db->insert($this->table, $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function update_one($id, $data)
    {
        $this->db->trans_start();
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

    public function create_rules() {
        return [
            [
                'field' => 'file_foto', 
				'label' => 'File Foto', 
				'rules' => 'required|callback_file_check',
                'errors' => [
                    'required' => 'Anda perlu mengunggah %s.',
                    'file_check' => 'Format %s yang diizinkan hanya pdf',
                ],
            ],
            [
                'field' => 'file_ktp', 
				'label' => 'File KTP', 
				'rules' => 'required|callback_file_check',
                'errors' => [
                    'required' => 'Anda perlu mengunggah %s.',
                    'file_check' => 'Format %s yang diizinkan hanya pdf',
                ],
            ],
            [
                'field' => 'file_kk', 
				'label' => 'File Kartu Keluarga', 
				'rules' => 'required|callback_file_check',
                'errors' => [
                    'required' => 'Anda perlu mengunggah %s.',
                    'file_check' => 'Format %s yang diizinkan hanya pdf',
                ],
            ],
            [
                'field' => 'file_ijazah', 
				'label' => 'File Ijazah', 
				'rules' => 'required|callback_file_check',
                'errors' => [
                    'required' => 'Anda perlu mengunggah %s.',
                    'file_check' => 'Format %s yang diizinkan hanya pdf',
                ],
            ],
        ];
    }

    public function hasil_rules() {
        return [
            [
                'field' => 'angka_kredit', 
				'label' => 'Angka Kredit', 
				'rules' => 'required',
                'errors' => [
                    'required' => 'Anda perlu mengisi %s.',
                ],
            ],
            [
                'field' => 'file_materi', 
				'label' => 'File Materi Hasil Diklat', 
				'rules' => 'required|callback_file_check',
                'errors' => [
                    'required' => 'Anda perlu mengunggah %s.',
                    'file_check' => 'Format %s yang diizinkan hanya pdf',
                ],
            ],
            [
                'field' => 'file_sertifikat', 
				'label' => 'File Sertifikat', 
				'rules' => 'required|callback_file_check',
                'errors' => [
                    'required' => 'Anda perlu mengunggah %s.',
                    'file_check' => 'Format %s yang diizinkan hanya pdf',
                ],
            ],
        ];
    }

    public function file_check($str){
        $allowed_mime_type_arr = ['application/pdf'];
        $mime = get_mime_by_extension($_FILES['file']['name']);
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']!="") {
            if(in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}