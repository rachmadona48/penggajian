<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kocam extends CI_Controller {

	private $user=array();	

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('master/v_kocam','kcm');
    	//ini_set('memory_limit', '-1'); //set memoru unlimited

    	if ($this->session->userdata('logged_in')) { 
    		$session_data       = $this->session->userdata('logged_in');
            $this->user['id']     	= $session_data['id'];
            $this->user['username']  	= $session_data['username']; 
        }else{
			redirect(base_url().'index.php/login', 'refresh');
		}      
   	}

	public function index()
	{
			$this->load->view('head/header',$this->user);
			$this->load->view('head/menu');
			$this->load->view('master/pers_kocam_grid.php');
			$this->load->view('head/footer');
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'kowil',
			1 => 'kocam',
			2 => 'nacam',
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, kowil, kocam, nacam, user_id, term, tg_upd";
		$sql .= " FROM pers_kocam_tbl) X";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn,kowil, kocam, nacam, user_id, term, tg_upd";
		$sql .= " FROM pers_kocam_tbl) X";

		$sql .= " WHERE 0 = 0";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(kowil) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(kocam) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(nacam) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}			

		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
		$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
		
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->KOWIL;			
			$nestedData[] = $row->KOCAM;
			$nestedData[] = $row->NACAM;
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
												<input type='hidden' name='kowil' id='kowil' value=".$row->KOWIL.">
												<input type='hidden' name='kocam' id='kocam' value='".$row->KOCAM."'>
												<button class='btn btn-success btn-xs' onClick=edit_kocam(".$row->KOWIL.",'".$row->KOCAM."')>edit</button>								
											
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=delete_kocam(".$row->KOWIL.",'".$row->KOCAM."')>hapus</button>
										</div>										
									</div>
								</div>
							</div>
							";			
			
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

	public function ajax_add()
	{
		$data = array(
				'KOWIL' => $this->input->post('kowil'),
				'KOCAM' => $this->input->post('kocam'),
				'NACAM' => $this->input->post('nacam'),
				'user_id'=>$this->user['id'],
				'term'=>'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
			
			);
		$insert = $this->kcm->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'KOWIL' => $this->input->post('kowil'),
				'KOCAM' => $this->input->post('kocam'),
				'NACAM' => $this->input->post('nacam'),
				'user_id'=>$this->user['id'],
				'term'=>'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
			);
		
		$this->kcm->update($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit($id1,$id2)
	{
		$data = $this->kcm->get_by_id($id1,$id2);
		
		echo json_encode($data);
	}

	public function ajax_delete($id1,$id2)
	{
		$this->kcm->delete_by_id($id1,$id2);
		echo json_encode(array("status" => TRUE));
	}


	
		
}
