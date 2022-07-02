<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perangkingan extends CI_Controller {

	public function index()
	{
		$this->load->view('partials/main-header');
		$this->load->view('perangkingan/list');
		$this->load->view('partials/main-footer');
	}
}
