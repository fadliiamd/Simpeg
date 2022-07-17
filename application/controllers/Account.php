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
                $this->load->view('partials/main-header', ['title' => ": Profile Admin ".$id]);
                $this->load->view('users/admin/profile', [
                    "profiles" => $data,
                    "id" => $id
                ]);
                $this->load->view('partials/main-footer');
                break;
            case 'pegawai':
                $data = $this->pegawai_model->get_one_with_join(array('pegawai.account_nip' => $id));
                // var_dump($data);
                // die();
                $this->load->view('partials/main-header', ['title' => ": Profile Pegawai ".$id]);
                $this->load->view('users/pegawai/profile', [
                    "profiles" => $data,
                    "id" => $id
                ]);
                $this->load->view('partials/main-footer');
                break;
            case 'direktur':
                $data = $this->direktur_model->get_one_with_join(array('direktur.account_nip' => $id));
                $this->load->view('partials/main-header', ['title' => ": Profile Direktur ".$id]);
                $this->load->view('users/direktur/profile', [
                    "profiles" => $data,
                    "id" => $id
                ]);
                $this->load->view('partials/main-footer');
                break;
        }
    }

    public function edit_profile_admin($id)
    {
        $data = $this->admin_model->get_one(array('account_nip' => $id));

        $this->load->view('partials/main-header', ['title' => ': Edit My Profile']);
        $this->load->view('users/admin/profile-edit', [
            "profiles" => $data,
            "id" => $id
        ]);
        $this->load->view('partials/main-footer');
    }

    public function update_data_admin()
    {
        //form validation
        //validation form
        $this->load->library('form_validation');
        if ($this->input->post('nip') != $this->input->post('nip_old')) {            
            $is_unique = 'is_unique[account.nip]';
        } else {
            $is_unique = '';         
        }
        $this->form_validation->set_rules(
            'nip',
            'nip',
            $is_unique,
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );

        if ($this->input->post('email') != $this->input->post('email_old')) {            
            $is_unique = 'is_unique[admin.email]';
        } else {
            $is_unique = '';         
        }
        $this->form_validation->set_rules(
            'email',
            'email',
            $is_unique,
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_error', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }        

        //update everything change
        $delete = $this->admin_model->update_one($this->input->post('nip_old'));
        if ($delete) {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data admin!');            
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data admin!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /*===========
		PEGAWAI
	=============*/
    public function profile_pegawai($id)
    {
        $data = $this->pegawai_model->get_one_with_join(array('pegawai.account_nip' => $id));

        $this->load->view('partials/main-header', ['title' => ': Profile ' . $id]);
        $this->load->view('users/pegawai/profile', [
            "profiles" => $data,
            "id" => $id
        ]);
        $this->load->view('partials/main-footer');
    }
    
    public function edit_profile_pegawai($id)
    {
        $data = $this->pegawai_model->get_one_with_join(array('pegawai.account_nip' => $id));
        $jurusan = $this->jurusan_model->get_all();
        $bagian = $this->bagian_model->get_all();
        $unit = $this->unit_model->get_all();
        $jabatan = $this->jabatan_model->get_all();

        $this->load->view('partials/main-header', ['title' => ': Profile ' . $id]);
        $this->load->view('users/pegawai/profile-edit', [
            "jabatan" => $jabatan,
            "jurusan" => $jurusan,
            "bagian" => $bagian,
            "unit" => $unit,
            "profiles" => $data,
            "id" => $id
        ]);
        $this->load->view('partials/main-footer');
    }

    public function data_pegawai()
    {
        $golpang = $this->golpang_model->get_all();
        $jurusan = $this->jurusan_model->get_all();
        $bagian = $this->bagian_model->get_all();
        $unit = $this->unit_model->get_all();
        $pegawai = $this->pegawai_model->get_all_with_join();
        $jabatan = $this->jabatan_model->get_all();

        $this->load->view('partials/main-header', ['title' => ': Data Pegawai']);
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

    public function pegawai_fungsional()
    {
        $golpang = $this->golpang_model->get_all();
        $jurusan = $this->jurusan_model->get_all();
        $bagian = $this->bagian_model->get_all();
        $unit = $this->unit_model->get_all();
        $pegawai = $this->pegawai_model->get_all_with_join(["jenis_jabatan" => "fungsional"]);
        $jabatan = $this->jabatan_model->get_all(["jenis_jabatan" => "fungsional"]);

        $this->load->view('partials/main-header', ['title' => ': Data Pegawai Fungsional']);
        $this->load->view('users/admin/data_pegawai_fungsional', [
            "jabatan" => $jabatan,
            "jurusan" => $jurusan,
            "bagian" => $bagian,
            "unit" => $unit,
            "golpang" => $golpang,
            "pegawai" => $pegawai            
        ]);
        $this->load->view('partials/main-footer');
    }
    
    public function pegawai_struktural()
    {
        $golpang = $this->golpang_model->get_all();
        $jurusan = $this->jurusan_model->get_all();
        $bagian = $this->bagian_model->get_all();
        $unit = $this->unit_model->get_all();
        $pegawai = $this->pegawai_model->get_all_with_join(["jenis_jabatan" => "struktural"]);
        $jabatan = $this->jabatan_model->get_all(["jenis_jabatan" => "struktural"]);

        $this->load->view('partials/main-header', ['title' => ': Data Pegawai Struktural']);
        $this->load->view('users/admin/data_pegawai_struktural', [
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
        //validation form        
        $this->load->library('form_validation');        
        $this->form_validation->set_rules(
            'nip',
            'nip',
            'callback_nip_check|is_unique[account.nip]',
            array(
                'nip_check' => 'Pastikan NIK berjumlah 8 Angka atau NIP berjumlah 18!',
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );        
        $this->form_validation->set_rules(
            'email',
            'email',
            'is_unique[pegawai.email]',
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_error', validation_errors());
            redirect("account/data_pegawai");
        }

        //insert data
        $add = $this->pegawai_model->insert_one();
        if ($add) {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data pegawai!');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data pegawai!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function update_data_pegawai()
    {
        //form validation
        //validation form
        $this->load->library('form_validation');
        if ($this->input->post('nip') != $this->input->post('nip_old')) {            
            $is_unique = '|is_unique[account.nip]';
        } else {
            $is_unique = '';         
        }
        $this->form_validation->set_rules(
            'nip',
            'nip',
            'callback_nip_check'.$is_unique,
            array(
                'nip_check' => 'Pastikan NIK berjumlah 8 Angka atau NIP berjumlah 18!',
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );

        if ($this->input->post('email') != $this->input->post('email_old')) {            
            $is_unique = 'is_unique[pegawai.email]';
        } else {
            $is_unique = '';         
        }
        $this->form_validation->set_rules(
            'email',
            'email',
            $is_unique,
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_error', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        }        

        //update everything change
        $delete = $this->pegawai_model->update_one($this->input->post('nip_old'));
        if ($delete) {
            $this->session->set_flashdata('message_success', 'Berhasil mengupdate data pegawai!');
            // redirect("account/data_pegawai");
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('message_error', 'Gagal mengupdate data pegawai!');
            // redirect("account/data_pegawai");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete_data_pegawai()
    {
        $delete = $this->pegawai_model->delete_one($this->input->post('nip'));

        if ($delete) {
            $this->session->set_flashdata('message_success', 'Berhasil menghapus data pegawai!');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('message_error', 'Gagal menghapus data pegawai!');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /*===========
		DIREKTUR
	=============*/
    public function profile_direktur($id)
    {
        $data = $this->direktur_model->get_one_with_join(array('direktur.account_nip' => $id));

        $this->load->view('partials/main-header', ['title' => ': Profile ' . $id]);
        $this->load->view('users/direktur/profile', [
            "profiles" => $data,
            "id" => $id
        ]);
        $this->load->view('partials/main-footer');
    }

    public function data_direktur()
    {
        $golpang = $this->golpang_model->get_all();
        $jurusan = $this->jurusan_model->get_all();
        $bagian = $this->bagian_model->get_all();
        $unit = $this->unit_model->get_all();
        $direktur = $this->direktur_model->get_all_with_join();
        $jabatan = $this->jabatan_model->get_all();

        $this->load->view('partials/main-header', ['title' => ': Data Direktur']);
        $this->load->view('users/admin/data_direktur', [
            "jabatan" => $jabatan,
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
        //validation form
        $this->load->library('form_validation');        
        $this->form_validation->set_rules(
            'nip',
            'nip',
            'callback_nip_check|is_unique[account.nip]',
            array(
                'nip_check' => 'Pastikan NIK berjumlah 8 Angka atau NIP berjumlah 18!',
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );        
        $this->form_validation->set_rules(
            'email',
            'email',
            'is_unique[direktur.email]',
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_error', validation_errors());
            redirect("account/data_direktur");
        }

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
        //validation form
        $this->load->library('form_validation');
        if ($this->input->post('nip') != $this->input->post('nip_old')) {            
            $is_unique = '|is_unique[account.nip]';
        } else {
            $is_unique = '';         
        }
        $this->form_validation->set_rules(
            'nip',
            'nip',
            'callback_nip_check'.$is_unique,
            array(
                'nip_check' => 'Pastikan NIK berjumlah 8 Angka atau NIP berjumlah 18!',
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );

        if ($this->input->post('email') != $this->input->post('email_old')) {            
            $is_unique = 'is_unique[direktur.email]';
        } else {
            $is_unique = '';         
        }
        $this->form_validation->set_rules(
            'email',
            'email',
            $is_unique,
            array(
                'is_unique' => 'Mohon maaf %s telah terdaftar!'
            )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_error', validation_errors());
            redirect("account/data_direktur");
        }        

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

    /*===========
        Custom check validation
    */
    public function nip_check()
    {
        $length_nip = strlen($this->input->post('nip'));
        if ($length_nip == 8 || $length_nip == 18) {
            return true;
        } else {
            return false;
        }
    }
    
    private function _check_unique($by)
    {
        if($by != 'email'){
            if ($this->input->post($by) != $this->input->post($by.'_old')) {            
                $is_unique = '|is_unique[account.'.$by.']';
            } else {
                $is_unique = '';         
            }
        }else{
            if ($this->input->post($by) != $this->input->post($by.'_old')) {            
                $is_unique = '|is_unique[account.'.$by.']';
            } else {
                $is_unique = '';         
            }
        }    
        return $is_unique;
    }
}
