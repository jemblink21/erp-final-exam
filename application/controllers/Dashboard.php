<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//memuat model
		// $this->load->model('Pengguna_model');
		// $this->model = $this->Pengguna_model;
		//memuat helper URL
		$this->load->helper('url'); 

		if (!$this->session->has_userdata('username')) {
			$this->session->set_flashdata('result_login','Anda belum login');
			redirect('login');
		}
	}
	
	public function index() {
		$data = array( 'title' => 'Dashboard - PT. GMS');
		$this->load->view('layout/wrapper', $data);
	}
	
	// Fungsi lain
	
}

?>