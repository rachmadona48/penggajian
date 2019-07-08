<?php if($user_group == 1) { ?>
<style>
#tdata th:nth-child(0),th:nth-child(1), th:nth-child(2), th:nth-child(3),th:nth-child(4),th:nth-child(5),th:nth-child(6),th:nth-child(7)
{
  text-align:center !important;
}

a.btn-danger.dim {
  box-shadow: inset 0px 0px 0px #ea394c, 0px 5px 0px 0px #ea394c, 0px 10px 5px #999999;
}



[data-tooltip] {
    display: inline-block;
    position: relative;
 }
/* Tooltip styling */
[data-tooltip]:before {
    content: attr(data-tooltip);
    display: none;
    position: absolute;
    background: #000;
    color: #fff;
    padding: 4px 8px;
    font-size: 14px;
    line-height: 1.4;
    min-width: 100px;
    text-align: center;
    border-radius: 4px;
}
[data-tooltip-position="bottom"]:before {
    left: 50%;
    -ms-transform: translateX(-50%);
    -moz-transform: translateX(-50%);
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
}

[data-tooltip-position="bottom"]:before {
    top: 100%;
    margin-top: 6px;
}

/* Tooltip arrow styling/placement */
[data-tooltip]:after {
    content: '';
    display: none;
    position: absolute;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
}
/* Dynamic horizontal centering for the tooltip */
[data-tooltip-position="bottom"]:after {
    left: 50%;
    margin-left: -6px;
}
/* Dynamic vertical centering for the tooltip */

[data-tooltip-position="bottom"]:after {
    top: 100%;
    border-width: 0 6px 6px;
    border-bottom-color: #000;
}

/* Show the tooltip when hovering */
[data-tooltip]:hover:before,
[data-tooltip]:hover:after {
    display: block;
    z-index: 30;
}

.select2-container {
    box-sizing: border-box;
    display: inline-block;
    margin: 0;
    position: absolute;
    vertical-align: middle;
    z-index: 9999999 !important;
}



</style>
 <link href="<?php echo base_url(); ?>assets/inspinia/css/bootstrap.min.css" rel="stylesheet">
 <link href="<?php echo base_url(); ?>assets/inspinia/css/animate.css" rel="stylesheet">
 <link href="<?php echo base_url(); ?>assets/inspinia/css/style.css" rel="stylesheet">
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Profile</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>index.php">Home</a>
            </li>
            <li class="active">
                <strong>Profile</strong>
            </li>
        </ol>
         <small><i>(Menu untuk menampilkan profil dan riwayat pegawai)</i></small>
    </div>
    <div class="col-lg-2">
   &nbsp;
    </div>
</div>
          <div class="wrapper wrapper-content animated fadeInDown">
            <div class="ibox float-e-margins" style="margin-top: 10px">
              <div class="ibox-content">
                <div class="row">
                  <div class="col-md-12">
                

                      <span class="pull-right">
                        <!-- <a href="<?php //echo base_url(); ?>index.php/profile/toPdf" target="_blank" class="btn btn-outline btn-danger dim">
                          <i class="fa fa-save"></i> PDF
                        </a> -->
                         <button class="btn btn-outline btn-warning " onclick="onclickbutton()"><i class="fa fa-edit"></i> Ubah Data Profil</button>
                        <a href="<?php echo base_url(); ?>index.php/profile/drh" target="_blank" class="btn btn-outline btn-danger dim">
                          <i class="fa fa-save"></i> PDF
                        </a>
                      </span>

                        <?php 
                        // var_dump($infoUser);exit;
                        if(isset($infoUser->NRK))
                        {
                            $linkImg = "assets/img/photo/".$infoUser->NRK.".jpg";

                            $nrk = $infoUser->NRK;    
                            $nip18 = $infoUser->NIP18;
                            $titel = $infoUser->TITEL;
                            $titeldepan = $infoUser->TITELDEPAN;
                            $pathir = $infoUser->PATHIR;
                            $talhir = $infoUser->TLHR;
                            $nama = $infoUser->NAMA_ABS;
                            $name=trim($nama,'');
                            $stapeg = $infoUser->STATUS_PEGAWAI;
                            $najabl = $infoUser->NAJABL;
                            $_SESSION['logged_in']['najabl'] = $najabl;
                            $_SESSION['logged_in']['kojab'] = $infoUser->KOJAB;
                            $nalokl = $infoUser->NALOKL;
                            $naklogad = $infoUser->NAKLOGAD;
                            $kd = $infoUser->KD;
                            $gol = $infoUser->GOL;
                            $napang =$infoUser->NAPANG;

                            if($kd == 'S')
                            {
                                if($infoUser->NESELON2 == "NON ESELON")
                                {
                                    $eselon = "NON ESELON";
                                }
                                else
                                {
                                    $eselon = "ESELON ".$infoUser->NESELON2;
                                }
                                
                            }
                            else
                            {
                                $eselon = "NON ESELON";
                            }

                            $img_small="";                  
                            if(file_exists($linkImg)){
                              $img = base_url()."assets/img/photo/".$infoUser->NRK.".jpg";      
                              $img_small = base_url()."assets/img/photo/".$infoUser->NRK."_thumb.jpg";                              
                            }else{
                              $img = base_url()."assets/img/photo/profile_small.jpg";
                              $img_small = base_url()."assets/img/photo/profile_getProfile.jpg";
                            }
                        }
                        $notelp="";$nohp="";$email="";$alamat="";$rt="";$rw="";$nawil="";$nacam="";$nakel="";$prop="";$email="";
                        if(isset($infoUser3->NRK))
                        {
                            $nohp=$infoUser3->NOHP;
                            $notelp=$infoUser3->NOTELP;
                            $alamat=$infoUser3->ALAMAT;
                            $rt=$infoUser3->RT;
                            $rw=$infoUser3->RW;
                            $nawil=$infoUser3->NAWIL;
                            $nacam=$infoUser3->NACAM;
                            $nakel=$infoUser3->NAKEL;
                            $prop=$infoUser3->PROPINSI;
                            $email=$infoUser3->EMAIL;
                        }
                         ?>

                        <div class="profile-image">
                            <a href="<?php echo $img; ?>" data-gallery="">
                              <img src="<?php echo $img_small;  ?>" class="img-circle circle-border m-b-md" alt="profile">
                            </a>    
                            <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
                            <div id="blueimp-gallery" class="blueimp-gallery">
                                <div class="slides"></div>
                                <h3 class="title"></h3>
                                <a class="prev">‹</a>
                                <a class="next">›</a>
                                <a class="close">×</a>
                                <a class="play-pause"></a>
                                <ol class="indicator"></ol>
                            </div>  
                        </div>
                        <div class="profile-info">
                            <div class="">
                                <div>
                                    <h3 class="no-margins">
                                      <?php 
                                      if($titel == null && $titeldepan == null)
                                      {
                                        echo "<td style='width:700px'>".$name."</td>";
                                      }
                                      else if($titel == null && $titeldepan != null)
                                      {
                                        echo "<td style='width:700px'>".$titeldepan.' '.$name."</td>";
                                      }
                                      else if($titel !=null && $titeldepan == null)
                                      {
                                      	if(substr($titel,0,1)==',')
                                      	{
                                      		echo "<td style='width:700px'>".$name.$titel."</td>";
                                      	}
                                      	else
                                      	{
                                      		echo "<td style='width:700px'>".$name.', '.$titel."</td>";
                                      	}
                                        
                                      }
                                      else
                                      {
                                      	if(substr($titel,0,1)==',')
                                      	{
                                      		echo "<td style='width:700px'>".$titeldepan.' '.$name.$titel."</td>";
                                      	}
                                      	else
                                      	{
                                      		//echo "<td style='width:700px'>".$name.', '.$titel."</td>";
                                      		echo "<td style='width:700px'>".$titeldepan.' '.$name.', '.$titel."</td>";
                                      	}
                                        //echo "<td style='width:700px'>".$titeldepan.' '.$name.$titel."</td>";
                                      }
                                      ?>
                                    </h3>
                                    <br/>
                                    <div class="col-md-6">
                                      <address style="font-size:11px;">
                                      	<span data-tooltip="NRK - NIP" data-tooltip-position="bottom">
											                     <p><i class="fa fa-credit-card"></i>&nbsp; <?php echo "<strong><span class=\"text-success\"> $nrk - $nip18 </span></strong>"; ?></p>
                  									  	</span>
                  									  	<br/>

                                      	<span data-tooltip="Tempat Tanggal Lahir" data-tooltip-position="bottom">
                                      		<p> <i class="fa fa-birthday-cake"></i> &nbsp; <?php echo "<strong><span class=\"text-danger\">$pathir, $talhir </span></strong>"; ?></p>
                                      	</span>
                                      	<br/>
                                      
                                      	<!-- <span data-tooltip="Status Pegawai" data-tooltip-position="bottom">
                                      		<p><i class="fa fa-ioxhost"></i>&nbsp; <?php echo "<strong><span class=\"text-primary\">$stapeg </span></strong>"; ?></p>
                                      	</span>
                                      	<br/> -->

                                        <span data-tooltip="Status Pegawai / Kode Jabatan / Eselon / Pangkat (Gol)" data-tooltip-position="bottom">
                                        <p><i class="fa fa-ioxhost"></i>&nbsp; <?php echo "<strong><span class=\"text-primary\">$stapeg / $kd / $eselon / $napang ($gol) </span></strong>"; ?></p>
                                        </span>
                                        <br/>

                                      	<span data-tooltip="Lokasi Kerja" data-tooltip-position="bottom">
                                      		<p><i class="fa fa-map-marker"></i>&nbsp; <?php echo "<strong><span class=\"text-info\">$nalokl</span></strong>"; ?></p>
                                      	</span>
                                      	<br/>

                                      	<span data-tooltip="Jabatan" data-tooltip-position="bottom">
                                       		<p><i class="fa fa-line-chart"></i>&nbsp; <?php echo "<strong><span class=\"text-warning\">$najabl</span></strong>"; ?></p>
                                       	</span>
                                      	<br/>

                                      	<span data-tooltip="Lokasi Gaji" data-tooltip-position="bottom">
		                                   <p><i class="fa fa-money"></i>&nbsp; <?php echo "<strong><span class=\"text-navy\">$naklogad</span></strong>"; ?></p>
		                                </span>
		                                <br/>
                                      </address>
                                    </div>
                                    <div class="col-md-6">

                                      <address style="font-size:10px;">
                                      <br/>

                                      	<span data-tooltip="No. Telp" data-tooltip-position="bottom">
                                      		<p><i class="fa fa-phone"></i>&nbsp; <?php echo "<strong><span class=\"text-success\">$notelp</span></strong>"; ?></p>
                                      	</span><br/>

                                      	<span data-tooltip="No. Ponsel" data-tooltip-position="bottom">
                                      		<p><i class="fa fa-mobile"></i>&nbsp; <?php echo "<strong><span class=\"text-danger\">$nohp</span></strong>"; ?></p> 
										</span><br/>                                     

										<span data-tooltip="Email" data-tooltip-position="bottom"> 
                                      		<p><i class="fa fa-at"></i>&nbsp; <?php echo "<strong><span class=\"text-primary\">$email </span></strong>"; ?></p>
                                      	</span><br/>

                                      <?php if($alamat=="" && $rt=="" && $rw=="" && $nacam=="" && $nakel=="" && $nawil=="" && $prop=="")
                                      { ?>
                                      		<p><i class="fa fa-home"></i>&nbsp; </p>
                                      <?php }
                                      else
                                      { ?>
                                      		<span data-tooltip="Alamat Domisili" data-tooltip-position="bottom"> 
                                      		<p><i class="fa fa-home"></i>&nbsp; <?php echo "<strong><span class=\"text-info\">".$alamat." RT-".$rt." RW-".$rw."<br/> &nbsp;&nbsp;&nbsp;&nbsp; KECAMATAN ".$nacam." KELURAHAN ".$nakel."<br/> &nbsp;&nbsp;&nbsp;&nbsp; ".$nawil." - ".$prop."</span></strong>"; ?></p>
                                      		</span><br/>
                                      <?php } ?>
                                      
                                      <p>&nbsp;</p>
                                    </address>   
                                    </div>  
                                </div>
                            </div>
                        </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
                



<div class="wrapper wrapper-content animated fadeInRight">
<?php if($infoJabatanS != null){ ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="background-color:#1AB394">
                <h5 style="color:#ffffff">Jabatan Struktural</h5>
                  <div class="ibox-tools">
                      <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                      </a>
                  </div>
            </div>
            <div class="ibox-content">
               <table class="table table-hover table-striped table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th width="15px">No</th><th>TMT</th><th>Lokasi</th><th>Jabatan</th><th>Pangkat (Gol)</th><th>ESELON</th><th>No. SK</th> <th>Tg. SK</th>
                    </tr>
                  </thead>
                  <tbody>
                            <?php
                              $i=1;
                              foreach($infoJabatanS as $row)
                              {
                                echo "<tr><td>".$i."</td>";
                                $tmt = date('d-m-Y', strtotime($row->TMT));
                                echo "<td>".$tmt."</td>";
                                echo "<td>".$row->NALOKL."</td>";
                                echo "<td>".$row->NAJABL."</td>";
                                echo "<td>".$row->NAPANG." (".$row->GOL.")</td>";
                                echo "<td align='center'>".$row->ESELON."</td>";
                                echo "<td>".$row->NOSK."</td>";
                                $tgsk = date('d-m-Y', strtotime($row->TGSK));
                                echo "<td>".$tgsk."</td><tr/>";
                                $i++;
                              }
                            ?>
                  </tbody>
                </table>
            </div> <!-- akhir div ibox content-->
        </div> <!-- akhir div ibox float e-margins -->

      </div> <!-- akhir div col lg 6 -->
    </div><!-- akhir div row -->
<?php }?>

<?php if($infoJabatanF != null){ ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="background-color:#1AB394">
                <h5 style="color:#ffffff">Jabatan Fungsional</h5>
                  <div class="ibox-tools">
                      <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                      </a>
                  </div>
            </div>
            <div class="ibox-content">
               <table class="table table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th width="15px">No</th><th>TMT</th><th>Lokasi</th><th>Jabatan</th><th>Pangkat (Gol)</th><th>No. SK</th> <th>Tg. SK</th>
                    </tr>
                  </thead>
                  <tbody>
                            <?php
                              $i=1;
                              foreach($infoJabatanF as $row)
                              {
                                echo "<tr><td align='center'>".$i."</td>";
                                $tmt = date('d-m-Y', strtotime($row->TMT));
                                echo "<td>".$tmt."</td>";
                                echo "<td>".$row->NALOKL."</td>";
                                echo "<td>".$row->NAJABL."</td>";
                                echo "<td>".$row->NAPANG." (".$row->GOL.")</td>";
                                echo "<td>".$row->NOSK."</td>";
                                $tgsk = date('d-m-Y', strtotime($row->TGSK));
                                echo "<td>".$tgsk."</td><tr/>";
                                $i++;
                              }
                            ?>
                  </tbody>
                </table>
            </div> <!-- akhir div ibox content-->
        </div> <!-- akhir div ibox float e-margins -->

      </div> <!-- akhir div col lg 6 -->
    </div><!-- akhir div row -->
<?php }?>

<div class="row">
<?php if($infoPenForm !=null) { ?>
    <div class="col-lg-6">
      <div class="ibox float-e-margins">
            <div class="ibox-title" style="background-color:#1AB394">
                <h5 style="color:#ffffff">Pendidikan Formal</h5>
                  <div class="ibox-tools">
                      <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                      </a>
                  </div>
            </div>
            <div class="ibox-content" style="display:block">
               <table class="table table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th width="5%">No</th><th>Sekolah</th><th>Lokasi</th><th>No Ijazah</th><th>Tg Ijazah</th>
                    </tr>
                  </thead>
                  <tbody>
                            <?php
                              $i=1;
                              foreach($infoPenForm as $row)
                              {
                                echo "<tr><td align='center'>".$i."</td>";
                                
                                if($row->UNIVER!='00000' AND $row->NASEK==" ")
                                {
                                	echo "<td>".$row->NAUNIVER."</td>";
                                }
                                else
                                {
                                	echo "<td>".$row->NASEK."</td>";
                                }
                                echo "<td>".$row->KOTSEK."</td>";
                                echo "<td>".$row->NOIJAZAH."</td>";
                                $tglijazah = date('d-m-Y', strtotime($row->TGIJAZAH));
                                echo "<td>".$tglijazah."</td></tr>";
                                $i++;
                              }
                            ?>
                  </tbody>
                </table>
            </div> <!-- akhir div ibox content-->
        </div> <!-- akhir div ibox float e-margins -->

      </div> <!-- akhir div col lg 6 -->
<?php } ?>

<?php if($infoPenNForm !=null) { ?>
      <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="background-color:#1AB394">
                <h5 style="color:#ffffff">Pendidikan Non Formal</h5>
                  <div class="ibox-tools" >
                      <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                      </a>
                  </div>
            </div>
            <div class="ibox-content">
               <table class="table table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th width="15px">No</th><th>Sekolah</th><th>Lokasi</th><th>No Ijazah</th><th>Tg Ijazah</th>
                    </tr>
                  </thead>
                  <tbody>
                            <?php
                              $i=1;
                              foreach($infoPenNForm as $row)
                              {
                                echo "<tr><td align='center'>".$i."</td>";
                                
                                echo "<td>".$row->NASEK."</td>";
                                echo "<td>".$row->KOTSEK."</td>";
                                echo "<td>".$row->NOIJAZAH."</td>";
                                $tglijazah = date('d-m-Y', strtotime($row->TGIJAZAH));
                                echo "<td>".$tglijazah."</td></tr>";
                                $i++;
                              }
                            ?>
                  </tbody>
                </table>
            </div> <!-- akhir div ibox content-->
        </div> <!-- akhir div ibox float e-margins -->

      </div> <!-- akhir div col lg 6 -->
<?php }?>
    </div><!-- akhir div row -->

<?php if($infoHubkel!=null){ ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="background-color:#1AB394">
                <h5 style="color:#ffffff">Keluarga</h5>
                  <div class="ibox-tools">
                      <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                      </a>
                  </div>
            </div>
            <div class="ibox-content">
               <table class="table table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th width="15px">No</th><th>Hubungan</th><th>Nama</th><th>TTL</th> <th>Jenis Kelamin</th> <th>Tunjangan</th><th>Pekerjaan</th>
                    </tr>
                  </thead>
                  <tbody>
                            <?php
                              $i=1;
                              foreach($infoHubkel as $row)
                              {
                                echo "<tr><td align='center'>".$i."</td>";
                                echo "<td>".$row->NAHUBKEL."</td>";
                                echo "<td>".$row->NAMA."</td>";
                                $talhir = date('d-m-y', strtotime($row->TALHIR));
                                echo "<td>".$row->TEMHIR.", ".$talhir."</td>";
                                echo "<td>".($row->JENKEL == 'P' ? 'PEREMPUAN' : 'LAKI-LAKI')."</td>";
                                echo "<td>".$row->TUNJANGAN."</td>";
                                echo "<td>".$row->KERJAAN."</td></tr>";
                                $i++;
                              }
                            ?> 
                  </tbody>
                </table>
            </div> <!-- akhir div ibox content-->
        </div> <!-- akhir div ibox float e-margins -->

      </div> <!-- akhir div col lg 6 -->
    </div><!-- akhir div row -->
<?php }?>

<?php if($infoGapokUser != null){ 

  ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="background-color:#1AB394">
                <h5 style="color:#ffffff">Gaji Pokok</h5>
                  <div class="ibox-tools">
                      <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                      </a>
                  </div>
            </div>
            <div class="ibox-content">
               <table class="table table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th width="15px">No</th><th>TMT</th> <th>Pangkat(Gol)</th><th>Gaji</th><th>No. SK</th><th>Tg. SK</th> 
                    </tr>
                  </thead>
                  <tbody>
                            <?php
                              $i=1;

                              foreach($infoGapokUser as $row)
                              {
                                echo "<tr><td align='center'>".$i."</td>";
                                $tmt = date('d M Y', strtotime($row->TMT));
                                echo "<td align='center'>".$tmt."</td>";
                                 echo "<td>".$row->NAPANG." ( ".$row->GOL." ) </td>";
                                echo "<td align='center'>".number_format($row->GAPOK)."</td>";
                                echo "<td align='center'>".$row->NOSK."</td>";
                                $tgsk = date('d-m-Y', strtotime($row->TGSK));
                                echo "<td align='center'>".$tgsk."</td></tr>";
                               
                                $i++;
                              }
                            ?> 
                  </tbody>
                </table>
            </div> <!-- akhir div ibox content-->
        </div> <!-- akhir div ibox float e-margins -->

      </div> <!-- akhir div col lg 6 -->
    </div><!-- akhir div row -->
<?php }?>

<?php if($infoPangkat != null){ ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="background-color:#1AB394">
                <h5 style="color:#ffffff">Pangkat</h5>
                  <div class="ibox-tools">
                      <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                      </a>
                  </div>
            </div>
            <div class="ibox-content">
               <table class="table table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th width="15px">No</th><th>TMT</th><th>Pangkat</th> <th>Golongan</th><th>No. SK</th><th>Tg. SK</th> 
                    </tr>
                  </thead>
                  <tbody>
                            <?php
                              $i=1;
                              foreach($infoPangkat as $row)
                              {
                                echo "<tr><td align='center'>".$i."</td>";
                                $tmt = date('d M Y', strtotime($row->TMT));
                                echo "<td align='center'>".$tmt."</td>";
                                 echo "<td>".$row->NAPANG."</td>";
                                echo "<td align='center'>".$row->GOL."</td>";
                                echo "<td align='center'>".$row->NOSK."</td>";
                                $tgsk = date('d-m-Y', strtotime($row->TGSK));
                                echo "<td align='center'>".$tgsk."</td></tr>";
                               
                                $i++;
                              }
                            ?> 
                  </tbody>
                </table>
            </div> <!-- akhir div ibox content-->
        </div> <!-- akhir div ibox float e-margins -->

      </div> <!-- akhir div col lg 6 -->
    </div><!-- akhir div row -->
<?php }?>



<?php if($infoHargaan != null) { ?>
<div class="row">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="background-color:#1AB394">
                <h5 style="color:#ffffff">Penghargaan</h5>
                  <div class="ibox-tools">
                      <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                      </a>
                  </div>
            </div>
            <div class="ibox-content">
               <table class="table table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th width="15px">No</th><th>Penghargaan</th><th>Asal</th><th>No.SK</th><th>Tg .SK</th>
                    </tr>
                  </thead>
                  <tbody>
                            <?php
                              $i=1;
                              foreach($infoHargaan as $row)
                              {
                                echo "<tr><td>".$i."</td>";
                                
                                echo "<td>".$row->NAHARGA."</td>";
                                echo "<td>".$row->ASAL_HRG."</td>";
                                echo "<td>".$row->NOSK."</td>";
                                echo "<td>".$row->TGSK."</td></tr>";
                                $i++;
                              }
                            ?>
                  </tbody>
                </table>
            </div> <!-- akhir div ibox content-->
        </div> <!-- akhir div ibox float e-margins -->

      </div> <!-- akhir div col lg 6 -->
    </div><!-- akhir div row -->
<?php }?>

<?php if($infoCuti != null) { ?>
<div class="row">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="background-color:#1AB394">
                <h5 style="color:#ffffff">Cuti</h5>
                  <div class="ibox-tools">
                      <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                      </a>
                  </div>
            </div>
            <div class="ibox-content">
               <table class="table table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th width="15px">No</th><th>TMT</th><th>No.SK</th><th>Tg.SK</th><th>Jenis Cuti</th>
                    </tr>
                  </thead>
                  <tbody>
                            <?php
                              $i=1;
                              foreach($infoCuti as $row)
                              {
                                echo "<tr><td>".$i."</td>";
                                
                                echo "<td>".$row->TMT."</td>";
                                echo "<td>".$row->NOSK."</td>";
                                echo "<td>".$row->TGSK."</td>";
                                echo "<td>".$row->KETERANGAN."</td></tr>";
                                $i++;
                              }
                            ?>
                  </tbody>
                </table>
            </div> <!-- akhir div ibox content-->
        </div> <!-- akhir div ibox float e-margins -->

      </div> <!-- akhir div col lg 6 -->
    </div><!-- akhir div row -->
<?php }?>

<?php if($infoDisiplin != null) { ?>
<div class="row">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="background-color:#1AB394">
                <h5 style="color:#ffffff">Riwayat Hukuman Disiplin</h5>
                  <div class="ibox-tools">
                      <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                      </a>
                  </div>
            </div>
            <div class="ibox-content">
               <table class="table table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th width="15px">No</th><th>No.SK</th><th>Tg.SK</th><th>Hukuman Disiplin</th><th>Tanggal Mulai</th><th>Tanggal Akhir</th>
                    </tr>
                  </thead>
                  <tbody>
                            <?php
                              $i=1;
                              foreach($infoDisiplin as $row)
                              {
                                echo "<tr><td>".$i."</td>";
                                echo "<td>".$row->NOSK."</td>";
                                echo "<td>".$row->TGSK."</td>";
                                echo "<td>".$row->KETERANGAN."</td>";
                                echo "<td>".$row->TGMULAI."</td>";
                                echo "<td>".$row->TGAKHIR."</td></tr>";
                                $i++;
                              }
                            ?>
                  </tbody>
                </table>
            </div> <!-- akhir div ibox content-->
        </div> <!-- akhir div ibox float e-margins -->

      </div> <!-- akhir div col lg 6 -->
    </div><!-- akhir div row -->
<?php }?>

<?php if($infoSKPUser != null) { ?>
<div class="row">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="background-color:#1AB394">
                <h5 style="color:#ffffff">Riwayat SKP</h5>
                  <div class="ibox-tools">
                      <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                      </a>
                  </div>
            </div>
            <div class="ibox-content">
               <table class="table table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th width="15px">No</th><th>Tahun</th><th>SKP</th><th>Perilaku</th><th>Nilai Prestasi</th><th>Keterangan Prestasi</th>
                    </tr>
                  </thead>
                  <tbody>
                            <?php
                              $i=1;
                              foreach($infoSKPUser as $row)
                              {
                                echo "<tr><td>".$i."</td>";
                                echo "<td>".$row->TAHUN."</td>";
                                echo "<td>".$row->INPUT_SKP."</td>";
                                echo "<td>".$row->RATA2."</td>";
                                echo "<td>".$row->NILAI_PRESTASI."</td>";
                                echo "<td>".$row->KET_PRESTASI."</td></tr>";
                                $i++;
                              }
                            ?>
                  </tbody>
                </table>
            </div> <!-- akhir div ibox content-->
        </div> <!-- akhir div ibox float e-margins -->

      </div> <!-- akhir div col lg 6 -->
    </div><!-- akhir div row -->
<?php }?>

    <br/>
    <br/>  

    <div class="modal fade" id="modalform" style="overflow:hidden" role="dialog" aria-labelledby="modalUmumTitle" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document" id="pesan" >
            <form class="form-horizontal" id="formPass" action="javascript:updateDataPeg();" method="POST" >                
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modalUmumTitle">Form Isi Data Pegawai<i>  
                        <?php echo $peg2->NRK." - ".$peg2->NAMA; ?> </i></h4>
                        <input type="hidden" id="NRK" name="NRK" value= "<?php echo $user_id; ?>"/>
                        
                    </div>
                    <div class="modal-body">
                        
                        <div class="row">
                            <!--side kiri-->
                            <div class="col-lg-6">

                                <div class="form-group">
                                  <label class="col-sm-4 control-label" for="jendikcps">Agama</label>
                                  <select class="form-control select2_agama" name="agama" id="agama">
                                      
                                      <?php echo $listAgama; ?>
                                  </select>
                                </div>

                                <div class="form-group">
                                  <p><label class="col-sm-4 control-label" for="jenkel">Jenis Kelamin </label></p>
                                    <div class="radio radio-success radio-inline">
                                        <input type="radio"  id="jenkel" value="L" name="jenkel" <?php echo isset($peg2->JENKEL)? (($peg2->JENKEL == 'L') ? 'checked' : ''): 'checked'; ?>>
                                        <label for="jenkel" style="padding: 0px 2px ;"> Laki-laki </label>
                                    </div>
                                    <div class="radio radio-success radio-inline">
                                        <input type="radio" id="jenkel" value="P" name="jenkel" <?php echo isset($peg2->JENKEL)? (($peg2->JENKEL == 'P') ? 'checked' : ''):''; ?>>
                                        <label for="jenkel" style="padding: 0px 2px ;"> Perempuan </label>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">No. TASPEN</label>
                                  <div class="input-group col-sm-7">
                                      <input class="form-control" maxlength="18" type="text" id="taspen" placeholder="TASPEN" name="taspen" value="<?php echo trim($peg2->TASPEN); ?>">
                                  </div>
                                </div>

                                

                                <div class="form-group">
                                  <label class="col-sm-4 control-label">NIK</label>
                                  <div class="input-group col-sm-7">
                                      <input class="form-control" maxlength="16" type="text" id="noppen" placeholder="NOPPEN" name="noppen" onkeypress="return numbersonly1(this, event)"   value="<?php echo $peg2->NOPPEN; ?>">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-4 control-label">No. Kartu Keluarga</label>
                                  <div class="input-group col-sm-7">
                                      <input class="form-control" maxlength="16" type="text" id="nokk" placeholder="NOKK" onkeypress="return numbersonly1(this, event)"  name="nokk" value="<?php echo $peg2->NOKK; ?>">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-4 control-label">No. Rek Bank DKI</label>
                                  <div class="input-group col-sm-7">
                                      <input class="form-control" maxlength="12" type="text" id="simpeda" onkeypress="return numbersonly1(this, event)" placeholder="no rek Bank DKI" name="simpeda" value="<?php echo $peg2->SIMPEDA; ?>">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-4 control-label">NPWP</label>
                                  <div class="input-group col-sm-7">
                                      <input class="form-control" maxlength="15" onkeypress="return numbersonly1(this, event)"  type="text" id="npwp" placeholder="NPWP" name="npwp" value="<?php echo $peg2->NPWP; ?>">
                                  </div>
                                </div>

                                 <div class="form-group">
                                  <p><label class="col-sm-4 control-label" for="darah">Gol. Darah</label></p>
                                    <div class="radio radio-success radio-inline">
                                        <input type="radio" id="darah" value="O" name="darah" <?php echo isset($peg2->DARAH)? ((trim($peg2->DARAH) == 'O') ? 'checked' : ''): ''; ?>>
                                        <label for="darah" style="padding: 0px 2px ;"> O </label>
                                    </div>
                                    <div class="radio radio-success radio-inline">
                                        <input type="radio" id="darah" value="A" name="darah" <?php echo isset($peg2->DARAH)? ((trim($peg2->DARAH) == 'A') ? 'checked' : ''):''; ?>>
                                        <label for="darah" style="padding: 0px 2px ;"> A </label>
                                    </div>
                                    <div class="radio radio-success radio-inline">
                                        <input type="radio" id="darah" value="B" name="darah" <?php echo isset($peg2->DARAH)? ((trim($peg2->DARAH) == 'B') ? 'checked' : ''):''; ?>>
                                        <label for="darah" style="padding: 0px 2px ;"> B </label>
                                    </div>
                                    <div class="radio radio-success radio-inline">
                                        <input type="radio" id="darah" value="AB" name="darah" <?php echo isset($peg2->DARAH)? ((trim($peg2->DARAH) == 'AB') ? 'checked' : ''):''; ?>>
                                        <label for="darah" style="padding: 0px 2px ;"> AB </label>
                                    </div>
                                </div>

                                


                            </div>

                            <!--side kanan-->

                            <div class="col-lg-6">
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">No. Telp</label>
                                  <div class="input-group col-sm-7">
                                    <input class="form-control" maxlength="18" type="text" id="notelp" onkeypress="return numbersonly1(this, event)" placeholder="No. Telp" name="notelp" value="<?php echo $peg2->NOTELP; ?>">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-4 control-label">No. HP</label>
                                  <div class="input-group col-sm-7">
                                      <input class="form-control" onkeypress="return numbersonly1(this, event)" maxlength="13" type="text" id="nohp" placeholder="No. HP" name="nohp" value="<?php echo $peg2->NOHP; ?>">
                                  </div>
                                </div>

                                 <div class="form-group" style="display: none">
                                  <label class="col-sm-4 control-label" for="jendikcps">Jenis Pendidikan CPNS </label>
                                  <select class="form-control select2_jendikcps" name="jendikcps" id="jendikcps">
                                      
                                      <?php echo $listJendikcps; ?>
                                  </select>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-4 control-label" for="kodikcps">Pendidikan Pada Waktu Diangkat CPNS </label>
                                  <select class="form-control select2_kodikcps" name="kodikcps" id="kodikcps" >
                                      <option></option>
                                      <?php echo $listKodikcps; ?>
                                  </select>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-4 control-label">No. KARPEG</label>
                                  <div class="input-group col-sm-7">
                                      <input class="form-control" maxlength="16" type="text" id="karpeg"  placeholder="KARPEG" name="karpeg" value="<?php echo trim($peg2->KARPEG); ?>">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-4 control-label">No.BPJS Kesehatan</label>
                                  <div class="input-group col-sm-7">
                                      <input class="form-control" maxlength="16" type="text" id="bpjs" placeholder="BPJS" onkeypress="return numbersonly1(this, event)" name="bpjs" value="<?php echo $peg2->BPJS; ?>">
                                  </div>
                                </div>

                               
                                <div class="form-group">
                                  <label class="col-sm-4 control-label">No. Kartu Suami/Istri</label>
                                  <div class="input-group col-sm-7">
                                      <input class="form-control" maxlength="8" type="text" id="karsu" placeholder="Kartu Suami/Istri"  name="karsu" value="<?php echo $peg2->KARSU; ?>">
                                  </div>
                                </div>

                              <div class="form-group">
                                  <label class="col-sm-4 control-label">Email</label>
                                  <div class="input-group col-sm-7">
                                      <input class="form-control" maxlength="75" type="text" id="email" placeholder="Email" name="email" value="<?php echo $peg2->EMAIL; ?>">
                                  </div>
                              </div>

                            </div> <!--end div lg-->


                        </div> <!--end div row-->
                         <span class="text-danger" id="warning"></span>
                           

                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default dim" data-dismiss="modal" id="tutupModal">Tutup</button>
                            <button type="submit" class="btn btn-primary dim">Simpan</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>          
 </div>
 <!-- Custom and plugin javascript -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/inspinia.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/pace/pace.min.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>


<script type="text/javascript">

    $(document).ready(function(){
       /* $(".select2_jendikcps").select2({
            width: "55%",
            placeholder: "Pilih Jenis Pendidikan CPS"
        });*/
        $(".select2_kodikcps").select2({
            width: "55%",
            placeholder: "Pilih Pendidikan CPS"
        });
        $(".select2_agama").select2({
            width: "55%",
            placeholder: "Pilih Agama"
        });
    });

  function numbersonly1(myfield, e, dec) 
    {   
        var key; 
        var keychar; 
        if (window.event)
            key = window.event.keyCode; 
        else if (e) 
            key = e.which; 
        else 
            return true; 
        keychar = String.fromCharCode(key); 

        // control keys 
        if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) ) 
        return true; 

        // numbers 
        else if ((("0123456789").indexOf(keychar) > -1))
         return true; 

        // decimal point jump 
        else if (dec && (keychar == ".")) 
        { 
            myfield.form.elements[dec].focus(); return false; 
        } 
        else 
            return false; 
    }
  
  function onclickbutton()
  {
    $('#modalform').modal('show');
  }

  function updateDataPeg()
  {
   
                    var url = "<?php echo site_url('profile/UpdateDasek'); ?>";
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: $("#formPass").serialize(),
                        dataType: "json",
                        beforeSend: function() {
                            var agama = $("#agama").val();
                            var jenkel = $('input[type=radio][name=jenkel]:checked').val();          
                            var taspen = $("#taspen").val();
                            var noppen = $("#noppen").val();
                            var nokk = $("#nokk").val();
                            var simpeda = $("#simpeda").val();
                            var nohp = $("#nohp").val();
                            var npwp = $("#npwp").val();
                            var darah =  $('input[type=radio][name=darah]:checked').val(); 
                            var jendikcps = $("#jendikcps").val('1');
                            var kodikcps= $("#kodikcps").val();
                             var email = $("#email").val();
                            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  

                            var cekmail =0;
                            if(email.match(mailformat) || email == "")
                            {
                              cekmail=1;

                            }
                            
                            if(agama == ""){
                                $("#warning").html("Agama Wajib Diisi");
                                return false;
                            }
                            else if(jenkel == undefined){
                                $("#warning").html("Jenis Kelamin Wajib Diisi");
                                return false;
                            }
                            else if(noppen=="")
                            {
                                $("#warning").html("NIK Wajib Diisi");
                                return false;
                            }
                            else if(nokk=="")
                            {
                                $("#warning").html("No. Kartu Keluarga Wajib Diisi");
                                return false;
                            }
                            else if(simpeda=="")
                            {
                                $("#warning").html("No. Rekening Wajib Diisi");
                                return false;
                            }
                            else if(npwp=="")
                            {
                                $("#warning").html("NPWP Wajib Diisi");
                                return false;
                            }
                            else if(darah==undefined)
                            {
                                $("#warning").html("Golongan Darah Wajib Diisi");
                                return false;
                            }
                            else if(nohp=="")
                            {
                                $("#warning").html("HP Wajib Diisi");
                                return false;
                            }
                            else if(jendikcps=="")
                            {
                                $("#warning").html("Jenis Pendidikan Wajib Diisi");
                                return false;
                            }
                            else if(kodikcps=="")
                            {
                                $("#warning").html("Pendidikan Wajib Diisi");
                                return false;
                            }
                             else if(cekmail == "0")
                            {
                              $("#warning").html("Email tidak Valid");
                              return false;
                            }
                            else{
                                $("#warning").html();     
                                             
                            }

                            
                           
                        },
                        success: function(data) {                               
                            
                            if(data.responupd == "2"){
                                swal("Sukses!", "Perbarui Data Pegawai BERHASIL", "success");                    
                                $("#tutupModal").click();
                                //$("#tbl-grid").DataTable().ajax.reload();
                                location.reload();
                            }
                            else if(data.responupd == "-2"){
                                swal("Gagal!", "Perbarui Data Pegawai GAGAL", "error");                    
                                //$("#tutupModal").click();
                                //$("#tbl-grid").DataTable().ajax.reload();
                            }
                            else if(data.responupd == "1"){
                                swal("Sukses!", "Tambah Data Pegawai BERHASIL", "success");                    
                                $("#tutupModal").click();
                                //$("#tbl-grid").DataTable().ajax.reload();
                                location.reload();
                            }
                            else if(data.responupd == "-1"){
                                swal("Gagal!", "Tambah Data Pegawai GAGAL", "error");                    
                                //$("#tutupModal").click();
                                //$("#tbl-grid").DataTable().ajax.reload();
                            }
                            else{
                               swal("Gagal!", "Gagal.", "error");
                            }
                        },
                        error: function(xhr) {                              
                            
                        },
                        complete: function() {              
                            
                        }
                    });
                }
</script>
<!-- Custom and plugin javascript -->   


<?php } else { redirect(base_url().'login/logout'); } ?>
