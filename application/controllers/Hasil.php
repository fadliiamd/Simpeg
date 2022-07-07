<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil extends CI_Controller {

	public function index()
	{
		$this->load->view('partials/main-header');
		$this->load->view('perangkingan/hasil-fix');
		$this->load->view('partials/main-footer');
	}

	public function perhitungan()
	{
        $this->load->model("kriteria_model");
        $this->load->model("pegawai_model");

        $kriteria = $this->kriteria_model->get_all();
        $pegawai = $this->pegawai_model->get_all();


		$this->load->view('partials/main-header');
		$this->load->view('perangkingan/alternatif',[
            "kriteria" => $kriteria,
            "pegawai" => $pegawai,
        ]);
		$this->load->view('partials/main-footer');
	}
}
