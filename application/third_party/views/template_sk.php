<?php
ob_start();

$this->pdf_sk->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE,'', PDF_HEADER_STRING);

// set header and footer fonts
$this->pdf_sk->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$this->pdf_sk->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// remove default header/footer
//$this->pdf_sk->setPrintHeader(false);
//$this->pdf_sk->setPrintFooter(false);

// set default monospaced font
$this->pdf_sk->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$this->pdf_sk->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT);
//$this->pdf->SetMargins(15, 15, 15);
$this->pdf_sk->SetHeaderMargin(PDF_MARGIN_HEADER);
$this->pdf_sk->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$this->pdf_sk->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$this->pdf_sk->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf_sk->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$this->pdf_sk->SetFont('helvetica', 'B', 20);

// add a page
$this->pdf_sk->AddPage('P');

$this->pdf_sk->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$this->pdf_sk->SetFont('helvetica', '', 9);

// -----------------------------------------------------------------------------
$sk_tipe = ['yang diangkat','yang diangkat pertama kali','yang diinpasing/disesuaikan'];
$html = '
<table style="width:100%" border="0">
  <tbody>
    <tr>
      <td width="70%">&nbsp;</td>
      <td width="30%">
        Lampiran: Keputusan 
        Gubernur Provinsi Daerah Khusus Ibukota Jakarta<br/><br/>
        Nomor: '.$sk->NO_SURAT.'<br/>
        Tanggal: '.date('d-m-Y').'<br/><br/>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <div style="text-align: center; text-transform: uppercase;">daftar nama pegawai negeri sipil di lingkungan '.$sk_tembusan[0]->NALOK.' provinsi dki jakarta</div>
        <div style="text-align: center; text-transform: uppercase;">'.$sk_tipe[$tipeSK].' dalam jabatan fungsional '.$detail_sk[0]->NAJABL.'</div><br/>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <table border="1" style="border-collapse:collapse" width="100%">
          <thead>
            <tr>
              <th align="center" width="3%">NO</th>
              <th align="center" width="15%">NAMA</th>
              <th align="center" width="8%">TANGGAL LAHIR</th>
              <th align="center" width="10%">NIP/NRK</th>
              <th align="center" width="11%">PANGKAT<br/>/GOL RUANG</th>
              <th align="center" width="10%">PENDIDIKAN</th>
              <th align="center" width="10%">JABATAN LAMA</th>
              <th align="center" width="10%">JABATAN BARU</th>
              <th align="center" width="7%">ANGKA KREDIT</th>
              <th align="center" width="15%">KETERANGAN</th>
            </tr>
          </thead>
          <tbody>';
            $x = 0;
            foreach($detail_sk as $values):
                $html .= '<tr>
                            <td>'.($x+1).'</td>
                            <td>'.$values->NAMA.'</td>
                            <td>'.$values->TALHIR.'</td>
                            <td>'.$values->NIP18.' ('.$values->NRK.')</td>
                            <td>'.$values->NAPANG.' /<br/> '.$values->GOL.'</td>
                            <td>'.$values->NADIK.'</td>';
                if($values->ANGKA_KREDIT_LAMA){
                  $html .=  '<td>'.$values->JABATAN_LAMA.', dengan angka kredit sebesar '.$values->ANGKA_KREDIT_LAMA.'</td>';
                }else{
                  $html .=  '<td>'.$values->JABATAN_LAMA.', dengan angka kredit sebesar 0</td>';
                }
                  $html .=  '<td>'.$values->NAJABL.'</td>
                            <td>'.(is_null($values->ANGKA_KREDIT) ? 0 : $values->ANGKA_KREDIT) .'</td>
                            <td>&nbsp;</td>
                        </tr>';
            endforeach;
          $html .= '</tbody>
        </table><br/><br/>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
        <div style="text-align:center">A.N GUBERNUR PROVINSI DAERAH KHUSUS<br/>
        IBUKOTA JAKARTA<br/>
        PEJABAT YANG DIBERI KEWENANGAN<br/><br/><br/><br/><br/><br/>
        NAMA ........<br/>
        NIP ........
        </div>
      </td>
    </tr>
  </tbody>
</table>';
$this->pdf_sk->writeHTML($html, true, false, false, false, '');
ob_clean();

$this->pdf_sk->Output('sk_kolektif_pertama_kali.pdf', 'I');
