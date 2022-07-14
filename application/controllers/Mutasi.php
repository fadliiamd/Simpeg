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
            'penjadwalan_model',
            'pegawai_model',
            'direktur_model',
            'bagian_model',
        ]);
        $this->load->library('form_validation');   
	}

    // Penjadwalan
	public function penjadwalan_mutasi()
	{
        $pegawai = $this->pegawai_model->get_condition("status_kerja","aktif");
        $users = $this->pegawai_model->get_condition("account_nip",$this->session->userdata("nip"));
        $penjadwalan = $this->penjadwalan_model->get_all_with_join_pegawai();

		$this->load->view('partials/main-header',['title' => 'Penjadwalan mutasi']);
		$this->load->view('pages/peralihan_dan_pengalihan/penjadwalan_mutasi',[
			"pegawai" => $pegawai,
			"penjadwalan" => $penjadwalan,
            "users" => $users,
		]);
		$this->load->view('partials/main-footer');
	}

	public function create_data_penjadwalan()
    {
        $this->form_validation->set_rules(
            'nip',
            'nip',
            'is_unique[penjadwalan.nip]',
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_error', validation_errors());
            redirect("mutasi/penjadwalan_mutasi");
        }

        $add = $this->penjadwalan_model->insert_one();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data penjadwalan!');
            redirect("mutasi/penjadwalan_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data penjadwalan!');
            redirect("mutasi/penjadwalan_mutasi");
        }
    }
	
    public function update_data_penjadwalan()
    {
        $update = $this->penjadwalan_model->update_one($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data penjadwalan!');
            redirect("mutasi/penjadwalan_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data penjadwalan!');
            redirect("mutasi/penjadwalan_mutasi");
        }
    }
	
	public function delete_data_penjadwalan()
    {
        $delete = $this->penjadwalan_model->delete_one($this->input->post('id'));

        if($delete)
        {
            $this->session->set_flashdata('message_success', 'Berhasil menghapus data penjadwalan!');
            redirect("mutasi/penjadwalan_mutasi");
        }else{
            $this->session->set_flashdata('message_error', 'Gagal menghapus data penjadwalan!');
            redirect("mutasi/penjadwalan_mutasi");
        }
    }

    public function status_penjadwalan()
    {
        $update = $this->penjadwalan_model->status_penjadwalan($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data penjadwalan!');
            redirect("mutasi/penjadwalan_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data penjadwalan!');
            redirect("mutasi/penjadwalan_mutasi");
        }
    }
    // End Penjadwalan

    // pengajuan
	public function pengajuan_mutasi()
	{
        $pegawai = $this->pegawai_model->get_condition("status_kerja","aktif");
        $users = $this->pegawai_model->get_condition("account_nip",$this->session->userdata("nip"));
        
		if ($this->session->userdata("role") == "admin") {
            $mutasi = $this->mutasi_model->get_all_with_join_pegawai();
        }
        
        if ($this->session->userdata("role") == "pegawai") {
			$mutasi = $this->mutasi_model->get_condition("pegawai_nip",$this->session->userdata("nip"));
        }

		$this->load->view('partials/main-header',['title' => 'Pengajuan mutasi']);
		$this->load->view('pages/peralihan_dan_pengalihan/pengajuan_mutasi',[
			"pegawai" => $pegawai,
			"mutasi" => $mutasi,
            "users" => $users,
		]);
		$this->load->view('partials/main-footer');
	}

	public function create_data_mutasi()
    {
        $this->form_validation->set_rules(
            'pegawai_nip',
            'pegawai_nip',
            'is_unique[mutasi.pegawai_nip]',
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_error', validation_errors());
            redirect("mutasi/pengajuan_mutasi");
        }

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
        if ($this->session->userdata("role") == "admin") {	
            $berkas_mutasi = $this->berkas_mutasi_model->get_all_with_join();
        }

        if ($this->session->userdata("role") == "pegawai") {	
            $berkas_mutasi = $this->berkas_mutasi_model->get_all_with_join_pegawai();
        }
        $mutasi = $this->mutasi_model->get_pegawai_berkas();

		$this->load->view('partials/main-header',['title' => 'Berkas mutasi']);
		$this->load->view('pages/peralihan_dan_pengalihan/berkas_mutasi',[
            "mutasi" => $mutasi,
			"berkas_mutasi" => $berkas_mutasi,
		]);
		$this->load->view('partials/main-footer');
	}

    public function create_data_berkas()
    {
        $this->form_validation->set_rules(
            'mutasi_id',
            'mutasi_id',
            'is_unique[berkasmutasi.mutasi_id]',
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_error', validation_errors());
            redirect("mutasi/berkas_mutasi");
        }

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
            if ($update == "setujui") {
				$this->create_data_usulan();
			}else {
                $this->session->set_flashdata('message_success', 'Berhasil mengupdate data mutasi!');
                redirect("mutasi/berkas_mutasi");
            }
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

		$this->load->view('partials/main-header',['title' => 'Usulan mutasi']);
		$this->load->view('pages/peralihan_dan_pengalihan/usulan_mutasi',[
            "usulan_mutasi" => $usulan_mutasi,
			"berkas_mutasi" => $berkas_mutasi,
        ]);
		$this->load->view('partials/main-footer');
	}

	public function create_data_usulan()
    {
        $this->form_validation->set_rules(
            'mutasi_id',
            'mutasi_id',
            'is_unique[usulanmutasi.mutasi_id]',
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );

        $this->form_validation->set_rules(
            'berkasmutasi_id',
            'berkasmutasi_id',
            'is_unique[usulanmutasi.berkasmutasi_id]',
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_error', validation_errors());
            redirect("mutasi/usulan_mutasi");
        }

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
			if ($update == "setujui") {
				$this->create_data_sk_mutasi();
			}else {
				$this->session->set_flashdata('message_success', 'Berhasil mengupdate data usulan!');
				redirect("mutasi/usulan_pensiun");
			}
        }else{
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data usulan!');
            redirect("mutasi/usulan_pensiun");
        }
    }

    public function upload_data_usulan()
    {
        $update = $this->usulan_mutasi_model->upload_surat($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupload file usulan!');
            redirect("mutasi/usulan_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupload file usulan!');
            redirect("mutasi/usulan_mutasi");
        }
    }
    // end usulan mutasi

    // penerimaan mutasi
	public function penerimaan_mutasi()
	{
        $bagian = $this->bagian_model->get_all();
        $direktur = $this->direktur_model->get_all();
        $penerimaan_mutasi = $this->penerimaan_mutasi_model->get_all_with_join_pegawai();
        $pegawai = $this->pegawai_model->get_condition("status_kerja","pending");
        
        $b_akademik = $this->penerimaan_mutasi_model->get_bagian_by_id(1);
        $b_umum = $this->penerimaan_mutasi_model->get_bagian_by_id(2);
        $b_keuangan = $this->penerimaan_mutasi_model->get_bagian_by_id(3);
        $b_kepegawaian = $this->penerimaan_mutasi_model->get_bagian_by_id(4);

		$this->load->view('partials/main-header',['title' => 'Penerimaan mutasi']);
		$this->load->view('pages/peralihan_dan_pengalihan/penerimaan_mutasi',[
            "pegawai" => $pegawai,
            "bagian" => $bagian,
			"direktur" => $direktur,
            "penerimaan_mutasi" => $penerimaan_mutasi,
            "b_akademik" => $b_akademik,
            "b_umum" => $b_umum,
            "b_keuangan" => $b_keuangan,
            "b_kepegawaian" => $b_kepegawaian,
        ]);
		$this->load->view('partials/main-footer');
	}

    public function create_data_penerimaan()
    {
        $this->form_validation->set_rules(
            'pegawai_nip',
            'pegawai_nip',
            'is_unique[penerimaanmutasi.pegawai_nip]',
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_error', validation_errors());
            redirect("mutasi/penerimaan_mutasi");
        }

        $add = $this->penerimaan_mutasi_model->insert_one();

        if($add)
        {
            $this->penerimaan_mutasi_model->change_bagian();
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
            if ($update == "setujui") {
				$this->create_data_sk_mutasi();
			}else {
                $this->session->set_flashdata('message_success', 'Berhasil mengupdate data penerimaan!');
                redirect("mutasi/penerimaan_mutasi");
            }
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
        $sk_mutasi = $this->sk_mutasi_model->get_all_with_join();

		$this->load->view('partials/main-header',['title' => 'Surat keputusan mutasi']);
		$this->load->view('pages/peralihan_dan_pengalihan/sk_mutasi',[
			"sk_mutasi" => $sk_mutasi,
        ]);
		$this->load->view('partials/main-footer');
	}

    public function create_data_sk_mutasi()
    {
        $this->form_validation->set_rules(
            'usulanmutasi_id',
            'usulanmutasi_id',
            'is_unique[skmutasi.usulanmutasi_id]',
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );

        $this->form_validation->set_rules(
            'penerimaan_id',
            'penerimaan_id',
            'is_unique[skmutasi.penerimaan_id]',
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_error', validation_errors());
            redirect("mutasi/sk_mutasi");
        }

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

    public function upload_data_sk()
    {
        $update = $this->sk_mutasi_model->upload_surat($this->input->post('id'));

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Berhasil mengupload file usulan!');
            redirect("mutasi/sk_mutasi");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupload file usulan!');
            redirect("mutasi/sk_mutasi");
        }
    }
    // end sk mutasi
}