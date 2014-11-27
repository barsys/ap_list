<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Export_log extends CI_Model {

    public function gets_export_log(){
         $logs = $this->db->get_where('export_log', array('delete_time' => NULL));
         return $logs->result();

   }

    public function get_export_log_new_data($use) {
        $this->db->order_by("create_time", "desc");
        $this->db->limit(1);
        $this->db->where('use', $use);
        $this->db->where('delete_time IS NULL');
        $result = $this->db->get('export_log');
        return $result->result();
    }

    public function entry($file_name, $use, $type, $user_id){
        $this->db->set('file_name', $file_name);
        $this->db->set('use', $use);
        $this->db->set('type', $type);
        $this->db->set('user_id', $user_id);
        $this->db->set('export_time', date("Y/m/d H:i:s"));
        $this->db->set('create_time', date("Y/m/d H:i:s"));
        $this->db->insert('export_log');
    }
}
