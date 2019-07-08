<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Lacak Permohonan</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('subbid')?>">Home</a>
            </li>
            <li class="active">
                <strong>Lacak Permohonan</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/select2/select2.min.css" rel="stylesheet">
<style>
	.modal .modal-body {
		max-height: 420px;
		overflow-y: auto;
	}
</style>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
				<div class="ibox-title navy-bg">
					<h5>Daftar Permohonan</h5>
				</div>
				<div class="ibox-content">
					<table id="t1" class="table table-striped table-bordered table-hover dataTables-example" >
						<thead>
						<tr>
							<th style="width:5%">No</th>
							<th>Permohonan</th>
							<th>Jenis Permohonan</th>
							<th>No. Surat</th>
							<th>Tgl. Surat</th>
                            <th>Tgl. Permohonan</th>
							<th>NRK</th>
							<th>Nama</th>
							<th>Golongan</th>
							<th>Jabatan yang Diajukan</th>
							<th>Status</th>
							<th>Detil</th>
						</tr>
						</thead>
						<tbody>
							<td colspan="11" align="center" id="t1_proses"></td>
						</tbody>
					</table>
				</div>
			</div>
		</div>
    </div>
</div>
<!--My Modal-->
<div class="modal" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog" id="tracking">
		<div class="modal-content animated fadeIn">
			<div class="modal-header">
				<p class="m-b-xs"><strong>Header</strong></p>
			</div>
			<div class="modal-body">
				<div class="ibox-content" id="tracking">
					<!-- <div class="timeline-item">
						<div class="row">
							<div class="col-xs-3 date">
								<i class="fa fa-briefcase"></i>
							</div>
							<div class="col-xs-7 content no-top-border">
								<p class="m-b-xs"><strong>Meeting</strong></p>

								<p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products.</p>

							</div>
						</div>
					</div>
					<div class="timeline-item">
						<div class="row">
							<div class="col-xs-3 date">
								<i class="fa fa-file-text"></i>
							</div>
							<div class="col-xs-7 content">
								<p class="m-b-xs"><strong>Send documents to Mike</strong></p>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
							</div>
						</div>
					</div>
					<div class="timeline-item">
						<div class="row">
							<div class="col-xs-3 date">
								<i class="fa fa-phone"></i>
							</div>
							<div class="col-xs-7 content">
								<p class="m-b-xs"><strong>Phone with Jeronimo</strong></p>
								<p>
									Lorem Ipsum has been the industry's standard dummy text ever since.
								</p>
							</div>
						</div>
					</div> -->
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
			</div>
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
        
<script type="text/javascript" language="javascript" >
	$(document).ready(function() {
		var spinner = '<div class="sk-spinner sk-spinner-wave"><div class="sk-rect1"></div><div class="sk-rect2"></div><div class="sk-rect3"></div><div class="sk-rect4"></div><div class="sk-rect5"></div></div>';
		var dataTable = $('#t1').DataTable( {
			"bSort": false,
			"dom": 'B<"top"<"#nmdet1">>rt<"bottom"ip><"clear">',
			responsive: false,
			"processing": false,
			"scrollX": true,
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
                    // cekStatus();
				},
				error: function(){  // error handling
					$(".t1-error").html("");
					$("#t1").append('<tbody class="employee-grid-error"><tr><th colspan="7">Terjadi kesalahan. Coba di refresh kembali atau hubungi admin anda.</th></tr></tbody>');
					$("#t1_processing").css("display","none");
				}
			},"initComplete": function() {
				var $searchInput = $('div.dataTables_filter input');

				$searchInput.unbind();

				$searchInput.bind('keyup', function(e) {
					if(e.keyCode == 13) {
						dataTable.search( this.value ).draw();
					}
				});
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

	});

	// function lihatStatus(id_trx,id_trx_hdr,tr){
	// 	$.post("<?php echo site_url($this->modul)?>/trackingPermohonan",{
	// 		id_trx: id_trx,
	// 		id_trx_hdr: id_trx_hdr
	// 	},function(data){
	// 		$("#tracking").html(data);
	// 		$("#NRK").val(data.NRK);
	// 	})
	// 	$("#myModal").modal('show');
	// }

    function cekStatus(){
        var asd = $('#t1 > tbody > tr > td:eq(10)').text();
        if($.trim(asd) == 'Ditolak SKPD'){
            // $(asd).parent().css('background-color','blue');
            $('#t1 > tbody > tr > td:eq(3)').text($.trim(asd).toUpperCase());
            $('#t1 > tbody > tr > td:eq(4)').text($.trim(asd).toUpperCase());
        }
    }

	function lihatStatus(id_trx,id_trx_hdr,tr){
		$.post("<?php echo site_url($this->modul)?>/trackingPermohonan",{
			id_trx: id_trx,
			id_trx_hdr: id_trx_hdr
		},
		function(data){
			$("#tracking").html(data);
			$("#NRK").val(data.NRK);
			

			// if(data.respone == 'SUKSES'){
   //                  $("#NRK").val(data.NRK);
   //              }else{
                    
   //              }

		})
		$("#myModal").modal('show');
	}

	function ieditBadan(BadanID){
        var url = "<?php echo site_url('badan_usaha/EditBadan')?>";
        $.ajax({
            url: url,
            type: "POST",            
            data: {'BadanID':BadanID},
            dataType: 'json',
            beforeSend: function() {                                
                resetForm();
            },
            success: function(data) {                               
                
                if(data.respone == 'SUKSES'){
                    $("#BadanID").val(data.BadanID);
                    $("#NamaPT").val(data.NamaPT);
                    $("#no_siup").val(data.no_siup);
                    $("#no_tdp").val(data.no_tdp);
                    $("#jenis").val(data.jenis);
                    $("#provinsi").val(data.provinsi);
                    $("#kota").val(data.KabupatenID);
                    $("#alamat").val(data.alamat);
                    $("#nama_kontak").val(data.nama_kontak);
                    $("#No_tlp").val(data.No_tlp);
                    $("#email").val(data.email);
                    $("#email").val(data.email);
                    $("#usergroup").val(data.usergroup);
                    $("#action").val('edit');
                                       
                   
                }else{
                    
                }
            },
            error: function(xhr) {                              
                
            },
            complete: function() {              
                
            }
        });
    }

	function ieditBadan(BadanID){
        var url = "<?php echo site_url('badan_usaha/EditBadan')?>";
        $.ajax({
            url: url,
            type: "POST",            
            data: {'BadanID':BadanID},
            dataType: 'json',
            beforeSend: function() {                                
                resetForm();
            },
            success: function(data) {                               
                
                if(data.respone == 'SUKSES'){
                    $("#BadanID").val(data.BadanID);
                    $("#NamaPT").val(data.NamaPT);
                    $("#no_siup").val(data.no_siup);
                    $("#no_tdp").val(data.no_tdp);
                    $("#jenis").val(data.jenis);
                    $("#provinsi").val(data.provinsi);
                    $("#kota").val(data.KabupatenID);
                    $("#alamat").val(data.alamat);
                    $("#nama_kontak").val(data.nama_kontak);
                    $("#No_tlp").val(data.No_tlp);
                    $("#email").val(data.email);
                    $("#email").val(data.email);
                    $("#usergroup").val(data.usergroup);
                    $("#action").val('edit');
                                       
                   
                }else{
                    
                }
            },
            error: function(xhr) {                              
                
            },
            complete: function() {              
                
            }
        });
    }

</script>
