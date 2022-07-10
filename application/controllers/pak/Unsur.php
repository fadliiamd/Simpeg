<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unsur extends Roles
{
    public function __construct()
	{
        parent::__construct(['admin', 'pegawai', 'direktur']);
		$this->load->model([
            'unsur_model',
        ]);
	}

    public function index()
    {
        $unsur = $this->unsur_model->get_all();

        $this->load->view('partials/main-header');
		$this->load->view('users/admin/data_unsur', [
            "unsur"=>$unsur
        ]);
		$this->load->view('partials/main-footer');
    }    

    public function create()
    {
        $this->load->model('unsur_model');
        $add = $this->unsur_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data pak/unsur!');
            redirect("pak/unsur");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data pak/unsur!');
            redirect("pak/unsur");
        }
    }
    
    public function update($id)
    {        
        $this->load->model('unsur_model');        
        $update = $this->unsur_model->update_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data pak/unsur '.$id.'!');
            redirect("pak/unsur");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data pak/unsur '.$id.'!');
            redirect("pak/unsur");
        }
    }
    
    public function delete($id)
    {        
        $this->load->model('unsur_model');        
        $update = $this->unsur_model->delete_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data pak/unsur '.$id.'!');
            redirect("pak/unsur");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data pak/unsur '.$id.'!');
            redirect("pak/unsur");
        }
    }

}