<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>LP2P History</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li class="active">
                <strong>lp2p_history_form</strong>
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
	                <h5>Form LP2P History</h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>                    
	                </div>
	            </div>
	            <div class="ibox-content">
	            	<form id="defaultForm2" name="defaultForm2" method="post" class="form-horizontal">
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">THPAJAK</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="thpajak" name="thpajak" placeholder="THPAJAK" value="<?php echo isset($THPAJAK) ? $THPAJAK : ""; ?>" class="form-control">
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
	            				<label class="col-sm-2 control-label">NIP</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="nip" name="nip" placeholder="NIP" value="<?php echo isset($NIP) ? $NIP : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">NIP18</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="nip18" name="nip18" placeholder="nip18" value="<?php echo isset($NIP18) ? $NIP18 : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">NAMA</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="nama" name="nama" placeholder="nama" value="<?php echo isset($NAMA) ? $NAMA : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">KOLOK</label>
                            	<div class="input-group col-sm-4">
                            		  <input type="text" id="kolok" name="kolok" placeholder="KOLOK" value="<?php echo isset($KOLOK) ? $KOLOK : ""; ?>" class="form-control">
                            	       <!--<select class="form-control select2_kolok" name="kolok" id="kolok" tabindex="2" placeholder="Kolok">
                                        <option></option>
                                        <?php echo $listKolok; ?> 
                                    </select>-->
                                </div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	           
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">NALOK</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="nalok" name="nalok" placeholder="NALOK" value="<?php echo isset($NALOK) ? $NALOK : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">GOL</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="gol" name="gol" placeholder="GOL" value="<?php echo isset($GOL) ? $GOL : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">RUANG</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="ruang" name="ruang" placeholder="RUANG" value="<?php echo isset($RUANG) ? $RUANG: ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group" id="data_1">
	            				<label class="col-sm-2 control-label">TMTPANGKAT</label>
                            	<div class="input-group col-sm-4 date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmtpangkat" name="tmtpangkat" placeholder="TMTPANGKAT" value="<?php echo isset($TMTPANGKAT) ? date('d-m-Y', strtotime($TMTPANGKAT)) : ""; ?>" class="form-control">
                                </div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">NAJAB</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="najab" name="najab" placeholder="NAJAB" value="<?php echo isset($NAJAB) ? $NAJAB : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group" id="data_2">
	            				<label class="col-sm-2 control-label">TMTESELON</label>
                            	<div class="input-group col-sm-4 date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmteselon" name="tmteselon" placeholder="TMTESELON" value="<?php echo isset($TMTESELON) ? date('d-m-Y', strtotime($TMTESELON)) : ""; ?>" class="form-control">
                                </div>
	                        </div>
	                        <div class="hr-line-dashed"></div>

                            <div class="form-group" id="data_3">
                                <label class="col-sm-2 control-label">TALHIR</label>
                                <div class="input-group col-sm-4 date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="talhir" name="talhir" placeholder="TALHIR" value="<?php echo isset($TALHIR) ? date('d-m-Y', strtotime($TALHIR)) : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">PATHIR</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="pathir" name="pathir" placeholder="PATHIR" value="<?php echo isset($PATHIR) ? $PATHIR : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">ALAMAT</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="alamat" name="alamat" placeholder="ALAMAT" value="<?php echo isset($ALAMAT) ? $ALAMAT : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">RTALAMAT</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="rtalamat" name="rtalamat" placeholder="RTALAMAT" value="<?php echo isset($RTALAMAT) ? $RTALAMAT : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">RWALAMAT</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="rwalamat" name="rwalamat" placeholder="RWALAMAT" value="<?php echo isset($RWALAMAT) ? $RWALAMAT : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
	            			 
                            <div class="form-group">
                                <label class="col-sm-2 control-label">KELURAHAN</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="kelurahan" name="kelurahan" placeholder="KELURAHAN" value="<?php echo isset($KELURAHANn) ? $KELURAHAN : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">KECAMATAN</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="kecamatan" name="kecamatan" placeholder="KECAMATAN" value="<?php echo isset($KECAMATAN) ? $KECAMATAN : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">JENKEL</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="jenkel" name="jenkel" placeholder="JENKEL" value="<?php echo isset($JENKEL) ? $JENKEL : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">STAWIN</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="stawin" name="stawin" placeholder="STAWIN" value="<?php echo isset($STAWIN) ? $STAWIN : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">NAMISU</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="namisu" name="namisu" placeholder="NAMISU" value="<?php echo isset($NAMISU) ? $NAMISU : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">PEKERJAAN</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="pekerjaan" name="pekerjaan" placeholder="PEKERJAAN" value="<?php echo isset($PEKERJAAN) ? $PEKERJAAN : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">JUAN</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="juan" name="juan" placeholder="JUAN" value="<?php echo isset($JUAN) ? $JUAN : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">JIWA</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="jiwa" name="jiwa" placeholder="JIWA" value="<?php echo isset($JIWA) ? $JIWA : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">KDWEWENANG</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="kdwewenang" name="kdwewenang" placeholder="KDWEWENANG" value="<?php echo isset($KDWEWENANG) ? $KDWEWENANG : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">NOFORM</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="noform" name="noform" placeholder="NOFORM" value="<?php echo isset($NOFORM) ? $NOFORM : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">KODE2</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="kode2" name="kode2" placeholder="KODE2" value="<?php echo isset($KODE2) ? $KODE2 : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">KOJAB</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="kojab" name="kojab" placeholder="KOJAB" value="<?php echo isset($KOJAB) ? $KOJAB : ""; ?>" class="form-control">
                                 
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">KOJABF</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="kojabf" name="kojabf" placeholder="KOJABF" value="<?php echo isset($KOJABF) ? $KOJABF : ""; ?>" class="form-control">
                                    
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">KD</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="kd" name="kd" placeholder="KD" value="<?php echo isset($KD) ? $KD : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">ESELON</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="eselon" name="eselon" placeholder="ESELON" value="<?php echo isset($ESELON) ? $ESELON : ""; ?>" class="form-control">
                                    <!--<select class="form-control select2_eselon" name="eselon" id="eselon" tabindex="2" placeholder="ESELON">
                                        <option></option>
                                        <?php echo $listEselon; ?> 
                                    </select>-->
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">SPMU</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="spmu" name="spmu" placeholder="SPMU" value="<?php echo isset($SPMU) ? $SPMU : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">KLOGAD</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="klogad" name="klogad" placeholder="KLOGAD" value="<?php echo isset($KLOGAD) ? $KLOGAD : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">KODUK</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="koduk" name="koduk" placeholder="KODUK" value="<?php echo isset($KODUK) ? $KODUK : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">THLAPOR</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="thlapor" name="thlapor" placeholder="THLAPOR" value="<?php echo isset($THLAPOR) ? $THLAPOR : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">PEJABAT</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="pejabat" name="pejabat" placeholder="PEJABAT" value="<?php echo isset($PEJABAT) ? $PEJABAT : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

	            			<div class="form-group">                               
                                <div class="col-sm-4 col-sm-offset-2">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="<?php echo base_url(); ?>index.php/hist/lp2p_hist" class="btn btn-danger">Kembali</a>
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

                $(".select2_kolok").select2({
                    placeholder: "Pilih Kode Lokasi"                    
                });        

                $(".select2_eselon").select2({
                    placeholder: "Pilih Kode Eselon"                    
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