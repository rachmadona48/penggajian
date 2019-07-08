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

<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Profile</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>index.php">Home</a>
            </li>
            <li class="active">
                <strong>Listing TKD</strong>
            </li>
        </ol>
         <small><i>(Menu untuk menampilkan riwayat listing TKD)</i></small>
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
                <h5 style="color:#ffffff">Riwayat Listing TKD Pegawai</h5>
                  <div class="ibox-tools">
                      <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                      </a>
                  </div>
            </div>
            <div class="ibox-content">
               <table class="table table-striped table-bordered table-hover dataTables-example" width="100%">
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
                <h5 style="color:#ffffff">Riwayat Listing TKD Guru</h5>
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



    <br/>
    <br/>  

            
 </div>

<!-- Mainly scripts -->
<!-- <script src="<?php echo base_url(); ?>assets/inspinia/js/jquery-2.1.1.js"></script> -->

<!-- Custom and plugin javascript -->


<!-- Mainly scripts -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/jquery-2.1.1.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!-- Mainly scripts -->

<!-- jqueryForm -->
<script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>

<!-- Data picker -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/datapicker/bootstrap-datepicker.js"></script>



<!-- Data Tables -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.responsive.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
<!-- Data Tables -->

<!-- Boostrap Validator -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/boostrapvalidator/js/bootstrapValidator.js"></script>

<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/chosen/chosen.jquery.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/inspinia.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/pace/pace.min.js"></script>
<!-- Custom and plugin javascript -->

<!-- Sweet alert -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Input Mask-->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/jasny/jasny-bootstrap.min.js"></script>

<!-- ChartJS-->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/chartJs/Chart.min.js"></script>



<script type="text/javascript">

    $(document).ready(function(){
       
    });

  

  
</script>
<!-- Custom and plugin javascript -->   


<?php } else { redirect(base_url().'login/logout'); } ?>
