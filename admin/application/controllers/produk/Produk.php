<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

	public function index()
	{

		if($this->session->userdata('isAdminLoggedIn')){
			$this->load->view('static/header');
			$this->load->view('produk/index');
			$this->load->view('static/footer');
		}else{
			redirect('users/login');
		}
	}
}
