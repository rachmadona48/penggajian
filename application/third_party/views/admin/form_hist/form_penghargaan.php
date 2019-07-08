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
        <h4 class="modal-title" id="myModalLabel">Form Riwayat Penghargaan</h4>
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
                    <div class="form-group" style="display: none">
                        <label class="col-sm-4 control-label">TMT CPNS</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="muang" name="muang" placeholder="Terhitung Mulai Tanggal CPNS" class="form-control" value="<?php echo isset($muang) ? $muang : '' ?>" readOnly="true">
                        </div>
                    </div>
                    <div class="form-group" style="display: none">
                        <label class="col-sm-4 control-label">TMT Mutasi</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="tmtpindah" name="tmtpindah" placeholder="Terhitung Mulai Tanggal Mutasi" class="form-control" value="<?php echo isset($tmtpindah) ? $tmtpindah : '' ?>" readOnly="true">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                     
                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Penghargaan</label>
                      <div class="input-group col-sm-7">              
                      <?php if($action == 'update'){ ?>                        
                          <select class="chosen-kdharga" readonly="readonly" name="kdharga" id="kdharga" tabindex="2" data-placeholder="Pilih Jenis Penghargaan...">
                            <option value=""></option>
                            <?php echo $listJenisPenghargaan; ?>
                            <script type="text/javascript">
                                var select = $('#kdharga');

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
                            <select class="chosen-kdharga" name="kdharga" id="kdharga" tabindex="2" data-placeholder="Pilih Jenis Penghargaan...">
                            <option value=""></option>
                            <?php echo $listJenisPenghargaan; ?>
                            </select>
                     <?php } ?>
                      </div>
                    </div>

                    

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">No. SK</label>
                      <div class="input-group col-sm-7">
                         <input type="text" id="nosk" name="nosk" placeholder="No. SK" maxlength="20" value="<?php echo isset($infoPenghargaan->NOSK) ? $infoPenghargaan->NOSK : ""; ?>" class="form-control">
                      </div>
                    </div>

                    <div class="form-group pickerpicker" id="data_1">
                      <label class="col-sm-4 control-label">Tgl. SK</label>
                        <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgsk" name="tgsk" placeholder="Tgl. SK" value="<?php echo isset($infoPenghargaan->TGSK) ? date('d-m-Y', strtotime($infoPenghargaan->TGSK)) : ""; ?>" class="form-control">
                       </div>
                    </div>                

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Asal Penghargaan</label>
                      <div class="input-group col-sm-7">
                         <input type="text" id="asal_hrg" name="asal_hrg" placeholder="Asal Penghargaan" maxlength="20" value="<?php echo isset($infoPenghargaan->ASAL_HRG) ? $infoPenghargaan->ASAL_HRG : ""; ?>" class="form-control">
                      </div>
                    </div>

                     <div class="form-group pickerpicker" style="display:none ">
                      <label class="col-sm-4 control-label">Jenis</label>
                      <div class="input-group col-sm-7">
                         <input type="text" id="jnasal" name="jnasal" maxlength="1" onkeypress="return numbersonly1(this, event)" placeholder="Jenis" value="<?php echo isset($infoPenghargaan->JNASAL) ? $infoPenghargaan->JNASAL : ""; ?>" class="form-control">
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

<!-- Sweet alert -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>
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
            // jensk: {
            //     validators: {
            //         notEmpty: {
            //             message: 'Jenis SK tidak boleh kosong'
            //         }
            //     }
            // },
            nosk: {
                validators: {
                    notEmpty: {
                        message: 'No. SK tidak boleh kosong'
                    }
                }
            },
            asal_hrg: {
                validators: {
                    notEmpty: {
                        message: 'Asal Penghargaan tidak boleh kosong'
                    }
                }
            },
            kdharga: {
                validators: {
                    notEmpty: {
                        message: 'Penghargaan harus dipilih'
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
        $('#defaultForm2').bootstrapValidator('revalidateField', 'tgsk');
        });

    /*START CHOSEN*/
    var config = {
      '.chosen-kdharga'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    /*END CHOSEN*/

    $("#kdharga").on("change", function(event) {
        event.preventDefault();

        validasi(this.value);
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

function validasi(jns){
    var myVar = $('#muang').val();
    var user_date = Date.parse(myVar);

    var tmtpindah_f = $('#tmtpindah').val();
    var tmtpindah = Date.parse(tmtpindah_f);

    var today_date = new Date();

    if (isNaN(tmtpindah)){
        var diff_date =  today_date - user_date;
    } else {
        var diff_date =  today_date - tmtpindah;
    }


    var num_years = parseInt(diff_date/31536000000);
    //alert('12'+num_years);

    //var num_months = (diff_date % 31536000000)/2628000000;
    //var num_days = ((diff_date % 31536000000) % 2628000000)/86400000;


    if (jns == '01'){ //PENGHARGAAN MASA KERJA 15 THN.
        if (15 > num_years){
            swal({
                title: "Perhatian",
                text: "Maaf.. Masa kerja pegawai ini "+num_years+" tahun."
            });
            //alert("Maaf.. Masa kerja pegawai ini "+num_years);
            $('#myModal').modal('hide');
        }
    } else if(jns == '02'){ //PENGHARGAAN MASA KERJA 20 THN.
        if (20 > num_years){
            swal({
                title: "Perhatian",
                text: "Maaf.. Masa kerja pegawai ini "+num_years+" tahun."
            });
            //alert("Maaf.. Masa kerja pegawai ini "+num_years);
            $('#myModal').modal('hide');
        }
    } else if(jns == '03'){ //PENGHARGAAN MASA KERJA 30 THN.
        if (30 > num_years){
            swal({
                title: "Perhatian",
                text: "Maaf.. Masa kerja pegawai ini "+num_years+" tahun."
            });
            //alert("Maaf.. Masa kerja pegawai ini "+num_years);
            $('#myModal').modal('hide');
        }
    }



}

function save()
{
    var url;
    if(save_method == 'update')
    {
        url = "<?php echo site_url('home/ajax_update_penghargaan')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_penghargaan')?>";
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
                swal({type:"warning",title:"DATA GAGAL DISIMPAN", text:"JENIS PENGHARGAAN SUDAH DIGUNAKAN, MOHON PERIKSA KEMBALI DATA YANG DIINPUT"});
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