<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper(array('form', 'url'));    	
    	$this->load->library('session');
    	$this->load->model('mhome','home');
        $this->load->library('infopegawai');
        $this->load->library('convert');
        

        if ($this->session->userdata('logged_in')) {            

            $session_data       = $this->session->userdata('logged_in');
            $this->user['id']     	= $session_data['id'];
            $this->user['username']  	= $session_data['username'];
            $this->user['user_group']     = $session_data['user_group'];
        }else{
			// redirect(base_url().'login/logout', 'refresh');
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
		// START Inisial Active Menu
            // $datam['li']=$this->home->showMenu();                
            // $datam['activeMenu'] = "270";
            $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'profile',0);
        // END Inisial Active Menu

            $data['nrk'] = $nrk;
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
            
            $infoUser = $this->home->getUserInfo2($nrk);
            $data['infoUser'] = $infoUser;

            $infoUser3 = $this->home->getuserInfo3($nrk);
            $data['infoUser3'] = $infoUser3;

            $infoPenForm = $this->home->getUserInfoPendFormal($nrk);
            $data['infoPenForm'] = $infoPenForm;

            $infoPenNForm = $this->home->getUserInfoPendNonFormal($nrk);
            $data['infoPenNForm'] = $infoPenNForm;

            $infoAlamat = $this->home->getUserInfoAlamat($nrk);
            $data['infoAlamat'] = $infoAlamat;  

            $infoHargaan = $this->home->getUserHargaan($nrk);
            $data['infoHargaan'] = $infoHargaan;

           

            $infoHubkel = $this->home->getUserHubkel($nrk);
            $data['infoHubkel'] = $infoHubkel;

            $infoPangkat = $this->home->getUserPangkat($nrk);
            $data['infoPangkat'] = $infoPangkat; 

            $infoGapokUser = $this->home->getUserGapok($nrk);

            $data['infoGapokUser'] = $infoGapokUser;

            $infoJabatanS = $this->home->getUserJabatanS($nrk);
            $data['infoJabatanS'] = $infoJabatanS;

            $infoJabatanF = $this->home->getUserJabatanF($nrk);
            $data['infoJabatanF'] = $infoJabatanF;  

            $infoCuti = $this->home->getUserCuti($nrk);
            $data['infoCuti'] = $infoCuti;

            $infoDisiplin = $this->home->getUserDisiplin($nrk);
            $data['infoDisiplin'] = $infoDisiplin;             
            

		$this->load->view('head/header',$this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('profile',$data);
		$this->load->view('head/footer');	        
	}
    
    public function toPdf()
    {
        $this->load->library('pdf_cv');


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
        // START Inisial Active Menu
            $datam['activeProfile'] = "active";
        // END Inisial Active Menu

            $data['nrk'] = $nrk;
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
            

            // ---------------------------------------------------

//            untuk develop 74
            $infoUser = $this->home->getUserInfo2($nrk);
            $data['infoUser'] = $infoUser;


            //untuk orp 1
  /*          $infoUser = $this->home->getUserInfoORP($nrk);
            $data['infoUser'] = $infoUser;*/

            // -----------------------------------------------

            // bisa dev74 dan orp1
            $infoPenForm = $this->home->getUserInfoPendFormal($nrk);
            $data['infoPenForm'] = $infoPenForm;

            // bisa dev74 dan orp1
            $infoPenNForm = $this->home->getUserInfoPendNonFormal($nrk);
            $data['infoPenNForm'] = $infoPenNForm;

            // bisa dev74 dan orp1
            $infoAlamat = $this->home->getUserInfoAlamat2($nrk);
            // print_r($infoAlamat);exit;
            $data['infoAlamat'] = $infoAlamat;  

            // bisa dev74 dan orp1
            $infoHargaan = $this->home->getUserHargaan($nrk);
            $data['infoHargaan'] = $infoHargaan;

            // bisa dev74 dan orp1 <tidak digunakan di pdf>
            $infoOrgan = $this->home->getUserOrgan($nrk);
            $data['infoOrgan'] = $infoOrgan; 

            //dev 74 <untuk orp 1 aktifkan query lihat model>
            $infoHubkel = $this->home->getUserHubkel($nrk);
            $data['infoHubkel'] = $infoHubkel;

            // bisa dev74 dan orp1
            $infoPangkat = $this->home->getUserPangkat($nrk);
            $data['infoPangkat'] = $infoPangkat; 

            // bisa dev74 dan orp1
            $infoJabatanS = $this->home->getUserJabatanS($nrk);
            $data['infoJabatanS'] = $infoJabatanS;

            // bisa dev74 dan orp1
            $infoJabatanF = $this->home->getUserJabatanF($nrk);
            $data['infoJabatanF'] = $infoJabatanF;

            // bisa dev74 dan orp1
            $infoGapokUser = $this->home->getUserGapok($nrk);
            $data['infoGapokUser'] = $infoGapokUser;
            
           // $this->load->view('cv_pdf',$data);
            ob_start();


            $this->pdf_cv->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE,'DAFTAR RIWAYAT HIDUP', PDF_HEADER_STRING);

// set header and footer fonts
            $this->pdf_cv->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $this->pdf_cv->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $this->pdf_cv->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $this->pdf_cv->SetMargins(PDF_MARGIN_LEFT, 38, PDF_MARGIN_RIGHT);
            //$this->pdf->SetMargins(15, 15, 15);
            //$this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $this->pdf_cv->SetHeaderMargin(25);
            //$this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            $this->pdf_cv->SetFooterMargin(25);

            // set auto page breaks
            $this->pdf_cv->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $this->pdf_cv->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf_cv->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set font
            $this->pdf_cv->SetFont('helvetica', 'B', 20);

            // add a page
            $this->pdf_cv->AddPage();

            $this->pdf_cv->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

            $this->pdf_cv->SetFont('helvetica', '', 8);

            // -----------------------------------------------------------------------------

            $tbl = '<table width="100%" cellpadding="3">
                        <tr>
                            <td colspan="3" style="background-color:#1AB394; color:white;"><h3>DATA DIRI</h3></td>
                        </tr>
                        <tr>
                            <td width="15%"><b>Nama </b></td>
                            <td width="5%"><b>: </b></td>';


            //untuk data dari develop 74
            // --------------------------------------------------------------------
            if($infoUser->TITELDEPAN == null && $infoUser->TITEL==null)
            {
                $tbl.=          '<td width="55%">'.$infoUser->NAMA_ABS.'</td>';
            }
            else if($infoUser->TITELDEPAN!=null && $infoUser->TITEL == null)
            {
                $tbl.=          '<td width="55%">'.$infoUser->TITELDEPAN.''.$infoUser->NAMA_ABS.'</td>';
            }
            else if($infoUser->TITELDEPAN == null && $infoUser->TITEL != null)
            {
                $tbl.=          '<td width="55%">'.$infoUser->NAMA_ABS.' '.$infoUser->TITEL.'</td>';
            }
            else
            {
                $tbl.=          '<td width="55%">'.$infoUser->TITELDEPAN.''.$infoUser->NAMA_ABS.''.$infoUser->TITEL.'</td>';    
            }

            //-----------------------------------------------------------------------


            //untuk data dari orp 1
            // ------------------------------------------------------------------------
                    //  $tbl.=          '<td width="55%">'.$infoUser->NAMA.' '.$infoUser->TITEL.'</td>';
            //----------------------------------------------------------------------

            $tbl.=          '<td></td>
                            
                        </tr>

                        <tr>
                            <td><b>NRK</b></td>
                            <td><b>:</b></td>
                            <td>'.$infoUser->NRK.'</td>
                            <td width="25%" rowspan="6" align="center">';
                                $linkImg = 'assets/img/photo/'.$infoUser->NRK.'.jpg';
                                    if(file_exists($linkImg))
                                    {
                                      $img = base_url().'assets/img/photo/'.$infoUser->NRK.'.jpg';                                    
                                    }
                                    else
                                    {
                                      $img = base_url().'assets/img/photo/profile_small.jpg';                                    
                                    }

            $tbl.=         '<img alt="image" class="img-box m-t-xs img-responsive" src="'.$img.'" width="68px" height="68px" style="border-radius:10px;">';
            $tbl.=         '</td>

                        </tr>
                          
                        <tr>
                            <td><b>NIP18</b></td>
                            <td><b>:</b></td>
                            <td>'.$infoUser->NIP18.'</td>
                        </tr>

                        <tr>
                            <td><b>Tempat/Tgl Lahir</b></td>
                            <td><b>:</b></td>
                            <td>'.$infoUser->PATHIR.', '.$infoUser->TLHR.'</td>
                        </tr>

                        <tr>
                            <td><b>Jabatan</b></td>
                            <td><b>:</b></td>
                            <td>'.$infoUser->NAJABL.'</td>
                        </tr>

                        <tr>
                            <td><b>Lokasi</b></td>
                            <td><b>:</b></td>
                            <td>'.$infoUser->NAKLOGAD.'</td>
                        </tr>
                          
                        <tr>
                            <td><b>Alamat</b></td>
                            <td><b>:</b></td>
                            <td>'.$infoAlamat->ALAMAT.' RT '.$infoAlamat->RT.' RW '.$infoAlamat->RW.
                                ' KEL. '.$infoAlamat->NAKEL.' KEC. '.$infoAlamat->NACAM.' '.$infoAlamat->NAWIL.' - '.strtoupper($infoAlamat->PROP).'</td>           
                        </tr>   
                        </table><br/><br/>';


        if($infoPenForm !=null){
            $tbl.=      '<table width="100%" cellpadding= "3">
                            <tr>
                                <td style="background-color:#1AB394; color:white;"><h3>Riwayat Pendidikan Formal</h3></td>
                            </tr>
                        </table>
                        
                        <table width="100%" border="1" cellpadding= "3">
                          
                          <tr>
                            <td align="center" width="5%" ><b>No</b></td>
                            
                            <td align="center" width="35%"><b>Nama Sekolah</b></td>
                            <td align="center" width="20%"><b>Kota Sekolah</b></td>
                            <td align="center" width="20%"><b>Tg Ijazah</b></td>
                            <td align="center" width="20%"><b>Tg Ijazah</b></td>
                          </tr>';
                            
                             $i=1;
                            foreach($infoPenForm as $row)
                            {
            $tbl.=              '<tr>
                                    <td align="center">'.$i.'</td>';

                                   
                                
                                if($row->UNIVER!='00000' AND $row->NASEK==" ")
                                {
                                    
            $tbl.=                        '<td >'.$row->NAUNIVER.'</td>';                        
                                }
                                else{
            $tbl.=                        '<td >'.$row->NASEK.'</td>';
                                    
                                }

            $tbl.=                        '<td>'.$row->KOTSEK.'</td>';
            $tbl.=                        '<td>'.$row->NOIJAZAH.'</td>';
                    $tglijazah = date("d-m-Y", strtotime($row->TGIJAZAH));
            $tbl.=                 '<td align="center" >'.$tglijazah.'</td>
                                </tr>';
                                 $i++;
                            }
            $tbl.=      '</table><br/><br/>';

        }


        if($infoPenNForm != null){

            $tbl.=      '<table width="100%" cellpadding= "3">
                            <tr>
                                <td style="background-color:#1AB394; color:white;"><h3>Riwayat Pendidikan Non Formal</h3></td>
                            </tr>
                        </table>

                        <table border="1" width="100%" cellpadding= "3">
                          
                          <tr>
                            <td width="5%" align="center"><b>No</b></td>
                            
                            <td width="35%" align="center"><b>Nama Sekolah</b></td>
                            <td width="20%" align="center"><b>Kota Sekolah</b></td>
                            <td width="20%" align="center"><b>No Ijazah</b></td>
                            <td width="20%" align="center"><b>Tg Ijazah</b></td>

                          </tr>';

                           $i=1;
                            foreach($infoPenNForm as $row)
                            {
            $tbl.=              '<tr>
                                    <td align="center">'.$i.'</td>';
                                    
            $tbl.=                  '<td>'.$row->NASEK.'</td> 
                                     <td>'.$row->KOTSEK.'</td>
                                     <td>'.$row->NOIJAZAH.'</td>';
            $tglijazah = date("d-m-Y", strtotime($row->TGIJAZAH));
            $tbl.=                  '<td align="center">'.$tglijazah.'</td>
                                </tr>';
                                $i++;
                            } 
            $tbl.=      '</table><br/><br/>';
        }

         if($infoHubkel !=null)
        {    
            $tbl.=     '<table width="100%" cellpadding= "3">
                            <tr>
                                <td style="background-color:#1AB394; color:white;"><h3>Keluarga</h3></td>
                            </tr>
                        </table>
                            <table border="1" width="100%" cellpadding= "3">
                                <tr>
                                    <td width="5%" align="center"><b>No</b></td>
                                    <td width="15%" align="center"><b>Hubungan</b></td>
                                    <td width="20%" align="center"><b>Nama</b></td>
                                    <td width="13%" align="center"><b>TTL</b></td>
                                    <td width="12%" align="center"><b>Jenis Kelamin</b></td>
                                    <td width="15%" align="center"><b>Tunjangan</b></td>
                                    <td width="20%" align="center"><b>Pekerjaan</b></td>
                              </tr>';

                            $i=1;
                            foreach($infoHubkel as $row)
                            {
            $tbl.=              '<tr>
                                    <td align="center">'.$i.'</td>
                                    <td>'.$row->NAHUBKEL.'</td>
                                    <td>'.$row->NAMA.'</td>';
                                    $talhir = date("d-m-Y", strtotime($row->TALHIR));
            $tbl.=                  '<td>'.$row->TEMHIR.', <br/>'.$talhir.'</td>
                                    <td align="center">'.($row->JENKEL == "P" ? "Perempuan" : "Laki-laki").'</td>';
                                if($row->TUNJANGAN == 'MENDAPAT TUNJANGAN')
                                {
            $tbl.=                  '<td>DAPAT</td>';
                                }
                                else if($row->TUNJANGAN == 'TIDAK MENDAPAT TUNJANGAN')
                                {
            $tbl.=                         '<td>TIDAK</td>';
                                }
                                else
                                {
            $tbl.=                         '<td>PERPANJANGAN</td>';
                                }
                                   
             $tbl.=             '<td>'.$row->KERJAAN.'</td>';

             $tbl.=             '</tr>';
                                $i++;
                            }
            $tbl.=          '</table>';
        }  
        
        //$this->pdf_cv->writeHTML($tbl, true, false, false, false, '');
         $this->pdf_cv->AddPage();
         $tblJ="";
        if($infoJabatanS !=null){

            $tbl.=      '<table width="100%" cellpadding= "3">
                            <tr>
                                <td style="background-color:#1AB394; color:white;"><h3>Riwayat Jabatan Struktural</h3></td>
                            </tr>
                        </table>
                        <table border="1" width="100%" cellpadding= "3">
                            <tr>
                                <td width="5%" align="center"><b>No</b></td>
                                <td width="10%" align="center"><b>TMT</b></td>
                                <td width="23%" align="center"><b>Lokasi</b></td>
                                <td width="15%" align="center"><b>Jabatan</b></td>
                                <td width="15%" align="center"><b>Pangkat (Gol)</b></td>
                                <td width="7%" align="center"><b>Eselon</b></td>
                                <td width="15%" align="center"><b>No. SK</b></td>
                                <td width="10%" align="center"><b>Tgl SK</b></td>
                            </tr>';

                            $i=1;
                            foreach($infoJabatanS as $row)
                            {
            $tbl.=              '<tr>
                                    <td align="center">'.$i.'</td>';
                                    $tmt = date("d-m-Y", strtotime($row->TMT));
            $tbl.=                  '<td align="center">'.$tmt.'</td>
                                    <td>'.$row->NALOKL.'</td>    
                                    <td>'.$row->NAJABL.'</td>
                                    <td>'.$row->NAPANG.' ('.$row->GOL.' )</td>
                                    <td align="center">'.$row->ESELON.'</td>
                                    <td>'.$row->NOSK.'</td>';
                                    $tgsk = date("d-m-Y", strtotime($row->TGSK));
            $tbl.=                  '<td align="center">'.$tgsk.'</td>
                                </tr>';
                                $i++;
                            }
            $tbl.=          '</table><br/><br/>';

        }

        if($infoJabatanF !=null){

            $tbl.=      '<table width="100%" cellpadding= "3">
                            <tr>
                                <td style="background-color:#1AB394; color:white;"><h3>Riwayat Jabatan Fungsional</h3></td>
                            </tr>
                        </table>
                        <table border="1" width="100%" cellpadding= "3">
                            <tr>
                                <td width="5%" align="center"><b>No</b></td>
                                <td width="10%"align="center"><b>TMT</b></td>
                                <td width="30%" align="center"><b>Lokasi</b></td>
                                <td width="15%" align="center"><b>Jabatan</b></td>
                                <td width="20%" align="center"><b>Pangkat (Gol)</b></td>
                                <td width="10%"align="center"><b>No SK</b></td>
                                <td width="10%"align="center"><b>Tgl SK</b></td>
                            </tr>';
                            
                            $i=1;
                            foreach($infoJabatanF as $row)
                            {
            $tbl.=              '<tr>
                                    <td align="center">'.$i.'</td>';
                                    $tmt = date('d-m-Y', strtotime($row->TMT));
            $tbl.=                  '<td align="center">'.$tmt.'</td>
                                    <td>'.$row->NALOKL.'</td>
                                    <td>'.$row->NAJABL.'</td>
                                    <td>'.$row->NAPANG.' ( '.$row->GOL.' )</td>
                                    <td>'.$row->NOSK.'</td>';
                                    $tgsk = date("d-m-Y", strtotime($row->TGSK));
            $tbl.=                  '<td align="center">'.$tgsk.'</td>
                                </tr>';
                              $i++;
                            }
            $tbl.=          '</table><br/><br/>';
            
        }
        
       // $this->pdf_cv->writeHTML($tblJ, true, false, false, false, '');
         $this->pdf_cv->AddPage();
        
        $tbl2="";

        if($infoGapokUser !=null){        

            $tbl.= '    <table width="100%" cellpadding= "3">
                            <tr>
                                <td style="background-color:#1AB394; color:white;"><h3>Riwayat Gaji</h3></td>
                            </tr>
                        </table>
                            <table border="1" width="100%" cellpadding= "3">
                                <tr>
                                    <td width="5%" align="center"><b>No</b></td>
                                    <td width="15%" align="center"><b>TMT</b></td>
                                    <td width="20%" align="center"><b>Pangkat (Gol)</b></td>
                                    <td width="20%" align="center"><b>Gaji</b></td>
                                    <td width="20%" align="center"><b>No. SK</b></td>
                                    <td width="20%" align="center"><b>Tg. SK</b></td>
                                    
                              </tr>';

                              $i=1;
                              foreach($infoGapokUser as $row)
                              {
            $tbl.=              '<tr>
                                    <td align="center">'.$i.'</td>';
                                    $tmt = date('d-m-Y', strtotime($row->TMT));
            $tbl.=                  '<td align="center">'.$tmt.'</td>
                                    <td>'.$row->NAPANG.'( '.$row->GOL.' )</td>
                                    <td align="center">'.number_format($row->GAPOK).'</td>
                                     <td>'.$row->NOSK.'</td>';
                                    $tgsk = date("d-m-Y", strtotime($row->TGSK));
            $tbl.=                  '<td align="center">'.$tgsk.'</td>
                                    
                                </tr>';
                                $i++;
                              }
            $tbl.=          '</table><br/><br/>';
           
        }       

        
        

        if($infoPangkat !=null){        

            $tbl.= '    <table width="100%" cellpadding= "3">
                            <tr>
                                <td style="background-color:#1AB394; color:white;"><h3>Riwayat Pangkat</h3></td>
                            </tr>
                        </table>
                            <table border="1" width="100%" cellpadding= "3">
                                <tr>
                                    <td width="5%" align="center"><b>No</b></td>
                                    <td width="12%" align="center"><b>TMT</b></td>
                                    <td width="23%" align="center"><b>Pangkat (Gol)</b></td>
                                    <td width="30%" align="center"><b>Lokasi</b></td>
                                    <td width="15%" align="center"><b>No. SK</b></td>
                                    <td width="15%" align="center"><b>Tg. SK</b></td>
                                    
                              </tr>';

                              $i=1;
                              foreach($infoPangkat as $row)
                              {
            $tbl.=              '<tr>
                                    <td align="center">'.$i.'</td>';
                                    $tmt = date('d-m-Y', strtotime($row->TMT));
            $tbl.=                  '<td align="center">'.$tmt.'</td>
                                    <td>'.$row->NAPANG.'( '.$row->GOL.' )</td>
                                    <td>'.$row->NALOKL.'</td>
                                     <td>'.$row->NOSK.'</td>';
                                    $tgsk = date("d-m-Y", strtotime($row->TGSK));
            $tbl.=                  '<td align="center">'.$tgsk.'</td>
                                    
                                </tr>';
                                $i++;
                              }
            $tbl.=          '</table><br/><br/>';
           
        }

        
        if($infoHargaan !=null)
        {

            $tbl.=      '<table width="100%" cellpadding= "3">
                            <tr>
                                <td style="background-color:#1AB394; color:white;"><h3>Riwayat Penghargaan</h3></td>
                            </tr>
                        </table>
                        <table border="1" width="100%" cellpadding= "3">
                            <tr>
                              <td width="5%" align="center"><b>No</b></td>
                              
                              <td width="40%" align="center"><b>Nama Penghargaan</b></td>
                              <td width="25%" align="center"><b>Asal Penghargaan</b></td>
                              <td width="15%" align="center"><b>No. SK</b></td>
                              <td width="15%" align="center"><b>Tg. SK</b></td>
                            </tr>';

                            $i=1;
                            foreach($infoHargaan as $row)
                            {
            $tbl.=              '<tr>
                                    <td align="center">'.$i.'</td>
                                    <td>'.$row->NAHARGA.'</td>   
                                    <td>'.$row->ASAL_HRG.'</td>
                                    <td> '.$row->NOSK.'</td> 
                                    <td> '.$row->TGSK.'</td> </tr>';
                                $i++;
                            }                 
            $tbl.=      '</table><br/><br/>';
           
        }


         
            
            $this->pdf_cv->writeHTML($tbl, true, false, false, false, '');
            //$this->pdf_cv->IncludeJS("print();");
              
              
         ob_clean(); 
            
            $this->pdf_cv->Output('cv.pdf', 'I');

    }

    public function toPdf2()
    {
        $this->load->library('pdf');
        $nrk = $this->input->post('nrkpr');

            // if(isset($_POST['nrk'])){
            //         $nrk = $_POST['nrk'];
            //     }elseif(isset($_POST['nrkP'])){ //Pencarian NRK Untuk Admin/BKD
            //         $nrk = $_POST['nrkP'];                    
            //     }else{
            //         $nrk = $this->user['id'];
                    
            //         if($this->user['user_group'] > 1){
            //             $nrk = "";
            //         }
            //     }                                            
            // END GET NRK
        // START Inisial Active Menu
            $datam['activeProfile'] = "active";
        // END Inisial Active Menu

            $data['nrk'] = $nrk;
            $datam['nrk'] = $nrk;
            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
            

            // ---------------------------------------------------

//            untuk develop 74
            $infoUser = $this->home->getUserInfo2($nrk);
            $data['infoUser'] = $infoUser;


            //untuk orp 1
  /*          $infoUser = $this->home->getUserInfoORP($nrk);
            $data['infoUser'] = $infoUser;*/

            // -----------------------------------------------

            // bisa dev74 dan orp1
            $infoPenForm = $this->home->getUserInfoPendFormal($nrk);
            $data['infoPenForm'] = $infoPenForm;

            // bisa dev74 dan orp1
            $infoPenNForm = $this->home->getUserInfoPendNonFormal($nrk);
            $data['infoPenNForm'] = $infoPenNForm;

            // bisa dev74 dan orp1
            $infoAlamat = $this->home->getUserInfoAlamat2($nrk);
            // print_r($infoAlamat);exit;
            $data['infoAlamat'] = $infoAlamat;  

            // bisa dev74 dan orp1
            $infoHargaan = $this->home->getUserHargaan($nrk);
            $data['infoHargaan'] = $infoHargaan;

            // bisa dev74 dan orp1 <tidak digunakan di pdf>
            $infoOrgan = $this->home->getUserOrgan($nrk);
            $data['infoOrgan'] = $infoOrgan; 

            //dev 74 <untuk orp 1 aktifkan query lihat model>
            $infoHubkel = $this->home->getUserHubkel($nrk);
            $data['infoHubkel'] = $infoHubkel;

            // bisa dev74 dan orp1
            $infoPangkat = $this->home->getUserPangkat($nrk);
            $data['infoPangkat'] = $infoPangkat; 

            // bisa dev74 dan orp1
            $infoJabatanS = $this->home->getUserJabatanS($nrk);
            $data['infoJabatanS'] = $infoJabatanS;

            // bisa dev74 dan orp1
            $infoJabatanF = $this->home->getUserJabatanF($nrk);
            $data['infoJabatanF'] = $infoJabatanF;

            // bisa dev74 dan orp1
            $infoGapokUser = $this->home->getUserGapok($nrk);
            $data['infoGapokUser'] = $infoGapokUser;
            
           // $this->load->view('cv_pdf',$data);
            ob_start();


            $this->pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE,'DAFTAR RIWAYAT HIDUP', PDF_HEADER_STRING);

// set header and footer fonts
            $this->pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $this->pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $this->pdf->SetMargins(PDF_MARGIN_LEFT, 38, PDF_MARGIN_RIGHT);
            //$this->pdf->SetMargins(15, 15, 15);
            //$this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $this->pdf->SetHeaderMargin(25);
            //$this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            $this->pdf->SetFooterMargin(25);

            // set auto page breaks
            $this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set font
            $this->pdf->SetFont('helvetica', 'B', 20);

            // add a page
            $this->pdf->AddPage();

            //$this->pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

            $this->pdf->SetFont('helvetica', '', 8);

            // -----------------------------------------------------------------------------

            $tbl = '<table width="100%" cellpadding="3">
                        <tr>
                            <td colspan="3" style="background-color:#1AB394; color:white;"><h3>DATA DIRI</h3></td>
                        </tr>
                        <tr>
                            <td width="15%"><b>Nama </b></td>
                            <td width="5%"><b>: </b></td>';


            //untuk data dari develop 74
            // --------------------------------------------------------------------
            if($infoUser->TITELDEPAN == null && $infoUser->TITEL==null)
            {
                $tbl.=          '<td width="55%">'.$infoUser->NAMA_ABS.'</td>';
            }
            else if($infoUser->TITELDEPAN!=null && $infoUser->TITEL == null)
            {
                $tbl.=          '<td width="55%">'.$infoUser->TITELDEPAN.''.$infoUser->NAMA_ABS.'</td>';
            }
            else if($infoUser->TITELDEPAN == null && $infoUser->TITEL != null)
            {
                $tbl.=          '<td width="55%">'.$infoUser->NAMA_ABS.' '.$infoUser->TITEL.'</td>';
            }
            else
            {
                $tbl.=          '<td width="55%">'.$infoUser->TITELDEPAN.''.$infoUser->NAMA_ABS.''.$infoUser->TITEL.'</td>';    
            }

            //-----------------------------------------------------------------------


            //untuk data dari orp 1
            // ------------------------------------------------------------------------
                    //  $tbl.=          '<td width="55%">'.$infoUser->NAMA.' '.$infoUser->TITEL.'</td>';
            //----------------------------------------------------------------------

            $tbl.=          '<td></td>
                            
                        </tr>

                        <tr>
                            <td><b>NRK</b></td>
                            <td><b>:</b></td>
                            <td>'.$infoUser->NRK.'</td>
                            <td width="25%" rowspan="6" align="center">';
                                $linkImg = 'assets/img/photo/'.$infoUser->NRK.'.jpg';
                                    if(file_exists($linkImg))
                                    {
                                      $img = base_url().'assets/img/photo/'.$infoUser->NRK.'.jpg';                                    
                                    }
                                    else
                                    {
                                      $img = base_url().'assets/img/photo/profile_small.jpg';                                    
                                    }

            $tbl.=         '<img alt="image" class="img-box m-t-xs img-responsive" src="'.$img.'" width="68px" height="68px" style="border-radius:10px;">';
            $tbl.=         '</td>

                        </tr>
                          
                        <tr>
                            <td><b>NIP18</b></td>
                            <td><b>:</b></td>
                            <td>'.$infoUser->NIP18.'</td>
                        </tr>

                        <tr>
                            <td><b>Tempat/Tgl Lahir</b></td>
                            <td><b>:</b></td>
                            <td>'.$infoUser->PATHIR.', '.$infoUser->TLHR.'</td>
                        </tr>

                        <tr>
                            <td><b>Jabatan</b></td>
                            <td><b>:</b></td>
                            <td>'.$infoUser->NAJABL.'</td>
                        </tr>

                        <tr>
                            <td><b>Lokasi</b></td>
                            <td><b>:</b></td>
                            <td>'.$infoUser->NALOKL.'</td>
                        </tr>
                          
                        <tr>
                            <td><b>Alamat</b></td>
                            <td><b>:</b></td>
                            <td>'.$infoAlamat->ALAMAT.' RT '.$infoAlamat->RT.' RW '.$infoAlamat->RW.
                                ' KEL. '.$infoAlamat->NAKEL.' KEC. '.$infoAlamat->NACAM.' '.$infoAlamat->NAWIL.' - '.strtoupper($infoAlamat->PROP).'</td>           
                        </tr>   
                        </table><br/><br/>';


        if($infoPenForm !=null){
            $tbl.=      '<table width="100%" cellpadding= "3">
                            <tr>
                                <td style="background-color:#1AB394; color:white;"><h3>Riwayat Pendidikan Formal</h3></td>
                            </tr>
                        </table>
                        
                        <table width="100%" border="1" cellpadding= "3">
                          
                          <tr>
                            <td align="center" width="5%" ><b>No</b></td>
                            
                            <td align="center" width="35%"><b>Nama Sekolah</b></td>
                            <td align="center" width="20%"><b>Kota Sekolah</b></td>
                            <td align="center" width="20%"><b>Tg Ijazah</b></td>
                            <td align="center" width="20%"><b>Tg Ijazah</b></td>
                          </tr>';
                            
                             $i=1;
                            foreach($infoPenForm as $row)
                            {
            $tbl.=              '<tr>
                                    <td align="center">'.$i.'</td>';

                                   
                                
                                if($row->UNIVER!='00000' AND $row->NASEK==" ")
                                {
                                    
            $tbl.=                        '<td >'.$row->NAUNIVER.'</td>';                        
                                }
                                else{
            $tbl.=                        '<td >'.$row->NASEK.'</td>';
                                    
                                }

            $tbl.=                        '<td>'.$row->KOTSEK.'</td>';
            $tbl.=                        '<td>'.$row->NOIJAZAH.'</td>';
                    $tglijazah = date("d-m-Y", strtotime($row->TGIJAZAH));
            $tbl.=                 '<td align="center" >'.$tglijazah.'</td>
                                </tr>';
                                 $i++;
                            }
            $tbl.=      '</table><br/><br/>';

        }


        if($infoPenNForm != null){

            $tbl.=      '<table width="100%" cellpadding= "3">
                            <tr>
                                <td style="background-color:#1AB394; color:white;"><h3>Riwayat Pendidikan Non Formal</h3></td>
                            </tr>
                        </table>

                        <table border="1" width="100%" cellpadding= "3">
                          
                          <tr>
                            <td width="5%" align="center"><b>No</b></td>
                            
                            <td width="35%" align="center"><b>Nama Sekolah</b></td>
                            <td width="20%" align="center"><b>Kota Sekolah</b></td>
                            <td width="20%" align="center"><b>No Ijazah</b></td>
                            <td width="20%" align="center"><b>Tg Ijazah</b></td>

                          </tr>';

                           $i=1;
                            foreach($infoPenNForm as $row)
                            {
            $tbl.=              '<tr>
                                    <td align="center">'.$i.'</td>';
                                    
            $tbl.=                  '<td>'.$row->NASEK.'</td> 
                                     <td>'.$row->KOTSEK.'</td>
                                     <td>'.$row->NOIJAZAH.'</td>';
            $tglijazah = date("d-m-Y", strtotime($row->TGIJAZAH));
            $tbl.=                  '<td align="center">'.$tglijazah.'</td>
                                </tr>';
                                $i++;
                            } 
            $tbl.=      '</table><br/><br/>';
        }

        if($infoHubkel !=null)
        {    
            $tbl.=     '<table width="100%" cellpadding= "3">
                            <tr>
                                <td style="background-color:#1AB394; color:white;"><h3>Keluarga</h3></td>
                            </tr>
                        </table>
                            <table border="1" width="100%" cellpadding= "3">
                                <tr>
                                    <td width="5%" align="center"><b>No</b></td>
                                    <td width="15%" align="center"><b>Hubungan</b></td>
                                    <td width="20%" align="center"><b>Nama</b></td>
                                    <td width="13%" align="center"><b>TTL</b></td>
                                    <td width="12%" align="center"><b>Jenis Kelamin</b></td>
                                    <td width="15%" align="center"><b>Tunjangan</b></td>
                                    <td width="20%" align="center"><b>Pekerjaan</b></td>
                              </tr>';

                            $i=1;
                            foreach($infoHubkel as $row)
                            {
            $tbl.=              '<tr>
                                    <td align="center">'.$i.'</td>
                                    <td>'.$row->NAHUBKEL.'</td>
                                    <td>'.$row->NAMA.'</td>';
                                    $talhir = date("d-m-Y", strtotime($row->TALHIR));
            $tbl.=                  '<td>'.$row->TEMHIR.', <br/>'.$talhir.'</td>
                                    <td align="center">'.($row->JENKEL == "P" ? "Perempuan" : "Laki-laki").'</td>';
                                if($row->TUNJANGAN == 'MENDAPAT TUNJANGAN')
                                {
            $tbl.=                  '<td>DAPAT</td>';
                                }
                                else if($row->TUNJANGAN == 'TIDAK MENDAPAT TUNJANGAN')
                                {
            $tbl.=                         '<td>TIDAK</td>';
                                }
                                else
                                {
            $tbl.=                         '<td>PERPANJANGAN</td>';
                                }
                                   
             $tbl.=             '<td>'.$row->KERJAAN.'</td>';

             $tbl.=             '</tr>';
                                $i++;
                            }
            $tbl.=          '</table>';
        }   

        $this->pdf->writeHTML($tbl,  true, false, true, false, '');
        
        
         $this->pdf->AddPage();
         $tblJ="";

        if($infoJabatanS !=null){

            $tblJ.=      '<table width="100%" cellpadding= "3">
                            <tr>
                                <td style="background-color:#1AB394; color:white;"><h3>Riwayat Jabatan Struktural</h3></td>
                            </tr>
                        </table>
                        <table border="1" width="100%" cellpadding= "3">
                            <tr>
                                <td width="5%" align="center"><b>No</b></td>
                                <td width="10%" align="center"><b>TMT</b></td>
                                <td width="23%" align="center"><b>Lokasi</b></td>
                                <td width="15%" align="center"><b>Jabatan</b></td>
                                <td width="15%" align="center"><b>Pangkat (Gol)</b></td>
                                <td width="7%" align="center"><b>Eselon</b></td>
                                <td width="15%" align="center"><b>No. SK</b></td>
                                <td width="10%" align="center"><b>Tgl SK</b></td>
                            </tr>';

                            $i=1;
                            foreach($infoJabatanS as $row)
                            {
            $tblJ.=              '<tr>
                                    <td align="center">'.$i.'</td>';
                                    $tmt = date("d-m-Y", strtotime($row->TMT));
            $tblJ.=                  '<td align="center">'.$tmt.'</td>
                                    <td>'.$row->NALOKL.'</td>    
                                    <td>'.$row->NAJABL.'</td>
                                    <td>'.$row->NAPANG.' ('.$row->GOL.' )</td>
                                    <td align="center">'.$row->ESELON.'</td>
                                    <td>'.$row->NOSK.'</td>';
                                    $tgsk = date("d-m-Y", strtotime($row->TGSK));
            $tblJ.=                  '<td align="center">'.$tgsk.'</td>
                                </tr>';
                                $i++;
                            }
            $tblJ.=          '</table><br/><br/>';

        }

        if($infoJabatanF !=null){

            $tblJ.=      '<table width="100%" cellpadding= "3">
                            <tr>
                                <td style="background-color:#1AB394; color:white;"><h3>Riwayat Jabatan Fungsional</h3></td>
                            </tr>
                        </table>
                        <table border="1" width="100%" cellpadding= "3">
                            <tr>
                                <td width="5%" align="center"><b>No</b></td>
                                <td width="10%"align="center"><b>TMT</b></td>
                                <td width="30%" align="center"><b>Lokasi</b></td>
                                <td width="15%" align="center"><b>Jabatan</b></td>
                                <td width="20%" align="center"><b>Pangkat (Gol)</b></td>
                                <td width="10%"align="center"><b>No SK</b></td>
                                <td width="10%"align="center"><b>Tgl SK</b></td>
                            </tr>';
                            
                            $i=1;
                            foreach($infoJabatanF as $row)
                            {
            $tblJ.=              '<tr>
                                    <td align="center">'.$i.'</td>';
                                    $tmt = date('d-m-Y', strtotime($row->TMT));
            $tblJ.=                  '<td align="center">'.$tmt.'</td>
                                    <td>'.$row->NALOKL.'</td>
                                    <td>'.$row->NAJABL.'</td>
                                    <td>'.$row->NAPANG.' ( '.$row->GOL.' )</td>
                                    <td>'.$row->NOSK.'</td>';
                                    $tgsk = date("d-m-Y", strtotime($row->TGSK));
            $tblJ.=                  '<td align="center">'.$tgsk.'</td>
                                </tr>';
                              $i++;
                            }
            $tblJ.=          '</table><br/><br/>';
            
        }

        $this->pdf->writeHTML($tblJ,  true, false, true, false, '');
        

        $this->pdf->AddPage();
        
        $tbl2="";

        if($infoGapokUser !=null){        

            $tbl2.= '    <table width="100%" cellpadding= "3">
                            <tr>
                                <td style="background-color:#1AB394; color:white;"><h3>Riwayat Gaji</h3></td>
                            </tr>
                        </table>
                            <table border="1" width="100%" cellpadding= "3">
                                <tr>
                                    <td width="5%" align="center"><b>No</b></td>
                                    <td width="15%" align="center"><b>TMT</b></td>
                                    <td width="20%" align="center"><b>Pangkat (Gol)</b></td>
                                    <td width="20%" align="center"><b>Gaji</b></td>
                                    <td width="20%" align="center"><b>No. SK</b></td>
                                    <td width="20%" align="center"><b>Tg. SK</b></td>
                                    
                              </tr>';

                              $i=1;
                              foreach($infoGapokUser as $row)
                              {
            $tbl2.=              '<tr>
                                    <td align="center">'.$i.'</td>';
                                    $tmt = date('d-m-Y', strtotime($row->TMT));
            $tbl2.=                  '<td align="center">'.$tmt.'</td>
                                    <td>'.$row->NAPANG.'( '.$row->GOL.' )</td>
                                    <td align="center">'.number_format($row->GAPOK).'</td>
                                     <td>'.$row->NOSK.'</td>';
                                    $tgsk = date("d-m-Y", strtotime($row->TGSK));
            $tbl2.=                  '<td align="center">'.$tgsk.'</td>
                                    
                                </tr>';
                                $i++;
                              }
            $tbl2.=          '</table><br/><br/>';
           
        }       

        
        

        if($infoPangkat !=null){        

            $tbl2.= '    <table width="100%" cellpadding= "3">
                            <tr>
                                <td style="background-color:#1AB394; color:white;"><h3>Riwayat Pangkat</h3></td>
                            </tr>
                        </table>
                            <table border="1" width="100%" cellpadding= "3">
                                <tr>
                                    <td width="5%" align="center"><b>No</b></td>
                                    <td width="12%" align="center"><b>TMT</b></td>
                                    <td width="23%" align="center"><b>Pangkat (Gol)</b></td>
                                    <td width="30%" align="center"><b>Lokasi</b></td>
                                    <td width="15%" align="center"><b>No. SK</b></td>
                                    <td width="15%" align="center"><b>Tg. SK</b></td>
                                    
                              </tr>';

                              $i=1;
                              foreach($infoPangkat as $row)
                              {
            $tbl2.=              '<tr>
                                    <td align="center">'.$i.'</td>';
                                    $tmt = date('d-m-Y', strtotime($row->TMT));
            $tbl2.=                  '<td align="center">'.$tmt.'</td>
                                    <td>'.$row->NAPANG.'( '.$row->GOL.' )</td>
                                    <td>'.$row->NALOKL.'</td>
                                     <td>'.$row->NOSK.'</td>';
                                    $tgsk = date("d-m-Y", strtotime($row->TGSK));
            $tbl2.=                  '<td align="center">'.$tgsk.'</td>
                                    
                                </tr>';
                                $i++;
                              }
            $tbl2.=          '</table><br/><br/>';
           
        }

        
        if($infoHargaan !=null)
        {

            $tbl2.=      '<table width="100%" cellpadding= "3">
                            <tr>
                                <td style="background-color:#1AB394; color:white;"><h3>Riwayat Penghargaan</h3></td>
                            </tr>
                        </table>
                        <table border="1" width="100%" cellpadding= "3">
                            <tr>
                              <td width="5%" align="center"><b>No</b></td>
                              
                              <td width="40%" align="center"><b>Nama Penghargaan</b></td>
                              <td width="25%" align="center"><b>Asal Penghargaan</b></td>
                              <td width="15%" align="center"><b>No. SK</b></td>
                              <td width="15%" align="center"><b>Tg. SK</b></td>
                            </tr>';

                            $i=1;
                            foreach($infoHargaan as $row)
                            {
            $tbl2.=              '<tr>
                                    <td align="center">'.$i.'</td>
                                    <td>'.$row->NAHARGA.'</td>   
                                    <td>'.$row->ASAL_HRG.'</td>
                                    <td> '.$row->NOSK.'</td> 
                                    <td> '.$row->TGSK.'</td> </tr>';
                                $i++;
                            }                 
            $tbl2.=      '</table><br/><br/>';
           
        }

            $this->pdf->writeHTML($tbl2, true, false, true, false, '');
            
              ob_clean();          
            
            $this->pdf->Output('cv.pdf', 'I');

    }

    public function CV()
    {
        $this->load->library('fpdf_cv');
        $nrk = $this->input->post('nrkpr');
        
        $infoUser = $this->home->getUserInfo2($nrk);
        $data['infoUser'] = $infoUser;


        // bisa dev74 dan orp1
        $infoPenForm = $this->home->getUserInfoPendFormal($nrk);
        $data['infoPenForm'] = $infoPenForm;

        // bisa dev74 dan orp1
        $infoPenNForm = $this->home->getUserInfoPendNonFormal($nrk);
        $data['infoPenNForm'] = $infoPenNForm;

        // bisa dev74 dan orp1
        $infoAlamat = $this->home->getUserInfoAlamat2($nrk);
        // print_r($infoAlamat);exit;

        $data['infoAlamat'] = $infoAlamat;  

        // bisa dev74 dan orp1
        $infoHargaan = $this->home->getUserHargaan($nrk);
        $data['infoHargaan'] = $infoHargaan;

        // bisa dev74 dan orp1 <tidak digunakan di pdf>
        $infoOrgan = $this->home->getUserOrgan($nrk);
        $data['infoOrgan'] = $infoOrgan; 

        //dev 74 <untuk orp 1 aktifkan query lihat model>
        $infoHubkel = $this->home->getUserHubkel($nrk);
        $data['infoHubkel'] = $infoHubkel;

        // bisa dev74 dan orp1
        $infoPangkat = $this->home->getUserPangkat($nrk);
        $data['infoPangkat'] = $infoPangkat; 

        // bisa dev74 dan orp1
        $infoJabatanS = $this->home->getUserJabatanS($nrk);
        $data['infoJabatanS'] = $infoJabatanS;

        // bisa dev74 dan orp1
        $infoJabatanF = $this->home->getUserJabatanF($nrk);
        $data['infoJabatanF'] = $infoJabatanF;

        // bisa dev74 dan orp1
        $infoGapokUser = $this->home->getUserGapok($nrk);
        $data['infoGapokUser'] = $infoGapokUser;
            
           // $this->load->view('cv_pdf',$data);
        $this->fpdf_cv->SetFont('helvetica', 'B', 20);
        // add a page
        $this->fpdf_cv->AddPage();

        $this->fpdf_cv->SetFont('helvetica', '', 8);

        $this->fpdf_cv->isiData($data,$nrk);    
        
        $this->fpdf_cv->Output();

    }

    public function DRH()
    {
        $this->load->library('fpdf_cv');
        

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

        $infoUser = $this->home->getUserInfo2($nrk);
        $data['infoUser'] = $infoUser;


        // bisa dev74 dan orp1
        $infoPenForm = $this->home->getUserInfoPendFormal($nrk);
        $data['infoPenForm'] = $infoPenForm;

        // bisa dev74 dan orp1
        $infoPenNForm = $this->home->getUserInfoPendNonFormal($nrk);
        $data['infoPenNForm'] = $infoPenNForm;

        // bisa dev74 dan orp1
        $infoAlamat = $this->home->getUserInfoAlamat2($nrk);
        
        $data['infoAlamat'] = $infoAlamat;  

        // bisa dev74 dan orp1
        $infoHargaan = $this->home->getUserHargaan($nrk);
        $data['infoHargaan'] = $infoHargaan;

        // bisa dev74 dan orp1 <tidak digunakan di pdf>
        $infoOrgan = $this->home->getUserOrgan($nrk);
        $data['infoOrgan'] = $infoOrgan; 

        //dev 74 <untuk orp 1 aktifkan query lihat model>
        $infoHubkel = $this->home->getUserHubkel($nrk);
        $data['infoHubkel'] = $infoHubkel;

        // bisa dev74 dan orp1
        $infoPangkat = $this->home->getUserPangkat($nrk);
        $data['infoPangkat'] = $infoPangkat; 

        // bisa dev74 dan orp1
        $infoJabatanS = $this->home->getUserJabatanS($nrk);
        $data['infoJabatanS'] = $infoJabatanS;

        // bisa dev74 dan orp1
        $infoJabatanF = $this->home->getUserJabatanF($nrk);
        $data['infoJabatanF'] = $infoJabatanF;

        // bisa dev74 dan orp1
        $infoGapokUser = $this->home->getUserGapok($nrk);
        $data['infoGapokUser'] = $infoGapokUser;
            
           // $this->load->view('cv_pdf',$data);
        $this->fpdf_cv->SetFont('helvetica', 'B', 20);
        // add a page
        $this->fpdf_cv->AddPage();

        $this->fpdf_cv->SetFont('helvetica', '', 8);

        $this->fpdf_cv->isiData($data,$nrk);    
        
        $this->fpdf_cv->Output();

    }	
            		
}
?>            
