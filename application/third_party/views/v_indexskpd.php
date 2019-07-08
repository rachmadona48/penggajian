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
        <div class="col-lg-10">
            <h2>Data Permohonan</h2>
            <ol class="breadcrumb">
                <li>
                    <u><a href="<?php echo site_url().'skpd'?>"><font color="blue">Home</font></a></u>
                </li>
                <li class="active">
                    <strong>Permohonan</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>


<div class="wrapper wrapper-content">
    <?php if($user_group > 1){ ?>    
    <!-- START WELLCOME -->
    <div class="row">    
        <div class="col-md-12">
            <div class="ibox animated fadeInLeft">
                <div class="ibox-title navy-bg">
                    <h5>Data Permohonan</h5>
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
                                            <div class="col-md-12">
                                                <div class="col-md-3">
                                                    <label>Filter Berdasarkan :</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <select class='form-control chosen-jenis' name='filter_pertama' id='filter_pertama'>
                                                        <option selected="true" value="" disabled="true">Filter Permohonan</option>
                                                        <?php foreach($ref_permohonan->result() as $row): ?>
                                                            <option value="<?php echo $row->ID_PERMOHONAN ?>"><?php echo $row->KET_PERMOHONAN?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <select class='form-control chosen-jenis' name='filter_kedua' id='filter_kedua'>
                                                        <option selected="true" value="" disabled="true">Filter Jenis Permohonan</option>
                                                        <?php foreach($jenis_permohonan->result() as $row): ?>
                                                            <option value="<?php echo $row->ID_JENIS_PERMOHONAN ?>"><?php echo $row->KET_JENIS_PERMOHONAN ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <select class='form-control chosen-jenis' name='filter_ketiga' id='filter_ketiga'>
                                                        <option selected="true" value="" disabled="true">Filter Golongan</option>
                                                        <?php foreach($gol_pegawai->result() as $row): ?>
                                                            <option value="<?php echo $row->KOPANG ?>"><?php echo $row->GOL ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <table id="tbl-list" class="display table table-bordered">
                                                     <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>NRK</th>
                                                            <th>Nama</th>
                                                            <th>Tgl Permohonan</th>
                                                            <th>Permohonan</th>
                                                            <th>Jenis Permohonan</th>
                                                            <th>Golongan</th>
                                                            <!-- <th>&nbsp;</th> -->
                                                        </tr>
                                                     </thead>
                                                     <tbody id="full_list">
                                                            
                                                     </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-10">
                                        <button class="btn btn-primary pull-right" id="selanjutnya">Selanjutnya</button>
                                    </div> -->
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
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.1.2/css/select.dataTables.min.css">
        <script type="text/javascript" src="https://cdn.datatables.net/select/1.1.2/js/dataTables.select.min.js"></script>
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
            getpgwai();

            $('#filter_pertama, #filter_kedua, #filter_ketiga').change(function(){
                update_tbl();
            });

            $('#tbl-list tbody').on('click', 'tr', function(){
                $(this).toggleClass('selected');
            })

        function update_tbl(){
            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';

            var dtbl= $('#tbl-list').DataTable({
                "aoColumns": [
                    { "bSortable": true },
                     { "bSortable": true },
                     { "bSortable": true },
                     { "bSortable": true},
                     { "bSortable": true},
                     { "bSortable": true},
                     { "bSortable": true},
                     /*{ "bSortable": false}*/
                ],
                destroy: true,
                responsive: false,
                "scrollX": true,
                "serverSide": true,
                "ajax": {
                    url: '<?php echo base_url("index.php/skpd/filter_function"); ?>/',
                    type: "post",
                    data: {
                        filter_pertama: $('#filter_pertama').val(),
                        filter_kedua: $('#filter_kedua').val(),
                        filter_ketiga: $('#filter_ketiga').val()
                    },
                    beforeSend: function() {                        
                        $("#full_list").html(spinner);
                    },
                }
            });

            
        }    

        function getpgwai(){
            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';
            // var spm = 'C180';
        
            console.log('from getpgwai');

            var dtbl= $('#tbl-list').DataTable({
                "aoColumns": [
                    { "bSortable": true },
                     { "bSortable": true },
                     { "bSortable": true },
                     { "bSortable": true},
                     { "bSortable": true},
                     { "bSortable": true},
                     { "bSortable": true},
                     /*{ "bSortable": false}*/
                ],
                responsive: false,
                "scrollX": true,
                "serverSide": true,
                "ajax": {
                    url: '<?php echo base_url("index.php/skpd/get_data_table"); ?>/',
                    type: "post",
                    data: {
                        
                    },
                    beforeSend: function() {                        
                        $("#full_list").html(spinner);
                    },
                    /*complete: function()
                    {
                        $("#full_list").html('');
                    }*/
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

        });
        </script>

