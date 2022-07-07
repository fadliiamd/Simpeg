<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perhitungan extends Roles
{
    public $nama;

    public function __construct()
    {
        parent::__construct(['admin']);
    }

    public function index()
    {
        $this->load->model('kriteria_model');
        
        $only_kriteria = '';

        if(isset($_GET["jenis_hitung"]) && isset($_GET["kriteria"])){   
            if($_GET["jenis_hitung"]=='subkriteria'){
                $this->load->model('subkriteria_model');         
                $id = $_GET["kriteria"];   
                $kriteria = $this->subkriteria_model->get_all_where_parent($id);
                $only_kriteria = $this->kriteria_model->get_all();
            }
        }else{            
            $kriteria = $this->kriteria_model->get_all();
            $only_kriteria = $kriteria;
        }          

        $this->load->view('partials/main-header');
        $this->load->view('perangkingan/perhitungan', [
            "only_kriteria" => $only_kriteria,
            "kriteria" => $kriteria
        ]);
        $this->load->view('partials/main-footer');
    }

    public function get_nilai_mbp()
    {                  
        if($_GET["jenis"] == 'subkriteria'){
            $this->load->model('nilaisubkriteria_model');
            $nilai_kriteria = $this->nilaisubkriteria_model->get_all();
        }else{
            $this->load->model('nilaikriteria_model');
            $nilai_kriteria = $this->nilaikriteria_model->get_all();
        }

        echo json_encode(array('status' => 'ok', 'data' => $nilai_kriteria));
    }

    public function simpan_mpb()
    {        
        if($_POST["jenis"] == "subkriteria"){
            $this->load->model('nilaisubkriteria_model');
            $add = $this->nilaisubkriteria_model->inserts();
            if ($add) {
                $this->session->set_flashdata('message_success', 'Behasil menyimpan data matriks perbandingan!');                
                redirect("perhitungan?kriteria=".$_POST["kriteria_id"]."&jenis_hitung=subkriteria");
            } else {
                $this->session->set_flashdata('message_error', 'Gagal menyimpan data matriks perbandingan!');
                redirect("perhitungan?kriteria=".$_POST["kriteria_id"]."&jenis_hitung=subkriteria");
            }        
        }else{
            $this->load->model('nilaikriteria_model');
            $add = $this->nilaikriteria_model->inserts();
            if ($add) {
                $this->session->set_flashdata('message_success', 'Behasil menyimpan data matriks perbandingan!');
                redirect("perhitungan?jenis_hitung=kriteria");
            } else {
                $this->session->set_flashdata('message_error', 'Gagal menyimpan data matriks perbandingan!');
                redirect("perhitungan?jenis_hitung=kriteria");
            }
        }        
    }

    public function simpan_nilai_prior()
    {
        if($_POST["jenis"] == "subkriteria"){
            $this->load->model('subkriteria_model');

            foreach ($_POST as $key => $val) {
                if (explode('-', $key)[1] == '2') {
                    $id = explode('-', $key)[0];
                    $update = $this->subkriteria_model->update_prior($id);                
                }
            }
    
            if ($update) {
                $this->session->set_flashdata('message_success', 'Berhasil mengupdate nilai prioritas subkriteria!');
                redirect("perhitungan?jenis_hitung=subkriteria");
            } else {
                $this->session->set_flashdata('message_error', 'Gagal mengupdate nilai prioritas subkriteria!');
                redirect("perhitungan?jenis_hitung=subkriteria");
            }
        }else{
            $this->load->model('kriteria_model');

            foreach ($_POST as $key => $val) {
                if (explode('-', $key)[1] == '2') {
                    $id = explode('-', $key)[0];
                    $update = $this->kriteria_model->update_prior($id);                
                }
            }
    
            if ($update) {
                $this->session->set_flashdata('message_success', 'Berhasil mengupdate nilai prioritas kriteria!');
                redirect("perhitungan?jenis_hitung=kriteria");
            } else {
                $this->session->set_flashdata('message_error', 'Gagal mengupdate nilai prioritas kriteria!');
                redirect("perhitungan?jenis_hitung=kriteria");
            }
        }        
    }
}
