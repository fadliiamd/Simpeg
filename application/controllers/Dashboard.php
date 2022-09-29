<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Authentication
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			'account_model',
			'pegawai_model',
			'diklat_model',
			'bimtek_model',
			'prajabatan_model',
			'mutasi_model',
			'penerimaan_mutasi_model',
			'pemberhentian_model',
			'rekap_nilai_model',
			'notifikasi_model',
			'sk_mutasi_model'
		]);
	}

	public function mutasi(){		
		$data = $this->sk_mutasi_model->get_one_with_join();
		// var_dump($data);die();
		$this->load->view('users/pegawai/mutasi', ['title' => ': Dashboard Pegawai Mutasi', 'mutasi' => $data]);		
	}

	public function admin()
	{
		$get_notifikasi = $this->notifikasi_model->get_all_where([
			"account_nip" => $this->session->userdata('nip')
		]);

		$nip = $this->session->userdata('nip');
		if ($_SESSION['role'] == 'admin') {
			$data['total_pengguna'] = $this->account_model->get_num_rows();		

			$data['total_kegiatan']	= $this->diklat_model->get_num_rows();
			$data['total_kegiatan']	+= $this->bimtek_model->get_num_rows();			
			$data['total_kegiatan']	+= $this->prajabatan_model->get_num_rows();			

			$data['total_mutasi'] = $this->mutasi_model->get_num_rows();
			$data['total_mutasi'] += $this->penerimaan_mutasi_model->get_num_rows();

			$data['total_pemberhentian'] = $this->pemberhentian_model->get_num_rows();			
			$data['list_notifikasi'] = $get_notifikasi;

			$this->load->view('partials/main-header', ['title' => ': Dashboard']);
			$this->load->view('users/admin/index', $data);
			$this->load->view('partials/main-footer');
		}else{
			redirect('errors/show_403');
		}
	}

	public function pegawai()
	{
		// Get All Notifikasi by This Session
		$get_notifikasi = $this->notifikasi_model->get_all_where([
				"account_nip" => $this->session->userdata('nip')
		]);

		$nip = $this->session->userdata('nip');
		$this->load->model('account_model');
		if ($_SESSION['role'] == 'pegawai') {		
			$data['total_diklat']	= $this->diklat_model->get_num_rows_by(array('pegawai_nip' => $_SESSION['nip']));
			$data['total_bimtek']	= $this->bimtek_model->get_num_rows_by(array('pegawai_nip' => $_SESSION['nip']));			
			$data['total_prajabatan']	= $this->prajabatan_model->get_num_rows_by(array('pegawai_nip' => $_SESSION['nip']));			
			$data['akk_terakhir'] = $this->rekap_nilai_model->get_akk_terakhir(array('account_nip' => $_SESSION['nip']));
			$data['list_notifikasi'] = $get_notifikasi;

			$this->load->view('partials/main-header', ['title' => ': Dashboard']);
			$this->load->view('users/pegawai/index', $data);
			$this->load->view('partials/main-footer');
		}else{
			redirect('errors/show_403');
		}
	}

	public function direktur()
	{
		$get_notifikasi = $this->notifikasi_model->get_all_where([
			"account_nip" => $this->session->userdata('nip')
		]);

		$nip = $this->session->userdata('nip');
		$this->load->model('account_model');
		if ($_SESSION['role'] == 'direktur') {
			$data['total_pegawai'] = $this->pegawai_model->get_num_rows();		

			$data['total_kegiatan']	= $this->diklat_model->get_num_rows();
			$data['total_kegiatan']	+= $this->bimtek_model->get_num_rows();			
			$data['total_kegiatan']	+= $this->prajabatan_model->get_num_rows();			

			$data['total_mutasi'] = $this->mutasi_model->get_num_rows();
			$data['total_mutasi'] += $this->penerimaan_mutasi_model->get_num_rows();

			$data['total_pemberhentian'] = $this->pemberhentian_model->get_num_rows();
			$data['list_notifikasi'] = $get_notifikasi;

			$this->load->view('partials/main-header', ['title' => ': Dashboard']);
			$this->load->view('users/direktur/index', $data);
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
