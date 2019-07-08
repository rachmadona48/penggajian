<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Tunda Absensi History</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Hist</a>
            </li>
            <li class="active">
                <strong>tunda_absensi_form</strong>
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
	                <h5>Form Tunda Absensi</h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>                    
	                </div>
	            </div>
	            <div class="ibox-content">
	            	<form id="defaultForm2" name="defaultForm2" method="post" class="form-horizontal">
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">THBL</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="thbl" name="thbl" placeholder="THBL" value="<?php echo isset($THBL) ? $THBL : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">NRK</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="nrk" name="nrk" placeholder="NRK" value="<?php echo isset($NRK) ? $NRK : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">NIP18</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="nip18" name="nip18" placeholder="NIP18" value="<?php echo isset($NIP18) ? $NIP18 : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">NAMA_ABS</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="nama_abs" name="nama_abs" placeholder="NAMA_ABS" value="<?php echo isset($NAMA_ABS) ? $NAMA_ABS : ""; ?>" class="form-control">
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
	            				<label class="col-sm-2 control-label">NAKLOGAD</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="naklogad" name="naklogad" placeholder="NAKLOGAD" value="<?php echo isset($NAKLOGAD) ? $NAKLOGAD : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	           
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">NAGOL</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="nagol" name="nagol" placeholder="NAGOL" value="<?php echo isset($NAGOL) ? $NAGOL : ""; ?>" class="form-control">
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
                            		<input type="text" id="izin" name="izin" placeholder="IZIN" value="<?php echo isset($IZIN) ? $IZIN: ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">SAKIT</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="sakit" name="sakit" placeholder="SAKIT" value="<?php echo isset($SAKIT) ? $SAKIT : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">CUTI</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="cuti" name="cuti" placeholder="CUTI" value="<?php echo isset($CUTI) ? $CUTI : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">JAMTERLAMBAT</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="jamterlambat" name="jamterlambat" placeholder="JAMTERLAMBAT" value="<?php echo isset($JAMTERLAMBAT) ? $JAMTERLAMBAT : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">JAMPULANGCEPAT</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="jampulangcepat" name="jampulangcepat" placeholder="JAMPULANGCEPAT" value="<?php echo isset($JAMPULANGCEPAT) ? $JAMPULANGCEPAT : ""; ?>" class="form-control">
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
                                <label class="col-sm-2 control-label">PERIODE</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="periode" name="periode" placeholder="PERIODE" value="<?php echo isset($PERIODE) ? $PERIODE : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group" id="data_1">
                                <label class="col-sm-2 control-label">D_PROSES</label>
                                <div class="input-group col-sm-4 date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="d_proses" name="d_proses" placeholder="D_PROSES" value="<?php echo isset($D_PROSES) ? date('d-m-Y', strtotime($D_PROSES)) : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">E_PROSES</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="e_proses" name="e_proses" placeholder="E_PROSES" value="<?php echo isset($E_PROSES) ? $E_PROSES : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">CUTIAPENTING</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="cutiapenting" name="cutiapenting" placeholder="CUTIAPENTING" value="<?php echo isset($CUTIAPENTING) ? $CUTIAPENTING : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">CUTIBESAR</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="cutibesar" name="cutibesar" placeholder="CUTIBESAR" value="<?php echo isset($CUTIBESAR) ? $CUTIBESAR : ""; ?>" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">CUTISAKIT</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="cutisakit" name="cutisakit" placeholder="CUTISAKIT" value="<?php echo isset($CUTISAKIT) ? $CUTISAKIT : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                             <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">CUTIBERSALIN</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="cutibersalin" name="cutibersalin" placeholder="CUTIBERSALIN" value="<?php echo isset($CUTIBERSALIN) ? $CUTIBERSALIN : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
	            			 
	            			<div class="form-group">                               
                                <div class="col-sm-4 col-sm-offset-2">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="<?php echo base_url(); ?>index.php/hist/tunda_absensi" class="btn btn-danger">Kembali</a>
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