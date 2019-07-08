<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Eselon</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Master</a>
            </li>
            <li class="active">
                <strong>Eselon</strong>
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
					<button class="btn btn-success pull-right" onclick="add_eselon_tbl()"><i class="glyphicon glyphicon-plus"></i> Tambah Eselon</button>
				</div>
            	<div>
		            <table id="employee-grid" class="table table-striped table-bordered table-hover dataTables-example" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
							<thead>
								<tr>
									<th>Eselon</th>
									<th>Neselon</th>
									<th>Cetakan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<thead>
								<tr>
									<th><input type="text" data-column="0"  class="search-input-text form-control"></th>
									<th><input type="text" data-column="1"  class="search-input-text form-control"></th>
									<th><input type="text" data-column="2"  class="search-input-text form-control"></th>
									<th></th>
								</tr>
							</thead>
					</table>
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

				var dataTable = $('#employee-grid').DataTable( {
					"aoColumns": [
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
						url :"<?php echo base_url(); ?>index.php/master/eselon/data", // json datasource
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

	function add_eselon_tbl()
 	{
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Eselon'); // Set Title to Bootstrap modal title
  	}

  function save_tbl()
  {
      var url;
      if(save_method == 'add') 
      {
          url = "<?php echo site_url('master/eselon/ajax_add_tbl')?>";
      }
      else
      {
        url = "<?php echo site_url('master/eselon/ajax_update_tbl')?>";
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

  function edit_eselon_tbl(id)
  {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('master/eselon/ajax_edit_tbl/')?>/" +id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
            $('[name="eselon"]').val(data.ESELON);
            $('[name="neselon"]').val(data.NESELON);
             $('[name="cetakan"]').val(data.CETAKAN);             
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Eselon'); // Set title to Bootstrap modal title
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
		});
  }

  function delete_eselon_tbl(id)
  {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('master/eselon/ajax_delete_tbl')?>/"+id,
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
        <h3 class="modal-title">Form Eselon</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
      
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Eselon</label>
              <div class="col-md-9">
                <input type="text" id="eselon" name="eselon" placeholder="Eselon" value="<?php echo isset($agama) ? $agama : ""; ?>" class="form-control"> 
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Neselon</label>
              <div class="col-md-9">
                 <input type="text" id="neselon" name="neselon" placeholder="Neselon" value="<?php echo isset($keterangan) ? $keterangan : ""; ?>" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Cetakan</label>
              <div class="col-md-9">
                 <input type="text" id="cetakan" name="cetakan" placeholder="Cetakan" value="<?php echo isset($cetakan) ? $cetakan : ""; ?>" class="form-control">
              </div>
            </div>
          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save_tbl()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

