<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Pegawai
		</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Master</a>
            </li>
            <li class="active">
                <strong>Pegawai</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<style type="text/css">
	
	input.form-control {
	  width: auto;
	}

</style>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title navy-bg">
					<h5>Daftar Pegawai</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="fa fa-wrench"></i>
						</a>
						<ul class="dropdown-menu dropdown-user">
							<li><a href="#">Config option 1</a>
							</li>
							<li><a href="#">Config option 2</a>
							</li>
						</ul>
						<a class="close-link">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					<table id="tbl-grid" class="table table-striped table-bordered table-hover dataTables-example" >
						<thead>
						<tr>
							<th style="width:20px; text-align: center;">No</th>
							<th style="width:100px; text-align: center;">NRK</th>
							<th style="width:100px; text-align: center;">Nama</th>
							<th style="width:100px; text-align: center;">Jabatan</th>
							<th style="width:100px; text-align: center;">Tempat Lahir</th>
							<th style="width:100px; text-align: center;">Tgl. Lahir</th>
							<th style="width:50px; text-align: center;">Aksi</th>
						</tr>
						</thead>
						<tbody></tbody>
						<tfoot>
						<tr>
							<th style="width:20px; text-align: center;">No</th>
							<th style="width:100px; text-align: center;">NRK</th>
							<th style="width:100px; text-align: center;">Nama</th>
							<th style="width:100px; text-align: center;">Jabatan</th>
							<th style="width:100px; text-align: center;">Tempat Lahir</th>
							<th style="width:100px; text-align: center;">Tgl. Lahir</th>
							<th style="width:50px; text-align: center;">Aksi</th>
						</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


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

        <!-- Validation -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/boostrapvalidator/js/bootstrapValidator.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib-1.0.0.js"></script>

		<!-- Chosen -->
		<script src="<?php echo base_url(); ?>assets/js/plugins/chosen/chosen.jquery.js"></script>

		<!-- Data picker -->
		<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
        
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {

				var config = {
					'.chosen-select'           : {},
					'.chosen-select-deselect'  : {allow_single_deselect:true},
					'.chosen-select-no-single' : {disable_search_threshold:10},
					'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
					'.chosen-select-width'     : {width:"95%"}
				}
				for (var selector in config) {
					$(selector).chosen(config[selector]);
				}

				var dataTable = $('#tbl-grid').DataTable( {
					"aoColumns": [
						{ "bSortable": false },
						null,
						null,
						null,
						null,
						null,
						{ "bSortable": false }
					],
					responsive: true,
					"processing": true,
					"serverSide": true,
					"language": {
						"processing": "<div></div><div></div><div></div><div></div><div></div>"
					},
					"ajax":{
						url :"<?=site_url('riwayat/dataList')?>", // json datasource
						type: "post",  // method  , by default get
						"data": function ( d ) {
							d.nrkp = '<?php echo $nrk;?>';
						},
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
						}
					}
				} );
				$('#tbl-grid_filter').css("display","none");//hide
				
			} );

				function cari()
				{
					//var dataTable = $('#tbl-grid').DataTable();
					$('#tbl-grid').DataTable().ajax.reload();
				}

		</script>


