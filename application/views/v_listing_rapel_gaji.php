    <style type="text/css">
        #displayText{
            font-size: 23px;
            color: #1ab394;
            font-weight: bold;
        }
        
        #page-wrapper{
            background: rgba(0, 0, 0, 0) url("/assets/inspinia/css/patterns/shattered.png") repeat scroll 0 0;
            /*background: rgba(0, 0, 0, 0) url("/penggajian/assets/inspinia/css/patterns/shattered.png") repeat scroll 0 0;*/
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
											<?php if($spmu == 'C040' || $spmu == 'C041') { ?> <!-- disdik-->
                                                <option value="0">Pilih Jenis Listing</option>
                                                <option value="4">Rekap Rapel Gaji (Disdik)</option>
                                                <option value="8">Listing Rapel Gaji (Disdik)</option>
					                		<?php }elseif ($spmu == 'C030' || $spmu == 'C031') { ?> <!-- dinkes-->
                                                <option value="0">Pilih Jenis Listing</option>
                                                <option value="3">Rekap Rapel Gaji (Diskes)</option>
                                                <option value="7">Listing Rapel Gaji (Diskes)</option>
					                		<?php }else{ ?> 
					                			<option value="0">Pilih Jenis Listing</option>
                                                <option value="2">Rekap Rapel Gaji (SKPD)</option>
                                                <option value="6">Listing Rapel Gaji (SKPD)</option>
					                		<?php } ?>

                                    		
										<?php }else{ ?>
											<option value="0">Pilih Jenis Listing</option>
	                                        <option value="1">Rekap Rapel Gaji Gabungan</option>
                                            <option value="2">Rekap Rapel Gaji (SKPD)</option>
                                            <option value="3">Rekap Rapel Gaji (Diskes)</option>
                                            <option value="4">Rekap Rapel Gaji (Disdik)</option>
                                            <option value="5">Listing Rapel Gaji Gabungan</option>
                                            <option value="6">Listing Rapel Gaji (SKPD)</option>
                                            <option value="7">Listing Rapel Gaji (Diskes)</option>
                                            <option value="8">Listing Rapel Gaji (Disdik)</option>
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
										
                                <!--rekap gab-->
                                <div id="paramval1" style="display: none">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-3">
                                        <select class="form-control chosen-thbl" name="thbl_rekap_gab" id="thbl_rekap_gab" tabindex="2" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                                <?php echo $getTahunrapelgaji; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <a onclick="cetakrekap_rapel_gaji_gab(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>   
                                <!-- END rekap gab -->

                                <!--rekap spmu-->
                                <div id="paramval2" style="display: none">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-3">
                                        <select class="form-control chosen-thbl" name="thbl_rekap_spmu" id="thbl_rekap_spmu" tabindex="2" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                                <?php echo $getTahunrapelgaji; ?>
                                        </select>
                                    </div>
                                    <?php if($user_group != 52) { ?>
                                        <div class="col-md-1"><b>SKPD</b></div>
                                        <div class="col-md-3">
                                            <div class="center" id="spinner_wait1"></div>
                                            <select class="form-control chosen-spmu" name="spmu_rekap" id="spmu_rekap"  data-placeholder="Pilih SKPD..." >
                                                <option value=""></option>
                                                <!-- <?php echo $spmu; ?> -->
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-2">
                                        <a onclick="cetakrekap_rapel_gaji_spmu(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>   
                                <!-- END rekap spmu -->

                                <!--rekap dinkes-->
                                <div id="paramval3" style="display: none">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-3">
                                        <select class="form-control chosen-thbl" name="thbl_rekap_dinkes" id="thbl_rekap_dinkes" tabindex="2" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                                <?php echo $getTahunrapelgaji; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <a onclick="cetakrekap_rapel_gaji_dinkes(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>   
                                <!-- END rekap dinkes -->

                                <!--rekap disdik-->
                                <div id="paramval4" style="display: none">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-3">
                                        <select class="form-control chosen-thbl" name="thbl_rekap_disdik" id="thbl_rekap_disdik" tabindex="2" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                                <?php echo $getTahunrapelgaji; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <a onclick="cetakrekap_rapel_gaji_disdik(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>   
                                <!-- END rekap disdik -->

                                <!--listing gab-->
                                <div id="paramval5" style="display: none">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-3">
                                        <select class="form-control chosen-thbl" name="thbl_listing_gab" id="thbl_listing_gab" tabindex="2" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                                <?php echo $getTahunrapelgaji; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <a onclick="cetakrekap_rapel_listing_gaji_gab(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>   
                                <!-- END listing gab -->


                                <!--listing spmu-->
                                <div id="paramval6" style="display: none">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-3">
                                        <select class="form-control chosen-thbl" name="thbl_listing_spmu" id="thbl_listing_spmu" tabindex="2" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                                <?php echo $getTahunrapelgaji; ?>
                                        </select>
                                    </div>
                                    <?php if($user_group != 52) { ?>
                                        <div class="col-md-1"><b>SKPD</b></div>
                                        <div class="col-md-3">
                                            <div class="center" id="spinner_wait2"></div>
                                            <select class="form-control chosen-spmu" name="spmu_listing" id="spmu_listing"  data-placeholder="Pilih SKPD..." >
                                                <option value=""></option>
                                                <!-- <?php echo $spmu; ?> -->
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <div class="col-md-2">
                                        <a onclick="cetakrekap_rapel_listing_gaji_spmu(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>   
                                <!-- END listing spmu -->


                                <!--listing diskes-->
                                <div id="paramval7" style="display: none">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-3">
                                        <select class="form-control chosen-thbl" name="thbl_listing_diskes" id="thbl_listing_diskes" tabindex="2" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                                <?php echo $getTahunrapelgaji; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <a onclick="cetakrekap_rapel_listing_gaji_diskes(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>   
                                <!-- END listing diskes -->

                                <!--listing disdik-->
                                <div id="paramval8" style="display: none">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-1"><b>THBL</b></div>
                                    <div class="col-md-3">
                                        <select class="form-control chosen-thbl" name="thbl_listing_disdik" id="thbl_listing_disdik" tabindex="2" data-placeholder="Pilih inputan..." >
                                            <option value=""></option>
                                                <?php echo $getTahunrapelgaji; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <a onclick="cetakrekap_rapel_listing_gaji_disdik(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                    </div>
                                </div>   
                                <!-- END listing disdik -->

                                
								
								
								
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


            $("#thbl_rekap_spmu").on("change", function(event) {
                
                     var spinner = '<div class="sk-spinner sk-spinner-fading-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>'; 
                var thblrg = $('#thbl_rekap_spmu').val();
                
                event.preventDefault();

                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/listing/getSpmu_rekap_rapel",
                    type: "post",
                    data: {thbl : thblrg},
                    dataType: 'json',
                    beforeSend: function() {
                        $('#spinner_wait1').html(spinner);
                    },
                    success: function(data) {
                        if(data.response == 'SUKSES'){
                            list = '<option value=""></option>' + data.list;
                             $('#spmu_rekap').html(list);
                             $("#spinner_wait1").html('');
                        }else{
                             $('#spmu_rekap').html('');
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

            

            $("#thbl_listing_spmu").on("change", function(event) {
                
                     var spinner = '<div class="sk-spinner sk-spinner-fading-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>'; 
                var thblrg = $('#thbl_listing_spmu').val();
                
                event.preventDefault();

                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/listing/getSpmu_rekap_rapel",
                    type: "post",
                    data: {thbl : thblrg},
                    dataType: 'json',
                    beforeSend: function() {
                        $('#spinner_wait1').html(spinner);
                    },
                    success: function(data) {
                        if(data.response == 'SUKSES'){
                            list = '<option value=""></option>' + data.list;
                             $('#spmu_listing').html(list);
                             $("#spinner_wait2").html('');
                        }else{
                             $('#spmu_listing').html('');
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
			

			function cetakrekap_rapel_gaji_gab()
            {
                var thblleng = $('#thbl_rekap_gab').val().length;
                var thbl = $('#thbl_rekap_gab').val();

                if (thblleng == 0)
                {
                    alert('THBL Harap Diisi');
                }
                else if (thblleng > 0)
                {
                    window.open('<?= site_url('listing') ?>/cetak_rapel_gaji_gab/' + thbl);
                }
            }
            
            function cetakrekap_rapel_gaji_spmu()
            {
                var thblleng = $('#thbl_rekap_spmu').val().length;
                var thbl = $('#thbl_rekap_spmu').val();

                var group= $('#group_skpd').val();
                if (group == 52){
                    var skpd= $('#spmu').val();
                    var skpdleng= $('#spmu').val().length;
                }else{
                    var skpdleng = $('#spmu_rekap').val().length;
                    var skpd = $('#spmu_rekap').val();
                }

                if (thblleng == 0)
                {
                    alert('THBL Harap Diisi');
                }
                else if (skpdleng == 0)
                {
                    alert('Pilih SKPD');
                }
                else if (thblleng > 0 && skpdleng > 2)
                {
                    window.open('<?= site_url('listing') ?>/cetak_rapel_gaji_spmu/' + thbl + '/' + skpd);
                }
            }

            function cetakrekap_rapel_gaji_dinkes()
            {
                var thblleng = $('#thbl_rekap_dinkes').val().length;
                var thbl = $('#thbl_rekap_dinkes').val();

                if (thblleng == 0)
                {
                    alert('THBL Harap Diisi');
                }
                else if (thblleng > 0)
                {
                    window.open('<?= site_url('listing') ?>/cetak_rapel_gaji_dinkes/' + thbl);
                }
            }

            
            function cetakrekap_rapel_gaji_disdik()
            {
                var thblleng = $('#thbl_rekap_disdik').val().length;
                var thbl = $('#thbl_rekap_disdik').val();

                if (thblleng == 0)
                {
                    alert('THBL Harap Diisi');
                }
                else if (thblleng > 0)
                {
                    window.open('<?= site_url('listing') ?>/cetak_rapel_gaji_disdik/' + thbl);
                }
            }


            function cetakrekap_rapel_listing_gaji_gab()
            {
                var thblleng = $('#thbl_listing_gab').val().length;
                var thbl = $('#thbl_listing_gab').val();

                if (thblleng == 0)
                {
                    alert('THBL Harap Diisi');
                }
                else if (thblleng > 0)
                {
                    window.open('<?= site_url('listing') ?>/cetak_rapel_listing_gaji_gab/' + thbl);
                }
            }


            function cetakrekap_rapel_listing_gaji_spmu()
            {
                var thblleng = $('#thbl_listing_spmu').val().length;
                var thbl = $('#thbl_listing_spmu').val();

                var group= $('#group_skpd').val();
                if (group == 52){
                    var skpd= $('#spmu').val();
                    var skpdleng= $('#spmu').val().length;
                }else{
                    var skpdleng = $('#spmu_listing').val().length;
                    var skpd = $('#spmu_listing').val();
                }

                if (thblleng == 0)
                {
                    alert('THBL Harap Diisi');
                }
                else if (skpdleng == 0)
                {
                    alert('Pilih SKPD');
                }
                else if (thblleng > 0 && skpdleng > 2)
                {
                    window.open('<?= site_url('listing') ?>/cetak_rapel_listing_gaji_spmu/' + thbl + '/' + skpd);
                }
            }


            
            function cetakrekap_rapel_listing_gaji_diskes()
            {
                var thblleng = $('#thbl_listing_diskes').val().length;
                var thbl = $('#thbl_listing_diskes').val();

                if (thblleng == 0)
                {
                    alert('THBL Harap Diisi');
                }
                else if (thblleng > 0)
                {
                    window.open('<?= site_url('listing') ?>/cetak_rapel_listing_gaji_diskes/' + thbl);
                }
            }


            function cetakrekap_rapel_listing_gaji_disdik()
            {
                var thblleng = $('#thbl_listing_disdik').val().length;
                var thbl = $('#thbl_listing_disdik').val();

                if (thblleng == 0)
                {
                    alert('THBL Harap Diisi');
                }
                else if (thblleng > 0)
                {
                    window.open('<?= site_url('listing') ?>/cetak_rapel_listing_gaji_disdik/' + thbl);
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

