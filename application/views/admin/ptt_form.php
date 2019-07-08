<!--<link rel="stylesheet" href="--><?php //echo base_url()?><!--/assets/js/plugins/formValidation/css/formValidation.min.css">-->
<link href="<?php echo base_url()?>assets/inspinia/css/plugins/steps/jquery.steps.css" rel="stylesheet">
<link href="<?php echo base_url()?>assets/inspinia/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
<link href="<?php echo base_url()?>assets/inspinia/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Profile</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php site_url('master_ptt');?>">Home</a>
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
                    <h5>Form PTT</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form  id="formPtt" name="formPtt" action="<?php echo $linkaction ?>" method="post" enctype="multipart/form-data">
                        
                        <div class="row" style="padding:10px">
                            <!--                                        kolom1-->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nptt">NPTT </label>
                                    <input type="text" id="nptt" name="nptt" placeholder="Nomor PTT" value="<?php echo isset($nptt) ? $nptt : ""; ?>" class="form-control" 
                                     maxlength="6" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="nama">NAMA </label>
                                    <input type="text" id="nama" name="nama" placeholder="Nama PTT" value="<?php echo isset($nama) ? $nama : ""; ?>" class="form-control" 
                                     maxlength="6" readonly>
                                </div>

                                <div class="form-group" id="data_89" >
                                    <label for="tgllahir">TGL LAHIR</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgllahir" name="tgllahir" placeholder="dd-mm-yyyy" value="<?php echo isset($tgllahir) ? date('d-m-Y', strtotime($tgllahir)) : ""; ?>" class="form-control" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="nama">JABATAN</label>
                                    <input type="text" id="jabat" name="jabat" placeholder="Jabatan" value="<?php echo isset($jabat) ? $jabat : ""; ?>" class="form-control" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                    
                                </div>


                            </div>
                            <!--                                    kolom 2-->
                            <div class="col-lg-6">
                                
                                <div class="form-group">
                                    <label for="stapeg">SPMU</label>
                                    <select class="form-control select2_demo_3" name="spmu" id="spmu" style="width:99%" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                        <option></option>
                                        <?php echo $list_spmu; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="stapeg">LOKASI KERJA</label>
                                    <select class="form-control select2_demo_3" name="klog" id="klog" style="width:99%" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                        <option></option>
                                        <?php echo $list_lokasi; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="nama">GAJI</label> 
                                    <input type="text" id="gti" name="gti" placeholder="GTI" value="<?php echo isset($gti) ? $gti : ""; ?>" class="form-control" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>

                                <div class="form-group">
                                    <label for="nama">KODEL</label>
                                    <input type="text" id="kodel" name="kodel" placeholder="Kodel" value="<?php echo isset($kodel) ? $kodel : ""; ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="nama">STATUS</label>
                                    <input type="text" id="status" name="status" placeholder="Status" value="<?php echo isset($status) ? $status : ""; ?>" class="form-control">
                                </div>


                                <div class="form-group">
                                    <button class="btn btn-primary pull-right">Ubah</button>
                                </div>

                            </div>
                        </div>

                        
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



    $(document).ready(function(){
        
        $("#formPtt").validate({
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
                tgllahir: "required",
                jabat: "required"

            },
            messages: {
                tgllahir: {
                    required: " Harus diisi"
                },
                jabat: {
                    required: " Harus diisi"
                }

            }
        });

        <?php
            if ($this->session->flashdata('msg') != ''){
        ?>
                swal("Sukses!", "Data PTT berhasil disimpan.", "success");
                alert('berhasil');
        <?php
            }
        ?>


        
      

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


        $('.select2_prop').on('select2:select', function (evt) {
            $('.select2_kowil').val('');
            $('.select2_kocam').val('');
            $('.select2_kokel').val('');
            $('.select2_kowil').trigger('change.select2');
            $('.select2_kocam').trigger('change.select2');
            $('.select2_kokel').trigger('change.select2');
            // alert(1);
        });

        

              
        

    });

    

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
