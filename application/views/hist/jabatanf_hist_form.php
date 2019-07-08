<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Jabatan Fungsional History</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li class="active">
                <strong>jabatanf_history_form</strong>
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
	                <h5>Form Jabatan Struktural History</h5>
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
	            			 
	            		
	            			<div class="form-group" id="data_1">
	            				<label class="col-sm-2 control-label">TMT</label>
                            	<!-- <div class="col-sm-10">
                            		<input type="text" id="tmt" name="tmt" placeholder="TMT" value="<?php echo isset($TMT) ? $TMT : ""; ?>" class="form-control">
                            	</div> -->
                                <div class="input-group col-sm-4 date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmt" name="tmt" placeholder="TMT" value="<?php echo isset($TMT) ? date('d-m-Y', strtotime($TMT)) : ""; ?>" class="form-control">
                                </div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">Kolok</label>
                            	<div class="input-group col-sm-4">
                            		<!-- <input type="text" id="kolok" name="kolok" placeholder="Kolok" value="<?php echo isset($KOLOK) ? $KOLOK : ""; ?>" class="form-control"> -->
                                    <select class="form-control select2_kolok" name="kolok" id="kolok" tabindex="2" placeholder="Kolok">
                                        <option></option>
                                        <?php echo $listKolok; ?> 
                                    </select>
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">Kojab</label>
                            	<div class="input-group col-sm-4">
                            		<!-- <input type="text" id="kojab" name="kojab" placeholder="Kojab" value="<?php echo isset($KOJAB) ? $KOJAB : ""; ?>" class="form-control"> -->
                                    <select class="form-control select2_kojab" name="kojab" id="kojab" tabindex="2" placeholder="Kojab">
                                        <option></option>
                                        <?php echo $listKojab; ?> 
                                    </select>
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">Kdsort</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="kdsort" name="kdsort" placeholder="Kdsort" value="<?php echo isset($KDSORT) ? $KDSORT : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group" id="data_2">
	            				<label class="col-sm-2 control-label">TgAkhir</label>
                            	<div class="input-group col-sm-4 date">
                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgakhir" name="tgakhir" placeholder="Tgakhir" value="<?php echo isset($TGAKHIR) ? date('d-m-Y', strtotime($TGAKHIR)) : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	           
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">Kopang</label>
                            	<div class="input-group col-sm-4">
                            		<!--<input type="text" id="kopang" name="kopang" placeholder="Kopang" value="<?php echo isset($KOPANG) ? $KOPANG : ""; ?>" class="form-control">-->
                                    <select class="form-control select2_kopang" name="kopang" id="kopang" tabindex="2" placeholder="Kopang">
                                        <option></option>
                                        <?php echo $listKopang; ?> 
                                    </select>
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">PEJTT</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="pejtt" name="pejtt" placeholder="PEJTT" value="<?php echo isset($PEJTT) ? $PEJTT : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">NOSK</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="nosk" name="nosk" placeholder="NOSK" value="<?php echo isset($NOSK) ? $NOSK: ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group" id="data_3">
	            				<label class="col-sm-2 control-label">TGSK</label>
                            	<div class="input-group col-sm-4 date">
                            		<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgsk" name="tgsk" placeholder="TGSK" value="<?php echo isset($TGSK) ? date('d-m-Y', strtotime($TGSK)) : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">KREDIT</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="kredit" name="kredit" placeholder="Kredit" value="<?php echo isset($KREDIT) ? $KREDIT : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">STATUS</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="status" name="status" placeholder="status" value="<?php echo isset($STATUS) ? $STATUS : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>

	            			 
	            			<div class="form-group">                               
                                <div class="col-sm-4 col-sm-offset-2">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="<?php echo base_url(); ?>index.php/hist/jabatanf_hist" class="btn btn-danger">Kembali</a>
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

        <!-- Chosen --
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/chosen/chosen.jquery.js"></script>
        <!-- Chosen -->

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

                $('#data_3 .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy"
                });  

                $(".select2_kolok").select2({
                    placeholder: "Pilih Kode Lokasi"                    
                });        

                $(".select2_kojab").select2({
                    placeholder: "Pilih Kode Jabatan"                    
                }); 
                $(".select2_kopang").select2({
                    placeholder: "Pilih Kode Pangkat"                    
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