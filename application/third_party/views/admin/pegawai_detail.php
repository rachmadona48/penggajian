
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
                 <a href="<?php echo base_url(); ?>index.php/pegawai">Pegawai</a>
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

                <div class="ibox-title">
                    <h5>Detail Pegawai</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form  id="formPegawai" name="formPegawai" method="post" enctype="multipart/form-data">
                       
                        <fieldset>
                                <div class="row" style="padding:5px">
                                    <!--                                        kolom1-->
                                    <div class="col-lg-6">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>NRK</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo isset($NRK) ? $NRK : ""; ?>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>NIP Nasional</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                                    <?php echo isset($NIP18) ? $NIP18 : ""; ?> 
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>NIP</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                                    <?php echo isset($NIP) ? $NIP : ""; ?> 
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Lokasi Kerja</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo $listKolok; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Lokasi Gaji</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                               <?php echo $listKlogad; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>SKPD</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo isset($SPMU) ? $SPMU : ""; ?>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Jabatan</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                               <?php echo $listKojab; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Nama</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo isset($NAMA) ? $NAMA : ""; ?>,
                                                <?php echo isset($TITEL) ? $TITEL : ""; ?>
                                            </div>
                                        </div>                                        

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Tempat Lahir</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo isset($PATHIR) ? $PATHIR : ""; ?>
                                            </div>
                                        </div>                                        
                                       
                                       <div class="row">
                                            <div class="col-md-4">
                                                <label>Tanggal Lahir</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                                 <?php echo isset($TALHIR) ? date('d-m-Y', strtotime($TALHIR)) : ""; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Agama</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                                  <?php echo $listAgama; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Jenis Kelamin</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo isset($JENKEL)? (($JENKEL == 'L') ? 'Laki-laki' : 'Perempuan'):''; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Status Kawin</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                                 <?php echo $listStawin; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Status Pegawai</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                                 <?php echo $listStapeg; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Jenis Pegawai</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo $listJenpeg; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Terhitung Mulai Tanggal CPNS</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo isset($MUANG) ? date('d-m-Y', strtotime($MUANG)) : ""; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Terhitung Mulai Tanggal PNS</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo isset($TMT_STAPEG) ? date('d-m-Y', strtotime($TMT_STAPEG)) : ""; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>No Ijazah</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo isset($NOIJAZAH) ? $NOIJAZAH : ""; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>TBHBBMAS</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo isset($TBHBBMAS) ? $TBHBBMAS : ""; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Stat. Pindahan</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo isset($PINDAHAN)? (($PINDAHAN == 'Y') ? 'Ya' : 'Tidak'): ''; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Tg. Mutasi</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label>
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo isset($TMTPINDAH) ? date('d-m-Y', strtotime($TMTPINDAH)) : ""; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Masa Persiapan Pensiun (MPP)</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo isset($MPP)? (($MPP == 'Y') ? 'Ya' : 'Tidak'): 'checked'; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Tg Awal MPP</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo isset($TGLAMPP) ? date('d-m-Y', strtotime($TGLAMPP)) : ""; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Tg Akhir MPP</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo isset($TGLEMPP) ? date('d-m-Y', strtotime($TGLEMPP)) : ""; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Status Hidup</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo isset($KDMATI)? (($KDMATI == 'T') ? 'Hidup' : 'Sudah Meninggal'): ''; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Tg Meninggal</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-7">
                                                <?php echo isset($TGMATI) ? date('d-m-Y', strtotime($TGMATI)) : ""; ?>
                                            </div>
                                        </div>                                        

                                    </div>
                                    <!--                                    kolom 2-->
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Photo</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p class="text-center">
                                                    <img id="blah2" style="display:<?php if ($X_PHOTO){echo 'block';} else {echo 'none';} ?>;" src="<?php echo site_url('pegawai/tampilPhoto/'.$NRK); ?>" alt="" width="120" height="150"/>
                                                </p>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Kartu Pegawai</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo isset($KARPEG) ? $KARPEG : ""; ?>
                                            </div>
                                        </div>                                        
                                        
                                       <div class="row">
                                            <div class="col-md-3">
                                                <label>Tabungan dan Asuransi Pegawai Negeri</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo isset($TASPEN) ? $TASPEN : ""; ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Alamat</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo isset($ALAMAT) ? $ALAMAT : ""; ?>
                                                RT <?php echo isset($RT) ? $RT : ""; ?> / RW <?php echo isset($RW) ? $RW : ""; ?><br/>
                                               KELURAHAN  <?php echo $listKokel; ?><br/>
											   KECAMATAN  <?php echo $listKocam; ?><br/>
											   <?php echo $listKowil; ?> -  <?php echo $listProp; ?> 
                                            </div>
                                        </div>                                        
                                        
										<div class="row">
                                            <div class="col-md-3">
                                                <label>No. Telp</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-8">
                                               <?php echo isset($NOTELP) ? $NOTELP : ""; ?>
                                            </div>
                                        </div>
										
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>No. HP</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-8">
                                               <?php echo isset($NOHP) ? $NOHP : ""; ?>
                                            </div>
                                        </div>
                                        
                                         <div class="row">
                                            <div class="col-md-3">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-8">
                                               <?php echo isset($EMAIL) ? $EMAIL : ""; ?>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>NIK</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-8">
                                               <?php echo isset($NOPPEN) ? $NOPPEN : ""; ?>
                                            </div>
                                        </div>
										
										<div class="row">
                                            <div class="col-md-3">
                                                <label>No. Kartu Keluarga</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-8">
                                               <?php echo isset($NOKK) ? $NOKK : ""; ?>
                                            </div>
                                        </div>
										
										<div class="row">
                                            <div class="col-md-3">
                                                <label>No. Rekening</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-8">
                                               
                                            </div>
                                        </div>
										
										<div class="row">
                                            <div class="col-md-3">
                                                <label>Gol. Darah</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-8">
												<?php if(isset($DARAH)){ if($DARAH=="A"){echo "A"; } elseif($DARAH=="B"){echo "B";} elseif($DARAH=="AB"){echo "AB";} else{echo "O";}}?>
                                            </div>
                                        </div>
										
										<div class="row">
                                            <div class="col-md-3">
                                                <label>Kartu Istri/Kartu Suami</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-8">
                                             <?php echo isset($KARSU) ? $KARSU : ""; ?>
                                            </div>
                                        </div>
										
										<div class="row">
                                            <div class="col-md-3">
                                                <label>NPWP</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-8">
                                            <?php echo isset($NPWP) ? $NPWP : ""; ?>
                                            </div>
                                        </div>
										
										<div class="row">
                                            <div class="col-md-3">
                                                <label>Jenis Pendidikan CPS</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-8">
                                               <?php echo $listJendikcps; ?>
                                            </div>
                                        </div>
										
										<div class="row">
                                            <div class="col-md-3">
                                                <label>Pendidikan CPS</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-8">
                                              <?php echo $listKodikcps; ?>
                                            </div>
                                        </div>
										
										<div class="row">
                                            <div class="col-md-3">
                                                <label>NIP Pasif</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label>:</label> 
                                            </div>
                                            <div class="col-md-8">
                                              <?php echo isset($NIPPASIF) ? $NIPPASIF : ""; ?>
                                            </div>
                                        </div>

                                    </div> <!-- Akhir div col lg 6 -->
                                </div> <!--Akhir div row -->

                        </fieldset>         
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
<div id="small-chat" style="display:<?php ?>">
    <form style="display:none" method="POST" id="form_<?php ?>">
        <input type="hidden" name="nrk" id="nrk_<?php ?>" value="<?php ?>">
        <input type="hidden" class="thblBack" name="thbl" id="thbl_<?php  ?>" value="<?php ?>">
    </form>
    <a class="open-small-chat" title="Kembali" onClick="window.history.go(-1); return false;">
        <i class="fa fa-step-backward"></i>
    </a>
   
</div>
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