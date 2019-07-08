<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai1 extends CI_Controller {

	private $user=array();
	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('hist/v_pegawai1');

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
			$this->load->view('hist/pegawai1_grid.php');
			$this->load->view('head/footer');	
	}	

	public function data($nrk)
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			
			0 => 'NIP',
			1 => 'KLOGAD',
			2 => 'KKLOGAD',
			3 => 'NAMA',
			4 => 'TITEL',
			5 => 'PATHIR',
			6 => 'TALHIR',
			7 => 'AGAMA',
			8 => 'JENKEL',
			9 => 'STAWIN',
			10 => 'STAPEG',
			11 => 'JENPEG',
			12 => 'INDUK',
			13 => 'MUANG',
			14 => 'NOTUNGGU',
			15 => 'TGTUNGGU',
			16 => 'TGAKHTUNG',
			17 => 'TBHTTMAS',
			18 => 'TBHBBMAS',
			19 => 'TUNDA',
			20 => 'MPP',
			21 => 'TMT_STAPEG',
			22 => 'NIP18',
			23 => 'TMTPENSIUN',
			24 => 'KDMATI',
			25 => 'TGLAMPP',
			26 => 'TGLEMPP',
			27 => 'X_PHOTO',
			28 => 'PINDAHAN',
			29 => 'TMTPINDAH',
			
			
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NRK,NIP,KLOGAD,KKLOGAD,NAMA,TITEL,PATHIR,TALHIR,AGAMA,JENKEL,STAWIN,STAPEG,JENPEG, INDUK, MUANG,NOTUNGGU,TGTUNGGU,TGAKHTUNG,TBHTTMAS,TBHBBMAS, TUNDA, MPP, TMT_STAPEG,USER_ID,TERM,TG_UPD,NIP18,TMTPENSIUN,KDMATI,TGLAMPP,TGLEMPP,X_PHOTO,PINDAHAN,TMTPINDAH";
		$sql .= " FROM PERS_PEGAWAI1) X";
		$sql .= " WHERE NRK = $nrk";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NRK,NIP,KLOGAD,KKLOGAD,NAMA,TITEL,PATHIR,TALHIR,AGAMA,JENKEL,STAWIN,STAPEG,JENPEG, INDUK, MUANG,NOTUNGGU,TGTUNGGU,TGAKHTUNG,TBHTTMAS,TBHBBMAS, TUNDA, MPP, TMT_STAPEG,USER_ID,TERM,TG_UPD,NIP18,TMTPENSIUN,KDMATI,TGLAMPP,TGLEMPP,X_PHOTO,PINDAHAN,TMTPINDAH";
		$sql .= " FROM PERS_PEGAWAI1) X";

		$sql .= " WHERE NRK = $nrk";

		// getting records as per search parameters
			
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(NIP) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(KLOGAD) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(KKLOGAD) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   
			$sql.=" AND lower(NAMA) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][4]['search']['value']) ){  
			$sql.=" AND lower(TITEL) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){   
			$sql.=" AND lower(PATHIR) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][6]['search']['value']) ){   
			$sql.=" AND lower(TALHIR) LIKE lower('%".$requestData['columns'][6]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][7]['search']['value']) ){  
			$sql.=" AND lower(AGAMA) LIKE lower('%".$requestData['columns'][7]['search']['value']."%') ";
		}			
		if( !empty($requestData['columns'][8]['search']['value']) ){   
			$sql.=" AND lower(JENKEL) LIKE lower('%".$requestData['columns'][8]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][9]['search']['value']) ){  
			$sql.=" AND lower(STAWIN) LIKE lower('%".$requestData['columns'][9]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][10]['search']['value']) ){   
			$sql.=" AND lower(STAPEG) LIKE lower('%".$requestData['columns'][10]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][11]['search']['value']) ){   
			$sql.=" AND lower(JENPEG) LIKE lower('%".$requestData['columns'][11]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][12]['search']['value']) ){   
			$sql.=" AND lower(INDUK) LIKE lower('%".$requestData['columns'][12]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][13]['search']['value']) ){   
			$sql.=" AND lower(MUANG) LIKE lower('%".$requestData['columns'][13]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][14]['search']['value']) ){   
			$sql.=" AND lower(NOTUNGGU) LIKE lower('%".$requestData['columns'][14]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][15]['search']['value']) ){   
			$sql.=" AND lower(TGTUNGGU) LIKE lower('%".$requestData['columns'][15]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][16]['search']['value']) ){   
			$sql.=" AND lower(TGAKHTUNG) LIKE lower('%".$requestData['columns'][16]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][17]['search']['value']) ){   
			$sql.=" AND lower(TBHTTMAS) LIKE lower('%".$requestData['columns'][17]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][18]['search']['value']) ){   
			$sql.=" AND lower(TBHBBMAS) LIKE lower('%".$requestData['columns'][18]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][19]['search']['value']) ){   
			$sql.=" AND lower(TUNDA) LIKE lower('%".$requestData['columns'][19]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][20]['search']['value']) ){   
			$sql.=" AND lower(MPP) LIKE lower('%".$requestData['columns'][20]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][21]['search']['value']) ){   
			$sql.=" AND lower(TMT_STAPEG) LIKE lower('%".$requestData['columns'][21]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][22]['search']['value']) ){   
			$sql.=" AND lower(NIP18) LIKE lower('%".$requestData['columns'][22]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][23]['search']['value']) ){   
			$sql.=" AND lower(TMTPENSIUN) LIKE lower('%".$requestData['columns'][23]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][24]['search']['value']) ){   
			$sql.=" AND lower(KDMATI) LIKE lower('%".$requestData['columns'][24]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][25]['search']['value']) ){   
			$sql.=" AND lower(TGLAMPP) LIKE lower('%".$requestData['columns'][25]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][26]['search']['value']) ){   
			$sql.=" AND lower(TGLEMPP) LIKE lower('%".$requestData['columns'][26]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][27]['search']['value']) ){   
			$sql.=" AND lower(X_PHOTO) LIKE lower('%".$requestData['columns'][27]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][28]['search']['value']) ){   
			$sql.=" AND lower(PINDAHAN) LIKE lower('%".$requestData['columns'][28]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][29]['search']['value']) ){   
			$sql.=" AND lower(TMTPINDAH) LIKE lower('%".$requestData['columns'][29]['search']['value']."%') ";
		}
		

		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
		$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
		
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			
			$nestedData[] = $row->NIP;			
			$nestedData[] = $row->KLOGAD;
			$nestedData[] = $row->KKLOGAD;	
			$nestedData[] = $row->NAMA;			
			$nestedData[] = $row->TITEL;
			$nestedData[] = $row->PATHIR;			
			$nestedData[] = $row->TALHIR;
			$nestedData[] = $row->AGAMA;	
			$nestedData[] = $row->JENKEL;
			$nestedData[] = $row->STAWIN;	
			$nestedData[] = $row->STAPEG;
			$nestedData[] = $row->JENPEG;	
			$nestedData[] = $row->INDUK;			
			$nestedData[] = $row->MUANG;
			$nestedData[] = $row->NOTUNGGU;	
			$nestedData[] = $row->TGTUNGGU;			
			$nestedData[] = $row->TGAKHTUNG;
			$nestedData[] = $row->TBHTTMAS;			
			$nestedData[] = $row->TBHBBMAS;
			$nestedData[] = $row->TUNDA;	
			$nestedData[] = $row->MPP;
			$nestedData[] = $row->TMT_STAPEG;	
			$nestedData[] = $row->NIP18;
			$nestedData[] = $row->TMTPENSIUN;	
			$nestedData[] = $row->KDMATI;			
			$nestedData[] = $row->TGLAMPP;
			$nestedData[] = $row->TGLEMPP;	
			$nestedData[] = $row->X_PHOTO;			
			$nestedData[] = $row->PINDAHAN;
			$nestedData[] = $row->TMTPINDAH;			
						
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
											<form method='post' action='".base_url()."/index.php/hist/pegawai1/doedit'>
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<input type='hidden' name='klogad' id='klogad' value='".$row->KLOGAD."'>
												<input type='hidden' name='agama' id='agama' value='".$row->AGAMA."'>
												<input type='hidden' name='stawin' id='stawin' value='".$row->STAWIN."'>
												<input type='hidden' name='jenpeg' id='jenpeg' value='".$row->JENPEG."'>
												<input type='hidden' name='induk' id='induk' value='".$row->INDUK."'>
												
												<button class='btn btn-success btn-xs' type='submit' pull-right>edit</button>								
											</form>
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=hapusData('".$row->NRK."','".base_url()."/index.php/hist/pegawai1/dohapusaction') >hapus</button>
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
		$data['linkaction'] = base_url().'index.php/hist/pegawai1/doaddaction';

		$data['listKlogad'] = $this->v_pegawai1->getListKlogad();
		$data['listAgama'] = $this->v_pegawai1->getListAgama();
		$data['listStawin'] = $this->v_pegawai1->getListStawin();
		$data['listJenpeg'] = $this->v_pegawai1->getListJenpeg();
		$data['listInduk'] = $this->v_pegawai1->getListInduk();

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/pegawai1_form.php',$data);
			$this->load->view('head/footer');
		}

	public function doaddaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_pegawai1->insertData($data);	

		$linkback = base_url().'index.php/hist/pegawai1/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function doedit()
	{	

		$data['aksi'] = 'edit';
		if($this->input->post('nrk') ){
			$id = $this->input->post('nrk');
			$id2 = $this->input->post('klogad');
			$id3 = $this->input->post('agama');
			$id4 = $this->input->post('stawin');
			$id5 = $this->input->post('jenpeg');
			$id6 = $this->input->post('induk');
			
		}else{
			return $this->index();
		}

		$listdata = $this->v_pegawai1->get_data($id)->row();
		$count = count($listdata);
		$data['count'] = $count;
		if($count){
			foreach ($listdata as $key => $value) {
			
				$data[$key] = $value;
			
			}
		}

		$data['listKlogad'] = $this->v_pegawai1->getListKlogad($id2);
		$data['listAgama'] = $this->v_pegawai1->getListAgama($id3);
		$data['listStawin'] = $this->v_pegawai1->getListStawin($id4);
		$data['listJenpeg'] = $this->v_pegawai1->getListJenpeg($id5);
		$data['listInduk'] = $this->v_pegawai1->getListInduk($id6);
		
		$data['linkaction'] = base_url().'index.php/hist/pegawai1/doeditaction';

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/pegawai1_form.php',$data);
			$this->load->view('head/footer');	
	}

	public function doeditaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_pegawai1->updateData($data);	

		$linkback = base_url().'index.php/hist/pegawai1/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function dohapusaction()
	{	

		if($this->input->post('nrk')){
			$id = $this->input->post('nrk');
			
		}else{
			return $this->index();
		}

		$hsl = $this->v_pegawai1->hapusData($id);
		
		$linkback = base_url().'index.php/hist/pegawai1/';
		if($hsl){
			$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		}else{
			$a = array('response' => 'GAGAL', 'hasil' => $hsl, 'linkback' => $linkback);
		}

		echo json_encode($a);
	}

}
		

