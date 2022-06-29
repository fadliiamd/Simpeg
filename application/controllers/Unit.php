<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends Admin {
    public $nama;

	public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
        $this->load->model('unit_model');

        $unit = $this->unit_model->get_all();

        $this->load->view('partials/main-header');
		$this->load->view('users/admin/data_unit', ["unit"=>$unit]);
		$this->load->view('partials/main-footer');
    }

    public function create()
    {
        $this->load->model('unit_model');
        $add = $this->unit_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data unit!');
            redirect("unit");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data unit!');
            redirect("unit");
        }
    }
    
    public function update()
    {        
        $this->load->model('unit_model');
        $id = $this->input->post('id_unit');
        $update = $this->unit_model->update_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data unit U-'.$id.'!');
            redirect("unit");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data unit U-'.$id.'!');
            redirect("unit");
        }
    }
    
    public function delete()
    {        
        $this->load->model('unit_model');
        $id = $this->input->post('id_unit');
        $update = $this->unit_model->delete_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data unit U-'.$id.'!');
            redirect("unit");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data unit U-'.$id.'!');
            redirect("unit");
        }
    }

    public function redirect_back()
    {
        
    }
}