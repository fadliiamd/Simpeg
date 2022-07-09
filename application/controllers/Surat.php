<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends Roles {
	public function __construct()
	{
		parent::__construct(['admin']);
	}

	public function index()
	{
        $this->load->model('surat_model');
        $surat = $this->surat_model->get_all();

		$this->load->view('partials/main-header');
		$this->load->view('surat/surat', [
            "surat" => $surat
        ]);
		$this->load->view('partials/main-footer');
	}

	public function create()
    {
        $this->load->model('surat_model');
        $add = $this->surat_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data surat!');
            redirect("surat");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data surat!');
            redirect("surat");
        }
    }
    
    public function update()
    {        
        $this->load->model('surat_model');
        $id = $this->input->post('id_surat');
        $update = $this->surat_model->update_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data surat J-'.$id.'!');
            redirect("surat");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data surat J-'.$id.'!');
            redirect("surat");
        }
    }
    
    public function delete()
    {        
        $this->load->model('surat_model');
        $id = $this->input->post('id_surat');
        $update = $this->surat_model->delete_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data surat J-'.$id.'!');
            redirect("surat");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data surat J-'.$id.'!');
            redirect("surat");
        }
    }

    public function get_pegawai($jenis)
    {
        $this->load->model("pegawai_model");
        $where = array('jenis_pegawai' => $jenis);
        echo json_encode($this->pegawai_model->get_all_where($where));
    }

    public function get_divisi($divisi)
    {
        if($divisi == "jurusan") {
            $this->load->model("jurusan_model");
            echo json_encode($this->jurusan_model->get_all());
        } else if($divisi == "bagian") {
            $this->load->model("bagian_model");
            echo json_encode($this->bagian_model->get_all());
        } else if($divisi == "unit") {
            $this->load->model("unit_model");
            echo json_encode($this->unit_model->get_all());
        }
    }
}
