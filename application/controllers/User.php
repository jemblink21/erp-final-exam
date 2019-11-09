<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//memuat helper URL
		$this->load->helper('url'); 
		$this->load->model('Pengguna_model');
		$this->model = $this->Pengguna_model;

		if (!$this->session->has_userdata('username')) {
			$this->session->set_flashdata('result_login','Anda belum login');
			redirect('login');
		}
	}

	public function index() {
		$data = array( 'title' => 'Profile User - PT. GMS');
		$this->load->view('layout/wrapper_user', $data);

		// Fungsi Ganti Nama
		$valid = $this->form_validation;
		$nama = $this->input->post('nama');
		$valid->set_rules('nama','Nama','required');
		if($valid->run()) {
			$username = $this->session->userdata('username');
			$this->model->ganti_nama($username, $nama);
		}

		if($this->input->post('password_lama')) {
			$password_lama = $this->input->post('password_lama');
			$password_baru = $this->input->post('password_baru');
			$username = $this->session->userdata('username');
			$this->model->ganti_pass($username, $password_lama, $password_baru);
		}
	}
	
	// Fungsi lain
	
}

?>