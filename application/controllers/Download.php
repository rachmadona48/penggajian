<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {

	// private $user=array();
	public function __construct()
	{
		parent::__construct();
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
			// var_dump($this->user['kowil']);
		}else{
			redirect(base_url().'index.php/login', 'refresh');
		}
	}

	public function usermanual()
	{
		$this->load->helper('download');
		// Contents of photo.jpg will be automatically read
		force_download('/download/ManualSimpegUserPegawai.pdf', NULL);
	}
}
		

