<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dupak extends Roles {

	public function __construct()
	{
		parent::__construct(['admin', 'pegawai']);
	}

    public function pemberkasan()
    {
        $this->load->view('partials/main-header');
		$this->load->view('dupak/pemberkasan');
		$this->load->view('partials/main-footer');
    }

    public function hasil_diklat()
    {
        $this->load->view('partials/main-header');
		$this->load->view('dupak/hasil_diklat');
		$this->load->view('partials/main-footer');
    }
    
    public function riwayat_kinerja()
    {
        $this->load->view('partials/main-header');
		$this->load->view('dupak/riwayat');
		$this->load->view('partials/main-footer');
    }

}