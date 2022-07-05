<?php

class Authentication extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->load->model('auth_model');

		if (!$this->auth_model->current_user()) {
			redirect('auth/login');
		}
    }

}

class Roles extends Authentication {
    
    public function __construct($array_role) {
        parent::__construct();
        
        $nip = $this->session->userdata('nip');
        $isAccess = false;
		$this->load->model('account_model');

        foreach ($array_role as $value) {
            if ($this->account_model->get_role($nip) == $value) {
                $isAccess = true;
            }
        }		

        if(!$isAccess) {
            redirect('/errors/show_403');
        }
    }

}
class Admin extends Authentication {
    
    public function __construct() {
        parent::__construct();
        
        $nip = $this->session->userdata('nip');
		$this->load->model('account_model');

		if ($this->account_model->get_role($nip) != 'admin') {
            redirect('/errors/show_403');
        }
    }

}

class Direktur extends Authentication {
    
    public function __construct() {
        parent::__construct();
        
        $nip = $this->session->userdata('nip');
		$this->load->model('account_model');

		if ($this->account_model->get_role($nip) != 'direktur') {
            redirect('/errors/show_403');
        }
    }

}

class Pegawai extends Authentication {
    
    public function __construct() {
        parent::__construct();
        
        $nip = $this->session->userdata('nip');
		$this->load->model('account_model');

		if ($this->account_model->get_role($nip) != 'pegawai') {
            redirect('/errors/show_403');
        }
    }

}