<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
require_once dirname(__FILE__) . '/FPDF/fpdf.php';


 
class Fpdf_cv extends FPDF
{
    function __construct()
    {
        parent::__construct();
        //$this->Pdf_report= new TCPDF('L', PDF_UNIT, 'LETTER',true, 'UTF-8', false);
        $this->B=0;
    $this->I=0;
    $this->U=0;
    $this->HREF='';

    $this->tableborder=0;
    $this->tdbegin=false;
    $this->tdwidth=0;
    $this->tdheight=0;
    $this->tdalign="L";
    $this->tdbgcolor=false;

    $this->oldx=0;
    $this->oldy=0;

    $this->fontlist=array("arial","times","courier","helvetica","symbol");
    $this->issetfont=false;
    $this->issetcolor=false;
    }

      	private $widths;
	private $aligns;
 
	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}
 
	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}
 
	function Row($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=10*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w,10,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}
 
	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}
 
	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
    public function Header() {
        // Logo
        $image_file = 'assets/img/Logo_DKI_Jakarta.jpg';
        $this->Image($image_file, 3, 10, 45, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        //set bg image
        //$img_file = K_PATH_IMAGES.'Logo_DKI_Jakarta.jpg';
        //$this->Image($img_file, 10, 50, 200, 200, '', '', '', false, 300, '', false, false, 0);


        // Set font
        //$this->SetFont('helvetica', 'B', 15);
        // Title
        $this->SetFont('helvetica', 'B', 15);
        $this->Ln();
        $this->Cell(0, 5, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        
        $this->Ln();
        $this->Cell(0, 5, 'Daftar Riwayat Hidup', 0, false, 'C', 0, '', 0, false, 'M', 'M');

            
        
        $this->Ln();
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 5, 'PEMERINTAH PROVINSI DAERAH KHUSUS IBUKOTA JAKARTA', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(0, 5, 'Jalan Medan Merdeka Selatan No.8-9 ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(0, 5, 'J A K A R T A', 0, false, 'C', 0, '', 0, false, 'M', 'M');

        $this->Ln();
        $this->Cell(0, 5, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(0, 5, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
       // $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    

    public function IsiData($data,$nrk)
    {
    
        //header
            $this->Ln();
            $w = array(180);
            $this->SetFont('helvetica', 'B', 12);
            $this->SetFillColor(26,179,148);
            $this->SetTextColor(255,255,255);
            $this->Cell($w[0],6,'DATA DIRI',1,0,'L',true);
      
            //nama
                $this->Ln();
                $this->SetFont('helvetica', 'B', 8);
                $w = array(30,5,20);
                $this->SetTextColor(0,0,0);
                $this->Cell($w[0],6,'NAMA',0,0,'L',false);
                $this->Cell($w[1],6,':',0,0,'C');
                $this->SetFont('helvetica', '', 8);

                $nama;
               // var_dump($data['infoUser']->TITEL) ;exit;
                if($data['infoUser']->TITELDEPAN == null && $data['infoUser']->TITEL==null)
                {
                    $nama = $data['infoUser']->NAMA_ABS;
                }
                else if($data['infoUser']->TITELDEPAN!=null && $data['infoUser']->TITEL == null)
                {
                    $nama = $data['infoUser']->TITELDEPAN.' '.$data['infoUser']->NAMA_ABS;
                }
                else if($data['infoUser']->TITELDEPAN == null && $data['infoUser']->TITEL != null)
                {
                    $nama = $data['infoUser']->NAMA_ABS.' '.$data['infoUser']->TITEL;
                }
                else
                {
                    $nama = $data['infoUser']->TITELDEPAN.''.$data['infoUser']->NAMA_ABS.''.$data['infoUser']->TITEL;    
                }

                $this->Cell($w[2],6,$nama,0,0,'L');
                
            //nrk    
                $this->Ln();
                $w = array(30,5,20);
               
                $this->SetFont('helvetica', 'B', 8);
                $this->Cell($w[0],6,'NRK',0,0,'L',false);
                $this->Cell($w[1],6,':',0,0,'C');
                $this->SetFont('helvetica', '', 8);
                $this->Cell($w[2],6,$data['infoUser']->NRK,0,0,'L');
               
                $linkImg = 'assets/img/photo/'.$data['infoUser']->NRK.'.jpg';
                $linkImg2 = 'assets/img/photo/'.$data['infoUser']->NRK.'.png';
                $img;
                if(file_exists($linkImg))
                {
                  $img = base_url().'assets/img/photo/'.$data['infoUser']->NRK.'.jpg';                                    
                }
                else if(file_exists($linkImg2))
                {
                  $img = base_url().'assets/img/photo/'.$data['infoUser']->NRK.'.png';                                    
                }
                else
                {
                  $img = base_url().'assets/img/photo/profile_small.jpg';                                    
                }

                
                
                
                

                $gmbr = $this->Image($img, 170, 75, 20, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
                
            //nip
                $this->Ln();
                $w = array(30,5,20);
                $this->SetFont('helvetica', 'B', 8);
                $this->Cell($w[0],6,'NIP',0,0,'L',false);
                $this->Cell($w[1],6,':',0,0,'C');
                $this->SetFont('helvetica', '', 8);
                $this->Cell($w[2],6,$data['infoUser']->NIP18,0,0,'L');
         
            //  ttl
                $this->Ln();
                $w = array(30,5,50);
                $this->SetFont('helvetica', 'B', 8);
                $this->Cell($w[0],6,'TEMPAT / TGL LAHIR',0,0,'L',false);
                $this->Cell($w[1],6,':',0,0,'C');
                $this->SetFont('helvetica', '', 8);
                $this->Cell($w[2],6,$data['infoUser']->PATHIR.' / '.$data['infoUser']->TLHR,0,0,'L');
          
            //  najabl        
                $this->Ln();
                $w = array(30,5,50);
                $this->SetFont('helvetica', 'B', 8);
                $this->Cell($w[0],6,'JABATAN',0,0,'L',false);
                $this->Cell($w[1],6,':',0,0,'C');
                $this->SetFont('helvetica', '', 8);
                $this->Cell($w[2],6,$data['infoUser']->NAJABL,0,0,'L');
            
            //nalokl
                $this->Ln();
                $w = array(30,5,50);
                
                $this->SetFont('helvetica', 'B', 8);
                $this->Cell($w[0],6,'LOKASI',0,0,'L',false);
                $this->Cell($w[1],6,':',0,0,'C');
                $this->SetFont('helvetica', '', 8);
                $this->Cell($w[2],6,$data['infoUser']->NALOKL,0,0,'L');


            //hp
                $this->Ln();
                $w = array(30,5,50);
                
                $this->SetFont('helvetica', 'B', 8);
                $this->Cell($w[0],6,'HP',0,0,'L',false);
                $this->Cell($w[1],6,':',0,0,'C');
                $this->SetFont('helvetica', '', 8);
                $this->Cell($w[2],6,$data['infoUser']->NOHP,0,0,'L');


            //email
                $this->Ln();
                $w = array(30,5,50);
                
                $this->SetFont('helvetica', 'B', 8);
                $this->Cell($w[0],6,'EMAIL',0,0,'L',false);
                $this->Cell($w[1],6,':',0,0,'C');
                $this->SetFont('helvetica', '', 8);
                $this->Cell($w[2],6,$data['infoUser']->EMAIL,0,0,'L');
                
          //alamat
                $this->Ln();
                $w = array(30,5,80,20,50,20,50,50);
               
                $this->SetFont('helvetica', 'B', 8);
                $this->Cell($w[0],6,'ALAMAT',0,0,'L',false);
                $this->Cell($w[1],6,':',0,0,'C');
                $this->SetFont('helvetica', '', 8);
                if(isset($data['infoAlamat']))
                {
                    $this->Cell($w[2],6,$data['infoAlamat']->ALAMAT.' RT/RW: '.$data['infoAlamat']->RT.' / '.$data['infoAlamat']->RW,0,0,'L');    
                }
                else
                {
                    $this->Cell($w[2],6,'',0,0,'L');       
                }
                
                $this->Ln();
                $this->SetX(45);
                $this->Cell($w[3],6,'KELURAHAN ',0,0,'L'); 


                	//isset($data['infoAlamat']->NAKEL)?$data['infoAlamat']->NAKEL:'-' .
                	//' KECAMATAN '.$data['infoAlamat']->NACAM,0,0,'L');
                //$this->Ln();
                $this->Cell($w[4],6,isset($data['infoAlamat']->NAKEL) ? $data['infoAlamat']->NAKEL : '-',0,0,'L');
                $this->Ln();
                $this->SetX(45);
                $this->Cell($w[5],6,'KECAMATAN ',0,0,'L'); 
                $this->Cell($w[6],6,isset($data['infoAlamat']->NACAM) ? $data['infoAlamat']->NACAM : '-',0,0,'L');
                $this->Ln();

                $this->SetX(45);
                if(isset($data['infoAlamat']))
                {
                      $this->Cell($w[7],6,$data['infoAlamat']->NAWIL.' - '.strtoupper($data['infoAlamat']->PROP),0,0,'L');
                }
                else
                {   
                      $this->Cell($w[7],6,'',0,0,'L');
                }
              
               
            //pendidikan formal
                $this->Ln();
                if($data['infoPenForm'] != null)
                {
                    $this->Ln();
                    $w = array(180);
                    $this->SetFont('helvetica', 'B', 12);
                    $this->SetFillColor(26,179,148);
                    $this->SetTextColor(255,255,255);
                    $this->Cell($w[0],6,'RIWAYAT PENDIDIKAN FORMAL',1,0,'L',true);

                    $this->SetTextColor(0,0,0);
                    $this->SetFont('helvetica', 'B', 8);

                    $this->Ln();
                    $this->SetX(10);
                    $v = array(8,30,110,32);
                    $this->Cell($v[0],6,'NO',1,0,'C',false);
                    $this->Cell($v[1],6,'TGL IJAZAH',1,0,'C',false);
                    $this->Cell($v[2],6,'NAMA SEKOLAH',1,0,'C',false);
                    $this->Cell($v[3],6,'KOTA SEKOLAH',1,0,'C',false);
                    
                    $i=1;
                        
                    $this->SetFont('helvetica', '', 8);
                    foreach($data['infoPenForm'] as $row)
                    {
                    	$this->Ln();
                        $this->Cell($v[0],6,$i,1,0,'C',false);
                        $tglijazah = date("d-m-Y",strtotime($row->TGIJAZAH));
                        $this->Cell($v[1],6,$tglijazah,1,0,'C',false);
                        $nasek;

                        if($row->UNIVER!='00000' AND $row->NASEK==" ")
                        {
                            $nasek = $row->NAUNIVER;                        
                        }
                        else
                        {
                            $nasek = $row->NASEK;
                        }
                        $this->Cell($v[2],6,$nasek,1,0,'L',false);
                        $this->Cell($v[3],6,$row->KOTSEK,1,0,'L',false);
                        $i++;
                    }    
                }

                //pendidikan non formal
                $this->Ln();
                if($data['infoPenNForm'] != null)
                {
                    $this->Ln();
                    $w = array(180);
                    $this->SetFont('helvetica', 'B', 12);
                    $this->SetFillColor(26,179,148);
                    $this->SetTextColor(255,255,255);
                    $this->Cell($w[0],6,'RIWAYAT PENDIDIKAN NON FORMAL',1,0,'L',true);

                    $this->SetTextColor(0,0,0);
                    $this->SetFont('helvetica', 'B', 8);
					
					$this->Ln();
                    $this->SetX(10);
                    $v = array(8,30,110,32);
                    $this->Cell($v[0],6,'NO',1,0,'C',false);
                    $this->Cell($v[1],6,'TGL IJAZAH',1,0,'C',false);
                    $this->Cell($v[2],6,'NAMA SEKOLAH',1,0,'C',false);
                    $this->Cell($v[3],6,'KOTA SEKOLAH',1,0,'C',false);
                    
                    $i=1;
                        
                    $this->SetFont('helvetica', '', 8);
                    foreach($data['infoPenNForm'] as $row)
                    {
                    	$this->Ln();
                        $this->Cell($v[0],6,$i,1,0,'C',false);
                        $tglijazah = date("d-m-Y",strtotime($row->TGIJAZAH));
                        $this->Cell($v[1],6,$tglijazah,1,0,'C',false);
                     	$this->Cell($v[2],6,$row->NASEK,1,0,'L',false);
                        $this->Cell($v[3],6,$row->KOTSEK,1,0,'L',false);
                        $i++;
                    }    
                }

                $this->Ln();
                if($data['infoHubkel'] != null)
                {
                    $this->Ln();
                    $w = array(180);
                    $this->SetFont('helvetica', 'B', 12);
                    $this->SetFillColor(26,179,148);
                    $this->SetTextColor(255,255,255);
                    $this->Cell($w[0],6,'RIWAYAT KELUARGA',1,0,'L',true);

                    $this->SetTextColor(0,0,0);
                    $this->SetFont('helvetica', 'B', 8);
					$this->SetFillColor(255,255,255);
					$this->Ln();
                    $this->SetX(10);
                    $v = array(8,28,40,25,25,22,32);
                    $this->Cell($v[0],6,'NO',1,0,'C',false);
                    $this->Cell($v[1],6,'HUBUNGAN',1,0,'C',false);
                    $this->Cell($v[2],6,'NAMA',1,0,'C',false);
                    $this->Cell($v[3],6,'TTL',1,0,'C',false);
                    $this->Cell($v[4],6,'JENIS KELAMIN',1,0,'C',false);
                    $this->Cell($v[5],6,'TUNJANGAN',1,0,'C',false);
                    $this->Cell($v[6],6,'PEKERJAAN',1,0,'C',false);
                    
                    $i=1;
                        
                    $this->SetFont('helvetica', '', 8);
                    foreach($data['infoHubkel'] as $row)
                    {
                    	$this->Ln();
                        $this->Cell($v[0],6,$i,'LTR',0,'C',false);

                        $hubkel = $row->NAHUBKEL;

                        $pg= strlen($hubkel);
                        $x=0;
                        $wordhubkel = explode(" ",$hubkel);

                        $text=$hubkel;$num_char=15;

                        $char     = $text{$num_char - 1};
						while($char != ' ') {
							$char = $text{--$num_char}; // Cari spasi pada posisi 49, 48, 47, dst...
						}
						$hubkel1 = substr($text, 0, $num_char);
						$pjghubkel1 = strlen($hubkel1);
						$hubkel2 = ltrim(substr($text, $pjghubkel1, 20));

						$nama1 = $row->NAMA;
						$nama2="";
						if(strlen($nama1) >21)
						{
							$nama1 = substr($row->NAMA,0,20);
							$nama2 = substr($row->NAMA,strlen($nama1),strlen($nama));

						}
						

                        $this->Cell($v[1],6,$hubkel1,'LTR',0,'L',false);
                        $this->Cell($v[2],6,$nama1,'LTR',0,'L',false);
                        $talhir = date("d-m-Y", strtotime($row->TALHIR));
                        $this->Cell($v[3],6,$row->TEMHIR.', ','LTR',0,'L',false);
                        $this->Cell($v[4],6,($row->JENKEL == "P" ? "PEREMPUAN" : "LAKI-LAKI"),'LTR',0,'L',false);
                        $tun;
                        if($row->TUNJANGAN == 'MENDAPAT TUNJANGAN')
                        {
                        	$tun = 'DAPAT';
                        }
                        else if($row->TUNJANGAN == 'TIDAK MENDAPAT TUNJANGAN')
                        {
                        	$tun = 'TIDAK';
                        }
                        else
                        {
                        	$tun= 'PERPANJANG';
                        }

                        $this->Cell($v[5],6,$tun,'LTR',0,'L',false);
                        $this->Cell($v[6],6,$row->KERJAAN,'LTR',0,'L',false);

                        $this->Ln();
                        
                        $this->Cell($v[0],6,'','LBR',0,'C',false);
                        $this->Cell($v[1],6,$hubkel2,'LBR',0,'L',false);
                        $this->Cell($v[2],6,$nama2,'LBR',0,'L',false);
                        $this->Cell($v[3],6,$talhir,'LBR',0,'L',false);
                        $this->Cell($v[4],6,'','LBR',0,'L',false);
                        $this->Cell($v[5],6,'','LBR',0,'L',false);
                        $this->Cell($v[6],6,'','LBR',0,'L',false);
                        $i++;
                    }    
                }
       		   
       		$this->AddPage();  

       		//jabatan struktural
       		if($data['infoJabatanS'] != null)
            {
                $this->Ln();
                $w = array(180);
                $this->SetFont('helvetica', 'B', 12);
                $this->SetFillColor(26,179,148);
                $this->SetTextColor(255,255,255);
                $this->Cell($w[0],6,'RIWAYAT JABATAN STRUKTURAL',1,0,'L',true);

                $this->SetTextColor(0,0,0);
                $this->SetFont('helvetica', 'B', 8);
				
				$this->Ln();
                $this->SetX(10);
                $v = array(8,18,45,40,20,10,22,17);
                $this->Cell($v[0],6,'NO',1,0,'C',false);
                $this->Cell($v[1],6,'TMT',1,0,'C',false);
                $this->Cell($v[2],6,'LOKASI',1,0,'C',false);
                $this->Cell($v[3],6,'JABATAN',1,0,'C',false);
                $this->Cell($v[4],6,'PANGKAT',1,0,'C',false);
                $this->Cell($v[5],6,'ESL',1,0,'C',false);
                $this->Cell($v[6],6,'NO.SK',1,0,'C',false);
                $this->Cell($v[7],6,'TGL.SK',1,0,'C',false);
                
                $i=1;
                    
                $this->SetFont('helvetica', '', 8);
                $nojab = 1;
                foreach($data['infoJabatanS'] as $row)
                {
                	$this->Ln();
                	
                    
                	//LOKASI
                    $nalokl = $row->NALOKL;
					$pjgnalok = strlen($nalokl);

					$wordnalokl = explode(" ",$nalokl);
					$arrnalok = array();
					$isiarrnalok = array();
					for($i=0;$i<count($wordnalokl);$i++)
					{
						$arrnalok[$i] = strlen($wordnalokl[$i]);
						
					}

					$maxlengthnalok = 25;

					$nalokl1="";
					$nalokl2="";
					$nalokl3="";
					$total = 0;
					$lastpointer=0;
					if($pjgnalok<$maxlengthnalok)
					{
						$nalokl1 = $nalokl;
						$nalokl2 = '';
					}
					else
					{
						for($j=0;$j<count($arrnalok);$j++)
						{
							$total = $total + $arrnalok[$j] + $j;

							if($total > ($maxlengthnalok * 1))
							{
								
								if($total>($maxlengthnalok * 2))
								{
									if($total > ($maxlengthnalok * 3))
									{
										break;
									}
									else
									{
										$nalokl3 = $nalokl3.$wordnalokl[$j].' ';
									}
								}
								else
								{
									$nalokl2 = $nalokl2.$wordnalokl[$j].' ';
								}
							}
							else
							{
								$nalokl1 = $nalokl1.$wordnalokl[$j].' ';
							}
						}
					}
					

					//JABATAN

					$najabl = $row->NAJABL;
					$pjgnajabl = strlen($najabl);
					$wordnajabl = explode(" ",$najabl);
					$arrnajab = array();
					$isiarrnajab = array();
					for($i=0;$i<count($wordnajabl);$i++)
					{
						$arrnajab[$i] = strlen($wordnajabl[$i]);
					}

					$maxlengthnajab = 26;

					$najabl1="";
					$najabl2="";
					$najabl3="";
					$totaljab = 0;
					
					if($pjgnajabl<$maxlengthnajab)
					{
						$najabl1 = $najabl;
						$najabl2 = '';
					}
					else
					{
						for($j=0;$j<count($arrnajab);$j++)
						{
							$totaljab = $totaljab + $arrnajab[$j] + $j;

							if($totaljab > ($maxlengthnajab * 1))
							{
								
								if($totaljab >($maxlengthnajab * 2))
								{
									if($totaljab > ($maxlengthnajab * 3))
									{
										break;
									}
									else
									{
										$najabl3 = $najabl3.$wordnajabl[$j].' ';
									}
								}
								else
								{
									$najabl2 = $najabl2.$wordnajabl[$j].' ';
								}
							}
							else
							{
								$najabl1 = $najabl1.$wordnajabl[$j].' ';
							}
						}
					}


                    

                    //PANGKAT
					$napang = $row->NAPANG;
					$pjgnapang = strlen($napang);
					$wordnapang = explode(" ",$napang);
					$arrnapang = array();
					$isiarrnapang = array();
					for($i=0;$i<count($wordnapang);$i++)
					{
						$arrnapang[$i] = strlen($wordnapang[$i]);
					}

					$maxlengthnapang = 10;

					$napang1="";
					$napang2="";
					$napang3="";
					$gol = "(".$row->GOL.")";
					$totalpang = 0;
					
					if($pjgnapang<$maxlengthnapang)
					{
						$napang1 = $napang;
						$napang2 = '';
					}
					else
					{
						for($j=0;$j<count($arrnapang);$j++)
						{
							$totalpang = $totalpang + $arrnapang[$j] + $j;

							if($totalpang > ($maxlengthnapang * 1))
							{
								
								if($totalpang >($maxlengthnapang * 2))
								{
									if($totalpang > ($maxlengthnapang * 3))
									{
										break;
									}
									else
									{
										$napang3 = $napang3.$wordnapang[$j].' ';
									}
								}
								else
								{
									$napang2 = $napang2.$wordnapang[$j].' ';
								}
							}
							else
							{
								$napang1 = $napang1.$wordnapang[$j].' ';
							}
						}
					}

                    $num_char = 30;
					if(strlen($nalokl) > $num_char)
					{
						if(strlen($najabl) > strlen($nalokl))
						{
							if(strlen($najabl) > ($maxlengthnajab*2) )
							{
								$this->SetFont('helvetica', '', 8);
								$this->Cell($v[0],6,$nojab,'LTR',0,'C',false);
			                    $tmt = date("d-m-Y",strtotime($row->TMT));
			                    $this->Cell($v[1],6,$tmt,'LTR',0,'C',false);
			                    $this->SetFont('helvetica', '', 7);
								$this->Cell($v[2],6,$nalokl1 ,'LTR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl1,'LTR',0,'L',false);
			                    $this->Cell($v[4],6,$napang1,'LTR',0,'L',false);
			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[5],6,$row->ESELON,'LTR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[6],6,$row->NOSK,'LTR',0,'L',false);
			                    $tgsk = date("d-m-Y",strtotime($row->TGSK));
			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[7],6,$tgsk,'LTR',0,'L',false);

			                    $this->Ln();
			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[0],6,'','LR',0,'C',false);
			                    $this->Cell($v[1],6,'','LR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[2],6,$nalokl2,'LR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl2,'LR',0,'L',false);
			                    $this->Cell($v[4],6,$napang2,'LR',0,'L',false);
			                    $this->Cell($v[5],6,'','LR',0,'L',false);
			                    $this->Cell($v[6],6,'','LR',0,'L',false);
			                    $this->Cell($v[7],6,'','LR',0,'L',false);

			                    $this->Ln();
	                    
	                    		$this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[0],6,'','LBR',0,'C',false);
			                    $this->Cell($v[1],6,'','LBR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[2],6,$nalokl3,'LBR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl3,'LBR',0,'L',false);
			                    $this->Cell($v[4],6,$gol,'LBR',0,'L',false);
			                    $this->Cell($v[5],6,'','LBR',0,'L',false);
			                    $this->Cell($v[6],6,'','LBR',0,'L',false);
			                    $this->Cell($v[7],6,'','LBR',0,'L',false);
							}
							else
							{
								$this->SetFont('helvetica', '', 8);
								$this->Cell($v[0],6,$nojab,'LTR',0,'C',false);
			                    $tmt = date("d-m-Y",strtotime($row->TMT));
			                    $this->Cell($v[1],6,$tmt,'LTR',0,'C',false);
			                    $this->SetFont('helvetica', '', 7);
								$this->Cell($v[2],6,$nalokl1 ,'LTR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl1,'LTR',0,'L',false);
			                    $this->Cell($v[4],6,$napang1,'LTR',0,'L',false);
			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[5],6,$row->ESELON,'LTR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[6],6,$row->NOSK,'LTR',0,'L',false);
			                    $tgsk = date("d-m-Y",strtotime($row->TGSK));
			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[7],6,$tgsk,'LTR',0,'L',false);

			                    $this->Ln();

			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[0],6,'','LR',0,'C',false);
			                    $this->Cell($v[1],6,'','LR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[2],6,$nalokl2,'LR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl2,'LR',0,'L',false);
			                    $this->Cell($v[4],6,$napang2,'LR',0,'L',false);
			                    $this->Cell($v[5],6,'','LR',0,'L',false);
			                    $this->Cell($v[6],6,'','LR',0,'L',false);
			                    $this->Cell($v[7],6,'','LR',0,'L',false);

			                    $this->Ln();

			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[0],6,'','LBR',0,'C',false);
			                    $this->Cell($v[1],6,'','LBR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[2],6,$nalokl3,'LBR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl3,'LBR',0,'L',false);
			                    $this->Cell($v[4],6,$gol,'LBR',0,'L',false);
			                    $this->Cell($v[5],6,'','LBR',0,'L',false);
			                    $this->Cell($v[6],6,'','LBR',0,'L',false);
			                    $this->Cell($v[7],6,'','LBR',0,'L',false);
							}
						}
						else
						{
							$this->SetFont('helvetica', '', 8);
							$this->Cell($v[0],6,$nojab,'LTR',0,'C',false);
		                    $tmt = date("d-m-Y",strtotime($row->TMT));
		                    $this->Cell($v[1],6,$tmt,'LTR',0,'C',false);
		                    $this->SetFont('helvetica', '', 7);
							$this->Cell($v[2],6,$nalokl1 ,'LTR',0,'L',false);
		                    $this->Cell($v[3],6,$najabl1,'LTR',0,'L',false);
		                    $this->Cell($v[4],6,$napang1,'LTR',0,'L',false);
		                    $this->SetFont('helvetica', '', 8);
		                    $this->Cell($v[5],6,$row->ESELON,'LTR',0,'L',false);
		                    $this->SetFont('helvetica', '', 7);
		                    $this->Cell($v[6],6,$row->NOSK,'LTR',0,'L',false);
		                    $tgsk = date("d-m-Y",strtotime($row->TGSK));
		                    $this->SetFont('helvetica', '', 8);
		                    $this->Cell($v[7],6,$tgsk,'LTR',0,'L',false);

		                    $this->Ln();

		                    $this->SetFont('helvetica', '', 8);
		                    $this->Cell($v[0],6,'','LR',0,'C',false);
		                    $this->Cell($v[1],6,'','LR',0,'L',false);
		                    $this->SetFont('helvetica', '', 7);
		                    $this->Cell($v[2],6,$nalokl2,'LR',0,'L',false);
		                    $this->Cell($v[3],6,$najabl2,'LR',0,'L',false);
		                    $this->Cell($v[4],6,$napang2,'LR',0,'L',false);
		                    $this->Cell($v[5],6,'','LR',0,'L',false);
		                    $this->Cell($v[6],6,'','LR',0,'L',false);
		                    $this->Cell($v[7],6,'','LR',0,'L',false);

		                    $this->Ln();

		                    $this->SetFont('helvetica', '', 8);
		                    $this->Cell($v[0],6,'','LBR',0,'C',false);
		                    $this->Cell($v[1],6,'','LBR',0,'L',false);
		                    $this->SetFont('helvetica', '', 7);
		                    $this->Cell($v[2],6,$nalokl3,'LBR',0,'L',false);
		                    $this->Cell($v[3],6,$najabl3,'LBR',0,'L',false);
		                    $this->Cell($v[4],6,$gol,'LBR',0,'L',false);
		                    $this->Cell($v[5],6,'','LBR',0,'L',false);
		                    $this->Cell($v[6],6,'','LBR',0,'L',false);
		                    $this->Cell($v[7],6,'','LBR',0,'L',false);
						}
						
					}
					else
					{
						if(strlen($najabl) > strlen($nalokl))
						{
							if(strlen($najabl) > ($maxlengthnajab*2))
							{
								$this->SetFont('helvetica', '', 8);
								$this->Cell($v[0],6,$nojab,'LTR',0,'C',false);
			                    $tmt = date("d-m-Y",strtotime($row->TMT));
			                    $this->Cell($v[1],6,$tmt,'LTR',0,'C',false);
			                    $this->SetFont('helvetica', '', 7);
								$this->Cell($v[2],6,$nalokl1 ,'LTR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl1,'LTR',0,'L',false);
			                    $this->Cell($v[4],6,$napang1,'LTR',0,'L',false);
			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[5],6,$row->ESELON,'LTR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[6],6,$row->NOSK,'LTR',0,'L',false);
			                    $tgsk = date("d-m-Y",strtotime($row->TGSK));
			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[7],6,$tgsk,'LTR',0,'L',false);

			                    $this->Ln();

			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[0],6,'','LR',0,'C',false);
			                    $this->Cell($v[1],6,'','LR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[2],6,$nalokl2,'LR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl2,'LR',0,'L',false);
			                    $this->Cell($v[4],6,$napang2,'LR',0,'L',false);
			                    $this->Cell($v[5],6,'','LR',0,'L',false);
			                    $this->Cell($v[6],6,'','LR',0,'L',false);
			                    $this->Cell($v[7],6,'','LR',0,'L',false);

			                    $this->Ln();
	                    
	                    		$this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[0],6,'','LBR',0,'C',false);
			                    $this->Cell($v[1],6,'','LBR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[2],6,$nalokl3,'LBR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl3,'LBR',0,'L',false);
			                    $this->Cell($v[4],6,$gol,'LBR',0,'L',false);
			                    $this->Cell($v[5],6,'','LBR',0,'L',false);
			                    $this->Cell($v[6],6,'','LBR',0,'L',false);
			                    $this->Cell($v[7],6,'','LBR',0,'L',false);
							}
							else
							{
								$this->SetFont('helvetica', '', 8);
								$this->Cell($v[0],6,$nojab,'LTR',0,'C',false);
			                    $tmt = date("d-m-Y",strtotime($row->TMT));
			                    $this->Cell($v[1],6,$tmt,'LTR',0,'C',false);
			                    $this->SetFont('helvetica', '', 7);
								$this->Cell($v[2],6,$nalokl1 ,'LTR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl1,'LTR',0,'L',false);
			                    $this->Cell($v[4],6,$napang1,'LTR',0,'L',false);
			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[5],6,$row->ESELON,'LTR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[6],6,$row->NOSK,'LTR',0,'L',false);
			                    $tgsk = date("d-m-Y",strtotime($row->TGSK));
			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[7],6,$tgsk,'LTR',0,'L',false);

			                    $this->Ln();

			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[0],6,'','LR',0,'C',false);
			                    $this->Cell($v[1],6,'','LR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[2],6,$nalokl2,'LR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl2,'LR',0,'L',false);
			                    $this->Cell($v[4],6,$napang2,'LR',0,'L',false);
			                    $this->Cell($v[5],6,'','LR',0,'L',false);
			                    $this->Cell($v[6],6,'','LR',0,'L',false);
			                    $this->Cell($v[7],6,'','LR',0,'L',false);

			                    $this->Ln();

			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[0],6,'','LBR',0,'C',false);
			                    $this->Cell($v[1],6,'','LBR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[2],6,$nalokl3,'LBR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl3,'LBR',0,'L',false);
			                    $this->Cell($v[4],6,$gol,'LBR',0,'L',false);
			                    $this->Cell($v[5],6,'','LBR',0,'L',false);
			                    $this->Cell($v[6],6,'','LBR',0,'L',false);
			                    $this->Cell($v[7],6,'','LBR',0,'L',false);
							}
						}
						else
						{
							$this->SetFont('helvetica', '', 8);
							$this->Cell($v[0],6,$nojab,'LTR',0,'C',false);
		                    $tmt = date("d-m-Y",strtotime($row->TMT));
		                    $this->Cell($v[1],6,$tmt,'LTR',0,'C',false);
		                    $this->SetFont('helvetica', '', 7);
							$this->Cell($v[2],6,$nalokl1 ,'LTR',0,'L',false);
		                    $this->Cell($v[3],6,$najabl1,'LTR',0,'L',false);
		                    $this->Cell($v[4],6,$napang1,'LTR',0,'L',false);
		                    $this->SetFont('helvetica', '', 8);
		                    $this->Cell($v[5],6,$row->ESELON,'LTR',0,'L',false);
		                    $this->SetFont('helvetica', '', 7);
		                    $this->Cell($v[6],6,$row->NOSK,'LTR',0,'L',false);
		                    $tgsk = date("d-m-Y",strtotime($row->TGSK));
		                    $this->SetFont('helvetica', '', 8);
		                    $this->Cell($v[7],6,$tgsk,'LTR',0,'L',false);

		                    $this->Ln();

		                    $this->SetFont('helvetica', '', 8);
		                    $this->Cell($v[0],6,'','LR',0,'C',false);
		                    $this->Cell($v[1],6,'','LR',0,'L',false);
		                    $this->SetFont('helvetica', '', 7);
		                    $this->Cell($v[2],6,$nalokl2,'LR',0,'L',false);
		                    $this->Cell($v[3],6,$najabl2,'LR',0,'L',false);
		                    $this->Cell($v[4],6,$napang2,'LR',0,'L',false);
		                    $this->Cell($v[5],6,'','LR',0,'L',false);
		                    $this->Cell($v[6],6,'','LR',0,'L',false);
		                    $this->Cell($v[7],6,'','LR',0,'L',false);

		                    $this->Ln();

		                    $this->SetFont('helvetica', '', 8);
		                    $this->Cell($v[0],6,'','LBR',0,'C',false);
		                    $this->Cell($v[1],6,'','LBR',0,'L',false);
		                    $this->SetFont('helvetica', '', 7);
		                    $this->Cell($v[2],6,$nalokl3,'LBR',0,'L',false);
		                    $this->Cell($v[3],6,$najabl3,'LBR',0,'L',false);
		                    $this->Cell($v[4],6,$gol,'LBR',0,'L',false);
		                    $this->Cell($v[5],6,'','LBR',0,'L',false);
		                    $this->Cell($v[6],6,'','LBR',0,'L',false);
		                    $this->Cell($v[7],6,'','LBR',0,'L',false);
						}
						
					}

                    $nojab++;
                }    
            }
            $this->Ln();
            //jabatan fungsional
       		if($data['infoJabatanF'] != null)
            {
                /*$this->Ln();
                $w = array(180);
                $this->SetFont('helvetica', 'B', 12);
                $this->SetFillColor(26,179,148);
                $this->SetTextColor(255,255,255);
                $this->Cell($w[0],6,'RIWAYAT JABATAN FUNGSIONAL',1,0,'L',true);

                $this->SetTextColor(0,0,0);
                $this->SetFont('helvetica', 'B', 8);
				
				$this->Ln();
                $this->SetX(10);
                $v = array(8,18,45,50,20,22,17);
                $this->Cell($v[0],6,'NO',1,0,'C',false);
                $this->Cell($v[1],6,'TMT',1,0,'C',false);
                $this->Cell($v[2],6,'LOKASI',1,0,'C',false);
                $this->Cell($v[3],6,'JABATAN',1,0,'C',false);
                $this->Cell($v[4],6,'PANGKAT',1,0,'C',false);
                
                $this->Cell($v[5],6,'NO.SK',1,0,'C',false);
                $this->Cell($v[6],6,'TGL.SK',1,0,'C',false);
                
                $i=1;
                 $this->SetFont('helvetica', '', 7);   
                
                foreach($data['infoJabatanF'] as $row)
                {
                	$this->Ln();







                	
                    $nalokl = $row->NALOKL;
					$text=$nalokl;
					$num_char=30;
					$char     = $text{$num_char - 1};
					while($char != ' ') {
						$char = $text{--$num_char};
					}
					
					$nalokl1 = substr($text, 0, $num_char);
					$pjgnalokl1 = strlen($nalokl1);
					$nalokl2 = ltrim(substr($text, $pjgnalokl1, $num_char));

					

                 	$najabl = $row->NAJABL;
					$wordnajabl = explode(" ",$najabl);

                    $text2=$najabl;
                    $num_char2=30;

                    

					$najabl1 =substr($text2, 0, $num_char2);
					$pjgnajabl = strlen($najabl);
					$najabl2="";
					if($pjgnajabl>=30)
					{
						$this->SetFont('helvetica', '', 8);
						$najabl2 = ltrim(substr($text2, $pjgnajabl1, 30));
						$najabl2asli = substr($text2, $pjgnajabl1, 30);	

						$this->Cell($v[0],6,$i,'LTR',0,'C',false);
                    	$tmt = date("d-m-Y",strtotime($row->TMT));
                    	$this->Cell($v[1],6,$tmt,'LTR',0,'C',false);
                    	$this->SetFont('helvetica', '', 7);
						$this->Cell($v[2],6,$nalokl1 ,'LTR',0,'L',false);
						$this->Cell($v[3],6,$najabl1,'LTR',0,'L',false);
	                    $this->Cell($v[4],6,$row->NAPANG,'LTR',0,'L',false);
	                   	$this->Cell($v[5],6,$row->NOSK,'LTR',0,'L',false);
	                    $tgsk = date("d-m-Y",strtotime($row->TGSK));
	                    $this->SetFont('helvetica', '', 8);
	                    $this->Cell($v[6],6,$tgsk,'LTR',0,'L',false);

						$this->Ln();
                    	$this->SetFont('helvetica', '', 8);
	                    $this->Cell($v[0],6,'','LBR',0,'C',false);
	                    $this->Cell($v[1],6,'','LBR',0,'L',false);
	                    $this->SetFont('helvetica', '', 7);
	                    $this->Cell($v[2],6,$nalokl2,'LBR',0,'L',false);
	                    $this->Cell($v[3],6,$najabl2,'LBR',0,'L',false);
	                    $this->Cell($v[4],6,'('.$row->GOL.')','LBR',0,'L',false);
	                    $this->Cell($v[5],6,'','LBR',0,'L',false);
	                    $this->Cell($v[6],6,'','LBR',0,'L',false);
					}
					else
					{
						$this->SetFont('helvetica', '', 8);
						$this->Cell($v[0],6,$i,'LTR',0,'C',false);
                    	$tmt = date("d-m-Y",strtotime($row->TMT));
                    	$this->Cell($v[1],6,$tmt,'LTR',0,'C',false);
                    	$this->SetFont('helvetica', '', 7);
						$this->Cell($v[2],6,$nalokl1 ,'LTR',0,'L',false);
						$this->Cell($v[3],6,$najabl1,'LTR',0,'L',false);
	                    $this->Cell($v[4],6,$row->NAPANG,'LTR',0,'L',false);
	                   	$this->Cell($v[5],6,$row->NOSK,'LTR',0,'L',false);
	                    $tgsk = date("d-m-Y",strtotime($row->TGSK));
	                    $this->SetFont('helvetica', '', 8);
	                    $this->Cell($v[6],6,$tgsk,'LTR',0,'L',false);

	                 	$this->Ln();
                    
                    	$this->SetFont('helvetica', '', 8);
	                    $this->Cell($v[0],6,'','LBR',0,'C',false);
	                    $this->SetFont('helvetica', '', 7);
	                    $this->Cell($v[1],6,'','LBR',0,'L',false);
	                    $this->Cell($v[2],6,'','LBR',0,'L',false);
	                    $this->Cell($v[3],6,'','LBR',0,'L',false);
	                    $this->Cell($v[4],6,'('.$row->GOL.')','LBR',0,'L',false);
	                    $this->Cell($v[5],6,'','LBR',0,'L',false);
	                    $this->Cell($v[6],6,'','LBR',0,'L',false);   
					}
					$i++;
                }*/  
                $this->Ln();
                $w = array(180);
                $this->SetFont('helvetica', 'B', 12);
                $this->SetFillColor(26,179,148);
                $this->SetTextColor(255,255,255);
                $this->Cell($w[0],6,'RIWAYAT JABATAN FUNGSIONAL',1,0,'L',true);

                $this->SetTextColor(0,0,0);
                $this->SetFont('helvetica', 'B', 8);
				
				$this->Ln();
                $this->SetX(10);
                //$v = array(8,18,45,40,20,10,22,17);
                 $v = array(8,18,45,50,20,22,17);
                $this->Cell($v[0],6,'NO',1,0,'C',false);
                $this->Cell($v[1],6,'TMT',1,0,'C',false);
                $this->Cell($v[2],6,'LOKASI',1,0,'C',false);
                $this->Cell($v[3],6,'JABATAN',1,0,'C',false);
                $this->Cell($v[4],6,'PANGKAT',1,0,'C',false);
                
                $this->Cell($v[5],6,'NO.SK',1,0,'C',false);
                $this->Cell($v[6],6,'TGL.SK',1,0,'C',false);
                
                $i=1;
                    
                $this->SetFont('helvetica', '', 8);
                $nojab = 1;
                foreach($data['infoJabatanF'] as $row)
                {
                	$this->Ln();
                	
                    
                	//LOKASI
                    $nalokl = $row->NALOKL;
					$pjgnalok = strlen($nalokl);

					$wordnalokl = explode(" ",$nalokl);
					$arrnalok = array();
					$isiarrnalok = array();
					for($i=0;$i<count($wordnalokl);$i++)
					{
						$arrnalok[$i] = strlen($wordnalokl[$i]);
						
					}

					$maxlengthnalok = 25;

					$nalokl1="";
					$nalokl2="";
					$nalokl3="";
					$total = 0;
					$lastpointer=0;
					if($pjgnalok<$maxlengthnalok)
					{
						$nalokl1 = $nalokl;
						$nalokl2 = '';
					}
					else
					{
						for($j=0;$j<count($arrnalok);$j++)
						{
							$total = $total + $arrnalok[$j] + $j;

							if($total > ($maxlengthnalok * 1))
							{
								
								if($total>($maxlengthnalok * 2))
								{
									if($total > ($maxlengthnalok * 3))
									{
										break;
									}
									else
									{
										$nalokl3 = $nalokl3.$wordnalokl[$j].' ';
									}
								}
								else
								{
									$nalokl2 = $nalokl2.$wordnalokl[$j].' ';
								}
							}
							else
							{
								$nalokl1 = $nalokl1.$wordnalokl[$j].' ';
							}
						}
					}
					

					//JABATAN

					$najabl = $row->NAJABL;
					$pjgnajabl = strlen($najabl);
					$wordnajabl = explode(" ",$najabl);
					$arrnajab = array();
					$isiarrnajab = array();
					for($i=0;$i<count($wordnajabl);$i++)
					{
						$arrnajab[$i] = strlen($wordnajabl[$i]);
					}

					$maxlengthnajab = 30;

					$najabl1="";
					$najabl2="";
					$najabl3="";
					$totaljab = 0;
					
					if($pjgnajabl<$maxlengthnajab)
					{
						$najabl1 = $najabl;
						$najabl2 = '';
					}
					else
					{
						for($j=0;$j<count($arrnajab);$j++)
						{
							$totaljab = $totaljab + $arrnajab[$j] + $j;

							if($totaljab > ($maxlengthnajab * 1))
							{
								
								if($totaljab >($maxlengthnajab * 2))
								{
									if($totaljab > ($maxlengthnajab * 3))
									{
										break;
									}
									else
									{
										$najabl3 = $najabl3.$wordnajabl[$j].' ';
									}
								}
								else
								{
									$najabl2 = $najabl2.$wordnajabl[$j].' ';
								}
							}
							else
							{
								$najabl1 = $najabl1.$wordnajabl[$j].' ';
							}
						}
					}


                    

                    //PANGKAT
					$napang = $row->NAPANG;
					$pjgnapang = strlen($napang);
					$wordnapang = explode(" ",$napang);
					$arrnapang = array();
					$isiarrnapang = array();
					for($i=0;$i<count($wordnapang);$i++)
					{
						$arrnapang[$i] = strlen($wordnapang[$i]);
					}

					$maxlengthnapang = 10;

					$napang1="";
					$napang2="";
					$napang3="";
					$gol = "(".$row->GOL.")";
					$totalpang = 0;
					
					if($pjgnapang<$maxlengthnapang)
					{
						$napang1 = $napang;
						$napang2 = '';
					}
					else
					{
						for($j=0;$j<count($arrnapang);$j++)
						{
							$totalpang = $totalpang + $arrnapang[$j] + $j;

							if($totalpang > ($maxlengthnapang * 1))
							{
								
								if($totalpang >($maxlengthnapang * 2))
								{
									if($totalpang > ($maxlengthnapang * 3))
									{
										break;
									}
									else
									{
										$napang3 = $napang3.$wordnapang[$j].' ';
									}
								}
								else
								{
									$napang2 = $napang2.$wordnapang[$j].' ';
								}
							}
							else
							{
								$napang1 = $napang1.$wordnapang[$j].' ';
							}
						}
					}
                    $num_char=30;
                    
					if(strlen($nalokl) > $num_char)
					{
						if(strlen($najabl) > strlen($nalokl))
						{
							if(strlen($najabl) > ($maxlengthnajab*2) )
							{
								$this->SetFont('helvetica', '', 8);
								$this->Cell($v[0],6,$nojab,'LTR',0,'C',false);
			                    $tmt = date("d-m-Y",strtotime($row->TMT));
			                    $this->Cell($v[1],6,$tmt,'LTR',0,'C',false);
			                    $this->SetFont('helvetica', '', 7);
								$this->Cell($v[2],6,$nalokl1 ,'LTR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl1,'LTR',0,'L',false);
			                    $this->Cell($v[4],6,$napang1,'LTR',0,'L',false);
			                    
			                    $this->Cell($v[5],6,$row->NOSK,'LTR',0,'L',false);
			                    $tgsk = date("d-m-Y",strtotime($row->TGSK));
			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[6],6,$tgsk,'LTR',0,'L',false);

			                    $this->Ln();
			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[0],6,'','LR',0,'C',false);
			                    $this->Cell($v[1],6,'','LR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[2],6,$nalokl2,'LR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl2,'LR',0,'L',false);
			                    $this->Cell($v[4],6,$napang2,'LR',0,'L',false);
			                    $this->Cell($v[5],6,'','LR',0,'L',false);
			                    $this->Cell($v[6],6,'','LR',0,'L',false);
			                    

			                    $this->Ln();
	                    
	                    		$this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[0],6,'','LBR',0,'C',false);
			                    $this->Cell($v[1],6,'','LBR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[2],6,$nalokl3,'LBR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl3,'LBR',0,'L',false);
			                    $this->Cell($v[4],6,$gol,'LBR',0,'L',false);
			                    $this->Cell($v[5],6,'','LBR',0,'L',false);
			                    $this->Cell($v[6],6,'','LBR',0,'L',false);
			                    
							}
							else
							{
								$this->SetFont('helvetica', '', 8);
								$this->Cell($v[0],6,$nojab,'LTR',0,'C',false);
			                    $tmt = date("d-m-Y",strtotime($row->TMT));
			                    $this->Cell($v[1],6,$tmt,'LTR',0,'C',false);
			                    $this->SetFont('helvetica', '', 7);
								$this->Cell($v[2],6,$nalokl1 ,'LTR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl1,'LTR',0,'L',false);
			                    $this->Cell($v[4],6,$napang1,'LTR',0,'L',false);
			                   
			                    $this->Cell($v[5],6,$row->NOSK,'LTR',0,'L',false);
			                    $tgsk = date("d-m-Y",strtotime($row->TGSK));
			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[6],6,$tgsk,'LTR',0,'L',false);

			                    $this->Ln();

			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[0],6,'','LR',0,'C',false);
			                    $this->Cell($v[1],6,'','LR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[2],6,$nalokl2,'LR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl2,'LR',0,'L',false);
			                    $this->Cell($v[4],6,$napang2,'LR',0,'L',false);
			                    $this->Cell($v[5],6,'','LR',0,'L',false);
			                    $this->Cell($v[6],6,'','LR',0,'L',false);
			                   

			                    $this->Ln();

			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[0],6,'','LBR',0,'C',false);
			                    $this->Cell($v[1],6,'','LBR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[2],6,$nalokl3,'LBR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl3,'LBR',0,'L',false);
			                    $this->Cell($v[4],6,$gol,'LBR',0,'L',false);
			                    $this->Cell($v[5],6,'','LBR',0,'L',false);
			                    $this->Cell($v[6],6,'','LBR',0,'L',false);
			                    
							}
						}
						else
						{
							$this->SetFont('helvetica', '', 8);
							$this->Cell($v[0],6,$nojab,'LTR',0,'C',false);
		                    $tmt = date("d-m-Y",strtotime($row->TMT));
		                    $this->Cell($v[1],6,$tmt,'LTR',0,'C',false);
		                    $this->SetFont('helvetica', '', 7);
							$this->Cell($v[2],6,$nalokl1 ,'LTR',0,'L',false);
		                    $this->Cell($v[3],6,$najabl1,'LTR',0,'L',false);
		                    $this->Cell($v[4],6,$napang1,'LTR',0,'L',false);
		                    
		                    $this->Cell($v[5],6,$row->NOSK,'LTR',0,'L',false);
		                    $tgsk = date("d-m-Y",strtotime($row->TGSK));
		                    $this->SetFont('helvetica', '', 8);
		                    $this->Cell($v[6],6,$tgsk,'LTR',0,'L',false);

		                    $this->Ln();

		                    $this->SetFont('helvetica', '', 8);
		                    $this->Cell($v[0],6,'','LR',0,'C',false);
		                    $this->Cell($v[1],6,'','LR',0,'L',false);
		                    $this->SetFont('helvetica', '', 7);
		                    $this->Cell($v[2],6,$nalokl2,'LR',0,'L',false);
		                    $this->Cell($v[3],6,$najabl2,'LR',0,'L',false);
		                    $this->Cell($v[4],6,$napang2,'LR',0,'L',false);
		                    $this->Cell($v[5],6,'','LR',0,'L',false);
		                    $this->Cell($v[6],6,'','LR',0,'L',false);
		                   

		                    $this->Ln();

		                    $this->SetFont('helvetica', '', 8);
		                    $this->Cell($v[0],6,'','LBR',0,'C',false);
		                    $this->Cell($v[1],6,'','LBR',0,'L',false);
		                    $this->SetFont('helvetica', '', 7);
		                    $this->Cell($v[2],6,$nalokl3,'LBR',0,'L',false);
		                    $this->Cell($v[3],6,$najabl3,'LBR',0,'L',false);
		                    $this->Cell($v[4],6,$gol,'LBR',0,'L',false);
		                    $this->Cell($v[5],6,'','LBR',0,'L',false);
		                    $this->Cell($v[6],6,'','LBR',0,'L',false);
		                    
						}
						
					}
					else
					{
						if(strlen($najabl) > strlen($nalokl))
						{
							if(strlen($najabl) > ($maxlengthnajab*2))
							{
								$this->SetFont('helvetica', '', 8);
								$this->Cell($v[0],6,$nojab,'LTR',0,'C',false);
			                    $tmt = date("d-m-Y",strtotime($row->TMT));
			                    $this->Cell($v[1],6,$tmt,'LTR',0,'C',false);
			                    $this->SetFont('helvetica', '', 7);
								$this->Cell($v[2],6,$nalokl1 ,'LTR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl1,'LTR',0,'L',false);
			                    $this->Cell($v[4],6,$napang1,'LTR',0,'L',false);
			                   
			                    $this->Cell($v[5],6,$row->NOSK,'LTR',0,'L',false);
			                    $tgsk = date("d-m-Y",strtotime($row->TGSK));
			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[6],6,$tgsk,'LTR',0,'L',false);

			                    $this->Ln();

			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[0],6,'','LR',0,'C',false);
			                    $this->Cell($v[1],6,'','LR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[2],6,$nalokl2,'LR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl2,'LR',0,'L',false);
			                    $this->Cell($v[4],6,$napang2,'LR',0,'L',false);
			                    $this->Cell($v[5],6,'','LR',0,'L',false);
			                    $this->Cell($v[6],6,'','LR',0,'L',false);
			                    
			                    $this->Ln();
	                    
	                    		$this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[0],6,'','LBR',0,'C',false);
			                    $this->Cell($v[1],6,'','LBR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[2],6,$nalokl3,'LBR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl3,'LBR',0,'L',false);
			                    $this->Cell($v[4],6,$gol,'LBR',0,'L',false);
			                    $this->Cell($v[5],6,'','LBR',0,'L',false);
			                    $this->Cell($v[6],6,'','LBR',0,'L',false);
			                    
							}
							else
							{
								$this->SetFont('helvetica', '', 8);
								$this->Cell($v[0],6,$nojab,'LTR',0,'C',false);
			                    $tmt = date("d-m-Y",strtotime($row->TMT));
			                    $this->Cell($v[1],6,$tmt,'LTR',0,'C',false);
			                    $this->SetFont('helvetica', '', 7);
								$this->Cell($v[2],6,$nalokl1 ,'LTR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl1,'LTR',0,'L',false);
			                    $this->Cell($v[4],6,$napang1,'LTR',0,'L',false);
			                    
			                    $this->Cell($v[5],6,$row->NOSK,'LTR',0,'L',false);
			                    $tgsk = date("d-m-Y",strtotime($row->TGSK));
			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[6],6,$tgsk,'LTR',0,'L',false);

			                    $this->Ln();

			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[0],6,'','LR',0,'C',false);
			                    $this->Cell($v[1],6,'','LR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[2],6,$nalokl2,'LR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl2,'LR',0,'L',false);
			                    $this->Cell($v[4],6,$napang2,'LR',0,'L',false);
			                    $this->Cell($v[5],6,'','LR',0,'L',false);
			                    $this->Cell($v[6],6,'','LR',0,'L',false);
			                   
			                    $this->Ln();

			                    $this->SetFont('helvetica', '', 8);
			                    $this->Cell($v[0],6,'','LBR',0,'C',false);
			                    $this->Cell($v[1],6,'','LBR',0,'L',false);
			                    $this->SetFont('helvetica', '', 7);
			                    $this->Cell($v[2],6,$nalokl3,'LBR',0,'L',false);
			                    $this->Cell($v[3],6,$najabl3,'LBR',0,'L',false);
			                    $this->Cell($v[4],6,$gol,'LBR',0,'L',false);
			                    $this->Cell($v[5],6,'','LBR',0,'L',false);
			                    $this->Cell($v[6],6,'','LBR',0,'L',false);
			                  
							}
						}
						else
						{
							$this->SetFont('helvetica', '', 8);
							$this->Cell($v[0],6,$nojab,'LTR',0,'C',false);
		                    $tmt = date("d-m-Y",strtotime($row->TMT));
		                    $this->Cell($v[1],6,$tmt,'LTR',0,'C',false);
		                    $this->SetFont('helvetica', '', 7);
							$this->Cell($v[2],6,$nalokl1 ,'LTR',0,'L',false);
		                    $this->Cell($v[3],6,$najabl1,'LTR',0,'L',false);
		                    $this->Cell($v[4],6,$napang1,'LTR',0,'L',false);
		                   
		                    $this->Cell($v[5],6,$row->NOSK,'LTR',0,'L',false);
		                    $tgsk = date("d-m-Y",strtotime($row->TGSK));
		                    $this->SetFont('helvetica', '', 8);
		                    $this->Cell($v[6],6,$tgsk,'LTR',0,'L',false);

		                    $this->Ln();

		                    $this->SetFont('helvetica', '', 8);
		                    $this->Cell($v[0],6,'','LR',0,'C',false);
		                    $this->Cell($v[1],6,'','LR',0,'L',false);
		                    $this->SetFont('helvetica', '', 7);
		                    $this->Cell($v[2],6,$nalokl2,'LR',0,'L',false);
		                    $this->Cell($v[3],6,$najabl2,'LR',0,'L',false);
		                    $this->Cell($v[4],6,$napang2,'LR',0,'L',false);
		                    $this->Cell($v[5],6,'','LR',0,'L',false);
		                    $this->Cell($v[6],6,'','LR',0,'L',false);
		        
		                    $this->Ln();

		                    $this->SetFont('helvetica', '', 8);
		                    $this->Cell($v[0],6,'','LBR',0,'C',false);
		                    $this->Cell($v[1],6,'','LBR',0,'L',false);
		                    $this->SetFont('helvetica', '', 7);
		                    $this->Cell($v[2],6,$nalokl3,'LBR',0,'L',false);
		                    $this->Cell($v[3],6,$najabl3,'LBR',0,'L',false);
		                    $this->Cell($v[4],6,$gol,'LBR',0,'L',false);
		                    $this->Cell($v[5],6,'','LBR',0,'L',false);
		                    $this->Cell($v[6],6,'','LBR',0,'L',false);
		                 
						}
						
					}

                    $nojab++;
                }




            }

            $this->AddPage();  

       		//jabatan struktural
       		if($data['infoGapokUser'] != null)
            {
                $this->Ln();
                $w = array(180);
                $this->SetFont('helvetica', 'B', 12);
                $this->SetFillColor(26,179,148);
                $this->SetTextColor(255,255,255);
                $this->Cell($w[0],6,'RIWAYAT GAJI POKOK',1,0,'L',true);

                $this->SetTextColor(0,0,0);
                $this->SetFont('helvetica', 'B', 8);
				
				$this->Ln();
                $this->SetX(10);
                $v = array(8,25,52,35,35,25);
                $this->Cell($v[0],6,'NO',1,0,'C',false);
                $this->Cell($v[1],6,'TMT',1,0,'C',false);
                $this->Cell($v[2],6,'PANGKAT',1,0,'C',false);
                $this->Cell($v[3],6,'GAJI',1,0,'C',false);
                $this->Cell($v[4],6,'NO.SK',1,0,'C',false);
                $this->Cell($v[5],6,'TGL.SK',1,0,'C',false);
                $i=1;
                    
                
                foreach($data['infoGapokUser'] as $row)
                {
                	$this->Ln();
                	$this->SetFont('helvetica', '', 8);
                    $this->Cell($v[0],6,$i,1,0,'C',false);
                    $tmt = date("d-m-Y",strtotime($row->TMT));
                    $this->Cell($v[1],6,$tmt,1,0,'C',false);
					$this->Cell($v[2],6,$row->NAPANG,1,0,'L',false);
                   	$this->Cell($v[3],6,number_format($row->GAPOK),1,0,'L',false);
                    $this->Cell($v[4],6,$row->NOSK,1,0,'L',false);
                    $tgsk = date("d-m-Y",strtotime($row->TGSK));
                    $this->Cell($v[5],6,$tgsk,1,0,'L',false);

                    $i++;
                }    
            }
            $this->Ln();

            if($data['infoPangkat'] != null)
            {
                $this->Ln();
                $w = array(180);
                $this->SetFont('helvetica', 'B', 12);
                $this->SetFillColor(26,179,148);
                $this->SetTextColor(255,255,255);
                $this->Cell($w[0],6,'RIWAYAT PANGKAT',1,0,'L',true);

                $this->SetTextColor(0,0,0);
                $this->SetFont('helvetica', 'B', 8);
				
				$this->Ln();
                $this->SetX(10);
                $v = array(8,20,27,75,30,20);
                $this->Cell($v[0],6,'NO',1,0,'C',false);
                $this->Cell($v[1],6,'TMT',1,0,'C',false);
                $this->Cell($v[2],6,'PANGKAT',1,0,'C',false);
                $this->Cell($v[3],6,'LOKASI',1,0,'C',false);
                $this->Cell($v[4],6,'NO.SK',1,0,'C',false);
                $this->Cell($v[5],6,'TGL.SK',1,0,'C',false);
                $i=1;
                    
                
                foreach($data['infoPangkat'] as $row)
                {
                	$this->Ln();
                	$this->SetFont('helvetica', '', 7);


                	$nalokl = $row->NALOKL;
                	$wordnalokl = explode(" ",$nalokl);

					$text=$nalokl;
					$num_char=30;

					if(strlen($nalokl) > $num_char)
					{
						$char     = $text{$num_char - 1};
						while($char != ' ') {
							$char = $text{--$num_char};
						}	
					}
                    
					
					$nalokl1 = substr($text, 0, $num_char);
					$pjgnalokl = strlen($nalokl);
					$nalokl2="";

					$this->SetFont('helvetica', '', 8);
					$this->Cell($v[0],6,$i,1,0,'C',false);
                    $tmt = date("d-m-Y",strtotime($row->TMT));
                    $this->Cell($v[1],6,$tmt,1,0,'C',false);
                    $this->SetFont('helvetica', '', 7);
					$this->Cell($v[2],6,$row->NAPANG,1,0,'L',false);
                   	$this->Cell($v[3],6,$row->NALOKL,1,0,'L',false);
                    $this->Cell($v[4],6,$row->NOSK,1,0,'L',false);
                    $tgsk = date("d-m-Y",strtotime($row->TGSK));
                    $this->SetFont('helvetica', '', 8);
                    $this->Cell($v[5],6,$tgsk,1,0,'L',false);

                    $i++;
                }    
            }

            $this->Ln();

            if($data['infoHargaan'] != null)
            {
                $this->Ln();
                $w = array(180);
                $this->SetFont('helvetica', 'B', 12);
                $this->SetFillColor(26,179,148);
                $this->SetTextColor(255,255,255);
                $this->Cell($w[0],6,'RIWAYAT PENGHARGAAN',1,0,'L',true);

                $this->SetTextColor(0,0,0);
                $this->SetFont('helvetica', 'B', 8);
				
				$this->Ln();
                $this->SetX(10);
                $v = array(8,70,52,30,20);
                $this->Cell($v[0],6,'NO',1,0,'C',false);
                $this->Cell($v[1],6,'NAMA PENGHARGAAN',1,0,'C',false);
                $this->Cell($v[2],6,'ASAL PENGHARGAAN',1,0,'C',false);
                $this->Cell($v[3],6,'NO.SK',1,0,'C',false);
                $this->Cell($v[4],6,'TGL.SK',1,0,'C',false);
                $i=1;
                    
                
                foreach($data['infoHargaan'] as $row)
                {
                	$this->Ln();
                	$this->SetFont('helvetica', '', 8);
                    $this->Cell($v[0],6,$i,1,0,'C',false);
                    $this->Cell($v[1],6,$row->NAHARGA,1,0,'L',false);
					$this->Cell($v[2],6,ltrim($row->ASAL_HRG),1,0,'L',false);
                   	$this->Cell($v[3],6,ltrim($row->NOSK),1,0,'L',false);
                    $tgsk = date("d-m-Y",strtotime($row->TGSK));
                    $this->Cell($v[4],6,$tgsk,1,0,'L',false);

                    $i++;
                }    
            }

            if($data['infoDisiplin'] != null)
            {
                  
                $this->Ln();
                $this->Ln();
                $w = array(180);
                $this->SetFont('helvetica', 'B', 12);
                $this->SetFillColor(26,179,148);
                $this->SetTextColor(255,255,255);
                $this->Cell($w[0],6,'RIWAYAT DISIPLIN',1,0,'L',true);

                $this->SetTextColor(0,0,0);
                $this->SetFont('helvetica', 'B', 8);
                
                $this->Ln();
                $this->SetX(10);
                
                 $v = array(8,21,21,88,21,21);
                $this->Cell($v[0],6,'NO',1,0,'C',false);
                $this->Cell($v[1],6,'TGMULAI',1,0,'C',false);
                $this->Cell($v[2],6,'TGAKHIR',1,0,'C',false);
                $this->Cell($v[3],6,'HUKUMAN DISIPLIN',1,0,'C',false);
                $this->Cell($v[4],6,'NO.SK',1,0,'C',false);
                $this->Cell($v[5],6,'TGL.SK',1,0,'C',false);

                
                
                $i=1;
                    
                $this->SetFont('helvetica', '', 8);
                $nojab = 1;

                foreach($data['infoDisiplin'] as $row)
                {
                    $this->Ln();
                    $this->SetFont('helvetica', '', 8);
                    $this->Cell($v[0],6,$i,1,0,'C',false);
                    $tgmulai = date("d-m-Y",strtotime($row->TGMULAI));
                    $this->Cell($v[1],6,$tgmulai,1,0,'C',false);
                    $tgakhir = date("d-m-Y",strtotime($row->TGAKHIR));
                    if($row->TGAKHIR == "")
                    {
                        $this->Cell($v[2],6,'',1,0,'C',false);
                    }
                    else
                    {
                        $this->Cell($v[2],6,$tgakhir,1,0,'C',false);    
                    }
                    
                    $this->Cell($v[3],6,$row->KETERANGAN,1,0,'L',false);
                    $this->Cell($v[4],6,$row->NOSK,1,0,'L',false);
                    $tgsk = date("d-m-Y",strtotime($row->TGSK));
                    $this->Cell($v[5],6,$tgsk,1,0,'L',false);

                    $i++;
                } 
                
            }

            $vs = array(8,21,25,25,31,70);
            if($data['infoSKPUser'] != null)
            {
                  
                $this->Ln();
                $this->Ln();
                $w = array(180);
                $this->SetFont('helvetica', 'B', 12);
                $this->SetFillColor(26,179,148);
                $this->SetTextColor(255,255,255);
                $this->Cell($w[0],6,'RIWAYAT SKP',1,0,'L',true);

                $this->SetTextColor(0,0,0);
                $this->SetFont('helvetica', 'B', 8);
                
                $this->Ln();
                $this->SetX(10);
                
                 
                $this->Cell($vs[0],6,'NO',1,0,'C',false);
                $this->Cell($vs[1],6,'TAHUN',1,0,'C',false);
                $this->Cell($vs[2],6,'NILAI SKP',1,0,'C',false);
                $this->Cell($vs[3],6,'NILAI PERILAKU',1,0,'C',false);
                $this->Cell($vs[4],6,'NILAI PRESTASI',1,0,'C',false);
                $this->Cell($vs[5],6,'KETERANGAN PRESTASI',1,0,'C',false);

                
                
                $i=1;
                    
                $this->SetFont('helvetica', '', 8);
                

                foreach($data['infoSKPUser'] as $row)
                {
                    $this->Ln();
                    $this->SetFont('helvetica', '', 8);
                    $this->Cell($vs[0],6,$i,1,0,'C',false);
                    
                    $this->Cell($vs[1],6,$row->TAHUN,1,0,'C',false);
                    $this->Cell($vs[2],6,$row->INPUT_SKP,1,0,'R',false);
                    $this->Cell($vs[3],6,$row->RATA2,1,0,'R',false);
                    $this->Cell($vs[4],6,$row->NILAI_PRESTASI,1,0,'R',false);
                    $this->Cell($vs[5],6,$row->KET_PRESTASI,1,0,'C',false);

                    $i++;
                } 
                
            }
      
    }

    public function isiHTML($data,$nrk)
    {

    	 $tbl = '<table cellpadding="3">
                        <tr>
                            <td colspan="3" style="background-color:#1AB394; color:white;"><h3>DATA DIRI</h3></td>
                        </tr>
                        <tr>
                            <td width="15%"><b>Nama </b></td>
                            <td width="5%"><b>: </b></td>';

             if($data['infoUser']->TITELDEPAN == null && $data['infoUser']->TITEL==null)
            {
                $tbl.=          '<td width="55%">'.$data['infoUser']->NAMA_ABS.'</td>';
            }
            else if($data['infoUser']->TITELDEPAN!=null && $data['infoUser']->TITEL == null)
            {
                $tbl.=          '<td width="55%">'.$data['infoUser']->TITELDEPAN.''.$data['infoUser']->NAMA_ABS.'</td>';
            }
            else if($data['infoUser']->TITELDEPAN == null && $data['infoUser']->TITEL != null)
            {
                $tbl.=          '<td width="55%">'.$data['infoUser']->NAMA_ABS.' '.$data['infoUser']->TITEL.'</td>';
            }
            else
            {
                $tbl.=          '<td width="55%">'.$data['infoUser']->TITELDEPAN.''.$data['infoUser']->NAMA_ABS.''.$$data['infoUser']->TITEL.'</td>';    
            }

            $tbl.=          '<td></td>
                            
                        </tr>

                        <tr>
                            <td><b>NRK</b></td>
                            <td><b>:</b></td>
                            <td>'.$data['infoUser']->NRK.'</td>
                            <td width="25%" rowspan="6" align="center">';
                                $linkImg = 'assets/img/photo/'.$data['infoUser']->NRK.'.jpg';
                                    if(file_exists($linkImg))
                                    {
                                      $img = base_url().'assets/img/photo/'.$data['infoUser']->NRK.'.jpg';                                    
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
                            <td>'.$data['infoUser']->NIP18.'</td>
                        </tr>

                        <tr>
                            <td><b>Tempat/Tgl Lahir</b></td>
                            <td><b>:</b></td>
                            <td>'.$data['infoUser']->PATHIR.', '.$data['infoUser']->TLHR.'</td>
                        </tr>

                        <tr>
                            <td><b>Jabatan</b></td>
                            <td><b>:</b></td>
                            <td>'.$data['infoUser']->NAJABL.'</td>
                        </tr>

                        <tr>
                            <td><b>Lokasi</b></td>
                            <td><b>:</b></td>
                            <td>'.$data['infoUser']->NALOKL.'</td>
                        </tr>
                          
                        <tr>
                            <td><b>Alamat</b></td>
                            <td><b>:</b></td>
                            <td>'.$data['infoAlamat']->ALAMAT.' RT '.$data['infoAlamat']->RT.' RW '.$data['infoAlamat']->RW.
                                ' KEL. '.$data['infoAlamat']->NAKEL.' KEC. '.$data['infoAlamat']->NACAM.' '.$data['infoAlamat']->NAWIL.' - '.strtoupper($data['infoAlamat']->PROP).'</td>           
                        </tr>   
                        </table><br/><br/>';


        if($data['infoPenForm'] !=null){
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
                            foreach($data['infoPenForm'] as $row)
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


        if($data['infoPenNForm'] != null){

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
                            foreach($data['infoPenNForm'] as $row)
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

        if($data['infoHubkel'] !=null)
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
                            foreach($data['infoHubkel'] as $row)
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

       
         $this->AddPage();

         if($data['infoJabatanS'] !=null){

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
                            foreach($data['infoJabatanS'] as $row)
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

        if($data['infoJabatanF'] !=null){

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
                            foreach($data['infoJabatanF'] as $row)
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

        $this->AddPage();

        if($data['infoGapokUser'] !=null){        

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
                              foreach($data['infoGapokUser'] as $row)
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

        
        

        if($data['infoPangkat'] !=null){        

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
                              foreach($data['infoPangkat'] as $row)
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

        
        if($data['infoHargaan'] !=null)
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
                            foreach($data['infoHargaan'] as $row)
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
        $this->WriteHTML($tbl);
    }

    function txtentities($html){
    $trans = get_html_translation_table(HTML_ENTITIES);
    $trans = array_flip($trans);
    return strtr($html, $trans);
}


function OpenTag($tag, $attr)
{
    //Opening tag
    switch($tag){

        case 'SUP':
            if( !empty($attr['SUP']) ) {    
                //Set current font to 6pt     
                $this->SetFont('','',6);
                //Start 125cm plus width of cell to the right of left margin         
                //Superscript "1" 
                $this->Cell(2,2,$attr['SUP'],0,0,'L');
            }
            break;

        case 'TABLE': // TABLE-BEGIN
            if( !empty($attr['BORDER']) ) $this->tableborder=$attr['BORDER'];
            else $this->tableborder=0;
            break;
        case 'TR': //TR-BEGIN
            break;
        case 'TD': // TD-BEGIN
            if( !empty($attr['WIDTH']) ) $this->tdwidth=($attr['WIDTH']/4);
            else $this->tdwidth=40; // Set to your own width if you need bigger fixed cells
            if( !empty($attr['HEIGHT']) ) $this->tdheight=($attr['HEIGHT']/6);
            else $this->tdheight=6; // Set to your own height if you need bigger fixed cells
            if( !empty($attr['ALIGN']) ) {
                $align=$attr['ALIGN'];        
                if($align=='LEFT') $this->tdalign='L';
                if($align=='CENTER') $this->tdalign='C';
                if($align=='RIGHT') $this->tdalign='R';
            }
            else $this->tdalign='L'; // Set to your own
            if( !empty($attr['BGCOLOR']) ) {
                $coul=hex2dec($attr['BGCOLOR']);
                    $this->SetFillColor($coul['R'],$coul['G'],$coul['B']);
                    $this->tdbgcolor=true;
                }
            $this->tdbegin=true;
            break;

        case 'HR':
            if( !empty($attr['WIDTH']) )
                $Width = $attr['WIDTH'];
            else
                $Width = $this->w - $this->lMargin-$this->rMargin;
            $x = $this->GetX();
            $y = $this->GetY();
            $this->SetLineWidth(0.2);
            $this->Line($x,$y,$x+$Width,$y);
            $this->SetLineWidth(0.2);
            $this->Ln(1);
            break;
        case 'STRONG':
            $this->SetStyle('B',true);
            break;
        case 'EM':
            $this->SetStyle('I',true);
            break;
        case 'B':
        case 'I':
        case 'U':
            $this->SetStyle($tag,true);
            break;
        case 'A':
            $this->HREF=$attr['HREF'];
            break;
        case 'IMG':
            if(isset($attr['SRC']) && (isset($attr['WIDTH']) || isset($attr['HEIGHT']))) {
                if(!isset($attr['WIDTH']))
                    $attr['WIDTH'] = 0;
                if(!isset($attr['HEIGHT']))
                    $attr['HEIGHT'] = 0;
                $this->Image($attr['SRC'], $this->GetX(), $this->GetY(), $this->px2mm($attr['WIDTH']), $this->px2mm($attr['HEIGHT']));
            }
            break;
        case 'BLOCKQUOTE':
        case 'BR':
            $this->Ln(5);
            break;
        case 'P':
            $this->Ln(10);
            break;
        case 'FONT':
            if (isset($attr['COLOR']) && $attr['COLOR']!='') {
                $coul=hex2dec($attr['COLOR']);
                $this->SetTextColor($coul['R'],$coul['G'],$coul['B']);
                $this->issetcolor=true;
            }
            if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist)) {
                $this->SetFont(strtolower($attr['FACE']));
                $this->issetfont=true;
            }
            if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist) && isset($attr['SIZE']) && $attr['SIZE']!='') {
                $this->SetFont(strtolower($attr['FACE']),'',$attr['SIZE']);
                $this->issetfont=true;
            }
            break;
    }
}

function CloseTag($tag)
{
    //Closing tag
    if($tag=='SUP') {
    }

    if($tag=='TD') { // TD-END
        $this->tdbegin=false;
        $this->tdwidth=0;
        $this->tdheight=0;
        $this->tdalign="L";
        $this->tdbgcolor=false;
    }
    if($tag=='TR') { // TR-END
        $this->Ln();
    }
    if($tag=='TABLE') { // TABLE-END
        $this->tableborder=0;
    }

    if($tag=='STRONG')
        $tag='B';
    if($tag=='EM')
        $tag='I';
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF='';
    if($tag=='FONT'){
        if ($this->issetcolor==true) {
            $this->SetTextColor(0);
        }
        if ($this->issetfont) {
            $this->SetFont('arial');
            $this->issetfont=false;
        }
    }
}

function SetStyle($tag, $enable)
{
    //Modify style and select corresponding font
    $this->$tag+=($enable ? 1 : -1);
    $style='';
    foreach(array('B','I','U') as $s) {
        if($this->$s>0)
            $style.=$s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    //Put a hyperlink
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}

function hex2dec($couleur = "#000000"){
    $R = substr($couleur, 1, 2);
    $rouge = hexdec($R);
    $V = substr($couleur, 3, 2);
    $vert = hexdec($V);
    $B = substr($couleur, 5, 2);
    $bleu = hexdec($B);
    $tbl_couleur = array();
    $tbl_couleur['R']=$rouge;
    $tbl_couleur['G']=$vert;
    $tbl_couleur['B']=$bleu;
    return $tbl_couleur;
}

//conversion pixel -> millimeter in 72 dpi
function px2mm($px){
    return $px*25.4/72;
}
    function WriteHTML($html)
{
    //$html=strip_tags($html,"<b><u><i><a><img><p><br><strong><em><font><tr><blockquote><hr><td><tr><table><sup>"); //remove all unsupported tags
    $html=str_replace("\n",'',$html); //replace carriage returns with spaces
    $html=str_replace("\t",'',$html); //replace carriage returns with spaces
    $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE); //explode the string
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            //Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            elseif($this->tdbegin) {
                if(trim($e)!='' && $e!="&nbsp;") {
                    $this->Cell($this->tdwidth,$this->tdheight,$e,$this->tableborder,'',$this->tdalign,$this->tdbgcolor);
                }
                elseif($e=="&nbsp;") {
                    $this->Cell($this->tdwidth,$this->tdheight,'',$this->tableborder,'',$this->tdalign,$this->tdbgcolor);
                }
            }
            else
                $this->Write(5,stripslashes($this->txtentities($e)));
        }
        else
        {
            //Tag
            if($e[0]=='/')
                //$this->CloseTag(strtoupper(substr($e,1)));
                continue;
            else
            {
                //Extract attributes
                $a2=explode(' ',$e);
                $tag=strtoupper(array_shift($a2));
                $attr=array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])]=$a3[2];
                }
                //$this->OpenTag($tag,$attr);
            }
        }
    }
}
        
}
 
/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */