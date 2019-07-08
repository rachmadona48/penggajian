<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Seminar History</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li class="active">
                <strong>seminar_history_form</strong>
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
	                <h5>Form Seminar History</h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>                    
	                </div>
	            </div>
	            <div class="ibox-content">
	            	<form id="defaultForm2" name="defaultForm2" method="post" class="form-horizontal">
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">NRK</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="nrk" name="nrk" placeholder="NRK" value="<?php echo isset($NRK) ? $NRK : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">TGMULAI</label>
                            	<div class="input-group col-sm-4 date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgmulai" name="tgmulai" placeholder="TGMULAI" value="<?php echo isset($TGMULAI) ? date('d-m-Y', strtotime($TGMULAI)) : ""; ?>" class="form-control">
                                </div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group" id="data_1">
	            				<label class="col-sm-2 control-label">TGSELESAI</label>
                            	<div class="input-group col-sm-4 date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgselesai" name="tgselesai" placeholder="TGSELESAI" value="<?php echo isset($TGSELESAI) ? date('d-m-Y', strtotime($TGSELESAI)) : ""; ?>" class="form-control">
                                </div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group" id="data_2">
	            				<label class="col-sm-2 control-label">NASEMI</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="nasemi" name="nasemi" placeholder="NASEMI" value="<?php echo isset($NASEMI) ? $NASEMI : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">KDSEMI</label>
                            	<div class="input-group col-sm-4">
                            		<!--<input type="text" id="kdsemi" name="kdsemi" placeholder="KDSEMI" value="<?php echo isset($KDSEMI) ? $KDSEMI : ""; ?>" class="form-control">-->
                                    <select class="form-control select2_kdsemi" name="kdsemi" id="kdsemi" tabindex="2" placeholder="KDSEMI">
                                        <option></option>
                                        <?php echo $listKdsemi; ?> 
                                    </select>
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">KDTEMA</label>
                            	<div class="input-group col-sm-4">
                            		<!--<input type="text" id="kdtema" name="kdtema" placeholder="KDTEMA" value="<?php echo isset($KDTEMA) ? $KDTEMA : ""; ?>" class="form-control">-->
                            	       <select class="form-control select2_kdtema" name="kdtema" id="kdtema" tabindex="2" placeholder="KDTEMA">
                                        <option></option>
                                        <?php echo $listKdtema; ?> 
                                    </select>
                                </div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	           
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">BADAN</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="badan" name="badan" placeholder="BADAN" value="<?php echo isset($BADAN) ? $BADAN : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">TEMPAT</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="tempat" name="tempat" placeholder="TEMPAT" value="<?php echo isset($TEMPAT) ? $TEMPAT : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">KDPERAN</label>
                            	<div class="input-group col-sm-4">
                            		<!--<input type="text" id="kdperan" name="kdperan" placeholder="KDPERAN" value="<?php echo isset($KDPERAN) ? $KDPERAN: ""; ?>" class="form-control">-->
                                    <select class="form-control select2_kdperan" name="kdperan" id="kdperan" tabindex="2" placeholder="KDPERAN">
                                        <option></option>
                                        <?php echo $listKdperan; ?> 
                                    </select>
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            			 
	            			<div class="form-group">                               
                                <div class="col-sm-4 col-sm-offset-2">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="<?php echo base_url(); ?>index.php/hist/seminar_hist" class="btn btn-danger">Kembali</a>
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

                $('#data_2 .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy"
                }); 
                $(".select2_kdsemi").select2({
                    placeholder: "Pilih Kode Semi"                    
                });   
                $(".select2_kdtema").select2({
                    placeholder: "Pilih Kode Tema"                    
                });   
                $(".select2_kdperan").select2({
                    placeholder: "Pilih Kode Peran"                    
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