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
            
            position: relative;
            
        }

        #btnExcel{
            
            
            position: relative;
            
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

         /*   #btnCari{
                position: absolute;
                /*left: -65px;*/
                min-width: 100%;
                left: calc(100% - (125px));
                /*margin-top: 35px !important;*/
            }*/
            
            #btnPdf{
                margin-top: 37px;
            }
        }


        table {  
    color: #333;
    font-family: Helvetica, Arial, sans-serif;
    
    border-collapse: 
    collapse; border-spacing: 0; 
}

td, th {  
    border: 1px solid transparent; /* No more visible border */
    height: 30px; 
    transition: all 0.3s;  /* Simple transition for hover effect */
}

th {  
    background: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
     text-align: center;
}

td {  
    background: #FAFAFA;
    text-align: center;
}

/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background: #F1F1F1; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
tr:nth-child(odd) td { background: #FEFEFE; }  

tr td:hover { background: #666; color: #FFF; }  
/* Hover cell effect! */

    </style>    





<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Riwayat</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>index.php">Home</a>
            </li>            
            <li class="active">
                <strong>Statistik</strong>
            </li>
        </ol>
        <small><i>(Menu untuk melihat statistik data pegawai)</i></small>
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
                    <h5>Statistik Data Pegawai</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>                        
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-2"></div>
                        <div class="col-md-2"><b><p align="right">JENIS DATA</p></b></div>
                        <div class="col-md-4">
                                <select class="form-control chosen-jenis" name="jenis" id="jenis" data-placeholder="Cari Berdasarkan...">
                                        <option selected value="0">--Pilih Data Statistik yang ingin ditampilkan--</option>
                                        <option value="1">Jenis Kelamin</option>
                                        <option value="2">Eselon</option>
                                        <option value="3">Usia</option>
                                        <option value="4">Pangkat</option>
                                        <option value="5">Pendidikan</option>
                                        <option value="6">Status Pernikahan</option>
                                        <option value="7">Masa Kerja</option>
                                        <option value="8">Agama</option>
                                        <option value="9">Tahun Pensiun</option>
                                       <!--  <option value="2">Usia</option>
                                        <option value="3">Masa Kerja</option> -->
                                </select>
                        </div>                                            
                    </div>

                           

                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-2"></div>
                        <div class="col-md-2"><b><p align="right">THBL</p></b></div>
                        <div class="col-md-4">
                            <select class="form-control chosen-thbl" name="thblp" id="thblp"  data-placeholder="Pilih inputan..." >
                                <option value=""></option>
                                    <?php echo $thblparam; ?>
                            </select>
                            
                        </div>
                        
                    </div>
 

                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-2"></div>
                        <div class="col-md-2"><b><p align="right">SKPD</p></b></div>
                        <div class="col-md-4">
                            <select class="form-control chosen-spmu" name="skpdp" id="skpdp" data-placeholder="Pilih inputan..." >
                                <option value=""></option>
                                    <?php echo $skpdparam; ?>
                            </select>
                        </div>
                        
                    </div>

                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-2"></div>
                        <div class="col-md-2"><b><p align="right">UKPD</p></b></div>
                        <div class="col-md-4">
                            <select class="form-control chosen-ukpd" name="ukpdp" id="ukpdp" data-placeholder="Pilih inputan..." >
                                <option value=""></option>
                                    <?php echo $ukpdparam; ?>
                            </select>
                        </div>
                    </div>
           
                    <div class="row m-b-lg m-t-lg">
                        
                        <div class="col-md-4"></div>
                        <div class="col-md-1">
                            <a onclick="return tampilkan_data();" class="btn btn-success " id="btnCari" ><i class="fa fa-search"></i> Tampilkan</a>
                        </div>
                        <div class="col-md-1"></div>
                        
                        <div class="col-md-1">
                            <a onclick="return cetak_data();" class="btn btn-primary" id="btnExcel"><i class="fa fa-files-o"></i> Cetak Excel</a>
                        </div>

                        <div class="col-md-4"></div>
                    </div>
                    
                    
                    
                    
                                
                </div>

                <!-- START DATA -->
                <div class="ibox-content" >
                    <div id="load" style="display: none"><div class="sk-spinner sk-spinner-three-bounce" style="width:110px;"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div></div></div>
                    <!-- <div id="divjenkel" style="display: none">
                        <div class="row m-b-lg m-t-lg">
                            <div class="col-md-12">
                                <table border="1" width="250px">
                                    <tr>
                                        <th >Pria</th>
                                        <th >Wanita</th>
                                    </tr>
                                    <tr>
                                        <td ><span id="priatd"></td>
                                        <td ><span id="wanitatd"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4" style="background-color: rgba(255,255,255,0.85)">
                               <label>Statistik Perbandingan Jumlah Pria dan Wanita PNS DKI JAKARTA</label>

                               <canvas id="chartjenkel" width="5px" height="50px"></canvas>
                               <input type="hidden" id="pria" value="">
                               <input type="hidden" id="wanita" value="">
    					    </div>  
                            

                        </div>
                    </div> -->

                    <div id="divjenkel" style="display: none">
                        <div class="row m-b-lg m-t-lg">
                            <h2>Pegawai</h2>
                            
                            <div class="col-md-12">
                                <table border="1" width="100%">
                                   
                                    <thead id="headerjenkel"></thead>
                                    <tbody id="isijenkel"></tbody>
                                </table>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="background-color: rgba(255,255,255,0.85)">
                               <label>Statistik Perbandingan Jenis Kelamin Per Golongan PNS DKI JAKARTA</label>

                               <canvas id="chartjenkel" ></canvas>
                               
                            </div> 
                        </div> 
                    </div>


                    <div id="divjenkelc" style="display: none">
                        <div class="hr-line-dashed"></div>
                        <div class="row m-b-lg m-t-lg">
                            <h2>Calon Pegawai</h2>
                            
                            <div class="col-md-12">
                                <table border="1" width="50%">
                                   
                                    <thead id="headerjenkelc"></thead>
                                    <tbody id="isijenkelc"></tbody>
                                </table>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="background-color: rgba(255,255,255,0.85)">
                               <label>Statistik Perbandingan Jenis Kelamin Per Golongan CPNS DKI JAKARTA</label>

                               <canvas id="chartjenkelc" ></canvas>
                               
                            </div> 
                            <div class="col-md-2"></div>
                        </div> 
                    </div>


                    <div id="diveselon" style="display: none">
                        <div class="row m-b-lg m-t-lg">
                            <h2>Eselon</h2>
                            
                            <div class="col-md-12">
                                <table border="1" width="100%">
                                   
                                    <thead id="headereselon"></thead>
                                    <tbody id="isieselon"></tbody>
                                </table>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="background-color: rgba(255,255,255,0.85)">
                               <label>Statistik Perbandingan Jumlah Eselon Per Golongan PNS DKI JAKARTA</label>

                               <canvas id="charteselon" ></canvas>
                               
                            </div> 
                        </div> 
                    </div>


                    <div id="divnoneselon" style="display: none">
                        <div class="hr-line-dashed"></div>
                        <div class="row m-b-lg m-t-lg">
                            <h2>Non Eselon</h2>
                            
                            <div class="col-md-12">
                                <table border="1" width="50%">
                                   
                                    <thead id="headernoneselon"></thead>
                                    <tbody id="isinoneselon"></tbody>
                                </table>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="background-color: rgba(255,255,255,0.85)">
                               <label>Statistik Perbandingan Jumlah Non Eselon Per Golongan PNS DKI JAKARTA</label>

                               <canvas id="chartnoneselon" ></canvas>
                               
                            </div> 
                            <div class="col-md-2"></div>
                        </div> 
                    </div>






                    <div id="divusia" style="display: none">
                        <div class="row m-b-lg m-t-lg">
                            
                            <div class="col-md-12">
                                <table border="1" width="100%">
                                   
                                    <thead id="headerusia"></thead>
                                    <tbody id="isiusia"></tbody>
                                </table>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="background-color: rgba(255,255,255,0.85)">
                               <label>Statistik Rekap Usia PNS DKI JAKARTA</label>

                               <canvas id="chartusia" ></canvas>
                               
                            </div> 
                        </div> 
                    </div>    




                    <div id="divpangkat" style="display: none">
                        <div class="row m-b-lg m-t-lg">
                            
                            <div class="col-md-12">
                                <table border="1" width="50%">
                                   
                                    <thead id="headerpangkat"></thead>
                                    <tbody id="isipangkat"></tbody>
                                </table>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="background-color: rgba(255,255,255,0.85)">
                               <label>Statistik Rekap Pangkat PNS DKI JAKARTA</label>

                               <canvas id="chartpangkat" ></canvas>
                               
                            </div> 
                        </div> 
                    </div> 


                    <div id="divpendidikan" style="display: none">
                        <div class="row m-b-lg m-t-lg">
                            <h2>Pegawai</h2>
                            
                            <div class="col-md-12">
                                <table border="1" width="100%">
                                   
                                    <thead id="headerpendidikan"></thead>
                                    <tbody id="isipendidikan"></tbody>
                                </table>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="background-color: rgba(255,255,255,0.85)">
                               <label>Statistik Rekap Pendidikan PNS DKI JAKARTA</label>

                               <canvas id="chartpendidikan" ></canvas>
                               
                            </div> 
                        </div> 
                    </div>

                    <div id="divpendidikan2" style="display: none">
                        <div class="hr-line-dashed"></div>
                        <div class="row m-b-lg m-t-lg">
                            <h2>Calon Pegawai</h2>
                            
                            <div class="col-md-12">
                                <table border="1" width="100%">
                                   
                                    <thead id="headerpendidikan2"></thead>
                                    <tbody id="isipendidikan2"></tbody>
                                </table>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="background-color: rgba(255,255,255,0.85)">
                               <label>Statistik Rekap Pendidikan Calon PNS DKI JAKARTA</label>

                               <canvas id="chartpendidikan2" ></canvas>
                               
                            </div> 
                        </div> 
                    </div> 

                    <div id="divstawin" style="display: none">
                        <div class="row m-b-lg m-t-lg">
                            <h2>Pegawai</h2>
                            
                            <div class="col-md-12">
                                <table border="1" width="100%">
                                   
                                    <thead id="headerstawin"></thead>
                                    <tbody id="isistawin"></tbody>
                                </table>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="background-color: rgba(255,255,255,0.85)">
                               <label>Statistik Rekap Status Pernikahan PNS DKI JAKARTA</label>

                               <canvas id="chartstawin" ></canvas>
                               
                            </div> 
                        </div> 
                    </div>

                    <div id="divstawin2" style="display: none">
                        <div class="hr-line-dashed"></div>
                        <div class="row m-b-lg m-t-lg">
                            <h2>Calon Pegawai</h2>
                            
                            <div class="col-md-12">
                                <table border="1" width="100%">
                                   
                                    <thead id="headerstawin2"></thead>
                                    <tbody id="isistawin2"></tbody>
                                </table>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="background-color: rgba(255,255,255,0.85)">
                               <label>Statistik Rekap Status Pernikahan Calon PNS DKI JAKARTA</label>

                               <canvas id="chartstawin2" ></canvas>
                               
                            </div> 
                        </div> 
                    </div> 


                    <div id="divmasker" style="display: none">
                        <div class="row m-b-lg m-t-lg">
                            <h2>Pegawai</h2>
                            
                            <div class="col-md-12">
                                <table border="1" width="100%">
                                   
                                    <thead id="headermasker"></thead>
                                    <tbody id="isimasker"></tbody>
                                </table>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="background-color: rgba(255,255,255,0.85)">
                               <label>Statistik Rekap Masa Kerja PNS DKI JAKARTA</label>

                               <canvas id="chartmasker" ></canvas>
                               
                            </div> 
                        </div> 
                    </div>

                    <div id="divmasker2" style="display: none">
                        <div class="hr-line-dashed"></div>
                        <div class="row m-b-lg m-t-lg">
                            <h2>Calon Pegawai</h2>
                            <div class="col-md-12">
                                <table border="1" width="100%">
                                   
                                    <thead id="headermasker2"></thead>
                                    <tbody id="isimasker2"></tbody>
                                </table>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="background-color: rgba(255,255,255,0.85)">
                               <label>Statistik Rekap Masa Kerja CPNS DKI JAKARTA</label>

                               <canvas id="chartmasker2" ></canvas>
                               
                            </div> 
                        </div> 
                    </div>

                    <div id="divagama" style="display: none">
                        <div class="row m-b-lg m-t-lg">
                            <h2>Pegawai</h2>
                            <div class="col-md-12">
                                <table border="1" width="100%">
                                   
                                    <thead id="headeragama"></thead>
                                    <tbody id="isiagama"></tbody>
                                </table>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="background-color: rgba(255,255,255,0.85)">
                               <label>Statistik Rekap Agama PNS DKI JAKARTA</label>

                               <canvas id="chartagama" ></canvas>
                               
                            </div> 
                        </div> 
                    </div>

                    <div id="divagama2" style="display: none">
                        <div class="hr-line-dashed"></div>
                        <div class="row m-b-lg m-t-lg">
                            <h2>Calon Pegawai</h2>
                            <div class="col-md-12">
                                <table border="1" width="100%">
                                   
                                    <thead id="headeragama2"></thead>
                                    <tbody id="isiagama2"></tbody>
                                </table>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="background-color: rgba(255,255,255,0.85)">
                               <label>Statistik Rekap Agama CPNS DKI JAKARTA</label>

                               <canvas id="chartagama2" ></canvas>
                               
                            </div> 
                        </div> 
                    </div>

                        
                    <div id="divpensiun" style="display: none">
                        <div class="row m-b-lg m-t-lg">
                            <h2>Pegawai</h2>
                            <div class="col-md-12">
                                <table border="1" width="100%">
                                   
                                    <thead id="headerpensiun"></thead>
                                    <tbody id="isipensiun"></tbody>
                                </table>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" style="background-color: rgba(255,255,255,0.85)">
                               <label>Statistik Tahun Pensiun PNS DKI JAKARTA</label>

                               <canvas id="chartpensiun" ></canvas>
                               
                            </div> 
                        </div> 
                    </div>
                </div>
                <!-- END DATA -->
            </div>
        </div>
    </div>    
    <!-- END WELLCOME -->
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

        <!-- Chartjs -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/chartJs/Chart.js"></script>

        <!-- Input Mask-->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/jasny/jasny-bootstrap.min.js"></script>



        <script type="text/javascript">

        $(document).ready(function(){
            
            $("#thblp").on("change", function(event) {
                
                var thblpr = $('#thblp').val();

                event.preventDefault();

                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/statistik/getSpmuFromThbl",
                    type: "post",
                    data: {thbl : thblpr},
                    dataType: 'json',
                    beforeSend: function() {

                    },
                    success: function(data) {
                        if(data.response == 'SUKSES'){
                            list = '<option value=""></option>' + data.list;
                             $('#skpdp').html(list);
                        }else{
                             $('#skpdp').html('');
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
                 $('#ukpdp').html('');
                 $(".chosen-ukpd").trigger("chosen:updated");
            });

            $("#skpdp").on("change", function(event) {
                
                var thblpr = $('#thblp').val();
                var skpdpr = $('#skpdp').val();

                event.preventDefault();

                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/statistik/getUkpdFromThbl",
                    type: "post",
                    data: {thbl:thblpr,skpd : skpdpr},
                    dataType: 'json',
                    beforeSend: function() {

                    },
                    success: function(data) {
                        if(data.response == 'SUKSES'){
                            list = '<option value=""></option>' + data.list;
                             $('#ukpdp').html(list);
                        }else{
                             $('#ukpdp').html('');
                        }

                    },
                    error: function(xhr) {
                        alert("Terjadi kesalahan. Silahkan coba kembali");
                    },
                    complete: function() {
                        $(".chosen-ukpd").trigger("chosen:updated");

                       // $('#defaultForm2').bootstrapValidator('revalidateField', 'kokel');
                    }
                });
                
            });            

            //chart_jenkel();

        });






        function clearDataJK()
        {
            $('#divjenkel').hide();
            $('#pria').val('');
            $('#wanita').val('');
            var jmlpria = document.getElementById('pria').value;
            var jmlwanita = document.getElementById('wanita').value;
            var ctx = document.getElementById("chartjenkel").getContext('2d');
            
            var myChart = new Chart(ctx, 
            {
                type: 'pie',
                data: {
                    
                }/*,
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }*/
            });
            //myChart.reset();
            $('#chartjenkel').replaceWith('<canvas id="chartjenkel"></canvas>');
        
            
        }

        function cetak_data()
        {
            var jenis = $('#jenis').val();
            var thblpr = $('#thblp').val();
            var skpdpr = $('#skpdp').val();
            var ukpdpr = $('#ukpdp').val();

            if(jenis == 0)
            {
                swal("Peringatan!", "Jenis Statistik harus dipilih.", "warning");
            }
            else
            {
                if(thblpr == "")
                {
                    swal("Peringatan!", "THBL harus dipilih.", "warning");
                }
                else
                {
                    $.ajax({
                            url: "<?php echo base_url(); ?>index.php/statistik/exceldata",
                            type: "post",
                            data: {jenis:jenis, thbl:thblpr, skpd:skpdpr, ukpd:ukpdpr},
                            dataType: 'json',
                            beforeSend: function() {
                                
                            },
                            success: function(data) {
                                

                                    var $a = $("<a>");
                                    $a.attr("href",data.file);
                                    $("body").append($a);
                                    $a.attr("download",data.filename);
                                    $a[0].click();
                                    $a.remove();   

                                

                            },
                            error: function(xhr) {
                                alert("Terjadi kesalahan. Silahkan coba kembali");
                            },
                            complete: function() {
                              
                            }
                        });
                }
            }
        }

        function tampilkan_data()
        {
            $('#divjenkel').hide();
            $('#divjenkelc').hide();
            $('#diveselon').hide();
            $('#divnoneselon').hide();
            $('#divusia').hide();
            $('#divpangkat').hide();
            $('#divpendidikan').hide();
            $('#divpendidikan2').hide();
            $('#divstawin').hide();
            $('#divstawin2').hide();
            $('#divmasker').hide();
            $('#divmasker2').hide();
            $('#divagama').hide();
            $('#divagama2').hide();
            $('#divpensiun').hide();

                //clearDataJK();

                var jenis = $('#jenis').val();
                var thblpr = $('#thblp').val();
                var skpdpr = $('#skpdp').val();
                var ukpdpr = $('#ukpdp').val();
                
            if(jenis == 0)
            {
                swal("Peringatan!", "Jenis Statistik harus dipilih.", "warning");
            }
            else
            {
                if(thblpr == "")
                {
                    swal("Peringatan!", "THBL harus dipilih.", "warning");
                }
                else
                {

                    if(jenis == 1)
                    {
                        /*$.ajax({
                            url: "<?php echo base_url(); ?>index.php/statistik/eksekusidata",
                            type: "post",
                            data: {jenis:jenis, thbl:thblpr, skpd:skpdpr, ukpd:ukpdpr},
                            dataType: 'json',
                            beforeSend: function() {
                                $('#load').show();
                            },
                            success: function(data) {
                                $('#load').hide();
                                if(data.response == 'SUKSES'){
                                    
                                     

                                     if(data.list[0].JENKEL == 'L')
                                     {
                                        var pria = $('#pria').val(data.list[0].JML);
                                        var wanita = $('#wanita').val(data.list[1].JML);

                                        priavalue = document.getElementById('pria').value;
                                        wanitavalue = document.getElementById('wanita').value;
                                        document.getElementById("priatd").innerHTML=priavalue;
                                        document.getElementById("wanitatd").innerHTML=wanitavalue;
                                     }
                                     else
                                     {
                                        var wanita = $('#wanita').val(data.list[0].JML);
                                        var pria = $('#pria').val(data.list[1].JML);

                                        priavalue = document.getElementById('pria').value;
                                        wanitavalue = document.getElementById('wanita').value;
                                        document.getElementById("priatd").innerHTML=priavalue;
                                        document.getElementById("wanitatd").innerHTML=wanitavalue;
                                     }

                                }else{
                                    
                                }

                            },
                            error: function(xhr) {
                                alert("Terjadi kesalahan. Silahkan coba kembali");
                            },
                            complete: function() {
                                $('#divjenkel').show();
                                chart_jenkel();

                               
                            }
                        });*/

                        var arr1a = new Array(); 
                        var arr1b = new Array(); 

                        var arr2a = new Array();
                        var arr2b = new Array();
                       

                        var arrne = new Array();
                        $.ajax({
                            url: "<?php echo base_url(); ?>index.php/statistik/eksekusidata",
                            type: "post",
                            data: {jenis:jenis, thbl:thblpr, skpd:skpdpr, ukpd:ukpdpr},
                            dataType: 'json',
                            beforeSend: function() {
                                $('#load').show();
                            },
                            success: function(data) {
                                $('#load').hide();



                                if(data.response == 'SUKSES'){
                             
                                    
                                    var jj = "<tr><th>Golongan</th><th>Laki - Laki</th><th>Perempuan</th><th>Jumlah</th></tr>";
                                    
                                    var kk="";
                                    var ll="";
                                    var e1a=0;
                                    var e1b=0;
                                    
                                    var e2a=0;
                                    var e2b=0;
                                    
                                    var jm=0;
                                    var jm2=0;

                                    var ida1=1;
                                    var ida2=2;

                                    var stapegc = 1;
                                    var stapeg = 2;
                                   

                                    for(j=0;j<data.list.length;j++)
                                    {
                                        if(skpdpr == "-")
                                        {
                                            kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapeg+"' target='_blank'>"+data.list[j].LAKILAKI+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapeg+"' target='_blank'>"+data.list[j].PEREMPUAN+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";
                                        }
                                        else
                                        {
                                            if(ukpdpr == "-" || ukpdpr == null)
                                            {
                                                kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].LAKILAKI+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].PEREMPUAN+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                            else
                                            {
                                                kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].LAKILAKI+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].PEREMPUAN+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";            
                                            }
                                                  
                                        }    
                                       
                                    
                                    //kk += "<tr><td>"+data.list[j].GOL+"</td><td>"+data.list[j].ESELON1A+"</td><td>"+data.list[j].ESELON1B+"</td><td>"+data.list[j].ESELON2A+"</td><td>"+data.list[j].ESELON2B+"</td><td>"+data.list[j].ESELON3A+"</td><td>"+data.list[j].ESELON3B+"</td><td>"+data.list[j].ESELON4A+"</td><td>"+data.list[j].ESELON4B+"</td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";

                                    arr1a[j] = parseInt(data.list[j].LAKILAKI);
                                    e1a = parseInt(e1a)+parseInt(data.list[j].LAKILAKI);
                                    arr1b[j] = parseInt(data.list[j].PEREMPUAN);
                                    e1b = parseInt(e1b)+parseInt(data.list[j].PEREMPUAN);

                                    

                                    jm = parseInt(jm)+parseInt(data.list[j].JUMLAHTOTAL);
                                   }  

                                     kk += "<tr><td>TOTAL</td><td>"+e1a+"</td><td>"+e1b+"</td><td>"+jm+"</td></tr>";

                                    $('#headerjenkel').html(jj);   
                                    $('#isijenkel').html(kk);   

                                    //cpns

                                    
                                    
                                  

                                    for(j=0;j<data.list.length;j++)
                                    {
                                        if(skpdpr == "-")
                                        {
                                            ll += "<tr><td>"+data.listne[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapegc+"' target='_blank'>"+data.listne[j].LAKILAKI+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapegc+"' target='_blank'>"+data.listne[j].PEREMPUAN+"</a></td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";
                                        }
                                        else
                                        {
                                            if(ukpdpr == "-" || ukpdpr == null)
                                            {
                                                ll += "<tr><td>"+data.listne[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].LAKILAKI+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].PEREMPUAN+"</a></td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                            else
                                            {
                                                ll += "<tr><td>"+data.listne[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].LAKILAKI+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].PEREMPUAN+"</a></td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";            
                                            }
                                                  
                                        }    
                                       
                                    
                                    //kk += "<tr><td>"+data.list[j].GOL+"</td><td>"+data.list[j].ESELON1A+"</td><td>"+data.list[j].ESELON1B+"</td><td>"+data.list[j].ESELON2A+"</td><td>"+data.list[j].ESELON2B+"</td><td>"+data.list[j].ESELON3A+"</td><td>"+data.list[j].ESELON3B+"</td><td>"+data.list[j].ESELON4A+"</td><td>"+data.list[j].ESELON4B+"</td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";

                                    arr2a[j] = parseInt(data.listne[j].LAKILAKI);
                                    e2a = parseInt(e2a)+parseInt(data.listne[j].LAKILAKI);
                                    arr2b[j] = parseInt(data.listne[j].PEREMPUAN);
                                    e2b = parseInt(e2b)+parseInt(data.listne[j].PEREMPUAN);

                                    

                                    jm2 = parseInt(jm2)+parseInt(data.listne[j].JUMLAHTOTAL);
                                   } 

                                     kk += "<tr><td>TOTAL</td><td>"+e2a+"</td><td>"+e2b+"</td><td>"+jm2+"</td></tr>";

                                    $('#headerjenkelc').html(jj);   
                                    $('#isijenkelc').html(ll);

                                }else{
                                    
                                }

                            },
                            error: function(xhr) {
                                alert("Terjadi kesalahan. Silahkan coba kembali");
                            },
                            complete: function() {
                                $('#divjenkel').show();
                                $('#divjenkelc').show();
                                chart_jenkel1(arr1a,arr1b);
                                chart_jenkel2(arr2a,arr2b);
                            }
                        });
                    }

                    else if(jenis == 2)
                    {
                        var arr1a = new Array(); 
                        var arr1b = new Array(); 
                        var arr2a = new Array(); 
                        var arr2b = new Array(); 
                        var arr3a = new Array(); 
                        var arr3b = new Array(); 
                        var arr4a = new Array(); 
                        var arr4b = new Array(); 

                        var arrne = new Array();
                        $.ajax({
                            url: "<?php echo base_url(); ?>index.php/statistik/eksekusidata",
                            type: "post",
                            data: {jenis:jenis, thbl:thblpr, skpd:skpdpr, ukpd:ukpdpr},
                            dataType: 'json',
                            beforeSend: function() {
                                $('#load').show();
                            },
                            success: function(data) {
                                $('#load').hide();



                                if(data.response == 'SUKSES'){
                             
                                    
                                    var jj = "<tr><th rowspan='2' colspan='1'>Golongan</th><th colspan='8'>Eselon</th><th rowspan='2' colspan='1'>Jumlah</th></tr><tr><th>1/A</th><th>1/B</th><th>2/A</th><th>2/B</th><th>3/A</th><th>3/B</th><th>4/A</th><th>4/B</th></tr>";
                                    
                                    var kk="";
                                    var e1a=0;
                                    var e1b=0;
                                    var e2a=0;
                                    var e2b=0;
                                    var e3a=0;
                                    var e3b=0;
                                    var e4a=0;
                                    var e4b=0;
                                    var ene = 0;
                                    var jm=0;
                                    var jm2=0;

                                    var ida1=11;
                                    var ida2=12;
                                    var idb1=21;
                                    var idb2=22;
                                    var idc1=31;
                                    var idc2=32;
                                    var idd1=41;
                                    var idd2=42;
                                    var ida5=99;

                                    for(j=0;j<data.list.length;j++)
                                    {
                                        if(skpdpr == "-")
                                        {
                                            kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"' target='_blank'>"+data.list[j].ESELON1A+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"' target='_blank'>"+data.list[j].ESELON1B+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+idb1+"' target='_blank'>"+data.list[j].ESELON2A+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+idb2+"' target='_blank'>"+data.list[j].ESELON2B+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+idc1+"' target='_blank'>"+data.list[j].ESELON3A+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+idc2+"' target='_blank'>"+data.list[j].ESELON3B+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+idd1+"' target='_blank'>"+data.list[j].ESELON4A+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+idd2+"' target='_blank'>"+data.list[j].ESELON4B+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";        
                                        }
                                        else
                                        {
                                            if(ukpdpr == "-" || ukpdpr == null)
                                            {
                                                kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+skpdpr+"' target='_blank'>"+data.list[j].ESELON1A+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+skpdpr+"' target='_blank'>"+data.list[j].ESELON1B+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+idb1+"/"+skpdpr+"' target='_blank'>"+data.list[j].ESELON2A+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+idb2+"/"+skpdpr+"' target='_blank'>"+data.list[j].ESELON2B+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+idc1+"/"+skpdpr+"' target='_blank'>"+data.list[j].ESELON3A+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+idc2+"/"+skpdpr+"' target='_blank'>"+data.list[j].ESELON3B+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+idd1+"/"+skpdpr+"' target='_blank'>"+data.list[j].ESELON4A+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+idd2+"/"+skpdpr+"' target='_blank'>"+data.list[j].ESELON4B+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                            else
                                            {
                                                kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].ESELON1A+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].ESELON1B+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+idb1+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].ESELON2A+"</a></td><td>"+data.list[j].ESELON2B+"</td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+idc1+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].ESELON3A+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+idc2+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].ESELON3B+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+idd1+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].ESELON4A+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+idd2+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].ESELON4B+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                        }   
                                       
                                    
                                    //kk += "<tr><td>"+data.list[j].GOL+"</td><td>"+data.list[j].ESELON1A+"</td><td>"+data.list[j].ESELON1B+"</td><td>"+data.list[j].ESELON2A+"</td><td>"+data.list[j].ESELON2B+"</td><td>"+data.list[j].ESELON3A+"</td><td>"+data.list[j].ESELON3B+"</td><td>"+data.list[j].ESELON4A+"</td><td>"+data.list[j].ESELON4B+"</td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";

                                    arr1a[j] = parseInt(data.list[j].ESELON1A);
                                    e1a = parseInt(e1a)+parseInt(data.list[j].ESELON1A);
                                    arr1b[j] = parseInt(data.list[j].ESELON1B);
                                    e1b = parseInt(e1b)+parseInt(data.list[j].ESELON1B);

                                    arr2a[j] = parseInt(data.list[j].ESELON2A);
                                    e2a = parseInt(e2a)+parseInt(data.list[j].ESELON2A);
                                    arr2b[j] = parseInt(data.list[j].ESELON2B);
                                    e2b = parseInt(e2b)+parseInt(data.list[j].ESELON2B);

                                    arr3a[j] = parseInt(data.list[j].ESELON3A);
                                    e3a = parseInt(e3a)+parseInt(data.list[j].ESELON3A);
                                    arr3b[j] = parseInt(data.list[j].ESELON3B);
                                    e3b = parseInt(e3b)+parseInt(data.list[j].ESELON3B);

                                    e4a = parseInt(e4a)+parseInt(data.list[j].ESELON4A);
                                    arr4a[j] = parseInt(data.list[j].ESELON4A);
                                    e4b = parseInt(e4b)+parseInt(data.list[j].ESELON4B);
                                    arr4b[j] = parseInt(data.list[j].ESELON4B);

                                    jm = parseInt(jm)+parseInt(data.list[j].JUMLAHTOTAL);
                                   }  

                                     kk += "<tr><td>TOTAL</td><td>"+e1a+"</td><td>"+e1b+"</td><td>"+e2a+"</td><td>"+e2b+"</td><td>"+e3a+"</td><td>"+e3b+"</td><td>"+e4a+"</td><td>"+e4b+"</td><td>"+jm+"</td></tr>";

                                    $('#headereselon').html(jj);   
                                    $('#isieselon').html(kk);   

                                    //noneselon

                                    
                                    arrne = data.listne;
                                    var xx = "<tr><th>Golongan</th><th>Jumlah</th></tr>";
                                    
                                    var yy="";
                                    
                                    var jm2=0;
                                  

                                    for(d=0;d<data.listne.length;d++)
                                    {
                                        if(skpdpr == "-")
                                        {
                                            yy += "<tr><td>"+data.listne[d].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+d+"/"+ida5+"' target='_blank'>"+data.listne[d].JUMLAHTOTAL+"</a></td></tr>";
                                        }
                                        else
                                        {
                                            if(ukpdpr == "-" || ukpdpr == null)
                                            {
                                                yy += "<tr><td>"+data.listne[d].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+d+"/"+ida5+"/"+skpdpr+"' target='_blank'>"+data.listne[d].JUMLAHTOTAL+"</a></td></tr>";
                                            }
                                            else
                                            {
                                                yy += "<tr><td>"+data.listne[d].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+d+"/"+ida5+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[d].JUMLAHTOTAL+"</a></td></tr>";
                                            }
                                                  
                                        }  


                                    //yy += "<tr><td>"+data.listne[d].GOL+"</td><td>"+data.listne[d].JUMLAHTOTAL+"</td></tr>";

                                    jm2 = parseInt(jm2)+parseInt(data.listne[d].JUMLAHTOTAL);
                                   }  

                                     kk += "<tr><td>TOTAL</td><td>"+jm2+"</td></tr>";

                                    $('#headernoneselon').html(xx);   
                                    $('#isinoneselon').html(yy);

                                }else{
                                    
                                }

                            },
                            error: function(xhr) {
                                alert("Terjadi kesalahan. Silahkan coba kembali");
                            },
                            complete: function() {
                                $('#diveselon').show();
                                $('#divnoneselon').show();
                                chart_eselon(arr1a,arr1b,arr2a,arr2b,arr3a,arr3b,arr4a,arr4b);
                                chart_noneselon(arrne);
                            }
                        });
                    }// end jenis 2
                    else if(jenis == 3)
                    {
                        var arru1a = new Array(); 
                        var arru1b = new Array(); 
                        var arru2a = new Array(); 
                        var arru2b = new Array(); 
                        var arru3a = new Array(); 
                        var arru3b = new Array(); 
                        var arru4a = new Array(); 
                        var arru4b = new Array(); 

                        
                        $.ajax({
                            url: "<?php echo base_url(); ?>index.php/statistik/eksekusidata",
                            type: "post",
                            data: {jenis:jenis, thbl:thblpr, skpd:skpdpr, ukpd:ukpdpr},
                            dataType: 'json',
                            beforeSend: function() {
                                $('#load').show();
                            },
                            success: function(data) {
                                
                                $('#load').hide();


                                if(data.response == 'SUKSES'){
                             
                                    
                                    var jj = "<tr><th rowspan='2' colspan='1'>Golongan</th><th colspan='7'>Usia (dalam tahun)</th><th rowspan='2' colspan='1'>Jumlah</th></tr><tr><th><25</th><th>25-30</th><th>30-36</th><th>36-42</th><th>42-48</th><th>48-55</th><th>>55</th></tr>";
                                    
                                    var kk="";
                                    var e1a=0;
                                    var e1b=0;
                                    var e2a=0;
                                    var e2b=0;
                                    var e3a=0;
                                    var e3b=0;
                                    var e4a=0;
                              
                                    var jm=0;

                                    var ida1=1;
                                    var ida2=2;
                                    var ida3=3;
                                    var ida4=4;
                                    var ida5=5;
                                    var ida6=6;
                                    var ida7=7;
                                    for(j=0;j<data.list.length;j++)
                                    {
                                        
                                        if(skpdpr == "-")
                                        {
                                            kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"' target='_blank'>"+data.list[j].BWAH25+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"' target='_blank'>"+data.list[j].AN2530+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"' target='_blank'>"+data.list[j].AN3036+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"' target='_blank'>"+data.list[j].AN3642+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"' target='_blank'>"+data.list[j].AN4248+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"' target='_blank'>"+data.list[j].AN4855+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida7+"' target='_blank'>"+data.list[j].DIATAS55+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";
                                        }
                                        else
                                        {
                                            if(ukpdpr == "-" || ukpdpr == null)
                                            {
                                                kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+skpdpr+"' target='_blank'>"+data.list[j].BWAH25+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+skpdpr+"' target='_blank'>"+data.list[j].AN2530+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+skpdpr+"' target='_blank'>"+data.list[j].AN3036+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+skpdpr+"' target='_blank'>"+data.list[j].AN3642+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+skpdpr+"' target='_blank'>"+data.list[j].AN4248+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+skpdpr+"' target='_blank'>"+data.list[j].AN4855+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida7+"/"+skpdpr+"' target='_blank'>"+data.list[j].DIATAS55+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                            else
                                            {
                                                kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].BWAH25+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].AN2530+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].AN3036+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].AN3642+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].AN4248+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].AN4855+"</a></td><td><a href='<?php echo site_url('detpegawai/index2')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida7+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].DIATAS55+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";          
                                            }
                                                  
                                        }
                                    
                                    //kk += "<tr><td>"+data.list[j].GOL+"</td><td>"+data.list[j].BWAH25+"</td><td>"+data.list[j].AN2530+"</td><td>"+data.list[j].AN3036+"</td><td>"+data.list[j].AN3642+"</td><td>"+data.list[j].AN4248+"</td><td>"+data.list[j].AN4855+"</td><td>"+data.list[j].DIATAS55+"</td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";

                                    arru1a[j] = parseInt(data.list[j].BWAH25);
                                    e1a = parseInt(e1a)+parseInt(data.list[j].BWAH25);
                                    arru1b[j] = parseInt(data.list[j].AN2530);
                                    e1b = parseInt(e1b)+parseInt(data.list[j].AN2530);

                                    arru2a[j] = parseInt(data.list[j].AN3036);
                                    e2a = parseInt(e2a)+parseInt(data.list[j].AN3036);
                                    arru2b[j] = parseInt(data.list[j].AN3642);
                                    e2b = parseInt(e2b)+parseInt(data.list[j].AN3642);

                                    arru3a[j] = parseInt(data.list[j].AN4248);
                                    e3a = parseInt(e3a)+parseInt(data.list[j].AN4248);
                                    arru3b[j] = parseInt(data.list[j].AN4855);
                                    e3b = parseInt(e3b)+parseInt(data.list[j].AN4855);

                                    e4a = parseInt(e4a)+parseInt(data.list[j].DIATAS55);
                                    arru4a[j] = parseInt(data.list[j].DIATAS55);
                                   

                                    jm = parseInt(jm)+parseInt(data.list[j].JUMLAHTOTAL);
                                   }  

                                     kk += "<tr><td>TOTAL</td><td>"+e1a+"</td><td>"+e1b+"</td><td>"+e2a+"</td><td>"+e2b+"</td><td>"+e3a+"</td><td>"+e3b+"</td><td>"+e4a+"</td><td>"+jm+"</td></tr>";

                                    $('#headerusia').html(jj);   
                                    $('#isiusia').html(kk);   

                                   

                                }else{
                                    
                                }

                            },
                            error: function(xhr) {
                                alert("Terjadi kesalahan. Silahkan coba kembali");
                            },
                            complete: function() {
                                $('#divusia').show();
                                
                                chart_usia(arru1a,arru1b,arru2a,arru2b,arru3a,arru3b,arru4a);
                                
                            }
                        });
                    }//end jenis 3
                    else if(jenis == 4)
                    {
                        var arrpngkat = new Array();
                        
                        $.ajax({
                            url: "<?php echo base_url(); ?>index.php/statistik/eksekusidata",
                            type: "post",
                            data: {jenis:jenis, thbl:thblpr, skpd:skpdpr, ukpd:ukpdpr},
                            dataType: 'json',
                            beforeSend: function() {
                                $('#load').show();
                            },
                            success: function(data) {
                                $('#load').hide();
                                if(data.response == 'SUKSES'){
                                    
                                    var jj = "<tr><th>Golongan</th><th>Jumlah</th></tr>";
                                    var kk="";
                                    var jm=0;
                                    
                                    arrpngkat = data.list;
                                    for(j=0;j<data.list.length;j++)
                                    {
                                        if(skpdpr == "-")
                                        {
                                            kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index')?>/"+jenis+"/"+thblpr+"/"+j+"' target='_blank'>"+data.list[j].JMLGOL+"</a></td></tr>";    
                                        }
                                        else
                                        {
                                            
                                            if(ukpdpr == "-" || ukpdpr == null)
                                            {
                                                kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index')?>/"+jenis+"/"+thblpr+"/"+j+"/"+skpdpr+"' target='_blank'>"+data.list[j].JMLGOL+"</a></td></tr>";
                                            }
                                            else
                                            {
                                                kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index')?>/"+jenis+"/"+thblpr+"/"+j+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].JMLGOL+"</a></td></tr>";
                                            }
                                        }
                                        
                                        
                                        jm = parseInt(jm) + parseInt(data.list[j].JMLGOL);
                                    
                                   }  

                                     kk += "<tr><td>TOTAL</td><td>"+jm+"</td></tr>";

                                    $('#headerpangkat').html(jj);   
                                    $('#isipangkat').html(kk);   

                                   

                                }else{
                                    
                                }

                            },
                            error: function(xhr) {
                                alert("Terjadi kesalahan. Silahkan coba kembali");
                            },
                            complete: function() {
                                $('#divpangkat').show();
                                
                                chart_pangkat(arrpngkat);
                                
                            }
                        });
                    }//end jenis 4

                    else if(jenis == 5)
                    {
                        var arrtmi = new Array(); 
                        var arrsd = new Array(); 
                        var arrsmp = new Array(); 
                        var arrsma = new Array(); 
                        var arrd1 = new Array(); 
                        var arrd2 = new Array(); 
                        var arrd3 = new Array(); 
                        var arrs1 = new Array(); 
                        var arrs2 = new Array(); 
                        var arrs3 = new Array(); 

                        var arrtmi2 = new Array(); 
                        var arrsd2 = new Array(); 
                        var arrsmp2 = new Array(); 
                        var arrsma2 = new Array(); 
                        var arrd12 = new Array(); 
                        var arrd22 = new Array(); 
                        var arrd32 = new Array(); 
                        var arrs12 = new Array(); 
                        var arrs22 = new Array(); 
                        var arrs32 = new Array(); 
                        $.ajax({
                            url: "<?php echo base_url(); ?>index.php/statistik/eksekusidata",
                            type: "post",
                            data: {jenis:jenis, thbl:thblpr, skpd:skpdpr, ukpd:ukpdpr},
                            dataType: 'json',
                            beforeSend: function() {
                                $('#load').show();
                            },
                            success: function(data) {
                                
                                $('#load').hide();


                                if(data.response == 'SUKSES'){
                             
                                    
                                    var jj = "<tr><th>Golongan</th><th>TMI</th><th>SD</th><th>SMP</th><th>SMA</th><th>D1</th><th>D2</th><th>D3</th><th>S1</th><th>S2</th><th>S3</th><th>JUMLAH</th></tr>";
                                    
                                    var kk="";
                                    var ll="";
                                    var e1a=0;
                                    var e1b=0;
                                    var e2a=0;
                                    var e2b=0;
                                    var e3a=0;
                                    var e3b=0;
                                    var e3c=0
                                    var e4a=0;
                                    var e4b=0;
                                    var e4c=0;

                                    var e1a2=0;
                                    var e1b2=0;
                                    var e2a2=0;
                                    var e2b2=0;
                                    var e3a2=0;
                                    var e3b2=0;
                                    var e3c2=0
                                    var e4a2=0;
                                    var e4b2=0;
                                    var e4c2=0
                                    
                                    var jm=0;
                                    var jm2=0;

                                    var ida1=1;
                                    var ida2=2;
                                    var ida3=3;
                                    var ida4=4;
                                    var ida5=5;
                                    var ida6=6;
                                    var ida7=7;
                                    var ida8=8;
                                    var ida9=9;
                                    var ida10=10;

                                    var stapegc = 1;
                                    var stapeg=2;

                                    for(j=0;j<data.list.length;j++)
                                    {
                                        
                                        if(skpdpr == "-")
                                        {
                                            kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapeg+"' target='_blank'>"+data.list[j].TMI+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapeg+"' target='_blank'>"+data.list[j].SD+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapeg+"' target='_blank'>"+data.list[j].SMP+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapeg+"' target='_blank'>"+data.list[j].SMA+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+stapeg+"' target='_blank'>"+data.list[j].D1+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+stapeg+"' target='_blank'>"+data.list[j].D2+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida7+"/"+stapeg+"' target='_blank'>"+data.list[j].D3+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida8+"/"+stapeg+"' target='_blank'>"+data.list[j].S1+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida9+"/"+stapeg+"' target='_blank'>"+data.list[j].S2+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida10+"/"+stapeg+"' target='_blank'>"+data.list[j].S3+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";
                                        }
                                        else
                                        {
                                            if(ukpdpr == "-" || ukpdpr == null)
                                            {
                                                 kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].TMI+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].SD+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].SMP+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].SMA+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].D1+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].D2+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida7+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].D3+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida8+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].S1+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida9+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].S2+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida10+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].S3+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                            else
                                            {
                                                kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].TMI+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].SD+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].SMP+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].SMA+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].D1+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].D2+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida7+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].D3+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida8+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].S1+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida9+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].S2+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida10+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].S3+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                                  
                                        } 
                                    
                                    //kk += "<tr><td>"+data.list[j].GOL+"</td><td>"+data.list[j].TMI+"</td><td>"+data.list[j].SD+"</td><td>"+data.list[j].SMP+"</td><td>"+data.list[j].SMA+"</td><td>"+data.list[j].D1+"</td><td>"+data.list[j].D2+"</td><td>"+data.list[j].D3+"</td><td>"+data.list[j].S1+"</td><td>"+data.list[j].S2+"</td><td>"+data.list[j].S3+"</td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";

                                    arrtmi[j] = parseInt(data.list[j].TMI);
                                    e1a = parseInt(e1a)+parseInt(data.list[j].TMI);
                                    arrsd[j] = parseInt(data.list[j].SD);
                                    e1b = parseInt(e1b)+parseInt(data.list[j].SD);

                                    arrsmp[j] = parseInt(data.list[j].SMP);
                                    e2a = parseInt(e2a)+parseInt(data.list[j].SMP);
                                    arrsma[j] = parseInt(data.list[j].SMA);
                                    e2b = parseInt(e2b)+parseInt(data.list[j].SMA);

                                    arrd1[j] = parseInt(data.list[j].D1);
                                    e3a = parseInt(e3a)+parseInt(data.list[j].D1);
                                    arrd2[j] = parseInt(data.list[j].D2);
                                    e3b = parseInt(e3b)+parseInt(data.list[j].D2);
                                    arrd3[j] = parseInt(data.list[j].D3);
                                    e3c = parseInt(e3c)+parseInt(data.list[j].D3);

                                    e4a = parseInt(e4a)+parseInt(data.list[j].S1);
                                    arrs1[j] = parseInt(data.list[j].S1);
                                    e4b = parseInt(e4b)+parseInt(data.list[j].S2);
                                    arrs2[j] = parseInt(data.list[j].S2);
                                    e4c = parseInt(e4c)+parseInt(data.list[j].S3);
                                    arrs3[j] = parseInt(data.list[j].S3);

                                    jm = parseInt(jm)+parseInt(data.list[j].JUMLAHTOTAL);
                                   }  

                                     kk += "<tr><td>TOTAL</td><td>"+e1a+"</td><td>"+e1b+"</td><td>"+e2a+"</td><td>"+e2b+"</td><td>"+e3a+"</td><td>"+e3b+"</td><td>"+e3c+"</td><td>"+e4a+"</td><td>"+e4b+"</td><td>"+e4c+"</td><td>"+jm+"</td></tr>";

                                    $('#headerpendidikan').html(jj);   
                                    $('#isipendidikan').html(kk);   

                                    //nonpegawai

                                    
                                    for(j=0;j<data.listne.length;j++)
                                    {
                                        
                                        if(skpdpr == "-")
                                        {
                                             ll += "<tr><td>"+data.listne[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapegc+"' target='_blank'>"+data.listne[j].TMI+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapegc+"' target='_blank'>"+data.listne[j].SD+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapegc+"' target='_blank'>"+data.listne[j].SMP+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapegc+"' target='_blank'>"+data.listne[j].SMA+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+stapegc+"' target='_blank'>"+data.listne[j].D1+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+stapegc+"' target='_blank'>"+data.listne[j].D2+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida7+"/"+stapegc+"' target='_blank'>"+data.listne[j].D3+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida8+"/"+stapegc+"' target='_blank'>"+data.listne[j].S1+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida9+"/"+stapegc+"' target='_blank'>"+data.listne[j].S2+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida10+"/"+stapegc+"' target='_blank'>"+data.listne[j].S3+"</td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";
                                        }
                                        else
                                        {
                                            if(ukpdpr == "-" || ukpdpr == null)
                                            {
                                                ll += "<tr><td>"+data.listne[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].TMI+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].SD+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].SMP+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].SMA+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].D1+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].D2+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida7+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].D3+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida8+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].S1+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida9+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].S2+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida10+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].S3+"</a></td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                            else
                                            {
                                                ll += "<tr><td>"+data.listne[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].TMI+"<a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].SD+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].SMP+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].SMA+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].D1+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].D2+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida7+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].D3+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida8+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].S1+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida9+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].S2+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida10+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].S3+"</a></td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                                  
                                        } 
                                    
                                   // ll += "<tr><td>"+data.listne[j].GOL+"</td><td>"+data.listne[j].TMI+"</td><td>"+data.listne[j].SD+"</td><td>"+data.listne[j].SMP+"</td><td>"+data.listne[j].SMA+"</td><td>"+data.listne[j].D1+"</td><td>"+data.listne[j].D2+"</td><td>"+data.listne[j].D3+"</td><td>"+data.listne[j].S1+"</td><td>"+data.listne[j].S2+"</td><td>"+data.listne[j].S3+"</td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";

                                    arrtmi2[j] = parseInt(data.listne[j].TMI);
                                    e1a2 = parseInt(e1a2)+parseInt(data.listne[j].TMI);
                                    arrsd2[j] = parseInt(data.listne[j].SD);
                                    e1b2 = parseInt(e1b2)+parseInt(data.listne[j].SD);

                                    arrsmp2[j] = parseInt(data.listne[j].SMP);
                                    e2a2 = parseInt(e2a2)+parseInt(data.listne[j].SMP);
                                    arrsma2[j] = parseInt(data.listne[j].SMA);
                                    e2b2 = parseInt(e2b2)+parseInt(data.listne[j].SMA);

                                    arrd12[j] = parseInt(data.listne[j].D1);
                                    e3a2 = parseInt(e3a2)+parseInt(data.listne[j].D1);
                                    arrd22[j] = parseInt(data.listne[j].D2);
                                    e3b2 = parseInt(e3b2)+parseInt(data.listne[j].D2);
                                    arrd32[j] = parseInt(data.listne[j].D3);
                                    e3c2 = parseInt(e3c2)+parseInt(data.listne[j].D3);

                                    e4a2 = parseInt(e4a2)+parseInt(data.listne[j].S1);
                                    arrs12[j] = parseInt(data.listne[j].S1);
                                    e4b2 = parseInt(e4b2)+parseInt(data.listne[j].S2);
                                    arrs22[j] = parseInt(data.listne[j].S2);
                                    e4c2 = parseInt(e4c2)+parseInt(data.listne[j].S3);
                                    arrs32[j] = parseInt(data.listne[j].S3);

                                    jm2 = parseInt(jm2)+parseInt(data.listne[j].JUMLAHTOTAL);
                                   }  

                                     ll += "<tr><td>TOTAL</td><td>"+e1a2+"</td><td>"+e1b2+"</td><td>"+e2a2+"</td><td>"+e2b2+"</td><td>"+e3a2+"</td><td>"+e3b2+"</td><td>"+e3c2+"</td><td>"+e4a2+"</td><td>"+e4b2+"</td><td>"+e4c2+"</td><td>"+jm2+"</td></tr>";

                                    $('#headerpendidikan2').html(jj);   
                                    $('#isipendidikan2').html(ll);   

                                    

                                }else{
                                    
                                }

                            },
                            error: function(xhr) {
                                alert("Terjadi kesalahan. Silahkan coba kembali");
                            },
                            complete: function() {
                                $('#divpendidikan').show();
                                $('#divpendidikan2').show();
                                chart_pendidikan(arrtmi,arrsd,arrsmp,arrsma,arrd1,arrd2,arrd3,arrs1,arrs2,arrs3);
                                chart_pendidikan2(arrtmi2,arrsd2,arrsmp2,arrsma2,arrd12,arrd22,arrd32,arrs12,arrs22,arrs32);
                            }
                        });
                    }// end jenis 5

                    else if(jenis == 6)
                    {
                        var arrbk = new Array(); 
                        var arrk = new Array(); 
                        var arrj = new Array(); 
                        var arrd = new Array(); 
                        
                        var arrbk2 = new Array(); 
                        var arrk2 = new Array(); 
                        var arrj2 = new Array(); 
                        var arrd2 = new Array(); 
                        $.ajax({
                            url: "<?php echo base_url(); ?>index.php/statistik/eksekusidata",
                            type: "post",
                            data: {jenis:jenis, thbl:thblpr, skpd:skpdpr, ukpd:ukpdpr},
                            dataType: 'json',
                            beforeSend: function() {
                                $('#load').show();
                            },
                            success: function(data) {
                                
                                $('#load').hide();


                                if(data.response == 'SUKSES'){
                             
                                    
                                    var jj = "<tr><th>Golongan</th><th>Belum Kawin</th><th>Kawin</th><th>Janda</th><th>Duda</th><th>JUMLAH</th></tr>";
                                    
                                    var kk="";
                                    var ll="";
                                    var e1a=0;
                                    var e1b=0;
                                    var e2a=0;
                                    var e2b=0;
                                    

                                    var e1a2=0;
                                    var e1b2=0;
                                    var e2a2=0;
                                    var e2b2=0;
                                    
                                    
                                    var jm=0;
                                    var jm2=0;

                                    var ida1 = 1;
                                    var ida2 = 2;
                                    var ida3 = 3;
                                    var ida4 = 4;

                                    var stapegc =1;
                                    var stapeg = 2;

                                    for(j=0;j<data.list.length;j++)
                                    {
                                        if(skpdpr == "-")
                                        {
                                            kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapeg+"' target='_blank'>"+data.list[j].BELUMKAWIN+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapeg+"' target='_blank'>"+data.list[j].KAWIN+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapeg+"' target='_blank'>"+data.list[j].JANDA+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapeg+"' target='_blank'>"+data.list[j].DUDA+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";
                                        }
                                        else
                                        {
                                            if(ukpdpr == "-" || ukpdpr == null)
                                            {
                                                kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].BELUMKAWIN+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].KAWIN+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].JANDA+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].DUDA+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                            else
                                            {
                                                kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].BELUMKAWIN+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].KAWIN+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].JANDA+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].DUDA+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                                  
                                        }
                                        
                                    
                                    //kk += "<tr><td>"+data.list[j].GOL+"</td><td>"+data.list[j].BELUMKAWIN+"</td><td>"+data.list[j].KAWIN+"</td><td>"+data.list[j].JANDA+"</td><td>"+data.list[j].DUDA+"</td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";

                                    arrbk[j] = parseInt(data.list[j].BELUMKAWIN);
                                    e1a = parseInt(e1a)+parseInt(data.list[j].BELUMKAWIN);
                                    arrk[j] = parseInt(data.list[j].KAWIN);
                                    e1b = parseInt(e1b)+parseInt(data.list[j].KAWIN);

                                    arrj[j] = parseInt(data.list[j].JANDA);
                                    e2a = parseInt(e2a)+parseInt(data.list[j].JANDA);
                                    arrd[j] = parseInt(data.list[j].DUDA);
                                    e2b = parseInt(e2b)+parseInt(data.list[j].DUDA);


                                    jm = parseInt(jm)+parseInt(data.list[j].JUMLAHTOTAL);
                                   }  

                                     kk += "<tr><td>TOTAL</td><td>"+e1a+"</td><td>"+e1b+"</td><td>"+e2a+"</td><td>"+e2b+"</td><td>"+jm+"</td></tr>";

                                    $('#headerstawin').html(jj);   
                                    $('#isistawin').html(kk);   

                                    //nonpegawai

                                    
                                    for(j=0;j<data.listne.length;j++)
                                    {
                                        if(skpdpr == "-")
                                        {
                                            ll += "<tr><td>"+data.listne[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapegc+"' target='_blank'>"+data.listne[j].BELUMKAWIN+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapegc+"' target='_blank'>"+data.listne[j].KAWIN+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapegc+"' target='_blank'>"+data.listne[j].JANDA+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapegc+"' target='_blank'>"+data.listne[j].DUDA+"</a></td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";
                                        }
                                        else
                                        {
                                            if(ukpdpr == "-" || ukpdpr == null)
                                            {
                                                ll += "<tr><td>"+data.listne[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].BELUMKAWIN+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].KAWIN+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].JANDA+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].DUDA+"</a></td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                            else
                                            {
                                                ll += "<tr><td>"+data.listne[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].BELUMKAWIN+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].KAWIN+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].JANDA+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].DUDA+"</a></td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";            
                                            }
                                                  
                                        }
                                        
                                    
                                    //ll += "<tr><td>"+data.listne[j].GOL+"</td><td>"+data.listne[j].BELUMKAWIN+"</td><td>"+data.listne[j].KAWIN+"</td><td>"+data.listne[j].JANDA+"</td><td>"+data.listne[j].DUDA+"</td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";

                                    arrbk2[j] = parseInt(data.listne[j].BELUMKAWIN);
                                    e1a2 = parseInt(e1a2)+parseInt(data.listne[j].BELUMKAWIN);
                                    arrk2[j] = parseInt(data.listne[j].KAWIN);
                                    e1b2 = parseInt(e1b2)+parseInt(data.listne[j].KAWIN);

                                    arrj2[j] = parseInt(data.listne[j].JANDA);
                                    e2a2 = parseInt(e2a2)+parseInt(data.listne[j].JANDA);
                                    arrd2[j] = parseInt(data.listne[j].DUDA);
                                    e2b2 = parseInt(e2b2)+parseInt(data.listne[j].DUDA);

                                   

                                    jm2 = parseInt(jm2)+parseInt(data.listne[j].JUMLAHTOTAL);
                                   }  

                                     ll += "<tr><td>TOTAL</td><td>"+e1a2+"</td><td>"+e1b2+"</td><td>"+e2a2+"</td><td>"+e2b2+"</td><td>"+jm2+"</td></tr>";

                                    $('#headerstawin2').html(jj);   
                                    $('#isistawin2').html(ll);   

                                    

                                }else{
                                    
                                }

                            },
                            error: function(xhr) {
                                alert("Terjadi kesalahan. Silahkan coba kembali");
                            },
                            complete: function() {
                                $('#divstawin').show();
                                $('#divstawin2').show();
                                chart_stawin(arrbk,arrk,arrj,arrd);
                                chart_stawin2(arrbk2,arrk2,arrj2,arrd2);
                            }
                        });
                    }// end jenis 6

                    else if(jenis == 7)
                    {
                        var arr1a = new Array(); 
                        var arr2a = new Array(); 
                        var arr3a = new Array(); 
                        var arr4a = new Array(); 
                        var arr5a = new Array(); 
                        var arr6a = new Array(); 
                        var arr7a = new Array(); 
                        var arr8a = new Array(); 

                        
                        var arr1b = new Array(); 
                        var arr2b = new Array(); 
                        var arr3b = new Array(); 
                        var arr4b = new Array(); 
                        var arr5b = new Array(); 
                        var arr6b = new Array(); 
                        var arr7b = new Array(); 
                        var arr8b = new Array(); 
                        $.ajax({
                            url: "<?php echo base_url(); ?>index.php/statistik/eksekusidata",
                            type: "post",
                            data: {jenis:jenis, thbl:thblpr, skpd:skpdpr, ukpd:ukpdpr},
                            dataType: 'json',
                            beforeSend: function() {
                                $('#load').show();
                            },
                            success: function(data) {
                                
                                $('#load').hide();


                                if(data.response == 'SUKSES'){
                             
                                    
                                    var jj = "<tr><th>Golongan</th><th>1-5 th</th><th>6-10 th</th><th>11-15 th</th><th>16-20 th</th><th>21-25 th</th><th>26-30 th</th><th>31-35 th</th><th>>35 th</th><th>JUMLAH</th></tr>";
                                    
                                    var kk="";
                                    var ll="";

                                    var a1=0;
                                    var a2=0;
                                    var a3=0;
                                    var a4=0;
                                    var a5=0;
                                    var a6=0;
                                    var a7=0;
                                    var a8=0;

                                    var b1=0;
                                    var b2=0;
                                    var b3=0;
                                    var b4=0;
                                    var b5=0;
                                    var b6=0;
                                    var b7=0;
                                    var b8=0;
                                    
                                    
                                    var jm=0;
                                    var jm2=0;

                                    var ida1 = 1;
                                    var ida2 = 2;
                                    var ida3 = 3;
                                    var ida4 = 4;
                                    var ida5 = 5;
                                    var ida6 = 6;
                                    var ida7 = 7;
                                    var ida8 = 8;

                                    var stapegc = 1;
                                    var stapeg = 2;

                                    for(j=0;j<data.list.length;j++)
                                    {
                                        
                                        if(skpdpr == "-")
                                        {
                                            kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapeg+"' target='_blank'>"+data.list[j].A15+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapeg+"' target='_blank'>"+data.list[j].A610+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapeg+"' target='_blank'>"+data.list[j].A1115+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapeg+"' target='_blank'>"+data.list[j].A1620+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+stapeg+"' target='_blank'>"+data.list[j].A2125+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+stapeg+"' target='_blank'>"+data.list[j].A2530+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida7+"/"+stapeg+"' target='_blank'>"+data.list[j].A3035+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida8+"/"+stapeg+"' target='_blank'>"+data.list[j].A36+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";
                                        }
                                        else
                                        {
                                            if(ukpdpr == "-" || ukpdpr == null)
                                            {
                                                kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].A15+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].A610+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].A1115+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].A1620+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].A2125+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].A2530+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida7+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].A3035+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida8+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].A36+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                            else
                                            {
                                                kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].A15+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].A610+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].A1115+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].A1620+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].A2125+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].A2530+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida7+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].A3035+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida8+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].A36+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                                  
                                        }
                                    
                                    //kk += "<tr><td>"+data.list[j].GOL+"</td><td>"+data.list[j].A15+"</td><td>"+data.list[j].A610+"</td><td>"+data.list[j].A1115+"</td><td>"+data.list[j].A1620+"</td><td>"+data.list[j].A2125+"</td><td>"+data.list[j].A2530+"</td><td>"+data.list[j].A3035+"</td><td>"+data.list[j].A36+"</td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";

                                    arr1a[j] = parseInt(data.list[j].A15);
                                    a1 = parseInt(a1)+parseInt(data.list[j].A15);

                                    arr2a[j] = parseInt(data.list[j].A610);
                                    a2 = parseInt(a2)+parseInt(data.list[j].A610);

                                    arr3a[j] = parseInt(data.list[j].A1115);
                                    a3 = parseInt(a3)+parseInt(data.list[j].A1115);

                                    arr4a[j] = parseInt(data.list[j].A1620);
                                    a4 = parseInt(a4)+parseInt(data.list[j].A1620);

                                    arr5a[j] = parseInt(data.list[j].A2125);
                                    a5 = parseInt(a5)+parseInt(data.list[j].A2125);

                                    
                                    arr6a[j] = parseInt(data.list[j].A2530);
                                    a6 = parseInt(a6)+parseInt(data.list[j].A2530);
                                    
                                    arr7a[j] = parseInt(data.list[j].A3035);
                                    a7 = parseInt(a7)+parseInt(data.list[j].A3035);

                                    arr8a[j] = parseInt(data.list[j].A36);
                                    a8 = parseInt(a8)+parseInt(data.list[j].A36);

                                    jm = parseInt(jm)+parseInt(data.list[j].JUMLAHTOTAL);
                                   }  

                                     kk += "<tr><td>TOTAL</td><td>"+a1+"</td><td>"+a2+"</td><td>"+a3+"</td><td>"+a4+"</td><td>"+a5+"</td><td>"+a6+"</td><td>"+a7+"</td><td>"+a8+"</td><td>"+jm+"</td></tr>";

                                    $('#headermasker').html(jj);   
                                    $('#isimasker').html(kk);   

                                    //nonpegawai

                                    
                                    for(j=0;j<data.listne.length;j++)
                                    {
                                        
                                        if(skpdpr == "-")
                                        {
                                            ll += "<tr><td>"+data.listne[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapegc+"' target='_blank'>"+data.listne[j].A15+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapegc+"' target='_blank'>"+data.listne[j].A610+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapegc+"' target='_blank'>"+data.listne[j].A1115+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapegc+"' target='_blank'>"+data.listne[j].A1620+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+stapegc+"' target='_blank'>"+data.listne[j].A2125+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+stapegc+"' target='_blank'>"+data.listne[j].A2530+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida7+"/"+stapegc+"' target='_blank'>"+data.listne[j].A3035+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida8+"/"+stapegc+"' target='_blank'>"+data.listne[j].A36+"</a></td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";
                                        }
                                        else
                                        {
                                            if(ukpdpr == "-" || ukpdpr == null)
                                            {
                                                ll += "<tr><td>"+data.listne[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].A15+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].A610+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].A1115+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].A1620+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].A2125+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].A2530+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida7+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].A3035+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida8+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].A36+"</a></td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                            else
                                            {
                                                 ll += "<tr><td>"+data.listne[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].A15+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].A610+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].A1115+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].A1620+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].A2125+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].A2530+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida7+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].A3035+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida8+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].A36+"</a></td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                                  
                                        } 
                                    
                                   // ll += "<tr><td>"+data.listne[j].GOL+"</td><td>"+data.listne[j].A15+"</td><td>"+data.listne[j].A610+"</td><td>"+data.listne[j].A1115+"</td><td>"+data.listne[j].A1620+"</td><td>"+data.listne[j].A2125+"</td><td>"+data.listne[j].A2530+"</td><td>"+data.listne[j].A3035+"</td><td>"+data.listne[j].A36+"</td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";

                                    arr1b[j] = parseInt(data.listne[j].A15);
                                    b1 = parseInt(b1)+parseInt(data.listne[j].A15);

                                    arr2b[j] = parseInt(data.listne[j].A610);
                                    b2 = parseInt(b2)+parseInt(data.listne[j].A610);

                                    arr3b[j] = parseInt(data.listne[j].A1115);
                                    b3 = parseInt(b3)+parseInt(data.listne[j].A1115);

                                    arr4b[j] = parseInt(data.listne[j].A1620);
                                    b4 = parseInt(b4)+parseInt(data.listne[j].A1620);

                                    arr5b[j] = parseInt(data.listne[j].A2125);
                                    b5 = parseInt(b5)+parseInt(data.listne[j].A2125);

                                    arr6b[j] = parseInt(data.listne[j].A2530);
                                    b6 = parseInt(b6)+parseInt(data.listne[j].A2530);

                                    arr7b[j] = parseInt(data.listne[j].A3035);
                                    b7 = parseInt(b7)+parseInt(data.listne[j].A3035);

                                    arr8b[j] = parseInt(data.listne[j].A36);
                                    b8 = parseInt(b8)+parseInt(data.listne[j].A36);

                                    

                                   

                                    jm2 = parseInt(jm2)+parseInt(data.listne[j].JUMLAHTOTAL);
                                   }  

                                     ll +="<tr><td>TOTAL</td><td>"+b1+"</td><td>"+b2+"</td><td>"+b3+"</td><td>"+b4+"</td><td>"+b5+"</td><td>"+b6+"</td><td>"+b7+"</td><td>"+b8+"</td><td>"+jm2+"</td></tr>";

                                    $('#headermasker2').html(jj);   
                                    $('#isimasker2').html(ll);   

                                    

                                }else{
                                    
                                }

                            },
                            error: function(xhr) {
                                alert("Terjadi kesalahan. Silahkan coba kembali");
                            },
                            complete: function() {
                                $('#divmasker').show();
                                $('#divmasker2').show();
                                chart_masker(arr1a,arr2a,arr3a,arr4a,arr5a,arr6a,arr7a,arr8a);
                                chart_masker2(arr1b,arr2b,arr3b,arr4b,arr5b,arr6b,arr7b,arr8b);
                            }
                        });
                    }// end jenis 7

                    else if(jenis == 8)
                    {
                        var arr1a = new Array(); 
                        var arr2a = new Array(); 
                        var arr3a = new Array(); 
                        var arr4a = new Array(); 
                        var arr5a = new Array(); 
                        var arr6a = new Array(); 
                        
                        var arr1b = new Array(); 
                        var arr2b = new Array(); 
                        var arr3b = new Array(); 
                        var arr4b = new Array(); 
                        var arr5b = new Array(); 
                        var arr6b = new Array(); 
                        
                        $.ajax({
                            url: "<?php echo base_url(); ?>index.php/statistik/eksekusidata",
                            type: "post",
                            data: {jenis:jenis, thbl:thblpr, skpd:skpdpr, ukpd:ukpdpr},
                            dataType: 'json',
                            beforeSend: function() {
                                $('#load').show();
                            },
                            success: function(data) {
                                
                                $('#load').hide();


                                if(data.response == 'SUKSES'){
                             
                                    
                                    var jj = "<tr><th>Golongan</th><th>Islam</th><th>Protestan</th><th>Katolik</th><th>Hindu</th><th>Buddha</th><th>Khonghucu</th><th>JUMLAH</th></tr>";
                                    
                                    var kk="";
                                    var ll="";

                                    var a1=0;
                                    var a2=0;
                                    var a3=0;
                                    var a4=0;
                                    var a5=0;
                                    var a6=0;
                                    

                                    var b1=0;
                                    var b2=0;
                                    var b3=0;
                                    var b4=0;
                                    var b5=0;
                                    var b6=0;
                                    
                                    
                                    var jm=0;
                                    var jm2=0;

                                    var ida1=1;
                                    var ida2=2;
                                    var ida3=3;
                                    var ida4=4;
                                    var ida5=5;
                                    var ida6=6;

                                    var stapegc = 1;
                                    var stapeg = 2;

                                    for(j=0;j<data.list.length;j++)
                                    {
                                        
                                        if(skpdpr == "-")
                                        {
                                            kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapeg+"' target='_blank'>"+data.list[j].ISLAM+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapeg+"' target='_blank'>"+data.list[j].PROTESTAN+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapeg+"' target='_blank'>"+data.list[j].KATOLIK+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapeg+"' target='_blank'>"+data.list[j].HINDU+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+stapeg+"' target='_blank'>"+data.list[j].BUDDHA+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+stapeg+"' target='_blank'>"+data.list[j].KHONGHUCU+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";
                                        }
                                        else
                                        {
                                            if(ukpdpr == "-" || ukpdpr == null)
                                            {
                                                kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].ISLAM+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].PROTESTAN+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].KATOLIK+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].HINDU+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.list[j].BUDDHA+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+stapeg+"/"+skpdpr+"' target='_blank'>"+data.list[j].KHONGHUCU+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                            else
                                            {
                                                kk += "<tr><td>"+data.list[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].ISLAM+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].PROTESTAN+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].KATOLIK+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].HINDU+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].BUDDHA+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+stapeg+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].KHONGHUCU+"</a></td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";            
                                            }
                                                  
                                        } 
                                    
                                    //kk += "<tr><td>"+data.list[j].GOL+"</td><td>"+data.list[j].ISLAM+"</td><td>"+data.list[j].PROTESTAN+"</td><td>"+data.list[j].KATOLIK+"</td><td>"+data.list[j].HINDU+"</td><td>"+data.list[j].BUDDHA+"</td><td>"+data.list[j].KHONGHUCU+"</td><td>"+data.list[j].JUMLAHTOTAL+"</td></tr>";

                                    arr1a[j] = parseInt(data.list[j].ISLAM);
                                    a1 = parseInt(a1)+parseInt(data.list[j].ISLAM);

                                    arr2a[j] = parseInt(data.list[j].PROTESTAN);
                                    a2 = parseInt(a2)+parseInt(data.list[j].PROTESTAN);

                                    arr3a[j] = parseInt(data.list[j].KATOLIK);
                                    a3 = parseInt(a3)+parseInt(data.list[j].KATOLIK);

                                    arr4a[j] = parseInt(data.list[j].HINDU);
                                    a4 = parseInt(a4)+parseInt(data.list[j].HINDU);

                                    arr5a[j] = parseInt(data.list[j].BUDDHA);
                                    a5 = parseInt(a5)+parseInt(data.list[j].BUDDHA);

                                    arr6a[j] = parseInt(data.list[j].KHONGHUCU);
                                    a6 = parseInt(a6)+parseInt(data.list[j].KHONGHUCU);

                                    
                                    jm = parseInt(jm)+parseInt(data.list[j].JUMLAHTOTAL);
                                   }  

                                     kk += "<tr><td>TOTAL</td><td>"+a1+"</td><td>"+a2+"</td><td>"+a3+"</td><td>"+a4+"</td><td>"+a5+"</td><td>"+a6+"</td><td>"+jm+"</td></tr>";

                                    $('#headeragama').html(jj);   
                                    $('#isiagama').html(kk);   

                                    //nonpegawai

                                    
                                    for(j=0;j<data.listne.length;j++)
                                    {
                                        if(skpdpr == "-")
                                        {
                                            ll += "<tr><td>"+data.listne[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapegc+"' target='_blank'>"+data.listne[j].ISLAM+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapegc+"' target='_blank'>"+data.listne[j].PROTESTAN+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapegc+"' target='_blank'>"+data.listne[j].KATOLIK+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapegc+"' target='_blank'>"+data.listne[j].HINDU+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+stapegc+"' target='_blank'>"+data.listne[j].BUDDHA+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+stapegc+"' target='_blank'>"+data.listne[j].KHONGHUCU+"</a></td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";
                                        }
                                        else
                                        {
                                            if(ukpdpr == "-" || ukpdpr == null)
                                            {
                                                ll += "<tr><td>"+data.listne[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].ISLAM+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].PROTESTAN+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].KATOLIK+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].HINDU+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].BUDDHA+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+stapegc+"/"+skpdpr+"' target='_blank'>"+data.listne[j].KHONGHUCU+"</a></td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                            else
                                            {
                                                ll += "<tr><td>"+data.listne[j].GOL+"</td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida1+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].ISLAM+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida2+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].PROTESTAN+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida3+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].KATOLIK+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida4+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].HINDU+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida5+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].BUDDHA+"</a></td><td><a href='<?php echo site_url('detpegawai/index3')?>/"+jenis+"/"+thblpr+"/"+j+"/"+ida6+"/"+stapegc+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.listne[j].KHONGHUCU+"</a></td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";
                                            }
                                                  
                                        } 
                                        
                                    
                                   // ll += "<tr><td>"+data.listne[j].GOL+"</td><td>"+data.listne[j].ISLAM+"</td><td>"+data.listne[j].PROTESTAN+"</td><td>"+data.listne[j].KATOLIK+"</td><td>"+data.listne[j].HINDU+"</td><td>"+data.listne[j].BUDDHA+"</td><td>"+data.listne[j].KHONGHUCU+"</td><td>"+data.listne[j].JUMLAHTOTAL+"</td></tr>";

                                    arr1b[j] = parseInt(data.listne[j].ISLAM);
                                    b1 = parseInt(b1)+parseInt(data.listne[j].ISLAM);

                                    arr2b[j] = parseInt(data.listne[j].PROTESTAN);
                                    b2 = parseInt(b2)+parseInt(data.listne[j].PROTESTAN);

                                    arr3b[j] = parseInt(data.listne[j].KATOLIK);
                                    b3 = parseInt(b3)+parseInt(data.listne[j].KATOLIK);

                                    arr4b[j] = parseInt(data.listne[j].HINDU);
                                    b4 = parseInt(b4)+parseInt(data.listne[j].HINDU);

                                    arr5b[j] = parseInt(data.listne[j].BUDDHA);
                                    b5 = parseInt(b5)+parseInt(data.listne[j].BUDDHA);

                                    arr6b[j] = parseInt(data.listne[j].KHONGHUCU);
                                    b6 = parseInt(b6)+parseInt(data.listne[j].KHONGHUCU);

                                    jm2 = parseInt(jm2)+parseInt(data.listne[j].JUMLAHTOTAL);
                                   }  

                                     ll +="<tr><td>TOTAL</td><td>"+b1+"</td><td>"+b2+"</td><td>"+b3+"</td><td>"+b4+"</td><td>"+b5+"</td><td>"+b6+"</td><td>"+jm2+"</td></tr>";

                                    $('#headeragama2').html(jj);   
                                    $('#isiagama2').html(ll);   

                                    

                                }else{
                                    
                                }

                            },
                            error: function(xhr) {
                                alert("Terjadi kesalahan. Silahkan coba kembali");
                            },
                            complete: function() {
                                $('#divagama').show();
                                $('#divagama2').show();
                                chart_agama(arr1a,arr2a,arr3a,arr4a,arr5a,arr6a);
                                chart_agama2(arr1b,arr2b,arr3b,arr4b,arr5b,arr6b);
                            }
                        });
                    }// end jenis 8
                    else if(jenis == 9)
                    {
                        var arrtpensiun = new Array();
                        
                        $.ajax({
                            url: "<?php echo base_url(); ?>index.php/statistik/eksekusidata",
                            type: "post",
                            data: {jenis:jenis, thbl:thblpr, skpd:skpdpr, ukpd:ukpdpr},
                            dataType: 'json',
                            beforeSend: function() {
                                $('#load').show();
                            },
                            success: function(data) {
                                $('#load').hide();
                                if(data.response == 'SUKSES'){
                                    
                                    var jj = "<tr><th>Tahun Pensiun</th><th>Jumlah</th></tr>";
                                    var kk="";
                                    var jm=0;
                                    
                                    arrtpensiun = data.list;
                                    for(j=0;j<data.list.length;j++)
                                    {
                                        if(skpdpr == "-")
                                        {
                                            kk += "<tr><td>"+data.list[j].TAHUNPENSIUN+"</td><td><a href='<?php echo site_url('detpegawai/index4')?>/"+jenis+"/"+thblpr+"/"+data.list[j].TAHUNPENSIUN+"' target='_blank'>"+data.list[j].JUMLAHTOTAL+"</a></td></tr>";    
                                        }
                                        else
                                        {
                                            
                                            if(ukpdpr == "-" || ukpdpr == null)
                                            {
                                                kk += "<tr><td>"+data.list[j].TAHUNPENSIUN+"</td><td><a href='<?php echo site_url('detpegawai/index4')?>/"+jenis+"/"+thblpr+"/"+data.list[j].TAHUNPENSIUN+"/"+skpdpr+"' target='_blank'>"+data.list[j].JUMLAHTOTAL+"</a></td></tr>";
                                            }
                                            else
                                            {
                                                kk += "<tr><td>"+data.list[j].TAHUNPENSIUN+"</td><td><a href='<?php echo site_url('detpegawai/index4')?>/"+jenis+"/"+thblpr+"/"+data.list[j].TAHUNPENSIUN+"/"+skpdpr+"/"+ukpdpr+"' target='_blank'>"+data.list[j].JUMLAHTOTAL+"</a></td></tr>";
                                            }
                                        }
                                        
                                        
                                        jm = parseInt(jm) + parseInt(data.list[j].JUMLAHTOTAL);
                                    
                                   }  

                                     kk += "<tr><td>TOTAL</td><td>"+jm+"</td></tr>";

                                    $('#headerpensiun').html(jj);   
                                    $('#isipensiun').html(kk);   

                                   

                                }else{
                                    
                                }

                            },
                            error: function(xhr) {
                                alert("Terjadi kesalahan. Silahkan coba kembali");
                            },
                            complete: function() {
                                $('#divpensiun').show();
                                
                                chart_pensiun(arrtpensiun);
                                
                            }
                        });
                    }//end jenis 9
                    
                }
            }

                
        }
        
        
        function chart_jenkel()
        {

            var ctx = document.getElementById("chartjenkel").getContext('2d');
            var jmlpria = document.getElementById('pria').value;
            var jmlwanita = document.getElementById('wanita').value;
            var myChart = new Chart(ctx, 
            {
                type: 'pie',
                data: {
                    labels: ["Pria", "Wanita"],
                    datasets: [{
                        label: 'Jumlah Orang',
                        data: [jmlpria,jmlwanita],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            
                            /*'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'*/
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255,99,132,1)',
                            
                            /*'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'*/
                        ],
                        borderWidth: 1
                    }]
                }/*,
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }*/
            });
            
        }

        function chart_jenkel1(arr1a,arr1b)
        {
            $('#chartjenkel').replaceWith('<canvas id="chartjenkel"></canvas>');    
            var ctx = document.getElementById("chartjenkel").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                 responsive:true,

                data: {
                    labels: ["Laki Laki", "Perempuan"],
                    datasets: 
                    [
                        {
                            label: 'Golongan I',
                            data: [arr1a[0], arr1b[0]],
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan II',
                            data: [arr1a[1], arr1b[1] ],
                            backgroundColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,

                        },
                        {
                            label: 'Golongan III',
                            data: [arr1a[2], arr1b[2]],
                            backgroundColor: [
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan IV',
                            data: [arr1a[3], arr1b[3]],
                            backgroundColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        }
                    ]
                },
                options: {
                   scales: {
                        yAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                          }
                        }],
                        xAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Jenis Kelamin'
                          }
                        }]
                      }
                }
            });
        }

        function chart_jenkel2(arr1a,arr1b)
        {
            $('#chartjenkelc').replaceWith('<canvas id="chartjenkelc"></canvas>');    
            var ctx = document.getElementById("chartjenkelc").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                 responsive:true,

                data: {
                    labels: ["Laki Laki", "Perempuan"],
                    datasets: 
                    [
                        {
                            label: 'Golongan I',
                            data: [arr1a[0], arr1b[0]],
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan II',
                            data: [arr1a[1], arr1b[1] ],
                            backgroundColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,

                        },
                        {
                            label: 'Golongan III',
                            data: [arr1a[2], arr1b[2]],
                            backgroundColor: [
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan IV',
                            data: [arr1a[3], arr1b[3]],
                            backgroundColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        }
                    ]
                },
                options: {
                   scales: {
                        yAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                          }
                        }],
                        xAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Jenis Kelamin'
                          }
                        }]
                      }
                }
            });
        }

        function chart_eselon(arr1a,arr1b,arr2a,arr2b,arr3a,arr3b,arr4a,arr4b)
        {
            $('#charteselon').replaceWith('<canvas id="charteselon"></canvas>');    
            var ctx = document.getElementById("charteselon").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                 responsive:true,

                data: {
                    labels: ["I/a", "I/b", "II/a", "II/b", "III/a", "III/b", "IV/a","IV/b"],
                    datasets: 
                    [
                        {
                            label: 'Golongan I',
                            data: [arr1a[0], arr1b[0], arr2a[0], arr2b[0], arr3a[0], arr3b[0],arr4a[0],arr4b[0]],
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan II',
                            data: [arr1a[1], arr1b[1], arr2a[1], arr2b[1], arr3a[1], arr3b[1],arr4a[1],arr4b[1]],
                            backgroundColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,

                        },
                        {
                            label: 'Golongan III',
                            data: [arr1a[2], arr1b[2], arr2a[2], arr2b[2], arr3a[2], arr3b[2],arr4a[2],arr4b[2]],
                            backgroundColor: [
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan IV',
                            data: [arr1a[3], arr1b[3], arr2a[3], arr2b[3], arr3a[3], arr3b[3],arr4a[3],arr4b[3]],
                            backgroundColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        }
                    ]
                },
                options: {
                   scales: {
                        yAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                          }
                        }],
                        xAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Eselon'
                          }
                        }]
                      }
                }
            });
        }

        function chart_noneselon(arrne)
        {
            
            $('#chartnoneselon').replaceWith('<canvas id="chartnoneselon"></canvas>');    
            var ctx = document.getElementById("chartnoneselon").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                 responsive:true,

                data: {
                    labels: ["Non Eselon"],
                    datasets: 
                    [
                        {
                            label: 'Golongan I',
                            data: [arrne[0].JUMLAHTOTAL],
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan II',
                            data: [arrne[1].JUMLAHTOTAL],
                            backgroundColor: [
                                
                                'rgba(54, 162, 235, 1)',
                                
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan III',
                            data: [arrne[2].JUMLAHTOTAL],
                            backgroundColor: [
                                ,
                                 'rgba(255, 206, 86, 1)',
                               
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan IV',
                            data: [arrne[3].JUMLAHTOTAL],
                            backgroundColor: [
                                
                               'rgba(75, 192, 192, 1)',
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        }

                    ]
                },
                options: {
                   scales: {
                        yAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                          }
                        }]
                      }
                }
            });
        }

        function chart_usia(arr1a,arr1b,arr2a,arr2b,arr3a,arr3b,arr4a)
        {
            $('#chartusia').replaceWith('<canvas id="chartusia"></canvas>');    
            var ctx = document.getElementById("chartusia").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                 responsive:true,

                data: {
                    labels: ["<25", "25-30", "30-36", "36-42", "42-48", "48-55", ">55"],
                    datasets: 
                    [
                        {
                            label: 'Golongan I',
                            data: [arr1a[0], arr1b[0], arr2a[0], arr2b[0], arr3a[0], arr3b[0],arr4a[0]],
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan II',
                            data: [arr1a[1], arr1b[1], arr2a[1], arr2b[1], arr3a[1], arr3b[1],arr4a[1]],
                            backgroundColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,

                        },
                        {
                            label: 'Golongan III',
                            data: [arr1a[2], arr1b[2], arr2a[2], arr2b[2], arr3a[2], arr3b[2],arr4a[2]],
                            backgroundColor: [
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan IV',
                            data: [arr1a[3], arr1b[3], arr2a[3], arr2b[3], arr3a[3], arr3b[3],arr4a[3]],
                            backgroundColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        }
                    ]
                },
                options: {
                   scales: {
                        yAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                          }
                        }],
                        xAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Usia dalam tahun'
                          }
                        }]
                      }
                }
            });
        }

        function chart_pangkat(arrne)
        {
            
            $('#chartpangkat').replaceWith('<canvas id="chartpangkat"></canvas>');    
            var ctx = document.getElementById("chartpangkat").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                 responsive:true,

                data: {
                    labels: ["Pangkat"],
                    datasets: 
                    [
                        {
                            label: 'Golongan I',
                            data: [arrne[0].JMLGOL],
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan II',
                            data: [arrne[1].JMLGOL],
                            backgroundColor: [
                                
                                'rgba(54, 162, 235, 1)',
                                
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan III',
                            data: [arrne[2].JMLGOL],
                            backgroundColor: [
                                ,
                                 'rgba(255, 206, 86, 1)',
                               
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan IV',
                            data: [arrne[3].JMLGOL],
                            backgroundColor: [
                                
                               'rgba(75, 192, 192, 1)',
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        }

                    ]
                },
                options: {
                   scales: {
                        yAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                          }
                        }]
                      }
                }
            });
        }

        function chart_pendidikan(arrtmi,arrsd,arrsmp,arrsma,arrd1,arrd2,arrd3,arrs1,arrs2,arrs3)
        {
            $('#chartpendidikan').replaceWith('<canvas id="chartpendidikan"></canvas>');    
            var ctx = document.getElementById("chartpendidikan").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                 responsive:true,

                data: {
                    labels: ["TMI", "SD", "SMP", "SMA", "D1", "D2", "D3","S1","S2","S3"],
                    datasets: 
                    [
                        {
                            label: 'Golongan I',
                            data: [arrtmi[0], arrsd[0], arrsmp[0], arrsma[0], arrd1[0], arrd2[0],arrd3[0],arrs1[0],arrs2[0],arrs3[0]],
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan II',
                            data: [arrtmi[1], arrsd[1], arrsmp[1], arrsma[1], arrd1[1], arrd2[1],arrd3[1],arrs1[1],arrs2[1],arrs3[1]],
                            backgroundColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,

                        },
                        {
                            label: 'Golongan III',
                            data: [arrtmi[2], arrsd[2], arrsmp[2], arrsma[2], arrd1[2], arrd2[2],arrd3[2],arrs1[2],arrs2[2],arrs3[2]],
                            backgroundColor: [
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan IV',
                            data: [arrtmi[3], arrsd[3], arrsmp[3], arrsma[3], arrd1[3], arrd2[3],arrd3[3],arrs1[3],arrs2[3],arrs3[3]],
                            backgroundColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        }
                    ]
                },
                options: {
                   scales: {
                        yAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                          }
                        }],
                        xAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Pendidikan PNS'
                          }
                        }]
                      }
                }
            });
        }

        function chart_pendidikan2(arrtmi,arrsd,arrsmp,arrsma,arrd1,arrd2,arrd3,arrs1,arrs2,arrs3)
        {
            $('#chartpendidikan2').replaceWith('<canvas id="chartpendidikan2"></canvas>');    
            var ctx = document.getElementById("chartpendidikan2").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                 responsive:true,

                data: {
                    labels: ["TMI", "SD", "SMP", "SMA", "D1", "D2", "D3","S1","S2","S3"],
                    datasets: 
                    [
                        {
                            label: 'Golongan I',
                            data: [arrtmi[0], arrsd[0], arrsmp[0], arrsma[0], arrd1[0], arrd2[0],arrd3[0],arrs1[0],arrs2[0],arrs3[0]],
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan II',
                            data: [arrtmi[1], arrsd[1], arrsmp[1], arrsma[1], arrd1[1], arrd2[1],arrd3[1],arrs1[1],arrs2[1],arrs3[1]],
                            backgroundColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,

                        },
                        {
                            label: 'Golongan III',
                            data: [arrtmi[2], arrsd[2], arrsmp[2], arrsma[2], arrd1[2], arrd2[2],arrd3[2],arrs1[2],arrs2[2],arrs3[2]],
                            backgroundColor: [
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan IV',
                            data: [arrtmi[3], arrsd[3], arrsmp[3], arrsma[3], arrd1[3], arrd2[3],arrd3[3],arrs1[3],arrs2[3],arrs3[3]],
                            backgroundColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        }
                    ]
                },
                options: {
                   scales: {
                        yAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                          }
                        }],
                        xAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Pendidikan CPNS'
                          }
                        }]
                      }
                }
            });
        }

        function chart_stawin(arrbk,arrk,arrj,arrd)
        {
            $('#chartstawin').replaceWith('<canvas id="chartstawin"></canvas>');    
            var ctx = document.getElementById("chartstawin").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                 responsive:true,

                data: {
                    labels: ["Belum Kawin", "Kawin", "Janda", "Duda"],
                    datasets: 
                    [
                        {
                            label: 'Golongan I',
                            data: [arrbk[0], arrk[0], arrj[0], arrd[0]],
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)'
                                
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan II',
                            data: [arrbk[1], arrk[1], arrj[1], arrd[1]],
                            backgroundColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)'
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,

                        },
                        {
                            label: 'Golongan III',
                            data: [arrbk[2], arrk[2], arrj[2], arrd[2]],
                            backgroundColor: [
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)'
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan IV',
                            data: [arrbk[3], arrk[3], arrj[3], arrd[3]],
                            backgroundColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)'
                                
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        }
                    ]
                },
                options: {
                   scales: {
                        yAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                          }
                        }],
                        xAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Stawin PNS'
                          }
                        }]
                      }
                }
            });
        }

        function chart_stawin2(arrbk,arrk,arrj,arrd)
        {
            $('#chartstawin2').replaceWith('<canvas id="chartstawin2"></canvas>');    
            var ctx = document.getElementById("chartstawin2").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                 responsive:true,

                data: {
                    labels: ["Belum Kawin", "Kawin", "Janda", "Duda"],
                    datasets: 
                    [
                        {
                            label: 'Golongan I',
                            data: [arrbk[0], arrk[0], arrj[0], arrd[0]],
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)'
                                
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan II',
                            data: [arrbk[1], arrk[1], arrj[1], arrd[1]],
                            backgroundColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)'
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,

                        },
                        {
                            label: 'Golongan III',
                            data: [arrbk[2], arrk[2], arrj[2], arrd[2]],
                            backgroundColor: [
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)'
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan IV',
                            data: [arrbk[3], arrk[3], arrj[3], arrd[3]],
                            backgroundColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)'
                                
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        }
                    ]
                },
                options: {
                   scales: {
                        yAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                          }
                        }],
                        xAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Stawin CPNS'
                          }
                        }]
                      }
                }
            });
        }

        function chart_masker(arr1,arr2,arr3,arr4,arr5,arr6,arr7,arr8)
        {
            $('#chartmasker').replaceWith('<canvas id="chartmasker"></canvas>');    
            var ctx = document.getElementById("chartmasker").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                 responsive:true,

                data: {
                    labels: ["1-5", "6-10", "11-15", "16-20", "21-25", "26-30", "30-35", ">35"],
                    datasets: 
                    [
                        {
                            label: 'Golongan I',
                            data: [arr1[0], arr2[0], arr3[0], arr4[0],arr5[0], arr6[0], arr7[0], arr8[0]],
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)'
                                
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan II',
                            data: [arr1[1], arr2[1], arr3[1], arr4[1],arr5[1], arr6[1], arr7[1], arr8[1]],
                            backgroundColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)'
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,

                        },
                        {
                            label: 'Golongan III',
                            data: [arr1[2], arr2[2], arr3[2], arr4[2],arr5[2], arr6[2], arr7[2], arr8[2]],
                            backgroundColor: [
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)'
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan IV',
                            data: [arr1[4], arr2[4], arr3[4], arr4[4],arr5[4], arr6[4], arr7[4], arr8[4]],
                            backgroundColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)'
                                
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        }
                    ]
                },
                options: {
                   scales: {
                        yAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                          }
                        }],
                        xAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Masa Kerja dalam Tahun (PNS)'
                          }
                        }]
                      }
                }
            });
        }

        function chart_masker2(arr1,arr2,arr3,arr4,arr5,arr6,arr7,arr8)
        {
            $('#chartmasker2').replaceWith('<canvas id="chartmasker2"></canvas>');    
            var ctx = document.getElementById("chartmasker2").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                 responsive:true,

                data: {
                    labels: ["1-5", "6-10", "11-15", "16-20", "21-25", "26-30", "30-35", ">35"],
                    datasets: 
                    [
                        {
                            label: 'Golongan I',
                            data: [arr1[0], arr2[0], arr3[0], arr4[0],arr5[0], arr6[0], arr7[0], arr8[0]],
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)'
                                
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan II',
                            data: [arr1[1], arr2[1], arr3[1], arr4[1],arr5[1], arr6[1], arr7[1], arr8[1]],
                            backgroundColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)'
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,

                        },
                        {
                            label: 'Golongan III',
                            data: [arr1[2], arr2[2], arr3[2], arr4[2],arr5[2], arr6[2], arr7[2], arr8[2]],
                            backgroundColor: [
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)'
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan IV',
                            data: [arr1[4], arr2[4], arr3[4], arr4[4],arr5[4], arr6[4], arr7[4], arr8[4]],
                            backgroundColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)'
                                
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        }
                    ]
                },
                options: {
                   scales: {
                        yAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                          }
                        }],
                        xAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Masa Kerja dalam Tahun (CPNS)'
                          }
                        }]
                      }
                }
            });
        }

        function chart_agama(arr1,arr2,arr3,arr4,arr5,arr6)
        {
            $('#chartagama').replaceWith('<canvas id="chartagama"></canvas>');    
            var ctx = document.getElementById("chartagama").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                 responsive:true,

                data: {
                    labels: ["Islam", "Protestan", "Katolik", "Hindu", "Buddha", "Khonghucu"],
                    datasets: 
                    [
                        {
                            label: 'Golongan I',
                            data: [arr1[0], arr2[0], arr3[0], arr4[0],arr5[0], arr6[0]],
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)'
                                
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan II',
                            data: [arr1[1], arr2[1], arr3[1], arr4[1],arr5[1], arr6[1]],
                            backgroundColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)'
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,

                        },
                        {
                            label: 'Golongan III',
                            data: [arr1[2], arr2[2], arr3[2], arr4[2],arr5[2], arr6[2]],
                            backgroundColor: [
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)'
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan IV',
                            data: [arr1[4], arr2[4], arr3[4], arr4[4],arr5[4], arr6[4]],
                            backgroundColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)'
                                
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        }
                    ]
                },
                options: {
                   scales: {
                        yAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                          }
                        }],
                        xAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Agama (PNS)'
                          }
                        }]
                      }
                }
            });
        }

        function chart_agama2(arr1,arr2,arr3,arr4,arr5,arr6)
        {
            $('#chartagama2').replaceWith('<canvas id="chartagama2"></canvas>');    
            var ctx = document.getElementById("chartagama2").getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                 responsive:true,

                data: {
                    labels: ["Islam", "Protestan", "Katolik", "Hindu", "Buddha", "Khonghucu"],
                    datasets: 
                    [
                        {
                            label: 'Golongan I',
                            data: [arr1[0], arr2[0], arr3[0], arr4[0],arr5[0], arr6[0]],
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 99, 132, 1)'
                                
                            
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan II',
                            data: [arr1[1], arr2[1], arr3[1], arr4[1],arr5[1], arr6[1]],
                            backgroundColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(54, 162, 235, 1)'
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,

                        },
                        {
                            label: 'Golongan III',
                            data: [arr1[2], arr2[2], arr3[2], arr4[2],arr5[2], arr6[2]],
                            backgroundColor: [
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 206, 86, 1)'
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        },
                        {
                            label: 'Golongan IV',
                            data: [arr1[4], arr2[4], arr3[4], arr4[4],arr5[4], arr6[4]],
                            backgroundColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(75, 192, 192, 1)'
                                
                                
                            ],
                            scaleOverride: true,
                            scaleSteps: 9,
                        }
                    ]
                },
                options: {
                   scales: {
                        yAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Jumlah'
                          }
                        }],
                        xAxes: [{
                          scaleLabel: {
                            display: true,
                            labelString: 'Agama (CPNS)'
                          }
                        }]
                      }
                }
            });
        }


        function chart_pensiun(arrne)
        {
            var byk = arrne.length;
           // var arrwarna = ["'rgba(255, 99, 132, 1)'","'rgba(54, 162, 235, 1)'","'rgba(255, 206, 86, 1)'","'rgba(75, 192, 192, 1)'","'rgba(75, 55, 192, 1)'","'rgba(75, 192, 55, 1)'"];
            
            $('#chartpensiun').replaceWith('<canvas id="chartpensiun"></canvas>');    
            var ctx = document.getElementById("chartpensiun").getContext('2d');

            if(byk == 1)
            {
                var myChart = new Chart(ctx, {
                    type: 'bar',
                     responsive:true,

                    data: {
                        labels: ["Tahun Pensiun"],
                        datasets: 
                        [

                            {
                                label: [arrne[0].TAHUNPENSIUN],
                                data: [arrne[0].JUMLAHTOTAL],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 1)'
                                    
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            }

                        ]
                    },
                    options: {
                       scales: {
                            yAxes: [{
                              scaleLabel: {
                                display: true,
                                labelString: 'Jumlah'
                              },
                              ticks: {
                                    beginAtZero: true
                                }
                            }]
                          }
                    }
                });
            }
            else if(byk==2)
            {
                var myChart = new Chart(ctx, {
                    type: 'bar',
                     responsive:true,

                    data: {
                        labels: ["Tahun Pensiun"],
                        datasets: 
                        [

                            {
                                label: [arrne[0].TAHUNPENSIUN],
                                data: [arrne[0].JUMLAHTOTAL],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 1)'
                                    
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            },
                            {
                                label: [arrne[1].TAHUNPENSIUN],
                                data: [arrne[1].JUMLAHTOTAL],
                                backgroundColor: [
                                    
                                    'rgba(54, 162, 235, 1)',
                                    
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            }

                        ]
                    },
                    options: {
                       scales: {
                            yAxes: [{
                              scaleLabel: {
                                display: true,
                                labelString: 'Jumlah'
                              },
                              ticks: {
                                    beginAtZero: true
                                }
                            }]
                          }
                    }
                });
            }
            else if(byk==3)
            {
                var myChart = new Chart(ctx, {
                    type: 'bar',
                     responsive:true,

                    data: {
                        labels: ["Tahun Pensiun"],
                        datasets: 
                        [

                            {
                                label: [arrne[0].TAHUNPENSIUN],
                                data: [arrne[0].JUMLAHTOTAL],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 1)'
                                    
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            },
                            {
                                label: [arrne[1].TAHUNPENSIUN],
                                data: [arrne[1].JUMLAHTOTAL],
                                backgroundColor: [
                                    
                                    'rgba(54, 162, 235, 1)',
                                    
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            },
                            {
                                label: [arrne[2].TAHUNPENSIUN],
                                data: [arrne[2].JUMLAHTOTAL],
                                backgroundColor: [
                                    ,
                                     'rgba(255, 206, 86, 1)',
                                   
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            }

                        ]
                    },
                    options: {
                       scales: {
                            yAxes: [{
                              scaleLabel: {
                                display: true,
                                labelString: 'Jumlah'
                              },
                              ticks: {
                                    beginAtZero: true
                                }
                            }]
                          }
                    }
                });
            }
            else if(byk==4)
            {
                var myChart = new Chart(ctx, {
                    type: 'bar',
                     responsive:true,

                    data: {
                        labels: ["Tahun Pensiun"],
                        datasets: 
                        [

                            {
                                label: [arrne[0].TAHUNPENSIUN],
                                data: [arrne[0].JUMLAHTOTAL],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 1)'
                                    
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            },
                            {
                                label: [arrne[1].TAHUNPENSIUN],
                                data: [arrne[1].JUMLAHTOTAL],
                                backgroundColor: [
                                    
                                    'rgba(54, 162, 235, 1)',
                                    
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            },
                            {
                                label: [arrne[2].TAHUNPENSIUN],
                                data: [arrne[2].JUMLAHTOTAL],
                                backgroundColor: [
                                    ,
                                     'rgba(255, 206, 86, 1)',
                                   
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            },
                            {
                               label: [arrne[3].TAHUNPENSIUN],
                                data: [arrne[3].JUMLAHTOTAL],
                                backgroundColor: [
                                    
                                   'rgba(75, 192, 192, 1)',
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            }
                            
                        ]
                    },
                    options: {
                       scales: {
                            yAxes: [{
                              scaleLabel: {
                                display: true,
                                labelString: 'Jumlah'
                              },
                              ticks: {
                                    beginAtZero: true
                                }
                            }]
                          }
                    }
                });
            }
            else if(byk == 5)
            {
                var myChart = new Chart(ctx, {
                    type: 'bar',
                     responsive:true,

                    data: {
                        labels: ["Tahun Pensiun"],
                        datasets: 
                        [

                            {
                                label: [arrne[0].TAHUNPENSIUN],
                                data: [arrne[0].JUMLAHTOTAL],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 1)'
                                    
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            },
                            {
                                label: [arrne[1].TAHUNPENSIUN],
                                data: [arrne[1].JUMLAHTOTAL],
                                backgroundColor: [
                                    
                                    'rgba(54, 162, 235, 1)',
                                    
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            },
                            {
                                label: [arrne[2].TAHUNPENSIUN],
                                data: [arrne[2].JUMLAHTOTAL],
                                backgroundColor: [
                                    ,
                                     'rgba(255, 206, 86, 1)',
                                   
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            },
                            {
                               label: [arrne[3].TAHUNPENSIUN],
                                data: [arrne[3].JUMLAHTOTAL],
                                backgroundColor: [
                                    
                                   'rgba(75, 192, 192, 1)',
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            }
                            ,
                            {
                               label: [arrne[4].TAHUNPENSIUN],
                                data: [arrne[4].JUMLAHTOTAL],
                                backgroundColor: [
                                    
                                   'rgba(75, 55, 192, 1)',
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            }
                            

                        ]
                    },
                    options: {
                       scales: {
                            yAxes: [{
                              scaleLabel: {
                                display: true,
                                labelString: 'Jumlah'
                              },
                              ticks: {
                                    beginAtZero: true
                                }
                            }]
                          }
                    }
                });
            } 
            else if(byk==6)
            {
                    var myChart = new Chart(ctx, {
                    type: 'bar',
                     responsive:true,

                    data: {
                        labels: ["Tahun Pensiun"],
                        datasets: 
                        [

                            {
                                label: [arrne[0].TAHUNPENSIUN],
                                data: [arrne[0].JUMLAHTOTAL],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 1)'
                                    
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            },
                            {
                                label: [arrne[1].TAHUNPENSIUN],
                                data: [arrne[1].JUMLAHTOTAL],
                                backgroundColor: [
                                    
                                    'rgba(54, 162, 235, 1)',
                                    
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            },
                            {
                                label: [arrne[2].TAHUNPENSIUN],
                                data: [arrne[2].JUMLAHTOTAL],
                                backgroundColor: [
                                    ,
                                     'rgba(255, 206, 86, 1)',
                                   
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            },
                            {
                               label: [arrne[3].TAHUNPENSIUN],
                                data: [arrne[3].JUMLAHTOTAL],
                                backgroundColor: [
                                    
                                   'rgba(75, 192, 192, 1)',
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            }
                            ,
                            {
                               label: [arrne[4].TAHUNPENSIUN],
                                data: [arrne[4].JUMLAHTOTAL],
                                backgroundColor: [
                                    
                                   'rgba(75, 55, 192, 1)',
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            }
                            ,
                            {
                               label: [arrne[5].TAHUNPENSIUN],
                                data: [arrne[5].JUMLAHTOTAL],
                                backgroundColor: [
                                    
                                   'rgba(75, 192, 55, 1)',
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            }

                        ]
                    },
                    options: {
                       scales: {
                            yAxes: [{
                              scaleLabel: {
                                display: true,
                                labelString: 'Jumlah'
                              },
                              ticks: {
                                    beginAtZero: true
                                }
                            }]
                          }
                    }
                });
            }
            else
            {
                var myChart = new Chart(ctx, {
                    type: 'bar',
                     responsive:true,

                    data: {
                        labels: ["Tahun Pensiun"],
                        datasets: 
                        [

                            {
                                label: '-',
                                data: '0',
                                backgroundColor: [
                                    
                                    
                                
                                ],
                                scaleOverride: true,
                                scaleSteps: 9,
                            }

                        ]
                    },
                    options: {
                       scales: {
                            yAxes: [{
                              scaleLabel: {
                                display: true,
                                labelString: 'Jumlah'
                              },
                              ticks: {
                                    beginAtZero: true
                                }
                            }]
                          }
                    }
                });
            }
            
        }

       /*START CHOSEN*/
            var config = {
                  '.chosen-jenis'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                   '.chosen-thbl'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                    '.chosen-ukpd'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                    '.chosen-spmu'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"}
                                }
                for (var selector in config) {
                  $(selector).chosen(config[selector]);
                }
            /*END CHOSEN*/

         


        </script>

