<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemberhentian extends Roles {

	public function __construct()
	{
        parent::__construct(['admin', 'pegawai', 'direktur']);
		$this->load->model([
            'pemberhentian_model',
			'berkas_pemberhentian_model',
			'usulan_pemberhentian_model',
			'sk_pemberhentian_model',
            'pegawai_model',
            'direktur_model',
            'bagian_model',
        ]);
	}

	
    public function riwayat_pemberhentian()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/daftar_pemberhentian');
		$this->load->view('partials/main-footer');
	}

	// Pengajuan pemberhentian
	public function pengajuan_pemberhentian()
	{
		$pegawai = $this->pegawai_model->get_all();
		$pemberhentian = $this->pemberhentian_model->get_all();
		
		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/pengajuan_pemberhentian',[
			"pegawai" => $pegawai,
			"pemberhentian" => $pemberhentian,
		]);
		$this->load->view('partials/main-footer');
	}

	public function create_data_pemberhentian()
    {
        $add = $this->pemberhentian_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data pemberhentian!');
            redirect("pemberhentian/pengajuan_pemberhentian");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data pemberhentian!');
            redirect("pemberhentian/pengajuan_pemberhentian");
        }
    }
	
    public function update_data_pemberhentian()
    {
        $update = $this->pemberhentian_model->update_one($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data pemberhentian!');
            redirect("pemberhentian/pengajuan_pemberhentian");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data pemberhentian!');
            redirect("pemberhentian/pengajuan_pemberhentian");
        }
    }
	
	public function delete_data_pemberhentian()
    {
        $delete = $this->pemberhentian_model->delete_one($this->input->post('id'));

        if($delete)
        {
            $this->session->set_flashdata('message_success', 'Berhasil menghapus data pemberhentian!');
            redirect("pemberhentian/pengajuan_pemberhentian");
        }else{
            $this->session->set_flashdata('message_error', 'Gagal menghapus data pemberhentian!');
            redirect("pemberhentian/pengajuan_pemberhentian");
        }
    }

    public function status_pemberhentian()
    {
        $update = $this->pemberhentian_model->status_pemberhentian($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data pemberhentian!');
            redirect("pemberhentian/pengajuan_pemberhentian");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data pemberhentian!');
            redirect("pemberhentian/pengajuan_pemberhentian");
        }
    }

	// End Pengajuan pemberhentian

	// Berkas Pemberhentian
	public function berkas_pemberhentian()
	{
		$berkas_pemberhentian = $this->berkas_pemberhentian_model->get_all_with_join();
		$pemberhentian = $this->pemberhentian_model->get_all();
		$pegawai = $this->pegawai_model->get_all();

		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/berkas_pemberhentian',[
			"pegawai" => $pegawai,
			"pemberhentian" => $pemberhentian,
			"berkas_pemberhentian" => $berkas_pemberhentian,
		]);
		$this->load->view('partials/main-footer');
	}

	public function create_data_berkas()
	{
		$add = $this->berkas_pemberhentian_model->insert_one();

		if($add)
		{
			$this->session->set_flashdata('message_success', 'Behasil menambahkan data pemberhentian!');
			redirect("pemberhentian/berkas_pemberhentian");
		}else
		{
			$this->session->set_flashdata('message_error', 'Gagal menambahkan data pemberhentian!');
			redirect("pemberhentian/berkas_pemberhentian");
		}
	}

	public function update_data_berkas()
	{
		$update = $this->berkas_pemberhentian_model->update_one($this->input->post('id'));

		if($update)
		{
			$this->session->set_flashdata('message_success', 'Berhasil mengupdate data pemberhentian!');
			redirect("pemberhentian/berkas_pemberhentian");
		}else
		{
			$this->session->set_flashdata('message_error', 'Gagal mengupdate data pemberhentian!');
			redirect("pemberhentian/berkas_pemberhentian");
		}
	}

	public function delete_data_berkas()
	{
		$delete = $this->berkas_pemberhentian_model->delete_one($this->input->post('id'));

		if($delete)
		{
			$this->session->set_flashdata('message_success', 'Berhasil menghapus data pemberhentian!');
			redirect("pemberhentian/berkas_pemberhentian");
		}else{
			$this->session->set_flashdata('message_error', 'Gagal menghapus data pemberhentian!');
			redirect("pemberhentian/berkas_pemberhentian");
		}
	}

	public function status_berkas()
	{
		$update = $this->berkas_pemberhentian_model->status_berkas_pemberhentian($this->input->post('id'));

		if($update)
		{
			$this->session->set_flashdata('message_success', 'Berhasil mengupdate data pemberhentian!');
			redirect("pemberhentian/berkas_pemberhentian");
		}else
		{
			$this->session->set_flashdata('message_error', 'Gagal mengupdate data pemberhentian!');
			redirect("pemberhentian/berkas_pemberhentian");
		}
	}

	// End Berkas Pemberhentian

	// Usulan Pensiun
	public function usulan_pensiun()
	{
        $usulan_pensiun = $this->usulan_pemberhentian_model->get_all_with_join();
        $berkas_pemberhentian = $this->berkas_pemberhentian_model->get_all_with_join();

		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/usulan_pensiun',[
            "usulan_pensiun" => $usulan_pensiun,
			"berkas_pemberhentian" => $berkas_pemberhentian,
        ]);
		$this->load->view('partials/main-footer');
	}

	public function create_data_usulan()
    {
        $add = $this->usulan_pemberhentian_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data usulan!');
            redirect("pemberhentian/usulan_pensiun");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data usulan!');
            redirect("pemberhentian/usulan_pensiun");
        }
    }
	
    public function update_data_usulan()
    {
        $update = $this->usulan_pemberhentian_model->update_one($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data usulan!');
            redirect("pemberhentian/usulan_pensiun");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data usulan!');
            redirect("pemberhentian/usulan_pensiun");
        }
    }
	
	public function delete_data_usulan()
    {
        $delete = $this->usulan_pemberhentian_model->delete_one($this->input->post('id'));

        if($delete)
        {
            $this->session->set_flashdata('message_success', 'Berhasil menghapus data usulan!');
            redirect("pemberhentian/usulan_pensiun");
        }else{
            $this->session->set_flashdata('message_error', 'Gagal menghapus data usulan!');
            redirect("pemberhentian/usulan_pensiun");
        }
    }

    public function status_usulan()
    {
        $update = $this->usulan_pemberhentian_model->status_usulan_pensiun($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data usulan!');
            redirect("pemberhentian/usulan_pensiun");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data usulan!');
            redirect("pemberhentian/usulan_pensiun");
        }
    }
	// End Usulan Pensiun

	// SK Pensiun
	public function sk_pensiun()
	{
		$usulan = $this->usulan_pemberhentian_model->get_all_with_join();
		$sk_pemberhentian = $this->sk_pemberhentian_model->get_all();

		$this->load->view('partials/main-header');
		$this->load->view('pages/peralihan_dan_pengalihan/sk_pensiun',[
			"usulan" => $usulan,
			"sk_pemberhentian" => $sk_pemberhentian,
		]);
		$this->load->view('partials/main-footer');
	}

	public function create_data_sk_pemberhentian()
	{
		$add = $this->sk_pemberhentian_model->insert_one();

		if($add)
		{
			$this->session->set_flashdata('message_success', 'Behasil menambahkan data SK!');
			redirect("pemberhentian/sk_pensiun");
		}else
		{
			$this->session->set_flashdata('message_error', 'Gagal menambahkan data SK!');
			redirect("pemberhentian/sk_pensiun");
		}
	}
	
	public function update_data_sk_pemberhentian()
	{
		$update = $this->sk_pemberhentian_model->update_one($this->input->post('id'));

		if($update)
		{
			$this->session->set_flashdata('message_success', 'Berhasil mengupdate data SK!');
			redirect("pemberhentian/sk_pensiun");
		}else
		{
			$this->session->set_flashdata('message_error', 'Gagal mengupdate data SK!');
			redirect("pemberhentian/sk_pensiun");
		}
	}
	
	public function delete_data_sk_pemberhentian()
	{
		$delete = $this->sk_pemberhentian_model->delete_one($this->input->post('id'));

		if($delete)
		{
			$this->session->set_flashdata('message_success', 'Berhasil menghapus data SK!');
			redirect("pemberhentian/sk_pensiun");
		}else{
			$this->session->set_flashdata('message_error', 'Gagal menghapus data SK!');
			redirect("pemberhentian/sk_pensiun");
		}
	}
	// end sk pensiun
}