    <?php if($user_group == 8) { ?>
    <style type="text/css">

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
    <?php if($user_group == 8){ ?>

    <!-- START WELLCOME -->
    <div class="row">    
        <div class="col-md-12">
            <div class="ibox animated fadeInLeft">
                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-12">

                            <!-- form: -->
                            <input type="hidden" id="ref_permohonan" name="ref_permohonan" value="<?php echo $ref_permohonan;?>">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="col-md-3">
                                            <label for="jenis">Jenis Permohonan</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select class='form-control chosen-jenis' name='jenis_permohonan' id='jenis_permohonan' data-placeholder='Cari Berdasarkan...'>
                                                <option value="" selected disabled>Pilih Jenis Permohonan</option>
                                                <?php foreach($jenis_permohonan->result() as $row): ?>
                                                    <option id="<?php echo $row->ID_JENIS_PERMOHONAN ?>" value="<?php echo $row->ID_JENIS_PERMOHONAN ?>"><?php echo $row->KET_JENIS_PERMOHONAN ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <table id="tbl-grid3" class="table table-striped table-bordered table-hover dataTables-example" >
                                     <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id_Trx_SKPD</th>
                                            <th>NRK</th>
                                            <th>No Surat</th>
                                            <th>Tgl Surat</th>
                                            <th>Aksi</th>
                                            <th>Valid</th>
                                        </tr>
                                     </thead>

                                     <tbody>
                                            <div id="daftar_pegawai"></div>                     
                                     </tbody>
                               </table>
                                <form class="form-horizontal" id="defaultForm" method="post">
                                    <!-- <input type="hidden" id="nrk_post" name="nrk_post"> -->
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="col-md-3">
                                                <label for="tgl_surat">Tanggal Surat</label>
                                            </div>
                                            <div class="col-md-9 pickerpicker" id="data_2">
                                                <div class="input-group col-sm-7 date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgl_surat" name="tgl_surat" placeholder="Tgl. Surat" class="form-control" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="col-md-3">
                                                <label for="no_surat_bh">No Surat Biro Hukum</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="no_surat_bh" id="no_surat_bh" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                        <button class="btn btn-success btn-block" id="btn_forward">Forward</button>
                                        </div>
                                    </div>
                                </form>
                            </div> <!--end div row -->
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
    
    <!-- Modal -->
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
                        <label for="no_surat_permohonan">No Surat Permohonan</label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" type="text" name="no_surat_permohonan" id="no_surat_permohonan" disabled="true">
                    </div>
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
                        <input class="form-control" type="text" name="nama_pegawai" id="nama_pegawai" disabled="true">
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

        

        <script type="text/javascript">

        $(document).ready(function(){
            $('#tbl-grid3').hide();
            $('#table_persyaratan').hide();
            $('#defaultForm').hide();
            $('#btn_forward').prop('disabled',true);

            $('#jenis_permohonan').change(function(e){
                e.preventDefault();
                var jns_prm = $('#jenis_permohonan').val();
                //console.log(jns_prm)
                if(jns_prm != null){
                    $('#tbl-grid3').show();
                    getdatapermohonan(jns_prm);
                }
                $('#defaultForm').show();
                // check_box();
            });

            // $('#test_btn').click(function(e){
            //     tes();
            // })

            $("#tbl-grid3").on('click','#table_nrk, #table_no_surat_skpd, #table_tgl_surat_skpd',function(e){
            // $('#tbl-grid3').click(function(e)){
                e.preventDefault();
               // tes();
            });

            $('#btn_simpan').click(function(e){
                e.preventDefault();
            })

            $('#btn_valid').click(function(e){
                e.preventDefault();
                alert('Are you fckin sure mate!?');
                // $('#tbl-grid3').find('tr').each (function() {
                    // insert_data(id_trx_skpd_post);
                    // console.log($('#id_trx_skpd').text());
                    var id_trx_subbid_post = $(this).closest('tr').children('td span #id_trx_subbid').text();
                    // insert_data(id_trx_skpd_post);
                // });
            })

            /*$('#btn_forward').click(function(e){
                e.preventDefault();
                $('#tbl-grid3').find('td:last').after('<td style="display:none" id="test">Test</td>');
                var jns_prm = $('#jenis_permohonan').val();
                var no_surat_tu = $('#no_surat_tu').val();
                // console.log(jns_prm + ' ' + no_surat_tu);
                console.log($('#test').text());
                $('#tbl-grid3').find('tr').each (function() {
                    insert_data(id_trx_skpd_post);
                    // console.log($('#id_trx_skpd').text());
                    var id_trx_skpd_post = $('#id_trx_skpd').text();
                    // insert_data(id_trx_skpd_post);
                });
            })*/

            $('#tgl_surat').change(function(){
                var no_surat_post = $('#no_surat_bh').val();
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

            $('#no_surat_bh').on('keyup', function(){
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
                // var sel = $('input[type=checkbox]:checked').map(function(_, el) {
                //     return $(el).val();
                // }).get();
                // console.log(sel);
                // $('#tbl-grid3').find('td:last').after('<td style="display:none" id="test">Test</td>');
                var tgl_surat = $('#tgl_surat').val();
                var no_surat_bh = $('#no_surat_bh').val();
                // console.log()
                if(tgl_surat !="" && no_surat_bh !="")
                {
                    window.open("http://simpegdev.jakarta.go.id/birohukum/", "_self");
                    insert_data();    
                }
                else
                {
                    alert('Tgl Surat dan No Surat harus diisi');
                }
                
            })
        });

        function tes_forward(test){
            console.log(test);
            $('#btn_forward').click(function(e){
                e.preventDefault();
                $('#tbl-grid3').find('td:last').after('<td style="display:none" id="test">Test</td>');
                var jns_prm = $('#jenis_permohonan').val();
                var no_surat_bh = $('#no_surat_bh').val();


            })
        }

        function check_box(){
            $('#valid').change(function(){
                if($(this).is(":checked")){
                    alert('This is checked');
                }
            });
        }

        function valid_yes(id_trx_skpd_post){
            $("#tbl-grid3").on('click','#valid_yes',function(e){
                e.preventDefault();
                $(this).closest("tr").children("td:eq(6)").text("Valid");
                $('#btn_forward').prop('disabled',false);
            });
        }

        function valid_no(id_trx_skpd_post){
            $("#tbl-grid3").on('click','#valid_no',function(e){
                e.preventDefault();
                update();
                $(this).closest("tr").remove();
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

        $('#data_2 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "dd-mm-yyyy",
            endDate: new Date()
        }).on('changeDate', function(e) {
        // Revalidate the date field
        $('#defaultForm2').bootstrapValidator('revalidateField', 'tgakhir');
        });


        function insert_data(){
            var ref_prm = $('#ref_permohonan').val();
            var jns_prm = $('#jenis_permohonan').val();
            var no_surat_bh_post = $('#no_surat_bh').val();
            var tgl_surat_post = $('#tgl_surat').val();
            var id_trx_subbid_post = [];
            $('input[name^=id_trx_subbid]').each(function(){
                id_trx_subbid_post.push($(this).val());
            });
            $.ajax({
                url: '<?php echo base_url("birohukum/insert")?>/',
                type: 'post',
                data: {
                    id_trx_subbid: id_trx_subbid_post, no_surat_bh: no_surat_bh_post, tgl_surat: tgl_surat_post, ref_prm: ref_prm, jns_prm:jns_prm
                },
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    window.open("http://simpegdev.jakarta.go.id/birohukum/", "_self");
                }
            })
        }

        function update()
        {
            var id_trx_subbid_post = [];
            $('input[name^=id_trx_subbid_post]').each(function(){
                id_trx_subbid_post.push($(this).val());
            });
            
            $.ajax({
                url: '<?php echo base_url("birohukum/update")?>/',
                type: 'post',
                data: {
                    id_trx_subbid: id_trx_subbid_post
                },
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    
                }
            })
        }

        function get_detail_pegawai(nrk_post){
            // console.log('Hello from pegawai');
            //var ref_prm = ('#ref_permohonan').val();
            //var jns_prm = ('#jenis_permohonan').val();
            $.ajax({
                url: '<?php echo base_url("birohukum/get_detail_pegawai")?>/',
                type: 'post',
                data: {
                    nrk: nrk_post
                },
                dataType: 'json',
                success: function(data){
                    // console.log(data.nama_kecamatan + ' ' + data.nama_wilayah + ' ' + data.nama_kelurahan);
                    //var id_trx = $('#id_trx').val(data.id_trx);
                    $('#nrk_post').val(data.nrk);
                    $('#nama_pegawai').val(data.nama);
                    var ref_prm = $('#ref_permohonan').val();
                    var jns_prm = $('#jenis_permohonan').val();
                    persyaratan(data.nrk, ref_prm, jns_prm, data.id_trx_subbid);
                }
            })
        }

        function persyaratan(nrk_post, id_ref_prm,id_jns_prm, id_trx){
            // var nrk_post = $('#nrk').val();
            // var id_permohonan_post = $('#jenis_permohonan').val();
            // console.log('nrk: ' + $('#nrk').val());
            $.ajax({
                url: '<?php echo base_url("birohukum/get_persyaratan"); ?>/',
                type: "post",
                data: {
                   NRK: nrk_post, ID_PERMOHONAN: id_ref_prm, ID_JENIS: id_jns_prm, ID_TRX_SUBBID: id_trx
                },
                dataType: 'JSON',
                success: function(data) {
                    // console.log(JSON.stringify(data.dataTable));
                    $("#list_syarat").html(data.dataTable);
                }
            });
        }

        function getdatapermohonan(jns_prm){
            var spinner = '<div class="sk-spinner sk-spinner-three-bounce animated fadeInDown"><div class="sk-bounce1"></div><div class="sk-bounce2"></div><div class="sk-bounce3"></div><div class="sk-bounce4"></div><div class="sk-bounce5"></div><div class="sk-bounce6"></div><div class="sk-bounce7"></div></div>';
            //var jeniss = $('#jenis').val();
            //var no_surat = $('#no_surat').val();
            //var tgl_surat = $('#tgl_surat').val();
            //var nrk = $('#nrk').val();
            var m = 1;

            var dtbl= $('#tbl-grid3').DataTable({
                "aoColumns": [
                    { "bSortable": false },
                    { "bSortable": false },
                    { "bSortable": false },
                    { "bSortable": false },
                    { "bSortable": false },
                    { "bSortable": false },
                    { "bSortable": false }
                    
                ],
                destroy: true,
                responsive: false,
                "scrollX": true,
                "serverSide": true,
                "ajax": {
                    url: '<?php echo base_url("index.php/birohukum/get_data_permohonan"); ?>/',
                    type: "post",
                     data: {
                        id_permohonan : m, jenis_permohonan : jns_prm
                     },
                    beforeSend: function() {                        
                        $("#daftar_pegawai").html(spinner);
                    },
                    complete: function()
                    {
                         $("#daftar_pegawai").html('');
                    }
                }
                    
            });
             $('#tbl-grid3_filter').css("display","none");//hide filtering
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
                // var nrkPegawai = $(this).closest('tr').children('td:eq(1)').text();
                // var noSurat = $(this).closest('tr').children('td:eq(2)').text();
                // var tglSurat = $(this).closest('tr').children('td:eq(3)').text();
                //alert(tgl);
                $('#nrk_pegawai').val(nrk)
                //$('#tgl_surat').val(tgl);
                $('#no_surat_permohonan').val(no);
                //console.log(nrkPegawai);
                get_detail_pegawai(nrk);
                // $('#defaultForm').show();
                $('#table_persyaratan').show();
        }
        

        function getpgwaiwip(pgw){
            $.ajax({
                url: '<?php echo base_url("index.php/skpdpermohonan/get_list_pegawai_wip"); ?>/',
                type: "post",
                data: {
                    NRK: pgw
                },
                dataType: 'JSON',
                success: function(data) {
                    $("#daftar_fix_pegawai").append(data.dataTable);
                }
            });
        }

        function getlistpermohonan(){
            $.ajax({
                url: '<?php echo base_url("index.php/skpdpermohonan/get_jenis_permohonan"); ?>/',
                type: "post",
                data: {
                    ID_PERMOHONAN: id_pmh
                },
                dataType: 'JSON',
                success: function(data) {
                    $("#daftar_fix_pegawai").append(data);
                },
                error: function(xhr) {
                    $("#daftar_fix_pegawai").append('Error');  
                },
                complete: function() {

                }
                
            });
        }

        

            

            /*START CHOSEN*/
            var config = {
                  '.chosen-jenis'           : {no_results_text:'Oops, Data Tidak Ditemukan',width: "100%"},
                                }
                for (var selector in config) {
                  $(selector).chosen(config[selector]);
                }
            /*END CHOSEN*/

            

            
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

<?php } else { redirect(base_url().'login/logout'); } ?>
