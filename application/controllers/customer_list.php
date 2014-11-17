<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_list extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
//        $this->load->model('Customer');
        $data['message'] = 'customer_list Page!!!';
//        $data['list_data'] = $this->Customer->get_customer();
        $this->load->view('customer_list.html', $data);
    }
}