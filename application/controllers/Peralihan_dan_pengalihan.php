<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peralihan_dan_pengalihan extends Roles {

	public function __construct()
	{
		parent::__construct(['admin', 'pegawai']);
	}

	public function pengajuan_mutasi()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/pengajuan_mutasi');
		$this->load->view('partials/main-footer');
	}

	public function berkas_mutasi()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/berkas_mutasi');
		$this->load->view('partials/main-footer');
	}

	public function usulan_mutasi()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/usulan_mutasi');
		$this->load->view('partials/main-footer');
	}

	public function penerimaan_mutasi()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/penerimaan_mutasi');
		$this->load->view('partials/main-footer');
	}

	public function sk_mutasi()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/sk_mutasi');
		$this->load->view('partials/main-footer');
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