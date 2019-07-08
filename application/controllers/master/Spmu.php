<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spmu extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('master/v_spmu','spm');

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
			$this->load->view('master/pers_spmu_grid.php');
			$this->load->view('head/footer');		
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'kode_spm',
			1 => 'nama',
			2 => 'klogad_induk',
			3 => 'tahun',	
			4 => 'kdsort',				
		);

		// getting total number records without any search
		$sql = "SELECT rownum, x.* FROM (SELECT rownum as rn, kode_spm, nama, klogad_induk,tahun,kdsort";
		$sql .= " FROM pers_tabel_spmu) X";		
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, x.* FROM (SELECT rownum as rn, kode_spm, nama, klogad_induk, tahun, kdsort";
		$sql .= " FROM pers_tabel_spmu) X";

		$sql .= " WHERE 0 = 0";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(kode_spm) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(nama) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){  
			$sql.=" AND lower(klogad_induk) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   
			$sql.=" AND lower(tahun) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][4]['search']['value']) ){   
			$sql.=" AND lower(kdsort) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}			

		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
		$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length

		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->KODE_SPM;
			$nestedData[] = $row->NAMA;
			$nestedData[] = $row->KLOGAD_INDUK;
			$nestedData[] = $row->TAHUN;
			$nestedData[] = $row->KDSORT;			
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
											
												<input type='hidden' name='kode_spm' id='kode_spm' value=".$row->KODE_SPM.">
												<button class='btn btn-success btn-xs' onClick=edit_spmu('".$row->KODE_SPM."')>edit</button>								
											
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=delete_spmu('".$row->KODE_SPM."') >hapus</button>

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
				'kode_spm' => $this->input->post('kode_spm'),
				'nama' => $this->input->post('nama'),
				'klogad_induk' => $this->input->post('klogad_induk'),
				'tahun' => $this->input->post('tahun'),
				'kdsort' => $this->input->post('kdsort'),
				'tg_upd'=>date('Y-m-d h:i:s'),
			);
		$insert = $this->spm->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'kode_spm' => $this->input->post('kode_spm'),
				'nama' => $this->input->post('nama'),
				'klogad_induk' => $this->input->post('klogad_induk'),
				'tahun' => $this->input->post('tahun'),
				'kdsort' => $this->input->post('kdsort'),
				'tg_upd'=>date('Y-m-d h:i:s'),
			);
		//$this->spm->update(array('spmu' => $this->input->post('spmu')), $data);
		$this->spm->update($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit($id)
	{
		$data = $this->spm->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_delete($id)
	{
		$this->spm->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}
