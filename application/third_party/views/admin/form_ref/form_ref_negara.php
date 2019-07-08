
<style type="text/css">
    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
</style>

<form id="defaultForm2" name="defaultForm2" action="javascript:submit();" method="post" class="form-horizontal" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">      
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	<h4 class="modal-title" id="myModalLabel">Form Referensi Negara</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-12">
                <input type="hidden" value="ref_negara" name="destination" id="destination">
                <input type="hidden" value="tambah" name="action" id="action">
                <input type="hidden" value="" name="key" id="key">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Kode Negara</label>
                        <div class="col-lg-8">
                            <input type="text" id="koneg" name="koneg" onkeypress="return numbersonly1(this, event)" minlength="3" maxlength="3" placeholder="Kode Negara" value="<?php echo isset($isian->KONEG) ? $isian->KONEG : ""; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nama Negara</label>
                        <div class="col-lg-8">
                            <input type="text" id="naneg" name="naneg" maxlength="25" placeholder="Nama Negara" value="<?php echo isset($isian->NANEG) ? $isian->NANEG : ""; ?>" class="form-control">
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
                koneg: {
                    validators: {
                        notEmpty: {
                            message: 'Kode Negara tidak boleh kosong'
                        }
                    }
                },naneg: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Negara tidak boleh kosong'
                        }
                    }
                }
            }
        });
    });
    /*END SETTING VALIDASI*/
    

</script>