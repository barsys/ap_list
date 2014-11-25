<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ap_info extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->model('Ap');
        $data['list_data'] = $this->Ap->gets_ap();

        // ステータス日本語表記？
//         foreach ($data['list_data'] as $key => $row){
//             print_r($row->cust_status);
//         }

        $this->load->view('ap_list.html', $data);
    }

     public function display_entry()
     {
         $this->load->view('ap_entry.html');
     }

    public function display_edit()
    {
        $this->load->model('Ap');
        $ap_id = $this->input->get('ap_id');
        $ap = $this->Ap->get_ap($ap_id);

        $data['edit'] = true;
        $data['ap_id'] = $ap['0']->ap_id;
        $data['part_no'] = $ap['0']->part_no;
        $data['serial_no'] = $ap['0']->serial_no;
        $data['qr_code'] = $ap['0']->qr_code;
        $data['mac_address'] = $ap['0']->mac_address;
        $data['cust_id'] = $ap['0']->cust_id;
        $data['latitude'] = $ap['0']->latitude;
        $data['longitude'] = $ap['0']->longitude;
        $data['global_ip'] = $ap['0']->global_ip;
        $data['start_licence_date'] = $ap['0']->start_licence_date;
        $data['start_operation_date'] = $ap['0']->start_operation_date;
        $data['connection_confirm_date'] = $ap['0']->connection_confirm_date;
        $data['ap_status'] = $ap['0']->ap_status;
        $data['comment'] = $ap['0']->comment;


        $this->load->view('ap_entry.html', $data);
    }



   public function entry() {
        $this->load->model('Ap');

        $data = array(
                        'part_no'                 => $this->input->post('part_no'),
                        'serial_no'               => $this->input->post('serial_no'),
                        'qr_code'                 => $this->input->post('qr_code'),
                        'mac_address'             => $this->input->post('mac_address'),
                        'cust_id'                 => $this->input->post('cust_id'),
                        'latitude'                => $this->input->post('latitude'),
                        'longitude'               => $this->input->post('longitude'),
                        'global_ip'               => $this->input->post('global_ip'),
                        'start_licence_date'      => $this->input->post('start_licence_date'),
                        'start_operation_date'    => $this->input->post('start_operation_date'),
                        'connection_confirm_date' => $this->input->post('connection_confirm_date'),
                        'ap_status'               => $this->input->post('ap_status'),
                        'comment'                 => $this->input->post('comment'),
        );

        $this->load->helper(array('form'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('part_no', 'partNo.', 'required');
//         $this->form_validation->set_rules('address', '住所', 'required');
//         $this->form_validation->set_rules('tel', '電話番号', 'required');
//         $this->form_validation->set_rules('email', 'メールアドレス', 'required');
//         $this->form_validation->set_rules('person_in_charge', '担当者', 'required');
//         $this->form_validation->set_rules('cust_status', 'ステータス', 'required');

        if ($this->form_validation->run())
        {
            $this->Ap->entry($data);
            redirect('ap_info/index', 'location');
        } else {
            $this->load->view('ap_entry.html');
        }

    }

    public function edit() {
        $this->load->model('Ap');

        $data = array(
                        'ap_id'                   => $this->input->post('ap_id'),
                        'part_no'                 => $this->input->post('part_no'),
                        'serial_no'               => $this->input->post('serial_no'),
                        'qr_code'                 => $this->input->post('qr_code'),
                        'mac_address'             => $this->input->post('mac_address'),
                        'cust_id'                 => $this->input->post('cust_id'),
                        'latitude'                => $this->input->post('latitude'),
                        'longitude'               => $this->input->post('longitude'),
                        'global_ip'               => $this->input->post('global_ip'),
                        'start_licence_date'      => $this->input->post('start_licence_date'),
                        'start_operation_date'    => $this->input->post('start_operation_date'),
                        'connection_confirm_date' => $this->input->post('connection_confirm_date'),
                        'ap_status'               => $this->input->post('ap_status'),
                        'comment'                 => $this->input->post('comment'),
        );

        $this->load->helper(array('form'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('part_no', 'PartNo.', 'required');
//         $this->form_validation->set_rules('address', '住所', 'required');
//         $this->form_validation->set_rules('tel', '電話番号', 'required');
//         $this->form_validation->set_rules('email', 'メールアドレス', 'required');
//         $this->form_validation->set_rules('person_in_charge', '担当者', 'required');
//         $this->form_validation->set_rules('cust_status', 'ステータス', 'required');
        if ($this->form_validation->run())
        {
            $this->Ap->edit($data);
            redirect('ap_info/index', 'location');
        } else {
            $this->load->view('ap_entry.html');
        }
    }


    public function delete() {
        $this->load->model('Ap');
        $this->Ap->delete($this->input->get('ap_id'));
        redirect('ap_info/index', 'location');
    }


}