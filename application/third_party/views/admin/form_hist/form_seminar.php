
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
        <h4 class="modal-title" id="myModalLabel">Form Riwayat Seminar</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">NRK</label>
                        <div class="col-sm-7">
                            <input type="text" id="nrk" name="nrk" placeholder="NRK" class="form-control" value="<?php echo isset($nrk) ? $nrk : '' ?>" readOnly="true">
                        </div>
                    </div>
                    
                    <div class="hr-line-dashed"></div>

                    <div class="form-group pickerpicker" id="data_1">
                        <label class="col-sm-4 control-label">Tgl. Mulai</label>
                        <?php if($action == 'update'){ ?>
                            <div class="col-sm-7 date">
                                <span class="input-group-addon" style="display: none"><i class="fa fa-calendar"></i></span><input type="text" id="tgmulai" name="tgmulai" placeholder="Tgl .Mulai" value="<?php echo isset($infoSeminar->TGMULAI) ? date('d-m-Y', strtotime($infoSeminar->TGMULAI)) : '' ?>" class="form-control" readonly>
                            </div>
                        <?php } else { ?>
                            <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgmulai"  name="tgmulai" placeholder="Tgl. Mulai" value="<?php echo isset($infoSeminar->TGMULAI) ? date('d-m-Y', strtotime($infoSeminar->TGMULAI)) : '' ?>" class="form-control">
                            </div>
                        <?php } ?>
                    </div>
                    
                       
                    
                      <div class="form-group pickerpicker" id="data_1">
                          <label class="col-sm-4 control-label">Tgl. Selesai</label>
                          <div class="input-group col-sm-7 date">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgselesai" name="tgselesai" placeholder="Tgl. Selesai" value="<?php echo isset($infoSeminar->TGSELESAI) ? date('d-m-Y', strtotime($infoSeminar->TGSELESAI)) : ""; ?>" class="form-control">
                          </div>
                      </div>
                      
                       
                    
                      <div class="form-group pickerpicker">
                          <label class="col-sm-4 control-label">Nama Seminar</label>
                          <div class="col-sm-7">
                              <input type="text" id="nasemi" name="nasemi" maxlength="30" placeholder="Nama Seminar" value="<?php echo isset($infoSeminar->NASEMI) ? $infoSeminar->NASEMI : ""; ?>" class="form-control">
                          </div>
                      </div>
                      
                       
                    
                      <div class="form-group pickerpicker">
                          <label class="col-sm-4 control-label">Kode Seminar</label>
                          <div class="input-group col-sm-7">                                
                                <select class="form-control chosen-kdsemi" name="kdsemi" id="kdsemi" tabindex="2" data-placeholder="Pilih Kode Seminar...">
                                    <option value=""></option>
                                    <?php echo $listKdSemi; ?> 
                                </select>
                          </div>
                      </div>
                      
                       
                    
                      <div class="form-group pickerpicker">
                          <label class="col-sm-4 control-label">Kode Tema</label>
                          <div class="input-group col-sm-7">                                
                                 <select class="form-control chosen-kdtema" name="kdtema" id="kdtema" tabindex="2" data-placeholder="Pilih Kode Tema...">
                                    <option value=""></option>
                                    <?php echo $listKdTema; ?> 
                                </select>
                            </div>
                      </div>
                      
               
                       
                    
                      <div class="form-group pickerpicker">
                          <label class="col-sm-4 control-label">Badan Pelaksana</label>
                          <div class="col-sm-7">
                            <input type="text" id="badan" name="badan" placeholder="Badan Pelaksana" maxlength="30" value="<?php echo isset($infoSeminar->BADAN) ? $infoSeminar->BADAN : ""; ?>" class="form-control">
                          </div>
                      </div>
                      
                
                    
                      <div class="form-group pickerpicker">
                          <label class="col-sm-4 control-label">Tempat</label>
                          <div class=" col-sm-7">
                            <input type="text" id="tempat" name="tempat" maxlength="20" placeholder="Tempat" value="<?php echo isset($infoSeminar->TEMPAT) ? $infoSeminar->TEMPAT : ""; ?>" class="form-control">
                          </div>
                      </div>
                      
                       
                    
                      <div class="form-group pickerpicker">
                          <label class="col-sm-4 control-label">Kode Peranan</label>
                          <div class="input-group col-sm-7">
                                <select class="form-control chosen-kdperan" name="kdperan" id="kdperan" tabindex="2" data-placeholder="Pilih Kode Peranan">
                                    <option></option>
                                    <?php echo $listKdPeran; ?> 
                                </select>
                          </div>
                      </div>
                      <div class="hr-line-dashed"></div>
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
            tgmulai: {
                validators: {
                    notEmpty: {
                        message: 'Tgl. Mulai tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'The date is not a valid'
                    }
                }
            },
            tgselesai: {
                validators: {
                    notEmpty: {
                        message: 'Tgl. Selesai tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'The date is not a valid'
                    }
                }
            },
            nasemi: {
                validators: {
                    notEmpty: {
                        message: 'Nama Seminar tidak boleh kosong'
                    }
                }
            },
            badan: {
                validators: {
                    notEmpty: {
                        message: 'Badan Pelaksana tidak boleh kosong'
                    }
                }
            },
            tempat: {
                validators: {
                    notEmpty: {
                        message: 'Tempat tidak boleh kosong'
                    }
                }
            },
            kdsemi: {
                validators: {
                    notEmpty: {
                        message: 'Kode Seminar harus dipilih'
                    }
                }
            },
            kdtema: {
                validators: {
                    notEmpty: {
                        message: 'Kode Tema harus dipilih'
                    }
                }
            },
            kdperan: {
                validators: {
                    notEmpty: {
                        message: 'Kode Peran harus dipilih'
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
         $('#defaultForm2').bootstrapValidator('revalidateField', 'tgselesai');
        });

    $('#data_0 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy",
        endDate: new Date()
    }).on('changeDate', function(e) {
        $('#defaultForm2').bootstrapValidator('revalidateField', 'tgmulai');
         });

    /*START CHOSEN*/
    var config = {
      '.chosen-kdsemi'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-kdtema'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-kdperan'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    /*END CHOSEN*/

});

function save()
{
    var url;
    if(save_method == 'update')
    {
        url = "<?php echo site_url('home/ajax_update_seminar')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_seminar')?>";
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