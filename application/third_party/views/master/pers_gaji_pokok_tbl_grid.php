<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Profile</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Master</a>
            </li>
            <li class="active">
                <strong>Gaji Pokok</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<style type="text/css">
	
	input.form-control {
	  width: auto;
	}

</style>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
        <div class="col-lg-12">
            <div class="contact-box">
            	<div>
					<button class="btn btn-success pull-right" onclick="add_gapok()"><i class="glyphicon glyphicon-plus"></i> Tambah Gaji Pokok</button>
				</div>
            	<div>
		            <table id="employee-grid" class="table table-striped table-bordered table-hover dataTables-example" width="100%" cellpadding="0" cellspacing="0" border="0" class="display">
							<thead>
								<tr>
									<th>Kopang</th>									
									<th>TTMasker</th>
									<th>BBMasker</th>
									<th>Gaji Pokok</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<thead>
								<tr>
									<th><input type="text" data-column="0"  class="search-input-text form-control"></th>
									<th><input type="text" data-column="1"  class="search-input-text form-control"></th>
									<th><input type="text" data-column="2"  class="search-input-text form-control"></th>
									<th><input type="text" data-column="3"  class="search-input-text form-control"></th>									
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
			var save_method; //for save method string
   		 	var table;	

			$(document).ready(function() {		
			
				var dataTable = $('#employee-grid').DataTable( {
					"aoColumns": [
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
						url :"<?php echo base_url(); ?>index.php/master/gapok/data", // json datasource
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

		/*	function hapusData(id,id2,id3, action){
				var dataTable = $('#employee-grid').DataTable();
				//var formData = {name:"ravi",age:"31"}; --> Example
				var formData = {id:id,id2:id2,id3:id3};

				$.ajax({
                    url: action,
                    type: "post",                    
                    data: formData,
                    dataType: 'json',
                    beforeSend: function() {
                    	var r = confirm("Yakin ingin menghapus data ???");
					    if (r == true) {
					        blocklayar();
					    } else {
					    	return false;
					    }                        
                    },
                    success: function(data) {                        
                        if(data.response == 'GAGAL'){
                        	alert('Data gagal dihapus');
                        }
                        // window.location.href = data.linkback;
                        dataTable.ajax.reload();
                    },
                    error: function(xhr) {  
                        unblocklayar();  
                        alert("Terjadi kesalahan. Silahkan coba kembali");
                    },
                    complete: function() {
                        unblocklayar();  
                    }
                });
			}			*/
	function add_gapok()
	{
	      save_method = 'add';
	      $('#form')[0].reset(); // reset form on modals
	      $('#modal_form').modal('show'); // show bootstrap modal
	      $('.modal-title').text('Tambah Gaji Pokok'); // Set Title to Bootstrap modal title
	}

  function save()
  {
      var url;
      if(save_method == 'add') 
      {
          url = "<?php echo site_url('master/gapok/ajax_add')?>";
      }
      else
      {
        url = "<?php echo site_url('master/gapok/ajax_update')?>";
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

  function edit_gapok(id1,id2,id3)
  {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('master/gapok/ajax_edit/')?>/"+id1+'/'+id2+'/'+id3,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
            $('[name="kopang"]').val(data.KOPANG);
            $('[name="ttmasker"]').val(data.TTMASKER);
            $('[name="bbmasker"]').val(data.BBMASKER);
            $('[name="gapok"]').val(data.GAPOK);            
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Gaji Pokok'); // Set title to Bootstrap modal title
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
		});
  }

  function delete_gapok(id1,id2,id3)
  {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('master/gapok/ajax_delete')?>/"+id1+'/'+id2+'/'+id3,
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
        <h3 class="modal-title">Form Gaji Pokok</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
      
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Kopang</label>
              <div class="col-md-9">
                <input type="text" id="kopang" name="kopang" placeholder="Kopang" value="<?php echo isset($kopang) ? $kopang : ""; ?>" class="form-control"> 
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">TTMasker</label>
              <div class="col-md-9">
                 <input type="text" id="ttmasker" name="ttmasker" placeholder="TTMasker" value="<?php echo isset($ttmasker) ? $ttmasker : ""; ?>" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">BBMasker</label>
              <div class="col-md-9">
                 <input type="text" id="bbmasker" name="bbmasker" placeholder="BBMasker" value="<?php echo isset($bbmasker) ? $bbmasker : ""; ?>" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Gapok</label>
              <div class="col-md-9">
                 <input type="text" id="gapok" name="gapok" placeholder="Gapok" value="<?php echo isset($ttmasker) ? $ttmasker : ""; ?>" class="form-control">
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
