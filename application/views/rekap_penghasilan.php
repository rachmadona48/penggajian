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
        <h2>Rekap Penghasilan</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo site_url('batch')?>">Home</a>
            </li>
            <li class="active">
                <strong>Rekap Penghasilan</strong>
            </li>
        </ol>
        <small><i>(Menu untuk melakukan pengecekan data untuk integrasi dengan SIPKD)</i></small>
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
                                <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-briefcase"></i>Cek Rekap Tgl Publish</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-briefcase"></i>Cek Rekap Hari Ini</a></li>
                                
                            </ul>
                            <div class="tab-content">

                                <!-- Tab 1 -->
                                <div id="tab-1" class="tab-pane active">
                                    <div class="ibox-content">
                                        <div class="row">
                                            <form role="form" class="form-inline" action="javascript:">
                                                <div class="row">

                                                    <input type="hidden" readonly="" id="idt5" name="idt5" class="form-control">

                                                    <div class="form-group pickerpicker" id="data_1">
                                                        <label class="col-sm-2 control-label">Tanggal Publish<span class="required">*</span></label>&nbsp;&nbsp;
                                                        <div class="input-group col-sm-7 date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tglpub" name="tglpub" placeholder="Tanggal Publish" value="" class="form-control" readonly>
                                                        </div>
                                                    </div>

                                                   

                                                </div>
                                            </form>

                                            <div class="ibox-title" id="butekrekap" >
                                                 
                                                <button class="btn btn-primary btn-rounded btn-block btn-outline" id="but_rekap" onclick="excute_rekaptglpub()"><i class="fa fa-info-circle"></i> Eksekusi Rekap</button>
                                            </div>
                                        </div><!--end div row-->


                                        <div class="row">
                                            <div class="ibox-content" id="isidata">
                                                

                                            </div>

                                        </div>

                                       
                                    </div>
                                </div> <!-- end DIV TAB 1-->


                                <!-- Tab 2 -->
                                <div id="tab-2" class="tab-pane">
                                    <div class="ibox-content">
                                        <div class="row">
                                            <form role="form" class="form-inline" action="javascript:">
                                                <div class="row">
                                                    <input type="hidden" readonly="" id="idt6" name="idt6" class="form-control">
                                                    
                                                   

                                                    <input type="hidden" readonly="" id="idt5" name="idt5" class="form-control">

                                                    <div class="form-group pickerpicker" id="data_2">
                                                        <label class="col-sm-3 control-label">Tanggal Hari Ini<span class="required">*</span></label>&nbsp;&nbsp;
                                                        <div class="input-group col-sm-7">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tglhrini" name="tglhrini" placeholder="Tanggal Hari Ini" value="<?php echo date('d-m-Y'); ?>" class="form-control" readonly>
                                                        </div>
                                                    </div>

                                                   

                                                
                                                 
                                                 
                                                    
                                                </div>
                                            </form>
                                            <div class="ibox-title" id="butekstkd2">
                                                        <button class="btn btn-primary btn-rounded btn-block btn-outline" id="but_tkd2" onclick="javascript:excute_rekaphariini();"><i class="fa fa-info-circle"></i> Eksekusi Rekap</button>
                                                    </div>
                                                    
                                        </div><!--end div row-->

                                      

                                    </div>
                                </div> <!-- end DIV TAB 2-->


                                
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

<div class="modal inmodal" id="modalData"  role="dialog"  aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                
                <h4 class="modal-title">Laporan Data</h4>
                <!-- <small>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small> -->
            </div>
            <div class="modal-body">
                <p id="isi"></p>
                <p id="tabel1isi"></p>
                <p id="isi2"></p>
                <p id="isi3"></p>
                <p id="tabel2isi"></p>
                <h2 id="isi4"></h2>
                <p id="isi5"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal" onclick ="tutupmodal()">Close</button>
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


            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "dd-mm-yyyy",
                endDate :  new Date()
            });

            $('#data_2 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: "dd-mm-yyyy",
                endDate :  new Date()
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

    
  
  
    </script>

   

    <script type="text/javascript">

  
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

  




<script type="text/javascript">
	


    function excute_rekaptglpub(){
    var tgl_batch = $('#tglpub').val();
    
    if(tgl_batch == "")
    {
        swal("Peringatan", "Tanggal Publish harus diisi ", "warning"); 
    }
    else
    {
          swal({
                  title: "Warning",
                  text: "Apakah anda benar ingin melakukan eksekusi Rekap Penghasilan tanggal "+tgl_batch+" ?",
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
                        cekrevisi(tgl_batch);
                        excute_rekaptglpub2(tgl_batch);
                        //return false;
                       //swal("Sukses", "Sukses Eksekusi Krimi TKD dengan tanggal Batch "+tgl_batch, "success");
                       //alert("lanjut");
                  } else {
                        swal("Gagal", "Gagal Eksekusi Rekap Penghasilan dengan tanggal  "+tgl_batch, "error");
                  }
                });
    }
   
    }


    function cekrevisi(tgl_batch){
        $.ajax({
            url: '<?php echo base_url("index.php/rekap_penghasilan/cekrevisi") ?>',
            type: "post",
            data: {tgl_batch:tgl_batch},
            dataType: "JSON",
            beforeSend: function(){
                
            },
            success: function(data){
                
                
                
                    
                console.log(data);
                

                
            },
            error: function (xhr, status, err) {                       
                
                
                
                
            },
            complete: function(){
                
                
                
            }
        });
    
    }

    function excute_rekaptglpub2(tgl_batch){
        $.ajax({
            url: '<?php echo base_url("index.php/rekap_penghasilan/exc_rekaphasiltglpub") ?>',
            type: "post",
            data: {tgl_batch:tgl_batch},
            dataType: "JSON",
            beforeSend: function(){
                $('#modalExcPenglain').modal('show');
            },
            success: function(data){
                
                 $('#modalExcPenglain').modal('hide');
                
                    
                
                if(data.respone == 'sukses')
                {
                    swal("Sukses", "Berhasil Eksekusi  tanggal  "+tgl_batch, "success");    
                      $('#modalData').modal('show');      

                    if(data.laporan.data1.VJUMLAHREKAP == 0)
                    {
                        $('#isi').html('Pengecekan Tanggal Publish : '+data.laporan.data1.TGL_PUBLISH + ' &nbsp;&nbsp; ID: '+data.laporan.data1.ID_CEK +'<br/><br/>Pengecekan dimulai pada '+data.laporan.data1.WAKTU_MULAI+"<br/><br/> Tidak Ada Penghasilan di Tanggal Ini");

                        $('#isi5').html('Pengecekan berakhir pada: '+data.laporan.data7.WAKTU_AKHIR);    
                    }
                    else
                    {
                        if(data.laporan.data1.VJUMLAHRUTIN == 0)
                        {
                            $('#isi').html('Pengecekan Tanggal Publish : '+data.laporan.data1.TGL_PUBLISH + ' &nbsp;&nbsp; ID: '+data.laporan.data1.ID_CEK +'<br/><br/>Pengecekan dimulai pada '+data.laporan.data1.WAKTU_MULAI+"<br/><br/> Pengecekan Rutin Berhasil Sempurna ");

                            if(data.laporan.data2 != "")
                            {
                                var ii;
                                for(i=0;i<data.laporan.data2.length;i++)
                                {
                                
                                ii += "<tr><td width='100px'>"+data.laporan.data2[i].THBL+"</td><td width='100px'>"+data.laporan.data2[i].KODE_SIPKD+"</td><td width='100px'>"+data.laporan.data2[i].MACAM+"</td><td width='100px'>"+data.laporan.data2[i].TGL_PUBLISH+"</td></tr>";
                                }
                                
                                $('#tabel1isi').html(ii);    
                            }
                            
                        }
                        else
                        {
                            $('#isi').html('Pengecekan Tanggal Publish : '+data.laporan.data1.TGL_PUBLISH + '<br/><br/>Pengecekan dimulai pada '+data.laporan.data1.WAKTU_MULAI+"<br/><br/> Ada Kesalahan saat pengecekan Rutin, muncul lebih dari satu kali.<br/><br/>");   
                        }

                        $("#isi2").html("Pengecekan Selisih " +data.laporan.data3.CEK_SELISIH);
                        $('#isi3').html("Ada "+data.laporan.data1.VJUMLAHREKAP+ " record penghasilan di SIMPEG" )

                        var jj;
                                for(j=0;j<data.laporan.data4.length;j++)
                                {
                                
                                jj += "<tr><td width='100px'>"+data.laporan.data4[j].THBL+"</td><td width='100px'>"+data.laporan.data4[j].WAKTU+"</td><td width='100px'>"+data.laporan.data4[j].JENIS+"</td><td width='100px'>"+data.laporan.data4[j].JUMLAH+"</td><td width='100px'>"+data.laporan.data4[j].MACAM+"</td></tr>";
                               }
                                
                                $('#tabel2isi').html(jj);   

                        if(data.laporan.data6.V_ERROR == 'F')
                        {
                            if(data.laporan.data5.VJUMLAHREKAP == data.laporan.data5.VJUMLAHSIPKD)
                            {
                                $('#isi4').html('Proses Transfer Berhasil');
                                $("#isi4").css("color", "green");
                            }
                            else
                            {
                                $('#isi4').html('Jumlah record VIEW tidak sama dengan TABEL');
                                $("#isi4").css("color", "red");
                            }    
                        }
                        else
                        {
                             $('#isi4').html('Belum terjadi proses transfer data');
                             $("#isi4").css("color", "red");
                        }

                        $('#isi5').html('Pengecekan berakhir pada: '+data.laporan.data7.WAKTU_AKHIR);    
                    }
                    
                    
                }
                else
                {
                    swal("Gagal", "Gagal Eksekusi  tanggal  "+tgl_batch, "error");    
                    
                }
                
            },
            error: function (xhr, status, err) {                       
                
                
                $('#modalExcPenglain').modal('hide');
                
            },
            complete: function(){
                
                $('#myModal0').modal('hide'); 
                
            }
        });
    
	}

    function excute_rekaphariini(){
    var tgl_batch = $('#tglhrini').val();
    
    
       $.ajax({
        beforeSend : function(){
            swal({
                  title: "Warning",
                  text: "Apakah anda benar ingin melakukan eksekusi Rekap Penghasilan tanggal "+tgl_batch+" ?",
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
                        cekrevisi(tgl_batch);
                        excute_rekaphariini2();
                       
                       //alert("lanjut");
                  } else {
                        swal("Gagal", "Gagal Eksekusi Rekap Penghasilan dengan tanggal  "+tgl_batch, "error");
                  }
                });
            }


        });
    
   
    }


    function excute_rekaphariini2(){
        var tgl_batch = $('#tglhrini').val();
        $.ajax({
            url: '<?php echo base_url("index.php/rekap_penghasilan/exc_rekaphasilhariini") ?>',
            type: "post",
            data: {tgl_batch:tgl_batch},
            dataType: "JSON",
            beforeSend: function(){
                $('#modalExcPenglain').modal('show');
            },
            success: function(data){
                 $('#modalExcPenglain').modal('hide');
                
                
                
                if(data.respone == 'sukses')
                {
                    swal("Sukses", "Berhasil Eksekusi  tanggal  "+tgl_batch, "success");    
                    $('#modalData').modal('show');      

                    if(data.laporan.data1.VJUMLAHREKAP == 0)
                    {
                        $('#isi').html('Pengecekan Tanggal Publish : '+data.laporan.data1.TGL_PUBLISH + ' &nbsp;&nbsp; ID: '+data.laporan.data1.ID_CEK + '<br/><br/>Pengecekan dimulai pada '+data.laporan.data1.WAKTU_MULAI+"<br/><br/> Tidak Ada Penghasilan di Tanggal Ini");

                        $('#isi5').html('Pengecekan berakhir pada: '+data.laporan.data7.WAKTU_AKHIR);    
                    }
                    else
                    {
                        if(data.laporan.data1.VJUMLAHRUTIN == 0)
                        {
                            $('#isi').html('Pengecekan Tanggal Publish : '+data.laporan.data1.TGL_PUBLISH + ' &nbsp;&nbsp; ID: '+data.laporan.data1.ID_CEK + '<br/><br/>Pengecekan dimulai pada '+data.laporan.data1.WAKTU_MULAI+"<br/><br/> Pengecekan Rutin Berhasil Sempurna ");

                            if(data.laporan.data2 != "")
                            {
                                var ii;
                                for(i=0;i<data.laporan.data2.length;i++)
                                {
                                
                                ii += "<tr><td width='100px'>"+data.laporan.data2[i].THBL+"</td><td width='100px'>"+data.laporan.data2[i].KODE_SIPKD+"</td><td width='100px'>"+data.laporan.data2[i].MACAM+"</td><td width='100px'>"+data.laporan.data2[i].TGL_PUBLISH+"</td></tr>";
                                }
                                
                                $('#tabel1isi').html(ii);    
                            }
                            
                        }
                        else
                        {
                            $('#isi').html('Pengecekan Tanggal Publish : '+data.laporan.data1.TGL_PUBLISH + '<br/><br/>Pengecekan dimulai pada '+data.laporan.data1.WAKTU_MULAI+"<br/><br/> Ada Kesalahan saat pengecekan Rutin, muncul lebih dari satu kali.<br/><br/>");   
                        }

                        $("#isi2").html("Pengecekan Selisih " +data.laporan.data3.CEK_SELISIH);
                        $('#isi3').html("Ada "+data.laporan.data1.VJUMLAHREKAP+ " record penghasilan di SIMPEG" )

                        var jj;
                                for(j=0;j<data.laporan.data4.length;j++)
                                {
                                
                                jj += "<tr><td width='100px'>"+data.laporan.data4[j].THBL+"</td><td width='100px'>"+data.laporan.data4[j].WAKTU+"</td><td width='100px'>"+data.laporan.data4[j].JENIS+"</td><td width='100px'>"+data.laporan.data4[j].JUMLAH+"</td><td width='100px'>"+data.laporan.data4[j].MACAM+"</td></tr>";
                               }
                                
                                $('#tabel2isi').html(jj);   

                        if(data.laporan.data6.V_ERROR == 'F')
                        {
                            if(data.laporan.data5.VJUMLAHREKAP == data.laporan.data5.VJUMLAHSIPKD)
                            {
                                $('#isi4').html('Proses Transfer Berhasil');
                                $("#isi4").css("color", "green");
                            }
                            else
                            {
                                $('#isi4').html('Jumlah record VIEW tidak sama dengan TABEL');
                                $("#isi4").css("color", "red");
                            }    
                        }
                        else
                        {
                             $('#isi4').html('Belum terjadi proses transfer data');
                             $("#isi4").css("color", "red");
                        }

                        $('#isi5').html('Pengecekan berakhir pada: '+data.laporan.data7.WAKTU_AKHIR);    
                    }
                    
                    
                }
                else
                {
                    swal("Gagal", "Gagal Eksekusi  tanggal  "+tgl_batch, "error");    
                    
                }
                
            },
            complete: function(){
                
                //$('#myModal0').modal('hide');
                return false;
                
            },
            error: function (xhr, status, err) {                       
                
                
                $('#modalExcPenglain').modal('hide');
                
            }
        });
    }

    function tutupmodal()
    {
        $('#isi').html('');
        $('#modalData').modal('hide');   
    }

  
</script>

    



