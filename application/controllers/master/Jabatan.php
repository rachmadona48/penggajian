<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->model('v_pers_duk');
   	}

	public function index()
	{		
		$this->load->view('head/header');
		$this->load->view('head/menu');
		$this->load->view('master/jabatan.php');
		$this->load->view('head/footer');	
	}	

	public function data_jabatan()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 =>'nrk', 
			1 => 'thbl',
			2 => 'kolok',
			3 => 'kojab',
			4 => 'stapeg'
		);

		// getting total number records without any search
		$sql = "SELECT nrk, thbl, kolok, kojab, stapeg ";
		$sql .= " FROM pers_duk_pangkat_hist";		
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT nrk, thbl, kolok, kojab, stapeg ";
		$sql .= " FROM pers_duk_pangkat_hist";

		$sql .= " WHERE 1 = 1";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   //name
			$sql.=" AND nrk LIKE '".$requestData['columns'][0]['search']['value']."%' ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){  //salary
			$sql.=" AND kolok LIKE '".$requestData['columns'][2]['search']['value']."%' ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){ //age
			$sql.=" AND kojab LIKE '".$requestData['columns'][3]['search']['value']."%' ";
		}

		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['length']." OFFSET ".$requestData['start']." ";  // adding length
		
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->nrk;
			$nestedData[] = $row->thbl;
			$nestedData[] = $row->kolok;
			$nestedData[] = $row->kojab;
			$nestedData[] = $row->stapeg;
			
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

	public function doadd()
	{				
		$data['example'] = "Example";
		$this->load->view('head/header');
		$this->load->view('head/menu');
		$this->load->view('master/jabatan_form.php',$data);
		$this->load->view('head/footer');	
	}

	public function doedit($nrk)
	{		
		$datapegawai = $this->v_pers_duk->get_pers_duk_pangkat_hist($nrk)->row();
		$count = count($datapegawai);
		$data['count'] = $count;
		if($count){
			foreach ($datapegawai as $key => $value) {
			
				$data[$key] = $value;
			
			}
		}		

		$this->load->view('head/header');
		$this->load->view('head/menu');
		$this->load->view('jabatan_form.php',$data);
		$this->load->view('head/footer');	
	}
		
}
