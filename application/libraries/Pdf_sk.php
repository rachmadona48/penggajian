<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
require_once dirname(__FILE__) . '/tcpdf/tcpdf/tcpdf.php';
 
class Pdf_sk extends TCPDF
{
    function __construct()
    {
        parent::__construct('L','mm','A3',true,'UTF-8',false,false);
        
    }
    public function Header() {
        /*if($this->page == 1){
        // Logo
        $image_file = K_PATH_IMAGES.'Logo_DKI_Jakarta.jpg';
        $this->Image($image_file, 66.7, 10, 30, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        //set bg image
        //$img_file = K_PATH_IMAGES.'Logo_DKI_Jakarta.jpg';
        //$this->Image($img_file, 10, 50, 200, 200, '', '', '', false, 300, '', false, false, 0);


        // Set font
        //$this->SetFont('helvetica', 'B', 15);
        // Title
        //$this->Cell(0, 5, 'Daftar Riwayat Hidup', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        
        $this->Ln();
        $this->Cell(0, 5, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(0, 5, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(0, 5, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(0, 5, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->Cell(0, 5, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        
        // $this->Cell(0, 5, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        // $this->Ln();
        // $this->Cell(0, 5, '', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        // $this->Ln();
        $this->SetFont('helvetica', 'B', 10);
        $this->setCellMargins(25,0,0,0);
        $this->Cell(0, 5, 'PEMERINTAH PROVINSI DAERAH KHUSUS', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        $this->setCellMargins(50.7,0,0,0);
        $this->Cell(0, 5, 'IBUKOTA JAKARTA', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->Ln();
        }*/
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
 
/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */