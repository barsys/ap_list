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
        $data['list_data'] = $this->Customer->gets_customer();

        // ステータス日本語表記？
//         foreach ($data['list_data'] as $key => $row){
//             print_r($row->cust_status);
//         }

        $this->load->view('customer_list.html', $data);
    }

    public function display_entry()
    {
        $this->load->view('customer_entry.html');
    }

    public function display_edit()
    {
        $this->load->model('Customer');
        $cust_id = $this->input->get('cust_id');
        $customer = $this->Customer->get_customer($cust_id);

        $data['edit'] = true;
        $data['cust_id'] = $customer['0']->cust_id;
        $data['company_name'] = $customer['0']->company_name;
        $data['address'] = $customer['0']->address;
        $data['tel'] = $customer['0']->tel;
        $data['email'] = $customer['0']->email;
        $data['person_in_charge'] = $customer['0']->person_in_charge;
        $data['cust_status'] = $customer['0']->cust_status;

        $this->load->view('customer_entry.html', $data);
    }



   public function entry() {
        $this->load->model('Customer');

        $data = array(
                        'company_name'     => $this->input->post('company_name'),
                        'address'          => $this->input->post('address'),
                        'tel'              => $this->input->post('tel'),
                        'email'            => $this->input->post('email'),
                        'person_in_charge' => $this->input->post('person_in_charge'),
                        'cust_status'      => $this->input->post('cust_status')
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
            $this->Customer->entry($data);
            redirect('customer_info/index', 'location');
        } else {
            $this->load->view('customer_entry.html');
        }

    }

    public function edit() {
        $this->load->model('Customer');

        $data = array(
                        'cust_id'          => $this->input->post('cust_id'),
                        'company_name'     => $this->input->post('company_name'),
                        'address'          => $this->input->post('address'),
                        'tel'              => $this->input->post('tel'),
                        'email'            => $this->input->post('email'),
                        'person_in_charge' => $this->input->post('person_in_charge'),
                        'cust_status'      => $this->input->post('cust_status')
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
            $this->Customer->edit($data);
            redirect('customer_info/index', 'location');
        } else {
            $this->load->view('customer_entry.html');
        }
    }


    public function delete() {
        $this->load->model('Customer');
        $this->Customer->delete($this->input->get('cust_id'));
        redirect('customer_info/index', 'location');
    }


}