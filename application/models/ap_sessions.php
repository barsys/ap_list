<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Ap_sessions extends CI_Model {

    public function check_session(){
        $this->load->library('session');

        $USER_STATUS = $this->session->userdata('USER_STATUS');
        if ($USER_STATUS != 'LOGIN') {
            redirect('login/entry', 'location');
        }
    }

}