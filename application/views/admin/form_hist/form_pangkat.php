<style type="text/css">
    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
    .pickerpicker .form-control-feedback {
        right: 20px !important;      
    }

    .pickerpicker .form-control-feedback {
        top: 0px !important;
    }

    .input-group[class*="col-"] {
        float: none;
        padding-left: -1px !important;
        padding-right: 2px !important;
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
    	<h4 class="modal-title" id="myModalLabel">Form Riwayat Pangkat</h4>
    </div>
    <div class="modal-body">	
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-6">
                    <div class="form-group">
        				<label class="col-sm-4 control-label"><font color="blue">NRK</font></label>
                    	<div class="col-sm-7">
                    		<input type="text" id="nrk" name="nrk" placeholder="NRK" class="form-control" value="<?php echo isset($nrk) ? $nrk : '' ?>" readOnly="true">
                    	</div>
                    </div>
                   
        			 
        		
        			<div class="form-group pickerpicker" id="data_1">
                        <label class="col-sm-4 control-label"><font color="blue">TMT</font></label>
                        <?php if($action == 'update'){ ?>
                            <div class="col-sm-7 date">
                                <span class="input-group-addon" style="display: none"><i class="fa fa-calendar"></i></span><input type="text" id="tmt" name="tmt" placeholder="TMT" value="<?php echo isset($infoPangkat->TMT) ? date('d-m-Y', strtotime($infoPangkat->TMT)) : '' ?>" class="form-control" readonly>
                            </div>
                        <?php } else { ?>
                            <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmt"  name="tmt" placeholder="TMT" value="<?php echo isset($infoPangkat->TMT) ? $infoPangkat->TMT : '' ?>" class="form-control" readonly="readonly">

                                <input type="hidden" id="tmtnow" name="tmtnow" value="<?php echo isset($ttbb->DATENOW) ? $ttbb->DATENOW : ""; ?>">
                            </div>
                        <?php } ?>
                    </div>
               
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Jenis Perubahan</label>
                        <div class="col-sm-7">
                        <?php //if($action=='update'){ ?>
                           <!--  <select class="form-control chosen-jenrub" readonly="readonly" name="jenrub" id="jenrub" data-placeholder="Pilih Jenis Perubahan...">
                                <option></option>
                                <?php echo $listJenrub; ?> 
                                <script type="text/javascript">
                                var select = $('#jenrub');

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

                        <?php //}else{ ?>                        
                            <select class="form-control chosen-jenrub" name="jenrub" id="jenrub" data-placeholder="Pilih Jenis Perubahan...">
                                <option></option>
                                <?php echo $listJenrub; ?> 
                            </select>

                        <?php //} ?>
                        </div>
                    </div>

                    <!-- <div class="form-group pickerpicker" id="data_3"> -->
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Tahun Ref Gaji</label>
                        <?php //if($action == 'update'){ ?>
                            <!-- <div class="col-sm-7 date">
                                <span class="input-group-addon" style="display: none"><i class="fa fa-calendar"></i></span><input type="text" id="tahun_refgaji" name="tahun_refgaji" placeholder="Tahun Ref Gaji" value="<?php //echo isset($infoPangkat->TAHUN_REFGAJI) ? $infoPangkat->TAHUN_REFGAJI : date('Y'); ?>" class="form-control" readonly>
                            </div> -->
                        <?php //} else { ?>
                            <!-- <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tahun_refgaji"  name="tahun_refgaji" placeholder="Tahun Gaji" value="<?php //echo isset($infoPangkat->TAHUN_REFGAJI) ? $infoPangkat->TAHUN_REFGAJI : date('Y') ?>" class="form-control" readonly>
                            </div> -->
                        <?php //} ?>

                        <div class="col-sm-7">
                             <select class="form-control chosen-thn" name="tahun_refgaji" id="tahun_refgaji"  data-placeholder="Pilih Tahun Referensi Gaji...">
                                <option value=""></option>
                                <?php echo $listthref; ?> 
                            </select>
                        </div>
                    </div>
                  
                
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label"><font color="blue">Kode Pangkat</font></label>
                        <div class="col-sm-7">     
                        <?php if($action == 'update'){ ?>                   
                            <select class="form-control chosen-kopang" readonly="readonly" name="kopang" id="kopang"  data-placeholder="Pilih Kode Pangkat...">
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
                            </select>
                        <?php } else { ?>
                            <select class="form-control chosen-kopang" name="kopang" id="kopang"  data-placeholder="Pilih Kode Pangkat...">
                                <option value=""></option>
                                <?php echo $listKopang; ?> 
                            </select>
                        <?php } ?>                            
                        </div>
                    </div>
                   
                     
                
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Tahun Masa Kerja</label>
                        <div class="col-sm-7">
                            <!--<select class="form-control chosen-ttmasker" name="ttmasker" id="ttmasker" tabindex="2" data-placeholder="Pilih Tahun Masa Kerja...">
                                <option value=""></option>
                                <?php //echo isset($listttmasker) ? $listttmasker : 0 ; ?> 
                            </select>-->
                             <?php if($action == 'update'){ ?> 
                                <input type="text" id="ttmasker" name="ttmasker" placeholder="" value="<?php echo isset($infoPangkat->TTMASKER) ? $infoPangkat->TTMASKER : ""; ?>" class="form-control" maxlength="2" readonly>

                                 <input type="hidden" id="ttmaskt" name="ttmaskt" placeholder="Tahun Masa Kerja" value="<?php echo isset($ttbb->TTMSKNOW) ? $ttbb->TTMSKNOW : ""; ?>" class="form-control" maxlength="2" >

                             <?php } else { ?>
                                
                                <input type="text" id="ttmasker" name="ttmasker" placeholder="Tahun Masa Kerja" value="<?php echo isset($infoPangkat->TTMASKER) ? $infoPangkat->TTMASKER : ""; ?>" class="form-control" maxlength="2" onkeypress="return numbersonly1(this, event)">
                                
                                
                                <input type="hidden" id="ttmaskt" name="ttmaskt" placeholder="Tahun Masa Kerja" value="<?php echo isset($ttbb->TTMSKNOW) ? $ttbb->TTMSKNOW : ""; ?>" class="form-control" maxlength="2" >
                                
                             <?php } ?>

                            <input type="hidden" id="maxmasker" name="maxmasker" placeholder="" value="<?php echo isset($maxmasker) ? $maxmasker : ""; ?>" class="form-control" maxlength="2">
                        </div>
                    </div>
                   
                
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Bulan Masa Kerja</label>
                        <div class="col-sm-7">
                        <?php if($action == 'update'){ ?> 
                            <input type="text" maxlength="2"  id="bbmasker" name="bbmasker" placeholder="Bulan Masa Kerja" value="<?php echo isset($infoPangkat->BBMASKER) ? $infoPangkat->BBMASKER : ""; ?>" class="form-control" readonly>
                        <?php } else { ?>
                               
                            <input type="text" maxlength="2" id="bbmasker" name="bbmasker" placeholder="Bulan Masa Kerja" value="<?php echo isset($infoPangkat->BBMASKER) ? $infoPangkat->BBMASKER : ""; ?>" class="form-control" onkeypress="return numbersonly1(this, event)">
                            
                            <input type="hidden" id="bbmaskt" name="bbmaskt" placeholder="Bulan Masa Kerja" value="<?php echo isset($ttbb->BBMSKNOW) ? $ttbb->BBMSKNOW : ""; ?>" class="form-control">
                           
                        <?php } ?>

                             <input type="hidden" id="ttmasyad" name="ttmasyad" placeholder="TTMASYAD" maxlength="2" value="<?php echo isset($infoGapok->TTMASYAD) ? $infoGapok->TTMASYAD : ""; ?>" class="form-control" readonly="readonly">
                   
                            <input type="hidden" id="bbmasyad" name="bbmasyad" placeholder="BBMASYAD" maxlength="2" value="<?php echo isset($infoGapok->BBMASYAD) ? $infoGapok->BBMASYAD : ""; ?>" class="form-control" readonly="readonly">

                            <input type="hidden" id="bbbytmt" name="bbbytmt" placeholder="BBbytmt" maxlength="2"  class="form-control" readonly="readonly">                            

                        </div>
                    </div>
                  

                    
              
                </div>
                <!-- END SIDE 1 -->
                <!-- START SIDE 2 -->
                <div class="col-md-6">

                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Gaji Pokok</label>
                        <div class="col-sm-7">
                            <input type="text" id="gapok" name="gapok" placeholder="GAPOK" value="<?php echo isset($infoPangkat->GAPOK) ? number_format($infoPangkat->GAPOK,0,',','.') : 0; ?>" class="form-control" readOnly="true">
                             <input type="hidden" id="gapokF" name="gapokF" placeholder="GAPOK" value="<?php echo isset($infoPangkat->GAPOK) ? number_format($infoPangkat->GAPOK,0,',','.') : 0; ?>" class="form-control" readOnly="true">
                        </div>
                    </div>  
                    

        			<div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Lokasi Kerja</label>
                        <div class="col-sm-7">     
                            <?php //if($action == 'update'){ ?>
                            
                            <!-- <select class="form-control chosen-kolok" name="kolok" id="kolok" data-placeholder="Pilih Lokasi..." >
                                <option value=""></option>
                                <?php //echo $listKolok; ?>

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
                            <?php // } ?>
                        </div>
                    </div>
                  
       
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Lokasi Gaji</label>
                        <div class="col-sm-7">
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

                            <?php // } else {?>
                            <select class="form-control chosen-klogad" name="klogad" id="klogad" data-placeholder="Pilih Lokasi Gaji..." onchange="setSpmu()">
                                <option value=""></option>
                                <?php echo $listKlogad; ?> 
                            </select>
                            <?php //} ?>
                        </div>
                    </div>
                  

                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">SKPD</label>
                        <div class="col-sm-7">
                            
                             
                            <input type="hidden" id="spmu" name="spmu" placeholder="SKPD" value="<?php echo isset($infopeg->SPMU) ? $infopeg->SPMU : ""; ?>" class="form-control" readonly>
                            <input type="text" id="spmu2" name="spmu2" placeholder="SKPD" value="<?php echo isset($nmSPMU) ? $nmSPMU : ""; ?>" class="form-control" readonly>
                        </div>
                    </div>
                                          
                     <div class="form-group pickerpicker" style="display:none">
                        <label class="col-sm-4 control-label">Jenis SK</label>
                        <div class="col-sm-8">                      
                            <select class="form-control chosen-jensk" name="jensk" id="jensk" tabindex="2" data-placeholder="Pilih Jenis SK....">
                                <option></option>
                                <?php echo $listjensk; ?> 
                            </select>
                        </div>
                    </div> 
                
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">NO. SK</label>
                        <div class="col-sm-7">
                            <input type="text" id="nosk" name="nosk" placeholder="NOSK" maxlength="50" value="<?php echo isset($infoPangkat->NOSK) ? $infoPangkat->NOSK: ""; ?>" class="form-control">
                        </div>
                    </div>
      
                     
                
                    <div class="form-group pickerpicker" id="data_2">
                        <label class="col-sm-4 control-label">Tgl. SK</label>
                          <div class="input-group col-sm-7 date"> 
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgsk" name="tgsk" placeholder="TGSK" value="<?php echo isset($infoPangkat->TGSK) ? date('d-m-Y', strtotime($infoPangkat->TGSK)) : ""; ?>" class="form-control" readonly="readonly">
                          </div>
                    </div>
             

                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Penanda Tangan SK</label>
                        <div class="col-sm-7">                        
                            <select class="form-control chosen-pejtt" name="pejtt" id="pejtt" tabindex="2" data-placeholder="Penanda Tangan SK">
                                <option></option>
                                <?php echo $listPejtt; ?> 
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="stapegpeg1" name="stapegpeg1" value="">

                </div>
                <!-- END SIDE 2 -->
            </div>	            			            			        	
           	
    </div>
    <div class="modal-footer">
        <span class="pull-left">
            <span class="msg-jenrub"></span>
            <label class="msg text-success"></label>
            <label class="err text-danger"></label>
        </span>
    	<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
    	<button type="submit" class="btn btn-primary" id="simpan_data">Simpan</button>
    </div>
</form>


 <script type="text/javascript">

$(document).ready(function(){
   // $("#simpan_data").prop("disabled", true);
    setSpmu();
   
    //$('#defaultForm2').data('bootstrapValidator').destroy();
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
            //==============
            
            tmt: {
                validators: {
                    notEmpty: {
                        message: 'TMT tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            },
            kopang: {
                validators: {
                    notEmpty: {
                        message: 'Pangkat harus dipilih'
                    }
                }
            },
            jenrub: {
                validators: {
                    notEmpty: {
                        message: 'Perubahan harus dipilih'
                    }
                }
            },
            kolok: {
                validators: {
                    notEmpty: {
                        message: 'Lokasi kerja harus dipilih'
                    }
                }
            },tgsk: {
                validators: {
                    notEmpty: {
                        message: 'Tgl. SK tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'The date is not a valid'
                    }
                }
            // },jensk: {
            //         validators: {
            //             notEmpty: {
            //                 message: 'Jenis SK tidak boleh kosong'
            //             }
            //         }
            },nosk: {
                validators: {
                    notEmpty: {
                        message: 'Nomor SK harus diisi'
                    }
                }
            },pejtt: {
                validators: {
                    notEmpty: {
                        message: 'Pejabat Tertinggi harus dipilih'
                    }
                }
            }
            ,ttmasker: {
                validators: {
                    notEmpty: {
                        message: 'TT Masker harus dipilih'
                    }
                }
            }
            ,bbmasker: {
                validators: {
                    notEmpty: {
                        message: 'BBmasker harus dipilih'
                    }
                }
            }
            
            //==============
        }
    });
    
    $('#jenrub').on('change', function(){
        if($(this).val() == 3){
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/home/check_hukdis",
                type: "post",
                data: {
                    tipe: $(this).val(),
                    nrk : $('#nrk').val(),
                },
                dataType: 'json',
                beforeSend: function() {
                    $("#simpan_data").prop("disabled", true);
                    var spinner = '<div class="spiner-example"><div class="sk-spinner sk-spinner-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div></div>';
                    $(".msg-jenrub").appendTo(spinner);
                },
                success: function(data) {
                    console.log(data);
                    if(data.RES == 0){
                        $("#simpan_data").prop("disabled", false);
                        $(".msg-jenrub").html('');
                    }else{
                        swal("Error!", "Pegawai masih dalam waktu hukuman disiplin", "error");
                    }
                    //console.log(data.RES);
                },
                error: function(xhr) {
                    swal("Error!", "Terjadi kesalahan. Silahkan coba kembali", "error");
                    //alert("Terjadi kesalahan. Silahkan coba kembali");
                },
                complete: function() {
                }
            });
        }else if($(this).val() == 4){
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/home/check_hukdis",
                type: "post",
                data: {
                    tipe: $(this).val(),
                    nrk : $('#nrk').val(),
                },
                dataType: 'json',
                beforeSend: function() {
                    //$("#simpan_data").prop("disabled", true);
                    var spinner = '<div class="spiner-example"><div class="sk-spinner sk-spinner-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div></div>';
                    $(".msg-jenrub").appendTo(spinner);
                },
                success: function(data) {
                    if(data.RES == 0){
                        //$("#simpan_data").prop("disabled", false);
                        $(".msg-jenrub").html('');
                    }else{
                        //swal("Error!", "Pegawai tidak dalam waktu hukuman disiplin", "error");
                        swal({
                                type: "warning",
                                title: "Informasi",
                                text: "Pegawai tidak dalam waktu hukuman disiplin"
                            });
                    }
                    //console.log(data.RES);
                },
                error: function(xhr) {
                    swal("Error!", "Terjadi kesalahan. Silahkan coba kembali", "error");
                    //alert("Terjadi kesalahan. Silahkan coba kembali");
                },
                complete: function() {
                }
            });
        }

    })
    
    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy",
        endDate: '+2m'
    }).on('changeDate', function(e) {
            // Revalidate the date field
            $('#defaultForm2').bootstrapValidator('revalidateField', 'tmt');
        });

    $('#data_2 .input-group.date').datepicker({
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

    $('#data_3 .input-group.date').datepicker({
                    todayBtn: "linked",
                    changeyear: false,
                    minViewMode: 2,
                    keyboardNavigation: false,
                    forceParse: false,
                    autoclose: true,
                    todayHighlight: true,
                    format: 'yyyy',
                    startDate:"2011",
                    endDate : new Date()
                }); 


    /*START CHOSEN*/
    var config = {
      '.chosen-kopang'          : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-ttmasker'        : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-kolok'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-klogad'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-pejtt'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-jenrub'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-thn'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-jensk'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"}

      
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    /*END CHOSEN*/
    
    $('#klogad').on('change', function(){
        setSpmu();
    })
    
    
    $(function() {
            <?php if($action != 'update'){ ?>
                onChangeTB();
            <?php } ?>

            $("#tahun_refgaji").on("change", function(event) {
                event.preventDefault();

                 onChangeKopang(); 
            });

            $("#tmt").on("change", function(event) {
                event.preventDefault();
                onChangeTMT();
                validasivalttbb();
                
                if($('#kopang').val() != "")
                {
                	onChangeKopang();
                    onchangeTTmasker();
                    onchangeMasyad();
                }
              

            });


            $("#kopang").on("change", function(event) {
                event.preventDefault();
                onChangeKopang();
                onchangeMasyad();
            });

       
            
            $("#ttmasker").on("change", function(event) {
            event.preventDefault();
            
            onchangeTTmasker();
            onchangeMasyad();
            
            
            });

            $("#bbmasker").on("change", function(event) {
            event.preventDefault();
            
            onchangeTTmasker();
            onchangeMasyad();
            onchangeValbb();
            });            

            $("#jenrub").on("change", function(event) {
            event.preventDefault();
        
            onchangeJenrub();
            });

             validasivalttbb();
    });

});

    function onchangeValbb()
    {

        var b = $("#bbmasker").val();
        if(b>11)
        {
            swal({type:"warning",title:"INPUT TIDAK VALID", text:"Nilai BBMasker antara 0-11"});
            $("#bbmasker").val($("#bbbytmt").val());
            
        }
    }

     function getStapegCPNS()
    {
        $.ajax({
                url: "<?php echo base_url(); ?>index.php/home/getStapegCPNS",
                type: "post",
                data: {nrk:$('#nrk').val()},
                dataType: 'json',
                beforeSend: function() {

                },
                success: function(data) {
                    if(data.response == 'SUKSES'){

                        var stapeg = data.stapeg;
                         $('#stapegpeg1').val(stapeg);
                      
                        


                }},
                error: function(xhr) {
                    alert("Terjadi kesalahan. Silahkan coba kembali");
                },
                complete: function(data) {
                    
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

    function onChangeTB()
    {
        var a = document.getElementById('ttmaskt').value;
        var b = document.getElementById('bbmaskt').value;
        var c = document.getElementById('tmtnow').value;
        var resA;
        var resB;
        if(b<0)
        {
            resB= eval(12)+eval(b);
            resA= a-1;
            document.getElementById('ttmasker').value=resA;
            document.getElementById('bbmasker').value=resB;
            document.getElementById('tmt').value = c;
        }
        else
        {
             document.getElementById('ttmasker').value=a;
            document.getElementById('bbmasker').value=b;   
            document.getElementById('tmt').value = c;
        }
        

    }

    function validasivalttbb()
    {
        var a = $('#ttmasker').val();
        var b = document.getElementById('bbmasker').value;
        var c = document.getElementById('bbbytmt').value;
        
        var resA;
        var resB;
        if(b>11)
        {
            resB= eval(b)-eval(12);
            resA= eval(a)+eval(1);
            document.getElementById('ttmasker').value=resA;
            document.getElementById('bbmasker').value=resB;
            document.getElementById('bbbytmt').value = resB;
        }
        
    }

    function onChangeKopang()
    {
        $.ajax({
                url: "<?php echo base_url(); ?>index.php/home/getMasaKerjaByKopang",
                type: "post",
                data: {kopang : $('#kopang').val(),tahun_refgaji:$('#tahun_refgaji').val()},
                dataType: 'json',
                beforeSend: function() {
                    $('select#ttmasker').hide();
                },
                success: function(data) {
                     
                    if(data.response == 'SUKSES'){
                         //$('#ttmasker').html(data.listttmasker);
                       onchangeTTmasker();
                      
                       
                    }else{
                        $('#ttmasker').val(0);
                        $('#bbmasker').val(0);
                    }
                         
                },
                error: function(xhr) {
                    alert("Terjadi kesalahan. Silahkan coba kembali");
                },
                complete: function() {
                    $(".chosen-ttmasker").trigger("chosen:updated");
                }
            });
    }

    function onChangeTMT()
    {
    	$.ajax({
                url: "<?php echo base_url(); ?>index.php/home/getMasaKerjaByTMT",
                type: "post",
                data: {nrk:$('#nrk').val(),tmt:$('#tmt').val()},
                dataType: 'json',
                beforeSend: function() {

                },
                success: function(data) {
                    if(data.response == 'SUKSES'){

                        var resA;
                        var resB;

                        var valA= data.newttmsk;
                        var valB= data.newbbmsk;
                        if(valB > 11)
                        {
                            resB = eval(valB)-eval(12);
                            resA = eval(valA)+eval(1);

                            $('#ttmasker').val(resA);

                            $('#bbmasker').val(resB);

                            $('#bbbytmt').val(resB);

                        }
                        else if(valB<0)
                        {
                            resB = eval(12)+eval(valB);
                            resA = eval(valA)-1;

                             $('#ttmasker').val(resA);

                            $('#bbmasker').val(resB);

                            $('#bbbytmt').val(resB);
                        }
                        else
                        {
                            $('#ttmasker').val(valA);

                            $('#bbmasker').val(valB);

                            $('#bbbytmt').val(valB);
                        }                         
                        
                        

                    }else{
                       
                         //alert('no');
                    }


                },
                error: function(xhr) {
                    alert("Terjadi kesalahan. Silahkan coba kembali");
                },
                complete: function(data) {
                    
                }
                });
    }

    function onchangeTTmasker()
    {
        
        $.ajax({
                url: "<?php echo base_url(); ?>index.php/home/getGapokByKopang",
                type: "post",
                data: {tahun_refgaji:$('#tahun_refgaji').val(),kopang : $('#kopang').val(),ttmasker : $('#ttmasker').val(),maxmasker : $('#maxmasker').val()},
                dataType: 'json',
                beforeSend: function() {

                },
                success: function(data) {
                    if(data.response == 'SUKSES'){
                         
                        $('#gapok').val();
                        $('#gapokF').val(data.gapok);
                       onchangeJenrub();

                    }else{
                       
                         $('#gapok').html('');
                    }


                },
                error: function(xhr) {
                    alert("Terjadi kesalahan. Silahkan coba kembali");
                },
                complete: function(data) {
                    
                }
                });
    }
    
    function onchangeMasyad()
    {
        var awalBerkalaTT;
        nowTT = $('#ttmasker').val();
        nowBB = $('#bbmasker').val();
        var maskTT;


        if(nowTT != '' && nowBB !='')
        {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/home/getMasyad",
                type: "post",
                data: {tahun_refgaji:$('#tahun_refgaji').val(),kopang : $('#kopang').val(),ttmasker : $('#ttmasker').val(),bbmasker : $('#bbmasker').val(), minttmask : $('#minttmask').val()},
                dataType: 'json',
                beforeSend: function() {

                },
                success: function(data) {
                    
                    if(parseInt(nowTT) < parseInt(data.minttmask))
                    {
                        alert("input tidak valid, minimal TAHUN MASA KERJA: "+ data.minttmask);
                        $('#ttmasker').val(data.minttmask);
                        $('#ttmasker').focus();
                        onchangeTTmasker();
                        onchangeMasyad();
                    }
                    else
                    {
                        if(data.response == 'SUKSES'){

                        awalBerkalaTT = data.ttmasker;
                        
                        maskTT = nowTT - awalBerkalaTT;
                               
                        $('#ttmasyad').val(maskTT);
                        $('#bbmasyad').val(nowBB);
                       

                        }else{
                           
                             $('#ttmasyad').html('');
                             $('#bbmasyad').html('');
                        }
                    }
                },
                error: function(xhr) {
                    
                    alert("Input tidak valid, pangkat belum dipilih ");
                },
                complete: function(data) {
                    
                }
                });
        }
        
    }

    function onchangeJenrub()
    {
        
                        var gaji = $('#gapokF').val();
                        var gaji_converse = toAngka(gaji);
                        var fix_gaji = gaji_converse;
                        
                        var hitung1;
                        var hitung2
                        var hasil;
                        if($('#jenrub').val() == '1')
                        {
                            hitung1 =parseInt(fix_gaji)*0.8;
                            hasil = toRp(hitung1);
                            $('#gapok').val(hasil);
                        }
                        else if($('#jenrub').val() == '10')
                        {
                            hitung2 =parseInt(fix_gaji)*0.75;
                            hasil = toRp(hitung2);
                            $('#gapok').val(hasil);
                        }
                        else if($('#jenrub').val() == '5')
                        {
                            if($('#stapegpeg1').val() == '1')
                            {
                                hitung1 =parseInt(fix_gaji)*0.8;
                                hasil = toRp(hitung1);
                                $('#gapok').val(hasil);
                            }
                            else
                            {
                                $('#gapok').val(gaji);
                            }
                        }
                        else
                        {
                            $('#gapok').val(gaji);
                        }
    }

    function toAngka(rp)
    {
        return parseInt(rp.replace(/,.*|\D/g,''),10)
    }

    function toRp(angka)
    {
        var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
        var rev2    = '';
        for(var i = 0; i < rev.length; i++){
            rev2  += rev[i];
            if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
                rev2 += '.';
            }
        }
        return rev2.split('').reverse().join('');
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
        url = "<?php echo site_url('home/ajax_update_pangkat')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_pangkat')?>";
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

            }else{
                $('.msg').html('');
                $('.err').html('');
                swal({type:"warning",title:"DATA GAGAL DISIMPAN", text:"NRK, TMT, PANGKAT SUDAH DIGUNAKAN, PERIKSA KEMBALI DATA YANG DIINPUT"});
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
        },
        complete: function() {

        }
    });
}


</script>
