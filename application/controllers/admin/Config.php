<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
   	}

	public function index()
	{		
		$this->load->view('head/login.php');		
	}
	
	public function menus()
	{		
		$this->load->model('admin/v_config');
		$data['listmenu'] = $this->v_config->get_all_menu();
		$this->load->view('head/header');
		$this->load->view('head/menu');
		$this->load->view('config/config_menu.php',$data);
		$this->load->view('head/footer');
		
	}

	public function usergroups()
	{				

		$this->load->view('head/header');
		$this->load->view('head/menu');
		$this->load->view('config/config_user_group.php');
		$this->load->view('head/footer');
		
	}
}
