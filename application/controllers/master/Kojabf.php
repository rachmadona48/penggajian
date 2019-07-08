<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kojabf extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('master/v_kojabf');

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
			$this->load->view('master/pers_kojabf_tbl_grid.php');
			$this->load->view('head/footer');	
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'kojab',
			1 => 'kdsort',
			2 => 'najabs',
			3 => 'najabl',
			4 => 'tunfung',
			5 => 'job_class1',
			6 => 'job_class2',
			7 => 'point_207',
			8 => 'tunjab',
			9 => 'peringkat',
			10 => 'point',
			11 => 'tahap1',
			12 => 'tahap2',
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, kojab,kdsort, najabs, najabl, tunfung,user_id, term, tg_upd,job_class1, job_class2, point_207,tunjab,peringkat,point,tahap1,tahap2";
		$sql .= " FROM pers_kojabf_tbl) X";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, kojab,kdsort, najabs, najabl, tunfung,user_id, term, tg_upd,job_class1, job_class2, point_207,tunjab,peringkat,point,tahap1,tahap2";
		$sql .= " FROM pers_kojabf_tbl) X";

		$sql .= " WHERE 0 = 0";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(kojab) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(kdsort) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(najabs) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){  
			$sql.=" AND lower(najabl) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][4]['search']['value']) ){   
			$sql.=" AND lower(tunfung) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){   
			$sql.=" AND lower(job_class1) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][6]['search']['value']) ){   
			$sql.=" AND lower(job_class2) LIKE lower('%".$requestData['columns'][6]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][7]['search']['value']) ){   
			$sql.=" AND lower(point_207) LIKE lower('%".$requestData['columns'][7]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][8]['search']['value']) ){   
			$sql.=" AND lower(tunjab) LIKE lower('%".$requestData['columns'][8]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][9]['search']['value']) ){  
			$sql.=" AND lower(peringkat) LIKE lower('%".$requestData['columns'][9]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][10]['search']['value']) ){   
			$sql.=" AND lower(point) LIKE lower('%".$requestData['columns'][10]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][11]['search']['value']) ){   
			$sql.=" AND lower(tahap1) LIKE lower('%".$requestData['columns'][11]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][12]['search']['value']) ){   
			$sql.=" AND lower(tahap2) LIKE lower('%".$requestData['columns'][12]['search']['value']."%') ";
		}
		
		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
		$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 	
			$nestedData[] = $row->KOJAB;			
			$nestedData[] = $row->KDSORT;
			$nestedData[] = $row->NAJABS;	
			$nestedData[] = $row->NAJABL;			
			$nestedData[] = $row->TUNFUNG;
			$nestedData[] = $row->JOB_CLASS1;	
			$nestedData[] = $row->JOB_CLASS2;			
			$nestedData[] = $row->POINT_207;		
			$nestedData[] = $row->TUNJAB;
			$nestedData[] = $row->PERINGKAT;	
			$nestedData[] = $row->POINT;			
			$nestedData[] = $row->TAHAP1;		
			$nestedData[] = $row->TAHAP2;							
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
											<form method='post' action='".base_url()."/index.php/master/kojabf/doedit'>
												<input type='hidden' name='kojab' id='kojab' value='".$row->KOJAB."'>
												<button class='btn btn-success btn-xs' type='submit' pull-right>edit</button>								
											</form>
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=hapusData('".$row->KOJAB."','".base_url()."/index.php/master/kojabf/dohapusaction') >hapus</button>
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

	public function doadd()
	{			
		$data['aksi'] = 'add';
		$data['linkaction'] = base_url().'index.php/master/kojabf/doaddaction';

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('master/pers_kojabf_tbl_form.php',$data);
			$this->load->view('head/footer');
		}

	public function doaddaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_kojabf->insertData($data);	

		$linkback = base_url().'index.php/master/kojabf/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function doedit()
	{	

		$data['aksi'] = 'edit';
		if($this->input->post('kojab') ){
			$id = $this->input->post('kojab');
		}else{
			return $this->index();
		}

		$listdata = $this->v_kojabf->get_data($id)->row();
		

		$count = count($listdata);
		$data['count'] = $count;
		if($count){
			foreach ($listdata as $key => $value) {
			
				$data[$key] = $value;
			
			}
		}
		
		$data['linkaction'] = base_url().'index.php/master/kojabf/doeditaction';
		
			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('master/pers_kojabf_tbl_form.php',$data);
			$this->load->view('head/footer');	

	}

	public function doeditaction(){
		$data = $this->input->post();
		$hsl = $this->v_kojabf->updateData($data);	

		$linkback = base_url().'index.php/master/kojabf/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function dohapusaction()
	{	

		if($this->input->post('kojab')){
			$id = $this->input->post('kojab');
		}else{
			return $this->index();
		}

		$hsl = $this->v_kojabf->hapusData($id);
		
		$linkback = base_url().'index.php/master/kojabf/';
		if($hsl){
			$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		}else{
			$a = array('response' => 'GAGAL', 'hasil' => $hsl, 'linkback' => $linkback);
		}

		echo json_encode($a);
	}

}
		