<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organ_hist extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('hist/V_organ_hist','orhs');

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
			$this->load->view('hist/organ_hist_grid.php');
			$this->load->view('head/footer');			
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'NRK',
			1 => 'DARI',
			2 => 'SBLSSD',
			3 => 'NAORGANI',
			4 => 'KDDUDUK',
			5 => 'SAMPAI',
			6 => 'KOTA',			
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NRK, DARI, SBLSSD, NAORGANI, KDDUDUK,SAMPAI,KOTA, USER_ID, TERM, TG_UPD";
		$sql .= " FROM PERS_ORGAN_HIST) X";		
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		//$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

	$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, 
				PERS_ORGAN_HIST.NRK,
				PERS_ORGAN_HIST.DARI,
				PERS_ORGAN_HIST.SBLSSD,
				PERS_ORGAN_HIST.NAORGANI,
				PERS_KDDUDUK_RPT.KETERANGAN AS KET_KDDUDUK,
				PERS_ORGAN_HIST.SAMPAI,
				PERS_ORGAN_HIST.KOTA";
		$sql .= " FROM PERS_ORGAN_HIST 
				LEFT JOIN PERS_KDDUDUK_RPT ON PERS_ORGAN_HIST.KDDUDUK = PERS_KDDUDUK_RPT.KDDUDUK) X";

		$sql .= " WHERE 0 = 0";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(NRK) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(DARI) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(SBLSSD) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   
			$sql.=" AND lower(NAORGANI) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][4]['search']['value']) ){
			$sql.=" AND lower(KET_KDDUDUK) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}	
		if( !empty($requestData['columns'][5]['search']['value']) ){   
			$sql.=" AND lower(SAMPAI) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}				
		if( !empty($requestData['columns'][6]['search']['value']) ){   
			$sql.=" AND lower(KOTA) LIKE lower('%".$requestData['columns'][6]['search']['value']."%') ";
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
			$nestedData[] = date('d-M-Y', strtotime($row->DARI));	
			$nestedData[] = $row->SBLSSD;			
			$nestedData[] = $row->NAORGANI;
			$nestedData[] = $row->KET_KDDUDUK;
			$nestedData[] = $row->SAMPAI;	
			$nestedData[] = $row->KOTA;
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
												
												<button class='btn btn-success btn-xs' onClick=edit_organhist('".$row->NRK."','".date('d-M-Y', strtotime($row->DARI))."') pull-right>edit</button>									
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=delete_organhist('".$row->NRK."','".date('d-M-Y', strtotime($row->DARI))."') >hapus</button>
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
		//$data['listKdduduk'] = $this->v_organ_hist->getListKdduduk();

		$data = array(
				'NRK' => $this->input->post('nrk'),
				'DARI' => $this->input->post('dari'),
				'SBLSSD' => $this->input->post('sblssd'),
				'NAORGANI' => $this->input->post('naorgani'),
				'KDDUDUK' => $this->input->post('kdduduk'),
				'SAMPAI' => $this->input->post('sampai'),
				'KOTA' => $this->input->post('kota'),
				'user_id'=>$this->user['id'],
				'term'=>'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
			);
		$insert = $this->orhs->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'NRK' => $this->input->post('nrk'),
				'DARI' => $this->input->post('dari'),
				'SBLSSD' => $this->input->post('sblssd'),
				'NAORGANI' => $this->input->post('naorgani'),
				'KDDUDUK' => $this->input->post('kdduduk'),
				'SAMPAI' => $this->input->post('sampai'),
				'KOTA' => $this->input->post('kota'),
				'user_id'=>$this->user['id'],
				'term'=>'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
			);
		$this->orhs->update($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit($id1,$id2)
	{
		$data = $this->orhs->get_by_id($id1,$id2);
		$data->conv = date('d-M-Y',strtotime($data->DARI));
		echo json_encode($data);
	}

	public function ajax_delete($id1,$id2)
	{
		$this->orhs->delete_by_id($id1,$id2);
		echo json_encode(array("status" => TRUE));
	}

	public function getKdduduk()
	{
		$kdduduk = $this->input->post('kdduduk');

		$listKdduduk = $this->orhs->getListKdduduk($kdduduk);
		$arr = array('response' => 'SUKSES', 'listKdduduk' => $listKdduduk);
		echo json_encode($arr);
	}	
}
