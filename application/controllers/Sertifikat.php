<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikat extends Admin {
    public $nama;

	public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
        $this->load->model('sertifikat_model');
        $this->load->model('pegawai_model');

        if($this->session->userdata('role') == 'admin') {
            $sertifikat = $this->sertifikat_model->get_all();
        } else {
            $sertifikat = $this->sertifikat_model->get_all_where([
                "account_nip" => $this->session->userdata('nip')
            ]);
        }

        $this->load->view('partials/main-header');
		$this->load->view('users/admin/data_sertifikat', [
            "sertifikat" => $sertifikat
        ]);
		$this->load->view('partials/main-footer');
    }

    public function create()
    {
        $this->load->model('sertifikat_model');
        $add = $this->sertifikat_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data sertifikat!');
            redirect("sertifikat");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data sertifikat!');
            redirect("sertifikat");
        }
    }
    
    public function update()
    {        
        $this->load->model('sertifikat_model');
        $id = $this->input->post('serti_id');
        $update = $this->sertifikat_model->update_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data sertifikat');
            redirect("sertifikat");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data sertifikat');
            redirect("sertifikat");
        }
    }
    
    public function delete()
    {        
        $this->load->model('sertifikat_model');
        $id = $this->input->post('serti_id');
        $update = $this->sertifikat_model->delete_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data sertifikat');
            redirect("sertifikat");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data sertifikat');
            redirect("sertifikat");
        }
    }

    public function redirect_back()
    {
        
    }
}