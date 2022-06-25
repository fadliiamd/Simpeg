<?php
class Account extends CI_Model {

    public $nip;
    public $password;
    public $role;    

    public function get_last_ten_entries()
    {
            $query = $this->db->get('Account', 10);
            return $query->result();
    }
}