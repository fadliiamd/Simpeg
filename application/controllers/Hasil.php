<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasil extends Roles
{

    public function __construct()
    {
        parent::__construct(["admin", "pegawai"]);
        $this->load->model([
            "surat_model",
            "pegawai_model",
            "keahlian_model",
            'jabatan_model',
            "jurusan_model",
            "bagian_model",
            "unit_model",
            "sertifikat_model"
        ]);
    }

    private function get_filter_pegawai($surat_id)
    {
        // Get Detail Surat
        $surat = $this->surat_model->get_one([
            "id" => $surat_id
        ]);
        
        if(!is_null($surat->kriteria_id)) {
            // Get Detail Kriteria
            $detail_kriteria = $this->surat_model->get_kriteria([
                "id" => $surat->kriteria_id
            ]);

            // Based Filter
            $where_in = [];
            $where = ["status_kerja" => "aktif"];
            if($this->session->userdata('nama_jabatan') === "Ketua Jurusan") {
                $where += [
                    "jurusan_id" => $this->session->userdata('jurusan_id'),
                    "jabatan.jenis_jabatan" => "fungsional"
                ];
            }
            if($this->session->userdata('nama_jabatan') === "Kepala Bagian Umum") {
                $where += [
                    "jurusan_id" => $this->session->userdata('jurusan_id'),
                    "jabatan.jenis_jabatan" => "struktural"
                ];
            }

            // Filter 1: Masa Kerja [ ERROR ]
            // != diganti jadi == agar tidak dijalankan            
            if($detail_kriteria->masa_kerja != NULL) {
                $date_point = intval(date('Y', strtotime('-'.$detail_kriteria->masa_kerja.' years')));                
                $where += [
                    "YEAR(`pegawai`.`tgl_masuk`) <=" => $date_point,
                    // "DATE_FORMAT(pegawai.tgl_masuk,'%Y-%m-%d') > '".$date_point."'",NULL,FALSE
                ];                
            }

            // Filter 2: Pendidikan
            if($detail_kriteria->pendidikan != NULL) {
                $pendidikan = explode(",", $detail_kriteria->pendidikan);
                $where_in += [
                    "pegawai.pendidikan" => $pendidikan
                ];
            }

            // Filter 3: Jenis Pegawai
            if($detail_kriteria->jenis_pegawai != NULL) {
                $jenis_pegawai = explode(",", $detail_kriteria->jenis_pegawai);
                $where_in += [
                    "jabatan.jenis_jabatan" => $jenis_pegawai
                ];
            }

            // Filter 4: Jurusan
            if($detail_kriteria->jurusan_id != NULL) {
                $jurusan = explode(",", $detail_kriteria->jurusan_id);
                $where_in += [
                    "pegawai.jurusan_id" => $jurusan
                ];
            }

            // Filter 5: Bagian
            if($detail_kriteria->bagian_id != NULL) {
                $bagian = explode(",", $detail_kriteria->bagian_id);
                $where_in += [
                    "pegawai.bagian_id" => $bagian
                ];
            }

            // Filter 6: Unit
            if($detail_kriteria->unit_id != NULL) {
                $unit = explode(",", $detail_kriteria->unit_id);
                $where_in += [
                    "pegawai.unit_id" => $unit
                ];
            }

            // Filter 7: Jabatan
            if($detail_kriteria->jabatan_id != NULL) {
                $jabatan = explode(",", $detail_kriteria->jabatan_id);
                $where_in += [
                    "pegawai.jabatan_id" => $jabatan
                ];
            }

            // Filter 8: Bidang Keahlian
            if($detail_kriteria->bidang_keahlian_id != NULL) {
                $bidang_keahlian = explode(",", $detail_kriteria->bidang_keahlian_id);
                $where_in += [
                    "pegawai.bidang_keahlian_id" => $bidang_keahlian
                ];
            }

            // Filter 9: Sertifikat
            if($detail_kriteria->sertifikat_id != NULL) {
                $sertifikat = explode(",", $detail_kriteria->sertifikat_id);
                $where_in += [
                    "pegawai.sertifikat_id" => $sertifikat
                ];
            }

            return $this->pegawai_model->get_all_where($where, 0, $where_in);            
        } else {
            return -1;
        }
    }

    public function index()
    {
        if($this->session->userdata('role') != 'admin') {
            // Get This User Info
            $userinfo = $this->pegawai_model->get_one([
                "account_nip" => $this->session->userdata('nip')
            ]);

            // Get Jabatan Info
            if($userinfo->jabatan_id != NULL) {
                $jabataninfo = $this->jabatan_model->get_one([
                    "id" => $userinfo->jabatan_id
                ]);
            }
        }

        // If POST Request Exists
        if (!empty($_GET)) {
            $surat_id = $_GET['surat_id'];

            $pegawai = $this->get_filter_pegawai($surat_id);    
            if($pegawai == -1) {
                $this->session->set_flashdata('message_error', 'Gagal melakukan filter, kriteria surat belum diatur!');
                redirect("hasil");
            }        
        } else {            
            if($this->session->userdata('jabatan') == 'Kepala Bagian Umum') {
                // Get by Jenis Struktural
                $pegawai = $this->pegawai_model->get_all_where(['jabatan.jenis_jabatan' => "struktural"]);
            } else if($this->session->userdata('jabatan') == 'Ketua Jurusan') {
                // Get by Nama Jurusan                
                $pegawai = $this->pegawai_model->get_all_where(
                    ["jurusan.id" => $userinfo->jurusan_id]
                );
            } else {
                $pegawai = $this->pegawai_model->get_all_order('nilai_rank', 'desc');
            }
        }
        $surat = $this->surat_model->get_all_where([
            'status' => 'need ranking'
        ]);

        if($this->session->userdata('role') != 'admin') {
            //get surat yang punya akses dia saja
            $all_surat = $this->surat_model->get_all_where([
                "pemilih_nip" => $this->session->userdata('nip')
            ]);            
        }else{
            $all_surat = $this->surat_model->get_all_where([
                "jenis_tujuan" => "tidak ada"
            ]);
        }        
        $jabatan = $this->jabatan_model->get_all();

        $jurusan = $this->jurusan_model->get_all();
        $bagian = $this->bagian_model->get_all();
        $unit = $this->unit_model->get_all();
        $bidang_keahlian = $this->keahlian_model->get_all();
        $sertifikat = $this->sertifikat_model->get_all();

        $list_jabatan = [];
        foreach ($jabatan as $value) {
            $list_jabatan[$value->id] = $value;
        }        
        $this->load->view('partials/main-header', [
            "title" => "Hasil Perangkingan"
        ]);
        $this->load->view('perangkingan/hasil-fix', [
            "sertifikat" => $sertifikat,
            "bidang_keahlian" => $bidang_keahlian,
            "jabatan" => $jabatan,
            "pegawai" => $pegawai,
            "list_surat" => $surat,
            "list_all_surat" => $all_surat,
            "list_jabatan" => $list_jabatan,
            "jurusan" => $jurusan,
            "bagian" => $bagian,
            "unit" => $unit
        ]);
        $this->load->view('partials/main-footer');
    }

    public function perhitungan()
    {
        $this->load->model("kriteria_model");
        $this->load->model("subkriteria_model");
        $this->load->model("pegawai_model");
        $this->load->model("nilaialternatif_model");

        $kriteria = $this->kriteria_model->get_all();
        $subkriteria = $this->subkriteria_model->get_all();
        $nilaialternatif = $this->nilaialternatif_model->get_all();
        $pegawai = $this->pegawai_model->get_all_active([
            "status_kerja" => "aktif",
            "jenis_jabatan" => "struktural"
        ]);

        $this->load->view('partials/main-header', [
            "title" => "Perhitungan Perangkingan"
        ]);
        $this->load->view('perangkingan/alternatif', [
            "kriteria" => $kriteria,
            "subkriteria" => $subkriteria,
            "pegawai" => $pegawai,
            "nilai" => $nilaialternatif
        ]);
        $this->load->view('partials/main-footer');
    }

    public function pengajuan()
    {
        // Load Model
        $this->load->model("hasil_model");
        $this->load->model("perangkingan_model");
        $this->load->model("pegawai_model");

        // If POST Request Exist
        if (!empty($this->input->post('checklist_id') && $this->input->post('surat_id'))) {
            $this->db->trans_start();

            // Insert One to _perangkingan_
            $insert_perangkingan = $this->perangkingan_model->insert_one(array(
                "surat_id" => $this->input->post('surat_id'),
                "status_persetujuan" => 2,
                "created_by" => $this->session->userdata('nip'),
                "created_at" => date('Y-m-d H:i:s')
            ));

            if ($insert_perangkingan) {
                // Loop All "Pegawai" Selected
                foreach ($this->input->post('checklist_id') as $selected) {
                    // Get One from _pegawai_
                    $get_pegawai = $this->pegawai_model->get_one([
                        "account_nip" => $selected
                    ])->nilai_rank;

                    // Insert One to _hasilperangkingan_
                    $data = array(
                        "nilai_rank" => $get_pegawai,
                        "pegawai_account_nip" => $selected,
                        "perangkingan_id" => $insert_perangkingan
                    );
                    $this->hasil_model->insert_one($data);
                }
            }
            $this->db->trans_complete();

            // Set Message and Redirect
            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('message_error', 'Gagal mengajukan hasil perankingan!');
                redirect("hasil");
            } else {
                $this->session->set_flashdata('message_success', 'Berhasil mengajukan hasil perankingan!');
                redirect("hasil");
            }
        }else{
            $this->session->set_flashdata('message_error', 'Harap pilih minimal satu pegawai yang diajukan!');
            redirect("hasil");
        }
    }

    public function persetujuan()
    {
        // Auth Check
        $login_jabatan = $this->session->userdata('jabatan');
        if (!(($login_jabatan === 'Kepala Bagian Umum') || ($login_jabatan === 'Kepala Jurusan'))) {
            $this->session->set_flashdata('message_error', 'Anda tidak memiliki akses!');
            redirect("dashboard");
        }

        // Load Model
        $this->load->model('perangkingan_model');
        $this->load->model("surat_model");
        $this->load->model("hasil_model");
        $this->load->model("pegawai_model");
        $this->load->model("notifikasi_model");

        // If POST Request Exist
        if (!empty($this->input->post('aksi') && $this->input->post('perangkingan_id'))) {
            // Get One "Perangkingan"
            $perangkingan_data = $this->perangkingan_model->get_one(array(
                "id" => $this->input->post('perangkingan_id'),
            ));

            // Get One "Surat Undangan"
            $surat_data = $this->surat_model->get_one(array(
                "id" => $perangkingan_data->surat_id,
            ));

            $this->db->trans_start();
            if ($this->input->post('aksi') == "setujui") {
                // Approve "Perangkingan"
                $this->perangkingan_model->update_one($this->input->post('perangkingan_id'), [
                    "status_persetujuan" => 1
                ]);

                // Get All Hasil Perangkingan by Perangkingan ID
                $get_hasil_by_perangkingan_id = $this->hasil_model->get_all_where([
                    "perangkingan_id" => $this->input->post('perangkingan_id')
                ]);
                $accepted_pegawai = [];
                foreach ($get_hasil_by_perangkingan_id as $key => $value) {
                    array_push($accepted_pegawai, $value->pegawai_account_nip);
                }

                // Update Status Surat to 'ready to sent' & Pair Subjek to Surat
                $this->surat_model->update_one($perangkingan_data->surat_id, [
                    "status" => 'ready to send'
                ], $accepted_pegawai);
            } else {
                // Reject "Perangkingan"
                $this->perangkingan_model->update_one($this->input->post('perangkingan_id'), array(
                    "status_persetujuan" => 0
                ));
            }
            $this->db->trans_complete();

            // Set Message and Redirect
            if ($this->db->trans_status()) {
                $this->session->set_flashdata('message_success', 'Berhasil menyetujui perangkingan!');
                redirect("hasil/persetujuan");
            } else {
                $this->session->set_flashdata('message_error', 'Gagal menyetujui perangkingan!');
                redirect("hasil/persetujuan");
            }
        }

        // Get All "Perangkingan"
        $list_perangkingan = $this->perangkingan_model->get_all();

        $list_hasilperangkingan = [];
        $list_surat = [];
        foreach ($list_perangkingan as $key => $value) {
            // Get Pegawai by Each Perangkingan
            $get_hasil_by_perangkingan = $this->hasil_model->get_all_where(array(
                "perangkingan_id" => $value->id
            ));

            foreach ($get_hasil_by_perangkingan as $key2 => $value2) {
                $get_pegawai_by_hasil = $this->pegawai_model->get_one(array(
                    "account_nip" => $value2->pegawai_account_nip
                ));
                $get_hasil_by_perangkingan[$key2] = $get_pegawai_by_hasil;
            }
            $list_hasilperangkingan[$value->id] = $get_hasil_by_perangkingan;

            // Get Surat by Each Perangkingan
            $get_surat_by_perangkingan = $this->surat_model->get_one(array(
                "id" => $value->surat_id
            ));
            $list_surat[$value->id] = $get_surat_by_perangkingan;
        }

        $jabatan = $this->jabatan_model->get_all();

        $list_jabatan = [];
        foreach ($jabatan as $value) {
            $list_jabatan[$value->id] = $value;
        }

        // Load View
        $this->load->view('partials/main-header', [
            "title" => "Persetujuan Perangkingan"
        ]);
        $this->load->view('perangkingan/persetujuan.php', [
            "list_perangkingan" => $list_perangkingan,
            "list_hasilperangkingan" => $list_hasilperangkingan,
            "list_surat" => $list_surat,
            "list_jabatan" => $list_jabatan
        ]);
        $this->load->view('partials/main-footer');
    }
}
