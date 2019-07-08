
<style type="text/css">
    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
    .pickerpicker .form-control-feedback {
        right: 100px !important;      
    }a

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
        <h4 class="modal-title" id="myModalLabel">Form Riwayat Alamat</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START FULL SIDE -->
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-5 control-label">NRK</label>
                        <div class="input-group col-sm-3">
                            <input type="text" id="nrk" name="nrk" placeholder="NRK" class="form-control" value="<?php echo isset($nrk) ? $nrk : '' ?>" readOnly="true">
                        </div>
                    </div>
                        

                    <div class="form-group pickerpicker" id="data_1">
                        <label class="col-sm-5 control-label">Tgl. Input</label>
                        <?php if($action == 'update'){ ?>
                            <div class="input-group col-sm-3 date">
                                <span class="input-group-addon" style="display: none"><i class="fa fa-calendar"></i></span><input type="text" id="tgmulai" name="tgmulai" placeholder="Tgl Input" value="<?php echo isset($infoAlamat->TGMULAI) ? date('d-m-Y', strtotime($infoAlamat->TGMULAI)) : '' ?>" class="form-control" readonly>
                            </div>
                        <?php } else { ?>
                            <div class="input-group col-sm-3 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgmulai"  name="tgmulai" placeholder="Tgl Input" value="<?php echo isset($infoAlamat->TGMULAI) ? date('d-m-Y', strtotime($infoAlamat->TGMULAI)) : '' ?>" class="form-control">
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group pickerpicker">                      
                      <div class="input-group col-sm-8">                
                           <input type="hidden" id="stat_app" name="stat_app" class="form-control" value="<?php echo isset($infoAlamat->STAT_APP) ? 2 : 2; ?>">
                      </div>
                    </div>

                </div>
                <!-- END FULL SIDE -->
                <!-- START SIDE 1 -->
                <div class="col-sm-6">                    
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">&nbsp;</label>
                        <div class="input-group col-sm-8">
                            &nbsp;
                        </div>
                    </div>

                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Alamat Domisili</label>
                        <div class="input-group col-sm-8">
                            <textarea class="form-control" name="alamat" id="alamat" maxlength="100" placeholder="Alamat Domisili"><?php echo isset($infoAlamat->ALAMAT) ? $infoAlamat->ALAMAT : ''; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">RT</label>
                      <div class="input-group col-sm-8">
                         <input type="text" id="rt" name="rt" placeholder="RT" maxlength="3" class="form-control" value="<?php echo isset($infoAlamat->RT) ? $infoAlamat->RT : ''; ?>" onkeypress="return numbersonly1(this, event)">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">RW</label>
                      <div class="input-group col-sm-8">
                         <input type="text" id="rw" name="rw" placeholder="RW" maxlength="3" class="form-control" value="<?php echo isset($infoAlamat->RW) ? $infoAlamat->RW : ''; ?>" onkeypress="return numbersonly1(this, event)">
                      </div>
                    </div>
                    
                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Propinsi</label>
                      <div class="input-group col-sm-8">                
                          <select class="form-control chosen-propinsi" name="prop" id="prop" tabindex="2" data-placeholder="Pilih Propinsi...">
                            <option value=""></option>
                            <?php echo $listPropinsi; ?>   
                          </select>
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Kota/Kabupaten</label>
                      <div class="input-group col-sm-8">                               
                         <select class="form-control chosen-wilayah" name="kowil" id="kowil" tabindex="2" data-placeholder="Pilih Wilayah...">
                            <option value=""></option>
                            <?php echo $listWilayah; ?>
                          </select>
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Kecamatan</label>
                      <div class="input-group col-sm-8">                             
                          <select class="form-control chosen-kecamatan" name="kocam" id="kocam" tabindex="2" data-placeholder="Pilih Kecamatan...">
                            <option value=""></option>
                            <?php echo $listKecamatan; ?>
                          </select>
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Kelurahan</label>
                      <div class="input-group col-sm-8">                              
                          <select class="form-control chosen-kelurahan" name="kokel" id="kokel" tabindex="2" data-placeholder="Pilih Kelurahan...">
                            <option value=""></option>
                            <?php echo $listKelurahan; ?>                               
                          </select>
                      </div>
                    </div>                    
                </div>    
                <!-- END SIDE 1 -->
                <!-- START SIDE 2 -->
                <div class="col-sm-6">
                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">&nbsp;</label>
                      <label>
                          <input id="sama_almt" name="sama_almt" type="checkbox" value="1" onclick="samakanAlamat()">
                          Alamat KTP sesuai dengan alamat tempat tinggal
                      </label>
                    </div>

                    <div class="form-group pickerpicker" id="div_almt_ktp">
                      <label class="col-sm-4 control-label">Alamat KTP</label>
                      <div class="input-group col-sm-8">
                         <textarea class="form-control" name="alamat_ktp" id="alamat_ktp" maxlength="100"  placeholder="Alamat KTP"><?php echo isset($infoAlamat->ALAMAT_KTP) ? $infoAlamat->ALAMAT_KTP : ''; ?></textarea>
                      </div>
                    </div>                   

                    <div class="form-group pickerpicker" id="div_rt_ktp">
                      <label class="col-sm-4 control-label">RT</label>
                      <div class="input-group col-sm-8">
                         <input type="text" id="rt_ktp" name="rt_ktp" placeholder="RT" maxlength="3" class="form-control" value="<?php echo isset($infoAlamat->RT_KTP) ? $infoAlamat->RT_KTP : ''; ?>" onkeypress="return numbersonly1(this, event)">
                      </div>
                    </div>

                    <div class="form-group pickerpicker" id="div_rw_ktp">
                      <label class="col-sm-4 control-label">RW</label>
                      <div class="input-group col-sm-8">
                         <input type="text" id="rw_ktp" name="rw_ktp" placeholder="RW" maxlength="3" class="form-control" value="<?php echo isset($infoAlamat->RW_KTP) ? $infoAlamat->RW_KTP : ''; ?>" onkeypress="return numbersonly1(this, event)">
                      </div>
                    </div>

                    <div class="form-group pickerpicker" id="div_prop_ktp">
                      <label class="col-sm-4 control-label">Propinsi</label>
                      <div class="input-group col-sm-8">                
                          <select class="form-control chosen-propinsi-ktp" name="prop_ktp" id="prop_ktp" tabindex="2" data-placeholder="Pilih Propinsi...">
                            <option value=""></option>
                            <?php echo $listPropinsiKtp; ?>   
                          </select>
                      </div>
                    </div>

                    <div class="form-group pickerpicker" id="div_wil_ktp">
                      <label class="col-sm-4 control-label">Kota/Kabupaten</label>
                      <div class="input-group col-sm-8">                               
                         <select class="form-control chosen-wilayah-ktp" name="kowil_ktp" id="kowil_ktp" tabindex="2" data-placeholder="Pilih Wilayah...">
                            <option value=""></option>
                            <?php echo $listWilayahKtp; ?>
                          </select>
                      </div>
                    </div>

                    <div class="form-group pickerpicker" id="div_kec_ktp">
                      <label class="col-sm-4 control-label">Kecamatan</label>
                      <div class="input-group col-sm-8">                             
                          <select class="form-control chosen-kecamatan-ktp" name="kocam_ktp" id="kocam_ktp" tabindex="2" data-placeholder="Pilih Kecamatan...">
                            <option value=""></option>
                            <?php echo $listKecamatanKtp; ?>
                          </select>
                      </div>
                    </div>

                    <div class="form-group pickerpicker" id="div_kel_ktp">
                      <label class="col-sm-4 control-label">Kelurahan</label>
                      <div class="input-group col-sm-8">                              
                          <select class="form-control chosen-kelurahan-ktp" name="kokel_ktp" id="kokel_ktp" tabindex="2" data-placeholder="Pilih Kelurahan...">
                            <option value=""></option>
                            <?php echo $listKelurahanKtp; ?>                               
                          </select>
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
  <?php if ($action=='update'){?>
    showHideCekSamakan();
  <?php } ?>

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
                        message: 'Tgl. Input tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            },
            alamat: {
                validators: {
                    notEmpty: {
                        message: 'Alamat tidak boleh kosong'
                    }
                }
            },
            rt: {
                validators: {
                    notEmpty: {
                        message: 'RT tidak boleh kosong'
                    }
                }
            },
            rw: {
                validators: {
                    notEmpty: {
                        message: 'RW tidak boleh kosong'
                    }
                }
            },
            kowil: {
                validators: {
                    notEmpty: {
                        message: 'Wilayah harus dipilih'
                    }
                }
            },
            kocam: {
                validators: {
                    notEmpty: {
                        message: 'Kecamatan harus dipilih'
                    }
                }
            },
            kokel: {
                validators: {
                    notEmpty: {
                        message: 'Kelurahan harus dipilih'
                    }
                }
            },
            prop: {
                validators: {
                    notEmpty: {
                        message: 'Propinsi harus dipilih'
                    }
                }
            }
            //==============
        }
    });

    if ($('#tgmulai').val() == ""){
      $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        defaultDate: 'now',
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy",
        endDate: new Date()
    }).datepicker("setDate", "0") .on('changeDate', function(e) {
        $('#defaultForm2').bootstrapValidator('revalidateField', 'tgmulai');
        });
  } else { 
    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        defaultDate: 'now',
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy",
        endDate: new Date()
    }).on('changeDate', function(e) {
        $('#defaultForm2').bootstrapValidator('revalidateField', 'tgmulai');
        });
  } 

    /*START CHOSEN*/
    var config = {
      '.chosen-wilayah'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan'},
      '.chosen-kecamatan'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan'},
      '.chosen-kelurahan'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan'},
      '.chosen-propinsi'           : {search_contains:true,no_results_ntext:'Oops, Data Tidak Ditemukan'},
      '.chosen-wilayah-ktp'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan'},
      '.chosen-kecamatan-ktp'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan'},
      '.chosen-kelurahan-ktp'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan'},
      '.chosen-propinsi-ktp'           : {search_contains:true,no_results_ntext:'Oops, Data Tidak Ditemukan'}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    /*END CHOSEN*/

    $("#prop").on("change", function(event) {
        event.preventDefault();

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/home/getWilayahNew2",
            type: "post",
            data: {prop : $('#prop').val()},
            dataType: 'json',
            beforeSend: function() {

            },
            success: function(data) {
                if(data.response == 'SUKSES'){
                    list = '<option value=""></option>' + data.list;
                     $('#kowil').html(list);
                }else{
                     $('#kowil').html('');
                }
                $('#kocam').html('<option value=""></option>');
            },
            error: function(xhr) {
                alert("Terjadi kesalahan. Silahkan coba kembali");
            },
            complete: function() {
                $(".chosen-wilayah").trigger("chosen:updated");
                $(".chosen-kecamatan").trigger("chosen:updated");
                $('#defaultForm2').bootstrapValidator('revalidateField', 'kowil');
                $('#defaultForm2').bootstrapValidator('revalidateField', 'kocam');
            }
        });
    });

    $("#prop_ktp").on("change", function(event) {
        event.preventDefault();

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/home/getWilayahNew2",
            type: "post",
            data: {prop : $('#prop_ktp').val()},
            dataType: 'json',
            beforeSend: function() {

            },
            success: function(data) {
                if(data.response == 'SUKSES'){
                    list = '<option value=""></option>' + data.list;
                     $('#kowil_ktp').html(list);
                }else{
                     $('#kowil_ktp').html('');
                }
                $('#kocam_ktp').html('<option value=""></option>');
            },
            error: function(xhr) {
                alert("Terjadi kesalahan. Silahkan coba kembali");
            },
            complete: function() {
                $(".chosen-wilayah-ktp").trigger("chosen:updated");
                $(".chosen-kecamatan-ktp").trigger("chosen:updated");
                $('#defaultForm2').bootstrapValidator('revalidateField', 'kowil_ktp');
                $('#defaultForm2').bootstrapValidator('revalidateField', 'kocam_ktp');
            }
        });
    });

    $("#kowil").on("change", function(event) {
        event.preventDefault();

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/home/getKecamatanNew2",
            type: "post",
            data: {kowil : $('#kowil').val()},
            dataType: 'json',
            beforeSend: function() {

            },
            success: function(data) {
                if(data.response == 'SUKSES'){
                    list = '<option value=""></option>' + data.list;
                     $('#kocam').html(list);
                }else{
                     $('#kocam').html('');
                }
                $('#kokel').html('<option value=""></option>');
            },
            error: function(xhr) {
                alert("Terjadi kesalahan. Silahkan coba kembali");
            },
            complete: function() {
                $(".chosen-kecamatan").trigger("chosen:updated");
                $(".chosen-kelurahan").trigger("chosen:updated");
                $('#defaultForm2').bootstrapValidator('revalidateField', 'kocam');
                $('#defaultForm2').bootstrapValidator('revalidateField', 'kokel');
            }
        });
    });

    $("#kowil_ktp").on("change", function(event) {
        event.preventDefault();

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/home/getKecamatanNew2",
            type: "post",
            data: {kowil : $('#kowil_ktp').val()},
            dataType: 'json',
            beforeSend: function() {

            },
            success: function(data) {
                if(data.response == 'SUKSES'){
                    list = '<option value=""></option>' + data.list;
                     $('#kocam_ktp').html(list);
                }else{
                     $('#kocam_ktp').html('');
                }
                $('#kokel_ktp').html('<option value=""></option>');
            },
            error: function(xhr) {
                alert("Terjadi kesalahan. Silahkan coba kembali");
            },
            complete: function() {
                $(".chosen-kecamatan-ktp").trigger("chosen:updated");
                $(".chosen-kelurahan-ktp").trigger("chosen:updated");
                $('#defaultForm2').bootstrapValidator('revalidateField', 'kocam_ktp');
                $('#defaultForm2').bootstrapValidator('revalidateField', 'kokel_ktp');
            }
        });
    });

    $("#kocam").on("change", function(event) {
        event.preventDefault();

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/home/getKelurahanNew2",
            type: "post",
            data: {kocam : $('#kocam').val()},
            dataType: 'json',
            beforeSend: function() {

            },
            success: function(data) {
                if(data.response == 'SUKSES'){
                    list = '<option value=""></option>' + data.list;
                     $('#kokel').html(list);
                }else{
                     $('#kokel').html('');
                }

            },
            error: function(xhr) {
                alert("Terjadi kesalahan. Silahkan coba kembali");
            },
            complete: function() {
                $(".chosen-kelurahan").trigger("chosen:updated");

                $('#defaultForm2').bootstrapValidator('revalidateField', 'kokel');
            }
        });
    });

    $("#kocam_ktp").on("change", function(event) {
        event.preventDefault();

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/home/getKelurahanNew2",
            type: "post",
            data: {kocam : $('#kocam_ktp').val()},
            dataType: 'json',
            beforeSend: function() {

            },
            success: function(data) {
                if(data.response == 'SUKSES'){
                    list = '<option value=""></option>' + data.list;
                     $('#kokel_ktp').html(list);
                }else{
                     $('#kokel_ktp').html('');
                }

            },
            error: function(xhr) {
                alert("Terjadi kesalahan. Silahkan coba kembali");
            },
            complete: function() {
                $(".chosen-kelurahan-ktp").trigger("chosen:updated");

                $('#defaultForm2').bootstrapValidator('revalidateField', 'kokel_ktp');
            }
        });
    });
});

function samakanAlamat(){
    // alert($("input[name='sama_almt']:checked").val());
    
    if($("input[name='sama_almt']:checked").val() == '1'){
        $('#alamat_ktp').hide();
        $('#div_rt_ktp').hide();
        $('#div_rw_ktp').hide();
        $('#div_prop_ktp').hide();
        $('#div_wil_ktp').hide();
        $('#div_kec_ktp').hide();
        $('#div_kel_ktp').hide();
    } else {
        $('#alamat_ktp').show();
        $('#div_rt_ktp').show();
        $('#div_rw_ktp').show();
        $('#div_prop_ktp').show();
        $('#div_wil_ktp').show();
        $('#div_kec_ktp').show();
        $('#div_kel_ktp').show();
    }
}

function showHideCekSamakan(){
    // alert($("#alamat_ktp").val());
    if($("#alamat_ktp").val() == ''){
        $("input[name='sama_almt']").attr('checked',true);
    } else {
        $("input[name='sama_almt']").attr('checked',false);
    }

    samakanAlamat();
}

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
        url = "<?php echo site_url('home/ajax_update_alamat')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_alamat')?>";
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
                swal({type:"warning",title:"DATA GAGAL DISIMPAN", text:"TANGGAL MULAI SUDAH DIGUNAKAN, MOHON PERIKSA KEMBALI DATA YANG DIINPUT"});
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
        },
        complete: function() {

        }
    });

      function samakanAlamat(){
        // alert($("input[name='sama_almt']:checked").val());
        if($("input[name='sama_almt']:checked").val() == '1'){
            $('#div_almt_ktp').hide();
            $('#div_rt_ktp').hide();
            $('#div_rw_ktp').hide();
            $('#div_prop_ktp').hide();
            $('#div_wil_ktp').hide();
            $('#div_kec_ktp').hide();
            $('#div_kel_ktp').hide();

            $('#alamat_ktp').val('');
            $('#rt_ktp').val('');
            $('#rw_ktp').val('');
            $('#prop_ktp').val('');
            $('#kowil_ktp').val('');
            $('#kocam_ktp').val('');
            $('#kokel_ktp').val('');
            $(".chosen-wilayah-ktp").trigger("chosen:updated");
            $(".chosen-kecamatan-ktp").trigger("chosen:updated");
            $(".chosen-kelurahan-ktp").trigger("chosen:updated");
            $(".chosen-propinsi-ktp").trigger("chosen:updated");
        } else {
            $('#div_almt_ktp').show();
            $('#div_rt_ktp').show();
            $('#div_rw_ktp').show();
            $('#div_prop_ktp').show();
            $('#div_wil_ktp').show();
            $('#div_kec_ktp').show();
            $('#div_kel_ktp').show();
        }
    }
}
</script>