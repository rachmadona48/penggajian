
<style type="text/css">
    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
    div.ex1 {
    direction: rtl;
}
</style>

<form id="defaultForm2" name="defaultForm2" data-backdrop="static" action="javascript:submit();" method="post" class="form-horizontal" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	<h4 class="modal-title" id="myModalLabel">Form Referensi Gaji Pokok</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-12">
                <input type="hidden" value="ref_gapok" name="destination" id="destination">
                <input type="hidden" value="tambah" name="action" id="action">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Pangkat</label>
                        <div class="col-sm-7">
                            <select class="form-control chosen-kopang" data-placeholder="Pilih Pangkat..." name="kopang" id="kopang" tabindex="2" placeholder="Pangkat" style="width:200px" onchange="setGol()">
                                <option value=""></option>
                                <?php echo $listKopang; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Golongan</label>
                        <div class="col-lg-7">
                            <input type="text" id="gol" name="gol" placeholder="Golongan" value="<?php echo isset($isian->GOL) ? $isian->GOL : ""; ?>" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tahun Masa Kerja</label>
                        <div class="col-lg-7">
                            <input type="text" id="ttmasker" name="ttmasker" placeholder="Tahun Masa Kerja (numbers only)" maxlength="2" onkeypress="return numbersonly1(this, event)" value="<?php echo isset($isian->TTMASKER) ? $isian->TTMASKER : ""; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Bulan Masa Kerja</label>
                        <div class="col-lg-7">
                            <input type="number" min="0" max="11" id="bbmasker" name="bbmasker" placeholder="Bulan Masa Kerja (0-11)" maxlength="2" onkeypress="return numbersonly1(this, event)"  value="<?php echo isset($isian->BBMASKER) ? $isian->BBMASKER : ""; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Gaji Pokok(RP)</label>
                        <div class="col-lg-7">
                            <input type="text" id="gapok" name="gapok" alt="int12" placeholder="Gaji Pokok" value="<?php echo isset($isian->GAPOK) ? $isian->GAPOK : ""; ?>" class="form-control">
                            
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

 <script src="<?php echo base_url(); ?>assets/js/meiomask.js"></script>
 <script type="text/javascript">

   
 function tandaPemisahTitik(b){
    var _minus = false;
    if (b<0) _minus = true;
    b = b.toString();
    b=b.replace(".","");
    b=b.replace("-","");
    c = "";
    panjang = b.length;
    j = 0;
    for (i = panjang; i > 0; i--){
         j = j + 1;
         if (((j % 3) == 1) && (j != 1)){
           c = b.substr(i-1,1) + "." + c;
         } else {
           c = b.substr(i-1,1) + c;
         }
    }
    if (_minus) c = "-" + c ;
    return c;
}

function numbersonly(ini, e){
    if (e.keyCode>=49){
        if(e.keyCode<=57){
        a = ini.value.toString().replace(".","");
        b = a.replace(/[^\d]/g,"");
        b = (b=="0")?String.fromCharCode(e.keyCode):b + String.fromCharCode(e.keyCode);
        ini.value = tandaPemisahTitik(b);
        return false;
        }
        else if(e.keyCode<=105){
            if(e.keyCode>=96){
                //e.keycode = e.keycode - 47;
                a = ini.value.toString().replace(".","");
                b = a.replace(/[^\d]/g,"");
                b = (b=="0")?String.fromCharCode(e.keyCode-48):b + String.fromCharCode(e.keyCode-48);
                ini.value = tandaPemisahTitik(b);
                //alert(e.keycode);
                return false;
                }
            else {return false;}
        }
        else {
            return false; }
    }else if (e.keyCode==48){
        a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);
        b = a.replace(/[^\d]/g,"");
        if (parseFloat(b)!=0){
            ini.value = tandaPemisahTitik(b);
            return false;
        } else {
            return false;
        }
    }else if (e.keyCode==95){
        a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
        b = a.replace(/[^\d]/g,"");
        if (parseFloat(b)!=0){
            ini.value = tandaPemisahTitik(b);
            return false;
        } else {
            return false;
        }
    }else if (e.keyCode==8 || e.keycode==46){
        a = ini.value.replace(".","");
        b = a.replace(/[^\d]/g,"");
        b = b.substr(0,b.length -1);
        if (tandaPemisahTitik(b)!=""){
            ini.value = tandaPemisahTitik(b);
        } else {
            ini.value = "";
        }
        
        return false;
    } else if (e.keyCode==9){
        return true;
    } else if (e.keyCode==17){
        return true;
    } else {
        //alert (e.keyCode);
        return false;
    }

}

function bersihPemisah(ini){
    a = ini.toString().replace(".","");
    //a = a.replace(".","");
    return a;
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


    function setGol(){
        kopang = $('#kopang').val();

        $.ajax({
            url: '<?php echo base_url("index.php/referensi/getGolByPangkat"); ?>',
            type: "post",
            data: {
                kopang: kopang
            },
            dataType: 'text',
            beforeSend: function() {
                $('.msg').html('<div><div class="sk-spinner sk-spinner-rotating-plane"></div></div>');
                $('.err').html("");
            },
            success: function(data) {
                $('#gol').val(data);
            },
            error: function(xhr) {
                $('.msg').html('');
                $('.err').html("<small>Terjadi kesalahan</small>");
            },
            complete: function() {

            }
        });
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
        jQuery(function($){
          
           $("#gapok").setMask();
          
        });   

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
                kopang: {
                    validators: {
                        notEmpty: {
                            message: 'Pangkat tidak boleh kosong'
                        }
                    }
                },gol: {
                    validators: {
                        notEmpty: {
                            message: 'Golongan tidak boleh kosong'
                        }
                    }
                },ttmasker: {
                    validators: {
                        notEmpty: {
                            message: 'Masa Kerja tidak boleh kosong'
                        }
                    }
                },bbmasker: {
                    validators: {
                        notEmpty: {
                            message: 's/d Masa Kerja tidak boleh kosong'
                        }
                    }
                },gapok: {
                    validators: {
                        notEmpty: {
                            message: 'Gaji Pokok tidak boleh kosong'
                        }
                    }
                }
            }
        });

        /*START CHOSEN*/
        var config = {
            '.chosen-kopang'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width:'300px'}
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }
        /*END CHOSEN*/
    });
    /*END SETTING VALIDASI*/
    

</script>