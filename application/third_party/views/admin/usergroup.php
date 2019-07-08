

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
                /*margin-top: 35px !important;*/
            }
            
            #btnCetak{
                margin-top: 37px;
            }
        }

    </style>    

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Pengaturan Group Menu</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li class="active">
                <strong>Group Menu</strong>
            </li>
        </ol>
    </div>
</div>

<!-- START WRAPPER CONTENT -->
<div class="wrapper wrapper-content ">        
        <div class="row">        
            <!-- <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                         <div class="ibox-title">
                        <span class="pull-right"> <button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Tambah Group Menu</button> </span>
                        </div>
                    </div>
                </div>
            </div>  -->

            <div class="col-lg-12">
                <div class="ibox animated fadeInRight">
                    <!-- <div class="ibox-title">          
                        <span class="pull-right"> <button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Tambah Group Menu</button> </span>
                        <br/>
                    </div> -->
                        <div class="ibox-title">
                            <span class="pull-right"> <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#AddGroup" onclick="resetForm();"><i class="fa fa-plus"></i>&nbsp; Tambah Group Menu</button> </span>
                            <!-- <span class="pull-right"> <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Simpan Perubahan</button> </span> -->
                        </div>

                        <div class="ibox-content">

                            <div class="row">
                                <div class="col-sm-12">
                                    
                                    <table id="tbl_groupUser" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <td align="left" ><b>Id Group</b></td>
                                                <td align="left" ><b>Nama Group</b></td>
                                                <td align="center" ><b>Action</b></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <div id="daftar_pegawai"></div> 
                                        </tbody>
                                    </table>                                    
                                    
                                </div>
                            </div>

                        </div>
                </div>
            </div>
            

        </div> 

</div>
<!-- END WRAPPER CONTENT -->




    <!--Start Modal Add Group-->
    <div class="modal inmodal" id="AddGroup" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content animated bounceIn">
                <div class="modal-header">
                    <button type="button" id="tutupModal" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3 id="modalUmumTitle"><u>Group</u></h3>
                </div>
                <div class="modal-body">
                    <div class="ibox float-e-margins">                                
                        <div class="ibox-content">
                            <form id="formGroup" class="form-horizontal" action="javascript:simpanGroup();" method="POST">
                                <input type="hidden" id="action" name="action" value="tambah">
                                <input type="hidden" name="user_group_id" id="user_group_id">                                        
                
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Nama Group</label>
                                    <div class="col-lg-9">
                                        <input type="text" placeholder="Nama Group" name="nama_group" id="nama_group" class="form-control">
                                        <span class="text-danger" id="errnama_group"></span>
                                        
                                        <!-- <div class="i-checks"><label> <input type="radio" value="option1" name="a"> <i></i> Option one </label></div>
                                        <div class="i-checks"><label> <input type="radio" checked="" value="option2" name="a"> <i></i> Option two checked </label></div> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Status Group</label>
                                    <div class="col-lg-9">
                                        <div class="onoffswitch">
                                            <input type="checkbox" class="onoffswitch-checkbox" id="example1" name="status_aktif">
                                            <label class="onoffswitch-label" for="example1">                                                
                                                <span class="onoffswitch-switch" id="off" ></span>
                                                <span class="onoffswitch-inner" id="on"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-9">
                                        <span class="pull-right"><button class="btn btn-sm btn-primary" type="submit">Simpan</button></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>                            
                </div>
            </div>
        </div>
    </div>            
    <!-- End Modal Add Menu -->

    <!--Start Modal Add Group-->
    <!-- <div class="modal inmodal" id="Change_group" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceIn" id="show_group">
                <div class="modal-header">
                    <button type="button" id="tutupModal" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3 id="title"><u>Ganti Status Group</u></h3>
                </div>
                <div class="modal-body" >
                    <div class="ibox float-e-margins">                                
                        <div class="ibox-content">
                            <form id="formGroup" class="form-horizontal" action="javascript:simpanGroup();" method="POST">
                                <input type="hidden" name="action" id="action" class="form-control">
                                <input type="hidden" name="id_menu" id="id_menu" class="form-control">                                        
                
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Nama Group</label>
                                    <div class="col-lg-9">
                                        <input type="text" placeholder="Nama Menu" name="nama_group" id="nama_group" class="form-control">
                                        <span class="text-danger" id="errnama_group"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Status Group</label>
                                    <div class="col-lg-9">
                                        <div class="onoffswitch">
                                            <input type="checkbox" checked class="onoffswitch-checkbox" id="example1" name="status_aktif">
                                            <label class="onoffswitch-label" for="example1">
                                                <span class="onoffswitch-inner" id="on"></span>
                                                <span class="onoffswitch-switch" id="off" ></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-lg-offset-3 col-lg-9">
                                        <span class="pull-right"><button class="btn btn-sm btn-primary" type="submit">Simpan</button></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>                            
                </div>
            </div>
        </div>
    </div>            
    <!-- End Modal Add Menu -->
    
    <!-- Mainly scripts -->
    <script src="<?php echo base_url() ?>assets/inspinia/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url() ?>assets/inspinia/js/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Data Tables -->
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
    <!-- Data Tables -->

    <!-- Nestable List -->
    <script src="<?php echo base_url() ?>assets/js/plugins/nestable/jquery.nestable.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url() ?>assets/js/inspinia.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins/pace/pace.min.js"></script>

    <!-- Validation -->
    <script src="<?php echo base_url(); ?>assets/boostrapvalidator/js/bootstrapValidator.js"></script>    
    <!-- Sweet alert -->
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/iCheck/icheck.min.js"></script>

    <script type="text/javascript">
        
        
        $(document).ready(function() {
            
             var dataTable = $('#tbl_groupUser').DataTable( {
                        // "aoColumns": [
                        //                   null,
                        //                   null,
                        //                   null,
                        //                   null,
                        //                   null,
                        //                   { "bSortable": false }
                        //                 ],
                        responsive: true,
                        "processing": true,
                        "serverSide": true,
                        "language": {
                                "processing": "<div></div><div></div><div></div><div></div><div></div>"
                            },
                        "ajax":{
                            url :"<?php echo site_url('admin/admin/getGroup')?>", // json datasource
                            type: "post",  // method  , by default get
                            beforeSend: function(){
                                $("#tbl_groupUser_processing").css("display","none");

                            },
                            error: function(){  // error handling
                                $(".tbl_groupUser-error").html("");
                                $("#tbl_groupUser").append('<tbody class="employee-grid-error"><tr><th colspan="7">No data found in the server</th></tr></tbody>');
                                $("#tbl_groupUser_processing").css("display","none");
                                
                            }

                        }
                    } );


                    $('#tbl_groupUser input').unbind();
                    $('#tbl_groupUser input').bind('keyup', function(e) {
                        if(e.keyCode == 13) {
                           oTable.fnFilter(this.value);
                        }
                    });
                                 
                    
            });

            
            
        </script>

        <script type="text/javascript">

        function resetForm(){        
            document.getElementById("formGroup").reset();
        }

        $(document).ready(function(){
        
        });
        
            function simpanGroup(){
                var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';
                var url = "<?php echo site_url('index.php/admin/admin/SimpanGroup')?>";
                $.ajax({
                    url: url,
                    type: "POST",
                    // data: {'useridaa':$("#userid").val(),'usernameaa':$("#username").val()},
                    data: $("#formGroup").serialize(),
                    dataType: 'json',
                    beforeSend: function() { 
                        // resetForm(); 

                        var nama_group = $("#nama_group").val();
                        if(nama_group == ""){
                           $("#errnama_group").html("Nama Group Wajib diisi!!!");
                                return false;
                            }else{
                                $("#errnama_group").html();                    
                            }

                        // blocklayar();
                        $("#daftar_pegawai").html(spinner);

                    },
                    success: function(data) {                               
                        
                        if(data.responeinsert == 'SUKSES'){
                            // alert("Sukses, group "+data.group+" berhasil ditambahkan"); 
                            swal("Sukses!", "Berhasil menambahkan group "+data.group+"", "success");                    
                            $("#tutupModal").click();
                            // location.reload();
                            $("#tbl_groupUser").DataTable().ajax.reload();
                            $("#daftar_pegawai").remove();
                        }else if(data.responeinsert == 'ADA'){
                            // alert("SUDAH ADA");
                             swal("Gagal!", "Group "+data.group+" sudah ada.", "error");
                        }else if(data.responeinsert == 'SUKSES EDIT'){
                            swal("Sukses!", "Berhasil Ubah status "+data.group+"", "success");                    
                            $("#tutupModal").click();
                            // location.reload();
                            $("#tbl_groupUser").DataTable().ajax.reload();
                        }else{
                            // alert("GAGAL SIMPAN");
                            swal("Gagal!", "Gagal.", "error");
                        }
                    },
                    error: function(xhr) {                              
                        
                    },
                    complete: function() {              
                        
                    }
                });
            }

        </script>
        
        <script type="text/javascript">

     //       function change1(user_group_id){
     //            $.post("<?php echo site_url()?>index.php/admin/admin/ubah_statusGrou",{
     //                user_group_id: user_group_id
     //            },
     //            function(data){
     //                $("#show_group").html(data);
     //                $("#user_group_id").val(data.user_group_id);

     //            })
     //            $("#Change_group").modal('show');
     //        }

        </script>
        
        <script type="text/javascript">

            function change(user_group_id){
                // alert(user_group_id);
                // var url = "<?php echo site_url('admin/admin/edit_status')?>";
                // $.ajax({
                //     url: url,
                //     type: "POST",            
                //     data: {user_group_id:user_group_id},
                $.ajax({
                    url: '<?php echo base_url("admin/admin/edit_status"); ?>',
                    type: "post",
                    data: {
                        user_group_id: user_group_id
                    },
                    dataType: 'json',
                    beforeSend: function() {                                
                        resetForm();
                    },
                    success: function(data) {                               
                        
                        if(data.respone == 'SUKSES'){
                            // alert(data.status_aktif);
                            $("#user_group_id").val(data.user_group_id);
                            $("#nama_group").val(data.nama_group);
                            if(data.status_aktif == 'Y'){
                                $( "#example1" ).prop( "checked", true );
                            }else{
                                $( "#example1" ).prop( "checked", false );
                            }
                            $("#action").val('ubah');
                                               
                           
                        }else{
                            // swal("Gagal!", "Gagal.", "error");
                        }
                    },
                    error: function(xhr) {                              
                        
                    },
                    complete: function() {              
                        
                    }
                });
            }


    </script>

    <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>