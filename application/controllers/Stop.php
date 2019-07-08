<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stop extends CI_Controller {

	// private $user=array();
	public function __construct()
	{
		parent::__construct();
		
		if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']       = $session_data['id'];
            $this->user['username']     = $session_data['username'];
            $this->user['user_group']     = $session_data['user_group'];
            $this->user['user_password']     = $session_data['user_password'];

            
        }else{
         redirect(base_url().'login', 'refresh');
        }
	}

	public function index()
	{
		$this->load->view('403');
		
		
	}
}
		

