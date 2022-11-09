<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kenaikan_jabatan extends Roles {

	public function __construct()
	{
		parent::__construct(['admin', 'pegawai', 'direktur']);
        $this->load->model([
            'kenaikan_jabatan_model',
            'notifikasi_model',
            'rekap_nilai_model'
        ]);
	}

    public function status_aju($id)
    {        
        $update = $this->kenaikan_jabatan_model->update_status($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate pengajuan '.$id.'!');
            redirect("kenaikan_jabatan/pengajuan_kenaikan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate pengajuan '.$id.'!');
            redirect("kenaikan_jabatan/pengajuan_kenaikan");
        }
    }

    public function pengajuan_kenaikan()
    {
        $this->load->model('pegawai_model');

        if($this->session->userdata('role') == 'admin'
        || $this->session->userdata('user')->bagian_id == 4)
        {            
            // $pegawai = $this->pegawai_model->get_all();
            $pegawai = $this->pegawai_model->get_all_where_join(["jabatan.jenis_jabatan" => "fungsional"], "jabatan", "jabatan.id = pegawai.jabatan_id");
            $pengajuan = $this->kenaikan_jabatan_model->get_all();        
        }else{
            $pegawai = $this->pegawai_model->get_one_with_join(array(
                'account_nip' => $this->session->userdata('nip')
            ));
            $pengajuan = $this->kenaikan_jabatan_model->get_where(array(
                'account_nip' => $this->session->userdata('nip')
            ));            
        }

        $this->load->view('partials/main-header', ['title' => ": Pengajuan Kenaikan Jabatan"]);
		$this->load->view('kenaikan_jabatan/pengajuan', [
            "pegawai" => $pegawai,
            "pengajuan" => $pengajuan
        ]);
		$this->load->view('partials/main-footer');
    }

    public function create_pengajuan()
    {        
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
    
    public function update_berkas($id)
    {                        
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
        $pengajuan = $this->kenaikan_jabatan_model->get_all();

        $this->load->view('partials/main-header', ['title' => ': Progress Pengajuan Kenaikan Jabatan']);        
		$this->load->view('kenaikan_jabatan/progress', [
            'pengajuan' => $pengajuan
        ]);
		$this->load->view('partials/main-footer');
    }

    public function send_notification()
    {         
        $id = $this->notifikasi_model->create_notification([                        
            "judul" => "Progress Berkas Pengajuan Kenaikan Jabatan",
            "pesan" => "Ayo selesaikan upload berkas pengajuan kenaikan jabatan Anda! Perlu ".$this->input->post('sisa')." lagi untuk melengkapi berkasnya.",
            "redirect_to" => "kenaikan_jabatan/pengajuan_kenaikan"
        ]);

        $add = $this->notifikasi_model->pair_notification([
            "account_nip" => $this->input->post("account_nip"),
            "notifikasi_id" => $id,
            "status" => 'Unseen',
            "created_at" => date('Y-m-d H:i:s')
        ]);

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengirimkan notifikasi');
            redirect("kenaikan_jabatan/progress");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengirimkan notifikasi');
            redirect("kenaikan_jabatan/progress");
        }
    }

}