<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Admin {

	public function __construct()
	{
		parent::__construct();
	}

    public function data_pegawai()
    {
        $this->load->view('partials/main-header');
		$this->load->view('users/admin/data_pegawai');
		$this->load->view('partials/main-footer');
    }
}