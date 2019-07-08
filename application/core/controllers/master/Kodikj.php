<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kodikj extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('master/v_kodikj','kds');

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
			$this->load->view('master/pers_kodikj_struktural_grid.php');
			$this->load->view('head/footer');		
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'kodikj',
			1 => 'keterangan',			
		);

		// getting total number records without any search
		$sql = "SELECT rownum, x.* FROM (SELECT rownum as rn, kodikj, keterangan, tg_upd ";
		$sql .= " FROM pers_kodikj_rpt) X";		
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, x.* FROM (SELECT rownum as rn, kodikj, keterangan, tg_upd ";
		$sql .= " FROM pers_kodikj_rpt) X";

		$sql .= " WHERE 0 = 0";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(kodikj) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][1]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(keterangan) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}		

		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
		$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length

		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->KODIKJ;
			$nestedData[] = $row->KETERANGAN;			
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
											
												<input type='hidden' name='kodikj' id='kodikj' value=".$row->KODIKJ.">
												<button class='btn btn-success btn-xs' onClick=edit_kodikj('".$row->KODIKJ."')>edit</button>								
											
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=delete_kodikj('".$row->KODIKJ."') >hapus</button>

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
				'kodikj' => $this->kds->getnextval(),
				'keterangan' => $this->input->post('keterangan'),
				'tg_upd'=>date('Y-m-d h:i:s'),
			);
		$insert = $this->kds->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'kodikj' => $this->input->post('kodikj'),
				'keterangan' => $this->input->post('keterangan'),
				'tg_upd'=>date('Y-m-d h:i:s'),
			);

		$this->kds->update($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit($id)
	{
		$data = $this->kds->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_delete($id)
	{
		$this->kds->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}