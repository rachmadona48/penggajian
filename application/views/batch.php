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

nnn


<?php
	date_default_timezone_set('Asia/Jakarta');
    $date_now = date('Ym');
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Proses Batching</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
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
                            	<li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-briefcase"></i>Gaji</a></li>
                            	<li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-briefcase"></i>PPH</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-3"><i class="fa fa-briefcase"></i>Penghasilan Lain</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-4"><i class="fa fa-briefcase"></i>PTT</a></li>
                               <!--  <li class=""><a data-toggle="tab" href="#tab-5"><i class="fa fa-briefcase"></i>Krimi TKD</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-6"><i class="fa fa-briefcase"></i>TKD Tahap 2</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-7"><i class="fa fa-briefcase"></i>TKD Transport</a></li> -->
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
                                                        <button class="btn btn-primary btn-facebook btn-outline" onclick="javascript:cetak_gajiTXT(this)">
                                                            <i class="fa fa-print"></i>&nbsp; Download File Gaji
                                                        </button>

    	                                            </div>

    	                                            <!-- <button class="btn btn-primary" type="submit">Save</button> -->
                                                </div>
                                            </form>
                                        </div>

                                        <div class="row" id="VGAJI" style="display:none">
                                            <div class="ibox-title">
                                                <button class="btn btn-primary btn-rounded btn-block btn-outline"  onclick="javascript:exc_gaji()"><i class="fa fa-info-circle"></i> Eksekusi Gaji</button>
                                            </div>

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
		                                    <div class="ibox-title">
					                            <button class="btn btn-primary btn-rounded btn-block btn-outline"  onclick="javascript:exc_pph()"><i class="fa fa-info-circle"></i> Eksekusi PPH</button>
					                        </div>

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
                                    	<div class="center">
	                                    	<!-- <form action="javascript:excute_PengLain();">
	                                    		<input type="hidden" class="form-control" id="tgl_batch3" name="tgl_batch3"> -->
	                                    		<button class="btn btn-primary btn-rounded btn-block btn-outline" onclick="javascript:excute_PengLain();"><i class="fa fa-info-circle"></i> Eksekusi penghasilan lain</button>
	                                    	<!-- </form> -->
                                    	</div>
                                    	<br/><br/>
                                        <table id="tbl2" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <td align="left" width="3%"><b>No</b></td>
                                                    <td align="left" ><b>THBL</b></td>
                                                    <td align="left" ><b>NRK</b></td>
                                                    <td align="left" ><b>Nama</b></td>
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
                                    <div class="ibox-content">
                                        <div class="row">
                                            <!-- <form role="form" class="form-inline" id="pph" action="javascript:savePPH();"> -->
                                            <form role="form" class="form-inline" action="javascript:">
                                                <div class="row">
                                                    <input type="hidden" readonly="" id="idt4" name="idt4" class="form-control">
                                                    <div class="form-group" id="data_7">
                                                        <label class="col-sm-2 control-label">Tanggal Batch<span class="required">*</span></label>&nbsp;&nbsp;
                                                        <div class="input-group col-sm-7 date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="thblptt" name="thblptt" placeholder="Tahun Bulan" value="" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" >
                                                        <button class="btn btn-danger btn-facebook btn-outline" onclick="javascript:showPTT(this)">
                                                            <i class="fa fa-refresh"></i>&nbsp; Tampilkan
                                                        </button>
                                                    </div>
                                                </div>
                                             </form>

                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div id="divptt" style="display: none">
                                                <form id="eksPTT">

                                                    <div class="ibox-title">
                                                        <button class="btn btn-primary btn-rounded btn-block btn-outline" id="but_ptt"><i class="fa fa-info-circle"></i> Eksekusi PTT</button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                        <div class="row" id="VPTT" style="display:none">
                                            <div class="ibox-content">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="tableptt" class="table table-bordered table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <td align="left" width="3%"><b>No</b></td>
                                                                    <td align="left" ><b>NPTT</b></td>
                                                                    <td align="left" ><b>Nama</b></td>
                                                                    <td align="left" ><b>Tgl Lahir</b></td>
                                                                    <td align="left" ><b>Kodel</b></td>
                                                                    <td align="left" ><b>Jabatan</b></td>
                                                                    <td align="left" ><b>Aksi</b></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <div id="spinner_tableptt"></div>
                                                            </tbody>
                                                        </table>                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!--end DIV PTT -->

                                        <div class="row" id="RPTT" style="display:none">
                                            <div class="ibox-content">
                                                <label>Hasil Eksekusi Batching</label>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="tablepttres" class="table table-bordered table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <td align="left" width="3%"><b>No</b></td>
                                                                    <td align="left" ><b>NPTT</b></td>
                                                                    <td align="left" ><b>THBL</b></td>
                                                                    <td align="left" ><b>Nama</b></td>
                                                                    <td align="left" ><b>Lokasi Gaji</b></td>
                                                                    <td align="left" ><b>Keahlian</b></td>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <div id="spinner_tableptt"></div>
                                                            </tbody>
                                                        </table>                                    
                                                    </div>
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

                                                    <input type="hidden" readonly="" id="idt5" name="idt5" class="form-control">

                                                    <div class="form-group pickerpicker" id="data_8">
                                                        <label class="col-sm-2 control-label">Tanggal Batch<span class="required">*</span></label>&nbsp;&nbsp;
                                                        <div class="input-group col-sm-7 date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="thblkrimitkd" name="thblkrimitkd" placeholder="Tahun Bulan" value="" class="form-control" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <button class="btn btn-danger btn-facebook btn-outline" onclick="javascript:showKrimi(this)"><i class="fa fa-refresh"></i>&nbsp; Tampilkan
                                                        </button>
                                                    </div>

                                                </div>
                                            </form>

                                            <div class="ibox-title" id="butekskrimi" style="display: none">
                                                 
                                                <button class="btn btn-primary btn-rounded btn-block btn-outline" id="but_krimi" onclick="javascript:excute_krimiTKD();"><i class="fa fa-info-circle"></i> Eksekusi Krimi TKD</button>
                                            </div>
                                        </div><!--end div row-->

                                        <div class="row" id="VKrimiTKD" style="display:none">
                                            <div class="ibox-content">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="tablekrimitkd" class="table table-bordered table-striped table-hover">
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
                                                    <input type="hidden" readonly="" id="idt6" name="idt6" class="form-control">
                                                    <div class="form-group pickerpicker" id="data_9">
                                                        <label class="col-sm-6 control-label">Tanggal Batch<span class="required">*</span></label>
                                                        <div class="input-group col-sm-7 date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="thbltkd2" name="thbltkd2" placeholder="Tahun Bulan" value="" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button class="btn btn-danger btn-facebook btn-outline" onclick="javascript:showTKD2(this)"><i class="fa fa-refresh"></i>&nbsp; Tampilkan TKD Tahap 2 Pegawai</button>
                                                        
                                                        <button class="btn btn-danger btn-facebook btn-outline" onclick="javascript:showTKDGuru(this)"><i class="fa fa-refresh"></i>&nbsp; Tampilkan TKD Guru
                                                        </button>

                                                        <button class="btn btn-primary btn-facebook btn-outline" onclick="javascript:cetak_tkd2TXT(this)">
                                                            <i class="fa fa-print"></i>&nbsp; Download File TKD Tahap 2
                                                        </button>
                                                    </div>

                                                    <br/><br/>

                                                    <div class="form-group">
                                                        <label class="col-sm-6 control-label">Hari Kerja<span class="required">*</span></label>
                                                        <div class="input-group col-sm-8">
                                                            <input type="text" id="hr_krja" name="hr_krja" placeholder="Jumlah Hari Kerja" value="" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="ibox-title" id="butekstkd2" style="display: none">
                                                        <button class="btn btn-primary btn-rounded btn-block btn-outline" id="but_tkd2" onclick="javascript:excute_TKD2();"><i class="fa fa-info-circle"></i> Eksekusi TKD Tahap 2</button>
                                                    </div>
                                                    <!-- <div class="ibox-title" id="buteksguru" style="display: none">
                                                        <button class="btn btn-primary btn-rounded btn-block btn-outline" id="but_guru"><i class="fa fa-info-circle"></i> Eksekusi TKD Guru</button>
                                                    </div> -->

                                                    
                                                </div>
                                            </form>
                                                    
                                        </div><!--end div row-->

                                        <div class="row" id="VTKD2" style="display:none">
                                            <div class="ibox-content">
                                                <center><h3><label>TKD Tahap 2 Pegawai</label></h3></center>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="tabletkd2" class="table table-bordered table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <td align="left" width="3%"><b>No</b></td>
                                                                    <td align="left" ><b>THBL</b></td>
                                                                    <td align="left" ><b>NRK</b></td>
                                                                    <td align="left" ><b>NAMA</b></td>
                                                                    <td align="left" ><b>LOKASI KERJA</b></td>
                                                                    <td align="left" ><b>LOKASI GAJI</b></td>
                                                                    <!-- <td align="left" ><b>JABATAN</b></td> -->
                                                                    <td align="left" ><b>PANGKAT</b></td>
                                                                    <td align="left" ><b>TKD BERSIH</b></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <div id="spinner_tabletkd2"></div>
                                                            </tbody>
                                                        </table>                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!--end DIV TKD 2 -->

                                        <div class="row" id="VTKDGuru" style="display:none">
                                            <div class="ibox-content">
                                                <center><h3><label>TKD Tahap 2 Guru</label></h3></center>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="tabletkdguru" class="table table-bordered table-striped table-hover">
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
                                                                    <td align="left" ><b>TKD GURU BERSIH</b></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <div id="spinner_tabletkdguru"></div>
                                                            </tbody>
                                                        </table>                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!--end DIV TKD Guru -->
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
			    url:   "<?php echo site_url('index.php/admin/batch/tgl_batch')?>", 
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
                url: "<?php echo site_url('index.php/admin/batch/jml_hari_kerja')?>",
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
                url:   "<?php echo site_url('index.php/admin/batch/tgl_batch')?>", 
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
                url: "<?php echo site_url('index.php/admin/batch/jml_hari_kerja')?>",
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
                    url:  "<?php echo site_url('index.php/admin/batch/openModal')?>", 
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
		            url: '<?php echo site_url("index.php/admin/batch/view_gaji");?>',
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
		            url: '<?php echo site_url("index.php/admin/batch/view_tkd");?>',
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
		            url: '<?php echo site_url("index.php/admin/batch/view_guru");?>',
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

    function showKrimi()
    {
        $('#VKrimiTKD').show();
        tabelKrimiTKD();

        $('#butekskrimi').show();
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
                    url :"<?php echo site_url('index.php/admin/batch/data_gajiLain')?>", // json datasource
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
            url :"<?php echo site_url('index.php/admin/batch/data_plain')?>", // json datasource
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
                    url :"<?php echo site_url('index.php/admin/batch/dataGaji')?>", // json datasource
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
                    url :"<?php echo site_url('index.php/admin/batch/dataPPH')?>", // json datasource
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
                    url :"<?php echo site_url('index.php/admin/batch/dataPTT')?>", // json datasource
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
                    url :"<?php echo site_url('index.php/admin/batch/dataPTTRes')?>", // json datasource
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


    function tabelKrimiTKD(){
        var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 

        var dataTable = $('#tablekrimitkd').DataTable( {
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
                    url :"<?php echo site_url('index.php/admin/batch/dataKrimi')?>", // json datasource
                    type: "post",  // method  , by default get
                    // drawCallback: function( settings ) {
                      
                    // },
                    data : function(d){
                        d.thbl = $('#thblkrimitkd').val();
                    },
                    beforeSend: function(){
                        // $("#tbl1_processing").css("display","none");
                        // $('#spinner2').html("<div class='sk-spinner sk-spinner-three-bounce'><div class='sk-bounce1'></div><div class='sk-bounce2'></div><div class='sk-bounce3'></div></div>");
                    $('#spinner_tablekrimitkd').html(spinner);
                    },complete: function(){
                             $("#spinner_tablekrimitkd").html('');
                    },
                    error: function(){  // error handling
                        $(".tablekrimitkd-error").html("");
                        $("#tablekrimitkd").append('<tbody class="tablekrimitkd-error"><tr><div colspan=6>Tidak Ada Data</div></tr></tbody>');
                        $("#tablekrimitkd_processing").css("display","none");
                        
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
                    url :"<?php echo site_url('index.php/admin/batch/datatkd2')?>", // json datasource
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
                    url :"<?php echo site_url('index.php/admin/batch/datatkdguru')?>", // json datasource
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
                    url :"<?php echo site_url('index.php/admin/Batch/datatkdtransp')?>", // json datasource
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
            url : '<?php echo base_url("index.php/admin/batch/save_pengLain"); ?>',
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
			url : '<?php echo base_url("index.php/admin/batch/savepph"); ?>',
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
			url : '<?php echo base_url("index.php/admin/batch/savepph"); ?>',
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
			url: '<?php echo base_url("index.php/admin/batch/hps_plain"); ?>',
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
			url : '<?php echo base_url("index.php/admin/batch/cek_gaji") ?>',
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
            url: '<?php echo base_url("index.php/admin/batch/exc_gaji") ?>',
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
            // error: function(xhr) {                              
            //     swal("Gagal", "Gagal eksekusi", "error");
            //         $('#modalExcPenglain').modal('hide');
            // }
            // ,
            complete: function(){

                setTimeout(function() {
                    $('#modalExcPenglain').modal('hide');
                    reload_tglBatch();
                	tabelGaji();
                }, 500000);
                
                // swal("Sukses", "Berhasil Eksekusi Gaji", "success");
                
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
            url: '<?php echo base_url("index.php/admin/batch/exc_pph") ?>',
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
            url: '<?php echo base_url("index.php/admin/batch/exc_ptt") ?>',
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
			url: '<?php echo base_url("index.php/admin/batch/exc_pengLain") ?>',
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
            error: function(){  // error handling
                        
               swal("Sukses", "Berhasil Eksekusi ", "success");
                $('#modalExcPenglain').modal('hide'); 
            }
		});
    }


    function excute_krimiTKD(){
    var tgl_batch = $('#thblkrimitkd').val();
    // alert(tgl_batch);
    $.ajax({
        beforeSend : function(){
            swal({
                  title: "Warning",
                  text: "Apakah anda benar ingin melakukan eksekusi Krimi TKD dengan tanggal Batch "+tgl_batch+" ?",
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
                        excute_krimiTKD2(tgl_batch);
                       //swal("Sukses", "Sukses Eksekusi Krimi TKD dengan tanggal Batch "+tgl_batch, "success");
                       //alert("lanjut");
                  } else {
                        swal("Gagal", "Gagal Eksekusi Krimi TKD dengan tanggal Batch "+tgl_batch, "error");
                  }
                });
            }


        });
    }


    function excute_krimiTKD2(tgl_batch){
        $.ajax({
            url: '<?php echo base_url("index.php/admin/batch/exc_krimiTKD") ?>',
            type: "post",
            data: {tgl_batch:tgl_batch},
            dataType: "JSON",
            beforeSend: function(){
                $('#modalExcPenglain').modal('show');
            },
            success: function(data){
                if(data.respone=='gagal'){
                    swal("Gagal", "Data Krimi TKD untuk  THBL "+tgl_batch+" sudah ada ", "error");
                    $('#modalExcPenglain').modal('hide');
                }else{
                    swal("Sukses", "Berhasil Eksekusi Krimi TKD untuk tanggal Batch "+tgl_batch, "success");
                    $('#modalExcPenglain').modal('hide');
                }
                
            },
            complete: function(){
                reload_tglBatch();
                tabelKrimiTKD();
            },
            error: function(){  // error handling
                $('#modalExcPenglain').modal('hide');        
                swal("Gagal", "Error", "error");
                
            }
        });
	}

    function excute_TKD2(){
    var tgl_batch = $('#thbltkd2').val();
    var hr_krja = $('#hr_krja').val();
    
    $.ajax({
        beforeSend : function(){
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
        }
        });
    }

    function excute_TKD2_2(tgl_batch,hr_krja){
        $.ajax({
            url: '<?php echo base_url("index.php/admin/batch/exc_TKD2") ?>',
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
            },
            error: function(){  // error handling
                $('#modalExcPenglain').modal('hide');        
                swal("Gagal", "Error", "error");
                
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
            url: '<?php echo base_url("index.php/admin/batch/exc_Transport") ?>',
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
            },
            error: function(){  // error handling
                $('#modalExcPenglain').modal('hide');        
                swal("Gagal", "Error", "error");
                
            }
        });
    }

    // cetak file TXT
    function cetak_gajiTXT(){
        var tgl_batch3 = $('#tgl_batch3').val();
        $.ajax({
            url : '<?php echo base_url("index.php/admin/batch/cek_gj") ?>',
            type: "post",
            data: {tgl_batch3:tgl_batch3},
            dataType: "JSON",
            
            success : function(data){
                // alert(data.respone);
                if(data.respone=='sukses'){
                    //alert("sukses");
                    //cetak_gajiTXT2(tgl_batch3);
                    window.open('index.php/admin/Batch/printGAJI');
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
            url : '<?php echo base_url("index.php/admin/batch/cek_tkd") ?>',
            type: "post",
            data: {tgl_batch:tgl_batch},
            dataType: "JSON",
            
            success : function(data){
                // alert(data.respone);
                if(data.respone=='sukses'){
                    //alert("print");
                    window.open('index.php/admin/Batch/printTKD2');
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
            url : '<?php echo base_url("index.php/admin/batch/cek_transport") ?>',
            type: "post",
            data: {tgl_batch:tgl_batch},
            dataType: "JSON",
            
            success : function(data){
                // alert(data.respone);
                if(data.respone=='sukses'){
                    //alert("print");
                    window.open('index.php/admin/Batch/printTransport');
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

    



