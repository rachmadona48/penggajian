
<style type="text/css">
    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
</style>

<form id="defaultForm2" name="defaultForm2" action="javascript:submit();" method="post" class="form-horizontal" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">      
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	<h4 class="modal-title" id="myModalLabel">Form Referensi Lokasi Gaji</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-12">
                <input type="hidden" value="ref_spmu" name="destination" id="destination">
                <input type="hidden" value="tambah" name="action" id="action">
                <input type="hidden" value="" name="key" id="key">  
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Kode SPM</label>
                        <div class="col-lg-8">
                            <input type="text" id="kode_spm" name="kode_spm" maxlength="4" placeholder="KODE SPM" value="<?php echo isset($isian->KODE_SPM) ? $isian->KODE_SPM : ""; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nama</label>
                        <div class="col-lg-8">
                            <input type="text" id="nama" name="nama" placeholder="Nama" maxlength="66" value="<?php echo isset($isian->NAMA) ? $isian->NAMA: ""; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Klogad Induk</label>
                        <div class="col-lg-8">
                            <input type="text" id="klogad_induk" name="klogad_induk" placeholder="Klogad Induk" maxlength="9" value="<?php echo isset($isian->KLOGAD_INDUK) ? $isian->KLOGAD_INDUK : ""; ?>" class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group" id="data_6">
                        <label class="col-sm-4 control-label">Tahun</label>
                        <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tahun" name="tahun" placeholder="Tahun" value="<?php echo isset($isian->TAHUN) ? $isian->TAHUN : ""; ?>" class="form-control">
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
                    //$('.msg').html('');
                    //$('.err').html("<small>Data gagal disimpan, silahkan coba kembali.</small>");
                    alert(data.hasil);
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
                kode_spm: {
                    validators: {
                        notEmpty: {
                            message: 'Kode SPM tidak boleh kosong'
                        }
                    }
                },nama: {
                    validators: {
                        notEmpty: {
                            message: 'Nama tidak boleh kosong'
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
    });
    /*END SETTING VALIDASI*/
    

</script>