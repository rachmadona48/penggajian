<?php 
    //session_cache_limiter('private, must-revalidate');
    header('Cache-Control: max-age=900');
    session_cache_limiter('public');
?>    
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
                /*left: -65px;*/
                min-width: 100%;
                left: calc(100% - (125px));
                margin-top: 35px;
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
                    <strong>Pencarian</strong>
                </li>
            </ol>
             <small><i>(Menu untuk melihat data pegawai sesuai kriteria penyaringan)</i></small>
        </div>
        <div class="col-lg-2">

        </div>
    </div>


<div class="wrapper wrapper-content">
    <?php if($user_group == 2 ||$user_group == 3 || $user_group == 10 || $user_group == 11 || $user_group == 4 || $user_group == 13){ ?>    
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
                                <form class="form-inline" id="defaultForm" method="post" action="javascript:">
                                    
                                    <div class="row">
                                        <div class="form-group">
                                            <label>&nbsp;&nbsp;&nbsp;&nbsp;Cari berdasarkan</label>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" id="srcglobal" name="srcglobal" class="form-control" maxlength="50" style="width:330px" placeholder="MASUKKAN NRK / NAMA">
                                            <input type="hidden" name="nrksrc" id="nrksrc" value="<?php echo isset($nrksrc) ? $nrksrc : '' ;?>">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="form-group">
                                        <label>Status Aktif Pegawai</label>
                                    </div>


                                    <div class="form-group">
                                        <select class="form-control chosen-jenis" name="staakt" id="staakt" data-placeholder="Cari Berdasarkan...">
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                            <option value="2">Semua</option>
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm addButton" data-template="textbox"><i class="fa fa-plus"></i></button>
                                    <div class="data-form-group">
                                        <div class="row"></div>
                                        <div class="form-group" style="display: none">
                                            <label class="sr-only" for="exampleInputEmail3">Cari</label>
                                            <select class="form-control chosen-jenis" name="jenis[]" id="jenis1" onchange="return getOptionValue(this, 1);" data-placeholder="Cari Berdasarkan...">
                                                <option></option>
                                                <option value="ESELON">Eselon</option>
                                                <option value="KOPANG">Pangkat/Golongan</option>
                                                <option value="KOLOK">Lokasi Kerja</option>
                                                <option value="KOJAB">Jabatan</option>
                                                <option value="JENKEL">Jenis Kelamin</option>
                                                <option value="KAWIN">Status Menikah</option>
                                                <option value="AGAMA">Agama</option>
                                                <option value="STAPEG">Status PNS / CPNS</option>
                                               <!-- <option value="FLAG">Status Aktif</option> -->
                                                <option value="NADIK">Pendidikan</option>
                                                <option value="JENJDIK">Jenjang Pendidikan</option>
                                                <option value="MAKER">Masa Kerja</option>
                                                <option value="HUKDIS">Hukuman Disiplin</option>
                                                <option value="USIA">Usia</option>
                                                <option value="FASILITAS">Fasilitas</option>
                                            </select>
                                        </div>
                                        <div class="form-group" style="display: none">
                                            <label class="sr-only" for="exampleInputPassword3">Cari</label>
                                            <span class="value-param-1">
                                                <input class="form-control" id="jenisop1" type="text" placeholder="..." />
                                            </span>
                                        </div>
                                    </div>
                                    <div class="data-form-group hide" id="textboxTemplate">
                                        <div class="form-group">
                                            <label class="sr-only" for="exampleInputEmail3">Cari</label>
                                            <select  data-placeholder="Cari Berdasarkan...">
                                                <option></option>
                                                <option value="ESELON">Eselon</option>
                                                <option value="KOPANG">Pangkat/Golongan</option>
                                                <option value="KOLOK">Lokasi Kerja</option>
                                                <option value="KOJAB">Jabatan</option>
                                                <option value="JENKEL">Jenis Kelamin</option>
                                                <option value="KAWIN">Status Menikah</option>
                                                <option value="AGAMA">Agama</option>
                                                <option value="STAPEG">Status PNS / CPNS</option>
                                              <!--  <option value="FLAG">Status Aktif</option> -->
                                                <option value="NADIK">Pendidikan</option>
                                                <option value="JENJDIK">Jenjang Pendidikan</option>
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
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <span>
                                                                <a onclick="return tampilkanPegawai2('defaultForm');" class="btn btn-primary btnCari" id="btnCari" ><i class="fa fa-search"></i> Tampilkan</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                         <div class="col-md-10">
                                                            <span id="cetaklap" >
                                                            

                                                                <button type="button" onclick="tampil()" class="btn btn-danger" id="btnCetak"><i class="fa fa-file-pdf-o"></i> Cetak</button>
                                                           
                                                            
                                                            </span>
                                                            
                                                        </div>
                                                    </div>
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
                <div class="ibox-content" style="background-color: rgba(255,255,255,0.85)" id="isitabel">
                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-12">
                            
                            
                            


                            <table id="tbl-grid" class="table table-striped table-bordered table-hover dataTables-example" width="100%">
                                 <thead>
                                    <tr>
                                        <!--<th width="5%">No</th>-->
                                        <!--<th width="5%">NRK</th>
                                        <th width="18%">Nama</th>
                                        <th width="20%">Jabatan</th>
                                        <th width="30%">Lokasi</th>
                                        <th width="10%">Aksi</th>-->
                                        <th >NRK</th>
                                        <th >Nama</th>
                                        <th >Jabatan</th>
                                        <th >Lokasi</th>
                                        <th >Aksi</th>
                                    </tr>
                                 </thead>
                                 <!--
                                 <thead>
                                    <tr>
                                        <td></td>
                                        <td><input type="text" data-column="0"  class="search-input-text"></td>
                                        <td><input type="text" data-column="1"  class="search-input-text"></td>
                                        <td><input type="text" data-column="2"  class="search-input-text"></td>
                                        <td><input type="text" data-column="3"  class="search-input-text"></td>
                                    </tr>
                                </thead>-->

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

        <!-- blockUI -->
        <script src="<?php echo base_url(); ?>assets/js/lib-1.0.0.js"></script>


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

                $('#srcglobal').keyup(function(event){
                    var keycode = event.keyCode;
                    if(keycode == '13'){
                        //tampilkanPegawai2('defaultForm');
                        $('.btnCari').click();
                        
                    }
                });


                cekIsiDatatable();
                var spinner = '<div class="sk-spinner sk-spinner-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>';
                
                

                var counter = 2;
                $('.addButton').on('click', function() {
                    var index = $(this).data('index');
                   
                    
                    if (!index) 
                    {
                        index = 1;
                        $(this).data('index', 1);
                    }else{
                        index++;
                    }

                    
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
                                //index--;
                                
                            });
                             
                            var config = {
                                            '.chosen-jenis'           : {no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                                        }
                            for (var selector in config) {
                              $(selector).chosen(config[selector]);
                            }
                    
                }); 

                



    //             var dataTable = $('#tbl-grid').DataTable( {
                //  "aoColumns": [
                //      { "bSortable": false },
                //      null,
                //      null,
                //      null,
                //      null,
                //      { "bSortable": false },
                //      { "bSortable": false }
                //  ],
                //  responsive: true,
                //  "processing": true,
                //  "serverSide": true,
                //  "language": {
                //      "processing": "<div></div><div></div><div></div><div></div><div></div>"
                //  },
                //  "ajax":{
                //      type: "post",  // method  , by default get
                //      error: function(){  // error handling
                //          $(".employee-grid-error").html("");
                //          $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
                //          $("#employee-grid_processing").css("display","none");
                //      }
                //  }
                // } );


                
            });
        </script>

        <script type="text/javascript">

            function checkJabatan(e){
                
            }

            function tampil()
            {
                /*$('#defaultForm').submit (function(){
                    cetakPegawai2('#defaultForm');
                });*/
                $('#defaultForm').attr("target", "_blank")
                document.getElementById("defaultForm").action = '<?php echo base_url('/report/cetakReport'); ?>';
                document.getElementById("defaultForm").submit();
            }

            function tampilkanPegawai(formid) {
                var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';           
                $.ajax({
                    url: "/report/getListPegawai",
                    type: "post",
                    data: $("#"+formid).serialize(),
                    dataType: 'json',
                    beforeSend: function() {                        
                        if($("#jenis1").val() == ""){
                            alert('Pilih Salah Status Jenis Pencarian Pegawai.');
                            return false;
                        }
                        $("#daftar_pegawai").html(spinner);
                    },
                    success: function(data) {                                                                     
                        if(data.response == 'SUKSES'){                           
                            $("#daftar_pegawai").html(data.datapegawai);

                            $('#datapegawai').DataTable({
                                responsive: true,
                                "scrollX": true,
                                "serverSide": true
                            });
                        }else{
                            $("#daftar_pegawai").html('<i class="text-danger">Silahkan coba kembali</i>');
                        }
                    },
                    error: function(xhr) {                              
                        $("#daftar_pegawai").html('<i class="text-danger">Silahkan coba kembali</i>');
                    },
                    complete: function() {
                                         
                    }
                });

                
            }

            function cekIsiDatatable()
            {
                var a = $('#tbl-grid > tbody > tr').length;
                
            }

            function tampilkanPegawai2(formid) {
                var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';  



               var dtbl= $('#tbl-grid').DataTable({
                    "aoColumns": [
                        { "width": "10%" },
                        { "width": "18%" },
                        { "width": "20%" },
                        { "width": "30%" },
                        { "width": "10%" }
                    ],

                    "bSort":false,
                    destroy: true,
                    searching:true,
                    responsive: false,
                    "scrollX": true,
                    "serverSide": true,
          
                    "ajax": {
                        "url": "/report/getListPegawai",
                        "type": "POST",
                        "data": function ( d ) {
                            d.staakt = $('#staakt').val();
                            d.srcglobal = $('#srcglobal').val();
                            d.jenis = $("select[name='jenis\\[\\]']").map(function(){return $(this).val();}).get();
                            d.kolok = $("select[name='kolok\\[\\]']").map(function(){return $(this).val();}).get();
                            d.jabatan = $("select[name='jabatan\\[\\]']").map(function(){return $(this).val();}).get();
                            d.pangkat = $("select[name='pangkat\\[\\]']").map(function(){return $(this).val();}).get();
                            d.eselon = $("select[name='eselon\\[\\]']").map(function(){return $(this).val();}).get();
                            d.jeniskelamin = $("select[name='jeniskelamin\\[\\]']").map(function(){return $(this).val();}).get();
                            d.statuskawin = $("select[name='statuskawin\\[\\]']").map(function(){return $(this).val();}).get();
                            d.agama = $("select[name='agama\\[\\]']").map(function(){return $(this).val();}).get();
                            d.stapeg = $("select[name='stapeg\\[\\]']").map(function(){return $(this).val();}).get();
                            d.statusaktif = $("select[name='statusaktif\\[\\]']").map(function(){return $(this).val();}).get();
                            d.jendik = $("select[name='jendik\\[\\]']").map(function(){return $(this).val();}).get();
                            d.jenjdik = $("select[name='jenjdik\\[\\]']").map(function(){return $(this).val();}).get();
                            d.masakerja = $("select[name='masakerja\\[\\]']").map(function(){return $(this).val();}).get();
                            d.hukdis = $("select[name='hukdis\\[\\]']").map(function(){return $(this).val();}).get();
                            d.usia1 = $("input[name='usia1\\[\\]']").map(function(){return $(this).val();}).get();
                            d.usia2 = $("input[name='usia2\\[\\]']").map(function(){return $(this).val();}).get();
                            d.jenfas = $("select[name='jenfas\\[\\]']").map(function(){return $(this).val();}).get();
                        },
                        beforeSend: function() {
                            blocklayar();
                            $("#daftar_pegawai").html(spinner);
                        },
                        
                        complete: function()
                        {
                             unblocklayar();
                             $("#daftar_pegawai").html('');
                             $('html, body').animate({
                            scrollTop: $("#isitabel").offset().top
                        }, 1500);
                             cekIsiDatatable();
                        }
                    },
                    "initComplete": function() {
                        var $searchInput = $('div.dataTables_filter input');
             
                        $searchInput.unbind();
             
                        $searchInput.bind('keyup', function(e) {
                            if(e.keyCode == 13) {
                                dtbl.search( this.value ).draw();
                            }
                    });
        }

                });
               // $('#tbl-grid_filter').css("display","none");//hide filtering

               /* $('.search-input-text').on( 'change', function () {   // for text boxes
                    var i =$(this).attr('data-column');  // getting column index
                    var v =$(this).val();  // getting search input value
                    dtbl.columns(i).search(v).draw();
                } );
                $('.search-input-select').on( 'change', function () {   // for select box
                    var i =$(this).attr('data-column');
                    var v =$(this).val();
                    dtbl.columns(i).search(v).draw();
                } );
                                //  $('#tbl-grid').before($("#daftar_pegawai").html(spinner));
                // $('#tbl-grid').on('draw.dt',function(){
                //     $("#daftar_pegawai").html('')
                //  });
                */
            }

            function cetakPegawai2()
            {
                var staakt = $('#staakt').val();
                var srcglobal = $('#srcglobal').val();
                var jenis = $("select[name='jenis\\[\\]']").map(function(){return $(this).val();}).get();
                var kolok = $("select[name='kolok\\[\\]']").map(function(){return $(this).val();}).get();
                var jabatan = $("select[name='jabatan\\[\\]']").map(function(){return $(this).val();}).get();
                var pangkat = $("select[name='pangkat\\[\\]']").map(function(){return $(this).val();}).get();
                var eselon = $("select[name='eselon\\[\\]']").map(function(){return $(this).val();}).get();
                var jeniskelamin = $("select[name='jeniskelamin\\[\\]']").map(function(){return $(this).val();}).get();
                var statuskawin = $("select[name='statuskawin\\[\\]']").map(function(){return $(this).val();}).get();
                var agama = $("select[name='agama\\[\\]']").map(function(){return $(this).val();}).get();
                var stapeg = $("select[name='stapeg\\[\\]']").map(function(){return $(this).val();}).get();
                var statusaktif = $("select[name='statusaktif\\[\\]']").map(function(){return $(this).val();}).get();
                var jendik = $("select[name='jendik\\[\\]']").map(function(){return $(this).val();}).get();
                var jenjdik = $("select[name='jenjdik\\[\\]']").map(function(){return $(this).val();}).get();
                var masakerja = $("select[name='masakerja\\[\\]']").map(function(){return $(this).val();}).get();
                var hukdis = $("select[name='hukdis\\[\\]']").map(function(){return $(this).val();}).get();
                //var usia = $("select[name='usia\\[\\]']").map(function(){return $(this).val();}).get();
                //var usia = $("input name='usia1'").map(function(){return $(this).val();}).get();
                var usia1 = $("input[name='usia1\\[\\]']").map(function(){return $(this).val();}).get();
                var usia2 = $("input[name='usia2\\[\\]']").map(function(){return $(this).val();}).get();
                var jenfas = $("select[name='jenfas\\[\\]']").map(function(){return $(this).val();}).get();
                
                var param=staakt;
                
                /*if(jenis!=""){ param = param +'/'+jenis;}
                if(kolok!=""){ param = param +'/'+kolok;}
                if(jabatan!=""){ param = param +'/'+jabatan;}
                if(pangkat!=""){ param = param +'/'+pangkat;}
                if(eselon!="") { param = param +'/'+eselon;}
                if(jeniskelamin!=""){ param = param+'/'+jeniskelamin;}
                if(statuskawin!="") { param = param +'/'+statuskawin;}
                if(agama!=""){ param = param +'/'+agama;}
                if(stapeg!=""){ param = param +'/'+stapeg;}
                if(statusaktif!=""){ param = param +'/'+statusaktif;}
                if(jendik!=""){ param = param +'/'+jendik;}
                if(masakerja!=""){ param = param +'/'+masakerja;}
                if(hukdis!=""){ param = param +'/'+hukdis;}
                if(usia!=""){ param = param +'/'+usia;}
                if(jenfas!=""){ param = param +'/'+jenfas;}*/
                
                /*$.ajax({
                    url: "/report/cetakReport",
                    type: "post",
                    data: 'staakt='+staakt+'&jenis='+jenis+'&kolok='+kolok+'&jabatan='+jabatan+'&pangkat='+pangkat+'&eselon='+eselon+'&jeniskelamin='+jeniskelamin+'&statuskawin='+statuskawin+'&agama='+agama+'&stapeg='+stapeg+'&statusaktif='+statusaktif+'&jendik='+jendik+'&masakerja='+masakerja+'&hukdis='+hukdis+'&usia1='+usia1+'&usia2='+usia2+'&jenfas='+jenfas,
                    dataType:JSON,
                    beforeSend: function() {
                       
                    },
                    success: function(data) {                                                                     
                        
                    },
                    error: function(xhr) {                              
                        
                    },
                    complete: function() {
                        
                    }
                });

                var url = '<?php //echo base_url("index.php/report/cetakReport"); ?>';
                window.open(url,'_blank');*/               
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

