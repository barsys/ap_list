<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_entry extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    function index()
    {
        $data['message'] = 'customer_list Page!!!';
        $this->load->view('customer_entry.html', $data);
    }

    function entry() {
        $this->load->model('Customer');

        $data = array(
            'company_name' => $this->input->post('company_name'),
            'address' => $this->input->post('address'),
            'tel' => $this->input->post('tel'),
            'email' => $this->input->post('email'),
            'person_in_charge' => $this->input->post('person_in_charge'),
            'cust_status' => $this->input->post('cust_status')
        );

        $this->Customer->entry_customer($data);
        redirect('customer_list/index', 'location');
    }

}