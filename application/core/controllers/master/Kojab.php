<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kojab extends CI_Controller {

	private $user=array();
	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('master/v_kojab');

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
			$this->load->view('master/pers_kojab_tbl_grid.php');
			$this->load->view('head/footer');	
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'kolok',
			1 => 'kojab',
			2 => 'kdsort',
			3 => 'najabs',
			4 => 'najabl',
			5 => 'eselon',
			6 => 'job_class1',
			7 => 'job_class2',
			8 => 'kolok_sektoral',
			9 => 'point',
			10 => 'tahun',
			11 => 'aktif',
			12 => 'tunjab',
			13 => 'sementara',
			14 => 'kdtrans',
			15 => 'transport'
		);

		// getting total number records without any search
		$sql = "SELECT rownum, x.* FROM (SELECT rownum as rn, KOLOK, KOJAB, KDSORT, NAJABS, NAJABL, ESELON ,USER_ID, TERM, TG_UPD, JOB_CLASS1, JOB_CLASS2, KOLOK_SEKTORAL, POINT, TAHUN, AKTIF, TUNJAB, SEMENTARA, KDTRANS ,TRANSPORT";
		$sql .= " FROM PERS_KOJAB_TBL) X";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, x.* FROM (SELECT rownum as rn, KOLOK, KOJAB, KDSORT, NAJABS, NAJABL, ESELON ,USER_ID, TERM, TG_UPD, JOB_CLASS1, JOB_CLASS2, KOLOK_SEKTORAL, POINT, TAHUN, AKTIF, TUNJAB, SEMENTARA, KDTRANS ,TRANSPORT";
		$sql .= " FROM PERS_KOJAB_TBL) X";

		$sql .= " WHERE 0 = 0";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(kolok) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][1]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(kojab) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(kdsort) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(najabs) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][4]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(najabl) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(eselon) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][6]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(job_class1) LIKE lower('%".$requestData['columns'][6]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][7]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(job_class2) LIKE lower('%".$requestData['columns'][7]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][8]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(kolok_sektoral) LIKE lower('%".$requestData['columns'][8]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][9]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(point) LIKE lower('%".$requestData['columns'][9]['search']['value']."%') ";
		}			
		if( !empty($requestData['columns'][10]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(tahun) LIKE lower('%".$requestData['columns'][10]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][11]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(aktif) LIKE lower('%".$requestData['columns'][11]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][12]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(tunjab) LIKE lower('%".$requestData['columns'][12]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][13]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(sementara) LIKE lower('%".$requestData['columns'][13]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][14]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(kdtrans) LIKE lower('%".$requestData['columns'][14]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][15]['search']['value']) ){   //kode universitas
			$sql.=" AND lower(transport) LIKE lower('%".$requestData['columns'][15]['search']['value']."%') ";
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
			$nestedData[] = $row->KOJAB;			
			$nestedData[] = $row->KDSORT;
			$nestedData[] = $row->NAJABS;	
			$nestedData[] = $row->NAJABL;			
			$nestedData[] = $row->ESELON;
			$nestedData[] = $row->JOB_CLASS1;	
			$nestedData[] = $row->JOB_CLASS2;			
			$nestedData[] = $row->KOLOK_SEKTORAL;
			$nestedData[] = $row->POINT;	
			$nestedData[] = $row->TAHUN;
			$nestedData[] = $row->AKTIF;	
			$nestedData[] = $row->TUNJAB;			
			$nestedData[] = $row->SEMENTARA;
			$nestedData[] = $row->KDTRANS;	
			$nestedData[] = $row->TRANSPORT;			
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
											<form method='post' action='".base_url()."/index.php/master/kojab/doedit'>
												<input type='hidden' name='kolok' id='kolok' value='".$row->KOLOK."'>
												<input type='hidden' name='kojab' id='kojab' value='".$row->KOJAB."'>
												<button class='btn btn-success btn-xs' type='submit' pull-right>edit</button>								
											</form>
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=hapusData('".$row->KOLOK."','".$row->KOJAB."','".base_url()."/index.php/master/kojab/dohapusaction') >hapus</button>
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
		$data['linkaction'] = base_url().'index.php/master/kojab/doaddaction';

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('master/pers_kojab_tbl_form.php',$data);
			$this->load->view('head/footer');
		}

	public function doaddaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_kojab->insertData($data);	

		$linkback = base_url().'index.php/master/kojab/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function doedit()
	{	

		$data['aksi'] = 'edit';
		if($this->input->post('kolok') ){
			$id = $this->input->post('kolok');
			$id2 = $this->input->post('kojab');
		}else{
			return $this->index();
		}

		$listdata = $this->v_kojab->get_data($id,$id2)->row(); 
		$count = count($listdata);
		$data['count'] = $count;
		if($count){
			foreach ($listdata as $key => $value) {
			
				$data[$key] = $value;
			
			}
		}
		
		$data['linkaction'] = base_url().'index.php/master/kojab/doeditaction';

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('master/pers_kojab_tbl_form.php',$data);
			$this->load->view('head/footer');	
	}

	public function doeditaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_kojab->updateData($data);	

		$linkback = base_url().'index.php/master/kojab/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function dohapusaction()
	{	

		if($this->input->post('kolok')){
			$id = $this->input->post('kolok');
			$id2 = $this->input->post('kojab');
		}else{
			return $this->index();
		}

		$hsl = $this->v_kojab->hapusData($id,$id2);
		
		$linkback = base_url().'index.php/master/kojab/';
		if($hsl){
			$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		}else{
			$a = array('response' => 'GAGAL', 'hasil' => $hsl, 'linkback' => $linkback);
		}

		echo json_encode($a);
	}

}
		

