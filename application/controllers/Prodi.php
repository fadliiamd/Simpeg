<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends Admin {
    public $nama;

	public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
        $this->load->model(['prodi_model', 'jurusan_model']);

        $prodi = $this->prodi_model->get_all();
        $jurusan = $this->jurusan_model->get_all();

        $this->load->view('partials/main-header', [" : Data Program Studi"]);
		$this->load->view('users/admin/data_prodi', [
            "prodi" => $prodi,
            "jurusan"=>$jurusan
        ]);
		$this->load->view('partials/main-footer');
    }

    public function create()
    {
        $this->load->model('prodi_model');
        $add = $this->prodi_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data jurusan!');
            redirect("prodi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data jurusan!');
            redirect("prodi");
        }
    }
    
    public function update()
    {        
        $this->load->model('prodi_model');
        $id = $this->input->post('id_jurusan');
        $update = $this->prodi_model->update_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data jurusan J-'.$id.'!');
            redirect("prodi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data jurusan J-'.$id.'!');
            redirect("prodi");
        }
    }
    
    public function delete()
    {        
        $this->load->model('prodi_model');
        $id = $this->input->post('id_jurusan');
        $update = $this->prodi_model->delete_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data jurusan J-'.$id.'!');
            redirect("prodi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data jurusan J-'.$id.'!');
            redirect("prodi");
        }
    }
}