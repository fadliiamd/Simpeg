<?php
class Account_model extends CI_Model
{

    public $nip;
    public $password;
    public $role;
    public $table = 'account';

    public function get_role($nip)
    {
        $query = $this->db->get_where('account', array('nip' => $nip));

        return $query->row()->role;
    }

    public function get_redirect_role($nip)
    {
        $role = $this->get_role($nip);

        switch ($role) {
            case "admin":
                redirect('/dashboard/admin');
                break;
            case "direktur":
                redirect('/dashboard/direktur');
                break;
            case "pegawai":
                redirect('/dashboard/pegawai');
                break;
            default:
                echo "anda siapa yah? " . $role;
        }
    }

    public function register($role)
    {
        $nip = $this->input->post('nip');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        $data_account = array(
            "nip" => $nip,
            "password" => $password,
            "role" => $role
        );        
        $this->db->insert($this->table, $data_account);

        return ($this->db->affected_rows() != 1) ? false : true;
    }
}
