<?php

class Pengguna_model extends CI_Model {

	public function __construct() {
		parent::__construct();

		//memuat library database
		$this->load->database();
	}
	public function login ($username, $password) {
		$query = $this->db->query("SELECT pengguna_nama FROM pengguna ".
						"WHERE pengguna_id = '$username' AND ".
						"pengguna_sandi = PASSWORD('$password')");
		if ($query->num_rows() == 1) {
			foreach ($query->result() as $row)
			{
				$this->session->set_userdata('nama', $row->pengguna_nama);
			}
			$this->session->set_userdata('username', $username);
			redirect(base_url('index.php/dashboard'));
		} else {
			$this->session->set_flashdata('result_login', 
				'Username atau Password salah!');
			redirect(base_url());
		}
		return false;
	}

	// public function cek_login() {
	// 	if($this->session->userdata('username') == '') {
	// 		$this->session->set_flashdata('result_login','Anda belum login');
	// 		redirect(base_url('login'));
	// 	}
	// }

	public function ganti_nama ($username, $nama) {
		$query = $this->db->query("UPDATE pengguna SET
				pengguna_nama='$nama' WHERE pengguna_id='$username'");
		if ($query) {
			$this->session->set_userdata('nama', $nama);
			$this->session->set_flashdata('pesan_user', 'Nama Berhasil dirubah.');
			redirect(base_url('index.php/user'));
		}
	}

	public function ganti_pass ($username, $password_lama, $password_baru) {
		$query = $this->db->query("UPDATE pengguna SET 
				pengguna_sandi=PASSWORD('$password_baru') 
				WHERE pengguna_id='$username' AND pengguna_sandi=PASSWORD('$password_lama');");
		$afftectedRows = $this->db->affected_rows();

		if ($afftectedRows == 1) {
			$this->session->set_flashdata('pesan_pass', 
				'Password berhasil dirubah.');
				redirect(base_url('index.php/user'));
		} else {
			$this->session->set_flashdata('pesan_pass_error', 
				'Terjadi kesalahan, silahkan coba kembali!');
				redirect(base_url('index.php/user'));
		}
	}
}