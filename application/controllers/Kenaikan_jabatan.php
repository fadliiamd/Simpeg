<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kenaikan_jabatan extends Roles {

	public function __construct()
	{
		parent::__construct(['admin', 'pegawai']);
	}

    public function pengajuan_kenaikan()
    {
        $this->load->view('partials/main-header');
		$this->load->view('kenaikan_jabatan/pengajuan');
		$this->load->view('partials/main-footer');
    }

    public function progress()
    {
        $this->load->view('partials/main-header');
		$this->load->view('kenaikan_jabatan/progress');
		$this->load->view('partials/main-footer');
    }

}