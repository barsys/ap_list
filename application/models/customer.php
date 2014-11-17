<?php

/**
 * お知らせ情報
 */
class Customer extends MY_Model {
    public function get_customer(){
        return $this->db->get('customer');
    }
}
