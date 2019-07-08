<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistik extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
        $this->load->helper(array('form', 'url'));    	
    	$this->load->library('session');
        
    
        $this->load->model('mstatistik','mdl');
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
            
                $datam['activeMenu'] = "27996";
                $datam['activemn']=$this->infopegawai->initialMenu($this->user['user_group'],'statistik',0);
                $datam['inisial'] = 'statistik';
                $datam['nrk'] = $nrk;
                $datam['user_group'] = $this->user['user_group'];
             


            $data['menu_select'] = $this->infopegawai->getMenuSelectHistNew($this->user['user_group']);

            $data['thblparam'] = $this->mdl->getThblparam();
           	
           	$thblp="";
           	$skpdp="";
           	$data['skpdparam'] = $this->mdl->getSpmuFromThbl($thblp);  
           	$data['ukpdparam'] = $this->mdl->getUkpdFromThblSpm($thblp,$skpdp);  
           
           
           /* $jenkel = $this->mdl->getAllStatGender();
            $pria = $jenkel[0]->JML;
            $wanita = $jenkel[1]->JML;*/


            $datam['user_group'] = $this->user['user_group'];
            $data['user_id'] = $this->user['id'];
            $data['user_group'] = $this->user['user_group'];
          
          /* $data['pria'] = $pria;
            $data['wanita'] = $wanita;*/
        
         

			$this->load->view('head/header',$this->user);
			$this->load->view('head/menu',$datam);
			$this->load->view('vstatistik',$data);
            
			$this->load->view('head/footer');

	}

	public function getSpmuFromThbl()
    {

        $thbl = $this->input->post('thbl');
        

        $list = $this->mdl->getSpmuFromThbl($thbl);
        
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }

    public function getUkpdFromThbl()
    {

        $thbl = $this->input->post('thbl');
        $spmu = $this->input->post('skpd');


        $list = $this->mdl->getUkpdFromThblSpm($thbl,$spmu);
        
        $arr = array('response' => 'SUKSES', 'list' => $list);
        echo json_encode($arr);
    }

    public function eksekusidata()
    {
    	//var_dump($this->input->post());exit;
    	$jenis = $this->input->post('jenis');
    	$thbl = $this->input->post('thbl');
        $spmu = $this->input->post('skpd');
        $ukpd = $this->input->post('ukpd');

        if($jenis == '1')
        {
        	/*$list = $this->mdl->getStatGender($thbl,$spmu,$ukpd);	
        	$listne='';*/
        	$list = $this->mdl->getStatGenderPNS($thbl,$spmu,$ukpd);  
            $listne = $this->mdl->getStatGenderCPNS($thbl,$spmu,$ukpd);   
        }
        else if($jenis == '2')
        {
            $list = $this->mdl->getStatEselon($thbl,$spmu,$ukpd);  
            $listne = $this->mdl->getStatNonEselon($thbl,$spmu,$ukpd);      
        }
        else if($jenis == '3')
        {
            $list = $this->mdl->getStatUsia($thbl,$spmu,$ukpd);  
            $listne = '';      
        }
        else if($jenis == '4')
        {
            $list = $this->mdl->getStatPangkat($thbl,$spmu,$ukpd);  
            $listne = '';      
        }
        else if($jenis == '5')
        {
            $list = $this->mdl->getStatPendidikan($thbl,$spmu,$ukpd);  
            $listne = $this->mdl->getStatPendidikanCPNS($thbl,$spmu,$ukpd);   
        }
        else if($jenis == '6')
        {
            $list = $this->mdl->getStatStawin($thbl,$spmu,$ukpd);  
            $listne = $this->mdl->getStatStawincpns($thbl,$spmu,$ukpd);   
        }
        else if($jenis == '7')
        {
            $list = $this->mdl->getStatMasker($thbl,$spmu,$ukpd);  
            $listne = $this->mdl->getStatMaskercpns($thbl,$spmu,$ukpd);   
        }
        else if($jenis == '8')
        {
            $list = $this->mdl->getStatAgama($thbl,$spmu,$ukpd);  
            $listne = $this->mdl->getStatAgamacpns($thbl,$spmu,$ukpd);   
        }
        else if($jenis == '9')
        {
            $list = $this->mdl->getStatTMTPensiunYAD($thbl,$spmu,$ukpd);  
            $listne = '';   
        }

        
        $arr = array('response' => 'SUKSES', 'list' => $list, 'listne' => $listne);
        echo json_encode($arr);
    }

    public function exceldata()
    {
    	//var_dump($this->input->post());exit;
    	$jenis = $this->input->post('jenis');
    	$thbl = $this->input->post('thbl');
        $spmu = $this->input->post('skpd');
        $ukpd = $this->input->post('ukpd');

        $this->load->library("phpexcel/PHPExcel");
        $filename='excel.csv';
        $response;
        if($jenis == '1')
        {
        	$filename = 'Statistik Jenis Kelamin PNS DKI Jakarta Tahun Bulan '.$thbl.'.csv';


        	$list = $this->mdl->getStatGenderPNS($thbl,$spmu,$ukpd);  
            $listne = $this->mdl->getStatGenderCPNS($thbl,$spmu,$ukpd);   


				// Create new PHPExcel object
				$objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("BKD - Provinsi DKI Jakarta")
											 ->setLastModifiedBy("BKD - Provinsi DKI Jakarta")
											 ->setTitle("Laporan Statistik Jenis Kelamin")
											 ->setSubject("Laporan Statistik Jenis Kelamin")
											 ->setDescription("Laporan Statistik Jenis Kelamin PNS dan CPNS DKI Provinsi DKI Jakarta.")
											 ->setKeywords("Jenis Kelamin")
											 ->setCategory("Statistik")
											 ->setCompany("BKD Provinsi DKI Jakarta");

				$arrMonth = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
				$objPHPExcel->setActiveSheetIndex(0);
		        
				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Golongan');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Laki - Laki');
				
				$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Perempuan');
				
				$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Jumlah');

				// Set column widths
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);

				$i=2;
				
				$tlaki=0;
				$tperempuan=0;
				$tsemua=0;
				foreach($list as $row){
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $row->GOL);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $row->LAKILAKI);
					$tlaki = $tlaki+$row->LAKILAKI;
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $row->PEREMPUAN);
					$tperempuan = $tperempuan+$row->PEREMPUAN;
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $row->JUMLAHTOTAL);
					$tsemua = $tsemua+$row->JUMLAHTOTAL;
					$i++;			
					
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'TOTAL');
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $tlaki);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $tperempuan);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $tsemua);



				

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('PNS');		

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);		
				
				//UNTUK CREATE ANOTHER SHEET IN SAME FILE		
				//$objPHPExcel->createSheet(1);	
				//$objPHPExcel->setActiveSheetIndex(1);
		        

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);	

				//------------------------------

				$objPHPExcel->createSheet();
		        $sheet = $objPHPExcel->setActiveSheetIndex(1);
		        $sheet->setTitle("Calon PNS");

				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Golongan');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Laki - Laki');
				
				$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Perempuan');
				
				$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Jumlah');

				// Set column widths
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);

				$i=2;
				
				$tlaki=0;
				$tperempuan=0;
				$tsemua=0;
				foreach($listne as $row){
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $row->GOL);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $row->LAKILAKI);
					$tlaki = $tlaki+$row->LAKILAKI;
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $row->PEREMPUAN);
					$tperempuan = $tperempuan+$row->PEREMPUAN;
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $row->JUMLAHTOTAL);
					$tsemua = $tsemua+$row->JUMLAHTOTAL;
					$i++;			
					
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'TOTAL');
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $tlaki);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $tperempuan);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $tsemua);
				// $objPHPExcel->getActiveSheet()->getStyle('A5:K'.($totalData+1))->applyFromArray($styleThinBlackBorderOutline);

			



				

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Calon PNS');		

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);		
				
				//UNTUK CREATE ANOTHER SHEET IN SAME FILE		
				//$objPHPExcel->createSheet(1);	
				//$objPHPExcel->setActiveSheetIndex(1);
		        

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

			

			
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);	

				// Redirect output to a client’s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="Laporan_SKP"');
				header('Cache-Control: max-age=0');
				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');

				// If you're serving to IE over SSL, then the following may be needed
				header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
				header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header ('Pragma: public'); // HTTP/1.0

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				
				ob_start();
				$objWriter->save('php://output');
				
				$xlsData = ob_get_contents();
				ob_end_clean();

				$response =  array(
				        'op' => 'ok',
				        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData),
				        'filename' => $filename
				    ); 

        }
        else if($jenis == '2')
        {
            $list = $this->mdl->getStatEselon($thbl,$spmu,$ukpd);  
            $listne = $this->mdl->getStatNonEselon($thbl,$spmu,$ukpd);      
            $filename = 'Statistik Eselon PNS DKI Jakarta Tahun Bulan '.$thbl.'.csv';
            // Create new PHPExcel object

            
				$objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("BKD - Provinsi DKI Jakarta")
											 ->setLastModifiedBy("BKD - Provinsi DKI Jakarta")
											 ->setTitle("Laporan Statistik Eselon")
											 ->setSubject("Laporan Statistik Eselon")
											 ->setDescription("Laporan Statistik Eselon PNS DKI Provinsi DKI Jakarta.")
											 ->setKeywords("Eselon")
											 ->setCategory("Statistik")
											 ->setCompany("BKD Provinsi DKI Jakarta");

				$arrMonth = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
				$objPHPExcel->setActiveSheetIndex(0);
		        
				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Golongan');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Eselon I/A');
				$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Eselon I/B');
				$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Eselon II/A');
				$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Eselon II/B');
				$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Eselon III/A');
				$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Eselon III/B');
				$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Eselon IV/A');
				$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Eselon IV/B');
				$objPHPExcel->getActiveSheet()->setCellValue('J1', 'JUMLAH');

				// Set column widths
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);

				$i=2;
				
				$t1a=0;
				$t1b=0;
				$t2a=0;
				$t2b=0;
				$t3a=0;
				$t3b=0;
				$t4a=0;
				$t4b=0;
				
				$tsemua=0;
				foreach($list as $row){
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $row->GOL);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $row->ESELON1A);
					$tla = $t1a+$row->ESELON1A;
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $row->ESELON1B);
					$t1b = $t1b+$row->ESELON1B;
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $row->ESELON2A);
					$t2a = $t2a+$row->ESELON2A;
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $row->ESELON2B);
					$t2b = $t2b+$row->ESELON2B;
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $row->ESELON3A);
					$t3a = $t3a+$row->ESELON3A;
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $row->ESELON3B);
					$t3b = $t3b+$row->ESELON3B;
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $row->ESELON1A);
					$t4a = $t4a+$row->ESELON4A;
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $row->ESELON1B);
					$t4b = $t4b+$row->ESELON4B;
					$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $row->JUMLAHTOTAL);
					$tsemua = $tsemua+$row->JUMLAHTOTAL;
					$i++;			
					
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'TOTAL');
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $t1a);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $t1b);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $t2a);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $t2b);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $t3a);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $t3b);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $t4a);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $t4b);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $tsemua);
				



				

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('PNS');		

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);		
				
				//UNTUK CREATE ANOTHER SHEET IN SAME FILE		
				//$objPHPExcel->createSheet(1);	
				//$objPHPExcel->setActiveSheetIndex(1);
		        

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);	

				//------------------------------

				$objPHPExcel->createSheet();
		        $sheet = $objPHPExcel->setActiveSheetIndex(1);
		        $sheet->setTitle("Calon PNS");

				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Golongan');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Jumlah');
				
				

				// Set column widths
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			

				$i=2;
				$tsemua=0;
				foreach($listne as $row){
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $row->GOL);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $row->JUMLAHTOTAL);
					$tsemua = $tsemua + $row->JUMLAHTOTAL;
					$i++;			
					
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'TOTAL');
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $tsemua);
				// $objPHPExcel->getActiveSheet()->getStyle('A5:K'.($totalData+1))->applyFromArray($styleThinBlackBorderOutline);

			



				

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Calon PNS');		

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);		
				
				//UNTUK CREATE ANOTHER SHEET IN SAME FILE		
				//$objPHPExcel->createSheet(1);	
				//$objPHPExcel->setActiveSheetIndex(1);
		        

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

			

			
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);	

				// Redirect output to a client’s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="Laporan_SKP"');
				header('Cache-Control: max-age=0');
				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');

				// If you're serving to IE over SSL, then the following may be needed
				header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
				header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header ('Pragma: public'); // HTTP/1.0

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				
				ob_start();
				$objWriter->save('php://output');
				
				$xlsData = ob_get_contents();
				ob_end_clean();

				$response =  array(
				        'op' => 'ok',
				        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData),
				        'filename' => $filename
				    ); 
        }
        else if($jenis == '3')
        {
            $list = $this->mdl->getStatUsia($thbl,$spmu,$ukpd);  
            $listne = '';    
            $filename = 'Statistik Usia PNS DKI Jakarta Tahun Bulan '.$thbl.'.csv';
            $objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("BKD - Provinsi DKI Jakarta")
											 ->setLastModifiedBy("BKD - Provinsi DKI Jakarta")
											 ->setTitle("Laporan Statistik Usia")
											 ->setSubject("Laporan Statistik Usia")
											 ->setDescription("Laporan Statistik Usia PNS DKI Provinsi DKI Jakarta.")
											 ->setKeywords("Usia")
											 ->setCategory("Statistik")
											 ->setCompany("BKD Provinsi DKI Jakarta");

				$arrMonth = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
				$objPHPExcel->setActiveSheetIndex(0);
		        
				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Golongan');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Usia <25 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Usia 25-30 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Usia 30-36 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Usia 36-42 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Usia 42-48 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Usia 48-55 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Usia >55 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('I1', 'JUMLAH');
				

				// Set column widths
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
				$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
				$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
				

				$i=2;
				
				$t1a=0;
				$t1b=0;
				$t2a=0;
				$t2b=0;
				$t3a=0;
				$t3b=0;
				$t4a=0;
				$t4b=0;
				
				$tsemua=0;
				foreach($list as $row){
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $row->GOL);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $row->BWAH25);
					$tla = $t1a+$row->BWAH25;
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $row->AN2530);
					$t1b = $t1b+$row->AN2530;
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $row->AN3036);
					$t2a = $t2a+$row->AN3036;
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $row->AN3642);
					$t2b = $t2b+$row->AN3642;
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $row->AN4248);
					$t3a = $t3a+$row->AN4248;
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $row->AN4855);
					$t3b = $t3b+$row->AN4855;
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $row->DIATAS55);
					$t4a = $t4a+$row->DIATAS55;
					
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $row->JUMLAHTOTAL);
					$tsemua = $tsemua+$row->JUMLAHTOTAL;
					$i++;			
					
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'TOTAL');
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $t1a);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $t1b);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $t2a);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $t2b);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $t3a);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $t3b);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $t4a);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $tsemua);
				
				

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('PNS');		

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);		
				
				//UNTUK CREATE ANOTHER SHEET IN SAME FILE		
				//$objPHPExcel->createSheet(1);	
				//$objPHPExcel->setActiveSheetIndex(1);
		        

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);	

				

				// Redirect output to a client’s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="Laporan_SKP"');
				header('Cache-Control: max-age=0');
				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');

				// If you're serving to IE over SSL, then the following may be needed
				header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
				header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header ('Pragma: public'); // HTTP/1.0

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				
				ob_start();
				$objWriter->save('php://output');
				
				$xlsData = ob_get_contents();
				ob_end_clean();

				$response =  array(
				        'op' => 'ok',
				        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData),
				        'filename' => $filename
				    ); 
        }
        else if($jenis == '4')
        {
            $list = $this->mdl->getStatPangkat($thbl,$spmu,$ukpd);  
            $listne = '';     
            $filename = 'Statistik Pangkat PNS DKI Jakarta Tahun Bulan '.$thbl.'.csv';
            $objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("BKD - Provinsi DKI Jakarta")
											 ->setLastModifiedBy("BKD - Provinsi DKI Jakarta")
											 ->setTitle("Laporan Statistik Pangkat")
											 ->setSubject("Laporan Statistik Pangkat")
											 ->setDescription("Laporan Statistik Pangkat PNS DKI Provinsi DKI Jakarta.")
											 ->setKeywords("Pangkat")
											 ->setCategory("Statistik")
											 ->setCompany("BKD Provinsi DKI Jakarta");

				$arrMonth = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
				$objPHPExcel->setActiveSheetIndex(0);
		        
				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Golongan');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B1', 'JUMLAH');
				

				// Set column widths
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
				

				$i=2;
				
				$t1a=0;
				
				
				$tsemua=0;
				foreach($list as $row){
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $row->GOL);
					
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $row->JMLGOL);
					$tsemua = $tsemua+$row->JMLGOL;
					$i++;			
					
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'TOTAL');
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $tsemua);
				
				

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('PNS');		

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);		
				
				//UNTUK CREATE ANOTHER SHEET IN SAME FILE		
				//$objPHPExcel->createSheet(1);	
				//$objPHPExcel->setActiveSheetIndex(1);
		        

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);	

				

				// Redirect output to a client’s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="Laporan_SKP"');
				header('Cache-Control: max-age=0');
				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');

				// If you're serving to IE over SSL, then the following may be needed
				header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
				header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header ('Pragma: public'); // HTTP/1.0

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				
				ob_start();
				$objWriter->save('php://output');
				
				$xlsData = ob_get_contents();
				ob_end_clean();

				$response =  array(
				        'op' => 'ok',
				        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData),
				        'filename' => $filename
				    );  
        }
        else if($jenis == '5')
        {
            $list = $this->mdl->getStatPendidikan($thbl,$spmu,$ukpd);  
            $listne = $this->mdl->getStatPendidikanCPNS($thbl,$spmu,$ukpd); 

            $filename = 'Statistik Pendidikan PNS DKI Jakarta Tahun Bulan '.$thbl.'.csv';
            // Create new PHPExcel object

            
				$objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("BKD - Provinsi DKI Jakarta")
											 ->setLastModifiedBy("BKD - Provinsi DKI Jakarta")
											 ->setTitle("Laporan Statistik Pendidikan")
											 ->setSubject("Laporan Statistik Pendidikan")
											 ->setDescription("Laporan Statistik Pendidikan PNS DKI Provinsi DKI Jakarta.")
											 ->setKeywords("Pendidikan")
											 ->setCategory("Statistik")
											 ->setCompany("BKD Provinsi DKI Jakarta");

				$arrMonth = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
				$objPHPExcel->setActiveSheetIndex(0);
		        
				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Golongan');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B1', 'TMI');
				$objPHPExcel->getActiveSheet()->setCellValue('C1', 'SD');
				$objPHPExcel->getActiveSheet()->setCellValue('D1', 'SMP');
				$objPHPExcel->getActiveSheet()->setCellValue('E1', 'SMA');
				$objPHPExcel->getActiveSheet()->setCellValue('F1', 'D1');
				$objPHPExcel->getActiveSheet()->setCellValue('G1', 'D2');
				$objPHPExcel->getActiveSheet()->setCellValue('H1', 'D3');
				$objPHPExcel->getActiveSheet()->setCellValue('I1', 'S1');
				$objPHPExcel->getActiveSheet()->setCellValue('J1', 'S2');
				$objPHPExcel->getActiveSheet()->setCellValue('K1', 'S3');
				$objPHPExcel->getActiveSheet()->setCellValue('L1', 'JUMLAH');

				// Set column widths
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);

				$i=2;
				
				$t1a=0;
				$t1b=0;
				$t2a=0;
				$t2b=0;
				$t3a=0;
				$t3b=0;
				$t4a=0;
				$t4b=0;
				$t5a=0;
				$t5b=0;
				
				$tsemua=0;
				foreach($list as $row){
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $row->GOL);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $row->TMI);
					$tla = $t1a+$row->TMI;
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $row->SD);
					$t1b = $t1b+$row->SD;
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $row->SMP);
					$t2a = $t2a+$row->SMP;
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $row->SMA);
					$t2b = $t2b+$row->SMA;
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $row->D1);
					$t3a = $t3a+$row->D1;
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $row->D2);
					$t3b = $t3b+$row->D2;
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $row->D3);
					$t4a = $t4a+$row->D3;
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $row->S1);
					$t4b = $t4b+$row->S1;
					$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $row->S2);
					$t5a = $t5a+$row->S2;
					$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, $row->S3);
					$t5b = $t5b+$row->S3;
					$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, $row->JUMLAHTOTAL);
					$tsemua = $tsemua+$row->JUMLAHTOTAL;
					$i++;			
					
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'TOTAL');
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $t1a);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $t1b);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $t2a);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $t2b);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $t3a);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $t3b);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $t4a);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $t4b);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $t5a);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$i, $t5b);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$i, $tsemua);
				



				

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('PNS');		

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);		
				
				//UNTUK CREATE ANOTHER SHEET IN SAME FILE		
				//$objPHPExcel->createSheet(1);	
				//$objPHPExcel->setActiveSheetIndex(1);
		        

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);	

				//------------------------------

				$objPHPExcel->createSheet();
		        $sheet = $objPHPExcel->setActiveSheetIndex(1);
		        $sheet->setTitle("Calon PNS");

				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Golongan');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B1', 'TMI');
				$objPHPExcel->getActiveSheet()->setCellValue('C1', 'SD');
				$objPHPExcel->getActiveSheet()->setCellValue('D1', 'SMP');
				$objPHPExcel->getActiveSheet()->setCellValue('E1', 'SMA');
				$objPHPExcel->getActiveSheet()->setCellValue('F1', 'D1');
				$objPHPExcel->getActiveSheet()->setCellValue('G1', 'D2');
				$objPHPExcel->getActiveSheet()->setCellValue('H1', 'D3');
				$objPHPExcel->getActiveSheet()->setCellValue('I1', 'S1');
				$objPHPExcel->getActiveSheet()->setCellValue('J1', 'S2');
				$objPHPExcel->getActiveSheet()->setCellValue('K1', 'S3');
				$objPHPExcel->getActiveSheet()->setCellValue('L1', 'JUMLAH');

				// Set column widths
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
			

				$j=2;

				$r1a=0;
				$r1b=0;
				$r2a=0;
				$r2b=0;
				$r3a=0;
				$r3b=0;
				$r4a=0;
				$r4b=0;
				$r5a=0;
				$r5b=0;
				$rsemua=0;
				foreach($listne as $row){
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$j, $row->GOL);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$j, $row->TMI);
					$rla = $r1a+$row->TMI;
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$j, $row->SD);
					$r1b = $r1b+$row->SD;
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$j, $row->SMP);
					$r2a = $r2a+$row->SMP;
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$j, $row->SMA);
					$r2b = $r2b+$row->SMA;
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$j, $row->D1);
					$r3a = $r3a+$row->D1;
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$j, $row->D2);
					$r3b = $r3b+$row->D2;
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$j, $row->D3);
					$r4a = $r4a+$row->D3;
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$j, $row->S1);
					$r4b = $r4b+$row->S1;
					$objPHPExcel->getActiveSheet()->setCellValue('J'.$j, $row->S2);
					$r5a = $r5a+$row->S2;
					$objPHPExcel->getActiveSheet()->setCellValue('K'.$j, $row->S3);
					$r5b = $r5b+$row->S3;
					$objPHPExcel->getActiveSheet()->setCellValue('L'.$j, $row->JUMLAHTOTAL);
					$rsemua = $rsemua+$row->JUMLAHTOTAL;
					$j++;				
					
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$j, 'TOTAL');
				$objPHPExcel->getActiveSheet()->getStyle('A'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$j, $r1a);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$j, $r1b);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$j, $r2a);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$j, $r2b);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$j, $r3a);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$j, $r3b);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$j, $r4a);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$j, $r4b);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$j, $r5a);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$j, $r5b);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$j, $rsemua);
				// $objPHPExcel->getActiveSheet()->getStyle('A5:K'.($totalData+1))->applyFromArray($styleThinBlackBorderOutline);

			



				

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Calon PNS');		

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);		
				
				//UNTUK CREATE ANOTHER SHEET IN SAME FILE		
				//$objPHPExcel->createSheet(1);	
				//$objPHPExcel->setActiveSheetIndex(1);
		        

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

			

			
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);	

				// Redirect output to a client’s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="Laporan_SKP"');
				header('Cache-Control: max-age=0');
				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');

				// If you're serving to IE over SSL, then the following may be needed
				header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
				header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header ('Pragma: public'); // HTTP/1.0

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				
				ob_start();
				$objWriter->save('php://output');
				
				$xlsData = ob_get_contents();
				ob_end_clean();

				$response =  array(
				        'op' => 'ok',
				        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData),
				        'filename' => $filename
				    );   
        }
        else if($jenis == '6')
        {
            $list = $this->mdl->getStatStawin($thbl,$spmu,$ukpd);  
            $listne = $this->mdl->getStatStawincpns($thbl,$spmu,$ukpd);  

            $filename = 'Statistik Status Pernikahan PNS DKI Jakarta Tahun Bulan '.$thbl.'.csv';
            // Create new PHPExcel object

            
				$objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("BKD - Provinsi DKI Jakarta")
											 ->setLastModifiedBy("BKD - Provinsi DKI Jakarta")
											 ->setTitle("Laporan Statistik Status Pernikahan")
											 ->setSubject("Laporan Statistik Status Pernikahan")
											 ->setDescription("Laporan Statistik Status Pernikahan PNS DKI Provinsi DKI Jakarta.")
											 ->setKeywords("Status Pernikahan")
											 ->setCategory("Statistik")
											 ->setCompany("BKD Provinsi DKI Jakarta");

				$arrMonth = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
				$objPHPExcel->setActiveSheetIndex(0);
		        
				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Golongan');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Belum Kawin');
				$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Kawin');
				$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Janda');
				$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Duda');
				$objPHPExcel->getActiveSheet()->setCellValue('F1', 'JUMLAH');

				// Set column widths
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

				$i=2;
				
				$t1a=0;
				$t1b=0;
				$t2a=0;
				$t2b=0;
				
				
				$tsemua=0;
				foreach($list as $row){
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $row->GOL);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $row->BELUMKAWIN);
					$tla = $t1a+$row->BELUMKAWIN;
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $row->KAWIN);
					$t1b = $t1b+$row->KAWIN;
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $row->JANDA);
					$t2a = $t2a+$row->JANDA;
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $row->DUDA);
					$t2b = $t2b+$row->DUDA;
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $row->JUMLAHTOTAL);
					$tsemua = $tsemua+$row->JUMLAHTOTAL;
					$i++;			
					
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'TOTAL');
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $t1a);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $t1b);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $t2a);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $t2b);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $tsemua);
				



				

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('PNS');		

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);		
				
				//UNTUK CREATE ANOTHER SHEET IN SAME FILE		
				//$objPHPExcel->createSheet(1);	
				//$objPHPExcel->setActiveSheetIndex(1);
		        

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);	

				//------------------------------

				$objPHPExcel->createSheet();
		        $sheet = $objPHPExcel->setActiveSheetIndex(1);
		        $sheet->setTitle("Calon PNS");

				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Golongan');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B1', 'BELUM KAWIN');
				$objPHPExcel->getActiveSheet()->setCellValue('C1', 'KAWIN');
				$objPHPExcel->getActiveSheet()->setCellValue('D1', 'JANDA');
				$objPHPExcel->getActiveSheet()->setCellValue('E1', 'DUDA');
				$objPHPExcel->getActiveSheet()->setCellValue('F1', 'JUMLAH');

				// Set column widths
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			

				$j=2;

				$r1a=0;
				$r1b=0;
				$r2a=0;
				$r2b=0;
				$rsemua=0;
				foreach($listne as $row){
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$j, $row->GOL);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$j, $row->BELUMKAWIN);
					$rla = $r1a+$row->BELUMKAWIN;
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$j, $row->KAWIN);
					$r1b = $r1b+$row->KAWIN;
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$j, $row->JANDA);
					$r2a = $r2a+$row->JANDA;
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$j, $row->DUDA);
					$r2b = $r2b+$row->DUDA;
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$j, $row->JUMLAHTOTAL);
					$rsemua = $rsemua+$row->JUMLAHTOTAL;
					$j++;				
					
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$j, 'TOTAL');
				$objPHPExcel->getActiveSheet()->getStyle('A'.$j)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$j, $r1a);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$j, $r1b);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$j, $r2a);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$j, $r2b);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$j, $rsemua);
				// $objPHPExcel->getActiveSheet()->getStyle('A5:K'.($totalData+1))->applyFromArray($styleThinBlackBorderOutline);

			
				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Calon PNS');		

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);		
				
				//UNTUK CREATE ANOTHER SHEET IN SAME FILE		
				//$objPHPExcel->createSheet(1);	
				//$objPHPExcel->setActiveSheetIndex(1);
		        

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

			

			
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);	

				// Redirect output to a client’s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="Laporan_SKP"');
				header('Cache-Control: max-age=0');
				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');

				// If you're serving to IE over SSL, then the following may be needed
				header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
				header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header ('Pragma: public'); // HTTP/1.0

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				
				ob_start();
				$objWriter->save('php://output');
				
				$xlsData = ob_get_contents();
				ob_end_clean();

				$response =  array(
				        'op' => 'ok',
				        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData),
				        'filename' => $filename
				    );  
        }
        else if($jenis == '7')
        {
            $list = $this->mdl->getStatMasker($thbl,$spmu,$ukpd);  
            $listne = $this->mdl->getStatMaskercpns($thbl,$spmu,$ukpd);   

            $filename = 'Statistik Masa Kerja PNS DKI Jakarta Tahun Bulan '.$thbl.'.csv';
            // Create new PHPExcel object

            
				$objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("BKD - Provinsi DKI Jakarta")
											 ->setLastModifiedBy("BKD - Provinsi DKI Jakarta")
											 ->setTitle("Laporan Statistik Masa Kerja Pegawai")
											 ->setSubject("Laporan Statistik Masa Kerja Pegawai")
											 ->setDescription("Laporan Statistik Masa Kerja PNS DKI Provinsi DKI Jakarta.")
											 ->setKeywords("Masa Kerja")
											 ->setCategory("Statistik")
											 ->setCompany("BKD Provinsi DKI Jakarta");

				$arrMonth = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
				$objPHPExcel->setActiveSheetIndex(0);
		        
				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Golongan');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B1', '1-5 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('C1', '6-10 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('D1', '11-15 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('E1', '16-20 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('F1', '21-25 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('G1', '26-30 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('H1', '31-35 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('I1', '>35 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('J1', 'JUMLAH');


				// Set column widths
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);

				$i=2;
				
				$t1a=0;
				$t1b=0;
				$t2a=0;
				$t2b=0;
				$t3a=0;
				$t3b=0;
				$t4a=0;
				$t4b=0;
				
				$tsemua=0;
				foreach($list as $row){
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $row->GOL);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $row->A15);
					$tla = $t1a+$row->A15;
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $row->A610);
					$t1b = $t1b+$row->A610;
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $row->A1115);
					$t2a = $t2a+$row->A1115;
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $row->A1620);
					$t2b = $t2b+$row->A1620;
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $row->A2125);
					$t3a = $t3a+$row->A2125;
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $row->A2530);
					$t3b = $t3b+$row->A2530;
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $row->A3035);
					$t4a = $t4a+$row->A3035;
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $row->A36);
					$t4b = $t4b+$row->A36;
					$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $row->JUMLAHTOTAL);
					$tsemua = $tsemua+$row->JUMLAHTOTAL;
					$i++;			
					
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'TOTAL');
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $t1a);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $t1b);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $t2a);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $t2b);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $t3a);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $t3b);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $t4a);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$i, $t4b);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$i, $tsemua);
				



				

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('PNS');		

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);		
				
				//UNTUK CREATE ANOTHER SHEET IN SAME FILE		
				//$objPHPExcel->createSheet(1);	
				//$objPHPExcel->setActiveSheetIndex(1);
		        

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);	

				//------------------------------

				$objPHPExcel->createSheet();
		        $sheet = $objPHPExcel->setActiveSheetIndex(1);
		        $sheet->setTitle("Calon PNS");

				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Golongan');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B1', '1-5 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('C1', '6-10 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('D1', '11-15 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('E1', '16-20 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('F1', '21-25 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('G1', '26-30 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('H1', '31-35 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('I1', '>35 tahun');
				$objPHPExcel->getActiveSheet()->setCellValue('J1', 'JUMLAH');


				// Set column widths
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			

				$j=2;

				$r1a=0;
				$r1b=0;
				$r2a=0;
				$r2b=0;
				$r3a=0;
				$r3b=0;
				$r4a=0;
				$r4b=0;
				$rsemua=0;
				foreach($listne as $row){
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$j, $row->GOL);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$j, $row->A15);
					$rla = $r1a+$row->A15;
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$j, $row->A610);
					$r1b = $r1b+$row->A610;
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$j, $row->A1115);
					$r2a = $r2a+$row->A1115;
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$j, $row->A1620);
					$r2b = $r2b+$row->A1620;
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$j, $row->A2125);
					$r3a = $r3a+$row->A2125;
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$j, $row->A2530);
					$r3b = $r3b+$row->A2530;
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$j, $row->A3035);
					$r4a = $r4a+$row->A3035;
					$objPHPExcel->getActiveSheet()->setCellValue('I'.$j, $row->A36);
					$r4b = $r4b+$row->A36;
					$objPHPExcel->getActiveSheet()->setCellValue('J'.$j, $row->JUMLAHTOTAL);
					$rsemua = $rsemua+$row->JUMLAHTOTAL;
					$j++;			
					
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$j, 'TOTAL');
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$j, $r1a);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$j, $r1b);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$j, $r2a);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$j, $r2b);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$j, $r3a);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$j, $r3b);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$j, $r4a);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$j, $r4b);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$j, $rsemua);
				// $objPHPExcel->getActiveSheet()->getStyle('A5:K'.($totalData+1))->applyFromArray($styleThinBlackBorderOutline);

			
				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Calon PNS');		

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);		
				
				//UNTUK CREATE ANOTHER SHEET IN SAME FILE		
				//$objPHPExcel->createSheet(1);	
				//$objPHPExcel->setActiveSheetIndex(1);
		        

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

			

			
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);	

				// Redirect output to a client’s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="Laporan_SKP"');
				header('Cache-Control: max-age=0');
				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');

				// If you're serving to IE over SSL, then the following may be needed
				header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
				header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header ('Pragma: public'); // HTTP/1.0

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				
				ob_start();
				$objWriter->save('php://output');
				
				$xlsData = ob_get_contents();
				ob_end_clean();

				$response =  array(
				        'op' => 'ok',
				        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData),
				        'filename' => $filename
				    );  
        }
        else if($jenis == '8')
        {
            $list = $this->mdl->getStatAgama($thbl,$spmu,$ukpd);  
            $listne = $this->mdl->getStatAgamacpns($thbl,$spmu,$ukpd);   

            $filename = 'Statistik Agama PNS DKI Jakarta Tahun Bulan '.$thbl.'.csv';
            // Create new PHPExcel object

            
				$objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("BKD - Provinsi DKI Jakarta")
											 ->setLastModifiedBy("BKD - Provinsi DKI Jakarta")
											 ->setTitle("Laporan Statistik Agama Pegawai")
											 ->setSubject("Laporan Statistik Agama Pegawai")
											 ->setDescription("Laporan Statistik Masa Kerja PNS DKI Provinsi DKI Jakarta.")
											 ->setKeywords("Agama")
											 ->setCategory("Statistik")
											 ->setCompany("BKD Provinsi DKI Jakarta");

				$arrMonth = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
				$objPHPExcel->setActiveSheetIndex(0);
		        
				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Golongan');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Islam');
				$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Protestan');
				$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Katolik');
				$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Hindu');
				$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Buddha');
				$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Khonghucu');
				$objPHPExcel->getActiveSheet()->setCellValue('H1', 'JUMLAH');


				// Set column widths
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);

				$i=2;
				
				$t1a=0;
				$t1b=0;
				$t2a=0;
				$t2b=0;
				$t3a=0;
				$t3b=0;
				
				
				
				$tsemua=0;
				foreach($list as $row){
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $row->GOL);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $row->ISLAM);
					$t1a = $t1a+$row->ISLAM;
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $row->PROTESTAN);
					$t1b = $t1b+$row->PROTESTAN;
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $row->KATOLIK);
					$t2a = $t2a+$row->KATOLIK;
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $row->HINDU);
					$t2b = $t2b+$row->HINDU;
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $row->BUDDHA);
					$t3a = $t3a+$row->BUDDHA;
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $row->KHONGHUCU);
					$t3b = $t3b+$row->KHONGHUCU;
					
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $row->JUMLAHTOTAL);
					$tsemua = $tsemua+$row->JUMLAHTOTAL;
					$i++;			
					
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'TOTAL');
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $t1a);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $t1b);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $t2a);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $t2b);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $t3a);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $t3b);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $tsemua);
				



				

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('PNS');		

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);		
				
				//UNTUK CREATE ANOTHER SHEET IN SAME FILE		
				//$objPHPExcel->createSheet(1);	
				//$objPHPExcel->setActiveSheetIndex(1);
		        

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);	

				//------------------------------

				$objPHPExcel->createSheet();
		        $sheet = $objPHPExcel->setActiveSheetIndex(1);
		        $sheet->setTitle("Calon PNS");

				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Golongan');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B1', 'ISLAM');
				$objPHPExcel->getActiveSheet()->setCellValue('C1', 'PROTESTAN');
				$objPHPExcel->getActiveSheet()->setCellValue('D1', 'KATOLIK');
				$objPHPExcel->getActiveSheet()->setCellValue('E1', 'HINDU');
				$objPHPExcel->getActiveSheet()->setCellValue('F1', 'BUDDHA');
				$objPHPExcel->getActiveSheet()->setCellValue('G1', 'KHONGHUCU');
				$objPHPExcel->getActiveSheet()->setCellValue('H1', 'JUMLAH');


				// Set column widths
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
				$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
			

				$j=2;

				$r1a=0;
				$r1b=0;
				$r2a=0;
				$r2b=0;
				$r3a=0;
				$r3b=0;
				
				$rsemua=0;
				foreach($listne as $row){
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$j, $row->GOL);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$j, $row->ISLAM);
					$rla = $r1a+$row->ISLAM;
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$j, $row->PROTESTAN);
					$r1b = $r1b+$row->PROTESTAN;
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$j, $row->KATOLIK);
					$r2a = $r2a+$row->KATOLIK;
					$objPHPExcel->getActiveSheet()->setCellValue('E'.$j, $row->HINDU);
					$r2b = $r2b+$row->HINDU;
					$objPHPExcel->getActiveSheet()->setCellValue('F'.$j, $row->BUDDHA);
					$r3a = $r3a+$row->BUDDHA;
					$objPHPExcel->getActiveSheet()->setCellValue('G'.$j, $row->KHONGHUCU);
					$r3b = $r3b+$row->KHONGHUCU;
					$objPHPExcel->getActiveSheet()->setCellValue('H'.$j, $row->JUMLAHTOTAL);
					$rsemua = $rsemua+$row->JUMLAHTOTAL;
					$j++;			
					
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$j, 'TOTAL');
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$j, $r1a);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$j, $r1b);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$j, $r2a);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$j, $r2b);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$j, $r3a);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$j, $r3b);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$j, $rsemua);
				// $objPHPExcel->getActiveSheet()->getStyle('A5:K'.($totalData+1))->applyFromArray($styleThinBlackBorderOutline);

			
				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Calon PNS');		

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);		
				
				//UNTUK CREATE ANOTHER SHEET IN SAME FILE		
				//$objPHPExcel->createSheet(1);	
				//$objPHPExcel->setActiveSheetIndex(1);
		        

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

			

			
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);	

				// Redirect output to a client’s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="Laporan_SKP"');
				header('Cache-Control: max-age=0');
				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');

				// If you're serving to IE over SSL, then the following may be needed
				header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
				header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header ('Pragma: public'); // HTTP/1.0

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				
				ob_start();
				$objWriter->save('php://output');
				
				$xlsData = ob_get_contents();
				ob_end_clean();

				$response =  array(
				        'op' => 'ok',
				        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData),
				        'filename' => $filename
				    );
        }

        
        else if($jenis == '9')
        {
            $list = $this->mdl->getStatTMTPensiunYAD($thbl,$spmu,$ukpd);  
            $listne = '';     
            $filename = 'Statistik Tahun Pensiun PNS DKI Jakarta Tahun Bulan '.$thbl.'.csv';
            $objPHPExcel = new PHPExcel();

				// Set document properties
				$objPHPExcel->getProperties()->setCreator("BKD - Provinsi DKI Jakarta")
											 ->setLastModifiedBy("BKD - Provinsi DKI Jakarta")
											 ->setTitle("Laporan Statistik Pangkat")
											 ->setSubject("Laporan Statistik Pangkat")
											 ->setDescription("Laporan Statistik Pangkat PNS DKI Provinsi DKI Jakarta.")
											 ->setKeywords("Pangkat")
											 ->setCategory("Statistik")
											 ->setCompany("BKD Provinsi DKI Jakarta");

				$arrMonth = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember');
				$objPHPExcel->setActiveSheetIndex(0);
		        
				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Tahun Pensiun');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B1', 'JUMLAH');
				

				// Set column widths
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
				

				$i=2;
				
				$t1a=0;
				
				
				$tsemua=0;
				foreach($list as $row){
					
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, $row->TAHUNPENSIUN);
					
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $row->JUMLAHTOTAL);
					$tsemua = $tsemua+$row->JUMLAHTOTAL;
					$i++;			
					
				}
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$i, 'TOTAL');
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $tsemua);
				
				

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');

				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('PNS');		

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);		
				
				//UNTUK CREATE ANOTHER SHEET IN SAME FILE		
				//$objPHPExcel->createSheet(1);	
				//$objPHPExcel->setActiveSheetIndex(1);
		        

				// =======================================================================================================

				// Set header and footer. When no different headers for odd/even are used, odd header is assumed.		
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&B '. $objPHPExcel->getProperties()->getTitle() .' &RPrinted on &D');
				$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

				// Set page orientation and size		
				$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
				$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

				$objPHPExcel->getActiveSheet()->getTabColor()->setARGB('FF0094FF');
				$objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);	

				

				// Redirect output to a client’s web browser (Excel2007)
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="Laporan_SKP"');
				header('Cache-Control: max-age=0');
				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');

				// If you're serving to IE over SSL, then the following may be needed
				header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
				header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header ('Pragma: public'); // HTTP/1.0

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				
				ob_start();
				$objWriter->save('php://output');
				
				$xlsData = ob_get_contents();
				ob_end_clean();

				$response =  array(
				        'op' => 'ok',
				        'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData),
				        'filename' => $filename
				    );  
        }
        
        








		


		

		echo json_encode($response);
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
