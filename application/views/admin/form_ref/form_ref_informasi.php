<form id="defaultForm2" name="defaultForm2" action="javascript:submit();" method="post" class="form-horizontal" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">      
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    	<h4 class="modal-title" id="myModalLabel">Form Pengumuman</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-12">
                <input type="hidden" value="info" name="destination" id="destination">
                <input type="hidden" value="tambah" name="action" id="action">
                <input type="hidden" value="" name="key" id="key">
                <input type="hidden" value="<?php echo isset($isian->ID) ? $isian->ID : "" ?>" name="id_informasi" id="id_informasi">
                <input type="hidden" value="<?php echo $newid; ?>" name="newid" id="newid">
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

                    <input type ="hidden" value="<?php echo $action; ?>" id="actedit" >

                    <!-- <div class="form-group"> -->

<!--                    <a href="#" target="_blank" class='btn btn-warning' name="cekfile" id="cekfile" style="display: none">CEK FILE</a> -->
                  
                    <!-- <label>Input File (jpg,png,pdf):</label>  
                    

                    <div id="uploadan" style="margin-left: 100px"> 
                    
                    <br/> 
                        <form method="post" enctype="multipart/form-data" name="asd" id="asd">
                        <span class="glyphicon glyphicon-upload"></span> Unggah file
                          <input type="file" id="NAMAFILES" name="NAMAFILES" onchange="uploading(this);return false;"><br/>
                          <input type="submit" id='upSim' name="upSim" value="Unggah" style="display:none">
                            <div class="col-xs-6">  
                              <div class="progress progress-striped active imge">
                                <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar progress-bar-success">
                                </div>
                              </div>
                            </div>
                       </form> 
                    </div>
                            

                           
                            <button  class='btn btn-warning' name="cekfile" id="cekfile" style="display: none" >CEK FILE</button>
                            <button name="ubahfile" id="ubahfile" style="display:none" class="btn btn-primary">UBAH FILE</button>
                            <button name="batal" id="batal" style="display:none" class="btn btn-danger">BATAL</button>
                        
                        
                    </div> -->
                
                   
                    <!-- <div class="form-group" >
                        <label>Nama File</label>
                        
                        <input type="text" name="NAMAFILE"  id="NAMAFILE" class="form-control" style="width: 80%;" readonly="true" value="<?php echo isset($isian->FILEINFO) ? $isian->FILEINFO : ""; ?>">  

                        <input type="hidden" name="newurl" id="newurl">
                        <input type="hidden" name="urltemp" id="urltemp">
                        <button name="getlink" id="getlink" style="display:none" class="btn btn-primary" onclick="getlinkbutton()">GET LINK</button>
                    </div> -->

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
    	<button type="submit" class="btn btn-primary" id="savebut">Simpan</button>
    </div>
</form>
<!-- <script src="<?php echo base_url('assets/tinymce/tinymce.min.js') ?>"></script> -->
<script src="<?php echo base_url(); ?>assets/tinymce/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste",
        "emoticons"
    ],
    toolbar: "emoticons | insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fontsizeselect ",
    fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
});
</script>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/boostrapvalidator/js/bootstrapValidator.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>
        <!-- blueimp gallery -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
 <script type="text/javascript">

    function submit(){
        var destination = $('#destination').val();
        var action = $('#action').val();
        var key = $('#key').val();
        var id_informasi = $('#id_informasi').val();
        var newid = $('#newid').val();
        
         var status =  $('input:radio[name=status]:checked').val();
        // var NAMAFILE = $('#NAMAFILE').val();
        var newurl = $('#newurl').val();
        var urltemp = $('#urltemp').val();
        var informasi = tinyMCE.activeEditor.getContent(); 
        
        $.ajax({
            url: '<?php echo base_url("index.php/informasi/simpanInformasi_penggajian"); ?>',
            type: "post",
        //    data: $('#defaultForm2').serialize(),
            // data:{destination:destination, action:action, key:key, id_informasi : id_informasi, newid : newid, status:status, NAMAFILE : NAMAFILE, newurl:newurl, urltemp:urltemp, informasi:informasi},

            data:{destination:destination, action:action, key:key, id_informasi : id_informasi, newid : newid, status:status, newurl:newurl, urltemp:urltemp, informasi:informasi},
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
        var actedit = $('#actedit').val();
        var nmfile = $('#NAMAFILE').val();
        if(actedit == "edit")
        {
            $('#uploadan').hide();
            cekfileexist(nmfile);
        }
    });
    /*END SETTING VALIDASI*/
     $('#cekfile').click(function(e){

    e.preventDefault();
    lihatfile();
});

$('#ubahfile').click(function(e){
    e.preventDefault();
    $('#cekfile').hide();
    $('#ubahfile').hide();
    $('#uploadan').show();
    $('#batal').show();
});

$('#batal').click(function(e){
    e.preventDefault();
    $('#cekfile').show();
    $('#ubahfile').show();
    $('#uploadan').hide();
    $('#batal').hide();
});



$('#upSim').click(function(e){
    e.preventDefault();
    uploading();
});

$('#savebut').click(function(e){
    e.preventDefault();

 /*   var nmfile= $('#NAMAFILE').val();

    if(nmfile == "")
    {
        swal('HARAP UNGGAH FILE');
    }
    else
    {*/
        submit();    
    //}

    
});



function cekfileexist(data)
{
    var splitexp = data.split('.');
    var ctsplit = splitexp.length;
    var ext = splitexp[ctsplit - 1];
                                
    var newid = $('#newid').val();
    var id_informasi = $('#id_informasi').val();

    var kirim_id;


    
    if(id_informasi == "")
    {
        kirim_id = newid;
    }
    else
    {
        kirim_id = id_informasi;
    }
 
    $.ajax({
        
        url: '<?php echo site_url("informasi/cekFileServerinfo")?>',
        type: 'POST',
        data: {id:kirim_id, ext:ext},
        dataType: 'json',
        success: function(data) {

          if(!data)
          {
            return false;
          }
          else
          {

            $('uploadan').hide();
            //$('#cekfile').attr('href',data);
            $('#newurl').val(data);
            $('#cekfile').show();
            $('#ubahfile').show(); 
          }

          
        },
        error: function(data) {
           alert('gagal');
        },
        onComplete:function()
        {
            
                    
        },
        });

}

function lihatfile()
{
    var namafile = $('#NAMAFILE').val();
    cekfileexist(namafile);
    var url = $('#newurl').val();
    
    window.open('<?php echo base_url()?>'+url,'_blank');
}

function uploading(val)
{
    var newid = $('#newid').val();
    var id_informasi = $('#id_informasi').val();


        

    var kirim_id;
    if(id_informasi == "")
    {
        kirim_id = newid;
    }
    else
    {
        kirim_id = id_informasi;
    }
    

    var formData = new FormData($('#asd')[0]);
    formData.append('file',val.files[0]);
    
   // alert($('input[type=file]')[0].files[0].type);
    $(".imge").css("display", "");
    $(".progress-bar").attr('aria-valuenow',0).css('width','0%');
    
        if(val.files[0].type == 'image/jpeg' || val.files[0].type == 'image/png' || val.files[0].type == 'application/pdf')
        {
            if(val.files[0].size <= 15120000)
            {
                $.ajax({
                    url :'<?php echo site_url("informasi/doaddactioninfo")?>/'+kirim_id,
                    type: 'POST', 
                    data:formData,
                    processData: false,
                    cache:false,
              contentType: false,
                    xhr: function() {
                        var xhr = $.ajaxSettings.xhr();
                        if (xhr.upload) {
                            xhr.upload.addEventListener('progress', function(evt) {
                                
                                var percent = (evt.loaded / evt.total) * 100;
                                $(".imge").find(".progress-bar").width(percent + "%");
                                $(".imge").find(".progress-bar").text(Math.round(percent) + "%");
                            }, false);
                        }

                        return xhr;
                    },
                    success: function(data) {

                       swal('Upload Sukses');
                                $(".imge").css("display", "none");
                                
                                $('#batal').hide();
                                
                                $('#ubahfile').show();
                                $('#uploadan').hide();
                                
                                
                                
                                var isinamafile = $('#NAMAFILE').val(data);

                                var urltemp = $('#urltemp').val('<a href="assets/img/informasi/'+data+'" target="_blank">(klik disini untuk download)</a>');
                                $('#getlink').show();
                                //var isinamafile = $('#NAMAFILE').val('<a href="assets/img/informasi/'+data+'">klik disini</a>');
                                //$('#informasi').val($('#informasi').val() + isinamafile);
                               
                               
                                            cekfileexist(data);
                        $('#cekfile').show();
                            
                        
                    },
                    error: function(data) {
                       
                    }
                });
            }
            else
            {
                 swal('Upload gagal');
            }
        }
        else
        {
          swal('Upload gagal');
        }
  
}

function getlinkbutton()
{
    var infonow = tinyMCE.activeEditor.getContent();
    var urltemp = $('#urltemp').val();
    tinyMCE.activeEditor.setContent(infonow + urltemp);
}

</script>
