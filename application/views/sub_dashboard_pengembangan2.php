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

<?php if($user_group == 6){ ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Jenis Permohonan</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url().'tubkd'?>">Home</a>
            </li>
            <li>
                <a href="<?php echo site_url().'tubkd/subDashboardPengembangan1'?>">Permohonan</a>
            </li>
            <li class="active">
                <strong>Jenis Permohonan</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">Total</span>
                    <h5>Pengangkatan Dalam</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">40.886</h1>
                    <a href=""> <div class="stat-percent font-bold text-success">Lihat <i class="fa fa-level-down text-success"></i></div></a>
                    <small>Permohonan</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right">Total</span>
                    <h5>Pembebasan Sementara</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">0</h1>
                    <a href=""> <div class="stat-percent font-bold text-info">Lihat <i class="fa fa-level-down text-info"></i></div></a>
                    <small>Permohonan</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-primary pull-right">Total</span>
                    <h5>Pengangkatan Kembali</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">0</h1>
                    <a href=""> <div class="stat-percent font-bold text-navy">Lihat <i class="fa fa-level-down text-navy"></i></div></a>
                    <small>Permohonan</small>
                </div>
            </div>
        </div>
    </div>

</div>
<?php } ?>
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



<!-- Input Mask-->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/jasny/jasny-bootstrap.min.js"></script>

<!-- ChartJS-->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/chartJs/Chart.min.js"></script>
