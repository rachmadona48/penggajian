<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends CI_Controller {

	private $user=array();	

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('master/v_lokasi','lks');
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
			$this->load->view('master/pers_lokasi_tbl_grid.php');
			$this->load->view('head/footer');
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'kolok',
			1 => 'naloks',
			2 => 'nalokl',
			3 => 'koras',
			4 => 'makan_ins',
			5 => 'tahun',
			6 => 'aktif',
			7 => 'kode_unit_sipkd',
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, kolok, naloks, nalokl, koras,makan_ins,user_id,term,tg_upd,tahun,aktif,kode_unit_sipkd";
		$sql .= " FROM pers_lokasi_tbl) X";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, kolok, naloks, nalokl, koras,makan_ins,user_id,term,tg_upd,tahun,aktif,kode_unit_sipkd";
		$sql .= " FROM pers_lokasi_tbl) X";

		$sql .= " WHERE 0 = 0";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(kolok) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(naloks) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(nalokl) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){  
			$sql.=" AND lower(koras) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][4]['search']['value']) ){  
			$sql.=" AND lower(makan_ins) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){   
			$sql.=" AND lower(tahun) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][6]['search']['value']) ){   
			$sql.=" AND lower(aktif) LIKE lower('%".$requestData['columns'][6]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][7]['search']['value']) ){  
			$sql.=" AND lower(kode_unit_sipkd) LIKE lower('%".$requestData['columns'][7]['search']['value']."%') ";
		}
					

		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
		$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
		
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->KOLOK;			
			$nestedData[] = $row->NALOKS;
			$nestedData[] = $row->NALOKL;			
			$nestedData[] = $row->KORAS;
			$nestedData[] = $row->MAKAN_INS;
			$nestedData[] = $row->TAHUN;			
			$nestedData[] = $row->AKTIF;
			$nestedData[] = $row->KODE_UNIT_SIPKD;
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
												<input type='hidden' name='kolok' id='kolok' value='".$row->KOLOK."'>
												<button class='btn btn-success btn-xs' onClick=edit_lokasi('".$row->KOLOK."')>edit</button>								
											</form>
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=delete_lokasi('".$row->KOLOK."') >hapus</button>
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
				'kolok' => $this->input->post('kolok'),
				'naloks' => $this->input->post('naloks'),
				'nalokl' => $this->input->post('nalokl'),
				'koras' => $this->input->post('koras'),
				'makan_ins' => $this->input->post('makan_ins'),
				'user_id'=>$this->user['id'],
				'term'=>'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
				'tahun' => $this->input->post('tahun'),
				'aktif'=>$this->input->post('aktif'),
				'kode_unit_sipkd' => $this->input->post('kode_unit_sipkd'),
			);
		$insert = $this->lks->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'kolok' => $this->input->post('kolok'),
				'naloks' => $this->input->post('naloks'),
				'nalokl' => $this->input->post('nalokl'),
				'koras' => $this->input->post('koras'),
				'makan_ins' => $this->input->post('makan_ins'),
				'user_id'=>$this->user['id'],
				'term'=>'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
				'tahun' => $this->input->post('tahun'),
				'aktif'=>$this->input->post('aktif'),
				'kode_unit_sipkd' => $this->input->post('kode_unit_sipkd'),
			);
		//$this->agm->update(array('agama' => $this->input->post('agama')), $data);
		$this->lks->update($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit($id)
	{
		$data = $this->lks->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_delete_tbl($id)
	{
		$this->lks->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	/** lokasi RPT **/

	
		
}
