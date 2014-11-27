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
        $user_name = $this->input->post('account', true);
        $password  = $this->input->post('password', true);
        $user_id = $this->check_user($user_name, $password);
        if ($user_id) {
            $this->session->set_userdata('USERNAME', $user_name);
            $this->session->set_userdata('USER_ID', $user_id);
            $this->session->set_userdata('USER_STATUS', 'LOGIN');
            redirect('login/index', 'location');
        } else {
          $this->load->view('login.html');
        }
    }

    public function index() {
        $this->is_login();
        redirect('customer_info/index', 'location');
    }

    public function check_user($user_name, $password){
        $this->load->model('User');
        $user_data = $this->User->get_user_by_user_name($user_name);

        if(!empty($user_data) && $user_data['0']->password === md5($password)) {
            return $user_data['0']->user_id;
        }

        return false;
    }
}
