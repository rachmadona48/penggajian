<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Downloads extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('infopegawai');	 
	}	

	public function index()
	{
		if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']     	= $session_data['id'];
            $this->user['username']  	= $session_data['username'];
            $this->user['user_group']     = $session_data['user_group'];
        }else{
			redirect(base_url().'index.php/login', 'refresh');
		}

			 if(isset($_POST['nrk'])){
                    $nrk = $_POST['nrk'];
                }elseif(isset($_POST['nrkP'])){ //Pencarian NRK Untuk Admin/BKD
                    $nrk = $_POST['nrkP'];                    
                }else{
                    $nrk = $this->user['id'];
                    
                    if($this->user['user_group'] > 1){
                        $nrk = "";
                    }
                }           
            
			// $datam['activeMenu'] = "1016";
            $datam['activeMenu'] = "6421";
            $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'download',0); 
 			$datam['user_group'] = $this->user['user_group'];
 			$data['user_group'] = $this->user['user_group'];
         

            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu',$datam);
           	// $this->load->view('download.php',$data);
            $this->load->view('head/footer');
	}

	public function usermanual()
	{

		if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']     	= $session_data['id'];
            $this->user['username']  	= $session_data['username'];
            $this->user['user_group']     = $session_data['user_group'];
        }else{
			redirect(base_url().'index.php/login', 'refresh');
		}
		// $datam['activeMenu'] = "395";
  //       $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'download',0); 

  //       $this->load->view('head/header',$this->user);
  //           $this->load->view('head/menu',$datam);
  //          	$this->load->view('download.php');
  //           $this->load->view('head/footer');

		//$this->load->helper('download');
		// Contents of photo.jpg will be automatically read
		//force_download('download/ManualSimpegUserPegawai.pdf', NULL);
		//redirect('download/ManualSimpegUserPegawai.pdf');
		//echo "<script type='text/javascript'>window.open('".base_url('download/ManualSimpegUserPegawai.pdf')."','_blank');</script>";	
		redirect(base_url('download/ManualSimpegUserPegawai.pdf'));
	}

	public function usermanualall()
	{		
		//$this->load->helper('download');
		// Contents of photo.jpg will be automatically read
		//force_download('download/UserManual.pdf', NULL);
		// echo "<script type='text/javascript'>window.open('".base_url('download/UserManual.pdf')."','_blank');</script>";
		// redirect(base_url('download/UserManual.pdf'));
		//redirect(base_url('download/ManualSimpegUserPegawai.pdf'));
		redirect(base_url('download/UserManualSimpeg.pdf'));

	}

	public function email()
	{		
		//$this->load->helper('download');
		// Contents of photo.jpg will be automatically read
		//force_download('download/UserManual.pdf', NULL);
		// echo "<script type='text/javascript'>window.open('".base_url('download/UserManual.pdf')."','_blank');</script>";
		// redirect(base_url('download/UserManual.pdf'));
		redirect(base_url('download/SE_penggunaan_email.pdf'));
	}

	public function faq()
	{
		if ($this->session->userdata('logged_in')) {            
            // echo "<script type='text/javascript'>window.open('".base_url('download/FAQ_SIMPEGWEB.pdf')."','_blank');</script>";
            redirect(base_url('download/FAQ_SIMPEGWEB.pdf'));
        }else{
			redirect(base_url('download/FAQ_SIMPEGWEB.pdf'));
		}
		
		//$this->load->helper('download');
		// Contents of photo.jpg will be automatically read
		//force_download('download/FAQ_SIMPEGWEB.pdf', NULL);
	}
}
		

