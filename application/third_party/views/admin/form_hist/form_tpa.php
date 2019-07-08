
<style type="text/css">
    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
    .pickerpicker .form-control-feedback {
        right: 100px !important;      
    }

    .pickerpicker .form-control-feedback {
        top: 0px !important;
    }

    .input-group[class*="col-"] {
        float: none;
        padding-left: -1px !important;
        padding-right: -1px !important;
    }
</style>

<form id="defaultForm2" name="defaultForm2" method="post" class="form-horizontal"  action="javascript:save();" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Form Riwayat TPA</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-12">
                    
    	            <div class="form-group pickerpicker">
    	              <label class="col-sm-4 control-label">NRK</label>
    	              <div class="input-group col-sm-6">
    	                      <input type="text" class="form-control" name="nrk" id="nrk"  value="<?php echo isset($nrk) ? $nrk : ''; ?>" readonly="true">  
                    </div>
    	            </div>


                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Nomor Serta</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="noserta" name="noserta" placeholder="Nomor Serta (numbers only)" maxlength="20" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTPA->NOSERTA) ? $infoTPA->NOSERTA : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Nilai Verbal</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nilai_verbal" name="nilai_verbal" placeholder="Nilai Verbal (numbers only 5 digit)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTPA->NILAI_VERBAL) ? $infoTPA->NILAI_VERBAL : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Nilai Numeric</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nilai_numeric" name="nilai_numeric" placeholder="Nilai Numerik (numbers only 5 digit)" maxlength="5" onkeypress="return numbersonly1(this, event)"  class="form-control" value="<?php echo isset($infoTPA->NILAI_NUMERIC) ? $infoTPA->NILAI_NUMERIC : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Nilai Logic</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nilai_logic" name="nilai_logic" placeholder="Nilai Logic (numbers only 5 digit)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTPA->NILAI_LOGIC) ? $infoTPA->NILAI_LOGIC : ''; ?>">
                      </div>
                    </div>


                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Total TPA</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="total_tpa" name="total_tpa" placeholder="Total TPA (numbers only)" maxlength="6" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoTPA->TOTAL_TPA) ? $infoTPA->TOTAL_TPA : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker" id="data_2">
                        <label class="col-sm-4 control-label">Tgl. Test TPA</label>
                        <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgl_testtpa" name="tgl_testtpa" placeholder="Tgl. Test TPA" value="<?php echo isset($infoTPA->TGL_TESTTPA) ? $infoTPA->TGL_TESTTPA : '' ?>" class="form-control" readonly="true">
                        </div>
                    </div>
                    
                </div>
                
                <!-- END SIDE 1 -->            
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
            
            tgl_testtpa: {
                validators: {
                   notEmpty: {
                        message: 'Tanggal tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            },
            nrk: {
                validators: {
                   notEmpty: {
                        message: 'NRK tidak boleh kosong'
                    } 
                }
            },
            noserta: {
                validators: {
                   notEmpty: {
                        message: 'Nomor Serta tidak boleh kosong'
                    } 
                }
            },
            nilai_verbal: {
                validators: {
                   notEmpty: {
                        message: 'Nilai Verbal tidak boleh kosong'
                    } 
                }
            },
            nilai_numeric: {
                validators: {
                   notEmpty: {
                        message: 'Nilai Numeric tidak boleh kosong'
                    } 
                }
            },
            nilai_logic: {
                validators: {
                   notEmpty: {
                        message: 'Nilai Logic tidak boleh kosong'
                    } 
                }
            },
            total_tpa: {
                validators: {
                   notEmpty: {
                        message: 'Total TPA tidak boleh kosong'
                    } 
                }
            }
            
          
            //==============
        }
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
        $('#defaultForm2').bootstrapValidator('revalidateField', 'tgl_testtpa');
        });

    

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
        url = "<?php echo site_url('home/ajax_update_testtpa')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_testtpa')?>";
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
                $('.err').html("<small>Data gagal disimpan, silahkan coba kembali.</small>");
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