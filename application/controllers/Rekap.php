<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
        $this->load->helper(array('form', 'url'));    	
    	$this->load->library('session');
        
    	$this->load->model('mhome','home');
        $this->load->model('admin/v_pegawai','mdl');
        $this->load->library('infopegawai');
        $this->load->library('convert');
        $this->load->model('mrekap','rekap');
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
                $datam['activeMenu'] = "25176";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'rekap',0);
                $datam['inisial'] = 'rekap';
                
            // START THBL
            if(isset($_POST['thbl'])){
                $bulantahun = $_POST['thbl'];
            }else{
                $bulantahun = date('M Y');
            }
            $thbl = $this->convert->convertNamaBulanTahun($bulantahun);
            // END THBL

            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);
            $data['nrk'] = $nrk;
           
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
            
            //persdukpangkathistduk
            $data['tahunbrkl'] = $this->rekap->getListTHBL($thbl);

			$data['tahunbrkl2'] = $this->rekap->getListTHBLTKD($thbl);

            $data['tahunbrkl3'] = $this->rekap->getListTHBLGaji($thbl);            
     
            $menuid='25176';  
            $cekaksesmenu = $this->infopegawai->cekaksesmenu($menuid,$this->user['user_group']);

            if($cekaksesmenu == '1')
            {
    			$this->load->view('head/header',$this->user);
    			$this->load->view('head/menu',$datam);
    			$this->load->view('vrekap',$data);
                //$this->load->view('admin/pegawai_list',$data);
    			$this->load->view('head/footer');
            }
            else
            {
                $this->load->view('403');
            } 

	}

    public function getJumlahDataPegawaiPerLokasi($thbl,$kolok)
    {
        $infoCPNS = $this->rekap->getPegCPNS($thbl,$kolok);
        $infoPegEs2 = $this->rekap->getPegEselon2($thbl,$kolok);
        $infoPegEs3 = $this->rekap->getPegEselon3($thbl,$kolok);
        $infoPegEs4 = $this->rekap->getPegEselon4($thbl,$kolok);
        $infoPegTekAhl = $this->rekap->getPegTeknisAhli($thbl,$kolok);
        $infoPegTekTrp = $this->rekap->getPegTeknisTerampil($thbl,$kolok);
        $infoPegAdmAhl = $this->rekap->getPegAdmAhli($thbl,$kolok);
        $infoPegAdmTrp = $this->rekap->getPegAdmTerampil($thbl,$kolok);
        $infoPegOpAhl = $this->rekap->getPegOpAhli($thbl,$kolok);
        $infoPegOpTrp = $this->rekap->getPegOpTerampil($thbl,$kolok);
        $infoPegLayAhl = $this->rekap->getPegLayAhli($thbl,$kolok);
        $infoPegLayTrp = $this->rekap->getPegLayTerampil($thbl,$kolok);
        $infoSNonJFU = $this->rekap->getPegStafNJFU($thbl,$kolok);
        $infoJFT = $this->rekap->getPegJFT($thbl,$kolok);

        $array = array($kolok,$infoPegEs2,$infoPegEs3,$infoPegEs4,$infoPegTekAhl,$infoPegTekTrp,$infoPegAdmAhl,$infoPegAdmTrp,$infoPegOpAhl,$infoPegOpTrp,$infoPegLayAhl,$infoPegLayTrp,$infoSNonJFU,$infoJFT);

        return $array;
    }

    public function getListPegawai()
    {
        $this->load->model('mreport','report');
        if($this->input->post()){
            $post = $this->input->post();
            $jenis = $post['jenis'];
            $res = $post['res'];

            $datapegawai=array();
            if($jenis == 1)
            {
            	$datapegawai = $this->rekap->getDataPegawaiUKPD($res);
            }
            else if($jenis == 2)
            {
            	$datapegawai = $this->rekap->getDataPegawaiSKPD($res);
            }
            else if($jenis == 3)
            {
            	$datapegawai = $this->rekap->getDataPegawaiGol($res);	

            }
            else if($jenis == 4)
            {
            	$datapegawai = $this->rekap->getDataTKD($res);	

            }
            else if($jenis == 5)
            {
            	$datapegawai = $this->rekap->getDataGaji($res);	
            }
            else
            {
                exit;
            }
            
            $response = array('response' => 'SUKSES', 'datapegawai' => $datapegawai);
        }else{
            $response = array('response' => 'GAGAL');
        }

        echo $datapegawai;
            
    }

    public function getListPegawai2()
    {
        
        if($this->input->post()){
            $post = $this->input->post();
            $jenis = $post['jenis'];
            $res = $post['res'];

            $datapegawai=array();
            if($jenis == 6)
            {
                $datapegawai = $this->rekap->getDataGajiPPH($res);
            }
            
            else
            {
                exit;
            }
            
            $response = array('response' => 'SUKSES', 'datapegawai' => $datapegawai);
        }else{
            $response = array('response' => 'GAGAL');
        }

        echo $datapegawai;
            
    }

    public function cetakUkpd($res)
    {
    	   
        $alldata = $this->rekap->getQueryUkpd($res);
           	
		$this->topdfUKPDF($alldata,$res);
    }

    public function cetakSkpd($res)
    {
           
        $alldata = $this->rekap->getQuerySkpd($res);
            
        $this->toPdfSKPD($alldata,$res);
    }

    public function cetakGol($res)
    {
           
        $alldata = $this->rekap->getQueryGol($res);
            
        $this->toPdfGol($alldata,$res);
    }

  	public function cetakTKD($res)
    {
           
        $alldata = $this->rekap->getQueryTKD($res);
            
        $this->toPdfTKD($alldata,$res);
    }

    public function cetakGaji($res)
    {
           
        $alldata = $this->rekap->getQueryGaji($res);
            
        $this->toPdfGaji($alldata,$res);
    }

    public function cetakGajiPPH($res)
    {
           
        $alldata = $this->rekap->getQueryGajiPPH($res);
            
        $this->toPdfGajiPPh($alldata,$res);
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


    //UKPD FPDF
    public function topdfUKPDF($alldata,$res)
    {
        $this->load->library('pdf_ukpdf');
        $this->load->library('convert');

        $bulan = $this->convert->convertKeNamaBulan(substr($res,4, 2));

        $header = array('No', 'UKPD', 'Eselon2', 'Eselon3','Eselon4','','','','','','STAF','','','','','','TOTAL');
        $header2 = array('', '', '', '','','CPNS','TA','TT','AA','AT','OA','OT','PA','PT','JFT','LAIN','');

        $this->pdf_ukpdf->SetAutoPageBreak(true,28);
        $this->pdf_ukpdf->SetMargins(25,25,25);

        $this->pdf_ukpdf->AddPage();
        
        $this->pdf_ukpdf->SetFont('Arial','B',14);
        $this->pdf_ukpdf->Cell(0,7,'REKAPITULASI JUMLAH PEGAWAI',0,0,'C');
        $this->pdf_ukpdf->Ln();
        $this->pdf_ukpdf->Cell(0,7,'PER GOLONGAN PER JABATAN',0,0,'C');
        $this->pdf_ukpdf->Ln();
        $this->pdf_ukpdf->Cell(0,7,'TAHUN : '.substr($res,0,4).' BULAN: '.$bulan,0,0,'C');
        $this->pdf_ukpdf->Ln();
        $this->pdf_ukpdf->Ln();
        $this->pdf_ukpdf->Ln();

        $this->pdf_ukpdf->ImprovedTable($header,$header2,$alldata);
        
        $this->pdf_ukpdf->Output();
    }

    //Gaji PPH FPDF
    public function toPdfGajiPPh($alldata,$res)
    {
        $this->load->library('pdf_pph');
        //$this->load->library('convert');

        $bulan = $this->convert->convertKeNamaBulan(substr($res,4, 2));

        $header = array('No', 'Bulan', 'Gol 1', 'Gol 2','Gol 3','Gol 4','Total','Gaji Pokok','Tunj. Keluarga','Tunj. Jabatan','Tunj. Fungsional','Tunj. Lain','TPPHGaji','Tunj Beras','Lainnya','Pembulatan','Total Gaji Kotor');
        //$header2 = array('', '', '', '','','CPNS','TA','TT','AA','AT','OA','OT','PA','PT','JFT','LAIN','');

        $this->pdf_pph->SetAutoPageBreak(true,28);
        $this->pdf_pph->SetMargins(25,25,25);

        $this->pdf_pph->AddPage();

        $this->pdf_pph->Cell(0,7,'',0,0,'C');
        $this->pdf_pph->Ln();

        $this->pdf_pph->Cell(0,7,'',0,0,'C');
        $this->pdf_pph->Ln();
        
        $this->pdf_pph->SetFont('Arial','B',12);
        $this->pdf_pph->Cell(0,7,'DAFTAR RINCIAN JUMLAH DAN REALISASI PEMBAYARAN GAJI INDUK PNS DAERAH (TERMASUK CPNSD)',0,0,'C');
        $this->pdf_pph->Ln();
        
        $this->pdf_pph->Cell(0,7,'TAHUN ANGGARAN: '.substr($res,0,4),0,0,'C');
        $this->pdf_pph->Ln();
       
        $this->pdf_pph->Cell(0,7,'',0,0,'C');
        $this->pdf_pph->Ln();

        $this->pdf_pph->Cell(0,7,'',0,0,'C');
        $this->pdf_pph->Ln();

        $this->pdf_pph->SetFont('Arial','B',8);

        $this->pdf_pph->ImprovedTable($header,$alldata);

        
        
        $this->pdf_pph->Output();
    }


    //UKPD TCPDF
    public function toPdf3($alldata,$res)
    {
       // $this->load->library('pdf');
        $this->load->library('pdf_ukpd');
        $this->load->library('convert');
        ob_start();
           //$this->pdf_report2= new pdf_report2('L', PDF_UNIT, 'A3',true, 'UTF-8', false);
           
           $this->pdf_ukpd->SetTitle('Jumlah Pegawai Per UKPD'); 
           // definisikan judul dokumen


            $this->pdf_ukpd->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
            // set header and footer fonts
            $this->pdf_ukpd->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $this->pdf_ukpd->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
           /* $this->pdf_report2->setPrintHeader(false);
            $this->pdf_report2->setPrintFooter(false);*/
            // set default monospaced font
            $this->pdf_ukpd->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $this->pdf_ukpd->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT,FALSE);
            $this->pdf_ukpd->SetHeaderMargin(PDF_MARGIN_HEADER);
            $this->pdf_ukpd->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $this->pdf_ukpd->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $this->pdf_ukpd->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf_ukpd->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set font
            $this->pdf_ukpd->SetFont('helvetica', '', 8);

            // add a page
            
         //   $this->pdf_report2->AddPage();
          $bulan = $this->convert->convertKeNamaBulan(substr($res,4, 2));
          $html = '
          <table border="0" width="100%">
          <tr>
	          <td width="30%"></td>
	          <td align="center" width="40%"><h1> REKAPITULASI JUMLAH PEGAWAI</h1></td>
	          <td width="30%"></td>
          </tr>
          <tr>
	          <td width="30%"></td>
	          <td align="center" width="40%"><h1>PER UKPD PER JABATAN</h1></td>
	          <td width="30%"></td>
          </tr>
          <tr>
	          <td width="30%"></td>
	          <td align="center" width="40%"><h1>TAHUN : '.substr($res,0,4).' &nbsp; &nbsp;  BULAN : '.$bulan.'</h1></td>
	          <td width="30%"></td>
          </tr>
          </table>
          <br/><br/><br/><br/>


          <table border="1" cellspacing="1" cellpadding="1">
          <thead>
			<tr>
				<th rowspan="2" style="text-align:center; vertical-align: middle !important;" width="3%"> <strong>NO </strong></th>
				<th rowspan="2" style="text-align:center; vertical-align: middle !important;" width="15%"><strong>NAMA UKPD </strong></th>
				<th rowspan="2" style="text-align:center; vertical-align: middle !important;" width="5%"> <strong> ESELON 2 </strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important;" width="5%"> <strong> ESELON 3 </strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important;" width="5%"> <strong> ESELON 4 </strong></th>
                <th colspan="11" style="text-align:center; vertical-align: middle !important;" width="63%"><strong>STAFF </strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important;" width="5%"><strong>TOTAL PER UKPD</strong></th>
			</tr>
            <tr>
                <th style="text-align:center; vertical-align: middle !important;" width="5%"><strong>CPNS</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="5%"><strong>Teknis Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="5%"><strong>Teknis Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="5%"><strong>Adm. Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="5%"><strong>Adm. Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="7%"><strong>Operasional Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="7%"><strong>Operasional Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="7%"><strong>Pelayanan Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="7%"><strong>Pelayanan Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="5%"><strong>JFT</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="5%"><strong>Lainnya</strong></th>
            </tr>
	     </thead>
          <tbody>';
           $no=1;
           
           foreach ($alldata as $row) {
            
            $kolok = $row->KOLOK_NEW;
            
            $nalokl = $row->NALOKL;
            $cpns = $row->CPNS;
                $totalcpns = $totalcpns + $cpns;
            $eselon2 = $row->ESELON2;
                $totales2 = $totales2 + $eselon2;
            $eselon3 = $row->ESELON3;
                $totales3 = $totales3 + $eselon3;
            $eselon4 = $row->ESELON4;
                $totales4 = $totales4 + $eselon4;
            $ta = $row->TEKNIS_AHLI;
                $totalta = $totalta + $ta;
            $tt = $row->TEKNIS_TERAMPIL;
                $totaltt = $totaltt + $tt;
            $aa = $row->ADMINISTRASI_AHLI;
                $totalaa = $totalaa + $aa;
            $at = $row->ADMINISTRASI_TERAMPIL;
                $totalat = $totalat + $at;
            $oa = $row->OPERASIONAL_AHLI;
                $totaloa = $totaloa + $oa;
            $ot = $row->OPERASIONAL_TERAMPIL;
                $totalot = $totalot + $ot;
            $pa = $row->PELAYANAN_AHLI;
                $totalpa = $totalpa + $pa;
            $pt = $row->PELAYANAN_TERAMPIL;
                $totalpt = $totalpt + $pt;
            $ln = $row->LAINNYA;
                $totalln = $totalln + $ln;
            $jft = $row->JFT;
                $totaljft = $totaljft + $jft;
            $tot = $row->TOT;
                $totaltot = $totaltot + $tot;
           

            $html.= '
        		<tr><td width="3%" style="text-align:center; vertical-align: middle !important;">'.$no.'</td>
        		<td style="text-align:left; vertical-align: middle !important;" width="15%">'.$nalokl.'</td>
        		
        		<td style="text-align:right; vertical-align: middle !important;" width="5%">'.$eselon2.'</td>
        		<td style="text-align:right; vertical-align: middle !important;" width="5%">'.$eselon3.'</td>
        		<td style="text-align:right; vertical-align: middle !important;" width="5%">'.$eselon4.'</td>
        		<td style="text-align:right; vertical-align: middle !important;" width="5%">'.$cpns.'</td>
        		<td style="text-align:right; vertical-align: middle !important;" width="5%">'.$ta.'</td>
        		<td style="text-align:right; vertical-align: middle !important;" width="5%">'.$tt.'</td>
        		<td style="text-align:right; vertical-align: middle !important;" width="5%">'.$aa.'</td>
        		<td style="text-align:right; vertical-align: middle !important;" width="5%">'.$at.'</td>
        		<td style="text-align:right; vertical-align: middle !important;" width="7%">'.$oa.'</td>
        		<td style="text-align:right; vertical-align: middle !important;" width="7%">'.$ot.'</td>
        		<td style="text-align:right; vertical-align: middle !important;" width="7%">'.$pa.'</td>
        		<td style="text-align:right; vertical-align: middle !important;" width="7%">'.$pt.'</td>
        		<td style="text-align:right; vertical-align: middle !important;" width="5%">'.$ln.'</td>
        		<td style="text-align:right; vertical-align: middle !important;" width="5%">'.$jft.'</td>
        		<td style="text-align:right; vertical-align: middle !important;" width="5%">'.$tot.'</td></tr>';
            
           
            //$this->pdf_ukpd->AddPage();
            
             //$this->pdf_ukpd->lastPage();
        		$no++;
            }
            $html.='<tr><td width="3%" style="text-align:center; vertical-align: middle !important;"></td>
                <td style="text-align:center; vertical-align: middle !important;" width="15%"> <strong>T O T A L </strong></td>
                
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totales2.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totales3.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totales4.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totalcpns.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totalta.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totaltt.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totalaa.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totalat.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="7%"><strong>'.$totaloa.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="7%"><strong>'.$totalot.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="7%"><strong>'.$totalpa.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="7%"><strong>'.$totalpt.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totalln.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totaljft.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totaltot.'</strong></td></tr>';
            $html.='</tbody></table>';
            $this->pdf_ukpd->AddPage();
            $this->pdf_ukpd->writeHTML($html, true, false, true, false, '');
             $this->pdf_ukpd->lastPage();
              ob_clean();          
            
            $this->pdf_ukpd->Output('ukpd.pdf', 'I');

    }

    public function toPdfSKPD($alldata,$res)
    {
       // $this->load->library('pdf');
        $this->load->library('pdf_ukpd');
        $this->load->library('convert');

        ob_start();
           //$this->pdf_report2= new pdf_report2('L', PDF_UNIT, 'A3',true, 'UTF-8', false);
           
           $this->pdf_ukpd->SetTitle('Jumlah Pegawai Per SKPD'); 
           // definisikan judul dokumen


            $this->pdf_ukpd->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
            // set header and footer fonts
            $this->pdf_ukpd->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $this->pdf_ukpd->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
           /* $this->pdf_report2->setPrintHeader(false);
            $this->pdf_report2->setPrintFooter(false);*/
            // set default monospaced font
            $this->pdf_ukpd->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $this->pdf_ukpd->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT,FALSE);
            $this->pdf_ukpd->SetHeaderMargin(PDF_MARGIN_HEADER);
            $this->pdf_ukpd->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $this->pdf_ukpd->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $this->pdf_ukpd->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf_ukpd->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set font
            $this->pdf_ukpd->SetFont('helvetica', '', 8);

            // add a page
            
         //   $this->pdf_report2->AddPage();
           $bulan = $this->convert->convertKeNamaBulan(substr($res,4, 2));
          $html = '
          <table border="0" width="100%">
          <tr>
	          <td width="30%"></td>
	          <td align="center" width="40%"><h1> REKAPITULASI JUMLAH PEGAWAI</h1></td>
	          <td width="30%"></td>
          </tr>
          <tr>
	          <td width="30%"></td>
	          <td align="center" width="40%"><h1>PER GOLONGAN PER JABATAN</h1></td>
	          <td width="30%"></td>
          </tr>
          <tr>
	          <td width="30%"></td>
	          <td align="center" width="40%"><h1>TAHUN : '.substr($res,0,4).' &nbsp; &nbsp;  BULAN : '.$bulan.'</h1></td>
	          <td width="30%"></td>
          </tr>
          </table>
          <br/><br/><br/><br/>
          <table border="1" cellspacing="1" cellpadding="1">
          <thead>
            <tr>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important;" width="3%"><strong>No</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important;" width="15%"><strong>Nama SKPD</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important;" width="5%"><strong>Eselon 2</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important;" width="5%"><strong>Eselon 3</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important;" width="5%"><strong>Eselon 4</strong></th>
                <th colspan="11" style="text-align:center; vertical-align: middle !important;" width="63%"><strong>Staff</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important;" width="5%"><strong>Total Per SKPD</strong></th>
            </tr>
            <tr>
                <th style="text-align:center; vertical-align: middle !important;" width="5%"><strong>CPNS</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="5%"><strong>Teknis Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="5%"><strong>Teknis Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="5%"><strong>Adm. Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="5%"><strong>Adm. Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="7%"><strong>Operasional Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="7%"><strong>Operasional Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="7%"><strong>Pelayanan Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="7%"><strong>Pelayanan Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="5%"><strong>JFT</strong></th>
                <th style="text-align:center; vertical-align: middle !important; " width="5%"><strong>Lainnya</strong></th>
            </tr>
         </thead>
          <tbody>';
           $no=1;
           $totales2=0; $totales3=0; $totales4=0; $totalcpns=0;
           $totalta =0; $totaltt =0; $totalaa =0; $totalat=0;
           $totaloa =0; $totalot =0; $totalpa =0; $totalpt=0;
           $totalln=0; $totaljft =0; $totaltot =0; 
           foreach ($alldata as $row) {
            
            $kolok = $row->SPMU_NEW;
            
            $nalokl = $row->NAMA;
            $cpns = $row->CPNS;
                $totalcpns = $totalcpns + $cpns;
            $eselon2 = $row->ESELON2;
                $totales2 = $totales2 + $eselon2;
            $eselon3 = $row->ESELON3;
                $totales3 = $totales3 + $eselon3;
            $eselon4 = $row->ESELON4;
                $totales4 = $totales4 + $eselon4;
            $ta = $row->TEKNIS_AHLI;
                $totalta = $totalta + $ta;
            $tt = $row->TEKNIS_TERAMPIL;
                $totaltt = $totaltt + $tt;
            $aa = $row->ADMINISTRASI_AHLI;
                $totalaa = $totalaa + $aa;
            $at = $row->ADMINISTRASI_TERAMPIL;
                $totalat = $totalat + $at;
            $oa = $row->OPERASIONAL_AHLI;
                $totaloa = $totaloa + $oa;
            $ot = $row->OPERASIONAL_TERAMPIL;
                $totalot = $totalot + $ot;
            $pa = $row->PELAYANAN_AHLI;
                $totalpa = $totalpa + $pa;
            $pt = $row->PELAYANAN_TERAMPIL;
                $totalpt = $totalpt + $pt;
            $ln = $row->LAINNYA;
                $totalln = $totalln + $ln;
            $jft = $row->JFT;
                $totaljft = $totaljft + $jft;
            $tot = $row->TOT;
                $totaltot = $totaltot + $tot;
            

            $html.= '
                <tr><td width="3%" style="text-align:center; vertical-align: middle !important;">'.$no.'</td>
                <td style="text-align:left; vertical-align: middle !important;" width="15%">'.$nalokl.'</td>
                
                <td style="text-align:right; vertical-align: middle !important;" width="5%">'.$eselon2.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%">'.$eselon3.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%">'.$eselon4.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%">'.$cpns.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%">'.$ta.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%">'.$tt.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%">'.$aa.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%">'.$at.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="7%">'.$oa.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="7%">'.$ot.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="7%">'.$pa.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="7%">'.$pt.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%">'.$ln.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%">'.$jft.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$tot.'</strong></td></tr>';
            
           
            //$this->pdf_ukpd->AddPage();
            
             //$this->pdf_ukpd->lastPage();
                $no++;
            }
            $html.= '
            <tr><td width="3%" style="text-align:center; vertical-align: middle !important;"></td>
                <td style="text-align:center; vertical-align: middle !important;" width="15%"> <strong>T O T A L </strong></td>
                
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totales2.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totales3.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totales4.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totalcpns.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totalta.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totaltt.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totalaa.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totalat.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="7%"><strong>'.$totaloa.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="7%"><strong>'.$totalot.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="7%"><strong>'.$totalpa.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="7%"><strong>'.$totalpt.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totalln.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totaljft.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="5%"><strong>'.$totaltot.'</strong></td></tr>';
            
            $html.='</tbody></table>';
            $this->pdf_ukpd->AddPage();
            $this->pdf_ukpd->writeHTML($html, true, false, true, false, '');
             $this->pdf_ukpd->lastPage();
              ob_clean();          
            
            $this->pdf_ukpd->Output('skpd.pdf', 'I');

    } 

    public function toPdfGol($alldata,$res)
    {
       // $this->load->library('pdf');
        $this->load->library('pdf_ukpd');
        $this->load->library('convert');

        ob_start();
           //$this->pdf_report2= new pdf_report2('L', PDF_UNIT, 'A3',true, 'UTF-8', false);
           
           $this->pdf_ukpd->SetTitle('Jumlah Pegawai Per Golongan'); 
           // definisikan judul dokumen


            $this->pdf_ukpd->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
            // set header and footer fonts
            $this->pdf_ukpd->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $this->pdf_ukpd->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
           /* $this->pdf_report2->setPrintHeader(false);
            $this->pdf_report2->setPrintFooter(false);*/
            // set default monospaced font
            $this->pdf_ukpd->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $this->pdf_ukpd->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT,FALSE);
            $this->pdf_ukpd->SetHeaderMargin(PDF_MARGIN_HEADER);
            $this->pdf_ukpd->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $this->pdf_ukpd->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $this->pdf_ukpd->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf_ukpd->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set font
            $this->pdf_ukpd->SetFont('helvetica', '', 8);

            // add a page
            
         //   $this->pdf_report2->AddPage();
           $bulan = $this->convert->convertKeNamaBulan(substr($res,4, 2));
          $html = '
          <table border="0" width="100%">
          <tr>
	          <td width="30%"></td>
	          <td align="center" width="40%"><h1> REKAPITULASI JUMLAH PEGAWAI</h1></td>
	          <td width="30%"></td>
          </tr>
          <tr>
	          <td width="30%"></td>
	          <td align="center" width="40%"><h1>PER GOLONGAN PER JABATAN</h1></td>
	          <td width="30%"></td>
          </tr>
          <tr>
	          <td width="30%"></td>
	          <td align="center" width="40%"><h1>TAHUN : '.substr($res,0,4).' &nbsp; &nbsp;  BULAN : '.$bulan.'</h1></td>
	          <td width="30%"></td>
          </tr>
          </table>
          <br/><br/><br/><br/>

          <table border="1" cellspacing="1" cellpadding="1">
          <thead>
            <tr>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important; "  width="3%"><strong>No</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important; " width="5%"><strong>Golongan</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important; " width="6%"><strong>Eselon 2</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important; " width="6%"><strong>Eselon 3</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important; " width="6%"><strong>Eselon 4</strong></th>
                <th colspan="11" style="text-align:center; vertical-align: middle !important;" width="66%"><strong>Staff</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Total Per Gol</strong></th>
            </tr>
            <tr>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>CPNS</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Teknis Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Teknis Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Adm. Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Adm. Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Opr. Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Opr. Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Pelayanan Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Pelayanan Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>JFT</strong></th>
                <th style="text-align:center; vertical-align: middle !important; " width="6%"><strong>Lainnya</strong></th>
            </tr>
         </thead>
          <tbody>';
           $no=1;
           $totales2=0; $totales3=0; $totales4=0; $totalcpns=0;
           $totalta =0; $totaltt =0; $totalaa =0; $totalat=0;
           $totaloa =0; $totalot =0; $totalpa =0; $totalpt=0;
           $totalln=0; $totaljft =0; $totaltot =0; 
           foreach ($alldata as $row) {
            
            //$kolok = $row->SPMU_NEW;
            
            $nalokl = $row->GOL_NEW;
            $cpns = $row->CPNS;
                $totalcpns = $totalcpns + $cpns;
            $eselon2 = $row->ESELON2;
                $totales2 = $totales2 + $eselon2;
            $eselon3 = $row->ESELON3;
                $totales3 = $totales3 + $eselon3;
            $eselon4 = $row->ESELON4;
                $totales4 = $totales4 + $eselon4;
            $ta = $row->TEKNIS_AHLI;
                $totalta = $totalta + $ta;
            $tt = $row->TEKNIS_TERAMPIL;
                $totaltt = $totaltt + $tt;
            $aa = $row->ADMINISTRASI_AHLI;
                $totalaa = $totalaa + $aa;
            $at = $row->ADMINISTRASI_TERAMPIL;
                $totalat = $totalat + $at;
            $oa = $row->OPERASIONAL_AHLI;
                $totaloa = $totaloa + $oa;
            $ot = $row->OPERASIONAL_TERAMPIL;
                $totalot = $totalot + $ot;
            $pa = $row->PELAYANAN_AHLI;
                $totalpa = $totalpa + $pa;
            $pt = $row->PELAYANAN_TERAMPIL;
                $totalpt = $totalpt + $pt;
            $ln = $row->LAINNYA;
                $totalln = $totalln + $ln;
            $jft = $row->JFT;
                $totaljft = $totaljft + $jft;
            $tot = $row->TOT;
                $totaltot = $totaltot + $tot;
            $html.= '
                <tr><td width="3%" style="text-align:center; vertical-align: middle !important;">'.$no.'</td>
                <td style="text-align:left; vertical-align: middle !important;" width="5%">'.$nalokl.'</td>
                
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.$eselon2.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.$eselon3.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.$eselon4.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.$cpns.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.$ta.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.$tt.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.$aa.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.$at.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.$oa.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.$ot.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.$pa.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.$pt.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.$ln.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.$jft.'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.$tot.'</strong></td></tr>';
            
           
            //$this->pdf_ukpd->AddPage();
            
             //$this->pdf_ukpd->lastPage();
                $no++;
            }
            $html.= '
            <tr><td width="3%" style="text-align:center; vertical-align: middle !important;"></td>
                <td style="text-align:center; vertical-align: middle !important;" width="5%"> <strong>T O T A L </strong></td>
                
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.$totales2.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.$totales3.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.$totales4.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.$totalcpns.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.$totalta.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.$totaltt.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.$totalaa.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.$totalat.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.$totaloa.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.$totalot.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.$totalpa.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.$totalpt.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.$totalln.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.$totaljft.'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.$totaltot.'</strong></td></tr>';
            $html.='</tbody></table>';
            $this->pdf_ukpd->AddPage();
            $this->pdf_ukpd->writeHTML($html, true, false, true, false, '');
             $this->pdf_ukpd->lastPage();
              ob_clean();          
            
            $this->pdf_ukpd->Output('gol.pdf', 'I');

    }

    public function toPdfTKD($alldata,$res)
    {
       // $this->load->library('pdf');
        $this->load->library('pdf_ukpd');
        $this->load->library('convert');

        ob_start();
           //$this->pdf_report2= new pdf_report2('L', PDF_UNIT, 'A3',true, 'UTF-8', false);
           
           $this->pdf_ukpd->SetTitle('Nilai TKD Per Golongan'); 
           // definisikan judul dokumen


            $this->pdf_ukpd->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
            // set header and footer fonts
            $this->pdf_ukpd->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $this->pdf_ukpd->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
           
            // set default monospaced font
            $this->pdf_ukpd->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $this->pdf_ukpd->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT,FALSE);
            $this->pdf_ukpd->SetHeaderMargin(PDF_MARGIN_HEADER);
            $this->pdf_ukpd->SetFooterMargin(PDF_MARGIN_FOOTER);

            //$this->pdf_ukpd->setPrintHeader(false);
            //$this->pdf_ukpd->setPrintFooter(false);

            // set auto page breaks
            $this->pdf_ukpd->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $this->pdf_ukpd->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf_ukpd->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set font
            $this->pdf_ukpd->SetFont('helvetica', '', 8);

            // add a page
            
         //   $this->pdf_report2->AddPage();
          $bulan = $this->convert->convertKeNamaBulan(substr($res,4, 2));
          $html = '
          <table border="0 " width="100%">
          <tr>
	          <td width="30%"></td>
	          <td align="center" width="40%"><h1> REKAPITULASI NILAI TKD</h1></td>
	          <td width="30%"></td>
          </tr>
          <tr>
	          <td width="30%"></td>
	          <td align="center" width="40%"><h1>PER GOLONGAN PER JABATAN</h1></td>
	          <td width="30%"></td>
          </tr>
          <tr>
	          <td width="30%"></td>
	          <td align="center" width="40%"><h1>TAHUN : '.substr($res,0,4).' &nbsp; &nbsp;  BULAN : '.$bulan.'</h1></td>
	          <td width="30%"></td>
          </tr>
          </table>
          <br/><br/><br/><br/>

          <table border="1" cellspacing="1" cellpadding="1">
          <thead>
            <tr>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important; "  width="3%"><strong>No</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important; " width="5%"><strong>Golongan</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important; " width="6%"><strong>Eselon 2</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important; " width="6%"><strong>Eselon 3</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important; " width="6%"><strong>Eselon 4</strong></th>
                <th colspan="11" style="text-align:center; vertical-align: middle !important;" width="66%"><strong>Staff</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important;" width="8%"><strong>Total Per Gol</strong></th>
            </tr>
            <tr>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>CPNS</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Teknis Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Teknis Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Adm. Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Adm. Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Opr. Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Opr. Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Pelayanan Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Pelayanan Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>JFT</strong></th>
                <th style="text-align:center; vertical-align: middle !important; " width="6%"><strong>Lainnya</strong></th>
            </tr>
         </thead>
          <tbody>';
           $no=1;
           $totales2=0; $totales3=0; $totales4=0; $totalcpns=0;
           $totalta =0; $totaltt =0; $totalaa =0; $totalat=0;
           $totaloa =0; $totalot =0; $totalpa =0; $totalpt=0;
           $totalln=0; $totaljft =0; $totaltot =0; 
           foreach ($alldata as $row) {
            
            //$kolok = $row->SPMU_NEW;
            
            $nalokl = $row->GOL_NEW;
            $cpns = $row->CPNS;
                $totalcpns = $totalcpns + $cpns;
            $eselon2 = $row->ESELON2;
                $totales2 = $totales2 + $eselon2;
            $eselon3 = $row->ESELON3;
                $totales3 = $totales3 + $eselon3;
            $eselon4 = $row->ESELON4;
                $totales4 = $totales4 + $eselon4;
            $ta = $row->TEKNIS_AHLI;
                $totalta = $totalta + $ta;
            $tt = $row->TEKNIS_TERAMPIL;
                $totaltt = $totaltt + $tt;
            $aa = $row->ADMINISTRASI_AHLI;
                $totalaa = $totalaa + $aa;
            $at = $row->ADMINISTRASI_TERAMPIL;
                $totalat = $totalat + $at;
            $oa = $row->OPERASIONAL_AHLI;
                $totaloa = $totaloa + $oa;
            $ot = $row->OPERASIONAL_TERAMPIL;
                $totalot = $totalot + $ot;
            $pa = $row->PELAYANAN_AHLI;
                $totalpa = $totalpa + $pa;
            $pt = $row->PELAYANAN_TERAMPIL;
                $totalpt = $totalpt + $pt;
            $ln = $row->LAINNYA;
                $totalln = $totalln + $ln;
            $jft = $row->JFT;
                $totaljft = $totaljft + $jft;
            $tot = $row->TOT;
                $totaltot = $totaltot + $tot;
            $html.= '
                <tr><td width="3%" style="text-align:center; vertical-align: middle !important;">'.$no.'</td>
                <td style="text-align:left; vertical-align: middle !important;" width="5%">'.number_format($nalokl, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($eselon2, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($eselon3, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($eselon4, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($cpns, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($ta, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($tt, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($aa, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($at, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($oa, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($ot, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($pa, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($pt, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($ln, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($jft, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="8%">'.number_format($tot, 0, ',', '.').'</td></tr>';
            
           
            //$this->pdf_ukpd->AddPage();
            
             //$this->pdf_ukpd->lastPage();
                $no++;
            }
            $html.= '
            <tr><td width="3%" style="text-align:center; vertical-align: middle !important;"></td>
                <td style="text-align:center; vertical-align: middle !important;" width="5%"> <strong>TOTAL (Rp)</strong></td>
                
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totales2, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totales3, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totales4, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totalcpns, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totalta, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totaltt, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totalaa, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totalat, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totaloa, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totalot, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totalpa, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totalpt, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totalln, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totaljft, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="8%"><strong>'.number_format($totaltot, 0, ',', '.').'</strong></td></tr>';
            $html.='</tbody></table>';
            $this->pdf_ukpd->AddPage();
            $this->pdf_ukpd->writeHTML($html, true, false, true, false, '');
             $this->pdf_ukpd->lastPage();
              ob_clean();          
            
            $this->pdf_ukpd->Output('tkd.pdf', 'I');

    }


    public function toPdfGaji($alldata,$res)
    {
       // $this->load->library('pdf');
        $this->load->library('pdf_ukpd');
        $this->load->library('convert');

        ob_start();
           //$this->pdf_report2= new pdf_report2('L', PDF_UNIT, 'A3',true, 'UTF-8', false);
           
           $this->pdf_ukpd->SetTitle('Nilai Gaji Per Golongan'); 
           // definisikan judul dokumen


            $this->pdf_ukpd->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
            // set header and footer fonts
            $this->pdf_ukpd->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $this->pdf_ukpd->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
           
            // set default monospaced font
            $this->pdf_ukpd->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $this->pdf_ukpd->SetMargins(PDF_MARGIN_LEFT, 30, PDF_MARGIN_RIGHT,FALSE);
            $this->pdf_ukpd->SetHeaderMargin(PDF_MARGIN_HEADER);
            $this->pdf_ukpd->SetFooterMargin(PDF_MARGIN_FOOTER);

            //$this->pdf_ukpd->setPrintHeader(false);
            //$this->pdf_ukpd->setPrintFooter(false);

            // set auto page breaks
            $this->pdf_ukpd->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $this->pdf_ukpd->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf_ukpd->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set font
            $this->pdf_ukpd->SetFont('helvetica', '', 8);

            // add a page
            
         //   $this->pdf_report2->AddPage();
          $bulan = $this->convert->convertKeNamaBulan(substr($res,4, 2));
          $html = '
          <table border="0 " width="100%">
          <tr>
	          <td width="30%"></td>
	          <td align="center" width="40%"><h1> REKAPITULASI NILAI GAJI</h1></td>
	          <td width="30%"></td>
          </tr>
          <tr>
	          <td width="30%"></td>
	          <td align="center" width="40%"><h1>PER GOLONGAN PER JABATAN</h1></td>
	          <td width="30%"></td>
          </tr>
          <tr>
	          <td width="30%"></td>
	          <td align="center" width="40%"><h1>TAHUN : '.substr($res,0,4).' &nbsp; &nbsp;  BULAN : '.$bulan.'</h1></td>
	          <td width="30%"></td>
          </tr>
          </table>
          <br/><br/><br/><br/>

          <table border="1" cellspacing="1" cellpadding="1">
          <thead>
            <tr>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important; "  width="3%"><strong>No</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important; " width="5%"><strong>Golongan</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important; " width="6%"><strong>Eselon 2</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important; " width="6%"><strong>Eselon 3</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important; " width="6%"><strong>Eselon 4</strong></th>
                <th colspan="11" style="text-align:center; vertical-align: middle !important;" width="66%"><strong>Staff</strong></th>
                <th rowspan="2" style="text-align:center; vertical-align: middle !important;" width="8%"><strong>Total Per Gol</strong></th>
            </tr>
            <tr>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>CPNS</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Teknis Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Teknis Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Adm. Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Adm. Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Opr. Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Opr. Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Pelayanan Ahli</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>Pelayanan Terampil</strong></th>
                <th style="text-align:center; vertical-align: middle !important;" width="6%"><strong>JFT</strong></th>
                <th style="text-align:center; vertical-align: middle !important; " width="6%"><strong>Lainnya</strong></th>
            </tr>
         </thead>
          <tbody>';
           $no=1;
           $totales2=0; $totales3=0; $totales4=0; $totalcpns=0;
           $totalta =0; $totaltt =0; $totalaa =0; $totalat=0;
           $totaloa =0; $totalot =0; $totalpa =0; $totalpt=0;
           $totalln=0; $totaljft =0; $totaltot =0; 
           foreach ($alldata as $row) {
            
            //$kolok = $row->SPMU_NEW;
            
            $nalokl = $row->GOL_NEW;
            $cpns = $row->CPNS;
                $totalcpns = $totalcpns + $cpns;
            $eselon2 = $row->ESELON2;
                $totales2 = $totales2 + $eselon2;
            $eselon3 = $row->ESELON3;
                $totales3 = $totales3 + $eselon3;
            $eselon4 = $row->ESELON4;
                $totales4 = $totales4 + $eselon4;
            $ta = $row->TEKNIS_AHLI;
                $totalta = $totalta + $ta;
            $tt = $row->TEKNIS_TERAMPIL;
                $totaltt = $totaltt + $tt;
            $aa = $row->ADMINISTRASI_AHLI;
                $totalaa = $totalaa + $aa;
            $at = $row->ADMINISTRASI_TERAMPIL;
                $totalat = $totalat + $at;
            $oa = $row->OPERASIONAL_AHLI;
                $totaloa = $totaloa + $oa;
            $ot = $row->OPERASIONAL_TERAMPIL;
                $totalot = $totalot + $ot;
            $pa = $row->PELAYANAN_AHLI;
                $totalpa = $totalpa + $pa;
            $pt = $row->PELAYANAN_TERAMPIL;
                $totalpt = $totalpt + $pt;
            $ln = $row->LAINNYA;
                $totalln = $totalln + $ln;
            $jft = $row->JFT;
                $totaljft = $totaljft + $jft;
            $tot = $row->TOT;
                $totaltot = $totaltot + $tot;
            $html.= '
                <tr><td width="3%" style="text-align:center; vertical-align: middle !important;">'.$no.'</td>
                <td style="text-align:left; vertical-align: middle !important;" width="5%">'.number_format($nalokl, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($eselon2, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($eselon3, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($eselon4, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($cpns, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($ta, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($tt, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($aa, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($at, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($oa, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($ot, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($pa, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($pt, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($ln, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%">'.number_format($jft, 0, ',', '.').'</td>
                <td style="text-align:right; vertical-align: middle !important;" width="8%">'.number_format($tot, 0, ',', '.').'</td></tr>';
            
           
            //$this->pdf_ukpd->AddPage();
            
             //$this->pdf_ukpd->lastPage();
                $no++;
            }
            $html.= '
            <tr><td width="3%" style="text-align:center; vertical-align: middle !important;"></td>
                <td style="text-align:center; vertical-align: middle !important;" width="5%"> <strong>TOTAL (Rp)</strong></td>
                
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totales2, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totales3, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totales4, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totalcpns, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totalta, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totaltt, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totalaa, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totalat, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totaloa, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totalot, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totalpa, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totalpt, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totalln, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="6%"><strong>'.number_format($totaljft, 0, ',', '.').'</strong></td>
                <td style="text-align:right; vertical-align: middle !important;" width="8%"><strong>'.number_format($totaltot, 0, ',', '.').'</strong></td></tr>';
            $html.='</tbody></table>';
            $this->pdf_ukpd->AddPage();
            $this->pdf_ukpd->writeHTML($html, true, false, true, false, '');
             $this->pdf_ukpd->lastPage();
              ob_clean();          
            
            $this->pdf_ukpd->Output('GAJI.pdf', 'I');

    }

}
