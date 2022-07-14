<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kenaikan_jabatan extends Roles {

	public function __construct()
	{
		parent::__construct(['admin', 'pegawai']);
	}

    public function pengajuan_kenaikan()
    {
        $this->load->model('pegawai_model');
        $this->load->model('kenaikan_jabatan_model');

        $pegawai = $this->pegawai_model->get_all();
        $pengajuan = $this->kenaikan_jabatan_model->get_all();

        $this->load->view('partials/main-header', ['title' => ": Pengajuan Kenaikan Jabatan"]);
		$this->load->view('kenaikan_jabatan/pengajuan', [
            "pegawai" => $pegawai,
            "pengajuan" => $pengajuan
        ]);
		$this->load->view('partials/main-footer');
    }

    public function create_pengajuan()
    {
        $this->load->model('kenaikan_jabatan_model');
        $add = $this->kenaikan_jabatan_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data pengajuan!');
            redirect("kenaikan_jabatan/pengajuan_kenaikan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data pengajuan!');
            redirect("kenaikan_jabatan/pengajuan_kenaikan");
        }
    }
    
    public function update_pengajuan()
    {        
        $this->load->model('kenaikan_jabatan_model');
        $id = $this->input->post('id_pengajuan');
        $update = $this->kenaikan_jabatan_model->update_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data pengajuan J-'.$id.'!');
            redirect("kenaikan_jabatan/pengajuan_kenaikan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data pengajuan J-'.$id.'!');
            redirect("kenaikan_jabatan/pengajuan_kenaikan");
        }
    }
    
    public function delete_pengajuan()
    {        
        $this->load->model('kenaikan_jabatan_model');
        $id = $this->input->post('id_pengajuan');
        $update = $this->kenaikan_jabatan_model->delete_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data pengajuan J-'.$id.'!');
            redirect("kenaikan_jabatan/pengajuan_kenaikan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data pengajuan J-'.$id.'!');
            redirect("kenaikan_jabatan/pengajuan_kenaikan");
        }
    }

    public function progress()
    {
        $this->load->view('partials/main-header');
		$this->load->view('kenaikan_jabatan/progress');
		$this->load->view('partials/main-footer');
    }

}