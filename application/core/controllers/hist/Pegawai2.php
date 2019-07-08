<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai2 extends CI_Controller {

	private $user=array();
	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('hist/v_pegawai2');

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
			$this->load->view('hist/pegawai2_grid.php');
			$this->load->view('head/footer');	
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'NRK',
			1 => 'KARPEG',
			2 => 'TASPEN',
			3 => 'SIMPEDA',
			4 => 'ALIRAN',
			5 => 'ALAMAT',
			6 => 'RT',
			7 => 'RW',
			8 => 'KOWIL',
			9 => 'KOCAM',
			10 => 'KOKEL',
			11 => 'PROP',
			12 => 'NOPPEN',
			13 => 'DARAH',
			14 => 'HUSBAKTI',
			15 => 'KARSU',
			16 => 'NPWP',
			17 => 'JENDIKCPS',
			18 => 'KODIKCPS',
			19 => 'NIPPASIF',
			20 => 'FORPUSAT',
			21 => 'THFORPUS',
			22 => 'FORDAERAH',
			23 => 'THFORDRH',
			24 => 'NOINPRES',
			25 => 'TGSUMPAH',
			26 => 'NOSUMPAH',
			27 => 'PEJTTSUM',
			28 => 'TINGGI',
			29 => 'BERAT',
			30 => 'RAMBUT',
			31 => 'MUKA',
			32 => 'KULIT',
			33 => 'CACAT',
			34 => 'KIDAL',
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NRK,KARPEG,TASPEN,SIMPEDA,ALIRAN,ALAMAT,RT,RW,KOWIL,KOCAM,KOKEL,PROP,NOPPEN,DARAH,HUSBAKTI,KARSU,NPWP,JENDIKCPS,KODIKCPS,NIPPASIF,FORPUSAT,THFORPUS,FORDAERAH,THFORDRH,NOINPRES,TGSUMPAH,NOSUMPAH,PEJTTSUM,TINGGI,BERAT,RAMBUT,MUKA,KULIT,CACAT,KIDAL,USER_ID,TERM,TG_UPD";
		$sql .= " FROM PERS_PEGAWAI2) X";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NRK,KARPEG,TASPEN,SIMPEDA,ALIRAN,ALAMAT,RT,RW,KOWIL,KOCAM,KOKEL,PROP,NOPPEN,DARAH,HUSBAKTI,KARSU,NPWP,JENDIKCPS,KODIKCPS,NIPPASIF,FORPUSAT,THFORPUS,FORDAERAH,THFORDRH,NOINPRES,TGSUMPAH,NOSUMPAH,PEJTTSUM,TINGGI,BERAT,RAMBUT,MUKA,KULIT,CACAT,KIDAL,USER_ID,TERM,TG_UPD";
		$sql .= " FROM PERS_PEGAWAI2) X";


		$sql .= " WHERE 0 = 0";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(NRK) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(KARPEG) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(TASPEN) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   
			$sql.=" AND lower(SIMPEDA) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][4]['search']['value']) ){   
			$sql.=" AND lower(ALIRAN) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){  
			$sql.=" AND lower(ALAMAT) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][6]['search']['value']) ){   
			$sql.=" AND lower(RT) LIKE lower('%".$requestData['columns'][6]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][7]['search']['value']) ){   
			$sql.=" AND lower(RW) LIKE lower('%".$requestData['columns'][7]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][8]['search']['value']) ){  
			$sql.=" AND lower(KOWIL) LIKE lower('%".$requestData['columns'][8]['search']['value']."%') ";
		}			
		if( !empty($requestData['columns'][9]['search']['value']) ){   
			$sql.=" AND lower(KOCAM) LIKE lower('%".$requestData['columns'][9]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][10]['search']['value']) ){  
			$sql.=" AND lower(KOKEL) LIKE lower('%".$requestData['columns'][10]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][11]['search']['value']) ){   
			$sql.=" AND lower(PROP) LIKE lower('%".$requestData['columns'][11]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][12]['search']['value']) ){   
			$sql.=" AND lower(NOPPEN) LIKE lower('%".$requestData['columns'][12]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][13]['search']['value']) ){   
			$sql.=" AND lower(DARAH) LIKE lower('%".$requestData['columns'][13]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][14]['search']['value']) ){   
			$sql.=" AND lower(HUSBAKTI) LIKE lower('%".$requestData['columns'][14]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][15]['search']['value']) ){  
			$sql.=" AND lower(KARSU) LIKE lower('%".$requestData['columns'][15]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][16]['search']['value']) ){   
			$sql.=" AND lower(NPWP) LIKE lower('%".$requestData['columns'][16]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][17]['search']['value']) ){   
			$sql.=" AND lower(JENDIKCPS) LIKE lower('%".$requestData['columns'][17]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][18]['search']['value']) ){  
			$sql.=" AND lower(KODIKCPS) LIKE lower('%".$requestData['columns'][18]['search']['value']."%') ";
		}			
		if( !empty($requestData['columns'][19]['search']['value']) ){   
			$sql.=" AND lower(NIPPASIF) LIKE lower('%".$requestData['columns'][19]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][20]['search']['value']) ){  
			$sql.=" AND lower(FORPUSAT) LIKE lower('%".$requestData['columns'][20]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][21]['search']['value']) ){   
			$sql.=" AND lower(THFORPUS) LIKE lower('%".$requestData['columns'][21]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][22]['search']['value']) ){   
			$sql.=" AND lower(FORDAERAH) LIKE lower('%".$requestData['columns'][22]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][23]['search']['value']) ){   
			$sql.=" AND lower(THFORDRH) LIKE lower('%".$requestData['columns'][23]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][24]['search']['value']) ){   
			$sql.=" AND lower(NOINPRES) LIKE lower('%".$requestData['columns'][24]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][25]['search']['value']) ){  
			$sql.=" AND lower(TGSUMPAH) LIKE lower('%".$requestData['columns'][25]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][26]['search']['value']) ){   
			$sql.=" AND lower(NOSUMPAH) LIKE lower('%".$requestData['columns'][26]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][27]['search']['value']) ){   
			$sql.=" AND lower(PEJTTSUM) LIKE lower('%".$requestData['columns'][27]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][28]['search']['value']) ){  
			$sql.=" AND lower(TINGGI) LIKE lower('%".$requestData['columns'][28]['search']['value']."%') ";
		}			
		if( !empty($requestData['columns'][29]['search']['value']) ){   
			$sql.=" AND lower(BERAT) LIKE lower('%".$requestData['columns'][29]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][30]['search']['value']) ){  
			$sql.=" AND lower(RAMBUT) LIKE lower('%".$requestData['columns'][30]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][31]['search']['value']) ){   
			$sql.=" AND lower(MUKA) LIKE lower('%".$requestData['columns'][31]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][32]['search']['value']) ){   
			$sql.=" AND lower(KULIT) LIKE lower('%".$requestData['columns'][32]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][33]['search']['value']) ){   
			$sql.=" AND lower(CACAT) LIKE lower('%".$requestData['columns'][33]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][34]['search']['value']) ){   
			$sql.=" AND lower(KIDAL) LIKE lower('%".$requestData['columns'][34]['search']['value']."%') ";
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
			$nestedData[] = $row->KARPEG;			
			$nestedData[] = $row->TASPEN;
			$nestedData[] = $row->SIMPEDA;	
			$nestedData[] = $row->ALIRAN;			
			$nestedData[] = $row->ALAMAT;
			$nestedData[] = $row->RT;			
			$nestedData[] = $row->RW;
			$nestedData[] = $row->KOWIL;	
			$nestedData[] = $row->KOCAM;
			$nestedData[] = $row->KOKEL;	
			$nestedData[] = $row->PROP;
			$nestedData[] = $row->NOPPEN;	
			$nestedData[] = $row->DARAH;			
			$nestedData[] = $row->HUSBAKTI;
			$nestedData[] = $row->KARSU;	
			$nestedData[] = $row->NPWP;			
			$nestedData[] = $row->JENDIKCPS;
			$nestedData[] = $row->KODIKCPS;			
			$nestedData[] = $row->NIPPASIF;
			$nestedData[] = $row->FORPUSAT;	
			$nestedData[] = $row->THFORPUS;
			$nestedData[] = $row->FORDAERAH;	
			$nestedData[] = $row->THFORDRH;
			$nestedData[] = $row->NOINPRES;			
			$nestedData[] = $row->TGSUMPAH;
			$nestedData[] = $row->NOSUMPAH;	
			$nestedData[] = $row->PEJTTSUM;			
			$nestedData[] = $row->TINGGI;
			$nestedData[] = $row->BERAT;			
			$nestedData[] = $row->RAMBUT;
			$nestedData[] = $row->MUKA;	
			$nestedData[] = $row->KULIT;
			$nestedData[] = $row->CACAT;	
			$nestedData[] = $row->KIDAL;					
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
											<form method='post' action='".base_url()."/index.php/hist/pegawai2/doedit'>
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<button class='btn btn-success btn-xs' type='submit' pull-right>edit</button>								
											</form>
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=hapusData('".$row->NRK."','".base_url()."/index.php/hist/pegawai2/dohapusaction') >hapus</button>
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
		$data['linkaction'] = base_url().'index.php/hist/pegawai2/doaddaction';

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/pegawai2_form.php',$data);
			$this->load->view('head/footer');
		}

	public function doaddaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_pegawai2->insertData($data);	

		$linkback = base_url().'index.php/hist/pegawai2/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function doedit()
	{	

		$data['aksi'] = 'edit';
		if($this->input->post('NRK') ){
			$id = $this->input->post('NRK');
		}else{
			return $this->index();
		}

		$listdata = $this->v_pegawai2->get_data($id)->row();
		$count = count($listdata);
		$data['count'] = $count;
		if($count){
			foreach ($listdata as $key => $value) {
			
				$data[$key] = $value;
			
			}
		}
		
		$data['linkaction'] = base_url().'index.php/hist/pegawai2/doeditaction';

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/pegawai2_form.php',$data);
			$this->load->view('head/footer');	
	}

	public function doeditaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_pegawai2->updateData($data);	

		$linkback = base_url().'index.php/hist/pegawai2/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function dohapusaction()
	{	

		if($this->input->post('NRK')){
			$id = $this->input->post('NRK');
		}else{
			return $this->index();
		}

		$hsl = $this->v_pegawai2->hapusData($id);
		
		$linkback = base_url().'index.php/hist/pegawai2/';
		if($hsl){
			$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		}else{
			$a = array('response' => 'GAGAL', 'hasil' => $hsl, 'linkback' => $linkback);
		}

		echo json_encode($a);
	}

}
		

