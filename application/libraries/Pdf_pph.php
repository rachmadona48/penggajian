<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//set_time_limit(180);
 
require_once dirname(__FILE__) . '/FPDF/fpdf.php';
 
class Pdf_pph extends FPDF
{
    function __construct()
    {
        parent::__construct('L','mm','A3',true,'UTF-8',false,false);
        
    }
    public function Header() {
        $image_file = 'assets/img/Logo_DKI_Jakarta.jpg';
       /* $this->Image($image_file, 3, 10, 45, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);*/
        $this->Image($image_file, 20, 10, 50, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

         $this->Ln();
        $this->Cell(0, 5, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
        //$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

     public function convertKeNamaBulan($bulan){
        //Contoh : $bulan : 01 => Output : Januari;
        switch ($bulan) {
            case '01':
                return 'JANUARI';
                break;
            case '02':
                return 'FEBRUARI';
                break;
            case '03':
                return 'MARET';
                break;
            case '04':
                return 'APRIL';
                break;
            case '05':
                return 'MEI';
                break;
            case '06':
                return 'JUNI';
                break;
            case '07':
                return 'JULI';
                break;
            case '08':
                return 'AGUSTUS';
                break;
            case '09':
                return 'SEPTEMBER';
                break;
            case '10':
                return 'OKTOBER';
                break;
            case '11':
                return 'NOVEMBER';
                break;
            case '12':
                return 'DESEMBER';
                break;
            
            default:
                return '';
                break;
        }
    }

    public function ImprovedTable($header, $data)
    {
        
        $jmldata = count($data);
        
        // Column widths
        $w = array(8,20,13,13,13,13,13,28,28,28,28,28,28,28,28,28,28,28);
        
        // Header
        $this->Cell($w[0],7,$header[0],1,0,'C');
        $this->Cell($w[1],7,$header[1],1,0,'C');
        $this->Cell($w[2],7,$header[2],1,0,'C');
        $this->Cell($w[3],7,$header[3],1,0,'C');
        $this->Cell($w[4],7,$header[4],1,0,'C');
        $this->Cell($w[5],7,$header[5],1,0,'C');
        $this->Cell($w[6],7,$header[6],1,0,'C');
        $this->Cell($w[7],7,$header[7],1,0,'C');
        $this->Cell($w[8],7,$header[8],1,0,'C');
        $this->Cell($w[9],7,$header[9],1,0,'C');
        $this->Cell($w[10],7,$header[10],1,0,'C');
        $this->Cell($w[11],7,$header[11],1,0,'C');
        $this->Cell($w[12],7,$header[12],1,0,'C');
        $this->Cell($w[13],7,$header[13],1,0,'C');
        $this->Cell($w[14],7,$header[14],1,0,'C');
        $this->Cell($w[15],7,$header[15],1,0,'C');
        $this->Cell($w[16],7,$header[16],1,0,'C');
           
        
        $this->Ln();
        
        // Data
        $no=1;
        

        $this->SetFont('helvetica', '', 8);
        $page =1;
        $ct=1;
        //$lnperpage = 35;
        
        foreach($data as $row)
        {
            $bulan = $this->convertKeNamaBulan(substr($row->THBL,4, 2));
            $thbl = $bulan;
            $gol1 = $row->PEG_GOL1;
            $gol2 = $row->PEG_GOL2;
            $gol3 = $row->PEG_GOL3;
            $gol4 = $row->PEG_GOL4;
            $totpeg = $row->PEG_TOTAL;
            $gapok = $row->PEG_TOTAL_GAPOK;
            $tunkel = $row->PEG_TOTAL_TUNKEL;
            $tunjab = $row->PEG_TOTAL_TUNJAB;
            $tunfung = $row->PEG_TOTAL_TUNFUNG;
            $tunlai = $row->PEG_TOTAL_TUNLAI;
            $pphgaji = $row->PEG_TOTAL_TPPHGAJI;
            $beras = $row->PEG_TOTAL_TBERAS;
            $lain = $row->PEG_TOTAL_LAIN;
            $bulat = $row->PEG_TOTAL_BULAT;
            $kotor = $row->PEG_TOTAL_GAJI_KOTOR;
            
           
            
            $this->Cell($w[0],7,$no,1,0,'C');
            $this->Cell($w[1],7,$thbl,1,0,'L');
            $this->Cell($w[2],7,$gol1,1,0,'R');
            $this->Cell($w[3],7,$gol2,1,0,'R');
            $this->Cell($w[4],7,$gol3,1,0,'R');
            $this->Cell($w[5],7,$gol4,1,0,'R');
            $this->Cell($w[6],7,$totpeg,1,0,'R');
            $this->Cell($w[7],7,number_format($gapok, 0, ',', '.'),1,0,'R');
            $this->Cell($w[8],7,number_format($tunkel, 0, ',', '.'),1,0,'R');
            $this->Cell($w[9],7,number_format($tunjab, 0, ',', '.'),1,0,'R');
            $this->Cell($w[10],7,number_format($tunfung, 0, ',', '.'),1,0,'R');
            $this->Cell($w[11],7,number_format($tunlai, 0, ',', '.'),1,0,'R');
            $this->Cell($w[12],7,number_format($pphgaji, 0, ',', '.'),1,0,'R');
            $this->Cell($w[13],7,number_format($beras, 0, ',', '.'),1,0,'R');
            $this->Cell($w[14],7,$lain,1,0,'R');
            $this->Cell($w[15],7,number_format($bulat, 0, ',', '.'),1,0,'R');
            $this->Cell($w[16],7,number_format($kotor, 0, ',', '.'),1,0,'R');
            
            $this->Ln();

            $no++;
        }
        // Closing line
        //$this->Cell(array_sum($w),0,'','T');
    }


}
 
/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */