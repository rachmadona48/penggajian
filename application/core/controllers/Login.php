<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
   	{
   		/*header('Access-Control-Allow-Origin: http://10.15.32.31');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");*/
    	parent::__construct();
    	$this->load->library('session');
    	$this->load->library('infopegawai');

    	$this->load->helper('url');
    	$this->load->model('mlogin');
    	$this->load->model('minformasi');
    	//$this->output->set_header('Access-Control-Allow-Origin: *');
    	//$this->logout();
    	//var_dump($this->session->userdata());

    	// if ($this->session->userdata('logged_in')) {            

     //        $session_data       = $this->session->userdata('logged_in');
     //        $this->user['id']       = $session_data['id'];
     //        $this->user['username']     = $session_data['username'];
     //        $this->user['user_group']     = $session_data['user_group'];
     //        $this->user['user_password']     = $session_data['user_password'];

     //        redirect(base_url().'home', 'refresh');
     //    }else{
     //    	redirect(base_url().'login', 'refresh');
     //    }    

   	}

	public function index()
	{	
		//INFORMASI	
		$quer = $this->minformasi->getPengumuman(1);
		$info = $quer->result();
		
		$querbaru = $this->minformasi->getPengumumanBaru(1);
		$infobaru = $querbaru->result();

		$data['isiInformasi'] = $info;
		$data['isiInformasiBaru'] = $infobaru;

		$data['ctInfo'] = $this->minformasi->cekInformasiTerbaru();
            

		//BERITA
		$quer2 = $this->minformasi->getPengumuman(2);
		$info2 = $quer2->result();
		$data['isiInformasi2'] = $info2;	

		$data['ctNews'] = $this->minformasi->cekBeritaTerbaru();  	

		
		if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']       = $session_data['id'];
            $this->user['username']     = $session_data['username'];
            $this->user['user_group']     = $session_data['user_group'];
            $this->user['user_password']     = $session_data['user_password'];

             // echo $this->user['user_group']; exit();

            // redirect(base_url().'home', 'refresh');
            // $this->session->set_userdata('logged_in', $session_data);
			
			if($this->user['user_group'] == "1")
			{
				redirect('profile');
				//~redirect(base_url().'skpd', 'refresh');	
			}
			//var_dump($session_data['user_group']);
			else if($this->user['user_group'] == "2")
			{
				redirect('pegawai');
				//~redirect(base_url().'skpd', 'refresh');	
			}
            else if($this->user['user_group'] == "10")
			{
				redirect('pegawai');
				//~redirect(base_url().'skpd', 'refresh');	
			}
			else if($this->user['user_group'] == "5")
			{
				redirect('skpd');
				//~redirect(base_url().'skpd', 'refresh');	
			}
			else if($this->user['user_group'] == "6")
			{
				redirect('tubkd');
				//~redirect(base_url().'tubkd', 'refresh');	
			}
			else if($this->user['user_group'] == "7")
			{
				redirect('subbid');
				//~redirect(base_url().'subbid', 'refresh');	
			}
			else if($this->user['user_group'] == "8")
			{
				redirect('birohukum');
				//~redirect(base_url().'birohukum', 'refresh');	
			}
			else if($this->user['user_group'] == "9")
			{
				redirect('biroumum');
				//~redirect(base_url().'biroumum', 'refresh');	
			}
			else if($this->user['user_group'] == "11")
			{
				redirect('report/laporan');
				//~redirect(base_url().'skpd', 'refresh');	
			}
			else if($this->user['user_group'] == "12")
			{
				redirect('pegawai');
				//~redirect(base_url().'skpd', 'refresh');	
			}
			else if($this->user['user_group'] == "4")
			{
				redirect('report/laporan');
				//~redirect(base_url().'skpd', 'refresh');	
			}
			else if($this->user['user_group'] >= '13' && $this->user['user_group'] < '44')
			{
				redirect('pegawai');
			}
			else if($this->user['user_group'] == "3")
			{
				 redirect(base_url('admin/admin'));	
				// header("Location : admin/admin");
				//header('Location: '.base_url().'admin/admin');
				
				// redirect('pegawai');
			}
			else if($this->user['user_group'] == "44")
			{
				 redirect(base_url('laporan'));	
				// header("Location : admin/admin");
				//header('Location: '.base_url().'admin/admin');
				
				// redirect('pegawai');
			}
			else
			{
				redirect('');
				//~redirect(base_url().'index.php', 'refresh');	
			}

        }else{
			$this->load->view('head/login_new',$data);

		}		
	}
    
    public function login_new()
	{		
		$this->load->view('head/login.php');		
	}
	
	public function cek()
	{		


		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'captcha_response' => $this->input->post('g-recaptcha-response')
		);

		$result = $this->mlogin->login($data);

		if ($result == TRUE) {

			$username = $this->input->post('username');

			$result = $this->mlogin->read_user_information($username);


			//if ($result != false || $result_gol != false) {		
							
								$session_data = array(
									'id' => $result[0]->user_id,
									'username' => $result[0]->user_name,
									'nrk' => $username,
									'user_group' => $result[0]->user_group_id,
									'user_password' => $result[0]->user_password,
									'kowil' => $result[0]->KOWIL, 
									'kopang' => isset($result[0]->KOPANG)  ? $result[0]->KOPANG : null, //= golongan
									'nrktemp'=>'temp',
									'maintenance_mode' => $this->infopegawai->getMaintenanceMode()
								);

									//$data['menuakses'] = $this->mlogin->cekMenuAccessGroupId($result[0]->user_group_id);
									//var_dump($data['menu']);
									/*foreach ($data['menuakses'] as $key  ) {
										echo $key->user_group_id;
									}*/
									
								// Add user data in session
								$this->session->set_userdata('logged_in', $session_data);
								//$this->session->set_userdata($session_data);
				//				var_dump($this->session->userdata('kopang'));exit;
								//var_dump($session_data);exit;
						
						if (
							($session_data['id']!='develop' && $session_data['id']!='bkd04')
							&& $this->infopegawai->getMaintenanceMode() == 'on')
						/*if (($session_data['id'] != 'bkd04' || $session_data['id'] != 'develop' ) && $this->infopegawai->getMaintenanceMode() == 'on')*/
						{
							//$this->load->view('503.php');
							$url_redirect = site_url('maintenance');

							$data = array(
									'response' => 'sukses',
									'url_redirect' => $url_redirect
								);
						} else {
									
								if($session_data['user_group'] == "1")
								{
									$url_redirect = site_url('profile');
									//~redirect(base_url().'skpd', 'refresh');	
								}
								//var_dump($session_data['user_group']);
								else if($session_data['user_group'] == "2")
								{
									$url_redirect = site_url('pegawai');
									//~redirect(base_url().'skpd', 'refresh');	
								}
								else if($session_data['user_group'] == "2")
								{
									$url_redirect = site_url('admin/admin');
									//~redirect(base_url().'skpd', 'refresh');	
								}
				                else if($session_data['user_group'] == "10")
								{
									$url_redirect = site_url('pegawai');
									//~redirect(base_url().'skpd', 'refresh');	
								}
								else if($session_data['user_group'] == "5")
								{
									$url_redirect = site_url('skpd');
									//~redirect(base_url().'skpd', 'refresh');	
								}
								else if($session_data['user_group'] == "6")
								{
									$url_redirect = site_url('tubkd');
									//~redirect(base_url().'tubkd', 'refresh');	
								}
								else if($session_data['user_group'] == "7")
								{
									$url_redirect = site_url('subbid');
									//~redirect(base_url().'subbid', 'refresh');	
								}
								else if($session_data['user_group'] == "8")
								{
									$url_redirect = site_url('birohukum');
									//~redirect(base_url().'birohukum', 'refresh');	
								}
								else if($session_data['user_group'] == "9")
								{
									$url_redirect = site_url('biroumum');
									//~redirect(base_url().'biroumum', 'refresh');	
								}
								else if($session_data['user_group'] == "11")
								{
									$url_redirect = site_url('report/laporan');
									//~redirect(base_url().'skpd', 'refresh');	
								}
								else if($session_data['user_group'] == "12")
								{
									$url_redirect = site_url('pegawai');
									//~redirect(base_url().'skpd', 'refresh');	
								}
								else if($session_data['user_group'] == "4")
								{
									$url_redirect = site_url('report/laporan');
									//~redirect(base_url().'skpd', 'refresh');	
								}
								else
								{
									$url_redirect = site_url('');
									//~redirect(base_url().'index.php', 'refresh');	
								}
								
								$data = array(
									'response' => 'sukses',
									'url_redirect' => $url_redirect
								);
							}

			//}
			
			
		} else {
			$data = array(
				'response' => 'gagal',
				'error_message' => 'Username/Password Anda salah'
				);
			//$this->load->view('head/login.php',$data);
		}

		echo json_encode($data);
		
	}
	
	public function logout() {

		// Removing session data
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('param_cari');
		// $this->load->view('head/login_new.php');
		redirect('login');
	}

	public function getInformasi()
	{
		
	}

}
