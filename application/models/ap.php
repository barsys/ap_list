<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Ap extends CI_Model {

    public function gets_ap(){
         $ap = $this->db->get_where('ap', array('delete_time' => NULL));
         return $ap->result();

    }

    public function get_ap($ap_id){
        $ap = $this->db->get_where('ap', array('ap_id' => $ap_id));
        return $ap->result();
    }

    public function entry($data){
        $this->db->set('part_no', $data['part_no']);
        $this->db->set('serial_no', $data['serial_no']);
        $this->db->set('qr_code', $data['qr_code']);
        $this->db->set('mac_address', $data['mac_address']);
        $this->db->set('cust_id', $data['cust_id']);
        $this->db->set('latitude', $data['latitude']);
        $this->db->set('longitude', $data['longitude']);
        $this->db->set('global_ip', $data['global_ip']);
        $this->db->set('start_licence_date', $data['start_licence_date']);
        $this->db->set('start_operation_date', $data['start_operation_date']);
        $this->db->set('connection_confirm_date', $data['connection_confirm_date']);
        $this->db->set('ap_status', $data['ap_status']);
        $this->db->set('comment', $data['comment']);
        $this->db->set('create_time', date("Y/m/d H:i:s"));
        $this->db->insert('ap');
    }

    public function edit($data){
        $this->db->set('part_no', $data['part_no']);
        $this->db->set('serial_no', $data['serial_no']);
        $this->db->set('qr_code', $data['qr_code']);
        $this->db->set('mac_address', $data['mac_address']);
        $this->db->set('cust_id', $data['cust_id']);
        $this->db->set('latitude', $data['latitude']);
        $this->db->set('longitude', $data['longitude']);
        $this->db->set('global_ip', $data['global_ip']);
        $this->db->set('start_licence_date', $data['start_licence_date']);
        $this->db->set('start_operation_date', $data['start_operation_date']);
        $this->db->set('connection_confirm_date', $data['connection_confirm_date']);
        $this->db->set('ap_status', $data['ap_status']);
        $this->db->set('comment', $data['comment']);
        $this->db->where('ap_id', $data['ap_id']);
        $this->db->update('ap');
    }

    public function delete($ap_id){
        $this->db->set('delete_time', date("Y/m/d H:i:s"));
        $this->db->where('ap_id', $ap_id);
        $this->db->update('ap');
    }
}
