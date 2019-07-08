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

    .form-group #riwayat_list:hover {background-color: rgba(0,0,0,0.08);}

    /*.modal-lg{
        width: 1024px !important;
    }*/


    /*Tampilkan pencarian di tampilan phone*/
    @media screen and (min-width: 770px){
        div#forPhone{
            display: none;
        }

        .modal-lg{
            width: 1024px !important;
        }
    }

</style>


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Dashboard</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url()?>">Home</a>
            </li>
            <li class="active">
                <strong>Index</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<!--    <div class="sidebard-panel">-->
<!--        <div class="m-t-md">-->
<!--            <h4>Statistik</h4>-->
<!--        </div>-->
<!--    </div>-->

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-9">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div>
                                        <span class="pull-right text-right">
                                        <small>Jumlah Pegawai per Golongan di <strong>DKI JAKARTA</strong></small>
                                            <br/>
                                            Total Pegawai: <?php echo number_format($tot_pegawai)?>
                                        </span>
                        <h1 class="m-b-xs"></h1>
                        <h3 class="font-bold no-margins">

                        </h3>
                        <small></small>
                    </div>

                    <div>
                        <canvas id="lineChart" height="70"></canvas>
                    </div>

                    <div class="m-t-md">
                        <small class="pull-right">
                            <i class="fa fa-clock-o"> </i>
                            Terakhir di update <?php echo date('d.m.Y'); ?>
                        </small>
                        <small>
                            <strong></strong>
                        </small>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">100%</span>
                    <h5>Total</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo number_format($tot_pegawai)?></h1>
                    <div class="stat-percent font-bold text-success">Pegawai</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"><?php echo $persen_pns?>%</span>
                    <h5>PNS</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo number_format($tot_pegawai_pns)?></h1>
                    <div class="stat-percent font-bold text-info">Orang</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"><?php echo $persen_cpns?>%</span>
                    <h5>CPNS</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><?php echo number_format($tot_pegawai_cpns)?></h1>
                    <div class="stat-percent font-bold text-info">Orang</div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Mainly scripts -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/jquery-2.1.1.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!-- Mainly scripts -->

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

<!-- ChartJS-->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/chartJs/Chart.min.js"></script>

<script>
    $(document).ready(function() {

        var lineData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "Example dataset",
                    fillColor: "rgba(220,220,220,0.5)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [65, 59, 80, 81, 56, 55, 40]
                },
                {
                    label: "Example dataset",
                    fillColor: "rgba(26,179,148,0.5)",
                    strokeColor: "rgba(26,179,148,0.7)",
                    pointColor: "rgba(26,179,148,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: [28, 48, 40, 19, 86, 27, 90]
                }
            ]
        };

        var lineOptions = {
            scaleShowGridLines: true,
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleGridLineWidth: 1,
            bezierCurve: true,
            bezierCurveTension: 0.4,
            pointDot: true,
            pointDotRadius: 4,
            pointDotStrokeWidth: 1,
            pointHitDetectionRadius: 20,
            datasetStroke: true,
            datasetStrokeWidth: 2,
            datasetFill: true,
            responsive: true,
        };


        var ctx = document.getElementById("lineChart").getContext("2d");
        var myNewChart = new Chart(ctx).Line(lineData, lineOptions);

    });
</script>