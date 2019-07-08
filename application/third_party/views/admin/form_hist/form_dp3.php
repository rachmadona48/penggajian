
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
</style>

<form id="defaultForm2" name="defaultForm2" method="post" class="form-horizontal"  action="javascript:save();" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	<h4 class="modal-title" id="myModalLabel">Form Riwayat Daftar Penilaian Pelaksanaan Pekerjaan</h4>
    </div>
    <div class="modal-body">
    	
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-12">
                    <div class="form-group">
        				<label class="col-sm-4 control-label">NRK</label>
                    	<div class="input-group col-sm-3">
                    		<input type="text" id="nrk" name="nrk" placeholder="NRK" class="form-control" value="<?php echo isset($nrk) ? $nrk : '' ?>" readOnly="true">
                    	</div>
                    </div>
                    <div class="hr-line-dashed"></div>
        			 
        		
        			<div class="form-group pickerpicker" id="data_1">
                        <label class="col-sm-4 control-label">Tahun</label>
                        <?php if($action == 'update') { ?>
                    	<div class="input-group col-sm-3 date">
                            <span class="input-group-addon" style="display:none"><i class="fa fa-calendar"></i></span><input type="text" id="tahun" name="tahun" class="form-control" value="<?php echo isset($infoDp3->TAHUN) ? $infoDp3->TAHUN : '2013'; ?>" readonly>
                    	</div>
                        <?php } else { ?>
                        <div class="input-group col-sm-3 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tahun" name="tahun" class="form-control" value="<?php echo isset($infoDp3->TAHUN) ? $infoDp3->TAHUN : '2013'; ?>" readonly>
                        </div>

                        <?php } ?>
                    </div>


                    <div class="hr-line-dashed"></div>    			     		    			
        		</div>	 
        		<div class="col-md-6">
        			<div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Kesetiaan</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="setia" name="setia" placeholder="Kesetiaan" maxlength="5"  onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoDp3->SETIA) ? $infoDp3->SETIA : '' ?>">
                    	</div>
                    </div>
                    

                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Prestasi</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="prestasi" name="prestasi" placeholder="Prestasi" maxlength="5"  onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoDp3->PRESTASI) ? $infoDp3->PRESTASI : '' ?>">
                        </div>
                    </div>
                    

                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Tanggung Jawab</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="tggjawab" name="tggjawab" placeholder="Tanggung Jawab" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoDp3->TGGJAWAB) ? $infoDp3->TGGJAWAB : '' ?>">
                        </div>
                    </div>

                    <div class="form-group pickerpicker" >
                        <label class="col-sm-4 control-label">Ketaatan</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="taat" name="taat" placeholder="Ketaatan" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoDp3->TAAT) ? $infoDp3->TAAT : '' ?>">
                        </div>
                    </div>

                    <div class="form-group pickerpicker" >
                        <label class="col-sm-4 control-label">Kejujuran</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="jujur" name="jujur" placeholder="Kejujuran" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoDp3->JUJUR) ? $infoDp3->JUJUR : '' ?>">
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Kerjasama</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="kerjasama" name="kerjasama" placeholder="Kerjasama" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoDp3->KERJASAMA) ? $infoDp3->KERJASAMA : '' ?>">
                        </div>
                    </div>
                   

                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Prakarsa</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="prakarsa" name="prakarsa" placeholder="Prakarsa" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoDp3->PRAKARSA) ? $infoDp3->PRAKARSA : '' ?>">
                        </div>
                    </div>

                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Kepemimpinan</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="pimpin" name="pimpin" placeholder="Kepemimpinan" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoDp3->PIMPIN) ? $infoDp3->PIMPIN : '' ?>">
                        </div>
                    </div>

                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Jumlah</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="jumlah" name="jumlah" placeholder="Jumlah" maxlength="6" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoDp3->JUMLAH) ? $infoDp3->JUMLAH : '' ?>">
                        </div>
                    </div>

                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Rata-rata</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="rata" name="rata" placeholder="Rata-rata" maxlength="5" onkeypress="return numbersonly1(this, event,event)" class="form-control" value="<?php echo isset($infoDp3->RATA) ? $infoDp3->RATA : '' ?>">
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
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            //==============
            nrk: {
                validators: {
                    notEmpty: {
                        message: 'NRK tidak boleh kosong'
                    }
                }
            },
            
            setia: {
                validators: {
                    notEmpty: {
                        message: 'Kesetiaan tidak boleh kosong'
                    }
                }
            },
            prestasi: {
                validators: {
                    notEmpty: {
                        message: 'Prestasi tidak boleh kosong'
                    }
                }
            },
            tggjawab: {
                validators: {
                    notEmpty: {
                        message: 'Tanggung Jawab tidak boleh kosong'
                    }
                }
            },
            taat: {
                validators: {
                    notEmpty: {
                        message: 'Ketaatan tidak boleh kosong'
                    }
                }
            },
            jujur: {
                validators: {
                    notEmpty: {
                        message: 'Kejujuran tidak boleh kosong'
                    }
                }
            },
            kerjasama: {
                validators: {
                    notEmpty: {
                        message: 'Kerjasama tidak boleh kosong'
                    }
                }
            },
            prakarsa: {
                validators: {
                    notEmpty: {
                        message: 'Prakarsa tidak boleh kosong'
                    }
                }
            },
            pimpin: {
                validators: {
                    notEmpty: {
                        message: 'Kepemimpinan tidak boleh kosong'
                    }
                }
            },
            jumlah: {
                validators: {
                    notEmpty: {
                        message: 'Jumlah tidak boleh kosong'
                    }
                }
            },
            rata: {
                validators: {
                    notEmpty: {
                        message: 'Rata-Rata tidak boleh kosong'
                    }
                }
            }
            //==============
        }
    });

    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        changeyear: false,
        minViewMode: 2,
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy',
        endDate: '2013'
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
        url = "<?php echo site_url('home/ajax_update_dp3')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_dp3')?>";
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