<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_list extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$data['message'] = 'customer_list Page!!!';
		$this->load->view('customer_list.html', $data);
	}
}