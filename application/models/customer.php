<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Customer extends CI_Model {

    public function gets_customer(){
         $customers = $this->db->get_where('customer', array('delete_time' => NULL));
         return $customers->result();

    }

    public function get_customer($cust_id){
        $customer = $this->db->get_where('customer', array('cust_id' => $cust_id));
        return $customer->result();
    }

    public function entry($data){
        $this->db->set('company_name', $data['company_name']);
        $this->db->set('address', $data['address']);
        $this->db->set('tel', $data['tel']);
        $this->db->set('email', $data['email']);
        $this->db->set('person_in_charge', $data['person_in_charge']);
        $this->db->set('cust_status', $data['cust_status']);
        $this->db->set('create_time', date("Y/m/d H:i:s"));
        $this->db->insert('customer');
        return $this->db->insert_id();
    }

    public function edit($data){
        $this->db->set('company_name', $data['company_name']);
        $this->db->set('address', $data['address']);
        $this->db->set('tel', $data['tel']);
        $this->db->set('email', $data['email']);
        $this->db->set('person_in_charge', $data['person_in_charge']);
        $this->db->set('cust_status', $data['cust_status']);
        $this->db->where('cust_id', $data['cust_id']);
        $this->db->update('customer');
    }

    public function delete($cust_id){
        $this->db->set('delete_time', date("Y/m/d H:i:s"));
        $this->db->where('cust_id', $cust_id);
        $this->db->update('customer');
    }
}
