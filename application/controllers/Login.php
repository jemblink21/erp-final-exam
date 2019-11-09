<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//memuat model user
		$this->load->model('Pengguna_model');
		$this->model = $this->Pengguna_model;
		//memuat helper URL
		$this->load->helper('url'); 
	}

	public function index() {

		if ($this->session->has_userdata('username')) {
			redirect('dashboard');
		}

		// Fungsi Login
		$valid = $this->form_validation;
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$valid->set_rules('username','Username','required');
		$valid->set_rules('password','Password','required');
		if($valid->run()) {
			
			$this->model->login($username,$password);
		}
		// End fungsi login
		$data = array(	'title'	=> 'Halaman Login - PT. GMS');
		$this->load->view('login_view',$data);
	}

	public function logout() {
		if ($this->session->has_userdata('username')) {
			$this->session->sess_destroy();
			redirect('login');
		} else {
			redirect('login');
		}
	}


}

?>
