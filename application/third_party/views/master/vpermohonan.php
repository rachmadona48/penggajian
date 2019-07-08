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
        <div class="col-lg-10">
            <h2>Permohonan</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo site_url()?>">Home</a>
                </li>
                <li class="active">
                    <strong>Permohonan</strong>
                </li>
            </ol>
             <small><i>(Menu untuk melakukan permohonan)</i></small>
        </div>
        <div class="col-lg-2">

        </div>
    </div>


<div class="wrapper wrapper-content">
    <?php if($user_group == 1){ ?>    
    <!-- START WELLCOME -->
    <div class="row">    
        <div class="col-md-12">
            <div class="ibox animated fadeInLeft">
                <div class="ibox-title navy-bg">
                    <h5>Permohonan Pegawai</h5>
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
                                            <div class="col-md-2">
                                                <label>Jenis Permohonan</label>    
                                            </div>
                                            <div class="col-md-4">
                                            <select class="form-control chosen-jenis" name="jenis" id="jenis" data-placeholder="Cari Berdasarkan...">
                                                <option value="1">Fungsional Pengangkatan</option>
                                                <option value="2">Fungsional Pembebasan</option>
                                                <option value="3">Fungsional Pengangkatan Kembali</option>            
                                            </select>
                                            </div>
                                        </div> <!-- end div class form-group-->

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <label>Persyaratan</label>
                                            </div>

                                            <br/>
                                            <table class="table" id="pengangkatan" style="display: none">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Uraian</th>
                                                        <th>Upload Berkas</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>FC. SK CPNS(80%)</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>FC. SK PNS(100%)</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>FC. SK PENETAPAN ANGKAT KREDIT(PAK)</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>FC. IJAZAH TERAKHIR</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>

                                                    <tr>
                                                        <td>5</td>
                                                        <td>FC. SK PANGKAT TERAKHIR</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>

                                                    <tr>
                                                        <td>6</td>
                                                        <td>FC. DP3/SKP 1 TAHUN TERAKHIR</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>

                                                    <tr>
                                                        <td>7</td>
                                                        <td>FC. SERTIFIKAT DIKLAT JABFUNG</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>

                                                    <tr>
                                                        <td>8</td>
                                                        <td>SURAT REKOMENDASI DARI INSTANSI PEMBINA</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>                                                    
                                                </tbody>
                                            </table>

                                            <table class="table" id="pengangkatan_kembali" style="display: none">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Uraian</th>
                                                        <th>Upload Berkas</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>FC. SK PENGANGKATAN DALAM JABFUNG</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>FC. SK PEMBEBASAN SEMENTARA JABFUNG</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>FC. SK PENETAPAN ANGKA KREDIT (PAK)</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>FC. SK PANGKAT TERAKHIR</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>

                                                    <tr>
                                                        <td>5</td>
                                                        <td>FC. IJAZAH TERAKHIR</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>

                                                    <tr>
                                                        <td>6</td>
                                                        <td>FC. DP3/SKP 1 TAHUN TERAKHIR</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>

                                                    <tr>
                                                        <td>7</td>
                                                        <td>SURAT REKOMENDASI DARI INSTANSI PEMBINA</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>            
                                                </tbody>
                                            </table>

                                            <table class="table" id="pembebasan_sementara" style="display: none">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Uraian</th>
                                                        <th>Upload Berkas</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>FC. SK PENGANGKATAN DALAM JABFUNG</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>FC. SK PENETAPAN ANGKA KREDIT (PAK)</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>FC. IJAZAH TERKAHIR</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>FC. DP3/SKP 1 TAHUN TERAKHIR</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>

                                                    <tr>
                                                        <td>5</td>
                                                        <td>FC. SK PANGKAT TERAKHIR</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>

                                                    <tr>
                                                        <td>6</td>
                                                        <td>BUKTI FISIK ALASAN PEMBEBASAN SEMENTARA<br/>
                                                            CONTOH<br/>
                                                            A.SK PENGANGKATAN JABATAN STRUKTURAL<br/>
                                                            B.SK TUGAS BELAJAR<br/>
                                                            C.SURAT PENUGASAN DI LUAR JABFUNG<br/>
                                                            D.SK CUTI DI LUAR TANGGUNGAN NEGARA<br/>
                                                            E.SK HUKUMAN DISIPLIN
                                                        </td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>

                                                    
                                                </tbody>
                                            </table>
                                        </div><!-- end div form group-->
                                                                                
                                        <br/>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-md-10">
                                            <div class="pull-right">
                                                <a onclick="" class="btn btn-primary" id="btnCari"><i class="fa fa-search"> Kirim</i></a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
								</form>
                                
                            
                       
                            <!-- :form -->
                            
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
            onchangeJenis();
            

            $("#jenis").on("change", function(event) {
                event.preventDefault();
                    onchangeJenis();
            });

        });

        function tampilkanPegawai2(formid) {
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
                            
                            d.res2 = $('#res2').val();
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
                    }
                    

                });
                $('#tbl-grid_filter').css("display","none");//hide filtering
            }

            

            /*START CHOSEN*/
            var config = {
                  '.chosen-jenis'           : {no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
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
                    document.getElementById('pengangkatan').style.display = "";
                    document.getElementById('pengangkatan_kembali').style.display = "none";
                    document.getElementById('pembebasan_sementara').style.display = "none";
                }
                else if(resJenis == 2)
                {
                    document.getElementById('pengangkatan').style.display = "none";
                    document.getElementById('pengangkatan_kembali').style.display = "";
                    document.getElementById('pembebasan_sementara').style.display = "none";
                }
                else
                {
                    document.getElementById('pengangkatan').style.display = "none";
                    document.getElementById('pengangkatan_kembali').style.display = "none";
                    document.getElementById('pembebasan_sementara').style.display = "";
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
                    text.innerHTML = "show";
                }

                else 
                {
                    ele.style.display = "";
                    text.innerHTML = "hide";
                }
            } 


        </script>

