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

</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Pengaturan Menu</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li class="active">
                <strong>Menu</strong>
            </li>
        </ol>
    </div>
</div>

<!-- START WRAPPER CONTENT -->
<div class="wrapper wrapper-content animated fadeInRight">        
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <span class="pull-right"> <button class="btn btn-primary btn-sm" onclick="return simpanPerubahanMenu()" id="simpanperubahan"><i class="fa fa-save"></i>&nbsp; Simpan Perubahan</button> </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <span class="pull-right"> <button class="btn btn-primary btn-xs" onclick="return setValueModal('insert','-');" data-toggle="modal" data-target="#addMenu">+ Tambah</button> </span>
                        <h4>Menu Baru</h4>
                    </div>
                    <div class="ibox-content">
                        <div class="dd" id="nestable">
                            <ol class="dd-list" id="menubaru">
                                <?php echo $menubaru; ?>
                            </ol>
                        </div>
                        <div class="m-t-md" style="display:none;">
                            <h5>Serialised Output</h5>
                        </div>
                        <textarea id="nestable-output" class="form-control" style="display:none;"></textarea>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Menu Aktif</h5>
                    </div>
                    <div class="ibox-content">                        
                        <div class="dd" id="nestable22">
                            <ol class="dd-list" id="menuaktif">
                                <!-- <li class="dd-item" data-id="1">
                                    <div class="dd-handle">1 - Lorem ipsum</div>                                    
                                </li> -->
                                <?php echo $menuaktif; ?>
                            </ol>
                        </div>
                        <div class="m-t-md" style="display:none;">
                            <h5>Serialised Output</h5>
                        </div>
                        <textarea id="nestable2-output" class="form-control" style="display:none;"></textarea>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Menu Tidak Aktif</h5>
                    </div>
                    <div class="ibox-content">                        
                        <div class="dd" id="nestable3">
                            <ol class="dd-list" id="menunonaktif">
                                <?php echo $menunonaktif; ?>
                            </ol>
                        </div>
                        <div class="m-t-md" style="display:none;">
                            <h5>Serialised Output</h5>
                        </div>
                        <textarea id="nestable3-output" class="form-control" style="display:none;"></textarea>

                    </div>
                </div>
            </div>
            
            <!--Start Modal Add Menu-->
            <div class="modal inmodal" id="addMenu" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content animated bounceIn">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h3 id="title"><u>Tambah Menu Baru</u></h3>
                        </div>
                        <div class="modal-body">
                            <div class="ibox float-e-margins">                                
                                <div class="ibox-content">
                                    <form id="formAddMenu" class="form-horizontal" method="POST">
                                        <input type="hidden" name="action" id="action" class="form-control">
                                        <input type="hidden" name="id_menu" id="id_menu" class="form-control">                                        
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Jenis Menu</label>                    
                                            <div class="col-lg-9">                          
                                               <!-- <div class="i-checks inline"><label> <input type="radio" id="jenis_menu" name="jenis_menu"  value="0"> <i></i> Menu Outer </label></div><br/>-->
                                               <!-- <div class="i-checks inline"><label> <input type="radio" id="jenis_menu" name="jenis_menu"  value="1"> <i></i> Menu Inner </label></div>-->
                                                <div class="i-checks inline"><label> <input type="radio" name="jenis_menu" id="jenis_menu1" value="0" <?php if(isset($infoMenu->JENIS)){ if($infoMenu->JENIS == 0){echo "checked"; }}?>> Menu Outer </label></div>&nbsp;&nbsp;&nbsp;
                                                <div class="i-checks inline"><label> <input type="radio" name="jenis_menu" id="jenis_menu2"  value="1" <?php if(isset($infoMenu->JENIS)){ if($infoMenu->JENIS == 1){echo "checked"; }}?>> Menu Inner </label></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Nama</label>
                                            <div class="col-lg-9">
                                                <input type="text" placeholder="Nama Menu" name="nama_menu" id="nama_menu" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Link</label>
                                            <div class="col-lg-9">
                                                <input type="text" placeholder="Link Menu" name="link_menu" id="link_menu" class="form-control">
                                                <!-- <span class="help-block m-b-none">Cth : admin/dashboard/</span> -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Alias</label>
                                            <div class="col-lg-9">
                                                <input type="text" placeholder="Alias Menu" name="alias_menu" id="alias_menu" class="form-control">
                                                <span class="help-block m-b-none">Alias menu harus huruf kecil dan tanpa spasi</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-offset-3 col-lg-9">
                                                <span class="pull-right"><button class="btn btn-sm btn-primary" type="submit">Simpan</button></span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>                            
                        </div>
                    </div>
                </div>
            </div>            
            <!-- End Modal Add Menu -->

        </div>        
        
</div>
<!-- END WRAPPER CONTENT -->
    
    <!-- Mainly scripts -->
    <script src="<?php echo base_url() ?>assets/inspinia/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url() ?>assets/inspinia/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url() ?>assets/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Nestable List -->
    <script src="<?php echo base_url() ?>assets/inspinia/js/plugins/nestable/jquery.nestable.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url() ?>assets/inspinia/js/inspinia.js"></script>
    <script src="<?php echo base_url() ?>assets/inspinia/js/plugins/pace/pace.min.js"></script>

    <!-- Validation -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/boostrapvalidator/js/bootstrapValidator.js"></script>    
    <!-- Validation -->

    <script>
        function setValueModal(action,id){
            $("#action").val(action);
            if(action == 'update'){
                $("#title").html('Edit Menu');
            }else{
                $("#title").html('Tambah Menu Baru');
            }   

            if(id == '-'){ //insert
                
                document.getElementById('formAddMenu').reset;

            }else{ //update
                
                $("#id_menu").val(id);

                //get info menu
                $.ajax({
                    url: "<?php echo $linkgetmenu; ?>",
                    type: "post",
                    data: {id_menu : id},
                    dataType: 'json',
                    beforeSend: function() {                            
                        // blocklayar();
                    },
                    success: function(data) {                    
                        if(data.response == 'SUKSES'){
                            //$("#jenis_menu").val(data.jenis_menu);
                            ;
                            $("input[name='jenis_menu'][value='"+data.jenis_menu+"']").prop("checked",true);
                            //console.log(data.nama_menu);
                            $("#nama_menu").val(data.nama_menu);
                            $("#link_menu").val(data.link_menu);
                            $("#alias_menu").val(data.alias);
                        }else{
                            alert('Menu Tidak Ditemukan.')
                        }
                    },
                    error: function(xhr) {  
                        // unblocklayar();  
                        alert("Terjadi kesalahan. Silahkan coba kembali");

                    },
                    complete: function() {
                        // unblocklayar();  
                    }
                });

            }
            
        }

        function simpanPerubahanMenu(){
            $.ajax({
                url: "<?php echo $linkaction2; ?>",
                type: "post",
                data: {menu_baru : $('#nestable-output').val(), aktif_list : $('#nestable2-output').val(), non_aktif_list : $('#nestable3-output').val()},
                dataType: 'json',
                beforeSend: function() {                            
                    // blocklayar();
                },
                success: function(data) {                    
                    location.reload(); 
                },
                error: function(xhr) {  
                    // unblocklayar();  
                    alert("Terjadi kesalahan. Silahkan coba kembali");

                },
                complete: function() {
                    // unblocklayar();  
                }
            });
        }

        function hapusMenu(id,nama){
            $.ajax({
                url: "<?php echo $linkdelmenu; ?>",
                type: "post",
                data: {id_menu : id},
                dataType: 'json',
                beforeSend: function() {                            
                    var ask = confirm("Anda yakin ingin menghapus menu '"+nama+"'? ");
                    if (ask == true) {

                    }else{
                        return false;
                    }
                },
                success: function(data) {                    
                    if(data.response == 'SUKSES'){
                        document.getElementById(''+id).style.display="none";
                        // $('ol#'+id+'').remove();                        
                    }else{
                        alert("Menu tidak dapat dihapus. Silahkan coba kembali.");
                    }
                },
                error: function(xhr) {  
                    // unblocklayar();  
                    alert("Terjadi kesalahan. Silahkan coba kembali");

                },
                complete: function() {
                    // unblocklayar();  
                }
            });
        }

         $(document).ready(function(){

             var updateOutput = function (e) {
                 var list = e.length ? e : $(e.target),
                         output = list.data('output');
                 if (window.JSON) {
                     output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));                     
                 } else {
                     output.val('JSON browser support required for this demo.');
                 }                 
             };             

             // activate Nestable for list active menus
             $('#nestable').nestable({
                 group: 1
             }).on('change', updateOutput);

             // activate Nestable for list deactive menus
             $('#nestable22').nestable({
                 group: 1
             }).on('change', updateOutput);

             // activate Nestable for list new menus
             $('#nestable3').nestable({
                 group: 1,
                 maxDepth: 1
             }).on('change', updateOutput);

             // output initial serialised data             
             updateOutput($('#nestable').data('output', $('#nestable-output')));
             updateOutput($('#nestable22').data('output', $('#nestable2-output')));
             updateOutput($('#nestable3').data('output', $('#nestable3-output')));

             $('#nestable-menu').on('click', function (e) {
                 var target = $(e.target),
                         action = target.data('action');
                 if (action === 'expand-all') {
                     $('.dd').nestable('expandAll');
                 }
                 if (action === 'collapse-all') {
                     $('.dd').nestable('collapseAll');
                 }
             });
         });
    </script>    

    <script type="text/javascript">
                        
        $(function() {
            $("#formAddMenu").on("submit", function(event) {
                event.preventDefault();

                $.ajax({
                    url: "<?php echo $linkaction; ?>",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function() {                            
                        // blocklayar();
                    },
                    success: function(data) {
                         $('#addMenu').modal('hide');

                        if(data.hasil != ''){
                             if(data.action == 'insert'){
                                $('ol#menubaru').append('<li class="dd-item" id="'+data.hasil+'" data-id="'+data.hasil+'"><span class="pull-right"> <button class="btn btn-success btn-xs" onclick="return setValueModal(\'update\',\''+data.hasil+'\');" data-toggle="modal" data-target="#addMenu"><i class="fa fa-pencil"></i></button> </span><div class="dd-handle">'+data.hasil+' - '+$("#nama_menu").val()+'</div></li>');
                             }else{
                                // $('#'+data.hasil+'').remove();                                                                
                                $('div#item_'+data.hasil).html(data.hasil+' - '+$('#nama_menu').val());
                             }
                        }
                        
                    },
                    error: function(xhr) {  
                        // unblocklayar();  
                        alert("Terjadi kesalahan. Silahkan coba kembali");

                    },
                    complete: function() {
                        // unblocklayar();  
                    }
                });
            });
        });                

    </script>

    



