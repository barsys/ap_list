<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('session');
  }

  function entry() {
    $this->load->view('login.html');
  }

  function logout() {
    $this->session->sess_destroy();
    redirect('login/index', 'location');
  }

  function is_login() {
    $USER_STATUS = $this->session->userdata('USER_STATUS');
    if ($USER_STATUS != 'LOGIN') {
      redirect('login/entry', 'location');
    }
  }

  public function exec_login() {
    log_message('debug', "exec_login");
    $account =  $this->input->post('account', true);
    $password = $this->input->post('password', true);

    if ( ($account === 'boo')&&($password === 'foo') ) {
      log_message('debug', "TRUE");
      $this->session->set_userdata('USERNAME', $account);
      $this->session->set_userdata('USER_STATUS', 'LOGIN');
      redirect('login/index', 'location');
    } else {
      log_message('debug', "ELSE");
      $this->load->view('login.html');
    }
  }

  public function index() {
    $this->is_login();
    redirect('customer_list/index', 'location');
    //$this->load->view('customer_list.html');
  }
}
