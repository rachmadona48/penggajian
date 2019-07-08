
<style type="text/css">
    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
    .pickerpicker .form-control-feedback {
        right: 75px !important;      
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
    	<h4 class="modal-title" id="myModalLabel">Form Referensi Kecamatan</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-12">
                <input type="hidden" value="ref_kecamatan" name="destination" id="destination">
                <input type="hidden" value="tambah" name="action" id="action">
                <input type="hidden" id="key2" value="" name="kowil0">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Wilayah</label>
                        <div class="col-lg-8">
                            <select class="form-control chosen-kowil" name="kowil" id="kowil" tabindex="2" data-placeholder="Pilih Wilayah">
                                <option></option>
                                <?php echo $listKowil; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Kode</label>
                        <div class="col-lg-8">
                            <input type="text" id="kocam" name="kocam" placeholder="Kode" onkeypress="return numbersonly1(this, event)" maxlength="2" value="<?php echo isset($isian->KOCAM) ? $isian->KOCAM : ""; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Kecamatan</label>
                        <div class="col-lg-8">
                            <input type="text" id="nacam" name="nacam" maxlength="25" placeholder="Kecamatan" value="<?php echo isset($isian->NACAM) ? $isian->NACAM : ""; ?>" class="form-control">
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <label class="col-sm-4 control-label">Wilayah</label>
                        <div class="col-lg-8">
                            <input type="text" id="nawil" name="nawil" placeholder="Wilayah" value="<?php echo isset($isian->NAWIL) ? $isian->NAWIL: ""; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>     -->               

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
   


    /*START SETTING VALIDASI*/
    $(document).ready(function() {   

         $("#key2").val($("#wilayahO").val()); 
         $("#key3").val($("#kecamatanO").val());    

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
                kocam: {
                    validators: {
                        notEmpty: {
                            message: 'Kode Kecamatan tidak boleh kosong'
                        }
                    }
                },nacam: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Kecamatan tidak boleh kosong'
                        }
                    }
                },kowil: {
                    validators: {
                        notEmpty: {
                            message: 'Wilayah harus dipilih'
                        }
                    }
                }
            }
        });
        var config = {
        '.chosen-kowil'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width:'300px'}
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }
    
    });
    /*END SETTING VALIDASI*/

    
    
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

</script>