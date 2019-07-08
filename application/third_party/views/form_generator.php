<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
        <h2>Profile</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li class="active">
                <strong>Profile</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
        <div class="col-lg-12">
        	<div class="ibox float-e-margins">

	            <div class="ibox-title">
	                <h5>Form Pers-Duk-Pangkat-Hist</h5>
	                <div class="ibox-tools">
	                    <a class="collapse-link">
	                        <i class="fa fa-chevron-up"></i>
	                    </a>                    
	                </div>
	            </div>
	            <div class="ibox-content">
	            	
	            	<form id="defaultForm2" name="defaultForm2" method="post" class="form-horizontal">
	            		<?php foreach ($listtable as $key => $value) { ?>

	            			<div class="form-group">
	            				<label class="col-sm-2 control-label"><?php echo ucwords(strtolower($value->column_name)); ?></label>
                            	<div class="col-sm-10">
                            		<input type="text" id="<?php echo $value->column_name; ?>" name="<?php echo $value->column_name; ?>" placeholder="<?php echo ucwords(strtolower(str_replace('_',' ',$value->column_name))); ?>" value="<___?___php e___cho i___sset($<?php echo $value->column_name ?>) ? $<?php echo $value->column_name?> : ""; ?___>" class="form-control">
                            	</div>
	                        </div>
	                        <div class="hr-line-dashed"></div>
	            			 
	            		<?php } ?>	            		
                       
	            	</form>
	            	
	        	</div>
	        	    
	      	</div>
        </div>
    </div>
</div>