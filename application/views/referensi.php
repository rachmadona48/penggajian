    <style type="text/css">           

        .panel, .ibox{
          text-decoration: none;
          outline: none;                
          border: none;
          border-radius: 5px;
          box-shadow: 2px 2px 3px 3px #999;  
        }

        .form-group #referensi_list {          
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
        <h2>Referensi</h2>
        <ol class="breadcrumb">
            <li>
                <?php if($user_group == 4): ?>
                <a href="<?php echo site_url('report/laporan')?>">Home</a>
                <?php elseif($user_group == 2 || $user_group == 3 || $user_group >= 11): ?>
                <a href="<?php echo site_url('pegawai')?>">Home</a>
                <?php endif; ?>
            </li>            
            <li class="active">
                <strong>Referensi</strong>
            </li>
        </ol>
         <small><i>(Menu untuk melakukan pengolahan data referensi)</i></small>
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
                                <select name="referensi_list" id="referensi_list" data-placeholder="--- Pilih Master Referensi ---" class="form-control chosen-select" tabindex="2">
                                    <option value=""></option>
                                    <option value=""></option>
                                    <?php echo $menu_select; ?>                                                              
                                </select>       
                                <span class="help-block m-b-none"><u><i>Pilih jenis referensi yang akan ditampilkan.</i></u></span>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="ibox-content">
                    <input type="hidden" id="checkproses" value="1">  
                    <div class="row" id="cnt" style="display : none">
                    	<div class="col-md-5 form-group" id="content_option" >
                            
                        </div>
                    </div>                  
                    <div  id="content_referensi" class="">

                    </div>

                    <div class="animated fadeInUp" id="kelurahan" style="display : none">
                      <div class="row">
                            <div class="col-lg-12">
                                
                                  <div>
                               <button class="btn btn-primary pull-right" onClick='getForm("ref_kelurahan","tambah");'><i class='fa fa-plus'></i> Tambah Data</button>
                            </div>
                                  <div>
                                  <div class="clearfix"></div>
                                    <div class="table-responsive">
                                    <table id="tbl_groupUser" class='table table-striped table-bordered table-hover pull-left' width='99%'>
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode</th>
                                                <th>Kelurahan</th>
                                                <th>Kecamatan</th>   
                                                <th>Kabupaten/Kota</th> 
                                                <th>Provinsi</th>                                                                             
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="7" align="center">
                                            <div id="loading"></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                  </div>
                                  </div>  
                            
                            </div>
                        </div>
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
<div class="modal" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div id="widthForm" class="modal-dialog modal-lg" role="document">
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
        function reload_kel()
          {
              $('#tbl_groupUser').DataTable().ajax.reload();
          }
        </script>

        <script type="text/javascript">
        var dataTable = null;
        function generateKel(){
            
              dataTable = $('#tbl_groupUser').DataTable( {
                        "aoColumns": [
                                          null,
                                          null,
                                          null,
                                          null,
                                          null,
                                          null,
                                          { "bSortable": false }
                                        ],
                        responsive: true,
                        // "processing": true,
                        "serverSide": true,
                        "destroy" : true,
                        /*"language": {
                                "processing": "<div></div><div></div><div></div><div></div><div></div>"
                            },*/
                        "ajax":{
                            url :"<?php echo site_url('referensi/getKel')?>",
                            // url :"<?php echo site_url('admin/admin/getGroup')?>", // json datasource
                            type: "post",  // method  , by default get
                            beforeSend: function(){
                                $("#loading").html("<div class='sk-spinner sk-spinner-three-bounce'><div class='sk-bounce1'></div><div class='sk-bounce2'></div><div class='sk-bounce3'></div></div>");
                                /*$("#_content_kel").html('');
                                $('#_content_kel').removeAttr('class').attr('class', '');
                                var animation = 'fadeOutDown';
                                $('#_content_kel').addClass('animated');
                                $('#_content_kel').addClass(animation);
                                // return false;
                                $('#_content_kel').html('<div><img src="<?php echo base_url() ?>assets/inspinia/img/loading_bar.gif"></div>');*/

                                /**/

                            },
                            error: function(){  // error handling
                                $(".tbl_groupUser-error").html("");
                                $("#tbl_groupUser").append('<tbody class="employee-grid-error"><tr><th colspan="7">Data Kosong</th></tr></tbody>');
                                
                                
                            },complete:function()
                            {
                                $("#loading").css("display","none");
                            }

                        }
                    } );


                    $('#tbl_groupUser input').unbind();
                    $('#tbl_groupUser input').bind('keyup', function(e) {
                        if(e.keyCode == 13) {
                           oTable.fnFilter(this.value);
                        }
                    });                 
                    
            }


            // $('.dataTables-example').dataTable({
            //     responsive: true,                
            //     // "dom": 'T<"clear">lfrtip',
            //     // "tableTools": {
            //     //     "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
            //     // }
            // });

            $(document).ready(function(){
                $( "#referensi_list" ).change(function(event) {

                    event.preventDefault();

                    // if($( "#referensi_list" ).val() == 'kel'){
                    //     // alert("KEL "+$( "#referensi_list" ).val());
                    //     generateKel();
                    //     $('#kelurahan').show();

                    // }else{

                        // $('#kelurahan').hide();

                        $.ajax({
                            url: "referensi/generateReferensi",
                            type: "post",
                            data: {id_referensi:$("#referensi_list").val()},
                            dataType: 'json',
                            beforeSend: function() {
                                $("#content_option").html('');
                                $('#_content_referensi').removeAttr('class').attr('class', '');
                                var animation = 'fadeOutDown';
                                $('#_content_referensi').addClass('animated');
                                $('#_content_referensi').addClass(animation);
                                // return false;
                                $('#content_referensi').html('<div><img src="<?php echo base_url() ?>assets/inspinia/img/loading_bar.gif"></div>');
                                $('#checkproses').val('0');
                            },
                            success: function(data) {                                                                     
                                if(data.response == 'SUKSES'){
                                    // alert(data.idt);
                                    if(data.idt=='kel'){
                                        $('#kelurahan').show();
                                        // var dataTable = null;
                                        generateKel();
                                        // alert('KKKKKKKKK');
                                        
                                    }else{
                                        $('#kelurahan').hide();
                                        $('#cnt').show();
                                        //console.log(data.option);
                                        if(data.option != ''){
                                            $("#content_option").html(data.option);
                                            //START CHOSEN
                                            var config = {
                                              '.chosen-option'           : {no_results_text:'Oops, Data Tidak Ditemukan'}              
                                            }
                                            for (var selector in config) {
                                              $(selector).chosen(config[selector]);
                                            }
                                            //END CHOSEN
                                        }else{
                                            $("#content_option").html('');
                                        }
                                    }
                                     //console.log(data.result);
                                     $("#content_referensi").html(data.result);
                                     $('#checkproses').val('1');
                                }else{
                                     $("#content_referensi").html('');
                                     $('#checkproses').val('0');
                                }
                            },
                            error: function(xhr) {                              
                                if($('#checkproses').val() == 0){
                                    $("#content_referensi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                                }
                            },
                            complete: function() {
                                $('.dataTables-example').dataTable({
                                    // responsive: true,
                                    "destroy" : true,
                                    "scrollX": true
                                });

                                if($('#checkproses').val() == 0){
                                    $("#content_referensi").html("<small class='text-danger'>Gagal Load Data</small>");
                                }
                            }
                        });
                    // }
  
                })               

            });                    

            function getForm(form,action,key,key2,key3,key4,key5,key6){
                $.ajax({
                    url: "referensi/generateForm",
                    type: "post",
                    data: {form:form,action:action,key:key,key2:key2,key3:key3,key4:key4,key5:key5,key6:key6},
                    dataType: 'json',
                    beforeSend: function() {
                        // alert('tes form');
                    },
                    success: function(data) {                                                                     
                        if(data.response == 'SUKSES'){
                            $("#modal_content").html(data.result);
                            $('#myModal').modal('show');


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
                               // $("#key").val(key);
                                $("#key2").val(key2);
                                $("#key3").val(key3);  
                                $("#key5").val(key5);
                                $("#key6").val(key6);    
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

            function tes(){
                alert('tes');
            }    

            function reloadTable(){
                $.ajax({
                    url: "referensi/generateReferensi",
                    type: "post",
                    data: {id_referensi:$("#referensi_list").val()},
                    dataType: 'json',
                    beforeSend: function() {
                        $("#content_option").html('');
                        $('#_content_referensi').removeAttr('class').attr('class', '');
                        var animation = 'fadeOutDown';
                        $('#_content_referensi').addClass('animated');
                        $('#_content_referensi').addClass(animation);
                        // return false;
                        $('#content_referensi').html('<div><img src="<?php echo base_url() ?>assets/inspinia/img/loading_bar.gif"></div>');
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

                             $("#content_referensi").html(data.result);
                             $('#checkproses').val('1');
                        }else{
                             $("#content_referensi").html('');
                             $('#checkproses').val('0');
                        }
                    },
                    error: function(xhr) {                              
                        if($('#checkproses').val() == 0){
                            $("#content_referensi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                        }
                    },
                    complete: function() {
                        $('.dataTables-example').dataTable({
                            // responsive: true,
                            "destroy" : true,
                            "scrollX": true
                        });

                        if($('#checkproses').val() == 0){
                            $("#content_referensi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                        }
                    }
                });
            }     


            function jendik(id){
            		$.ajax({
                        url: "referensi/generateReferensi",
                        type: "post",
                        data: {id_referensi:$("#referensi_list").val(),jenis:id},
                        dataType: 'json',
                        beforeSend: function() {
                            $('#_content_referensi').removeAttr('class').attr('class', '');
                            var animation = 'fadeOutDown';
                            $('#_content_referensi').addClass('animated');
                            $('#_content_referensi').addClass(animation);
                            // return false;
                            $('#content_referensi').html('<div><img src="<?php echo base_url() ?>assets/inspinia/img/loading_bar.gif"></div>');
                            $('#checkproses').val('0');
                        },
                        success: function(data) {                                                                     
                            if(data.response == 'SUKSES'){                            
                                 $("#content_referensi").html(data.result);
                                 $('#checkproses').val('1');
                            }else{
                                 $("#content_referensi").html('');
                                 $('#checkproses').val('0');
                            }
                        },
                        error: function(xhr) {                              
                            if($('#checkproses').val() == 0){
                                $("#content_referensi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        },
                        complete: function() {
                            $('.dataTables-example').dataTable({
                                // responsive: true,
                                "destroy" : true,
                                "scrollX": true
                            });

                            if($('#checkproses').val() == 0){
                                $("#content_referensi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        }
                    });
            }

            function kolok(id){
            		$.ajax({
                        url: "referensi/generateReferensi",
                        type: "post",
                        data: {id_referensi:$("#referensi_list").val(),kolok:id},
                        dataType: 'json',
                        beforeSend: function() {
                            $('#_content_referensi').removeAttr('class').attr('class', '');
                            var animation = 'fadeOutDown';
                            $('#_content_referensi').addClass('animated');
                            $('#_content_referensi').addClass(animation);
                            // return false;
                            $('#content_referensi').html('<div><img src="<?php echo base_url() ?>assets/inspinia/img/loading_bar.gif"></div>');
                            $('#checkproses').val('0');
                        },
                        success: function(data) {                                                                     
                            if(data.response == 'SUKSES'){                            
                                 $("#content_referensi").html(data.result);
                                 $('#checkproses').val('1');
                            }else{
                                 $("#content_referensi").html('');
                                 $('#checkproses').val('0');
                            }
                        },
                        error: function(xhr) {                              
                            if($('#checkproses').val() == 0){
                                $("#content_referensi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        },
                        complete: function() {
                            $('.dataTables-example').dataTable({
                                // responsive: true,
                                "destroy" : true,
                                "scrollX": true
                            });

                            if($('#checkproses').val() == 0){
                                $("#content_referensi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        }
                    });
            }

            function wilayah(id){
                    $.ajax({
                        url: "referensi/generateReferensi",
                        type: "post",
                        data: {id_referensi:$("#referensi_list").val(),wilayah:id},
                        dataType: 'json',
                        beforeSend: function() {
                            $('#_content_referensi').removeAttr('class').attr('class', '');
                            var animation = 'fadeOutDown';
                            $('#_content_referensi').addClass('animated');
                            $('#_content_referensi').addClass(animation);
                            // return false;
                            $('#content_referensi').html('<div><img src="<?php echo base_url() ?>assets/inspinia/img/loading_bar.gif"></div>');
                            $('#checkproses').val('0');
                        },
                        success: function(data) {                                                                     
                            if(data.response == 'SUKSES'){                            
                                 $("#content_referensi").html(data.result);
                                 $('#checkproses').val('1');
                            }else{
                                 $("#content_referensi").html('');
                                 $('#checkproses').val('0');
                            }
                        },
                        error: function(xhr) {                              
                            if($('#checkproses').val() == 0){
                                $("#content_referensi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        },
                        complete: function() {
                            $('.dataTables-example').dataTable({
                                // responsive: true,
                                "destroy" : true,
                                "scrollX": true
                            });

                            if($('#checkproses').val() == 0){
                                $("#content_referensi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        }
                    });
            }

            function kecamatan(id){
                    $.ajax({
                        url: "referensi/generateReferensi",
                        type: "post",
                        data: {id_referensi:$("#referensi_list").val(),kecamatan:id},
                        dataType: 'json',
                        beforeSend: function() {
                            $('#_content_referensi').removeAttr('class').attr('class', '');
                            var animation = 'fadeOutDown';
                            $('#_content_referensi').addClass('animated');
                            $('#_content_referensi').addClass(animation);
                            // return false;
                            $('#content_referensi').html('<div><img src="<?php echo base_url() ?>assets/inspinia/img/loading_bar.gif"></div>');
                            $('#checkproses').val('0');
                        },
                        success: function(data) {                                                                     
                            if(data.response == 'SUKSES'){                            
                                 $("#content_referensi").html(data.result);
                                 $('#checkproses').val('1');
                            }else{
                                 $("#content_referensi").html('');
                                 $('#checkproses').val('0');
                            }
                        },
                        error: function(xhr) {                              
                            if($('#checkproses').val() == 0){
                                $("#content_referensi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        },
                        complete: function() {
                            $('.dataTables-example').dataTable({
                                // responsive: true,
                                "destroy" : true,
                                "scrollX": true
                            });

                            if($('#checkproses').val() == 0){
                                $("#content_referensi").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                            }
                        }
                    });
            }

            

            function confirmHapusDataFlag(dest,key,key2,key3,key4){
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
                            rslt = hapusData(dest,key,key2,key3,key4);
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

            function confirmHapusData(dest,key,key2,key3,key4){
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
                            rslt = hapusDataP(dest,key,key2,key3,key4);
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

            function hapusData(dest,key,key2,key3,key4){
                var result = 1;

                $.ajax({
                    url: '<?php echo base_url("index.php/referensi/simpanReferensi"); ?>',
                    type: "post",
                    data: {destination:dest, action:'hapus_flag',key:key,key2:key2,key3:key3,key4:key4},
                    dataType: 'json',
                    beforeSend: function() {
                        // alert(key);
                    },
                    success: function(data) {                                                                     
                        if(data.response == 'SUKSES'){  
                            //alert('sukses hapus');
                            // swal("Hapus!", "Data berhasil dihapus.", "success");                   
                            result = 1;
                            
                        }else{
                            //alert('gagal hapus');
                            // swal("Gagal!", "Data gagal dihapus.", "error");
                            result = 0;
                        }
                    },
                    error: function(xhr) {                              
                        result = 0;
                    },
                    complete: function() {
                        reloadTable();  
                        // reload_kel();          
                    }
                });

                return result;
            }

            function hapusDataP(dest,key,key2,key3,key4){
                var result = 1;

                $.ajax({
                    url: '<?php echo base_url("index.php/referensi/simpanReferensi"); ?>',
                    type: "post",
                    data: {destination:dest, action:'hapus',key:key,key2:key2,key3:key3,key4:key4},
                    dataType: 'json',
                    beforeSend: function() {
                        // alert(key);
                    },
                    success: function(data) {                                                                     
                        if(data.response == 'SUKSES'){  
                            //alert('sukses hapus');
                            // swal("Hapus!", "Data berhasil dihapus.", "success");                   
                            result = 1;
                            
                        }else{
                            //alert('gagal hapus');
                            // swal("Gagal!", "Data gagal dihapus.", "error");
                            result = 0;
                        }
                    },
                    error: function(xhr) {                              
                        result = 0;
                    },
                    complete: function() {
                        reloadTable();  
                        if(dest=='ref_kelurahan')
                        {
                            reload_kel();              
                        }
                        
                    }
                });

                return result;
            }


            /*START CHOSEN*/
            var config = {
              '.chosen-select'           : {search_contains:true,no_results_text:'Oops, Data Tidak Ditemukan'}              
            }
            for (var selector in config) {
              $(selector).chosen(config[selector]);
            }
            /*END CHOSEN*/
        </script>

        <script>
        /*$(document).ready(function() {
         var dataTable = $('#tbl1').DataTable( {
                    // "columns": [
                    //           null,
                    //           null,
                    //           null,
                    //           null,
                    //           null,
                    //           null
                    //           ],
                    "responsive": true,
                    "scrollX": true,
                    "serverSide": true,
                    "language": {
                            "processing": "<div></div><div></div><div></div><div></div><div></div>"
                        },
                    "ajax":{
                        url :"<?php //echo site_url('referensi/getKel')?>", // json datasource
                        type: "post",  // method  , by default get
                        // drawCallback: function( settings ) {
                          
                        // },
                        beforeSend: function(){
                            $("#tbl1_processing").css("display","none");
                        },
                        error: function(){  // error handling
                            $(".tbl1-error").html("");
                            $("#tbl1").append('');
                            $("#tbl1_processing").css("display","none");
                            
                        }

                    }

                } );
                

                // setInterval( function () {
                //     $('#tbl1').DataTable().ajax.reload();
                // }, 1000 );


                $('#tbl1 input').unbind();
                $('#tbl1 input').bind('keyup', function(e) {
                if(e.keyCode == 13) {
                oTable.fnFilter(this.value);
                }
                });
            } );
*/
    function fnClickAddRow() 
        {
            $('#editable').dataTable().fnAddData( [
                "Custom row",
                "New row",
                "New row",
                "New row",
                "New row" ] );

        }
    </script>

