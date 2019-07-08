    <style type="text/css">
        #displayText{
            font-size: 23px;
            color: #1ab394;
            font-weight: bold;
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
            right: 10px;
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
                /*left: -65px;*/
                min-width: 100%;
                left: calc(100% - (125px));
                /*margin-top: 35px !important;*/
            }
            
            #btnPdf{
                margin-top: 37px;
            }
        }

    </style>    


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Laporan Rekap Data Pegawai</h2>
            <ol class="breadcrumb">
                <li>
                    <?php if($user_group == 4): ?>
                    <a href="<?php echo site_url('report/laporan')?>">Home</a>
                    <?php elseif($user_group == 2 || $user_group == 3 || $user_group == 11 || $user_group == 13): ?>
                    <a href="<?php echo site_url('pegawai')?>">Home</a>
                    <?php endif; ?>
                </li>
                <li class="active">
                    <strong>Laporan</strong>
                </li>
            </ol>
             <small><i>(Menu untuk melihat laporan rekap data pegawai)</i></small>
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
                    <h5>Laporan Rekap Data Pegawai</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>                        
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-12">

                            <!-- form: -->
                            
                            
                    			<form class="form-inline" id="defaultForm" method="post">
                                    
                                    <div class="data-form-group">
                                        <div class="form-group">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6">
                                            <select class="form-control chosen-jenis" name="jenis" id="jenis" data-placeholder="Cari Berdasarkan...">
                                                <option value="1">Per UKPD</option>
                                                <option value="2">Per SKPD</option>
                                                <option value="3">Per Gol</option>
                                                <option value="4">Nilai TKD Per Gol</option>
                                                <option value="5">Nilai Gaji Per Gol</option> 
                                                <option value="6">Rekap Gaji Per Gol</option>            
                                            </select>
                                            </div>
                                            
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        
                                        <div class="form-group">
                                            <!-- BEGIN OF PARAMETER-->
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <!-- BERKALA -->
                                                    <div id="param1_1">
                                                        <label>THBL*</label>
                                                    </div>
                                                    <div id="param1_2">
                                                        <label>TAHUN*</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <!-- END BERKALA -->
                                                    <div id="divthbl" style="display: none;">
                                                        <select class="form-control chosen-thbl" name="thblprm" id="thblprm" tabindex="2" data-placeholder="Pilih inputan..." >
                                                            <option value=""></option>
                                                                <?php echo $tahunbrkl; ?>
                                                        </select>
                                                    </div>

                                                    <div id="divthbl2" style="display: none;">
                                                        <select class="form-control chosen-thbl" name="thblprm2" id="thblprm2" tabindex="2" data-placeholder="Pilih inputan..." >
                                                            <option value=""></option>
                                                                <?php echo $tahunbrkl2; ?>
                                                        </select>
                                                    </div>

                                                    <div id="divthbl3" style="display: none;">
                                                        <select class="form-control chosen-thbl" name="thblprm3" id="thblprm3" tabindex="2" data-placeholder="Pilih inputan..." >
                                                            <option value=""></option>
                                                                <?php echo $tahunbrkl3; ?>
                                                        </select>
                                                    </div>

                                                    <input type="hidden" class="form-control" placeholder="" name="res" id="res" value="" onchange="check_data()">
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="pull-right" style="vertical-align: middle">
                                                        <div class="row">
                                                            <div class="col-md-10" >
                                                   
                                                                <div id="mdcari" style="display:none">
                                                                  <a onclick="return tampil('defaultForm');" class="btn btn-primary" id="btnCari"><i class="fa fa-search"></i> Tampilkan</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                             <div class="col-md-10" >
                                                                <span id="cetaklap" >
                                                                    <div id="mdcetak" style="display:none">
                                                                    <a onclick="cekfungsi(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
                                                                    </div>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div><!-- END DIV FORM GROUP-->
                                                                                
                                        
                                        
                                    </div>
								</form>
                                
                            
                       
                            <!-- :form -->
                            
                        </div>                                            
                    </div>
                </div>

                <!-- START DATA UKPD -->
                <div class="ibox-content" style="background-color: rgba(255,255,255,0.85);" id="ukpd">
                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-12">
                            
                            <table id="tbl-grid" class="table table-striped table-bordered table-hover dataTables-example">
							     <thead>
        							<tr>
        								<th rowspan="2" style="text-align:center; vertical-align: middle !important; ">No</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle !important; " >
                                        
                                        <span id="ukpdtitle" style="display: none">NAMA UKPD</span>
                                        <span id="skpdtitle" style="display: none">NAMA SKPD</span>
                                        <span id="goltitle" style="display: none">Gol</span>
                                        <span id="tkdtitle" style="display: none">Gol</span>
                                        <span id="gajititle" style="display: none">Gol</span>
                                        </th>
        								
                                        
        								<th rowspan="2" style="text-align:center; vertical-align: middle !important; ">Eselon 2</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle !important; ">Eselon 3</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle !important; ">Eselon 4</th>
                                        <th colspan="11" style="text-align:center; vertical-align: middle !important;">Staff</th>
                                        <th rowspan="2" style="text-align:center; vertical-align: middle !important;">

                                        <span id="ukpdtot" style="display: none">Total PER UKPD</span>
                                        <span id="skpdtot" style="display: none">Total PER SKPD</span>
                                        <span id="goltot" style="display: none">Total PER GOLONGAN</span>
                                        <span id="tkdtot" style="display: none">Total TKD PER GOLONGAN</span>
                                        <span id="gajitot" style="display: none">Total GAJI PER GOLONGAN</span>
                                        </th>
        							</tr>
                                    <tr>
                                        <th style="text-align:center; vertical-align: middle !important;">CPNS</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Teknis Ahli</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Teknis Terampil</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Adm. Ahli</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Adm. Terampil</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Operasional Ahli</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Operasional Terampil</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Pelayanan Ahli</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Pelayanan Terampil</th>
                                        <th style="text-align:center; vertical-align: middle !important; width: 50px;">JFT</th>
                                        <th style="text-align:center; vertical-align: middle !important; ">Lainnya</th>
                                    </tr>
							     </thead>

							     <tbody>
                                        <div id="daftar_pegawai"></div>                     
                                 </tbody>
					       </table>

					    </div>                                            
                    </div>
                </div>
                <!-- END DATA UKPD-->


                <div class="ibox-content" style="background-color: rgba(255,255,255,0.85);" id="pph">
                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-12">
                            
                            

                           <table id="tbl-grid2" class="table table-striped table-bordered table-hover dataTables-example" >
                                 <thead>
                                    <tr>
                                        <th style="text-align:center; vertical-align: middle !important; ">No</th>
                                        <th style="text-align:center; vertical-align: middle !important; ">THBL</th>
                                        <th style="text-align:center; vertical-align: middle !important; ">Golongan 1</th>
                                        <th style="text-align:center; vertical-align: middle !important; ">Golongan 2</th>
                                        <th style="text-align:center; vertical-align: middle !important; ">Golongan 3</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Golongan 4</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Total </th>
                                        <th style="text-align:center; vertical-align: middle !important;">Gaji Pokok</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Tunj.Keluarga</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Tunj.Jabatan</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Tunj.Fungsional</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Tunj.Lain</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Tunj.PPHGaji</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Tunj.Beras</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Lainnya</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Pembulatan</th>
                                        <th style="text-align:center; vertical-align: middle !important;">Total Gaji Kotor
                                    </tr>
                                 </thead>

                                 <tbody>
                                        <div id="daftar_pegawai2"></div>                     
                                 </tbody>
                           </table>
                           
                        </div>                                            
                    </div>
                </div>




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
            check_tabel();
            
            $("#jenis").on("change", function(event) {
                event.preventDefault();

               
                
                check_tabel();
                
                
                
            });

            $("#thblprm").on("change", function(event) {
                
                $('#res').val($(thblprm).val());
                check_data();
            
                event.preventDefault();
            });

            $("#thblprm2").on("change", function(event) {
                
                $('#res').val($(thblprm2).val());
                check_data();
            
                event.preventDefault();
            });

            $("#thblprm3").on("change", function(event) {
                
                $('#res').val($(thblprm3).val());
                check_data();
            
                event.preventDefault();
            });

        });
        
        function check_tabel()
        {
            var jenis = $('#jenis').val();
                
                
            if(jenis == 1)
            {
                //$('#tbl-grid').DataTable().clear().draw();
                //$('#tbl-grid tbody tr').remove();
                 $('#ukpd').hide();
                 $('#pph').hide();
                //$('#tbl-grid').hide();
                $('#ukpdtitle').show();
                $('#ukpdtot').show();
                $('#skpdtitle').hide();
                $('#skpdtot').hide();
                $('#goltitle').hide();
                $('#goltot').hide();
                $('#tkdtitle').hide();
                $('#tkdtot').hide();
                $('#gajititle').hide();
                $('#gajitot').hide();
                $('#divthbl').show();
                $('#divthbl2').hide();
                $('#divthbl3').hide();

                //$('#tbl-grid2').hide();

                $('#param1_1').show();
                $('#param1_2').hide();

                $('#res').val($(thblprm).val());
                check_data();
            }
            else if(jenis == 2)
            {   
                //$('#tbl-grid').DataTable().clear().draw();
                //$('#tbl-grid tbody tr').remove();
                $('#ukpd').hide();
                $('#pph').hide();
                //$('#tbl-grid').hide();
                $('#ukpdtitle').hide();
                $('#ukpdtot').hide();
                $('#skpdtitle').show();
                $('#skpdtot').show();
                $('#goltitle').hide();
                $('#goltot').hide();
                $('#tkdtitle').hide();
                $('#tkdtot').hide();
                $('#gajititle').hide();
                $('#gajitot').hide();

                //$('#tbl-grid2').hide();

                $('#param1_1').show();
                $('#param1_2').hide();

                $('#divthbl').show();
                $('#divthbl2').hide();
                $('#divthbl3').hide();

                
                $('#res').val($(thblprm).val());
                check_data();
            }
            else if(jenis == 3)
            {
                //$('#tbl-grid').DataTable().clear().draw();
                //$('#tbl-grid tbody tr').remove();
                $('#ukpd').hide();
                $('#pph').hide();
                //$('#tbl-grid').hide();
                $('#ukpdtitle').hide();
                $('#ukpdtot').hide();
                $('#skpdtitle').hide();
                $('#skpdtot').hide();
                $('#goltitle').show();
                $('#goltot').show();
                $('#tkdtitle').hide();
                $('#tkdtot').hide();
                $('#gajititle').hide();
                $('#gajitot').hide();

                //$('#tbl-grid2').hide();

                $('#param1_1').show();
                $('#param1_2').hide();

                $('#divthbl').show();
                $('#divthbl2').hide();
                $('#divthbl3').hide();

                
                $('#res').val($(thblprm).val());
                check_data();
            }
            else if(jenis == 4)
            {
                //$('#tbl-grid').DataTable().clear().draw();
                //$('#tbl-grid tbody tr').remove();
                $('#ukpd').hide();
                $('#pph').hide();
                //$('#tbl-grid').hide();
                $('#ukpdtitle').hide();
                $('#ukpdtot').hide();
                $('#skpdtitle').hide();
                $('#skpdtot').hide();
                $('#goltitle').hide();
                $('#goltot').hide();
                $('#tkdtitle').show();
                $('#tkdtot').show();
                $('#gajititle').hide();
                $('#gajitot').hide();

                //$('#tbl-grid2').hide();
                $('#param1_1').show();
                $('#param1_2').hide();

                $('#divthbl').hide();
                $('#divthbl2').show();
                $('#divthbl3').hide();

                
                $('#res').val($(thblprm2).val());
                check_data();
            }
            else if(jenis == 5)
            {
                //$('#tbl-grid').DataTable().clear().draw();
                //$('#tbl-grid tbody tr').remove();
                $('#ukpd').hide();
                $('#pph').hide();
                //$('#tbl-grid').hide();
                $('#ukpdtitle').hide();
                $('#ukpdtot').hide();
                $('#skpdtitle').hide();
                $('#skpdtot').hide();
                $('#goltitle').hide();
                $('#goltot').hide();
                $('#tkdtitle').hide();
                $('#tkdtot').hide();
                $('#gajititle').show();
                $('#gajitot').show();

                //$('#tbl-grid2').hide();
                $('#param1_1').show();
                $('#param1_2').hide();

                $('#divthbl').show();
                $('#divthbl2').hide();
                $('#divthbl3').hide();
                
                $('#res').val($(thblprm).val());
                check_data();
            }
            else if(jenis == 6)
            {
                $('#ukpd').hide();
                $('#pph').hide();
                //$('#tbl-grid').hide();
                $('#ukpdtitle').hide();
                $('#ukpdtot').hide();
                $('#skpdtitle').hide();
                $('#skpdtot').hide();
                $('#goltitle').hide();
                $('#goltot').hide();
                $('#tkdtitle').hide();
                $('#tkdtot').hide();
                $('#gajititle').hide();
                $('#gajitot').hide();

                //$('#tbl-grid2').hide();

                $('#param1_1').hide();
                $('#param1_2').show();
                $('#divthbl').hide();
                $('#divthbl2').hide();
                $('#divthbl3').show();
                
                $('#res').val($(thblprm3).val());
                check_data();
            }
        }
     
        function check_data(){

            var res = $('#res').val();

            if(!res){
                 document.getElementById('mdcari').style.display = "none";
                document.getElementById('mdcetak').style.display = "none";
           }else{
                document.getElementById('mdcari').style.display = "";
                document.getElementById('mdcetak').style.display = "";
            }
        }

        function cekfungsi()
        {
            $jenis= $('#jenis').val();
            if($jenis == 1)
            {
                pdfukpd();
            }
            else if($jenis==2)
            {
                pdfskpd();
            }
            else if($jenis == 3)
            {
                pdfgol();
            }
            else if($jenis == 4)
            {
                pdftkd();
            }
            else if($jenis == 5)
            {
                pdfgaji();
            }
            else if($jenis == 6)
            {
                pdfgajiPPH();    
            }
            
        }

        function tampil(formid)
        {
            var jenis = $('#jenis').val();

            if(jenis == 6)
            {
                tampilkanPegawai1(formid);
            }
            else
            {
                tampilkanPegawai2(formid);   
            }
        }

        function tampilkanPegawai1(formid) {
                $('#ukpd').hide();
                
                //$('#tbl-grid').hide();
                
                var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';  


               var dtbl= $('#tbl-grid2').DataTable({
                    "aoColumns": [
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false }
                    ],
                    destroy: true,
                    responsive: false,
                    "scrollX": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "/rekap/getListPegawai2",
                        "type": "POST",
                        "data": function ( d ) {
                           
                            d.jenis = $('#jenis').val();
                            d.res = $('#res').val();
                        
                        },
                        beforeSend: function() {
                            $("#daftar_pegawai2").html(spinner);    
                        },
                        complete: function()
                        {   
                            
                            $("#daftar_pegawai2").html('');
                            $('#pph').show();
                            //$('#tbl-grid2').show();
                            
                        }
                    },"initComplete": function() {
                        var $searchInput = $('div.dataTables_filter input');
             
                        $searchInput.unbind();
             
                        $searchInput.bind('keyup', function(e) {
                            if(e.keyCode == 13) {
                                dtbl.search( this.value ).draw();
                            }
                    }); }
                    

                });
                //$('#tbl-grid_filter').css("display","none");//hide filtering
            }

        function tampilkanPegawai2(formid) {
                $('#ukpd').show();
                $('#pph').hide();
               //$('#tbl-grid2').hide();
               

                var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';  


               var dtbl= $('#tbl-grid').DataTable({
                	"aoColumns": [
						{ "bSortable": false },
						{ "bSortable": false },
						{ "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false },
                        { "bSortable": false }

					],
                    destroy: true,
                    responsive: false,
                    "scrollX": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "/rekap/getListPegawai",
                        "type": "POST",
                        "data": function ( d ) {
                           
                            d.jenis = $('#jenis').val();
                            d.res = $('#res').val();
                        
                        },
                        beforeSend: function() {
                            $("#daftar_pegawai").html(spinner);    
                        },
                        complete: function()
                        {   
                            $("#daftar_pegawai").html('');
                 //           $('#tbl-grid').show();
                            $('#ukpd').show();
                            
                        }
                    },"initComplete": function() {
                        var $searchInput = $('div.dataTables_filter input');
             
                        $searchInput.unbind();
             
                        $searchInput.bind('keyup', function(e) {
                            if(e.keyCode == 13) {
                                dtbl.search( this.value ).draw();
                            }
                    }); }
                    

                });
                //$('#tbl-grid_filter').css("display","none");//hide filtering
            }


            

            function pdfukpd() {
                
                var res = $('#res').val();


                var url = '<?php echo base_url("index.php/rekap/cetakUkpd"); ?>';
                var url2;
                
                url2 = url+'/'+res;
                window.open(url2,'_blank');
                
            }

            function pdfskpd() {
                
                var res = $('#res').val();


                var url = '<?php echo base_url("index.php/rekap/cetakSkpd"); ?>';
                var url2;
                
                url2 = url+'/'+res;
                window.open(url2,'_blank');
                
            }

            function pdfgol() {
                
                var res = $('#res').val();


                var url = '<?php echo base_url("index.php/rekap/cetakGol"); ?>';
                var url2;
                
                url2 = url+'/'+res;
                window.open(url2,'_blank');
                
            }

            function pdftkd() {
                
                var res = $('#res').val();


                var url = '<?php echo base_url("index.php/rekap/cetakTKD"); ?>';
                var url2;
                
                url2 = url+'/'+res;
                window.open(url2,'_blank');
                
            }

            function pdfgaji() {
                
                var res = $('#res').val();


                var url = '<?php echo base_url("index.php/rekap/cetakGaji"); ?>';
                var url2;
                
                url2 = url+'/'+res;
                window.open(url2,'_blank');
                
            }

            function pdfgajiPPH() {
                
                var res = $('#res').val();


                var url = '<?php echo base_url("index.php/rekap/cetakGajiPPH"); ?>';
                var url2;
                
                url2 = url+'/'+res;
                window.open(url2,'_blank');
                
            }

            /*START CHOSEN*/
            var config = {
                  '.chosen-jenis'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                   '.chosen-thbl'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"}
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
                    text.innerHTML = "Show";
                }

                else 
                {
                    ele.style.display = "";
                    text.innerHTML = "Hide";
                }
            } 


        </script>

