    <style type="text/css">           

        .panel, .ibox{
          text-decoration: none;
          outline: none;                
          border: none;
          border-radius: 5px;
          box-shadow: 2px 2px 3px 3px #999;  
        }

        .form-group #informasi_list {          
          display: inline-block;          
          cursor: pointer;          
          text-decoration: none;
          outline: none;                
          border: none;
          border-radius: 5px;
          box-shadow: 2px 2px 3px 3px #999;
        }      

        .input-group-addon{
            background-color: #1ab394 !important;
            color: #fff !important;
        }         

    </style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Informasi</h2>
        <ol class="breadcrumb">
            <li>
                <?php if($user_group == 4): ?>
                <a href="<?php echo site_url('report/laporan')?>">Home</a>
                <?php elseif($user_group == 2 || $user_group == 3 || $user_group == 11): ?>
                <a href="<?php echo site_url('pegawai')?>">Home</a>
                <?php endif; ?>
            </li>            
            <li class="active">
                <strong>Informasi</strong>
            </li>
        </ol>
         <small><i>(Menu untuk melakukan pengolahan data informasi)</i></small>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content">

    <div class="row">            
        <div class="col-md-12">
            <!-- START REFERENSI -->
            <div class="ibox float-e-margins animated fadeInRight">
                <div class="ibox-title">
                    <div class="row">
                        <div style="margin-top:5px;margin-left:2px">
                            <div class="col-md-5 form-group">
                                <select name="informasi_list" id="informasi_list" data-placeholder="--- Pilih Jenis ---" class="form-control chosen-select" tabindex="2">
                                    <option value=""></option>
                                    <option value="info">Informasi</option>
                                    <option value="news">Berita</option>
                                </select>       
                                <span class="help-block m-b-none"><u><i>Pilih jenis informasi yang akan ditampilkan.</i></u></span>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="ibox-content">
                    <input type="hidden" id="checkproses" value="1">  
                    <div class="row">
                    	<div class="col-md-5 form-group" id="content_option">
                            
                        </div>
                    </div>                  
                    <div  id="content_informasi" class="">
                        
                    </div>
                </div>
            </div>
            <!-- END REFERENSI -->
        </div>        
    </div>    

</div>

<style type="text/css">
    .modal-lg{
        width: 1024px !important;
    }
</style>

<!-- Start Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div id="widthForm" class="modal-dialog modal-sm" role="document">
    <div class="modal-content animated fadeInUp" id="modal_content">

    </div>
  </div>
</div>
<!-- End Modal -->
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

            $('.dataTables-example').dataTable({
                responsive: true,                
                // "dom": 'T<"clear">lfrtip',
                // "tableTools": {
                //     "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                // }
            });

            $(document).ready(function(){
                $( "#informasi_list" ).change(function(event) {
                    event.preventDefault();

                    $.ajax({
                        url: "informasi/generateInformasi",
                        type: "post",
                        data: {id_informasi:$("#informasi_list").val()},
                        dataType: 'json',
                        beforeSend: function() {
                        	$("#content_option").html('');
                            $('#_content_informasi').removeAttr('class').attr('class', '');
                            var animation = 'fadeOutDown';
                            $('#_content_informasi').addClass('animated');
                            $('#_content_informasi').addClass(animation);
                            // return false;
                            $('#content_informasi').html('<div><img src="<?php echo base_url() ?>assets/inspinia/img/loading_bar.gif"></div>');
                            $('#checkproses').val('0');
                        },
                        success: function(data) {                                                                     
                            if(data.response == 'SUKSES'){
                            	if(data.option != ''){
                            		$("#content_option").html(data.option);
                            		/*START CHOSEN*/
						            var config = {
						              '.chosen-option'           : {no_results_text:'Oops, Data Tidak Ditemukan'}              
						            }
						            for (var selector in config) {
						              $(selector).chosen(config[selector]);
						            }
						            /*END CHOSEN*/
                            	}else{
                            		$("#content_option").html('');
                            	}

                                 $("#content_informasi").html(data.result);
                                 $('#checkproses').val('1');
                            }else{
                                 $("#content_informasi").html('');
                                 $('#checkproses').val('0');
                            }
                        },
                        error: function(xhr) {                              
                            if($('#checkproses').val() == 0){
                                $("#content_informasi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        },
                        complete: function() {
                            $('.dataTables-example').dataTable({
                                // responsive: true,
                                "destroy" : true,
                                "scrollX": true
                            });

                            if($('#checkproses').val() == 0){
                                $("#content_informasi").html("<small class='text-danger'>Gagal Load Data</small>");
                            }
                        }
                    });
                });                

            });                    

            function getForm(form,action,key,key2,key3){
                $.ajax({
                    url: "informasi/generateForm",
                    type: "post",
                    data: {form:form,action:action,key:key,key2:key2,key3:key3},
                    dataType: 'json',
                    beforeSend: function() {
                        
                    },
                    success: function(data) {                                                                     
                        if(data.response == 'SUKSES'){
                            $("#modal_content").html(data.result);
                            $('#myModal').modal('toggle');


                            if(data.widthForm == 'one'){
                                $('#widthForm').removeAttr('class').attr('class', '');                                
                                $('#widthForm').addClass('modal-dialog');
                            }else{
                                $('#widthForm').removeAttr('class').attr('class', '');
                                $('#widthForm').addClass('modal-dialog');
                                $('#widthForm').addClass('modal-lg');                                
                            }
                            $("#action").val(data.action);
                           $("#key").val(key);
                            if(action == 'edit'){
                                $("#key").val(key);
                                //$("#key2").val(key2);
                                //$("#key3").val(key3);    
                            }
                            
                        }else{
                            $("#modal_content").html('');
                        }
                    },
                    error: function(xhr) {                              
                        
                    },
                    complete: function() {
                                                
                    }
                });
            }     

            function reloadTable(){
                $.ajax({
                    url: "informasi/generateInformasi",
                    type: "post",
                    data: {id_informasi:$("#informasi_list").val()},
                    dataType: 'json',
                    beforeSend: function() {
                        $("#content_option").html('');
                        $('#_content_informasi').removeAttr('class').attr('class', '');
                        var animation = 'fadeOutDown';
                        $('#_content_informasi').addClass('animated');
                        $('#_content_informasi').addClass(animation);
                        // return false;
                        $('#content_informasi').html('<div><img src="<?php echo base_url() ?>assets/inspinia/img/loading_bar.gif"></div>');
                        $('#checkproses').val('0');
                    },
                    success: function(data) {                                                                     
                        if(data.response == 'SUKSES'){
                            if(data.option != ''){
                                $("#content_option").html(data.option);
                                /*START CHOSEN*/
                                var config = {
                                  '.chosen-option'           : {no_results_text:'Oops, Data Tidak Ditemukan'}              
                                }
                                for (var selector in config) {
                                  $(selector).chosen(config[selector]);
                                }
                                /*END CHOSEN*/
                            }else{
                                $("#content_option").html('');
                            }

                             $("#content_informasi").html(data.result);
                             $('#checkproses').val('1');
                        }else{
                             $("#content_informasi").html('');
                             $('#checkproses').val('0');
                        }
                    },
                    error: function(xhr) {                              
                        if($('#checkproses').val() == 0){
                            $("#content_informasi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                        }
                    },
                    complete: function() {
                        $('.dataTables-example').dataTable({
                            // responsive: true,
                            "destroy" : true,
                            "scrollX": true
                        });

                        if($('#checkproses').val() == 0){
                            $("#content_informasi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                        }
                    }
                });
            }     


            function jendik(id){
            		$.ajax({
                        url: "informasi/generateInformasi",
                        type: "post",
                        data: {id_informasi:$("#informasi_list").val(),jenis:id},
                        dataType: 'json',
                        beforeSend: function() {
                            $('#_content_informasi').removeAttr('class').attr('class', '');
                            var animation = 'fadeOutDown';
                            $('#_content_informasi').addClass('animated');
                            $('#_content_informasi').addClass(animation);
                            // return false;
                            $('#content_informasi').html('<div><img src="<?php echo base_url() ?>assets/inspinia/img/loading_bar.gif"></div>');
                            $('#checkproses').val('0');
                        },
                        success: function(data) {                                                                     
                            if(data.response == 'SUKSES'){                            
                                 $("#content_informasi").html(data.result);
                                 $('#checkproses').val('1');
                            }else{
                                 $("#content_informasi").html('');
                                 $('#checkproses').val('0');
                            }
                        },
                        error: function(xhr) {                              
                            if($('#checkproses').val() == 0){
                                $("#content_informasi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        },
                        complete: function() {
                            $('.dataTables-example').dataTable({
                                // responsive: true,
                                "destroy" : true,
                                "scrollX": true
                            });

                            if($('#checkproses').val() == 0){
                                $("#content_informasi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        }
                    });
            }

            function kolok(id){
            		$.ajax({
                        url: "informasi/generateInformasi",
                        type: "post",
                        data: {id_informasi:$("#informasi_list").val(),kolok:id},
                        dataType: 'json',
                        beforeSend: function() {
                            $('#_content_informasi').removeAttr('class').attr('class', '');
                            var animation = 'fadeOutDown';
                            $('#_content_informasi').addClass('animated');
                            $('#_content_informasi').addClass(animation);
                            // return false;
                            $('#content_informasi').html('<div><img src="<?php echo base_url() ?>assets/inspinia/img/loading_bar.gif"></div>');
                            $('#checkproses').val('0');
                        },
                        success: function(data) {                                                                     
                            if(data.response == 'SUKSES'){                            
                                 $("#content_informasi").html(data.result);
                                 $('#checkproses').val('1');
                            }else{
                                 $("#content_informasi").html('');
                                 $('#checkproses').val('0');
                            }
                        },
                        error: function(xhr) {                              
                            if($('#checkproses').val() == 0){
                                $("#content_informasi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        },
                        complete: function() {
                            $('.dataTables-example').dataTable({
                                // responsive: true,
                                "destroy" : true,
                                "scrollX": true
                            });

                            if($('#checkproses').val() == 0){
                                $("#content_informasi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        }
                    });
            }

            function wilayah(id){
                    $.ajax({
                        url: "informasi/generateInformasi",
                        type: "post",
                        data: {id_informasi:$("#informasi_list").val(),wilayah:id},
                        dataType: 'json',
                        beforeSend: function() {
                            $('#_content_informasi').removeAttr('class').attr('class', '');
                            var animation = 'fadeOutDown';
                            $('#_content_informasi').addClass('animated');
                            $('#_content_informasi').addClass(animation);
                            // return false;
                            $('#content_informasi').html('<div><img src="<?php echo base_url() ?>assets/inspinia/img/loading_bar.gif"></div>');
                            $('#checkproses').val('0');
                        },
                        success: function(data) {                                                                     
                            if(data.response == 'SUKSES'){                            
                                 $("#content_informasi").html(data.result);
                                 $('#checkproses').val('1');
                            }else{
                                 $("#content_informasi").html('');
                                 $('#checkproses').val('0');
                            }
                        },
                        error: function(xhr) {                              
                            if($('#checkproses').val() == 0){
                                $("#content_informasi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        },
                        complete: function() {
                            $('.dataTables-example').dataTable({
                                // responsive: true,
                                "destroy" : true,
                                "scrollX": true
                            });

                            if($('#checkproses').val() == 0){
                                $("#content_informasi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        }
                    });
            }

            function kecamatan(id){
                    $.ajax({
                        url: "informasi/generateInformasi",
                        type: "post",
                        data: {id_informasi:$("#informasi_list").val(),kecamatan:id},
                        dataType: 'json',
                        beforeSend: function() {
                            $('#_content_informasi').removeAttr('class').attr('class', '');
                            var animation = 'fadeOutDown';
                            $('#_content_informasi').addClass('animated');
                            $('#_content_informasi').addClass(animation);
                            // return false;
                            $('#content_informasi').html('<div><img src="<?php echo base_url() ?>assets/inspinia/img/loading_bar.gif"></div>');
                            $('#checkproses').val('0');
                        },
                        success: function(data) {                                                                     
                            if(data.response == 'SUKSES'){                            
                                 $("#content_informasi").html(data.result);
                                 $('#checkproses').val('1');
                            }else{
                                 $("#content_informasi").html('');
                                 $('#checkproses').val('0');
                            }
                        },
                        error: function(xhr) {                              
                            if($('#checkproses').val() == 0){
                                $("#content_informasi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        },
                        complete: function() {
                            $('.dataTables-example').dataTable({
                                // responsive: true,
                                "destroy" : true,
                                "scrollX": true
                            });

                            if($('#checkproses').val() == 0){
                                $("#content_informasi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        }
                    });
            }

            

            function confirmHapusData(dest,key,key2,key3){
                /*START SWEETALERT*/                
                    swal({
                        title: "Anda yakin hapus data ini?",                        
                        text: "Data tidak akan dapat dikembalikan setelah dihapus!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonColor: "#F8AC59",
                        cancelButtonText: "Tidak, batalkan!",
                        closeOnConfirm: false
                    }, function (isConfirm) {
                        if (isConfirm) {
                            rslt = hapusData(dest,key,key2,key3);
                            if(rslt == 1){                                
                                swal("Hapus!", "Data berhasil dihapus.", "success");    
                                reloadTable();
                            }else{
                                swal("Gagal!", "Data gagal dihapus.", "error");
                            }
                            
                        }                         
                    });               
                /*END SWEETALERT*/
            }

            function hapusData(dest,key,key2,key3){
                var result = 1;

                $.ajax({
                    url: '<?php echo base_url("index.php/informasi/simpanInformasi"); ?>',
                    type: "post",
                    data: {destination:dest, action:'hapus',key:key,key2:key2,key3:key3},
                    dataType: 'json',
                    beforeSend: function() {
                        
                    },
                    success: function(data) {                                                                     
                        if(data.response == 'SUKSES'){                    
                            result = 1;
                        }else{
                            result = 0;
                        }
                    },
                    error: function(xhr) {                              
                        result = 0;
                    },
                    complete: function() {
                                                
                    }
                });

                return result;
            }


            /*START CHOSEN*/
            var config = {
              '.chosen-select'           : {no_results_text:'Oops, Data Tidak Ditemukan'}              
            }
            for (var selector in config) {
              $(selector).chosen(config[selector]);
            }
            /*END CHOSEN*/
        </script>

