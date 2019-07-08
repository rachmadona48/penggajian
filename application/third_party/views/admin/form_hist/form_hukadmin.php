
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
        <h4 class="modal-title" id="myModalLabel">Form Riwayat Hukuman Administrasi</h4>
    </div>
    <div class="modal-body">

        <div class="row">
            <!-- START SIDE 1 -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label">NRK</label>
                    <div class="col-sm-7">
                        <input type="text" id="nrk" name="nrk" placeholder="NRK" maxlength="6" value="<?php echo isset($nrk) ? $nrk : ""; ?>" class="form-control" readOnly="true">
                    </div>
                </div>


                <div class="form-group pickerpicker" id="data_1">
                    <label class="col-sm-4 control-label">Tgl. SK</label>
                    <?php if($action == 'update'){ ?>
                        <div class="col-sm-8 date">
                            <span class="input-group-addon" style="display: none"><i class="fa fa-calendar"></i></span><input type="text" id="tgsk" name="tgsk" placeholder="TGSK" value="<?php echo isset($infoHukadm->TGSK) ? date('d-m-Y', strtotime($infoHukadm->TGSK)) : '' ?>" class="form-control" readonly>
                        </div>
                    <?php } else { ?>
                        <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgsk"  name="tgsk" placeholder="TGSK" value="<?php echo isset($infoHukadm->TGSK) ? date('d-m-Y', strtotime($infoHukadm->TGSK)) : '' ?>" class="form-control" readonly="readonly">
                        </div>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">No. SK</label>
                    <div class="col-sm-7">
                        <input type="text" id="nosk" name="nosk" placeholder="Nomor SK" maxlength="50" value="<?php echo isset($infoHukadm->NOSK) ? $infoHukadm->NOSK : ""; ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Jenis Hukuman</label>
                    <div class="col-sm-7">
                        <select class="chosen-jenhukadm" name="jenhukadm" id="jenhukadm" tabindex="2" data-placeholder="Pilih Jenis Hukuman Administrasi...">
                            <option value=""></option>
                            <?php echo $listjenishukadm; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group pickerpicker" id="data_2">
                    <label class="col-sm-4 control-label">Tgl. Mulai</label>
                    <div class="input-group col-sm-7 date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgmulai" name="tgmulai" placeholder="Tgl. Mulai" value="<?php echo isset($infoHukadm->TGMULAI) ? date('d-m-Y', strtotime($infoHukadm->TGMULAI)) : ""; ?>" class="form-control" readonly="readonly">
                    </div>
                </div>
                <div class="form-group pickerpicker" id="data_3">
                    <label class="col-sm-4 control-label">Tgl. Berakhir</label>
                    <div class="input-group col-sm-7 date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgakhir" name="tgakhir" placeholder="Tgl. Selesai" value="<?php echo isset($infoHukadm->TGAKHIR) ? date('d-m-Y', strtotime($infoHukadm->TGAKHIR)) : ""; ?>" class="form-control" readonly="readonly">
                    </div>
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

                 <div class="form-group pickerpicker" id="data_6">
                    <label class="col-sm-4 control-label">TMT Mulai StopTKD</label>
                    <div class="input-group col-sm-7 date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="mulaistoptkd" name="mulaistoptkd" placeholder="Tgl. Mulai" value="<?php echo isset($infoHukadm->TMTMULAI_STOPTKD) ? date('d-m-Y', strtotime($infoHukadm->TMTMULAI_STOPTKD)) : ""; ?>" class="form-control" readonly="readonly" data-date-format="dd-mm-yyyy">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Jumlah StopTKD</label>
                    <div class="col-sm-7">
                        <input type="text" id="blnstoptkd" name="blnstoptkd" placeholder="jumlah Bulan" maxlength="2" value="<?php echo isset($infoHukadm->JMLBLN_STOPTKD) ? $infoHukadm->JMLBLN_STOPTKD : ""; ?>" class="form-control" onkeypress="return numbersonly1(this, event)">
                    </div>
                </div>

                <div class="form-group" style="display:none">
                    <label class="col-sm-4 control-label">TMT Akhir StopTKD</label>
                    <!-- <div class="input-group col-sm-7 date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="akhirstoptkd" name="akhirstoptkd" placeholder="Tgl. Akhir" value="<?php  //echo isset($infoHukadm->TMTAKHIR_STOPTKD) ? date('d-m-Y', strtotime($infoHukadm->TMTAKHIR_STOPTKD)) : ""; ?>" class="form-control" readonly="readonly" data-date-format="dd-mm-yyyy">
                    </div> -->
                    <div class="input-group col-sm-7">
                            <input type="text" id="akhirstoptkd" name="akhirstoptkd" placeholder="Tgl. Akhir" value="<?php echo isset($infoHukadm->TMTAKHIR_STOPTKD) ? date('d-m-Y', strtotime($infoHukadm->TMTAKHIR_STOPTKD)) : ""; ?>" class="form-control" readonly="readonly" data-date-format="dd-mm-yyyy">
                      </div>
                </div>

                <div class="form-group">
                      <label class="col-sm-4 control-label">TMT Akhir StopTKD</label>
                      <div class="col-sm-7">
                         <input type="text" id="takhir" name="takhir" placeholder="TMT akhir stop tkd" maxlength="100" value="<?php echo isset($infoHukadm->TMTAKHIR_STOPTKD) ? date('d-m-Y', strtotime($infoHukadm->TMTAKHIR_STOPTKD)) : ""; ?>" class="form-control" readonly>
                      </div>
                </div> 


                <div class="form-group">
                    <label class="col-sm-4 control-label">Keterangan</label>
                    <div class="col-sm-7">
                        <input type="text" id="ket" name="ket" placeholder="Keterangan" maxlength="100" value="<?php echo isset($infoHukadm->KET) ? $infoHukadm->KET : ""; ?>" class="form-control">
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
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script type="text/javascript">

    $(document).ready(function(){

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

            var x = $('#akhirstoptkd').datepicker({dateFormat:'dd-mm-yyyy'}).val();            
            $('#takhir').val(x);
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

            var x = $('#akhirstoptkd').datepicker({dateFormat:'dd-mm-yyyy'}).val();            
            $('#takhir').val(x);
           
        }
    })

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
                jenhukadm: {
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
                    /*validators: {
                        /*
                        notEmpty: {
                            message: 'Tgl. Akhir tidak boleh kosong'
                        },*/
                        date: {
                            format: 'DD-MM-YYYY',
                            message: 'The date is not a valid'
                        }
                    //}
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
                            message: 'Pejabat Penanda Tangan harus dipilih'
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
            //endDate: new Date()
        }).on('changeDate', function(e) {
            // Revalidate the date field
            $('#defaultForm2').bootstrapValidator('revalidateField', 'tgakhir');
        });

        $('#data_6 .input-group.date').datepicker({
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
        });

        /*START CHOSEN*/
        var config = {
            '.chosen-jenhukadm'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
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
            url = "<?php echo site_url('home/ajax_update_hukadm')?>";
        }
        else
        {
            url = "<?php echo site_url('home/ajax_add_hukadm')?>";
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
                else if(data.response == 'GAGAL'){
                    $('.msg').html('');
                    $('.err').html('');
                    swal({type:"warning",title:"DATA GAGAL DISIMPAN", text:"TANGGAL SK SUDAH DIGUNAKAN, MOHON PERIKSA KEMBALI DATA YANG DIINPUT"});
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