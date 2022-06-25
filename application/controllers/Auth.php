<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function login()
	{
		$this->load->view('pages/samples/login');
	}

	public function do_login()
	{
		// $this->load->model('Account');
		// $data = $this->Account->get_last_ten_entries();		
		// foreach ($data as $key => $value) {
		// 	echo $value->nip." ";
		// }		
		$this->load->model('Auth_model');
		$this->load->library('form_validation');

		$rules = $this->Auth_model->rules();
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == FALSE){
			return $this->load->view('pages/samples/login');
		}

		$username = $this->input->post('nip');
		$password = $this->input->post('password');

		if($this->Auth_model->login($username, $password)){			
			redirect('dashboard');
		} else {			
			$this->session->set_flashdata('message_login_error', 'Login Gagal, pastikan username dan passwrod benar!');
		}

		$this->load->view('pages/samples/login');
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
}
