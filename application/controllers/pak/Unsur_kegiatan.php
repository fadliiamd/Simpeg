<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unsur_kegiatan extends Roles
{
    public function __construct()
	{
        parent::__construct(['admin', 'pegawai', 'direktur']);
		$this->load->model([
            'unsur_model',
            'unsur_kegiatan_model'
        ]);
	}

    public function index()
    {
        $unsur = $this->unsur_model->get_all();
        $unsur_kegiatan = $this->unsur_kegiatan_model->get_all();

        $this->load->view('partials/main-header');
		$this->load->view('users/admin/data_unsur_kegiatan', [
            "unsur"=>$unsur,
            "unsur_kegiatan" => $unsur_kegiatan
        ]);
		$this->load->view('partials/main-footer');
    }    

    public function create()
    {        
        $add = $this->unsur_kegiatan_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data pak unsur kegiatan!');
            redirect("pak/unsur_kegiatan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data pak unsur kegiatan!');
            redirect("pak/unsur_kegiatan");
        }
    }
    
    public function update($id)
    {                     
        $update = $this->unsur_kegiatan_model->update_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data pak unsur kegiatan '.$id.'!');
            redirect("pak/unsur_kegiatan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data pak unsur kegiatan '.$id.'!');
            redirect("pak/unsur_kegiatan");
        }
    }
    
    public function delete($id)
    {        
        $this->load->model('unsur_kegiatan_model');        
        $update = $this->unsur_kegiatan_model->delete_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data pak unsur kegiatan '.$id.'!');
            redirect("pak/unsur_kegiatan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data pak unsur kegiatan '.$id.'!');
            redirect("pak/unsur_kegiatan");
        }
    }

}