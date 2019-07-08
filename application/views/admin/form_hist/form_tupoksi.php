
<style type="text/css">
    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
</style>
<?php //var_dump($infoTupoksi);?>
<form id="defaultForm2" name="defaultForm2" method="post" class="form-horizontal"  action="javascript:save();" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Form Riwayat Tugas Pokok dan Fungsi</h4>
      </div>
      <div class="modal-body">
          
              <div class="row">
                  <!-- START SIDE 1 -->

                  <div class="col-md-12">
                          <input type="hidden" name="tupoksi_id" value="<?php echo isset($infoTupoksi->tupoksi_id) ? $infoTupoksi->tupoksi_id : '' ?>">
                      <div class="form-group">
                          <label class="col-sm-4 control-label">Kode Lokasi</label>
                          <div class="input-group col-sm-7">
                             <input type="text" id="kolok" name="kolok" placeholder="Kolok" class="form-control" value="<?php echo isset($infoTupoksi->kolok) ? $infoTupoksi->kolok : '' ?>" readonly="true">
                          </div>
                      </div>
                    
                      <div class="form-group">
                          <label class="col-sm-4 control-label">Kode Jabatan</label>
                          <div class="input-group col-sm-7">
                            <input type="text" id="kojab" name="kojab" placeholder="Kojab" value="<?php echo isset($infoTupoksi->kojab) ? $infoTupoksi->kojab : ''; ?>"  class="form-control" readonly="true">
                          </div>
                      </div>                      


                       <div class="form-group">
                          <label class="col-sm-4 control-label">No Urut</label>
                          <div class="input-group col-sm-7">
                             <input type="text" id="no_urut" name="no_urut" placeholder="no_urut" maxlength="3" value="<?php echo isset($infoTupoksi->no_urut) ? $infoTupoksi->no_urut : ''; ?>" class="form-control">
                          </div>
                        </div>
                      
                    
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Uraian</label>
                                <div class="input-group col-sm-7">
                                  <!--<textarea id="uraian" name="uraian" placeholder="Uraian" rows="5" value="<?php echo isset($infoTupoksi->uraian) ? $infoTupoksi->uraian : ""; ?>" class="form-control"></textarea>-->  
                                  <input type="text" id="uraian" name="uraian" placeholder="Uraian" value="<?php echo isset($infoTupoksi->uraian) ? $infoTupoksi->uraian : ""; ?>" class="form-control">
                                </div>
                            </div>
                            
                        <div class="form-group">
                        <label class="col-sm-4 control-label">Tahun</label>
                            <div class="input-group col-sm-7">                            
                                   <input type="text" id="tahun" name="tahun" placeholder="Tahun" maxlength="4" value="<?php echo isset($infoTupoksi->tahun) ? $infoTupoksi->tahun : ""; ?>" class="form-control">
                            </div>
                        </div>
                       
                    
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Dasar Hukum</label>
                            <div class="input-group col-sm-7">                             
                                   <input type="text" id="dasar_hukum" name="dasar_hukum" placeholder="Dasar Hukum" maxlength="255" value="<?php echo isset($infoTupoksi->dasar_hukum) ? $infoTupoksi->dasar_hukum : ""; ?>" class="form-control">
                            </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-4 control-label">Aktif</label>
                            <div class="input-group col-sm-7">                            
                                   <input type="text" id="aktif" name="aktif" placeholder="Aktif" maxlength="1" value="<?php echo isset($infoTupoksi->aktif) ? $infoTupoksi->aktif : ""; ?>" class="form-control">
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
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            //==============
            kolok: {
                validators: {
                    notEmpty: {
                        message: 'Kode Lokasi tidak boleh kosong'
                    }
                }
            },
            kojab: {
                validators: {
                    notEmpty: {
                        message: 'Kode Jabatan tidak boleh kosong'
                    }
                }
            },
            
            tahun: {
                validators: {
                    notEmpty: {
                        message: 'Tahun tidak boleh kosong'
                    }
                }
            },
            uraian: {
                validators: {
                    notEmpty: {
                        message: 'Uraian tidak boleh kosong'
                    }
                }
            },
            
            aktif: {
                validators: {
                    notEmpty: {
                        message: 'Aktif tidak boleh kosong'
                    }
                }
            }
            //==============
        }
    });

});

function save()
{
    var url;
    if(save_method == 'update')
    {
        url = "<?php echo site_url('home/ajax_update_tupoksi')?>";
    }
    else
    {
        url = "<?php echo site_url('home/ajax_add_tupoksi')?>";
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