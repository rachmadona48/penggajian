<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi extends CI_Controller {

    private $user=array();

    public function __construct()
    {
        parent::__construct();
        $this->load->library('format_uang');
        $this->load->library('convert_bln_jasper');
        $this->load->helper(array('form', 'url'));      
        $this->load->model('mvalidasi','validasi');
        
        

        /*if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']       = $session_data['id'];
            $this->user['username']     = $session_data['username'];
            $this->user['user_group']     = $session_data['user_group'];
        }else{
            redirect(base_url().'index.php/login', 'refresh');
        }       */
    }

    public function index(){
        echo 'dddddddd';
    }

    public function qr_gaji()
    {  
        
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        
        $gj = $this->validasi->qr_data_gaji($thbl,$spmu);
        
        
        $data['skpd']   = $gj->SKPD;
        $data['count']  = $gj->JML_NRK;
        $data['sum_gj'] = $gj->SUM_GJ;
        $data['thbl']   = $thbl;
        $this->load->view('head/header');
        // $this->load->view('head/menu');
        $this->load->view('validasi',$data);
        $this->load->view('head/footer');
    }

     public function qr_gajipegawai()
    {  
        
        $nrk = $_GET['nrk'];
        $thbl = $_GET['thbl'];
        $gj = $this->validasi->qr_gajipegawai($nrk,$thbl);
 
        $data['nrk']   = $gj->NRK;
        $data['thbl']   = $gj->THBL;
        $data['nip18']  = $gj->NIP18;
        $data['naklogad']  = $gj->NAKLOGAD;
        $data['bulan'] = $gj->BULAN;
        $data['tahun']   = $gj->TAHUN;
        $data['njumbergaji'] = $gj->NJUMBERGAJI;
        $this->load->view('head/header');
        // $this->load->view('head/menu');
        $this->load->view('validasi_gajipegawai',$data);
        $this->load->view('head/footer');
    }

    public function qr_gaji_diskes()
    {  
        
        $thbl = $_GET['thbl'];
        $klogad = $_GET['klogad'];
        $gj = $this->validasi->qr_data_diskes($thbl,$klogad);
 
        $data['skpd']   = $gj->SKPD;
        $data['nalok']  = $gj->NALOK;
        $data['count']  = $gj->JML_NRK;
        $data['sum_gj'] = $gj->SUM_GJ;
        $data['thbl']   = $thbl;
        $this->load->view('head/header');
        // $this->load->view('head/menu');
        $this->load->view('validasi_diskes',$data);
        $this->load->view('head/footer');
    }

   

    public function qr_gaji_dikdas()
    {  
        
        $thbl = $_GET['thbl'];
        $klogad = $_GET['klogad'];
        $gj = $this->validasi->qr_data_dikdas($thbl,$klogad);
 
        $data['skpd']   = $gj->SKPD;
        $data['nalok']  = $gj->NALOK;
        $data['count']  = $gj->JML_NRK;
        $data['sum_gj'] = $gj->SUM_GJ;
        $data['thbl']   = $thbl;

        $this->load->view('head/header');
        // $this->load->view('head/menu');
        $this->load->view('validasi_dikdas',$data);
        $this->load->view('head/footer');

        /*"http://pegawai.jakarta.go.id/validasi/qr_gaji_dikdas"*/
    }

   
    public function qr_rptgaji_spmu()
    {  
        
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad'];
        $gj = $this->validasi->qr_data_gaji_spmu($thbl,$klogad,$spmu);
 
        $data['skpd']   = $gj->SKPD;
        $data['nalok']  = $gj->NALOK;
        $data['count']  = $gj->JML_NRK;
        $data['sum_gj'] = $gj->SUM_GJ;
        $data['thbl']   = $thbl;
        $this->load->view('head/header');
        // $this->load->view('head/menu');
        $this->load->view('validasi_gaji_spmu',$data);
        $this->load->view('head/footer');

        /*"http://pegawai.jakarta.go.id/validasi/qr_rptgaji_spmu"*/
    }

    

    public function qr_rptGajiSPMGab()
    {  
        
        $thbl = $_GET['thbl'];
        $klogad = $_GET['klogad'];
        $gj = $this->validasi->qr_data_gaji_spmu_gab($thbl,$klogad);
 
        $data['skpd']   = $gj->SKPD;
        $data['nalok']  = $gj->NALOK;
        $data['count']  = $gj->JML_NRK;
        $data['sum_gj'] = $gj->SUM_GJ;
        $data['thbl']   = $thbl;
        $this->load->view('head/header');
        // $this->load->view('head/menu');
        $this->load->view('validasi_gaji_spmu_gab',$data);
        $this->load->view('head/footer');

        /*"http://pegawai.jakarta.go.id/validasi/qr_rptGajiSPMGab"*/
    }

    public function qr_LISTING_TKD_GURU_GAB_108(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 
        $pergub = $_GET['pergub'];

        /*echo $spmu.' - '.$klogad;die();*/

        $tkd = $this->validasi->qr_LISTING_TKD_GURU_GAB_108($thbl,$spmu,$klogad);

        $data['skpd']   = $tkd->SKPD;
        $data['nalok']  = $tkd->NALOK;
        $data['count']  = $tkd->JML_NRK;
        $data['njtunda']= $tkd->NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_LISTING_TKD_GURU_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_LISTING_TKD_GURU_DISDIK_108(){
        $thbl = $_GET['thbl'];
        $klogad = $_GET['klogad']; 
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_LISTING_TKD_GURU_DISDIK_108($thbl,$klogad);

        $data['skpd']   = $tkd->SKPD;
        $data['nalok']  = $tkd->NALOK;
        $data['count']  = $tkd->JML_NRK;
        $data['njtunda']= $tkd->NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_LISTING_TKD_GURU_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_LISTING_TKD_GURU_SPMU_108(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_LISTING_TKD_GURU_SPMU_108($thbl,$spmu,$klogad);

        $data['skpd']   = $tkd->SKPD;
        $data['nalok']  = $tkd->NALOK;
        $data['count']  = $tkd->JML_NRK;
        $data['njtunda']= $tkd->NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_LISTING_TKD_GURU_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_GURU_DISDIK_108(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_GURU_DISDIK_108($thbl,$spmu);

        $data['skpd']   = $tkd->SKPD;
        $data['count']  = $tkd->JML_NRK;
        $data['njtunda']= $tkd->NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_GURU_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_GURU_DISDIK_108_all(){
        $thbl = $_GET['thbl'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_GURU_DISDIK_108_all($thbl);

        $data['skpd']   = $tkd->SKPD;
        $data['count']  = $tkd->JML;
        $data['njtunda']= $tkd->JML_NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_GURU_108_all',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_GURU_GAB_108(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_GURU_GAB_108($thbl,$spmu);

        $data['skpd']   = $tkd->SKPD;
        $data['count']  = $tkd->JML_NRK;
        $data['njtunda']= $tkd->NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_GURU_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_GURU_GAB_108_all(){
        $thbl = $_GET['thbl'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_GURU_GAB_108_all($thbl);

        $data['skpd']   = $tkd->SKPD;
        $data['count']  = $tkd->JML;
        $data['njtunda']= $tkd->JML_NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_GURU_108_all',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_GURU_SPMU_108(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_GURU_SPMU_108($thbl,$spmu);

        $data['skpd']           = $tkd->SKPD;
        $data['count']          = $tkd->JML_NRK;
        $data['njtunda']        = $tkd->NJTUNDA;
        $data['thbl']           = $thbl;
        $data['pergub']         = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_GURU_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_GURU_SPMU_108_all(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_GURU_SPMU_108_all($thbl,$spmu);

        $data['skpd']   = $tkd->SKPD;
        $data['count']  = $tkd->JML;
        $data['njtunda']= $tkd->JML_NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_GURU_108_all',$data);
        $this->load->view('head/footer');
    }

    public function qr_LISTING_TKD_GURU_DISDIK_22(){
        $thbl = $_GET['thbl'];
        $klogad = $_GET['klogad']; 
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_LISTING_TKD_GURU_DISDIK_108($thbl,$klogad);

        $data['skpd']   = $tkd->SKPD;
        $data['nalok']  = $tkd->NALOK;
        $data['count']  = $tkd->JML_NRK;
        $data['njtunda']= $tkd->NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_LISTING_TKD_GURU_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_LISTING_TKD_GURU_GAB_22(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 
        $pergub = $_GET['pergub'];

        /*echo $spmu.' - '.$klogad;die();*/

        $tkd = $this->validasi->qr_LISTING_TKD_GURU_GAB_108($thbl,$spmu,$klogad);

        $data['skpd']   = $tkd->SKPD;
        $data['nalok']  = $tkd->NALOK;
        $data['count']  = $tkd->JML_NRK;
        $data['njtunda']= $tkd->NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_LISTING_TKD_GURU_108',$data);
        $this->load->view('head/footer');

    }

    public function qr_LISTING_TKD_GURU_SPMU_22(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_LISTING_TKD_GURU_SPMU_108($thbl,$spmu,$klogad);

        $data['skpd']   = $tkd->SKPD;
        $data['nalok']  = $tkd->NALOK;
        $data['count']  = $tkd->JML_NRK;
        $data['njtunda']= $tkd->NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_LISTING_TKD_GURU_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_GURU_DISDIK_22(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_GURU_DISDIK_108($thbl,$spmu);

        $data['skpd']   = $tkd->SKPD;
        $data['count']  = $tkd->JML_NRK;
        $data['njtunda']= $tkd->NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_GURU_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_GURU_DISDIK_22_all(){
        // echo 'dddddddd';
        $thbl = $_GET['thbl'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_GURU_DISDIK_108_all($thbl);

        $data['skpd']   = $tkd->SKPD;
        $data['count']  = $tkd->JML;
        $data['njtunda']= $tkd->JML_NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_GURU_108_all',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_GURU_GAB_22(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_GURU_GAB_108($thbl,$spmu);

        $data['skpd']   = $tkd->SKPD;
        $data['count']  = $tkd->JML_NRK;
        $data['njtunda']= $tkd->NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_GURU_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_GURU_GAB_22_all(){
        $thbl = $_GET['thbl'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_GURU_GAB_108_all($thbl);

        $data['skpd']   = $tkd->SKPD;
        $data['count']  = $tkd->JML;
        $data['njtunda']= $tkd->JML_NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_GURU_108_all',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_GURU_SPMU_22(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_GURU_SPMU_108($thbl,$spmu);

        $data['skpd']           = $tkd->SKPD;
        $data['count']          = $tkd->JML_NRK;
        $data['njtunda']        = $tkd->NJTUNDA;
        $data['thbl']           = $thbl;
        $data['pergub']         = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_GURU_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_GURU_SPMU_22_all(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_GURU_SPMU_108_all($thbl,$spmu);

        $data['skpd']   = $tkd->SKPD;
        $data['count']  = $tkd->JML;
        $data['njtunda']= $tkd->JML_NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_GURU_108_all',$data);
        $this->load->view('head/footer');
    }

    public function qr_LISTING_TKD_TAHAP2_DINKES_108(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_LISTING_TKD_TAHAP2_DINKES_108($thbl,$klogad);
        $data['skpd']   = $tkd->SKPD;
        $data['nalokl']  = $tkd->NALOKL;
        $data['count']  = $tkd->JML_NRK;
        $data['njtunda']= $tkd->NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_LISTING_TKD_TAHAP2_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_LISTING_TKD_TAHAP2_DISDIK_108(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_LISTING_TKD_TAHAP2_DISDIK_108($thbl,$klogad);
        $data['skpd']   = $tkd->SKPD;
        $data['nalokl']  = $tkd->NALOKL;
        $data['count']  = $tkd->JML_NRK;
        $data['njtunda']= $tkd->NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_LISTING_TKD_TAHAP2_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_LISTING_TKD_TAHAP2_108(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_LISTING_TKD_TAHAP2_108($thbl,$klogad,$spmu);
        $data['skpd']   = $tkd->SKPD;
        $data['nalokl']  = $tkd->NALOKL;
        $data['count']  = $tkd->JML_NRK;
        $data['njtunda']= $tkd->NJTUNDA;
        $data['thbl']   = $thbl;
        $data['pergub'] = $pergub;

        $this->load->view('head/header');
        $this->load->view('validasi_LISTING_TKD_TAHAP2_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_LISTING_TKD_TAHAP2_GAB_108(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_LISTING_TKD_TAHAP2_GAB_108($thbl,$klogad,$spmu);
        if($tkd)
        {
            $data['skpd']   = $tkd->SKPD;
            $data['nalokl']  = $tkd->NALOKL;
            $data['count']  = $tkd->JML_NRK;
            $data['njtunda']= $tkd->NJTUNDA;
            $data['thbl']   = $thbl;
            $data['pergub'] = $pergub;    
        }
        else
        {
            $data['skpd']   = '-';
            $data['nalokl']  = '-';
            $data['count']  = '0';
            $data['njtunda']= '-';
            $data['thbl']   = '-';
            $data['pergub'] = '-';
        }
        

        $this->load->view('head/header');
        $this->load->view('validasi_LISTING_TKD_TAHAP2_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_TAHAP2_DINKES_108(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_TAHAP2_DINKES_108($thbl,$spmu);

        if($tkd)
        {
            $data['skpd']           = $tkd->SKPD;
            $data['count']          = $tkd->JML_NRK;
            $data['njtunda']        = $tkd->NJTUNDA;
            $data['thbl']           = $thbl;
            $data['pergub']         = $pergub;    
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['njtunda']        = '-';
            $data['thbl']           = '-';
            $data['pergub']         = '-';
        }
        

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_TAHAP2_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_TAHAP2_DINKES_108_all(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_TAHAP2_DINKES_108_all($thbl,$spmu);

        if($tkd)
        {
            $data['skpd']           = $tkd->SKPD;
            $data['count']          = $tkd->JML;
            $data['njtunda']        = $tkd->JML_NJTUNDA;
            $data['thbl']           = $thbl;
            $data['pergub']         = $pergub;    
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['njtunda']        = '-';
            $data['thbl']           = '-';
            $data['pergub']         = '-';
        }
        

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_TAHAP2_108_ALL',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_TAHAP2_DISDIK_108(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_TAHAP2_DISDIK_108($thbl,$spmu);
        if($tkd)
        {
            $data['skpd']           = $tkd->SKPD;
            $data['count']          = $tkd->JML_NRK;
            $data['njtunda']        = $tkd->NJTUNDA;
            $data['thbl']           = $thbl;
            $data['pergub']         = $pergub;
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['njtunda']        = '-';
            $data['thbl']           = '-';
            $data['pergub']         = '-';
        }
        

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_TAHAP2_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_TAHAP2_DISDIK_108_ALL(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_TAHAP2_DISDIK_108_ALL($thbl,$spmu);

        if($tkd)
        {
            $data['skpd']           = $tkd->SKPD;
            $data['count']          = $tkd->JML;
            $data['njtunda']        = $tkd->JML_NJTUNDA;
            $data['thbl']           = $thbl;
            $data['pergub']         = $pergub;
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['njtunda']        = '-';
            $data['thbl']           = '-';
            $data['pergub']         = '-';   
        }

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_TAHAP2_108_ALL',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_TAHAP2_108(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_TAHAP2_108($thbl,$spmu);
        if($tkd)
        {
            $data['skpd']           = $tkd->SKPD;
            $data['count']          = $tkd->JML_NRK;
            $data['njtunda']        = $tkd->NJTUNDA;
            $data['thbl']           = $thbl;
            $data['pergub']         = $pergub;
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['njtunda']        = '-';
            $data['thbl']           = '-';
            $data['pergub']         = '-';   
        }

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_TAHAP2_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_TAHAP2_GAB_108(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_TAHAP2_GAB_108($thbl,$spmu);
        if($tkd)
        {
            $data['skpd']           = $tkd->SKPD;
            $data['count']          = $tkd->JML_NRK;
            $data['njtunda']        = $tkd->NJTUNDA;
            $data['thbl']           = $thbl;
            $data['pergub']         = $pergub;
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['njtunda']        = '-';
            $data['thbl']           = '-';
            $data['pergub']         = '-';   
        }

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_TAHAP2_108',$data);
        $this->load->view('head/footer');
    }

    public function qr_REKAP_TKD_TAHAP2_GAB_108_ALL(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $pergub = $_GET['pergub'];

        $tkd = $this->validasi->qr_REKAP_TKD_TAHAP2_GAB_108_ALL($thbl,$spmu);
        if($tkd)
        {
            $data['skpd']           = $tkd->SKPD;
            $data['count']          = $tkd->JML;
            $data['njtunda']        = $tkd->JML_NJTUNDA;
            $data['thbl']           = $thbl;
            $data['pergub']         = $pergub;
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['njtunda']        = '-';
            $data['thbl']           = '-';
            $data['pergub']         = '-';   
        }

        $this->load->view('head/header');
        $this->load->view('validasi_REKAP_TKD_TAHAP2_108_ALL',$data);
        $this->load->view('head/footer');
    }

    public function qr_rptSPMDinkes_pph15(){
    	$thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 
        $bulan = $_GET['bulan']; 
        $tahun = $_GET['tahun']; 

        $pph15 = $this->validasi->qr_rptSPMDinkes_pph15($thbl,$klogad);
        if($pph15)
        {
            $data['skpd']           = $pph15->SKPD;
            $data['nalokl']         = $pph15->NALOKL;
            $data['count']          = $pph15->JML_NRK;
            $data['JML_PPHTUNDA']   = $pph15->JML_PPHTUNDA;
            $data['thbl']           = $thbl;
            $data['judul']          = 'DAFTAR PPH BULAN '.$bulan.' '.$tahun;
        }
        else
        {
            $data['skpd']           = '-';
            $data['nalokl']           = '-';
            $data['count']          = '0';
            $data['JML_PPHTUNDA']   = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-';
        }

        $this->load->view('head/header');
        $this->load->view('validasi_rpt_pph15',$data);
        $this->load->view('head/footer');
    }

    public function qr_rptSPMDisdik_pph15(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 
        $bulan = $_GET['bulan']; 
        $tahun = $_GET['tahun']; 

        $pph15 = $this->validasi->qr_rptSPMDisdik_pph15($thbl,$klogad);
        if($pph15)
        {
            $data['skpd']           = $pph15->SKPD;
            $data['nalokl']         = $pph15->NALOKL;
            $data['count']          = $pph15->JML_NRK;
            $data['JML_PPHTUNDA']   = $pph15->JML_PPHTUNDA;
            $data['thbl']           = $thbl;
            $data['judul']          = 'DAFTAR PPH BULAN '.$bulan.' '.$tahun;    
        }
        else
        {
            $data['skpd']           = '-';
            $data['nalokl']           = '-';
            $data['count']          = '0';
            $data['JML_PPHTUNDA']   = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-';
        }
        

        $this->load->view('head/header');
        $this->load->view('validasi_rpt_pph15',$data);
        $this->load->view('head/footer');
    }

    public function qr_rptSPM_pph15(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 
        $bulan = $_GET['bulan']; 
        $tahun = $_GET['tahun']; 

        $pph15 = $this->validasi->qr_rptSPM_pph15($thbl,$klogad,$spmu);
        if($pph15)
        {
            $data['skpd']           = $pph15->SKPD;
            $data['nalokl']         = $pph15->NALOKL;
            $data['count']          = $pph15->JML_NRK;
            $data['JML_PPHTUNDA']   = $pph15->JML_PPHTUNDA;
            $data['thbl']           = $thbl;
            $data['judul']          = 'DAFTAR PPH BULAN '.$bulan.' '.$tahun;
        }
        else
        {
            $data['skpd']           = '-';
            $data['nalokl']           = '-';
            $data['count']          = '0';
            $data['JML_PPHTUNDA']   = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-';
        }

        $this->load->view('head/header');
        $this->load->view('validasi_rpt_pph15',$data);
        $this->load->view('head/footer');
    }

    public function qr_rptSPMGab_pph15(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 
        $bulan = $_GET['bulan']; 
        $tahun = $_GET['tahun']; 

        $pph15 = $this->validasi->qr_rptSPMGab_pph15($thbl,$klogad,$spmu);
        if($pph15)
        {
            $data['skpd']           = $pph15->SKPD;
            $data['nalokl']         = $pph15->NALOKL;
            $data['count']          = $pph15->JML_NRK;
            $data['JML_PPHTUNDA']   = $pph15->JML_PPHTUNDA;
            $data['thbl']           = $thbl;
            $data['judul']          = 'DAFTAR PPH BULAN '.$bulan.' '.$tahun;    
        }
        else
        {
            $data['skpd']           = '-';
            $data['nalokl']           = '-';
            $data['count']          = '0';
            $data['JML_PPHTUNDA']   = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-';
        }
        

        $this->load->view('head/header');
        $this->load->view('validasi_rpt_pph15',$data);
        $this->load->view('head/footer');
    }

    public function qr_rekapSPMDinkes_pph15(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $bulan = $_GET['bulan']; 
        $tahun = $_GET['tahun']; 

        $pph15 = $this->validasi->qr_rekapSPMDinkes_pph15($thbl,$spmu);
        if($pph15)
        {
            $data['skpd']           = $pph15->SKPD;
            $data['count']          = $pph15->JML_NRK;
            $data['JML_PPHTUNDA']   = $pph15->JML_PPHTUNDA;
            $data['thbl']           = $thbl;
            $data['judul']          = 'REKAP PPH BULAN '.$bulan.' '.$tahun;    
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['JML_PPHTUNDA']   = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-';
        }
        

        $this->load->view('head/header');
        $this->load->view('validasi_rekap_pph15',$data);
        $this->load->view('head/footer');
    }

    public function qr_rekapSPMDinkes_pph15_all(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $bulan = $_GET['bulan']; 
        $tahun = $_GET['tahun']; 

        $pph15 = $this->validasi->qr_rekapSPMDinkes_pph15_all($thbl);
        if($pph15)
        {
            $data['skpd']           = $pph15->SKPD;
            $data['count']          = $pph15->JML;
            $data['SUM_PPHTUNDA']   = $pph15->SUM_PPHTUNDA;
            $data['thbl']           = $thbl;
            $data['judul']          = 'REKAP PPH BULAN '.$bulan.' '.$tahun;    
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['SUM_PPHTUNDA']   = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-';
        }
        

        $this->load->view('head/header');
        $this->load->view('validasi_rekap_pph15_all',$data);
        $this->load->view('head/footer');
    }

    public function qr_rekapSPMDisdik_pph15(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $bulan = $_GET['bulan']; 
        $tahun = $_GET['tahun']; 

        if($spmu == 'C040'){
            $pph15 = $this->validasi->qr_rekapSPMDisdik_pph15($thbl,$spmu);

        }elseif($spmu == 'C041'){
            $pph15 = $this->validasi->qr_rekapSPMDisdik_pph15_all($thbl);
        }

        if($pph15)
        {
            $data['skpd']           = $pph15->SKPD;
            $data['count']          = $pph15->JML_NRK;
            $data['JML_PPHTUNDA']   = $pph15->JML_PPHTUNDA;
            $data['thbl']           = $thbl;
            $data['judul']          = 'REKAP PPH BULAN '.$bulan.' '.$tahun;    
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['JML_PPHTUNDA']   = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-';
        }
        

        $this->load->view('head/header');
        $this->load->view('validasi_rekap_pph15',$data);
        $this->load->view('head/footer');
    }

    public function qr_rekapSPM_pph15(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $bulan = $_GET['bulan']; 
        $tahun = $_GET['tahun']; 

        $pph15 = $this->validasi->qr_rekapSPM_pph15($thbl,$spmu);
        if($pph15)
        {
            $data['skpd']           = $pph15->SKPD;
            $data['count']          = $pph15->JML_NRK;
            $data['JML_PPHTUNDA']   = $pph15->JML_PPHTUNDA;
            $data['thbl']           = $thbl;
            $data['judul']          = 'REKAP PPH BULAN '.$bulan.' '.$tahun;    
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['JML_PPHTUNDA']   = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-';
        }
        

        $this->load->view('head/header');
        $this->load->view('validasi_rekap_pph15',$data);
        $this->load->view('head/footer');
    }

    public function qr_rekapSPMGab_pph15(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $bulan = $_GET['bulan']; 
        $tahun = $_GET['tahun']; 

        $pph15 = $this->validasi->qr_rekapSPMGab_pph15($thbl,$spmu);
        if($pph15)
        {
            $data['skpd']           = $pph15->SKPD;
            $data['count']          = $pph15->JML_NRK;
            $data['JML_PPHTUNDA']   = $pph15->JML_PPHTUNDA;
            $data['thbl']           = $thbl;
            $data['judul']          = 'REKAP PPH BULAN '.$bulan.' '.$tahun;    
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['JML_PPHTUNDA']   = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-';
        }
        

        $this->load->view('head/header');
        $this->load->view('validasi_rekap_pph15',$data);
        $this->load->view('head/footer');
    }

    public function qr_rekapSPMGab_pph15_all(){
        $thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $bulan = $_GET['bulan']; 
        $tahun = $_GET['tahun']; 

        $pph15 = $this->validasi->qr_rekapSPMGab_pph15_all($thbl);
        if($pph15)
        {
            $data['skpd']           = $pph15->SKPD;
            $data['count']          = $pph15->JML_NRK;
            $data['SUM_PPHTUNDA']   = $pph15->JML_PPHTUNDA;
            $data['thbl']           = $thbl;
            $data['judul']          = 'REKAP PPH BULAN '.$bulan.' '.$tahun;
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['SUM_PPHTUNDA']   = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-';
        }

        $this->load->view('head/header');
        $this->load->view('validasi_rekap_pph15_all',$data);
        $this->load->view('head/footer');
    }

    public function qr_rptTransportDINKES(){
    	$thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 

        $transport = $this->validasi->qr_rptTransportDINKES($thbl,$klogad);
        if($transport)
        {
            $data['skpd']           = $transport->SKPD;
            $data['nalokl']         = $transport->NALOKL;
            $data['count']          = $transport->JML_NRK;
            $data['JUMBER']         = $transport->JUMBER;
            $data['thbl']           = $thbl;
            $data['judul']          = 'DAFTAR TUNJANGAN TRANSPORT PEJABAT STRUKTURAL (PENGGANTI KENDARAAN DINAS OPERASIONAL PEJABAT ) BERDASARKAN PERGUB 163 TAHUN 2016';
        }
        else
        {
            $data['skpd']           = '-';
            $data['nalokl']           = '-';
            $data['count']          = '0';
            $data['JUMBER']         = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-'; 
        }

        $this->load->view('head/header');
        $this->load->view('validasi_rptTransport',$data);
        $this->load->view('head/footer');
    }

    public function qr_rptTransportDISDIK(){
    	$thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 

        $transport = $this->validasi->qr_rptTransportDISDIK($thbl,$klogad);
        if($transport)
        {
            $data['skpd']           = $transport->SKPD;
            $data['nalokl']         = $transport->NALOKL;
            $data['count']          = $transport->JML_NRK;
            $data['JUMBER']         = $transport->JUMBER;
            $data['thbl']           = $thbl;
            $data['judul']          = 'DAFTAR TUNJANGAN TRANSPORT PEJABAT STRUKTURAL (PENGGANTI KENDARAAN DINAS OPERASIONAL PEJABAT ) BERDASARKAN PERGUB 163 TAHUN 2016';
        }
        else
        {
            $data['skpd']           = '-';
            $data['nalokl']         = '-';
            $data['count']          = '0';
            $data['JUMBER']         = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-'; 
        }

        $this->load->view('head/header');
        $this->load->view('validasi_rptTransport',$data);
        $this->load->view('head/footer');
    }

    public function qr_rptTransportSPM(){
    	$thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 

        $transport = $this->validasi->qr_rptTransportSPM($thbl,$spmu,$klogad);
        if($transport)
        {
            $data['skpd']           = $transport->SKPD;
            $data['nalokl']         = $transport->NALOKL;
            $data['count']          = $transport->JML_NRK;
            $data['JUMBER']         = $transport->JUMBER;
            $data['thbl']           = $thbl;
            $data['judul']          = 'DAFTAR TUNJANGAN TRANSPORT PEJABAT STRUKTURAL (PENGGANTI KENDARAAN DINAS OPERASIONAL PEJABAT ) BERDASARKAN PERGUB 163 TAHUN 2016';
        }
        else
        {
            $data['skpd']           = '-';
            $data['nalokl']           = '-';
            $data['count']          = '0';
            $data['JUMBER']         = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-'; 
        }

        $this->load->view('head/header');
        $this->load->view('validasi_rptTransport',$data);
        $this->load->view('head/footer');
    }

    public function qr_rptTransportSPMGab(){
    	$thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 

        $transport = $this->validasi->qr_rptTransportSPMGab($thbl,$spmu,$klogad);
        if($transport)
        {
            $data['skpd']           = $transport->SKPD;
            $data['nalokl']         = $transport->NALOKL;
            $data['count']          = $transport->JML_NRK;
            $data['JUMBER']         = $transport->JUMBER;
            $data['thbl']           = $thbl;
            $data['judul']          = 'DAFTAR TUNJANGAN TRANSPORT PEJABAT STRUKTURAL (PENGGANTI KENDARAAN DINAS OPERASIONAL PEJABAT ) BERDASARKAN PERGUB 163 TAHUN 2016';
        }
        else
        {
            $data['skpd']           = '-';
            $data['nalokl']           = '-';
            $data['count']          = '0';
            $data['JUMBER']         = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-'; 
        }
        $this->load->view('head/header');
        $this->load->view('validasi_rptTransport',$data);
        $this->load->view('head/footer');
    }

    public function qr_rekapTransportDinkes(){
    	$thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 

        $transport = $this->validasi->qr_rekapTransportDinkes($thbl,$spmu);
        if($transport)
        {
            $data['skpd']           = $transport->SKPD;
            $data['count']          = $transport->JML_NRK;
            $data['JML_JUMBER']     = $transport->JML_JUMBER;
            $data['thbl']           = $thbl;
            $data['judul']          = 'DAFTAR TUNJANGAN TRANSPORT PEJABAT STRUKTURAL (PENGGANTI KENDARAAN DINAS OPERASIONAL PEJABAT ) BERDASARKAN PERGUB 163 TAHUN 2016';
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['JML_JUMBER']     = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-'; 
        }

        $this->load->view('head/header');
        $this->load->view('validasi_rekapTransport',$data);
        $this->load->view('head/footer');
    }

    public function qr_rekapTransportDinkes_all(){
    	$thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 

        $transport = $this->validasi->qr_rekapTransportDinkes_all($thbl);
        if($transport)
        {
            $data['skpd']           = $transport->SKPD;
            $data['count']          = $transport->JML_NRK;
            $data['JML_JUMBER']     = $transport->JML_JUMBER;
            $data['thbl']           = $thbl;
            $data['judul']          = 'DAFTAR TUNJANGAN TRANSPORT PEJABAT STRUKTURAL (PENGGANTI KENDARAAN DINAS OPERASIONAL PEJABAT ) BERDASARKAN PERGUB 163 TAHUN 2016';
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['JML_JUMBER']     = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-'; 
        }
        

        $this->load->view('head/header');
        $this->load->view('validasi_rekapTransport',$data);
        $this->load->view('head/footer');
    }

    public function qr_rekapTransportDISDIK(){
    	$thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 

        $transport = $this->validasi->qr_rekapTransportDISDIK($thbl,$spmu);
        if($transport)
        {
            $data['skpd']           = $transport->SKPD;
            $data['count']          = $transport->JML_NRK;
            $data['JML_JUMBER']     = $transport->JML_JUMBER;
            $data['thbl']           = $thbl;
            $data['judul']          = 'DAFTAR TUNJANGAN TRANSPORT PEJABAT STRUKTURAL (PENGGANTI KENDARAAN DINAS OPERASIONAL PEJABAT ) BERDASARKAN PERGUB 163 TAHUN 2016';    
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['JML_JUMBER']     = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-';
        }
        

        $this->load->view('head/header');
        $this->load->view('validasi_rekapTransport',$data);
        $this->load->view('head/footer');
    }

    public function qr_rekapTransportDISDIK_all(){
    	$thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 

        $transport = $this->validasi->qr_rekapTransportDISDIK_all($thbl);
        if($transport)
        {
            $data['skpd']           = $transport->SKPD;
            $data['count']          = $transport->JML_NRK;
            $data['JML_JUMBER']     = $transport->JML_JUMBER;
            $data['thbl']           = $thbl;
            $data['judul']          = 'DAFTAR TUNJANGAN TRANSPORT PEJABAT STRUKTURAL (PENGGANTI KENDARAAN DINAS OPERASIONAL PEJABAT ) BERDASARKAN PERGUB 163 TAHUN 2016';
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['JML_JUMBER']     = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-';
        }

        

        $this->load->view('head/header');
        $this->load->view('validasi_rekapTransport',$data);
        $this->load->view('head/footer');
    }

    public function qr_rekapTransportSPM(){
    	$thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 

        $transport = $this->validasi->qr_rekapTransportSPM($thbl,$spmu);
        if($transport)
        {
            $data['skpd']           = $transport->SKPD;
            $data['count']          = $transport->JML_NRK;
            $data['JML_JUMBER']     = $transport->JML_JUMBER;
            $data['thbl']           = $thbl;
            $data['judul']          = 'DAFTAR TUNJANGAN TRANSPORT PEJABAT STRUKTURAL (PENGGANTI KENDARAAN DINAS OPERASIONAL PEJABAT ) BERDASARKAN PERGUB 163 TAHUN 2016';
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['JML_JUMBER']     = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-';
        }
        

        $this->load->view('head/header');
        $this->load->view('validasi_rekapTransport',$data);
        $this->load->view('head/footer');
    }

    public function qr_rekapTransportSPM_all(){
    	$thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 

        $transport = $this->validasi->qr_rekapTransportSPM($thbl,$spmu);
        if($transport)
        {
            $data['skpd']           = $transport->SKPD;
            $data['count']          = $transport->JML_NRK;
            $data['JML_JUMBER']     = $transport->JML_JUMBER;
            $data['thbl']           = $thbl;
            $data['judul']          = 'DAFTAR TUNJANGAN TRANSPORT PEJABAT STRUKTURAL (PENGGANTI KENDARAAN DINAS OPERASIONAL PEJABAT ) BERDASARKAN PERGUB 163 TAHUN 2016';
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['JML_JUMBER']     = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-';
        }
        

        $this->load->view('head/header');
        $this->load->view('validasi_rekapTransport',$data);
        $this->load->view('head/footer');
    }

    public function qr_rekapTransportgab(){
    	$thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 

        $transport = $this->validasi->qr_rekapTransportgab($thbl,$spmu);
        if($transport)
        {
            $data['skpd']           = $transport->SKPD;
            $data['count']          = $transport->JML_NRK;
            $data['JML_JUMBER']     = $transport->JML_JUMBER;
            $data['thbl']           = $thbl;
            $data['judul']          = 'DAFTAR TUNJANGAN TRANSPORT PEJABAT STRUKTURAL (PENGGANTI KENDARAAN DINAS OPERASIONAL PEJABAT ) BERDASARKAN PERGUB 163 TAHUN 2016';
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['JML_JUMBER']     = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-';
        }

        $this->load->view('head/header');
        $this->load->view('validasi_rekapTransport',$data);
        $this->load->view('head/footer');
    }

    public function qr_rekapTransportgab_all(){
    	$thbl = $_GET['thbl'];
        $spmu = $_GET['spmu'];
        $klogad = $_GET['klogad']; 

        $transport = $this->validasi->qr_rekapTransportgab_all($thbl);
        if($transport)
        {
            $data['skpd']           = $transport->SKPD;
            $data['count']          = $transport->JML_NRK;
            $data['JML_JUMBER']     = $transport->JML_JUMBER;
            $data['thbl']           = $thbl;
            $data['judul']          = 'DAFTAR TUNJANGAN TRANSPORT PEJABAT STRUKTURAL (PENGGANTI KENDARAAN DINAS OPERASIONAL PEJABAT ) BERDASARKAN PERGUB 163 TAHUN 2016';    
        }
        else
        {
            $data['skpd']           = '-';
            $data['count']          = '0';
            $data['JML_JUMBER']     = '-';
            $data['thbl']           = '-';
            $data['judul']          = '-';
        }
        

        $this->load->view('head/header');
        $this->load->view('validasi_rekapTransport',$data);
        $this->load->view('head/footer');
    }

    public function qrbkl()
    {  
        
        $thbl = $_GET['thbl'];
        $nrk = $_GET['nrk'];
        $gj = $this->validasi->qrbkl($thbl,$nrk);
 
        $data['nrk']   = $nrk;
        if($gj)
        {
            $data['nama']  = $gj->NAMA;
            $data['thbl']  = $gj->THBL_NOM;
            $data['gjbaru'] = $gj->GJBARU;
            $data['gol']   = $gj->GOLONGAN;
            $data['masker'] = $gj->MASKER;
            $data['lokasi'] = $gj->LOKASI;    
        }
        else
        {
            $data['nama']  = 'Data tidak ada';
            $data['thbl']  = '-';
            $data['gjbaru'] = '0';
            $data['gol']   = 'Data tidak ada';
            $data['masker'] = '-';
            $data['lokasi'] = 'Data tidak ada';
        }
        

        $this->load->view('head/header');
        // $this->load->view('head/menu');
        $this->load->view('validasi_berkala',$data);
        $this->load->view('head/footer');

        /*"http://pegawai.jakarta.go.id/validasi/qrbkl"*/
    }
//---------------------------------------------------------------------------------------------------------------------//

    public function getData()
    {
        
        $this->load->view('head/header');
        $this->load->view('head/menu',$datam);
        $this->load->view('validasi');
        $this->load->view('head/footer');
       
            
    }



   

/*START UPLOAD PHOTO*/
    public function upload_file(){

        if(isset($_POST['nrk'])){
            $nrk = $_POST['nrk'];
        }else{
            $nrk = "empty";
        }

        $config = array(
            'upload_path' => 'assets/img/photo/',
            'allowed_types' => 'jpeg|jpg|png',
            'file_name' => ''.$nrk.'.jpg',
            'file_ext_tolower' => TRUE,
            'overwrite' => TRUE,
            'max_size' => 1024,
            // 'max_width' => 1024,
            // 'max_height' => 768,           
            // 'min_width' => 10,
            // 'min_height' => 7,     
            'max_filename' => 0,
            'remove_spaces' => TRUE
        );
 
        $this->load->library('upload', $config);        
 
        if ( ! $this->upload->do_upload())
        {
            $hasil = $this->upload->display_errors();            
        }
        else
        {
            $config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 85; //40
            $config['height'] = 85; //40

            $this->load->library('image_lib', $config);

            if ( ! $this->image_lib->resize()){                
                $result = $this->image_lib->display_errors('', '');
            }else{
                $result = 'SUKSES';
            }

            // $hasil = $this->upload->data();
            $hasil = array('result' => $result);
        }

        echo json_encode($hasil);
    }
/*END UPLOAD PHOTO*/

    public function gantiPassword()
    {
         
        $insert = $this->home->save_userData($this->user['id']);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }



    function tampilPhoto($nrk=''){
        // Now query back the uploaded BLOB and display it
        $rs=$this->mdl->get_data($nrk)->row();
        $result = $rs->X_PHOTO->load();
// If any text (or whitespace!) is printed before this header is sent,
// the text won't be displayed and the image won't display properly.
// Comment out this line to see the text and debug such a problem.
        header("Content-type: image/JPEG");
        echo $result;
    }

    

}
