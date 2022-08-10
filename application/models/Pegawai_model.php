<?php

class Pegawai_model extends CI_Model
{

    public $table = "pegawai";
    public $account_table = "account";
    public $berkas_table = "pegawai_berkas";

    public function get_all_column($col, $where = NULL)
    {
        $this->db->select($col);
        if ($where != NULL) {
            $query = $this->db->get_where($this->table, $where);
        } else {
            $this->db->from($this->table);
            $query = $this->db->get();
        }
        return $query->result();
    }

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

    public function get_all_active($arr)
    {
        $this->db->select('*, pegawai.account_nip as account_nip, COUNT(*) as jmlh_serti');
        $this->db->join('sertifikat', 'pegawai.account_nip = sertifikat.account_nip', 'left');
        $this->db->join('jabatan', 'pegawai.jabatan_id = jabatan.id', 'left');
        $this->db->group_by('pegawai.account_nip');
        $this->db->order_by('pegawai.account_nip', 'asc');

        $query = $this->db->get_where($this->table, $arr);
        // var_dump($query->result());die();
        return $query->result();
    }

    public function get_all_where_join($where, $join_table, $relation)
    {
        $this->db->select('*');
        $this->db->from($join_table);
        $this->db->join($this->table, $relation);
        $this->db->where($where);

        $query = $this->db->get();
        return $query->result();
    }

    public function get_one($where)
    {
        return $this->db->get_where($this->table, $where)->row();
    }

    public function get_one_with_jabatan($where)
    {
        $this->db->join('jabatan', 'jabatan.id = pegawai.jabatan_id', 'left');
        return $this->db->get_where($this->table, $where)->row();
    }

    public function get_num_rows()
    {
        $query = $this->db->get($this->table);

        return $query->num_rows();
    }

    public function get_condition($query, $search)
    {
        $query = $this->db->where($query, $search)->get("pegawai");

        return $query->result();
    }

    public function get_pegawai_tua()
    {
        date_default_timezone_set('Asia/Jakarta');
        $time = new DateTime('now');
        $newtime = $time->modify('-20 year')->format('Y-m-d H:i:s');

        $query = $this->db->where("status", "PNS");
        $query = $this->db->where("tgl_menjabat <", $newtime);
        $query = $this->db->where("status_kerja", "aktif");
        $query = $this->db->get("pegawai");

        return $query->result();
    }

    public function get_pegawai_muda()
    {
        date_default_timezone_set('Asia/Jakarta');
        $time = new DateTime('now');
        $newtime = $time->modify('-20 year')->format('Y-m-d H:i:s');

        $query = $this->db->where("status", "PNS");
        $query = $this->db->where("tgl_menjabat >", $newtime);
        $query = $this->db->where("status_kerja", "aktif");
        $query = $this->db->get("pegawai");

        return $query->result();
    }

    public function get_pegawai_non_pns()
    {
        $query = $this->db->where("status != ", "PNS");
        $query = $this->db->where("status_kerja", "aktif");
        $query = $this->db->get("pegawai");

        return $query->result();
    }

    public function get_all_where($where, $limit = 0, $where_in = NULL)
    {
        if ($limit == 0) {
            $this->db->select('sertifikat.*, pegawai.*, bidang_keahlian.*, jabatan.*, jurusan.nama as nama_jurusan, bagian.nama as nama_bagian, unit.nama as nama_unit');
            $this->db->from($this->table);
            $this->db->join("jabatan", 'jabatan.id = pegawai.jabatan_id', 'left');
            $this->db->join("sertifikat", 'sertifikat.account_nip = pegawai.account_nip', 'left');
            $this->db->join('jurusan', 'pegawai.jurusan_id = jurusan.id', 'left');
            $this->db->join('bagian', 'pegawai.bagian_id = bagian.id', 'left');
            $this->db->join('unit', 'pegawai.unit_id = unit.id', 'left');
            $this->db->join('bidang_keahlian', 'pegawai.bidang_keahlian_id = bidang_keahlian.id_keahlian', 'left');
            $this->db->where($where);
            if ($where_in != NULL) {
                foreach ($where_in as $key => $value) {
                    $this->db->where_in($key, $value);
                }
            }
            $this->db->group_by('pegawai.account_nip');
            $query = $this->db->get();
        } else {
            $query = $this->db->get_where($this->table, $where, $limit);
        }
        return $query->result();
    }

    public function get_pejabat()
    {
        $this->db->select('pegawai.*, bidang_keahlian.*, jabatan.*, jurusan.nama as nama_jurusan, bagian.nama as nama_bagian, unit.nama as nama_unit');
        $this->db->from($this->table);
        $this->db->join("jabatan", 'jabatan.id = pegawai.jabatan_id', 'left');
        $this->db->join('jurusan', 'pegawai.jurusan_id = jurusan.id', 'left');
        $this->db->join('bagian', 'pegawai.bagian_id = bagian.id', 'left');
        $this->db->join('unit', 'pegawai.unit_id = unit.id', 'left');
        $this->db->join('bidang_keahlian', 'pegawai.bidang_keahlian_id = bidang_keahlian.id_keahlian', 'left');
        $this->db->where("nama_jabatan", "Kepala Bagian Umum");
        $this->db->or_where("nama_jabatan", "Ketua Jurusan");
        
        $query = $this->db->get();

        return $query->result();
    }

    public function get_all_order($coloumn, $type_order)
    {
        $this->db->select('pegawai.*, bidang_keahlian.*, jabatan.*, jurusan.nama as nama_jurusan, bagian.nama as nama_bagian, unit.nama as nama_unit');
        $this->db->from($this->table);
        $this->db->join("jabatan", 'jabatan.id = pegawai.jabatan_id', 'left');
        $this->db->join('jurusan', 'pegawai.jurusan_id = jurusan.id', 'left');
        $this->db->join('bagian', 'pegawai.bagian_id = bagian.id', 'left');
        $this->db->join('unit', 'pegawai.unit_id = unit.id', 'left');
        $this->db->join('bidang_keahlian', 'pegawai.bidang_keahlian_id = bidang_keahlian.id_keahlian', 'left');
        $where = ["pegawai.status_kerja" => "aktif"];
        if ($this->session->userdata('nama_jabatan') === "Kepala Jurusan") {
            $where += [
                "pegawai.jurusan_id" => $this->session->userdata('jurusan_id'),
                "jabatan.jenis_jabatan" => "fungsional"
            ];
        }
        $this->db->where($where);
        $this->db->order_by($coloumn, $type_order);

        $query = $this->db->get();

        return $query->result();
    }

    public function get_all_with_join($where = ["1" => "1"])
    {
        $this->db->select('pegawai.*, b.nama as nama_atasan, pegawai.nama as nama_pegawai, jurusan.nama as nama_jurusan, bagian.nama as nama_bagian, unit.nama as nama_unit');
        $this->db->join('jurusan', 'pegawai.jurusan_id = jurusan.id', 'left');
        $this->db->join('bagian', 'pegawai.bagian_id = bagian.id', 'left');
        $this->db->join('unit', 'pegawai.unit_id = unit.id', 'left');
        $this->db->join('jabatan', 'pegawai.jabatan_id = jabatan.id', 'left');
        $this->db->join('pegawai b', 'b.account_nip = pegawai.atasan_nip', 'left');

        $query = $this->db->get_where($this->table, $where);

        return $query->result();
    }

    public function get_one_with_join($id)
    {
        $this->db->select('pegawai.*, jabatan.*, bidang_keahlian.*, account.role as role, jurusan.nama as nama_jurusan, bagian.nama as nama_bagian, unit.nama as nama_unit');
        $this->db->join('jabatan', 'pegawai.jabatan_id = jabatan.id', 'left');
        $this->db->join('jurusan', 'pegawai.jurusan_id = jurusan.id', 'left');
        $this->db->join('bagian', 'pegawai.bagian_id = bagian.id', 'left');
        $this->db->join('unit', 'pegawai.unit_id = unit.id', 'left');
        $this->db->join('account', 'pegawai.account_nip = account.nip');
        $this->db->join('bidang_keahlian', 'pegawai.bidang_keahlian_id = bidang_keahlian.id_keahlian', 'left');

        $query = $this->db->get_where($this->table, $id);

        return $query->row();
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

        if (($this->upload->do_upload($post_name))) {
            $data = $this->upload->data();
            $data = $data['file_name'];
        }

        return $data;
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
        $add = $this->account_model->register("pegawai");

        if ($this->input->post('status_kerja') != "pending") {
            $status_kerja = "aktif";
        } else {
            $status_kerja = "pending";
        }

        if ($add) {
            $nip = $this->input->post('nip');
            $nama = $this->input->post('nama');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $agama = $this->input->post('agama');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $alamat = $this->input->post('alamat');
            $email = $this->input->post('email');
            $golongan_id = $this->input->post('golongan_id');
            $status_pegawai = $this->input->post('status_pegawai');
            $gaji = $this->input->post('gaji');
            $jabatan = $this->input->post('jabatan');
            $tgl_masuk = $this->input->post('tgl_masuk');
            $pendidikan = $this->input->post('pendidikan');
            $atasan = $this->input->post('atasan');
            $no_hp = $this->input->post('no_hp');

            $jurusan_id = $this->input->post('jurusan_id');
            $bagian_id = $this->input->post('bagian_id');
            $unit_id = $this->input->post('unit_id');

            $foto = $this->do_upload("jpg|png", "foto");
            $ijazah = $this->do_upload("pdf", "ijazah");
            $karpeg = $this->do_upload("pdf|jpg|png", "karpeg");

            $tgl_menjabat = $this->input->post('tgl_menjabat');
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
                "status" => $status_pegawai,
                "gaji" => $gaji,
                "jabatan_id" => $jabatan,
                "tgl_masuk" => $tgl_masuk,
                "pendidikan" => $pendidikan,
                "jurusan_id" => $jurusan_id,
                "bagian_id" => $bagian_id,
                "unit_id" => $unit_id,
                "foto" => $foto,
                "ijazah" => $ijazah,
                "karpeg" => $karpeg,
                "status_kerja" => $status_kerja,
                "tgl_menjabat" => $tgl_menjabat,
                "atasan_nip" => $atasan,
                "no_hp" => $no_hp
            );

            $this->db->insert($this->table, $data_pegawai);

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
            $golongan_id = $this->input->post('golongan_id');
            $status_pegawai = $this->input->post('status_pegawai');
            $gaji = $this->input->post('gaji');
            $jabatan = $this->input->post('jabatan');
            $tgl_masuk = $this->input->post('tgl_masuk');
            $pendidikan = $this->input->post('pendidikan');
            $atasan = $this->input->post('atasan');
            $no_hp = $this->input->post('no_hp');

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
                "status" => $status_pegawai,
                "gaji" => $gaji,
                "jabatan_id" => $jabatan,
                "tgl_masuk" => $tgl_masuk,
                "pendidikan" => $pendidikan,
                "jurusan_id" => $jurusan_id,
                "bagian_id" => $bagian_id,
                "unit_id" => $unit_id,
                "atasan_nip" => $atasan,
                "no_hp" => $no_hp
            );

            if (!is_null($foto)) {
                $data_pegawai += array(
                    'foto' => $foto
                );
            }
            if (!is_null($ijazah)) {
                $data_pegawai += array(
                    'ijazah' => $ijazah
                );
            }
            if (!is_null($karpeg)) {
                $data_pegawai += array(
                    'karpeg' => $karpeg
                );
            }
        } else {
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

    public function update_profile_one($id)
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
            $keahlian_id = $this->input->post('keahlian_id');

            $foto = $this->do_upload("jpg|png", "foto");
            $ktp = $this->do_upload("pdf|jpg|png", "ktp");
            $kk = $this->do_upload("pdf|jpg|png", "kk");
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
                "bidang_keahlian_id" => $keahlian_id
            );

            if (!is_null($foto)) {
                $data_pegawai += array(
                    'foto' => $foto
                );
            }
            if (!is_null($ktp)) {
                $data_pegawai += array(
                    'ktp' => $ktp
                );
            }
            if (!is_null($kk)) {
                $data_pegawai += array(
                    'kk' => $kk
                );
            }
            if (!is_null($ijazah)) {
                $data_pegawai += array(
                    'ijazah' => $ijazah
                );
            }
            if (!is_null($karpeg)) {
                $data_pegawai += array(
                    'karpeg' => $karpeg
                );
            }
        } else {
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

    public function update_one_where($where, $data)
    {
        $this->db->trans_start();
        $this->db->where($where);
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
        $this->db->where('nip', $id);
        $this->db->delete($this->account_table);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        return true;
    }
}
