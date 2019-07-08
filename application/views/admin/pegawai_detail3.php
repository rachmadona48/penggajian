
<!--<link rel="stylesheet" href="--><?php //echo base_url()?><!--/assets/js/plugins/formValidation/css/formValidation.min.css">-->
<link href="<?php echo base_url()?>assets/inspinia/css/plugins/steps/jquery.steps.css" rel="stylesheet">
<link href="<?php echo base_url()?>assets/inspinia/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Profile</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>index.php">Home</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>index.php/report/laporan">Report</a>
            </li>
            <li class="active">
                <strong>Detail</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<style>
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

    #formPegawai .fileUpload2 {
        position: relative;
        overflow: hidden;
        margin: 10px;
        margin-top: 5px;
    }

    #formPegawai .fileUpload2 input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }

    #formPegawai #uploadFile2{
        background-color: #ffffff;
        background-image: none;
        border: 1px solid #e5e6e7;
        border-radius: 2px;
        color: inherit;
        /*display: block;*/
        font-size: 14px;
        padding: 6px 12px;
        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
        width: 60%;
    }

</style>


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <!--<button onclick="backPrevPage()">back</button>-->
                <form action="<?=site_url('report/laporan')?>" method="POST" style="display:none">
                    <input type="hidden" name="koloksrc" id="koloksrc" value="<?php echo $koloksrc;?>">
                    <input type="hidden" name="nrksrc" id="nrksrc" value="<?php echo $nrksrc;?>">
                    <input type="hidden" name="namasrc" id="namasrc" value="<?php echo $namasrc;?>">
                    <button type="submit" class="btn btn-primary btn-circle btn-lg" title="kembali"><i class="fa fa-arrow-circle-left"></i>
                    </button>
                </form>
                <div class="ibox-title navy-bg">
                    <h5>Detail Pegawai</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <!-- <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a> -->
                    </div>
                </div>
                <div class="ibox-content ibox-heading">

                    <div class="row">
                        <div class="col-lg-4">
                            <?php
                            //echo base_url('assets/img/photo/'.$NRK.'_thumb.jpg');
                            if (file_exists(FCPATH.'assets/img/photo/'.$NRK.'_thumb.jpg')){
                                echo '<img alt="image" class="img-circle" src="'.base_url('assets/img/photo/'.$NRK.'_thumb.jpg').'" style="padding:5px;float:left;margin-right: 13px;height:96px;width:96px;">';
                            } else {
                                echo '<img alt="image"  class="img-circle" src="'.base_url('assets/img/photo/profile_small.jpg').'" style="padding:5px;float:left;margin-right: 13px;height:96px;width:96px;">';
                            }
                            ?>

                            <h3> <?php echo isset($NAMA) ? $NAMA : "-"; ?>
                                <?php echo isset($TITEL) ? $TITEL : ""; ?></h3>
                            <h4><?php echo isset($NRK) ? $NRK : ""; ?></h4>
                            <small>
                                <?php echo $listKojab; ?><br><br>
                                <p><b>NIP NASIONAL :</b>
                                    <?php echo isset($NIP18) ? $NIP18 : "-"; ?>
                                    <br>
                                    <b>NIP :</b>
                                    <?php echo isset($NIP) ? $NIP : "-"; ?>
                                    <br>

                                </p>
                            </small>
                        </div>
                        <div class="col-lg-4">
                            <small>
                                <p><b>LOKASI KERJA :</b><br>
                                    <?php echo $listKolok; ?>
                                </p>
                                <p><b>LOKASI GAJI :</b><br>
                                    <?php echo $listKlogad; ?>
                                </p>
                                <p><b>SKPD :</b><br>
                                    <?php echo isset($SPMU) ? $listSpmu->NAMA : "-"; ?>
                                </p>
                            </small>
                        </div>
                        <div class="col-lg-4">
                            <small>
                                <p><b>ALAMAT :</b><br>
                                    <?php echo isset($ALAMAT) ? $ALAMAT : ""; ?>
                                    RT <?php echo isset($RT) ? $RT : ""; ?> / RW <?php echo isset($RW) ? $RW : ""; ?><br/>
                                    KELURAHAN  <?php echo $listKokel; ?><br/>
                                    KECAMATAN  <?php echo $listKocam; ?><br/>
                                    <?php echo $listKowil; ?> -  <?php echo $listProp; ?>
                                </p>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="feed-activity-list">

                        <div class="feed-element">
                            <div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <strong><p>DATA KEPEGAWAIAN</p></strong>
                                    </div>
                                </div>
                                <small>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <p><b>Status Pegawai :</b><br>
                                                <?php echo $listStapeg; ?>
                                            </p>
                                            <p><b>Jenis Pegawai :</b><br>
                                                <?php echo $listJenpeg; ?>
                                            </p>
                                            <p>
                                                <b>Terhitung Mulai Tanggal CPNS :</b><br>
                                                <?php echo isset($MUANG) ? date('d-m-Y', strtotime($MUANG)) : "-"; ?>
                                            </p>
                                            <p>
                                                <b>Terhitung Mulai Tanggal PNS :</b><br>
                                                <?php echo isset($TMT_STAPEG) ? date('d-m-Y', strtotime($TMT_STAPEG)) : "-"; ?>
                                            </p>
                                        </div>
                                        <div class="col-lg-4">
                                            <p><b>Terhitung Mulai Tanggal Mutasi :</b><br>
                                                <?php echo isset($TMTPINDAH) ? date('d-m-Y', strtotime($TMTPINDAH)) : "-"; ?>
                                            </p>
                                            <p><b>Masa Persiapan Pensiun (MPP) :</b><br>
                                                <?php echo isset($MPP)? (($MPP == 'Y') ? 'Ya' : 'Tidak'): 'checked'; ?>
                                            </p>
                                            <p><b>Tanggal Awal MPP :</b><br>
                                                <?php echo isset($TGLAMPP) ? date('d-m-Y', strtotime($TGLAMPP)) : "-"; ?>
                                            </p>
                                            <p><b>Tanggal Akhir MPP :</b><br>
                                                <?php echo isset($TGLEMPP) ? date('d-m-Y', strtotime($TGLEMPP)) : "-"; ?>
                                            </p>
                                        </div>
                                        <div class="col-lg-4">

                                            <p><b>Status Pindahan :</b><br>
                                                <?php echo isset($PINDAHAN)? (($PINDAHAN == 'Y') ? 'Ya' : 'Tidak'): '-'; ?>
                                            </p>
                                            <p><b>Kartu Pegawai :</b><br>
                                                <?php echo isset($KARPEG) ? $KARPEG : "-"; ?>
                                            </p>
                                            <p><b>Tabungan dan Asuransi Pegawai Negeri :</b><br>
                                                <?php echo isset($TASPEN) ? $TASPEN : "-"; ?>
                                            </p>

                                        </div>
                                    </div>
                                </small>
                            </div>
                        </div>
                        <div class="feed-element">
                            <div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <strong><p>DATA PRIBADI</p></strong>
                                    </div>
                                </div>
                                <small>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <p><b>NIK :</b><br>
                                                <?php echo isset($NOPPEN) ? $NOPPEN : "-"; ?>
                                            </p>
                                            <p><b>No. Kartu Keluarga :</b><br>
                                                <?php echo isset($NOKK) ? $NOKK : "-"; ?>
                                            </p>
                                            <p>
                                                <b>NPWP :</b><br>
                                                <?php echo isset($NPWP) ? $NPWP : "-"; ?>
                                            </p>
                                            <p>
                                                <b>NIP Pasif :</b><br>
                                                <?php echo isset($NIPPASIF) ? $NIPPASIF : "-"; ?>
                                            </p>
                                            <p>
                                                <b>Kartu Istri/Kartu Suami :</b><br>
                                                <?php echo isset($KARSU) ? $KARSU : "-"; ?>
                                            </p>
                                        </div>
                                        <div class="col-lg-4">
                                            <p><b>Tempat, Tgl. Lahir :</b><br>
                                                <?php echo isset($PATHIR) ? $PATHIR : "-"; ?>, <?php echo isset($TALHIR) ? date('d-m-Y', strtotime($TALHIR)) : "-"; ?>
                                            </p>
                                            <p><b>Agama :</b><br>
                                                <?php echo $listAgama; ?>
                                            </p>
                                            <p>
                                                <b>Jenis Kelamin :</b><br>
                                                <?php echo isset($JENKEL)? (($JENKEL == 'L') ? 'Laki-laki' : 'Perempuan'):'-'; ?>
                                            </p>
                                            <p>
                                                <b>Status Kawin :</b><br>
                                                <?php echo $listStawin; ?>
                                            </p>
                                            <p>
                                                <b>Gol. Darah :</b><br>
                                                <?php if(isset($DARAH)){ if($DARAH=="A"){echo "A"; } elseif($DARAH=="B"){echo "B";} elseif($DARAH=="AB"){echo "AB";} else{echo "O";}} else { echo "-";}?>
                                            </p>


                                        </div>
                                        <div class="col-lg-4">
                                            <p>
                                                <b>No. Telepon :</b><br>
                                                <?php echo isset($NOTELP) ? $NOTELP : "-"; ?>
                                            </p>
                                            <!-- <p>
                                                <b>No. Handphone :</b><br>
                                                <?php echo isset($NOHP) ? $NOHP : "-"; ?>
                                            </p> -->
                                            <p>
                                                <b>Email :</b><br>
                                                <?php echo isset($EMAIL) ? $EMAIL : "-"; ?>
                                            </p>

                                        </div>
                                    </div>
                                </small>
                            </div>
                        </div>

                        <div class="feed-element">
                            <div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <strong><p>LAINNYA</p></strong>
                                    </div>
                                </div>
                                <small>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <p><b>No. Ijazah :</b><br>
                                                <?php echo isset($NOIJAZAH) ? $NOIJAZAH : "-"; ?>
                                            </p>
                                            <p>
                                                <b>Jenis Pendidikan CPS :</b><br>
                                                <?php echo $listJendikcps; ?>
                                            </p>
                                            <p>
                                                <b>Pendidikan CPS :</b><br>
                                                <?php echo $listKodikcps; ?>
                                            </p>
                                        </div>
                                        <div class="col-lg-4">
                                            <p>
                                                <b>Status Aktif :</b><br>
                                                <?php echo isset($FLAG)? (($FLAG == '1') ? 'Aktif' : 'Tidak Aktif'): '-'; ?>
                                            </p>
                                        </div>
                                        <div class="col-lg-4">
                                            <p>
                                                <b>Status Hidup :</b><br>
                                                <?php echo isset($KDMATI)? (($KDMATI == 'T') ? 'Hidup' : 'Sudah Meninggal'): '-'; ?>
                                            </p>
                                            <p>
                                                <b>Tanggal Meninggal :</b><br>
                                                <?php echo isset($TGMATI) ? date('d-m-Y', strtotime($TGMATI)) : "-"; ?>
                                            </p>
                                        </div>

                                    </div>
                                </small>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div id="small-chat" style="display:none">
    <form style="display:none" method="POST" id="form_<?php ?>">
        <input type="hidden" name="nrk" id="nrk_<?php ?>" value="<?php ?>">
        <input type="hidden" class="thblBack" name="thbl" id="thbl_<?php  ?>" value="<?php ?>">
    </form>
    <a class="open-small-chat" title="Kembali" onClick="window.history.go(-1); return false;">
        <i class="fa fa-step-backward"></i>
    </a>

</div>

<!-- Custom and plugin javascript -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/inspinia.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/pace/pace.min.js"></script>
<!-- Custom and plugin javascript -->

<!-- Date Picker -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<!-- Date Picker -->

<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/select2/select2.full.min.js"></script>
<!-- Select2 -->


<!-- Validation -->
<!-- Steps -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/staps/jquery.steps.min.js"></script>
<!-- Jquery Validate -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/validate/jquery.validate.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){




        $("#kolok").on("change", function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?php echo base_url(); ?>index.php/home/getKojabSF",
                type: "post",
                data: {kolok : $('#kolok').val()},
                dataType: 'json',
                beforeSend: function() {
                    $('select#kojab').hide();
                },
                success: function(data) {
                    if(data.response == 'SUKSES'){
                        $('#kojab').html(data.listKojab);
                    }else{
                        $('#kojab').html('');
                    }

                },
                error: function(xhr) {
                    alert("Terjadi kesalahan. Silahkan coba kembali");
                },
                complete: function() {
                    $(".chosen-kojab").trigger("chosen:updated");
                }
            });
        });

        $("#kowil").on("change", function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?php echo base_url(); ?>index.php/home/getKecamatan",
                type: "post",
                data: {kowil : $('#kowil').val()},
                dataType: 'json',
                beforeSend: function() {

                },
                success: function(data) {
                    if(data.response == 'SUKSES'){
                        list = '<option value=""></option>' + data.list;
                        $('#kocam').html(list);
                    }else{
                        $('#kocam').html('');
                    }
                    $('#kokel').html('<option value=""></option>');
                },
                error: function(xhr) {
                    alert("Terjadi kesalahan. Silahkan coba kembali");
                },
                complete: function() {
                    $(".chosen-kecamatan").trigger("chosen:updated");
                    $(".chosen-kelurahan").trigger("chosen:updated");
                }
            });
        });

        $("#kocam").on("change", function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?php echo base_url(); ?>index.php/home/getKelurahan",
                type: "post",
                data: {kowil : $('#kowil').val(), kocam : $('#kocam').val()},
                dataType: 'json',
                beforeSend: function() {

                },
                success: function(data) {
                    if(data.response == 'SUKSES'){
                        list = '<option value=""></option>' + data.list;
                        $('#kokel').html(list);
                    }else{
                        $('#kokel').html('');
                    }

                },
                error: function(xhr) {
                    alert("Terjadi kesalahan. Silahkan coba kembali");
                },
                complete: function() {
                    $(".chosen-kelurahan").trigger("chosen:updated");
                }
            });
        });

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });

        $('#data_2 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });

        $('#data_3 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });

        $('#data_12 .input-group.date').datepicker({
            format: 'yyyy',
            viewMode: 'years',
            minViewMode: 'years'
        });

        $('#data_13 .input-group.date').datepicker({
            format: 'yyyy',
            viewMode: 'years',
            minViewMode: 'years'
        });

        $('#data_9 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });

        $('#data_8 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });

        $('#data_10 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });

        $('#data_11 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });


        $(".select2_kolok").select2({
            placeholder: "Pilih Lokasi"
        });
        $(".select2_klogad").select2({
            placeholder: "Pilih Lokasi Gaji"
        });
        $(".select2_kojab").select2({
            placeholder: "Pilih Jabatan"
        });
        $(".select2_jenpeg").select2({
            placeholder: "Pilih Jenis Pegawai"
        });
        $(".select2_induk").select2({
            placeholder: "Pilih Induk"
        });
        $(".select2_agama").select2({
            placeholder: "Pilih Agama"
        });
        $(".select2_stawin").select2({
            placeholder: "Pilih Status Kawin"
        });
        $(".select2_stapeg").select2({
            placeholder: "Pilih Status Pegawai"
        });

        $(".select2_kowil").select2({
            width: "100%",
            placeholder: "Pilih Wilayah"
        });
        $(".select2_kocam").select2({
            width: "100%",
            placeholder: "Pilih Kecamatan"
        });
        $(".select2_kokel").select2({
            width: "100%",
            placeholder: "Pilih Kelurahan"
        });
        $(".select2_prop").select2({
            width: "100%",
            placeholder: "Pilih Propinsi"
        });
        $(".select2_jendikcps").select2({
            width: "100%",
            placeholder: "Pilih Jenis Pendidikan CPS"
        });
        $(".select2_kodikcps").select2({
            width: "100%",
            placeholder: "Pilih Pendidikan CPS"
        });



    });

    function readURL2(input) {
        //alert('ok'+input.value);
        $("#uploadFile2").val(input.value);

        var ext = $('#uploadFile2').val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
            $("#m_allow2").hide();
            $("#m_error2").show();
            $("#blah2").hide();
        }else{
            $("#m_allow2").hide();
            $("#m_error2").hide();
            $("#blah2").show();

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah2').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


    }

    function backPrevPage()
    {
        var namasrc = document.getElementById('namasrc').value;
        var nrksrc = document.getElementById('nrksrc').value;
        var koloksrc = document.getElementById('koloksrc').value;
        window.history.go(-1);
    }

    function numbersonly1(myfield, e, dec)
    {
        var key;
        var keychar;
        if (window.event)
            key = window.event.keyCode;
        else if (e)
            key = e.which;
        else
            return true;
        keychar = String.fromCharCode(key);

        // control keys
        if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )
            return true;

        // numbers
        else if ((("0123456789").indexOf(keychar) > -1))
            return true;

        // decimal point jump
        else if (dec && (keychar == "."))
        {
            myfield.form.elements[dec].focus(); return false;
        }
        else
            return false;
    }


    function statusHidup() {
        if(document.getElementById('mshhidup').checked == true){
            document.getElementById('data_3').style.display = "none";
        }else{
            document.getElementById('data_3').style.display = "";
        }
    }

    function setSpmu(){
        klogad = $('#klogad').val();

        $.ajax({
            url: '<?php echo base_url("index.php/pegawai/getSpmuByKlogad"); ?>',
            type: "post",
            data: {
                klogad: klogad
            },
            dataType: 'text',
            beforeSend: function() {
                $('.msg').html('<div><div class="sk-spinner sk-spinner-rotating-plane"></div></div>');
                $('.err').html("");
            },
            success: function(data) {
                $('#spmu').val(data);
            },
            error: function(xhr) {
                $('.msg').html('');
                $('.err').html("<small>Terjadi kesalahan</small>");
            },
            complete: function() {

            }
        });
    }


</script>