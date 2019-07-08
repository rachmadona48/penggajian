    <style type="text/css">
        
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
        	width: 43%;
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
            right: 0;
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
        <div class="col-lg-10">
            <h2>Laporan Data Pegawai</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo site_url()?>">Home</a>
                </li>
                <li class="active">
                    <strong>Laporan</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>


<div class="wrapper wrapper-content">
    <?php if($user_group > 1){ ?>    
    <!-- START WELLCOME -->
    <div class="row">    
        <div class="col-md-12">
            <div class="ibox animated fadeInLeft">
                <div class="ibox-title navy-bg">
                    <h5>Laporan Data Pegawai</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>                        
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-12">

                            <!-- form: -->
                            <section>
                            <div class="col-lg-8 col-lg-offset-2">
                    			<form class="form-inline" id="defaultForm" method="post" action="javascript:tampilkanPegawai('defaultForm');">
                    				<div class="data-form-group">
									  	<div class="form-group">
									    	<label class="sr-only" for="exampleInputEmail3">Cari</label>
									    	<select class="form-control chosen-jenis" name="jenis[]" id="jenis1" onchange="return getOptionValue(this, 1);" data-placeholder="Cari Berdasarkan...">
                                                <option></option>
                                                <option value="KOLOK">Lokasi Kerja</option>
                                                <option value="KOJAB">Jabatan</option>
                                                <option value="ESELON">Eselon</option>
                                                <option value="KOPANG">Pangkat</option>
                                                <option value="JENKEL">Jenis Kelamin</option>
                                                <option value="KAWIN">Status Menikah</option>
                                                <option value="AGAMA">Agama</option>
                                                <option value="STAPEG">Status PNS / CPNS</option>
                                                <option value="FLAG">Status Aktif</option>
                                                <option value="NADIK">Pendidikan</option>
                                                <option value="MAKER">Masa Kerja</option>
                                                <option value="HUKDIS">Hukuman Disiplin</option>
                                                <option value="USIA">Usia</option>
                                                <option value="FASILITAS">Fasilitas</option>
                                            </select>
									  	</div>
									  	<div class="form-group">
									    	<label class="sr-only" for="exampleInputPassword3">Cari</label>
									    	<span class="value-param-1">
	                                            <input class="form-control" id="jenisop1" type="text" placeholder="..." />
	                                        </span>
									  	</div>
									  	
									  	<button type="button" class="btn btn-success btn-sm addButton" data-template="textbox"><i class="fa fa-plus"></i></button>
									</div>
									<div class="data-form-group hide" id="textboxTemplate">
									  	<div class="form-group">
									    	<label class="sr-only" for="exampleInputEmail3">Cari</label>
								    		<select  data-placeholder="Cari Berdasarkan...">
                                                <option></option>                                                
                                                <option value="KOLOK">Lokasi Kerja</option>
                                                <option value="KOJAB">Jabatan</option>
                                                <option value="KOPANG">Pangkat</option>
                                                <option value="ESELON">Eselon</option>
                                                <option value="JENKEL">Jenis Kelamin</option>
                                                <option value="KAWIN">Status Menikah</option>
                                                <option value="AGAMA">Agama</option>
                                                <option value="STAPEG">Status PNS / CPNS</option>
                                                <option value="FLAG">Status Aktif</option>
                                                <option value="NADIK">Pendidikan</option>
                                                <option value="MAKER">Masa Kerja</option>
                                                <option value="HUKDIS">Hukuman Disiplin</option>
                                                <option value="USIA">Usia</option>
                                                <option value="FASILITAS">Fasilitas</option>
                                            </select>
									  	</div>
									  	<div class="form-group">
									    	<label class="sr-only" for="exampleInputPassword3">Cari</label>
									    	<span class="value-param">
	                                            <input class="form-control" type="text" placeholder="..." />
	                                        </span>
									  	</div>
									  	
									  	<button type="button" class="btn btn-danger btn-sm removeButton"><i class="fa fa-minus"></i></button>
									</div>

                                    <div class="data-form-group">
                                        <div class="form-group">
                                            <div class="pull-right">
                                                <span>
                                                    &nbsp;
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="pull-right">                                                
                                                    <a onclick="return tampilkanPegawai('defaultForm');" class="btn btn-primary" id="btnCari"><i class="fa fa-search"> Tampilkan</i></a>
                                            </div>
                                        </div>
                                    </div>
								</form>
                                
                            </div>
                            </section>
                            <!-- :form -->
                            
                        </div>                                            
                    </div>
                </div>

                <!-- START DATA -->
                <div class="ibox-content" style="background-color: rgba(255,255,255,0.85)">
                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-12">

                            <div id="daftar_pegawai">
                            	<table id="tbl-grid" class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
							<tr>
								<th style="width:20px; text-align: center;">No</th>
								<th style="width:100px; text-align: center;">NRK</th>
								<th style="width:100px; text-align: center;">Nama</th>
								<th style="width:100px; text-align: center;">Jabatan</th>
								<th style="width:100px; text-align: center;">Lokasi</th>
								
								<th style="width:50px; text-align: center;">Aksi</th>
							</tr>
							</thead>
							<tbody></tbody>
						
					</table>
					</div>
                        </div>                                            
                    </div>
                </div>
                <!-- END DATA -->
            </div>
        </div>
    </div>
    <!-- END WELLCOME -->
    
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
                var spinner = '<div class="sk-spinner sk-spinner-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>';
                var counter = 2;
                $('.addButton').on('click', function() {
                    var index = $(this).data('index');
                    if (!index) {
                        index = 1;
                        $(this).data('index', 1);
                    }
                    index++;

                    $(this).data('index', index);
                    
                        var template    = $(this).attr('data-template'),
                        $templateEle    = $('#' + template + 'Template'),
                        $row            = $templateEle.clone().removeAttr('id').insertBefore($templateEle).removeClass('hide'),
                        $ex             = $row.find('.value-param').eq(0).attr('class', 'value-param-'+counter);
                        $el             = $row.find('select').eq(0).attr('name', 'jenis[]');
                        $elj            = $row.find('select').eq(0).attr('class', 'form-control chosen-jenis');
                        $elc            = $row.find('select').eq(0).attr('onchange', 'return getOptionValue(this,'+counter+');');
                        $el2            = $row.find('input').eq(0).attr('name',  template + '[]');
                        $('#defaultForm').bootstrapValidator('addField', $el);
                        counter++;
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

                 var dataTable = $('#tbl-grid').DataTable( {
				 	responsive: true,
				 	"processing": true,
				 	"serverSide": true
				 } );
                
            });
        </script>

        <script type="text/javascript">

            function checkJabatan(e){

            }

            function tampilkanPegawai(formid) {
                $('#example').DataTable( {
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "<?php echo site_url('reportk/getListPegawai')?>",
                        "data": function ( d ) {
                            d.myKey = "myValue";
                            // d.custom = $('#myInput').val();
                            // etc
                        }
                    }
                } );
            }

            function getOptionValue(e,i){     
                var spinner = '<div class="sk-spinner sk-spinner-circle animated fadeInRight"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>';           
                $.ajax({
                    url: "/report/getOptionValue",
                    type: "post",
                    data: {param:e.value},
                    dataType: 'json',
                    beforeSend: function() {
                        $(".value-param-"+i).html(spinner);
                    },
                    success: function(data) {                                                                     
                        if(data.response == 'SUKSES'){                           
                            $(".value-param-"+i).html(data.option);
                        }else{
                            $(".value-param-"+i).html('<i class="text-danger">Silahkan coba kembali</i>');
                        }
                    },
                    error: function(xhr) {                              
                        $(".value-param-"+i).html('<i class="text-danger">Silahkan coba kembali</i>');
                    },
                    complete: function() {
                        var config = {
                                        '.chosen-param' : {no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                                    }
                        for (var selector in config) {
                          $(selector).chosen(config[selector]);
                        }

                        if(e.value == "KOJAB"){
                            checkJabatan(e);
                        }
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

