    <link rel="stylesheet" href="<?php echo base_url()?>assets/sweetalert2/sweetalert2.min.css"> 
    <style type="text/css">
        .navigation {
            width: 0; 
            background-color: black;
            overflow: hidden;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            z-index: 999999;
        }
        .main-wrapper{
            width: 100%;
            float: right;
        }

        /* The Overlay (background) */
        .overlay {
            /* Height & width depends on how you want to reveal the overlay (see JS below) */   
            height: 0;
            width: 100%;
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            right: 0;
            top: 0;
            background-color: rgb(0,0,0); /* Black fallback color */
            background-color: rgba(0,0,0, 0.8); /* Black w/opacity */
            overflow-x: hidden; /* Disable horizontal scroll */
            transition: 0.5s; /* 0.5 second transition effect to slide in or slide down the overlay (height or width, depending on reveal) */
            z-index: 999999;
        }

        /* Position the content inside the overlay */
        .overlay-content {
            position: relative;
            top: 25%; /* 25% from the top */
            width: 100%; /* 100% width */
            text-align: center; /* Centered text/links */
            margin-top: 30px; /* 30px top margin to avoid conflict with the close button on smaller screens */
        }

        /* The navigation links inside the overlay */
        .overlay a {
            padding: 8px;
            text-decoration: none;
            font-size: 36px;
            color: #818181;
            display: block; /* Display block instead of inline */
            transition: 0.3s; /* Transition effects on hover (color) */
        }

        /* When you mouse over the navigation links, change their color */
        .overlay a:hover, .overlay a:focus {
            color: #f1f1f1;
        }

        /* Position the close button (top right corner) */
        .overlay .closebtn {
            position: absolute;
            top: 20px;
            right: 45px;
            font-size: 60px;
        }

        /* When the height of the screen is less than 450 pixels, change the font-size of the links and position the close button again, so they don't overlap */
        @media screen and (max-height: 450px) {
            .overlay a {font-size: 20px}
            .overlay .closebtn {
                font-size: 40px;
                top: 15px;
                right: 35px;
            }
        }

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

        #modalPerbal>.modal-dialog {
            width: 70%;
        }

        .input-group-addon {
            background-color: #1ab394 !important;
            color: #fff !important;
        }

        .sk-spinner-three-bounce.sk-spinner {
            margin: 0 auto;
            text-align: center;
            width: 140px !important;
        }

        #tembusan_list, #pemaraf_serta_wrapper > li{
            margin-bottom: 5px;
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

        .sweet-alert button.cancel{
        background-color: #ec0000;
        }
        .sweet-alert button.cancel:hover{
        background-color: #d81717;
        }

    </style>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/horizontal-timeline/css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/horizontal-timeline/css/style.css"> <!-- Resource style -->

    <!-- The overlay -->
    <div id="myNav" class="overlay">

      <!-- Button to close the overlay navigation -->
      <a class="closebtn"">&times;</a>

      <!-- Overlay content -->
      <div class="overlay-content">
        <a href="#" id="cetak_cover_perbal" class="hidden">Cetak Cover Perbal</a>
        <a href="#" id="cetak_isi_perbal" >Cetak Perbal</a>
        <a href="#" id="cetak_lampiran_sk" class="hidden">Cetak Lampiran Perbal</a>
      </div>

    </div>

    <div class="main-wrapper">

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Permohonan Data</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo site_url().'subbid'?>"><u><font color="blue">Home</font></u></a>
                </li>
                <li class="active">
                    <strong>Permohonan</strong>
                </li>
            </ol>
             <small><i>(Menu untuk melihat data permohonan pegawai)</i></small>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

<div class="wrapper wrapper-content">
    <?php if($user_group == 7){ ?>

    <!-- START WELLCOME -->
        <div class="row">
            <div class="col-md-12">
                <div class="ibox animated fadeInLeft">
                    <div class="ibox-title navy-bg">
                        <h5>Alur Permohonan</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </div>
                    </div>
                    <div class="ibox-content" style="overflow-x: auto;">
                        <div class="row">
                            <div class="col-md-12" id="tracking">
                                <div class="alert alert-info">
                                    Klik tombol Alur Proses di daftar permohonan untuk melihat alur proses permohonan.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="row">    
        <div class="col-md-12">
            <div class="ibox animated fadeInLeft">
                 <div class="ibox-title navy-bg">
                    <h5>Permohonan</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>                        
                    </div>
                </div> 
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" class="form-horizontal">
                                <input type="hidden" id="ref_prm" name="ref_prm" value="1">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Jenis Permohonan</label>
                                    <div class="col-sm-6">
                                        <select class='form-control chosen-jenis' name='jenis_permohonan' id='jenis_permohonan' data-placeholder='Cari Berdasarkan...'>
                                            <option value="" selected></option>
                                            <?php foreach($jenis_permohonan->result() as $row): ?>
                                                <option id="<?php echo $row->ID_JENIS_PERMOHONAN ?>" value="<?php echo $row->ID_JENIS_PERMOHONAN ?>"><?php echo $row->KET_JENIS_PERMOHONAN ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">Jabatan</label>
                                    <div class="col-sm-6">
                                        <select class='form-control chosen-jenis' name='id_kojabf' id='id_kojabf' data-placeholder='Cari Berdasarkan...'>
                                            <option value="" selected></option>
                                            <?php foreach($kojabf->result() as $row): ?>
                                                <option value="<?php echo $row->KOJAB ?>"><?php echo $row->NAJABL ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                            </form>
                        </div>
                    </div>

                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-12">
<!--                            <h4>Permohonan Jabatan Fungsional</h4>-->
                            <table id="t1" class="table table-striped table-bordered table-hover dataTables-example"  width="100%">
                                <thead>
                                <tr>
                                    <!--<th width="3%">No</th>
                                    <th width="12%">Jenis Permohonan</th>
                                    <th width="10%">Jabatan</th>
                                    <th width="9%">No Surat Permohonan</th>
                                    <th width="6%">Tgl. Surat Permohonan</th>
                                    <th width="9%">No Surat</th>
                                    <th width="6%">Tgl. Surat</th>
                                    <th width="3%">Lihat</th>
                                    <th width="9%">Perbal</th>
                                    <th width="6%">Aksi</th>-->
                                    <th >No</th>
                                    <th >Jenis Permohonan</th>
                                    <th >Jabatan</th>
                                    <th >No Surat Permohonan</th>
                                    <th >Tgl. Surat Permohonan</th>
                                    <th >Lihat</th>
                                    <th >Perbal</th>
                                    <th >Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <td id="t1_proses" colspan="10" align="center"></td>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row" id="t2-wrapper">
                        <div class="col-md-12">
                            <h4>Detil Pegawai</h4>
                            <input type="hidden" id="id_trx_hdr" name="id_trx_hdr">
                            <label id="no_surat"></label>
                            <table id="t2" class="table table-striped table-bordered table-hover dataTables-example" width="100%">
                                <thead>
                                <tr>
                                    <th width="3%">No</th>
                                    <th width="10%">NRK</th>
                                    <th width="15%">Nama</th>
                                    <th width="5%">Cek File</th>
                                    <th width="5%">Persetujuan</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <td id="t2_proses" colspan="7" align="center"></td>
                                </tbody>
                            </table>
                            <div id="t2_animate"></div>
                        </div>
                    </div>

                    <div class="row">

                        <!--                                <form class="form-horizontal" id="defaultForm" method="post">-->
                        <!--                                    <!-- <input type="hidden" id="nrk_post" name="nrk_post"> -->
                        <!--                                    <div class="form-group">-->
                        <!--                                        <div class="col-md-12">-->
                        <!--                                            <div class="col-md-3">-->
                        <!--                                                <label for="tgl_surat">Tanggal Surat</label>-->
                        <!--                                            </div>-->
                        <!--                                            <div class="col-md-9 pickerpicker" id="data_2">-->
                        <!--                                                <div class="input-group col-sm-7 date">-->
                        <!--                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgl_surat" name="tgl_surat" placeholder="Tgl. Surat" class="form-control" readonly="readonly">-->
                        <!--                                                </div>-->
                        <!--                                            </div>-->
                        <!--                                        </div>-->
                        <!--                                    </div>-->
                        <!--                                    <div class="form-group">-->
                        <!--                                        <div class="col-md-12">-->
                        <!--                                            <div class="col-md-3">-->
                        <!--                                                <label for="no_surat">No Surat</label>-->
                        <!--                                            </div>-->
                        <!--                                            <div class="col-md-9">-->
                        <!--                                                <input class="form-control" type="text" name="no_surat" id="no_surat" >-->
                        <!--                                            </div>-->
                        <!--                                        </div>-->
                        <!--                                    </div>-->
                        <!--                                    <div class="form-group">-->
                        <!--                                        <div class="col-md-12">-->
                        <!--                                        <button class="btn btn-success btn-block" id="btn_forward">Forward</button>-->
                        <!--                                        </div>-->
                        <!--                                    </div>-->
                        <!--                                </form>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal inmodal fade" id="modalSOP" tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="form-horizontal" id="frm2" name="frm2">
                    <div class="modal-body">
                        <input type="hidden" id="id_trx_hdrp2" name="id_trx_hdrp2" value="">
                        <div class="form-group">
                            <label for="no_perbal" class="col-sm-2 control-label">SOP</label>
                            <div class="col-sm-10">
                                <select class='form-control chosen-jenis' name='id_sop' id='id_sop' data-placeholder='Cari Berdasarkan...'>
                                    <?php foreach($sop->result() as $row): ?>
                                        <option value="<?php echo $row->ID_SOP ?>"><?php echo $row->ID_SOP.' - '.$row->NM_SOP ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>

        <div class="modal inmodal fade" id="modalPerbal" tabindex="-1" role="dialog"  aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form class="form-horizontal" id="frm1" name="frm1">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Form Perbal Naskah Dinas</h4>
                        <div class="hr-line-dashed"></div>

                            <input type="hidden" id="id_trx_hdrp" name="id_trx_hdrp" value="">

                            <div class="row">
	                            <div class="col-lg-6">
	                                <div class="form-group">
	                                    <label for="no_perbal" class="col-sm-4 control-label">Nomor Perbal</label>
	                                    <div class="col-sm-8">
	                                        <input type="text" name="no_perbal" class="form-control pull-right" id="no_perbal" placeholder="" maxlength="50">
	                                    </div>
	                                </div>

	                                <div class="form-group">
	                                	<label for="dikerjakan" class="col-sm-4 control-label">Dikerjakan Oleh</label>
		                                <div class="col-sm-8">
		                                    <input type="text" class="form-control pull-right" id="dikerjakan" name="dikerjakan" >
		                                </div>
	                                </div>

	                                

	                            	<div class="form-group">
	                            		<label for="diedarkan" class="col-sm-4 control-label">Diedarkan Oleh</label>
		                                <div class="col-sm-8">
		                                    <input type="text" class="form-control pull-right" id="diedarkan" name="diedarkan" >
		                                </div>
	                            	</div>
	                            </div>

	                            <div class="col-lg-6">
	                                <div class="form-group">
	                                    <label for="tgl_perbal" class="col-sm-3 control-label">Tanggal Perbal</label>
	                                    <div class="col-sm-9">
	                                        <div id="data_1">
	                                            <div class="input-group date">
	                                                <span class="input-group-addon">
	                                                    <i class="fa fa-calendar"></i>
	                                                </span>
	                                                <input type="text" class="form-control pull-right" id="tgl_perbal" name="tgl_perbal" >
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>

	                                <div class="form-group">
	                                    <label for="perihal" class="col-sm-3 control-label">Diperiksa Oleh</label>
		                                <div class="col-sm-9">
		                                    <input type="text" class="form-control pull-right" id="diperiksa" name="diperiksa" >
		                                </div>
	                            	</div>

	                                <div class="form-group">
	                                    <label for="disetujui" class="col-sm-3 control-label">Disetujui Oleh</label>
		                                <div class="col-sm-9">
		                                    <input type="text" class="form-control" name="disetujui" id="disetujui" placeholder="">
		                                </div>
	                            	</div>

	                            </div>
	                        </div> <!-- end div row -->
	                        
	                        <div class="row">
	                        	<div class="col-lg-6">
									<div class="form-group">
			                            <label for="hal" class="col-sm-4 control-label">Dimajukan pada tanggal </label>
			                            <div class="col-sm-8">
			                                <div id="data_2">
			                                    <div class="input-group date">
			                                            <span class="input-group-addon">
			                                                <i class="fa fa-calendar"></i>
			                                            </span>
			                                        <input type="text" class="form-control pull-right" id="dimajukan" name="dimajukan" >
			                                    </div>
			                                </div>
			                            </div>
			                        </div>
								</div>
	                        </div> <!-- end div row -->
                            
                            <div class="row">
                            	<div class="col-lg-12">
                            		<div class="form-group">
		                                <label for="hal" class="col-sm-2 control-label">Hal / Judul / Naskah Dinas</label>
		                                <div class="col-sm-10">
		                                    <textarea id="hal" name="hal" class="form-control" rows="5"></textarea>
		                                </div>
			                        </div>
                            	</div>
                            </div> <!-- end div row -->
                       	
	                        <div class="row">
	                            <div class="col-lg-6">
	                                <div class="form-group">
	                                    <label for="sifat" class="col-sm-4 control-label">Sifat</label>
	                                    <div class="col-sm-8">
	                                        <input type="text" class="form-control pull-right" id="sifat" name="sifat" >
	                                    </div>
	                                </div>

	                                <div class="form-group">
	                                    <label for="ditetapkan" class="col-sm-4 control-label">Ditetapkan Oleh</label>
	                                    <div class="col-sm-8">
                                            <span style="text-align:center">
                                                <p><span id="nama_ditetapkan"></span><br/>NIP <span id="nip_ditetapkan"></span></p>
                                            </span>
	                                        <!--<input type="text" class="form-control pull-right" id="ditetapkan" name="ditetapkan" >-->
	                                    </div>
	                                </div>
	                                
	                                <div class="form-group" id="group">
	                                    <!-- <div class="col-sm-4" ></div>
	                                    <div class="col-sm-8" >
	                                        <button type="button" class="btn btn-success btn-sm addButton" id="tambah_pemaraf"><i class="fa fa-plus"></i>&nbsp;Tambah Pemaraf</button>
	                                        <button type="button" class="btn btn-danger btn-sm addButton" id="hapus_pemaraf"><i class="fa fa-trash"></i>&nbsp;Hapus Pemaraf</button>
	                                    </div>
	                                	<br/><br/> -->
	                                	    <label for="pemaraf" class="col-sm-4 control-label">Pemaraf serta</label>
		                                    <div class="col-sm-8" >
		                                        <ul id="pemaraf_serta_wrapper">
                                                    <li type="square" id="pemaraf1">
                                                        <select class='form-control' name='pemaraf_serta[]' id='pemaraf_serta' data-placeholder='Cari Berdasarkan...' style="display:inline-block; width: 72%">
                                                            <?php echo $pemaraf_serta ?>
                                                        </select>
                                                        <button type="button" class="btn btn-success btn-sm addButton" style="float:right"><i class="fa fa-plus"></i></button>
                                                    </li>
                                                    <!--<li type="square">Ka. Biro Hukum</li>
                                                    <li type="square">Ka. Biro Umum</li>-->
                                                </ul>
		                                        <!--<input name="pemaraf1" type="text" id="pemaraf1" size="40" class="form-control" >-->
		                                    </div>
		                                
	                                    
	                                    
	                                </div>
	                                
	                            </div>

	                            <div class="col-lg-6">
	                                <div class="form-group">
	                                    <label for="lampiran" class="col-sm-4 control-label">Lampiran</label>
	                                    <div class="col-sm-8">
	                                        <input type="text" class="form-control pull-right" id="lampiran" name="lampiran" >
	                                    </div>
	                                </div>
	                                <div class="form-group">
	                                    <label for="diserahkan" class="col-sm-4 control-label">Diserahkan Kepada</label>
	                                    <div class="col-sm-8">
	                                        <input type="text" class="form-control pull-right" id="diserahkan" name="diserahkan" >
	                                    </div>
	                                </div>
	                            </div>
	                        </div> <!-- end div row -->

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="tembusan" class="col-sm-2 control-label">Tembusan</label>
                                        <div class="col-sm-10">
                                            <ul id="tembusan_list">
                                                <li type="square">Gubernur Provinsi DKI Jakarta</li>
                                                <li type="square">Ka. Kanreg V BKN</li>
                                                <li type="square">Sekda Provinsi DKI Jakarta</li>
                                                <li type="square">Inspektur Provinsi DKI Jakarta</li>
                                                <li type="square">Ka. BPKD Provinsi DKI Jakarta</li>
                                                <li type="square">
                                                    Ka. Dinas &nbsp; 
                                                    <select class='form-control chosen-jenis' style='width: 80px' name='ka_dinas' id='ka_dinas' data-placeholder='Cari Berdasarkan...'>
                                                            <?php echo $klogad ?>
                                                    </select> &nbsp;
                                                    Provinsi DKI Jakarta
                                                </li>
                                                <li type="square">Ka. Biro Umum Setda Provinsi DKI Jakarta</li>
                                                <li type="square">
                                                    Dir &nbsp;
                                                    <select class='form-control chosen-jenis' style='width: 80px' name='dir_dki' id='dir_dki' data-placeholder='Cari Berdasarkan...'>
                                                            <?php echo $klogad ?>
                                                    </select> &nbsp;
                                                    Prov. DKI Jakarta
                                                </li>
                                                <li type="square">
                                                    Ka. Sudin &nbsp;
                                                    <select class='form-control chosen-jenis' style='width: 80px' name='ka_sudin' id='ka_sudin' data-placeholder='Cari Berdasarkan...'>
                                                            <?php echo $klogad ?>
                                                    </select> &nbsp;
                                                    Kota Adm. Jkt
                                                </li>
                                            </ul>
                                            <!--<input type="text" class="form-control pull-right" id="tembusan" name="tembusan" >-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div> <!-- end div modal body -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                    </form>
                </div>
            </div>
        </div>


    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Detail Pegawai</h4>
          </div>
          <div class="modal-body">
            <div class="clearfix">
            <form class="form-horizontal" id="defaultForm" method="post">
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <label for="nrk_pegawai">NRK Pegawai</label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" type="text" name="nrk_pegawai" id="nrk_pegawai" disabled="true">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <label for="nama_pegawai">Nama Pegawai</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" type="text" name="nama_pegawai" id="nama_pegawai" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-12" id="table_persyaratan">
                <table id="tbl-grid2" class="table table-striped table-bordered table-hover">
                     <thead>
                        <tr>
                            <!-- <th width="10px">No</th> -->
                            <th>No</th>
                            <th>Syarat</th>
                            <th>Keterangan</th>
                            <th>Lihat File</th>
                            <!-- <th>Verifikasi</th> -->
                        </tr>
                     </thead>
                     <tbody id="list_syarat">
                          
                     </tbody>
                </table>
            </div>
            </form>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-primary" id="btn-simpan">Simpan</button> -->
          </div>
        </div>

      </div>
    </div>


    
<?php } ?>

</div>
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
        <script src="<?php echo base_url(); ?>assets/sweetalert2/sweetalert2.min.js"></script>

        <!-- Input Mask-->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/jasny/jasny-bootstrap.min.js"></script>
        <!-- Horizontal Timeline-->
        <script src="<?php echo base_url(); ?>assets/horizontal-timeline/js/main.js"></script>

        <!-- Boostrap Validator -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/boostrapvalidator/js/bootstrapValidator.js"></script>
        
        <script language="javascript">
            $(document).ready(function(){
                $('.closebtn').click(function(){
                    $('#myNav').css({'height':'0%'});
                    // $('.navbar-default, nav').css('z-index','1');
                })

                var i=2;
                $('#tambah_pemaraf').click(function(){
                    if(i>12){
                        swal("Warning!", "maksimal pemaraf perbal adalah 12.", "error"); 
                        // alert('maksimal pemaraf perbal adalah 12');
                        return false;
                    }
                    var div = $(document.createElement('div'))
                        .attr("id",'div'+i);
                    div.after()
                    .html('<br/><br/><br/><label for="pemaraf" class="col-sm-4 control-label">Pemaraf serta '+i+'</label><div class="col-sm-8" ><input type="text" size="40" class="form-control" name="pemaraf'+i+'" id="pemaraf'+i+'" /></div>  ');
                    div.appendTo('#group');
                    i++;
                });

                $('#hapus_pemaraf').click(function(){
                    if(i==2){
                        swal("Warning!", "Pemaraf serta minimal 1.", "error"); 
                        // alert('TIdak bisa dikurangi lagi!');
                        return false;
                    }
                    i--;
                    $('#div'+i).remove();
                });
            });

           // function tambahHobi() {
           //   var idf = document.getElementById("idf").value;
           //   var stre;
           //   stre="<p id='srow" + idf + "'><input type='text' size='40' name='rincian_hobi[]' placeholder='Masukkan Hobi' /> 
           //   <a href='#' style=\"color:#3399FD;\" onclick='hapusElemen(\"#srow" + idf + "\"); return false;'>Hapus</a></p>";
           //   $("#divHobi").append(stre);
           //   idf = (idf-1) + 2;
           //   document.getElementById("idf").value = idf;
           // }
           // function hapusElemen(idf) {
           //   $(idf).remove();
           // }
        </script>

        <script type="text/javascript">
        $(document).ready(function(){
            // $('#t2-wrapper').hide();

            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: true,
                calendarWeeks: true,
                autoclose: true,
                format: "dd-mm-yyyy",
                startDate : new Date()
            }).on('changeDate', function(e) {
            // Revalidate the date field
            $('#frm1').bootstrapValidator('revalidateField', 'tgl_perbal');
        });;

            $('#data_2 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: true,
                calendarWeeks: true,
                autoclose: true,
                format: "dd-mm-yyyy",
                startDate : new Date()
            });

            var spinner = '<div class="sk-spinner sk-spinner-wave"><div class="sk-rect1"></div><div class="sk-rect2"></div><div class="sk-rect3"></div><div class="sk-rect4"></div><div class="sk-rect5"></div></div>';
            //var jeniss = $('#jenis').val();
            //var no_surat = $('#no_surat').val();
            //var tgl_surat = $('#tgl_surat').val();
            //var nrk = $('#nrk').val();
            var m = 1;
            var jns_prm = $('#jenis_permohonan').val();
            var id_kojabf = $('#id_kojabf').val();

            var dtbl= $('#t1').DataTable({
                destroy: true,
                responsive: false,
                "bSort": false,
                "dom": 'B<"top"f<"#nmdet1">>rt<"bottom"ip><"clear">',
                "scrollX": true,
                "serverSide": true,
                "ajax": {
                    url: '<?php echo site_url("subbid/get_data_permohonan"); ?>/',
                    type: "post",
                    data: {
                        id_permohonan : m,
                        id_jenis_permohonan : jns_prm,
                        id_kojabf : id_kojabf
                    },
                    beforeSend: function() {
                        $("#t1_proses").html(spinner);
                    },
                    complete: function()
                    {
                        $("#t1_proses").html('');
                    }
                },
                "language": {
                    "processing": "Sedang proses",
                    "lengthMenu": "_MENU_ baris per halaman",
                    "search": "Cari",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Tampil _START_ to _END_ dari _TOTAL_",
                    "infoEmpty": "",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "previous": "Sebelumnya",
                        "next": "Selanjutnya",
                    }
                }

            });
            $('#t1_filter').css("display","none");//hide filtering

            var t2= $('#t2').DataTable({
//                destroy: true,
                responsive: false,
                "bSort": false,
                "dom": 'B<"top"f<"#nmdet1">>rt<"bottom"ip><"clear">',
                "scrollX": false,
                "serverSide": true,
                "ajax": {
                    url: '<?php echo site_url("subbid/getDataTrxDtl"); ?>/false',
                    type: "post",
                    data: function ( d ) {
                        d.id_trx_hdr = $('#id_trx_hdr').val();
                    },
                    beforeSend: function() {
                        $("#t2_proses").html(spinner);
                    },
                    complete: function()
                    {
                        //$("#t2_proses").html('');
                    }
                },
                "language": {
                    "processing": "Sedang proses",
                    "lengthMenu": "_MENU_ baris per halaman",
                    "search": "Cari",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Tampil _START_ to _END_ dari _TOTAL_",
                    "infoEmpty": "",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "previous": "Sebelumnya",
                        "next": "Selanjutnya",
                    }
                }

            });
            $('#t2_filter').css("display","none");//hide filtering

            $('.addButton').on('click', function(){
                if($('#pemaraf_serta_wrapper > li').length == 5)
                    return false;
                var pemaraf_length = $('#pemaraf_serta_wrapper > li').length;
                var intId = parseInt(pemaraf_length) + 1;
                var phpData = "<?php echo $pemaraf_serta ?>";
                var fieldWrapper = $('<li type=\'square\' id=\'pemaraf' + parseInt(intId) + '\'>');
                var select_pemaraf = '<select class=\'form-control chosen-jenis\' style=\'display:inline-block; width: 72%\' name=\'pemaraf_serta[]\' id=\'pemaraf_serta\' data-placeholder=\'Cari Berdasarkan...\'>' + phpData + '</select>';
                var removeButton = $("<button type=\"button\" class=\"btn btn-warning btn-sm addButton\" style=\"float:right\"><i class=\"fa fa-minus\"></i></button>");
                var endFieldWrapper = $('</li>');
                removeButton.click(function() {
                    $(this).parent().remove();
                });
                // var test = $("select[name='pemaraf_serta\\[\\]']").map(function(){return $(this).val()}).get()
                fieldWrapper.append(select_pemaraf);
                fieldWrapper.append(removeButton);
                fieldWrapper.append(endFieldWrapper);
                $(fieldWrapper).insertAfter($('#pemaraf' + pemaraf_length));
            });

            $('#table_persyaratan').hide();
            $('#defaultForm').hide();
            $('#btn_forward').prop('disabled',true);
            // getdatapermohonan();

            $('#jenis_permohonan').change(function(e){
                e.preventDefault();
                getdatapermohonan();
            });

            $('#id_kojabf').change(function(e){
                e.preventDefault();
                getdatapermohonan();
            });

            $("#t1").on('click','#table_nrk, #table_no_tu, #table_tgl_tu',function(e){
            // $('#t1').click(function(e)){
                e.preventDefault();
               // tes();
            });

            $('#btn_simpan').click(function(e){
                e.preventDefault();
            })

            $('#btn_valid').click(function(e){
                e.preventDefault();
                alert('Are you fckin sure mate!?');
                // $('#t1').find('tr').each (function() {
                    // insert_data(id_trx_skpd_post);
                    // console.log($('#id_trx_skpd').text());
                    var id_trx_tu_post = $(this).closest('tr').children('td span #id_trx_tu').text();
                    //console.log(id_trx_tu_post);
                    // insert_data(id_trx_skpd_post);
                // });
            })

            /*$('#btn_forward').click(function(e){
                e.preventDefault();
                $('#t1').find('td:last').after('<td style="display:none" id="test">Test</td>');
                var jns_prm = $('#jenis_permohonan').val();
                var no_surat_tu = $('#no_surat_tu').val();
                // console.log(jns_prm + ' ' + no_surat_tu);
                console.log($('#test').text());
                $('#t1').find('tr').each (function() {
                    insert_data(id_trx_skpd_post);
                    // console.log($('#id_trx_skpd').text());
                    var id_trx_skpd_post = $('#id_trx_skpd').text();
                    // insert_data(id_trx_skpd_post);
                });
            })*/
            $('#tgl_surat').change(function(){
                var no_surat_post = $('#no_surat').val();
                var id_trx_skpd_post = [];
                $('input[name^=id_trx_skpd_post]').each(function(){
                    id_trx_skpd_post.push($(this).val());
                });
                // console.log(id_trx_skpd_post);
                if(!$(this).val() || !no_surat_post/*|| (id_trx_skpd_post.length == 0)*/){
                    $('#btn_forward').prop('disabled',true);
                }else{
                    $('#btn_forward').prop('disabled',false);
                }
            })

            $('#no_surat').on('keyup', function(){
            // $('#no_surat_tu').blur(function(){
                var tgl_surat_post = $('#tgl_surat').val();
                // console.log($('#tgl_surat').val());
                var id_trx_skpd_post = [];
                $('input[name^=id_trx_skpd_post]').each(function(){
                    id_trx_skpd_post.push($(this).val());
                });
                // console.log(id_trx_skpd_post);
                if(!$(this).val() || !tgl_surat_post/*|| (id_trx_skpd_post.length == 0)*/){
                    $('#btn_forward').prop('disabled',true);
                }else{
                    $('#btn_forward').prop('disabled',false);
                }
            })

            $('#btn_forward').click(function(e){
                e.preventDefault();
                var sel = $('input[type=checkbox]:checked').map(function(_, el) {
                    return $(el).val();
                }).get();
                
                 $('#t1').find('td:last').after('<td style="display:none" id="test">Test</td>');
                // var jns_prm = $('#jenis_permohonan').val();
                var no_surat= $('#no_surat').val();
                var tgl_surat = $('#tgl_surat').val();
                if(no_surat!="" && tgl_surat!="")
                {
                    window.open("http://simpegdev.jakarta.go.id/subbid/", "_self");
                    insert_data();
                }
                else
                {
                    alert("No Surat dan Tanggal Surat harus diisi");
                }
                //redir();
            })

            //Validation
            $("#frm1").bootstrapValidator({
                live: 'disabled',
                excluded : 'disabled',
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    /*no_perbal: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    tgl_perbal: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            },
                            date: {
                                format: 'DD-MM-YYYY',
                                message: 'Tanggal tidak valid'
                            }
                        }
                    },*/
                    dikerjakan: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    diperiksa: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    diedarkan: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    disetujui: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    hal: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    /*pemaraf1: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    tembusan: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },
                    ditetapkan: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    },*/
                    diserahkan: {
                        validators: {
                            notEmpty: {
                                message: 'Harus diisi'
                            }
                        }
                    }
                }
            });

            $("#frm1").ajaxForm({
                url: "<?php echo site_url('subbid/simpanPerbal')?>",
                type: "post",
                dataType: "json",
                beforeSerialize: function($form, options) {
                    // console.log($form);
                    //alert(1);
                    // return false;
                },
                success: function (data, status) {
                    if (data.success) {
                        $("#frm1").resetForm();
                        $("#frm1").data('bootstrapValidator').resetForm();

                        $("#modalPerbal").modal('hide');
                        swal("Kerja Bagus!", data.msg, "success");
                        var t1 = $('#t1').DataTable();
                        t1.ajax.reload();
                    } else {
                        sweetAlert("Oops...", data.msg, "error");
                    }
                    $('#t2-wrapper').hide();
                }
            });

            $("#frm2").ajaxForm({
                url: "<?php echo site_url('subbid/simpanSOP')?>",
                type: "post",
                dataType: "json",
                success: function (data, status) {
                    if (data.success) {
                        $("#frm2").resetForm();

                        $("#modalSOP").modal('hide');
                        swal("Kerja Bagus!", data.msg, "success");
                        var t1 = $('#t1').DataTable();
                        t1.ajax.reload();
                    } else {
                        sweetAlert("Oops...", data.msg, "error");
                    }
                }
            });

        });


        function redir()
        {
        	window.location.href="<?php echo site_url().'subbid/permohonan';?>";
        }
        function tes_forward(test){
            console.log(test);
            $('#btn_forward').click(function(e){
                e.preventDefault();
                $('#t1').find('td:last').after('<td style="display:none" id="test">Test</td>');
                var jns_prm = $('#jenis_permohonan').val();
                var no_surat_tu = $('#no_surat_tu').val();

            })
        }

        function valid_yes(id_trx_tu_post){
            $("#t1").on('click','#valid_yes',function(e){
                e.preventDefault();
                $(this).closest("tr").children("td:eq(6)").text("Valid");
                $('#btn_forward').prop('disabled',false);
            });
        }

        function valid_no(id_trx_tu_post){
            $("#t1").on('click','#valid_no',function(e){
                e.preventDefault();
                update();
                $(this).closest("tr").remove();
            });
        }

        function check_box(){
            $('#valid').change(function(){
                if($(this).is(":checked")){
                    alert('This is checked');
                }
            });
        }

        function verifikasi_file(){
            var nrk_post = $('#nrk_post').val();
            console.log(nrk_post);
            // var regtest = new RegExp('error');
            // $.ajax({
            //     url: '<?php echo base_url("index.php/skpdpermohonan/verifikasi")?>/',
            //     type: 'post',
            //     data: {
            //         nrk: nrk_post
            //     },
            //     dataType: 'json',
            //     success: function(data){
            //         // console.log(data);
            //         if(regtest.test(data)){
            //             $('#btn_terima').prop('disabled', true);
            //             $('#btn_tolak').prop('disabled', false);
            //             // console.log('yey');
            //         }else{
            //             $('#btn_terima').prop('disabled', false);
            //             $('#btn_tolak').prop('disabled', true);
            //             // console.log('dang it');
            //         }
            //     }    
            // })
        }

        function insert_data(){
        	var refprm = $('#ref_prm').val();
        	var jnsprm = $('#jenis_permohonan').val();
            var no_surat_post = $('#no_surat').val();
            var tgl_surat_post = $('#tgl_surat').val();
            var id_trx_tu_post = [];
            $('input[name^=id_trx_tu_post]').each(function(){
                id_trx_tu_post.push($(this).val());
            });
            //console.log(id_trx_tu_post);
            $.ajax({
                url: '<?php echo base_url("subbid/insert")?>/',
                type: 'post',
                data: {
                    ref_permohonan: refprm, jns_permohonan:jnsprm,id_trx_tu: id_trx_tu_post, no_surat_tu: no_surat_post, tgl_surat: tgl_surat_post
                },
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    window.open("http://simpegdev.jakarta.go.id/subbid/", "_self");
                    // $('#nrk_post').val(data.nrk);
                    // $('#nama_pegawai').val(data.nama);
                    // var jns_prm = $('#jenis_permohonan').val();
                    // persyaratan(data.nrk, jns_prm, data.id_trx);
                }
            })
        }

        function update()
        {
            var id_trx_tu_post = [];
            $('input[name^=id_trx_tu_post]').each(function(){
                id_trx_tu_post.push($(this).val());
            });
            
            $.ajax({
                url: '<?php echo base_url("subbid/update")?>/',
                type: 'post',
                data: {
                    id_trx_tu: id_trx_tu_post
                },
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    
                }
            })
        }

        function get_detail_pegawai(nrk){
            // console.log('Hello from pegawai');
            $.ajax({
                url: '<?php echo site_url("subbid/get_detail_pegawai")?>/',
                type: 'post',
                data: {
                    nrk: nrk
                },
                dataType: 'json',
                success: function(data){
                    // console.log(data.nama_kecamatan + ' ' + data.nama_wilayah + ' ' + data.nama_kelurahan);
                    //var id_trx = $('#id_trx').val(data.id_trx);
                    $('#nrk_post').val(data.nrk);
                    $('#nama_pegawai').val(data.nama);

                    var ref_prm = $('#ref_prm').val();
                    var jns_prm = $('#jenis_permohonan').val();
                    persyaratan(data.nrk, ref_prm, jns_prm, data.id_trx_tu);
                }
            })
        }

        function persyaratan(id_trx){
            $.ajax({
                url: '<?php echo base_url("subbid/get_persyaratan"); ?>/',
                type: "post",
                data: {
                    id_trx: id_trx
                },
                dataType: 'JSON',
                success: function(data) {
                    // console.log(JSON.stringify(data.dataTable));
                    $("#list_syarat").html(data.dataTable);
                }
            });
        }

        function getdatapermohonan(){
            var spinner = '<div class="sk-spinner sk-spinner-wave"><div class="sk-rect1"></div><div class="sk-rect2"></div><div class="sk-rect3"></div><div class="sk-rect4"></div><div class="sk-rect5"></div></div>';
            //var jeniss = $('#jenis').val();
            //var no_surat = $('#no_surat').val();
            //var tgl_surat = $('#tgl_surat').val();
            //var nrk = $('#nrk').val();
            var m = 1;
            var jns_prm = $('#jenis_permohonan').val();
            var id_kojabf = $('#id_kojabf').val();

            var dtbl= $('#t1').DataTable({
                destroy: true,
                responsive: true,
                "bSort": false,
                "dom": 'B<"top"f<"#nmdet1">>rt<"bottom"ip><"clear">',
                "scrollX": true,
                "serverSide": true,
                "ajax": {
                    url: '<?php echo site_url("subbid/get_data_permohonan"); ?>/',
                    type: "post",
                     data: {
                        id_permohonan : m,
                         id_jenis_permohonan : jns_prm,
                         id_kojabf : id_kojabf
                     },
                    beforeSend: function() {                        
                        $("#t1_proses").html(spinner);
                    },
                    complete: function()
                    {
                         $("#t1_proses").html('');
                    }
                },
                "language": {
                "processing": "Sedang proses",
                    "lengthMenu": "_MENU_ baris per halaman",
                    "search": "Cari",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Tampil _START_ to _END_ dari _TOTAL_",
                    "infoEmpty": "",
                    "paginate": {
                    "first": "Pertama",
                        "last": "Terakhir",
                        "previous": "Sebelumnya",
                        "next": "Selanjutnya",
                }
            }
                    
            });
             $('#t1_filter').css("display","none");//hide filtering
            // if(jenis != null || no_surat != null || tgl_surat != null || nrk != null){
                /*$.ajax({
                    url: '<?php //echo base_url("index.php/skpdpermohonan/get_data_permohonan"); ?>/',
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

        function tes(nrk,no,tgl)
        {
                $('#nrk_pegawai').val(nrk)
                $('#no_tu').val(no);
                
                get_detail_pegawai(nrk);
                // $('#defaultForm').show();
                $('#table_persyaratan').show();
        }

        function cekFile(id_trx_detail,nrk,nama,id_trx)
        {
            $('#nrk_pegawai').val(nrk);
            $('#nama_pegawai').val(nama);
            persyaratan(id_trx);
//            $('#no_tu').val(no);

//            get_detail_pegawai(nrk);
             $('#defaultForm').show();
            $('#table_persyaratan').show();
        }

            /*START CHOSEN*/
            var config = {
                  '#jenis_permohonan, #id_kojabf' : {no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                                }
                for (var selector in config) {
                  $(selector).chosen(config[selector]);
                }
            /*END CHOSEN*/

            $("#ka_dinas, #dir_dki, #ka_sudin").chosen({
                no_results_text: "Oops, Data Tidak Ditemukan!",
                width: "50%"
            });

            /*$('#pemaraf_serta').chosen({
                no_results_text: "Oops, Data Tidak Ditemukan!",
                width: "72%"
            })*/

            $("#ka_dinas_chosen > a.chosen-single").css({
                'background' : 'transparent', 'background-color': 'transparent', 'border': '1px solid #CBD5DD'
            })


            $("#dir_dki_chosen > a.chosen-single").css({
                'background' : 'transparent', 'background-color': 'transparent', 'border': '1px solid #CBD5DD'
            })

            $("#ka_sudin_chosen > a.chosen-single").css({
                'background' : 'transparent', 'background-color': 'transparent', 'border': '1px solid #CBD5D'
            })

            

            
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

        function setT2(id_trx_hdr,no_surat){
            $('#t2-wrapper').hide();
            $("#id_trx_hdr").val(id_trx_hdr);
            if(no_surat == ''){
                $("#no_surat").hide();
            }else{
                $("#no_surat").show();
                $("#no_surat").text(' Nomor Surat: '+no_surat);
            }
            
            $('#t2-wrapper').show();
            var t2 = $('#t2').DataTable();
            t2.ajax.reload();
            $('html, body').animate({
                scrollTop: $("#t2_animate").offset().top
            }, 'slow');
        }

        function tolakHdr(id_trx_hdr,id_tracking){
            swal({
                title: "Anda Yakin!",
                text: "Alasan ditolak:",
                showCancelButton: true,
                confirmButtonColor: "#00e600",
                closeOnConfirm: false,
                animation: "slide-from-top",
                input: "textarea",
                inputPlaceholder: "Penolakan tidak bisa dilanjutkan jika field ini masih kosong"
            }).then(function(result) {
                if (result) {
                    $.post("<?php echo site_url('subbid/tolakHdr')?>",{
                        id_trx_hdr: id_trx_hdr,
                        id_tracking: id_tracking,
                        keterangan: result,
                        id_detil_sop: 3,
                        urutan: 3
                    }, function(rs){
                        if (rs.success){
                            swal("Bagus!", rs.msg, "success");
                            var t1 = $('#t1').DataTable();
                            t1.ajax.reload();
                            var t2 = $('#t2').DataTable();
                            t2.ajax.reload();
                        } else {
                            swal("Oops...", rs.msg, "error");
                        }
                    },"json");
                }

            });
            $(".swal2-confirm").prop('disabled',true);
            $(".swal2-textarea").attr('onKeyUp','showDialog()');
        }

        function showDialog(){
            if($(".swal2-textarea").val().length == 0){
                $(".swal2-confirm").prop('disabled',true);
            } else {
                $(".swal2-confirm").prop('disabled',false);
            }            
        }

        function tolakDtl(id_trx){
            if($('#no_surat').css('display') == 'none'){
                var cek = function(){
                    if($('#t2 td').length == 5){
                        var err = swal("Error!", "Tidak dapat menolak pegawai!", "error")
                        return false;
                    }else{
                        good_to_go()
                    }
                }

                var good_to_go = function(){
                        swal({
                            title: "Anda Yakin!",
                            text: "Alasan ditolak:",
                            showCancelButton: true,
                            confirmButtonColor: "#00e600",
                            closeOnConfirm: false,
                            animation: "slide-from-top",
                            input: "textarea",
                            inputPlaceholder: "Penolakan tidak bisa dilanjutkan jika field ini masih kosong"
                        }).then(function(result) {
                            if (result) {
                                // console.log(result);return false;
                                $.post("<?php echo site_url('subbid/tolakDtl')?>",{
                                    id_trx: id_trx,
                                    keterangan: result,
                                    id_detil_sop: 3,
                                    urutan: 3
                                }, function(rs){
                                    if (rs.success){
                                        swal("Sukses","Bagus!","success"/*, rs.msg, "success"*/);
                                        var t2 = $('#t2').DataTable();
                                        t2.ajax.reload();
                                    } else {
                                        // swal("Oops...", rs.msg, "error");
                                        swal("Gagal","Terjadi kesalahan","error");
                                    }
                                },"json");
                            }

                        });
                        $(".swal2-confirm").prop('disabled',true);
                        $(".swal2-textarea").attr('onKeyUp','showDialog()');
                    }
                
                // console.log(cek());return false;

                cek();
            }else{
            	var err = swal("Error!", "Maaf, perbal sudah di buat. Tidak dapat menolak pegawai!", "error")
                return false;
            }
        }

        function formPerbal(id_trx_hdrp){
            $("#id_trx_hdrp").val(id_trx_hdrp);
            ditetapkanPerbal(id_trx_hdrp)
            $("#modalPerbal").modal('show');
        }

        function editPerbal(ID_TRX_HDR,TGL_SURAT,NO_PERBAL,DIKERJAKAN,DIPERIKSA,DIEDARKAN,DISETUJUI,DIMAJUKAN,HAL,SIFAT,LAMPIRAN,PEMARAF,TEMBUSAN,DITETAPKAN,DISERAHKAN){
            ditetapkanPerbal(ID_TRX_HDR)
            $("#id_trx_hdrp").val(ID_TRX_HDR);
            $("#tgl_perbal").val(TGL_SURAT);
            $("#no_perbal").val(NO_PERBAL);
            $("#dikerjakan").val(DIKERJAKAN);
            $("#diperiksa").val(DIPERIKSA);
            $("#diedarkan").val(DIEDARKAN);
            $("#disetujui").val(DISETUJUI);
            $("#dimajukan").val(DIMAJUKAN);
            $("#hal").val(HAL);
            $("#sifat").val(SIFAT);
            $("#lampiran").val(LAMPIRAN);
            // $("#pemaraf1").val(PEMARAF);
            var pemaraf_serta = PEMARAF.split("|");
            // console.log(pemaraf_serta);
            // $("#tembusan").val(TEMBUSAN);
            var tembusan = TEMBUSAN.split("|");
            $("#ditetapkan").val(DITETAPKAN);
            $("#diserahkan").val(DISERAHKAN);
            $('#ka_dinas').val(tembusan[0]).trigger('chosen:updated');
            $('#dir_dki').val(tembusan[1]).trigger('chosen:updated');
            $('#ka_sudin').val(tembusan[2]).trigger('chosen:updated');
            // $('#pemaraf_serta_wrapper > li').remove();
            $.each(pemaraf_serta, function(index, item){
                // console.log(parseInt(index + 1));
                
                // console.log(index + " " + item)
                button_clicked(pemaraf_serta, index, item);
            })
            $('#pemaraf_serta_wrapper > li:last').remove()
            $("#modalPerbal").modal('show');
        }

        function ditetapkanPerbal(id_trx_hdrp){
            $.post('<?= site_url('subbid/getDitetapkan') ?>/', {id_trx_hdr: id_trx_hdrp}, function(data){
                // console.log(data.NAMA_DITETAPKAN)
                $('#nama_ditetapkan').text(data.NAMA_DITETAPKAN);
                $('#nip_ditetapkan').text(data.NIP_DITETAPKAN);
            }, 'json');
        }

        function button_clicked(pemaraf_serta, index, item){
            if($('#pemaraf_serta_wrapper > li').length == 5 || $('#pemaraf_serta_wrapper > li').length > pemaraf_serta.length)
                    return false;
            var pemaraf_length = $('#pemaraf_serta_wrapper > li').length;
            var intId = parseInt(pemaraf_length) + 1;
            var phpData = "<?php echo $pemaraf_serta ?>";
            var fieldWrapper = $('<li type=\'square\' id=\'pemaraf' + parseInt(intId) + '\'>');
            var select_pemaraf = '<select class=\'form-control chosen-jenis\' style=\'display:inline-block; width: 72%\' name=\'pemaraf_serta[]\' id=\'pemaraf_serta\' data-placeholder=\'Cari Berdasarkan...\'>' + phpData + '</select>';
            var removeButton = $("<button type=\"button\" class=\"btn btn-warning btn-sm addButton\" style=\"float:right\"><i class=\"fa fa-minus\"></i></button>");
            var endFieldWrapper = $('</li>');
            removeButton.click(function() {
                $(this).parent().remove();
            });
            // var test = $("select[name='pemaraf_serta\\[\\]']").map(function(){return $(this).val()}).get()
            fieldWrapper.append(select_pemaraf);
            fieldWrapper.append(removeButton);
            fieldWrapper.append(endFieldWrapper);
            $(fieldWrapper).insertAfter($('#pemaraf' + pemaraf_length));
            $('#pemaraf' + parseInt(++index) + ' > select').val(item);
        }


        function formSOP(id_trx_hdrp2,id_sop){
            $("#id_trx_hdrp2").val(id_trx_hdrp2);
//            alert(id_sop);
            $("#modalSOP").modal('show');
            $("#id_sop").val(id_sop);
            $('#id_sop').trigger('chosen:updated');
        }

        function cetakPerbal(id_trx_hdr, jenperm){
            $.post('<?= site_url('subbid/count_pegawai') ?>', {id_trx_hdr: id_trx_hdr}, function(data){
                if(data != 1){
                    $('#cetak_lampiran_sk').removeClass('hidden');
                }
            })
            // console.log(jenperm);
            $('#myNav').css({'height':'100%'});
            var cetakCoverPerbalURL = '<?= site_url('subbid/cetakPerbal/cover') ?>/' + id_trx_hdr;
            if(jenperm != 0){
                var cetakIsiPerbalURL = '<?= site_url('subbid/cetakPerbal/isi') ?>/' + id_trx_hdr + '/3/' + jenperm;    
            }else{
                var cetakIsiPerbalURL = '<?= site_url('subbid/cetakPerbal/isi') ?>/' + id_trx_hdr + '/3';
            }
            
            var cetakSKURL = '<?= site_url('subbid/cetakSK') ?>/' + id_trx_hdr;
            $('a#cetak_cover_perbal').attr({'href': cetakCoverPerbalURL, 'target': '_blank'});
            $('a#cetak_isi_perbal').attr({'href': cetakIsiPerbalURL, 'target': '_blank'});
            $('a#cetak_lampiran_sk').attr({'href': cetakSKURL, 'target': '_blank'});
            // console.log(jenis_permohonan.replace(/ /g,''));//return false;
            // window.open("<?= site_url('subbid/cetakPerbal/cover') ?>/" + id_trx_hdr);
            // window.open("<?php echo site_url('subbid') ?>/" + jenis_permohonan, '_blank');
            //window.open("<?php echo site_url('subbid/cetakPerbalAngkatInpassing')?>/"+id_trx_hdr,'_blank');
        }

        function kirim(id_trx_hdr,id_tracking){
            $('#t2-wrapper').hide();
            $.post("<?php echo site_url('subbid/kirimPermohonanJabfung')?>",{
                id_trx_hdr: id_trx_hdr,
                id_tracking: id_tracking,
                id_detail_sop: 9,
                urutan: 9
            }, function(rs){
                if (rs.success){
                    swal("Kerja Bagus!", rs.msg, "success");
                    var t1 = $('#t1').DataTable();
                    t1.ajax.reload();
                    // var t2 = $('#t2').DataTable();
                    // t2.clear().draw();
                } else {
                    swal("Oops...", rs.msg, "error");
                }
            },"json");
        }

        function lihatStatus(id_trx_hdr,no_surat){
            $.post("<?php echo site_url($this->modul)?>/trackingPermohonan",{
                id_trx_hdr: id_trx_hdr,
                    no_surat:no_surat
            },
            function(data){
                $("#tracking").html(data);
                $.getScript("<?php echo base_url(); ?>assets/horizontal-timeline/js/main.js");
                $('html, body').animate({
                    scrollTop: $("#tracking").offset().top
                }, 'slow');
            })
        }
        </script>
