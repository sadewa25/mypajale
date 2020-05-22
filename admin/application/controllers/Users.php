<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->model('usersModel');

    $this->isAdminLoggedIn = $this->session->userdata('isAdminLoggedIn');
    $this->userId = $this->session->userdata('userId');
    $this->userName = $this->session->userdata('userName');
  }

	public function index()
	{
    if($this->isAdminLoggedIn){
      redirect('welcome');
    }else{
      redirect('users/login');
    }
	}

  public function login()
  {
    $data = array();

    // $usersData = $this->usersModel->getUsers();
    // print_r($usersData);

    if ($this->input->post('login')) {
      $this->form_validation->set_rules('email', 'Email', 'required',
        array('required' => '%s tidak boleh kosong.'));

      $this->form_validation->set_rules('password', 'Password', 'required',
        array('required' => '%s tidak boleh kosong.'));

      if ($this->form_validation->run() == true) {
          $email = $this->input->post('email');
          $password = $this->input->post('password');
          // $status = $this->input->post('status');
          $usersData = $this->usersModel->getUsers($email,$password);
          if (sizeof($usersData->result) <= 0) {
            $data['message'] = 'Kombinasi email dan password salah';
          } else {
            $status_user = $usersData->result[0]->id_status_users;
            $id_users = $usersData->result[0]->id_user;
            $user_name = $usersData->result[0]->nama_lengkap;
            if( $status_user == 1 || $status_user == 2 || $status_user == 4){
               ///print_r($value[$i]);
               $this->session->set_userdata('userId', $id_users);
               $this->session->set_userdata('userName', $user_name);
               $this->session->set_userdata('isAdminLoggedIn', TRUE);
               redirect('welcome');
            } else{
             $data['message'] = 'Anda tidak mempunyai akses masuk.';
            }
          }
          // print_r($usersData);
          // print_r($user);
      }else{
        $data['message'] = 'Tolong isi semua kotak input.';
      }
    }
    //
    $this->load->view('static/headerlogin');
		$this->load->view('auth/login', $data);
    $this->load->view('static/footerlogin');

  }

  public function logout()
  {
    $this->session->unset_userdata('isAdminLoggedIn');
    $this->session->unset_userdata('userId');
    $this->session->sess_destroy();
    redirect('users/login');
  }

  public function data()
	{
		if($this->session->userdata('isAdminLoggedIn')){
			$this->load->view('static/header');
			$this->load->view('user/index');
			$this->load->view('static/footer');
		}else{
			redirect('users/login');
		}
	}

}
