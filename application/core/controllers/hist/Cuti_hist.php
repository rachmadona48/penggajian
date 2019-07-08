<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuti_hist extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('hist/V_cuti_hist','cths');

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
			$this->load->view('hist/cuti_hist_grid.php');
			$this->load->view('head/footer');			
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'NRK',
			1 => 'TMT',
			2 => 'JENCUTI',
			3 => 'TGAKHIR',
			4 => 'NOSK',
			5 => 'TGSK',
			6 => 'PEJTT',			
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NRK, TMT, JENCUTI, TGAKHIR, NOSK, TGSK, PEJTT, USER_ID, TERM, TG_UPD";
		$sql .= " FROM PERS_CUTI_HIST) X";		
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		//$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, 
				PERS_CUTI_HIST.NRK,
				PERS_CUTI_HIST.TMT,
				PERS_JENCUTI_RPT.KETERANGAN AS KET_JENCUTI,
				PERS_CUTI_HIST.TGAKHIR,
				PERS_CUTI_HIST.NOSK,
				PERS_CUTI_HIST.TGSK,
				PERS_PEJTT_RPT.KETERANGAN AS KET_PEJTT";
		$sql .= " FROM PERS_CUTI_HIST 
				LEFT JOIN PERS_JENCUTI_RPT ON PERS_CUTI_HIST.JENCUTI = PERS_JENCUTI_RPT.JENCUTI
				LEFT JOIN PERS_PEJTT_RPT ON PERS_CUTI_HIST.PEJTT = PERS_PEJTT_RPT.PEJTT) X";

		$sql .= " WHERE 0 = 0";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(NRK) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(TMT) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(KET_JENCUTI) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   
			$sql.=" AND lower(TGAKHIR) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][4]['search']['value']) ){   
			$sql.=" AND lower(NOSK) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){   
			$sql.=" AND lower(TGSK) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
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
			$nestedData[] = date('d-M-Y', strtotime($row->TMT));
			$nestedData[] = $row->KET_JENCUTI;	
			$nestedData[] = date('d-M-Y', strtotime($row->TGAKHIR));
			$nestedData[] = $row->NOSK;
			$nestedData[] = date('d-M-Y', strtotime($row->TGSK));
			$nestedData[] = $row->KET_PEJTT;
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
												
										<button class='btn btn-success btn-xs' onClick=edit_cutihist('".$row->NRK."','".date('d-M-Y', strtotime($row->TMT))."') pull-right>edit</button>									
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=delete_cutihist('".$row->NRK."','".date('d-M-Y', strtotime($row->TMT))."') >hapus</button>
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
		//$data['listJencuti'] = $this->cths->getListJencuti();
		//$data['listPejtt'] = $this->adhs->getListPejtt();
		$data = array(
				'NRK' => $this->input->post('nrk'),
				'TMT' => $this->input->post('tmt'),
				'JENCUTI' => $this->input->post('jencuti'),
				'TGAKHIR' => $this->input->post('tgakhir'),
				'NOSK' => $this->input->post('nosk'),
				'TGSK' => $this->input->post('tgsk'),
				'PEJTT' => $this->input->post('pejtt'),
				'user_id'=>$this->user['id'],
				'term'=>'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
			);
		$insert = $this->cths->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'NRK' => $this->input->post('nrk'),
				'TMT' => $this->input->post('tmt'),
				'JENCUTI' => $this->input->post('jencuti'),
				'TGAKHIR' => $this->input->post('tgakhir'),
				'NOSK' => $this->input->post('nosk'),
				'TGSK' => $this->input->post('tgsk'),
				'PEJTT' => $this->input->post('pejtt'),
				'user_id'=>$this->user['id'],
				'term'=>'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
			);
		$this->cths->update($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit($id1,$id2)
	{
		$data = $this->cths->get_by_id($id1,$id2);
		$data->conv = date('d-M-Y',strtotime($data->TMT));
		echo json_encode($data);
	}

	public function ajax_delete($id1,$id2)
	{
		$this->cths->delete_by_id($id1,$id2);
		echo json_encode(array("status" => TRUE));
	}

	public function getJencuti()
	{
		$jencuti = $this->input->post('jencuti');

		$listJencuti = $this->cths->getListJencuti($jencuti);
		$arr = array('response' => 'SUKSES', 'listJencuti' => $listJencuti);
		echo json_encode($arr);
	}

	public function getPejtt()
	{
		$pejtt = $this->input->post('pejtt');

		$listPejtt = $this->cths->getListPejtt($pejtt);
		$arr = array('response' => 'SUKSES', 'listPejtt' => $listPejtt);
		echo json_encode($arr);
	}
		
}
