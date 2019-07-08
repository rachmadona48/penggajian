<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Jabatan Fungsional</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('subbid')?>">Home</a>
            </li>
            <li class="active">
                <strong>Jabatan Fungsional</strong>
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
					<h5>Daftar Jabatan Fungsional 144</h5>
				</div>
				<div class="ibox-content">
					<button id="btn_tbh1" class="btn btn-primary pull-right">Tambah</button>
					<table id="t1" class="table table-striped table-bordered table-hover dataTables-example" >
						<thead>
						<tr>
							<th style="width:5%">No</th>
							<th>Nama Jabatan Fungsional</th>
							<th>Tingkat</th>
							<th>Jenjang Jabatan</th>
							<th>Batas Usia Pensiun</th>
							<th>Batas Usia Pengangkatan</th>
							<th>Gol. Ruang</th>
							<th>Jabatan</th>
							<th style="width:15%">Aksi</th>
						</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
		</div>
    </div>
</div>

<!--My Modal-->
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated fadeIn">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<!--				<i class="fa fa-keyboard-o modal-icon"></i>-->
				<h4 class="modal-title">Form Jabatan Fungsional</h4>
				<small></small>
			</div>
			<input type="hidden" id="id_syarat_hdr0" name="id_syarat_hdr0">
			<form id="frm1" name="frm1" role="form" class="form-horizontal">
				<input type="hidden" id="kojab0" name="kojab0">
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label class="col-lg-3 control-label">Nama Jabatan Fungsional</label>
							<div class="col-lg-9">
								<input id="najabl" name="najabl" class="form-control"></input>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Tingkat</label>
							<div class="col-lg-9">
								<select id="tingkat" name="tingkat" class='form-control chosen-jenis'>
									<option value=""></option>
									<?php foreach($tingkat as $row): ?>
										<option value="<?php echo $row->ID_TINGKAT ?>"><?php echo $row->NM_TINGKAT ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Jenjang Jabatan</label>
							<div class="col-lg-9">
								<select id="jenjab" name="jenjab" class='form-control chosen-jenis'>
									<option value=""></option>
									<?php foreach($jenjab as $row): ?>
										<option value="<?php echo $row->ID_JENJAB ?>"><?php echo $row->NM_JENJAB ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Batas Usia Pensiun</label>
							<div class="col-lg-3">
								<input type="number" min="1" max="99" id="usia_pensiun" name="usia_pensiun" class="form-control" maxlength="2"></input>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Batas Usia Pengangkatan</label>
							<div class="col-lg-3">
								<input type="number" min="1" max="99" id="usia_pengangkatan" name="usia_pengangkatan" class="form-control" maxlength="2"></input>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label">Golongan Ruang</label>
							<div class="col-lg-9">
								<select id="golru" name="golru" class='form-control chosen-jenis'>
									<option value=""></option>
									<?php foreach($golru as $row): ?>
										<option value="<?php echo $row->KOPANG ?>"><?php echo $row->GOL ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
								<label class="col-lg-3 control-label">Jabatan</label>
								<div class="col-lg-9">
									<select class='form-control chosen-jenis' name='kojab' id='kojab' data-placeholder='Cari...'>
										<option value=""></option>
										<?php foreach($kojab as $row): ?>
											<option value="<?php echo $row->KOJAB ?>"><?php echo $row->KOJAB.' - '.$row->NAJABL ?></option>
										<?php endforeach; ?>
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
		<script src="<?php echo base_url(); ?>assets/js/plugins/chosen/chosen.jquery.js"></script>
<!--<script src="--><?php //echo base_url(); ?><!--assets/inspinia/js/plugins/select2/select2.full.min.js"></script>-->

<!-- Data picker -->
<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- SUMMERNOTE -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/summernote/summernote.min.js"></script>
        
<script type="text/javascript" language="javascript" >
	$(document).ready(function() {
//		$("#kojab").select2({
//			placeholder: "-- Pilih Jabatan --",
//			ajax: {
//				url: "<?php //echo site_url($this->modul.'/getJabFungref')?>//",
//				dataType: 'json',
//				delay: 5,
//				processResults: function (data) {
//					// parse the results into the format expected by Select2.
//					// since we are using custom formatting functions we do not need to
//					// alter the remote JSON data
//					return {
//						results: data
//					};
//				},
//				cache: true
//			},
//			minimumInputLength: 0
//		});

		var dataTable = $('#t1').DataTable( {
			"bSort": false,
			responsive: false,
			"processing": true,
			"scrollX": false,
			"serverSide": true,
			"ajax":{
				url :"<?=site_url($this->modul.'/getAll')?>", // json datasource
				type: "post",  // method  , by default get
				"data": function ( d ) {
					d.id_permohonan = $('#id_permohonans').val();
					d.id_jenis_permohonan = $('#id_jenis_permohonans').val();
					d.id_kojabf = $('#id_kojabfs').val();
				},
				error: function(){  // error handling
					$(".t1-error").html("");
					$("#t1").append('<tbody class="employee-grid-error"><tr><th colspan="7">Terjadi kesalahan. Coba di refresh kembali atau hubungi admin anda.</th></tr></tbody>');
					$("#t1_processing").css("display","none");
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

	$('#btn_tbh1').click(function(){
		$('#kojab0').val('');
		$('#kojab').val('');
		$('#najabl').val('');
		$('#myModal').modal('show');
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
			kojab: {
				validators: {
					notEmpty: {
						message: 'Harus diisi'
					}
				}
			},
			najabl: {
				validators: {
					notEmpty: {
						message: 'Harus diisi'
					}
				}
			},
			tingkat: {
				validators: {
					notEmpty: {
						message: 'Harus diisi'
					}
				}
			},
			jenjab: {
				validators: {
					notEmpty: {
						message: 'Harus diisi'
					}
				}
			},
			usia_pensiun: {
				validators: {
					notEmpty: {
						message: 'Harus diisi'
					}
				}
			},
			golru: {
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
		success: function (data, status) {
			if (data.success) {
					$("#frm1").resetForm();
					$("#frm1").data('bootstrapValidator').resetForm();

				$("#myModal").modal('hide');
				swal("Kerja Bagus!", data.msg, "success");
				var t1 = $('#t1').DataTable();
				t1.ajax.reload();
			} else {
				sweetAlert("Oops...", data.msg, "error");
			}
		}
	});

		/*START CHOSEN*/
		var config = {
			'.chosen-jenis'           : {no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
		}
		for (var selector in config) {
			$(selector).chosen(config[selector]);
		}
		/*END CHOSEN*/

		$('#tingkat').change(function(){
			$.post("<?php echo site_url($this->modul.'/getJenjab')?>",{
				tingkat: this.value
			}, function(data){
				$('#jenjab').html(data);
				$('select').trigger("chosen:updated");
			});
		});

		$('#jenjab').change(function(){
			$.post("<?php echo site_url($this->modul.'/getGolru')?>",{
				jenjab: this.value
			}, function(data){
				$('#golru').html(data);
				$('select').trigger("chosen:updated");
			});
		});

	});

	function edit(id,tingkat,jenjab,golru,najabl,usia_pensiun,usia_pengangkatan){
//		console.log(tr);
		$('#kojab0').val(id);
		$('#najabl').val(najabl);
		$('#tingkat').val(tingkat);
		$('#jenjab').val(jenjab);
		$('#usia_pensiun').val(usia_pensiun);
		$('#usia_pengangkatan').val(usia_pengangkatan);
		$('#golru').val(golru);
		$('#kojab').val(id);

		$('select').trigger("chosen:updated");

		$('#myModal').modal('show');
	}

	function del(id){
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
				$.post("<?php echo site_url($this->modul.'/hapus')?>",{
					id:id
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