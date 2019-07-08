<?php 
    header('Cache-Control: max-age=900');
?>
<style>
    .chosen-container-single .chosen-single abbr{
        cursor: pointer;
    }
</style>


		
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>List User</h2>
        
         <small><i>(Menu untuk menampilkan data user simpeg)</i></small>
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
	<?php if ($this->session->userdata('logged_in')['user_group']=='3' || $this->session->userdata('logged_in')['user_group']=='12'){ ?>
	<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
				<div class="ibox-title">

					<h5>Data Akun User Pegawai</h5>
				</div>
				<div class="ibox-content">
					<form role="form" action="#" method="POST" class="form-inline" return="false" id="form_search">
						<label>User Group :</label>

						<div class="input-group">
							<select name="usergroup" id="usergroup" data-placeholder="---------------  Pilih User Group  ---------------" class="chosen-select-deselect" style="width:350px;" tabindex="2">
                            <option value=""></option>

							

							<?php

								foreach ($ugs as $klk){

									echo '<option value="'.$klk->user_group_id.'">'.$klk->nama_group.'</option>';
								}
							?>
							</select>
							<input type="hidden" name="koloksrc" id="koloksrc" value="<?php echo isset($koloksrc) ? $koloksrc : '' ;?>">
						</div>
						<label for="nrk"> Cari Berdasarkan: &nbsp;</label>
						<div class="input-group">
							<input type="text" id="nrk" name="nrk" class="form-control" maxlength="50" style="width:350px" placeholder="USER ID">
							<input type="hidden" name="nrksrc" id="nrksrc" value="<?php echo isset($nrksrc) ? $nrksrc : '' ;?>">
						</div>
						<!-- <label for="nrk"> &nbsp;  Nama :</label>
						<div class="input-group">
							<input type="text" id="nama" name="nama" class="form-control" style="width:150px">
							<input type="hidden" name="namasrc" id="namasrc" value="<?php// echo isset($namasrc) ? $namasrc : '' ;?>">
						</div> -->
						
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
			<div class="ibox float-e-margins">
				<div class="ibox-title navy-bg" id="headerBox">
					<h5>Daftar User Account</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>

					</div>
				</div>
				<div class="ibox-content">
					

					<button class="btn btn-sm btn-primary pull-right m-t-n-xs" onclick='TambahUser()'>Tambah</button>

					<table id="tbl-grid" class="table table-striped table-bordered table-hover dataTables-example" >
						<thead>
						<tr>
							<th>User ID</th>
							<th>User Name</th>
							<th>User Group</th>
							<th>Aktif</th>
							<th>Aksi</th>
						</tr>
						</thead>
						<tbody></tbody>
						
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
</div>

<!-- START MODAL FORM AKTIFITAS UMUM -->
<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="modalUmumTitle">
    <div class="modal-dialog" role="document" id="pesan">
       
    </div>
</div>
		 <!-- Mainly scripts -->
    <script src="<?php echo base_url() ?>assets/inspinia/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url() ?>assets/inspinia/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url() ?>assets/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>     

		<!-- jqueryForm -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>

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
            $('.chosen-select-deselect').chosen({allow_single_deselect:true});
            //$('.chosen-select-deselect').chosen("destroy");
			$(document).ready(function() {
				if (<?php echo count($param_cari)?> > 0){
					setParam();	
				}
				
				$('#nrk').keydown(function (event) {
				    var keypressed = event.keyCode || event.which;
				    if (keypressed == 13) {
				        cari();

				        $('html, body').animate({
                    		scrollTop: $("#headerBox").offset().top
                		}, 1500);

				    }
				});

				/*$('#nama').keydown(function (event) {
				    var keypressed = event.keyCode || event.which;
				    if (keypressed == 13) {
				        cari();
				    }
				});*/

				<?php
					if ($this->session->flashdata('msg') != ''){
				?>
						swal("Sukses!", "Data pegawai berhasil disimpan.", "success");
				<?php
					}
				?>
				
				var dataTable = $('#tbl-grid').DataTable( {
					/* "aoColumns": [
						null,
						null,
						null,
						null,
						null,
						null,
						null
					],*/
					"bSort":false,
					responsive: false,
					scrollX:true,
					"processing": true,
					"serverSide": true,
destroy:true,
					"language": {
						"processing": "<div></div><div></div><div></div><div></div><div></div>"
					},
					"ajax":{
						url :"<?=site_url('admin/admin/data')?>", // json datasource
						type: "post",  // method  , by default get
						"data": function ( d ) {
							d.usergroup = $('#usergroup').val();
							d.nrk = $('#nrk').val();
							//d.nama = $('#nama').val();
							//d.namasrc = $('#namasrc').val();
							d.nrksrc = $('#nrksrc').val();
							d.koloksrc = $('#koloksrc').val(); 
						},
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
						}
					},"initComplete": function() {
                        var $searchInput = $('div.dataTables_filter input');
             
                        $searchInput.unbind();
             
                        $searchInput.bind('keyup', function(e) {
                            if(e.keyCode == 13) {
                                dataTable.search( this.value ).draw();
                            }


                    });  }
					
				} );
				//$('#tbl-grid_filter').css("display","none");//hide filtering
				//resetsrc();
			} );

				
				function resetsrc()
				{
						document.getElementById('nrksrc').value="";
						//document.getElementById('namasrc').value="";
						document.getElementById('koloksrc').value="";	

					$('div.dataTables_filter input').val('');
				}

				function cari()
				{
					var table = $('#tbl-grid').DataTable();
						table
						 .search( '' )
						 .columns().search( '' )
						 .draw();
					var nrk = $('#nrk').val();
					var usergroup = $('#usergroup').val();

                    resetsrc();

					$.ajax({
					url: '<?php echo site_url("admin/admin/getSessionData"); ?>',
					type: "post",
					data: {nrk:nrk,usergroup:usergroup},
					dataType: 'text',
					
					});
						

					$('html, body').animate({
                            scrollTop: $("#headerBox").offset().top
                        }, 1500);
					//$('#tbl-grid').DataTable().ajax.reload();


				}

			function confirmHapusDataPegawaiFlag(key1){
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
						rslt = hapusData(key1);
					}
				});
				/*END SWEETALERT*/
			}

			function confirmHapusDataPegawai(key1){
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
						rslt = hapusDataP(key1);
					}
				});
				/*END SWEETALERT*/
			}

			function hapusData(key1){
				// alert(key1);
				var result = 0;

				$.ajax({
					url: '<?php echo site_url("pegawai/dodelete"); ?>',
					type: "post",
					data: {action:'hapus',id:key1},
					dataType: 'json',
					beforeSend: function() {

					},
					success: function(data) {
						if(data.response == 'SUKSES'){
							swal("Hapus!", "Data berhasil dihapus.", "success");
							cari();
						}else{
							swal("Gagal!", "Data gagal dihapus.", "error");
						}
					},
					error: function(xhr) {
						swal("Gagal!", "Data gagal dihapus.", "error");
					},
					complete: function() {

					}
				});

				return result;
			}

			function hapusDataP(key1){
				var result = 0;

				$.ajax({
					url: '<?php echo site_url("pegawai/dohapusaction"); ?>',
					type: "post",
					data: {action:'hapus',id:key1},
					dataType: 'json',
					beforeSend: function() {

					},
					success: function(data) {
						if(data.response == 'SUKSES'){
							swal("Hapus!", "Data berhasil dihapus.", "success");
							cari();
						}else{
							swal("Gagal!", "Data gagal dihapus.", "error");
						}
					},
					error: function(xhr) {
						swal("Gagal!", "Data gagal dihapus.", "error");
					},
					complete: function() {

					}
				});

				return result;
			}

			function ResetPassword(NRK){
				$.post("<?php echo site_url('pegawai/reset_password')?>",{
	            NRK: NRK
	            },
	            function(data){
	                $("#pesan").html(data);

	            })
	            $('#modalPassword').modal('show');
			}
			
			function TambahUser(NRK){
				$.post("<?php echo site_url('admin/admin/tambahuser')?>",{
	            //NRK: NRK
	            },
	            function(data){
	                $("#pesan").html(data);

	            })
	            $('#modalPassword').modal('show');
			}

			function EditUser(NRK){

				if(NRK=='adminDKI')
				{
					$.post("<?php echo site_url('admin/admin/edituseradmin')?>",{
		            NRK: NRK
		            },
		            function(data){
		                $("#pesan").html(data);

		            })
		            $('#modalPassword').modal('show');
				}
				else
				{
					$.post("<?php echo site_url('admin/admin/edituser')?>",{
		            NRK: NRK
		            },
		            function(data){
		                $("#pesan").html(data);

		            })
		            $('#modalPassword').modal('show');
				}

				
			}
			// function ResetPassword(NRK){
			// 	$('#modalPassword').modal('show');
		 //        $.ajax({           
		 //            data: {'NRK':NRK},
		 //            dataType: 'json',
		 //            success: function(data) { 

		 //             $("#nrk").val(data.NRK);                              
		             
		 //            },
		 //            error: function(xhr) {                              
		                
		 //            },
		 //            complete: function() {              
		                
		 //            }
		 //        });
		 //    }

		 function setParam(){
		 	$('#usergroup').val('<?php echo $param_cari[0];?>');
		 	$('#nrk').val('<?php echo $param_cari[1];?>');
		 }

			
		</script>


