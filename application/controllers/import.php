<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Ap_sessions');
        $this->Ap_sessions->check_session();
    }

    public function index() {
            $this->load->view('import.html');
        }

    public function exec() {
        setlocale(LC_ALL,'ja_JP.UTF-8');
        $file_rows = $this->open_file($_FILES['import_file']['tmp_name']);

        switch($this->input->post('type')) {
            case "cust":
                $this->cust_import();

                break;

            case "ap":

                $this->ap_import($file_rows);
                break;

            default:
                $this->all_import();

        }


        $this->load->view('import.html');
    }

    private function all_import() {

    }

    private function cust_import() {

    }

    private function ap_import($rows) {
        $this->load->model('Ap');
        $this->load->helper(array('form'));
        $this->load->library('form_validation');

        foreach ($rows as $row) {
            $data = array(
                'part_no'                 => isset($row[0])?$row[0]:"",
                'serial_no'               => isset($row[1])?$row[1]:"",
                'qr_code'                 => isset($row[2])?$row[2]:"",
                'mac_address'             => isset($row[3])?$row[3]:"",
                'cust_id'                 => isset($row[4])?$row[4]:"",
                'latitude'                => isset($row[5])?$row[5]:"",
                'longitude'               => isset($row[6])?$row[6]:"",
                'global_ip'               => isset($row[7])?$row[7]:"",
                'start_licence_date'      => isset($row[8])?$row[8]:"",
                'start_operation_date'    => isset($row[9])?$row[9]:"",
                'connection_confirm_date' => isset($row[10])?$row[10]:"",
                'ap_status'               => isset($row[11])?$row[11]:"",
                'comment'                 => isset($row[12])?$row[12]:""
            );



        //$this->form_validation->set_rules('part_no', 'partNo.', 'required');
        //         $this->form_validation->set_rules('address', '住所', 'required');
        //         $this->form_validation->set_rules('tel', '電話番号', 'required');
        //         $this->form_validation->set_rules('email', 'メールアドレス', 'required');
        //         $this->form_validation->set_rules('person_in_charge', '担当者', 'required');
        //         $this->form_validation->set_rules('cust_status', 'ステータス', 'required');

//         if ($this->form_validation->run())
//         {
             $this->Ap->entry($data);

//         } else {
//             $this->load->view('ap_entry.html');
//         }
        }
        redirect('ap_info/index', 'location');
    }

    private function open_file($file) {
        $fp = fopen($file, 'r');
        $line = fgetcsv($fp);
        $buf = file_get_contents($file);
        $buf = mb_convert_encoding($buf, 'UTF-8', 'sjis-win');
        $buf = preg_replace("/\r\n|\r|\n/","\n",$buf);
        $fp = tmpfile();
        fwrite($fp, $buf);
        rewind($fp);
        $row = NULL;
        while( $line = fgetcsv($fp)){
            $rows[] = $line;
        }
        fclose($fp);
        return $rows;
    }

}