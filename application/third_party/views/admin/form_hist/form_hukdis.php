<script src="<?php echo base_url('assets/js/moment.min.js') ?>"></script>
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
    	<h4 class="modal-title" id="myModalLabel">Form Riwayat Hukuman Disiplin</h4>
    </div>
    <div class="modal-body">
    	
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-sm-4 control-label"><font color="blue">NRK</font></label>
                      <div class="col-sm-7">
                        <input type="text" id="nrk" name="nrk" placeholder="NRK" maxlength="6" value="<?php echo isset($nrk) ? $nrk : ""; ?>" class="form-control" readOnly="true"> 
                      </div>
                    </div>
                    

                    <div class="form-group pickerpicker" id="data_1">
                        <label class="col-sm-4 control-label"><font color="blue">Tgl. SK</font></label>
                        <?php if($action == 'update'){ ?>
                            <div class="col-sm-8 date">
                                <span class="input-group-addon" style="display: none"><i class="fa fa-calendar"></i></span><input type="text" id="tgsk" name="tgsk" placeholder="TGSK" value="<?php echo isset($infoHukdis->TGSK) ? date('d-m-Y', strtotime($infoHukdis->TGSK)) : '' ?>" class="form-control" readonly>
                            </div>
                        <?php } else { ?>
                            <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgsk"  name="tgsk" placeholder="TGSK" value="<?php echo isset($infoHukdis->TGSK) ? date('d-m-Y', strtotime($infoHukdis->TGSK)) : '' ?>" class="form-control" readonly="readonly">
                            </div>
                        <?php } ?>
                    </div>

                     

                    <div class="form-group">
                      <label class="col-sm-4 control-label">No. SK</label>
                      <div class="col-sm-7">
                         <input type="text" id="nosk" name="nosk" placeholder="Nomor SK" maxlength="20" value="<?php echo isset($infoHukdis->NOSK) ? $infoHukdis->NOSK : ""; ?>" class="form-control">
                      </div>
                    </div>                
                          
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Jenis Hukuman</label>
                      <div class="col-sm-7">                     
                        <select class="chosen-jenhukdis" name="jenhukdis" id="jenhukdis" tabindex="2" data-placeholder="Pilih Jenis Hukuman Disiplin..." onchange="onChangeJenhukdis();">
                            <option value=""></option>
                            <?php echo $listjenishukdis; ?>
                          </select>
                      </div>
                    </div>
                    
                    <div class="form-group pickerpicker" id="data_2">
                      <label class="col-sm-4 control-label">Tgl. Mulai</label>
                       <?php //if($action == 'update'){ ?>

                        <!-- <div class="col-sm-8 date">
                                <span class="input-group-addon" style="display: none"><i class="fa fa-calendar"></i></span><input type="text" id="tgmulai" name="tgmulai" placeholder="Tgl. Mulai" value="<?php //echo isset($infoHukdis->TGMULAI) ? date('d-m-Y', strtotime($infoHukdis->TGMULAI)) : '' ?>" class="form-control" readonly>
                        </div>   -->

                        <?php// } else { ?>


                       <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" id="tgmulai" name="tgmulai" onchange="onChangeJenhukdis();" placeholder="Tgl. Mulai" 
                            value="<?php 
                                    echo isset($infoHukdis->TGMULAI) ? date('d-m-Y', strtotime($infoHukdis->TGMULAI)) : ''; 
                                    ?>" class="form-control" readonly="readonly">
                      </div>
                      <?php //} ?>
                    </div>


                    <div class="form-group pickerpicker" id="data_3">
                      <label class="col-sm-4 control-label">Tgl. Berakhir</label>
                      <?php //if($action == 'update'){ ?>
                        <!-- <div class="col-sm-8 date">
                                <span class="input-group-addon" style="display: none"><i class="fa fa-calendar"></i></span><input type="text" id="tgakhir" name="tgakhir" placeholder="Tgl. Akhir" value="<?php //echo isset($infoHukdis->TGAKHIR) ? date('d-m-Y', strtotime($infoHukdis->TGAKHIR)) : '' ?>" class="form-control" readonly>
                        </div>     -->
                      <?php //} else { ?>
                      <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" id="tgakhir" name="tgakhir" placeholder="Tgl. Selesai" value="<?php echo isset($infoHukdis->TGAKHIR) ? date('d-m-Y', strtotime($infoHukdis->TGAKHIR)) : ''; ?>" class="form-control" readonly="readonly">
                      </div>
                      <?php //} ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-sm-4 control-label">Pejabat Penanda Tanganan</label>
                      <div class="col-sm-7">
                          <select class="chosen-pejtt" name="pejtt" id="pejtt" tabindex="2" data-placeholder="Pilih Pejabat Penanda Tanganan...">
                            <option value=""></option>
                            <?php echo $listPejtt; ?>
                          </select>
                      </div>
                    </div>

                    <!-- <div class="form-group pickerpicker" id="data_6">
                      <label class="col-sm-4 control-label">TMT Mulai StopTKD</label>
                       <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" id="mulaistoptkd" name="mulaistoptkd" placeholder="Tgl. Mulai" value="<?php echo isset($infoHukdis->TMTMULAI_STOPTKD) ? date('d-m-Y', strtotime($infoHukdis->TMTMULAI_STOPTKD)) : ""; ?>" class="form-control" readonly="readonly" >


                            
                      </div>
                    </div> -->

                    <div class="form-group pickerpicker" id="data_65">
                      <label class="col-sm-4 control-label">TMT Mulai StopTKD</label>
                      
                      <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" id="mulaistoptkd" name="mulaistoptkd" placeholder="Tgl. Mulai" value="<?php echo isset($infoHukdis->TMTMULAI_STOPTKD) ? date('d-m-Y', strtotime($infoHukdis->TMTMULAI_STOPTKD)) : ''; ?>" class="form-control" readonly="readonly" data-date-format="dd-mm-yyyy">
                      </div>
                      
                    </div>

                    <div class="form-group">
                      <label class="col-sm-4 control-label">Jumlah StopTKD</label>
                      <div class="col-sm-7">
                         <input type="text" id="blnstoptkd" name="blnstoptkd" placeholder="Jumlah Stop TKD (BULAN)" maxlength="2" value="<?php echo isset($infoHukdis->JMLBLN_STOPTKD) ? $infoHukdis->JMLBLN_STOPTKD : ""; ?>" class="form-control" onkeypress="return numbersonly1(this, event)">
                      </div>
                    </div>

                    <div class="form-group pickerpicker" id="data_7">
                      <label class="col-sm-4 control-label">TMT Akhir StopTKD</label>
                       <div class="input-group col-sm-7">
                            <input type="text" id="akhirstoptkd" name="akhirstoptkd" placeholder="Tgl. Akhir" value="<?php echo isset($infoHukdis->TMTAKHIR_STOPTKD) ? date('d-m-Y', strtotime($infoHukdis->TMTAKHIR_STOPTKD)) : ""; ?>" class="form-control" readonly="readonly" data-date-format="dd-mm-yyyy">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-4 control-label">Keterangan</label>
                      <div class="col-sm-7">
                         <input type="text" id="ket" name="ket" placeholder="Keterangan" maxlength="100" value="<?php echo isset($infoHukdis->KET) ? $infoHukdis->KET : ""; ?>" class="form-control">
                      </div>
                    </div>  

                </div>
                <!-- END SIDE 2 -->            
            </div>	            			            			        	
           
    	
    </div>
    <div class="modal-footer">
  	    <span class="pull-left">
            <label class="msg text-success"></label>
            <label class="err text-danger"></label>
        </span>
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="tutup_modal">Tutup</button>
        <button type="submit" class="btn btn-primary" id="button_simpan">Simpan</button>
    </div>
</form>

<script type="text/javascript">

$(document).ready(function(){
	//onChangeJenhukdis();
    //$('#button_simpan').prop('disabled', true);
    $('#blnstoptkd').on('keyup', function(e){
        if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)){
            return false;
        }
    })
    
    $('#mulaistoptkd').on('change', function(){
        var blnstop = $('#blnstoptkd').val();
        var awaltgl = $('#mulaistoptkd').datepicker('getDate');
        if(awaltgl == 'Invalid Date' || !blnstop){
            $('#akhirstoptkd').val('');
        }else{
            //$('#akhirstoptkd').datepicker('setDate', awaltgl);
            awaltgl.setMonth(awaltgl.getMonth() + parseInt(blnstop));
            $('#akhirstoptkd').datepicker('setDate', awaltgl);
            $('.datepicker').hide();
        }
    })
    
    $('#blnstoptkd').on('keyup', function(){
        var blnstop = $('#blnstoptkd').val();
        var awaltgl = $('#mulaistoptkd').datepicker('getDate');
        if(awaltgl == 'Invalid Date' || !blnstop){
            $('#akhirstoptkd').val('');
        }else{
            //$('#akhirstoptkd').datepicker('setDate', awaltgl);
            awaltgl.setMonth(awaltgl.getMonth() + parseInt(blnstop));
            $('#akhirstoptkd').datepicker('setDate', awaltgl);
           
        }
    })
    
    /*$('#akhirstoptkd, #mulaistoptkd').on('change', function(){
        var akhirtgl = moment($('#akhirstoptkd').datepicker('getDate'));
        var awaltgl = moment($('#mulaistoptkd').datepicker('getDate'));
        $(this).datepicker('hide');
        if(akhirtgl == 'Invalid Date' && awaltgl == 'Invalid Date'){
            $('#blnstoptkd').val('');
        }else{
            if(akhirtgl <= awaltgl){
                $(this).datepicker('hide');
                $('#akhirstoptkd').val('');
                $('#blnstoptkd').val('');
                sweetAlert("Oops...", "TMT akhir tidak boleh kurang/sama dari TMT mulai!", "error");
            }else{
                //var rumus = (akhirtgl - awaltgl)/1000/60/60/24;
                //$('#blnstoptkd').val(rumus + ' hari');
                //var hari_cek = akhirtgl.diff(awaltgl, 'days');
                var bln_cek = akhirtgl.diff(awaltgl, 'months');
                //var thn_cek = akhirtgl.diff(awaltgl, 'years');
                if(bln_cek == 0){
                    $('#blnstoptkd').val(bln_cek + 1);
                }else if(bln_cek > 0){
                    $('#blnstoptkd').val(bln_cek);
                }
            }
        }
    })*/

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
            
            tgsk: {
                validators: {
                    notEmpty: {
                        message: 'Tgl. SK tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            
            },
            nosk: {
                validators: {
                    notEmpty: {
                        message: 'No. SK tidak boleh kosong'
                    }
                }
            },
            jenhukdis: {
                validators: {
                    notEmpty: {
                        message: 'Jenis Hukuman harus dipilih'
                    }
                }
            },tgmulai: {
                validators: {
                    notEmpty: {
                        message: 'Tgl. Mulai tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'The date is not a valid'
                    }
                }
            },tgakhir: {
                validators: {
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'The date is not a valid'
                    }
                }
            },
            mulaistoptkd: {
                validators: {
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'The date is not a valid'
                    }
                }
            },
            akhirstoptkd: {
                validators: {
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'The date is not a valid'
                    }
                }
            },
            pejtt: {
                validators: {
                    notEmpty: {
                        message: 'Pejabat Penanda Tangan tidak boleh kosong'
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
        format: "dd-mm-yyyy",
        endDate: new Date()
    }).on('changeDate', function(e) {
            // Revalidate the date field
            $('#defaultForm2').bootstrapValidator('revalidateField', 'tgsk');
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
            $('#defaultForm2').bootstrapValidator('revalidateField', 'tgmulai');
        });

    $('#data_3 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy"
        
    }).on('changeDate', function(e) {
            // Revalidate the date field
            $('#defaultForm2').bootstrapValidator('revalidateField', 'tgakhir');
        });

    $('#data_65 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy"
    }).on('changeDate', function(e) {
            // Revalidate the date field
            $('#defaultForm2').bootstrapValidator('revalidateField', 'mulaistoptkd');
        });

    $('#data_7 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy"
    }).on('changeDate', function(e) {
            // Revalidate the date field
            $('#defaultForm2').bootstrapValidator('revalidateField', 'akhirstoptkd');
        });

    /*START CHOSEN*/
    var config = {
      '.chosen-jenhukdis'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-pejtt'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    /*END CHOSEN*/

});

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

function save()
{
    var url;
    if(save_method == 'update')
    {
        url = "<?php echo site_url('home/ajax_update_hukdis')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_hukdis')?>";
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
                swal({type:"warning",title:"DATA GAGAL DISIMPAN", text:"TANGGAL SK SUDAH DIGUNAKAN, MOHON PERIKSA KEMBALI DATA YANG DIINPUT"});
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            //alert('Error adding / update data');
        },
        complete: function() {
            /*swal({
              title: 'Berhasil!',
              text: 'Data berhasil disimpan.',
              timer: 2000
            })
            $('#tutup_modal').click();*/
            //location.reload();
        }
    });
}

function onChangeJenhukdis()
{
	var ubah= $('#jenhukdis').val();

	var tglStart = $('#tgmulai').val();

	if(tglStart != '' && ubah != '')
	{
		
		fortg=tglStart.split('-');
		var mydate = new Date(fortg[2],fortg[1]-1,fortg[0]);
		var dnew = fortg[0];
		var mnew = fortg[1];
		var ynew;
		var date_new;
		if(ubah == '9')
		{
			ynew=mydate.getFullYear()+1;
			date_new = dnew +'-'+ mnew +'-'+ ynew;

			$('#tgakhir').val(date_new);
		}
		else if(ubah == '13')
		{
			ynew=mydate.getFullYear()+3;
			date_new = dnew +'-'+ mnew +'-'+ ynew;
			$('#tgakhir').val(date_new);
		}
		else
		{
			ynew=mydate.getFullYear();
			date_new = dnew +'-'+ mnew +'-'+ ynew;
			$('#tgakhir').val('');
		}	
		
	}

	
}
</script>
