
<style type="text/css">
    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
</style>

<form id="defaultForm2" name="defaultForm2" method="post" class="form-horizontal"  action="javascript:save();" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	<h4 class="modal-title" id="myModalLabel">Form Riwayat Tunda Absensi</h4>
    </div>
    <div class="modal-body">
    	
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-6">
                    <div class="form-group">
        				<label class="col-sm-4 control-label">NRK</label>
                    	<div class="input-group col-sm-7">
                    		<input type="text" id="nrk" name="nrk" placeholder="NRK" class="form-control" value="<?php echo isset($nrk) ? $nrk : '' ?>" readOnly="true">
                    	</div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group" id="data_0">
                        <label class="col-sm-4 control-label">Bulan Tahun</label>
                        <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="thbl" name="thbl" placeholder="Bulan Tahun" value="<?php echo isset($bulantahun) ? date('M Y', strtotime($bulantahun)) :  date('M Y'); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
        			 
        		
        			<div class="form-group">
                        <label class="col-sm-4 control-label">Nip18</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="nip18" name="nip18" placeholder="Nip18" value="<?php echo isset($infoUser->NIP18) ? $infoUser->NIP18 : ""; ?>" class="form-control" readonly="true">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                     
                
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nama</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="nama_abs" name="nama_abs" placeholder="Nama" value="<?php echo isset($infoUser->NAMA_ABS) ? $infoUser->NAMA_ABS : ""; ?>" class="form-control" readonly="true">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                     
                
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Klogad</label>
                        <div class="input-group col-sm-7">                                                         
                            <input type="text" id="klogad" name="klogad" placeholder="Klogad" value="<?php echo isset($infoUser->KLOGAD) ? $infoUser->KLOGAD : ""; ?>" class="form-control" readonly="true">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                     
                
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nama Klogad</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="naklogad" name="naklogad" placeholder="Nama Klogad" value="<?php echo isset($infoUser->NAKLOGAD) ? $infoUser->NAKLOGAD : ""; ?>" class="form-control" readonly="true">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
       
                     
                
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nama Golongan</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="nagol" name="nagol" placeholder="Nama Golongan" value="<?php echo isset($infoUser->NAGOL) ? $infoUser->NAGOL : ""; ?>" class="form-control">
                             <!-- <select class="form-control chosen-nagol" name="nagol" id="nagol" tabindex="2" data-placeholder="Pilih Nama Golongan...">
                                <option value=""></option>
                                <?php //echo $listGolongan; ?> 
                            </select> -->
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>                                    

                    <div class="form-group"> 
                        <label class="col-sm-2"></label>
                        <div class="col-sm-10">
                            <div class="row">                            

                                <div class="form-group col-sm-4">
                                    <label for="alfa">Alfa</label>
                                    <input type="text" id="alfa" name="alfa" placeholder="Alfa" maxlength="2" onkeypress="return numbersonly1(this, event)" value="<?php echo isset($infoUser->ALFA) ? $infoUser->ALFA : ""; ?>" class="form-control">                        
                                </div>
                                 
                                <div class="col-sm-1"></div>
                                
                                <div class="form-group col-sm-4">
                                    <label for="izin">Izin</label>                        
                                    <input type="text" id="izin" name="izin" placeholder="Izin" maxlength="2" onkeypress="return numbersonly1(this, event)" value="<?php echo isset($infoUser->IZIN) ? $infoUser->IZIN: ""; ?>" class="form-control">                        
                                </div>
                                 
                                <div class="col-sm-1"></div>
                            
                                <div class="form-group col-sm-4">
                                    <label for="sakit">Sakit</label>                        
                                    <input type="text" id="sakit" name="sakit" placeholder="Sakit" maxlength="2" onkeypress="return numbersonly1(this, event)" value="<?php echo isset($infoUser->SAKIT) ? $infoUser->SAKIT : ""; ?>" class="form-control">                        
                                </div>
                                
                            </div> 
                        </div>  
                    </div>
                    

                </div>
                <!-- END SIDE 1 -->
                <!-- START SIDE 2 -->
                <div class="col-md-6">                                      

                    <div class="form-group"> 
                        <label class="col-sm-2"></label>
                        <div class="col-sm-10">
                            <div class="row">                            

                                <div class="form-group col-sm-5">
                                    <label for="jamterlambat">Jam Terlambat</label>
                                    <input type="text" id="jamterlambat" name="jamterlambat" placeholder="Terlambat" onkeypress="return numbersonly1(this, event)" maxlength="6" value="<?php echo isset($infoUser->JAMTERLAMBAT) ? $infoUser->JAMTERLAMBAT : ""; ?>" class="form-control">
                                </div>
                                 
                                <div class="col-sm-1"></div>
                                
                                <div class="form-group col-sm-6">
                                    <label for="jampulangcepat">Jam Pulang Cepat</label>                        
                                    <input type="text" id="jampulangcepat" name="jampulangcepat" placeholder="Pulang Cepat" onkeypress="return numbersonly1(this, event)" maxlength="6" value="<?php echo isset($infoUser->JAMPULANGCEPAT) ? $infoUser->JAMPULANGCEPAT : ""; ?>" class="form-control">
                                </div>
                                 
                                <div class="col-sm-1"></div>                            
                                
                            </div> 
                        </div>  
                    </div>                                        

                    <div class="form-group"> 
                        <label class="col-sm-2"></label>
                        <div class="col-sm-10">
                            <div class="row">                            

                                <div class="form-group col-sm-4">
                                    <label for="cuti">Cuti</label>
                                    <input type="text" id="cuti" name="cuti" placeholder="Cuti" maxlength="2" onkeypress="return numbersonly1(this, event)" value="<?php echo isset($infoUser->CUTI) ? $infoUser->CUTI : ""; ?>" class="form-control">
                                </div>
                                 
                                <div class="col-sm-1"></div>

                                <div class="form-group col-sm-4">
                                    <label for="jamterlambat">Cuti A. Penting</label>
                                    <input type="text" id="cutiapenting" name="cutiapenting" placeholder="Cuti A. Penting" maxlength="2" onkeypress="return numbersonly1(this, event)" value="<?php echo isset($infoUser->CUTIAPENTING) ? $infoUser->CUTIAPENTING : ""; ?>" class="form-control">
                                </div>
                                 
                                <div class="col-sm-1"></div>
                                
                                <div class="form-group col-sm-4">
                                    <label for="jampulangcepat">Cuti Besar</label>                        
                                    <input type="text" id="cutibesar" name="cutibesar" placeholder="Cuti Besar" maxlength="2" onkeypress="return numbersonly1(this, event)" value="<?php echo isset($infoUser->CUTIBESAR) ? $infoUser->CUTIBESAR : ""; ?>" class="form-control">
                                </div>
                                 
                                <div class="col-sm-1"></div>                            
                                
                            </div> 
                        </div>  
                    </div>
                    

                    <div class="form-group"> 
                        <label class="col-sm-2"></label>
                        <div class="col-sm-10">
                            <div class="row">                            

                                <div class="form-group col-sm-5">
                                    <label for="jamterlambat">Cuti Sakit</label>
                                    <input type="text" id="cutisakit" name="cutisakit" placeholder="Cuti Sakit" maxlength="2" onkeypress="return numbersonly1(this, event)" value="<?php echo isset($infoUser->CUTISAKIT) ? $infoUser->CUTISAKIT : ""; ?>" class="form-control">
                                </div>
                                 
                                <div class="col-sm-1"></div>
                                
                                <div class="form-group col-sm-6">
                                    <label for="jampulangcepat">Cuti Bersalin</label>                        
                                    <input type="text" id="cutibersalin" name="cutibersalin" placeholder="Cuti Bersalin" maxlength="2" onkeypress="return numbersonly1(this, event)" value="<?php echo isset($infoUser->CUTIBERSALIN) ? $infoUser->CUTIBERSALIN : ""; ?>" class="form-control">
                                </div>
                                 
                                <div class="col-sm-1"></div>                            
                                
                            </div> 
                        </div>  
                    </div>

                    <div class="hr-line-dashed"></div>                              			                                                     

                     <div class="form-group">
                        <label class="col-sm-4 control-label">Kinerja</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="kinerja" name="kinerja" placeholder="Kinerja" maxlength="5" onkeypress="return numbersonly1(this, event)" value="<?php echo isset($infoUser->KINERJA) ? $infoUser->KINERJA : ""; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                     <div class="form-group">
                        <label class="col-sm-4 control-label">Periode</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="periode" name="periode" placeholder="Periode" maxlength="2" onkeypress="return numbersonly1(this, event)" value="<?php echo isset($infoUser->PERIODE) ? $infoUser->PERIODE : ""; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group" id="data_1">
                        <label class="col-sm-4 control-label">Tgl. Proses</label>
                        <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="d_proses" name="d_proses" placeholder="D Proses" value="<?php echo isset($infoUser->D_PROSES) ? date('d-m-Y', strtotime($infoUser->D_PROSES)) : ""; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Status Proses</label>
                        <div class="input-group col-sm-7">
                            <input type="text" id="e_proses" name="e_proses" placeholder="E Proses" maxlength="60" value="<?php echo isset($infoUser->E_PROSES) ? $infoUser->E_PROSES : ""; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    
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

    $('#defaultForm2').bootstrapValidator({
        live: 'enabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            //==============
            nrk: {
                validators: {
                    notEmpty: {
                        message: 'NRK tidak boleh kosong'
                    }
                }
            },
            thbl: {
                validators: {
                    notEmpty: {
                        message: 'Bulan Tahun tidak boleh kosong'
                    }
                }
            },
            nip18: {
                validators: {
                    notEmpty: {
                        message: 'Nip18 tidak boleh kosong'
                    }
                }
            },
            klogad: {
                validators: {
                    notEmpty: {
                        message: 'Klogad tidak boleh kosong'
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
        format: "dd-mm-yyyy"
    });

    $('#data_0 .input-group.date').datepicker({
        todayBtn: "linked",
        changeyear: false,
        minViewMode: 1,
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        todayHighlight: true,
        format: 'M yyyy'
    });


    /*START CHOSEN*/
    var config = {
      '.chosen-klogad'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"}
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
        url = "<?php echo site_url('home/ajax_update_absensi')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_absensi')?>";
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