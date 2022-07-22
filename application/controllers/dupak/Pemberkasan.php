<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemberkasan extends Roles {
    public $nama;

	public function __construct()
	{
		parent::__construct(['admin', 'pegawai', 'direktur']);
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
    
    public function usulan_pak($id)
    {
        $unsur = $this->unsur_model->get_all();
        $unsur_kegiatan = $this->unsur_kegiatan_model->get_all();
        $nilai = $this->nilai_model->get_where(array("rekap_nilai_id" => $id));

        $this->load->view('partials/main-header', ['title' => ": Formulir PAK Ke-".$id]);
        $this->load->view('dupak/lihat',[
            "unsur" => $unsur,
            "unsur_kegiatan" => $unsur_kegiatan,
            "id" => $id,
            "nilai" => $nilai
        ]);
        $this->load->view('partials/main-footer');
    }

    public function validasi_pak($id)
    {
        $unsur = $this->unsur_model->get_all();
        $unsur_kegiatan = $this->unsur_kegiatan_model->get_all();
        $nilai = $this->nilai_model->get_where(array("rekap_nilai_id" => $id));

        $this->load->view('partials/main-header', ['title' => ": Validasi Formulir PAK Ke-".$id]);
        $this->load->view('dupak/validasi',[
            "unsur" => $unsur,
            "unsur_kegiatan" => $unsur_kegiatan,
            "id" => $id,
            "nilai" => $nilai
        ]);
        $this->load->view('partials/main-footer');
    }
    
    public function do_validasi_nilai($id, $rekap_nilai_id)
    {
        $this->load->model('nilai_model');        
        $update = $this->nilai_model->update_one($id, $rekap_nilai_id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data nilai_rekap '.$rekap_nilai_id.'!');
            redirect("dupak/pemberkasan/validasi_pak/".$rekap_nilai_id);
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data nilai_rekap '.$rekap_nilai_id.'!');
            redirect("dupak/pemberkasan/validasi_pak/".$rekap_nilai_id);
        }
    }

    public function do_create()
    {
        $this->load->model('nilai_model');
        $add = $this->nilai_model->inserts_one();

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
            $this->session->set_flashdata('message_success', 'Behasil mengupdate data nilai_rekap '.$id.'!');
            redirect("dupak/pemberkasan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data nilai_rekap '.$id.'!');
            redirect("dupak/pemberkasan");
        }
    }
    
    public function delete($id)
    {        
        $this->load->model('rekap_nilai_model');        
        $update = $this->rekap_nilai_model->delete_one($id);

        if($update)
        {
            $this->session->set_flashdata('message_success', 'Behasil menhapus data nilai_rekap '.$id.'!');
            redirect("dupak/pemberkasan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data nilai_rekap '.$id.'!');
            redirect("dupak/pemberkasan");
        }
    }

    public function export_pdf($id)
    {
        $this->load->helper(array('dompdf'));
        $unsur = $this->unsur_model->get_all();
        $unsur_kegiatan = $this->unsur_kegiatan_model->get_all();
        $nilai = $this->nilai_model->get_where(array("rekap_nilai_id" => $id));  

        $html = $this->load->view('dupak/format_pak_pdf', [
            'title' => ": Formulir PAK Ke-".$id,
            "unsur" => $unsur,
            "unsur_kegiatan" => $unsur_kegiatan,
            "id" => $id,
            "nilai" => $nilai
        ], true);
        $data = pdf_create($html, 'DUPAK_'.$id.'_'.date('d_m_Y'), TRUE, 'A4', 'potrait');
    }
}