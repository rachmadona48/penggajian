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

        .panel, .ibox2{
          text-decoration: none;
          outline: none;                
          border: none;
          border-radius: 5px;
          box-shadow: 2px 2px 3px 3px #999;  
        }  

        .ibox3{
          text-decoration: none;
          outline: none;                
          border: none;
          border-radius: 5px;
          box-shadow: 1px 1px 3px 3px #999;  
        }      

        .input-group-addon{
            background-color: #1ab394 !important;
            color: #fff !important;
        }

         #ibox_bkd .ibox-content{
            padding: 15px 20px 0px 20px !important;
        }        
                

        /*Tampilkan pencarian di tampilan phone*/
        @media screen and (min-width: 770px){
            div#forPhone{
                display: none;
            }
        }        

    </style>


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Riwayat</h2>
        <ol class="breadcrumb">                
            <li class="active">
                <strong>TKD Statis - Dinamis (Tahap I dan II)</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content">
<?php if($user_group > 1){ ?>
    <div class="row" id="">
        <div class="col-md-12">
            <div id="ibox_bkd" class="ibox ibox2 float-e-margins animated fadeInRightBig">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-4">
                            <form id="form_4bkd" method="POST">
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
        <div class="col-md-12">
            <div class="ibox ibox2 float-e-margins animated fadeInDown">                
                <div>
                 <div class="ibox-content profile-content">
                    <div class="row">
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
                                        $talhir = $infoUser->TALHIR;
                                        $nama = $infoUser->NAMA;

                                        if(file_exists($linkImg)){
                                            $img = base_url()."assets/img/photo/".$infoUser->NRK.".jpg";                                    
                                        }else{
                                            $img = base_url()."assets/img/photo/profile_small.jpg";
                                        }

                                    }else{                                        
                                        $nrk = "";    
                                        $nip18 = "";
                                        $pathir = "";
                                        $talhir = "";                                    
                                        $nama = "";
                                        $img = base_url()."assets/img/photo/profile_small.jpg";                                    
                                    }
                                                                    
                                ?>
                                <img alt="image" class="img-circle m-t-xs img-responsive" src="<?php echo $img; ?>" width="68px" height="68px">                            
                            </div>
                        </div>
                        <div class="col-sm-11">
                            <p><b><?php echo "<strong><a class=\"text-navy\"> $nama </a></strong>"; ?></b></p>
                            <address style="font-size:10px;">
                            <p><i class="fa fa-credit-card"></i> <?php echo "<strong><a class=\"text-success\">".$nrk." - ".$nip18." </a></strong>"; ?></p>
                            <p><i class="fa fa-map-marker"></i> <?php echo "<strong><a class=\"text-danger\">$pathir, $talhir </a></strong>"; ?></p>
                            <p><i class="fa fa-map-marker"></i> <?php echo "<strong><a class=\"text-success\">".$infoUser->NALOKL."</a></strong>"; ?></p>                            
                            </address>
                        </div> 

                        <div class="col-sm-12">
                            <?php if(isset($tahap1)){ ?>
                            <!-- START HISTORY -->
                            <div class="ibox ibox3 float-e-margins animated fadeInDown">
                                <div class="ibox-title">
                                    <div class="ibox-title navy-bg">
                                        <h5>TKD Statis dan Dinamis Periode Januari s/d Maret Tahun 2015</h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>                            
                                        </div>
                                    </div>                   
                                </div>
                                <div class="ibox-content">
                                    <input type="hidden" id="checkproses" value="1">
                                    <div  id="content_riwayat" class="">
                                        <?php echo $tahap1; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- END HISTORY -->
                            <?php } ?>
                            <?php if(isset($tahap2)){ ?>
                            <!-- START HISTORY -->
                            <div class="ibox ibox3 float-e-margins animated fadeInDown">
                                <div class="ibox-title">
                                    <div class="ibox-title navy-bg">
                                        <h5>TKD Tahap I dan II Periode April s/d Des Tahun 2015</h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>                            
                                        </div>
                                    </div>                   
                                </div>
                                <div class="ibox-content">
                                    <input type="hidden" id="checkproses" value="1">
                                    <div  id="content_riwayat" class="">
                                        <?php echo $tahap2; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- END HISTORY -->
                            <?php } ?>
                            <?php if(isset($tkdguru)){ ?>
                            <!-- START HISTORY -->
                            <div class="ibox ibox3 float-e-margins animated fadeInDown">
                                <div class="ibox-title">
                                    <div class="ibox-title navy-bg">
                                        <h5>TKD GURU Periode Juli s/d Des Tahun 2015</h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>                            
                                        </div>
                                    </div>                   
                                </div>
                                <div class="ibox-content">
                                    <input type="hidden" id="checkproses" value="1">
                                    <div  id="content_riwayat" class="">
                                        <?php echo $tkdguru; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- END HISTORY -->
                            <?php } ?>
                            <?php if(isset($gapok)){ ?>
                            <!-- START HISTORY -->
                            <div class="ibox ibox3 float-e-margins animated fadeInDown">
                                <div class="ibox-title">
                                    <div class="ibox-title navy-bg">
                                        <h5>Gaji Jan s/d Des Tahun 2015</h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>                            
                                        </div>
                                    </div>                   
                                </div>
                                <div class="ibox-content">
                                    <input type="hidden" id="checkproses" value="1">
                                    <div  id="content_riwayat" class="">
                                        <?php echo $gapok; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- END HISTORY -->
                            <?php } ?>
                        </div>
                    </div>
                 </div>
                </div>
            </div>                    
        </div>            
    </div>    

<?php } ?>

	<!-- <div id="container">	
		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php //echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div> -->
</div>


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

        
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/chosen/chosen.jquery.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/inspinia.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/pace/pace.min.js"></script>
        <!-- Custom and plugin javascript -->   

        <!-- Input Mask-->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/jasny/jasny-bootstrap.min.js"></script>        

        <script type="text/javascript">

            $('.dataTables-example').dataTable({
                responsive: true,                
                // "dom": 'T<"clear">lfrtip',
                // "tableTools": {
                //     "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                // }
            });

            $(document).ready(function(){
                
            });            


            function getProfile(nrk){
                $("#thbl_"+nrk).val($("#monthyear").val());
                $("#form_"+nrk).submit();
            }            
        </script>

