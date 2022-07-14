<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Authentication
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('account_model');
	}

	public function admin()
	{
		$nip = $this->session->userdata('nip');
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
		if ($this->account_model->get_role($nip) == 'pegawai') {
			$this->load->model('pegawai_model');
			$get_detail = $this->pegawai_model->get_one([
				"account_nip" => $nip
			]);

			$this->load->view('partials/main-header', [
				"detail_account" => $get_detail
			]);
			$this->load->view('users/pegawai/index');
			$this->load->view('partials/main-footer');
		}else{
			redirect('errors/show_403');
		}
	}

	public function direktur()
	{
		$nip = $this->session->userdata('nip');
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

		$this->account_model->get_redirect_role($nip);
	}
}
