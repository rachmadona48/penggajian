<?php
    // $check_user = $this->db->query("SELECT KD FROM PERS_PEGAWAI1 WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row();
    // if($_SESSION['logged_in']['id_sop'] <> 1 && $check_user->KD == "F")){
    //     redirect(base_url('profile'));
    //     // var_dump('whoops');exit;
    // }
?>
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

<span id="main-wrapper">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Permohonan Data Pegawai</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo site_url()?>">Home</a>
                </li>
                <li class="active">
                    <strong>Permohonan</strong>
                </li>
            </ol>
             <small><i>(Menu untuk pengajuan permohonan terkait)</i></small>
        </div>
        <div class="col-lg-2">

        </div>
    </div>


<div class="wrapper wrapper-content">
    <?php if($user_group == 1){ ?>    
    <!-- START WELLCOME -->
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
                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-12">

                            <!-- form: -->
							<div class="row">
                    			<form class="form-horizontal" id="defaultForm" method="post">
                                    <div class="data-form-group">
                                        <div class="form-group">
                                            <div class="col-md-1">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="jenis">Permohonan</label>
                                            </div>
                                            <div class="col-md-5">
                                                <select class='form-control chosen-jenis' name='ref_permohonan' id='ref_permohonan' data-placeholder='Cari Berdasarkan...'>
                                                    <?php echo $ref_permohonan ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-10">
                                        <button class="btn btn-primary pull-right" id="selanjutnya">Selanjutnya</button>
                                    </div>
                                    <!-- END DIV FORM GROUP-->
								</form>
                            <!-- :form -->
                            </div>                                            
						</div>
                    </div>
                </div>
        </div>
    </div>
    <!-- END WELLCOME -->
<?php } ?>

</div>
</span>
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

        $(document).ready(function(){
            // $('#id_sop_permohonan').hide();
            $('#selanjutnya').click(function(e){
                var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';
                e.preventDefault();
                var ref_prm = $('#ref_permohonan').val();
                $.ajax({
                    url: '<?php echo base_url("index.php/Permohonan/idx_2"); ?>/',
                    data: {
                        REF_PERMOHONAN : ref_prm
                    },
                    type: 'post',
                    dataType: 'html',
                    beforeSend: function() {                        
                        $(".ibox-content").html(spinner);
                    },
                    success: function(data){
                        $('.ibox-content').html(data);
                    },
                    complete: function(){
						
					}
                });
            })
     

            /*START CHOSEN*/
            var config = {
                  '.chosen-jenis'           : {no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                                }
                for (var selector in config) {
                  $(selector).chosen(config[selector]);
                }
            /*END CHOSEN*/
        });
        </script>

