
<style type="text/css">
    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
</style>

<form id="defaultForm2" name="defaultForm2" action="javascript:submit();" method="post" class="form-horizontal" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">      
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	<h4 class="modal-title" id="myModalLabel">Form Referensi Jabatan Fungsional</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-6">
                    <input type="hidden" value="ref_jabatanf" name="destination" id="destination">
                    <input type="hidden" value="tambah" name="action" id="action">
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Kode Jabatan</label>
                        <div class="col-sm-7">
                            <input type="text" id="kojab" name="kojab" placeholder="Kode Jabatan" minlength="6" maxlength="6" value="<?php echo isset($isian->KOJAB) ? $isian->KOJAB : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Peringkat</label>
                        <div class="col-sm-7">
                            <input type="text" id="peringkat" name="peringkat" placeholder="Peringkat" maxlength="4" value="<?php echo isset($isian->PERINGKAT) ? $isian->PERINGKAT : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Nama Jabatan Pendek</label>
                        <div class="col-sm-7">
                            <input type="text" id="najabs" name="najabs" placeholder="Nama Jabatan" maxlength="30" value="<?php echo isset($isian->NAJABS) ? $isian->NAJABS : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Nama Jabatan Panjang</label>
                        <div class="col-sm-7">
                            <input type="text" id="najabl" name="najabl" placeholder="Nama Jabatan Lengkap" maxlength="100" value="<?php echo isset($isian->NAJABL) ? $isian->NAJABL : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <!--<div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Kode Sort</label>
                        <div class="col-sm-7">
                            <input type="number" min="0" max="9" id="kdsort" name="kdsort" placeholder="Kode Sort" value="<?php echo isset($isian->KDSORT) ? $isian->KDSORT : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>-->
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Job Class 1</label>
                        <div class="col-sm-7">
                            <input type="text" id="job_class1" name="job_class1" placeholder="Job Class 1" maxlength="2" onkeypress="return numbersonly(this, event)" value="<?php echo isset($isian->JOB_CLASS1) ? $isian->JOB_CLASS1 : ""; ?>" class="form-control" maxlength="1">
                        </div>
                    </div>
                </div>

                 <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Job Class 2</label>
                        <div class="col-sm-7">
                            <input type="text" id="job_class2" name="job_class2" placeholder="Job Class 2" maxlength="1" value="<?php echo isset($isian->JOB_CLASS2) ? $isian->JOB_CLASS2 : ""; ?>" class="form-control" maxlength="1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
               
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Point</label>
                        <div class="col-sm-7">
                            <input type="text" id="point" name="point" placeholder="Point" maxlength="5" onkeypress="return numbersonly(this, event)" value="<?php echo isset($isian->POINT) ? $isian->POINT : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Point (207)</label>
                        <div class="col-sm-7">
                            <input type="text" id="point_207" name="point_207" placeholder="POINT 207" maxlength="5" onkeypress="return numbersonly(this, event)" value="<?php echo isset($isian->POINT_207) ? $isian->POINT_207 : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Tunjangan Jabatan</label>
                        <div class="col-sm-7">
                            <input type="text" id="tunjab" name="tunjab" placeholder="Tunjangan Jabatan" maxlength="8" onkeypress="return numbersonly(this, event)" value="<?php echo isset($isian->TUNJAB) ? $isian->TUNJAB : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Tunjangan Fungsional</label>
                        <div class="col-sm-7">
                            <input type="text" id="tunfung" name="tunfung" placeholder="Tunjangan Fungsional" maxlength="8" onkeypress="return numbersonly(this, event)" value="<?php echo isset($isian->TUNFUNG) ? $isian->TUNFUNG : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                

            </div>
            <div class="row">
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Tahap I</label>
                        <div class="col-sm-7">
                            <input type="text" id="tahap1" name="tahap1" placeholder="Tahap 1" maxlength="9" onkeypress="return numbersonly(this, event)" value="<?php echo isset($isian->TAHAP1) ? $isian->TAHAP1 : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-5 control-label">Tahap II</label>
                        <div class="col-sm-7">
                            <input type="text" id="tahap2" name="tahap2" placeholder="Tahap 2" maxlength="9" onkeypress="return numbersonly(this, event)" value="<?php echo isset($isian->TAHAP2) ? $isian->TAHAP2 : ""; ?>" class="form-control">
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
        <!-- <input type="submit" class="btn btn-primary" id="b_simpan" name="simpan" value="Simpan" style="display:non;"/> -->
    </div>
</form>


 <script type="text/javascript">
    function numbersonly(myfield, e, dec) 
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
                kojab: {
                    validators: {
                        notEmpty: {
                            message: 'Kode Jabatan tidak boleh kosong'
                        }
                    }
                },
                najabs: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Jabatan tidak boleh kosong'
                        }
                    }
                },tunfung: {
                    validators: {
                        notEmpty: {
                            message: 'Tunjangan Fungsional tidak boleh kosong'
                        }
                    }
                },najabl: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Jabatan Lengkap tidak boleh kosong'
                        }
                    }
                }
            }
        });
    });
    /*END SETTING VALIDASI*/
    

</script>