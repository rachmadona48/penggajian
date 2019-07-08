<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="<?php echo base_url(); ?>assets/inspinia/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/chosen/chosen.jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/inspinia/js/bootstrap/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.debug.js"></script>
    <style type="text/css">
        body{
            margin: 10px 0;
        }
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
        hr{
            margin-top: 0;
            margin-bottom: 0;
        }
        .reminder-edit{
            font-style: italic;
            font-weight: 800;
            color: #c0392b;
        }
        .mce-content-body{
            word-wrap: break-word;
        }
        ul > li{
            margin: 5px 0;
        }
        .glyphicon-pencil{
            cursor: pointer;
        }
        span.res_text{
            text-decoration: underline;
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
            background-color: rgba(0,0,0, 0.9); /* Black w/opacity */
            overflow-x: hidden; /* Disable horizontal scroll */
            transition: 0.5s; /* 0.5 second transition effect to slide in or slide down the overlay (height or width, depending on reveal) */
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
    </style>
</head>
<body>
    <!-- The overlay -->
    <div id="myNav" class="overlay">

      <!-- Button to close the overlay navigation -->
      <a class="closebtn"">&times;</a>

      <!-- Overlay content -->
      <div class="overlay-content">
        <a href="#">Simpan</a>
        <!-- <a href="javascript:window.print()">Print</a> -->
        <a href="#" id="unduh">Unduh Sebagai PDF</a>
      </div>

    </div>
    <div class="container main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">PERBAL NASKAH DINAS <button class="btn btn-success pull-right"><span class="glyphicon glyphicon-menu-hamburger"></span></button></h3><br/>
                <hr style="border-top: 2.7px solid #000" />
                <div class="col-md-6">
                    <h5>DIISI OLEH UNIT/SUB UNIT/CTU PENGONSEP</h5>
                </div>
                <div class="col-md-6">
                    <h5>DIISI OLEH BIRO UMUM/BAGIAN UMUM SETKODYA/ITU</h5>
                </div>
                <div class="col-md-12" style="border-top: 1px solid #000">
                    <!-- Left Side -->
                    <div class="col-md-6" style="margin-top: 10px">
                        <div class="row">
                            <div class="col-md-1 left-side">
                            </div>
                            <div class="col-md-11">
                                Dikerjakan Oleh :
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-11 col-md-offset-1 editable">
                                <span class="reminder-edit">
                                    Edit ini
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1 left-side">
                            </div>
                            <div class="col-md-11">
                                Diperiksa Oleh :
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-11 col-md-offset-1 editable">
                                <span class="reminder-edit">
                                    Edit ini
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1 left-side">
                            </div>
                            <div class="col-md-11">
                                Diedarkan Oleh :
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-11 col-md-offset-1 editable">
                                <span class="reminder-edit">
                                    Edit ini
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1 left-side">
                            </div>
                            <div class="col-md-11">
                                Net telah disetujui oleh Unit / Sub Unit/CTU Pengonsep :
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-11 col-md-offset-1 editable">
                                <span class="reminder-edit">
                                    Edit ini
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side -->
                    <div class="col-md-6" style="margin-top: 10px">
                        <div class="row">
                            <div class="col-md-1 right-side">
                            </div>
                            <div class="col-md-11">
                                Diterima di Pengendali Surat :
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-11 col-md-offset-1 editable">
                                <span class="reminder-edit">
                                    Edit ini
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1 right-side">
                            </div>
                            <div class="col-md-11">
                                Dinomori oleh :
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-11 col-md-offset-1 editable">
                                <span class="reminder-edit">
                                    Edit ini
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1 right-side">
                            </div>
                            <div class="col-md-11">
                                Diketik oleh :
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-11 col-md-offset-1 editable">
                                <span class="reminder-edit">
                                    Edit ini
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1 right-side">
                            </div>
                            <div class="col-md-11">
                                Ditaklik oleh :
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-11 col-md-offset-1 editable">
                                <span class="reminder-edit">
                                    Edit ini
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1 right-side">
                            </div>
                            <div class="col-md-11">
                                Diterima oleh Pengirim surat :
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-11 col-md-offset-1 editable">
                                <span class="reminder-edit">
                                    Edit ini
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1 right-side">
                            </div>
                            <div class="col-md-11">
                                Dikirim oleh :
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-11 col-md-offset-1 editable">
                                <span class="reminder-edit">
                                    Edit ini
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1 right-side">
                            </div>
                            <div class="col-md-11">
                                Perbal dan pertinggal disimpan Oleh :
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-11 col-md-offset-1 editable">
                                <span class="reminder-edit">
                                    Edit ini
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="border-top: 1px solid #000;">
                            <span class="col-md-6" style="text-align:right; margin-top: 20px; margin-bottom: 20px">Dimajukan pada tanggal</span>
                            <span class="col-md-1 editable reminder-edit" style="margin-top: 20px; margin-bottom: 20px">
                                Edit ini
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="border-top: 2px solid #000">
                            <div style="margin-top: 10px">
                                Hal / Judul / Naskah Dinas : <br/>
                                    <div class="reminder-edit editable">
                                        Edit ini
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="border-top: 2px solid #000">
                            <div style="margin-top: 10px">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-2">
                                                Nomor
                                            </div>
                                            <div class="col-md-1">:</div>
                                            <div class="col-md-9">
                                                <span class="editable reminder-edit">
                                                    Edit ini
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                Sifat
                                            </div>
                                            <div class="col-md-1">:</div>
                                            <div class="col-md-9">
                                                <span class="editable reminder-edit">
                                                    Edit ini
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                Lampiran
                                            </div>
                                            <div class="col-md-1">:</div>
                                            <div class="col-md-9">
                                                <span class="editable reminder-edit">
                                                    Edit ini
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-md-offset-2">
                                        <div class="row">
                                            <div class="col-md-2 text-center">
                                                Jakarta,
                                            </div>
                                            <div class="col-md-10">
                                                <span class="editable reminder-edit" style="text-align: left">
                                                    Edit ini
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 30px">
                        <div class="col-md-4 col-md-offset-8">
                            <div class="text-center">
                                KEPUTUSAN<br/>
                                GUBERNUR PROVINSI DAERAH KHUSUS<br/>
                                IBUKOTA JAKARTA
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div style="margin-top: 30px">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                Pemaraf Serta :
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 5px">
                                            <!-- default select -->
                                            <select class="hidden" id="default_select"><option selected disabled>Pilih Pemaraf</option></select>
                                            <!-- end of default select -->
                                            <ul id="pemaraf_serta_wrapper">
                                                <li id="pemaraf1">
                                                    <select><option selected disabled>Pilih Pemaraf</option></select>
                                                    <button style="margin-left:5px" class="btn btn-default addButton">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-md-offset-2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                Tembusan :
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 5px">
                                            <ol>
                                                <li>Gubernur Provinsi DKI Jakarta</li>
                                                <li>Ka. Kanreg V BKN</li>
                                                <li>Sekda Provinsi DKI Jakarta</li>
                                                <li>Inspektur Provinsi DKI Jakarta</li>
                                                <li>Ka. BPKD Provinsi DKI Jakarta</li>
                                                <li>Ka. Dinas <span id="ka_dinas_text">.... </span>&nbsp;<span class="glyphicon glyphicon-pencil"></span> Provinsi DKI Jakarta</li>
                                                <li>Ka. Biro Umum Setda Provinsi DKI Jakarta</li>
                                                <li>Dir <span id="dir_text">.... </span>&nbsp;<span class="glyphicon glyphicon-pencil"></span> Prov. DKI Jakarta</li>
                                                <li>Ka. Sudin <span id="ka_sudin_text">.... </span>&nbsp;<span class="glyphicon glyphicon-pencil"></span> Kota Adm. Jakarta</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 60px">
                        <div class="col-md-4 text-center">
                            a.n GUBERNUR PROVINSI DAERAH KHUSUS<br/>
                            IBUKOTA JAKARTA<br/>
                            KEPALA BADAN KEPEGAWAIAN DAERAH,
                            <div style="margin-top: 65px">
                                SURADIKA <br/>
                                NIP 196208211993031002
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Small modal -->
    <div class="modal fade small-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <input type="hidden" name="id_tembusan">
                <select class='form-control chosen-jenis' style='width: 80px' name='tembusan_select' id='tembusan_select' data-placeholder='Pilih Data'>
                    <?php echo $klogad ?>
                </select>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/tinymce/tinymce.min.js') ?>"></script>
    <script type="text/javascript">
        //tinymce start
        tinymce.init({
            selector: '.editable',
            inline: true,
            toolbar: 'undo redo',
            menubar: false
        });
        //tinymce end

        var left_side = 0;
        $('.left-side').each(function(){
            $(this).text(parseInt(++left_side));
        })
        var right_side = 0;
        $('.right-side').each(function(){
            $(this).text(parseInt(++right_side));
        })

        $('.reminder-edit').dblclick(function(){
            $(this).css({
                'font-style': 'normal',
                'font-weight': 'normal',
                'color': '#000000'
            });
        })

        var value = ['Sekretaris BKD', 'Ka. Biro Hukum', 'Ka. Biro Umum'];
        $(value).each(function(index, item){
            $('select').append('<option value='+ item +'>' + item + '</option>')
        })

        $('.addButton').on('click', function(){
            if($('#pemaraf_serta_wrapper > li').length == 5)
                return false;
            var pemaraf_length = $('#pemaraf_serta_wrapper > li').length;
            var intId = parseInt(pemaraf_length) + 1;
            var fieldWrapper = $('<li id=\'pemaraf' + parseInt(intId) + '\'>');
            var select_pemaraf = $('#default_select').clone().removeClass('hidden');
            // var select_pemaraf = '<select><option selected disabled>Pilih Pemaraf</option></select> ';
            var removeButton = $('<button style="margin-left:9px" class="btn btn-default addButton"><span class="glyphicon glyphicon-minus"></span></button>');
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

        $('.glyphicon-pencil').on('click',function(){
            var id_tembusan = $(this).prev().attr('id');
            $('input[name=id_tembusan]').val(id_tembusan);
            $('.small-modal').modal('show');
        });

        $('#tembusan_select').on('change',function(){
            var id_tembusan = $('input[name=id_tembusan]').val();
            var result = '<span class="res_text">' + $('#tembusan_select_chosen > a > span').text() + '</span>';
            $('#'+id_tembusan).html(result);
            $('.small-modal').modal('hide');
            $('#tembusan_select').val('').trigger('chosen:updated');
        })

        $("#tembusan_select").chosen({
            no_results_text: "Oops, Data Tidak Ditemukan!",
            width: "100%"
        });

        $('.btn-success').click(function(){
            $('#myNav').css('height','100%')
        })

        $('.closebtn').click(function(){
            $('#myNav').css('height','0%')  
        })

        $('#unduh').click(function(){
            var doc = new jsPDF();
            doc.fromHTML($('#main-wrapper').get(0), 15, 15, {
                'width': 170,'elementHandlers': specialElementHandlers
            });
            doc.output('sample-file.pdf');
        })

    </script>
</body>
</html>