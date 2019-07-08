<form id="defaultForm2" name="defaultForm2" action="javascript:submit();" method="post" class="form-horizontal" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">      
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	<h4 class="modal-title" id="myModalLabel">Form Informasi</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-12">
                <input type="hidden" value="info" name="destination" id="destination">
                <input type="hidden" value="tambah" name="action" id="action">
                <input type="hidden" value="" name="key" id="key">
                <input type="hidden" value="<?php echo isset($isian->ID) ? $isian->ID : "" ?>" name="id_informasi">
                    <div class="form-group">
                        <label class="radio-inline">
                            <strong>Status</strong>
                        </label>
                        <label class="radio-inline">
                           
                            <input type="radio" name="status" value="1" <?php echo isset($isian->STATUS_BERITA)? (($isian->STATUS_BERITA == '1') ? 'checked' : ''): 'checked'; ?>> Aktif<br>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="2"<?php echo isset($isian->STATUS_BERITA)? (($isian->STATUS_BERITA == '2') ? 'checked' : ''): 'checked'; ?>> Tidak Aktif<br>
                        </label>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="4" name="informasi"><?php echo isset($isian->BERITA) ? $isian->BERITA : ""; ?></textarea>
                    </div>
<!--
                    <div class="hr-line-dashed"></div>                    
-->
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
<script src="<?php echo base_url('assets/tinymce/tinymce.min.js') ?>"></script>
<script>
  tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste",
        "emoticons"
    ],
    toolbar: "emoticons | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
});
</script>
 <script type="text/javascript">

    function submit(){
        $.ajax({
            url: '<?php echo base_url("index.php/informasi/simpanInformasi"); ?>',
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
                    $('.err').html("<small>Data gagal disimpan, silahkan coba kembali.</small>");
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

      $(document).on('focusin', function(e) {
    if ($(e.target).closest(".mce-window").length) {
        e.stopImmediatePropagation();
    }
});
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
                status: {
                    validators: {
                        notEmpty: {
                            message: 'Status harus di pilih'
                        }
                    }
                }
            }
        });
    });
    /*END SETTING VALIDASI*/
    

</script>