<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_hist extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('hist/V_admin_hist','adhs');

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
			$this->load->view('hist/admin_hist_grid.php');
			$this->load->view('head/footer');		
				
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'NRK',
			1 => 'TGSK',
			2 => 'NOSK',
			3 => 'JENHUKADM',
			4 => 'PEJTT',			
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NRK, TGSK, NOSK, JENHUKADM, PEJTT, USER_ID, TERM, TG_UPD";
		$sql .= " FROM PERS_ADMIN_HIST) X";		
		
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, 
				PERS_ADMIN_HIST.NRK,
				PERS_ADMIN_HIST.TGSK,
				PERS_ADMIN_HIST.NOSK,
				PERS_JENHUKADM_RPT.KETERANGAN AS JENHUK_KET,
				PERS_PEJTT_RPT.KETERANGAN AS PEJTT_KET,
				PERS_ADMIN_HIST.USER_ID,
				PERS_ADMIN_HIST.TERM,
				PERS_ADMIN_HIST.TG_UPD ";
		$sql .= " FROM PERS_ADMIN_HIST LEFT JOIN PERS_JENHUKADM_RPT ON PERS_ADMIN_HIST.JENHUKADM = PERS_JENHUKADM_RPT.JENHUKADM
			LEFT JOIN PERS_PEJTT_RPT ON PERS_ADMIN_HIST.PEJTT = PERS_PEJTT_RPT.PEJTT) X";

		$sql.=" WHERE 0=0 "; 
		
		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(NRK) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(TGSK) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(NOSK) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   	
			$sql.=" AND lower(JENHUK_KET) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][4]['search']['value']) ){   
			$sql.=" AND lower(PEJTT_KET) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
			
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
			$nestedData[] = date('d-M-Y', strtotime($row->TGSK));	
			$nestedData[] = $row->NOSK;			
			$nestedData[] = $row->JENHUK_KET;
			$nestedData[] = $row->PEJTT_KET;
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
											<button class='btn btn-success btn-xs' onClick=edit_adminhist('".$row->NRK."','".date('d-M-Y', strtotime($row->TGSK))."') pull-right>edit</button>									
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=delete_adminhist('".$row->NRK."','".date('d-M-Y', strtotime($row->TGSK))."') >hapus</button>
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
				'NRK' => $this->input->post('nrk'),
				'TGSK' => $this->input->post('tgsk'),
				'NOSK' => $this->input->post('nosk'),
				'JENHUKADM' => $this->input->post('jenhukadm'),
				'PEJTT' => $this->input->post('pejtt'),
				'user_id'=>$this->user['id'],
				'term'=>'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
			);
	 

		$insert = $this->adhs->save($data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'NRK' => $this->input->post('nrk'),
				'TGSK' => $this->input->post('tgsk'),
				'NOSK' => $this->input->post('nosk'),
				'JENHUKADM' => $this->input->post('jenhukadm'),
				'PEJTT' => $this->input->post('pejtt'),
				'user_id'=>$this->user['id'],
				'term'=>'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
			);

		$this->adhs->update($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit($id,$id2)
	{
		$data = $this->adhs->get_by_id($id,$id2);
		$data->conv = date('d-M-Y',strtotime($data->TGSK));	
		echo json_encode($data);
	}

	public function ajax_delete($id,$id2)
	{
		$this->adhs->delete_by_id($id,$id2);
		echo json_encode(array("status" => TRUE));
	}

	public function getJenhukadm()
	{
		$jenhukadm = $this->input->post('jenhukadm');

		$listJenhukadm = $this->adhs->getListJenhukadm($jenhukadm);
		$arr = array('response' => 'SUKSES', 'listJenhukadm' => $listJenhukadm);
		echo json_encode($arr);
	}
	
	public function getPejtt()
	{
		$pejtt = $this->input->post('pejtt');

		$listPejtt = $this->adhs->getListPejtt($pejtt);
		$arr = array('response' => 'SUKSES', 'listPejtt' => $listPejtt);
		echo json_encode($arr);
	}
}
