<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Alamat History</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">hist</a>
            </li>
            <li class="active">
                <strong>Alamat_hist</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
        <div class="col-lg-12">
            <div class="contact-box">
            	<div>
					 <button class="btn btn-success pull-right" onclick="add_alamathist()"><i class="glyphicon glyphicon-plus"></i> Tambah Alamat History</button>
					
				</div>
            	<div>
              <div class="clearfix"></div>
                <div class="table-responsive">
		            <table id="employee-grid" class="table table-striped table-bordered table-hover dt-responsive nowrap dataTables-example" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
							<thead>
								<tr>
									  <th>NRK</th>
									  <th>TGMULAI</th>									
									  <th>ALAMAT</th>
					           <th>RT</th>                 
					           <th>RW</th>
					           <th>WILAYAH</th>
					           <th>KECAMATAN</th>
					           <th>KELURAHAN</th>
					           <th>PROPINSI</th>
					           <th>Aksi</th>
								</tr>
							</thead>
							<thead>
								<tr>
									<th><input type="text" data-column="0"  class="search-input-text form-control"></th>
								  	<th><input type="text" data-column="1"  class="search-input-text form-control"></th>	
				                  	<th><input type="text" data-column="2"  class="search-input-text form-control"></th>
				                  	<th><input type="text" data-column="3"  class="search-input-text form-control"></th> 
				                  	<th><input type="text" data-column="4"  class="search-input-text form-control"></th> 								
									<th><input type="text" data-column="5"  class="search-input-text form-control"></th>
                  					<th><input type="text" data-column="6"  class="search-input-text form-control"></th>  
					                <th><input type="text" data-column="7"  class="search-input-text form-control"></th>
					                <th><input type="text" data-column="8"  class="search-input-text form-control"></th> 
					                <th></th>
								</tr>
							</thead>
					</table>
	            </div>
              </div>  
				<div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

		<!-- Mainly scripts -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/jquery-2.1.1.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <!-- Mainly scripts -->        

        <!-- Data Tables -->
	    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/jquery.dataTables.js"></script>
	    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.bootstrap.js"></script>
	    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.responsive.js"></script>
	    <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
	    <!-- Data Tables -->

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

        <!-- Validation -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/inspinia/boostrapvalidator/js/bootstrapValidator.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/lib-1.0.0.js"></script>    
        <!-- Validation -->
        
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {		


        $('#data_1 .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                    format: "dd-mm-yyyy"
                }); 	

         $(".select2_kowil").select2({
                  placeholder: "Pilih Kode Wilayah"                    
              });
         $(".select2_kocam").select2({
                  placeholder: "Pilih Kode Kecamatan"                    
              });
          $(".select2_kokel").select2({
                  placeholder: "Pilih Kode Kelurahan"                    
              });
           $(".select2_prop").select2({
                  placeholder: "Pilih Kode Prop"                    
              });                  
          
				var dataTable = $('#employee-grid').DataTable( {
					"aoColumns": [
								      null,
								      null,
				                      null,
				                      null,
				                      null,	
				                      null,
				                      null,
				                      null,
				                      null,							      
								      { "bSortable": false }
								    ],
					responsive: true,
					"processing": true,
					"serverSide": true,
					"language": {
							"processing": "<div></div><div></div><div></div><div></div><div></div>"
						},
					"ajax":{
						url :"<?php echo base_url(); ?>index.php/hist/alamat_hist/data", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th>No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );

				$("#employee-grid_filter").css("display","none");  // hiding global search box
				$('.search-input-text').on( 'keyup', function () {   // for text boxes
					var i =$(this).attr('data-column');  // getting column index
					var v =$(this).val();  // getting search input value
					dataTable.columns(i).search(v).draw();
				} );
				$('.search-input-select').on( 'change', function () {   // for select box
					var i =$(this).attr('data-column');  
					var v =$(this).val();  
					dataTable.columns(i).search(v).draw();
				} );			

        $(function() {
                $("#kowil").on("change", function(event) {
                    event.preventDefault();

                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/hist/alamat_hist/getKocam",
                        type: "post",
                        data: {kowil : $('#kowil').val()},
                        dataType: 'json',
                        beforeSend: function() {                                                        
                            $('select#kocam').hide();
                        },
                        success: function(data) {
                            $('select#kocam').show();
                            if(data.response == 'SUKSES'){
                                 $('#kocam').html(data.listKocam);
                            }else{
                                 $('#kocam').html('');
                            }
                        },
                        error: function(xhr) {                              
                            alert("Terjadi kesalahan. Silahkan coba kembali");
                            $('select#kocam').show();
                        },
                        complete: function() {
                            $('select#kocam').show();
                        }
                    });
                });
            });	

            $(function() {
                $("#kocam").on("change", function(event) {
                    event.preventDefault();

                    $.ajax({
                        url: "<?php echo base_url(); ?>index.php/hist/alamat_hist/getKokel",
                        type: "post",
                        data: {kowil : $('#kowil').val(),kocam : $('#kocam').val()},
                        dataType: 'json',
                        beforeSend: function() {                                                        
                            $('select#kokel').hide();
                        },
                        success: function(data) {
                            $('select#kokel').show();
                            if(data.response == 'SUKSES'){
                                 $('#kokel').html(data.listKokel);
                            }else{
                                 $('#kokel').html('');
                            }
                        },
                        error: function(xhr) {                              
                            alert("Terjadi kesalahan. Silahkan coba kembali");
                            $('select#kokel').show();
                        },
                        complete: function() {
                            $('select#kokel').show();
                        }
                    });
                });
            });				
				
			} );

	

	function add_alamathist()
  {
       $.ajax({
          url: "<?php echo base_url(); ?>index.php/hist/Alamat_hist/getKowil",
          type: "post",
          dataType: 'json',
          beforeSend: function() {                                                        
              $('#kowil').hide();
          },
                        
          success: function(data) {
              $('#kowil').show();
              if(data.response == 'SUKSES'){
                  $('#kowil').html(data.listKowil);
              }else{
                  $('#kowil').html('');
              }
              $(".select2_kowil").select2({
                  placeholder: "Pilih Kode Wilayah"                    
              });
          },
                        
          error: function(xhr) {                              
              alert("Terjadi kesalahan. Silahkan coba kembali");
                  $('#kowil').hide();
          },
                        
          complete: function() {
              $('#kowil').show();
          }
      });

      $.ajax({
          url: "<?php echo base_url(); ?>index.php/hist/Alamat_hist/getKocam",
          type: "post",
          dataType: 'json',
          beforeSend: function() {                                                        
              $('#kocam').hide();
          },
                        
          success: function(data) {
              $('#kocam').show();
              if(data.response == 'SUKSES'){
                  $('#kocam').html(data.listKocam);
              }else{
                  $('#kocam').html('');
              }
              $(".select2_kocam").select2({
                  placeholder: "Pilih Kode Kecamatan"                    
              });
          },
                        
          error: function(xhr) {                              
              alert("Terjadi kesalahan. Silahkan coba kembali");
                  $('#kocam').hide();
          },
                        
          complete: function() {
              $('#kocam').show();
          }
      });

      $.ajax({
          url: "<?php echo base_url(); ?>index.php/hist/Alamat_hist/getKokel",
          type: "post",
          dataType: 'json',
          beforeSend: function() {                                                        
              $('#kokel').hide();
          },
                        
          success: function(data) {
              $('#kokel').show();
              if(data.response == 'SUKSES'){
                  $('#kokel').html(data.listKokel);
              }else{
                  $('#kokel').html('');
              }
              $(".select2_kokel").select2({
                  placeholder: "Pilih Kode Kelurahan"                    
              });
          },
                        
          error: function(xhr) {                              
              alert("Terjadi kesalahan. Silahkan coba kembali");
                  $('#kokel').hide();
          },
                        
          complete: function() {
              $('#kokel').show();
          }
      });

      $.ajax({
          url: "<?php echo base_url(); ?>index.php/hist/Alamat_hist/getProp",
          type: "post",
          dataType: 'json',
          beforeSend: function() {                                                        
              $('#prop').hide();
          },
                        
          success: function(data) {
              $('#prop').show();
              if(data.response == 'SUKSES'){
                  $('#prop').html(data.listProp);
              }else{
                  $('#prop').html('');
              }
              $(".select2_prop").select2({
                  placeholder: "Pilih Kode Prop"                    
              });
          },
                        
          error: function(xhr) {                              
              alert("Terjadi kesalahan. Silahkan coba kembali");
                  $('#prop').hide();
          },
                        
          complete: function() {
              $('#prop').show();
          }
      });
      
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Alamat History'); // Set Title to Bootstrap modal title
  }

  function save()
  {
      var url;
      if(save_method == 'add') 
      {
          url = "<?php echo site_url('hist/alamat_hist/ajax_add')?>";
      }
      else
      {
        url = "<?php echo site_url('hist/alamat_hist/ajax_update')?>";
      }

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
  }


  function reload_table()
  {
      var dataTable = $('#employee-grid').DataTable();
      dataTable.ajax.reload(null,true); //reload datatable ajax 
  }

  function edit_alamathist(id1,id2)
  {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('hist/alamat_hist/ajax_edit')?>/"+id1+'/'+id2,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="nrk"]').val(data.NRK);
            $('[name="tgmulai"]').val(data.TGMULAI);
            $('[name="alamat"]').val(data.ALAMAT);
            $('[name="rt"]').val(data.RT);
            $('[name="rw"]').val(data.RW);
            $('[name="kowil"]').val(data.KOWIL);
            $('[name="kocam"]').val(data.KOCAM);
            $('[name="kokel"]').val(data.KOKEL);               
            $('[name="prop"]').val(data.PROP); 

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit alamat History'); // Set title to Bootstrap modal title
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
		});

      $.ajax({
          url: "<?php echo base_url(); ?>index.php/hist/Alamat_hist/getKowil",
          type: "post",
          dataType: 'json',
          beforeSend: function() {                                                        
              $('#kowil').hide();
          },
                        
          success: function(data) {
              $('#kowil').show();
              if(data.response == 'SUKSES'){
                  $('#kowil').html(data.listKowil);
              }else{
                  $('#kowil').html('');
              }
              $(".select2_kowil").select2({
                  placeholder: "Pilih Kode Wilayah"                    
              });
          },
                        
          error: function(xhr) {                              
              alert("Terjadi kesalahan. Silahkan coba kembali");
                  $('#kowil').hide();
          },
                        
          complete: function() {
              $('#kowil').show();
          }
      });

      $.ajax({
          url: "<?php echo base_url(); ?>index.php/hist/Alamat_hist/getKocam",
          type: "post",
          dataType: 'json',
          beforeSend: function() {                                                        
              $('#kocam').hide();
          },
                        
          success: function(data) {
              $('#kocam').show();
              if(data.response == 'SUKSES'){
                  $('#kocam').html(data.listKocam);
              }else{
                  $('#kocam').html('');
              }
              $(".select2_kocam").select2({
                  placeholder: "Pilih Kode Kecamatan"                    
              });
          },
                        
          error: function(xhr) {                              
              alert("Terjadi kesalahan. Silahkan coba kembali");
                  $('#kocam').hide();
          },
                        
          complete: function() {
              $('#kocam').show();
          }
      });

      $.ajax({
          url: "<?php echo base_url(); ?>index.php/hist/Alamat_hist/getKokel",
          type: "post",
          dataType: 'json',
          beforeSend: function() {                                                        
              $('#kokel').hide();
          },
                        
          success: function(data) {
              $('#kokel').show();
              if(data.response == 'SUKSES'){
                  $('#kokel').html(data.listKokel);
              }else{
                  $('#kokel').html('');
              }
              $(".select2_kokel").select2({
                  placeholder: "Pilih Kode Kelurahan"                    
              });
          },
                        
          error: function(xhr) {                              
              alert("Terjadi kesalahan. Silahkan coba kembali");
                  $('#kokel').hide();
          },
                        
          complete: function() {
              $('#kokel').show();
          }
      });

      $.ajax({
          url: "<?php echo base_url(); ?>index.php/hist/Alamat_hist/getProp",
          type: "post",
          dataType: 'json',
          beforeSend: function() {                                                        
              $('#prop').hide();
          },
                        
          success: function(data) {
              $('#prop').show();
              if(data.response == 'SUKSES'){
                  $('#prop').html(data.listProp);
              }else{
                  $('#prop').html('');
              }
              $(".select2_prop").select2({
                  placeholder: "Pilih Kode Prop"                    
              });
          },
                        
          error: function(xhr) {                              
              alert("Terjadi kesalahan. Silahkan coba kembali");
                  $('#prop').hide();
          },
                        
          complete: function() {
              $('#prop').show();
          }
      });
  }

  function delete_alamathist(id1,id2)
  {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('hist/Alamat_hist/ajax_delete')?>/"+id1+'/'+id2,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               //if success reload ajax table
               $('#modal_form').modal('hide');
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
         
      }
 }

		</script>
<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Form Alamat History</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
      
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">NRK</label>
              <div class="input-group col-sm-4">
                <input type="text" id="nrk" name="nrk" placeholder="NRK" class="form-control"> 
              </div>
            </div>
            <div class="form-group" id="data_1">
              <label class="control-label col-md-3">TGMULAI</label>
              <div class="input-group col-sm-4 date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgmulai" name="tgmulai" placeholder="TGMULAI" value="<?php echo isset($TGMULAI) ? date('d-m-Y', strtotime($TGMULAI)) : ""; ?>" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">ALAMAT</label>
              <div class="input-group col-sm-4">
                 <input type="text" id="alamat" name="alamat" placeholder="ALAMAT" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">RT</label>
              <div class="input-group col-sm-4">
                 <input type="text" id="rt" name="rt" placeholder="RT" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">RW</label>
              <div class="input-group col-sm-4">
                 <input type="text" id="rw" name="rw" placeholder="PEJTT" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">KOWIL</label>
              <div class="input-group col-sm-4">
                 <!--<input type="text" id="kowil" name="kowil" placeholder="KOWIL" class="form-control">-->
              
                 <select class="" name="kowil" id="kowil" tabindex="2" placeholder="KOWIL">
                    <option></option>
                    
                  </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">KOCAM</label>
              <div class="input-group col-sm-4">
                <!-- <input type="text" id="kocam" name="kocam" placeholder="KOCAM" class="form-control">-->
             
                  <select class="" name="kocam" id="kocam" tabindex="2" placeholder="KOCAM">
                    <option></option>
                       
                  </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">KOKEL</label>
              <div class="input-group col-sm-4">
                <!-- <input type="text" id="kokel" name="kokel" placeholder="KOKEL" class="form-control">-->
              
                  <select class="" name="kokel" id="kokel" tabindex="2" placeholder="KOKEL">
                    <option></option>
                        
                  </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">PROP</label>
              <div class="input-group col-sm-4">
                <!--  <input type="text" id="prop" name="prop" placeholder="PROP" class="form-control">-->
             
                  <select class="" name="prop" id="prop" tabindex="2" placeholder="PROP">
                    <option></option>
                        
                  </select>
              </div>
            </div>
          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

