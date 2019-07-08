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
        <h2>Proses PTT</h2>
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
                                <li class="active"><a data-toggle="tab" href="#tab-ptt"><i class="fa fa-briefcase"></i>Gaji PTT</a></li>
                                <li class=""><a data-toggle="tab" href="#tab-tpp"><i class="fa fa-briefcase"></i>TPP</a></li>
                            </ul>
                            <div class="tab-content">

                                <!-- Tab gaji ptt -->
                                <div id="tab-ptt" class="tab-pane active">
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
                                                            <i class="fa fa-refresh"></i>&nbsp; Tampilkan Gaji PTT
                                                        </button>
                                                        <button class="btn btn-primary btn-facebook btn-outline" onclick="javascript:cetak_gajiPTT(this)">
                                                            <i class="fa fa-print"></i>&nbsp; Download File Gaji PTT
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
                                </div> <!-- end div tab ptt-->


                                <!-- Tab tpp -->
                                <div id="tab-tpp" class="tab-pane">
                                    <div class="ibox-content">
                                        <div class="row">
                                            <!-- <form role="form" class="form-inline" id="pph" action="javascript:savePPH();"> -->
                                            <form role="form" class="form-inline" action="javascript:">
                                                <div class="row">
                                                    <input type="hidden" readonly="" id="idt4" name="idt4" class="form-control">
                                                    <div class="form-group" id="data_7">
                                                        <label class="col-sm-2 control-label">Tanggal Batch<span class="required">*</span></label>&nbsp;&nbsp;
                                                        <div class="input-group col-sm-7 date">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="thbltpp" name="thbltpp" placeholder="Tahun Bulan" value="" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" >
                                                        <button class="btn btn-danger btn-facebook btn-outline" onclick="tombol_exc_tpp()">
                                                            <i class="fa fa-refresh"></i>&nbsp; Tampilkan TPP
                                                        </button>
                                                        <button class="btn btn-primary btn-facebook btn-outline" onclick="javascript:cetak_gajiTPP_PTT(this)">
                                                            <i class="fa fa-print"></i>&nbsp; Download File TPP PTT
                                                        </button>
                                                    </div>
                                                </div>
                                             </form>

                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div id="btn_exc_tpp" style="display: none">
                                                <div class="ibox-title">
                                                    <div>
                                                        <button class="btn btn-primary btn-rounded btn-block btn-outline" onclick="tpp_tahap1()"><i class="fa fa-info-circle"></i> Eksekusi TPP PTT</button>
                                                    </div>
                                                    <!-- <br>
                                                    <div id="btn_tpp2" style="display: none;">
                                                        <button class="btn btn-danger btn-rounded btn-block btn-outline" onclick="tpp_tahap2()"><i class="fa fa-info-circle"></i> Eksekusi Tpp Tahap 2</button>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" id="view_tpp" style="display: none">
                                            <div class="ibox-content">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="tabletpp" class="table table-bordered table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <td align="left" width="3%"><b>No</b></td>
                                                                    <td align="left" ><b>THBL</b></td>
                                                                    <td align="left" ><b>NPTT</b></td>
                                                                    <td align="left" ><b>Nama</b></td>
                                                                    <td align="left" ><b>Kinerja</b></td>
                                                                    <td align="left" ><b>TPP Bersih</b></td>
                                                                    <td align="left" ><b>Nama Lokasi Gaji</b></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <div id="spinner_tabletpp"></div>
                                                            </tbody>
                                                        </table>                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!--end DIV PTT -->

                                        <!-- <div class="row" id="RPTT" style="display:none">
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
                                        </div>  -->


                                    </div>
                                </div> <!-- end tpp-->

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




    <script type="text/javascript">
        // function tombol_exc_tpp()
        // {
        //     alert('tampil');
        //     // $('#btn_exc_tpp').show();
        //     // tabelPTT();
        // }
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
                url:   "<?php echo site_url('index.php/admin/batch/tgl_batch')?>", 
                type: "POST", 
                dataType : 'json',
                success: function(data){  /*Return from PHP side*/
                        // $('#idt').val(data.idt);
                        // $('#idt2').val(data.idt);
         //                $('#idt3').val(data.idt);
                        $('#idt4').val(data.idt);
         //                $('#idt5').val(data.idt);
         //                $('#idt6').val(data.idt);
         //                $('#idt7').val(data.idt);
                        // $('#tgl_batch').val(data.tglBatch);
                        // $('#tgl_batch2').val(data.tglBatch);
                        // $('#tgl_batch3').val(data.tglBatch);
                        $('#thblptt').val(data.tglBatch);
                        $('#thbltpp').val(data.tglBatch);
                        // $('#thblkrimitkd').val(data.tglBatch);
                        // $('#thbltkd2').val(data.tglBatch);
                        // $('#thbltrans').val(data.tglBatch);
                        
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
                        // $('#idt').val(data.idt);
                        // $('#idt2').val(data.idt);
                        // $('#idt3').val(data.idt);
                        $('#idt4').val(data.idt);
                        // $('#idt5').val(data.idt);
                        // $('#idt6').val(data.idt);
                        // $('#idt7').val(data.idt);
                        // $('#tgl_batch').val(data.tglBatch);
                        // $('#tgl_batch2').val(data.tglBatch);
                        // $('#tgl_batch3').val(data.tglBatch);
                        $('#thblptt').val(data.tglBatch);
                        $('#thbltpp').val(data.tglBatch);
                        // $('#thblkrimitkd').val(data.tglBatch);
                        // $('#thbltkd2').val(data.tglBatch);
                        // $('#thbltrans').val(data.tglBatch);
                }
            })
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
 //    $(function() {
    //     $("#tabelid").on("change", function(event) {
    //         event.preventDefault();
 //            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 
    //      var tabelid = $('#tabelid').val();
    //      // alert(tabelid);
    //      if(tabelid == 1){
    //          // alert('tabel satu');
    //          $.ajax({
    //              type: 'POST',
    //              url: '<?php echo site_url("index.php/admin/batch/view_gaji");?>',
    //              dataType: 'JSON',
    //              beforeSend: function(){
    //                  // $('#modalchange').modal('show');
 //                        $('#spinner_wait').html(spinner);
    //              },
    //              success: function(data) 
    //              {
    //                  if(data.response == 'SUKSES'){
    //                         gaji = '<option value=""></option>' + data.gaji;
    //                         $('#bulanplain').html(gaji);
    //                         // $('#modalchange').modal('hide');
 //                            $("#spinner_wait").html('');
    //                     }else{
    //                         $('#bulanplain').html('');
    //                         // $('#modalchange').modal('hide');
 //                            $("#spinner_wait").html('');
    //                     }
    //              }           
    //          });
    //      }else if(tabelid == 2){
    //          // alert('tabel dua');
    //          $.ajax({
    //              type: 'POST',
    //              url: '<?php echo site_url("index.php/admin/batch/view_tkd");?>',
    //              dataType: 'JSON',
    //              beforeSend: function(){
    //                  // $('#modalchange').modal('show');
 //                        $('#spinner_wait').html(spinner);
    //              },
    //              success: function(data) 
    //              {
    //                  if(data.response == 'SUKSES'){
    //                         tkd = '<option value=""></option>' + data.tkd;
    //                         $('#bulanplain').html(tkd);
    //                         // $('#modalchange').modal('hide');
 //                            $("#spinner_wait").html('');
    //                     }else{
    //                         $('#bulanplain').html('');
    //                         // $('#modalchange').modal('hide');
 //                            $("#spinner_wait").html('');
    //                     }
    //              }           
    //          });
    //      }else{
    //          // alert('tabel tiga');
    //          $.ajax({
    //              type: 'POST',
    //              url: '<?php echo site_url("index.php/admin/batch/view_guru");?>',
    //              dataType: 'JSON',
    //              beforeSend: function(){
    //                  // $('#modalchange').modal('show');
 //                        $('#spinner_wait').html(spinner);
    //              },
    //              success: function(data) 
    //              {
    //                  if(data.response == 'SUKSES'){
    //                         tkd_guru = '<option value=""></option>' + data.tkd_guru;
    //                         $('#bulanplain').html(tkd_guru);
    //                         // $('#modalchange').modal('hide');
 //                            $("#spinner_wait").html('');
    //                     }else{
    //                         $('#bulanplain').html('');
    //                         // $('#modalchange').modal('hide');
 //                            $("#spinner_wait").html('');
    //                     }
    //              }           
    //          });
    //      }
    //     });
    // });

    
    </script>

    <script type="text/javascript"> 
 
    function showPTT()
    {
        // alert('tampil');
        $('#RPTT').hide();
        $('#VPTT').show();
            tabelPTT();

        $('#divptt').show();
    }

    function tombol_exc_tpp()
    {
        // alert('tampil tpp');
        $('#btn_exc_tpp').show();
        $('#view_tpp').show();
        tabelTPP();
    }


    function hidePTT()
    {
        $('#VPTT').hide();
    }
    </script>

    <script type="text/javascript">

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
</script>

<script type="text/javascript">

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
                        $('#spinner_tableptt').html(spinner);
                    },complete: function(){
                             $("#spinner_tableptt").html('');
                    },
                    error: function(){  // error handling
                        $(".tableptt-error").html("");
                        $("#tableptt").append('<tbody class="tableptt-error"><tr><div colspan=6>Tidak Ada Data</div></tr></tbody>');
                        $("#tableptt_processing").css("display","none");
                        
                    }

                }
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

    function tabelTPP(){
        var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>'; 

        var dataTable = $('#tabletpp').DataTable( {
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
                    url :"<?php echo site_url('index.php/admin/batch/dataTPP')?>", // json datasource
                    type: "post",  // method  , by default get
                    // drawCallback: function( settings ) {
                      
                    // },
                    data : function(d){
                        d.thbltpp = $('#thbltpp').val();
                    },
                    beforeSend: function(){
                        $('#spinner_tabletpp').html(spinner);
                    },complete: function(){
                        $("#spinner_tabletpp").html('');
                    },
                    error: function(){  // error handling
                        $(".tabletpp-error").html("");
                        $("#tabletpp").append('<tbody class="tabletpp-error"><tr><div colspan=6>Tidak Ada Data</div></tr></tbody>');
                        $("#tabletpp_processing").css("display","none");
                        
                    }

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
                    });

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
                
            },
            error: function (xhr, status, err) {                       
                var str = xhr.responseText;
                alert(str);
                $('#modalExcPenglain').modal('hide');
                reload_tglBatch();
                hidePTT();
                $('#RPTT').show();
                tabelPTTRes();
            }
        });
    }

    function tpp_tahap1(){
        // alert('exc tpp1');
        var thbltpp = $('#thbltpp').val();
        swal({
          title: "Peringatan",
          text: "Apakah anda benar ingin melakukan eksekusi TPP dengan tahun bulan "+thbltpp+" ?",
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
                cek_thbl_tpp(thbltpp);
          } else {
                swal("Gagal", "Gagal Eksekusi TPP Tahap 1 untuk Tahun Bulan "+thbltpp, "error");
          }
        });
    }

    function cek_thbl_tpp(thbltpp){
        $.ajax({
            url: '<?php echo base_url("index.php/admin/batch/cek_tpp1") ?>',
            type: "post",
            data: {thbltpp:thbltpp},
            dataType: "JSON",
            beforeSend: function(){
                // $('#modalExcPenglain').modal('show');
            },
            success: function(data){
                if(data.respone=='sukses'){
                    execute_tpp1(thbltpp);
                    // $('#btn_tpp2').show();
                }else{
                    swal("Peringatan", "Data untuk Tahun Bulan "+thbltpp+" sudah ada ", "warning");
                    // $('#btn_tpp2').show();
                }
                
            },
            complete: function(){
                
            }
        });
    }

    function execute_tpp1(thbltpp){
        $.ajax({
            url: '<?php echo base_url("index.php/admin/batch/execute_tpp1") ?>',
            type: "post",
            data: {thbltpp:thbltpp},
            dataType: "JSON",
            beforeSend: function(){
                $('#modalExcPenglain').modal('show');
            },
            success: function(data){
                if(data.respone=='sukses'){
                    swal("Sukses", "Berhasil Eksekusi TPP PTT dengan Tahun Bulan "+thbltpp, "success");
                    $('#modalExcPenglain').modal('hide');
                    reload_tglBatch()
                    tabelTPP();
                }else{
                    swal("Peringatan", "Data untuk Tahun Bulan "+thbltpp+" sudah ada ", "warning");
                    $('#modalExcPenglain').modal('hide');
                    reload_tglBatch()
                    tabelTPP();
                    
                }
                
            },
            error: function (xhr, status, err) {                       
                var str = xhr.responseText;
                alert(str);
                $('#modalExcPenglain').modal('hide');
                reload_tglBatch()
                tabelTPP();
            }
        });
    }

    function tpp_tahap2(){
        var thbltpp = $('#thbltpp').val();
        swal({
          title: "Peringatan",
          text: "Apakah data kinerja PTT untuk tahun bulan "+thbltpp+" sudah anda update ?",
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
                // cek_thbl_tpp(thbltpp);
                exc_tpp_2(thbltpp);
          } else {
                swal("Gagal", "Gagal Eksekusi TPP Tahap 2 untuk Tahun Bulan "+thbltpp, "error");
          }
        });

    }

    function exc_tpp_2(thbltpp){
        $.ajax({
            url: '<?php echo base_url("index.php/admin/batch/execute_tpp2") ?>',
            type: "post",
            data: {thbltpp:thbltpp},
            dataType: "JSON",
            beforeSend: function(){
                $('#modalExcPenglain').modal('show');
            },
            success: function(data){
                if(data.respone=='sukses'){
                    swal("Sukses", "Berhasil Eksekusi TPP Tahap 2 dengan Tahun Bulan "+thbltpp, "success");
                    $('#modalExcPenglain').modal('hide');
                    reload_tglBatch()
                    tabelTPP();
                }else{
                    swal("Peringatan", "Data untuk Tahun Bulan "+thbltpp+" sudah ada ", "warning");
                    
                }
                
            },
            complete: function(){
                
            },
            error: function (xhr, status, err) {                       
                var str = xhr.responseText;
                alert(str);
                $('#modalExcPenglain').modal('hide');
                reload_tglBatch()
                tabelTPP();
            }
        });    
    }

    // cetak file gaji PTT 
    function cetak_gajiPTT(){
        var thbl_ptt = $('#thblptt').val();
        $.ajax({
            url : '<?php echo base_url("index.php/admin/batch/cek_gj_ptt") ?>',
            type: "post",
            data: {thbl_ptt:thbl_ptt},
            dataType: "JSON",
            
            success : function(data){
                // alert(data.respone);
                if(data.respone=='sukses'){
                    // alert("sukses");
                    //cetak_gajiTXT2(tgl_batch3);
                    window.open('index.php/admin/Batch/printGAJI_ptt');
                    // reload_tglBatch();
                }else{
                    swal("Gagal", "Data Gaji untuk Tanggal Batch "+thbl_ptt+" belum ada ", "error");
                    // reload_tglBatch();
                }
            }
        });

    }

    function cetak_gajiTPP_PTT(){
        var thbltpp = $('#thbltpp').val();
        $.ajax({
            url : '<?php echo base_url("index.php/admin/batch/cek_TPP_PTT") ?>',
            type: "post",
            data: {thbltpp:thbltpp},
            dataType: "JSON",
            
            success : function(data){
                // alert(data.respone);
                if(data.respone=='sukses'){
                    // alert("sukses");
                    //cetak_gajiTXT2(tgl_batch3);
                    window.open('index.php/admin/Batch/print_TPP_PTT');
                    // reload_tglBatch();
                }else{
                    swal("Gagal", "Data TPP PTT untuk Tanggal Batch "+thbltpp+" belum ada ", "error");
                    // reload_tglBatch();
                }
            }
        });
    }
</script>

    



