<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportk extends CI_Controller {

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
            $this->user['id']     	= $session_data['id'];
            $this->user['username']  	= $session_data['username'];
            $this->user['user_group']     = $session_data['user_group'];
        }else{
			redirect(base_url().'index.php/login', 'refresh');
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
			$this->load->view('report_v',$data);
            //$this->load->view('admin/pegawai_list',$data);
			$this->load->view('head/footer');

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
        $datam['inisial'] = 'report';
        // END Inisial Active Menu
        $data['nrk'] = $nrk;
        $datam['nrk'] = $nrk;
        $datam['user_group'] = $this->user['user_group'];

        $data['x'] = "";

        $this->load->view('head/header',$this->user);
        $this->load->view('head/menu',$datam);
        $this->load->view('laporank',$data);
        $this->load->view('head/footer');

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
        $this->load->model('mreportk','report');
        if($this->input->post()){
            $post = $this->input->post();
            $uniquepost = array_unique($post['jenis']);
            $uniquepostreset = array_values($uniquepost);

            $query = "V1";
            if(in_array('NADIK', $uniquepostreset) && in_array('FASILITAS', $uniquepostreset)){
                $query = "V2";
            }elseif (in_array('NADIK', $uniquepostreset)) {
                $query = "V3";
            }elseif (in_array('FASILITAS', $uniquepostreset)) {
                $query = "V4";
            }else{
                $query = "V1";
            }

            // echo "COUNTER ".count($uniquepostreset);
            // echo "<pre>";
            // print_r($uniquepostreset);
            // echo "</pre>";
            // exit();

            $where  = "1=1 ";
            for ($i=0; $i < count($uniquepostreset); $i++) {
                $filter = $uniquepostreset[$i];

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
                        $counter = count($post['pangkat']);
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {

                                if($post['pangkat'][$j] == ""){
                                    if(isset($post['pangkat'][$j+1])){
                                        if($post['pangkat'][$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "KOPANG = '".$post['pangkat'][$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($post['pangkat'][$j+1])){
                                            if($post['pangkat'][$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }

                                    }
                                }
                            }
                            $where .= ")";
                        }else{
                            $where .= "KOPANG = '".$post['pangkat'][0]."'";
                        }
                        break;
                    case 'KOLOK':
                        $counter = count($post['kolok']);
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {

                                if($post['kolok'][$j] == ""){
                                    if(isset($post['kolok'][$j+1])){
                                        if($post['kolok'][$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "KOLOK = '".$post['kolok'][$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($post['kolok'][$j+1])){
                                            if($post['kolok'][$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }

                                    }
                                }
                            }
                            $where .= ")";
                        }else{
                            $where .= "KOLOK = '".$post['kolok'][0]."'";
                        }
                        break;
                    case 'KOJAB':
                        $counter = count($post['jabatan']);
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {

                                if($post['jabatan'][$j] == ""){
                                    if(isset($post['jabatan'][$j+1])){
                                        if($post['jabatan'][$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "PEGAWAI.KOJAB = '".$post['jabatan'][$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($post['jabatan'][$j+1])){
                                            if($post['jabatan'][$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }

                                    }
                                }
                            }
                            $where .= ")";
                        }else{
                            $where .= "PEGAWAI.KOJAB = '".$post['jabatan'][0]."'";
                        }
                        break;
                    case 'JENKEL':
                        $counter = count($post['jeniskelamin']);
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {

                                if($post['jeniskelamin'][$j] == ""){
                                    if(isset($post['jeniskelamin'][$j+1])){
                                        if($post['jeniskelamin'][$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "JENKEL = '".$post['jeniskelamin'][$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($post['jeniskelamin'][$j+1])){
                                            if($post['jeniskelamin'][$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }

                                    }
                                }
                            }
                            $where .= ")";
                        }else{
                            $where .= "JENKEL = '".$post['jeniskelamin'][0]."'";
                        }
                        break;
                    case 'KAWIN':
                        $counter = count($post['statuskawin']);
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {

                                if($post['statuskawin'][$j] == ""){
                                    if(isset($post['statuskawin'][$j+1])){
                                        if($post['statuskawin'][$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "STAWIN = '".$post['statuskawin'][$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($post['statuskawin'][$j+1])){
                                            if($post['statuskawin'][$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }

                                    }
                                }
                            }
                            $where .= ")";
                        }else{
                            $where .= "STAWIN = '".$post['statuskawin'][0]."'";
                        }
                        break;
                    case 'AGAMA':
                        $counter = count($post['agama']);
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {

                                if($post['agama'][$j] == ""){
                                    if(isset($post['agama'][$j+1])){
                                        if($post['agama'][$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "AGAMA = '".$post['agama'][$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($post['agama'][$j+1])){
                                            if($post['agama'][$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }

                                    }
                                }
                            }
                            $where .= ")";
                        }else{
                            $where .= "AGAMA = '".$post['agama'][0]."'";
                        }
                        break;
                    case 'STAPEG':
                        $counter = count($post['stapeg']);
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {

                                if($post['stapeg'][$j] == ""){
                                    if(isset($post['stapeg'][$j+1])){
                                        if($post['stapeg'][$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "STAPEG = '".$post['stapeg'][$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($post['stapeg'][$j+1])){
                                            if($post['stapeg'][$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }

                                    }
                                }
                            }
                            $where .= ")";
                        }else{
                            $where .= "STAPEG = '".$post['stapeg'][0]."'";
                        }
                        break;
                    case 'FLAG':
                        $counter = count($post['statusaktif']);
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {

                                if($post['statusaktif'][$j] == ""){
                                    if(isset($post['statusaktif'][$j+1])){
                                        if($post['statusaktif'][$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "FLAG = '".$post['statusaktif'][$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($post['statusaktif'][$j+1])){
                                            if($post['statusaktif'][$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }

                                    }
                                }
                            }
                            $where .= ")";
                        }else{
                            $where .= "FLAG = '".$post['statusaktif'][0]."'";
                        }
                        break;
                    case 'NADIK':
                        $counter = count($post['jendik']);
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {

                                if($post['jendik'][$j] == ""){
                                    if(isset($post['jendik'][$j+1])){
                                        if($post['jendik'][$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "UNIVER = '".$post['jendik'][$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($post['jendik'][$j+1])){
                                            if($post['jendik'][$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }

                                    }
                                }
                            }
                            $where .= ")";
                        }else{
                            $where .= "UNIVER = '".$post['jendik'][0]."'";
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
                        $counter = count($post['hukdis']);
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {

                                if($post['hukdis'][$j] == ""){
                                    if(isset($post['hukdis'][$j+1])){
                                        if($post['hukdis'][$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "JENHUKDIS = '".$post['hukdis'][$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($post['hukdis'][$j+1])){
                                            if($post['hukdis'][$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }

                                    }
                                }
                            }
                            $where .= ")";
                        }else{
                            $where .= "JENHUKDIS = '".$post['hukdis'][0]."'";
                        }
                        break;
                    case 'USIA':
                        $counter = count($post['usia']);
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
                        break;
                    case 'FASILITAS':
                        $counter = count($post['jenfas']);
                        $mincounter = $counter-1;
                        $where .= " AND ";
                        if($counter > 1){
                            $where .= "(";
                            for ($j=0; $j < $counter; $j++) {

                                if($post['jenfas'][$j] == ""){
                                    if(isset($post['jenfas'][$j+1])){
                                        if($post['jenfas'][$j+1] != ""){
                                            $where .= " OR ";
                                        }
                                    }
                                    continue;
                                }else{
                                    $where .= "JENFAS = '".$post['jenfas'][$j]."'";
                                    if ($j < $mincounter) {
                                        if(isset($post['jenfas'][$j+1])){
                                            if($post['jenfas'][$j+1] != ""){
                                                $where .= " OR ";
                                            }
                                        }

                                    }
                                }
                            }
                            $where .= ")";
                        }else{
                            $where .= "JENFAS = '".$post['jenfas'][0]."'";
                        }
                        break;
                    default:

                        break;
                }
            }

            if($query == "V1"){
                $datapegawai = $this->report->getDataPegawaiTes($where);
            }elseif($query == "V2"){
                //Ada penambahan pendidikan
                $datapegawai = $this->report->getDataPegawaiV2($where,'nadik','jenfas');
            }elseif ($query == "V3") {
                //Ada penambahan pendidikan
                $datapegawai = $this->report->getDataPegawaiV2($where,'nadik','');
            }elseif ($query == "V4") {
                //Ada penambahan pendidikan
                $datapegawai = $this->report->getDataPegawaiV2($where,'','jenfas');
            }else{
                $datapegawai = $this->report->getDataPegawai($where);
            }

            $response = array('response' => 'SUKSES', 'datapegawai' => $datapegawai);
        }else{
            $response = array('response' => 'GAGAL');
        }

        echo json_encode($response);

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
                                            A.NRK
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
        $temp =$requestData['start']+$requestData['length'];

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
                                            <form method='post' action='".site_url('riwayat')."'>
                                                <input type='hidden' name='nrkP' id='nrkP' value='".$row->NRK."'>
                                                <button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' data-placement='bottom' title='detail pegawai' type='submit' pull-right><i class='fa fa-th-list'></i></button>
                                            </form>
                                        </div>

                                        <div class='col-sm-6' align='center'>
                                            <form method='post' action='".site_url('pegawai/doview')."'>
                                                <input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
                                                <button class='btn btn-outline btn-xs btn-primary' data-toggle='tool-tip' data-placement='bottom' title='riwayat pegawai' type='submit' pull-right><i class='fa fa-bars'></i></button>
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
