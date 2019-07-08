<?php
ob_start();
$this->pdf_isi_perbal->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE,'DAFTAR RIWAYAT HIDUP', PDF_HEADER_STRING);

// set header and footer fonts
$this->pdf_isi_perbal->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$this->pdf_isi_perbal->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// remove default header/footer
$this->pdf_isi_perbal->setPrintHeader(false);
$this->pdf_isi_perbal->setPrintFooter(false);

// set default monospaced font
$this->pdf_isi_perbal->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$this->pdf_isi_perbal->SetMargins(PDF_MARGIN_LEFT, 7, PDF_MARGIN_RIGHT);
//$this->pdf->SetMargins(15, 15, 15);
$this->pdf_isi_perbal->SetHeaderMargin(PDF_MARGIN_HEADER);
$this->pdf_isi_perbal->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$this->pdf_isi_perbal->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$this->pdf_isi_perbal->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
require_once(dirname(__FILE__).'/lang/eng.php');
$pdf_isi_perbal->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$this->pdf_isi_perbal->SetFont('helvetica', 'B', 20);

// add a page
$this->pdf_isi_perbal->AddPage('P');

$this->pdf_isi_perbal->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$this->pdf_isi_perbal->SetFont('helvetica', '', 10);

$this->pdf_isi_perbal->writeHTML($cover_html, true, false, false, false, '');

$this->pdf_isi_perbal->LastPage();

$this->pdf_isi_perbal->AddPage('P');

$this->pdf_isi_perbal->writeHTML($isi_html, true, false, false, false, '');
ob_clean();

$this->pdf_isi_perbal->Output('perbal_naskah_dinas.pdf', 'I');

?>