<?php
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF CV');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------

$tbl = '<div class="ibox-title" style="background-color:#55aaff; color:white;">
              <h3>Data Diri</h3>
        </div>

        <table width="100%">
        	<tr>
            	<th id="tdata" style="width:100px"> Nama: </th>';
$tbl.=         '<td style="width:700px">'.$infoUser->NAMA_ABS.'</td>';
$tbl.=         '<td rowspan="7" align="center">';                     
$tbl.=          	$linkImg = "assets/img/photo/".$infoUser->NRK.'.jpg';
		               if(file_exists($linkImg)){
                          $img = base_url()."assets/img/photo/".$infoUser->NRK.'.jpg';                                    
		               }else{
                          $img = base_url()."assets/img/photo/profile_small.jpg";                                    
		               };         
$tbl.=         '<img alt="image" class="img-box m-t-xs img-responsive" src="$img" width="68px" height="68px" style="border-radius:10px;">
                </td>
            </tr>

            <tr>
            	<th id="tdata">NRK:</th>';
$tbl.=         '<td>'.$infoUser->NRK.'</td>';
$tbl.=      '</tr>
              
            <tr>
            	<th id="tdata">NIP18:</th>';
$tbl.=         '<td> '.$infoUser->NIP18.'</td>';
$tbl.=      '</tr>

            <tr>
            	<th id="tdata">TTL:</th>';
$tbl.=         '<td> '.$infoUser->PATHIR.', '.$infoUser->TALHIR.'</td>';
$tbl.=     '</tr>

            <tr>
            	<th id="tdata">Jabatan:</th>';
$tbl.=         '<td> '.$infoUser->NAJABL.'</td>';
$tbl.=     '</tr>

            <tr>
            	<th id="tdata">Lokasi:</th>';
$tbl.=            '<td> '.$infoUser->NALOKL.'</td>';
$tbl.=        '</tr>
              <tr>
                <th id="tdata">Alamat:</th>';
$tbl.=              '<td> '.$infoAlamat->ALAMAT.' RT '.$infoAlamat->RT.' RW '.$infoAlamat->RW.
                    ' Kel. '.$infoAlamat->NAKEL.' Kec. '.$infoAlamat->NACAM.' '.$infoAlamat->NAWIL.' - '.$infoAlamat->PROP.'</td>';
                
$tbl.=        '</tr>   
            </table>';
$pdf->writeHTML($tbl, true, false, false, false, '');



   
$tbl=      '<div class="ibox-title" style="background-color:#55aaff; color:white;">
              <h3>Riwayat Pendidikan Formal</h3>
           </div>
          
            <table border="1" width="100%">
              <tr>
                <th width="10px" id="tdata">No</th>
                <th id="tdata">Tg Ijazah</th>
                <th id="tdata">Nama Sekolah</th>
                <th id="tdata">Kota Sekolah</th>
              </tr>';
                
$tbl.=            $i=1;
                  foreach($infoPenForm as $row)
                  {;
$tbl.=                '<tr><td align="center">'.$i.'</td>';
$tbl.=                $tglijazah = date("d M Y", strtotime($row->TGIJAZAH));
$tbl.=                '<td align="center">'.$tglijazah.'</td>';
$tbl.=                '<td align="center">'.$row->NASEK.'</td>';
$tbl.=				  '<td align="center">'.$row->KOTSEK.'</td><tr/>';
$tbl.=                    $i++;
            	  };
$tbl.=            '</table>';
$pdf->writeHTML($tbl, true, false, false, false, '');

           

    
$tbl=   '<div class="ibox-title" style="background-color:#55aaff; color:white;">
              <h3>Riwayat Pendidikan Non Formal</h3>
        </div>
         
            <table border="1" width="100%">
              <tr>
                <th width="10px" id="tdata">No</th>
                <th id="tdata">Tg Ijazah</th>
                <th id="tdata">Nama Sekolah</th>
                <th id="tdata">Kota Sekolah</th>
              </tr>';

$tbl.=            $i=1;
                  foreach($infoPenNForm as $row)
                  {;
$tbl.=              '<tr><td align="center">'.$i.'</td>';
$tbl.=              $tglijazah = date('d M Y', strtotime($row->TGIJAZAH));
$tbl.=              '<td align="center">'.$tglijazah.'</td>';
$tbl.=              '<td align="center">'.$row->NASEK.'</td>';
$tbl.=              '<td align="center">'.$row->KOTSEK.'</td><tr/>';
$tbl.=              $i++;
	             }; 
$tbl.=            '</table>';
$pdf->writeHTML($tbl, true, false, false, false, '');

   
$tbl='          <div class="ibox-title" style="background-color:#55aaff; color:white;">
              <h3>Riwayat Jabatan Struktural</h3>
          </div>
       
         
                <table border="1" width="100%">
                  <tr>
                    <th width="10px" id="tdata">No</th>
                    <th id="tdata">TMT</th>
                    <th id="tdata">Jabatan</th>
                  </tr>';


$tbl.=            $i=1;
	              foreach($infoJabatanS as $row)
                  {
                    '<tr><td align="center">'.$i.'</td>';
$tbl.=              $tmt = date('d M Y', strtotime($row->TMT));
$tbl.=              '<td align="center">'.$tmt.'</td>';
$tbl.=              '<td align="center">'.$row->NAJABL.'</td><tr/>';
$tbl.=              $i++;
             	  };
                
$tbl.=          '</table>';
$pdf->writeHTML($tbl, true, false, false, false, '');

     
$tbl='          <div class="ibox-title" style="background-color:#55aaff; color:white;">
            <h3>Riwayat Jabatan Fungsional</h3>
          </div>
                <table border="1" width="100%">
                  <tr>
                    <th width="10px" id="tdata">No</th>
                    <th id="tdata">TMT</th>
                    <th id="tdata">Jabatan</th>
                  </tr>';
                
$tbl.=        	$i=1;
                  foreach($infoJabatanF as $row)
                  {
                    '<tr><td align="center">'.$i.'</td>';
$tbl.=              $tmt = date('d M Y', strtotime($row->TMT));
$tbl.=              '<td align="center">'.$tmt.'</td>';
$tbl.=              '<td align="center">'.$row->NAJABL.'</td><tr/>';
$tbl.=              $i++;
	              };
                 
$tbl.=          '</table>';
$pdf->writeHTML($tbl, true, false, false, false, '');


   
$tbl='          <div class="ibox-title" style="background-color:#55aaff; color:white;">
            <h3>Riwayat Organisasi</h3>
          </div>
       
          
                <table border="1" width="100%">
                  <tr>
                    <th width="10px" id="tdata">No</th>
                    <th id="tdata">Nama Organisasi</th>
                    <th id="tdata">Posisi</th>
                    <th id="tdata">Dari</th>
                    <th id="tdata">Sampai</th>
                  </tr>';

$tbl.=            $i=1;
	              foreach($infoOrgan as $row)
                  {;
$tbl.=              '<tr><td align="center">'.$i.'</td>';
$tbl.=              '<td align="center">'.$row->NAORGANI.'</td>';
$tbl.=              '<td align="center">'.$row->KETERANGAN.'</td>';
$tbl.=              $dari = date("d M Y", strtotime($row->DARI));
$tbl.=              '<td align="center">'.$dari.'</td>';
	                if($row->SAMPAI  == "-")
                    {;
$tbl.=					'<td align="center"> - </td><tr/>';
	                }
                    else
                    {
                      $sampai = date("d M Y", strtotime($row->SAMPAI));
$tbl.=                  '<td align="center">'.$sampai.'</td><tr/>';
	                }
                    $i++;
	              }
                
$tbl.=              '</table>';
$pdf->writeHTML($tbl, true, false, false, false, '');   


$tbl=     '<div class="ibox-title" style="background-color:#55aaff; color:white;">
              <h3>Riwayat Penghargaan</h3>
          </div>
      
              <table border="1" width="100%">
                <tr>
                  <th width="10px" id="tdata">No</th>
                  <th id="tdata">No SK</th>
                  <th id="tdata">Nama Penghargaan</th>
                  <th id="tdata">Asal Penghargaan</th>
                </tr>';

$tbl.=	       $i=1;
	           foreach($infoHargaan as $row)
                  {
                    '<tr><td align="center">'.$i.'</td>';
$tbl.=              '<td>'.$row->NOSK.'</td>';
$tbl.=              '<td align="center">'.$row->NAHARGA.'</td>';
$tbl.=				'<td align="center">'.$row->ASAL_HRG.'</td><tr/>';
                    $i++;
                  };
                
$tbl.=		'</table>';
$pdf->writeHTML($tbl, true, false, false, false, '');
    

  
$tbl = '  <div class="ibox-title" style="background-color:#55aaff; color:white;">
            <h3>Riwayat Pangkat</h3>
          </div>
       
         
                <table border="1" width="100%">
                  <tr>
                    <th width="10px" id="tdata">No</th>
                    <th id="tdata">TMT</th>
                    <th id="tdata">No. SK</th>
                    <th id="tdata">Tg. SK</th>
                    <th id="tdata">Pangkat</th>
                    <th id="tdata">Golongan</th>
                  </tr>'.

                  $i=1;
                  foreach($infoPangkat as $row)
                  {
$tbl.=              '<tr><td align="center">'.$i.'</td>';
                    $tmt = date('d M Y', strtotime($row->TMT));
$tbl.=				'<td align="center">'.$tmt.'</td>';
$tbl.=				'<td align="center">'.$row->NOSK.'</td>';
                    $tgsk = date("d M Y", strtotime($row->TGSK));
$tbl.=				'<td align="center">'.$tgsk.'</td>';
$tbl.=				'<td align="center">'.$row->NAPANG.'</td>';
$tbl.=				'<td align="center">'.$row->GOL.'</td><tr/>';
                    $i++;
                  };
                
$tbl.=			'</table>';
$pdf->writeHTML($tbl, true, false, false, false, '');

    
$tbl='      <div class="ibox-title" style="background-color:#55aaff; color:white;">
              <h3>Keluarga</h3>
          </div>

                <table border="1" width="100%">
                  <tr>
                    <th width="10px" id="tdata">No</th>
                    <th id="tdata">Hubungan</th>
                    <th id="tdata">Nama</th>
                    <th id="tdata">TTL</th>
                    <th id="tdata">Jenis Kelamin</th>
                    <th id="tdata">Tunjangan</th>
                    <th id="tdata">Pekerjaan</th>
                  </tr>'.

                
                  $i=1;
                  foreach($infoHubkel as $row)
                  {
$tbl.=				'<tr><td align="center">'.$i.'</td>';
$tbl.=				'<td align="center">'.$row->NAHUBKEL.'</td>';
$tbl.=				'<td align="center">'.$row->NAMA.'</td>';
                    $talhir = date("d M Y", strtotime($row->TALHIR));
$tbl.=				'<td align="center">'.$row->TEMHIR.', '.$talhir.'</td>';
$tbl.=				'<td align="center">'.($row->JENKEL == "P" ? "Perempuan" : "Laki-laki").'</td>';
$tbl.=				'<td align="center">'.$row->TUNJANGAN.'</td>';
$tbl.=				'<td align="center">'.$row->KERJAAN.'</td></tr>';
                    $i++;
                  };
                
$tbl.=			'</table>

';

$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->Output('cv.pdf', 'I');
?>