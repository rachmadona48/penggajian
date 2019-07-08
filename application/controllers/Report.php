<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    private $user=array();

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));      
        $this->load->library('session');
        $this->load->model('mhome','home');
        $this->load->model('mreferensi','referensi');
        $this->load->model('admin/m_admin');
        $this->load->model('admin/v_pegawai','mdl');
        $this->load->library('infopegawai');
        $this->load->library('convert');

        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']       = $session_data['id'];
            $this->user['username']     = $session_data['username'];
            $this->user['user_group']     = $session_data['user_group'];
        }else{
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
            // END GET NRK
                //$datam['li']=$this->home->showMenu();
                $datam['activeMenu'] = "1605";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'report',0);
                
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
            
            $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            
            if ($data['bawahan'] == "") {
                
                    $date = strtotime('-1 months');
                    $thbl = date('Ym',$date);
                    $bulantahun = date('M Y',$date);
                    $data['thbl'] = $bulantahun;
                $data['bawahan'] = $this->infopegawai->getStrukturPegawai($nrk,$thbl);
            }

           // $data['uraian'] = $this->infopegawai->getShowTupoksi($nrk);
            
           
            /*$uraian= "<ol>";
            foreach($data['uraian']->result() as $row)
            {    
                
               $uraian.= "<li>".$row->uraian."</li>";
            }
            $uraian.= "</ol>";*/
           // echo $uraian;
            

            /*$this->load->view('head/header',$this->user);
            $this->load->view('head/menu',$datam);
            $this->load->view('report_v',$data);
            $this->load->view('head/footer');*/
            $this->load->view('403');

    }

    public function laporan(){
        $tgl_sekarang = date("Y-m-d");

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

        // START Inisial Active Menu
        $datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'report',0);
        $datam['user_group'] = $this->user['user_group'];
        $access['mnac'] = $this->infopegawai->getMenuAccessBy($this->user['user_group'],1605);
        $data['accView'] = $access['mnac']->act_view;

        $datam['inisial'] = 'report';
        // END Inisial Active Menu
        $data['nrk'] = $nrk;
        $datam['nrk'] = $nrk;
        $datam['user_group'] = $this->user['user_group'];

        $data['x'] = "";

        $menuid='1605';  
        $cekaksesmenu = $this->infopegawai->cekaksesmenu($menuid,$this->user['user_group']);

        if($cekaksesmenu == '1')
        {
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu',$datam);      
            $this->load->view('laporan',$data);
            $this->load->view('head/footer');
        }
        else
        {
            $this->load->view('403');
        } 
    }

    public function getOptionValue()
    {
        $this->load->model('mreport','report');
        $param = $this->input->post('param');

        switch ($param) {
            case 'ESELON':
                $option = array('response' => 'SUKSES' ,'option' => $this->report->getOptionEselon());
                echo json_encode($option);
                break;
            case 'KOPANG':
                $option = array('response' => 'SUKSES' ,'option' => $this->report->getOptionPangkat());
                echo json_encode($option);
                break;
            case 'KOLOK':
                $option = array('response' => 'SUKSES' ,'option' => $this->report->getOptionLokasiKerja());
                echo json_encode($option);
                break;
            case 'KOJAB':
                $option = array('response' => 'SUKSES' ,'option' => $this->report->getOptionJabatan());
                echo json_encode($option);
                break;
            case 'JENKEL':
                $option = array('response' => 'SUKSES' ,'option' => $this->report->getOptionJenisKelamin());
                echo json_encode($option);
                break;
            case 'KAWIN':
                $option = array('response' => 'SUKSES' ,'option' => $this->report->getOptionStatusMenikah());
                echo json_encode($option);
                break;
            case 'AGAMA':
                $option = array('response' => 'SUKSES' ,'option' => $this->report->getOptionAgama());
                echo json_encode($option);
                break;
            case 'STAPEG':
                $option = array('response' => 'SUKSES' ,'option' => $this->report->getOptionStapeg());
                echo json_encode($option);
                break;
            case 'FLAG':
                $option = array('response' => 'SUKSES' ,'option' => $this->report->getOptionStatusAktif());
                echo json_encode($option);
                break;
            case 'NADIK':
                $option = array('response' => 'SUKSES' ,'option' => $this->report->getOptionJenisPendidikan());
                echo json_encode($option);
                break;
            case 'JENJDIK':
                $option = array('response' => 'SUKSES' ,'option' => $this->report->getOptionJenjangPendidikan());
                echo json_encode($option);
                break;    
            case 'MAKER':
                $option = array('response' => 'SUKSES' ,'option' => $this->report->getOptionMasaKerja());
                echo json_encode($option);
                break;
            case 'HUKDIS':
                $option = array('response' => 'SUKSES' ,'option' => $this->report->getOptionHukdis());
                echo json_encode($option);
                break;
            case 'USIA':
                $option = array('response' => 'SUKSES' ,'option' => $this->report->getOptionUsia());
                echo json_encode($option);
                break;
            case 'FASILITAS':
                $option = array('response' => 'SUKSES' ,'option' => $this->report->getOptionFasilitas());
                echo json_encode($option);
                break;
            
            default:
                $option = array('response' => 'GAGAL' ,'option' => '');
                echo json_encode($option);
                break;
        }
    }


    public function getListPegawai()
    {
        $this->load->model('mreport','report');
        if($this->input->post()){
            $post = $this->input->post();
            $staakt=$post['staakt'];
            $global = $post['srcglobal'];



            $usia1Post="";
            if(isset($post['usia1']))
            {
                $usia1Post = $post['usia1'];
            }
            //var_dump($post['usia1']);
            $usia2Post="";
            if(isset($post['usia2']))
            {
                $usia2Post = $post['usia2'];
            }

            $uniquepost = array_unique($post['jenis']);

            $uniquepostreset = array_values($uniquepost);

            $query = "V1";
            if((in_array('NADIK', $uniquepostreset) && in_array('FASILITAS', $uniquepostreset)) || in_array('JENJDIK', $uniquepostreset)){
                $query = "V2";
            }elseif (in_array('NADIK', $uniquepostreset)) {
                $query = "V3";
            }elseif (in_array('FASILITAS', $uniquepostreset)) {
                $query = "V4";
            }else{
                $query = "V1";
            }

            $pjenjdik='';
            if(in_array('JENJDIK', $uniquepostreset)){
                $pjenjdik = "jenjdik";
            }
            
            // echo "COUNTER ".count($uniquepostreset); 
            // echo "<pre>";
            // print_r($uniquepostreset);
            // echo "</pre>";
            // exit();

            $where  = "1=1 ";
            for ($i=0; $i < count($uniquepostreset); $i++) { 
                $filter = $uniquepostreset[$i];                            
                 if ($filter == "") {
                    continue;
                }
                switch ($filter) {
                    case 'ESELON':
                        $counter = count($post['eselon']);                        
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {
                                
                                if($post['eselon'][$j] == ""){
                                    if(isset($post['eselon'][$j+1])){
                                        if($post['eselon'][$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    if($post['eselon'][$j] == '00'){
                                        $where .= "(ESELON = '".$post['eselon'][$j]."' OR ESELON = '  ')";
                                    }else{
                                        $where .= "ESELON = '".$post['eselon'][$j]."'";
                                    }
                                    

                                    if ($j < $mincounter) {
                                        if(isset($post['eselon'][$j+1])){
                                            if($post['eselon'][$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }
                                        
                                    }
                                }                                
                            }
                            $where .= ")";
                        }else{
                            if($post['eselon'][0] == '00'){
                                $where .= "(ESELON = '".$post['eselon'][0]."' OR ESELON = '  ')";
                            }else{
                                $where .= "ESELON = '".$post['eselon'][0]."'";
                            }
                        }

                        break;
                    case 'KOPANG':
                        $arrPangkat = array_unique($post['pangkat']); //get unique value array
                        $arrayPangkat = array_keys(array_flip($arrPangkat));// renumber array keys ascending
                        $counter = count($arrayPangkat);                          
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {
                                
                                if($arrayPangkat[$j] == ""){
                                    if(isset($arrayPangkat[$j+1])){
                                        if($arrayPangkat[$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "KOPANG = '".$arrayPangkat[$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($arrayPangkat[$j+1])){
                                            if($arrayPangkat[$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }
                                        
                                    }
                                }                                
                            }
                            $where .= ")";
                        }else{
                            $where .= "KOPANG = '".$arrayPangkat[0]."'";
                        }
                        break;
                    case 'KOLOK':
                        $arrKolok = array_unique($post['kolok']); //get unique value array
                        $arrayKolok = array_keys(array_flip($arrKolok));// renumber array keys ascending
                        $counter = count($arrayKolok);     


                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {
                                
                                if($arrayKolok[$j] == ""){
                                    if(isset($arrayKolok[$j+1])){
                                        if($arrayKolok[$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "NALOKL = '".$arrayKolok[$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($arrayKolok[$j+1])){
                                            if($arrayKolok[$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }
                                        
                                    }
                                }                                
                            }
                            $where .= ")";
                        }else{
                            $where .= "NALOKL = '".$arrayKolok[0]."'";
                        }
                        break;
                    case 'KOJAB':
                    	$arrJabatan = array_unique($post['jabatan']); //get unique value array
                        $arrayJabatan= array_keys(array_flip($arrJabatan));// renumber array keys ascending
                        $counter = count($arrayJabatan);    
                                              
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {
                                
                                if($arrayJabatan[$j] == ""){
                                    if(isset($arrayJabatan[$j+1])){
                                        if($arrayJabatan[$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "TRIM(NAJABL) = '".$arrayJabatan[$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($arrayJabatan[$j+1])){
                                            if($arrayJabatan[$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }
                                        
                                    }
                                }                                
                            }
                            $where .= ")";
                        }else{
                            $where .= "TRIM(NAJABL) = '".$arrayJabatan[0]."'";
                        }
                        break;
                    case 'JENKEL':
                        $arrJenkel = array_unique($post['jeniskelamin']); //get unique value array
                        $arrayJenkel= array_keys(array_flip($arrJenkel));// renumber array keys ascending
                        $counter = count($arrayJenkel);    
                        //$counter = count($post['jeniskelamin']);                        
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {
                                
                                if($arrayJenkel[$j] == ""){
                                    if(isset($arrayJenkel[$j+1])){
                                        if($arrayJenkel[$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "JENKEL = '".$arrayJenkel[$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($arrayJenkel[$j+1])){
                                            if($arrayJenkel[$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }
                                        
                                    }
                                }                                
                            }
                            $where .= ")";
                        }else{
                            $where .= "JENKEL = '".$arrayJenkel[0]."'";
                        }
                        break;
                    case 'KAWIN':
                    	$arrStawin = array_unique($post['statuskawin']); //get unique value array
                        $arrayStawin= array_keys(array_flip($arrStawin));// renumber array keys ascending
                        $counter = count($arrayStawin);
                        $arrayStawinFx=array();
                        for($p=0;$p<$counter;$p++)
                        {
                            if($arrayStawin[$p] == '0')
                            {
                                $arrayStawinFx[$p]=$arrayStawin[$p];
                                $arrayStawin[$p] = 'BELUM';                                
                            }
                            else
                            {
                                $arrayStawinFx[$p] = $arrayStawin[$p];
                            }
                        }

                        //$counter = count($post['statuskawin']);                        
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {
                                
                                if($arrayStawinFx[$j] == ""){
                                    if(isset($arrayStawinFx[$j+1])){
                                        if($arrayStawinFx[$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "STAWIN = '".$arrayStawinFx[$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($arrayStawinFx[$j+1])){
                                            if($arrayStawinFx[$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }
                                        
                                    }
                                }                                
                            }
                            $where .= ")";
                        }else{
                            $where .= "STAWIN = '".$arrayStawinFx[0]."'";
                        }
                        break;
                    case 'AGAMA':
                    	$arrAgama = array_unique($post['agama']); //get unique value array
                        $arrayAgama= array_keys(array_flip($arrAgama));// renumber array keys ascending
                        $counter = count($arrayAgama);
                        //$counter = count($post['agama']);                        
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {
                                
                                if($arrayAgama[$j] == ""){
                                    if(isset($arrayAgama[$j+1])){
                                        if($arrayAgama[$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "AGAMA = '".$arrayAgama[$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($arrayAgama[$j+1])){
                                            if($arrayAgama[$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }
                                        
                                    }
                                }                                
                            }
                            $where .= ")";
                        }else{
                            $where .= "AGAMA = '".$arrayAgama[0]."'";
                        }
                        break;
                    case 'STAPEG':
                    	$arrStapeg = array_unique($post['stapeg']); //get unique value array
                        $arrayStapeg= array_keys(array_flip($arrStapeg));// renumber array keys ascending
                        $counter = count($arrayStapeg);
                        //$counter = count($post['stapeg']);                        
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {
                                
                                if($arrayStapeg[$j] == ""){
                                    if(isset($arrayStapeg[$j+1])){
                                        if($arrayStapeg[$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "STAPEG = '".$arrayStapeg[$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($arrayStapeg[$j+1])){
                                            if($arrayStapeg[$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }
                                        
                                    }
                                }                                
                            }
                            $where .= ")";
                        }else{
                            $where .= "STAPEG = '".$arrayStapeg[0]."'";
                        }
                        break;
                    // case 'FLAG':
                    //     $counter = count($post['statusaktif']);                        
                    //     $mincounter = $counter-1;
                    //     $where .= " AND ";
                    //     if($counter > 1){
                    //         $where .= "(";
                    //         for ($j=0; $j < $counter; $j++) {
                                
                    //             if($post['statusaktif'][$j] == ""){
                    //                 if(isset($post['statusaktif'][$j+1])){
                    //                     if($post['statusaktif'][$j+1] != ""){
                    //                         $where .= " OR ";
                    //                     }
                    //                 }
                    //                 continue;
                    //             }else{
                    //                 $where .= "FLAG = '".$post['statusaktif'][$j]."'";
                    //                 if ($j < $mincounter) {
                    //                     if(isset($post['statusaktif'][$j+1])){
                    //                         if($post['statusaktif'][$j+1] != ""){
                    //                             $where .= " OR ";
                    //                         }
                    //                     }
                    //                 }
                    //             }                                
                    //         }
                    //         $where .= ")";
                    //     }else{
                    //         $where .= "FLAG = '".$post['statusaktif'][0]."'";
                    //     }
                    //     break;
                    case 'NADIK':
                    	$arrJendik = array_unique($post['jendik']); //get unique value array
                        $arrayJendik= array_keys(array_flip($arrJendik));// renumber array keys ascending
                        $counter = count($arrayJendik);

                        //$counter = count($post['jendik']);                        
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {
                                
                                if($post['jendik'][$j] == ""){
                                    if(isset($arrayJendik[$j+1])){
                                        if($arrayJendik[$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "UNIVER = '".$arrayJendik[$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($arrayJendik[$j+1])){
                                            if($arrayJendik[$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }
                                        
                                    }
                                }                                
                            }
                            $where .= ")";
                        }else{
                            $where .= "UNIVER = '".$arrayJendik[0]."'";
                        }
                        break;
                    case 'JENJDIK':
                        $arrJenjdik = array_unique($post['jenjdik']); //get unique value array
                        $arrayJenjdik= array_keys(array_flip($arrJenjdik));// renumber array keys ascending
                        $counter = count($arrayJenjdik);

                        //$counter = count($post['jendik']);                        
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {
                                
                                if($post['jenjdik'][$j] == ""){
                                    if(isset($arrayJenjdik[$j+1])){
                                        if($arrayJenjdik[$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    if ($arrayJenjdik[$j]=='4'){
                                        $where .= " KODE_JENJANG IN ('40','41','42','43','44') ";    
                                    } else if ($arrayJenjdik[$j]=='7'){
                                        $where .= " KODE_JENJANG IN ('45','46','47','48','49') ";
                                    } else {
                                        $where .= " KODE_JENJANG = '".$arrayJenjdik[$j]."' ";
                                    }
                                    
                                    if ($j < $mincounter) {
                                        if(isset($arrayJenjdik[$j+1])){
                                            if($arrayJenjdik[$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }
                                        
                                    }
                                }                                
                            }
                            $where .= ")";
                        }else{
                            if ($arrayJenjdik[0]=='4'){
                                $where .= " KODE_JENJANG IN ('40','41','42','43','44') ";    
                            } else if ($arrayJenjdik[0]=='7'){
                                $where .= " KODE_JENJANG IN ('45','46','47','48','49') ";
                            } else {
                                $where .= " KODE_JENJANG = '".$arrayJenjdik[0]."' ";    
                            }
                            
                        }
                        break;    
                    case 'MAKER':
                        $counter = count($post['masakerja']);                        
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {
                                
                                if($post['masakerja'][$j] == ""){
                                    if(isset($post['masakerja'][$j+1])){
                                        if($post['masakerja'][$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "MAKERTHNREAL = '".$post['masakerja'][$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($post['masakerja'][$j+1])){
                                            if($post['masakerja'][$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }
                                        
                                    }
                                }                                
                            }
                            $where .= ")";
                        }else{
                            $where .= "MAKERTHNREAL = '".$post['masakerja'][0]."'";
                        }
                        break;
                    case 'HUKDIS':
                    	$arrHukdis = array_unique($post['hukdis']); //get unique value array
                        $arrayHukdis= array_keys(array_flip($arrHukdis));// renumber array keys ascending
                        $counter = count($arrayHukdis);
                        //$counter = count($post['hukdis']);                        
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {
                                
                                if($arrayHukdis[$j] == ""){
                                    if(isset($arrayHukdis[$j+1])){
                                        if($arrayHukdis[$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }
                                else if($arrayHukdis[$j] == "all")
                                {
                                    $where .= "JENHUKDIS != ''";
                                    //echo $arrayHukdis[$j];
                                    continue;
                                }
                                else{
                                    $where .= "JENHUKDIS = '".$arrayHukdis[$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($arrayHukdis[$j+1])){
                                            if($arrayHukdis[$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }
                                        
                                    }
                                }                                
                            }
                            $where .= ")";
                        }else{
                            if($arrayHukdis[0] == "all")
                            {
                                $where .= "JENHUKDIS != 25";
                                //echo $arrayHukdis[$j];
                                continue;
                            }else{
                                $where .= "JENHUKDIS = '".$arrayHukdis[0]."'";
                            }
                        }
                        break;
                    case 'USIA':
                        /*$counter = count($post['usia']);
                        $counter2 = count($post['usia']);                         
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {
                                
                                if($post['usia'][$j] == ""){
                                    if(isset($post['usia'][$j+1])){
                                        if($post['usia'][$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "UMURTHNREAL = '".$post['usia'][$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($post['usia'][$j+1])){
                                            if($post['usia'][$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }
                                        
                                    }
                                }                                
                            }
                            $where .= ")";
                        }else{
                            $where .= "UMURTHNREAL = '".$post['usia'][0]."'";
                        }
                        break;*/
                        $isiUsia1 = $usia1Post;
                        $isiUsia2 = $usia2Post;
                       
                        //$arrUsia1 = array_unique($isiUsia1);
                        //$arrayUsia = array_keys(array_flip($arrUsia));
                        
                        $counter = count($isiUsia1);
                        $mincounter = $counter-1;

                        
                        
                        $where .= " AND ";
                        if($counter > 1){

                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) 
                            {
                                
                                if($isiUsia1[$j]=='' && $isiUsia2[$j]=='')
                                {
                                    continue;
                                }
                                else if($isiUsia1[$j]!='' && $isiUsia2[$j]=='')
                                {
                                    $where .= "UMURTHNREAL = ".$isiUsia1[$j]."";   
                                }
                                else if($isiUsia1[$j]=='' && $isiUsia2[$j]!='')
                                {
                                    $where .= "UMURTHNREAL = ".$isiUsia2[$j]."";   
                                }
                                else
                                {
                                    if($isiUsia1[$j] < $isiUsia2[$j])
                                    {
                                        $where .= "(UMURTHNREAL >= ".$isiUsia1[$j]." AND UMURTHNREAL <= ".$isiUsia2[$j].")";        
                                    }
                                    else if($isiUsia1[$j] > $isiUsia2[$j])
                                    {
                                        $where .= "(UMURTHNREAL >= ".$isiUsia2[$j]." AND UMURTHNREAL <= ".$isiUsia1[$j].")";    
                                    }
                                    else if($isiUsia1[$j] == $isiUsia2[$j])
                                    {
                                        $where .= "UMURTHNREAL >= ".$isiUsia1[$j]."";       
                                    }                        
                                }
                                    
                                if($j < $mincounter) 
                                {
                                    if(isset($isiUsia1[$j+1]) || isset($isiUsia2[$j+1]))
                                    {
                                        if($isiUsia1[$j+1] != "" || $isiUsia2[$j+1])
                                        {
                                            $where .= " OR ";
                                        }
                                    }
                                }                               
                            }
                            $where .= ")";
                        }
                        else if($counter == 1)
                        {
                            
                            if($isiUsia1[0]!="" && $isiUsia2[0]=="")
                            {   
                                $where .= "UMURTHNREAL = ".$isiUsia1[0]."";
                            }
                            else if($isiUsia1[0]=="" && $isiUsia2[0]!="")
                            {
                                $where .= "UMURTHNREAL = ".$isiUsia2[0]."";
                            }
                            else if($isiUsia1[0]!="" && $isiUsia2[0]!="")
                            {
                                if($isiUsia1[0] > $isiUsia2[0])
                                {
                                    $where .= "UMURTHNREAL >= ".$isiUsia2[0]." AND UMURTHNREAL <= ".$isiUsia1[0]."";    
                                }
                                else if($isiUsia1[0] < $isiUsia2[0])
                                {
                                    $where .= "UMURTHNREAL >= ".$isiUsia1[0]." AND UMURTHNREAL <= ".$isiUsia2[0]."";       
                                }
                                else if($isiUsia1[0] == $isiUsia2[0])
                                {
                                    $where .= "UMURTHNREAL = ".$isiUsia1[0]."";    
                                }
                            }
                            else
                            {
                                $where .= "5=5";
                            }
                        }
                        else
                        {
                            $where = "4=4";
                        }
                        
                        break;
                    case 'FASILITAS':
                        $arrJenfas = array_unique($post['jenfas']); //get unique value array
                        $arrayJenfas= array_keys(array_flip($arrJenfas));// renumber array keys ascending
                        $counter = count($arrayJenfas);
                        //$counter = count($post['jenfas']);                        
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {
                                
                                if($arrayJenfas[$j] == ""){
                                    if(isset($arrayJenfas[$j+1])){
                                        if($arrayJenfas[$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "PEGAWAI.JENFAS = '".$arrayJenfas[$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($arrayJenfas[$j+1])){
                                            if($arrayJenfas[$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }
                                        
                                    }
                                }                                
                            }
                            $where .= ")";
                        }else{
                            if($arrayJenfas[0] == "all")
                            {
                                $where .= "PEGAWAI.JENFAS != 25";
                                //echo $arrayHukdis[$j];
                                continue;
                            }else{
                                $where .= "PEGAWAI.JENFAS = '".$arrayJenfas[0]."'";
                            }
                        }
                        break;
                    default:
                        $where.=" AND 2=2";
                        break;
                }                
            }    
            if($query == "V1"){
                $datapegawai = $this->report->getDataPegawaiTes($where,$staakt,$global);
            }elseif($query == "V2"){
                //Ada penambahan pendidikan
                $datapegawai = $this->report->getDataPegawaiV2Tes($where,$staakt,'nadik','jenfas',$global);
            }elseif ($query == "V3") {
                //Ada penambahan pendidikan
                $datapegawai = $this->report->getDataPegawaiV2Tes($where,$staakt,'nadik','',$global);
            }elseif ($query == "V4") {
                //Ada penambahan pendidikan
                $datapegawai = $this->report->getDataPegawaiV2Tes($where,$staakt,'','jenfas',$global);
            }else{
                $datapegawai = $this->report->getDataPegawaiTes($where,$staakt,$global);
            }

            $response = array('response' => 'SUKSES', 'datapegawai' => $datapegawai);
        }else{
            $response = array('response' => 'GAGAL');
        }

        echo $datapegawai;
            
    }

    public function cetakReport()
    {
        $this->load->model('mreport','report');
        
        
        if($this->input->post())
        {
            $post = $this->input->post();
            
            $staakt="";
            if(isset($post['staakt']))
            {
            	$staakt = $post['staakt'];
            }

            $global="";
            if(isset($post['srcglobal']))
            {
                $global = $post['srcglobal'];
            }            

            $valJenis="";
            if(isset($post['jenis']))
            {
            	$valJenis = $post['jenis'];
            }

            $kolokPost="";
			if(isset($post['kolok']))
            {
            	$kolokPost = $post['kolok'];
            } 

         	$jabatanPost="";
			if(isset($post['jabatan']))
            {
            	$jabatanPost = $post['jabatan'];
            }

            $pangkatPost="";
			if(isset($post['pangkat']))
            {
            	$pangkatPost = $post['pangkat'];
            }

            $eselonPost="";
			if(isset($post['eselon']))
            {
            	$eselonPost = $post['eselon'];
            }

            $jeniskelaminPost="";
			if(isset($post['jeniskelamin']))
            {
            	$jeniskelaminPost = $post['jeniskelamin'];
            }

            $statuskawinPost="";
			if(isset($post['statuskawin']))
            {
            	$statuskawinPost = $post['statuskawin'];
            }

            $agamaPost="";
			if(isset($post['agama']))
            {
            	$agamaPost = $post['agama'];
            }

            $stapegPost="";
			if(isset($post['stapeg']))
            {
            	$stapegPost = $post['stapeg'];
            }

            $statusaktifPost="";
			if(isset($post['statusaktif']))
            {
            	$statusaktifPost = $post['statusaktif'];
            }

            $jendikPost="";
			if(isset($post['jendik']))
            {
            	$jendikPost = $post['jendik'];
            }

            $masakerjaPost="";
			if(isset($post['masakerja']))
            {
            	$masakerjaPost = $post['masakerja'];
            }

            $hukdisPost="";
			if(isset($post['hukdis']))
            {
            	$hukdisPost = $post['hukdis'];
            }

            $usia1Post="";
			if(isset($post['usia1']))
            {
            	$usia1Post = $post['usia1'];
            }

            $usia2Post="";
			if(isset($post['usia2']))
            {
            	$usia2Post = $post['usia2'];
            }

            $jenfasPost="";
			if(isset($post['jenfas']))
            {
            	$jenfasPost = $post['jenfas'];
            }

            $jenjdikPost="";
            if(isset($post['jenjdik']))
            {
                $jenjdikPost = $post['jenjdik'];
            }

            $uniquepost = array_unique($valJenis);
            
            $uniquepostreset = array_values($uniquepost);

            $query = "V1";
            if(in_array('NADIK', $uniquepostreset) && in_array('FASILITAS', $uniquepostreset)|| in_array('JENJDIK', $uniquepostreset)){
                $query = "V2";
            }elseif (in_array('NADIK', $uniquepostreset)) {
                $query = "V3";
            }elseif (in_array('FASILITAS', $uniquepostreset)) {
                $query = "V4";
            }else{
                $query = "V1";
            }
            
            $pjenjdik='';
            if(in_array('JENJDIK', $uniquepostreset)){
                $pjenjdik = "jenjdik";
            }
            

            $where  = "1=1 ";
            for ($i=0; $i < count($uniquepostreset); $i++) { 
                $filter = $uniquepostreset[$i];                            
                
                if ($filter == "") {
                    continue;
                }

                switch ($filter) {
                    case 'ESELON':
                        
                        $arrEselon = array_unique($eselonPost); //get unique value array
						$arrayEselon = array_keys(array_flip($arrEselon));// renumber array keys ascending

                        $counter = count($arrayEselon);
                        $mincounter = $counter-1;
                        
                        $where .= " AND ";
                        if($counter > 1){

                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) 
                            {
                                if($arrayEselon[$j] == '00')
                                {
                                    $where .= "ESELON = '".$arrayEselon[$j]."' OR ESELON = '  '";
                                }
                                else if($arrayEselon[$j] == '')
                                {
                                    continue;
                                }
                                else
                                {
                                    $where .= "ESELON = '".$arrayEselon[$j]."'";
                                }
                                    
                                if ($j < $mincounter) 
                                {
                                    if(isset($arrayEselon[$j+1]))
                                    {
                                        if($arrayEselon[$j+1] != "")
                                        {
                                            $where .= " OR ";
                                        }
                                    }
                                }                              
                            }
                            $where .= ")";
                        }
                        else if($counter == 1)
                        {
                            if($arrayEselon[0]!="")
                            {
                                $where .= "ESELON = '".$arrayEselon[0]."'";     
                            }
                            else
                            {
                                 $where .= "5=5";
                            }
                        }
                        else
                        {
                            $where = "4=4";
                        }
                        break;


                    case 'KOPANG':
                        
                        $arrKopang = array_unique($pangkatPost);
                        $arrayKopang = array_keys(array_flip($arrKopang));
                        $counter = count($arrayKopang);
                        $mincounter = $counter-1;
                        
                        $where .= " AND ";
                        if($counter > 1){

                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) 
                            {
                                if($arrayKopang[$j]=='')
                                {
                                    continue;
                                }
                                else
                                {
                                    $where .= "KOPANG = '".$arrayKopang[$j]."'";    
                                }
                                
                                    
                                if ($j < $mincounter) 
                                {
                                    if(isset($arrayKopang[$j+1]))
                                    {
                                        if($arrayKopang[$j+1] != "")
                                        {
                                            $where .= " OR ";
                                        }
                                    }
                                }                              
                            }
                            $where .= ")";
                        }
                        else if($counter == 1)
                        {
                            if($arrayKopang[0]!="")
                            {
                                $where .= "KOPANG = '".$arrayKopang[0]."'";     
                            }
                            else
                            {
                                 $where .= "5=5";
                            }
                        }
                        else
                        {
                            $where = "4=4";
                        }
                        break;

                    case 'KOLOK':

                        $arrKolok = array_unique($kolokPost);
                        $arrayKolok = array_keys(array_flip($arrKolok));
                        $counter = count($arrayKolok);
                        $mincounter = $counter-1;
                        
                        $where .= " AND ";
                        if($counter > 1){

                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) 
                            {
                                if($arrayKolok[$j]=='')
                                {
                                    continue;
                                }
                                else
                                {
                                    $where .= "NALOKL = '".$arrayKolok[$j]."'";    
                                }
                                
                                    
                                if ($j < $mincounter) 
                                {
                                    if(isset($arrayKolok[$j+1]))
                                    {
                                        if($arrayKolok[$j+1] != "")
                                        {
                                            $where .= " OR ";
                                        }
                                    }
                                }                              
                            }
                            $where .= ")";
                        }
                        else if($counter == 1)
                        {
                            if($arrayKolok[0]!="")
                            {
                                $where .= "NALOKL = '".$arrayKolok[0]."'";     
                            }
                            else
                            {
                                 $where .= "5=5";
                            }
                        }
                        else
                        {
                            $where = "4=4";
                        }
                        break;

                    case 'KOJAB':
                        
                        $arrJabatan = array_unique($jabatanPost);
                        $arrayJabatan = array_keys(array_flip($arrJabatan));
                        $counter = count($arrayJabatan);
                        $mincounter = $counter-1;
                        
                        $where .= " AND ";
                        if($counter > 1){

                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) 
                            {
                                if($arrayJabatan[$j]=='')
                                {
                                    continue;
                                }
                                else
                                {
                                    $where .= "NAJABL = '".$arrayJabatan[$j]."'";    
                                }
                                
                                    
                                if($j < $mincounter) 
                                {
                                    if(isset($arrayJabatan[$j+1]))
                                    {
                                        if($arrayJabatan[$j+1] != "")
                                        {
                                            $where .= " OR ";
                                        }
                                    }
                                }                              
                            }
                            $where .= ")";
                        }
                        else if($counter == 1)
                        {
                            if($arrayJabatan[0]!="")
                            {
                                $where .= "NAJABL = '".$arrayJabatan[0]."'";
                            }
                            else
                            {
                                 $where .= "5=5";
                            }
                        }
                        else
                        {
                            $where = "4=4";
                        }
                        break;


                    case 'JENKEL':
                        
                        $arrJenkel = array_unique($jeniskelaminPost);
                        $arrayJenkel = array_keys(array_flip($arrJenkel));
                        $counter = count($arrayJenkel);
                        $mincounter = $counter-1;
                        
                        $where .= " AND ";
                        if($counter == 2){

                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) 
                            {
                                if($arrayJenkel[$j]=='')
                                {
                                    continue;
                                }
                                else
                                {
                                    $where .= "JENKEL = '".$arrayJenkel[$j]."'";    
                                }
                                
                                    
                                if ($j < $mincounter) 
                                {
                                    if(isset($arrayJenkel[$j+1]))
                                    {
                                        if($arrayJenkel[$j+1] != "")
                                        {
                                            $where .= " OR ";
                                        }
                                    }
                                }                              
                            }
                            $where .= ")";
                        }
                        else if($counter == 1)
                        {
                            if($arrayJenkel[0]!="")
                            {
                                $where .= "JENKEL = '".$arrayJenkel[0]."'";     
                            }
                            else
                            {
                                 $where .= "5=5";
                            }
                        }
                        else
                        {
                            $where = "4=4";
                        }
                        break;
					case 'KAWIN':
                        
                        $arrStawin = array_unique($statuskawinPost);
                        $arrayStawin = array_keys(array_flip($arrStawin));
                        $arrayStawinFx=array();

                        $counter = count($arrayStawin);
                       

                        for($p=0;$p<$counter;$p++)
                        {
                            if($arrayStawin[$p] == '0')
                            {
                                $arrayStawin[$p] = 'BELUM';
                                $arrayStawinFx[$p]=$arrayStawin[$p];
                            }
                            else
                            {
                                $arrayStawinFx[$p] = $arrayStawin[$p];
                            }
                        }

                       
                        $mincounter = $counter-1;
                        
                        $where .= " AND ";
                        if($counter > 1){

                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) 
                            {
                                
                                if($arrayStawinFx[$j]=='')
                                {
                                   
                                    continue;
                                }
                                else if($arrayStawinFx[$j]=='BELUM')
                                {
                                    $where .= "STAWIN = 0";       
                                }
                                else
                                {
                                    $where .= "STAWIN = ".$arrayStawinFx[$j]."";    
                                }
                                    
                                if($j < $mincounter) 
                                {
                                    if(isset($arrayStawinFx[$j+1]))
                                    {
                                        if($arrayStawinFx[$j+1] != "")
                                        {
                                            $where .= " OR ";
                                        }
                                    }
                                }                              
                            }
                            $where .= ")";
                        }
                        else if($counter == 1)
                        {
                            
                            if($arrayStawinFx[0]!="")
                            {   

                                $where .= "STAWIN = ".$arrayStawinFx[0]."";
                            }
                            else if($arrayStawinFx[$j]=='BELUM')
                            {
                                    $where .= "STAWIN = 0";       
                            }
                            else
                            {
                                 $where .= "5=5";
                            }
                        }
                        else
                        {
                            $where = "4=4";
                        }
                        break;

                    case 'AGAMA':
                        
                        $arrAgama = array_unique($agamaPost);
                        $arrayAgama = array_keys(array_flip($arrAgama));
                        
                        $counter = count($arrayAgama);
                       
                        $mincounter = $counter-1;
                        
                        $where .= " AND ";
                        if($counter > 1){

                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) 
                            {
                                
                                if($arrayAgama[$j]=='')
                                {
                                    continue;
                                }
                                
                                else
                                {
                                    $where .= "AGAMA = ".$arrayAgama[$j]."";    
                                }
                                    
                                if($j < $mincounter) 
                                {
                                    if(isset($arrayAgama[$j+1]))
                                    {
                                        if($arrayAgama[$j+1] != "")
                                        {
                                            $where .= " OR ";
                                        }
                                    }
                                }                              
                            }
                            $where .= ")";
                        }
                        else if($counter == 1)
                        {
                            
                            if($arrayAgama[0]!="")
                            {   

                                $where .= "AGAMA = ".$arrayAgama[0]."";
                            }
                            else
                            {
                                $where .= "5=5";
                            }
                        }
                        else
                        {
                            $where = "4=4";
                        }
                        break;
					case 'STAPEG':
                        
                        $arrStapeg = array_unique($stapegPost);
                        $arrayStapeg = array_keys(array_flip($arrStapeg));
                        
                        $counter = count($arrayStapeg);
                       
                        $mincounter = $counter-1;
                        
                        $where .= " AND ";
                        if($counter > 1){

                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) 
                            {
                                
                                if($arrayStapeg[$j]=='')
                                {
                                    continue;
                                }
                                
                                else
                                {
                                    $where .= "STAPEG = ".$arrayStapeg[$j]."";    
                                }
                                    
                                if($j < $mincounter) 
                                {
                                    if(isset($arrayStapeg[$j+1]))
                                    {
                                        if($arrayStapeg[$j+1] != "")
                                        {
                                            $where .= " OR ";
                                        }
                                    }
                                }                              
                            }
                            $where .= ")";
                        }
                        else if($counter == 1)
                        {
                            
                            if($arrayStapeg[0]!="")
                            {   

                                $where .= "STAPEG = ".$arrayStapeg[0]."";
                            }
                            else
                            {
                                $where .= "5=5";
                            }
                        }
                        else
                        {
                            $where = "4=4";
                        }
                        break;
                    // case 'FLAG':
                    //     $counter = count($post['statusaktif']);                        
                    //     $mincounter = $counter-1;
                    //     $where .= " AND ";
                    //     if($counter > 1){
                    //         $where .= "(";
                    //         for ($j=0; $j < $counter; $j++) {
                                
                    //             if($post['statusaktif'][$j] == ""){
                    //                 if(isset($post['statusaktif'][$j+1])){
                    //                     if($post['statusaktif'][$j+1] != ""){
                    //                         $where .= " OR ";
                    //                     }
                    //                 }
                    //                 continue;
                    //             }else{
                    //                 $where .= "FLAG = '".$post['statusaktif'][$j]."'";
                    //                 if ($j < $mincounter) {
                    //                     if(isset($post['statusaktif'][$j+1])){
                    //                         if($post['statusaktif'][$j+1] != ""){
                    //                             $where .= " OR ";
                    //                         }
                    //                     }
                                        
                    //                 }
                    //             }                                
                    //         }
                    //         $where .= ")";
                    //     }else{
                    //         $where .= "FLAG = '".$post['statusaktif'][0]."'";
                    //     }
                    //     break;
                    case 'NADIK':
                      	
                        $arrJendik = array_unique($jendikPost);
                        $arrayJendik = array_keys(array_flip($arrJendik));
                        
                        $counter = count($arrayJendik);
                       
                        $mincounter = $counter-1;
                        
                        $where .= " AND ";
                        if($counter > 1){

                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) 
                            {
                                
                                if($arrayJendik[$j]=='')
                                {
                                    continue;
                                }
                                
                                else
                                {
                                    $where .= "UNIVER = ".$arrayJendik[$j]."";    
                                }
                                    
                                if($j < $mincounter) 
                                {
                                    if(isset($arrayJendik[$j+1]))
                                    {
                                        if($arrayJendik[$j+1] != "")
                                        {
                                            $where .= " OR ";
                                        }
                                    }
                                }                              
                            }
                            $where .= ")";
                        }
                        else if($counter == 1)
                        {
                            
                            if($arrayJendik[0]!="")
                            {   

                                $where .= "UNIVER = ".$arrayJendik[0]."";
                            }
                            else
                            {
                                $where .= "5=5";
                            }
                        }
                        else
                        {
                            $where = "4=4";
                        }
                        break;
                    case 'JENJDIK':
                        $arrJenjdik = array_unique($post['jenjdik']); //get unique value array
                        $arrayJenjdik= array_keys(array_flip($arrJenjdik));// renumber array keys ascending
                        $counter = count($arrayJenjdik);

                        //$counter = count($post['jendik']);                        
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {
                                
                                if($post['jenjdik'][$j] == ""){
                                    if(isset($arrayJenjdik[$j+1])){
                                        if($arrayJenjdik[$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    if ($arrayJenjdik[$j]=='4'){
                                        $where .= " KODE_JENJANG IN ('40','41','42','43','44') ";    
                                    } else if ($arrayJenjdik[$j]=='7'){
                                        $where .= " KODE_JENJANG IN ('45','46','47','48','49') ";
                                    } else {
                                        $where .= " KODE_JENJANG = '".$arrayJenjdik[$j]."' ";
                                    }
                                    
                                    if ($j < $mincounter) {
                                        if(isset($arrayJenjdik[$j+1])){
                                            if($arrayJenjdik[$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }
                                        
                                    }
                                }                                
                            }
                            $where .= ")";
                        }else{
                            if ($arrayJenjdik[0]=='4'){
                                $where .= " KODE_JENJANG IN ('40','41','42','43','44') ";    
                            } else if ($arrayJenjdik[0]=='7'){
                                $where .= " KODE_JENJANG IN ('45','46','47','48','49') ";
                            } else {
                                $where .= " KODE_JENJANG = '".$arrayJenjdik[0]."' ";    
                            }
                            
                        }
                        break;   
					case 'MAKER':
                        
                        $arrMasker = array_unique($masakerjaPost);
                        $arrayMasker = array_keys(array_flip($arrMasker));
                        
                        $counter = count($arrayMasker);
                       
                        $mincounter = $counter-1;
                        
                        $where .= " AND ";
                        if($counter > 1){

                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) 
                            {
                                
                                if($arrayMasker[$j]=='')
                                {
                                    continue;
                                }
                                
                                else
                                {
                                    $where .= "MAKERTHNREAL = ".$arrayMasker[$j]."";    
                                }
                                    
                                if($j < $mincounter) 
                                {
                                    if(isset($arrayMasker[$j+1]))
                                    {
                                        if($arrayMasker[$j+1] != "")
                                        {
                                            $where .= " OR ";
                                        }
                                    }
                                }                              
                            }
                            $where .= ")";
                        }
                        else if($counter == 1)
                        {
                            
                            if($arrayMasker[0]!="")
                            {   

                                $where .= "MAKERTHNREAL = ".$arrayMasker[0]."";
                            }
                            else
                            {
                                $where .= "5=5";
                            }
                        }
                        else
                        {
                            $where = "4=4";
                        }
                        break;
                    case 'HUKDIS':
                        
                        $arrHukdis = array_unique($hukdisPost);
                        $arrayHukdis = array_keys(array_flip($arrHukdis));
                        
                        $counter = count($arrayHukdis);
                       
                        $mincounter = $counter-1;
                        
                        $where .= " AND ";
                        if($counter > 1){

                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) 
                            {
                                
                                if($arrayHukdis[$j]=='')
                                {
                                    continue;
                                }
                                
                                else
                                {
                                    $where .= "JENHUKDIS = ".$arrayHukdis[$j]."";    
                                }
                                    
                                if($j < $mincounter) 
                                {
                                    if(isset($arrayHukdis[$j+1]))
                                    {
                                        if($arrayHukdis[$j+1] != "")
                                        {
                                            $where .= " OR ";
                                        }
                                    }
                                }                              
                            }
                            $where .= ")";
                        }
                        else if($counter == 1)
                        {
                            
                            if($arrayHukdis[0]!="")
                            {   

                                //$where .= "JENHUKDIS = ".$arrayHukdis[0]."";
                                $where .= "JENHUKDIS != 25";
                            }
                            else
                            {
                                $where .= "5=5";
                            }
                        }
                        else
                        {
                            $where = "4=4";
                        }
                        break;
                    case 'USIA':
                        $isiUsia1 = $usia1Post;
                        $isiUsia2 = $usia2Post;
                        
                        //$arrUsia1 = array_unique($isiUsia1);
                        //$arrayUsia = array_keys(array_flip($arrUsia));
                        
                        $counter = count($isiUsia1);
                        $mincounter = $counter-1;

                        
                        
                        $where .= " AND ";
                        if($counter > 1){

                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) 
                            {
                                
                                if($isiUsia1[$j]=='' && $isiUsia2[$j]=='')
                                {
                                    continue;
                                }
                                else if($isiUsia1[$j]!='' && $isiUsia2[$j]=='')
                                {
                                    $where .= "UMURTHNREAL = ".$isiUsia1[$j]."";   
                                }
                                else if($isiUsia1[$j]=='' && $isiUsia2[$j]!='')
                                {
                                    $where .= "UMURTHNREAL = ".$isiUsia2[$j]."";   
                                }
                                else
                                {
                                    if($isiUsia1[$j] < $isiUsia2[$j])
                                    {
                                        $where .= "(UMURTHNREAL >= ".$isiUsia1[$j]." AND UMURTHNREAL <= ".$isiUsia2[$j].")";        
                                    }
                                    else if($isiUsia1[$j] > $isiUsia2[$j])
                                    {
                                        $where .= "(UMURTHNREAL >= ".$isiUsia2[$j]." AND UMURTHNREAL <= ".$isiUsia1[$j].")";    
                                    }
                                    else if($isiUsia1[$j] == $isiUsia2[$j])
                                    {
                                        $where .= "UMURTHNREAL >= ".$isiUsia1[$j]."";       
                                    }                        
                                }
                                    
                                if($j < $mincounter) 
                                {
                                    if(isset($isiUsia1[$j+1]) || isset($isiUsia2[$j+1]))
                                    {
                                        if($isiUsia1[$j+1] != "" || $isiUsia2[$j+1])
                                        {
                                            $where .= " OR ";
                                        }
                                    }
                                }                               
                            }
                            $where .= ")";
                        }
                        else if($counter == 1)
                        {
                            
                            if($isiUsia1[0]!="" && $isiUsia2[0]=="")
                            {   
                                $where .= "UMURTHNREAL = ".$isiUsia1[0]."";
                            }
                            else if($isiUsia1[0]=="" && $isiUsia2[0]!="")
                            {
                                $where .= "UMURTHNREAL = ".$isiUsia2[0]."";
                            }
                            else if($isiUsia1[0]!="" && $isiUsia2[0]!="")
                            {
                                if($isiUsia1[0] > $isiUsia2[0])
                                {
                                    $where .= "UMURTHNREAL >= ".$isiUsia2[0]." AND UMURTHNREAL <= ".$isiUsia1[0]."";    
                                }
                                else if($isiUsia1[0] < $isiUsia2[0])
                                {
                                    $where .= "UMURTHNREAL >= ".$isiUsia1[0]." AND UMURTHNREAL <= ".$isiUsia2[0]."";       
                                }
                                else if($isiUsia1[0] == $isiUsia2[0])
                                {
                                    $where .= "UMURTHNREAL = ".$isiUsia1[0]."";    
                                }
                            }
                            else
                            {
                                $where .= "5=5";
                            }
                        }
                        else
                        {
                            $where = "4=4";
                        }
                        break;
                    case 'FASILITAS':
                        
                        $arrJenfas = array_unique($jenfasPost);
                        $arrayJenfas = array_keys(array_flip($arrJenfas));
                        
                        $counter = count($arrayJenfas);
                       
                        $mincounter = $counter-1;
                        
                        $where .= " AND ";
                        if($counter > 1){

                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) 
                            {
                                
                                if($arrayJenfas[$j]=='')
                                {
                                    continue;
                                }
                                
                                else
                                {
                                    $where .= "PEGAWAI.JENFAS = ".$arrayJenfas[$j]."";    
                                }
                                    
                                if($j < $mincounter) 
                                {
                                    if(isset($arrayJenfas[$j+1]))
                                    {
                                        if($arrayJenfas[$j+1] != "")
                                        {
                                            $where .= " OR ";
                                        }
                                    }
                                }                              
                            }
                            $where .= ")";
                        }
                        else if($counter == 1)
                        {
                            
                            if($arrayJenfas[0]!="")
                            {   
                               if($arrayJenfas[0]="all")
                                {
                                    $where .= "PEGAWAI.JENFAS != 25";    
                                }
                                else
                                {
                                    $where .= "PEGAWAI.JENFAS = ".$arrayJenfas[0]."";    
                                }
                                
                            }
                            else
                            {
                                $where .= "5=5";
                            }
                        }
                        else
                        {
                            $where = "4=4";
                        }
                        break;
                    default:
                        $where.=" AND 2=2";
                        break;
                }

            }    
            
            if($query == "V1"){
                $datapegawai = $this->report->queryDataPegawaiTes($where,$staakt,$global);
            }elseif($query == "V2"){
                //Ada penambahan pendidikan
                $datapegawai = $this->report->queryDataPegawaiV2($where,$staakt,'nadik','jenfas',$global);
            }elseif ($query == "V3") {
                //Ada penambahan pendidikan

                $datapegawai = $this->report->queryDataPegawaiV2($where,$staakt,'nadik','',$global);

            }elseif ($query == "V4") {
                //Ada penambahan pendidikan
                $datapegawai = $this->report->queryDataPegawaiV2($where,$staakt,'','jenfas',$global);
            }else{
                $datapegawai = $this->report->queryDataPegawaiTes($where,$staakt,$global);
            }

           

           	$html = '   <table border="1" cellpadding="2" width="100%">
                        	<tr>
                                <th width="3%" align="center"><b>NO</b></th>
                                <th width="8%" align="center"><b>NRK</b></th>
                                <th width="18%" align="center"><b>NAMA</b></th>
                                <th width="30%" align="center"><b>LOKASI</b></th>
                                <th width="20%" align="center"><b>JABATAN</b></th>
                                <th width="10%" align="center"><b>ESELON</b></th>
                                <th width="11%" align="center"><b>PANGKAT</b></th>
                            </tr>';
                			
                    foreach($datapegawai as $row) 
                    {

            $html.='		<tr>
                                <td>'.$row->ROWNUM.'</td>
                                <td>'.$row->NRK.'</td>
                                <td>'.$row->NAMA.'</td>
                                <td>'.$row->NALOKL.'<br/><small>( '.$row->KOLOK.' )</small></td>
                                <td>'.$row->NAJABL.'<br/><small>( '.$row->KOJAB.' )</small></td>
                                <td align="center">'.$row->NESELON.'</td>
                                
                                <td align="center">'.$row->GOL.' - '.$row->NAPANG.'</td>
                            </tr>';          
                    } 
                    
            $html.='
                        </table>
                    ';

 		
        }
        else
        {
        	$html = "test";
        }


       
       
        
		$this->load->library('pdf_report4');
            
            ob_start();
  
            $this->pdf_report4->SetTitle('pegawai'); 
           // definisikan judul dokumen


            $this->pdf_report4->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
            // set header and footer fonts
            $this->pdf_report4->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $this->pdf_report4->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            //$this->pdf_report2->setPrintHeader(false);
            //$this->pdf_report2->setPrintFooter(false);
            // set default monospaced font
            $this->pdf_report4->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $this->pdf_report4->SetMargins(PDF_MARGIN_LEFT, 50, PDF_MARGIN_RIGHT,FALSE);
            $this->pdf_report4->SetHeaderMargin(PDF_MARGIN_HEADER);
            $this->pdf_report4->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $this->pdf_report4->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $this->pdf_report4->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf_report4->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set font
            $this->pdf_report4->SetFont('helvetica', '', 8);
            $this->pdf_report4->AddPage();          

            
              
            $this->pdf_report4->writeHTML($html, true, false, true, false, '');
            //$this->pdf_report2->lastPage();
             //ob_clean();          
            
            $this->pdf_report4->Output('datapegawai.pdf', 'I');        
        	

        	
       
    }

    function toPdf($datapegawai)
    {
     		
     		//var_dump($datapegawai);  
            $this->load->library('pdf_report4');
            
        
            ob_start();
  
            $this->pdf_report4->SetTitle('pegawai'); 
           // definisikan judul dokumen


            $this->pdf_report4->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
            // set header and footer fonts
            $this->pdf_report4->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $this->pdf_report4->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
           /* $this->pdf_report2->setPrintHeader(false);
            $this->pdf_report2->setPrintFooter(false);*/
            // set default monospaced font
            $this->pdf_report4->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $this->pdf_report4->SetMargins(PDF_MARGIN_LEFT, 50, PDF_MARGIN_RIGHT,FALSE);
            $this->pdf_report4->SetHeaderMargin(PDF_MARGIN_HEADER);
            $this->pdf_report4->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $this->pdf_report4->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $this->pdf_report4->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf_report4->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set font
            $this->pdf_report4->SetFont('helvetica', '', 8);

            

            $html = '<html>
                        <table>
                            <th>
                                <td>NO</td>
                                <td>NRK</td>
                                <td>NAMA</td>
                                <td>KODE LOKASI</td>
                                <td>NAMA LOKASI</td>
                                <td>KODE JABATAN</td>
                                <td>NAMA JABATAN</td>
                                <td>ESELON</td>
                                <td>NESELON</td>
                                <td>KOPANG</td>
                            </th>';
                
                    foreach ($datapegawai as $row) 
                    {
            $html.='		<tr>
                                <td>'.$row->ROWNUM.'</td>
                                <td>'.$row->NRK.'</td>
                                <td>'.$row->NAMA.'</td>
                                <td>'.$row->KOLOK.'</td>
                                <td>'.$row->NALOKL.'</td>
                                <td>'.$row->KOJAB.'</td>
                                <td>'.$row->NAJABL.'</td>
                                <td>'.$row->ESELON.'</td>
                                <td>'.$row->NESELON.'</td>
                                <td>'.$row->KOPANG.'</td>
                            </tr>';          
                    } 
                    
            $html.='
                        </table>
                    </html>';

                  
            
            //$this->pdf_report4->AddPage();            
            $this->pdf_report4->writeHTML($html, true, false, true, false, '');
            //$this->pdf_report4->lastPage();
             ob_clean();          
            
            $this->pdf_report2->Output('datapegawai.pdf', 'I');

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

    

    

    public function dataListReport()
    {
        $requestData = $this->input->post();

        $columns = array(
            // datatable column index  => database column name
            0 => 'ROWNUM',
            1 => 'NRK',
            2 => 'NAMA',
            3 => 'NAJABL',
            4 => 'PATHIR',
            5 => 'TALHIR',
        );

        // getting total number records without any search
        $q = "SELECT
                    COUNT(NRK) AS jml
                FROM
                    PERS_PEGAWAI1";

        $rs = $this->db->query($q)->result();
        $totalData = $rs[0]->JML;




        //$wh_nrk = " AND PERS_PEGAWAI1.nrk='' ";
        //$wh_nrkp = "";
         $wh_filter="";
        
         $lengtharr=$requestData['arlength'];
        for($i=0;$i<$lengtharr;$i++)
        {
            $jns=$requestData['jenis'][$i];
            $tbx=$requestData['textbox'][$i];

            switch($jns)
            {
                case 'ESELON' : $wh_filter.="
                                    INNER JOIN(
                                    SELECT 
                                            A.NRK,MAX(B.TMT)
                                        FROM 
                                            PERS_PEGAWAI1 A
                                        LEFT JOIN 
                                            PERS_JABATAN_HIST B ON A.NRK=B.NRK
                                        WHERE A.KD='S' AND B.ESELON='$tbx'
                                        GROUP BY(A.NRK)
                                    ) C ON C.NRK=A.NRK
                                    ";
                break;

                case 'GOL': $wh_filter.=
                                    "INNER JOIN
                                    (
                                        SELECT
                                            DISTINCT A.NRK
                                        FROM
                                            PERS_PEGAWAI1 A
                                        LEFT JOIN 
                                            PERS_RB_GAPOK_HIST B ON A.NRK=B.NRK
                                        WHERE B.KOPANG = 
                                        (
                                            SELECT C.KOPANG FROM PERS_PANGKAT_TBL C
                                            WHERE C.GOL LIKE '$tbx'
                                        ) 
                                        ORDER BY A.NRK ASC
                                    ) D ON D.NRK=A.NRK
                                    ";
                break;

                case 'KOPANG' : $wh_filter.=
                                        "INNER JOIN
                                        (
                                            SELECT
                                                DISTINCT A.NRK,MAX(B.TMT)
                                            FROM
                                                PERS_PEGAWAI1 A
                                            LEFT JOIN 
                                                PERS_RB_GAPOK_HIST B ON A.NRK=B.NRK
                                            WHERE B.KOPANG = '$tbx'
                                            GROUP BY A.NRK
                                        ) E ON E.NRK=A.NRK
                                        ";
                break;

                case 'KOLOK' : $wh_filter.=
                                        "INNER JOIN
                                        (
                                            SELECT A.NRK
                                            FROM PERS_PEGAWAI1 A
                                            WHERE KOLOK='$tbx'
                                        ) F ON F.NRK=A.NRK
                                        ";
                break;

                case 'KOJAB' : $wh_filter.=
                                        "INNER JOIN
                                        (
                                            SELECT A.NRK
                                            FROM PERS_PEGAWAI1 A
                                            WHERE KOJAB='$tbx'
                                        ) G ON G.NRK=A.NRK
                                        ";
                break;

                case 'SPMU' : $wh_filter.=
                                        "INNER JOIN
                                        (
                                            SELECT A.NRK
                                            FROM PERS_PEGAWAI1 A
                                            WHERE SPMU='$tbx'
                                        ) H ON H.NRK=A.NRK
                                        ";
                break;

                case 'PENDIDIKAN' : $wh_filter.=
                                        "INNER JOIN
                                        (
                                            SELECT A.NRK,C.NADIK FROM PERS_PEGAWAI1 A
                                            LEFT JOIN PERS_PENDIDIKAN B ON A.NRK=B.NRK
                                            LEFT JOIN PERS_PDIDIKAN_TBL C ON B.KODIK=C.KODIK
                                            WHERE C.NADIK LIKE '%$tbx%'
                                        ) J ON J.NRK=A.NRK
                                        ";
                break;

                case 'JENKEL' : $wh_filter.=
                                        "INNER JOIN
                                        (
                                            SELECT * 
                                            FROM PERS_PEGAWAI1
                                            WHERE JENKEL = '$tbx'
                                        ) K ON K.NRK=A.NRK
                                        ";
                break;

                case 'STAWIN' : $wh_filter.=
                                        "INNER JOIN
                                        (
                                            SELECT A.* 
                                            FROM PERS_PEGAWAI1 A
                                            LEFT JOIN PERS_STAWIN_RPT B ON A.STAWIN=B.STAWIN
                                            WHERE B.KETERANGAN LIKE '%$tbx%'
                                        ) L ON L.NRK=A.NRK
                                        ";
                break;

                case 'AGAMA' : $wh_filter.=
                                        "INNER JOIN
                                        (
                                            SELECT A.* FROM PERS_PEGAWAI1 A
                                            LEFT JOIN PERS_AGAMA_RPT B ON A.AGAMA=B.AGAMA
                                            WHERE B.KETERANGAN LIKE '%$tbx%'
                                        ) M ON M.NRK=A.NRK
                                        ";
                break;

                case 'STAPEG' : $wh_filter.=
                                        "INNER JOIN
                                        (
                                            SELECT A.NRK,B.KETERANGAN AS KET_STAPEG FROM PERS_PEGAWAI1 A
                                            LEFT JOIN PERS_STAPEG_RPT B ON A.STAPEG=B.STAPEG
                                            WHERE B.KETERANGAN LIKE '%$tbx'
                                        ) N ON N.NRK=A.NRK
                                        ";
                break;

                case 'FLAG' : $wh_filter.=
                                        "INNER JOIN
                                        (
                                            SELECT * FROM PERS_PEGAWAI1 WHERE FLAG=$tbx
                                        ) O ON O.NRK=A.NRK
                                        ";
                break;

                default:
                $wh_filter="";
            }
        }
        

       
        


        $sql = "SELECT rownum, X.* FROM (
                SELECT rownum as rn,pers_kojab_tbl.najabl, A.nrk, A.nama,
                      A.pathir, TO_CHAR(A.talhir,'DD-MM-YYYY')AS TGL ";
        $sql .= " FROM PERS_PEGAWAI1 A LEFT OUTER JOIN
                              pers_kojab_tbl ON A.kolok = pers_kojab_tbl.kolok AND
                              A.kojab = pers_kojab_tbl.kojab
                    $wh_filter   
                ) X";
        //echo $sql;
        $query= $this->db->query($sql);
        $totalFiltered = $query->num_rows();
       // $temp =$requestData['start']+$requestData['length'];

        $sql.=" WHERE RN > ".$requestData['start']." AND RN <= ".$temp." AND ROWNUM <= ".$requestData['length']."";
        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
       
        $query= $this->db->query($sql);

        $data = array();

        $no_urut = $requestData['start']+1;
        foreach($query->result() as $row){
            $nestedData=array();
            $nestedData[] = $no_urut;
//            if ($row->X_PHOTO){
//                $nestedData[] = "<div class='form-group'>
//                              <div class='col-sm-12'>
//                                  <div class='row'>
//                                      <div class='col-sm-4' align='center'>
//                                          <img id='blah2' src='".site_url('pegawai/tampilPhoto/'.$row->NRK)."' width='120' height='150'/>
//                                      </div>
//                                  </div>
//                              </div>
//                          </div>
//                          ";
//            } else {
//                $nestedData[] = "";
//            }

            $nestedData[] = $row->NRK;
            $nestedData[] = $row->NAMA;
            $nestedData[] = $row->NAJABL;
            $nestedData[] = $row->PATHIR;
            $nestedData[] = $row->TGL;
            $nestedData[] = "<div class='form-group'>
                                <div class='col-sm-12'>
                                    <div class='row'>
                                        <div class='col-sm-6' align='center'>
                                            <form method='post' action='".site_url('pegawai/doview')."'>
                                                <input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
                                                <button class='btn btn-outline btn-xs btn-primary' data-toggle='tool-tip' data-placement='bottom' title='detail pegawai' type='submit' pull-right><i class='fa fa-bars'></i></button>
                                            </form>
                                        </div>
                                        <div class='col-sm-6' align='center'>
                                            <form method='post' action='".site_url('riwayat')."'>
                                                <input type='hidden' name='nrkP' id='nrkP' value='".$row->NRK."'>
                                                <button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' data-placement='bottom' title='riwayat pegawai' type='submit' pull-right><i class='fa fa-th-list'></i></button>
                                            </form>
                                        </div>

                                        
                                    </div>
                                </div>
                            </div>
                            ";

            $data[] = $nestedData;
            $no_urut++;
        }

        $json_data = array(
            "draw"            => intval( $requestData['draw'] ),
            "recordsTotal"    => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $data
        );

        echo json_encode($json_data);
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

}
