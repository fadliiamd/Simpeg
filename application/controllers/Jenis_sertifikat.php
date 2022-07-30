<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_sertifikat extends Admin {
    public $nama;

	public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
        $this->load->model('jenis_sertifikat_model');

        $jenis_sertifikat = $this->jenis_sertifikat_model->get_all();

        $this->load->view('partials/main-header', ["title" => ": Data Jenis Sertifikat"]);
		$this->load->view('users/admin/data_jenis_sertifikat', ["jenis_sertifikat"=>$jenis_sertifikat]);
		$this->load->view('partials/main-footer');
    }

    public function create()
    {
        $this->load->model('jenis_sertifikat_model');
        $add = $this->jenis_sertifikat_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data jenis_sertifikat!');
            redirect("jenis_sertifikat");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data jenis_sertifikat!');
            redirect("jenis_sertifikat");
        }
    }
    
    public function update()
    {        
        $this->load->model('jenis_sertifikat_model');
        $id = $this->input->post('id_jenis_sertifikat');
        $update = $this->jenis_sertifikat_model->update_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data jenis_sertifikat '.$id.'!');
            redirect("jenis_sertifikat");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data jenis_sertifikat '.$id.'!');
            redirect("jenis_sertifikat");
        }
    }
    
    public function delete()
    {        
        $this->load->model('jenis_sertifikat_model');
        $id = $this->input->post('id_jenis_sertifikat');
        $update = $this->jenis_sertifikat_model->delete_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data jenis_sertifikat '.$id.'!');
            redirect("jenis_sertifikat");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data jenis_sertifikat '.$id.'!');
            redirect("jenis_sertifikat");
        }
    }
}