
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
        <h4 class="modal-title" id="myModalLabel">Form Riwayat Litsus</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-6">
                   <div class="form-group pickerpicker" id="data_1">
                        <label class="col-sm-4 control-label">Tanggal</label>
                        <?php if($action == 'update'){ ?>
                            <div class="input-group col-sm-6 date">
                                <span class="input-group-addon" style="display:none"><i class="fa fa-calendar"></i></span><input type="text" id="tgl" name="thpajak"  value="<?php echo isset($infoLitsus->TGL) ? $infoLitsus->TGL : ""; ?>" class="form-control" readonly="true">
                            </div>
                        <?php } else { ?>
                            <div class="input-group col-sm-6 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgl" name="tgl" placeholder="Tanggal" value="<?php echo isset($infoLitsus->TGL) ? $infoLitsus->TGL : ""; ?>" class="form-control" readonly="true">
                            </div>
                        <?php } ?>
                    </div>   

    	            <div class="form-group pickerpicker">
    	              <label class="col-sm-4 control-label">NRK</label>
    	              <div class="input-group col-sm-6">
    	                      <input type="text" class="form-control" name="nrk" id="nrk"  value="<?php echo isset($nrk) ? $nrk : ''; ?>" readonly="true">  
                    </div>
    	            </div>


                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Dasar</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="dasar" name="dasar" placeholder="Dasar" maxlength="25" class="form-control" value="<?php echo isset($infoLitsus->DASAR) ? $infoLitsus->DASAR : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Keperluan</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="keperluan" name="keperluan" placeholder="Keperluan" maxlength="20" class="form-control" value="<?php echo isset($infoLitsus->KEPERLUAN) ? $infoLitsus->KEPERLUAN : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Hasil</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="hasil" name="hasil" placeholder="Hasil (numbers only 1 digit)" maxlength="1" onkeypress="return numbersonly1(this, event)"  class="form-control" value="<?php echo isset($infoLitsus->HASIL) ? $infoLitsus->HASIL : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Pemeriksa Awal</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="pemeriksa_awal" name="pemeriksa_awal" placeholder="Pemeriksa Awal" maxlength="25"  class="form-control" value="<?php echo isset($infoLitsus->PEMERIKSA_AWAL) ? $infoLitsus->PEMERIKSA_AWAL : ''; ?>">
                      </div>
                    </div>


                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Pemeriksa Ulang</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="pemeriksa_ulang" name="pemeriksa_ulang" placeholder="Pemeriksa Ulang" maxlength="25"  class="form-control" value="<?php echo isset($infoLitsus->PEMERIKSA_ULANG) ? $infoLitsus->PEMERIKSA_ULANG : ''; ?>">
                      </div>
                    </div>


                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Kopang Pemeriksa</label>
                      <div class="input-group col-sm-4">
                         <select class="chosen-kopang" name="kopang_pemeriksa" id="kopang_pemeriksa" data-placeholder="Pilih Kode Pangkat...">
                                <option value=""></option>
                                <?php echo $listKopang; ?> 
                            </select>
                      </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NO KTP</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="noktp" name="noktp" placeholder="Nomor KTP" maxlength="20" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoLitsus->NOKTP) ? $infoLitsus->NOKTP : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Bapak Tiri</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="bapak_tiri" name="bapak_tiri" placeholder="Bapak Tiri" maxlength="25" class="form-control" value="<?php echo isset($infoLitsus->BAPAK_TIRI) ? $infoLitsus->BAPAK_TIRI : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Ibu Tiri</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="ibu_tiri" name="ibu_tiri" placeholder="Ibu Tiri" maxlength="25" class="form-control" value="<?php echo isset($infoLitsus->IBU_TIRI) ? $infoLitsus->IBU_TIRI : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Nomor CT</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nomor_ct" name="nomor_ct" placeholder="Nomor CT" maxlength="20" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoLitsus->NOMOR_CT) ? $infoLitsus->NOMOR_CT : ''; ?>">
                      </div>
                    </div>
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Nomor SKHP</label>
                            <div class="input-group col-sm-6">
                                <input type="text" id="nomor_skhp" name="nomor_skhp" placeholder="Nomor SKHP" maxlength="20" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoLitsus->NOMOR_SKHP) ? $infoLitsus->NOMOR_SKHP : ''; ?>">
                            </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Kota Litsus</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="kota_litsus" name="kota_litsus" placeholder="Kota Litsus" maxlength="20" class="form-control" value="<?php echo isset($infoLitsus->KOTA_LITSUS) ? $infoLitsus->KOTA_LITSUS : ''; ?>">
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
            
            tgl: {
                validators: {
                   notEmpty: {
                        message: 'Alamat tidak boleh kosong'
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
                        message: 'Alamat tidak boleh kosong'
                    } 
                }
            },
            dasar: {
                validators: {
                   notEmpty: {
                        message: 'Dasar tidak boleh kosong'
                    } 
                }
            },
            keperluan: {
                validators: {
                   notEmpty: {
                        message: 'Keperluan tidak boleh kosong'
                    } 
                }
            },
            hasil: {
                validators: {
                   notEmpty: {
                        message: 'Hasil tidak boleh kosong'
                    } 
                }
            },
            pemeriksa_awal: {
                validators: {
                   notEmpty: {
                        message: 'Pemeriksa awal tidak boleh kosong'
                    } 
                }
            },
            kopang_pemeriksa: {
                validators: {
                   notEmpty: {
                        message: 'Kopang Pemeriksa tidak boleh kosong'
                    } 
                }
            },
            noktp: {
                validators: {
                   notEmpty: {
                        message: 'Nomor KTP tidak boleh kosong'
                    } 
                }
            },
            nomor_ct: {
                validators: {
                   notEmpty: {
                        message: 'Nomor CT tidak boleh kosong'
                    } 
                }
            },
            nomor_skhp: {
                validators: {
                   notEmpty: {
                        message: 'NOmor SKHP tidak boleh kosong'
                    } 
                }
            },
            kota_litsus: {
                validators: {
                   notEmpty: {
                        message: 'Kota Litsus tidak boleh kosong'
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
        $('#defaultForm2').bootstrapValidator('revalidateField', 'tgl');
        });

    

     

    /*START CHOSEN*/
    var config = {
      '.chosen-kopang'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
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
        url = "<?php echo site_url('home/ajax_update_litsus')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_litsus')?>";
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