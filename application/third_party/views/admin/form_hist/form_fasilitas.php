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
    	<h4 class="modal-title" id="myModalLabel">Form Riwayat Fasilitas</h4>
    </div>
    <div class="modal-body">    	
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-12">
                    <div class="form-group">
        				<label class="col-sm-4 control-label"><font color="blue">NRK</font></label>
                    	<div class="col-sm-4">
                    		<input type="text" id="nrk" name="nrk" placeholder="NRK" class="form-control" value="<?php echo isset($nrk) ? $nrk : '' ?>" readOnly="true">
                    	</div>
                    </div>
                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label"><font color="blue">Fasilitas</font></label>
                        <div class="col-sm-8">
                            <?php if($action == 'update') { ?>
                                <select class="form-control chosen-fasilitas" readonly="readonly" name="jenfas" id="jenfas"  data-placeholder="Pilih Fasilitas...">
                                    <option value=""></option>
                                    <?php echo $listFasilitas; ?>
                                    <script type="text/javascript">
                                        var select = $('#jenfas');

                                        select.chosen();

                                        select.on('chosen:updated', function () {
                                            if (select.attr('readonly')) {
                                                var wasDisabled = select.is(':disabled');

                                                select.attr('disabled', 'disabled');
                                                select.data('chosen').search_field_disabled();

                                                if (wasDisabled) {
                                                    select.attr('disabled', 'disabled');
                                                } else {
                                                    select.removeAttr('disabled');
                                                }
                                            }
                                        });

                                        select.trigger('chosen:updated');
                                    </script>
                                </select>
                            <?php } else { ?>
                                <select class="form-control chosen-fasilitas" name="jenfas" id="jenfas" data-placeholder="Pilih Fasilitas...">
                                    <option value=""></option>
                                    <?php echo $listFasilitas; ?>
                                </select>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">        
                <div class="col-md-6">


                    <div class="form-group pickerpicker" style="display: none">
        				<label class="col-sm-4 control-label">Instansi</label>
                    	<div class="col-sm-8">                		
                            <select class="form-control chosen-instansi" name="instansi" id="instansi" data-placeholder="Pilih Instansi...">
                                <option value=""></option>
                                <?php echo $listInstansi; ?> 
                            </select>
                    	</div>
                    </div>
                </div>
            

           
                <div class="col-md-6">

                </div>
            

            <div class="row">
            	<div class="col-md-12">
                    <div class="form-group pickerpicker" id="data_1">
                        <label class="col-sm-4 control-label"><font color="blue">TMT Mulai</font></label>
                        <?php if($action == 'update'){ ?>
                            <div class="col-sm-7 date">
                                <span class="input-group-addon" style="display: none"><i class="fa fa-calendar"></i></span><input type="text" id="thdapat" name="thdapat" placeholder="Terhitung Mulai Tanggal Mulai" value="<?php echo isset($infoFasilitas->THDAPAT) ? $infoFasilitas->THDAPAT : date('Y'); ?>" class="form-control" readonly>
                            </div>
                        <?php } else { ?>
                            <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="thdapat"  name="thdapat" placeholder="Terhitung Mulai Tanggal Mulai" value="<?php echo isset($infoFasilitas->THDAPAT) ? $infoFasilitas->THDAPAT : date('Y') ?>" class="form-control" readonly>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group pickerpicker" id="data_2">
                        <label class="col-sm-4 control-label">TMT Akhir</label>
                        <div class="input-group col-sm-7 date">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="thsampai" name="thsampai" placeholder="Terhitung Mulai Tanggal Akhir" value="<?php echo isset($infoFasilitas->THSAMPAI) ? $infoFasilitas->THSAMPAI : '' ?>" class="form-control" readonly>
                        </div>
                    </div>
            		<div class="form-group pickerpicker">
                      <label class="col-sm-4 control-label">Keterangan Fasilitas</label>
                      <div class="col-sm-7">
                         <input type="text" id="ketfas" name="ketfas" placeholder="Keterangan Fasilitas" maxlength="20" value="<?php echo isset($infoFasilitas->KETFAS) ? $infoFasilitas->KETFAS : ""; ?>" class="form-control">
                      </div>
                    </div>

                    <div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label" for="klogad">Lokasi Gaji</label>
                        <div class="col-sm-8">
                            <select class="form-control chosen-klogad" name="klogad" id="klogad" data-placeholder="Pilih Lokasi Gaji..." style="width:99%" onchange="setSpmu()" readonly>
                                <option></option>
                                <?php echo $listKlogad; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="spmu">SKPD </label>
                        <div class="col-sm-7">
                            <input type="hidden" id="spmu" name="spmu" placeholder="satuan kerja perangkat daerah" value="<?php echo isset($SPMU) ? $SPMU : ""; ?>" class="form-control" maxlength="4" readonly>

                            <input type="text" id="spmu2" name="spmu2" placeholder="SKPD" value="<?php echo isset($nmSPMU) ? $nmSPMU : ""; ?>" class="form-control"  readonly>
                        </div>
                    </div>
         
         			<div class="form-group pickerpicker">
        				<label class="col-sm-4 control-label">Wilayah</label>
                    	<div class="col-sm-8">                		
                            <select class="form-control chosen-kowil" name="kowil" id="kowil" data-placeholder="Pilih Wilayah...">
                                <option value=""></option>
                                <?php echo $listKowil; ?> 
                            </select>
                    	</div>
                    </div>

                    <div class="form-group pickerpicker">
        				<label class="col-sm-4 control-label">Kecamatan</label>
                    	<div class="col-sm-8">                		
                            <select class="form-control chosen-kocam" name="kocam" id="kocam" data-placeholder="Pilih Kecamatan...">
                                <option value=""></option>
                                <?php echo $listKocam; ?> 
                            </select>
                    	</div>
                    </div>

                    <div class="form-group pickerpicker">
        				<label class="col-sm-4 control-label">Kelurahan</label>
                    	<div class="col-sm-8">                		
                            <select class="form-control chosen-kokel" name="kokel" id="kokel" data-placeholder="Pilih Kelurahan...">
                                <option value=""></option>
                                <?php echo $listKokel; ?> 
                            </select>
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
                       jenfas: {
                            validators: {
                                notEmpty: {
                                    message: 'Fasilitas harus dipilih'
                                }
                            }
                        },instansi: {
                            validators: {
                                notEmpty: {
                                    message: 'Instansi harus dipilih'
                                }
                            }
                        },ketfas: {
                            validators: {
                                notEmpty: {
                                    message: 'Keterangan Fasilitas tidak boleh kosong'
                                }
                            }
                        },kowil: {
                            validators: {
                            	notEmpty: {
                                    message: 'Wilayah harus dpilih'
                                }
                                
                            }
                        },kocam: {
                            validators: {
                            	
                                notEmpty: {
                                    message: 'Kecamatan harus dipilih'
                                }
                            }
                        },kokel: {
                            validators: {
                            	 notEmpty: {
                                    message: 'Kelurahan harus dipilih'
                                }
                            }
                        },klogad: {
                            validators: {
                                 notEmpty: {
                                    message: 'Lokasi Gaji harus dipilih'
                                }
                            }
                        }
                    }
                });

                

				$('#data_1 .input-group.date').datepicker({
                    todayBtn: "linked",
                    changeyear: false,
                    minViewMode: 2,
                    keyboardNavigation: false,
                    forceParse: false,
                    autoclose: true,
                    todayHighlight: true,
                    format: 'yyyy',
                    endDate : new Date()
                }); 

    			$('#data_2 .input-group.date').datepicker({
			        todayBtn: "linked",
                    changeyear: false,
                    minViewMode: 2,
                    keyboardNavigation: false,
                    forceParse: false,
                    autoclose: true,
                    todayHighlight: true,
                    format: 'yyyy',
                    
                    endDate : new Date()
    			}); 

                

                /*START CHOSEN*/
                var config = {
                  '.chosen-fasilitas'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
                  '.chosen-instansi'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
                  '.chosen-klogad'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
                    '.chosen-kowil'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
                  '.chosen-kocam'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
                  '.chosen-kokel'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
                  
                  
                }
                for (var selector in config) {
                  $(selector).chosen(config[selector]);
                }


                /*END CHOSEN*/                    

            });

			$(function() {
			    $("#kowil").on("change", function(event) {
			        event.preventDefault();

			        $.ajax({
			            url: "<?php echo base_url(); ?>index.php/home/getKecamatan",
			            type: "post",
			            data: {kowil : $('#kowil').val()},
			            dataType: 'json',
			            beforeSend: function() {

			            },
			            success: function(data) {
			                if(data.response == 'SUKSES'){
			                    list = '<option value=""></option>' + data.list;
			                     $('#kocam').html(list);
			                }else{
			                     $('#kocam').html('');
			                }
			                $('#kokel').html('<option value=""></option>');
			            },
			            error: function(xhr) {
			                alert("Terjadi kesalahan. Silahkan coba kembali");
			            },
			            complete: function() {
			                $(".chosen-kocam").trigger("chosen:updated");
			                $(".chosen-kokel").trigger("chosen:updated");
                            $('#defaultForm2').bootstrapValidator('revalidateField', 'kocam');
                            $('#defaultForm2').bootstrapValidator('revalidateField', 'kokel');
			            }
			        });
			    });

			    $("#kocam").on("change", function(event) {
			        event.preventDefault();

			        $.ajax({
			            url: "<?php echo base_url(); ?>index.php/home/getKelurahan",
			            type: "post",
			            data: {kowil : $('#kowil').val(), kocam : $('#kocam').val()},
			            dataType: 'json',
			            beforeSend: function() {

			            },
			            success: function(data) {
			                if(data.response == 'SUKSES'){
			                    list = '<option value=""></option>' + data.list;
			                     $('#kokel').html(list);
			                }else{
			                     $('#kokel').html('');
			                }

			            },
			            error: function(xhr) {
			                alert("Terjadi kesalahan. Silahkan coba kembali");
			            },
			            complete: function() {
			                $(".chosen-kokel").trigger("chosen:updated");
                            $('#defaultForm2').bootstrapValidator('revalidateField', 'kokel');
			            }
			        });
			    });
			});

            function setSpmu(){
                klogad = $('#klogad').val();

                $.ajax({
                    url: '<?php echo base_url("index.php/pegawai/getSpmuByKlogad"); ?>',
                    type: "post",
                    data: {
                        klogad: klogad
                    },
                    dataType: 'text',
                    beforeSend: function() {
                        $('.msg').html('<div><div class="sk-spinner sk-spinner-rotating-plane"></div></div>');
                        $('.err').html("");
                    },
                    success: function(data) {
                        $('#spmu').val(data);
                    },
                    error: function(xhr) {
                        $('.msg').html('');
                        $('.err').html("<small>Terjadi kesalahan</small>");
                    },
                    complete: function() {

                    }
                });

                $.ajax({
                url: '<?php echo base_url("index.php/pegawai/getKetSpmuByKlogad"); ?>',
                type: "post",
                data: {
                    klogad: klogad
                },
                dataType: 'text',
                beforeSend: function() {
                    $('.msg').html('');
                    $('.err').html("");
                },
                success: function(data) {
                    $('#spmu2').val(data);
                },
                error: function(xhr) {
                    $('.msg').html('');
                    $('.err').html("<small>Terjadi kesalahan</small>");
                },
                complete: function() {

                }
                
            });
            }


            function save()
            {
                var url;
                if(save_method == 'update')
                {
                    url = "<?php echo site_url('home/ajax_update_fasilitas')?>";
                }
                else
                {    
                    url = "<?php echo site_url('home/ajax_add_fasilitas')?>";
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