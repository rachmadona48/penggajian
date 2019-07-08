<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klogad3 extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('master/v_klogad3','klo');

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
			$this->load->view('master/pers_klogad3_grid.php');
			$this->load->view('head/footer');		
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'kolok',
			1 => 'nalok',
			2 => 'spmu',
			3 => 'aktif',
			4 => 'tahun',
			5 => 'kode_unit_sipkd',			
		);

		// getting total number records without any search
		$sql = "SELECT rownum, x.* FROM (SELECT rownum as rn, kolok, nalok, spmu, aktif, tahun, kode_unit_sipkd ";
		$sql .= " FROM pers_klogad3) X";		
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, x.* FROM (SELECT rownum as rn, kolok, nalok, spmu, aktif, tahun, kode_unit_sipkd ";
		$sql .= " FROM pers_klogad3) X";

		$sql .= " WHERE 0 = 0";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(kolok) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][1]['search']['value']) ){  
			$sql.=" AND lower(nalok) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(spmu) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   
			$sql.=" AND lower(aktif) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][4]['search']['value']) ){   
			$sql.=" AND lower(tahun) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){  
			$sql.=" AND lower(kode_unit_sipkd) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
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
			$nestedData[] = $row->NALOK;
			$nestedData[] = $row->SPMU;
			$nestedData[] = $row->AKTIF;
			$nestedData[] = $row->TAHUN;
			$nestedData[] = $row->KODE_UNIT_SIPKD;
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
											
												<input type='hidden' name='klogad3' id='klogad3' value=".$row->KOLOK.">
												<button class='btn btn-success btn-xs' onClick=edit_klogad3('".$row->KOLOK."')>edit</button>								
											
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=delete_klogad3('".$row->KOLOK."') >hapus</button>

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
				'nalok' => $this->input->post('nalok'),
				'spmu' => $this->input->post('spmu'),
				'aktif' => $this->input->post('aktif'),
				'tahun' => $this->input->post('tahun'),
				'kode_unit_sipkd' => $this->input->post('kode_unit_sipkd'),
			);
		$insert = $this->klo->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'kolok' => $this->input->post('kolok'),
				'nalok' => $this->input->post('nalok'),
				'spmu' => $this->input->post('spmu'),
				'aktif' => $this->input->post('aktif'),
				'tahun' => $this->input->post('tahun'),
				'kode_unit_sipkd' => $this->input->post('kode_unit_sipkd'),
			);
		$this->klo->update($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit($id)
	{
		$data = $this->klo->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_delete($id)
	{
		$this->klo->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}
