<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tpp_ptt_hist extends CI_Controller {

	private $user=array();
	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('hist/v_tpp_ptt_hist');

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
			$this->load->view('hist/tpp_ptt_hist_grid.php');
			$this->load->view('head/footer');	
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'NPTT',
			1 => 'THBL',
			2 => 'NAMA',
			3 => 'KODEPDIDIK',
			4 => 'KLOGAD',
			5 => 'KEAHLIAN',
			6 => 'KINERJA',
			7 => 'TPP',
			8 => 'POTKINERJA',
			9 => 'JMLSTLPOT',
			10 => 'PPH',
			11 => 'TPPPBERSIH',
			12 => 'TGLLAHIR',
			13 => 'SPMU',
			14 => 'UPLOAD',
			15 => 'POTABSENSI',
			16 => 'JMLSTLABS',
			17 => 'GAJI_BERSIH',
			18 => 'ALFA',
			19 => 'IZIN',
			
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NPTT,THBL,NAMA,KODEPDIDIK,KLOGAD,KEAHLIAN,KINERJA,TPP,POTKINERJA,JMLSTLPOT,PPH,TPPBERSIH,USER_ID,TGLLAHIR,SPMU,TG_UPD,UPLOAD,POTABSENSI,JMLSTLABS,GAJI_BERSIH,ALFA,IZIN";
		$sql .= " FROM PERS_tpp_PTT) X";
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NPTT,THBL,NAMA,KODEPDIDIK,KLOGAD,KEAHLIAN,KINERJA,TPP,POTKINERJA,JMLSTLPOT,PPH,TPPBERSIH,USER_ID,TGLLAHIR,SPMU,TG_UPD,UPLOAD,POTABSENSI,JMLSTLABS,GAJI_BERSIH,ALFA,IZIN";
		$sql .= " FROM PERS_tpp_PTT) X";


		$sql .= " WHERE 0 = 0";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(NPTT) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(THBL) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(NAMA) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   
			$sql.=" AND lower(KODEPDIDIK) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][4]['search']['value']) ){   
			$sql.=" AND lower(KLOGAD) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){  
			$sql.=" AND lower(KEAHLIAN) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][6]['search']['value']) ){   
			$sql.=" AND lower(KINERJA) LIKE lower('%".$requestData['columns'][6]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][7]['search']['value']) ){   
			$sql.=" AND lower(TPP) LIKE lower('%".$requestData['columns'][7]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][8]['search']['value']) ){  
			$sql.=" AND lower(POTKINERJA) LIKE lower('%".$requestData['columns'][8]['search']['value']."%') ";
		}			
		if( !empty($requestData['columns'][9]['search']['value']) ){   
			$sql.=" AND lower(JMLSTLPOT) LIKE lower('%".$requestData['columns'][9]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][10]['search']['value']) ){  
			$sql.=" AND lower(PPH) LIKE lower('%".$requestData['columns'][10]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][11]['search']['value']) ){   
			$sql.=" AND lower(TPPBERSIH) LIKE lower('%".$requestData['columns'][11]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][12]['search']['value']) ){   
			$sql.=" AND lower(TGLLAHIR) LIKE lower('%".$requestData['columns'][12]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][13]['search']['value']) ){  
			$sql.=" AND lower(SPMU) LIKE lower('%".$requestData['columns'][13]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][14]['search']['value']) ){   
			$sql.=" AND lower(UPLOAD) LIKE lower('%".$requestData['columns'][14]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][15]['search']['value']) ){   
			$sql.=" AND lower(POTABSENSI) LIKE lower('%".$requestData['columns'][15]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][16]['search']['value']) ){  
			$sql.=" AND lower(JMLSTLABS) LIKE lower('%".$requestData['columns'][16]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][17]['search']['value']) ){   
			$sql.=" AND lower(GAJI_BERSIH) LIKE lower('%".$requestData['columns'][17]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][18]['search']['value']) ){   
			$sql.=" AND lower(ALFA) LIKE lower('%".$requestData['columns'][18]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][19]['search']['value']) ){  
			$sql.=" AND lower(IZIN) LIKE lower('%".$requestData['columns'][10]['search']['value']."%') ";
		}
		
		
		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
			$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
		
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$tpp=$row->TPP;
			$rptpp=number_format($tpp,2,',','.');
			$formatTpp="Rp ".$rptpp;

			$jmlstlpot=$row->JMLSTLPOT;
			$rpjmlstlpot=number_format($jmlstlpot,2,',','.');
			$formatJmlstlpot="Rp ".$rpjmlstlpot;

			$tppbersih=$row->TPPBERSIH;
			$rptppbersih=number_format($tppbersih,2,',','.');
			$formatTppbersih="Rp ".$rptppbersih;

			$gajibersih=$row->GAJI_BERSIH;
			$rpgajibersih=number_format($gajibersih,2,',','.');
			$formatRpgajibersih="Rp ".$rpgajibersih;

			$nestedData[] = $row->NPTT;	
			$nestedData[] = $row->THBL;			
			$nestedData[] = $row->NAMA;
			$nestedData[] = $row->KODEPDIDIK;	
			$nestedData[] = $row->KLOGAD;			
			$nestedData[] = $row->KEAHLIAN;
			$nestedData[] = $row->KINERJA;			
			$nestedData[] = $formatTpp;
			$nestedData[] = $row->POTKINERJA;	
			$nestedData[] = $formatJmlstlpot;
			$nestedData[] = $row->PPH;	
			$nestedData[] = $formatTppbersih;
			$nestedData[] = $row->TGLLAHIR;
			$nestedData[] = $row->SPMU;	
			$nestedData[] = $row->UPLOAD;
			$nestedData[] = $row->POTABSENSI;
			$nestedData[] = $row->JMLSTLABS;	
			$nestedData[] = $formatRpgajibersih;
			$nestedData[] = $row->ALFA;
			$nestedData[] = $row->IZIN;				
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
											<form method='post' action='".base_url()."/index.php/hist/tpp_ptt_hist/doedit'>
												<input type='hidden' name='nptt' id='nptt' value='".$row->NPTT."'>
												<input type='hidden' name='thbl' id='thbl' value='".$row->THBL."'>
												<input type='hidden' name='klogad' id='klogad' value='".$row->KLOGAD."'>
												<input type='hidden' name='spmu' id='spmu' value='".$row->SPMU."'>
												<button class='btn btn-success btn-xs' type='submit' pull-right>edit</button>								
											</form>
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=hapusData('".$row->NPTT."','".$row->THBL."','".base_url()."/index.php/hist/tpp_ptt_hist/dohapusaction') >hapus</button>
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
		$data['linkaction'] = base_url().'index.php/hist/tpp_ptt_hist/doaddaction';

			$data['listKlogad'] = $this->v_tpp_ptt_hist->getListKlogad();
			$data['listSPMU'] = $this->v_tpp_ptt_hist->getListSPMU();

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/tpp_ptt_hist_form.php',$data);
			$this->load->view('head/footer');
		}

	public function doaddaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_tpp_ptt_hist->insertData($data);	

		$linkback = base_url().'index.php/hist/tpp_ptt_hist/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function doedit()
	{	

		$data['aksi'] = 'edit';
		if($this->input->post('nptt') ){
			$id1 = $this->input->post('nptt');
			$id2 = $this->input->post('thbl');
			$id3 = $this->input->post('klogad');
			$id4 = $this->input->post('spmu');
		}else{
			return $this->index();
		}

		$listdata = $this->v_tpp_ptt_hist->get_data($id1,$id2)->row();
		$count = count($listdata);
		$data['count'] = $count;
		if($count){
			foreach ($listdata as $key => $value) {
			
				$data[$key] = $value;
			
			}
		}
		
		$data['listKlogad'] = $this->v_tpp_ptt_hist->getListKlogad($id3);
		$data['listSPMU'] = $this->v_tpp_ptt_hist->getListSPMU($id4);

		$data['linkaction'] = base_url().'index.php/hist/tpp_ptt_hist/doeditaction';

			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/tpp_ptt_hist_form.php',$data);
			$this->load->view('head/footer');	
	}

	public function doeditaction(){
		$data = $this->input->post();
		
		$hsl = $this->v_tpp_ptt_hist->updateData($data);	

		$linkback = base_url().'index.php/hist/tpp_ptt_hist/';
		$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		echo json_encode($a);
	}

	public function dohapusaction()
	{	

		if($this->input->post('nptt')){
			$id1 = $this->input->post('nptt');
			$id2 = $this->input->post('thbl');
		}else{
			return $this->index();
		}

		$hsl = $this->v_tpp_ptt_hist->hapusData($id1,$id2);
		
		$linkback = base_url().'index.php/hist/tpp_ptt_hist/';
		if($hsl){
			$a = array('response' => 'SUKSES', 'hasil' => $hsl, 'linkback' => $linkback);
		}else{
			$a = array('response' => 'GAGAL', 'hasil' => $hsl, 'linkback' => $linkback);
		}

		echo json_encode($a);
	}

}
		

