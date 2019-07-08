<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disiplin_hist extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('hist/V_disiplin_hist','dshs');

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
			$this->load->view('hist/disiplin_hist_grid.php');
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
			3 => 'JENHUKDIS',
			4 => 'TGMULAI',
			5 => 'TGAKHIR',
			6 => 'PEJTT',			
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NRK, TGSK, NOSK, JENHUKDIS,TGMULAI, TGAKHIR, PEJTT, USER_ID, TERM, TG_UPD";
		$sql .= " FROM PERS_DISIPLIN_HIST) X";		
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, 
				PERS_DISIPLIN_HIST.NRK,
				PERS_DISIPLIN_HIST.TGSK,
				PERS_DISIPLIN_HIST.NOSK,
				PERS_JENHUKDIS_RPT.KETERANGAN AS KET_JENHUKDIS,
				PERS_DISIPLIN_HIST.TGMULAI,
				PERS_DISIPLIN_HIST.TGAKHIR,
				PERS_PEJTT_RPT.KETERANGAN AS KET_PEJTT";
		$sql .= " FROM PERS_DISIPLIN_HIST 
				LEFT JOIN PERS_JENHUKDIS_RPT ON PERS_DISIPLIN_HIST.JENHUKDIS = PERS_JENHUKDIS_RPT.JENHUKDIS
				LEFT JOIN PERS_PEJTT_RPT ON PERS_DISIPLIN_HIST.PEJTT = PERS_PEJTT_RPT.PEJTT) X";

		$sql .= " WHERE 0 = 0";

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
			$sql.=" AND lower(KET_JENHUKDIS) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][4]['search']['value']) ){   
			$sql.=" AND lower(TGMULAI) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){   
			$sql.=" AND lower(TGAKHIR) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][6]['search']['value']) ){   
			$sql.=" AND lower(KET_PEJTT) LIKE lower('%".$requestData['columns'][6]['search']['value']."%') ";
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
			$nestedData[] = $row->KET_JENHUKDIS;
			$nestedData[] = $row->TGMULAI;
			$nestedData[] = $row->TGAKHIR;	
			$nestedData[] = $row->KET_PEJTT;
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
												
												<button class='btn btn-success btn-xs' onClick=edit_disiplinhist('".$row->NRK."','".date('d-M-Y', strtotime($row->TGSK))."') pull-right>edit</button>									
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=delete_disiplinhist('".$row->NRK."','".date('d-M-Y', strtotime($row->TGSK))."') >hapus</button>
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
		//$data['listJenhukdis'] = $this->v_disiplin_hist->getListJenhukdis();
		//$data['listPejtt'] = $this->v_disiplin_hist->getListPejtt();
		$data = array(
				'NRK' => $this->input->post('nrk'),
				'TGSK' => $this->input->post('tgsk'),
				'NOSK' => $this->input->post('nosk'),
				'JENHUKDIS' => $this->input->post('jenhukdis'),
				'TGMULAI' => $this->input->post('tgmulai'),
				'TGAKHIR' => $this->input->post('tgakhir'),
				'PEJTT' => $this->input->post('pejtt'),
				'user_id'=>$this->user['id'],
				'term'=>'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
			);
		$insert = $this->dshs->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'NRK' => $this->input->post('nrk'),
				'TGSK' => $this->input->post('tgsk'),
				'NOSK' => $this->input->post('nosk'),
				'JENHUKDIS' => $this->input->post('jenhukdis'),
				'TGMULAI' => $this->input->post('tgmulai'),
				'TGAKHIR' => $this->input->post('tgakhir'),
				'PEJTT' => $this->input->post('pejtt'),
				'user_id'=>$this->user['id'],
				'term'=>'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
			);
		$this->dshs->update($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit($id,$id2)
	{
		$data = $this->dshs->get_by_id($id,$id2);
		$data->conv = date('d-M-Y',strtotime($data->TGSK));
		echo json_encode($data);
	}

	public function ajax_delete($id,$id2)
	{
		$this->dshs->delete_by_id($id,$id2);
		echo json_encode(array("status" => TRUE));
	}

	public function getJenhukdis()
	{
		$jenhukdis = $this->input->post('jenhukdis');

		$listJenhukdis = $this->dshs->getListJenhukdis($jenhukdis);
		$arr = array('response' => 'SUKSES', 'listJenhukdis' => $listJenhukdis);
		echo json_encode($arr);
	}

	public function getPejtt()
	{
		$pejtt = $this->input->post('pejtt');

		$listPejtt = $this->dshs->getListPejtt($pejtt);
		$arr = array('response' => 'SUKSES', 'listPejtt' => $listPejtt);
		echo json_encode($arr);
	}
		
}
