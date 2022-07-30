<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keahlian extends Admin {
    public $nama;

	public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
        $this->load->model('keahlian_model');

        $bidang_keahlian = $this->keahlian_model->get_all();

        $this->load->view('partials/main-header', ["title" => ": Bidang Keahlian"]);
		$this->load->view('users/admin/data_bidang_keahlian', ["bidang_keahlian"=>$bidang_keahlian]);
		$this->load->view('partials/main-footer');
    }

    public function create()
    {
        $this->load->model('keahlian_model');
        $add = $this->keahlian_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data jurusan!');
            redirect("keahlian");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data jurusan!');
            redirect("keahlian");
        }
    }
    
    public function update()
    {        
        $this->load->model('keahlian_model');
        $id = $this->input->post('keahlian_id');
        $update = $this->keahlian_model->update_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data jurusan BK-'.$id.'!');
            redirect("keahlian");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data jurusan BK-'.$id.'!');
            redirect("keahlian");
        }
    }
    
    public function delete()
    {        
        $this->load->model('keahlian_model');
        $id = $this->input->post('keahlian_id');
        $update = $this->keahlian_model->delete_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data jurusan BK-'.$id.'!');
            redirect("keahlian");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data jurusan BK-'.$id.'!');
            redirect("keahlian");
        }
    }
}