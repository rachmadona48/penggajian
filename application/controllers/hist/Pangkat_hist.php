<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pangkat_hist extends CI_Controller {

	private $user=array();
	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('hist/v_pangkat_hist');

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
			$this->load->view('hist/pangkat_hist_grid.php');
			$this->load->view('head/footer');	
	}	

	public function data($nrk)
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			
			0 => 'NOSK',
			1 => 'TGSK',
			2 => 'TMT',
			3 => 'KOPANG',
			4 => 'GAPOK',
			5 => 'TTMASKER',
			6 => 'BBMASKER',
			7 => 'KOLOK',
			8 => 'PEJTT',

		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NRK,TMT,KOPANG,TTMASKER,BBMASKER,KOLOK,GAPOK,PEJTT,NOSK,TGSK,USER_ID,TERM,TG_UPD";
		$sql .= " FROM PERS_PANGKAT_HIST) X";
		$sql .= " WHERE NRK = $nrk";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		//$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, 
				PERS_PANGKAT_HIST.NRK,
				PERS_PANGKAT_HIST.TMT,
				PERS_PANGKAT_HIST.KOPANG,
				PERS_PANGKAT_TBL.NAPANG,
				PERS_PANGKAT_HIST.TTMASKER,
				PERS_PANGKAT_HIST.BBMASKER,
				PERS_PANGKAT_HIST.KOLOK,
				PERS_LOKASI_TBL.NALOKL,
				PERS_PANGKAT_HIST.GAPOK,
				PERS_PANGKAT_HIST.PEJTT,
				PERS_PEJTT_RPT.KETERANGAN AS KET_PEJTT,
				PERS_PANGKAT_HIST.NOSK,
				PERS_PANGKAT_HIST.TGSK,
				PERS_PANGKAT_HIST.USER_ID,
				PERS_PANGKAT_HIST.TERM,
				PERS_PANGKAT_HIST.TG_UPD";
		$sql .= " FROM PERS_PANGKAT_HIST 
				LEFT JOIN PERS_PANGKAT_TBL ON PERS_PANGKAT_HIST.KOPANG = PERS_PANGKAT_TBL.KOPANG
				LEFT JOIN PERS_LOKASI_TBL ON PERS_PANGKAT_HIST.KOLOK = PERS_LOKASI_TBL.KOLOK
				LEFT JOIN PERS_PEJTT_RPT ON PERS_PANGKAT_HIST.PEJTT = PERS_PEJTT_RPT.PEJTT) X";
		$sql .= " WHERE NRK = $nrk";

		// getting records as per search parameters
			
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(NOSK) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(TGSK) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(TMT) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   
			$sql.=" AND lower(NAPANG) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][4]['search']['value']) ){  
			$sql.=" AND lower(GAPOK) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){   
			$sql.=" AND lower(TTMASKER) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][6]['search']['value']) ){   
			$sql.=" AND lower(BBMASKER) LIKE lower('%".$requestData['columns'][6]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][7]['search']['value']) ){  
			$sql.=" AND lower(NALOKL) LIKE lower('%".$requestData['columns'][7]['search']['value']."%') ";
		}			
		if( !empty($requestData['columns'][8]['search']['value']) ){   
			$sql.=" AND lower(KET_PEJTT) LIKE lower('%".$requestData['columns'][8]['search']['value']."%') ";
		}
		
		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
		$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
		
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array();

			$gapok=$row->GAPOK;
			$rupiah=number_format($gapok,2,',','.');
			$mix="Rp ".$rupiah;

			$nestedData[] = $row->NOSK;	
			$nestedData[] = $row->TGSK;	
			$nestedData[] = $row->TMT;			
			$nestedData[] = $row->NAPANG;
			$nestedData[] = $mix;
			$nestedData[] = $row->TTMASKER;	
			$nestedData[] = $row->BBMASKER;			
			$nestedData[] = $row->NALOKL;	
			$nestedData[] = $row->KET_PEJTT;
					
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
											<form method='post' action='".base_url()."/index.php/hist/pangkat_hist/doedit'>
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<input type='hidden' name='tmt' id='tmt' value='".$row->TMT."'>
												<input type='hidden' name='kopang' id='kopang' value='".$row->KOPANG."'>
											
												<button class='btn btn-success btn-xs' type='submit' pull-right>edit</button>								
											</form>
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=hapusData('".$row->NRK."','".$row->TMT."','".$row->KOPANG."','".base_url()."/index.php/hist/pangkat_hist/dohapusaction') >hapus</button>
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
		$data['linkaction'] = base_url().'index.php/hist/pangkat_hist/doaddaction';

		$data['listKopang'] = $this->v_pangkat_hist->getListKopang();
		$data['listPejtt'] = $this->v_pangkat_hist->getListPejtt();
		$data['listKolok'] = $this->v_pangkat_hist->getListKolok();

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/pangkat_hist_form.php',$data);
			$this->load->view('head/footer');
		}

	public function doaddaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_pangkat_hist->insertData($data);	

		$linkback = base_url().'index.php/hist/pangkat_hist/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function doedit()
	{	

		$data['aksi'] = 'edit';
		if($this->input->post('nrk') ){
			$id1 = $this->input->post('nrk');
			$id2 = $this->input->post('tmt');
			$id3 = $this->input->post('kopang');
			$id4 = $this->input->post('pejtt');
			$id5 = $this->input->post('kolok');
		}else{
			return $this->index();
		}

		$listdata = $this->v_pangkat_hist->get_data($id1,$id2,$id3)->row();
		$count = count($listdata);
		$data['count'] = $count;
		if($count){
			foreach ($listdata as $key => $value) {
			
				$data[$key] = $value;
			
			}
		}
		
		$data['listKopang'] = $this->v_pangkat_hist->getListKopang($id3);
		$data['listPejtt'] = $this->v_pangkat_hist->getListPejtt($id4);
		$data['listKolok'] = $this->v_pangkat_hist->getListKolok($id5);

		$data['linkaction'] = base_url().'index.php/hist/pangkat_hist/doeditaction';

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/pangkat_hist_form.php',$data);
			$this->load->view('head/footer');	
	}

	public function doeditaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_pangkat_hist->updateData($data);	

		$linkback = base_url().'index.php/hist/pangkat_hist/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function dohapusaction()
	{	

		if($this->input->post('nrk')){
			$id1 = $this->input->post('nrk');
			$id2 = $this->input->post('tmt');
			$id3 = $this->input->post('kopang');
		}else{
			return $this->index();
		}

		$hsl = $this->v_pangkat_hist->hapusData($id1,$id2,$id3);
		
		$linkback = base_url().'index.php/hist/pangkat_hist/';
		if($hsl){
			$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		}else{
			$a = array('response' => 'GAGAL', 'hasil' => $hsl, 'linkback' => $linkback);
		}

		echo json_encode($a);
	}

}
		

