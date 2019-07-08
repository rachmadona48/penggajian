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
                    <u><a href="<?php echo site_url().'biroumum'?>"><font color="blue">Home</font></a></u>
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
    <?php if($user_group == 9){ ?>    
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
                                            <div class="col-md-12">
												<div class="col-md-3">
													<label for="jenis" class="pull-right">Permohonan</label>
												</div>
												<div class="col-md-5">
                                                    <select class='form-control chosen-jenis' name='ref_permohonan' id='ref_permohonan' data-placeholder='Cari Berdasarkan...'>
                                                        <?php foreach($ref_permohonan->result() as $row): ?>
                                                            <option id="<?php echo $row->ID_PERMOHONAN ?>" value="<?php echo $row->ID_PERMOHONAN ?>"><?php echo $row->KET_PERMOHONAN ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
	                                            </div>
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
            $('#table_pegawai').hide();
            //get_permohonan();
            //getpgwai();
            //onchangeJenis();
            //$('#fungsional_pengangkatan').show();
            //$('#fungsional_pembebasan').hide();
            //$('#fungsional_pengangkatan_kembali').hide();
            // $("#jenis").on("change", function(event) {
            //     event.preventDefault();
            //         onchangeJenis();
            // });

            $('#selanjutnya').click(function(e){
                var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';
                e.preventDefault();
                var ref_prm = $('#ref_permohonan').val();
                $.ajax({
                    url: '<?php echo base_url("index.php/biroumum/idx_2"); ?>/',
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
                    }
                });
            })

            // $('#jenis').change(function(e){
            //     e.preventDefault();
            //     var jenis = $('#jenis').val();
            //     console.log(jenis);
            // })

            // $('#btn_tambah').click(function(e){
            //     // console.log('Hello');
            //     e.preventDefault();
            //    // getdatapermohonan();
            //    // getpgwai();
            // });

            // $('#jenis').change(function(e){
            //     e.preventDefault();
            //     var jenis = $('#jenis').val();
            //     // console.log(jenis);
            //     cek_jenis();
            // });

            // $('#btn-simpan').click(function(e){
            //     e.preventDefault();
            //     var sel = $('input[type=checkbox]:checked').map(function(_, el) {
            //         return $(el).val();
            //     }).get();
            //     getpgwaiwip(sel);
            //     $('#table_pegawai').show();
            //     $('input:checkbox').removeAttr('checked');
            //     // console.log(sel);
            //     // console.log(test);
            //     //alert(sel);
            // });

        //     $("#tbl-grid2").on('click','#deleteRow',function(e){
        //         e.preventDefault();
        //         $(this).closest('tr').remove();
        //     });

        //     $("#tbl-grid2").on('click','tr',function(e){
        //         e.preventDefault();
        //         var nrkPegawai = $(this).closest('tr').children('td:eq(0)').text();
        //         var namaPegawai = $(this).closest('tr').children('td:eq(1)').text();
        //         console.log(nrkPegawai + ' ' + namaPegawai);
        //         $('#nrk').val(nrkPegawai);
        //         $('#data_pegawai').val(namaPegawai);
        //     });

        //     function cek_jenis(){
        //         var jenis = $('#jenis').val();
        //         if(jenis == 1){
        //             $('#fungsional_pengangkatan').show();
        //             $('#fungsional_pengangkatan_kembali').hide();
        //             $('#fungsional_pembebasan').hide();
        //         }else if(jenis == 2){
        //             $('#fungsional_pengangkatan').hide();
        //             $('#fungsional_pembebasan').show();
        //             $('#fungsional_pengangkatan_kembali').hide();
        //         }else if(jenis == 3){
        //             $('#fungsional_pengangkatan').hide();
        //             $('#fungsional_pembebasan').hide();
        //             $('#fungsional_pengangkatan_kembali').show();
        //         }
        //     }

        // });

        // $('#data_2 .input-group.date').datepicker({
        //     todayBtn: "linked",
        //     keyboardNavigation: false,
        //     forceParse: false,
        //     calendarWeeks: true,
        //     autoclose: true,
        //     format: "dd-mm-yyyy",
        //     endDate: new Date()
        // }).on('changeDate', function(e) {
        // // Revalidate the date field
        // $('#defaultForm2').bootstrapValidator('revalidateField', 'tgakhir');
        // });

        function getdatapermohonan(){
            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';
            var jeniss = $('#jenis').val();
            var no_surat = $('#no_surat').val();
            var tgl_surat = $('#tgl_surat').val();
            //var nrk = $('#nrk').val();

            var dtbl= $('#tbl-grid').DataTable({
                /*"aoColumns": [
                    { "bSortable": false },
                    null,
                    null,

                    { "bSortable": false }
                ],*/
                destroy: true,
                responsive: false,
                "scrollX": true,
                "serverSide": true,
                "ajax": {
                    url: '<?php echo base_url("index.php/skpd/get_data_permohonan"); ?>/',
                    type: "post",
                    data: {
                        jenis: jeniss, no_surat: no_surat, tgl_surat: tgl_surat
                    },
                    beforeSend: function() {                        
                        $("#daftar_pegawai").html(spinner);
                    },
                    complete: function()
                    {
                         $("#daftar_pegawai").html('');
                    }
                }
                    
            });
             $('#tbl-grid_filter').css("display","none");//hide filtering
            // if(jenis != null || no_surat != null || tgl_surat != null || nrk != null){
                /*$.ajax({
                    url: '<?php echo base_url("index.php/skpd/get_data_permohonan"); ?>/',
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

        function getpgwai(){
            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';
            var spm = 'C180';
        

            var dtbl= $('#tbl-grid').DataTable({
                "aoColumns": [
                    { "bSortable": false },
                     { "bSortable": false },
                     { "bSortable": false }
                ],
                "paging": false,                
                "serverSide": true,
                "ajax": {
                    url: '<?php echo base_url("index.php/skpd/getListPegawai"); ?>/',
                    type: "post",
                    data: {
                        spm: spm
                    },
                    beforeSend: function() {                        
                        $("#daftar_pegawai").html(spinner);
                    },
                    complete: function()
                    {
                        $("#daftar_pegawai").html('');
                    }
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

