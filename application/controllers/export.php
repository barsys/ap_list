<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Ap_sessions');
        $this->Ap_sessions->check_session();
    }

    public function index() {
        $this->load->model('Export_log');
        $data['list_data'] = $this->Export_log->gets_customer();
        $this->load->view('export.html', $data);
    }

    public function exec() {

    }

}