    <style type="text/css">
    
        #small-chat {position: fixed;bottom: 20px;right: 0px;z-index: 100;}
        #small-chat .badge {position: absolute;top: -3px;right: -4px;}
        .open-small-chat {height: 38px;width: 38px;display: block;background: #1ab394;padding: 9px 8px;text-align: center;color: #fff;border-radius: 50%;}
        .open-small-chat:hover {color: white;background: #1ab394;}
        .small-chat-box {display: none;position: fixed;bottom: 20px;right: 75px;background: #fff;border: 1px solid #e7eaec;width: 230px;height: 320px;border-radius: 4px;}
        .small-chat-box.ng-small-chat {display: block;}
        .body-small .small-chat-box {bottom: 70px;right: 20px;}
        .small-chat-box.active {display: block;}
        .small-chat-box .heading {background: #2f4050;padding: 8px 15px;font-weight: bold;color: #fff;}
        .small-chat-box .chat-date {opacity: 0.6;font-size: 10px;font-weight: normal;}
        .small-chat-box .content {padding: 15px 15px;}
        .small-chat-box .content .author-name {font-weight: bold;margin-bottom: 3px;font-size: 11px;}
        .small-chat-box .content > div {padding-bottom: 20px;}
        .small-chat-box .content .chat-message {padding: 5px 10px;border-radius: 6px;font-size: 11px;line-height: 14px;max-width: 80%;background: #f3f3f4;margin-bottom: 10px;}
        .small-chat-box .content .chat-message.active {background: #1ab394;color: #fff;}
        .small-chat-box .content .left {text-align: left;clear: both;}
        .small-chat-box .content .left .chat-message {float: left;}
        .small-chat-box .content .right {text-align: right;clear: both;}
        .small-chat-box .content .right .chat-message {float: right;}
        .small-chat-box .form-chat {padding: 10px 10px;}

        .panel, .ibox{
          text-decoration: none;
          outline: none;                
          border: none;
          border-radius: 5px;
          box-shadow: 2px 2px 3px 3px #999;  
        }

        .form-group #riwayat_list {          
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

         #ibox_bkd .ibox-content{
            padding: 15px 20px 0px 20px !important;
        }
        .user-friends
        {
            height:130px !important; 
            display:block !important; 
            overflow-y:auto !important;
        }
        .ms-options
        {
            min-height:150px !important;
        }

        #profile-content
        {
            max-height:250px !important;
        }

        .form-group #riwayat_list:hover {background-color: rgba(0,0,0,0.08);}  

        /*.modal-lg{
            width: 1024px !important;
        }*/
        .ms-options-wrap .ms-options ul, .ms-options-wrap .ms-options li {
            list-style: outside none none;
            margin: 0 !important;
            padding: 2px !important;
        }

        .ibox-title .label {
            float: none !important;
            margin-left: 4px;
        }

        .ms-options-wrap > .ms-options > ul > li.optgroup .label {
            display: inline !important;
            font-weight: bold;
            padding: 5px 0 0;
        }

        /*.label {*/
            /*background-color: #fff !important;*/
            /*color: #5e5e5e;*/
            /*font-family: "Open Sans";*/
            /*font-size: 10px;*/
            /*font-weight: 600;*/
            /*padding: 3px 8px;*/
            /*text-shadow: none;*/
        /*}*/

        .ms-options-wrap > .ms-options > ul input[type="checkbox"] {            
            top: 2px !important;
        }

        .float-e-margins .btn#btnRiwayat {
            margin-bottom: 0;
        }        
                

        /*Tampilkan pencarian di tampilan phone*/
        @media screen and (min-width: 770px){
            div#forPhone{
                display: none;
            }

            .modal-lg{
                width: 1024px !important;
            }

            #btnRiwayat{
                float: right;
            }
        }        

    </style>
    <!-- Multiple Select -->
    <link href="<?php echo base_url(); ?>assets/js/plugins/multipleselect/jquery.multiselect.css" rel="stylesheet">
    <!-- Multiple Select -->


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Respon Persetujuan Data Pegawai</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>index.php">Home</a>
            </li>            
            <li class="active">
                <strong>Request</strong>
            </li>
        </ol>
        <small><i>(Menu untuk memberikan respon persetujuan data pegawai yang diinput oleh masing-masing pegawai)</i></small>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content">
<?php if($user_group > 1){ ?>
    <div class="row" id="forPhone">
        <div class="col-md-12">
            <div id="ibox_bkd" class="ibox float-e-margins animated fadeInRightBig">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-4">
                            <form id="form_4bkd" method="POST" action="<?php echo site_url(); ?>/riwayat">
                              <div class="form-group">                        
                                <div class="input-group">                          
                                  <input type="text" class="form-control" id="nrkP" name="nrkP" value="<?php echo $nrk; ?>" data-mask="999999" placeholder="NRK" autocomplete="off">
                                  <div class="input-group-addon btn btn-primary" style="cursor:pointer;" onclick="getProfile('4bkd');">Go</div>                          
                                </div>
                                <small><span class="help-block m-b-none"><u><i>Masukkan NRK Pegawai yang akan ditampilkan (Cth : 123456).</i></u></span></small>
                              </div>                      
                            </form>
                        </div>                                        
                    </div>
                </div>
            </div>
        </div>
    </div>

   




<?php } ?>

    <div class="row">   
        <div class="col-md-12">
            <!-- START HISTORY -->
            <div class="ibox float-e-margins animated fadeInRight">
                <div class="ibox-title">
                    <div class="row">
                        <div style="margin-top:5px;margin-left:2px">                            
                            <div class="col-md-5 form-group">                        
                                <select name="riwayat_list2[]" multiple="multiple" id="riwayat_list2" class="form-control" style="display: none; min-height:150px;">
                                        <optgroup label="Pilih Jenis Riwayat Pegawai Yang Akan Direspon">
                                            <?php echo $menu_select; ?>
                                        </optgroup>                                                   
                                </select>                                
                                <span class="help-block m-b-none"><u><i>Pilih jenis riwayat pegawai yang akan direspon.</i></u></span>
                            </div>
                            <div class="col-md-1 form-group">
                                <button class="btn btn-primary btn-sm" id="btnRiwayat" type="button">Tampilkan</button>
                            </div>
                            <!-- <div class="col-md-5 form-group">
                                <select name="riwayat_list" id="riwayat_list" data-placeholder="--- Pilih Riwayat ---" class="form-control chosen-select" tabindex="2">
                                    <option value=""></option>
                                    <option value=""></option>
                                    <?php //echo $menu_select; ?>
                                </select>       
                                <span class="help-block m-b-none"><u><i>Pilih jenis riwayat yang akan ditampilkan.</i></u></span>
                            </div> -->
                            
                        </div>
                    </div>                    
                </div>
                <div class="ibox-content">
                    <input type="hidden" id="checkproses" value="1">
                    <div  id="content_riwayat" class="content_riwayat">
                        
                    </div>
                </div>
            </div>
            <!-- END HISTORY -->
        </div>        
    </div>    



	<!-- <div id="container">	
		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php //echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div> -->
</div>



<!-- Start Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
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

        <!-- Multiple Select -->
        <script src="<?php echo base_url(); ?>assets/js/plugins/multipleselect/jquery.multiselect.js"></script>
        <!-- Multiple Select -->

        <script>
            $('select[multiple]').multiselect({
                columns: 1,            
                placeholder: '--- Pilih Riwayat ---'
            });        
        </script>


        <script type="text/javascript">
            $(document).ready(function(){
                $('#data_1 .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy"
                }); 
                
            });
        </script>

        <script type="text/javascript">

            $('.dataTables-example').dataTable({
                responsive: true,                
                // "dom": 'T<"clear">lfrtip',
                // "tableTools": {
                //     "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                // }
            });


            $(document).ready(function(){
                var today = new Date();
                var dd    = today.getDate();
                var mm    = ("0" + (today.getMonth() + 1)).slice(-2); 
                var yyyy  = today.getFullYear(); 

                    $('#data_4 .input-group.date').datepicker({
                                changeyear: false,
                                minViewMode: 1,
                                keyboardNavigation: false,
                                forceParse: false,
                                autoclose: true,
                                todayHighlight: true,
                                // format: 'yyyy-mm-dd'
                                format: 'M yyyy'
                            });

                    $("#tglpilih").unbind('change');        

            });

            $(function(){
              $('#btnRiwayat').click(function(event){
                event.preventDefault();
                var nrkP = $("#nrkP").val(); 
                var val = [];
                var timer = 0;
                $('#content_riwayat').html(''); //reset riwayat
                $(':checkbox:checked').each(function(i){
                    val[i] = $(this).val();

                    setTimeout(function(){ //DELAY
                        $('#content_riwayat').append('<div  id="content_riwayat_'+val[i]+'" class="">');
                        getListRiwayat(nrkP, val[i]);
                    }, timer);

                    timer = timer + 750;                    
                });
              });

              $('#btnRiwayat').click();
            });

            function getListRiwayat(a,b){
                $.ajax({
                    url: "request/generateRequest",
                    type: "post",
                    data: {nrk:a, id_riwayat:b},
                    dataType: 'json',
                    beforeSend: function() {
                        // $('#_content_riwayat_'+b).removeAttr('class').attr('class', '');
                        // var animation = 'fadeOutDown';
                        // $('#_content_riwayat_'+b).addClass('animated');
                        // $('#_content_riwayat_'+b).addClass(animation);
                        // return false;
                        $('#content_riwayat_'+b).html('<div class="animated fadeInRight"><img src="<?php echo base_url() ?>assets/inspinia/img/loading_bar.gif"></div>');
                        $('#checkproses').val('0');
                    },
                    success: function(data) {                                                                     
                        if(data.response == 'SUKSES'){
                             $("#content_riwayat_"+b).html(data.result);
                             $('#checkproses').val('1');
                        }else{
                             $("#content_riwayat_"+b).html('');
                             $('#checkproses').val('0');
                        }
                    },
                    error: function(xhr) {                              
                        if($('#checkproses').val() == 0){
                            $("#content_riwayat_"+b).html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                        }
                    },
                    complete: function() {
                        $('.dataTables-example').dataTable({
                            // responsive: true,
                            "destroy" : true,
                            "scrollX": true
                        });

                        if($('#checkproses').val() == 0){
                            $("#content_riwayat_"+b).html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                        }
                    }
                });
            }

            function getProfile(nrk){
                $("#thbl_"+nrk).val($("#monthyear").val());
                $("#form_"+nrk).submit();
            }

            function getForm(form,nrk,action,key1,key2,key3,key4){
                save_method = action;

                $.ajax({
                    url: "request/generateForm",
                    type: "post",
                    data: {form:form,nrk:nrk,action:action,key1:key1,key2:key2,key3:key3,key4:key4},
                    dataType: 'json',
                    beforeSend: function() {
                        $('#myModal').modal('toggle');
                        $("#modal_content").html('<div class="sk-spinner sk-spinner-three-bounce" style="width:110px;"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div></div>');
                    },
                    success: function(data) {                                                                     
                        if(data.response == 'SUKSES'){
                            $("#modal_content").html(data.result);

                            if(data.widthForm == 'one'){
                                $('#widthForm').removeAttr('class').attr('class', '');                                
                                $('#widthForm').addClass('modal-dialog');
                            }else{
                                $('#widthForm').removeAttr('class').attr('class', '');
                                $('#widthForm').addClass('modal-dialog');
                                $('#widthForm').addClass('modal-lg');                                
                            }

                        }else{
                            $("#modal_content").html('');
                        }
                    },
                    error: function(xhr) {                              
                        $('#myModal').modal('hide');  
                    },
                    complete: function() {
                                                
                    }
                });
            }

            function setMonthYear(){                
                
                $.ajax({
                    url: "riwayat/generateStrukturPegawai",
                    type: "post",
                    data: {nrk:$("#nrkP").val(), thbl:$("#monthyear").val()},
                    dataType: 'json',
                    beforeSend: function() {
                        $('#list_bawahan').removeAttr('class').attr('class', '');
                        var animation = 'fadeOutDown';
                        $('#list_bawahan').addClass('animated');
                        $('#list_bawahan').addClass(animation);
                        // return false;
                    },
                    success: function(data) {                                                                     
                        if(data.response == 'SUKSES'){                             
                             if(data.result == ""){
                                $("#list_bawahan").html("<small class='text-navy'>Bawahan Tidak Ditemukan</small>");
                             }else{
                                $("#list_bawahan").html(data.result);
                             }
                        }else{
                            $("#list_bawahan").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                        }
                    },
                    error: function(xhr) {                              
                        $("#list_bawahan").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
                    },
                    complete: function() {
                        $('#list_bawahan').removeAttr('class').attr('class', '');
                        var animation = 'fadeInUp';
                        $('#list_bawahan').addClass('animated');
                        $('#list_bawahan').addClass(animation);
                    }
                });


            }

            function reload()
            {
                //event.preventDefault();
                var nrkP = $("#nrkP").val();
                var val = [];
                var timer = 0;
                $('#content_riwayat').html(''); //reset riwayat
                $(':checkbox:checked').each(function(i){
                    val[i] = $(this).val();

                    setTimeout(function(){ //DELAY
                        $('#content_riwayat').append('<div  id="content_riwayat_'+val[i]+'" class="">');
                        getListRiwayat(nrkP, val[i]);
                    }, timer);

                    timer = timer + 750;
                });

//                $.ajax({
//                        url: "riwayat/generateRiwayat",
//                        type: "post",
//                        data: {nrk:$("#nrkP").val(), id_riwayat:$("#riwayat_list2").val()},
//                        dataType: 'json',
//                        beforeSend: function() {
//                            $('#_content_riwayat').removeAttr('class').attr('class', '');
//                            var animation = 'fadeOutDown';
//                            $('#_content_riwayat').addClass('animated');
//                            $('#_content_riwayat').addClass(animation);
////                             return false;
//                            $('#content_riwayat').html('<div><img src="<?php //echo base_url() ?>//assets/inspinia/img/loading_bar.gif"></div>');
//                            $('#checkproses').val('0');
//
//                            //$('#content_riwayat_'+b).html('<div class="animated fadeInRight"><img src="<?php //echo base_url() ?>//assets/inspinia/img/loading_bar.gif"></div>');
//                            //$('#checkproses').val('0');
//
//                        },
//                        success: function(data) {
//                            if(data.response == 'SUKSES'){
//                                 $("#content_riwayat").html(data.result);
////                                 $("#content_riwayat_"+b).html(data.result);
//                                 $('#checkproses').val('1');
//                            }else{
//                                 $("#content_riwayat").html('');
//                               //  $("#content_riwayat_"+b).html('');
//                                 $('#checkproses').val('0');
//                            }
//                        },
//                        error: function(xhr) {
//                            if($('#checkproses').val() == 0){
//                                $("#content_riwayat").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
////                                $("#content_riwayat_"+b).html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
//                            }
//                        },
//                        complete: function() {
//                            $('.dataTables-example').dataTable({
//                                // responsive: true,
//                                "destroy" : true,
//                                "scrollX": true
//                            });
//
//                            if($('#checkproses').val() == 0){
//                                $("#content_riwayat").html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
////                                 $("#content_riwayat_"+b).html("<small class='text-danger'>Silahkan Coba Kembali...</small>");
//                            }
//                        }
//                    });
            }

            function confirmHapusData(dest,key1,key2,key3,key4){
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
                            rslt = hapusData(dest,key1,key2,key3,key4);                            
                        }                         
                    });               
                /*END SWEETALERT*/
            }

            function hapusData(dest,key1,key2,key3,key4){
                var result = 0;

                $.ajax({
                    url: '<?php echo base_url("index.php/riwayat/hapusHist"); ?>',
                    type: "post",
                    data: {destination:dest, action:'hapus',key1:key1,key2:key2,key3:key3,key4:key4},
                    dataType: 'json',
                    beforeSend: function() {
                        
                    },
                    success: function(data) {                                                                     
                        if(data.response == 'SUKSES'){                    
                            swal("Hapus!", "Data berhasil dihapus.", "success");    
                            reload();
                        }else{
                            swal("Gagal!", "Data gagal dihapus.", "error");                            
                        }
                    },
                    error: function(xhr) {                              
                        swal("Gagal!", "Data gagal dihapus.", "error");
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

