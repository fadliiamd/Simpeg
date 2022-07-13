<?php

class Notifikasi extends CI_Controller  {
    public function __construct() {
        parent::__construct();
    }

    public function hook($limit = 4) {
        // Load Model
        $this->load->model("notifikasi_model");

        // Get All Data Where NIP = Session NIP
        $get_data = $this->notifikasi_model->get_all_where(array(
            "account_nip" => $this->session->userdata('nip')
        ), $limit);

        echo json_encode($get_data);
    }
}