<?php
class Account_model extends CI_Model
{

    public $nip;
    public $password;
    public $role;

    public function get_last_ten_entries()
    {
        $query = $this->db->get('account', 10);
        return $query->result();
    }

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
}
