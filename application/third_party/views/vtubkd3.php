    <style type="text/css">

        .datepicker, .datepicker-dropdown{
            z-index: 999999999 !important;        
        }

        tr.terima{
            background-color: #27ae60 !important;
            color: #fff;
        }

        tr.tolak{
            text-decoration: line-through;
            background-color: #c0392b !important;
            color: #fff;
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
    <link rel="stylesheet" href="<?php echo base_url()?>assets/horizontal-timeline/css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/horizontal-timeline/css/style.css"> <!-- Resource style -->
 



    <?php if($user_group == 6){ ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Dashboard</h2>
            <ol class="breadcrumb">
                <li>
                    <u><a href="<?php echo site_url().'tubkd'?>"><font color="blue">Home</font></a></u>
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
                 
                <div class="ibox-content">
                    <div class="ibox-title navy-bg">
                        <h5>Daftar Permohonan</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </div>
                    </div>
                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-12">

                            <!-- form: -->
                            <div class="row">
                                <form class="form-horizontal" id="defaultForm" method="post">
                                    <div class="form-group">
                                        <div class="col-md-12" id="tbl_list_permohonan">
                                            <table id="tbl_list_prm" class="table table-striped table-bordered table-hover dataTables-example" width="100%">
                                                 <thead>
                                                    <tr>
                                                        <th width="5%">No</th>
                                                        <th width="10%">No SKPD</th>
                                                        <th width="10%">Tgl SKPD</th>
                                                       
                                                        <th width="15%">Permohonan</th>
                                                        <th width="15%">Jenis Permohonan</th>
                                                        <th width="12%">Lihat</th>
                                                        <th width="10%">Aksi</th>
                                                    </tr>
                                                 </thead>
                                                 <tbody id="daftar_list_prm">
                                                 </tbody>
                                           </table> 
                                        </div>
                                        <div class="col-md-12" id="tbl_list_pegawai">
                                            <h3>Daftar Pegawai</h3>
                                            <table id="tbl_list_dt" class="table table-striped table-bordered table-hover dataTables-example" width="100%">
                                                 <thead>
                                                    <tr>
                                                        <th width="5%">No</th>
                                                        <th width="15%">NRK</th>
                                                        <th width="40%">Nama</th>
                                                        <th width="25%">Opsi</th>
                                                    </tr>
                                                 </thead>
                                                 <tbody id="daftar_list_pegawai">
                                                 </tbody>
                                           </table> 
                                        </div>
         
                                    </div>
                                    
                                </form>
                            </div> <!--end div row -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
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
                        <label for="nrk_pegawai">NRK</label>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="nrk_pegawai_modal" id="nrk_pegawai_modal" disabled="true">
                    </div>
                </div>
                <div class="col-md-12">    
                    <div class="col-md-3">
                        <label for="nama_pegawai">Nama </label>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="nama_pegawai_modal" id="nama_pegawai_modal" disabled="true">
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

    <!-- modal disposisi -->
    <div class="modal inmodal fade" id="modalDisposisi" tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="form-horizontal" id="frm1" name="frm1">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Form Tanda Terima</h4>
                    <div class="hr-line-dashed"></div>

                        <input type="hidden" id="id_trx_hdrp" name="id_trx_hdrp" value="">
                        <div class="form-group">
                            <label for="no_terima" class="col-sm-4 control-label">Nomor Tanda Terima</label>
                            <div class="input-group col-sm-6">
                                <input type="text" name="no_terima" class="form-control" id="no_terima" placeholder="" maxlength="50">
                            </div>
                        </div>

                        <div class="form-group" id="data_2">
                            <label class="col-sm-4 control-label">Tanggal Tanda Terima</label>
                            <div class="input-group col-sm-6 date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgl_terima"  name="tgl_terima" placeholder="Tanggal Tanda Terima" class="form-control" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="no_bh" class="col-sm-4 control-label">Nomor Biro Hukum</label>
                            <div class="input-group col-sm-6">
                                <input type="text" name="no_bh" class="form-control" id="no_bh" placeholder="" maxlength="50">
                            </div>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" value="Kirim" onclick="confirm()">Kirim</button>
                </div>
                </form>
            </div>
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
    <!-- Horizontal Timeline-->
    <script src="<?php echo base_url(); ?>assets/horizontal-timeline/js/main.js"></script>

        <script type="text/javascript">

        $(document).ready(function(){
            get_all();
            $('#tbl_list_pegawai').hide();
            $('#table_persyaratan').hide();
            $('#form_tu_bkd').hide();
            

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
                    no_dispo: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    no_bh: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    
                }
            });


             /*$("#frm1").ajaxForm({
            url: "<?php //echo site_url('tubkd/simpan_data')?>",
            type: "post",
            dataType: "json",
            beforeSerialize: function($form, options) {
                 confirmKirimData();
            },
            success: function (data, status) {
                if (data.success) {
                    $("#frm1").resetForm();
                    $("#frm1").data('bootstrapValidator').resetForm();

                    $("#modalDisposisi").modal('hide');
                    swal("Data berhasil diteruskan!", data.msg, "success");
                    var t1 = $('#tbl_list_prm').DataTable();
                    t1.ajax.reload();
                } else {
                    sweetAlert("Oops...", data.msg, "error");
                }
            }
        });*/

























            $('#detail_form').hide();
            //$('#defaultForm').hide();

            $('#btn_teruskan').prop('disabled',true);
            
            $('#no_disposisi').on('keyup', function(){
            
                if(!$(this).val() /*|| (id_trx_skpd_post.length == 0)*/){
                    $('#btn_teruskan').prop('disabled',true);
                }else{
                    $('#btn_teruskan').prop('disabled',false);
                }
            })


            $('#btn_simpan').click(function(e){
                e.preventDefault();
            })

            $('#btn_valid').click(function(e){
                e.preventDefault();
                alert('Are you fckin sure mate!?');
                // $('#tbl-grid3').find('tr').each (function() {
                    // insert_data(id_trx_skpd_post);
                    // console.log($('#id_trx_skpd').text());
                    var id_trx_skpd_post = $(this).closest('tr').children('td span #id_trx_skpd').text();
                    // insert_data(id_trx_skpd_post);
                // });
            })

            $('#btn_teruskan').click(function(e){
                e.preventDefault();
                simpan_data();
            });

           
            $('#btn_forward').click(function(e){
                e.preventDefault();
                var sel = $('input[type=checkbox]:checked').map(function(_, el) {
                    return $(el).val();
                }).get();
               
                var no_disposisi_tu = $('#no_disposisi').val();
                
                if(no_disposisi!="")
                {
                    
                    // window.location.href = 'http://simpegdev.jakarta.go.id/tubkd/';
                    insert_data();
                }
                else
                {
                    alert('No Disposisi Harus Diisi');
                }
                //
            })
        });











       
        function cekFile(id_trx_detail,nrk,nama,id_trx)
        {

            $('#nrk_pegawai_modal').val(nrk);
            $('#nama_pegawai_modal').val(nama);
            persyaratan2(id_trx);

            $('#table_persyaratan').show();
            return false;
        }

        function persyaratan2(id_trx){
            
            $.ajax({
                url: '<?php echo base_url("index.php/tubkd/lihat_persyaratan"); ?>/',
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
        
        function get_all(){
            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';
            //var m = 1;

            var dtbl= $('#tbl_list_prm').DataTable({
                "aoColumns": [
                    { "bSortable": false },
                    { "bSortable": false },
                    { "bSortable": false },
                    { "bSortable": false },
                    { "bSortable": false },
                    { "bSortable": false },
                    { "bSortable": false },
                ],
//                destroy: true,
                responsive: false,
                "scrollX": true,
                "serverSide": true,
                "ajax": {
                    url: '<?php echo base_url("index.php/tubkd/get_data_table"); ?>/6',
                    type: "post",
                     data: {
                    
                     },
                    beforeSend: function() {                        
                        $("#daftar_list_prm").html(spinner);
                    }
                      
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

       

        function detail_list_prm(id_trx_hdr){
            $('#id_trx_hdr').val(id_trx_hdr);
            get_all_pegawai_by_surat(id_trx_hdr);
            $('#tbl_list_pegawai').show();
            $('#form_tu_bkd').show();

            /*var t2 = $('#tbl_list_dt').DataTable();
            t2.ajax.reload();*/
            $('html, body').animate({
                scrollTop: $("#daftar_list_pegawai").offset().top -100
            }, 'slow');
            
        }

        /*function simpan_data(){
            var id_trx_hdr = $('#id_trx_hdr').val();
            var no_disposisi = $('#no_disposisi').val();


            $.ajax({
                url: '<?php //echo base_url("index.php/tubkd/simpan_data") ?>',
                type: 'post',
                data: {
                    no_disposisi: no_disposisi, id_trx_hdr: id_trx_hdr
                },
                dataType: 'json',
                success: function(data){
                    console.log(data);
                },
                complete: function(data)
                {
                    alert('SUKSES !! data berhasil diteruskan');
                     window.location.href = 'http://simpegdev.jakarta.go.id/tubkd/';
                }
            })

            
        }*/

        function NoDisposisi(id_trx_hdrp){
                $("#id_trx_hdrp").val(id_trx_hdrp);
                
                $("#modalDisposisi").modal('show');
            }

        function confirm()
        {
            var a = $('#no_terima').val();
            var b = $('#id_trx_hdrp').val();
            var c = $('#no_bh').val();
            var d = $('#tgl_terima').val();
            if(a.length==0)
            {
                swal({type:"warning",title:"No Terima harus diisi"});
            }
            
            else if(d.length==0)
            {
                 swal({type:"warning",title:"Tgl Terima harus diisi"});                
            }
            else if(c.length==0)
            {
                swal({type:"warning",title:"No Biro Hukum harus diisi"});   
            }
            else
            {
                confirmKirimData(a,c,b,d);
            }
            
        }

        function confirm_revisi()
        {
            var a = $('#ID_TRACKING').val();
            var b = $('#keterangan').val();
            if(a.length==0)
            {
                swal({type:"warning",title:"id tracking tidak ada"});
            }
            
            else if(b.length==0)
            {
                 swal({type:"warning",title:"Keterangan harus diisi"});                
            }
            
            else
            {
                confirmRevisi(a,b);
            }
            
        }

        

        function confirmKirimData(no_terima,no_bh,id_trx_hdrp,tgl_terima){
                /*START SWEETALERT*/                
                    swal({
                        title: "Anda yakin akan mengirim data ini?",                        
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
                            
                            simpanData(no_terima,no_bh,id_trx_hdrp,tgl_terima); 

                        }else
                        {
                            return false;
                        }                         
                    });               
                /*END SWEETALERT*/
            }

            function confirmRevisi(ID_TRACKING,keterangan){
                /*START SWEETALERT*/                
                    swal({
                        title: "Anda yakin akan mengirim perintah revisi?",                        
                        // text: "Data tidak dapat diubah setelah dikirim!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#38ec00",
                        confirmButtonText: "Ya, Kirim!",
                        cancelButtonColor: "#000000",
                        cancelButtonText: "Tidak, Batalkan!",
                        closeOnConfirm: false
                    }, function (isConfirm) {
                        if (isConfirm) {
                            
                            simpanRevisi(ID_TRACKING,keterangan); 

                        }else
                        {
                            return false;
                        }                         
                    });               
                /*END SWEETALERT*/
            }


           function simpanData(no_terima, no_bh, id_trx_hdrp,tgl_terima){
                var result = 0;

                $.ajax({
                    url: "<?php echo site_url('tubkd/simpan_data3')?>",
                    type: "post",
                    data: {no_terima:no_terima, no_bh:no_bh,id_trx_hdrp:id_trx_hdrp,tgl_terima:tgl_terima},
                    dataType: 'json',
                    beforeSend: function() {
                        
                    },
                    success: function(data) {                                                                     
                        /*if(data.response == 'SUKSES'){                    
                            
                        }else{
                            swal("Gagal!", "Data gagal diteruskan.", "error");                            
                        }*/
                        swal("SUKSES!", "Data berhasil dikirim.", "success");    
                            var t1 = $('#tbl_list_prm').DataTable();
                            t1.ajax.reload();
                            /*var t2 = $('#tbl_list_dt').DataTable();
                            t2.ajax.reload();*/
                            $("#tbl_list_pegawai").hide();
                            $("#modalDisposisi").modal('hide');
                            $("#no_terima").val('');
                            $("#tgl_terima").val('');
                            $("#no_bh").val('');
                    },
                    error: function(xhr) {                              
                        swal("Gagal!", "Data gagal diteruskan.", "error");
                    },
                    complete: function() {
                                                
                    }
                });
              return result;
            }

        function simpanRevisi(ID_TRACKING,keterangan){
                var result = 0;

                $.ajax({
                    url: "<?php echo site_url('tubkd/revisi_tubkd3')?>",
                    type: "post",
                    data: {ID_TRACKING:ID_TRACKING, keterangan:keterangan},
                    dataType: 'json',
                    beforeSend: function() {
                        
                    },
                    success: function(data) {                                                                     
                        /*if(data.response == 'SUKSES'){                    
                            
                        }else{
                            swal("Gagal!", "Data gagal diteruskan.", "error");                            
                        }*/
                        swal("SUKSES!", "Perintah revisi berhasil dikirim.", "success");    
                            var t1 = $('#tbl_list_prm').DataTable();
                            t1.ajax.reload();
                            /*var t2 = $('#tbl_list_dt').DataTable();
                            t2.ajax.reload();*/
                            $("#tbl_list_pegawai").hide();
                            $("#modalrevisi").modal('hide');
                            $("#ID_TRACKING").val('');
                            $("#keterangan").val('');
                    },
                    error: function(xhr) {                              
                        swal("Gagal!", "Perintah revisi gagal dikirim.", "error");
                    },
                    complete: function() {
                                                
                    }
                });
              return result;
            }

        function tes_forward(test){
            console.log(test);
            $('#btn_forward').click(function(e){
                e.preventDefault();
                $('#tbl-grid3').find('td:last').after('<td style="display:none" id="test">Test</td>');
                var jns_prm = $('#jenis_permohonan').val();
                var no_surat_tu = $('#no_surat_tu').val();
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

       

        function insert_data(){
            var no_surat_tu_post = $('#no_surat_tu').val();
            var id_trx_skpd_post = [];
            $('input[name^=id_trx_skpd_post]').each(function(){
                id_trx_skpd_post.push($(this).val());
            });
            
            $.ajax({
                url: '<?php echo base_url("tubkd/insert")?>/',
                type: 'post',
                data: {
                    id_trx_skpd: id_trx_skpd_post, no_surat_tu: no_surat_tu_post
                },
                dataType: 'json',
                success: function(data){
                    console.log(data);
                }
            })
        }

        
        function update()
        {
            //var no_surat_tu_post = $('#no_surat_tu').val();
            var id_trx_skpd_post = [];
            $('input[name^=id_trx_skpd_post]').each(function(){
                id_trx_skpd_post.push($(this).val());
            });
            
            
            $.ajax({
                url: '<?php echo base_url("tubkd/update")?>/',
                type: 'post',
                data: {
                    id_trx_skpd: id_trx_skpd_post
                },
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    
                }
            })
        }



       

        
      

        function get_all_pegawai_by_surat(id_trx_hdr){
            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';
           
        
            var dtbl= $('#tbl_list_dt').DataTable({
                "aoColumns": [
                    
                     { "bSortable": true},
                     { "bSortable": true},
                     { "bSortable": true},
                     { "bSortable": false}
                ],
//                destroy:true,
                responsive: false,
                "scrollX": true,
                "serverSide": true,
                "ajax": {
                    url: '<?php echo base_url("index.php/tubkd/getDataTrxDtl"); ?>/',
                    type: "post",
                    data: {
                        id_trx_hdr: id_trx_hdr
                    },
                    beforeSend: function() {                        
                        $("#daftar_list_pegawai").html(spinner);
                    },
                   
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

        function getpgwai(){
            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';

            var dtbl= $('#tbl_list_dt').DataTable({
                "columnDefs": [
                    {
                        "targets": [ 1 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                "aoColumns": [
                    { "bSortable": true },
                    { "bSortable": true },
                    { "bSortable": true },
                    { "bSortable": true},
                    { "bSortable": true},
                    { "bSortable": true},
                    { "bSortable": true},
                    { "bSortable": false}
                ],
//                "destroy":true,
                "paging": false,                
                "serverSide": true,
                "ajax": {
                    url: '<?php echo base_url("index.php/skpd/filter_function"); ?>/',
                    type: "post",
                    data: {
                        filter_pertama: $('#ref_permohonan').val(),
                        filter_kedua: $('#jenis_permohonan').val(),
                        filter_ketiga: $('#gol_pegawai').val()
                    },
                    beforeSend: function() {                        
                        $("#daftar_list_pegawai").html(spinner);
                    },
                    /*complete: function()
                    {
                        $("#daftar_list_pegawai").html('');
                    }*/
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


            /*START CHOSEN*/
            var config = {
                  '.chosen-jenis'           : {no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                                }
                for (var selector in config) {
                  $(selector).chosen(config[selector]);
                }
            /*END CHOSEN*/

        function lihatStatus(id_trx_hdr,no_surat){
            $.post("<?php echo site_url()?>/subbid/trackingPermohonan",{
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

