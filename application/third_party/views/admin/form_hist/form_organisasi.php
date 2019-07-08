
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
        <h4 class="modal-title" id="myModalLabel">Form Riwayat Organisasi</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">NRK</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="nrk" name="nrk" placeholder="NRK" class="form-control" value="<?php echo isset($nrk) ? $nrk : '' ?>" readOnly="true">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    

                    <div class="form-group pickerpicker" id="data_1">
                        <label class="col-sm-4 control-label">Dari</label>
                        <?php if($action == 'update'){ ?>
                            <div class="input-group col-sm-7 date">
                                <span class="input-group-addon" style="display: none"><i class="fa fa-calendar"></i></span><input type="text" id="dari" name="dari" placeholder="Dari" value="<?php echo isset($infoOrganisasi->DARI) ? date('d-m-Y', strtotime($infoOrganisasi->DARI)) : '' ?>" class="form-control" readonly>
                            </div>
                        <?php } else { ?>
                            <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="dari"  name="dari" placeholder="Dari" value="<?php echo isset($infoOrganisasi->DARI) ? date('d-m-Y', strtotime($infoOrganisasi->DARI)) : '' ?>" class="form-control">
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Nama Organisasi</label>
                      <div class="input-group col-sm-7">
                         <input type="text" id="naorgani" name="naorgani" placeholder="Nama Organisasi" maxlength="30" value="<?php echo isset($infoOrganisasi->NAORGANI) ? $infoOrganisasi->NAORGANI : ""; ?>" class="form-control">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Kode Kedudukan</label>
                      <div class="input-group col-sm-7">                    
                        <select class="chosen-kdduduk" name="kdduduk" id="kdduduk" tabindex="2" data-placeholder="Pilih Kode Kedudukan...">
                            <option value=""></option>
                            <?php echo $listKdKedudukan; ?>
                          </select>
                      </div>
                    </div>  
                     
                    

                    <div class="form-group pickerpicker" id="data_2">
                      <label class="col-sm-4 control-label">Sampai</label>
                     <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="sampai" name="sampai" placeholder="Tgl. Keluar" value="<?php echo isset($infoOrganisasi->SAMPAI) ? date('d-m-Y', strtotime($infoOrganisasi->SAMPAI)) : ""; ?>" class="form-control">
                      </div>
                    </div>

                    <!--<div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Sblssd</label>
                      <div class="input-group col-sm-7">
                         <input type="text" id="sblssd" name="sblssd" placeholder="Sblssd" maxlength="1" value="<?php echo isset($infoOrganisasi->SBLSSD) ? $infoOrganisasi->SBLSSD : ""; ?>" class="form-control">
                      </div>
                    </div>-->

                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">SBLSSD</label>
                            <div class="input-group col-sm-7">
                                <div class="i-checks inline"><label> <input type="radio" name="sblssd" <?php echo isset($infoOrganisasi->SBLSSD) ? ($infoOrganisasi->SBLSSD == '1' ? 'checked' : '') : ''; ?> value="1" checked="true"> <i></i> SBL - 1 </label></div>&nbsp;&nbsp;&nbsp;
                                <div class="i-checks inline"><label> <input type="radio" name="sblssd" <?php echo isset($infoOrganisasi->SBLSSD) ? ($infoOrganisasi->SBLSSD == '2' ? 'checked' : '') : ''; ?> value="2"> <i></i> SSD - 2 </label></div>
                            </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Kota</label>
                      <div class="input-group col-sm-7">
                         <input type="text" id="kota" name="kota" placeholder="Kota" maxlength="20" value="<?php echo isset($infoOrganisasi->KOTA) ? $infoOrganisasi->KOTA : ""; ?>" class="form-control">
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
            
            dari: {
                validators: {
                    notEmpty: {
                        message: 'Dari tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            },
            sampai: {
                validators: {
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            },
            kdduduk: {
                validators: {
                    notEmpty: {
                        message: 'Kedudukan harus dipilih'
                    }
                }
            },
            sblssd: {
                validators: {
                    notEmpty: {
                        message: 'SBLSSD harus dipilih'
                    }
                }
            },

            naorgani: {
                validators: {
                    notEmpty: {
                        message: 'Nama Organisasi tidak boleh kosong'
                    }
                }
            },

            kota: {
                validators: {
                    notEmpty: {
                        message: 'Kota tidak boleh kosong'
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
        $('#defaultForm2').bootstrapValidator('revalidateField', 'dari');
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
        $('#defaultForm2').bootstrapValidator('revalidateField', 'sampai');
        });

    /*START CHOSEN*/
    var config = {
      '.chosen-kdduduk'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"}
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
        url = "<?php echo site_url('home/ajax_update_organisasi')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_organisasi')?>";
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