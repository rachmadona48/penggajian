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
											
                                    		<?php if($spmu == 'C030' || $spmu == 'C031') { ?> 
												<option value="0">Pilih Jenis Listing</option>
												<option value="5">Listing TKD PLT </option>
												<option value="6">Rekap TKD PLT </option>
					                		<?php }elseif ($spmu == 'C040' || $spmu == 'C041') { ?> 
												<option value="0">Pilih Jenis Listing</option>
												<option value="7">Listing TKD PLT </option>
												<option value="8">Rekap TKD PLT </option>
					                		<?php }else{ ?> -->
					                			<option value="0">Pilih Jenis Listing</option>
												<option value="3">Listing TKD PLT </option>
												<option value="4">Rekap TKD PLT </option>	
					                		<?php } ?>

                                    		
										<?php }else{ ?>
											<option value="0">Pilih Jenis Listing</option>
	                                        <option value="1">Listing TKD PLT Gab </option>   
											<option value="2">Rekap TKD PLT Gab </option> 	
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
										
                                <!--TKD Listing PLT Gab-->
                                <div id="paramval1" style="display: none">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-4">
                                        <select class="form-control chosen-thbl" name="thbl1" id="thbl1" tabindex="2" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                                <?php echo $getTHBLListingTTKDPLT; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <a onclick="cetaklistingtkdpltgab(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>   
                                <!-- END TKD Listing PLT -->
								
								<!--TKD Rekap PLT Gab-->
                                <div id="paramval2" style="display: none">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-4">
                                        <select class="form-control chosen-thbl" name="thbl2" id="thbl2" tabindex="2" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                                <?php echo $getTHBLListingTTKDPLT; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <a onclick="cetakrekaptkdpltgab(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>   
                                <!-- END TKD Rekap PLT -->
								
								<!-- TKD Listing PLT SPMU-->
								<div id="paramval3" style="display: none">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-4">
                                        <select class="form-control chosen-thbl" name="thbl3" id="thbl3" tabindex="3" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                               <?php echo $getTHBLListingTTKDPLT; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <a onclick="cetaklistingtkdpltspmu(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>   
								<!-- End TKD Listing PLT SPMU-->

								<!-- End TKD Rekap PLT SPMU-->
								<div id="paramval4" style="display: none">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-4">
                                        <select class="form-control chosen-thbl" name="thbl4" id="thbl4" tabindex="3" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                               <?php echo $getTHBLListingTTKDPLT; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <a onclick="cetakrekaptkdpltspmu(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>    	
								<!-- End TKD Rekap PLT SPMU-->

                                <!-- Listing TKD PLT Dinkes -->
                                <div id="paramval5" style="display: none">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-4">
                                        <select class="form-control chosen-thbl" name="thbl5" id="thbl5" tabindex="2" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                               <?php echo $getTHBLListingTTKDPLT; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                         <a onclick="cetaklistingtkdpltdinkes(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>     
                                <!-- END Listing TKD PLT Dinkes -->
								
								<!-- Rekap TKD PLT Dinkes -->
                                <div id="paramval6" style="display: none">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-4">
                                        <select class="form-control chosen-thbl" name="thbl6" id="thbl6" tabindex="2" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                               <?php echo $getTHBLListingTTKDPLT; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                         <a onclick="cetakrekaptkdpltdinkes(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>     
                                <!-- END Rekap TKD PLT Dinkes -->
								
								<!-- Listing TKD PLT Disdik -->
                                <div id="paramval7" style="display: none">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-4">
                                        <select class="form-control chosen-thbl" name="thbl7" id="thbl7" tabindex="2" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                               <?php echo $getTHBLListingTTKDPLT; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                         <a onclick="cetaklistingtkdpltdisdik(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>     
                                <!-- END Listing TKD PLT Disdik -->
								
								<!-- Rekap TKD PLT Disdik -->
                                <div id="paramval8" style="display: none">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-4">
                                        <select class="form-control chosen-thbl" name="thbl8" id="thbl8" tabindex="2" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                               <?php echo $getTHBLListingTTKDPLT; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                         <a onclick="cetakrekaptkdpltdisdik(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>     
                                <!-- END Rekap TKD PLT Disdik -->

                                
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


            //  $("#thbl3").on("change", function(event) {
                
            //          var spinner = '<div class="sk-spinner sk-spinner-fading-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>'; 
            //     var thblrg = $('#thbl3').val();
                
            //     event.preventDefault();

            //     $.ajax({
            //         url: "<?php echo base_url(); ?>index.php/listing/getSpmuFromTransport",
            //         type: "post",
            //         data: {thbl : thblrg},
            //         dataType: 'json',
            //         beforeSend: function() {
            //             $('#spinner_wait1').html(spinner);
            //         },
            //         success: function(data) {
            //             if(data.response == 'SUKSES'){
            //                 list = '<option value=""></option>' + data.list;
            //                  $('#skpdtransport').html(list);
            //                  $("#spinner_wait1").html('');
            //             }else{
            //                  $('#skpdtransport').html('');
            //                  $("#spinner_wait1").html('');
            //             }

            //         },
            //         error: function(xhr) {
            //             alert("Terjadi kesalahan. Silahkan coba kembali");
            //         },
            //         complete: function() {
            //             $(".chosen-spmu").trigger("chosen:updated");

            //            // $('#defaultForm2').bootstrapValidator('revalidateField', 'kokel');
            //         }
            //     });
            // });

            //   $("#thbl7").on("change", function(event) {
                
            //          var spinner = '<div class="sk-spinner sk-spinner-fading-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>'; 
            //     var thblrg = $('#thbl7').val();
                
            //     event.preventDefault();

            //     $.ajax({
            //         url: "<?php echo base_url(); ?>index.php/listing/getSpmuFromTransport",
            //         type: "post",
            //         data: {thbl : thblrg},
            //         dataType: 'json',
            //         beforeSend: function() {
            //             $('#spinner_wait2').html(spinner);
            //         },
            //         success: function(data) {
            //             if(data.response == 'SUKSES'){
            //                 list = '<option value=""></option>' + data.list;
            //                  $('#skpdtransportrek').html(list);
            //                  $("#spinner_wait2").html('');
            //             }else{
            //                  $('#skpdtransportrek').html('');
            //                  $("#spinner_wait2").html('');
            //             }

            //         },
            //         error: function(xhr) {
            //             alert("Terjadi kesalahan. Silahkan coba kembali");
            //         },
            //         complete: function() {
            //             $(".chosen-spmu").trigger("chosen:updated");

            //            // $('#defaultForm2').bootstrapValidator('revalidateField', 'kokel');
            //         }
            //     });
            // });

            
            
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
			
			function cetaklistingtkdpltgab()
            {
                var thblleng= $('#thbl1').val().length;
                var thbl= $('#thbl1').val();
                if( thblleng >0)
                {
                    window.open('<?=site_url('listing')?>/cetaklistingtkdpltgab/'+thbl);
                }
                else
                {
                    alert('THBL Harap Diisi');
                }
            }
			
			function cetakrekaptkdpltgab()
            {
                var thblleng= $('#thbl2').val().length;
                var thbl= $('#thbl2').val();
                if( thblleng >0)
                {
                    window.open('<?=site_url('listing')?>/cetakrekaptkdpltgab/'+thbl);
                }
                else
                {
                    alert('THBL Harap Diisi');
                }
            }
			
		function cetaklistingtkdpltspmu()
            {
                // alert('ffff');
                var thblleng= $('#thbl3').val().length;
                var thbl= $('#thbl3').val();

                // var skpdleng= $('#skpdtransport').val().length;
                // var skpd= $('#skpdtransport').val();

      
                    var skpdleng= $('#spmu').val().length; //$('#skpdptt1').val().length;
                    var skpd= $('#spmu').val();//$('#skpdptt1').val();
                
                 //   var skpdleng= $('#skpdplt1').val().length;
                 //   var skpd= $('#skpdplt1').val();
                

                
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
                    window.open('<?=site_url('listing')?>/cetaklistingtkdpltspmu/'+thbl+'/'+skpd);
                }
            }	
			
			function cetakrekaptkdpltspmu()
            {
                var thblleng= $('#thbl4').val().length;
                var thbl= $('#thbl4').val();

                // var skpdleng= $('#skpdtransport').val().length;
                // var skpd= $('#skpdtransport').val();
     
                //    var skpdleng= $('#skpdplt2').val().length;
                //    var skpd= $('#skpdplt2').val();
                
					var skpdleng= $('#spmu').val().length; //$('#skpdptt1').val().length;
                    var skpd= $('#spmu').val();//$('#skpdptt1').val();
                
                
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
                    window.open('<?=site_url('listing')?>/cetakrekaptkdpltspmu/'+thbl+'/'+skpd);
                }
            }	
		
            function cetaklistingtkdpltdinkes()
            {
                var thblleng= $('#thbl5').val().length;
                var thbl= $('#thbl5').val();
                if( thblleng >0)
                {
                    window.open('<?=site_url('listing')?>/cetaklistingtkdpltdinkes/'+thbl);
                }
                else
                {
                    alert('THBL Harap Diisi');
                }
            }
			
			function cetakrekaptkdpltdinkes()
            {
                var thblleng= $('#thbl6').val().length;
                var thbl= $('#thbl6').val();
                if( thblleng >0)
                {
                    window.open('<?=site_url('listing')?>/cetakrekaptkdpltdinkes/'+thbl);
                }
                else
                {
                    alert('THBL Harap Diisi');
                }
            }
            
			function cetaklistingtkdpltdisdik()
            {
                var thblleng= $('#thbl7').val().length;
                var thbl= $('#thbl7').val();
                if( thblleng >0)
                {
                    window.open('<?=site_url('listing')?>/cetaklistingtkdpltdisdik/'+thbl);
                }
                else
                {
                    alert('THBL Harap Diisi');
                }
            }
			
			function cetakrekaptkdpltdisdik()
            {
                var thblleng= $('#thbl8').val().length;
                var thbl= $('#thbl8').val();
                if( thblleng >0)
                {
                    window.open('<?=site_url('listing')?>/cetakrekaptkdpltdisdik/'+thbl);
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

