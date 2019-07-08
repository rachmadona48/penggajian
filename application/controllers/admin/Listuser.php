
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

class Listuser extends CI_Controller {

	public function __construct()
	{
		 /*header('Access-Control-Allow-Origin: http://10.15.32.31');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");*/
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('infopegawai');
		$this->load->model('mreferensi','referensi');
		$this->load->model('admin/v_listuser','mdl');
		$this->load->model('hist/v_jabatanf_hist');

		if ($this->session->userdata('logged_in')) {

			$session_data       = $this->session->userdata('logged_in');
			// var_dump($session_data);
			$this->user['id']     	= $session_data['id'];
			$this->user['username']  	= $session_data['username'];
			$this->user['user_group']     = $session_data['user_group'];
			$this->user['kowil']     = $session_data['kowil'];
			$this->user['param_cari'] = $this->session->userdata('param_cari');

			// var_dump($this->user['kowil']);
		}else{
			redirect(base_url().'login', 'refresh');
		}
	}

	public function index()
	{
		$tgl_sekarang = date("Y-m-d");
		$tgl = date('Y-m-d', strtotime($tgl_sekarang));
		$tglproses = date('Y-m-d', strtotime($tgl_sekarang));
		$ugs = $this->mdl->getUserGroupID();


		
		$namasrc = $this->input->post('namasrc');
		$nrksrc = $this->input->post('nrksrc');
		$koloksrc = $this->input->post('koloksrc');
		//var_dump($koloks);
		/*$data = array(
			'tgl' => $tgl,
			'tglproses' => $tglproses,
			'koloks' => $koloks,
			'koloksrc' => $koloksrc,
			'nrksrc' => $nrksrc,
			'namasrc' => $namasrc,
			'param_cari'=> $this->user['param_cari']
		);*/

		$hak_akses = $this->infopegawai->hakAksesModul('24705',$this->user['user_group']);
		$data = array(
			'user_group' => $this->user['user_group'],
			'ugs' => $ugs,
			'koloksrc' => $koloksrc,
			'nrksrc' => $nrksrc,
			'namasrc' => $namasrc,
			'param_cari'=> $this->user['param_cari'],
			'hak_akses'=>$hak_akses
			);

	


		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'listuser',0);
		$datam['inisial'] = 'listuser';
/*
		$this->load->view('head/header',$this->user);
		$this->load->view('head/menu',$datam);
		$this->load->view('admin/user_grid.php',$data);
		$this->load->view('head/footer');*/

		$this->load->view('head/header',$this->user);
		$this->load->view('admin/navigation/menu');
		$this->load->view('admin/user_grid.php',$data);
		$this->load->view('head/footer');
	}

	

	

	

	public function data()
	{
		$hak_akses = $this->infopegawai->hakAksesModul('24705',$this->user['user_group']);
		
		$requestData = $this->input->post();

		$pjg_input=strlen($requestData['nrk']);

		$columns = array(
			// datatable column index  => database column name
//			0 => 'ROWNUM',
			0 => 'user_id',
			1 => 'user_name',
			2 => 'user_group_id',
			3 => 'user_enable',
			4 =>'aksi'
		);

		// getting total number records without any search
		$q = "SELECT
					COUNT(\"user_id\") AS jml
				FROM
					\"master_user\" P1
				 ";
		// WHERE NOT EXISTS (SELECT NRK FROM PERS_PEGAWAI1 B WHERE DELETED ='Y' AND P1.NRK=B.NRK)
		$rs = $this->db->query($q)->result();
		$totalData = $rs[0]->JML;

		// getting records as per search parameters
		
		$wh_kolok = "";
		if( !empty($requestData['usergroup']) ){
			$nrk_status = "";
			$wh_kolok = " AND (a.\"user_group_id\") = '".$requestData['usergroup']."' ";
		}
		else if( !empty($requestData['koloksrc']) ){
			$nrk_status = "";
			$wh_kolok = " AND (a.\"user_group_id\") = '".$requestData['koloksrc']."' ";
		}

		
		$wh_nrk = "";
		if ($this->session->userdata('logged_in')['user_group']!='1'){
			if( !empty($requestData['nrk']) ){
				$wh_nrk = "AND (a.\"user_id\" LIKE ('%".$requestData['nrk']."%')";
				$wh_nrk .= "OR a.\"user_name\" LIKE UPPER('%".$requestData['nrk']."%'))";				
			}
			else if( !empty($requestData['nrksrc']) ){
				$wh_nrk = "AND (a.\"user_id\" LIKE UPPER('%".$requestData['nrksrc']."%')";
				$wh_nrk .= "OR a.\"user_name\" LIKE UPPER('%".$requestData['nrk']."%'))";
			}
		} 

		$wh_else="";
		if($wh_nrk == "" && $wh_kolok == "")
		{
			$wh_else = "AND 2=2";
		}
		else
		{
			$wh_else="AND 3=3";
		}
		

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn,a.\"user_id\",a.\"user_name\",a.\"user_group_id\",a.\"user_enable\",b.\"nama_group\"
				FROM \"master_user\" a
				LEFT JOIN \"master_user_group\" b ON a.\"user_group_id\" = b.\"user_group_id\" 
				WHERE 1=1	
                 $wh_kolok $wh_nrk $wh_else";
							// NOT EXISTS (SELECT NRK FROM PERS_PEGAWAI1 B WHERE DELETED ='Y' AND P1.NRK=B.NRK)
		if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $sql.=" AND ( a.\"user_id\" LIKE ('%".$requestData['search']['value']."%') ";    
            $sql.=" OR ( a.\"user_name\" LIKE ('%".$requestData['search']['value']."%')) ";
		}

		$sql .= " ORDER BY a.\"user_id\" ASC) X";
		
		 $sql.=" WHERE 1=1";		
		 
		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();
		$startrow = $requestData['start'];
		$endrow = $startrow + $requestData['length'];

		$sql.=" AND RN BETWEEN $startrow  AND $endrow";
	
		$query= $this->db->query($sql);

		$data = array();

		$no_urut = $requestData['start']+1;
		foreach($query->result() as $row){
			$nestedData=array();

				$nestedData[] = $row->user_id;
				$nestedData[] = $row->user_name;
				$nestedData[] = $row->nama_group;
				$on="<span class='badge badge-primary'>ON</span>";
				$off = "<span class='badge badge-danger'>OFF</span>";
				$a;
				if($row->user_enable == 't')
				{
					$a=$on;
				}
				else
				{
					$a = $off;
				}

				$nestedData[] = $a;
			
			//$peg1=$this->infopegawai->getPegawai1($row->NRK);

			$html_reset_pass="";
			$ubah="";
			if ($this->user['user_group']=='12'){
				
					

					if ($hak_akses->act_resetpass == 'Y'){
					$html_reset_pass="<div class='col-sm-3' align='center'>
											<button class='btn btn-outline btn-xs btn-warning' data-toggle='tool-tip' title='Reset password pegawai' pull-right onclick='ResetPassword(&#39;".$row->user_id."&#39;)'><i class='fa fa-key'></i></button>
									</div>";
									
								
					}
					$ubah='';
					if ($hak_akses->act_update == 'Y'){
						$ubah = "<div class='col-sm-2' align='center'>
												<button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' title='edit akun pegawai' pull-right onclick='EditUser(&#39;".$row->user_id."&#39;)'><i class='fa fa-pencil-square'></i></button>
												
											</div>";				
					}
				
		
				
				

				$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>
									<div class='row'>
										
										
										$ubah
										
										$html_reset_pass
										
									</div>
								</div>
							</div>
							
                            <script>
                                $('#tbl-grid_filter > label > input.form-control').val('');
                            </script>
                            ";
			} 
			
			
			
			
			

			$data[] = $nestedData;
			$no_urut++;
		}

		$json_data = array(
			"draw"            => intval( $requestData['draw'] ),
			"recordsTotal"    => intval( $totalData ),
			"recordsFiltered" => intval( $totalFiltered ),
			"data"            => $data
		);

		echo json_encode($json_data);
	}


	public function getSessionData()
	{
		$post = $this->input->post();
		$nrkpost = $post['nrk'];
		$kolokpost = $post['usergroup'];
		
		
		$session_data = $this->session->userdata('logged_in');
		
		if($nrkpost!="" || $kolokpost !="")
		{

			if($session_data)
			{
				// array_push($session_data['param_cari'], $kolokpost , $nrkpost);
				$new_param = array ($kolokpost , $nrkpost);
				$this->session->set_userdata('param_cari', $new_param);

			}
		}

		
	}


	
	function tambahuser()
	{
		//$id = $this->input->post();
		
		//$nrk=$id['NRK'];

		$ugs = $this->mdl->getUserGroupID();

		

		echo '
			<div class="modal-dialog" role="document" id="pesan">
		        <form class="form-horizontal" id="formPass" action="javascript:submitdata();" method="POST">                
		            <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <br/>
		                <div><b>Tambah Akun Pegawai</b></div>';
		                
		                
		                echo'
		            </div>
		            <div class="modal-body">
		            	<div class="form-group">
                        	<label class="col-sm-4 control-label">User ID</label>
                        	<div class="input-group col-sm-7">
                            	<input type="text" id="user_id" name="user_id" placeholder="USER ID" class="form-control" maxlength="20">
                        	</div>
                    	</div>
                    	
                    	

		    			<div class="form-group">
                        	<label class="col-sm-4 control-label">Nama</label>
                        	<div class="input-group col-sm-7">
                            	<input type="text" id="user_name" name="user_name" placeholder="USER NAME" class="form-control" maxlength="100">
                        	</div>
                    	</div>
                    	

		    			<div class="form-group">
                        	<label class="col-sm-4 control-label">Grup</label>
                        	<div class="input-group col-sm-7">
                            	<select class="chosen-kdduduk" name="user_group" id="user_group" tabindex="2" data-placeholder="Pilih User Group...">
                            		<option value=""></option>';
                            		foreach ($ugs as $klk){

									echo '<option value="'.$klk->user_group_id.'">'.$klk->nama_group.'</option>';
								}
                          		echo '</select>
                        	</div>
                    	</div>
                    	

                    	<div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Status</label>
                            <div class="input-group col-sm-7">
                                <div class="i-checks inline"><label> <input type="radio" name="user_enable" value="t">Aktif</label></div><br/>
                                <div class="i-checks inline"><label> <input type="radio" name="user_enable" value="f">Non Aktif </label></div>
                            </div>
                    	</div>

		            </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default dim" data-dismiss="modal" id="tutupModal">Batalkan</button>
		                    <button type="submit" class="btn btn-primary dim">Buat</button>

		                </div>
		            </div>
		        </form>

		    </div>

		    <script type="text/javascript" language="javascript" >
		    	$(document).ready(function(){

    				var config = { ".chosen-kdduduk"           : {search_contains:true,no_results_text:"Oops, Data Tidak Ditemukan",width: "100%"}}
				    for (var selector in config) {
				      $(selector).chosen(config[selector]);
				    }


    
		    	});
			    function submitdata(){
			    	var user_id = document.getElementById("user_id").value.length;
			    	var user_name = document.getElementById("user_name").value.length;
			    	var user_group = document.getElementById("user_group").value;
			    	var user_enable = $("input[name=user_enable]:checked").val();
			    	alert(user_enable);
			    	if(user_id == 0)
			    	{
			    		alert("User Id harus diisi");
			    	}
			    	else
			    	{
			    		if(user_name == 0)
			    		{
			    			alert("user name harus diisi");
			    		}
			    		else
			    		{
			    			if(user_group == 0)
			    			{
			    				alert("harap pilih user group");
			    			}
			    			else
			    			{
			    				if(user_enable == undefined)
			    				{
			    					alert("pilih status aktif");
			    				}
			    				else
			    				{
			    					var url = "'.site_url("listuser/AddUserAccount").'";
							        $.ajax({
							            url: url,
							            type: "POST",
							            data: $("#formPass").serialize(),
							            dataType: "json",
							           
							            success: function(data) {                               
							                if(data.resp.resp == "0"){
							                    swal("Error!", "Akun Pegawai Gagal Dibuat", "error");                    
							                    
							                }
							                else if(data.resp.resp == "1"){';
							                  
							                  
							                   echo'swal({type:"success",title:"Akun Pegawai Berhasil Dibuat",text:"Password = 123456"});
							                   $("#tutupModal").click();
							                    $("#tbl-grid").DataTable().ajax.reload();
							                }
							                else
							                {
							                	 swal("Warning!", "Akun Pegawai Sudah Ada.", "warning");

							                   	$("#tutupModal").click();
							                    $("#tbl-grid").DataTable().ajax.reload();
							                }
							                
							            },
							            error: function(xhr) {                              
							                
							            },
							            complete: function() {              
							                
							            }
							        });
			    				}
			    			}
			    		}
			    	}

			        
			    }

			</script>
		';
	}

	function edituser()
	{
		$id = $this->input->post();
		
		$nrk=$id['NRK'];

		$data = $this->mdl->getdataakun($nrk);

		$user_id = $data->user_id;
		$user_group = $data->user_group_id;
		$user_name = $data->user_name;
		$user_enable = $data->user_enable;

		$ugs = $this->mdl->getMasterUserGroup($user_group);

		

		echo '
			<div class="modal-dialog" role="document" id="pesan">
		        <form class="form-horizontal" id="formPass" action="javascript:submitdata();" method="POST">                
		            <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <br/>
		                <div><b>Ubah Akun Pegawai</b></div>';
		                
		                
		                echo'
		            </div>
		            <div class="modal-body">
		            	<div class="form-group">
                        	<label class="col-sm-4 control-label">User ID</label>
                        	<div class="input-group col-sm-7">
                            	<input type="text" id="user_id" name="user_id" placeholder="USER ID" class="form-control" maxlength="20" readonly="true" value="'; echo isset($user_id) ? $user_id : ''; echo'">
                        	</div>
                    	</div>
                    	
                    	

		    			<div class="form-group">
                        	<label class="col-sm-4 control-label">Nama</label>
                        	<div class="input-group col-sm-7">
                            	<input type="text" id="user_name" name="user_name" placeholder="USER NAME" class="form-control" maxlength="100" value="'; echo isset($user_name) ? $user_name : ''; echo' ">
                        	</div>
                    	</div>
                    	

		    			<div class="form-group">
                        	<label class="col-sm-4 control-label">Grup</label>
                        	<div class="input-group col-sm-7">
                            	<select class="chosen-kdduduk" name="user_group" id="user_group" tabindex="2" data-placeholder="Pilih User Group...">
                            		<option value=""></option>';
                            		

									echo $ugs;
								
                          		echo '</select>
                        	</div>
                    	</div>
                    	

                    	<div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Status</label>
                            <div class="input-group col-sm-7">
                                <div class="i-checks inline"><label> <input type="radio" name="user_enable" value="t"'; echo isset($user_enable) ? ($user_enable == 't' ? 'checked' : '') : ''; ; echo '>Aktif</label></div><br/>
                                <div class="i-checks inline"><label> <input type="radio" name="user_enable" value="f"'; echo isset($user_enable) ? ($user_enable == 'f' ? 'checked' : '') : ''; ; echo '>Non Aktif </label></div>
                            </div>
                    	</div>

		            </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default dim" data-dismiss="modal" id="tutupModal">Batalkan</button>
		                    <button type="submit" class="btn btn-primary dim">Simpan</button>

		                </div>
		            </div>
		        </form>

		    </div>

		    <script type="text/javascript" language="javascript" >
		    	$(document).ready(function(){

    				var config = { ".chosen-kdduduk"           : {search_contains:true,no_results_text:"Oops, Data Tidak Ditemukan",width: "100%"}}
				    for (var selector in config) {
				      $(selector).chosen(config[selector]);
				    }


    
		    	});
			    function submitdata(){

			    	



			        var url = "'.site_url("listuser/UpdateUserAccount").'";
			        $.ajax({
			            url: url,
			            type: "POST",
			            data: $("#formPass").serialize(),
			            dataType: "json",
			           
			            success: function(data) {                               
			                if(data.resp.resp == "0"){
			                    swal("Error!", "Gagal Ubah Data", "error");                    
			                    
			                }
			                else if(data.resp.resp == "1"){';
			                  
			                  
			                   echo'swal({type:"success",title:"Data Akun Pegawai Berhasil Diubah"});
			                   $("#tutupModal").click();
			                    $("#tbl-grid").DataTable().ajax.reload();
			                }
			                else
			                {
			                	 swal("Warning!", "Data Tidak Ada.", "warning");

			                   	$("#tutupModal").click();
			                    $("#tbl-grid").DataTable().ajax.reload();
			                }
			                
			            },
			            error: function(xhr) {                              
			                
			            },
			            complete: function() {              
			                
			            }
			        });
			    }

			</script>
		';
	}

	function edituseradmin()
	{
		$id = $this->input->post();
		
		$nrk=$id['NRK'];

		$data = $this->mdl->getdataakun($nrk);

		$user_id = $data->user_id;
		$user_group = $data->user_group_id;
		$user_name = $data->user_name;
		$user_enable = $data->user_enable;

		$ugs = $this->mdl->getMasterUserGroup($user_group);

		

		echo '
			<div class="modal-dialog" role="document" id="pesan">
		        <form class="form-horizontal" id="formPass" action="javascript:submitdata();" method="POST">                
		            <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <br/>
		                <div><b>Ubah Akun Pegawai</b></div>';
		                
		                
		                echo'
		            </div>
		            <div class="modal-body">
		            	<div class="form-group">
                        	<label class="col-sm-4 control-label">User ID</label>
                        	<div class="input-group col-sm-7">
                            	<input type="text" id="user_id" name="user_id" placeholder="USER ID" class="form-control" maxlength="20" disabled="disabled" value="'; echo isset($user_id) ? $user_id : ''; echo'">
                        	</div>
                    	</div>
                    	
                    	

		    			<div class="form-group">
                        	<label class="col-sm-4 control-label">Nama</label>
                        	<div class="input-group col-sm-7">
                            	<input type="text" id="user_name" name="user_name" placeholder="USER NAME" class="form-control" maxlength="100" disabled="disabled" value="'; echo isset($user_name) ? $user_name : ''; echo' ">
                        	</div>
                    	</div>
                    	

		    			<div class="form-group">
                        	<label class="col-sm-4 control-label">Grup</label>
                        	<div class="input-group col-sm-7">
                            	<select class="chosen-kdduduk" name="user_group" id="user_group" tabindex="2" disabled="disabled" data-placeholder="Pilih User Group...">
                            		<option value=""></option>';
                            		

									echo $ugs;
								
                          		echo '</select>
                        	</div>
                    	</div>
                    	

                    	<div class="form-group pickerpicker">
                        <label class="col-sm-4 control-label">Status</label>
                            <div class="input-group col-sm-7">
                                <div class="i-checks inline"><label> <input type="radio" name="user_enable" disabled="disabled" value="t"'; echo isset($user_enable) ? ($user_enable == 't' ? 'checked' : '') : ''; ; echo '>Aktif</label></div><br/>
                                <div class="i-checks inline"><label> <input type="radio" name="user_enable" disabled="disabled" value="f"'; echo isset($user_enable) ? ($user_enable == 'f' ? 'checked' : '') : ''; ; echo '>Non Aktif </label></div>
                            </div>
                    	</div>

		            </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default dim" data-dismiss="modal" id="tutupModal">Tutup</button>
		                    

		                </div>
		            </div>
		        </form>

		    </div>

		    <script type="text/javascript" language="javascript" >
		    	$(document).ready(function(){

    				var config = { ".chosen-kdduduk"           : {search_contains:true,no_results_text:"Oops, Data Tidak Ditemukan",width: "100%"}}
				    for (var selector in config) {
				      $(selector).chosen(config[selector]);
				    }


    
		    	});
			   

			</script>
		';
	}

	function AddUserAccount()
	{
		$data = $this->input->post();
	
		
		$result = $this->mdl->addUserAccount($data);
		

		$return = array('resp' => $result);

        echo json_encode($return);
	}

	function UpdateUserAccount()
	{
		$data = $this->input->post();
	
		
		$result = $this->mdl->updateUserAccount($data);
		

		$return = array('resp' => $result);

        echo json_encode($return);
	}

	function tampilPhoto($nrk='989898'){
		// Now query back the uploaded BLOB and display it
		$rs=$this->mdl->get_data($nrk)->row();
		$result = $rs->X_PHOTO->load();
		// If any text (or whitespace!) is printed before this header is sent,
		// the text won't be displayed and the image won't display properly.
		// Comment out this line to see the text and debug such a problem.
		header("Content-type: image/JPEG");
		echo $result;
	}

	function reset_password(){
		 // <img src="'.base_url("assets/img/eye.png").';" onmouseover="mouseoverPass(old_pass);" onmouseout="mouseoutPass(old_pass);">
		                 
		$id = $this->input->post('NRK');
		$nama = $this->infopegawai->getDataUser($id);

		if(isset($nama))
		{
			echo '
			<div class="modal-dialog" role="document" id="pesan">
		        <form class="form-horizontal" id="formPass" action="javascript:updatePassword();" method="POST">                
		            <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="modalUmumTitle">Edit Password<i> '; 
		                echo $id; echo '-';
		                echo $nama->user_name;	echo '</i></h4>
		                <input type="hidden" id="NRK" name="NRK" value="' ; echo $id;	
		                
		                echo'">
		            </div>
		            <div class="modal-body">
		                    
		                <div class="form-group">
		                    <label for="username" class="col-sm-3 control-label">Password Baru</label>
		                    <div class="col-sm-9">

		                    <input type="password" class="form-control" id="old_pass" name="old_pass" Placeholder="Password Baru">
		                   	<img src="'.base_url("assets/img/eye.png").'" onmouseover="mouseoverPass(old_pass);" onmouseout="mouseoutPass(old_pass);">
		                   	</div>
		                </div>

		                <div class="form-group">
		                    <label for="username" class="col-sm-3 control-label">Password Konfirmasi</label>
		                    <div class="col-sm-9">
		                    <input type="password" class="form-control" id="new_pass" name="new_pass" Placeholder="Password Konfirmasi">
		                    <span class="text-danger" id="errnew_pass"></span>
		                    </div>
		                </div>

		                <div class="form-group">
		                    <label for="username" class="col-sm-3 control-label"></label>
		                    <div class="col-sm-9">
		                    <i>( Harap ganti Password secara berkala untuk menjaga kerahasiaan data pribadi anda ! )</i>
		                    </div>
		                </div>
		    
		            </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default dim" data-dismiss="modal" id="tutupModal">Tutup</button>
		                    <button type="submit" class="btn btn-primary dim">Simpan</button>
		                </div>
		            </div>
		        </form>
		    </div>

		    <script type="text/javascript" language="javascript" >
		    	function mouseoverPass(obj) {
		  			//var obj = document.getElementById("myPassword");
		  			obj.type = "text";
				}

				function mouseoutPass(obj) {
		  			//var obj = document.getElementById("myPassword");
				  	obj.type = "password";
				}

			    function updatePassword(){
			        var url = "'.site_url("pegawai/UpdatePass").'";
			        $.ajax({
			            url: url,
			            type: "POST",
			            data: $("#formPass").serialize(),
			            dataType: "json",
			            beforeSend: function() {                
			                var old_pass = $("#old_pass").val();
			                if(old_pass == ""){
			                    $("#errold_pass").html("Passwor Lama Wajib diisi!!!");
			                    return false;
			                }else{
			                    $("#errold_pass").html();                    
			                }

			                var new_pass = $("#new_pass").val();
			                if(new_pass == ""){
			                    $("#errnew_pass").html("Password Baru Wajib diisi!!!");
			                    return false;
			                }else{
			                    $("#errnew_pass").html();                    
			                }

			               
			            },
			            success: function(data) {                               
			                
			                if(data.responeinsert == "SUKSES"){
			                    swal("Sukses!", "Reset password berhasil", "success");                    
			                    $("#tutupModal").click();
			                    $("#tbl-grid").DataTable().ajax.reload();
			                }else{
			                   swal("Gagal!", "Password konfirmasi tidak sesuai.", "error");
			                }
			            },
			            error: function(xhr) {                              
			                
			            },
			            complete: function() {              
			                
			            }
			        });
			    }

			</script>
		';
		}
		else
		{
			echo '
			<div class="modal-dialog" role="document" id="pesan">
		        <form class="form-horizontal" id="formPass" action="javascript:updatePassword();" method="POST">                
		            <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <h4 class="modal-title" id="modalUmumTitle">Edit Password<i> ';

		                echo $id;

		                echo '
		                </i></h4>
		                <input type="hidden" id="NRK" name="NRK" value="">
		            </div>
		            <div class="modal-body">
		                    
		                <h2>USER <i>'; echo $id; echo '</i> BELUM MEMILIKI AKUN UNTUK MENGAKSES WEBSITE INI </h2>
		    
		            </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default dim" data-dismiss="modal" id="tutupModal">Tutup</button>
		                    <button type="submit" class="btn btn-primary dim" style="display:none">Simpan</button>
		                </div>
		            </div>
		        </form>
		    </div>

		    
		';
		}
		
	}

	function UpdatePass(){
		$nrk = $this->input->post('NRK');
		$old_pass = $this->input->post('old_pass');
		$new_pass = $this->input->post('new_pass');
		$pass_old = md5($old_pass);
        $pass_new = md5($new_pass);
        // echo $nrk;
        // echo "pass lama"; var_dump($pass_old);

        // $cek_pass = $this->mdl->get_pass($nrk);
        // echo "pass db"; var_dump($cek_pass->user_password);

        // echo "pass db"; var_dump($cek_pass->user_id);
        
        if($pass_new  ==  $pass_old){
            $this->mdl->ubah_password($nrk,$pass_new);
            $respone = "SUKSES";
        }else{
            $respone = "GAGAL";
        }

        $return = array('responeinsert' => $respone);

        echo json_encode($return);
	}

}
		

