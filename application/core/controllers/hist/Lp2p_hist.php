<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lp2p_hist extends CI_Controller {

	private $user=array();
	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('hist/V_lp2p_hist');

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
			$this->load->view('hist/lp2p_hist_grid.php');
			$this->load->view('head/footer');	
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'THPAJAK',
			1 => 'NRK',
			2 => 'NIP',
			3 => 'NIP18',
			4 => 'NAMA',
			5 => 'KOLOK',
			6 => 'NALOK',
			7 => 'GOL',
			8 => 'RUANG',
			9 => 'TMTPANGKAT',
			10 => 'NAJAB',
			11 => 'TMTESELON',
			12 => 'TALHIR',
			13 => 'PATHIR',
			14 => 'ALAMAT',
			15 => 'RTALAMAT',
			16 => 'RWALAMAT',
			17 => 'KELURAHAN',
			18 => 'KECAMATAN',
			19 => 'JENKEL',
			20 => 'STAWIN',
			21 => 'NAMISU',
			22 => 'PEKERJAAN',
			23 => 'JUAN',
			24 => 'JIWA',
			25 => 'KDWEWENANG',
			26 => 'NOFORM',
			27 => 'KODE2',
			28 => 'TGUPD',
			29 => 'KOJAB',
			30 => 'KOJABF',
			31 => 'KD',
			32 => 'ESELON',
			33 => 'SPMU',
			34 => 'KLOGAD',
			35 => 'KODUK',
			36 => 'THLAPOR',
			37 => 'PEJABAT',
			
			
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn,THPAJAK,NRK,NIP,NIP18,NAMA,KOLOK,NALOK,GOL,RUANG,TMTPANGKAT,NAJAB,TMTESELON,TALHIR,PATHIR,ALAMAT,
			RTALAMAT,RWALAMAT,KELURAHAN,KECAMATAN,JENKEL,STAWIN,NAMISU,PEKERJAAN,JUAN,JIWA,KDWEWENANG,NOFORM,KODE2,TGUPD,KOJAB,KOJABF,KD,ESELON,SPMU,KLOGAD,
			KODUK,THLAPOR,PEJABAT";
		$sql .= " FROM PERS_LP2P_HIST) X";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn,THPAJAK,NRK,NIP,NIP18,NAMA,KOLOK,NALOK,GOL,RUANG,TMTPANGKAT,NAJAB,TMTESELON,TALHIR,PATHIR,ALAMAT,
			RTALAMAT,RWALAMAT,KELURAHAN,KECAMATAN,JENKEL,STAWIN,NAMISU,PEKERJAAN,JUAN,JIWA,KDWEWENANG,NOFORM,KODE2,TGUPD,KOJAB,KOJABF,KD,ESELON,SPMU,KLOGAD,
			KODUK,THLAPOR,PEJABAT";
		$sql .= " FROM PERS_LP2P_HIST) X";


		$sql .= " WHERE 0 = 0";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(THPAJAK) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(NRK) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(NIP) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   
			$sql.=" AND lower(NIP18) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][4]['search']['value']) ){   
			$sql.=" AND lower(NAMA) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){  
			$sql.=" AND lower(KOLOK) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][6]['search']['value']) ){   
			$sql.=" AND lower(NALOK) LIKE lower('%".$requestData['columns'][6]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][7]['search']['value']) ){   
			$sql.=" AND lower(GOL) LIKE lower('%".$requestData['columns'][7]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][8]['search']['value']) ){  
			$sql.=" AND lower(RUANG) LIKE lower('%".$requestData['columns'][8]['search']['value']."%') ";
		}			
		if( !empty($requestData['columns'][9]['search']['value']) ){   
			$sql.=" AND lower(TMTPANGKAT) LIKE lower('%".$requestData['columns'][9]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][10]['search']['value']) ){  
			$sql.=" AND lower(NAJAB) LIKE lower('%".$requestData['columns'][10]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][11]['search']['value']) ){   
			$sql.=" AND lower(TMTESELON) LIKE lower('%".$requestData['columns'][11]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][12]['search']['value']) ){   
			$sql.=" AND lower(TALHIR) LIKE lower('%".$requestData['columns'][12]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][13]['search']['value']) ){   
			$sql.=" AND lower(PATHIR) LIKE lower('%".$requestData['columns'][13]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][14]['search']['value']) ){   
			$sql.=" AND lower(ALAMAT) LIKE lower('%".$requestData['columns'][14]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][15]['search']['value']) ){   
			$sql.=" AND lower(RTALAMAT) LIKE lower('%".$requestData['columns'][15]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][16]['search']['value']) ){   
			$sql.=" AND lower(RWALAMAT) LIKE lower('%".$requestData['columns'][16]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][17]['search']['value']) ){   
			$sql.=" AND lower(KELURAHAN) LIKE lower('%".$requestData['columns'][17]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][18]['search']['value']) ){   
			$sql.=" AND lower(KECAMATAN) LIKE lower('%".$requestData['columns'][18]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][19]['search']['value']) ){   
			$sql.=" AND lower(JENKEL) LIKE lower('%".$requestData['columns'][19]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][20]['search']['value']) ){   
			$sql.=" AND lower(STAWIN) LIKE lower('%".$requestData['columns'][20]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][21]['search']['value']) ){   
			$sql.=" AND lower(NAMISU) LIKE lower('%".$requestData['columns'][21]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][22]['search']['value']) ){   
			$sql.=" AND lower(PEKERJAAN) LIKE lower('%".$requestData['columns'][22]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][23]['search']['value']) ){   
			$sql.=" AND lower(JUAN) LIKE lower('%".$requestData['columns'][23]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][24]['search']['value']) ){   
			$sql.=" AND lower(JIWA) LIKE lower('%".$requestData['columns'][24]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][25]['search']['value']) ){   
			$sql.=" AND lower(KDWEWENANG) LIKE lower('%".$requestData['columns'][25]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][26]['search']['value']) ){   
			$sql.=" AND lower(NOFORM) LIKE lower('%".$requestData['columns'][26]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][27]['search']['value']) ){   
			$sql.=" AND lower(KODE2) LIKE lower('%".$requestData['columns'][27]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][28]['search']['value']) ){   
			$sql.=" AND lower(TGUPD) LIKE lower('%".$requestData['columns'][28]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][29]['search']['value']) ){   
			$sql.=" AND lower(KOJAB) LIKE lower('%".$requestData['columns'][29]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][30]['search']['value']) ){   
			$sql.=" AND lower(KOJABF) LIKE lower('%".$requestData['columns'][30]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][31]['search']['value']) ){   
			$sql.=" AND lower(KD) LIKE lower('%".$requestData['columns'][31]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][32]['search']['value']) ){   
			$sql.=" AND lower(ESELON) LIKE lower('%".$requestData['columns'][32]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][33]['search']['value']) ){   
			$sql.=" AND lower(SPMU) LIKE lower('%".$requestData['columns'][33]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][34]['search']['value']) ){   
			$sql.=" AND lower(KLOGAD) LIKE lower('%".$requestData['columns'][34]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][35]['search']['value']) ){   
			$sql.=" AND lower(KODUK) LIKE lower('%".$requestData['columns'][35]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][36]['search']['value']) ){   
			$sql.=" AND lower(THLAPOR) LIKE lower('%".$requestData['columns'][36]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][37]['search']['value']) ){   
			$sql.=" AND lower(PEJABAT) LIKE lower('%".$requestData['columns'][37]['search']['value']."%') ";
		}
		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
		$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
		
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->THPAJAK;		//1
			$nestedData[] = $row->NRK;			
			$nestedData[] = $row->NIP;
			$nestedData[] = $row->NIP18;	
			$nestedData[] = $row->NAMA;			
			$nestedData[] = $row->KOLOK;
			$nestedData[] = $row->NALOK;			
			$nestedData[] = $row->GOL;
			$nestedData[] = $row->RUANG;	
			$nestedData[] = $row->TMTPANGKAT;	//10
			$nestedData[] = $row->NAJAB;	
			$nestedData[] = $row->TMTESELON;
			$nestedData[] = $row->TALHIR;
			$nestedData[] = $row->PATHIR;	
			$nestedData[] = $row->ALAMAT;	
			$nestedData[] = $row->RTALAMAT;	
			$nestedData[] = $row->RWALAMAT;
			$nestedData[] = $row->KELURAHAN;
			$nestedData[] = $row->KECAMATAN;
			$nestedData[] = $row->JENKEL;		//20
			$nestedData[] = $row->STAWIN;
			$nestedData[] = $row->NAMISU;
			$nestedData[] = $row->PEKERJAAN;
			$nestedData[] = $row->JUAN;
			$nestedData[] = $row->JIWA;
			$nestedData[] = $row->KDWEWENANG;
			$nestedData[] = $row->NOFORM;
			$nestedData[] = $row->KODE2;
			$nestedData[] = $row->TGUPD;
			$nestedData[] = $row->KOJAB;		//30
			$nestedData[] = $row->KOJABF;
			$nestedData[] = $row->KD;
			$nestedData[] = $row->ESELON;
			$nestedData[] = $row->SPMU;
			$nestedData[] = $row->KLOGAD;
			$nestedData[] = $row->KODUK;
			$nestedData[] = $row->THLAPOR;
			$nestedData[] = $row->PEJABAT;		//38
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
											<form method='post' action='".base_url()."/index.php/hist/lp2p_hist/doedit'>
												<input type='hidden' name='thpajak' id='thpajak' value='".$row->THPAJAK."'>
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												
												<button class='btn btn-success btn-xs' type='submit' pull-right>edit</button>								
											</form>
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=hapusData('".$row->THPAJAK."','".$row->NRK."','".base_url()."/index.php/hist/lp2p_hist/dohapusaction') >hapus</button>
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
		$data['linkaction'] = base_url().'index.php/hist/lp2p_hist/doaddaction';
		//$data['listKolok'] = $this->V_lp2p_hist->getListKolok();
		//$data['listEselon'] = $this->V_lp2p_hist->getListEselon();

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/lp2p_hist_form.php',$data);
			$this->load->view('head/footer');
	}

	public function doaddaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_lp2p_hist->insertData($data);	

		$linkback = base_url().'index.php/hist/lp2p_hist/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function doedit()
	{	

		$data['aksi'] = 'edit';
		if($this->input->post('thpajak') ){
			$id = $this->input->post('thpajak');
			$id2 = $this->input->post('nrk');
			
		}else{
			return $this->index();
		}

		$listdata = $this->V_lp2p_hist->get_data($id,$id2)->row();
		$count = count($listdata);
		$data['count'] = $count;
		if($count){
			foreach ($listdata as $key => $value) {
			
				$data[$key] = $value;
			
			}
		}
		
		//$data['listKolok'] = $this->V_lp2p_hist->getListKolok();
		//$data['listEselon'] = $this->V_lp2p_hist->getListEselon();

		$data['linkaction'] = base_url().'index.php/hist/lp2p_hist/doeditaction';

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/lp2p_hist_form.php',$data);
			$this->load->view('head/footer');	
	}

	public function doeditaction(){
		$data = $this->input->post();
		
		$hsl = $this->V_lp2p_hist->updateData($data);	

		$linkback = base_url().'index.php/hist/lp2p_hist/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function dohapusaction()
	{	

		if($this->input->post('thpajak')){
			$id = $this->input->post('thpajak');
			$id2 = $this->input->post('nrk');
			
		}else{
			return $this->index();
		}

		$hsl = $this->v_lp2p_hist->hapusData($id1,$id2);
		
		$linkback = base_url().'index.php/hist/lp2p_hist/';
		if($hsl){
			$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		}else{
			$a = array('response' => 'GAGAL', 'hasil' => $hsl, 'linkback' => $linkback);
		}

		echo json_encode($a);
	}

}
		

