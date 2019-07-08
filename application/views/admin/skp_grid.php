<?php 
    header('Cache-Control: max-age=900');
?>
<style>
    .chosen-container-single .chosen-single abbr{
        cursor: pointer;
    }

     /*Tampilkan pencarian di tampilan phone*/
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
	<div class="col-lg-10">
        <h2>Data SKP Pegawai</h2>
        <ol class="breadcrumb">
            
            <li class="active">
                <strong>Penilaian Prestasi Kerja</strong>
            </li>
        </ol>
         <small><i>(Menu untuk menampilkan Riwayat Penilaian Prestasi Kerja PNS)</i></small>
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
	<?php if ($this->session->userdata('logged_in')['user_group']=='2' || $this->session->userdata('logged_in')['user_group']=='10' || $this->session->userdata('logged_in')['user_group']=='5' || $this->session->userdata('logged_in')['user_group']=='47' || $this->session->userdata('logged_in')['user_group']=='26'  ){ ?>
	<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
				<div class="ibox-title">

					<h5>Data SKP Pegawai</h5>
				</div>
				<div class="ibox-content">
					<form role="form" action="#" method="POST" class="form-inline" return="false" id="form_search">

						<?php if($this->session->userdata('logged_in')['user_group']=='2' || $this->session->userdata('logged_in')['user_group']=='26') { ?>
						<div class="row">
							<div class="col-md-2">
								<label>Pilih SKPD</label>		
							</div>

					
							<div class="col-md-6">
								<div class="input-group">
									<select name="spmu" id="spmu" data-placeholder="---------------  Pilih SKPD  ---------------" class="chosen-spmu" style="width:400px;" tabindex="2">
		                            <option value=""></option>

									<!--<option value="">---------------  Pilih Lokasi Kerja (Reset) ---------------</option>-->

									<?php
										foreach ($spmu as $spm){
											echo '<option value="'.$spm->SPMU.'">'.$spm->NAMA.'</option>';
										}
									?>
									</select>
									<button type="button" class="btn  btn-danger" data-toggle="tool-tip" title='Clear' onclick="clearfield()"><i class='fa fa-times'></i></button>
									<input type="hidden" name="koloksrc" id="koloksrc" value="<?php echo isset($koloksrc) ? $koloksrc : '' ;?>">
								</div>
							</div>
						</div>
						
					<?php } else { ?>
						<input type="hidden" id="spmu" value="">
					<?php } ?>


						<?php if($this->session->userdata('logged_in')['user_group']!='47') { ?>
						<div class="row">
							<div class="col-md-2">
								<label>Pilih UKPD</label>		
							</div>

					
							<div class="col-md-4">
								<div class="input-group">
									<select name="kolok" id="kolok" data-placeholder="---------------  Pilih Lokasi Kerja  ---------------" class="chosen-select-deselect chosen-klogad" style="width:350px;" tabindex="2">
		                            <option value=""></option>

									<!--<option value="">---------------  Pilih Lokasi Kerja (Reset) ---------------</option>-->

									<?php

										if($this->session->userdata('logged_in')['user_group']=='2' || $this->session->userdata('logged_in')['user_group']=='26')
										{
											
											echo $koloks; 	
										}
										else
										{
											foreach ($koloks as $klk){
											echo '<option value="'.$klk->NALOK.'">'.$klk->NALOK.'</option>';
											}	
										}
										

										 
									?>
									</select>
									<input type="hidden" name="koloksrc" id="koloksrc" value="<?php echo isset($koloksrc) ? $koloksrc : '' ;?>">
								</div>
							</div>
						</div>
						
					<?php } else { ?>
						
						<input type="hidden" id="kolok" value="-">
					<?php } ?>
						<div class="row">
							<div class="col-md-2">
								<label>Pilihan Data</label>
							</div>

							<div class="col-md-4">
								<div class="input-group">
									<select name="validasi_select" id="validasi_select" data-placeholder="---------------  Pilih Data  ---------------" class="chosen-select-deselect" style="width:350px;" tabindex="2">

		                            <option value="-">Belum Validasi <?php echo date('Y')-1;?></option>
		                            <option value="1">Sudah Validasi <?php echo date('Y')-1;?></option>
		                            <option value="2">Belum Input <?php echo date('Y')-1;?></option>
		                            <option value="3">Belum Input <?php echo date('Y')-2;?></option>
									</select>
								
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-2">
								<label for="nrk"> Cari Berdasarkan: &nbsp;</label>
							</div>

							<div class="col-md-4">
								<div class="input-group">
									<input type="text" id="nrk" name="nrk" class="form-control" maxlength="50" style="width:350px" placeholder="NRK">
								
								</div>
							</div>
						</div>
						
						
						<br/>
						
						


						

						<!-- <label for="nrk"> &nbsp;  Nama :</label>
						<div class="input-group">
							<input type="text" id="nama" name="nama" class="form-control" style="width:150px">
							<input type="hidden" name="namasrc" id="namasrc" value="<?php// echo isset($namasrc) ? $namasrc : '' ;?>">
						</div> -->
						
						<div class="input-group">
							<span><input type="button" name="enter" value="Go" class="btn btn-primary" onclick="cari()"></span>&nbsp;&nbsp;
							<span><input type="button" name="excbkd" value="Excel" class="btn btn-primary" onclick="expbkd()"></span>
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
					<h5>Daftar SKP</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>

					</div>
				</div>
				<div class="ibox-content">
					<span class="text-danger" id="errnew_pass">
					 1 - PELAYANAN || 
					 2 - INTEGRITAS || 
					 3 - KOMITMEN || 
					 4 - DISIPLIN ||
					 5 - KERJASAMA || 
					 6 - KEPEMIMPINAN 
					 </span>
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
							<th>NRK</th>
							<th>NAMA</th>
							<th>TAHUN</th>
							<th>1</th>
							<th>2</th>
							<th>3</th>
							<th>4</th>
							<th>5</th>
							<th>6</th>
							<th>SKP</th>
							<th>PERILAKU</th>
							<th>PRESTASI</th>
							<th>PENGINPUT</th>
							<th>AKSI</th>
						</tr>
						</thead>
						<tbody>
							
                           

						</tbody>
						
					</table>
					
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
</div>

<!-- Start Modal -->
<div class="modal fade" id="myModal0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div id="widthForm" class="modal-dialog modal-lg" role="document">
  	
  	<div class="modal-content" id="modal_label0">
        
    </div>
        
    
  </div>
</div>
<!-- End Modal -->

<!-- Start Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div id="widthForm" class="modal-dialog modal-lg" role="document">
  	
  	<div class="modal-content" id="modal_label">
        
    </div>
    <div class="modal-content animated fadeInUp" id="modal_content">
        
    </div>
  </div>
</div>
<!-- End Modal -->


<!-- Start Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div id="widthForm" class="modal-dialog modal-lg" role="document">
  	<div class="modal-content" id="modal_label2">
        
    </div>
    <div class="modal-content animated fadeInUp" id="modal_content2">
        
    </div>
  </div>
</div>
<!-- End Modal -->

<!-- START MODAL FORM AKTIFITAS UMUM -->
<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="modalUmumTitle">
    <div class="modal-dialog" role="document" id="pesan">
      
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
				

				$("#spmu").on("change", function(event) {
                    event.preventDefault();

                    var isispm = $('#spmu').val();
                    if(isispm == "")
                    {
                    	$('#spmu').val('');
                    }
                    else
                    {
                    	$.ajax({
                        url: "<?php echo base_url(); ?>index.php/skp/getKolok",
                        type: "post",
                        data: {spmu : $('#spmu').val()},
                        dataType: 'json',
                        beforeSend: function() {                                                        
                            
                        },
                        success: function(data) { 
                                       
                            if(data.response == 'SUKSES'){
                                 $('#kolok').html(data.koloks);
                            }else{
                                 $('#kolok').html('');
                            }

                        },
                        error: function(xhr) {                              
                            alert("Terjadi kesalahan. Silahkan coba kembali");                            
                        },
                        complete: function() {                            
                            $(".chosen-klogad").trigger("chosen:updated");
                            
                        }
                    });
                    }
                    

                    
                });
				
				$('#nrk').keydown(function (event) {
				    var keypressed = event.keyCode || event.which;
				    if (keypressed == 13) {
				        cari();

				        $('html, body').animate({
                    		scrollTop: $("#tbl-grid").offset().top
                		}, 1000);

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
						url :"<?=site_url('skp/data')?>", // json datasource
						type: "post",  // method  , by default get
						
						"data": function ( d ) {
							
							d.nrk = $('#nrk').val();
							d.opsi = $('#validasi_select').val();
							d.kolok = $('#kolok').val();
							d.spmu = $('#spmu').val();
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
						document.getElementById('nrk').value="";
						//document.getElementById('namasrc').value="";
						//document.getElementById('kolok').value="";	

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
					var spmu = $('#spmu').val();
					var opsi = $('#validasi_select').val();

                   // resetsrc();
                   $('#spinloading').hide();


					$.ajax({
					url: '<?php echo site_url("skp/getSessionData"); ?>',
					type: "post",
					data: {nrk:nrk,kolok:kolok,opsi:opsi,spmu:spmu},
					dataType: 'text',
					
					});
                    $('html, body').animate({
                            scrollTop: $("#headerBox").offset().top 
                        }, 1000);

				
						

					
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

			function exp(){
				
				var valselect = $('#validasi_select').val();	

				$.ajax({
					url: '<?php echo site_url("skp/export_excel_skp"); ?>',
					type: "post",
					data: { val: valselect},
					dataType: 'json',
					beforeSend: function() {
						 $('#myModal').modal('toggle');
                        $("#modal_content").html('<div class="sk-spinner sk-spinner-three-bounce" style="width:110px;"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div></div>');
					},
					success: function(data) {
						 $('#myModal').modal('hide');
						var $a = $("<a>");
                $a.attr("href",data.file);
                $("body").append($a);
                $a.attr("download",data.filename);
                $a[0].click();
                $a.remove();      
					},
					error: function(xhr) {

						swal("Gagal!", "Excel Gagal Dibuat.", "error");
						$('#myModal').modal('hide');
					},
					complete: function() {

					}
				});

				//return result;
			}

			function expbkd(){
				
				var valselect = $('#validasi_select').val();	
				var kolok = $('#kolok').val();	
				var spmu = $('#spmu').val();	

				$.ajax({
					url: '<?php echo site_url("skp/cekDataSKP"); ?>',
					type: "post",
					data: { val: valselect, kolok:kolok,spmu:spmu},
					dataType: 'json',
					beforeSend: function() {
						 $('#myModal0').modal('toggle');
                        $("#modal_label0").html('<h3 class="text-danger">CHECKING . . .</h3>');
					},
					success: function(data) {
						 $('#myModal0').modal('hide');
						
						 if(data.jml >= 50000)
						 {
						 			$.ajax({
										url: '<?php echo site_url("skp/export_excel_skp1"); ?>',
										type: "post",
										data: { val: valselect,kolok:kolok,spmu:spmu},
										dataType: 'json',
										beforeSend: function() {
											 $('#myModal').modal('toggle');
											 $("#modal_label").html('<marquee><h3 class="text-danger">SEDANG EKSEKUSI EXCEL BAGIAN 1</h3></marquee>');
					                        $("#modal_content").html('<div class="sk-spinner sk-spinner-three-bounce" style="width:110px;"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div></div>');
										},
										success: function(data) {
											 $('#myModal').modal('hide');
											var $a = $("<a>");
					                $a.attr("href",data.file);
					                $("body").append($a);
					                $a.attr("download",data.filename);
					                $a[0].click();
					                $a.remove();      

					                	$.ajax({
														url: '<?php echo site_url("skp/export_excel_skp2"); ?>',
														type: "post",
														data: { val: valselect,kolok:kolok,spmu:spmu},
														dataType: 'json',
														beforeSend: function() {
															 $('#myModal2').modal('toggle');
															 $("#modal_label2").html('<marquee><h3 class="text-danger">SEDANG EKSEKUSI EXCEL BAGIAN 2</h3></marquee>');
									                         $("#modal_content2").html('<div class="sk-spinner sk-spinner-three-bounce" style="width:110px;"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div></div>');
														},
														success: function(data) {
															 $('#myModal2').modal('hide');
															var $a = $("<a>");
									                $a.attr("href",data.file);
									                $("body").append($a);
									                $a.attr("download",data.filename);
									                $a[0].click();
									                $a.remove();     
									                swal("SELESAI!", "Excel Selesai Dibuat.", "success"); 
														},
														error: function(xhr) {

															swal("Gagal!", "Excel Gagal2.", "error");
															$('#myModal2').modal('hide');
														},
														complete: function() {

														}
													});
					                				

										},
										error: function(xhr) {

											swal("Gagal!", "Excel Gagal 1.", "error");
											$('#myModal').modal('hide');
										},
										complete: function() {

										}
									});

						 }
						 else
						 {
						 	$.ajax({
								url: '<?php echo site_url("skp/export_excel_skp"); ?>',
								type: "post",
								data: { val: valselect,kolok:kolok,spmu:spmu},
								dataType: 'json',
								beforeSend: function() {
									 $('#myModal').modal('toggle');
									 $("#modal_label").html('<marquee><h3 class="text-danger">SEDANG EKSEKUSI EXCEL</h3></marquee>');
			                        $("#modal_content").html('<div class="sk-spinner sk-spinner-three-bounce" style="width:110px;"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div></div>');
								},
								success: function(data) {
									 $('#myModal').modal('hide');
									var $a = $("<a>");
						                $a.attr("href",data.file);
						                $("body").append($a);
						                $a.attr("download",data.filename);
						                $a[0].click();
						                $a.remove();     
						                swal("SELESAI!", "Excel Selesai Dibuat.", "success");  
								},
								error: function(xhr) {

									swal("Gagal!", "Excel Gagal Dibuat.", "error");
									$('#myModal').modal('hide');
								},
								complete: function() {

								}
							});
						 }

                	



					},
					error: function(xhr) {

						swal("Gagal!", "Excel Gagal Cek Data.", "error");
						//$('#myModal').modal('hide');
					},
					complete: function() {

					}
				});

				//return result;
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

			function validasiskp(NRK,TAHUN){
				$.post("<?php echo site_url('skp/validasiskp')?>",{
	            NRK: NRK,TAHUN :TAHUN
	            },
	            function(data){
	                $("#pesan").html(data);

	            })
	            $('#modalPassword').modal('show');
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
				$.post("<?php echo site_url('admin/tambahuser')?>",{
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
					$.post("<?php echo site_url('admin/edituseradmin')?>",{
		            NRK: NRK
		            },
		            function(data){
		                $("#pesan").html(data);

		            })
		            $('#modalPassword').modal('show');
				}
				else
				{
					$.post("<?php echo site_url('admin/edituser')?>",{
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

		 function getForm(form,action,key1,key2,key3,key4){
                save_method = action;
                
                $.ajax({
                    url: "skp/generateForm",
                    type: "post",
                    data: {form:form,nrk:$('#nrkP').val(),action:action,key1:key1,key2:key2,key3:key3,key4:key4},
                    dataType: 'json',
                    beforeSend: function() {
                        $('#myModal').modal('toggle');
                        $("#modal_content").html('<div class="sk-spinner sk-spinner-three-bounce" style="width:110px;"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div></div>');
                    },
                    success: function(data) {            
                        if(data.response == 'SUKSES'){
                            $("#modal_content").html(data.result);

                            if(data.widthForm == 'one'){
                                $('#widthForm').removeAttr('class').attr('class', '');                                
                                $('#widthForm').addClass('modal-dialog');
                            }else{
                                $('#widthForm').removeAttr('class').attr('class', '');
                                $('#widthForm').addClass('modal-dialog');
                                $('#widthForm').addClass('modal-lg');                                
                            }

                        }else{
                            $("#modal_content").html('');
                        }
                    },
                    error: function(xhr) {                              
                        $('#myModal').modal('hide');  
                    },
                    complete: function() {
                                                
                    }
                });
               

            }

            /*START CHOSEN*/
                var config = {
                  '.chosen-klogad'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
                  '.chosen-spmu'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"}
                }
                for (var selector in config) {
                  $(selector).chosen(config[selector]);
                }

                function clearfield()
                {
                	$('#spmu').val('');
                	$('#kolok').val('');

                	

                	$.ajax({
                        url: "<?php echo base_url(); ?>index.php/skp/getKolok",
                        type: "post",
                        data: {spmu : $('#spmu').val()},
                        dataType: 'json',
                        beforeSend: function() {                                                        
                            
                        },
                        success: function(data) { 
                                       
                            if(data.response == 'SUKSES'){
                                 $('#kolok').html(data.koloks);
                            }else{
                                 $('#kolok').html('');
                            }

                        },
                        error: function(xhr) {                              
                            alert("Terjadi kesalahan. Silahkan coba kembali");                            
                        },
                        complete: function() {                            
                            $(".chosen-klogad").trigger("chosen:updated");
                            
                        }
                    });

                	$(".chosen-spmu").trigger("chosen:updated");
                	//$(".chosen-klogad").trigger("chosen:updated");
                }

			
		</script>


