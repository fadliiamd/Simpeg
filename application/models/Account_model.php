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

    public function get_num_rows()
    {
        $query = $this->db->get($this->table);

        return $query->num_rows();
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

    public function update_one($id)
    {
        $this->db->trans_start();
        $nip = $this->input->post('nip');
        if (!(is_null($this->input->post('password')))) {
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

            $data = array(
                "nip" => $nip,
                "password" => $password
            );
        } else {
            $data = array(
                "nip" => $nip
            );
        }

        $this->db->where('nip', $id);
        $this->db->update($this->table, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }
        
        return true;
    }
}
