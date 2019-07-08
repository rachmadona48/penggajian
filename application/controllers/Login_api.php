<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_api extends CI_Controller {

	public function __construct()
   	{
   		/*header('Access-Control-Allow-Origin: http://10.15.32.31');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");*/
    	parent::__construct();
    	$this->load->library('session');
    	$this->load->library('infopegawai');

    	$this->load->helper('url');
    	$this->load->model('mlogin_api'); 
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
		// $data = $this->input->post('data');
        $key = $this->input->post('key');
        // echo $key;exit();
        if($key == md5(sha1('s1mp3g@DK1J@k@rt@')) ){
            $data = array(
                    'username' => $this->input->post('username')
                );

            $result = $this->mlogin_api->login_api($data);
            if ($result == TRUE) {
                $return = 'True';

                $result2 = $this->mlogin_api->read_user_information($data['username']);
                $session_data = array(
                                    'user_id' => $result2[0]->user_id,
                                    'key' => $result2[0]->user_password
                                    );
                $url = base_url('login_api/cek_api/'.$result2[0]->user_id.'/'.hash('sha512', ($result2[0]->user_password+'@dn_ray_jr')));

            }else{
                $return = 'False';
                $session_data = array('' =>'' );
                $url = base_url('login');

            }

        }else{
            $return = 'False';
            $session_data = array('' =>'' );
            $url = base_url('login');

        }
        
        echo json_encode(array('Return' => $return, 'Data' => $session_data, 'url' => $url));
	}


    public function log_tes(){
        $quer = $this->minformasi->getPengumuman(1);
        $info = $quer->result();
        
        $querbaru = $this->minformasi->getPengumumanBaru(1);
        $infobaru = $querbaru->result();

        $data['isiInformasi'] = $info;
        $data['isiInformasiBaru'] = $infobaru;

        // $data['image'] = $this->load_captcha(0);

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
        $this->load->view('head/login_tes',$data);
    }
    public function cek_api()
    {       
        $username = urldecode($this->uri->segment(3,0));
        $key = urldecode($this->uri->segment(4,0));
        
        $data = array(
            // 'username' => $this->input->post('username'),
            'username' => $username,
            // 'password' => $this->input->post('password'),
            //'captcha_response' => $this->input->post('g-recaptcha-response')
        );

        // print_r($data);exit();

        $result = $this->mlogin_api->login_api($data);

        // echo $key; echo ' = ';
        // echo $result[0]->user_password;exit();

        // print_r($result);exit();

        if ($result == TRUE ) {

            $result = $this->mlogin_api->read_user_information($username);

            if($key == hash('sha512', ($result[0]->user_password+'@dn_ray_jr'))){

                $username = $username;
                            
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

                $this->session->set_userdata('logged_in', $session_data);
                
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
                    //  // $url_redirect = site_url('profile');
                    //  $url_redirect = base_url().'profile';
                    //  //~redirect(base_url().'skpd', 'refresh');  
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
                    //  // $url_redirect = site_url('pegawai');
                    //  $url_redirect = base_url().'pegawai';
                    //  //~redirect(base_url().'skpd', 'refresh');  
                    // }

                    // else if($session_data['user_group'] == "5")
                    // {
                    //     // $url_redirect = site_url('pegawai');
                    //     $url_redirect = base_url().'listing';
                    //     //~redirect(base_url().'skpd', 'refresh');  
                    // }

                    else if($session_data['user_group'] == "52")
                    {
                        $url_redirect = base_url().'listing';
                    }

                    // else if($session_data['user_group'] == "6")
                    // {
                    //  // $url_redirect = site_url('tubkd');
                    //  $url_redirect = base_url().'tubkd';
                    //  //~redirect(base_url().'tubkd', 'refresh'); 
                    // }
                    // else if($session_data['user_group'] == "7")
                    // {
                    //  // $url_redirect = site_url('subbid');
                    //  $url_redirect = base_url().'subbid';
                    //  //~redirect(base_url().'subbid', 'refresh');    
                    // }
                    // else if($session_data['user_group'] == "8")
                    // {
                    //  // $url_redirect = site_url('birohukum');
                    //  $url_redirect = base_url().'birohukum';
                    //  //~redirect(base_url().'birohukum', 'refresh'); 
                    // }
                    // else if($session_data['user_group'] == "9")
                    // {
                    //  // $url_redirect = site_url('biroumum');
                    //  $url_redirect = base_url().'birohukum';
                    //  //~redirect(base_url().'biroumum', 'refresh');  
                    // }
                    // else if($session_data['user_group'] == "11")
                    // {
                    //  // $url_redirect = site_url('report/laporan');
                    //  $url_redirect = base_url().'report/laporan';
                    //  //~redirect(base_url().'skpd', 'refresh');  
                    // }
                    // else if($session_data['user_group'] == "12")
                    // {
                    //  // $url_redirect = site_url('pegawai');
                    //  $url_redirect = base_url().'pegawai';
                    //  //~redirect(base_url().'skpd', 'refresh');  
                    // }
                    // else if($session_data['user_group'] == "4")
                    // {
                    //  // $url_redirect = site_url('report/laporan');
                    //  $url_redirect = base_url().'report/laporan';
                    //  //~redirect(base_url().'skpd', 'refresh');  
                    // }
                    // else if($session_data['user_group'] == "26")
                    // {
                    //  // $url_redirect = site_url('pegawai');
                    //  $url_redirect = base_url().'pegawai';
                    //  //~redirect(base_url().'skpd', 'refresh');  
                    // }
                    // else if($session_data['user_group'] == "29")
                    // {
                    //  // $url_redirect = site_url('pegawai');
                    //  $url_redirect = base_url().'pegawai';
                    //  //~redirect(base_url().'skpd', 'refresh');  
                    // }
                    // else if($session_data['user_group'] == "30"  || $session_data['user_group'] == "32" || $session_data['user_group'] == "33" || $session_data['user_group'] == "34")
                    // {
                    //  // $url_redirect = site_url('pegawai');
                    //  $url_redirect = base_url().'pegawai';
                    //  //~redirect(base_url().'skpd', 'refresh');  
                    // }
                    else if($session_data['user_group'] == "46")
                    {
                        // $url_redirect = site_url('batch');
                        $url_redirect = base_url().'batch';
                        //~redirect(base_url().'skpd', 'refresh');  
                    }
                    // else if($session_data['user_group'] == "47")
                    // {
                    //  // $url_redirect = site_url('pegawai');
                    //  $url_redirect = base_url().'pegawai';
                    //  //~redirect(base_url().'skpd', 'refresh');  
                    // }
                    // else if($session_data['user_group'] == "48")
                    // {
                    //  // $url_redirect = site_url('laporan');
                    //  $url_redirect = base_url().'laporan';
                        
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
                             
            }else{
                $url_redirect = site_url('login');
            }
            
        } else {
            $url_redirect = site_url('login');
        }

        redirect($url_redirect);

    
    }
    
    

}
