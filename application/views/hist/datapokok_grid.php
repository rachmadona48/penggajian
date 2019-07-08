<style type="text/css">
	.panel, .ibox{
          text-decoration: none;
          outline: none;                
          border: none;
          border-radius: 5px;
          box-shadow: 2px 2px 3px 3px #999;  
        }	
</style>

<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Data Pegawai per SPMU</h2>
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
				<div class="ibox-title">
					<span class="label label-warning pull-right"><?=$tgl?></span>
					<h5>Data Pegawai per SPMU</h5>
				</div>
				<div class="ibox-content">
					<form role="form" action="#" method="POST" class="form-inline" return="false">
						<label>SPMU :</label>
						<div class="input-group">
							<select name="spmu" id="spmu" data-placeholder="Pilih Nama SPMU..." class="chosen-select" style="width:350px;" tabindex="2">
							<option value=""></option>
							<?php								
								echo isset($spmu) ? $spmu : "";
							?>
							</select>
						</div>
						<div class="form-group" id="data_4">
							<label>TANGGAL :</label>
							<div class="input-group date">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="text" name="tglpilih" readonly="true" id="tglpilih" class="form-control" value="">
							</div>
						</div>
						<div class="input-group">
							<span><input type="button" name="enter" value="Go" class="btn btn-primary" onclick="cari()"></span>
						</div>
					</form>
				</div>
			</div>
		</div>
    </div>

	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins" style="padding:5px;">
				<div class="ibox-title navy-bg">
					<h5>Daftar Pegawai</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>						
					</div>
				</div>
				<div class="ibox-content">

					<table id="tbl-grid" class="table table-striped table-bordered table-hover dataTables-example tooltip-demo" >
						<thead>
						<tr>
							<th>No</th>
							<th>NRK</th>
							<th>Nama</th>
							<th>Jabatan</th>
							<th>Tempat Lahir</th>
							<th>Tgl. Lahir</th>
							<th>Detil</th>
						</tr>
						</thead>
						<tbody></tbody>
						<tfoot>
						<tr>
							<th>No</th>
							<th>NRK</th>
							<th>NAMA</th>
							<th>Jabatan</th>
							<th>Tempat Lahir</th>
							<th>Tgl. Lahir</th>
							<th>Detil</th>
						</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>



		 <!-- Mainly scripts -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/jquery-2.1.1.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <!-- Mainly scripts -->        

        <!-- jqueryForm -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>

        <!-- Data picker -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/datapicker/bootstrap-datepicker.js"></script>

        <!-- Data Tables -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/jquery.dataTables.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.responsive.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
        <!-- Data Tables -->

        <!-- Validation -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/boostrapvalidator/js/bootstrapValidator.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib-1.0.0.js"></script>
        
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/chosen/chosen.jquery.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/inspinia.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/pace/pace.min.js"></script>
        <!-- Custom and plugin javascript -->   

        <!-- Input Mask-->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/jasny/jasny-bootstrap.min.js"></script>
        
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {

				//$("#tglpilih").datepicker("update", new Date());
				//$("#tglpilih").datepicker("setDate", new Date);

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
						null,
						null,
						null,
						null,
						null,
						null,
						{ "bSortable": false }
					],
					"destroy": true,
					responsive: true,
					"processing": true,
					"language": {
						"processing": "<div></div><div></div><div></div><div></div><div></div>"
					},
					"ajax": {
						url:"<?=base_url('index.php/hist/datapokok/data')?>",
						type:"POST",
						data:function(d){
							d.spmu = $('#spmu').val(),
							d.tglpilih = $("#tglpilih").val()
						}
					} // json datasource
				} );

				
			} );

			function getProfile(nrk){     
				$("#thbl_"+nrk).val($("#tglpilih").val());           
                $("#form_"+nrk).submit();
            }

			function cari()
			{
				var dataTable = $('#tbl-grid').DataTable();
				dataTable.ajax.reload();
				/*var date = $("#tglpilih").datepicker('getDate');
				formatted = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
				alert(formatted);*/

			}				

			
		</script>


