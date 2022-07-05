<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi extends Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['mutasi_model','pegawai_model']);
	}

	public function pengajuan_mutasi()
	{
		$mutasi = $this->mutasi_model->get_all();
        $pegawai = $this->pegawai_model->get_all();

		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/pengajuan_mutasi',[
			"pegawai" => $pegawai,
			"mutasi" => $mutasi,
		]);
		$this->load->view('partials/main-footer');
	}

	public function create_data_mutasi()
    {
        $add = $this->mutasi_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data mutasi!');
            redirect("mutasi/pengajuan_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data mutasi!');
            redirect("mutasi/pengajuan_mutasi");
        }
    }
	
    public function update_data_mutasi()
    {
        $update = $this->mutasi_model->update_one($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data mutasi!');
            redirect("mutasi/pengajuan_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data mutasi!');
            redirect("mutasi/pengajuan_mutasi");
        }
    }
	
	public function delete_data_mutasi()
    {
        $delete = $this->mutasi_model->delete_one($this->input->post('id'));

        if($delete)
        {
            $this->session->set_flashdata('message_success', 'Berhasil menghapus data mutasi!');
            redirect("mutasi/pengajuan_mutasi");
        }else{
            $this->session->set_flashdata('message_error', 'Gagal menghapus data mutasi!');
            redirect("mutasi/pengajuan_mutasi");
        }
    }

    public function status_mutasi(){
        $update = $this->mutasi_model->status_mutasi($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data mutasi!');
            redirect("mutasi/pengajuan_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data mutasi!');
            redirect("mutasi/pengajuan_mutasi");
        }
    }
	public function berkas_mutasi()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/berkas_mutasi');
		$this->load->view('partials/main-footer');
	}

	public function usulan_mutasi()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/usulan_mutasi');
		$this->load->view('partials/main-footer');
	}

	public function penerimaan_mutasi()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/penerimaan_mutasi');
		$this->load->view('partials/main-footer');
	}

	public function sk_mutasi()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/sk_mutasi');
		$this->load->view('partials/main-footer');
	}
}