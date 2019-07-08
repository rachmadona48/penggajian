<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
   	}

	public function index()
	{		
		$this->load->view('head/login.php');		
	}
	
	public function cek_login()
	{		
		
		// $this->load->view('head/login.php');
	}
}
