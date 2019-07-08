
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

    .has-success .chosen-container{
   border: 1px solid #1ab394;
    }
 
  .has-error .chosen-container{
   border: 1px solid #ed5565;
    } 
</style>

<form id="defaultForm2" name="defaultForm2" method="post" class="form-horizontal"  action="javascript:save();" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Form Riwayat Tulisan</h4>
      </div>
      <div class="modal-body">
          
              <div class="row">
                  <!-- START SIDE 1 -->
                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="col-sm-4 control-label">NRK</label>
                          <div class="col-sm-7">
                              <input type="text" id="nrk" name="nrk" placeholder="NRK" class="form-control" value="<?php echo isset($nrk) ? $nrk : '' ?>" readOnly="true">
                          </div>
                      </div>
                      
                      <div class="hr-line-dashed"></div>

                  
                      <div class="form-group pickerpicker" id="data_1">
                        <label class="col-sm-4 control-label">Tgl Publik</label>
                        <?php if($action == 'update'){ ?>
                            <div class="col-sm-7 date">
                                <span class="input-group-addon" style="display: none"><i class="fa fa-calendar"></i></span><input type="text" id="tgpublik" name="tgpublik" placeholder="Tg. Publik" value="<?php echo isset($infoTulisan->TGPUBLIK) ? date('d-m-Y', strtotime($infoTulisan->TGPUBLIK)) : '' ?>" class="form-control" readonly>
                            </div>
                        <?php } else { ?>
                            <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgpublik"  name="tgpublik" placeholder="Tg. Publik" value="<?php echo isset($infoTulisan->TGPUBLIK) ? date('d-m-Y', strtotime($infoTulisan->TGPUBLIK)) : '' ?>" class="form-control">
                            </div>
                        <?php } ?>
                    </div>
                    
                      <div class="form-group pickerpicker">
                          <label class="col-sm-4 control-label">Judul</label>
                          <div class="col-sm-7">
                            <input type="text" id="judul" name="judul" placeholder="Judul" maxlength="30" value="<?php echo isset($infoTulisan->JUDUL) ? $infoTulisan->JUDUL : ""; ?>" class="form-control">
                          </div>
                      </div>                      
                      
                    
                      <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Media Publik</label>
                                <div class="col-sm-7">
                                  <input type="text" id="medpublik" name="medpublik" maxlength="20" placeholder="Media Publik" value="<?php echo isset($infoTulisan->MEDPUBLIK) ? $infoTulisan->MEDPUBLIK : ""; ?>" class="form-control">
                                </div>
                            </div>
                            
                        <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Tema</label>
                            <div class="col-sm-7">                            
                                  <select class="form-control chosen-kdtema" name="kdtema" id="kdtema" data-placeholder="Pilih Tema...">
                                      <option value=""></option>
                                      <?php echo $listKdTema; ?> 
                                  </select>
                            </div>
                        </div>
                       
                    
                      <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Sifat Tulisan</label>
                                <div class="col-sm-7">                            
                                      <select class="form-control chosen-kdsifat" name="kdsifat" id="kdsifat" data-placeholder="Pilih Sifat Tulisan...">
                                          <option value=""></option>
                                          <?php echo $listKdSifat; ?> 
                                      </select>
                                </div>
                            </div>                                                                         
               
                       
                    
                      <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Lingkup</label>
                                <div class="col-sm-7">                            
                                      <select class="form-control chosen-kdlingkup" name="kdlingkup" id="kdlingkup" data-placeholder="Pilih Kode Lingkup...">
                                          <option value=""></option>
                                          <?php echo $listKdLingkup; ?> 
                                      </select>
                                </div>
                            </div>
                            
                
                    
                      <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Kategori Jumlah Kata</label>
                                <div class="col-sm-7">                            
                                      <select class="form-control chosen-kdjumkata" name="kdjumkata" id="kdjumkata" data-placeholder="Pilih Kategori Jumlah Kata...">
                                          <option value=""></option>
                                          <?php echo $listKdJumKata; ?> 
                                      </select>
                                </div>
                            </div>
                            
                       
                    
                      <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Peranan</label>
                                <div class="col-sm-7">
                                      <select class="form-control chosen-kdperan" name="kdperan" id="kdperan" data-placeholder="Pilih Kode Peranan...">
                                          <option value=""></option>
                                          <?php echo $listKdPeran; ?> 
                                      </select>
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
            
            tgpublik: {
                validators: {
                    notEmpty: {
                        message: 'Tgl. Publik tidak boleh kosong'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Date is not valid'
                    }
                }
            },
            judul: {
                validators: {
                    notEmpty: {
                        message: 'Judul tidak boleh kosong'
                    }
                }
            },
            medpublik: {
                validators: {
                    notEmpty: {
                        message: 'Media Publik tidak boleh kosong'
                    }
                }
            },kdtema: {
                validators: {
                    notEmpty: {
                      message: 'Tema harus dipilih'
                    }
                }
            },kdsifat: {
                validators: {
                    notEmpty: {
                      message: 'Sifat harus dipilih'
                    }
                }
            },kdlingkup: {
                validators: {
                    notEmpty: {
                      message: 'Lingkup harus dipilih'
                    }
                }
            },kdjumkata: {
                validators: {
                    notEmpty: {
                      message: 'Jumlah Kata harus dipilih'
                    }
                }
            },kdperan: {
                validators: {
                    notEmpty: {
                      message: 'Peran harus dipilih'
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
        format: "dd-mm-yyyy",
        endDate: new Date()
    }).on('changeDate', function(e) {
              $('#defaultForm2').bootstrapValidator('revalidateField', 'tgpublik');
        });

    /*START CHOSEN*/
    var config = {
      '.chosen-kdlingkup'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
      '.chosen-kdsifat'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
      '.chosen-kdperan'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
      '.chosen-kdtema'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
      '.chosen-kdjumkata'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    /*END CHOSEN*/

});

function save()
{
    var url;
    if(save_method == 'update')
    {
        url = "<?php echo site_url('home/ajax_update_tulisan')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_tulisan')?>";
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