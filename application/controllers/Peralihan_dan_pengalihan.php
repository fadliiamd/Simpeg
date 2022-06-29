<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peralihan_dan_pengalihan extends Admin {

	public function __construct()
	{
		parent::__construct();
	}

	public function pengajuan_mutasi()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/pengajuan_mutasi');
		$this->load->view('partials/main-footer');
	}

	public function berkas_persyaratan()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/berkas_persyaratan');
		$this->load->view('partials/main-footer');
	}

	public function usulan_mutasi()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/usulan_mutasi');
		$this->load->view('partials/main-footer');
	}
}