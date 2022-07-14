<?php

class Notifikasi extends CI_Controller  {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // Load Model
        $this->load->model("notifikasi_model");

        // Get All Notifikasi by This Session
        $get_notifikasi = $this->notifikasi_model->get_all_where([
            "account_nip" => $this->session->userdata('nip')
        ]);

        // Load View
        $this->load->view('partials/main-header');
		$this->load->view('notifikasi', [
            "list_notifikasi" => $get_notifikasi
        ]);
		$this->load->view('partials/main-footer');
    }

    public function hook($limit = 4) {
        // Load Model
        $this->load->model("notifikasi_model");

        // Get All Data Where NIP = Session NIP
        $get_data = $this->notifikasi_model->get_all_where([
            "account_nip" => $this->session->userdata('nip')
        ], $limit);

        echo json_encode($get_data);
    }

    public function change_status() {
        // Load Model
        $this->load->model("notifikasi_model");
        header("Content-Type: application/json");

        // POST Request
        $account_nip = $this->input->post("account_nip");
        $notif_id = $this->input->post("notifikasi_id");

        // Get Data
        $get_notif = $this->notifikasi_model->get_one_second([
            "account_nip" => $account_nip,
            "notifikasi_id" => $notif_id
        ]);

        if($get_notif->status == 'Unseen') {
            // Change Read Status
            $change = $this->notifikasi_model->change_status($account_nip, $notif_id, [
                "status" => "Seen"
            ]);

            if($change == true) {
                $this->session->set_flashdata('message_success', 'Berhasil mengubah status notifikasi!');
                redirect("notifikasi");
            } else {
                $this->session->set_flashdata('message_error', 'Gagal mengubah status notifikasi!');
                redirect("notifikasi");
            }
        } else {
            $this->session->set_flashdata('message_error', 'Gagal mengubah status notifikasi!');
            redirect("notifikasi");
        }
    }
}