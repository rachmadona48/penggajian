<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
        $this->load->helper('url');    
        $this->load->library('session');
        $this->load->model('admin/m_admin');

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
		$data['temp'] = "";

		$this->load->view('admin/navigation/header');
		$this->load->view('admin/navigation/menu');
		$this->load->view('newtab',$data);
		$this->load->view('admin/navigation/footer');
	}

	public function menu()
	{
		$menubaru = $this->m_admin->getMenuBaru();
		$listmenu = $this->m_admin->getListMenu();
		$update = 'update';
		$itemBaru = '';
		foreach ($menubaru as $key => $value) {
			$itemBaru .= '<li class="dd-item" id="'.$value->id_menu.'" data-id="'.$value->id_menu.'">';
			// $itemBaru .= '		<span class="pull-right"> <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button> </span>';
			$itemBaru .= '		<span class="pull-right"> <button class="btn btn-success btn-xs" onclick="return setValueModal(\''.$update.'\',\''.$value->id_menu.'\');" data-toggle="modal" data-target="#addMenu"><i class="fa fa-pencil"></i></button> </span>';
            $itemBaru .= '<div class="dd-handle" id="item_'.$value->id_menu.'">'.$value->id_menu.' - '.$value->nama_menu.'
            				</div>';
            $itemBaru .= '</li>';
		}

		$data['menubaru'] = $itemBaru;

		$itemAktifTemp = array(); $itemNonAktifTemp = array();
		foreach ($listmenu as $key => $value) {
			$itemAktifTemp = json_decode($value->aktif_list);
			$itemNonAktifTemp = json_decode($value->non_aktif_list);
		}

		$itemAktif = '';
		if(count($itemAktifTemp) > 0){
			foreach ($itemAktifTemp as $key => $value) { //menu lvl 1
				$menu = $this->m_admin->getMenu($value->id)->row();
                $itemAktif .= '<li class="dd-item" id="'.$value->id.'" data-id="'.$value->id.'">';
				// $itemAktif .= '		<span class="pull-right"> <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button> </span>';
				$itemAktif .= '		<span class="pull-right"> <button class="btn btn-success btn-xs" onclick="return setValueModal(\''.$update.'\',\''.$menu->id_menu.'\');" data-toggle="modal" data-target="#addMenu"><i class="fa fa-pencil"></i></button> </span>';
                $itemAktif .= '	 <div class="dd-handle" id="item_'.$value->id.'">'.$value->id.' - '.$menu->nama_menu.'</div>';
                		

                if(isset($value->children)){
                	$itemAktif .= '<ol class="dd-list">';
                    foreach ($value->children as $key2 => $value2) { //menu lvl 2                        
                        $menu2 = $this->m_admin->getMenu($value2->id)->row();
                        $itemAktif .= '<li class="dd-item" id="'.$value2->id.'" data-id="'.$value2->id.'">';
                        // $itemAktif .= '		<span class="pull-right"> <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button> </span>';
						$itemAktif .= '		<span class="pull-right"> <button class="btn btn-success btn-xs" onclick="return setValueModal(\''.$update.'\',\''.$menu2->id_menu.'\');" data-toggle="modal" data-target="#addMenu"><i class="fa fa-pencil"></i></button> </span>';
                      	$itemAktif .= '	<div class="dd-handle" id="item_'.$value2->id.'">'.$value2->id.' - '.$menu2->nama_menu.'</div>';

                        if(isset($value2->children)){
                        	$itemAktif .= '<ol class="dd-list">';
                            foreach ($value2->children as $key3 => $value3) { //menu lvl 3
                            	$menu3 = $this->m_admin->getMenu($value3->id)->row();
                                $itemAktif .= '<li class="dd-item" id="'.$value3->id.'" data-id="'.$value3->id.'">';
                                // $itemAktif .= '		<span class="pull-right"> <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button> </span>';
								$itemAktif .= '		<span class="pull-right"> <button class="btn btn-success btn-xs" onclick="return setValueModal(\''.$update.'\',\''.$menu3->id_menu.'\');" data-toggle="modal" data-target="#addMenu"><i class="fa fa-pencil"></i></button> </span>';
                                $itemAktif .= '  <div class="dd-handle" id="item_'.$value3->id.'">'.$value3->id.' - '.$menu3->nama_menu.'</div>';
                                $itemAktif .= '</li>';
                            }
                            $itemAktif .= '</ol>';
                        }
                        $itemAktif .= '</li>';
                    }
                    $itemAktif .= '</ol>';
                }
                $itemAktif .= '</li>';
            }
		}

		$data['menuaktif'] = $itemAktif;

		$itemNonAktif = '';
		if(count($itemNonAktifTemp) > 0){
			foreach ($itemNonAktifTemp as $key => $value) { //menu lvl 1
				$menu = $this->m_admin->getMenu($value->id)->row();
				if($menu){
	                $itemNonAktif .= '<li class="dd-item" id="'.$value->id.'" data-id="'.$value->id.'">';
	                if($value->id > 1){
	                	$itemNonAktif .= '		<span class="pull-right"> <button class="btn btn-danger btn-xs" onclick="return hapusMenu(\''.$menu->id_menu.'\',\''.$menu->nama_menu.'\')"><i class="fa fa-trash"></i></button> </span>';
						$itemNonAktif .= '		<span class="pull-right"> <button class="btn btn-success btn-xs" onclick="return setValueModal(\''.$update.'\',\''.$menu->id_menu.'\');" data-toggle="modal" data-target="#addMenu"><i class="fa fa-pencil"></i></button> </span>';
					}
	               	$itemNonAktif .= '  <div class="dd-handle" id="item_'.$value->id.'">'.$value->id.' - '.$menu->nama_menu.'</div>';

	                if(isset($value->children)){
	                	$itemNonAktif .= '<ol class="dd-list">';
	                    foreach ($value->children as $key2 => $value2) { //menu lvl 2                        
	                        $menu2 = $this->m_admin->getMenu($value2->id)->row();
	                        if($menu2){
		                        $itemNonAktif .= '<li class="dd-item" id="'.$value2->id.'" data-id="'.$value2->id.'">';
								$itemNonAktif .= '		<span class="pull-right"> <button class="btn btn-danger btn-xs" onclick="return hapusMenu(\''.$menu2->id_menu.'\',\''.$menu2->nama_menu.'\')"><i class="fa fa-trash"></i></button> </span>';
								$itemNonAktif .= '		<span class="pull-right"> <button class="btn btn-success btn-xs" onclick="return setValueModal(\''.$update.'\',\''.$menu2->id_menu.'\');" data-toggle="modal" data-target="#addMenu"><i class="fa fa-pencil"></i></button> </span>';
		                        $itemNonAktif .= '	<div class="dd-handle" id="item_'.$value2->id.'">'.$value2->id.' - '.$menu2->nama_menu.'</div>';

		                        if(isset($value2->children)){
		                        	$itemNonAktif .= '<ol class="dd-list">';
		                            foreach ($value2->children as $key3 => $value3) { //menu lvl 3
		                            	$menu3 = $this->m_admin->getMenu($value3->id)->row();
		                            	if($menu3){
			                                $itemNonAktif .= '<li class="dd-item" id="'.$value3->id.'" data-id="'.$value3->id.'">';
			                                $itemNonAktif .= '		<span class="pull-right"> <button class="btn btn-danger btn-xs" onclick="return hapusMenu(\''.$menu3->id_menu.'\',\''.$menu3->nama_menu.'\')"><i class="fa fa-trash"></i></button> </span>';
											$itemNonAktif .= '		<span class="pull-right"> <button class="btn btn-success btn-xs" onclick="return setValueModal(\''.$update.'\',\''.$menu3->id_menu.'\');" data-toggle="modal" data-target="#addMenu"><i class="fa fa-pencil"></i></button> </span>';
			                                $itemNonAktif .= '	<div class="dd-handle" id="item_'.$value3->id.'">'.$value3->id.' - '.$menu3->nama_menu.'</div>';
			                                $itemNonAktif .= '</li>';
			                            }
		                            }
		                            $itemNonAktif .= '</ol>';
		                        }
		                        $itemNonAktif .= '</li>';
		                  	}
	                    }
	                    $itemNonAktif .= '</ol>';
	                }
	                $itemNonAktif .= '</li>';
	          	}
            }
		}

		$data['menunonaktif'] = $itemNonAktif;


		$data['linkaction'] = base_url().'index.php/admin/admin/menuAction';
		$data['linkaction2'] = base_url().'index.php/admin/admin/menuListAction';
		$data['linkgetmenu'] = base_url().'index.php/admin/admin/getInfoMenu';
		$data['linkdelmenu'] = base_url().'index.php/admin/admin/deleteMenu';

		$this->load->view('admin/navigation/header');
		$this->load->view('admin/navigation/menu');
		$this->load->view('admin/menu',$data);
		$this->load->view('admin/navigation/footer');
	}	

	public function menuAction(){
		$data = $this->input->post();

		if(isset($data['action'])){
			if($data['action'] == 'update'){
				$hsl = $this->m_admin->updateMenu($data);	
			}else{
				
				$hsl = $this->m_admin->insertMenu($data);	
			}
		}else{
			
			$hsl = $this->m_admin->insertMenuBaru($data);		
		}				
		
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'action' => $data['action']);

		echo json_encode($a);
	}

	public function menuListAction(){
		$data = $this->input->post();
		
		$hsl = $this->m_admin->updateListMenu($data);	
				
		$a = array('response' => 'SUKSES', 'hasil' => $hsl);

		echo json_encode($a);
	}

	public function getInfoMenu(){
		$data = $this->input->post();

		$menu = $this->m_admin->getMenu($data['id_menu'])->row();

		if(count($menu) > 0){
			$a = array('response' => 'SUKSES', 'nama_menu' => $menu->nama_menu, 'link_menu' => $menu->link_menu, 'alias' => $menu->alias, 'jenis_menu' => $menu->jenis_menu);
		}else{
			$a = array('response' => 'GAGAL', 'nama_menu' => '', 'link_menu' => '');
		}
		

		echo json_encode($a);
	}

	function deleteMenu(){
		$data = $this->input->post();

		$menu = $this->m_admin->deleteMenu($data);

		if($menu){
			$a = array('response' => 'SUKSES');
		}else{
			$a = array('response' => 'GAGAL');
		}
		
		echo json_encode($a);
	
	}

	public function usergroup()
	{
		$data['temp'] = "";

		$this->load->view('admin/navigation/header');
		$this->load->view('admin/navigation/menu');
		$this->load->view('admin/usergroup',$data);
		$this->load->view('admin/navigation/footer');
	}

	public function menuaccess()
	{
		$listgroupuser = $this->m_admin->getUserGroups();	

		$option = "";
		foreach ($listgroupuser as $key => $value) {
			$option .= '<option value="'.$value->user_group_id.'">'.$value->nama_group.'</option>';
		}

		$data['listgroupuser'] = $option;		

		$data['temp'] = "";

		$this->load->view('admin/navigation/header');
		$this->load->view('admin/navigation/menu');
		$this->load->view('admin/menuaccess',$data);
		$this->load->view('admin/navigation/footer');
	}

	public function simpanmenuaccess()
	{
		$data = $this->input->post();	

		$hsl = $this->m_admin->insertMenuAccess($data);	
				
		$a = array('response' => 'SUKSES');

		echo json_encode($a);
	}

	public function getMenuAccess(){
		$usergroup = $this->input->post('usergroup');

		$listMenuAccess = $this->m_admin->getMenuAccess($usergroup);
		
		$table = "";
		$i = 1;
		foreach ($listMenuAccess as $key => $value) {
			$table .= '<tr>';
			$table .= '<td>'.$i.'<input type="hidden" name="idmenu[]" id="idmenu[]" value="'.$value->id_menu.'"></td>';
			$table .= '<td>'.$value->id_menu.' - '.$value->nama_menu.'</td>';
			if($value->act_view == 'Y'){
				$table .= '<td align="center"><input type="checkbox" name="actview['.$value->id_menu.']" id="actview['.$value->id_menu.']" value="Y" checked="true" /></td>';
			}else{
				$table .= '<td align="center"><input type="checkbox" name="actview['.$value->id_menu.']" id="actview['.$value->id_menu.']" value="Y" /></td>';
			}

			if($value->act_insert == 'Y'){
				$table .= '<td align="center"><input type="checkbox" name="actinsert['.$value->id_menu.']" id="actinsert['.$value->id_menu.']" value="Y" checked="true" /></td>';
			}else{
				$table .= '<td align="center"><input type="checkbox" name="actinsert['.$value->id_menu.']" id="actinsert['.$value->id_menu.']" value="Y" /></td>';
			}

			if($value->act_update == 'Y'){
				$table .= '<td align="center"><input type="checkbox" name="actupdate['.$value->id_menu.']" id="actupdate['.$value->id_menu.']" value="Y" checked="true" /></td>';
			}else{
				$table .= '<td align="center"><input type="checkbox" name="actupdate['.$value->id_menu.']" id="actupdate['.$value->id_menu.']" value="Y" /></td>';
			}

			if ($value->id_menu=='394'){
				if($value->act_resetpass == 'Y'){
					$table .= '<td align="center"><input type="checkbox" name="actresetpass['.$value->id_menu.']" id="actresetpass['.$value->id_menu.']" value="Y" checked="true" /></td>';
				}else{
					$table .= '<td align="center"><input type="checkbox" name="actresetpass['.$value->id_menu.']" id="actresetpass['.$value->id_menu.']" value="Y" /></td>';
				}		
			} else {
				$table .= '<td align="center"><input type="checkbox" name="actresetpass['.$value->id_menu.']" id="actresetpass['.$value->id_menu.']" value="Y" style="display:none" /></td>';
			}

			if($value->act_delete == 'Y'){
				$table .= '<td align="center"><input type="checkbox" name="actdelete['.$value->id_menu.']" id="actdelete['.$value->id_menu.']" value="Y" checked="true" /></td>';
			}else{
				$table .= '<td align="center"><input type="checkbox" name="actdelete['.$value->id_menu.']" id="actdelete['.$value->id_menu.']" value="Y" /></td>';
			}
			
			$table .= '</tr>';

			$i++;
		}


		$a = array('response' => 'SUKSES', 'hasil' => $table);

		echo json_encode($a);
	}

	function cekPasswordField($nrk)
	{
		$cek = $this->m_admin->cekPassword($nrk);
		if($cek){
            echo json_encode(array("response" => 'MATCH'));
        }else{
            echo json_encode(array("response" => 'NOT MATCH'));
        }

	}

	function getGroup()
	{
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'user_group_id',
			1 => 'nama_group',
			2 => 'status_aktif'	

		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn,\"user_group_id\",\"nama_group\",\"status_aktif\" FROM \"master_user_group\") X ";
		
	
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn,\"user_group_id\",\"nama_group\",\"status_aktif\" FROM \"master_user_group\") X";

		$sql .= " WHERE 1 = 1";

		// getting records as per search parameters
		if( !empty($requestData['search']['value']) ){   //kode nptt
			$sql.=" AND lower(\"nama_group\") LIKE lower('%".$requestData['search']['value']."%') ";
		}
		
		
		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
		$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY \"". $columns[$requestData['order'][0]['column']]."\"   ".$requestData['order'][0]['dir']." ";  // adding length
		
		// var_dump($sql);	
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->user_group_id;
			$nestedData[] = $row->nama_group;
			$sts = $row->status_aktif;
			if($sts=='Y'){
				// $nestedData[] = $row->status_aktif;
				$nestedData[] = "
								<div class='col-sm-4'>
								</div>
								<div class='col-sm-4'>
									<button onclick='change(".$row->user_group_id.")' class='btn btn-xs btn-outline btn-primary'
									data-toggle='modal' data-target='#AddGroup'><i class='fa fa-check'></i></button>
								</div>";
			}else{
				// $nestedData[] = $row->status_aktif;
				$nestedData[] = "
								<div class='col-sm-4'>
								</div>
								<div class='col-sm-4'>
									<button onclick='change(".$row->user_group_id.")' class='btn btn-xs btn-outline btn-warning'
									data-toggle='modal' data-target='#AddGroup'><i class='fa fa-times'></i></button>
								</div>";
			}
				
			
			$data[] = $nestedData;
		}	

		$json_data = array(
					"draw"            => intval( $requestData['draw'] ),   
					"recordsTotal"    => intval( $totalData ),  
					"recordsFiltered" => intval( $totalFiltered ), 
					"data"            => $data   
					);

		echo json_encode($json_data); 
	}

	
	public function SimpanGroup()
	{
		$action = $this->input->post('action');
		$nama_group = $this->input->post('nama_group');
		$status_aktif = $this->input->post('status_aktif');

		if($status_aktif){
				$status = 'Y';
			}else{
				$status = 'T';
			}

		if($action == 'tambah'){

			$cek_group = $this->m_admin->G_group($nama_group);

	        if($cek_group >= 1){
	        	$respone = "ADA";
	        	
	        }else{
	        	$result = $this->m_admin->ins_group($nama_group,$status);
	        	
	        	if($result){
					$respone = "SUKSES";
				}else{
					$respone = "GAGAL";
				}
	        }
		}else{
			$user_group_id = $this->input->post('user_group_id');
			$result = $this->m_admin->edit_group($user_group_id,$status);
			$respone = "SUKSES EDIT";
			
		}
		

        $return = array('responeinsert' => $respone, 'group' => $nama_group);

        echo json_encode($return);
	}

	public function edit_status(){
		$user_group_id = $this->input->post('user_group_id');
		

		$result = $this->m_admin->get_group($user_group_id);
		// $cek = $result->nama_group;
		// var_dump($cek);
		

		if($result){
			$respone = "SUKSES";

			$return = array('respone' => $respone, 'user_group_id' => $result->user_group_id, 'nama_group' => $result->nama_group, 'status_aktif' => $result->status_aktif );

		}else{
			$respone = "GAGAL";

			$return = array('respone' => $respone);
		}
		
		echo json_encode($return);	

	}

	public function ubah_statusGroupo()
	{

		$user_group_id = $this->input->post('user_group_id');
		$group = $this->m_admin->get_group($user_group_id);
		$nama_group = $group->nama_group;
		$status_aktif = $group->status_aktif;

		if($group->status_aktif == 'Y'){
          	$aktif1 = "checked";
          	$aktif2 = "";
		}
        else {
        	$aktif1 = "";
          	$aktif2 = "checked";
        }


		echo '

                <div class="modal-header">
                    <button type="button" id="tutupModal" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3 id="title"><u>Ganti Status Group</u></h3>
                </div>
                <div class="modal-body" >
                    <div class="ibox float-e-margins">                                
                        <div class="ibox-content">
                            <form id="formGroup" class="form-horizontal" action="javascript:changeGroup();" method="POST">
                                <!-- <input type="hidden" name="action" id="action" class="form-control"> -->
                                <input type="hidden" name="user_group_id" id="user_group_id" class="form-control" value="'.$user_group_id.'">                                        
                
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Nama Group</label>
                                    <div class="col-lg-9">
                                        <input type="text" placeholder="Nama Menu" name="nama_group" id="nama_group" class="form-control" value="'.$nama_group.'" readonly>
                                    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Status Group</label>
                                    <div class="col-lg-9">
                                        <div class="i-checks"><label> <input type="radio" '.$aktif1.' value="option1" name="status_aktif"> <i></i> Aktif </label></div>
                                        <div class="i-checks"><label> <input type="radio" '.$aktif2.' value="option1" name="status_aktif"> <i></i> Non Aktif </label></div>
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

            
            


		';
	}

	public function batch()
	{
		$this->load->view('admin/navigation/header');
		$this->load->view('admin/navigation/menu');
		$this->load->view('admin/pph');
		$this->load->view('admin/navigation/footer');
	}
	
}