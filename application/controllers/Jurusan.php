<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends Admin {
    public $nama;

	public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
        $this->load->model('jurusan_model');

        $jurusan = $this->jurusan_model->get_all();

        $this->load->view('partials/main-header');
		$this->load->view('users/admin/data_jurusan', ["jurusan"=>$jurusan]);
		$this->load->view('partials/main-footer');
    }

    public function create()
    {
        $this->load->model('jurusan_model');
        $add = $this->jurusan_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data jurusan!');
            redirect("jurusan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data jurusan!');
            redirect("jurusan");
        }
    }
    
    public function update()
    {        
        $this->load->model('jurusan_model');
        $id = $this->input->post('id_jurusan');
        $update = $this->jurusan_model->update_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data jurusan J-'.$id.'!');
            redirect("jurusan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data jurusan J-'.$id.'!');
            redirect("jurusan");
        }
    }
    
    public function delete()
    {        
        $this->load->model('jurusan_model');
        $id = $this->input->post('id_jurusan');
        $update = $this->jurusan_model->delete_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data jurusan J-'.$id.'!');
            redirect("jurusan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data jurusan J-'.$id.'!');
            redirect("jurusan");
        }
    }

    public function redirect_back()
    {
        
    }
}