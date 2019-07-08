<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/tes2.png"/>
    <title>Sistem Kepegawaian DKI</title>
    <link href="<?php echo base_url(); ?>assets/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/inspinia/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/inspinia/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/inspinia/boostrapvalidator/css/bootstrapValidator.css"/>
    <link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    
    <style>
        @media (max-width: 500px) {
            /*.bg{
                margin-left: 0 !important;
                margin-right: auto !important;
            }
            .bg img{
                margin-top: -13px !important;
                width: 100% !important;
                height: auto !important;
                border-radius: 5px !important;
            }*/
        }
        .loginColumns{
            padding: 20px 20px 20px;
        }
        /*.bg{
            display: block;
            margin: 0 auto;
        }
        .bg img{
            display: block;
            margin: 0 auto;
            margin-top: -13px;
            max-width: 800px;
            border-radius: 5px;
        }*/
    </style>
</head>
<body class="gray-bg">
    <div class="bg">
        <img src="http://bkddki.jakarta.go.id/templates/ja_purity_ii/images/header_488.png">
    </div>
    <div class="loginColumns animated fadeInDown">
        <div class="row">
            <div class="col-md-5">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Selamat Datang di aplikasi Kepegawaian (Simpeg)</h5>
                    </div>
                    <div class="ibox-content">
                        <h3 class="font-bold text-navy">Urusan Kepegawaian</h3>
                        <p>
                            Merupakan aplikasi yang di design khusus untuk melakukan kolaborasi (terintegrasi) proses antar bidang di lingkungan Badan Kepegawaian Daerah
                        </p>
                        <p>
                            Pada aplikasi tersedia seluruh fitur yang akan digunakan dalam melaksanakan tata kelola kepegawaian di lingkungan Pemerintah Provinsi DKI Jakarta.
                        </p><br/>
                        <form id="defaultForm" method="POST" class="form-horizontal" role="form" name="login" action="<?php echo base_url('index.php/login/cek') ?>">
                             <div class="form-group">                            
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" name="username" placeholder="NRK" id="nrk"/>
                                </div>
                            </div>                        
                            <div class="form-group">                            
                                <div class="col-lg-12">
                                    <input type="password" class="form-control" name="password" placeholder="Password"/>
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
                        <li class="active"><a data-toggle="tab" href="#tab-1"> This is tab</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2">This is second tab</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <strong>Lorem ipsum dolor sit amet, consectetuer adipiscing</strong>

                                <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of
                                    existence in this spot, which was created for the bliss of souls like mine.</p>

                                <p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at
                                    the present moment; and yet I feel that I never was a greater artist than now. When.</p>
                                    
                                <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of
                                    existence in this spot, which was created for the bliss of souls like mine.</p>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                <strong>Donec quam felis</strong>

                                <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                    and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                                <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                    sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
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
               Copyright <strong>BKD Pemprov DKI Jakarta</strong><small> © 2014-2015<br/>Jalan Merdeka Selatan Kav 8-9 Gedung Balaikota Lantai 3 dan 13 Jakarta</small>
            </div>
        </div>
    </div>
</body>
</html>


<!-- Mainly scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/js/jquery-2.1.1.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/bootstrap.min.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/boostrapvalidator/js/bootstrapValidator.js"></script>-->
<!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib-1.0.0.js"></script>-->

        <script type="text/javascript">
           $(function() {
                $("#defaultForm").on("submit", function(e) {
					e.preventDefault();
					//var cresponse = grecaptcha.getResponse();
					var username = $('input[name=username]').val();
					var password = $('input[name=password]').val();
					//if(!cresponse || !username || !password){
                    if(!username || !password){
                        swal("Error!", "Lengkapi data!", "error");
						return false;
					}else{
						var url = '<?php echo base_url(); ?>index.php/login/cek';
						$.ajax({
			                url: url,
			                type: 'POST',
			                data: {
			                    username: username, password: password,
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
