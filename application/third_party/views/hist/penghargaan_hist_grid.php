<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Penghargaan History</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">hist</a>
            </li>
            <li class="active">
                <strong>Penghargaan_hist</strong>
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
					 <button class="btn btn-success pull-right" onclick="add_penghargaanhist()"><i class="glyphicon glyphicon-plus"></i> Tambah Penghargaan History</button>
				</div>
            	<div>
              <div class="clearfix"></div>
                <div class="table-responsive">
		            <table id="employee-grid" class="table table-striped table-bordered table-hover dt-responsive nowrap dataTables-example" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
							<thead>
								<tr>
									<th>NRK</th>
									<th>KDHARGA</th>									
									<th>TGSK</th>
                  <th>NOSK</th>                 
                  <th>ASAL_HRG</th>
                  <th>JNASAL</th>
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

<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Form Penghargaan History</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
      
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">NRK</label>
              <div class="input-group col-sm-4">
                <input type="text" id="nrk" name="nrk" placeholder="NRK" value="<?php echo isset($NRK) ? $NRK : ""; ?>" class="form-control"> 
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">KDHARGA</label>
              <div class="input-group col-sm-4">
                 <!--<input type="text" id="kdharga" name="kdharga" placeholder="KDHARGA" value="<?php echo isset($KDHARGA) ? $KDHARGA : ""; ?>" class="form-control">-->
              
                  <select class="" name="kdharga" id="kdharga" tabindex="2" placeholder="KDHARGA">
                    <option></option>
                  </select>
              </div>
            </div>
            <div class="form-group" id="data_1">
              <label class="control-label col-md-3">TGSK</label>
                <div class="input-group col-sm-4 date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" id="tgsk" name="tgsk" placeholder="TGSK" value="<?php echo isset($TGSK) ? date('d-m-Y', strtotime($TGSK)) : ""; ?>" class="form-control">
               </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">NOSK</label>
              <div class="input-group col-sm-4">
                 <input type="text" id="nosk" name="nosk" placeholder="NOSK" value="<?php echo isset($NOSK) ? $NOSK : ""; ?>" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">ASAL_HRG</label>
              <div class="input-group col-sm-4">
                 <input type="text" id="asal_hrg" name="asal_hrg" placeholder="ASAL_HRG" value="<?php echo isset($ASAL_HRG) ? $ASAL_HRG : ""; ?>" class="form-control">
              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-md-3">JNASAL</label>
              <div class="input-group col-sm-4">
                 <input type="text" id="jnasal" name="jnasal" placeholder="JNASAL" value="<?php echo isset($JNASAL) ? $JNASAL : ""; ?>" class="form-control">
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

        $(".select2_kdharga").select2({
                  placeholder: "Pilih Kode Penghargaan"                    
              }); 

				var dataTable = $('#employee-grid').DataTable( {
					"aoColumns": [
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
						url :"<?php echo base_url(); ?>index.php/hist/penghargaan_hist/data", // json datasource
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
				
			} );

	function add_penghargaanhist()
  	{

        $.ajax({
          url: "<?php echo base_url(); ?>index.php/hist/Penghargaan_hist/getKdharga",
          type: "post",
          dataType: 'json',
          beforeSend: function() {                                                        
              $('#kdharga').hide();
          },
                        
          success: function(data) {
              $('#kdharga').show();
              if(data.response == 'SUKSES'){
                  $('#kdharga').html(data.listKdharga);
              }else{
                  $('#kdharga').html('');
              }
              $(".select2_kdharga").select2({
                  placeholder: "Pilih Kode Penghargaan"                    
              });
          },
                        
          error: function(xhr) {                              
              alert("Terjadi kesalahan. Silahkan coba kembali");
                  $('#kdharga').hide();
          },
                        
          complete: function() {
              $('#kdharga').show();
          }
      });

      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Penghargaan History'); // Set Title to Bootstrap modal title
  	}

  function save()
  {
      var url;
      if(save_method == 'add') 
      {
          url = "<?php echo site_url('hist/penghargaan_hist/ajax_add')?>";
      }
      else
      {
        url = "<?php echo site_url('hist/penghargaan_hist/ajax_update')?>";
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

  function edit_penghargaanhist(id1,id2)
  {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('hist/penghargaan_hist/ajax_edit')?>/"+id1+'/'+id2,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="nrk"]').val(data.NRK);
            $('[name="kdharga"]').val(data.KDHARGA);
            $('[name="tgsk"]').val(data.conv);
            $('[name="nosk"]').val(data.NOSK);
            $('[name="asal_hrg"]').val(data.ASAL_HRG);
            $('[name="jnasal"]').val(data.JNASAL);            
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Penghargaan History'); // Set title to Bootstrap modal title
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
		});

      $.ajax({
          url: "<?php echo base_url(); ?>index.php/hist/Penghargaan_hist/getKdharga",
          type: "post",
          dataType: 'json',
          beforeSend: function() {                                                        
              $('#kdharga').hide();
          },
                        
          success: function(data) {
              $('#kdharga').show();
              if(data.response == 'SUKSES'){
                  $('#kdharga').html(data.listKdharga);
              }else{
                  $('#kdharga').html('');
              }
              $(".select2_kdharga").select2({
                  placeholder: "Pilih Kode Penghargaan"                    
              });
          },
                        
          error: function(xhr) {                              
              alert("Terjadi kesalahan. Silahkan coba kembali");
                  $('#kdharga').hide();
          },
                        
          complete: function() {
              $('#kdharga').show();
          }
      });
  }

  function delete_penghargaanhist(id1,id2)
  {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('hist/penghargaan_hist/ajax_delete')?>/"+id1+'/'+id2,
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


