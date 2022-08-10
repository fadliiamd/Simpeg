<?php

class Surat_model extends CI_Model
{

    public $table = "surat";
    public $sup_table = "surat_subjek";
    public $kriteria_table = "surat_kriteria";
    public $pemilih_table = "pemilih_pegawai";

    public function get_all()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_all_subjek()
    {
        $query = $this->db->get($this->sup_table);
        return $query->result();
    }

    public function get_all_where($where)
    {
        $query = $this->db->get_where($this->table, $where);
        return $query->result();
    }

    public function get_all_where_subjek($where)
    {
        $query = $this->db->get_where($this->sup_table, $where);
        return $query->result();
    }

    public function get_one($where)
    {
        $query = $this->db->get_where($this->table, $where);
        return $query->row();
    }

    public function get_one_subjek($where)
    {
        $query = $this->db->get_where($this->sup_table, $where);
        return $query->row();
    }

    public function insert_one($data)
    {
        $this->db->insert($this->table, $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }
    
    public function insert_pemilih($data)
    {
        $this->db->insert($this->pemilih_table, $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    public function insert_one_with_subjek($data, $subjek = NULL)
    {
        $this->db->trans_start();
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();

        if($subjek != NULL) {
            foreach($subjek as $el) {
                $this->db->insert($this->sup_table, [
                    "subjek" => $el,
                    "surat_id" => $id
                ]);
            }
        }
        $this->db->trans_complete();

        return ($this->db->trans_status() !== FALSE) ? $id : false;
    }

    public function update_one($id, $data, $subjek = NULL)
    {
        $this->db->trans_start();    
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);

        if($subjek != NULL) {
            foreach($subjek as $el) {
                $this->db->insert($this->sup_table, [
                    "subjek" => $el,
                    "surat_id" => $id
                ]);
            }
        }

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
    
    public function delete_pemilih($id)
    {
        $this->db->trans_start();
        $this->db->where('surat_id', $id);
        $this->db->delete($this->pemilih_table);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }

    public function delete_multi_subjek($id, $todelete = NULL)
    {
        $this->db->trans_start();
        if($todelete != NULL) {
            foreach($todelete as $item) {
                $this->db->where([
                    "subjek" => $item,
                    "surat_id" => $id
                ]);
                $this->db->delete($this->sup_table);
            }
        } else {
            $this->db->where([
                "surat_id" => $id
            ]);
            $this->db->delete($this->sup_table);
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }
    
    public function upload_rules() {
        return [
            [
                'field' => 'no_surat', 
				'label' => 'Nomor Surat', 
				'rules' => 'required|is_unique[surat.no]',
                'errors' => [
                    'required' => 'Anda perlu mengisi %s.',
                    'is_unique' => '%s sudah digunakan.',
                ],
            ],
        ];
    }

    public function create_rules() {
        return [
            [
                'field' => 'no_surat', 
				'label' => 'Nomor Surat', 
				'rules' => 'required|is_unique[surat.no]',
                'errors' => [
                    'required' => 'Anda perlu mengisi %s.',
                    'is_unique' => '%s sudah digunakan.',
                ],
            ],
            [
                'field' => 'jenis_kegiatan', 
				'label' => 'Jenis Kegiatan', 
				'rules' => 'required',
                'errors' => [
                    'required' => 'Anda perlu menambahkan %s.',
                ],
            ],
            [
                'field' => 'subjek', 
				'label' => 'Subjek', 
				'rules' => 'required',
                'errors' => [
                    'required' => 'Anda perlu menambahkan %s.',
                ],
            ],
        ];
    }

    public function update_rules() {
        return [
            [
                'field' => 'jenis_kegiatan', 
				'label' => 'Jenis Kegiatan', 
				'rules' => 'required',
                'errors' => [
                    'required' => 'Anda perlu menambahkan %s.',
                ],
            ],
            [
                'field' => 'subjek', 
				'label' => 'Subjek', 
				'rules' => 'required',
                'errors' => [
                    'required' => 'Anda perlu menambahkan %s.',
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

    public function get_all_kriteria()
    {
        $query = $this->db->get($this->kriteria_table);
        return $query->result();
    }

    public function get_kriteria($where)
    {
        $query = $this->db->get_where($this->kriteria_table, $where);
        return $query->row();
    }

    public function insert_kriteria($data)
    {
        $this->db->insert($this->kriteria_table, $data);
        return ($this->db->affected_rows() != 1) ? false : $this->db->insert_id();
    }

    public function update_kriteria($id, $data)
    {
        $this->db->trans_start();    
        $this->db->where('id', $id);
        $this->db->update($this->kriteria_table, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }

    public function delete_kriteria()
    {

    }
}
