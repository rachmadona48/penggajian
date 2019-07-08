
<style type="text/css">
    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
    .pickerpicker .form-control-feedback {
        right: 100px !important;      
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

<form id="defaultForm2" name="defaultForm2" method="post" class="form-horizontal"  action="javascript:save();" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Form Riwayat Lp2p</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-6">
                   <div class="form-group pickerpicker" id="data_6">
                        <label class="col-sm-4 control-label">Tahun Pajak</label>
                        <?php if($action == 'update'){ ?>
                            <div class="input-group col-sm-6 date">
                                <span class="input-group-addon" style="display:none"><i class="fa fa-calendar"></i></span><input type="text" id="thpajak" name="thpajak" placeholder="Tahun Pajak" value="<?php echo isset($infoLP2P->THPAJAK) ? $infoLP2P->THPAJAK : ""; ?>" class="form-control" readonly="true">
                            </div>
                        <?php } else { ?>
                            <div class="input-group col-sm-6 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="thpajak" name="thpajak" placeholder="Tahun Pajak" value="<?php echo isset($infoLP2P->THPAJAK) ? $infoLP2P->THPAJAK : ""; ?>" class="form-control">
                            </div>
                        <?php } ?>
                    </div>   

    	            <div class="form-group pickerpicker">
    	              <label class="col-sm-4 control-label">NRK</label>
    	              <div class="input-group col-sm-6">
    	                      <input type="text" class="form-control" name="nrk" id="nrk"  value="<?php echo isset($nrk) ? $nrk : ''; ?>" readonly="true">  
                    </div>
    	            </div>

    	            <div class="form-group pickerpicker">
    	              <label class="col-sm-4 control-label">NIP</label>
    	              <div class="input-group col-sm-6">
                         <?php if($action == 'update'){ ?>
    	                       <input type="text" id="nip" name="nip" class="form-control" value="<?php echo isset($infoLP2P->NIP) ? $infoLP2P->NIP : ''; ?>" readonly="true">
    	                   <?php } else { ?>
                             <input type="text" id="nip" name="nip" placeholder="NIP" minlength="9" maxlength="9" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoLP2P->NIP) ? $infoLP2P->NIP : ''; ?>">
                         <?php } ?>
                    </div>
    	            </div>

    	            <div class="form-group pickerpicker">
    	              <label class="col-sm-4 control-label">NIP18</label>
    	              <div class="input-group col-sm-6">
                      <?php if($action == 'update'){ ?>
    	                    <input type="text" id="nip18" name="nip18" class="form-control" value="<?php echo isset($infoLP2P->NIP18) ? $infoLP2P->NIP18 : ''; ?>" readonly="true">
    	                <?php } else { ?>
                          <input type="text" id="nip18" name="nip18" placeholder="NIP18" minlength="18" maxlength="18" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoLP2P->NIP18) ? $infoLP2P->NIP18 : ''; ?>" >
                      <?php } ?>
                    </div>
    	            </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Nama</label>
                      <div class="input-group col-sm-6">
                        <?php if($action == 'update'){ ?>
                            <input type="text" id="nama" name="nama" class="form-control" value="<?php echo isset($infoLP2P->NAMA) ? $infoLP2P->NAMA : ''; ?>" readonly="true">
                         <?php } else { ?>
                         <input type="text" id="nama" name="nama" placeholder="NAMA" maxlength="25" class="form-control" value="<?php echo isset($infoLP2P->NAMA) ? $infoLP2P->NAMA : ''; ?>" >
                         <?php } ?>
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Kode Lokasi</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="kolok" name="kolok" placeholder="Kode Lokasi"  minlength="9" maxlength="9" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoLP2P->KOLOK) ? $infoLP2P->KOLOK : ''; ?>">
                      </div>
                    </div>

                    <!--<div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Wilayah</label>
                      <div class="input-group col-sm-7">                               
                         <select class="chosen-wilayah" name="kowil" id="kowil" tabindex="2" data-placeholder="Pilih Wilayah...">
                            <option value=""></option>
                            <?php //echo $listWilayah; ?>
                          </select>
                      </div>
                    </div>-->

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Nama Lokasi</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nalok" name="nalok" placeholder="Nama Lokasi" maxlength="50" class="form-control" value="<?php echo isset($infoLP2P->NALOK) ? $infoLP2P->NALOK : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Golongan</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="gol" name="gol" placeholder="Golongan"  class="form-control" value="<?php echo isset($infoLP2P->GOL) ? $infoLP2P->GOL : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Ruang</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="ruang" name="ruang" placeholder="RUANG" maxlength="5"  class="form-control" value="<?php echo isset($infoLP2P->RUANG) ? $infoLP2P->RUANG : ''; ?>">
                      </div>
                    </div>

    	            <div class="form-group pickerpicker" id="data_1">
                        <label class="col-sm-4 control-label">TMT Pangkat</label>
                         <div class="input-group col-sm-6 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmtpangkat" name="tmtpangkat" placeholder="TMT Pangkat" value="<?php echo isset($infoLP2P->TMTPANGKAT) ? date('d-m-Y', strtotime($infoLP2P->TMTPANGKAT)) : ""; ?>" class="form-control">
                          </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Nama Jabatan</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="najab" name="najab" placeholder="Nama Jabatan" maxlength="30"  class="form-control" value="<?php echo isset($infoLP2P->NAJAB) ? $infoLP2P->NAJAB : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker" id="data_2">
                        <label class="col-sm-4 control-label">TMT Eselon</label>
                         <div class="input-group col-sm-6 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmteselon" name="tmteselon" placeholder="TMT Eselon" value="<?php echo isset($infoLP2P->TMTESELON) ? date('d-m-Y', strtotime($infoLP2P->TMTESELON)) : ""; ?>" class="form-control">
                          </div>
                    </div>

                    <div class="form-group pickerpicker" id="data_3">
                        <label class="col-sm-4 control-label">Tanggal Lahir</label>
                          <?php if($action == 'update'){ ?>
                              <div class="input-group col-sm-6 date">
                                <span class="input-group-addon" style="display:none"><i class="fa fa-calendar"></i></span><input type="text" id="talhir" name="talhir" placeholder="Tanggal Lahir" value="<?php echo isset($infoLP2P->TALHIR) ? date('d-m-Y', strtotime($infoLP2P->TALHIR)) : ""; ?>" class="form-control" readonly="true">
                              </div>
                          <?php } else { ?>
                              <div class="input-group col-sm-6 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="talhir" name="talhir" placeholder="Tanggal Lahir" value="<?php echo isset($infoLP2P->TALHIR) ? date('d-m-Y', strtotime($infoLP2P->TALHIR)) : ""; ?>" class="form-control">
                              </div>
                          <?php }?>    
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Tempat Lahir</label>
                      <?php if($action == 'update'){ ?>
                          <div class="input-group col-sm-6">
                            <input type="text" id="pathir" name="pathir" class="form-control" value="<?php echo isset($infoLP2P->PATHIR) ? $infoLP2P->PATHIR : ''; ?>" readonly="true">
                          </div>
                      <?php } else { ?> 
                            <div class="input-group col-sm-6">
                              <input type="text" id="pathir" name="pathir" placeholder="Tempat Lahir" maxlength="20"  class="form-control" value="<?php echo isset($infoLP2P->PATHIR) ? $infoLP2P->PATHIR : ''; ?>">
                            </div>
                      <?php }?>    
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Alamat</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="alamat" name="alamat" placeholder="Alamat" maxlength="25"  class="form-control" value="<?php echo isset($infoLP2P->ALAMAT) ? $infoLP2P->ALAMAT : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">RT</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="rtalamat" name="rtalamat" placeholder="RT" maxlength="2" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoLP2P->RTALAMAT) ? $infoLP2P->RTALAMAT : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">RW</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="rwalamat" name="rwalamat" placeholder="RW" maxlength="2" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoLP2P->RWALAMAT) ? $infoLP2P->RWALAMAT : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Kelurahan</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nakel" name="nakel" placeholder="Kelurahan" maxlength="25" class="form-control" value="<?php echo isset($infoLP2P->KELURAHAN) ? $infoLP2P->KELURAHAN : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Kecamatan</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="nacam" name="nacam" placeholder="Kecamatan" maxlength="20" class="form-control" value="<?php echo isset($infoLP2P->KECAMATAN) ? $infoLP2P->KECAMATAN : ''; ?>">
                      </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Jenis Kelamin</label>
                            <div class="input-group col-sm-6">
                                <select class="form-control" name="jenkel" id="jenkel">
                                    <option></option>
                                    <option value="L" selected>Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                    </div>

                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Status Kawin</label>
                            <div class="input-group col-sm-6">
                                <input type="text" id="stawin" name="stawin" placeholder="Status Kawin" maxlength="15" class="form-control" value="<?php echo isset($infoLP2P->STAWIN) ? $infoLP2P->STAWIN : ''; ?>">
                            </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Namisu</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="namisu" name="namisu" placeholder="Namisu" maxlength="25" class="form-control" value="<?php echo isset($infoLP2P->NAMISU) ? $infoLP2P->NAMISU : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Pekerjaan</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" maxlength="15"  class="form-control" value="<?php echo isset($infoLP2P->PEKERJAAN) ? $infoLP2P->PEKERJAAN : ''; ?>">
                      </div>
                    </div>

    	            <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Juan</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="juan" name="juan" placeholder="Juan" maxlength="1" onkeypress="return numbersonly1(this, event)"  class="form-control" value="<?php echo isset($infoLP2P->JUAN) ? $infoLP2P->JUAN : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Jiwa</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="jiwa" name="jiwa" placeholder="Jiwa" maxlength="1" onkeypress="return numbersonly1(this, event)"  class="form-control" value="<?php echo isset($infoLP2P->JIWA) ? $infoLP2P->JIWA : ''; ?>">
                      </div>
                    </div>
    	            
    	            <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Kode Wewenang</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="kdwewenang" name="kdwewenang" placeholder="Kode Wewenang" maxlength="1" class="form-control" value="<?php echo isset($infoLP2P->KDWEWENANG) ? $infoLP2P->KDWEWENANG : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">No. Form</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="noform" name="noform" placeholder="No Form" minlength="6" maxlength="6" onkeypress="return numbersonly1(this, event)"  class="form-control" value="<?php echo isset($infoLP2P->NOFORM) ? $infoLP2P->NOFORM : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Kode 2</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="kode2" name="kode2" placeholder="Kode 2" maxlength="1" class="form-control" value="<?php echo isset($infoLP2P->KODE2) ? $infoLP2P->KODE2 : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Kode Jabatan</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="kojab" name="kojab" placeholder="Kode Jabatan" minlength="6" maxlength="6" onkeypress="return numbersonly1(this, event)" class="form-control" value="<?php echo isset($infoLP2P->KOJAB) ? $infoLP2P->KOJAB : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Kode Jabatan Fungsional</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="kojabf" name="kojabf" placeholder="Kode Jabatan Fungsional" minlength="6" onkeypress="return numbersonly1(this, event)" maxlength="6" class="form-control" value="<?php echo isset($infoLP2P->KOJABF) ? $infoLP2P->KOJABF : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Kode</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="kd" name="kd" placeholder="Kode" maxlength="1" class="form-control" value="<?php echo isset($infoLP2P->KD) ? $infoLP2P->KD : ''; ?>">
                      </div>
                    </div>
                    
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Eselon</label>
                        <div class="input-group col-sm-4">                      
                            <select class="form-control chosen-eselon" name="eselon" id="eselon" data-placeholder="Pilih Eselon...">
                                <option></option>
                                <?php echo $listEselon; ?> 
                            </select>
                        </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">SPMU</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="spmu" name="spmu" placeholder="SPMU" maxlength="4" class="form-control" value="<?php echo isset($infoLP2P->SPMU) ? $infoLP2P->SPMU : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Kode Lokasi Gaji</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="klogad" name="klogad" placeholder="Kode Lokasi Gaji" maxlength="9" class="form-control" value="<?php echo isset($infoLP2P->KLOGAD) ? $infoLP2P->KLOGAD : ''; ?>">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Koduk</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="koduk" name="koduk" placeholder="Koduk" maxlength="4" class="form-control" value="<?php echo isset($infoLP2P->KODUK) ? $infoLP2P->KODUK : ''; ?>">
                      </div>
                    </div>

                     <div class="form-group pickerpicker" id="data_7">
                        <label class="col-sm-4 control-label">Tahun Lapor</label>
                        <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="thlapor" name="thlapor" placeholder="Tahun Lapor" value="<?php echo isset($infoLP2P->THLAPOR) ? $infoLP2P->THLAPOR : ""; ?>" class="form-control">
                        </div>
                    </div>   

                    <div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Pejabat</label>
                      <div class="input-group col-sm-6">
                         <input type="text" id="pejabat" name="pejabat" placeholder="Pejabat" maxlength="1" class="form-control" onkeypress="return numbersonly1(this, event)" value="<?php echo isset($infoLP2P->PEJABAT) ? $infoLP2P->PEJABAT : ''; ?>">
                      </div>
                    </div>
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
    </div>
</form>

<script type="text/javascript">

$(document).ready(function(){

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
            
            tmtpangkat: {
                validators: {
                   
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            },
            nrk: {
                validators: {
                    notEmpty: {
                        message: 'Alamat tidak boleh kosong'
                    }
                }
            },
            tmteselon: {
                validators: {
                   
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            },
            talhir: {
                validators: {
                   
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
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
    }).on('changeDate', function(e) {
        $('#defaultForm2').bootstrapValidator('revalidateField', 'tmtpangkat');
        });

    $('#data_2 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy"
    }).on('changeDate', function(e) {
        $('#defaultForm2').bootstrapValidator('revalidateField', 'tmteselon');
        });

    $('#data_3 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy",
        endDate: new Date()
    }).on('changeDate', function(e) {
        $('#defaultForm2').bootstrapValidator('revalidateField', 'talhir');
        });

    $('#data_6 .input-group.date').datepicker({
        format: 'yyyy',
        viewMode: 'years',
        minViewMode: 'years'
    }); 

    $('#data_7 .input-group.date').datepicker({
        format: 'yyyy',
        viewMode: 'years',
        minViewMode: 'years'
    }); 

    /*START CHOSEN*/
    var config = {
      '.chosen-stawin'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
      '.chosen-eselon'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"}
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
        url = "<?php echo site_url('home/ajax_update_lp2p')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_lp2p')?>";
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