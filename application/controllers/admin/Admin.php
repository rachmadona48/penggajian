<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
        $this->load->helper('url');    
        $this->load->library('session');
        $this->load->library('infopegawai');
        $this->load->model('admin/m_admin');
        $this->load->model('admin/v_listuser','mdl');

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

		// echo 'ddddd';
		// print_r($data); exit();

		$data['linkaction'] = base_url().'index.php/admin/admin/menuAction';
		$data['linkaction2'] = base_url().'index.php/admin/admin/menuListAction';
		$data['linkgetmenu'] = base_url().'index.php/admin/admin/getInfoMenu';
		$data['linkdelmenu'] = base_url().'index.php/admin/admin/deleteMenu';
		$datam['act']='1';

		$this->load->view('admin/navigation/header');
		$this->load->view('admin/navigation/menu',$datam);
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
		$datam['act']=2;

		$this->load->view('admin/navigation/header');
		$this->load->view('admin/navigation/menu',$datam);
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

		$datam['act']='3';

		$this->load->view('admin/navigation/header');
		$this->load->view('admin/navigation/menu',$datam);
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

			if ($value->id_menu=='394' || $value->id_menu=='24705' ){
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
		// echo 'dddddd';exit();
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

	public function listuser()
	{
		$ugs = $this->mdl->getUserGroupID();


		
		$namasrc = $this->input->post('namasrc');
		$nrksrc = $this->input->post('nrksrc');
		$koloksrc = $this->input->post('koloksrc');
		
		//$hak_akses = $this->infopegawai->hakAksesModul('16050',$this->user['user_group']);
		$data = array(

			'ugs' => $ugs,
			'koloksrc' => $koloksrc,
			'nrksrc' => $nrksrc,
			'namasrc' => $namasrc,
			'param_cari'=> $this->user['param_cari'],
			
			);

	


		$datam['activemn'] = $this->infopegawai->initialMenu($this->user['user_group'],'listuser',0);
		$datam['inisial'] = 'listuser';

		$datam['act']='4';

		$this->load->view('admin/navigation/header');
		$this->load->view('admin/navigation/menu',$datam);
		$this->load->view('admin/user_grid.php',$data);
		$this->load->view('admin/navigation/footer');
	}


	

	public function data()
	{
		//$hak_akses = $this->infopegawai->hakAksesModul('16050',$this->user['user_group']);
		$requestData = $this->input->post();

		$pjg_input=strlen($requestData['nrk']);

		$columns = array(
			// datatable column index  => database column name
//			0 => 'ROWNUM',
			0 => 'user_id',
			1 => 'user_name',
			2 => 'user_group_id',
			3 => 'user_enable'
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
            $sql.=" OR ( a.\"user_name\" LIKE ('%".$requestData['search']['value']."%')) )";
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
			$ubah='';
			$ubah="";
			if ($this->user['user_group']=='3'){
				
				if($row->user_id == 'adminDKI16'){

					//if ($hak_akses->act_resetpass == 'Y'){
					$html_reset_pass="<div class='col-sm-3' align='center'>
											<button class='btn btn-outline btn-xs btn-warning' data-toggle='tool-tip' title='Reset password pegawai' pull-right onclick='ResetPassword(&#39;".$row->user_id."&#39;)'><i class='fa fa-key'></i></button>
									</div>";
									
								
					}
					else
					{
						$html_reset_pass="<div class='col-sm-3' align='center'>
											<button class='btn btn-outline btn-xs btn-warning' data-toggle='tool-tip' title='Reset password pegawai' pull-right onclick='ResetPassword(&#39;".$row->user_id."&#39;)'><i class='fa fa-key'></i></button>
									</div>";

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
				else if ($this->user['user_group']=='12'){
				
					

					
					$ubah='';
					
						$ubah = "<div class='col-sm-2' align='center'>
												<button class='btn btn-outline btn-xs btn-success' data-toggle='tool-tip' title='edit akun pegawai' pull-right onclick='EditUser(&#39;".$row->user_id."&#39;)'><i class='fa fa-pencil-square'></i></button>
												
											</div>";				
					
				
		
				
				

				$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>
									<div class='row'>
										
										
										$ubah
										
								
										
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