	
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

<form id="defaultForm2" name="defaultForm2" method="post" class="form-horizontal" action="javascript:save();" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	<h4 class="modal-title" id="myModalLabel">Form Riwayat Gaji Pokok</h4>
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
              
        			<div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Kode Pangkat</label>
                        <div class="col-sm-7">     
                        <?php// if($action == 'update'){ ?>                   
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
                        <?php //} else { ?>
                            <select class="form-control chosen-kopang" name="kopang" id="kopang"  data-placeholder="Pilih Kode Pangkat...">
                                <option value=""></option>
                                <?php echo $listKopang; ?> 
                            </select>
                        <?php //} ?>                            
                        </div>
                    </div> 
        		      
        			<div class="form-group pickerpicker" id="data_1">
                        <label class="col-sm-4 control-label"><font color="blue">TMT</font></label>
                        <?php if($action == 'update'){ ?>
                            <div class="col-sm-7 date">
                                <span class="input-group-addon" style="display: none"><i class="fa fa-calendar"></i></span><input type="text" id="tmt" name="tmt" placeholder="TMT" value="<?php echo isset($infoGapok->TMT) ? date('d-m-Y', strtotime($infoGapok->TMT)) : '' ?>" class="form-control" readonly>
                            </div>
                        <?php } else { ?>
                            <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmt"  name="tmt" placeholder="TMT" value="<?php echo isset($infoGapok->TMT) ? $infoGapok->TMT : '' ?>" class="form-control" readonly>
                            </div>
                            <input type="hidden" id="tmtnow" name="tmtnow" value="<?php echo isset($ttbb->DATENOW) ? $ttbb->DATENOW : ""; ?>">
                        <?php } ?>
                    </div>

                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Jenis Perubahan</label>
                        <div class="col-sm-7">
                        <?php  if($action=='update'){ ?>
                            <select class="form-control chosen-jenrub" readonly="readonly" name="jenrub" id="jenrub" data-placeholder="Pilih Jenis Perubahan...">
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
                            </select> 

                        <?php }else{ ?>                        
                            <select class="form-control chosen-jenrub" name="jenrub" id="jenrub" data-placeholder="Pilih Jenis Perubahan...">
                                <option></option>
                                <?php echo $listJenrub; ?> 
                            </select>

                        <?php } ?>
                        </div>
                    </div> 

                    <!-- <div class="form-group pickerpicker" id="data_3"> -->
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Tahun Ref Gaji</label>
                        <?php //if($action == 'update'){ ?>
                            <!-- <div class="col-sm-7 date">
                                <span class="input-group-addon" style="display: none"><i class="fa fa-calendar"></i></span><input type="text" id="tahun_refgaji" name="tahun_refgaji" placeholder="Tahun Ref Gaji" value="<?php echo isset($infoGapok->TAHUN_REFGAJI) ? $infoGapok->TAHUN_REFGAJI : date('Y'); ?>" class="form-control" readonly>
                            </div> -->
                        <?php //} else { ?>
                            <!-- <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tahun_refgaji"  name="tahun_refgaji" placeholder="Tahun Gaji" value="<?php echo isset($infoGapok->TAHUN_REFGAJI) ? $infoGapok->TAHUN_REFGAJI : date('Y') ?>" class="form-control" readonly>
                            </div> -->
                            <div class="col-sm-7">
                             <select class="form-control chosen-thn" name="tahun_refgaji" id="tahun_refgaji"  data-placeholder="Pilih Tahun Referensi Gaji...">
                                <option value=""></option>
                                <?php echo $listthref; ?> 
                            </select>
                            </div>
                        <?php //} ?>
                    </div>
                    
                    

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tahun Masa Kerja</label>
                        <div class="col-sm-7">
                            <?php if($action == 'update'){ ?> 
                                <input type="text" id="ttmasker" name="ttmasker" placeholder="" value="<?php echo isset($infoGapok->TTMASKER) ? $infoGapok->TTMASKER : ""; ?>" class="form-control" maxlength="2" >

                             <?php } else { ?>
                                
                                <input type="text" id="ttmasker" name="ttmasker" placeholder="Tahun Masa Kerja" value="<?php echo isset($infoGapok->TTMASKER) ? $infoGapok->TTMASKER : ""; ?>" class="form-control" maxlength="2" onkeypress="return numbersonly1(this, event)">
                                
                               
                                

                                 <input type="hidden" id="ttmaskt" name="ttmaskt" placeholder="Tahun Masa Kerja" value="<?php echo isset($ttbb->TTMSKNOW) ? "$ttbb->TTMSKNOW" : ""; ?>" class="form-control" maxlength="2" onkeypress="return numbersonly1(this, event)">

                             <?php } ?>

                            <!--<input type="hidden" id="maxmasker" name="maxmasker" placeholder="" value="<?php //echo isset($maxmasker) ? $maxmasker : ""; ?>" class="form-control" maxlength="2">-->
                        </div>
                    </div>
                   

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Bulan Masa Kerja</label>
                        <div class="col-sm-7">
                            <?php if($action == 'update'){ ?> 
                            <input type="text" maxlength="2"  id="bbmasker" name="bbmasker" placeholder="Bulan Masa Kerja" value="<?php echo isset($infoGapok->BBMASKER) ? $infoGapok->BBMASKER : ""; ?>" class="form-control" onkeypress="return numbersonly1(this, event)">
                        <?php } else { ?>
                            
                            <input type="text" maxlength="2"  id="bbmasker" name="bbmasker" placeholder="Bulan Masa Kerja" value="<?php echo isset($infoGapok->BBMASKER) ? $infoGapok->BBMASKER : ""; ?>" class="form-control" onkeypress="return numbersonly1(this, event)">
                            
                            
                            <input type="hidden" maxlength="2" id="bbmaskt" name="bbmaskt" placeholder="Bulan Masa Kerja" value="<?php echo isset($ttbb->BBMSKNOW) ? $ttbb->BBMSKNOW : ""; ?>" class="form-control">
                            
                        <?php } ?>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><font color="blue">Gaji Pokok</font></label>
                        
                        <div class="col-sm-7">
                            <input type="hidden" id="gapokPK" name="gapokPK" value="<?php echo isset($infoGapok->GAPOK) ? number_format($infoGapok->GAPOK,0,',','.') : 0; ?>" class="form-control" readOnly="readonly">
                            <input type="text" id="gapok" name="gapok" readonly="true" alt="int12" placeholder="Gaji Pokok" value="<?php echo isset($infoGapok->GAPOK) ? number_format($infoGapok->GAPOK,'0',',','.') : ""; ?>" class="form-control" readonly="readonly">

                            <!-- buat membantu perhitungan gaji-->
                            <input type="hidden" id="gapokF" name="gapokF" placeholder="GAPOK" value="<?php echo isset($infoGapok->GAPOK) ? number_format($infoGapok->GAPOK,0,',','.') : 0; ?>" class="form-control" readOnly="readonly">

                            <!-- menyimpan gaji PK saat update-->
                            <!-- <input type="text" id="gapokDB" name="gapokDB" placeholder="GAPOK" value="<?php echo isset($infoGapok->GAPOK) ? number_format($infoGapok->GAPOK,0,',','.') : 0; ?>" class="form-control" readOnly="readonly"> -->
                        </div>
                    </div>

                      
                </div>
                <!-- END SIDE 1 -->
                <!-- START SIDE 2 -->
                <div class="col-md-6">
                    
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Kode Lokasi</label>
                        <div class="col-sm-7">                            
                            <?php //if($action == 'update'){ ?>
                            
                            <!-- <select class="form-control chosen-kolok" name="kolok" id="kolok" data-placeholder="Pilih Lokasi..." >
                                <option value=""></option>
                                <?php echo $listKolok; ?>

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
                        <label class="col-sm-4 control-label">Lokasi Gaji</label>
                        <div class="col-sm-7">     
                                   
                            <?php //if($action == 'update'){ ?>
                            <!-- <select class="form-control chosen-klogad" name="klogad" id="klogad" data-placeholder="Pilih Lokasi Gaji..." onchange="setSpmu()">
                                <option value=""></option>
                                <?php // echo $listKlogad; ?>

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
                        <div class="col-sm-7">
                            
                            <input type="hidden" id="spmu" name="spmu" placeholder="" value="<?php echo isset($infopeg->SPMU) ? $infopeg->SPMU : ""; ?>" class="form-control" maxlength="4" readonly>

                            <input type="text" id="spmu2" name="spmu2" placeholder="SKPD" value="<?php echo isset($nmSPMU) ? $nmSPMU : ""; ?>" class="form-control"  readonly>
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
                
                    <div class="form-group">
                        <label class="col-sm-4 control-label">NO. SK</label>
                        <div class="col-sm-7">
                            <input type="text" id="nosk" name="nosk" maxlength="50" placeholder="NOSK" value="<?php echo isset($infoGapok->NOSK) ? $infoGapok->NOSK: ""; ?>" class="form-control">
                        </div>
                    </div>
                  
                     
                
                    <div class="form-group pickerpicker" id="data_2">
                        <label class="col-sm-4 control-label">Tgl. SK</label>
                        <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgsk" name="tgsk" placeholder="Tgl. SK" value="<?php echo isset($infoGapok->TGSK) ? date('d-m-Y', strtotime($infoGapok->TGSK)) : ""; ?>" class="form-control" readonly>
                        </div>
                    </div>
                  
                     
                
                    <div class="form-group">
                        <label class="col-sm-4 control-label">TTMASYAD</label>
                        <div class="col-sm-7">
                            <input type="text" id="ttmasyad" name="ttmasyad" placeholder="TTMASYAD" maxlength="2" onkeypress="return numbersonly1(this, event)" value="<?php echo isset($infoGapok->TTMASYAD) ? $infoGapok->TTMASYAD : ""; ?>" class="form-control" readonly="readonly">
                           
                        </div>
                    </div>
          
                     
                
                    <div class="form-group">
                        <label class="col-sm-4 control-label">BBMASYAD</label>
                        <div class="col-sm-7">
                            <input type="text" id="bbmasyad" name="bbmasyad" placeholder="BBMASYAD" maxlength="2" onkeypress="return numbersonly1(this, event)" value="<?php echo isset($infoGapok->BBMASYAD) ? $infoGapok->BBMASYAD : ""; ?>" class="form-control" readonly="readonly">
                           
                        </div>
                    </div>
       				
       				<input type="hidden" id="stapeg" name="stapeg" placeholder="STAPEG" value="<?php echo isset($stapeg->STAPEG) ? $stapeg->STAPEG : ""; ?>" class="form-control" readonly="readonly">
       				<input type="hidden" id="kojab" name="kojab" placeholder="KOJAB" value="<?php echo isset($stapeg->KOJAB) ? $stapeg->KOJAB : ""; ?>" class="form-control" readonly="readonly">
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
        <button type="submit" class="btn btn-primary" id="but_save">Simpan</button>
    </div>
</form>

<script src="<?php echo base_url(); ?>assets/js/meiomask.js"></script>
<script type="text/javascript">



function numbersonly1(myfield, e, dec) 
    {   
        var key; 
        var keychar; 
        if (window.event)
            key = window.event.keyCode; 
            //key =Math.min(Math.max(parseInt(window.event.keyCode), 1), 11)
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

function onchangeLimitNumber()
{
    var bbmsk = $('#bbmasker').val();
    if(bbmsk>11)
    {
        swal('nilai maksimal adalah 11');
        $('#bbmasker').val(11);
    }
}

$(document).ready(function(){
    jQuery(function($){
          
           $("#gapok").setMask();
        });   
        setSpmu();
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
                        message: 'The date is not a valid'
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
            kolok: {
                validators: {
                    notEmpty: {
                        message: 'Lokasi kerja harus dipilih'
                    }
                }
            },
            
            klogad: {
                validators: {
                    notEmpty: {
                        message: 'Lokasi Gaji harus dipilih'
                    }
                }
            }/*,
            tahun_refgaji: {
                    validators: {
                        notEmpty: {
                            message: 'Tahun Ref Gaji harus dipilih'
                        }
                    }
            }*/,nosk: {
                validators: {
                    notEmpty: {
                        message: 'No. SK tidak boleh kosong'
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
            },ttmasker: {
                validators: {
                    notEmpty: {
                        message: 'Tahun Masa Kerja tidak boleh kosong'
                    }
                }
            },bbmasker: {
                validators: {
                    notEmpty: {
                        message: 'Bulan Masa Kerja tidak boleh kosong'
                    }
                }
            },
            jenrub: {
                validators: {
                    notEmpty: {
                        message: 'Jenis Perubahan harus dipilih'
                    }
                }
            }
            //==============
        }
    });

    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy"
        //endDate: new Date()
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
                    endDate : new Date()
                }); 



    /*START CHOSEN*/
    var config = {
      '.chosen-kolok'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-thn'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
       '.chosen-klogad'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-kopang'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-jenrub'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-jensk'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    /*END CHOSEN*/
   /* $('#but_save').on('click', function(event){
    	event.preventDefault();
        var jnrb = $('#jenrub').val()

        if(jnrb==2 || jnrb == 5 || jnrb ==6 || jnrb == 9 || jnrb ==10)
        {
            save();
        }
        else
        {

            //swal({type:"warning",title:"PERINGATAN!!", text:"ANDA TIDAK DAPAT MENGUBAH DATA, LAKUKAN PERUBAHAN DI RIWAYAT PANGKAT"});
            //return false;
        }
        
    })*/

    $('#klogad').on('change', function(){
        setSpmu();
    })
    
    $(function() {
    		//(document.getElementById('ttmaskt').value != 'undefined' && document.getElementById('bbmaskt').value != 'undefined') ? onChangeTB() : '';
           

            $("#tmt").on("change", function(event) {
                event.preventDefault();
                onChangeTMT();
                
                if($('#kopang').val() != "")
                {
                    onChangeKopang();
                    onchangeTTmasker();
                    onchangeMasyad();
                }
              

            });
    		
			$("#tahun_refgaji").on("change", function(event) {
                event.preventDefault();

                 onChangeKopang();
                 stopTTBB(); 
            });

            $("#kopang").on("change", function(event) {
                event.preventDefault();
                onChangeKopang();
                onchangeMasyad();
                stopTTBB();
            });

            
            $("#ttmasker").on("change", function(event) {
            event.preventDefault();
            
            onchangeTTmasker();
            onchangeMasyad();
            stopTTBB();
             $('#defaultForm2').bootstrapValidator('revalidateField', 'ttmasker');
            });

			$("#bbmasker").on("change", function(event) {
            event.preventDefault();
            onchangeLimitNumber();
            onchangeTTmasker();
            onchangeMasyad();
            $('#defaultForm2').bootstrapValidator('revalidateField', 'bbmasker');
            });            

            $("#jenrub").on("change", function(event) {
            event.preventDefault();
        
            onchangeJenrub();
            onChangeKopang();
            
            });

    });

});

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
                         
                        var bulan = data.newbbmsk;
                        var tahun = data.newttmsk;
                        var newbulan=0;
                        var newtahun = 0;

                        if(bulan >= 12)
                        {
                            newtahun = parseInt(tahun)+1;
                            newbulan = parseInt(bulan)-12;
                            $('#ttmasker').val(newtahun);

                            $('#bbmasker').val(newbulan);
                        }
                        else
                        {
                            $('#ttmasker').val(data.newttmsk);

                        $('#bbmasker').val(data.newbbmsk);
    
                        }

                         $('#defaultForm2').bootstrapValidator('revalidateField', 'ttmasker');
              $('#defaultForm2').bootstrapValidator('revalidateField', 'bbmasker');
                        //console.log($('#ttmasker').val());
                        //console.log($('#bbmasker').val());

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
                       stopTTBB();
                       
                    }else{
                        $('#ttmasker').val(0);
                        $('#bbmasker').val(0);
                    }
                     $('#defaultForm2').bootstrapValidator('revalidateField', 'ttmasker');
              $('#defaultForm2').bootstrapValidator('revalidateField', 'bbmasker');
                         
                },
                error: function(xhr) {
                    alert("Terjadi kesalahan. Silahkan coba kembali");
                },
                complete: function() {
                    $(".chosen-ttmasker").trigger("chosen:updated");
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
                         stopTTBB();
                        $('#gapok').val();
                        $('#gapokF').val(data.gapok);
                       onchangeJenrub();
                       stopTTBB();
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
                       stopTTBB();

                        }else{
                           
                             $('#ttmasyad').html('');
                             $('#bbmasyad').html('');
                        }
                    }

                },
                error: function(xhr) {
                    
                    alert("Kode Pangkat Isi Terlebih dahulu ");
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
                        if($('#jenrub').val() == '12')
                        {
                        	stopTTBB();
                            hitung1 =parseInt(fix_gaji)*0.8;
                            hasil = toRp(hitung1);
                            $('#gapok').val(hasil);
                        }
                        else if($('#jenrub').val() == '10')
                        {
                        	stopTTBB();
                            hitung2 =parseInt(fix_gaji)*0.75;
                            hasil = toRp(hitung2);
                            $('#gapok').val(hasil);
                        }
                        else
                        {
               				onchangeMasyad();
                            $('#gapok').val(gaji);
                        }
    }

    function stopTTBB()
    {
    	var stapeg = $('#stapeg').val();
    	var jenrub = $('#jenrub').val();
    	var kojab = $('#kojab').val();
    	var ttmasyad = $('#ttmasyad').val();
    	var bbmasyad = $('#bbmasyad').val();

    	if(stapeg == '1' || jenrub == '12' || jenrub == '10' || kojab=='999910')
    	{
    		$('#ttmasyad').val(0);
    		$('#bbmasyad').val(0);
    	}
    	
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

    function setSpmu()
    {
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
        url = "<?php echo site_url('home/ajax_update_gapok')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_gapok')?>";
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
                swal({type:"warning",title:"DATA GAGAL DISIMPAN", text:"NRK,TMT DAN GAJI POKOK SUDAH DIGUNAKAN, PERIKSA KEMBALI DATA YANG DIINPUT"});
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert(jqXHR+':::'+textStatus+'Error adding / update data. '+errorThrown);
        },
        complete: function() {

        }
    });
}
            
</script>