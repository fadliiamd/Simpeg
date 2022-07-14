<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemberkasan extends Roles {
    public $nama;

	public function __construct()
	{
		parent::__construct(['admin', 'pegawai']);
        $this->load->model([
            'nilai_model',
            'rekap_nilai_model',
            'kenaikan_jabatan_model',
            'unsur_model',
            'unsur_kegiatan_model'
        ]);
	}

    public function index()
    {
        $nilai_rekap = $this->rekap_nilai_model->get_all();
        $pengajuan = $this->kenaikan_jabatan_model->get_all();

        $this->load->view('partials/main-header', ['title' => ': Data DUPAK']);
		$this->load->view('dupak/pemberkasan',[
            "nilai_rekap" => $nilai_rekap,
            "pengajuan" => $pengajuan
        ]);
		$this->load->view('partials/main-footer');
    }    
  
    public function create()
    {
        if($this->session->userdata('role')=='pegawai'){                    
            $unsur = $this->unsur_model->get_all();
            $unsur_kegiatan = $this->unsur_kegiatan_model->get_all();

            $this->load->view('partials/main-header', ['title' => ": Formulir PAK"]);
            $this->load->view('dupak/create',[
                "unsur" => $unsur,
                "unsur_kegiatan" => $unsur_kegiatan
            ]);
            $this->load->view('partials/main-footer');
        }else{
            $this->index();
        }
    }

    public function do_create()
    {
        $this->load->model('nilai_model');
        $add = $this->nilai_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data nilai_rekap!');
            redirect("dupak/pemberkasan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data nilai_rekap!');
            redirect("dupak/pemberkasan");
        }
    }
    
    public function update()
    {        
        $this->load->model('nilai_model');
        $id = $this->input->post('id_nilai_rekap');
        $update = $this->nilai_model->update_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data nilai_rekap C-'.$id.'!');
            redirect("dupak/pemberkasan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data nilai_rekap C-'.$id.'!');
            redirect("dupak/pemberkasan");
        }
    }
    
    public function delete()
    {        
        $this->load->model('nilai_model');
        $id = $this->input->post('id_nilai_rekap');
        $update = $this->nilai_model->delete_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data nilai_rekap C-'.$id.'!');
            redirect("dupak/pemberkasan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data nilai_rekap C-'.$id.'!');
            redirect("dupak/pemberkasan");
        }
    }
}