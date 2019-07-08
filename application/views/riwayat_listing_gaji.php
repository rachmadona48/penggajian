<style type="text/css">
    .col-lg-4 .ibox .ibox-title{
        background-color: rgba(0,0,0,0.1);
    }
    .col-lg-4 .ibox .ibox-content{
        background-color: rgba(10,0,0,0.07);
    }
    #addMenu .modal-content .modal-header {
        padding: 10px 15px; 
        text-align: center;
    }
    #addMenu .ibox-content {
        background-color: #ffffff;
        color: inherit;
        padding: 0px 0px 0px 0px !important; 
        border-color: #e7eaec;
        border-image: none;
        border-style: solid solid none;
        border-width: 1px 0px;
    }

    .dd-item .pull-right button{
        margin-top: 5px;
        margin-right: 2px;
    }

    .sk-spinner-circle.sk-spinner {
            height: 22px;
            margin: 0 !important;
            position: relative;
            width: 22px;
        }

    .sk-spinner-three-bounce.sk-spinner {
            margin: 0 auto;
            text-align: center;
            width: 140px !important;
        }

    .dataTables_scroll .dataTables_scrollHeadInner{
        width: 100% !important;
    }

    .dataTables_scroll .dataTables_scrollHeadInner table{
        width: 100% !important;   
    }

    .dataTables_scroll .dataTables_scrollBody{
        width: 100% !important;
    }

    .dataTables_scroll .dataTables_scrollBody table{
        width: 100% !important;
    }

    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
    .pickerpicker .form-control-feedback {
        right: 55px !important;      
    }

    .pickerpicker .form-control-feedback {
        top: 0px !important;
    }

</style>


<?php
	date_default_timezone_set('Asia/Jakarta');
    $date_now = date('Ym');
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Riwayat Listing GAJI</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>index.php">Home</a>
            </li>
            <li class="active">
                <strong>Listing Gaji</strong>
            </li>
        </ol>
         <small><i>(Menu untuk menampilkan riwayat listing Gaji)</i></small>
    </div>
</div>

<!-- <div class="wrapper wrapper-content animated fadeInDown">
    <div class="ibox float-e-margins" style="margin-top: 10px">
      <div class="ibox-content">
        <div class="row">
          <div class="col-md-12">

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
 -->


<div class="wrapper wrapper-content animated fadeInRight">
<?php if($info_gaji >= 1){ ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="background-color:#1AB394">
                <h5 style="color:#ffffff">Riwayat Listing Gaji</h5>
                  <div class="ibox-tools">
                      <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                      </a>
                  </div>
            </div>
            <div class="ibox-content">
                <table id="tbl_gaji" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <td align="left" width="3%"><b>No</b></td>
                            <td align="left" width="7%"><b>THBL</b></td>
                            <td align="left" width="7%"><b>NRK</b></td>
                            <td align="left" width="13%"><b>Jabatan</b></td>
                            <td align="left" width="10%"><b>SPMU</b></td>
                            <td align="left" width="15%"><b>Lokasi</b></td>
                            <td align="left" width="15%"><b>Jumlah Kotor</b></td>
                            <td align="left" width="10%"><b>Jumlah Potongan</b></td>
                            <td align="left" width="15%"><b>Jumlah Bersih</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <div id="spinner_tbl_gaji"></div>
                    </tbody>
                </table> 
            </div> <!-- akhir div ibox content-->
        </div> <!-- akhir div ibox float e-margins -->

      </div> <!-- akhir div col lg 6 -->
    </div><!-- akhir div row -->
<?php }?>

<?php if($info_tkd_gr >= 1){ ?>
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
                <table id="tbl_tkd_gr" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <td align="left" width="3%"><b>No</b></td>
                            <td align="left" width="7%"><b>THBL</b></td>
                            <td align="left" width="7%"><b>NRK</b></td>
                            <td align="left" width="13%"><b>Jabatan</b></td>
                            <td align="left" width="10%"><b>SPMU</b></td>
                            <td align="left" width="15%"><b>Lokasi</b></td>
                            <td align="left" width="5%"><b>Kinerja</b></td>
                            <td align="left" width="15%"><b>Njtunda</b></td>
                            <td align="left" width="10%"><b>Potongan TKD</b></td>
                            <td align="left" width="15%"><b>TKD Bersih</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <div id="spinner_tbl_gr"></div>
                    </tbody>
                </table> 
            </div> <!-- akhir div ibox content-->
        </div> <!-- akhir div ibox float e-margins -->

      </div> <!-- akhir div col lg 6 -->
    </div><!-- akhir div row -->
<?php }?>

</div>

<!-- END WRAPPER CONTENT -->
    
    <!-- Mainly scripts -->
    <script src="<?php echo base_url() ?>assets/inspinia/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url() ?>assets/inspinia/js/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Nestable List -->
    <script src="<?php echo base_url() ?>assets/js/plugins/nestable/jquery.nestable.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url() ?>assets/inspinia/js/inspinia.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins/pace/pace.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>

    <!-- Data Tables -->
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.tableTools.min.js"></script>

    <!-- Boostrap Validator -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/boostrapvalidator/js/bootstrapValidator.js"></script>

    <!-- Sweet alert -->
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/chosen/chosen.jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/select2/select2.full.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/fullcalendar/moment.min.js"></script>

    <!-- Jquery Validate -->
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/validate/jquery.validate.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/iCheck/icheck.min.js"></script>
    <!-- DROPZONE -->
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dropzone/dropzone.js"></script>

    <script>
        $(document).ready(function(){

           tabel_gaji();
           tabel_tkd_gr();

       });
    </script>
   

    <script type="text/javascript">


    	function tabel_gaji(){
            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 

            var dataTable = $('#tbl_gaji').DataTable( {
                    // "columns": [
                    //           null,
                    //           null,
                    //           null,
                    //           null,
                    //           null,
                    //           null
                    //           ],
                    responsive: false,
                    bAutoWidth: true, 
                    destroy: true,
                    // "bProcessing": true,
                    "scrollX": true,
                    "serverSide": true,
                    "language": {
                            "processing": "<div></div><div></div><div></div><div></div><div></div>"
                        },
                    "ajax":{
                        url :"<?php echo site_url('index.php/riwayat_penghasilan/data_gaji')?>", // json datasource
                        type: "post",  // method  , by default get
                        // drawCallback: function( settings ) {
                          
                        // },
                        data : function(d){
                        },
                        beforeSend: function(){
                            $('#spinner_tbl_gaji').html(spinner);
                        },complete: function(){
                                 $("#spinner_tbl_gaji").html('');
                        },
                        error: function(){  // error handling
                            $(".tbl_gaji-error").html("");
                            $("#tbl_gaji").append('<tbody class="tbl_gaji-error"><tr><div colspan=9>Tidak Ada Data</div></tr></tbody>');
                            $("#tbl_gaji_processing").css("display","none");
                            
                        }

                    }
                  

                } );
                

                // setInterval( function () {
                //     $('#tbl1').DataTable().ajax.reload();
                // }, 1000 );


                $('#tablegaji input').unbind();
                $('#tablegaji input').bind('keyup', function(e) {
                if(e.keyCode == 13) {
                oTable.fnFilter(this.value);
                }
                });
        }

        function tabel_tkd_gr(){
            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 

            var dataTable = $('#tbl_tkd_gr').DataTable( {
                    // "columns": [
                    //           null,
                    //           null,
                    //           null,
                    //           null,
                    //           null,
                    //           null
                    //           ],
                    responsive: false,
                    bAutoWidth: true, 
                    destroy: true,
                    // "bProcessing": true,
                    "scrollX": true,
                    "serverSide": true,
                    "language": {
                            "processing": "<div></div><div></div><div></div><div></div><div></div>"
                        },
                    "ajax":{
                        url :"<?php echo site_url('index.php/riwayat_penghasilan/data_tkd_guru')?>", // json datasource
                        type: "post",  // method  , by default get
                        // drawCallback: function( settings ) {
                          
                        // },
                        data : function(d){
                        },
                        beforeSend: function(){
                            $('#spinner_tbl_gr').html(spinner);
                        },complete: function(){
                                 $("#spinner_tbl_gr").html('');
                        },
                        error: function(){  // error handling
                            $(".tablegaji-error").html("");
                            $("#tablegaji").append('<tbody class="tablegaji-error"><tr><div colspan=10>Tidak Ada Data</div></tr></tbody>');
                            $("#tablegaji_processing").css("display","none");
                            
                        }

                    }
                  

                } );
                

                // setInterval( function () {
                //     $('#tbl1').DataTable().ajax.reload();
                // }, 1000 );


                $('#tablegaji input').unbind();
                $('#tablegaji input').bind('keyup', function(e) {
                if(e.keyCode == 13) {
                oTable.fnFilter(this.value);
                }
                });
        }

    </script>


    



