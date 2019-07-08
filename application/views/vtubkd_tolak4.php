    <style type="text/css">

        .datepicker, .datepicker-dropdown{
            z-index: 999999999 !important;        
        }
        
        #page-wrapper{
            background: rgba(0, 0, 0, 0) url("/assets/inspinia/css/patterns/shattered.png") repeat scroll 0 0;
        }

        #btnCari{
            margin-right: 82px;
        }

        .sk-spinner-circle.sk-spinner {
            height: 22px;
            margin: 0 !important;
            position: relative;
            width: 22px;
        }

        .form-inline .form-group{
            width: 100%;
        }

        .form-inline .form-group select{
            width: 95%;
        }

        .form-inline .form-group input{
            width: 99%;
        }

        .data-form-group{
            margin-bottom: 5px;
        }

        #btnCari{
            position: absolute;
            
        }

        .sk-spinner-three-bounce.sk-spinner {
            margin: 0 auto;
            text-align: center;
            width: 140px !important;
        }

        @media (max-width: 770px){
            #jenis___chosen, #jenis_chosen{
                width: 100% !important
            }      

            .addButton, .removeButton{
                float: right !important;
            }

            .form-inline .form-group{
                width: 100%;
            }

            #btnCari{
                position: absolute;
                left: 15px;
                margin-top: 35px;
            }
        }

    </style>    

<div class="row wrapper border-bottom white-bg page-heading">
<?php if($user_group == 6){ ?>   
    <div class="col-lg-10">
        <h2>Dashboard</h2>
        <ol class="breadcrumb">
            <li>
                <u><a href="<?php echo site_url().'skpd'?>"><font color="blue">Home</font></a></u>
            </li>
            <li class="active">
                <strong>Index</strong>
            </li>
        </ol>
    </div>
    
</div>


<div class="wrapper wrapper-content">
     
    <!-- START WELLCOME -->
    <div class="row">    
        <div class="col-md-12">
            <div class="ibox animated fadeInLeft">
                <div class="ibox-title navy-bg">
                    <h5>Laporan Permohonan Pegawai Yang Ditolak</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>                        
                    </div>
                </div> 

                <div class="ibox-content">
    
                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-12" id="tbl_list_pegawai">
							<h3>Daftar Pegawai</h3>
							<table id="tbl_list_dt" class="table table-striped table-bordered table-hover dataTables-example" >
								 <thead>
									<tr>
										<th>No</th>
										<th>NRK</th>
										<th>Nama</th>
										<th>Tgl Penolakan</th>
										<th>Permohonan</th>
										<th>Jenis Permohonan</th>
										<th>Golongan</th>
										<th>Opsi</th>
									</tr>
								 </thead>
								 <tbody id="daftar_list_pegawai">
								 </tbody>
						   </table>
						</div>
<!--
                        <span id="form_tu_bkd">
							<form class="form-horizontal" id="form" method="post">
							<div class="form-group">
								<input type="hidden" id="id_trx_hdr" name="id_trx_hdr">
								<div class="col-md-12">
									<div class="col-md-3">
										<label for="no_disposisi">No</label>
									</div>
									<div class="col-md-9">
										<input id="no_disposisi" type="text" class="form-control" name="no_disposisi" disabled="true">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<div class="col-md-3">
										<label for="no_surat">No Surat</label>
									</div>
									<div class="col-md-9">
										<input id="no_surat" type="text" class="form-control" name="no_surat">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
								<button class="btn btn-success btn-block" id="btn_teruskan">Teruskan</button>
								</div>
							</div>
						</span>
-->
							<span id="detail_form">
							<hr/>
							<form class="form-horizontal" id="form" method="post">
							<div class="form-group">
								<div class="col-md-12">
									<h3 class="text-center">Detail Pegawai</h3>
								</div>
							</div>
							<input type="hidden" id="idRow" value="">
							<div class="form-group">
								<div class="col-md-12">
									<div class="col-md-3">
										<label for="nrk">NRK</label>
									</div>
									<div class="col-md-9">
										<input type="text" class="form-control" name="nrk" id="nrk" disabled="true">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<div class="col-md-3">
										<label for="nama_pegawai">Nama Pegawai</label>
									</div>
									<div class="col-md-9">
										<input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" disabled="true">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<div class="col-md-3">
										<label for="alamat_pegawai">Alamat Pegawai</label>
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" name="alamat_pegawai" id="alamat_pegawai" disabled="true">
									</div>
									<div class="col-md-1">
										<label for="rt_pegawai">RT</label>
									</div>
									<div class="col-md-2">
										<input type="number" class="form-control" name="rt_pegawai" id="rt_pegawai" disabled="true">
									</div>
									<div class="col-md-1">
										<label for="rw_pegawai">RW</label>
									</div>
									<div class="col-md-2">
										<input type="number" class="form-control" name="rw_pegawai" id="rw_pegawai" disabled="true">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<div class="col-md-3">
										<label for="kelurahan_pegawai">Kelurahan</label>
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" name="kelurahan_pegawai" id="kelurahan_pegawai" disabled="true">
									</div>
									<div class="col-md-3">
										<label for="kecamatan_pegawai">Kecamatan</label>
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" name="kecamatan_pegawai" id="kecamatan_pegawai" disabled="true">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<div class="col-md-3">
										<label for="wilayah_pegawai">Wilayah</label>
									</div>
									<div class="col-md-9">
										<input type="text" class="form-control" name="wilayah_pegawai" id="wilayah_pegawai" disabled="true">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<span id="tbl_modal">
									<div class="col-md-12" id="">
										<table id="tbl-grid3" class="table table-striped table-bordered table-hover">
											 <thead>
												<tr>
													<th>No</th>
													<th>Syarat</th>
													<th>Keterangan</th>
													<th>Lihat File</th>
												</tr>
											 </thead>
											 <tbody id="list_syarat">
												  
											 </tbody>
										</table>
									</div> 
							   </span>
							</div>
							<!-- <div class="col-md-12">
								<div class='col-md-6'>
									<button id="btn_terima" class="btn-block btn btn-success">Terima</button>
								</div>
								<div class='col-md-6'>
									<button id="btn_tolak" class="btn-block btn btn-danger">Tolak</button>
								</div>
							</div> -->
							</form>
						</span>            
                    </div>
                </div>
            </div>
        </div>
    </div>    
<?php } ?>

<!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Keterangan Penolakan</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <textarea class="form-control" id="ket_tolak" rows="5"></textarea> 
                    </div>
                </div>
                </div>
          
            </div>

        </div>
    </div>

</div>
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

        <!-- Boostrap Validator -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/boostrapvalidator/js/bootstrapValidator.js"></script>
        
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/chosen/chosen.jquery.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/inspinia.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/pace/pace.min.js"></script>
        <!-- Custom and plugin javascript -->   

        <script type="text/javascript">

        $(document).ready(function(){
			$('#btn_teruskan').prop('disabled', true);
			
            //$('#form_tu_bkd').hide();
            $('#detail_form').hide();
            
            //get_all_pegawai_terima();
            $('#no_surat').keyup(function(){
				disable();
			});
			
			function verifikasi_click(idTrxTolak){
	            cek_tolak(idTrxTolak);
	        }
			
		});
		
		function cek_tolak(idTrxTolak){
			$.ajax({
                url: '<?php echo base_url("index.php/tubkd/cek_keterangan_tolak"); ?>/' + idTrxTolak,
                type: "post",
                data: {
                    
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    //$("#list_syarat").html(data.dataTable);
                }
            });
		}

		function disable(){
			if(!$('#no_surat').val()){
				$('#btn_teruskan').prop('disabled', true);
			}else{
				$('#btn_teruskan').prop('disabled', false);
			}
		}

        $('#data_2 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy"
            //endDate: new Date()
        });

        

        function click_persyaratan(idTrx){

            $('#myModal').modal('show');
            persyaratan(idTrx);
            
        }

        function persyaratan(id_trx){
            
            $.ajax({
                url: '<?php echo base_url("index.php/skpd/lihat_persyaratan"); ?>/',
                type: "post",
                data: {
                    ID_TRX: id_trx
                },
                dataType: 'JSON',
                success: function(data) {
                    
                    $("#list_syarat").html(data.dataTable);
                }
            });

            
        }

       

        function get_all_data_tolak(){
            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';
            // var spm = 'C180';
        
            var dtbl= $('#tbl_list_dt').DataTable({
               
                "aoColumns": [
                    { "bSortable": false },
                     { "bSortable": false },
                     { "bSortable": false },
                     { "bSortable": false},
                     { "bSortable": false},
                     { "bSortable": false},
                     { "bSortable": false},
                     { "bSortable": false}
                ],
                responsive: true,
                "scrollX": true,
                "serverSide": true,
                "ajax": {
                    url: '<?php echo base_url("index.php/tubkd/get_data_dashboard"); ?>/tolak',
                    type: "post",
                    data: {
                        
                    },
                    beforeSend: function() {                        
                        $("#daftar_list_pegawai").html(spinner);
                    },
                    /*complete: function()
                    {
                        $("#full_list").html('');
                    }*/
                },"initComplete": function() {
                        var $searchInput = $('div.dataTables_filter input');
             
                        $searchInput.unbind();
             
                        $searchInput.bind('keyup', function(e) {
                            if(e.keyCode == 13) {
                                dtbl.search( this.value ).draw();
                            }
                    });
                }
            });
        }

            /*START CHOSEN*/
            var config = {
                  '.chosen-jenis'           : {no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                                }
                for (var selector in config) {
                  $(selector).chosen(config[selector]);
                }
            /*END CHOSEN*/
        </script>

