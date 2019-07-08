<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tubkd extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
        $this->load->helper(array('form', 'url'));    	
    	$this->load->library('session');
        
    	$this->load->model('mhome','home');
        $this->load->library('infopegawai');
        $this->load->library('convert');
        $this->load->model('mtubkd','tubkd');

    	if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']     	= $session_data['id'];
            $this->user['username']  	= $session_data['username'];
            $this->user['user_group']     = $session_data['user_group'];

        }else{
			redirect(base_url().'login', 'refresh');
		}	    
   	}

	/*public function idx_2()
	{  
            $data['ref_permohonan'] = $this->permohonan->get_permohonan();    
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
                //$datam['li']=$this->home->showMenu();
                // $datam['activeMenu'] = "3762";
                // $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'skpdpermohonan',0);
                // $datam['inisial'] = 'skpdpermohonan';
           
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
			// $this->load->view('head/header',$this->user);
			// $this->load->view('head/menu',$datam);
			// $this->load->view('v_indexskpd',$data);
			// $this->load->view('head/footer');
	}*/

    public function index(){
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
            //$datam['li']=$this->home->showMenu();
            $datam['activeMenu'] = "4373";
            $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
            // $datam['inisial'] = 'tubkd';
            
            $data['sop'] = $this->tubkd->get_sop();                
            $data['jenis_permohonan'] = $this->tubkd->get_permohonan();
            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
            // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];

            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vindextubkd',$data);
            //$this->load->view('admin/pegawai_list',$data);
            $this->load->view('head/footer');
    }

    public function index_old()
    {
        $post = $this->input->post();
        @$_SESSION['logged_in']['id_sop'] = $post['id_sop'];
        // var_dump($_SESSION['logged_in']['id_sop']);exit;
        // var_dump($this->session->userdata);exit;
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
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "4373";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
               // $datam['inisial'] = 'tubkd';
                

            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            $data['id_sop'] = $post['id_sop'];

            $id_sop = $post['id_sop'];
            // var_dump($id_sop);exit;
            if($id_sop == 1){
                //tubkd tahap 1
                $data['jumlah_permohonan_terima'] = $this->tubkd->count_data(1, $id_sop);
                $data['jumlah_permohonan'] = $this->tubkd->count_data(2, $id_sop);

                //tubkd tahap 2
                $data['jumlah_permohonan_terima2'] = $this->tubkd->count_data(3, $id_sop);
                $data['jumlah_permohonan2'] = $this->tubkd->count_data(4, $id_sop);

                //tubkd tahap 3
                $data['jumlah_permohonan_terima3'] = $this->tubkd->count_data(5, $id_sop);
                $data['jumlah_permohonan3'] = $this->tubkd->count_data(6, $id_sop);

                //tubkd tahap 4
                $data['jumlah_permohonan_terima4'] = $this->tubkd->count_data(7, $id_sop);            
                $data['jumlah_permohonan4'] = $this->tubkd->count_data(8, $id_sop);
                @$data['sop'] = $this->load->view('jabfung_sop1', $data, TRUE);
            }elseif($id_sop == 2){
                //tubkd tahap 1
                $data['jumlah_permohonan_terima'] = $this->tubkd->count_data(1, $id_sop);
                $data['jumlah_permohonan'] = $this->tubkd->count_data(2, $id_sop);

                //tubkd tahap 2
                $data['jumlah_permohonan_terima2'] = $this->tubkd->count_data(3, $id_sop);
                $data['jumlah_permohonan2'] = $this->tubkd->count_data(4, $id_sop);

                //tubkd tahap 3
                $data['jumlah_permohonan_terima3'] = $this->tubkd->count_data(5, $id_sop);
                $data['jumlah_permohonan3'] = $this->tubkd->count_data(6, $id_sop);

                //tubkd tahap 4
                $data['jumlah_permohonan_terima4'] = $this->tubkd->count_data(7, $id_sop);            
                $data['jumlah_permohonan4'] = $this->tubkd->count_data(8, $id_sop);
                
                //tubkd tahap 5
                $data['jumlah_permohonan_terima5'] = $this->tubkd->count_data(9, $id_sop);            
                $data['jumlah_permohonan5'] = $this->tubkd->count_data(10, $id_sop);
                @$data['sop'] = $this->load->view('jabfung_sop2', $data, TRUE);
            }elseif($id_sop == 3){
                //tubkd tahap 1
                $data['jumlah_permohonan_terima'] = $this->tubkd->count_data(1, $id_sop);
                $data['jumlah_permohonan'] = $this->tubkd->count_data(2, $id_sop);

                //tubkd tahap 2
                $data['jumlah_permohonan_terima2'] = $this->tubkd->count_data(3, $id_sop);
                $data['jumlah_permohonan2'] = $this->tubkd->count_data(4, $id_sop);

                //tubkd tahap 3
                $data['jumlah_permohonan_terima3'] = $this->tubkd->count_data(5, $id_sop);
                $data['jumlah_permohonan3'] = $this->tubkd->count_data(6, $id_sop);

                //tubkd tahap 4
                $data['jumlah_permohonan_terima4'] = $this->tubkd->count_data(7, $id_sop);            
                $data['jumlah_permohonan4'] = $this->tubkd->count_data(8, $id_sop);
                
                //tubkd tahap 5
                $data['jumlah_permohonan_terima5'] = $this->tubkd->count_data(9, $id_sop);            
                $data['jumlah_permohonan5'] = $this->tubkd->count_data(10, $id_sop);

                //tubkd tahap 6
                $data['jumlah_permohonan_terima6'] = $this->tubkd->count_data(11, $id_sop);            
                $data['jumlah_permohonan6'] = $this->tubkd->count_data(12, $id_sop);
                $data['sop'] = $this->load->view('jabfung_sop3', $data, TRUE);
            }
            // $this->load->view('head/header',$this->user);
            // $this->load->view('head/menu', $datam);
            $this->load->view('dashboard_tubkd',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');
            //}

    }

    public function dashboard()
    {
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
        //$datam['li']=$this->home->showMenu();
        $datam['activeMenu'] = "4373";
        $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
        // $datam['inisial'] = 'tubkd';


        $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
        $data['nrk'] = $nrk;
        // var_dump( $data['nrk']);
        $datam['nrk'] = $nrk;
        $datam['user_group'] = $this->user['user_group'];
        $data['user_id'] = $this->user['id'];
        $data['user_group'] = $this->user['user_group'];
        $infoUser = $this->home->getUserInfo2($nrk);

        $infoUser3 = $this->home->getuserInfo3($nrk);
        $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
        $data['infoUser'] = $infoUser;
        $data['infoUser3'] = $infoUser3;
        $data['infoUserJabatan'] = $infoUserJabatan;


        //tubkd tahap 1
        $data['jml_permohonan_bidpengembangan'] = $this->tubkd->count_data_p_bid_pengembangan();


        $this->load->view('head/header',$this->user);
        $this->load->view('head/menu', $datam);
        $this->load->view('dashboard_tubkd_v2',$data);
        //$this->load->view('admin/pegawai_list',$data);
        $this->load->view('head/footer');

    }

    public function subDashboardPengembangan1()
    {
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
        //$datam['li']=$this->home->showMenu();
        $datam['activeMenu'] = "4373";
        $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
        // $datam['inisial'] = 'tubkd';


        $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
        $data['nrk'] = $nrk;
        // var_dump( $data['nrk']);
        $datam['nrk'] = $nrk;
        $datam['user_group'] = $this->user['user_group'];
        $data['user_id'] = $this->user['id'];
        $data['user_group'] = $this->user['user_group'];
        $infoUser = $this->home->getUserInfo2($nrk);

        $infoUser3 = $this->home->getuserInfo3($nrk);
        $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
        $data['infoUser'] = $infoUser;
        $data['infoUser3'] = $infoUser3;
        $data['infoUserJabatan'] = $infoUserJabatan;


        //tubkd tahap 1
        $data['jumlah_permohonan_terima'] = $this->tubkd->count_data(1);
        $data['jumlah_permohonan'] = $this->tubkd->count_data(2);

        //tubkd tahap 2
        $data['jumlah_permohonan_terima2'] = $this->tubkd->count_data(3);
        $data['jumlah_permohonan2'] = $this->tubkd->count_data(4);

        //tubkd tahap 3
        $data['jumlah_permohonan_terima3'] = $this->tubkd->count_data(5);
        $data['jumlah_permohonan3'] = $this->tubkd->count_data(6);

        //tubkd tahap 4
        $data['jumlah_permohonan_terima4'] = $this->tubkd->count_data(7);
        $data['jumlah_permohonan4'] = $this->tubkd->count_data(8);

        $this->load->view('head/header',$this->user);
        $this->load->view('head/menu', $datam);
        $this->load->view('sub_dashboard_pengembangan1',$data);
        //$this->load->view('admin/pegawai_list',$data);
        $this->load->view('head/footer');

    }

    public function subDashboardPengembangan2()
    {
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
        //$datam['li']=$this->home->showMenu();
        $datam['activeMenu'] = "4373";
        $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
        // $datam['inisial'] = 'tubkd';


        $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
        $data['nrk'] = $nrk;
        // var_dump( $data['nrk']);
        $datam['nrk'] = $nrk;
        $datam['user_group'] = $this->user['user_group'];
        $data['user_id'] = $this->user['id'];
        $data['user_group'] = $this->user['user_group'];
        $infoUser = $this->home->getUserInfo2($nrk);

        $infoUser3 = $this->home->getuserInfo3($nrk);
        $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
        $data['infoUser'] = $infoUser;
        $data['infoUser3'] = $infoUser3;
        $data['infoUserJabatan'] = $infoUserJabatan;


        //tubkd tahap 1
        $data['jumlah_permohonan_terima'] = $this->tubkd->count_data(1);
        $data['jumlah_permohonan'] = $this->tubkd->count_data(2);

        //tubkd tahap 2
        $data['jumlah_permohonan_terima2'] = $this->tubkd->count_data(3);
        $data['jumlah_permohonan2'] = $this->tubkd->count_data(4);

        //tubkd tahap 3
        $data['jumlah_permohonan_terima3'] = $this->tubkd->count_data(5);
        $data['jumlah_permohonan3'] = $this->tubkd->count_data(6);

        //tubkd tahap 4
        $data['jumlah_permohonan_terima4'] = $this->tubkd->count_data(7);
        $data['jumlah_permohonan4'] = $this->tubkd->count_data(8);

        $this->load->view('head/header',$this->user);
        $this->load->view('head/menu', $datam);
        $this->load->view('sub_dashboard_pengembangan2',$data);
        //$this->load->view('admin/pegawai_list',$data);
        $this->load->view('head/footer');

    }

    public function idx_2()
    {  
            $post = $this->input->post();
            $data['ref_permohonan'] = $post['REF_PERMOHONAN'];
            $data['jenis_permohonan'] = $this->tubkd->get_jenis_permohonan($post['REF_PERMOHONAN']);
            //$data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            // $data['ref_permohonan'] = $this->permohonan->get_permohonan();    
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
                //$datam['li']=$this->home->showMenu();
               $datam['activeMenu'] = "4373";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
  

            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            $this->load->view('vtubkd',$data);

    }

    public function permohonan()
    {
       $data['ref_permohonan'] = $this->tubkd->get_permohonan();
       // var_dump($data['ref_permohonan']);exit;
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
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "4373";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
                
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            // START MEMUNCULKAN TOMBOL BACK KE ATASAN            
            $data['thbl'] = $bulantahun;
            if($nrk == $this->user['id']){
                $data['showBack'] = 'none';
                $data['nrkatasan'] = '';
            }else{
                $data['showBack'] = '';
                $data['nrkatasan'] = $this->infopegawai->getAtasanPegawai($nrk,$thbl);   
                

                if($data['nrkatasan'] == ""){                    
                    $data['nrkatasan'] = $this->user['id'];
                }
            }
            // END MEMUNCULKAN TOMBOL BACK KE ATASAN

            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)



            // START Inisial Active Menu
            
            // END Inisial Active Menu

            
            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];

            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            // $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            // if ($data['bawahan'] == "") {
                
            //         $date = strtotime('-1 months');
            //         $thbl = date('Ym',$date);
            //         $bulantahun = date('M Y',$date);
            //         $data['thbl'] = $bulantahun;
            //     $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            // }

            // $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            //$data['data_permohonan'] = $this->permohonan->get_permohonan();
            $this->load->model('mskpd','skpd');
            $data['ref_permohonan'] = $this->skpd->get_permohonan();
            $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan();
            $data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            //$data['all_permohonan'] = $this->tubkd->get_all_permohonan();
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vtubkd',$data);
            // $this->load->view('v_indextubkd',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');

    }

    public function permohonan_tahap2()
    {
       $data['ref_permohonan'] = $this->tubkd->get_permohonan();

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
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "4373";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
                
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            // START MEMUNCULKAN TOMBOL BACK KE ATASAN            
            $data['thbl'] = $bulantahun;
            if($nrk == $this->user['id']){
                $data['showBack'] = 'none';
                $data['nrkatasan'] = '';
            }else{
                $data['showBack'] = '';
                $data['nrkatasan'] = $this->infopegawai->getAtasanPegawai($nrk,$thbl);   
                

                if($data['nrkatasan'] == ""){                    
                    $data['nrkatasan'] = $this->user['id'];
                }
            }
            // END MEMUNCULKAN TOMBOL BACK KE ATASAN

            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)



            // START Inisial Active Menu
            
            // END Inisial Active Menu

            
            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];

            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            // $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            // if ($data['bawahan'] == "") {
                
            //         $date = strtotime('-1 months');
            //         $thbl = date('Ym',$date);
            //         $bulantahun = date('M Y',$date);
            //         $data['thbl'] = $bulantahun;
            //     $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            // }

            // $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            //$data['data_permohonan'] = $this->permohonan->get_permohonan();
            $this->load->model('mskpd','skpd');
            $data['ref_permohonan'] = $this->skpd->get_permohonan();
            $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan();
            $data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vtubkd2',$data);
            // $this->load->view('v_indextubkd',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');

    }

    public function permohonan_tahap3()
    {
       $data['ref_permohonan'] = $this->tubkd->get_permohonan();

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
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "4373";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
                
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            // START MEMUNCULKAN TOMBOL BACK KE ATASAN            
            $data['thbl'] = $bulantahun;
            if($nrk == $this->user['id']){
                $data['showBack'] = 'none';
                $data['nrkatasan'] = '';
            }else{
                $data['showBack'] = '';
                $data['nrkatasan'] = $this->infopegawai->getAtasanPegawai($nrk,$thbl);   
                

                if($data['nrkatasan'] == ""){                    
                    $data['nrkatasan'] = $this->user['id'];
                }
            }
            // END MEMUNCULKAN TOMBOL BACK KE ATASAN

            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)



            // START Inisial Active Menu
            
            // END Inisial Active Menu

            
            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];

            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            // $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            // if ($data['bawahan'] == "") {
                
            //         $date = strtotime('-1 months');
            //         $thbl = date('Ym',$date);
            //         $bulantahun = date('M Y',$date);
            //         $data['thbl'] = $bulantahun;
            //     $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            // }

            // $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            //$data['data_permohonan'] = $this->permohonan->get_permohonan();
            $this->load->model('mskpd','skpd');
            $data['ref_permohonan'] = $this->skpd->get_permohonan();
            $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan();
            $data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vtubkd3',$data);
            // $this->load->view('v_indextubkd',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');

    }

    public function permohonan_tahap4()
    {
       $data['ref_permohonan'] = $this->tubkd->get_permohonan();

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
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "4373";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
                
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            // START MEMUNCULKAN TOMBOL BACK KE ATASAN            
            $data['thbl'] = $bulantahun;
            if($nrk == $this->user['id']){
                $data['showBack'] = 'none';
                $data['nrkatasan'] = '';
            }else{
                $data['showBack'] = '';
                $data['nrkatasan'] = $this->infopegawai->getAtasanPegawai($nrk,$thbl);   
                

                if($data['nrkatasan'] == ""){                    
                    $data['nrkatasan'] = $this->user['id'];
                }
            }
            // END MEMUNCULKAN TOMBOL BACK KE ATASAN

            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)



            // START Inisial Active Menu
            
            // END Inisial Active Menu

            
            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];

            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            // $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            // if ($data['bawahan'] == "") {
                
            //         $date = strtotime('-1 months');
            //         $thbl = date('Ym',$date);
            //         $bulantahun = date('M Y',$date);
            //         $data['thbl'] = $bulantahun;
            //     $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            // }

            // $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            //$data['data_permohonan'] = $this->permohonan->get_permohonan();
            $this->load->model('mskpd','skpd');
            $data['ref_permohonan'] = $this->skpd->get_permohonan();
            $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan();
            $data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            $data['pemaraf_serta'] = $this->getPemaraf();
            $this->load->model('msubbid','subbid');
            $data['klogad'] = $this->subbid->getKlogad();
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vtubkd4',$data);
            // $this->load->view('v_indextubkd',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');

    }

    function getPemaraf(){
        $this->load->model('msubbid','subbid');
        $res = $this->subbid->get_pemaraf_serta();
        return $res;
    }

    public function permohonan_tahap5()
    {
       $data['ref_permohonan'] = $this->tubkd->get_permohonan();

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
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "4373";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
                
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            // START MEMUNCULKAN TOMBOL BACK KE ATASAN            
            $data['thbl'] = $bulantahun;
            if($nrk == $this->user['id']){
                $data['showBack'] = 'none';
                $data['nrkatasan'] = '';
            }else{
                $data['showBack'] = '';
                $data['nrkatasan'] = $this->infopegawai->getAtasanPegawai($nrk,$thbl);   
                

                if($data['nrkatasan'] == ""){                    
                    $data['nrkatasan'] = $this->user['id'];
                }
            }
            // END MEMUNCULKAN TOMBOL BACK KE ATASAN

            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)



            // START Inisial Active Menu
            
            // END Inisial Active Menu

            
            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];

            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            // $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            // if ($data['bawahan'] == "") {
                
            //         $date = strtotime('-1 months');
            //         $thbl = date('Ym',$date);
            //         $bulantahun = date('M Y',$date);
            //         $data['thbl'] = $bulantahun;
            //     $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            // }

            // $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            //$data['data_permohonan'] = $this->permohonan->get_permohonan();
            $this->load->model('mskpd','skpd');
            $data['ref_permohonan'] = $this->skpd->get_permohonan();
            $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan();
            $data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vtubkd5',$data);
            // $this->load->view('v_indextubkd',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');

    }

    public function permohonan_tahap6()
    {
       $data['ref_permohonan'] = $this->tubkd->get_permohonan();

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
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "4373";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
                
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            // START MEMUNCULKAN TOMBOL BACK KE ATASAN            
            $data['thbl'] = $bulantahun;
            if($nrk == $this->user['id']){
                $data['showBack'] = 'none';
                $data['nrkatasan'] = '';
            }else{
                $data['showBack'] = '';
                $data['nrkatasan'] = $this->infopegawai->getAtasanPegawai($nrk,$thbl);   
                

                if($data['nrkatasan'] == ""){                    
                    $data['nrkatasan'] = $this->user['id'];
                }
            }
            // END MEMUNCULKAN TOMBOL BACK KE ATASAN

            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)



            // START Inisial Active Menu
            
            // END Inisial Active Menu

            
            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];

            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            // $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            // if ($data['bawahan'] == "") {
                
            //         $date = strtotime('-1 months');
            //         $thbl = date('Ym',$date);
            //         $bulantahun = date('M Y',$date);
            //         $data['thbl'] = $bulantahun;
            //     $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            // }

            // $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            //$data['data_permohonan'] = $this->permohonan->get_permohonan();
            $this->load->model('mskpd','skpd');
            $data['ref_permohonan'] = $this->skpd->get_permohonan();
            $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan();
            $data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vtubkd6',$data);
            // $this->load->view('v_indextubkd',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');

    }

    public function dashboard_terima(){
       $data['ref_permohonan'] = $this->tubkd->get_permohonan();

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
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "4373";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
                
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            // START MEMUNCULKAN TOMBOL BACK KE ATASAN            
            $data['thbl'] = $bulantahun;
            if($nrk == $this->user['id']){
                $data['showBack'] = 'none';
                $data['nrkatasan'] = '';
            }else{
                $data['showBack'] = '';
                $data['nrkatasan'] = $this->infopegawai->getAtasanPegawai($nrk,$thbl);   
                

                if($data['nrkatasan'] == ""){                    
                    $data['nrkatasan'] = $this->user['id'];
                }
            }
            // END MEMUNCULKAN TOMBOL BACK KE ATASAN

            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)



            // START Inisial Active Menu
            
            // END Inisial Active Menu

            
            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];

            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            // $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            // if ($data['bawahan'] == "") {
                
            //         $date = strtotime('-1 months');
            //         $thbl = date('Ym',$date);
            //         $bulantahun = date('M Y',$date);
            //         $data['thbl'] = $bulantahun;
            //     $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            // }

            // $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            //$data['data_permohonan'] = $this->permohonan->get_permohonan();
            $this->load->model('mskpd','skpd');
            $data['ref_permohonan'] = $this->skpd->get_permohonan();
            $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan();
            $data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vtubkd_terima',$data);
            // $this->load->view('v_indextubkd',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');	
    }
    
    public function dashboard_terima2(){
       $data['ref_permohonan'] = $this->tubkd->get_permohonan();

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
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "4373";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
                
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            // START MEMUNCULKAN TOMBOL BACK KE ATASAN            
            $data['thbl'] = $bulantahun;
            if($nrk == $this->user['id']){
                $data['showBack'] = 'none';
                $data['nrkatasan'] = '';
            }else{
                $data['showBack'] = '';
                $data['nrkatasan'] = $this->infopegawai->getAtasanPegawai($nrk,$thbl);   
                

                if($data['nrkatasan'] == ""){                    
                    $data['nrkatasan'] = $this->user['id'];
                }
            }
            // END MEMUNCULKAN TOMBOL BACK KE ATASAN

            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)



            // START Inisial Active Menu
            
            // END Inisial Active Menu

            
            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];

            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            // $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            // if ($data['bawahan'] == "") {
                
            //         $date = strtotime('-1 months');
            //         $thbl = date('Ym',$date);
            //         $bulantahun = date('M Y',$date);
            //         $data['thbl'] = $bulantahun;
            //     $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            // }

            // $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            //$data['data_permohonan'] = $this->permohonan->get_permohonan();
            $this->load->model('mskpd','skpd');
            $data['ref_permohonan'] = $this->skpd->get_permohonan();
            $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan();
            $data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vtubkd_terima2',$data);
            // $this->load->view('v_indextubkd',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');	
    }
    
    public function dashboard_terima3(){
       $data['ref_permohonan'] = $this->tubkd->get_permohonan();

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
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "4373";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
                
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            // START MEMUNCULKAN TOMBOL BACK KE ATASAN            
            $data['thbl'] = $bulantahun;
            if($nrk == $this->user['id']){
                $data['showBack'] = 'none';
                $data['nrkatasan'] = '';
            }else{
                $data['showBack'] = '';
                $data['nrkatasan'] = $this->infopegawai->getAtasanPegawai($nrk,$thbl);   
                

                if($data['nrkatasan'] == ""){                    
                    $data['nrkatasan'] = $this->user['id'];
                }
            }
            // END MEMUNCULKAN TOMBOL BACK KE ATASAN

            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)



            // START Inisial Active Menu
            
            // END Inisial Active Menu

            
            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];

            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            // $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            // if ($data['bawahan'] == "") {
                
            //         $date = strtotime('-1 months');
            //         $thbl = date('Ym',$date);
            //         $bulantahun = date('M Y',$date);
            //         $data['thbl'] = $bulantahun;
            //     $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            // }

            // $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            //$data['data_permohonan'] = $this->permohonan->get_permohonan();
            $this->load->model('mskpd','skpd');
            $data['ref_permohonan'] = $this->skpd->get_permohonan();
            $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan();
            $data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vtubkd_terima3',$data);
            // $this->load->view('v_indextubkd',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');	
    }
    
    public function dashboard_terima4(){
       $data['ref_permohonan'] = $this->tubkd->get_permohonan();

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
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "4373";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
                
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            // START MEMUNCULKAN TOMBOL BACK KE ATASAN            
            $data['thbl'] = $bulantahun;
            if($nrk == $this->user['id']){
                $data['showBack'] = 'none';
                $data['nrkatasan'] = '';
            }else{
                $data['showBack'] = '';
                $data['nrkatasan'] = $this->infopegawai->getAtasanPegawai($nrk,$thbl);   
                

                if($data['nrkatasan'] == ""){                    
                    $data['nrkatasan'] = $this->user['id'];
                }
            }
            // END MEMUNCULKAN TOMBOL BACK KE ATASAN

            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)



            // START Inisial Active Menu
            
            // END Inisial Active Menu

            
            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];

            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            // $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            // if ($data['bawahan'] == "") {
                
            //         $date = strtotime('-1 months');
            //         $thbl = date('Ym',$date);
            //         $bulantahun = date('M Y',$date);
            //         $data['thbl'] = $bulantahun;
            //     $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            // }

            // $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            //$data['data_permohonan'] = $this->permohonan->get_permohonan();
            $this->load->model('mskpd','skpd');
            $data['ref_permohonan'] = $this->skpd->get_permohonan();
            $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan();
            $data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vtubkd_terima4',$data);
            // $this->load->view('v_indextubkd',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');	
    }

    public function dashboard_terima5(){
       $data['ref_permohonan'] = $this->tubkd->get_permohonan();

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
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "4373";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
                
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            // START MEMUNCULKAN TOMBOL BACK KE ATASAN            
            $data['thbl'] = $bulantahun;
            if($nrk == $this->user['id']){
                $data['showBack'] = 'none';
                $data['nrkatasan'] = '';
            }else{
                $data['showBack'] = '';
                $data['nrkatasan'] = $this->infopegawai->getAtasanPegawai($nrk,$thbl);   
                

                if($data['nrkatasan'] == ""){                    
                    $data['nrkatasan'] = $this->user['id'];
                }
            }
            // END MEMUNCULKAN TOMBOL BACK KE ATASAN

            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)



            // START Inisial Active Menu
            
            // END Inisial Active Menu

            
            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];

            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            // $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            // if ($data['bawahan'] == "") {
                
            //         $date = strtotime('-1 months');
            //         $thbl = date('Ym',$date);
            //         $bulantahun = date('M Y',$date);
            //         $data['thbl'] = $bulantahun;
            //     $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            // }

            // $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            //$data['data_permohonan'] = $this->permohonan->get_permohonan();
            $this->load->model('mskpd','skpd');
            $data['ref_permohonan'] = $this->skpd->get_permohonan();
            $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan();
            $data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vtubkd_terima5',$data);
            // $this->load->view('v_indextubkd',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');    
    }

    public function dashboard_terima6(){
       $data['ref_permohonan'] = $this->tubkd->get_permohonan();

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
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "4373";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
                
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            // START MEMUNCULKAN TOMBOL BACK KE ATASAN            
            $data['thbl'] = $bulantahun;
            if($nrk == $this->user['id']){
                $data['showBack'] = 'none';
                $data['nrkatasan'] = '';
            }else{
                $data['showBack'] = '';
                $data['nrkatasan'] = $this->infopegawai->getAtasanPegawai($nrk,$thbl);   
                

                if($data['nrkatasan'] == ""){                    
                    $data['nrkatasan'] = $this->user['id'];
                }
            }
            // END MEMUNCULKAN TOMBOL BACK KE ATASAN

            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)



            // START Inisial Active Menu
            
            // END Inisial Active Menu

            
            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];

            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            // $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            // if ($data['bawahan'] == "") {
                
            //         $date = strtotime('-1 months');
            //         $thbl = date('Ym',$date);
            //         $bulantahun = date('M Y',$date);
            //         $data['thbl'] = $bulantahun;
            //     $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            // }

            // $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            //$data['data_permohonan'] = $this->permohonan->get_permohonan();
            $this->load->model('mskpd','skpd');
            $data['ref_permohonan'] = $this->skpd->get_permohonan();
            $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan();
            $data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vtubkd_terima6',$data);
            // $this->load->view('v_indextubkd',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');    
    }
    
    public function dashboard_tolak(){
       $data['ref_permohonan'] = $this->tubkd->get_permohonan();

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
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "4373";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
                
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            // START MEMUNCULKAN TOMBOL BACK KE ATASAN            
            $data['thbl'] = $bulantahun;
            if($nrk == $this->user['id']){
                $data['showBack'] = 'none';
                $data['nrkatasan'] = '';
            }else{
                $data['showBack'] = '';
                $data['nrkatasan'] = $this->infopegawai->getAtasanPegawai($nrk,$thbl);   
                

                if($data['nrkatasan'] == ""){                    
                    $data['nrkatasan'] = $this->user['id'];
                }
            }
            // END MEMUNCULKAN TOMBOL BACK KE ATASAN

            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)



            // START Inisial Active Menu
            
            // END Inisial Active Menu

            
            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];

            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            // $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            // if ($data['bawahan'] == "") {
                
            //         $date = strtotime('-1 months');
            //         $thbl = date('Ym',$date);
            //         $bulantahun = date('M Y',$date);
            //         $data['thbl'] = $bulantahun;
            //     $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            // }

            // $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            //$data['data_permohonan'] = $this->permohonan->get_permohonan();
            $this->load->model('mskpd','skpd');
            $data['ref_permohonan'] = $this->skpd->get_permohonan();
            $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan();
            $data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vtubkd_tolak',$data);
            // $this->load->view('v_indextubkd',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');	
    }
    
    public function dashboard_tolak2(){
       $data['ref_permohonan'] = $this->tubkd->get_permohonan();

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
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "4373";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
                
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            // START MEMUNCULKAN TOMBOL BACK KE ATASAN            
            $data['thbl'] = $bulantahun;
            if($nrk == $this->user['id']){
                $data['showBack'] = 'none';
                $data['nrkatasan'] = '';
            }else{
                $data['showBack'] = '';
                $data['nrkatasan'] = $this->infopegawai->getAtasanPegawai($nrk,$thbl);   
                

                if($data['nrkatasan'] == ""){                    
                    $data['nrkatasan'] = $this->user['id'];
                }
            }
            // END MEMUNCULKAN TOMBOL BACK KE ATASAN

            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)



            // START Inisial Active Menu
            
            // END Inisial Active Menu

            
            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];

            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            // $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            // if ($data['bawahan'] == "") {
                
            //         $date = strtotime('-1 months');
            //         $thbl = date('Ym',$date);
            //         $bulantahun = date('M Y',$date);
            //         $data['thbl'] = $bulantahun;
            //     $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            // }

            // $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            //$data['data_permohonan'] = $this->permohonan->get_permohonan();
            $this->load->model('mskpd','skpd');
            $data['ref_permohonan'] = $this->skpd->get_permohonan();
            $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan();
            $data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vtubkd_tolak2',$data);
            // $this->load->view('v_indextubkd',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');	
    }
    
    public function dashboard_tolak3(){
       $data['ref_permohonan'] = $this->tubkd->get_permohonan();

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
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "4373";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
                
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            // START MEMUNCULKAN TOMBOL BACK KE ATASAN            
            $data['thbl'] = $bulantahun;
            if($nrk == $this->user['id']){
                $data['showBack'] = 'none';
                $data['nrkatasan'] = '';
            }else{
                $data['showBack'] = '';
                $data['nrkatasan'] = $this->infopegawai->getAtasanPegawai($nrk,$thbl);   
                

                if($data['nrkatasan'] == ""){                    
                    $data['nrkatasan'] = $this->user['id'];
                }
            }
            // END MEMUNCULKAN TOMBOL BACK KE ATASAN

            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)



            // START Inisial Active Menu
            
            // END Inisial Active Menu

            
            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];

            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            // $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            // if ($data['bawahan'] == "") {
                
            //         $date = strtotime('-1 months');
            //         $thbl = date('Ym',$date);
            //         $bulantahun = date('M Y',$date);
            //         $data['thbl'] = $bulantahun;
            //     $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            // }

            // $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            //$data['data_permohonan'] = $this->permohonan->get_permohonan();
            $this->load->model('mskpd','skpd');
            $data['ref_permohonan'] = $this->skpd->get_permohonan();
            $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan();
            $data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vtubkd_tolak3',$data);
            // $this->load->view('v_indextubkd',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');	
    }
    
    public function dashboard_tolak4(){
       $data['ref_permohonan'] = $this->tubkd->get_permohonan();

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
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "4373";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'tubkd',0);
                
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            // START MEMUNCULKAN TOMBOL BACK KE ATASAN            
            $data['thbl'] = $bulantahun;
            if($nrk == $this->user['id']){
                $data['showBack'] = 'none';
                $data['nrkatasan'] = '';
            }else{
                $data['showBack'] = '';
                $data['nrkatasan'] = $this->infopegawai->getAtasanPegawai($nrk,$thbl);   
                

                if($data['nrkatasan'] == ""){                    
                    $data['nrkatasan'] = $this->user['id'];
                }
            }
            // END MEMUNCULKAN TOMBOL BACK KE ATASAN

            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)



            // START Inisial Active Menu
            
            // END Inisial Active Menu

            
            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           // var_dump( $data['nrk']);
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];

            $infoUser = $this->home->getUserInfo2($nrk);

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $infoUserJabatan = $this->home->getUserInfoJabatanS($nrk);
            $data['infoUser'] = $infoUser;  
            $data['infoUser3'] = $infoUser3;
            $data['infoUserJabatan'] = $infoUserJabatan;
            
            // $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            // if ($data['bawahan'] == "") {
                
            //         $date = strtotime('-1 months');
            //         $thbl = date('Ym',$date);
            //         $bulantahun = date('M Y',$date);
            //         $data['thbl'] = $bulantahun;
            //     $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            // }

            // $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            //$data['data_permohonan'] = $this->permohonan->get_permohonan();
            $this->load->model('mskpd','skpd');
            $data['ref_permohonan'] = $this->skpd->get_permohonan();
            $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan();
            $data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vtubkd_tolak4',$data);
            // $this->load->view('v_indextubkd',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');	
    }
    
    public function get_data_dashboard($prm){
		$result = $this->tubkd->get_all_data_dashboard($prm);
		echo $result;
	}
	
	public function cek_keterangan_tolak($prm){
		$result = $this->tubkd->get_keterangan_tolak($prm);
		echo $result;
	}


    public function get_data_table($param){
        
		$list_permohonan = $this->tubkd->get_all_permohonan($param);
        
        echo $list_permohonan;
    }

    public function get_data_table2($param){
        
        $list_permohonan = $this->tubkd->get_all_permohonan2($param);
        
        echo $list_permohonan;
    }

    public function get_data_table_terima(){
        $list_permohonan = $this->tubkd->get_all_data_terima();
        
        echo $list_permohonan;
    }

    public function get_data_table_terima2(){
        $list_permohonan = $this->tubkd->get_all_data_terima2();
        
        echo $list_permohonan;
    }

    public function get_data_table_terima3(){
        $list_permohonan = $this->tubkd->get_all_data_terima3();
        
        echo $list_permohonan;
    }

    public function get_data_table_terima4(){
        $list_permohonan = $this->tubkd->get_all_data_terima4();
        
        echo $list_permohonan;
    }

    public function get_data_table_terima5(){
        $list_permohonan = $this->tubkd->get_all_data_terima5();
        
        echo $list_permohonan;
    }

    public function lihat_persyaratan()
    {
        $result = $this->tubkd->lihat_persyaratan_trx();
 
        
        echo $result;
    }



    public function get_detail_pegawai(){
        $prm = $this->input->post('nrk');
        $result = $this->tubkd->get_detail_pegawai($prm);
        echo $result;
    }

    public function get_persyaratan(){
        // $prm = $this->input->post();
        $result = $this->tubkd->get_persyaratan_model();
 
        echo $result;
    }

    public function getDataTrxDtl(){
        $result = $this->tubkd->dataTrxDtl();

        echo $result;
    }

    public function get_data_permohonan(){

            $result = $this->tubkd->getdataskpd();

            echo $result;
        
            
    }

    public function updatePerbal(){
        $fdata=$this->input->post();
        // var_dump($fdata);exit;
        $tgl_perbal = $fdata['tgl_perbal'];
        $dimajukan = $fdata['dimajukan'];
        for ($i=0; $i < count($fdata['pemaraf_serta']); $i++) { 
            $pemaraf_serta[] = $fdata['pemaraf_serta'][$i];
        }
        $id_trx_hdr = $fdata['id_trx_hdrp'];
        // var_dump($pemaraf_serta);exit;
        $data=array(
            // "ID_TRX_HDR" => $fdata['id_trx_hdrp'],
            "NO_PERBAL" => $fdata['no_perbal'],
            "TGL_PERBAL" => 'tgl_perbal',
            "DIKERJAKAN" => $fdata['dikerjakan'],
            "DIPERIKSA" => $fdata['diperiksa'],
            "DIEDARKAN" => $fdata['diedarkan'],
            "DISETUJUI" => $fdata['disetujui'],
            "DIMAJUKAN" => 'dimajukan',
            "HAL" => $fdata['hal'],
            "SIFAT" => $fdata['sifat'],
            "LAMPIRAN" => $fdata['lampiran'],
            "PEMARAF" => json_encode($pemaraf_serta),
            "TEMBUSAN" => "{$fdata['ka_dinas']}|{$fdata['dir_dki']}|{$fdata['ka_sudin']}",
            "DISERAHKAN" => $fdata['diserahkan']
        );;
        $rs=$this->tubkd->updatePerbal('PERS_TRACKING_PERBAL',$data,$tgl_perbal,$dimajukan,$id_trx_hdr);

        if ($rs==0){
            $result_msg = array(
                'success'=>false,
                'msg' => "Simpan gagal"
            );
        } else {
            $result_msg = array(
                'success'=>true,
                'msg' => "Simpan berhasil"
            );
        }


        echo json_encode($result_msg);
    }

    public function simpan_data(){
        $prm = $this->input->post();
        $result = $this->tubkd->simpan_data($prm);
        echo $result;
    }

    public function simpan_data2(){
        $prm = $this->input->post();
        
        $result = $this->tubkd->simpan_data2($prm);
        echo $result;
    }

    public function simpan_data3(){
        $prm = $this->input->post();
       
        $result = $this->tubkd->simpan_data3($prm);
        echo $result;
    }

    public function revisi_tubkd4(){
        $result = $this->tubkd->revisi_tubkd4();

        if($result){
            $respone = "SUKSES";
        }else{
            $respone = "GAGAL";
        }

        $return = array('response' => $respone);

        echo json_encode($return);
        
        
    }

    public function simpan_data4(){
       
        $result = $this->tubkd->simpan_data4();

         if($result){
            $respone = "SUKSES";
        }else{
            $respone = "GAGAL";
        }

        $return = array('kembali' => $respone);

        echo json_encode($return);
    }

    public function simpan_data5(){
       
        $result = $this->tubkd->simpan_data5();

         if($result){
            $respone = "SUKSES";
        }else{
            $respone = "GAGAL";
        }

        $return = array('kembali' => $respone);

        echo json_encode($return);
    }

    public function insert(){
        $post = $this->input->post();
        // var_dump($post['id_trx_skpd']);exit;
        $result = $this->tubkd->insert_data(array('id_trx_skpd'=>$post['id_trx_skpd'], 'no_surat_tu'=>$post['no_surat_tu']));
        echo json_encode($result);
    }

    public function update()
    {
        $post = $this->input->post();
        $result = $this->tubkd->update_data(array('id_trx_skpd'=>$post['id_trx_skpd']));

        echo json_encode($result);
    }

    public function listPegawai()
    {
        $tgl_sekarang = date("Y-m-d");
        $tgl = date('Y-m-d', strtotime($tgl_sekarang));
        $tglproses = date('Y-m-d', strtotime($tgl_sekarang));
        $koloks = $this->mdl->getKolok();
        //var_dump($koloks);
        $data = array(
            'tgl' => $tgl,
            'tglproses' => $tglproses,
            'koloks' => $koloks,
            'nrk' => $this->input->post('nrkP')
        );

        // START Inisial Active Menu
        $datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'report',0);
        // END Inisial Active Menu
        $datam['nrk'] = $data['nrk'];

        $this->load->view('head/header',$this->user);
        $this->load->view('head/menu',$datam);
        $this->load->view('admin/pegawai_list_report.php',$data);
        //$this->load->view('admin/pegawai_list.php',$data);
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


    public function updateKolokJab()
    {
        $this->home->updateKolokKojab();
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

    function getDtPgw(){
        $valnrk = $this->input->post('valnrk');

        $rs=$this->report->getLapDtPgw($valnrk);
      
       echo json_encode($rs);
          
    }


     

}
