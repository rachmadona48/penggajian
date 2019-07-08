
<style type="text/css">
    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
    .pickerpicker .form-control-feedback {
        right: 30px !important;      
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


<form id="defaultForm2" name="defaultForm2" action="javascript:submit();" method="post" class="form-horizontal" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">      
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Form PTT</h4>
    </div>
    <div class="modal-body">
        
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-12">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">NPTT</label>
                        <div class="col-sm-7">
                            <input type="text" id="nptt" name="nptt" value="<?php echo isset($dataptt->NPTT) ? $dataptt->NPTT : ""; ?>" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" value="ref_jabatan" name="destination" id="destination">
                    <input type="hidden" value="tambah" name="action" id="action">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Nama </label>
                        <div class="col-sm-7">
                            <input type="text" id="nama" name="nama" value="<?php echo isset($dataptt->NAMA) ? $dataptt->NAMA : ""; ?>" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                
                
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Tanggal Lahir </label>
                        <div class="col-sm-7">
                            <input type="text" id="talhir" name="talhir" value="<?php echo isset($dataptt->TGLLAHIR) ? $dataptt->TGLLAHIR : ""; ?>" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Jabatan</label>
                        <div class="col-sm-7">
                            <input type="text" id="jabat" name="jabat" value="<?php echo isset($dataptt->JABAT) ? $dataptt->JABAT : ""; ?>" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group pickerpicker">
                        <label class="col-sm-5 control-label">Kodel</label>
                        <div class="col-sm-7">
                            <input type="text" id="kodel" name="kodel" value="<?php echo isset($dataptt->KODEL) ? $dataptt->KODEL : ""; ?>" class="form-control" maxlength="4" onkeypress="return numbersonly(this, event)" onchange="cekbatasan()" placeholder="MMYY">
                        <small class="text-danger">*pengisian dengan format MMYY (01YY)-(12YY)</small>
                        </div>

                    </div>
                </div>
            </div>











            
        
    </div>
    <div class="modal-footer">
        <span class="pull-left">
            <label class="msg text-success"></label>
            <label class="err text-danger"></label>
        </span>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary" id="butsv">Simpan</button>
        <!-- <input type="submit" class="btn btn-primary" id="b_simpan" name="simpan" value="Simpan" style="display:non;"/> -->
    </div>
</form>


 <script type="text/javascript">
    var kolok;
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

    function cekbatasan()
    {
        var kodel = $('#kodel').val();
        var kodel_len = kodel.length;
        if(kodel_len>0 &&kodel_len<4)
        {
            
            document.getElementById('butsv').disabled=true;
        }
        else
        {
            if(kodel>100 && kodel<1300 || kodel_len == 0)
            {
                document.getElementById('butsv').disabled=false;
            }
            else
            {
                document.getElementById('butsv').disabled=true;
            }
            
        }
    }


    function submit(){
        
        $.ajax({
            url: '<?php echo base_url("index.php/admin/batch/simpanData"); ?>',
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
                    swal({type:"success",title:"SUKSES!!", text:"DATA BERHASIL DIUBAH"});
                    setTimeout(function () {
                    showPTT();
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
            excluded:'disabled',
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },            
            fields: {
                kojab: {
                    validators: {
                        notEmpty: {
                            message: 'Kode Jabatan tidak boleh kosong'
                        }
                    }
                },
                najabs: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Jabatan tidak boleh kosong'
                        }
                    }
                },eselon: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Eselon tidak boleh kosong'
                        }
                    }
                },najabl: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Jabatan Lengkap tidak boleh kosong'
                        }
                    }
                },kdsort: {
                    validators: {
                        notEmpty: {
                            message: 'Kode Sort tidak boleh kosong'
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

        /*START CHOSEN*/
    var config = {
        '.chosen-select'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width:'250px'}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
    /*END CHOSEN*/
});
    /*END SETTING VALIDASI*/

    
    

</script>