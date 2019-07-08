<style type="text/css">
	.ms-options-wrap .ms-options ul, .ms-options-wrap .ms-options li {
            list-style: outside none none;
            margin: 0 !important;
            padding: 2px !important;
        }

        .ibox-title .label {
            float: none !important;
            margin-left: 4px;
        }

        .ms-options-wrap > .ms-options > ul > li.optgroup .label {
            display: inline !important;
            font-weight: bold;
            padding: 5px 0 0;
        }

        /*.label {
            background-color: #fff !important;
            color: #5e5e5e;
            font-family: "Open Sans";
            font-size: 10px;
            font-weight: 600;
            padding: 3px 8px;
            text-shadow: none;
        }
*/
        .ms-options-wrap > .ms-options > ul input[type="checkbox"] {            
            top: 2px !important;
        }
</style>
<link href="<?php echo base_url(); ?>assets/js/plugins/multipleselect/jquery.multiselect.css" rel="stylesheet">
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Syarat Permohonan</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?=site_url('subbid')?>">Home</a>
            </li>
            <li class="active">
                <strong>Syarat Permohonan</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/select2/select2.min.css" rel="stylesheet">


<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
				<div class="ibox-title navy-bg">
<!--					<span class="label label-warning pull-right">--><?//=$tgl?><!--</span>-->
					<h5>Pencarian Syarat Permohonan</h5>
				</div>
				<div class="ibox-content">
						
					<div class="row">
						<div class="col-md-3">
								<select name="id_permohonans" id="id_permohonans" tabindex="2" class="form-control" style="width: 100%"></select>
						</div>
						<div class="col-md-3">
								<select name="id_jenis_permohonans" id="id_jenis_permohonans" tabindex="2" class="form-control" style="width: 100%"></select>
						</div>
						<div class="col-md-3">
							<select name="id_kojabfs" id="id_kojabfs" tabindex="3" class="form-control" style="width: 100%"></select>
						</div>
						<div class="col-md-3">
							<input type="button" id="btn_cari" name="btn_cari" value="Cari" class="btn btn-primary">
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>

	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="tabs-container">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#tab-1">Persyaratan</a></li>
						<li class=""><a data-toggle="tab" href="#tab-2">Mekanisme Pelayanan</a></li>
						<li class=""><a data-toggle="tab" href="#tab-3">Dasar Hukum</a></li>
					</ul>
					<div class="tab-content">
						<div id="tab-1" class="tab-pane active">
							<div class="panel-body">
								<button id="btn_tbh1" class="btn btn-primary pull-right" style="display: none">Tambah</button>
								<button id="btn_tbh_wajib" class="btn btn-primary pull-right" style="display:none; margin-right: 5px">Tambah Wajib</button>
								<table id="t1" class="table table-striped table-bordered table-hover dataTables-example" >
									<thead>
									<tr>
										<th style="width:5%">No</th>
										<th>Keterangan</th>
										<th>Inisial Nama File</th>
										<th style="width:15%">Aksi</th>
									</tr>
									</thead>
								</table>
							</div>
						</div>
						<div id="tab-2" class="tab-pane">
							<div class="panel-body">
								<div class="form-group">
									<div class="col-lg-12">
										<button id="btn_edit_me" class="btn btn-primary btn-xs m-l-sm" onclick="editMekanisme()" type="button" style="display: none">Edit</button>
										<button id="btn_save_me" class="btn btn-primary  btn-xs" onclick="saveMekanisme()" type="button" style="display: none">Save</button>
										<div id="mekanismet" class="wrapper p-md">

										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="tab-3" class="tab-pane">
							<div class="panel-body">
								<div class="form-group">
									<div class="col-lg-12">
										<button id="btn_edit_dh" class="btn btn-primary btn-xs m-l-sm" onclick="editDasarHukum()" type="button" style="display: none">Edit</button>
										<button id="btn_save_dh" class="btn btn-primary  btn-xs" onclick="saveDasarHukum()" type="button" style="display: none">Save</button>
										<div id="dasar_hukumt" class="wrapper p-md">

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>
	</div>
</div>

<!--My Modal-->
<div class="modal inmodal" id="modal_wajib" tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content animated fadeIn">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="fa fa-keyboard-o modal-icon"></i>
				<h4 class="modal-title">Form Persyaratan Wajib</h4>
				<small></small>
			</div>
			<!-- <input type="hidden" id="id_syarat_hdr1" name="id_syarat_hdr1"> -->
			<form id="frm_wajib" name="frm_wajib" role="form" class="form-horizontal">
				<input type="hidden" id="id_syarat_hdr1" name="id_syarat_hdr1">
				<input type="hidden" id="mekanisme1" name="mekanisme1">
				<input type="hidden" id="dasar_hukum1" name="dasar_hukum1">
				<input type="hidden" id="id_permohonan1" name="id_permohonan">
				<input type="hidden" id="id_jenis_permohonan1" name="id_jenis_permohonan1">
				<input type="hidden" id="id_kojabf1" name="id_kojabf1">

			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">

							<input type="hidden" id="id_syarat_dtl1" name="id_syarat_dtl1">
							<input type="hidden" min="0" id="no_syarat1" name="no_syarat1" placeholder="" class="form-control">
							<div class="form-group">                        
								<label class="col-lg-3 control-label">Syarat Permohonan Wajib</label>
								<div class="col-lg-9">
	                                <select name="syarat_wajib[]" multiple="multiple" id="syarat_wajib" class="form-control">
	                                        <optgroup label="Pilih Syarat Permohonan Wajib">
	                                            <?php echo $menu_select; ?>
	                                        </optgroup>                                                   
	                                </select>
                                </div>                   
                            </div>

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!--End My Modal-->

<!--My Modal-->
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content animated fadeIn">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="fa fa-keyboard-o modal-icon"></i>
				<h4 class="modal-title">Form Persyaratan Opsional</h4>
				<small></small>
			</div>
			<input type="hidden" id="id_syarat_hdr0" name="id_syarat_hdr0">
			<form id="frm1" name="frm1" role="form" class="form-horizontal">
				<input type="hidden" id="id_syarat_hdr" name="id_syarat_hdr">
				<input type="hidden" id="mekanisme" name="mekanisme">
				<input type="hidden" id="dasar_hukum" name="dasar_hukum">
				<input type="hidden" id="id_permohonan" name="id_permohonan">
				<input type="hidden" id="id_jenis_permohonan" name="id_jenis_permohonan">
				<input type="hidden" id="id_kojabf" name="id_kojabf">

			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">

							<input type="hidden" id="id_syarat_dtl" name="id_syarat_dtl">
							<input type="hidden" min="0" id="no_syarat" name="no_syarat" placeholder="" class="form-control">
							<div class="form-group">

								<!-- <label class="col-lg-3 control-label">No. Urut</label>
								<div class="col-lg-4">
									<input type="number" min="0" id="no_syarat" name="no_syarat" placeholder="" class="form-control">
								</div> -->
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Keterangan</label>
								<div class="col-lg-9">
										<textarea id="ket_syarat" name="ket_syarat" rows="3" class="form-control"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-3 control-label">Inisial Nama File</label>
								<div class="col-lg-9">
									<input id="init_syarat" name="init_syarat" class="form-control" placeholder="Jika ada file yang harus diupload">
								</div>
							</div>

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!--End My Modal-->

<!-- Mainly scripts -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/jquery-2.1.1.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!-- Mainly scripts -->

<!-- Data Tables -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.responsive.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.tableTools.min.js"></script>

<!-- Data Tables -->

<!-- Custom and plugin javascript -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/inspinia.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/pace/pace.min.js"></script>
<!-- Custom and plugin javascript -->

<!-- Sweet alert -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>

<!-- AjaxForm -->
<script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>
<!-- Validation -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/boostrapvalidator/js/bootstrapValidator.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib-1.0.0.js"></script>

<!-- Chosen -->
<!--		<script src="--><?php //echo base_url(); ?><!--assets/js/plugins/chosen/chosen.jquery.js"></script>-->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/select2/select2.full.min.js"></script>

<!-- Data picker -->
<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- SUMMERNOTE -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/summernote/summernote.min.js"></script>

<!-- Multiple Select -->
<script src="<?php echo base_url(); ?>assets/js/plugins/multipleselect/jquery.multiselect.js"></script>
<!-- Multiple Select -->
        
<script type="text/javascript" language="javascript" >
	$(document).ready(function() {
		$('#syarat_wajib[multiple]').multiselect({
            columns: 1,            
            placeholder: '--- Pilih Syarat Permohonan Wajib ---',
            selectAll: true
        });
        
        $('a.ms-selectall').text('Pilih Semua');
        $('a.ms-selectall').click(function(){
            var value = $(this).text();
            if(value == 'Pilih Semua'){
                $(this).text('Batal Pilih');
            }else{
                $(this).text('Pilih Semua');
            }
        })

		$("#id_permohonans").select2({
			placeholder: "-- Pilih Permohonan--",
			ajax: {
				url: "<?php echo site_url($this->modul.'/getPermohonan')?>",
				dataType: 'json',
				delay: 5,
				processResults: function (data) {
					// parse the results into the format expected by Select2.
					// since we are using custom formatting functions we do not need to
					// alter the remote JSON data
					return {
						results: data
					};
				},
				cache: true
			},
			minimumInputLength: 0
		});

		$("#id_jenis_permohonans").select2({
			placeholder: "-- Pilih Jenis Permohonan--",
			allowClear: true
		});

		$("#id_kojabfs").select2({
			placeholder: "-- Pilih Jabatan --",
			ajax: {
				url: "<?php echo site_url($this->modul.'/getJabFung')?>",
				dataType: 'json',
				delay: 5,
				processResults: function (data) {
					// parse the results into the format expected by Select2.
					// since we are using custom formatting functions we do not need to
					// alter the remote JSON data
					return {
						results: data
					};
				},
				cache: true
			},
			minimumInputLength: 0
		});


		$('#id_permohonans').change(function(){
			setJnsPermohonan(this.value);
		});

		var dataTable = $('#t1').DataTable( {
			"bSort": false,
			responsive: true,
			"processing": true,
			"serverSide": true,
			"ajax":{
				url :"<?=site_url($this->modul.'/getPersyaratan')?>", // json datasource
				type: "post",  // method  , by default get
				"data": function ( d ) {
					// console.log(JSON.stringify(d))
					d.id_permohonan = $('#id_permohonans').val();
					d.id_jenis_permohonan = $('#id_jenis_permohonans').val();
					var value = $('#id_kojabfs').val();
					if(!value){
						d.id_kojabf=$('#id_kojabfs').val();
					}else{
						var value_splited = value.split('@');
						d.id_kojabf=value_splited[0],
						d.golru=value_splited[1]	
					}
				},
				error: function(){  // error handling
					$(".employee-grid-error").html("");
					$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="7">Terjadi kesalahan. Coba di refresh kembali atau hubungi admin anda.</th></tr></tbody>');
					$("#employee-grid_processing").css("display","none");
				}
			},
			"language": {
				"processing": "Sedang proses",
				"lengthMenu": "_MENU_ baris per halaman",
				"search": "Cari",
				"zeroRecords": "Data tidak ditemukan",
				"info": "Tampil _START_ to _END_ dari _TOTAL_",
				"infoEmpty": "",
				"paginate": {
					"first": "Pertama",
					"last": "Terakhir",
					"previous": "Sebelumnya",
					"next": "Selanjutnya",
				}
			}
		} );
		$('#t1_filter').hide();//hide

		$('#btn_cari').click(function(){
			var value = $('#id_kojabfs').val();
			var value_splited = value.split('@');
			// console.log(value_splited[0] + ' ' + value_splited[1]);return false;
			$.post("<?php echo site_url($this->modul.'/getHdr')?>",{
				id_permohonan:$('#id_permohonans').val(),
				id_jenis_permohonan:$('#id_jenis_permohonans').val(),
				// id_kojabf:$('#id_kojabfs').val(),
				id_kojabf:value_splited[0],
				golru:value_splited[1]
			}, function(data, status){
				// console.log(JSON.stringify(data))
				
				if (data != null){
					$('#id_syarat_hdr0').val(data.ID_SYARAT_HDR);
					$('#id_syarat_hdr').val(data.ID_SYARAT_HDR);
					$('#mekanisme').val(data.MEKANISME);
					$('#dasar_hukum').val(data.DASAR_HUKUM);
					$('#mekanismet').html(data.MEKANISME);
					$('#dasar_hukumt').html(data.DASAR_HUKUM);
				} else {
					$('#id_syarat_hdr0').val('');
					$('#id_syarat_hdr').val('');
					$('#mekanisme').val('');
					$('#dasar_hukum').val('');
					$('#mekanismet').html('');
					$('#dasar_hukumt').html('');
				}

			},"json");

			var t1 = $('#t1').DataTable();
			t1.ajax.reload();
			$('#btn_tbh1').show();
			$('#btn_tbh_wajib').show();
			$('#btn_edit_me').show();
			$('#btn_edit_dh').show();
			$('#btn_save_me').show();
			$('#btn_save_dh').show();

			
		});

		$('#btn_tbh1').click(function(){
			$('#frm1')[0].reset();
			$('#id_syarat_dtl').val('');
			id_permohonan=$('#id_permohonans').val();
			id_jenis_permohonan=$('#id_jenis_permohonans').val();
			id_kojabf=$('#id_kojabfs').val();
			if (id_permohonan==null){
				sweetAlert("Oops...", "Permohonan harus diisi!");
			} else {
				if (id_jenis_permohonan==null){
					sweetAlert("Oops...", "Jenis permohonan harus diisi!");
				} else {
					if (id_permohonan==1 && id_kojabf==null){
						sweetAlert("Oops...", "Jabatan harus diisi!");
					} else {
						$('#myModal').modal('show');
						var test = $('#t1 tr:last').text();
						if($.isNumeric(test[0]) && $.isNumeric(test[1])){
							$('#no_syarat').val(+test[0] + +test[1]);	
						}else{
							$('#no_syarat').val(++test[0]);
						}
					}
				}
			}

		});

		$('#btn_tbh_wajib').click(function(){
			$('#id_syarat_dtl').val('');
			id_permohonan=$('#id_permohonans').val();
			id_jenis_permohonan=$('#id_jenis_permohonans').val();
			id_kojabf=$('#id_kojabfs').val();

			if (id_permohonan==null){
				sweetAlert("Oops...", "Permohonan harus diisi!");
			} else {
				if (id_jenis_permohonan==null){
					sweetAlert("Oops...", "Jenis permohonan harus diisi!");
				} else {
					if (id_permohonan==1 && id_kojabf==null){
						sweetAlert("Oops...", "Jabatan harus diisi!");
					} else {
						$('#modal_wajib').modal('show');
						var test = $('#t1 tr:last').text();
						if($.isNumeric(test[0]) && $.isNumeric(test[1])){
							$('#no_syarat').val(+test[0] + +test[1]);	
						}else{
							$('#no_syarat').val(++test[0]);
						}
					}
				}
			}

		});


		//Validation
		$("#frm1").bootstrapValidator({
			live: 'disabled',
			excluded : 'disabled',
			message: 'This value is not valid',
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				/*no_syarat: {
					validators: {
						notEmpty: {
							message: 'Harus diisi'
						}
					}
				},*/
				ket_syarat: {
					validators: {
						notEmpty: {
							message: 'Harus diisi'
						}
					}
				}
			}
		});

		$("#frm1").ajaxForm({
			url: "<?php echo site_url($this->modul.'/getForm')?>",
			type: "post",
			dataType: "json",
			beforeSerialize:function($form, options)
			{
				id_permohonans = $('#id_permohonans').val();
				id_jenis_permohonans = $('#id_jenis_permohonans').val();
				id_kojab_tmp = $('#id_kojabfs').val();
				var id_kojabfs = id_kojab_tmp.split('@');

				mekanisme= $('#mekanismet').code();
				dasar_hukum= $('#dasar_hukumt').code();
				$('#id_permohonan').val(id_permohonans);
				$('#id_jenis_permohonan').val(id_jenis_permohonans);
				$('#id_kojabf').val(id_kojabfs[0]);
				$('#mekanisme').val(id_permohonans);
				$('#dasar_hukum').val(id_jenis_permohonans);
			},
			beforeSubmit: function(arr, jqForm, options){
				var test = validate(arr, jqForm, options)
				if(test == false){
					sweetAlert("Oops...", "Inisial Nama File sudah digunakan. Harap ganti dengan nama lain.", "error");
					return false;
				}
				// console.log(test);return false;
			},
			success: function (data, status) {
				if (data.success) {
//					$("#frm1").resetForm();
//					$("#frm1").data('bootstrapValidator').resetForm();
					

					$("#myModal").modal('hide');
					swal("Kerja Bagus!", data.msg, "success");
					var t1 = $('#t1').DataTable();
					t1.ajax.reload();
				} else {
					sweetAlert("Oops...", data.msg, "error");
				}
			}
		});

		$("#frm_wajib").ajaxForm({
			url: "<?php echo site_url($this->modul.'/getForm')?>",
			type: "post",
			dataType: "json",
			data: {

			},
			beforeSerialize:function($form, options)
			{	
				if($('#syarat_wajib').val() != null){
					id_permohonans = $('#id_permohonans').val();
					id_jenis_permohonans = $('#id_jenis_permohonans').val();
					id_kojabfs = $('#id_kojabfs').val();
					mekanisme= $('#mekanismet').code();
					dasar_hukum= $('#dasar_hukumt').code();

					$('#id_permohonan1').val(id_permohonans);
					$('#id_jenis_permohonan1').val(id_jenis_permohonans);
					$('#id_kojabf1').val(id_kojabfs);
					$('#mekanisme1').val(id_permohonans);
					$('#dasar_hukum1').val(id_jenis_permohonans);
				}else{
					return false;
				}
			},
			success: function (data, status) {
				if (data.success) {
//					$("#frm1").resetForm();
//					$("#frm1").data('bootstrapValidator').resetForm();
					

					$("#modal_wajib").modal('hide');
					swal("Kerja Bagus!", data.msg, "success");
					var t1 = $('#t1').DataTable();
					t1.ajax.reload();
				} else {
					sweetAlert("Oops...", data.msg, "error");
				}
			}
		});

	} );

	function validate(formData, jqForm, options) {
		var form = jqForm[0];
		var result;
		if(!form.id_syarat_hdr){
			$.post("<?php echo site_url($this->modul.'/validInitSyarat')?>",{
				init_syarat:form.init_syarat.value
			}, function(data){
				check_init_syarat(data);
				// result = check_init_syarat(data.success);
			},"json");
		}else{
			$.post("<?php echo site_url($this->modul.'/validInitSyarat')?>",{
				init_syarat:form.init_syarat.value, id_syarat_hdr:form.id_syarat_hdr.value
			}, function(data){
				check_init_syarat(data);
				// result = check_init_syarat(data.success);
			},"json");
		}

	}

	function check_init_syarat(result){
		// console.log(result.success)
		if(result.success == 'true'){
			return false;
		}
	}

	function setJnsPermohonan(id_permohonan){
		$("#id_jenis_permohonans").select2({
			placeholder: "-- Pilih Jenis Permohonan--",
			ajax: {
				url: "<?php echo site_url($this->modul.'/getJnsPermohonan')?>",
				type:'post',
				dataType: 'json',
				delay: 5,
				data: function(params){
					return{
						q: params.term,
					id_permohonan: id_permohonan // search term	
					};
					
				},
				processResults: function (data) {
					// parse the results into the format expected by Select2.
					// since we are using custom formatting functions we do not need to
					// alter the remote JSON data
					return {
						results: data
					};
				},
				cache: true
			}
		});

	}

	function editMekanisme() {
		$('#mekanismet').summernote({focus: true});
	}

	function saveMekanisme() {
		var aHTML = $('#mekanismet').code(); //save HTML If you need(aHTML: array).
		$('#mekanismet').destroy();

		saveHdr();
	}

	function editDasarHukum() {
		$('#dasar_hukumt').summernote({focus: true});
	}

	function saveDasarHukum() {
		var aHTML = $('#dasar_hukumt').code(); //save HTML If you need(aHTML: array).
		$('#dasar_hukumt').destroy();
		saveHdr();
	}

	function saveHdr(){
		alert($('#id_syarat_hdr0').val());
		$.post("<?php echo site_url($this->modul.'/simpanHdr')?>",{
			id_syarat_hdr:$('#id_syarat_hdr0').val(),

			id_permohonan:$('#id_permohonans').val(),
			id_jenis_permohonan:$('#id_jenis_permohonans').val(),
			id_kojabf:$('#id_kojabfs').val(),
			mekanisme : $('#mekanismet').code(),
			dasar_hukum : $('#dasar_hukumt').code()
		}, function(data, status){
			if (data.success){
				swal("Kerja Bagus!", data.msg, "success");
				$('#id_syarat_hdr0').val(data.id);
				$('#id_syarat_hdr').val(data.id);
			} else {
				sweetAlert("Oops...", data.msg, "error");
			}
		},"json");
	}

	function editSyarat(no_syarat,id,tr){
		$('#myModal').find('h4').text('Edit Form Persyaratan')
		id_permohonan=$('#id_permohonans').val();
		id_jenis_permohonan=$('#id_jenis_permohonans').val();
		id_kojabf=$('#id_kojabfs').val();


		if (id_permohonan==null){
			sweetAlert("Oops...", "Permohonan harus diisi!");
		} else {
			if (id_jenis_permohonan==null){
				sweetAlert("Oops...", "Jenis permohonan harus diisi!");
			} else {
				if (id_permohonan==1 && id_kojabf==null){
					sweetAlert("Oops...", "Jabatan harus diisi!");
				} else {
					var t1 = $('#t1').DataTable();
					var data = t1.row( tr ).data();
//					console.log(data);
//					swal("Kerja Bagus!", data[0], "success");
					$('#id_syarat_dtl').val(id);
					$('#no_syarat').val(data[0]);
					// $('#no_syarat').val(tr);
					$('#ket_syarat').val(data[1]);
					$('#init_syarat').val(data[2]);
					$('#myModal').modal('show');
				}
			}
		}
	}

	function delSyarat(id){
		/*START SWEETALERT*/
		swal({
			title: "Anda yakin hapus data ini?",
			text: "Data tidak akan dapat dikembalikan setelah dihapus!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Ya, hapus!",
			cancelButtonColor: "#F8AC59",
			cancelButtonText: "Tidak, batalkan!",
			closeOnConfirm: false
		}, function (isConfirm) {
			if (isConfirm) {
				$.post("<?php echo site_url($this->modul.'/hapusSyarat')?>",{
					id_syarat_dtl:id
				}, function(data, status){
					if (data.success){
						swal("Kerja Bagus!", data.msg, "success")
						var t1 = $('#t1').DataTable();
						t1.ajax.reload();
					} else {
						sweetAlert("Oops...", data.msg, "error");
					}
				},"json");
			}
		});
		/*END SWEETALERT*/
	}

</script>