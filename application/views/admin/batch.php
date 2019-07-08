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
        <h2>Proses Batching</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('batch')?>">Home</a>
            </li>
            <li class="active">
                <strong>Batch</strong>
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
                            	<li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-briefcase"></i>Gaji</a></li>
                            	<li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-briefcase"></i>PPH</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-3"><i class="fa fa-briefcase"></i>Penghasilan Lain</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-4"><i class="fa fa-briefcase"></i>Gaji Susulan</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-5"><i class="fa fa-briefcase"></i>Gaji 13</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-6"><i class="fa fa-briefcase"></i>Gaji 14</a></li>
                            </ul>
                            <div class="tab-content">

                            	<!-- Tab 1 -->
                            	<div id="tab-1" class="tab-pane active">
                                    <div class="ibox-content">
                                        <div class="row">
                                            <form role="form" class="form-inline" id="pph" action="javascript:">
                                            	<div class="row">

    	                                            <div class="form-group" id="data_2">
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
                                                        <button class="btn btn-primary btn-facebook btn-outline" onclick="javascript:cetak_gajiTXT(this)">
                                                            <i class="fa fa-print"></i>&nbsp; Download File Gaji
                                                        </button>

    	                                            </div>

    	                                            <!-- <button class="btn btn-primary" type="submit">Save</button> -->
                                                </div>
                                            </form>
                                        </div>

                                        <div class="row" id="VGAJI" style="display:none">
                                        	<?php if($user_group == '46') { ?>
                                            <div class="ibox-title">
                                                <button class="btn btn-primary btn-rounded btn-block btn-outline"  onclick="javascript:exc_gaji()"><i class="fa fa-info-circle"></i> Eksekusi Gaji</button>
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
                                                                    <td align="left" ><b>NRK</b></td>
                                                                    <td align="left" ><b>Nama</b></td>
                                                                    <td align="left" ><b>Gaji Pokok</b></td>
                                                                    <td align="left" ><b>Jumlah Bersih</b></td>
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

                                    </div>
                                </div>
                                
                                <!-- Tab 2 -->
                                <div id="tab-2" class="tab-pane">
                                    <div class="ibox-content">
	                                    <div class="row">
	                                        <!-- <form role="form" class="form-inline" id="pph" action="javascript:savePPH();"> -->
	                                        <form role="form" class="form-inline" action="javascript:">
	                                        	<div class="row">

		                                            <div class="form-group" id="data_5">
		                                                <label class="col-sm-2 control-label">Tanggal Batch<span class="required">*</span></label>&nbsp;&nbsp;
		                                                <div class="input-group date">
	                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="tgl_batch2" name="tgl_batch2" readonly="">
	                                                    </div>
		                                                <input type="hidden" readonly="" id="idt2" name="idt2"class="form-control">

		                                                <button class="btn btn-danger btn-facebook btn-outline" onclick="javascript:showPPH(this)">
                                                            <i class="fa fa-refresh"></i>&nbsp; Tampilkan PPH
                                                        </button>
		                                            </div>

		                                            <!-- <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o"></i>Save</button> -->
		                                            
	                                            </div>
	                                            
	                                            
	                                        </form>
	                                    </div>

	                                    <div class="row" id="VPPH" style="display:none">
	                                    	<?php if($user_group == '46') { ?>
		                                    <div class="ibox-title">
					                            <button class="btn btn-primary btn-rounded btn-block btn-outline"  onclick="javascript:exc_pph()"><i class="fa fa-info-circle"></i> Eksekusi PPH</button>
					                        </div>
					                        <?php } ?>

					                        <div class="ibox-content">

					                            <div class="row">
					                                <div class="col-sm-12">
					                                    
					                                    <table id="tablepph" class="table table-bordered table-striped table-hover">
					                                        <thead>
					                                            <tr>
					                                                <td align="left" width="3%"><b>No</b></td>
					                                                <td align="left" ><b>THBL</b></td>
					                                                <td align="left" ><b>NRK</b></td>
                                                                    <td align="left" ><b>Nama</b></td>
                                                                    <td align="left" ><b>PPH Bulan</b></td>
					                                            </tr>
					                                        </thead>
					                                        <tbody>
					                                            <div id="spinner_tablepph"></div>
					                                        </tbody>
					                                    </table>                                    
					                                    
					                                </div>
					                            </div>

					                        </div>
				                        </div>
                                    </div>
                                </div>

                                <!-- Tab 3 -->
                                <div id="tab-3" class="tab-pane">

                                	<?php if($user_group == '46') { ?> <!--hanya muncul jika group batching-->
                                    <div class="ibox-content">
                                    <div class="row">
                                        <form role="form" class="form-inline" id="pengLain" action="javascript:savePengLain();">

                                            <br/>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="center" id="spinner_wait"></div>
                                                </div>
                                            </div>
                                            <br/>
                                            
                                        	<div class="row">
		                                       
		                                        <input type="hidden" readonly="" id="idt" name="idt" class="form-control">
                                                <div class="form-group" id="data_4">
                                                    <label class="col-sm-2 control-label">THBL<span class="required">*</span></label>&nbsp;&nbsp;
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="thbl" name="thbl" readonly="">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Table ID<span class="required">*</span></label>
                                                    <div class="col-lg-9">
	                                                    <select data-placeholder="Pilih Jenis Tabel..." class="select2_demo_3" id="tabelid" name="tabelid">
	                                                        <option></option>
	                                                        <option value="1">Tabel Gaji</option>
	                                                        <option value="2">Tabel TKD Pegawai</option>
	                                                        <option value="3">Tabel TKD Guru</option>
	                                                    </select>
                                                    </div>
                                                </div>

		                                        <div class="form-group">
		                                            <label class="col-sm-3 control-label">Bulan Plain<span class="required">*</span></label>
		                                            <div class="col-lg-9">
	                                                    <select data-placeholder="Pilih Bulan Plain..." class="select2_demo_3" id="bulanplain" name="bulanplain" tabindex="2">
	                                                        <option value=""></option>
	                                                        <!-- <option value="13">Gaji 13</option>
	                                                        <option value="14">Gaji 14</option>
	                                                        <option value="15">Gaji 15</option> -->
	                                                    </select>
                                                    </div>
		                                        </div>
		                                        
		                                        <button class="btn btn-primary" type="submit">Save</button>
                                            </div>
                                            
                                            
                                        </form>
                                    </div>

                                    </div>


                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="tbl1" class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <td align="left" width="4%"><b>No</b></td>
                                                            <td align="left" ><b>THBL</b></td>
                                                            <td align="center" ><b>Jenis Tabel</b></td>
                                                            <td align="center" ><b>Jenis Gaji</b></td>
                                                            <td align="center" ><b>Action</b></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <div id="spinner_tbl1"></div>
                                                    </tbody>
                                                </table> 
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="ibox-content">
	                                    <div class="row">

		                                    <div class="col-md-5">
		                                    	<div class="form-group" id="data_4">
		                                            <div class="input-group date">
		                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" readonly="" id="tgl_batch" name="tgl_batch">
		                                            </div>
		                                        </div>
		                                    </div> 

		                                    <div class="col-md-5">
		                                    	<button class="btn btn-danger btn-facebook btn-outline" onclick="javascript:blurTHBL(this)"><i class="fa fa-refresh"></i>&nbsp; View Penghasilan Lain</button>
		                                    </div>
	                                       
		                                </div>
	                                </div>

                                    <div class="ibox-content" id="table1" style="display:none">
                                    	<?php if($user_group == '46') { ?> <!--hanya muncul jika group batching-->
                                    	<div class="center">
	                                    	<!-- <form action="javascript:excute_PengLain();">
	                                    		<input type="hidden" class="form-control" id="tgl_batch3" name="tgl_batch3"> -->
	                                    		<button class="btn btn-primary btn-rounded btn-block btn-outline" onclick="javascript:excute_PengLain();"><i class="fa fa-info-circle"></i> Eksekusi penghasilan lain</button>
	                                    	<!-- </form> -->
                                    	</div>
                                    	<br/><br/>
                                    	<?php } ?>
                                        <table id="tbl2" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <td align="left" width="3%"><b>No</b></td>
                                                    <td align="left" ><b>THBL</b></td>
                                                    <td align="left" ><b>NRK</b></td>
                                                    <td align="left" ><b>Nama</b></td>
                                                    <td align="center" ><b>Gaji Bersih</b></td>
                                                    <td align="center" ><b>Tunda Bersih</b></td>
                                                    <td align="center" ><b>Jenis Penghasilan</b></td>
                                                    <td align="center" ><b>Jenis Tabel</b></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <div id="spinner_tbl2"></div>
                                            </tbody>
                                        </table> 
                                    </div>
                                    
                                </div>

                                <!-- Tab 4 -->
                                <div id="tab-4" class="tab-pane">
									<?php if($user_group == '46') { ?> <!--hanya muncul jika group batching-->
                                    <div class="col-sm-6">
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="radio radio-info radio-inline">
                                                    <input type="radio" id="id_radio1" value="value_radio1" name="radioInline" checked="">
                                                    <label for="inlineRadio1"> Input Data </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="radio radio-inline">
                                                    <input type="radio" id="id_radio2" value="value_radio1" name="radioInline">
                                                    <label for="inlineRadio2"> Upload File </label>
                                                </div>
                                            </div>
                                            <br/>
                                            <br/>

                                            <div id="form_insert_gj_ssl">
                                                <form role="form" class="form-inline" id="form_gj_ssl" action="javascript:simpan_nrk_ssl();">
                                            
                                                    <div class="row" id="pil_input">
                                                        <div class="form-group" id="pil_input">
                                                            <label class="col-sm-2 control-label">NRK<span class="required">*</span></label>&nbsp;&nbsp;
                                                            <div class="input-group col-sm-8">
                                                                <input type="text"  id="nrk_ssl" name="nrk_ssl" class="form-control" onkeyup="validAngka(this)" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <button class="btn btn-primary btn-facebook btn-outline" type="submit">
                                                                <i class="fa fa-floppy-o"></i>&nbsp; SAVE
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div id="form_upload_gj_ssl" style="display: none;">
                                                <div class="wrapper wrapper-content animated fadeIn">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="ibox float-e-margins">
                                                                    <h3 class="font bold text-navy"> Aturan upload NRK untuk gaji susulan</h3>
                                                                    <ol>
                                                                        <li>Sebelum upload file baru,pastikan dulu table NRK susulan disamping sudah kosong</li>
                                                                        <li>Untuk kosongkan table cukup dengan klik tombol <b class="font-bold text-danger">Truncate Table</b> </li>
                                                                        <li>File yang mendukung adalah <b>Microsoft Excel (xls,xlsx,csv)</b></li>
                                                                        <li>File Excel menggunakan <b>1 sheet</b></li>
                                                                        <li>NRK pertama dimulai pada kolom pertama dan baris ke-tiga</li>
                                                                        <li>Data yang diupload harus berupa <b>angka</b></li>
                                                                    </ol>
                                                                    <h2 class="font-bold text-danger">FILE YANG DIUPLOAD HARUS SESUAI DENGAN ATURAN DI ATAS, <BR/>
                                                                    KESALAHAN KARENA PERBEDAAN ISI FILE EXCEL BUKAN KESALAHAN SISTEM</h2>

                                                                    <label>Upload File di bawah ini</label>

                                                                    <form id="form_upload_nrk_ssl" onsubmit='return validateForm_excel();' method="post" enctype="multipart/form-data">
                                                                        <input type="file" id="file_upload" name="file_upload" />
                                                                        <div class='sk-spinner sk-spinner-fading-circle' id='spinr3' style='display:none; margin:0'>
                                                                            <div class='sk-circle1 sk-circle'></div>
                                                                            <div class='sk-circle2 sk-circle'></div>
                                                                            <div class='sk-circle3 sk-circle'></div>
                                                                            <div class='sk-circle4 sk-circle'></div>
                                                                            <div class='sk-circle5 sk-circle'></div>
                                                                            <div class='sk-circle6 sk-circle'></div>
                                                                            <div class='sk-circle7 sk-circle'></div>
                                                                            <div class='sk-circle8 sk-circle'></div>
                                                                            <div class='sk-circle9 sk-circle'></div>
                                                                            <div class='sk-circle10 sk-circle'></div>
                                                                            <div class='sk-circle11 sk-circle'></div>
                                                                            <div class='sk-circle12 sk-circle'></div>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary">Upload</button>
                                                                        
                                                                    </form>
                                                                <!-- </div> -->
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn btn-danger btn-facebook btn-outline pull-right" onclick="truncate_nrk_ssl()">
                                                    <i class="fa fa-trash"></i>&nbsp; Truncate Tabel
                                                </button>
                                            </div>
                                            <br/>
                                            <br/>
                                            <div class="col-md-12">
                                                <table id="tbl_nrk_ssl" class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <td align="left" width="4%"><b>No</b></td>
                                                            <td align="left" ><b>NRK</b></td>
                                                           <!--  <td align="center" ><b>Jenis Tabel</b></td>
                                                            <td align="center" ><b>Jenis Gaji</b></td>
                                                            <td align="center" ><b>Action</b></td>
 -->                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <div id="spinner_tbl_nrk_ssl"></div>
                                                    </tbody>
                                                </table> 
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <br/>
                                    <?php } ?>									

                                    <div class="ibox-content">
                                        <!-- <div class="form-group pickerpicker" id="data_8">
                                            <label class="col-sm-2 control-label">Tanggal Batch<span class="required">*</span></label>&nbsp;&nbsp;
                                            <div class="input-group col-sm-7 date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="thblkrimitkd" name="thblkrimitkd" placeholder="Tahun Bulan" value="" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-danger btn-facebook btn-outline" onclick="javascript:showKrimi(this)"><i class="fa fa-refresh"></i>&nbsp; Tampilkan
                                            </button>
                                        </div> -->
                                        <div class="row">
                                            <form role="form" class="form-inline" id="pph" action="javascript:">
                                                <div class="row">

                                                    <div class="form-group" id="data_2">
                                                        <label class="col-sm-2 control-label">Tanggal Batch<span class="required">*</span></label>&nbsp;&nbsp;
                                                        <div class="input-group date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" id="thbl_ssl" name="thbl_ssl" readonly="">
                                                        </div>

                                                        <button class="btn btn-danger btn-facebook btn-outline" onclick="javascript:showGaji_ssl(this)">
                                                            <i class="fa fa-refresh"></i>&nbsp; Tampilkan Gaji Susulan
                                                        </button>

                                                    </div>


                                                    <!-- <button class="btn btn-primary" type="submit">Save</button> -->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="row" id="div_gj_ssl" style="display: none">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                	<?php if($user_group == '46') { ?> <!--hanya muncul jika group batching-->
                                                    <div class="center">
                                                        <button class="btn btn-primary btn-rounded btn-block btn-outline" onclick="javascript:excute_gaji_ssl();"><i class="fa fa-info-circle"></i> Eksekusi Gaji Susulan</button>
                                                    
                                                    </div>
                                                    <br/><br/>
                                                    <?php } ?>
                                                    <table id="table_gj_ssl" class="table table-bordered table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <td align="left" width="3%"><b>No</b></td>
                                                                <td align="left" ><b>THBL</b></td>
                                                                <td align="left" ><b>NRK</b></td>
                                                                <td align="left" ><b>Nama</b></td>
                                                                <td align="left" ><b>Gaji Bersih</b></td>
                                                                <td align="left" ><b>Nama Lokasi</b></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <div id="spinner_tablegaji_ssl"></div>
                                                        </tbody>
                                                    </table>                                    
                                                </div>
                                            </div>
                                        </div> <!--end DIV PTT -->
                                    </div>
                                </div> <!-- end div tab4-->

                                <!-- Tab 5 -->
                                <div id="tab-5" class="tab-pane">
                                    <div class="ibox-content">
                                        <div class="row">
                                            <form role="form" class="form-inline" action="javascript:">
                                                <div class="row">

                                                    <div class="form-group pickerpicker" id="data_8">
                                                        <label class="col-sm-2 control-label">Tanggal Batch<span class="required">*</span></label>&nbsp;&nbsp;
                                                        <div class="input-group col-sm-7 date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="thbl13" name="thbl13" placeholder="Tahun Bulan" value="" class="form-control" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <button class="btn btn-danger btn-facebook btn-outline" onclick="javascript:showGaji13(this)"><i class="fa fa-refresh"></i>&nbsp; Tampilkan Gaji 13
                                                        </button>
                                                    </div>

                                                </div>
                                            </form>

                                            <?php if($user_group == '46') { ?> <!--hanya muncul jika group batching-->
                                            <div class="ibox-title" id="buteksGaji13" style="display: none">
                                                <div class="form-inline">
                                                <div class="form-group pickerpicker col-sm-4" id="data_7">
                                                        <label class="col-sm-3 control-label">Dari Bulan<span class="required">*</span></label>&nbsp;&nbsp;
                                                        <div class="input-group col-sm-7 date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="thblGajiLain" name="thblGajiLain" placeholder="Tahun Bulan" value="" class="form-control" readonly>
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-sm-8">
                                                    <button class="btn btn-primary btn-rounded btn-block btn-outline" id="but_krimi" onclick="javascript:excute_Gaji13();"><i class="fa fa-info-circle"></i> Eksekusi Gaji 13</button>
                                                </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div><!--end div row-->

                                        <div class="row" id="V_gaji13" style="display:none">
                                            <div class="ibox-content">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="table13" class="table table-bordered table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <td align="left" width="3%"><b>No</b></td>
                                                                    <td align="left" ><b>THBL</b></td>
                                                                    <td align="left" ><b>NRK</b></td>
                                                                    <td align="left" ><b>NAMA</b></td>
                                                                    <td align="left" ><b>GAPOK</b></td>
                                                                    <td align="left" ><b>JUMLAH BERSIH</b></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <div id="spinner_tablekrimitkd"></div>
                                                            </tbody>
                                                        </table>                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!--end DIV KRIMI TKD -->
                                    </div>
                                </div> <!-- end DIV TAB 5-->


                                <!-- Tab 6 -->
                                <div id="tab-6" class="tab-pane">
                                    <div class="ibox-content">
                                        <div class="row">
                                            <form role="form" class="form-inline" action="javascript:">
                                                <div class="row">

                                                    <div class="form-group pickerpicker" id="data_8">
                                                        <label class="col-sm-2 control-label">Tanggal Batch<span class="required">*</span></label>&nbsp;&nbsp;
                                                        <div class="input-group col-sm-7 date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="thbl14" name="thbl14" placeholder="Tahun Bulan" value="" class="form-control" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <button class="btn btn-danger btn-facebook btn-outline" onclick="javascript:showGaji14(this)"><i class="fa fa-refresh"></i>&nbsp; Tampilkan Gaji 14
                                                        </button>
                                                    </div>

                                                </div>
                                            </form>

                                            <?php if($user_group == '46') { ?> <!--hanya muncul jika group batching-->
                                            <div class="ibox-title" id="buteksGaji14" style="display: none">
                                                <div class="form-inline">
                                                <div class="form-group pickerpicker col-sm-4" id="data_7">
                                                        <label class="col-sm-3 control-label">Dari Bulan<span class="required">*</span></label>&nbsp;&nbsp;
                                                        <div class="input-group col-sm-7 date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="thblGajiLain14" name="thblGajiLain14" placeholder="Tahun Bulan" value="" class="form-control" readonly>
                                                        </div>
                                                    
                                                </div>
                                                <div class="col-sm-8">
                                                    <button class="btn btn-primary btn-rounded btn-block btn-outline" id="but_krimi" onclick="javascript:excute_Gaji14();"><i class="fa fa-info-circle"></i> Eksekusi Gaji 14</button>
                                                </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div><!--end div row-->

                                        <div class="row" id="V_gaji14" style="display:none">
                                            <div class="ibox-content">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="table14" class="table table-bordered table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <td align="left" width="3%"><b>No</b></td>
                                                                    <td align="left" ><b>THBL</b></td>
                                                                    <td align="left" ><b>NRK</b></td>
                                                                    <td align="left" ><b>NAMA</b></td>
                                                                    <td align="left" ><b>GAPOK</b></td>
                                                                    <td align="left" ><b>JUMLAH BERSIH</b></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <div id="spinner_table14"></div>
                                                            </tbody>
                                                        </table>                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!--end DIV KRIMI TKD -->
                                    </div>
                                </div> <!-- end DIV TAB 6-->


                                <!-- Tab 7 -->
                                <div id="tab-7" class="tab-pane">
                                    <div class="ibox-content">
                                        <div class="row">
                                            <form role="form" class="form-inline" action="javascript:">
                                                <div class="row">
                                                    <input type="hidden" readonly="" id="idt7" name="idt7" class="form-control">
                                                    <div class="form-group pickerpicker" id="data_9">
                                                        <label class="col-sm-2 control-label">Tanggal Batch<span class="required">*</span></label>&nbsp;&nbsp;
                                                        <div class="input-group col-sm-7 date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="thbltrans" name="thbltrans" placeholder="Tahun Bulan" value="" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-danger btn-facebook btn-outline" onclick="javascript:showTrans(this)"><i class="fa fa-refresh"></i>&nbsp; Tampilkan
                                                        </button>
                                                        <button class="btn btn-primary btn-facebook btn-outline" onclick="javascript:cetak_transport(this)">
                                                            <i class="fa fa-print"></i>&nbsp; Download File TKD Transport
                                                        </button>
                                                    </div>

                                                    <div class="ibox-title" id="butekstrans" style="display: none">
                                                         
                                                        <button class="btn btn-primary btn-rounded btn-block btn-outline" id="but_trans" onclick="javascript:excute_transport();"><i class="fa fa-info-circle"></i> Eksekusi TKD Transport</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div><!--end div row-->

                                        <div class="row" id="VTKDTrans" style="display:none">
                                            <div class="ibox-content">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="tabletkdtrans" class="table table-bordered table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <td align="left" width="3%"><b>No</b></td>
                                                                    <td align="left" ><b>THBL</b></td>
                                                                    <td align="left" ><b>NRK</b></td>
                                                                    <td align="left" ><b>NAMA</b></td>
                                                                    <td align="left" ><b>LOKASI KERJA</b></td>
                                                                    <td align="left" ><b>LOKASI GAJI</b></td>
                                                                    <td align="left" ><b>JABATAN</b></td>
                                                                    <td align="left" ><b>PANGKAT</b></td>
                                                                    <td align="left" ><b>JUMLAH BERSIH</b></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <div id="spinner_tabletkdtrans"></div>
                                                            </tbody>
                                                        </table>                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!--end DIV KRIMI TKD -->
                                    </div>
                                </div> <!-- end DIV TAB 7-->
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

    <!-- Jquery Validate -->
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/validate/jquery.validate.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/iCheck/icheck.min.js"></script>
    <!-- DROPZONE -->
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dropzone/dropzone.js"></script>

    <script>
        $(document).ready(function(){

            Dropzone.options.myAwesomeDropzone = {

                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 100,

                // Dropzone settings
                init: function() {
                    var myDropzone = this;

                    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                    });
                    this.on("sendingmultiple", function() {
                    });
                    this.on("successmultiple", function(files, response) {
                    });
                    this.on("errormultiple", function(files, response) {
                    });
                }

            }

       });
    </script>


    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            table_nrk_ssl();
            // tbl_gj_ssl();

            // $('#data_1 .input-group.date').datepicker({
            //     todayBtn: "linked",
            //     keyboardNavigation: false,
            //     forceParse: false,
            //     calendarWeeks: true,
            //     autoclose: true,
            //     format: "yyyymm",
            //     endDate : '+1m'
            // });

            $('#data_2 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true,
                format: "yyyymm",
                endDate : '+1m'
            });


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
                format: "yyyymmdd",
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
                viewMode: "years", 
                minViewMode: "years",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "yyyy",
                endDate : 'y'
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

             $('#form_upload_nrk_ssl').on('submit',function(event){
                event.preventDefault();
            })

    		$.ajax({
			    url:   "<?php echo site_url('/admin/batch/tgl_batch')?>", 
			    type: "POST", 
			    dataType : 'json',
			    success: function(data){  /*Return from PHP side*/
                    /*alert(data.tahun);*/
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
                        $('#thbl_ssl').val(data.tglBatch);
                        $('#thblptt').val(data.tglBatch);
			    		$('#thbl').val(data.tglBatch);
                        $('#thbl13').val(data.tahun);
                        $('#thbl14').val(data.tahun);
                        $('#thblGajiLain').val(data.tglBatch);
                        $('#thblGajiLain14').val(data.tglBatch);
                        $('#thbltkd2').val(data.tglBatch);
                        $('#thbltrans').val(data.tglBatch);
			    		
			    }
			});

            $.ajax({
                url: "<?php echo site_url('/admin/batch/jml_hari_kerja')?>",
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
                url:   "<?php echo site_url('/admin/batch/tgl_batch')?>", 
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
                        $('#thbl_ssl').val(data.tgl);
                        $('#thblptt').val(data.tglBatch);
                        $('#thbl').val(data.tglBatch);
                        $('#thbl13').val(data.tahun);
                        $('#thbl14').val(data.tahun);
                        $('#thblGajiLain').val(data.tglBatch);
                        $('#thblGajiLain14').val(data.tglBatch);
                        $('#thbltkd2').val(data.tglBatch);
                        $('#thbltrans').val(data.tglBatch);
                }
            })
    }

    function reload_harikerja(){
        $.ajax({
                url: "<?php echo site_url('/admin/batch/jml_hari_kerja')?>",
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

    
    function getForm(action,key1){
                save_method = action;

                $.ajax({
                    url:  "<?php echo site_url('/admin/batch/openModal')?>", 
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
		            url: '<?php echo site_url("/admin/batch/view_gaji");?>',
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
		            url: '<?php echo site_url("/admin/batch/view_tkd");?>',
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
		            url: '<?php echo site_url("/admin/batch/view_guru");?>',
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
    function showGaji(){
        var tgl_batch3 = $('#tgl_batch3').val();
        // alert(tgl_batch3);

        if(tgl_batch3!=''){
            $('#VGAJI').show();
            tabelGaji();
        }else{
            $('#VGAJI').hide();
            // alert(tgl_batch2);
        }
    }

    function showGaji_ssl(){
        var thbl_ssl = $('#thbl_ssl').val();
        // alert(tgl_batch3);

        if(thbl_ssl!=''){
            $('#div_gj_ssl').show();
            tbl_gj_ssl()
        }else{
            $('#div_gj_ssl').hide();
        }
        
    }
    
 
    function showPTT()
    {

        $('#RPTT').hide();
        $('#VPTT').show();
            tabelPTT();

        $('#divptt').show();
    }



    function hidePTT()
    {
        $('#VPTT').hide();
    }

    function showGaji13()
    {
        $('#V_gaji13').show();
        tabelgaji13();

        $('#buteksGaji13').show();
    }

    function showGaji14()
    {
        $('#V_gaji14').show();
        tabelgaji14();

        $('#buteksGaji14').show();
    }

    // function showTKD2()
    // {
    //     $('#VTKDGuru').show();
    //     $('#VTKD2').show();
    //     $('#butekstkd2').show();

    //     tabelTKD2();
    //     tabelTKDGuru();
        
    // }

    function showTKD2()
    {
        $('#VTKDGuru').hide();
        $('#VTKD2').show();

        tabelTKD2();
        //$('#buteksguru').hide();
        $('#butekstkd2').show();
    }

    function showTKDGuru()
    {
        $('#VTKD2').hide();
        $('#VTKDGuru').show();

        tabelTKDGuru();
        $('#butekstkd2').show();
        //$('#buteksguru').show();
    }

    function showTrans()
    {
        $('#VTKDTrans').show();
        $('#butekstrans').show();
        tabelTKDTrans();
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

    function check_pil_input(){
        alert('pil');
    }

    
    $('#id_radio1').click(function () {
        $('#form_insert_gj_ssl').show();
        $('#form_upload_gj_ssl').hide();

    });
    $('#id_radio2').click(function () {
        $('#form_insert_gj_ssl').hide();
        $('#form_upload_gj_ssl').show();
    });
  

    function input_check(){
        alert('input');
        $('#pil_input').show();
        $('#pil_upload').hide();
    }

    function upload_check(){
        alert('upload');
        $('#pil_input').hide();
        $('#pil_upload').show();
    }

    function simpan_nrk_ssl(){
        var nrk_ssl = $('#nrk_ssl').val();
        $.ajax({
            url : '<?php echo base_url("/admin/batch/simpan_nrk_ssl"); ?>',
            type : "post",
            data : {'nrk_ssl':nrk_ssl},
            dataType : "JSON",
            beforeSend: function(){
            },
            success: function(data){
                if(data.respone == 'sukses'){
                    swal("Berhasil!", "NRK "+nrk_ssl+" berhasil disimpan", "success");
                    table_nrk_ssl();
                }else{
                    swal("Gagal", "NRK "+nrk_ssl+"  gagal disimpan", "error");
                }
            },
            error : function (jqXHR, textStatus, errorThrown){
               table_nrk_ssl();
               swal("Gagal", "NRK "+nrk_ssl+"  gagal disimpan", "error");
            },
            complete: function(){
                table_nrk_ssl();
            }
        });
    }


    function validateForm_excel()
    {
        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }
 
        if(!hasExtension('file_upload', ['.xls','.xlsx','.csv'])){
            // alert("Hanya file XLS/XLSX yang diijinkan.");
            swal("Gagal", "Hanya file XLS/XLSX/CSV yang diijinkan", "error");
            return false;
        }else{
            
            insert_excel();
        }
    }

    function insert_excel(){
        // alert('upload');
        var formdata = new FormData();      
        var file = $('#file_upload')[0].files[0];

       
        
        formdata.append('fFile', file);

        // alert($('#form_upload_nrk_ssl').serializeArray());
        $.each($('#form_upload_nrk_ssl').serializeArray(), function(a, b){


            formdata.append(b.name, b.value);
        });

          $.ajax({
            url: '<?php echo base_url("/admin/batch/upload_nrk_ssl"); ?>',
            data: formdata,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType:'JSON',
            beforeSend: function(){
              // add event or loading animation
             $('#spinr3').show();
            },
            success: function(data) {
                //console.log(data.response);    
                if(data.response == 'sukses')
                {
                    $('#spinr3').hide();
                    swal("Berhasil", "Berhasil upload data", "success"); 
                    table_nrk_ssl();
                }
                else
                {
                    $('#spinr3').hide();
                    swal("Gagal", "Gagal upload data", "error");
                    table_nrk_ssl();
                }
              
            },
            error: function(xhr) 
            {     
                $('#spinr3').hide();
                swal("Gagal", "Gagal upload data", "error");   
                table_nrk_ssl();        
            }
        });

        
      
    }


    function truncate_nrk_ssl(){
        swal({
          title: "Peringatan",
          text: "Apakah anda ingin menghapus data NRK Susulan",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya, Hapus!",
          cancelButtonText: "Tidak!",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm) {
            truncate_nrk_ssl1();
          } else {
                swal("Gagal", "Data gagal dihapus", "error");
          }
        });
    }

    function truncate_nrk_ssl1(){
        // swal("Deleted!", "Your imaginary file has been deleted.", "success");
        var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 

        $.ajax({
            url : '<?php echo base_url("/admin/batch/truncate_nrk_ssl"); ?>',
            type : "post",
            dataType : "JSON",
            beforeSend: function(){
                $('#spinner_tbl_nrk_ssl').html(spinner);
            },
            success: function(data){
                if(data.respone == 'sukses'){
                    swal("Berhasil!", "Berhasil hapus data!", "success");
                }else{
                    swal("Gagal", "Data gagal dihapus", "error");
                }
            },
            error : function (jqXHR, textStatus, errorThrown){
               
            },
            complete: function(){
                $('#spinner_tbl_nrk_ssl').html('');
                table_nrk_ssl();
            }
        });
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


    function reload_tbl1()
    {
        $('#tbl1').DataTable().ajax.reload();
    }

    function validAngka(a)
    {
        if(!/^[0-9.]+$/.test(a.value))
        {
        a.value = a.value.substring(0,a.value.length-1000);
        }
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

        $('#form_gj_ssl').bootstrapValidator({
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
                nrk_ssl: {
                    validators: {
                        notEmpty: {
                            message: 'NRK tidak boleh kosong'
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
            url :"<?php echo site_url('/admin/batch/data_plain')?>", // json datasource
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
                    url :"<?php echo site_url('/admin/batch/data_gajiLain')?>", // json datasource
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
            

            // setInterval( function () {
            //     $('#tbl1').DataTable().ajax.reload();
            // }, 1000 );


            $('#tbl2 input').unbind();
            $('#tbl2 input').bind('keyup', function(e) {
            if(e.keyCode == 13) {
            oTable.fnFilter(this.value);
            }
            });
    }

	function tabelGaji(){
        var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 

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
                    url :"<?php echo site_url('/admin/batch/dataGaji')?>", // json datasource
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

    function tbl_gj_ssl(){
        var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 

        var dataTable = $('#table_gj_ssl').DataTable( {
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
                    url :"<?php echo site_url('/admin/batch/dataGaji_ssl')?>", // json datasource
                    type: "post",  // method  , by default get
                    // drawCallback: function( settings ) {
                      
                    // },
                    data : function(d){
                        d.thbl_ssl = $('#thbl_ssl').val();
                    },
                    beforeSend: function(){
                        $('#spinner_tablegaji_ssl').html(spinner);
                    },complete: function(){
                             $("#spinner_tablegaji_ssl").html('');
                    },
                    error: function(){  // error handling
                        $(".table_gj_ssl-error").html("");
                        $("#table_gj_ssl").append('<tbody class="table_gj_ssl-error"><tr><div colspan=6>Tidak Ada Data</div></tr></tbody>');
                        $("#table_gj_ssl_processing").css("display","none");
                        
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

    function tabelPPH(){
        var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 

        var dataTable = $('#tablepph').DataTable( {
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
                    url :"<?php echo site_url('/admin/batch/dataPPH')?>", // json datasource
                    type: "post",  // method  , by default get
                    // drawCallback: function( settings ) {
                      
                    // },
                    data : function(d){
                        d.tgl_batch2 = $('#tgl_batch2').val();
                    },
                    beforeSend: function(){
                        // $("#tbl1_processing").css("display","none");
                        // $('#spinner2').html("<div class='sk-spinner sk-spinner-three-bounce'><div class='sk-bounce1'></div><div class='sk-bounce2'></div><div class='sk-bounce3'></div></div>");
                    $('#spinner_tablepph').html(spinner);
                    },complete: function(){
                             $("#spinner_tablepph").html('');
                    },
                    error: function(){  // error handling
                        $(".tablepph-error").html("");
                        $("#tablepph").append('<tbody class="tablepph-error"><tr><div colspan=6>Tidak Ada Data</div></tr></tbody>');
                        $("#tablepph_processing").css("display","none");
                        
                    }

                }
              

            } );
            

            // setInterval( function () {
            //     $('#tbl1').DataTable().ajax.reload();
            // }, 1000 );


            $('#tablepph input').unbind();
            $('#tablepph input').bind('keyup', function(e) {
            if(e.keyCode == 13) {
            oTable.fnFilter(this.value);
            }
            });
    }

    function tabelPTT(){
        var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 

        var dataTable = $('#tableptt').DataTable( {
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
                    url :"<?php echo site_url('/admin/batch/dataPTT')?>", // json datasource
                    type: "post",  // method  , by default get
                    // drawCallback: function( settings ) {
                      
                    // },
                    data : function(d){
                        //d.thbl_ptt = $('#thbl_ptt').val();
                    },
                    beforeSend: function(){
                        // $("#tbl1_processing").css("display","none");
                        // $('#spinner2').html("<div class='sk-spinner sk-spinner-three-bounce'><div class='sk-bounce1'></div><div class='sk-bounce2'></div><div class='sk-bounce3'></div></div>");
                    $('#spinner_tableptt').html(spinner);
                    },complete: function(){
                             $("#spinner_tableptt").html('');
                    },
                    error: function(){  // error handling
                        $(".tableptt-error").html("");
                        $("#tableptt").append('<tbody class="tableptt-error"><tr><div colspan=6>Tidak Ada Data</div></tr></tbody>');
                        $("#tableptt_processing").css("display","none");
                        
                    }

                }/*,"initComplete": function() {
                        var $searchInput = $('div.dataTables_filter input');
             
                        $searchInput.unbind();
             
                        $searchInput.bind('keyup', function(e) {
                            if(e.keyCode == 13) {
                                dataTable.search( this.value ).draw();
                            }


                    });  }*/
              

            

            // setInterval( function () {
            //     $('#tbl1').DataTable().ajax.reload();
            // }, 1000 );


           /* $('#tableptt input').unbind();
            $('#tableptt input').bind('keyup', function(e) {
            if(e.keyCode == 13) {
            oTable.fnFilter(this.value);
            }*/
            });
    }

    function tabelPTTRes(){
        var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 

        var dataTable = $('#tablepttres').DataTable( {
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
                    url :"<?php echo site_url('/admin/batch/dataPTTRes')?>", // json datasource
                    type: "post",  // method  , by default get
                    // drawCallback: function( settings ) {
                      
                    // },
                    data : function(d){
                        //d.thbl_ptt = $('#thbl_ptt').val();
                    },
                    beforeSend: function(){
                        // $("#tbl1_processing").css("display","none");
                        // $('#spinner2').html("<div class='sk-spinner sk-spinner-three-bounce'><div class='sk-bounce1'></div><div class='sk-bounce2'></div><div class='sk-bounce3'></div></div>");
                    $('#spinner_tablepttres').html(spinner);
                    },complete: function(){
                             $("#spinner_tablepttres").html('');
                    },
                    error: function(){  // error handling
                        $(".tablepttres-error").html("");
                        $("#tablepttres").append('<tbody class="tablepttres-error"><tr><div colspan=6>Tidak Ada Data</div></tr></tbody>');
                        $("#tablepttres_processing").css("display","none");
                        
                    }

                }/*,"initComplete": function() {
                        var $searchInput = $('div.dataTables_filter input');
             
                        $searchInput.unbind();
             
                        $searchInput.bind('keyup', function(e) {
                            if(e.keyCode == 13) {
                                dataTable.search( this.value ).draw();
                            }


                    });  }*/
              

            

            // setInterval( function () {
            //     $('#tbl1').DataTable().ajax.reload();
            // }, 1000 );


           /* $('#tableptt input').unbind();
            $('#tableptt input').bind('keyup', function(e) {
            if(e.keyCode == 13) {
            oTable.fnFilter(this.value);
            }*/
            });
    }

    function table_nrk_ssl(){
        var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 

        var dataTable = $('#tbl_nrk_ssl').DataTable( {
                "columns": [
                          { "width": "10%" },
                          null
                          ],
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
                    url :"<?php echo site_url('/admin/batch/data_nrk_ssl')?>", // json datasource
                    type: "post",  // method  , by default get
                    // drawCallback: function( settings ) {
                      
                    // },
                    data : function(d){
                    },
                    beforeSend: function(){
                        $('#spinner_tbl_nrk_ssl').html(spinner);
                    },complete: function(){
                             $("#spinner_tbl_nrk_ssl").html('');
                    },
                    error: function(){  // error handling
                        $(".tbl_nrk_ssl-error").html("");
                        $("#tbl_nrk_ssl").append('<tbody class="tbl_nrk_ssl-error"><tr><div colspan=2>Tidak Ada Data</div></tr></tbody>');
                        $("#tbl_nrk_ssl_processing").css("display","none");
                        
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


    function tabelgaji13(){
        var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 

        var dataTable = $('#table13').DataTable( {
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
                    url :"<?php echo site_url('/admin/batch/dataGaji13')?>", // json datasource
                    type: "post",  // method  , by default get
                    // drawCallback: function( settings ) {
                      
                    // },
                    data : function(d){
                        d.tahun = $('#thbl13').val();
                    },
                    beforeSend: function(){
                        // $("#tbl1_processing").css("display","none");
                        // $('#spinner2').html("<div class='sk-spinner sk-spinner-three-bounce'><div class='sk-bounce1'></div><div class='sk-bounce2'></div><div class='sk-bounce3'></div></div>");
                    $('#spinner_tablekrimitkd').html(spinner);
                    },complete: function(){
                             $("#spinner_tablekrimitkd").html('');
                    },
                    error: function(){  // error handling
                        $(".table13-error").html("");
                        $("#table13").append('<tbody class="table13-error"><tr><div colspan=6>Tidak Ada Data</div></tr></tbody>');
                        $("#table13_processing").css("display","none");
                        
                    }

                }
              
            });

            $('#table13 input').unbind();
            $('#table13 input').bind('keyup', function(e) {
            if(e.keyCode == 13) {
            oTable.fnFilter(this.value);
            }
            });
    }

    function tabelgaji14(){
        var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 

        var dataTable = $('#table14').DataTable( {
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
                    url :"<?php echo site_url('/admin/batch/dataGaji14')?>", // json datasource
                    type: "post",  // method  , by default get
                    // drawCallback: function( settings ) {
                      
                    // },
                    data : function(d){
                        d.tahun = $('#thbl14').val();
                    },
                    beforeSend: function(){
                        // $("#tbl1_processing").css("display","none");
                        // $('#spinner2').html("<div class='sk-spinner sk-spinner-three-bounce'><div class='sk-bounce1'></div><div class='sk-bounce2'></div><div class='sk-bounce3'></div></div>");
                    $('#spinner_table14').html(spinner);
                    },complete: function(){
                             $("#spinner_table14").html('');
                    },
                    error: function(){  // error handling
                        $(".table14-error").html("");
                        $("#table14").append('<tbody class="table14-error"><tr><div colspan=6>Tidak Ada Data</div></tr></tbody>');
                        $("#table14_processing").css("display","none");
                        
                    }

                }
                
              
            });

            $('#table14 input').unbind();
            $('#table14 input').bind('keyup', function(e) {
            if(e.keyCode == 13) {
            oTable.fnFilter(this.value);
            }
            });
    }

    function tabelTKD2(){
        var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 

        var dataTable = $('#tabletkd2').DataTable( {
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
                    url :"<?php echo site_url('/admin/batch/datatkd2')?>", // json datasource
                    type: "post",  // method  , by default get
                    // drawCallback: function( settings ) {
                      
                    // },
                    data : function(d){
                        d.thbl = $('#thbltkd2').val();
                    },
                    beforeSend: function(){
                        // $("#tbl1_processing").css("display","none");
                        // $('#spinner2').html("<div class='sk-spinner sk-spinner-three-bounce'><div class='sk-bounce1'></div><div class='sk-bounce2'></div><div class='sk-bounce3'></div></div>");
                    $('#spinner_tabletkd2').html(spinner);
                    },complete: function(){
                             $("#spinner_tabletkd2").html('');
                    },
                    error: function(){  // error handling
                        $(".tabletkd2-error").html("");
                        $("#tabletkd2").append('<tbody class="tabletkd2-error"><tr><div colspan=6>Tidak Ada Data</div></tr></tbody>');
                        $("#tabletkd2_processing").css("display","none");
                        
                    }

                },"initComplete": function() {
                        var $searchInput = $('div.dataTables_filter input');
             
                        $searchInput.unbind();
             
                        $searchInput.bind('keyup', function(e) {
                            if(e.keyCode == 13) {
                                dataTable.search( this.value ).draw();
                            }


                    });  }
              
            });
    }

    function tabelTKDGuru(){
        var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 

        var dataTable = $('#tabletkdguru').DataTable( {
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
                    url :"<?php echo site_url('/admin/batch/datatkdguru')?>", // json datasource
                    type: "post",  // method  , by default get
                    // drawCallback: function( settings ) {
                      
                    // },
                    data : function(d){
                        d.thbl = $('#thbltkd2').val();
                    },
                    beforeSend: function(){
                        // $("#tbl1_processing").css("display","none");
                        // $('#spinner2').html("<div class='sk-spinner sk-spinner-three-bounce'><div class='sk-bounce1'></div><div class='sk-bounce2'></div><div class='sk-bounce3'></div></div>");
                    $('#spinner_tabletkdguru').html(spinner);
                    },complete: function(){
                             $("#spinner_tabletkdguru").html('');
                    },
                    error: function(){  // error handling
                        $(".tabletkdguru-error").html("");
                        $("#tabletkdguru").append('<tbody class="tabletkdguru-error"><tr><div colspan=6>Tidak Ada Data</div></tr></tbody>');
                        $("#tabletkdguru_processing").css("display","none");
                        
                    }

                },"initComplete": function() {
                        var $searchInput = $('div.dataTables_filter input');
             
                        $searchInput.unbind();
             
                        $searchInput.bind('keyup', function(e) {
                            if(e.keyCode == 13) {
                                dataTable.search( this.value ).draw();
                            }


                    });  }
              
            });
    }

    function tabelTKDTrans(){
        //alert($('#thbltrans').val());
        var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 

        var dataTable = $('#tabletkdtrans').DataTable( {
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
                    url :"<?php echo site_url('/admin/Batch/datatkdtransp')?>", // json datasource
                    type: "post",  // method  , by default get
                    // drawCallback: function( settings ) {
                      
                    // },
                    data : function(d){
                        d.thbl = $('#thbltrans').val();
                    },
                    beforeSend: function(){
                        // $("#tbl1_processing").css("display","none");
                        // $('#spinner2').html("<div class='sk-spinner sk-spinner-three-bounce'><div class='sk-bounce1'></div><div class='sk-bounce2'></div><div class='sk-bounce3'></div></div>");
                    $('#spinner_tabletkdtrans').html(spinner);
                    },complete: function(){
                             $("#spinner_tabletkdtrans").html('');
                    },
                    error: function(){  // error handling
                        $(".tabletkdtrans-error").html("");
                        $("#tabletkdtrans").append('<tbody class="tabletkdtrans-error"><tr><div colspan=6>Tidak Ada Data</div></tr></tbody>');
                        $("#tabletkdtrans_processing").css("display","none");
                        
                    }

                },"initComplete": function() {
                        var $searchInput = $('div.dataTables_filter input');
             
                        $searchInput.unbind();
             
                        $searchInput.bind('keyup', function(e) {
                            if(e.keyCode == 13) {
                                dataTable.search( this.value ).draw();
                            }


                    });  }
              
            });
    }
</script>

<script type="text/javascript">
    function savePengLain(){

    	// alert('tes');

        $.ajax({
            url : '<?php echo base_url("/admin/batch/save_pengLain"); ?>',
            type : "post",
            data : $('#pengLain').serialize(),
            dataType : "JSON",
            beforeSend: function(){

            },
            success: function(data){
                if(data.respone == 'ada data'){
                    swal("Gagal!", "Data sudah ada!", "error");
                }else if(data.respone == 'tidak cocok'){
                    swal("Gagal!", "Jumlah tanggal Batch atau THBL tidak sesuai!", "error");
                }else if(data.respone == 'tgl != thbl'){
                    swal("Gagal!", "Tanggal Batch tidak sesuai dengan THBL!", "error");
                }else{
                    swal("sukses!", "Berhasil tambah data!", "success");
                }
            },
            error : function (jqXHR, textStatus, errorThrown){
               
            },
            complete: function(){
                reload_tglBatch();
                reload_tbl1();
                reload_tbl2();
            }
        });
    }
</script>

<script type="text/javascript">

	function saveGaji(){
		$.ajax({
			url : '<?php echo base_url("/admin/batch/savepph"); ?>',
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
        

	function savePPH(){
		$.ajax({
			url : '<?php echo base_url("/admin/batch/savepph"); ?>',
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


	function deletePlain(thbl){
		// alert(thbl);
		var thbl = thbl;
		$.ajax({
			beforeSend : function(){
				swal({
					  title: "Apakah anda benar ingin menghapus data dengan THBL "+thbl+" ?",
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
					    deletePlain2(thbl);
					  } else {
						    swal("Gagal", "Gagal hapus data dengan THBL "+thbl, "error");
					  }
					}
					);

			}
		});
	}

	function deletePlain2(thbl){
		// alert(thbl);
		// var thbl = thbl;
		$.ajax({
			url: '<?php echo base_url("/admin/batch/hps_plain"); ?>',
			type: "post",
			data: {thbl : thbl},
			dataType: "JSON",
			beforeSend: function(){
				$('#modalExcPenglain').modal('show');
			},
			
			success : function(data){
				if(data.respone== 'sukses'){
					swal("Sukses!", "Berhasil hapus data dengan THBL "+thbl, "success");
					$('#modalExcPenglain').modal('hide');
				}else{
					swal("Gagal", "Gagal hapus data dengan THBL "+thbl, "error");
					$('#modalExcPenglain').modal('hide');
				}

			},
			complete : function(){
				reload_tbl2();
                reload_tbl1();
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
			url : '<?php echo base_url("/admin/batch/cek_gaji") ?>',
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
            url: '<?php echo base_url("/admin/batch/exc_gaji") ?>',
            type: "post",
            data: {tgl_batch3:tgl_batch3, idt3:idt3},
            dataType: "JSON",
            beforeSend: function(){
                $('#modalExcPenglain').modal('show');
            },
            success: function(data){
                if(data.respone=='sukses'){
                    swal("Sukses", "Berhasil Eksekusi Gaji dengan Tanggal Batch "+tgl_batch3, "success");
                    $('#modalExcPenglain').modal('hide');
                    reload_tglBatch();
                    tabelGaji();

                }else{
                    swal("Gagal", "Data Gaji untuk Tanggal Batch "+tgl_batch3+" sudah ada ", "error");
                    $('#modalExcPenglain').modal('hide');
                }
                
            },
            /*error: function(xhr) {                              
                setTimeout(function() {
                    swal("Sukses", "Berhasil Eksekusi Gaji", "success");
                    $('#modalExcPenglain').modal('hide');
                    reload_tglBatch();
                    tabelGaji();
                }, 600000);
            }*/
            error: function (xhr, status, err) {                       
                var str = xhr.responseText;
                alert(str);
                $('#modalExcPenglain').modal('hide');
                reload_tglBatch();
                tabelGaji();
            }
            ,
            complete: function(){
                // $('#modalExcPenglain').modal('hide');
                // reload_tglBatch();

                setTimeout(function() {
                    swal("Sukses", "Berhasil Eksekusi Gaji", "success");
                    $('#modalExcPenglain').modal('hide');
                    reload_tglBatch();
                    tabelGaji();
                }, 600000);
            }
            // ,
            // complete: function(){

            //     setTimeout(function() {
            //         $('#modalExcPenglain').modal('hide');
            //         reload_tglBatch();
            //     	tabelGaji();
            //     }, 500000);
                
            //     swal("Sukses", "Berhasil Eksekusi Gaji", "success");
                
            //     $('#modalExcPenglain').modal('hide');
            //     reload_tglBatch()
            //     tabelGaji();
            // }
        });
    }

    function excute_gaji_ssl(){
        var thbl_ssl = $('#thbl_ssl').val();
        // alert(tgl_batch3);

        $.ajax({
            beforeSend : function(){
                swal({
                      title: "Apakah anda benar ingin melakukan eksekusi Gaji dengan tanggal Batch "+thbl_ssl+" ?",
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
                            excute_gaji_ssl2(thbl_ssl);
                            // alert('lanjut');
                      } else {
                            swal("Gagal", "Gagal Eksekusi Gaji dengan tanggal Batch "+thbl_ssl, "error");
                      }
                    }
                    );

            }

        });

    }

    function excute_gaji_ssl2(thbl_ssl){
        $.ajax({
            url: '<?php echo base_url("/admin/batch/exc_gaji_ssl") ?>',
            type: "post",
            data: {thbl_ssl:thbl_ssl},
            dataType: "JSON",
            beforeSend: function(){
                $('#modalExcPenglain').modal('show');
            },
            success: function(data){
                if(data.respone=='sukses'){
                    swal("Sukses", "Berhasil Eksekusi Gaji Susulan dengan Tanggal Batch "+thbl_ssl, "success");
                    $('#modalExcPenglain').modal('hide');
                    reload_tglBatch();
                    tbl_gj_ssl();

                }else{
                    swal("Gagal", "Gagal Eksekusi Gaji Susulan dengan Tanggal Batch "+thbl_ssl, "error");
                    $('#modalExcPenglain').modal('hide');
                    reload_tglBatch();
                }
                
            },
            error: function (xhr, status, err) {                       
                var str = xhr.responseText;
                alert(str);
                $('#modalExcPenglain').modal('hide');
                reload_tglBatch();
                tbl_gj_ssl();
            },
            /*error: function(){  // error handling
                swal("Gagal", "Gagal Eksekusi Gaji Susulan", "error");
                $('#modalExcPenglain').modal('hide');
                reload_tglBatch();
                tbl_gj_ssl();
                
            },*/
            complete: function(){

                setTimeout(function() {
                    swal("Sukses", "Berhasil Eksekusi Gaji Susulan", "success");
                    $('#modalExcPenglain').modal('hide');
                    reload_tglBatch();
                    tbl_gj_ssl();
                }, 500000);
                
                
                
                // $('#modalExcPenglain').modal('hide');
                // reload_tglBatch()
                // tabelGaji();
            }
        });
    }

    function exc_pph(){
        var tgl_batch2 = $('#tgl_batch2').val();
        var idt2 = $('#idt2').val();

        $.ajax({
            beforeSend : function(){
                swal({
                      title: "Apakah anda benar ingin melakukan eksekusi PPH dengan tanggal Batch "+tgl_batch2+" ?",
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
                            exc_pph2(tgl_batch2,idt2);
                      } else {
                            swal("Gagal", "Gagal Eksekusi PPH dengan tanggal Batch "+tgl_batch2, "error");
                      }
                    }
                    );

            }

        });
    }

    function exc_pph2(tgl_batch2,idt2){
        $.ajax({
            url: '<?php echo base_url("/admin/batch/exc_pph") ?>',
            type: "post",
            data: {tgl_batch2:tgl_batch2, idt2:idt2},
            dataType: "JSON",
            beforeSend: function(){
                $('#modalExcPenglain').modal('show');
            },
            success: function(data){
                if(data.respone=='sukses'){
                    swal("Sukses", "Berhasil Eksekusi PPH dengan Tanggal Batch "+tgl_batch2, "success");
                    $('#modalExcPenglain').modal('hide');

                }else if(data.respone == 'belum gaji'){
                    swal("Gagal", "Data Gaji untuk Tanggal Batch "+tgl_batch2+" belum ada ", "error");
                    $('#modalExcPenglain').modal('hide');

                }else if(data.respone == 'gagal'){
                    swal("Gagal", "Data untuk Tanggal Batch "+tgl_batch2+" sudah ada ", "error");
                    $('#modalExcPenglain').modal('hide');
                }
                
            },
            complete: function(){
                reload_tglBatch()
                tabelPPH();
            },
            error: function (xhr, status, err) {                       
                var str = xhr.responseText;
                alert(str);
                $('#modalExcPenglain').modal('hide');
                reload_tglBatch()
                tabelPPH();
            }
        });
    }


    function exc_ptt(){
        var thbl_ptt = $('#thblptt').val();
        var idt4 = $('#idt4').val();
        
        $.ajax({
            beforeSend : function(){
                swal({
                      title: "Apakah anda benar ingin melakukan eksekusi PTT dengan tahun bulan "+thbl_ptt+" ?",
                      text: "",
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

                            exc_ptt2(thbl_ptt,idt4);
                      } else {
                            swal("Gagal", "Gagal Eksekusi PTT Tahun Bulan "+thbl_ptt, "error");
                      }
                    }
                    );

            }

        });
    }

    function exc_ptt2(thbl_ptt,idt4){
        $.ajax({
            url: '<?php echo base_url("/admin/batch/exc_ptt") ?>',
            type: "post",
            data: {thbl_ptt:thbl_ptt,idt4:idt4},
            dataType: "JSON",
            beforeSend: function(){
                $('#modalExcPenglain').modal('show');
            },
            success: function(data){
                if(data.respone=='SUKSES'){
                    swal("Sukses", "Berhasil Eksekusi PTT dengan Tahun Bulan "+thbl_ptt, "success");
                    $('#modalExcPenglain').modal('hide');
                    hidePTT();
                    $('#RPTT').show();
                    tabelPTTRes();

                }else if(data.respone == 'GAGAL'){
                    swal("Gagal", "Data untuk Tahun Bulan "+thbl_ptt+" sudah ada ", "error");
                    $('#modalExcPenglain').modal('hide');
                    hidePTT();
                }
                else if(data.respone == 'DATA KOSONG'){
                    swal("Peringatan", "Data untuk Tahun Bulan "+thbl_ptt+" kosong ", "warning");
                    $('#modalExcPenglain').modal('hide');
                    hidePTT();
                }
                else if(data.respone == 'DATA SUDAH ADA'){
                    swal("Peringatan", "Data untuk Tahun Bulan "+thbl_ptt+" sudah ada ", "warning");
                    $('#modalExcPenglain').modal('hide');
                    hidePTT();
                }
                
            },
            complete: function(){
                
            }
        });
    }

	function excute_PengLain(){
		var tgl_batch =	$('#tgl_batch').val();
		// alert(tgl_batch);
		$.ajax({
			beforeSend : function(){
				swal({
					  title: "Apakah anda benar ingin melakukan eksekusi Penghasilan Lain dengan tanggal Batch "+tgl_batch+" ?",
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
					    	excute_PengLain2(tgl_batch);
					  } else {
						    swal("Gagal", "Gagal Eksekusi Penghasilan Lain dengan tanggal Batch "+tgl_batch, "error");
					  }
					}
					);

			}


		});
	}


	function excute_PengLain2(tgl_batch){
		$.ajax({
			url: '<?php echo base_url("/admin/batch/exc_pengLain") ?>',
			type: "post",
			data: {tgl_batch:tgl_batch},
			dataType: "JSON",
			beforeSend: function(){
				$('#modalExcPenglain').modal('show');
			},
			success: function(data){
				if(data.respone=='ada'){
					swal("Gagal", "Data untuk THBL "+tgl_batch+" sudah ada ", "error");
					$('#modalExcPenglain').modal('hide');
				}else if(data.respone=='tgl plain kosong'){
					swal("Gagal", "Tanggal Plain "+tgl_batch+" belum ada", "error");
					$('#modalExcPenglain').modal('hide');
				}else{
					swal("Sukses", "Berhasil Eksekusi untuk tanggal Plain "+tgl_batch, "success");
					$('#modalExcPenglain').modal('hide');
				}
				
			},
			complete: function(){
				reload_tbl2();
                reload_tbl1();
			},
            error: function(xhr, status, err) {                       
                var str = xhr.responseText;
                alert(str);
               /*swal("Sukses", "Berhasil Eksekusi ", "success");*/
                $('#modalExcPenglain').modal('hide'); 
            }
		});
    }


    function excute_Gaji13(){
    var tahun= $('#thbl13').val();
    var thbl = $('#thblGajiLain').val();
    // alert(tgl_batch);
    $.ajax({
        beforeSend : function(){
            swal({
                  title: "Warning",
                  text: "Apakah anda benar ingin melakukan eksekusi Gaji 13 untuk Tahun "+tahun+" ?",
                  // text: "Eksekusi ini akan memakan waktu sekitar 15 menit!",
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
                        excute_Gaji13_2(tahun,thbl)
                       //swal("Sukses", "Sukses Eksekusi Krimi TKD dengan tanggal Batch "+tgl_batch, "success");
                       /*alert("lanjut");*/
                  } else {
                        swal("Gagal", "Gagal Eksekusi Gaji 13 untuk Tahun "+tahun, "error");
                  }
                });
            }


        });
    }


    function excute_Gaji13_2(tahun,thbl){
        $.ajax({
            url: '<?php echo base_url("/admin/batch/exc_gaji13") ?>',
            type: "post",
            data: {tahun:tahun, thbl:thbl},
            dataType: "JSON",
            beforeSend: function(){
                $('#modalExcPenglain').modal('show');
            },
            success: function(data){
                if(data.respone=='gagal'){
                    swal("Gagal", "Data Gaji 13 untuk Tahun "+tahun+" sudah ada ", "error");
                    $('#modalExcPenglain').modal('hide');
                }else{
                    swal("Sukses", "Berhasil Eksekusi Gaji 13 untuk Tahun "+tahun, "success");
                    $('#modalExcPenglain').modal('hide');
                    reload_tglBatch();
                    tabelgaji13();
                }
                
            },
            complete: function(){
                reload_tglBatch();
                tabelgaji13();
            },
            error: function (xhr, status, err) {                       
                var str = xhr.responseText;
                alert(str);
                $('#modalExcPenglain').modal('hide');
                reload_tglBatch();
                tabelgaji13();
            }
        });
	}

    function excute_Gaji14(){
    var tahun= $('#thbl13').val();
    var thbl = $('#thblGajiLain14').val();
    // alert(tgl_batch);
    $.ajax({
        beforeSend : function(){
            swal({
                  title: "Warning",
                  text: "Apakah anda benar ingin melakukan eksekusi Gaji 14 untuk Tahun "+tahun+" ?",
                  // text: "Eksekusi ini akan memakan waktu sekitar 15 menit!",
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
                        excute_Gaji14_2(tahun,thbl)
                       //swal("Sukses", "Sukses Eksekusi Krimi TKD dengan tanggal Batch "+tgl_batch, "success");
                       /*alert("lanjut");*/
                  } else {
                        swal("Gagal", "Gagal Eksekusi Gaji 14 untuk Tahun "+tahun, "error");
                  }
                });
            }


        });
    }


    function excute_Gaji14_2(tahun,thbl){
        $.ajax({
            url: '<?php echo base_url("/admin/batch/exc_gaji14") ?>',
            type: "post",
            data: {tahun:tahun, thbl:thbl},
            dataType: "JSON",
            beforeSend: function(){
                $('#modalExcPenglain').modal('show');
            },
            success: function(data){
                if(data.respone=='gagal'){
                    swal("Gagal", "Data Gaji 14 untuk Tahun "+tahun+" sudah ada ", "error");
                    $('#modalExcPenglain').modal('hide');
                }else{
                    swal("Sukses", "Berhasil Eksekusi Gaji 14 untuk Tahun "+tahun, "success");
                    $('#modalExcPenglain').modal('hide');
                    reload_tglBatch();
                    tabelgaji14();
                }
                
            },
            complete: function(){
                reload_tglBatch();
                tabelgaji14();
            },
            error: function (xhr, status, err) {                       
                var str = xhr.responseText;
                alert(str);
                $('#modalExcPenglain').modal('hide');
                reload_tglBatch();
                tabelgaji14();
            }
        });
    }

    function excute_TKD2(){
    var tgl_batch = $('#thbltkd2').val();
    var hr_krja = $('#hr_krja').val();
    
    // $.ajax({
    //     beforeSend : function(){
            if (hr_krja == ""){
                swal("Warning", "Jumlah hari kerja tidak boleh kosong", "error");
            }else{
                swal({
                  title: "Warning",
                  text: "Apakah anda benar ingin melakukan eksekusi TKD Tahap 2 Pegawai dan Guru dengan tanggal Batch "+tgl_batch+" ?",
                  // text: "Eksekusi ini akan memakan waktu sekitar 15 menit!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Ya Lanjut!",
                  cancelButtonText: "Tidak!",
                  closeOnConfirm: true,
                  closeOnCancel: true
                },
                function(isConfirm){

                    if (isConfirm) {
                        excute_TKD2_2(tgl_batch,hr_krja);
                       //swal("Sukses", "Sukses Eksekusi Krimi TKD dengan tanggal Batch "+tgl_batch, "success");
                       // alert(tgl_batch);
                       // alert(hr_krja);
                    } else {
                        swal("Gagal", "Gagal Eksekusi Krimi TKD Tahap 2 Pegawai dan Guru dengan tanggal Batch "+tgl_batch, "error");
                    }
                });
            }  
        // }
        // });
    }

    function excute_TKD2_2(tgl_batch,hr_krja){
        $.ajax({
            url: '<?php echo base_url("/admin/batch/exc_TKD2") ?>',
            type: "post",
            data: {tgl_batch:tgl_batch,hr_krja:hr_krja},
            dataType: "JSON",
            beforeSend: function(){
                $('#modalExcPenglain').modal('show');
            },
            success: function(data){
                if(data.respone=='gagal'){
                    swal("Gagal", "Data TKD Tahap 2 Pegawai dan Guru untuk  THBL "+tgl_batch+" sudah ada ", "error");
                    $('#modalExcPenglain').modal('hide');
                }else{
                    swal("Sukses", "Berhasil Eksekusi TKD Tahap 2 Pegawai dan Guru untuk tanggal Batch "+tgl_batch, "success");
                    $('#modalExcPenglain').modal('hide');
                }
                
            },
            complete: function(){
                reload_tglBatch();
                reload_harikerja();
                tabelTKD2();
                tabelTKDGuru();
            }
            ,
            error: function(){  // error handling
                swal("Sukses", "Berhasil Eksekusi TKD Tahap 2 Pegawai dan Guru untuk tanggal Batch "+tgl_batch, "success");
                $('#modalExcPenglain').modal('hide');        
                // swal("Gagal", "Error", "error");
                
            }
        });
    }

    function excute_transport(){
    var tgl_batch = $('#thbltrans').val();
    
    $.ajax({
        beforeSend : function(){

                swal({
                  title: "Warning",
                  text: "Apakah anda benar ingin melakukan eksekusi Transport dengan tanggal Batch "+tgl_batch+" ?",
                  // text: "Eksekusi ini akan memakan waktu sekitar 15 menit!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Ya Lanjut!",
                  cancelButtonText: "Tidak!",
                  closeOnConfirm: true,
                  closeOnCancel: true
                },
                function(isConfirm){

                    if (isConfirm) {
                        excute_transport_2(tgl_batch);
                    } else {
                        swal("Gagal", "Gagal Eksekusi Transport dengan tanggal Batch "+tgl_batch, "error");
                    }
                });
              
            }
        });
    }

    function excute_transport_2(tgl_batch){
        $.ajax({
            url: '<?php echo base_url("/admin/batch/exc_Transport") ?>',
            type: "post",
            data: {tgl_batch:tgl_batch},
            dataType: "JSON",
            beforeSend: function(){
                $('#modalExcPenglain').modal('show');
            },
            success: function(data){
                if(data.respone=='gagal'){
                    swal("Gagal", "Data Transport untuk  THBL "+tgl_batch+" sudah ada ", "error");
                    $('#modalExcPenglain').modal('hide');
                }else{
                    swal("Sukses", "Berhasil Eksekusi Transport untuk tanggal Batch "+tgl_batch, "success");
                    $('#modalExcPenglain').modal('hide');
                }
                
            },
            complete: function(){
                reload_tglBatch();
                tabelTKDTrans();
            }
            // ,
            // error: function(){  // error handling
            //     $('#modalExcPenglain').modal('hide');        
            //     swal("Gagal", "Error", "error");
                
            // }
        });
    }

    // cetak file TXT
    function cetak_gajiTXT(){
        var tgl_batch3 = $('#tgl_batch3').val();
        $.ajax({
            url : '<?php echo base_url("/admin/batch/cek_gj") ?>',
            type: "post",
            data: {tgl_batch3:tgl_batch3},
            dataType: "JSON",
            
            success : function(data){
                // alert(data.respone);
                if(data.respone=='sukses'){
                    //alert("sukses");
                    //cetak_gajiTXT2(tgl_batch3);
                    window.open('/admin/Batch/printGAJI');
                    //swal("Success", "Sukses cetak laporan gaji "+tgl_batch3, "success");
                    reload_tglBatch();
                }else{
                    swal("Gagal", "Data Gaji untuk Tanggal Batch "+tgl_batch3+" belum ada ", "error");
                    reload_tglBatch();
                }
            }
        });

    }

    function cetak_tkd2TXT(){
        var tgl_batch = $('#thbltkd2').val();
        $.ajax({
            url : '<?php echo base_url("/admin/batch/cek_tkd") ?>',
            type: "post",
            data: {tgl_batch:tgl_batch},
            dataType: "JSON",
            
            success : function(data){
                // alert(data.respone);
                if(data.respone=='sukses'){
                    //alert("print");
                    window.open('/admin/Batch/printTKD2');
                    //swal("Success", "Sukses cetak laporan gaji "+tgl_batch, "success");
                    reload_tglBatch();
                }else{
                    swal("Gagal", "Data TKD Tahap 2 untuk Tanggal Batch "+tgl_batch+" belum ada ", "error");
                    reload_tglBatch();
                }
            }
        });
    }

    function cetak_transport(){
        var tgl_batch = $('#thbltrans').val();
        $.ajax({
            url : '<?php echo base_url("/admin/batch/cek_transport") ?>',
            type: "post",
            data: {tgl_batch:tgl_batch},
            dataType: "JSON",
            
            success : function(data){
                // alert(data.respone);
                if(data.respone=='sukses'){
                    //alert("print");
                    window.open('/admin/Batch/printTransport');
                    //swal("Success", "Sukses cetak laporan TKD Transport "+tgl_batch, "success");
                    reload_tglBatch();
                }else{
                    swal("Gagal", "Data TKD Transport untuk Tanggal Batch "+tgl_batch+" belum ada ", "error");
                    reload_tglBatch();
                }
            }
        });
    }
</script>

    



