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
            redirect(base_url().'index.php/login', 'refresh');
        }       
    }


    public function index()
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
            $this->load->view('head/header',$this->user);
            $this->load->view('head/menu', $datam);
            $this->load->view('vsubbid',$data);
            //$this->load->view('admin/pegawai_list',$data);
            $this->load->view('head/footer');
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

    public function get_data_permohonan(){
        $result = $this->subbid->getdatatubkd();
        
        echo $result;
    }

    public function get_data_permohonan2(){
        $result = $this->subbid->getdatatubkd2();

        echo $result;

    }

    public function getDataTrxDtl(){
        $result = $this->subbid->dataTrxDtl();

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
                "URUTAN"	=> $urutan
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
            "URUTAN"	=> $fdata['urutan']
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

    function simpanPerbal(){
        $fdata=$this->input->post();
        $tgl_perbal = $fdata['tgl_perbal'];
        $dimajukan = $fdata['dimajukan'];
//        var_dump($fdata);exit;

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
            "PEMARAF" => $fdata['pemaraf'],
            "TEMBUSAN" => $fdata['tembusan'],
            "DITETAPKAN" => $fdata['ditetapkan'],
            "DISERAHKAN" => $fdata['diserahkan']
        );
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

//        var_dump($fdata);exit;
        $pk = array(
            "ID_TRACKING" => $id_tracking
        );
        $data=array(
            "URUTAN" => $urutan,
            "STATUS" => 1
        );
        $rs=$this->subbid->ubah('PERS_TRACKING',$data,$pk);

        $rs_dtl = $this->subbid->dataTrxDtl2($id_trx_hdr);
//        var_dump($rs_dtl);exit;
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
//            var_dump($kojabArr);

            if($kojabArr){
                $kojabArrNew['TMT']="SYSDATE";
                $kojabArrNew['KOJAB']=$id_kojabf;
                $sk=$this->subbid->dataSK($id_tracking);

                $kojabArrNew['NOSK']=$sk->NO_SURAT;
                $kojabArrNew['TGSK']="tgl_sk";
                $kojabArrNew['KOLOK']=$kojabArr->KOLOK;
                $kojabArrNew['KOPANG']=$kojabArr->KOPANG;
                $kojabArrNew['PEJTT']=$kojabArr->PEJTT;
                $kojabArrNew['SPMU']=$kojabArr->SPMU;
                $kojabArrNew['KLOGAD']=$kojabArr->KLOGAD;
                $kojabArrNew['NRK']=$r->NRK;
                $kojabArrNew['STATUS']=0;
                $kojabArrNew['KREDIT']=$sk->KREDIT;
                $kojabArrNew['USER_ID']='PERS';
                $kojabArrNew['TERM']='LOAD';
                $kojabArrNew['TG_UPD']='SYSDATE';
                $this->subbid->tambahKojabf('PERS_JABATANF_HIST',$kojabArrNew,$sk->TGL_SURAT);
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

    public function cetakPerbal($id_trx_hdr){
        $this->load->library('pdf_report2');

        $rs = $this->subbid->dataTrackingPerbal($id_trx_hdr);
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
            'dimajukan' => $dimajukan
        );
        $this->load->view('perbal_cover',$data);
    }

    public function cetakPerbal2($id_trx_hdr){
        
        $this->load->library('pdf_report3');

        /*$rs = $this->subbid->dataTrackingPerbal($id_trx_hdr);
        $time_tgl_perbal = strtotime($rs->TGL_PERBAL);
        $tgl_perbal = date('d', $time_tgl_perbal).' '.$this->bulan(date('m', $time_tgl_perbal)).' '.date('Y', $time_tgl_perbal);
        if($rs->DIMAJUKAN == ''){
            $dimajukan = '';
        } else {
            $time_dimajukan = strtotime($rs->DIMAJUKAN);
            $dimajukan = date('d', $time_dimajukan).' '.$this->bulan(date('m', $time_dimajukan)).' '.date('Y', $time_dimajukan);
        }*/

        $data = array(
            'id_trx_hdr'=>$id_trx_hdr
            /*'time_tgl_perbal' =>$time_tgl_perbal,
            'tgl_perbal' => $tgl_perbal,
            'dimajukan' => $dimajukan*/
        );
        $this->load->view('perbal1',$data);
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
        ';

        echo $html;
    }
     

}

