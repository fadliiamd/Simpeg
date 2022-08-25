<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sertifikat extends Roles
{
    public $nama;

    public function __construct()
    {
        parent::__construct(['admin', 'pegawai']);
    }

    public function index()
    {
        $this->load->model('sertifikat_model');
        $this->load->model('pegawai_model');

        if ($this->session->userdata('role') == 'admin') {
            $sertifikat = $this->sertifikat_model->get_all();
            $pegawai = $this->pegawai_model->get_all();
        } else {
            $sertifikat = $this->sertifikat_model->get_all_where([
                "account_nip" => $this->session->userdata('nip')
            ]);
            $pegawai = array($this->pegawai_model->get_one([
                "account_nip" => $this->session->userdata('nip')
            ]));
        }
        $this->load->model('jenis_sertifikat_model');

        $jenis_sertifikat = $this->jenis_sertifikat_model->get_all();
        $this->load->view('partials/main-header', ['title' => ': Data Sertifikat']);
        $this->load->view('users/admin/data_sertifikat', [
            "jenis_sertifikat" => $jenis_sertifikat,
            "sertifikat" => $sertifikat,
            "pegawai" => $pegawai
        ]);
        $this->load->view('partials/main-footer');
    }

    public function create()
    {
        $this->load->model('sertifikat_model');
        $add = $this->sertifikat_model->insert_one();

        if ($add) {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data sertifikat!');
            redirect("sertifikat");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data sertifikat!');
            redirect("sertifikat");
        }
    }

    public function update()
    {
        $this->load->model('sertifikat_model');
        $id = $this->input->post('serti_id');
        $update = $this->sertifikat_model->update_one($id);

        if ($update) {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data sertifikat');
            redirect("sertifikat");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data sertifikat');
            redirect("sertifikat");
        }
    }

    public function delete()
    {
        $this->load->model('sertifikat_model');
        $id = $this->input->post('serti_id');
        $update = $this->sertifikat_model->delete_one($id);

        if ($update) {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data sertifikat');
            redirect("sertifikat");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data sertifikat');
            redirect("sertifikat");
        }
    }

    public function redirect_back()
    {
    }

    public function verifikasi()
    {
        $this->load->model('sertifikat_model');
        $this->load->model('notifikasi_model');
        $id = $this->input->post('serti_id');
        $aksi = $this->input->post('aksi');

        // Insert Notification
        $create_notif = $this->notifikasi_model->create_notification(array(
            "judul" => "Status Verifikasi Sertifikat #" . $id,
            "pesan" => "Sertifikat dengan id " . $id . " telah ter-" . $aksi,
            "redirect_to" => "sertifikat"
        ));

        // Get Subjek by Surat
        $subjek_data = $this->sertifikat_model->get_all_where([
            "id" => $id
        ]);

        // Pair Notification with Account
        foreach ($subjek_data as $target) {
            $this->notifikasi_model->pair_notification(array(
                "isVerif" => true,
                "account_nip" => $target->account_nip,
                "notifikasi_id" => $create_notif,
                "status" => "Unseen",
                "created_at" => date("Y-m-d h:i:s")
            ));
        }


        if ($aksi == 'verifikasi') {
            $update = $this->sertifikat_model->verify_serti($id, 1);
            if ($update) {
                $this->session->set_flashdata('message_success', 'Behasil memverifikasi sertifikat');
                redirect("sertifikat");
            } else {
                $this->session->set_flashdata('message_error', 'Gagal memverifikasi sertifikat');
                redirect("sertifikat");
            }
        } else if ($aksi == 'tolak') {
            $update = $this->sertifikat_model->verify_serti($id, 2);
            if ($update) {
                $this->session->set_flashdata('message_success', 'Behasil memverifikasi sertifikat');
                redirect("sertifikat");
            } else {
                $this->session->set_flashdata('message_error', 'Gagal memverifikasi sertifikat');
                redirect("sertifikat");
            }
        }
    }
}
