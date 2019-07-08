<style type="text/css">
    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
    .pickerpicker .form-control-feedback {
        right: 55px !important;      
    }

    .pickerpicker .form-control-feedback {
        top: 0px !important;
    }

    .input-group[class*="col-"] {
        float: none;
        padding-left: -1px !important;
        padding-right: -1px !important;
    }

   .has-success .chosen-container{
   border: 1px solid #1ab394;
    }
 
  .has-error .chosen-container{
   border: 1px solid #ed5565;
    }  
    
</style>

<form id="defaultForm2" name="defaultForm2" method="post" class="form-horizontal"  action="javascript:save();" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	<h4 class="modal-title" id="myModalLabel">Form Riwayat Jabatan Struktural</h4>
    </div>
    <div class="modal-body">    	
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-6">                                      
                    <div class="form-group">
        				<label class="col-sm-4 control-label">NRK</label>
                    	<div class="col-sm-8">
                    		<input type="text" id="nrk" name="nrk" placeholder="NRK" class="form-control" value="<?php echo isset($nrk) ? $nrk : '' ?>" readOnly="true">
                    	</div>
                    </div>

                    <div class="form-group pickerpicker" id="data_1">
                        <label class="col-sm-4 control-label">TMT</label>
                        <?php if($action == 'update'){ ?>
                            <div class="input-group col-sm-8 date tmt_date">
                                <span class="input-group-addon" style="display: none"><i class="fa fa-calendar"></i></span><input type="text" id="tmt" name="tmt" placeholder="TMT" value="<?php echo isset($infoJabatan->TMT) ? $infoJabatan->TMT : '' ?>" class="form-control" readonly="readonly" >
                            </div>
                        <?php } else { ?>
                            <div class="input-group col-sm-7 date tmt_date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmt"  name="tmt" placeholder="TMT" value="<?php echo isset($infoJabatan->TMT) ? $infoJabatan->TMT : '' ?>" class="form-control" readonly="readonly">
                            </div>
                        <?php } ?>
                    </div>

         			<div class="form-group pickerpicker">
        				<label class="col-sm-4 control-label">Lokasi Kerja</label>
                    	<div class="col-sm-8">     
                    		<?php if($action == 'update'){ ?>
                            <input type="hidden" id="kolok_pk" name="kolok_pk" value="<?php echo $kolok;?>">
                            <?php } ?>
                           <!--  <select class="form-control chosen-kolok" name="kolok" id="kolok" data-placeholder="Pilih Lokasi..." >
                                <option value=""></option>
                                <?php //echo $listKolok; ?>
                                <!--
                         		<script type="text/javascript">
                         		var select = $('#kolok');

								select.chosen();

								select.on('chosen:updated', function () {
								    if (select.attr('readonly')) {
								        var wasDisabled = select.is(':disabled');

								        select.attr('disabled', 'disabled');
								        select.data('chosen').search_field_disabled();

								        if (wasDisabled) {
								            select.attr('disabled', 'disabled');
								        } else {
								            select.removeAttr('disabled');
								        }
								    }
								});

								select.trigger('chosen:updated');
                         		</script>
                            </select> -->

                            <?php //} else {?>
                            <select class="form-control chosen-kolok" name="kolok" id="kolok" data-placeholder="Pilih Lokasi...">
                                <option value=""></option>
                                <?php echo $listKolok; ?> 
                            </select>
                            <?php //} ?>
                    	</div>
                    </div>

                    <div class="form-group pickerpicker">
        				<label class="col-sm-4 control-label">Jabatan</label>
                    	<div class="col-sm-8"> 
                    		<?php if($action == 'update') { ?>
                            <input type="hidden" id="kojab_pk" name="kojab_pk" value="<?php echo $kojab;?>">  
                            <?php } ?>              
                    		<!-- <select class="form-control chosen-kojab" name="kojab" id="kojab" data-placeholder="Pilih Jabatan..." >
                                <option value=""></option>-->
                                <?php //echo $listKojab; ?>

                            <!--    <script type="text/javascript">
                         		var selectJ = $('#kojab');

								selectJ.chosen();

								selectJ.on('chosen:updated', function () {
								    if (selectJ.attr('readonly')) {
								        var wasDisabled = selectJ.is(':disabled');

								        selectJ.attr('disabled', 'disabled');
								        selectJ.data('chosen').search_field_disabled();

								        if (wasDisabled) {
								            selectJ.attr('disabled', 'disabled');
								        } else {
								            selectJ.removeAttr('disabled');
								        }
								    }
								});

								selectJ.trigger('chosen:updated');
                         		</script> 
                            </select> -->
                    		<?php //} else { ?>               		
                            <select class="form-control chosen-kojab" name="kojab" id="kojab" data-placeholder="Pilih Jabatan...">
                                <option></option>
                                <?php echo $listKojab; ?> 
                            </select>
                            <?php //} ?>
                    	</div>
                    </div>

                    <?php if($action == 'update'){ ?>   
                        <?php if($infoJabatan->TGAKHIR == null){ ?>
                        <div class="form-group pickerpicker" id="data_2" style="display:none">
                            <label class="col-sm-4 control-label">Tgl. Akhir</label>
                            <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgakhir" name="tgakhir" placeholder="Tgl. Akhir" value="<?php echo isset($infoJabatan->TGAKHIR) ? $infoJabatan->TGAKHIR : '' ?>" class="form-control" readonly="readonly">
                            </div>
                        </div>
                        <?php } else{ ?>
                        <div class="form-group pickerpicker" id="data_2">
                            <label class="col-sm-4 control-label">Tgl. Akhir</label>
                            <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgakhir" name="tgakhir" placeholder="Tgl. Akhir" value="<?php echo isset($infoJabatan->TGAKHIR) ? $infoJabatan->TGAKHIR : '' ?>" class="form-control" readonly="readonly">
                            </div>
                        </div>
                        <?php } ?>

                    <?php } else { ?>

                    <div class="form-group pickerpicker" id="data_2" style="display:none" >
                        <label class="col-sm-4 control-label">Tgl. Akhir</label>
                        <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgakhir" name="tgakhir" placeholder="Tgl. Akhir" value="<?php echo isset($infoJabatan->TGAKHIR) ? $infoJabatan->TGAKHIR : '' ?>" class="form-control" readonly="readonly">
                        </div>
                    </div>

                    <?php } ?>

                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Lokasi Gaji</label>
                        <div class="col-sm-8">
                            <?php //if($action == 'update'){ ?>
                            <!-- <select class="form-control chosen-klogad" name="klogad" id="klogad" data-placeholder="Pilih Lokasi Gaji..." onchange="setSpmu()">
                                <option value=""></option>
                                <?php //echo $listKlogad; ?>

                                <script type="text/javascript">
                                var select = $('#klogad');

                                select.chosen();

                                select.on('chosen:updated', function () {
                                    if (select.attr('readonly')) {
                                        var wasDisabled = select.is(':disabled');

                                        select.attr('disabled', 'disabled');
                                        select.data('chosen').search_field_disabled();

                                        if (wasDisabled) {
                                            select.attr('disabled', 'disabled');
                                        } else {
                                            select.removeAttr('disabled');
                                        }
                                    }
                                });

                                select.trigger('chosen:updated');
                                </script>
                            </select> -->

                            <?php //} else {?>
                            <select class="form-control chosen-klogad" name="klogad" id="klogad" data-placeholder="Pilih Lokasi Gaji..." onchange="setSpmu()">
                                <option value=""></option>
                                <?php echo $listKlogad; ?> 
                            </select>
                            <?php //} ?>
                        </div>
                    </div>

                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">SKPD</label>
                        <div class="col-sm-8">
                            
                          <input type="hidden" id="spmu" name="spmu" placeholder="SKPD" value="<?php echo isset($infoJabatan->SPMU) ? $infoJabatan->SPMU : ""; ?>" class="form-control" maxlength="4" readonly>

                          <input type="text" id="spmu2" name="spmu2" placeholder="SKPD" value="<?php echo isset($nmSPMU) ? $nmSPMU : ""; ?>" class="form-control"  readonly>

                          
                        </div>
                    </div>
                    
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Pangkat</label>
                        <div class="col-sm-8">                        
                            <!-- <select class="form-control chosen-kopang" name="kopang" id="kopang" tabindex="2" data-placeholder="Pilih Pangkat...">
                                <option></option>                                
                            </select> -->
                            <!-- <input type="hidden" id="kopang" name="kopang" placeholder="Kode Pangkat" class="form-control" value="<?php echo isset($lastPangkat->KOPANG) ? $lastPangkat->KOPANG : '' ?>" readOnly="true">
                            <input type="text" readonly="true" id="napang" class="form-control" rows="1" value="<?php if(isset($lastPangkat->NAPANG)){
                                    echo $lastPangkat->KOPANG." - ".$lastPangkat->NAPANG." (".$lastPangkat->GOL.")";
                                    
                                } ?>"> -->
                             <?php //if($action == 'update'){ ?>                   
                            <!-- <select class="form-control chosen-kopang" readonly="readonly" name="kopang" id="kopang"  data-placeholder="Pilih Kode Pangkat...">
                                <option value=""></option>
                                <?php echo $listKopang; ?>
                                <script type="text/javascript">
                                var select = $('#kopang');

                                select.chosen();

                                select.on('chosen:updated', function () {
                                    if (select.attr('readonly')) {
                                        var wasDisabled = select.is(':disabled');

                                        select.attr('disabled', 'disabled');
                                        select.data('chosen').search_field_disabled();

                                        if (wasDisabled) {
                                            select.attr('disabled', 'disabled');
                                        } else {
                                            select.removeAttr('disabled');
                                        }
                                    }
                                });

                                select.trigger('chosen:updated');
                                </script> 
                            </select> -->
                        <?php// } else { ?>
                            <select class="form-control chosen-kopang" name="kopang" id="kopang"  data-placeholder="Pilih Kode Pangkat...">
                                <option value=""></option>
                                <?php echo $listKopang; ?> 
                            </select>
                        <?php //} ?>  
                        </div>
                    </div>
                    
                </div>
                <!-- END SIDE 1 -->
                <!-- START SIDE 2 -->
                <div class="col-md-6">   			 
        		
        			
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Eselon</label>
                        <div class="col-sm-8">                      
                            <select class="form-control chosen-eselon" name="eselon" id="eselon" tabindex="2" data-placeholder="Pilih Eselon...">
                                <option></option>
                                <?php echo $listEselon; ?> 
                            </select>
                        </div>
                    </div>

                    <!-- <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Eselon</label>
                        <div class="col-sm-8">                      
                            <select class="form-control chosen-eselon" name="eselon" id="eselon" tabindex="2" data-placeholder="Pilih Eselon...">
                                <option></option>
                                <?php echo $listEselon; ?> 
                            </select>
                        </div>
                    </div> -->

                   	<div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Jenis SK</label>
                        <div class="col-sm-8">                      
                            <select class="form-control chosen-jensk" name="jensk" id="jensk" tabindex="2" data-placeholder="Pilih Jenis SK....">
                                <option></option>
                                <?php echo $listjensk; ?> 
                            </select>
                        </div>
                    </div>   			         		        			        			 
        		
        			<div class="form-group pickerpicker">
        				<label class="col-sm-4 control-label">No. SK</label>
                    	<div class="col-sm-8">
                    		<input type="text" id="nosk" name="nosk" placeholder="No. SK" maxlength="25" value="<?php echo isset($infoJabatan->NOSK) ? $infoJabatan->NOSK: ""; ?>" class="form-control">
                    	</div>
                    </div>
        			      		
        			<div class="form-group pickerpicker" id="data_3">
                        <label class="col-sm-4 control-label">Tgl. SK</label>
                        <div class="input-group col-sm-7 date">                            		
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgsk" name="tgsk" placeholder="Tgl. SK" value="<?php echo isset($infoJabatan->TGSK) ? $infoJabatan->TGSK: ""; ?>" class="form-control" readonly="readonly">
                    	</div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Pejabat Penanda Tangan</label>
                        <div class="col-sm-8">
                            <select class="form-control chosen-pejtt" name="pejtt" id="pejtt" tabindex="2" data-placeholder="Pilih Pejabat Penanda Tangan...">
                                <option></option>
                                <?php echo $listPejtt; ?> 
                            </select>
                        </div>
                    </div>
        			 
                    <!-- <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Kode Sort</label>
                        <div class="col-sm-8">
                            <input type="text" id="kdsort" name="kdsort" minlength="1" maxlength="1" onkeypress="return numbersonly1(this, event)" placeholder="Kode sort (0-9)" value="<?php echo isset($infoJabatan->KDSORT) ? $infoJabatan->KDSORT: ""; ?>" class="form-control">
                        </div>
                    </div> -->
        		
        			 <!--<div class="form-group pickerpicker">
        				<label class="col-sm-4 control-label">Kredit</label>
                    	<div class="col-sm-8">
                    		<input type="text" id="kredit" name="kredit" maxlength="4" onkeypress="return numbersonly1(this, event)" placeholder="Kredit" value="<?php echo isset($infoJabatan->KREDIT) ? $infoJabatan->KREDIT: ""; ?>" class="form-control">
                    	</div>
                    </div>

        			<div class="form-group pickerpicker">
        				<label class="col-sm-4 control-label">STATUS</label>                	
                        <div class="col-sm-8">                          
                              <div class="i-checks inline"><label> <input type="radio" name="status" <?php echo isset($infoJabatan->STATUS) ? ($infoJabatan->STATUS == 0 ? "checked" : "") : ""; ?> value="0"> <i></i> Aktif </label></div>&nbsp;&nbsp;&nbsp;
                          <div class="i-checks inline"><label> <input type="radio" name="status" <?php echo isset($infoJabatan->STATUS) ? ($infoJabatan->STATUS == 1 ? "checked" : "") : ""; ?> value="1"> <i></i> Non-Aktif </label></div>
                        </div>
                    </div>    	-->

                    <div class="form-group pickerpicker" id="data_15" style="display:none">
                        <label class="col-sm-4 control-label">TMT Pensiun</label>
                        <div class="input-group col-sm-7 date">                                 
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmtpensiun" name="tmtpensiun" placeholder="TMT Pensiun" value="<?php echo isset($infoJabatan->TMTPENSIUN) ? $infoJabatan->TMTPENSIUN: ""; ?>" class="form-control" readonly="readonly">
                        </div>
                    </div>		 


                    <div class="form-group">

                        <label class="col-sm-4 control-label">Kredit</label>
                        <div class="col-sm-8">
                            
                            <input type="text" id="kredit" name="kredit" onkeypress="return isNumberKey(event, this)" onblur="return isValidNumber()"  maxlength="8" placeholder="Kredit" value="<?php echo isset($infoJabatan->KREDIT) ? $infoJabatan->KREDIT : 0; ?>" class="form-control">
                            <label class="text-danger"><small>*Penginputan Angka Desimal pada field KREDIT menggunakan karakter '.' (TITIK)</small></label>
                        </div>
        		
        			<!--<div class="form-group pickerpicker">
        				<label class="col-sm-4 control-label">CKOJABF</label>
                    	<div class="col-sm-8">
                    		<input type="text" id="ckojabf" name="ckojabf" maxlength="6" placeholder="CKOJABF" value="<?php echo isset($infoJabatan->CKOJABF) ? $infoJabatan->CKOJABF : ""; ?>" class="form-control">
                    	</div>
                    </div>-->
                                    
                </div>
                <!-- END SIDE 2 -->
            </div>	            			            			        	
           
    	
    </div>
    <div class="modal-footer">
        <span class="pull-left">
            <label class="msg text-success"></label>
            <label class="err text-danger"></label>
        </span>
    	<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
    	<button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

 <script type="text/javascript">
            
            
            $(document).ready(function(){
                //$('#tmt').attr('data-date-end-date','0d')
                
                setSpmu();
                $('input').on('change', function(){
                    $('.has-error i.form-control-feedback').hide();
                    $('.has-success i.form-control-feedback').hide();
                })

                $('#klogad').on('change', function(){
                    setSpmu();
                })

                $('#defaultForm2').bootstrapValidator({
                    live: 'enabled',
                    excluded : 'disabled',
                    message: 'This value is not valid',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                       tmt: {
                            validators: {
                            	date: {
				                        format: 'DD-MM-YYYY',
				                        message: 'Date is not valid'
				                },
                                notEmpty: {
                                    message: 'TMT tidak boleh kosong'
                                }
                            }
                        },kolok: {
                            validators: {
                                notEmpty: {
                                    message: 'Lokasi tidak boleh kosong'
                                }
                            }
                        },
                        
                        <?php //if($action=="tambah"):?>
                        klogad: {
                            validators: {
                                notEmpty: {
                                    message: 'Lokasi Gaji tidak boleh kosong'
                                }
                            }
                        },
                        <?php //endif; ?>

                        kojab: {
                            validators: {
                                notEmpty: {
                                    message: 'Jabatan tidak boleh kosong'
                                }
                            }
                        },kopang: {
                            validators: {
                                notEmpty: {
                                    message: 'Pangkat tidak boleh kosong'
                                }
                            }
                        },eselon: {
                            validators: {
                                notEmpty: {
                                    message: 'Eselon tidak boleh kosong'
                                }
                            }
                        },pejtt: {
                            validators: {
                                notEmpty: {
                                    message: 'Pejabat Penanda Tangan tidak boleh kosong'
                                }
                            }
                        },
                        /*jensk: {
                            validators: {
                                notEmpty: {
                                    message: 'Jenis SK tidak boleh kosong'
                                }
                            }
                        },*/
                        nosk: {
                            validators: {
                                notEmpty: {
                                    message: 'NO. SK tidak boleh kosong'
                                }
                            }
                        },tgsk: {
                            validators: {
                            	 date: {
			                        format: 'DD-MM-YYYY',
			                        message: 'Date is not valid'
			                    },
                                notEmpty: {
                                    message: 'Tgl. SK tidak boleh kosong'
                                }
                            }
                        },tgakhir: {
                            validators: {
                            	 date: {
			                        format: 'DD-MM-YYYY',
			                        message: 'Date is not valid'
			                    }
                            }
                        },kredit: {
                            validators: {
                                notEmpty: {
                                    message: 'Kredit tidak boleh kosong, Isi dengan 0 jika tidak ada nilai kredit'
                                }
                            }
                        },status: {
                            validators: {
                                notEmpty: {
                                    message: 'Status tidak boleh kosong'
                                }
                            }
                        }
                    }
                });

//                var d = new Date();
//                <?php //if ($action=='update'){?>
//                d = new Date('<?php //echo date('m-d-Y', strtotime($infoJabatan->TMT)); ?>//');
//                <?php //} ?>
                //console.log(d);

                $('#data_1 .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    showDropdowns: true,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy",
//                    endDate: 'infinity',
                    endDate: new Date()
                    }).on('changeDate', function(e) {
    	            // Revalidate the date field
    	               $('#defaultForm2').bootstrapValidator('revalidateField', 'tmt');
    				});

<!--                --><?php //if ($action=='update'){?>
//                $('#data_1 .input-group.date').datepicker('disable');
//                <?php //} ?>

                //$('#tmt').datepicker({ maxDate: new Date() });
                $('#data_2 .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy"
                    //endDate: new Date()
                }).on('changeDate', function(e) {
	            // Revalidate the date field
	            $('#defaultForm2').bootstrapValidator('revalidateField', 'tgakhir');
				});

                $('#data_3 .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy",
                    endDate: new Date()
                }).on('changeDate', function(e) {
	            // Revalidate the date field
	            $('#defaultForm2').bootstrapValidator('revalidateField', 'tgsk');
				});

                $('#data_15 .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy"

                });

                /*START CHOSEN*/
                var config = {
                  '.chosen-kolok'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
                  '.chosen-kojab'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
                  '.chosen-kopang'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
                  '.chosen-klogad'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
                  '.chosen-eselon'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
                  '.chosen-jensk'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
                  '.chosen-pejtt'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
                  '.chosen-spmu'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"}
                }
                for (var selector in config) {
                  $(selector).chosen(config[selector]);
                }


                /*END CHOSEN*/                    

            });

            $(function() {
                $("#kolok").on("change", function(event) {
                    event.preventDefault();

                    str = this.value;   
                    var res = str.substr(0, 8);

                    if (res == '11111111'){
                        var mydate = new Date();
                        var dd = mydate.getDate();
                        var mm = mydate.getMonth();
                        ynew1=mydate.getFullYear()-1;
                        ynew2=mydate.getFullYear()+1;

                        if(dd<10) {
                            dd='0'+dd
                        } 

                        if(mm<10) {
                            mm='0'+mm
                        } 

                        start_date = dd+"-"+mm+"-"+ynew1;
                        end_date = dd+"-"+mm+"-"+ynew2;
                        // alert(end_date);
                        $("#data_1 .input-group.date").datepicker('setStartDate', start_date);
                        $("#data_1 .input-group.date").datepicker('setEndDate', end_date);
                    } else {
                        var mydate = new Date();
                        var dd = mydate.getDate();
                        var mm = mydate.getMonth()+1;
                        ynew1=mydate.getFullYear()-1;
                        ynew2=mydate.getFullYear();

                        if(dd<10) {
                            dd='0'+dd
                        } 

                        if(mm<10) {
                            mm='0'+mm
                        } 

                        start_date = dd+"-"+mm+"-"+ynew1;
                        end_date = dd+"-"+mm+"-"+ynew2;

                        $("#data_1 .input-group.date").datepicker('setStartDate', start_date);
                        $("#data_1 .input-group.date").datepicker('setEndDate', end_date);
                       /* var tmtnow = $("#tmt").val();
                        
                        if(tmtnow=='')
                        {
                            //alert('asd');
                        }
                        else if(tmtnow>end_date)
                        {
                            $("#tmt").val(end_date);
                        }
                        else
                        {
                            $("#tmt").val(tmtnow);
                        }*/
                         
                    }
                    
                    getKojabNew()
                    
                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/home/getKolok",
                        type: "post",
                        data: {kolok : $('#kolok').val()},
                        dataType: 'json',
                        beforeSend: function() {                                                        
                            $('select#klogad').hide();
                        },
                        success: function(data) { 
                                       
                            if(data.response == 'SUKSES'){
                                 $('#klogad').html(data.listKolok);
                            }else{
                                 $('#klogad').html('');
                            }

                        },
                        error: function(xhr) {                              
                            alert("Terjadi kesalahan. Silahkan coba kembali");                            
                        },
                        complete: function() {                            
                            $(".chosen-klogad").trigger("chosen:updated");
                            setSpmu();
                        }
                    });
                });

                $("#kojab").on("change", function() {
                    /*var val = $(this).val();
//                    console.log(val);
                    if(val == '000008'){
                        $('.tmt_date > span').remove();
                        $('.tmt_date > input').remove();
                        var test = '<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmt"  name="tmt" placeholder="TMT" value="<?php echo isset($infoJabatan->TMT) ? $infoJabatan->TMT : '' ?>" class="form-control" readonly="readonly" data-provide="datepicker" data-date-format="dd-mm-yyyy">';
                        $(".tmt_date").html(test);
                        //$('#tmt').removeAttr('data-date-end-date');
                        //$('#tmt').attr('data-date-end-date','')
                    }else if(val != '000008'){
                        $('.tmt_date > span').remove();
                        $('.tmt_date > input').remove();
                        var test = '<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmt"  name="tmt" placeholder="TMT" value="<?php echo isset($infoJabatan->TMT) ? $infoJabatan->TMT : '' ?>" class="form-control" readonly="readonly" data-provide="datepicker" data-date-end-date="0d">';
                        $(".tmt_date").html(test);
                    }*/


                    str = this.value;   
                    
                    //var res = str.substr(0, 8);

                    if (str == '000006' || str == '000007' || str == '000008' || str == '000009'){
                        var mydate = new Date();
                        var dd = mydate.getDate();
                        var mm = mydate.getMonth();
                        ynew1=mydate.getFullYear()-1;
                        ynew2=mydate.getFullYear()+1;

                        if(dd<10) {
                            dd='0'+dd
                        } 

                        if(mm<10) {
                            mm='0'+mm
                        } 

                        start_date = dd+"-"+mm+"-"+ynew1;
                        end_date = dd+"-"+mm+"-"+ynew2;
                        // alert(end_date);
                        $("#data_1 .input-group.date").datepicker('setStartDate', start_date);
                        $("#data_1 .input-group.date").datepicker('setEndDate', end_date);
                    } else {
                        var mydate = new Date();
                        var dd = mydate.getDate();
                        var mm = mydate.getMonth()+1;
                        ynew1=mydate.getFullYear()-1;
                        ynew2=mydate.getFullYear();

                        if(dd<10) {
                            dd='0'+dd
                        } 

                        if(mm<10) {
                            mm='0'+mm
                        } 

                        start_date = dd+"-"+mm+"-"+ynew1;
                        end_date = dd+"-"+mm+"-"+ynew2;

                        $("#data_1 .input-group.date").datepicker('setStartDate', start_date);
                        $("#data_1 .input-group.date").datepicker('setEndDate', end_date);
                        /*var tmtnow = $("#tmt").val();
                        
                        if(tmtnow=='')
                        {
                            //alert('asd');
                        }
                        else if(tmtnow>end_date)
                        {
                            $("#tmt").val(end_date);
                        }
                        else
                        {
                            $("#tmt").val(tmtnow);
                        }*/
                         
                    }

                    showtgAkhir();
                    return false;
                });



                <?php if($action == 'tambah'): ?>
            function getCurrentInformation(){
                var nrk = $('#nrk').val();
                $.ajax({
                    url: '<?php echo site_url('riwayat/getcurrentinformation'); ?>',
                    type: 'post',
                    data: {nrk: nrk},
                    dataType: 'json',
                    success: function(data){
                            //console.log(data);
                            if(data.KOLOK != null)
                            {
                                $('#kolok').val(data.KOLOK).trigger('chosen:updated');
                                getKojabNew();
                                if(data.KLOGAD !=null)
                                {
                                    $('#klogad').val(data.KLOGAD).trigger('chosen:updated')
                                    setSpmu();    
                                }
                                
                            }
                            
                    }
                })
            }

            getCurrentInformation();
            <?php endif; ?>
            }); 
            
            function getKojabNew(){
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/home/getKojabStruktural",
                    type: "post",
                    data: {kolok : $('#kolok').val()},
                    dataType: 'json',
                    beforeSend: function() {                                                        
                        $('select#kojab').hide();
                    },
                    success: function(data) {                            
                        if(data.response == 'SUKSES'){
                             $('#kojab').html(data.listKojab);
                        }else{
                             $('#kojab').html('');
                        }
    
                    },
                    error: function(xhr) {                              
                        alert("Terjadi kesalahan. Silahkan coba kembali");                            
                    },
                    complete: function() {                            
                        $(".chosen-kojab").trigger("chosen:updated");
                    }
                });
            }

            
            function numbersonly1(myfield, e, dec) 
            {   
                var key; 
                var keychar; 
                if (window.event)
                    key = window.event.keyCode; 
                else if (e) 
                    key = e.which; 
                else 
                    return true; 
                keychar = String.fromCharCode(key); 

                // control keys 
                if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) ) 
                return true; 

                // numbers 
                else if ((("0123456789").indexOf(keychar) > -1))
                 return true; 

                // decimal point jump 
                else if (dec && (keychar == ".")) 
                { 
                    myfield.form.elements[dec].focus(); return false; 
                } 
                else 
                    return false; 
            }

            function isNumberKey(evt, obj) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                var value = obj.value;
                var dotcontains = value.indexOf(".") != -1;
                if (dotcontains)
                    if (charCode == 46) return false;
                if (charCode == 46) return true;
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            }
            function isValidNumber()
            {
                var inp = $('#kredit').val();
                var cek_pjg=inp.length;
                
                var get_akhir= inp.charAt(cek_pjg-1);
                var hasil;

                

                    if(cek_pjg == 5)
                    {
                        if(get_akhir == '.')
                        {
                            hasil = inp.substr(0,4);   
                            $('#kredit').val(hasil);

                        }
                        else
                        {
                            hasil=inp;
                            if(hasil<10000)
                            {
                                 var flhasil=parseFloat(hasil).toFixed(3);
                                $('#kredit').val(flhasil);   
                            }
                            else
                            {
                                swal({type:"warning",title:"nilai Kredit tidak boleh melebihi 9999"});
                                
                                $('#kredit').val(9999.999);       
                            }
                        }
                    }
                    else
                    {
                        if(get_akhir == '.')
                        {
                            hasil = inp.substr(0,cek_pjg-1);

                            if(hasil<10000)
                            {
                                $('#kredit').val(hasil);    
                            }
                            else
                            {
                                swal({type:"warning",title:"nilai Kredit tidak boleh melebihi 9999"});
                                $('#kredit').val(9999.999);       
                            }
                        }
                        else
                        {
                            hasil=inp;
                            if(hasil<10000)
                            {
                                var flhasil=parseFloat(hasil).toFixed(3);
                                $('#kredit').val(flhasil);    
                            }
                            else
                            {
                                swal({type:"warning",title:"nilai Kredit tidak boleh melebihi 9999"});
                                $('#kredit').val(9999.999);       
                            }
                            
                        }  
                    }
                    
                    
                

                //$('#kredit').val(hasil);
            }

            function showtgAkhir() 
            {
                
                if(document.getElementById('kojab').value == '000008' || document.getElementById('kojab').value == '000006' || document.getElementById('kojab').value == '000007' || document.getElementById('kojab').value == '000018'){
                    document.getElementById('data_2').style.display = "";
                    
                }else{
                    document.getElementById('data_2').style.display = "none";
                }
            }

            function setSpmu(){
            klogad = $('#klogad').val();

            $.ajax({
                url: '<?php echo base_url("index.php/pegawai/getSpmuByKlogad"); ?>',
                type: "post",
                data: {
                    klogad: klogad
                },
                dataType: 'text',
                beforeSend: function() {
                    $('.msg').html('');
                    $('.err').html("");
                },
                success: function(data) {
                    $('#spmu').val(data);
                },
                error: function(xhr) {
                    $('.msg').html('');
                    $('.err').html("<small>Terjadi kesalahan</small>");
                },
                complete: function() {

                }
                
            });
            $.ajax({
                url: '<?php echo base_url("index.php/pegawai/getKetSpmuByKlogad"); ?>',
                type: "post",
                data: {
                    klogad: klogad
                },
                dataType: 'text',
                beforeSend: function() {
                    $('.msg').html('');
                    $('.err').html("");
                },
                success: function(data) {
                    $('#spmu2').val(data);
                },
                error: function(xhr) {
                    $('.msg').html('');
                    $('.err').html("<small>Terjadi kesalahan</small>");
                },
                complete: function() {

                }
                
            });
        }

            function save()
            {
                var url;
                if(save_method == 'update')
                {
                    url = "<?php echo site_url('riwayat/ajax_update_jab_hist')?>";
                }
                else
                {    
                    url = "<?php echo site_url('riwayat/ajax_add_jab_hist')?>";
                }
               
                  $.ajax({
                    url : url,
                    type: "POST",
                    data: $('#defaultForm2').serialize(),
                    dataType: "JSON",
                    beforeSend: function() {                                                        
                        $('.msg').html('<div><div class="sk-spinner sk-spinner-rotating-plane"></div></div>');
                        $('.err').html("");
                    },
                    success: function(data)
                    {
                       
                       if(data.response == 'SUKSES'){
                            $('.msg').html('<small>Data berhasil disimpan.</small>');
                            $('.err').html('');

                            $('#myModal').modal('hide');
                            setTimeout(function () {
                                reload();
                            }, 1000);                        

                        }
                        else if(data.response == 'WARNING'){
                            $('.msg').html('');
                            $('.err').html('');
                
                            swal({type:"warning",title:"DATA GAGAL DISIMPAN", text:"TMT SUDAH DIGUNAKAN, MOHON PERIKSA KEMBALI RIWAYAT JABATAN STRUKTURAL MAUPUN FUNGSIONAL"});
                        }
                        else{
                            $('.msg').html('');
                            $('.err').html('');
                
                            swal({type:"warning",title:"DATA GAGAL DISIMPAN", text:"TMT SUDAH DIGUNAKAN, MOHON PERIKSA KEMBALI RIWAYAT JABATAN STRUKTURAL MAUPUN FUNGSIONAL"});
                        }                       
                       
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        //alert('Error adding / update data');
                        swal({type:"warning",title:"GAGAL TAMBAH/UBAH DATA"});
                    },
                    complete: function() {                            
                        //location.reload();
                    }
                });
            }

</script>
