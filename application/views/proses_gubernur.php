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

    .sk-spinner-circle.sk-spinner {
            height: 22px;
            margin: 0 !important;
            position: relative;
            width: 22px;
        }

    .sk-spinner-three-bounce.sk-spinner {
            margin: 0 auto;
            text-align: center;
            width: 140px !important;
        }

    .dataTables_scroll .dataTables_scrollHeadInner{
        width: 100% !important;
    }

    .dataTables_scroll .dataTables_scrollHeadInner table{
        width: 100% !important;   
    }

    .dataTables_scroll .dataTables_scrollBody{
        width: 100% !important;
    }

    .dataTables_scroll .dataTables_scrollBody table{
        width: 100% !important;
    }

    .datepicker, .datepicker-dropdown{
        z-index: 999999999 !important;        
    }
    .pickerpicker .form-control-feedback {
        right: 55px !important;      
    }

    .pickerpicker .form-control-feedback {
        top: 0px !important;
    }

</style>


<?php
	date_default_timezone_set('Asia/Jakarta');
    $date_now = date('Ym');
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Proses Gubernur</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('batch')?>">Home</a>
            </li>
            <li class="active">
                <strong>Group Menu</strong>
            </li>
        </ol>
    </div>
</div>

<!-- START WRAPPER CONTENT -->
<div class="wrapper wrapper-content animated fadeInRight">        
        <div class="row">        
            <!-- <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <span class="pull-right"> <button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Tambah Group Menu</button> </span>
                    </div>
                </div>
            </div>   -->  
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">                        
                        <!-- <h4>User Group</h4> -->
                    </div>
                    <div class="ibox-content">
                        
                        <div class="row">
                            <div class="col-sm-12">
                            

                            <ul class="nav nav-tabs">
                            	<li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-briefcase"></i>Gaji Gubernur</a></li>
                            </ul>
                            <div class="tab-content">

                            	<!-- Tab 1 -->
                            	<div id="tab-1" class="tab-pane active">
                                    <div class="ibox-content">
                                        <div class="row">
                                            <form role="form" class="form-inline" id="pph" action="javascript:">
                                            	<div class="row">

    	                                            <div class="form-group" id="data_6">
    	                                                <label class="col-sm-2 control-label">Tanggal Batch<span class="required">*</span></label>&nbsp;&nbsp;
    	                                                <!-- <input type="text" placeholder="" id="tgl_batch" name="tgl_batch" onkeyup="validAngka(this)"  
    	                                                       class="form-control"> -->
    	                                                <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="tgl_batch3" name="tgl_batch3" readonly="">
                                                        </div>
    	                                                <input type="hidden" readonly="" id="idt3" name="idt3"class="form-control">

                                                        <button class="btn btn-danger btn-facebook btn-outline" onclick="javascript:showGaji(this)">
                                                            <i class="fa fa-refresh"></i>&nbsp; Tampilkan Gaji
                                                        </button>

                                                        <?php if($user_group == '46') { ?> <!--hanya muncul jika group batching-->
                                                        <button class="btn btn-primary btn-facebook btn-outline" onclick="javascript:inputDataBaru(this)">
                                                            <i class="fa fa-refresh"></i>&nbsp; Input Data Baru
                                                        </button>
                                                        <?php } ?>
                                                        <!-- <button class="btn btn-primary btn-facebook btn-outline" onclick="javascript:cetak_gajiTXT(this)">
                                                            <i class="fa fa-print"></i>&nbsp; Download File Gaji
                                                        </button> -->

    	                                            </div>

    	                                            <!-- <button class="btn btn-primary" type="submit">Save</button> -->
                                                </div>
                                            </form>
                                        </div>

                                        <div class="row" id="VGAJI" style="display:none">
                                        	<?php if($user_group == '46') { ?> <!--hanya muncul jika group batching-->
                                            <div class="ibox-title">
                                                <button class="btn btn-primary btn-rounded btn-block btn-outline"  onclick="javascript:exc_gaji()"><i class="fa fa-info-circle"></i> Proses Gubernur</button>
                                            </div>
                                            <?php } ?>

                                            <div class="ibox-content">

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        
                                                        <table id="tablegaji" class="table table-bordered table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <td align="left" width="3%"><b>No</b></td>
                                                                    <td align="left" ><b>THBL</b></td>
                                                                    <td align="left" ><b>Nama</b></td>
                                                                    <td align="left" ><b>Gaji Pokok</b></td>
                                                                    <td align="left" ><b>Gaji Bersih</b></td>
                                                                    <td align="left" ><b>Tunjangan Jabatan</b></td>
                                                                    <td align="left" ><b>Keterangan</b></td>
                                                                    <td align="left" ><b>Aksi</b></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <div id="spinner_tablegaji"></div>
                                                            </tbody>
                                                        </table>                                    
                                                        
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                            <!-- Modal -->
                                        <div id="Update_Modal" class="modal" role="dialog">
                                          <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title text-center">Edit Data</h4>
                                              </div>
                                              <div class="modal-body">
                                                    <table id="formeditgaji" class="table">
                                                            <div>
                                                                <tr>
                                                                    <td align="left" width="3%"><b>NRK</b></td><td><input type="text" name="NRK" id="nrk_formedit" class="form-control" onblur="cek_form_input()" maxlength="6" onkeyup="cek_NRK(this,this.value)"><p id="hasil_objek1" style="display: none;" class="text-danger">Data Sudah Tersedia</p><p id="nrk_val" class="text-danger"></p></td>
                                                                </tr><!-- 
                                                                <tr>
                                                                    <td align="left" ><b>THBL</b></td><td><input type="text" name="THBL" id="thbl_form" class="form-control"></td>
                                                                </tr> -->
                                                                <tr>
                                                                    <td align="left" ><b>NAMA</b></td><td><input type="text" name="NAMA" id="nama_formedit" class="form-control" maxlength="25"><p id="nama_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>KOLOK</b></td><td><input type="text" name="KOLOK" id="kolok_formedit" class="form-control" maxlength="9"><p id="kolok_val" class="text-danger" ></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>KLOGAD</b></td><td><input type="text" name="KLOGAD" id="klogad_formedit" class="form-control" maxlength="9"><p id="klogad_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>SPMU</b></td><td><input type="text" name="SPMU" id="spmu_formedit" class="form-control" maxlength="4" ><p id="spmu_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>GAPOK</b></td><td><input type="text" name="GAPOK" id="gapok_formedit" class="form-control" maxlength="10"onkeyup="validAngka(this)"><p id="gapok_val" class="text-danger" ></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>TISTRI</b></td><td><input type="text" name="TISTRI" id="tistri_formedit" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="tistri_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" width="3%"><b>TANAK</b></td><td><input type="text" name="TANAK" id="tanak_formedit" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="tanak_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>TBERAS</b></td><td><input type="text" name="TBERAS" id="tberas_formedit" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="tberas_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>PPH_GAJI</b></td><td><input type="text" name="PPH_GAJI" id="pph_gaji_formedit" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="pphgaji_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>JUMKOTOR</b></td><td><input type="text" name="JUMKOTOR" id="jumkotor_formedit" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="jumkotor_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>GAJI_BERSIH</b></td><td><input type="text" name="GAJI_BERSIH" id="gaji_bersih_formedit" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="gajibersih_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>TUNJAB</b></td><td><input type="text" name="TUNJAB" id="tunjab_formedit" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="tunjab_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>PPH_TUNJAB</b></td><td><input type="text" name="PPH_TUNJAB" id="pph_tunjab_formedit" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="pphtunjab_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>TUNJAB_BERSIH</b></td><td><input type="text" name="TUNJAB_BERSIH" id="tunjab_bersih_formedit" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="tunjabbersih_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>IWP</b></td><td><input type="text" name="IWP" id="iwp_formedit" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="iwp_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>JNETTPPH</b></td><td><input type="text" name="JNETTPPH" id="jnettpph_formedit" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="jnettpph_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>NTASPEN</b></td><td><input type="text" name="NTASPEN" id="ntaspen_formedit" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="ntaspen_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>NASKES</b></td><td><input type="text" name="NASKES" id="naskes_formedit" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="naskes_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>NTHT</b></td><td><input type="text" name="NTHT" id="ntht_formedit" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="ntht_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>BIAYA JABATAN</b></td><td><input type="text" name="BIAYAJABATAN" id="biayajabatan_formedit" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="biayajabatan_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>JUAN</b></td><td><input type="text" name="JUAN" id="juan_formedit" class="form-control" maxlength="2" onkeyup="validAngka(this)"><p id="juan_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>JIWA</b></td><td><input type="text" name="JIWA" id="jiwa_formedit" class="form-control" maxlength="2" onkeyup="validAngka(this)"><p id="jiwa_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>JIWAAWAL</b></td><td><input type="text" name="JIWAAWAL" id="jiwaawal_formedit" class="form-control" maxlength="2" onkeyup="validAngka(this)"><p id="jiwaawal_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>JENKEL</b></td><td>
                                                                    <div class="i-checks" ><input type="radio" value="L" name="jenkel_formedit">Laki-laki &nbsp; <input type="radio" value="W" name="jenkel_formedit"> Wanita </div>
                                                                <p id="jenkel_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>KDKERJA</b></td><td><input type="text" name="KDKERJA" id="kdkerja_formedit" class="form-control" maxlength="1" onkeyup="validAngka(this)"><p id="kdkerja_val" class="text-danger" ></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>STAWIN</b></td><td><input type="text" name="STAWIN" id="stawin_formedit" class="form-control" maxlength="1" onkeyup="validAngka(this)"><p id="stawin_val" class="text-danger" ></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>NPBULAT</b></td><td><input type="text" name="NPBULAT" id="npbulat_formedit" class="form-control" maxlength="8" onkeyup="validAngka(this)"><p id="npbulat_val" class="text-danger" ></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>TUNFUNG</b></td><td><input type="text" name="TUNFUNG" id="tunfung_formedit" class="form-control" maxlength="8" onkeyup="validAngka(this)"><p id="tunfung_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>NTUNLAI</b></td><td><input type="text" name="NTUNLAI" id="ntunlai_formedit" class="form-control" maxlength="8" onkeyup="validAngka(this)"><p id="ntunlai_val" class="text-danger"></p></td>
                                                                </tr>
                                                            </div>
                                                        </table>
                                              </div>
                                              <div class="modal-footer">
                                                <button class="btn btn-info" onclick="simpan_update_data()">Save</button> &nbsp; <button type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
                                              </div>
                                            </div>

                                          </div>
                                        </div>

                                        <!-- form input -->
                                        <div class="row" id="Form_input" style="display:none">
                                            <div class="ibox-title">
                                                <b>Form Input Data</b>
                                                <!-- <button class="btn btn-primary btn-rounded btn-block btn-outline"  onclick="javascript:exc_gaji()"><i class="fa fa-info-circle"></i> Eksekusi Gaji</button> -->
                                            </div>

                                            <div class="ibox-content">

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        
                                                        <table id="forminputgaji" class="table table-bordered table-striped table-hover">
                                                            <div>
                                                                <tr>
                                                                    <td align="left" width="3%"><b>NRK</b></td><td><input type="text" name="NRK" id="nrk_form" class="form-control" onblur="cek_form_input()" maxlength="6" onkeyup="cek_NRK(this,this.value)"><p id="hasil_objek1" style="display: none;" class="text-danger">Data Sudah Tersedia</p><p id="nrk_val" class="text-danger"></p></td>
                                                                </tr><!-- 
                                                                <tr>
                                                                    <td align="left" ><b>THBL</b></td><td><input type="text" name="THBL" id="thbl_form" class="form-control"></td>
                                                                </tr> -->
                                                                <tr>
                                                                    <td align="left" ><b>NAMA</b></td><td><input type="text" name="NAMA" id="nama_form" class="form-control" maxlength="25"><p id="nama_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>KOLOK</b></td><td><input type="text" name="KOLOK" id="kolok_form" class="form-control" maxlength="9"><p id="kolok_val" class="text-danger" ></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>KLOGAD</b></td><td><input type="text" name="KLOGAD" id="klogad_form" class="form-control" maxlength="9"><p id="klogad_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>SPMU</b></td><td><input type="text" name="SPMU" id="spmu_form" class="form-control" maxlength="4" ><p id="spmu_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>GAPOK</b></td><td><input type="text" name="GAPOK" id="gapok_form" class="form-control" maxlength="10"onkeyup="validAngka(this)"><p id="gapok_val" class="text-danger" ></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>TISTRI</b></td><td><input type="text" name="TISTRI" id="tistri_form" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="tistri_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" width="3%"><b>TANAK</b></td><td><input type="text" name="TANAK" id="tanak_form" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="tanak_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>TBERAS</b></td><td><input type="text" name="TBERAS" id="tberas_form" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="tberas_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>PPH_GAJI</b></td><td><input type="text" name="PPH_GAJI" id="pph_gaji_form" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="pphgaji_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>JUMKOTOR</b></td><td><input type="text" name="JUMKOTOR" id="jumkotor_form" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="jumkotor_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>GAJI_BERSIH</b></td><td><input type="text" name="GAJI_BERSIH" id="gaji_bersih_form" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="gajibersih_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>TUNJAB</b></td><td><input type="text" name="TUNJAB" id="tunjab_form" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="tunjab_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>PPH_TUNJAB</b></td><td><input type="text" name="PPH_TUNJAB" id="pph_tunjab_form" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="pphtunjab_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>TUNJAB_BERSIH</b></td><td><input type="text" name="TUNJAB_BERSIH" id="tunjab_bersih_form" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="tunjabbersih_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>IWP</b></td><td><input type="text" name="IWP" id="iwp_form" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="iwp_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>JNETTPPH</b></td><td><input type="text" name="JNETTPPH" id="jnettpph_form" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="jnettpph_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>NTASPEN</b></td><td><input type="text" name="NTASPEN" id="ntaspen_form" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="ntaspen_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>NASKES</b></td><td><input type="text" name="NASKES" id="naskes_form" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="naskes_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>NTHT</b></td><td><input type="text" name="NTHT" id="ntht_form" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="ntht_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>BIAYAJABATAN</b></td><td><input type="text" name="BIAYAJABATAN" id="biayajabatan_form" class="form-control" maxlength="10" onkeyup="validAngka(this)"><p id="biayajabatan_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>JUAN</b></td><td><input type="text" name="JUAN" id="juan_form" class="form-control" maxlength="2" onkeyup="validAngka(this)"><p id="juan_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>JIWA</b></td><td><input type="text" name="JIWA" id="jiwa_form" class="form-control" maxlength="2" onkeyup="validAngka(this)"><p id="jiwa_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>JIWAAWAL</b></td><td><input type="text" name="JIWAAWAL" id="jiwaawal_form" class="form-control" maxlength="2" onkeyup="validAngka(this)"><p id="jiwaawal_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>JENKEL</b></td><td>
                                                                    <div class="i-checks"><label> <input type="radio" value="L" name="jenkel_form"> <i></i> Laki-laki </label> &nbsp; <label> <input type="radio" checked="" value="W" name="jenkel_form"> <i></i> Wanita </label></div>
                                                                    
                                                                    <p id="jenkel_val" class="text-danger"></p></td>
                                                                    
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>KDKERJA</b></td><td><input type="text" name="KDKERJA" id="kdkerja_form" class="form-control" maxlength="1" onkeyup="validAngka(this)"><p id="kdkerja_val" class="text-danger" ></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>STAWIN</b></td><td><input type="text" name="STAWIN" id="stawin_form" class="form-control" maxlength="1" onkeyup="validAngka(this)"><p id="stawin_val" class="text-danger" ></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>NPBULAT</b></td><td><input type="text" name="NPBULAT" id="npbulat_form" class="form-control" maxlength="8" onkeyup="validAngka(this)"><p id="npbulat_val" class="text-danger" ></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>TUNFUNG</b></td><td><input type="text" name="TUNFUNG" id="tunfung_form" class="form-control" maxlength="8" onkeyup="validAngka(this)"><p id="tunfung_val" class="text-danger"></p></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left" ><b>NTUNLAI</b></td><td><input type="text" name="NTUNLAI" id="ntunlai_form" class="form-control" maxlength="8" onkeyup="validAngka(this)"><p id="ntunlai_val" class="text-danger"></p></td>
                                                                </tr>
                                                            </div>
                                                            <tbody>
                                                                
                                                                <!-- <div id="spinner_forminputgaji"></div> -->
                                                            </tbody>
                                                        </table>                                    
                                                        <div id="tombol_input" style="display: none"><p align="right"><button class="btn btn-success btn-facebook btn-outline" onclick="" id="simpan_input">Input</button></p></div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
            
                            </div>                                   
                                
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            

        </div>        
        
</div>


<!-- Start Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div id="widthForm" class="modal-dialog modal-lg" role="document">
    <div class="modal-content animated fadeInUp" id="modal_content">
        
    </div>
  </div>
</div>
<!-- End Modal -->

<div class="modal inmodal" id="modalExcPenglain"  role="dialog"  aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                
                <h4 class="modal-title">Proses Eksekusi sedang berlangsung</h4>
                <!-- <small>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small> -->
            </div>
            <div class="modal-body">
                <div class="spiner-example">
                    <div class="sk-spinner sk-spinner-three-bounce animated fadeInDown">
	                    <div class="sk-bounce1"></div>
	                    <div class="sk-bounce2"></div>
	                    <div class="sk-bounce3"></div>
	                    <div class="sk-bounce4"></div>
	                    <div class="sk-bounce5"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-white" data-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary" onclick="javascript:closeModal();">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="modalchange"  role="dialog"  aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                
                <h4 class="modal-title">Loading Proses</h4>
                <!-- <small>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small> -->
            </div>
            <div class="modal-body">
                <div class="spiner-example">
                    <div class="sk-spinner sk-spinner-double-bounce">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-white" data-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary" onclick="javascript:closeModal();">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<!-- END WRAPPER CONTENT -->
    
    <!-- Mainly scripts -->
    <script src="<?php echo base_url() ?>assets/inspinia/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url() ?>assets/inspinia/js/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Nestable List -->
    <script src="<?php echo base_url() ?>assets/js/plugins/nestable/jquery.nestable.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url() ?>assets/inspinia/js/inspinia.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins/pace/pace.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/jquery.form.js"></script>

    <!-- Data Tables -->
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.tableTools.min.js"></script>

    <!-- Boostrap Validator -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/boostrapvalidator/js/bootstrapValidator.js"></script>

    <!-- Sweet alert -->
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/chosen/chosen.jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/select2/select2.full.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/fullcalendar/moment.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/iCheck/icheck.min.js"></script>
    <script>
            $(document).ready(function() {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
    </script>
            



    <script>
        $(document).ready(function(){


            $('#data_4 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true,
                format: "yyyymm"
            });

            $('#data_5 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true,
                format: "yyyymm",
                endDate : new Date()
            });

            $('#data_6 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true,
                format: "yyyymm",
                endDate : '+1m'
            });

            $('#data_7 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true,
                format: "yyyymm",
                endDate : new Date()
            });

            $('#data_8 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true,
                format: "yyyymm",
                endDate : new Date()
            });

            $('#data_9 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true,
                format: "yyyymm",
                endDate : new Date()
            });

        });
        
        


    </script>

    <script type="text/javascript">
        // $(".select2_demo_1").select2();
        // $(".select2_demo_2").select2();
        $(".select2_demo_3").select2({
            // placeholder: "Pilih Bulan Plain",
            allowClear: true,
            width: '100%'
        });

        var config = {
                '.chosen-select'           : {},
                '.chosen-select-deselect'  : {allow_single_deselect:true},
                '.chosen-select-no-single' : {disable_search_threshold:10},
                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                '.chosen-select-width'     : {width:"95%"}
                }
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
    </script>


    <script type="text/javascript">
    $(document).ready(function(){
    		$.ajax({
			    url:   "<?php echo site_url('/proses_gubernur/tgl_batch')?>", 
			    type: "POST", 
			    dataType : 'json',
			    success: function(data){  /*Return from PHP side*/
			    		$('#idt').val(data.idt);
			    		$('#idt2').val(data.idt);
                        $('#idt3').val(data.idt);
                        $('#idt4').val(data.idt);
                        $('#idt5').val(data.idt);
                        $('#idt6').val(data.idt);
                        $('#idt7').val(data.idt);
			    		$('#tgl_batch').val(data.tglBatch);
			    		$('#tgl_batch2').val(data.tglBatch);
			    		$('#tgl_batch3').val(data.tglBatch);
                        $('#thblptt').val(data.tglBatch);
			    		$('#thbl').val(data.tglBatch);
                        $('#thblkrimitkd').val(data.tglBatch);
                        $('#thbltkd2').val(data.tglBatch);
                        $('#thbltrans').val(data.tglBatch);
			    		
			    }
			});

            $.ajax({
                url: "<?php echo site_url('/proses_gubernur/jml_hari_kerja')?>",
                dataType: 'json',
                success: function(d){
                    //alert(d.jml_hr_kerja);
                    $('#hr_krja').val(d.jml_hr_kerja);
                }

            });
    	
    });

     $('#but_ptt').click(function(e){
                e.preventDefault();
                $('#RPTT').hide();
                exc_ptt();
            })

     //reload tanggal batch
     function reload_tglBatch(){
        $.ajax({
                url:   "<?php echo site_url('/proses_gubernur/tgl_batch')?>", 
                type: "POST", 
                dataType : 'json',
                success: function(data){  /*Return from PHP side*/
                        $('#idt').val(data.idt);
                        $('#idt2').val(data.idt);
                        $('#idt3').val(data.idt);
                        $('#idt4').val(data.idt);
                        $('#idt5').val(data.idt);
                        $('#idt6').val(data.idt);
                        $('#idt7').val(data.idt);
                        $('#tgl_batch').val(data.tglBatch);
                        $('#tgl_batch2').val(data.tglBatch);
                        $('#tgl_batch3').val(data.tglBatch);
                        $('#thblptt').val(data.tglBatch);
                        $('#thbl').val(data.tglBatch);
                        $('#thblkrimitkd').val(data.tglBatch);
                        $('#thbltkd2').val(data.tglBatch);
                        $('#thbltrans').val(data.tglBatch);
                }
            })
    }

    function reload_harikerja(){
        $.ajax({
                url: "<?php echo site_url('/proses_gubernur/jml_hari_kerja')?>",
                dataType: 'json',
                success: function(d){
                    //alert(d.jml_hr_kerja);
                    $('#hr_krja').val(d.jml_hr_kerja);
                }

            });
    }


    function numbersonly(myfield, e, dec) 
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

    function validAngka(a)
    {
        if(!/^[0-9.]+$/.test(a.value))
        {
        a.value = a.value.substring(0,a.value.length-1000);
        }
    }

    
    function getForm(action,key1){
                save_method = action;

                $.ajax({
                    url:  "<?php echo site_url('/proses_gubernur/openModal')?>", 
                    type: "post",
                    data: {action:action,key1:key1},
                    dataType: 'json',
                    beforeSend: function() {

                        $('#myModal').modal('show');
                    },
                    success: function(data) {  
                                                                                       
                        if(data.response == 'SUKSES'){
                            $("#modal_content").html(data.result);

                            if(data.widthForm == 'one'){
                                $('#widthForm').removeAttr('class').attr('class', '');                                
                                $('#widthForm').addClass('modal-dialog');
                            }else{
                                $('#widthForm').removeAttr('class').attr('class', '');
                                $('#widthForm').addClass('modal-dialog');
                                $('#widthForm').addClass('modal-lg');                                
                            }

                        }else{
                            $("#modal_content").html('');
                        }
                    },
                    error: function(xhr) {                              
                        $('#myModal').modal('hide');  
                    },
                    complete: function() {
                                                
                    }
                });
            }

    // function changeTable(){
    $(function() {
	    $("#tabelid").on("change", function(event) {
	        event.preventDefault();
            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 
	    	var tabelid = $('#tabelid').val();
	    	// alert(tabelid);
	    	if(tabelid == 1){
	    		// alert('tabel satu');
	    		$.ajax({
		            type: 'POST',
		            url: '<?php echo site_url("/proses_gubernur/view_gaji");?>',
		            dataType: 'JSON',
		            beforeSend: function(){
		            	// $('#modalchange').modal('show');
                        $('#spinner_wait').html(spinner);
		            },
		            success: function(data) 
		            {
		            	if(data.response == 'SUKSES'){
	                        gaji = '<option value=""></option>' + data.gaji;
	                        $('#bulanplain').html(gaji);
	                        // $('#modalchange').modal('hide');
                            $("#spinner_wait").html('');
	                    }else{
	                        $('#bulanplain').html('');
	                        // $('#modalchange').modal('hide');
                            $("#spinner_wait").html('');
	                    }
		            }           
		        });
	    	}else if(tabelid == 2){
	    		// alert('tabel dua');
	    		$.ajax({
		            type: 'POST',
		            url: '<?php echo site_url("/proses_gubernur/view_tkd");?>',
		            dataType: 'JSON',
		            beforeSend: function(){
		            	// $('#modalchange').modal('show');
                        $('#spinner_wait').html(spinner);
		            },
		            success: function(data) 
		            {
		            	if(data.response == 'SUKSES'){
	                        tkd = '<option value=""></option>' + data.tkd;
	                        $('#bulanplain').html(tkd);
	                        // $('#modalchange').modal('hide');
                            $("#spinner_wait").html('');
	                    }else{
	                        $('#bulanplain').html('');
	                        // $('#modalchange').modal('hide');
                            $("#spinner_wait").html('');
	                    }
		            }           
		        });
	    	}else{
	    		// alert('tabel tiga');
	    		$.ajax({
		            type: 'POST',
		            url: '<?php echo site_url("/proses_gubernur/view_guru");?>',
		            dataType: 'JSON',
		            beforeSend: function(){
		            	// $('#modalchange').modal('show');
                        $('#spinner_wait').html(spinner);
		            },
		            success: function(data) 
		            {
		            	if(data.response == 'SUKSES'){
	                        tkd_guru = '<option value=""></option>' + data.tkd_guru;
	                        $('#bulanplain').html(tkd_guru);
	                        // $('#modalchange').modal('hide');
                            $("#spinner_wait").html('');
	                    }else{
	                        $('#bulanplain').html('');
	                        // $('#modalchange').modal('hide');
                            $("#spinner_wait").html('');
	                    }
		            }           
		        });
	    	}
	    });
	});

    
    </script>

    <script type="text/javascript">

    function inputDataBaru(){
        var tgl_batch3 = $('#tgl_batch3').val();

        if(tgl_batch3!=''){
            $('#Form_input').show();        
            $('#VGAJI').hide();
        }else{
            $('#Form_input').hide();
            // alert(tgl_batch2);
        }
    }

    function showGaji(){
        var tgl_batch3 = $('#tgl_batch3').val();
        // alert(tgl_batch3);

        if(tgl_batch3!=''){
            $('#VGAJI').show();
            $('#Form_input').hide();
            tabelGaji();
        }else{
            $('#VGAJI').hide();
            // alert(tgl_batch2);
        }
    }

    function showKrimi()
    {
        $('#VKrimiTKD').show();
        tabelKrimiTKD();

        $('#butekskrimi').show();
    }

    function showPPH(){
    	var tgl_batch2 = $('#tgl_batch2').val();
    	// alert(tgl_batch2);

    	if(tgl_batch2!=''){
    		$('#VPPH').show();
            tabelPPH();
    	}else{
    		$('#VPPH').hide();
            // alert(tgl_batch2);
    	}
    }
    </script>

    <script type="text/javascript">
    function blurTHBL()
    {
        var idkey = $('#tgl_batch').val();
        // alert(idkey);
        if(idkey!=''){
            $('#table1').show();
            reload_tbl2();
            // alert(thbl);
        }else{
            $('#table1').hide();
        }
    }

    function reload_tbl2()
    {
        var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 
        // $('#tbl2').DataTable().ajax.reload();
        var dataTable = $('#tbl2').DataTable( {
                // "columns": [
                //           null,
                //           null,
                //           null,
                //           null,
                //           null,
                //           null
                //           ],
                responsive: false,
                bAutoWidth: true, 
                destroy: true,
                "scrollX": true,
                // "bProcessing": true,
                "serverSide": true,
                "language": {
                        "processing": "<div></div><div></div><div></div><div></div><div></div>"
                    },
                "ajax":{
                    url :"<?php echo site_url('/proses_gubernur/data_gajiLain')?>", // json datasource
                    type: "post",  // method  , by default get
                    // drawCallback: function( settings ) {
                      
                    // },
                    data : function(d){
                        d.tgl_batch = $('#tgl_batch').val();
                    },
                    beforeSend: function(){
                        // $("#tbl1_processing").css("display","none");
                        // $('#spinner2').html("<div class='sk-spinner sk-spinner-three-bounce'><div class='sk-bounce1'></div><div class='sk-bounce2'></div><div class='sk-bounce3'></div></div>");
                        $('#spinner_tbl2').html(spinner);
                    },complete: function(){
                            $("#spinner_tbl2").html('');
                    },
                    error: function(){  // error handling
                        $(".tbl2-error").html("");
                        $("#tbl2").append('<tbody class="tbl1-error"><tr><div colspan=6>Tidak Ada Data</div></tr></tbody>');
                        $("#tbl2_processing").css("display","none");
                        
                    }

                }
              

            } );

            $('#tbl2 input').unbind();
            $('#tbl2 input').bind('keyup', function(e) {
            if(e.keyCode == 13) {
            oTable.fnFilter(this.value);
            }
            });
    }

    function reload_tbl1()
    {
        $('#tbl1').DataTable().ajax.reload();
    }

    $(document).ready(function(){

        $('#pengLain').bootstrapValidator({
            live: 'enabled',
            excluded : 'disabled',
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                //==============
                tgl_batch: {
                    validators: {
                        notEmpty: {
                            message: 'Tanggal Batch tidak boleh kosong'
                        }
                    }
                },
                thbl: {
                    validators: {
                        notEmpty: {
                            message: 'THBL tidak boleh kosong'
                        }
                    }
                },
                bulanplain: {
                    validators: {
                        notEmpty: {
                            message: 'Bulan Plain tidak boleh kosong'
                        }
                    }
                },
                tabelid: {
                    validators: {
                        notEmpty: {
                            message: 'Tabel ID tidak boleh kosong'
                        }
                    }
                }
                //==============
            }
        });

        
        /*END CHOSEN*/

    });
    </script>

    <script>
    var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 

     var dataTable = $('#tbl1').DataTable( {
                                    //"aaSorting":[],
                    
        // destroy:true,
        responsive: false,
        // "bProcessing": true,
        "scrollX": true,
        "serverSide": true,
       
        "ajax":{
            url :"<?php echo site_url('/proses_gubernur/data_plain')?>", // json datasource
            type: "post",  // method  , by default get
            // drawCallback: function( settings ) {
              
            // },
            beforeSend: function(){
                $('#spinner_tbl').html(spinner);
            },complete: function(){
                     $("#spinner_tbl").html('');
            },
            error: function(){  // error handling
                $(".tbl1-error").html("");
                $("#tbl1").append('<tbody class="tbl1-error"><tr><th align="center">Tidak Ada Data</th></tr></tbody>');
                $("#tbl1_processing").css("display","none");
                
            }

        }

    } );


</script>

<script type="text/javascript">
	function tabelGaji(){
        var dataTable = $('#tablegaji').DataTable( {
                // "columns": [
                //           null,
                //           null,
                //           null,
                //           null,
                //           null,
                //           null
                //           ],
                responsive: false,
                bAutoWidth: true, 
                destroy: true,
                // "bProcessing": true,
                "scrollX": true,
                "serverSide": true,
                "language": {
                        "processing": "<div></div><div></div><div></div><div></div><div></div>"
                    },
                "ajax":{
                    url :"<?php echo site_url('/proses_gubernur/dataGaji')?>", // json datasource
                    type: "post",  // method  , by default get
                    // drawCallback: function( settings ) {
                      
                    // },
                    data : function(d){
                        d.tgl_batch3 = $('#tgl_batch3').val();
                    },
                    beforeSend: function(){
                        $('#spinner_tablegaji').html(spinner);
                    },complete: function(){
                             $("#spinner_tablegaji").html('');
                    },
                    error: function(){  // error handling
                        $(".tablegaji-error").html("");
                        $("#tablegaji").append('<tbody class="tablegaji-error"><tr><div colspan=6>Tidak Ada Data</div></tr></tbody>');
                        $("#tablegaji_processing").css("display","none");
                        
                    }

                }
              

            } );
            

            // setInterval( function () {
            //     $('#tbl1').DataTable().ajax.reload();
            // }, 1000 );


            $('#tablegaji input').unbind();
            $('#tablegaji input').bind('keyup', function(e) {
            if(e.keyCode == 13) {
            oTable.fnFilter(this.value);
            }
            });
    }

    function cek_form_input(){

            var nrk = $('#nrk_form').val();
            var thbl = $('#tgl_batch3').val();
        
        $.ajax({
                url: "<?php echo site_url('/proses_gubernur/cek_nrk_input')?>", //alamat url
                dataType: "json", //type datanya
                type: "POST", //metode form yang akan diambil
                data: {'nrk': nrk, 'thbl': thbl}, //data dari parameter yang akan dikirim
                success: function(cekNRKInputData){
                    if(cekNRKInputData.respon == 'sukses'){
                        //dapat melakukan input data
                            $('#tombol_input').show();
                            $('#hasil_objek1').hide();
                        } else {
                            //tidak bisa melakukan input data
                            $('#tombol_input').hide();
                            $('#hasil_objek1').show();
                            $('#nrk_form').focus();
                    }
                }
            });
    }


    // proses input data
    document.getElementById("simpan_input").addEventListener("click", proses_input);

    // document.getElementById("myText").maxLength = "4";

    function proses_input(){

            var nrk = $('#nrk_form').val();
            var thbl = $('#tgl_batch3').val();
            var nama = $('#nama_form').val();
            var kolok = $('#kolok_form').val();
            var klogad = $('#klogad_form').val(); 
            var spmu = $('#spmu_form').val();
            var gapok = $('#gapok_form').val();
            var tistri = $('#tistri_form').val();
            var tanak = $('#tanak_form').val();
            var tberas = $('#tberas_form').val();
            var pph_gaji = $('#pph_gaji_form').val();
            var jumkotor = $('#jumkotor_form').val();
            var gaji_bersih = $('#gaji_bersih_form').val();
            var tunjab = $('#tunjab_form').val();
            var pph_tunjab = $('#pph_tunjab_form').val();
            var tunjab_bersih = $('#tunjab_bersih_form').val();
            var iwp = $('#iwp_form').val();
            var jnettpph = $('#jnettpph_form').val();
            var ntaspen = $('#ntaspen_form').val();
            var naskes = $('#naskes_form').val();
            var biayajabatan = $('#biayajabatan_form').val();
            var ntht = $('#ntht_form').val();
            var juan = $('#juan_form').val();
            var jiwa = $('#jiwa_form').val();
            var jiwaawal = $('#jiwaawal_form').val();
            var kdkerja = $('#kdkerja_form').val();
            var stawin = $('#stawin_form').val();
            var npbulat = $('#npbulat_form').val();
            var tunfung = $('#tunfung_form').val();
            var ntunlai = $('#ntunlai_form').val();
            var jenkel = $('input[name=jenkel_form]:checked').val();
            
            $.ajax({
                url: "<?php echo site_url('/proses_gubernur/input_data_gubernur')?>", //alamat url
                dataType: "json", //type datanya
                type: "POST", //metode form yang akan diambil
                data: {'nrk': nrk, 'thbl': thbl, 'kolok': kolok, 'nama': nama, 'klogad': klogad, 'spmu': spmu, 'gapok': gapok, 'tistri': tistri, 'tanak': tanak, 'tberas': tberas, 'pph_gaji': pph_gaji, 'jumkotor': jumkotor, 'gaji_bersih': gaji_bersih, 'tunjab': tunjab, 'pph_tunjab': pph_tunjab, 'tunjab_bersih': tunjab_bersih, 'iwp': iwp, 'jnettpph': jnettpph, 'ntaspen': ntaspen, 'naskes': naskes, 'ntht': ntht, 'biayajabatan': biayajabatan, 'juan': juan, 'jiwa': jiwa, 'jiwaawal': jiwaawal, 'jenkel': jenkel, 'kdkerja': kdkerja, 'stawin': stawin, 'npbulat': npbulat, 'tunfung': tunfung, 'ntunlai': ntunlai}, //data dari parameter yang akan dikirim
                
                // document.getElementById("myText").maxLength = "4";

                beforeSend: function() {                

                        //untuk validasi form
                        if(nrk == ""){
                            $("#nrk_val").html("Pilihan Wajib diisi!!!");
                            $("#nrk_val").focus();
                            return false;
                        }

                        if(nama == ""){
                            $("#nama_val").html("Pilihan Wajib diisi!!!");
                            $("#nama_val").focus();
                            return false;
                        }

                        if(kolok == ""){
                            $("#kolok_val").html("Pilihan Wajib diisi!!!");
                            $("#kolok_val").focus();
                            return false;
                        }

                        if(klogad == ""){
                            $("#klogad_val").html("Pilihan Wajib diisi!!!");
                            $("#klogad_val").focus();
                            return false;
                        }

                        if(spmu == ""){
                            $("#spmu_val").html("Pilihan Wajib diisi!!!");
                            $("#spmu_val").focus();
                            return false;
                        }

                        if(gapok == ""){
                            $("#gapok_val").html("Pilihan Wajib diisi!!!");
                            $("#gapok_val").focus();
                            return false;
                        }

                        if(tistri == ""){
                            $("#tistri_val").html("Pilihan Wajib diisi!!!");
                            $("#tistri_val").focus();
                            return false;
                        }

                        if(tanak == ""){
                            $("#tanak_val").html("Pilihan Wajib diisi!!!");
                            $("#tanak_val").focus();
                            return false;
                        }

                        if(tberas == ""){
                            $("#tberas_val").html("Pilihan Wajib diisi!!!");
                            $("#tberas_val").focus();
                            return false;
                        }

                        if(pph_gaji == ""){
                            $("#pphgaji_val").html("Pilihan Wajib diisi!!!");
                            $("#pphgaji_val").focus();
                            return false;
                        }

                        if(jumkotor == ""){
                            $("#jumkotor_val").html("Pilihan Wajib diisi!!!");
                            $("#jumkotor_val").focus();
                            return false;
                        }

                        if(gaji_bersih == ""){
                            $("#gajibersih_val").html("Pilihan Wajib diisi!!!");
                            $("#gajibersih_val").focus();
                            return false;
                        }

                        if(tunjab == ""){
                            $("#tunjab_val").html("Pilihan Wajib diisi!!!");
                            $("#tunjab_val").focus();
                            return false;
                        }

                        if(pph_tunjab == ""){
                            $("#pphtunjab_val").html("Pilihan Wajib diisi!!!");
                            $("#pphtunjab_val").focus();
                            return false;
                        }

                        if(tunjab_bersih == ""){
                            $("#tunjabbersih_val").html("Pilihan Wajib diisi!!!");
                            $("#tunjab_val").focus();
                            return false;
                        }

                        if(iwp == ""){
                            $("#iwp_val").html("Pilihan Wajib diisi!!!");
                            $("#iwp_val").focus();
                            return false;
                        }

                        if(jnettpph == ""){
                            $("#jnettpph_val").html("Pilihan Wajib diisi!!!");
                            $("#jnettpph_val").focus();
                            return false;
                        }

                        if(ntaspen == ""){
                            $("#ntaspen_val").html("Pilihan Wajib diisi!!!");
                            $("#ntaspen_val").focus();
                            return false;
                        }

                        if(naskes == ""){
                            $("#naskes_val").html("Pilihan Wajib diisi!!!");
                            $("#naskes_val").focus();
                            return false;
                        }

                        if(ntht == ""){
                            $("#ntht_val").html("Pilihan Wajib diisi!!!");
                            $("#ntht_val").focus();
                            return false;
                        }

                        if(biayajabatan == ""){
                            $("#biayajabatan_val").html("Pilihan Wajib diisi!!!");
                            $("#biayajabatan_val").focus();
                            return false;
                        }

                        if(juan == ""){
                            $("#juan_val").html("Pilihan Wajib diisi!!!");
                            $("#juan_val").focus();
                            return false;
                        }

                        if(jiwa == ""){
                            $("#jiwa").html("Pilihan Wajib diisi!!!");
                            $("#jiwa_val").focus();
                            return false;
                        }

                        if(jiwa == ""){
                            $("#jiwaawal").html("Pilihan Wajib diisi!!!");
                            $("#jiwaawal_val").focus();
                            return false;
                        }

                        if(jenkel == ""){
                            $("#jenkel_val").html("Pilihan Wajib diisi!!!");
                            $("#jenkel_val").focus();
                            return false;
                        }

                        if(kdkerja == ""){
                            $("#kdkerja_val").html("Pilihan Wajib diisi!!!");
                            $("#kdkerja_val").focus();
                            return false;
                        }

                        if(stawin == ""){
                            $("#stawin_val").html("Pilihan Wajib diisi!!!");
                            $("#stawin_val").focus();
                            return false;
                        }

                        if(npbulat == ""){
                            $("#npbulat_val").html("Pilihan Wajib diisi!!!");
                            $("#npbulat_val").focus();
                            return false;
                        }

                        if(tunfung == ""){
                            $("#tunfung_val").html("Pilihan Wajib diisi!!!");
                            $("#tunfung_val").focus();
                            return false;
                        }

                        if(ntunlai == ""){
                            $("#ntunlai_val").html("Pilihan Wajib diisi!!!");
                            $("#ntunlai_val").focus();
                            return false;
                        }
                },

                success: function(proses_input){
                    if(proses_input.respon == 'sukses'){
                        $('#Form_input').hide();
                        $('#VGAJI').show();
                        tabelGaji();
                    }else{
                        alert('gagal');
                    }
                } 
            });
    }

</script>

<script type="text/javascript">

	function saveGaji(){
		$.ajax({
			url : '<?php echo base_url("/proses_gubernur/savepph"); ?>',
			type : 'post',
			data : $('#pph').serialize(),
			dataType : "JSON",
			beforeSend : function(){

			},
			success : function(data){
				if(data.respone== 'sukses'){
					swal("Sukses", "Berhasil update tanggal Batch ", "success");
				}else{
					swal("Gagal", "Gagal update tanggal Batch ", "error");
				}

			},
			complete : function(){
				reload_tglBatch();
				reload_tbl2();
			}
		});
		
	}

</script>

<script type="text/javascript">
	function exc_gaji(){
		var tgl_batch3 = $('#tgl_batch3').val();
        var idt3 = $('#idt3').val();
        // alert(tgl_batch3);

        $.ajax({
            beforeSend : function(){
                swal({
                      title: "Apakah anda benar ingin melakukan eksekusi Gaji dengan tanggal Batch "+tgl_batch3+" ?",
                      text: "Eksekusi ini akan memakan waktu sekitar 15 menit!",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "Ya Lanjut!",
                      cancelButtonText: "Tidak!",
                      closeOnConfirm: true,
                      closeOnCancel: true
                    }
                    ,
                    function(isConfirm){
                      if (isConfirm) {
                            exc_gaji2(tgl_batch3,idt3);
                      } else {
                            swal("Gagal", "Gagal Eksekusi Gaji dengan tanggal Batch "+tgl_batch3, "error");
                      }
                    }
                    );

            }

        });

	}

	function exc_gaji2(tgl_batch3,idt3){
		$.ajax({
			url : '<?php echo base_url("/proses_gubernur/cek_gaji") ?>',
			type: "post",
	        data: {tgl_batch3:tgl_batch3, idt3:idt3},
	        dataType: "JSON",
			
			success : function(data){
				// alert(data.respone);
				if(data.respone=='sukses'){
					exc_gaji3(tgl_batch3,idt3);
					// swal("Sukses", "Berhasil Eksekusi Gaji dengan Tanggal Batch "+tgl_batch3, "success");
				}else{
					swal("Gagal", "Data Gaji untuk Tanggal Batch "+tgl_batch3+" sudah ada ", "error");
				}
			}
		});

	}

	function exc_gaji3(tgl_batch3,idt3){
        $.ajax({
            url: '<?php echo base_url("/proses_gubernur/exc_gaji") ?>',
            type: "post",
            data: {tgl_batch3:tgl_batch3, idt3:idt3},
            dataType: "JSON",
            beforeSend: function(){
                $('#modalExcPenglain').modal('show');
            },
            success: function(data){
                if(data.respone=='sukses'){

                    $('#modalExcPenglain').modal('hide');
                    swal("Sukses", "Berhasil Eksekusi Gaji dengan Tanggal Batch "+tgl_batch3, "success");                  
                    reload_tglBatch();
                    tabelGaji();

                }else{
                    swal("Gagal", "Data Gaji untuk Tanggal Batch "+tgl_batch3+" sudah ada ", "error");
                    $('#modalExcPenglain').modal('hide');
                }
                
            },
            error: function (xhr, status, err) {                       
                var str = xhr.responseText;
                alert(str);
                $('#modalExcPenglain').modal('hide');
                reload_tglBatch();
                tabelGaji();
            }
            /*error: function(xhr) {                              
                    swal("Gagal", "Gagal eksekusi", "error");
                    $('#modalExcPenglain').modal('hide');
                    reload_tglBatch();
                    tabelGaji();
            }*/
        });
    }

    // cetak file TXT
    function cetak_gajiTXT(){
        var tgl_batch3 = $('#tgl_batch3').val();
        $.ajax({
            url : '<?php echo base_url("/proses_gubernur/cek_gj") ?>',
            type: "post",
            data: {tgl_batch3:tgl_batch3},
            dataType: "JSON",
            
            success : function(data){
                // alert(data.respone);
                if(data.respone=='sukses'){
                    //alert("sukses");
                    //cetak_gajiTXT2(tgl_batch3);
                    window.open('/proses_gubernur/printGAJI');
                    //swal("Success", "Sukses cetak laporan gaji "+tgl_batch3, "success");
                    reload_tglBatch();
                }else{
                    swal("Gagal", "Data Gaji untuk Tanggal Batch "+tgl_batch3+" belum ada ", "error");
                    reload_tglBatch();
                }
            }
        });

    }

    // function cetak_tkd2TXT(){
    //     var tgl_batch = $('#thbltkd2').val();
    //     $.ajax({
    //         url : '<?php echo base_url("/proses_gubernur/cek_tkd") ?>',
    //         type: "post",
    //         data: {tgl_batch:tgl_batch},
    //         dataType: "JSON",
            
    //         success : function(data){
    //             // alert(data.respone);
    //             if(data.respone=='sukses'){
    //                 //alert("print");
    //                 window.open('/proses_gubernur/printTKD2');
    //                 //swal("Success", "Sukses cetak laporan gaji "+tgl_batch, "success");
    //                 reload_tglBatch();
    //             }else{
    //                 swal("Gagal", "Data TKD Tahap 2 untuk Tanggal Batch "+tgl_batch+" belum ada ", "error");
    //                 reload_tglBatch();
    //             }
    //         }
    //     });
    // }

    function get_nrk_edit(nrk,thbl){

        $.ajax({
                url: '<?php echo base_url("/proses_gubernur/cek_nrk_edit") ?>', //alamat url
                dataType: "json", //type datanya
                type: "POST", //metode form yang akan diambil
                data: {'nrk': nrk, 'thbl': thbl}, //data dari parameter yang akan dikirim
                success: function(get_nrk_edit){

                    if(get_nrk_edit.respon == 'sukses'){
                        // alert('data sukses');
                        $('#nrk_formedit').val(nrk);
                        $('#nama_formedit').val(get_nrk_edit.nama);
                        $('#kolok_formedit').val(get_nrk_edit.kolok);
                        $('#klogad_formedit').val(get_nrk_edit.klogad);
                        $('#spmu_formedit').val(get_nrk_edit.spmu);
                        $('#gapok_formedit').val(get_nrk_edit.gapok);
                        $('#tistri_formedit').val(get_nrk_edit.tistri);
                        $('#tanak_formedit').val(get_nrk_edit.tanak);
                        $('#tberas_formedit').val(get_nrk_edit.tberas);
                        $('#pph_gaji_formedit').val(get_nrk_edit.pph_gaji);
                        $('#jumkotor_formedit').val(get_nrk_edit.jumkotor);
                        $('#gaji_bersih_formedit').val(get_nrk_edit.gaji_bersih);
                        $('#tunjab_formedit').val(get_nrk_edit.tunjab);
                        $('#pph_tunjab_formedit').val(get_nrk_edit.pph_tunjab);
                        $('#tunjab_bersih_formedit').val(get_nrk_edit.tunjab_bersih);
                        $('#iwp_formedit').val(get_nrk_edit.iwp);
                        $('#jnettpph_formedit').val(get_nrk_edit.jnettpph);
                        $('#ntaspen_formedit').val(get_nrk_edit.ntaspen);
                        $('#naskes_formedit').val(get_nrk_edit.naskes);
                        $('#ntht_formedit').val(get_nrk_edit.ntht);
                        $('#biayajabatan_formedit').val(get_nrk_edit.biayajabatan);
                        $('#juan_formedit').val(get_nrk_edit.juan);
                        $('#jiwa_formedit').val(get_nrk_edit.jiwa);
                        $('#jiwaawal_formedit').val(get_nrk_edit.jiwaawal);
                        $('#kdkerja_formedit').val(get_nrk_edit.kdkerja);
                        $('#stawin_formedit').val(get_nrk_edit.stawin);
                        $('#npbulat_formedit').val(get_nrk_edit.npbulat);
                        $('#tunfung_formedit').val(get_nrk_edit.tunfung);
                        $('#ntunlai_formedit').val(get_nrk_edit.ntunlai);
                        // $("#jenkel_formedit").val(get_nrk_edit.jenkel);
                        $( "input:radio[name=jenkel_formedit]").val([get_nrk_edit.jenkel]);

                        // alert(get_nrk_edit.jenkel);
                                    // if(get_nrk_edit.jenkel !== 'W'){
                                    //     alert('anda Pria');
                                    //     $( "input").val([ "L" ]);

                                    // }else{
                                    //     alert('anda Wanita');
                                    //     $( "input").val([ "W" ]);
                                    // }

                        $('#Update_Modal').modal('show');

                    }else{
                        swal("Gagal", "Terjadi kesalahan", "error");
                    }
                } 
            });
    }

    function simpan_update_data(){

            var nrk = $("#nrk_formedit").val();
            var thbl = $('#tgl_batch3').val();
            var nama = $("#nama_formedit").val();
            var kolok = $("#kolok_formedit").val();
            var klogad = $("#klogad_formedit").val();
            var spmu = $("#spmu_formedit").val();
            var gapok = $("#gapok_formedit").val();
            var tistri = $("#tistri_formedit").val();
            var tanak = $("#tanak_formedit").val();
            var tberas = $("#tberas_formedit").val();
            var pph_gaji = $("#pph_gaji_formedit").val();
            var jumkotor = $("#jumkotor_formedit").val();
            var gaji_bersih = $("#gaji_bersih_formedit").val();
            var tunjab = $("#tunjab_formedit").val();
            var pph_tunjab = $("#pph_tunjab_formedit").val();
            var tunjab_bersih = $("#tunjab_formedit").val();
            var iwp = $("#iwp_formedit").val();
            var jnettpph = $("#jnettpph_formedit").val();
            var ntaspen = $("#ntaspen_formedit").val();
            var naskes = $("#ntaspen_formedit").val();
            var ntht = $("#ntht_formedit").val();
            var biayajabatan = $("#biayajabatan_formedit").val();
            var juan = $("#juan_formedit").val();
            var jiwa = $("#jiwa_formedit").val();
            var jiwaawal = $("#jiwaawal_formedit").val();
            var jenkel = $('input[name=jenkel_formedit]:checked').val();
            var kdkerja = $("#kdkerja_formedit").val();
            var stawin = $("#stawin_formedit").val();
            var npbulat = $("#npbulat_formedit").val();
            var tunfung = $("#tunfung_formedit").val();
            var ntunlai = $("#ntunlai_formedit").val();

            $.ajax({
                url: '<?php echo base_url("/proses_gubernur/simpan_update") ?>', //alamat url
                dataType: "json", //type datanya
                type: "POST", //metode form yang akan diambil
                data: {'nrk': nrk, 'thbl': thbl, 'kolok': kolok, 'nama': nama, 'klogad': klogad, 'spmu': spmu, 'gapok': gapok, 'tistri': tistri, 'tanak': tanak, 'tberas': tberas, 'pph_gaji': pph_gaji, 'jumkotor': jumkotor, 'gaji_bersih': gaji_bersih, 'tunjab': tunjab, 'pph_tunjab': pph_tunjab, 'tunjab_bersih': tunjab_bersih, 'iwp': iwp, 'jnettpph': jnettpph, 'ntaspen': ntaspen, 'naskes': naskes, 'ntht': ntht, 'biayajabatan': biayajabatan, 'juan': juan, 'jiwa': jiwa, 'jiwaawal': jiwaawal, 'jenkel': jenkel, 'kdkerja': kdkerja, 'stawin': stawin, 'npbulat': npbulat, 'tunfung': tunfung, 'ntunlai': ntunlai}, //data dari parameter yang akan dikirim

                success: function(simpan_update_data){

                    if(simpan_update_data.respon == 'sukses'){
                        swal("Sukses", "Berhasil update data", "success");
                        $('#Update_Modal').modal('hide');
                        tabelGaji();
                    }else{
                        swal("Gagal", "Gagal update data", "error");
                    }
                }
            });
        }

    function get_nrk_delete(nrk,thbl){
        swal({
                      title: "Apakah anda benar ingin menghapus data dengan NRK "+nrk+" dan THBL "+thbl+" ?",
                      text: "Data yang telah dihapus tidak dapat dikembalikan!",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "Ya hapus!",
                      cancelButtonText: "Tidak!",
                      closeOnConfirm: true,
                      closeOnCancel: true
                    }
                    ,
                    function(isConfirm){
                      if (isConfirm) {
                        get_nrk_delete2(nrk,thbl);
                      } else {
                            swal("Gagal", "Gagal hapus data dengan NRK "+nrk+" dan THBL "+thbl, "error");
                      }
                    }
                    );
    }

    function get_nrk_delete2(nrk,thbl){
        
        $.ajax({
                url: '<?php echo base_url("/proses_gubernur/cek_nrk_delete") ?>', //alamat url
                dataType: "json", //type datanya
                type: "POST", //metode form yang akan diambil
                data: {'nrk': nrk, 'thbl': thbl}, //data dari parameter yang akan dikirim
                success: function(get_nrk_delete){

                    if(get_nrk_delete.respon == 'sukses'){
                        swal("Sukses", "Berhasil hapus data", "success");
                        tabelGaji();
                    }else{
                        swal("Gagal", "Gagal hapus data", "error");
                    }
                    
                    
                } 
            });

    }
</script>

    



