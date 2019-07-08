<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat_penghasilan extends CI_Controller {
	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper(array('form', 'url'));    	
    	$this->load->library('session');
    	$this->load->model('mhome','home');
        $this->load->model('admin/v_pegawai','vpeg');
        $this->load->model('model_riwayat','riwayat');
        $this->load->library('infopegawai');
        $this->load->library('convert');
        $this->load->library('format_uang');
        

        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']     	= $session_data['id'];
            $this->user['username']  	= $session_data['username'];
            $this->user['user_group']     = $session_data['user_group'];
        }else{
			// redirect(base_url().'login/logout', 'refresh');
            redirect(base_url().'login', 'refresh');
		}	
       
   	}

	public function listing_tkd()
	{		
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
                 

        $data['nrk'] = $nrk;
        $datam['nrk'] = $nrk;
        $datam['user_group'] = $this->user['user_group'];
        $data['user_id'] = $this->user['id'];
        $data['user_group'] = $this->user['user_group'];
        

        $info_pg = $this->riwayat->get_info_tkd_pg($nrk);
        // echo $info_pg->JML_PGW;exit();
        $data['info_tkd_pg'] = $info_pg->JML_PGW;

        $info_gr = $this->riwayat->get_info_tkd_gr($nrk);
        $data['info_tkd_gr'] = $info_gr->JML_GR;  

        
        
        $datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'rwyat_list_tkd',0);
        $datam['inisial'] = 'rwyat_list_tkd';

        $menuid='28602';  
        $cekaksesmenu = $this->infopegawai->cekaksesmenu($menuid,$this->user['user_group']);

        if($cekaksesmenu == '1')
        {
                $this->load->view('head/header',$this->user);
                $this->load->view('head/menu',$datam);
                $this->load->view('riwayat_listing_tkd',$data);
                $this->load->view('head/footer');   
        }
        else
        {
            $this->load->view('403');
        }

	}
    
    public function data_tkd_guru()
    {
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

        $this->riwayat->get_data_tkd_guru($nrk);
    }

    public function data_tkd_pg()
    {
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

        $this->riwayat->get_data_tkd_pg($nrk);
    }

    public function listing_gaji()
    {       
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
                 

        $data['nrk'] = $nrk;
        $datam['nrk'] = $nrk;
        $datam['user_group'] = $this->user['user_group'];
        $data['user_id'] = $this->user['id'];
        $data['user_group'] = $this->user['user_group'];
        

        $info_gaji = $this->riwayat->get_info_gaji($nrk);
        // echo $info_pg->JML_PGW;exit();
        $data['info_gaji'] = $info_gaji->JML;

        $info_gr = $this->riwayat->get_info_tkd_gr($nrk);
        $data['info_tkd_gr'] = $info_gr->JML_GR;  

        
        
        $datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'rwyat_list_gaji',0);
        $datam['inisial'] = 'rwyat_list_gaji';

        $menuid='28705';  
        $cekaksesmenu = $this->infopegawai->cekaksesmenu($menuid,$this->user['user_group']);

        if($cekaksesmenu == '1')
        {
                $this->load->view('head/header',$this->user);
                $this->load->view('head/menu',$datam);
                $this->load->view('riwayat_listing_gaji',$data);
                $this->load->view('head/footer');   
        }
        else
        {
            $this->load->view('403');
        }

    }

    public function data_gaji()
    {
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

        $this->riwayat->get_data_gaji($nrk);
    }

            		
}
?>            
