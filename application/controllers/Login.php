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

    	$this->rand = random_string('numeric', 5);

   	}

	public function index()
	{	
	
		//redirect(base_url().'dona');
		//redirect('dona');
		//INFORMASI	
		$quer = $this->minformasi->getPengumuman(1);
		$info = $quer->result();
		
		$querbaru = $this->minformasi->getPengumumanBaru(1);
		$infobaru = $querbaru->result();

		$data['isiInformasi'] = $info;
		$data['isiInformasiBaru'] = $infobaru;

		$data['image'] = $this->load_captcha(0);

		$data['ctInfo'] = $this->minformasi->cekInformasiTerbaru();
            

		//BERITA
		$quer2 = $this->minformasi->getPengumuman(2);
		$info2 = $quer2->result();
		$data['isiInformasi2'] = $info2;	

		$data['ctNews'] = $this->minformasi->cekBeritaTerbaru();  	

		//BANNER
		$ceknumbanner = $this->minformasi->cekBanner();

		$data['cekbanner'] = $ceknumbanner;
		$data['banner']='';
		if($ceknumbanner>0)
		{
			$databanner = $this->minformasi->showLastBanner();
			$data['banner']=$databanner;
		}

		
		if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']       = $session_data['id'];
            $this->user['username']     = $session_data['username'];
            $this->user['user_group']     = $session_data['user_group'];
            $this->user['user_password']     = $session_data['user_password'];

             // echo $this->user['user_group']; exit();

            // redirect(base_url().'home', 'refresh');
            // $this->session->set_userdata('logged_in', $session_data);
			
			// if($this->user['user_group'] == "1")
			// {
			// 	redirect(base_url().'profile', 'refresh');
			// 	//redirect('profile');
			// 	//~redirect(base_url().'skpd', 'refresh');	
			// }
			// //var_dump($session_data['user_group']);
			// else 
			if($this->user['user_group'] == "2")
			{
				redirect('listing');
				//~redirect(base_url().'skpd', 'refresh');	
			}
			else if($this->user['user_group'] == "3")
			{
				redirect('admin/admin/menu');
				//~redirect(base_url().'skpd', 'refresh');	
			}
   //          else if($this->user['user_group'] == "10")
			// {
			// 	redirect('pegawai');
			// 	//~redirect(base_url().'skpd', 'refresh');	
			// }
			// else if($this->user['user_group'] == "5")
			// {
			// 	redirect('listing');
			// }

			else if($this->user['user_group'] == "52")
			{
				redirect('listing');
			}

			// else if($this->user['user_group'] == "6")
			// {
			// 	redirect('tubkd');
			// 	//~redirect(base_url().'tubkd', 'refresh');	
			// }
			// else if($this->user['user_group'] == "7")
			// {
			// 	redirect('subbid');
			// 	//~redirect(base_url().'subbid', 'refresh');	
			// }
			// else if($this->user['user_group'] == "8")
			// {
			// 	redirect('birohukum');
			// 	//~redirect(base_url().'birohukum', 'refresh');	
			// }
			// else if($this->user['user_group'] == "9")
			// {
			// 	redirect('biroumum');
			// 	//~redirect(base_url().'biroumum', 'refresh');	
			// }
			// else if($this->user['user_group'] == "11")
			// {
			// 	redirect('report/laporan');
			// 	//~redirect(base_url().'skpd', 'refresh');	
			// }
			// else if($this->user['user_group'] == "12")
			// {
			// 	redirect('pegawai');
			// 	//~redirect(base_url().'skpd', 'refresh');	
			// }
			// else if($this->user['user_group'] == "4")
			// {
			// 	redirect('report/laporan');
			// 	//~redirect(base_url().'skpd', 'refresh');	
			// }
			// else if($this->user['user_group'] >= '13' && $this->user['user_group'] < '44')
			// {
			// 	redirect('pegawai');
			// }
			// else if($this->user['user_group'] == "3")
			// {
			// 	 redirect(base_url('admin/admin/menu'));	
			// 	// header("Location : admin/admin");
			// 	//header('Location: '.base_url().'admin/admin');
				
			// 	// redirect('pegawai');
			// }
			// else if($this->user['user_group'] == "44")
			// {
			// 	 redirect(base_url('laporan'));	
			// 	// header("Location : admin/admin");
			// 	//header('Location: '.base_url().'admin/admin');
				
			// 	// redirect('pegawai');
			// }
			// else if($this->user['user_group'] == "45")
			// {
			// 	redirect('pegawai');
			// 	//~redirect(base_url().'skpd', 'refresh');	
			// }
			else if($this->user['user_group'] == "46")
			{
				redirect('batch');
				//~redirect(base_url().'skpd', 'refresh');	
			}
			// else if($this->user['user_group'] == "47")
			// {
			// 	redirect('pegawai');
			// 	//~redirect(base_url().'skpd', 'refresh');	
			// }
			// else if($this->user['user_group'] == "48")
			// {
			// 	redirect('laporan');
				
			// }
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
		// echo base_url(); echo 'cek url'; exit();
		if ($this->input->post() ) 
		{

			if($this->input->post('security_code') == $this->session->userdata('mycaptcha'))
			{
				$data = array(
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password'),
					//'captcha_response' => $this->input->post('g-recaptcha-response')
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
									($session_data['id']!='develop' && $session_data['id']!='bkd04' && $session_data['id']!='batch')
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
											
										// if($session_data['user_group'] == "1")
										// {
										// 	// $url_redirect = site_url('profile');
										// 	$url_redirect = base_url().'profile';
										// 	//~redirect(base_url().'skpd', 'refresh');	
										// }
										// //var_dump($session_data['user_group']);
										// else 
										if($session_data['user_group'] == "2")
										{
											// $url_redirect = site_url('pegawai');
											$url_redirect = base_url().'listing';
											//~redirect(base_url().'skpd', 'refresh');	
										}
										else if($session_data['user_group'] == "3")
										{
											// $url_redirect = site_url('admin/admin/menu');
											$url_redirect = base_url().'admin/admin/menu';
											//~redirect(base_url().'skpd', 'refresh');	
										}
						    //             else if($session_data['user_group'] == "10")
										// {
										// 	// $url_redirect = site_url('pegawai');
										// 	$url_redirect = base_url().'pegawai';
										// 	//~redirect(base_url().'skpd', 'refresh');	
										// }


										// else if($session_data['user_group'] == "5")
										// {
										// 	$url_redirect = base_url().'listing';	
										// }

										else if($session_data['user_group'] == "52")
										{
											$url_redirect = base_url().'listing';	
										}

										// else if($session_data['user_group'] == "6")
										// {
										// 	// $url_redirect = site_url('tubkd');
										// 	$url_redirect = base_url().'tubkd';
										// 	//~redirect(base_url().'tubkd', 'refresh');	
										// }
										// else if($session_data['user_group'] == "7")
										// {
										// 	// $url_redirect = site_url('subbid');
										// 	$url_redirect = base_url().'subbid';
										// 	//~redirect(base_url().'subbid', 'refresh');	
										// }
										// else if($session_data['user_group'] == "8")
										// {
										// 	// $url_redirect = site_url('birohukum');
										// 	$url_redirect = base_url().'birohukum';
										// 	//~redirect(base_url().'birohukum', 'refresh');	
										// }
										// else if($session_data['user_group'] == "9")
										// {
										// 	// $url_redirect = site_url('biroumum');
										// 	$url_redirect = base_url().'birohukum';
										// 	//~redirect(base_url().'biroumum', 'refresh');	
										// }
										// else if($session_data['user_group'] == "11")
										// {
										// 	// $url_redirect = site_url('report/laporan');
										// 	$url_redirect = base_url().'report/laporan';
										// 	//~redirect(base_url().'skpd', 'refresh');	
										// }
										// else if($session_data['user_group'] == "12")
										// {
										// 	// $url_redirect = site_url('pegawai');
										// 	$url_redirect = base_url().'pegawai';
										// 	//~redirect(base_url().'skpd', 'refresh');	
										// }
										// else if($session_data['user_group'] == "4")
										// {
										// 	// $url_redirect = site_url('report/laporan');
										// 	$url_redirect = base_url().'report/laporan';
										// 	//~redirect(base_url().'skpd', 'refresh');	
										// }
										// else if($session_data['user_group'] == "26")
										// {
										// 	// $url_redirect = site_url('pegawai');
										// 	$url_redirect = base_url().'pegawai';
										// 	//~redirect(base_url().'skpd', 'refresh');	
										// }
										// else if($session_data['user_group'] == "29")
										// {
										// 	// $url_redirect = site_url('pegawai');
										// 	$url_redirect = base_url().'pegawai';
										// 	//~redirect(base_url().'skpd', 'refresh');	
										// }
										// else if($session_data['user_group'] == "30"  || $session_data['user_group'] == "32" || $session_data['user_group'] == "33" || $session_data['user_group'] == "34")
										// {
										// 	// $url_redirect = site_url('pegawai');
										// 	$url_redirect = base_url().'pegawai';
										// 	//~redirect(base_url().'skpd', 'refresh');	
										// }
										else if($session_data['user_group'] == "46")
										{
											// $url_redirect = site_url('batch');
											$url_redirect = base_url().'batch';
											//~redirect(base_url().'skpd', 'refresh');	
										}
										// else if($session_data['user_group'] == "47")
										// {
										// 	// $url_redirect = site_url('pegawai');
										// 	$url_redirect = base_url().'pegawai';
										// 	//~redirect(base_url().'skpd', 'refresh');	
										// }
										// else if($session_data['user_group'] == "48")
										// {
										// 	// $url_redirect = site_url('laporan');
										// 	$url_redirect = base_url().'laporan';
											
										// }
										else
										{
											// $url_redirect = site_url('');
											$url_redirect = base_url().'laporan';
											//~redirect(base_url().'index.php', 'refresh');	
										}
										
										$data = array(
											'response' => 'sukses',
											'url_redirect' => $url_redirect
										);
									}
									// print_r($this->session->userdata()); exit();

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
			else
			{
				echo json_encode(array('response' => 'gagal','error_message' => "Login Gagal, captcha yang anda masukan salah!"));
			}

		
		}
		else
		{
			redirect(base_url().'login', 'refresh');
		}
		
	}

	function load_captcha($echo) {
		$this->load->helper('captcha');

		$vals = array(
			'img_path' => './assets/captcha/',
			'img_url' => base_url() . 'assets/captcha/',
			'font_path' => './assets/fonts/Camouflage.ttf',
			'img_width' => '360',
			'img_height' => 50,
			'border' => 0,
			'expiration' => 7200,
			'word_length' => 5,
			'word' => $this->rand,
			'font_size' => 21,
			'img_id' => 'Imageid',
			'pool' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

			// White background and border, black text and red grid
			'colors' => array(
				'background' => array(255, 255, 255),
				'border' => array(255, 255, 255),
				'text' => array(0, 0, 0),
				'grid' => array(232, 40, 40),
			),
		);


		// create captcha image
		$cap = create_captcha($vals);


		// store the captcha word in a session
		$this->session->set_userdata('mycaptcha', $cap['word']);

		if ($echo == 1) {
			echo $cap['image'];
		} else {
			return $cap['image'];
		}
	}
	
	public function logout() {

		// Removing session data
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('param_cari');
		// $this->load->view('head/login_new.php');
		//redirect('login');
		redirect(base_url().'login', 'refresh');
	}

	public function getInformasi()
	{
		
	}

}
