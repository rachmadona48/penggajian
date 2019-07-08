<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eselon extends CI_Controller {

	private $user=array();	

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('master/v_eselon','esl');
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
			$this->load->view('master/pers_eselon_tbl_grid.php');
			$this->load->view('head/footer');
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'ESELON',
			1 => 'NESELON',
			2 => 'CETAKAN',
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, eselon, neselon, user_id, term, tg_upd, cetakan ";
		$sql .= " FROM pers_eselon_tbl) X";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, eselon, neselon, user_id, term, tg_upd, cetakan ";
		$sql .= " FROM pers_eselon_tbl) X";

		$sql .= " WHERE 0 = 0";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(eselon) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][1]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(neselon) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(cetakan) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}			

		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
		$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
		
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->ESELON;			
			$nestedData[] = $row->NESELON;
			$nestedData[] = $row->CETAKAN;
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
												<input type='hidden' name='eselon' id='eselon' value='".$row->ESELON."'>
												<button class='btn btn-success btn-xs' onClick=edit_eselon_tbl('".$row->ESELON."')>edit</button>								
											</form>
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=delete_eselon_tbl('".$row->ESELON."') >hapus</button>
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

	public function ajax_add_tbl()
	{
		$data = array(
				'eselon' => $this->input->post('eselon'),
				'neselon' => $this->input->post('neselon'),
				'user_id'=>$this->user['id'],
				'term'=>'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
				'cetakan'=>$this->input->post('cetakan'),
			);
		$insert = $this->esl->save_tbl($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update_tbl()
	{
		$data = array(
				'eselon' => $this->input->post('eselon'),
				'neselon' => $this->input->post('neselon'),
				'user_id'=>$this->user['id'],
				'term'=>'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
				'cetakan'=>$this->input->post('cetakan'),
			);
		//$this->agm->update(array('agama' => $this->input->post('agama')), $data);
		$this->esl->update_tbl($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit_tbl($id)
	{
		$data = $this->esl->get_by_id_tbl($id);
		echo json_encode($data);
	}

	public function ajax_delete_tbl($id)
	{
		$this->esl->delete_by_id_tbl($id);
		echo json_encode(array("status" => TRUE));
	}


	/** ESELON RPT **/

	public function rpt()
	{		
		$this->load->view('head/header',$this->user);
		$this->load->view('head/menu');
		$this->load->view('master/pers_eselon_rpt_grid.php');
		$this->load->view('head/footer');
	}

	public function datarpt()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'ESELON',
			1 => 'GOLONGAN'
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, ESELON, GOLONGAN, USER_ID, TERM, TG_UPD ";
		$sql .= " FROM PERS_ESELON_RPT) X";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, x.* FROM (SELECT rownum as rn, ESELON, GOLONGAN, USER_ID, TERM, TG_UPD ";
		$sql .= " FROM PERS_ESELON_RPT) X";

		$sql .= " WHERE 0 = 0";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(eselon) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][1]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(neselon) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}		

		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
		$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
		
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->ESELON;
			$nestedData[] = $row->GOLONGAN;
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
											<input type='hidden' name='eselon' id='eselon' value=".$row->ESELON.">
											<button class='btn btn-success btn-xs' onClick=edit_eselon_rpt('".$row->ESELON."')>edit</button>								
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=delete_eselon_rpt('".$row->ESELON."') >hapus</button>
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

	public function ajax_add_rpt()
	{
		$data = array(
				'eselon' => $this->input->post('eselon'),
				'golongan' => $this->input->post('golongan'),
				'tg_upd'=>date('Y-m-d h:i:s'),
				'user_id'=>$this->user['id'],
				'term'=>'1234',
			);
		$insert = $this->esl->save_rpt($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update_rpt()
	{
		$data = array(
				'eselon' => $this->input->post('eselon'),
				'golongan' => $this->input->post('golongan'),
				'tg_upd'=>date('Y-m-d h:i:s'),
				'user_id'=>$this->user['id'],
				'term'=>'1234',
			);
		//$this->agm->update(array('agama' => $this->input->post('agama')), $data);
		$this->esl->update_rpt($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit_rpt($id)
	{
		$data = $this->esl->get_by_id_rpt($id);
		echo json_encode($data);
	}

	public function ajax_delete_rpt($id)
	{
		$this->esl->delete_by_id_rpt($id);
		echo json_encode(array("status" => TRUE));
	}
		
}
