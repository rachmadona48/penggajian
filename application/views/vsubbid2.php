    <link rel="stylesheet" href="<?php echo base_url()?>assets/sweetalert2/sweetalert2.min.css"> 
    <style type="text/css">
        .navigation {
            width: 0; 
            background-color: black;
            overflow: hidden;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            z-index: 999999;
        }
        .main-wrapper{
            width: 100%;
            float: right;
        }

        /* The Overlay (background) */
        .overlay {
            /* Height & width depends on how you want to reveal the overlay (see JS below) */   
            height: 0;
            width: 100%;
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            right: 0;
            top: 0;
            background-color: rgb(0,0,0); /* Black fallback color */
            background-color: rgba(0,0,0, 0.8); /* Black w/opacity */
            overflow-x: hidden; /* Disable horizontal scroll */
            transition: 0.5s; /* 0.5 second transition effect to slide in or slide down the overlay (height or width, depending on reveal) */
            z-index: 999999;
        }

        /* Position the content inside the overlay */
        .overlay-content {
            position: relative;
            top: 25%; /* 25% from the top */
            width: 100%; /* 100% width */
            text-align: center; /* Centered text/links */
            margin-top: 30px; /* 30px top margin to avoid conflict with the close button on smaller screens */
        }

        /* The navigation links inside the overlay */
        .overlay a {
            padding: 8px;
            text-decoration: none;
            font-size: 36px;
            color: #818181;
            display: block; /* Display block instead of inline */
            transition: 0.4s; /* Transition effects on hover (color) */
        }

        /* When you mouse over the navigation links, change their color */
        .overlay a:hover, .overlay a:focus {
            color: #f1f1f1;
        }

        /* Position the close button (top right corner) */
        .overlay .closebtn {
            position: absolute;
            top: 20px;
            right: 45px;
            font-size: 60px;
        }

        /* When the height of the screen is less than 450 pixels, change the font-size of the links and position the close button again, so they don't overlap */
        @media screen and (max-height: 450px) {
            .overlay a {font-size: 20px}
            .overlay .closebtn {
                font-size: 40px;
                top: 15px;
                right: 35px;
            }
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

        .input-group-addon {
            background-color: #1ab394 !important;
            color: #fff !important;
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
    <link rel="stylesheet" href="<?php echo base_url()?>assets/sweetalert2/sweetalert2.min.css"> <!-- Resource style -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/horizontal-timeline/css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/horizontal-timeline/css/style.css"> <!-- Resource style -->

    <!-- The overlay -->
    <div id="myNav" class="overlay">

      <!-- Button to close the overlay navigation -->
      <a class="closebtn"">&times;</a>

      <!-- Overlay content -->
      <div class="overlay-content">
        <a href="#" id="cetak_cover_perbal" class="hidden">Cetak Cover Perbal</a>
        <a href="#" id="cetak_isi_perbal">Cetak Perbal</a>
        <a href="#" id="cetak_lampiran_sk" class="hidden">Cetak Lampiran Perbal</a>
      </div>

    </div>

    <div class="main-wrapper">

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Permohonan Data</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo site_url().'subbid'?>"><u><font color="blue">Home</font></u></a>
                </li>
                <li class="active">
                    <strong>Permohonan</strong>
                </li>
            </ol>
             <small><i>(Menu untuk melihat data permohonan pegawai)</i></small>
        </div>
        <div class="col-lg-2">

        </div>
    </div>


<div class="wrapper wrapper-content">
    <?php if($user_group == 7){ ?>

    <!-- START WELLCOME -->
        <div class="row">
            <div class="col-md-12">
                <div class="ibox animated fadeInLeft">
                    <div class="ibox-title navy-bg">
                        <h5>Alur Permohonan</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </div>
                    </div>
                    <div class="ibox-content" style="overflow-x: auto;">
                        <div class="row">
                            <div class="col-md-12" id="tracking">
                                <div class="alert alert-info">
                                    Klik tombol Alur Proses di daftar permohonan untuk melihat alur proses permohonan.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" class="form-horizontal">
                                <input type="hidden" id="ref_prm" name="ref_prm" value="1">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Jenis Permohonan</label>
                                    <div class="col-sm-6">
                                        <select class='form-control chosen-jenis' name='jenis_permohonan' id='jenis_permohonan' data-placeholder='Cari Berdasarkan...'>
                                            <option value="" selected>Pilih Jenis Permohonan</option>
                                            <?php foreach($jenis_permohonan->result() as $row): ?>
                                                <option id="<?php echo $row->ID_JENIS_PERMOHONAN ?>" value="<?php echo $row->ID_JENIS_PERMOHONAN ?>"><?php echo $row->KET_JENIS_PERMOHONAN ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Jabatan</label>
                                    <div class="col-sm-6">
                                        <select class='form-control chosen-jenis' name='id_kojabf' id='id_kojabf' data-placeholder='Cari Berdasarkan...'>
                                            <option value="" selected disabled>Pilih Jabatan Fungsional</option>
                                            <?php foreach($kojabf->result() as $row): ?>
                                                <option value="<?php echo $row->KOJAB ?>"><?php echo $row->NAJABL ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                            </form>
                        </div>
                    </div>

                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-12">
                            <h4>Permohonan Jabatan Fungsional</h4>
                            <table id="t1" class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Permohonan</th>
                                    <th>Jabatan</th>
                                    <th>No Surat Permohonan</th>
                                    <th>Tgl. Surat Permohonan</th>
                                    <th>No Surat</th>
                                    <th>Tgl. Surat</th>
                                    <th>Opsi</th>
                                    <th>SK</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <td id="t1_proses" colspan="10" align="center"></td>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row" id="t2-wrapper">
                        <div class="col-md-12">
                            <h4>Detil Pegawai</h4>
                            <input type="hidden" id="id_trx_hdr" name="id_trx_hdr">
                            <label id="no_surat"></label>
                            <table id="t2" class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NRK</th>
                                    <th>Nama</th>
<!--                                    <th>GOL</th>-->
<!--                                    <th>Jabatan</th>-->
                                    <th>Cek File</th>
                                    <th>Angka Kredit</th>
                                    <!--<th>Persetujuan</th>-->
                                </tr>
                                </thead>
                                <tbody>
                                    <td id="t2_proses" colspan="7" align="center"></td>
                                </tbody>
                            </table>
                            <div id="t2_animate"></div>
                        </div>
                    </div>

                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal SK-->
    <div class="modal inmodal fade" id="modalSK" tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Form SK</h5>
                </div>
                <form class="form-horizontal" id="frm2" name="frm2">
                    <div class="modal-body">
                        <input type="hidden" id="id_tracking" name="id_tracking" value="">
                        <div class="form-group">
                            <label for="no_perbal" class="col-sm-4 control-label">Nomor SK</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="no_sk" name="no_sk">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_perbal" class="col-sm-4 control-label">Tgl. SK</label>
                            <div class="col-sm-5">
                                <div id="data_1">
                                    <div class="input-group date">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        <input type="text" class="form-control pull-right" id="tgl_surat" name="tgl_surat" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group hidden">
                            <label for="no_perbal" class="col-sm-4 control-label">Angka Kredit</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="kredit" name="kredit" min="1">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--My Modal-->
    <div class="modal" id="modalPesan" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" id="tracking">
            <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <p class="m-b-xs"><strong>Pesan</strong></p>
                </div>
                <div class="modal-body" id="pesan">
                        <!-- <div class="timeline-item">
                            <div class="row">
                                <div class="col-xs-3 date">
                                    <i class="fa fa-briefcase"></i>
                                </div>
                                <div class="col-xs-7 content no-top-border">
                                    <p class="m-b-xs"><strong>Meeting</strong></p>

                                    <p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products.</p>

                                </div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="row">
                                <div class="col-xs-3 date">
                                    <i class="fa fa-file-text"></i>
                                </div>
                                <div class="col-xs-7 content">
                                    <p class="m-b-xs"><strong>Send documents to Mike</strong></p>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="row">
                                <div class="col-xs-3 date">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="col-xs-7 content">
                                    <p class="m-b-xs"><strong>Phone with Jeronimo</strong></p>
                                    <p>
                                        Lorem Ipsum has been the industry's standard dummy text ever since.
                                    </p>
                                </div>
                            </div>
                        </div> -->
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!--End My Modal-->


    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Detail Pegawai</h4>
          </div>
          <div class="modal-body">
            <div class="clearfix">
            <form class="form-horizontal" id="defaultForm" method="post">
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <label for="nrk_pegawai">NRK Pegawai</label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" type="text" name="nrk_pegawai" id="nrk_pegawai" disabled="true">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <label for="nama_pegawai">Nama Pegawai</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="nama_pegawai" id="nama_pegawai" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-12" id="table_persyaratan">
                <table id="tbl-grid2" class="table table-striped table-bordered table-hover">
                     <thead>
                        <tr>
                            <!-- <th width="10px">No</th> -->
                            <th>No</th>
                            <th>Syarat</th>
                            <th>Keterangan</th>
                            <th>Lihat File</th>
                            <!-- <th>Verifikasi</th> -->
                        </tr>
                     </thead>
                     <tbody id="list_syarat">
                          
                     </tbody>
                </table>
            </div>
            </form>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-primary" id="btn-simpan">Simpan</button> -->
          </div>
        </div>

      </div>
    </div>

    <div id="ak_modal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Form Angka Kredit</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" id="ak_form" name="ak_form">
                <input type="hidden" name="id_trx_ak" id="id_trx_ak">
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <label for="nrk_pegawai_ak">NRK Pegawai</label>
                        </div>
                        <div class="col-md-3">
                            <input class="form-control" type="text" name="nrk_pegawai_ak" id="nrk_pegawai_ak" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <label for="nama_pegawai_ak">Nama Pegawai</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="nama_pegawai_ak" id="nama_pegawai_ak" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <label for="angka_kredit_ak">Angka Kredit</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" type="number" name="angka_kredit_ak" id="angka_kredit_ak">
                        </div>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
            <input type="submit" class="btn btn-primary" value="Simpan">
          </div>
          </form>
        </div>

      </div>
    </div>


    
<?php } ?>

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

        <!-- Sweet alert -->
        <script src="<?php echo base_url(); ?>assets/sweetalert2/sweetalert2.min.js"></script>

        <!-- Input Mask-->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/jasny/jasny-bootstrap.min.js"></script>
    <!-- Horizontal Timeline-->
    <script src="<?php echo base_url(); ?>assets/horizontal-timeline/js/main.js"></script>

        <script type="text/javascript">
        $(document).ready(function(){
            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: true,
                calendarWeeks: true,
                autoclose: true,
                format: "dd-mm-yyyy",
                startDate : new Date()
            });

            $('#data_2 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: true,
                calendarWeeks: true,
                autoclose: true,
                format: "dd-mm-yyyy",
                startDate : new Date()
            });

            var spinner = '<div class="sk-spinner sk-spinner-wave"><div class="sk-rect1"></div><div class="sk-rect2"></div><div class="sk-rect3"></div><div class="sk-rect4"></div><div class="sk-rect5"></div></div>';
//            $('#t2').hide();
            m=1;

            var dtbl= $('#t1').DataTable({
                destroy: true,
                responsive: false,
                "bSort": false,
                "dom": 'B<"top"f<"#nmdet1">>rt<"bottom"ip><"clear">',
                "scrollX": true,
                "serverSide": true,
                "ajax": {
                    url: '<?php echo site_url("subbid/get_data_permohonan2"); ?>/',
                    type: "post",
                    data: {
                        id_permohonan : m,
                        id_jenis_permohonan : $('#jenis_permohonan').val(),
                        id_kojabf : $('#id_kojabf').val()
                    },
                    beforeSend: function() {
                        $("#t1_proses").html(spinner);
                    },
                    complete: function()
                    {
                        $("#t1_proses").html('');
                    }
                },
                "language": {
                    "processing": "Sedang proses",
                    "lengthMenu": "_MENU_ baris per halaman",
                    "search": "Cari",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Tampil _START_ to _END_ dari _TOTAL_",
                    "infoEmpty": "",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "previous": "Sebelumnya",
                        "next": "Selanjutnya",
                    }
                }

            });
            $('#t1_filter').css("display","none");//hide filtering

            var t2= $('#t2').DataTable({
//                destroy: true,
                responsive: false,
                "bSort": false,
                "dom": 'B<"top"f<"#nmdet1">>rt<"bottom"ip><"clear">',
                "scrollX": true,
                "serverSide": true,
                "ajax": {
                    url: '<?php echo site_url("subbid/getDataTrxDtl"); ?>',
                    type: "post",
                    data: function ( d ) {
                        d.id_trx_hdr = $('#id_trx_hdr').val();
                    },
                    beforeSend: function() {
                        $("#t2_proses").html(spinner);
                    },
                    complete: function()
                    {
                        $("#t2_proses").html('');
                    }
                },
                "language": {
                    "processing": "Sedang proses",
                    "lengthMenu": "_MENU_ baris per halaman",
                    "search": "Cari",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Tampil _START_ to _END_ dari _TOTAL_",
                    "infoEmpty": "",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "previous": "Sebelumnya",
                        "next": "Selanjutnya",
                    }
                }

            });
            $('#t2_filter').css("display","none");//hide filtering

            $('#table_persyaratan').hide();
            $('#defaultForm').hide();
            $('#btn_forward').prop('disabled',true);
            // getdatapermohonan();

            $('#jenis_permohonan').change(function(e){
                e.preventDefault();
                getdatapermohonan();
            });

            $('#id_kojabf').change(function(e){
                e.preventDefault();
                getdatapermohonan();
            });


            $("#t1").on('click','#table_nrk, #table_no_tu, #table_tgl_tu',function(e){
            // $('#t1').click(function(e)){
                e.preventDefault();
               // tes();
            });

            $('#btn_simpan').click(function(e){
                e.preventDefault();
            })

            $('#btn_valid').click(function(e){
                e.preventDefault();
                alert('Are you fckin sure mate!?');
                // $('#t1').find('tr').each (function() {
                    // insert_data(id_trx_skpd_post);
                    // console.log($('#id_trx_skpd').text());
                    var id_trx_tu_post = $(this).closest('tr').children('td span #id_trx_tu').text();
                    //console.log(id_trx_tu_post);
                    // insert_data(id_trx_skpd_post);
                // });
            })

            /*$('#btn_forward').click(function(e){
                e.preventDefault();
                $('#t1').find('td:last').after('<td style="display:none" id="test">Test</td>');
                var jns_prm = $('#jenis_permohonan').val();
                var no_surat_tu = $('#no_surat_tu').val();
                // console.log(jns_prm + ' ' + no_surat_tu);
                console.log($('#test').text());
                $('#t1').find('tr').each (function() {
                    insert_data(id_trx_skpd_post);
                    // console.log($('#id_trx_skpd').text());
                    var id_trx_skpd_post = $('#id_trx_skpd').text();
                    // insert_data(id_trx_skpd_post);
                });
            })*/
            $('#tgl_surat').change(function(){
                var no_surat_post = $('#no_surat').val();
                var id_trx_skpd_post = [];
                $('input[name^=id_trx_skpd_post]').each(function(){
                    id_trx_skpd_post.push($(this).val());
                });
                // console.log(id_trx_skpd_post);
                if(!$(this).val() || !no_surat_post/*|| (id_trx_skpd_post.length == 0)*/){
                    $('#btn_forward').prop('disabled',true);
                }else{
                    $('#btn_forward').prop('disabled',false);
                }
            })

            $('#no_surat').on('keyup', function(){
            // $('#no_surat_tu').blur(function(){
                var tgl_surat_post = $('#tgl_surat').val();
                // console.log($('#tgl_surat').val());
                var id_trx_skpd_post = [];
                $('input[name^=id_trx_skpd_post]').each(function(){
                    id_trx_skpd_post.push($(this).val());
                });
                // console.log(id_trx_skpd_post);
                if(!$(this).val() || !tgl_surat_post/*|| (id_trx_skpd_post.length == 0)*/){
                    $('#btn_forward').prop('disabled',true);
                }else{
                    $('#btn_forward').prop('disabled',false);
                }
            })

            $('#btn_forward').click(function(e){
                e.preventDefault();
                var sel = $('input[type=checkbox]:checked').map(function(_, el) {
                    return $(el).val();
                }).get();
                
                 $('#t1').find('td:last').after('<td style="display:none" id="test">Test</td>');
                // var jns_prm = $('#jenis_permohonan').val();
                var no_surat= $('#no_surat').val();
                var tgl_surat = $('#tgl_surat').val();
                if(no_surat!="" && tgl_surat!="")
                {
                    window.open("http://simpegdev.jakarta.go.id/subbid/", "_self");
                    insert_data();
                }
                else
                {
                    alert("No Surat dan Tanggal Surat harus diisi");
                }
                //redir();
            })

            //Validation
            $("#frm1").bootstrapValidator({
                live: 'disabled',
                excluded : 'disabled',
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    no_perbal: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    tgl_perbal: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            },
                            date: {
                                format: 'DD-MM-YYYY',
                                message: 'Tanggal tidak valid'
                            }
                        }
                    },
                    dikerjakan: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    diperiksa: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    diedarkan: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    disetujui: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    hal: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    pemaraf: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    tembusan: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    ditetapkan: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    diserahkan: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                }
            });
            $("#frm2").bootstrapValidator({
                live: 'disabled',
                excluded : 'disabled',
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    no_sk: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    tgl_sk: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            },
                            date: {
                                format: 'DD-MM-YYYY',
                                message: 'Tanggal tidak valid'
                            }
                        }
                    },
                    kredit: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    }
                }
            });
        });

        $("#frm1").ajaxForm({
            url: "<?php echo site_url('subbid/simpanPerbal')?>",
            type: "post",
            dataType: "json",
            beforeSerialize: function($form, options) {
                //alert(1);
                  //return false;
            },
            success: function (data, status) {
                if (data.success) {
                    $("#frm1").resetForm();
                    $("#frm1").data('bootstrapValidator').resetForm();

                    $("#modalPerbal").modal('hide');
                    swal("Kerja Bagus!", data.msg, "success");
                    var t1 = $('#t1').DataTable();
                    t1.ajax.reload();
                } else {
                    if(!data.stay){
                        sweetAlert("Oops...", data.msg, "error");
                    }else{
                        return false;
                    }
                }
            }
        });

        $("#frm2").ajaxForm({
            url: "<?php echo site_url('subbid/simpanSK')?>",
            type: "post",
            dataType: "json",
            success: function (data, status) {
                if (data.success) {
                    $("#frm2").resetForm();

                    $("#modalSK").modal('hide');
                    swal("Kerja Bagus!", data.msg, "success");
                    var t1 = $('#t1').DataTable();
                    t1.ajax.reload();
                } else {
                    sweetAlert("Oops...", data.msg, "error");
                }
            }
        });

        $("#ak_form").ajaxForm({
            url: "<?php echo site_url('subbid/simpanAngkaKredit')?>",
            type: "post",
            dataType: "json",
            success: function (data, status) {
                if(data.msg == "Sukses"){
                    $(this).resetForm();
                    $("#ak_modal").modal('hide');
                    swal("Kerja Bagus!", "Angka Kredit Berhasil Di Simpan", "success");
                    var t2 = $('#t2').DataTable();
                    t2.ajax.reload();
                }else{
                    swal("Gagal!", "Terjadi kesalahan saat mensimpan", "error");
                }
            }
        });

        $('.closebtn').click(function(){
            $('#myNav').css({'height':'0%'});
            // $('.navbar-default, nav').css('z-index','1');
        })

        function cetakPerbal(id_trx_hdr, jenperm){
            $.post('<?= site_url('subbid/count_pegawai') ?>', {id_trx_hdr: id_trx_hdr}, function(data){
                if(data != 1){
                    $('#cetak_lampiran_sk').removeClass('hidden');
                }
            })

            $('#myNav').css({'height':'100%'});
            var cetakCoverPerbalURL = '<?= site_url('subbid/cetakPerbal/cover') ?>/' + id_trx_hdr;
            if(jenperm != 0){
                var cetakIsiPerbalURL = '<?= site_url('subbid/cetakPerbal/isi') ?>/' + id_trx_hdr + '/9/' + jenperm;    
            }else{
                var cetakIsiPerbalURL = '<?= site_url('subbid/cetakPerbal/isi') ?>/' + id_trx_hdr + '/9';
            }
            var cetakSKURL = '<?= site_url('subbid/cetakSK') ?>/' + id_trx_hdr;
            $('a#cetak_cover_perbal').attr({'href': cetakCoverPerbalURL, 'target': '_blank'});
            $('a#cetak_isi_perbal').attr({'href': cetakIsiPerbalURL, 'target': '_blank'});
            $('a#cetak_lampiran_sk').attr({'href': cetakSKURL, 'target': '_blank'});

            // var jenis_permohonan = $('#jenperm_' + jenperm).text();
            // console.log(jenis_permohonan.replace(/ /g,''));//return false;
            // window.open("<?= site_url('subbid/cetakPerbal/cover') ?>/" + id_trx_hdr);
            // window.open("<?php echo site_url('subbid') ?>/" + jenis_permohonan, '_blank');
            //window.open("<?php echo site_url('subbid/cetakPerbalAngkatInpassing')?>/"+id_trx_hdr,'_blank');
        }

        function angka_kredit(id_angka_kredit, nrk, nama, id_trx){
            $('#nrk_pegawai_ak').val(nrk);
            $('#nama_pegawai_ak').val(nama);
            $('#id_trx_ak').val(id_trx);
            var ak = function(){
                $.post('<?= site_url('subbid/getAngkaKredit') ?>', {id_trx: id_trx}, function(data){
                    var angka_kredit = data;
                    $('#angka_kredit_ak').val(data);
                    // $.post('<?= site_url('subbid/simpanAngkaKredit') ?>', {id_trx: id_trx, angka_kredit: angka_kredit});
                })
            }
            ak();
        }

        function cetakSK(id_trx_hdr)
        {
            window.open('<?= site_url('subbid/cetakSK') ?>/' + id_trx_hdr, '_blank');
        }

        function redir()
        {
            window.location.href="<?php echo site_url().'subbid/permohonan';?>";
        }
        function tes_forward(test){
            console.log(test);
            $('#btn_forward').click(function(e){
                e.preventDefault();
                $('#t1').find('td:last').after('<td style="display:none" id="test">Test</td>');
                var jns_prm = $('#jenis_permohonan').val();
                var no_surat_tu = $('#no_surat_tu').val();

            })
        }

        function valid_yes(id_trx_tu_post){
            $("#t1").on('click','#valid_yes',function(e){
                e.preventDefault();
                $(this).closest("tr").children("td:eq(6)").text("Valid");
                $('#btn_forward').prop('disabled',false);
            });
        }

        function valid_no(id_trx_tu_post){
            $("#t1").on('click','#valid_no',function(e){
                e.preventDefault();
                update();
                $(this).closest("tr").remove();
            });
        }

        function check_box(){
            $('#valid').change(function(){
                if($(this).is(":checked")){
                    alert('This is checked');
                }
            });
        }

        function verifikasi_file(){
            var nrk_post = $('#nrk_post').val();
            console.log(nrk_post);
            // var regtest = new RegExp('error');
            // $.ajax({
            //     url: '<?php echo base_url("index.php/skpdpermohonan/verifikasi")?>/',
            //     type: 'post',
            //     data: {
            //         nrk: nrk_post
            //     },
            //     dataType: 'json',
            //     success: function(data){
            //         // console.log(data);
            //         if(regtest.test(data)){
            //             $('#btn_terima').prop('disabled', true);
            //             $('#btn_tolak').prop('disabled', false);
            //             // console.log('yey');
            //         }else{
            //             $('#btn_terima').prop('disabled', false);
            //             $('#btn_tolak').prop('disabled', true);
            //             // console.log('dang it');
            //         }
            //     }    
            // })
        }

        function insert_data(){
            var refprm = $('#ref_prm').val();
            var jnsprm = $('#jenis_permohonan').val();
            var no_surat_post = $('#no_surat').val();
            var tgl_surat_post = $('#tgl_surat').val();
            var id_trx_tu_post = [];
            $('input[name^=id_trx_tu_post]').each(function(){
                id_trx_tu_post.push($(this).val());
            });
            //console.log(id_trx_tu_post);
            $.ajax({
                url: '<?php echo base_url("subbid/insert")?>/',
                type: 'post',
                data: {
                    ref_permohonan: refprm, jns_permohonan:jnsprm,id_trx_tu: id_trx_tu_post, no_surat_tu: no_surat_post, tgl_surat: tgl_surat_post
                },
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    window.open("http://simpegdev.jakarta.go.id/subbid/", "_self");
                    // $('#nrk_post').val(data.nrk);
                    // $('#nama_pegawai').val(data.nama);
                    // var jns_prm = $('#jenis_permohonan').val();
                    // persyaratan(data.nrk, jns_prm, data.id_trx);
                }
            })
        }

        function update()
        {
            var id_trx_tu_post = [];
            $('input[name^=id_trx_tu_post]').each(function(){
                id_trx_tu_post.push($(this).val());
            });
            
            $.ajax({
                url: '<?php echo base_url("subbid/update")?>/',
                type: 'post',
                data: {
                    id_trx_tu: id_trx_tu_post
                },
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    
                }
            })
        }

        function get_detail_pegawai(nrk){
            // console.log('Hello from pegawai');
            $.ajax({
                url: '<?php echo site_url("subbid/get_detail_pegawai")?>/',
                type: 'post',
                data: {
                    nrk: nrk
                },
                dataType: 'json',
                success: function(data){
                    // console.log(data.nama_kecamatan + ' ' + data.nama_wilayah + ' ' + data.nama_kelurahan);
                    //var id_trx = $('#id_trx').val(data.id_trx);
                    $('#nrk_post').val(data.nrk);
                    $('#nama_pegawai').val(data.nama);

                    var ref_prm = $('#ref_prm').val();
                    var jns_prm = $('#jenis_permohonan').val();
                    persyaratan(data.nrk, ref_prm, jns_prm, data.id_trx_tu);
                }
            })
        }

        function persyaratan(id_trx){
            $.ajax({
                url: '<?php echo base_url("subbid/get_persyaratan"); ?>/',
                type: "post",
                data: {
                    id_trx: id_trx
                },
                dataType: 'JSON',
                success: function(data) {
                    // console.log(JSON.stringify(data.dataTable));
                    $("#list_syarat").html(data.dataTable);
                }
            });
        }

        function getdatapermohonan(){
            var spinner = '<div class="sk-spinner sk-spinner-wave"><div class="sk-rect1"></div><div class="sk-rect2"></div><div class="sk-rect3"></div><div class="sk-rect4"></div><div class="sk-rect5"></div></div>';
            //var jeniss = $('#jenis').val();
            //var no_surat = $('#no_surat').val();
            //var tgl_surat = $('#tgl_surat').val();
            //var nrk = $('#nrk').val();
            var m = 1;
            var jns_prm = $('#jenis_permohonan').val();
            var id_kojabf = $('#id_kojabf').val();

            var dtbl= $('#t1').DataTable({
                destroy: true,
                responsive: false,
                "bSort": false,
                "dom": 'B<"top"f<"#nmdet1">>rt<"bottom"ip><"clear">',
                "scrollX": true,
                "serverSide": true,
                "ajax": {
                    url: '<?php echo site_url("subbid/get_data_permohonan2"); ?>/',
                    type: "post",
                     data: {
                        id_permohonan : m,
                         id_jenis_permohonan : jns_prm,
                         id_kojabf : id_kojabf
                     },
                    beforeSend: function() {                        
                        $("#t1_proses").html(spinner);
                    },
                    complete: function()
                    {
                         $("#t1_proses").html('');
                    }
                },
                "language": {
                "processing": "Sedang proses",
                    "lengthMenu": "_MENU_ baris per halaman",
                    "search": "Cari",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Tampil _START_ to _END_ dari _TOTAL_",
                    "infoEmpty": "",
                    "paginate": {
                    "first": "Pertama",
                        "last": "Terakhir",
                        "previous": "Sebelumnya",
                        "next": "Selanjutnya",
                }
            }
                    
            });
             $('#t1_filter').css("display","none");//hide filtering
            // if(jenis != null || no_surat != null || tgl_surat != null || nrk != null){
                /*$.ajax({
                    url: '<?php //echo base_url("index.php/skpdpermohonan/get_data_permohonan"); ?>/',
                    type: "post",
                    data: {
                        jenis: jeniss, no_surat: no_surat, tgl_surat: tgl_surat, nrk: nrk,
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        console.log(JSON.stringify(data));                        
                    },
                    // error: function(xhr) {
                    //     console.log(JSON.stringify(xhr));
                    //     // $('.msg').html('');
                    //     // $('.err').html("<small>Terjadi kesalahan</small>");
                    // },
                    // complete: function() {
                    //     console.log('Done');
                    // }
                })*/
            // }
        }

        function tes(nrk,no,tgl)
        {
                $('#nrk_pegawai').val(nrk)
                $('#no_tu').val(no);
                
                get_detail_pegawai(nrk);
                // $('#defaultForm').show();
                $('#table_persyaratan').show();
        }

        function cekFile(id_trx_detail,nrk,nama,id_trx)
        {
            $('#nrk_pegawai').val(nrk);
            $('#nama_pegawai').val(nama);
            persyaratan(id_trx);
//            $('#no_tu').val(no);

//            get_detail_pegawai(nrk);
             $('#defaultForm').show();
            $('#table_persyaratan').show();
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

        function setT2(id_trx_hdr,no_surat){
            $('#t2-wrapper').hide();
            $("#id_trx_hdr").val(id_trx_hdr);

            $("#no_surat").text(' Nomor Surat: '+no_surat);
            $('#t2-wrapper').show();
            var t2 = $('#t2').DataTable();
            t2.ajax.reload();
            $('html, body').animate({
                scrollTop: $("#t2_animate").offset().top
            }, 'slow');
        }

        function tolakHdr(id_trx_hdr,id_tracking){
            var err = swal("Maaf!", "Fungsi ini di disable!", "error")
            return false;
            swal({
                title: "Anda Yakin!",
                text: "Alasan ditolak:",
                showCancelButton: true,
                confirmButtonColor: "#00e600",
                closeOnConfirm: false,
                animation: "slide-from-top",
                input: "textarea",
                inputPlaceholder: "Penolakan tidak bisa dilanjutkan jika field ini masih kosong"
            }).then(function(result) {
                if (result) {
                    $.post("<?php echo site_url('subbid/tolakHdr')?>",{
                        id_trx_hdr: id_trx_hdr,
                        id_tracking: id_tracking,
                        keterangan: result,
                        id_detil_sop: 9,
                        urutan: 9
                    }, function(rs){
                        if (rs.success){
                            swal("Bagus!", rs.msg, "success");
                            var t1 = $('#t1').DataTable();
                            t1.ajax.reload();
                            var t2 = $('#t2').DataTable();
                            t2.ajax.reload();
                        } else {
                            swal("Oops...", rs.msg, "error");
                        }
                    },"json");
                }

            });
            $(".swal2-confirm").prop('disabled',true);
            $(".swal2-textarea").attr('onKeyUp','showDialog()');

        }

        function showDialog(){
            //alert("A key was released");
            var count_ta = $(".swal2-textarea").val().length;
            if(count_ta>0){
                $(".swal2-confirm").prop('disabled',false);
            } else {
                $(".swal2-confirm").prop('disabled',true);
            }
        }

        function tolakDtl(id_trx){
            var cek = function(){
                if($('#t2 td').length == 5){
                    var err = swal("Error!", "Tidak dapat menolak pegawai!", "error")
                    return false;
                }else{
                    good_to_go()
                }
            }

            var good_to_go = function(){
                    swal({
                        title: "Anda Yakin!",
                        text: "Alasan ditolak:",
                        showCancelButton: true,
                        confirmButtonColor: "#00e600",
                        closeOnConfirm: false,
                        animation: "slide-from-top",
                        input: "textarea",
                        inputPlaceholder: "Penolakan tidak bisa dilanjutkan jika field ini masih kosong"
                    }).then(function(result) {
                        if (result) {
                            $.post("<?php echo site_url('subbid/tolakDtl')?>",{
                                id_trx: id_trx,
                                keterangan: result,
                                id_detil_sop: 9,
                                urutan: 9
                            }, function(rs){
                                if (rs.success){
                                    swal("Bagus!", rs.msg, "success");
                                    var t2 = $('#t2').DataTable();
                                    t2.ajax.reload();
                                } else {
                                    swal("Oops...", rs.msg, "error");
                                }
                            },"json");
                        }

                    });
                    $(".swal2-confirm").prop('disabled',true);
                    $(".swal2-textarea").attr('onKeyUp','showDialog()');
                }
            
            // console.log(cek());return false;

            cek();
        }

        function formSK(id_tracking,no_sk,tgl_sk,kredit){
            $("#id_tracking").val(id_tracking);
           // alert(no_sk);
            $("#modalSK").modal('show');
            $("#no_sk").val(no_sk);
            $('#tgl_surat').val(tgl_sk);
            $('#kredit').val(kredit);
        }

        function show_pesan(id_tracking){
            $.post("<?php echo site_url('subbid/show_notif')?>",{
            id_tracking: id_tracking
            },
            function(data){
                $("#pesan").html(data);

            })
            $("#modalPesan").modal('show');
        }

        function setujuAkhir(id_trx_hdr,id_tracking,id_kojabf){
            $('#t2-wrapper').hide();
            $.post("<?php echo site_url('subbid/setujuAkhir')?>",{
                id_trx_hdr: id_trx_hdr,
                id_tracking: id_tracking,
                id_kojabf: id_kojabf,
                id_detail_sop: 9,
                urutan: 9
            }, function(rs){
                if (rs.success){
                    swal("Kerja Bagus!", rs.msg, "success");
                    var t1 = $('#t1').DataTable();
                    t1.ajax.reload();
                    var t2 = $('#t2').DataTable();
                    t2.ajax.reload();
                } else {
                    swal("Oops...", rs.msg, "error");
                }
            },"json");
        }

        function lihatStatus(id_trx_hdr,no_surat){
            $.post("<?php echo site_url($this->modul)?>/trackingPermohonan",{
                    id_trx_hdr: id_trx_hdr,
                    no_surat:no_surat
                },
                function(data){
                    $("#tracking").html(data);
                    $.getScript("<?php echo base_url(); ?>assets/horizontal-timeline/js/main.js");
                    $('html, body').animate({
                        scrollTop: $("#tracking").offset().top
                    }, 'slow');
                })
        }
        </script>