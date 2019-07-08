
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
    	<h4 class="modal-title" id="myModalLabel">Form Riwayat Cuti</h4>
    </div>
    <div class="modal-body">
    	
            <div class="row">
                <!-- START SIDE 1 -->
                <div class="col-md-12">
                    <div class="form-group">
        				<label class="col-sm-4 control-label"><font color="blue">NRK</font></label>
                    	<div class="col-sm-7">
                    		<input type="text" id="nrk" name="nrk" placeholder="NRK" class="form-control" value="<?php echo isset($nrk) ? $nrk : '' ?>" readOnly="true">
                    	</div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group pickerpicker" id="data_1">
                        <label class="col-sm-4 control-label"><font color="blue">TMT</font></label>
                        <?php if($action == 'update'){ ?>
                            <div class="col-sm-7 date">
                                <span class="input-group-addon" style="display: none"><i class="fa fa-calendar"></i></span><input type="text" id="tmt" name="tmt" placeholder="TMT" value="<?php echo isset($infoCuti->TMT) ? date('d-m-Y', strtotime($infoCuti->TMT)) : '' ?>" class="form-control" readonly>
                            </div>
                        <?php } else { ?>
                            <div class="input-group col-sm-7 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmt"  name="tmt" placeholder="TMT" value="<?php echo isset($infoCuti->TMT) ? date('d-m-Y', strtotime($infoCuti->TMT)) : '' ?>" class="form-control">
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group pickerpicker" style="display:none">
                        <label class="col-sm-4 control-label">Jenis SK</label>
                        <div class="col-sm-8">                      
                            <select class="form-control chosen-jensk" name="jensk" id="jensk" tabindex="2" data-placeholder="Pilih Jenis SK....">
                                <option></option>
                                <?php echo $listjensk; ?> 
                            </select>
                        </div>
                    </div> 

    	            <div class="form-group pickerpicker">
    	              <label class="col-sm-4 control-label">No. SK</label>
    	              <div class="col-sm-7">
    	                 <input type="text" id="nosk" name="nosk" placeholder="NOSK" maxlength="20" value="<?php echo isset($infoCuti->NOSK) ? $infoCuti->NOSK : ""; ?>" class="form-control">
    	              </div>
    	            </div>
    	            <div class="form-group pickerpicker"  id="data_3">
    	              <label class="col-sm-4 control-label">Tgl. SK</label>
    	              <div class="input-group col-sm-7 date">
    	                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgsk" name="tgsk" placeholder="Tgl. SK" value="<?php echo isset($infoCuti->TGSK) ? date('d-m-Y', strtotime($infoCuti->TGSK)) : ""; ?>" class="form-control">
    	              </div>
    	            </div>
    	            <div class="form-group pickerpicker">
    	              <label class="col-sm-4 control-label">Jenis Cuti</label>
    	              <div class="col-sm-8">	                 	              
    	                  <select class="chosen-jencuti" name="jencuti" id="jencuti" tabindex="2" data-placeholder="Pilih Jenis Cuti...">
    	                    <option value=""></option>
                            <?php echo $listJenCuti ?>
    	                  </select>
    	              </div>
    	            </div>
    	            <div class="form-group pickerpicker"  id="data_2">
    	              <label class="col-sm-4 control-label">Tgl. Berakhir</label>
    	              <div class="input-group col-sm-7 date">
    	                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgakhir" name="tgakhir" placeholder="Tgl. Akhir" value="<?php echo isset($infoCuti->TGAKHIR) ? date('d-m-Y', strtotime($infoCuti->TGAKHIR)) : ""; ?>" class="form-control">
    	              </div>
    	            </div>
    	            
    	            <div class="form-group pickerpicker">
    	              <label class="col-sm-4 control-label">Pejabat Penanda Tanganan</label>
    	              <div class="col-sm-8">    	                 
                         <select class="chosen-pejtt" name="pejtt" id="pejtt" tabindex="2" data-placeholder="Pilih Pejabat Penanda Tanganan...">
                            <option value=""></option>
                            <?php echo $listPejtt ?>
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
                        tmt: {
                            validators: {
                                date: {
                                        format: 'DD-MM-YYYY',
                                        message: 'Date is not valid'
                                },
                                notEmpty: {
                                    message: 'TMT tidak boleh kosong'
                                }
                            }
                        // },jensk: {
                        //     validators: {
                        //         notEmpty: {
                        //             message: 'Jenis SK tidak boleh kosong'
                        //         }
                        //     }
                        },nosk: {
                            validators: {
                                notEmpty: {
                                    message: 'No. SK tidak boleh kosong'
                                }
                            }
                        },jencuti: {
                            validators: {
                                notEmpty: {
                                    message: 'Jenis Cuti harus dipilih'
                                }
                            }
                        },pejtt: {
                            validators: {
                                notEmpty: {
                                    message: 'PEJTT harus dipilih'
                                }
                            }
                        },tgsk: {
                            validators: {
                                 date: {
                                    format: 'DD-MM-YYYY',
                                    message: 'Date is not valid'
                                },
                                notEmpty: {
                                    message: 'Tgl. SK tidak boleh kosong'
                                }
                            }
                        },tgakhir: {
                            validators: {
                                 date: {
                                    format: 'DD-MM-YYYY',
                                    message: 'The date is not a valid'
                                },
                                notEmpty: {
                                    message: 'Tgl. Akhir tidak boleh kosong'
                                }
                            }
                        }
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
                // Revalidate the date field
                $('#defaultForm2').bootstrapValidator('revalidateField', 'tmt');
                }); 

                $('#data_2 .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy"
                }).on('changeDate', function(e) {
                // Revalidate the date field
                $('#defaultForm2').bootstrapValidator('revalidateField', 'tgakhir');
                }); 

                $('#data_3 .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy"
                }).on('changeDate', function(e) {
                // Revalidate the date field
                $('#defaultForm2').bootstrapValidator('revalidateField', 'tgsk');
                }); 
                
                /*START CHOSEN*/
                var config = {
                  '.chosen-jencuti'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
                  '.chosen-pejtt'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
                  '.chosen-jensk'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"}
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
                    url = "<?php echo site_url('home/ajax_update_cuti')?>";
                }
                else
                {    
                    url = "<?php echo site_url('home/ajax_add_cuti')?>";
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
                            $('.err').html('');
                            swal({type:"warning",title:"DATA GAGAL DISIMPAN", text:"TMT SUDAH DIGUNAKAN, MOHON PERIKSA KEMBALI DATA YANG DIINPUT"});
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