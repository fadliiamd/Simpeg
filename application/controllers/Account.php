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
	
	public function update_data_pegawai()
    {
		$this->load->model('pegawai_model');
        $delete = $this->pegawai_model->update_one($this->input->post('nip_old'));

        if($delete)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data pegawai!');
            redirect("account/data_pegawai");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data pegawai!');
            redirect("account/data_pegawai");
        }
    }
	
	public function delete_data_pegawai()
    {
		$this->load->model('pegawai_model');
        $delete = $this->pegawai_model->delete_one($this->input->post('nip'));

        if($delete)
        {
            $this->session->set_flashdata('message_success', 'Berhasil menghapus data pegawai!');
            redirect("account/data_pegawai");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data pegawai!');
            redirect("account/data_pegawai");
        }
    }

	/*===========
		DIREKTUR
	=============*/
	public function data_direktur()
    {
		$this->load->model('jurusan_model');
		$this->load->model('bagian_model');
		$this->load->model('unit_model');
		$this->load->model('golpang_model');
		$this->load->model('direktur_model');

        $golpang = $this->golpang_model->get_all();
        $jurusan = $this->jurusan_model->get_all();
        $bagian = $this->bagian_model->get_all();
        $unit = $this->unit_model->get_all();
		$direktur = $this->direktur_model->get_all();
	
        $this->load->view('partials/main-header');
		$this->load->view('users/admin/data_direktur', [
			"jurusan" => $jurusan,
			"bagian" => $bagian,
			"unit" => $unit,
			"golpang" => $golpang,
			"direktur" => $direktur
		]);
		$this->load->view('partials/main-footer');
    }
    
	public function create_data_direktur()
    {
		$this->load->model('direktur_model');
        $add = $this->direktur_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data direktur!');
            redirect("account/data_direktur");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data direktur!');
            redirect("account/data_direktur");
        }
    }
	
	public function update_data_direktur()
    {
		$this->load->model('direktur_model');
        $delete = $this->direktur_model->update_one($this->input->post('nip_old'));

        if($delete)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data direktur!');
            redirect("account/data_direktur");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data direktur!');
            redirect("account/data_direktur");
        }
    }
	
	public function delete_data_direktur()
    {
		$this->load->model('direktur_model');
        $delete = $this->direktur_model->delete_one($this->input->post('nip'));

        if($delete)
        {
            $this->session->set_flashdata('message_success', 'Berhasil menghapus data direktur!');
            redirect("account/data_direktur");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data direktur!');
            redirect("account/data_direktur");
        }
    }
}