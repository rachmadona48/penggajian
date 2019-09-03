<style type="text/css">
    #displayText{
        font-size: 23px;
        color: #1ab394;
        font-weight: bold;
    }

    /*#page-wrapper{
        background: rgba(0, 0, 0, 0) url("/penggajian/assets/inspinia/css/patterns/shattered.png") repeat scroll 0 0;
    }*/

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
        right: 10px;
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

        #btnPdf{
            margin-top: 37px;
        }
    }

</style>    


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Laporan Listing</h2>
        <ol class="breadcrumb">
            <li>
                <?php if ($user_group == 4): ?>
                    <a href="<?php echo site_url('listing') ?>">Home</a>
                <?php elseif ($user_group == 2 || $user_group == 3 || $user_group == 11 || $user_group == 13): ?>
                    <a href="<?php echo site_url('listing') ?>">Home</a>
                <?php endif; ?>
            </li>
            <li class="active">
                <strong>Listing</strong>
            </li>
        </ol>
        <small><i>(Menu untuk mencetak laporan listing)</i></small>
    </div>
    <div class="col-lg-2">

    </div>
</div>


<div class="wrapper wrapper-content">
    <?php if ($user_group > 1) { ?>    
        <!-- START WELLCOME -->
        <div class="row">    
            <div class="col-md-12">
                <div class="ibox animated fadeInLeft">
                    <div class="ibox-title navy-bg">
                        <h5>Listing</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>                        
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row m-b-lg m-t-lg">
                            <div class="col-md-12">

                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <select class="form-control chosen-jenis" name="jenis" id="jenis" data-placeholder="Cari Berdasarkan...">
                                        

                                        <?php if($user_group == 52) { ?> <!-- jika group adalah skpd -->

                                            <?php if ($spmu == 'C040' || $spmu == 'C041') { ?> <!-- disdik-->
                                                <option value="0">Pilih Jenis Laporan</option>
                                                <option value="1">Gaji</option>
                                                <option value="2">TKD Guru Non Guru Pergub 108 (MEI 2016 - DES 2016)</option>
                                                <option value="3">TKD Guru Pergub 22 (MARET 2017 DST)</option>
                                                <option value="4">TKD Non Guru Pergub 108 (MEI 2016 DST)</option>
												<option value="7">TKD PLT Pergub 136 Tahun 2018 </option>
                                                <option value="5">PPH</option>
                                                <option value="6">Tunjangan Transport</option>
												<option value="8">Gaji PTT</option>
												<option value="9">TPP PTT</option>
                                                <option value="10">Gaji Susulan</option>
                                                <option value="11">Gaji Inputan (per NRK)</option>
                                                <option value="12">Rapel Gaji</option>
                                            <?php }else{ ?>
                                                <option value="0">Pilih Jenis Laporan</option>
                                                <option value="1">Gaji</option>
                                                <option value="2">TKD Pergub Nomor 409 Tahun 2017 (MARET 2016 - DES 2016)</option>
                                                <!-- <option value="3">TKD Guru Pergub 22 (MARET 2017 DST)</option> -->
                                                <option value="4">TKD Non Guru Pergub 108 (MARET 2016 DST)</option>
												<option value="7">TKD PLT Pergub 136 Tahun 2018 </option>
                                                <option value="5">PPH</option>
                                                <option value="6">Tunjangan Transport</option>
												<option value="8">Gaji PTT</option>
												<option value="9">TPP PTT</option>	
                                                <option value="10">Gaji Susulan</option>
                                                <option value="11">Gaji Inputan (per NRK)</option>
                                                <option value="12">Rapel Gaji</option>								
                                            <?php } ?>

                                        <?php }else{ ?>
                                            <option value="0">Pilih Jenis Laporan</option>
                                            <option value="1">Gaji</option>
                                            <option value="2">TKD Guru Pergub 108 (MARET 2016 - DES 2016)</option>
                                            <option value="3">TKD Guru Pergub 22 (MARET 2017 DST)</option>
                                            <option value="4">TKD Non Guru Pergub 108 (MARET 2016 DST)</option>
											<option value="7">TKD PLT Pergub 136 Tahun 2018 </option>
                                            <option value="5">PPH</option>
                                            <option value="6">Tunjangan Transport</option>
											<option value="8">Gaji PTT</option>
											<option value="9">TPP PTT</option>
                                            <option value="10">Gaji Susulan</option>
                                            <option value="11">Gaji Inputan (per NRK)</option>
											<option value="12">Rapel Gaji</option>
                                                    <!--<option value="3">Penghargaan</option>-->  
                                        <?php } ?>
                                        
                                    </select>
                                </div>                       

                                <br/><br/>
                                <div class="col-md-12">
                                    <button class="btn btn-primary pull-right" id="selanjutnya">Selanjutnya</button>
                                </div>


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

    $(document).ready(function() {
        $('#selanjutnya').click(function(e) {
            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';
            var content = '<div>Sedang Menarik Data, Tunggu Sebentar . . .</div>'
            e.preventDefault();
            var jenis = $('#jenis').val();

            //alert(jenis);
            var url = "";
            if (jenis == '0')
            {
                swal({type: "warning", title: "Pilih Jenis Laporan"});
                return false;
            }
            else if (jenis == '1')
            {
                url = '<?php echo "Listing/indexgaji"; ?>';
            }
            else if (jenis == '2')
            {
                url = '<?php echo "Listing/indextkdguru108"; ?>';
            }
            else if (jenis == '3')
            {
                url = '<?php echo "Listing/indextkdguru22"; ?>';
            }
            else if (jenis == '4')
            {
                url = '<?php echo "Listing/indextkdnonguru108"; ?>';
            }
            else if (jenis == '5')
            {
                url = '<?php echo "Listing/indexlistingpph"; ?>';
            }
            else if (jenis == '6')
            {
                url = '<?php echo "Listing/indexlistingtransport"; ?>';
            }
			 else if (jenis == '7')
            {
                url = '<?php echo "Listing/indextkdplt"; ?>';
			}
			 else if (jenis == '8')
            {
                url = '<?php echo "Listing/indexgajiptt"; ?>';	
            }
			else if (jenis == '9')
            {
                url = '<?php echo "Listing/indextppptt"; ?>';
            }
            else if (jenis == '10')
            {
                url = '<?php echo "Listing/gajisusulan"; ?>';
            }
            else if (jenis == '11')
            {
                url = '<?php echo "Listing/gaji_input_per_nrk"; ?>';
            }
            else if (jenis == '12')
            {
                url = '<?php echo "Listing/rapel_gaji"; ?>';
            }
            else
            {
                swal({type: "warning", title: "Pilihan Tidak Tersedia"});
                return false;
            }

            //alert(url);
            $.ajax({
                url: url,
                data: {
                    //jenis : jenis
                },
                type: 'post',
                dataType: 'html',
                beforeSend: function() {
                    $(".ibox-content").html(spinner);

                },
                success: function(data) {
                    $('.ibox-content').html(data);

                },
                complete: function() {

                }
            });
        })



    });


    /*START CHOSEN*/
    var config = {
        '.chosen-jenis': {search_contains: true, no_results_text: 'Oops, Data Tidak Ditemukan', width: "100%"},
        '.chosen-thbl': {search_contains: true, no_results_text: 'Oops, Data Tidak Ditemukan', width: "100%"},
        '.chosen-pnsiun': {search_contains: true, no_results_text: 'Oops, Data Tidak Ditemukan', width: "100%"},
        '.chosen-spmu': {search_contains: true, no_results_text: 'Oops, Data Tidak Ditemukan', width: "100%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
    /*END CHOSEN*/


</script>

