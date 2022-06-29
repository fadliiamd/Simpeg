<?php

class Errors extends CI_Controller  {
    public function __construct() {
        parent::__construct();
    }

    public function show_404(){
        $this->output->set_status_header('404');

        // Make sure you actually have some view file named 404.php
        $this->load->view('errors/error-404');
    }

    public function show_403(){
        $this->output->set_status_header('403');

        // Make sure you actually have some view file named 404.php
        $this->load->view('errors/error-403');
    }
}