<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perhitungan extends Roles {
    public $nama;

	public function __construct()
	{
		parent::__construct(['admin']);
	}

    public function index()
    {
        $this->load->model('kriteria_model');

        $kriteria = $this->kriteria_model->get_all();

        $this->load->view('partials/main-header');
		$this->load->view('perangkingan/perhitungan',[
            "kriteria" => $kriteria            
        ]);
		$this->load->view('partials/main-footer');
    }

    public function get_nilai_mbp()
    {
        $this->load->model('nilaikriteria_model');
        $nilai_kriteria = $this->nilaikriteria_model->get_all();

        echo json_encode(array('status'=>'ok','data'=>$nilai_kriteria)); 
    }
    
    public function simpan_mpb()
    {
        $this->load->model('nilaikriteria_model');
        $add = $this->nilaikriteria_model->inserts();

        if($add)
        {
            $this->session->set_flashdata('message_success', 'Behasil menyimpan data matriks perbandingan!');
            redirect("perhitungan");
        }else
        {
            $this->session->set_flashdata('message_error', 'Gagal menyimpan data matriks perbandingan!');
            redirect("perhitungan");
        }
    }

}