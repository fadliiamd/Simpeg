<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil extends CI_Controller {

	public function index()
	{        
		$this->load->model('pegawai_model');
        
		$pegawai = $this->pegawai_model->get_all_order('nilai_rank', 'desc');
        
		$this->load->view('partials/main-header');
		$this->load->view('perangkingan/hasil-fix',[
            "pegawai" => $pegawai
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
}
