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
		$this->load->library('form_validation');   
	}

    public function riwayat_pemberhentian()
	{
		$pemberhentian = $this->pemberhentian_model->get_condition("jenis_berhenti","Pengunduran Diri");

		$this->load->view('partials/main-header',['title' => 'Riwayat pemberhentian']);
		$this->load->view('pages/peralihan_dan_pengalihan/daftar_pemberhentian',[
			"pemberhentian" => $pemberhentian
		]);
		$this->load->view('partials/main-footer');
	}

	// Pengajuan pemberhentian
	public function pengajuan_pemberhentian()
	{
		$pegawaiPNSNonDini = $this->pegawai_model->get_pegawai_tua();
		$pegawaiPNSDini = $this->pegawai_model->get_pegawai_muda();
		$pegawaiNonPNS = $this->pegawai_model->get_pegawai_non_pns();
		$users = $this->pegawai_model->get_condition("account_nip",$this->session->userdata("nip"));
		
		if ($this->session->userdata("role") == "admin" || $this->session->userdata("role") == "direktur") {
			$pemberhentian = $this->pemberhentian_model->get_all_with_join_pegawai();
		}

		if ($this->session->userdata("role") == "pegawai") {
			$pemberhentian = $this->pemberhentian_model->get_condition("pegawai_nip",$this->session->userdata("nip"));
		}
		
		$this->load->view('partials/main-header',['title' => 'Pengajuan pemberhentian']);
		$this->load->view('pages/peralihan_dan_pengalihan/pengajuan_pemberhentian',[
			"pegawaiPNSNonDini" => $pegawaiPNSNonDini,
			"pegawaiPNSDini" => $pegawaiPNSDini,
			"pegawaiNonPNS" => $pegawaiNonPNS,
			"users" => $users,
			"pemberhentian" => $pemberhentian,
		]);
		$this->load->view('partials/main-footer');
	}

	public function create_data_pemberhentian()
    {
        $this->form_validation->set_rules(
            'pegawai_nip',
            'pegawai_nip',
            'is_unique[pemberhentian.pegawai_nip]',
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_error', validation_errors());
            redirect("pemberhentian/pengajuan_pemberhentian");
        }

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
		if ($this->session->userdata("role") == "admin") {	
			$berkas_pemberhentian = $this->berkas_pemberhentian_model->get_all_with_join();
		}

		if ($this->session->userdata("role") == "pegawai") {
			$berkas_pemberhentian = $this->berkas_pemberhentian_model->get_all_with_join_pegawai();
		}
		
		$pemberhentian = $this->pemberhentian_model->get_pegawai_berkas();

		$this->load->view('partials/main-header',['title' => 'Berkas pemberhentian']);
		$this->load->view('pages/peralihan_dan_pengalihan/berkas_pemberhentian',[
			"pemberhentian" => $pemberhentian,
			"berkas_pemberhentian" => $berkas_pemberhentian,
		]);
		$this->load->view('partials/main-footer');
	}

	public function create_data_berkas()
	{
        $this->form_validation->set_rules(
            'pemberhentian_id',
            'pemberhentian_id',
            'is_unique[berkaspensiun.pemberhentian_id]',
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_error', validation_errors());
            redirect("pemberhentian/berkas_pemberhentian");
        }

		$add = $this->berkas_pemberhentian_model->insert_one();

		if($add)
		{
			$this->session->set_flashdata('message_success', 'Behasil menambahkan data berkas pemberhentian!');
			redirect("pemberhentian/berkas_pemberhentian");
		}else
		{
			$this->session->set_flashdata('message_error', 'Gagal menambahkan data berkas pemberhentian!');
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
			if ($update == "setujui") {
				$this->create_data_usulan();
			}else {
				$this->session->set_flashdata('message_success', 'Berhasil mengupdate data pemberhentian!');
				redirect("pemberhentian/berkas_pemberhentian");
			}
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

		$this->load->view('partials/main-header',['title' => 'Usulan pemberhentian']);
		$this->load->view('pages/peralihan_dan_pengalihan/usulan_pensiun',[
            "usulan_pensiun" => $usulan_pensiun,
			"berkas_pemberhentian" => $berkas_pemberhentian,
        ]);
		$this->load->view('partials/main-footer');
	}

	public function create_data_usulan()
    {
		$this->form_validation->set_rules(
            'berkaspensiun_id',
            'berkaspensiun_id',
            'is_unique[usulanpensiun.berkaspensiun_id]',
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );

		$this->form_validation->set_rules(
            'pemberhentian_id',
            'pemberhentian_id',
            'is_unique[usulanpensiun.pemberhentian_id]',
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_error', validation_errors());
            redirect("pemberhentian/usulan_pensiun");
        }

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
			if ($update == "setujui") {
				$this->create_data_sk_pemberhentian();
			}else {
				$this->session->set_flashdata('message_success', 'Berhasil mengupdate data usulan!');
				redirect("pemberhentian/usulan_pensiun");
			}
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data usulan!');
            redirect("pemberhentian/usulan_pensiun");
        }
    }

	public function upload_data_usulan()
    {
        $update = $this->usulan_pemberhentian_model->upload_surat($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupload file usulan!');
            redirect("pemberhentian/usulan_pensiun");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupload file usulan!');
            redirect("pemberhentian/usulan_pensiun");
        }
    }
	// End Usulan Pensiun

	// SK Pensiun
	public function sk_pensiun()
	{
		$sk_pemberhentian = $this->sk_pemberhentian_model->get_all_with_join();

		$this->load->view('partials/main-header',['title' => 'Surat keputusan pemberhentian']);
		$this->load->view('pages/peralihan_dan_pengalihan/sk_pensiun',[
			"sk_pemberhentian" => $sk_pemberhentian,
		]);
		$this->load->view('partials/main-footer');
	}

	public function create_data_sk_pemberhentian()
	{
		$this->form_validation->set_rules(
            'usulanpensiun_id',
            'usulanpensiun_id',
            'is_unique[skpensiun.usulanpensiun_id]',
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_error', validation_errors());
            redirect("pemberhentian/sk_pensiun");
        }

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

	public function upload_data_sk()
    {
        $update = $this->sk_pemberhentian_model->upload_surat($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupload file usulan!');
            redirect("pemberhentian/sk_pensiun");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupload file usulan!');
            redirect("pemberhentian/sk_pensiun");
        }
    }
	// end sk pensiun
}