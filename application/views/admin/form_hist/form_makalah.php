
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
        <h4 class="modal-title" id="myModalLabel">Form Riwayat Makalah</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-6">
                    
      	            <div class="form-group pickerpicker">
      	              <label class="col-sm-4 control-label">NRK</label>
      	              <div class="input-group col-sm-6">
      	                      <input type="text" class="form-control" name="nrk" id="nrk"  value="<?php echo isset($nrk) ? $nrk : ''; ?>" readonly="true">  
                      </div>
      	            </div>


                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Nomor Serta</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="noserta" name="noserta" placeholder="Nomor Serta (numbers only)" maxlength="20" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->NOSERTA) ? $infoMKL->NOSERTA : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Setupok</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="setupok" name="setupok" placeholder="Setupok (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->SETUPOK) ? $infoMKL->SETUPOK : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NLAYAK</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nlayak" name="nlayak" placeholder="Nlayak (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->NLAYAK) ? $infoMKL->NLAYAK : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NPROBLEM</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nproblem" name="nproblem" placeholder="NPROBLEM (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->NPROBLEM) ? $infoMKL->NPROBLEM : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">AKTUALMAS</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="aktualmas" name="aktualmas" placeholder="AKTUALMAS (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->AKTUALMAS) ? $infoMKL->AKTUALMAS : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Total Topik</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="total_topik" name="total_topik" placeholder="Total Topik (numbers only)" maxlength="6" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->TOTAL_TOPIK) ? $infoMKL->TOTAL_TOPIK : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Rata Topik</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="rata_topik" name="rata_topik" placeholder="Rata Topik (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->RATA_TOPIK) ? $infoMKL->RATA_TOPIK : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NPENGEMB</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="npengemb" name="npengemb" placeholder="NPENGEMB (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->NPENGEMB) ? $infoMKL->NPENGEMB : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">IPTEK</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="iptek" name="iptek" placeholder="IPTEK (numbers only )" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->IPTEK) ? $infoMKL->IPTEK : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">VISI</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="visi" name="visi" placeholder="VISI (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->VISI) ? $infoMKL->VISI : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Total Wawasan</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="total_wawasan" name="total_wawasan" placeholder="Total Wawasan (numbers only)" maxlength="6" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->TOTAL_WAWASAN) ? $infoMKL->TOTAL_WAWASAN : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Rata Wawasan</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="rata_wawasan" name="rata_wawasan" placeholder="Rata Wawasan (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->RATA_WAWASAN) ? $infoMKL->RATA_WAWASAN : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">SISSAJI</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="sissaji" name="sissaji" placeholder="SISSAJI (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->SISSAJI) ? $infoMKL->SISSAJI : ''; ?>">
                      </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">ASMATERI</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="asmateri" name="asmateri" placeholder="ASMATERI (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->ASMATERI) ? $infoMKL->ASMATERI : ''; ?>">
                      </div>
                    </div>
                
                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">ALAT BANTU</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="alatbantu" name="alatbantu" placeholder="ALAT_BANTU (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->ALATBANTU) ? $infoMKL->ALATBANTU : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">SIKAP</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="sikap" name="sikap" placeholder="SIKAP (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->SIKAP) ? $infoMKL->SIKAP : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">BHSLISAN</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="bhslisan" name="bhslisan" placeholder="BHSLISAN (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->BHSLISAN) ? $infoMKL->BHSLISAN : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">TOTAL TEKNIK</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="total_teknik" name="total_teknik" placeholder="Total Teknik (numbers only)" maxlength="6" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->TOTAL_TEKNIK) ? $infoMKL->TOTAL_TEKNIK : ''; ?>">
                      </div>
                    </div>
                    
                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Rata Teknik</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="rata_teknik" name="rata_teknik" placeholder="Rata Teknik (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->RATA_TEKNIK) ? $infoMKL->RATA_TEKNIK : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">RELEVANS</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="relevans" name="relevans" placeholder="RELEVANS (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->RELEVANS) ? $infoMKL->RELEVANS : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">SISORGAN</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="sisorgan" name="sisorgan" placeholder="SISORGAN (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->SISORGAN) ? $infoMKL->SISORGAN : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">BAHASA</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="bahasa" name="bahasa" placeholder="BAHASA (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->BAHASA) ? $infoMKL->BAHASA : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">TOTAL TULIS</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="total_tulis" name="total_tulis" placeholder="Total Tulis (numbers only)" maxlength="6" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->TOTAL_TULIS) ? $infoMKL->TOTAL_TULIS : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">RATA TULIS</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="rata_tulis" name="rata_tulis" placeholder="Rata Tulis (numbers only)" maxlength="5" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->RATA_TULIS) ? $infoMKL->RATA_TULIS : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">TOTAL SELURUH</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="total_seluruh" name="total_seluruh" placeholder="TOTAL SELURUH (numbers only)" maxlength="7" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->TOTAL_SELURUH) ? $infoMKL->TOTAL_SELURUH : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">RATA SELURUH</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="rata_seluruh" name="rata_seluruh" placeholder="RATA_SELURUH (numbers only)" maxlength="6" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoMKL->RATA_SELURUH) ? $infoMKL->RATA_SELURUH : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker" id="data_3">
                        <label class="col-sm-4 control-label">Tgl. Makalah</label>
                        <div class="input-group col-sm-7 date">                               
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgl_makalah" name="tgl_makalah" placeholder="Tgl. Makalah" value="<?php echo isset($infoMKL->TGL_MAKALAH) ? $infoMKL->TGLMAKALAH: ""; ?>" class="form-control">
                      </div>
                    </div>
                

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">NPenilai</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="npenilai" name="npenilai" placeholder="NPenilai" maxlength="25"  class="form-control" value="<?php echo isset($infoMKL->NPENILAI) ? $infoMKL->NPENILAI : ''; ?>">
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
            
            tgl_makalah: {
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
            setupok: {
                validators: {
                   notEmpty: {
                        message: 'Setupok tidak boleh kosong'
                    } 
                }
            },
            nlayak: {
                validators: {
                   notEmpty: {
                        message: 'N Layak tidak boleh kosong'
                    } 
                }
            },
            nproblem: {
                validators: {
                   notEmpty: {
                        message: 'N Problem tidak boleh kosong'
                    } 
                }
            },
            aktualmas: {
                validators: {
                   notEmpty: {
                        message: 'Aktualmas tidak boleh kosong'
                    } 
                }
            },
            total_topik: {
                validators: {
                   notEmpty: {
                        message: 'Total Topik tidak boleh kosong'
                    } 
                }
            },
            rata_topik: {
                validators: {
                   notEmpty: {
                        message: 'Rata topik tidak boleh kosong'
                    } 
                }
            },
            npengemb: {
                validators: {
                   notEmpty: {
                        message: ' Npengemb tidak boleh kosong'
                    } 
                }
            },
            iptek: {
                validators: {
                   notEmpty: {
                        message: 'IPTEK tidak boleh kosong'
                    } 
                }
            },
            visi: {
                validators: {
                   notEmpty: {
                        message: 'Visi tidak boleh kosong'
                    } 
                }
            },
            total_wawasan: {
                validators: {
                   notEmpty: {
                        message: 'Total Wawasan tidak boleh kosong'
                    } 
                }
            },
            rata_wawasan: {
                validators: {
                   notEmpty: {
                        message: 'Rata Wawasan tidak boleh kosong'
                    } 
                }
            },
            sissaji: {
                validators: {
                   notEmpty: {
                        message: 'Sissaji tidak boleh kosong'
                    } 
                }
            },
            asmateri: {
                validators: {
                   notEmpty: {
                        message: 'Asmateri tidak boleh kosong'
                    } 
                }
            },
            alatbantu: {
                validators: {
                   notEmpty: {
                        message: 'Alat Bantu tidak boleh kosong'
                    } 
                }
            },
            sikap: {
                validators: {
                   notEmpty: {
                        message: 'Sikap tidak boleh kosong'
                    } 
                }
            },
            bhslisan: {
                validators: {
                   notEmpty: {
                        message: 'Bahasa Lisan tidak boleh kosong'
                    } 
                }
            },
            total_teknik: {
                validators: {
                   notEmpty: {
                        message: 'Total teknik tidak boleh kosong'
                    } 
                }
            },
            rata_teknik: {
                validators: {
                   notEmpty: {
                        message: 'Rata teknik tidak boleh kosong'
                    } 
                }
            },
            relevans: {
                validators: {
                   notEmpty: {
                        message: 'Relevans tidak boleh kosong'
                    } 
                }
            },
            sisorgan: {
                validators: {
                   notEmpty: {
                        message: 'Sisorgan tidak boleh kosong'
                    } 
                }
            },
            bahasa: {
                validators: {
                   notEmpty: {
                        message: ' Bahasa tidak boleh kosong'
                    } 
                }
            },
            total_tulis: {
                validators: {
                   notEmpty: {
                        message: 'Total Tulis tidak boleh kosong'
                    } 
                }
            },
            rata_tulis: {
                validators: {
                   notEmpty: {
                        message: 'Rata Tulis tidak boleh kosong'
                    } 
                }
            },
            total_seluruh: {
                validators: {
                   notEmpty: {
                        message: 'Total Seluruh tidak boleh kosong'
                    } 
                }
            },
            rata_seluruh: {
                validators: {
                   notEmpty: {
                        message: 'Rata seluruh tidak boleh kosong'
                    } 
                }
            },
            npenilai: {
                validators: {
                   notEmpty: {
                        message: 'NPenilai tidak boleh kosong'
                    } 
                }
            },
             
            //==============
        }
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
        $('#defaultForm2').bootstrapValidator('revalidateField', 'tgl_makalah');
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
        url = "<?php echo site_url('home/ajax_update_makalah')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_makalah')?>";
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