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
            <h2>Laporan Data Pegawai</h2>
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
             <small><i>(Menu untuk melihat laporan)</i></small>
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
                            
                            
                    			<form class="form-inline" id="defaultForm" method="post">
                                    
                                    <div class="data-form-group">
                                        <div class="form-group">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6">
                                            <select class="form-control chosen-jenis" name="jenis" id="jenis" data-placeholder="Cari Berdasarkan...">
                                                <option value="1">Berkala</option>
                                                <option value="2">DPCP / Pensiun</option>
                                                <!--<option value="3">Penghargaan</option>-->            
                                            </select>
                                            </div>
                                            
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        
                                        <div class="form-group">
                                            <!-- BEGIN OF PARAMETER-->
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <!-- BERKALA -->
                                                    <div id="param1_1" style="display:none;">
                                                        <label>THBL*</label>
                                                    </div>
                                                    <!-- END BERKALA -->

                                                    <!-- DPCP -->    
                                                    <div id="param1_2" style="display:none;">
                                                        <label>TAHUN PENSIUN*</label>
                                                    </div>
                                                    <!-- END DPCP-->

                                                    <div id="divthbl" style="display:none">
                                                        <select class="form-control chosen-thbl" name="thblprm" id="thblprm" tabindex="2" data-placeholder="Pilih inputan..." >
                                                            <option value=""></option>
                                                            
                                                            <?php echo $tahunbrkl; ?>
                                                        </select>
                                                    </div>

                                                    <div id="divpns" style="display:none" >
                                                        <select class="form-control chosen-pnsiun" name="pnsprm" id="pnsprm"  data-placeholder="Pilih inputan..." onchange="onchangepns()">
                                                            <option value=""></option>
                                                        
                                                            <?php echo $tahunpns; ?>
                                                        </select>
                                                    </div>

                                                    <input type="hidden" class="form-control" placeholder="" name="res" id="res" value="" onchange="check_data()">
                                                </div>

                                                <div class="col-md-4" style="display:none" id="fieldspmu">
                                                    <label>SKPD</label>
                                                    <div id="divskpd"  >
                                                        <select class="form-control chosen-spmu" name="skpdbklprm" id="skpdbklprm"  data-placeholder="Pilih SKPD..." >
                                                            <option value=""></option>
                                                        
                                                            <?php echo $spmbrkl; ?>
                                                        </select>
                                                    </div>
                                                    <input type="hidden" class="form-control" placeholder="" name="res3" id="res3">
                                                </div>

                                                <div class="col-md-4" style="display:none" id="fieldnrk">
                                                    <!-- BERKALA -->
                                                    <div id="param2_1" style="display:none;">
                                                        <label>NRK</label>
                                                    </div>
                                                    <!-- END BERKALA-->

                                                    <!-- DPCP -->
                                                    <div id="param2_2" style="display:none;">
                                                        <label>NRK2*</label>
                                                    </div>
                                                    <!-- END DPCP -->

                                                    <input type="text" class="form-control" placeholder="" name="res2" id="res2" >
                                                </div>
                                            </div>
                                            <!-- END OF PARAMETER-->
                                           
                                           <div class="hr-line-dashed"></div>
                                            <!-- BEGIN OF FIELD INPUT REPORT -->
                                            <a id="displayText" href="javascript:toggle();">Hide</a>
                                            <div id="formcol">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <!-- BERKALA -->
                                                    <div id="field1_1" style="display:none;">
                                                        <label>Tujuan Surat:</label>
                                                    </div>
                                                    <!-- END BERKALA -->

                                                    <!-- DPCP -->
                                                    <div id="field1_2" style="display:none;">
                                                        <label>XX:</label>
                                                    </div>
                                                    <!-- END DPCP -->                                                    

                                                    <input type="text" class="form-control" placeholder="" name="value1" id="value1" value="">
                                                </div>
                                           </div>
                                           
                                           <br/>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <!--BERKALA-->
                                                    <div id="field2_1" style="display:none;">
                                                        <label>No PP:</label><br/>
                                                    </div>
                                                    <!-- END BERKALA -->

                                                    <!--DPCP-->
                                                    <div id="field2_2" style="display:none;">
                                                        <label>XX:</label><br/>
                                                    </div>
                                                    <!--END DPCP -->

                                                    <input type="text" class="form-control" placeholder="" name="value2" id="value2" value="">
                                                </div>

                                                <div class="col-md-6">
                                                    <!--BERKALA-->
                                                    <div id="field3_1" style="display:none;">
                                                        <label>Tahun PP:</label><br/>
                                                    </div>
                                                    <!-- END BERKALA-->

                                                    <!--DPCP-->
                                                    <div id="field3_2" style="display:none;">
                                                        <label>XX:</label><br/>
                                                    </div>                                                    
                                                    <!--END DPCP-->
                                                    <input type="text" class="form-control" placeholder="" name="value3" id="value3" value="">
                                                    
                                                </div>
                                            </div>
                                              <br/>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <!--BERKALA-->
                                                    <div id="field4_1" style="display:none;">
                                                        <label>Perubahan ke:</label>
                                                    </div>
                                                    <!--END BERKALA-->

                                                    <!--DPCP-->
                                                    <div id="field4_2" style="display:none;">
                                                        <label>xx:</label>
                                                    </div>
                                                    <!--END DPCP-->
                                                    <input type="text" class="form-control" placeholder="" name="value4" id="value4" value="">
                                                </div>

                                                <div class="col-md-6">
                                                    <!--BERKALA-->
                                                    <div id="field5_1" style="display:none;">
                                                        <label>Bagian Pengaju:</label>
                                                    </div>
                                                    <!--END BERKALA-->

                                                    <!--DPCP-->
                                                    <div id="field5_2" style="display:none;">
                                                        <label>xx:</label>
                                                    </div>
                                                    <!--END DPCP-->
                                                    <input type="text" class="form-control" placeholder="" name="value5" id="value5" value="" readonly>
                                                </div>
                                            </div>
                                            <br/>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Penanda Tangan:</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    

                                                    <div class="col-md-4">
                                                    <label>NRK</label>
                                                    <input type="text" class="form-control" placeholder="penanda tangan" name="valnrk" id="valnrk" value="181908" onchange="setNamaNip()">
                                                    </div>

                                                    <div class="col-md-4">
                                                    <label>Nama</label>
                                                    <input type="text" class="form-control" placeholder="penanda tangan" name="value6" id="value6" value="H.SURADIKA">
                                                    </div>


                                                    <div class="col-md-4">
                                                    <label>NIP</label>
                                                    <input type="text" class="form-control" placeholder="penanda tangan" name="value7" id="value7" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- END DIV FORMCOL-->
                                    </div><!-- END DIV FORM GROUP-->
                                                                                
                                        <br/>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <div class="pull-right" style="vertical-align: middle">
                                                <div class="row">
                                                    <div class="col-md-10" >
                                                        <!--<span>
                                                            <button onclick="return tampilkanPegawai2('defaultForm');" class="btn btn-primary btnCari" id="btnCari" ><i class="fa fa-search"></i> Tampilkan</button>
                                                        </span>-->
                                                        <div id="mdcari" style="display:none">
														  <a onclick="return tampilkanPegawai2('defaultForm');" class="btn btn-primary" id="btnCari"><i class="fa fa-search"></i> Tampilkan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                     <div class="col-md-10" >
                                                        <span id="cetaklap" >
                                                        

                                                            <!--<button type="button" onclick="cekfungsi()" class="btn btn-danger" id="btnPdf"><i class="fa fa-file-pdf-o"></i> Cetak</button>-->
                                                            <div id="mdcetak" style="display:none">
															<a onclick="cekfungsi(); return false;" id="btnPdf" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Cetak</a>
															</div>
                                                        
                                                        </span>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</form>
                                
                            
                       
                            <!-- :form -->
                            
                        </div>                                            
                    </div>
                </div>

                <!-- START DATA -->
                <div class="ibox-content" style="background-color: rgba(255,255,255,0.85)">
                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-12">
                            <table id="tbl-grid" class="table table-striped table-bordered table-hover dataTables-example" >
							     <thead>
        							<tr>
        								<th width="10px">No</th>
        								<th width="150px">NRK</th>
        								<th>Nama</th>
                                        <th>Aksi</th>
        							</tr>
							     </thead>

							     <tbody>
                                        <div id="daftar_pegawai"></div>                     
                                 </tbody>
					       </table>
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
            onchangeJenis();
            setNamaNip();
            

            $("#jenis").on("change", function(event) {
                event.preventDefault();
                    onchangeJenis();
            });

            $("#thblprm").on("change", function(event) {
                

                $('#res').val($(thblprm).val());
                $('#res3').val('');
           
                check_data();

                event.preventDefault();

                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/laporan/getSpmuFromBkala",
                    type: "post",
                    data: {thbl : $('#res').val()},
                    dataType: 'json',
                    beforeSend: function() {

                    },
                    success: function(data) {
                        if(data.response == 'SUKSES'){
                            list = '<option value=""></option>' + data.list;
                             $('#skpdbklprm').html(list);
                        }else{
                             $('#skpdbklprm').html('');
                        }

                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan. Silahkan coba kembali");
                    },
                    complete: function() {
                        $(".chosen-spmu").trigger("chosen:updated");

                       // $('#defaultForm2').bootstrapValidator('revalidateField', 'kokel');
                    }
                });
            });

            $("#pnsprm").on("change", function(event) {
                

                $('#res').val($(pnsprm).val());
                $('#res3').val('');
                //check_data();

                event.preventDefault();

                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/laporan/getSpmuFromPnsiun",
                    type: "post",
                    data: {tahun : $('#res').val()},
                    dataType: 'json',
                    beforeSend: function() {

                    },
                    success: function(data) {
                        if(data.response == 'SUKSES'){
                            list = '<option value=""></option>' + data.list;
                             $('#skpdbklprm').html(list);
                        }else{
                             $('#skpdbklprm').html('');
                        }

                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan. Silahkan coba kembali");
                    },
                    complete: function() {
                        $(".chosen-spmu").trigger("chosen:updated");

                       // $('#defaultForm2').bootstrapValidator('revalidateField', 'kokel');
                    }
                });
            });

            $("#skpdbklprm").on("change", function(event) {
                event.preventDefault();
                    var skpdbklprm = $('#skpdbklprm').val();

                    if(res3)
                    {
                        $('#res3').val(skpdbklprm);
                        
                    }

            });


        });
        
        
     
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
                pdfbkl();
            }
            else if($jenis==2)
            {
                pdfdpcp();
            }
        }

        function onchangethbl()
        {

        }

        function onchangepns()
        {
            $('#res').val($(pnsprm).val());
            check_data();
        }

        function tampilkanPegawai2(formid) {
               $('#tbl-grid').show();
                var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';  


               var dtbl= $('#tbl-grid').DataTable({
                	"aoColumns": [
						{ "bSortable": false },
						null,
						null,

						{ "bSortable": false }
					],
                    destroy: true,
                    responsive: false,
                    "scrollX": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "/laporan/getListPegawai",
                        "type": "POST",
                        "data": function ( d ) {
                           
                            d.jenis = $('#jenis').val();
                            d.res = $('#res').val();
                            
                            //d.res2 = $('#res2').val();
                            d.res3 = $('#res3').val();
                            d.v1 = $('#value1').val();
                            d.v2 = $('#value2').val();
                            d.v3 = $('#value3').val();
                            d.v4 = $('#value4').val();
                            d.v5 = $('#value5').val();
                            d.valnrk = $('#valnrk').val();
                            d.v6 = $('#value6').val();
                            d.v7 = $('#value7').val();

                        },
                        beforeSend: function() {                        
                            $("#daftar_pegawai").html(spinner);
                        },
                        complete: function()
                        {
                             $("#daftar_pegawai").html('');
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


            //BANYAK PEGAWAI 1 FILE
            function pdfdpcp() {
                
                var res = $('#res').val();
                var res3 = $('#res3').val();
                var v6 = $('#value6').val();
                var v7 = $('#value7').val();
                var valnrk = $('#valnrk').val();
                var url = '<?php echo base_url("index.php/laporan/cetakDpcpPDf"); ?>'
               

                if(res3 == "")
                {
                    res3='a';
                }
                var url2 = url+'/'+res+'/'+valnrk+'/'+v6+'/'+v7+'/'+res3;
                window.open(url2,'_blank');
                 
            }

            //BANYAK PEGAWAI 1 FILE
            function pdfbkl() {
                
                var res = $('#res').val();
                var res3 = $('#res3').val();
                var v1 = $('#value1').val();
                var v2 = $('#value2').val();
                var v3 = $('#value3').val();
                var v4 = $('#value4').val();
                var v5 = $('#value5').val();
                var v6 = $('#value6').val();
                var v7 = $('#value7').val();
                var valnrk = $('#valnrk').val();


                var url = '<?php echo base_url("index.php/laporan/cetakBkala"); ?>';
                var url2;
                if(res3=="")
                {
                    res3='a';

                }
                url2 = url+'/'+res+'/'+v1+'/'+v2+'/'+v3+'/'+v4+'/'+v5+'/'+v6+'/'+v7+'/'+valnrk+'/'+res3;
                window.open(url2,'_blank');
                
            }

            /*START CHOSEN*/
            var config = {
                  '.chosen-jenis'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                   '.chosen-thbl'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                    '.chosen-pnsiun'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                    '.chosen-spmu'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"}
                                }
                for (var selector in config) {
                  $(selector).chosen(config[selector]);
                }
            /*END CHOSEN*/

            function onchangeJenis()
            {
                var resJenis = document.getElementById('jenis').value;
                
                if(resJenis == 1)
                {
                    $('#res').val('');
                    $('#res3').val('');
                    $(".chosen-spmu").val('').trigger("chosen:updated");
                    $('#tbl-grid').DataTable().destroy();
                    $('#tbl-grid').hide();
                    
                    

                    document.getElementById('mdcari').style.display = "none";
                    document.getElementById('mdcetak').style.display = "none";
                    document.getElementById('param1_1').style.display = "";
                    $('#res').attr('placeholder','ex. 201501');

                    document.getElementById('fieldspmu').style.display = "";
                    $('#res3').attr('placeholder','SPMU');        
                    $('#fieldnrk').hide();
                    /*document.getElementById('param2_1').style.display = "";
                    document.getElementById('res2').value="";
                    $('#res2').hide();
                    $('#res2').attr('placeholder','NRK');*/

                    document.getElementById('field1_1').style.display = "";

                    $('#value1').show();
                    $('#value1').attr('placeholder','tujuan surat');
                    document.getElementById('value1').value="KEPALA BADAN PENGELOLA KEUANGAN DAERAH";

                    document.getElementById('field2_1').style.display = "";
                    $('#value2').show();
                    $('#value2').attr('placeholder','No PP');
                    document.getElementById('value2').value="34";

                    document.getElementById('field3_1').style.display = "";
                    $('#value3').show();
                    $('#value3').attr('placeholder','Tahun PP');
                    document.getElementById('value3').value="2014";

                    document.getElementById('field4_1').style.display = "";
                    $('#value4').show();
                    $('#value4').attr('placeholder','Perubahan ke (ex. keenambelas)');
                    document.getElementById('value4').value="keenambelas";

                    document.getElementById('field5_1').style.display = "";
                    $('#value5').show();
                    $('#value5').attr('placeholder','Bagian Pengaju');
                    document.getElementById('value5').value="KEPALA BADAN KEPEGAWAIAN DAERAH";
                    

                    document.getElementById('param1_2').style.display = "none";
                    document.getElementById('param2_2').style.display = "none";
                    document.getElementById('field1_2').style.display = "none";
                    document.getElementById('field2_2').style.display = "none";
                    document.getElementById('field3_2').style.display = "none";
                    document.getElementById('field4_2').style.display = "none";
                    document.getElementById('field5_2').style.display = "none";
                    document.getElementById('btnPdf').style.display = "";

                    document.getElementById('divthbl').style.display = "";
                    document.getElementById('divpns').style.display = "none";

                    //$('#res').val($('thblprm').val());

                    
                }
                else if(resJenis == 2)
                {
                    $('#res').val('');
                    $('#res3').val('');
                    $(".chosen-spmu").val('').trigger("chosen:updated");
                    $('#tbl-grid').DataTable().destroy();
                    $('#tbl-grid').hide();
                    document.getElementById('mdcari').style.display = "none";
                    document.getElementById('mdcetak').style.display = "none";
                    document.getElementById('param1_2').style.display = "";
                    $('#res').attr('placeholder','ex. 2015');

                    document.getElementById('fieldspmu').style.display = "";
                    $('#res3').attr('placeholder','SPMU');
                    /*document.getElementById('param2_2').style.display = "";
                    $('#res2').attr('placeholder','ex. 123456');*/
                    
                    $('#fieldnrk').hide();

                    /*document.getElementById('field1_2').style.display = "";
                    $('#value1').attr('placeholder','xx');*/
                    document.getElementById('value1').value="";
                    $('#value1').hide();

                    /*document.getElementById('field2_2').style.display = "";
                    $('#value2').attr('placeholder','xx');*/
                    document.getElementById('value2').value="";
                    $('#value2').hide();

                    /*document.getElementById('field3_2').style.display = "";
                    $('#value3').attr('placeholder','xx');*/
                    document.getElementById('value3').value="";
                    $('#value3').hide();

                    /*document.getElementById('field4_2').style.display = "";
                    $('#value4').attr('placeholder','xx');*/
                    document.getElementById('value4').value="";
                    $('#value4').hide();

                    /*document.getElementById('field5_2').style.display = "";
                    $('#value5').attr('placeholder','xx');*/
                    document.getElementById('value5').value="";
                    $('#value5').hide();

                    document.getElementById('param1_1').style.display = "none";
                    document.getElementById('param2_1').style.display = "none";
                    document.getElementById('field1_1').style.display = "none";
                    document.getElementById('field2_1').style.display = "none";
                    document.getElementById('field3_1').style.display = "none";
                    document.getElementById('field4_1').style.display = "none";
                    document.getElementById('field5_1').style.display = "none";
                    document.getElementById('btnPdf').style.display = "";

                    document.getElementById('divthbl').style.display = "none";
                    document.getElementById('divpns').style.display = "";

                    //$('#res').val($('pnsprm').val());
                }
                else
                {
                    
                    //$('#res').attr('placeholder','ex. xxx');
                }
            }

            

            function setNamaNip()
            {
                var valnrk = $('#valnrk').val();

                $.ajax({
                    url: '<?php echo base_url("index.php/laporan/getDtPgw"); ?>',
                    type: "post",
                    data: {
                        valnrk: valnrk
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        $('.msg').html('');
                        $('.err').html("");
                    },
                    success: function(data) {
                        $('#value6').val(data.NAMA);
                        $('#value7').val(data.NIP18);
                    
                    },
                    error: function(xhr) {
                        $('.msg').html('');
                        $('.err').html("<small>Terjadi kesalahan</small>");
                    },
                    complete: function() {

                    }
                    
                });
            
            }

            
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

