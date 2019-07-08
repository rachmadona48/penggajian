<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Batch extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
		$this->load->library('format_uang');
        $this->load->helper('url');    
        $this->load->model('admin/m_batch');

        $this->load->helper('url');
		$this->load->library('session');
		$this->load->library('infopegawai');
		$this->load->model('mreferensi','referensi');
		$this->load->model('admin/v_pegawai','mdl');
		$this->load->model('hist/v_jabatanf_hist');

		if ($this->session->userdata('logged_in')) {

			$session_data       = $this->session->userdata('logged_in');
			// var_dump($session_data);
			$this->user['id']     	= $session_data['id'];
			$this->user['username']  	= $session_data['username'];
			$this->user['user_group']     = $session_data['user_group'];
			$this->user['kowil']     = $session_data['kowil'];
			$this->user['param_cari'] = $this->session->userdata('param_cari');
			// var_dump($this->user['kowil']);
		}else{
			redirect(base_url().'login', 'refresh');
		}
	}

	public function index()
	{
		// $data['temp'] = "";

		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'batching',0);
		$datam['inisial'] = 'batching';

		if($this->user['user_group'] == '46' || $this->user['user_group'] == '2')
		{
				$this->load->view('head/header',$this->user);
				$this->load->view('head/menu',$datam);
				$this->load->view('admin/batch');
				$this->load->view('head/footer');	
		}
		else
		{
			$this->load->view('403');
		}
		

		// $this->load->view('admin/navigation/header');
		// $this->load->view('admin/navigation/menu');
		// $this->load->view('admin/batch');
		// $this->load->view('admin/navigation/footer');
	}

	

	
}