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
<?php if($user_group == 7){ ?>   
    <div class="col-lg-10">
        <h2>Dashboard</h2>
        <ol class="breadcrumb">
            <li>
                <u><a href="<?php echo site_url().'subbid'?>"><font color="blue">Home</font></a></u>
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
                    <h5>Laporan Permohonan Pegawai Yang Diteruskan</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>                        
                    </div>
                </div> 

                <div class="ibox-content">
    
                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-12" id="tbl_list_pegawai">
                           
                                <table id="tbl_list_dt" class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <!-- <th>id_trx</th> -->
                                            <th>No Surat Permohonan</th>
                                            <th>Tgl Permohonan</th>
                                            <th>Permohonan</th>
                                            <th>Jenis Permohonan</th>
                                            <th>Detail</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="daftar_list_pegawai">
                                    </tbody>
                                </table> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Detil Pegawai</h4>
                            <input type="hidden" id="id_trx_hdr" name="id_trx_hdr">
                            <label id="no_surat"></label>
                            <table id="t2" class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>NRK</th>
                                    <th>Nama</th>
                                    <th>Cek File</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                    <div id="t2_proses"></div>
                                </tbody>
                            </table>
                        </div>
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
                    <h4 class="modal-title">Persyaratan File</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="tbl-grid" class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th width="10px">&nbsp;</th>
                                
                                    <th>Syarat</th>
                                    <th>Keterangan</th>
                                    <th>Lihat File</th>
                                </tr>
                            </thead>
                            <tbody id="list_syarat">
                                           
                            </tbody>
                        </table> 
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
            get_all_pegawai_terima();
            
            });


        $('#data_2 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy"
            //endDate: new Date()
        });

        
            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';
//            $('#t2').hide();

            var t2= $('#t2').DataTable({
                destroy: true,
                responsive: false,
                "bSort": false,
                "dom": 'B<"top"f<"#nmdet1">>rt<"bottom"ip><"clear">',
                "scrollX": true,
                "serverSide": true,
                "ajax": {
                    url: '<?php echo site_url("skpd/getDataTrxDtl"); ?>',
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
                }
                /*,
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
                }*/

            });
            $('#t2_filter').css("display","none");//hide filtering
        
       

        function click_persyaratan(idTrx){

            $('#myModal').modal('show');
            persyaratan(idTrx);
            
        }

        function persyaratan(id_trx){
            
            $.ajax({
                url: '<?php echo base_url("index.php/subbid/get_persyaratan"); ?>/',
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

        function cekFile(id_trx_detail,nrk,nama,id_trx)
        {
            $('#nrk_pegawai').val(nrk);
            $('#nama_pegawai').val(nama);
            persyaratan(id_trx);
//            $('#no_tu').val(no);

//            get_detail_pegawai(nrk);
            // $('#defaultForm').show();
            $('#table_persyaratan').show();
        }
       
        function setT2(id_trx_hdr,no_surat){
            $("#id_trx_hdr").val(id_trx_hdr);

            $("#no_surat").text(' Nomor Surat: '+no_surat);
            $('#t2').show();
            var t2 = $('#t2').DataTable();
            t2.ajax.reload();
            $('html, body').animate({
                scrollTop: $("#t2_proses").offset().top -100
            }, 'slow');
        }

        function get_all_pegawai_terima(){
            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';
            // var spm = 'C180';
        
            var dtbl= $('#tbl_list_dt').DataTable({
               
                "aoColumns": [
                    { "bSortable": false },
                     { "bSortable": false },
                     { "bSortable": false },
                     { "bSortable": false},
                     { "bSortable": false},
                     { "bSortable": false}
                ],
                responsive: false,
                "scrollX": true,
                "serverSide": true,
                "ajax": {
                    url: '<?php echo base_url("index.php/subbid/get_data_table_terima"); ?>/',
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

