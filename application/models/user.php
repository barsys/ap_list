<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User extends CI_Model {

    public function get_user_by_user_name($user_name){
        $user = $this->db->get_where('user', array('user_name' => $user_name));
        return $user->result();
    }
}