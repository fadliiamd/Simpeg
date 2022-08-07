<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends Admin {
    public $nama;

	public function __construct()
	{
		parent::__construct();
        $this->load->model([
            'jabatan_model'
        ]);
	}

    public function index()
    {        
        $jabatan = $this->jabatan_model->get_all();

        $this->load->view('partials/main-header', ["title" => " : Data Jabatan"]);
		$this->load->view('users/admin/data_jabatan', [
            "jabatan" => $jabatan
        ]);
		$this->load->view('partials/main-footer');
    }

    public function create()
    {
        $this->load->model('jabatan_model');
        $add = $this->jabatan_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data jabatan!');
            redirect("jabatan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data jabatan!');
            redirect("jabatan");
        }
    }
    
    public function update($id)
    {        
        $this->load->model('jabatan_model');        
        $update = $this->jabatan_model->update_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data jabatan '.$id.'!');
            redirect("jabatan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data jabatan '.$id.'!');
            redirect("jabatan");
        }
    }
    
    public function delete($id)
    {        
        $this->load->model('jabatan_model');        
        $update = $this->jabatan_model->delete_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data jabatan '.$id.'!');
            redirect("jabatan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data jabatan '.$id.'!');
            redirect("jabatan");
        }
    }
}