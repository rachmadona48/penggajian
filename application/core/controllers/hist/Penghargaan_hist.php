<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penghargaan_hist extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('hist/V_penghargaan_hist','hghs');

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
			$this->load->view('hist/penghargaan_hist_grid.php');
			$this->load->view('head/footer');			
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'NRK',
			1 => 'KDHARGA',
			2 => 'TGSK',
			3 => 'NOSK',
			4 => 'ASAL_HRG',
			5 => 'JNASAL',			
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NRK, KDHARGA, TGSK, NOSK, ASAL_HRG, USER_ID, TERM, TG_UPD, JNASAL";
		$sql .= " FROM PERS_PENGHARGAAN) X";		
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		//$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, 
				PERS_PENGHARGAAN.NRK,
				PERS_PENGHARGAAN.KDHARGA,
				PERS_HARGAAN_TBL.NAHARGA,
				PERS_PENGHARGAAN.TGSK,
				PERS_PENGHARGAAN.NOSK,
				PERS_PENGHARGAAN.ASAL_HRG,
				PERS_PENGHARGAAN.JNASAL";
		$sql.= " FROM PERS_PENGHARGAAN 
				LEFT JOIN PERS_HARGAAN_TBL ON PERS_PENGHARGAAN.KDHARGA = PERS_HARGAAN_TBL.KDHARGA) X";

		$sql.= " WHERE 0 = 0";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(NRK) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(NAHARGA) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(TGSK) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   
			$sql.=" AND lower(NOSK) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][4]['search']['value']) ){   
			$sql.=" AND lower(ASAL_HRG) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){   
			$sql.=" AND lower(JNASAL) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}
							

		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
		$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
		
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->NRK;	
			$nestedData[] = $row->NAHARGA;	
			$nestedData[] =  date('d-M-Y', strtotime($row->TGSK));				
			$nestedData[] = $row->NOSK;
			$nestedData[] = $row->ASAL_HRG;
			$nestedData[] = $row->JNASAL;
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
												
												<button class='btn btn-success btn-xs' onClick=edit_penghargaanhist('".$row->NRK."','".$row->KDHARGA."') pull-right>edit</button>									
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=delete_penghargaanhist('".$row->NRK."','".$row->KDHARGA."') >hapus</button>
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
		//$data['listKdharga'] = $this->v_penghargaan_hist->getListKdharga();
		$data = array(
				'NRK' => $this->input->post('nrk'),
				'KDHARGA' => $this->input->post('kdharga'),
				'TGSK' => $this->input->post('tgsk'),
				'NOSK' => $this->input->post('nosk'),
				'ASAL_HRG' => $this->input->post('asal_hrg'),
				'USER_ID'=>$this->user['id'],
				'TERM'=>'LOAD',
				'TG_UPD'=>date('Y-m-d h:i:s'),
				'JNASAL' => $this->input->post('jnasal'),
			);
		$insert = $this->hghs->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'NRK' => $this->input->post('nrk'),
				'KDHARGA' => $this->input->post('kdharga'),
				'TGSK' => $this->input->post('tgsk'),
				'NOSK' => $this->input->post('nosk'),
				'ASAL_HRG' => $this->input->post('asal_hrg'),
				'USER_ID'=>$this->user['id'],
				'TERM'=>'LOAD',
				'TG_UPD'=>date('Y-m-d h:i:s'),
				'JNASAL' => $this->input->post('jnasal'),
			);
		$this->hghs->update($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit($id1,$id2)
	{
		$data = $this->hghs->get_by_id($id1,$id2);
		$data->conv = date('d-M-Y',strtotime($data->TGSK));
		echo json_encode($data);
	}

	public function ajax_delete($id1,$id2)
	{
		$this->hghs->delete_by_id($id1,$id2);
		echo json_encode(array("status" => TRUE));
	}
		
	public function getKdharga()
	{
		$kdharga = $this->input->post('kdharga');

		$listKdharga = $this->hghs->getListKdharga($kdharga);
		$arr = array('response' => 'SUKSES', 'listKdharga' => $listKdharga);
		echo json_encode($arr);
	}
}
