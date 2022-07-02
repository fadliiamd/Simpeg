<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		redirect('dashboard');
		// $this->load->view('partials/main-header');
		// $this->load->view('index');
		// $this->load->view('partials/main-footer');
	}

	public function uiButton()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/ui-features/buttons');
		$this->load->view('partials/main-footer');
	}

	public function uiDropdown()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/ui-features/dropdowns');
		$this->load->view('partials/main-footer');
	}

	public function uiTypo()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/ui-features/typography');
		$this->load->view('partials/main-footer');
	}

	public function formBasic()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/forms/basic_elements');
		$this->load->view('partials/main-footer');
	}

	public function chartsJs()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/charts/chartjs');
		$this->load->view('partials/main-footer');
	}

	public function tableBasic()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/tables/basic-table');
		$this->load->view('partials/main-footer');
	}

	public function iconsMdi()
	{
		$this->load->view('partials/main-header');
		$this->load->view('pages/icons/mdi');
		$this->load->view('partials/main-footer');
	}

	public function userLogin()
	{
		$this->load->view('pages/samples/login');
	}

	public function userRegister()
	{
		$this->load->view('pages/samples/register');
	}

	public function page404()
	{
		$this->load->view('pages/samples/error-404');
	}

	public function page500()
	{
		$this->load->view('pages/samples/error-500');
	}

	public function documentation()
	{
		$this->load->view('pages/documentation/documentation');
	}
}
