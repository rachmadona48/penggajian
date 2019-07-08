<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Pegawai 1</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Hist</a>
            </li>
            <li class="active">
                <strong>Pegawai 1</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<style type="text/css">
#kiri
{
width:50%;
height:100px;
background-color:#FF0;
float:left;
}
#kanan
{
width:50%;
height:100px;
background-color:#0C0;
float:right;
}
</style>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
        <div class="col-lg-12">
        	<div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Form Pegawai 1</h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>                    
	                </div>
	            </div>
	            <div class="ibox-content">
	            	<form id="defaultForm2" name="defaultForm2" method="post" class="form-horizontal">
	            		<div id="kiri">
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
	            				<label class="col-sm-2 control-label">KLOGAD</label>
                            	<div class="input-group col-sm-4">
                            		<!--<input type="text" id="klogad" name="klogad" placeholder="KLOGAD" value="<?php echo isset($KLOGAD) ? $KLOGAD : ""; ?>" class="form-control">-->
                                     <select class="form-control select2_klogad" name="klogad" id="klogad" tabindex="2" placeholder="KLOGAD">
                                        <option></option>
                                        <?php echo $listKlogad; ?> 
                                    </select>
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">KKLOGAD</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="kklogad" name="kklogad" placeholder="KKLOGAD" value="<?php echo isset($KKLOGAD) ? $KKLOGAD : ""; ?>" class="form-control">
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
	            				<label class="col-sm-2 control-label">TITEL</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="titel" name="titel" placeholder="TITEL" value="<?php echo isset($TITEL) ? $TITEL : ""; ?>" class="form-control">
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
	            
	            		
	            			<div class="form-group" id="data_1">
	            				<label class="col-sm-2 control-label">TALHIR</label>
                            	<div class="input-group col-sm-4 date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="talhir" name="talhir" placeholder="TALHIR" value="<?php echo isset($TALHIR) ? date('d-m-Y', strtotime($TALHIR)) : ""; ?>" class="form-control">
                                </div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">AGAMA</label>
                            	<div class="input-group col-sm-4">
                            		<!--<input type="text" id="agama" name="agama" placeholder="AGAMA" value="<?php echo isset($AGAMA) ? $AGAMA: ""; ?>" class="form-control">-->
                                     <select class="form-control select2_agama" name="agama" id="agama" tabindex="2" placeholder="Agama">
                                        <option></option>
                                        <?php echo $listAgama; ?> 
                                    </select>
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
                            		<!--<input type="text" id="stawin" name="stawin" placeholder="STAWIN" value="<?php echo isset($STAWIN) ? $STAWIN : ""; ?>" class="form-control">-->
                                     <select class="form-control select2_stawin" name="stawin" id="stawin" tabindex="2" placeholder="STAWIN">
                                        <option></option>
                                        <?php echo $listStawin; ?> 
                                    </select>
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		
	            			<div class="form-group">
	            				<label class="col-sm-2 control-label">STAPEG</label>
                            	<div class="input-group col-sm-4">
                            		<input type="text" id="stapeg" name="stapeg" placeholder="STAPEG" value="<?php echo isset($STAPEG) ? $STAPEG : ""; ?>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
						</div>
						<div id="kanan">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">JENPEG</label>
                                <div class="input-group col-sm-4">
                                    <!--<input type="text" id="jenpeg" name="jenpeg" placeholder="JENPEG" value="<?php echo isset($JENPEG) ? $JENPEG : ""; ?>" class="form-control">-->
                                     <select class="form-control select2_jenpeg" name="jenpeg" id="jenpeg" tabindex="2" placeholder="JENPEG">
                                        <option></option>
                                        <?php echo $listJenpeg; ?> 
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

	            			 <div class="form-group">
                                <label class="col-sm-2 control-label">INDUK</label>
                                <div class="input-group col-sm-4">
                                    <!--<input type="text" id="induk" name="induk" placeholder="INDUK" value="<?php echo isset($INDUK) ? $INDUK : ""; ?>" class="form-control">-->
                                     <select class="form-control select2_induk" name="induk" id="induk" tabindex="2" placeholder="INDUK">
                                        <option></option>
                                        <?php echo $listInduk; ?> 
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group" id="data_2">
                                <label class="col-sm-2 control-label">MUANG</label>
                                <div class="input-group col-sm-4 date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="muang" name="muang" placeholder="MUANG" value="<?php echo isset($MUANG) ? date('d-m-Y', strtotime($MUANG)) : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">NOTUNGGU</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="notunggu" name="notunggu" placeholder="NOTUNGGU" value="<?php echo isset($NOTUNGGU) ? $NOTUNGGU : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group" id="data_3">
                                <label class="col-sm-2 control-label">TGTUNGGU</label>
                                <div class="input-group col-sm-4 date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgtunggu" name="tgtunggu" placeholder="TGTUNGGU" value="<?php echo isset($TGTUNGGU) ? date('d-m-Y', strtotime($TGTUNGGU)) : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group" id="data_10">
                                <label class="col-sm-2 control-label">TGAKHTUNG</label>
                                <div class="input-group col-sm-4 date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgakhtung" name="tgakhtung" placeholder="TGAKHTUNG" value="<?php echo isset($TGAKHTUNG) ? date('d-m-Y', strtotime($TGAKHTUNG)) : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">TBHTTMAS</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="tbhttmas" name="tbhttmas" placeholder="TBHTTMAS" value="<?php echo isset($TBHTTMAS) ? $TBHTTMAS : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">TBHBBMAS</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="tbhbbmas" name="tbhbbmas" placeholder="TBHBBMAS" value="<?php echo isset($TBHBBMAS) ? $TBHBBMAS : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">TUNDA</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="tunda" name="tunda" placeholder="TUNDA" value="<?php echo isset($TUNDA) ? $TUNDA : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">MPP</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="mpp" name="mpp" placeholder="MPP" value="<?php echo isset($MPP) ? $MPP : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group" id="data_5">
                                <label class="col-sm-2 control-label">TMT_STAPEG</label>
                               <div class="input-group col-sm-4 date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmt_stapeg" name="tmt_stapeg" placeholder="TMT_STAPEG" value="<?php echo isset($TMT_STAPEG) ? date('d-m-Y', strtotime($TMT_STAPEG)) : ""; ?>" class="form-control">
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

                            <div class="form-group" id="data_6">
                                <label class="col-sm-2 control-label">TMTPENSIUN</label>
                                <div class="input-group col-sm-4 date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmtpensiun" name="tmtpensiun" placeholder="TMTPENSIUN" value="<?php echo isset($TMTPENSIUN) ? date('d-m-Y', strtotime($TMTPENSIUN)) : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">KDMATI</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="kdmati" name="kdmati" placeholder="KDMATI" value="<?php echo isset($KDMATI) ? $KDMATI : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group" id="data_7">
                                <label class="col-sm-2 control-label">TGLAMPP</label>
                                <div class="input-group col-sm-4 date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tglampp" name="tglampp" placeholder="TGLAMPP" value="<?php echo isset($TGLAMPP) ? date('d-m-Y', strtotime($TGLAMPP)) : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group" id="data_8">
                                <label class="col-sm-2 control-label">TGLEMPP</label>
                                <div class="input-group col-sm-4 date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tglempp" name="tglempp" placeholder="TGLEMPP" value="<?php echo isset($TGLEMPP) ? date('d-m-Y', strtotime($TGLEMPP)) : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">X_PHOTO</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="x_photo" name="x_photo" placeholder="X_PHOTO" value="<?php echo isset($X_PHOTO) ? $X_PHOTO : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">PINDAHAN</label>
                                <div class="input-group col-sm-4">
                                    <input type="text" id="pindahan" name="pindahan" placeholder="PINDAHAN" value="<?php echo isset($PINDAHAN) ? $PINDAHAN : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group" id="data_9">
                                <label class="col-sm-2 control-label">TMTPINDAH</label>
                                <div class="input-group col-sm-4 date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmtpindah" name="tmtpindah" placeholder="TMTPINDAH" value="<?php echo isset($TMTPINDAH) ? date('d-m-Y', strtotime($TMTPINDAH)) : ""; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
						</div>
	            			<div class="form-group">                               
                                <div class="col-sm-4 col-sm-offset-2">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="<?php echo base_url(); ?>index.php/hist/pegawai1" class="btn btn-danger">Kembali</a>
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
                $('#data_10 .input-group.date').datepicker({
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

                $('#data_6 .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy"
                }); 
                $('#data_7 .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy"
                }); 

                $('#data_8 .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy"
                }); 

                $('#data_9 .input-group.date').datepicker({
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
                 $(".select2_agama").select2({
                    placeholder: "Pilih Kode Agama"                    
                }); 
                 $(".select2_stawin").select2({
                    placeholder: "Pilih Kode Stawin"                    
                });
                 $(".select2_jenpeg").select2({
                    placeholder: "Pilih Kode Jenis Pegawai"                    
                });
                 $(".select2_induk").select2({
                    placeholder: "Pilih Kode Induk"                    
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