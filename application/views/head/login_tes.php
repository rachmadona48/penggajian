<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/logodki.png"/>
    <title>Sistem Kepegawaian DKI</title>
    <link href="<?php echo base_url(); ?>assets/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/inspinia/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/inspinia/boostrapvalidator/css/bootstrapValidator.css"/>
    <link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/js/jquery-2.1.1.js"></script>
    <style>
        /*button{
            position:absolute;
            top:10px;
            left:10px;
        }​*/
        @media (max-width: 500px) {
            .bg{
                margin-left: 0 !important;
                margin-right: auto !important;
            }
            .bg img{
                margin-top: -13px !important;
                width: 100% !important;
                height: auto !important;
                border-radius: 5px !important;
            }
        }
        .loginColumns{
            padding: 20px 20px 20px;
        }
        .bg{
            margin-left: 20%;
            margin-right: auto;
        }
        .bg img{
            margin-top: -13px;
            max-width: 800px;
            border-radius: 5px;
        }

        

       

        

        @media (max-width: 1920px) {
           
            #hd img{
                
                width: 760px !important;
                height: auto !important;
                
            }
        }

        @media (max-width: 1280px) {
           
            #hd img{
                
                width: 760px !important;
                height: auto !important;
                
            }
        }

        @media (max-width: 1024px) {
           
            #hd img{
                
                width: 760px !important;
                height: auto !important;
                
            }
        }

        @media (max-width: 700px) {
           
            #hd img{
                
                width: 600px !important;
                height: auto !important;
                
            }
        }

        @media (max-width: 480px) {
           
            #hd img{
                
                width: 320px !important;
                height: auto !important;
                
            }
        }

        @media (max-width: 360px) {
           
            #hd img{
                
                width: 280px !important;
                height: auto !important;
                
            }
        }
    </style>
    <script type="text/javascript">
        /*$(document).ready(function(){
            $("button").on('mouseover',function(){
                $(this).css({
                    left:(Math.random()*Math.random()*200)+"px",
                    top:(Math.random()*200+1*20-Math.random())+"px",
                    position: absolute
                });
            });
            $("button").on('click',function(){
                $(this).css({
                    left:(Math.random()*Math.random()*200)+"px",
                    top:(Math.random()*200+1*20-Math.random())+"px",
                    position: absolute
                });
            });
        })*/
        // $.get("http://ipinfo.io", function(response) {
            // alert(response.ip);
            // if(response.ip != '118.97.66.2' || !response.ip)
            //     $('body').html('');
        // }, "jsonp");
    </script>
</head>
<body class="gray-bg">
    <div class="bg">
        <!-- <img src="http://bkddki.jakarta.go.id/templates/ja_purity_ii/images/header_488.png"> -->
        
    </div>
    <div class="loginColumns animated fadeInDown">
        <div class="row">
            <div class="col-md-12" id="hd"> 
                <!-- <img src="<?php //echo base_url()?>assets/img/header_simpeg2.png"> -->
                <img src="<?php echo base_url()?>assets/img/20171.png">
            </div>
            <div class="col-md-5">
                <div class="ibox float-e-margins">
                              
                        <h3>Selamat Datang di PEGAWAIDEV</h3>
                    
                    <div class="ibox-content" style="height:50%">
                        <h3 class="font-bold text-navy">Sistem Informasi Manajemen Kepegawaian (SIMPEG)</h3>
                        <p align="justify">
                            adalah Sistem Informasi yang dirancang untuk menangani berbagai hal dalam pengurusan kepegawaian mulai dari pengisian, pengolahan dan pemusatan data secara terkomputerisasi sehingga dapat menangani berbagai laporan yang berhubungan dengan kepegawaian. 
                        </p>
                        <p align="justify">
                           Simpeg ini dapat diakses menggunakan internet sehingga dapat lebih mudah diakses dan memudahkan dalam proses administrasi kepegawaian.
                        </p>
                        
                        <form action="<?php echo base_url('Login_api/cek_tes');?>" method="POST" class="form-horizontal" role="form" name="login" >
                             <div class="form-group">                            
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" name="username" placeholder="NRK" id="nrk"/>
                                </div>
                            </div>                        
                           <!--  <div class="form-group">                            
                                <div class="col-lg-12">
                                    <input type="password" class="form-control" name="password" placeholder="Password"/>
                                </div>
                            </div>   -->         

                            <div class="form-group">
                                <div class="col-lg-12">
                    <!-- <p id="captcha_img"><?=  $image;?></p> -->
                    <!-- <a href="#" onclick="reload_captcha()">Reload Captcha</a> -->
                    <!-- <label class="sr-only" for="">Captcha</label>
                    <input type="text" id="security_code" name="security_code" placeholder="Ketik isi captcha" class="form-control"> -->
                </div>
                  </div>                      
    
                            <div class="form-group">
                                <div class="col-lg-12">                                
                                    <button type="submit" class="btn btn-primary block full-width m-b" id="login-btn">Login</button>                                
                                </div>
                            </div>                        
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="widget style1">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h2 class="font-bold animated bounce">Pengumuman</h2>
                        </div>
                    </div>
                </div>
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1">Informasi &nbsp;
                        <?php if($ctInfo->TGBARU<=7 && $ctInfo->TGBARU !=null){ ?>
                        <span class="label label-danger">NEW</span>
                        <?php } ?>
                        </a></li>
                        
                        <li class=""><a data-toggle="tab" href="#tab-2" >Berita Terbaru &nbsp;
                        <?php if( $ctNews->TGBARU<=7 && $ctNews->TGBARU !=null){ ?>
                        <span class="label label-danger" >NEW</span>
                        <?php } ?>
                        </a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body" id="pan1">
                                <?php
                                foreach($isiInformasiBaru as $row)
                                {
                                    echo "<b><i><font color='#1ab394'>( ".$row->TGL_UPDATE." )</font></i></b><br/>";
                                    echo "<b><font color='#ff0000'>".$row->BERITA." </font></b>";
                                    
                                    echo "<hr/>";

                                }

                                foreach($isiInformasi as $row)
                                {
                                    echo "<b><i><font color='#1ab394'>( ".$row->TGL_UPDATE." )</font></i></b><br/>";
                                    echo "<font color='#000000'>".$row->BERITA."</font>";
                                    
                                    echo "<hr/>";
                                }
                                ?>
                            </div>

                         

                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body" id="pan2">
                                <?php
                                foreach($isiInformasi2 as $row)
                                {
                                    echo "<b><i><font color='#1ab394'>( ".$row->TGL_UPDATE." )</font></i></b><br/>";
                                    echo $row->BERITA;
                                     echo "<hr/>";
                                }
                                ?>
                                
                            </div>

                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                
            </div>
            <div class="col-md-6 text-right">
               Copyright <strong>BKD Pemprov DKI Jakarta</strong><small> © <?php echo date('Y')?><br/>Jalan Merdeka Selatan Kav 8-9 Gedung Balaikota Lantai 20 dan 21 Jakarta</small>
            </div>
        </div>
    </div>

       <?php if($cekbanner>0) { ?>
<!-- BANNER -->
 <div class="modal inmodal fade" id="myModalFoto" tabindex="-2" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-12">

                        <img src="assets/img/banner/<?php echo $banner->BERITA; ?>" width="100%" height="auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
<?php } ?>
	
<!-- BANNER -->
<!--  <div class="modal inmodal fade" id="myModalFoto" tabindex="-2" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <img src="assets/img/solo.jpg" width="100%" height="auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  --> 

</body>
</html>


<!-- Mainly scripts -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/bootstrap.min.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/boostrapvalidator/js/bootstrapValidator.js"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib-1.0.0.js"></script>-->


        <script type="text/javascript">

    $(document).ready(function() {
       // $('#myModalFoto').modal('show');
    });           
            
            
           $(function() {
                
                $("#defaultForm").on("submit", function(e) {
					e.preventDefault();
                    alert('ssss');
					//var cresponse = grecaptcha.getResponse();
					var username = $('input[name=username]').val();
					// var password = $('input[name=password]').val();
                    // var security_code = $('input[name=security_code]').val();
					//if(!cresponse || !username || !password){
     //                if(!username || !password){
     //                    swal("Error!", "Lengkapi data!", "error");
					// 	return false;
					// }
                    // else if(!security_code)
                    // {
                    //     swal("Error!", "Isi Captcha!", "error");

                    //     return false;
                        
                    }else{
						var url = '<?php echo base_url(); ?>index.php/Login_api/cek_tes';
						$.ajax({
			                url: url,
			                type: 'POST',
			                data: {
			                    username: username
                                // , password: password,security_code:security_code
                                //captcha_response: cresponse
			                },
			                dataType: 'json',
			                crossDomain: true,
			                success: function(data){
								if(data.response == 'gagal'){
									swal("Error!", data.error_message, "error");
								}else{
									$(location).attr('href', data.url_redirect);
								}
			                    // console.log(data);
			                }
			            })
					}
                    //~event.preventDefault();
                    //~var sc = "6Le69SATAAAAAMwL-pjJpnKJXKIVCkbf-ogswIcC";
                    //~var gresponse = grecaptcha.getResponse();
                    //~$.ajax({
		                //~url: 'https://www.google.com/recaptcha/api/siteverify?secret=' + sc + '&response=' + gresponse,
		                //~type: 'POST',
		                //~data: {
		                    //~ID_TRX: id_trx, NO_SURAT_SKPD: no_surat, TGL_SURAT_SKPD: tgl_surat
		                //~},
		                //~dataType: 'jsonp',
		                //~crossDomain: true,
		                //~success: function(data){
		                    //~console.log(data);
		                //~}
		            //~})
                    //~var response = $('input[name=g-recaptcha-response]').val();
                    //~console.log(response);
                    //~console.log($(this).serialize());
                });
            });
        </script>

        <!-- block UI -->
        <script src="<?php echo base_url(); ?>assets/inspinia/blockui/jquery.blockUI.js"></script>
        <!-- block UI -->

        <script type="text/javascript">

  //           function reload_captcha(){
  //   $.ajax({
  //     type:"GET",
  //     url: "<?=site_url('login/load_captcha/1')?>",
  //     success: function(img){
  //       $("#captcha_img").html(img);
  //     },
  //     error: function(){
  //       alert("some error occured");
  //     }
  //   });
  // }
           /* check_url();
            function check_url(){
                //console.log(window.location.pathname);
                var pathname = window.location.pathname;
                if(pathname == '/index.php/login/logout' || pathname == '/login/logout'){
                    window.location.replace('http://simpegdev.jakarta.go.id');
                    //console.log('True')
                }
            }*/
            // $(document).ready(function() { 
                
            //         $.blockUI({                         
            //             message: '<img src="<?php echo base_url(); ?>assets/inspinia/img/galaxy.gif" width="90px" height="60px"/> </br></br>Please Wait...', 
            //             css: { 
            //                 border: 'none', 
            //                 padding: '10px', 
            //                 fontSize:'17px',
            //                 backgroundColor: '#000', 
            //                 '-webkit-border-radius': '10px', 
            //                 '-moz-border-radius': '10px', 
            //                 'border-radius': '10px', 
            //                 opacity: .5, 
            //                 color: '#fff' 
            //             } 
            //         }); 
             
                    
            //         $(window).load(function(){
            //             $.unblockUI();
            //         });

            // }); 

        </script>
