<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
        $this->load->helper('url');    
        $this->load->model('admin/m_admin');
	}

	public function index()
	{
		$data['temp'] = "";

		$this->load->view('admin/navigation/header');
		$this->load->view('admin/navigation/menu');
		// $this->load->view('admin/home',$data);
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
}