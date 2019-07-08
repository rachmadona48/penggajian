    <style type="text/css">
        #displayText{
            font-size: 23px;
            color: #1ab394;
            font-weight: bold;
        }
        
        #page-wrapper{
            background: rgba(0, 0, 0, 0) url("/penggajian/assets/inspinia/css/patterns/shattered.png") repeat scroll 0 0;
        }

        #btnCari{
            margin-right: 82px;
        }

        .sk-spinner-circle.sk-spinner {
            height: 22px;
            margin: 0 !important;
            position: relative;
            width: 22px;
        }

        .form-inline .form-group{
        	width: 100%;
        }

        .form-inline .form-group select{
        	width: 95%;
        }

        .form-inline .form-group input{
        	width: 99%;
        }

        .data-form-group{
        	margin-bottom: 5px;
        }

        #btnCari{
            position: absolute;
            right: 10px;
        }

        .sk-spinner-three-bounce.sk-spinner {
            margin: 0 auto;
            text-align: center;
            width: 140px !important;
        }

        @media (max-width: 770px){
            #jenis___chosen, #jenis_chosen{
                width: 100% !important
            }      

            .addButton, .removeButton{
                float: right !important;
            }

            .form-inline .form-group{
                width: 100%;
            }

            #btnCari{
                position: absolute;
                /*left: -65px;*/
                min-width: 100%;
                left: calc(100% - (125px));
                /*margin-top: 35px !important;*/
            }
            
            #btnPdf{
                margin-top: 37px;
            }
        }

    </style>    
                <div class="ibox-content">
                    <div class="row m-b-lg m-t-lg"> 
                        <div class="col-md-12">
                          
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <select class="form-control chosen-jenis" name="jenis" id="jenis" data-placeholder="Cari Berdasarkan...">
                                    	<?php if($user_group == 52) { ?> <!-- jika group adalah skpd -->

                                    		<?php if($spmu == 'C030' || $spmu == 'C031') { ?> <!-- dinkes-->
					                			<option value="0">Pilih Jenis Listing</option>
						                    	<option value="1">Listing TKD Tahap2 DINKES 108</option>
												<option value="5">Rekap TKD Tahap2 DINKES 108</option>
					                		<?php }elseif ($spmu == 'C040' || $spmu == 'C041') { ?> <!-- disdik-->
					                			<option value="0">Pilih Jenis Listing</option>
												<option value="2">Listing TKD Tahap2 DISDIK 108</option>
												<option value="6">Rekap TKD Tahap2 DISDIK 108</option>
					                		<?php }else{ ?>
					                			<option value="0">Pilih Jenis Listing</option>
	                                    		<option value="3">Listing TKD Tahap2 108</option>
												<option value="7">Rekap TKD Tahap2 108</option>
					                		<?php } ?>

                                    		
										<?php }else{ ?>
	                                        <option value="0">Pilih Jenis Listing</option>
	                                        <option value="1">Listing TKD Tahap2 DINKES 108</option>
	                                        <option value="2">Listing TKD Tahap2 DISDIK 108</option>
	                                        <option value="3">Listing TKD Tahap2 108</option>
	                                        <option value="4">Listing TKD Tahap2 Gab 108</option>
	                                        <option value="5">Rekap TKD Tahap2 DINKES 108</option>
	                                        <option value="6">Rekap TKD Tahap2 DISDIK 108</option>
	                                        <option value="7">Rekap TKD Tahap2 108</option>
	                                        <option value="8">Rekap TKD Tahap2 Gab 108</option>     
                                        <?php } ?>       
                                        
                                    </select>
                                </div>  

                                <input type="hidden" id="group_skpd" value="<?php echo $user_group; ?>">
                                <?php if($user_group != 52) { ?>
                                    <input type="hidden" id="spmu" value="0">
                                <?php }else{ ?>
                                    <input type="hidden" id="spmu" value="<?php echo $spmu; ?>">
                                <?php } ?>                     
                            
                            <br/><br/>  <div class="col-md-10">
                                        <a class="btn btn-primary pull-left" id="sebelumnya" href="<?php echo base_url();?>listing">Sebelumnya</a></div>  <br/><br/> <br/><br/> 
                                <!--TKD Non Guru Diskes 108-->
                                <div id="paramval1" style="display: none">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-4">
                                        <select class="form-control chosen-thbl" name="thbl1" id="thbl1" tabindex="2" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                                <?php echo $thbltkdnonguru108; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <a onclick="cetaklistingtkdtahap2diskes(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>   
                                <!-- END TKD Non Guru Diskes 108-->

                                <!--TKD Non Guru Disdik 108-->
                                <div id="paramval2" style="display: none">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-4">
                                        <select class="form-control chosen-thbl" name="thbl2" id="thbl2" tabindex="2" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                               <?php echo $thbltkdnonguru108; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                         <a onclick="cetaklistingtkdtahap2disdik(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>     
                                <!-- END TKD Non Guru Disdik 108-->

                                <!--TKD Non Guru SPMU 108-->
                                <div id="paramval3" style="display: none">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-3">
                                        <select class="form-control chosen-thbl" name="thbl3" id="thbl3" tabindex="3" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                               <?php echo $thbltkdnonguru108; ?>
                                        </select>
                                    </div>
                                    <!-- <div class="col-md-6"></div> -->

                                    <?php if($user_group != 52) { ?>
                                        <!-- <div class="col-md-1"></div> -->
                                        <div class="col-md-1"><b>SKPD</b></div>
                                        <div class="col-md-3">
                                            <div class="center" id="spinner_wait1"></div>
                                            <select class="form-control chosen-spmu" name="skpdtkdnonguru" id="skpdtkdnonguru"  data-placeholder="Pilih SKPD..." >
                                                <option value=""></option>
                                                    <?php echo $spmtkdnonguru108; ?>
                                            </select>
                                        </div>
                                        <!-- <div class="col-md-6"></div> -->
                                    <?php } ?>


                                    <div class="col-md-2">
                                        <a onclick="cetaklistingtkdtahap2(); return false;" id="btnPdf3" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>     
                                <!-- END TKD Non Guru SPMU 108-->

                                 <!--TKD Non Guru Gab 108-->
                                <div id="paramval4" style="display: none">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-4">
                                        <select class="form-control chosen-thbl" name="thbl4" id="thbl4" tabindex="4" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                               <?php echo $thbltkdnonguru108; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                         <a onclick="cetaklistingtkdtahap2gab(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>     
                                <!-- END TKD Non Guru Disdik 108-->




                                <!--Rekap TKD Non Guru Diskes 108-->
                                <div id="paramval5" style="display: none">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-4">
                                        <select class="form-control chosen-thbl" name="thbl5" id="thbl5" tabindex="5" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                               <?php echo $thbltkdnonguru108; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                         <a onclick="cetakrekaptkdtahap2diskes108(); return false;" id="btnPdf5" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>     
                                <!-- END TKD Non Guru Diskes 108-->

                                <!--Rekap TKD Non Guru Disdik 108-->
                                <div id="paramval6" style="display: none">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-4">
                                        <select class="form-control chosen-thbl" name="thbl6" id="thbl6" tabindex="6" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                               <?php echo $thbltkdnonguru108; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                         <a onclick="cetakrekaptkdtahap2disdik108(); return false;" id="btnPdf6" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>     
                                <!-- END TKD Non Guru Disdik 108-->

                                
                                <!--TKD Non Guru 108-->
                                <div id="paramval7" style="display: none">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-3">
                                        <select class="form-control chosen-thbl" name="thbl7" id="thbl7" tabindex="7" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                               <?php echo $thbltkdnonguru108; ?>
                                        </select>
                                    </div>

                                    <?php if($user_group != 5) { ?>
                                        <div class="col-md-1"><b>SKPD</b></div>
                                        <div class="col-md-3">
                                            <div class="center" id="spinner_wait2"></div>
                                            <select class="form-control chosen-spmu" name="skpdtkdnongururek" id="skpdtkdnongururek"  data-placeholder="Pilih SKPD..." >
                                                <option value=""></option>
                                                    <?php echo $spmtkdnonguru108; ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-2">
                                        <a onclick="cetakrekaptkdtahap2108(); return false;" id="btnPdf7" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>     
                                <!-- END TKD Non Guru 108-->


                                 <!--Rekap TKD Guru Gab 108-->
                                <div id="paramval8" style="display: none">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-4">
                                        <select class="form-control chosen-thbl" name="thbl8" id="thbl8" tabindex="8" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                               <?php echo $thbltkdnonguru108; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <a onclick="cetakrekaptkdtahap2gab108(); return false;" id="btnPdf8" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>     
                                <!-- END Rekap TKD Guru Gab 108-->
                        </div>
                  </div>                                       
                </div> 
                    
           

    
    <!-- END WELLCOME -->
    

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

        <script type="text/javascript">

        $(document).ready(function(){
            
           
            $("#jenis").on("change", function(event) {
                event.preventDefault();
                    onchangeJenis();
            });


             $("#thbl3").on("change", function(event) {
                
                     var spinner = '<div class="sk-spinner sk-spinner-fading-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>'; 
                var thblrg = $('#thbl3').val();
                
                event.preventDefault();

                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/listing/getSpmuFromTKDNonGuru108",
                    type: "post",
                    data: {thbl : thblrg},
                    dataType: 'json',
                    beforeSend: function() {
                        $('#spinner_wait1').html(spinner);
                    },
                    success: function(data) {
                        if(data.response == 'SUKSES'){
                            list = '<option value=""></option>' + data.list;
                             $('#skpdtkdnonguru').html(list);
                             $("#spinner_wait1").html('');
                        }else{
                             $('#skpdtkdnonguru').html('');
                             $("#spinner_wait1").html('');
                        }

                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan. Silahkan coba kembali");
                    },
                    complete: function() {
                        $(".chosen-spmu").trigger("chosen:updated");

                       // $('#defaultForm2').bootstrapValidator('revalidateField', 'kokel');
                    }
                });
            });

              $("#thbl7").on("change", function(event) {
                
                     var spinner = '<div class="sk-spinner sk-spinner-fading-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>'; 
                var thblrg = $('#thbl7').val();
                
                event.preventDefault();

                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/listing/getSpmuFromTKDNonGuru108",
                    type: "post",
                    data: {thbl : thblrg},
                    dataType: 'json',
                    beforeSend: function() {
                        $('#spinner_wait2').html(spinner);
                    },
                    success: function(data) {
                        if(data.response == 'SUKSES'){
                            list = '<option value=""></option>' + data.list;
                             $('#skpdtkdnongururek').html(list);
                             $("#spinner_wait2").html('');
                        }else{
                             $('#skpdtkdnongururek').html('');
                             $("#spinner_wait2").html('');
                        }

                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan. Silahkan coba kembali");
                    },
                    complete: function() {
                        $(".chosen-spmu").trigger("chosen:updated");

                       // $('#defaultForm2').bootstrapValidator('revalidateField', 'kokel');
                    }
                });
            });

            
            
        });
        
            function onchangeJenis()
            {
                var resJenis = document.getElementById('jenis').value;

                if(resJenis == 1)
                {
                    $('#paramval1').show();
                    $('#paramval2').hide();
                    $('#paramval3').hide();
                    $('#paramval4').hide();
                    $('#paramval5').hide();
                    $('#paramval6').hide();
                    $('#paramval7').hide();
                    $('#paramval8').hide();
                }
                else if(resJenis == 2)
                {
                    $('#paramval1').hide();   
                    $('#paramval2').show();
                    $('#paramval3').hide();
                    $('#paramval4').hide();
                    $('#paramval5').hide();
                    $('#paramval6').hide();
                    $('#paramval7').hide();
                    $('#paramval8').hide();
                }
                else if(resJenis == 3)
                {
                    $('#paramval1').hide();
                    $('#paramval2').hide();   
                    $('#paramval3').show();   
                    $('#paramval4').hide();
                    $('#paramval5').hide();
                    $('#paramval6').hide();
                    $('#paramval7').hide();
                    $('#paramval8').hide();
                }
                else if(resJenis == 4)
                {
                    $('#paramval1').hide();
                    $('#paramval2').hide();   
                    $('#paramval3').hide();   
                    $('#paramval4').show();
                    $('#paramval5').hide();
                    $('#paramval6').hide();
                    $('#paramval7').hide();
                    $('#paramval8').hide();
                }
                else if(resJenis == 5)
                {
                    $('#paramval1').hide();
                    $('#paramval2').hide();   
                    $('#paramval3').hide();   
                    $('#paramval4').hide();
                    $('#paramval5').show();
                    $('#paramval6').hide();   
                    $('#paramval7').hide();
                    $('#paramval8').hide();
                }
                else if(resJenis == 6)
                {
                    $('#paramval1').hide();
                    $('#paramval2').hide();   
                    $('#paramval3').hide();   
                    $('#paramval4').hide();
                    $('#paramval5').hide();
                    $('#paramval6').show(); 
                    $('#paramval7').hide();
                    $('#paramval8').hide(); 
                }
                else if(resJenis == 7)
                {
                    $('#paramval1').hide();
                    $('#paramval2').hide();   
                    $('#paramval3').hide();   
                    $('#paramval4').hide();
                    $('#paramval5').hide();
                    $('#paramval6').hide(); 
                    $('#paramval7').show();
                    $('#paramval8').hide(); 
                }
                else if(resJenis == 8)
                {
                    $('#paramval1').hide();
                    $('#paramval2').hide();   
                    $('#paramval3').hide();   
                    $('#paramval4').hide();
                    $('#paramval5').hide();
                    $('#paramval6').hide(); 
                    $('#paramval7').hide();
                    $('#paramval8').show(); 
                }
            }

            function cetaklistingtkdtahap2diskes()
            {
                var thblleng= $('#thbl1').val().length;
                var thbl= $('#thbl1').val();
                if( thblleng >0)
                {
                    window.open('<?=site_url('listing')?>/cetaklistingtkdtahap2diskes/'+thbl);
                }
                else
                {
                    alert('THBL Harap Diisi');
                }
            }

            function cetaklistingtkdtahap2disdik()
            {
                var thblleng= $('#thbl2').val().length;
                var thbl= $('#thbl2').val();
                if( thblleng >0)
                {
                    window.open('<?=site_url('listing')?>/cetaklistingtkdtahap2disdik/'+thbl);
                }
                else
                {
                    alert('THBL Harap Diisi');
                }
            }
            

            function cetaklistingtkdtahap2()
            {
                
                var thblleng= $('#thbl3').val().length;
                var thbl= $('#thbl3').val();


                

                // alert('ddddd');
                var group= $('#group_skpd').val();
                if (group == 52){
                    var skpd= $('#spmu').val();
                    var skpdleng= $('#spmu').val().length;
                }else{
                    var skpd= $('#skpdtkdnonguru').val();
                    var skpdleng= $('#skpdtkdnonguru').val().length;
                }

               // alert(skpd);

                
                if(thblleng == 0)
                {
                    alert('THBL Harap Diisi');
                }
                else if(skpdleng== 0)
                {
                    alert('Pilih SKPD');   
                }
                else if(thblleng>0 && skpdleng>2)
                {
                    window.open('<?=site_url('listing')?>/cetaklistingtkdtahap2/'+thbl+'/'+skpd);
                }
            }

            function cetaklistingtkdtahap2gab()
            {
                var thblleng= $('#thbl4').val().length;
                var thbl= $('#thbl4').val();
                if( thblleng >0)
                {
                    window.open('<?=site_url('listing')?>/cetaklistingtkdtahap2gab/'+thbl);
                }
                else
                {
                    alert('THBL Harap Diisi');
                }
            }

            function cetakrekaptkdtahap2diskes108()
            {
                var thblleng= $('#thbl5').val().length;
                var thbl= $('#thbl5').val();
                if( thblleng >0)
                {
                    window.open('<?=site_url('listing')?>/cetakrekaptkdtahap2diskes108/'+thbl);
                }
                else
                {
                    alert('THBL Harap Diisi');
                }
            }

            function cetakrekaptkdtahap2disdik108()
            {
                var thblleng= $('#thbl6').val().length;
                var thbl= $('#thbl6').val();
                if( thblleng >0)
                {
                    window.open('<?=site_url('listing')?>/cetakrekaptkdtahap2disdik108/'+thbl);
                }
                else
                {
                    alert('THBL Harap Diisi');
                }
            }

            function cetakrekaptkdtahap2108()
            {
                var thblleng= $('#thbl7').val().length;
                var thbl= $('#thbl7').val();

                // var skpdleng= $('#skpdtkdnongururek').val().length;
                // var skpd= $('#skpdtkdnongururek').val();

                var group= $('#group_skpd').val();
                if (group == 52){
                    var skpd= $('#spmu').val();
                    var skpdleng= $('#spmu').val().length;
                }else{
                    var skpd= $('#skpdtkdnongururek').val();
                    var skpdleng= $('#skpdtkdnongururek').val().length;
                }

                
                if(thblleng == 0)
                {
                    alert('THBL Harap Diisi');
                }
                else if(skpdleng== 0)
                {
                    alert('Pilih SKPD');   
                }
                else if(thblleng>0 && skpdleng>2)
                {
                    window.open('<?=site_url('listing')?>/cetakrekaptkdtahap2108/'+thbl+'/'+skpd);
                }
            }
            
            function cetakrekaptkdtahap2gab108()
            {
                var thblleng= $('#thbl8').val().length;
                var thbl= $('#thbl8').val();
                if( thblleng >0)
                {
                    window.open('<?=site_url('listing')?>/cetakrekaptkdtahap2gab108/'+thbl);
                }
                else
                {
                    alert('THBL Harap Diisi');
                }
            }
           

           

            /*START CHOSEN*/
            var config = {
                  '.chosen-jenis'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                   '.chosen-thbl'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                    '.chosen-pnsiun'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                    '.chosen-spmu'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"}
                                }
                for (var selector in config) {
                  $(selector).chosen(config[selector]);
                }
            /*END CHOSEN*/

          

            

     


        </script>

