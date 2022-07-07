<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subkriteria extends Roles {
    public $nama;

	public function __construct()
	{
		parent::__construct(['admin']);
	}

    public function index()
    {
        $this->load->model('subkriteria_model');
        $this->load->model('kriteria_model');

        $kriteria = $this->kriteria_model->get_all();
        $subkriteria = $this->subkriteria_model->get_all();

        $this->load->view('partials/main-header');
		$this->load->view('users/admin/data_subkriteria', [
            "subkriteria"=>$subkriteria, 
            "kriteria" => $kriteria
        ]);
		$this->load->view('partials/main-footer');
    }

    public function create()
    {
        $this->load->model('subkriteria_model');
        $add = $this->subkriteria_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data subkriteria!');
            redirect("subkriteria");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data subkriteria!');
            redirect("subkriteria");
        }
    }
    
    public function update()
    {         
        $this->load->model('subkriteria_model');
        $id = $this->input->post('sub_id');
        $update = $this->subkriteria_model->update_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data subkriteria C-'.$id.'!');
            redirect("subkriteria");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data subkriteria C-'.$id.'!');
            redirect("subkriteria");
        }
    }
    
    public function delete()
    {        
        $this->load->model('subkriteria_model');
        $id = $this->input->post('sub_id');
        $update = $this->subkriteria_model->delete_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data subkriteria C-'.$id.'!');
            redirect("subkriteria");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data subkriteria C-'.$id.'!');
            redirect("subkriteria");
        }
    }
}