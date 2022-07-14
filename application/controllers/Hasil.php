<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{        
		$this->load->model('pegawai_model');
        $this->load->model('surat_model');
        $this->load->model('jabatan_model');

		$pegawai = $this->pegawai_model->get_all_order('nilai_rank', 'desc');
        $surat = $this->surat_model->get_all_where(array("jenis" => "undangan"));
        $jabatan = $this->jabatan_model->get_all();

        $list_jabatan = [];
        foreach($jabatan as $value) {
            $list_jabatan[$value->id] = $value; 
        }
        
		$this->load->view('partials/main-header', [
            "title" => "Hasil Perangkingan"
        ]);
		$this->load->view('perangkingan/hasil-fix', [
            "pegawai" => $pegawai,
            "list_surat" => $surat,
            "list_jabatan" => $list_jabatan
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
        $pegawai = $this->pegawai_model->get_all();

		$this->load->view('partials/main-header', [
            "title" => "Perhitungan Perangkingan"
        ]);
		$this->load->view('perangkingan/alternatif',[
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
        if(!empty($this->input->post('checklist_id') && $this->input->post('surat_id'))){
            $this->db->trans_start();

            // Insert One to _perangkingan_
            $insert_perangkingan = $this->perangkingan_model->insert_one(array(
                "surat_id" => $this->input->post('surat_id'),
                "status_persetujuan" => 2,
                "created_by" => $this->session->userdata('nip'),
                "created_at" => date('Y-m-d H:i:s')
            ));

            if($insert_perangkingan) {
                // Loop All "Pegawai" Selected
                foreach($this->input->post('checklist_id') as $selected) {
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
            if($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('message_error', 'Gagal mengajukan hasil perankingan!');
                redirect("hasil");
            } else {
                $this->session->set_flashdata('message_success', 'Berhasil mengajukan hasil perankingan!');
                redirect("hasil");
            }
        }
    }

    public function persetujuan()
    {
        // Load Model
        $this->load->model('perangkingan_model');
        $this->load->model("surat_model");
        $this->load->model("hasil_model");
        $this->load->model("pegawai_model");
        $this->load->model("notifikasi_model");
        $this->load->helper('string');

        // If POST Request Exist
        if(!empty($this->input->post('aksi') && $this->input->post('perangkingan_id'))){
            // Get One "Perangkingan"
            $perangkingan_data = $this->perangkingan_model->get_one(array(
                "id" => $this->input->post('perangkingan_id'),
            ));

            // Get One "Surat Undangan"
            $surat_data = $this->surat_model->get_one(array(
                "id" => $perangkingan_data->surat_id,
            ));

            $jenis_diklat = "";
            if($surat_data->jenis_kegiatan == 'diklat') {
                $jenis_diklat = $surat_data->jenis_diklat;
            }

            $this->db->trans_start();
            if($this->input->post('aksi') == "setujui") {
                // Approve "Perangkingan"
                $this->perangkingan_model->update_one($this->input->post('perangkingan_id'), array(
                    "status_persetujuan" => 1
                ));

                // Create "Surat Tugas"
                $get_hasil_by_perangkingan_id = $this->hasil_model->get_all_where(array(
                    "perangkingan_id" => $this->input->post('perangkingan_id')
                ));
                $accepted_pegawai = array();
                foreach($get_hasil_by_perangkingan_id as $key => $value) {
                    array_push($accepted_pegawai, $value->pegawai_account_nip);
                }
                $this->surat_model->insert_one(array(
                    "no" => random_string('numeric', 4). '/' .strtoupper(random_string('alnum', 4)). '/' . strtoupper($surat_data->jenis_kegiatan) . '/2022',
                    "jenis_tujuan" => "perorangan",
                    "tujuan" => "",
                    "detail_tujuan" => implode(',', $accepted_pegawai),
                    "tgl_upload" => date("Y-m-d h:i:s"),
                    "jenis" => "tugas",
                    "jenis_kegiatan" => $surat_data->jenis_kegiatan,
                    "jenis_diklat" => $jenis_diklat,
                    "tema" => $surat_data->tema,
                    "admin_nip" => $surat_data->admin_nip,
                    "file_name" => $surat_data->file_name,
                ));

                $create_notif = $this->notifikasi_model->create_notification(array(
                    "judul" => "Undangan ".ucwords($surat_data->jenis_kegiatan),
                    "pesan" => "Anda mendapatkan undangan kegiatan ".ucwords($surat_data->jenis_kegiatan).". Silahkan segera melakukan proses pemberkasan pada laman kegiatan ".$surat_data->jenis_kegiatan,
                    "redirect_to" => "diklat"
                ));

                foreach($accepted_pegawai as $target) {
                    $this->notifikasi_model->pair_notification(array(
                        "account_nip" => $target,
                        "notifikasi_id" => $create_notif,
                        "status" => "Unseen",
                        "created_at" => date("Y-m-d h:i:s")
                    ));
                }
            } else {
                // Reject "Perangkingan"
                $this->perangkingan_model->update_one($this->input->post('perangkingan_id'), array(
                    "status_persetujuan" => 0
                ));
            }
            $this->db->trans_complete();
            
            // Set Message and Redirect
            if($this->db->trans_status()) {
                $this->session->set_flashdata('message_success', 'Berhasil menyetujui perangkingan!');
                redirect("hasil/persetujuan");
            } else {
                $this->session->set_flashdata('message_error', 'Gagal menyetujui perangkingan!');
                redirect("hasil/persetujuan");
            }
        }
        
        // Get All "Perangkingan"
		$list_perangkingan = $this->perangkingan_model->get_all();

        $list_hasilperangkingan = array();
        $list_surat = array();
        foreach($list_perangkingan as $key => $value) {
            // Get Pegawai by Each Perangkingan
            $get_hasil_by_perangkingan = $this->hasil_model->get_all_where(array(
                "perangkingan_id" => $value->id
            ));

            foreach($get_hasil_by_perangkingan as $key2 => $value2) {
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
        
        // Load View
		$this->load->view('partials/main-header', [
            "title" => "Persetujuan Perangkingan"
        ]);
		$this->load->view('perangkingan/persetujuan.php', [
            "list_perangkingan" => $list_perangkingan,
            "list_hasilperangkingan" => $list_hasilperangkingan,
            "list_surat" => $list_surat
        ]);
		$this->load->view('partials/main-footer');
    }
}