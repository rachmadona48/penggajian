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
    	<h4 class="modal-title" id="myModalLabel">Form Riwayat Pendidikan Non Formal</h4>
    </div>
    <div class="modal-body">
    	
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">NRK</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="nrk" name="nrk" placeholder="NRK" class="form-control" value="<?php echo isset($nrk) ? $nrk : $infoUPNForm; ?>" readOnly="true">
                        </div>
                    </div>
          
                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Status</label>
                      <div class="input-group col-sm-7">                
                          <select class="form-control chosen-status" name="stat_app" id="stat_app"  data-placeholder="Pilih Status Approval...">
                            <option value=""></option>
                            <?php echo $listStatus; ?>   
                          </select>
                      </div>
                    </div>           
                
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Jenis Pendidikan</label>
                        <div class="input-group col-sm-7">
                        <?php if($action == 'update'){ ?>
                            <select class="form-control chosen-jendik" readonly="readonly" name="jendik" id="jendik" data-placeholder="Pilih Jenis Pendidikan">
                                <option value=""></option>
                                <?php echo $listJendik; ?> 
                                <script type="text/javascript">
                                var select = $('#jendik');

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
                             <select class="form-control chosen-jendik" name="jendik" id="jendik" data-placeholder="Pilih Jenis Pendidikan">
                                <option value=""></option>
                                <?php echo $listJendik; ?> 
                            </select>
                         <?php } ?>   
                        </div>
                    </div>
               
                     
                
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Kode Pendidikan</label>
                        <div class="input-group col-sm-7">
                            <?php if($action == 'update') { ?>
                            <select class="form-control chosen-kodik" name="kodik" id="kodik" readonly="readonly" data-placeholder="Pilih Kode Pendidikan">
                                <option value=""></option>
                                <?php echo isset($listKodik) ? $listKodik : ""; ?> 
                                 <script type="text/javascript">
                                var select = $('#kodik');

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
                            <?php }else{ ?>
                            <select class="form-control chosen-kodik" name="kodik" id="kodik" data-placeholder="Pilih Kode Pendidikan">
                                <option value=""></option>
                                <?php echo isset($listKodik) ? $listKodik : ""; ?> 
                            </select>
                            <?php } ?>
                        </div>
                    </div>
             
                     
                
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Nama Lembaga</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="nasek" name="nasek" maxlength="50" placeholder="Nama Lembaga" value="<?php echo isset($infoPendidikan->NASEK) ? $infoPendidikan->NASEK : ""; ?>" class="form-control">
                        </div>
                    </div>
         
                     
                
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Lokasi Diklat</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="kotsek" name="kotsek" maxlength="20" placeholder="Lokasi Diklat" value="<?php echo isset($infoPendidikan->KOTSEK) ? $infoPendidikan->KOTSEK : ""; ?>" class="form-control">
                        </div>
                    </div>
               
       
                     
                
                    <div class="form-group pickerpicker" id="data_1">
                        <label class="col-sm-4 control-label">Tgl. Ijazah</label>
                         <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgijazah" name="tgijazah" placeholder="Tgl. Ijazah" value="<?php echo isset($infoPendidikan->TGIJAZAH) ? date('d-m-Y', strtotime($infoPendidikan->TGIJAZAH)) : ""; ?>" class="form-control" readonly="readonly">
                          </div>
                    </div>
                 
        
                
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">No. Ijazah</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="noijazah" name="noijazah" maxlength="50" placeholder="No. Ijazah" value="<?php echo isset($infoPendidikan->NOIJAZAH) ? $infoPendidikan->NOIJAZAH : ""; ?>" class="form-control">
                        </div>
                    </div>

                    <!-- <div class="form-group pickerpicker" id="data_2">
                      <label class="col-sm-4 control-label">Tgl. Mulai</label>
                       <?php //if($action == 'update'){ ?>

                        <!-- <div class="col-sm-8 date">
                                <span class="input-group-addon" style="display: none"><i class="fa fa-calendar"></i></span><input type="text" id="tgmulai" name="tgmulai" placeholder="Tgl. Mulai" value="<?php //echo isset($infoHukdis->TGMULAI) ? date('d-m-Y', strtotime($infoHukdis->TGMULAI)) : '' ?>" class="form-control" readonly>
                        </div>   -->

                        <?php// } else { ?>
                    
                </div>
                <!-- END SIDE 1 -->
                <!-- START SIDE 2 -->
                <div class="col-md-6">
                    <!--<div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">No. Acckop</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="noacckop" name="noacckop" maxlength="20" placeholder="No. Acckop" value="<?php echo isset($infoPendidikan->NOACCKOP) ? $infoPendidikan->NOACCKOP : ""; ?>" class="form-control">
                        </div>
                    </div>
                   
                

                    <div class="form-group pickerpicker" id="data_2">
                        <label class="col-sm-4 control-label">Tgl. Acckop</label>
                         <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgacckop" name="tgacckop" placeholder="Tgl. Acckop" value="<?php echo isset($infoPendidikan->TGACCKOP) ? date('d-m-Y', strtotime($infoPendidikan->TGACCKOP)) : ""; ?>" class="form-control">
                          </div>
                    </div>-->
                    
                                            

                    <!-- <div class="form-group pickerpicker" id="data_6"> -->
                    <div class="form-group pickerpicker">    
                        <label class="col-sm-4 control-label">Angkatan</label>
                             <div class="input-group col-sm-7">
                                    <!-- <input type="text" id="ang1" name="ang1" maxlength="3" placeholder="Ang. ke" value="<?php //echo isset($infoPendidikan->ANGKATAN) ? substr($infoPendidikan->ANGKATAN,0,3) : ""; ?>" class="form-control" style="width:120px; float:left;" data-mask="999">
                                
                                <div class="input-group col-sm-4 date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="ang2" name="ang2" placeholder="Th Agktn" value="<?php //echo isset($infoPendidikan->ANGKATAN) ? substr($infoPendidikan->ANGKATAN,-4) : ""; ?>" class="form-control" readonly="readonly">
                                </div>
                             
                                 <small> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <font color="red">*penulisan angkatan harus 3 digit. contoh: angkatan ke 27 ditulis 027</font></small> -->

                                 <input type="text" id="angkatan" name="angkatan" maxlength="7" placeholder="Ang. ke" value="<?php echo isset($infoPendidikan->ANGKATAN) ? $infoPendidikan->ANGKATAN : ""; ?>" class="form-control">
                            </div>
                    </div>
                    
                     
                
                    <div class="form-group pickerpicker" id="data_3">
                        <label class="col-sm-4 control-label">Tgl. Mulai Diklat</label>
                         <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgmulai" name="tgmulai" placeholder="Tgl. Masuk" value="<?php echo isset($infoPendidikan->TGMULAI) ? date('d-m-Y', strtotime($infoPendidikan->TGMULAI)) : ""; ?>" class="form-control" readonly="readonly">
                          </div>
                    </div>
                                  
                     
                
                    <div class="form-group pickerpicker" id="data_5">
                        <label class="col-sm-4 control-label">Tgl. Akhir Diklat</label>
                         <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgakhir" name="tgakhir" placeholder="Tgl. Selesai" value="<?php echo isset($infoPendidikan->TGAKHIR) ? date('d-m-Y', strtotime($infoPendidikan->TGAKHIR)) : ""; ?>" class="form-control" readonly="readonly">
                          </div>
                    </div>
                   

                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Jumlah Jam</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="jumjam" name="jumjam" maxlength="4" onkeypress="return numbersonly1(this, event)" placeholder="Jumlah Jam" value="<?php echo isset($infoPendidikan->JUMJAM) ? $infoPendidikan->JUMJAM : 0; ?>" class="form-control">
                        </div>
                    </div>
                 

                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Penyelenggara</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="selenggara" name="selenggara" maxlength="50" placeholder="Penyelenggara" value="<?php echo isset($infoPendidikan->SELENGGARA) ? $infoPendidikan->SELENGGARA : ""; ?>" class="form-control">
                        </div>
                    </div>

                    <!-- <div class="form-group pickerpicker" id="data_65">
                      <label class="col-sm-4 control-label">TMT Mulai StopTKD</label>
                      
                      <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" id="mulaistoptkd" name="mulaistoptkd" placeholder="Tgl. Mulai" value="<?php //echo isset($infoHukdis->TMTMULAI_STOPTKD) ? date('d-m-Y', strtotime($infoHukdis->TMTMULAI_STOPTKD)) : ''; ?>" class="form-control" readonly="readonly" data-date-format="dd-mm-yyyy">
                      </div>
                      
                    </div>

                    <div class="form-group">
                      <label class="col-sm-4 control-label">Jumlah StopTKD</label>
                      <div class="col-sm-7">
                         <input type="text" id="blnstoptkd" name="blnstoptkd" placeholder="Jumlah Stop TKD (BULAN)" maxlength="2" value="<?php //echo isset($infoHukdis->JMLBLN_STOPTKD) ? $infoHukdis->JMLBLN_STOPTKD : ""; ?>" class="form-control" onkeypress="return numbersonly1(this, event)">
                      </div>
                    </div>

                    <div class="form-group pickerpicker" id="data_7">
                      <label class="col-sm-4 control-label">TMT Akhir StopTKD</label>
                       <div class="input-group col-sm-7">
                            <input type="text" id="akhirstoptkd" name="akhirstoptkd" placeholder="Tgl. Akhir" value="<?php //echo isset($infoHukdis->TMTAKHIR_STOPTKD) ? date('d-m-Y', strtotime($infoHukdis->TMTAKHIR_STOPTKD)) : ""; ?>" class="form-control" readonly="readonly" data-date-format="dd-mm-yyyy">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-4 control-label">Keterangan</label>
                      <div class="col-sm-7">
                         <input type="text" id="ket" name="ket" placeholder="Keterangan" maxlength="100" value="<?php //echo isset($infoHukdis->KET) ? $infoHukdis->KET : ""; ?>" class="form-control">
                      </div>
                    </div> -->
                   

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
            jendik: {
                validators: {
                    notEmpty: {
                        message: 'Jenis Pendidikan tidak boleh kosong'
                    }
                }
            },kodik: {
                validators: {
                    notEmpty: {
                        message: 'Kode Pendidikan tidak boleh kosong'
                    }
                }
            },nasek: {
                validators: {
                    notEmpty: {
                        message: 'Nama Sekolah tidak boleh kosong'
                    }
                }
            },univer: {
                validators: {
                    notEmpty: {
                        message: 'Universitas tidak boleh kosong'
                    }
                }
            },kotsek: {
                validators: {
                    notEmpty: {
                        message: 'Kota Sekolah tidak boleh kosong'
                    }
                }
            },tgijazah: {
                validators: {
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'The date is not a valid'
                    },
                    notEmpty: {
                        message: 'Tgl Ijazah tidak boleh kosong'
                    }
                }
            },noijazah: {
                validators: {
                    notEmpty: {
                        message: 'No. Ijazah tidak boleh kosong'
                    }
                }
            },tgacckop: {
                validators: {
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'The date is not a valid'
                    }
                }
            },tgmulai: {
                validators: {
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'The date is not a valid'
                    }
                }
            },tgakhir: {
                validators: {
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'The date is not a valid'
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
            $('#defaultForm2').bootstrapValidator('revalidateField', 'tgijazah');
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
            $('#defaultForm2').bootstrapValidator('revalidateField', 'tgacckop');
        });

    $('#data_3 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy"/*,
        endDate: new Date()*/
    }).on('changeDate', function(e) {
            // Revalidate the date field
            $('#defaultForm2').bootstrapValidator('revalidateField', 'tgmulai');
        });

    $('#data_5 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy"/*,
        endDate: new Date()*/
    }).on('changeDate', function(e) {
            // Revalidate the date field
            $('#defaultForm2').bootstrapValidator('revalidateField', 'tgakhir');
        });
    
    $('#data_6 .input-group.date').datepicker({
        format: 'yyyy',
        viewMode: 'years',
        minViewMode: 'years',
		autoclose:true
    }); 

    $('#data_65 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy"
    }).on('changeDate', function(e) {
            // Revalidate the date field
            // $('#defaultForm2').bootstrapValidator('revalidateField', 'mulaistoptkd');
        });

    $('#data_7 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy"
    }).on('changeDate', function(e) {
            // Revalidate the date field
            // $('#defaultForm2').bootstrapValidator('revalidateField', 'akhirstoptkd');
        });
    
      

    /*START CHOSEN*/
    var config = {
      '.chosen-jendik'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-kodik'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-univer'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-status'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    /*END CHOSEN*/

});

$(function() {
    $("#jendik").on("change", function(event) {
        event.preventDefault();

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/home/getKodikNonFormal",
            type: "post",
            data: {jendik : $('#jendik').val()},
            dataType: 'json',
            beforeSend: function() {
                $('select#kodik').hide();
            },
            success: function(data) {
                if(data.response == 'SUKSES'){
                     $('#kodik').html(data.listKodik);
                }else{
                     $('#kodik').html('');
                }

            },
            error: function(xhr) {
                alert("Terjadi kesalahan. Silahkan coba kembali");
            },
            complete: function() {
                $(".chosen-kodik").trigger("chosen:updated");
            }
        });
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
        url = "<?php echo site_url('riwayat/ajax_update_pend_nonformal')?>";
    }
    else
    {
        url = "<?php echo site_url('riwayat/ajax_add_pend_nonformal')?>";
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

            }else if(data.response == 'GAGAL'){
                //$('.msg').html('');
                //$('.err').html("<small>Data gagal disimpan, silahkan coba kembali.</small>");
                swal({type:"warning",title:"Data Sudah Digunakan", text:"Periksa Kembali Jenis Pendidikan dan Kode Pendidikan yang dipilih"});
                
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