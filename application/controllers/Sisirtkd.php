<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sisirtkd extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
        $this->load->helper(array('form', 'url'));    	
    	$this->load->library('session');
    	$this->load->model('mhome','home');
        $this->load->library('infopegawai');
        $this->load->library('sisir_tkd'); 

    	if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']     	= $session_data['id'];
            $this->user['username']  	= $session_data['username'];
            $this->user['user_group']     = $session_data['user_group'];
        }else{
			redirect(base_url().'index.php/login', 'refresh');
		}	    
   	}

	public function index()
	{		                
	   return $this->statisdinamis();
	}

    public function statisdinamis(){
            // START GET NRK                
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
            // END GET NRK

            // START Inisial Active Menu
            $datam['activeMenu'] = "298";
            $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'sisirtkd',0);    
            // END Inisial Active Menu

            
            $data['nrk'] = $nrk;
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
            $infoUser = $this->home->getUserInfo($nrk);
            $data['infoUser'] = $infoUser;        

            $data['tahap1'] = $this->sisir_tkd->getDataSisirTkdTahap1($nrk);
            $data['tahap2'] = $this->sisir_tkd->getDataSisirTkdTahap2($nrk);

            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu',$datam);
            $this->load->view('sisirtkd',$data);
            $this->load->view('head/footer');
    }

    public function tkdguru(){
            // START GET NRK                
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
            // END GET NRK

            // START Inisial Active Menu
            $datam['activeMenu'] = "299";
            $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'sisirtkd',0); 
            // END Inisial Active Menu

            
            $data['nrk'] = $nrk;
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
            $infoUser = $this->home->getUserInfo($nrk);
            $data['infoUser'] = $infoUser;        

            $data['tkdguru'] = $this->sisir_tkd->getDataTkdGuru($nrk);            

            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu',$datam);
            $this->load->view('sisirtkd',$data);
            $this->load->view('head/footer');
    }
    
    public function gapok(){
            // START GET NRK                
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
            // END GET NRK

            // START Inisial Active Menu
            $datam['activeMenu'] = "300";
            $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'sisirtkd',0); 
            // END Inisial Active Menu

            
            $data['nrk'] = $nrk;
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
            $infoUser = $this->home->getUserInfo($nrk);
            $data['infoUser'] = $infoUser;        

            $data['gapok'] = $this->sisir_tkd->getDataGajiPegawai($nrk);            

            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu',$datam);
            $this->load->view('sisirtkd',$data);
            $this->load->view('head/footer');
    }

}
