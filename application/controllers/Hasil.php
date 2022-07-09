<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil extends CI_Controller {

	public function index()
	{        
		$this->load->model('pegawai_model');
        $this->load->model('surat_model');
        
		$pegawai = $this->pegawai_model->get_all_order('nilai_rank', 'desc');
        $surat = $this->surat_model->get_all_where(array("jenis" => "undangan"));
        
		$this->load->view('partials/main-header');
		$this->load->view('perangkingan/hasil-fix',[
            "pegawai" => $pegawai,
            "list_surat" => $surat
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

		$this->load->view('partials/main-header');
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
        $this->load->model("hasil_model");
        $this->load->model("perangkingan_model");
        $this->load->model("pegawai_model");
        
        // Get Pegawai yang Dipilih
        if(!empty($this->input->post('checklist_id') && $this->input->post('surat_id'))){
            $this->db->trans_start();
            $insert_perangkingan = $this->perangkingan_model->insert_one(array(
                "surat_id" => $this->input->post('surat_id'),
                "status_persetujuan" => 2,
                "created_by" => $this->session->userdata('nip'),
                "created_at" => date('Y-m-d H:i:s')
            ));
            if($insert_perangkingan) {
                foreach($this->input->post('checklist_id') as $selected) {
                    $get_pegawai = $this->pegawai_model->get_one(array(
                        "account_nip" => $selected
                    ))->nilai_rank;
                    // Insert ke Tabel hasilperangkingan
                    $data = array(
                        "nilai_rank" => $get_pegawai,
                        "pegawai_account_nip" => $selected,
                        "perangkingan_id" => $insert_perangkingan
                    );
                    $this->hasil_model->insert_one($data);
                }
            }
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
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
        $this->load->model('perangkingan_model');

        if(!empty($this->input->post('aksi') && $this->input->post('perangkingan_id'))){
            if($this->input->post('aksi') == "setujui") {
                $change_status = $this->perangkingan_model->update_one($this->input->post('perangkingan_id'), array(
                    "status_persetujuan" => 1
                ));
            } else {
                $change_status = $this->perangkingan_model->update_one($this->input->post('perangkingan_id'), array(
                    "status_persetujuan" => 0
                ));
            }
            
            if($change_status) {
                $this->session->set_flashdata('message_success', 'Berhasil menerapkan aksi hasil perankingan!');
                redirect("hasil/persetujuan");
            } else {
                $this->session->set_flashdata('message_error', 'Gagal menerapkan aksi hasil perankingan!');
                redirect("hasil/persetujuan");
            }
        }
        
		$list_perangkingan = $this->perangkingan_model->get_all();
        
		$this->load->view('partials/main-header');
		$this->load->view('perangkingan/persetujuan.php',[
            "list_perangkingan" => $list_perangkingan
        ]);
		$this->load->view('partials/main-footer');
    }
}
