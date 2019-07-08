<!--<link rel="stylesheet" href="--><?php //echo base_url()?><!--/assets/js/plugins/formValidation/css/formValidation.min.css">-->
<link href="<?php echo base_url()?>assets/inspinia/css/plugins/steps/jquery.steps.css" rel="stylesheet">
<link href="<?php echo base_url()?>assets/inspinia/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
<link href="<?php echo base_url()?>assets/inspinia/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Profile</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php site_url('pegawai');?>">Home</a>
            </li>
            <li class="active">
                <strong><?php echo isset($aksi) ? ($aksi == 'edit' ? "Edit" : "Tambah") : ""; ?></strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<style>

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

    .input-group-addon{
        background-color: #1ab394 !important;
        color: #fff !important;
    }

    label span.error{color:red; font-weight: normal;}

</style>


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Form Pegawai</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form  id="formPegawai" name="formPegawai" action="<?php echo $linkaction ?>" class="wizard-big" method="post" enctype="multipart/form-data">
                        <h1>Form Pegawai #1</h1>
                        <fieldset>
                                <div class="row" style="padding:5px">
                                    <!--                                        kolom1-->
                                    <div class="col-lg-6">
                                        <input type="hidden" id="ses" name="ses" value='<?php echo isset($ses) ? $ses : ""; ?>'>
                                        <div class="form-group">
                                            <label for="nrk">NRK </label>
                                            <input type="text" id="nrk" name="nrk" placeholder="nomor registrasi kepegawaian" value="<?php echo isset($NRK) ? $NRK : ""; ?>" class="form-control" onchange="setNRK(this.value);" 
                                            <?php //if ($aksi=='edit'){ echo "readonly";}?> maxlength="6" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="x_photo">Upload Foto </label>
                                                <div class="fileUpload2 btn input-group">
                                                    <input id="uploadFile2" name="namafile2" placeholder="Choose File" style="width: 100%;" readonly />
                                                    <span class="input-group-addon navy-bg">Upload</span><input id="uploadBtn2" name="x_photo" type="file" class="upload inline" onchange="readURL2(this);" />
                                                </div>

                                                <small id="m_allow2" style="font-size:12px;font-weight:bold;margin-top:-5px">Format : JPG, JPEG, dan PNG</small>
                                                <small id="m_error2" style="display:none;font-size:12px;color:red;margin-top:-5px">Format Salah (Format Yang Diizinkan : JPG, JPEG, dan PNG)</small>

                                            <p class="text-center">
                                            
                                                <img id="blah2" style="display:<?php if($aksi=='add'){ echo "none";} else{ if (file_exists('assets/img/photo/'.$NRK.'.jpg')){echo 'block';} else {echo 'none';} } ?>;" src="<?php echo base_url('assets/img/photo/'.$NRK.'.jpg'); ?>" alt="" width="170px" height="170px" />
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label for="nip">NIP* </label>
                                            <input type="text" id="nip" name="nip" placeholder="nomor induk pegawai" value="<?php echo isset($NIP) ? $NIP : '000000000'; ?>" class="form-control" maxlength="9">
                                        </div>
                                        <div class="form-group">
                                            <label for="nip18">NIP-Nasional* </label>
                                            <input type="text" id="nip18" name="nip18" placeholder="000000000000000000" value="<?php echo isset($NIP18) ? $NIP18 : ""; ?>" class="form-control" maxlength="18">
                                        </div>
                                        <div class="form-group">
                                            <label for="stapeg">Status Pegawai* </label>
                                            <select class="form-control select2_stapeg" name="stapeg" id="stapeg" style="width:99%">
                                                <option></option>
                                                <?php echo $listStapeg; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenpeg">Jenis Pegawai* </label>
                                            <select class="form-control select2_jenpeg" name="jenpeg" id="jenpeg" style="width:99%">
                                                <option></option>
                                                <?php echo $listJenpeg; ?>
                                            </select>
                                        </div>

                                        <div class="form-group" id="data_89" style="display: none">
                                            <label for="tmttitipan">TMT Titipan </label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmttitipan" name="tmttitipan" placeholder="dd-mm-yyyy" value="<?php echo isset($TMTTITIPAN) ? date('d-m-Y', strtotime($TMTTITIPAN)) : ""; ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group" <?php if ($aksi=='add'){ echo 'style="display:none"';}?>>
                                            <label for="kolok">Lokasi Kerja </label>
                                                <div id="kolok_hidup">
                                                    <select class="form-control" name="kolok" id="kolok" style="width:99%" readonly>
                                                        <option></option>
                                                        <?php echo $listKolok; ?>
                                                    </select>
                                                </div>
                                                <div id="kolok_mati" style="display:none">
                                                     <select class="form-control" name="kolok2" id="kolok2" style="width:99%" readonly>
                                                        <option></option>
                                                        <?php echo $listKolokMati; ?>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="form-group" <?php if ($aksi=='add'){ echo 'style="display:none"';}?>>
                                            <label for="klogad">Lokasi Gaji</label>
                                                <select class="form-control" name="klogad" id="klogad" style="width:99%" onchange="setSpmu()">
                                                    <option></option>
                                                    <?php echo $listKlogad; ?>
                                                </select>
                                        </div>
                                        <div class="form-group" <?php if ($aksi=='add'){ echo 'style="display:none"';}?>>
                                            <label for="spmu">SKPD </label>
                                                <input type="hidden" id="spmu" name="spmu" placeholder="satuan kerja perangkat daerah" value="<?php echo isset($SPMU) ? $SPMU : ""; ?>" class="form-control" maxlength="4" readonly >

                                                <input type="text" id="spmu2" name="spmu2" placeholder="satuan kerja perangkat daerah"  class="form-control"  readonly>
                                        </div>
                                        <div class="form-group" <?php if ($aksi=='add'){ echo 'style="display:none"';}?>>
                                            <label for="kojab">Jabatan </label>
                                            <select class="form-control" name="kojab" id="kojab" style="width:99%" readonly>
                                                <option></option>
                                                <?php echo $listKojab; ?>
                                            </select>
                                        </div>
                                        <div class="form-group" style="display: none">
                                            <label for="kklogad">Kelompok Lokasi Gaji </label>
                                                <input type="text" id="kklogad" name="kklogad" placeholder="" value="<?php echo isset($KKLOGAD) ? $KKLOGAD : ""; ?>" class="form-control" maxlength="1">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama* </label>
                                                <input type="text" style="text-transform:uppercase" id="nama" name="nama" placeholder="Nama Lengkap" value="<?php echo isset($NAMA) ? $NAMA : ""; ?>" class="form-control" maxlength="100" onchange="setNama(this.value)">
                                        </div>
                                        <div class="form-group" style="display: none;">
                                            <label for="titel">Titel </label>
                                                <input type="text" style="text-transform:uppercase" id="titel" name="titel" placeholder="" value="<?php echo isset($TITEL) ? $TITEL : ""; ?>" class="form-control" maxlength="25">
                                        </div>
                                        <div class="form-group">
                                            <label for="pathir">Tempat Lahir* </label>
                                                <input type="text" style="text-transform:uppercase" id="pathir" name="pathir" placeholder="Tempat Lahir" value="<?php echo isset($PATHIR) ? $PATHIR : ""; ?>" class="form-control" maxlength="20">
                                        </div>
                                        <div class="form-group" id="data_9">
                                            <label for="talhir">Tgl. Lahir* </label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="talhir" name="talhir" placeholder="dd-mm-yyyy" value="<?php echo isset($TALHIR) ? date('d-m-Y', strtotime($TALHIR)) : ""; ?>" class="form-control">
                                            </div>
                                        </div>


                                    </div>
                                    <!--                                    kolom 2-->
                                    <div class="col-lg-6">
                                        <!--                                            <div class="form-group">-->
                                        <!--                                                <label>INDUK</label>-->
                                        <!--                                                    <select class="form-control select2_induk" name="induk" id="induk" style="width:99%">-->
                                        <!--                                                        <option></option>-->
                                        <!--                                                        --><?php //echo $listInduk; ?>
                                        <!--                                                    </select>-->
                                        <!--                                            </div>-->
                                        <div class="form-group" id="data_2">
                                            <label for="muang">Terhitung Mulai Tanggal CPNS* </label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="muang" name="muang" placeholder="dd-mm-yyyy" value="<?php echo isset($MUANG) ? date('d-m-Y', strtotime($MUANG)) : ""; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" id="data_1">
                                            <label for="tmt_stapeg">Terhitung Mulai Tanggal PNS </label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmt_stapeg" name="tmt_stapeg" placeholder="dd-mm-yyyy" value="<?php echo isset($TMT_STAPEG) ? date('d-m-Y', strtotime($TMT_STAPEG)) : ""; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" style="display:none">
                                            <label for="noijazah">No. Ijazah </label>
                                                <input type="text" id="noijazah" name="noijazah" placeholder="" value="<?php echo isset($NOIJAZAH) ? $NOIJAZAH : ""; ?>" class="form-control" maxlength="20">
                                        </div>
                                        <div class="form-group">
                                            <label for="agama">Agama* </label>
                                            <select class="form-control select2_agama" name="agama" id="agama" style="width:99%">
                                                <option></option>
                                                <?php echo $listAgama; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <p><label for="jenkel">Jenis Kelamin </label></p>
                                            <div class="radio radio-success radio-inline">
                                                <input type="radio" id="jenkel" value="L" name="jenkel" <?php echo isset($JENKEL)? (($JENKEL == 'L') ? 'checked' : ''): 'checked'; ?>>
                                                <label for="jenkel"> Laki-laki </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <input type="radio" id="jenkel" value="P" name="jenkel" <?php echo isset($JENKEL)? (($JENKEL == 'P') ? 'checked' : ''):''; ?>>
                                                <label for="jenkel"> Perempuan </label>
                                            </div>
                                        </div>
                                        <div class="form-group" <?php if ($aksi=='add'){ echo 'style="display:none"';}?>>
                                            <label for="stawin">Status Kawin </label>
                                            <select class="form-control" name="stawin" id="stawin" style="width:99%">
                                                <option></option>
                                                <?php echo $listStawin; ?>
                                            </select>
                                        </div>
                                        <!--                                            <div class="form-group">-->
                                        <!--                                                <label>No. Tunggu</label>-->
                                        <!--                                                    <input type="text" id="notunggu" name="notunggu" placeholder="" value="--><?php //echo isset($notunggu) ? $notunggu : "1"; ?><!--" class="form-control" maxlength="20">-->
                                        <!--                                            </div>-->
                                        <!--                                            <div class="form-group" id="data_3">-->
                                        <!--                                                <label>Tgl. Tunggu</label>-->
                                        <!--                                                <div class="input-group date">-->
                                        <!--                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgtunggu" name="tgtunggu" placeholder="" value="--><?php //echo isset($tgakhtung) ? date('d-m-Y', strtotime($tgakhtung)) : "11-01-2016"; ?><!--" class="form-control">-->
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                        <!--                                            <div class="form-group" id="data_8">-->
                                        <!--                                                <label>TGAKHTUNG</label>-->
                                        <!--                                                <div class="input-group date">-->
                                        <!--                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgakhtung" name="tgakhtung" placeholder="" value="--><?php //echo isset($tgakhtung) ? date('d-m-Y', strtotime($tgakhtung)) : "11-01-2016"; ?><!--" class="form-control">-->
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                        <!--                                            <div class="form-group">-->
                                        <!--                                                <label>TBHTTMAS</label>-->
                                        <!--                                                    <input type="text" id="tbhttmas" name="tbhttmas" placeholder="" value="--><?php //echo isset($tbhttmas) ? $tbhttmas : "1"; ?><!--" class="form-control" maxlength="2">-->
                                        <!--                                            </div>-->
                                        <div class="form-group" style="display:none">
                                            <label for="tbhbbmas">TBHBBMAS </label>
                                                <input type="text" id="tbhbbmas" name="tbhbbmas" placeholder="" value="<?php echo isset($TBHBBMAS) ? $TBHBBMAS : ""; ?>" class="form-control" maxlength="2">
                                        </div>
                                        <!--                                            <div class="form-group">-->
                                        <!--                                                <label>Tunda</label>-->
                                        <!--                                                    <input type="text" id="tunda" name="tunda" placeholder="" value="--><?php //echo isset($tunda) ? $tunda : "1"; ?><!--" class="form-control" maxlength="1">-->
                                        <!--                                            </div>-->
                                        <div class="input-group">
                                            <p><label for="pindahan">Status Pindahan </label></p>
                                            <div class="radio radio-inline">
                                                <input onChange="showAndDeadPindahan()" type="radio" id="pindahan" value="T" name="pindahan" <?php echo isset($PINDAHAN)? (($PINDAHAN == 'T') ? 'checked' : ''):'checked'; ?>>
                                                <label for="pindahan"> Tidak </label>
                                            </div>
                                            <div class="radio radio-success radio-inline">
                                                <input onChange="showAndDeadPindahan()" type="radio" id="pindahan" value="Y" name="pindahan" <?php echo isset($PINDAHAN)? (($PINDAHAN == 'Y') ? 'checked' : ''): ''; ?>>
                                                <label for="pindahan"> Ya </label>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group" id="data_11">
                                            <label for="tmtpindah">Terhitung Mulai Tanggal Mutasi dari luar DKI ke DKI </label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tmtpindah" name="tmtpindah" placeholder="dd-mm-yyyy" value="<?php echo isset($TMTPINDAH) ? date('d-m-Y', strtotime($TMTPINDAH)) : ""; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <p><label for="mpp">Masa Persiapan Pensiun (MPP) </label></p>
                                            <div class="radio radio-inline">
                                                <input onChange="showAndDead()" type="radio" id="mpp" value="T" name="mpp" <?php echo isset($MPP)? (($MPP == 'T') ? 'checked' : ''):'checked'; ?>>
                                                <label for="mpp"> Tidak </label>
                                            </div>
                                            <div class="radio radio-success radio-inline">
                                                <input onChange="showAndDead()" type="radio" id="mpp" value="Y" name="mpp" <?php echo isset($MPP)? (($MPP == 'Y') ? 'checked' : ''): ''; ?>>
                                                <label for="mpp"> Ya </label>
                                            </div>                                            
                                        </div>
                                        <div class="form-group" id="data_10">
                                            <label for="tglampp">Terhitung Mulai Tanggal Awal MPP </label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tglampp" name="tglampp" placeholder="dd-mm-yyyy" value="<?php echo isset($TGLAMPP) ? date('d-m-Y', strtotime($TGLAMPP)) : ""; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group" id="data_14">
                                            <label for="tglempp">Terhitung Mulai Tanggal Akhir MPP</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tglempp" name="tglempp" placeholder="dd-mm-yyyy" value="<?php echo isset($TGLEMPP) ? date('d-m-Y', strtotime($TGLEMPP)) : ""; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <p><label for="mpp">Status Hidup</label></p>
                                            <input type="hidden" name="flag" id="flag" value="1">                                            
                                            <div class="radio radio-success radio-inline">
                                                <input type="radio" id="kdmati" value="T" name="kdmati" <?php echo isset($KDMATI)? (($KDMATI == 'T' || $KDMATI == ' ') ? 'checked' : ''):'checked'; ?> onchange="setTgMati()">

                                                <label for="kdmati"> Ya </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <input type="radio" id="kdmati" value="Y" name="kdmati" <?php echo isset($KDMATI)? (($KDMATI == 'Y') ? 'checked' : ''): ''; ?> onchange="setTgMati()">
                                                <label for="kdmati"> Tidak (Meninggal) </label>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="form-group" id="data_3" style="display:none">
                                            <label for="tgmati">Tgl. Meninggal</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar "></i></span><input type="text" id="tgmati" name="tgmati" placeholder="dd-mm-yyyy" value="<?php echo isset($TGMATI) ? date('d-m-Y', strtotime($TGMATI)) : ""; ?>" class="form-control">
                                                <input type="hidden" id="temptgmati" value="<?php echo isset($TGMATI) ? date('d-m-Y', strtotime($TGMATI)) : ""; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="tmtpensiun">TMT PENSIUN </label>
                                            <input type="text" id="tmtpensiun" name="tmtpensiun" placeholder="tmt pensiun" value="<?php echo isset($TMTPENSIUN) ? $TMTPENSIUN : ''; ?>" class="form-control" readonly>
                                        </div>


                                    </div>
                                </div>

                        </fieldset>
                        <h1>Form Pegawai #2</h1>
                        <fieldset>
                                <div class="row" style="padding:5px">
                                    <!--                                        kolom 1-->
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="nrk2">NRK* </label>
                                            <input type="text" id="nrk2" name="nrk2" placeholder="Nomor Registrasi Kepegawaian" value="<?php echo isset($NRK) ? $NRK : ""; ?>" class="form-control" maxlength="6" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama2">Nama </label>
                                            <input type="text" style="text-transform:uppercase" id="nama2" name="nama2" placeholder="" value="<?php echo isset($NAMA) ? $NAMA : ""; ?>" class="form-control" maxlength="100" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="karpeg">Kartu Pegawai </label>
                                                <input type="text" id="karpeg" name="karpeg" placeholder="" value="<?php echo isset($KARPEG) ? trim($KARPEG) : ""; ?>" class="form-control" minlength="7" maxlength="7">
                                        </div>
                                        <div class="form-group">
                                            <label for="taspen">Tabungan dan Asuransi Pegawai Negeri (TASPEN)* </label>
                                                <input type="text" onkeypress="return numbersonly1(this, event)" id="taspen" maxlength="18" name="taspen" placeholder="" value="<?php echo isset($TASPEN) ? $TASPEN : ""; ?>" class="form-control"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                        </div>
                                        <!--                                            <div class="form-group">-->
                                        <!--                                                <label>ALIRAN</label>-->
                                        <!--                                                    <select class="form-control" name="aliran" id="aliran">-->
                                        <!--                                                        <option></option>-->
                                        <!--                                                        <option value="Y" selected>Ya</option>-->
                                        <!--                                                        <option value="T">Tidak</option>-->
                                        <!--                                                    </select>-->
                                        <!--                                            </div>-->
                                        <div class="form-group">
                                            <label for="alamat">Alamat Tempat Tinggal </label>
                                                <textarea id="alamat" name="alamat" class="form-control" style="text-transform:uppercase"><?php echo isset($ALAMAT) ? trim($ALAMAT) : ""; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="rt">RT </label>
                                            <div class="input-group">
                                                <input type="text" onkeypress="return numbersonly1(this, event)" id="rt" name="rt" placeholder="" value="<?php echo isset($RT) ? $RT : ""; ?>" class="form-control" maxlength="3" style="width:100px">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="rw">RW </label>
                                            <div class="input-group">
                                                <input type="text" onkeypress="return numbersonly1(this, event)" id="rw" name="rw" placeholder="" value="<?php echo isset($RW) ? $RW : ""; ?>" class="form-control" maxlength="3" style="width:100px">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="prop">Propinsi </label>
                                            <select class="form-control select2_prop" name="prop" id="prop">
                                                <?php echo isset($valProp) ? $valProp : ""; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kowil">Kota/Kabupaten </label>
                                            <select class="form-control select2_kowil" name="kowil" id="kowil">
                                                <?php echo isset($valKowil) ? $valKowil : ""; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kocam">Kecamatan </label>
                                            <select class="form-control select2_kocam" name="kocam" id="kocam">
                                                <?php echo isset($valKocam) ? $valKocam : ""; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kokel">Kelurahan </label>
                                            <select class="form-control select2_kokel" name="kokel" id="kokel">
                                                <?php echo isset($valKokel) ? $valKokel : ""; ?>
                                            </select>                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat_ktp">Alamat KTP </label><br>
                                            <label>
                                                <input id="sama_almt" name="sama_almt" type="checkbox" value="1" onclick="samakanAlamat()">
                                                Samakan dengan alamat tempat tinggal
                                            </label>
                                                <textarea id="alamat_ktp" name="alamat_ktp" class="form-control" style="text-transform:uppercase"><?php echo isset($ALAMAT_KTP) ? trim($ALAMAT_KTP) : ""; ?></textarea>
                                        </div>
                                        <div class="form-group" id="div_rt_ktp">
                                            <label for="rt_ktp">RT </label>
                                            <div class="input-group">
                                                <input type="text" onkeypress="return numbersonly1(this, event)" id="rt_ktp" name="rt_ktp" placeholder="" value="<?php echo isset($RT_KTP) ? $RT_KTP : ""; ?>" class="form-control" maxlength="3" style="width:100px">
                                            </div>
                                        </div>
                                        <div class="form-group" id="div_rw_ktp">
                                            <label for="rw_ktp">RW </label>
                                            <div class="input-group">
                                                <input type="text" onkeypress="return numbersonly1(this, event)" id="rw_ktp" name="rw_ktp" placeholder="" value="<?php echo isset($RW_KTP) ? $RW_KTP : ""; ?>" class="form-control" maxlength="3" style="width:100px">
                                            </div>
                                        </div>
                                        <div class="form-group" id="div_prop_ktp">
                                            <label for="prop_ktp">Propinsi </label>
                                            <select class="form-control select2_prop_ktp" name="prop_ktp" id="prop_ktp">
                                                <?php echo isset($valPropKtp) ? $valPropKtp : ""; ?>
                                            </select>
                                        </div>
                                        <div class="form-group" id="div_wil_ktp">
                                            <label for="kowil_ktp">Wilayah </label>
                                            <select class="form-control select2_kowil_ktp" name="kowil_ktp" id="kowil_ktp">
                                                <?php echo isset($valKowilKtp) ? $valKowilKtp : ""; ?>
                                            </select>
                                        </div>
                                        <div class="form-group"  id="div_kec_ktp">
                                            <label for="kocam">Kecamatan </label>
                                            <select class="form-control select2_kocam_ktp" name="kocam_ktp" id="kocam_ktp">
                                                <?php echo isset($valKocamKtp) ? $valKocamKtp : ""; ?>
                                            </select>
                                        </div>
                                        <div class="form-group"  id="div_kel_ktp">
                                            <label for="kokel">Kelurahan </label>
                                            <select class="form-control select2_kokel_ktp" name="kokel_ktp" id="kokel_ktp">
                                                <?php echo isset($valKokelKtp) ? $valKokelKtp : ""; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!--kolom 2-->
                                    <div class="col-sm-12 col-md-6">
                                        
                                        <div class="form-group">
                                            <label for="nohp">No. HP </label>
                                                <input type="text" onkeypress="return numbersonly1(this, event)" id="nohp" name="nohp" placeholder="" value="<?php echo isset($NOHP) ? $NOHP : ""; ?>" class="form-control" maxlength="13"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email </label>
                                                <input type="text" style="text-transform:lowercase" id="email" name="email" placeholder="" value="<?php echo isset($EMAIL) ? $EMAIL : ""; ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="notelp">No. Telp Rumah </label>
                                                <input type="text" onkeypress="return numbersonly1(this, event)" id="notelp" name="notelp" placeholder="" value="<?php echo isset($NOTELP) ? $NOTELP : ""; ?>" class="form-control" maxlength="25"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                        </div>
                                        <!--                                            <div class="form-group">-->
                                        <!--                                                <label>FORDAERAH</label>-->
                                        <!--                                                    <select class="form-control" name="fordaerah" id="fordaerah">-->
                                        <!--                                                        <option></option>-->
                                        <!--                                                        <option value="Y" selected>Ya</option>-->
                                        <!--                                                        <option value="T">Tidak</option>-->
                                        <!--                                                    </select>-->
                                        <!--                                            </div>-->
                                        <div class="form-group">
                                            <label for="noppen">NIK* </label>
                                                <input type="text" onkeypress="return numbersonly1(this, event)" id="noppen" name="noppen" placeholder="Nomor Induk Kependudukan (KTP)" value="<?php echo isset($NOPPEN) ? $NOPPEN : ""; ?>" class="form-control" maxlength="16">
                                        </div>
                                        <div class="form-group">
                                            <label for="nokk">No. Kartu Keluarga </label>
                                                <input type="text" id="nokk" name="nokk" placeholder="" value="<?php echo isset($NOKK) ? $NOKK : ""; ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="simpeda">No. Rekening </label>
                                                <input type="text" onkeypress="return numbersonly1(this, event)" id="simpeda" name="simpeda" placeholder="" value="<?php echo isset($SIMPEDA) ? $SIMPEDA : ""; ?>" class="form-control" maxlength="11" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                        </div>
                                        <div class="form-group">
                                            <p><label for="darah">DARAH* </label></p>
                                            <div class="radio radio-success radio-inline">
                                                <input type="radio" id="darah" value="A" name="darah" <?php echo isset($DARAH)? ((trim($DARAH) == 'A') ? 'checked' : ''): 'checked'; ?>>
                                                <label for="darah"> A </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <input type="radio" id="darah" value="B" name="darah" <?php echo isset($DARAH)? ((trim($DARAH) == 'B') ? 'checked' : ''):''; ?>>
                                                <label for="darah"> B </label>
                                            </div>
                                            <div class="radio radio-success radio-inline">
                                                <input type="radio" id="darah" value="AB" name="darah" <?php echo isset($DARAH)? ((trim($DARAH) == 'AB') ? 'checked' : ''): 'checked'; ?>>
                                                <label for="darah"> AB </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <input type="radio" id="darah" value="O" name="darah" <?php echo isset($DARAH)? ((trim($DARAH) == 'O') ? 'checked' : ''):''; ?>>
                                                <label for="darah"> O </label>
                                            </div>
                                        </div>
                                        <!--                                            <div class="form-group">-->
                                        <!--                                                <label>HUSBAKTI</label>-->
                                        <!--                                                    <input type="text" id="husbakti" name="husbakti" placeholder="" value="--><?php //echo isset($nip) ? $nip : "123456789"; ?><!--" class="form-control">-->
                                        <!--                                            </div>-->
                                        <div class="form-group">
                                            <label for="karsu">Kartu Istri/Kartu Suami </label>
                                                <input type="text" id="karsu" name="karsu" placeholder="" value="<?php echo isset($KARSU) ? $KARSU : ""; ?>" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="npwp">NPWP </label>
                                                <input type="text" id="npwp" name="npwp" placeholder="" value="<?php echo isset($NPWP) ? $NPWP : ""; ?>" class="form-control" data-mask="99.999.999.9-999.999">
                                                <span class="help-block">99.999.999.9-999.999</span>

                                        </div>
                                        <div class="form-group">
                                            <label for="jendikcps">Jenis Pendidikan CPNS* </label>
                                                <select class="form-control select2_jendikcps" name="jendikcps" id="jendikcps">
                                                    
                                                    <?php echo $listJendikcps; ?>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kodikcps">Pendidikan CPNS* </label>
                                                <select class="form-control select2_kodikcps" name="kodikcps" id="kodikcps">
                                                    <option></option>
                                                    <?php echo $listKodikcps; ?>
                                                </select>
                                        </div>
                                        <div class="form-group" style="display:none">
                                            <label for="nippasif">NIP Pasif </label>
                                                <input type="text" id="nippasif" name="nippasif" placeholder="" value="<?php echo isset($NIPPASIF) ? $NIPPASIF : ""; ?>" class="form-control">
                                        </div>
                                        <!--                                            <div class="form-group">-->
                                        <!--                                                <label>FORPUSAT</label>-->
                                        <!--                                                    <select class="form-control" name="forpusat" id="forpusat">-->
                                        <!--                                                        <option></option>-->
                                        <!--                                                        <option value="Y" selected>Ya</option>-->
                                        <!--                                                        <option value="T">Tidak</option>-->
                                        <!--                                                    </select>-->
                                        <!--                                            </div>-->
                                        <!--                                            <div class="form-group" id="data_12">-->
                                        <!--                                                <label>THFORPUS</label>-->
                                        <!--                                                <div class="input-group col-sm-7 date">-->
                                        <!--                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="thforpus" name="thforpus" placeholder="" value="--><?php //echo isset($thforpus) ? $thforpus : "1234"; ?><!--" class="form-control">-->
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                        <!--                                            <div class="form-group" id="data_13">-->
                                        <!--                                                <label>THFORDRH</label>-->
                                        <!--                                                <div class="input-group col-sm-7 date">-->
                                        <!--                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="thfordrh" name="thfordrh" placeholder="" value="--><?php //echo isset($thfordrh) ? $thfordrh : "2016"; ?><!--" class="form-control">-->
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                    </div>
                                </div>
                        </fieldset>
                    </form>
                    <p><span class="label label-info">* &nbsp; Harus diisi</span></p>

                </div>


            </div>
        </div>
    </div>
</div>

<!-- Date Picker -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/datapicker/bootstrap-datepicker.js"></script>
<!-- Date Picker -->

<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/select2/select2.full.min.js"></script>
<!-- Select2 -->

<!-- Custom and plugin javascript -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/inspinia.js"></script>
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/pace/pace.min.js"></script>
<!-- Custom and plugin javascript -->

<!-- Input Mask-->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/jasny/jasny-bootstrap.min.js"></script>

<!-- Validation -->
<!-- Steps -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/staps/jquery.steps.min.js"></script>
<!-- Jquery Validate -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/validate/jquery.validate.min.js"></script>

<!-- Sweet alert -->
<script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
        //$('#checkbox').is(':checked'); 
        setTgMati();
    	showTMT();
        showAndDead();
        showAndDeadPindahan();
        showHideCekSamakan();
        setSpmu();
       /* if($('#spmu').val!=null)
        {
            getNamaSpmu();    
        }*/
        


        errmsg = "<?php echo $this->session->flashdata('errmsg'); ?>";
        if (errmsg !=''){
            swal({
                title: "Gagal!",
                text: "Data pegawai gagal disimpan. "+errmsg,
                type: "error"
            });
        }

        $("#wizard").steps();
        $("#formPegawai").steps({
            bodyTag: "fieldset",
            onStepChanging: function (event, currentIndex, newIndex)
            {
                // Always allow going backward even if the current step contains invalid fields!
                if (currentIndex > newIndex)
                {
                    return true;
                }

                // Forbid suppressing "Warning" step if the user is to young
                if (newIndex === 3 && Number($("#age").val()) < 18)
                {
                    return false;
                }

                var form = $(this);

                // Clean up if user went backward before
                if (currentIndex < newIndex)
                {
                    // To remove error styles
                    $(".body:eq(" + newIndex + ") label.error", form).remove();
                    $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                }

                // Disable validation on fields that are disabled or hidden.
                form.validate().settings.ignore = ":disabled,:hidden";

                // Start validation; Prevent going forward if false
                return form.valid();
            },
            onStepChanged: function (event, currentIndex, priorIndex)
            {

                // Suppress (skip) "Warning" step if the user is old enough.
                if (currentIndex === 2 && Number($("#age").val()) >= 18)
                {
                    $(this).steps("next");
                }

                // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                if (currentIndex === 2 && priorIndex === 3)
                {
                    $(this).steps("previous");
                }
                // alert(currentIndex);
                if (currentIndex == 0){
                    $( "a[href='#finish']" ).hide();
                } else {
                    $( "a[href='#finish']" ).show();
                }
            },
            onFinishing: function (event, currentIndex)
            {
                var form = $(this);

                // Disable validation on fields that are disabled.
                // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                form.validate().settings.ignore = ":disabled";

                // Start validation; Prevent form submission if false
                return form.valid();
            },
            onFinished: function (event, currentIndex)
            {
                var form = $(this);

                // Submit form input
                form.submit();
            },
            onCanceled: function (event)
            {
                var form = $(this);
                history.go(-1);
            }
        }).validate({
            onfocusout: false,
            invalidHandler: function(form, validator){
                var errors = validator.numberOfInvalids();
                if (errors){
                    validator.errorList[0].element.focus();
                }
            },
            errorPlacement: function(error, element) {
                // Append error within linked label
                $( element )
                    .closest( "form" )
                    .find( "label[for='" + element.attr( "id" ) + "']" )
                    .append( error );
            },
            errorElement: "span",
            rules: {
                nrk: {
                    required: true,
                    minlength: 6,
                    maxlength: 6
                },
                nip: "required",
                nip18: "required",
//                kolok: "required",
//                kojab: "required",
               // klogad: "required",
                nama: "required",
                pathir: "required",
                talhir: "required",
                agama: "required",
                jenkel: "required",
//                stawin: "required",
                stapeg: "required",
                jenpeg: "required",
                muang: "required",
//                tbhttmas: "required",
//                tbhbbmas: "required",
                mpp: "required",
                //taspen: "required",
                noppen: "required",
                alamat: "required",
                rt: "required",
                rw: "required",
                //darah: "required",
                kowil: "required",
                kocam: "required",
                kokel: "required",
                prop: "required",
                email: {
                    maxlength: 100,
                    email: true
                },
                jendikcps: "required",
                kodikcps: "required"

            },
            messages: {
                nrk: {
                    required: " Harus diisi"
                },
                nip: {
                    required: " Harus diisi"
                },
                nip18: {
                    required: " Harus diisi"
                },
                nama: {
                    required: " Harus diisi"
                },
                pathir: {
                    required: " Harus diisi"
                },
                talhir: {
                    required: " Harus diisi"
                },
                agama: {
                    required: " Harus diisi"
                },
                jenkel: {
                    required: " Harus diisi"
                },
                stapeg: {
                    required: " Harus diisi"
                },
                jenpeg: {
                    required: " Harus diisi"
                },
                muang: {
                    required: " Harus diisi"
                },
                mpp: {
                    required: " Harus diisi"
                },
               /* karpeg: {
                    required: " Harus diisi"
                },
                taspen: {
                    required: " Harus diisi"
                },*/
                noppen: {
                    required: " Harus diisi"
                },
               /* darah: {
                    required: " Harus diisi"
                },*/
                jendikcps: {
                    required: " Harus diisi"
                },
                kodikcps: {
                    required: " Harus diisi"
                }

            }
        });
        $( "a[href='#finish']" ).hide();

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

        $("#stapeg").on("change", function(event) {
                    event.preventDefault();

                $.ajax({
                url: "<?php echo base_url(); ?>index.php/home/getJenpeg",
                type: "post",
                data: {stapeg : $('#stapeg').val()},
                dataType: 'json',
                beforeSend: function() {

                },
                success: function(data) {
                    if(data.response == 'SUKSES'){
                        list = '<option value=""></option>' + data.list;

                        $('#jenpeg').html(list);
                    }else{
                        $('#jenpeg').html('');
                    }
                },
                error: function(xhr) {
                    alert("Terjadi kesalahan. Silahkan coba kembali");
                },
                complete: function() {
                    
                    $('#jenpeg').val('');
                    $('#jenpeg').change();

                    
                }
            });
                });

        $("#jenpeg").on("change", function(event) {
                    event.preventDefault();

                    showTMT();
                });        

        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: true,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy",
            endDate : new Date()
        });

        $('#data_2 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: true,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy",
            endDate : new Date()

        });

        $('#data_3 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: true,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });

        $('#data_12 .input-group.date').datepicker({
            forceParse: true,
            format: 'yyyy',
            viewMode: 'years',
            minViewMode: 'years'
        });

        $('#data_13 .input-group.date').datepicker({
            forceParse: true,
            format: 'yyyy',
            viewMode: 'years',
            minViewMode: 'years'
        });

        $('#data_9 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: true,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });

        $('#data_8 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: true,
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
            forceParse: true,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });

        $('#data_14 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: true,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });

        $('#data_89 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: true,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy"
        });

        $("#kolok").select2({
            placeholder: "Pilih Lokasi"
        });
        
        $("#kolok").select2("enable", false);

        $("#kolok2").select2({
            placeholder: "Pilih Lokasi"
        });
        
        $("#kolok2").select2("enable", false);

        $("#klogad").select2({
            placeholder: "Pilih Lokasi Gaji"
        });
        $("#klogad").select2("enable", true);

        $("#kojab").select2({
            placeholder: "Pilih Jabatan"
        });
        $("#kojab").select2("enable", false);

        $(".select2_jenpeg").select2({
            placeholder: "Pilih Jenis Pegawai"
        });
        $(".select2_induk").select2({
            placeholder: "Pilih Induk"
        });
        $(".select2_agama").select2({
            placeholder: "Pilih Agama"
        });
        $("#stawin").select2({
            placeholder: "Pilih Status Kawin"
        });
        $("#stawin").select2("enable", false);

        $(".select2_stapeg").select2({
            placeholder: "Pilih Status Pegawai"
        });

        $(".select2_prop").select2({
            width: "100%",
            placeholder: "Pilih Propinsi",
            ajax: {
                url: '<?php echo site_url('home/getPropinsiNew3');?>',
                dataType: 'json',
                type:'post',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 0
        });

        $('.select2_prop').on('select2:select', function (evt) {
            $('.select2_kowil').val('');
            $('.select2_kocam').val('');
            $('.select2_kokel').val('');
            $('.select2_kowil').trigger('change.select2');
            $('.select2_kocam').trigger('change.select2');
            $('.select2_kokel').trigger('change.select2');
            // alert(1);
        });

        $(".select2_kowil").select2({
            width: "100%",
            placeholder: "Pilih Wilayah",
            ajax: {
                url: '<?php echo site_url('home/getWilayahNew3');?>',
                dataType: 'json',
                type:'post',
                delay: 250,
                data: function (params) {
                    return {
                        prop: $('#prop').val(),
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 0
        });

        $('.select2_kowil').on('select2:select', function (evt) {
            $('.select2_kocam').val('');
            $('.select2_kokel').val('');

            $('.select2_kocam').trigger('change.select2');
            $('.select2_kokel').trigger('change.select2');
            // alert(1);
        });

        $(".select2_kocam").select2({
            width: "100%",
            placeholder: "Pilih Kecamatan",
            ajax: {
                url: '<?php echo site_url('home/getKecamatanNew3');?>',
                dataType: 'json',
                type:'post',
                delay: 250,
                data: function (params) {
                    return {
                        kowil: $('#kowil').val(),
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 0
        });

        $('.select2_kocam').on('select2:select', function (evt) {
            $('.select2_kokel').val('');
            $('.select2_kokel').trigger('change.select2');
            // alert(1);
        });


        $(".select2_kokel").select2({
            width: "100%",
            placeholder: "Pilih Kelurahan",
            ajax: {
                url: '<?php echo site_url('home/getKelurahanNew3');?>',
                dataType: 'json',
                type:'post',
                delay: 250,
                data: function (params) {
                    return {
                        kocam: $('#kocam').val(),
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 0
        });

        $(".select2_prop_ktp").select2({
            width: "100%",
            placeholder: "Pilih Propinsi",
            ajax: {
                url: '<?php echo site_url('home/getPropinsiNew3');?>',
                dataType: 'json',
                type:'post',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 0
        });

        $('.select2_prop_ktp').on('select2:select', function (evt) {
            $('.select2_kowil_ktp').val('');
            $('.select2_kocam_ktp').val('');
            $('.select2_kokel_ktp').val('');
            $('.select2_kowil_ktp').trigger('change.select2');
            $('.select2_kocam_ktp').trigger('change.select2');
            $('.select2_kokel_ktp').trigger('change.select2');
            // alert(1);
        });

        $(".select2_kowil_ktp").select2({
            width: "100%",
            placeholder: "Pilih Wilayah",
            ajax: {
                url: '<?php echo site_url('home/getWilayahNew3');?>',
                dataType: 'json',
                type:'post',
                delay: 250,
                data: function (params) {
                    return {
                        prop: $('#prop_ktp').val(),
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 0
        });

        $('.select2_kowil_ktp').on('select2:select', function (evt) {
            $('.select2_kocam_ktp').val('');
            $('.select2_kokel_ktp').val('');

            $('.select2_kocam_ktp').trigger('change.select2');
            $('.select2_kokel_ktp').trigger('change.select2');
            // alert(1);
        });

        $(".select2_kocam_ktp").select2({
            width: "100%",
            placeholder: "Pilih Kecamatan",
            ajax: {
                url: '<?php echo site_url('home/getKecamatanNew3');?>',
                dataType: 'json',
                type:'post',
                delay: 250,
                data: function (params) {
                    return {
                        kowil: $('#kowil_ktp').val(),
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 0
        });

        $('.select2_kocam_ktp').on('select2:select', function (evt) {
            $('.select2_kokel_ktp').val('');
            $('.select2_kokel_ktp').trigger('change.select2');
            // alert(1);
        });


        $(".select2_kokel_ktp").select2({
            width: "100%",
            placeholder: "Pilih Kelurahan",
            ajax: {
                url: '<?php echo site_url('home/getKelurahanNew3');?>',
                dataType: 'json',
                type:'post',
                delay: 250,
                data: function (params) {
                    return {
                        kocam: $('#kocam_ktp').val(),
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data
                    return {
                        results: data
                    };
                },
                cache: true
            },
            minimumInputLength: 0
        });        
        
        $(".select2_jendikcps").select2({
            width: "100%",
            placeholder: "Pilih Jenis Pendidikan CPS"
        });
        $(".select2_kodikcps").select2({
            width: "100%",
            placeholder: "Pilih Pendidikan CPS"
        });


        //Otomatis huruf besar
        // $('input, textarea')
        //         .not(':input[type=button], :input[type=submit], :input[type=reset], :input[id=npwp], :input[id=taspen], :input[id=nohp], :input[id=notelp], :input[id=noppen], :input[id=nokk], :input[id=karsu], :input[id=email], :input[id=simpeda]')
        //         .keyup(function(){
        //     this.value = this.value.toUpperCase();
        // });

        // $("#nama2").keyup(function(){
        // });

        // $("#npwp").keyup(function(){
        // });

        // $("#email").keyup(function(){
        //     this.value = this.value.toLowerCase();
        // });

        // $("#npwp").keyup(function(){
        // });

        // $('.select2_prop').val('31.00.00.0000').trigger('change');
        // $('.select2_prop').select2("val", '31.00.00.0000');

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

    function showTMT() 
	{
	    if(document.getElementById('jenpeg').value == '6')
	    {
	        document.getElementById('data_89').style.display = "";           
	    }
	    else
	    {
	        document.getElementById('data_89').style.display = "none";
	        document.getElementById('tmttitipan').value='';

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
                getNamaSpmu();
            },
            error: function(xhr) {
                $('.msg').html('');
                $('.err').html("<small>Terjadi kesalahan</small>");
            },
            complete: function() {

            }
        });
    }

    function getNamaSpmu(){
        spmu = $('#spmu').val();
        

        $.ajax({
            url: '<?php echo base_url("index.php/pegawai/getKetSpmuBySpmu"); ?>',
            type: "post",
            data: {
                spmu: spmu
            },
            dataType: 'text',
            beforeSend: function() {
                $('.msg').html('<div><div class="sk-spinner sk-spinner-rotating-plane"></div></div>');
                $('.err').html("");
            },
            success: function(data) {
                $('#spmu2').val(data);
                
            },
            error: function(xhr) {
                $('.msg').html('');
                $('.err').html("<small>Terjadi kesalahan</small>");
            },
            complete: function() {

            }
        });
    }

    function setNRK(nrk){
        //alert(123);
        $('#nrk2').val(nrk);
    }

    function setNama(nama){
        $('#nama2').val(nama);
    }

    function setTgMati(){
        if($("input[name='kdmati']:checked").val() == 'Y'){
            $("#data_3").show();
            $("#kolok_mati").show();
            $("#kolok_hidup").hide();
            var temptgmati = $('#temptgmati').val();

            
            $('#tgmati').val(temptgmati);
            
        } else {
            $("#data_3").hide();
            $("#kolok_mati").hide();
            $("#kolok_hidup").show();
            //var ftgmati = $('#tgmati').val();
            $('#tgmati').val('');
           
        }
    }
    
    function showAndDead(){
        var mpp_val = $('input[name=mpp]:checked').val();
        if(mpp_val == 'Y'){
            $('#data_10, #data_14').show();
        } else {
            $('#data_10, #data_14').hide();
        }
    }

    function showAndDeadPindahan(){
        var pindahan_val = $('input[name=pindahan]:checked').val();
        if(pindahan_val == 'Y'){
            $('#data_11').show();
        } else {
            $('#data_11').hide();
        }
    }

    function samakanAlamat(){
        // alert($("input[name='sama_almt']:checked").val());
        if($("input[name='sama_almt']:checked").val() == '1'){
            $('#alamat_ktp').hide();
            $('#div_rt_ktp').hide();
            $('#div_rw_ktp').hide();
            $('#div_prop_ktp').hide();
            $('#div_wil_ktp').hide();
            $('#div_kec_ktp').hide();
            $('#div_kel_ktp').hide();
        } else {
            $('#alamat_ktp').show();
            $('#div_rt_ktp').show();
            $('#div_rw_ktp').show();
            $('#div_prop_ktp').show();
            $('#div_wil_ktp').show();
            $('#div_kec_ktp').show();
            $('#div_kel_ktp').show();
        }
    }

    function showHideCekSamakan(){
        // alert($("#alamat_ktp").val());
        if($("#alamat_ktp").val() == ''){
            $("input[name='sama_almt']").attr('checked',true);
        } else {
            $("input[name='sama_almt']").attr('checked',false);
        }

        samakanAlamat();
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


</script>
