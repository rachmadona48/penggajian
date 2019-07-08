<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seminar_hist extends CI_Controller {

	private $user=array();
	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('hist/v_seminar_hist');

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
			$this->load->view('hist/seminar_hist_grid.php');
			$this->load->view('head/footer');	
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'NRK',
			1 => 'TGMULAI',
			2 => 'TGSELESAI',
			3 => 'NASEMI',
			4 => 'KDSEMI',
			5 => 'KDTEMA',
			6 => 'BADAN',
			7 => 'TEMPAT',
			8 => 'KDPERAN',
			
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NRK,TGMULAI,TGSELESAI,NASEMI,KDSEMI,KDTEMA,BADAN,TEMPAT,KDPERAN,USER_ID,TERM,TG_UPD";
		$sql .= " FROM PERS_SEMINAR_HIST) X";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NRK,TGMULAI,TGSELESAI,NASEMI,KDSEMI,KDTEMA,BADAN,TEMPAT,KDPERAN,USER_ID,TERM,TG_UPD";
		$sql .= " FROM PERS_SEMINAR_HIST) X";


		$sql .= " WHERE 0 = 0";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(NRK) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(TGMULAI) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(TGSELESAI) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   
			$sql.=" AND lower(NASEMI) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][4]['search']['value']) ){   
			$sql.=" AND lower(KDSEMI) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){  
			$sql.=" AND lower(KDTEMA) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][6]['search']['value']) ){   
			$sql.=" AND lower(BADAN) LIKE lower('%".$requestData['columns'][6]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][7]['search']['value']) ){   
			$sql.=" AND lower(TEMPAT) LIKE lower('%".$requestData['columns'][7]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][8]['search']['value']) ){  
			$sql.=" AND lower(KDPERAN) LIKE lower('%".$requestData['columns'][8]['search']['value']."%') ";
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
			$nestedData[] = $row->TGMULAI;			
			$nestedData[] = $row->TGSELESAI;
			$nestedData[] = $row->NASEMI;	
			$nestedData[] = $row->KDSEMI;			
			$nestedData[] = $row->KDTEMA;
			$nestedData[] = $row->BADAN;			
			$nestedData[] = $row->TEMPAT;
			$nestedData[] = $row->KDPERAN;	
					
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
											<form method='post' action='".base_url()."/index.php/hist/seminar_hist/doedit'>
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<input type='hidden' name='tgmulai' id='tgmulai' value='".$row->TGMULAI."'>
												<input type='hidden' name='kdperan' id='kdperan' value='".$row->KDPERAN."'>
												<input type='hidden' name='kdsemi' id='kdsemi' value='".$row->KDSEMI."'>
												<input type='hidden' name='kdtema' id='kdtema' value='".$row->KDTEMA."'>

												<button class='btn btn-success btn-xs' type='submit' pull-right>edit</button>								
											</form>
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=hapusData('".$row->NRK."','".$row->TGMULAI."','".base_url()."/index.php/hist/seminar_hist/dohapusaction') >hapus</button>
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
		$data['linkaction'] = base_url().'index.php/hist/seminar_hist/doaddaction';


		$data['listKdsemi'] = $this->v_seminar_hist->getListKdsemi();
		$data['listKdperan'] = $this->v_seminar_hist->getListKdperan();
		$data['listKdtema'] = $this->v_seminar_hist->getListKdtema();

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/seminar_hist_form.php',$data);
			$this->load->view('head/footer');
		}

	public function doaddaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_seminar_hist->insertData($data);	

		$linkback = base_url().'index.php/hist/seminar_hist/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function doedit()
	{	

		$data['aksi'] = 'edit';
		if($this->input->post('nrk') ){
			$id = $this->input->post('nrk');
			$id2 = $this->input->post('tgmulai');
			$id3 = $this->input->post('kdsemi');
			$id4 = $this->input->post('kdtema');
			$id5 = $this->input->post('kdperan');
		}else{
			return $this->index();
		}

		$listdata = $this->v_seminar_hist->get_data($id,$id2)->row();
		$count = count($listdata);
		$data['count'] = $count;
		if($count){
			foreach ($listdata as $key => $value) {
			
				$data[$key] = $value;
			
			}
		}

		$data['listKdsemi'] = $this->v_seminar_hist->getListKdsemi($id3);
		$data['listKdperan'] = $this->v_seminar_hist->getListKdperan($id5);
		$data['listKdtema'] = $this->v_seminar_hist->getListKdtema($id4);
		
		$data['linkaction'] = base_url().'index.php/hist/seminar_hist/doeditaction';

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/seminar_hist_form.php',$data);
			$this->load->view('head/footer');	
	}

	public function doeditaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_seminar_hist->updateData($data);	

		$linkback = base_url().'index.php/hist/seminar_hist/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function dohapusaction()
	{	

		if($this->input->post('nrk')){
			$id = $this->input->post('nrk');
			$id2 = $this->input->post('tgmulai');
		}else{
			return $this->index();
		}

		$hsl = $this->v_seminar_hist->hapusData($id1,$id2);
		
		$linkback = base_url().'index.php/hist/seminar_hist/';
		if($hsl){
			$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		}else{
			$a = array('response' => 'GAGAL', 'hasil' => $hsl, 'linkback' => $linkback);
		}

		echo json_encode($a);
	}

}
		

