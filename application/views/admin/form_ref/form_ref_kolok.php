
<style type="text/css">
    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
    .pickerpicker .form-control-feedback {
        right: 35px !important;      
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

<form id="defaultForm2" name="defaultForm2" action="javascript:submit();" method="post" class="form-horizontal" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">      
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	<h4 class="modal-title" id="myModalLabel">Form Referensi Lokasi Kerja</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-12">
                <input type="hidden" value="ref_kolok" name="destination" id="destination">
                <input type="hidden" value="tambah" name="action" id="action">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Kode Lokasi</label>
                        <div class="col-lg-6">
                            <input type="text" id="kolok" name="kolok" placeholder="Kode Lokasi" onkeypress="return numbersonly1(this, event)" value="<?php echo isset($isian->KOLOK) ? $isian->KOLOK : ""; ?>" maxlength="9" minlength="9" class="form-control">
                        </div>
                    </div>
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Nama Lokasi Kerja (Pendek)</label>
                        <div class=" col-lg-6">
                            <input type="text" id="naloks" name="naloks" placeholder="Nama Lokasi Kerja Pendek" value="<?php echo isset($isian->NALOKS) ? $isian->NALOKS : ""; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Nama Lokasi Kerja (Panjang)</label>
                        <div class="col-lg-6">
                            <input type="text" id="nalokl" name="nalokl" placeholder="Nama Lokasi Kerja Panjang" value="<?php echo isset($isian->NALOKL) ? $isian->NALOKL : ""; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Kode Tunjangan Beras</label>
                        <div class="col-lg-6">
                            <select id="koras" name="koras" class="form-control">
                                <option value="Y" <?php if (isset($isian->KORAS)){if ($isian->KORAS=='Y'){echo "selected";}} ?>>Y</option>
                                <option value="T" <?php if (isset($isian->KORAS)){if ($isian->KORAS=='T'){echo "selected";}} ?>>T</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Kode Insentif Makan</label>
                        <div class="col-lg-6">
                            <select id="makan_ins" name="makan_ins" class="form-control">
                                <option value="0" <?php if (isset($isian->MAKAN_INS)){if ($isian->MAKAN_INS=='0'){echo "selected";}} ?>>0</option>
                                <option value="1" <?php if (isset($isian->MAKAN_INS)){if ($isian->MAKAN_INS=='1'){echo "selected";}} ?>>1</option>
                                <option value="2" <?php if (isset($isian->MAKAN_INS)){if ($isian->MAKAN_INS=='2'){echo "selected";}} ?>>2</option>
                                <option value="3" <?php if (isset($isian->MAKAN_INS)){if ($isian->MAKAN_INS=='3'){echo "selected";}} ?>>3</option>
                            </select>
                        </div>
                    </div>
                    
                     <div class="form-group pickerpicker" id="data_6">
                        <label class="col-sm-4 control-label">Tahun</label>
                        <div class="input-group col-sm-7 date">
                            <!--<input type="text" id="angkatan" name="angkatan" maxlength="8" placeholder="Angkatan" value="<?php echo isset($infoPendidikan->ANGKATAN) ? $infoPendidikan->ANGKATAN : ""; ?>" class="form-control">-->
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tahun" name="tahun" placeholder="Tahun" value="<?php echo isset($isian->TAHUN) ? $isian->TAHUN : ""; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Aktif</label>
                        <div class=" col-lg-6">
                            <select id="aktif" name="aktif" class="form-control">
                                <option value="1" <?php if (isset($isian->AKTIF)){if ($isian->AKTIF=='1'){echo "selected";}} ?>>Aktif</option>
                                <option value="0" <?php if (isset($isian->AKTIF)){if ($isian->AKTIF=='0'){echo "selected";}} ?>>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Kode Unit SIPKD</label>
                        <div class="col-lg-6">
                            <input type="text" id="kode_unit_sipkd" name="kode_unit_sipkd" placeholder="KODE UNIT SIPKD" value="<?php echo isset($isian->KODE_UNIT_SIPKD) ? $isian->KODE_UNIT_SIPKD : ""; ?>" class="form-control">
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
        <!-- <input type="submit" class="btn btn-primary" id="b_simpan" name="simpan" value="Simpan" style="display:non;"/> -->
    </div>
</form>


 <script type="text/javascript">

    function submit(){
        $.ajax({
            url: '<?php echo base_url("index.php/referensi/simpanReferensi"); ?>',
            type: "post",
            data: $('#defaultForm2').serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('.msg').html('<div><div class="sk-spinner sk-spinner-rotating-plane"></div></div>');
                $('.err').html("");
            },
            success: function(data) {                                                                     
                if(data.response == 'SUKSES'){
                    $('.msg').html('<small>Data berhasil disimpan.</small>');
                    $('.err').html('');

                    $('#myModal').modal('hide');
                    setTimeout(function () {
                        reloadTable();
                    }, 1000);                        

                }else{
                    $('.msg').html('');
                    $('.err').html("<small>Data gagal disimpan, Key sudah digunakan.</small>");
                    //alert(data.hasil);
                }   
            },
            error: function(xhr) {                              
                $('.msg').html('');
                $('.err').html("<small>Data gagal disimpan, silahkan coba kembali.</small>");
            },
            complete: function() {
                                        
            }
        });                
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

    /*START SETTING VALIDASI*/
    $(document).ready(function() {        

        $('#defaultForm2').bootstrapValidator({
            live: 'enabled',
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },            
            fields: {            
                kolok: {
                    validators: {
                        notEmpty: {
                            message: 'Kode lokasi kerja tidak boleh kosong'
                        }
                    }
                },naloks: {
                    validators: {
                        notEmpty: {
                            message: 'Nama lokasi kerja (pendek) tidak boleh kosong'
                        }
                    }
                },nalokl: {
                    validators: {
                        notEmpty: {
                            message: 'Nama lokasi kerja (panjang) tidak boleh kosong'
                        }
                    }
                },koras: {
                    validators: {
                        notEmpty: {
                            message: 'Koras tidak boleh kosong'
                        }
                    }
                },makan_ins: {
                    validators: {
                        notEmpty: {
                            message: 'Makan Ins tidak boleh kosong'
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
            format: "yyyy"
        });

        $('#data_6 .input-group.date').datepicker({
        format: 'yyyy',
        viewMode: 'years',
        minViewMode: 'years'
    });
    });
    /*END SETTING VALIDASI*/
    

</script>