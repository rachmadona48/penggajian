<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subbid extends CI_Controller {

    private $user=array();

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));      
        $this->load->library('session');
        
        $this->load->model('mhome','home');
        $this->load->library('infopegawai');
        $this->load->library('convert');
        $this->load->model('msubbid','subbid');

        $this->modul='subbid';

        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']       = $session_data['id'];
            $this->user['username']     = $session_data['username'];
            $this->user['user_group']     = $session_data['user_group'];

        }else{
            redirect(base_url().'login', 'refresh');
        }       
    }

    public function test_cetak_perbal()
    {
        $data['klogad'] = $this->subbid->getKlogad();
        $this->load->view('head/header',$this->user);
        $this->load->view('cover_perbal', $data);
    }

    public function cetakPerbalTest($id_trx_hdr){
        $this->load->library('pdf_report2');

        $rs = $this->subbid->dataTrackingPerbal($id_trx_hdr);
        // var_dump($rs->DIKERJAKAN);exit;
        $time_tgl_perbal = strtotime($rs->TGL_PERBAL);
        $tgl_perbal = date('d', $time_tgl_perbal).' '.$this->bulan(date('m', $time_tgl_perbal)).' '.date('Y', $time_tgl_perbal);
        if($rs->DIMAJUKAN == ''){
            $dimajukan = '';
        } else {
            $time_dimajukan = strtotime($rs->DIMAJUKAN);
            $dimajukan = date('d', $time_dimajukan).' '.$this->bulan(date('m', $time_dimajukan)).' '.date('Y', $time_dimajukan);
        }

        $data = array(
            'id_trx_hdr'=>$id_trx_hdr,
            'time_tgl_perbal' =>$time_tgl_perbal,
            'tgl_perbal' => $tgl_perbal,
            'dimajukan' => $dimajukan,
            'rs' => $rs
        );
        $data['template'] = $this->load->view('perbal_cover',$data, TRUE);
        $this->load->view('perbal_cover',$data);
    }

    public function updateDasarHukum(){
        $this->subbid->updateDasarHukum();
    }

    public function save_as_pdf($html)
    {
        echo htmlentities($html);
    }

    public function index()
    {
        $post = $this->input->post();
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
                $datam['activeMenu'] = "4445";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'subbid',0);
                //$datam['inisial'] = 'subbid';
                

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

            $data['sop'] = $this->subbid->get_sop();
            $data['jenis_permohonan'] = $this->subbid->get_permohonan();
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('v_indexsubbid',$data);
            //$this->load->view('admin/pegawai_list',$data);
            $this->load->view('head/footer');

    }

    public function index_old()
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
                $datam['activeMenu'] = "4445";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'subbid',0);
                //$datam['inisial'] = 'subbid';
                
            $post = $this->input->post();
            // var_dump($post);exit;
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
            $this->session->set_userdata($this->session->userdata['logged_in']['id_sop'] = "idsop_".$post['id_sop']);
            if($post['id_sop'] == 1){
                //subbid tahap 1
                $data['jumlah_permohonan_terima'] = $this->subbid->count_data(1, $post['id_sop']);
                $data['jumlah_permohonan'] = $this->subbid->count_data(2, $post['id_sop']);
                $data['jumlah_permohonan_tolak'] = $this->subbid->count_data(3, $post['id_sop']);

                //subbid tahap 2
                $data['jumlah_permohonan_terima2'] = $this->subbid->count_data(4, $post['id_sop']);
                $data['jumlah_permohonan2'] = $this->subbid->count_data(5, $post['id_sop']);
                $data['jumlah_permohonan_tolak2'] = $this->subbid->count_data(6, $post['id_sop']);
                $data['sop'] = $this->load->view('subbid_jabfung1', $data, TRUE);
            }elseif($post['id_sop'] == 2 || $post['id_sop'] == 3){
                //subbid tahap 1
                $data['jumlah_permohonan_terima'] = $this->subbid->count_data(1, $post['id_sop']);
                $data['jumlah_permohonan'] = $this->subbid->count_data(2, $post['id_sop']);
                $data['jumlah_permohonan_tolak'] = $this->subbid->count_data(3, $post['id_sop']);

                //subbid tahap 2
                $data['jumlah_permohonan_terima2'] = $this->subbid->count_data(4, $post['id_sop']);
                $data['jumlah_permohonan2'] = $this->subbid->count_data(5, $post['id_sop']);
                $data['jumlah_permohonan_tolak2'] = $this->subbid->count_data(6, $post['id_sop']);
                $data['sop'] = $this->load->view('subbid_jabfung2', $data, TRUE);
            }

            $this->load->view('dashboard_subbid',$data);
    }

    public function index2()
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
        $datam['activeMenu'] = "4445";
        $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'subbid',0);
        //$datam['inisial'] = 'subbid';


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

        //subbid tahap 1
        $data['jumlah_permohonan_terima'] = $this->subbid->count_data(1);
        $data['jumlah_permohonan'] = $this->subbid->count_data(2);
        $data['jumlah_permohonan_tolak'] = $this->subbid->count_data(3);
        //subbid tahap 2
        $data['jumlah_permohonan_terima2'] = $this->subbid->count_data(4);
        $data['jumlah_permohonan2'] = $this->subbid->count_data(5);
        $data['jumlah_permohonan_tolak2'] = $this->subbid->count_data(6);

        $this->load->view('head/header',$this->user);
        $this->load->view('head/menu', $datam);
        $this->load->view('dashboard_subbid',$data);
        //$this->load->view('admin/pegawai_list',$data);
        $this->load->view('head/footer');

    }

    public function permohonan()
    {
        //$post = $this->input->post();
        // var_dump($post['REF_PERMOHONAN']);exit;
        // $data['jenis_permohonan'] = $this->permohonan->get_jenis_permohonan($post['REF_PERMOHONAN']);
        //$data['jenis_permohonan'] = $this->permohonan->get_jenis_permohonan();

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
                $datam['activeMenu'] = "4445";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'subbid',0);
                
                
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
            $data['jenis_permohonan'] = $this->subbid->get_jenis_permohonan();
            $data['kojabf'] = $this->subbid->get_kojabf();
            $data['sop'] = $this->subbid->dataSOP();
            $data['pemaraf_serta'] = $this->getPemaraf();
            $data['klogad'] = $this->subbid->getKlogad();
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vsubbid',$data);
            //$this->load->view('admin/pegawai_list',$data);
            $this->load->view('head/footer');
    }

    public function getDitetapkan(){
        $post = $this->input->post();
        if(!empty($post))
            echo json_encode($this->subbid->getDitetapkan($post['id_trx_hdr']));
    }

    public function cloneSyarat($data = null){
        // var_dump($data);exit;
        //~if(empty($data) || $data)
                //~echo 'Try again later'; exit;
        //~$sql = "SELECT * FROM PERS_JENIS_PERMOHONAN";
        //~var_dump($this->db->query($sql)->result());exit;
        for($i=1;$i<=6;$i++){
			$this->subbid->cloneSyarat($i.'_'.$i);
		}
		exit;
        // $res = $this->subbid->cloneSyarat($data);    
    }

    public function permohonan2()
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
        $datam['activeMenu'] = "4445";
        $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'subbid',0);


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

        $data['jenis_permohonan'] = $this->subbid->get_jenis_permohonan();
        $data['kojabf'] = $this->subbid->get_kojabf();
        $data['sop'] = $this->subbid->dataSOP();
        $this->load->view('head/header',$this->user);
        $this->load->view('head/menu', $datam);
        $this->load->view('vsubbid2',$data);
        $this->load->view('head/footer');
    }

    public function permohonan3()
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
        $datam['activeMenu'] = "4445";
        $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'subbid',0);


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

        $data['jenis_permohonan'] = $this->subbid->get_jenis_permohonan();
        $data['kojabf'] = $this->subbid->get_kojabf();
        $data['sop'] = $this->subbid->dataSOP();
        $this->load->view('head/header',$this->user);
        $this->load->view('head/menu', $datam);
        $this->load->view('vsubbid3',$data);
        $this->load->view('head/footer');
    }

    public function dashboard_tolak()
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
              $datam['activeMenu'] = "4445";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'subbid',0);
                
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
            
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vsubbid_tolak',$data);
            $this->load->view('head/footer');
    }

    public function dashboard_tolak2()
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
              $datam['activeMenu'] = "4445";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'subbid',0);
                
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
            
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vsubbid_tolak2',$data);
            $this->load->view('head/footer');
    }

    public function dashboard_tolak3()
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
              $datam['activeMenu'] = "4445";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'subbid',0);
                
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
            
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vsubbid_tolak3',$data);
            $this->load->view('head/footer');
    }

    public function dashboard_terima()
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
              $datam['activeMenu'] = "4445";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'subbid',0);
                
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
            
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vsubbid_terima',$data);
            $this->load->view('head/footer');
    }

    public function dashboard_terima2()
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
              $datam['activeMenu'] = "4445";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'subbid',0);
                
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
            
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vsubbid_terima2',$data);
            $this->load->view('head/footer');
    }

    public function dashboard_terima3()
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
              $datam['activeMenu'] = "4445";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'subbid',0);
                
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
            
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vsubbid_terima3',$data);
            $this->load->view('head/footer');
    }

    public function get_data_permohonan(){
        $result = $this->subbid->getdatatubkd();
        
        echo $result;
    }

    public function get_data_permohonan2(){
        $result = $this->subbid->getdatatubkd2();

        echo $result;
    }

    public function get_data_permohonan3(){
        $result = $this->subbid->getdatatubkd3();

        echo $result;
    }

    public function get_data_table_tolak(){
        $list_permohonan = $this->subbid->get_all_data_tolak();
        // var_dump($list_permohonan);exit;
        echo $list_permohonan;
    } 

    public function get_data_table_tolak2(){
        $list_permohonan = $this->subbid->get_all_data_tolak2();
        // var_dump($list_permohonan);exit;
        echo $list_permohonan;
    }

    public function get_data_table_tolak3(){
        $list_permohonan = $this->subbid->get_all_data_tolak3();
        // var_dump($list_permohonan);exit;
        echo $list_permohonan;
    }

    public function get_data_table_terima(){
        $list_permohonan = $this->subbid->get_all_data_terima();
        // var_dump($list_permohonan);exit;
        echo $list_permohonan;
    }

    public function get_data_table_terima2(){
        $list_permohonan = $this->subbid->get_all_data_terima2();
        // var_dump($list_permohonan);exit;
        echo $list_permohonan;
    }

    public function get_data_table_terima3(){
        $list_permohonan = $this->subbid->get_all_data_terima3();
        // var_dump($list_permohonan);exit;
        echo $list_permohonan;
    }

    public function getDataTrxDtl($ak = false){
        $result = $this->subbid->dataTrxDtl($ak);

        echo $result;
    }

    public function get_persyaratan(){
        $result = $this->subbid->get_persyaratan_model();
        
        echo $result;
    }

    public function get_detail_pegawai(){
        $prm = $this->input->post('nrk');
        $result = $this->subbid->get_detail_pegawai($prm);
        echo $result;
    }

    public function getAngkaKredit($id_trx = NULL){
        $post = $this->input->post();
        if(!empty($post) || !is_null($id_trx)){
            $id_trx = empty($post['id_trx']) ? $id_trx : $post['id_trx'];
            $check_user = $this->db->query("SELECT A.KD FROM PERS_PEGAWAI1 A LEFT JOIN PERS_TRX_AJU B ON A.NRK = B.NRK WHERE ID_TRX = '{$id_trx}'")->row();
            if($check_user->KD == "S"){
                /*$sql = "SELECT
                            A.ANGKA_KREDIT AS ANGKA_KREDIT_BARU
                        FROM 
                            ANGKA_KREDIT_SOP A 
                        LEFT JOIN PERS_TRX_AJU B ON 
                            A.ID_TRX = B.ID_TRX
                        WHERE B.ID_TRX = '{$id_trx}'";
                // var_dump($sql);exit;
                $result = $this->db->query($sql)->row();
                $res = $result->ANGKA_KREDIT_BARU;*/
                $res = 0;
            }else{
                $res = $this->subbid->getAngkaKredit($id_trx);
            }
            // var_dump(!is_null($id_trx).' '.$res);exit;
            if(!empty($post)){
                echo json_encode(( (int) $res ));
            }else{
                return ((int)$res);
            }
        }/*else{
            return false;
        }*/
    }

    public function simpanAngkaKredit(){
        $post = $this->input->post();
        $data = [
                    'id_trx' => $post['id_trx_ak'],
                    'angka_kredit' => $post['angka_kredit_ak']
                ];
        $res = $this->subbid->simpanAngkaKredit($data);
        echo ($res ? json_encode(['msg'=>'Sukses']) : json_encode(['msg' => 'Gagal']));
    }

    public function insert(){
        $post = $this->input->post();
        
        $result = $this->subbid->insert_data(array('id_trx_tu'=>$post['id_trx_tu'], 'no_surat_tu'=>$post['no_surat_tu'], 'tgl_surat'=>$post['tgl_surat'], 'ref_prm'=>$post['ref_permohonan'], 'jns_prm'=>$post['jns_permohonan']));
        echo json_encode($result);
    }

    public function update()
    {
        $post = $this->input->post();
        $result = $this->subbid->update_data(array('id_trx_tu'=>$post['id_trx_tu']));

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

    function tolakHdr(){
        $id_trx_hdr=$this->input->post('id_trx_hdr');
        $id_tracking=$this->input->post('id_tracking');
        $keterangan=$this->input->post('keterangan');
        $id_detil_sop=$this->input->post('id_detil_sop');
        $urutan=$this->input->post('urutan');

        $pk = array(
            "ID_TRACKING" => $id_tracking
        );
        $data=array(
            "URUTAN" => $urutan,
            "KETERANGAN" => $keterangan,
            "STATUS" => 3
        );
        $rs=$this->subbid->ubah('PERS_TRACKING',$data,$pk);

        $rs_dtl = $this->subbid->dataTrxDtl2($id_trx_hdr);
        foreach ( $rs_dtl as $r){
            $pk = array(
                "ID_TRX" => $r->ID_TRX
            );
            $dataAju=array(
                "ID" => $id_detil_sop,
                "STATUS_BERJALAN" => 3,
                "STATUS_AKHIR" => 'REJECT'
            );
            $rs=$this->subbid->ubah('PERS_TRX_AJU',$dataAju,$pk);

            $new_id_tolak=$this->subbid->newIdTolak();
            $data=array(
                "ID_TRX_TOLAK" => $new_id_tolak,
                "ID_TRX" => $r->ID_TRX,
                "TGL_TOLAK" => 'SYSDATE',
                "KETERANGAN" => $keterangan,
                "URUTAN"    => $urutan
            );
            $rs=$this->subbid->tambah('PERS_TRX_TOLAK',$data);
        }

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

    function tolakDtl(){
        $fdata=$this->input->post();
        $new_id_tolak=$this->subbid->newIdTolak();

        $pk = array(
            "ID_TRX" => $fdata['id_trx']
        );
        $dataAju=array(
            "ID" => $fdata['id_detil_sop'],
            "STATUS_BERJALAN" => 3,
            "STATUS_AKHIR" => 'REJECT'
        );
        $rs=$this->subbid->ubah('PERS_TRX_AJU',$dataAju,$pk);

        $data=array(
            "ID_TRX_TOLAK" => $new_id_tolak,
            "ID_TRX" => $fdata['id_trx'],
            "TGL_TOLAK" => 'SYSDATE',
            "KETERANGAN" => $fdata['keterangan'],
            "URUTAN"    => $fdata['urutan']
        );
        $rs=$this->subbid->tambah('PERS_TRX_TOLAK',$data);

        if ($rs==0){
            $result_msg = array(
                'success'=>false,
                'msg' => "Tolak Gagal"
            );
        } else {
            $result_msg = array(
                'success'=>true,
                'msg' => "Tolak dengan alasan ".$fdata['keterangan']." berhasil"
            );
        }


        echo json_encode($result_msg);
    }

    function getPemaraf(){
        $res = $this->subbid->get_pemaraf_serta();
        return $res;
    }

    function simpanPerbal(){
        $fdata=$this->input->post();
        // var_dump($fdata);exit;
        $tgl_perbal = $fdata['tgl_perbal'];
        $dimajukan = $fdata['dimajukan'];

        $ka_dinas = (empty($fdata['ka_dinas']) ? NULL : $fdata['ka_dinas']);
        $dir_dki = (empty($fdata['dir_dki']) ? NULL : $fdata['dir_dki']);
        $ka_sudin = (empty($fdata['ka_sudin']) ? NULL : $fdata['ka_sudin']);


        $pk = array(
            "ID_TRACKING" => $this->subbid->dataLastTrack($fdata['id_trx_hdrp'])
        );
        $data=array(
            "NO_SURAT" => $fdata['no_perbal'],
            "TGL_SURAT" => 'tgl_perbal'
        );
        $rs=$this->subbid->ubahPerbal('PERS_TRACKING',$data,$pk,$tgl_perbal);

        $pk=array("ID_TRX_HDR" => $fdata['id_trx_hdrp']);
        $this->subbid->hapus('PERS_TRACKING_PERBAL',$pk);
        for ($i=0; $i < count($fdata['pemaraf_serta']); $i++) { 
            $pemaraf_serta[] = $fdata['pemaraf_serta'][$i];
        }
        // var_dump($pemaraf_serta);exit;
        $data=array(
            "ID_TRX_HDR" => $fdata['id_trx_hdrp'],
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
            "TEMBUSAN" => "{$ka_dinas}|{$dir_dki}|{$ka_sudin}",
            // "PEMARAF" => $fdata['pemaraf_serta'],
            /*"TEMBUSAN" => $fdata['tembusan'],
            "DITETAPKAN" => $fdata['ditetapkan'],*/
            "DISERAHKAN" => $fdata['diserahkan']
        );;
        $rs=$this->subbid->tambahPerbal('PERS_TRACKING_PERBAL',$data,$tgl_perbal,$dimajukan);

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

    function simpanSOP(){
        $fdata=$this->input->post();

        $pk=array(
            "ID_TRX_HDR" => $fdata['id_trxhdrp2']
        );

        $data=array(
            "ID_SOP" => $fdata['id_sop']
        );

        $rs=$this->subbid->ubah('PERS_TRX_HDR',$data,$pk);

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

    function simpanSK(){
        $fdata=$this->input->post();
        if($fdata['no_sk'] == null || $fdata['tgl_surat'] == null || $fdata['kredit'] == null){
            $result_msg = array(
                'stay'=>true,
                'success'=>false,
                'msg' => "Simpan gagal"
            );
            // echo json_encode($result_msg);
        }
            // exit;

        $pk=array(
            "ID_TRACKING" => $fdata['id_tracking']
        );

        $data=array(
            "NO_SURAT" => $fdata['no_sk'],
            "TGL_SURAT" => 'tgl_surat',
            "KREDIT" => $fdata['kredit']
        );

        $rs=$this->subbid->ubahSK('PERS_TRACKING',$data,$pk,$fdata['tgl_surat']);

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

    function kirimPermohonanJabfung(){
        $id_trx_hdr=$this->input->post('id_trx_hdr');
        $id_tracking=$this->input->post('id_tracking');
        $id_detail_sop=$this->input->post('id_detail_sop');
        $urutan=$this->input->post('urutan');

        $new_id_tracking = $this->subbid->newIdTracking();

//        var_dump($fdata);exit;
        $pk = array(
            "ID_TRACKING" => $id_tracking
        );
        $data=array(
            "URUTAN" => 3,
            "STATUS" => 1
        );
        $rs=$this->subbid->ubah('PERS_TRACKING',$data,$pk);

        $data=array(
            "ID_TRACKING" => $new_id_tracking,
            "ID_TRX_HDR" => $id_trx_hdr,
            "URUTAN" => 4,
            "STATUS" => 2
        );
        $rs=$this->subbid->tambah('PERS_TRACKING',$data);

        $rs_dtl = $this->subbid->dataTrxDtl2($id_trx_hdr);
        foreach ( $rs_dtl as $r){
            $pk = array(
                "ID_TRX" => $r->ID_TRX
            );
            $dataAju=array(
                "ID" => 4
            );
            $rs=$this->subbid->ubah('PERS_TRX_AJU',$dataAju,$pk);
        }

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

    function setujuAkhir(){
        $id_trx_hdr=$this->input->post('id_trx_hdr');
        $id_tracking=$this->input->post('id_tracking');
        $id_kojabf=$this->input->post('id_kojabf');
        $id_detail_sop=$this->input->post('id_detail_sop');
        $urutan=$this->input->post('urutan');

        $new_id_tracking = $this->subbid->newIdTracking();

        $pk = array(
            "ID_TRACKING" => $id_tracking
        );
        $data=array(
            "URUTAN" => $urutan,
            "STATUS" => 1
        );
        $rs=$this->subbid->ubah('PERS_TRACKING',$data,$pk);

        $rs_dtl = $this->subbid->dataTrxDtl2($id_trx_hdr);
        // var_dump($rs_dtl);exit;
        foreach ( $rs_dtl as $r){
            $pk = array(
                "ID_TRX" => $r->ID_TRX
            );
            $dataAju=array(
                "ID" => $id_detail_sop,
                "STATUS_BERJALAN" => 1,
                "STATUS_AKHIR" => "DONE"
            );
            $rs=$this->subbid->ubah('PERS_TRX_AJU',$dataAju,$pk);

            $kojabArr=$this->subbid->dataLastKojabF($r->NRK);
            // var_dump($kojabArr);exit;

            if($kojabArr){
                $sk=$this->subbid->dataSK($id_tracking);
                $kojabArrNew['TMT']="SYSDATE";
                $kojabArrNew['KOJAB']=$id_kojabf;
                // var_dump($sk);exit;
                $kojabArrNew['NOSK']=strtoupper($sk->NO_SURAT);
                $kojabArrNew['TGSK']="tgl_sk";
                $kojabArrNew['KOLOK']=$kojabArr->KOLOK;
                $kojabArrNew['KOPANG']=$kojabArr->KOPANG;
                $kojabArrNew['PEJTT']=$kojabArr->PEJTT;
                $kojabArrNew['SPMU']=$kojabArr->SPMU;
                $kojabArrNew['KLOGAD']=$kojabArr->KLOGAD;
                $kojabArrNew['NRK']=$r->NRK;
                $kojabArrNew['STATUS']=0;
                $kojabArrNew['KREDIT']=$kojabArr->ANGKA_KREDIT;
                $kojabArrNew['USER_ID']='PERS';
                $kojabArrNew['TERM']='LOAD';
                $kojabArrNew['TG_UPD']='SYSDATE_TG_UPD';

                // $asd = $this->subbid->tambahKojabf('PERS_JABATANF_HIST',$kojabArrNew,$sk->TGL_SURAT);
                // var_dump($asd);
            }

        }

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
        // var_dump($asd);exit;
        echo json_encode($result_msg);
    }

    function bulan($bulan)
    {
        Switch ($bulan){
            case 1 : $bulan="Januari";
                Break;
            case 2 : $bulan="Februari";
                Break;
            case 3 : $bulan="Maret";
                Break;
            case 4 : $bulan="April";
                Break;
            case 5 : $bulan="Mei";
                Break;
            case 6 : $bulan="Juni";
                Break;
            case 7 : $bulan="Juli";
                Break;
            case 8 : $bulan="Agustus";
                Break;
            case 9 : $bulan="September";
                Break;
            case 10 : $bulan="Oktober";
                Break;
            case 11 : $bulan="November";
                Break;
            case 12 : $bulan="Desember";
                Break;
        }
        return $bulan;
    }

    public function cetakPerbal($param, $id_trx_hdr, $no_urutan = NULL, $option = null){

        if($param == 'cover' || $param == 'cover_print'){
            // var_dump($prm);
            $this->load->library('pdf_isi_perbal');

            $rs = $this->subbid->dataTrackingPerbal($id_trx_hdr);
            $pemaraf_serta = $this->subbid->getPemarafSOP(implode(',',json_decode($rs->PEMARAF)));
            $ditetapkan_oleh = $this->subbid->getDitetapkan($id_trx_hdr);
            // var_dump($ditetapkan_oleh);exit;
            // $tembusan = $this->subbid->getTembusanSOP(explode('|',$rs->TEMBUSAN));
            $explodeTembusan = preg_match_all('/[0-9]+/', $rs->TEMBUSAN, $tembusan_tmp);
            $tembusan = $this->subbid->getTembusanSOP($tembusan_tmp[0]);
            // var_dump($tembusan);exit;
            $time_tgl_perbal = strtotime($rs->TGL_PERBAL);
            $tgl_perbal = date('d', $time_tgl_perbal).' '.$this->bulan(date('m', $time_tgl_perbal)).' '.date('Y', $time_tgl_perbal);
            if($rs->DIMAJUKAN == ''){
                $dimajukan = '';
            } else {
                $time_dimajukan = strtotime($rs->DIMAJUKAN);
                $dimajukan = date('d', $time_dimajukan).' '.$this->bulan(date('m', $time_dimajukan)).' '.date('Y', $time_dimajukan);
            }

            $prm = array();
            foreach($pemaraf_serta as $value){
                $prm[] = $value->NAMA_PEMARAF;
            }

            $tmbsn = array();
            if(empty($tembusan)){
                $tmbsn = NULL;
            }elseif(count($tembusan[0]) == 1){
                $tmbsn[0] = $tembusan[0]->NALOK;
            }else{
                for ($i=0; $i <= count($explodeTembusan)+1; $i++) { 
                    $tmbsn[$i] = ucfirst(strtolower($tembusan[0]->NALOK));
                }
            }
            // var_dump(!empty($tmbsn));exit;
            /*foreach($tembusan[0] as $value){
                // var_dump($value);
                $tmbsn[] = $value;
            }*/

            // var_dump(ucfirst(strtolower("HELLO WORLD")));
            // exit;

            $data = array(
                'id_trx_hdr'=>$id_trx_hdr,
                'time_tgl_perbal' =>$time_tgl_perbal,
                'tgl_perbal' => $tgl_perbal,
                'dimajukan' => $dimajukan,
                'rs' => $rs,
                'pemaraf' => $prm,
                'tembusan' => $tmbsn,
                'nama_ditetapkan' => $ditetapkan_oleh->NAMA_DITETAPKAN,
                'nip_ditetapkan' => $ditetapkan_oleh->NIP_DITETAPKAN,
                'jabatan_ditetapkan' => $ditetapkan_oleh->JABATAN_DITETAPKAN
            );
            // var_dump($data);exit;
            // $sql = "SELECT * FROM MASTER_SKPD";
            // var_dump($this->db['ekinerja']->query($sql));exit;
            // $this->load->view('perbal_cover',$data);
            if($param == 'cover'){
                return $this->load->view('perbal_cover',$data, TRUE);    
            }elseif($param == 'cover_print'){
                $this->cetakPerbalFix($data);
            }
        }elseif($param == 'isi'){
            $result = $this->subbid->getIdJenisPermohonan($id_trx_hdr);
            $count_permohonan = $this->subbid->count_permohonan($id_trx_hdr);
            $jml_permohonan = $count_permohonan->JUMLAH;
            // var_dump($jml_permohonan);exit;

            if($result->ID_JENIS_PERMOHONAN == "4"){//done, tested
                if($jml_permohonan == "1"){
                    $this->cetakPerbalNaikJenjangJabfungOrang($id_trx_hdr, $no_urutan);
                }else{
                    $this->cetakPerbalNaikJenjangJabfungKolektif($id_trx_hdr, $no_urutan);
                }
            }elseif($result->ID_JENIS_PERMOHONAN == "1"){//done, tested
                if($jml_permohonan == "1"){
                    $this->cetakPerbalPengangkatanPertamaKaliJabfungOrang($id_trx_hdr, $no_urutan);
                }else{
                    $this->cetakPerbalPengangkatanPertamaKaliJabfungKolektif($id_trx_hdr, $no_urutan);
                }
            }elseif($result->ID_JENIS_PERMOHONAN == "2"){//done
                //on hold >> ambigous
                if($jml_permohonan == "1"){
                    if($option == "1"){
                        $this->cetakPerbalPembebasanSementaraKrnAngkaKredit($id_trx_hdr, $no_urutan);
                    }elseif($option == "2"){
                        $this->cetakPerbalPembebasanSementaraHukdis($id_trx_hdr, $no_urutan);
                    }elseif($option == "3"){
                        $this->cetakPerbalPembebasanSementaraDiberhentikan($id_trx_hdr, $no_urutan);
                    }elseif($option == "4"){
                        $this->cetakPerbalPembebasanSementaraKeStruktural($id_trx_hdr, $no_urutan);
                    }elseif($option == "5"){
                        $this->cetakPerbalPembebasanSementaraCutiLrTn($id_trx_hdr, $no_urutan);
                    }else{
                        echo 'SK template tidak tersedia';exit;
                    }
                }else{
                    echo 'SK template tidak tersedia';exit;
                }
            }elseif($result->ID_JENIS_PERMOHONAN == "3"){//done
                //on hold >> ambigous
                if($jml_permohonan == "1"){
                    if($option == "1"){
                        $this->cetakPerbalPengangkatanKembaliJabfungMutasiDariLuarJKT($id_trx_hdr, $no_urutan);
                    }else{
                        $this->cetakPerbalPengangkatanKembaliJabfungSetelahTUBEL_AK($id_trx_hdr, $no_urutan);
                    }
                }
            }elseif($result->ID_JENIS_PERMOHONAN == "5"){//done, tested
                
                if($jml_permohonan == "1"){
                    $this->cetakPerbalPindahDariJbtnLainOrang($id_trx_hdr, $no_urutan);
                }else{
                    $this->cetakPerbalPindahDariJbtnLainKolektif($id_trx_hdr, $no_urutan);
                }
            }elseif($result->ID_JENIS_PERMOHONAN == "6"){//done, tested
                if($jml_permohonan == "1"){
                    $this->cetakPerbalInpassingOrang($id_trx_hdr, $no_urutan);
                }else{
                    $this->cetakPerbalInpassingKolektif($id_trx_hdr, $no_urutan);
                }
            }elseif($result->ID_JENIS_PERMOHONAN == "7"){//done
                //on hold >> ambigous
                if($jml_permohonan == "1"){
                    if($option == "1"){
                        $this->cetakPerbalPemberhentianJabfungUndurDiri($id_trx_hdr, $no_urutan);
                    }else{
                        $this->cetakPerbalPemberhentianJabfung5_1($id_trx_hdr, $no_urutan);
                    }
                }
            }
        }
    }

    public function getIsiPerbal($id_trx_hdr, $no_urutan = NULL){
        // var_dump($id_trx_hdr.' '.$no_urutan);exit;
        $result = $this->subbid->getIsiPerbal($id_trx_hdr, $no_urutan);
        $skpd = explode('|', $result->TEMBUSAN);
        $res_skpd = $this->subbid->get_skpd_perbal(($skpd[0] <> NULL) ? $result->KOLOK : $skpd[0]);
        $kredit = $this->getAngkaKredit($result->ID_TRX);
        // var_dump($kredit);exit;
        /*$explodeTembusan = preg_match_all('/[0-9]+/', $result->TEMBUSAN, $tembusan_tmp);
        $tembusan = $this->subbid->getTembusanSOP($tembusan_tmp[0]);
        var_dump($tembusan);exit;*/
        // var_dump($result->NO_SURAT);exit;
        $nomor_sk = empty($result->NO_SURAT) ? NULL : $result->NO_SURAT;
        // var_dump($nomor_sk);exit;
        $angka_kredit = is_null($kredit) ? 0 : $kredit;
        $angka_kredit_words = $this->Dibaca($angka_kredit);
        $jumlah_orang = $this->count_data_perbal($id_trx_hdr);
        $get_dasar_hukum = $this->subbid->getDasarHukum($result->NRK);
        $dasar_hukum = explode('|',$get_dasar_hukum->DASAR_HUKUM);
        // var_dump($dasar_hukum);exit;
        for ($x=0; $x < count($dasar_hukum); $x++) { 
            $res[] = str_replace(' Tahun ', '@', $dasar_hukum[$x]);    
        }
        // // var_dump(str_replace(' ','',$dasar_hukum[2]));
        // exit;
        $data = array(
                    'nrk' => $result->NRK,
                    'nip' => $result->NIP18,
                    'nama' => $result->NAMA,
                    'gol' => $result->GOL,
                    'napang' => $result->NAPANG,
                    'najabl' => $result->NAJABL,
                    'nm_tingkat' => $result->NM_TINGKAT,
                    'skpd' => is_null($res_skpd) ? NULL : $res_skpd->NAMA,
                    'unit_kerja' => is_null($res_skpd) ? NULL : $res_skpd->NALOK,
                    'id_trx_hdr' => $id_trx_hdr,
                    'nomor_sk' => $nomor_sk,
                    'angka_kredit' => $angka_kredit,
                    'angka_kredit_words' => ucwords($angka_kredit_words),
                    'dasar_hukum1' => $res[0],
                    'dasar_hukum2' => explode('@',$res[1]),
                    'dasar_hukum3' => explode('@',$res[2])
                );
        $data['jumlah_orang'] = (int) $jumlah_orang >= 1  ? $jumlah_orang : FALSE;
        // var_dump($data);exit;
        return $data;
    }

    private function Dibaca($x){
        $angkaBaca = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        switch ($x) {
            case ($x == 0):
                return 'null';
                break;
            case ($x < 12):
                $res = " " . $angkaBaca[$x];
                return $res;
                break;
            case ($x < 20):
                $res = $this->Dibaca($x - 10) . " belas";
                return $res;
                break;
            case ($x < 100):
                $res = $this->Dibaca($x / 10);
                $res .= " puluh ";
                $res .= $this->Dibaca($x % 10);
                return $res;
                break;
            case ($x < 200):
                $res = " seratus ";
                $res .= $this->Dibaca($x - 100);
                return $res;
                break;
            case ($x < 1000):
                $res = $this->Dibaca($x / 100);
                $res .= " ratus";
                $res .= $this->Dibaca($x % 100);
                return $res;
                break;
            case ($x < 2000):
                $res = " seribu ";
                $res .= $this->Dibaca($x - 1000);
                return $res;
                break;
            case ($x < 1000000):
                $res = $this->Dibaca($x / 1000);
                $res .= " ribu ";
                $res .= $this->Dibaca($x % 1000);
                return $res;
                break;
            case ($x < 1000000000):
                $res = $this->Dibaca($x / 1000000);
                $res .= " juta ";
                $res .= $this->Dibaca($x % 1000000);
                return $res;
                break;
        }
    }

    public function count_pegawai(){
        $post = $this->input->post();
        if(!empty($post))
            $result = $this->subbid->count_permohonan($post['id_trx_hdr']);
            echo json_encode((int)$result->JUMLAH);
    }

    public function count_data_perbal($id_trx_hdr){
        $result = $this->subbid->count_data_perbal($id_trx_hdr);

        return $result->JUMLAH;
    }

    public function cetakPerbalFix($data){
        // var_dump($data);exit;
        $this->load->view('print_perbal_sk', $data);
    }
    
    public function cetakPerbalNaikJenjangJabfungKolektif($id_trx_hdr, $no_urutan = NULL){
        $this->load->library('pdf_isi_perbal');
        $data = $this->getIsiPerbal($id_trx_hdr, $no_urutan);
        $x['cover_html'] = $this->cetakPerbal('cover',$id_trx_hdr);
        $x['isi_html'] = $this->load->view('perbal_naik_jenjang_jabfung_kolektif',$data, TRUE);
        $this->load->view('template_perbal_sk',$x);
    }

    public function cetakPerbalNaikJenjangJabfungOrang($id_trx_hdr, $no_urutan = NULL){
        $this->load->library('pdf_isi_perbal');
        $data = $this->getIsiPerbal($id_trx_hdr, $no_urutan);
        $x['cover_html'] = $this->cetakPerbal('cover',$id_trx_hdr);
        $x['isi_html'] = $this->load->view('perbal_naik_jenjang_jabfung_orang',$data,TRUE);
        $this->load->view('template_perbal_sk',$x);
    }

    public function cetakPerbalPengangkatanPertamaKaliJabfungKolektif($id_trx_hdr, $no_urutan = NULL){
        $this->load->library('pdf_isi_perbal');
        $data = $this->getIsiPerbal($id_trx_hdr, $no_urutan);
        $x['cover_html'] = $this->cetakPerbal('cover',$id_trx_hdr);
        $x['isi_html'] = $this->load->view('perbal_angkat_jft_pertama_kali_kolektif',$data,TRUE);
        $this->load->view('template_perbal_sk',$x);
    }

    public function cetakPerbalPengangkatanPertamaKaliJabfungOrang($id_trx_hdr, $no_urutan = NULL){        
        $this->load->library('pdf_isi_perbal');
        $data = $this->getIsiPerbal($id_trx_hdr, $no_urutan);
        $x['cover_html'] = $this->cetakPerbal('cover',$id_trx_hdr);
        $x['isi_html'] = $this->load->view('perbal_angkat_jft_pertama_kali',$data,TRUE);
        // var_dump($x);exit;
        $this->load->view('template_perbal_sk',$x);
    }

    public function cetakPerbalPembebasanSementaraKeStruktural($id_trx_hdr, $no_urutan = NULL){        
        $this->load->library('pdf_isi_perbal');
        $data = $this->getIsiPerbal($id_trx_hdr, $no_urutan);
        $x['cover_html'] = $this->cetakPerbal('cover',$id_trx_hdr);
        $x['isi_html'] = $this->load->view('perbal_pembebasan_smntr_ke_struktural',$data,TRUE);
        $this->load->view('template_perbal_sk',$x);
    }

    public function cetakPerbalPembebasanSementaraKrnAngkaKredit($id_trx_hdr, $no_urutan = NULL){        
        $this->load->library('pdf_isi_perbal');
        $data = $this->getIsiPerbal($id_trx_hdr, $no_urutan);
        $x['cover_html'] = $this->cetakPerbal('cover',$id_trx_hdr);
        $x['isi_html'] = $this->load->view('perbal_pembebasan_smntr_krn_ak',$data,TRUE);
        $this->load->view('template_perbal_sk',$x);
    }

    public function cetakPerbalPembebasanSementaraCutiLrTn($id_trx_hdr, $no_urutan = NULL){        
        $this->load->library('pdf_isi_perbal');
        $data = $this->getIsiPerbal($id_trx_hdr, $no_urutan);
        $x['cover_html'] = $this->cetakPerbal('cover',$id_trx_hdr);
        $x['isi_html'] = $this->load->view('perbal_pembebasan_smntr_cuti_lr_tn',$data,TRUE);
        $this->load->view('template_perbal_sk',$x);
    }

    public function cetakPerbalPembebasanSementaraDiberhentikan($id_trx_hdr, $no_urutan = NULL){        
        $this->load->library('pdf_isi_perbal');
        $data = $this->getIsiPerbal($id_trx_hdr, $no_urutan);
        $x['cover_html'] = $this->cetakPerbal('cover',$id_trx_hdr);
        $x['isi_html'] = $this->load->view('perbal_pembebasan_smntr_diberhentikan',$data,TRUE);
        $this->load->view('template_perbal_sk',$x);
    }

    public function cetakPerbalPembebasanSementaraHukdis($id_trx_hdr, $no_urutan = NULL){        
        $this->load->library('pdf_isi_perbal');
        $data = $this->getIsiPerbal($id_trx_hdr, $no_urutan);
        $x['cover_html'] = $this->cetakPerbal('cover',$id_trx_hdr);
        $x['isi_html'] = $this->load->view('perbal_pembebasan_smntr_hukdis',$data,TRUE);
        $this->load->view('template_perbal_sk',$x);
    }

    public function cetakPerbalPengangkatanKembaliJabfungMutasiDariLuarJKT($id_trx_hdr, $no_urutan = NULL){        
        $this->load->library('pdf_isi_perbal');
        $data = $this->getIsiPerbal($id_trx_hdr, $no_urutan);
        $x['cover_html'] = $this->cetakPerbal('cover',$id_trx_hdr);
        $x['isi_html'] = $this->load->view('perbal_naik_pnggktn_kmbl_jabfung_mutasi_dr_luar_jkt',$data,TRUE);
        $this->load->view('template_perbal_sk',$x);
    }

    public function cetakPerbalPengangkatanKembaliJabfungSetelahTUBEL_AK($id_trx_hdr, $no_urutan = NULL){        
        $this->load->library('pdf_isi_perbal');
        $data = $this->getIsiPerbal($id_trx_hdr, $no_urutan);
        $x['cover_html'] = $this->cetakPerbal('cover',$id_trx_hdr);
        $x['isi_html'] = $this->load->view('perbal_naik_pnggktn_kmbl_jabfung_stlh_tubel_kumpul_ak',$data,TRUE);
        $this->load->view('template_perbal_sk',$x);
    }

    public function cetakPerbalPindahDariJbtnLainOrang($id_trx_hdr, $no_urutan = NULL){        
        $this->load->library('pdf_isi_perbal');
        $data = $this->getIsiPerbal($id_trx_hdr, $no_urutan);
        $x['cover_html'] = $this->cetakPerbal('cover',$id_trx_hdr);
        $x['isi_html'] = $this->load->view('perbal_angkat_pindah_dr_jabatan_lain_orang',$data,TRUE);
        $this->load->view('template_perbal_sk',$x);
    }

    public function cetakPerbalPindahDariJbtnLainKolektif($id_trx_hdr, $no_urutan = NULL){        
        // $this->load->library('pdf_isi_perbal');
        $data = $this->getIsiPerbal($id_trx_hdr, $no_urutan);
        $x['cover_html'] = $this->cetakPerbal('cover',$id_trx_hdr);
        $x['isi_html'] = $this->load->view('perbal_angkat_pindah_dr_jabatan_lain_kolektif',$data,TRUE);
        $this->load->view('template_perbal_sk',$x);
    }

    public function cetakPerbalInpassingOrang($id_trx_hdr, $no_urutan = NULL){        
        $this->load->library('pdf_isi_perbal');
        $data = $this->getIsiPerbal($id_trx_hdr, $no_urutan);
        $x['cover_html'] = $this->cetakPerbal('cover',$id_trx_hdr);
        $x['isi_html'] = $this->load->view('perbal_pnggktn_melalui_inpassing_orang',$data,TRUE);
        $this->load->view('template_perbal_sk',$x);
    }

    public function cetakPerbalInpassingKolektif($id_trx_hdr, $no_urutan = NULL){        
        $this->load->library('pdf_isi_perbal');
        $data = $this->getIsiPerbal($id_trx_hdr, $no_urutan);
        $x['cover_html'] = $this->cetakPerbal('cover',$id_trx_hdr);
        $x['isi_html'] = $this->load->view('perbal_inpassing_kolektif',$data,TRUE);
        $this->load->view('template_perbal_sk',$x);
        // $this->load->view('perbal_pnggktn_melalui_inpassing_kolektif',$data);
    }

    public function cetakPerbalPemberhentianJabfungUndurDiri($id_trx_hdr, $no_urutan = NULL){        
        $this->load->library('pdf_isi_perbal');
        $data = $this->getIsiPerbal($id_trx_hdr, $no_urutan);
        $x['cover_html'] = $this->cetakPerbal('cover',$id_trx_hdr);
        $x['isi_html'] = $this->load->view('perbal_berhenti_jabfung_undur_diri',$data,TRUE);
        $this->load->view('template_perbal_sk',$x);
    }

    public function cetakPerbalPemberhentianJabfung5_1($id_trx_hdr, $no_urutan = NULL){        
        $this->load->library('pdf_isi_perbal');
        $data = $this->getIsiPerbal($id_trx_hdr, $no_urutan);
        $x['cover_html'] = $this->cetakPerbal('cover',$id_trx_hdr);
        $x['isi_html'] = $this->load->view('perbal_berhenti_jabfung_(5+1)',$data,TRUE);
        $this->load->view('template_perbal_sk',$x);
    }

    public function cetakSK($id_trx_hdr){
        $this->load->library('pdf_sk');
        $data['detail_sk'] = $this->subbid->getDetailSK($id_trx_hdr);
        // var_dump($data['detail_sk']);exit;
        $data['sk'] = $this->subbid->getHeaderSK($id_trx_hdr);
        $res_header = $this->subbid->getIsiPerbal($id_trx_hdr, NULL);        
        $kredit = $this->getAngkaKredit($res_header->ID_TRX);
        $data['angka_kredit'] = is_null($kredit) ? 0 : $kredit;
        $sk_header = explode('|', $res_header->TEMBUSAN);
        $total = count($sk_header);
        for ($i=0; $i < $total; $i++) { 
            if ($sk_header[$i] == "") {
                $sk_header[$i] = 0;
            }
        }
        $data['sk_tembusan'] = $this->subbid->getTembusanSOP($sk_header);
        $result = $this->subbid->getIdJenisPermohonan($id_trx_hdr);
        if((int)$result->ID_JENIS_PERMOHONAN == 6){
            $data['tipeSK'] = 2;    
        }elseif((int)$result->ID_JENIS_PERMOHONAN == 1){
            $data['tipeSK'] = 1;
        }else{
            $data['tipeSK'] = 0;
        }
        // var_dump($data);exit;
        $this->load->view('template_sk', $data);
    }
    

    function trackingPermohonan(){
        $fdata = $this->input->post();
        $no_surat = $fdata['no_surat'];
        $id_trx_hdr = $fdata['id_trx_hdr'];

        //Dapatkan Alur SOP
        $detil_sop = $this->subbid->dataDtlSOP($id_trx_hdr);
        $html='<h5>No Surat Permohonan : '.$no_surat.'</h5>
        <section class="cd-horizontal-timeline">
            <div class="timeline">
                <div class="events-wrapper">
                    <div class="events">
                        <ol>';
        $no=1;
        foreach ($detil_sop->result() as $ds){
            //Dapatkan Tracking Permohonan
            $last_urut_tracking = $this->subbid->dataLastTracking($id_trx_hdr);
            $status="";
            $KET_USER_PRIORITY=$ds->KET_USER_PRIORITY;
            if ($ds->URUTAN == $last_urut_tracking){
                $status = 'class="selected"';
                $KET_USER_PRIORITY="<b>".$ds->KET_USER_PRIORITY."</b>";
            } else if($ds->URUTAN < $last_urut_tracking){
                $status = 'class="older-event"';
            }

//            $tracking = $this->subbid->dataTracking1($id_trx_hdr,$ds->URUTAN);
//            $tgl_surat = "";
//            if ($tracking){
//                $tgl_surat = $tracking->TGL_SURAT;
//            }

            $Date = date("Y-m-d");
            $tgl_surat=date('d/m/Y', strtotime($Date. ' + '.$no.' days'));

            $html .= '<li><a href="#0" data-date="'.$tgl_surat.'" '.$status.'>'.$KET_USER_PRIORITY.'</a></li>';
            $no += 1;
        }
        $html .= '</ol>

                        <span class="filling-line" aria-hidden="true"></span>
                    </div> <!-- .events -->
                </div> <!-- .events-wrapper -->

                <ul class="cd-timeline-navigation">
                    <li><a href="#0" class="prev inactive">Prev</a></li>
                    <li><a href="#0" class="next">Next</a></li>
                </ul> <!-- .cd-timeline-navigation -->
            </div> <!-- .timeline -->

            <div class="events-content">

            </div> <!-- .events-content -->
        </section>
        <script>
            $(".events > ol > li > a").click(function(){
                return false;
            });
        </script>
        ';

        echo $html;
    }

    public function show_notif()
    {
        $id_tracking = $this->input->post('id_tracking');
        $psn = $this->subbid->get_pesanNotifikasi($id_tracking);
        echo '
                        <div class="timeline-item">
                            <div class="row">
                                <div class="col-xs-3 date">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="col-xs-7 content no-top-border">

                                    <p>'; echo $psn->KETERANGAN; echo'.</p>

                                </div>
                            </div>
                        </div>
        ';
    }
     
     

}

