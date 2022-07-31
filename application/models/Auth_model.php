<?php

class Auth_model extends CI_Model
{
	private $_table = "account";
	const SESSION_KEY = 'nip';

	public function rules()
	{
		return [
			[
				'field' => 'nip',
				'label' => 'NIP',
				'rules' => 'required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|max_length[255]'
			]
		];
	}

	public function login($nip, $password)
	{		
		$this->db->where('nip', $nip);
		$query = $this->db->get($this->_table);
		$user = $query->row();

		// cek apakah user sudah terdaftar?
		if (!$user) {
			return FALSE;
		}		

		// cek apakah passwordnya benar?
		if (!password_verify($password, $user->password)) {
			return FALSE;
		}
		// cek apakah status akun pegawai masih aktif?
		if($user->role === 'pegawai'){			
			$this->db->join('jabatan', 'jabatan.id = pegawai.jabatan_id', 'left');
			$this->db->where('account_nip', $nip);			
			$query = $this->db->get('pegawai');
			$pegawai = $query->row();
			if ($pegawai->status_kerja !== 'aktif'){
				return FALSE;
			}
			$this->session->set_userdata('jabatan', $pegawai->nama_jabatan);
			$this->session->set_userdata('nama_jabatan', $pegawai->nama_jabatan);
			$this->session->set_userdata('jurusan_id', $pegawai->jurusan_id);
			$this->session->set_userdata('jenis_jabatan', $pegawai->jenis_jabatan);
		}		

		// cek apakah status akun direktur masih aktif?
		if($user->role === 'direktur'){			
			$this->db->join('jabatan', 'jabatan.id = direktur.jabatan_id', 'left');
			$this->db->where('account_nip', $nip);			
			$query = $this->db->get('direktur');
			$direktur = $query->row();
			$this->session->set_userdata('jabatan', $direktur->nama_jabatan);
			$this->session->set_userdata('nama_jabatan', $direktur->nama_jabatan);
			$this->session->set_userdata('jenis_jabatan', $direktur->jenis_jabatan);
		}

		// bikin session
		$this->session->set_userdata([self::SESSION_KEY => $user->nip,'role' => $user->role, 'nama' => $user->nama ]);
		// $this->_update_last_login($user->nip);

		return $this->session->has_userdata(self::SESSION_KEY);
	}

	public function current_user()
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}

		$user_id = $this->session->userdata(self::SESSION_KEY);
		$query = $this->db->get_where($this->_table, ['nip' => $user_id]);
		return $query->row();
	}

	public function logout()
	{		
		$this->session->unset_userdata(self::SESSION_KEY);
		session_destroy();
		return !$this->session->has_userdata(self::SESSION_KEY);
	}

	private function _update_last_login($id)
	{
		$data = [
			'last_login' => date("Y-m-d H:i:s"),
		];

		return $this->db->update($this->_table, $data, ['id' => $id]);
	}
}