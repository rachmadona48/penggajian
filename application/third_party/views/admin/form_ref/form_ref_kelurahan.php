
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

<form id="defaultForm2" name="defaultForm2" method="post" class="form-horizontal"  action="javascript:submit();" data-bv-submitbuttons="button[type='submit']" data-remote="true" data-toggle="validator" role="form">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Form Ref Kelurahan</h4>
    </div>
    <div class="modal-body">

        <div class="row">
            <!-- START SIDE 1 -->
            <div class="col-md-12">
                <input type="hidden" value="ref_kelurahan" name="destination" id="destination">
                <input type="hidden" value="tambah" name="action" id="action">
                <input type="hidden" value="" name="kowil0" id="key2">
                <input type="hidden" value="" name="id" id="key5">
                <input type="hidden" value="" name="kode" id="key6">
                <div class="form-group pickerpicker">
                    <label class="col-sm-4 control-label">Provinsi</label>
                    <div class="input-group col-sm-7">
                        <select class="chosen-prov" name="prov" id="prov" tabindex="2" data-placeholder="Pilih Provinsi...">
                            <option value=""></option>
                            <?php echo $listProv; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group pickerpicker">
                    <label class="col-sm-4 control-label">Kabupaten/Kota</label>
                    <div class="input-group col-sm-7">
                        <select class="chosen-kowil" name="kowil" id="kowil" tabindex="2" data-placeholder="Pilih Kabupaten/Kota...">
                            <option value=""></option>
                            <?php echo $listKowil; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group pickerpicker">
                    <label class="col-sm-4 control-label">Kecamatan</label>
                    <div class="input-group col-sm-7">
                        <select class="chosen-kocam" name="kocam" id="kocam" tabindex="2" data-placeholder="Pilih Kecamatan...">
                            <option value=""></option>
                            <?php echo $listKocam; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group pickerpicker">
                    <label class="col-sm-4 control-label">Kelurahan</label>
                    <div class="input-group col-sm-7">
                        <input type="text" id="kokel" name="kokel" maxlength="4" placeholder="Kode Kelurahan" onkeyup="validAngka(this)" value="<?php echo isset($isian->KELURAHAN) ? $isian->KELURAHAN : ""; ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group pickerpicker">
                    <label class="col-sm-4 control-label">Nama Kelurahan</label>
                    <div class="input-group col-sm-7">
                        <input type="text" id="nakel" name="nakel" maxlength="25" value="<?php echo isset($isian->NAMA) ? $isian->NAMA : ""; ?>" class="form-control">
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
    function validAngka(a)
    {
        if(!/^[0-9.]+$/.test(a.value))
        {
        a.value = a.value.substring(0,a.value.length-1000);
        }
    }
</script>

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
                prov: {
                    validators: {
                        notEmpty: {
                            message: 'Provinsi harus dipilih'
                        }
                    }
                },
                kowil: {
                    validators: {
                        notEmpty: {
                            message: 'Kabupaten/Kota harus dipilih'
                        }
                    }
                },
                kocam: {
                    validators: {
                        notEmpty: {
                            message: 'Kecamatan harus dipilih'
                        }
                    }
                },
                kokel: {
                    validators: {
                        notEmpty: {
                            message: 'Kode kelurahan tidak boleh kosong'
                        }
                    }
                },
                nakel: {
                    validators: {
                        notEmpty: {
                            message: 'Nama Kelurahan tidak boleh kosong'
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
            $('#defaultForm2').bootstrapValidator('revalidateField', 'tgmulai');
        });

        /*START CHOSEN*/
        var config = {
            '.chosen-prov'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
            '.chosen-kowil'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
            '.chosen-kocam'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"}
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }
        /*END CHOSEN*/

    });

    $(function() {
        $("#prov").on("change", function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?php echo base_url(); ?>referensi/getKab",
                type: "post",
                data: {prov : $('#prov').val()},
                dataType: 'json',
                beforeSend: function() {
                    // $('#kowil').html('');
                },
                success: function(data) {
                    if(data.response == 'SUKSES'){
                        // alert(data.list);
                        list = '<option value=""></option>' + data.list;
                        // alert(list);
                        $('#kowil').html(list);
                        // $('#kocam').html('');
                    }else{
                        $('#kowil').html('');
                    }
                },
                error: function(xhr) {
                    alert("Terjadi kesalahan. Silahkan coba kembali");
                },
                complete: function() {
                    $(".chosen-kowil").trigger("chosen:updated");
                }
            });
        });

    });

    $(function() {
        $("#kowil").on("change", function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?php echo base_url(); ?>referensi/getKecamatan",
                type: "post",
                data: {kowil : $('#kowil').val()},
                dataType: 'json',
                beforeSend: function() {
                    // $('#kowil').html('');
                    
                },
                success: function(data) {
                    if(data.response == 'SUKSES'){
                        list = '<option value=""></option>' + data.list;
                        $('#kocam').html(list);
                    }else{
                        $('#kocam').html('');
                    }
                },
                error: function(xhr) {
                    alert("Terjadi kesalahan. Silahkan coba kembali");
                },
                complete: function() {
                    $(".chosen-kocam").trigger("chosen:updated");
                }
            });
        });

    });

    function submit()
    {

        $.ajax({
            url: '<?php echo base_url("index.php/referensi/simpanReferensi"); ?>',
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
                    // $('.msg').html('<small>Data berhasil disimpan.</small>');
                    // $('.err').html('');
                    swal("Sukses!", "Berhasil tambah menu ","success");

                    $('#myModal').modal('hide');
                    setTimeout(function () {
                        reload_kel();
                    }, 1000);

                }else{
                    $('.msg').html('');
                    $('.err').html("<small>Data gagal disimpan, key sudah digunakan.</small>");
                }

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            },
            complete: function() {
            	// reload_kel();
            }
        });
    }
</script>