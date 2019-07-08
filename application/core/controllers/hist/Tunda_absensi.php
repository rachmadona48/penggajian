<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tunda_absensi extends CI_Controller {

	private $user=array();
	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('hist/v_tunda_absensi');

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
			$this->load->view('hist/tunda_absensi_grid.php');
			$this->load->view('head/footer');	
	}	

	public function data($nrk)
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'THBL',
			1 => 'NIP18',
			2 => 'NAMA_ABS',
			3 => 'KLOGAD',
			4 => 'NAKLOGAD',
			5 => 'NAGOL',
			6 => 'ALFA',
			7 => 'IZIN',
			8 => 'SAKIT',
			9 => 'CUTI',
			10 => 'JAMTERLAMBAT',
			11 => 'JAMPULANGCEPAT',
			12 => 'KINERJA',
			13 => 'PERIODE',
			14 => 'D_PROSES',
			15 => 'E_PROSES',
			16 => 'CUTIAPENTING',
			17 => 'CUTIBESAR',
			18 => 'CUTISAKIT',
			19 => 'CUTIBERSALIN',
			
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, THBL,NRK,NIP18,NAMA_ABS,KLOGAD,NAKLOGAD,NAGOL,ALFA,IZIN,SAKIT,CUTI,JAMTERLAMBAT,JAMPULANGCEPAT,KINERJA,PERIODE,D_PROSES,E_PROSES,CUTIAPENTING,CUTIBESAR,CUTISAKIT,CUTIBERSALIN";
		$sql .= " FROM PERS_TUNDA_ABSENSI) X";
		$sql .= " WHERE NRK = $nrk";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, THBL,NRK,NIP18,NAMA_ABS,KLOGAD,NAKLOGAD,NAGOL,ALFA,IZIN,SAKIT,CUTI,JAMTERLAMBAT,JAMPULANGCEPAT,KINERJA,PERIODE,D_PROSES,E_PROSES,CUTIAPENTING,CUTIBESAR,CUTISAKIT,CUTIBERSALIN";
		$sql .= " FROM PERS_TUNDA_ABSENSI) X";


		$sql .= " WHERE NRK = $nrk";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(THBL) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}		
		
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(NIP18) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(NAMA_ABS) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   
			$sql.=" AND lower(KLOGAD) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][4]['search']['value']) ){  
			$sql.=" AND lower(NAKLOGAD) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){   
			$sql.=" AND lower(NAGOL) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][6]['search']['value']) ){   
			$sql.=" AND lower(ALFA) LIKE lower('%".$requestData['columns'][6]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][7]['search']['value']) ){  
			$sql.=" AND lower(IZIN) LIKE lower('%".$requestData['columns'][7]['search']['value']."%') ";
		}			
		if( !empty($requestData['columns'][8]['search']['value']) ){   
			$sql.=" AND lower(SAKIT) LIKE lower('%".$requestData['columns'][8]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][9]['search']['value']) ){  
			$sql.=" AND lower(CUTI) LIKE lower('%".$requestData['columns'][9]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][10]['search']['value']) ){   
			$sql.=" AND lower(JAMTERLAMBAT) LIKE lower('%".$requestData['columns'][10]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][11]['search']['value']) ){   
			$sql.=" AND lower(JAMPULANGCEPAT) LIKE lower('%".$requestData['columns'][11]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][12]['search']['value']) ){   
			$sql.=" AND lower(KINERJA) LIKE lower('%".$requestData['columns'][12]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][13]['search']['value']) ){   
			$sql.=" AND lower(PERIODE) LIKE lower('%".$requestData['columns'][13]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][14]['search']['value']) ){   
			$sql.=" AND lower(D_PROSES) LIKE lower('%".$requestData['columns'][14]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][15]['search']['value']) ){   
			$sql.=" AND lower(E_PROSES) LIKE lower('%".$requestData['columns'][15]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][16]['search']['value']) ){   
			$sql.=" AND lower(CUTIAPENTING) LIKE lower('%".$requestData['columns'][16]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][17]['search']['value']) ){   
			$sql.=" AND lower(CUTIBESAR) LIKE lower('%".$requestData['columns'][17]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][18]['search']['value']) ){   
			$sql.=" AND lower(CUTISAKIT) LIKE lower('%".$requestData['columns'][18]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][19]['search']['value']) ){   
			$sql.=" AND lower(CUTIBERSALIN) LIKE lower('%".$requestData['columns'][19]['search']['value']."%') ";
		}
		
		
		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
		$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
		
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->THBL;			
			$nestedData[] = $row->NIP18;
			$nestedData[] = $row->NAMA_ABS;	
			$nestedData[] = $row->KLOGAD;			
			$nestedData[] = $row->NAKLOGAD;
			$nestedData[] = $row->NAGOL;			
			$nestedData[] = $row->ALFA;
			$nestedData[] = $row->IZIN;	
			$nestedData[] = $row->SAKIT;
			$nestedData[] = $row->CUTI;	
			$nestedData[] = $row->JAMTERLAMBAT;
			$nestedData[] = $row->JAMPULANGCEPAT;
			$nestedData[] = $row->KINERJA;
			$nestedData[] = $row->PERIODE;
			$nestedData[] = $row->D_PROSES;
			$nestedData[] = $row->E_PROSES;
			$nestedData[] = $row->CUTIAPENTING;
			$nestedData[] = $row->CUTIBESAR;
			$nestedData[] = $row->CUTISAKIT;
			$nestedData[] = $row->CUTIBERSALIN;			
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
											<form method='post' action='".base_url()."/index.php/hist/tunda_absensi/doedit'>
												<input type='hidden' name='thbl' id='thbl' value='".$row->THBL."'>
												<input type='hidden' name='nrk' id='nrk' value='".$row->NRK."'>
												<input type='hidden' name='klogad' id='klogad' value='".$row->KLOGAD."'>
												<button class='btn btn-success btn-xs' type='submit' pull-right>edit</button>								
											</form>
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=hapusData('".$row->THBL."','".$row->NRK."',".base_url()."/index.php/hist/tunda_absensi/dohapusaction') >hapus</button>
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
		$data['linkaction'] = base_url().'index.php/hist/tunda_absensi/doaddaction';

		$data['listKlogad'] 	= $this->v_tunda_absensi->getListKlogad();

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/tunda_absensi_form.php',$data);
			$this->load->view('head/footer');
		}

	public function doaddaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_tunda_absensi->insertData($data);	

		$linkback = base_url().'index.php/hist/tunda_absensi/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function doedit()
	{	

		$data['aksi'] = 'edit';
		if($this->input->post('nrk') ){
			$id = $this->input->post('thbl');
			$id2 = $this->input->post('nrk');
			$id3 = $this->input->post('klogad');
		}else{
			return $this->index();
		}

		$listdata = $this->v_tunda_absensi->get_data($id,$id2)->row();
		$count = count($listdata);
		$data['count'] = $count;
		if($count){
			foreach ($listdata as $key => $value) {
			
				$data[$key] = $value;
			
			}
		}

		$data['listKlogad'] = $this->v_tunda_absensi->getListKlogad($id3);
		
		$data['linkaction'] = base_url().'index.php/hist/tunda_absensi/doeditaction';

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/tunda_absensi_form.php',$data);
			$this->load->view('head/footer');	
	}

	public function doeditaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_tunda_absensi->updateData($data);	

		$linkback = base_url().'index.php/hist/tunda_absensi/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function dohapusaction()
	{	

		if($this->input->post('nrk')){
			$id = $this->input->post('thbl');
			$id2 = $this->input->post('nrk');
			
		}else{
			return $this->index();
		}

		$hsl = $this->v_tunda_absensi->hapusData($id1,$id2);
		
		$linkback = base_url().'index.php/hist/tunda_absensi/';
		if($hsl){
			$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		}else{
			$a = array('response' => 'GAGAL', 'hasil' => $hsl, 'linkback' => $linkback);
		}

		echo json_encode($a);
	}

}
		

