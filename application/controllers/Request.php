<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {

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
        $datam['activeMenu'] = "2837";
        $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'request',0);
        $datam['inisial'] = 'request';            

        $data['menu_select'] = $this->infopegawai->getMenuSelectHistSelf($this->user['user_group']);
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
        $this->load->view('head/menu',$datam);
        $this->load->view('request_v',$data);
        //$this->load->view('admin/pegawai_list',$data);
        $this->load->view('head/footer');
    }

    public function generateRequest(){
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
            
            case 'penform': //Pendidikan Formal
                $hasil = $this->infopegawai->getRequestPendidikanFormal($ug,$id);
                break;
            case 'pennform': //Pendidikan Non Formal
                $hasil = $this->infopegawai->getRequestPendidikanNonFormal($ug,$id);
                break;
            
            case 'ala': //Alamat
                $hasil = $this->infopegawai->getRequestAlamat($ug,$id);
                break;
           
            case 'kel': //Keluarga
                $hasil = $this->infopegawai->getRequestHubunganKeluarga($ug,$id);
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
            //$nrk = $_POST['nrk'];
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Form');
            echo json_encode($return);
            exit();
        }

        $data = $this->generateDataForm($form);
        $widthForm = $data['widthForm'];
        //$data['nrk'] = $nrk;

        //Dapatkan TMT Mutasi dan TMT CPNS
        //$listdata = $this->mdl->get_data($nrk)->row();
        // if ($listdata->TMTPINDAH != NULL){
        //     $data['tmtpindah'] = date('Y-m-d',strtotime($listdata->TMTPINDAH));
        // } else {
        //     $data['tmtpindah'] = '';
        // }

        // if ($listdata->MUANG != NULL){
        //     $data['muang'] = date('Y-m-d',strtotime($listdata->MUANG));
        // } else {
        //     $data['muang'] = '';
        // }


        $msg = $this->load->view('admin/form_hist/form_'.$form, $data, true);

        $return = array('response' => 'SUKSES', 'result' => $msg, 'widthForm' => $widthForm);
        echo json_encode($return);
    }

    public function generateDataForm($form){
        $data['empty'] = ""; $data['widthForm'] = "two";
        switch ($form) {
            
            case 'pendidikan_formal_2':
                $data['widthForm'] = "one";
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $jendik = $this->input->post('key2');//jendik
                $kodik = $this->input->post('key3');//kodik   
                $univer = "";
                $titeldepan="";
                $titelbelakang="";
                $stat="";

                $data['action']=$action;

                if($action != null && $action == 'update'){                    
                    $data['infoPendidikan'] = $this->infopegawai->getPendidikanHistBy($nrk2,$jendik,$kodik);
                    $data['infoUPForm']=$nrk2;                    
                    $univer = $data['infoPendidikan']->UNIVER;
                    $titeldepan = $data['infoPendidikan']->TITELDEPAN;
                    $titelbelakang = $data['infoPendidikan']->TITELBELAKANG;
                    $stat=$data['infoPendidikan']->STAT_APP;

                    $data['listKodik'] = $this->infopegawai->getMasterKodik($jendik,$kodik);
                    //$data['listStatus']=$this->infopegawai->getStatApp($stat);
                }
                else if($action == 'tambah')
                {
                    $data['listKodik'] = $this->infopegawai->getMasterKodik(1);    
                }
                
                $data['listStatus'] = $this->infopegawai->getStatApp($stat);
                $data['listJendik'] = $this->infopegawai->getMasterJendikForm($jendik);
                $data['listUniver'] = $this->infopegawai->getMasterUniver($univer);

                break;

            case 'pendidikan_nonformal_2':
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $jendik = $this->input->post('key2');//jendik
                $kodik = $this->input->post('key3');//kodik   
                $univer = "";
                $stat="";

                $data['action'] = $action;

                if($action != null && $action == 'update'){                    
                    $data['infoPendidikan'] = $this->infopegawai->getPendidikanHistBy($nrk2,$jendik,$kodik);      
                    $data['infoUPNForm']=$nrk2;              
                    $univer = $data['infoPendidikan']->UNIVER;
                    $data['listKodik'] = $this->infopegawai->getMasterKodik($jendik,$kodik);
                    $stat=$data['infoPendidikan']->STAT_APP;
                }

                $data['listStatus'] = $this->infopegawai->getStatApp($stat);
                $data['listJendik'] = $this->infopegawai->getMasterJendikNonForm($jendik);
                $data['listUniver'] = $this->infopegawai->getMasterUniver($univer);
                break;


            case 'alamat_2':
                                
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                $tgmulai = $this->input->post('key2');//tgmulai
                $kowil = ""; $kokec = ""; $kokel = ""; $prop = "";$stat="";

                $data['action'] = $action;

                if($action != null && $action == 'update'){   
                	$data['infoUAlamat']=$nrk2;                       
                    $data['infoAlamat'] = $this->infopegawai->getAlamatHistBy($nrk2,$tgmulai);  
                    $kowil = $data['infoAlamat']->KOWIL;
                    $kokec = $data['infoAlamat']->KOCAM;
                    $kokel = $data['infoAlamat']->KOKEL;
                    $prop = $data['infoAlamat']->PROP;
                    $stat = $data['infoAlamat']->STAT_APP;
                }

                $data['listWilayah'] = $this->infopegawai->getWilayah($kowil);
                $data['listKecamatan'] = $this->infopegawai->getKecamatan($kowil,$kokec);                
                $data['listKelurahan'] = $this->infopegawai->getKelurahan($kowil,$kokec,$kokel);
                $data['listPropinsi'] = $this->infopegawai->getPropinsi($prop);
                $data['listStatus']=$this->infopegawai->getStatApp($stat);
                break;

            case 'keluarga_2':
                
                $action = $this->input->post('action');//action
                $nrk = $this->input->post('nrk');//nrk
                $nrk2 = $this->input->post('key1');//nrk
                //$hubkel = $this->input->post('key2');//dari 
                $hubkel="";
                $stattun="";
                $kdkerja="";
                $uangduka="";
                $stat="";
                $data['action'] = $action;
                if($action != null && $action == 'update'){  
                	$data['infoUKlg']=$nrk2; 
                    $hubkel = $this->input->post('key2');//dari                   
                    $data['infoKeluarga'] = $this->infopegawai->getKeluargaHistBy($nrk2,$hubkel); 
                    $hubkel = $data['infoKeluarga']->HUBKEL;
                    $stattun = $data['infoKeluarga']->STATTUN;
                    $kdkerja = $data['infoKeluarga']->KDKERJA;
                    $uangduka = $data['infoKeluarga']->UANGDUKA;
                    $stat = $data['infoKeluarga']->STAT_APP;
                    //$talhir = $data['infoKeluarga']->TEMHIR;
                }
                $listdata = $this->mdl->get_data($nrk)->row();
                $data['listStawin'] = $this->mdl->getListStawin($listdata->STAWIN);
                $data['NOKK'] = $listdata->NOKK;
                $data['listKdHubkel'] = $this->infopegawai->getKodeHubkel($hubkel);
                $data['listStatusTunjangan'] = $this->infopegawai->getKodeStattun($stattun);
                $data['listJenisPekerjaan'] = $this->infopegawai->getKodeKerja($kdkerja);
                $data['listUangDuka'] = $this->infopegawai->getUangDuka($uangduka);
                $data['listStatus']=$this->infopegawai->getStatApp($stat);
                
                break;

            default:
                $data['empty'] = "";
                break;
        }

        return $data;
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





/*START PENDIDIKAN FORMAL*/


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


/*START ALAMAT*/
    
    public function ajax_update_alamat()
    {
        $data['user_id'] = $this->user['id'];
        $update = $this->home->update_alamat($data);

        if($update){
            echo json_encode(array("response" => 'SUKSES', 'act' => "upd"));
        }else{
            echo json_encode(array("response" => 'GAGAL', 'act' => "upd"));
        }
    }

/*END ALAMAT*/


/*START KELUARGA*/


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



/*START REFERENSI*/
    public function getKojabStruktural(){
        if(isset($_POST['kolok'])){
            $kolok = $_POST['kolok'];
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Kolok');
            echo json_encode($return);
            exit();
        }
        
        $listKojab = $this->infopegawai->getMasterKojab($kolok);
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

    public function getKecamatan()
    {
        $kowil = $this->input->post('kowil');

        $list = $this->infopegawai->getKecamatan($kowil);
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }

    public function getKelurahan()
    {
        $kowil = $this->input->post('kowil');
        $kocam = $this->input->post('kocam');

        $list = $this->infopegawai->getKelurahan($kowil,$kocam);
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
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

}
