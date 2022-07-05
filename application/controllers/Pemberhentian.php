<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemberhentian extends Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['mutasi_model','pegawai_model']);
	}

    public function riwayat_pemberhentian()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/daftar_pemberhentian');
		$this->load->view('partials/main-footer');
	}

	public function pengajuan_pemberhentian()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/pengajuan_pemberhentian');
		$this->load->view('partials/main-footer');
	}

	public function berkas_pemberhentian()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/berkas_pemberhentian');
		$this->load->view('partials/main-footer');
	}

	public function usulan_pensiun()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/usulan_pensiun');
		$this->load->view('partials/main-footer');
	}

	public function sk_pensiun()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/sk_pensiun');
		$this->load->view('partials/main-footer');
	}
}