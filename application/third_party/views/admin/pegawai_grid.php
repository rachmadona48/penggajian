<?php 
    header('Cache-Control: max-age=900');
?>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui.css">
<style>
    .chosen-container-single .chosen-single abbr{
        cursor: pointer;
    }
</style>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Data Pegawai</h2>
        <ol class="breadcrumb">
            <li>
                <?php if($user_group == 4): ?>
                <a href="<?php echo site_url('report/laporan')?>">Home</a>
                <?php elseif($user_group == 2 || $user_group == 3 || $user_group == 10 || $user_group == 11 || $user_group == 12 || $user_group >= 13 ): ?>
                <a href="<?php echo site_url('pegawai')?>">Home</a>
                <?php endif; ?>
            </li>
            <li class="active">
                <strong>Pegawai</strong>
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
	<?php if ($this->session->userdata('logged_in')['user_group']<> '1'){ ?>
	<div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
				<div class="ibox-title">
<!--					<span class="label label-warning pull-right">--><?//=$tgl?><!--</span>-->
					<h5>Data Pegawai per SKPD/UKPD</h5>
				</div>
				<div class="ibox-content">
					<form role="form" action="#" method="POST" class="form-inline" return="false" id="form_search">
						<label>Lokasi Kerja :</label>

						<?php

							// echo $param_cari[1];
							/*if(count($param_cari) != 0)
							{
								var_dump($param_cari);
								echo "123";*/
						?>
								<script>

								</script>
						<?php
						//	}
						?>

						<div class="input-group">
							<select name="kolok" id="kolok" data-placeholder="---------------  Pilih Lokasi Kerja  ---------------" class="chosen-select-deselect" style="width:350px;" tabindex="2">
                            <option value=""></option>

							<!--<option value="">---------------  Pilih Lokasi Kerja (Reset) ---------------</option>-->

							<?php
								foreach ($koloks as $klk){
									echo '<option value="'.$klk->NALOKL.'">'.$klk->NALOKL.'</option>';
								}
							?>
							</select>
							<input type="hidden" name="koloksrc" id="koloksrc" value="<?php echo isset($koloksrc) ? $koloksrc : '' ;?>">
						</div>
						<label for="nrk"> Cari Berdasarkan: &nbsp;</label>
						<div class="input-group">
							<input type="text" id="nrk" name="nrk" class="form-control" maxlength="50" style="width:350px" placeholder="MASUKKAN NRK / NAMA / NIP / NIP18">
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
    <?php } ?>
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title navy-bg" id="headerBox">
					<h5>Daftar Pegawai</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
<!--						<a class="dropdown-toggle" data-toggle="dropdown" href="#">-->
<!--							<i class="fa fa-wrench"></i>-->
<!--						</a>-->
<!--						<ul class="dropdown-menu dropdown-user">-->
<!--							<li><a href="#">Config option 1</a>-->
<!--							</li>-->
<!--							<li><a href="#">Config option 2</a>-->
<!--							</li>-->
<!--						</ul>-->
<!--						<a class="close-link">-->
<!--							<i class="fa fa-times"></i>-->
<!--						</a>-->
					</div>
				</div>
				<div class="ibox-content">
					<?php if ($this->session->userdata('logged_in')['user_group'] == '2' AND $hak_akses->act_insert == 'Y'){ ?>
					<a href="<?php echo site_url(); ?>/pegawai/doadd/" class="btn btn-sm btn-primary pull-right m-t-n-xs">
						<strong>Tambah Pegawai</strong>
					</a>&nbsp;
					<?php } ?>

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
							<th>User ID <br/>(Tgl. Update)</th>
							
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
    <div class="modal-dialog" role="document" id="pesan">
        <!-- <form class="form-horizontal" id="formPass" action="javascript:updatePassword();" method="POST">                
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                
                <input type="text" id="NRK" name="NRK">
            </div>
            <div class="modal-body">
                    
                <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">Password Lama</label>
                    <div class="col-sm-9">
                    <input type="password" class="form-control" id="old_pass" name="old_pass" Placeholder="Password Lama">
                    <span class="text-danger" id="errold_pass"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">Password Baru</label>
                    <div class="col-sm-9">
                    <input type="password" class="form-control" id="new_pass" name="new_pass" Placeholder="Password Baru">
                    <span class="text-danger" id="errnew_pass"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="username" class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                    <i>( Harap ganti Password secara berkala untuk menjaga kerahasiaan data pribadi anda ! )</i>
                    </div>
                </div>
    
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default dim" data-dismiss="modal" id="tutupModal">Tutup</button>
                    <button type="submit" class="btn btn-primary dim">Simpan</button>
                </div>
            </div>
        </form> -->
    </div>
</div>
		<!--autocomplete-->
		<script src="<?php echo base_url(); ?>assets/js/jquery-uii.js"></script>
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
				
				$("#nrk").bind('paste', function (e){
			 	     var pastedData = e.originalEvent.clipboardData.getData('text');
			   		var val = pastedData.substring(0,1);
			   		var number= /^[0-9]+$/;

			   		if(!val.match(number))
			   		{
			   			$( "#nrk" ).autocomplete({
					      source: '<?php echo site_url("pegawai/autocom2"); ?>'
					    });

			   		}
			   		else
			   		{
			   			var ctword = pastedData.length;
			   			
			   			if(ctword<=6)
			    		{
			    			$( "#nrk" ).autocomplete({
						      source: '<?php echo site_url("pegawai/autocom"); ?>'
						    });	
			    		}
			    		else if(ctword>6 && ctword<=9)
			    		{
			    			$( "#nrk" ).autocomplete({
						      source: '<?php echo site_url("pegawai/autocom3"); ?>'
						    });
			    		}
			    		else if(ctword>9 && ctword<=18)
			    		{
			    			$( "#nrk" ).autocomplete({
						      source: '<?php echo site_url("pegawai/autocom4"); ?>'
						    });
			    		}
			    		else
			    		{
			    			
			    		}
			   		}

			  });
				
				
				$('#nrk').keydown(function (event) {
					
					var countchar = $('#nrk').val().length +1;
				    var keypressed = event.keyCode || event.which;
				    if (keypressed == 13) {
				        cari();

				        $('html, body').animate({
                    		scrollTop: $("#headerBox").offset().top
                		}, 1500);

				    }
				    else
				    {
				    	/*if(countchar>=1)
				    	{*/
				    		if(keypressed >= 48 && keypressed <=57)
					    	{
					    		if(countchar<=6)
					    		{
					    			$( "#nrk" ).autocomplete({
								      source: '<?php echo site_url("pegawai/autocom"); ?>'
								    });	
					    		}
					    		else if(countchar>6 && countchar<=9)
					    		{
					    			$( "#nrk" ).autocomplete({
								      source: '<?php echo site_url("pegawai/autocom3"); ?>'
								    });
					    		}
					    		else if(countchar>9 && countchar<=18)
					    		{
					    			$( "#nrk" ).autocomplete({
								      source: '<?php echo site_url("pegawai/autocom4"); ?>'
								    });
					    		}
					    		  
					    	}
					    	else if(keypressed >= 65 && keypressed <=90)
					    	{
					    		
					    		if(keypressed == 86)
					    		{
					    			
					    			 $("#nrk").bind('paste', function (e){
									 	     var pastedData = e.originalEvent.clipboardData.getData('text');
									   		var val = pastedData.substring(0,1);
									   		var number= /^[0-9]+$/;

									   		if(!val.match(number))
									   		{
									   			$( "#nrk" ).autocomplete({
											      source: '<?php echo site_url("pegawai/autocom2"); ?>'
											    });

									   		}
									   		else
									   		{
									   			var ctword = pastedData.length;
									   			
									   			if(ctword<=6)
									    		{
									    			$( "#nrk" ).autocomplete({
												      source: '<?php echo site_url("pegawai/autocom"); ?>'
												    });	
									    		}
									    		else if(ctword>6 && ctword<=9)
									    		{
									    			$( "#nrk" ).autocomplete({
												      source: '<?php echo site_url("pegawai/autocom3"); ?>'
												    });
									    		}
									    		else if(ctword>9 && ctword<=18)
									    		{
									    			$( "#nrk" ).autocomplete({
												      source: '<?php echo site_url("pegawai/autocom4"); ?>'
												    });
									    		}
									   		}

									  });
					    			 
					    		}
					    		else
					    		{
					    			$( "#nrk" ).autocomplete({
								      source: '<?php echo site_url("pegawai/autocom2"); ?>'
								    });
					    		}
					    		

					    	}
					    	else
					    	{}
				    	//}
				    	
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
						url :"<?=site_url('pegawai/data')?>", // json datasource
						type: "post",  // method  , by default get
						"data": function ( d ) {
							d.kolok = $('#kolok').val();
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
				$.post("<?php echo site_url('pegawai/tambahuser')?>",{
	            NRK: NRK
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


