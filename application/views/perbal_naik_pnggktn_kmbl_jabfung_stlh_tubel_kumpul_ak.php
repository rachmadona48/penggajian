<?php
/*ob_start();

$this->pdf_isi_perbal->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE,'', PDF_HEADER_STRING);

// set header and footer fonts
$this->pdf_isi_perbal->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$this->pdf_isi_perbal->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// remove default header/footer
//$this->pdf_isi_perbal->setPrintHeader(false);
//$this->pdf_isi_perbal->setPrintFooter(false);

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
$this->pdf_isi_perbal->AddPage('P');

$this->pdf_isi_perbal->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$this->pdf_isi_perbal->SetFont('helvetica', '', 10);
*/
$html = '
<p style="text-align:center">DENGAN RAHMAT TUHAN YANG MAHA ESA <br/>GUBERNUR PROVINSI DAERAH KHUSUS IBUKOTA JAKARTA<br/></p>
<table>
  <tr>
    <td style="width:12%">Menimbang</td>
    <td style="width:3%;text-align:center">:</td>
    <td style="width:75%">
      <ol type="a">
        <li style="text-align:justify; line-height:150%">bahwa berdasarkan hasil penelitian administrasi, Pegawai Negeri Sipil atas nama '.$nama.', NIP/NRK '.$nip.'/'.$nrk.' Pangkat/Golongan Ruang '.$napang.'/'.$gol.', telah memenuhi syarat untuk diangkat kembali dalam Jabatan Fungsional '.$najabl.' pada '.$skpd.' Provinsi Daerah Khusus Ibukota Jakarta;</li>
        <li style="text-align:justify; line-height:150%">bahwa sesuai ketentuan Pasal 7 Peraturan Pemerintah Nomor 16 Tahun 1994 tentang Jabatan Fungsional Pegawai Negeri Sipil sebagaimana telah diubah dengan Peraturan Pemerintah Nomor 40 Tahun 2010, pengangkatan Pegawai Negeri Sipil ke dalam jabatan fungsional pada instansi pemerintah ditetapkan oleh pejabat yang berwenang sesuai formasi yang telah ditetapkan;</li>
        <li style="text-align:justify; line-height:150%">bahwa berdasarkan pertimbangan sebagaimana dimaksud dalam huruf a dan huruf b, perlu menetapkan Keputusan Gubernur tentang Pengangkatan Kembali Pegawai Negeri Sipil atas nama '.$nama.', NIP/NRK '.$nip.'/'.$nrk.' dalam Jabatan Fungsional '.$najabl.' dan '.$nm_tingkat.' pada '.$skpd.' Provinsi Daerah Khusus Ibukota Jakarta.</li>
      </ol>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Mengingat </td>
    <td>:</td>
    <td>
      <ol type="1">
        <li style="text-align:justify; line-height:150%">Undang-Undang Nomor 29 Tahun 2007 tentang Pemerintahan Provinsi Daerah Khusus Ibukota Jakarta sebagai Ibukota Negara Kesatuan Republik Indonesia;</li>
        <li style="text-align:justify; line-height:150%">Undang-Undang Nomor 12 Tahun 2011 tentang Pembentukan Peraturan Perundang-undangan;</li>
        <li style="text-align:justify; line-height:150%">Undang-Undana Nomor 5 Tahun 2014 tentang Aparatur Sipil Negara;</li>
        <li style="text-align:justify; line-height:150%">Undang-Undang Nomor 23 Tahun 2014 tentang Pemerintahan Daerah sebagaimana telah beberapa kali diubah terakhir dengan Undang-Undang Nomor 9 Tahun 2015;</li>
        <li style="text-align:justify; line-height:150%">Peraturan Pemerintah Nomor 7 Tahun 1977 tentang Peraturan Gaji Pegawai Negeri Sipil sebagaimana telah beberapa kali diubah terakhir dengan Peraturan Pemerintah Nomor 30 Tahun 2015;</li>
        <li style="text-align:justify; line-height:150%">Peraturan Pemerintah Nomor 16 Tahun 1994 tentang Jabatan Fungsional Pegawai Negeri Sipil sebagaimana telah diubah dengan Peraturan Pemerintah Nomor 40 Tahun 2010;</li>
        <li style="text-align:justify; line-height:150%">Peraturan Pemerintah Nomor 9 Tahun 2003 tentang Wewenang Pengangkatan, Pemindahan dan Pemberhentian Pegawai Negeri Sipil sebagaimana telah diubah dengan Peraturan Pemerintah Nomor 63 Tahun 2009;</li>
        <li style="text-align:justify; line-height:150%">Peraturan Presiden Nomor '.$dasar_hukum1.' tentang Tunjangan Jabatan Fungsional '.$najabl.';</li>
        <li style="text-align:justify; line-height:150%">Peraturan/Keputusan Menteri Pendayagunaan Aparatur Negara Nomor '.$dasar_hukum2[0].' Tahun '.$dasar_hukum2[1].' tentang Jabatan Fungsional '.$najabl.' dan Angka Kreditnya;</li>
        <li style="text-align:justify; line-height:150%">Peraturan Daerah Nomor 12 Tahun 2014 tentang Organisasi Perangkat Daerah;</li>
        <li style="text-align:justify; line-height:150%">Keputusan Gubernur Nomor 5 Tahun 2004 tentang Penetapan Jenis Jabatan Fungsional di lingkungan Pemerintah Propinsi Daerah Khusus Ibukota Jakarta;</li>';
        if(isset($dasar_hukum3[0]) && isset($dasar_hukum3[1])){
          $html .= '<li style="text-align:justify; line-height:150%">Peraturan Gubernur/Keputusan Gubernur Nomor '.$dasar_hukum3[0].' Tahun '.$dasar_hukum3[1].' tentang Formasi Jabatan Fungsional '.$najabl.'</li>';  
        }else{
          $html .= '<li style="text-align:justify; line-height:150%">Peraturan Gubernur/Keputusan Gubernur Nomor - Tahun - tentang Formasi Jabatan Fungsional '.$najabl.'</li>';
        }
        $html .= '<li style="text-align:justify; line-height:150%">Peraturan Gubernur Nomor 163 Tahun 2010 tentang Pendelegasian Wewenang Pengangkatan, Pemindahan dan Pemberhentian Pegawai Negeri Sipil;</li>
        <li style="text-align:justify; line-height:150%">Peraturan Gubernur Nomor 222 Tahun 2014 tentang Organisasi dan Tata Kerja Badan Kepegawaian Daerah sebagaimana telah diubah dengan Peraturan Gubernur Nomor 117 Tahun 2016</li>
      </ol>
    </td>
  </tr>
</table>
<p style="text-align:center">MEMUTUSKAN :</p>
<table>
  <tr>
    <td style="width:12%">Menetapkan </td>
    <td style="width:3%;text-align:center">:</td>
    <td style="width:75%;line-height:150%">KEPUTUSAN GUBERNUR TENTANG PENGANGKATAN KEMBALI PEGAWAI NEGERI SIPIL ATAS NAMA '.$nama.' NIP/NRK '.$nip.'/'.$nrk.' PANGKAT/GOLONGAN RUANG '.$napang.'/'.$gol.' DALAM JABATAN FUNGSIONAL '.$najabl.' PADA '.$skpd.' PROVINSI DAERAH KHUSUS IBUKOTA JAKARTA.</td>
  </tr>
  <tr>
    <td>KESATU</td>
    <td>:</td>
    <td style="line-height:150%">Mengangkat kembali Pegawai Negeri Sipil dalam jabatan fungsional '.$najabl.' dan '.$nm_tingkat.', dengan angka kredit sebesar '.$angka_kredit.' ('.$angka_kredit_words.').<br/><br/>
      <table style="line-height:150%">
        <tr>
          <td style="width:26%">Nama</td>
          <td style="width:7%;text-align:center">:</td>
          <td style="width:67%">'.$nama.'</td>
        </tr>
        <tr>
          <td style="width:26%">NIP/NRK</td>
          <td style="width:7%;text-align:center">:</td>
          <td style="width:67%">'.$nip.'/'.$nrk.'</td>
        </tr>
        <tr>
          <td style="width:26%">Pangkat/Gol.Ruang</td>
          <td style="width:7%;text-align:center">:</td>
          <td style="width:67%">'.$napang.'/'.$gol.'</td>
        </tr>
        <tr>
          <td style="width:26%">Unit Kerja</td>
          <td style="width:7%;text-align:center">:</td>
          <td style="width:67%">'.$unit_kerja.'</td>
        </tr>
        <tr>
          <td style="width:26%">Instansi</td>
          <td style="width:7%;text-align:center">:</td>
          <td style="width:67%">'.$skpd.' Provinsi DKI Jakarta</td>
        </tr>
      </table><br/><br/>
    </td>
  </tr>
  <tr>
    <td>KEDUA</td>
    <td>:</td>
    <td style="line-height:150%">Kepada Pegawai Negeri Sipil sebagaimana dimaksud pada diktum KESATU diberikan tunjangan jabatan fungsional ('.$najabl.'/'.$nm_tingkat.') sesuai dengan ketentuan peraturan perundang-undangan.</td>
  </tr>
  <tr>
    <td>KETIGA</td>
    <td>:</td>
    <td style="line-height:150%">Keputusan Gubernur ini mulai berlaku pada tanggal ditetapkan.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
';
echo $html;
/*$this->pdf_isi_perbal->writeHTML($html, true, false, false, false, '');
ob_clean();

$this->pdf_isi_perbal->Output('perbal_naik_jenjang_jabfung_kolektif.pdf', 'I');*/