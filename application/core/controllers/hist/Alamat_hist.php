<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alamat_hist extends CI_Controller {

	private $user=array();

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->helper('url');
    	$this->load->library('session');
    	$this->load->model('hist/V_alamat_hist','alhs');

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
			$this->load->view('head/header', $this->user);
			$this->load->view('head/menu');
			$this->load->view('hist/alamat_hist_grid.php');
			$this->load->view('head/footer');			
	}	

	public function data()
	{		
		$requestData = $this->input->post();	

		$columns = array( 
		// datatable column index  => database column name
			0 => 'NRK',
			1 => 'TGMULAI',
			2 => 'ALAMAT',
			3 => 'RT',
			4 => 'RW',	
			5 => 'KOWIL',
			6 => 'KOCAM',
			7 => 'KOKEL',
			8 => 'PROP',	
		);

		// getting total number records without any search
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NRK, TGMULAI, ALAMAT, RT, RW, KOWIL, KOCAM, KOKEL, PROP,USER_ID, TERM, TG_UPD";
		$sql .= " FROM PERS_ALAMAT_HIST) X";		
		$query = $this->db->query($sql);
		$totalData = $query->num_rows();
		//$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

		/*$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, 
				PERS_ALAMAT_HIST.NRK,
				PERS_ALAMAT_HIST.TGMULAI,
				PERS_ALAMAT_HIST.ALAMAT,
				PERS_ALAMAT_HIST.RT,
				PERS_ALAMAT_HIST.RW,
				PERS_KOWIL_TBL.NAWIL,
				PERS_KOCAM_TBL.NACAM,
				PERS_KOKEL_TBL.NAKEL,
				PERS_PROP_RPT.KETERANGAN AS KET_PROP,
				PERS_ALAMAT_HIST.USER_ID,
				PERS_ALAMAT_HIST.TERM,
				PERS_ALAMAT_HIST.TG_UPD ";
		$sql .= " FROM PERS_ALAMAT_HIST 
				LEFT JOIN PERS_KOWIL_TBL ON PERS_ALAMAT_HIST.KOWIL = PERS_KOWIL_TBL.KOWIL
				LEFT JOIN PERS_KOCAM_TBL ON PERS_ALAMAT_HIST.KOCAM = PERS_KOCAM_TBL.KOCAM
				LEFT JOIN PERS_KOKEL_TBL ON PERS_ALAMAT_HIST.KOKEL = PERS_KOKEL_TBL.KOKEL
				LEFT JOIN PERS_PROP_RPT ON PERS_ALAMAT_HIST.PROP = PERS_PROP_RPT.PROP) X";
		*/
		$sql = "SELECT rownum, X.* FROM (SELECT rownum as rn, NRK, TGMULAI, ALAMAT, RT, RW, KOWIL, KOCAM, KOKEL, PROP,USER_ID, TERM, TG_UPD";
		$sql .= " FROM PERS_ALAMAT_HIST) X";
		$sql .= " WHERE 0 = 0";

		// getting records as per search parameters
		if( !empty($requestData['columns'][0]['search']['value']) ){   
			$sql.=" AND lower(NRK) LIKE lower('%".$requestData['columns'][0]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][1]['search']['value']) ){   
			$sql.=" AND lower(TGMULAI) LIKE lower('%".$requestData['columns'][1]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][2]['search']['value']) ){   
			$sql.=" AND lower(ALAMAT) LIKE lower('%".$requestData['columns'][2]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][3]['search']['value']) ){   
			$sql.=" AND lower(RT) LIKE lower('%".$requestData['columns'][3]['search']['value']."%') ";
		}		
		if( !empty($requestData['columns'][4]['search']['value']) ){   
			$sql.=" AND lower(RW) LIKE lower('%".$requestData['columns'][4]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][5]['search']['value']) ){   
			$sql.=" AND lower(KOWIL) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}	
		if( !empty($requestData['columns'][6]['search']['value']) ){   
			$sql.=" AND lower(KOCAM) LIKE lower('%".$requestData['columns'][6]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][7]['search']['value']) ){   
			$sql.=" AND lower(KOKEL) LIKE lower('%".$requestData['columns'][7]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][8]['search']['value']) ){   
			$sql.=" AND lower(PROP) LIKE lower('%".$requestData['columns'][8]['search']['value']."%') ";
		}
		/*if( !empty($requestData['columns'][5]['search']['value']) ){   
			$sql.=" AND lower(NAWIL) LIKE lower('%".$requestData['columns'][5]['search']['value']."%') ";
		}	
		if( !empty($requestData['columns'][6]['search']['value']) ){   
			$sql.=" AND lower(NACAM) LIKE lower('%".$requestData['columns'][6]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][7]['search']['value']) ){   
			$sql.=" AND lower(NAKEL) LIKE lower('%".$requestData['columns'][7]['search']['value']."%') ";
		}
		if( !empty($requestData['columns'][8]['search']['value']) ){   
			$sql.=" AND lower(KET_PROP) LIKE lower('%".$requestData['columns'][8]['search']['value']."%') ";
		}*/			

		
		$query= $this->db->query($sql);
		$totalFiltered = $query->num_rows();	
		
		$sql.=" AND RN > ".$requestData['start']." AND  ROWNUM <= ".$requestData['length'].""; 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']." ";  // adding length
		
		$query= $this->db->query($sql);
		
		$data = array();		

		foreach($query->result() as $row){
			$nestedData=array(); 

			$nestedData[] = $row->NRK;			
			$nestedData[] = date('d M Y', strtotime($row->TGMULAI));	
			$nestedData[] = $row->ALAMAT;			
			$nestedData[] = $row->RT;	
			$nestedData[] = $row->RW;
			$nestedData[] = $row->KOWIL;
			$nestedData[] = $row->KOCAM;
			$nestedData[] = $row->KOKEL;
			$nestedData[] = $row->PROP;
			/*$nestedData[] = $row->NAWIL;
			$nestedData[] = $row->NACAM;
			$nestedData[] = $row->NAKEL;
			$nestedData[] = $row->KET_PROP;*/
			$nestedData[] = "<div class='form-group'>
								<div class='col-sm-12'>	
									<div class='row'>
										<div class='col-sm-4'>	
												
											<button class='btn btn-success btn-xs' onClick=edit_alamathist('".$row->NRK."','".date('d-m-Y', strtotime($row->TGMULAI))."',".$row->KOWIL.",'".$row->KOCAM."','".$row->KOKEL."','".$row->PROP."') pull-right>edit</button>									
										</div>
										<div class='col-sm-4'>	
											<button class='btn btn-danger btn-xs' 
											onClick=delete_alamathist('".$row->NRK."','".date('d-m-Y', strtotime($row->TGMULAI))."') >hapus</button>
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


	public function ajax_add()
	{
		//$data['listJenhukadm'] = $this->adhs->getListJenhukadm();
		$data = array(
				'NRK' => $this->input->post('nrk'),
				'TGMULAI' => $this->input->post('tgmulai'),
				'ALAMAT' => $this->input->post('alamat'),
				'RT' => $this->input->post('rt'),
				'RW' => $this->input->post('rw'),
				'KOWIL' => $this->input->post('kowil'),
				'KOCAM' => $this->input->post('kocam'),
				'KOKEL' => $this->input->post('kokel'),
				'PROP' => $this->input->post('prop'),
				'user_id'=>$this->user['id'],
				'term'=>'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
			);
		$insert = $this->alhs->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$data = array(
				'NRK' => $this->input->post('nrk'),
				'TGMULAI' => $this->input->post('tgmulai'),
				'ALAMAT' => $this->input->post('alamat'),
				'RT' => $this->input->post('rt'),
				'RW' => $this->input->post('rw'),
				'KOWIL' => $this->input->post('kowil'),
				'KOCAM' => $this->input->post('kocam'),
				'KOKEL' => $this->input->post('kokel'),
				'PROP' => $this->input->post('prop'),
				'user_id'=>$this->user['id'],
				'term'=>'LOAD',
				'tg_upd'=>date('Y-m-d h:i:s'),
			);
		$this->alhs->update($data);
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_edit($id,$id2)
	{
		$data = $this->alhs->get_by_id($id,$id2);
		//$data->conv = date('d-m-Y',strtotime($data->TGMULAI));
		echo json_encode($data);
	}

	public function ajax_delete($id,$id2)
	{
		$this->alhs->delete_by_id($id,$id2);
		echo json_encode(array("status" => TRUE));
	}

	public function getKowil()
	{
		$kowil = $this->input->post('kowil');

		$listKowil = $this->alhs->getListKowil($kowil);
		$arr = array('response' => 'SUKSES', 'listKowil' => $listKowil);
		echo json_encode($arr);
	}

	public function getKocam(){
		$kowil = $this->input->post('kowil');

		$listKocam = $this->alhs->getListKocam($kowil);
		$arr = array('response' => 'SUKSES', 'listKocam' => $listKocam);
		echo json_encode($arr);
	}

	public function getKokel(){
		$kowil = $this->input->post('kowil');
		$kocam = $this->input->post('kocam');

		$listKokel = $this->alhs->getListKokel($kowil,$kocam);
		$arr = array('response' => 'SUKSES', 'listKokel' => $listKokel);
		echo json_encode($arr);
	}

	public function getProp()
	{
		$prop = $this->input->post('prop');

		$listProp = $this->alhs->getListProp($prop);
		$arr = array('response' => 'SUKSES', 'listProp' => $listProp);
		echo json_encode($arr);
	}
		
}
