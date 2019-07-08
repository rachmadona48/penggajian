<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_hist extends CI_Controller {

	private $user=array();
	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('hist/v_jabatan_hist');

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
			$this->load->view('hist/jabatan_hist_grid.php');
			$this->load->view('head/footer');	
	}	

	public function data($nrk)
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			
			0 => 'TMT',
			1 => 'KOLOK',
			2 => 'KOJAB',
			3 => 'KDSORT',
			4 => 'TGAKHIR',
			5 => 'KOPANG',
			6 => 'ESELON',
			7 => 'PEJTT',
			8 => 'NOSK',
			9 => 'TGSK',
			10 => 'KREDIT',
			11 => 'STATUS',
			12 => 'CKOJABF',
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NRK,TMT,KOLOK,KOJAB,KDSORT,TGAKHIR,KOPANG,ESELON,PEJTT,NOSK,TGSK,KREDIT,STATUS,USER_ID,TERM,TG_UPD,CKOJABF";
		$sql .= " FROM PERS_JABATAN_HIST) X";
		$sql .= " WHERE NRK = $nrk";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		/*$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, 
				PERS_JABATAN_HIST.NRK,
				PERS_JABATAN_HIST.TMT,
				PERS_JABATAN_HIST.KOLOK,
				PERS_LOKASI_TBL.NALOKL,
				PERS_JABATAN_HIST.KOJAB,
				PERS_KOJAB_TBL.NAJABL,
				PERS_JABATAN_HIST.KDSORT,
				PERS_JABATAN_HIST.TGAKHIR,
				PERS_JABATAN_HIST.KOPANG,
				PERS_PANGKAT_TBL.NAPANG,
				PERS_JABATAN_HIST.ESELON,
				PERS_ESELON_TBL.NESELON,
				PERS_JABATAN_HIST.PEJTT,
				PERS_PEJTT_RPT.KETERANGAN AS KET_PEJTT,
				PERS_JABATAN_HIST.NOSK,
				PERS_JABATAN_HIST.TGSK,
				PERS_JABATAN_HIST.KREDIT,
				PERS_JABATAN_HIST.STATUS,
				PERS_JABATAN_HIST.CKOJABF";
		$sql .= " FROM PERS_JABATAN_HIST 
				LEFT JOIN PERS_LOKASI_TBL ON PERS_JABATAN_HIST.KOLOK = PERS_LOKASI_TBL.KOLOK
				LEFT JOIN PERS_KOJAB_TBL ON PERS_JABATAN_HIST.KOJAB = PERS_KOJAB_TBL.KOJAB
				LEFT JOIN PERS_PANGKAT_TBL ON PERS_JABATAN_HIST.KOPANG = PERS_PANGKAT_TBL.KOPANG
				LEFT JOIN PERS_ESELON_TBL ON PERS_JABATAN_HIST.ESELON = PERS_ESELON_TBL.ESELON
				LEFT JOIN PERS_PEJTT_RPT ON PERS_JABATAN_HIST.PEJTT = PERS_PEJTT_RPT.PEJTT) X";*/
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NRK,TMT,KOLOK,KOJAB,KDSORT,TGAKHIR,KOPANG,ESELON,PEJTT,NOSK,TGSK,KREDIT,STATUS,USER_ID,TERM,TG_UPD,CKOJABF";
		$sql .= " FROM PERS_JABATAN_HIST) X";

		$sql .= " WHERE NRK = $nrk";

		// getting records as per search parameters
				
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(TMT) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(KOLOK) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(KOJAB) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		/*if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(NALOKL) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(NAJABL) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}*/
		if( !empty($requestData['columns'][3]['search']['value']) ){  
			$sql.=" AND lower(KDSORT) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][4]['search']['value']) ){   
			$sql.=" AND lower(TGAKHIR) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){   
			$sql.=" AND lower(KOPANG) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][6]['search']['value']) ){  
			$sql.=" AND lower(ESELON) LIKE lower('%".$requestData['columns'][6]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][7]['search']['value']) ){   
			$sql.=" AND lower(PEJTT) LIKE lower('%".$requestData['columns'][7]['search']['value']."%') ";
		}
		/*if( !empty($requestData['columns'][5]['search']['value']) ){   
			$sql.=" AND lower(NAPANG) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][6]['search']['value']) ){  
			$sql.=" AND lower(NESELON) LIKE lower('%".$requestData['columns'][6]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][7]['search']['value']) ){   
			$sql.=" AND lower(KET_PEJTT) LIKE lower('%".$requestData['columns'][7]['search']['value']."%') ";
		}*/


		if( !empty($requestData['columns'][8]['search']['value']) ){   
			$sql.=" AND lower(NOSK) LIKE lower('%".$requestData['columns'][8]['search']['value']."%') ";
		}			
		if( !empty($requestData['columns'][9]['search']['value']) ){  
			$sql.=" AND lower(TGSK) LIKE lower('%".$requestData['columns'][9]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][10]['search']['value']) ){  
			$sql.=" AND lower(KREDIT) LIKE lower('%".$requestData['columns'][10]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][11]['search']['value']) ){   
			$sql.=" AND lower(STATUS) LIKE lower('%".$requestData['columns'][11]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][12]['search']['value']) ){   
			$sql.=" AND lower(CKOJABF) LIKE lower('%".$requestData['columns'][12]['search']['value']."%') ";
		}
		
		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
		$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
		
		

		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			
			$nestedData[] = $row->TMT;
			$nestedData[] = $row->KOLOK;
			$nestedData[] = $row->KOJAB;			
			/*$nestedData[] = $row->NALOKL;
			$nestedData[] = $row->NAJABL;*/	
			$nestedData[] = $row->KDSORT;			
			$nestedData[] = $row->TGAKHIR;
			$nestedData[] = $row->KOPANG;	
			$nestedData[] = $row->ESELON;			
			$nestedData[] = $row->PEJTT;
			/*$nestedData[] = $row->NAPANG;	
			$nestedData[] = $row->NESELON;			
			$nestedData[] = $row->KET_PEJTT;*/
			$nestedData[] = $row->NOSK;	
			$nestedData[] = $row->TGSK;
			$nestedData[] = $row->KREDIT;	
			$nestedData[] = $row->STATUS;			
			$nestedData[] = $row->CKOJABF;			
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
											<form method='post' action='".base_url()."/index.php/hist/jabatan_hist/doedit'>
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<input type='hidden' name='tmt' id='tmt' value='".$row->TMT."'>
												<input type='hidden' name='kolok' id='kolok' value='".$row->KOLOK."'>
												<input type='hidden' name='kojab' id='kojab' value='".$row->KOJAB."'>
												<input type='hidden' name='kopang' id='kopang' value='".$row->KOPANG."'>
												<input type='hidden' name='eselon' id='eselon' value='".$row->ESELON."'>
												<input type='hidden' name='status' id='status' value='".$row->STATUS."'>
												<button class='btn btn-success btn-xs' type='submit' pull-right>edit</button>								
											</form>
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=hapusData('".$row->NRK."','".$row->TMT."','".$row->KOLOK."','".$row->KOJAB."','".base_url()."/index.php/hist/jabatan_hist/dohapusaction') >hapus</button>
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
		$data['linkaction'] = base_url().'index.php/hist/jabatan_hist/doaddaction';

		$data['listKolok'] = $this->v_jabatan_hist->getListKolok();
		$data['listKojab'] = "";
		$data['listKopang'] = $this->v_jabatan_hist->getListKopang();
		$data['listEselon'] = $this->v_jabatan_hist->getListEselon();

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/jabatan_hist_form.php',$data);
			$this->load->view('head/footer');
		}

	public function doaddaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_jabatan_hist->insertData($data);	

		$linkback = base_url().'index.php/hist/jabatan_hist/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function doedit()
	{	

		$data['aksi'] = 'edit';
		if($this->input->post('nrk') ){
			$id1 = $this->input->post('nrk');
			$id2 = $this->input->post('tmt');
			$id3 = $this->input->post('kolok');
			$id4 = $this->input->post('kojab');
			$id5 = $this->input->post('kopang');
			$id6 = $this->input->post('eselon');
			$id7 = $this->input->post('pejtt');


		}else{
			return $this->index();
		}

		$listdata = $this->v_jabatan_hist->get_data($id1,$id2,$id3,$id4)->row();
		$count = count($listdata);
		$data['count'] = $count;
		if($count){
			foreach ($listdata as $key => $value) {
			
				$data[$key] = $value;
			
			}
		}

		$data['listKolok'] 	= $this->v_jabatan_hist->getListKolok($id3);
		$data['listKojab'] 	= $this->v_jabatan_hist->getListKojab($id3,$id4);
		$data['listKopang'] = $this->v_jabatan_hist->getListKopang($id5);
		$data['listEselon'] = $this->v_jabatan_hist->getListEselon($id6);
		
		$data['linkaction'] = base_url().'index.php/hist/jabatan_hist/doeditaction';

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/jabatan_hist_form.php',$data);
			$this->load->view('head/footer');	
	}

	public function doeditaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_jabatan_hist->updateData($data);	

		$linkback = base_url().'index.php/hist/jabatan_hist/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function dohapusaction()
	{	

		if($this->input->post('nrk')){
			$id1 = $this->input->post('nrk');
			$id2 = $this->input->post('tmt');
			$id3 = $this->input->post('kolok');
			$id4 = $this->input->post('kojab');
		}else{
			return $this->index();
		}

		$hsl = $this->v_jabatan_hist->hapusData($id1,$id2,$id3,$id4);
		
		$linkback = base_url().'index.php/hist/jabatan_hist/';
		if($hsl){
			$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		}else{
			$a = array('response' => 'GAGAL', 'hasil' => $hsl, 'linkback' => $linkback);
		}

		echo json_encode($a);
	}

	public function getKojab(){
		$kolok = $this->input->post('kolok');

		$listKojab = $this->v_jabatan_hist->getListKojab($kolok);
		$arr = array('response' => 'SUKSES', 'listKojab' => $listKojab);
		echo json_encode($arr);
	}



}
		

