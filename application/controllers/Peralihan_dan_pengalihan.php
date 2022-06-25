<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peralihan_dan_pengalihan extends CI_Controller {
	public function pengajuan_mutasi()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/pengajuan_mutasi');
		$this->load->view('partials/main-footer');
	}
}
