<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Customer extends CI_Model {

    public function get_customer(){
         $test = $this->db->get('customer');
         return $test->result();

    }


    public function entry_customer($data){
        $this->db->set('company_name', $data['company_name']);
        $this->db->set('address', $data['address']);
        $this->db->set('tel', $data['tel']);
        $this->db->set('email', $data['email']);
        $this->db->set('person_in_charge', $data['person_in_charge']);
        $this->db->set('cust_status', $data['cust_status']);

        $this->db->insert('customer');

    }

}
