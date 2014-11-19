<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_info extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->model('Customer');
        $data['list_data'] = $this->Customer->get_customer();

        $this->load->view('customer_list.html', $data);
    }

    public function display_entry()
    {
        $this->load->view('customer_entry.html');
    }

   public function entry() {
        $this->load->model('Customer');

        $data = array(
                        'company_name' => $this->input->post('company_name'),
                        'address' => $this->input->post('address'),
                        'tel' => $this->input->post('tel'),
                        'email' => $this->input->post('email'),
                        'person_in_charge' => $this->input->post('person_in_charge'),
                        'cust_status' => $this->input->post('cust_status')
        );

        $this->load->helper(array('form'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('company_name', '会社名', 'required');
        $this->form_validation->set_rules('address', '住所', 'required');
        $this->form_validation->set_rules('tel', '電話番号', 'required');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required');
        $this->form_validation->set_rules('person_in_charge', '担当者', 'required');
        $this->form_validation->set_rules('cust_status', 'ステータス', 'required');

        if ($this->form_validation->run())
        {
            $this->Customer->entry_customer($data);
            redirect('customer_info/index', 'location');
        } else {
            $this->load->view('customer_entry.html');
        }

    }

}