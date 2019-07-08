<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    private $user=array();

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));      
        $this->load->library('session');
        $this->load->model('mhome','home');
        $this->load->model('admin/m_admin');
        $this->load->model('admin/v_pegawai','mdl');
        $this->load->library('infopegawai');
        $this->load->library('convert');

        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']       = $session_data['id'];
            $this->user['username']     = $session_data['username'];
            $this->user['user_group']     = $session_data['user_group'];
            $this->user['user_password']     = $session_data['user_password'];
        }else{
            //redirect(base_url().'index.php/login/logout', 'location', 307);
            //redirect(base_url().'index.php', 'location', 307);
            // redirect(base_url().'index.php/login', 'refresh');
            redirect(base_url().'login', 'refresh');
             
           
        }       
    }

    public function index()
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

                if($this->user['id'] == 'bkd'){
                    $data['namalog'] = "Badan Kepegawaian Daerah";
                }else{
                    $data['namalog'] = $this->user['username'];
                }

                if($this->user['user_group'] == 5){
                        $datam['inisial'] = 'mjabfung';
                    }
            // END GET NRK
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "270";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'home',0);
                
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
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
            $data['tot_pegawai'] = $this->infopegawai->getTotPegawai();

            $infoUser = $this->home->getUserInfo2($nrk);
            $data['infoUser'] = $infoUser;    

            $dataUserAlay = $this->infopegawai->getDataUser($this->user['id']);          
            $alaypassword= $dataUserAlay->user_password;

            $datam['alaypassword'] = $alaypassword;

            $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);

            if ($data['bawahan'] == "") {                
                    $date = strtotime('-1 months');
                    $thbl = date('Ym',$date);
                    $bulantahun = date('M Y',$date);
                    $data['thbl'] = $bulantahun;
                    $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            }
            
            $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;

            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu',$datam);
            $this->load->view('homev2',$data);
            $this->load->view('head/footer');
    }

    public function dashboard(){
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
            $datam['activeMenu'] = "3762";
            $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'skpdpermohonan',0);
            $datam['inisial'] = 'skpdpermohonan';
            
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

        $this->load->view('head/header',$this->user);
        $this->load->view('head/menu', $datam);
        $this->load->view('dashboard_new',$data);
        //$this->load->view('admin/pegawai_list',$data);
        $this->load->view('head/footer');
    }

    public function index_old()
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

                if($this->user['id'] == 'bkd'){
                    $data['namalog'] = "Badan Kepegawaian Daerah";
                }else{
                    $data['namalog'] = $this->user['username'];
                }
            // END GET NRK
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "270";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'home',0);
                
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
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
            $data['tot_pegawai'] = $this->infopegawai->getTotPegawai();

            $infoUser = $this->home->getUserInfo2($nrk);
            $data['infoUser'] = $infoUser;    

            $dataUserAlay = $this->infopegawai->getDataUser($this->user['id']);          
            $alaypassword= $dataUserAlay->user_password;

            $datam['alaypassword'] = $alaypassword;

            $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);

            if ($data['bawahan'] == "") {
                
                    $date = strtotime('-1 months');
                    $thbl = date('Ym',$date);
                    $bulantahun = date('M Y',$date);
                    $data['thbl'] = $bulantahun;
                $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            }
            
            $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            

            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu',$datam);
            $this->load->view('home',$data);
            $this->load->view('head/footer');

    }

    public function dashboard_backup()
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
        // END GET NRK
        //$datam['li']=$this->home->showMenu();
        $datam['activeMenu'] = "270";
        $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'home',0);

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
        $datam['nrk'] = $nrk;
        $datam['user_group'] = $this->user['user_group'];
        $data['user_id'] = $this->user['id'];
        $data['user_group'] = $this->user['user_group'];
        $data['tot_pegawai'] = $this->infopegawai->getTotPegawai();
        $data['tot_pegawai_pns'] = $this->infopegawai->getTotPegawaiPns();
        $data['persen_pns'] = number_format(($data['tot_pegawai_pns']/$data['tot_pegawai']),2);
        $data['tot_pegawai_cpns'] = $this->infopegawai->getTotPegawaiCpns();
        $data['persen_cpns'] = number_format(($data['tot_pegawai_cpns']/$data['tot_pegawai']),2);

        $infoUser = $this->home->getUserInfo2($nrk);
        $data['infoUser'] = $infoUser;

        $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);

        if ($data['bawahan'] == "") {

            $date = strtotime('-1 months');
            $thbl = date('Ym',$date);
            $bulantahun = date('M Y',$date);
            $data['thbl'] = $bulantahun;
            $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
        }

        $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);


        /*$uraian= "<ol>";
        foreach($data['uraian']->result() as $row)
        {

           $uraian.= "<li>".$row->uraian."</li>";
        }
        $uraian.= "</ol>";*/
        // echo $uraian;


        $this->load->view('head/header',$this->user);
        $this->load->view('head/menu',$datam);
        $this->load->view('dashboard',$data);
        $this->load->view('head/footer');

    }

    

    public function convertThbl($param){
        $tahun = substr($param, 0,4);
        $bulan = substr($param, 4,2);

        if($bulan=='01'){
            $blnT="Jan ".$tahun;
        }elseif ($bulan=='02') {
            $blnT="Feb ".$tahun;
        }elseif ($bulan=='03') {
            $blnT="Mar ".$tahun;
        }elseif ($bulan=='04') {
            $blnT="Apr ".$tahun;
        }elseif ($bulan=='05') {
            $blnT="May ".$tahun;
        }elseif ($bulan=='06') {
            $blnT="Jun ".$tahun;
        }elseif ($bulan=='07') {
            $blnT="Jul ".$tahun;
        }elseif ($bulan=='08') {
            $blnT="Aug ".$tahun;
        }elseif ($bulan=='09') {
            $blnT="Sep ".$tahun;
        }elseif ($bulan=='10') {
            $blnT="Oct ".$tahun;
        }elseif ($bulan=='11') {
            $blnT="Nov ".$tahun;
        }elseif ($bulan=='12') {
            $blnT="Dec ".$tahun;
        }else{
            $blnT = "";
        }

        return $blnT;
    }

    public function generateStrukturPegawai(){
        $nrk = ""; $thbl = "";
        if(isset($_POST['nrk'])){
            $nrk = $_POST['nrk'];
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No NRK');
            echo json_encode($return);
            exit();
        }

        if(isset($_POST['thbl'])){
            $thbl = $_POST['thbl'];
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No THBL');
            echo json_encode($return);
            exit();
        }

        $thbl = $this->convert->convertNamaBulanTahun($thbl);
        $bawahan = $this->infopegawai->getStrukturPegawai($nrk,$thbl);

        $return = array('response' => 'SUKSES', 'result' => $bawahan);
        echo json_encode($return);
    }

    public function generateRiwayat(){
        $ug = $this->user['user_group'];
        // START REQUEST RIwAYAT
        if(isset($_POST['id_riwayat'])){
            $id = $_POST['id_riwayat'];
        }else{
            $id = 1;
        }
        // END REQUEST RIwAYAT

        // START GET NRK
        if(isset($_POST['nrk'])){
            $nrk = $_POST['nrk'];
        }else{
            $nrk = $this->user['id'];
        }
        // END GET NRK

       switch ($id) {
            case 'jabstruk': //Jabatan Struktural
                $hasil = $this->infopegawai->getRiwayatJabatanStrukturalPeg($nrk,$ug,$id);
                break;
            case 'jabfung': //Jabatan Fungsional
                $hasil = $this->infopegawai->getRiwayatJabatanFungsionalPeg($nrk,$ug,$id);
                break;
            case 'penform': //Pendidikan Formal
                $hasil = $this->infopegawai->getRiwayatPendidikanFormal($nrk,$ug,$id);
                break;
            case 'pennform': //Pendidikan Non Formal
                $hasil = $this->infopegawai->getRiwayatPendidikanNonFormal($nrk,$ug,$id);
                break;
            case 'pang': //Pangkat
                $hasil = $this->infopegawai->getRiwayatPangkatPeg($nrk,$ug,$id);
                break;
            case 'gapok': //Gaji Pokok
                $hasil = $this->infopegawai->getRiwayatGapokPeg($nrk,$ug,$id); //TAMBAHKAN JENRUB
                break;
            case 'hukdis': //Hukuman Disiplin
                $hasil = $this->infopegawai->getHukumanDisiplinPeg($nrk,$ug,$id);
                break;
            case 'hukadm': //Hukuman Administrasi
                $hasil = $this->infopegawai->getHukumanAdministrasiPeg($nrk,$ug,$id);
                break;
            case 'dp3': //DP3
                $hasil = $this->infopegawai->getRiwayatDP3($nrk,$ug,$id);
                break;
            case 'abs': //Absensi
                $hasil = $this->infopegawai->getRiwayatAbsensi($nrk,$ug,$id);
                break;
            case 'cuti': //Cuti
                $hasil = $this->infopegawai->getRiwayatCutiPeg($nrk,$ug,$id);
                break;
            case 'pemb': //Pembatasan
                $hasil = $this->infopegawai->getRiwayatPembatasan($nrk,$ug,$id);
                break;
            case 'sem': //Seminar
                $hasil = $this->infopegawai->getRiwayatSeminar($nrk,$ug,$id);
                break;
            case 'tul': //Tulisan
                $hasil = $this->infopegawai->getRiwayatTulisan($nrk,$ug,$id);
                break;
            case 'ala': //Alamat
                $hasil = $this->infopegawai->getRiwayatAlamatPeg2($nrk,$ug,$id);
                break;
            case 'hrg': //Penghargaan
                $hasil = $this->infopegawai->getRiwayatPenghargaanPeg($nrk,$ug,$id);
                break;
            case 'fas': //Fasilitas
                $hasil = $this->infopegawai->getRiwayatFasilitas($nrk,$ug,$id);
                break;
            case 'org': //Organisasi
                $hasil = $this->infopegawai->getRiwayatOrganisasi($nrk,$ug,$id);
                break;
            case 'kel': //Keluarga
                $hasil = $this->infopegawai->getRiwayatHubunganKeluarga($nrk,$ug,$id);
                break;
            case 'lp2p': //LP2P
                $hasil = $this->infopegawai->getRiwayatLp2p($nrk,$ug,$id);
                break;
            case 'lit': //Litsus
                $hasil = $this->infopegawai->getRiwayatLitsus($nrk,$ug,$id);
                break;
            case 'tpa': //Test TPA
                $hasil = $this->infopegawai->getRiwayatTpa($nrk,$ug,$id);
                break;
            case 'tp': //Test TP
                $hasil = $this->infopegawai->getRiwayatTp($nrk,$ug,$id);
                break;
            case 'mak': //Makalah
                $hasil = $this->infopegawai->getRiwayatMakalah($nrk,$ug,$id);
                break;
            case 'gab': //Test Gabungan
                // $hasil = $this->infopegawai->getRiwayatGapok($nrk);
                break;
            case 'tupoksi': //TUPOKSI
                $hasil = $this->infopegawai->getRefTupoksi($nrk,$ug,$id);
                break;
            default:
                $hasil = "<small class='text-danger'>Tidak Ada Riwayat Yang Ditampilkan</small>";
                break;
        }


        $param = array('response' => 'SUKSES', 'result' => $hasil);

        echo json_encode($param);
    }

    public function generateForm(){
        
        if(isset($_POST['form'])){
            $form = $_POST['form'];
            $nrk = $_POST['nrk'];
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Form');
            echo json_encode($return);
            exit();
        }

        $data = $this->generateDataForm($form);
        $widthForm = $data['widthForm'];
        $data['nrk'] = $nrk;

        $msg = $this->load->view('admin/form_hist/form_'.$form, $data, true);

        $return = array('response' => 'SUKSES', 'result' => $msg, 'widthForm' => $widthForm);
        echo json_encode($return);
    }

    public function generateDataForm($form){
        $data['empty'] = ""; $data['widthForm'] = "two";
        switch ($form) {
            case 'jabatan_hist':

                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tmt = $this->input->post('key2');//tmt
                $kolok = $this->input->post('key3');//kolok
                
                $kojab = $this->input->post('key4');//kojab
                $kopang = "";$eselon = ""; $pejtt = "";$klogad="";$spmu="";$tmtpensiun="";

                $data['action'] = $action;
                
                if($action != null && $action == 'tambah'){
                    $data['listKolok']  = $this->infopegawai->getMasterKolok($kolok);
                    $data['listKlogad'] = $this->infopegawai->getMasterKolok($klogad);     
                }

                if($action != null && $action == 'update'){                    
                    $data['infoJabatan'] = $this->infopegawai->getKojabHistBy($nrk2,$tmt,$kolok,$kojab);
                    $data['listKojab'] = $this->infopegawai->getMasterKojab($kolok,$kojab);
                    
                    $kopang = $data['infoJabatan']->KOPANG;
                    $eselon = $data['infoJabatan']->ESELON;
                    $pejtt = $data['infoJabatan']->PEJTT;
                    $klogad = $data['infoJabatan']->KLOGAD;
                    $spmu = $data['infoJabatan']->SPMU;
                    $tmtpensiun = $data['infoJabatan']->TMTPENSIUN;

                    $data['listKolok']  = $this->infopegawai->getMasterKolokAll($kolok);
                    $data['listKlogad'] = $this->infopegawai->getMasterKolokAll($klogad);
                }
                $data['nmSPMU'] = $this->mdl->getKeteranganSPMU($spmu);
                $data['lastPangkat'] = $this->infopegawai->getLastPangkat($nrk,$kopang);         
                $data['listEselon'] = $this->infopegawai->getHistEselon($eselon);
                $data['listPejtt'] = $this->infopegawai->getMasterPejtt($pejtt);
                break;

            case 'jabatanf_hist':
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tmt = $this->input->post('key2');//tmt
                $kojab = $this->input->post('key3');//kojab                
                $kopang = ""; $pejtt = ""; $kolok = ""; $klogad="";$spmu="";$tmtpensiun="";

                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoJabatan'] = $this->infopegawai->getKojabfHistBy($nrk2,$tmt,$kojab);                    
                    $kopang = $data['infoJabatan']->KOPANG;                    
                    $pejtt = $data['infoJabatan']->PEJTT;
                    $kolok = $data['infoJabatan']->KOLOK;
                    $klogad = $data['infoJabatan']->KLOGAD;
                    $spmu = $data['infoJabatan']->SPMU;
                    $tmtpensiun = $data['infoJabatan']->TMTPENSIUN;
                    $data['listKolok'] = $this->infopegawai->getMasterKolokAll($kolok);
                    $data['listKlogad'] = $this->infopegawai->getMasterKolokAll($klogad);
                }
                else if($action == 'tambah')
                {
                    $data['listKolok'] = $this->infopegawai->getMasterKolok($kolok);
                    $data['listKlogad'] = $this->infopegawai->getMasterKolok($klogad);     
                }
                $data['nmSPMU'] = $this->mdl->getKeteranganSPMU($spmu);
                $data['listKojabf'] = $this->infopegawai->getMasterKojabf($kojab);
                $data['lastPangkat'] = $this->infopegawai->getLastPangkat($nrk,$kopang);
                $data['listPejtt'] = $this->infopegawai->getMasterPejtt($pejtt);   
                break;

            case 'pendidikan_formal':
                $data['widthForm'] = "one";
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $jendik = $this->input->post('key2');//jendik
                $kodik = $this->input->post('key3');//kodik   
                $univer = "";


                $data['action']=$action;

                if($action != null && $action == 'update'){                    
                    $data['infoPendidikan'] = $this->infopegawai->getPendidikanHistBy($nrk2,$jendik,$kodik);
                    $univer = $data['infoPendidikan']->UNIVER;
                    $titeldepan = $data['infoPendidikan']->TITELDEPAN;
                    $titelbelakang = $data['infoPendidikan']->TITELBELAKANG;
                    
                    $data['listKodik'] = $this->infopegawai->getMasterKodik($jendik,$kodik);
                }
                else if($action == 'tambah')
                {
                    $data['listKodik'] = $this->infopegawai->getMasterKodik(1);    
                }
                
                $data['listJendik'] = $this->infopegawai->getMasterJendikForm($jendik);
                $data['listUniver'] = $this->infopegawai->getMasterUniver($univer);

                break;

            case 'pendidikan_nonformal':
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $jendik = $this->input->post('key2');//jendik
                $kodik = $this->input->post('key3');//kodik   
                $univer = "";

                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoPendidikan'] = $this->infopegawai->getPendidikanHistBy($nrk2,$jendik,$kodik);                    
                    $univer = $data['infoPendidikan']->UNIVER;
                    $data['listKodik'] = $this->infopegawai->getMasterKodik($jendik,$kodik);
                }

                $data['listJendik'] = $this->infopegawai->getMasterJendikNonForm($jendik);
                $data['listUniver'] = $this->infopegawai->getMasterUniver($univer);
                break;

          case 'pangkat':
                $action = $this->input->post('action');//action
                $id1 = $this->input->post('key1');//nrk
                $id2 = $this->input->post('key2');//tmt
                $id3 = $this->input->post('key3');//kopang
                
                $id4 = "";//kolok
                $id5 = "";//pejtt
                $id6 = "";//ttmasker
                $klogad="";
                $spmu="";
                $jenrub="";

                $data['action'] = $action;

                $nrk = $this->input->post('nrk');

                if($action == 'tambah')
                {
                    $data['infopeg'] = $this->home->getDataPeg($nrk);
                    $id4 = $data['infopeg']->KOLOK;
                    $klogad = $data['infopeg']->KLOGAD;
                    $spmu = $data['infopeg']->SPMU;
                }
                else if($id1 != null && $id2 != null  && $id3 != null && $action == 'update'){
                    $data['infoPangkat'] = $this->home->getPangkatById($id1,$id2,$id3);
                    
                    $id4 = $data['infoPangkat']->KOLOK;
                    $id5 = $data['infoPangkat']->PEJTT;
                    $id6 = $data['infoPangkat']->TTMASKER;
                    $gapok = $data['infoPangkat']->GAPOK;
                    $data['infopeg'] = $this->home->getDataPeg($id1);
                    $klogad = $data['infopeg']->KLOGAD;
                    $spmu = $data['infopeg']->SPMU;

                    $id2 = date('Y-m-d',strtotime($id2));
                    
                    $data['infoGapok'] = $this->infopegawai->getGapokHistBy($id1,$id2,$gapok);
                    
      
                }
                $data['listKolok'] = $this->infopegawai->getMasterKolokAll($id4);
                $data['listKlogad'] = $this->infopegawai->getMasterKolokAll($klogad);
                $data['listJenrub'] = $this->infopegawai->getMasterJenrubPangkat($jenrub);
                $data['listKopang'] = $this->infopegawai->getMasterPangkat2($id3);
                $data['listPejtt'] = $this->infopegawai->getMasterPejtt($id5);
                $data['nmSPMU'] = $this->mdl->getKeteranganSPMU($spmu);
                break;

            case 'gapok':
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tmt = $this->input->post('key2');//tmt
                $gapok = $this->input->post('key3');//gapok                
                $kopang = "";$kolok = ""; $jenrub = ""; $klogad=""; $spmu="";

                $data['action'] = $action;
                $data['infopeg'] = $this->home->getDataPeg($nrk);
                $data['cekWaktu'] = $this->home->cekWaktuHukdis($nrk);

                if($action != null && $action == 'tambah')
                {
                    
                    $kolok = $data['infopeg']->KOLOK;
                    $klogad = $data['infopeg']->KLOGAD;
                    $spmu = $data['infopeg']->SPMU;

                }
                else if($action != null && $action == 'update'){                    
                    $data['infoGapok'] = $this->infopegawai->getGapokHistBy($nrk2,$tmt,$gapok);                    
                    $kopang = $data['infoGapok']->KOPANG;
                    $kolok = $data['infoGapok']->KOLOK;
                    $jenrub = $data['infoGapok']->JENRUB;  
                    
                    $kolok = $data['infopeg']->KOLOK;
                    $klogad = $data['infopeg']->KLOGAD;
                    $spmu = $data['infopeg']->SPMU;
                                 
                }
                $data['nmSPMU'] = $this->mdl->getKeteranganSPMU($spmu);
                $data['listKolok'] = $this->infopegawai->getMasterKolokAll($kolok); 
                $data['listKlogad'] = $this->infopegawai->getMasterKolokAll($klogad);   
                $data['listJenrub'] = $this->infopegawai->getMasterJenrub($jenrub);
                $data['listKopang'] = $this->infopegawai->getMasterPangkat2($kopang);
                
                break;

            case 'hukdis':
                
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tgsk = $this->input->post('key2');//tgsk   
                $jenhukdis = ""; $pejtt = "";
                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoHukdis'] = $this->infopegawai->getHukdisHistBy($nrk2,$tgsk);
                    $jenhukdis = $data['infoHukdis']->JENHUKDIS;
                    $pejtt = $data['infoHukdis']->PEJTT;
                    $tmtmulai_stoptkd = $data['infoHukdis']->TMTMULAI_STOPTKD;
                    $tmtakhir_stoptkd = $data['infoHukdis']->TMTAKHIR_STOPTKD;
                    $jmlbln_stoptkd = $data['infoHukdis']->JMLBLN_STOPTKD;
                    $ket = $data['infoHukdis']->KET;
                  	$data['listjenishukdis'] = $this->infopegawai->getJenisHukdisAll($jenhukdis);
                }
                else if($action != null && $action == 'tambah')
                {
                    $data['listjenishukdis'] = $this->infopegawai->getJenisHukdis($jenhukdis);
                }
                $data['listPejtt'] = $this->infopegawai->getMasterPejtt($pejtt);
                break;

            case 'hukadmin':
                
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tgsk = $this->input->post('key2');//tgsk   
                $jenhukadm = ""; $pejtt = "";

                $data['action'] = $action;
                if($action != null && $action == 'update'){                    
                    $data['infoHukadm'] = $this->infopegawai->getHukadmHistBy($nrk2,$tgsk);
                    $jenhukadm = $data['infoHukadm']->JENHUKADM;
                    $pejtt = $data['infoHukadm']->PEJTT;
                    $tmtmulai_stoptkd = $data['infoHukadm']->TMTMULAI_STOPTKD;
                    $tmtakhir_stoptkd = $data['infoHukadm']->TMTAKHIR_STOPTKD;
                    $jmlbln_stoptkd = $data['infoHukadm']->JMLBLN_STOPTKD;
                    $ket = $data['infoHukadm']->KET;
                }

                $data['listjenishukadm'] = $this->infopegawai->getJenisHukadmin($jenhukadm);
                $data['listPejtt'] = $this->infopegawai->getMasterPejtt($pejtt);
                
                break;

            case 'dp3':                
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tahun = $this->input->post('key2');//tahun                   
                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoDp3'] = $this->infopegawai->getDp3HistBy($nrk2,$tahun);                    
                }
                
                break;

            case 'absensi':              
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $thbl = $this->input->post('key2');//thbl
                
                if($action != null && $action == 'tambah'){                    
                    $data['infoUser'] = $this->home->getUserInfo2($nrk);
                }

                if($action != null && $action == 'update'){       
                    $data['bulantahun'] = $this->convertThbl($thbl);             
                    $data['infoUser'] = $this->infopegawai->getAbsensiHistBy($nrk2,$thbl);                    
                }

                break;

            case 'cuti':                
                $data['widthForm'] = "one";
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tmt = $this->input->post('key2');//tmt
                $pejtt = ""; $jencuti = "";
                
                $data['action'] = $action;
                if($action != null && $action == 'update'){                    
                    $data['infoCuti'] = $this->infopegawai->getCutiHistBy($nrk2,$tmt);  
                    $pejtt = $data['infoCuti']->PEJTT;
                    $jencuti = $data['infoCuti']->JENCUTI;
                }

                $data['listJenCuti'] = $this->infopegawai->getJenisCuti($jencuti);
                $data['listPejtt'] = $this->infopegawai->getMasterPejtt($pejtt);
                break;

            case 'pembatasan':
                $data['widthForm'] = "one";
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tmt = $this->input->post('key2');//tmt
                $pejtt = ""; $jenusaha = "";

                $data['action'] = $action;
                if($action != null && $action == 'update'){                    
                    $data['infoPembatasan'] = $this->infopegawai->getPembatasanHistBy($nrk2,$tmt);  
                    $pejtt = $data['infoPembatasan']->PEJTT;
                    $jenusaha = $data['infoPembatasan']->JENUSAHA;
                }

                $data['listJenisUsaha'] = $this->infopegawai->getJenisUsaha($jenusaha);
                $data['listPejtt'] = $this->infopegawai->getMasterPejtt($pejtt);
                break;

            case 'seminar':
                $data['widthForm'] = "one";
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tgmulai = $this->input->post('key2');//tgmulai
                $kdsemi = ""; $kdtema = ""; $kdperan = "";

                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoSeminar'] = $this->infopegawai->getSeminarHistBy($nrk2,$tgmulai);  
                    $kdsemi = $data['infoSeminar']->KDSEMI;
                    $kdtema = $data['infoSeminar']->KDTEMA;
                    $kdperan = $data['infoSeminar']->KDPERAN;
                }

                $data['listKdSemi'] = $this->infopegawai->getKodeSeminar($kdsemi);
                $data['listKdTema'] = $this->infopegawai->getKodeTemaSeminardanTulisan($kdtema);
                $data['listKdPeran'] = $this->infopegawai->getKodePeranSeminar($kdperan);
                break;

            case 'tulisan':
                $data['widthForm'] = "one";
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tgpublish = $this->input->post('key2');//tgpublish
                $kdsifat = ""; $kdtema = ""; $kdperan = ""; $kdlingkup = ""; $kdjlhkata = "";

                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoTulisan'] = $this->infopegawai->getTulisanHistBy($nrk2,$tgpublish);  
                    $kdtema = $data['infoTulisan']->KDTEMA;
                    $kdsifat = $data['infoTulisan']->KDSIFAT;                    
                    $kdlingkup = $data['infoTulisan']->KDLINGKUP;
                    $kdjlhkata = $data['infoTulisan']->KDJUMKATA;
                    $kdperan = $data['infoTulisan']->KDPERAN;
                }

                $data['listKdTema'] = $this->infopegawai->getKodeTemaSeminardanTulisan($kdtema);
                $data['listKdSifat'] = $this->infopegawai->getKodeSifatTulisan($kdsifat);                
                $data['listKdLingkup'] = $this->infopegawai->getKodeLingkupTulisan($kdlingkup);
                $data['listKdJumKata'] = $this->infopegawai->getKodeJumlahKataTulisan($kdjlhkata);
                $data['listKdPeran'] = $this->infopegawai->getKodePeranTulisan($kdperan);

                break;

            case 'alamat':               
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tgmulai = $this->input->post('key2');//tgmulai
                $kowil = ""; $kokec = ""; $kokel = ""; $prop = "";
                $kowil_ktp = ""; $kokec_ktp = ""; $kokel_ktp = ""; $prop_ktp = "";

                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoAlamat'] = $this->infopegawai->getAlamatHistBy($nrk2,$tgmulai);  
                    $kowil = $data['infoAlamat']->KOWIL;
                    $kokec = $data['infoAlamat']->KOCAM;
                    $kokel = $data['infoAlamat']->KOKEL;
                    $prop = $data['infoAlamat']->PROP;

                    $kowil_ktp = $data['infoAlamat']->KOWIL_KTP;
                    $kokec_ktp = $data['infoAlamat']->KOCAM_KTP;
                    $kokel_ktp = $data['infoAlamat']->KOKEL_KTP;
                    $prop_ktp = $data['infoAlamat']->PROP_KTP;
                }

                $data['listPropinsi'] = $this->infopegawai->getPropinsiNew2($prop);
                $data['listWilayah'] = $this->infopegawai->getWilayahNew2($prop,$kowil);
                $data['listKecamatan'] = $this->infopegawai->getKecamatanNew2($kowil,$kokec);                
                $data['listKelurahan'] = $this->infopegawai->getKelurahanNew2($kokec,$kokel);

                $data['listPropinsiKtp'] = $this->infopegawai->getPropinsiNew2($prop_ktp);
                $data['listWilayahKtp'] = $this->infopegawai->getWilayahNew2($prop_ktp,$kowil_ktp);
                $data['listKecamatanKtp'] = $this->infopegawai->getKecamatanNew2($kowil_ktp,$kokec_ktp);
                $data['listKelurahanKtp'] = $this->infopegawai->getKelurahanNew2($kokec_ktp,$kokel_ktp);

               
                
                break;

            case 'penghargaan':
                $data['widthForm'] = "one";                
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $kdharga = $this->input->post('key2');//kdharga                

                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoPenghargaan'] = $this->infopegawai->getPenghargaanHistBy($nrk2,$kdharga);                    
                }

                $data['listJenisPenghargaan'] = $this->infopegawai->getJenisPenghargaan($kdharga);                
                break;

            case 'fasilitas':
                $data['widthForm'] = "one";
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('key1');//nrk
                $nrk2 = $this->input->post('nrk');//nrk
                $jenfas = $this->input->post('key2');//jenfas                
                $thdapat = $this->input->post('key3');//jenfas
                
                $instansi="";
                $klogad="";
                $spmu="";
                $kowil="";
                $kocam="";
                $kokel="";

                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoFasilitas'] = $this->infopegawai->getFasilitasHistBy($nrk2,$jenfas,$thdapat);                    
                   
                    $instansi = $data['infoFasilitas']->INSTANSI;
                    $klogad = $data['infoFasilitas']->KLOGAD;
                    $spmu = $data['infoFasilitas']->SPMU;
                    $kowil = $data['infoFasilitas']->KOWIL;
                    $kocam = $data['infoFasilitas']->KOCAM; 
                    $kokel = $data['infoFasilitas']->KOKEL;
                    $data['listFasilitas'] = $this->infopegawai->getMasterFasilitas($jenfas);
                    
                }
                
                $data['listInstansi'] = $this->infopegawai->getMasterInstansi($instansi);
                $data['listFasilitas'] = $this->infopegawai->getMasterFasilitas($jenfas);

                $data['listKlogad'] = $this->infopegawai->getMasterKolok($klogad);
                $data['SPMU'] = $spmu;
                $data['nmSPMU'] = $this->mdl->getKeteranganSPMU($spmu);

                $data['listKowil'] = $this->infopegawai->getWilayah($kowil);
                $data['listKocam'] = $this->infopegawai->getKecamatan($kowil,$kocam);                
                $data['listKokel'] = $this->infopegawai->getKelurahan($kowil,$kocam,$kokel);  
                break;

            case 'organisasi':
                $data['widthForm'] = "one";
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $dari = $this->input->post('key2');//dari                
                $kdduduk = "";

                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoOrganisasi'] = $this->infopegawai->getOrganisasiHistBy($nrk2,$dari);                    
                    $kdduduk = $data['infoOrganisasi']->KDDUDUK;
                }

                $data['listKdKedudukan'] = $this->infopegawai->getKodeKedudukan($kdduduk);                
                break;

            case 'keluarga':
                
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                //$hubkel = $this->input->post('key2');//dari 
                $hubkel="";
                $stattun="";
                $kdkerja="";
                $uangduka="";
                $stat="";
                $data['action']=$action;
                
                if($action != null && $action == 'update'){  
                    $hubkel = $this->input->post('key2');//dari                   
                    $data['infoKeluarga'] = $this->infopegawai->getKeluargaHistBy($nrk2,$hubkel); 
                    $hubkel = $data['infoKeluarga']->HUBKEL;                   
                    $stattun = $data['infoKeluarga']->STATTUN;
                    $kdkerja = $data['infoKeluarga']->KDKERJA;
                    $uangduka = $data['infoKeluarga']->UANGDUKA;
                    $stat = $data['infoKeluarga']->STAT_APP;
                    //$talhir = $data['infoKeluarga']->TEMHIR;
                    $data['listKdHubkel'] = $this->infopegawai->getKodeHubkelAll($hubkel);
                    $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattun($stattun);
                }
                else if($action != null && $action == 'tambah')
                {
                    $cek = "SELECT * from PERS_KELUARGA WHERE STATTUN = 1 AND HUBKEL IN(11,12,13,14,15,16,17,18,19,21,22,23,24,25,26,27,28,29,31,32,33,34,35,36,37,38,39,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58) AND NRK='".$nrk."'";
                    //echo $cek;
                    $queryCek = $this->db->query($cek);
                    $num = $queryCek->num_rows();
                   

                    if($num>=2)
                    {
                        $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattunTanpa1($stattun);
                    }
                    else
                    {
                        $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattun($stattun);    
                    }
                    $data['listKdHubkel'] = $this->infopegawai->getKodeHubkel($hubkel);    
                }
                $listdata = $this->mdl->get_data($nrk)->row();
                $data['listStawin'] = $this->mdl->getListStawin($listdata->STAWIN);
                $data['NOKK'] = $listdata->NOKK;
                
                //$data['listStatusTunjangan'] = $this->infopegawai->getKodeStattun($stattun);
                $data['listJenisPekerjaan'] = $this->infopegawai->getKodeKerja($kdkerja);
                 $data['listUangDuka'] = $this->infopegawai->getUangDuka($uangduka);   
                
                break;

            case 'lp2p':
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('key2');
                $thpajak = $this->input->post('key1');

                $stawin="";
                $eselon="";
                $data['action'] = $action;
                if($action != null && $action == 'update')
                {
                    
                    $data['infoLP2P'] = $this->infopegawai->getLP2PHistBy($thpajak,$nrk);
                    
                    $eselon = $data['infoLP2P']->ESELON;
                }
                
               // $data['listStawin'] = $this->infopegawai->getListStawin($stawin);
                $data['listEselon'] = $this->infopegawai->getHistEselon($eselon);
                break;

            case 'litsus':
                $action = $this->input->post('action');//action
                $tgl = $this->input->post('key2');
                $nrk = $this->input->post('key1');
                $kopang="";

                $data['action']=$action;

                if($action != null && $action == 'update')
                {
                    
                    $data['infoLitsus'] = $this->infopegawai->getLitsusHistBy($nrk,$tgl);
                    $kopang= $data['infoLitsus']->KOPANG_PEMERIKSA;
             
                }
                $data['listKopang'] = $this->infopegawai->getMasterPangkat($kopang); 
                break;

            case 'testtpa':
                $nrk = $this->input->post('key1');
                $noserta = $this->input->post('key2');


                
                break;

            case 'testtp':
                $nrk = $this->input->post('key1');
                $noserta = $this->input->post('key2');

                break;

            case 'makalah':
                $nrk = $this->input->post('key1');
                $noserta = $this->input->post('key2');
                
                break;

            case 'testgabungan':
                
                break;

            case 'tupoksi':
                  $action = $this->input->post('action');//action
                 $nrk = $this->input->post('key1');//nrk
                 $tupoksi_id = $this->input->post('key2');//tupoksi id

                 $data['infoTupoksi'] = $this->infopegawai->getTupoksi($nrk);   
                 //var_dump($nrk);
                 if($action != null && $action == 'update'){                    
                    $data['infoTupoksi'] = $this->infopegawai->getTupoksiBy($nrk,$tupoksi_id);   
                    $tupoksi_id=$data['infoTupoksi']->tupoksi_id;                 
                }
                break;    

            default:
                $data['empty'] = "";
                break;
        }

        return $data;
    }    

    public function hapusHist(){
        $dest = $this->input->post('destination');
        $key1 = $this->input->post('key1');
        $key2 = $this->input->post('key2');
        $key3 = $this->input->post('key3');
        $key4 = $this->input->post('key4');

        $result = array('response' => 'GAGAL', 'act' => 'No Delete');
        switch ($dest) {
            case 'pangkat':
                $return = $this->home->delete_pangkat($key1,$key2,$key3);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'jabatan_hist':
                $return = $this->home->delete_jabStruk($key1,$key2,$key3,$key4);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'jabatanf_hist':
                $return = $this->home->delete_jabFgs($key1,$key2,$key3);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'pendidikan_formal':
                $return = $this->home->delete_pdFormal($key1,$key2,$key3);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'pendidikan_nonformal':
                $return = $this->home->delete_pdNonFormal($key1,$key2,$key3);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'gapok':
                $return = $this->home->delete_gapok($key1,$key2,$key3);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'hukdis':
                $return = $this->home->delete_hukdis($key1,$key2);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'hukadmin':
                $return = $this->home->delete_hukadmin($key1,$key2);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'dp3':
                $return = $this->home->delete_dp3($key1,$key2);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'absensi':
                $return = $this->home->delete_absensi($key1,$key2);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'cuti':
                $return = $this->home->delete_cuti($key1,$key2);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'pembatasan':
                $return = $this->home->delete_batasan($key1,$key2);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'seminar':
                $return = $this->home->delete_seminar($key1,$key2);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'tulisan':
                $return = $this->home->delete_tulisan($key1,$key2);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'alamat':
                $return = $this->home->delete_alamat($key1,$key2);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'penghargaan':
                $return = $this->home->delete_penghargaan($key1,$key2);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'fasilitas':
                $return = $this->home->delete_fasilitas($key1,$key2,$key3);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'organisasi':
                $return = $this->home->delete_organisasi($key1,$key2);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'keluarga':
                $return = $this->home->delete_keluarga($key1,$key2);
                if($return){
                    $result = array('response' => 'SUKSES');                    
                }
                break;

            case 'lp2p':
                 $return = $this->home->delete_lp2p($key1,$key2);
                 if($return){
                     $result = array('response' => 'SUKSES');                    
                 }
                break;

            case 'litsus':
                // $return = $this->home->delete_litsus($key1,$key2);
                // if($return){
                //     $result = array('response' => 'SUKSES');                    
                // }
                break;

            case 'testtpa':
                // $return = $this->home->delete_testtpa($key1,$key2);
                // if($return){
                //     $result = array('response' => 'SUKSES');                    
                // }
                break;

            case 'testtp':
                // $return = $this->home->delete_testtp($key1,$key2);
                // if($return){
                //     $result = array('response' => 'SUKSES');                    
                // }
                break;

            case 'makalah':
                // $return = $this->home->delete_makalah($key1,$key2);
                // if($return){
                //     $result = array('response' => 'SUKSES');                    
                // }
                break;

            case 'testgabungan':
                // $return = $this->home->delete_testgabungan($key1,$key2);
                // if($return){
                //     $result = array('response' => 'SUKSES');                    
                // }
                break;

            case 'tupoksi':
                 $return = $this->home->delete_tupoksi($key2);
                 if($return){
                     $result = array('response' => 'SUKSES');                    
                 }
                break;    
            
            default:
                $result = array('response' => 'GAGAL', 'act' => 'No Delete');                
                break;
        }

        echo json_encode($result);

    }
    public function getDataUser(){
        if(isset($_POST['oldpass'])){
            $pass = $_POST['oldpass'];
            $temppass= $this->user['user_password'];
            $encpass = md5($pass);


            if($encpass == $temppass)
            {
                $return = array('response' => 'COCOK');
            }
            else if ($pass == '') {
                $return = array('response' => 'KOSONG');
            }
            else
            {
                $return = array('response' => 'TIDAK COCOK', 'err' => 'TIDAK COCOK');
            }

        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Password');
            echo json_encode($return);
            exit();
        }
        echo json_encode($return);
    }

/*START UPLOAD PHOTO*/
    public function upload_file(){
        if (isset($_POST['nrk'])){
            $nrk = $_POST['nrk'];
        } else {            
            $nrk = "empty";
            //$nrk = $this->user['id'];
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
            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
            $config2['create_thumb'] = TRUE;
            $config2['maintain_ratio'] = FALSE;
            $config2['width'] = 68; //40
            $config2['height'] = 68; //40

            $this->load->library('image_lib', $config2);

            if ( ! $this->image_lib->resize()){                
                $result = $this->image_lib->display_errors();
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

/*START JABATAN STRUKTURAL*/
    public function ajax_add_jab_hist()
    {
        $data['user_id'] = $this->user['id'];        
        $insert = $this->home->save_jabStruk($data);
        
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_jab_hist()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_jabStruk($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }


/*END JABATAN STRUKTURAL*/

/*START JABATAN FUNGSIONAL*/
    public function ajax_add_jabf_hist()
    {
        $data['user_id'] = $this->user['id'];        
        $insert = $this->home->save_jabFgs($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

    public function ajax_update_jabf_hist()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_jabFgs($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*START JABATAN FUNGSIONAL*/

/*START PENDIDIKAN FORMAL*/
    public function ajax_add_pend_formal()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_pdFormal($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

    public function ajax_update_pend_formal()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_pdFormal($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END PENDIDIKAN FORMAL*/

/*START PENDIDIKAN NON FORMAL*/
    public function ajax_add_pend_nonformal()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_pdNonFormal($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

    public function ajax_update_pend_nonformal()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_pdNonFormal($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END PENDIDIKAN NON FORMAL*/


/*START PANGKAT*/
    public function getMasaKerjaByKopang(){
        if(isset($_POST['kopang'])){
            $kopang = $_POST['kopang'];
            $tahun_refgaji = $_POST['tahun_refgaji'];
           
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Kopang');
            echo json_encode($return);
            exit();
        }

        //$listttmasker = $this->home->getMasaKerjaByKopang($kopang);
        $maxmasker = $this->home->getMaxTtmasker($kopang);
        //var_dump($maxmasker);
        $arr = array('response' => 'SUKSES', 'kopang'=>$kopang, 'tahun'=>$tahun_refgaji, 'maxmasker' => $maxmasker);
        echo json_encode($arr);
    }

    public function getMasaKerjaByTMT(){
        $nrk = $_POST['nrk'];

        $tmt="";
        if(isset($_POST['tmt'])){
            $tmt = $_POST['tmt'];
            
           
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No TMT');
            echo json_encode($return);
            exit();
        }


        $getYear=substr($tmt, 6);
        $getMon = substr($tmt, 3,2);
        
        $masker = $this->home->getMasker($nrk,$tmt,$getYear,$getMon)->row();

        $newttmsk="";
        $newbbmsk="";
        if($masker == NULL)
        {

            $newttmsk = 0;
            $newbbmsk = 0;
        }
        else
        {
            
            $newttmsk = $masker->TTMSKNOW;
            $newbbmsk = $masker->BBMSKNOW;            
        }


        $arr = array('response' => 'SUKSES', 'nrk'=>$nrk, 'tmt'=>$tmt, 'newttmsk'=>$newttmsk, 'newbbmsk' => $newbbmsk);
        echo json_encode($arr);
    }

    public function getStapegCPNS(){
        $nrk = $_POST['nrk'];

        
        $getData = $this->home->cekStapegPegawai($nrk)->row();
        $stapeg = $getData->STAPEG;
        


        $arr = array('response' => 'SUKSES', 'nrk'=>$nrk, 'stapeg'=>$stapeg);
        echo json_encode($arr);
    }

    public function getGapokByKopang(){
        if(isset($_POST['kopang'])){
            $tahun_refgaji = $_POST['tahun_refgaji'];
            $kopang = $_POST['kopang'];
            $ttmasker = $_POST['ttmasker'];
            //$maxmasker = $_POST['maxmasker'];
            $maxmasker =  $this->home->getMaxTtmasker($kopang);
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Gapok');
            echo json_encode($return);
            exit();
        }

        if($ttmasker <= $maxmasker)
        {
            $ttmasker=$ttmasker;
        }
        else
        {
            $ttmasker=$maxmasker;
        }
        $list = $this->home->getGapokByKopang($tahun_refgaji,$kopang,$ttmasker);
        if($list==null)
        {
            $gapok=0;
        }
        else
        {
            $gapok = number_format($list->GAPOK,0,',','.');    
        }
        

        $arr = array('response' => 'SUKSES', 'tahun_refgaji'=>$tahun_refgaji, 'kopang'=>$kopang, 'ttmasker'=>$ttmasker, 'gapok' => $gapok);
        echo json_encode($arr);
    }

    public function ajax_add_pangkat()
    {
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_pangkat($data);

        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add",'hasil' => 'Key Sudah digunakan'));
        }
        
    }

    public function ajax_update_pangkat()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_pangkat($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

    public function getKopang()
    {
        $kopang = $this->input->post('kopang');

        $listKopang = $this->infopegawai->getMasterPangkat($kopang);
        $arr = array('response' => 'SUKSES', 'listKopang' => $listKopang);
        echo json_encode($arr);
    }    
/*END PANGKAT*/

/*START GAPOK*/

    public function getMasyad(){
        if(isset($_POST['kopang'])){
            $kopang = $_POST['kopang'];
            $ttmasker = $_POST['ttmasker'];
            $bbmasker = $_POST['bbmasker'];
            $da = $this->home->cekMasa($kopang, $ttmasker);
            $min = $this->home->cekMasaMin($kopang);
            $minttmask = $min->MINTTMASK;
            $minbbmask = $min->MINBBMASK;
            
            if($da)
            {
                $tt = $da->MINTT;
                $bb = $da->MINBB; 
            }
            else
            {
                $tt = 0;
                $bb = 0;
            }

        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Gapok');
            echo json_encode($return);
            exit();
        }

        $arr = array('response' => 'SUKSES','ttmasker' => $tt ,'bbmasker' => $bb, 'minttmask' => $minttmask , 'minbbmask' => $minbbmask);
        echo json_encode($arr);
    }

    public function ajax_add_gapok()
    {        
        $data['user_id'] = $this->user['id'];
        
        $insert = $this->home->save_gapok($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_gapok()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_gapok($data);
         
        if($update){
            echo json_encode(array("response" => 'SUKSES', "act" => 'upd'));
        }else{
            echo json_encode(array("response" => 'GAGAL', "act" => 'upd'));
        }
    }

/*END GAPOK*/

/*START HUKUMAN DISIPLIN*/
    public function ajax_add_hukdis()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_hukdis($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_hukdis()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_hukdis($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END HUKUMAN DISIPLIN*/

/*START HUKUMAN ADMINISTRASI*/
    public function ajax_add_hukadm()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_hukadmin($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_hukadm()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_hukadmin($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END HUKUMAN ADMINISTRASI*/

/*START DP3*/
    public function ajax_add_dp3()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_dp3($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_dp3()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_dp3($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END DP3*/

/*START ABSENSI*/
    public function ajax_add_absensi()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_absensi($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_absensi()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_absensi($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END ABSENSI*/

/*START CUTI*/
    public function ajax_add_cuti()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_cuti($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_cuti()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_cuti($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END CUTI*/

/*START PEMBATASAN*/
    public function ajax_add_pembatasan()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_batasan($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_pembatasan()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_batasan($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END PEMBATASAN*/

/*START SEMINAR*/
    public function ajax_add_seminar()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_seminar($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_seminar()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_seminar($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END SEMINAR*/

/*START TULISAN*/
    public function ajax_add_tulisan()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_tulisan($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_tulisan()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_tulisan($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END TULISAN*/

/*START ALAMAT*/
    public function ajax_add_alamat()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_alamat($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_alamat()
    {
        $data['user_id'] = $this->user['id'];
        // print_r($data);exit;
        $update = $this->home->update_alamat($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END ALAMAT*/

/*START PENGHARGAAN*/
    public function ajax_add_penghargaan()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_penghargaan($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_penghargaan()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_penghargaan($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END PENGHARGAAN*/

/*START FASILITAS*/
    public function ajax_add_fasilitas()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_fasilitas($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_fasilitas()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_fasilitas($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END FASILITAS*/

/*START ORGANISASI*/
    public function ajax_add_organisasi()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_organisasi($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_organisasi()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_organisasi($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END ORGANISASI*/

/*START KELUARGA*/
    public function ajax_add_keluarga()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_keluarga($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }
        else if($insert==false) {
            echo json_encode(array("response" => 'WARN', 'act' => "add"));
        }
        else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_keluarga()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_keluarga($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END KELUARGA*/

/*START LP2P*/

    public function ajax_add_lp2p()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_lp2p($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_lp2p()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_lp2p($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END LP2P*/

/*START LITSUS*/
    public function ajax_add_litsus()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_litsus($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_litsus()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_litsus($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END LITSUS*/

/*START TEST TPA*/
    public function ajax_add_testtpa()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_testtpa($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_testtpa()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_testtpa($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END TEST TPA*/

/*START TEST TP*/
    public function ajax_add_testtp()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_testtp($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_testtp()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_testtp($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END TEST TP*/

/*START MAKALAH*/
    public function ajax_add_makalah()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_makalah($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_makalah()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_makalah($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END MAKALAH*/

/*START TEST GABUNGAN*/
    public function ajax_add_gabungan()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_gabungan($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_gabungan()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_gabungan($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END GABUNGAN*/

/*START TUPOKSI*/
    public function ajax_add_tupoksi()
    {        
        $data['user_id'] = $this->user['id'];
        $insert = $this->home->save_tupoksi($data);
        
        if($insert){
            echo json_encode(array("response" => 'SUKSES', 'act' => "add"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "add"));
        }
    }

    public function ajax_update_tupoksi()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_tupoksi($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END TUPOKSI*/

/*START REFERENSI*/
    public function getKojabStruktural(){
        if(isset($_POST['kolok'])){
            $kolok = $_POST['kolok'];
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Kolok');
            echo json_encode($return);
            exit();
        }
        
        $listKojab = $this->infopegawai->getMasterKojabAktif($kolok);
        //var_dump($listKojab);
        $arr = array('response' => 'SUKSES', 'listKojab' => $listKojab);
        echo json_encode($arr);
    }

    public function getKojabSF(){
        if(isset($_POST['kolok'])){
            $kolok = $_POST['kolok'];
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Kolok');
            echo json_encode($return);
            exit();
        }

        $listKojab = $this->infopegawai->getMasterKojabSF($kolok);
        //var_dump($listKojab);
        $arr = array('response' => 'SUKSES', 'listKojab' => $listKojab);
        echo json_encode($arr);
    }

    public function getKodikFormal(){
        if(isset($_POST['jendik'])){
            $jendik = $_POST['jendik'];
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Jendik');
            echo json_encode($return);
            exit();
        }
        
        $listKodik = $this->infopegawai->getMasterKodik($jendik);
        $arr = array('response' => 'SUKSES', 'listKodik' => $listKodik);
        echo json_encode($arr);
    }

    public function getKodikNonFormal(){
        if(isset($_POST['jendik'])){
            $jendik = $_POST['jendik'];
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Jendik');
            echo json_encode($return);
            exit();
        }
        
        $listKodik = $this->infopegawai->getMasterKodik($jendik);
        $arr = array('response' => 'SUKSES', 'listKodik' => $listKodik);
        echo json_encode($arr);
    }

    public function getKolok()
    {
        $kolok = $this->input->post('kolok');

        $listKolok = $this->infopegawai->getMasterKolok($kolok);
        $arr = array('response' => 'SUKSES', 'listKolok' => $listKolok);
        echo json_encode($arr);
    }

    public function getPejtt()
    {
        $pejtt = $this->input->post('pejtt');

        $listKopang = $this->infopegawai->getMasterPejtt($pejtt);
        $arr = array('response' => 'SUKSES', 'listPejtt' => $listPejtt);
        echo json_encode($arr);
    }

    public function getJenpeg()
    {
        $stapeg = $this->input->post('stapeg');

        $list = $this->infopegawai->getJenpeg($stapeg);
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }

    public function getPropinsiNew3()
    {
        $prop= $this->input->post('q');
        $list = $this->infopegawai->getPropinsiNew3($prop);
        echo json_encode($list);
    }

    public function getWilayahNew()
    {
        $prop = $this->input->post('prop');

        $list = $this->infopegawai->getWilayahNew($prop);
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }

    public function getWilayahNew2()
    {
        $prop = $this->input->post('prop');

        $list = $this->infopegawai->getWilayahNew2($prop);
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }

    public function getWilayahNew3()
    {
        $prop = $this->input->post('prop');
        $wilayah = $this->input->post('q');

        $list = $this->infopegawai->getWilayahNew3($prop,$wilayah);
        echo json_encode($list);
    }

    public function getKab()
    {
        $prov = $this->input->post('prov');
        // var_dump($prov);exit;

        $list = $this->infopegawai->getKab($prov);
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }


    public function getKecamatan()
    {
        $kowil = $this->input->post('kowil');

        $list = $this->infopegawai->getKecamatan($kowil);
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }

    public function getKecamatanNew()
    {
        $kowil = $this->input->post('kowil');

        $list = $this->infopegawai->getKecamatanNew($kowil);
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }

    public function getKecamatanNew2()
    {
        $kowil = $this->input->post('kowil');

        $list = $this->infopegawai->getKecamatanNew2($kowil);
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }

    public function getKecamatanNew3()
    {
        $kowil = $this->input->post('kowil');
        $nacam = $this->input->post('q');

        $list = $this->infopegawai->getKecamatanNew3($kowil,$nacam);
        echo json_encode($list);
    }

    public function getKelurahan()
    {
        $kowil = $this->input->post('kowil');
        $kocam = $this->input->post('kocam');

        $list = $this->infopegawai->getKelurahan($kowil,$kocam);
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }

    public function getKelurahanNew()
    {
        $kocam = $this->input->post('kocam');

        $list = $this->infopegawai->getKelurahanNew($kocam);
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }

    public function getKelurahanNew2()
    {
        $kocam = $this->input->post('kocam');

        $list = $this->infopegawai->getKelurahanNew2($kocam);
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }

    public function getKelurahanNew3()
    {
        $kocam = $this->input->post('kocam');
        $nakel = $this->input->post('q');

        $list = $this->infopegawai->getKelurahanNew3($kocam,$nakel);
        echo json_encode($list);
    }
/*END REFERENSI*/

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
    
    public function check_hukdis()
    {
        $post = $this->input->post();
        $result = $this->infopegawai->check_hukdis_database($post['nrk'], $post['tipe']);
        echo json_encode($result);
    }
    
    public function tambah_informasi()
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

                if($this->user['id'] == 'bkd'){
                    $data['namalog'] = "Badan Kepegawaian Daerah";
                }else{
                    $data['namalog'] = $this->user['username'];
                }

                if($this->user['user_group'] == 5){
                        $datam['inisial'] = 'mjabfung';
                    }
            // END GET NRK
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "270";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'home',0);
                
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
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
            $data['tot_pegawai'] = $this->infopegawai->getTotPegawai();

            $infoUser = $this->home->getUserInfo2($nrk);
            $data['infoUser'] = $infoUser;    

            $dataUserAlay = $this->infopegawai->getDataUser($this->user['id']);          
            $alaypassword= $dataUserAlay->user_password;

            $datam['alaypassword'] = $alaypassword;

            $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);

            if ($data['bawahan'] == "") {
                $date = strtotime('-1 months');
                $thbl = date('Ym',$date);
                $bulantahun = date('M Y',$date);
                $data['thbl'] = $bulantahun;
                $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            }
            
            $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);

            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu',$datam);
            $this->load->view('tambah_informasi',$data);
            $this->load->view('head/footer');
    }
    
    public function tambah_informasi_ke_db()
    {
        $post = $this->input->post();
        $date = date('Y-m-d');
        $data = array('');
        $return = $this->home->insert_informasi();
    }
}
