<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>TPP PTT History</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li class="active">
                <strong>tpp_ptt_history_form</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
        <div class="col-lg-12">
        	<div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Form TPP PTT History</h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>                    
	                </div>
	            </div>
	            <div class="ibox-content">
	            	<form id="defaultForm2" name="defaultForm2" method="post" class="form-horizontal">
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">NPTT</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="nptt" name="nptt" placeholder="NPTT" value="<?php echo isset($NPTT) ? $NPTT : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">THBL</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="thbl" name="thbl" placeholder="THBL" value="<?php echo isset($THBL) ? $THBL : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">NAMA</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="nama" name="nama" placeholder="NAMA" value="<?php echo isset($NAMA) ? $NAMA : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">KODEPDIDIK</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="kodepdidik" name="kodepdidik" placeholder="KODEPDIDIK" value="<?php echo isset($KODEPDIDIK) ? $KODEPDIDIK : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">KLOGAD</label>
                            	<div class="input-group col-sm-4">
                            		<!--<input type="text" id="klogad" name="klogad" placeholder="KLOGAD" value="<?php echo isset($KLOGAD) ? $KLOGAD : ""; ?>" class="form-control">-->
                                      <select class="form-control select2_klogad" name="klogad" id="klogad" tabindex="2" placeholder="Klogad">
                                        <option></option>
                                        <?php echo $listKlogad; ?> 
                                    </select>
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">KEAHLIAN</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="keahlian" name="keahlian" placeholder="KEAHLIAN" value="<?php echo isset($KEAHLIAN) ? $KEAHLIAN : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	           
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">KINERJA</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="kinerja" name="kinerja" placeholder="KINERJA" value="<?php echo isset($KINERJA) ? $KINERJA : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">TPP</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="tpp" name="tpp" placeholder="TPP" value="<?php echo isset($TPP) ? $TPP : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">POTKINERJA</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="potkinerja" name="potkinerja" placeholder="POTKINERJA" value="<?php echo isset($POTKINERJA) ? $POTKINERJA: ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">JMLSTLPOT</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="jmlstlpot" name="jmlstlpot" placeholder="JMLSTLPOT" value="<?php echo isset($JMLSTLPOT) ? $JMLSTLPOT : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">PPH</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="pph" name="pph" placeholder="PPH" value="<?php echo isset($PPH) ? $PPH : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">TPPBERSIH</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="tppbersih" name="tppbersih" placeholder="TPPBERSIH" value="<?php echo isset($TPPBERSIH) ? $TPPBERSIH : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>

                            <div class="form-group" id="data_1">
                                <label class="col-sm-2 control-label">TGLLAHIR</label>
                                <div class="input-group col-sm-4 date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgllahir" name="tgllahir" placeholder="Tgl Lahir" value="<?php echo isset($TGLLAHIR) ? date('d-m-Y', strtotime($TGLLAHIR)) : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">SPMU</label>
                                <div class="input-group col-sm-4">
                                    <!--<input type="text" id="spmu" name="spmu" placeholder="SPMU" value="<?php echo isset($SPMU) ? $SPMU : ""; ?>" class="form-control">-->
                                    <select class="form-control select2_spmu" name="spmu" id="spmu" tabindex="2" placeholder="SPMU">
                                        <option></option>
                                        <?php echo $listSPMU; ?> 
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">UPLOAD</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="upload" name="upload" placeholder="UPLOAD" value="<?php echo isset($UPLOAD) ? $UPLOAD : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">POTABSENSI</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="potabsensi" name="potabsensi" placeholder="POTABSENSI" value="<?php echo isset($POTABSENSI) ? $POTABSENSI : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">JMLSTLABS</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="jmlstlabs" name="jmlstlabs" placeholder="JMLSTLABS" value="<?php echo isset($JMLSTLABS) ? $JMLSTLABS : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">GAJI_BERSIH</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="gaji_bersih" name="gaji_bersih" placeholder="GAJI_BERSIH" value="<?php echo isset($GAJI_BERSIH) ? $GAJI_BERSIH : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">ALFA</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="alfa" name="alfa" placeholder="ALFA" value="<?php echo isset($ALFA) ? $ALFA : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">IZIN</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="izin" name="izin" placeholder="IZIN" value="<?php echo isset($IZIN) ? $IZIN : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

	            			 
	            			<div class="form-group">                               
                                <div class="col-sm-4 col-sm-offset-2">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="<?php echo base_url(); ?>index.php/hist/tpp_ptt_hist" class="btn btn-danger">Kembali</a>
                                        </div>                                      
                                    </div>
                                </div>                              
                                <div class="col-sm-4 col-sm-offset-2">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <button style="margin-left:5px;" class="btn btn-primary pull-right" type="submit">Simpan</button>
                                            <button class="btn btn-white pull-right" type="reset">Batal</button>                                                                                
                                        </div>
                                    </div>
                                </div>
                            </div>            		
                       
	            	</form>
	        	</div>
	        	    
	      	</div>
        </div>
    </div>
</div>

 		<!-- Mainly scripts -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/jquery-2.1.1.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <!-- Mainly scripts -->        

        <!-- Custom and plugin javascript -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/inspinia.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/pace/pace.min.js"></script>
        <!-- Custom and plugin javascript -->

        <!-- Date Picker -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/datapicker/bootstrap-datepicker.js"></script>
        <!-- Date Picker -->

         <!-- Select2 -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/select2/select2.full.min.js"></script>
        <!-- Select2 -->

        <!-- Validation -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/boostrapvalidator/js/bootstrapValidator.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib-1.0.0.js"></script>    
        <!-- Validation -->

        <script type="text/javascript">

            $(document).ready(function(){
                $('#data_1 .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy"
                }); 


                $(".select2_klogad").select2({
                    placeholder: "Pilih Kode Klogad"                    
                });         

            });
                        
            $(function() {
                $("#defaultForm2").on("submit", function(event) {
                    event.preventDefault();
 
                    $.ajax({
                        url: "<?php echo $linkaction ?>",
                        type: "post",
                        data: $(this).serialize(),
                        dataType: 'json',
                        beforeSend: function() {
                            blocklayar();
                        },
                        success: function(data) {
                            // alert(data.response);
                            window.location.href = data.linkback;
                        },
                        error: function(xhr) {  
                            unblocklayar();  
                            alert("Terjadi kesalahan. Silahkan coba kembali");

                        },
                        complete: function() {
                            unblocklayar();  
                        }
                    });
                });
            });                

        </script>