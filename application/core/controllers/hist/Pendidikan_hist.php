<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendidikan_hist extends CI_Controller {

	private $user=array();
	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('hist/v_pendidikan_hist');

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
			$this->load->view('hist/pendidikan_hist_grid.php');
			$this->load->view('head/footer');	
	}	

	public function data($nrk)
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			
			0 => 'JENDIK',
			1 => 'KODIK',
			2 => 'NASEK',
			3 => 'UNIVER',
			4 => 'KOTSEK',
			5 => 'TGIJAZAH',
			6 => 'NOIJAZAH',
			7 => 'TGACCKOP',
			8 => 'NOACCKOP',
			9 => 'TGMULAI',
			10 => 'TGAKHIR',
			11 => 'JUMJAM',
			12 => 'SELENGGARA',
			13 => 'ANGKATAN',
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NRK,JENDIK,KODIK,NASEK,UNIVER,KOTSEK,TGIJAZAH,NOIJAZAH,TGACCKOP,NOACCKOP,TGMULAI,TGAKHIR,JUMJAM,SELENGGARA,USER_ID,TERM,TG_UPD,ANGKATAN";
		$sql .= " FROM PERS_PENDIDIKAN) X";
		$sql .= " WHERE NRK = $nrk";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		//$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, 
				PERS_PENDIDIKAN.NRK,
				PERS_PENDIDIKAN.JENDIK,
				PERS_JENDIK_RPT.KETERANGAN AS KET_JENDIK,
				PERS_PENDIDIKAN.KODIK,
				PERS_PENDIDIKAN.NASEK,
				PERS_UNIVER_TBL.NAUNIVER,
				PERS_PENDIDIKAN.KOTSEK,
				PERS_PENDIDIKAN.TGIJAZAH,
				PERS_PENDIDIKAN.NOIJAZAH,
				PERS_PENDIDIKAN.TGACCKOP,
				PERS_PENDIDIKAN.NOACCKOP,
				PERS_PENDIDIKAN.TGMULAI,
				PERS_PENDIDIKAN.TGAKHIR,
				PERS_PENDIDIKAN.JUMJAM,
				PERS_PENDIDIKAN.SELENGGARA,
				PERS_PENDIDIKAN.ANGKATAN,
				PERS_PENDIDIKAN.USER_ID,
				PERS_PENDIDIKAN.TERM,
				PERS_PENDIDIKAN.TG_UPD";
		$sql .= " FROM PERS_PENDIDIKAN 
				LEFT JOIN PERS_JENDIK_RPT ON PERS_PENDIDIKAN.JENDIK = PERS_JENDIK_RPT.JENDIK
				LEFT JOIN PERS_UNIVER_TBL ON PERS_PENDIDIKAN.UNIVER = PERS_UNIVER_TBL.KDUNIVER) X";
		$sql .= " WHERE NRK = $nrk";

		// getting records as per search parameters
			
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(KET_JENDIK) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(KODIK) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(NASEK) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   
			$sql.=" AND lower(NAUNIVER) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][4]['search']['value']) ){  
			$sql.=" AND lower(KOTSEK) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){   
			$sql.=" AND lower(TGIJAZAH) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][6]['search']['value']) ){   
			$sql.=" AND lower(NOIJAZAH) LIKE lower('%".$requestData['columns'][6]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][7]['search']['value']) ){  
			$sql.=" AND lower(TGACCKOP) LIKE lower('%".$requestData['columns'][7]['search']['value']."%') ";
		}			
		if( !empty($requestData['columns'][8]['search']['value']) ){   
			$sql.=" AND lower(NOACCKOP) LIKE lower('%".$requestData['columns'][8]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][9]['search']['value']) ){  
			$sql.=" AND lower(TGMULAI) LIKE lower('%".$requestData['columns'][9]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][10]['search']['value']) ){   
			$sql.=" AND lower(TGAKHIR) LIKE lower('%".$requestData['columns'][10]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][11]['search']['value']) ){   
			$sql.=" AND lower(JUMJAM) LIKE lower('%".$requestData['columns'][11]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][12]['search']['value']) ){   
			$sql.=" AND lower(SELENGGARA) LIKE lower('%".$requestData['columns'][12]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][13]['search']['value']) ){   
			$sql.=" AND lower(ANGKATAN) LIKE lower('%".$requestData['columns'][13]['search']['value']."%') ";
		}
		
		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
			$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
		
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			
			$nestedData[] = $row->KET_JENDIK;			
			$nestedData[] = $row->KODIK;
			$nestedData[] = $row->NASEK;	
			$nestedData[] = $row->NAUNIVER;			
			$nestedData[] = $row->KOTSEK;
			$nestedData[] = $row->TGIJAZAH;			
			$nestedData[] = $row->NOIJAZAH;
			$nestedData[] = $row->TGACCKOP;	
			$nestedData[] = $row->NOACCKOP;
			$nestedData[] = $row->TGMULAI;	
			$nestedData[] = $row->TGAKHIR;
			$nestedData[] = $row->JUMJAM;
			$nestedData[] = $row->SELENGGARA;	
			$nestedData[] = $row->ANGKATAN;			
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
											<form method='post' action='".base_url()."/index.php/hist/pendidikan_hist/doedit'>
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<input type='hidden' name='jendik' id='jendik' value='".$row->JENDIK."'>
												<input type='hidden' name='kodik' id='kodik' value='".$row->KODIK."'>
												<button class='btn btn-success btn-xs' type='submit' pull-right>edit</button>								
											</form>
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=hapusData('".$row->NRK."','".$row->JENDIK."','".$row->KODIK."','".base_url()."/index.php/hist/pendidikan_hist/dohapusaction') >hapus</button>
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
		$data['linkaction'] = base_url().'index.php/hist/pendidikan_hist/doaddaction';

		$data['listJendik'] = $this->v_pendidikan_hist->getListJendik();
		//$data['listKodik'] = $this->v_pendidikan_hist->getListKodik();
		$data['listUniver'] = $this->v_pendidikan_hist->getListUniver();

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/pendidikan_hist_form.php',$data);
			$this->load->view('head/footer');
		}

	public function doaddaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_pendidikan_hist->insertData($data);	

		$linkback = base_url().'index.php/hist/pendidikan_hist/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function doedit()
	{	

		$data['aksi'] = 'edit';
		if($this->input->post('nrk') ){
			$id1 = $this->input->post('nrk');
			$id2 = $this->input->post('jendik');
			$id3 = $this->input->post('kodik');
			$id4 = $this->input->post('univer');
		}else{
			return $this->index();
		}

		$listdata = $this->v_pendidikan_hist->get_data($id1,$id2,$id3)->row();
		$count = count($listdata);
		$data['count'] = $count;
		if($count){
			foreach ($listdata as $key => $value) {
			
				$data[$key] = $value;
			
			}
		}
		
		$data['listJendik'] = $this->v_pendidikan_hist->getListJendik($id2);
		//$data['listKodik'] = $this->v_pendidikan_hist->getListKodik($id3);
		$data['listUniver'] = $this->v_pendidikan_hist->getListUniver($id4);

		$data['linkaction'] = base_url().'index.php/hist/pendidikan_hist/doeditaction';

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/pers_pendidikan_hist_form.php',$data);
			$this->load->view('head/footer');	
	}

	public function doeditaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_pendidikan_hist->updateData($data);	

		$linkback = base_url().'index.php/hist/pendidikan_hist/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function dohapusaction()
	{	

		if($this->input->post('nrk')){
			$id1 = $this->input->post('nrk');
			$id2 = $this->input->post('jendik');
			$id3 = $this->input->post('kodik');
		}else{
			return $this->index();
		}

		$hsl = $this->v_pendidikan_hist->hapusData($id1,$id2,$id3);
		
		$linkback = base_url().'index.php/hist/pendidikan_hist/';
		if($hsl){
			$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		}else{
			$a = array('response' => 'GAGAL', 'hasil' => $hsl, 'linkback' => $linkback);
		}

		echo json_encode($a);
	}

}
		

