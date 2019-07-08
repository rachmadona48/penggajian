<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//set_time_limit(180);
 
require_once dirname(__FILE__) . '/FPDF/fpdf.php';
 
class Pdf_ukpdf extends FPDF
{
    function __construct()
    {
        parent::__construct('L','mm','A3',true,'UTF-8',false,false);
        
    }
    public function Header() {
        
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        //$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    public function ImprovedTable($header, $header2, $data)
    {
        $jmldata = count($data);
        
        // Column widths
        $x = array(10,130,15,15,15,15,15,15,15,15,15,15,15,15,15,15,20);
        $w = array(10,130,15,15,15,15,15,15,15,15,15,15,15,15,15,15,20);
        // Header
        for($i=0;$i<count($header);$i++)
        {
            $this->SetFont('helvetica', 'B', 8);
           if($i>4 && $i<(count($header) - 1))
           {
                $this->Cell($w[$i],7,$header[$i],'TB',0,'C');
           }
           else
           {
                $this->Cell($w[$i],7,$header[$i],'TLR',0,'C');
           }
        }
        $this->Ln();
        for($i=0;$i<count($x);$i++)
        {
        
            $this->Cell($x[$i],7,$header2[$i],'LRB',0,'C');
        }
        $this->Ln();
        // Data
        $no=1;
        $totales2=0; $totales3=0; $totales4=0; $totalcpns=0;
        $totalta =0; $totaltt =0; $totalaa =0; $totalat=0;
        $totaloa =0; $totalot =0; $totalpa =0; $totalpt=0;
        $totalln=0; $totaljft =0; $totaltot =0; 

        $this->SetFont('helvetica', '', 8);
        $page =1;
        $ct=1;
        $lnperpage = 35;
        $page1 = 30;

        foreach($data as $row)
        {
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
           

            
            

            $this->Cell($w[0],6,$no,1,0,'C');
            $this->Cell($w[1],6,$nalokl,1,0,'L');
            $this->Cell($w[2],6,$eselon2,1,0,'R');
            $this->Cell($w[3],6,$eselon3,1,0,'R');
            $this->Cell($w[4],6,$cpns,1,0,'R');
            $this->Cell($w[5],6,$ta,1,0,'R');
            $this->Cell($w[6],6,$tt,1,0,'R');
            $this->Cell($w[7],6,$aa,1,0,'R');
            $this->Cell($w[8],6,$tt,1,0,'R');
            $this->Cell($w[9],6,$aa,1,0,'R');
            $this->Cell($w[10],6,$oa,1,0,'R');
            $this->Cell($w[11],6,$ot,1,0,'R');
            $this->Cell($w[12],6,$pa,1,0,'R');
            $this->Cell($w[13],6,$pt,1,0,'R');
            $this->Cell($w[14],6,$ln,1,0,'R');
            $this->Cell($w[15],6,$jft,1,0,'R');
            $this->SetFont('helvetica', 'B', 10);
            $this->Cell($w[16],6,$tot,1,0,'R');
            $this->SetFont('helvetica', '', 8);
            $this->Ln();


          
                if($no == $page1 && $page == 1)
                {

                    $this->AddPage();
                    $x = array(10,130,15,15,15,15,15,15,15,15,15,15,15,15,15,15,20);
                    $w = array(10,130,15,15,15,15,15,15,15,15,15,15,15,15,15,15,20);
                    // Header
                    for($i=0;$i<count($header);$i++)
                    {
                        $this->SetFont('helvetica', 'B', 8);
                       if($i>4 && $i<(count($header) - 1))
                       {
                            $this->Cell($w[$i],7,$header[$i],'TB',0,'C');
                       }
                       else
                       {
                            $this->Cell($w[$i],7,$header[$i],'TLR',0,'C');
                       }
                    }
                    $this->Ln();
                    for($i=0;$i<count($x);$i++)
                    {
                    
                        $this->Cell($x[$i],7,$header2[$i],'LRB',0,'C');
                    }
                    $this->Ln();
                    $this->SetFont('helvetica', '', 8);
                    $page++;
                }
                else if($no == ($page1+($ct * $lnperpage)) && $page > 1)
                {
                    $this->AddPage();
                    $x = array(10,130,15,15,15,15,15,15,15,15,15,15,15,15,15,15,20);
                    $w = array(10,130,15,15,15,15,15,15,15,15,15,15,15,15,15,15,20);
                    // Header
                    for($i=0;$i<count($header);$i++)
                    {
                        $this->SetFont('helvetica', 'B', 8);
                       if($i>4 && $i<(count($header) - 1))
                       {
                            $this->Cell($w[$i],7,$header[$i],'TB',0,'C');
                       }
                       else
                       {
                            $this->Cell($w[$i],7,$header[$i],'TLR',0,'C');
                       }
                    }
                    $this->Ln();
                    for($i=0;$i<count($x);$i++)
                    {
                    
                        $this->Cell($x[$i],7,$header2[$i],'LRB',0,'C');
                    }
                    $this->Ln();
                    $this->SetFont('helvetica', '', 8);
                    $page++;
                    $ct++;
                }
            

            
            $no++;
        }
        // Closing line
        //$this->Cell(array_sum($w),0,'','T');
    }


}
 
/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */