   <style type="text/css">
        .fileUpload {
            position: relative;
            overflow: hidden;
        }
        .fileUpload input {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            cursor: pointer;
            opacity: 0;
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
                left: 15px;
                margin-top: 35px;
            }
        }

    </style>    



<div class="wrapper wrapper-content">
    <?php if($user_group == 1){ ?>    
    <!-- START WELLCOME -->
    <div class="row">    
        <div class="col-md-12">
            <div class="ibox animated fadeInLeft">
                
                <div class="ibox-content">
                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-12">

                            <!-- form: -->
                                <input type="hidden" id="new_user">
                                <!-- <form class="form-inline" id="defaultForm" method="post" enctype="multipart/form-data"> -->
                                <form class="form-inline" id="defaultForm" action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="spmu_user" id="spmu_user" value="<?= $spmu_user ?>">
                                <!-- <form class="form-inline" id="formUpload"  method="post" enctype="multipart/form-data">  -->
                                    <div class="data-form-group">

                                        <div class="data-form-group">
                                            <div class="form-group">
                                                <div class="col-md-2">
                                                    <label>Jenis Permohonan</label>    
                                                </div>
                                                <input type="hidden" name="permohonan" id="permohonan" value="<?php echo $ref_permohonan; ?>"></input>
                                                <!-- <div class="col-md-4">
                                                
                                                <select class="form-control chosen-jenis" name="jenis" id="jenis" data-placeholder="Cari Berdasarkan...">
                                                    <option value="1">Fungsional Pengangkatan</option>
                                                    <option value="2">Fungsional Pembebasan</option>
                                                    <option value="3">Fungsional Pengangkatan Kembali</option>            
                                                </select> -->
    
                                                <!-- <input type="hidden" value="<?php //isset($nrk):$nrk?''; ?>"></input> 
                                                </div>-->
                                                <div class="col-md-5">
                                                    <select class='form-control chosen-jenis' name='jenis' id='jenis' data-placeholder='Cari Berdasarkan...'>
                                                        <option>Pilih</option>
                                                            <?php echo $jenis_permohonan ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group" id="ref_permohonan_wrapper">
                                                <div class="col-md-2">
                                                    <label for="jenis">Jabatan Fungsional</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select class='form-control chosen-jenis' name='ref_permohonan' id='ref_permohonan' data-placeholder='Cari Berdasarkan...'>
                                                    <option>Pilih Jabatan Fungsional</option>
                                                    <?php echo $ref_kojabf; ?>
                                                        <?php //echo $ref_kojabf ? $ref_kojabf : '<option value="null@null">Pilih Jabatan Fungsional</option>' ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class='form-group hidden' id='alasan_bbs_smntr_wrapper'>
                                                <div class='col-md-2'>
                                                    <label for='jenis'>Alasan Pembebasan Sementara</label>
                                                </div>
                                                <div class='col-md-5'>
                                                    <select class='form-control chosen-jenis' name='alasan_bbs_smntr' id='alasan_bbs_smntr' data-placeholder='Cari Berdasarkan...'>
                                                        <?= $alasan_bbs_smntr ? strtoupper($alasan_bbs_smntr) : '<option value="null@null">Tidak ada data</option>' ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>

                                        <div class="sk-spinner sk-spinner-double-bounce" style="margin-top: 10%">
                                            <div class="sk-double-bounce1"></div>
                                            <div class="sk-double-bounce2"></div>
                                        </div>

                                        <div class="tabs-container hidden">
                                            <div class="alert alert-info alert-dismissible" role="alert">
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              <strong>Informasi!</strong> <hr/>
                                              <ul>
                                                  <li>Ukuran file maksimal 3MB</li>
                                                  <li>
                                                    Format file yang di perbolehkan
                                                    <ol>
                                                        <li>.pdf</li>
                                                        <li>.jpg</li>
                                                        <li>.jpeg</li>
                                                        <li>.png</li>
                                                    </ol>
                                                  </li>
                                              </ul>
                                            </div>
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a data-toggle="tab" href="#tab-1">Persyaratan</a></li>
                                                <li class=""><a data-toggle="tab" href="#tab-2">Mekanisme Pelayanan</a></li>
                                                <li class=""><a data-toggle="tab" href="#tab-3">Dasar Hukum</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="tab-1" class="tab-pane active">
                                                    <div class="panel-body">
                                                        <table class="table table-striped table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Uraian</th>
                                                                <th>Upload Berkas</th>
                                                              
                                                            </tr>
                                                            </thead>

                                                            <tbody id="tab_persyaratan">
                                                                
                                                            </tbody>
                                                        </table> 

<!--
                                                        <br/>
-->
                                                        <div class="hr-line-dashed"></div>
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <!--<div class="pull-right">--><!--
                                                <a onclick="return kirim_file('defaultForm');" class="btn btn-primary" id="btnCari"><i class="fa fa-search"> Kirim</i></a> -->
                                                                    <button type="submit" class="btn btn-block btn-primary" id="btn_kirim">Kirim</button>
                                                                <!--</div>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="tab-2" class="tab-pane">
                                                    <div class="panel-body">
                                                        <span id="mekanisme_tab">
                                                            <ol style="margin-top:0pt;margin-bottom:0pt;" id="docs-internal-guid-6442a7a1-d710-91bb-1798-a42ba9f34d1b">
  <li dir="ltr" style="list-style-type:lower-alpha;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: -24px;">
    <p dir="ltr" style="line-height:1.7999999999999998;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Dasar Hukum</span></p>
  </li>
</ol>
<br>
<ol style="margin-top:0pt;margin-bottom:0pt;">
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
    <p dir="ltr" style="line-height:1.7999999999999998;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Undang-undang Republik Indonesia Nomor 5 Tahun 2014 tentang Aparatur Sipil Negara;</span></p>
  </li>
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
    <p dir="ltr" style="line-height:1.7999999999999998;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Peraturan Pemerintah Nomor 16 Tahun 1994 tentang Jabatan Fungsional Pegawai Negeri Sipil sebagaimana diubah dengan Peraturan Pemerintah Nomor 40 Tahun 2010;</span></p>
  </li>
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
    <p dir="ltr" style="line-height:1.7999999999999998;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Keputusan Presiden Republik Indonesia Nomor 87 Tahun 1999 tentang Rumpun Jabatan Fungsional;</span></p>
  </li>
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
    <p dir="ltr" style="line-height:1.7999999999999998;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Peraturan Presiden terkait tunjangan jabatan fungsional;</span></p>
  </li>
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
    <p dir="ltr" style="line-height:1.7999999999999998;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Peraturan Menteri Negara Pendayagunaan Aparatur Negara yang mengatur Jabatan Fungsional tertentu dan angka kreditnya;</span></p>
  </li>
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
    <p dir="ltr" style="line-height:1.7999999999999998;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Peraturan Bersama Kepala BKN dan Instansi Pembina dari masing-masing jabatan fungsional;</span></p>
  </li>
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
    <p dir="ltr" style="line-height:1.7999999999999998;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Keputusan Gubernur Nomor 85 Tahun 2002 tentang Petunjuk Pelaksanaan Penyusunan, Pengusulan dan Penerapan Fungsional di Lingkungan Pemerintah Provinsi DKI Jakarta;</span></p>
  </li>
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
    <p dir="ltr" style="line-height:1.7999999999999998;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Peraturan Gubernur Nomor 163 Tahun 2010 tentang Pendelegasian Wewenang Pengangkatan, Pemberhentian Pegawai Negeri Sipil;</span></p>
  </li>
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
    <p dir="ltr" style="line-height:1.7999999999999998;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Peraturan Gubernur Nomor 117 Tahun 2016 tentang Perubahan atas Peraturan Gubernur Nomor 222 Tahun 2014 tentang Organisasi dan Tata Kerja Badan Kepegawaian Daerah Provinsi DKI Jakarta</span></p>
  </li>
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
    <p dir="ltr" style="line-height:1.7999999999999998;margin-top:0pt;margin-bottom:10pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Keputusan Gubernur yang mengatur jumlah formasi masing-masing jabatan fungsional tertentu.</span></p>
  </li>
</ol>
<br>
<br>
<ol style="margin-top:0pt;margin-bottom:0pt;" start="2">
  <li dir="ltr" style="list-style-type:lower-alpha;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: -24px;">
    <p dir="ltr" style="line-height:1.7999999999999998;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Definisi Operasional </span></p>
  </li>
</ol>
<ol style="margin-top:0pt;margin-bottom:0pt;">
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Jabatan Fungsional adalah Kedudukan yang menunjukan tugas, tanggung jawab, wewenang, dan hak seseorang Pegawai Negeri Sipil dalam suatu satuan organisasi yang dalam pelaksanaan tugasnya didasarkan pada keahlian dan/atau keterampilam tertentu serta bersifat mandiri.</span></p>
  </li>
</ol>
<br>
<ol style="margin-top:0pt;margin-bottom:0pt;" start="2">
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Rumpun Jabatan Fungsional adalah himpunan jabatan fungsional yang mempunyai fungsi dan tugas yang berkaitan erat satu sama lain dalam melaksanakan salah satu tugas umum pemerintahan.</span></p>
  </li>
</ol>
<br>
<ol style="margin-top:0pt;margin-bottom:0pt;" start="3">
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Angka kredit adalah satuan nilai dari tiap butir kegiatan dan/atau akumulasi nilai butir-butir kegiatan yang harus dicapai oleh pejabat fungsional dalam rangka pembinaan karier yang bersangkutan.</span></p>
  </li>
</ol>
<br>
<ol style="margin-top:0pt;margin-bottom:0pt;" start="4">
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Instansi pembina jabatan fungsional adalah instansi pemerintah yang bertugas membina suatu jabatan fungsional menurut peraturan perundang-undangan yang berlaku.</span></p>
  </li>
</ol>
<br>
<ol style="margin-top:0pt;margin-bottom:0pt;" start="5">
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:17.333333333333332px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Pengangkatan </span><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Pegawai Negeri Sipil ke dalam jabatan fungsional pada instansi pemerintah ditetapkan oleh pejabat yang berwenang sesuai formasi yang telah ditetapkan.</span></p>
  </li>
</ol>
<br>
<br>
<ol style="margin-top:0pt;margin-bottom:0pt;" start="3">
  <li dir="ltr" style="list-style-type:lower-alpha;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: -24px;">
    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Pengangkatan dalam Jabatan Fungsional </span></p>
  </li>
</ol>
<br>
<p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;margin-left: 21.3pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Pengangkatan Pegawai Negeri Sipil dalam &nbsp;terdapat 3 (tiga) cara, yaitu : </span></p>
<br>
<ol style="margin-top:0pt;margin-bottom:0pt;">
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Penyesuaian/Inpassing</span></p>
  </li>
</ol>
<p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;margin-left: 39.3pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Pengangkatan Pegawai Negeri Sipil dalam jabatan fungsional &nbsp;yang dilakukan pada saat jabatan fungsional baru ditetapkan.</span></p>
<br>
<ol style="margin-top:0pt;margin-bottom:0pt;" start="2">
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Pengangkatan Pertama Kali </span></p>
  </li>
</ol>
<p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;margin-left: 39.3pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Pengangkatan Pegawai Negeri Sipil dalam jabatan fungsional untuk mengisi lowongan formasi melalui Calon Pegawai Negeri Sipil (CPNS)</span></p>
<br>
<ol style="margin-top:0pt;margin-bottom:0pt;" start="3">
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
    <p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Pengangkatan dari Jabatan Lain </span></p>
  </li>
</ol>
<p dir="ltr" style="line-height:1.2;margin-top:0pt;margin-bottom:0pt;margin-left: 39.3pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Pengangkatan Pegawai &nbsp;Negeri Sipil yang dilakukan melalui perpindahan dari jabatan struktural, jabatan fungsional umum atau jabatan fungsional lain ke dalam jabatan fungsional tertentu</span></p>
<br>
<ol style="margin-top:0pt;margin-bottom:0pt;" start="4">
  <li dir="ltr" style="list-style-type:lower-alpha;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: -24px;">
    <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Pembebasan Sementara, Pengangkatan Kembali dan Pemberhentian Jabatan Fungsional </span></p>
  </li>
</ol>
<br>
<ol style="margin-top:0pt;margin-bottom:0pt;">
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">
    <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Pembebasan Sementara merupakan suatu kondisi apabila seorang Pegawai Negeri Sipil yang sedang menduduki jabatan fungsional :</span></p>
  </li>
</ol>
<ul style="margin-top:0pt;margin-bottom:0pt;">
  <li dir="ltr" style="list-style-type:disc;font-size:16px;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 23px;">
    <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Apabila telah 5 (lima) tahun dalam jabatan/pangkat terakhir tidak dapat memenuhi angka kredit yang ditentukan</span></p>
  </li>
  <li dir="ltr" style="list-style-type:disc;font-size:16px;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 23px;">
    <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Diberhentikan sementara sebagai PNS</span></p>
  </li>
  <li dir="ltr" style="list-style-type:disc;font-size:16px;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 23px;">
    <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Dijatuhi hukuman disiplin tingkat sedang atau berat berupa penurunan pangkat</span></p>
  </li>
  <li dir="ltr" style="list-style-type:disc;font-size:16px;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 23px;">
    <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Ditugaskan secara penuh diluar jabatan fungsionalnya</span></p>
  </li>
  <li dir="ltr" style="list-style-type:disc;font-size:16px;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 23px;">
    <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Menjalani cuti di luar tanggungan negara</span></p>
  </li>
  <li dir="ltr" style="list-style-type:disc;font-size:16px;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 23px;">
    <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Menjalani tugas belajar lebih dari 6 (enam) bulan</span>
      <span
      style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">
        <br class="kix-line-break">
        <br class="kix-line-break">
        </span>
    </p>
  </li>
</ul>
<ol style="margin-top:0pt;margin-bottom:0pt;" start="2">
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">
    <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Pengangkatan Kembali </span></p>
  </li>
</ol>
<ul style="margin-top:0pt;margin-bottom:0pt;">
  <li dir="ltr" style="list-style-type:disc;font-size:16px;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 23px;">
    <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Pegawai Negeri Sipil yang telah selesai melaksanakan pembebasan sementara dapat diangkat kembali dalam jabatan fungsionalnya &nbsp;sepanjang memenuhi ketentuan yang ada.</span></p>
  </li>
  <li dir="ltr" style="list-style-type:disc;font-size:16px;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 23px;">
    <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Pengangkatan Kembali dalam jabatan fungsional bagi Pegawai Negeri Sipil yang telah selesai menjalani pembebasan sementara &nbsp;karena ditugaskan secara penuh di luar jabatannya, dapat diangkat kembali dalam jabatannya, namun tetap memperhatikan batas usia pengangkatan kembali yang diatur dalam ketentuan Permenpan masing-masing jabatan fungsionalnya.</span></p>
  </li>
</ul>
<br>
<ol style="margin-top:0pt;margin-bottom:0pt;" start="3">
  <li dir="ltr" style="list-style-type:decimal;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">
    <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Pemberhentian </span></p>
  </li>
</ol>
<p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;margin-left: 36pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Pegawai Negeri Sipil &nbsp;yang menduduki jabatan fungsional diberhentikan dari jabatannya apabila : </span></p>
<ul
style="margin-top:0pt;margin-bottom:0pt;">
  <li dir="ltr" style="list-style-type:disc;font-size:16px;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 23px;">
    <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Dalam jangka waktu 1 (satu) tahun sejak dibebaskan sementara dari jabatannya tetap tidak dapat mengumpulkan angka kredit yang ditentukan.</span></p>
  </li>
  <li dir="ltr" style="list-style-type:disc;font-size:16px;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 23px;">
    <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Dijatuhi hukuman disiplin tingkat berat dan telah mempunyai kekuatan hukum tetap, kecuali hukuman disiplin penurunan pangkat dan penuruanan jabatan </span></p>
  </li>
  </ul>
  <br>
  <ol style="margin-top:0pt;margin-bottom:0pt;" start="5">
    <li dir="ltr" style="list-style-type:lower-alpha;font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: -24px;">
      <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Kenaikan jenjang jabatan fungsional </span></p>
    </li>
  </ol>
  <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;margin-left: 21.3pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Pengangkatan Pegawai Negeri Sipil ke dalam Jabatan Fungsional setingkat lebih tinggi dapat dilakukan dengan kriteria</span>
    <span
    style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;"> : </span>
  </p>
  <br>
  <ul style="margin-top:0pt;margin-bottom:0pt;">
    <li dir="ltr" style="list-style-type:disc;font-size:16px;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
      <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Telah memenuhi angkat kredit yang ditentukan</span></p>
    </li>
    <li dir="ltr" style="list-style-type:disc;font-size:16px;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
      <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Telah mengikuti dan lulus diklat penjenjangan dalam jabatan fungsionalnya</span></p>
    </li>
    <li dir="ltr" style="list-style-type:disc;font-size:16px;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
      <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Telah memiliki masa kerja 1 (satu) tahun dalam jenjang jabatan fungsional terakhir</span></p>
    </li>
    <li dir="ltr" style="list-style-type:disc;font-size:16px;font-family:Arial;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;margin-left: 4px;">
      <p dir="ltr" style="line-height:1.3800000000000001;margin-top:0pt;margin-bottom:0pt;text-align: justify;"><span style="font-size:16px;font-family:Domine;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;">Tersedia formasi</span></p>
    </li>
  </ul>
  <br>

                                                        </span>
                                                    </div>
                                                </div>
                                                <div id="tab-3" class="tab-pane">
                                                    <div class="panel-body">
                                                        <span id="dasar_hukum_tab"></span>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </form>
                                
                            
                       
                            <!-- :form -->
                            
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
        var fullStat = {
            tabDataStats: 0,
            tabPersyaratanStats: 0,
            tabMekanismeStats: 0,
            tabDHStats: 0
        }

        console.log($('#spmu_user').val())

        check_permohonan();
        function check_permohonan(){
            $.ajax({
                url: '<?php echo base_url("index.php/permohonan/check_permohonan") ?>',
                type: 'post',
                data: {
                    
                },
                dataType: 'json',
                success: function(data){
                    //~console.log(data);
                    if(data == 'Error'){
                        swal({   
                            title: "Maaf!",   
                            text: "Permohonan anda sebelumnya sedang di proses!",   
                            type: "error",   
                            showCancelButton: false,   
                            confirmButtonColor: "#DD6B55",   
                            confirmButtonText: "Ok!",   
                            cancelButtonText: "Whatever!",   
                            closeOnConfirm: false,   
                            closeOnCancel: false }, function(isConfirm){   
                                if (isConfirm) {     
                                    location.replace('<?php echo base_url("index.php/profile/") ?>');
                                    //~swal("Deleted!", "Your imaginary file has been deleted.", "success");   
                                } 
                            });
                        $('#main-wrapper').html("");
                    }
                }
            });
        }

        /*var jenis_permohonan_for_user = function(){
            var jenis = $('#jenis').val();
            $.post('<?= site_url('permohonan/check_user') ?>', {jenis: jenis, nrk: <?= $this->session->userdata('logged_in')['nrk'] ?>}, function(data){
                console.log(data);
                if(data){
                    $('#new_user').val(data)
                    $('#jenis > option:selected').each(function() {
                        if ($(this).val() != 4 || $(this).val() != 1){ 
                            swal("Maaf!","Anda belum memiliki riwayat jabatan fungsional.","error");
                            $(this).prop('disabled', true).trigger('chosen:updated');
                        }
                    })
                    // $('#jenis > options:contains')
                }
            })
        }*/

        // jenis_permohonan_for_user();

        $(document).ready(function(){
            load_data_tab();
            load_tab_persyaratan();
            crucial_function();
            //~load_mekanisme();
            //~load_dasar_hukum();
            //~check_file();
            //~$("#batal_batal_CPNS_1, #batal_batal_CPNS_2, #batal_batal_CPNS_3, #batal_batal_PNS_1, #batal_batal_PNS_2, #batal_batal_PNS_3, #batal_batal_PAK_1, #batal_batal_PAK_2, #batal_batal_PAK_3, #batal_batal_IJZ_1, #batal_batal_IJZ_2, #batal_batal_IJZ_3,  #batal_batal_PGKT_1, #batal_batal_PGKT_2, #batal_batal_PGKT_3, #batal_batal_DP3_1, #batal_batal_DP3_2, #batal_batal_DP3_3, #batal_batal_SDIK_1, #batal_batal_SDIK_2, #batal_batal_SDIK_3, #batal_batal_SREK_1, #batal_batal_SREK_2, #batal_batal_SREK_3, #batal_batal_ADJ_1, #batal_batal_ADJ_2, #batal_batal_ADJ_3, #batal_batal_BSJ_1, #batal_batal_BSJ_2, #batal_batal_BSJ_3 #batal_batal_PAK_1, #batal_batal_PAK_2, #batal_batal_PAK_3, #batal_batal_PGKT_1, #batal_batal_PGKT_2, #batal_batal_PGKT_3,  #batal_batal_BUKTI_1, #batal_batal_BUKTI_2, #batal_batal_BUKTI_3").hide();
            //~$(".btn-group").hide();
            //~$(".CPNS_1, .CPNS_2, .CPNS_3, .PNS_1, .PNS_2, .PNS_3, .PAK_1, .PAK_2, .PAK_3, .IJZ_1, .IJZ_2, .IJZ_3,  .PGKT_1, .PGKT_2, .PGKT_3, .DP3_1, .DP3_2, .DP3_3, .SDIK_1, .SDIK_2, .SDIK_3, .SREK_1, .SREK_2, .SREK_3, .ADJ_1, .ADJ_2, .ADJ_3, .BSJ_1, .BSJ_2, .BSJ_3 .PAK_1, .PAK_2, .PAK_3, .PGKT_1, .PGKT_2, .PGKT_3,  .BUKTI_1, .BUKTI_2, .BUKTI_3").hide();
            //~$(".CPNS, .PNS, .PAK, .IJZ, .PGKT, .DP3, .SDIK, .SREK, .ADJ, .BSJ, .PAK, .PGKT, .BUKTI").hide();
            var check_sop = function(){
                var jns = $('#jenis').val();
                <?php $check_user = $this->db->query("SELECT kd FROM PERS_PEGAWAI1 WHERE NRK = '{$_SESSION['logged_in']['nrk']}'")->row(); ?>;
                var cek_user = '<?= $check_user->KD ?>';
                //console.log(cek_user)
                if(cek_user == 'F'){
                    if(jns == 4 || jns == 1 || jns == 3){
                        console.log(jns);
                    }
                }
                // if(jns == 4 || jns == 1 || jns == 3){

                // }
            }
            check_sop();

            $('#jenis, #ref_permohonan').on('change', function(){
                var value = "<?= $_SESSION['logged_in']['kojab']."@".$_SESSION['logged_in']['id_sop']."@".$_SESSION['logged_in']['kopang']; ?>";
                var text = "<?= $_SESSION['logged_in']['najabl']; ?>";
                if($('#jenis').val() == 2 || $('#jenis').val() == 7){
                    $('#ref_permohonan').append('<option value="'+ value +'">'+ text +'</option>');
                    $('#ref_permohonan').prop('disabled',true);
                    $('#ref_permohonan').val(value).trigger('chosen:updated');
                    if($('#jenis').val() == 2){
                        $('#alasan_bbs_smntr_wrapper').removeClass('hidden');
                    }else{
                        $('#alasan_bbs_smntr_wrapper').addClass('hidden');
                    }
                }
                else if($('#jenis').val() == 1){
                    $('#ref_permohonan option[value="'+ value +'"]').remove();
                    $('#ref_permohonan').prop('disabled',false);
                    // $('#ref_permohonan').append('<option value="'+ value +'">'+ text +'</option>');
                    getJabfungpertama();
                    $('#alasan_bbs_smntr_wrapper').addClass('hidden');
                }
                 
                else if($('#jenis').val() == 4){
                    $('#ref_permohonan option[value="'+ value +'"]').remove();
                    $('#ref_permohonan').prop('disabled',false);
                    // $('#ref_permohonan').append('<option value="'+ value +'">'+ text +'</option>');
                    getJabfung();
                    $('#alasan_bbs_smntr_wrapper').addClass('hidden');
                }
                else if($('#jenis').val() == 6){
                    $('#ref_permohonan option[value="'+ value +'"]').remove();
                    $('#ref_permohonan').prop('disabled',false);
                    // $('#ref_permohonan').append('<option value="'+ value +'">'+ text +'</option>');
                    getJabfunginpassing();
                    $('#alasan_bbs_smntr_wrapper').addClass('hidden');
                }
                load_data_tab();
                load_tab_persyaratan();
                // window.setTimeout(crucial_function, 850);
                /*if($('#jenis').val() != 2){
                    $('#ref_permohonan option[value="'+ value +'"]').remove();
                    $('#ref_permohonan').prop('disabled',false);
                    $("#ref_permohonan").val($("#ref_permohonan option:first").val()).trigger('chosen:updated');
                }*/
                //~if(jenis_val == 1){
                    //~$('#pengangkatan').show();
                    //~$('#pengangkatan_kembali').hide();
                    //~$('#pengangkatan_sementara').hide();
                //~}else if(jenis_val == 2){
                    //~$('#pengangkatan').hide();
                    //~$('#pengangkatan_kembali').show();
                    //~$('#pembebasan_sementara').hide();
                //~}else if(jenis_val == 3){
                    //~$('#pengangkatan').hide();
                    //~$('#pengangkatan_kembali').hide();
                    //~$('#pembebasan_sementara').show();
                //~}else{
                    //~$('#pengangkatan').hide();
                    //~$('#pengangkatan_kembali').hide();
                    //~$('#pembebasan_sementara').hide();
                //~}
            })

            function crucial_function(){
                // load_data_tab();
                // load_tab_persyaratan();
                $('.sk-spinner-double-bounce').addClass('hidden');
                $('.tabs-container').removeClass('hidden');
                // hide_loading_animation();
                // window.setTimeout(hide_loading_animation, 1500)
            }

            function hide_loading_animation(){
                if(fullStat.tabDataStats && fullStat.tabPersyaratanStats){
                    $('.sk-spinner-double-bounce').addClass('hidden');
                    $('.tabs-container').removeClass('hidden');
                }
                console.log(fullStat);
            }

            function getJabfung(){
                $.ajax({
                    url: "<?= site_url('permohonan/get_jabfung_dropdown/true') ?>",
                    type: "POST",
                    success: function(data){
                        // console.log(data)
                        $('#ref_permohonan').append(data);
                        $('#ref_permohonan').trigger('chosen:updated');
                    }
                })
            }

            function getJabfunginpassing()
            {
                $.ajax({
                    url: "<?= site_url('permohonan/get_jabfung_inpassing/true') ?>",
                    type: "POST",
                    success: function(data){
                        // console.log(data)
                        $('#ref_permohonan').append(data);
                        $('#ref_permohonan').trigger('chosen:updated');
                    }
                })
            }

            function getJabfungpertama()
            {
                $.ajax({
                    url: "<?= site_url('permohonan/get_jabfungpertama/true') ?>",
                    type: "POST",
                    success: function(data){
                        // console.log(data)
                        $('#ref_permohonan').append(data);
                        $('#ref_permohonan').trigger('chosen:updated');
                    }
                })
            }

            function cek_sop(){
                var valueJabfung = $("#ref_permohonan").val().split('@');
                if(valueJabfung[1] != 1 || !valueJabfung[1]){
                    return 'false';
                }
            }

            function swal_error(tar){
                if(tar){
                    swal({
                          title: "Maaf",
                          text: "Tidak dapat melanjutkan permohonan!",
                          type: "error",
                          showCancelButton: false,
                          confirmButtonColor: "#DD6B55",
                          confirmButtonText: "OK",
                          cancelButtonText: "No, cancel plx!",
                          closeOnConfirm: true,
                          closeOnCancel: false
                        },
                        function(isConfirm){
                          if (isConfirm) {
                            return false;
                          }
                        });
                }
            }
            
            //~$("#batal_batal_CPNS, #batal_batal_PNS, #batal_batal_PAK, #batal_batal_IJZ, #batal_batal_PGKT, #batal_batal_DP3, #batal_batal_SDIK, #batal_batal_SREK, #batal_batal_ADJ, #batal_batal_BSJ, #batal_batal_PAK, #batal_batal_PGKT").click(function(e){
                //~e.preventDefault();
                //~$("#status_status_CPNS, #status_status_PNS, #status_status_PAK, #status_status_IJZ, #status_status_PGKT, #status_status_DP3, #status_status_SDIK, #status_status_SREK, #status_status_ADJ, #status_status_BSJ, #status_status_PAK, #status_status_PGKT").show();
                //~$(".upCPNS, .upPNS, .upPAK, .upIJZ, .upPGKT, .upDP3, .upSDIK, .upSREK, .upADJ, .upBSJ, .upPAK, .upPGKT").hide();
                //~$(this).hide();
            //~})
        $('form').on('submit', function(e){
            e.preventDefault();
        })
            
        $('#btn_kirim').on('click', function(e){
            e.preventDefault();
            var res_sop = cek_sop();
            $('#btn_kirim').prop('disabled',true);
            if(res_sop == 'false'){
                swal_error(true);
                return false;
            }else{
                var value = "<?= $_SESSION['logged_in']['kojab']."@".$_SESSION['logged_in']['id_sop']; ?>";
            /*if($('#ref_permohonan').val() != value){*/
                var valid = /false/gi
                var id_jenis_permohonan = $("#jenis").val();
                var id_permohonan = $("#permohonan").val();
                var value_tmp = $("#ref_permohonan").val().split('@');
                var id_kojabf = value_tmp[0];
                var url = "<?php echo base_url("index.php/permohonan/verify_from_server") ?>" + "/" + id_jenis_permohonan + "/" + id_permohonan + "/" + id_kojabf;
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        
                    },
                    dataType: 'json',
                    success: function(data){
                        //~console.log(valid.test(data))
                        if(!valid.test(data)){
                            insert_to_db();
                            // swal("Terima Kasih!","Data berhasil di simpan.","success");
                            // window.setTimeout(redirect, 1320);
                   //          function redirect(){
                   //              location.replace('<?php echo base_url("index.php/home/") ?>');    
                   //          }
                            //~alert('Berhasil');
                        }else{
                            swal({
                              title: "Gagal",
                              text: "Lengkapi semua file persyaratan",
                              type: "error",
                              showCancelButton: false,
                              confirmButtonColor: "#DD6B55",
                              confirmButtonText: "OK",
                              closeOnConfirm: true
                            },
                            function(isConfirm){
                                if(isConfirm){
                                    window.location.reload();
                                    // $('#btn_kirim').prop('disabled', false)    
                                }
                            });
                            // swal("Gagal!","Lengkapi semua file persyaratan.","error");
                            return false;
                            //~alert('Lengkapi semua file persyaratan');
                        }
                        //~console.log(data)
                        //~insert_to_db()
                        //~if(!data){
                            //~return false;
                        //~}else{
                            //~insert_to_db()
                            //~console.log(data)
                        //~}
                    },
                    error: function(xhr) {                              
                        
                    },
                    complete: function() {
                        $('#btn_kirim').prop('disabled','false');
                        //~location.replace('<?php echo base_url("index.php/home/") ?>');              
                    }
                });
            }
            /*}   
            else{
                swal("Gagal!","Maaf anda tidak dapat membuat permohonan dengan jabatan ini!","error");
                return false;
            }*/
            //~var sk_cpns_1 = $('#sk_cpns_1').val();
            //~if(!sk_cpns_1){
                //~alert('FC. SK CPNS(80%) Tidak boleh kosong !!!');
                //~return false;
            //~}else{
                //~tes_upload();    
            //~}
//~
            //~var sk_pns_1 = $('#sk_pns_1').val();
            //~if(!sk_pns_1){
                //~// $('errSk_pns_1').html('FC. SK PNS(100%) Tidak boleh kosong');
                //~alert('FC. SK PNS(100%) Tidak boleh kosong !!!');
                //~return false;
            //~}else{
                //~tes_upload();
            //~}
//~
//~
            //~var sk_pak_1 = $('#sk_pak_1').val();
            //~if(!sk_pak_1){
                //~alert('FC. SK PENETAPAN ANGKAT KREDIT(PAK) Tidak boleh kosong !!!');
                //~return false;
            //~}else{
                //~tes_upload(); 
            //~}
//~
            //~var ijazah_1 = $('#ijazah_1').val();
            //~if(!ijazah_1){
                //~alert('FC. IJAZAH TERAKHIR Tidak boleh kosong !!!');
                //~return false;
            //~}else{
                //~tes_upload(); 
            //~}
//~
            //~var sk_pgkt_1 = $('#sk_pgkt_1').val();
            //~if(sk_pgkt_1 == ""){
                //~alert('FC. SK PANGKAT TERAKHIR TIdak boleh kosong !!!');
                //~return false;
            //~}else{
                //~tes_upload(); 
            //~}
//~
            //~var dp3_1 = $('#dp3_1').val();
            //~if(dp3_1 == ""){
                //~alert('FC. DP3/SKP 1 TAHUN TERAKHIR Tidak boleh kosong !!!');
                //~return false;
            //~}else{
                //~tes_upload(); 
            //~}
//~
            //~var sdj_1 = $('#sdj_1').val();
            //~if(sdj_1 == ""){
                //~alert('FC. SERTIFIKAT DIKLAT JABFUNG Tidak boleh kosong !!!');
                //~return false;
            //~}else{
                //~tes_upload(); 
            //~}
//~
            //~var sr_1 = $('#sr_1').val();
            //~if(sr_1 == ""){
                //~alert('SURAT REKOMENDASI DARI INSTANSI PEMBINA Tidak boleh kosong !!!');
                //~return false;
            //~}else{
                //~tes_upload(); 
            //~}    
        })

        
        errmsg = "<?php echo $this->session->flashdata('errmsg'); ?>";
        if (errmsg !=''){
            swal({
                title: "Gagal!",
                text: "Data Gagal Diupload. "+errmsg,
                type: "error"
            });
        }

            //~onchangeJenis();
            

            //~$("#jenis").on("change", function(event) {
                //~event.preventDefault();
                    //~onchangeJenis();
            //~});

        });
        
        function load_data_tab(){
            if($('#ref_permohonan > option').length == 0){
                if($('#alert_permohonan').length == 0){
                    $('<span id="alert_permohonan" class="text-center">Tidak ada data</span>').insertBefore('.tabs-container');
                }else{
                    $(this).remove();
                }
                $('.tabs-container').hide();
            }else if($('#ref_permohonan').val() == "null@null"){
                $('.tabs-container').hide();
            }
            var kojabvalue = "<?= $_SESSION['logged_in']['kojab']."@".$_SESSION['logged_in']['id_sop']; ?>";
            // console.log(kojabvalue)
            // if($('#jenis_permohonan') == 2 && $('#ref_permohonan').val() == kojabvalue){
            //     $('#ref_permohonan').prop('disabled',true).trigger('chosen:updated');
            // }
            var value_tmp = $("#ref_permohonan").val().split('@');
            var id_kojabf = value_tmp[0];
            // var id_sop = value_tmp[1];
            var id_jenis_permohonan = $("#jenis").val();
            var id_permohonan = $("#permohonan").val();
            var url = "<?php echo base_url("index.php/permohonan/load_data_first") ?>";
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id_jenis_permohonan: id_jenis_permohonan, id_permohonan: id_permohonan, id_kojabf: id_kojabf
                },
                dataType: 'json',
                success: function(data){
                    //~console.log(data);
                    if(!data){
                        //$("#mekanisme_tab").text('');
                        $("#dasar_hukum_tab").text('');
                        if($('#alert_permohonan').length == 0){
                            $('<span id="alert_permohonan" class="text-center">Tidak ada data</span>').insertBefore('.tabs-container');
                        }else{
                            $(this).remove();
                        }
                        $('.tabs-container').hide();
                        // swal({   
                        //     title: "Maaf!",   
                        //     text: "Terjadi kesalahan, coba lagi nanti!",   
                        //     type: "error",   
                        //     showCancelButton: false,   
                        //     confirmButtonColor: "#DD6B55",   
                        //     confirmButtonText: "Ok!",   
                        //     cancelButtonText: "Whatever!",   
                        //     closeOnConfirm: false,   
                        //     closeOnCancel: false }, function(isConfirm){   
                        //         if (isConfirm) {     
                        //             location.replace('<?php echo base_url("index.php/profile/") ?>');
                        //         } 
                        //     });
                    }else{
                        $('#alert_permohonan').remove();
                        $('.tabs-container').show();
                        //$("#mekanisme_tab").text(data.MEKANISME);
                        $("#dasar_hukum_tab").text(data.DASAR_HUKUM);
                    }
                },
                error: function(xhr) {                              
                    
                },
                complete: function() {
                    fullStat.tabDataStats += 1;
                    // checkif_done({tabDataStats:1})        
                }
            });
        }

        // console.log(fullStat);

        function load_tab_persyaratan(){
            var value_tmp = $("#ref_permohonan").val().split('@');
            var id_kojabf = value_tmp[0];
            // var id_sop = value_tmp[1];
            var id_jenis_permohonan = $("#jenis").val();
            var id_permohonan = $("#permohonan").val();
            var url = "<?php echo base_url("index.php/permohonan/get_data_for_tab") ?>";
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id_jenis_permohonan: id_jenis_permohonan, id_permohonan: id_permohonan, id_kojabf: id_kojabf
                },
                dataType: 'json',
                beforeSend: function(){
                    $("#tab_persyaratan").html('');
                },
                success: function(data){
                    //~console.log(data);
                    if(!data){
                        $("#tab_persyaratan").append('');
                    }else{
                        $("#tab_persyaratan").append(data);
                    }
                    $(".btn-group").css("display", "none");
                    
                },
                error: function(xhr) {                              
                    
                },
                complete: function() {              
                    fullStat.tabPersyaratanStats += 1;
                }
            });
        }
        
        function load_mekanisme(){
            var id_kojabf = $("#ref_permohonan").val();
            var id_jenis_permohonan = $("#jenis").val();
            var id_permohonan = $("#permohonan").val();
            var url = "<?php echo base_url("index.php/permohonan/load_data_first") ?>";
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id_jenis_permohonan: id_jenis_permohonan, id_permohonan: id_permohonan, id_kojabf: id_kojabf, type: 1
                },
                dataType: 'json',
                success: function(data){
                    if(!data){
                        //$("#mekanisme_tab").text('');
                    }else{
                        //$("#mekanisme_tab").text(data.MEKANISME);
                    }
                },
                error: function(xhr) {                              
                    
                },
                complete: function() {              
                    fullStat.tabMekanismeStats += 1;
                }
            });
        }
        
        function load_dasar_hukum(){
            var id_kojabf = $("#ref_permohonan").val();
            var id_jenis_permohonan = $("#jenis").val();
            var id_permohonan = $("#permohonan").val();
            var url = "<?php echo base_url("index.php/permohonan/load_data_first") ?>";
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id_jenis_permohonan: id_jenis_permohonan, id_permohonan: id_permohonan, id_kojabf: id_kojabf, type: 2
                },
                dataType: 'json',
                success: function(data){
                    //~console.log(data);
                    if(!data){
                        $("#dasar_hukum_tab").text('');
                    }else{
                        $("#dasar_hukum_tab").text(data.DASAR_HUKUM);
                    }
                    
                },
                error: function(xhr) {                              
                    
                },
                complete: function() {              
                    fullStat.tabDHStats += 1;
                }
            });
        }
    
        
        function trigger_file_upload(init_syarat){
            $('#' + init_syarat).click();
        }
        
        function insert_to_db(){
            // var id_detail_sop = 1;
            // var id_sop = 1;
            var value_tmp = $("#ref_permohonan").val().split('@');
            var id_kojabf = value_tmp[0];
            var id_sop = value_tmp[1];
            var golru_kojabf = value_tmp[2];
            var id_jenis_permohonan = $("#jenis").val();
            var id_permohonan = $("#permohonan").val();
            var spmu_user = $('#spmu_user').val();
            if($('#jenis').val() == 2){
                var alasan_bbs_smntr = $('#alasan_bbs_smntr').val();    
            }else{
                var alasan_bbs_smntr = 0;
            }
            var url = "<?php echo base_url("index.php/permohonan/insert_to_db") ?>";
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    id_jenis_permohonan: id_jenis_permohonan, id_permohonan: id_permohonan, id_kojabf: id_kojabf, id_sop: id_sop, alasan_bbs_smntr: alasan_bbs_smntr, golru_kojabf: golru_kojabf, spmu_user: spmu_user
                },
                dataType: 'json',
                success: function(data){
                    if(data.responeinsert == 'SUKSES'){
                        swal("Terima Kasih!","Data berhasil di simpan.","success");
                        location.replace('<?php echo base_url("index.php/profile/") ?>');
                        //window.setTimeout(redirect, 1320);
                        //function redirect(){
                            //location.replace('<?php echo base_url("index.php/profile/") ?>');
                        //} 
                    }else{ 
                        swal("Gagal!","Batas usia anda tidak sesuai dengan batas usia pengangkatan, Usia anda ("+data.usia_pgw+" tahun) dan batas usia pengangkatan ("+data.usia_angkat+" tahun).","error");
                        return false;
                    }
                },
                error: function(xhr) {                              
                    
                },
                complete: function() {              
                    
                }
            });
        }
        
        function hide_batal_btn(init_syarat){
            var id_jenis_permohonan = $('#jenis').val();
            $("#status_" + init_syarat + "_" + id_jenis_permohonan).show();
            $(".up" + init_syarat + "_" + id_jenis_permohonan).css("display", "none");
            $("#batal_batal_" + init_syarat + "_" + id_jenis_permohonan).css("display", "none");
            //~return false;
        }   
        
        function showUpload(init_syarat){
            var id_jenis_permohonan = $('#jenis').val();
            //~console.log('#batal_batal_'+ init_syarat);
            //~$("#cek_file_" + init_syarat).remove();
            $("#status_" + init_syarat + "_" + id_jenis_permohonan).css("display", "none");
            $(".up" + init_syarat + "_" + id_jenis_permohonan).show();
            $("#batal_batal_" + init_syarat + "_" + id_jenis_permohonan).show();
        }

        function file_validation(prm, thisx, init_syarat){
            //~console.log(init_syarat + 'from file_validation');
            var ext = prm.split('.').pop().toLowerCase();
            //~console.log($(this).val());
            if($.inArray(ext, ['pdf','png','jpg','jpeg']) == -1) {
                swal("Error!","Format tidak di dukung!.","error");
            }else{
                //~console.log(thisx);
                uploading(thisx, init_syarat);
            }
        }
        
        function test(init_syarat, split_array, data){
            // console.log(split_array + ' ' + data);
            var id_jenis_permohonan = $('#jenis').val();
            $("#status_" + init_syarat + "_" + id_jenis_permohonan).show();
            $(".btn-group-" + init_syarat + "_" + id_jenis_permohonan).show();
            var url = '<?= base_url('assets/file_permohonan') ?>';
            $("#cek_file_" + init_syarat + "_" + id_jenis_permohonan).attr('href',url+'/'+split_array+'/'+data+'');
        }
        
        function uploading(thisx, init_syarat){
            //~console.log(init_syarat);
            //~return false;
            var formData = new FormData();
            //~console.log(value);
            formData.append('file', thisx);
            
            //~$("#files").append($("#fileUploadProgressTemplate").tmpl());
            //~$("#fileUploadError").addClass("hide");
            var permohonan = $('#permohonan').val();
            var jenis = $('#jenis').val();
            
            $.ajax({
                url: '<?php echo base_url("index.php/permohonan/doaddaction")?>/' + init_syarat + '/' + permohonan + '/' + jenis,
                type: 'POST',
                xhr: function() {
                    var xhr = $.ajaxSettings.xhr();
                    if (xhr.upload) {
                        xhr.upload.addEventListener('progress', function(evt) {
                            $("#batal_batal_" + init_syarat + "_" + jenis).css("display", "none");
                            $(".up" + init_syarat + "_" + jenis).css("display", "none");
                            $("." + init_syarat + "_" + jenis).show();
                            var percent = (evt.loaded / evt.total) * 100;
                            $("." + init_syarat + "_" + jenis).find(".progress-bar").width(percent + "%");
                            $("." + init_syarat + "_" + jenis).find(".progress-bar").text(Math.round(percent) + "%");
                        }, false);
                    }
                    return xhr;
                },
                success: function(data) {
                    setInterval(function hide(){
							$("." + init_syarat + "_" + jenis).css("display", "none");
                            // console.log(data)
							var split_array = data.split("@");
							test(init_syarat, split_array[0], data);
						}, 4000);
                    //$("#status_" + init_syarat).html("<h3>Berhasil di upload!</h3>").delay(2000).fadeOut(2200);
                    //~var url = "<?php echo base_url("assets/file_permohonan/") ?>/" + split_array[0] +"/"+ data;
                    //~$("#status_" + init_syarat).show();
                    //~$("#cek_file_" + init_syarat).attr('href','http://simpegdev.jakarta.go.id/assets/file_permohonan/'+split_array[0]+'/'+data+'');
                    //~$(".batal_" + init_syarat).before("<a href='http://simpegdev.jakarta.go.id/assets/file_permohonan/"+split_array[0]+"/"+data+"' target='_blank' class='btn btn-success' id='cek_file_"+ init_syarat +"'>Cek file</a>");
                    //~alert(data);
                    //$('body').html(data);
                    //~console.log(data)
                    //~$("#files").children().last().remove();
                    //~$("#files").append($("#fileUploadItemTemplate").tmpl(data));
                    //~$("#uploadFile").closest("form").trigger("reset");
                },
                error: function(data) {
                    console.log('An error occured!');
                    //~$("#fileUploadError").removeClass("hide").text("An error occured!");
                    //~$("#files").children().last().remove();
                    //~$("#uploadFile").closest("form").trigger("reset");
                },
                data: formData,
                //~data: {
                    //~files : value 
                //~},
                cache: false,
                contentType: false,
                processData: false
            }, 'json');
        }
        
function tes_upload1()
        {
            var prm = $('#permohonan').val();
            var jns = $('#jenis').val();
            var nrk = $('#nrk').val();

            var sk_cpns_1 = $('#sk_cpns_1').val();
            var sk_pns_1 = $('#sk_pns_1').val();
            var sk_pak_1 = $('#sk_pak_1').val();
            var ijazah_1 = $('#ijazah_1').val();
            var sk_pgkt_1 = $('#sk_pgkt_1').val();
            var dp3_1 = $('#dp3_1').val();
            var sdj_1 = $('#sdj_1').val();
            var sr_1 = $('#sr_1').val();

            var sk_pdj_2 = $('#sk_pdj_2').val();
            var sk_psj_2 = $('#sk_psj_2').val();
            var sk_pak_2 = $('#sk_pak_2').val();
            var sk_pgkt_2 = $('#sk_pgkt_2').val();
            var ijazah_2 = $('#ijazah_2').val();
            var dp3_2 = $('#dp3_2').val();
            var sr_2 = $('#sr_2').val();

            var sk_pdj_3 = $('#sk_pdj_3').val();
            var sk_pak_3 = $('#sk_pak_3').val();
            var ijazah_3 = $('#ijazah_3').val();
            var dp3_3 = $('#dp3_3').val();
            var sk_pgkt_3 = $('#sk_pgkt_3').val();
            var bukti_3 = $('#bukti_3').val();

            
            $.ajax({
                    url: '<?php echo base_url("index.php/permohonan/doaddaction"); ?>/',
                    data: {
                        ID_PERMOHONAN : prm, ID_JENIS:jns, nrk:nrk, sk_cpns_1 : sk_cpns_1, sk_pns_1 : sk_pns_1, sk_pak_1 : sk_pak_1,ijazah_1:ijazah_1,
                        sk_pgkt_1 : sk_pgkt_1, dp3_1:dp3_1, sdj_1:sdj_1,sr_1:sr_1, sk_pdj_2:sk_pdj_2, sk_psj2 : sk_psj_2, sk_pak_2 : sk_pak_2,
                        sk_pgkt_2 : sk_pgkt_2, ijazah_2 :ijazah_2, dp3_2 : dp3_2, sr_2:sr_2, sk_pdj_3:sk_pdj_3, sk_pak_3 : sk_pak_3, ijazah_3 : ijazah_3,
                        dp3_3 : dp3_3, sk_pgkt_3:sk_pgkt_3, bukti_3 : bukti_3
                    },
                    type: 'post',
                    dataType: 'html',
                    // beforeSend: function() {                        
                    //     //$(".ibox-content").html(spinner);
                    // },
                    // success: function(data){
                    //     $('.ibox-content').html(data);
                    // }
                });
        }

        function tes_upload(){
        var url = "<?php echo $linkaction; ?>";

        $.ajax({
            url: url,
            type: "POST",
            // data: {'useridaa':$("#userid").val(),'usernameaa':$("#username").val()},
            data: $("#formUpload").serialize(),
            dataType: 'json',
            // success: function(data) {                               
                
            //     if(data.responeinsert == 'SUKSES'){
            //         alert("Sukses, "+data.test);                    
            //         // location.reload();
            //     }else{
            //         alert("GAGAL SIMPAN");
            //     }
            // },
            error: function(xhr) {                              
                
            },
            complete: function() {              
                
            }
        });
    }

        //~function readURL(input,id,eror,blah) 
        //~{
            //~$(id).val(input.value);
            //~//alert(a);
//~
            //~var ext = $(id).val().split('.').pop().toLowerCase();
            //~if($.inArray(ext, ['png','jpg','jpeg','pdf']) == -1) {
                //~$(eror).show();
                //~
                //~$(blah).hide();
            //~}else{
                //~
                //~$(eror).hide();
                //~$(blah).show();
//~
                //~if (input.files && input.files[0]) {
                    //~var reader = new FileReader();
//~
                    //~reader.onload = function (e) {
                        //~$(blah).attr('src', e.target.result);
                    //~}
//~
                    //~reader.readAsDataURL(input.files[0]);
                //~}
            //~}
        //~}



        function kirim_file(formid) {
                  
            var mohon = document.getElementById('permohonan').value;
            var cekJenis = document.getElementById('jenis').value;
            //alert (cekJenis);

            var dtbl;
            if(cekJenis == 1)
            {
                var a = document.getElementById('sk_cpns_1').value; 
                var b = document.getElementById('sk_pns_1').value;
                var c = document.getElementById('sk_pak_1').value;
                var d = document.getElementById('ijazah_1').value;
                var e = document.getElementById('sk_pgkt_1').value;
                var f = document.getElementById('dp3_1').value;
                var g = document.getElementById('sdj_1').value;
                var h = document.getElementById('sr_1').value;

            }
            else if(cekJenis == 2)
            {
                var a = document.getElementById('sk_cpns_1').value; 
                var b = document.getElementById('sk_pns_1').value;
                var c = document.getElementById('sk_pak_1').value;
                var d = document.getElementById('ijazah_1').value;
                var e = document.getElementById('sk_pgkt_1').value;
                var f = document.getElementById('dp3_1').value;
                var g = document.getElementById('sdj_1').value;
            }
            else
            {
                id_dtbl ='pembebasan_sementara';
            }
               
            }

            

            /*START CHOSEN*/
            var config = {
                  '.chosen-jenis'           : {no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                                }
                for (var selector in config) {
                  $(selector).chosen(config[selector]);
                }
            /*END CHOSEN*/

            //~function onchangeJenis()
            //~{
                //~var resJenis = document.getElementById('jenis').value;
                //~
                //~if(resJenis == 1)
                //~{
                    //~document.getElementById('pengangkatan').style.display = "";
                    //~document.getElementById('pengangkatan_kembali').style.display = "none";
                    //~document.getElementById('pembebasan_sementara').style.display = "none";
                //~}
                //~else if(resJenis == 2)
                //~{
                    //~document.getElementById('pengangkatan').style.display = "none";
                    //~document.getElementById('pengangkatan_kembali').style.display = "";
                    //~document.getElementById('pembebasan_sementara').style.display = "none";
                //~}
                //~else
                //~{
                    //~document.getElementById('pengangkatan').style.display = "none";
                    //~document.getElementById('pengangkatan_kembali').style.display = "none";
                    //~document.getElementById('pembebasan_sementara').style.display = "";
                //~}
            //~}

            function bigImg(x) {
                x.style.height = "450px";
                x.style.width = "auto";
            }

            function normalImg(x) {
                x.style.height = "170px";
                x.style.width = "auto";
            }

            function setNamaNip()
            {
                var valnrk = $('#valnrk').val();

                $.ajax({
                    url: '<?php echo base_url("index.php/laporan/getDtPgw"); ?>',
                    type: "post",
                    data: {
                        valnrk: valnrk
                    },
                    dataType: 'JSON',
                    beforeSend: function() {
                        $('.msg').html('');
                        $('.err').html("");
                    },
                    success: function(data) {
                        $('#value6').val(data.NAMA);
                        $('#value7').val(data.NIP18);
                    
                    },
                    error: function(xhr) {
                        $('.msg').html('');
                        $('.err').html("<small>Terjadi kesalahan</small>");
                    },
                    complete: function() {

                    }
                    
                });
            
            }

            
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


        </script>

