<?php
/*ob_start();
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
$this->pdf_isi_perbal->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT);
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
$this->pdf_isi_perbal->AddPage('L');

$this->pdf_isi_perbal->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$this->pdf_isi_perbal->SetFont('helvetica', '', 10);

// -----------------------------------------------------------------------------
*/
$html = '
<h2 style="text-align:center">PERBAL NASKAH DINAS</h2>
<table style="width:100%;cellpadding:0;cellspacing:0">
  <tbody>
    <tr>
      <td colspan="2"> 
        <hr/>DIISI OLEH UNIT/CTU <br/>PENGONSEP
        <hr/>
      </td>
      <td colspan="2"> 
        <hr/>DIISI OLEH BIRO UMUM/BAGIAN UMUM SETKODYA/ITU
        <hr/>
      </td>
    </tr>
    <tr>
      <td style="width:3%">1.</td>
      <td style="width:47%">Dikerjakan Oleh: '.$rs->DIKERJAKAN.'</td>
      <td style="width:3%">1.</td>
      <td style="width:47%">Diterima di Pengendali Surat:</td>
    </tr>
    <tr>
      <td>2.</td>
      <td>Diperiksa Oleh: '.$rs->DIPERIKSA.'</td>
      <td>2.</td>
      <td>Dinomori Oleh: </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>3.</td>
      <td>Diketik Oleh:</td>
    </tr>
    <tr> 
      <td>3.</td>
      <td>Diedarkan Oleh: '.$rs->DIEDARKAN.'</td>
      <td>4.</td>
      <td>Ditaklik Oleh: </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>5.</td>
      <td>Diterima oleh Pengirim Surat: </td>
    </tr>
    <tr>
      <td>4.</td>
      <td>Net telah disetujui oleh: </td>
      <td>&nbsp; </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td style="colspan:1;rowspan:2">&nbsp;</td>
      <td style="white-space:nowrap">Pengonsep: '.$rs->DISETUJUI.'</td>
      <td>7.</td>
      <td>Perbal dan pertinggal disimpan oleh:</td>
    </tr>
  </tbody>
</table>
';
// if(is_null($dimajukan)):
$html .= '
<table style="width:100%;cellpadding:0;cellspacing:0;text-align:center">
  <tr>
    <td>
      <hr/>
    </td>
  </tr>
  <tr>
    <td>Dimajukan pada tanggal '.$dimajukan.'</td>
  </tr>
  <tr>
    <td>
      <hr/>
    </td>
  </tr>
</table>';
// endif;
// if(!is_null($dimajukan)):
// $html .= '<br/><hr/>';
// endif;
$html .= '
    <table style="width:100%;cellpadding:0;cellspacing:0">
  <tr>
    <td>Hal/Judul/Naskah Dinas:</td>
  </tr>
  <tr>
    <td>
      '.$rs->HAL.'
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </td>
  </tr>
</table>
<hr/>
<div>&nbsp;</div>
    <table style="width:100%;cellpadding:0;cellspacing:0">
  <tbody>
    <tr>
      <td style="width:18%">Nomor</td>
      <td style="width:2%:">:</td>
      <td style="width:40%">'.$rs->NO_PERBAL.'</td>
      <td style="width:40%">Jakarta, </td>
    </tr>
    <tr>
      <td>Sifat</td>
      <td>:</td>
      <td>'.$rs->SIFAT.'</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Lampiran</td>
      <td>: <p>&nbsp;</p><p>&nbsp;</p></td>
      <td>'.$rs->LAMPIRAN.'</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Pemaraf Serta</td>
      <td>: </td>
      <td>&nbsp;</td>
      <td>Tembusan :</td>
    </tr>
    <tr> 
      <td colspan="3">
        <ul>
';
                        foreach($pemaraf as $prm):
                           $html .= '<li type="square">'.$prm.'</li>';
                        endforeach;
    $html .= '                    
                        </ul>
                    </td>
                    <td>
                        <ol type="1">
                            <li style="text-align:justify; line-height:150%">Gubernur Provinsi DKI Jakarta</li>
                            <li style="text-align:justify; line-height:150%">Ka. Kanreg V BKN</li>
                            <li style="text-align:justify; line-height:150%">Sekda Provinsi DKI Jakarta</li>
                            <li style="text-align:justify; line-height:150%">Inspektur Provinsi DKI Jakarta</li>
                            <li style="text-align:justify; line-height:150%">Ka. BPKAD Provinsi DKI Jakarta</li>
                            <li style="text-align:justify; line-height:150%">Ka. Biro Umum Setda Provinsi DKI Jakarta</li>';
    if(!empty($tembusan[0])){
        $html .= '           <li style="text-align:justify; line-height:150%">Ka. Dinas '.ucwords(strtolower($tembusan[0])).' Provinsi DKI Jakarta</li>';
    }elseif(!empty($tembusan[1])){
        $html .= '          <li style="text-align:justify; line-height:150%">Dir '.ucwords(strtolower($tembusan[1])).' Prov. DKI Jakarta</li>';
    }elseif(!empty($tembusan[2])){
        $html .= '          <li style="text-align:justify; line-height:150%">Ka. Sudin '.ucwords(strtolower($tembusan[2])).' Kota Adm. Jkt</li>';
    }                                
    $html .= '
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
                        <p>a.n. GUBERNUR PROVINSI DAERAH KHUSUS<br/>IBUKOTA JAKARTA <br/> '.$jabatan_ditetapkan.'</p>
                        <br>
                        <p>'.$nama_ditetapkan.'<br/>NIP '.$nip_ditetapkan.'</p>
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
<br/><br/><br/>
';
echo $html;
/*//-----------------------------------------------------------------------
$this->pdf_isi_perbal->writeHTML($html, true, false, false, false, '');
ob_clean();

$this->pdf_isi_perbal->Output('perbal_naskah_dinas.pdf', 'I');
*/