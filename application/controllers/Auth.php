<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function login()
	{
		$this->load->view('pages/samples/login');
	}

	public function do_login()
	{
		$this->load->model('auth_model');
		$this->load->model('account_model');
		$this->load->library('form_validation');

		$rules = $this->auth_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			return $this->load->view('pages/samples/login');
		}

		$username = $this->input->post('nip');
		$password = $this->input->post('password');

		if ($this->auth_model->login($username, $password)) {
			$this->account_model->get_redirect_role($username);
		} else {
			$this->session->set_flashdata('message_login_error', 'Login gagal!');
			redirect("auth/login");
		}		
	}

	public function register()
	{
		$this->load->view('pages/samples/register');
	}

	public function logout()
	{
		$this->load->model('auth_model');
		$this->auth_model->logout();
		redirect(site_url());
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
            redirect("auth/login");
        }

        //insert data
        $add = $this->pegawai_model->insert_one();
        if ($add) {
            $this->session->set_flashdata('message_success', 'Behasil menambahkan data pegawai!');
            redirect("auth/login");
        } else {
            $this->session->set_flashdata('message_error', 'Gagal menambahkan data pegawai!');
            redirect("auth/login");
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
        if ($by != 'email') {
            if ($this->input->post($by) != $this->input->post($by . '_old')) {
                $is_unique = '|is_unique[account.' . $by . ']';
            } else {
                $is_unique = '';
            }
        } else {
            if ($this->input->post($by) != $this->input->post($by . '_old')) {
                $is_unique = '|is_unique[account.' . $by . ']';
            } else {
                $is_unique = '';
            }
        }
        return $is_unique;
    }
}
