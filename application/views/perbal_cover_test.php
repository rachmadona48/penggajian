<?php
ob_start();
$this->pdf_report2->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE,'DAFTAR RIWAYAT HIDUP', PDF_HEADER_STRING);

// set header and footer fonts
$this->pdf_report2->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$this->pdf_report2->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// remove default header/footer
$this->pdf_report2->setPrintHeader(false);
$this->pdf_report2->setPrintFooter(false);

// set default monospaced font
$this->pdf_report2->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$this->pdf_report2->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT);
//$this->pdf->SetMargins(15, 15, 15);
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
$this->pdf_report2->SetFont('helvetica', 'B', 20);

// add a page
$this->pdf_report2->AddPage('L');

$this->pdf_report2->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$this->pdf_report2->SetFont('helvetica', '', 10);

// -----------------------------------------------------------------------------

//        var_dump($rs);exit;
$html ='<title>Cetak Cover Perbal</title>';
$html ='
<table>
    <tr>
        <td></td>
        <td width="45%">
            <h2 align="center">PERBAL NASKAH DINAS</h2>

            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><hr>DIISI OLEH UNIT / CTU<br>PENGONSEP<hr></td>
                    <td><hr>DIISI OLEH BIRO UMUM / BAGIAN UMUM<br>SETKODYA / ITU<hr></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td width="20">1.</td>
                    <td width="300">Dikerjakan oleh : '.$rs->DIKERJAKAN.'</td>
                    <td width="20">1.</td>
                    <td width="300"><p>Diterima di Pengendali Surat : </p></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Diperiksa oleh : '.$rs->DIPERIKSA.'</td>
                    <td>2.</td>
                    <td>Dinomori oleh : </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>3.</td>
                    <td>Diketik oleh :</td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>Diedarkan oleh : '.$rs->DIEDARKAN.'</td>
                    <td>4.</td>
                    <td>Ditaklik oleh :&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>5.</td>
                    <td>Diterima oleh Pengirim Surat :&nbsp;</td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>Net telah disetujui oleh&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>Unit /Sub unit / CTU&nbsp;</td>
                    <td>6.</td>
                    <td>Dikirim oleh :</td>
                </tr>
                <tr>
                    <td colspan="1" rowspan="2">&nbsp;</td>
                    <td style="white-space: nowrap;">Pengonsep : '.$rs->DISETUJUI.'</td>
                    <td>7.</td>
                    <td>Perbal dan pertinggal disimpan oleh :</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
';
if(is_null($dimajukan)):
$html .= '
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td><hr></td>
                </tr>
                <tr>
                    <td align="center">Dimajukan pada tanggal '.$dimajukan.' <br></td>
                </tr>
                <tr>
                    <td><hr></td>
                </tr>
            </table>';
endif;
if(!is_null($dimajukan)):
$html .= '<hr/>';
endif;
$html .= '
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>Hal / Judul / Naskah Dinas :&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        '.$rs->HAL.'
                    </td>
                </tr>
            </table>
            <hr />
            <br>&nbsp;<br>
            <table border="0" cellpadding="2" cellspacing="2">
                <tbody>
                <tr>
                    <td width="100">Nomor</td>
                    <td width="10">:</td>
                    <td width="210"> '.$rs->NO_PERBAL.'</td>
                    <td width="320">Jakarta, '.$tgl_perbal.'</td>
                </tr>
                <tr>
                    <td>Sifat</td>
                    <td>:</td>
                    <td> '.$rs->SIFAT.'</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>:</td>
                    <td> '.$rs->LAMPIRAN.'</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Pemaraf Serta</td>
                    <td>:</td>
                    <td></td>
                    <td>Tembusan :</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <ul>
                            <li type="square">Sekretaris BKD</li>
                            <li type="square">Ka. Biro Hukum</li>
                            <li type="square">Ka. Biro Umum</li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li type="square">Gubernur Provinsi DKI Jakarta</li>
                            <li type="square">Ka. Kanreg V BKN</li>
                            <li type="square">Sekda Provinsi DKI Jakarta</li>
                            <li type="square">Inspektur Provinsi DKI Jakarta</li>
                            <li type="square">Ka. BPKD Provinsi DKI Jakarta</li>
                            <li type="square">Ka. Dinas ___ Provinsi DKI Jakarta</li>
                            <li type="square">Ka. Biro Umum Setda Provinsi DKI Jakarta</li>
                            <li type="square">Dir ___ Prov. DKI Jakarta</li>
                            <li type="square">Ka. Sudin ___ Kota Adm. Jkt</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>Ditetapkan Oleh</td>
                    <td>:</td>
                    <td></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:center">
                        <p>a.n. GUBERNUR PROVINSI DAERAH KHUSUS<br/>IBUKOTA JAKARTA <br/> KEPALA BADAN KEPEGAWAIAN DAERAH</p>
                        <br><br>
                        <p>SURADIKA<br/>NIP 196208211993031002</p>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4">
                        Setelah selesai pembuatan naskah dinas perbal Asli<br>
                        dan pertinggal diserahkan kepada  '.$rs->DISERAHKAN.'
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
</table>
';
//-----------------------------------------------------------------------
// $this->pdf_report2->writeHTML($html, true, false, false, false, '');
$this->pdf_report2->writeHTML($template, true, false, false, false, '');
ob_clean();

$this->pdf_report2->Output('perbal_naskah_dinas.pdf', 'I');

?>