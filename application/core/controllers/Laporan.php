<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

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
        $this->load->model('mreport','report');

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
                $datam['activeMenu'] = "297";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'laporan',0);
                $datam['inisial'] = 'laporan';
                
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

            $data['tahunbrkl'] = $this->report->getTahunBerkala();
            $data['tahunpns'] = $this->report->getTahunPensiun();

            $thblp="";
            $spmp="";
            $data['spmbrkl'] = $this->report->getSpmuFromBkala($thblp,$spmp);  
            $data['spmpns'] = $this->report->getSpmuFromBkala($thblp,$spmp);  
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
            

			$this->load->view('head/header',$this->user);
			$this->load->view('head/menu',$datam);
			$this->load->view('v_laporan',$data);
            //$this->load->view('admin/pegawai_list',$data);
			$this->load->view('head/footer');

	}

    public function getListPegawai()
    {
        $this->load->model('mreport','report');
        if($this->input->post()){
            $post = $this->input->post();
            $jenis = $post['jenis'];
            $res = $post['res'];
            
            //$res2 = $post['res2'];
            $res3 = $post['res3'];
            $v1 = $post['v1'];
            $v2 = $post['v2'];
            $v3 = $post['v3'];
            $v4 = $post['v4'];
            $v5 = $post['v5'];
            $valnrk = $post['valnrk'];
            $v6 = $post['v6'];
            $v7 = $post['v7'];
            
            $where="1=1";
            $where2 = " AND 3=3 ";

            if( !empty($post['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $where2.=" AND ( NRK LIKE ('%".$post['search']['value']."&') ";    
            $where2.=" OR NAMA LIKE UPPER ('%".$post['search']['value']."%') )";
        }

            if($jenis == 1)
            {
                if($res3 == "")
                {
                    $where.=" AND THBL ='".$res."'".$where2."";
                    $datapegawai = $this->report->getDataPegawaiBerkala($where,$jenis,$res,$res3,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$valnrk);
                }
                else
                {
                    $where.=" AND THBL ='".$res."' AND SPMU = UPPER('".$res3."') ".$where2."";
                    $datapegawai = $this->report->getDataPegawaiBerkala($where,$jenis,$res,$res3,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$valnrk);
                }
                
            }
            else if($jenis == 2) //ubah get data pegawai pensiun
            {
                if($res3 == "")
                {
                    $where.=" AND TAHUN ='".$res."'";
                    $datapegawai = $this->report->getDataPegawaiPensiun($where,$jenis,$res,$res3,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$valnrk);
                }
                else
                {
                    $where.=" AND TAHUN ='".$res."' AND SPMU = UPPER('".$res3."')";
                    $datapegawai = $this->report->getDataPegawaiPensiun($where,$jenis,$res,$res3,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$valnrk);      
                }
                
            }
            else
            {
                $where.=" AND 2=2";
            }
            
            
            $datapegawai="";
            $alldata="";

            $response = array('response' => 'SUKSES', 'datapegawai' => $datapegawai, 'alldata'=> $alldata);
        }else{
            $response = array('response' => 'GAGAL');
        }

        //echo $datapegawai;
            
    }


    public function cetakDpcpPDf($res,$valnrk,$v6,$v7,$res3)
    {
    	$this->load->model('mreport','report');
        
    	 $where = "1=1";

    	 	if($res3 == 'a')
    	 	{
    	 		$where.=" AND TAHUN ='".$res."'";
    	 	}
    	 	else
    	 	{
    	 		$where.=" AND TAHUN ='".$res."' AND SPMU = '".$res3."'";	
                //$where.=" AND TAHUN ='".$res."' AND SPMU = '".$res3."' AND NRK>=170000 ";    
    	 	}
           
               
            $alldata = $this->report->getAllDataPegawaiPensiun($where);
           	

	    	$this->toPdf3($alldata,$res,$valnrk,$v6,$v7,$res3);
    }

    public function cetakBkala($res,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$valnrk,$res3)
    {	
	    $this->load->model('mreport','report');
        
    	 $where = "1=1";
    	 	
    	 	
           
           	if($res3=='a')
           	{
           		$where.=" AND THBL ='".$res."' ";	
           	}
            else
            {
            	$where.=" AND THBL ='".$res."' AND SPMU ='".$res3."'";		
            }

            
            $alldata = $this->report->getAllDataPegawaiBerkala($where);
			
	    	$this->toPdf4($alldata,$res,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$valnrk,$res3);

    }

    public function getSpmuFromBkala()
    {

        $thbl = $this->input->post('thbl');


        $list = $this->report->getSpmuFromBkala($thbl);
        
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }

    public function getSpmuFromPnsiun()
    {

        $tahun = $this->input->post('tahun');


        $list = $this->report->getSpmuFromPensiun($tahun);
        
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
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

    public function newTab()
    {
    	$this->load->view('newtab');
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
        //$rs=$this->report->getDataPegawaiBerkala($valnrk);
      	
       echo json_encode($rs);
          
    }


    public function toPdf()
    {
       
        $this->load->library('pdf_report');
        

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


            if(isset($_POST['jns']))
            {
                $jenis = $_POST['jns'];
            }
            else
            {
                $jenis="";
            }

            if(isset($_POST['res']))
            {
                $res = $_POST['res'];
            }
            else
            {
                $res="";
            }


            if(isset($_POST['res3']))
            {
                $res3 = $_POST['res3'];
            }
            else
            {
                $res3="";
            }

            //tujuan
            if(isset($_POST['v1']))
            {
                $v1 = $_POST['v1'];
            }
            else
            {
                $v1="";
            }

            //No PP
            if(isset($_POST['v2']))
            {
                $v2 = $_POST['v2'];
            }
            else
            {
                $v2="";
            }

            //tahun PP
            if(isset($_POST['v3']))
            {
                $v3 = $_POST['v3'];
            }
            else
            {
                $v3="";
            }

            //perubahan ke
            if(isset($_POST['v4']))
            {
                $v4 = $_POST['v4'];
            }
            else
            {
                $v4="";
            }

            //bagian pengaju
            if(isset($_POST['v5']))
            {
                $v5 = $_POST['v5'];
            }
            else
            {
                $v5="";
            }

            //penanda tangan
            if(isset($_POST['v6']))
            {
                $v6 = $_POST['v6'];
            }
            else
            {
                $v6="";
            }    

            //penanda tangan
            if(isset($_POST['v7']))
            {
                $v7 = $_POST['v7'];
            }
            else
            {
                $v7="";
            } 

            if(isset($_POST['valnrk']))
            {
                $valnrk = $_POST['valnrk'];
            }
            else
            {
                $valnrk="";
            }                                                     
            // END GET NRK

          //  $post = $this->input->post();
          //  $jenis = $post['jenis'];
          //  $res = $post['res'];


        
            $data['nrk'] = $nrk;
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
            
            $infoUser = $this->home->getUserInfo2($nrk);
            $data['infoUser'] = $infoUser;
            //var_dump($data['infoUser']);

            $infoPangkat = $this->home->getUserPangkat($nrk);
            $data['infoPangkat'] = $infoPangkat; 


            $thn="";

            $tempPath = "assets/img/ttd/".$valnrk.".jpg";            

            $path = (file_exists($tempPath)) ? $tempPath : '';
            
                $infoBkl = $this->report->queryBerkala($res,$nrk,$res3);
                //var_dump($infoBkl);exit;
                $data['infoBkl'] = $infoBkl;
                $thn= substr($infoBkl->MASKER, 0,2);
                $gaji_lama = number_format($infoBkl->GJLAMA);
                $gaji_baru = number_format($infoBkl->GJBARU);
               // $next_bkl = date('d-m-Y', strtotime('+2 year', strtotime( $infoBkl->MUGAD )));
                
          
            
            
            $mugd = $this->convert->tgl_indo($infoBkl->MUGAD);
            $data['mugd'] = $mugd;

            $tlhr = $this->convert->tgl_indo($infoBkl->TALHIR);
            $data['tlhr'] = $tlhr;

            $next_berkala = $this->convert->tgl_indo($infoBkl->NEXT_BRKALA);
            $data['next_berkala'] = $next_berkala;            

            ob_start();

          
           $this->pdf_report->SetTitle(''.$infoBkl->NRK.'_BERKALA'); 
           // definisikan judul dokumen


            $this->pdf_report->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
            // set header and footer fonts
            $this->pdf_report->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $this->pdf_report->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $this->pdf_report->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $this->pdf_report->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $this->pdf_report->SetHeaderMargin(PDF_MARGIN_HEADER);
            $this->pdf_report->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $this->pdf_report->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $this->pdf_report->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf_report->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set font
            $this->pdf_report->SetFont('helvetica', '', 8);

            // add a page
            $this->pdf_report->AddPage();

           $this->pdf_report->Cell(0, 0, '', 2, 1, 'C', 0, '', 0);
           $this->pdf_report->Cell(0, 0, '', 2, 1, 'C', 0, '', 0);
           $this->pdf_report->Cell(0, 0, '', 2, 1, 'C', 0, '', 0);
           $this->pdf_report->Cell(0, 0, '', 2, 1, 'C', 0, '', 0);
           $this->pdf_report->Cell(0, 0, '', 2, 1, 'C', 0, '', 0);
           $this->pdf_report->Cell(0, 0, '', 2, 1, 'C', 0, '', 0);
           

            $html = '<html>
    <head>
        <title></title>
    </head>
    <body>
        <table cellpadding="1" cellspacing="1" width="100%">
            <tbody>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="5%">&nbsp;</td>
                    <td width="25%">&nbsp;</td>
                    <td style="text-align: right;" width="35%">Jakarta,</td>
                    <td width="25%"><strong>'.$mugd.'</strong></td>
                </tr>
                <tr>
                    <td width="10%">Nomor</td>
                    <td>:</td>
                    <td>'.$infoBkl->NOSKGOL.'</td>
                    <td style="text-align: right;">Kepada,</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Sifat</td>
                    <td>:</td>
                    <td>PENTING</td>
                    <td style="text-align: right;">Yth.</td>
                    <td rowspan="2"><strong>'.$v1.'</strong></td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>:</td>
                    <td>-</td>
                    <td>&nbsp;</td>
                    
                </tr>
                <tr>
                    <td>Hal</td>
                    <td>:</td>
                    <td><strong>KENAIKAN GAJI BERKALA</strong></td>
                    <td>&nbsp;</td>
                    <td>Provinsi DKI Jakarta</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>di -</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;J A K A R T A</td>
                </tr>
            </tbody>
        </table>
        <p>
            &nbsp;</p>
            <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dengan ini diberitahukan, bahwa berhubung dengan telah dipenuhinya masa kerja dan syarat-syarat lainnya kepada: </p>
        
        <table cellpadding="1" cellspacing="1" style="width: 800px;">
            <tbody>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="5%" align="center">1.</td>
                    <td width="20%">Nama / Tanggal Lahir</td>
                    <td width="5%">:</td>
                    <td width="30%"> '.$infoBkl->NAMA.' <b>&nbsp;&nbsp;/&nbsp;&nbsp;</b> '.$tlhr.' </td>
                </tr>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="5%" align="center">2.</td>
                    <td>N I P / N R K</td>
                    <td>:</td>
                    <td> '.$infoBkl->NIP18.' <b>&nbsp;&nbsp;/&nbsp;&nbsp;</b>  '.$infoBkl->NRK.' </td>
                </tr>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="5%" align="center">3.</td>
                    <td>Pangkat / Golongan</td>
                    <td>:</td>
                    <td>'.$infoBkl->PATHIR.' <b>&nbsp;&nbsp;/&nbsp;&nbsp;</b>  '.$infoBkl->KODIK.'</td>
                </tr>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="5%" align="center">4.</td>
                    <td>Kantor / Tempat</td>
                    <td>:</td>
                    <td>'.$infoBkl->KANTOR.'</td>
                </tr>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="5%" align="center">5.</td>
                    <td>Gaji Pokok Lama</td>
                    <td>:</td>
                    <td>Rp. &nbsp;&nbsp;'.$gaji_lama.'</td>
                </tr>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="5%" align="center">&nbsp;</td>
                    <td colspan="3" rowspan="1">
                        (atas dasar SKP terakhir gaji / pangkat yang ditetapkan);</td>
                </tr>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="5%" align="center">&nbsp;</td>
                    <td colspan="3">
                        kepadanya dapat diberikan kenaikan gaji berkala hingga memperoleh:</td>
                </tr>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="5%" align="center">6.</td>
                    <td>Gaji Pokok Baru</td>
                    <td>:</td>
                    <td>Rp. &nbsp;&nbsp;'.$gaji_baru.'</td>
                </tr>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="5%" align="center">7.</td>
                    <td>Berdasarkan Masa Kerja</td>
                    <td>:</td>
                    <td>'.$thn.' TAHUN </td>
                </tr>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="5%" align="center">8.</td>
                    <td>Dalam Golongan</td>
                    <td>:</td>
                    <td>'.$infoBkl->PATHIR.'<b>&nbsp;&nbsp;/&nbsp;&nbsp;</b> '.$infoBkl->KODIK.'</td>
                </tr>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="5%" align="center">9.</td>
                    <td>Mulai Tanggal</td>
                    <td>:</td>
                    <td>'.$mugd.'</td>
                </tr>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="5%" align="center">10.</td>
                    <td>Hubungan Dinas</td>
                    <td>:</td>
                    <td>'.$infoBkl->HUB_DINAS.'</td>
                </tr>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="5%" align="center">11.</td>
                    <td>Kenaikan Gaji yang akan datang</td>
                    <td>:</td>
                    <td>'.$next_berkala.'</td>
                </tr>
                <tr>
                    <td width="10%">&nbsp;</td>
                    <td width="5%" align="center">12.</td>
                    <td>Pendidikan</td>
                    <td>:</td>
                    <td>'.$infoBkl->MSKGOL.'</td>
                </tr>
            </tbody>
        </table>

        <p align="justify">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Diharapkan kepada pegawai tersebut dapat dibayarkan penghasilannya berdasarkan Peraturan Pemerintah Nomor 7 Tahun 1977 sebagaimana telah beberapa kali diubah terakhir dengan Peraturan Pemerintah Nomor '.$v2.' Tahun '.$v3.' Tentang Perubahan '.$v4.' Atas Peraturan Pemerintah Nomor 7 Tahun 1977 Tentang Peraturan Gaji PNS.</p>
        <table border="0" cellpadding="1" cellspacing="1" width="100%">
            <tbody>
                <tr>
                    <td>
                        &nbsp;</td>
                    <td style="text-align: center;">
                        <strong>a.n. GUBERNUR PROVINSI DAERAH KHUSUS </strong></td>
                </tr>
                <tr>
                    <td>
                        &nbsp;</td>
                    <td style="text-align: center;">
                        <strong>IBUKOTA JAKARTA</strong></td>
                </tr>
                <tr>
                    <td>
                        &nbsp;</td>
                    <td style="text-align: center;">
                        '.$v5.',</td>
                </tr>
                <tr>
                    <td>
                        &nbsp;</td>
                    <td style="text-align: center;">
                        <img src="'.$path.'" height="75px" width="auto">
                    </td>
                </tr>
                
                <tr>
                    <td>
                        &nbsp;</td>
                    <td style="text-align: center;">
                        '.urldecode($v6).'</td>
                </tr>
                <tr>
                    <td>
                        &nbsp;</td>
                    <td style="text-align: center;">
                        NIP : '.$v7.'</td>
                </tr>
            </tbody>
        </table>
        <table border="0" cellpadding="1" cellspacing="1" style="width: 100%;">
            <tbody>
                
                <tr>
                    <td width="5%" align="center">
                        <span style="font-size:9px;">&nbsp;</span></td>
                    <td>
                        <span style="font-size:9px;"><strong>TEMBUSAN:</strong></span></td>
                </tr>

                <tr>
                    <td width="5%" align="center">
                        <span style="font-size:9px;">1.</span></td>
                    <td>
                        <span style="font-size:9px;">Kepala '.$infoBkl->KANTOR.'</span></td>
                </tr>
                <tr>
                    <td width="5%" align="center">
                        <span style="font-size:9px;">2.</span></td>
                    <td>
                        <span style="font-size:9px;">Kepala Bidang Pengedalian Kepegawaian BKD Provinsi DKI Jakarta</span></td>
                </tr>
                <tr>
                    <td width="5%" align="center">
                        <span style="font-size:9px;">3.</span></td>
                    <td>
                        <span style="font-size:9px;">Pegawai yang bersangkutan</span></td>
                </tr>
            </tbody>
        </table>
        <p>
            &nbsp;</p>
    </body>
</html>
';
        
            
                        
            $this->pdf_report->writeHTML($html, true, false, true, false, '');
             ob_clean();          
            
            $this->pdf_report->Output('berkala.pdf', 'I');

    }  
    //PER PEGAWAI DPCP
    public function toPdf2()
    {
       // $this->load->library('pdf');
        $this->load->library('pdf_report2');


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

            if(isset($_POST['jns']))
            {
                $jenis = $_POST['jns'];
            }
            else
            {
                $jenis="";
            }

            if(isset($_POST['res']))
            {
                $res = $_POST['res'];
            }
            else
            {
                $res="";
            }

            if(isset($_POST['res3']))
            {
                $res3 = $_POST['res3'];

            }
            else
            {
                $res3="";
            }

            //tujuan
            if(isset($_POST['v1']))
            {
                $v1 = $_POST['v1'];
            }
            else
            {
                $v1="";
            }

            //No PP
            if(isset($_POST['v2']))
            {
                $v2 = $_POST['v2'];
            }
            else
            {
                $v2="";
            }

            //tahun PP
            if(isset($_POST['v3']))
            {
                $v3 = $_POST['v3'];
            }
            else
            {
                $v3="";
            }

            //perubahan ke
            if(isset($_POST['v4']))
            {
                $v4 = $_POST['v4'];
            }
            else
            {
                $v4="";
            }

            //bagian pengaju
            if(isset($_POST['v5']))
            {
                $v5 = $_POST['v5'];
            }
            else
            {
                $v5="";
            }

            //penanda tangan
            if(isset($_POST['v6']))
            {
                $v6 = $_POST['v6'];
            }
            else
            {
                $v6="";
            }    

            //penanda tangan
            if(isset($_POST['v7']))
            {
                $v7 = $_POST['v7'];
            }
            else
            {
                $v7="";
            }

            if(isset($_POST['valnrk']))
            {
                $valnrk = $_POST['valnrk'];
            }
            else
            {
                $valnrk="";
            }                                                 
            // END GET NRK

          //  $post = $this->input->post();
          //  $jenis = $post['jenis'];
          //  $res = $post['res'];


        
            $data['nrk'] = $nrk;
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
            
            $infoUser = $this->home->getUserInfo2($nrk);
            $data['infoUser'] = $infoUser;


            
            $infoUser3 = $this->home->getUserInfo3($nrk);
            $data['infoUser3'] = $infoUser3;

            $infoRiwKj = $this->home->getRiwayatKerjaPegawai($nrk);
            $data['infoRiwKj'] = $infoRiwKj;
            $gaji = number_format($infoRiwKj->GAPOK);

            $infoIstriSuami = $this->home->getIstriSuami($nrk);
            $data['infoIstriSuami'] = $infoIstriSuami;

            $infoAnak = $this->home->getAnakKandung($nrk);
            $data['infoAnak'] = $infoAnak;

            $bykAnak = $infoAnak->num_rows();

            $anak = array();
            if($bykAnak<=3)
            {
            	foreach($infoAnak->result() as $row =>$val)
            	{
            	$anak['NAMA-'.$row] = $val->NAMA;
            	$anak['TALHIR-'.$row] = $val->TALHIR;
            	$anak['NAHUBKEL-'.$row] = $val->NAHUBKEL;
            	}	
            }
            else
            {
            	$i=1;
            	if($i<=3)
            	{
            		foreach($infoAnak->result() as $row =>$val)
		            {
		            	$anak['NAMA-'.$row] = $val->NAMA;
		            	$anak['TALHIR-'.$row] = $val->TALHIR;
		            	$anak['NAHUBKEL-'.$row] = $val->NAHUBKEL;
		            }
            	}
            	else
            	{
            		break;
            	}
            }

            $tempPath = "assets/img/ttd/".$valnrk.".jpg";            

            $path = (file_exists($tempPath)) ? $tempPath : '';
            
            $today= date('d-m-Y');

            $infoPangkat = $this->home->getUserPangkat($nrk);
            $data['infoPangkat'] = $infoPangkat; 

            $infoFirstPangkat = $this->home->getFirstPangkat($nrk);
            $data['infoFirstPangkat'] = $infoFirstPangkat;

            $infoProp = $this->home->getPropCetakLaporan(9);
            $data['infoProp'] = $infoProp;

            $infoPbyr = $this->home->getInfoPembayaranLaporan('000000620');
            $data['infoPbyr'] = $infoPbyr;

            $thn="";

            $infoMinPangkat = $this->home->getMinGol($nrk);
            $data['infoMinPangkat'] = $infoMinPangkat;

            $infoMaxPangkat = $this->home->getMaxGol($nrk);
            $data['infoMaxPangkat'] = $infoMaxPangkat;

            // cek perubahan masa kerja berdasarkan golongan

            $golMin ="";
            $golMax ="";
            $ttmaskerNow = $infoRiwKj->TTMASKER;
            $tahunKerja="";
            
            $golFPangkatMin = $infoMinPangkat->GOL1; 
            $golFGapokMin = $infoMinPangkat->GOL2;

            if($golFGapokMin<=$golFPangkatMin)
            {
            	$golMin = $golFGapokMin;
            }
            else
            {
            	$golMin = $golFPangkatMin;
            }

            $golFPangkatMax = $infoMaxPangkat->GOL1; 
            $golFGapokMax = $infoMaxPangkat->GOL2; 

            if($golFGapokMax >= $golFPangkatMax)
            {
            	$golMax = $golFGapokMax;
            }
            else
            {
            	$golMax = $golFPangkatMax;
            }

            
            if($golMin == 1 & $golMax ==2)
            {

            	$tahunKerja = $ttmaskerNow + 6 ;
            }
            else if(($golMin == 1 && $golMax == 3) || ($golMin == 1 && $golMax == 4))
            {
            	$tahunKerja = $ttmaskerNow + 11;
            }
            else if(($golMin == 2 & $golMax == 3) || ($golMin == 2 & $golMax == 4))
            {
            	$tahunKerja = $ttmaskerNow + 5;
            }
            else 
            {
            	$tahunKerja = $ttmaskerNow;
            }
            // end cek masker golongan

            $tgproduksi = date('01-m-Y');
            
                $infoDpcp = $this->report->queryDPCP($res,$nrk,$res3);
                $data['infoDpcp'] = $infoDpcp;
                $gapok = number_format($infoDpcp->GAPOK);
            
           // $this->load->view('cv_pdf',$data);
            ob_start();
           
           
           $this->pdf_report2->SetTitle(''.$infoUser->NRK.'_DPCP'); 
           // definisikan judul dokumen


            $this->pdf_report2->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
            // set header and footer fonts
            $this->pdf_report2->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $this->pdf_report2->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $this->pdf_report2->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $this->pdf_report2->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $this->pdf_report2->SetHeaderMargin(PDF_MARGIN_HEADER);
            $this->pdf_report2->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $this->pdf_report2->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $this->pdf_report2->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf_report2->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set font
            $this->pdf_report2->SetFont('helvetica', '', 8);

            // add a page
            $this->pdf_report2->AddPage();

           $this->pdf_report2->Cell(0, 0, '', 2, 1, 'C', 0, '', 0);
           $this->pdf_report2->Cell(0, 0, '', 2, 1, 'C', 0, '', 0);
           $this->pdf_report2->Cell(0, 0, '', 2, 1, 'C', 0, '', 0);
           $this->pdf_report2->Cell(0, 0, '', 2, 1, 'C', 0, '', 0);
           $this->pdf_report2->Cell(0, 0, '', 2, 1, 'C', 0, '', 0);
           $this->pdf_report2->Cell(0, 0, '', 2, 1, 'C', 0, '', 0);
           

            $html = '<html>
    <head>
        <title></title>
    </head>
    <body>
        <br/><br/><br/><br/><br/>
        <table border="0" cellpadding="1" cellspacing="1" style="width: 500px;">
            <tbody>
                <tr>
                    <td width="100px"><b>INSTANSI INDUK</b></td>
                    <td width="50px">:</td>
                    <td width="350px">PEMDA &nbsp; '.$infoProp->KETERANGAN.'</td>
                </tr>
                <tr>
                    <td><b>PROVINSI</b></td>
                    <td>:</td>
                    <td>'.$infoProp->KETERANGAN.'</td>
                </tr>
                <tr>
                    <td><b>KAB/KODYA</b></td>
                    <td>:</td>
                    <td> - </td>
                </tr>
                <tr>
                    <td><b>UNIT KERJA</b></td>
                    <td>:</td>
                    <td>'.$infoDpcp->NALOKL.'</td>
                </tr>
                <tr>
                    <td><b>PEMBAYARAN</b></td>
                    <td>:</td>
                    <td>'.$infoDpcp->NAMA_SPMU.'</td>
                </tr>
                <tr>
                    <td><b>B.U.P.</b></td>
                    <td>:</td>
                    <td>'.$infoDpcp->TMTPENSIUNYAD.'</td>
                </tr>
            </tbody>
        </table>
        <p style="text-align: center; font-size:14px;">
            <strong>DATA PERORANGAN CALON PENERIMA PENSIUN (DPCP) PEGAWAI NEGERI SIPIL YANG MENCAPAI BATAS USIA PENSIUN</strong></p>
        <p>
            <strong>1. <u>KETERANGAN PRIBADI</u></strong></p>
        <table border="0" cellpadding="1" cellspacing="1" width="100%">
            <tbody>
                <tr>
                    <td width="20px" style="text-align:center"><b>A.</b></td>
                    <td width="250px"><b>N A M A </b></td>
                    <td width="20px">: </td>
                    <td colspan="4">'.$infoDpcp->NAMA.'</td>
                    <td>&nbsp;</td>
                    <td width="20px" align="right">B.</td>
                    <td colspan="9"><b>NAMA ANAK-ANAK </b></td>
                </tr>
                <tr>
                    <td style="text-align:center"><b>B.</b></td>
                    <td><b>N I P / N R K</b></td>
                    <td>:</td>
                    <td colspan="4"> '.$infoDpcp->NIP18.' / '.$infoDpcp->NRK.'</td>
                    <td>&nbsp;</td>
                    <td width="20px"><b>NO.</b></td>
                    <td width="200px"><b>NAMA</b></td>
                    <td><b>TGL. LAHIR</b></td>
                    <td width="200px"><b>ANAK KANDUNG</b></td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center">C.</td>
                    <td><b>TEMPAT / TANGGAL LAHIR</b></td>
                    <td>:</td>
                    <td colspan="4">'.$infoDpcp->PATHIR.',&nbsp; '.$infoDpcp->TLHR.'</td>
                    <td>&nbsp;</td>

                    
                    <td style="text-align:center">1.</td>
                    <td>'.((isset($anak['NAMA-0'])) ? $anak['NAMA-0']: '-'  ).'</td>
                    <td>'.((isset($anak['TALHIR-0'])) ? $anak['TALHIR-0']: '-'  ).'</td>
                    <td>'.((isset($anak['NAHUBKEL-0'])) ? $anak['NAHUBKEL-0']: '-'  ).'</td>
                    <td rowspan="1" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center">D.</td>
                    <td><b>JABATAN / PEKERJAAN</b></td>
                    <td>:</td>
                    <td colspan="4" rowspan="1"><i>'.$infoUser->NAJABL.'</i></td>
                    <td rowspan="1">&nbsp;</td>

                    <td style="text-align:center" rowspan="1">2.</td>
                    <td>'.((isset($anak['NAMA-1'])) ? $anak['NAMA-1']: '-'  ).'</td>
                    <td>'.((isset($anak['TALHIR-1'])) ? $anak['TALHIR-1']: '-'  ).'</td>
                    <td>'.((isset($anak['NAHUBKEL-1'])) ? $anak['NAHUBKEL-1']: '-'  ).'</td>
                    <td rowspan="1" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center">E.</td>
                    <td><b>PANGKAT / GOL. RUANG</b></td>
                    <td>:</td>
                    <td colspan="2">'.$infoRiwKj->NAPANG.' &nbsp;&nbsp; / &nbsp;&nbsp; '.$infoRiwKj->GOL.'</td>
                    <td><b>TMT</b></td>
                    <td>'.$infoFirstPangkat->TMT.'</td>
                    <td>&nbsp;</td>

                    <td style="text-align:center">3.</td>
                    <td><i>'.((isset($anak['NAMA-2'])) ? $anak['NAMA-2']: '-'  ).'</i></td>
                    <td><i>'.((isset($anak['TALHIR-2'])) ? $anak['TALHIR-2']: '-'  ).'</i></td>
                    <td><i>'.((isset($anak['NAHUBKEL-2'])) ? $anak['NAHUBKEL-2']: '-'  ).'</i></td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center">F.</td>
                    <td><b>GAJI POKOK TERAKHIR</b></td>
                    <td>:</td>
                    <td colspan="3" rowspan="1"> &nbsp;  Rp. '.$gapok.'</td>
                    <td rowspan="1">&nbsp;</td>
                    <td rowspan="1">&nbsp;</td>
                    <td rowspan="1">&nbsp;</td>
                    <td rowspan="1">&nbsp;</td>
                    <td rowspan="1">&nbsp;</td>
                    <td rowspan="1">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center">G.</td>
                    <td><b>MASA KERJA GOLONGAN</b></td>
                    <td>:</td>
                    <td>'.$infoDpcp->THGOL.'  &nbsp;<b>TAHUN</b></td>
                    <td>'.$infoDpcp->BLGOL.' &nbsp;<b>BULAN</b></td>
                    <td width="87px"><b>PADA TANGGAL</b></td>
                    <td>'.$infoDpcp->TGSKGOL.' </td>
                    <td align="right" width="80px"><b>3.</b></td>
                    <td colspan="6"><b><u>ALAMAT</u></b></td>
                </tr>
                <tr>
                    <td style="text-align:center">H.</td>
                    <td><b>MASA KERJA PENSIUN</b></td>
                    <td>:</td>
                    <td>'.$infoDpcp->THMASKER.' &nbsp;<b>TAHUN</b></td>
                    <td>'.$infoDpcp->BLMASKER.' &nbsp;<b>BULAN</b></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td style="text-align:center">A.</td>
                    <td width="150px">ALAMAT SEKARANG</td>
                    <td width="20px">:</td>
                    <td colspan="5">JL. '.$infoDpcp->ALAMAT.'</td>
                </tr>
                <tr>
                    <td style="text-align:center">I.</td>
                    <td><b>MASA KERJA SEBELUM DIANGKAT SEBAGAI PNS</b></td>
                    <td>:</td>
                    <td></td>
                    <td></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>KELURAHAN</td>
                    <td width="20px">:</td>
                    <td width="130px">'.$infoDpcp->NAKEL.'</td>
                    <td width="30px">RT: </td>
                    <td>'.$infoDpcp->RT.'</td>
                    <td width="30px">RW: </td>
                    <td>'.$infoDpcp->RW.'</td>
                </tr>
                <tr>
                    <td style="text-align:center">J.</td>
                    <td><b>PENDIDIKAN SEBAGAI DASAR PENGANGKATAN PERTAMA</b></td>
                    <td>:</td>
                    <td>&nbsp;</td>
                    <td><b>LULUS TAHUN</b></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>KECAMATAN</td>
                    <td>:</td>
                    <td width="130px">'.$infoDpcp->NACAM.'</td>
                    <td width="70px">KAB/KODYA :</td>
                    <td width="130px">'.$infoDpcp->NAWIL.'</td>
                    <td width="70px">PROVINSI</td>
                    <td width="110px">'.$infoDpcp->PROPINSI.'</td>

                </tr>
                <tr>
                    <td style="text-align:center">K.</td>
                    <td><b>MULAI MASUK PNS</b></td>
                    <td>:</td>
                    <td rowspan="1">'.$infoDpcp->MUANG.'</td>
                    <td rowspan="1" colspan="5">&nbsp;</td>
                    <td rowspan="1">KODE POS</td>
                    <td rowspan="1" width="20px">:</td>
                    <td rowspan="1" width="130px"></td>
                    <td rowspan="1" colspan="3">&nbsp;</td>
                </tr>

                <tr>
                    <td rowspan="1" colspan="16">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center" rowspan="1"><b>2.</b></td>
                    <td colspan="7" rowspan="1"><b><u>KETERANGAN KELUARGA</u></b></td>
                    <td rowspan="1" style="text-align:center">B. </td>
                    <td rowspan="1">ALAMAT SESUDAH PENSIUN</td>
                    <td rowspan="1">:</td>
                    <td rowspan="1" colspan="5">&nbsp;</td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td colspan="7">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>KELURAHAN</td>
                    <td width="20px">:</td>
                    <td width="130px">&nbsp;</td>
                    <td width="30px">RT:</td>
                    <td width="90px">&nbsp;</td>
                    <td width="30px">RW:</td>
                    <td width="90px">&nbsp;</td>
                </tr>

                <tr>
                    <td style="text-align:center"> A.</td>
                    <td colspan="7"><b>NAMA SUAMI / ISTERI</b></td>
                    <td>&nbsp;</td>
                    <td>KECAMATAN</td>
                    <td width="20px">:</td>
                    <td width="130px">&nbsp;</td>
                    <td width="70px">KAB/KODYA :</td>
                    <td width="130px">&nbsp;</td>
                    <td width="70px">PROVINSI</td>
                    <td width="110px">&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="8">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>KODE POS</td>
                    <td width="20px">:</td>
                    <td width="130px">&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
                </tr>

                <tr>
                    <td align="center"><b>NO</b></td>
                    <td width="200px"><b>N A M A</b></td>
                    <td width="90px"><b>TGL LAHIR</b></td>
                    <td width="90px"><b>KAWIN TGL</b></td>
                    <td colspan="2"><b>SUAMI / ISTERI KE</b></td>
                    <td colspan="9"></td>
                </tr>
				';
                $no=1;
                
                for($i=1 ; $i<=3 ;$i++)
                {

        			$html.='<tr>	<td style="text-align:center">'.$no.'</td>';

        			
        			$cr = $infoIstriSuami->num_rows();
        			if($i > $infoIstriSuami->num_rows() )
        			{
        				for($j=1;$j<=$cr;$j++)
        				{
        				$html.='
        						<td></td>
			                    <td></td>
			                    <td></td>
			                    <td colspan="2"></td>
			                    <td colspan="9"></td>
        					';
        				}
        					        			}
        			
        			else
        			{
        				foreach($infoIstriSuami->result() as $r)
			        			{
			        $html.=     '<td>'.$r->NAMA.'</td>
			                    <td>'.$r->TALHIR.'</td>
			                    <td>'.$r->TGNIKAH.'</td>
			                    <td colspan="2">'.$r->NAHUBKEL.'</td>
			                    <td colspan="9">&nbsp;</td>
			                    ';
                        	
                				}
        			}
                				
                	$no++;
                $html.='</tr>';
            	}
                
                
        $html.= '
            </tbody>
        </table>
        <p style="text-align: right;">
            <strong><u>DENGAN INI SAYA MENYATAKAN TELAH MENGEMBALIKAN SELURUH BARANG INVENTARIS MILIK NEGARA</u></strong></p>
        <table border="0" cellpadding="1" cellspacing="1" width="100%">
            <tbody>
                <tr>
                    <td style="text-align: center;"><strong>MENGETAHUI:</strong></td>
                    <td colspan="3">&nbsp;</td>
                    
                    <td colspan="2" align="center" width="250px"><strong>JAKARTA , '.$today.'</strong></td>
                    
                </tr>
                <tr>
                    <td style="text-align: center;"><strong>PEJABAT KEPEGAWAIAN SKPD/UKPD</strong></td>
                    <td colspan="3">&nbsp;</td>
                    
                    <td colspan="2" rowspan="1" style="text-align: center;"><strong>PEGAWAI NEGERI SIPIL YANG BERSANGKUTAN</strong></td>
                </tr>
                <tr>
                    <td style="text-align: center;" rowspan="4" colspan="1"><p><img src="" height="65px" width="auto"></p></td>
                    <td colspan="3">&nbsp;</td>
                    <td colspan="2" rowspan="4"></td>
                </tr>
                
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>

                <tr>
                   <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align: center;"><strong>'.urldecode($v6).'</strong></td>
                    <td colspan="3">&nbsp;</td>
                    <td colspan="2" align="center"><strong>'.$infoDpcp->NAMA.'</strong></td>
                </tr>


                <tr>
                    <td align="center">NIP. &nbsp; <strong>'.urldecode($v7).'</strong></td>
                   <td colspan="3">&nbsp;</td>
                    <td colspan="2" rowspan="1" align="center"><strong>NIP. '.$infoDpcp->NIP18.'</strong></td>
                </tr>
            </tbody>
        </table>
        <p>
            &nbsp;</p>
    </body>
</html>
';
            
            $this->pdf_report2->writeHTML($html, true, false, true, false, '');
              ob_clean();          
            
            $this->pdf_report2->Output('pensiun.pdf', 'I');

    }



    //ALL PEGAWAI dpcp

    public function toPdf3($alldata,$res,$valnrk,$v6,$v7,$res3)
    {
       // $this->load->library('pdf');
        $this->load->library('pdf_report2');

        ob_start();
           //$this->pdf_report2= new pdf_report2('L', PDF_UNIT, 'A3',true, 'UTF-8', false);
           
           $this->pdf_report2->SetTitle('DPCP_'.$res.''); 
           // definisikan judul dokumen


            $this->pdf_report2->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
            // set header and footer fonts
            $this->pdf_report2->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $this->pdf_report2->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
           /* $this->pdf_report2->setPrintHeader(false);
            $this->pdf_report2->setPrintFooter(false);*/
            // set default monospaced font
            $this->pdf_report2->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $this->pdf_report2->SetMargins(PDF_MARGIN_LEFT, 50, PDF_MARGIN_RIGHT,FALSE);
            $this->pdf_report2->SetHeaderMargin(PDF_MARGIN_HEADER);
            $this->pdf_report2->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $this->pdf_report2->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $this->pdf_report2->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf_report2->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set font
            $this->pdf_report2->SetFont('helvetica', '', 8);

            // add a page
            
         //   $this->pdf_report2->AddPage();
          
           
           foreach ($alldata as $row) {
            
            $nrk = $row->NRK;

            /*$data['nrk'] = $nrk;
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
*/            
            $infoUser = $this->home->getUserInfo2($nrk);
            $data['infoUser'] = $infoUser;

            $infoUser3 = $this->home->getUserInfo3($nrk);
            $data['infoUser3'] = $infoUser3;

            $infoRiwKj = $this->home->getRiwayatKerjaPegawai($nrk);
            $data['infoRiwKj'] = $infoRiwKj;
            $gaji = number_format($infoRiwKj->GAPOK);

            $infoIstriSuami = $this->home->getIstriSuami($nrk);
            $data['infoIstriSuami'] = $infoIstriSuami;

            $issu = $infoIstriSuami->result_array();

            

            $infoAnak = $this->home->getAnakKandung($nrk);
            $data['infoAnak'] = $infoAnak;

            $bykAnak = $infoAnak->num_rows();

            $anak = array();
            if($bykAnak<=3)
            {
                foreach($infoAnak->result() as $row =>$val)
                {
                $anak['NAMA-'.$row] = $val->NAMA;
                $anak['TALHIR-'.$row] = $val->TALHIR;
                $anak['NAHUBKEL-'.$row] = $val->NAHUBKEL;
                }   
            }
            else
            {
                $i=1;
                if($i<=3)
                {
                    foreach($infoAnak->result() as $row =>$val)
                    {
                        $anak['NAMA-'.$row] = $val->NAMA;
                        $anak['TALHIR-'.$row] = $val->TALHIR;
                        $anak['NAHUBKEL-'.$row] = $val->NAHUBKEL;
                    }
                }
                else
                {
                    break;
                }
            }

            $tempPath = "assets/img/ttd/".$valnrk.".jpg";            
            

            $path = (file_exists($tempPath)) ? $tempPath : '';
            
            $today= date('d-m-Y');

            $infoPangkat = $this->home->getUserPangkat($nrk);
            $data['infoPangkat'] = $infoPangkat; 

            $infoFirstPangkat = $this->home->getFirstPangkat($nrk);
            $data['infoFirstPangkat'] = $infoFirstPangkat;

            $infoProp = $this->home->getPropCetakLaporan(9);
            $data['infoProp'] = $infoProp;

            $infoPbyr = $this->home->getInfoPembayaranLaporan('000000620');
            $data['infoPbyr'] = $infoPbyr;

            $thn="";

            $infoMinPangkat = $this->home->getMinGol($nrk);
            $data['infoMinPangkat'] = $infoMinPangkat;

            $infoMaxPangkat = $this->home->getMaxGol($nrk);
            $data['infoMaxPangkat'] = $infoMaxPangkat;

            // cek perubahan masa kerja berdasarkan golongan

            $golMin ="";
            $golMax ="";
            $ttmaskerNow = $infoRiwKj->TTMASKER;
            $tahunKerja="";
            
            $golFPangkatMin = $infoMinPangkat->GOL1; 
            $golFGapokMin = $infoMinPangkat->GOL2;

            if($golFGapokMin<=$golFPangkatMin)
            {
                $golMin = $golFGapokMin;
            }
            else
            {
                $golMin = $golFPangkatMin;
            }

            $golFPangkatMax = $infoMaxPangkat->GOL1; 
            $golFGapokMax = $infoMaxPangkat->GOL2; 

            if($golFGapokMax >= $golFPangkatMax)
            {
                $golMax = $golFGapokMax;
            }
            else
            {
                $golMax = $golFPangkatMax;
            }

            
            if($golMin == 1 & $golMax ==2)
            {

                $tahunKerja = $ttmaskerNow + 6 ;
            }
            else if(($golMin == 1 && $golMax == 3) || ($golMin == 1 && $golMax == 4))
            {
                $tahunKerja = $ttmaskerNow + 11;
            }
            else if(($golMin == 2 & $golMax == 3) || ($golMin == 2 & $golMax == 4))
            {
                $tahunKerja = $ttmaskerNow + 5;
            }
            else 
            {
                $tahunKerja = $ttmaskerNow;
            }
            // end cek masker golongan
			
			

            $tgproduksi = date('01-m-Y');
            
                $infoDpcp = $this->report->queryDPCP($res,$nrk,$res3);
                $data['infoDpcp'] = $infoDpcp;
                $gapok = number_format($infoDpcp->GAPOK);
				
				$nipshow;
				if($infoDpcp->NIP18=="")
				{
					$nipshow=$infoDpcp->NIP18;
				}
				else
				{
					$nipshow=$infoDpcp->NIP;
				}
                $html="";

                $html.= '
        <br/><br/><br/><br/>
        <table border="0" cellpadding="1" cellspacing="1" style="width: 500px;">
            <tbody>
                <tr>
                    <td width="100px"><b>INSTANSI INDUK</b></td>
                    <td width="50px">:</td>
                    <td width="350px">PEMDA &nbsp; '.$infoProp->KETERANGAN.'</td>
                </tr>
                <tr>
                    <td><b>PROVINSI</b></td>
                    <td>:</td>
                    <td>'.$infoProp->KETERANGAN.'</td>
                </tr>
                <tr>
                    <td><b>KAB/KODYA</b></td>
                    <td>:</td>
                    <td> - </td>
                </tr>
                <tr>
                    <td><b>UNIT KERJA</b></td>
                    <td>:</td>
                    <td>'.$infoDpcp->NALOKL.'</td>
                </tr>
                <tr>
                    <td><b>PEMBAYARAN</b></td>
                    <td>:</td>
                    <td>BADAN PENGELOLA KEUANGAN DAN ASET DAERAH</td>
                </tr>
                <tr>
                    <td><b>B.U.P.</b></td>
                    <td>:</td>
                    <td>'.$infoDpcp->TMTPENSIUNYAD.'</td>
                </tr>
            </tbody>
        </table>
        <p style="text-align: center; font-size:14px;">
            <strong>DATA PERORANGAN CALON PENERIMA PENSIUN (DPCP) PEGAWAI NEGERI SIPIL YANG MENCAPAI BATAS USIA PENSIUN</strong></p>
        <p>
            <strong>1. <u>KETERANGAN PRIBADI</u></strong></p>
        <table border="0" cellpadding="1" cellspacing="1" width="100%">
            <tbody>
                <tr>
                    <td width="20px" style="text-align:center"><b>A.</b></td>
                    <td width="250px"><b>N A M A </b></td>
                    <td width="20px">: </td>
                    <td colspan="4">'.$infoDpcp->NAMA.'</td>
                    <td>&nbsp;</td>
                    <td width="20px" align="right">B.</td>
                    <td colspan="9"><b>NAMA ANAK-ANAK </b></td>
                </tr>
                <tr>
                    <td style="text-align:center"><b>B.</b></td>
                    <td><b>N I P / N R K</b></td>
                    <td>:</td>
                    <td colspan="4"> '.$infoDpcp->NIP18.' / '.$infoDpcp->NRK.' </td>
                    <td>&nbsp;</td>
                    <td width="20px"><b>NO.</b></td>
                    <td width="200px"><b>NAMA</b></td>
                    <td><b>TGL. LAHIR</b></td>
                    <td width="200px"><b>ANAK KANDUNG</b></td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center">C.</td>
                    <td><b>TEMPAT / TANGGAL LAHIR</b></td>
                    <td>:</td>
                    <td colspan="4">'.$infoDpcp->PATHIR.',&nbsp; '.$infoDpcp->TLHR.'</td>
                    <td>&nbsp;</td>

                    
                    <td style="text-align:center">1.</td>
                    <td>'.((isset($anak['NAMA-0'])) ? $anak['NAMA-0']: '-'  ).'</td>
                    <td>'.((isset($anak['TALHIR-0'])) ? $anak['TALHIR-0']: '-'  ).'</td>
                    <td>'.((isset($anak['NAHUBKEL-0'])) ? $anak['NAHUBKEL-0']: '-'  ).'</td>
                    <td rowspan="1" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center">D.</td>
                    <td><b>JABATAN / PEKERJAAN</b></td>
                    <td>:</td>
                    <td colspan="4" rowspan="1">'.$infoUser->NAJABL.'</td>
                    <td rowspan="1">&nbsp;</td>

                    <td style="text-align:center" rowspan="1">2.</td>
                    <td>'.((isset($anak['NAMA-1'])) ? $anak['NAMA-1']: '-'  ).'</td>
                    <td>'.((isset($anak['TALHIR-1'])) ? $anak['TALHIR-1']: '-'  ).'</td>
                    <td>'.((isset($anak['NAHUBKEL-1'])) ? $anak['NAHUBKEL-1']: '-'  ).'</td>
                    <td rowspan="1" colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center">E.</td>
                    <td><b>PANGKAT / GOL. RUANG</b></td>
                    <td>:</td>
                    <td colspan="2">'.$infoRiwKj->NAPANG.' &nbsp;&nbsp; / &nbsp;&nbsp; '.$infoRiwKj->GOL.'</td>
                    <td><b>TMT</b></td>
                    <td>'.$infoFirstPangkat->TMT.'</td>
                    <td>&nbsp;</td>

                    <td style="text-align:center">3.</td>
                    <td>'.((isset($anak['NAMA-2'])) ? $anak['NAMA-2']: '-'  ).'</td>
                    <td>'.((isset($anak['TALHIR-2'])) ? $anak['TALHIR-2']: '-'  ).'</td>
                    <td>'.((isset($anak['NAHUBKEL-2'])) ? $anak['NAHUBKEL-2']: '-'  ).'</td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center">F.</td>
                    <td><b>GAJI POKOK TERAKHIR</b></td>
                    <td>:</td>
                    <td colspan="3" rowspan="1"> &nbsp;  Rp. '.$gapok.'</td>
                    <td rowspan="1">&nbsp;</td>
                    <td rowspan="1">&nbsp;</td>
                    <td rowspan="1">&nbsp;</td>
                    <td rowspan="1">&nbsp;</td>
                    <td rowspan="1">&nbsp;</td>
                    <td rowspan="1">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center">G.</td>
                    <td><b>MASA KERJA GOLONGAN</b></td>
                    <td>:</td>
                    <td>'.$infoDpcp->THGOL.'  &nbsp;<b>TAHUN</b></td>
                    <td>'.$infoDpcp->BLGOL.' &nbsp;<b>BULAN</b></td>
                    <td width="87px"><b>PADA TANGGAL</b></td>
                    <td>'.$infoDpcp->TGSKGOL.' </td>
                    <td align="right" width="80px"><b>3.</b></td>
                    <td colspan="6"><b><u>ALAMAT</u></b></td>
                </tr>
                <tr>
                    <td style="text-align:center">H.</td>
                    <td><b>MASA KERJA PENSIUN</b></td>
                    <td>:</td>
                    <td>'.$infoDpcp->THMASKER.' &nbsp;<b>TAHUN</b></td>
                    <td>'.$infoDpcp->BLMASKER.' &nbsp;<b>BULAN</b></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td style="text-align:center">A.</td>
                    <td width="150px">ALAMAT SEKARANG</td>
                    <td width="20px">:</td>
                    <td colspan="5">'.$infoDpcp->ALAMAT.'</td>
                </tr>
                <tr>
                    <td style="text-align:center">I.</td>
                    <td><b>MASA KERJA SEBELUM DIANGKAT SEBAGAI PNS</b></td>
                    <td>:</td>
                    <td><b>DARI</b></td>
                    <td><b>S/D</b></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>KELURAHAN</td>
                    <td width="20px">:</td>
                    <td width="130px">'.$infoDpcp->NAKEL.'</td>
                    <td width="30px">RT: </td>
                    <td>'.$infoDpcp->RT.'</td>
                    <td width="30px">RW: </td>
                    <td>'.$infoDpcp->RW.'</td>
                </tr>
                <tr>
                    <td style="text-align:center">J.</td>
                    <td><b>PENDIDIKAN SEBAGAI DASAR PENGANGKATAN PERTAMA</b></td>
                    <td>:</td>
                    <td>&nbsp;</td>
                    <td><b>LULUS TAHUN</b></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>KECAMATAN</td>
                    <td>:</td>
                    <td width="130px">'.$infoDpcp->NACAM.'</td>
                    <td width="70px">KAB/KODYA :</td>
                    <td width="130px">'.$infoDpcp->NAWIL.'</td>
                    <td width="70px">PROVINSI</td>
                    <td width="110px">'.$infoDpcp->PROPINSI.'</td>

                </tr>
                <tr>
                    <td style="text-align:center">K.</td>
                    <td><b>MULAI MASUK PNS</b></td>
                    <td>:</td>
                    <td rowspan="1">'.$infoDpcp->MUANG.'</td>
                    <td rowspan="1" colspan="5">&nbsp;</td>
                    <td rowspan="1">KODE POS</td>
                    <td rowspan="1" width="20px">:</td>
                    <td rowspan="1" width="130px"></td>
                    <td rowspan="1" colspan="3">&nbsp;</td>
                </tr>

                <tr>
                    <td rowspan="1" colspan="16">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center" rowspan="1"><b>2.</b></td>
                    <td colspan="7" rowspan="1"><b><u>KETERANGAN KELUARGA</u></b></td>
                    <td rowspan="1" style="text-align:center">B. </td>
                    <td rowspan="1">ALAMAT SESUDAH PENSIUN</td>
                    <td rowspan="1">:</td>
                    <td rowspan="1" colspan="5">&nbsp;</td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td colspan="7">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>KELURAHAN</td>
                    <td width="20px">:</td>
                    <td width="130px">&nbsp;</td>
                    <td width="30px">RT:</td>
                    <td width="90px">&nbsp;</td>
                    <td width="30px">RW:</td>
                    <td width="90px">&nbsp;</td>
                </tr>

                <tr>
                    <td style="text-align:center"> A.</td>
                    <td colspan="7"><b>NAMA SUAMI / ISTERI</b></td>
                    <td>&nbsp;</td>
                    <td>KECAMATAN</td>
                    <td width="20px">:</td>
                    <td width="130px">&nbsp;</td>
                    <td width="70px">KAB/KODYA :</td>
                    <td width="130px">&nbsp;</td>
                    <td width="70px">PROVINSI</td>
                    <td width="110px">&nbsp;</td>
                </tr>

                <tr>
                    <td colspan="8">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>KODE POS</td>
                    <td width="20px">:</td>
                    <td width="130px">&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
                </tr>

                <tr>
                    <td align="center"><b>NO</b></td>
                    <td width="200px"><b>N A M A</b></td>
                    <td width="90px"><b>TGL LAHIR</b></td>
                    <td width="90px"><b>KAWIN TGL</b></td>
                    <td colspan="2"><b>SUAMI / ISTERI KE</b></td>
                    <td colspan="9"></td>
                </tr>
                ';
                $no=1;

                $k= 0;
                
                for($i=1 ; $i<=3 ;$i++)
                {

                    $html.='<tr>    <td style="text-align:center">'.$no.'</td>';
                    
                    $cr = $infoIstriSuami->num_rows();
                    if($i > $infoIstriSuami->num_rows() )
                    {
                        for($j=1;$j<=$cr;$j++)
                        {
                        $html.='
                                <td></td>
                                <td></td>
                                <td></td>
                                <td colspan="2"></td>
                                <td colspan="9"></td>
                            ';
                        }
                                                }
                    
                    else
                    {
                        
                                
                    $html.=     '<td>'.$issu[$k]['NAMA'].'</td>
                                <td>'.$issu[$k]['TALHIR'].'</td>
                                <td>'.$issu[$k]['TGNIKAH'].'</td>
                                <td colspan="2">'.$issu[$k]['NAHUBKEL'].'</td>
                                <td colspan="9">&nbsp;</td>
                                ';
                            
                                
                    }
                                
                    $no++;
                    $k++;
                $html.='</tr>';
                }
               
                
        $html.= '
            </tbody>
        </table>
        <p style="text-align: right;">
            <strong><u>DENGAN INI SAYA MENYATAKAN TELAH MENGEMBALIKAN SELURUH BARANG INVENTARIS MILIK NEGARA</u></strong></p>
        <table border="0" cellpadding="1" cellspacing="1" width="100%">
            <tbody>
                <tr>
                    <td style="text-align: center;"><strong>MENGETAHUI:</strong></td>
                    <td colspan="3">&nbsp;</td>
                    
                    <td colspan="2" align="center" width="250px"><strong>JAKARTA , '.$today.'</strong></td>
                    
                </tr>
                <tr>
                    <td style="text-align: center;"><strong>PEJABAT KEPEGAWAIAN SKPD/UKPD</strong></td>
                    <td colspan="3">&nbsp;</td>
                    
                    <td colspan="2" rowspan="1" style="text-align: center;"><strong>PEGAWAI NEGERI SIPIL YANG BERSANGKUTAN</strong></td>
                </tr>
                <tr>
                    <td style="text-align: center;" rowspan="4" colspan="1"></td>
                    <td colspan="3">&nbsp;</td>
                    <td colspan="2" rowspan="4"></td>
                </tr>
                
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>

                <tr>
                   <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align: center;"><strong>'.urldecode($v6).'</strong></td>
                    <td colspan="3">&nbsp;</td>
                    <td colspan="2" align="center"><strong>'.$infoDpcp->NAMA.'</strong></td>
                </tr>


                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>NIP. '.$v7.' </strong></td>
                   <td colspan="3">&nbsp;</td>
                    <td colspan="2" rowspan="1" align="center"><strong>NIP. '.$nipshow.'</strong></td>
                </tr>
            </tbody>
        </table>
       
  
';
           
            $this->pdf_report2->AddPage();
            $this->pdf_report2->writeHTML($html, true, false, true, false, '');
             $this->pdf_report2->lastPage();

            }
            
              ob_clean();          
            
            $this->pdf_report2->Output('pensiun.pdf', 'I');

    } 



    public function toPdf4($alldata,$res,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$valnrk,$res3)
    {
       
        $this->load->library('pdf_report');
        ob_start();
  
           $this->pdf_report->SetTitle('BERKALA'); 
           // definisikan judul dokumen


            $this->pdf_report->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
            // set header and footer fonts
            $this->pdf_report->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $this->pdf_report->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $this->pdf_report->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $this->pdf_report->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $this->pdf_report->SetHeaderMargin(PDF_MARGIN_HEADER);
            $this->pdf_report->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $this->pdf_report->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $this->pdf_report->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf_report->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set font
            $this->pdf_report->SetFont('helvetica', '', 8);

            // add a page
            //$this->pdf_report->AddPage();

           $this->pdf_report->Cell(0, 0, '', 2, 1, 'C', 0, '', 0);
           $this->pdf_report->Cell(0, 0, '', 2, 1, 'C', 0, '', 0);
           $this->pdf_report->Cell(0, 0, '', 2, 1, 'C', 0, '', 0);
           $this->pdf_report->Cell(0, 0, '', 2, 1, 'C', 0, '', 0);
           $this->pdf_report->Cell(0, 0, '', 2, 1, 'C', 0, '', 0);
           $this->pdf_report->Cell(0, 0, '', 2, 1, 'C', 0, '', 0);
           


           foreach($alldata as $row)
           {
            
            $nrk = $row->NRK;
            
            
            $infoUser = $this->home->getUserInfo2($nrk);
            
            $data['infoUser'] = $infoUser;
            

           // $infoPangkat = $this->home->getUserPangkat($nrk);
            //$data['infoPangkat'] = $infoPangkat; 


            $thn="";

            $tempPath = "assets/img/ttd/".$valnrk.".jpg";            

            $path = (file_exists($tempPath)) ? $tempPath : '';

                $infoBkl = $this->report->queryBerkala($res,$nrk,$res3);
                $data['infoBkl'] = $infoBkl;
                $thn= substr($infoBkl->MASKER, 0,2);
                $gaji_lama = number_format($infoBkl->GJLAMA);
                $gaji_baru = number_format($infoBkl->GJBARU);
                //$next_bkl = date('d-m-Y', strtotime('+2 year', strtotime( $infoBkl->MUGAD )));
                
            
            
            
            $mugd = $this->convert->tgl_indo($infoBkl->MUGAD);
            $data['mugd'] = $mugd;

            $tlhr = $this->convert->tgl_indo($infoBkl->TALHIR);
            $data['tlhr'] = $tlhr;

            
            $next_berkala = $this->convert->tgl_indo($infoBkl->NEXT_BRKALA);
            $data['next_berkala'] = $next_berkala;  

            $html = '<html>
					    <head>
					        <title></title>
					    </head>
					    <body>
						
					    	<br/><br/><br/>
					        <table cellpadding="1" cellspacing="1" width="100%">
					            <tbody>
					                <tr>
					                    <td width="10%">&nbsp;</td>
					                    <td width="5%">&nbsp;</td>
					                    <td width="25%">&nbsp;</td>
					                    <td style="text-align: right;" width="35%">Jakarta,</td>
					                    <td width="25%"><strong>'.$mugd.'</strong></td>
					                </tr>
					                <tr>
					                    <td width="10%">Nomor</td>
					                    <td>:</td>
					                    <td>'.$infoBkl->NOSKGOL.'</td>
					                    <td style="text-align: right;">Kepada,</td>
					                    <td>&nbsp;</td>
					                </tr>
					                <tr>
					                    <td>Sifat</td>
					                    <td>:</td>
					                    <td>PENTING</td>
					                    <td style="text-align: right;">Yth.</td>
					                    <td rowspan="2"><strong>'.urldecode($v1).'</strong></td>
					                </tr>
					                <tr>
					                    <td>Lampiran</td>
					                    <td>:</td>
					                    <td>-</td>
					                    <td>&nbsp;</td>
					                    
					                </tr>
					                <tr>
					                    <td>Hal</td>
					                    <td>:</td>
					                    <td><strong>KENAIKAN GAJI BERKALA</strong></td>
					                    <td>&nbsp;</td>
					                    <td>Provinsi DKI Jakarta</td>
					                </tr>
					                <tr>
					                    <td>&nbsp;</td>
					                    <td>&nbsp;</td>
					                    <td>&nbsp;</td>
					                    <td>&nbsp;</td>
					                    <td>di -</td>
					                </tr>
					                <tr>
					                    <td>&nbsp;</td>
					                    <td>&nbsp;</td>
					                    <td>&nbsp;</td>
					                    <td>&nbsp;</td>
					                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;J A K A R T A</td>
					                </tr>
					            </tbody>
					        </table>
					        <p>
					            &nbsp;</p>
					            <p>
					            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dengan ini diberitahukan, bahwa berhubung dengan telah dipenuhinya masa kerja dan syarat-syarat lainnya kepada: </p>
					        
					        <table cellpadding="1" cellspacing="1" style="width: 800px;">
					            <tbody>
					                <tr>
					                    <td width="10%">&nbsp;</td>
					                    <td width="5%" align="center">1.</td>
					                    <td width="20%">Nama / Tanggal Lahir</td>
					                    <td width="5%">:</td>
					                    <td width="30%"> '.$infoBkl->NAMA.' <b>&nbsp;&nbsp;/&nbsp;&nbsp;</b> '.$tlhr.' </td>
					                </tr>
					                <tr>
					                    <td width="10%">&nbsp;</td>
					                    <td width="5%" align="center">2.</td>
					                    <td>N I P / N R K</td>
					                    <td>:</td>
					                    <td> '.$infoBkl->NIP18.' <b>&nbsp;&nbsp;/&nbsp;&nbsp;</b>  '.$infoBkl->NRK.' </td>
					                </tr>
					                <tr>
					                    <td width="10%">&nbsp;</td>
					                    <td width="5%" align="center">3.</td>
					                    <td>Pangkat / Golongan</td>
					                    <td>:</td>
					                    <td>'.$infoBkl->PATHIR.' <b>&nbsp;&nbsp;/&nbsp;&nbsp;</b>  '.$infoBkl->KODIK.'</td>
					                </tr>
					                <tr>
					                    <td width="10%">&nbsp;</td>
					                    <td width="5%" align="center">4.</td>
					                    <td>Kantor / Tempat</td>
					                    <td>:</td>
					                    <td>'.$infoBkl->KANTOR.'</td>
					                </tr>
					                <tr>
					                    <td width="10%">&nbsp;</td>
					                    <td width="5%" align="center">5.</td>
					                    <td>Gaji Pokok Lama</td>
					                    <td>:</td>
					                    <td>Rp. &nbsp;&nbsp;'.$gaji_lama.'</td>
					                </tr>
					                <tr>
					                    <td width="10%">&nbsp;</td>
					                    <td width="5%" align="center">&nbsp;</td>
					                    <td colspan="3" rowspan="1">
					                        (atas dasar SKP terakhir gaji / pangkat yang ditetapkan);</td>
					                </tr>
					                <tr>
					                    <td width="10%">&nbsp;</td>
					                    <td width="5%" align="center">&nbsp;</td>
					                    <td colspan="3">
					                        kepadanya dapat diberikan kenaikan gaji berkala hingga memperoleh:</td>
					                </tr>
					                <tr>
					                    <td width="10%">&nbsp;</td>
					                    <td width="5%" align="center">6.</td>
					                    <td>Gaji Pokok Baru</td>
					                    <td>:</td>
					                    <td>Rp. &nbsp;&nbsp;'.$gaji_baru.'</td>
					                </tr>
					                <tr>
					                    <td width="10%">&nbsp;</td>
					                    <td width="5%" align="center">7.</td>
					                    <td>Berdasarkan Masa Kerja</td>
					                    <td>:</td>
					                    <td>'.$thn.' TAHUN </td>
					                </tr>
					                <tr>
					                    <td width="10%">&nbsp;</td>
					                    <td width="5%" align="center">8.</td>
					                    <td>Dalam Golongan</td>
					                    <td>:</td>
					                    <td>'.$infoBkl->PATHIR.'<b>&nbsp;&nbsp;/&nbsp;&nbsp;</b> '.$infoBkl->KODIK.'</td>
					                </tr>
					                <tr>
					                    <td width="10%">&nbsp;</td>
					                    <td width="5%" align="center">9.</td>
					                    <td>Mulai Tanggal</td>
					                    <td>:</td>
					                    <td>'.$mugd.'</td>
					                </tr>
					                <tr>
					                    <td width="10%">&nbsp;</td>
					                    <td width="5%" align="center">10.</td>
					                    <td>Hubungan Dinas</td>
					                    <td>:</td>
					                    <td>'.$infoBkl->HUB_DINAS.'</td>
					                </tr>
					                <tr>
					                    <td width="10%">&nbsp;</td>
					                    <td width="5%" align="center">11.</td>
					                    <td>Kenaikan Gaji yang akan datang</td>
					                    <td>:</td>
					                    <td>'.$next_berkala.'</td>
					                </tr>
					                <tr>
					                    <td width="10%">&nbsp;</td>
					                    <td width="5%" align="center">12.</td>
					                    <td>Pendidikan</td>
					                    <td>:</td>
					                    <td>'.$infoBkl->MSKGOL.'</td>
					                </tr>
					            </tbody>
					        </table>

					        <p align="justify">
					            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Diharapkan kepada pegawai tersebut dapat dibayarkan penghasilannya berdasarkan Peraturan Pemerintah Nomor 7 Tahun 1977 sebagaimana telah beberapa kali diubah terakhir dengan Peraturan Pemerintah Nomor '.$v2.' Tahun '.$v3.' Tentang Perubahan '.$v4.' Atas Peraturan Pemerintah Nomor 7 Tahun 1977 Tentang Peraturan Gaji PNS.</p>
					        <table border="0" cellpadding="1" cellspacing="1" width="100%">
					            <tbody>
					                <tr>
					                    <td>
					                        &nbsp;</td>
					                    <td style="text-align: center;">
					                        <strong>a.n. GUBERNUR PROVINSI DAERAH KHUSUS </strong></td>
					                </tr>
					                <tr>
					                    <td>
					                        &nbsp;</td>
					                    <td style="text-align: center;">
					                        <strong>IBUKOTA JAKARTA</strong></td>
					                </tr>
					                <tr>
					                    <td>
					                        &nbsp;</td>
					                    <td style="text-align: center;">
					                        '.urldecode($v5).',</td>
					                </tr>
					                <tr>
					                    <td>
					                        &nbsp;</td>
					                    <td style="text-align: center;">
					                        <img src="'.$path.'" height="75px" width="auto">
					                        
					                    </td>
					                </tr>
					                <tr>
					                    <td>&nbsp;</td>
					                     <td style="text-align: center;">
                                            '.urldecode($v6).'</td>
					                </tr>
					                
					                <tr>
					                    <td>&nbsp;</td>
					                    <td style="text-align: center;">
					                        NIP : '.$v7.'</td>
					                </tr>
					            </tbody>
					        </table>
					        <table border="0" cellpadding="1" cellspacing="1" style="width: 100%;">
					            <tbody>
                                    <tr>
                                        <td width="5%" align="center">
                                            <span style="font-size:9px;">&nbsp;</span></td>
                                        <td><strong>TEMBUSAN:</strong></td>
                                    </tr>
					                <tr>
					                    <td width="5%" align="center">
					                        <span style="font-size:9px;">1.</span></td>
					                    <td>
					                        <span style="font-size:9px;">Kepala '.$infoBkl->KANTOR.'</span></td>
					                </tr>
					                <tr>
					                    <td width="5%" align="center">
					                        <span style="font-size:9px;">2.</span></td>
					                    <td>
					                        <span style="font-size:9px;">Kepala Bidang Pengedalian Kepegawaian BKD Provinsi DKI Jakarta</span></td>
					                </tr>
					                <tr>
					                    <td width="5%" align="center">
					                        <span style="font-size:9px;">3.</span></td>
					                    <td>
					                        <span style="font-size:9px;">Pegawai yang bersangkutan</span></td>
					                </tr>
					            </tbody>
					        </table>
					        <p>
					            &nbsp;</p>
					    </body>
					</html>';
                    //var_dump($html);exit;
			
            $this->pdf_report->AddPage();
            $this->pdf_report->writeHTML($html, true, false, true, false, '');
            $this->pdf_report->lastPage();
           }
            
             ob_clean();          
            
            $this->pdf_report->Output('berkala.pdf', 'I');

    }


    function cetakAllBERKALA($THBL) {
        
        $v1s = $this->uri->segment(4, 0);
        $v1=urldecode($v1s);
        
        $v2s = $this->uri->segment(5, 0);
        $v2=urldecode($v2s);

        $v3s = $this->uri->segment(6, 0);
        $v3=urldecode($v3s);

        $v4s = $this->uri->segment(7, 0);
        $v4=urldecode($v4s);

        $v5s = $this->uri->segment(8, 0);
        $v5=urldecode($v5s);

        $v6s = $this->uri->segment(9, 0);
        $v6=urldecode($v6s);

        $v7s = $this->uri->segment(10, 0);
        $v7=urldecode($v7s);

        $valnrk = $this->uri->segment(11, 0);

        
        require "http://10.15.34.34:8080/JavaBridge/java/Java.inc";

        $system = new Java('java.lang.System');

        $class = new JavaClass("java.lang.Class");

        $class->forName("oracle.jdbc.driver.OracleDriver");

        $driverManager = new JavaClass("java.sql.DriverManager");

        
        $conn = $driverManager->getConnection("jdbc:oracle:thin:@//10.15.34.29:1521/SIMPEG", "simpeg", "p102simp");

        $compileManager = new JavaClass("net.sf.jasperreports.engine.JasperCompileManager");

        // <*untuk menghilangkan Undefined property: java_Client::$cancelProxyCreationTag
        $compileManager->__client->cancelProxyCreationTag = 0;
        // *>
        $viewer = new JavaClass("net.sf.jasperreports.view.JasperViewer");
        $folderPath = realpath(".") . "/public/report/";

        $report = $compileManager->compileReport($folderPath . "newberkala.jrxml");

        $fillManager = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");
        $params = new Java("java.util.HashMap");
        $params->put("THBL", $THBL);
        $params->put("v1", $v1);
        $params->put("v2", $v2);
        $params->put("v3", $v3);
        $params->put("v4", $v4);
        $params->put("v5", $v5);
        $params->put("v6", $v6);
        $params->put("v7", $v7);
        $params->put("valnrk", $valnrk);
       
        

        $emptyDataSource = new Java("net.sf.jasperreports.engine.JREmptyDataSource");

        $runmanager = new Java("net.sf.jasperreports.engine.JasperRunManager");

        
        $jasperPrint = $fillManager->fillReport($report, $params, $conn);
        
        $filename = "newberkala.pdf";
        $outputPath = realpath(".") . "/assets/pdf/" . $filename;

        $exporter = new Java("net.sf.jasperreports.engine.export.JRPdfExporter");

        $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
        $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);

        $exportManager = new JavaClass("net.sf.jasperreports.engine.JasperExportManager");

        $exporter->exportReport();

        // $path = './path/to/file.pdf';

        if (file_exists($outputPath)) {
            // echo "Create PDF berhasil." . $outputPath;
            // if ($dwl == 1) {
            //  $this->load->helper('download');
            //  force_download($outputPath, NULL);
            // } else {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename=' . $filename);
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');

            readfile($outputPath);
            //unlink($outputPath);
            // }

        } else {
            echo "Create PDF gagal.";
        }

    } 

function cetakBerkalaSPMU($THBL) {
        
        $v1s = $this->uri->segment(4, 0);
        $v1=urldecode($v1s);
        
        $v2s = $this->uri->segment(5, 0);
        $v2=urldecode($v2s);

        $v3s = $this->uri->segment(6, 0);
        $v3=urldecode($v3s);

        $v4s = $this->uri->segment(7, 0);
        $v4=urldecode($v4s);

        $v5s = $this->uri->segment(8, 0);
        $v5=urldecode($v5s);

        $v6s = $this->uri->segment(9, 0);
        $v6=urldecode($v6s);

        $v7s = $this->uri->segment(10, 0);
        $v7=urldecode($v7s);

        $valnrk = $this->uri->segment(11, 0);

        $spmu = $this->uri->segment(12,0);

        
        require "http://10.15.34.33:8080/JavaBridge/java/Java.inc";

        $system = new Java('java.lang.System');

        $class = new JavaClass("java.lang.Class");

        $class->forName("oracle.jdbc.driver.OracleDriver");

        $driverManager = new JavaClass("java.sql.DriverManager");

        
        $conn = $driverManager->getConnection("jdbc:oracle:thin:@//10.15.34.29:1521/SIMPEG", "simpeg", "p102simp");

        $compileManager = new JavaClass("net.sf.jasperreports.engine.JasperCompileManager");

        // <*untuk menghilangkan Undefined property: java_Client::$cancelProxyCreationTag
        $compileManager->__client->cancelProxyCreationTag = 0;
        // *>
        $viewer = new JavaClass("net.sf.jasperreports.view.JasperViewer");
        $folderPath = realpath(".") . "/public/report/";

        $report = $compileManager->compileReport($folderPath . "newberkalaspmu.jrxml");

        $fillManager = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");
        $params = new Java("java.util.HashMap");
        $params->put("THBL", $THBL);
        $params->put("v1", $v1);
        $params->put("v2", $v2);
        $params->put("v3", $v3);
        $params->put("v4", $v4);
        $params->put("v5", $v5);
        $params->put("v6", $v6);
        $params->put("v7", $v7);
        $params->put("valnrk", $valnrk);
        $params->put("SPMU", $spmu);
        

        $emptyDataSource = new Java("net.sf.jasperreports.engine.JREmptyDataSource");

        $runmanager = new Java("net.sf.jasperreports.engine.JasperRunManager");

        
        $jasperPrint = $fillManager->fillReport($report, $params, $conn);
        
        $filename = "newberkalaspmu.pdf";
        $outputPath = realpath(".") . "/assets/pdf/" . $filename;
        
        	
        

        $exporter = new Java("net.sf.jasperreports.engine.export.JRPdfExporter");

        $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
        $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);

        $exportManager = new JavaClass("net.sf.jasperreports.engine.JasperExportManager");

        $exporter->exportReport();

        // $path = './path/to/file.pdf';

        if (file_exists($outputPath)) {
            // echo "Create PDF berhasil." . $outputPath;
            // if ($dwl == 1) {
            //  $this->load->helper('download');
            //  force_download($outputPath, NULL);
            // } else {
        	header("Cache-Control: no-store, no-cache, must-revalidate"); //HTTP 1.1
  			header("Pragma: no-cache"); //HTTP 1.0
  			header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename=' . $filename);
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');

            readfile($outputPath);
            
            // }

        } else {
            echo "Create PDF gagal.";
        }

    }  

    function cetakAllDPCP($THPENSIUN) {
    	
    	

    	
		$valnrk = $this->uri->segment(4, 0);
		$v6 = $this->uri->segment(5, 0);
		$v7 = $this->uri->segment(6, 0);
		
		
		require "http://10.15.34.34:8080/JavaBridge/java/Java.inc";

		$system = new Java('java.lang.System');

		$class = new JavaClass("java.lang.Class");

		$class->forName("oracle.jdbc.driver.OracleDriver");

		$driverManager = new JavaClass("java.sql.DriverManager");

		
		$conn = $driverManager->getConnection("jdbc:oracle:thin:@//10.15.34.29:1521/SIMPEG", "simpeg", "p102simp");

		$compileManager = new JavaClass("net.sf.jasperreports.engine.JasperCompileManager");

		// <*untuk menghilangkan Undefined property: java_Client::$cancelProxyCreationTag
		$compileManager->__client->cancelProxyCreationTag = 0;
		// *>
		$viewer = new JavaClass("net.sf.jasperreports.view.JasperViewer");
		$folderPath = realpath(".") . "/public/report/";

		$report = $compileManager->compileReport($folderPath . "newdpcp.jrxml");

		$fillManager = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");
		$params = new Java("java.util.HashMap");
		$params->put("THPENSIUN", $THPENSIUN);
		
		$params->put("valnrk", $valnrk);
		$params->put("v1", $v6);
		$params->put("v2", $v7);
		
	   
		

		$emptyDataSource = new Java("net.sf.jasperreports.engine.JREmptyDataSource");

		$runmanager = new Java("net.sf.jasperreports.engine.JasperRunManager");

        
		$jasperPrint = $fillManager->fillReport($report, $params, $conn);
        
		$filename = "newdpcp.pdf";
		$outputPath = realpath(".") . "/assets/pdf/" . $filename;

		$exporter = new Java("net.sf.jasperreports.engine.export.JRPdfExporter");

		$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
		$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);

		$exportManager = new JavaClass("net.sf.jasperreports.engine.JasperExportManager");

		$exporter->exportReport();

		// $path = './path/to/file.pdf';

		if (file_exists($outputPath)) {
			// echo "Create PDF berhasil." . $outputPath;
			// if ($dwl == 1) {
			// 	$this->load->helper('download');
			// 	force_download($outputPath, NULL);
			// } else {
			header('Content-Type: application/pdf');
			header('Content-Disposition: inline; filename=' . $filename);
			header('Content-Transfer-Encoding: binary');
			header('Accept-Ranges: bytes');

			readfile($outputPath);
			//unlink($outputPath);
			// }

		} else {
			echo "Create PDF gagal.";
		}

	}

	function cetakDPCPSPMU($THPENSIUN) {
    	
    	
    	/*$THBL = $_GET['thbl'];
    	$v1 = $_GET['p1'];
    	$v2 = $_GET['p2'];
    	$v3 = $_GET['p3'];
    	$v4 = $_GET['p4'];
    	$v5 = $_GET['p5'];

    	$v6 = $_GET['p6'];
    	$v7 = $_GET['p7'];
    	$v8 = $_GET['p8'];*/

    	
		$valnrk = $this->uri->segment(4, 0);
		$v6 = $this->uri->segment(5, 0);
		$v7 = $this->uri->segment(6, 0);
		$spmu = $this->uri->segment(7, 0);
		
		
		require "http://10.15.34.34:8080/JavaBridge/java/Java.inc";

		$system = new Java('java.lang.System');

		$class = new JavaClass("java.lang.Class");

		$class->forName("oracle.jdbc.driver.OracleDriver");

		$driverManager = new JavaClass("java.sql.DriverManager");

		
		$conn = $driverManager->getConnection("jdbc:oracle:thin:@//10.15.34.29:1521/SIMPEG", "simpeg", "p102simp");

		$compileManager = new JavaClass("net.sf.jasperreports.engine.JasperCompileManager");

		// <*untuk menghilangkan Undefined property: java_Client::$cancelProxyCreationTag
		$compileManager->__client->cancelProxyCreationTag = 0;
		// *>
		$viewer = new JavaClass("net.sf.jasperreports.view.JasperViewer");
		$folderPath = realpath(".") . "/public/report/";

		$report = $compileManager->compileReport($folderPath . "newdpcpspmu.jrxml");

		$fillManager = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");
		$params = new Java("java.util.HashMap");
		$params->put("THPENSIUN", $THPENSIUN);
		
		$params->put("valnrk", $valnrk);
		$params->put("v1", $v6);
		$params->put("v2", $v7);
		$params->put("SPMU", $spmu);
		
	   
		

		$emptyDataSource = new Java("net.sf.jasperreports.engine.JREmptyDataSource");

		$runmanager = new Java("net.sf.jasperreports.engine.JasperRunManager");

        
		$jasperPrint = $fillManager->fillReport($report, $params, $conn);
        
		$filename = "newdpcpspmu.pdf";
		$outputPath = realpath(".") . "/assets/pdf/" . $filename;

		$exporter = new Java("net.sf.jasperreports.engine.export.JRPdfExporter");

		$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
		$exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);

		$exportManager = new JavaClass("net.sf.jasperreports.engine.JasperExportManager");

		$exporter->exportReport();

		// $path = './path/to/file.pdf';

		if (file_exists($outputPath)) {
			// echo "Create PDF berhasil." . $outputPath;
			// if ($dwl == 1) {
			// 	$this->load->helper('download');
			// 	force_download($outputPath, NULL);
			// } else {
			header('Content-Type: application/pdf');
			header('Content-Disposition: inline; filename=' . $filename);
			header('Content-Transfer-Encoding: binary');
			header('Accept-Ranges: bytes');

			readfile($outputPath);
			//unlink($outputPath);
			// }

		} else {
			echo "Create PDF gagal.";
		}

	}

    function cetakBerkalaNRK()
    {
        if(isset($_POST['nrkP']))
        {
            $nrkP = $_POST['nrkP'];
        }
        else
        {
            $nrkP="";
        }

        if(isset($_POST['jns']))
        {
            $jenis = $_POST['jns'];
        }
        else
        {
            $jenis="";
        }

        if(isset($_POST['res']))
        {
            $res = $_POST['res'];
        }
        else
        {
            $res="";
        }


        if(isset($_POST['res3']))
        {
            $res3 = $_POST['res3'];
        }
        else
        {
            $res3="";
        }

        //tujuan
        if(isset($_POST['v1']))
        {
            $v1 = $_POST['v1'];
        }
        else
        {
            $v1="";
        }

        //No PP
        if(isset($_POST['v2']))
        {
            $v2 = $_POST['v2'];
        }
        else
        {
            $v2="";
        }

        //tahun PP
        if(isset($_POST['v3']))
        {
            $v3 = $_POST['v3'];
        }
        else
        {
            $v3="";
        }

        //perubahan ke
        if(isset($_POST['v4']))
        {
            $v4 = $_POST['v4'];
        }
        else
        {
            $v4="";
        }

        //bagian pengaju
        if(isset($_POST['v5']))
        {
            $v5 = $_POST['v5'];
        }
        else
        {
            $v5="";
        }

        //penanda tangan
        if(isset($_POST['v6']))
        {
            $v6 = $_POST['v6'];
        }
        else
        {
            $v6="";
        }    

        //penanda tangan
        if(isset($_POST['v7']))
        {
            $v7 = $_POST['v7'];
        }
        else
        {
            $v7="";
        } 

        if(isset($_POST['valnrk']))
        {
            $valnrk = $_POST['valnrk'];
        }
        else
        {
            $valnrk="";
        } 

       
        require "http://10.15.34.33:8080/JavaBridge/java/Java.inc";

        $system = new Java('java.lang.System');

        $class = new JavaClass("java.lang.Class");

        $class->forName("oracle.jdbc.driver.OracleDriver");

        $driverManager = new JavaClass("java.sql.DriverManager");

        
        $conn = $driverManager->getConnection("jdbc:oracle:thin:@//10.15.34.29:1521/SIMPEG", "simpeg", "p102simp");

        $compileManager = new JavaClass("net.sf.jasperreports.engine.JasperCompileManager");

        // <*untuk menghilangkan Undefined property: java_Client::$cancelProxyCreationTag
        $compileManager->__client->cancelProxyCreationTag = 0;
        // *>
        $viewer = new JavaClass("net.sf.jasperreports.view.JasperViewer");
        $folderPath = realpath(".") . "/public/report/";

        $report = $compileManager->compileReport($folderPath . "newberkalanrk.jrxml");

        $fillManager = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");
        $params = new Java("java.util.HashMap");
        $params->put("THBL", $res);
        $params->put("v1", $v1);
        $params->put("v2", $v2);
        $params->put("v3", $v3);
        $params->put("v4", $v4);
        $params->put("v5", $v5);
        $params->put("v6", $v6);
        $params->put("v7", $v7);
        $params->put("valnrk", $valnrk);
        $params->put("NRK", $nrkP);
        

        $emptyDataSource = new Java("net.sf.jasperreports.engine.JREmptyDataSource");

        $runmanager = new Java("net.sf.jasperreports.engine.JasperRunManager");

        
        $jasperPrint = $fillManager->fillReport($report, $params, $conn);
        
        $filename = "newberkalanrk.pdf";
        $outputPath = realpath(".") . "/assets/pdf/" . $filename;

        $exporter = new Java("net.sf.jasperreports.engine.export.JRPdfExporter");

        $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
        $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);

        $exportManager = new JavaClass("net.sf.jasperreports.engine.JasperExportManager");

        $exporter->exportReport();

        // $path = './path/to/file.pdf';

        if (file_exists($outputPath)) {
            // echo "Create PDF berhasil." . $outputPath;
            // if ($dwl == 1) {
            //  $this->load->helper('download');
            //  force_download($outputPath, NULL);
            // } else {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename=' . $filename);
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');

            readfile($outputPath);
            //unlink($outputPath);
            // }

        } else {
            echo "Create PDF gagal.";
        }   
    }


    function cetakDPCPNRK()
    {
        if(isset($_POST['nrkP']))
        {
            $nrkP = $_POST['nrkP'];
        }
        else
        {
            $nrkP="";
        }

        if(isset($_POST['jns']))
        {
            $jenis = $_POST['jns'];
        }
        else
        {
            $jenis="";
        }

        if(isset($_POST['res']))
        {
            $res = $_POST['res'];
        }
        else
        {
            $res="";
        }


        if(isset($_POST['res3']))
        {
            $res3 = $_POST['res3'];
        }
        else
        {
            $res3="";
        }

        //tujuan
        if(isset($_POST['v1']))
        {
            $v1 = $_POST['v1'];
        }
        else
        {
            $v1="";
        }

        //No PP
        if(isset($_POST['v2']))
        {
            $v2 = $_POST['v2'];
        }
        else
        {
            $v2="";
        }

        //tahun PP
        if(isset($_POST['v3']))
        {
            $v3 = $_POST['v3'];
        }
        else
        {
            $v3="";
        }

        //perubahan ke
        if(isset($_POST['v4']))
        {
            $v4 = $_POST['v4'];
        }
        else
        {
            $v4="";
        }

        //bagian pengaju
        if(isset($_POST['v5']))
        {
            $v5 = $_POST['v5'];
        }
        else
        {
            $v5="";
        }

        //penanda tangan
        if(isset($_POST['v6']))
        {
            $v6 = $_POST['v6'];
        }
        else
        {
            $v6="";
        }    

        //penanda tangan
        if(isset($_POST['v7']))
        {
            $v7 = $_POST['v7'];
        }
        else
        {
            $v7="";
        } 

        if(isset($_POST['valnrk']))
        {
            $valnrk = $_POST['valnrk'];
        }
        else
        {
            $valnrk="";
        } 

       
        require "http://10.15.34.34:8080/JavaBridge/java/Java.inc";

        $system = new Java('java.lang.System');

        $class = new JavaClass("java.lang.Class");

        $class->forName("oracle.jdbc.driver.OracleDriver");

        $driverManager = new JavaClass("java.sql.DriverManager");

        
        $conn = $driverManager->getConnection("jdbc:oracle:thin:@//10.15.34.29:1521/SIMPEG", "simpeg", "p102simp");

        $compileManager = new JavaClass("net.sf.jasperreports.engine.JasperCompileManager");

        // <*untuk menghilangkan Undefined property: java_Client::$cancelProxyCreationTag
        $compileManager->__client->cancelProxyCreationTag = 0;
        // *>
        $viewer = new JavaClass("net.sf.jasperreports.view.JasperViewer");
        $folderPath = realpath(".") . "/public/report/";

        $report = $compileManager->compileReport($folderPath . "newdpcpnrk.jrxml");

        $fillManager = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");
        $params = new Java("java.util.HashMap");
        $params->put("THPENSIUN", $res);
        $params->put("valnrk", $valnrk);
        $params->put("v1", $v1);
        $params->put("v2", $v2);
        $params->put("NRK", $nrkP);
        

        $emptyDataSource = new Java("net.sf.jasperreports.engine.JREmptyDataSource");

        $runmanager = new Java("net.sf.jasperreports.engine.JasperRunManager");

        
        $jasperPrint = $fillManager->fillReport($report, $params, $conn);
        
        $filename = "newdpcpnrk.pdf";
        $outputPath = realpath(".") . "/assets/pdf/" . $filename;

        $exporter = new Java("net.sf.jasperreports.engine.export.JRPdfExporter");

        $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->JASPER_PRINT, $jasperPrint);
        $exporter->setParameter(java("net.sf.jasperreports.engine.JRExporterParameter")->OUTPUT_FILE_NAME, $outputPath);

        $exportManager = new JavaClass("net.sf.jasperreports.engine.JasperExportManager");

        $exporter->exportReport();

        // $path = './path/to/file.pdf';

        if (file_exists($outputPath)) {
            // echo "Create PDF berhasil." . $outputPath;
            // if ($dwl == 1) {
            //  $this->load->helper('download');
            //  force_download($outputPath, NULL);
            // } else {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename=' . $filename);
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');

            readfile($outputPath);
            //unlink($outputPath);
            // }

        } else {
            echo "Create PDF gagal.";
        }   
    }

}
