<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referensi extends CI_Controller {

    private $user=array();

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));      
        $this->load->library('session');
        $this->load->model('mreferensi','referensi');
        $this->load->library('inforeferensi');
        $this->load->library('infopegawai');
        $this->load->library('convert');

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

            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL


            // START Inisial Active Menu
            $datam['activeMenu'] = "283";
            $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'referensi',0);
            $datam['inisial'] = 'referensi';
            // END Inisial Active Menu

            $nrk = $this->user['id'] ;

            //$data['menu_select'] = $this->inforeferensi->getMenuSelectRef();
            $data['menu_select'] = $this->inforeferensi->getMenuSelectRefNew($this->user['user_group']);
            $data['nrk'] = $nrk;
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];            

            $menuid='283';  
            $cekaksesmenu = $this->infopegawai->cekaksesmenu($menuid,$this->user['user_group']);

            if($cekaksesmenu == '1')
            {
                $this->load->view('head/header',$this->user);
                $this->load->view('head/menu',$datam);
                $this->load->view('referensi',$data);
                $this->load->view('head/footer');
            }
            else
            {
                $this->load->view('403');
            }            
    }    

    public function generateReferensi(){
        
        // START REQUEST REFERENSI
        if(isset($_POST['id_referensi'])){
            $id = $_POST['id_referensi'];
            // var_dump($id);
        }else{
            $id = 1;
        }
        // END REQUEST REFERENSI     

        $option = "";

        switch ($id) {
            case 'loker': //Lokasi Kerja
                $hasil = $this->inforeferensi->getReferensiKolok();
                break;
            case 'lokpen': //Lokasi Penempatan
                $hasil = $this->inforeferensi->getReferensiKlogad3();
                break;
            case 'loga': //Lokasi Gaji
                $hasil = $this->inforeferensi->getReferensiLokasiGaji();
                break;
            case 'tipen': //Tingkat Pendidikan

                if(isset($_POST['jenis'])){
                    $jenis = $_POST['jenis'];
                }else{
                    $jenis = 1;
                }

                $option = $this->inforeferensi->getOptionJendik();
                $hasil = $this->inforeferensi->getReferensiTingkatPendidikan($jenis);
                break;
            case 'hubkel': //Hubungan Keluarga
                $hasil = $this->inforeferensi->getReferensiHubkel();
                break;
            case 'jabstruk': //Jabatan Struktural
                if(isset($_POST['kolok'])){
                    $kolok = $_POST['kolok'];
                }else{
                    $kolok = "";
                }

                $option = $this->inforeferensi->getOptionKolok();
                $hasil = $this->inforeferensi->getReferensiJabatan($kolok); 
                break;
            case 'jabfung': //Jabatan Fungsional
                $hasil = $this->inforeferensi->getReferensiJabatanf();
                break;
            case 'pgkt': //Pangkat
                $hasil = $this->inforeferensi->getReferensiPangkat();
                break;
            case 'gpk': //Gaji Pokok
                $hasil = $this->inforeferensi->getReferensiGajiPokok();
                break;
            case 'gpktbl': //Gaji Pokok
                $hasil = $this->inforeferensi->getReferensiGajiPokokTabel();
                break;
            case 'jenpen': //Jenis Pendidikan
                $hasil = $this->inforeferensi->getReferensiJendik();
                break;
            case 'jencuti': //Jenis Cuti
                $hasil = $this->inforeferensi->getReferensiJenisCuti();
                break;
            case 'jenfas': //Jenis Fasilitas
                $hasil = $this->inforeferensi->getReferensiJenisFasilitas();
                break;
            case 'hukadm': //Jenis Hukuman Administrasi
                $hasil = $this->inforeferensi->getReferensiHukAdmin();
                break;
            case 'hukdis': //Jenis Hukuman Disiplin
                $hasil = $this->inforeferensi->getReferensiHukDis();
                break;
            case 'jenpeg': //Jenis Pegawai
                $hasil = $this->inforeferensi->getReferensiPegawai();
                break;
            case 'jenrub': //Jenis Perubahan
                $hasil = $this->inforeferensi->getReferensiPerubahan();
                break;
            case 'jenush': //Jenis Usaha
                $hasil = $this->inforeferensi->getReferensiJenisUsaha();
                break;
            case 'keorg': //Jenis Kedudukan Organisasi
                $hasil = $this->inforeferensi->getReferensiKddukanOrganisasi();
                break;
            case 'kdkerja': //Jenis kode kerja
                $hasil = $this->inforeferensi->getReferensiPekerjaan();
                break;
            case 'lgkp': //Jenis Lingkup
                $hasil = $this->inforeferensi->getReferensiLingkup();
                break;
            case 'persem': //Jenis Peran Seminar
                $hasil = $this->inforeferensi->getReferensiPeranSeminar();
                break;
            case 'perlis': //Jenis Peran Penulis
                $hasil = $this->inforeferensi->getReferensiPeranPenulisan();
                break;
            case 'jensem': //Jenis Seminar
                $hasil = $this->inforeferensi->getReferensiJenisSeminar();
                break;
            case 'jensif': //Jenis Sifat
                $hasil = $this->inforeferensi->getReferensiJenisSifat();
                break;
            case 'kkpf': //Kode Kelompok Pendidikan Formal
                $hasil = $this->inforeferensi->getReferensiKelompokKodik();
                break;
            case 'ktpf': //Kode Tingkat Pendidikan Formal
                $hasil = $this->inforeferensi->getReferensiTingkatKodik();
                break;
            case 'ktpp': //Kode Tingkat Pendidikan Penjenjangan
                $hasil = $this->inforeferensi->getReferensiTingkatKodikJenjang();
                break;
            case 'idk': //Instansi Induk
                $hasil = $this->inforeferensi->getReferensiInduk();
                break;
            case 'hrg': //Penghargaan
                $hasil = $this->inforeferensi->getReferensiPenghargaan();
                break;
            case 'univ': //Universitas
                $hasil = $this->inforeferensi->getReferensiUniversitas();
                break;
            case 'neg': //Negara
                $hasil = $this->inforeferensi->getReferensiNegara();
                break;
            case 'tema': //Tema
                $hasil = $this->inforeferensi->getReferensiTema();
                break;
            case 'wil': //Wilayah
                $hasil = $this->inforeferensi->getReferensiWilayah();
                break;
            case 'kec': //Kecamatan
                if(isset($_POST['wilayah'])){
                    $wilayah = $_POST['wilayah'];
                }else{
                    $wilayah = 1;
                }
                //$option = $this->inforeferensi->getOptionWilayah();
                $hasil = $this->inforeferensi->getReferensiKecamatan($wilayah);
                break;
            case 'kel': //Kelurahan
                
                // $hasil = $this->inforeferensi->getReferensiKelurahan();
                $hasil = " ";
                break;     

            case 'pejtt': //PEJTT
                $hasil = $this->inforeferensi->getReferensiPejtt();
                break;

            case 'agm': //Agama
                $hasil = $this->inforeferensi->getReferensiAgama();
                break;

            case 'refpermohonan': //Agama
                $hasil = $this->inforeferensi->getReferensiPersyaratan();
                break;

            case 'jensk': //Jenis SK
                $hasil = $this->inforeferensi->getReferensiJenSK();
                break;
            
            default: 
                $hasil = "<small class='text-danger'>Tidak Ada Referensi Yang Ditampilkan</small>";
                break;
        }


        $param = array('response' => 'SUKSES', 'result' => $hasil, 'option' => $option, 'idt'=>$id);

        echo json_encode($param);
    }


    public function generateForm(){
        
        if(isset($_POST['form'])){
            $form = $this->input->post('form');
            $action = $this->input->post('action');
            $key = $this->input->post('key');
            // var_dump($key);
        }else{
            $return = array('response' => 'GAGAL', 'err' => 'No Form');
            echo json_encode($return);
            exit();
        }

        $data = $this->generateDataForm($form,$key);
        $widthForm = $data['widthForm'];
        // var_dump($data);exit;

        $msg = $this->load->view('admin/form_ref/form_'.$form, $data, true);

        $return = array('response' => 'SUKSES', 'result' => $msg, 'widthForm' => $widthForm, 'action' => $action);
        echo json_encode($return);
        //var_dump($key);
    }

    public function generateDataForm($form,$key="",$key2="",$key3="",$key4=""){
        $data['empty'] = ""; $data['widthForm'] = "two";
        switch ($form) {
            case 'jabatan_hist':
                $data['listKolok'] = $this->inforeferensi->getMasterKolok();
                break;

            case 'jabatanf_hist':
                $data['listKolok'] = $this->inforeferensi->getMasterKolok();
                $data['listKojabf'] = $this->inforeferensi->getMasterKojabf();
                break;

            case 'pendidikan_formal':
                
                break;

            case 'pendidikan_non_formal':
                
                break;

            case 'ref_gapok':
                $data['widthForm'] = "one";
                  
                 $key2=$this->input->post('key2');
                 $key3=$this->input->post('key3'); 
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataGapok($key,$key2,$key3);
                }
                $data['listKopang'] = $this->infopegawai->getMasterPangkat2($key);
                break;
            case 'ref_gapok_tbl':
                $data['widthForm'] = "one";
                  
                 $key2=$this->input->post('key2');
                 $key3=$this->input->post('key3'); 
                 $key4=$this->input->post('key4');
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataGapokTbl($key,$key2,$key3,$key4);
                }
                $data['listKopang'] = $this->infopegawai->getMasterPangkat2($key2);
                break;

            case 'ref_jabatan':
                $data['widthForm'] = "two";
                
                $eselon = $this->input->post('key3');
               // var_dump($eselon);
                $key2 = $this->input->post('key2');
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataJabatan($key,$key2);
                } 
                $data['listEselon'] = $this->infopegawai->getHistEselon($eselon);
                 break;

             case 'ref_jabatanf':
                $data['widthForm'] = "two";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataJabatanf($key);
                }
                break;        

            case 'ref_hubkel':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataHubkel($key);    
                }
                break;     

            case 'ref_hukadm':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataJenhukadm($key);
                }
                break;  

            case 'ref_hukdis':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataJenhukdis($key);
                }
                break;

            case 'ref_induk':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataInduk($key);
                }
                break; 

            case 'ref_jencuti':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataJencuti($key);
                }
                break; 

            case 'ref_jenfas':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataJenfas($key);
                }
                break;                    

            case 'ref_kdlingkup':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataKdlingkup($key);
                }
                break;    

            case 'ref_pegawai':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataPegawai($key);
                }
                break;     

             case 'ref_kdkerja':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataKdkerja($key);
                }
                break;   

            case 'ref_jendik':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataJendik($key);
                }
                break;    

            case 'ref_peran':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataPeran($key);
                }
                break;    

            case 'ref_seminar':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataSeminar($key);
                }
                break;    

            case 'ref_jenrub':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataJenrub($key);
                }
                break;    

            case 'ref_kdsemi':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataKdsemi($key);
                }
                break; 

            case 'ref_kdduduk':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataKdduduk($key);
                }
                break;         

            case 'ref_kdsifat':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataKdsifat($key);
                }
                break;  

            case 'ref_kecamatan':
                $data['widthForm'] = "one";
                $key2=$this->input->post('key2');
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataKecamatan($key,$key2);
                }
                $data['listKowil'] = $this->inforeferensi->getMasterKowil($key2);
                break; 

            case 'ref_kelurahan':
                $data['widthForm'] = "one";
                $action = $this->input->post('action');
                $key=$this->input->post('key');
                $key2=$this->input->post('key2');
                $key3=$this->input->post('key3');
                $key4=$this->input->post('key4');
                $key5=$this->input->post('key5');
                $key6=$this->input->post('key6');
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataKelurahan($key,$key2,$key3,$key4);
                    // var_dump($action);
                    // var_dump($key);
                    // var_dump($key2);
                    // var_dump($key3);
                    // var_dump($key4);
                }

                $data['listProv'] = $this->inforeferensi->getMasterProv($key4);                  
                // $data['listKowil'] = $this->inforeferensi->getMasterKab($key3,$key4);
                // $data['listKocam'] = $this->inforeferensi->getKec($key2,$key3,$key4);
                // $data['listKocam'] = "";

                if($action != null && $action == 'edit'){  
                    $data['listProv'] = $this->inforeferensi->getMasterProv($key4);                  
                    $data['listKowil'] = $this->inforeferensi->getMasterKab($key3,$key4);
                    $data['listKocam'] = $this->inforeferensi->getMasterKec($key2,$key3,$key4);
                    $data['isian'] = $this->referensi->getDataKelurahan2($key,$key2,$key3,$key4);
                   
                }

                break;         

            case 'ref_jenusaha':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataJenusaha($key);
                }
                break;     

            case 'ref_kodik':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataKodik($key);
                }
                break;  
                
            case 'ref_kodikf':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataKodikf($key);
                }
                break; 

            case 'ref_kodikj':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataKodikj($key);
                }
                break; 

             case 'ref_spmu':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataSpmu($key);
                }
                break;     

             case 'ref_kolok':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataKolok($key);
                }
                break;    
   
             case 'ref_klogad3':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataKlogad($key);
                }
                break;    

             case 'ref_negara':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataNegara($key);
                }
                break;        

            case 'ref_pangkat':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataPangkat($key);
                }
                break;    

            case 'ref_penghargaan':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataHargaan($key);
                }
                break;

            case 'ref_tema':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataTema($key);
                }
                break; 

            case 'ref_pendidikan':
                $data['widthForm'] = "one";
                $key2=$this->input->post('key2');
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataPdidikan($key,$key2);
                }
                break;            

            case 'ref_universitas':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataUniver($key);
                }
                break;    

            case 'ref_wilayah':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataWilayah($key);
                }
                break;

            case 'ref_pejtt':
               $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataPejtt($key);
                }
                break;

            case 'ref_agama':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataAgama($key);
                }
                break;

            case 'ref_sk':
                $data['widthForm'] = "one";
                if($key != "" || $key != null){
                    $data['isian'] = $this->referensi->getDataSk($key);
                }
                break;
            
            default:
                $data['empty'] = "";
                break;
        }

        return $data;
        //var_dump($data);
    }    

    function simpanReferensi(){
        $destination = $this->input->post('destination');
        $action = $this->input->post('action');
        $response = false;
        // echo $action;exit;
        $data['user_id'] = $this->user['id'];

        switch ($destination) {

                case 'ref_gapok':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_gapok($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_gapok($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_gapok($data);
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_gapok($data);
                }
                break;

                case 'ref_gapok_tbl':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_gapok_tbl($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_gapok_tbl($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_gapok_tbl($data);
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_gapok_tbl($data);
                }
                break;

                case 'ref_hubkel':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_hubkel($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_hubkel($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_hubkel();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_hubkel();
                }
                break;

                case 'ref_hukadm':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_jenhukadm($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_jenhukadm($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_jenhukadm();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_jenhukadm();
                }
                break;

                case 'ref_hukdis':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_jenhukdis($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_jenhukdis($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_jenhukdis();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_jenhukdis();
                }
                break;

                case 'ref_induk':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_induk($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_induk($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_induk();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_induk();
                }
                break;

                case 'ref_jencuti':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_jencuti($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_jencuti($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_jencuti();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_jencuti();
                }
                break;

                case 'ref_jenfas':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_jenfas($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_jenfas($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_jenfas();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_jenfas();
                }
                break;

                case 'ref_jabatan':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_jabatan($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_jabatan($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_jabatan();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_jabatan();
                }
                break;

                case 'ref_jabatanf':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_jabatanf($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_jabatanf($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_jabatanf();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_jabatanf();
                }
                break;

                case 'ref_kdlingkup':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_kdlingkup($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_kdlingkup($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_kdlingkup();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_kdlingkup();
                }
                break;

                case 'ref_pegawai':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_pegawai($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_pegawai($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_pegawai();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_pegawai();
                }
                break;

                case 'ref_kdkerja':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_kdkerja($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_kdkerja($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_kdkerja();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_kdkerja();
                }
                break;

                case 'ref_jendik':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_jendik($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_jendik($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_jendik();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_jendik();
                }
                break;

                case 'ref_peran':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_peran($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_peran($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_peran();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_peran();
                }
                break;

                case 'ref_seminar':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_seminar($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_seminar($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_seminar();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_seminar();
                }
                break;

                case 'ref_jenrub':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_jenrub($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_jenrub($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_jenrub();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_jenrub();
                }
                break;

                case 'ref_kdsemi':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_kdsemi($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_kdsemi($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_kdsemi();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_kdsemi();
                }
                break;

                case 'ref_kdduduk':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_kdduduk($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_kdduduk($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_kdduduk();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_kdduduk();
                }
                break;

                case 'ref_kecamatan':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_kecamatan($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_kecamatan($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_kecamatan();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_kecamatan();
                }
                break;

                case 'ref_kelurahan':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_kelurahan($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_kelurahan($data);
                    // echo "22222222";
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_kelurahan();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_kelurahan();
                }
                break;

                case 'ref_jabatan':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_jabatan($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_jabatan($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_jabatan();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_jabatan();
                }
                break;

                case 'ref_jabatanf':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_jabatanf($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_jabatanf($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_jabatanf();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_jabatanf();
                }
                break;


                case 'ref_kdsifat':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_kdsifat($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_kdsifat($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_kdsifat();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_kdsifat();
                }
                break;

                case 'ref_jenusaha':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_jenusaha($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_jenusaha($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_jenusaha();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_jenusaha();
                }
                break;

                case 'ref_kecamatan':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_kecamatan($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_kecamatan($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_kecamatan();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_kecamatan();
                }
                break;

                case 'ref_kelurahan':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_kelurahan($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_kelurahan($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_kelurahan();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_kelurahan();
                }
                break; 

               case 'ref_kodik':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_kodik($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_kodik($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_kodik();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_kodik();
                }
                break; 

              case 'ref_kodikf':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_kodikf($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_kodikf($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_kodikf();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_kodikf();
                }
                break;

             case 'ref_kodikj':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_kodikj($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_kodikj($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_kodikj();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_kodikj();
                }
                break;  

              case 'ref_spmu':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_spmu($data);
                        
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_spmu($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_spmu();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_spmu();
                }
                break;

              case 'ref_kolok':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_kolok($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_kolok($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_kolok();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_kolok();
                }
                break;

              case 'ref_klogad3':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_klogad($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_klogad($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_klogad();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_klogad();
                }
                break;

              case 'ref_negara':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_negara($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_negara($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_negara();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_negara();
                }
                break;

              case 'ref_pangkat':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_pangkat($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_pangkat($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_pangkat();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_pangkat();
                }
                break;

              case 'ref_penghargaan':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_hargaan($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_hargaan($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_hargaan();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_hargaan();
                }
                break; 

             case 'ref_tema':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_tema($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_tema($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_tema();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_tema();
                }
                break;

             case 'ref_pendidikan':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_pdidikan($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_pdidikan($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_pdidikan();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_pdidikan();
                }
                break;      

             case 'ref_universitas':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_univer($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_univer($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_univer();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_univer();
                }
                break;    

            case 'ref_wilayah':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_wilayah($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_wilayah($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_wilayah();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_wilayah();
                }
                break;

            case 'ref_pejtt':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_pejtt($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_pejtt($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_pejtt();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_pejtt();
                }
                break;

            case 'ref_agama':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_agama($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_agama($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_agama();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_agama();
                }
                break;
           
           case 'ref_sk':
                if ($action == 'tambah') {
                    $response = $this->referensi->simpan_ref_sk($data);
                }
                if ($action == 'edit') {
                    $response = $this->referensi->update_ref_sk($data);
                }
                if ($action == 'hapus_flag') {
                    $response = $this->referensi->delete_flag_ref_sk();
                }
                if ($action == 'hapus') {
                    $response = $this->referensi->delete_ref_sk();
                }
                break;
            
            default:
                # code...
                break;
        }
        // var_dump($response);
        if($response){
            $return =array('response' => 'SUKSES');
        }else{
            $return =array('response' => 'GAGAL', 'hasil' => 'Key Sudah digunakan');
        }

        
        echo json_encode($return);
    }

    function getGolByPangkat(){
        $kopang = $this->input->post('kopang');

        $rs=$this->referensi->getMasterPangkat($kopang);

        echo $rs[0]->GOL;
    }

    public function getKocam(){
        $kowil = $this->input->post('kowil');
        
        $listKocam = $this->inforeferensi->getMasterKocam($kowil); 
        $arr = array('response' => 'SUKSES', 'listKocam' => $listKocam);
        echo json_encode($arr);
    }

    public function getKel()
    {
        $this->referensi->dataKel();
    }

    public function getKab()
    {
        $prov = $this->input->post('prov');
        // var_dump($prov);exit;

        $list = $this->inforeferensi->getKab($prov);
        // var_dump($list);exit;
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }

    public function getKecamatan()
    {
        $kd = $this->input->post('kowil');
        $prov = substr($kd, 0,2);
        $kab = substr($kd, 3,2);
        // var_dump($prov);
        // var_dump($kab);exit;

        $list = $this->inforeferensi->getKec($prov,$kab);
        // var_dump($list);exit;
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }

}