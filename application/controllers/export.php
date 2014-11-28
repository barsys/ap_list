<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export extends CI_Controller {

    // export用途
    const USE_DATA_HOTEL  = 1;
    const USE_CLOUDBERRY  = 2;


    // export種類
    const TYPE_ALL       = 1; // 全件
    const TYPE_DIFFERENCE= 2; // 差分

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Ap_sessions');
        $this->Ap_sessions->check_session();
    }

    public function index() {
        $this->load->model('Export_log');
        $data['list_data'] = $this->Export_log->gets_export_log();
        $this->load->view('export.html', $data);
    }

    public function exec() {

        $use  = NULL;
        $type = $this->input->post('type');

        $file_name = NULL;

        if(empty($this->input->post('cloud_export'))){
            // データホテル処理
            $use = self::USE_DATA_HOTEL;

            // CSVファイル名の設定
            $dir_path = "./application/export_file/";
            $type_name = $type == self::TYPE_ALL? "full" : "diff";
            $file_name = "dh_" . $type_name . "_export_" . date("Ymd_His") . ".csv";
            $csv_file = $dir_path . $file_name;

            // CSVデータの内容
            $csv_data = $this->get_dh_data($type, $use);

            // CSVファイル作成
            $this->make_csv_file($use, $type, $csv_file, $csv_data);

        } else {

            // クラウドベリー処理
            $use = self::USE_CLOUDBERRY;

            // CSVファイル名の設定
            $dir_path = "./application/export_file/";
            $type_name = $type == self::TYPE_ALL? "full" : "diff";
            $file_name = "cloud_" .$type_name . "_export_" . date("Ymd_His") . ".csv";
            $csv_file = $dir_path . $file_name;

            // CSVデータの内容
            $csv_data = $this->get_Cloudberry_data($type ,$use);

            // CSVファイル作成
            $this->make_csv_file($use, $type, $csv_file, $csv_data);
        }

        // log登録
        $user_id = $this->session->userdata('USER_ID');
        $this->export_log_entry($file_name, $use, $type, $user_id);

        // ファイルダウンロード
        $this->load->helper('download');
        force_download($file_name, file_get_contents($csv_file));
        redirect('export/index', 'location');

    }

    // クラウドベリーのデータ取得
    private function get_Cloudberry_data($type, $use){
        $this->load->model('Ap');
        $result = NULL;
        if($type == self::TYPE_ALL){
            $result = $this->Ap->get_cloudberry_info_all();
        } else {
            $this->load->model('Export_log');
            $new_data = $this->Export_log->get_export_log_new_data($use);
            $result = $this->Ap->get_cloudberry_info_difference($new_data);
        }
        return $result;
    }

    // データホテルのデータ取得
    private function get_dh_data($type, $use){
        $this->load->model('Ap');
        $result = NULL;
        if($type == self::TYPE_ALL){
            $result = $this->Ap->get_dh_info_all();
        } else {
            $this->load->model('Export_log');
            $new_data = $this->Export_log->get_export_log_new_data($use);
            $result = $this->Ap->get_dh_info_difference($new_data);
        }
        return $result;
    }

    // ログ登録
    private function export_log_entry($file_name, $use, $type, $user_id) {
        $this->load->model('Export_log');
        $this->Export_log->entry($file_name, $use, $type, $user_id);
    }

    // ファイル作成
    private function make_csv_file($use, $type, $csv_file, $csv_data) {
        // CSVデータの初期化
        $csv = "";

        // CSVデータの内容
        //$result = $this->get_Cloudberry_data($type);

        // CSVファイルを追記モードで開く
        $fp = fopen($csv_file, 'ab');

        // CSVファイルを排他ロックする
        flock($fp, LOCK_EX);

        // CSVファイルの中身を空にする
        // 既存の内容に追記していく場合は不要
        ftruncate($fp, 0);

        foreach ($csv_data as $key => $row){
            if($use == self::USE_CLOUDBERRY) {
               fputcsv($fp, array($row->qr_code,$row->serial_no));
            } else {
                fputcsv($fp, array($row->serial_no));
            }
        }

        // CSVファイルを閉じる
        fclose($fp);
    }
}