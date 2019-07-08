<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skpd extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
        $this->load->helper(array('form', 'url'));    	
    	$this->load->library('session');
        
    	$this->load->model('mhome','home');
        $this->load->library('infopegawai');
        $this->load->library('convert');
        $this->load->model('mskpd','skpd');

    	if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']     	= $session_data['id'];
            $this->user['username']  	= $session_data['username'];
            $this->user['user_group']     = $session_data['user_group'];
        }else{
			redirect(base_url().'login', 'refresh');
		}	    
   	}

    public function index()
    {

		//~ var_dump($_SESSION['logged_in']['id']);exit;
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
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'skpd',0);
                $datam['inisial'] = 'skpddb';
                
    
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
           
            $data['jumlah_permohonan'] = $this->skpd->count_data(2);
            $data['jumlah_permohonan_terima'] = $this->skpd->count_data(1);
            $data['jumlah_permohonan_tolak'] = $this->skpd->count_data(3);
			//~ var_dump($data);exit;	
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('dashboard_skpd',$data);
            $this->load->view('head/footer');

    }

    public function permohonan()
    {
        // $data['jenis_permohonan'] = $this->permohonan->get_jenis_permohonan($post['REF_PERMOHONAN']);
        // $data['jenis_permohonan'] = $this->permohonan->get_jenis_permohonan();
        /*$data['all_data'] = $this->skpd->get_all_data();*/
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
                //$datam['activeMenu'] = "4168";
                //$datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'skpdprm',0);

                $datam['activeMenu'] = "3762";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'skpd',0);
           

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
            
            $data['ref_permohonan'] = $this->skpd->get_permohonan();
            $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan();
            $data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            $data['ref_kojabf'] = $this->skpd->get_jabfung();

            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vskpd',$data);
            $this->load->view('head/footer');

    }

	public function check_skpd(){
		$sql = 'SELECT * FROM PERS_TRX_TOLAK';
		//~ $sql = 'SELECT * FROM PERS_KLOGAD3 WHERE ROWNUM = 1';
		//~ $sql = 'SELECT * FROM "master_user" WHERE "user_id" = \'1.20.004\'';
		//~ $sql = 'SELECT * FROM PERS_TRX_AJU';
		//~ $sql2 = 'SELECT * FROM PERS_KLOGAD3 WHERE KOLOK = 000000102';
		//~ $sql = 'DELETE FROM "master_user" WHERE "user_group_id" = 5 AND "user_id" NOT IN(\'skpd\')';
		//~ $sql = 'SELECT * FROM "master_user" WHERE "user_id" = \'1.20.004 \'';
		//~ echo $sql;
		//~ $res = $this->db->query($sql);
		$res = $this->db->query($sql)->result();
		//~ $res_2 = $this->db->query($sql2)->result();
		var_dump($res);
		//~ var_dump($res_2);
	}

	public function get_spmu(){
		return @$this->skpd->get_spmu();
	}

    public function insert_new_skpd(){
		$password = md5('123456');
        $file = file(base_url('assets/skpd.txt'));
        for($i = 0; $i < count($file); $i++){
			$number = rand(0,10);
			$content[] = explode('|',$file[$i]);
			$sql = 'INSERT INTO "master_user" ("user_id", "user_password", "user_name", "user_level", "user_enable", "user_group_id") values (\''.preg_replace('/\s\s+/', '', $content[$i][2]).'\',\''.$password.'\',\''.$content[$i][1].'\',\''.$number.'\',\'t\',5)';
			echo $sql;
			$this->db->query($sql);
		}
    }

    public function filter_function(){
        $filter = $this->skpd->get_all_data_by_filter();
        echo $filter;
    }

    //datatable untuk list permohonan
    public function get_data_table(){
        $list_permohonan = $this->skpd->get_all_data();
        // var_dump($list_permohonan);exit;
        echo $list_permohonan;
    }

    //datatable untuk list permohonan diterima
    public function get_data_table_terima(){
        $list_permohonan = $this->skpd->get_all_data_terima();
        // var_dump($list_permohonan);exit;
        echo $list_permohonan;
    }

    public function get_data_table_tolak(){
        $list_permohonan = $this->skpd->get_all_data_tolak();
        // var_dump($list_permohonan);exit;
        echo $list_permohonan;
    }     

	public function idx_2()
	{  
            // $post = $this->input->post();
            // $data['ref_permohonan'] = $post['REF_PERMOHONAN'];
            // $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan($post['REF_PERMOHONAN']);
            $data['ref_permohonan'] = $this->skpd->get_permohonan();
            $data['jenis_permohonan'] = $this->skpd->get_jenis_permohonan();
            $data['gol_pegawai'] = $this->skpd->get_gol_pegawai();
            $data['ref_kojabf'] = $this->skpd->get_kojabf();
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
                $datam['activeMenu'] = "3762";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'skpd',0);
                //$datam['inisial'] = 'skpdpermohonan';

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
            
            /*$this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);*/
            $this->load->view('vskpd',$data);
            /*$this->load->view('head/footer');*/

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
              $datam['activeMenu'] = "3762";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'skpd',0);
                
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
            $this->load->view('vskpd_terima',$data);
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
              $datam['activeMenu'] = "3762";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'skpd',0);
                
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
            $this->load->view('vskpd_tolak',$data);
            $this->load->view('head/footer');
    }

    public function get_permohonan(){
        $result = $this->skpd->get_permohonan();
        echo $result;
    }

    public function permohonan_baru()
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
                $datam['activeMenu'] = "3762";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'skpd',0);


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
            
   
            //$data['data_permohonan'] = $this->permohonan->get_permohonan();

            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('list_permohonan',$data);
            //$this->load->view('admin/pegawai_list',$data);
            $this->load->view('head/footer');
    }

    public function get_list_permohonan_baru(){
        $result = $this->skpd->get_list_permohonan_baru_();
        echo $result;
    }

    public function get_data_permohonan(){
        
        //$this->load->model('mskpdpermohonan');
        $table_name = '';
        $post = $this->input->post(array('jenis', 'no_surat', 'tgl_surat', 'nrk'));
      
        if(!empty($post['jenis']) || !empty($post['no_surat']) || !empty($post['tgl_surat']) || !empty($post['nrk'])){
            $data =  array('no_surat' => $post['no_surat'], 'tgl_surat' => $post['tgl_surat'], 'nrk' => $post['nrk']);
            
            if($post['jenis'] == 1){
                $table_name = 'PERS_ANGKAT_DLM_JABFUNG';
                $result = $this->skpd->get_data($data, $table_name);
            }elseif($post['jenis'] == 2){
                $table_name = 'PERS_BBS_SMTR_JABFUNG';
                $result = $this->skpd->get_data($data, $table_name);
            }elseif($post['jenis'] == 3){
                $table_name = 'PERS_ANGKAT_KBL_JABFUNG';
                $result = $this->skpd->get_data($data, $table_name);
            }
            
            $json_result = json_encode($result);
            echo $json_result;
        }
            
    }

    public function create_dir_skpd($nrk){
        //$remove_white_spaces = str_replace(' ', '_', $post['currentDate']);
		//$uploads_dir = 'assets/file_permohonan/'.$post['nrk'].'/'.$remove_white_spaces;
        $uploads_dir = 'assets/file_permohonan/'.$nrk;
		if(file_exists($uploads_dir)){
			return false;
			exit;
		}else{
			mkdir($uploads_dir, 0777);
            return $uploads_dir;
		}
	}
    
    public function upload_from_skpd($init_syarat, $nrk = null){
        $result = $this->create_dir_skpd($nrk);
        $tmp_file = pathinfo($_FILES['file']['name']);
        $filename = $nrk.'@'.$init_syarat.'.'.$tmp_file['extension'];
        
        $uploads_dir = 'assets/file_permohonan/'.$nrk;
        
        $tmp_name = $_FILES["file"]["tmp_name"];
        move_uploaded_file($tmp_name, $uploads_dir.'/'.$filename);
        echo $filename;
    }

    public function check_file_from_skpd(){
        //~exec('ls -la assets/file_permohonan/ 2>&1', $output);
        //~var_dump(getcwd());exit;
        //var_dump($output);exit;
        $post = $this->input->post();
        //~$remove_white_spaces = str_replace(' ', '_', $post['currentDate']);
        $check = glob('assets/file_permohonan/'.$post['nrk'].'/*-'.$post['nrk'].'@'.$post['init_syarat'].'*');
        //~var_dump(count($check));exit;
        if(!$check[0]){
            exit;
        }else{
            list($parent_dir, $sub_dir, $sub_dir_nrk, $filename) = explode("/",$check[0]);
            list($file, $format) = explode(".",$filename);
            date_default_timezone_set('Asia/Jakarta');
            $date = date('dmYhis', time());
            $file = $date."-".$filename;
            $rename = rename("{$check[0]}","assets/file_permohonan/{$post['nrk']}/{$file}");
            echo $rename;
        }
        //$result = $this->create_dir_skpd();
        //var_dump('mv '.$post['nrk'].'@'.$post['init_syarat'].'* /usr/share/nginx/html/ci_ekepeg/'.$result);exit;
        //$file = 'assets/file_permohonan/'.$post['nrk'].'/'.$post['nrk'].'@'.$post['init_syarat'].'*';
        //~$test = array_map('unlink', glob($mask));
        //$test = glob('assets/file_permohonan/'.$post['nrk'].'/'.$post['nrk'].'@'.$post['init_syarat'].'*');
        //$uploads_dir = 'assets/file_permohonan/'.$post['nrk'];
		//~$check_file = glob($uploads_dir."/*");
		//~echo json_encode($check_file);
        //~var_dump($test);exit;
    }
    
    public function update_keterangan_file(){
		$post = $this->input->post();
        $result = $this->skpd->updateKeteranganFile($post['file_syarat'], $post['id_trx'], $post['id_syarat']);
        echo $result;
		//var_dump($post);exit;
	}

    public function listPegawai()
    {
        $tgl_sekarang = date("Y-m-d");
        $tgl = date('Y-m-d', strtotime($tgl_sekarang));
        $tglproses = date('Y-m-d', strtotime($tgl_sekarang));
        $koloks = $this->mdl->getKolok();
  
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

    //untuk modal pegawai
 	public function getListPegawai()
    {
        if($this->input->post()){
            $post = $this->input->post();
            // var_dump($post);exit;
            $datapegawai = $this->skpd->getpgw($post['KOPANG'],$post['PERMOHONAN'].$post['JENIS']);

            $response = array('response' => 'SUKSES', 'datapegawai' => $datapegawai);
        }else{
            $response = array('response' => 'GAGAL');
        }
	}
	//untuk datatable page
    public function get_list_pegawai_wip(){
        $parameter = $this->input->post('NRK');
        $post = $this->input->post();
       
        $result = $this->skpd->getpgwwip($parameter,$post['PERMOHONAN'],$post['JENIS']);
        echo $result;        
    }
    
    public function get_jenis_permohonan($parameter){
        // $parameter = $this->input->post('REF_PERMOHONAN');
        $result = $this->skpd->get_jenis_permohonan($parameter);
        return $result;     
    }

    public function get_persyaratan(){
        // $prm = $this->input->post();
        $result = $this->skpd->get_persyaratan_model();
 
        echo $result;
    }

    public function lihat_persyaratan()
    {
        $result = $this->skpd->lihat_persyaratan_trx();
        echo $result;
    }

    public function getDataTrxDtl(){
        $result = $this->skpd->dataTrxDtl();

        echo $result;
    }

    public function get_permohonan_(){
        $parameter = $this->input->post('REF_PERMOHONAN');
        $test = $this->get_jenis_permohonan($parameter);
        echo $test;
        
    }

    public function get_detail_pegawai(){
        $prm = $this->input->post('nrk');
        $result = $this->skpd->get_detail_pegawai($prm);
        echo $result;
    }

    public function verifikasi(){
        $prm = $this->input->post('nrk');
        $result = $this->skpd->verifikasi_file($prm);
        echo $result;
    }

    public function simpan_data(){
        $prm = $this->input->post();
        // var_dump($prm);exit;
        $result = $this->skpd->simpan_data($prm);
    }

    /*public function terima(){
        $prm = $this->input->post();
        var_dump($prm);exit;
        // $format = 'Y-m-d H:i:s';
        // $tgl = DateTime::createFromFormat('d-m-Y', $prm['TGL_SURAT_SKPD']);
        //var_dump($tgl);
        // $tgl_fix = $tgl->format('Y-m-d H:i:s');
        $datetime = date('Y-m-d H:i:s');
        $data = array('TGL_TOLAK' => $datetime, 'KETERANGAN' => $prm['keterangan']);
        
        $result = $this->skpd->insert_data($data);
        echo $result;
    }*/

    public function tolak(){
        $prm = $this->input->post();
        $datetime = date('Y-m-d H:i:s');
        // $data = array('TGL_TOLAK' => $datetime, 'KETERANGAN' => $prm['KETERANGAN']);
        
        $result = $this->skpd->tolak_data(array('id_trx'=>$prm['ID_TRX'], 'tgl_tolak'=>$datetime, 'keterangan'=>$prm['KETERANGAN']));
        echo $result;
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
