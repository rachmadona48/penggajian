<?php
ob_start();

$this->pdf_report3->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE,'', PDF_HEADER_STRING);

// set header and footer fonts
$this->pdf_report3->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$this->pdf_report3->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// remove default header/footer
//$this->pdf_report3->setPrintHeader(false);
//$this->pdf_report3->setPrintFooter(false);

// set default monospaced font
$this->pdf_report3->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$this->pdf_report3->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT);
//$this->pdf->SetMargins(15, 15, 15);
$this->pdf_report3->SetHeaderMargin(PDF_MARGIN_HEADER);
$this->pdf_report3->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$this->pdf_report3->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$this->pdf_report3->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
require_once(dirname(__FILE__).'/lang/eng.php');
$pdf_report3->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$this->pdf_report3->SetFont('helvetica', 'B', 20);

// add a page
$this->pdf_report3->AddPage('P');

$this->pdf_report3->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$this->pdf_report3->SetFont('helvetica', '', 10);

// -----------------------------------------------------------------------------


$html ='
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>


<p align="center">
KEPUTUSAN GUBERNUR PROVINSI DAERAH KHUSUS<br />IBUKOTA JAKARTA<br /><br /> NOMOR $(123123) <br /><br />TENTANG<br /><br />
<table  width="100%" style="margin:-30px 2px 5px 3px; align:center; border-collapse: collapse;">
<tbody>
<tr>
<td width="15%"></td>
<td width="70%" align="center">PEMBEBASAN SEMENTARA PEGAWAI NEGERI SIPIL ATAS NAMA $nama_pegawai NIP/NRK
$nip/$nrk PANGKAT/GOLONGAN RUANG $pangkat/$golongan DARI JABATAN FUNGSIONAL $(NAMA DAN JENJANG JABATAN FUNGSIONAL) PADA $(NAMA SKPD)
PROVINSI DAERAH KHUSUS IBUKOTA JAKARTA</td>
<td width="15%"></td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td align="center">DENGAN RAHMAT TUHAN YANG MAHA ESA</td>
<td></td>
</tr>
<tr>
<td></td>
<td align="center">GUBERNUR PROVINSI DAERAH KHUSUS IBUKOTA JAKARTA,</td>
<td></td>
</tr>
</tbody>
</table>
</p>

<table border="0" width="100%">
	<tbody>
		<tr>
			<td valign="top" width="15%">Menimbang</td>
			<td valign="top" width="2%">:</td>
			<td valign="top" width="3%">a.</td>
			<td width="75%" align="justify">bahwa berdasarkan hasil penelitian administrasi dan Surat Kepala

Kantor Regional V Badan Kepegawaian Negara Nomor 0239/KRV.25/III/20105 Hal

Penjelasan Jabatan Fungsional, dan untuk kepentingan dinas perlu membebaskan

sementara Pegawai Negeri Sipil atas nama $nama_pegawai NIP/NRK

$nip/$nrk Pangkat/Golongan Ruang $pangkat/$golongan dari Jabatan Fungsional

$(Nama Jabatan Fungsional) pada $(Nama SKPD) Provinsi Daerah

Khusus Ibukota Jakarta;</td>
		</tr>

		<tr>
			<td></td><td></td><td></td><td></td>
		</tr>

		<tr>
			<td valign="top">&nbsp;</td>
			<td valign="top">&nbsp;</td>
			<td valign="top">b.</td>
			<td align="justify">bahwa sesuai ketentuan Pasal $pasal Keputusan Menteri Pendayagunaan

Aparatur Negara Nomor $nomor tentang Jabatan Fungsional $jabatan_fungsional dan Angka

Kreditnya dinyatakan bahwa $(Nama Jabatan) dibebaskan sementara dari

Jabatannya apabila dalam jangka waktu 5 (lima) tahun sejak diangkat dalam

pangkat terakhir tidak dapat mengumpulkan angka kredit untuk kenaikan

pangkat/jabatan setingkat lebih tinggi;</td>
		</tr>

		<tr>
			<td></td><td></td><td></td><td></td>
		</tr>

		<tr>
			<td valign="top">&nbsp;</td>
			<td valign="top">&nbsp;</td>
			<td valign="top">c.</td>
			<td align="justify">bahwa berdasarkan pertimbangan sebagaimana dimaksud dalam huruf a dan

huruf b, perlu menetapkan Keputusan Gubernur tentang Pembebasan Sementara

Pegawai Negeri Sipil atas nama $nama_pegawai NIP/NRK $nip/$nrk Pangkat/Golongan Ruang

$pangkat/$golongan dari Jabatan Fungsional $(Nama dan Jenjang Jabatan Fungsional)

pada $(Nama SKPD) Provinsi Daerah Khusus Ibukota Jakarta;</td>
		</tr>
	</tbody>
</table>


<br/><br/>

<table border="0" width="100%">
	<tbody>
		<tr>
			<td valign="top" width="15%">Mengingat</td>
			<td valign="top" width="2%">:</td>
			<td valign="top" width="3%">1.</td>
			<td width="75%" align="justify">Undang-Undang Nomor 29 Tahun 2007 tentang Pemerintahan Provinsi Daerah Khusus Ibukota Jakarta sebagai Ibukota Negara Kesatuan Republik Indonesia;</td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td valign="top">&nbsp;</td>
			<td valign="top">&nbsp;</td>
			<td valign="top">2.</td>
			<td align="justify">Undang-Undang Nomor 12 Tahun 2011 tentang Pembentukan Peraturan Perundang-undangan;</td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td valign="top">&nbsp;</td>
			<td valign="top">&nbsp;</td>
			<td valign="top">3.</td>
			<td align="justify">Undang-Undang Nomor 5 Tahun 2014 tentang Aparatur Sipil Negara;</td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td valign="top">&nbsp;</td>
			<td valign="top">&nbsp;</td>
			<td valign="top">4.</td>
			<td align="justify">Undang-Undang Nomor 23 Tahun 2014 tentang Pemerintahan Daerah sebagaimana telah beberapa kali diubah terakhir dengan Undang-Undang Nomor 9 Tahun 2015</td>
		</tr>
        <tr>
			<td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td valign="top">&nbsp;</td>
			<td valign="top">&nbsp;</td>
			<td valign="top">5.</td>
			<td align="justify">Peraturan Pemerintah Nomor 7 Tahun 1977 tentang Peraturan Gaji Pegawai Negeri Sipil sebagaimana telah beberapa kali diubah terakhir dengan Peraturan Pemerintah Nomor 30 Tahun 2015;</td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td valign="top">&nbsp;</td>
			<td valign="top">&nbsp;</td>
			<td valign="top">6.</td>
			<td align="justify">Peraturan Pemerintah Nomor 16 Tahun 1994 tentang Jabatan Fungsional Pegawai Negeri Sipil sebagaimana telah diubah dengan Peraturan Pemerintah Nomor 40 Tahun 2010;</td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td valign="top">&nbsp;</td>
			<td valign="top" align="justify">7.</td>
			<td align="justify">Peraturan Pemerintah Nomor 9 Tahun 2003 tentang Wewenang Pengangkatan, Pemindahan dan Pemberhentian Pegawai Negeri Sipil sebagaimana telah diubah dengan Peraturan Pemerintah Nomor 63 Tahun 2009;</td>
		</tr>

	</tbody>
</table>
';

$this->pdf_report3->writeHTML($html, true, false, false, false, '');
//$this->pdf_report3->AddPage();
//-----------------------------------------------------------------------
$html2='

<table border="0" width="100%">
	<tbody>
		<tr>
			<td valign="top" width="15%">&nbsp;</td>
			<td valign="top" width="2%">&nbsp;</td>
			<td valign="top" width="3%">8.</td>
			<td width="80%" align="justify">Peraturan Presiden tentang Tunjangan Jabatan Fungsional ..........................</td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td valign="top">&nbsp;</td>
			<td valign="top">&nbsp;</td>
			<td valign="top">9.</td>
			<td align="justify">Peraturan/Keputusan Menteri Pendayagunaan Aparatur Negara Nomor ....... tentang Jabatan Fungsional ............. (Jenis Jabatan Fungsional) dan Angka Kreditnya;</td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td valign="top">&nbsp;</td>
			<td valign="top">&nbsp;</td>
			<td valign="top">10.</td>
			<td align="justify">Peraturan Daerah Nomor 12 Tahun 2014 tentang Organisasi Perangkat Daerah;</td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td valign="top">&nbsp;</td>
			<td valign="top">&nbsp;</td>
			<td valign="top">11.</td>
			<td align="justify">Keputusan Gubernur Nomor 5 Tahun 2004 tentang Penetapan Jenis Jabatan Fungsional di lingkungan Pemerintah Propinsi DKI Jakarta;</td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td valign="top">&nbsp;</td>
			<td valign="top">&nbsp;</td>
			<td valign="top">12.</td>
			<td align="justify">Peraturan Gubernur/Keputusan Gubernur tentang Formasi Jabatan Fungsional &hellip;...............</td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td valign="top">&nbsp;</td>
			<td valign="top">&nbsp;</td>
			<td valign="top">13.</td>
			<td align="justify">Peraturan Gubernur Nomor 163 Tahun 2010 tentang Pendelegasian Wewenang Pengangkatan, Pemindahan dan Pemberhentian Pegawai Negeri Sipil;</td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td>
		</tr>
		<tr>
			<td valign="top">&nbsp;</td>
			<td valign="top">&nbsp;</td>
			<td valign="top">14.</td>
			<td align="justify">Peraturan Gubernur Nomor 222 Tahun 2014 tentang Organisasi dan Tata Kerja Badan Kepegawaian Daerah;</td>
		</tr>
	</tbody>
</table>

<p align="center">MEMUTUSKAN</p>
<table border="0" width="100%">
	<tbody>
	<tr>
		<td valign="top" width="15%">Menetapkan:</td>
		<td valign="top" width="2%">:</td>
		<td width="80%" align="justify">KEPUTUSAN GUBERNUR TENTANG PEMBEBASAN SEMENTARA PEGAWAI

NEGERI SIPIL ATAS NAMA $nama_pegawai NIP/NRK $nip/$nrk PANGKAT/GOLONGAN

RUANG $pangkat/$golongan DARI JABATAN FUNGSIONAL $(NAMA DAN JENJANG

JABATAN FUNGSIONAL) PADA $(NAMA SKPD) PROVINSI DAERAH

KHUSUS IBUKOTA JAKARTA.</td>
	</tr>

	<tr>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	
	<tr>
		<td valign="top">KESATU</td>
		<td valign="top">:</td>
		<td align="justify">Membebaskan Pegawai Negeri Sipil dari jabatan

fungsional $(Nama Jenis Jabatan Fungsional) dengan angka kredit sebesar

…….. (…………………….).<br /><br /> Nama : &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;<br /> NIP/NRK : ...................../,,,,,,,,,,,,<br /> Pangkat/Gol.Ruang : ..................................<br /> Unit Kerja : ..................................<br /> Instansi : ............ (Nama SKPD) Provinsi DKI Jakarta</td>
	</tr>

	<tr>
		<td></td>
		<td></td>
		<td></td>
	</tr>

	<tr>
		<td valign="top">KEDUA</td>
		<td valign="top">:</td>
		<td align="justify">Pembebasan sementara ini berlaku selama 1 (satu) tahun terhitung sejak tanggal di

tetapkan dan Pegawai Negeri Sipil sebagaimana di maksud pada diktum KESATU

dapat di angkat kembali dalam jabatan fungsional $(nama jabatan fungsional),

apabila dalam masa pembebasan sementara dapat mengumpulkan angka kredit

untuk kenaikan pangkat/jabatan setingkat lebih tinggi.</td>
	</tr>

	<tr>
		<td></td>
		<td></td>
		<td></td>
	</tr>

	<tr>
		<td valign="top">KETIGA</td>
		<td valign="top">:</td>
		<td align="justify">Kepada Pegawai Negeri Sipil sebagaimana dimaksud pada diktum KESATU

diberhentikan tunjangan jabatan fungsional $(Nama Jenis Jabatan Fungsional)

sesuai dengan ketentuan peraturan perundang-undangan.</td>
	</tr>
    
    <tr>
		<td></td>
		<td></td>
		<td></td>
	</tr>

	<tr>
		<td valign="top">KEEMPAT</td>
		<td valign="top">:</td>
		<td align="justify">Keputusan Gubernur ini mulai berlaku pada tanggal ditetapkan</td>
	</tr>
	</tbody>
</table>

<p></p>';



$html2.='

<p >
<font size="-2">
<table width="100%">
	<tbody>
		<tr>
			<td colspan="2">Tembusan:</td>

		</tr>
		<tr>
			<td width="2%">1.</td>
			<td width="40%">Kepala Kantor Regional V BKN di Jakarta</td>
		</tr>
		<tr>
			<td>2.</td>
			<td>Sekretaris Daerah Provinsi DKI Jakarta</td>
		</tr>
		<tr>
			<td>3.</td>
			<td>Inspektur Provinsi DKI Jakarta</td>
		</tr>
		<tr>
			<td>4.</td>
			<td>Kepala Badan Kepegawaian Daerah Provinsi DKI Jakarta</td>
		</tr>
		<tr>
			<td>5.</td>
			<td>Kepala Badan Pengelola Keuangan Daerah Provinsi DKI Jakarta</td>
		</tr>
		<tr>
			<td>6.</td>
			<td>Kepala ..... SKPD yang bersangkutan</td>
		</tr>
		<tr>
			<td>7.</td>
			<td>Kepala Biro Umum Setda Provinsi DKI Jakarta</td>
		</tr>
	</tbody>
</table>
</font>
</p>';
$this->pdf_report3->writeHTML($html2, true, false, false, false, '');
ob_clean();

$this->pdf_report3->Output('perbal_pembebesan_krn_angka_kredit.pdf', 'I');

?>
