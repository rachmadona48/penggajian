<?php 
    header('Cache-Control: max-age=900');
?>
<style>
    .chosen-container-single .chosen-single abbr{
        cursor: pointer;
    }

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

</style>
<div class="row wrapper border-bottom white-bg page-heading">
	<!-- <input id="tesgmb" type="text" value="<?php //echo base_url()?>assets/img/banner/6.jpg"> -->
	<div class="col-lg-10">
        <h2>Detail Pegawai</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('statistik')?>">Home</a>
            </li>
            <li class="active">
                <strong>Detail Pegawai</strong>
            </li>
        </ol>
         <small><i>(Menu untuk menampilkan data pegawai)</i></small>
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
				<div class="ibox-title navy-bg" id="headerBox">
					<h5>Daftar Pegawai</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>

					</div>
				</div>
				<div class="ibox-content">
					<input type="hidden" name="jenisparam" id="jenisparam" value ="<?php if(isset($jenisparam)){ echo $jenisparam; }?>">
					<input type="hidden" name="thblparam" id="thblparam" value ="<?php if(isset($thblparam)){ echo $thblparam; }?>">
					<input type="hidden" name="golparam" id="golparam" value ="<?php if(isset($golparam)){ echo $golparam; }?>">
					<input type="hidden" name="skpdparam" id="skpdparam" value ="<?php if(isset($skpdparam)){ echo $skpdparam; }?>">
					<input type="hidden" name="ukpdparam" id="ukpdparam" value ="<?php if(isset($ukpdparam)){ echo $ukpdparam; }?>">
					<input type="hidden" name="idwh" id="idwh" value ="<?php if(isset($idwh)){ echo $idwh; }?>">
					<input type="hidden" name="thpns" id="thpns" value ="<?php if(isset($thpns)){ echo $thpns; }?>">
					<input type="hidden" name="stapeg" id="stapeg" value ="<?php if(isset($stapeg)){ echo $stapeg; }?>">
					<div class="spiner-example" id="spinloading" style="display: none">
                                <div class="sk-spinner sk-spinner-three-bounce">
                                    <div class="sk-bounce1"></div>
                                    <div class="sk-bounce2"></div>
                                    <div class="sk-bounce3"></div>
                                </div>
                            </div>
					<table id="tbl-grid" class="table table-striped table-bordered table-hover dataTables-example" >
						<thead>
						<tr>
<!--							<th>No</th>-->
							<th>NRK</th>
							<th>NIP</th>
							<th>NIP18</th>
							<th>Nama</th>
							<th>Lokasi Kerja</th>
							<th>Jabatan</th>
							<th>Lokasi Gaji</th>
							<th>Gol</th>
							
							
							<th>Aksi</th>
						</tr>
						</thead>
						<tbody></tbody>
						
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- START MODAL FORM AKTIFITAS UMUM -->
<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="modalUmumTitle">
    <div class="modal-dialog modal-lg" role="document" id="pesan">
      
    </div>
</div>

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
				$('#spinloading').show();
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
						url :"<?=site_url('detpegawai/data')?>", // json datasource
						type: "post",  // method  , by default get
						"data": function ( d ) {
				
							d.jenisparam = $('#jenisparam').val();
							d.thblparam = $('#thblparam').val();
							d.golparam = $('#golparam').val();
							d.skpdparam = $('#skpdparam').val();
							d.ukpdparam = $('#ukpdparam').val(); 
							d.idwh = $('#idwh').val();
							d.thpns = $('#thpns').val();
							d.stapeg = $('#stapeg').val();
						},
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
						}
					},"initComplete": function() {
						$('#spinloading').hide();
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
					var kolok = $('#kolok').val();

                    resetsrc();

					$.ajax({
					url: '<?php echo site_url("pegawai/getSessionData"); ?>',
					type: "post",
					data: {nrk:nrk,kolok:kolok},
					dataType: 'text',
					
					});
						

					$('html, body').animate({
                            scrollTop: $("#headerBox").offset().top
                        }, 1500);
					$('#tbl-grid').DataTable().ajax.reload();


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
				$.post("<?php echo site_url('pegawai/tambahuser')?>",{
	            NRK: NRK
	            },
	            function(data){
	                $("#pesan").html(data);

	            })
	            $('#modalPassword').modal('show');
			}

			function FormKematian(NRK,penginput){
				$.post("<?php echo site_url('pegawai/form_kematian')?>",{
	            NRK: NRK,
	            penginput : penginput
	            },
	            function(data){
	                $("#pesan").html(data);

	            })
	            $('#modalPassword').modal('show');
			}

			function FormMPP(NRK,penginput){
				$.post("<?php echo site_url('pegawai/formmpp')?>",{
	            NRK: NRK,
	            penginput : penginput
	            },
	            function(data){
	                $("#pesan").html(data);

	            })
	            $('#modalPassword').modal('show');
			}

			function DetailPegawai(NRK,THBL){
				$.post("<?php echo site_url('detpegawai/detail_pegawai')?>",{
	            NRK: NRK,
	            THBL:THBL
	            },
	            function(data){
	                $("#pesan").html(data);

	            })
	            $('#modalPassword').modal('show');
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
		 	$('#kolok').val('<?php echo $param_cari[0];?>');
		 	$('#nrk').val('<?php echo $param_cari[1];?>');
		 }
			
		</script>


