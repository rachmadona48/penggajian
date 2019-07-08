<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gapok extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('master/v_gapok','gpk');

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
			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('master/pers_gaji_pokok_tbl_grid.php');
			$this->load->view('head/footer');	
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'kopang',
			1 => 'ttmasker',
			2 => 'bbmasker',
			3 => 'gapok'
			
		);

		// getting total number records without any search
		$sql = "SELECT rownum, x.* FROM (SELECT rownum as rn, kopang, ttmasker, bbmasker, gapok";
		$sql .= " FROM PERS_GAPOK_TBL) X";		
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, x.* FROM (SELECT rownum as rn, kopang, ttmasker, bbmasker, gapok";
		$sql .= " FROM PERS_GAPOK_TBL) X";

		$sql .= " WHERE 1 = 1";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   //kode kopang
			$sql.=" AND lower(kopang) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][1]['search']['value']) ){   //kode ttmasker
			$sql.=" AND lower(ttmasker) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   //bbmasker
			$sql.=" AND lower(bbmasker) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   //gapok
			$sql.=" AND lower(gapok) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}
				
		
		$query= $this->db->query($sql);
		
		$totalFiltered = $query->num_rows();	
		
		$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
		
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->KOPANG;
			$nestedData[] = $row->TTMASKER;
			$nestedData[] = $row->BBMASKER;
			$nestedData[] = $row->GAPOK;
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
												<input type='hidden' name='kopang' id='kopang' value='".$row->KOPANG."'>
												<input type='hidden' name='ttmasker' id='ttmasker' value=".$row->TTMASKER.">
												<input type='hidden' name='bbmasker' id='bbmasker' value=".$row->BBMASKER.">
												<button class='btn btn-success btn-xs' onClick=edit_gapok('".$row->KOPANG."',".$row->TTMASKER.",".$row->BBMASKER.") pull-right>edit</button>								
											
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=delete_gapok('".$row->KOPANG."',".$row->TTMASKER.",".$row->BBMASKER.") >hapus</button>
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
				'KOPANG' => $this->input->post('kopang'),
				'TTMASKER' => $this->input->post('ttmasker'),
				'BBMASKER' => $this->input->post('bbmasker'),
				'GAPOK' => $this->input->post('gapok'),
				'user_id' => $this->user['id'],
				'term' => 'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
			);
		$insert = $this->gpk->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'KOPANG' => $this->input->post('kopang'),
				'TTMASKER' => $this->input->post('ttmasker'),
				'BBMASKER' => $this->input->post('bbmasker'),
				'GAPOK' => $this->input->post('gapok'),
				'user_id' => $this->user['id'],
				'term' => 'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
			);
		$this->gpk->update($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit($id1,$id2,$id3)
	{
		$data = $this->gpk->get_by_id($id1,$id2,$id3);
		echo json_encode($data);
	}

	public function ajax_delete($id1,$id2,$id3)
	{
		$this->gpk->delete_by_id($id1,$id2,$id3);
		echo json_encode(array("status" => TRUE));
	}
		
}
