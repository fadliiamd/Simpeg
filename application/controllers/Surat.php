<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {

	public function index()
	{
		$this->load->view('partials/main-header');
		$this->load->view('surat/list');
		$this->load->view('partials/main-footer');
	}

	public function add()
	{
		$this->load->view('partials/main-header');
		$this->load->view('surat/add');
		$this->load->view('partials/main-footer');
	}

	public function edit()
	{
		$this->load->view('partials/main-header');
		$this->load->view('surat/edit');
		$this->load->view('partials/main-footer');
	}
}
