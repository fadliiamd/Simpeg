<?php

class Direktur_model extends CI_Model
{

    public $table = "direktur";
    public $account_table = "account";

    public function get_all()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_all_with_join()
    {
        $this->db->select('direktur.*, jabatan.nama_jabatan as nama_jabatan');
        $this->db->join('jabatan', 'direktur.jabatan_id = jabatan.id');
        $query = $this->db->get($this->table);

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

        if (($this->upload->do_upload($post_name))) {
            $data = $this->upload->data();
            $data = $data['file_name'];
        }

        return $data;
    }

    public function get_one_with_join($id)
    {
        $this->db->select('direktur.*, jabatan.*, account.role as role');
        $this->db->join('jabatan', 'direktur.jabatan_id = jabatan.id', 'left');
        $this->db->join('account', 'direktur.account_nip = account.nip');

        $query = $this->db->get_where($this->table, $id);

        return $query->row();
    }

    public function insert_one()
    {
        //check empty string for nullable
        foreach ($this->input->post() as $key => $value) {
            if ($value === "") {
                $value = null;
            }
            $_POST[$key] = $value;
        }
        // Create account first
        $this->load->model('account_model');
        $add = $this->account_model->register("direktur");

        if ($add) {
            $nip = $this->input->post('nip');
            $nama = $this->input->post('nama');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $agama = $this->input->post('agama');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $alamat = $this->input->post('alamat');
            $email = $this->input->post('email');
            $jabatan = $this->input->post('jabatan');

            $foto = $this->do_upload("jpg|png", "foto");

            $data_direktur = array(
                "nama" => $nama,
                "account_nip" => $nip,
                "jenis_kelamin" => $jenis_kelamin,
                "agama" => $agama,
                "tempat_lahir" => $tempat_lahir,
                "tgl_lahir" => $tgl_lahir,
                "alamat" => $alamat,
                "email" => $email,
                "jabatan_id" => $jabatan,
                "foto" => $foto
            );

            $this->db->insert($this->table, $data_direktur);

            return ($this->db->affected_rows() != 1) ? false : true;
        } else {
            return false;
        }
    }

    public function update_one($id)
    {
        //check empty string for nullable
        foreach ($this->input->post() as $key => $value) {
            if ($value === "") {
                $value = null;
            }
            $_POST[$key] = $value;
        }
        // Update account first
        $this->load->model('account_model');
        $update = $this->account_model->update_one($id);

        if ($update) {
            $nip = $this->input->post('nip');
            $nama = $this->input->post('nama');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $agama = $this->input->post('agama');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $alamat = $this->input->post('alamat');
            $email = $this->input->post('email');
            $jabatan = $this->input->post('jabatan');

            $foto = $this->do_upload("jpg|png", "foto");

            $data_direktur = array(
                "nama" => $nama,
                "jenis_kelamin" => $jenis_kelamin,
                "agama" => $agama,
                "tempat_lahir" => $tempat_lahir,
                "tgl_lahir" => $tgl_lahir,
                "alamat" => $alamat,
                "email" => $email,
                "jabatan_id" => $jabatan,
            );
            if (!is_null($foto)) {
                $data_direktur += array(
                    'foto' => $foto
                );
            }
        } else {
            return false;
        }

        $this->db->trans_start();
        $this->db->where('account_nip', $nip);
        $this->db->update($this->table, $data_direktur);
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
