<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function index()
	{
		$this->load->view('partials/main-header');
		$this->load->view('index');
		$this->load->view('partials/main-footer');
	}
}
