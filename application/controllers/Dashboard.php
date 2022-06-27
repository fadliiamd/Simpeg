<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function admin() {
		$this->load->view('partials/main-header');
		$this->load->view('users/admin/index');
		$this->load->view('partials/main-footer');
	}

	public function pegawai() {
		$this->load->view('partials/main-header');
		$this->load->view('users/pegawai/index');
		$this->load->view('partials/main-footer');
	}
	
	public function direktur() {
		$this->load->view('partials/main-header');
		$this->load->view('users/direktur/index');
		$this->load->view('partials/main-footer');
	}

	public function index()
	{
		$nip = $this->session->userdata('nip');
		
		$this->load->model('account');
		$this->account->get_redirect_role($nip);

	}
}
