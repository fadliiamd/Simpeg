<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function login()
	{
		$this->load->view('pages/samples/login');
	}

    public function register()
	{
		$this->load->view('pages/samples/register');
	}
}
