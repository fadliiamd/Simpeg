<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends Admin {

	public function __construct()
	{
		parent::__construct();
	}

	/*===========
		PEGAWAI
	=============*/
    public function data_pegawai()
    {
		$this->load->model('jurusan_model');
		$this->load->model('bagian_model');
		$this->load->model('unit_model');
		$this->load->model('golpang_model');
		$this->load->model('pegawai_model');

        $golpang = $this->golpang_model->get_all();
        $jurusan = $this->jurusan_model->get_all();
        $bagian = $this->bagian_model->get_all();
        $unit = $this->unit_model->get_all();
		$pegawai = $this->pegawai_model->get_all_with_join();
	
        $this->load->view('partials/main-header');
		$this->load->view('users/admin/data_pegawai', [
			"jurusan" => $jurusan,
			"bagian" => $bagian,
			"unit" => $unit,
			"golpang" => $golpang,
			"pegawai" => $pegawai
		]);
		$this->load->view('partials/main-footer');
    }
    
	public function create_data_pegawai()
    {
		$this->load->model('pegawai_model');
        $add = $this->pegawai_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data pegawai!');
            redirect("account/data_pegawai");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data pegawai!');
            redirect("account/data_pegawai");
        }
    }

	/*===========
		DIREKTUR
	=============*/
}