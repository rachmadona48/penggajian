<?php 
    header('Cache-Control: max-age=900');
?>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Riwayat
		</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>index.php">Home</a>
            </li>
            <li class="active">
                <strong>Pegawai</strong>
            </li>
        </ol>
         <small><i>(Menu untuk mengolah data riwayat pegawai)</i></small>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<style type="text/css">
	@media screen and (min-width: 770px){
		div#forPhone{
			display: none;
		}

		.modal-lg{
			width: 1024px !important;
		}

		#btnRiwayat{
			float: left !important;
		}
		
	}
	
	input.form-control {
	  width: auto;
	}

</style>
<div class="wrapper wrapper-content animated fadeInRight">
	<?php if (($user_group > 1 && $user_group < 5) || $user_group == 10){ ?>
	<div class="row" id="forPhone">
        <div class="col-md-12">
            <div id="ibox_bkd" class="ibox float-e-margins animated fadeInRightBig">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-4">
                            <form id="form_4bkd" method="POST" action="<?php echo site_url(); ?>/riwayat">
                              <div class="form-group">                        
                                <div class="input-group">                          
                                  <input type="text" class="form-control" id="nrkP" name="nrkP" value="<?php echo $nrk; ?>" data-mask="999999" placeholder="NRK" autocomplete="off">
                                  <div class="input-group-addon btn btn-primary" style="cursor:pointer;" onclick="getProfile('4bkd');">Go</div>                          
                                </div>
                                <small><span class="help-block m-b-none"><u><i>Masukkan NRK Pegawai yang akan ditampilkan (Cth : 123456).</i></u></span></small>
                              </div>                      
                            </form>
                        </div>                                        
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-content">
					<form role="form" action="#" method="POST" class="form-inline" return="false">
						
						<label for="filter">Penyaringan Berdasarkan: </label>
						<div class="input-group">
							
							<select name="akt", id="akt" class="form-control chosen-select" data-placeholder='Jenis Pegawai'>
								<option value=""></option>
								<option value="2">Semua Pegawai</option>
								<option value="1">Pegawai Aktif</option>
								<option value="0">Pegawai Tidak Aktif</option>
							</select>
						</div>
						<div class="input-group">
							<span><input type="button" name="enter" value="Go" class="btn btn-primary" onclick="cari()"></span>

						</div>
					</form>
				</div>
				<div class="ibox-title navy-bg">
					<h5>Daftar Pegawai</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
					
					<table id="tbl-grid" class="table table-striped table-bordered table-hover dataTables-example" >
						<thead>
						<tr>
<!--							<th style="text-align: center;">No</th>-->
							<th style="text-align: center;">NRK</th>
							<th style="text-align: center;">NIP</th>
							<th style="text-align: center;">NIP18</th>
							<th style="text-align: center;">Nama</th>
							<th style="text-align: center;">Jabatan</th>
							<th style="text-align: center;">Lokasi Gaji</th>
						
							<th style="width:30px; text-align: center;">Aksi</th>
						</tr>
						</thead>
						<tbody></tbody>
						
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>

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
					destroy: true,
					bSort: false,
					responsive: false,
					"processing": true,
					"serverSide": true,
					"language": {
						"processing": "<div></div><div></div><div></div><div></div><div></div>"
					},
					"ajax":{
						url :"<?=site_url('riwayat/dataListRiwayat')?>", // json datasource
						type: "post",  // method  , by default get
						"data": function ( d ) {
							d.akt = $('#akt').val();
							d.nrkp = $('#nrkP').val();
							//alert($('#akt').val());
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

				/*START CHOSEN*/
            var config = {
              '.chosen-select'           : {no_results_text:'Oops, Data Tidak Ditemukan'}              
            }
            for (var selector in config) {
              $(selector).chosen(config[selector]);
            }
            /*END CHOSEN*/

		</script>


