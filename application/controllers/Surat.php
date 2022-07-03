<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {

	public function index()
	{
		$this->load->view('partials/main-header');
		$this->load->view('surat/surat');
		$this->load->view('partials/main-footer');
	}
}
