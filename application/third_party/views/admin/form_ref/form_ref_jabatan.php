
<style type="text/css">
    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
    .pickerpicker .form-control-feedback {
        right: 30px !important;      
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
    	<h4 class="modal-title" id="myModalLabel">Form Referensi Jabatan Struktural</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Kode Jabatan</label>
                        <div class="col-sm-7">
                            <input type="text" id="kojab" name="kojab" placeholder="Kode Jabatan" minlength="6" maxlength="6" onkeypress="return numbersonly(this, event)" value="<?php echo isset($isian->KOJAB) ? $isian->KOJAB : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="display: none">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Kode Sort</label>
                        <div class="col-sm-7">
                            <input type="number" min="0" max="9" id="kdsort" name="kdsort" placeholder="Kode Sort (0-9)" maxlength="1" value="<?php echo isset($isian->KDSORT) ? $isian->KDSORT : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" value="ref_jabatan" name="destination" id="destination">
                    <input type="hidden" value="tambah" name="action" id="action">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Nama Jabatan(Pendek)</label>
                        <div class="col-sm-7">
                            <input type="text" id="najabs" name="najabs" placeholder="Nama Jabatan" maxlength="30" value="<?php echo isset($isian->NAJABS) ? $isian->NAJABS : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Nama Jabatan(Panjang)</label>
                        <div class="col-sm-7">
                            <input type="text" id="najabl" name="najabl" placeholder="Nama Jabatan Lengkap" maxlength="100" value="<?php echo isset($isian->NAJABL) ? $isian->NAJABL : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Eselon</label>
                        <div class="col-sm-7">
                            <!--<input type="text" id="eselon" name="eselon" placeholder="ESELON" value="<?php echo isset($isian->ESELON) ? $isian->ESELON : ""; ?>" class="form-control">-->
                            <select class="form-control chosen-select" data-placeholder="Pilih Eselon..." name="eselon" id="eselon" tabindex="2" style="width:200px">
                                <option value=""></option>
                                <?php echo $listEselon; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Peringkat</label>
                        <div class="col-sm-7">
                            <input type="text" id="peringkat" name="peringkat" placeholder="Peringkat" maxlength="4" value="<?php echo isset($isian->PERINGKAT) ? $isian->PERINGKAT : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Kolok Sektoral</label>
                        <div class="col-sm-7">
                            <input type="text" id="kolok_sektoral" name="kolok_sektoral" placeholder="Kolok Sektoral" maxlength="9" value="<?php echo isset($isian->KOLOK_SEKTORAL) ? $isian->KOLOK_SEKTORAL : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group pickerpicker" id="data_6">
                        <label class="col-sm-5 control-label">Tahun</label>
                        <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tahun" name="tahun" placeholder="Tahun" value="<?php echo isset($isin->TAHUN) ? $isian->TAHUN : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Job Class 1</label>
                        <div class="col-sm-7">
                            <input type="number" min="0" max="20" id="job_class1" name="job_class1" placeholder="Job Class 1"   value="<?php echo isset($isian->JOB_CLASS1) ? $isian->JOB_CLASS1 : ""; ?>" class="form-control" maxlength="1">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Job Class 2</label>
                        <div class="col-sm-7">
                            <!--<input type="text" id="job_class2" name="job_class2" placeholder="Job Class 2" maxlength="1" value="<?php echo isset($isian->JOB_CLASS2) ? $isian->JOB_CLASS2 : ""; ?>" class="form-control" maxlength="1">-->
                            <select class="form-control" name="job_class2" id="job_class2" style="width:99%">
                                <option value="">--Pilih Job Class 2--</option>
                                <option value="<?php echo isset($isian->JOB_CLASS2) ? "A" : "A"; ?>">A</option>
                                <option value="<?php echo isset($isian->JOB_CLASS2) ? "B" : "B"; ?>">B</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Tunjangan Transport</label>
                        <div class="col-sm-7">
                            <input type="text" id="transport" name="transport" placeholder="Tunjangan Transport" onkeypress="return numbersonly(this, event)" maxlength="8" value="<?php echo isset($isian->TRANSPORT) ? $isian->TRANSPORT : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Tunjangan Jabatan</label>
                        <div class="col-sm-7">
                            <input type="text" id="tunjab" name="tunjab" placeholder="Tunjangan Jabatan" onkeypress="return numbersonly(this, event)" maxlength="8" value="<?php echo isset($isian->TUNJAB) ? $isian->TUNJAB : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Point</label>
                        <div class="col-sm-7">
                            <input type="text" id="point" name="point" placeholder="Point" maxlength="5" onkeypress="return numbersonly(this, event)" value="<?php echo isset($isian->POINT) ? $isian->POINT : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Point (207)</label>
                        <div class="col-sm-7">
                            <input type="text" id="point_207" name="point_207" placeholder="POINT 207" onkeypress="return numbersonly(this, event)" maxlength="5" value="<?php echo isset($isian->POINT_207) ? $isian->POINT_207 : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Tahap I</label>
                        <div class="col-sm-7">
                            <input type="text" id="tahap1" name="tahap1" placeholder="Tahap 1" maxlength="9" onkeypress="return numbersonly(this, event)" value="<?php echo isset($isian->TAHAP1) ? $isian->TAHAP1 : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Tahap II</label>
                        <div class="col-sm-7">
                            <input type="text" id="tahap2" name="tahap2" placeholder="Tahap 2" maxlength="9" onkeypress="return numbersonly(this, event)" value="<?php echo isset($isian->TAHAP2) ? $isian->TAHAP2 : ""; ?>" class="form-control">
                        </div>
                    </div>
                </div>
            </div>           
        
    </div>
    <div class="modal-footer">
        <span class="pull-left">
            <label class="msg text-success"></label>
            <label class="err text-danger"></label>
        </span>
    	<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
    	<button type="submit" id="butsimpan" class="btn btn-primary">Simpan</button>
        <!-- <input type="submit" class="btn btn-primary" id="b_simpan" name="simpan" value="Simpan" style="display:non;"/> -->
    </div>
</form>


 <script type="text/javascript">
    var kolok;
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

   function kolokan(id){
                    $.ajax({
                        url: "referensi/generateReferensi",
                        type: "post",
                        data: {id_referensi:$("#referensi_list").val(),kolok:id},
                        dataType: 'json',
                        beforeSend: function() {
                            $('#_content_referensi').removeAttr('class').attr('class', '');
                            var animation = 'fadeOutDown';
                            $('#_content_referensi').addClass('animated');
                            $('#_content_referensi').addClass(animation);
                            // return false;
                            $('#content_referensi').html('<div><img src="<?php echo base_url() ?>assets/inspinia/img/loading_bar.gif"></div>');
                            $('#checkproses').val('0');
                        },
                        success: function(data) {                                                                     
                            if(data.response == 'SUKSES'){                            
                                 $("#content_referensi").html(data.result);
                                 $('#checkproses').val('1');
                            }else{
                                 $("#content_referensi").html('');
                                 $('#checkproses').val('0');
                            }
                        },
                        error: function(xhr) {                              
                            if($('#checkproses').val() == 0){
                                $("#content_referensi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        },
                        complete: function() {
                            $('.dataTables-example').dataTable({
                                // responsive: true,
                                "destroy" : true,
                                "scrollX": true
                            });

                            if($('#checkproses').val() == 0){
                                $("#content_referensi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                            
                        }
                    });
            }

     $("#butsimpan").on("click", function(event) {
     	submit();
     })

    function submit(){
        var kolok=$('#kolokO').val();
        
        $.ajax({
            url: '<?php echo base_url("index.php/referensi/simpanReferensi"); ?>',
            type: "post",
            data: $('#defaultForm2').serialize()+'&kolok='+kolok,
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
                      //location.reload=true;  
                    //kolokan(kolok);
                    //reloadTable();
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
                $.getScript("<?php echo base_url() ?>assets/js/kolok.js");
                kolokan(kolok);
            }
        });
    }


    /*START SETTING VALIDASI*/
    $(document).ready(function() {        

        $('#defaultForm2').bootstrapValidator({
            live: 'enabled',
            excluded:'disabled',
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
                },eselon: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Eselon tidak boleh kosong'
                        }
                    }
                },najabl: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Jabatan Lengkap tidak boleh kosong'
                        }
                    }
                },kdsort: {
                    validators: {
                        notEmpty: {
                            message: 'Kode Sort tidak boleh kosong'
                        }
                    }
                }

            }
        });

        $('#data_6 .input-group.date').datepicker({
            format: 'yyyy',
            viewMode: 'years',
            minViewMode: 'years'
            }); 

        /*START CHOSEN*/
    var config = {
        '.chosen-select'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width:'250px'}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
    /*END CHOSEN*/
});
    /*END SETTING VALIDASI*/

    
    

</script>