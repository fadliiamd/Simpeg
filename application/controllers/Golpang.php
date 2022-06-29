<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Golpang extends Admin {
    public $nama;

	public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
        $this->load->model('golpang_model');

        $golpang = $this->golpang_model->get_all();

        $this->load->view('partials/main-header');
		$this->load->view('users/admin/data_golpang', ["golpang"=>$golpang]);
		$this->load->view('partials/main-footer');
    }

    public function create()
    {
        $this->load->model('golpang_model');
        $add = $this->golpang_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data golongan dan pangkat!');
            redirect("golpang");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data golongan dan pangkat!');
            redirect("golpang");
        }
    }
    
    public function update()
    {        
        $this->load->model('golpang_model');
        $id = $this->input->post('id_golpang');
        $update = $this->golpang_model->update_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data golongan '.$id.'!');
            redirect("golpang");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data golongan '.$id.'!');
            redirect("golpang");
        }
    }
    
    public function delete()
    {        
        $this->load->model('golpang_model');
        $id = $this->input->post('id_golpang');
        $update = $this->golpang_model->delete_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data golongan '.$id.'!');
            redirect("golpang");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data golongan '.$id.'!');
            redirect("golpang");
        }
    }

    public function redirect_back()
    {
        
    }
}