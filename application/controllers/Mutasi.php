<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi extends Roles {

	public function __construct()
	{
        parent::__construct(['admin', 'pegawai', 'direktur']);
		$this->load->model([
            'mutasi_model',
            'berkas_mutasi_model',
            'usulan_mutasi_model',
            'penerimaan_mutasi_model',
            'sk_mutasi_model',
            'pegawai_model',
            'direktur_model',
            'bagian_model',
        ]);
	}

    // pengajuan
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

    public function status_mutasi()
    {
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

    // end mutasi

    // berkas mutasi
	public function berkas_mutasi()
	{
		$berkas_mutasi = $this->berkas_mutasi_model->get_all_with_join();
        $mutasi = $this->mutasi_model->get_all();
        $pegawai = $this->pegawai_model->get_all();

		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/berkas_mutasi',[
			"pegawai" => $pegawai,
            "mutasi" => $mutasi,
			"berkas_mutasi" => $berkas_mutasi,
		]);
		$this->load->view('partials/main-footer');
	}

    public function create_data_berkas()
    {
        $add = $this->berkas_mutasi_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data mutasi!');
            redirect("mutasi/berkas_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data mutasi!');
            redirect("mutasi/berkas_mutasi");
        }
    }
	
    public function update_data_berkas()
    {
        $update = $this->berkas_mutasi_model->update_one($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data mutasi!');
            redirect("mutasi/berkas_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data mutasi!');
            redirect("mutasi/berkas_mutasi");
        }
    }
	
	public function delete_data_berkas()
    {
        $delete = $this->berkas_mutasi_model->delete_one($this->input->post('id'));

        if($delete)
        {
            $this->session->set_flashdata('message_success', 'Berhasil menghapus data mutasi!');
            redirect("mutasi/berkas_mutasi");
        }else{
            $this->session->set_flashdata('message_error', 'Gagal menghapus data mutasi!');
            redirect("mutasi/berkas_mutasi");
        }
    }

    public function status_berkas()
    {
        $update = $this->berkas_mutasi_model->status_berkas_mutasi($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data mutasi!');
            redirect("mutasi/berkas_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data mutasi!');
            redirect("mutasi/berkas_mutasi");
        }
    }

    // end berkas mutasi

    // usulan mutasi
	public function usulan_mutasi()
	{
        $usulan_mutasi = $this->usulan_mutasi_model->get_all_with_join();
        $berkas_mutasi = $this->berkas_mutasi_model->get_all_with_join();

		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/usulan_mutasi',[
            "usulan_mutasi" => $usulan_mutasi,
			"berkas_mutasi" => $berkas_mutasi,
        ]);
		$this->load->view('partials/main-footer');
	}

	public function create_data_usulan()
    {
        $add = $this->usulan_mutasi_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data usulan!');
            redirect("mutasi/usulan_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data usulan!');
            redirect("mutasi/usulan_mutasi");
        }
    }
	
    public function update_data_usulan()
    {
        $update = $this->usulan_mutasi_model->update_one($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data usulan!');
            redirect("mutasi/usulan_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data usulan!');
            redirect("mutasi/usulan_mutasi");
        }
    }
	
	public function delete_data_usulan()
    {
        $delete = $this->usulan_mutasi_model->delete_one($this->input->post('id'));

        if($delete)
        {
            $this->session->set_flashdata('message_success', 'Berhasil menghapus data usulan!');
            redirect("mutasi/usulan_mutasi");
        }else{
            $this->session->set_flashdata('message_error', 'Gagal menghapus data usulan!');
            redirect("mutasi/usulan_mutasi");
        }
    }

    public function status_usulan()
    {
        $update = $this->usulan_mutasi_model->status_usulan_mutasi($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data usulan!');
            redirect("mutasi/usulan_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data usulan!');
            redirect("mutasi/usulan_mutasi");
        }
    }
    // end usulan mutasi

    // penerimaan mutasi
	public function penerimaan_mutasi()
	{
        $bagian = $this->bagian_model->get_all();
        $direktur = $this->direktur_model->get_all();
        $penerimaan_mutasi = $this->penerimaan_mutasi_model->get_all();

        $b_keuangan = $this->penerimaan_mutasi_model->get_bagian_by_id(1);
        $b_kepegawaian = $this->penerimaan_mutasi_model->get_bagian_by_id(2);

		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/penerimaan_mutasi',[
            "bagian" => $bagian,
			"direktur" => $direktur,
            "penerimaan_mutasi" => $penerimaan_mutasi,
            "b_keuangan" => $b_keuangan,
            "b_kepegawaian" => $b_kepegawaian,
        ]);
		$this->load->view('partials/main-footer');
	}

    public function create_data_penerimaan()
    {
        $add = $this->penerimaan_mutasi_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data penerimaan!');
            redirect("mutasi/penerimaan_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data penerimaan!');
            redirect("mutasi/penerimaan_mutasi");
        }
    }
	
    public function update_data_penerimaan()
    {
        $update = $this->penerimaan_mutasi_model->update_one($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data penerimaan!');
            redirect("mutasi/penerimaan_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data penerimaan!');
            redirect("mutasi/penerimaan_mutasi");
        }
    }
	
	public function delete_data_penerimaan()
    {
        $delete = $this->penerimaan_mutasi_model->delete_one($this->input->post('id'));

        if($delete)
        {
            $this->session->set_flashdata('message_success', 'Berhasil menghapus data penerimaan!');
            redirect("mutasi/penerimaan_mutasi");
        }else{
            $this->session->set_flashdata('message_error', 'Gagal menghapus data penerimaan!');
            redirect("mutasi/penerimaan_mutasi");
        }
    }

    public function status_penerimaan()
    {
        $update = $this->penerimaan_mutasi_model->status_penerimaan_mutasi($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data penerimaan!');
            redirect("mutasi/penerimaan_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data penerimaan!');
            redirect("mutasi/penerimaan_mutasi");
        }
    }
    // end penerimaan mutasi
    
    // sk mutasi
	public function sk_mutasi()
	{
        $usulan = $this->usulan_mutasi_model->get_all_with_join();
        $sk_mutasi = $this->sk_mutasi_model->get_all();

		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/sk_mutasi',[
            "usulan" => $usulan,
			"sk_mutasi" => $sk_mutasi,
        ]);
		$this->load->view('partials/main-footer');
	}

    public function create_data_sk_mutasi()
    {
        $add = $this->sk_mutasi_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data SK!');
            redirect("mutasi/sk_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data SK!');
            redirect("mutasi/sk_mutasi");
        }
    }
	
    public function update_data_sk_mutasi()
    {
        $update = $this->sk_mutasi_model->update_one($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data SK!');
            redirect("mutasi/sk_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data SK!');
            redirect("mutasi/sk_mutasi");
        }
    }
	
	public function delete_data_sk_mutasi()
    {
        $delete = $this->sk_mutasi_model->delete_one($this->input->post('id'));

        if($delete)
        {
            $this->session->set_flashdata('message_success', 'Berhasil menghapus data SK!');
            redirect("mutasi/sk_mutasi");
        }else{
            $this->session->set_flashdata('message_error', 'Gagal menghapus data SK!');
            redirect("mutasi/sk_mutasi");
        }
    }
    // end sk mutasi
}