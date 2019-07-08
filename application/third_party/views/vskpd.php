    <style type="text/css">
		.fileUpload {
			position: relative;
			overflow: hidden;
		}
		.fileUpload input {
			position: absolute;
			top: 0;
			right: 0;
			margin: 0;
			padding: 0;
			cursor: pointer;
			opacity: 0;
		}
        
        .panel{
			margin-top: -30px;
		}
		
		.panel-heading{
			background-color: #22C3A3 !important;
		}
		
		#icon-filter{
		    cursor:pointer;
		}
		
        #verifikasi_btn{
            cursor: pointer;
            text-decoration: underline;
            color: #3498db;
        }

        .strikeout{
            text-decoration: line-through;
        }

        tr.terima{
            background-color: #27ae60 !important;
            color: #fff;
        }

        tr.tolak{
            background-color: #c0392b !important;
            color: #fff;
        }

        tr.tolak a#verifikasi{
            /*pointer-events: none;*/
        }

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

        .sweet-alert button.cancel{
        background-color: #ec0000;
        }
        .sweet-alert button.cancel:hover{
        background-color: #d81717;
        }

    </style>    
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-tour-0.10.3/build/css/bootstrap-tour-standalone.min.css') ?>">
    <script src="<?= base_url('assets/bootstrap-tour-0.10.3/build/js/bootstrap-tour-standalone.min.js') ?>"></script>
<?php if($user_group == 5){ ?>
<div class="row wrapper border-bottom white-bg page-heading">
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
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content">
        
    <!-- START WELLCOME -->
    <div class="row">    
        <div class="col-md-12">
            <div class="ibox animated fadeInLeft">
                 <div class="ibox-title navy-bg">
                    <h5>Permohonan Data Pegawai</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>                        
                    </div>
                </div> 
                <div class="ibox-content">
    
                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-12">

                            <!-- form: -->
							<div class="row">
                            
                    			<form class="form-horizontal" id="defaultForm" method="post">
                                    <div class="data-form-group">

									<div class="panel panel-info">
										  <div class="panel-heading">
										    <h3 class="panel-title">
												Pencarian menggunakan filter: 
												<span class="pull-right" id="icon-filter">
													<i class="fa fa-sort-desc" aria-hidden="true"></i>
											    </span>
										    </h3>
										  </div>
										<div class="panel-body">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="col-md-2">
                                                    <label for="jenis">Permohonan </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class='form-control chosen-jenis' name='ref_permohonan' id='ref_permohonan' data-placeholder='Cari Berdasarkan...'>
                                                        <option value="" disabled="true" selected="true">Pilih Permohonan</option>
                                                        <?php foreach($ref_permohonan->result() as $row): ?>
                                                            <option id="<?php echo $row->ID_PERMOHONAN ?>" value="<?php echo $row->ID_PERMOHONAN ?>"><?php echo $row->KET_PERMOHONAN ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="jenis">Jenis Permohonan </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class='form-control chosen-jenis' name='jenis_permohonan' id='jenis_permohonan' data-placeholder='Cari Berdasarkan...'>
                                                        <option value="" disabled="true" selected="true">Pilih Jenis Permohonan</option>
                                                        <?php foreach($jenis_permohonan->result() as $row): ?>
                                                            <option id="<?php echo $row->ID_JENIS_PERMOHONAN ?>" value="<?php echo $row->ID_JENIS_PERMOHONAN ?>"><?php echo $row->KET_JENIS_PERMOHONAN ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="col-md-2">
                                                    <label for="gol_pegawai">Golongan Pegawai </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class='form-control chosen-jenis' name='gol_pegawai' id='gol_pegawai' data-placeholder='Cari Berdasarkan...'>
                                                        <option value="" disabled="true" selected="true">Pilih Pangkat dan Golongan</option>
                                                        <?php foreach($gol_pegawai->result() as $row): ?>
                                                            <option value="<?php echo $row->KOPANG ?>"><?php echo $row->GOL .' - '. $row->NAPANG ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-2">
                                                    <label for="gol_pegawai">Jabatan Fungsional</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class='form-control chosen-jenis' name='kojabf' id='kojabf' data-placeholder='Cari Berdasarkan...'>
                                                        <option value="" disabled="true" selected="true">Pilih Jabatan Fungsional</option>
                                                        
                                                            <?php echo $ref_kojabf

                                                         ?>
                                                    </select>
                                                </div>

                                            </div>
                                           
                                        </div>
                                        </div>
									</div>
                                        <div class="col-md-12" id="tbl_list_pegawai">
                                            <h3 class="text-center">Daftar Pegawai</h3>
                                            <table id="tbl_list_dt" class="table table-striped table-bordered table-hover dataTables-example" width="100%">
                                                 <thead>
                                                    <tr>
                                                        <!--<th width="6%">No</th>
                                                        <th width="7%">NRK</th>
                                                        <th width="10%">Nama</th>
                                                        <th width="5%">Tgl Permohonan</th>
                                                        <th width="12%">Permohonan</th>
                                                        <th width="15%">Jenis Permohonan</th>
                                                        <th width="10%">Gol</th>
                                                        <th width="10%">Pengajuan Jabatan</th>
                                                        <th width="5%">Opsi</th>-->

                                                        <th>No</th>
                                                        <th>NRK</th>
                                                        <th>Nama</th>
                                                        <th>Tgl Permohonan</th>
                                                        <th>Permohonan</th>
                                                        <th>Jenis Permohonan</th>
                                                        <!--<th>Jenjang</th>-->
                                                        <th>Gol</th>
                                                        <th>Pengajuan Jabatan</th>
                                                        
                                                        <th>Opsi</th>
                                                    </tr>
                                                 </thead>
                                                 <tbody id="daftar_list_pegawai">
                                                 </tbody>
                                           </table> 
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
												<div class="col-md-3">
													<label for="tgl_surat">Tanggal Surat</label>
												</div>
												<div class="col-md-9 pickerpicker" id="data_2">
                                                    <div class="input-group col-md-12 date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgl_surat" name="tgl_surat" placeholder="Tgl. Surat" class="form-control" readonly="readonly">
                                                    </div>
												</div>
											</div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <button class="btn btn-block btn-success" id="btn_simpan_all">Simpan</button>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <br/>
                                        <span id="detail_form">
                                        <hr/>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <h3 class="text-center">Detail Pegawai</h3>
                                            </div>
                                        </div>
                                        <input type="hidden" id="id_trx">
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
                                            <span id="alasan_tolak">
                                                <h3 class="text-center">Keterangan Penolakan</h3>
                                                <div class='col-md-12'>
                                                    <textarea class="form-control" id="alasan_tolak_textarea" placeholder="Isi keterangan penolakan"></textarea>
                                                    <br/><br/>
                                                </div>
                                                <div class='col-md-6'>
                                                    <button id="btn_simpan" class="btn-block btn btn-success">Simpan</button>
                                                </div>
                                                <div class='col-md-6'>
                                                    <button id="btn_batal" class="btn-block btn btn-danger">Batal</button>
                                                </div>
                                            </span>
                                            <span id="message_tolak">
                                            </span>
                                        </div>
                                        <div class="col-md-12">
                                            <span id="button_penting">
                                                <div class='col-md-6'>
                                                    <button id="btn_terima" class="btn-block btn btn-success">Terima</button>
                                                </div>
                                                <div class='col-md-6'>
                                                    <button id="btn_tolak" class="btn-block btn btn-danger">Tolak</button>
                                                </div>
                                            </span>
                                        </div><br>
                                        <br>
                                        <br>
                                        <div class="col-md-12">
                                            <span id="tbl_modal">
                                                <div class="col-md-12" id="">
                                                    <table id="tbl-grid3" class="table table-striped table-bordered table-hover">
                                                         <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Syarat</th>
                                                                <th>Lihat File</th>
                                                                <!--<th>Keterangan</th>-->
                                                            </tr>
                                                         </thead>
                                                         <tbody id="list_syarat">
                                                              
                                                         </tbody>
                                                    </table>
                                                </div> 
                                           </span>
                                        </div>
                                    </div>
                                    <!-- END DIV FORM GROUP-->
                            </form>
                    </div>
                </div>

               
<?php } ?>

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

        <!-- Sweet alert -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>

        <!-- Input Mask-->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/jasny/jasny-bootstrap.min.js"></script>

        <script type="text/javascript">
        $(document).ready(function(){
            get_all_pegawai();
            cekk();

            $('#alasan_tolak').hide();
            $('#detail_form').hide();
            $('#btn_simpan_all').prop('disabled', true)
            // $('#btn_terima').prop('disabled', true);
            // $('#btn_tolak').prop('disabled', true);
            $('#table_persyaratan').hide();
            // $('#sk_cpns').prop('checked', true);
            /*$('#table_pegawai').hide();*/
            $('#btn_penting').hide();
            $('#tbl-grid').hide();
            $('#tbl-grid2_filter').css('display','none');
            

			//$('.panel-body').hide();
			
			$('#icon-filter').on('click', function(){
				$(this).find("i").toggleClass('fa-sort-asc fa-sort-desc');
				//~$('#icon-filter').html('<i class="fa fa-sort-asc" aria-hidden="true"></i>');
				$('.panel-body').fadeToggle("slow");
			})
			


			//~function update_status_file(file_syarat){
				//~$.ajax({
	                //~url: '<?php echo base_url("index.php/skpd/update_keterangan_file") ?>',
	                //~type: 'post',
	                //~data: {
	                    //~file_syarat: file_syarat
	                //~},
	                //~dataType: 'json',
	                //~success: function(data){
	                    //~console.log(data);
	                //~}
	            //~});
			//~}







            // $('#fungsional_pengangkatan').show();
            // $('#fungsional_pembebasan').hide();
            // $('#fungsional_pengangkatan_kembali').hide();
            // $("#jenis").on("change", function(event) {
            //     event.preventDefault();
            //         onchangeJenis();
            // });

            // $('#jenis').change(function(e){
            //     e.preventDefault();
            //     var jenis = $('#jenis').val();
            //     console.log(jenis);
            // })

            $('#btn_batal').click(function(e){
                e.preventDefault();
                $('#button_penting').show();
                $('#alasan_tolak').hide();
                var idRow = $('#idRow').val();
                // console.log(idRow);
                $('#'+ idRow +'').removeClass('tolak');
            })

            $('#btn_simpan_all').click(function(e){
                e.preventDefault();
                //simpan_data();
                confirmKirimData();
            })

            $('#btn_terima').click(function(e){
                e.preventDefault();
                var idRow = $('#idRow').val();
                console.log(idRow);
                $('#'+ idRow +'').addClass('terima');
                cekk();
                $('#'+ idRow +'').removeClass('tolak');
                $('html, body').animate({
                    scrollTop: $("#tbl_list_pegawai").offset().top
                }, 2000);
	            //~var id_trx_terima = {};
	            //~var id_trxs = [];
	            //~$("tr.terima > td > span#id_trx_tbl").each(function() {
	                //~var value = $(this).text();
	                //~id_trx_trm = {
	                    //~_ket: 1,
	                    //~id: value,
	                //~}
	                //~id_trxs.push(id_trx_trm);
	              //~// id_trx.push($(this).text());
	            //~});
                //~localStorage.setItem('tempStorage', JSON.stringify(id_trxs));
                //
                
            })


            $('#btn_tolak').click(function(e){
                e.preventDefault();
                var idRow = $('#idRow').val();
                // console.log(idRow);
                $('#'+ idRow +'').addClass('tolak');
                $('#'+ idRow +'').removeClass('terima');
                // $('html, body').animate({
                //     scrollTop: $("#alasan_tolak").offset().top
                // }, 2000);
                $('#button_penting').hide();
                $('#message_tolak').hide();
                $('#alasan_tolak').show();
                $('#btn_simpan').prop('disabled', true);
            })

            $('#alasan_tolak_textarea').keyup(function(){
                disable_simpan_tolak();
            })

            $('#btn_simpan').click(function(e){
                e.preventDefault();
                tolak();
                $('#message_tolak').show();
            })

            $('#tbl_list_dt tbody').on('click', 'tr', function(){
                // $(this).toggleClass('selected');
            });

            $('#btn_tambah').click(function(e){
                // console.log('Hello');
                e.preventDefault();
               // getdatapermohonan();
               // getpgwai();
            });

            // $('#jenis').change(function(e){
            //     e.preventDefault();
            //     var jenis = $('#jenis').val();
            //     // console.log(jenis);
            //     cek_jenis();
            // });

            $('#cek').click(function(e){
                e.preventDefault();
                var kopang = $('#filter_pegawai').val();
                console.log(kopang); 
            });
            
            $('#ref_permohonan, #jenis_permohonan, #gol_pegawai, #kojabf').change(function(){
                // var filter1 = $('#ref_permohonan').val();
                // var filter2 = $('#jenis_permohonan').val();
                // var filter3 = $('#gol_pegawai').val();
                // disable(filter1, filter2, filter3);
                // console.log($('#ref_permohonan').val() + ' ' + $('#jenis_permohonan').val() + ' ' + $('#gol_pegawai').val());
                // $('#btn_simpan_all').prop('disabled', false)
                getpgwai();
            });

            $('#btn-simpan').click(function(e){
                e.preventDefault();
                var sel = $('input[type=checkbox]:checked').map(function(_, el) {
                    return $(el).val();
                }).get();
                 //console.log(is_null(sel));
                if(sel.length == 0){
                    
                    swal("DATA PEGAWAI BELUM DIPILIH");
                    $('#myModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                }else{
                    var jenis_permohonan = $('#jenis_permohonan').val();
                    getpgwaiwip(sel, jenis_permohonan);
                    $('#myModal').modal('toggle');
                    $('#table_pegawai').show();
                    //$('#tbl-grid2').show();
                    $('input:checkbox').removeAttr('checked');
                }
                
                // console.log(sel);
                // console.log(test);
                //alert(sel);
            });

            $("#tbl-grid2").on('click','#deleteRow',function(e){
                // console.log($('#nrk').val());
                $('#id_trx').val('');
                $('#nrk').val('');
                $('#nama_pegawai').val('');
                $('#alamat_pegawai').val('');
                $('#rt_pegawai').val('');
                $('#rw_pegawai').val('');
                $('#wilayah_pegawai').val('');
                $('#kecamatan_pegawai').val('');
                $('#kelurahan_pegawai').val('');
                e.preventDefault();
                $(this).closest('tr').remove();
                $('#table_persyaratan').hide();
                $('#btn_terima').prop('disabled', true);
                $('#btn_tolak').prop('disabled', true);
                $('#btn_penting').hide();
            });

            $("#tbl-grid2").on('click','#table_nrk, #table_nama, #table_tgl',function(e){
                e.preventDefault();
                var nrkPegawai = $(this).closest('tr').children('td:eq(0)').text();
                
                get_detail_pegawai(nrkPegawai);
                // console.log($('#nrk').val() + ' from table');
                // setTimeout(persyaratan(), 50000);
                $('#table_persyaratan').show();
                // $('#btn_terima').prop('disabled', true);
                // $('#btn_tolak').prop('disabled', true);
                verifikasi_file(nrkPegawai);
                $('#btn_penting').show();
            });

            /*$('#btn_terima').click(function(e){
                var jenis_permohonan = $('#jenis_permohonan').val();
                var no_surat = $('#no_surat').val();
                var tgl_surat = $('#tgl_surat').val();
                var nrk = $('#nrk').val();
                // var id_trx = $('#id_trx').val();
                // alert (id_trx);
                //console.log(jenis_permohonan + ' ' + no_surat)
                if(no_surat != "" && tgl_surat !=""){
                    e.preventDefault();
                    
                    terima();
                    $('#tbl-grid > tbody > tr').find("td:contains('"+ nrk +"')").closest("tr").remove();
                    $('#id_trx').val('');
                    $('#nrk').val('');
                    $('#nama_pegawai').val('');
                    $('#alamat_pegawai').val('');
                    $('#rt_pegawai').val('');
                    $('#rw_pegawai').val('');
                    $('#wilayah_pegawai').val('');
                    $('#kecamatan_pegawai').val('');
                    $('#kelurahan_pegawai').val('');
                    // $('#tbl_modal').hide();
                    //$("#tbl-grid > tbody > tr").html("");
                    $("#tbl-grid2 > tbody > tr").html("");
                    $('#table_pegawai').hide();
                    // $('#tbl-grid2').empty();
                    $('#table_persyaratan').hide();
                    $('#btn_terima').prop('disabled', true);
                    $('#btn_tolak').prop('disabled', true);
                    $('#btn_penting').hide();
                    
                }else{
                    alert('No Surat dan Tg Surat harus diisi');
                    return false;
                }
            });*/

            /*$('#btn_tolak').click(function(e){
                e.preventDefault();
                var nrk = $('#nrk').val();
                tolak();
                $('#tbl-grid > tbody > tr').find("td:contains('"+ nrk +"')").closest("tr").remove();
                    $('#id_trx').val('');
                    $('#nrk').val('');
                    $('#nama_pegawai').val('');
                    $('#alamat_pegawai').val('');
                    $('#rt_pegawai').val('');
                    $('#rw_pegawai').val('');
                    $('#wilayah_pegawai').val('');
                    $('#kecamatan_pegawai').val('');
                    $('#kelurahan_pegawai').val('');
                    // $('#tbl_modal').hide();
                    //$("#tbl-grid > tbody > tr").html("");
                    $("#tbl-grid2 > tbody > tr").html("");
                    $('#table_pegawai').hide();
                    // $('#tbl-grid2').empty();
                    $('#table_persyaratan').hide();
                    $('#btn_terima').prop('disabled', true);
                    $('#btn_tolak').prop('disabled', true);
                    $('#btn_penting').hide();
            });*/

            $('#tbl-grid2 tbody').on('click', 'tr', function () {
                var selected = [];
                var id = this.id;
                var index = $.inArray(id, selected);
         
                if ( index === -1 ) {
                    selected.push( id );
                } else {
                    selected.splice( index, 1 );
                }
                var nrkPegawai = $(this).closest('tr').children('td:eq(0)').text();
                get_detail_pegawai(nrkPegawai);
                $('#table_persyaratan').show();
                verifikasi_file(nrkPegawai);
                $('#btn_penting').show();
                $(this).toggleClass('selected');
                
            });
            
            $('#no_surat').keyup(function(){
    
                disable();               
                  // cekk();  
                
                
            })

            $('#tgl_surat').change(function(){
                disable();
               // cekk();
            })

        });

        var ct=0;
        var ct2=0;
        var ct3=0;
        var ct4=0;
        var ct5=0;
       
        var value1;
        var value2;
        var value3;
        var value4;
        var value5;

        var id_trxs = [];
        var id_trxs2 = [];
        var id_trxs3 = [];
        var id_trxs4 = [];
        var id_trxs5 = [];

        function cekk()
        {
            var idRow = $('#idRow').val();
            
            
           
            /*$("tr.terima > td > span#id_gol").each(function() {
                var valueTemp = $(this).text();
                
                if(ct == 1)
                {
                    value1 =valueTemp;
                    id_trxs.push(valueTemp);
                }    
                else if(ct>1)
                {
                    if(value1 != valueTemp)
                    {
                        swal('Golongan bukan '+value1);
                        
                        $('#'+ idRow +'').removeClass('terima');
                        $('html, body').animate({
			                scrollTop: $("#tbl_list_pegawai").offset().top
			            }, 2000);
                    }
                    else
                    {
                        id_trxs.push(valueTemp);
                    }
                }
            });
            ct++;*/
            
            $("tr.terima > td > span#id_ref").each(function() {
                var valueTemp2 = $(this).text();
                
                if(ct2 == 1)
                {
                    value2 =valueTemp2;
                    id_trxs2.push(valueTemp2);
                }    
                else if(ct2>1)
                {
                    if(value2 != valueTemp2)
                    {
                        swal('Permohonan bukan '+value2);
                        
                        $('#'+ idRow +'').removeClass('terima');
                        $('html, body').animate({
			                scrollTop: $("#tbl_list_pegawai").offset().top
			            }, 2000);
                    }
                    else
                    {
                        id_trxs2.push(valueTemp2);
                    }
                }
            });
            
            ct2++;

            $("tr.terima > td > span#id_jns").each(function() {
                var valueTemp3 = $(this).text();
                
                if(ct3 == 1)
                {
                    value3 =valueTemp3;
                    id_trxs3.push(valueTemp3);
                }    
                else if(ct3>1)
                {
                    if(value3 != valueTemp3 || value3 == 'undefined')
                    {
                        swal('Jenis Permohonan bukan '+value3);
                        $('#'+ idRow +'').removeClass('terima');
                        $('html, body').animate({
			                scrollTop: $("#tbl_list_pegawai").offset().top
			            }, 2000);
                    }
                    else
                    {
                        id_trxs3.push(valueTemp3);
                    }
                }
            });
            
            ct3++;
        
        	$("tr.terima > td > span#id_jab").each(function() {
                var valueTemp4 = $(this).text();

                
                if(ct4 == 1)
                {
                    value4 =valueTemp4;
                    id_trxs4.push(valueTemp4);
                }    
                else if(ct4>1)
                {
                    if(value4 != valueTemp4)
                    {
                        swal('Jabatan bukan '+value4);
                        
                        $('#'+ idRow +'').removeClass('terima');
                        $('html, body').animate({
			                scrollTop: $("#tbl_list_pegawai").offset().top
			            }, 2000);
                    }
                    else
                    {
                        id_trxs4.push(valueTemp4);
                    }
                }
            });
            
            ct4++;

            $("tr.terima > td > span#id_jen").each(function() {
                var valueTemp5 = $(this).text();

                
                if(ct5 == 1)
                {
                    value5 =valueTemp5;
                    id_trxs5.push(valueTemp5);
                }    
                else if(ct5>1)
                {
                    if(value5 != valueTemp5)
                    {
                        swal('Jenjang bukan '+value5);
                        
                        $('#'+ idRow +'').removeClass('terima');
                        $('html, body').animate({
                            scrollTop: $("#tbl_list_pegawai").offset().top
                        }, 2000);
                    }
                    else
                    {
                        id_trxs5.push(valueTemp5);
                    }
                }
            });
            
            ct5++;

            $("tr.terima > td > span#id_sop").each(function() {
                var valueIDSOP = $(this).text();
                
                if(ctSOP == 1)
                {
                    value_IDSOP =valueIDSOP;
                    id_trxs5.push(valueIDSOP);
                }    
                else if(ctSOP>1)
                {
                    if(value_IDSOP != valueIDSOP)
                    {
                        swal('ID SOP bukan '+value_IDSOP);
                        
                        $('#'+ idRow +'').removeClass('terima');
                        $('html, body').animate({
                            scrollTop: $("#tbl_list_pegawai").offset().top
                        }, 2000);
                    }
                    else
                    {
                        id_trxsSOP.push(valueIDSOP);
                    }
                }
            });
            var valueIDSOP;
            var ctSOP;
            ctSOP++;

            if(/*value1!=undefined ||*/ /*value2!=undefined ||*/ value3!=undefined /*|| value4!=undefined*/ || value5!=undefined || valueIDSOP!=undefined )
            {
                    disable();    
            }
        }

       


        function resetField()
        {
                $('#id_trx').val('');
                $('#nrk').val('');
                $('#nama_pegawai').val('');
                $('#alamat_pegawai').val('');
                $('#rt_pegawai').val('');
                $('#rw_pegawai').val('');
                $('#wilayah_pegawai').val('');
                $('#kecamatan_pegawai').val('');
                $('#kelurahan_pegawai').val('');
                 $('#detail_form').hide();
                $('#table_persyaratan').hide();
                $('#no_surat').val('');
                $('#tgl_surat').val('');
                var ct=0;
                var ct2=0;
                var ct3=0;
                var ct4=0;
                var ct5=0;
               
                var value1;
                var value2;
                var value3;
                var value4;
                var value5;

                var id_trxs = null;
                var id_trxs2 = null;
                var id_trxs3 = null;
                var id_trxs4 = null;
                var id_trxs5 = null;
        }

        function terima(){
            var no_surat = $('#no_surat').val();
            var tgl_surat = $('#tgl_surat').val();
            var id_trx = $('#id_trx').val();
            
            $.ajax({
                url: '<?php echo base_url("index.php/skpd/terima")?>/',
                type: 'post',
                data: {
                    ID_TRX: id_trx, NO_SURAT_SKPD: no_surat, TGL_SURAT_SKPD: tgl_surat
                },
                dataType: 'json',
                success: function(data){
                    console.log(data);
                }
            })
        }

        function tolak(){
            var id_trx = $('#id_trx').val();
            var keterangan = $('#alasan_tolak_textarea').val();
            var idRow = $('#idRow').val();
            $.ajax({
                url: '<?php echo base_url("index.php/skpd/tolak")?>/',
                type: 'post',
                data: {
                    ID_TRX: id_trx, KETERANGAN: keterangan
                },
                dataType: 'json',
                success: function(data){
                    if(data == 1){
                        $('#message_tolak').html('<div class="alert alert-success text-center" role="alert"><h3>Sukses!</h3></div>');
                        $('#alasan_tolak').hide();
                        // $('#verifikasi').prop('disabled', true);
                    }
                    // console.log(data);
                }
            })
        }

        function disable_simpan_tolak(){
            var alasan_tolak_textarea = $('#alasan_tolak_textarea').val();
            if(!alasan_tolak_textarea){
                $('#btn_simpan').prop('disabled', true);
            }else{
                $('#btn_simpan').prop('disabled', false);
            }
        }

        function disable(){
            var no_surat = $('#no_surat').val();
            var tgl_surat = $('#tgl_surat').val();
           
           
            if(!no_surat || !tgl_surat){
                $('#btn_simpan_all').prop('disabled', true);
            
            }else{
            
                $('#btn_simpan_all').prop('disabled', false);
            }

        }



        

        function verifikasi_click(nrkPegawai, idPermohonan, idJenisPermohonan, idRow, idTrx){
            verifikasi_file(nrkPegawai);
            get_detail_pegawai(nrkPegawai, idPermohonan,idJenisPermohonan);
            //persyaratan(idTrx);
            // console.log(idRow);
            $('#idRow').val('nomor_' + idRow);
            $('#id_trx').val(idTrx);
            // $(this).closest('tr').append()
            $('#detail_form').show();
            $('html, body').animate({
                scrollTop: $("#detail_form").offset().top
            }, 2000);
            

            // $(this).toggleClass('selected');
            // $("#tbl_list_dt").append("<td>row content</td>");
            // var nrkPegawai = $(this).closest('tr').children('td:eq(0)').text();
            // console.log(nrkPegawai);
            /*$('#table_persyaratan').show();*/
            $('#alasan_tolak_textarea').val('');
            $('#alasan_tolak').hide();
            $('#button_penting').show();
            $('#message_tolak').hide();
        }

        function btn_verifikasi(asd){
            $('#verifikasi_btn').closest('tr').css('background-color','#34495e');
            $('#verifikasi_btn').closest('tr').css('color','#fff');
            var nrkPegawai = $('#verifikasi_btn').closest('tr').children('td:eq(0)').text();
            get_detail_pegawai(nrkPegawai);
            $('#table_persyaratan').show();
            verifikasi_file(nrkPegawai);
            $('#btn_penting').show();
            return false;                
        }    

        function confirmKirimData(){
                /*START SWEETALERT*/                
                    swal({
                        title: "Anda yakin akan mengirim data ini? Silahkan cek kembali data yang akan dikirim dengan fitur filter diatas tabel",                        
                        text: "Data tidak dapat diubah setelah dikirim!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#38ec00",
                        confirmButtonText: "Ya, Kirim!",
                        cancelButtonColor: "#000000",
                        cancelButtonText: "Tidak, Batalkan!",
                        closeOnConfirm: false
                    }, function (isConfirm) {
                        if (isConfirm) {
                            simpan_data();                            
                        }else
                        {
                            return false;
                        }                         
                    });               
                /*END SWEETALERT*/
            }   

        function simpan_data(){
            var id_trx_tolak = {};
            var id_trx_terima = {};
            var id_trxs = [];
            $("tr.terima > td > span#id_trx_tbl").each(function() {
                // $("tr.terima > td > span#id_sop").each(function() {
                    var value = $(this).text();
                    // var value = $("tr.terima > td > span#id_trx_tbl").text();
                    var value1 = $("tr.terima > td > span#id_sop").text();
                    id_trx_trm = {
                        _ket: 1,
                        id: value,
                        id_sop: value1[0]
                    }
                    id_trxs.push(id_trx_trm);
                // })
              // id_trx.push($(this).text());
            });
            $("tr.tolak > td > span#id_trx_tbl").each(function() {
                var value = $(this).text();
                id_trx_tlk = {
                    _ket: 3,
                    id: value,
                }
                //id_trxs.push(id_trx_tlk);
              // id_trx.push($(this).text());
            });

            // console.log(JSON.stringify(id_trxs));return false;
            
            var no_surat_permohonan_post = $('#no_surat').val();
            // console.log(no_surat_permohonan_post);
            var tgl_surat_permohonan_post = $('#tgl_surat').val();
           if(id_trxs.length == 0)
           {
                swal("Gagal!","Verifikasi file terlebih dahulu.","error");
           }
           else
           {
                // console.log(JSON.stringify(id_trxs));return false;
                //id sop hidden pada tabel
                $.ajax({
                url: '<?php echo base_url("index.php/skpd/simpan_data") ?>',
                type: 'post',
                data: {
                    no_surat_permohonan: no_surat_permohonan_post, tgl_surat_permohonan: tgl_surat_permohonan_post, id_trx: id_trxs
                },
                dataType: 'json',
                success: function(data){

                    //swal("data berhasil diteruskan", "success");
                    
                },
                complete:function(data)
                {
                    swal("Berhasil!","Data tersimpan.","success");
                    var t2 = $('#tbl_list_dt').DataTable();
                    t2.ajax.reload();
                    resetField();
                    $('#nomor_1').removeClass('terima');
                    $('#btn_simpan_all').prop('disabled',true)
                }
                })
           }
           
        }

  

        function verifikasi_file(nrk){
            //var nrk_post = $('#nrk').val();
            
            var regtest = new RegExp('error');
            $.ajax({
                url: '<?php echo base_url("index.php/skpd/verifikasi")?>/',
                type: 'post',
                data: {
                    nrk: nrk
                },
                dataType: 'json',
                success: function(data){
                    // console.log(data);
                    if(regtest.test(data)){
                        /*$('#btn_terima').prop('disabled', true);
                        $('#btn_tolak').prop('disabled', false);*/
                        /*console.log('yey');*/
                    }else{
                        /*$('#btn_terima').prop('disabled', false);
                        $('#btn_tolak').prop('disabled', true);*/
                        /*console.log('dang it');*/
                    }
                }    
            })
        }

        $('#data_2 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy",
            endDate: new Date()
        }).on('changeDate', function(e) {
        // Revalidate the date field
        $('#defaultForm2').bootstrapValidator('revalidateField', 'tgakhir');
        });

        function get_detail_pegawai(nrk_post, idPermohonan, idJenisPermohonan){
            // console.log('Hello from pegawai');
            $.ajax({
                url: '<?php echo base_url("index.php/skpd/get_detail_pegawai")?>/',
                type: 'post',
                data: {
                    nrk: nrk_post
                },
                dataType: 'json',
                success: function(data){
                    // console.log(data.nama_kecamatan + ' ' + data.nama_wilayah + ' ' + data.nama_kelurahan);
                    $('#id_trx').val(data.id_trx);
                    $('#nrk').val(data.nrk);
                    $('#nama_pegawai').val(data.nama);
                    $('#alamat_pegawai').val(data.alamat);
                    $('#rt_pegawai').val(data.rt);
                    $('#rw_pegawai').val(data.rw);
                    $('#wilayah_pegawai').val(data.nama_wilayah);
                    $('#kecamatan_pegawai').val(data.nama_kecamatan);
                    $('#kelurahan_pegawai').val(data.nama_kelurahan);
                    persyaratan(data.nrk, idPermohonan, idJenisPermohonan)
                }
            })
        }

     

        function getdatapermohonan(){
            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';
            var jeniss = $('#jenis').val();
            var no_surat = $('#no_surat').val();
            var tgl_surat = $('#tgl_surat').val();
            //var nrk = $('#nrk').val();

            var dtbl= $('#tbl-grid').DataTable({
                /*"aoColumns": [
                    { "bSortable": false },
                    null,
                    null,

                    { "bSortable": false }
                ],*/
//                destroy: true,
                bSort: false,
                responsive: false,
                "scrollX": true,
                "serverSide": true,
                "ajax": {
                    url: '<?php echo base_url("index.php/skpd/get_data_permohonan"); ?>/',
                    type: "post",
                    data: {
                        jenis: jeniss, no_surat: no_surat, tgl_surat: tgl_surat
                    },
                    beforeSend: function() {                        
                        $("#daftar_pegawai").html(spinner);
                    },
                    complete: function()
                    {
                         $("#daftar_pegawai").html('');
                    }
                }
                    
            });
             $('#tbl-grid_filter').css("display","none");//hide filtering
            
        }

        function get_all_pegawai(){
            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';
            // var spm = 'C180';
        
            var dtbl= $('#tbl_list_dt').DataTable({
               // "bFilter": false,
                /*"aoColumns": [
                    
                    { "bSortable": false },
                     { "bSortable": false },
                     { "bSortable": false },
                     { "bSortable": false},
                     { "bSortable": false},
                     { "bSortable": false},
                     { "bSortable": false},
                     { "bSortable": false}
                ],*/
                "scrollX":true,
                "destroy":true,
                "paging": false,
                "bSort" :false,
                responsive: false,
                "serverSide": true,

                "ajax": {
                    url: '<?php echo base_url("index.php/skpd/get_data_table"); ?>/',
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
                    // Instance the tour
                    var tour = new Tour({
                      steps: [
                      {
                        element: ".panel-info",
                        title: "Langkah Pertama",
                        content: "Gunakan dropdown di bawah ini untuk menfilter data yang di butuhkan.",
                        placement: "top",
                      },
                      {
                        element: "#verifikasi",
                        title: "Langkah Kedua",
                        content: "Klik button verifikasi untuk memverifikasi pegawai",
                        placement: "left",
                        onNext: function (tour) {
                            $('#verifikasi').click();
                        },
                      },
                      {
                        element: "#btn_terima",
                        title: "Langkah Ketiga",
                        content: "Klik button ini jika pegawai memenuhi persyaratan",
                        placement: "bottom",
                        onPrev: function (tour){
                            $('html, body').animate({
                                scrollTop: $("#tbl_list_pegawai").offset().top
                            }, 2000);
                            $('#detail_form').hide();
                        },
                      },
                      {
                        element: "#btn_tolak",
                        title: "Langkah Ketiga",
                        content: "Klik button ini jika pegawai tidak memenuhi persyaratan",
                        placement: "top",
                        onNext: function (tour){
                            $('#btn_terima').click();
                        },
                      },
                      {
                        element: "#nomor_1",
                        title: "Langkah Keempat",
                        content: "Setelah button terima di klik background akan berubah menjadi warna hijau",
                        placement: "left",
                        onNext: function (tour){
                            $('#nomor_1').removeClass('terima');
                            $('#nomor_1').addClass('tolak');
                        },
                      },
                      {
                        element: "#nomor_1",
                        title: "Langkah Keempat",
                        content: "Namun jika button tolak di klik background akan berubah menjadi warna merah",
                        placement: "left",
                        orphan: false,
                        onPrev: function(tour){
                            $('#nomor_1').removeClass('tolak');
                            $('#nomor_1').addClass('terima');
                        },
                        onNext: function (tour){
                            $('#nomor_1').removeClass('tolak');
                            $('#nomor_1').addClass('terima');
                        },
                      },
                      {
                        element: "#no_surat",
                        title: "Langkah Kelima",
                        content: "Tulis no surat",
                        placement: "bottom",
                        onNext: function (tour){
                            $('#no_surat').val('test no surat')
                        },
                      },
                      {
                        element: "#tgl_surat",
                        title: "Langkah Keenam",
                        content: "Tulis tgl surat",
                        placement: "top",
                        onNext: function (tour){
                            $('#tgl_surat').val('04-08-2017');
                            disable()
                        },
                      },
                      {
                        element: "#btn_simpan_all",
                        title: "Langkah Terakhir",
                        content: "Klik button ini untuk mensimpan data",
                        placement: "bottom",
                      },

                      /*{
                        element: "#my-other-element",
                        title: "Title of my step",
                        content: "Content of my step"
                      }*/
                    ],
                    autoscroll: true,
                    smartPlacement: true,
                    debug: true,
                    backdrop: false,
                    animation: true,
                    backdropContainer: 'body'});

                    // Initialize the tour
                    tour.init();

                    // Start the tour
                    tour.start();
                }
            });

            
        }

        function persyaratan(nrk,id_permohonan,idJenisPermohonan){
            
            $.ajax({
                url: '<?php echo base_url("index.php/skpd/get_persyaratan"); ?>/',
                type: "post",
                data: {
                    NRK: nrk, ID_PERMOHONAN:id_permohonan, ID_JENIS_PERMOHONAN : idJenisPermohonan
                },
                dataType: 'JSON',
                success: function(data) {
                    
                    $("#list_syarat").html(data.dataTable);
                }
            });

            
        }

        function getpgwai(){
            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';

            var dtbl= $('#tbl_list_dt').DataTable({
                //~"aoColumns": [
                    //~{ "bSortable": false },
                    //~{ "bSortable": false },
                    //~{ "bSortable": false },
                    //~{ "bSortable": false},
                    //~{ "bSortable": false},
                    //~{ "bSortable": false},
                    //~{ "bSortable": false},
                    //~{ "bSortable": false}
                //~],
                // "scrollY":'50vh',
                "destroy":true,
                "paging": false,
                "bSort" :false,
                responsive: true,
                "destroy":true,
                "serverSide": true,
                "ajax": {
                    url: '<?php echo base_url("index.php/skpd/filter_function"); ?>/',
                    type: "post",
                    data: {
                        filter_pertama: $('#ref_permohonan').val(),
                        filter_kedua: $('#jenis_permohonan').val(),
                        filter_ketiga: $('#gol_pegawai').val(),
                        filter_empat: $('#kojabf').val()
                    },
                    beforeSend: function() {                        
                        $("#daftar_list_pegawai").html(spinner);
                    },
                    //~complete: function()
                    //~{
                        //~$("#daftar_list_pegawai").html('');
                    //~}
                }
            });
            // dtbl.on('select', function(e, dt, type, indexes){
            //     if(type == 'rows'){
            //         dtbl[ type ]( indexes ).nodes().to$().addClass( 'custom-selected' );
            //         // var data = dtbl.rows(indexes).data().pluck('id')
            //         console.log(data);
            //     }   
            // })
            $('#tbl-grid_filter').css("display","none");//hide filtering
            
        }

        function getpgwaiwip(pgw, jenis_permohonan){
            $.ajax({
                url: '<?php echo base_url("index.php/skpd/get_list_pegawai_wip"); ?>/',
                type: "post",
                data: {
                    NRK: pgw, PERMOHONAN: 1, JENIS: jenis_permohonan
                },
                dataType: 'JSON',
                success: function(data) {
                    $("#daftar_fix_pegawai").append(data.dataTable);
                }
            });
        }

        function getlistpermohonan(){
            $.ajax({
                url: '<?php echo base_url("index.php/skpd/get_jenis_permohonan"); ?>/',
                type: "post",
                data: {
                    ID_PERMOHONAN: id_pmh
                },
                dataType: 'JSON',
                success: function(data) {
                    $("#daftar_fix_pegawai").append(data);
                },
                error: function(xhr) {
                    $("#daftar_fix_pegawai").append('Error');  
                },
                complete: function() {

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

        

            
            function toggle() 
            {
                var ele = document.getElementById("formcol");
                var text = document.getElementById("displayText");

                if(ele.style.display != "none") 
                {
                    ele.style.display = "none";
                    text.innerHTML = "show";
                }

                else 
                {
                    ele.style.display = "";
                    text.innerHTML = "hide";
                }
            } 


        </script>

