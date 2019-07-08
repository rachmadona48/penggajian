<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Master Permohonan</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('subbid')?>">Home</a>
            </li>
            <li class="active">
                <strong>Master Permohonan</strong>
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
					<h5>Daftar Master Permohonan</h5>
				</div>
				<div class="ibox-content">
					<div class="row">
						<div class="col-md-12">
					<button id="btn_tbh1" class="btn btn-primary pull-right">Tambah</button>
					<table id="t1" class="table table-striped table-bordered table-hover dataTables-example">
						<thead>
						<tr>
							<th style="width:5%">No</th>
							<th>Nama Permohonan</th>
							<th>Detil</th>
							<th style="width:5%">Aksi</th>
						</tr>
						</thead>
						<tbody>
						<div id="t1_proses"></div>
						</tbody>
					</table>
							</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<h4>Jenis Permohonan</h4>
							<label id="nm_permohonan"></label>
							<button id="btn_tbh2" class="btn btn-primary pull-right" style="display: none">Tambah</button>
							<table id="t2" class="table table-striped table-bordered table-hover dataTables-example">
								<thead>
								<tr>
									<th width="5%">No</th>
									<th>Jenis Permohonan</th>
									<th width="5%">Aksi</th>
								</tr>
								</thead>
								<tbody>
									<div id="t2_proses"></div>
								</tbody>
							</table>
						</div>
					</div>

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
				<i class="fa fa-keyboard-o modal-icon"></i>
				<h4 class="modal-title">Form Permohonan</h4>
				<small></small>
			</div>
			<input type="hidden" id="id_syarat_hdr0" name="id_syarat_hdr0">
			<form id="frm1" name="frm1" role="form">
				<input type="hidden" id="id_permohonan" name="id_permohonan">
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
								<label class="control-label">Nama Permohonan</label>
								<div>
									<textarea id="ket_permohonan" name="ket_permohonan" rows="3" class="form-control"></textarea>
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

<div class="modal inmodal" id="modalDtl" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated fadeIn">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<i class="fa fa-keyboard-o modal-icon"></i>
				<h4 class="modal-title">Form Jenis Permohonan</h4>
				<small></small>
			</div>
			<input type="hidden" id="id_syarat_hdr0" name="id_syarat_hdr0">
			<form id="frm2" name="frm2" role="form">
				<input type="hidden" id="id_permohonan2" name="id_permohonan2">
				<input type="hidden" id="id_jenis_permohonan" name="id_jenis_permohonan">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">
							<label class="control-label">Jenis Permohonan</label>
							<div>
								<textarea id="ket_jenis_permohonan" name="ket_jenis_permohonan" rows="3" class="form-control"></textarea>
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

		var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';
		var dataTable = $('#t1').DataTable( {
			destroy: true,
			responsive: false,
			"bSort": false,
			"dom": 'B<"top"f<"#nmdet1">>rt<"bottom"ip><"clear">',
			"scrollX": false,
			"serverSide": true,
			"ajax":{
				url :"<?=site_url($this->modul.'/getAll')?>", // json datasource
				type: "post",  // method  , by default get
				"data": function ( d ) {

				},
				beforeSend: function() {
					$("#t1_proses").html(spinner);
				},
				complete: function()
				{
					$("#t1_proses").html('');
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


//            $('#t2').hide();

		var t2= $('#t2').DataTable({
			destroy: true,
			responsive: false,
			"bSort": false,
			"dom": 'B<"top"f<"#nmdet1">>rt<"bottom"ip><"clear">',
			"scrollX": false,
			"serverSide": true,
			"ajax": {
				url: '<?php echo site_url($this->modul."/getDataTrxDtl"); ?>',
				type: "post",
				data: function ( d ) {
					d.id_permohonan = $('#id_permohonan2').val();
				},
				beforeSend: function() {
					$("#t2_proses").html(spinner);
				},
				complete: function()
				{
					$("#t2_proses").html('');
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

		});
		$('#t2_filter').css("display","none");//hide filtering

	$('#btn_tbh1').click(function(){
		$('#id_permohonan').val('');
		$('#ket_permohonan').val('');
		$('#myModal').modal('show');
	});

		$('#btn_tbh2').click(function(){
			$('#id_jenis_permohonan').val('');
			$('#ket_jenis_permohonan').val('');
			$('#modalDtl').modal('show');
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
			ket_permohonan: {
				validators: {
					notEmpty: {
						message: 'Harus diisi'
					}
				}
			}		}
	});

	$("#frm1").ajaxForm({
		url: "<?php echo site_url($this->modul.'/getForm')?>",
		type: "post",
		dataType: "json",
		success: function (data, status) {
			if (data.success) {
				$("#myModal").modal('hide');
				swal("Kerja Bagus!", data.msg, "success");
				var t1 = $('#t1').DataTable();
				t1.ajax.reload();
			} else {
				sweetAlert("Oops...", data.msg, "error");
			}
		}
	});

		//Validation
		$("#frm2").bootstrapValidator({
			live: 'disabled',
			excluded : 'disabled',
			message: 'This value is not valid',
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				ket_jenis_permohonan: {
					validators: {
						notEmpty: {
							message: 'Harus diisi'
						}
					}
				}		}
		});

		$("#frm2").ajaxForm({
			url: "<?php echo site_url($this->modul.'/getFormDtl')?>",
			type: "post",
			dataType: "json",
			success: function (data, status) {
				if (data.success) {
					$("#modalDtl").modal('hide');
					swal("Kerja Bagus!", data.msg, "success");
					var t2 = $('#t2').DataTable();
					t2.ajax.reload();
				} else {
					sweetAlert("Oops...", data.msg, "error");
				}
			}
		});

	});

	function edit(id,tr){
//		console.log(tr);
		var t1 = $('#t1').DataTable();
		var data = t1.row( tr ).data();
//					console.log(data);
//					swal("Kerja Bagus!", data[0], "success");
		$('#id_permohonan').val(id);
		$('#ket_permohonan').val(data[1]);

		$('#myModal').modal('show');
	}

	function editDtl(id,tr){
		console.log(id);
		var t2 = $('#t2').DataTable();
		var data = t2.row( tr ).data();
//					console.log(data);
//					swal("Kerja Bagus!", data[0], "success");
		$('#id_jenis_permohonan').val(id);
		$('#ket_jenis_permohonan').val(data[1]);

		$('#modalDtl').modal('show');
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

	function setT2(id_permohonan,ket_permohonan){
		$("#id_permohonan2").val(id_permohonan);

		$("#nm_permohonan").text(' Permohonan: '+ket_permohonan);
		$('#btn_tbh2').show();
		$('#t2').show();
		var t2 = $('#t2').DataTable();
		t2.ajax.reload();
		$('html, body').animate({
			scrollTop: $("#t2_proses").offset().top -100
		}, 'slow');
	}
</script>