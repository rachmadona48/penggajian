<?php 
    header('Cache-Control: max-age=900');
?>
    <style type="text/css">
    
        #small-chat {position: fixed;bottom: 20px;right: 0px;z-index: 100;}
        #small-chat .badge {position: absolute;top: -3px;right: -4px;}
        .open-small-chat {height: 38px;width: 38px;display: block;background: #1ab394;padding: 9px 8px;text-align: center;color: #fff;border-radius: 50%;}
        .open-small-chat:hover {color: white;background: #1ab394;}
        .small-chat-box {display: none;position: fixed;bottom: 20px;right: 75px;background: #fff;border: 1px solid #e7eaec;width: 230px;height: 320px;border-radius: 4px;}
        .small-chat-box.ng-small-chat {display: block;}
        .body-small .small-chat-box {bottom: 70px;right: 20px;}
        .small-chat-box.active {display: block;}
        .small-chat-box .heading {background: #2f4050;padding: 8px 15px;font-weight: bold;color: #fff;}
        .small-chat-box .chat-date {opacity: 0.6;font-size: 10px;font-weight: normal;}
        .small-chat-box .content {padding: 15px 15px;}
        .small-chat-box .content .author-name {font-weight: bold;margin-bottom: 3px;font-size: 11px;}
        .small-chat-box .content > div {padding-bottom: 20px;}
        .small-chat-box .content .chat-message {padding: 5px 10px;border-radius: 6px;font-size: 11px;line-height: 14px;max-width: 80%;background: #f3f3f4;margin-bottom: 10px;}
        .small-chat-box .content .chat-message.active {background: #1ab394;color: #fff;}
        .small-chat-box .content .left {text-align: left;clear: both;}
        .small-chat-box .content .left .chat-message {float: left;}
        .small-chat-box .content .right {text-align: right;clear: both;}
        .small-chat-box .content .right .chat-message {float: right;}
        .small-chat-box .form-chat {padding: 10px 10px;}

        .panel, .ibox{
          text-decoration: none;
          outline: none;                
          border: none;
          border-radius: 5px;
          box-shadow: 2px 2px 3px 3px #999;  
        }

        .form-group #riwayat_list {          
          display: inline-block;          
          cursor: pointer;          
          text-decoration: none;
          outline: none;                
          border: none;
          border-radius: 5px;
          box-shadow: 2px 2px 3px 3px #999;
        }      

        .input-group-addon{
            background-color: #1ab394 !important;
            color: #fff !important;
        }

         #ibox_bkd .ibox-content{
            padding: 15px 20px 0px 20px !important;
        }
        .user-friends
        {
            height:130px !important; 
            display:block !important; 
            overflow-y:auto !important;
        }

        #profile-content
        {
            max-height: 100% !important;
        }

        #struktur-content
        {
            max-height: 100% !important;
        }

        #struktur2-content
        {
            height: 195px !important;
        }

        .form-group #riwayat_list:hover {background-color: rgba(0,0,0,0.08);}  



        /*.modal-lg{
            width: 1024px !important;
        }*/
        .ms-options-wrap .ms-options ul, .ms-options-wrap .ms-options li {
            list-style: outside none none;
            margin: 0 !important;
            padding: 2px !important;
        }

        .ibox-title .label {
            float: none !important;
            margin-left: 4px;
        }

        .ms-options-wrap > .ms-options > ul > li.optgroup .label {
            display: inline !important;
            font-weight: bold;
            padding: 5px 0 0;
        }

        /*.label {
            background-color: #fff !important;
            color: #5e5e5e;
            font-family: "Open Sans";
            font-size: 10px;
            font-weight: 600;
            padding: 3px 8px;
            text-shadow: none;
        }
*/
        .ms-options-wrap > .ms-options > ul input[type="checkbox"] {            
            top: 2px !important;
        }

        .float-e-margins .btn#btnRiwayat {
            margin-bottom: 0;
        }        
                

        /*Tampilkan pencarian di tampilan phone*/
        @media screen and (min-width: 770px){
            div#forPhone{
                display: none;
            }

            .modal-lg{
                width: 1024px !important;
            }

            #btnRiwayat{
                float: left !important;
            }
            
        }

        

    </style>
    <!-- Multiple Select -->
    <link href="<?php echo base_url(); ?>assets/js/plugins/multipleselect/jquery.multiselect.css" rel="stylesheet">
    <!-- Multiple Select -->


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Riwayat</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>index.php">Home</a>
            </li>            
            <li class="active">
                <strong>Riwayat</strong>
            </li>
        </ol>
        <small><i>(Menu untuk mengolah riwayat pegawai)</i></small>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<div class="wrapper wrapper-content">
<?php if($user_group > 1){ ?>

    <div class="row" id="forPhone">
        <div class="col-md-12">
            <div id="ibox_bkd" class="ibox float-e-margins animated fadeInRightBig">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-4">
                            <form id="form_4bkd" method="POST" action="<?php echo site_url(); ?>/riwayat">
                              <div class="form-group">                        
                                <div class="input-group">                          
                                  <input type="text" class="form-control" id="nrkP" name="nrkP" value="<?php echo $nrk; ?>" data-mask="999999" placeholder="NRK" autocomplete="off">
                                  <div class="input-group-addon btn btn-primary" style="cursor:pointer;" onclick="getProfile('4bkd');">Go</div>                          
                                </div>
                                <small><span class="help-block m-b-none"><u><i>Masukkan NRK Pegawai yang akan ditampilkan (Cth : 123456).</i></u></span></small>
                              </div>                      
                            </form>
                        </div>                                        
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php } ?>
<?php if(isset($infoUser->NRK)){ ?>
    <div class="row">   

        <?php 
            $cols = 12;
            if(isset($bawahan)){      
                if($bawahan != ""){    
                    $cols = 9;
                }else{
                    $cols = 12;
                }
            }else{
                $cols = 12;
            }
        ?>         
              
        <div class="col-md-<?php echo $cols; ?>">
        
            <div class="ibox float-e-margins animated fadeInDown">

                <!-- <div class="ibox-title">
                    
                </div> -->
                <div>
                 <div class="ibox-content profile-content" id="profile-content">
                        <div class="row">
                            <!-- <div class='form-group'> -->
                            <div class="col-sm-9">
                                <h5>Profile Detail</h5>
                            </div>
                             <div class="col-sm-3">
                             <!--   <form method="post" target="_blank" 
                                    action="<?php //echo base_url(); ?>profile/toPdf2"><input type="hidden" name="nrkpr" id="nrkpr" value="<?php //echo $infoUser->NRK; ?>">
                                    <button class="btn btn-outline btn-danger pull-right" data-toggle='tool-tip' data-placement='bottom' title='cetak CV'>
                                      <i class="fa fa-save"></i> PDF
                                    </button>
                              
                                </form> -->
                                <form method="post" target="_blank" 
                                    action="<?php echo base_url(); ?>profile/cv"><input type="hidden" name="nrkpr" id="nrkpr" value="<?php echo $infoUser->NRK; ?>">
                                    <button class="btn btn-outline btn-danger pull-right" data-toggle='tool-tip' data-placement='bottom' title='cetak CV'>
                                      <i class="fa fa-save"></i> PDF
                                    </button>
                              
                                </form>

                                <?php if($user_group == 2) { ?>
                                 <form method='post'  action="<?php echo base_url(); ?>pegawai/doedit"><input type="hidden" name="nrk" id="nrk" value="<?php echo $infoUser->NRK; ?>"><input type="hidden" id="ses" name="ses" value="2">

                                                <button class='btn btn-outline btn-warning pull-right' data-toggle='tool-tip' data-placement='bottom' title='edit pegawai' type='submit' style="margin-right: 5px"><i class='fa fa-pencil-square'>&nbsp;&nbsp;EDIT</i></button>
                                </form>
                                <?php } ?>
                               
                            </div>
                            <!-- </div> -->
                            <div class="col-sm-1">
                                <div class="text-center animated fadeInDown">
                                    <input type="hidden" id="self_nrk" name="self_nrk" value="<?php echo isset($infoUser->NRK) ? $infoUser->NRK : '';?>">
                                    <input type="hidden" id="self_nip" name="self_nip" value="<?php echo isset($infoUser->NIP18) ? $infoUser->NIP18 : ''; ?>">

                                    <?php 

                                        if(isset($infoUser->NRK)){
                                            $linkImg = "assets/img/photo/".$infoUser->NRK.".jpg";

                                            $nrk = $infoUser->NRK;    
                                            $nip18 = $infoUser->NIP18;
                                            $pathir = $infoUser->PATHIR;
                                            $talhir = $infoUser->TLHR;
                                            $nama = $infoUser->NAMA_ABS;
                                            $titel = $infoUser->TITEL;
                                            $titeldepan = $infoUser->TITELDEPAN;
                                            $stapeg = $infoUser->STATUS_PEGAWAI;
                                            $najabl = $infoUser->NAJABL;
                                            $nalokl = $infoUser->NALOKL;
                                            $naklogad = $infoUser->NAKLOGAD;
                                            $kd = $infoUser->KD;
                                            $muang = $infoUser->MUANG;
                                            $tmtstapeg= $infoUser->TMT_STAPEG;
                                            $gol = $infoUser->GOL;
                                            $napang =$infoUser->NAPANG;

                                            /*if(isset($infoUserJabatan))
                                            {
                                                $esln = $infoUserJabatan->NESELON2;
												
                                                if($esln == '00' || $esln==' ')
                                                {
                                                    $eselon="NON ESELON";
                                                }
                                                else
                                                {
                                                    $eselon = "ESELON ".$esln;
                                                }
                                            }
                                            else
                                            {
                                                $eselon="NON ESELON";
                                            }*/
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

                                            


                                            if(file_exists($linkImg)){
                                            $img = "assets/img/photo/".$infoUser->NRK.".jpg";                                    
                                            }else{
                                                $img = "assets/img/photo/profile_small.jpg";
                                            }

                                        }else{
                                            $linkImg = "assets/img/photo/profile_small.jpg";    
                                            $nrk = "";    
                                            $nip18 = "";
                                            $pathir = "";
                                            $talhir = "";                                    
                                            $nama = "";
                                            $titel = "";
                                            $titeldepan = "";
                                            $stapeg = "";
                                            $najabl = "";
                                            $nalokl = "";
                                            $naklogad = "";
                                            $kd="-";
                                            $eselon="";
                                            $gol="";
                                            $napang="";
                                            $eselon="";
                                            $img = "assets/img/photo/profile_small.jpg";                                    
                                        }

                                        
                                            $nohp = isset($infoUser3->NOHP) ? $infoUser3->NOHP : "";
                                            $notelp = isset($infoUser3->NOTELP) ? $infoUser3->NOTELP : "";
                                            $alamat = isset($infoUser3->ALAMAT) ? $infoUser3->ALAMAT : "";
                                            $rt = isset($infoUser3->RT) ? $infoUser3->RT : "";
                                            $rw = isset($infoUser3->RW) ? $infoUser3->RW : "";
                                            $nawil = isset($infoUser3->NAWIL) ? $infoUser3->NAWIL : "";
                                            $nacam = isset($infoUser3->NACAM) ? $infoUser3->NACAM : "";
                                            $nakel = isset($infoUser3->NAKEL) ? $infoUser3->NAKEL : "";
                                            $prop = isset($infoUser3->PROPINSI) ? $infoUser3->PROPINSI : "";
                                            $email = isset($infoUser3->EMAIL) ? $infoUser3->EMAIL : "";
                                        
                                           //var_dump($img);                             
                                        
                                    ?>   

                                        <a href="<?php echo $img; ?>" title="Image from Unsplash" data-gallery="">
                                            <img alt="image" class="img-circle m-t-xs img-responsive" src="<?php echo base_url().$img;  ?>">
                                        </a>
                                </div>
                            </div>


                            <div class="col-md-6">                            
                                <p><b><?php echo "<h2><strong><span class=\"text-navy\">$titeldepan $nama $titel </span></strong></h2>"; ?></b></p>
                                <address style="font-size:11px;">
                                
                                <p data-toggle='tool-tip' data-placement='bottom' title='NRK-NIP'><i class="fa fa-credit-card"></i>&nbsp; <?php echo "<strong><span class=\"text-success\"> $nrk - $nip18 </span></strong>"; ?></p>
                                
                                <p data-toggle='tool-tip' data-placement='bottom' title='Tempat Tanggal Lahir'><i class="fa fa-birthday-cake"></i>&nbsp; <?php echo "<strong><span class=\"text-danger\">$pathir, $talhir </span></strong>"; ?></p>
                                
                                <p data-toggle='tool-tip' data-placement='bottom' title='Stapeg / Kode Jabatan / Eselon / Pangkat(Gol)'><i class="fa fa-ioxhost"></i>&nbsp; <?php echo "<strong><span class=\"text-primary\">$stapeg / $kd / $eselon / $napang ($gol) </span></strong>"; ?></p>
                                
                                <p data-toggle='tool-tip' data-placement='bottom' title='TMT CPNS / TMT PNS'><i class="fa fa-calendar"></i>&nbsp; <?php echo "<strong><span class=\"text-navy\">(CPNS) ".$muang." / (PNS) ".$tmtstapeg."</span></strong>"; ?></p>
                                
                                <p data-toggle='tool-tip' data-placement='bottom' title='Lokasi Kerja'><i class="fa fa-map-marker"></i>&nbsp; <?php echo "<strong><span class=\"text-info\">$nalokl</span></strong>"; ?></p>
                                
                                <p data-toggle='tool-tip' data-placement='bottom' title='Jabatan'><i class="fa fa-line-chart"></i>&nbsp; <?php echo "<strong><span class=\"text-warning\">$najabl</span></strong>"; ?></p>
                                
                                <p data-toggle='tool-tip' data-placement='bottom' title='Lokasi Gaji'><i class="fa fa-money"></i>&nbsp; <?php echo "<strong><span class=\"text-navy\">$naklogad</span></strong>"; ?></p>
                                
                                </address>
                            </div>

                            <div class="col-md-5">
                                 <address style="font-size:10px;">
                                
                                <p data-toggle='tool-tip' data-placement='bottom' title='No. Telp'><i class="fa fa-phone"></i>&nbsp; <?php echo "<strong><span class=\"text-success\">$notelp</span></strong>"; ?></p>
                                
                                <p data-toggle='tool-tip' data-placement='bottom' title='No. HP'><i class="fa fa-mobile"></i>&nbsp; <?php echo "<strong><span class=\"text-danger\">$nohp</span></strong>"; ?></p>
                                
                                <p data-toggle='tool-tip' data-placement='bottom' title='Email'><i class="fa fa-at"></i>&nbsp; <?php echo "<strong><span class=\"text-primary\">$email </span></strong>"; ?></p>
                                
                                <p data-toggle='tool-tip' data-placement='bottom' title='Alamat Domisili'><i class="fa fa-home"></i>&nbsp; 
                                <?php 
                                    if($alamat !='' && $rt!='' && $rw!='' && $nacam!='' && $nawil!='' && $nakel!='' && $prop!='' )
                                    {

                                    
                                    echo "<strong><span class=\"text-info\">".$alamat." RT-".$rt." RW-".$rw."<br/>  &nbsp;&nbsp;&nbsp;&nbsp; KELURAHAN ".$nakel."<br/> &nbsp;&nbsp;&nbsp;&nbsp; KECAMATAN ".$nacam."<br/> &nbsp;&nbsp;&nbsp; ".$nawil." - ".$prop."</span></strong>"; 
                                    }
                                ?></p>
                                <p>&nbsp;</p>
                                </address>   
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        
            <?php 
                if(isset($bawahan)){ 
                    if($bawahan != ""){ 
            ?>
            <div class="col-md-3">
                <div class="ibox float-e-margins animated fadeInUp struktur-content" id="struktur-content">

                    <div class="ibox-title">
                        <h3>Struktur Pegawai</h3>
                        
                        <div class="form-group" id="data_4">
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="monthyear" onchange="return setMonthYear();" placeholder="Bulan Tahun" class="form-control" value="<?php echo $thbl; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content" id="struktur2-content">                        
                        <div class="user-friends tooltip-demo">
                            <div class="" id="list_bawahan">
                                <?php echo isset($bawahan) ? $bawahan : ""; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                    } else {
                        echo '<input type="hidden" id="monthyear" placeholder="Bulan Tahun" class="form-control" value="'.$thbl.'">';
                    }
                }
            ?>
        
        <div class="col-md-12">
            <!-- START HISTORY -->
            <div class="ibox float-e-margins animated fadeInRight">
                <div class="ibox-title">
                    <div class="row">
                        <div style="margin-top:5px;margin-left:2px">                            
                            <div class="col-md-5 form-group">                        
                                <select name="riwayat_list2[]" multiple="multiple" id="riwayat_list2" class="form-control" style="display: none;">
                                        <optgroup label="Pilih Jenis Riwayat Pegawai Yang Akan Ditampilkan">
<!--
                                            <option onClick='pilih()' >&nbsp; Pilih Semua</option>
-->
                                            <?php echo $menu_select; ?>
                                        </optgroup>                                                   
                                </select>                                
                                <span class="help-block m-b-none"><u><i>Pilih jenis riwayat yang akan ditampilkan.</i></u></span>
                            </div>
                            <div class="col-md-1 form-group">
                                <button class="btn btn-primary btn-sm" id="btnRiwayat" type="button">Tampilkan</button>
                            </div>
                            <!-- <div class="col-md-5 form-group">
                                <select name="riwayat_list" id="riwayat_list" data-placeholder="--- Pilih Riwayat ---" class="form-control chosen-select" tabindex="2">
                                    <option value=""></option>
                                    <option value=""></option>
                                    <?php //echo $menu_select; ?>
                                </select>       
                                <span class="help-block m-b-none"><u><i>Pilih jenis riwayat yang akan ditampilkan.</i></u></span>
                            </div> -->
                            
                        </div>
                    </div>                    
                </div>
                <div class="ibox-content">
                    <input type="hidden" id="checkproses" value="1">
                    
                    <div  id="content_riwayat" class="content_riwayat">
                        
                    </div>
                </div>
            </div>
            <!-- END HISTORY -->
        </div>        
    </div>    

<?php } ?>

	<!-- <div id="container">	
		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php //echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div> -->
</div>

<div id="small-chat" style="display:none">
    <form style="display:none" method="POST" id="form_<?php echo $nrkatasan; ?>">
        <input type="hidden" name="nrk" id="nrk_<?php echo $nrkatasan; ?>" value="<?php echo $nrkatasan; ?>">
        <input type="hidden" class="thblBack" name="thbl" id="thbl_<?php echo $nrkatasan; ?>" value="<?php echo $thbl; ?>">
    </form>

    <!-- <a class="open-small-chat" title="Kembali" onClick="getProfile('<?php echo $nrkatasan; ?>');">
        <i class="fa fa-step-backward"></i>
    </a> -->
    <a class="open-small-chat" title="Kembali" onClick="history.back();">
        <i class="fa fa-step-backward"></i>
    </a>
    <?php if(isset($showBackPokok)){ ?>
        <?php if($showBackPokok != "none"){ ?>
            <form style="display:none" method="POST" action="<?php echo base_url(); ?>index.php/hist/datapokok" id="form_<?php echo $nrk; ?>">
                <input type="hidden" name="nrk" id="nrk_<?php echo $nrk; ?>" value="<?php echo $nrk; ?>">
                <input type="hidden" name="tglpilih" id="tglpilih_<?php echo $nrk; ?>" value="<?php echo $thbl; ?>">
                <input type="hidden" name="spmu" id="spmu_<?php echo $nrk; ?>" value="<?php echo $spmu; ?>">
            </form>
            <a class="open-small-chat" title="Kembali" onClick="getProfile('<?php echo $nrk; ?>');">
                <i class="fa fa-fast-backward"></i>
            </a>
        <?php } ?>
    <?php } ?>
</div>


<!-- Start Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div id="widthForm" class="modal-dialog modal-lg" role="document">
    <div class="modal-content animated fadeInUp" id="modal_content">
        
    </div>
  </div>
</div>
<!-- End Modal -->


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

        <!-- Multiple Select -->
        <script src="<?php echo base_url(); ?>assets/js/plugins/multipleselect/jquery.multiselect.js"></script>
        <!-- Multiple Select -->
        
        <script>
            $('select[multiple]').multiselect({
                columns: 1,            
                placeholder: '--- Pilih Riwayat ---',
                selectAll: true
            });
            
            $('a.ms-selectall').text('Pilih Semua');
            $('a.ms-selectall').click(function(){
                var value = $(this).text();
                if(value == 'Pilih Semua'){
                    $(this).text('Batal Pilih');
                }else{
                    $(this).text('Pilih Semua');
                }
            })
        </script>

        <script type="text/javascript">
            $('#ms-opt-1').click(function(){
                //var checkboxes = $('input[type=checkbox]');
                //var test = checkboxes.prop('checked', $(this).is(':checked'));
                //console.log(test)
            })
        </script>


        <script type="text/javascript">
            $(document).ready(function(){

               /* var msg = "<?php// echo $this->session->userdata('referred_from'); ?>";
                alert (msg);
                
        if (msg !=1){
            location.reload();
        }*/

                $('#data_1 .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy"
                }); 
                
            });
        </script>

        <script type="text/javascript">

            $('.dataTables-example').dataTable({
                responsive: true,                
                // "dom": 'T<"clear">lfrtip',
                // "tableTools": {
                //     "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                // }
            });

           /* $(document).ready(function(){
                $( "#riwayat_list" ).change(function(event) {
                    event.preventDefault();

                    $.ajax({
                        url: "riwayat/generateRiwayat",
                        type: "post",
                        data: {nrk:$("#nrkP").val(), id_riwayat:$("#riwayat_list").val()},
                        dataType: 'json',
                        beforeSend: function() {
                            $('#_content_riwayat').removeAttr('class').attr('class', '');
                            var animation = 'fadeOutDown';
                            $('#_content_riwayat').addClass('animated');
                            $('#_content_riwayat').addClass(animation);
                            $('#cekTMT').hide();
                            // return false;
                            $('#content_riwayat').html('<div><img src="<?php echo base_url() ?>assets/inspinia/img/loading_bar.gif"></div>');
                            $('#checkproses').val('0');
                        },
                        success: function(data) {                                                                     
                            if(data.response == 'SUKSES'){
                                 $("#content_riwayat").html(data.result);
                                 $('#checkproses').val('1');
                            }
                          
                            else{
                                 $("#content_riwayat").html('');
                                 $('#checkproses').val('0');
                            }
                        },
                        error: function(xhr) {                              
                            if($('#checkproses').val() == 0){
                                $("#content_riwayat").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        },
                        complete: function() {
                            $('.dataTables-example').dataTable({
                                // responsive: true,
                                "destroy" : true,
                                "scrollX": true
                            });

                            if($('#checkproses').val() == 0){
                                $("#content_riwayat").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        }
                    });
                });
            });   */      


            $(document).ready(function(){
                var today = new Date();
                var dd    = today.getDate();
                var mm    = ("0" + (today.getMonth() + 1)).slice(-2); 
                var yyyy  = today.getFullYear(); 

                    $('#data_4 .input-group.date').datepicker({
                                changeyear: false,
                                minViewMode: 1,
                                keyboardNavigation: false,
                                forceParse: false,
                                autoclose: true,
                                todayHighlight: true,
                                // format: 'yyyy-mm-dd'
                                format: 'M yyyy'
                            });

                    $("#tglpilih").unbind('change');        

            });

            $(function(){
              $('#btnRiwayat').click(function(event){
                event.preventDefault();
                var nrkP = $("#nrkP").val(); 
                var val = [];
                var timer = 0;
                $('#content_riwayat').html(''); //reset riwayat
               // $("input[type=checkbox]:checked").each ( function(i) {
                $(':checkbox:checked').each(function(i){
                    val[i] = $(this).val();
                    //alert($(this).val());

                    if(val[i]!='on')
                    {
                        setTimeout(function(){ //DELAY
                        $('#content_riwayat').append('<div  id="content_riwayat_'+val[i]+'" class="">');
                        getListRiwayat(nrkP, val[i]);
                        }, timer);

                        timer = timer + 750;                        
                    }
                    
                });
              });
            });

            function getListRiwayat(a,b){
                $.ajax({
                    url: "riwayat/generateRiwayat",
                    type: "post",
                    data: {nrk:a, id_riwayat:b},
                    dataType: 'json',
                    beforeSend: function() {
                        // $('#_content_riwayat_'+b).removeAttr('class').attr('class', '');
                        // var animation = 'fadeOutDown';
                        // $('#_content_riwayat_'+b).addClass('animated');
                        // $('#_content_riwayat_'+b).addClass(animation);
                        // return false;
                        $('#content_riwayat_'+b).html('<div class="animated fadeInRight"><img src="<?php echo base_url() ?>assets/inspinia/img/loading_bar.gif"></div>');
                        $('#checkproses').val('0');
                    },
                    success: function(data) {                                                                     
                        if(data.response == 'SUKSES'){
                             $("#content_riwayat_"+b).html(data.result);
                             $('#checkproses').val('1');
                        }else{
                             $("#content_riwayat_"+b).html('');
                             $('#checkproses').val('0');
                        }
                    },
                    error: function(xhr) {                              
                        if($('#checkproses').val() == 0){
                            $("#content_riwayat_"+b).html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                        }
                    },
                    complete: function() {
                        $('.dataTables-example').dataTable({
                            // responsive: true,
                            "destroy" : true,
                            "scrollX": true
                        });

                        if($('#checkproses').val() == 0){
                            $("#content_riwayat_"+b).html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                        }
                    }
                });
            }

            function getProfile(nrk){
                $("#thbl_"+nrk).val($("#monthyear").val());
                $("#form_"+nrk).submit();
            }

            function getForm(form,action,key1,key2,key3,key4){
                save_method = action;
                
                $.ajax({
                    url: "riwayat/generateForm",
                    type: "post",
                    data: {form:form,nrk:$('#nrkP').val(),action:action,key1:key1,key2:key2,key3:key3,key4:key4},
                    dataType: 'json',
                    beforeSend: function() {
                        $('#myModal').modal('toggle');
                        $("#modal_content").html('<div class="sk-spinner sk-spinner-three-bounce" style="width:110px;"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div></div>');
                    },
                    success: function(data) {            
                        if(data.response == 'SUKSES'){
                            $("#modal_content").html(data.result);

                            if(data.widthForm == 'one'){
                                $('#widthForm').removeAttr('class').attr('class', '');                                
                                $('#widthForm').addClass('modal-dialog');
                            }else{
                                $('#widthForm').removeAttr('class').attr('class', '');
                                $('#widthForm').addClass('modal-dialog');
                                $('#widthForm').addClass('modal-lg');                                
                            }

                        }else{
                            $("#modal_content").html('');
                        }
                    },
                    error: function(xhr) {                              
                        $('#myModal').modal('hide');  
                    },
                    complete: function() {
                                                
                    }
                });
                if(form == 'keluarga_2')
                {
                    $('#stattun').trigger('chosen:updated');
                }

            }

            function setMonthYear(){                
                
                $.ajax({
                    url: "riwayat/generateStrukturPegawai",
                    type: "post",
                    data: {nrk:$("#nrkP").val(), thbl:$("#monthyear").val()},
                    dataType: 'json',
                    beforeSend: function() {
                        $('#list_bawahan').removeAttr('class').attr('class', '');
                        var animation = 'fadeOutDown';
                        $('#list_bawahan').addClass('animated');
                        $('#list_bawahan').addClass(animation);
                        // return false;
                    },
                    success: function(data) {                                                                     
                        if(data.response == 'SUKSES'){                             
                             if(data.result == ""){
                                $("#list_bawahan").html("<small class='text-navy'>Bawahan Tidak Ditemukan</small>");
                             }else{
                                $("#list_bawahan").html(data.result);
                             }
                        }else{
                            $("#list_bawahan").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                        }
                    },
                    error: function(xhr) {                              
                        $("#list_bawahan").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                    },
                    complete: function() {
                        $('#list_bawahan').removeAttr('class').attr('class', '');
                        var animation = 'fadeInUp';
                        $('#list_bawahan').addClass('animated');
                        $('#list_bawahan').addClass(animation);
                    }
                });


            }

            function reload()
            {
                //event.preventDefault();
                var nrkP = $("#nrkP").val();
                var val = [];
                var timer = 0;
                $('#content_riwayat').html(''); //reset riwayat
                $(':checkbox:checked').each(function(i){
                    val[i] = $(this).val();
                    //console.log(val[i]);
                    if(val[i]!='on')
                    {
                        setTimeout(function(){ //DELAY
                        $('#content_riwayat').append('<div  id="content_riwayat_'+val[i]+'" class="">');
                        getListRiwayat(nrkP, val[i]);
                        }, timer);

                        timer = timer + 750;    
                    }
                    
                });

//                $.ajax({
//                        url: "riwayat/generateRiwayat",
//                        type: "post",
//                        data: {nrk:$("#nrkP").val(), id_riwayat:$("#riwayat_list2").val()},
//                        dataType: 'json',
//                        beforeSend: function() {
//                            $('#_content_riwayat').removeAttr('class').attr('class', '');
//                            var animation = 'fadeOutDown';
//                            $('#_content_riwayat').addClass('animated');
//                            $('#_content_riwayat').addClass(animation);
////                             return false;
//                            $('#content_riwayat').html('<div><img src="<?php //echo base_url() ?>//assets/inspinia/img/loading_bar.gif"></div>');
//                            $('#checkproses').val('0');
//
//                            //$('#content_riwayat_'+b).html('<div class="animated fadeInRight"><img src="<?php //echo base_url() ?>//assets/inspinia/img/loading_bar.gif"></div>');
//                            //$('#checkproses').val('0');
//
//                        },
//                        success: function(data) {
//                            if(data.response == 'SUKSES'){
//                                 $("#content_riwayat").html(data.result);
////                                 $("#content_riwayat_"+b).html(data.result);
//                                 $('#checkproses').val('1');
//                            }else{
//                                 $("#content_riwayat").html('');
//                               //  $("#content_riwayat_"+b).html('');
//                                 $('#checkproses').val('0');
//                            }
//                        },
//                        error: function(xhr) {
//                            if($('#checkproses').val() == 0){
//                                $("#content_riwayat").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
////                                $("#content_riwayat_"+b).html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
//                            }
//                        },
//                        complete: function() {
//                            $('.dataTables-example').dataTable({
//                                // responsive: true,
//                                "destroy" : true,
//                                "scrollX": true
//                            });
//
//                            if($('#checkproses').val() == 0){
//                                $("#content_riwayat").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
////                                 $("#content_riwayat_"+b).html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
//                            }
//                        }
//                    });
            }

            function confirmHapusData(dest,key1,key2,key3,key4){
                /*START SWEETALERT*/                
                    swal({
                        title: "Anda yakin hapus data ini?",                        
                        text: "Data tidak akan dapat dikembalikan setelah dihapus!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonColor: "#F8AC59",
                        cancelButtonText: "Tidak, batalkan!",
                        closeOnConfirm: false
                    }, function (isConfirm) {
                        if (isConfirm) {
                            rslt = hapusDataP(dest,key1,key2,key3,key4);                            
                        }                         
                    });               
                /*END SWEETALERT*/
            }

            function confirmHapusDataFlag(dest,key1,key2,key3,key4){
                /*START SWEETALERT*/                
                    swal({
                        title: "Anda yakin hapus data ini?",                        
                        text: "Data tidak akan dapat dikembalikan setelah dihapus!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonColor: "#F8AC59",
                        cancelButtonText: "Tidak, batalkan!",
                        closeOnConfirm: false
                    }, function (isConfirm) {
                        if (isConfirm) {
                            rslt = hapusData(dest,key1,key2,key3,key4);                            
                        }                         
                    });               
                /*END SWEETALERT*/
            }

            function hapusData(dest,key1,key2,key3,key4){
                var result = 0;

                $.ajax({
                    url: '<?php echo base_url("index.php/riwayat/hapusHist"); ?>',
                    type: "post",
                    data: {destination:dest, action:'hapus_flag',key1:key1,key2:key2,key3:key3,key4:key4},
                    dataType: 'json',
                    beforeSend: function() {
                        
                    },
                    success: function(data) {                                                                     
                        if(data.response == 'SUKSES'){                    
                            swal("Hapus!", "Data berhasil dihapus.", "success");    
                            reload();
                        }else{
                            swal("Gagal!", "Data gagal dihapus.", "error");                            
                        }
                    },
                    error: function(xhr) {                              
                        swal("Gagal!", "Data gagal dihapus.", "error");
                    },
                    complete: function() {
                                                
                    }
                });

                return result;
            }

            function hapusDataP(dest,key1,key2,key3,key4){
                var result = 0;

                $.ajax({
                    url: '<?php echo base_url("index.php/riwayat/hapusHist"); ?>',
                    type: "post",
                    data: {destination:dest, action:'hapus',key1:key1,key2:key2,key3:key3,key4:key4},
                    dataType: 'json',
                    beforeSend: function() {
                        
                    },
                    success: function(data) {                                                                     
                        if(data.response == 'SUKSES'){                    
                            swal("Hapus!", "Data berhasil dihapus.", "success");    
                            reload();
                        }else{
                            swal("Gagal!", "Data gagal dihapus.", "error");                            
                        }
                    },
                    error: function(xhr) {                              
                        swal("Gagal!", "Data gagal dihapus.", "error");
                    },
                    complete: function() {
                                                
                    }
                });

                return result;
            }
            
            /*START CHOSEN*/
            var config = {
              '.chosen-select'           : {no_results_text:'Oops, Data Tidak Ditemukan'}              
            }
            for (var selector in config) {
              $(selector).chosen(config[selector]);
            }
            /*END CHOSEN*/
        </script>

