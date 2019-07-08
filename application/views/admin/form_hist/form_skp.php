
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

    /* Important part */
.modal-dialog{
    overflow-y: initial !important
}
</style>

<form id="defaultForm2" name="defaultForm2" method="post" class="form-horizontal"  action="javascript:save();" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	<h4 class="modal-title" id="myModalLabel">Form Riwayat Penilaian Prestasi Kerja PNS</h4>
    </div>
    <div class="modal-body" >
    	
            <div class="row">
                <!-- START SIDE 1 -->
                    
                    <div class="col-md-6">
                        <div class="form-group">
                		    <label class="col-sm-4 control-label">NRK</label>
                            <div class="input-group col-sm-7">
                            		<input type="text" id="nrk" name="nrk" placeholder="NRK" class="form-control" tabindex="-1" value="<?php echo isset($nrk) ? $nrk : '' ?>"  readOnly="true">
                            </div>
                        </div>
                    </div>
        			 
        		    <div class="col-md-6">
            			<div class="form-group pickerpicker" id="data_1">
                            <label class="col-sm-4 control-label">Tahun</label>
                            <?php if($action == 'update' || $action == 'view') { ?>
                        	<div class="input-group col-sm-7">
                                <span class="input-group-addon"  style="display:none"><i class="fa fa-calendar"></i></span><input type="text" id="tahun" name="tahun"  class="form-control" value="<?php echo isset($infoSKP->TAHUN) ? $infoSKP->TAHUN : '2017'; ?>" readonly>
                        	</div>
                            <?php } else { ?>
                            <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tahun" name="tahun" class="form-control" value="<?php echo $yrnw; ?>" readonly >
                            </div>

                            <?php } ?>
                        </div>
                    </div>      
            </div>
            
            <div class="row">        
                <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-sm-4 control-label">NRK/NIP Pejabat Penilai</label>
                            <div class="input-group col-sm-7">
                                <input type="text" id="nrkpp" name="nrkpp"  placeholder="NRK/NIP Pejabat Penilai" class="form-control"  value="<?php echo isset($infoSKP->NRK_PEJABAT_PENILAI) ? $infoSKP->NRK_PEJABAT_PENILAI : '' ?>" onkeyup="generateNamePP();" onload="generateNamePP();" onkeydown="return isNumber(event, this);" maxlength="18"/>
                                <input type="text" id="namapp" name="namapp" placeholder="Nama Pejabat" class="form-control"  value="<?php echo isset($infoSKP->NAMA_PEJABAT_PENILAI) ? $infoSKP->NAMA_PEJABAT_PENILAI : '' ?>"  readonly="true"/>
                                <input type="hidden" id="nrkpptemp" name="nrkpptemp"/>
                            </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-sm-4 control-label">NRK/NIP Atasan Pejabat Penilai</label>
                            <div class="input-group col-sm-7">
                                <input type="text" id="nrkapp" name="nrkapp"  placeholder="NRK/NIP Atasan Pejabat Penilai" class="form-control" maxlength="18" value="<?php echo isset($infoSKP->NRK_ATASAN_PEJABAT_PENILAI) ? $infoSKP->NRK_ATASAN_PEJABAT_PENILAI : '' ?>" onkeyup="generateNameAPP()" onload="generateNameAPP()" onkeydown="return isNumber(event, this);" maxlength="18">
                                <input type="text" id="namaapp" name="namaapp" placeholder="Nama Pejabat" class="form-control"  value="<?php echo isset($infoSKP->NAMA_ATASAN_PEJABAT_PENILAI) ? $infoSKP->NAMA_ATASAN_PEJABAT_PENILAI : '' ?>" readonly="true">
                                <input type="hidden" id="nrkapptemp" name="nrkapptemp">
                            </div>
                    </div>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            
            <div class="row">        
                <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-sm-6 control-label">Nilai Capaian SKP</label>
                            <div class="input-group col-sm-6">
                                <input type="text" id="input_skp" name="input_skp" placeholder="Nilai Capaian SKP" maxlength="5"  onkeydown="return isNumber(event, this)" class="form-control" value="<?php echo isset($infoSKP->INPUT_SKP) ? $infoSKP->INPUT_SKP : '' ?>" onkeyup="calc_skp()" >
                                
                            </div>
                           
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-sm-2 control-label">X 60%</label>
                            <label class="col-sm-4 control-label"> = </label>
                            <div class="input-group col-sm-5">
                                <input type="text" id="nilai_skp" name="nilai_skp" placeholder="Nilai SKP" maxlength="5"   class="form-control" value="<?php echo isset($infoSKP->NILAI_SKP) ? $infoSKP->NILAI_SKP : '' ?>"  readonly="true" >
                                
                            </div>
                    </div>
                </div>


            </div>
            <div class="hr-line-dashed"></div>
            
            <div class="row">
            <label class="col-sm-2 control-label">Perilaku Kerja</label>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-sm-6 control-label">1. Orientasi Pelayanan</label>
                            <div class="input-group col-sm-6">
                                <input type="text" id="pelayanan" name="pelayanan" placeholder="Nilai Orientasi Pelayanan" maxlength="5"  onkeydown="return isNumber(event, this);"  onkeyup="return generateKetSKP(this);"  class="form-control"  value="<?php echo isset($infoSKP->PELAYANAN) ? $infoSKP->PELAYANAN : '' ?>">
                                 <!-- onkeydown="return isNumber(event, this)"  onkeyup="return generateKetSKP(this);"   -->
                            </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group col-sm-5">
                            <input type="text" id="ketpelayanan" name="ketpelayanan"  class="form-control"   value="<?php echo isset($infoSKP->KETPELAYANAN) ? $infoSKP->KETPELAYANAN : '' ?>" readonly="true">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-sm-6 control-label">2. Integritas</label>
                            <div class="input-group col-sm-6">
                                <input type="text" id="integritas"  name="integritas" placeholder="Nilai Integritas" maxlength="5" onkeyup="return generateKetSKP(this)"  onkeydown="return isNumber(event, this)" class="form-control"  value="<?php echo isset($infoSKP->INTEGRITAS) ? $infoSKP->INTEGRITAS : '' ?>" >
                            </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group col-sm-5">
                            <input type="text" id="ketintegritas"  name="ketintegritas"  class="form-control"  value="<?php echo isset($infoSKP->KETINTEGRITAS) ? $infoSKP->KETINTEGRITAS : '' ?>" readonly="true">
                        </div>
                    </div>
                </div>
            </div>

               


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-sm-6 control-label">3. Komitmen</label>
                            <div class="input-group col-sm-6">
                                <input type="text" id="komitmen" name="komitmen" placeholder="Nilai Komitmen" maxlength="5"  onkeydown="return isNumber(event, this)" onkeyup="return generateKetSKP(this)" class="form-control" value="<?php echo isset($infoSKP->KOMITMEN) ? $infoSKP->KOMITMEN : '' ?>">
                            </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group col-sm-5">
                            <input type="text" id="ketkomitmen" name="ketkomitmen"  class="form-control"  value="<?php echo isset($infoSKP->KETKOMITMEN) ? $infoSKP->KETKOMITMEN : '' ?>" readonly="true">
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-sm-6 control-label">4. Disiplin</label>
                            <div class="input-group col-sm-6">
                                <input type="text" id="disiplin" name="disiplin" placeholder="Nilai Disiplin" maxlength="5"  onkeydown="return isNumber(event, this)" onkeyup="return generateKetSKP(this)" class="form-control" value="<?php echo isset($infoSKP->DISIPLIN) ? $infoSKP->DISIPLIN : '' ?>">
                            </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group col-sm-5">
                            <input type="text" id="ketdisiplin" name="ketdisiplin"  class="form-control"  value="<?php echo isset($infoSKP->KETDISIPLIN) ? $infoSKP->KETDISIPLIN: '' ?>" readonly="true">
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-sm-6 control-label">5. Kerja Sama</label>
                            <div class="input-group col-sm-6">
                                <input type="text" id="kerjasama" name="kerjasama" placeholder="Nilai Kerjasama" maxlength="5"  onkeydown="return isNumber(event, this)" onkeyup="return generateKetSKP(this)" class="form-control" value="<?php echo isset($infoSKP->KERJASAMA) ? $infoSKP->KERJASAMA : '' ?>">
                            </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group col-sm-5">
                            <input type="text" id="ketkerjasama" name="ketkerjasama"  class="form-control"  value="<?php echo isset($infoSKP->KETKERJASAMA) ? $infoSKP->KETKERJASAMA : '' ?>" readonly="true">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class="col-sm-6 control-label">6. Kepemimpinan</label>
                    <div class="form-group">
                            
                            <div class="input-group col-sm-6">
                                <input type="text" id="kepemimpinan" name="kepemimpinan" placeholder="Nilai Kepemimpinan" maxlength="5"  onkeydown=" resetinp();  return isNumber(event, this);" onkeyup="return generateKetSKP(this)" class="form-control" value="<?php echo isset($infoSKP->KEPEMIMPINAN) ? $infoSKP->KEPEMIMPINAN : '0' ?>">
                            </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group col-sm-5">
                            <input type="text" id="ketkepemimpinan" name="ketkepemimpinan"  class="form-control"  value="<?php echo isset($infoSKP->KETKEPEMIMPINAN) ? $infoSKP->KETKEPEMIMPINAN : '' ?>" readonly="true">
                        </div>
                    </div>
                </div>

               
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class="col-sm-6 control-label">JUMLAH</label>
                    <div class="form-group">
                            
                            <div class="input-group col-sm-6">
                                <input type="text" id="jumlah" name="jumlah" placeholder="JUMLAH" maxlength="6"   class="form-control"  value="<?php echo isset($infoSKP->JUMLAH) ? $infoSKP->JUMLAH : '' ?>" readonly="true">
                            </div>
                    </div>
                </div>

                
            </div>
        		
            <div class="row">
                <div class="col-md-6">
                    <label class="col-sm-6 control-label">Rata-rata</label>
                    <div class="form-group">
                            
                            <div class="input-group col-sm-6">
                                <input type="text" id="rata2" name="rata2" placeholder="Rata-rata" maxlength="6"  class="form-control"  value="<?php echo isset($infoSKP->RATA2) ? $infoSKP->RATA2 : '' ?>" readonly="true">

                            </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group col-sm-5">
                            <input type="text" id="ketrata2" name="ketrata2"  class="form-control"  value="<?php echo isset($infoSKP->KETRATA2) ? $infoSKP->KETRATA2: '' ?>" readonly="true">
                        </div>
                    </div>
                </div>

                
            </div>

              <div class="row">        
                <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-sm-4 control-label">Nilai Perilaku Kerja</label>
                            <div class="input-group col-sm-6">
                                <input type="text" id="npk" name="npk" placeholder="Nilai Perilaku Kerja" maxlength="5"   class="form-control"  value="<?php echo isset($infoSKP->RATA2) ? $infoSKP->RATA2 : '' ?>" readonly="true">
                                
                            </div>
                           
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                            <label class="col-sm-2 control-label">X 40%</label>
                            <label class="col-sm-4 control-label"> = </label>
                            <div class="input-group col-sm-5">
                                <input type="text" id="nilai_perilaku" name="nilai_perilaku" placeholder="Nilai Perilaku" maxlength="5"  class="form-control"  value="<?php echo isset($infoSKP->NILAI_PERILAKU) ? $infoSKP->NILAI_PERILAKU : '' ?>" readonly="true">
                                
                            </div>
                    </div>
                </div>


            </div>

            <div class="hr-line-dashed"></div>

             <div class="row">
                <div class="col-md-6">
                    <div class="col-sm-6">
                    </div>

                    <div class="col-sm-6">
                    <label class="col-sm-12 control-label"><b>NILAI PRESTASI KERJA</b></label>
                    </div>
                   
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-6 control-label"> = </label>
                        <div class="input-group col-sm-5">
                            
                            
                            <input type="text" id="nilai_prestasi" name="nilai_prestasi" placeholder="Nilai Prestasi" maxlength="5"  class="form-control"  value="<?php echo isset($infoSKP->NILAI_PRESTASI) ? $infoSKP->NILAI_PRESTASI : '' ?>" readonly="true">

                            <input type="text" id="ketprestasi" name="ketprestasi"  class="form-control"  value="<?php echo isset($infoSKP->KETPRESTASI) ? $infoSKP->KETPRESTASI : '' ?>" readonly="true">
                        </div>
                    </div>
                </div>
            </div>

            <?php if(isset($validator)) { ?>
            <div class="hr-line-dashed"></div>

            <div id="validator">
                <div class="row">
                    <div class="col-md-6">
                       <label class="col-sm-4 control-label">Validator</label>
                        <input type="text" id="validator" name="validator" placeholder="NRK" class="form-control" value="<?php echo isset($validator) ? $validator : '' ?>" readOnly="true">
                    </div>
                </div> 
                <br/>
                <div class="row">
                    <div class="col-md-6">
                        <label class="col-sm-4 control-label">Status SKP</label>
                            <div class="input-group col-sm-7">

                                <div class="i-checks inline"><label> <input type="radio" name="stat_validasi" <?php echo isset($infoSKP->STATUS_VALIDASI) ? ($infoSKP->STATUS_VALIDASI == '0' ? 'checked' : '') : ''; ?> value="0"> <i></i>Batal / Belum Validasi </label></div>&nbsp;&nbsp;&nbsp;
                                <div class="i-checks inline"><label> <input type="radio" name="stat_validasi" <?php echo isset($infoSKP->STATUS_VALIDASI) ? ($infoSKP->STATUS_VALIDASI == '1' ? 'checked' : '') : ''; ?> value="1"> <i></i> Sudah Validasi </label></div>
                            </div>
                    </div>
                </div>       
            </div>
            <?php } ?>			            			        	
               	
    </div>
    <div class="modal-footer">
    	<span class="pull-left">
            <label class="msg text-success"></label>
            <label class="err text-danger"></label>
        </span>
        <button type="button" class="btn btn-danger" data-dismiss="modal"  id="btnttp">Tutup</button>
        <?php if($action != 'view') { ?>
        <button type="submit" class="btn btn-primary" id="btnsv">Simpan</button>
        <?php } ?>
    </div>
</form>

<script type="text/javascript">

$(document).ready(function(){

/*	$("#pelayanan").on("keydown", function(e) {
    
        
        return isNumber(e,$(this).attr('id'));
    
	});
*/
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
            input_skp: {
                validators: {
                    notEmpty: {
                        message: 'Input SKP tidak boleh kosong'
                    }
                }
            },
            
            pelayanan: {
                validators: {
                    notEmpty: {
                        message: 'Pelayanan tidak boleh kosong'
                    }
                }
            },
            integritas: {
                validators: {
                    notEmpty: {
                        message: 'Integritas tidak boleh kosong'
                    }
                }
            },
            komitmen: {
                validators: {
                    notEmpty: {
                        message: 'Komitmen tidak boleh kosong'
                    }
                }
            },
            disiplin: {
                validators: {
                    notEmpty: {
                        message: 'Disiplin tidak boleh kosong'
                    }
                }
            },
            kerjasama: {
                validators: {
                    notEmpty: {
                        message: 'Kerja Sama tidak boleh kosong'
                    }
                }
            },
            kerjasama: {
                validators: {
                    notEmpty: {
                        message: 'Kerjasama tidak boleh kosong'
                    }
                }
            },
            kepemimpinan: {
                validators: {
                    notEmpty: {
                        message: 'Kepemimpinan tidak boleh kosong'
                    }
                }
            }
            //==============
        }
    });

    var now = new Date();

    var yearlast = now.getFullYear()-1;
    var yearlaststring = yearlast.toString();

    $('#data_1 .input-group.date').datepicker({
                minViewMode: 2,
                keyboardNavigation: false,

                forceParse: false,
                autoclose: true,
                todayHighlight: true,
                format: "yyyy",
                startDate:'2015',
                endDate: yearlaststring
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
    var nrkpp = $('#nrkpp').val();
    var namapp = $('#namapp').val();

    var nrkapp = $('#nrkapp').val();
    var namaapp = $('#namaapp').val();

    if(nrkpp != "" && namapp == "")
    {
        swal('Input NRK Pejabat Penilai Tidak Valid');
    }
    else if(nrkapp!= "" && namaapp == "")
    {
        swal('Input NRK Pejabat Atasan Penilai Tidak Valid');
    }
    else
    {

    var url;
    if(save_method == 'update')
    {
        url = "<?php echo site_url('home/ajax_update_skp')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_skp')?>";
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
                $('#tbl-grid').DataTable().ajax.reload();

            }
            else if(data.response == 'WARNING')
            {
            	$('.msg').html('');
                $('.err').html("<small>Data gagal disimpan, silahkan coba kembali.</small>");
            	swal({type:"warning",title:"DATA GAGAL DISIMPAN", text:"TAHUN SUDAH DIGUNAKAN, MOHON PERIKSA KEMBALI RIWAYAT SKP"});
            }	
            else{
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
}

function generateNamePP()
{
    var nrkpp = $('#nrkpp').val();
    
    var stringnrkpp = nrkpp.length;

    if(stringnrkpp == '6')
    {
        url = "<?php echo site_url('riwayat/ajax_generatenamaPP')?>";

         $.ajax({
            url : url,
            type: "POST",
            data: {nrkpp:nrkpp},
            dataType: "JSON",
           
            success: function(data)
            {

                 $('#namapp').val(data);
                 $('#nrkpptemp').val(nrkpp);
             
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Terjadi Kesalahan');
            },
            complete: function() {

            }
        });
    }
    else if(stringnrkpp== '9' || stringnrkpp == '18')
    {
        url = "<?php echo site_url('riwayat/ajax_generatenamaPPnip')?>";

         $.ajax({
            url : url,
            type: "POST",
            data: {nrkpp:nrkpp},
            dataType: "JSON",
           
            success: function(data)
            {

                 $('#namapp').val(data.NAMA);
                 $('#nrkpptemp').val(data.NRK);
             
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Terjadi Kesalahan');
            },
            complete: function() {

            }
        });
    }
    else
    {
        $('#namapp').val('');
        return false;
    }

}

function generateNameAPP()
{
    var nrkapp = $('#nrkapp').val();
    
    var stringnrkpp = nrkapp.length;

    if(stringnrkpp == '6')
    {
        url = "<?php echo site_url('riwayat/ajax_generatenamaPP')?>";

         $.ajax({
            url : url,
            type: "POST",
            data: {nrkpp:nrkapp},
            dataType: "JSON",
           
            success: function(data)
            {

                $('#namaapp').val(data);
                $('#nrkapptemp').val(nrkapp);
             
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Terjadi Kesalahan');
            }
        });
    }
    else if(stringnrkpp== '9' || stringnrkpp == '18')
    {
        url = "<?php echo site_url('riwayat/ajax_generatenamaPPnip')?>";

         $.ajax({
            url : url,
            type: "POST",
            data: {nrkpp:nrkapp},
            dataType: "JSON",
           
            success: function(data)
            {

                 $('#namaapp').val(data.NAMA);
                 $('#nrkapptemp').val(data.NRK);
             
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Terjadi Kesalahan');
            },
            complete: function() {

            }
        });
    }
    else
    {
        $('#namaapp').val('');
        return false;
    }

}

function calc_skp()
{
    var inp = $('#input_skp').val();
    var rs;
    var nol='0';
    if(inp.charAt(0) == '.')
    {
      //  rs=nol.concat(inp);
        $('#input_skp').val('0.');

    }
    else
    {
        rs = inp;
        if(rs>100)
        {
            $('#input_skp').val('100');
            rs=100;
        }
        else if(rs<0)
        {
            $('#input_skp').val('0');
            rs=0;
        }
        else
        {
            rs = rs;
        }
        var cal = Number(rs) * 0.6;
        var caldc = cal.toFixed(2);
        $('#nilai_skp').val(caldc);
    }
    //alert(rs);
    
}

function isNumber(evt, element) {
	
    var charCode = (evt.which) ? evt.which : evt.keyCode;

    if(charCode == 9)
    {
        
        if(element.id == "nrkpp")
        {
              document.getElementById("nrkapp").focus();
              return false;
        }
         
        if(element.id == "nrkapp")
        {
              document.getElementById("input_skp").focus();
              return false;
        }
        else if(element.id == "input_skp")
        {
              document.getElementById("pelayanan").focus();
              return false;
        }
    	else if(element.id == "pelayanan")
    	{
    		  document.getElementById("integritas").focus();
              return false;
    	}
    	else if(element.id == "integritas")
    	{
    		  document.getElementById("komitmen").focus();
              return false;
    	}
    	else if(element.id == "komitmen")
    	{
    		  document.getElementById("disiplin").focus();
              return false;
    	}
    	else if(element.id == "disiplin")
    	{
    		  document.getElementById("kerjasama").focus();
              return false;
    	}
    	else if(element.id == "kerjasama")
    	{
    		  document.getElementById("kepemimpinan").focus();
              return false;
    	}
    	else if(element.id == "kepemimpinan")
    	{
    		  document.getElementById("btnttp").focus();
              return false;
    	}
    }
    else
    {
    	if ((charCode != 190 || $(element).val().indexOf('.') != -1)  // “.” CHECK DOT, AND ONLY ONE.
            && (charCode != 110 || $(element).val().indexOf('.') != -1)  // “.” CHECK DOT, AND ONLY ONE.
            && ((charCode < 48 && charCode != 8)
                    || (charCode > 57 && charCode < 96)
                    || charCode > 105))
	    {    return false;}
	    else
	    {
	        return true;    
	    }	
    }

    
    
}



function resetinp()
{
	var valx6  = $('#kepemimpinan').val();
	
	if(valx6.length == 1)
	{
		if(valx6 == 0)
		{
			$('#kepemimpinan').val('0');
            $('#ketkepemimpinan').val('');
		}
	}

	
}



function generateKetSKP(element)
{
 	
    var dd =element.id;

    var inpelement = $('#'+dd).val();
    //var ketinpelement = $('#ket'+dd).val();

    
      url = "<?php echo site_url('riwayat/ajax_getKetSKP')?>";

    if(inpelement !='')
    {
        if(inpelement>100)
        {
            inpelement = 100;
             $('#'+dd).val('100');
        }
        else if(inpelement<0)
        {
            inpelement = 0;
             $('#'+dd).val('0')
        }
        else
        {
            inpelement = inpelement;
        }

        $.ajax({
            url : url,
            type: "POST",
            data: {x:inpelement},
            dataType: "JSON",
           
            success: function(data)
            {
                if(dd=="kepemimpinan")
                {
                    if(inpelement == 0)
                    {
                        $('#ket'+dd).val('');        
                    }
                    else
                    {
                        $('#ket'+dd).val(data);        
                    }
                }
                else
                {
                    $('#ket'+dd).val(data);
                }
                
                 
             
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Terjadi Kesalahan');
            },
            complete: function() {

            }
        });
    }
    else
    {
        $('#ket'+dd).val('');
    }
         
    var x1 = $('#pelayanan').val();
    var x2 = $('#integritas').val();
    var x3 = $('#komitmen').val();
    var x4 = $('#disiplin').val();
    var x5 = $('#kerjasama').val();
    var x6 = $('#kepemimpinan').val();
    var jumlah=0;
    var rata2=0;

    if(x6 == 0)
    {
        if(x1!= '' && x2!='' && x3!='' && x4!='' && x5!='')
        {
            jumlah = Number(x1) + Number(x2) + Number(x3) + Number(x4) + Number(x5);
            jumlahnf = jumlah.toFixed(2);
            $('#jumlah').val(jumlahnf);

            rata2nf = jumlah/5;
            rata2 = rata2nf.toFixed(2);

            $('#rata2').val(rata2);
            $('#npk').val(rata2);
        }
        else
        {
            $('#jumlah').val('');
            $('#rata2').val('');
            $('#npk').val('');            
        }
        
    }
    else if(x6 > 0)
    {
        if(x1!= '' && x2!='' && x3!='' && x4!='' && x5!='')
        {
            jumlah = Number(x1) + Number(x2) + Number(x3) + Number(x4) + Number(x5)+ Number(x6);
            jumlahnf = jumlah.toFixed(2);
            $('#jumlah').val(jumlahnf);

            rata2nf = jumlah/6;
            rata2 = rata2nf.toFixed(2);

            $('#rata2').val(rata2);
            $('#npk').val(rata2);
        }
        else
        {
            $('#jumlah').val('');
            $('#rata2').val('');
            $('#npk').val('');            
        }
    }

    var nilai_perilaku_nf = rata2*0.4;
    var nilai_perilaku = nilai_perilaku_nf.toFixed(2);

    $('#nilai_perilaku').val(nilai_perilaku);


    var nil_skp = $('#nilai_skp').val();

    var nilai_prestasi = Number(nil_skp) + Number(nilai_perilaku);
    
    var np = nilai_prestasi.toFixed(2);

    $('#nilai_prestasi').val(np);
    ketprestasi(nilai_prestasi);

}

function ketprestasi(nil)
{
    url = "<?php echo site_url('riwayat/ajax_getKetSKP')?>";

    if(nil>0 && nil<100)
    {
        $.ajax({
            url : url,
            type: "POST",
            data: {x:nil},
            dataType: "JSON",
           
            success: function(data)
            {
                $('#ketprestasi').val(data);
                 
             
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Terjadi Kesalahan');
            },
            complete: function() {

            }
        });
    }
    
}


</script>