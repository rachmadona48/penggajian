
<style type="text/css">
    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
    .pickerpicker .form-control-feedback {
        right: 80px !important;      
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
        <h4 class="modal-title" id="myModalLabel">Form Riwayat Pembatasan</h4>
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
                        <label class="col-sm-4 control-label">TMT</label>
                        <?php if($action == 'update'){ ?>
                            <div class="col-sm-7 date">
                                <span class="input-group-addon" style="display: none"><i class="fa fa-calendar"></i></span><input type="text" id="tmt" name="tmt" placeholder="TMT" value="<?php echo isset($infoPembatasan->TMT) ? date('d-m-Y', strtotime($infoPembatasan->TMT)) : '' ?>" class="form-control" readonly>
                            </div>
                        <?php } else { ?>
                            <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmt"  name="tmt" placeholder="TMT" value="<?php echo isset($infoPembatasan->TMT) ? date('d-m-Y', strtotime($infoPembatasan->TMT)) : '' ?>" class="form-control">
                            </div>
                        <?php } ?>
                    </div>


                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Jenis Usaha</label>
                      <div class="input-group col-sm-8">                                      
                          <select class="chosen-jencuti" name="jenusaha" id="jenusaha" tabindex="2" data-placeholder="Pilih Jenis Usaha...">
                            <option value=""></option>
                            <?php echo $listJenisUsaha ?>
                          </select>
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">No. Izin</label>
                      <div class="col-sm-7">
                         <input type="text" id="nosizin" name="nosizin" placeholder="Nomor Izin" maxlength="20" value="<?php echo isset($infoPembatasan->NOSIZIN) ? $infoPembatasan->NOSIZIN : ""; ?>" class="form-control">
                      </div>
                    </div>
                    <div class="form-group pickerpicker"  id="data_3">
                      <label class="col-sm-4 control-label">Tgl. Izin</label>
                      <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgsizin" name="tgsizin" placeholder="Tgl. Izin" value="<?php echo isset($infoPembatasan->TGSIZIN) ? date('d-m-Y', strtotime($infoPembatasan->TGSIZIN)) : ""; ?>" class="form-control">
                      </div>
                    </div>
                    
                    <div class="form-group pickerpicker"  id="data_2">
                      <label class="col-sm-4 control-label">Tgl. Berakhir</label>
                      <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgakhir" name="tgakhir" placeholder="Tgl. Berakhir" value="<?php echo isset($infoPembatasan->TGAKHIR) ? date('d-m-Y', strtotime($infoPembatasan->TGAKHIR)) : ""; ?>" class="form-control">
                      </div>
                    </div>
                    
                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Pejabat Tertinggi</label>
                      <div class="col-sm-8">
                         <select class="chosen-pejtt" name="pejtt" id="pejtt" tabindex="2" data-placeholder="Pilih Pejabat Tertinggi...">
                            <option value=""></option>
                            <?php echo $listPejtt ?>
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
            tgsizin: {
                validators: {
                    notEmpty: {
                        message: 'Tgl. Izin tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'The date is not a valid'
                    }
                }
            },
            nosizin: {
                validators: {
                    notEmpty: {
                        message: 'No. Izin tidak boleh kosong'
                    }
                }
            },
            tgakhir: {
                validators: {
                    notEmpty: {
                        message: 'Tgl. Berakhir tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'The date is not a valid'
                    }
                }
            },
            pejtt: {
                validators: {
                    notEmpty: {
                        message: 'Pejabat Tertinggi harus dipilih'
                    }
                }
            },
            jenusaha: {
                validators: {
                    notEmpty: {
                        message: 'Jenis Usaha harus dipilih'
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
        $('#defaultForm2').bootstrapValidator('revalidateField', 'tgsizin');
          });

    /*START CHOSEN*/
    var config = {
      '.chosen-jencuti'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-pejtt'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"}
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
        url = "<?php echo site_url('home/ajax_update_pembatasan')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_pembatasan')?>";
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