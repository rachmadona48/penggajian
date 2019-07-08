<style>
	
</style>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Report
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

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">

			<div class="ibox-title navy-bg">
				<h5>Pencarian Pegawai</h5>
					<div class="ibox-tools">
						<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						<!-- <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu dropdown-user">
							<li><a href="#">Config option 1</a></li>
							<li><a href="#">Config option 2</a></li>
						</ul>
						<a class="close-link"><i class="fa fa-times"></i></a> -->
					</div>
			</div>	
				
			<div class="ibox-content">
    			<div class="row">
        			<!-- form: -->
        				<section>
            			<div class="col-lg-8 col-lg-offset-2">
                

                			<form id="defaultForm" method="post" class="form-horizontal" action="target.php">
			                    <div class="form-group">
			                        <div class="col-lg-5">
			                        	<select class="form-control chosen-jenis" name="jenis[]" id="jenis" data-placeholder="Pilih Jenis Filter">
								            	<option value="">---Pilih Jenis Filter---</option>
								            	<option value="ESELON">Eselon</option>
								            	<option value="GOL">Golongan</option>
								            	<option value="KOPANG">Pangkat</option>
								            	<option value="KOLOK">Lokasi Kerja</option>
								            	<option value="KOJAB">Kode Jabatan</option>
								            	<option value="SPMU">SPMU</option>
								            	<option value="NADIK">Pendidikan</option>
								            	<option value="JENKEL">Jenis Kelamin</option>
								            	<option value="KET_KAWIN">Status Menikah</option>
								            	<option value="KET_AGAMA">Agama</option>
								            	<option value="KET_STAPEG">Status Pegawai</option>
								            	<option value="FLAG">Status Aktif</option>
								            </select>
			                        </div>
			                        <div class="col-lg-5">
			                            <input class="form-control" type="text" id="textbox" name="textbox[]" placeholder="value" />
			                        </div>

			                        <div class="col-lg-2">
			                            <button type="button" class="btn btn-success btn-sm addButton" data-template="textbox"><i class="fa fa-plus"></i></button>
			                        </div>
			                    </div>
		                    <div class="form-group hide" id="textboxTemplate">
		                    	<div class="col-lg-5">
			                        	<select  data-placeholder="Pilih Jenis Filter">
								            	<option value="">---Pilih Jenis Filter---</option>
								            	<option value="ESELON">Eselon</option>
								            	<option value="GOL">Golongan</option>
								            	<option value="KOPANG">Pangkat</option>
								            	<option value="KOLOK">Lokasi Kerja</option>
								            	<option value="KOJAB">Kode Jabatan</option>
								            	<option value="SPMU">SPMU</option>
								            	<option value="NADIK">Pendidikan</option>
								            	<option value="JENKEL">Jenis Kelamin</option>
								            	<option value="KET_KAWIN">Status Menikah</option>
								            	<option value="KET_AGAMA">Agama</option>
								            	<option value="KET_STAPEG">Status Pegawai</option>
								            	<option value="FLAG">Status Aktif</option>
								            </select>
			                        </div>
		                        <div class="col-lg-5">
		                            
		                             <input class="form-control" type="text" placeholder="value" />
		                        </div>
		                        <div class="col-lg-2">
		                            <button type="button" class="btn btn-danger btn-sm removeButton"><i class="fa fa-minus"></i></button>
		                        </div>
		                    </div>

			                    <div class="form-group">
			                        <div class="pull-right">
			                            <span>
			                            <button name="enter" class="btn btn-primary" onclick="cari()"><i class="fa fa-search"></i></button> </span>
			                        </div>
			                    </div>
               				</form>
           		 		</div>
        			</section>
        			<!-- :form -->
    			</div>
			</div>
				
				
				<br/>
				<div class="ibox-title navy-bg">
					<h5>Daftar Pegawai</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
						<!-- <a class="dropdown-toggle" data-toggle="dropdown" href="#">
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
						</a> -->
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

				$('.addButton').on('click', function() {
		            var index = $(this).data('index');
		            if (!index) {
		                index = 1;
		                $(this).data('index', 1);
		            }
		            index++;
		            $(this).data('index', index);
		            
		            	var template     = $(this).attr('data-template'),
		                $templateEle = $('#' + template + 'Template'),
		                $row         = $templateEle.clone().removeAttr('id').insertBefore($templateEle).removeClass('hide'),
		                $el          = $row.find('select').eq(0).attr('name', 'jenis[]');
		                $elj          = $row.find('select').eq(0).attr('class', 'form-control chosen-jenis');
		                $el2          = $row.find('input').eq(0).attr('name',  template + '[]');
			            $('#defaultForm').bootstrapValidator('addField', $el);
			            // Set random value for checkbox and textbox
			            if ('checkbox' == $el.attr('type') || 'radio' == $el.attr('type')) {
			                $el.val('Choice #' + index)
			                   .parent().find('span.lbl').html('Choice #' + index);
			            } else {
			                $el.attr('placeholder', 'Textbox #' + index);
			            }
			            $row.on('click', '.removeButton', function(e) {
			                $('#defaultForm').bootstrapValidator('removeField', $el);
			                $row.remove();
			            });
			             
			             var config = {
					      '.chosen-jenis'           : {no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
					       			    }
					    for (var selector in config) {
					      $(selector).chosen(config[selector]);
					    }
		            
		            
		        });	

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
						{ "bSortable": false },
						{ "bSortable": false }
					],
					responsive: true,
					"processing": true,
					"serverSide": true,
					"language": {
						"processing": "<div></div><div></div><div></div><div></div><div></div>"
					},
					"ajax":{
						url :"<?=site_url('report/dataListReport')?>", // json datasource
						type: "post",  // method  , by default get
						"data": function ( d ) {
							var arrjns=document.getElementsByName('jenis[]');
							var arrtbx=document.getElementsByName('textbox[]');
							var jeniss=[];
							var textboxx=[];
							for(var i=0;i<arrjns.length;i++)
							{
								jeniss[i]=arrjns[i].value;
								textboxx[i]=arrtbx[i].value;
							}

							d.jenis=jeniss;
							d.textbox=textboxx;
							
							d.nrkp = $('#nrkP').val();
							d.arlength = arrjns.length;
							
							
						},
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
						}
					}
				} );
				$('#tbl-grid_filter').css("display","none");//hide

				var config = {
			      '.chosen-jenis'           : {no_results_text:'Oops, Data Tidak Ditemukan',width: "300px"},
			       			    }
			    for (var selector in config) {
			      $(selector).chosen(config[selector]);
			    }
    /*END CHOSEN*/
				
			} );
				
				function cari()
				{
					//var dataTable = $('#tbl-grid').DataTable();
					$('#tbl-grid').DataTable().ajax.reload();
				}

		</script>


