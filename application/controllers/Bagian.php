<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bagian extends Admin {
    public $nama;

	public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
        $this->load->model('bagian_model');

        $bagian = $this->bagian_model->get_all();

        $this->load->view('partials/main-header');
		$this->load->view('users/admin/data_bagian', ["bagian"=>$bagian]);
		$this->load->view('partials/main-footer');
    }

    public function create()
    {
        $this->load->model('bagian_model');
        $add = $this->bagian_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data bagian!');
            redirect("bagian");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data bagian!');
            redirect("bagian");
        }
    }
    
    public function update()
    {        
        $this->load->model('bagian_model');
        $id = $this->input->post('id_bagian');
        $update = $this->bagian_model->update_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data bagian B-'.$id.'!');
            redirect("bagian");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data bagian B-'.$id.'!');
            redirect("bagian");
        }
    }
    
    public function delete()
    {        
        $this->load->model('bagian_model');
        $id = $this->input->post('id_bagian');
        $update = $this->bagian_model->delete_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data bagian B-'.$id.'!');
            redirect("bagian");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data bagian B-'.$id.'!');
            redirect("bagian");
        }
    }

    public function redirect_back()
    {
        
    }
}