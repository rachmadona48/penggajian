
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
        <h4 class="modal-title" id="myModalLabel">Form Riwayat Keluarga</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><font color="blue">NRK</font></label>
                        <div class="input-group col-sm-4">
                            <input type="text" id="nrk" name="nrk" placeholder="NRK" class="form-control" value="<?php echo isset($nrk) ? $nrk : '' ?>" readOnly="true">
                        </div>
                    </div>
                </div> 
            </div>
        
        <div class="row">
            <!-- START SIDE 1 -->
            <div class="col-md-6">
                    <div class="form-group">
                        <label for="stawin" class="col-sm-4 control-label">Status Kawin</label>
                        <div class="input-group col-sm-7">
                            <select class="form-control chosen-stawin" name="stawin" id="stawin" style="width:99%">
                                <option></option>
                                <?php echo $listStawin; ?>
                            </select>
                        </div>
                    </div>
                </div>
            <div class="col-md-6">
                <div class="form-group pickerpicker">
                    <label class="col-sm-4 control-label">No. KK</label>
                    <div class="input-group col-sm-7">
                        <input type="text" id="nokk" name="nokk" placeholder="No Kartu Keluarga" value="<?php echo isset($NOKK) ? $NOKK : ""; ?>" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        
            <div class="hr-line-dashed"></div>
           
                <div class="col-md-6">

                    <div class="form-group pickerpicker">
                          <label class="col-sm-4 control-label"><font color="blue">Hubungan Keluarga</font></label>
                          <div class="input-group col-sm-7">                         
                            <?php if($action == 'update') { ?>      
                              <select class="chosen-hubkel" readonly="readonly" name="hubkel" id="hubkel" data-placeholder="Pilih Hubungan Keluarga...">
                                <option value=""></option>
                                <?php echo $listKdHubkel; ?>
                                <script type="text/javascript">
                                var select = $('#hubkel');

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
                              <select class="chosen-hubkel" name="hubkel" id="hubkel" data-placeholder="Pilih Hubungan Keluarga...">
                                <option value=""></option>
                                <?php echo $listKdHubkel; ?>
                              </select>  
                            <?php } ?>
                          </div>
                    </div>

                    <div class="form-group pickerpicker">
                          <label class="col-sm-4 control-label">NIK</label>
                          <div class="input-group col-sm-7">
                             <input type="text" id="nik" maxlength="16" name="nik" placeholder="NIK" class="form-control" value="<?php echo isset($infoKeluarga->NOPPEN) ? $infoKeluarga->NOPPEN : ""; ?>" data-mask="999999999999999999">
                          </div>
                    </div>

                    <div class="form-group pickerpicker">
                          <label class="col-sm-4 control-label">Nama</label>
                          <div class="input-group col-sm-7">
                             <input type="text" id="nama" name="nama" placeholder="Nama" class="form-control" value="<?php echo isset($infoKeluarga->NAMA) ? $infoKeluarga->NAMA : ""; ?>">
                          </div>
                    </div>

                    <div class="form-group pickerpicker">
                            <label class="col-sm-4 control-label">Jenis Kelamin</label>
                            <div class="input-group col-sm-7">
                                <div class="i-checks inline"><label> <input type="radio" name="jenkel" <?php echo isset($infoKeluarga->JENKEL) ? ($infoKeluarga->JENKEL == 'L' ? 'checked' : '') : ''; ?> value="L" checked="true"> <i></i> Laki-laki </label></div>&nbsp;&nbsp;&nbsp;
                                <div class="i-checks inline"><label> <input type="radio" name="jenkel" <?php echo isset($infoKeluarga->JENKEL) ? ($infoKeluarga->JENKEL == 'P' ? 'checked' : '') : ''; ?> value="P"> <i></i> Perempuan </label></div>
                            </div>
                    </div>

                    <div class="form-group">
                          <label class="col-sm-4 control-label">Status Nikah</label>
                          <div class="input-group col-sm-7">

                                <?php 
                                if($action == 'tambah'){
                                       
                                ?>
                                    <div class="i-checks inline"><label> <input type="radio" onclick="return statusNikah();" name="stnikah" id="blmnikah" value="0"  checked="true"> <i></i> Belum Menikah </label></div><br>
                                    <div class="i-checks inline"><label> <input type="radio" onclick="return statusNikah();" name="stnikah" id="sdhnikah" value="1"  > <i></i> Sudah Menikah </label></div><br>
                                    <div class="i-checks inline"><label> <input type="radio" onclick="return statusNikah();" name="stnikah" id="cerai" value="2"  > <i></i> Cerai </label></div>
                                <?php }
                                else if($action == 'update'){
                                ?>
                                        <div class="i-checks inline"><label> <input type="radio" onclick="return statusNikah();" name="stnikah" id="blmnikah" value="0" <?php if($infoKeluarga->TEMNIKAH == null && $infoKeluarga->TGNIKAH == null && $infoKeluarga->NOAKTECERAI == null && $infoKeluarga->TGAKTECERAI == null){?> checked="true"<?php } ?> > <i></i> Belum Menikah </label></div><br>
                                        <div class="i-checks inline"><label> <input type="radio" onclick="return statusNikah();" name="stnikah" id="sdhnikah" value="1" <?php if($infoKeluarga->TEMNIKAH != null || $infoKeluarga->TGNIKAH != null){?> checked="true"<?php } ?> > <i></i> Sudah Menikah </label></div><br>
                                        <div class="i-checks inline"><label> <input type="radio" onclick="return statusNikah();" name="stnikah" id="cerai" value="2" <?php if($infoKeluarga->NOAKTECERAI != null || $infoKeluarga->TGAKTECERAI != null){?> checked="true"<?php } ?> > <i></i> Cerai </label></div>
                                <?php
                                }?>
                          </div>
                    </div>

                    <div class="form-group pickerpicker" id="noAkteNikah" style="display:none">
                        <label class="col-sm-4 control-label">No. Akte Nikah</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="noaktenikah" name="noaktenikah" placeholder="No. Akte Nikah" class="form-control" value="<?php echo isset($infoKeluarga->TEMNIKAH) ? $infoKeluarga->TEMNIKAH : ""; ?>">
                        </div>
                    </div>

                    <div class="form-group pickerpicker" id="data_2" style="display:none">
                        <label class="col-sm-4 control-label">Tgl. Nikah</label>
                        <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgnikah" name="tgnikah" placeholder="Tgl. Nikah" value="<?php echo isset($infoKeluarga->TGNIKAH) ? date('d-m-Y', strtotime($infoKeluarga->TGNIKAH)) : ""; ?>" class="form-control" readonly="readonly">
                        </div>
                    </div>

                        <div class="form-group pickerpicker" id="tempatNikah" style="display:none">
                          <label class="col-sm-4 control-label">Tempat Nikah</label>
                          <div class="input-group col-sm-7">                     
                             <input type="text" id="temnikah" name="temnikah" placeholder="Tempat Nikah" class="form-control" value="<?php echo isset($infoKeluarga->TEMNIKAH) ? $infoKeluarga->TEMNIKAH : ""; ?>">
                          </div>
                        </div>

                    <div class="form-group pickerpicker" id="noAkteCerai" style="display:none">
                        <label class="col-sm-4 control-label">No. Akte Cerai</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="noaktecerai" name="noaktecerai" placeholder="No. Akte Cerai" class="form-control" value="<?php echo isset($infoKeluarga->NOAKTECERAI) ? $infoKeluarga->NOAKTECERAI : ""; ?>">
                        </div>
                    </div>

                    <div class="form-group pickerpicker" id="data_5" style="display:none">
                        <label class="col-sm-4 control-label">Tgl. Akte Cerai</label>
                        <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgaktecerai" name="tgaktecerai" placeholder="Tgl. Akte" value="<?php echo isset($infoKeluarga->TGAKTECERAI) ? date('d-m-Y', strtotime($infoKeluarga->TGAKTECERAI)) : ""; ?>" class="form-control" readonly="readonly">
                        </div>
                    </div>

                     <div class="form-group pickerpicker" id="noSuratCerai" style="display:none">
                        <label class="col-sm-4 control-label">No. SK Izin Cerai</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="nosuratcerai" name="nosuratcerai" placeholder="No. Surat Cerai" class="form-control" value="<?php echo isset($infoKeluarga->NOSURATCERAI) ? $infoKeluarga->NOSURATCERAI : ""; ?>">
                        </div>
                    </div>

                    <div class="form-group pickerpicker" id="data_7" style="display:none">
                        <label class="col-sm-4 control-label">Tgl. SK Izin Cerai</label>
                        <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgsuratcerai" name="tgsuratcerai" placeholder="Tgl. Surat" value="<?php echo isset($infoKeluarga->TGSURATCERAI) ? date('d-m-Y', strtotime($infoKeluarga->TGSURATCERAI)) : ""; ?>" class="form-control" readonly="readonly"><abbr class="search-choice-close"></abbr>
                        </div>
                    </div>


                    <div class="form-group pickerpicker">
                            <label class="col-sm-4 control-label">Pekerjaan</label>
                            <div class="input-group col-sm-7">
                                <select class="chosen-kdkerja" name="kdkerja" id="kdkerja" data-placeholder="Pilih Jenis Pekerjaan...">
                                    <option value=""></option>
                                    <?php echo $listJenisPekerjaan; ?>
                                </select>
                            </div>
                        </div>

                    <div class="form-group pickerpicker" id="div_noaktifsek" style="display:none">
                        <label class="col-sm-4 control-label">No. Ket. Aktif Sekolah</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="noaktifsek" name="noaktifsek" placeholder="Nomor Keterangan Aktif Sekolah" class="form-control" value="<?php echo isset($infoKeluarga->NOKETAKTIFSEK) ? $infoKeluarga->NOKETAKTIFSEK : ""; ?>">
                        </div>
                    </div>

                    <div class="form-group pickerpicker" id="data_6" style="display:none">
                        <label class="col-sm-4 control-label">Tgl. Ket. Aktif Sekolah</label>
                        <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgaktifsek" name="tgaktifsek" placeholder="Tgl. Akte" value="<?php echo isset($infoKeluarga->TGKETAKTIFSEK) ? date('d-m-Y', strtotime($infoKeluarga->TGKETAKTIFSEK)) : ""; ?>" class="form-control" readonly="readonly">
                        </div>
                    </div>
                     
                </div>

                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Tempat Lahir</label>
                            <div class="input-group col-sm-7">
                                <input type="text" id="temhir" name="temhir" placeholder="Tempat Lahir" class="form-control" value="<?php echo isset($infoKeluarga->TEMHIR) ? $infoKeluarga->TEMHIR : ""; ?>" >
                            </div>
                    </div>

                    <div class="form-group pickerpicker" id="data_1">
                        <label class="col-sm-4 control-label">Tgl. Lahir</label>
                        <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="talhir" name="talhir" placeholder="Tgl. Lahir" value="<?php echo isset($infoKeluarga->TALHIR) ? date('d-m-Y', strtotime($infoKeluarga->TALHIR)) : ""; ?>" class="form-control" readonly="readonly">
                        </div>
                    </div>
                    
                </div>
                    

            <div class="row">
                <div class="col-md-6">


                        <div class="form-group pickerpicker">
                          <label class="col-sm-4 control-label">Status Tunjangan</label>
                          <div class="input-group col-sm-7">                             
                              <select class="chosen-stattun" name="stattun" id="stattun" data-placeholder="Pilih Status Tunjangan...">
                                <option value=""></option>
                                <?php echo $listStatusTunjangan; ?>
                              </select>
                          </div>
                        </div>

                        <div class="form-group pickerpicker" id="data_3">
                          <label class="col-sm-4 control-label">Tgl. Meninggal</label>
                          <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="mati" name="mati" placeholder="Tgl. Meninggal" value="<?php echo isset($infoKeluarga->MATI) ? date('d-m-Y', strtotime($infoKeluarga->MATI)) : ""; ?>" class="form-control" readonly="readonly">
                          </div>
                        </div>

                        <div class="form-group pickerpicker" id="uangSantunan" style="display: none">
                          <label class="col-sm-4 control-label">Uang Duka</label>
                          <div class="input-group col-sm-7">                     
                             <!--<input type="text" id="uangduka" name="uangduka" placeholder="Uang Duka" class="form-control" value="<?php echo isset($infoKeluarga->UANGDUKA) ? date('d-m-Y', strtotime($infoKeluarga->UANGDUKA)) : ""; ?>">-->
                             <select class="chosen-uangduka" name="uangduka" id="uangduka" data-placeholder="Pilih Jenis Uang Duka...">
                                <option value=""></option>
                                <?php echo $listUangDuka; ?>
                              </select>
                          </div>
                        </div>

                        <div class="form-group pickerpicker">
                            <label class="col-sm-4 control-label">No. Surat Kematian</label>
                            <div class="input-group col-sm-7">
                                <input type="text" id="nosuratmati" name="nosuratmati" placeholder="Nomor Surat Kematian" class="form-control" value="<?php echo isset($infoKeluarga->NOSURATMATI) ? $infoKeluarga->NOSURATMATI : ""; ?>" >
                            </div>
                        </div>

                        <div class="form-group pickerpicker" id="data_4">
                            <label class="col-sm-4 control-label">Tgl. Surat Kematian</label>
                            <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgsuratmati" name="tgsuratmati" placeholder="Tgl. Lahir" value="<?php echo isset($infoKeluarga->TALSURATMATI) ? date('d-m-Y', strtotime($infoKeluarga->TALSURATMATI)) : ""; ?>" class="form-control" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group pickerpicker">
                      
                          <div class="input-group col-sm-7">                
                               <input type="hidden" id="stat_app" name="stat_app" class="form-control" value="<?php echo isset($infoKeluarga->STAT_APP) ? 2 : 2; ?>">
                          </div>
                        </div>
                    </div>               
            </div>   
                                 
                <!-- END SIDE 1 -->                                                                                             
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
    statusNikah();
    //statusHidup();

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
           nama: {
                validators: {
                    notEmpty: {
                        message: 'Nama tidak boleh kosong'
                    }
                }
            },
            nik: {
                validators: {
                    notEmpty: {
                        message: 'NIK tidak boleh kosong'
                    }
                }
            },
            temhir: {
                validators: {
                    notEmpty: {
                        message: 'Tempat Lahir tidak boleh kosong'
                    }
                }
            },
            talhir: {
                validators: {
                    notEmpty: {
                        message: 'Tgl. Lahir tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            },
            jenkel: {
                validators: {
                     notEmpty: {
                        message: 'Jenis Kelamin harus dipilih'
                    } 
                }
            },
            hubkel: {
                validators: {
                     notEmpty: {
                        message: 'Hubungan Keluarga harus dipilih'
                    } 
                }
            },
            kdkerja: {
                validators: {
                     notEmpty: {
                        message: 'Pekerjaan harus dipilih'
                    } 
                }
            },
            stattun: {
                validators: {
                     notEmpty: {
                        message: 'Status Tunjangan harus dipilih'
                    } 
                }
            },
            tgnikah: {
                validators: {
                    
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            },
            mati: {
                validators: {
                    
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
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
              $('#defaultForm2').bootstrapValidator('revalidateField', 'talhir');
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
              $('#defaultForm2').bootstrapValidator('revalidateField', 'tgnikah');
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
              // Revalidate the date field
              $('#defaultForm2').bootstrapValidator('revalidateField', 'mati');
            $('#uangSantunan').show();
        });

    $('#data_4 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy",
        endDate: new Date()
    }).on('changeDate', function(e) {
    });

    $('#data_5 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy",
        endDate: new Date()
    }).on('changeDate', function(e) {
    });

    $('#data_6 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy",
        endDate: new Date()
    }).on('changeDate', function(e) {
    });

     $('#data_7 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy",
        endDate: new Date()
    }).on('changeDate', function(e) {
    });

    /*START CHOSEN*/
    var config = {
      '.chosen-stawin'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
        '.chosen-hubkel'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
      '.chosen-kdkerja'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
      '.chosen-stattun'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
      '.chosen-uangduka'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    /*END CHOSEN*/

    $("#hubkel").on("change", function(event) {
        event.preventDefault();

        setStattun();
    });

    $("#kdkerja").on("change", function(event) {
        event.preventDefault();



        if ($("#kdkerja").val() == '5'){
            $('#div_noaktifsek').show();
            $('#data_6').show();
        } else {
            $('#div_noaktifsek').hide();
            $('#data_6').hide();
        }
    });

});



function statusNikah()
{
   
    if(document.getElementById('blmnikah').checked == true){
        document.getElementById('data_2').style.display = "none";
        document.getElementById('tempatNikah').style.display = "none";
        document.getElementById('noAkteNikah').style.display = "none";
        document.getElementById('data_5').style.display = "none";
        document.getElementById('noAkteCerai').style.display = "none";
        document.getElementById('data_7').style.display = "none";
        document.getElementById('noSuratCerai').style.display = "none";
        $('#noaktecerai').val('');
        $('#tgaktecerai').val('');
        $('#nosuratcerai').val('');
        $('#tgsuratcerai').val('');

        $('#defaultForm2').data('bootstrapValidator').destroy();
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
           nama: {
                validators: {
                    notEmpty: {
                        message: 'Nama tidak boleh kosong'
                    }
                }
            },
            
            temhir: {
                validators: {
                    notEmpty: {
                        message: 'Tempat Lahir tidak boleh kosong'
                    }
                }
            },
            talhir: {
                validators: {
                    notEmpty: {
                        message: 'Tgl. Lahir tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            },
            jenkel: {
                validators: {
                     notEmpty: {
                        message: 'Jenis Kelamin harus dipilih'
                    } 
                }
            },
            hubkel: {
                validators: {
                     notEmpty: {
                        message: 'Hubungan Keluarga harus dipilih'
                    } 
                }
            },
            kdkerja: {
                validators: {
                     notEmpty: {
                        message: 'Pekerjaan harus dipilih'
                    } 
                }
            },
            stattun: {
                validators: {
                     notEmpty: {
                        message: 'Status Tunjangan harus dipilih'
                    } 
                }
            },
            stat_app: {
                validators: {
                     notEmpty: {
                        message: 'Status Approval harus dipilih'
                    } 
                }
            }
            ,
            
            mati: {
                validators: {
                    
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            }
            
            //==============
        }
    });

    }else if(document.getElementById('cerai').checked == true){
        document.getElementById('data_5').style.display = "";
        document.getElementById('noAkteCerai').style.display = "";
        document.getElementById('data_7').style.display = "";
        document.getElementById('noSuratCerai').style.display = "";
        document.getElementById('data_2').style.display = "none";
        document.getElementById('tempatNikah').style.display = "none";
        document.getElementById('noAkteNikah').style.display = "none";

        $('#stattun').val(2);
        $(".chosen-stattun").trigger("chosen:updated");

         $('#defaultForm2').data('bootstrapValidator').destroy();
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
           nama: {
                validators: {
                    notEmpty: {
                        message: 'Nama tidak boleh kosong'
                    }
                }
            },
            
            temhir: {
                validators: {
                    notEmpty: {
                        message: 'Tempat Lahir tidak boleh kosong'
                    }
                }
            },
            talhir: {
                validators: {
                    notEmpty: {
                        message: 'Tgl. Lahir tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            },
            jenkel: {
                validators: {
                     notEmpty: {
                        message: 'Jenis Kelamin harus dipilih'
                    } 
                }
            },
            hubkel: {
                validators: {
                     notEmpty: {
                        message: 'Hubungan Keluarga harus dipilih'
                    } 
                }
            },
            kdkerja: {
                validators: {
                     notEmpty: {
                        message: 'Pekerjaan harus dipilih'
                    } 
                }
            },
            stattun: {
                validators: {
                     notEmpty: {
                        message: 'Status Tunjangan harus dipilih'
                    } 
                }
            },
            stat_app: {
                validators: {
                     notEmpty: {
                        message: 'Status Approval harus dipilih'
                    } 
                }
            }
            ,
            tgaktecerai: {
                validators: {
                    notEmpty: {
                        message: 'Tgl. Cerai tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            },

            noaktecerai: {
                validators: {
                    notEmpty: {
                        message: 'NO Akte Cerai tidak boleh kosong'
                    }
                }
            },
            tgsuratcerai: {
                validators: {
                    
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            },

            
            mati: {
                validators: {
                    
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            }
            
            //==============
        }
    });

    }else if(document.getElementById('sdhnikah').checked == true){
        document.getElementById('data_2').style.display = "";
        document.getElementById('tempatNikah').style.display = "";
        document.getElementById('noAkteNikah').style.display = "";
        document.getElementById('data_5').style.display = "none";
        document.getElementById('noAkteCerai').style.display = "none";
        document.getElementById('data_7').style.display = "none";
        document.getElementById('noSuratCerai').style.display = "none";

        $('#noaktecerai').val('');
        $('#tgaktecerai').val('');
        $('#nosuratcerai').val('');
        $('#tgsuratcerai').val('');

        //bootstrapValidator.destroy();
            $('#defaultForm2').data('bootstrapValidator').destroy();
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
           nama: {
                validators: {
                    notEmpty: {
                        message: 'Nama tidak boleh kosong'
                    }
                }
            },
            
            temhir: {
                validators: {
                    notEmpty: {
                        message: 'Tempat Lahir tidak boleh kosong'
                    }
                }
            },
            talhir: {
                validators: {
                    notEmpty: {
                        message: 'Tgl. Lahir tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            },
            jenkel: {
                validators: {
                     notEmpty: {
                        message: 'Jenis Kelamin harus dipilih'
                    } 
                }
            },
            hubkel: {
                validators: {
                     notEmpty: {
                        message: 'Hubungan Keluarga harus dipilih'
                    } 
                }
            },
            kdkerja: {
                validators: {
                     notEmpty: {
                        message: 'Pekerjaan harus dipilih'
                    } 
                }
            },
            stattun: {
                validators: {
                     notEmpty: {
                        message: 'Status Tunjangan harus dipilih'
                    } 
                }
            },
            stat_app: {
                validators: {
                     notEmpty: {
                        message: 'Status Approval harus dipilih'
                    } 
                }
            }
            ,
            tgnikah: {
                validators: {
                    notEmpty: {
                        message: 'Tgl. Nikah tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            },

            temnikah: {
                validators: {
                    notEmpty: {
                        message: 'Tempat Nikah tidak boleh kosong'
                    }
                }
            },
            mati: {
                validators: {
                    
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            }
            
            //==============
        }
    });
        
    }

    //setStattun();

   
}

function setStattun(){
    hubkel=$('#hubkel').val();
    stnikah=$("input[type='radio'][name='stnikah']:checked").val();
    sthidup=$("#mati").val();
    //alert(sthidup);
    //stattun = 1 - Mendapatkan tunjangan
    //stattun = 2 - Tidak mendapatkan tunjangan
    //stattun = 3 - Perpanjangan tunjangan anak
    if (sthidup != ''){
        $('#stattun').val(2);
    } else {
        if (stnikah == '1' || stnikah == '2'){
            $('#stattun').val(2);
        } else {
            if (hubkel=='10' || hubkel=='11' || hubkel=='12' || hubkel=='20' || hubkel=='21' || hubkel=='22' || hubkel=='30' || hubkel=='31' || hubkel=='32' || hubkel=='40' || hubkel=='41' || hubkel=='42' || hubkel=='51'){
                $('#stattun').val(1);
            } else {
                $('#stattun').val(2);
            }
        }

    }
    $('#stattun').trigger('chosen:updated');
}

function statusHidup() {
    if(document.getElementById('mshhidup').checked == true){
        document.getElementById('data_3').style.display = "none";
        document.getElementById('uangSantunan').style.display = "none";
    }else{
        document.getElementById('data_3').style.display = "";
        document.getElementById('uangSantunan').style.display = "";
    }
}

function save()
{
    var url;
    if(save_method == 'update')
    {
        url = "<?php echo site_url('home/ajax_update_keluarga')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_keluarga')?>";
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

            }
            else if(data.response == 'WARN')
            {
                $('.msg').html('');
                $('.err').html('<small>Jenis Hubkel sudah digunakan.</small>');
            }
            else{
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