<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends Roles
{

    public function __construct()
    {
        parent::__construct(['admin', 'direktur', 'pegawai']);
        $this->load->model([
            'jurusan_model',
            'bagian_model',
            'unit_model',
            'golpang_model',
            'pegawai_model',
            'jabatan_model',
            'direktur_model',
            'admin_model'
        ]);
    }

    public function profile($id)
    {
        switch ($_SESSION['role']) {
            case 'admin':
                $data = $this->admin_model->get_one(array('account_nip' => $id));
                $this->load->view('partials/main-header');
                $this->load->view('users/admin/profile', [
                    "profiles" => $data
                ]);
                $this->load->view('partials/main-footer');
                break;
            case 'pegawai':
                $data = $this->pegawai_model->get_one_with_join(array('pegawai.account_nip' => $id));                
                // var_dump($data);
                // die();
                $this->load->view('partials/main-header');
                $this->load->view('users/pegawai/profile', [
                    "profiles" => $data
                ]);                
                $this->load->view('partials/main-footer');
                break;
            case 'direktur':
                $data = $this->direktur_model->get_one(array('account_nip' => $id));
                $this->load->view('partials/main-header');
                $this->load->view('users/direktur/profile', [
                    "profiles" => $data
                ]);
                $this->load->view('partials/main-footer');
                break;
        }
    }

    /*===========
		PEGAWAI
	=============*/
    public function data_pegawai()
    {
        $golpang = $this->golpang_model->get_all();
        $jurusan = $this->jurusan_model->get_all();
        $bagian = $this->bagian_model->get_all();
        $unit = $this->unit_model->get_all();
        $pegawai = $this->pegawai_model->get_all_with_join();
        $jabatan = $this->jabatan_model->get_all();

        $this->load->view('partials/main-header');
        $this->load->view('users/admin/data_pegawai', [
            "jabatan" => $jabatan,
            "jurusan" => $jurusan,
            "bagian" => $bagian,
            "unit" => $unit,
            "golpang" => $golpang,
            "pegawai" => $pegawai
        ]);
        $this->load->view('partials/main-footer');
    }

    public function create_data_pegawai()
    {
        $add = $this->pegawai_model->insert_one();

        if ($add) {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data pegawai!');
            redirect("account/data_pegawai");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data pegawai!');
            redirect("account/data_pegawai");
        }
    }

    public function update_data_pegawai()
    {
        $delete = $this->pegawai_model->update_one($this->input->post('nip_old'));

        if ($delete) {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data pegawai!');
            redirect("account/data_pegawai");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data pegawai!');
            redirect("account/data_pegawai");
        }
    }

    public function delete_data_pegawai()
    {
        $delete = $this->pegawai_model->delete_one($this->input->post('nip'));

        if ($delete) {
            $this->session->set_flashdata('message_success', 'Berhasil menghapus data pegawai!');
            redirect("account/data_pegawai");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data pegawai!');
            redirect("account/data_pegawai");
        }
    }

    /*===========
		DIREKTUR
	=============*/
    public function data_direktur()
    {
        $golpang = $this->golpang_model->get_all();
        $jurusan = $this->jurusan_model->get_all();
        $bagian = $this->bagian_model->get_all();
        $unit = $this->unit_model->get_all();
        $direktur = $this->direktur_model->get_all();

        $this->load->view('partials/main-header');
        $this->load->view('users/admin/data_direktur', [
            "jurusan" => $jurusan,
            "bagian" => $bagian,
            "unit" => $unit,
            "golpang" => $golpang,
            "direktur" => $direktur
        ]);
        $this->load->view('partials/main-footer');
    }

    public function create_data_direktur()
    {
        $this->load->model('direktur_model');
        $add = $this->direktur_model->insert_one();

        if ($add) {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data direktur!');
            redirect("account/data_direktur");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data direktur!');
            redirect("account/data_direktur");
        }
    }

    public function update_data_direktur()
    {
        $this->load->model('direktur_model');
        $delete = $this->direktur_model->update_one($this->input->post('nip_old'));

        if ($delete) {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data direktur!');
            redirect("account/data_direktur");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data direktur!');
            redirect("account/data_direktur");
        }
    }

    public function delete_data_direktur()
    {
        $this->load->model('direktur_model');
        $delete = $this->direktur_model->delete_one($this->input->post('nip'));

        if ($delete) {
            $this->session->set_flashdata('message_success', 'Berhasil menghapus data direktur!');
            redirect("account/data_direktur");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data direktur!');
            redirect("account/data_direktur");
        }
    }
}
