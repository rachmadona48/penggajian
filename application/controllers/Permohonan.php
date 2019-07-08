<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permohonan extends CI_Controller {

    private $user=array();

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));      
        $this->load->library('session');
        
        $this->load->model('mhome','home');
        $this->load->library('infopegawai');
        $this->load->library('convert');
        $this->load->model('admin/v_pegawai','mdl');
        $this->load->model('mpermohonan','permohonan');

        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']       = $session_data['id'];
            $this->user['username']     = $session_data['username'];
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
                    
                    if($this->user['user_group'] == 1){
                        $nrk = $nrk;

                    }

                }                                            
            // END GET NRK
                
                $datam['activeMenu'] = "3765";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'permohonan',0);
                //$datam['inisial'] = 'skpdjabfung';
                
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
            // var_dump($this->permohonan->get_permohonan(TRUE));exit;
            $data['ref_permohonan'] = $this->permohonan->get_permohonan();
            $this->permohonan->get_sop();

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
            

            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu',$datam);
            $this->load->view('vindexpermohonan',$data);
            $this->load->view('head/footer');
    }

    public function idx_2()
    {
        $data['spmu_user'] = $this->permohonan->get_spmu_pegawai();
        // var_dump($_SESSION['logged_in']);exit;
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
                $datam['activeMenu'] = "3765";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'permohonan',0);
                $datam['inisial'] = 'skpdpermohonan';
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL


            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)
            $data['linkaction'] = site_url('Permohonan/doaddaction');

            $data['ref_permohonan'] = $post['REF_PERMOHONAN'];
            
            $data['jenis_permohonan'] = $this->permohonan->get_jenis_permohonan($post['REF_PERMOHONAN'], $this->check_user());
            
            //get jabfung dropdown
            $data['ref_kojabf'] = "";
            //$data['ref_kojabf'] = $this->get_jabfung_dropdown();
            
            // var_dump($data['ref_kojabf']);exit;
            $data_bebas_smntr = function(){
                return "
                    <option value='1'>Tidak memenuhi angka kredit</option>
                    <option value='2'>Dijatuhi hukuman disiplin tingkat sedang atau berat</option>
                    <option value='3'>Diberhentikan semenetara sebagai PNS</option>
                    <option value='4'>Ditugaskan secara penuh di luar jabatan fungsional</option>
                    <option value='5'>Menjalani cuti di luar tanggungan negara</option>
                    <option value='6'>Menjalani tugas belajar lebih dari 6 bulan</option>";
            };
            $data['alasan_bbs_smntr'] = $data_bebas_smntr();
            // var_dump($data_bebas_smntr());exit;
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
            // var_dump($post['id_sop']);exit;
            // $data['id_sop'] = $this->permohonan->get_jabfung();
            $this->load->view('vpermohonan',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');

    }

    public function get_jabfung_dropdown($echo = null)
    {
        $data = $this->permohonan->get_jabfung();
        if(is_null($echo)){
            return $data;    
        }else{
            echo $data;
        }
    }

    public function get_jabfung_inpassing($echo = null)
    {
        $data = $this->permohonan->get_jabfunginpassing();
        if(is_null($echo)){
            return $data;    
        }else{
            echo $data;
        }
    }
    
    public function get_jabfungpertama($echo = null)
    {
        $data = $this->permohonan->get_jabfungpertama();
        if(is_null($echo)){
            return $data;    
        }else{
            echo $data;
        }
    }
    

    public function check_user()
    {
        // if(!empty($post)){
            $res = $this->permohonan->check_jabatanf_hist($this->session->userdata('logged_in')['nrk']);
            if( (int) $res->RES == 0 ){
                return TRUE;
            }
            return FALSE;
        // }
    }
    
    public function index_backup()
    {
            // START GET NRK                
                if(isset($_POST['nrk'])){
                    $nrk = $_POST['nrk'];
                }elseif(isset($_POST['nrkP'])){ //Pencarian NRK Untuk Admin/BKD
                    $nrk = $_POST['nrkP'];                    
                }else{
                    $nrk = $this->user['id'];
                    
                    if($this->user['user_group'] == 1){
                        $nrk = $nrk;

                    }

                }                                            
            // END GET NRK
                
                $datam['activeMenu'] = "3765";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'permohonan',0);
                //$datam['inisial'] = 'skpdjabfung';
                
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

            $data['ref_permohonan'] = $this->permohonan->get_permohonan();

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
            
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu',$datam);
            $this->load->view('vindexpermohonan_backup',$data);
            $this->load->view('head/footer');
    }

    public function idx_2_backup()
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
                $datam['activeMenu'] = "3765";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'permohonan',0);
                $datam['inisial'] = 'skpdpermohonan';
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL


            // START MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)            
            if(isset($_POST['datapokok'])){
                $data['showBackPokok'] = '';
                $data['spmu'] = $_POST['spmu'];
            }
            // END MEMUNCULKAN TOMBOL BACK KE DATAPOKOK (HISDUK)
            $data['linkaction'] = site_url('Permohonan/doaddaction');

            $data['ref_permohonan'] = $post['REF_PERMOHONAN'];
            $data['jenis_permohonan'] = $this->permohonan->get_jenis_permohonan($post['REF_PERMOHONAN']);
            $data['ref_kojabf'] = $this->permohonan->get_jabfung();
            
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
            
            $this->load->view('vpermohonan_backup',$data);
            //$this->load->view('admin/pegawai_list',$data);
            // $this->load->view('head/footer');

    }

	public function insert_new_kojab($filename = NULL){
		if($filename){
//			$sql = "SELECT * FROM PERS_MASTER_KOJABF WHERE NAJABL LIKE 'GURU%'";
//			var_dump($this->db->query($sql)->result());exit;
			$file = file(base_url('assets/kojablagi-'.$filename.'.csv'));
			for($i = 0; $i < count($file); $i++){
				$content[] = explode(',',$file[$i]);
				$jenjab = function($this){
					return (int)$this;
				};
				$sql = "INSERT INTO PERS_MASTER_KOJABF (KOJAB,NAJABL,TINGKAT,JENJAB,GOLRU,USIA_PENSIUN,USIA_PENGANGKATAN,BUP_X,BUP_XX) VALUES ('{$content[$i][0]}', '{$content[$i][1]}', '{$content[$i][2]}', '".($filename == 'guru' ? $jenjab($content[$i][4]) : $content[$i][4])."', '{$content[$i][4]}', '{$content[$i][5]}', '{$content[$i][5]}', '{$content[$i][6]}', '".str_replace(" ","",(int)$content[$i][7])."')";
				echo $sql;
				$this->db->query($sql);
			}
		}
	}
    
    public function check_permohonan(){
        $nrk = $_SESSION['logged_in']['id'];
        $sql = "SELECT STATUS_AKHIR FROM PERS_TRX_AJU WHERE NRK = {$nrk} AND STATUS_AKHIR IS NULL";
        // var_dump($sql);exit;
        $res = $this->db->query($sql);
        // var_dump($res->row());exit;
        // var_dump($res->row()->STATUS_AKHIR);exit;
        if($res->row())
            if($res->row()->STATUS_AKHIR == NULL):
                echo json_encode('Error');
            else:
                echo json_encode('Good to go!');
            endif;
    }
    
    public function get_data_for_tab(){
        $post = $this->input->post();
        // var_dump($post);exit;
        $res = $this->permohonan->for_tab_permohonan($post['id_jenis_permohonan'], $post['id_permohonan'], $post['id_kojabf']);
        echo $res;
    }
    
    public function load_data_first(){
        $post = $this->input->post();
        $res = $this->permohonan->for_permohonan($post['id_kojabf'], $post['id_permohonan'], $post['id_jenis_permohonan']);
        echo json_encode($res);
    }
    
    public function create_dir(){
        $uploads_dir = 'assets/file_permohonan/'.$_SESSION['logged_in']['id'];
        if(file_exists($uploads_dir)){
            return false;
            exit;
        }else{
            mkdir($uploads_dir, 0777);
        }
    }
    
    public function get_init_syarat($jenis_permohonan, $permohonan, $id_kojabf){
        $res = $this->permohonan->check_file_from_server($jenis_permohonan, $permohonan, $id_kojabf);
        return $res;
    }
    
    public function verify_from_server($jenis_permohonan, $permohonan, $id_kojabf){
        $res = $this->permohonan->check_file_from_server($jenis_permohonan, $permohonan, $id_kojabf);
        $nrk = $_SESSION['logged_in']['id'];
        $dir = 'assets/file_permohonan/'.$nrk;
        $value = '';
        foreach($res->result() as $row){
            if(glob($dir.'/'.$nrk.'@'.$row->INIT_SYARAT.'.*')){
                $value .= 'True<br/>';
            }else{
                $value .= 'False<br/>';
            }
        }
        echo json_encode($value);
    }
    
    public function check_if_file_exists(){
        $post = $this->input->post();
        // var_dump($post);exit;
        $res = $this->get_init_syarat($post['id_jenis_permohonan'], $post['id_permohonan'], $post['id_kojabf']);
        //~$init_syarat = array();
        //~$x = 0;
        //~foreach($res->result() as $row){
            //~$init_syarat[$x++] = $row->INIT_SYARAT;
        //~}
        //~var_dump($init_syarat);exit;
        $nrk = $_SESSION['logged_in']['id'];
        $uploads_dir = 'assets/file_permohonan/'.$nrk;
        $check_file = glob($uploads_dir."/*");
        echo json_encode($check_file);
        //~var_dump(glob($uploads_dir."/".$nrk.'_'.$init_syarat[0].'.*'));exit;
        //~$check_file = array();
        //~for($i=0; $i < count($init_syarat); $i++){
            //~$filename = $nrk.'_'.$init_syarat[$i].'.*';
            //~$check_file = glob($uploads_dir."/".$nrk.'_'.$init_syarat[$i].'.*');
            //~var_dump(glob($uploads_dir."/".$filename));
            //~$test = array_filter($check_file);
            //~if(empty($test)){
                //~echo 'None';
            //~}else{
                //~print_r($check_file);
                //~echo $check_file[$i].'|';
            //~}
        //~}
    }
    
    public function del_file($init_syarat = null){
        $post = $this->input->post();
        $nrk = $_SESSION['logged_in']['id'];
        $uploads_dir = 'assets/file_permohonan/'.$nrk;
        $check_file = glob($uploads_dir."/".$nrk."@".$post['init_syarat']."*");
        //$check_file = glob($uploads_dir."/".$nrk."@".$init_syarat."*");
        // print_r($check_file);exit;
        $count = count($check_file) - 1;
        for($x=0; $x<=$count; $x++){
            unlink($check_file[$x++]);
        }
        $last_check_file = count(glob($uploads_dir."/".$nrk."@".$post['init_syarat']."*"));
        //$last_check_file = count(glob($uploads_dir."/".$nrk."@".$init_syarat."*"));
        echo $last_check_file;
    }
    
    public function insert_to_db(){
        // var_dump($this->db->query('SELECT * FROM PERS_TRX_AJU')->result());exit;
        // var_dump($_SESSION['logged_in']['kopang']);exit;
        // var_dump($this->input->post());exit;
        $session_data       = $this->session->userdata('logged_in');
        $this->user['id']   = $session_data['id'];
        $nrk = $this->user['id'];

        $id_jenis_permohonan = $this->input->post('id_jenis_permohonan');
        $id_permohonan = $this->input->post('id_permohonan');
        $id_kojabf = $this->input->post('id_kojabf');
        $golru_kojabf = $this->input->post('golru_kojabf');
        $cek_jenjab = $this->permohonan->ambil_jenjab($id_kojabf);
        $jenjab = $cek_jenjab->JENJAB;
        //$id_sop = $cek_jenjab->ID_SOP;
        $id_sop = $this->input->post('id_sop');

        $res_riwayat_user = $this->db->query("SELECT kd FROM PERS_PEGAWAI1 WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
        $check_jabatanf_hist = $this->db->query("SELECT DISTINCT COUNT(*) AS jbtn FROM PERS_JABATANF_HIST WHERE NRK = '{$_SESSION['logged_in']['nrk']}'  ORDER BY TMT DESC")->row();
        // var_dump($check_jabatanf_hist);exit;

        $insert = function(){
            $post = $this->input->post();
            $res = $this->get_init_syarat($post['id_jenis_permohonan'], $post['id_permohonan'], $post['id_kojabf']);
            $cek_detailSOP = $this->permohonan->detail_sop($post['id_sop']);
            $id_detail_sop = $cek_detailSOP->ID;
            // var_dump($res);exit;
            $nrk = $_SESSION['logged_in']['id'];
            $init_syarat = array();
            $id_syarat = array();
            $x = 0;
            foreach($res->result() as $row){
                $init_syarat[$x++] = $row->INIT_SYARAT;
                $id_syarat[] = $row->ID_SYARAT_DTL;
            }
            $dir = array_slice(scandir("assets/file_permohonan/".$nrk."/"), 2);
            $id_trx = $this->permohonan->insertMasterPermohonan(array('nrk'=>$nrk, 'jenis'=>$post['id_jenis_permohonan'], 'permohonan'=>$post['id_permohonan'], 'id_kojabf'=>$post['id_kojabf'], 'id_sop'=>$post['id_sop'], 'id_detail_sop'=>$id_detail_sop, 'bbs_smntr'=>$post['alasan_bbs_smntr'], 'spmu_user' => $post['spmu_user']));
            for($i=0; $i < count($id_syarat); $i++){
                $path[] = pathinfo($dir[$i]);
                $filename[] = $nrk."@".$init_syarat[$i].".".$path[$i]['extension'];
                $this->permohonan->insertPermohonan($id_syarat[$i], $filename[$i]);
                //~echo $nrk."@".$init_syarat[$i];
            }
        };

        $bup_fix = function($bup){
            if($bup <= 0){
                return ( - ($bup));
            }else{
                return $bup;
            }
        };

        // var_dump($bup_fix());exit;

        $cek_usiaPegawai = $this->permohonan->usia_pegawai($nrk);
        $usia_pgw = $cek_usiaPegawai->USIA;
        if(($_SESSION['logged_in']['kopang'] <> $golru_kojabf)){
            if($res_riwayat_user->KD == "S" && $check_jabatanf_hist->JBTN == 0){
                $cek_u_pengangkatan = $this->permohonan->usia_pengangkatan($id_kojabf,$golru_kojabf);
                $u_pengangkatan = $cek_u_pengangkatan->USIA_PENGANGKATAN;    
                $bup_x = $cek_u_pengangkatan->BUP_X;
                // var_dump($bup_x);exit;
                // var_dump($bup_fix($bup_x));exit;
                // $bup_fix = (- ($bup_x));
                // var_dump($usia_pgw);exit;
                // echo  $usia_pgw;
                // var_dump($u_pengangkatan);
                // var_dump(substr($bup_x, 0, 2));exit;
                if($bup_x > 0){
                    $rumus = $usia_pgw - $bup_x;
                    if($rumus < 0){
                        $insert();
                        $respone = 'SUKSES';
                    }else{
                        $respone = 'GAGAL';
                    }
                    
                }elseif($bup_x <= 0){
                    $rumus = $u_pengangkatan - $bup_fix($bup_x);
                    $rumus_fix = $usia_pgw - $rumus;
                    if($rumus_fix < 0){
                        $insert();
                        $respone = 'SUKSES';
                    }else{
                        $respone = 'GAGAL';
                    }
                }elseif($bup_x < -100){
                    // var_dump(substr($bup_x, 0, 2));exit;
                    // $rumus = $u_pengangkatan - $bup_fix();
                    $respone = 'GAGAL';
                }
            }else{
                $insert();
                $respone = 'SUKSES';
            }
            $return = array('responeinsert' => $respone, 'usia_angkat' => empty($rumus) ? NULL : $rumus, 'usia_pgw' => $usia_pgw);
        }else{
            $insert();
            $respone = 'SUKSES';
            $return = array('responeinsert' => $respone);
        }
        echo json_encode($return); 


        // $post = $this->input->post();
        // $res = $this->get_init_syarat($post['id_jenis_permohonan'], $post['id_permohonan']);
        // $nrk = $_SESSION['logged_in']['id'];
        // $init_syarat = array();
        // $id_syarat = array();
        // $x = 0;
        // foreach($res->result() as $row){
        //  $init_syarat[$x++] = $row->INIT_SYARAT;
        //  $id_syarat[] = $row->ID_SYARAT;
        // }
        // $dir = array_slice(scandir("assets/file_permohonan/".$nrk."/"), 2);
        // $id_trx = $this->permohonan->insertMasterPermohonan(array('nrk'=>$nrk, 'jenis'=>$post['id_jenis_permohonan'], 'permohonan'=>$post['id_permohonan'], 'id_kojabf'=>$post['id_kojabf'], 'id_sop'=>$id_sop, 'id_detail_sop'=>$id_detail_sop));
        // for($i=0; $i < count($id_syarat); $i++){
        //  $path[] = pathinfo($dir[$i]);
        //  $filename[] = $nrk."@".$init_syarat[$i].".".$path[$i]['extension'];
        //  $this->permohonan->insertPermohonan($id_syarat[$i], $filename[$i]);
        //  //~echo $nrk."@".$init_syarat[$i];
        // }
        // echo $id_trx;





        //~var_dump($filename);exit;
        //~print_r($path[3]['extension']);exit;
        //~$path = array();
        //~$filename = array();
        //~foreach($init_syarat as $init){
            //~$path[$a = 0] = pathinfo("assets/file_permohonan/".$nrk);
            //~$filename[$z = 0] = $nrk."@".$init_syarat[$y++];
        //~}
        //~print_r($filename);exit;
        //~print($path."\n".$filename);exit;
    }

    public function doaddaction($init_syarat, $jenis){
        $this->create_dir();
        //var_dump($_FILES);exit;
        //$test = $this->check_if_file_exists();
        //if(isset($test) <> null){
            //echo 'test';exit;
        //}
        //~if(isset($_POST['nrk'])){
            //~$nrk = $_POST['nrk'];
        //~}else{
            //~$nrk = "empty";
        //~}
        //~var_dump($_FILES);exit;
        $default_filename_list = 'list_folders_for_each_users.json';

        // $check_file = glob($default_filename_list);
        // if($check_file){
        // 	echo 'true';
        // }

        // exit;

        $nrk = $_SESSION['logged_in']['id'];
        $tmp_file = pathinfo($_FILES['file']['name']);
        //~var_dump($tmp_file['extension']);exit;
        $filename = $nrk.'@'.$init_syarat.'.'.$tmp_file['extension'];
        
        


        /*Upload Code*/
        
        $uploads_dir = 'assets/file_permohonan/'.$nrk;
        


        //~foreach ($_FILES["pictures"]["error"] as $key => $error) {
            //~if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["file"]["tmp_name"];
                //~$name = $_FILES["pictures"]["name"];
                move_uploaded_file($tmp_name, "$uploads_dir/$filename");
                //~$this->permohonan->insertMasterPermohonan(array('nrk'=>$_SESSION['logged_in']['id'], 'jenis'=>$jenis, 'permohonan'=>$permohonan));
                //~$this->permohonan->insertPermohonan(1,$filename);
                echo $filename;
            //~}
        //~}
        
        /*End of Upload*/
        
        
        //~var_dump($filename);exit;
        //~var_dump($filename.' '.$_FILES['file']['name']);exit;
        //~preg_match("/\.png|\.pdf|\.jpeg|\.jpg/i", $_FILES['file']['name'], $match);
        //~var_dump($_SESSION);exit;

        // if (isset($_FILES)) {
        //  print_r($_FILES);
        // }
        //~$config['upload_path'] = 'assets/file_permohonan/'.$_SESSION['logged_in']['id'];
        //~$config['allowed_types'] = 'jpeg|jpg|png|pdf';
        //~$config['file_name'] = $filename;
        //~$config['max_size'] = 3048;
        //~$config['overwrite'] = TRUE;
//~
        //~$this->load->library('upload', $config);
        //~$this->upload->do_upload($_FILES['file']);
        //~$files = array('upload_data' => $this->upload->data());
//~
        //~if ( ! $this->upload->do_upload())
        //~{
            //~$error = array('error' => $this->upload->display_errors());
//~
            //~var_dump($error);exit;
        //~}
        //~else
        //~{
            //~$data = array('upload_data' => $this->upload->data());
//~
            //~var_dump($data);exit;
        //~}
        
        // $permohonan = $data['ID_PERMOHONAN'];
        // $jenis = $data['ID_JENIS'];
        //~$permohonan = $data['permohonan'];
        //~$jenis = $data['jenis'];

        //~$arrVar=array();
        //~$arrFile=array();
        //~if($permohonan == 1 && $jenis == 1)
        //~{
            //~$arrVar = array($data['nrk'],$data['sk_cpns_1'],$data['sk_pns_1'],$data['sk_pak_1'],$data['ijazah_1'],$data['sk_pgkt_1'],$data['dp3_1'],$data['sdj_1'],$data['sr_1']);
            //~$arrFile = array('nrk','sk_cpns_1','sk_pns_1','sk_pak_1','ijazah_1','sk_pgkt_1','dp3_1','sdj_1','sr_1'); 
        //~}
        //~else if($permohonan == 1 && $jenis == 2)
        //~{
            //~$arrVar = array($data['nrk'],$data['sk_pdj_2'],$data['sk_psj_2'],$data['sk_pak_2'],$data['sk_pgkt_2'],$data['ijazah_2'],$data['dp3_2'],$data['sr_2']);
            //~$arrFile = array('nrk','sk_pdj_2','sk_psj_2','sk_pak_2','sk_pgkt_2','ijazah_2','dp3_2','sr_2');
        //~}
        //~else if($permohonan == 1 && $jenis == 3)
        //~{
            //~$arrVar = array($data['nrk'],$data['sk_pdj_3'],$data['sk_pak_3'],$data['ijazah_3'],$data['dp3_3'],$data['sk_pgkt_3'],$data['bukti_3']);
            //~$arrFile = array('nrk','sk_pdj_3','sk_pak_3','ijazah_3','dp3_3','sk_pgkt_3','bukti_3');
        //~}

        //~$countSyarat = $this->permohonan->cekJumlahSyarat($permohonan,$jenis);
        //~
        //~$per = $this->permohonan->cekPerSyarat($permohonan,$jenis); //count per id syarat
//~
        //~
        //~$i=1;
        //~$countDtSukses = 0;
//~
        //~//query insert ke tabel MASTER
        //~$res = $this->permohonan->insertMasterPermohonan($data); 
        //~
      //~
        //~foreach ($per->result() as $row) 
        //~{
            //~// var_dump($row);exit;
            //~$syarat = $row->ID_SYARAT;
            //~if($permohonan == 1 && $jenis == 1)
            //~{
                //~
                //~
                //~//$cekpjg =strlen($arrVar[$i]);                     //hitung panjang string (return int)
                //~//$getpots = strpos($arrVar[$i],".");               //cari posisi karakter '.'
                //~$getdot = explode('.',$arrVar[$i]);                 //memotong string menjadi karakter setelah tanda '.' 
                //~$get_ext = end($getdot);                            //mengambil kata terakhir setelah pemotongan berdasarkan karakter '.'
                //~
                //~if($get_ext=="")
                //~{
                    //~$namafile ="";
                //~}
                //~else
                //~{   
                    //~date_default_timezone_set('Asia/Jakarta');
                    //~$date = date('Y-m-d H:i:s');
                    //~$namafile = $nrk.$row->INIT_SYARAT.'_'.$row->ID_JENIS_PERMOHONAN.'_'.$date.'.'.$get_ext;
                //~}
                //~
    //~
                //~if($row->ID_SYARAT == $i)
                //~{
                    //~if (!is_dir('assets/file_permohonan/'.$nrk)) {
                        //~mkdir('assets/file_permohonan/'.$nrk, 0777, TRUE);
//~
                    //~}
                    //~
                    //~$config = array(
                        //~'upload_path' => 'assets/file_permohonan/'.$nrk,
                        //~'allowed_types' => 'jpeg|jpg|png|pdf',
                        //~'file_name' => $namafile,
                        //~// 'raw_name' => $nama_file_we,
                        //~// 'orig_name' => $namafile,
                        //~// 'client_name' => $namafile,
                        //~// 'file_ext' => '.jpg',
                        //~//'file_ext_tolower' => TRUE,
                        //~//'overwrite' => TRUE,
                        //~'max_size' => 2048,
                        //~// 'max_width' => 1024,
                        //~// 'max_height' => 768,
                        //~// 'min_width' => 10,
                        //~// 'min_height' => 7,
                        //~'max_filename' => 100,
                        //~//'remove_spaces' => TRUE
                    //~);
                    //~//load library utk upload
//~
                    //~$this->load->library('upload',$config);
                    //~$this->upload->initialize($config);
//~
//~
                    //~//upload perfile
                    //~if ( ! $this->upload->do_upload($arrFile[$i]))
                    //~{
//~
                        //~$upload = '';
                        //~$hasil = $this->upload->display_errors();
                    //~}
                    //~else
                    //~{
                        //~
                        //~$config['image_library'] = 'gd2';
                        //~$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                        //~$config['create_thumb'] = TRUE;
                        //~$config['maintain_ratio'] = TRUE;
                        //~$config['width']         = 240;
                        //~$config['height']       = 300;
//~
//~
                        //~/*$this->load->library('image_lib', $config);
//~
                        //~if ( ! $this->image_lib->resize()){
                            //~$upl_data = "";
                            //~$result = $this->image_lib->display_errors('', '');
                        //~}else{
                            //~$upl_data = $this->image_lib->resize();
                            //~$result = 'SUKSES';
                        //~}
                         //~$hasil = array('result' => $result);
                        //~*/
                                                //~
                        //~$somefile =  $this->upload->data();
                        //~$countDtSukses++;
                    //~}
                //~}
                //~//query untuk insert ke DETAIL
                    //~if($namafile == "")
                    //~{
                        //~$file_kosong = '';
                        //~// var_dump($namafile);
                      //~
                        //~$hsl = $this->permohonan->insertPermohonan($syarat,$file_kosong);
                        //~// break;
                    //~}
                    //~else
                    //~{    
                        //~$hsl = $this->permohonan->insertPermohonan($syarat,$namafile);
                      //~
                    //~}
            //~}
            //~else if($permohonan == 1 && $jenis == 2)
            //~{
                //~
                //~
                //~//$cekpjg =strlen($arrVar[$i]);                     //hitung panjang string (return int)
                //~//$getpots = strpos($arrVar[$i],".");               //cari posisi karakter '.'
                //~$getdot = explode('.',$arrVar[$i]);                 //memotong string menjadi karakter setelah tanda '.' 
                //~$get_ext = end($getdot);                            //mengambil kata terakhir setelah pemotongan berdasarkan karakter '.'
                //~
                //~if($get_ext=="")
                //~{
                    //~$namafile ="";
                //~}
                //~else
                //~{
                    //~$namafile = $nrk.$row->INIT_SYARAT.'_'.$row->ID_JENIS_PERMOHONAN.'.'.$get_ext;
                //~}
                //~
    //~
                //~if($row->ID_SYARAT == $i)
                //~{
                    //~if (!is_dir('assets/file_permohonan/'.$nrk)) {
                        //~mkdir('assets/file_permohonan/' . $nrk, 0777, TRUE);
//~
                    //~}    
                    //~
                    //~$config = array(
                        //~'upload_path' => 'assets/file_permohonan/'.$nrk,
                        //~'allowed_types' => 'jpeg|jpg|png|pdf',
                        //~'file_name' => $namafile,
                        //~// 'raw_name' => $nama_file_we,
                        //~// 'orig_name' => $namafile,
                        //~// 'client_name' => $namafile,
                        //~// 'file_ext' => '.jpg',
                        //~//'file_ext_tolower' => TRUE,
                        //~//'overwrite' => TRUE,
                        //~'max_size' => 2048,
                        //~// 'max_width' => 1024,
                        //~// 'max_height' => 768,
                        //~// 'min_width' => 10,
                        //~// 'min_height' => 7,
                        //~'max_filename' => 100,
                        //~//'remove_spaces' => TRUE
                    //~);
                    //~//load library utk upload
//~
                    //~$this->load->library('upload', $config);
                    //~$this->upload->initialize($config);
//~
//~
                    //~//upload perfile
                    //~if ( ! $this->upload->do_upload($arrFile[$i]))
                    //~{
//~
                        //~$upload = '';
                        //~$hasil = $this->upload->display_errors();
                    //~}
                    //~else
                    //~{
                        //~
                        //~$config['image_library'] = 'gd2';
                        //~$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                        //~$config['create_thumb'] = TRUE;
                        //~$config['maintain_ratio'] = TRUE;
                        //~$config['width']         = 240;
                        //~$config['height']       = 300;
//~
//~
                        //~/*$this->load->library('image_lib', $config);
//~
                        //~if ( ! $this->image_lib->resize()){
                            //~$upl_data = "";
                            //~$result = $this->image_lib->display_errors('', '');
                        //~}else{
                            //~$upl_data = $this->image_lib->resize();
                            //~$result = 'SUKSES';
                        //~}
                         //~$hasil = array('result' => $result);
                        //~*/
                                                //~
                        //~$somefile =  $this->upload->data();
                        //~$countDtSukses++;
                    //~}
                //~}
                //~//query untuk insert ke DETAIL
                //~
                    //~if($namafile == "")
                    //~{
                        //~$file_kosong = '';
                        //~$hsl = $this->permohonan->insertPermohonan($syarat,$file_kosong);
                    //~}
                    //~else
                    //~{
                        //~$hsl = $this->permohonan->insertPermohonan($syarat,$namafile);
                    //~}
            //~}
//~
            //~else if($permohonan == 1 && $jenis == 3)
            //~{
                //~
                //~
                //~//$cekpjg =strlen($arrVar[$i]);                     //hitung panjang string (return int)
                //~//$getpots = strpos($arrVar[$i],".");               //cari posisi karakter '.'
                //~$getdot = explode('.',$arrVar[$i]);                 //memotong string menjadi karakter setelah tanda '.' 
                //~$get_ext = end($getdot);                            //mengambil kata terakhir setelah pemotongan berdasarkan karakter '.'
                //~
                //~if($get_ext=="")
                //~{
                    //~$namafile ="";
                //~}
                //~else
                //~{
                    //~$namafile = $nrk.$row->INIT_SYARAT.'_'.$row->ID_JENIS_PERMOHONAN.'.'.$get_ext;
                //~}
                //~
    //~
                //~if($row->ID_SYARAT == $i)
                //~{
                    //~
                    //~if (!is_dir('assets/file_permohonan/'.$nrk)) {
                        //~mkdir('assets/file_permohonan/' . $nrk, 0777, TRUE);
//~
                    //~}
                    //~$config = array(
                        //~'upload_path' => 'assets/file_permohonan/'.$nrk,
                        //~'allowed_types' => 'jpeg|jpg|png|pdf',
                        //~'file_name' => $namafile,
                        //~// 'raw_name' => $nama_file_we,
                        //~// 'orig_name' => $namafile,
                        //~// 'client_name' => $namafile,
                        //~// 'file_ext' => '.jpg',
                        //~//'file_ext_tolower' => TRUE,
                        //~//'overwrite' => TRUE,
                        //~'max_size' => 2048,
                        //~// 'max_width' => 1024,
                        //~// 'max_height' => 768,
                        //~// 'min_width' => 10,
                        //~// 'min_height' => 7,
                        //~'max_filename' => 100,
                        //~//'remove_spaces' => TRUE
                    //~);
                    //~//load library utk upload
//~
                    //~$this->load->library('upload', $config);
                    //~$this->upload->initialize($config);
//~
//~
                    //~//upload perfile
                    //~if ( ! $this->upload->do_upload($arrFile[$i]))
                    //~{
//~
                        //~$upload = '';
                        //~$hasil = $this->upload->display_errors();
                    //~}
                    //~else
                    //~{
                        //~
                        //~$config['image_library'] = 'gd2';
                        //~$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                        //~$config['create_thumb'] = TRUE;
                        //~$config['maintain_ratio'] = TRUE;
                        //~$config['width']         = 240;
                        //~$config['height']       = 300;
//~
//~
                        //~/*$this->load->library('image_lib', $config);
//~
                        //~if ( ! $this->image_lib->resize()){
                            //~$upl_data = "";
                            //~$result = $this->image_lib->display_errors('', '');
                        //~}else{
                            //~$upl_data = $this->image_lib->resize();
                            //~$result = 'SUKSES';
                        //~}
                         //~$hasil = array('result' => $result);
                        //~*/
                                                //~
                        //~$somefile =  $this->upload->data();
                        //~$countDtSukses++;
                    //~}
                //~}
                //~//query untuk insert ke DETAIL
                //~
                    //~if($namafile == "")
                    //~{
                        //~$file_kosong = '';
                        //~$hsl = $this->permohonan->insertPermohonan($syarat,$file_kosong);
                    //~}
                    //~else
                    //~{
                        //~$hsl = $this->permohonan->insertPermohonan($syarat,$namafile);
                    //~}
                //~}
                //~
                //~
                //~$i++;
                //~
            //~}
            // $this->permohonan->insertMasterPermohonan($data);
        
        
        //$linkback = base_url() . 'index.php/permohonan/';
        
       /* if($countSyarat == $countDtSukses)
        {
            $a = array('response' => 'SUKSES');        
        }
        else
        {
            $a = array('response' => 'GAGAL');     
        }*/

       // redirect(site_url('permohonan/sukses'));

    }

    public function insert_file_to_database(){
        
    }

    public function sukses()
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

         $datam['activeMenu'] = "3765";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'permohonan',0);
                //$datam['inisial'] = 'skpdjabfung';
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
            $this->load->view('head/menu',$datam);
            $this->load->view('validasiPermohonan',$data);
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

}
