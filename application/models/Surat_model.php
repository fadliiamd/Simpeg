<?php

class Surat_model extends CI_Model
{

    public $table = "surat";
    public $sup_table = "surat_subjek";

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

    public function insert_one_with_subjek($data, $subjek = NULL)
    {
        $this->db->trans_start();
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();

        if($subjek != NULL) {
            foreach($subjek as $el) {
                $this->db->insert($this->sup_table, [
                    "subjek" => $el->account_nip,
                    "surat_id" => $id
                ]);
            }
        }
        $this->db->trans_complete();

        return ($this->db->trans_status() !== FALSE) ? true : false;
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

    public function create_rules() {
        return [
            [
                'field' => 'no_surat', 
				'label' => 'Nomor Surat', 
				'rules' => 'required|is_unique',
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
                    'required' => 'Anda perlu mengisi %s.',
                ],
            ],
        ];
    }
}
