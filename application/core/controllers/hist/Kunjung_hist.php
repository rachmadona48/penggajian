<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kunjung_hist extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('hist/v_kunjung_hist','kjhs');

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
			$this->load->view('hist/kunjung_hist_grid.php');
			$this->load->view('head/footer');			
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'NRK',
			1 => 'TGMULAI',
			2 => 'KONEG',
			3 => 'TUJUAN',
			4 => 'TGAKHIR',
			5 => 'MEMBIAYAI',			
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NRK, TGMULAI, KONEG, TUJUAN, TGAKHIR,MEMBIAYAI, USER_ID, TERM, TG_UPD";
		$sql .= " FROM PERS_KUNJUNG_HIST) X";		
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, 
				PERS_KUNJUNG_HIST.NRK,
				PERS_KUNJUNG_HIST.TGMULAI,
				PERS_NEGARA_TBL.NANEG,
				PERS_KUNJUNG_HIST.TUJUAN,
				PERS_KUNJUNG_HIST.TGAKHIR,
				PERS_KUNJUNG_HIST.MEMBIAYAI";
		$sql .= " FROM PERS_KUNJUNG_HIST 
				LEFT JOIN PERS_NEGARA_TBL ON PERS_KUNJUNG_HIST.KONEG = PERS_NEGARA_TBL.KONEG) X";

		$sql .= " WHERE 0 = 0";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(NRK) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(TGMULAI) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(NANEG) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   
			$sql.=" AND lower(TUJUAN) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][4]['search']['value']) ){   
			$sql.=" AND lower(TGAKHIR) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){   
			$sql.=" AND lower(MEMBIAYAI) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
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
			$nestedData[] = date('d-M-Y', strtotime($row->TGMULAI));
			$nestedData[] = $row->NANEG;		
			$nestedData[] = $row->TUJUAN;	
			$nestedData[] = $row->TGAKHIR;
			$nestedData[] = $row->MEMBIAYAI;
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
												
												<button class='btn btn-success btn-xs' onClick=edit_kunjunghist('".$row->NRK."','".date('d-M-Y', strtotime($row->TGMULAI))."') pull-right>edit</button>									
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=delete_kunjunghist('".$row->NRK."','".date('d-M-Y', strtotime($row->TGMULAI))."') >hapus</button>
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
		//$data['listKoneg'] = $this->v_kunjung_hist->getListKoneg();
		$data = array(
				'NRK' => $this->input->post('nrk'),
				'TGMULAI' => $this->input->post('tgmulai'),
				'KONEG' => $this->input->post('koneg'),
				'TUJUAN' => $this->input->post('tujuan'),
				'TGAKHIR' => $this->input->post('tgakhir'),
				'MEMBIAYAI' => $this->input->post('membiayai'),
				'user_id'=>$this->user['id'],
				'term'=>'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
			);
		$insert = $this->kjhs->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'NRK' => $this->input->post('nrk'),
				'TGMULAI' => $this->input->post('tgmulai'),
				'KONEG' => $this->input->post('koneg'),
				'TUJUAN' => $this->input->post('tujuan'),
				'TGAKHIR' => $this->input->post('tgakhir'),
				'MEMBIAYAI' => $this->input->post('membiayai'),
				'user_id'=>$this->user['id'],
				'term'=>'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
			);
		$this->kjhs->update($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit($id,$id2)
	{
		$data = $this->kjhs->get_by_id($id,$id2);
		$data->conv = date('d-M-Y',strtotime($data->TGMULAI));
		echo json_encode($data);
	}

	public function ajax_delete($id,$id2)
	{
		$this->kjhs->delete_by_id($id,$id2);
		echo json_encode(array("status" => TRUE));
	}

	public function getKoneg()
	{
		$koneg = $this->input->post('koneg');

		$listKoneg = $this->kjhs->getListKoneg($koneg);
		$arr = array('response' => 'SUKSES', 'listKoneg' => $listKoneg);
		echo json_encode($arr);
	}
		
}
