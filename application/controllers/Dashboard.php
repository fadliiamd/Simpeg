<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Authentication
{
	public function __construct()
	{
		parent::__construct();
	}

	public function admin()
	{
		$nip = $this->session->userdata('nip');
		$this->load->model('account_model');
		if ($this->account_model->get_role($nip) == 'admin') {
			$this->load->view('partials/main-header');
			$this->load->view('users/admin/index');
			$this->load->view('partials/main-footer');
		}else{
			redirect('errors/show_403');
		}
	}

	public function pegawai()
	{
		$nip = $this->session->userdata('nip');
		$this->load->model('account_model');
		if ($this->account_model->get_role($nip) == 'pegawai') {
			$this->load->view('partials/main-header');
			$this->load->view('users/pegawai/index');
			$this->load->view('partials/main-footer');
		}else{
			redirect('errors/show_403');
		}
	}

	public function direktur()
	{
		$nip = $this->session->userdata('nip');
		$this->load->model('account_model');
		if ($this->account_model->get_role($nip) == 'direktur') {
			$this->load->view('partials/main-header');
			$this->load->view('users/direktur/index');
			$this->load->view('partials/main-footer');
		}else{
			redirect('errors/show_403');
		}
	}

	public function index()
	{
		$nip = $this->session->userdata('nip');

		$this->load->model('account_model');
		$this->account_model->get_redirect_role($nip);
	}
}
