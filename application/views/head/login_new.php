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
</head>
<body class="gray-bg">

    <img src="<?php echo base_url() ?>assets/img/20171.png" width="100%">
        <div class="row">
            <div class="col-md-12" style="margin-top: -13%">
                <div class="col-md-1"></div>
                <div class="col-md-4" >
                    <div class="ibox float-e-margins">
                    <!-- <h3>Selamat Datang di PENGGAJIANDEV</h3> -->
                        <div class="ibox-content" style="height:50%;border-radius: 5%">
                            <h3 class="font-bold text-navy" style="color:#000099"><center><B style="font-size:28px">(SI-PEG)</B><br>SISTEM INFORMASI PENGGAJIAN </center></h3>
                            <hr>
                            <p align="justify">
                                adalah <b>Sistem Informasi</b> yang dirancang untuk menangani Penggajian kepegawaian mulai dari pengisian, pengolahan & pemusatan data secara terkomputerisasi sehingga dapat menangani berbagai laporan yang berhubungan dengan kepegawaian.
                            </p>
                        </div>
                    </div>
                    <div class="ibox float-e-margins">
                    <!-- <h3>Selamat Datang di PENGGAJIANDEV</h3> -->
                        <div class="ibox-content" style="height:50%;border-radius: 5%">
                            <legend><i class="fa fa-sign-in"></i> AKSES LOGIN</legend>
                            <form id="defaultForm" method="POST" class="form-horizontal" role="form" name="login" >
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
                                        <p id="captcha_img"><?=$image;?></p>
                                        <a href="#" onclick="reload_captcha()">Reload Captcha</a>
                                        <label class="sr-only" for="">Captcha</label>
                                        <input type="text" id="security_code" name="security_code" placeholder="Ketik isi captcha" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-danger block full-width m-b" id="login-btn"><i class="fa fa-sign-in"></i> Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                <div class="tabs-container" >
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1" >PENGUMUMAN &nbsp;
                        <?php if ($ctInfo->TGBARU <= 7 && $ctInfo->TGBARU != null) {?>
                        <span class="label label-danger">NEW</span>
                        <?php }?>
                        </a></li>

                        <li class=""><a data-toggle="tab" href="#tab-2" >BERITA TERBARU &nbsp;
                        <?php if ($ctNews->TGBARU <= 7 && $ctNews->TGBARU != null) {?>
                        <span class="label label-danger" >NEW</span>
                        <?php }?>
                        </a></li>
                    </ul>
                    <div class="tab-content" >
                        <div id="tab-1" class="tab-pane active" >
                            <div class="panel-body" id="pan1" style="height:50%;border-radius: 0% 0% 5% 5%" >
                                <br>
                                <legend><i class="fa fa-info-circle"></i> <b>PENG</b>UMUMAN</legend>
                                <?php
                                // foreach ($isiInformasiBaru as $row) {
                                // 	echo "<b><i><font color='#000099'><i class='fa fa-calendar'></i> " . $row->TGL_UPDATE . " </font></i></b><br/>";
                                // 	echo "<b><font color='#ff0000'>" . $row->BERITA . " </font></b>";
                                // 	echo "<hr/>";
                                // }

                                // foreach ($isiInformasi as $row) {
                                // 	echo "<b><i><font color='#000099'><i class='fa fa-calendar'></i> " . $row->TGL_UPDATE . " </font></i></b><br/>";
                                // 	echo "<font color='#000000'>" . $row->BERITA . "</font>";

                                // 	echo "<hr/>";
                                // }
                                ?>
                                <div style="background: #ec4758;color: aliceblue;border-radius: 5px;">
                                    <marquee onmousemove="this.stop()" onmouseout="this.start()" scrolldelay="130">
                                    <?php foreach ($isiInformasi as $row) { ?>
                                            <?php echo $row->BERITA; ?>

                                            <!-- // echo "<hr/>"; -->
                                    <?php    } ?>
                                    
                                    </marquee>
                                </div>

                                 <br>
                            </div>



                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body" id="pan2">
                                <br>
                                <legend><i class="fa fa-info-circle"></i> <b>BERITA</b> TERBARU</legend>
                                <?php
                                if ($isiInformasi2 == NULL) {
                                	echo "<BR><BR><center><h2>Belum Ada Berita Terbaru</h2></center>";
                                } else {
                                	foreach ($isiInformasi2 as $row) {
                                		echo "<b><i><font color='#000099'><i class='fa fa-calendar'></i> " . $row->TGL_UPDATE . " </font></i></b><br/>";
                                		echo $row->BERITA;
                                		echo "<hr/>";
                                	}
                                }
                                ?>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <hr>
                            </div>


                        </div>
                    </div>
                </div>
                </div>
                <div class="col-md-1"></div>
            </div>



            <div class="col-md-7">

            </div>
        </div>
        <hr/>
        <div class="row">

            <div class="col-md-12 ">
               <center>Copyright <strong>BKD Pemprov DKI Jakarta</strong><small> © <?php echo date('Y') ?><br/>Jalan Merdeka Selatan Kav 8-9 Gedung Balaikota Lantai 20 dan 21 Jakarta</small></center><br><br>
            </div>
        </div>

       <?php if ($cekbanner > 0) {?>
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
<?php }?>

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
       $('#myModalFoto').modal('show');
    });


           $(function() {

                $("#defaultForm").on("submit", function(e) {
					e.preventDefault();
					//var cresponse = grecaptcha.getResponse();
					var username = $('input[name=username]').val();
					var password = $('input[name=password]').val();
                    var security_code = $('input[name=security_code]').val();
					//if(!cresponse || !username || !password){
                    if(!username || !password){
                        swal("Error!", "Lengkapi data!", "error");
						return false;
					}
                    else if(!security_code)
                    {
                        swal("Error!", "Isi Captcha!", "error");

                        return false;

                    }else{
						var url = '<?php echo base_url(); ?>index.php/login/cek';
						$.ajax({
			                url: url,
			                type: 'POST',
			                data: {
			                    username: username, password: password,security_code:security_code
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

            function reload_captcha(){
    $.ajax({
      type:"GET",
      url: "<?=site_url('login/load_captcha/1')?>",
      success: function(img){
        $("#captcha_img").html(img);
      },
      error: function(){
        alert("some error occured");
      }
    });
  }
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
