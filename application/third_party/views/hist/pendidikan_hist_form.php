<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>PENDIDIKAN HISTORY</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Hist</a>
            </li>
            <li class="active">
                <strong>pendidikan_history_form</strong>
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
	                <h5>Form Pendidikan History</h5>
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
	            				<label class="col-sm-2 control-label">JENDIK</label>
                            	<div class="input-group col-sm-4">
                            		<select class="form-control select2_jendik" name="jendik" id="jendik" tabindex="2" placeholder="JENDIK">
                                        <option></option>
                                        <?php echo $listJendik; ?> 
                                    </select>
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">KODIK</label>
                            	<div class="input-group col-sm-4">
                            		<select class="form-control select2_kodik" name="kodik" id="kodik" tabindex="2" placeholder="KODIK">
                                        <option></option>
                                        <?php echo $listKodik; ?> 
                                    </select>
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">NASEK</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="nasek" name="nasek" placeholder="NASEK" value="<?php echo isset($NASEK) ? $NASEK : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">UNIVER</label>
                            	<div class="input-group col-sm-4">
                            		<select class="form-control select2_univer" name="univer" id="univer" tabindex="2" placeholder="UNIVER">
                                        <option></option>
                                        <?php echo $listUniver; ?> 
                                    </select>
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">KOTSEK</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="kotsek" name="kotsek" placeholder="KOTSEK" value="<?php echo isset($KOTSEK) ? $KOTSEK : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	           
	            			 
	            		
	            			<div class="form-group" id="data_1">
	            				<label class="col-sm-2 control-label">TGIJAZAH</label>
                            	 <div class="input-group col-sm-4 date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgijazah" name="tgijazah" placeholder="TGIJAZAH" value="<?php echo isset($TGIJAZAH) ? date('d-m-Y', strtotime($TGIJAZAH)) : ""; ?>" class="form-control">
                                  </div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">NOIJAZAH</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="noijazah" name="noijazah" placeholder="NOIJAZAH" value="<?php echo isset($NOIJAZAH) ? $NOIJAZAH : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group" id="data_2">
	            				<label class="col-sm-2 control-label">TGACCKOP</label>
                            	 <div class="input-group col-sm-4 date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgacckop" name="tgacckop" placeholder="TGACCKOP" value="<?php echo isset($TGACCKOP) ? date('d-m-Y', strtotime($TGACCKOP)) : ""; ?>" class="form-control">
                                  </div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">NOACCKOP</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="noacckop" name="noacckop" placeholder="NOACCKOP" value="<?php echo isset($NOACCKOP) ? $NOACCKOP : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group" id="data_3">
	            				<label class="col-sm-2 control-label">TGMULAI</label>
                            	 <div class="input-group col-sm-4 date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgmulai" name="tgmulai" placeholder="TGMULAI" value="<?php echo isset($TGMULAI) ? date('d-m-Y', strtotime($TGMULAI)) : ""; ?>" class="form-control">
                                  </div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group" id="data_5">
	            				<label class="col-sm-2 control-label">TGAKHIR</label>
                            	 <div class="input-group col-sm-4 date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgakhir" name="tgakhir" placeholder="TGAKHIR" value="<?php echo isset($TGAKHIR) ? date('d-m-Y', strtotime($TGAKHIR)) : ""; ?>" class="form-control">
                                  </div>
	                        </div>
	                        <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">JUMJAM</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="jumjam" name="jumjam" placeholder="JUMJAM" value="<?php echo isset($JUMJAM) ? $JUMJAM : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">SELENGGARA</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="selenggara" name="selenggara" placeholder="SELENGGARA" value="<?php echo isset($SELENGGARA) ? $SELENGGARA : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">ANGKATAN</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="angkatan" name="angkatan" placeholder="ANGKATAN" value="<?php echo isset($ANGKATAN) ? $ANGKATAN : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

	            			 
	            			<div class="form-group">                               
                                <div class="col-sm-4 col-sm-offset-2">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="<?php echo base_url(); ?>index.php/hist/pendidikan_hist" class="btn btn-danger">Kembali</a>
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

                $('#data_3 .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy"
                });  

                $('#data_5 .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy"
                }); 

                 $(".select2_jendik").select2({
                    placeholder: "Pilih Kode Jenis Pendidikan"                    
                });
                  $(".select2_kodik").select2({
                    placeholder: "Pilih Kode Pendidikan"                    
                });
                   $(".select2_univer").select2({
                    placeholder: "Pilih Kode Universitas"                    
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