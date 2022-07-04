<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends Roles {
    public $nama;

	public function __construct()
	{
		parent::__construct(['admin']);
	}

    public function index()
    {
        $this->load->model('kriteria_model');

        $kriteria = $this->kriteria_model->get_all();

        $this->load->view('partials/main-header');
		$this->load->view('users/admin/data_kriteria', ["kriteria"=>$kriteria]);
		$this->load->view('partials/main-footer');
    }
  
    public function create()
    {
        $this->load->model('kriteria_model');
        $add = $this->kriteria_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data kriteria!');
            redirect("kriteria");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data kriteria!');
            redirect("kriteria");
        }
    }
    
    public function update()
    {        
        $this->load->model('kriteria_model');
        $id = $this->input->post('id_kriteria');
        $update = $this->kriteria_model->update_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data kriteria C-'.$id.'!');
            redirect("kriteria");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data kriteria C-'.$id.'!');
            redirect("kriteria");
        }
    }
    
    public function delete()
    {        
        $this->load->model('kriteria_model');
        $id = $this->input->post('id_kriteria');
        $update = $this->kriteria_model->delete_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data kriteria C-'.$id.'!');
            redirect("kriteria");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data kriteria C-'.$id.'!');
            redirect("kriteria");
        }
    }
}