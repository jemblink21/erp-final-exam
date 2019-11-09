<?php if(! defined('BASEPATH')) exit('Akses langsung tidak diperbolehkan');

class Simple_login {
	// SET SUPER GLOBAL
	var $CI = null;
	public function __construct() {
		$this->CI =& get_instance();
	}
	public function login ($username, $password) {
		$sql = sprintf("SELECT COUNT(*) AS cnt FROM pengguna ".
						"WHERE pengguna_id = '%s' AND ".
						"pengguna_sandi = PASSWORD('%s')",
						$username, $password);
		$query = $this->CI->db->query($sql);
		if ($query->num_rows() == 1) {
			$row = $this->CI->db->query('SELECT id FROM pengguna WHERE pengguna_id = "'.$username.'"');
			$admin = $row->row();
			$id = $admin->id;
			$this->CI->session->set_userdata('username', $username);
			redirect(base_url('dashbord'));
		} else {
			$this->CI->session->set_flashdata('result_login', 
				'Username atau Password salah!');
			redirect(base_url());
		}
		return false;
	}

	public function cek_login() {
		if($this->CI->session->userdata('username') == '') {
			$this->CI->session->set_flashdata('result_login','Anda belum login');
			redirect(base_url('login'));
		}
	}

	public function logout() {
		$this->CI->session->unset_userdata('username');
		$this->CI->session->unset_userdata('id_login');
		$this->CI->session->unset_userdata('id');
		$this->CI->session->set_flashdata('result_login','Anda berhasil logout');
		redirect(base_url('login'));
	}
}