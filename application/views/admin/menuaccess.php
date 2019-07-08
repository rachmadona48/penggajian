<style type="text/css">
    .col-lg-4 .ibox .ibox-title{
        background-color: rgba(0,0,0,0.1);
    }
    .col-lg-4 .ibox .ibox-content{
        background-color: rgba(10,0,0,0.07);
    }
    #addMenu .modal-content .modal-header {
        padding: 10px 15px; 
        text-align: center;
    }
    #addMenu .ibox-content {
        background-color: #ffffff;
        color: inherit;
        padding: 0px 0px 0px 0px !important; 
        border-color: #e7eaec;
        border-image: none;
        border-style: solid solid none;
        border-width: 1px 0px;
    }

    .dd-item .pull-right button{
        margin-top: 5px;
        margin-right: 2px;
    }

</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Pengaturan Akses Menu User</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li class="active">
                <strong>Menu Access</strong>
            </li>
        </ol>
    </div>
</div>

<!-- START WRAPPER CONTENT -->
<div class="wrapper wrapper-content animated fadeInRight">  
<?php if ($this->session->userdata('logged_in')['user_group']=='3'){ ?>      
        <div class="row">        
            <div class="col-lg-12">
                <div class="ibox ">
                    <form id="formAccessMenu" action="javascript:simpanPerubahan();" method="POST">
                    <div class="ibox-title">
                        <span class="pull-right"> <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Simpan Perubahan</button> </span>
                        <div class="row">
                            <div class="col-sm-3">
                                <select class="form-control" name="user" id="user" onchange="getAccessMenu()">
                                    <option value="">Pilih Group User</option>
                                    <?php                                                                                 
                                             
                                        echo $listgroupuser;
                                        
                                    ?> 
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <td align="left" ><b>No.</b></td>
                                                <td align="left" ><b>Modul</b></td>
                                                <td align="center" ><b>View</b></td>
                                                <td align="center" ><b>Insert</b></td>
                                                <td align="center" ><b>Update</b></td>
                                                <td align="center" ><b>Reset Password</b></td>
                                                <td align="center" ><b>Delete</b></td>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyAccessMenu">
                                            
                                        </tbody>
                                    </table>                                    
                                
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>                           

        </div>        
    <?php } ?>    
</div>
<!-- END WRAPPER CONTENT -->
    
    <!-- Mainly scripts -->
    <script src="<?php echo base_url() ?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Nestable List -->
    <script src="<?php echo base_url() ?>assets/js/plugins/nestable/jquery.nestable.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url() ?>assets/js/inspinia.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins/pace/pace.min.js"></script>

    <!-- Validation -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/boostrapvalidator/js/bootstrapValidator.js"></script>    
    <!-- Validation -->

    <script type="text/javascript">

        function getAccessMenu(){
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/admin/admin/getMenuAccess",
                type: "post",
                data: {usergroup:$("#user").val()},
                dataType: 'json',
                beforeSend: function() {                                                        
                    $("#bodyAccessMenu").html('<tr><td colspan="7" align="center"><div class="spiner-example"><div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div></td></tr>');
                },
                success: function(data) {                                                                     
                    if(data.response == 'SUKSES'){
                        $("#bodyAccessMenu").html(data.hasil);
                    }else{
                        $("#bodyAccessMenu").html('<tr><td colspan="7" align="center">Tidak Ada Menu Untuk Ditampilkan</td></tr>');
                    }
                },
                error: function(xhr) {                              
                    $("#bodyAccessMenu").html('<tr><td colspan="7" align="center">Tidak Ada Menu Untuk Ditampilkan</td></tr>');
                },
                complete: function() {
                    
                }
            });
        }

        function simpanPerubahan(){
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/admin/admin/simpanmenuaccess",
                type: "post",
                data: $("#formAccessMenu").serialize(),
                dataType: 'json',
                beforeSend: function() {                                                        
                    $("#bodyAccessMenu").html('<tr><td colspan="7" align="center"><div class="spiner-example"><div class="sk-spinner sk-spinner-three-bounce"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div></div></div></td></tr>');
                },
                success: function(data) {                                                                     
                    if(data.response == 'SUKSES'){
                        getAccessMenu();
                    }else{
                        $("#bodyAccessMenu").html('<tr><td colspan="7" align="center">Tidak Ada Menu Untuk Ditampilkan</td></tr>');
                    }
                },
                error: function(xhr) {                              
                    $("#bodyAccessMenu").html('<tr><td colspan="7" align="center">Tidak Ada Menu Untuk Ditampilkan</td></tr>');
                },
                complete: function() {
                    
                }
            });
        }

    </script>

    




